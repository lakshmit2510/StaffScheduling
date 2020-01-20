<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller 
{

  function __construct()
  {
     parent::__construct();
    if(!$this->session->userdata('is_loggin')){ redirect(base_url('Login')); }
     $this->load->model('Booking_model');
     $this->load->model('User_model');
     $this->load->model('IC_model');
  }

  public function index($filter='')
  {
    $data['Title'] = 'Booking Details'; 
    $data['Page'] = 'Booking';
    // $data['booking'] = $this->Booking_model->getBookingDetail();
    $this->load->view('list_booking',$data);
  }

  public function editBooking($Booking_id){
      $data['Title'] = 'Edit Booking Details';
      $data['Page'] = 'Booking';
      $data['Booking_id'] = $Booking_id;
      $data['vnumber'] = $this->Common_model->getVehcileNo();
      $data['booking'] = $this->Booking_model->getBookingDetailID($Booking_id);
      $this->load->view('edit_booking', $data);
  }

  public function editBookingPost($id){
      if(empty($id)) { redirect($_SERVER['HTTP_REFERER']); };
      $data['VType'] = $this->input->post('VType');
      $data['VNo'] = $this->input->post('VNumber');
      $data['DriverName'] = $this->input->post('Driver');
      $this->Booking_model->updateBooking($data, $id);
      $this->session->set_flashdata('done', 'Booking has been Updated Successfully');
      redirect(base_url('Booking'));
  }

  public function Today()
  {
    if(!in_array($this->session->userdata('Role'), array(1,2,3))) { redirect('Dashboard'); exit; }
    $data['Title'] = "Today's Shipments"; 
    $data['Page'] = 'Today';
    // $data['booking'] = $this->Booking_model->getBookingDetail('Today');
    $this->load->view('list_booking',$data);
  }

  public function DeliveryFailed()
  {
    if(!in_array($this->session->userdata('Role'), array(1,2,3))) { redirect('Dashboard'); exit; }
    $data['Title'] = "Delivery Failed Shipments"; 
    $data['Page'] = 'Delivery Failed';
    $data['booking'] = $this->Booking_model->getBookingDetail('DeliveryFailed');
    $this->load->view('list_booking',$data);
  }

  public function Past()
  {
    if(!in_array($this->session->userdata('Role'), array(1,2,3))) { redirect('Dashboard'); exit; }
    $data['Title'] = 'Past Shipments'; 
    $data['Page'] = 'Past';
    $data['booking'] = $this->Booking_model->getBookingDetail('Past');
    $this->load->view('list_booking',$data);
  }

  public function Tomorrow()
  {
    if(!in_array($this->session->userdata('Role'), array(1,2,3))) { redirect('Dashboard'); exit; }
    $data['Title'] = 'Tomorrow Shipments'; 
    $data['Page'] = 'Tomorrow';
    $data['booking'] = $this->Booking_model->getBookingDetail('Tomorrow');
    $this->load->view('list_booking',$data);
  }

  public function Upcoming()
  {
    $data['Title'] = 'Upcoming Shipments'; 
    $data['Page'] = 'Upcoming';
    //$data['booking'] = $this->Booking_model->getBookingDetail('Upcoming');
    $this->load->view('list_booking',$data);
  }

  function Add()
  {
    if(!in_array($this->session->userdata('Role'), array(1,2,3))) { redirect('Dashboard'); exit; }
    $data['Title'] = 'Add New Booking'; 
    $data['Page'] = 'Add';
    // $data['vtype'] = $this->Common_model->getTableData('vechicletype','Active');
    // $data['vnumber'] = $this->Common_model->getVehcileNo();
    $data['ICDetails'] = $this->IC_model->getAll();
    // $data['company'] = $this->Common_model->getTableData('company','Active');
    $data['mode'] = $this->Common_model->getTableData('bookingmode','Active');
    $this->load->view('add_booking',$data);
  }

  function BPrint($refno)
  {
    $data['Title'] = 'Print Booking Details'; 
    $data['Page'] = 'Add';
    $data['RefNo'] = $refno;
    $this->load->view('print_booking',$data);
  }
   
  function save()
  {
    $this->load->library('ciqrcode');
    $response = ['errors'=>0,'message'=>""];

    $DaysCount = intval($this->input->post('DaysCount'));
    $POArray = explode($this->input->post('PONumber'),',');
    $timeSlot = $this->input->post('Slot');
    $SlotType = $this->input->post('SlotType');

    $Date = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('date'))));
    
    $fileUploaded = $this->upload_file('Booking',false,'upload_file');

    $checkInTimeArray = array();
    $unAvailableSlots = $this->Booking_model->bookedSlotOnDate($SlotType,$Date,$DaysCount);


    if($response['errors'] != 0){
      $this->session->set_flashdata('msg','Some selected slot(s) are not available. Please try again!.');
      $this->session->set_flashdata('type','error');
      redirect(base_url('Booking/Add'));
    }


    $faildBookings = [];
    $RefNoList = [];
  
    foreach ($checkInTimeArray as $checkin) {
      $CheckOut = date('Y-m-d H:i:s', strtotime($checkin. ' +1 hour'));
      $booked = $this->Booking_model->getMax();
      $data['BookingRefNo'] = 'SATS'.date('Y').str_pad($booked, 4, '0', STR_PAD_LEFT);
      // $data['UserType'] = $this->input->post('UserType');
      $data['CompanyUID'] = $this->input->post('DeliveryTo');
      $data['DriverName'] = $this->input->post('Driver');
      $data['VType'] = $this->input->post('VType');
      $data['AttachedFiles'] = '';//$fileUploaded['file_path'];
      $data['VNo'] = $this->input->post('VNumber');
      $data['PONumber'] = $this->input->post('PONumber');
      $data['DONumber'] = $this->input->post('DONumber');
      $data['CheckIn'] = $checkin;  
      $data['CheckOut'] = $CheckOut;
      $data['BuildingName'] = $this->input->post('BuildingName');
      $data['DeliveryTo'] = $this->input->post('DeliveryTo');
      $data['BookMode'] = $this->input->post('Mode');
      $data['SlotType'] = $this->input->post('SlotType');
      $data['SlotNos'] = $this->input->post('SlotNos');
      $data['BillNo'] = $this->input->post('BillNo');
      $data['BLNo'] = $this->input->post('BLNo');
      // $data['BuildingAddress'] = $this->input->post('Address');
      $data['CreatedBy'] = $this->session->userdata('UserUID');
      $data['status'] = 1;
      //$slot = $this->input->post('Docks');
      $slot = [1];
    

      $params['data'] = 'JOB-'.$data['CreatedBy'].'-'.date('Y-m-d',strtotime($checkin));
      $params['level'] = 'H';
      $params['size'] = 10;
      if(!file_exists('assets/QRCode'))
      {
        mkdir('assets/QRCode', 0777, true);
      }

      $params['savename'] = 'assets/QRCode/QR'.$data['BookingRefNo'].'.png';
      $this->ciqrcode->generate($params);
      $data['QRCode'] = $params['savename'];

      $store = $this->Booking_model->SaveBooking($data,$slot);
      if($store != 0)
      {
        
        try {
          $Old = $this->User_model->getUserdetails($this->session->userdata('UserUID'));
          $this->config_email();
          $mail_data = $data;
          $mail_data['mail_title'] = 'Your Booking Details - SATS Dock Management System';
          $mail_data['RefNo'] = $data['BookingRefNo'];
          $from_email = "support@satsez.com"; 
          $this->email->from($from_email,'Satsez.com'); 
          $this->email->to($Old->EmailAddress1); #$Old->EmailAddress1;
          if(!empty($Old->EmailAddress2))
          {
          $this->email->cc($Old->EmailAddress2);
          }
          $this->email->subject('Thank you. Your Booking Details - SATS Dock Management System'); 
          $mes_body=$this->load->view('email/email-template.php',$mail_data,true);// load html templates
          $this->email->message($mes_body); 
          $this->email->send(); 
        } catch (Exception $e) {
          //throw $th;
        }

        array_push($RefNoList,$mail_data['RefNo']);
      } else {
        array_push($faildBookings,$checkin);
      } 
    }

    
    
    
    if(!empty($RefNoList)){
      if(empty($faildBookings)){
        $this->session->set_flashdata('msg','Booking completed successfully!');
        $this->session->set_flashdata('type','done');
      }
      else{
        $done_count = count($RefNoList);
        $total_count = count($checkInTimeArray);

        $this->session->set_flashdata('msg',"Only {$done_count} of {$total_count} bookings are success!");
        $this->session->set_flashdata('type','warning');
      }
      
      redirect(base_url('Booking/Confirm/'.implode(",",$RefNoList)));
    }
    else{
      $this->session->set_flashdata('msg',"Booking faild. Please try again!.");
      $this->session->set_flashdata('type','error');
      redirect(base_url('Booking/Add'));    
    }        
    

  }
  public function upload_file($sub_folder,$extensions,$name){
        $uploadData = array();
        if(!empty($_FILES[$name]['name'])){
            $filesCount = count($_FILES[$name]);
            $root_folder = $this->config->item('upload_file_path');
            $root_extensions = $this->config->item('upload_file_extensions');
            $root_file_size = $this->config->item('upload_file_size');
//            $_FILES['upload_File']['name'] = $_FILES[$name]['name'];
//            $_FILES['upload_File']['type'] = $_FILES[$name]['type'];
//            $_FILES['upload_File']['tmp_name'] = $_FILES[$name]['tmp_name'];
//            $_FILES['upload_File']['error'] = $_FILES[$name]['error'];
//            $_FILES['upload_File']['size'] = $_FILES[$name]['size'];
            $config = array(
                'upload_path' => $root_folder.$sub_folder,
                'allowed_types' => $extensions ? $extensions : $root_extensions,
                'overwrite' => TRUE,
                'remove_spaces'=> FALSE,
                'max_size' => $root_file_size,
            );
            $this->load->library('upload', $config);
//            $this->upload->initialize($config);
            if($this->upload->do_upload($name)){
                $fileData = $this->upload->data();
                if($fileData){
                    $uploadData['file_path'] = $sub_folder.'/'.$_FILES[$name]['name'];
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
            }
        }
        return $uploadData;
    }

  function cancel($id)
  {
    if(empty($id)) { redirect($_SERVER['HTTP_REFERER']); };
    $data['Active'] = 0;
    $data['status'] = 6;
    $cancel = $this->Booking_model->updateBooking($data, $id);
    $this->session->set_flashdata('done', 'Booking has been Cancelled Successfully');
    redirect($_SERVER['HTTP_REFERER']);   
  }

  function CheckIn($id)
  {
    if(empty($id)) { redirect($_SERVER['HTTP_REFERER']); };

    $book = $this->Booking_model->getBookingDetailID($id);
    $now = date('Y-m-d H:i:s');
    $datetime1 = strtotime($book->CheckIn);
    $datetime2 = strtotime($now);
    if($now > $book->CheckIn) // Late CheckIn
    {
      $interval  = $datetime2 - $datetime1;
      $minutes   = round($interval / 60);
      if($minutes > 15)
      {
        $this->session->set_flashdata('ErrorCheckIn',1);
        $this->session->set_flashdata('MsgCheckIn','<b style="color:red">"LATE ARRIVAL"</b> REFER TO SATS PURCHASING.');
        redirect($_SERVER['HTTP_REFERER']);
        exit;
      }
    } else {  // Earliy CheckIn
      $interval  = $datetime1 - $datetime2;
      $minutes   = round($interval / 60);
      if($minutes > 15)
      {
       $this->session->set_flashdata('ErrorCheckIn',1); 
       $this->session->set_flashdata('MsgCheckIn','<b style="color:red">"TOO EARLIY"</b> PLEASE JOIN THE QUEUE LATER.'); 
       redirect($_SERVER['HTTP_REFERER']);
       exit;
      }
    }

    $data['ActualCheckIn'] = date('Y-m-d H:i:s');
    $data['status'] = 2;
    $cancel = $this->Booking_model->updateBooking($data, $id);
    $this->session->set_flashdata('done', 'Booking has been Checked-In Successfully');
    redirect($_SERVER['HTTP_REFERER']);   
  }

  function Verify()
  {
    $RefNo = $this->input->post('RefNo');
    $detail = $this->Booking_model->getBookingDetailID($RefNo,'RefNo');
    if(is_object($detail))
    {
      if(empty($detail->ActualCheckIn) || $detail->ActualCheckIn == NULL)
      {
        $now = date('Y-m-d H:i:s');
        $datetime1 = strtotime($detail->CheckIn);
        $datetime2 = strtotime($now);
        if($now > $detail->CheckIn) // Late CheckIn
        {
          $interval  = $datetime2 - $datetime1;
          $minutes   = round($interval / 60);
          if($minutes > 15)
          {
            $msg = array('error'=>100,'Msg'=>'<b style="color:red">"LATE ARRIVAL"</b>&nbsp;&nbsp;REFER TO SATS PURCHASING. The Job Order No : <b>'.$RefNo.'</b>');
            echo json_encode($msg);
            exit;
          }
        } else {  // Earliy CheckIn
          $interval  = $datetime1 - $datetime2;
          $minutes   = round($interval / 60);
          if($minutes > 15)
          {
           $msg = array('error'=>100,'Msg'=>'<b style="color:red">"TOO EARLIY"</b> PLEASE JOIN THE QUEUE LATER. The Job Order No : <b>'.$RefNo.'</b>');
           echo json_encode($msg);
           exit;
         }
        }
        $data['ActualCheckIn'] = $now;
        $data['status'] = 2;
        $this->Booking_model->updateBooking($data, $detail->BookingID);
        $msg = array('error'=>0,'status'=>2);
      } else if((!empty($detail->ActualCheckIn) || !$detail->ActualCheckIn == NULL) && empty($detail->ActualCheckOut) || $detail->ActualCheckOut == NULL) 
      {
        $now = date('Y-m-d H:i:s');
        $datetime1 = strtotime($now);
        $datetime2 = strtotime($detail->ActualCheckIn);
        $interval  = $datetime1 - $datetime2;
        $minutes   = round($interval / 60);
        if($minutes < 10) // Eairly CheckOut
        {
          $msg = array('error'=>100,'Msg'=>'<b style="color:red">"TOO EARLIY CHECKOUT"</b> PLEASE JOIN THE QUEUE LATER. The Job Order No : <b>'.$RefNo.'</b>');
          echo json_encode($msg);
          exit;
        }
        $data['ActualCheckOut'] = date('Y-m-d H:i:s');
        $data['status'] = 3;
        $this->Booking_model->updateBooking($data, $detail->BookingID);
        $msg = array('error'=>0,'status'=>3); 
      } else {
        $msg = array('error'=>1);
      }
      echo json_encode($msg);
    } else {
      echo json_encode(array('error'=>1));
    }
  }

  function Sendmail($id)
  {
    $this->config_email();
    $book = $this->Booking_model->getBookingDetailID($id);
    $Old = $this->User_model->getUserdetails($book->BookedBy);
    $data['RefNo'] = $book->BookingRefNo;
    $data['mail_title'] = 'Your Booking Details - SATS Dock Management System';
    $from_email = "support@satsez.com"; 
    $this->email->from($from_email,'Satsez.com'); 
    $this->email->to($Old->EmailAddress1); #$Old->EmailAddress1;
    if(!empty($Old->EmailAddress2))
    {
      $this->email->cc($Old->EmailAddress2);
    }
    $this->email->subject('Your Booking Details - SATS Dock Management System'); 
    $mes_body=$this->load->view('email/email-template.php',$data,true);// load html templates
    $this->email->message($mes_body); 
    if($this->email->send())
    {
      $this->session->set_flashdata('done',$data['RefNo'].' email send Successfully. Please Check booked email address inbox (or) spam.');
      $this->session->set_flashdata('type','done');
    } else {
      $this->session->set_flashdata('error','Cannot able to send mail. Try again!.');
    } 
    redirect($_SERVER['HTTP_REFERER']);
  }

  function Confirm($book='')
  {
    if(empty($book)) { redirect('Booking'); exit; }
    $data['Title'] = 'Booking'; 
    $data['Page'] = 'Booking';
    $data['RefNos'] = $book;
    $this->load->view('booking_confirmed',$data);
  }  

  function Verified($book='',$status)
  {
    $data['Title'] = 'Booking'; 
    $data['Page'] = 'Booking';
    $data['QR'] = 'Yes';
    $data['RefNo'] = $book;
    $data['status'] = $this->Common_model->getStatusById($status);
    $this->load->view('booking_confirmed',$data);
  }  

  public function config_email()
  {
    $config = Array( 
      'charset'   => 'iso-8859-1',
      'newline' => '\r\n',
      'starttls'  => true,
      'wordwrap'  =>  true ); 
    $emailconf = $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    return $emailconf;
  }

  private function validateDate($date, $format = 'd/m/Y')
  {
      $d = DateTime::createFromFormat($format, $date);
      return $d && $d->format($format) === $date;
  }


}
