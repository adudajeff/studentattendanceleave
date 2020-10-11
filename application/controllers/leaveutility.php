<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaveutility extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Modelutility');
		$this->load->model('globefunc');		
        $this->load->library('session');		
		//$_SESSION['staffidno']='EMP-009';		
	}
	public function index()
	{
		
	}
	
	public function Updateleave()
	{
	     $currentperiod=$_SESSION['CurrentPeriod'];
		 $staffidno=$_SESSION['staffidno'];
		 $this->Modelutility->cleanleave($currentperiod,$staffidno);
		 
	}
	
	public function Updateleaveall()
	{
	     $currentperiod="";
		 $staffidno="";
		 $this->Modelutility->cleanleave($currentperiod,$staffidno);
		 
	}
}
