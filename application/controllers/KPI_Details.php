<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KPI_Details extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    if (!in_array($this->session->userdata('Role'), array(1, 2, 3))) {
      redirect(base_url());
      exit;
    }
    $this->load->model('KPI_model');
  }

  public function index()
  {
    $data['Title'] = 'List of KPI Details';
    $data['Page'] = 'KPI';
    $data["KPI_Details"] = $this->KPI_model->getAllKpiDetails();
    $this->load->view('list_kpi', $data);
  }

  public function add()
  {
    $data['Title'] = 'Add KPI Details';
    $data['Page'] = 'KPI';
    $data['Users'] = $this->Common_model->getTableData('users');
    $this->load->view('add_new_kpi', $data);
  }

  // public function update() 
  // {
  //   $data['Title'] = 'Update IC Information';
  //   $data['Page'] = 'IC';
  //   $data["IC_Details"] = $this->KPI_model->getAll();
  //   $this->load->view('update_IC_list', $data);
  // }

  public function addKPIDetailsPost()
  {
    $fileUploaded = $this->upload_IC('KPI_Documents', false, 'upload_file');
    $data['FlightNumber'] = $this->input->post('FlightNumber');
    $data['EmployeeID'] = implode(',', $this->input->post('Employees[]'));
    $data['Weight'] = $this->input->post('Weight');
    $data['Type'] = $this->input->post('type');
    $data['Time'] = $this->input->post('time');
    $data['Date'] = $this->input->post('date');
    $data['AttachedFiles'] = $fileUploaded['file_path'];
    $data['CreatedBy'] = $this->session->userdata('UserUID');
    $this->KPI_model->insert($data);
    $this->session->set_flashdata('done', 'KPI details added Successfully');
    redirect(base_url('KPI_Details'));
  }


  // public function edit($IC_id) 
  // {
  //     $data['Title'] = 'Edit IC Details';
  //     $data['Page'] = 'IC';
  //     $data['IC_id'] = $IC_id;
  //     $data['IC_Details'] = $this->KPI_model->getDataById($IC_id);
  //     $data['vtype'] = $this->Common_model->getTableData('visatypes');
  //     $data['Users'] = $this->Common_model->getTableData('users');
  //     $this->load->view('edit-IC-details', $data);
  // }


  // public function editICDetailsPost() 
  // {
  //     $IC_id = $this->input->post('IC_id');
  //     $IC_Details = $this->KPI_model->getDataById($IC_id);
  //     $data['ICNumber'] = $this->input->post('ICNo');
  //     $data['ICTypeID'] = $this->input->post('Type');
  //     $data['FullName'] = $this->input->post('fullname');
  //     $data['DateOfBirth'] = $this->input->post('DOB');
  //     $data['CountryOfBirth'] = $this->input->post('Nationality');
  //     $data['DateOfIssue'] = $this->input->post('DateofIssue');
  //     $data['Gender'] = $this->input->post('Gender');
  //     $data['Race'] = $this->input->post('Race');
  //     $edit = $this->KPI_model->update($IC_id,$data);
  //     if ($edit) {
  //         $this->session->set_flashdata('done', 'IC Details updated Successfully');
  //         redirect(base_url('IC_Details/update'));
  //     }
  // }

  // public function delete($IC_id) 
  // {
  //     $delete = $this->KPI_model->delete($IC_id);
  //     $this->session->set_flashdata('done', 'IC Details deleted Successfully');
  //     redirect(base_url('IC_Details/update'));
  // }

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
    $data = file_get_contents($fullFilePath); // Read the file's contents
    $name = explode('/', $filePath);
    print_r($data);
    exit;
    force_download($name[count($name) - 1], $data);
    exit;
  }
}
