<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define("GOOGLE_API_KEY", "AIzaSyA7tYOQH__KfBbY2DvuAejQCkg4e-M9_7Y");
header('Access-Control-Allow-Origin: *');
class Api extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model('webService/apiModel', 'Api', TRUE);
    }

    function validateMandagoryFields($postData, $mendatoryFields) {
        $res = false;
        foreach ($mendatoryFields as $field) {
            if (!isset($postData[$field]) || strlen($postData[$field]) == 0) {
                $this->failed["responseMessage"] = "$field can't be left blank";
                $res = $this->failed;
                break;
            }

        }
        return $res;
    }
    		
	public function login(){
		
		if ($this->input->post()){

            $mendatoryFields = array('mobile','app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {

            	if($this->input->post('app') == 'J' or $this->input->post('app') == 'G'){

					$data['app']	=$this->input->post('app');
					$data['mobile']	=$this->input->post('mobile');
					$data['gcmId']	=$this->input->post('gcmId');
					$res = $this->Api->login($data);
					
					if($res[0]['responseCode'] == 200 && $res[0]['directLogin'] == 'N'){
						$resOtp=$this->Api->sendSms($res[0]);
						//print_r($resOtp);exit;
					}
					if ($res[0]['responseCode'] == 200) {
						$res1['menu'] = $this->Api->getMenu();
						$responce=array_merge($res[0],$res1);
					}else{
						$responce=$res[0];
					}
					
					
            	
            		
            	}else{
            		
            		$this->failed['responseMessage']='App not exists';
					$this->failed['responseCode']=0;
            		$responce = $this->failed;
            	}
            	
			}
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}

		echo json_encode($responce);
	}
	
	public function verifyOtp(){
		
		if ($this->input->post()){
			$data['mobile']=$this->input->post('mobile');
			$data['otp']=$this->input->post('otp');
			$data['gcmId']=$this->input->post('gcmId');
			$data['app']=$this->input->post('app');
			$res=$this->Api->verifyOtp($data);
			//print_r($res);exit;
			$responce=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);
	}
	
	public function profile(){
		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$res=$this->Api->profile($data);
			//print_r($res);exit;
			$responce=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);
	}
	
	public function uploadImage(){
		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$imageCount=$this->input->post('imageCount');
			for($i=1;$i<=$imageCount;$i++){
				$ids[] = $i;
				$title[] = $this->input->post('title'.$i);
				$name[] = $this->input->post('name'.$i);
				$desc[] = $this->input->post('desc'.$i);
				//$image[] = $this->input->post('image'.$i);
				$image[] = $this->base64_to_jpeg('data:image/png;base64,'.$this->input->post('image'.$i),$i.time().'.png');
				
			}
			$data['ids'] = implode(',',$ids);
			$data['title'] = implode(',',$title);
			$data['name'] = implode(',',$name);
			$data['desc'] = implode(',',$desc);
			$data['image'] = implode(',',$image);
			$res=$this->Api->uploadImage($data);
			//print_r($res);exit;
			$responce=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);
	}
	
	public function base64_to_jpeg($base64_string, $output_file){
		$ifp = fopen( 'uploads/galleryImages/'.$output_file, 'wb' ); 
		$data = explode( ',', $base64_string );
		fwrite( $ifp, base64_decode( $data[ 1 ] ) );
		fclose( $ifp ); 
		return $output_file; 
	}
	
	public function imageList(){
		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$res=$this->Api->imageList($data);
			//print_r($res);exit;
			$this->success['responseMessage']='Images Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$responce=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);
	}
	
	public function message(){
		
		if ($this->input->post()){
			$data['mode']=$this->input->post('mode');
			$data['userId']=$this->input->post('userId');
			$data['messageText']=$this->input->post('messageText');
			$data['messageType']=$this->input->post('messageType');
			$data['app']=$this->input->post('app');
			if($data['messageType'] == 'image'){
				if($this->input->post('messageImage') != ''){
					$data['messageImage'] = $this->base64_to_jpeg('data:image/png;base64,'.$this->input->post('messageImage'),time().'_image.png');
				}else{
					$data['messageImage'] = '';
				}
			}else{	
				//$data['messageImage'] = $this->base64_to_jpeg('data:video/mp4;base64,'.$this->input->post('messageImage'),time().'_video.mp4');
				if($_FILES['messageImage']['name']){
					$file =  str_replace(" ","",$_FILES['messageImage']['name']);
					$data['messageImage'] = time().$file;  
					$destination = './uploads/galleryImages/' . $data['messageImage'];
					move_uploaded_file($_FILES["messageImage"]["tmp_name"], $destination);
					
				}else{
					$data['messageImage'] = '';
				}
			}
			
			$res=$this->Api->message($data);
			//print_r($res);exit;
			$this->success['responseMessage']='Message Add Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$responce=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);
	}
	
	public function uploadfile(){
			
			
			$file = $_FILES['image']['name'];
			$destination = './uploads/testing/'.$file;
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $destination)){
				echo json_encode(array('data'=>'upload successfully'));
				$this->load->helper('file');
				$path = base_url().'log.txt';
				$data = 'werewrwerwerererwer';
				//$path = base_url()."uploads/testing/log.txt";
				/*if ( !file_put_contents($path, $data,FILE_APPEND))
				{
						echo json_encode(array('response'=>'Unable to write the file'));
				}
				else
				{
						echo json_encode(array('response'=>'Unable to write the file'));
				}*/
			}else{
				
				echo json_encode(array('data'=>'Unable to  upload'));
			}
	}	
	
	public function notificationList(){
		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['app']=$this->input->post('app');
			$res=$this->Api->notificationList($data);
			//print_r($res);exit;
			$this->success['responseMessage']='Notification Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$responce=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);
	}
	

	public function saveScrapBook ()
	{

		if ($this->input->post()){
	
            $mendatoryFields = array('name','userId');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {

            $checkScrap = $this->common_model->getCount('tbl_scrap_book',array('createdBy'=>$this->input->post('userId')));

            if ($checkScrap > 0) {

            	$data['result'] = $this->Api->getScrapBook();
				$this->success['responseMessage']='Your scrapbook is already filled';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$data);            		
            	
            }else{


            

	            	//$maxsize = 20498677;

					// if(($_FILES['videoFile']['size'] >= $maxsize)) {
				        
				 //        $this->failed['responseMessage']='Image size is greater then 16 MB';
					// 	$this->failed['responseCode']=0;
					// 	$responce=$this->failed;

				 //    }else{

				              	
						if($_FILES['imageFile']['name']){

							$temp = explode(".", $_FILES["imageFile"]["name"]);
							$imagefilename = round(microtime(true)) . '.' . end($temp);	
							$destinationImage = './uploads/scrapImage/' . $imagefilename;			
							move_uploaded_file($_FILES["imageFile".$i]["tmp_name"], $destinationImage);
						}  


		            	$data['name']			 	= $this->input->post('name');
		            	$data['nickname'] 		 	= $this->input->post('nickname');
		            	$data['hobbies'] 		 	= $this->input->post('hobbies');
		            	$data['favoriteFood']	 	= $this->input->post('favoriteFood');
		            	$data['strengths'] 		 	= $this->input->post('strengths');
		            	$data['talents'] 		 	= $this->input->post('talents');
		            	$data['changeAboutMyself']  = $this->input->post('changeAboutMyself');
		            	$data['happiestMoment'] 	= $this->input->post('happiestMoment');
		            	$data['embarrassingMoment'] = $this->input->post('embarrassingMoment');
		            	$data['roleModel'] 			= $this->input->post('roleModel');
		            	$data['futureGoals'] 		= $this->input->post('futureGoals');
		            	$data['createdBy'] 		    = $this->input->post('userId');
		            	$data['image'] 				= $imagefilename;
		            	$data['yourVideo'] 			= $this->input->post('text');;

		            	$id = $this->common_model->insertValue('tbl_scrap_book', $data);
		            	$res['result'] = $this->Api->getScrapBook();
						$this->success['responseMessage']='Your scrapbook is created successfully';
						$this->success['responseCode']=200;
		        		$responce = array_merge($this->success,$res);		            	

	            	

            	}	 
            }			

		}else{
			$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}
		echo json_encode($responce);

		
	}

	public function viewScrapBook()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('userId');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	$res['result'] = $this->Api->getScrapBook();
				$this->success['responseMessage']='Your scrapbook is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}
	
	
	public function videoUpload()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('userId');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {


				$temp = explode(".", $_FILES["videoFile"]["name"]);
				$videofilename = round(microtime(true)) . '.' . end($temp);	
				$destinationVideo = './uploads/scrapVideo/' . $videofilename;			
				move_uploaded_file($_FILES["videoFile".$i]["tmp_name"], $destinationVideo);

				$this->common_model->updateValue(array('yourVideo'=>$videofilename),'tbl_scrap_book',array('createdBy'=> $this->input->post('userId')));	

				$this->success['responseMessage']='Your scrapbook is created successfully';
				$this->success['responseCode']=200;
				$responce = $this->success;
			}		

		}else{
			$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
		}

		 echo json_encode($responce);
	}

	public function viewItinerary()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults('*','tbl_itineray',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your itinerary is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}


	public function viewConference()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults('*','tbl_conference_agenda',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your conference agenda is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}


	public function viewDoAndDont()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults("CONCAT('".base_url()."','uploads/appImages/',image) as Image",'tbl_dos',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your dos is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}		
	

	public function viewContacts()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults("*",'tbl_contacts',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your contact is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}


	public function viewAboutUs()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults("*",'tbl_about',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your about us is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}


	public function viewDocuments()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults("CONCAT('".base_url()."','uploads/appImages/',link) as link,file_name as name,team_name,members,mentor",'tbl_documents',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your doucments is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}	


	public function viewParticipant()
	{
		
		if ($this->input->post()){
	
            $mendatoryFields = array('app');
            $res = $this->validateMandagoryFields($this->input->post(), $mendatoryFields);
            if ($res != false) {

                $responce = $this->failed;
            } else {
            	


				$res['list'] = $this->common_model->getResults("name,company",'tbl_participant',array('deleted'=>'N','app'=>$this->input->post('app')),'id','ASC');
            	$this->success['responseMessage']='Your participant is view successfully';
				$this->success['responseCode']=200;
        		$responce = array_merge($this->success,$res);

            }
            
        }else{
        	$this->failed['responseMessage']='Please use post method';
			$this->failed['responseCode']=0;
			$responce=$this->failed;
        }    	

        echo json_encode($responce);
	}			


}



