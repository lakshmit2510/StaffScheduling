<?php

class AirportPass extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_loggin')) {
      redirect(base_url('Login'));
    }
    // if(!in_array($this->session->userdata('Role'), array(1,3))) { redirect('Dashboard'); exit; }
    $this->load->model('AirportPass_model');
  }

  public function index()
  {
    $data['Title'] = 'List of AirportPasses';
    $data['Page'] = 'AirportPasses';
    $data["AirportPass"] = $this->AirportPass_model->getAll();
    $this->load->view('list_airportpass', $data);
  }


  public function add()
  {
    $data['Title'] = 'Add New Airport Pass Details';
    $data['Page'] = 'AddAirportPass';
    $this->load->view('add_airportpass_details', $data);
  }

  public function update()
  {
    $data['Title'] = 'Update IC Information';
    $data['Page'] = 'AirportPass';
    $data["AirportPass"] = $this->AirportPass_model->getAll();
    $this->load->view('update_AirportPass_list', $data);
  }

  public function addAirportPass()
  {
    $data['PassNumber'] = $this->input->post('PassNumber');
    $data['AirportPassName'] = $this->input->post('PassName');
    $data['DateOfExpiry'] = $this->input->post('DOE');
    $this->AirportPass_model->insert($data);
    $this->session->set_flashdata('done', 'New Airport Pass Number added Successfully');
    redirect('AirportPass');
  }

  public function editPassDetails($pass_id)
  {
    $data['slots_id'] = $pass_id;
    $data['Title'] = 'AirportPass';
    $data['Page'] = 'AirportPass';
    $data['passDetails'] = $this->AirportPass_model->getDataById($pass_id);
    $data['slottype'] = $this->Common_model->getTableData('slottypes', 'Active');
    $this->load->view('edit_airportPass_Details', $data);
  }


  public function editPassDetailsPost()
  {
    $pass_id = $this->input->post('ID');
    $airportpass = $this->AirportPass_model->getDataById($pass_id);
    $data['PassNumber'] = $this->input->post('PassNumber');
    $data['AirportPassName'] = $this->input->post('PassName');
    $data['DateOfExpiry'] = $this->input->post('DOE');
    $edit = $this->AirportPass_model->update($pass_id, $data);
    if ($edit) {
      $this->session->set_flashdata('done', 'Airport Pass details Updated Successfully');
      redirect('AirportPass');
    }
  }


  public function deleteSlots($slots_id)
  {
    $delete = $this->AirportPass_model->delete($slots_id);
    $this->session->set_flashdata('done', 'Docks deleted');
    redirect('Docks');
  }


  public function changeStatus($slots_id)
  {
    $edit = $this->AirportPass_model->changeStatus($slots_id);
    if (empty($edit)) {
      $this->session->set_flashdata('done', 'Docks closed Successfully');
    } else {
      $this->session->set_flashdata('done', 'Docks opened Successfully');
    }
    redirect('Docks');
  }
}
