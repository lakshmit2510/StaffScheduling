<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    $this->load->model('Booking_model');
    $this->load->model('User_model');
    $this->load->model('IC_model');
    $this->load->model('AirportPass_model');
    $this->load->model('Shifts_model');
  }

  public function index($filter = '')
  {
    $data['Title'] = 'Booking Details';
    $data['Page'] = 'Booking';
    // $data['booking'] = $this->Booking_model->getBookingDetail();
    $data["shiftDetails"] = $this->Shifts_model->getAll();
    $this->load->view('list_booking', $data);
  }

  function Add($Shift_Id)
  {
    if (!in_array($this->session->userdata('Role'), array(1, 2, 3))) {
      redirect('Dashboard');
      exit;
    }
    $data['Title'] = 'Add New Booking';
    $data['Page'] = 'Add';
    $data['Shift_Id'] = $Shift_Id;
    $Role = 2;
    // $data['Users'] = $this->User_model->GetUsers($Role);
    $data['ICDetails'] = $this->IC_model->getAll();
    $data['PassDetails'] = $this->AirportPass_model->getAll();
    $data['shiftDetails'] = $this->Shifts_model->getDataById($Shift_Id);
    $data['mode'] = $this->Common_model->getTableData('bookingmode', 'Active');
    $data['Users'] = $this->Common_model->getTableData('users');
    $data['company'] = $this->Common_model->getTableData('company', 'Active');
    $this->load->view('add_booking', $data);
  }

  function save()
  {
    // $data['BookingRefNo'] = $this->input->post('');
    $data['FullName'] = $this->input->post('Fullname');
    $data['Emailaddress'] = $this->input->post('emailid');
    $data['CompanyUID'] = $this->input->post('CompanyName');
    $data['ShiftNumber'] = $this->input->post('Shift_Id');
    $data['IC_Number'] = $this->input->post('IC_Id');
    $data['AirportPassNumber'] = $this->input->post('Pass_Id');
    $data['StartDate'] = $this->input->post('Startdate');
    $data['EndDate'] = $this->input->post('Enddate');
    $data['StartTime'] = $this->input->post('StartTime');
    $data['EndTime'] = $this->input->post('EndTime');
    $data['Active'] = 1;
    $data['CreatedBy'] = $this->session->userdata('UserUID');
    $this->Booking_model->SaveBooking($data);
    $this->session->set_flashdata('done', 'Booking details added Successfully');
    redirect(base_url(''));
  }

  public function editBooking($Booking_id)
  {
    $data['Title'] = 'Edit Booking Details';
    $data['Page'] = 'Booking';
    $data['Booking_id'] = $Booking_id;
    $data['vnumber'] = $this->Common_model->getVehcileNo();
    $data['booking'] = $this->Booking_model->getBookingDetailID($Booking_id);
    $this->load->view('edit_booking', $data);
  }

  public function editBookingPost($id)
  {
    if (empty($id)) {
      redirect($_SERVER['HTTP_REFERER']);
    };
    $data['VType'] = $this->input->post('VType');
    $data['VNo'] = $this->input->post('VNumber');
    $data['DriverName'] = $this->input->post('Driver');
    $this->Booking_model->updateBooking($data, $id);
    $this->session->set_flashdata('done', 'Booking has been Updated Successfully');
    redirect(base_url('Booking'));
  }

  function cancel($id)
  {
    if (empty($id)) {
      redirect($_SERVER['HTTP_REFERER']);
    };
    $data['Active'] = 0;
    $data['status'] = 6;
    $cancel = $this->Booking_model->updateBooking($data, $id);
    $this->session->set_flashdata('done', 'Booking has been Cancelled Successfully');
    redirect($_SERVER['HTTP_REFERER']);
  }

  function Confirm($book = '')
  {
    if (empty($book)) {
      redirect('Booking');
      exit;
    }
    $data['Title'] = 'Booking';
    $data['Page'] = 'Booking';
    $data['RefNos'] = $book;
    $this->load->view('booking_confirmed', $data);
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

  function getAvailableShiftTimings()
  {

    $Date = $this->input->post('selectedDate');

    $Date = date('Y-m-d', strtotime($Date));

    // if(!self::validateDate($Date)) { die(json_encode(['errors'=>1,'message'=>'Invalid Date'])); }

    $booked = $this->Booking_model->shiftDetailsOnDate($Date);

    // print_r($booked);
    // exit;

    echo json_encode($booked);
  }

  private function validateDate($date, $format = 'd/m/Y')
  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }
}
