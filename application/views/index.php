
            <!-- BEGIN CONTENT -->
            <!--<div class="page-content-wrapper">-->
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
               <!--page head here-->
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="row widget-row">
                            <!--- bar here --->
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="portlet light ">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-bubbles font-dark hide"></i>
                                                <span class="caption-subject font-dark bold uppercase">Recent Notifications</span>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#portlet_comments_1" data-toggle="tab"> All Notifications </a>
                                                </li>
                                                <li>
                                                    <a href="#portlet_comments_2" data-toggle="tab"> Personal Notifications </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="portlet_comments_1">
                                                    <!-- BEGIN: Notifications -->
													<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control"   >
                                                    <div class="mt-comments">
													    <?php
if (count($loadnotifications) > 0) {
    foreach ($loadnotifications as $valuenote) {
        ?>
                                                        <div class="mt-comment">
                                                            <div class="mt-comment-img">
                                                                <img src="<?php echo base_url(); ?><?php echo $valuenote->photo; ?>" height="41" width="41" />  </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author"><?php echo ucwords($valuenote->allnames); ?></span></span>
                                                                    <span class="mt-comment-date"><?php echo $valuenote->notificationdate; ?></span>
                                                                </div>
                                                                <div class="mt-comment-text font-green bold"> <?php echo $valuenote->notification; ?></div>
                                                                <div class="mt-comment-details">
                                                                    <span class="mt-comment-status mt-comment-status-approved "><?php echo $valuenote->type; ?></span>
                                                                    <ul class="mt-comment-actions">
                                                                        <!--<li>
                                                                            <a href="#">Quick Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">View</a>
                                                                        </li>-->
                                                                        <li>
                                                                            <button  class="font-red" onclick="deleterecordnote('transactionno','notifications','<?php echo $valuenote->transactionno; ?>')" >Delete This Notification</button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
<?php
}
} else {
    ?>
                                                            <div class="mt-comment">
                                                            <div class="mt-comment-img">
                                                                  </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">
                                                                </div>
                                                                <div class="mt-comment-text font-green bold"> No nofication yet</div>
                                                                <div class="mt-comment-details">
                                                                    <ul class="mt-comment-actions">
                                                                        <li>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
<?php
}
?>
                                                    </div>
                                                    <!-- END: Notifications -->
                                                </div>
                                                <div class="tab-pane" id="portlet_comments_2">
                                                    <!-- BEGIN: Notifications -->
                                                    <div class="mt-comments">
															 <?php
if (count($loadnotifications) > 0) {
    foreach ($loadnotifications as $valuenote) {
        if ($_SESSION['staffidno'] == $valuenote->staffidno) {
            ?>
                                                        <div class="mt-comment" id="commentpanel">
                                                            <div class="mt-comment-img">
                                                                <img src="<?php echo base_url(); ?><?php echo $valuenote->photo; ?>" height="41" width="41" />  </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author"><?php echo ucwords($valuenote->allnames); ?></span></span>
                                                                    <span class="mt-comment-date"><?php echo $valuenote->notificationdate; ?></span>
                                                                </div>
                                                                <div class="mt-comment-text font-green bold"> <?php echo $valuenote->notification; ?></div>
                                                                <div class="mt-comment-details">
                                                                    <span class="mt-comment-status mt-comment-status-approved "><?php echo $valuenote->type; ?></span>
                                                                    <ul class="mt-comment-actions">
                                                                        <!--<li>
                                                                            <a href="#">Quick Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">View</a>
                                                                        </li>-->
                                                                        <li>
                                                                            <button  class="font-red" onclick="deleterecordnote('transactionno','notifications','<?php echo $valuenote->transactionno; ?>')" >Delete This Notification</button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
<?php
}
    }
} else {
    ?>
                                                        <div class="mt-comment" id="commentpanel">
                                                            <div class="mt-comment-img">
                                                                  </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">

                                                                </div>
                                                                <div class="mt-comment-text font-green bold"> No notifications yet</div>
                                                                <div class="mt-comment-details">

                                                                    <ul class="mt-comment-actions">
                                                                        <!--<li>
                                                                            <a href="#">Quick Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">View</a>
                                                                        </li>-->
                                                                        <li>

                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
 <?php
}
?>
                                                    </div>
                                                    <!-- END: Notifications -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="portlet light ">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class=" icon-social-twitter font-dark hide"></i>
                                                <span class="caption-subject font-dark bold uppercase">Quick Actions</span>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_actions_pending" data-toggle="tab"> Pending Approvals </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_actions_completed" data-toggle="tab"> Authorized </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_actions_pending">
                                                    <!-- BEGIN: Actions -->
                                                    <div class="mt-actions">
														<i class="fa fa-clock-o"></i> <span class="font-dark bold uppercase">Leave Pending First Approval</span><hr>
													  <?php
