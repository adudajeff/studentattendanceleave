<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends CI_Controller {

	function __construct()
	{
		parent::__construct('holiday');		
		$this->load->helper('url');        
		//$this->load->model('Departmentmodel','Department');        		
       $this->load->model('Holidaymodel');
	   $this->load->library('session');
		
	}
	
	 function index()
	{
		if (isset($_SESSION['login']))
            { 
		$this->load->view('header/header');
		$this->load->view('holiday/viewholiday');		
		$this->load->view('footer/footer');
		}
                else {
				   
				   redirect('/login');
		}	
	}
    
	 function newholiday()
	{
		if (isset($_SESSION['login']))
        { 
		$this->load->view('header/header');
		$this->load->view('holiday/holiday');		
		$this->load->view('footer/footer');	
		}
         else {
				   
				   redirect('/login');
		}	
	}
	
	 function loadeditholiday()
	{
		if (isset($_SESSION['login']))
        { 
		$holidaymonth=$this->uri->segment(3,'');
		$holidaymonth=str_replace("~", "/", $holidaymonth);
		$companycode=$_SESSION["companycode"];		
		$search=$this->Holidaymodel->loadholinfo($holidaymonth);				
				 $data = array(
				    'search' => $search
				);
		$this->load->view('header/header');
		$this->load->view('holiday/editholiday',$data);		
		$this->load->view('footer/footer');	
		}else {
				   
				   redirect('/login');
		}
	}
	
	 function addholiday()
	{
			
		$this->Holidaymodel->saveholiday();
		
	}
	 function editholiday()
	{
			
		$this->Holidaymodel->editholiday();
		
	}
	 function ajax_holidaylist()
    {
        
		$list = $this->Holidaymodel->get_datatables();
        $data = array();
        $no = 0;
		$urlb="";
		
        foreach ($list as $holiday) {			
			$urlb=base_url()."holiday/loadeditholiday/".str_replace("/", "~",$holiday->HolidayMonth);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = date('F,d Y',strtotime($holiday->Holiday));
            $row[] = $holiday->Description;
            $row[] = $holiday->HolidayDate;         
            $row[] = $holiday->CurrentYear;         
            $row[] = $holiday->SameEachYear;         
            $row[] ="<a href='".$urlb."' class='label label-sm label-success'><i class='fa fa-edit'></i>Edit Record</a>";
            $row[] = "<a href='javascript:' class='label label-sm label-danger'  onclick=deleterecord('paramholiday','TransactionNo','$holiday->TransactionNo')><i class='fa fa-trash-o'></i>Delete</a>";
 
            $data[] = $row;
        }
 
        $output = array(
                        //"draw" => $_POST['draw'],
                        "recordsTotal" => $this->Holidaymodel->count_all(),
                        "recordsFiltered" => $this->Holidaymodel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
	
	
}
