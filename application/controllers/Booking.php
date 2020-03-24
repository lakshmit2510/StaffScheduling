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
    $shiftID = $this->input->get('shiftId');
    $fdate = date('Y-m-d', strtotime($dateRange[0]));
    $tdate = date('Y-m-d', strtotime($dateRange[1]));
    $datesArr = $this->getDatesFromRange($fdate, $tdate);
    // print_r($datesArr);
    // exit;
    // $data['booking'] = $this->Booking_model->getBookingDetails($fdate, $tdate);
    // print_r($data['booking']);
    // exit;
    $this->getTableDetails($datesArr, $shiftID);
  }

  public function getTableDetails($datesArr, $shiftID)
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
    $bottomRows = array(
      array(
        'employeeName' => 'Empployees Per Day',
        'icNumber' => '',
      ),
      array(
        'employeeName' => 'Required',
        'icNumber' => '',
      ),
      array(
        'employeeName' => 'Net',
        'icNumber' => '',
      )
    );

    foreach ($datesArr as $dateStr) {
      $shifData = $this->Booking_model->getBookingDetails($dateStr, $shiftID);
      $shiftDetails = $this->Shifts_model->getDataById($shiftID);

      $column = array(
        'headerName' => $dateStr,
        'field' => $dateStr,
        'width' => 100,
        'cellRenderer' => 'renderCellContent',
        // 'children' => array(array(
        //   'headerName' => 'IN',
        //   'field' => $value->StartDate . '_' . $value->ShiftStartTime,
        //   'width' => 80
        // ), array(
        //   'headerName' => 'OUT',
        //   'field' => $value->StartDate . '_' . $value->ShiftEndTime,
        //   'width' => 80
        // ))
      );
      // print_r($shifData);
      array_push($columns, $column);
      $bottomRows[0][$dateStr] = count($shifData);
      $bottomRows[1][$dateStr] = $shiftDetails->AvailableBookings;
      $bottomRows[2][$dateStr] = count($shifData) - $shiftDetails->AvailableBookings;
      foreach ($shifData as $key => $value) {
        if (isset($rows[$value->ICNumber])) {
          $rows[$value->ICNumber][$value->StartDate] = 1;
          // $rows[$value->ICNumber][$value->StartDate] = $value->ShiftEndTime;
        } else {
          $rows[$value->ICNumber] = array(
            'employeeName' => $value->FullName,
            'icNumber' => $value->ICNumber,
            $value->StartDate => 1,
            // $value->StartDate . '_' . $value->ShiftEndTime => $value->ShiftEndTime,
          );
        }
      }
    }
    echo json_encode(array('columns' => $columns, 'rows' => array_values($rows), 'bottomRows' => $bottomRows));
  }

  // function Add($Shift_Id)
  // {
  //   if (!in_array($this->session->userdata('Role'), array(1, 2, 3))) {
  //     redirect('Dashboard');
  //     exit;
  //   }
  //   $data['Title'] = 'Add New Booking';
  //   $data['Page'] = 'Add';
  //   $data['Shift_Id'] = $Shift_Id;
  //   $Role = 2;
  //   // $data['Users'] = $this->User_model->GetUsers($Role);
  //   $data['ICDetails'] = $this->IC_model->getAll();
  //   $data['PassDetails'] = $this->AirportPass_model->getAll();
  //   $data['shiftDetails'] = $this->Shifts_model->getDataById($Shift_Id);
  //   $data['mode'] = $this->Common_model->getTableData('bookingmode', 'Active');
  //   $data['Users'] = $this->Common_model->getTableData('users');
  //   $data['company'] = $this->Common_model->getTableData('company', 'Active');
  //   $this->load->view('add_booking', $data);
  // }

  function save()
  {
    $data['FullName'] = $this->input->post('FullName');
    $data['IC_Number'] = $this->input->post('ICNumber');
    $data['UserID'] = $this->input->post('UserId');
    $data['Active'] = 1;
    $data['CreatedBy'] = $this->session->userdata('UserUID');

    $selectedDate = $this->input->post('Day');
    $shifts = $this->input->post('shiftSlot');
    $bookingShiftId = $this->input->post('Shift_Id');
    $confirm_page_data = array();

    foreach ($selectedDate as $key => $value) {

      $booked = $this->Booking_model->getMax();
      $date = date('Y-m-d', strtotime($value));

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
      $this->session->set_flashdata('done', 'Booking details added Successfully');
      redirect(base_url('Dashboard'));
    }
    
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
    $this->email->subject('Thank you. Your Booking Details - EZ Staff Scheduling System');
    // $mes_body = $this->load->view('email/email-template.php', $data, true);
    $this->email->message('Testing the email class.');

    if ($this->email->send()) {
      echo 'Your Email has successfully been sent.';
    } else {
      show_error($this->email->print_debugger());
    }
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
    echo json_encode($booked);
  }

  private function validateDate($date, $format = 'd/m/Y')
  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }
  public function getDatesFromRange($start, $end, $format = 'Y-m-d')
  {
    $array = array();
    $interval = new DateInterval('P1D');
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    foreach ($period as $date) {
      $array[] = $date->format($format);
    }
    return $array;
  }

  function getUserInfo()
  {
    $id = $this->input->post('EmployeeName');

    // print_r($id);
    // exit;

    if (empty($id)) {
      echo json_encode(array());
      exit;
    }
    $info = $this->Common_model->getUserInfo($id);

    if (!empty($info)) {
      $data = json_encode($info);
    } else {
      $data = json_encode(array());
    }
    echo $data;
  }
}
