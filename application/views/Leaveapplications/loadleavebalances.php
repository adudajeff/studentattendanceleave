            <?php
//$curday = date('d',strtotime($strdate));
//$curmonth = date('m',strtotime($strdate));
$leavetype = $leavetype;
$balancebf = $balancebf;
$currentperiod = $currentperiod;
$staffidno = $staffidno;
$query = $this->db->query("SELECT sum(leavetaken) as leavetaken, sum(LeaveEarned) as leaveearned,sum(LeaveForfeited) as leaveforfeited,LeaveEntitlement FROM leavecontrolfile L inner join employee E on L.staffidno=E.employeeno and L.staffidno='{$staffidno}' and L.leavetype='{$leavetype}' and L.currentperiod>='{$currentperiod}'");

$holsearch = $query->result();

$entitlement = 0;
$currentleave = 0;
$leaveearned = 0;
$leaveforfeited = 0;
$leavetaken = 0;
$Leavebalance = 0;
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
$currentleave = $leaveearned + $balancebf;
$Leavebalance = $currentleave - $leavetaken;

?>

			 <div class="row">
				<div class="col-md-6">
							<p class="form-control-static "> Entitlement</p>
				</div>

				<div class="col-md-6">
							<span class="bold  badge badge-info"> <?php echo $entitlement; ?> </span>
				</div>

			</div>
			<div class="row">
				<div class="col-md-6">
							<p class="form-control-static "> Bfwd  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  badge badge-info"> <?php echo number_format($balancebf, 2); ?> </span>
				</div>

			</div>
			<div class="row">
				<div class="col-md-6">
							<p class="form-control-static ">Earned To Date  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  badge badge-info"> <?php echo number_format($leaveearned, 2); ?> </span>
				</div>

			</div>
			<div class="row">
				<div class="col-md-6">
							<p class="form-control-static ">Current </p>
				</div>

				<div class="col-md-6">
							<span class="bold  badge badge-info"> <?php echo number_format($currentleave); ?> </span>
				</div>

			</div>
			<div class="row">
				<div class="col-md-6">
							<p class="form-control-static ">Taken To Date  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  badge badge-info" > <?php echo number_format($leavetaken, 2); ?> </span>
				</div>

			</div>
			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Balance  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  badge badge-info" > <?php echo number_format($Leavebalance, 2); ?> </span>
				</div>

			</div>
			<h3 class="form-section bold font-blue">Approval Details</h3>
			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Approval Level  </p>
				</div>

				<div class="col-md-6">
							<span class="bold " > <?php echo $approvallevel; ?> </span>
				</div>

			</div>
			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">First Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold" > <?php echo $firstapprover; ?> </span>
				</div>

			</div>
			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Alt First Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold" > <?php echo $altfirstapprover; ?> </span>
				</div>

			</div>
			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Second Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  " > <?php echo $secondapprover; ?> </span>
				</div>

			</div>

			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Alt Second Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  " > <?php echo $altsecondapprover; ?> </span>
				</div>

			</div>
			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Third Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  " > <?php echo $thirdapprover; ?> </span>
				</div>

			</div>

			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Alt Third Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  " > <?php echo $altthirdapprover; ?> </span>
				</div>

			</div>
			<!--<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Fourth Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  " > <?php echo $Leavebalance; ?> </span>
				</div>

			</div>

			<div class="row ">
				<div class="col-md-6">
							<p class="form-control-static ">Alt Fourth Approver  </p>
				</div>

				<div class="col-md-6">
							<span class="bold  " > <?php echo $Leavebalance; ?> </span>
				</div>

			</div>-->
			<?php