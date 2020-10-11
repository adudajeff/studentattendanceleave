<div class="modal-header " >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title bold font-green-sharp" >Leave Approval Screen <h4>
</div>
<div class="modal-body" id="mainapproval">
        <?php 		
		   foreach ($pendings as $value) 
		   { 		
		?>
		   <div class="row">																				
			<div class="col-md-6">
				<p>Staff Name:</p>
				<p>																			
					Application No: </p>
					<p>
					Days Applied:</p>
				<p>
					Start Date:</p>
					<p> Last Date:</p> 
					<p>Date Expected: </p>
				
				<p>
					Leave Status:</p>
																																										
			</div>
			<div class="col-md-6">
			   <input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control"   >
			   <input type="hidden" id="step" name="step" value="<?php echo $step; ?>" class="form-control"   >
			   <input type="hidden" id="leavetype" name="leavetype" value="<?php echo $value->LeaveType; ?>" class="form-control"   >
			   <input type="hidden" id="appnum" name="appnum" value="<?php echo $value->AppNum; ?>" class="form-control"   >
			   <input type="hidden" id="level" name="level" value="<?php echo $value->approvallevel; ?>" class="form-control"   >
			   <input type="hidden" id="StartDate" name="StartDate" value="<?php echo $value->StartDate; ?>" class="form-control"   >
			   <input type="hidden" id="LastDate" name="LastDate" value="<?php echo $value->LastDate; ?>" class="form-control"   >
			   <input type="hidden" id="DateExpected" name="DateExpected" value="<?php echo $value->DateExpected; ?>" class="form-control"   >
			   <input type="hidden" id="DaysApplied" name="DaysApplied" value="<?php echo $value->DaysApplied; ?>" class="form-control"   >
				<p><b><?php echo strtoupper($value->allnames); ?></b></p>
					<p>																			
					<b><?php echo $value->AppNum ?></b> 
					
					</p>
					<p>
					<b><?php echo number_format($value->DaysApplied,0); ?> Day(s)</b> </p>
				<p>
					<b><?php echo date('d-m-Y',strtotime($value->StartDate)); ?></b></p>
					<p> <b><?php echo date('d-m-Y',strtotime($value->LastDate)); ?> </b></p> 
					<p><b><?php echo date('d-m-Y',strtotime($value->DateExpected)); ?> </b> </p>
				
				<p>
					<b>
					 <?php 
					 if ($value->Approved=="Y" or $value->SecondApproval=='Y')
					 {
						echo "Approved";
					 }else if ($value->Approved==null or $value->SecondApproval==null)
					 {
						echo "Pending Approval"; 
					 }else{
						echo "Pending Authorization"; 
					 }
					 ?>
					</b>
				</p>
			</div>																		
		</div>
		<div class="row">
				<div class="col-md-12">
				<p>
					Write Comments<br><textarea class="form-control" id="comments" name="comments" > </textarea></p>
					
				</div>
		</div>
		<?php 
		   }
		?>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal" onclick="reloadwindow();">Close</button>
    <button type="button" id="sub" class="btn green  ladda-button btmapproveleave" data-loading-text="Loading..." data-style="zoom-out" data-spinner-color="#FFFFFF" onclick="approveleave()">Authorize Leave</button>
	<button type="button" id="subcan" class="btn green  ladda-button btmreject" data-loading-text="Loading..." data-style="zoom-out" data-spinner-color="#FFFFFF"  >Reject Leave</button>
</div>