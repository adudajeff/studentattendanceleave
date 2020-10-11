<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct('Leave Reports');
        $this->load->helper('url');
        $this->load->model('Reports_model');
        $this->load->model('Email_model');
        $this->load->library('session');

    }

    public function index()
    {
        $allstaff = $this->Reports_model->loademployeeinfo();

        $data = array(
            'allstaffs' => $allstaff,

        );
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('reports/viewemployees', $data);
            $this->load->view('footer/footer');
        } else {

            redirect('/login');
        }
    }

    public function leavehistory()
    {
        $allstaff = $this->Reports_model->loademployeeinfo();

        $data = array(
            'allstaffs' => $allstaff,

        );
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('reports/viewemployees', $data);
            $this->load->view('footer/footer');
        } else {

            redirect('/login');
        }
    }

    public function loadleavehistory()
    {
        $staffidno = $this->uri->segment(3, '');
        if ($staffidno == "") {
            $staffidno = $_SESSION['staffidno'];
        }
        $oppenningperiod = $_SESSION['openningperiod'];
        $strstaffidno = $staffidno;
        $leavehistory = $this->Reports_model->loadleavesummery($oppenningperiod, $strstaffidno);
        $leavesummary = $this->Reports_model->leaveappssummary($staffidno);
        $query = $this->db->query("Select employee.*,department.*,employeetype.* from employee,department,employeetype where employee.departmentcode=department.deptcode and employeetype.employeetypecode =employee.employeetype and employee.employeeno='{$staffidno}'");
        $empsearch = $query->result();

        $data = array(
            'leavehistory' => $leavehistory,
            'empsearch' => $empsearch,
            'leavesummary' => $leavesummary,

        );
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('reports/leavehistory', $data);
            $this->load->view('footer/footer');
        } else {

            redirect('/login');
        }
    }

    public function staffleavesummary()
    {
        $staffidno = $this->uri->segment(3, '');
        if ($staffidno == "") {
            $staffidno = $_SESSION['staffidno'];
        }
        $oppenningperiod = $_SESSION['openningperiod'];
        $strstaffidno = $staffidno;
        $strLeaveType = "A";
        $staffleavesum = $this->Reports_model->dayssummary($oppenningperiod, $strLeaveType);
        $leavehistory = $this->Reports_model->loadleavesummery($oppenningperiod, $strstaffidno);
        $leavesummary = $this->Reports_model->leaveappssummary($staffidno);
        $query = $this->db->query("Select employee.*,department.*,employeetype.* from employee,department,employeetype where employee.departmentcode=department.deptcode and employeetype.employeetypecode =employee.employeetype and employee.employeeno='{$staffidno}'");
        $empsearch = $query->result();

        $query = $this->db->query("Select * from department");
        $empdept = $query->result();

        $data = array(
            'leavehistory' => $leavehistory,
            'empsearch' => $empsearch,
            'leavesummary' => $leavesummary,
            'staffleavesum' => $staffleavesum,
            'empdept' => $empdept,

        );
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('reports/dayssummary', $data);
            $this->load->view('footer/footer');
        } else {

            redirect('/login');
        }
    }

    public function loadleavebalances()
    {

        $leavetype = $this->input->post('leavetype');
        $staffidno = $_SESSION['staffidno'];
        $balancebf = $this->Application_model->loadopenningbalance($leavetype);
        $currentperiod = $this->Application_model->openningperiod();

        $query = $this->db->query("Select * from employee where employeeno='{$staffidno}'");
        $empsearch = $query->result();
        $approvallevel = "";
        $firstapprover = "";
        $altfirstapprover = "";
        $secondapprover = "";
        $altsecondapprover = "";
        $altthirdapprover = "";
        $thirdapprover = "";

        foreach ($empsearch as $value) {
            $approvallevel = $value->approvallevel;
            $firstapprover = $this->Application_model->getsinglevalue("allnames", "employee", $value->firstapprover, "employeeno");
            $altfirstapprover = $this->Application_model->getsinglevalue("allnames", "employee", $value->altfirstapprover, "employeeno");
            $secondapprover = $this->Application_model->getsinglevalue("allnames", "employee", $value->secondapprover, "employeeno");
            $altsecondapprover = $this->Application_model->getsinglevalue("allnames", "employee", $value->altsecondapprover, "employeeno");
            $altthirdapprover = $this->Application_model->getsinglevalue("allnames", "employee", $value->altthirdapprover, "employeeno");
            $thirdapprover = $this->Application_model->getsinglevalue("allnames", "employee", $value->thirdapprover, "employeeno");
        }

        $data = [
            'currentperiod' => $currentperiod,
            'approvallevel' => $approvallevel,
            'staffidno' => $staffidno,
            'firstapprover' => $firstapprover,
            'altfirstapprover' => $altfirstapprover,
            'secondapprover' => $secondapprover,
            'altsecondapprover' => $altsecondapprover,
            'altthirdapprover' => $altthirdapprover,
            'thirdapprover' => $thirdapprover,
            'balancebf' => $balancebf,
            'leavetype' => $leavetype,
        ];

        $this->load->view('Leaveapplications/loadleavebalances', $data);

    }
    public function LoadStaff()
    {
        $this->Report_model->allstaff();
    }
    public function determinelastdate()
    {
        $this->Application_model->determinelastdate();
    }

    public function determinedateexpected()
    {
        $this->Application_model->determinedateexpected();
    }
    public function loadbalances()
    {
        $this->Application_model->loadbalances();
    }

    public function leaveapplications()
    {
        $this->Application_model->leaveapplications();
    }

    public function getnextapplicationno()
    {
        $this->Application_model->getnextapplicationno();
    }

    public function getsinglevalue()
    {
        $this->Application_model->getsinglevalue($field, $table, $value, $returnvalue);
    }

}
