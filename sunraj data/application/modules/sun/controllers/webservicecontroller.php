<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Webservicecontroller extends CI_Controller {
	 
		function __construct()
		 {
			  parent::__construct();
		    	  $this->load->library('form_validation');
		    	  $this->load->model('webservicemodel');
		    	  $this->load->helper(array('form', 'url'));
		    	  $this->load->library('session');
		    	  $this->load->library('email'); 
		    	  $this->load->helper('cookie');
					$this->load->library('curl');
				
		 }
 
 
 
  function getName()
		 {
			// print_r("check");exit;
			 $posttoken=$this->input->post('token');
			 //print_r($posttoken);exit;
			 if($this->webservicemodel->checktoken($posttoken)==TRUE)
			 {
				 // print_r("check");exit;
				 $data1=$this->webservicemodel->getName();
				 if($data1==TRUE)
				 {
					 					$response['success'] = 1;
								$response['message'] = 'Full Name';
								$response['form_data'] = $data1;
								echo json_encode($response);      
				 }
			 }
			 else{
				 
				 $response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			 }
		 }
 
 
 //create by dhananjay
function login()
{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
				$data = array(
						'username'              => $this->input->post('username'),
						'password'           => $this->input->post('password')
						  );  		
						  
						  $registration_id = array(
						'regid'              => $this->input->post('regid')
						  ); 
				$check_login=$this->webservicemodel->login_data($data,$registration_id);
				//print_r($check_login);exit;
				if($check_login)	
					{		
					$response['success'] = 1;
					$response['message'] = 'Login Successfully';
					$response['form_data'] = $check_login;
					echo json_encode($response);     		
					 }
					else
					{		
						$response['success'] = 0;
						$response['message'] = 'Login Fail';
						echo json_encode($response);
					}      	
			}
			else
				{
			 $response['success'] = 0;
			 $response['message'] = 'user not authorised';
			 echo json_encode($response);  
				}
}

 
 
 
 
 
//start register created by dhananjay
function register()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$form_data = array(
		'fullname' 		=>$this->input->post('address'),
		'mobno' 	=> $this->input->post('mobno'),
		//'email' 	=> $this->input->post('email'),
		'address' 	=> $this->input->post('address'),
		'username' 	=> $this->input->post('username'),
		'password' 	=> $this->input->post('password')
									);   

		if($this->webservicemodel->check_mob($form_data['mobno'])==TRUE)
		{
			$response['success'] = 0;
			$response['message'] = 'mobile number is exist';
			echo json_encode($response);         
		}
		else
		if($this->webservicemodel->check_username($form_data['username'])==TRUE)
		{
			$response['success'] = 0;
			$response['message'] = 'username is exist';
			echo json_encode($response);         
		}
		else
		{	
		$check_registration=$this->webservicemodel->register($form_data);	
		if($check_registration ==TRUE )
			{


				$response['success'] = 1;
				$response['message'] = 'successfully register';
				$response['form_data'] = $check_registration;
				echo json_encode($response);      		

			}    

				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
					echo json_encode($response);         

				}
		}

	}
			else
			{
				$response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   

}
//end of register//


//start register created by mayuri  18/2/2017
function registerlabour()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$profile_path=$this->upload_profile();
		$form_data = array(
		'fullname' 		=>$this->input->post('fullname'),
		'mobno' 	=> $this->input->post('mobno'),
		'supid' => $this->input->post('supid'),
		'pofilepath'=>"kdsjfkdjs",//$profile_path,
		'address' 	=> $this->input->post('address'),
		'password' 	=> $this->input->post('password')
				);   

		if($this->webservicemodel->check_mob($form_data['mobno'])==TRUE)
		{
			$response['success'] = 0;
			$response['message'] = 'mobile number is exist';
			echo json_encode($response);         
		}
		else
		{		
		$data=$this->webservicemodel->registerlabour($form_data);
		if( $data )
			{


				$response['success'] = 1;
				$response['message'] = 'successfully register';
				$response['registerlabourdata'] = $data;
				
				echo json_encode($response);      		
		
			}    
			else
				{
					$response['success'] = 0;
					$response['message'] = 'Registration fails';
					$response['registerlabourdata'] = $data;
					echo json_encode($response);         

				}
		}

	}
	else
	{
		$response['success'] = 0;
		$response['message'] = 'user not authorised';
		echo json_encode($response);  
	}   

}
//end of register//


