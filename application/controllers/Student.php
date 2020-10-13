<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct('Student');
        $this->load->helper('url');
        $this->load->model('Students');
        $this->load->model('globefunc');
        $this->load->library('session');
    }

    public function index()
    {

        if (isset($_SESSION['login'])) {
            $this->load->view('header/header');
            $this->load->view('student/viewstudents');
            $this->load->view('footer/footer');
        } else {

            redirect('/login');
        }
    }

    public function create()
    {
        if (isset($_SESSION['login'])) {
            $this->load->view('header/header');
            $this->load->view('student/createstudent');
            $this->load->view('footer/footer');

        } else {

            redirect('/login');
        }
    }

    public function loadeditstudent()
    {

        if (isset($_SESSION['login'])) {
            $regno = $this->uri->segment(3, '');
            $regno = str_replace("~", "/", $regno);
            $companycode = $_SESSION["companycode"];
            $search = $this->Students->loadstudinfo($regno, $companycode);
            $data = array(
                'search' => $search,
            );
            $this->load->view('header/header');
            $this->load->view('student/editstudent', $data);
            $this->load->view('footer/footer');

        } else {

            redirect('/login');
        }
    }

    public function addstudent()
    {

        $this->Students->savestudent();

    }
    public function editstudent()
    {

        $this->Students->editstudent();

    }

    public function ajax_deptlist()
    {

        $list = $this->Students->get_datatables();
        $data = array();
        $no = 0;
        $urlb = "";

        foreach ($list as $student) {
            $urlb = base_url() . "student/loadeditstudent/" . str_replace("/", "~", $student->regno);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = $student->regno;
            $row[] = $student->name;
            $row[] = $student->email;
            $row[] = $student->admission_date;
            $row[] = $student->mobile;
            $row[] = $student->year;

            $row[] = "<a href='" . $urlb . "' class='label label-sm label-success'><i class='fa fa-edit'></i>Edit Record</a>";
            $row[] = "<a href='javascript:;' class='label label-sm label-danger'  onclick=deleterecord('student','id','$student->id')><i class='fa fa-trash-o'></i>Delete</a>";

            $data[] = $row;
        }

        $output = array(
            //"draw" => $_POST['draw'],
            "recordsTotal" => $this->Students->count_all(),
            "recordsFiltered" => $this->Students->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getsinglevalueglobe($field, $table, $value, $returnvalue)
    {
        return $this->globefunc->getsinglevalueglobe($field, $table, $value, $returnvalue);
    }

}
