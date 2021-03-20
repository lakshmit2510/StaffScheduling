<?php
defined('BASEPATH') or exit('No direct script access allowed');

class License_Details extends CI_Controller
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
    $this->load->model('License_Details_model');
  }

  public function index()
  {
    $data['Title'] = 'Employee License Details';
    $data['Page'] = 'License Details';
    $data["License_Details"] = $this->License_Details_model->getAll();
    $this->load->view('list_license_details', $data);
  }

  public function add()
  {
    $data['Title'] = 'Add License Details';
    $data['Page'] = 'License Details';
    $data['Users'] = $this->Common_model->getTableData('users');
    $this->load->view('add_license_details', $data);
  }

  public function addLicenseDetailsPost()
  {
    $data['StaffName'] = $this->input->post('ADPHolderName');
    $data['LicenseNumber'] = $this->input->post('licenseNumber');
    $data['LicenseType'] = $this->input->post('LicenseCategory');
    $data['LicenseSubType'] = $this->input->post('LicenseSubCategory');
    $data['IssueDate'] = $this->input->post('LicenseIssueDate');
    $data['ExpiryDate'] = $this->input->post('LicenseExpiryDate');
    $data['CreatedBy'] = $this->session->userdata('UserUID');
    $this->License_Details_model->insert($data);
    $this->session->set_flashdata('done', 'License details added Successfully');
    redirect(base_url('License_Details'));
  }

}
