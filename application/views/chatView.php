<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Jashn Hyderabad Feedback Panel </title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/logo.png">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
		<style>
		.sk-spinner-wave div{
			background-color:red;
		}
		</style>
	</head>

	<body class="gray-bg">
			
		
    <div class="row">
        <div  class="middle-box text-center loginscreen animated fadeInDown" style="margin:0 auto;float:none;width:50%;">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 style=" margin: 0 auto;width: 100%;">JASHN HYDERABAD FEEDBACK PANEL</h5>
                        </div>
                        <div class="ibox-content">
                            <span>
                                ENTER MOBILE NUMBER
                            </span>
                            <h2 class="font-bold">
                                <div class="form-group">
									<input type="hidden" name="messageSend" value="N" id="messageSend">
									<input type="hidden" name="userId" value="" id="userId">
									<input type="hidden" name="fileType" value="" id="fileType">
									<input type="hidden" name="type" value="" id="type">
									<input type="text" class="form-control" name="userName" maxlength ="10" onkeypress="return isNumberKey(event)" style="text-align: center;" id="mobileNumber">				
								</div>
                            </h2>

                            <hr>
							<div id="messageBox" style="display:none;">
							<span>
                                <span class="font-bold" id="userName"></span> ENTER MESSAGE HERE
                            </span>
                            <h2 class="">
                                <div class="form-group">
									<textarea class="form-control message-input" name="message" id="message"></textarea>			
								</div>
								<i class="fa fa-camera" aria-hidden="true" title="Image/Video" onclick="triggerFile();" style="cursor:pointer;" id="uploadButton"></i>
								<img src="" style="width:100px;height:100px;display:none;" id="imageView" onclick="triggerFile();">
								<img src="" id="imageViewPre" style="display:none;">
								<i class="fa fa-times" aria-hidden="true" title="Cancel" style="display:none;cursor:pointer;" id="cancelImage" onclick="cancelImage();"></i>
                            </h2>
							</div>
                            <hr>
                            <span class="text-muted small" style="color:red;display:;" id="errorMessage">
                                
                            </span>
                            <div class="m-t-sm" style="display:;" id="buttonDiv">
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true" style="    font-size: 40px;color: #1ab394;cursor:pointer;" onclick = "mobileValidate()"></i>
								<i class="fa fa-times-circle-o" aria-hidden="true" style="    font-size: 40px;color: red;cursor:pointer;" onclick = "cancelRecord()"></i>
                            </div>
							
							<div class="ibox-content" style="position: absolute;width: 100%;left: 0px; bottom: 0;top:0;background: #0000002e;display:none;" id="responseView">
								<div class="spiner-example" style="padding-top: 10em;">
									<div class="sk-spinner sk-spinner-wave">
										<div class="sk-rect1"></div>
										<div class="sk-rect2"></div>
										<div class="sk-rect3"></div>
										<div class="sk-rect4"></div>
										<div class="sk-rect5"></div>
									</div>
								</div>
							</div>
                        </div>
                    </div>

                 
                </div>

    </div>	
	<!--<video style="width:100px !important;height:100px !important;" controls>
		<source src="" type="video/mp4" id="videoView">
	</video>-->
		<input type="file" name="image" style="display:none;" id="imageInput" onchange="imageChange(this)">	
			
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<script>
			function isNumberKey(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
				return true;
			} 
			function cancelRecord(){
			   //alert('aa');
			   $('#mobileNumber').val('');
			   $('#errorMessage').html('');
			   $('#mobileNumber').prop('readonly',false);
			   $('#messageBox').fadeOut();
			   $('#messageSend').val('');
			   $('#messageSend').val('N');
			   $('#uploadButton').css({'display':'inline'});
			   $('#imageView').css({'display':'none'});
			   $('#imageView').attr('src','');
			   $('#imageViewPre').attr('src','');
			   $('#cancelImage').css({'display':'none'});
			}
			
			function mobileValidate(){
			   //alert('aa');
			   var mobile = $('#mobileNumber').val();
			   var messageSend = $('#messageSend').val();
			   //alert(mobile);
			   if(messageSend == 'N'){
					if(mobile.length == 10){
						$.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>index.php/home/mobileValidate",
							data: {mobile:mobile},
							success: function(data) {
								//alert(data);
									var rslt = $.trim(data);
									result = JSON.parse(rslt);
									var len = result.length;
									//alert(result[0].total);
									//alert("Image Approved");
									if(len == 0){
										$('#errorMessage').html('*Sorry ! You Are Not Exist.');
									}else{
										//alert(data);
										$('#mobileNumber').prop('readonly',true);
										$('#messageSend').val('');
										$('#messageSend').val('Y');
										$('#userId').val('');
										$('#userId').val(result[0].userId);
										$('#errorMessage').html('');
										$('#userName').html('');
										$('#userName').html(result[0].userName);
										$('#messageBox').fadeIn();
									}
							}
						});
					}else{
					   $('#errorMessage').html('Please Enter the Proper Number');
					}
				}else{
					//alert('aaa');
					var message = $('#message').val();
					var userId = $('#userId').val();
					var image = $('#imageViewPre').attr('src');
					var ext = $('#fileType').val();
					var type = $('#type').val();
					//alert(ext);
					//alert(image);
					if(message == '' && image == ''){
						$('#errorMessage').html('Please Enter the Message Or Select Image');
					}else{
						$('#errorMessage').html('');
						$('#responseView').show();
						$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>index.php/home/messageInsert",
						data: {message:message,userId:userId,image:image,ext:ext,type:type},
						success: function(data) {
							//alert(data);
							setInterval(
							function(){
								//window.location = '';
								$('.spiner-example').html('');
								$('#responseView').css({'background':'#ce8a8a'});
								$('.spiner-example').html('<h3 style="color:green;">Thanks For Sharing Your Feedback</h3><i class="fa fa-smile-o" aria-hidden="true" style="   font-size: 40px;color: green;"></i>');
								setInterval(
									function(){
									window.location = '';
								}, 1000);
							}, 2000);
						}
					});
					}
				}
			}
			
			function triggerFile(){
				//alert('aa');
				$('#imageInput').trigger('click');
			}
			
			function imageChange(input){
				//alert(input.files[0].size);
				var file = $(input).val();
				var ext = file.split('.').pop();
				if (input.files && input.files[0] && input.files[0].size <= '5000000') {
					var reader = new FileReader();
					reader.onload = function (e) {
						//alert(e.target.result);
						var aa = e.target.result;
						var cc = aa.split('/');
						//alert(cc[0]);
						var dd = cc[0].split(':');
						//alert(dd[1]);
						if(cc[0] == 'data:image'){
							$('#imageView').attr('src', e.target.result);
						}else{
							$('#imageView').attr('src', '<?php echo base_url(); ?>assets/img/video_default.jpg');
						}
						$('#imageViewPre').attr('src', e.target.result);
						$('#uploadButton').css({'display':'none'});
						$('#imageView').css({'display':'inline'});
						$('#cancelImage').css({'display':'inline'});
						$('#fileType').val(ext);
						$('#type').val(dd[1]);
						
					};
					//alert(input.files[0]);
					reader.readAsDataURL(input.files[0]);
					
				}else{
					$('#errorMessage').html('File size should be minimum 5MB');
				}
				
			}
			
			function cancelImage(){
				//alert('aa');
				$('#uploadButton').css({'display':'inline'});
				$('#imageView').css({'display':'none'});
				$('#cancelImage').css({'display':'none'});
				$('#imageView').attr('src','');
				$('#imageViewPre').attr('src','');
			}
			
		</script>
	</body>
</html>
				
			