//upload profile for register user call in register
	function upload_profile()
		{
				if (isset($_FILES['image']['name'])) 
				{
					$target_path1 = "uploads/sunprofile/";
					$server_ip = base_url();
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/sunprofile/";
					
						$target_path = $target_path . basename($_FILES['image']['name']);	
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
							{	
								$response['success'] = true;
								$response['message'] = 'Could not move the file!';
								return false;
							}
							else
							{
								$response['message'] = 'File uploaded successfully!';					
								$file_path = $file_upload_url . basename($_FILES['image']['name']);
								//$add_images = ($file_path);
								return $file_path;
							}
						}
						catch (Exception $e) 
						{
							$response['success'] = true;
							$response['message'] = $e->getMessage();					
						}
					}
				else
				{			
					$add_images = '';				
				}
				
		}
		//end upload_profile created by dhananjay 20/02/2017

		
		
		//start register created by dhananjay
function thumbpunching()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$form_data = array(
		'userid' 		=>$this->input->post('userid'),
		'intime' 	=> $this->input->post('intime'),
		'outtime' 	=> $this->input->post('outtime'),
		'datetime' 	=> $this->input->post('datetime'),
		'spid' 	=> $this->input->post('spid'),
		'location' =>$this->input->post('location')
		
		);

		if($this->webservicemodel->thumbpunching($form_data)==true)
		{
			$response['success'] = 1;
			$response['message'] = 'Punched Successfully';
			echo json_encode($response);   
		}
		else{
			$response['success'] = 0;
			$response['message'] = 'Sorry, Try Again';
			echo json_encode($response);         
		}

	}
			else
			{
				$response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   

}
//end of register//

		
//start of getLabourList
//created by dhananjay 25/2/2017
function labourlist()
{
	$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)		
			{		
				$spid      = $this->input->post('spid');		
				$form_data=$this->webservicemodel->labourlist($spid);					
				if($form_data)
		       		{
					$response['success'] = 1;
					$response['message'] = 'Labour List';
					$response['labour_form_data'] = $form_data;
			    		echo json_encode($response);         
		      		}
			   	else
				{		
					$response['success'] = 0;
					$response['message'] = 'Labour not found!';
					echo json_encode($response);		
				}
			}
			else
		       	{
				 $response['success'] = 0;
				 $response['message'] = 'user not authorised';
				 echo json_encode($response);  
		       	}
}



/* function labourlist($limit,$offset=0)
{
	$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)		
			{		
				$spid      = array('supid'=>$this->input->post('spid'));		
				$form_data=$this->webservicemodel->labourlist($spid,$limit,$offset);					
				
				$form_data['numOfRows']=$this->webservicemodel->countRows($spid);
				$this->load->library('pagination'); //2
				$this->load->library('table');
				$config=array(
					'base_url'=>base_url().'/labourlist',
					'total_rows'=> $result['numOfRows'],
					'per_page'=>$limit,
					'num_links'=>2
					);                   //3
				$this->pagination->initialize($config);     //4
				$form_data['pagination']=$this->pagination->create_links();  //5
				
				
				if($form_data)
		       		{
					$response['success'] = 1;
					$response['message'] = 'Labour List';
					$response['labour_form_data'] = $form_data;
			    		echo json_encode($response);         
		      		}
			   	else
				{		
					$response['success'] = 0;
					$response['message'] = 'Labour not found!';
					echo json_encode($response);		
				}
			}
			else
		       	{
				 $response['success'] = 0;
				 $response['message'] = 'user not authorised';
				 echo json_encode($response);  
		       	}
} */
		

		
		
		//Start delete_labour created by mayuri  03/02/16
