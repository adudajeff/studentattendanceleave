       <?php 
	       //print_r($staffleavesum);
           foreach($empsearch as $key)
		   {
			   $staffidno=$key->employeeno;
			   $allnames=$key->allnames;
			   $department=$key->department;
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
				<span>Staff Annual Leave Sammary</span>
			
			</li>
		</ul>
		<!-- END PAGE BREADCRUMBS -->
		<!-- BEGIN PAGE CONTENT INNER -->
	<div class="page-content-inner">
	  <div class="portlet box green">	   
		 <div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs"></i> Staff Annual Leave Sammary 
			
				</div> 
			<div class="tools">
			       <div class="btn-group">
				         <?php 
						    foreach($empdept as $value)
				            {
						 ?>
									  <a href="<?php echo base_url(); ?>reports/staffleavesummary" class="btn font-red btn-default"> <i class="fa fa-eye"></i>&nbsp;<?php echo $value->department  ?></a>
					   <?php }  ?>		  
					</div>
			</div>
		</div>
	<div class="portlet-body flip-scroll"  id="home">
	    	  
	 <div class="table-container">           	  
		   <table id="sample_1" class="table table-bordered table-striped table-condensed flip-content" cellspacing="0" width="100%">
			<thead class="font-blue bold">
				
				   <tr role="row" class="flip-content">	
					<th>No</th>					
					<th>StaffNo</th>
					<th>Name</th>
					<th>Department</th>
					<th>DateHired</th>
					<th>LV.Type</th>
					<th>Year</th>					
					<th>Entitlement</th>					
					<th>LeaveBfwd</th>
					<th>LV.Earned</th>
					<th>LV.Taken</th>
					<th>LV.Forfeited</th>
					<th>ActualBal</th>
					<th>EndYrBal</th>
					
					
				</tr>
			</thead>
			<tbody>
			   <?php 
			      $no=1;
			      foreach($staffleavesum as $value)
				  {
			   ?>
			     <tr>
				       <td><?php echo $no; ?>.</td>
				       <td><?php echo $value->StaffNo; ?></td>
				       <td><?php echo $value->Name; ?></td>
				       <td><?php echo $value->Dept; ?></td>
				       <td><?php echo $value->EmploymentDate; ?></td>
				       <td><?php echo $value->LeaveType; ?></td>
				       <td><?php echo $value->CurrentYear; ?></td>
				       <td><?php echo $value->Entitlement; ?></td>
				       <td><?php echo number_format($value->LeaveBfwd,0); ?></td> 
				       <td><?php echo $value->LeaveEarned; ?></td>
				       <td><?php echo $value->LeaveTaken; ?></td>
				       <td><?php echo $value->LeaveForfeited; ?></td>
				       <td><?php echo $value->ActualBal; ?></td>
				       <td><?php echo $value->EndYrBal; ?></td>
				 </tr>
				  <?php 
				      $no=$no+1;
				  }
			      ?>
			</tbody>
			
		</table>
	   </div>
	   </div>
		</div>
		    <!--Second table-->	
	   </div>
		<!-- END PAGE CONTENT INNER -->
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.js"></script>					
  <script type="text/javascript">

	$(document).ready(function() {
  
    // DataTable
    var table = $('#sample_1').DataTable();
   
    
  
} );	

</script> 