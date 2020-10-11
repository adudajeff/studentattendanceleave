<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Applyleave extends CI_Controller
{

    public function __construct()
    {
        parent::__construct('applyleave');
        $this->load->helper('url');

        $this->load->model('Application_model');
        $this->load->model('Email_model');
        $this->load->library('session');
        //$_SESSION['staffidno']='EMP-009';
        $this->Application_model->loadempinfo($_SESSION['staffidno']);
        //$_SESSION['companycode']='LV';
        //$_SESSION['CurrentPeriod']=$this->Application_model->currentactiveperiod();
        $_SESSION['CurrentYear'] = $this->Application_model->currentactiveyear();
    }

    public function index()
    {
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('Leaveapplications/applyleave');
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
    public function determinestartdate()
    {
        $this->Application_model->determinefirstdate();
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
