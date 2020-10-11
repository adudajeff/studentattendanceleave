<?php

class Reports_model extends CI_Controller
{

    public function cleanleave($currentperiod, $staffidno)
    {

        $numLeaveDaysApplied = 0;
        $numLeaveCancelled = 0;
        $numApplications = 0;
        $numApprovals = 0;
        $numAuthorizations = 0;
        $numCancellations = 0;
        $numRecalls = 0;
        $numRejections = 0;
        $numLeaveDaysRejected = 0;
        $LeaveBFWD = 0;
        $leaveCFWD = 0;
        $currentleave = 0;
        $StaffIDNo = $staffidno;
        $numLeaveEarned = 0;
        $numLeaveTodate = 0;
        $leavetaken = 0;
        $query = $this->db->query("Select * from pcurrentperiod where currentperiod='{$currentperiod}'");
        $count = 0;
        if ($query->num_rows() > 0) {
            $leaveperiod = $query->result();
            foreach ($leaveperiod as $value) {
                $currentyear = $value->currentyear;
                $currentmonth = $value->currentmonth;
                $startdate = date("Y-m-d", strtotime($value->startdate));
                $lastdate = date("Y-m-d", strtotime($value->lastdate));
                $monthname = $value->monthname;
                $currentperiod = $value->currentperiod;
                $previousperiod = date('Y-m-d', strtotime('-1 day', strtotime($startdate)));
                $previousperiod = date("Y/m", strtotime($previousperiod));
                $workingdays = $value->workingdays;
                $currentratio = $value->currentratio;
            }
        }
        //get last month and period
        $dateTime = new DateTime($startdate);
        $lastmonth = $dateTime->modify('-' . $dateTime->format('d') . ' days')->format('Y-m-d');
        $lastperiod = date("Y", strtotime($lastmonth)) . "/" . date("m", strtotime($lastmonth));
        $openningperiod = $_SESSION['openningperiod'];

        $strPreviousPeriod = $lastperiod;
        $strCurrentYearUDT = $currentyear;
        //echo $openningperiod;
        //Select Leave type to create Leave Transactions

        $strLeaveType = "";
        $staffidno = "";
        if ($strLeaveType == "") {
            $query = $this->db->query("SELECT * FROM paramLeavetypes  WHERE (paramleavetypes.active = 'Y' or paramLeavetypes.Active = '1') And (dependent = 'N' or dependent IS NULL) ORDER BY paramleavetypes.leavetype ASC");
        } else {
            $query = $this->db->query("SELECT * FROM paramLeavetypes  WHERE (paramleavetypes.active = 'Y' or paramLeavetypes.Active = '1') And (dependent = 'N' or dependent IS NULL) AND paramLeavetypes.leavetype='{$strLeaveType}' ORDER BY paramleavetypes.leavetype ASC");
        }
        $strtype = $query->result();
        foreach ($strtype as $valuetype) {

            $strLeaveType = $valuetype->leavetype;
            $leavetype = $valuetype->leavetype;
            $isleaveearned = $valuetype->isleaveearned;
            $childleavetype = $valuetype->childleavetype;
            $isLeaveAwarded = $valuetype->isleaveawarded;
            if ($staffidno == "") {
                $strstaff = $this->db->query("SELECT * FROM employee LEFT OUTER JOIN LeaveConfig ON employee.employeetype = leaveconfig.emptype AND leaveconfig.leavetype = '{$leavetype}' AND leaveconfig.currentyear='{$strCurrentYearUDT}' WHERE employee.empstatus ='1' ");
                $strallstaffdata = $strstaff->result();
                //echo $this->db->last_query();
            } else {
                $strstaff = $this->db->query("SELECT * FROM employee LEFT OUTER JOIN LeaveConfig ON employee.employeetype = leaveconfig.emptype AND leaveconfig.leavetype = '{$leavetype}' AND leaveconfig.currentyear='{$strCurrentYearUDT}' WHERE employee.empstatus ='1'  AND employee.employeeno='{$StaffIDNo}'");
                $strallstaffdata = $strstaff->result();
            }

            foreach ($strallstaffdata as $rsstaff) {
                //number of Leave applications
                $staffidno = $rsstaff->employeeno;
                $StaffIDNo = $rsstaff->employeeno;
                $query = $this->db->query("SELECT * FROM leaveapplications WHERE leaveapplications.StaffIdNo = '{$staffidno}' AND (leaveapplications.LeaveType = '{$leavetype}' or leaveapplications.LeaveType = '{$childleavetype}') and (leaveapplications.StartDate >= '{$lastdate}' and leaveapplications.StartDate <= '{$startdate}') ORDER BY LeaveApplications.StaffIDNo");
                $strleaveapp = $query->result();
                foreach ($strleaveapp as $valueapp) {
                    $numApplications = $numApplications + 1;
                }

                //Compute The Number of Leave Applied
                $query = $this->db->query("SELECT Sum(daysapplied) as daysapplied FROM leaveapprovals WHERE leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or leaveapprovals.LeaveType = '{$childleavetype}' ) and ((leaveapprovals.aprStartDate >= '{$startdate}' and leaveapprovals.aprStartDate <= '{$lastdate}') or (leaveapprovals.AuthStartDate >= '{$startdate}' and leaveapprovals.AuthStartDate <= '{$lastdate}')) AND Authorized='1';");
                $strleaveapplied = $query->result();
                foreach ($strleaveapplied as $valueapplied) {
                    $numLeaveDaysApplied = $valueapplied->daysapplied;
                }

                //Compute The Number of Applications Approved
                $query = $this->db->query("SELECT * FROM leaveapprovals WHERE leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or leaveapprovals.LeaveType = '{$childleavetype}') and leaveapprovals.Approved = '1' and ((leaveapprovals.aprStartDate >= '{$startdate}' and leaveapprovals.aprStartDate <= '{$lastdate}') or (leaveapprovals.AuthStartDate >= '{$startdate}' and leaveapprovals.AuthStartDate <= '{$lastdate}'))ORDER BY leaveapprovals.StaffIDNo;");
                $strapprovals = $query->result();
                foreach ($strapprovals as $approvals) {
                    $numApprovals = $numApprovals + 1;
                }

                //This Procedure is used to count the Number of Days that have been approved
                $query = $this->db->query("SELECT sum(leaveapprovals.DaysApproved) as LeaveTodate  FROM leaveapprovals WHERE leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or leaveapprovals.LeaveType = '{$childleavetype}') and leaveapprovals.Authorized = 'Y' and ((leaveapprovals.aprStartDate >= '{$startdate}' and leaveapprovals.aprStartDate <= '{$lastdate}') or (leaveapprovals.AuthStartDate >= '{$startdate}' and leaveapprovals.AuthStartDate <= '{$lastdate}'))");
                $strtodate = $query->result();
                foreach ($strtodate as $todatevalue) {
                    $numLeaveTodate = $todatevalue->LeaveTodate;
                    if ($numLeaveTodate == null) {
                        $numLeaveTodate = 0;
                    }
                }
                //echo $this->db->last_query();
                //Compute The Number of Applications Cancelled
                $query = $this->db->query("SELECT * FROM leaveapplications WHERE leaveapplications.StaffIdNo = '{$StaffIDNo}' AND (leaveapplications.LeaveType = '{$leavetype}' or leaveapplications.LeaveType = '{$childleavetype}') and LeaveApplications.cancelled = 'Y' and (LeaveApplications.StartDate >= '{$startdate}' and leaveapplications.startDate <= '{$lastdate}') ORDER BY leaveapplications.StaffIDNo;");
                $rsCANCELLATIONS = $query->result();
                foreach ($rsCANCELLATIONS as $strvalue) {
                    $numCancellations = $numCancellations + 1;
                }

                //Compute The Totals of Applications Cancelled
                $query = $this->db->query("SELECT sum(leaveapprovals.DaysApproved) as LeaveCancelled  FROM leaveapprovals WHERE leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or leaveapprovals.LeaveType = '{$childleavetype}') and leaveapprovals.Authorized = 'Y' and leaveapprovals.Cancelled = 'Y' and (leaveapprovals.AprStartDate >= '{$startdate}' and leaveapprovals.AprLastDate <= '{$lastdate}')");
                $rsCANCELLATIONS = $query->result();
                foreach ($rsCANCELLATIONS as $strvalue) {
                    $numLeaveCancelled = $strvalue->LeaveCancelled;
                    if ($numLeaveCancelled == null) {
                        $numLeaveCancelled = 0;
                    }
                }

                //counts the number of rejections of a staff
                $query = $this->db->query("SELECT leaveapplications.* FROM leaveapprovals,leaveapplications WHERE leaveapplications.AppNum=leaveapprovals.AppNum AND leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or leaveapprovals.LeaveType = '{$childleavetype}') And (leaveapplications.Approved = 'N' OR leaveapplications.Authorized = 'N') and (leaveapplications.StartDate >= '{$startdate}' and leaveapplications.StartDate <= '{$lastdate}') ");
                $rsREJECTIONS = $query->result();
                foreach ($rsREJECTIONS as $strrejections) {
                    $numRejections = $numRejections + 1;
                }

                //counts the number of rejections of a staff
                $query = $this->db->query("SELECT sum(leaveapplications.DaysApplied) as DaysRejected FROM leaveapprovals,leaveapplications WHERE leaveapplications.AppNum=leaveapprovals.AppNum AND leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or LeaveApprovals.LeaveType = '{$childleavetype}') And (leaveapplications.Approved = 'N' OR leaveapplications.Authorized = 'N') and (leaveapplications.StartDate >= '{$startdate}' and leaveapplications.StartDate <= '{$lastdate}')");
                $rsREJECTIONS = $query->result();
                foreach ($rsREJECTIONS as $strrejections) {
                    $numLeaveDaysRejected = $strrejections->DaysRejected;
                    if ($numLeaveDaysRejected == null) {
                        $numLeaveDaysRejected = 0;
                    }
                }

                //counts the number of rejections of a staff
                $query = $this->db->query("SELECT * FROM LeaveApplications WHERE LeaveApplications.StaffIdNo = '{$StaffIDNo}' AND (LeaveApplications.LeaveType = '{$leavetype}' or LeaveApplications.LeaveType = '{$childleavetype}') and LeaveApplications.Recalled = 'Y' and (LeaveApplications.StartDate >= '{$startdate}' and LeaveApplications.StartDate <= '{$lastdate}') ORDER BY LeaveApplications.StaffIDNo;");
                $rsnumRecalls = $query->result();
                foreach ($rsnumRecalls as $strnumRecalls) {
                    $numRecalls = $numRecalls + 1;
                }

                //Get Previous Leave Balance
                $strcontrol = $this->db->query("SELECT * FROM LeaveControlFile WHERE LeaveControlFile.StaffIDNo = '{$StaffIDNo}' and LeaveControlFile.CurrentPeriod = '{$strPreviousPeriod}' and (LeaveControlFile.LeaveType ='{$leavetype}' or LeaveControlFile.LeaveType ='{$childleavetype}');");
                $strLeaveBFWD = $strcontrol->result();

                foreach ($strLeaveBFWD as $strvaluebfwd) {
                    $LeaveBFWD = $strvaluebfwd->LeaveBFWD;
                    if ($LeaveBFWD == null) {
                        $LeaveBFWD = 0;
                    }
                    // echo  $LeaveBFWD;
                }
                if ($isLeaveAwarded == "Y" and $LeaveBFWD == 0) {
                    $LeaveBFWD = $rsstaff->entitlement;
                    if ($LeaveBFWD == null) {
                        $LeaveBFWD = 0;
                    }
                }
                $emptype = $this->getsinglevalueglobe("employeetype", "employee", $StaffIDNo, "employeeno");
                $numentitlement = $rsstaff->entitlement;
                $datehired = $this->getsinglevalueglobe("datehired", "employee", $StaffIDNo, "employeeno");
                if ($numentitlement == null) {
                    $numentitlement = 0;
                }
                //echo $datehired;
                if ($valuetype->isleaveearned == "Y" and date("Y", strtotime($lastdate)) == date("Y", strtotime($datehired)) and $numentitlement > 0) {
                    $strdate = date("Y", strtotime($lastdate)) . "-12-31";
                    $strNoofDaysInYear = (date("z", strtotime($strdate)) + 1);
                    $strDaysElapsed = date("z", strtotime($datehired)) + 1;
                    $strDaysRemaining = $strNoofDaysInYear - $strDaysElapsed;
                    //rsSave("leaveEntitlement") = CInt(strDaysRemaining / strNoofDaysInYear * numLeaveEntitlement)
                    $numentitlement = number_format(($strDaysRemaining / $strNoofDaysInYear) * $numentitlement, 0);
                    // echo $numentitlement;
                }
                $leavetaken = $numLeaveTodate;
                $maximumcfwdleavedays = 0;
                //implement maximum carry forward_static_call
                //Implement the max carry forward days
                if ($currentperiod == $openningperiod) {
                    if ($valuetype->maximumcfwdleavedays == null) {
                        $maximumcfwdleavedays = 0;
                    } else {
                        $maximumcfwdleavedays = $valuetype->maximumcfwdleavedays;
                    }
                    if ($LeaveBFWD > $maximumcfwdleavedays) {
                        $LeaveBFWD = $maximumcfwdleavedays;
                    }

                }
                $numLeaveEarned = 0;
                $currentleave = 0;
                //Calculate Leave earned and currentleave
                if ($valuetype->isleaveearned == "Y") {
                    if (date("Y-m-d", strtotime($datehired)) <= $startdate) {

                        $numLeaveEarned = ($numentitlement / 12) * $currentratio;

                    } elseif (date("Y-m-d", strtotime($datehired)) <= $lastdate) {
                        $strdate = date("Y", strtotime($lastdate)) . "-12-31";
                        $numALLDays = (date("z", strtotime($strdate)) + 1);
                        $numDaysWorked = date("z", strtotime($numALLDays)) + 1;
                        $numLeaveEarned = ($numentitlement / 12) * $currentratio * ($numDaysWorked / $numALLDays);
                    }
                }
                $numLeaveEarned = number_format($numLeaveEarned, 2);
                $currentleave = number_format($LeaveBFWD + $numLeaveEarned, 2);
                //Leave Awarded
                if ($valuetype->isleaveawarded == "Y") {
                    if ($currentperiod == $openningperiod or (date("Y/m", strtotime($datehired))) == $previousperiod) {
                        $LeaveBFWD = 0;
                        $LeaveBFWD = $numentitlement;
                        $currentleave = $numentitlement;

                    } else {
                        $currentleave = $LeaveBFWD;

                    }
                } else {
                    if ($valuetype->reversetallying == "Y") {
                        $currentleave = $currentleave;
                        $leaveCFWD = $leaveCFWD;
                        $LeaveBFWD = $LeaveBFWD;
                    } else {
                        $currentleave = $LeaveBFWD + $numLeaveEarned;
                    }
                }

                $leaveCFWD = $currentleave - $leavetaken;
                //make changes to the database
                $query = $this->db->query("SELECT * FROM leavecontrolfile WHERE StaffIdNo = '{$StaffIDNo}' AND (LeaveType = '{$leavetype}') and currentperiod = '{$currentperiod}'");
                if ($query->num_rows() > 0) {

                    $data = array(

                        'Gender' => $this->getsinglevalueglobe("gendercode", "employee", $StaffIDNo, "employeeno"),
                        'DepartmentCode' => $this->getsinglevalueglobe("departmentcode", "employee", $StaffIDNo, "employeeno"),
                        'LeaveApplied' => $numLeaveDaysApplied,
                        'LeaveCancelled' => $numLeaveCancelled,
                        'Applications' => $numApplications,
                        'approvals' => $numApprovals,
                        'Authorizations' => $numAuthorizations,
                        'Cancellations' => $numCancellations,
                        'Recalls' => $numRecalls,
                        'Rejections' => $numRejections,
                        'DaysRejected' => $numLeaveDaysRejected,
                        'currentyear' => $strCurrentYearUDT,
                        'leaveearned' => $numLeaveEarned,
                        'leaveEntitlement' => $numentitlement,
                        'LastDateModified' => date("Y-m-d"),
                        'CurrentMonth' => $currentmonth,
                        'LeaveType' => $leavetype,
                        'StaffIDNo' => $staffidno,
                        'LeaveRecalled' => 0,
                        'AllowanceDue' => 0,
                        'AllowancePaid' => 0,
                        'AllowanceBalance' => 0,
                        'paidoff' => 'N',
                        'LeaveForfeited' => 0,
                        'DateCreated' => date("Y-m-d"),
                        'leavetaken' => $numLeaveTodate,
                        'LeaveBFWD' => $LeaveBFWD,
                        'leaveCFWD' => $leaveCFWD,
                        //'ReasonLeaveForfeited'=>$ReasonLeaveForfeited,
                        //'DateLeaveForfeited'=>$DateLeaveForfeited,
                        //'DateLeaveForfeited'=>$DateLeaveForfeited,
                        'CurrentLeave' => $currentleave,
                        'currentperiod' => $currentperiod,
                    );

                    $this->db->where('staffidno', $staffidno);
                    $this->db->where('currentperiod', $currentperiod);
                    $this->db->where('LeaveType', $leavetype);
                    $this->db->update('leavecontrolfile', $data);
                } else {

                    $data = array(

                        //'employeeno'=>$this->input->post('employeeno'),
                        'Gender' => $this->getsinglevalueglobe("gendercode", "employee", $StaffIDNo, "employeeno"),
                        'DepartmentCode' => $this->getsinglevalueglobe("departmentcode", "employee", $StaffIDNo, "employeeno"),
                        'LeaveApplied' => $numLeaveDaysApplied,
                        'LeaveCancelled' => $numLeaveCancelled,
                        'Applications' => $numApplications,
                        'approvals' => $numApprovals,
                        'Authorizations' => $numAuthorizations,
                        'Cancellations' => $numCancellations,
                        'Recalls' => $numRecalls,
                        'Rejections' => $numRejections,
                        'DaysRejected' => $numLeaveDaysRejected,
                        'currentyear' => $strCurrentYearUDT,
                        'leaveearned' => $numLeaveEarned,
                        'leaveEntitlement' => $numentitlement,
                        'LastDateModified' => date("Y-m-d"),
                        'currentmonth' => $currentmonth,
                        'LeaveType' => $leavetype,
                        'StaffIDNo' => $staffidno,
                        'LeaveRecalled' => 0,
                        'AllowanceDue' => 0,
                        'AllowancePaid' => 0,
                        'AllowanceBalance' => 0,
                        'paidoff' => 'N',
                        'LeaveForfeited' => 0,
                        'DateCreated' => date("Y-m-d"),
                        'leavetaken' => $numLeaveTodate,
                        'LeaveBFWD' => $LeaveBFWD,
                        'leaveCFWD' => $leaveCFWD,
                        'currentperiod' => $currentperiod,
                        //'ReasonLeaveForfeited'=>$ReasonLeaveForfeited,
                        //'DateLeaveForfeited'=>$DateLeaveForfeited,
                        //'DateLeaveForfeited'=>$DateLeaveForfeited,
                        'CurrentLeave' => $currentleave,
                    );

                    $this->db->insert('leavecontrolfile', $data);
                }
            }
        }

    }

