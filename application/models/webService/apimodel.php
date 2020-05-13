<?php

class ApiModel extends CI_Model {

    public function login($data) {
		$post['p_mobile']	 = $data['mobile'];
		$post['p_gcmId']	 = $data['gcmId'];
		$post['p_app']	 = $data['app'];
		$stored = "Call proc_login_validation(?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->next_result();
        return $result;
    }
	
	public function verifyOtp($data) {
		$post['p_mobile']	 = $data['mobile'];
		$post['p_otp']	 	 = $data['otp'];
		$post['p_gcmId']	 = $data['gcmId'];
		$post['p_app']	 	 = $data['app'];
		$stored = "Call proc_otp_verify(?,?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();	
		return $result;
    }
	
	public function profile($data) {
		$sql = "SELECT 'User Profile' AS responseMessage,'200' AS responseCode,
				`userId`,`city`,`companyName`,`userName`,`mobile`,`emailId`,
				`designation`,`boardingCity`,`dateOfBirth`,`nonVeg`,
				`nonSmokingRoom`,`address`,NULLIF(`bloodGroup`,'') AS bloodGroup,NULLIF(`TShirtSizeMaleFemale`,'') AS TShirtSizeMaleFemale,
				NULLIF(`ShirtSizeMaleFemale`,'')  AS ShirtSizeMaleFemale,`1From` AS from1,`1FlightCarrier` AS flightCarrier1,
				`1FlightNo` AS flightNo1,
				`1Date` AS date1,`1ETD` AS etd1,`1ETA` AS eta1,`2From` AS from2,`2FlightCarrier` AS flightCarrier2,
				`2FlightNo` AS flightNo2,
				`2Date` AS date2,`2ETD` AS etd2,`2ETA` AS eta2,
				NULLIF(CONCAT(IFNULL(hotelName,''),' ',IFNULL(hotelRoom,'')),'') AS hotelDetail FROM tbl_users   where userId = '".$data['userId']."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
    }
	
	public function uploadImage($data) {
		//print_r($data);exit;
		$post['p_userId']	 = $data['userId'];
		$post['p_title']	 = $data['title'];
		$post['p_name']	 = $data['name'];
		$post['p_desc']	 = $data['desc'];
		$post['p_image']	 = $data['image'];
		$post['p_ids']	 = $data['ids'];
		$post['p_uniqueId'] = $data['userId'].time();
		//print_r($post);exit;
		$stored = "Call proc_upload_image(?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		//print_r($result);exit;
		if($result){
			$resEmail = $this->sendEmail($result);
		}
		return $result;
    }
	
