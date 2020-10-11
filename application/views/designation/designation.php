				  <div class="page-content">
					<div class="container">
						<!-- BEGIN PAGE BREADCRUMBS -->
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<a href="<?php echo base_url(); ?>">Home</a>
								<i class="fa fa-circle"></i>
							</li>
							<li>
								<span>New Designation Screen</span>
							</li>
						</ul>
						<!-- END PAGE BREADCRUMBS -->
						<!-- BEGIN PAGE CONTENT INNER -->
						<div class="page-content-inner">						   
						   <div class="tab-pane " id="tab_1">
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption bold">
                                                            <i class="fa fa-gift"></i>New Designation Screen </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                            <a href="javascript:;" class="reload"> </a>
                                                            <a href="javascript:;" class="remove"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form" id="home">
                                                        <!-- BEGIN FORM-->
                                                        <form  enctype="multipart/form-data" class="horizontal-form" id="designationform" name="designationform" >
														 
														 <!--links --->
														  <div class="form-actions top"  style="padding:4px;margin:5px;">
														 
														    <div class="btn-set pull-right">
																        <a href="<?php echo base_url(); ?>designation" class="btn  blue bold"><i class="fa fa-eye"></i>&nbsp;View Designation List</a>
																
															</div>
														 </div>
														  <!-- end of links-->
                                                        <div class="form-body">
													    <div id="err" class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                        <div id="succ" class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                                                                                               
                                                               		<div class="row">
																		<h5 class="form-section font-blue bold" style="padding:0px;margin:5px">Designation  Information Settings</h5>
																		<div class="col-md-12 ">
																			<div class="form-group">
																				<label>Designation Code
																				<span class="required"> * </span>
																				</label>
																				<input type="text" id="designationcode" name="designationcode" class="form-control border-blue">  
																				<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control">  
																			</div>
																		</div>
																	</div>
																	<div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Designation Name
																			<span class="required"> * </span>
																			</label>
                                                                            <input type="text" name="designation" id="designation" class="form-control border-blue"> 
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

	