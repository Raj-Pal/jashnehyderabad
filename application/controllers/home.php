<?php

defined('BASEPATH') OR exit('No direct script access allowed');

define("SERVER_KEY", "e1699c7e-3408-4e17-b70c-bd3ab508dbc6");

class Home extends CI_Controller {
   function __construct() {
		parent::__construct();
        $this->load->model('role/roleMaster'); 
		$this->load->model('common_model'); 
		$this->load->model('webService/apiModel', 'Api', TRUE);		
    } 
  
    public function index($msg = NULL){ 
	//echo'a';exit;
		if($this->session->userdata('validated')){
			redirect('home/dashboard');
		}
		$data['msg'] = $msg;
		$data['content'] = 'login';
        $this->load->view('Layout/dashboardLayoutLogin',$data);       
    }
	
	public function login() {
		//echo'a';exit;
		if($this->session->userdata('validated')){
			redirect('home/dashboard');
		}
		$this->load->model('role/roleMaster');
		//print_r($this->input->post());exit;
        $result = $this->roleMaster->validate($this->input->post());
		//print_r($result);exit;
	    if ($result[0]['responseCode']==0) {
            $msg = '<div class = "alert alert-error" style="background-color: #1ab394;margin:0px !important;">
                    <button type = "button" class = "close" data-dismiss = "alert">
                    <i class = "icon-remove"></i>
                    </button>
					<strong style="color:white;">
                    <i class = "icon-remove"></i>
                   '.$result[0]['responseMessage'].'
                    </strong>
					</div>';
			$this->index($msg);
        } else if ($this->session->userdata('validated')) {
			//echo'a';exit;
			redirect('home/dashboard');
		}
    }
	
	public function logout() {
		$this->session->sess_destroy();
        redirect('home');
    }
	
	public function dashboard() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$this->load->model('role/roleMaster');
		//$data['question4Data'] = $this->roleMaster->getQuestionChart1Data('4');
		
		//print_r($data['tellChartData']);
		$data['content'] = 'dashboard';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function notification() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$this->load->model('role/roleMaster');
		$data['notificationList'] = $this->roleMaster->notificationList('text');
		
