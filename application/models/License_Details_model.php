<?php

class License_Details_model extends CI_Model
{

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('License_Details');
        // $this->db->join('Projects', 'Projects.ProjectCode = Shifts.ProjectID', 'LEFT');
        // $this->db->where('Active', 1);
        if (in_array($this->session->userdata('Role'), array(2))) {
            $this->db->where('License_Details.CreatedBy', $this->session->userdata('UserUID'));
        }
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('License_Details', $data);
        return $this->db->insert_id();
    }

    // public function getDataById($id)
    // {
    //     $this->db->where('ShiftID', $id);
    //     return $this->db->get('Shifts')->row();
    // }

    // public function getDataByprojectId($id)
    // {
    //     $this->db->where('ProjectID', $id);
    //     return $this->db->get('Shifts')->result();
    // }

    // public function update($id, $data)
    // {
    //     $this->db->where('ShiftID', $id);
    //     $this->db->update('Shifts', $data);
    //     return true;
    // }

    // public function delete($id)
    // {
    //     $this->db->where('ShiftID', $id);
    //     $this->db->delete('Shifts');
    //     return true;
    // }

    // public function changeStatus($id)
    // {
    //     $table = $this->getDataById($id);
    //     if ($table[0]->status == 0) {
    //         $this->update($id, array('status' => '1'));
    //         return "Activated";
    //     } else {
    //         $this->update($id, array('status' => '0'));
    //         return "Deactivated";
    //     }
    // }
}
