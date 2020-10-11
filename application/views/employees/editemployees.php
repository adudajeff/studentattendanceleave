				 <?php
					 $CI =& get_instance();		    			 
				     $employeeno="";
					 $firstname="";
					 $lastname="";
					 $othernames="";
					 $allnames="";
					 $emailaddress="";
					 $gendercode="";
					 $designationcode="";
					 $departmentcode="";
					 $countrycode="";
					 $employeetype="";
					 $hod="";
					 $physicaladdress="";
					 $telephone="";
					 $officeno="";
					 $approvallevel="";
					 $firstapprover="";
					 $altfirstapprover="";
					 $secondapprover="";
					 $altsecondapprover="";
					 $altthirdapprover="";
					 $thirdapprover="";
					 //print_r($empsearch);
				 foreach ($empsearch as $value) 
				  {
					 $employeeno=is_null($value->employeeno) ? "": $value->employeeno;
					 $firstname=is_null($value->firstname) ?  "" : $value->firstname ;
					 $lastname=is_null($value->lastname) ?  "" : $value->lastname ;
					 $photo=is_null($value->photo) ?  "" : $value->photo ;
					 $dob=is_null($value->dob) ?  "" : $value->dob ;
					 $othernames=is_null($value->othernames) ?  "" : $value->othernames ;
					 $allnames=is_null($value->allnames) ?  "" : $value->allnames ;
					 $emailaddress=is_null($value->emailaddress) ?  "" : $value->emailaddress ;
					 $gendercode=is_null($value->gendercode) ?  "" : $value->gendercode ;
					 $designationcode=is_null($value->designationcode) ?  "" : $value->designationcode ;
					 $departmentcode=is_null($value->departmentcode) ?  "" : $value->departmentcode ;
					 $countrycode=is_null($value->countrycode) ?  "" : $value->countrycode ;
					 $employeetype=is_null($value->employeetype) ?  "" : $value->employeetype ;
					 $hod=is_null($value->hod) ?  "" : $value->hod ;
					 $datehired=is_null($value->datehired) ?  "" : $value->datehired ;
					 $physicaladdress=is_null($value->physicaladdress) ?  "" : $value->physicaladdress ;
					 $telephone=is_null($value->telephone) ?  "" : $value->telephone ;$value->telephone;
					 $officeno=is_null($value->officeno) ?  "" : $value->officeno ;$value->officeno;
					 $approvallevel=is_null($value->approvallevel) ?  "" : $value->approvallevel ;
					 $firstapprover=is_null($value->firstapprover) ?  "" : $value->firstapprover ;
					 $altfirstapprover=is_null($value->altfirstapprover) ?  "" : $value->altfirstapprover ;
					 $secondapprover=is_null($value->secondapprover) ?  "" : $value->secondapprover ;
					 $altsecondapprover=is_null($value->altsecondapprover) ?  "" : $value->altsecondapprover ;
					 $altthirdapprover=is_null($value->altthirdapprover) ?  "" : $value->altthirdapprover ;
					 $thirdapprover=is_null($value->thirdapprover) ?  "" : $value->thirdapprover ;
					 $monday=is_null($value->monday) ?  0: $value->monday ;
					 $tuesday=is_null($value->tuesday) ?  0 : $value->tuesday ;
					 $wednesday=is_null($value->wednesday) ?  0 : $value->wednesday ;
					 $thursday=is_null($value->thursday) ?  0 : $value->thursday ;
					 $friday=is_null($value->friday) ?  0 : $value->friday ;
					 $saturday=is_null($value->saturday) ?  0 : $value->saturday ;
					 $sunday=is_null($value->sunday) ?  0 : $value->sunday ;
					 $holiday=is_null($value->holiday) ?  0 : $value->holiday ;
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
                                                        <form  enctype="multipart/form-data" class="horizontal-form" id="empeditform" name="empeditform" >
														 
														 <!--links --->
														  <div class="form-actions top"  style="padding:4px;margin:5px;">
														 
														     <div class="btn-set pull-left">
															       <div class="btn-group">
                                                                           <a href="<?php echo base_url(); ?>designation/newdesignation" class="btn font-blue btn-default"> <i class="fa fa-plus"></i>&nbsp;Designation</a>
                                                                          <a href="<?php echo base_url(); ?>department/newdepartment" class="btn font-blue  btn-default"> <i class="fa fa-plus"></i>&nbsp;Department</a>
                                                                    </div>
															 </div>
														    <div class="btn-set pull-right">
																        <a href="<?php echo base_url(); ?>employees" class="btn btn-default font-blue bold"><i class="fa fa-eye"></i>&nbsp;View s Employee List</a>
																
															</div>
														 </div>
														  <!-- end of links-->
                                                        <div class="form-body">
													    <div id="err" class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                        <div id="succ" class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                                                                                               
                                                              <div class="row">
																 <div class="col-md-12">
															     <div class="row">	
																		<h5 class="form-section font-blue bold" style="padding:0px;margin:5px">Staff  Informations </h5>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>Employee Number
																				<span class="required"> * </span>
																				</label>
																				<input type="text" id="employeeno" name="employeeno" class="form-control border-blue" disabled value="<?php echo $employeeno; ?>">  
																				<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control">  
																			</div>
																		</div>
																	
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>First Name
																			<span class="required"> * </span>
																			</label>
                                                                            <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" class="form-control border-blue"> 
																		</div>
                                                                    </div>
																	
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Last Name
																			  <span class="required"> * </span>
																			</label>
                                                                            <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" class="form-control border-blue"> 
                                                                        </div>
                                                                    </div> 
																	
																	<div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Other Names</label>
                                                                            <input type="text" name="othernames" id="othernames" value="<?php echo $othernames; ?>" class="form-control border-blue"> 
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
																</div>
																
																
																<div class="row">
																 <div class="col-md-12">
															     <div class="row">	
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
																			   <label >Date Of Birth
																			          <span class="required"> * </span>
																				</label>																			
																				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-end-date="-18y" >
																					<input type="text" class="form-control border-blue" readonly id="dob" name="dob" value="<?php echo date("d-m-Y",strtotime($dob)); ?>">
																					<span class="input-group-btn">
																						<button class="btn default" type="button">
																							<i class="fa fa-calendar"></i>
																						</button>
																					</span>
																				</div>
																				
																		</div>
                                                                    </div>
																                                                                 
                                                                    <div class="col-md-3">
                                                                       <div class="form-group">
																			   <label >Date Hired
																			       <span class="required"> * </span>
																			   </label>																			
																				<div class="input-group  date date-picker" data-date-format="dd-mm-yyyy" data-date-end-date="+0d">
																					<input type="text" class="form-control border-blue" readonly id="datehired" name="datehired" value="<?php echo date("d-m-Y",strtotime($datehired)); ?>">
																					<span class="input-group-btn">
																						<button class="btn default" type="button">
																							<i class="fa fa-calendar"></i>
																						</button>
																					</span>
																				</div>
																				
																		</div>
                                                                    </div> 
																
																	<div class="col-md-3">
                                                                        <div class="form-group">
																			<label >Email Address
																				<span class="required"> * </span>
																			</label>																			
																				<div class="input-group">
																					<span class="input-group-addon">
																						<i class="fa fa-envelope"></i>
																					</span>
																			     <input type="email" id="email" name="email" class="form-control border-blue" placeholder="Email Address" value="<?php echo $emailaddress; ?>"> </div>
																			
																		</div>
                                                                    </div>
                                                                    <!--/span-->
                                                               
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Designation
																			   <span class="required"> * </span>
																			</label>
                                                                             <select name="designationcode" id="designationcode" class="form-control border-blue" required >
																				  <option value="<?php echo $CI->getsinglevalueglobe("designationcode","designation",$designationcode,"designationcode"); ?>" > <?php echo $CI->getsinglevalueglobe("designation","designation",$designationcode,"designationcode");?>  </option>
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
																   </div>
																   </div>
																   
																   <div class="row">
																    <div class="col-md-12">
															        <div class="row">
																		<div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Deparment
																			    <span class="required"> * </span>
																			</label>
                                                                             <select name="departmentcode" id="departmentcode" class="form-control border-blue" required >
																				   <option value="<?php echo $CI->getsinglevalueglobe("deptcode","department",$departmentcode,"deptcode");?>" > <?php echo $CI->getsinglevalueglobe("department","department",$departmentcode,"deptcode");?>  </option>
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
																	
																	<div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Country
																			     <span class="required"> * </span>
																			</label>
                                                                             <select name="countrycode" id="countrycode" class="form-control border-blue" required >
																				  <option value="<?php echo $CI->getsinglevalueglobe("countrycode","country",$countrycode,"countrycode");?>" > <?php echo $CI->getsinglevalueglobe("country","country",$countrycode,"countrycode");?>  </option>
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
                                                                    
                                                               
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Employee Type
																			   <span class="required"> * </span>
																			</label>
                                                                              <select name="employeetype" id="employeetype" class="form-control border-blue" required >
																				  <option value="<?php echo $CI->getsinglevalueglobe("employeetypecode","employeetype",$employeetype,"employeetypecode");?>" > <?php echo $CI->getsinglevalueglobe("employeetype","employeetype",$employeetype,"employeetypecode");?>  </option>
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
                                                                   
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Head Of Department/Manager
																			 <span class="required"> * </span>
																			</label>
                                                                             <select name="hod" id="hod" class="form-control border-blue" required >
																				  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$hod,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$hod,"employeeno");?>  </option>
																				   <?php                                        										
																					$query =$this->db->query("Select * from employee");
																					$datadesig=$query->result(); 												
																							
																				   foreach ($datadesig as $value) 
																					{
																						?>
																				  <option value="<?php echo $value->employeeno;  ?>" > <?php echo $value->firstname." ".$value->lastname." ".$value->othernames;  ?></option>
																					<?php } ?>
																			  </select>
                                                                        </div>
                                                                    </div> 
																	</div>
																	</div>
																	</div>
																	
																	
																  <div class="row">
																    <div class="col-md-12">
															        <div class="row">
																	<div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Gender
																			  <span class="required"> * </span>
																			</label>
                                                                             <select name="gendercode" id="gendercode" class="form-control border-blue" required >
																				  <option value="<?php echo $gendercode;  ?>"><?php echo $gendercode;  ?></option>
																				  <option value="M">Male</option>
																				  <option value="F">Female</option>
																			  </select>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Physical Address
																			<span class="required"> * </span>
																			</label>
                                                                            <input type="text" id="physicaladdress" name="physicaladdress" class="form-control border-blue" placeholder="Enter your Physical address" value="<?php echo $physicaladdress;  ?>" required >
																		</div>
                                                                    </div>
                                                                  
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Cell phone
																			   <span class="required"> * </span>
																			</label>
                                                                            <input type="text" id="phone" name="phone" class="form-control border-blue" placeholder="Enter your Cell Phone" value="<?php echo $telephone;  ?>" required >
                                                                        </div>
                                                                    </div> 
																	
																	<div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Office Number</label>
                                                                             <input type="text" id="officeno" name="officeno" class="form-control border-blue" placeholder="Enter your Office Number" value="<?php echo $officeno;  ?>" required >
                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                </div>
																</div>
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
																						 <select name="approvallevel" id="approvallevel" class="form-control border-blue" onchange="setApprovers(this.value)"   >
																							   <option value="<?php echo $approvallevel;  ?>"><?php echo $approvallevel;  ?></option>
																							  <option value="1"  >1</option>
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
																							  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$firstapprover,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$firstapprover,"employeeno");?>  </option>
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
																							  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$altfirstapprover,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$altfirstapprover,"employeeno");?>  </option>
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
																							  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$secondapprover,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$secondapprover,"employeeno");?>  </option>
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
																							  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$altsecondapprover,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$altsecondapprover,"employeeno");?>  </option>
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
																							  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$thirdapprover,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$thirdapprover,"employeeno");?>  </option>
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
																							  <option value="<?php echo $CI->getsinglevalueglobe("employeeno","employee",$altthirdapprover,"employeeno");?>" > <?php echo $CI->getsinglevalueglobe("allnames","employee",$altthirdapprover,"employeeno");?>  </option>
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
																							<?php
																							   if ($photo=="")
																							   {
																								  $photo=base_url()."uploads/profile.png";
																							   }else{
																								  $photo=base_url().$photo;
																							   }
																								
																							?>
																							<img src="<?php  echo $photo; ?>" alt="" /> </div>
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
																					<input value="1" name="monday" id="monday" type="checkbox" <?php if ($monday=="Y") { ?> checked <?php } ?> >
																					<span></span>
																				</label>
																			</div>
																		</div>  
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Tuesday
																					<input value="1" name="tuesday" id="tuesday" type="checkbox" <?php if ($tuesday=="Y") { ?> checked <?php } ?>>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Wednesday
																					<input value="1" name="wednesday" id="wednesday" type="checkbox" <?php if ($wednesday=="Y") { ?> checked <?php } ?>>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Thursday
																					<input value="1" id="thursday" name="thursday" type="checkbox" <?php if ($thursday=="Y") { ?> checked <?php } ?>>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Friday
																					<input value="1" name="friday" id="friday" type="checkbox" <?php if ($friday=="Y") { ?> checked <?php } ?>>
																					<span></span>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Saturday
																					<input value="1" id="saturday" name="saturday" type="checkbox" <?php if ($saturday=="Y") { ?> checked <?php } ?>>
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
																					<input value="1" id="sunday" name="sunday" type="checkbox" <?php if ($sunday=="Y") { ?> checked <?php } ?>>
																					<span></span>
																				</label>
																			</div>
																		  </div>
																		  <div class="col-md-8">
																			<div class="form-group">
																				  <label class="mt-checkbox bold"> Public Holiday
																					<input value="1" id="holiday" name="holiday" type="checkbox" <?php if ($holiday=="Y") { ?> checked <?php } ?>>
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

	