		//print_r($data['tellChartData']);
		$data['content'] = 'notification';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addNotification() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$result = $this->roleMaster->addNotification('text');
		//print_r($this->input->post());exit;
		redirect('home/notification');
    }
	
	public function flightNotification() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$this->load->model('role/roleMaster');
		$data['notificationList'] = $this->roleMaster->notificationList('flight');
		
		//print_r($data['notificationList']);
		$data['content'] = 'flightNotification';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addFlightNotification() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$result = $this->roleMaster->addNotification('flight');
		//print_r($this->input->post());exit;
		redirect('home/flightNotification');
    }
	
	
	public function approveImages(){
		$uniqueId = $this->uri->segment(3);
		$data['result'] = $this->roleMaster->getAllImages($uniqueId);
		$this->load->view('emailFormat',$data);
	}
	
	public function approveImage(){
		$uniqueId = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data['result'] = $this->roleMaster->approveImage($uniqueId,$id);
		echo '<h3>Image Approved Successfully</h3>';
		//$this->load->view('emailFormat',$data);
	}
	
	public function approve(){
		$main= $this->roleMaster->approve();
        $res= json_encode($main);
        echo $res;
    }
	
	public function sendPushCrone() {
		$result = $this->roleMaster->sendPushCrone();
		$resultSms = $this->roleMaster->sendSMSCrone();
		//echo '<pre>';print_r($result); exit;
		foreach($result as $val){
			$title = $val['title'];
			$desc = $val['description'];
			$gcmId = $val['gcmId'];
			$mobile = $val['mobile'];
			$smsTime = $val['smsTime'];
			if($val['mode'] == 'push'){
				$res = $this->push($title,$desc,$gcmId);
			}else{
				//$res = $this->Api->sendSms(array('otp'=>$desc,'mobile'=>$mobile,'smsTime'=>$smsTime));
			}
			
			//print_r($res);
		}
		
		//print_r($res);exit;
		foreach($resultSms as $val1){
			$desc1 = $val1['smsContent'];
			$mobile1 = $val1['mobile'];
			$res1 = $this->Api->sendSms(array('otp'=>$desc1,'mobile'=>$mobile1));
			//print_r($res);
		}
		echo 'Done';
	}
	
	public function push($title,$desc,$gcmId){
		$content = array(
			"en" => $desc
			);
		
		$fields = array(
			'app_id' => SERVER_KEY,
			'include_player_ids' => array($gcmId),
			'data' => array("foo" => "bar"),
			'contents' => $content
		);
		
		$fields = json_encode($fields);
		//print("\nJSON sent:\n");
		//print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic N2FkYWVhMzktOGZkNC00YmFmLWJiNmYtMDk3NTlmYWRiNTdl'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
	public function chatView(){ 
		$this->load->view('chatView');       
    }
		
	public function mobileValidate(){
		$main= $this->roleMaster->mobileValidate();
        $res= json_encode($main);
        echo $res;
    }
	
	public function messageInsert(){
		if($this->input->post('image')){
			$image = $this->base64_to_jpeg($this->input->post('image'),time().'.'.$this->input->post('ext').'');
		}
		$main= $this->roleMaster->messageInsert($image);
        $res= json_encode($main);
        echo $res;
    }
	
	public function base64_to_jpeg($base64_string, $output_file){
		$ifp = fopen( 'uploads/galleryImages/'.$output_file, 'wb' ); 
		$data = explode( ',', $base64_string );
		fwrite( $ifp, base64_decode( $data[ 1 ] ) );
		fclose( $ifp ); 
		return $output_file; 
	}
	
	public function user() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$this->load->model('role/roleMaster');
		if($this->uri->segment(3)){
			$data['editValue'] = $this->roleMaster->userById($this->uri->segment(3));	
			//print_r($data['editValue']);exit;
		}
		$data['userList'] = $this->roleMaster->userList();
		$data['content'] = 'user';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addUser() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		if($this->uri->segment(3)){
			$data['mode'] = 1;
			$data['userId'] = $this->uri->segment(3);
		}else{
			$data['mode'] = 0;
		}
		$result = $this->roleMaster->addUser($data);
		//print_r($result);exit;
		$this->session->set_flashdata('success_message',$result[0]['message']);
		redirect('home/user');
    }
	
	public function userDelete() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		
		$update = $this->common_model->updateValue(array( 'deleted' => 'Y'),'tbl_users', array('userId' => $this->uri->segment(3)));
		//print_r($result);exit;
		$this->session->set_flashdata('success_message','User Deleted Successfully');
		redirect('home/user');
    }
	
	public function uploadExcelUser(){
		
		if($_FILES['importExcel']['name']){		
				$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
				$file_name = time().$file_name;  
				$file_path = "uploads/userExcel/".$file_name;
				
				if(move_uploaded_file($_FILES["importExcel"]["tmp_name"],$file_path)){
					//echo $_FILES['file']['name'];
					$this->load->library('excel');
					$arr_data = array();
					$objPHPExcel = PHPExcel_IOFactory::load($file_path);
			
					$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			
					foreach ($cell_collection as $cell){
						   $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
						   $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
						   $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
							if ($row == 1) {
								$header[$row][$column] = $data_value;
							} else {
							   $arr_data[$row][$column] = $data_value;
							}
					}
					
					$j = 0; 
					
					$total=1;
					$totalCount = 1;
					//echo '<pre>';print_r($header);exit;
						foreach($arr_data as $row){

							if(isset($row['J']) && !empty($row['J']) && isset($row['G']) && !empty($row['G']) ){
								$userExist = $this->roleMaster->userExist(trim($row['J']));
								if($userExist[0]['totalCount'] == 0){
									$insert['salutation']	 = trim($row['F']);	
									$insert['userName']	 = trim($row['G']);
									$insert['designation']	 = trim($row['H']);
									$insert['il']	 = trim($row['I']);
									$insert['mobile']	 = trim($row['J']);
									$insert['emailId']	 =trim($row['K']);
									$insert['category']	 = trim($row['E']);
									$insert['companyName']	 = trim($row['D']);
									$insert['city']	 = trim($row['C']);
									$insert['region']	 = trim($row['A']);
									$insert['1From']	 = trim($row['X']);
									$insert['1FlightCarrier']	 = trim($row['Y']);
									$insert['1FlightNo']	 = trim($row['Z']);
									$insert['1Class']	 = trim($row['AA']);
									$insert['1Date']	 = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP(trim($row['AB'])));
									$insert['1ETD']	 = trim($row['AC']);
									$insert['1ETA']	 = trim($row['AD']);
									$insert['2From']	 = trim($row['AE']);
									$insert['2FlightCarrier']	 = trim($row['AF']);
									$insert['2FlightNo']	 = trim($row['AG']);
									$insert['2Class']	 = trim($row['AH']);
									$insert['2Date']	 = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP(trim($row['I'])));
									$insert['2ETD']	 = trim($row['AJ']);
									$insert['2ETA']	 = trim($row['AK']);
									$insert['dateOfBirth']	 = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP(trim($row['M'])));
									$insert['dateOfMarriage']	 = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP(trim($row['N'])));
									$insert['nonVeg']	 = trim($row['O']);
									$insert['nonSmokingRoom']	 = trim($row['P']);
									$insert['idCardTravelling']	 = trim($row['Q']);
									$insert['idCardNo']	 = trim($row['R']);
									$insert['idCardExpiryDate']	 = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP(trim($row['S'])));
									$insert['bloodGroup']	 = trim($row['U']);
									$insert['TShirtSizeMaleFemale']	 = trim($row['V']);
									$insert['ShirtSizeMaleFemale']	 = trim($row['W']);
									$insert['distributor']	 = trim($row['B']);
									$insert['boardingCity']	 = trim($row['L']);
									$insert['address']	 = trim($row['T']);
									$insert['hotelName']	 = trim($row['AL']);
									$insert['hotelRoom']	 = trim($row['AM']);
									//echo '<pre>';print_r($insert);exit;
									$this->common_model->insertValue('tbl_users', $insert);	
									$total++;
								}else{
									$error[$j]['region'] = trim($row['A']);
									$error[$j]['distributor'] = trim($row['B']);
									$error[$j]['city'] = trim($row['C']);
									$error[$j]['companyName'] = trim($row['D']);
									$error[$j]['category'] = trim($row['E']);
									$error[$j]['salutation'] = trim($row['F']);
									$error[$j]['userName'] = trim($row['G']);
									$error[$j]['designation'] = trim($row['H']);
									$error[$j]['il'] = trim($row['I']);
									$error[$j]['mobile'] = trim($row['J']);
									$error[$j]['emailId'] = trim($row['K']);
									$error[$j]['boardingCity'] = trim($row['L']);
									$error[$j]['dateOfBirth'] = trim($row['M']);
									$error[$j]['dateOfMarriage'] = trim($row['N']);
									$error[$j]['nonVeg'] = trim($row['O']);
									$error[$j]['nonSmokingRoom'] = trim($row['P']);
									$error[$j]['idCardTravelling'] = trim($row['Q']);
									$error[$j]['idCardNo'] = trim($row['R']);
									$error[$j]['idCardExpiryDate'] = trim($row['S']);
									$error[$j]['address'] = trim($row['T']);
									$error[$j]['bloodGroup'] = trim($row['U']);
									$error[$j]['TShirtSizeMaleFemale'] = trim($row['V']);
									$error[$j]['ShirtSizeMaleFemale'] = trim($row['W']);
									$error[$j]['1From'] = trim($row['X']);
									$error[$j]['1FlightCarrier'] = trim($row['Y']);
									$error[$j]['1FlightNo'] = trim($row['Z']);
									$error[$j]['1Class'] = trim($row['AA']);
									$error[$j]['1Date'] = trim($row['AB']);
									$error[$j]['1ETD'] = trim($row['AC']);
									$error[$j]['1ETA'] = trim($row['AD']);
									$error[$j]['2From'] = trim($row['AE']);
									$error[$j]['2FlightCarrier'] = trim($row['AF']);
									$error[$j]['2FlightNo'] = trim($row['AG']);
									$error[$j]['2Class'] = trim($row['AH']);
									$error[$j]['2Date'] = trim($row['AI']);
									$error[$j]['2ETD'] = trim($row['AJ']);
									$error[$j]['2ETA'] = trim($row['AK']);
									$error[$j]['error']	 = 'Duplicate Mobile Number';
									$j++;
								}
							}else{
								$error[$j]['region'] = trim($row['A']);
								$error[$j]['distributor'] = trim($row['B']);
								$error[$j]['city'] = trim($row['C']);
								$error[$j]['companyName'] = trim($row['D']);
								$error[$j]['category'] = trim($row['E']);
								$error[$j]['salutation'] = trim($row['F']);
								$error[$j]['userName'] = trim($row['G']);
								$error[$j]['designation'] = trim($row['H']);
								$error[$j]['il'] = trim($row['I']);
								$error[$j]['mobile'] = trim($row['J']);
								$error[$j]['emailId'] = trim($row['K']);
								$error[$j]['boardingCity'] = trim($row['L']);
								$error[$j]['dateOfBirth'] = trim($row['M']);
								$error[$j]['dateOfMarriage'] = trim($row['N']);
								$error[$j]['nonVeg'] = trim($row['O']);
								$error[$j]['nonSmokingRoom'] = trim($row['P']);
								$error[$j]['idCardTravelling'] = trim($row['Q']);
								$error[$j]['idCardNo'] = trim($row['R']);
								$error[$j]['idCardExpiryDate'] = trim($row['S']);
								$error[$j]['address'] = trim($row['T']);
								$error[$j]['bloodGroup'] = trim($row['U']);
								$error[$j]['TShirtSizeMaleFemale'] = trim($row['V']);
								$error[$j]['ShirtSizeMaleFemale'] = trim($row['W']);
								$error[$j]['1From'] = trim($row['X']);
								$error[$j]['1FlightCarrier'] = trim($row['Y']);
								$error[$j]['1FlightNo'] = trim($row['Z']);
								$error[$j]['1Class'] = trim($row['AA']);
								$error[$j]['1Date'] = trim($row['AB']);
								$error[$j]['1ETD'] = trim($row['AC']);
								$error[$j]['1ETA'] = trim($row['AD']);
								$error[$j]['2From'] = trim($row['AE']);
								$error[$j]['2FlightCarrier'] = trim($row['AF']);
								$error[$j]['2FlightNo'] = trim($row['AG']);
								$error[$j]['2Class'] = trim($row['AH']);
								$error[$j]['2Date'] = trim($row['AI']);
								$error[$j]['2ETD'] = trim($row['AJ']);
								$error[$j]['2ETA'] = trim($row['AK']);
								$error[$j]['error']	 = 'Field is mandatory';
								$j++;						
							} 
							$totalCount++;
						}
						//print_r($total);
						//print_r($totalCount);
						//echo '<pre>';print_r($error);exit;
						if($error){
							//$this->session->set_flashdata('export_error',$error);
							$data['er']=$error;
							$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
							$data['content'] = 'user';
							$this->load->view('Layout/dashboardLayoutDash',$data);
							//echo '<pre>';print_r($this->session->flashdata('export_error'));exit;
							//echo '<pre>';print_r($error);exit;
							//redirect('home/user');	
						}else{
							redirect('home/user');	
						}
						
					}
						
				}else{
					redirect('home/user');
				}

	}
	
	public function download() {
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$rs = $this->db->get('sample_user_format');
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
		//Fill data
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A1');
		$this->excel->getActiveSheet()->getStyle('A1:AM1')->getFont()->setBold(true)->setSize(12);
		$filename='sample_user_format.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	} 
	
	public function smsModule() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$this->load->model('role/roleMaster');
		$data['smsList'] = $this->roleMaster->smsList();
		$data['content'] = 'smsModule';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function smsModuleAuto() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$this->load->model('role/roleMaster');
		$data['smsList'] = $this->roleMaster->smsList();
		$data['content'] = 'smsModuleAuto';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addSMS() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$result = $this->roleMaster->addSMS();
		if($result){
			foreach($result as $val){
				$desc = $val['smsContent'];
				$mobile = $val['mobile'];
				$res = $this->Api->sendSms(array('otp'=>$desc,'mobile'=>$mobile));
			}
			
		}
		//echo '<pre>';print_r($result);exit;
		redirect('home/smsModule');
    }
	
	public function addSMSAuto() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		$result = $this->roleMaster->addSMSAuto();
		redirect('home/smsModuleAuto');
    }
	
	
	
} 

?>