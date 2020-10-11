<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendanceregister extends CI_Controller
{

    public function __construct()
    {
        parent::__construct('Register');

        $this->load->helper('url');
        $this->load->model('Application_model');
        $this->load->model('Attendancemaster');
        $this->load->model('Email_model');
        $this->load->library('session');

        $this->Application_model->loadstudinfo($_SESSION['staffidno']);

        $_SESSION['companycode'] = 'LV';
        $_SESSION['CurrentPeriod'] = $this->Application_model->currentactiveperiod();
        $_SESSION['CurrentYear'] = $this->Application_model->currentactiveyear();
    }

    public function index()
    {
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('Viewregister');
            $this->load->view('footer/footer');
        } else {
            redirect("/login");
        }
    }

    public function classregister()
    {
        if (isset($_SESSION['login'])) {
            //$this->load->library('session');
            $this->load->view('header/header');
            $this->load->view('student/loadnewregister');
            $this->load->view('footer/footer');
        } else {
            redirect("/login");
        }
    }

    public function ajax_attendancelist()
    {

        $list = $this->Attendancemaster->get_datatables();
        $data = array();
        $no = 0;
        $urlb = "";

        foreach ($list as $master) {
            $urlb = base_url() . "student/loadeditstudent/" . str_replace("/", "~", $master->regno);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = $master->regno;
            $row[] = $master->unit;
            $row[] = $master->course_id;
            $row[] = $master->signindate;
            $row[] = $master->time;
            $row[] = $master->room;
            $row[] = $master->status;
            $row[] = "<a href='" . $urlb . "' class='label label-sm label-success'><i class='fa fa-edit'></i>Edit Record</a>";
            $row[] = "<a href='javascript:;' class='label label-sm label-danger'  onclick=deleterecord('student','id','$master->id')><i class='fa fa-trash-o'></i>Delete</a>";

            $data[] = $row;
        }

        $output = array(
            //"draw" => $_POST['draw'],
            "recordsTotal" => $this->Attendancemaster->count_all(),
            "recordsFiltered" => $this->Attendancemaster->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getsinglevalueglobe($field, $table, $value, $returnvalue)
    {
        return $this->globefunc->getsinglevalueglobe($field, $table, $value, $returnvalue);
    }

    public function determinestartdate()
    {
        $this->Application_model->determinefirstdate();
    }

    public function register()
    {
        $this->Attendancemaster->saveattendance();
    }

}
