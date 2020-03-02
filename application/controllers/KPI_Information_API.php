<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class KPI_Information_API extends REST_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('KPI_model');
    }
    public function index()
    {
        $this->load->view('welcome_message');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get($id = 0)
    {
        $directors = array("Alfred Hitchcock");

        $this->response($directors, REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_post()
    {

        $this->response(['Post Working'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_put($id)
    {

        $this->response(['Put Working'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete($id)
    {

        $this->response(['Delete working'], REST_Controller::HTTP_OK);
    }


    public function addNewKPIInformation_post()
    {
        $db_values = array();
        $db_values['FlightNumber'] = $this->post('FlightNumber');
        $db_values['EmployeeID'] = $this->post('Employee');
        $db_values['Weight'] = $this->post('Weight');
        $db_values['Type'] = $this->post('type');
        $db_values['Time'] = $this->post('time');
        $db_values['Date'] = $this->post('date');
        // $db_values['CreatedBy'] = $this->post('BusinessType');

        $this->KPI_model->insert($db_values);

        $this->response(["New KPI Information Added Successfully"], REST_Controller::HTTP_OK);
    }

    public function getEmployeeDetails_get(){

        $employee_details = $this->KPI_model->getAllEmployeeDetails();

        $this->response($employee_details, REST_Controller::HTTP_OK);
    }

    public function getAllKpiDetails_get(){

        $kpi_details = $this->KPI_model->getAllKpiDetails();

        $this->response($kpi_details, REST_Controller::HTTP_OK);
    }
}
