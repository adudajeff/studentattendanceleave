<?php
defined('BASEPATH') or exit('No direct script access allowed');

class course extends CI_Controller
{

    public function __construct()
    {
        parent::__construct('course');
        $this->load->helper('url');
        $this->load->model('Course_model');
        $this->load->library('session');
    }

    public function index()
    {

        if (isset($_SESSION['login'])) {
            $this->load->view('header/header');
            $this->load->view('course/viewcourse');
            $this->load->view('footer/footer');
        } else {

            redirect('/login');
        }
    }

    public function newcourse()
    {
        if (isset($_SESSION['login'])) {
            $this->load->view('header/header');
            $this->load->view('course/course');
            $this->load->view('footer/footer');

        } else {

            redirect('/login');
        }
    }

    public function loadededitcourse()
    {

        if (isset($_SESSION['login'])) {
            $course_id = $this->uri->segment(3, '');
            $course_id = str_replace("~", "/", $course_id);
            $companycode = $_SESSION["companycode"];
            $search = $this->Course_model->loadcourseinfo($course_id, $companycode);
            $data = array(
                'search' => $search,
            );
            $this->load->view('header/header');
            $this->load->view('course/editcourse', $data);
            $this->load->view('footer/footer');

        } else {

            redirect('/login');
        }
    }

    public function addcourse()
    {

        $this->Course_model->savecourse();

    }
    public function editcourse()
    {

        $this->Course_model->editcourse();

    }

    public function ajax_deptlist()
    {

        $list = $this->Course_model->get_datatables();
        $data = array();
        $no = 0;
        $urlb = "";

        foreach ($list as $course) {
            $urlb = base_url() . "course/loadeditcourse/" . str_replace("/", "~", $course->description);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = $course->course_id;
            $row[] = $course->description;
            $row[] = "<a href='" . $urlb . "' class='label label-sm label-success'><i class='fa fa-edit'></i>Edit Record</a>";
            $row[] = "<a href='javascript:;' class='label label-sm label-danger'  onclick=deleterecord('course','id','$course->id')><i class='fa fa-trash-o'></i>Delete</a>";

            $data[] = $row;
        }

        $output = array(
            //"draw" => $_POST['draw'],
            "recordsTotal" => $this->Course_model->count_all(),
            "recordsFiltered" => $this->Course_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
