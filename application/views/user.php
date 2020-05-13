<style>
.aaa{
	display:none !important;
}
</style>
<div <?php if($er){?>style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/user"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php echo $total_error;  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>Region</th>
							<th>Distributor</th>
							<th>City of Residence</th>
							<th>Company Name</th>
							<th>Category</th>
							<th>Salutation</th>
							<th>Name as per ID Card</th>
							<th>Designation</th>
							<th>IL</th>
							<th>Mobile No.</th>
							<th>E-mail ID</th>
							<th>Boarding City (for flights)</th>
							<th>Date of Birth</th>
							<th>Date of Marriage</th>
							<th>Veg / Non-Veg  / Jain</th>
							<th>Non-Smoking / Smoking Room</th>
							<th>ID Card for travelling</th>
							<th>ID Card No.</th>
							<th>ID Card Date of Expiry</th>
							<th>Address as per ID Card</th>
							<th>Blood Group</th>
							<th>T-Shirt (Size)</th>
							<th>Shirt (Size)</th>
							<th>1From</th>
							<th>1Flight Carrier</th>
							<th>1Flight No.</th>
							<th>1Class</th>
							<th>1Date</th>
							<th>1ETD</th>
							<th>1ETA</th>
							<th>2From</th>
							<th>2Flight Carrier</th>
							<th>2Flight No.</th>
							<th>2Class</th>
							<th>2Date</th>
							<th>2ETD</th>
							<th>2ETA</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td><?php echo $value['error']?></td>
							<td><?php echo $value['region']; ?></td>
							<td><?php echo $value['distributor']; ?></td>
							<td><?php echo $value['city']; ?></td>
							<td><?php echo $value['companyName']; ?></td>
							<td><?php echo $value['category']; ?></td>
							<td><?php echo $value['salutation']; ?></td>
							<td><?php echo $value['userName']; ?></td>
							<td><?php echo $value['designation']; ?></td>
							<td><?php echo $value['il']; ?></td>
							<td><?php echo $value['mobile']; ?></td>
							<td><?php echo $value['emailId']; ?></td>
							<td><?php echo $value['boardingCity']; ?></td>
							<td><?php echo $value['dateOfBirth']; ?></td>
							<td><?php echo $value['dateOfMarriage']; ?></td>
							<td><?php echo $value['nonVeg']; ?></td>
							<td><?php echo $value['nonSmokingRoom']; ?></td>
							<td><?php echo $value['idCardTravelling']; ?></td>
							<td><?php echo $value['idCardNo']; ?></td>
							<td><?php echo $value['idCardExpiryDate']; ?></td>
							<td><?php echo $value['address']; ?></td>
							<td><?php echo $value['bloodGroup']; ?></td>
							<td><?php echo $value['TShirtSizeMaleFemale']; ?></td>
							<td><?php echo $value['ShirtSizeMaleFemale']; ?></td>
							<td><?php echo $value['1From']; ?></td>
							<td><?php echo $value['1FlightCarrier']; ?></td>
							<td><?php echo $value['1FlightNo']; ?></td>
							<td><?php echo $value['1Class']; ?></td>
							<td><?php echo $value['1Date']; ?></td>
							<td><?php echo $value['1ETD']; ?></td>
							<td><?php echo $value['1ETA']; ?></td>
							<td><?php echo $value['2From']; ?></td>
							<td><?php echo $value['2FlightCarrier']; ?></td>
							<td><?php echo $value['2FlightNo']; ?></td>
							<td><?php echo $value['2Class']; ?></td>
							<td><?php echo $value['2Date']; ?></td>
							<td><?php echo $value['2ETD']; ?></td>
							<td><?php echo $value['2ETA']; ?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/user"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
			
			
		<?php //print_r($editValue);?><div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>User</strong>
                        </li>
                    </ol>
                </div>
            </div>
			<div class="ibox-title">
			   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelUser" >
				   <div class="form-group" style="margin:0px;">
					   <div class="row">
						   <div class="col-lg-12">
							   <label class="col-sm-4 control-label">Import User Excel</label>
							   <div class="col-sm-8" style="display:flex;">
								   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
								   <input type="file" name="importExcel" required>
								   </label>
								   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
								   <a href="<?php echo base_url(); ?>index.php/home/download" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
								</div>
						   </div>
					   </div>
				   </div>
			   </form>
		   </div>
			
			<div class="wrapper wrapper-content animated fadeInRight">
				<?php if($this->session->flashdata('success_message')){ ?>
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="fa fa-check-circle fa-fw fa-lg"></i>
					<?php echo $this->session->flashdata('success_message'); ?>.
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-tabs" style="background-color:white;">
							<li class="<?php if($editValue){ echo 'aaa'; } else{ echo 'active';}?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>User List</a></li>
							 <li class="<?php if($editValue){ echo 'active'; } else{ echo '';}?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane <?php if($editValue){ echo 'aaa'; } else{ echo 'active';}?>">
								<div class="ibox-title">
									<h5>User List</h5>
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
													<th></th>
													<th>OTP</th>
													<th>Salutation</th>
                                                    <th>Name as per ID Card</th>
                                                    <th>Mobile No.</th>
													<th>Non-Smoking / Smoking Room</th>
													<th>1Flight No.</th>
													<th>1Date</th>
													<th>1ETA</th>
													<th>2Flight No.</th>
													<th>2Date</th>
                                                    <th>2ETD</th>
													<th>Hotel Name</th>
                                                    <th>Hotel Room</th>
                                                    <th>Region</th>
                                                    <th>Distributor</th>
                                                    <th>City of Residence</th>
                                                    <th>Company Name</th>
                                                    <th>Category</th>
                                                    <th>Designation</th>
                                                    <th>IL</th>
                                                    <th>E-mail ID</th>
                                                    <th>Boarding City (for flights)</th>
                                                    <th>Date of Birth</th>
                                                    <th>Date of Marriage</th>
                                                    <th>Veg / Non-Veg  / Jain</th>
                                                    
                                                    <th>ID Card for travelling</th>
                                                    <th>ID Card No.</th>
                                                    <th>ID Card Date of Expiry</th>
                                                    <th>Address as per ID Card</th>
                                                    <th>Blood Group</th>
                                                    <th>T-Shirt (Size)</th>
                                                    <th>Shirt (Size)</th>
                                                    <th>1From</th>
                                                    <th>1Flight Carrier</th>
                                                    
                                                    <th>1Class</th>
                                                    
                                                    <th>1ETD</th>
                                                    
													<th>2From</th>
                                                    <th>2Flight Carrier</th>
                                                    
                                                    <th>2Class</th>
                                                    
                                                    <th>2ETA</th>
                                                    
												</tr>
											</thead>
											<tbody>
												<?php foreach($userList as $value) { ?>
                                                <tr>
													<td>
														<a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>" class="table-link">
															<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
															</span>
														</a>
														<a href="<?php echo base_url(); ?>index.php/home/userDelete/<?php echo $value['userId']; ?>" class="table-link danger">
															<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
															</span>
														</a>
													</td>
													<td><?php echo $value['otp']; ?></td>
													<td><?php echo $value['salutation']; ?></td>
													<td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['mobile']; ?></td>
													<td><?php echo $value['nonSmokingRoom']; ?></td>
													<td><?php echo $value['1FlightNo']; ?></td>
													<td><?php echo $value['1Date']; ?></td>
													<td><?php echo $value['1ETA']; ?></td>
													<td><?php echo $value['2FlightNo']; ?></td>
													<td><?php echo $value['2Date']; ?></td>
													<td><?php echo $value['2ETD']; ?></td>
													<td><?php echo $value['hotelName']; ?></td>
													<td><?php echo $value['hotelRoom']; ?></td>
													<td><?php echo $value['region']; ?></td>
													<td><?php echo $value['distributor']; ?></td>
													<td><?php echo $value['city']; ?></td>
													<td><?php echo $value['companyName']; ?></td>
													<td><?php echo $value['category']; ?></td>
													
													<td><?php echo $value['designation']; ?></td>
													<td><?php echo $value['il']; ?></td>
													<td><?php echo $value['emailId']; ?></td>
													<td><?php echo $value['boardingCity']; ?></td>
													<td><?php echo $value['dateOfBirth']; ?></td>
													<td><?php echo $value['dateOfMarriage']; ?></td>
													<td><?php echo $value['nonVeg']; ?></td>
													
													<td><?php echo $value['idCardTravelling']; ?></td>
													<td><?php echo $value['idCardNo']; ?></td>
													<td><?php echo $value['idCardExpiryDate']; ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['bloodGroup']; ?></td>
													<td><?php echo $value['TShirtSizeMaleFemale']; ?></td>
													<td><?php echo $value['ShirtSizeMaleFemale']; ?></td>
													<td><?php echo $value['1From']; ?></td>
													<td><?php echo $value['1FlightCarrier']; ?></td>
													
													<td><?php echo $value['1Class']; ?></td>
													
													<td><?php echo $value['1ETD']; ?></td>
													
													<td><?php echo $value['2From']; ?></td>
													<td><?php echo $value['2FlightCarrier']; ?></td>
													
													<td><?php echo $value['2Class']; ?></td>
													
													<td><?php echo $value['2ETA']; ?></td>
													
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane <?php if($editValue){ echo 'active'; } else{ echo '';}?>">
								<div class="ibox-title">
									<h5>Please Add User Information</h5>
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
									<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addUser/<?php echo $editValue[0]['userId']; ?>">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Salutation</label>
												<div class="col-sm-10">
													<select class="form-control" name="salutation" required>
														<option value="" readonly>Select Salutation</option>
														<option value="Mr" <?php if($editValue[0]['salutation'] == 'Mr'){echo 'selected';}?>>Mr</option>
														<option value="Mrs" <?php if($editValue[0]['salutation'] == 'Mrs'){echo 'selected';}?>>Mrs</option>
														<option value="Ms" <?php if($editValue[0]['salutation'] == 'Ms'){echo 'selected';}?>>Ms</option>
														<option value="Dr" <?php if($editValue[0]['salutation'] == 'Dr'){echo 'selected';}?>>Dr</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">User Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="userName" value="<?php echo $editValue[0]['userName']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Designation</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="designation" value="<?php echo $editValue[0]['designation']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">IL</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="il" value="<?php echo $editValue[0]['il']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Mobile</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="mobile" value="<?php echo $editValue[0]['mobile']; ?>" maxlength="10" onkeypress="return isNumberKey(event)" required>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
													<input type="email" class="form-control" name="emailId" value="<?php echo $editValue[0]['emailId']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Category</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="category" value="<?php echo $editValue[0]['category']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Company Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="companyName" value="<?php echo $editValue[0]['companyName']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">City of Residence</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="city" value="<?php echo $editValue[0]['city']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Region</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="region" value="<?php echo $editValue[0]['region']; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">From 1</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="1From" value="<?php echo $editValue[0]['1From']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Flight Carrier 1</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="1FlightCarrier" value="<?php echo $editValue[0]['1FlightCarrier']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Flight No 1</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="1FlightNo" value="<?php echo $editValue[0]['1FlightNo']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Class 1</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="1Class" value="<?php echo $editValue[0]['1Class']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Date 1</label>
												<div class="col-sm-10">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="1Date" value="<?php echo date('d-m-Y', strtotime($editValue[0]['1Date'])); ?>">
													</div>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">ETD 1</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="1ETD" value="<?php echo $editValue[0]['1ETD']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">ETA 1</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="1ETA" value="<?php echo $editValue[0]['1ETA']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">From 2</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="2From" value="<?php echo $editValue[0]['2From']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Flight Carrier 2</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="2FlightCarrier" value="<?php echo $editValue[0]['2FlightCarrier']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Flight No 2</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="2FlightNo" value="<?php echo $editValue[0]['2FlightNo']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Class 2</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="2Class" value="<?php echo $editValue[0]['2Class']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Date 2</label>
												<div class="col-sm-10">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="2Date" value="<?php echo date('d-m-Y', strtotime($editValue[0]['2Date'])); ?>">
													</div>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">ETD 2</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="2ETD" value="<?php echo $editValue[0]['2ETD']; ?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">ETA 2</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="2ETA" value="<?php echo $editValue[0]['2ETA']; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Date of Birth</label>
												<div class="col-sm-10">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="dateOfBirth" value="<?php echo date('d-m-Y', strtotime($editValue[0]['dateOfBirth'])); ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Date of Marriage</label>
												<div class="col-sm-10">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="dateOfMarriage" value="<?php echo date('d-m-Y', strtotime($editValue[0]['dateOfMarriage'])); ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Veg/Non-Veg</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="nonVeg" value="<?php echo $editValue[0]['nonVeg']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Non-Smoking/Smoking</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="nonSmokingRoom" value="<?php echo $editValue[0]['nonSmokingRoom']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">ID Card</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="idCardTravelling" value="<?php echo $editValue[0]['idCardTravelling']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">ID Card No</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="idCardNo" value="<?php echo $editValue[0]['idCardNo']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">ID Expiry Date</label>
												<div class="col-sm-10">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="idCardExpiryDate" value="<?php echo date('d-m-Y', strtotime($editValue[0]['idCardExpiryDate'])); ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Blood Group</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="bloodGroup" value="<?php echo $editValue[0]['bloodGroup']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">T-shirt Size</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="TShirtSizeMaleFemale" value="<?php echo $editValue[0]['TShirtSizeMaleFemale']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Shirt Size</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="ShirtSizeMaleFemale" value="<?php echo $editValue[0]['ShirtSizeMaleFemale']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Distributor</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="distributor" value="<?php echo $editValue[0]['distributor']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">Boarding City</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="boardingCity" value="<?php echo $editValue[0]['boardingCity']; ?>">
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-sm-1 control-label">Address</label>
												<div class="col-sm-11">
													<textarea type="text" class="form-control" name="address"><?php echo $editValue[0]['address']; ?></textarea>
												</div>
											</div>
										</div>
										
									</div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<a href="<?php echo base_url(); ?>index.php/home/user" class="btn btn-white" >Cancel</a>
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
<script>
   function isNumberKey(evt){
   //alert(evt);
	   var charCode = (evt.which) ? evt.which : event.keyCode
	   if (charCode > 31 && (charCode < 48 || charCode > 57))
		   return false;
	   return true;
   }	
</script>
		
		
