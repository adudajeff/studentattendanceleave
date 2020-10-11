<?php

class Globefunc extends CI_Controller
{

    public function deleterecord()
    {
        $field = $this->input->post('field');
        $table = $this->input->post('table');
        $value = $this->input->post('value');

        $this->db->where($field, $value);
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function incompletedelete()
    {
        $field = $this->input->post('field');
        $table = $this->input->post('table');
        $value = $this->input->post('value');
        $data = array(
            'deleted' => "Y",
        );
        $this->db->where($field, $value);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed";
        }

    }

    public function getsinglevalueglobe($field, $table, $value, $returnvalue)
    {

        //$query="Select ".$field." from ".$table." where ".$returnvalue."='".$value."'";

        $query = $this->db->query("Select " . $field . " from " . $table . " where " . $returnvalue . "='" . $value . "'");
        $empsearch = $query->result();
        $rvalue = "";
        foreach ($empsearch as $value) {
            $rvalue = $value->$field;
        }
        return $rvalue;

    }

    public function saveemployees()
    {

        $this->load->library('session');

        $email = $this->input->post('email');
        $employeeno = $this->input->post('employeeno');
        $query = $this->db->query("Select * from employee where employeeno='{$employeeno}'");
        $empsearch = $query->result();
        $count = 0;
        $subject = "";
        $photo = "";

        if (isset($_SESSION['file'])) {
            $photo = $_SESSION['file'];
        } else {
            $photo = "";
        }

        foreach ($empsearch as $value) {
            $count = $count + 1;
            $subject = "Number";
        }
        foreach ($empsearch as $value) {
            $count = $count + 1;
            $subject = "Number";
        }

        $query = $this->db->query("Select * from employee where emailaddress='{$email}'");
        $empsearch = $query->result();
        foreach ($empsearch as $value) {
            $count = $count + 1;
            $subject = "Email";
        }

        if ($count == 0) {
            $data = array(

                'employeeno' => $this->input->post('employeeno'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'othernames' => $this->input->post('othernames'),
                'allnames' => $this->input->post('firstname') . " " . $this->input->post('lastname') . " " . $this->input->post('othernames'),
                'emailaddress' => $this->input->post('email'),
                'gendercode' => $this->input->post('gendercode'),
                'designationcode' => $this->input->post('designationcode'),
                'departmentcode' => $this->input->post('departmentcode'),
                'countrycode' => $this->input->post('countrycode'),
                'employeetype' => $this->input->post('employeetype'),
                'hod' => $this->input->post('hod'),
                'physicaladdress' => $this->input->post('physicaladdress'),
                'telephone' => $this->input->post('phone'),
                'officeno' => $this->input->post('officeno'),
                'approvallevel' => $this->input->post('approvallevel'),
                'firstapprover' => $this->input->post('firstapprover'),
                'altfirstapprover' => $this->input->post('altfirstapprover'),
                'secondapprover' => $this->input->post('secondapprover'),
                'altsecondapprover' => $this->input->post('altsecondapprover'),
                'altthirdapprover' => $this->input->post('altthirdapprover'),
                'thirdapprover' => $this->input->post('thirdapprover'),
                'datehired' => date('Y-m-d', strtotime($this->input->post('datehired'))),
                'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                'monday' => $this->input->post('countmonday'),
                'tuesday' => $this->input->post('counttuesday'),
                'wednesday' => $this->input->post('countwednesday'),
                'thursday' => $this->input->post('countthursday'),
                'friday' => $this->input->post('countfriday'),
                'saturday' => $this->input->post('countsaturday'),
                'sunday' => $this->input->post('countsunday'),
                'holiday' => $this->input->post('countholiday'),
                'photo' => $photo,

            );
            $this->db->insert('employee', $data);

            if ($this->db->affected_rows() > 0) {
                echo "Success";
            } else {
                echo "failed";
            }

        } else {
            echo "That Employee " . $subject . " Already Exists in the System";
        }

    }

    public function editemployees()
    {

        $this->load->library('session');
        $email = $this->input->post('email');
        $employeeno = $this->input->post('employeeno');
        $query = $this->db->query("Select * from employee where employeeno='{$employeeno}'");
        $empsearch = $query->result();
        $count = 0;
        $subject = "";
        $photo = "";
        if (isset($_SESSION['file'])) {
            $photo = $_SESSION['file'];
        } else {
            $photo = "";
        }
        //update Photo
        if ($photo == "" or $photo == "uploads/") {
        } else {
            $query = $this->db->query("update employee set photo='{$photo}' where employeeno='{$employeeno}'");
            $query->result();
        }
        //echo $photo;
        foreach ($empsearch as $value) {
            $count = $count + 1;
            $subject = "Number";
        }

        $query = $this->db->query("Select * from employee where emailaddress='{$email}'");
        $empsearch = $query->result();
        foreach ($empsearch as $value) {
            $count = $count + 1;
            $subject = "Email";
        }

        $data = array(

            //'employeeno'=>$this->input->post('employeeno'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'othernames' => $this->input->post('othernames'),
            'allnames' => $this->input->post('firstname') . " " . $this->input->post('lastname') . " " . $this->input->post('othernames'),
            'emailaddress' => $this->input->post('email'),
            'gendercode' => $this->input->post('gendercode'),
            'designationcode' => $this->input->post('designationcode'),
            'departmentcode' => $this->input->post('departmentcode'),
            'countrycode' => $this->input->post('countrycode'),
            'employeetype' => $this->input->post('employeetype'),
            'hod' => $this->input->post('hod'),
            'physicaladdress' => $this->input->post('physicaladdress'),
            'telephone' => $this->input->post('phone'),
            'officeno' => $this->input->post('officeno'),
            'approvallevel' => $this->input->post('approvallevel'),
            'firstapprover' => $this->input->post('firstapprover'),
            'altfirstapprover' => $this->input->post('altfirstapprover'),
            'secondapprover' => $this->input->post('secondapprover'),
            'altsecondapprover' => $this->input->post('altsecondapprover'),
            'altthirdapprover' => $this->input->post('altthirdapprover'),
            'thirdapprover' => $this->input->post('thirdapprover'),
            'datehired' => date('Y-m-d', strtotime($this->input->post('datehired'))),
            'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
            'monday' => $this->input->post('countmonday'),
            'tuesday' => $this->input->post('counttuesday'),
            'wednesday' => $this->input->post('countwednesday'),
            'thursday' => $this->input->post('countthursday'),
            'friday' => $this->input->post('countfriday'),
            'saturday' => $this->input->post('countsaturday'),
            'sunday' => $this->input->post('countsunday'),
            'holiday' => $this->input->post('countholiday'),
            //'photo'=>$photo,

        );
        $this->db->where('employeeno', $employeeno);
        $this->db->update('employee', $data);
        //echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            echo "Success";
        } else {
            echo "failed, ";
        }

    }

