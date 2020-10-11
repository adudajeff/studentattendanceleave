<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Holidaymodel extends CI_Controller {
 
    var $table = 'paramholiday';
    var $column_order = array(null,null,'Holiday','Description','HolidayDate','CurrentYear','SameEachYear',null,null); //set column field database for datatable orderable
    var $column_search = array('Holiday','Description','HolidayDate','CurrentYear','SameEachYear'); //set column field database for datatable searchable 
    var $order = array('TransactionNo' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	public function saveholiday()
    {
		  $this->load->library('session');
		  $HolidayMonth=date("m",strtotime($this->input->post('HolidayDate')));
		  $HolidayDate=date("d",strtotime($this->input->post('HolidayDate')));
		  $companycode=$_SESSION['companycode'];
		 
		  
		  $query =$this->db->query("Select * from paramholiday where HolidayMonth='{$HolidayMonth}' AND HolidayDate='{$HolidayDate}'");
		  $saveconfirm=$query->result(); 
	      $i=0;
		  foreach ($saveconfirm as $value) 
		  {
			   $i=$i+1;			   
		  }
		
			if ($i>0)
			{
				echo "That Holiday Already Exist";
				return false;
			}
		
		$data = array(
		'Description' => $this->input->post('description'),
		'HolidayMonth' => date("m",strtotime($this->input->post('HolidayDate'))),				
		'HolidayDate' =>date("d",strtotime($this->input->post('HolidayDate'))),				
		'Holiday' => date("Y-m-d h:m:s",strtotime($this->input->post('HolidayDate'))),				
		'CurrentYear' => date("Y",strtotime($this->input->post('HolidayDate'))),				
		'companycode' => $companycode,				
		'SameEachYear' =>$this->input->post('sameeachyear'),				
		'Active' => "Y",				
	   );		
	
	    $this->db->insert('paramholiday', $data);
	    if ($this->db->affected_rows() > 0)
		{
		  echo "Success";
		}
		else
		{
		   echo "failed";
		}
	 
  
    }
	public function editholiday()
    {
		  $this->load->library('session');
		  $HolidayMonth=date("m",strtotime($this->input->post('HolidayDate')));
		  $companycode=$_SESSION['companycode'];
		
		
		$data = array(
		'Description' => $this->input->post('description'),
		'HolidayMonth' => date("m",strtotime($this->input->post('HolidayDate'))),				
		'SameEachYear' =>$this->input->post('sameeachyear'),				
		//'Holiday' => date("Y-m-d h:m:s",strtotime($this->input->post('HolidayDate'))),				
		'CurrentYear' => date("Y",strtotime($this->input->post('HolidayDate'))),				
		'companycode' => $companycode,				
		'Active' => "Y",					
	   );				
	    $this->db->where('HolidayDate',date("d",strtotime($this->input->post('HolidayDate')))); 
	    $this->db->where('HolidayMonth',date("m",strtotime($this->input->post('HolidayDate')))); 
	    $this->db->update('paramholiday', $data);		
	    if ($this->db->affected_rows() > 0)
		{
		  echo "Success";
		}
		else
		{
		   echo "You Didn't make any change";
		}
	 
  
    }
	
	public function loadholinfo($HolidayMonth)
	{
		         
				  $query =$this->db->query("Select * from paramholiday where HolidayMonth='{$HolidayMonth}'");
				  return  $query->result(); 				  
				 
	}
	
	
 
}