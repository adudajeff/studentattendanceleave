<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_model extends CI_Controller
{

    public $table = 'course';
    public $column_order = array(null, null, 'course_id', 'description', null, null); //set column field database for datatable orderable
    public $column_search = array('course_id', 'description'); //set column field database for datatable searchable
    public $order = array('id' => 'asc'); // default order

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
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
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

    public function savecourse()
    {
        $this->load->library('session');
        $course_id = $this->input->post('course_id');
        $companycode = $_SESSION['companycode'];

        $query = $this->db->query("Select * from course where course_id='{$course_id}' and companycode='{$companycode}'");
        $saveconfirm = $query->result();
        $i = 0;
        foreach ($saveconfirm as $value) {
            $i = $i + 1;
        }

        if ($i > 0) {
            echo "That course Already Exist";
            return false;
        }

        $data = array(
            'description' => $this->input->post('description'),
            'course_id' => $this->input->post('course_id'),
            'companycode' => $companycode,
        );
        // $this->db->where('sid',$this->input->get('sid') );
        $this->db->insert('course', $data);
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function editcourse()
    {
        $this->load->library('session');
        $course_id = $this->input->post('course_id');
        $companycode = $_SESSION['companycode'];

        $data = array(
            'description' => $this->input->post('description'),
            //'course_id' => $this->input->post('course_id'),
            //'companycode' => $companycode,
        );
        $this->db->where('course_id', $this->input->POST('course_id'));
        $this->db->where('companycode', $companycode);
        $this->db->update('course', $data);
        //echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function loadcourseinfo($course_id, $companycode)
    {

        $query = $this->db->query("Select * from course where course_id='{$course_id}' and companycode='{$companycode}'");
        return $query->result();

    }

}