    public function numLeaveEntitlement($leavetype, $strCurrentYearUDT, $emptype)
    {
        $query = $this->db->query("SELECT * FROM leaveconfig where leaveconfig.leavetype = '{$leavetype}' AND leaveconfig.currentyear='{$strCurrentYearUDT}' AND Leaveconfig.emptype='{$emptype}'");
        $empsearch = $query->result();
        $rvalue = 0;
        foreach ($empsearch as $value) {
            $rvalue = $value->entitlement;
        }
        return $rvalue;
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

    public function loademployeeinfo()
    {

        $query = $this->db->query("Select e.employeeno,e.allnames,d.department,t.employeetype,e.datehired,e.gendercode from employee e inner join  department d on e.departmentcode=d.deptcode inner join employeetype t on t.employeetypecode=e.employeetype");
        return $query->result();

    }

    public function loadleavesummery($oppenningperiod, $strstaffidno)
    {
        $strCurrentYear = substr($_SESSION['CurrentPeriod'], 0, 4);
        $strCurrentPeriod = $_SESSION['CurrentPeriod'];
        $strSystemOpeningPeriod = $oppenningperiod;
        $strOpeningPeriod = $strCurrentYear . "/" . date("m", strtotime($_SESSION['openningdate']));
        if ($strOpeningPeriod < $strSystemOpeningPeriod) {
            $query = $this->db->query("
             SELECT  PEM.datehired AS employementdate,
			'{$strCurrentYear}' AS currentyear,
			PLT.descriptions AS leavetype,
			LCF.LeaveType,
			(SELECT   LeaveEntitlement FROM leavecontrolfile  WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) AS LeaveEntitlement,
			(IFNULL((SELECT  ROUND(LeaveBFwd,0) FROM LeaveControlFile AS LCF2 WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0)) AS LeaveBfwd,
			ROUND(SUM(LCF.LeaveEarned),0) AS LeaveEarned,
			SUM(LCF.LeaveTaken) AS LeaveTaken,
			SUM(LCF.LeaveForfeited) AS LeaveForfeited,
			(SELECT LeaveCFwd FROM leavecontrolfile AS LCF1 WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) as Leavebal,
			((SELECT CASE WHEN (max(LeaveEntitlement)=Min(LeaveEntitlement)) THEN max(LeaveEntitlement) ELSE round(avg(LeaveEntitlement),0) END   AS LeaveEntitlement FROM LeaveControlFile WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod <= '{$strCurrentPeriod}' AND CurrentYear='{$strCurrentYear}') AND (StaffIDNO = LCF.StaffIDNO))-SUM(LCF.LeaveTaken)-SUM(LCF.LeaveForfeited)+IFNULL((SELECT ROUND(LeaveBFWD,0) FROM LeaveControlFile AS LCF2 WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strSystemOpeningPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0)) AS endyearbal
            FROM  leavecontrolfile AS LCF INNER JOIN employee AS PEM ON LCF.StaffIDNO = PEM.employeeno INNER JOIN department AS PCD ON LCF.DepartmentCode = PCD.deptcode  INNER JOIN paramleavetypes AS PLT ON LCF.LeaveType = PLT.leavetype WHERE  (LCF.CurrentYear = '{$strCurrentYear}') AND (PEM.employeeno='{$strstaffidno}' ) GROUP BY LCF.StaffIDNO, PEM.AllNames, PCD.department, PCD.DeptCode, PEM.DateHired,PLT.Descriptions,LCF.LeaveType ORDER BY PCD.DeptCode

		      ");
        } else {

            $query = $this->db->query("
             SELECT  PEM.datehired AS employementdate,
			'{$strCurrentYear}' AS currentyear,
			PLT.descriptions AS leavetype,
			LCF.LeaveType,
			(SELECT   LeaveEntitlement FROM leavecontrolfile  WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) AS LeaveEntitlement,
			(IFNULL((SELECT  ROUND(LeaveBFwd,0) FROM LeaveControlFile AS LCF2 WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0)) AS LeaveBfwd,
			ROUND(SUM(LCF.LeaveEarned),0) AS LeaveEarned,
			SUM(LCF.LeaveTaken) AS LeaveTaken,
			SUM(LCF.LeaveForfeited) AS LeaveForfeited,
			(SELECT LeaveCFwd FROM leavecontrolfile AS LCF1 WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) as Leavebal,
			((SELECT CASE WHEN (max(LeaveEntitlement)=Min(LeaveEntitlement)) THEN max(LeaveEntitlement) ELSE round(avg(LeaveEntitlement),0) END   AS LeaveEntitlement FROM LeaveControlFile WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod <= '{$strCurrentPeriod}' AND CurrentYear='{$strCurrentYear}') AND (StaffIDNO = LCF.StaffIDNO))-SUM(LCF.LeaveTaken)-SUM(LCF.LeaveForfeited)+IFNULL((SELECT ROUND(LeaveBFWD,0) FROM LeaveControlFile AS LCF2 WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod = '{$strOpeningPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0)) AS endyearbal
            FROM  leavecontrolfile AS LCF INNER JOIN employee AS PEM ON LCF.StaffIDNO = PEM.employeeno INNER JOIN department AS PCD ON LCF.DepartmentCode = PCD.deptcode  INNER JOIN paramleavetypes AS PLT ON LCF.LeaveType = PLT.leavetype WHERE  (LCF.CurrentYear = '{$strCurrentYear}') AND (PEM.employeeno='{$strstaffidno}' ) GROUP BY LCF.StaffIDNO, PEM.AllNames, PCD.department, PCD.DeptCode, PEM.DateHired,PLT.Descriptions,LCF.LeaveType ORDER BY PCD.DeptCode

		      ");

        }

        // echo $this->db->last_query();
        return $query->result();

    }
    public function dayssummary($oppenningperiod, $strLeaveType)
    {
        $strCurrentYear = substr($_SESSION['CurrentPeriod'], 0, 4);
        $strCurrentPeriod = $_SESSION['CurrentPeriod'];
        $strSystemOpeningPeriod = $oppenningperiod;
        $strOpeningPeriod = $strCurrentYear . "/" . date("m", strtotime($_SESSION['openningdate']));
        //$query=$this->db->query("SELECT  LCF.StaffIDNO AS [Staff No], PEM.allnames AS Name, PCD.department AS Dept,PEM.datehired as EmploymentDate,LeaveType as LeaveType, '{$strCurrentYear}' AS CurrentYear,(SELECT     LeaveEntitlement FROM LeaveControlFile  WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) AS Entitlement, IFNULL((SELECT     ROUND(LeaveBFWD,2) FROM LeaveControlFile AS LCF2 WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strOpeningPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0) AS LeaveBfwd, ROUND(SUM(LCF.LeaveEarned),0) AS LeaveEarned, SUM(LCF.LeaveTaken) AS LeaveTaken,ROUND(SUM(LCF.LeaveForfeited),0) AS LeaveForfeited,CAST((SELECT ROUND(LeaveCFwd,0) FROM LeaveControlFile AS LCF1 WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) ) AS ActualBal,(SELECT CASE WHEN (max(LeaveEntitlement)=Min(LeaveEntitlement)) THEN max(LeaveEntitlement) ELSE round(avg(LeaveEntitlement),0) END as LeaveEntitlement FROM LeaveControlFile WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod <= '{$strCurrentPeriod}' AND CurrentYear='{$strCurrentYear}') AND (StaffIDNO = LCF.StaffIDNO))-SUM(LCF.LeaveTaken)-SUM(LCF.LeaveForfeited)+IFNULL((SELECT ROUND(LeaveBFWD,0) FROM LeaveControlFile AS LCF2 WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strOpeningPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0) AS EndYrBal FROM  LeaveControlFile AS LCF INNER JOIN employee AS PEM ON LCF.StaffIDNO = PEM.employeeno INNER JOIN department AS PCD ON LCF.DepartmentCode = PCD.deptcode  WHERE  (LCF.CurrentYear = '{$strCurrentYear}') AND LCF.LeaveType LIKE '{$strLeaveType}' AND PCD.deptcode='{$strDeptCode}' AND PEM.empstatus='1' GROUP BY LCF.StaffIDNO, PEM.allnames, PCD.department, PCD.deptcode,LCF.LeaveType, PEM.datehired  ORDER BY LCF.LeaveType, PCD.deptcode");
        $query = $this->db->query("
			SELECT  LCF.StaffIDNO AS StaffNo, PEM.allnames AS Name,
			PCD.department AS Dept,
			PEM.datehired as EmploymentDate,
			LeaveType as LeaveType, '{$strCurrentYear}' AS CurrentYear,
			(SELECT     LeaveEntitlement FROM LeaveControlFile  WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO)) AS Entitlement,
			IFNULL((SELECT ROUND(LeaveBFWD,2) FROM LeaveControlFile AS LCF2 WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strOpeningPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0) AS LeaveBfwd,
			ROUND(SUM(LCF.LeaveEarned),0) AS LeaveEarned,
			SUM(LCF.LeaveTaken) AS LeaveTaken,
			ROUND(SUM(LCF.LeaveForfeited),0) AS LeaveForfeited,
			(SELECT ROUND(LeaveCFwd,0) FROM LeaveControlFile AS LCF1 WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strCurrentPeriod}') AND (StaffIDNO = LCF.StaffIDNO))  AS ActualBal,
			(SELECT CASE WHEN (max(LeaveEntitlement)=Min(LeaveEntitlement)) THEN max(LeaveEntitlement) ELSE ROUND(avg(LeaveEntitlement),0) END as LeaveEntitlement FROM LeaveControlFile WHERE (LeaveType = LCF.LeaveType) AND (CurrentPeriod <= '{$strCurrentPeriod}' AND CurrentYear='{$strCurrentYear}') AND (StaffIDNO = LCF.StaffIDNO))-SUM(LCF.LeaveTaken)-SUM(LCF.LeaveForfeited)+IFNULL((SELECT ROUND(LeaveBFWD,0) FROM LeaveControlFile AS LCF2 WHERE (LeaveType =LCF.LeaveType) AND (CurrentPeriod = '{$strOpeningPeriod}') AND (StaffIDNO = LCF.StaffIDNO)),0) AS EndYrBal  FROM  LeaveControlFile AS LCF INNER JOIN employee AS PEM ON LCF.StaffIDNO = PEM.employeeno INNER JOIN department AS PCD ON LCF.DepartmentCode = PCD.deptcode  WHERE  (LCF.CurrentYear = '{$strCurrentYear}') AND LCF.LeaveType LIKE '{$strLeaveType}'  AND PEM.empstatus='1' GROUP BY LCF.StaffIDNO, PEM.allnames, PCD.department, PCD.deptcode,LCF.LeaveType, PEM.datehired  ORDER BY LCF.LeaveType, PCD.deptcode");

        return $query->result();
    }

    public function leaveappssummary($strStaffIDNo)
    {
        $query = $this->db->query("Select leaveapplications.DateApplied,leaveapplications.CurrentLeave,leaveapplications.LeaveCFWD,leaveapprovals.Authorized,leaveapprovals.Approved,leaveapplications.AppNum,paramleavetypes.Descriptions,LeaveApplications.DaysApplied,leaveapprovals.dayscancelled ,leaveapprovals.AuthStartDate, leaveapprovals.AprStartDate, leaveapprovals.AprLastDate, LeaveApprovals.AprDateExpected, leaveapplications.StartDate, leaveapplications.LastDate,leaveapplications.DateExpected, LeaveApprovals.AuthLastDate,LeaveApprovals.reasonCancelled,LeaveApprovals.SignOutDate,LeaveApprovals.Recalled,LeaveApprovals.Recalled, LeaveApprovals.cancelled,LeaveApprovals.ReturnDate,LeaveApprovals.AuthDateExpected, LeaveApprovals.ReturnDelay, LeaveApprovals.ReturnComments,LCF.LeaveEntitlement,ParamLeaveTypes.Dependent, ParamLeaveTypes.ParentLeaveType, LeaveApplications.Currentperiod, LeaveApplications.StaffIDNo,LCF.LeaveType
	FROM leaveapplications LEFT OUTER JOIN leaveapprovals ON leaveapprovals.AppNum=leaveapplications.AppNum INNER JOIN paramleavetypes ON leaveapplications.LeaveType = paramleavetypes.LeaveType LEFT OUTER JOIN leavecontrolfile LCF ON leaveapplications.StaffIDNo=LCF.StaffIDNo AND leaveapplications.CurrentPeriod=LCF.CurrentPeriod AND leaveapplications.LeaveType=LCF.leaveType WHERE  leaveapplications.StaffIDNo='{$strStaffIDNo}' ORDER BY leaveapplications.StartDate DESC,leaveapplications.AppNum Desc");
        return $query->result();
    }

    public function openningperiod()
    {

        $query = $this->db->query("SELECT * FROM company where companycode='{$_SESSION['companycode']}'");
        $holsearch = $query->result();
        $openningperiod = date('Y') . "/" . date('m');
        $openningdate = "";
        foreach ($holsearch as $value) {
            $openningdate = $value->openningdate;
            $openningperiod = (date('Y')) . "/" . (date('m', strtotime($openningdate)));
        }
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

}
