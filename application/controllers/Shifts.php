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
    $this->load->model('Dashboard_model');
  }

  public function index()
  {
    $data['Title'] = 'Shift Details';
    $data['Page'] = 'Shifts';
    $data['Shifts'] = $this->Shifts_model->getAll();
    $this->load->view('shift_details', $data);
  }

  public function addShiftsPost()
  {
    $data['AvailableBookings'] = $this->input->post('Bookingscount');
    $data['StartTime'] = $this->input->post('StartTime');
    $data['EndTime'] = $this->input->post('Endtime');
    $data['Active'] = 1;
    $data['CreatedBy'] = $this->session->userdata('UserUID');
    $bookingCreated = $this->Shifts_model->insert($data);
    if ($bookingCreated) {
      $msg = array('success' => 200, 'Msg' => 'Booking created successfully.');
      echo json_encode($msg);
    } else {
      $msg = array('error' => 100, 'Msg' => 'Error while creating the Booking.');
      echo json_encode($msg);
    }
  }
  public function getAllShifts()
  {
    return $this->Shifts_model->getAll();
  }

  public function editShiftDetails($Id){
    $data['Title'] = 'Edit Shift Details';
    $data['Page'] = 'Dashboard';
    $data['IC_id'] = $Id;
    $data["shift_Details"] = $this->Shifts_model->getDataById($Id);
    $this->load->view('edit_shift_details', $data);
  }

  public function deleteShifts($ShiftID){
    $delete = $this->Shifts_model->delete($ShiftID);
    $this->session->set_flashdata('done', 'Shift details deleted Successfully');
    redirect('Shifts');
  }

  public function editShiftsPost()
  {
    $ShiftId = $this->input->post('Shift_Id');
    $Shift_Details = $this->Shifts_model->getDataById($ShiftId);
    $data['AvailableBookings'] = $this->input->post('Bookingscount');
    $data['StartTime'] = $this->input->post('StartTime');
    $data['EndTime'] = $this->input->post('Endtime');
    $data['Active'] = 1;
    $data['CreatedBy'] = $this->session->userdata('UserUID');
    $bookingUpdated = $this->Shifts_model->update($ShiftId,$data);
    if ($bookingUpdated) {
      $this->session->set_flashdata('done', 'Shift Details updated Successfully');
      redirect('Shifts');
    }
    
  }

}
