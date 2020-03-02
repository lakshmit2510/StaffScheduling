<?php

class Shifts_model extends CI_Model
{


    public function getAll()
    {
        $this->db->where('Active', 1);
        // $this->db->join('users', 'users.UserUID = Shifts.CreatedBy', 'LEFT');
        // if (in_array($this->session->userdata('Role'), array(2))) {
        //     $this->db->where('Shifts.CreatedBy', $this->session->userdata('UserUID'));
        // }
        return $this->db->get('Shifts')->result();
    }

    public function insert($data)
    {
        $this->db->insert('Shifts', $data);
        return $this->db->insert_id();
    }

    public function getDataById($id)
    {
        $this->db->where('ShiftID', $id);
        return $this->db->get('Shifts')->row();
    }

    public function update($id, $data)
    {
        $this->db->where('ShiftID', $id);
        $this->db->update('Shifts', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('ShiftID', $id);
        $this->db->delete('Shifts');
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
