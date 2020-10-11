<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empform extends CI_Controller {

	function __construct()
	{
		parent::__construct('employees');
		
		$this->load->helper('url');
        $this->load->model('globefunc');		
		$this->load->library('session');
	}
	
	public function index()
	{
		if (isset($_SESSION['login']))
        {
		$this->load->view('header/header');
		$this->load->view('employees/empform');		
		$this->load->view('footer/footer');
		}
                else {
				   
				   redirect('/login');
		}	
	}
	
	public function editemployees()
	{
		    if (isset($_SESSION['login']))
            {    
				 $staffidno=$this->uri->segment(3,'');
				 $staffidno=str_replace("~", "/", $staffidno);
		         $empsearch=$this->globefunc->loademployeeinfo($staffidno);				
				 $data = array(
				    'empsearch' => $empsearch
				);
				
		$this->load->view('header/header');
		$this->load->view('employees/editemployees',$data);		
		$this->load->view('footer/footer');	
		}
                else {
				   
				   redirect('/login');
		}	
	}
	function getsinglevalueglobe($field,$table,$value,$returnvalue){
		return $this->globefunc->getsinglevalueglobe($field,$table,$value,$returnvalue);
	}
}
