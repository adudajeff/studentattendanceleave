				  <div class="page-content">
					<div class="container">
						<!-- BEGIN PAGE BREADCRUMBS -->
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<a href="<?php echo base_url(); ?>">Home</a>
								<i class="fa fa-circle"></i>
							</li>
							<li>
								<span>New Employee Screen</span>
							</li>
						</ul>
						<!-- END PAGE BREADCRUMBS -->
						<!-- BEGIN PAGE CONTENT INNER -->
						<div class="page-content-inner">						   
						   <div class="tab-pane " id="tab_1">
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption bold">
                                                            <i class="fa fa-gift"></i>New Employee Screen </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                            <a href="javascript:;" class="reload"> </a>
                                                            <a href="javascript:;" class="remove"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form" id="home">
                                                        <!-- BEGIN FORM-->
                                                        <form  enctype="multipart/form-data" class="horizontal-form" id="empform" name="empform" >
														 
														 <!--links --->
														  <div class="form-actions top"  style="padding:4px;margin:5px;">
														 
														     <div class="btn-set pull-left">
															       <div class="btn-group">
                                                                          <a href="<?php echo base_url(); ?>designation/newdesignation" class="btn font-blue btn-default"> <i class="fa fa-plus"></i>&nbsp;Designation</a>
                                                                          <a href="<?php echo base_url(); ?>department/newdepartment" class="btn  font-blue  btn-default"> <i class="fa fa-plus"></i>&nbsp;Department</a>
                                                                   </div>
															 </div>
														    <div class="btn-set pull-right">
																        <a href="<?php echo base_url(); ?>employees" class="btn btn-default font-blue bold"><i class="fa fa-eye"></i>&nbsp;View Employee List</a>
																
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
																				<label>Employee Number
																				<span class="required"> * </span>
																				</label>
																				<input type="text" id="employeeno" name="employeeno" class="form-control border-blue">  
																				<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control">  
																			</div>
																		</div>
																	</div>
																	<div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>First Name
																			<span class="required"> * </span>
																			</label>
                                                                            <input type="text" name="firstname" id="firstname" class="form-control border-blue"> 
																		</div>
                                                                    </div>
																	</div>
                                                                   <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Last Name
																			  <span class="required"> * </span>
																			</label>
                                                                            <input type="text" name="lastname" id="lastname" class="form-control border-blue"> 
                                                                        </div>
                                                                    </div> 
																	</div>
																	<div class="row">
																	<div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Other Names</label>
                                                                            <input type="text" name="othernames" id="othernames" class="form-control border-blue"> 
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                               
																<div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
																			   <label >Date Of Birth
																			          <span class="required"> * </span>
																				</label>																			
																				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-end-date="-18y">
																					<input type="text" class="form-control border-blue" readonly id="dob" name="dob">
																					<span class="input-group-btn">
																						<button class="btn default" type="button">
																							<i class="fa fa-calendar"></i>
																						</button>
																					</span>
																				</div>
																				
																		</div>
                                                                    </div>
																</div>
																<div class="row">                                                                   
                                                                    <div class="col-md-12">
                                                                       <div class="form-group">
																			   <label >Date Hired
																			       <span class="required"> * </span>
																			   </label>																			
																				<div class="input-group  date date-picker" data-date-format="dd-mm-yyyy" data-date-end-date="+0d">
																					<input type="text" class="form-control border-blue" readonly id="datehired" name="datehired">
																					<span class="input-group-btn">
																						<button class="btn default" type="button">
																							<i class="fa fa-calendar"></i>
																						</button>
																					</span>
																				</div>
																				
																		</div>
                                                                    </div> 
																</div>
																<div class="row">
																	<div class="col-md-12">
                                                                        <div class="form-group">
																			<label >Email Address
																				<span class="required"> * </span>
																			</label>																			
																				<div class="input-group">
																					<span class="input-group-addon">
																						<i class="fa fa-envelope"></i>
																					</span>
																			     <input type="email" id="email" name="email" class="form-control border-blue" placeholder="Email Address"> </div>
																			
																		</div>
                                                                    </div>
                                                                    <!--/span-->
                                                                </div>
																
																<div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Designation
																			   <span class="required"> * </span>
																			</label>
                                                                             <select name="designationcode" id="designationcode" class="form-control border-blue" required >
																				  <option value=""></option>
																				  <?php                                        										
																					$query =$this->db->query("Select * from designation");
																					$datadesig=$query->result(); 												
																							
																				   foreach ($datadesig as $value) 
																					{
																						?>
																				  <option value="<?php echo $value->designationcode;  ?>"> <?php echo $value->designation;  ?></option>
																					<?php } ?>
																			  </select>
																		</div>
                                                                    </div>
                                                                   </div>
																   <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Deparment
																			    <span class="required"> * </span>
																			</label>
                                                                             <select name="departmentcode" id="departmentcode" class="form-control border-blue" required >
																				  <option value=""></option>
																				 <?php                                        										
																					$query =$this->db->query("Select * from department");
																					$datadesig=$query->result(); 												
																							
																				   foreach ($datadesig as $value) 
																					{
																						?>
																				  <option value="<?php echo $value->deptcode;  ?>"> <?php echo $value->department;  ?></option>
																					<?php } ?>
																			  </select>
                                                                        </div>
                                                                    </div> 
																	</div>
																	<div class="row">
																	<div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Country
																			     <span class="required"> * </span>
																			</label>
                                                                             <select name="countrycode" id="countrycode" class="form-control border-blue" required >
																				  <option value=""></option>
																				  <?php                                        										
																					$query =$this->db->query("Select * from country");
																					$datadesig=$query->result(); 												
																							
																				   foreach ($datadesig as $value) 
																					{
																						?>
																				  <option value="<?php echo $value->countrycode;  ?>"> <?php echo $value->country;  ?></option>
																					<?php } ?>
																			  </select>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
																<div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Employee Type
																			   <span class="required"> * </span>
																			</label>
                                                                              <select name="employeetype" id="employeetype" class="form-control border-blue" required >
																				  <option value=""></option>
																				  <?php                                        										
																					$query =$this->db->query("Select * from employeetype");
																					$datadesig=$query->result(); 												
																							
																				   foreach ($datadesig as $value) 
																					{
																						?>
																				  <option value="<?php echo $value->employeetypecode;  ?>"> <?php echo $value->employeetype;  ?></option>
																					<?php } ?>
																			  </select>
																		</div>
                                                                    </div>
                                                                   </div>
																   <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Head Of Department/Manager
																			 <span class="required"> * </span>
																			</label>
                                                                             <select name="hod" id="hod" class="form-control border-blue" required >
																				  <option value=""></option>
																				   <?php                                        										
																					$query =$this->db->query("Select * from employee");
																					$datadesig=$query->result(); 												
																							
																				   foreach ($datadesig as $value) 
																					{
																						?>
																				  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																					<?php } ?>
																			  </select>
                                                                        </div>
                                                                    </div> 
																	</div>
																  <div class="row">
																	<div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Gender
																			  <span class="required"> * </span>
																			</label>
                                                                             <select name="gendercode" id="gendercode" class="form-control border-blue" required >
																				  <option value=""></option>
																				  <option value="M">Male</option>
																				  <option value="F">Female</option>
																			  </select>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                </div>
																<div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Physical Address
																			<span class="required"> * </span>
																			</label>
                                                                            <input type="text" id="physicaladdress" name="physicaladdress" class="form-control border-blue" placeholder="Enter your Physical address" required >
																		</div>
                                                                    </div>
                                                                  </div>
																  <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Cell phone
																			   <span class="required"> * </span>
																			</label>
                                                                            <input type="text" id="phone" name="phone" class="form-control border-blue" placeholder="Enter your Cell Phone" required >
                                                                        </div>
                                                                    </div> 
																	</div>
																<div class="row">
																	<div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Office Number</label>
                                                                             <input type="text" id="officeno" name="officeno" class="form-control border-blue" placeholder="Enter your Office Number" required >
                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                </div>	
																<h5 class="form-section font-blue bold">Leave  Information Settings</h5>
																
																<div class="row">
																     <div class="col-md-8">
																	          <div class="row">
																				 <div class="col-md-4">
																					<div class="form-group">
																						<label>Approval level
																							<span class="required"> * </span>
																						</label>
																						 <select name="approvallevel" id="approvallevel" class="form-control border-blue" onchange="setApprovers(this.value)"  >
																							  
																							  <option value="1" selected >1</option>
																							  <option value="2" >2</option>
																							  <option value="3" >3</option>
																							  <option value="4" >4</option>
																						  </select>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group">
																						<label>First Approver
																							<span class="required"> * </span>
																						</label>
																						 <select name="firstapprover" id="firstapprover" class="form-control border-blue"  >
																							  <option value=""></option>
																							   <?php                                        										
																								$query =$this->db->query("Select * from employee");
																								$datadesig=$query->result(); 												
																										
																							   foreach ($datadesig as $value) 
																								{
																									?>
																							  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																								<?php } ?>
																						  </select>
																					</div>
																				</div>
																				<!--/span-->
																				<div class="col-md-4">
																					<div class="form-group">
																						<label>Alternate First Approver</label>
																						 <select name="altfirstapprover" id="altfirstapprover" class="form-control border-blue"  >
																							  <option value=""></option>
																							   <?php                                        										
																								$query =$this->db->query("Select * from employee");
																								$datadesig=$query->result(); 												
																										
																							   foreach ($datadesig as $value) 
																								{
																									?>
																							  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																								<?php } ?>
																						  </select>
																					</div>
																				</div>
																			</div>
																	          <div class="row">
																    
																				<div class="col-md-6">
																					<div class="form-group">
																						<label>Second Approver</label>
																						 <select name="secondapprover" id="secondapprover" class="form-control border-blue"  >
																							  <option value=""></option>
																							   <?php                                        										
																								$query =$this->db->query("Select * from employee");
																								$datadesig=$query->result(); 												
																										
																							   foreach ($datadesig as $value) 
																								{
																									?>
																							  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																								<?php } ?>
																						  </select>
																					</div>
																				</div>
																				<!--/span-->
																				<div class="col-md-6">
																					<div class="form-group">
																						<label>Alternate Second Approver</label>
																						 <select name="altsecondapprover" id="altsecondapprover" class="form-control border-blue"  >
																							  <option value=""></option>
																							   <?php                                        										
																								$query =$this->db->query("Select * from employee");
																								$datadesig=$query->result(); 												
																										
																							   foreach ($datadesig as $value) 
																								{
																									?>
																							  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																								<?php } ?>
																						  </select>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																    
																				<div class="col-md-6">
																					<div class="form-group">
																						<label>Third Approver</label>
																						 <select name="thirdapprover" id="thirdapprover" class="form-control border-blue"  >
																							  <option value=""></option>
																							   <?php                                        										
																								$query =$this->db->query("Select * from employee");
																								$datadesig=$query->result(); 												
																										
																							   foreach ($datadesig as $value) 
																								{
																									?>
																							  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																								<?php } ?>
																						  </select>
																					</div>
																				</div>
																				<!--/span-->
																				<div class="col-md-6">
																					<div class="form-group">
																						<label>Alternate Third Approver</label>
																						 <select name="altthirdapprover" id="altthirdapprover" class="form-control border-blue"  >
																							  <option value=""></option>
																							   <?php                                        										
																								$query =$this->db->query("Select * from employee");
																								$datadesig=$query->result(); 												
																										
																							   foreach ($datadesig as $value) 
																								{
																									?>
																							  <option value="<?php echo $value->employeeno;  ?>"> <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																								<?php } ?>
																						  </select>
																					</div>
																				</div>
																		</div>
																	 </div>
																	  <div class="col-md-4 " >
																	            <div class="row">
																				    <label class="font-blue bold">Avatar/Photo</label>
																				  <div class="form-group">
																				   
																					<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail border-blue" style="width: 200px; height: 150px;">
																							<img src="<?php echo base_url(); ?>uploads/profile.png" alt="" /> </div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																						<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new"> Select image </span>
																								<span class="fileinput-exists"> Change </span>
																								<input type="file" name="photofile" id="photofile" > </span>
																							<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
																						</div>
																					</div>
																					
																				</div>
																			   </div>
																	  </div>
																</div>
																
																
																<h5 class="form-section font-blue bold">Working Days</h5>
																<div class="row">
																	<div class="col-md-8">
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Monday
																					<input value="1" name="monday" id="monday" type="checkbox" checked>
																					<span></span>
																				</label>
																			</div>
																		</div>  
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Tuesday
																					<input value="1" name="tuesday" id="tuesday" type="checkbox" checked>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Wednesday
																					<input value="1" name="wednesday" id="wednesday" type="checkbox" checked>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Thursday
																					<input value="1" id="thursday" name="thursday" type="checkbox" checked>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Friday
																					<input value="1" name="friday" id="friday" type="checkbox" checked>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Saturday
																					<input value="1" id="saturday" name="saturday" type="checkbox">
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<!--/span-->
																	  </div>
																	  <div class="col-md-4">
																	       <div class="col-md-4">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Sunday
																					<input value="1" id="sunday" name="sunday" type="checkbox">
																					<span></span>
																				</label>
																			</div>
																		  </div>
																		  <div class="col-md-8">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Public Holiday
																					<input value="1" id="holiday" name="holiday" type="checkbox">
																					<span></span>
																				</label>
																			</div>
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

	