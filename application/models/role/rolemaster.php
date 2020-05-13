<?php 

class RoleMaster extends CI_Model {

    public function validate() {
		$post['p_userName']	 = $this->input->post('userName');	
		$post['p_password']	 = $this->input->post('password');
		$stored = "Call proc_web_login_validation(?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		//echo "<pre>"; print_r($result);exit;
		$query->next_result();
		$query->free_result();
		if($result[0]['responseCode']==0){
			return $result;
		} else if($result[0]['responseCode']==200) {
			$sessionData = array(
				'userId' => $result[0]['userId'],
				'userName' => $result[0]['userName'],
				'email' => $result[0]['email'],
				'mobile' => $result[0]['mobile'],				
				'validated' => true
				);
			$this->session->set_userdata($sessionData);
            return $result;
		}
    }
	
	public function addNotification($mode){
		//print_r($this->input->post());exit;
		$date = explode('-',$this->input->post('date'));
		$newDate = $date[2].'-'.$date[1].'-'.$date[0];
		$dateTime = $newDate.' '.$this->input->post('time');
		//echo $dateTime;exit;
		if($mode == 'text'){
			$sql = 'Insert into tbl_notification (type,title,description,datetime,app)
		         values ("'.$mode.'","'.$this->input->post('title').'","'.$this->input->post('description').'","'.$dateTime.'","'.$this->input->post('app').'")';
		}else{
			$sql = 'Insert into tbl_notification (type,format,datetime,app)
		         values ("'.$mode.'","'.$this->input->post('format').'","'.$dateTime.'","'.$this->input->post('app').'")';
		}
		
		$query = $this->db->query($sql);
		return true;
	}
	
	
	
	public function notificationList($mode){
		$sql = "Select *,CASE WHEN app='J' THEN 'Jashne' ELSE 'GEN Y' END as app from tbl_notification where `type` = '".$mode."' and deleted = 'N' order by createdDate DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		//echo '<pre>';print_r($result);exit;
		return $result;
	}
	
	public function getAllImages($uniqueId){
		$sql = 'Select *,
				CASE WHEN (SELECT COUNT(galleryId) FROM tbl_gallery WHERE uniqueId = "'.$uniqueId.'") 
				= (SELECT COUNT(galleryId) FROM tbl_gallery WHERE uniqueId ="'.$uniqueId.'" AND `status` = "Approved")
				THEN
				"Y"
				ELSE
				"N"
				END
				AS approveStatus
				from tbl_gallery where deleted = "N" and uniqueId = "'.$uniqueId.'"';
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
	}
	
	public function approve(){
		$post['p_id']	 = $this->input->post('id');	
		$post['p_uniqueId']	 = $this->input->post('uniqueId');
		$stored = "Call proc_approve_images(?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		return $result;
		
	}
	
	public function approveImage($uniqueId,$id){
		$post['p_id']	 = $id;	
		$post['p_uniqueId']	 = $uniqueId;
		$stored = "Call proc_approve_images(?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		return $result;
		
	}
	
	public function sendPushCrone(){
		$stored = "Call proc_crone_job_push()";
		$query = $this->db->query($stored);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();
		$query->next_result();
		$query->free_result();		
		return $result;
	}
	
	public function sendSMSCrone(){
		$stored = "Call proc_crone_job_sms()";
		$query = $this->db->query($stored);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		return $result;
	}
	
	
	public function mobileValidate(){
		$sql = 'SELECT * FROM `tbl_users` WHERE mobile = "'.$this->input->post('mobile').'"';
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
	}
	
	public function messageInsert($image){
		$post['p_userId']	 = $this->input->post('userId');	
		$post['p_messageText']	 = $this->input->post('message');
		$post['p_messageImage']	 = $image;
		$post['p_messageType']	 = $this->input->post('type');
		$stored = "Call proc_feedback_send(?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); 
		$result = $query->result_array();
		return true;
	}
	
