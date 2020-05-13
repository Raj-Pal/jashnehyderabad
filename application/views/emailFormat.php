<!DOCTYPE html>
<html>
	<head>
		<title>GALLERY IMAGES</title>
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	</head>
	<body style="height:auto !important;background:white;">
		<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins" style="text-align:center;">
                        <div class="ibox-title">
                            <h5 style="width: 100%;">GALLERY IMAGES</h5>
                        </div>
                        <div class="ibox-content">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center;">Title</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Description</th>
                                    <th style="text-align: center;">Image</th>
                                    <th style="text-align: center;" class = 'approveClassAll'>
									<?php if($result[0]['approveStatus'] == 'Y') { ?>
									<button type="button" class="btn btn-sm btn-success">ALL APPROVED</button>
									<?php } else { ?>
									<button type="button" class="btn btn-sm btn-primary" onclick="approveFunction(`All`,'<?php echo $result[0]['uniqueId']; ?>');">APPROVE ALL</button>
									<?php } ?>
									
									</th>
                                </tr>
                                </thead>
                                <tbody>
		<?php foreach($result as $val){ ?>
						<tr>
							<td><?php echo $val['title']; ?></td>
							<td><?php echo $val['name']; ?></td>
							<td><?php echo $val['desc']; ?></td>
							<td>
								<img src="data:image/png;base64,<?php echo $val['image']; ?>" style="width:100px;height:100px;">
							</td>
							<td class = 'approveClass' id="approveList<?php echo $val['galleryId']; ?>">
							<?php if($val['status'] == 'Approved'){?>
							<button type="button" class="btn btn-sm btn-success">APPROVED</button>
							<?php }else{?>
							<button type="button" class="btn btn-sm btn-danger" onclick="approveFunction('<?php echo  $val['galleryId']; ?>','<?php echo $val['uniqueId']; ?>');">APPROVE</button>
							<?php }?>
							</td>
							
						</tr>
		<?php } ?>
						
						</tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
			<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
			<script>
			function approveFunction(id,uniqueId){
				//alert(uniqueId);
				//alert(id);
				$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>index.php/home/approve",
						data: {id:id,uniqueId:uniqueId},
						success: function(data) {
							//alert(data);
							//alert("Image Approved");
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;
							//alert(data);
							for(var i = 0; i < len; i++){
								$('#approveList'+result[i].galleryId).html('');
								if(result[i].approveStatus == 'Y'){
									$('.approveClass').html('');
									$('.approveClassAll').html('');
									$('.approveClass').html('<button type="button" class="btn btn-sm btn-success">APPROVED</button>');
									$('.approveClassAll').html('<button type="button" class="btn btn-sm btn-success">ALL APPROVED</button>');
								}else{
									if(result[i].status == 'Approved'){
										$('#approveList'+result[i].galleryId).html('<button type="button" class="btn btn-sm btn-success">APPROVED</button>');
									}else{
										$('#approveList'+result[i].galleryId).html('<button type="button" class="btn btn-sm btn-danger" onclick="approveFunction(`'+result[i].galleryId+'`,`'+result[i].uniqueId+'`);">APPROVE</button>');
									}
								}
								
							}
						}
					});
				
			}
			</script>
			
			
			</body>
			</html>';
				
			
