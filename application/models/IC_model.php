<?php

class IC_model extends CI_Model
{


    public function getAll()
    {
        $this->db->join('visatypes', 'visatypes.TypeID = IC_Details.ICTypeID', 'LEFT');
        $this->db->join('users', 'users.UserUID = IC_Details.FullName', 'LEFT');
        if (in_array($this->session->userdata('Role'), array(2))) {
            $this->db->where('IC_Details.FullName', $this->session->userdata('UserUID'));
        }
        return $this->db->get('IC_Details')->result();
    }

    function getVisaType()
    {
        $this->db->where('Active', 1);
        $this->db->order_by('Type', 'ASC');
        return $this->db->get('visatypes')->result();
    }

    public function insert($data)
    {
        $this->db->insert('IC_Details', $data);
        return $this->db->insert_id();
    }

    public function getDataById($id)
    {
        // $this->db->select('*, users.FullName');
        $this->db->where('ID', $id);
        // $this->db->join('users', 'users.UserUID = IC_Details.FullName', 'LEFT');
        return $this->db->get('IC_Details')->row();
    }

    public function update($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('IC_Details', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('IC_Details');
        return true;
    }

    public function changeStatus($id)
    {
        $table = $this->getDataById($id);
        if ($table[0]->status == 0) {
            $this->update($id, array('status' => '1'));
            return "Activated";
        } else {
            $this->update($id, array('status' => '0'));
            return "Deactivated";
        }
    }
}
