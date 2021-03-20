<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    $this->load->model('Dashboard_model');
    $this->load->model('Booking_model');
    $this->load->model('User_model');
    $this->load->model('Shifts_model');
  }

  public function index()
  {
    $data['Title'] = 'Add Booking';
    $data['Page'] = 'active';
    $Role = 2;
    $UserUID = $this->session->userdata('UserUID');
    $ProjectId = $this->session->userdata('ProjectID');
    $data['UserData'] = $this->Dashboard_model->getUserdetailsById($UserUID);
    $data['Booking_data'] = $this->Booking_model->getBookingDetailByUserId($UserUID);
    
    $data['Users'] = $this->User_model->GetUsers($Role);
    if (!in_array($this->session->userdata('Role'), array(2,3))) {
      // $data['Shifts'] = $this->Shifts_model->getAll();
      $this->load->view('booking_page', $data);
    } else {
      // $data['Shifts'] = $this->Shifts_model->getDataByprojectId($ProjectId);
      $this->load->view('new-dashboard', $data);
    }
  }
  
  public function shiftDetails()
  {
    $data['Title'] = 'Shift Details';
    $data['Page'] = 'Shifts';
    $data['Shifts'] = $this->Shifts_model->getAll();
    $this->load->view('shift_details', $data);
  }

  public function Profile()
  {
    $data['Title'] = 'Profile';
    $data['Page'] = 'profile';
    $data['Profile'] = $this->User_model->getUserdetails($this->session->userdata('UserUID'));
    $this->load->view('profile', $data);
  }

  public function Help()
  {
    $data['Title'] = 'Help';
    $data['Page'] = 'help';
    $this->load->view('help', $data);
  }

  // public function Manual()
  // {
  //   if (in_array($this->session->userdata('Role'), array(1, 3))) {
  //     $data['file'] = base_url('assets/SATSDMS-UserManualCompany.pdf');
  //   } else if ($this->session->userdata('Role') == 5) {
  //     $data['file'] = base_url('assets/SecurityUserManual.pdf');
  //   } else {
  //     $data['file'] = base_url('assets/SATSDMS-UserManual.pdf');
  //   }
  //   $this->load->view('doc_help', $data);
  // }
}