	public function sendEmail($data){
		//echo 'aaa';
		$config['protocol'] = 'smtp';          
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;         
		$config['smtp_user'] = 'lokesh@vartulz.com';
		$config['smtp_pass'] = 'lokesh@4321'; 
		$config['mailtype'] = 'html';
		/*$message = '<h3>Please visit the Below Link for approve images</h3>
					'.base_url().'index.php/home/approveImages/'.$data[0]['uniqueId'].'';*/
		$message = '<!DOCTYPE html>
						<html>
							<head>
								<style>
								body {
							font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
							font-size: 13px;
							color: #676a6c;
							overflow-x: hidden;
							line-height: 1.42857143;
							margin: 0;
						}
								.row {
							margin-right: -15px;
							margin-left: -15px;
						}
						.row::before {
							display: table;
							content: " ";
						}
						.col-lg-12 {
							width: 100%;
							float: left;
							position: relative;
						min-height: 1px;
						padding-right: 15px;
						padding-left: 15px;
						}
						.ibox {
							clear: both;
							margin-bottom: 25px;
							margin-top: 0;
							padding: 0;
						}
						.ibox-title {
							-moz-border-bottom-colors: none;
							-moz-border-left-colors: none;
							-moz-border-right-colors: none;
							-moz-border-top-colors: none;
							background-color: #ffffff;
							border-color: #e7eaec;
							border-image: none;
							border-style: solid solid none;
							border-width: 3px 0 0;
							color: inherit;
							margin-bottom: 0;
							padding: 14px 15px 7px;
							min-height: 30px;
						}
						.ibox-title h5 {
							display: inline-block;
							font-size: 14px;
							margin: 0 0 7px;
							padding: 0;
							text-overflow: ellipsis;
							float: left;
							font-weight: 600;
							line-height: 1.1;
							color: inherit;
						}
						.ibox-content {
							background-color: #ffffff;
							color: inherit;
							padding: 15px 20px 20px 20px;
							border-color: #e7eaec;
							border-image: none;
							border-style: solid solid none;
							border-width: 1px 0;
						}
						.table-bordered {
							border: 1px solid #EBEBEB;
						}
						.table {
							width: 100%;
							max-width: 100%;
							margin-bottom: 20px;
							background-color: transparent;
							border-spacing: 0;
						border-collapse: collapse;
						}
						.table > thead > tr > th {
							line-height: 1.42857;
							padding: 8px;
							vertical-align: top;
							border-bottom: 1px solid #DDDDDD;
							border: 1px solid #e7e7e7;
							background-color: #F5F5F6;
						}
						.table > tbody > tr > td {
							border-top: 1px solid #e7eaec;
							line-height: 1.42857;
							padding: 8px;
							vertical-align: top;
							border: 1px solid #e7e7e7;
						}

						.float-e-margins .btn {
							margin-bottom: 5px;
						}
						.btn-primary {
							background-color: #1ab394;
							border-color: #1ab394;
							color: #FFFFFF;
						}
						.btn {
							border-radius: 3px;
							display: inline-block;
							font-weight: 400;
							text-align: center;
						white-space: nowrap;
						vertical-align: middle;touch-action: manipulation;
						cursor: pointer;
						background-image: none;
						border: 1px solid transparent;
						}
						.btn-sm {
							padding: 5px 10px;
							font-size: 12px;
							line-height: 1.5;
							
						}
						button{
							font-family: inherit;
							text-transform: none;
							overflow: visible;
						}
								</style>
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
															<th style="text-align: center;"><a href="'.base_url().'home/approveImage/'.$data[0]['uniqueId'].'/All" class="btn btn-sm btn-primary">APPROVE ALL</a></th>
														</tr>
														</thead>
														<tbody>';
		foreach($data as $val){
			$message .= '<tr>
							<td>'.$val['title'].'</td>
							<td>'.$val['name'].'</td>
							<td>'.$val['desc'].'</td>
							<td>
								<img src="'.base_url().'uploads/galleryImages/'.$val['image'].'" style="width:100px;height:100px;">
							</td>
							<td><a class="btn btn-sm btn-primary" href="'.base_url().'home/approveImage/'.$val['uniqueId'].'/'.$val['galleryId'].'">APPROVE</a></td>
						</tr>';
			
		}
						
	
						
				$message .= 				'</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
					</body>
					
					</html>';
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('lokesh@vartulz.com', 'Jashne');
		// Receiver email address
		$list = array('ish@vartulz.com', 'sanket1994jain@gmail.com');
		$this->email->to($list);
		$this->email->subject('Images');
		$this->email->message($message);
		$this->email->send();
		return true;
	}
	
	
	public function imageList($data) {
		$sql = "SELECT title,`name`,`desc`,CONCAT((SELECT `name` FROM `tbl_common` WHERE `type`='url'),'uploads/galleryImages/',image) AS imageName,DATE_FORMAT(createdDate,'%d-%m-%Y') AS imageDate 
				FROM tbl_gallery WHERE `status` = 'Approved'
				UNION ALL
				SELECT title,`name`,`desc`,CONCAT((SELECT `name` FROM `tbl_common` WHERE `type`='url'),'uploads/galleryImages/',image) AS imageName,DATE_FORMAT(createdDate,'%d-%m-%Y') AS imageDate 
				FROM tbl_gallery WHERE `status` = 'Unapproved' AND userId = '".$data['userId']."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
    }
	
	
	
	/*public function imageList($data) {
		$sql = "SELECT title,`name`,`desc`,'hhhh' AS imageName,DATE_FORMAT(createdDate,'%d-%m-%Y') AS imageDate 
					FROM tbl_gallery WHERE `status` = 'Approved'
					UNION ALL
					SELECT title,`name`,`desc`,'kkkkk' AS imageName,DATE_FORMAT(createdDate,'%d-%m-%Y') AS imageDate 
					FROM tbl_gallery WHERE `status` = 'Unapproved' AND userId = '".$data['userId']."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
    }*/
	
