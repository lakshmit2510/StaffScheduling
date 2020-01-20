<?php

class AirportPass_model extends CI_Model 
{

    public function getAll() 
    {
        $this->db->select('*');
        return $this->db->get('Airport_Pass_Details')->result();
    }

    public function insert($data) {
        $this->db->insert('Airport_Pass_Details', $data);
        return $this->db->insert_id();
    }

    public function getDataById($id) {
        $this->db->where('PassID', $id);
        return $this->db->get('Airport_Pass_Details')->row();
    }
    

    public function update($id,$data) {
        $this->db->where('PassID', $id);
        $this->db->update('Airport_Pass_Details', $data);
        return true;
    }
    

    public function delete($id) {
        $this->db->where('PassID', $id);
        $this->db->delete('Airport_Pass_Details');
        return true;
    }
    
    
    public function changeStatus($id) {
        $table=$this->getDataById($id);
             if($table->Active==0)
             {
                $this->update($id,array('Active' => '1'));
                return 1;
             }else{
                $this->update($id,array('Active' => '0'));
                return 0;
             }
    }

}