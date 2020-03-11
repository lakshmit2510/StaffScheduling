<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{

  function shiftDetailsOnDate($date)
  {
    $this->db->select('*, COUNT(booking.StartDate) as Count');
    $this->db->from('booking');
    $this->db->join('Shifts', 'booking.ShiftNumber = Shifts.ShiftID', 'INNER');
    $this->db->where('StartDate', $date);
    $this->db->Group_By('booking.ShiftNumber', 'booking.StartDate');
    $q = $this->db->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return array();
    }
  }

  function getBookingDetailsByRefNo($RefNo)
  {
    $this->db->select('*');
    $this->db->from('booking');
    $this->db->where ('BookingRefNo',$RefNo);
    $q = $this->db->get();
    if ($q->num_rows() > 0) {
      return $q->row();
    } else {
      return array();
    }
  }
  function getBookingDetailByUserId($UserUID)
  {
    $this->db->select('booking.StartDate');
    $this->db->from('booking');
    // $this->db->join('users', 'users.UserUID = booking.CreatedBy', 'LEFT');
    // $this->db->join('IC_Details', 'IC_Details.ID = booking.IC_Number', 'INNER');
    $this->db->order_by('booking.StartDate');
    if (in_array($this->session->userdata('Role'), array(2))) {
      $this->db->where('booking.UserID', $UserUID);
    }

    $q = $this->db->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return array();
    }
  }

  function SaveBooking($data)
  {
    $this->db->insert('booking', $data);
    return $this->db->insert_id();
  }

  function getBookingDetails($fdate, $tdate)
  {
    $this->db->select('users.FullName,IC_Details.ICNumber,booking.ShiftStartTime,booking.	ShiftEndTime,booking.StartDate');
    $this->db->from('booking');
    $this->db->join('users', 'users.UserUID = booking.UserID', 'LEFT');
    $this->db->join('IC_Details', 'IC_Details.ID = booking.IC_Number', 'LEFT');
    $this->db->where('StartDate >=', $fdate);
    $this->db->where('StartDate <=', $tdate);
    $this->db->group_by('booking.StartDate');
    $this->db->order_by('booking.StartDate');

    $q = $this->db->get();

    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return array();
    }
  }

  function getMax()
  {
    $this->db->select('count(1) AS Booked');
    $r = $this->db->get('booking')->row();
    return $r->Booked + 1;
  }

  function countOrders()
  {
  }
}
