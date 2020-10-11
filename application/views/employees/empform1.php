    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Adding Employee </h2>
            </div>
			
			<!----- Start main employees for form -->
			   <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EMPLOYEE CUPTURE SCREEN
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo base_url(); ?>employees">View Existing Employees</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form class="empform" id="empform" action="" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Firstname" class="col-pink">First Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="firstname" class="form-control" placeholder="Enter your First Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="lastname" class="col-pink">Last Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="lastname" class="form-control" placeholder="Enter your Last Name">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="othername" class="col-pink">Othernames</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="othernames" class="form-control" placeholder="Enter your other Names">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Firstname" class="col-pink">Email Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="firstname" class="form-control" placeholder="Enter your email address">
                                            </div>
                                        </div>
                                    </div>
                                </div>                         
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="designation" class="col-pink">Designation</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                  <select name="designationcode" id="designationcode" class="form-control" >
												      <option></option>
												      <option>xxx</option>
												      <option>xxx</option>
												  </select>
											</div>
                                        </div>
                                    </div>
                                    </div> 
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Department" class="col-pink">Department</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                  <select name="departmentcode" id="departmentcode" class="form-control">
												      <option></option>
												      <option>xxx</option>
												      <option>xxx</option>
												  </select>
											</div>
                                        </div>
                                    </div>
                                    </div> 
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="countrycode" class="col-pink">Country</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                  <select name="countrycode" id="countrycode" class="form-control" >
												      <option></option>
												      <option>xxx</option>
												      <option>xxx</option>
												  </select>
											</div>
                                        </div>
                                    </div>
                                    </div> 
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="employeetype" class="col-pink">Employee Type</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                  <select name="countrycode" id="countrycode" class="form-control" >
												      <option></option>
												      <option>xxx</option>
												      <option>xxx</option>
												  </select>
											</div>
                                        </div>
                                    </div>
                                    </div>
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="hod" class="col-pink">Head Of Department/Manager</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                  <select name="hod" id="hod" class="form-control" >
												      <option></option>
												      <option>xxx</option>
												      <option>xxx</option>
												  </select>
											</div>
                                        </div>
                                    </div>
                                    </div> 
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="employeetype" class="col-pink">Gender</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                  <select name="gendercode" id="gendercode" class="form-control" >
												      <option value=""></option>
												      <option value="M">Male</option>
												      <option value="F">Female</option>
												  </select>
											</div>
                                        </div>
                                    </div>
                                    </div>                           
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="physicaladdress" class="col-pink">Physical Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="physicaladdress" class="form-control" placeholder="Enter your Physical address">
                                            </div>
                                        </div>
                                    </div>
                                    </div>   
									
									<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="phone">Cell Phone</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="phone" class="form-control" placeholder="Enter your Cell Phone">
                                            </div>
                                        </div>
                                    </div>
                                   </div>                                
								   
								   <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="officeno">Office Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="officeno" class="form-control" placeholder="Enter your Office Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
								
								
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<!----- end main for form -->
		</div>
    </section>	