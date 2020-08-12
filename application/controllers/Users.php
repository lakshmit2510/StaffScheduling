<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Booking_model');
    $this->load->model('Projects_model');
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    if (!in_array($this->session->userdata('Role'), array(1, 2, 3))) {
      redirect(base_url());
    }
  }

  public function index()
  {
    if ($this->session->userdata('Role') == 2) {
      $data['Title'] = 'List of Employees';
      $Role = 2;
    }
    $data['Page'] = 'listuser';
    $data['Users'] = $this->User_model->GetUsers($Role);
    $this->load->view('List-users', $data);
  }

  public function update()
  {

    if (!in_array($this->session->userdata('Role'), array(1,3))) {
      redirect('Dashboard');
      exit;
    }
    $data['Title'] = 'Update Employees Information';
    $Role = 2;
    $data['Page'] = 'add_edit_users_list';
    $data['Users'] = $this->User_model->getUserByRole($Role);
    // print_r($data['Users']);
    // exit;
    $this->load->view('add_edit_users_list', $data);
  }

  function Add()
  {
    if (!in_array($this->session->userdata('Role'), array(1,3))) {
      redirect('Dashboard');
      exit;
    }
    $data['Title'] = 'Add New Employee';
    $data['Page'] = 'adduser';
    $data['company'] = $this->Common_model->getTableData('company', 'Active');
    $data['Projects'] = $this->Projects_model->getAll();
    $this->load->view('Add-users', $data);
  }

  public function Approval()
  {
    if (!in_array($this->session->userdata('Role'), array(1, 3))) {
      redirect('Dashboard');
      exit;
    }
    $data['Title'] = 'List of Approvals';
    $data['Page'] = 'Approval';
    $data['Users'] = $this->User_model->getApprovalPending();
    $data['Projects'] = $this->Projects_model->getAll();
    $this->load->view('list_approval', $data);
  }

  function Changepassword()
  {
    $data['Title'] = 'Change Password';
    $data['Page'] = 'changepassword';
    $this->load->view('changepassword', $data);
  }

  function Edit($UserUID)
  {
    if (!in_array($this->session->userdata('Role'), array(1))) {
      redirect('Dashboard');
      exit;
    }
    if (empty($UserUID)) {
      redirect(base_url('Dashboard'));
    }
   
    $data['Title'] = 'Edit Suppliers';
    $data['Page'] = 'listuser';
    $data['userdetail'] = $this->User_model->GetUsersDetailsByUserID($UserUID);
    $data['company'] = $this->Common_model->getTableData('company', 'Active');
    $this->load->view('Edit-users', $data);
  }

  function fetchAttachments()
  {
    $userId = $this->input->get('userId');
    $data = $this->Booking_model->getAttachments($userId);
    echo json_encode($data);
  }
  function downloadFile()
  {
    $this->load->helper('download');
    $filePath = $this->input->get('filePath');
    $root_folder = $this->config->item('upload_file_path');
    $fullFilePath = $root_folder . $filePath;
    $data = file_get_contents($fullFilePath); // Read the file's contents
    $name = explode('/', $filePath);
    force_download($name[count($name) - 1], $data);
    exit;
  }


  function Approve($UserUID)
  {
    if (empty($UserUID)) {
      redirect(base_url('Dashboard'));
    }
    $data['IsApproved'] = 1;
    $data['ProjectID'] = $this->input->post('ProjectID');
    $data['Designation'] = $this->input->post('Designation');
    $approved = $this->User_model->ProcessUpdate($UserUID, $data);
    if ($approved == 1) {
      $usr = $this->User_model->GetUsersDetailsByUserID($UserUID);
      $data['UserName'] = $usr->UserName;
      $data['EmailAddress1'] = $usr->EmailAddress1;
      $data['Password'] = $usr->Password;
      $data['url'] = base_url();
      $this->config_email();
      $data['mail_title'] = 'Your Login Details - EZ Staff Scheduling System';
      $from_email = "support.ez-staff@myezjobs.sg";
      $this->email->from($from_email, 'Myezjobs.sg');
      $this->email->to($data['EmailAddress1']); #$Old->EmailAddress1;
      if (!empty($data['EmailAddress2'])) {
        $this->email->cc($data['EmailAddress2']);
      }
      $this->email->subject('Thank you. Your Account is Created in EZ Staff Scheduling System');
      $mes_body = $this->load->view('email/user-template.php', $data, true); // load html templates
      $this->email->message($mes_body);
      $this->email->send();
      $this->session->set_flashdata('done', 1);
      $this->session->set_flashdata('msg', $data['UserName'] . ' Approved successfully, Login details send to registerd email address.');
    } else {
      $this->session->set_flashdata('msg', $data['UserName'] . ' Approved error, Try again!.');
      $this->session->set_flashdata('error', 1);
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  function Reject($UserUID)
  {
    if (empty($UserUID)) {
      redirect(base_url('Dashboard'));
    }
    $reject = $this->User_model->DeleteUser($UserUID);
    if ($reject == 1) {
      $this->session->set_flashdata('done', 1);
      $this->session->set_flashdata('msg', 'User Rejected successfully.');
    } else {
      $this->session->set_flashdata('msg', $data['UserName'] . ' reject error, Try again!.');
      $this->session->set_flashdata('error', 1);
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  function save_user()
  {
    if ($this->input->post()) {
      $supplier = $this->Common_model->getMax('users');
      $data['CompanyUID'] = $this->input->post('Company');
      $data['FullName'] = $this->input->post('Name');
      $data['EmailAddress1'] = $this->input->post('EmailAddress1');
      $data['EmailAddress2'] = $this->input->post('EmailAddress2');
      $data['PhoneNumber'] = $this->input->post('PhoneNumber');
      $data['UserName'] = $this->input->post('userName');
      $data['Password'] = md5($this->input->post('Password'));
      $data['Role'] = $this->input->post('Role');
      $data['WorkingDaysPerWeek'] = $this->input->post('workingDays');
      /*$data['VNo'] = $this->input->post('VNo');
     $data['VType'] = $this->input->post('VType');*/
      // $data['Supplier'] = $this->input->post('Supplier');

      // if ($this->session->userdata('Role') <> 2) {
      //   $data['SupplierGroup'] = $this->input->post('SupplierGroup');
      //   $data['SupplierGroup'] = $data['SupplierGroup'] == 0 ? NULL : $data['SupplierGroup'];
      // }
      
      // if ($data['Role'] == 2) {
      //   $data['UniqueID'] = 'SS0000' . $supplier; # 'S'.str_pad($supplier, 5, '0', STR_PAD_LEFT);
      // } else if ($data['Role'] == 4) {
      //   $data['UniqueID'] = 'EP0000' . $supplier;
      // }
      $data['CreatedBy'] = $this->session->userdata('UserUID');
      $data['IsApproved'] = 1;
      $store = $this->User_model->SaveUser($data);
      if ($store == 1) {
        $this->session->set_flashdata('msg', $data['UserName'] . ' has been Created Successfully');
        $this->session->set_flashdata('type', 'done');

        if (empty($data['UniqueID'])) {
          $data['UniqueID'] = '';
        }
        $data['url'] = base_url();
        $this->config_email();
        $data['mail_title'] = 'Your Login Details - EZ Staff Scheduling System';
        $from_email = "support.ez-staff@myezjobs.sg";
        $this->email->from($from_email, 'Myezjobs.sg');
        $this->email->to($data['EmailAddress1']); #$Old->EmailAddress1;
        if (!empty($data['EmailAddress2'])) {
          $this->email->cc($data['EmailAddress2']);
        }
        $this->email->subject('Thank you. Your Account is Created in EZ Staff Scheduling System');
        $mes_body = $this->load->view('email/user-template.php', $data, true); // load html templates
        $this->email->message($mes_body);
        $this->email->send();
      } else {
        if ($store != 2) {
          $this->session->set_flashdata('msg', $data['UserName'] . ' has been Create Error');
        } else {
          $this->session->set_flashdata('msg', 'Kindly try with new E-mail address.');
        }
        $this->session->set_flashdata('type', 'error');
      }
    }
    redirect(base_url('Users/Add'));
  }

  function update_user()
  {
    if ($this->input->post()) {
      $data['CompanyUID'] = $this->input->post('Company');
      $UserUID = $this->input->post('UserUID');
      $data['EmailAddress1'] = $this->input->post('EmailAddress1');
      $data['EmailAddress2'] = $this->input->post('EmailAddress2');
      $data['PhoneNumber'] = $this->input->post('PhoneNumber');
      $data['UserName'] = $this->input->post('UserName');
      $data['FullName'] = $this->input->post('Name');
      $data['WorkingDaysPerWeek'] = $this->input->post('workingDays');
      /*$data['Password'] = $this->input->post('Password');*/
      /*$data['VNo'] = $this->input->post('VNo');
     $data['VType'] = $this->input->post('VType');*/
      // $data['Supplier'] = $this->input->post('Supplier');


      // if ($this->session->userdata('Role') <> 2) {
      //   $data['SupplierGroup'] = $this->input->post('SupplierGroup');
      //   $data['SupplierGroup'] = $data['SupplierGroup'] == 0 ? NULL : $data['SupplierGroup'];
      // }

      if ($this->session->userdata('Role') == 2) {
        $data['Role'] = 4;
      } else {
        $data['Role'] = $this->input->post('Role');
      }
      $store = $this->User_model->UpdateUser($data, $UserUID);
      if ($store == 1) {
        $this->session->set_flashdata('msg', $data['UserName'] . ' has been Updated Successfully');
        $this->session->set_flashdata('type', 'done');
      } else {
        if ($store != 2) {
          $this->session->set_flashdata('msg', $data['UserName'] . ' has been Update Error');
        } else {
          $this->session->set_flashdata('msg', 'Kindly try with new User name.');
        }
        $this->session->set_flashdata('type', 'error');
      }
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  function updatepassword()
  {
    if ($this->input->post()) {
      $UserUID = $this->session->userdata('UserUID');
      $Password = md5($this->input->post('Current'));
      $Pass = $this->input->post('Password');
      $Npass = $this->input->post('NPassword');
      $Old = $this->User_model->getUserdetails($UserUID);

      if ($Old->Password != $Password) {
        $this->session->set_flashdata('msg', 'Current Password do not match.');
        $this->session->set_flashdata('type', 'error');
        redirect($_SERVER['HTTP_REFERER']);
      } else {
        if ($Pass != $Npass) {
          $this->session->set_flashdata('msg', 'Confirm Password do not match.');
          $this->session->set_flashdata('type', 'error');
          redirect($_SERVER['HTTP_REFERER']);
        }
      }

      $data['Password'] = md5($Npass);
      $store = $this->User_model->updatepassword($data, $UserUID);
      if ($store == 1) {
        $this->session->set_flashdata('msg', 'Password changed successfully');
        $this->session->set_flashdata('type', 'done');
      } else {
        $this->session->set_flashdata('msg', ' Cannot reset your Password. Try again sometime');
        $this->session->set_flashdata('type', 'error');
      }
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function config_email()
  {
    $config = array(
      'charset'   => 'iso-8859-1',
      'newline' => '\r\n',
      'starttls'  => true,
      'wordwrap'  =>  true
    );
    $emailconf = $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    return $emailconf;
  }



  /**
   * Supplier Groups
   */

  public function SupplierGroups()
  {
    $data['Title'] = 'Supplier Groups';
    $data['Page'] = 'suppliergroups';
    $data['Suppliers'] = $this->User_model->GetSupplierGroups(1);
    $this->load->view('supplier-groups', $data);
  }
  public function AddSupplierGroup()
  {
    $data['Title'] = 'Add Supplier Group';
    $this->load->view('add-supplier-group', $data);
  }


  function CreateSupplierGroup()
  {
    $data['GroupName'] = $this->input->post('groupname');
    $az = $this->input->post('slots');
    $data['AllotedTime'] = [];

    foreach ($az as $value) {
      array_push($data['AllotedTime'], intval($value));
    }

    $data['AllotedTime'] = json_encode($data['AllotedTime']);

    if ($this->User_model->SaveSupplierGroup($data)) {
      $this->session->set_flashdata('msg', 'Supplier Group ' . $data['GroupName'] . ' is created');
      $this->session->set_flashdata('type', 'done');
      redirect(base_url('Supplier/Groups'));
    } else {
      $this->session->set_flashdata('msg', 'Error while creating supplier group. Check if supplier group already exist.');
      $this->session->set_flashdata('type', 'error');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }


  public function EditSupplierGroup($Id)
  {
    $data['Title'] = 'Edit Supplier Group';
    if ($data['Group'] = $this->User_model->GetSupplierGroupID($Id)) {
      $this->load->view('edit-supplier-group', $data);
    } else {

      $this->session->set_flashdata('msg', "This Supplier Group does't exist");
      $this->session->set_flashdata('type', 'error');
      redirect(base_url('Supplier/Groups'));
    }
  }


  public function UpdateSupplierGroup()
  {
    $data['Id'] = $this->input->post('Id');
    $data['GroupName'] = $this->input->post('groupname');
    $az = $this->input->post('slots');
    $data['AllotedTime'] = [];

    foreach ($az as $value) {
      array_push($data['AllotedTime'], intval($value));
    }

    $data['AllotedTime'] = json_encode($data['AllotedTime']);
    if ($this->User_model->UpdateSupplierGroup($data)) {
      $this->session->set_flashdata('msg', 'Supplier Group ' . $data['GroupName'] . ' is updated');
      $this->session->set_flashdata('type', 'done');
      redirect(base_url('Supplier/Groups'));
    } else {
      $this->session->set_flashdata('msg', 'Error while updating supplier group. Check if supplier group name already exist.');
      $this->session->set_flashdata('type', 'error');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function DeleteSupplierGroup($Id)
  {
    if ($this->User_model->DeleteSupplierGroup($Id)) {
      $this->session->set_flashdata('msg', "Supplier Group Deleted");
      $this->session->set_flashdata('type', 'done');
    } else {
      $this->session->set_flashdata('msg', "Some error occured while deleting the Supplier Group.");
      $this->session->set_flashdata('type', 'error');
    }
    redirect(base_url('Supplier/Groups'));
  }
}
