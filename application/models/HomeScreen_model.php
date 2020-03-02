<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeScreen_model extends CI_Model
{

    function getShifts($shiftId, $month)
    {
        $this->db->select('Shifts.AvailableBookings as AvailableBookings, booking.StartDate as BookedDate, COUNT(booking.StartDate) as BookingsCount');
        $this->db->from('Shifts');
        $this->db->where('Shifts.ShiftID', $shiftId);
        $this->db->join('booking', 'Shifts.ShiftID = booking.ShiftNumber', 'LEFT');
        $this->db->Group_By('booking.StartDate');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
        // $this->db->select('*,COUNT(booking.StartDate) as BookingsCount');
        // $this->db->from('booking');
        // $this->db->join('Shifts', 'Shifts.ShiftID = booking.ShiftNumber', 'LEFT');
        // $this->db->Group_By('booking.StartDate');
        // $q = $this->db->get();
        // if ($q->num_rows() > 0) {
        //     return $q->result();
        // } else {
        //     return array();
        // }
    }
}
