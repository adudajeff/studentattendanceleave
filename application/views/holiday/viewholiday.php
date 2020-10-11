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
				<span>Holiday Listings</span>
			
			</li>
		</ul>
		<!-- END PAGE BREADCRUMBS -->
		<!-- BEGIN PAGE CONTENT INNER -->
		<div class="page-content-inner">
		   
		     <!--links --->
			  <div class="row " style="border-bottom:1px solid blue;padding:3px; margin:5px;">
				<div class="btn-set pull-right">
					<a href="<?php echo base_url(); ?>holiday/newholiday" class="btn  blue bold"><i class="fa fa-plus"></i>Add New Holiday</a>
					
				</div>
			 </div>
			  <!-- end of links-->	
	<div class="portlet-body"  id="home">
	   <div id="err" class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
		<div id="succ" class="alert alert-success display-hide">
		<button class="close" data-close="alert"></button> Your form validation is successful! </div>
	 <div class="table-container">           	  
		   <table id="table" class="table table-striped table-bordered table-hover table-checkable" cellspacing="0" width="100%">
			<thead>
				
				   <tr role="row" class="heading">
				
					<th><input type="checkbox" id="example-select-all"></th>
					<th>No</th>
					<th>Holiday Month </th>
					<th>Holiday </th>
					<th>Holiday Date</th>					
					<th>Year</th>					
					<th>Same Each Year</th>					
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			</tbody>

			<tfoot>
				<tr>
					<!--<th></th>-->
					<th><input type="checkbox" id="example-select-all2"></th>
					<th>No</th>
					<th>Holiday Month</th>
					<th>Holiday</th>
					<th>Holiday Date</th>					
					<th>Year</th>	
					<th>Same Each Year</th>	
					<th>Edit</th>
					<th>Delete</th>
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

		var table;

		$(document).ready(function() {
            
			App.blockUI({target:"#home",boxed:!0});
			//datatables
			table = $('#table').DataTable({ 
                
				//"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				 
				
				
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('holiday/ajax_holidaylist')?>",
					"type": "POST",
					 
						},

				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ 0 ], //first column / numbering column
					"orderable": false, //set not orderable
					 'className': 'dt-body-center',
					 'render': function (data, type, full, meta){
						 return '<input type="checkbox" name="id[]" value="' 
							+ $('<div/>').text(data).html() + '">';
							
					 }
				},
				],

			})
			
			App.unblockUI("#home");
			
			  // Handle click on "Select all" control
			   $('#example-select-all').on('click', function(){
				  // Check/uncheck all checkboxes in the table
				  var rows = table.rows({ 'search': 'applied' }).nodes();
				  $('input[type="checkbox"]', rows).prop('checked', this.checked);
			   });

			
		});

</script>
