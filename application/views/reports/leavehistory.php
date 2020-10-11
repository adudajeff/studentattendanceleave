       <?php
foreach ($empsearch as $key) {
    $staffidno = $key->employeeno;
    $allnames = $key->allnames;
    $department = $key->department;
}
?>
	<div class="page-content">
    <input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control">
	<div class="container-fluid">
		<!-- BEGIN PAGE BREADCRUMBS -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo base_url(); ?>">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>Leave Sammary</span>

			</li>
		</ul>
		<!-- END PAGE BREADCRUMBS -->
		<!-- BEGIN PAGE CONTENT INNER -->
	<div class="page-content-inner">
	  <div class="portlet box green">
		 <div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs"></i> Leave History
				</div>
			<div class="tools">
			</div>
		</div>
	<div class="portlet-body flip-scroll"  id="home">
	    	 Staff No: <b><?php echo $staffidno; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
			 Name:<b><?php echo $allnames; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
			 Department:<b><?php echo $department; ?></b> <HR>
	 <div class="table-container">
		   <table id="sample_1" class="table table-bordered table-striped table-condensed flip-content" cellspacing="0" width="100%">
			<thead class="font-blue bold">

				   <tr role="row" class="flip-content">
					<th>No</th>
					<th>Date Hired</th>
					<th>Leave Type</th>
					<th>Entitlement</th>
					<th>Leave BFWD</th>
					<th>Leave Eearned</th>
					<th>Leave Taken</th>
					<th>Leave Forfeited</th>
					<th>Available Balance</th>
					<th>End Year Balance</th>


				</tr>
			</thead>
			<tbody>
			   <?php
$no = 1;
foreach ($leavehistory as $value) {
    ?>
			     <tr>
				       <td><?php echo $no; ?>.</td>
				       <td><?php echo $value->employementdate; ?></td>
				       <td><?php echo $value->leavetype; ?></td>
				       <td><?php echo $value->LeaveEntitlement; ?></td>
				       <td><?php echo $value->LeaveBfwd; ?></td>
				       <td><?php echo $value->LeaveEarned; ?></td>
				       <td><?php echo $value->LeaveTaken; ?></td>
				       <td><?php echo $value->LeaveForfeited; ?></td>
				       <td><?php echo number_format($value->Leavebal, 0); ?></td>
				       <td><?php echo $value->endyearbal; ?></td>
				 </tr>
				  <?php
$no = $no + 1;
}
?>
			</tbody>

		</table>
	   </div>
	   </div>
		</div>
		    <!--Second table-->
     <div class="portlet-title">
		<div class="caption">
			<i class="fa fa-cogs"></i> LEAVE  APPLICATIONS
                  SUMMARY
			</div>
		<div class="tools">

		</div>
	</div>
	<div class="portlet-body flip-scroll"  id="home">
	 <div class="table-container">
		   <table id="sample_2" class="table table-bordered table-striped table-condensed flip-content" cellspacing="0" width="100%">
			<thead class="font-blue bold">

				   <tr role="row" class="flip-content">
					<th>No</th>

					<th >App No</th>
					<th >Date Applied</th>
					<th >Leave Type </th>
					<!--<th >Ent'lment</th>-->
					<!--<th >Before Application</th>-->
					<th >Days Applied</th>
					<!--<th >Balance</th>-->
					<th >Status</th>
					<th >Start Date </th>
					<th >End Date </th>

					<th >Return Date</th>
					<th >Comments</th>
					<th >Print</th>


				</tr>
			</thead>
			<tbody>
			   <?php
$no = 1;
//print_r($leavesummary);
foreach ($leavesummary as $value1) {
    if ($value1->Approved == "Y") {
        if ($value1->Authorized == "Y") {
            if ($value1->cancelled == "Y") {
                $strStatus = "Cancelled";
                $class = "label-danger";

            } else {
                $strStatus = "Authorized";
                $class = "label-success";
            }
        } else {
            $strStatus = "Approved";
            $class = "label-info";
        }
    } elseif ($value1->Approved == "N") {
        $strStatus = "Rejected";
        $class = "label-danger";
    } elseif ($value1->Approved == null or $value1->Approved == "") {
        $strStatus = "Pending";
        $class = "label-warning";
    } else {
        $strStatus = "Pending";
        $class = "label-warning";
    }
    ?>
			     <tr>
				       <td><?php echo $no; ?>.</td>
				       <td><?php echo $value1->AppNum; ?></td>
				       <td>
					   <?php

    echo date("D,M d,Y", strtotime($value1->DateApplied));

    ?>
					   </td>
				       <td><?php echo $value1->Descriptions; ?></td>
				      <!-- <td><?php echo $value1->LeaveEntitlement; ?></td>-->
				       <!--<td><?php echo $value1->CurrentLeave; ?></td>-->
				       <td><?php echo $value1->DaysApplied; ?></td>
				      <!-- <td><?php echo $value1->LeaveCFWD; ?></td>-->
				       <td><span class="label label-sm <?php echo $class; ?>"><?php echo $strStatus; ?></span></td>
				       <td>
					       <?php
if ($value1->AuthStartDate != null) {
        echo date("D,M d,Y", strtotime($value1->AuthStartDate));
    } elseif ($value1->AprStartDate != null) {
        echo date("D,M d,Y", strtotime($value1->AprStartDate));

    } elseif ($value1->StartDate != null) {

        echo date("D,M d,Y", strtotime($value1->StartDate));

    }
    ?>
					   </td>
				       <td>
					   <?php
if ($value1->AuthLastDate != null) {
        echo date("D,M d,Y", strtotime($value1->AuthLastDate));
    } elseif ($value1->AprLastDate != null) {
        echo date("D,M d,Y", strtotime($value1->AprLastDate));

    } elseif ($value1->LastDate != null) {

        echo date("D,M d,Y", strtotime($value1->LastDate));

    }

    ?>
					   </td>
				       <td>
					   <?php
if ($value1->AuthDateExpected != null) {
        echo date("D,M d,Y", strtotime($value1->AuthDateExpected));
    } else {
        echo date("D,M d,Y", strtotime($value1->DateExpected));
    }

    ?>
					   </td>
				       <td><?php echo $value1->reasonCancelled; ?></td>
				       <td> <a href="leave_application_form.asp?appNum=<?php echo $value1->AppNum ?>"> Print
                  Preview</a>
				       </td>
				 </tr>
				  <?php
$no = $no + 1;
}
?>
			</tbody>

		</table>
	   </div>
	   </div>



	   </div>
		<!-- END PAGE CONTENT INNER -->
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.js"></script>
  <script type="text/javascript">

	$(document).ready(function() {

    // DataTable
    var table = $('#sample_1').DataTable();
    var table = $('#sample_2').DataTable();


} );

</script>