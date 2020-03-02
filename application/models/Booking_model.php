<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{

  function shiftDetailsOnDate($date)
  {
    // print_r($date);
    // exit;
    $this->db->select('*, COUNT(booking.StartDate) as Count');
    $this->db->from('booking');
    $this->db->join('Shifts', 'booking.ShiftNumber = Shifts.ShiftID', 'INNER');
    $this->db->where('StartDate', $date);
    $this->db->Group_By('booking.ShiftNumber','booking.StartDate');
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
