<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendancemaster extends CI_Model
{
    public $table = 'attendancemaster';
    public $column_order = array(null, null, 'regno', 'unit', 'course_id', 'signindate', 'time', 'room', 'status', null, null); //set column field database for datatable orderable
    public $column_search = array('course_id', 'course_id', 'signindate'); //set column field database for datatable searchable
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

    public function saveattendance()
    {
        $this->load->library('session');
        $course_id = $this->input->post('course_id');
        $regno = $this->input->post('regno');
        $lessondate = $this->input->post('lessondate');
        $lessontime = $this->input->post('lessontime');
        $unit = $this->input->post('unit');
        $roomnumber = $this->input->post('roomnumber');

        $companycode = $_SESSION['companycode'];

        $query = $this->db->query("Select * from attendancemaster where unit='{$unit}' and  course_id='{$course_id}' and regno='{$regno}' and companycode='{$companycode}'");
        $saveconfirm = $query->result();
        $i = 0;
        foreach ($saveconfirm as $value) {
            $i = $i + 1;
        }

        if ($i > 0) {
            echo "That Attendance Already Exist";
            return false;
        }

        $data = array(
            'course_id' => $course_id,
            'regno' => $regno,
            'room' => $roomnumber,
            'time' => $lessontime,
            'signindate' => date("Y-m-d"),
            'absent' => 'N',
            'present' => 'Y',
            'leave' => 'N',
            'unit' => $unit,
            'companycode' => $companycode,
        );

        $this->db->insert('attendancemaster', $data);
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function editattendance()
    {
        $this->load->library('session');
        $course_id = $this->input->post('course_id');
        $regno = $this->input->post('regno');
        $companycode = $_SESSION['companycode'];

        $data = array(
            'room' => $this->input->post('room'),
            'time' => $this->input->post('time'),
            'application_date' => $this->input->post('application_date'),
            'Approver' => $this->input->post('Approver'),
            'Authorizer' => $this->input->post('Authorizer'),
            'date_authorized' => $this->input->post('date_authorized'),
            'status' => $this->input->post('status'),
        );
        $this->db->where('course_id', $this->input->POST('course_id'));
        $this->db->where('regno', $this->input->POST('regno'));
        $this->db->where('companycode', $companycode);
        $this->db->update('course', $data);
        //echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function loadstuinfo($regno, $companycode)
    {

        $query = $this->db->query("Select * from student where regno='{$regno}' and companycode='{$companycode}'");
        return $query->result();

    }

}
