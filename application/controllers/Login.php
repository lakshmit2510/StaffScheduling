<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Login_model');
  }

  public function index()
  {
    if ($this->session->userdata('is_loggin') == TRUE) {
      if (in_array($this->session->userdata('Role'), array(1, 2))) {
        redirect(base_url('Dashboard'));
      } if(in_array($this->session->userdata('Role'), array(3))) {
        redirect(base_url('KPI_Details'));
      }
    } else {
      $this->load->view('login');
    }
  }

  function Signup()
  {
    $data['company'] = $this->Common_model->getTableData('company', 'Active');
    if ($this->session->userdata('is_loggin') == TRUE) {
      redirect(base_url('Dashboard'));
    } else {
      $this->load->view('signup', $data);
    }
  }

  function forgot()
  {
    if ($this->session->userdata('is_loggin') == TRUE) {
      redirect(base_url('Dashboard'));
    } else {
      $this->load->view('forgot');
    }
  }

  function SignupSuccess()
  {
    if ($this->session->userdata('is_loggin') == TRUE) {
      redirect(base_url('Dashboard'));
    } else {
      $this->load->view('signup_confirmed');
    }
  }

  public function resetpassword()
  {
    $Email = $this->input->post('Email');
    $usr = $this->Login_model->checkEmailExist($Email);
    if (!empty($usr)) {
      $data['UniqueID'] = $usr->UniqueID;
      $data['UserName'] = $usr->UserName;
      $data['EmailAddress1'] = $usr->EmailAddress1;
      $data['Password'] = md5($usr->Password);
      $data['url'] = base_url();
      $this->config_email();
      $data['mail_title'] = 'Your Login Details - SATS Dock Management System';
      $from_email = "support@satsez.com";
      $this->email->from($from_email, 'Satsez.com');
      $this->email->to($Email);
      $this->email->subject('Thank you!. Forgot your Password in SATS Dock Management System');
      $mes_body = $this->load->view('email/user-template.php', $data, true); // load html templates
      $this->email->message($mes_body);
      $this->email->send();
      $this->session->set_flashdata('done', 1);
    } else {
      $this->session->set_flashdata('error', 1);
    }
    redirect(base_url('Login/forgot'));
  }

  function save()
  {
    $this->load->model('User_model');
    if ($this->input->post()) {
      $supplier = $this->Common_model->getMax('users');
      $data['CompanyUID'] = $this->input->post('Company');
      $data['FullName'] = $this->input->post('Name');
      $data['EmailAddress1'] = $this->input->post('EmailAddress1');
      $data['EmailAddress2'] = $this->input->post('EmailAddress2');
      $data['PhoneNumber'] = $this->input->post('PhoneNumber');
      $data['UserName'] = $this->input->post('UserName');
      $data['Password'] = md5($this->input->post('Password'));
      $data['Role'] = 2;
      $auth['UserId'] = $data['UserName'];
      $auth['Password'] = $data['Password'];
      $store = $this->User_model->SaveUser($data);
      if ($store == 1) {
        redirect(base_url('Login/SignupSuccess'));
      } else {
        if ($store != 2) {
          $this->session->set_flashdata('msg', $data['Name'] . ' has been Create Error');
        } else {
          $this->session->set_flashdata('msg', 'Kindly try with new E-mail address!.');
        }
        $this->session->set_flashdata('error', 1);
        redirect(base_url('Login/Signup'));
      }
    }
  }

  function Authendication()
  {
    $data['UserId'] = $this->input->post('UserName');
    $data['Password'] = md5($this->input->post('Password'));
    $data['Active'] = 1;
    $row = $this->Login_model->CheckAuthendication($data);

    if (!empty($row)) {
      $this->session->set_userdata(array(
        'UserUID' => $row->UserUID,
        'UserName' => $row->UserName,
        'Role' => $row->Role,
        'ProjectID' => $row->ProjectID,
        'UserType' => $row->UserType,
        'FullName' => $row->Name,
        'is_loggin' => TRUE
      ));
      redirect(base_url('Dashboard'));
    } else {
      $this->session->set_flashdata('error', 1);
      redirect(base_url());
    }
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }

  function error_404()
  {
    $this->load->view('404-Error');
  }

  public function config_email()
  {
    $config = array(
      'charset'   => 'iso-8859-1',
      'newline' => '\r\n',
      'starttls'  => true,
      'wordwrap'  =>  true
    );
    $emailconf = $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    return $emailconf;
  }
}
