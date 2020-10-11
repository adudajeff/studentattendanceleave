<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	function __construct()
	{
		parent::__construct('Department');		
		$this->load->helper('url');
        $this->load->model('Departmentmodel');	
        $this->load->library('session');		
	}
	
	public function index()
	{
		
		if (isset($_SESSION['login']))
        {
		$this->load->view('header/header');
		$this->load->view('department/viewdepartment');		
		$this->load->view('footer/footer');	
		}
                else {
				   
				   redirect('/login');
		}	
	}
	
	public function newdepartment()
	{
		if (isset($_SESSION['login']))
        {
		$this->load->view('header/header');
		$this->load->view('department/department');		
		$this->load->view('footer/footer');	
		
		}
                else {
				   
				   redirect('/login');
		}	
	}
   
	
	public function loadeditdepartment()
	{
		
		if (isset($_SESSION['login']))
        {
		$departmentcode=$this->uri->segment(3,'');
		$departmentcode=str_replace("~", "/", $departmentcode);
		$companycode=$_SESSION["companycode"];		
		$search=$this->Departmentmodel->loaddeptinfo($departmentcode,$companycode);				
				 $data = array(
				    'search' => $search
				);
		$this->load->view('header/header');
		$this->load->view('department/editdepartment',$data);		
		$this->load->view('footer/footer');	

        }
                else {
				   
				   redirect('/login');
		}			
	}
	
	public function adddepartment()
	{
			
		$this->Departmentmodel->savedepartment();
		
	}
	public function editdepartment()
	{
			
		$this->Departmentmodel->editdepartment();
		
	}
	
	public function ajax_deptlist()
    {
        
		$list = $this->Departmentmodel->get_datatables();
        $data = array();
        $no = 0;
		$urlb="";
		
        foreach ($list as $department) {			
			$urlb=base_url()."department/loadeditdepartment/".str_replace("/", "~",$department->deptcode);
            $no++;
            $row = array();
            $row[] = "";
            $row[] = $no;
            $row[] = $department->deptcode;
            $row[] = $department->department;         
            $row[] ="<a href='".$urlb."' class='label label-sm label-success'><i class='fa fa-edit'></i>Edit Record</a>";
            $row[] = "<a href='javascript:;' class='label label-sm label-danger'  onclick=deleterecord('department','id','$department->id')><i class='fa fa-trash-o'></i>Delete</a>";
 
            $data[] = $row;
        }
 
        $output = array(
                        //"draw" => $_POST['draw'],
                        "recordsTotal" => $this->Departmentmodel->count_all(),
                        "recordsFiltered" => $this->Departmentmodel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
	
	
	
	
}