    public function loademployeeinfo($staffidno)
    {

        $query = $this->db->query("Select * from employee where employeeno='{$staffidno}'");
        return $query->result();

    }

    public function upload()
    {
        $this->load->library('session');

        //$this->load->library('upload');
        $this->load->helper('file', array('url'));
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '300000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        $field_name = "photofile";
        $this->upload->do_upload($field_name);

        $errors = $this->upload->display_errors();

        if ($errors == 0) {
            $file = $this->upload->data();
            $invalid = 0;
        } else {
            echo 'Invalid File';
            $invalid = 1;
            //return false;
        }
        //getting File Names
        if ($invalid == 0) {
            $efile = 'uploads/' . $file['file_name'];

            $_SESSION['file'] = $efile;

        } else {
            $_SESSION['file'] = "";
            //return false;
        }

    }

    public function determinefirstdate()
    {
        $count = 0;
        $startdate = date("Y-m-d", strtotime($this->input->post('startdate')));

        $startdate = date('Y-m-d', strtotime("2016-12-18"));
        $startdate = $this->countgetWeekend($startdate);
        $startdate = $this->checkholiday($startdate);

        echo $startdate;
        //$this->determinelastdate($startdate);
        $_SESSION['lastdate'] = $startdate;
    }

    public function determinelastdate()
    {
        $numofdays = $this->input->post('numofdays');
        $lastdate = date("Y-m-d", strtotime($this->input->post('startdate')));
        //$numofdays=3;
        //$lastdate=$startdate;
        for ($x = 1; $x < $numofdays; $x++) {
            if ($x == 1 and $numofdays == 1) {
                $lastdate = date("Y-m-d", strtotime($startdate));

            } else {
                $lastdate = date("Y-m-d", strtotime("+1 days", strtotime($lastdate)));
            }

            if ($numofdays == 1 and $x == 1) {
                $lastdate = date("Y-m-d", strtotime($startdate));
            } else {
                $lastdate = $this->countgetWeekend($lastdate);
                $lastdate = $this->checkholiday($lastdate);
            }
        }
        echo $lastdate;
        $_SESSION['lastdate'] = $lastdate;
        //$this->determinedateexpected($lastdate);

    }

    public function determinedateexpected()
    {

        $dateexpected = date("Y-m-d", strtotime("+1 days", strtotime($this->input->post('lastdate'))));
        //$dateexpected=date("Y-m-d", strtotime("+1 days", strtotime($lastdate)));

        //$dateexpected=$this->countgetWeekend($dateexpected);
        //$dateexpected=$this->checkholiday($dateexpected);

        echo $dateexpected;
        $_SESSION['dateexpected'] = $dateexpected;
    }

