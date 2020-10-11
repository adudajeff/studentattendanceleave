<?php 
   class Email_controller extends CI_Controller { 
 
      function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         //$this->load->helper('form'); 
      } 
		
      public function index() { 
	
         $this->load->helper('form'); 
         //$this->load->view('email_form'); 
      } 
  
      public function send_mailApprovers($from_email,$to_email,$email_subject,$email_message) { 
        // $from_email = "your@example.com"; 
         //$to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
         $config['mailtype'] = 'html';
	     $this->email->initialize($config);
		 
		 //$body=$this->load->view('emailtemplate',$data,TRUE);
         $this->email->from($from_email, 'Leave Manager'); 
         $this->email->to($to_email);
         $this->email->subject($email->subject); 
         $this->email->message($body); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
        /// $this->load->view('email_form'); 
      } 
   } 
?>