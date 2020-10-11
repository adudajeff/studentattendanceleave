				  <?php
$this->load->library('session');
if (isset($_SESSION['lastdate'])) {

} else {
    $_SESSION['lastdate'] = date('Y-m-d');
}
if (isset($_SESSION['startdate'])) {

} else {
    $_SESSION['startdate'] = date('Y-m-d');
}

if (isset($_SESSION['dateexpected'])) {

} else {
    $_SESSION['dateexpected'] = date('Y-m-d');
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
								<span>New Leave Application Screen</span>
							</li>
						</ul>
						<!-- END PAGE BREADCRUMBS -->
						<!-- BEGIN PAGE CONTENT INNER -->
						<div class="page-content-inner">
						   <div class="tab-pane " id="tab_1">
                                                <div class="portlet box blue" id="home">
                                                    <div class="portlet-title">
                                                        <div class="caption bold">
                                                            <i class="fa fa-gift "></i>New Leave Application </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                            <a href="javascript:;" class="reload"> </a>
                                                            <a href="javascript:;" class="remove"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form" >
                                                        <!-- BEGIN FORM-->
                                                        <form  class="horizontal-form " id="appleave"  method="POST">
														  <!--links --->
														  <div class="form-actions top"  style="padding:4px">
														    <div class="btn-set pull-left">
															       <div class="btn-group">
                                                                          <a href="<?php echo base_url(); ?>leaveconfig" class="btn btn-default font-blue"> <i class="fa fa-plus"></i>&nbsp;Leave Days Configurations/Entitlement</a>
                                                                          <a  href="<?php echo base_url(); ?>holiday/newholiday" class="btn btn-default font-blue"> <i class="fa fa-plus"></i>&nbsp;Public Holiday</a>
                                                                    </div>
															 </div>
														    <div class="btn-set pull-right">
																<a href="<?php echo base_url(); ?>Leave Summery" class="btn btn-default font-blue bold"><i class="fa fa-eye"></i>View Leave Summary</a>
																<a href="<?php echo base_url(); ?>employees" class="btn btn-default font-blue bold"><i class="fa fa-eye"></i>View  Employee List</a>

															</div>
														 </div>
														  <!-- end of links-->
                                                        <div class="form-body">
													    <div id="err" class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                        <div id="succ" class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button> Your Application is successful!, Wait For Your Approver to Authorize Leave </div>
														        <div class="row">
																   <div class="col-md-8">
																      <div class="row"><!-- Start -->
																				<div class="col-md-6">
																					<div class="form-group">
																						<label>Leave Type
																						   <span class="required"> * </span>
																						</label>
																						 <select name="cboleavetype" id="cboleavetype" class="form-control border-blue" onchange="loadbalances()" required >
																							  <option value=""></option>
																							  <?php
$query = $this->db->query("Select * from paramleavetypes");
$datadesig = $query->result();

foreach ($datadesig as $value) {
    ?>
																							      <option value="<?php echo $value->leavetype; ?>"> <?php echo $value->descriptions; ?></option>
																								<?php }?>
																						  </select>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<div class="form-group">
																							<label>Days Applying For
																							<span class="required"> * </span>
																							</label>
																							<input type="text" id="numberofleave" name="numberofleave" value="<?php echo 0; ?>" class="form-control border-blue" placeholder="Enter Days applying For"  onkeyup="checkduedates()"required >
																							<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control"   >
																					</div>
																				</div>
																		</div>

																		 <div class="row">
																				<!--/span-->
																				<div class="col-md-6">
																				   <div class="form-group">
																						   <label >Select Start Date

																						   </label>
																							<div class="input-group  date date-picker " data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
																								<input type="text" class="form-control border-blue" id="applicationdate" name="applicationdate" value="<?php echo date("Y-m-d") ?>"  onchange="checkduedates()"   >
																								<span class="input-group-btn">
																									<button class="btn default" type="button" " >
																										<i class="fa fa-calendar"></i>
																									</button>
																								</span>
																							</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<div class="form-group">
																						   <label >Leave Start Date
																							</label>
																							<input type="text" disabled id="startdate" name="startdate"  class="form-control border-blue" placeholder="Date Applied" required >

																					</div>
																				</div>
																			</div>

																			<div class="row">
																					<div class="col-md-6">
																					   <div class="form-group">
																							   <label >Leave Last Date
																							   </label>
																								<input type="text"  disabled id="lastdate" name="lastdate" class="form-control border-blue" placeholder="Start Date"  required >

																						</div>
																					</div>
																					<div class="col-md-6">
																					   <div class="form-group">
																							   <label > Leave Date Reporting Back
																							   </label>
																								<input type="text"  disabled id="dateexpected" name="dateexpected" class="form-control border-blue" placeholder="Date expected"  required >

																						</div>
																					</div>
																			</div>

																		   <div class="row"><!-- Start -->
																				<div class="col-md-12">
																					<div class="form-group">
																							<label>Comments
																							<span class="required"> * </span>
																							</label>
																							<textarea  id="comments" name="comments"  class="form-control border-blue" placeholder="Enter some Comments/Narrtions"  ></textarea>
																					</div>
																				</div>
																		     </div>

																		<div class="row">
																			       <div class="form-actions right">
																				<button type="button" class="btn default bold" >Cancel</button>
																				<button type="submit" data-loading-text="Loading..." class="btn blue mt-ladda-btn ladda-button  bold" data-style="slide-right"  id="submit">
																					<i class="fa fa-check"></i>  <span class="ladda-label">Submit Application</span></button>

																				</div>
																		</div>
																		<div class="row">
																		        <div class="note note-warning">
																							<h4 class="profile-desc-title">How To Apply Leave</h4>
																							<span class="font-blue"> To Apply Leave,Select <b>Leave Type First</b>, Your Leave Balances will be displayed on the Right side of the Window,<b>Next</b> Enter the <b>Number of Days </b>You are Applying for, then Select <b>Start Date</b>.Note that the <b>Last Date</b> and the <b>Date expected back</b> are adjusted Automaticaly depending on the weekends and holidays,Then Click on <b>Submit Application Button</b>
																							</span>
																				</div>
																		</div>
																	</div>

                                                                    <div class="col-md-4 ">
																	          <h3 class="form-section bold font-blue">Leave Balances</h3>
																			   <div class="Container-fluid " id="balances">
																					 <div class="row" >
																						<div class="col-md-6">
																									<span class="form-control-static "> Entitlement </span>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  badge badge-info"> 0 </span>
																						</div>

																					</div>
																					<div class="row">
																						<div class="col-md-6">
																									<span class="form-control-static "> BFwd </span>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  badge badge-info"> 0 </span>
																						</div>

																					</div>
																					<div class="row">
																						<div class="col-md-6">
																									<span class="form-control-static ">Earned To Date  </span>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  badge badge-info"> 0 </span>
																						</div>

																					</div>
																					<div class="row">
																						<div class="col-md-6">
																									<span class="form-control-static ">Current </span>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  badge badge-info"> 0 </span>
																						</div>

																					</div>
																					<div class="row">
																						<div class="col-md-6">
																									<span class="form-control-static ">Taken To Date  </span>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  badge badge-info" > 0 </span>
																						</div>

																					</div>
																					<div class="row">
																						<div class="col-md-6">
																									<span class="form-control-static ">Balance  </span>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  badge badge-info" > 0 </span>
																						</div>

																					</div>
																					<h3 class="form-section bold font-blue">Approval Details</h3>
																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">Approval Level  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold " > ********* </span>
																						</div>

																					</div>
																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">First Approver  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold" > ********* </span>
																						</div>

																					</div>
																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">Alt First Approver  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold" > ********* </span>
																						</div>

																					</div>
																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">Second Approver  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  " > ********* </span>
																						</div>

																					</div>

																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">Alt Second Approver  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  " > *********</span>
																						</div>

																					</div>
																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">Third Approver  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  " > ********* </span>
																						</div>

																					</div>

																					<div class="row ">
																						<div class="col-md-6">
																									<p class="form-control-static ">Alt Third Approver  </p>
																						</div>

																						<div class="col-md-6">
																									<span class="bold  " > ********* </span>
																						</div>

																					</div>
																			</div>
																	</div>
                                                                </div>

															</div>

										   </div>
										  <!-- <button type="submit" data-loading-text="Loading..." class="btn blue mt-ladda-btn ladda-button mt-progress-demo" data-style="slide-right">
                                                            <span class="ladda-label">Loading State</span>
                                                        </button>-->

				          </form>
				<!-- END FORM-->
						</div>
		        </div>
       </div>
	   </div>
		<!-- END PAGE CONTENT INNER -->
	</div>
</div>







