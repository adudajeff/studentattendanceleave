				  	<?php
$CI = &get_instance();

$name = "";
$regno = "";
foreach ($search as $value) {
    $name = $value->name;
    $regno = $value->regno;
    $admission_date = $value->admission_date;
    $email = $value->email;
    $course_id = $value->course_id;
    $mobile = $value->mobile;

}
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
								<span>New Student Screen</span>
							</li>
						</ul>
						<!-- END PAGE BREADCRUMBS -->
						<!-- BEGIN PAGE CONTENT INNER -->
						<div class="page-content-inner">
						   <div class="tab-pane " id="tab_1">
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption bold">
                                                            <i class="fa fa-gift"></i>Edit Student Screen </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                            <a href="javascript:;" class="reload"> </a>
                                                            <a href="javascript:;" class="remove"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form" id="home">
                                                        <!-- BEGIN FORM-->
                                                        <form  enctype="multipart/form-data" class="horizontal-form" id="editstudentform" name="editstudentform" >

														 <!--links --->
														  <div class="form-actions top"  style="padding:4px;margin:5px;">

														    <div class="btn-set pull-right">
																        <a href="<?php echo base_url(); ?>student" class="btn  blue bold"><i class="fa fa-eye"></i>&nbsp;View Student List</a>

															</div>
														 </div>
														  <!-- end of links-->
                                                        <div class="form-body">
													    <div id="err" class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                        <div id="succ" class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                                               		<div class="row">
																		<h5 class="form-section font-blue bold" style="padding:0px;margin:5px">Leave  Information Settings</h5>
																		<div class="col-md-12 ">
																				<div class="form-group">
																					<label>Reg No
																					<span class="required"> * </span>
																					</label>
																					<input type="text" id="regno" name="regno" value="<?php echo $regno; ?>" class="form-control border-blue">
																					<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control">
																				</div>
																			</div>
																	</div>
																	<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Student Name
																					<span class="required"> * </span>
																					</label>
																					<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control border-blue">
																				</div>
																			</div>
																	</div>
																	<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Admission Date
																					<span class="required"> * </span>
																					</label>
																					<input type="date" name="admission_date" value="<?php echo $admission_date; ?>" id="admission_date" class="form-control border-blue">
																				</div>
																			</div>
																	</div><div class="row">
																	    <div class="col-md-12">
																				     <div class="form-group">
																						<label>Course
																						<span class="required"> * </span>
																						</label>
																						<select name="course_id" id="course_id" class="form-control border-blue" required >
																							 <option value="<?php echo $CI->getsinglevalueglobe("course_id", "course", $course_id, "course_id"); ?>" > <?php echo $CI->getsinglevalueglobe("description", "course", $course_id, "course_id"); ?>  </option>
																							<?php
$query = $this->db->query("Select * from course");
$datadesig = $query->result();

foreach ($datadesig as $value) {
    ?>
																							<option value="<?php echo $value->course_id; ?>"> <?php echo $value->description; ?></option>
																								<?php }?>
																						</select>
																					</div>
																		</div>
																	</div>
																															<div class="row">
																	    <div class="col-md-12">
																				     <div class="form-group">
																						<label>Department
																						<span class="required"> * </span>
																						</label>
																						<select name="deptcode" id="deptcode" class="form-control border-blue" required >
																							<?php
$query = $this->db->query("Select * from department");
$datadesig = $query->result();

foreach ($datadesig as $value) {
    ?>
																							<option value="<?php echo $value->deptcode; ?>"> <?php echo $value->department; ?></option>
																								<?php }?>
																						</select>
																					</div>
																		</div>
																	</div>
																	<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Email
																					<span class="required"> * </span>
																					</label>
																					<input type="text" name="email" value="<?php echo $email; ?>" id="email" class="form-control border-blue">
																				</div>
																			</div>
																	</div>
																	<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Mobile/Telephone
																					<span class="required"> * </span>
																					</label>
																					<input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control border-blue">
																				</div>
																			</div>
																	</div>

															</div>
										   <div class="form-actions right">
											<button type="button" class="btn default">Cancel</button>
											<button type="submit" class="btn blue" id="submit">
												<i class="fa fa-check"></i> Save Record</button>
										   </div>
				          </form>
				<!-- END FORM-->
						</div>
		        </div>
       </div>
	   </div>
		<!-- END PAGE CONTENT INNER -->
	</div>
</div>

