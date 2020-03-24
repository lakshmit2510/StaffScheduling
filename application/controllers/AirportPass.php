<?php

class AirportPass extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    // if(!in_array($this->session->userdata('Role'), array(1,3))) { redirect('Dashboard'); exit; }
    $this->load->model('AirportPass_model');
  }

  public function index()
  {
    $data['Title'] = 'List of AirportPasses';
    $data['Page'] = 'AirportPasses';
    $data["AirportPass"] = $this->AirportPass_model->getAll();
    $this->load->view('list_airportpass', $data);
  }


  public function add()
  {
    $data['Title'] = 'Add New Airport Pass Details';
    $data['Page'] = 'AddAirportPass';
    $data['Users'] = $this->Common_model->getTableData('users');
    $this->load->view('add_airportpass_details', $data);
  }

  public function update()
  {
    $data['Title'] = 'Update IC Information';
    $data['Page'] = 'AirportPass';
    $data["AirportPass"] = $this->AirportPass_model->getAll();
    $this->load->view('update_AirportPass_list', $data);
  }

  public function addAirportPass()
  {
    $fileUploaded = $this->upload_IC('AirportPass_Doc', false, 'upload_file');
    $data['PassNumber'] = $this->input->post('PassNumber');
    $data['UserID'] = $this->input->post('PassName');
    $data['DateOfExpiry'] = $this->input->post('DOE');
    $data['AccessControlAreas'] = implode( ",", $this->input->post('AccessAreas[]') );
    $data['Attachments'] = $fileUploaded['file_path'];
    $this->AirportPass_model->insert($data);
    $this->session->set_flashdata('done', 'New Airport Pass Number added Successfully');
    redirect('AirportPass');
  }

  public function editPassDetails($pass_id)
  {
    $data['slots_id'] = $pass_id;
    $data['Title'] = 'AirportPass';
    $data['Page'] = 'AirportPass';
    $data['passDetails'] = $this->AirportPass_model->getDataById($pass_id);
    $data['Users'] = $this->Common_model->getTableData('users');
    // $data['slottype'] = $this->Common_model->getTableData('slottypes', 'Active');
    $this->load->view('edit_airportPass_Details', $data);
  }


  public function editPassDetailsPost()
  {
    $pass_id = $this->input->post('ID');
    $airportpass = $this->AirportPass_model->getDataById($pass_id);
    $data['PassNumber'] = $this->input->post('PassNumber');
    $data['UserID'] = $this->input->post('PassName');
    $data['DateOfExpiry'] = $this->input->post('DOE');
    $edit = $this->AirportPass_model->update($pass_id, $data);
    if ($edit) {
      $this->session->set_flashdata('done', 'Airport Pass details Updated Successfully');
      redirect('AirportPass');
    }
  }


  public function delete($pass_id)
  {
    $delete = $this->AirportPass_model->delete($pass_id);
    $this->session->set_flashdata('done', 'Airport Pass details deleted Successfully');
    redirect('AirportPass/update');
  }

  public function upload_IC($sub_folder, $extensions, $name)
  {

    $uploadData = array();
    if (!empty($_FILES[$name]['name'])) {
      $filesCount = count($_FILES[$name]);
      $root_folder = $this->config->item('upload_file_path');
      $root_extensions = $this->config->item('upload_file_extensions');
      $root_file_size = $this->config->item('upload_file_size');
      $config = array(
        'upload_path' => $root_folder . $sub_folder,
        'allowed_types' => $extensions ? $extensions : $root_extensions,
        'overwrite' => TRUE,
        'remove_spaces' => FALSE,
        'max_size' => $root_file_size,
      );
      $this->load->library('upload', $config);
      if ($this->upload->do_upload($name)) {
        $fileData = $this->upload->data();
        if ($fileData) {
          $uploadData['file_path'] = $sub_folder . '/' . $_FILES[$name]['name'];
        }
      } else {
        $error = array('error' => $this->upload->display_errors());
      }
    }
    return $uploadData;
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
}
