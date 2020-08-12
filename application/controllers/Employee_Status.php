<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_Status extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
        if (!in_array($this->session->userdata('Role'), array(1, 2, 3))) {
            redirect('Dashboard');
            exit;
        }
        $this->load->model('Employee_Status_model');
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['Title'] = 'Add Employee Status';
        $data['Page'] = 'EmployeeStatus';
        $data["Employee_Status_Details"] = $this->Employee_Status_model->getAll();
        $this->load->view('employee_status', $data);
    }

    public function addWorkedHours()
    {
        $data['Title'] = 'Add Employee Status';
        $data['Page'] = 'EmployeeStatus';
        $user_id = $this->session->userdata('UserUID');
        $data["User_Details"] = $this->User_model->GetUsersDetailsByUserID($user_id);
        $data["Employee_Status_Details"] = $this->Employee_Status_model->getAll();
        $this->load->view('add_worked_hours', $data);
    }

    public function addWorkStatus()
    {
        $data['EmployeeName'] = $this->input->post('Employee_Name');
        //   $date = $this->input->post('Day');
        $data['Date'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('Day'))));
        $data['StartTime'] = $this->input->post('ShiftStartTime');
        $data['EndTime'] = $this->input->post('ShiftEndTime');
        $data['BreakStartTime'] = $this->input->post('BreakStartTime');
        $data['BreakEndTime'] = $this->input->post('BreakEndTime');
        $data['CreatedBy'] = $this->session->userdata('UserUID');
        //   print_r($data);
        //   exit;
        $this->Employee_Status_model->insert($data);
        $this->session->set_flashdata('done', 'Work Status added Successfully');
        redirect(base_url('Employee_Status    '));
    }

    function ApproveStatus($StatusID)
    {
        if (empty($StatusID)) {
            redirect(base_url('Dashboard'));
        }
        $data['IsApproved'] = 1;
        $data['ProjectID'] = $this->input->post('ProjectID');
        $data['Designation'] = $this->input->post('Designation');
        $approved = $this->Employee_Status_model->update($StatusID, $data);
        if ($approved == 1) {
            // $usr = $this->User_model->GetUsersDetailsByUserID($StatusID);
            // $data['UserName'] = $usr->UserName;
            // $data['EmailAddress1'] = $usr->EmailAddress1;
            // $data['Password'] = $usr->Password;
            $data['url'] = base_url();
            $this->config_email();
            $data['mail_title'] = 'Your Login Details - EZ Staff Scheduling System';
            $from_email = "support.ez-staff@myezjobs.sg";
            $this->email->from($from_email, '');
            $this->email->to($data['EmailAddress1']); #$Old->EmailAddress1;
            if (!empty($data['EmailAddress2'])) {
                $this->email->cc($data['EmailAddress2']);
            }
            $this->email->subject('Thank you. Your Account is Created in EZ Staff Scheduling System');
            $mes_body = $this->load->view('email/user-template.php', $data, true); // load html templates
            $this->email->message($mes_body);
            $this->email->send();
            $this->session->set_flashdata('done', 1);
            $this->session->set_flashdata('msg', $data['UserName'] . ' Approved successfully, Login details send to registerd email address.');
        } else {
            $this->session->set_flashdata('msg', $data['UserName'] . ' Approved error, Try again!.');
            $this->session->set_flashdata('error', 1);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    //   function Reject($StatusID)
    //   {
    //     if (empty($StatusID)) {
    //       redirect(base_url('Dashboard'));
    //     }
    //     $reject = $this->User_model->DeleteUser($StatusID);
    //     if ($reject == 1) {
    //       $this->session->set_flashdata('done', 1);
    //       $this->session->set_flashdata('msg', 'User Rejected successfully.');
    //     } else {
    //       $this->session->set_flashdata('msg', $data['UserName'] . ' reject error, Try again!.');
    //       $this->session->set_flashdata('error', 1);
    //     }
    //     redirect($_SERVER['HTTP_REFERER']);
    //   }

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
