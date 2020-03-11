<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_loggin')) {
            redirect(base_url('Login'));
        }
        if (!in_array($this->session->userdata('Role'), array(1, 2))) {
            redirect('Dashboard');
            exit;
        }
        $this->load->model('Shifts_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Projects_model');
    }

    public function index()
    {
        $data['Title'] = 'Project Details';
        $data['Page'] = 'Projects';
        $data['Projects'] = $this->Projects_model->getAll();
        // print_r($data['Projects']);
        // exit;
        $this->load->view('list_Projects', $data);
    }

    public function addNewProject()
    {
        $data['Title'] = 'Add Project Details';
        $data['Page'] = 'Projects';
        $this->load->view('add_new_project', $data);
    }

    public function addNewProjectPost()
    {
        $data['ProjectName'] = $this->input->post('ProjectName');
        $data['Location'] = $this->input->post('location');
        $data['ProjectSupervisor'] = $this->input->post('supervisor');
        $data['ProjectManager'] = $this->input->post('manager');
        $data['CreatedBy'] = $this->session->userdata('UserUID');
        $this->Projects_model->insert($data);
        $this->session->set_flashdata('done', 'Project details added Successfully');
        redirect(base_url('Projects'));
    }

    public function edit($id)
    {
        $data['Title'] = 'Edit Project Details';
        $data['Page'] = 'Projects';
        $data['Project_Details'] = $this->Projects_model->getDataById($id);
        $this->load->view('edit_Projects', $data);
    }

    public function editProjectDetailsPost()
    {
        $Project_id = $this->input->post('ProjectCode');
        $data['ProjectName'] = $this->input->post('projectname');
        $data['Location'] = $this->input->post('location');
        $data['ProjectSupervisor'] = $this->input->post('supervisor');
        $data['ProjectManager'] = $this->input->post('manager');
        $this->Projects_model->updateProject($data, $Project_id);
        $this->session->set_flashdata('done', 'Project Details updated Successfully');
        redirect(base_url('Projects'));
    }

    function delete($id)
    {
        if (empty($id)) {
            redirect($_SERVER['HTTP_REFERER']);
        };
        $data['Active'] = 0;
        $cancel = $this->Projects_model->updateProject($data, $id);
        $this->session->set_flashdata('done', 'Project has been Deleted Successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
