<?php

class Application_model extends CI_Model
{

    public function view_all()
    {
        $query = $this->db->get('ppaint');
        return $query->result();
    }

    public function loadempinfo($staffidno)
    {

        $query = $this->db->query("Select * from employee where employeeno='{$staffidno}'");
        $empsearch = $query->result();
        foreach ($empsearch as $value) {
            $_SESSION['employeeno'] = $value->employeeno;
            $_SESSION['firstname'] = $value->firstname;
            $_SESSION['lastname'] = $value->lastname;
            $_SESSION['othernames'] = $value->othernames;
            $_SESSION['allnames'] = $value->allnames;
            $_SESSION['emailaddress'] = $value->emailaddress;
            $_SESSION['gendercode'] = $value->gendercode;
            $_SESSION['designationcode'] = $value->designationcode;
            $_SESSION['departmentcode'] = $value->departmentcode;
            $_SESSION['countrycode'] = $value->countrycode;
            $_SESSION['employeetype'] = $value->employeetype;
            $_SESSION['hod'] = $value->hod;
            $_SESSION['physicaladdress'] = $value->physicaladdress;
            $_SESSION['telephone'] = $value->telephone;
            $_SESSION['officeno'] = $value->officeno;
            $_SESSION['approvallevel'] = $value->approvallevel;
            $_SESSION['firstapprover'] = $value->firstapprover;
            $_SESSION['altfirstapprover'] = $value->altfirstapprover;
            $_SESSION['secondapprover'] = $value->secondapprover;
            $_SESSION['altsecondapprover'] = $value->altsecondapprover;
            $_SESSION['altthirdapprover'] = $value->altthirdapprover;
            $_SESSION['thirdapprover'] = $value->thirdapprover;
        }
    }

