<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CI_Controller {

	function __construct()
	{
		parent::__construct('Designation');		
		$this->load->helper('url');        
		//$this->load->model('Departmentmodel','Department');        		
       $this->load->model('Designationmodel');
	   $this->load->library('session');
		
	}
	
	public function index()
	{
		if (isset($_SESSION['login']))
        {
		$this->load->view('header/header');
		$this->load->view('Designation/viewdesignation');		
		$this->load->view('footer/footer');	
        }
                else {
				   
				   redirect('/login');
		}			
	}
    
	public function newdesignation()
	{
		if (isset($_SESSION['login']))
        {
		$this->load->view('header/header');
		$this->load->view('Designation/designation');		
		$this->load->view('footer/footer');	
        }
                else {
				   
				   redirect('/login');
		}			
	}
	
	public function loadeditdesignation()
	{
		if (isset($_SESSION['login']))
        {
		$designationcode=$this->uri->segment(3,'');
		$designationcode=str_replace("~", "/", $designationcode);
		$companycode=$_SESSION["companycode"];		
		$search=$this->Designationmodel->loaddesiginfo($designationcode,$companycode);				
				 $data = array(
				    'search' => $search
				);
		$this->load->view('header/header');
		$this->load->view('Designation/editdesignation',$data);		
		$this->load->view('footer/footer');
		
		 }
                else {
				   
				   redirect('/login');
		}
	}
	
	public function adddesignation()
	{
			
		$this->Designationmodel->savedesignation();
		
	}
	public function editdesignation()
	{
			
		$this->Designationmodel->editdesignation();
		
	}
	public function ajax_designationlist()
    {
        
		$list = $this->Designationmodel->get_datatables();
        $data = array();
        $no = 0;
		$urlb="";
		
        foreach ($list as $designation) {			
			$urlb=base_url()."designation/loadeditdesignation/".str_replace("/", "~",$designation->designationcode);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = $designation->designationcode;
            $row[] = $designation->designation;         
            $row[] ="<a href='".$urlb."' class='label label-sm label-success'><i class='fa fa-edit'></i>Edit Record</a>";
            $row[] = "<a href=# class='label label-sm label-danger'  onclick=deleterecord('designation','id','$designation->id')><i class='fa fa-trash-o'></i>Delete</a>";
 
            $data[] = $row;
        }
 
        $output = array(
                        //"draw" => $_POST['draw'],
                        "recordsTotal" => $this->Designationmodel->count_all(),
                        "recordsFiltered" => $this->Designationmodel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
	
	
}
