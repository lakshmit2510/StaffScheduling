<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class KPI_Login_API extends REST_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('KPI_Login_API_model');
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

    public function getLoginDetails_get($data){

        $login_details = $this->KPI_Login_API_model->CheckAuthendication($data);

        $this->response($login_details, REST_Controller::HTTP_OK);
    }
}
