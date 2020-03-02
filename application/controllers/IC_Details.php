<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IC_Details extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('is_loggin')){ redirect(base_url('Login')); }
        if(!in_array($this->session->userdata('Role'), array(1,2,3,4))) { redirect('Dashboard'); exit; }
        $this->load->model('IC_model');
    }

    public function index() 
    { 
      $data['Title'] = 'List of IC Details';
      $data['Page'] = 'IC';
      $data["IC_Details"] = $this->IC_model->getAll();
      $this->load->view('list_IC', $data);
    }
    
    public function add() 
    {
      $data['Title'] = 'Add IC Details';
      $data['Page'] = 'IC';
      $data['vtype'] = $this->IC_model->getVisaType();
      $data['Users'] = $this->Common_model->getTableData('users');
      $this->load->view('add-ic-details', $data);
    }

    public function update() 
    {
      $data['Title'] = 'Update IC Information';
      $data['Page'] = 'IC';
      $data["IC_Details"] = $this->IC_model->getAll();
      $this->load->view('update_IC_list', $data);
    }

    public function addICDetailsPost() 
    {
        $data['ICNumber'] = $this->input->post('ICNumber');
        $data['ICTypeID'] = $this->input->post('Type');
        $data['FullName'] = $this->input->post('ICName');
        $data['DateOfBirth'] = $this->input->post('DOB');
        $data['CountryOfBirth'] = $this->input->post('Nationality');
        $data['DateOfIssue'] = $this->input->post('DateofIssue');
        $data['Gender'] = $this->input->post('Gender');
        $data['Race'] = $this->input->post('race');
        $data['CreatedBy'] = $this->session->userdata('UserUID');
        $this->IC_model->insert($data);
        $this->session->set_flashdata('done', 'IC details added Successfully');
        redirect(base_url('IC_Details/update'));
    }
    

    public function edit($IC_id) 
    {
        $data['Title'] = 'Edit IC Details';
        $data['Page'] = 'IC';
        $data['IC_id'] = $IC_id;
        $data['IC_Details'] = $this->IC_model->getDataById($IC_id);
        $data['vtype'] = $this->Common_model->getTableData('visatypes');
        $this->load->view('edit-IC-details', $data);
    }
    

    public function editICDetailsPost() 
    {
        $IC_id = $this->input->post('IC_id');
        $IC_Details = $this->IC_model->getDataById($IC_id);
        $data['ICNumber'] = $this->input->post('ICNo');
        $data['ICTypeID'] = $this->input->post('Type');
        $data['FullName'] = $this->input->post('fullname');
        $data['DateOfBirth'] = $this->input->post('DOB');
        $data['CountryOfBirth'] = $this->input->post('Nationality');
        $data['DateOfIssue'] = $this->input->post('DateofIssue');
        $data['Gender'] = $this->input->post('Gender');
        $data['Race'] = $this->input->post('Race');
        $edit = $this->IC_model->update($IC_id,$data);
        if ($edit) {
            $this->session->set_flashdata('done', 'IC Details updated Successfully');
            redirect(base_url('IC_Details/update'));
        }
    }
    

    // public function viewVehicle($vehicle_id) 
    // {
    //     $data['vehicle_id'] = $vehicle_id;
    //     $data['vehicle'] = $this->IC_model->getDataById($vehicle_id);
    //     $this->load->view('view-vehicle', $data);
    // }

    public function delete($IC_id) 
    {
        $delete = $this->IC_model->delete($IC_id);
        $this->session->set_flashdata('done', 'IC Details deleted Successfully');
        redirect(base_url('IC_Details/update'));
    }
    
    // public function changeStatusVehicle($vehicle_id) 
    // {
    //     $edit = $this->IC_model->changeStatus($vehicle_id);
    //     $this->session->set_flashdata('done', 'vehicle '.$edit.' Successfully');
    //     redirect(base_url('IC_Details'));
    // }
    
}
