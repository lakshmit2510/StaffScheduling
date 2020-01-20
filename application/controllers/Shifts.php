<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shifts extends CI_Controller
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
    $this->load->model('Shifts_model');
  }

  public function index()
  {
    $data['Title'] = '';
    $data['Page'] = 'Dashboard';
    $data["shift_Details"] = $this->Shifts_model->getAll();
    $this->load->view('', $data);
  }

  public function addShiftsPost()
  {
    $data['AvailableBookings'] = $this->input->post('Bookingscount');
    $data['StartTime'] = $this->input->post('StartTime');
    $data['EndTime'] = $this->input->post('Endtime');
    $data['Active'] = 1;
    $this->Shifts_model->insert($data);
    $this->session->set_flashdata('done', 'New Card added Successfully');
    redirect(base_url(''));
  }
}