//Set and get echo the approval data
$no = 0;
foreach ($pendings as $value) {

    if ($value->Approved == null and $value->Cancelled == null and $value->Authorized == null) {

        ?>

                                                        <div class="mt-action">
                                                            <div class="mt-action-img">
                                                                <img src="<?php echo base_url(); ?><?php echo $value->photo; ?>" height="41" width="41" /> </div>
                                                            <div class="mt-action-body">
                                                                <div class="mt-action-row">
                                                                    <div class="mt-action-info ">
                                                                        <div class="mt-action-icon ">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                        <div class="mt-action-details ">
                                                                            <span class="mt-action-author"><?php echo ucwords($value->allnames); ?></span>
                                                                            <p class="mt-action-desc"><?php echo number_format($value->DaysApplied, 0); ?> Day(s)</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-action-datetime ">
                                                                        <span class="mt-action-date"><?php echo date('d-m-Y', strtotime($value->StartDate)); ?></span>
                                                                        <span class="mt-action-dot bg-green"></span>
                                                                        <span class="mt=action-time"><?php echo date('d-m-Y', strtotime($value->LastDate)); ?></span>
                                                                    </div>
                                                                    <div class="mt-action-buttons ">
                                                                        <div class="btn-group ">
                                                                            <a class="btn  green btn-sm" href="<?php echo base_url(); ?>Approveleave?appnum=<?php echo $value->AppNum; ?>&step=1" data-target="#ajax" data-toggle="modal"> Authorize Leave </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<?php
$no = $no + 1;
    }
}
?>

													   <i class="fa fa-clock-o"></i> <span class="font-dark bold uppercase">Leave Pending Second Approval</span><hr>
													  <?php
//Set and get echo the approval data
$no = 0;
foreach ($pendings as $value) {

    if ($value->Approved == "Y" and $value->SecondApproval == null and $value->Authorized == null and $value->Cancelled == null) {
        ?>

                                                        <div class="mt-action">
                                                            <div class="mt-action-img">
                                                                <img src="<?php echo base_url(); ?><?php echo $value->photo; ?>" height="41" width="41" /> </div>
                                                            <div class="mt-action-body">
                                                                <div class="mt-action-row">
                                                                    <div class="mt-action-info ">
                                                                        <div class="mt-action-icon ">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                        <div class="mt-action-details ">
                                                                            <span class="mt-action-author"><?php echo ucwords($value->allnames); ?></span>
                                                                            <p class="mt-action-desc"><?php echo number_format($value->DaysApplied, 0); ?> Day(s)</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-action-datetime ">
                                                                        <span class="mt-action-date"><?php echo date('d-m-Y', strtotime($value->StartDate)); ?></span>
                                                                        <span class="mt-action-dot bg-green"></span>
                                                                        <span class="mt=action-time"><?php echo date('d-m-Y', strtotime($value->LastDate)); ?></span>
                                                                    </div>
                                                                    <div class="mt-action-buttons ">
                                                                        <div class="btn-group btn-group-circle">
                                                                           <a class="btn  green btn-sm" href="<?php echo base_url(); ?>Approveleave?appnum=<?php echo $value->AppNum; ?>&step=2" data-target="#ajax" data-toggle="modal"> Authorize Leave </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<?php
$no = $no + 1;
    }
}
?>
														    <i class="fa fa-clock-o"></i> <span class="font-dark bold uppercase">Leave Pending Final Approval</span><hr>
													  <?php
