			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>SMS</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>SMS</strong>
                        </li>
                    </ol>
                </div>
            </div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-tabs" style="background-color:white;">
							<li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>SMS List</a></li>
							 <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane active">
								<div class="ibox-title">
									<h5>SMS List</h5>
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
										<table class="table table-striped table-bordered table-hover dataTables-example">
											<thead>
												<tr>	
													<th>Message</th>
                                                    <th>Date & Time</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($smsList as $value) { ?>
                                                <tr>
													<td><?php echo $value['smsContent']; ?></td>
													<td><?php echo date('Y-m-d H:i:s', strtotime($value['createdDate'])); ?></td>
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane">
								<div class="ibox-title">
									<h5>Please Add SMS Information</h5>
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
									<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addSMS">
										<div class="form-group">
											<label class="col-sm-2 control-label">SMS Content</label>
											<div class="col-sm-10">
												<textarea type="text" class="form-control" name="smsContent"></textarea>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<button class="btn btn-white" type="reset">Cancel</button>
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
		
		
		
