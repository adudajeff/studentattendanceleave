<?php
$this->load->library('session');
?>

<div class="page-content">
					<div class="container">
						<!-- BEGIN PAGE BREADCRUMBS -->
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<a href="<?php echo base_url(); ?>">Home</a>
								<i class="fa fa-circle"></i>
							</li>
							<li>
								<span>New register Screen</span>
							</li>
						</ul>
						<!-- END PAGE BREADCRUMBS -->
						<!-- BEGIN PAGE CONTENT INNER -->
						<div class="page-content-inner">
						   <div class="tab-pane " id="tab_1">
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption bold">
                                                            <i class="fa fa-gift"></i>Student Attendance Screen </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                            <a href="javascript:;" class="reload"> </a>
                                                            <a href="javascript:;" class="remove"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form" id="home">
                                                        <!-- BEGIN FORM-->
                                                       <!--- <form    class="horizontal-form" id="updateregister" >-->

														 <!--links --->
														  <div class="form-actions top"  style="padding:4px;margin:5px;">

														    <div class="btn-set pull-right">
																        <a href="<?php echo base_url(); ?>student" class="btn  blue bold"><i class="fa fa-eye"></i>&nbsp;View Student List</a>
																        <a href="<?php echo base_url(); ?>Attendanceregister" class="btn  blue bold"><i class="fa fa-eye"></i>&nbsp;View Attendance List</a>

															</div>
														 </div>
														  <!-- end of links-->
                                                        <div class="form-body">
													    <div id="err" class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                        <div id="succ" class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                                               		<div class="row">
																		<h5 class="form-section font-blue bold" style="padding:0px;margin:5px">Register Informations</h5>
																		<div class="col-md-12 ">
																				<div class="form-group">
																					<label>Reg No
																					<span class="required"> * </span> <?php echo $_SESSION['regno']; ?>
																					</label>

																					<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control">
																				</div>
																			</div>
																	</div>
																	<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Student Name
																					<span class="required"> * </span></span> <?php echo $_SESSION['name']; ?>
																					</label>

																				</div>
																			</div>
																	</div>
																	<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Course NAME
																					<span class="required"> * </span></span> <?php echo $_SESSION['course']; ?>
																					</label>

																				</div>
																			</div>
																	</div>


																	<div class="row">
																		<div class="col-md-12">

																       <div class="table-container">
																			<table id="table" class="table table-striped table-bordered table-hover table-checkable" cellspacing="0" width="100%">
																				<thead>
																					<tr role="row" class="heading">
																						<th>
																							Unit Code
																						</th>
																						<th>
																							Unit Name
																						</th>
																						<th>
																							Date
																						</th>
																						<th>
																							Time
																						</th>
																						<th>
																							Room Number
																						</th>
																						<th>
																							Present
																						</th>
																						<th>
																							Absent
																						</th>
																						<th>
																							Leave
																						</th>
																						<th>

																						</th>
																					<tr>
																			        <thead>
																					<?php
$query = $this->db->query("Select timetable.*,course.*,unit.* from timetable inner join course on course.course_id=timetable.course_id inner join unit on unit.unitcode=timetable.unit");
$datadesig = $query->result();
$i = 1;
foreach ($datadesig as $value) {
    $unit = $value->unitcode;
    $course_id = $value->course_id;
    $unit = $value->unit;
    $regno = $_SESSION['regno'];
    $query = $this->db->query("Select * from attendancemaster where course_id='{$course_id}' and unit='{$unit}' and regno='{$regno}'");
    $data2 = $query->result();
    $k = 0;
    if ($query->num_rows() > 0) {
        $k = 1;
    }

    ?>
																				    <tr >
																						<td>
																						<?php echo $value->unitcode; ?>
																						</td>
																						<td>
																						<?php echo $value->description; ?>
																						</td>
																						<td>
																							<?php echo $value->lessondate; ?>
																						</td>
																						<td>
																							<?php echo $value->lessontime; ?>
																						</td>
																						<td>
																							<?php echo $value->roomnumber; ?>
																						</td>
																						<td>
																							_
																						</td>
																						<td>
																							_
																						</td>
																						<td>
																						_
																						</td>
																						<td>
																						<?php
if ($k == 1) {
        echo "Signed";
    } else {
        ?>
																							<button  class="btn blue" onclick="register('<?php echo $_SESSION['regno']; ?>','<?php echo $value->course_id; ?>','<?php echo $value->unit; ?>','<?php echo $value->roomnumber; ?>','<?php echo $value->lessontime; ?>','<?php echo $value->lessondate; ?>');" id="<?php echo $i++; ?>"><i class="fa fa-check"></i> sign in</button>
																						<?php
}
    ?>
																						</td>
																					</tr>
																					<?php
}

?>
																			    <tbody>
		                                                                     	</tbody>
																			</table>
																			</div>
																		</div>
																	</div>
														</div>
										   <div class="form-actions right">

										   </div>
				          <!--</form>-->
				<!-- END FORM-->
						</div>
		        </div>
       </div>
	   </div>
		<!-- END PAGE CONTENT INNER -->
	</div>
</div>