	public function sendSms($data){
		//print_r($data);exit;
		$mobile = $data['mobile'];
		$otp = str_replace(' ','+',$data['otp']);
		$smsTime = $data['smsTime'];
		//$date = date('d-m-Y').'T'.date('h:i:s');
		$smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$mobile.'&message='.$otp.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate='.$smsTime.'';
		//echo $smsApi; exit;
		$ch = curl_init($smsApi);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $otp);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $mobile);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $smsTime);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result2 = curl_exec($ch); // This is the result from the API
		//print_r($result);
		curl_close($ch);
		return $result2;
	}
	
	/*public function sendSms($data){
		//print_r($data);
		$authKey = '166682AFyy8hof35o597580cd';
		$mobileNumber = $data['mobile'];
		$messageText = urlencode($data['otp']);
		$sender =  'ABCDEF';
		$route =  '4';
		$country =  '0';
		$smsApi = 'http://msg.bmwebmedia.com/api/sendhttp.php?authkey='.$authKey.'&mobiles='.$mobileNumber.'&message='.$messageText.'&sender='.$sender.'&route='.$route.'&country='.$country.'';
			//echo $smsApi; exit;
			$ch = curl_init($smsApi);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $authKey);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $mobileNumber);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $messageText);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $sender);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $route);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $country);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); // This is the result from the API
			//print_r($result);
            curl_close($ch);
			return $result;
	}*/
	
	public function message($data) {
		$post['p_mode']	 		 = $data['mode'];
		$post['p_userId']	 	 = $data['userId'];
		$post['p_messageText']	 = $data['messageText'];
		$post['p_messageImage']	 = $data['messageImage'];
		$post['p_messageType']	 = $data['messageType'];
		$post['p_app']			 = $data['app'];
		$stored = "Call proc_message_send_new(?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query();exit;
		$result = $query->result_array();	
		return $result;
    }
	
	public function notificationList($data) {
		$sql = "SELECT 
				CASE WHEN HOUR(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)) >= 24
				THEN
				CONCAT(DATEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime),' day ago')
				WHEN HOUR(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)) < 24 AND HOUR(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)) >=1
				THEN
				CONCAT(HOUR(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)),' hour ago')
				WHEN HOUR(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)) = 00 
				AND MINUTE(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)) <= 59
				AND MINUTE(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)) > 00
				THEN
				CONCAT(MINUTE(TIMEDIFF(ADDDATE(NOW(), INTERVAL 330 MINUTE),t1.datetime)),' min ago')
				ELSE
				'Just Now'
				END
				`dateTime`,
				CASE WHEN t1.type = 'flight'
				THEN
				CONCAT('Dear ',IFNULL(t2.userName,''),', Your flight is from ',IFNULL(t2.boardingCity,''),', Your flight details are ',
					IFNULL(t2.1FlightNo,''), ' ',IFNULL(t2.1ETD,''), ' ',IFNULL(t2.1DATE,''))
				ELSE
				t1.description
				END
				AS description,
				CASE WHEN t1.type = 'flight'
				THEN
				'Flight Info'
				ELSE
				t1.title
				END
				AS title
				FROM `tbl_notification` AS t1,tbl_users AS t2 WHERE t1.deleted = 'N' AND t1.sendStatus = 'Y' AND t2.userId = '".$data['userId']."' AND t1.app = t2.app ORDER BY t1.datetime DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();exit;
		$result = $query->result_array();	
		return $result;
    }
	
	public function getScrapBook()
	{
		$this->db->select("name,nickname,hobbies,favoriteFood,strengths,talents,changeAboutMyself,
						happiestMoment,embarrassingMoment,roleModel,futureGoals,CONCAT('".base_url()."','uploads/scrapImage/',image) AS image,yourVideo AS yourVideo",false);
		$this->db->from('tbl_scrap_book');
		$this->db->where('createdBy',$this->input->post('userId'));
		$query = $this->db->get();
		$result = $query->result_array();	
		return $result;

	}


	public function getMenu()
	{
		$this->db->select('id,menuName');
		$this->db->from('tbl_menu');
		$this->db->where('app',$this->input->post('app'));
		$this->db->where('deleted','N');
		$this->db->order_by('orderNo','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	
}
