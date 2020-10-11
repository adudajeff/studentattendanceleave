<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approveleave extends CI_Controller {

	function __construct()
	{
		parent::__construct('applyleave');
        		
		$this->load->helper('url');			
		$this->load->model('Application_model');		
		$this->load->model('Email_model');
		$_SESSION['staffidno']='EMP-009';
		$this->Application_model->loadempinfo($_SESSION['staffidno']);
		$_SESSION['companycode']='LV';
		$_SESSION['CurrentPeriod']=$this->Application_model->currentactiveperiod();
		$_SESSION['CurrentYear']=$this->Application_model->currentactiveyear();
	}
	
	public function index()
	{
		//$appnum=$this->uri->segment(3,''); 
		$appnum=$this->input->get('appnum');
		$step=$this->input->get('step');
		$pendings=$this->Application_model->getpendingapprovalsnum($appnum);
		 $data = array(
        'pendings' => $pendings,
        'step' => $step
       
        );		
		$this->load->library('session');
		//$this->load->view('header/header');
		$this->load->view('loadapprove',$data);		
		//$this->load->view('footer/footer');		
	}
	
	
	public function determinestartdate()
	{
	    $this->Application_model->determinefirstdate();
	}
	
	public function approveleave()
	{
	    $this->Application_model->approveleave();
	}
	
	
	
}