	public function addUser($data){
		//echo '<pre>';print_r($this->input->post());exit;
		$post['p_mode']	 = $data['mode'];	
		$post['p_userId']	 = $data['userId'];	
		$post['p_salutation']	 = $this->input->post('salutation');	
		$post['p_userName']	 = $this->input->post('userName');
		$post['p_designation']	 = $this->input->post('designation');
		$post['p_il']	 = $this->input->post('il');
		$post['p_mobile']	 = $this->input->post('mobile');
		$post['p_emailId']	 = $this->input->post('emailId');
		$post['p_category']	 = $this->input->post('category');
		$post['p_companyName']	 = $this->input->post('companyName');
		$post['p_city']	 = $this->input->post('city');
		$post['p_region']	 = $this->input->post('region');
		$post['p_1From']	 = $this->input->post('1From');
		$post['p_1FlightCarrier']	 = $this->input->post('1FlightCarrier');
		$post['p_1FlightNo']	 = $this->input->post('1FlightNo');
		$post['p_1Class']	 = $this->input->post('1Class');
		$post['p_1Date']	 = date('Y-m-d H:i:s', strtotime($this->input->post('1Date')));
		$post['p_1ETD']	 = $this->input->post('1ETD');
		$post['p_1ETA']	 = $this->input->post('1ETA');
		$post['p_2From']	 = $this->input->post('2From');
		$post['p_2FlightCarrier']	 = $this->input->post('2FlightCarrier');
		$post['p_2FlightNo']	 = $this->input->post('2FlightNo');
		$post['p_2Class']	 = $this->input->post('2Class');
		$post['p_2Date']	 = date('Y-m-d H:i:s', strtotime($this->input->post('2Date')));
		$post['p_2ETD']	 = $this->input->post('2ETD');
		$post['p_2ETA']	 = $this->input->post('2ETA');
		$post['p_dateOfBirth']	 = date('Y-m-d H:i:s', strtotime($this->input->post('dateOfBirth')));
		$post['p_dateOfMarriage']	 = date('Y-m-d H:i:s', strtotime($this->input->post('dateOfMarriage')));
		$post['p_nonVeg']	 = $this->input->post('nonVeg');
		$post['p_nonSmokingRoom']	 = $this->input->post('nonSmokingRoom');
		$post['p_idCardTravelling']	 = $this->input->post('idCardTravelling');
		$post['p_idCardNo']	 = $this->input->post('idCardNo');
		$post['p_idCardExpiryDate']	 = date('Y-m-d H:i:s', strtotime($this->input->post('idCardExpiryDate')));
		$post['p_bloodGroup']	 = $this->input->post('bloodGroup');
		$post['p_TShirtSizeMaleFemale']	 = $this->input->post('TShirtSizeMaleFemale');
		$post['p_ShirtSizeMaleFemale']	 = $this->input->post('ShirtSizeMaleFemale');
		$post['p_distributor']	 = $this->input->post('distributor');
		$post['p_boardingCity']	 = $this->input->post('boardingCity');
		$post['p_address']	 = $this->input->post('address');
		//echo '<pre>';print_r($post);exit;
		$stored = "Call proc_user_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); 
		$result = $query->result_array();
		return $result;
	}
	
	public function userList(){
		$sql = 'SELECT *,DATE_FORMAT(`1Date`,"%d-%m-%Y") AS `1Date`,DATE_FORMAT(`2Date`,"%d-%m-%Y") AS `2Date` FROM `tbl_users` where deleted = "N" and userType != "admin"';
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
	}
	
	public function userById($userId){
		$sql = 'SELECT * FROM `tbl_users` where userId = "'.$userId.'"';
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
	}
	
	public function userExist($mobile){
		$sql = 'SELECT count(mobile) as totalCount FROM `tbl_users` where mobile = "'.$mobile.'" and deleted = "N"';
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
	}
	
	public function smsList(){
		$sql = "SELECT *,CASE WHEN app='J' THEN 'Jashne' ELSE 'GEN Y' END as app FROM `tbl_sms_data` where deleted ='N' order by createdDate desc";
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		return $result;
	}
	
	public function addSMS(){
		$post['p_smsContent']	 = $this->input->post('smsContent');	
		$stored = "Call proc_sms_send(?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); 
		$result = $query->result_array();
		return $result;
	}
	
	public function addSMSAuto(){
		//print_r($this->input->post());exit;
		$date = explode('-',$this->input->post('date'));
		$newDate = $date[2].'-'.$date[1].'-'.$date[0];
		$dateTime = $newDate.' '.$this->input->post('time');
		//echo $dateTime;exit;
		$sql = 'Insert into tbl_sms_data (smsContent,datetime,app)
		         values ("'.$this->input->post('smsContent').'","'.$dateTime.'","'.$this->input->post('app').'")';
		$query = $this->db->query($sql);
		return true;
	}
	
	
	
}
