<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
{
    public $table = 'student';
    public $column_order = array(null, null, 'regno', 'name', 'email', 'admission_date', 'mobile', null, null); //set column field database for datatable orderable
    public $column_search = array('regno', 'name', 'email', 'admission_date', 'mobile'); //set column field database for datatable searchable
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

    public function savestudent()
    {
        $this->load->library('session');
        $regno = $this->input->post('regno');
        $companycode = $_SESSION['companycode'];

        $query = $this->db->query("Select * from student where regno='{$regno}' and companycode='{$companycode}'");
        $saveconfirm = $query->result();
        $i = 0;
        foreach ($saveconfirm as $value) {
            $i = $i + 1;
        }

        if ($i > 0) {
            echo "That Student Already Exist";
            return false;
        }

        $data = array(
            'regno' => $this->input->post('regno'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'admission_date' => $this->input->post('admission_date'),
            'mobile' => $this->input->post('mobile'),
            'course_id' => $this->input->post('course_id'),
            'dept_id' => $this->input->post('deptcode'),
            'companycode' => $companycode,
        );
        // $this->db->where('sid',$this->input->get('sid') );
        $this->db->insert('student', $data);
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function editstudent()
    {
        $this->load->library('session');
        $regno = $this->input->post('regno');
        $companycode = $_SESSION['companycode'];

        $data = array(
            'regno' => $this->input->post('regno'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'admission_date' => $this->input->post('admission_date'),
            'mobile' => $this->input->post('mobile'),
            'course_id' => $this->input->post('course_id'),
            'dept_id' => $this->input->post('deptcode'),

        );
        $this->db->where('regno', $this->input->POST('regno'));
        $this->db->where('companycode', $companycode);
        $this->db->update('student', $data);
        //echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function loadstudinfo($regno, $companycode)
    {

        $query = $this->db->query("Select * from student where regno='{$regno}' and companycode='{$companycode}'");
        return $query->result();

    }

}
