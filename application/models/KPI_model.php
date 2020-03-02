<?php

class KPI_model extends CI_Model
{

    public function insert($data)
    {
        $this->db->insert('Flight_KPI_information', $data);
        return $this->db->insert_id();
    }

    public function getAllEmployeeDetails()
    {
        $this->db->select('*');
        $this->db->where('Role', 2);
        // $q = $this->db->get('users');
        // if($q->num_rows()>0)
        // {
        //   return $q->result();
        // } else { 
        //   return array();
        // }
        return $this->db->get('users')->result();
    }

    public function getAllKpiDetails()
    {
        $this->db->select('*');
        
        return $this->db->get('Flight_KPI_information')->result();
    }
}
