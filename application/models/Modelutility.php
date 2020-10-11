<?php

class Modelutility extends CI_Controller
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

        $openningperiod = "";
        $openningperiod = $_SESSION['openningperiod'];

        if (trim($currentperiod) == "") {
            $query = $this->db->query("Select * from pcurrentperiod where currentperiod>='{$openningperiod}' order by currentperiod asc");
        } else {
            $query = $this->db->query("Select * from pcurrentperiod where currentperiod='{$currentperiod}' order by currentperiod asc");
        }

        $count = 0;
        if ($query->num_rows() > 0) {

            $leaveperiod = $query->result();

            foreach ($leaveperiod as $value) {
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
                $StaffIDNo = "";
                $numLeaveEarned = 0;
                $numLeaveTodate = 0;
                $leavetaken = 0;

                echo $value->currentperiod . "<br>";

                $currentyear = $value->currentyear;
                $currentmonth = $value->currentmonth;
                $openningperiod = $currentyear . "/01";
                $startdate = date("Y-m-d", strtotime($value->startdate));
                $lastdate = date("Y-m-d", strtotime($value->lastdate));
                $monthname = $value->monthname;
                $currentperiod = $value->currentperiod;
                $previousperiod = date('Y-m-d', strtotime('-1 day', strtotime($startdate)));
                $previousperiod = date("Y/m", strtotime($previousperiod));
                $workingdays = $value->workingdays;
                $currentratio = $value->currentratio;

                //get last month and period
                $dateTime = new DateTime($startdate);
                $lastmonth = $dateTime->modify('-' . $dateTime->format('d') . ' days')->format('Y-m-d');
                $lastperiod = date("Y", strtotime($lastmonth)) . "/" . date("m", strtotime($lastmonth));

                $strPreviousPeriod = $lastperiod;
                $strCurrentYearUDT = $currentyear;
                //echo "START" . $strPreviousPeriod . " AND " . $currentperiod;
                //Select Leave type to create Leave Transactions

                $strLeaveType = "";
                $staffidno = "";
                if ($strLeaveType == "") {
                    $query = $this->db->query("SELECT * FROM paramLeavetypes  WHERE (paramleavetypes.active = 'Y' or paramLeavetypes.Active = '1') And (dependent = 'N' or dependent IS NULL) ORDER BY paramleavetypes.leavetype ASC");
                } else {
                    $query = $this->db->query("SELECT * FROM paramLeavetypes  WHERE (paramleavetypes.active = 'Y' or paramLeavetypes.Active = '1') And (dependent = 'N' or dependent IS NULL) AND paramLeavetypes.leavetype='{$strLeaveType}' ORDER BY paramleavetypes.leavetype ASC");
                }
                $strtype = $query->result();

                //Loop through the leave types calculating

                foreach ($strtype as $valuetype) {
                    $staffidno = "";
                    $strLeaveType = $valuetype->leavetype;
                    $leavetype = $valuetype->leavetype;
                    $isleaveearned = $valuetype->isleaveearned;
                    $childleavetype = $valuetype->childleavetype;
                    $isLeaveAwarded = $valuetype->isleaveawarded;
                    if ($staffidno == "") {
                        $strstaff = $this->db->query("SELECT * FROM employee LEFT OUTER JOIN LeaveConfig ON employee.employeetype = leaveconfig.emptype AND leaveconfig.leavetype = '{$leavetype}' AND leaveconfig.currentyear='{$strCurrentYearUDT}' WHERE employee.empstatus ='1' ");
                        $strallstaffdata = $strstaff->result();

                    } else {
                        $strstaff = $this->db->query("SELECT * FROM employee LEFT OUTER JOIN LeaveConfig ON employee.employeetype = leaveconfig.emptype AND leaveconfig.leavetype = '{$leavetype}' AND leaveconfig.currentyear='{$strCurrentYearUDT}' WHERE employee.empstatus ='1'  AND employee.employeeno='{$StaffIDNo}'");
                        $strallstaffdata = $strstaff->result();
                    }
                    //echo $this->db->last_query()."<br>";
                    foreach ($strallstaffdata as $rsstaff) {
                        //number of Leave applications
                        $staffidno = $rsstaff->employeeno;
                        $StaffIDNo = $rsstaff->employeeno;
                        $emptype = $rsstaff->emptype;

                        $query = $this->db->query("SELECT * FROM leaveapplications WHERE leaveapplications.StaffIdNo = '{$staffidno}' AND (leaveapplications.LeaveType = '{$leavetype}' or leaveapplications.LeaveType = '{$childleavetype}') and (leaveapplications.StartDate >= '{$lastdate}' and leaveapplications.StartDate <= '{$startdate}') ORDER BY LeaveApplications.StaffIDNo");
                        $strleaveapp = $query->result();
                        foreach ($strleaveapp as $valueapp) {
                            $numApplications = $numApplications + 1;
                        }

                        //Compute The Number of Leave Applied
                        $query = $this->db->query("SELECT Sum(daysapplied) as daysapplied FROM leaveapprovals WHERE leaveapprovals.StaffIdNo = '{$StaffIDNo}' AND (leaveapprovals.LeaveType = '{$leavetype}' or leaveapprovals.LeaveType = '{$childleavetype}' ) and ((leaveapprovals.aprStartDate >= '{$startdate}' and leaveapprovals.aprStartDate <= '{$lastdate}') or (leaveapprovals.AuthStartDate >= '{$startdate}' and leaveapprovals.AuthStartDate <= '{$lastdate}')) AND Authorized='Y';");
                        $strleaveapplied = $query->result();
                        //echo $this->db->last_query();
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

                        //counts the number of recalls of a staff
                        $query = $this->db->query("SELECT * FROM LeaveApplications WHERE LeaveApplications.StaffIdNo = '{$StaffIDNo}' AND (LeaveApplications.LeaveType = '{$leavetype}' or LeaveApplications.LeaveType = '{$childleavetype}') and LeaveApplications.Recalled = 'Y' and (LeaveApplications.StartDate >= '{$startdate}' and LeaveApplications.StartDate <= '{$lastdate}') ORDER BY LeaveApplications.StaffIDNo;");
                        $rsnumRecalls = $query->result();
                        foreach ($rsnumRecalls as $strnumRecalls) {
                            $numRecalls = $numRecalls + 1;
                        }

                        //Get Previous Leave Balance
                        $strcontrol = $this->db->query("SELECT * FROM LeaveControlFile WHERE LeaveControlFile.StaffIDNo = '{$StaffIDNo}' and LeaveControlFile.CurrentPeriod = '{$strPreviousPeriod}' and (LeaveControlFile.LeaveType ='{$leavetype}' or LeaveControlFile.LeaveType ='{$childleavetype}');");
                        $strLeaveBFWD = $strcontrol->result();

                        foreach ($strLeaveBFWD as $strvaluebfwd) {
                            $LeaveBFWD = $strvaluebfwd->LeaveCFwd;
                            if ($LeaveBFWD == null or trim($LeaveBFWD) == "") {
                                $LeaveBFWD = 0;
                            }

                        }
                        if ($isLeaveAwarded == "Y" and $LeaveBFWD == 0) {
                            $LeaveBFWD = $rsstaff->entitlement;
                            if ($LeaveBFWD == null or trim($LeaveBFWD) == "") {
                                $LeaveBFWD = 0;
                            }
                        }
                        $emptype = $this->getsinglevalueglobe("employeetype", "employee", $StaffIDNo, "employeeno");

                        $numentitlement = $this->numLeaveEntitlement($leavetype, $currentyear, $emptype);
                        // $numentitlement = $rsstaff->entitlement;

                        $datehired = $this->getsinglevalueglobe("datehired", "employee", $StaffIDNo, "employeeno");
                        if ($numentitlement == null or trim($numentitlement) == "") {
                            $numentitlement = 0;
                        }
                        //echo $datehired;
                        if ($valuetype->isleaveearned == "Y" and date("Y", strtotime($lastdate)) == date("Y", strtotime($datehired)) and $numentitlement > 0) {
                            $strdate = date("Y", strtotime($lastdate)) . "-12-31";
                            $strNoofDaysInYear = (date("z", strtotime($strdate)) + 1);
                            $strDaysElapsed = date("z", strtotime($datehired)) + 1;
                            $strDaysRemaining = $strNoofDaysInYear - $strDaysElapsed;

                            $numentitlement = number_format(($strDaysRemaining / $strNoofDaysInYear) * $numentitlement, 0);

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
                            echo "<br>" . $openningperiod . " " . $LeaveBFWD . " " . $leavetype . "M<BR>";

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

                        if ($valuetype->isleaveawarded == "Y") {
                            if ($currentperiod == $openningperiod or (date("Y/m", strtotime($datehired))) == $previousperiod) {
                                $LeaveBFWD = 0;
                                //$LeaveBFWD = $numentitlement;
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
                        $query = $this->db->query("SELECT * FROM leavecontrolfile WHERE StaffIdNo = '{$StaffIDNo}' AND (LeaveType = '{$leavetype}') and currentperiod = '{$currentperiod}' limit 1");
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
                            if ($staffidno == "EMP-009") {
                                //echo $this->db->last_query()."<br>"; for debugging purposes
                            }

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

        $query = $this->db->query("Select " . $field . " from " . $table . " where " . $returnvalue . "='" . $value . "'");

        $empsearch = $query->result();
        $rvalue = "";

        foreach ($empsearch as $value) {
            $rvalue = $value->$field;
        }
        return $rvalue;

    }

}