    public function loadstudinfo($studentinfo)
    {

        $query = $this->db->query("Select student.*,course.* from student,course where student.course_id=course.course_id and  regno='{$studentinfo}'");
        //echo $this->db->last_query();
        $empsearch = $query->result();

        foreach ($empsearch as $value) {
            $_SESSION['regno'] = $value->regno;
            $_SESSION['name'] = $value->name;
            $_SESSION['email'] = $value->email;
            $_SESSION['mobile'] = $value->mobile;
            $_SESSION['course'] = $value->description;

        }
    }
    //Global delete Function. Result is accessed on the page by javascript
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
    //return single value from a table
    public function getsinglevalue($field, $table, $value, $returnvalue)
    {

        //$query="Select ".$field." from ".$table." where ".$returnvalue."='".$value."'";

        $query = $this->db->query("Select " . $field . " from " . $table . " where " . $returnvalue . "='" . $value . "'");
        $empsearch = $query->result();
        $rvalue = "*******";
        foreach ($empsearch as $value) {
            $rvalue = $value->$field;
        }
        return $rvalue;

    }
    //function to save employees. Note that validation are done using javascript
    public function saveemployees()
    {

        $this->load->library('session');
        $email = $this->input->post('email');
        $employeeno = $this->input->post('employeeno');
        $query = $this->db->query("Select * from employee where employeeno='{$employeeno}'");
        $empsearch = $query->result();
        $count = 0;
        $subject = "";
        foreach ($empsearch as $value) {
            $count = $count + 1;
            $subject = "Number";
        }
        //check if the same email was previously used by another staff
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
                'photo' => $_SESSION['file'],

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
    //upload file function
    public function upload()
    {
        $this->load->library('session');

        $this->load->helper('file', array('url'));
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        $field_name = "photofile";
        $this->upload->do_upload($field_name);

        if ($this->upload->do_upload($field_name)) {
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

    public function checkifleavedatesexist($StartDate, $LastDate, $staffidno)
    {
        $query = $this->db->query("SELECT * from leaveapplications where ((LastDate between '{$StartDate}' and '{$LastDate}') or (StartDate between '{$StartDate}' and '{$LastDate}')) and StaffIDNo='{$staffidno}' ");
        $chdatesearch = $query->result();
        $count = 0;
        foreach ($chdatesearch as $value) {
            $count = $count + 1;
        }
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function leaveapplications()
    {
        // $this->load->library('session');
        //load email model
        $this->load->model('Email_model');

        $staffidno = $_SESSION['employeeno'];
        $leavetype = $this->input->post('leavetype');
        $numberofleave = $this->input->post('numberofleave');
        if ($numberofleave == 0) {
            echo "Number Of Leave Cannot Be Zero";
            return false;
        }
        $balancebf = $this->loadopenningbalance($leavetype);
        $currentperiod = $this->openningperiod();
        $staffidno = $_SESSION['staffidno'];
        $query = $this->db->query("SELECT sum(leavetaken) as leavetaken, sum(LeaveEarned) as leaveearned,sum(LeaveForfeited) as leaveforfeited,LeaveEntitlement FROM leavecontrolfile L inner join employee E on L.staffidno=E.employeeno and L.staffidno='{$staffidno}' and L.leavetype='{$leavetype}' and L.currentperiod>'{$currentperiod}'");
        $holsearch = $query->result();
        $entitlement = 0;
        $currentleave = 0;
        $leaveearned = 0;
        $leaveforfeited = 0;
        $leavetaken = 0;
        $Leavebalance = 0;
        $attachdoc = "";
        $save = false;
        foreach ($holsearch as $value) {
            if ($value->leaveearned == null) {
                $leaveearned = 0;
            } else {
                $leaveearned = $value->leaveearned;
            }
            if ($value->leaveforfeited == null) {
                $leaveforfeited = 0;
            } else {
                $leaveforfeited = $value->leaveforfeited;
            }

            if ($value->LeaveEntitlement == null) {
                $entitlement = 0;
            } else {
                $entitlement = $value->LeaveEntitlement;
            }

            if ($value->leavetaken == null) {
                $leavetaken = 0;
            } else {
                $leavetaken = $value->leavetaken;
            }

        }
        $currentleave = $leaveearned + $balancebf; //current Leave
        $Leavebalance = $currentleave - $leavetaken; //balance bf
        $leavecfwd = ($Leavebalance - $numberofleave); //get balance carried forwad
        $StartDate = $this->input->post('startdate');
        $LastDate = $this->input->post('lastdate');
        $appnum = $this->getnextapplicationno(); //generate The application Number

        //echo $this->checkifleavedatesexist($StartDate,$LastDate,$staffidno);

        if ($this->checkifleavedatesexist($StartDate, $LastDate, $staffidno) == false) {
            echo "There is a nother Leave That Exists between this two Leave Dates, Please Choose another Date Interval";
            return false;
        }

        $data = array(
            'staffidno' => $_SESSION['staffidno'],
            'appnum' => $appnum,
            'StartDate' => $this->input->post('startdate'),
            'DateApplied' => date("Y-m-d"),
            'LastDate' => $this->input->post('lastdate'),
            'DateExpected' => $this->input->post('dateexpected'),
            'DaysApplied' => $this->input->post('numberofleave'),
            'Comment' => $this->input->post('comments'),
            'LeaveType' => $this->input->post('leavetype'),
            //'attachment'=>$this->input->post('attachment'),
            'CurrentPeriod' => $_SESSION['CurrentPeriod'],
            'CurrentYear' => $_SESSION['CurrentYear'],
            'DeptCode' => $_SESSION['departmentcode'],
            'CountryCode' => $_SESSION['countrycode'],
            //'LeaveBFWD'=>$Leavebalance,
            'CurrentLeave' => $Leavebalance,
            'LeaveCFWD' => $leavecfwd,
        );
        $this->db->insert('leaveapplications', $data);
        if ((($this->db->affected_rows() != 1) ? false : true) == true) {
            $save = true;
        } else {
            echo "Leave Application Failed";
            return false;
        }
        if ($save == true) {
            $newSQL = array(
                'AppNum' => $appnum,
                'StaffIDNo' => $_SESSION['staffidno'],
                'CurrentYear' => $_SESSION['CurrentYear'],
                'CurrentPeriod' => $_SESSION['CurrentPeriod'],
                'LeaveType' => $this->input->post('leavetype'),
                'DaysApplied' => $this->input->post('numberofleave'),
                'FirstApprover' => $this->getsinglevalue("firstapprover", "employee", $_SESSION['staffidno'], "employeeno"),
                'SecondApprover' => $this->getsinglevalue("secondapprover", "employee", $_SESSION['staffidno'], "employeeno"),
                'ThirdApprover' => $this->getsinglevalue("thirdapprover", "employee", $_SESSION['staffidno'], "employeeno"),
                'AttachedDoc' => $attachdoc,
            );
            $this->db->insert('leaveapprovals', $newSQL);
            //Get the Approver to send email to plus the email address of the applicant

            $staffemailaddress = $this->getsinglevalue("emailaddress", "employee", $_SESSION['staffidno'], "employeeno");
            $allnames = $this->getsinglevalue("allnames", "employee", $_SESSION['staffidno'], "employeeno");
            $firstapprover = $this->getsinglevalue("firstapprover", "employee", $_SESSION['staffidno'], "employeeno");
            $firstapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $firstapprover, "employeeno");
            $approvername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

            $email_subject = "Leave Pending First Approval";
            $email_message = "Hi " . $approvername . " I have Applied For Leave From The System Kindly Login To Approve,Thank You";

            if ((($this->db->affected_rows() != 1) ? false : true) == true) {
                //Send Email To the Approver Otherwise Return Success/Notify the Managers
                $resultx = $this->Email_model->send_mailApprovers($staffemailaddress, $firstapproveremailaddress, $email_subject, $email_message);

                $notify = $this->updatenotifications($firstapprover, $email_message, "Leave Approval");
                echo $resultx;
            } else {
                echo "Leave Application Failed";
            }
        } else {
            echo "Leave Application Failed";
        }

    }

    public function determinefirstdate()
    {
        $count = 0;
        $startdate = date("Y-m-d", strtotime($this->input->post('startdate')));

        //$startdate=date('Y-m-d',strtotime("2016-12-18"));
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

    public function loadopenningbalance($leavetype)
    {
        $openningperiod = $this->openningperiod();
        $staffidno = $_SESSION['staffidno'];
        $query = $this->db->query("SELECT * FROM leavecontrolfile L inner join employee E on L.staffidno=E.employeeno and L.staffidno='{$staffidno}' and L.leavetype='{$leavetype}' and L.currentperiod='{$openningperiod}'");
        $holsearch = $query->result();
        $opennigbalance = 0;
        foreach ($holsearch as $value) {
            $opennigbalance = $value->LeaveBFWD;
        }
        return $opennigbalance;
    }

    public function openningperiod()
    {

        $query = $this->db->query("SELECT * FROM company where companycode='{$_SESSION['companycode']}'");
        $holsearch = $query->result();
        $openningperiod = date('Y') . "/01";
        // $openningdate = "";
        // foreach ($holsearch as $value) {
        // $openningdate = $value->openningdate;
        //  $openningperiod = (date('Y', strtotime($openningdate))) . "/" . (date('m', strtotime($openningdate)));
        //  }
        return $openningperiod;
    }

    public function currentperiod()
    {
        $this->load->library('session');
        $currentPeriod = $_SESSION['CurrentPeriod'];
        $query = $this->db->query("SELECT * FROM pcurrentperiod where currentperiod='{$currentPeriod}' order by currentperiod desc limit 1");
        $holsearch = $query->result();
        $currentperiod = "";
        foreach ($holsearch as $value) {
            $currentperiod = $value->currentperiod;

        }
        return $currentperiod;
    }

    public function currentactiveperiod()
    {
        $this->load->library('session');
        $currentPeriod = $_SESSION['CurrentPeriod'];
        $query = $this->db->query("SELECT * FROM pcurrentperiod where currentperiod='{$currentPeriod}'  order by currentperiod asc limit 1");
        $holsearch = $query->result();
        $currentperiod = "";
        foreach ($holsearch as $value) {
            $currentperiod = $value->currentperiod;

        }
        return $currentperiod;
    }

    public function currentactiveyear()
    {
        $this->load->library('session');
        $currentPeriod = $_SESSION['CurrentPeriod'];
        $query = $this->db->query("SELECT * FROM pcurrentperiod where currentperiod='{$currentPeriod}'  order by currentperiod asc limit 1");
        $holsearch = $query->result();
        $currentperiod = "";
        foreach ($holsearch as $value) {
            $currentyear = $value->currentyear;

        }
        return $currentyear;
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

        if ($this->upload->do_upload($field_name)) {
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

    public function getnextapplicationno()
    {
        $query = $this->db->query("SELECT MAX(AppNum) AS lastid FROM LeaveApplications;");
        $holishitget = $query->result();
        $lastid = 1;
        foreach ($holishitget as $value) {
            if ($value->lastid == null) {
                $lastid = 1;
            } else {
                $lastid = $value->lastid + 1;
            }
        }
        //echo $lastid;
        return $lastid;
    }

    public function approveleave()
    {
        $appnum = $this->input->post('appnum');
        $level = $this->input->post('level');
        $Leavetype = $this->input->post('Leavetype');
        $daysapplied = $this->input->post('daysapplied');
        $startdate = $this->input->post('startdate');
        $lastdate = $this->input->post('lastdate');
        $dateexpected = $this->input->post('dataexpected');
        $comments = $this->input->post('comments');
        $step = $this->input->post('step');
        //$step=1;
        //$appnum=1;
        if ($step == 1) {
            if ($level == 1) { //update Leave Application Table
                $data = array(
                    'Approved' => "Y",
                    'Authorized' => "Y",

                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapplications', $data);
                //Update Approval table
                $data = array(
                    'Approved' => "Y",
                    'Authorized' => "Y",
                    'DaysApproved' => $daysapplied,
                    'ApprovalDate' => date("Y-m-d"),
                    'AprStartDate' => $startdate,
                    'AprLastDate' => $lastdate,
                    'AprDateExpected' => $dateexpected,
                    'AprComments' => $comments,
                    'DaysAuthorized' => $daysapplied,
                    'AuthStartDate' => $startdate,
                    'AuthLastDate' => $lastdate,
                    'AuthorizationDate' => $startdate,
                    'DateAuthorized' => $startdate,
                    'AuthDateExpected' => $dateexpected,
                    'AuthComments' => $comments,
                    'AuthorizedBy' => $_SESSION["staffidno"],
                    'ApprovedBy' => $_SESSION["staffidno"],
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapprovals', $data);

                echo ("Approval success" . "<br>");
                //........Prepare For Email Notification to The approvers and notifications
                //........Employee Details
                $staffappnum = $this->getsinglevalue("StaffIDNo", "leaveapplications", $appnum, "AppNum");
                $staffemailaddress = $this->getsinglevalue("emailaddress", "employee", $staffappnum, "employeeno");
                $allnames = $this->getsinglevalue("allnames", "employee", $staffappnum, "employeeno");

                //........First Approver Details
                $firstapprover = $this->getsinglevalue("firstapprover", "employee", $staffappnum, "employeeno");
                $firstapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $firstapprover, "employeeno");
                $approvername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

                //........Second Approver Details
                $secondapprover = $this->getsinglevalue("secondapprover", "employee", $staffappnum, "employeeno");
                $secondapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $secondapprover, "employeeno");
                $secondapprovername = $this->getsinglevalue("allnames", "employee", $secondapprover, "employeeno");

                //........Mail Set Up
                $email_subject = "Your Leave Application Authozed";
                $startdate = date('F,d Y', strtotime($startdate));
                $email_message = "Hi " . $allnames . ",  Your Leave Application has gone through The final Authorization Step,Day(s) Approved are " . $daysapplied . " and Your Leave Start Date is " . $startdate . "',Thank You.";
                $notify = $this->updatenotifications($staffappnum, $email_message, "Leave Approval");
                if ((($this->db->affected_rows() != 1) ? false : true) == true) {
                    //Send Email To the Approver Otherwise Return Success/Notify the Managers
                    $resultx = $this->Email_model->send_mailApprovers($secondapproveremailaddress, $staffemailaddress, $email_subject, $email_message);
                    echo $resultx;

                } else {
                    echo "Leave Approval Failed";
                }

            } else {
                $data = array(
                    'Approved' => "Y",
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapplications', $data);
                //Update Approval table
                $data = array(
                    'Approved' => "Y",
                    'DaysApproved' => $daysapplied,
                    'AprStartDate' => $startdate,
                    'AprLastDate' => $lastdate,
                    'AprDateExpected' => $dateexpected,
                    'ApprovalDate' => date("Y-m-d"),
                    'AprComments' => $comments,
                    'ApprovedBy' => $_SESSION["staffidno"],
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapprovals', $data);
                echo ("Approval success" . "<br>");
                //........Prepare For Email Notification to The approvers and notifications
                //........Employee Details
                $staffappnum = $this->getsinglevalue("StaffIDNo", "leaveapplications", $appnum, "AppNum");
                $staffemailaddress = $this->getsinglevalue("emailaddress", "employee", $staffappnum, "employeeno");
                $allnames = $this->getsinglevalue("allnames", "employee", $staffappnum, "employeeno");

                //........First Approver Details
                $firstapprover = $this->getsinglevalue("firstapprover", "employee", $staffappnum, "employeeno");
                $firstapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $firstapprover, "employeeno");
                $approvername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

                //........Second Approver Details
                $secondapprover = $this->getsinglevalue("secondapprover", "employee", $staffappnum, "employeeno");
                $secondapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $secondapprover, "employeeno");
                $secondapprovername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

                //........Mail Set Up
                $email_subject = "Leave Pending Second Approval";
                $startdate = date('F,d Y', strtotime($startdate));
                $email_message = "Hi " . $secondapprovername . ",  I have Approved Leave for " . $allnames . " Kindly Approve to facilitate the next step of action,Thank You.";
                if ((($this->db->affected_rows() != 1) ? false : true) == true) {
                    $noficationmessege = "Hi " . $allnames . ",  Your Leave Application has gone through The First Approval Step,Day(s) Approved are " . $daysapplied . " and Your Leave Start Date is " . $startdate . "',Thank You.";

                    $notify = $this->updatenotifications($staffappnum, $noficationmessege, "Leave Approval");

                    //Send Email To the Approver Otherwise Return Success/Notify the Managers
                    $resultx = $this->Email_model->send_mailApprovers($firstapproveremailaddress, $secondapproveremailaddress, $email_subject, $email_message);

                    echo $resultx;
                } else {
                    echo "Leave Approval Failed";
                }
            }

        }

        ///second approval
        if ($step == 2) {
            if ($level == 2) {
                $data = array(
                    'SecondApproval' => "Y",
                    'Authorized' => "Y",

                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapplications', $data);
                //Update Approval table
                $data = array(
                    'SecondApproval' => "Y",
                    'Authorized' => "Y",
                    'DaysAuthorized' => $daysapplied,
                    'AuthStartDate' => $startdate,
                    'AuthLastDate' => $lastdate,
                    'AuthDateExpected' => $dateexpected,
                    'AuthorizationDate' => date("Y-m-d"),
                    'SecondApprovalDate' => date("Y-m-d"),
                    'AprComments' => $comments,
                    'SecondApprovalDays' => $daysapplied,
                    'SecondApprovalStartDate' => $startdate,
                    'SecondApprovalLastDate' => $lastdate,
                    'AuthorizationDate' => $startdate,
                    'DateAuthorized' => $startdate,
                    'SecondApprovalDateExpected' => $dateexpected,
                    'SecondApprovalBy' => $_SESSION["staffidno"],
                    'AuthorizedBy' => $_SESSION["staffidno"],
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapprovals', $data);
                echo ("Second Approval success" . "<br>");

                //........Prepare For Email Notification to The approvers and notifications
                //........Employee Details
                $staffappnum = $this->getsinglevalue("StaffIDNo", "leaveapplications", $appnum, "AppNum");
                $staffemailaddress = $this->getsinglevalue("emailaddress", "employee", $staffappnum, "employeeno");
                $allnames = $this->getsinglevalue("allnames", "employee", $staffappnum, "employeeno");

                //........First Approver Details
                $firstapprover = $this->getsinglevalue("firstapprover", "employee", $staffappnum, "employeeno");
                $firstapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $firstapprover, "employeeno");
                $approvername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

                //........Second Approver Details
                $secondapprover = $this->getsinglevalue("secondapprover", "employee", $staffappnum, "employeeno");
                $secondapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $secondapprover, "employeeno");
                $secondapprovername = $this->getsinglevalue("allnames", "employee", $secondapprover, "employeeno");

                //........Second Approver Details
                $thirdapprover = $this->getsinglevalue("thirdapprover", "employee", $staffappnum, "employeeno");
                $thirdapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $thirdapprover, "employeeno");
                $thirdapprovername = $this->getsinglevalue("allnames", "employee", $thirdapprover, "employeeno");

                //........Mail Set Up
                $email_subject = "Your Leave Application Authozed";
                $startdate = date('F,d Y', strtotime($startdate));
                $email_message = "Hi " . $allnames . ",  Your Leave Application has gone through The final Authorization Step,Day(s) Approved are " . $daysapplied . " and Your Leave Start Date is " . $startdate . "',Thank You.";
                $noficationmessege = "Hi " . $allnames . ",  Your Leave Application has gone through The First Approval Step,Day(s) Approved are " . $daysapplied . " and Your Leave Start Date is " . $startdate . "',Thank You.";

                $notify = $this->updatenotifications($staffappnum, $email_message, "Leave Approval");

                if ((($this->db->affected_rows() != 1) ? false : true) == true) {

                    //Send Email To the Approver Otherwise Return Success/Notify the Managers
                    $resultx = $this->Email_model->send_mailApprovers($thirdapproveremailaddress, $staffemailaddress, $email_subject, $email_message);

                    echo $resultx;
                } else {
                    echo "Leave Approval Failed";
                }
            } else {
                $data = array(
                    'SecondApproval' => "Y",
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapplications', $data);
                //Update Approval table
                $data = array(
                    'SecondApproval' => "Y",
                    'DaysAuthorized' => $daysapplied,
                    'AuthStartDate' => $startdate,
                    'AuthLastDate' => $lastdate,
                    'AuthDateExpected' => $dateexpected,
                    'SecondApprovalDays' => $daysapplied,
                    'SecondApprovalStartDate' => $startdate,
                    'AprComments' => $comments,
                    'SecondApprovalLastDate' => $lastdate,
                    'SecondApprovalDateExpected' => $dateexpected,
                    'SecondApprovalBy' => $_SESSION["staffidno"],
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapprovals', $data);
                echo ("Second Approval success" . "<br>");
                //........Prepare For Email Notification to The approvers and notifications
                //........Employee Details
                $staffappnum = $this->getsinglevalue("StaffIDNo", "leaveapplications", $appnum, "AppNum");
                $staffemailaddress = $this->getsinglevalue("emailaddress", "employee", $staffappnum, "employeeno");
                $allnames = $this->getsinglevalue("allnames", "employee", $staffappnum, "employeeno");

                //........First Approver Details
                $firstapprover = $this->getsinglevalue("firstapprover", "employee", $staffappnum, "employeeno");
                $firstapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $firstapprover, "employeeno");
                $approvername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

                //........Second Approver Details
                $secondapprover = $this->getsinglevalue("secondapprover", "employee", $staffappnum, "employeeno");
                $secondapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $secondapprover, "employeeno");
                $secondapprovername = $this->getsinglevalue("allnames", "employee", $secondapprover, "employeeno");

                //........Second Approver Details
                $thirdapprover = $this->getsinglevalue("thirdapprover", "employee", $staffappnum, "employeeno");
                $thirdapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $thirdapprover, "employeeno");
                $thirdapprovername = $this->getsinglevalue("allnames", "employee", $thirdapprover, "employeeno");

                //........Mail Set Up
                $email_subject = "Leave Pending Third Approval";
                $startdate = date('F,d Y', strtotime($startdate));
                $email_message = "Hi " . $thirdapprovername . ",  I have Approved Leave for " . $allnames . " Kindly Approve to facilitate the next step of action,Thank You.";
                if ((($this->db->affected_rows() != 1) ? false : true) == true) {
                    $noficationmessege = "Hi " . $allnames . ",  Your Leave Application has gone through The Second Approval Step,Day(s) Approved are " . $daysapplied . " and Your Leave Start Date is " . $startdate . "',Thank You.";
                    $notify = $this->updatenotifications($staffappnum, $noficationmessege, "Leave Approval");
                    //Send Email To the Approver Otherwise Return Success/Notify the Managers
                    $resultx = $this->Email_model->send_mailApprovers($secondapproveremailaddress, $thirdapproveremailaddress, $email_subject, $email_message);

                    echo $resultx;
                } else {
                    echo "Leave Approval Failed";
                }

            }
        }
        //end of second approval

        if ($step == 3) {
            if ($level == 3) {
                $data = array(
                    'ThirdApproval' => "Y",
                    'Authorized' => "Y",
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapplications', $data);
                //Update Approval table
                $data = array(
                    'ThirdApproval' => "Y",
                    'Authorized' => "Y",
                    'DaysAuthorized' => $daysapplied,
                    'AuthStartDate' => $startdate,
                    'AuthLastDate' => $lastdate,
                    'AuthDateExpected' => $dateexpected,
                    'ThirdApprovalDays' => $daysapplied,
                    'ThirdApprovalStartDate' => $startdate,
                    'ThirdApprovalLastDate' => $lastdate,
                    'ThirdApprovalDateExpected' => $dateexpected,
                    'AuthorizationDate' => $startdate,
                    'DateAuthorized' => date("Y-m-d"),
                    'AuthComments' => $comments,
                    'ThirdApprovalBy' => $_SESSION["staffidno"],
                    'AuthorizedBy' => $_SESSION["staffidno"],
                );
                $this->db->where('AppNum', $appnum);
                $this->db->update('leaveapprovals', $data);
                echo ("Final Approval success");
                //........Prepare For Email Notification to The approvers and notifications
                //........Employee Details
                $staffappnum = $this->getsinglevalue("StaffIDNo", "leaveapplications", $appnum, "AppNum");
                $staffemailaddress = $this->getsinglevalue("emailaddress", "employee", $staffappnum, "employeeno");
                $allnames = $this->getsinglevalue("allnames", "employee", $staffappnum, "employeeno");

                //........First Approver Details
                $firstapprover = $this->getsinglevalue("firstapprover", "employee", $staffappnum, "employeeno");
                $firstapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $firstapprover, "employeeno");
                $approvername = $this->getsinglevalue("allnames", "employee", $firstapprover, "employeeno");

                //........Second Approver Details
                $secondapprover = $this->getsinglevalue("secondapprover", "employee", $staffappnum, "employeeno");
                $secondapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $secondapprover, "employeeno");
                $secondapprovername = $this->getsinglevalue("allnames", "employee", $secondapprover, "employeeno");

                //........Second Approver Details
                $thirdapprover = $this->getsinglevalue("thirdapprover", "employee", $staffappnum, "employeeno");
                $thirdapproveremailaddress = $this->getsinglevalue("emailaddress", "employee", $thirdapprover, "employeeno");
                $thirdapprovername = $this->getsinglevalue("allnames", "employee", $thirdapprover, "employeeno");

                //........Mail Set Up
                $email_subject = "Your Leave Application Authozed";
                $startdate = date('F,d Y', strtotime($startdate));
                $email_message = "Hi " . $allnames . ",  Your Leave Application has gone through The final Authorization Step,Day(s) Approved are " . $daysapplied . " and Your Leave Start Date is " . $startdate . "',Thank You.";
                if ((($this->db->affected_rows() != 1) ? false : true) == true) {

                    $notify = $this->updatenotifications($staffappnum, $email_message, "Leave Approval");

                    //Send Email To the Approver Otherwise Return Success/Notify the Managers
                    $resultx = $this->Email_model->send_mailApprovers($thirdapproveremailaddress, $staffemailaddress, $email_subject, $email_message);
                    echo $resultx;
                } else {
                    echo "Leave Approval Failed";
                }
            } else {
                echo ("Wrong Selection");
            }

        }

    }

    public function getpendingapprovalsnum($appnum)
    {
        $query = $this->db->query("Select e.*,a.* from leaveapplications a inner join employee e on e.employeeno=a.staffidno where a.appnum='{$appnum}'");

        return $query->result();
    }

    public function updatenotifications($staffidno, $notification, $type)
    {
        $data = array(
            'staffidno' => $staffidno,
            'notification' => $notification,
            'notificationdate' => date("Y-m-d h:m:s"),
            'type' => $type,
        );
        $this->db->insert('notifications', $data);
        return true;
    }

}
