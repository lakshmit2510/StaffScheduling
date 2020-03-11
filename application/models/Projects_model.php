<?php

class Projects_model extends CI_Model
{
    public function getAll()
    {
        $this->db->where('Active', 1);
        return $this->db->get('Projects')->result();
    }

    public function insert($data)
    {
        $this->db->insert('Projects', $data);
        return $this->db->insert_id();
    }

    public function updateProject($data, $id)
    {
      $this->db->where('ProjectCode', $id);
      $this->db->update('Projects', $data);
    }

    public function getDataById($id)
    {
        $this->db->where('ProjectCode', $id);
        return $this->db->get('Projects')->row();
    }
}