    public function countgetWeekend($date)
    {
        $weekDay = date('w', strtotime($date));
        $count = 0;
        if ($weekDay == 6) {
            $count = 2;
        } else if ($weekDay == 0) {
            $count = 1;
        } else {
            $count = 0;
        }
        $date = date("Y-m-d", strtotime("+" . $count . " days", strtotime($date)));
        return $date;
    }

    public function isweekend($date)
    {
        $weekDay = date('w', strtotime($date));
        $count = 0;
        if ($weekDay == 6) {
            $count = 1;
        } else if ($weekDay == 0) {
            $count = 2;
        } else {
            $count = 0;
        }
        $date = date("Y-m-d", strtotime("+" . $count . " days", strtotime($date)));
        return $date;
    }

    public function checkholiday($strdate)
    {
        $curday = date('d', strtotime($strdate));
        $curmonth = date('m', strtotime($strdate));
        $count = 0;
        $query = $this->db->query("SELECT * FROM paramholiday WHERE holidaydate='{$curday}' and holidaymonth='{$curmonth}'");
        $holsearch = $query->result();
        foreach ($holsearch as $value) {
            $count = $count + 1;
        }

        $strdate = date("Y-m-d", strtotime("+" . $count . " days", strtotime($strdate)));
        return $strdate;
    }

    public function uploadxxx()
    {
        $this->load->library('session');

        //$this->load->library('upload');
        $this->load->helper('file', array('url'));
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        $field_name = "photofile";
        $this->upload->do_upload($field_name);
        $errors = $this->upload->display_errors();
        if ($errors == 0) {
            $file = $this->upload->data();
            $invalid = 0;
        } else {
            echo '<p>' . 'Invalid File' . '</p>';
            $invalid = 1;
            return false;
        }
        //getting File Names
        if ($invalid == 0) {
            $efile = 'uploads/' . $file['file_name'];

            $_SESSION['file'] = $efile;

        } else {
            $_SESSION['file'] = "";
            return false;
        }

    }

    public function getpendingapprovals($staffidno)
    {
        $query = $this->db->query("Select e.*,a.* from leaveapplications a inner join employee e on e.employeeno=a.staffidno where (e.firstapprover='{$staffidno}' or  e.secondapprover='{$staffidno}' or e.thirdapprover='{$staffidno}' or e.altfirstapprover='{$staffidno}' or  e.altsecondapprover='{$staffidno}' or e.altthirdapprover='{$staffidno}')  and (a.authorized is null or a.approved is null  or a.secondapproval is null or a.thirdapproval is null or a.authorized is null) and Cancelled is null");

        return $query->result();
    }

    public function getallauthorized($staffidno)
    {
        $query = $this->db->query("Select e.*,a.* from leaveapplications a inner join employee e on e.employeeno=a.staffidno where (e.firstapprover='{$staffidno}' or  e.secondapprover='{$staffidno}' or e.thirdapprover='{$staffidno}' or e.altfirstapprover='{$staffidno}' or  e.altsecondapprover='{$staffidno}' or e.altthirdapprover='{$staffidno}')  and (a.authorized='Y') AND Cancelled is null Order by a.AppNum limit 10");

        return $query->result();
    }

    public function shownotifications($staffidno)
    {
        $query = $this->db->query("Select e.*,a.* from notifications a inner join employee e on e.employeeno=a.staffidno where a.staffidno='{$staffidno}' and a.deleted is null order by a.transactionno  limit 4");

        return $query->result();
    }

    public function createcurrentperiod()
    {

        $dtstartdate = date('Y-m') . "-01";
        $dtlastdate = date('Y-m', strtotime($dtstartdate)) . "-" . date('t');
        $currentperiod = date("Y", strtotime($dtlastdate)) . "/" . date("m", strtotime($dtlastdate));
        $monthname = date("M", strtotime($dtstartdate));
        $currentyear = date("Y", strtotime($dtstartdate));
        $currentmonth = date("m", strtotime($dtstartdate));
        $workingdays = date("t", strtotime($dtstartdate));
        $currentratio = date("d") / date("t", strtotime($dtstartdate));
        //echo $currentratio;
        //return false;
        //check if the periods exists
        $_SESSION['CurrentPeriod'] = $currentperiod;
        $query = $this->db->query("Select * from pcurrentperiod where currentperiod='{$currentperiod}'");

        if ($query->num_rows() == 0) {
            $data = array(

                'currentyear' => $currentyear,
                'currentmonth' => $currentmonth,
                'startdate' => $dtstartdate,
                'lastdate' => $dtlastdate,
                'monthname' => $monthname,
                'currentperiod' => $currentperiod,
                'workingdays' => $workingdays,
                'currentratio' => $currentratio,
            );
            $this->db->insert('pcurrentperiod', $data);
        } else {
            $query = $this->db->query("Update pcurrentperiod set currentratio='{$currentratio}' where currentperiod='{$currentperiod}'");
            //$query->result();
        }

        return ($currentperiod);
    }

}
