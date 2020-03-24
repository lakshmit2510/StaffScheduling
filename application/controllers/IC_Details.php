<?php
defined('BASEPATH') or exit('No direct script access allowed');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class IC_Details extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    if (!in_array($this->session->userdata('Role'), array(1, 2))) {
      redirect('Dashboard');
      exit;
    }
    $this->load->model('IC_model');
  }

  public function index()
  {
    $data['Title'] = 'List of IC Details';
    $data['Page'] = 'IC';
    $data["IC_Details"] = $this->IC_model->getAll();
    $this->load->view('list_IC', $data);
  }

  public function add()
  {
    $data['Title'] = 'Add IC Details';
    $data['Page'] = 'IC';
    $data['vtype'] = $this->IC_model->getVisaType();
    $data['Users'] = $this->Common_model->getTableData('users');
    $this->load->view('add-ic-details', $data);
  }

  public function update()
  {
    $data['Title'] = 'Update IC Information';
    $data['Page'] = 'IC';
    $data["IC_Details"] = $this->IC_model->getAll();
    $this->load->view('update_IC_list', $data);
  }

  public function addICDetailsPost()
  {
    $fileUploaded = $this->upload_IC('IC_Documents', false, 'upload_file');
    $data['ICNumber'] = $this->input->post('ICNumber');
    $data['ICTypeID'] = $this->input->post('Type');
    $data['UserID'] = $this->input->post('ICName');
    $data['DateOfBirth'] = $this->input->post('DOB');
    $data['CountryOfBirth'] = $this->input->post('Nationality');
    $data['DateOfIssue'] = $this->input->post('DateofIssue');
    $data['Gender'] = $this->input->post('Gender');
    $data['Race'] = $this->input->post('race');
    $data['AttachedFiles'] = $fileUploaded['file_path'];
    $data['CreatedBy'] = $this->session->userdata('UserUID');
    $this->IC_model->insert($data);
    $this->session->set_flashdata('done', 'IC details added Successfully');
    redirect(base_url('IC_Details/update'));
  }


  public function edit($IC_id)
  {
    $data['Title'] = 'Edit IC Details';
    $data['Page'] = 'IC';
    $data['IC_id'] = $IC_id;
    $data['IC_Details'] = $this->IC_model->getDataById($IC_id);
    $data['vtype'] = $this->Common_model->getTableData('visatypes');
    $data['Users'] = $this->Common_model->getTableData('users');
    $this->load->view('edit-IC-details', $data);
  }


  public function editICDetailsPost()
  {
    $IC_id = $this->input->post('IC_id');
    $IC_Details = $this->IC_model->getDataById($IC_id);
    $data['ICNumber'] = $this->input->post('ICNo');
    $data['ICTypeID'] = $this->input->post('Type');
    $data['UserID'] = $this->input->post('fullname');
    $data['DateOfBirth'] = $this->input->post('DOB');
    $data['CountryOfBirth'] = $this->input->post('Nationality');
    $data['DateOfIssue'] = $this->input->post('DateofIssue');
    $data['Gender'] = $this->input->post('Gender');
    $data['Race'] = $this->input->post('Race');
    $edit = $this->IC_model->update($IC_id, $data);
    if ($edit) {
      $this->session->set_flashdata('done', 'IC Details updated Successfully');
      redirect(base_url('IC_Details/update'));
    }
  }

  public function delete($IC_id)
  {
    $delete = $this->IC_model->delete($IC_id);
    $this->session->set_flashdata('done', 'IC Details deleted Successfully');
    redirect(base_url('IC_Details/update'));
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
      //            $this->upload->initialize($config);
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

    if (file_exists($fullFilePath)) {
      $data = file_get_contents($fullFilePath); // Read the file's contents
      $name = explode('/', $filePath);
      force_download($name[count($name) - 1], $data);
    } else {
      echo 'file does not exist';
    }
    exit;
  }
}
