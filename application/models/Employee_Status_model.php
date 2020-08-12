<?php

class Employee_Status_model extends CI_Model
{
    public function getAll()
    {
        // $this->db->join('visatypes', 'visatypes.TypeID = IC_Details.ICTypeID', 'LEFT');
        // $this->db->join('users', 'users.UserUID = IC_Details.UserID', 'LEFT');
        // if (in_array($this->session->userdata('Role'), array(2))) {
        //     $this->db->where('IC_Details.UserID', $this->session->userdata('UserUID'));
        // }
        return $this->db->get('Employee_Status')->result();
    }

    public function insert($data)
    {
        $this->db->insert('Employee_Status', $data);
        return $this->db->insert_id();
    }

    public function getDataById($id)
    {
        $this->db->where('ID', $id);
        return $this->db->get('Employee_Status')->row();
    }

    public function update($id, $data)
    {
        $this->db->where('ID', $id);
        if ($this->db->update('Employee_Status', $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('Employee_Status');
        return true;
    }
}
