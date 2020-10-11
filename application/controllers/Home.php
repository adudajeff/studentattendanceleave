<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct('home');
		$this->load->helper('url');
		$this->load->model('globefunc');
        $this->load->library('session');		
				
	}
	public function index()
	{

		if (isset($_SESSION['login']))
        {    
				$this->globefunc->createcurrentperiod();
				$pendings=$this->globefunc->getpendingapprovals($_SESSION['staffidno']);
				$leaveauthorized=$this->globefunc->getallauthorized($_SESSION['staffidno']);
				$loadnotifications=$this->globefunc->shownotifications($_SESSION['staffidno']);
				
				 $data = array(
				'pendings' => $pendings,
				'leaveauthorized' => $leaveauthorized,
				'loadnotifications' => $loadnotifications
			   
				);
				
				$this->load->view('header/header');
				$this->load->view('index',$data);
				$this->load->view('footer/footer');
		 }else{	  
		  redirect('/login');
		}	
	}
	
	public function deletenotification()
	{
		$this->globefunc->incompletedelete();
	}	
	public function editemployees()
	{
		$this->globefunc->editemployees();
	}
	
	public function saveemployees()
	{
		$this->globefunc->saveemployees();
	}	
	
	public function deleterecord()
	{
		$this->globefunc->deleterecord();
	}	
	public function upload()
	{
	    $this->globefunc->upload();
	}
  

}
