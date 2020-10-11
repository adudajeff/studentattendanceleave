<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');	
		$this->load->model('Employee_model','Employees');
		$this->load->library('session');
	}
	
	public function index()
	{
		
		if (isset($_SESSION['login']))
        { 
		$this->load->view('header/header');
		$this->load->view('employees/viewemployees');
		$this->load->view('footer/footer');
		}
                else {
				   
				  redirect('/login');
		}	
	}
	
	 public function ajax_emplist()
    {
        $list = $this->Employees->get_datatables();
        $data = array();
        $no = 0;
		$urlb="";
		
        foreach ($list as $Employees) {			
			$urlb=base_url()."empform/editemployees/".str_replace("/", "~",$Employees->employeeno);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = $Employees->employeeno;
            $row[] = $Employees->firstname;
            $row[] = $Employees->lastname;
            $row[] = $Employees->othernames;
            $row[] = $Employees->datehired;
            $row[] = $Employees->emailaddress;
            $row[] = $Employees->gendercode;
            $row[] ="<a href='".$urlb."' class='label label-sm label-success'><i class='fa fa-edit'></i> Edit Record</a>";
            $row[] = "<a href=# class='label label-sm label-danger'  onclick=deleterecord('employee','id','$Employees->id')><i class='fa fa-trash-o'></i>Delete</a>";
 
            $data[] = $row;
        }
 
        $output = array(
                        //"draw" => $_POST['draw'],
                        "recordsTotal" => $this->Employees->count_all(),
                        "recordsFiltered" => $this->Employees->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}
