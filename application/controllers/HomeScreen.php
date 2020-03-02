<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeScreen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('HomeScreen_model');
        $this->load->model('Shifts_model');
    }

    public function index()
    {
        $data['Title'] = 'Home Screen';
        $data["shiftDetails"] = $this->Shifts_model->getAll();
        $this->load->view('home_screen', $data);
    }
    public function getShifts()
    {
        $shiftId = $this->input->get('shiftId');
        $month = $this->input->get('month');
        $data['bookingCount'] = $this->HomeScreen_model->getShifts($shiftId, $month);

        echo json_encode($data['bookingCount']);
        exit;
    }
}
