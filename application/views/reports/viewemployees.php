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
				<span>Employee Listings</span>
			
			</li>
		</ul>
		<!-- END PAGE BREADCRUMBS -->
		<!-- BEGIN PAGE CONTENT INNER -->
	<div class="page-content-inner">
		   
		     <!--links --->
			  <div class="row table-toolbar " style="border-bottom:1px solid blue;padding:3px; margin:5px;">
			
			 </div>
			  <!-- end of links-->	
	<div class="portlet-body"  id="home">
	  
	 <div class="table-container">           	  
		   <table id="sample_1" class="table table-striped table-bordered table-hover table-checkable order-column" cellspacing="0" width="100%">
			<thead class="font-blue bold">
				
				   <tr role="row" class="heading">	
					<th>No</th>					
					<th>Staff No</th>
					<th>All Names</th>
					<th>Department</th>
					<th>Contract Type</th>
					<th>Date Hired</th>
					<th>Gender</th>
					<th>Click On View </th>
					
				</tr>
			</thead>
			<tbody>
			   <?php 
			      $no=1;
			      foreach($allstaffs as $value)
				  {
			   ?>
			     <tr>
				       <td><?php echo $no; ?>.</td>
				       <td><?php echo $value->employeeno; ?></td>
				       <td><?php echo $value->allnames; ?></td>
				       <td><?php echo $value->department; ?></td>
				       <td><?php echo $value->employeetype; ?></td>
				       <td><?php echo $value->datehired; ?></td>
				       <td><?php echo $value->gendercode; ?></td>
				       <td><a href="<?php echo base_url(); ?>reports/loadleavehistory/<?php echo $value->employeeno; ?>" class="btn font-blue  btn-default"> <i class="fa fa-share font-red" ></i>&nbsp;View History</a></td>
				 </tr>
				  <?php 
				      $no=$no+1;
				  }
			      ?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>					
					<th>Staff No</th>
					<th>All Names</th>
					<th>Department</th>
					<th>Contract Type</th>
					<th>Date Hired</th>
					<th>Gender</th>
					<th>Click On View </th>
					
				</tr>
			</tfoot>
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
    
  
} );	

</script>   