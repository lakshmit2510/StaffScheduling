<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model
{


  function getTableData($table, $active = '')
  {
    if (!empty($active)) {
      $this->db->where('Active', 1);
    }
    $q = $this->db->get($table);
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return 0;
    }
  }

  function getUserInfo($UserId)
  {

    $this->db->select('*');
    $this->db->where('UserUID', $UserId);
    $this->db->join('IC_Details', 'IC_Details.UserID = users.UserUID', 'LEFT');
    return $this->db->get('users')->row();
  }

  function getMax($table)
  {
    $this->db->select('count(1) AS Total');
    $r = $this->db->get($table)->row();
    return $r->Total + 1;
  }

  function getStatusById($id)
  {
    $this->db->select('*');
    $this->db->where('StatusID', $id);
    $q = $this->db->get('status')->row();
    return $q->StatusName;
  }
}