//Set and get echo the approval data
$no = 0;
foreach ($pendings as $value) {

    if ($value->Approved == "Y" and $value->SecondApproval == "Y" and $value->Authorized == null and $value->Cancelled == null) {
        ?>

                                                        <div class="mt-action">
                                                            <div class="mt-action-img">
                                                                <img src="<?php echo base_url(); ?><?php echo $value->photo; ?>" height="41" width="41" /> </div>
                                                            <div class="mt-action-body">
                                                                <div class="mt-action-row">
                                                                    <div class="mt-action-info ">
                                                                        <div class="mt-action-icon ">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                        <div class="mt-action-details ">
                                                                            <span class="mt-action-author"><?php echo ucwords($value->allnames); ?></span>
                                                                            <p class="mt-action-desc"><?php echo number_format($value->DaysApplied, 0); ?> Day(s)</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-action-datetime ">
                                                                        <span class="mt-action-date"><?php echo date('d-m-Y', strtotime($value->StartDate)); ?></span>
                                                                        <span class="mt-action-dot bg-green"></span>
                                                                        <span class="mt=action-time"><?php echo date('d-m-Y', strtotime($value->LastDate)); ?></span>
                                                                    </div>
                                                                    <div class="mt-action-buttons ">
                                                                        <div class="btn-group-circle">
																		   <a class="btn  green btn-sm" href="<?php echo base_url(); ?>Approveleave?appnum=<?php echo $value->AppNum; ?>&step=3" data-target="#ajax" data-toggle="modal"> Authorize Leave </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

															<!---- End Modal Action---->
														<?php
$no = $no + 1;
    }
}
?>
                                                    </div>
													<input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>" class="form-control"   >
                                                    <!-- END: Actions -->
													<!--Modal 2 testings -->
														<div class="modal fade " id="ajax" role="basic" aria-hidden="true" >

																<div class="modal-content ">
																	<div class="modal-body">
																		<img src="<?php echo base_url(); ?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
																		<span> &nbsp;&nbsp;Loading... </span>
																	</div>
																</div>

														</div>
													<!--end modal 2  to complet-->
                                                </div>
                                                <div class="tab-pane" id="tab_actions_completed">
                                                    <!-- BEGIN:Completed-->
													  <?php
//Set and get echo the approval data
$no = 0;
foreach ($leaveauthorized as $value) {

    ?>
                                                    <div class="mt-actions">
                                                        <div class="mt-action">
                                                            <div class="mt-action-img">
                                                                <img src="<?php echo base_url(); ?><?php echo $value->photo; ?>" height="41" width="41" /> </div>
                                                            <div class="mt-action-body">
                                                                <div class="mt-action-row">
                                                                    <div class="mt-action-info ">
                                                                        <div class="mt-action-icon ">
                                                                            <i class="icon-action-redo"></i>
                                                                        </div>
                                                                        <div class="mt-action-details ">
                                                                            <span class="mt-action-author"><?php echo ucwords($value->allnames); ?></span>
                                                                            <p class="mt-action-desc"><?php echo number_format($value->DaysApplied, 0); ?> Day(s)</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-action-datetime ">
                                                                        <span class="mt-action-date"><?php echo date('d-m-Y', strtotime($value->StartDate)); ?></span>
                                                                        <span class="mt-action-dot bg-green"></span>
                                                                        <span class="mt=action-time"><?php echo date('d-m-Y', strtotime($value->LastDate)); ?></span>
                                                                    </div>
                                                                   <!-- <div class="mt-action-buttons ">
                                                                        <div class="btn-group ">
                                                                            <button type="button" class="btn  green btn-sm bold">Cancel</button>
                                                                            <button type="button" class="btn  green btn-sm bold">Sign In</button>
                                                                        </div>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </div>

														<?php
}
?>
                                                        <!-- END: Completed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            <!--</div>-->
            <!-- END CONTENT -->
            </div>
            </div>
            </div>
            </div>
            </div>


