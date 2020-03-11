<?php
defined('BASEPATH') or exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    // $data['booking'] = $this->Booking_model->getBookingDetails();
    // $shiftDetails = $this->getTableDetails($data['booking']);
    $data["shiftDetails"] = $this->Shifts_model->getAll();
    $this->load->view('list_booking', $data);
  }
  public function getShiftDetails()
  {

    $dateRange = explode('-', $this->input->get('dateRange'));
    $fdate = date('Y-m-d', strtotime($dateRange[0]));
    $tdate = date('Y-m-d', strtotime($dateRange[1]));
    $data['booking'] = $this->Booking_model->getBookingDetails($fdate, $tdate);
    $this->getTableDetails($data['booking']);
  }

  public function getTableDetails($shifData)
  {

    $columns = array(
      array(
        'headerName' => "Employee Name",
        'field' => "employeeName",
        'width' => 150
      ),
      array(
        'headerName' => "IC Number",
        'field' => "icNumber",
        'width' => 150
      ),
    );
    $rows = [];
    foreach ($shifData as $key => $value) {
      $column = array(
        'headerName' => $value->StartDate,
        'width' => 100,
        'children' => array(array(
          'headerName' => 'IN',
          'field' => $value->StartDate . '_' . $value->ShiftStartTime,
          'width' => 80
        ), array(
          'headerName' => 'OUT',
          'field' => $value->StartDate . '_' . $value->ShiftEndTime,
          'width' => 80
        ))
      );
      if (isset($rows[$value->ICNumber])) {
        $rows[$value->ICNumber][$value->StartDate . '_' . $value->ShiftStartTime] = $value->ShiftStartTime;
        $rows[$value->ICNumber][$value->StartDate . '_' . $value->ShiftEndTime] = $value->ShiftEndTime;
      } else {
        $rows[$value->ICNumber] = array(
          'employeeName' => $value->FullName,
          'icNumber' => $value->ICNumber,
          $value->StartDate . '_' . $value->ShiftStartTime => $value->ShiftStartTime,
          $value->StartDate . '_' . $value->ShiftEndTime => $value->ShiftEndTime,
        );
      }

      array_push($columns, $column);
    }
    echo json_encode(array('columns' => $columns, 'rows' => array_values($rows)));
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
    $data['FullName'] = $this->input->post('FullName');
    // $data['Emailaddress'] = $this->input->post('EmailAddress');
    // $data['ShiftNumber'] = $this->input->post('Shift_Id');
    $data['IC_Number'] = $this->input->post('ICNumber');
    $data['UserID'] = $this->input->post('UserId');
    $data['Active'] = 1;
    $data['CreatedBy'] = $this->session->userdata('UserUID');

    $selectedDate = $this->input->post('Day');
    // print_r($selectedDate);
    // exit;
    $shifts = $this->input->post('shiftSlot');
    $bookingShiftId = $this->input->post('Shift_Id');
    $confirm_page_data = array();

    foreach ($selectedDate as $key => $value) {

      $booked = $this->Booking_model->getMax();
      $date = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
      // print_r($date);
      // exit;
      $data['BookingRefNo'] = 'EZ' . date('Y') . str_pad($booked, 4, '0', STR_PAD_LEFT);
      $shiftTimings = explode('-', $shifts[$key]);
      $data['StartDate'] = $date;
      $data['ShiftStartTime'] = $shiftTimings[0];
      $data['ShiftEndTime'] = $shiftTimings[1];
      $data['ShiftNumber'] = $bookingShiftId[$key];
      $store = $this->Booking_model->SaveBooking($data);
      if (!empty($store)) {
        array_push($confirm_page_data, $data['BookingRefNo']);
      }
    }
    $this->session->set_flashdata('done', 'Booking details added Successfully');
    redirect(base_url('Dashboard'));
  }

  public function SendEmail()
  {
    $config = array(
      'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
      'smtp_host' => 'smtp.gmail.com',
      'smtp_port' => 465,
      'smtp_user' => 'lakshmi.t2510@gmail.com',
      'smtp_pass' => 'lovelylakshmi',
      'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
      'mailtype' => 'text', //plaintext 'text' mails or 'html'
      'smtp_timeout' => '4', //in seconds
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );
    $this->load->library('email', $config);

    $this->email->from('lakshmi.t2510@gmail.com', 'Test email');
    $this->email->to('lakshmi.t2510@gmail.com');

    $this->email->set_newline("\r\n");
    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');

    if ($this->email->send()) {
      echo 'Your Email has successfully been sent.';
    } else {
      show_error($this->email->print_debugger());
    }
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