function delete_labour()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$userid       = $this->input->post('userid');		
				//$unique_id   =  $this->input->post('unique_id');								
				$data=$this->webservicemodel->delete_labour($userid);
				if($data)
				   {
					 $response['success'] = 0;
					 $response['message'] = 'Successfully Delete';
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 1;
					 $response['message'] = 'deleting fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 0;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end delete_labour created by mayuri  03/02/16


		//start register created by dhananjay
function salarycalculation()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$form_data = array(
		'userid' 		=>$this->input->post('userid'),
		'fromdate' 	=> $this->input->post('fromdate'),
		'todate' 	=> $this->input->post('todate'),
		'salperday' 	=> $this->input->post('salperday')
		);

		$data=$this->webservicemodel->salarycalculation($form_data);
		$data1=$this->webservicemodel->advancecalculation($form_data);
		if($data)
		{
			$response['success'] = 1;
			$response['message'] = 'feched Successfully';
			$response['form_data_wages'] =$data;
			$response['form_data_advancepay'] =$data1;
			echo json_encode($response);   
		}
		else{
			$response['success'] = 0;
			$response['message'] = 'Sorry, Try Again';
			echo json_encode($response);         
		}

	}
			else
			{
				$response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   

}
//end of register//


//start gettime  created by mayuri  2/3/2017
		 function gettime()
		 {
			// print_r("check");exit;
			 $posttoken=$this->input->post('token');
			 //print_r($posttoken);exit;
			 if($this->webservicemodel->checktoken($posttoken)==TRUE)
			 {
				 // print_r("check");exit;
				 
				 		 	$form_data = array(
		'spid' 		=>$this->input->post('spid')
		);
		//print_r($form_data);exit;
				 $data1=$this->webservicemodel->gettime($form_data);
		 //print_r($data1);exit;
				 
				 if($data1)
				 {
					 					$response['success'] = 1;
								$response['message'] = 'data successfully send';
								$response['form_data'] = $data1;
								echo json_encode($response);      
				 }
				 else{
			$response['success'] = 0;
			$response['message'] = 'Sorry, Try Again';
			echo json_encode($response);         
		}
			 }
			 else{
				 
				 $response['success'] = 0;
				$response['message'] = 'Data not send';
				echo json_encode($response);  
			 }
		 }
 
 
 //create by mayuri
 
 
//start sendextendedtime created by mayuri  3/3/2017
		 function sendextendedtime()
		 {
			// print_r("check");exit;
			 $posttoken=$this->input->post('token');
			 //print_r($posttoken);exit;
			 if($this->webservicemodel->checktoken($posttoken)==TRUE)
			 {
				 // print_r("check");exit;
				 	$spid =$this->input->post('spid');
				 		 	$form_data1 = array(
		'extendedtime' 		=>$this->input->post('extendedtime')
		
		);
		
		$form_data2= array(
		'senderid' 		=>$this->input->post('spid'),
		'message' 		=>$this->input->post('extendedtime'),
		'datetime' 		=>$this->input->post('datetime'),
		'fromtime' 		=>$this->input->post('fromtime'),
		'isread'                =>1
		
		);
		//print_r($form_data2);exit;
				 $data1=$this->webservicemodel->sendextendedtime($form_data1,$form_data2,$spid);
		// print_r($data1);exit;
				 
				 if($data1==true)
				 {
					 					$response['success'] = 1;
								$response['message'] = 'notification dgdfdfbsend';
							
								echo json_encode($response);      
				 }
				 else{
			$response['success'] = 0;
			$response['message'] = 'Notification sending ddfbdfb failed';
			echo json_encode($response);         
		}
			 }
			 else{
				 
				 $response['success'] = 0;
				$response['message'] = 'Notification sending failed';
				echo json_encode($response);  
			 }
		 }
 
 
 //create by mayuri


		
}
?>