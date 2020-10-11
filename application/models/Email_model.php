<?php
 
class Email_model extends CI_Controller 
{
	
	   public function send_mailApprovers($from_email,$to_email,$email_subject,$email_message) 
	   { 
         //config Library
		
         //Load email library 
         $this->load->library('email');
		 //sett email parameter and send
		// $config['mailtype'] = 'html';
	     //$this->email->initialize($config);
		 $data['email_messege']=$email_message;
		 $body=$this->load->view('emailtemplate.php',$data,TRUE);
		 $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		 $this->email->set_header('Content-type', 'text/html');

         $this->email->set_header('Header1', 'Value1');
         $this->email->from($from_email, 'Leave Manager'); 
         $this->email->to($to_email);
         $this->email->subject($email_subject); 
         $this->email->message($body); 
   
         //Send mail 
         if($this->email->send())
		 {			 
             return ("Success");
		 }		 
         else{ 
             return ("Error in sending Email."); 
        /// $this->load->view('email_form'); 
		 }
      } 
	  
	  public function send_mail($from_email,$to_email,$email_subject,$email_message) 
	   { 
         //config Library
		
         //Load email library 
         $this->load->library('email');
		 //sett email parameter and send
		// $config['mailtype'] = 'html';
	     //$this->email->initialize($config);
		 $data['email_messege']=$email_message;
		 $body=$this->load->view('emailtemplate.php',$data,TRUE);
		 $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		 $this->email->set_header('Content-type', 'text/html');

         $this->email->set_header('Header1', 'Value1');
         $this->email->from($from_email, 'Leave Manager'); 
         $this->email->to($to_email);
         $this->email->subject($email_subject); 
         $this->email->message($body); 
   
         //Send mail 
         if($this->email->send())
		 {			 
             return ("Success");
		 }		 
         else{ 
             return ("Error in sending Email."); 
        /// $this->load->view('email_form'); 
		 }
      } 
	
}