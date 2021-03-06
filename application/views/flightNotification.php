			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Flight Notification</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Flight Notification</strong>
                        </li>
                    </ol>
                </div>
            </div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-tabs" style="background-color:white;">
							<li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Flight Notification List</a></li>
							 <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane active">
								<div class="ibox-title">
									<h5>Flight Notification List</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>Format</th>
													<th>Date & Time</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($notificationList as $value) { ?>
                                                <tr>
													<td><?php echo $value['format']; ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['datetime'])); ?></td>
													<?php if($value['sendStatus'] == 'Y') { ?>
													<td><button type="button" class="btn btn-sm btn-success">Sent</button></td>
													<?php } else { ?>
													<td><button type="button" class="btn btn-sm btn-danger">Not Send</button></td>
													<?php } ?>
													
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane">
								<div class="ibox-title">
									<h5>Please Add Flight Notification Information</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="ibox-content">
									<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addFlightNotification">
										<div class="form-group">
											<label class="col-sm-2 control-label">Date & Time</label>
											<div class="col-sm-5">
												<div class="input-group date">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="text" class="form-control" name="date">
												</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group clockpicker" data-autoclose="true">
													<input type="text" class="form-control" name="time">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
												</div>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Format</label>
											<div class="col-sm-10">
												<textarea type="text" class="form-control" name="format" readonly>Dear #UserName#, Your flight is from #City#. Your Flight details are #Flight Name# #Flight Time# #Flight Address#
												</textarea>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<button class="btn btn-white" type="submit">Cancel</button>
												<button class="btn btn-primary" type="submit">Save changes</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>
		
		
		
