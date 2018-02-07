<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Webservicecontroller extends CI_Controller {
	 
		function __construct()
		 {
				  parent::__construct();
		    	  $this->load->library('form_validation');
		    	  $this->load->model('webservicemodel');
		    	  $this->load->model('newmodel');
		    	  $this->load->helper(array('form', 'url'));
		    	  $this->load->library('session');
		    	  $this->load->library('email'); 
		    	  $this->load->helper('cookie'); 
		 }
		 
		 
		 function getName()
		 {
			 //print_r("check");exit;
			 $posttoken=$this->input->post('token');
			 if($this->webservicemodel->checktoken($posttoken)==TRUE)
			 {
				 
				 $data=$this->webservicemodel->getName();
				 if($data==TRUE)
				 {
					 					$response['success'] = 1;
								$response['message'] = 'Full Name';
								$response['form_data'] = $data;
								echo json_encode($response);      
				 }
			 }
			 else{
				 
				 $response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			 }
		 }
		 
		 
		 
		 
 
//start register_to_seller created by sumit  2/02/16
function register_to_seller()
{
			$posttoken = $this->input->post('token');		
			
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
							$timezone = new DateTimeZone("Asia/Kolkata" );
							$date = new DateTime();
							$date->setTimezone($timezone );
							$current_date = $date->format( 'd-m-Y' );
							$Enddate=$date->modify('+30 day');
							$Edate = $Enddate->format( 'd-m-Y' );
							
							$form_data = array(
							'full_name' 						=> $this->input->post('full_name'),
							'app_name' 					=> $this->input->post('app_name'),
							'mob_no' 						=> $this->input->post('mob_no'),
							'address' 						=> $this->input->post('address'),
							'email_id' 						=> $this->input->post('email_id'),
							'city' 								=> $this->input->post('city'),
							'state' 								=> $this->input->post('state'),
							'country' 							=> $this->input->post('country'),
							'role_id' 							=> $this->input->post('role_id'),
							'registration_id'  				=> $this->input->post('registration_id'),
							'is_subscribed'  				=> $this->input->post('is_subscribed'),
							'created_date' 				=> $current_date
														 );   
											
														 
								//print_r($form_data);exit;
						if($this->webservicemodel->check_mob($form_data['mob_no'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'mobile number is exist';
								echo json_encode($response);         
							}
															
							else
								if($this->webservicemodel->checkemail_id($form_data['email_id'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'Email Id is exist';
								echo json_encode($response);         
							}
							else
							{		
									if( $this->webservicemodel->register_to_user($form_data)==TRUE)	
									{		
							
											$user_id =$this->webservicemodel->selectid($form_data);
											foreach($user_id as $user_id)
											{
												$id=$user_id->user_id;  
												
												$date=$user_id->created_date;  
											}
											$cntry= $form_data['country'];
											$country = substr($cntry ,0,2);
											$sta= $form_data['state'];
											$state = substr($sta ,0,3);
											$cty= $form_data['city'];
											$city = substr($cty ,0,3);
											$mob_no= $form_data['mob_no'];
											$re1='IS0'.strrev($id);
											$name= $form_data['full_name'];
											$fname = substr($name ,0,5);
											$re=$fname.'-'.$id;
										//	print_r($re);exit;
											$ran= rand(100000,999999);
											$sort=substr($ran, 6); 
											$message  = urlencode($ran);
											$otp_code = urlencode($ran);
									$abc = array(
											 'login_id'      =>$re,
											 'unique_id'      =>$re1,
											 'password'      =>$otp_code
																);
												
										if($this->webservicemodel->update_login_id($mob_no,$abc)==TRUE)
												{
											$form_subs = array(
												'user_id' 						=> $id,
												'end_date' 						=> $Edate,
												'subscribe_date' 			=> $date
																		);
																	
											$subdata=$this->webservicemodel->register_subscriber($form_subs); 
										/* 	$selectdata =$this->webservicemodel->cateselectdata($id);
												//print_r(func_get_args()); exit;
											//print_r($selectdata);
											$c= 	count($selectdata);
												for($i=0;$i<$c;$i++)
												{
														$insertdata =$this->webservicemodel->insertcet($selectdata[$i]);
												}
											
											//print_r($insertdata);
											 */
											 								//print_r($form_data);exit;
												if($subdata)	
												{		
													$response['success'] = 1;
													$response['message'] = 'Successfully registration';
													$response['form_data'] = $subdata;
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
													$response['message'] = 'Fail register';
													echo json_encode($response);         
												}
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
				$response['fail'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   

}
//End register_to_seller created by sumit  2/02/16
 
//start registration created by sumit  2/02/16
function register_to_user()
{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
					$form_data = array(
							'full_name' 						=> urldecode($this->input->post('full_name')),
							'mob_no' 						=> $this->input->post('mob_no'),
							'email_id' 						=> $this->input->post('email_id'),
							'address' 						=> $this->input->post('address'),
							'unique_id' 						=> $this->input->post('unique_id'),
							'location' 						=> $this->input->post('location'),
							'role_id' 						    => $this->input->post('role_id'),
							'registration_id' 				=> $this->input->post('registration_id'),
							'password' 				=> $this->input->post('password')
													);  
							$unique_id = $this->input->post('unique_id');							
						if($this->webservicemodel->check_mob($form_data['mob_no'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'mobile number is exist';
								echo json_encode($response);         
							}
							else
								if($this->webservicemodel->checkemail_id($form_data['email_id'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'Email Id is exist';
								echo json_encode($response);         
							}
							else
							{		
									if( $this->webservicemodel->register_to_user($form_data)==TRUE)	
									{		
											$user_id =$this->webservicemodel->selectid($form_data);
											foreach($user_id as $user_id)
											{
												$id=$user_id->user_id;  
											}
											$adrss= $form_data['address'];
											$address = substr($adrss ,0,2);
											$locat= $form_data['location'];
											$location = substr($locat ,0,2);
											$mob_no= $form_data['mob_no'];
											$re=$address.'-'.$location.'-'.$id;
											$ran= rand(100000,999999);
											$sort=substr($ran, 6); 
											$message  = urlencode($ran);
											//$otp_code = urlencode($ran);
										$abc = array(
											 'login_id'      =>$re,
											 'password'      =>$this->input->post('password')
																);
									
										if($this->webservicemodel->update_login_id($mob_no,$abc)==TRUE)
												{
											$selectseller = $this->newmodel->select_sellerid($unique_id);
												foreach($selectseller as $loginid)
														{
															$registration_id[] = $loginid->registration_id;	
														}  
												
										$message = array('message' => "Your Under One User Created");    
											
								//print_r($registration_id);exit;
									if($this->notify($registration_id,$message)==true) 
												{
													$response['success'] = 1;
													$response['message'] = 'successfully register';
													echo json_encode($response);         
												}
												else
												{
													$response['success'] = 0;
													$response['message'] = 'Fail register';
													echo json_encode($response);         
												}

										
									}
												
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
				$response['fail'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   

}
//End registration created by sumit  2/02/16

//start check otp created by sumit 10.12.15
function login()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
			$data = array(
					'email_id'              => $this->input->post('email_id'),
					'password'           => $this->input->post('password')
					  );  		
					  
					  $registration_id = array(
					'registration_id'              => $this->input->post('registration_id')
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
//start check otp created by sumit 10.12.15
function subscriber_update_to_seller()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
			$user_id = $this->input->post('user_id');		
			//$name = $this->input->post('name');	
				$datadate = $this->input->post('date');	
				$timezone = new DateTimeZone("Asia/Kolkata" );
				$date = new DateTime();
				$date->setTimezone($timezone );
				$current_date= $date->format( 'd-m-Y' );
				
				$Enddate=$date->modify('+30 day');
				$Edate = $Enddate->format( 'd-m-Y' );
				
							
				$form_data = array(
							'subscribe_date' 	=> $current_date,
							'user_id' 				    => $this->input->post('user_id'),
							'end_date' 				=> $Edate,
							'is_request' 				=> 1
							
												);  
								
			$data=$this->webservicemodel->subscriber_update_to_seller($form_data,$user_id);
			if($data)	
				{		
				$response['success'] = 1;
				$response['message'] = 'Successfully Subscribtion';
				$response['form_data'] = $data;
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
//strart recent otp  created by sumit 12/12/15
	function forgot_password()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
					$mob_no= $this->input->post('mob_no');
					$ran= rand(100000,999999);
					//$sort=substr($ran, 10); 
					$username = urlencode("kailashc");
					$password = urlencode("dCUDfNDPXPbVQR");
					$api_id   = urlencode("3565960");
					$to       = urlencode($mob_no);
					$message  = urlencode($ran);
					$otp_code = urlencode($ran);
					
						$form_data =array(
						'mob_no'    =>$mob_no,
						'password'  =>$otp_code								
							);
					file_get_contents("https://api.clickatell.com/http/sendmsg"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
					if($this->webservicemodel->update_forgot_password($form_data)==TRUE)
					{
						$response['success'] = 1;
						$response['message'] = 'Successfully Forgot Password';
						echo json_encode($response);         
					}	
					else
					{
						$response['success'] = 0;
						$response['message'] = 'Fails';
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
	//strart recent otp  created by sumit 12/12/15

	
	function display_product_list()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{	
	
			 $data =$this->webservicemodel->display_product_list();
			if($data)
				{
					$response['success'] = 1;
					$response['message'] = 'Successfully Dispaly List';
					$response['form_data'] = $data;
					echo json_encode($response);         
				}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
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


//start seller_view_user_list by created by sumit  03/02/16
function seller_view_user_list()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
			 $login_id =$this->input->post('login_id');	
			 $unique_id =$this->input->post('unique_id');	
			 $role_id =$this->input->post('role_id');	
			if($role_id==3)
			{
				$data =$this->webservicemodel->employee_view_user_list($unique_id);
			}
			else{
			 $data =$this->webservicemodel->seller_view_user_list($unique_id);
			}
			if($data)
				{
					$response['success'] = 1;
					$response['message'] = 'Successfully Selected Data';
					$response['form_data'] = $data;
					echo json_encode($response);         
				}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
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
//End seller_view_user_list by created by sumit  03/02/16



//Start user_delete_to_seller created by sumit  03/02/16
function user_delete_to_seller()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$user_id       = $this->input->post('user_id');		
				//$unique_id   =  $this->input->post('unique_id');					
				$delete['is_deleted']   =1;				
				$data=$this->webservicemodel->user_delete_to_seller($user_id,$delete);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Delete';
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'booking fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}

//end user_delete_to_seller created by sumit  03/02/16

// 


 created by sumit 03/02/16
// add_veg_category created by sumit 03/02/16

//start seller_veg_list by  created by sumit   03/02/16
function seller_veg_list()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
				$user_id =$this->input->post('user_id');	
				
				
				$data =$this->webservicemodel->seller_veg_list($user_id);
				if($data)
					{
					$response['success'] = 1;
					$response['message'] = 'Seller view List';
					$response['form_data'] = $data;
						echo json_encode($response);         
					}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
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
//start seller_veg_list by  created by sumit   03/02/16

//start update_price_to_category by sumit   03/02/16
function update_price_to_category()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
				$user_id =$this->input->post('user_id');	
				$category_id =$this->input->post('category_id');	
				$form_data = array(
				'price'             => $this->input->post('price')
						);   
				
				$data =$this->webservicemodel->update_price_to_category($user_id,$category_id,$form_data);
				if($data)
					{
						$response['success'] = 1;
						$response['message'] = 'Successfully Update Data';
						echo json_encode($response);         
					}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
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
//start update_price_to_category by  created by sumit   03/02/16

function oldupdate_item_select()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
			
					$cateid = $this->input->post('category_id');	                                             
								$catid= explode(",", $cateid);		
						
						$price = $this->input->post('price');	                                             
								$prce= explode(",", $price);
						
						$name = $this->input->post('name');	                                             
								$nme= explode(",", $name);
								
						$count = count($catid);

					for($i=0;$i<$count;$i++)
					{
						$form_data = array(
							'category_id'   => $catid[$i],
							'user_id'   => $this->input->post('user_id'),                                 
							'price'   => $prce[$i],                                 
							'name'   => $nme[$i],                                 
											); 
		

			$data=$this->webservicemodel->selectselleritem($form_data);
					}
			if($data)	
				{		
					$response['success'] = 1;
					$response['message'] = 'Successfully Select';
					$response['form_data'] = $data;
					echo json_encode($response);         
				 }
				else
				{		
					$response['success'] = 0;
					$response['message'] = 'fail';
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

//start login created by sumit created by sumit  6/02/16
function update_item_select()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
			
				$category_id =$this->input->post('category_id');
				$user_id =$this->input->post('user_id');
	
				$form_data = array(
				'is_selected'             =>1
						);   
			
			$data=$this->webservicemodel->check_box_updated($user_id,$form_data,$category_id);
			if($data)	
				{		
					$response['success'] = 1;
					$response['message'] = 'Successfully Select';
					$response['form_data'] = $data;
					echo json_encode($response);         
				 }
				else
				{		
					$response['success'] = 0;
					$response['message'] = 'fail';
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
		
		
	function delete_item()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
				$category_id =$this->input->post('category_id');
				$user_id =$this->input->post('user_id');
			$data=$this->webservicemodel->delete_item($user_id,$category_id);
			if($data)	
				{		
					$response['success'] = 1;
					$response['message'] = 'Successfully Delete';
					//$response['form_data'] = $data;
					echo json_encode($response);         
				 }
				else
				{		
					$response['success'] = 0;
					$response['message'] = 'fail';
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
//start  login created by sumit created by sumit  6/02/16

/* //start check box updated by sumit   03/02/16
function check_box_updated()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{		
				$category_id =$this->input->post('category_id');
				$form_data = array(
				'is_selected'             =>1
													);   
				$data =$this->webservicemodel->check_box_updated($form_data,$category_id);
				if($data)
					{
						$response['success'] = 1;
						$response['message'] = 'Successfully Update Data';
						echo json_encode($response);         
					}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
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
//start check box updated by  created by sumit   03/02/16 */

//Start delete_category_to_seller created by sumit  03/02/16
function delete_category_to_seller()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$user_id       = $this->input->post('user_id');		
				$category_id   = $this->input->post('category_id');					
				$data=$this->webservicemodel->delete_category_to_seller($user_id,$category_id);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Delete';
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'booking fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end delete_category_to_seller created by sumit  03/02/16

//Start view_orderlist_item_seller created by sumit  03/02/16
function view_orderlist_item_seller()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$login_id       = $this->input->post('login_id');		
				$data=$this->webservicemodel->view_orderlist_item_seller($login_id);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully select';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end view_orderlist_item_seller created by sumit  03/02/16

//Start view_orderlist_item_seller created by sumit  03/02/16
function view_todays_item_seller()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$user_id       = $this->input->post('user_id');		
				$data=$this->webservicemodel->view_todays_item_seller($user_id);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully select';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end view_orderlist_item_seller created by sumit  03/02/16


//Start view_orderlist_item_seller created by sumit  03/02/16
function view_todays_item_user()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				
				$ads_category_id       = $this->input->post('ads_category_id');
				
				$data=$this->webservicemodel->view_todays_item_user($ads_category_id);	
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully select';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end view_orderlist_item_seller created by sumit  03/02/16



//Start view_orderlist_item_seller created by mayuri 14/12/16
function search_todays_item_user()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				
				//$ads_category_id       = $this->input->post('ads_category_id');
				
				$data=$this->webservicemodel->search_todays_item_user();
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully select';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end view_orderlist_item_seller created by sumit  03/02/16




//Start Booking_To_Item Created By Sumit 03/02/16
function user_booking_item()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			
				 $user_id = $this->input->post('user_id');		
				 $login_id = $this->input->post('login_id');	
				 $desc_order = $this->webservicemodel->desc_order(); 
				 foreach($desc_order as $order)
				 {
					 	$ids =$order->order_id;
						
				 }
				 $a= $ids+1;
				 $newOrderId = "MS0".$a;
				$form_data = array(
				'user_id'           => $this->input->post('user_id'),
				'total_amount'   => $this->input->post('total_amount'),	
				'order_date'     => $this->input->post('order_date'),
				'login_id'     => $this->input->post('login_id'),
				'myorder_id'     => $newOrderId
										);
				if($this->webservicemodel->booking_all_amount($form_data))
				   {
								 $data=$this->webservicemodel->select_orders_id($user_id);
								foreach($data as $data)
								{
									$o_id =$data->order_id;
								}
								$order_id  = $o_id;
								
								 $cat_id = $this->input->post('category_id');	
								 $catid= explode(",", $cat_id);		
								 $total_price = $this->input->post('total_price');	                                             
								 $tprice= explode(",", $total_price);		
					
						$count = count($catid);
					for($i=0;$i<$count;$i++)
					{
						$data = array(
							'order_id'        => $order_id,
							'category_id'   => $catid[$i], 
							'total_price'         => $tprice[$i]
											); 
						$alldata=$this->webservicemodel->booking_to_item($data);	
				} 
						$wqwq=$this->newmodel->select_regid($login_id);
					
													foreach($wqwq as $regid)
													{
														$registration_id[] = $regid->registration_id;	
													}  
											$message = array('message' => "You Have Order");    
				//print_r($registration_id);exit;
					if($this->notify($registration_id,$message)==true)  		
							//	if($alldata)
								{
								 $response['success'] = 1;
								 $response['message'] = 'Successfully Save';
								 $response['form_data'] = $alldata ;
								 echo json_encode($response);
							   }
							else
							   {
								   $response['success'] = 0;
								 $response['message'] = 'fail';					  
								 echo json_encode($response);
							   }
					}  
		}
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//End Booking_To_Item Created By Sumit 03/02/16

//Start user_list_of_all_item created by sumit  04/02/16
function user_list_of_all_item()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$login_id       = $this->input->post('login_id');		
				$data=$this->webservicemodel->user_list_of_all_item($login_id);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Selected';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}
//end user_list_of_all_item created by sumit  04/02/16


//Start details_of_user_place_order created by sumit  04/02/16
function details_of_user_place_order()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
		
				$order_id       = $this->input->post('order_id');		
					
				$data=$this->webservicemodel->details_of_user_place_order($order_id);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Delete';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
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
//end details_of_user_place_order created by sumit  04/02/16

//Start user_cancel_book_item created by sumit  09/02/16
function user_cancel_book_item()
{
       $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$category_id       = $this->input->post('category_id');		
				$order_id       = $this->input->post('order_id');		
				$data=$this->webservicemodel->user_cancel_book_item($category_id,$order_id );
				$selectamount=$this->webservicemodel->selectamount($category_id,$order_id);
				foreach($selectamount as $selectamount)
				{
					$amnt= $selectamount->total_price;
				}
				
			$Amount = array(
						'total_amount'           => $amnt
										);	
				$AmountUp=$this->webservicemodel->UpdateAmount($order_id,$Amount);
				if($AmountUp)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Deleted';
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
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
//end user_cancel_book_item created by sumit  09/02/16

//Start update_quantity for booking item created by sumit  29.03.2016
function update_quantity()
{
       $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$order_id      		 = $this->input->post('order_id');		
				$category_id	       = $this->input->post('category_id');		
				
				$form_data = array(
				'quantity'           => $this->input->post('quantity')
										);
						
				$data=$this->webservicemodel->update_quantity($form_data,$order_id,$category_id );
				
				$price=$this->webservicemodel->SelectPriceID($order_id,$category_id);
				$categoryid=$this->webservicemodel->SElectcategoryid($category_id );
	
				foreach($categoryid as $categoryid)
					{
						$ct=$categoryid->price;
					}
				
					foreach($price as $price)
					{
						$rs=$price->quantity;
					}		
							$se = array(
						'total_price'           => $rs*$ct
										);		
					
					$upprice=$this->webservicemodel->updatePriceID($order_id,$se,$category_id );
					$totalamount=$this->webservicemodel->SelectAllCat($order_id );		
				$Total=0;
							foreach($totalamount as $totalamount)
					{
						$Total=$Total+$totalamount->total_price;
						
					}	
					
					$Amount = array(
						'total_amount'           => $Total
										);		
						$AmountUp=$this->webservicemodel->UpdateAmount($order_id,$Amount);
				if($AmountUp)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'change Your Quantity';
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
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
//end update_quantity for booking item created by sumit  29.03.2016

function view_orderlist_item_buyer()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$user_id       = $this->input->post('user_id');		
				$data=$this->webservicemodel->user_list_of_all_item1($user_id);
				if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Selected';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}


function subscriber_data()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
				$user_id       = $this->input->post('user_id');		
				$data=$this->webservicemodel->subscriber_data($user_id);
				 			 
				if($data)
				   {
			 					
					 $response['success'] = 1;
					 $response['message'] = 'Successfully Subscribe';
					 $response['form_data'] = $data;
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
					 echo json_encode($response);
				   }
		}  
			else
			{		
				 $response['fail'] = 1;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}



function update_address()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
			$data = array(
					'address'              => $this->input->post('address'),
					'mob_no'           => $this->input->post('mob_no'),
					'email_id'           => $this->input->post('email_id'),
					'full_name'           => $this->input->post('full_name')
					  );  		

       $user_id = $this->input->post('user_id');	

			$check_login=$this->webservicemodel->update_address($data,$user_id);

			if($check_login)	

				{		

				$response['success'] = 1;

				$response['message'] = 'Change Successfully';

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

		
		//created by pooja //
		
	function seller_registration()
{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				
							$form_data = array(
							'full_name' 					=> $this->input->post('full_name'),
							'mob_no' 						=> $this->input->post('mob_no'),
							'email_id' 						=> $this->input->post('email_id'),
							'city' 								=> $this->input->post('city'),
							'state' 							=> $this->input->post('state'),
							'country' 						=> $this->input->post('country'),
							'role_id' 						=> $this->input->post('role_id'),
							'registration_id'  			=> $this->input->post('registration_id'),
							'is_subscribed'  				=> $this->input->post('is_subscribed'),
														);   
								
						if($this->webservicemodel->check_mob($form_data['mob_no'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'mobile number is exist';
								echo json_encode($response);         
							}
							else
								if($this->webservicemodel->checkemail_id($form_data['email_id'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'Email Id is exist';
								echo json_encode($response);         
							}
							else
							{		
									if( $this->webservicemodel->seller_registration($form_data)==TRUE)	
									{		
											$user_id =$this->webservicemodel->selectid($form_data);
											foreach($user_id as $user_id)
											{
												$id=$user_id->user_id;  
											}
											$cntry= $form_data['country'];
											$country = substr($cntry ,0,2);
											$sta= $form_data['state'];
											$state = substr($sta ,0,3);
											$cty= $form_data['city'];
											$city = substr($cty ,0,3);
											$mob_no= $form_data['mob_no'];
											$re1=$country.'-'.$state.'-'.$city.'-'.$id;
											$re=$country.'-'.$state.'-'.$id;
											$ran= rand(100000,999999);
											$sort=substr($ran, 6); 
											$message  = urlencode($ran);
											$otp_code = urlencode($ran);
									$abc = array(
											 'login_id'      =>$re,
											 'unique_id'      =>$re1,
											 'password'      =>$otp_code
																);
												
										if($this->webservicemodel->update_login_id($mob_no,$abc)==TRUE)
												{
													$response['success'] = 1;
													$response['message'] = 'successfully register';
													echo json_encode($response);         
												}
												else
												{
													$response['success'] = 0;
													$response['message'] = 'Fail register';
													echo json_encode($response);         
												}
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
				$response['fail'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   

}

//created by pooja//
//start//

function update_order_status()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			$data = array(
					'order_id'              => $this->input->post('order_id'),
					'is_deleted'           =>  $this->input->post('status'),
					'reason'           =>  $this->input->post('reason')
					  );  						
					 $role_id = $this->input->post('role_id');		
				if($this->webservicemodel->update_order_status($data)==true)
				{
					if($role_id==1)
					{
						$selorderid = $this->newmodel->select_logid($data);
								foreach($selorderid as $userid)
										{
											$user_id= $userid->user_id;	
										}  
								$wqwq=$this->newmodel->selectregid($user_id,$data['order_id']);
									
										foreach($wqwq as $regid)
										{
											$registration_id[] = $regid->registration_id;	
										}  
										if($data['is_deleted']==3)
											{
													$message = array('message' => "Your Order Is Cancelled");    
											}
										else
											if($data['is_deleted']==2)
											{
													$message = array('message' => "Your Order Is Delivered");    
											}
											else
												if($data['is_deleted']==4)
											{
													$message = array('message' => "Your Order In Process");    
											}
									if($this->notify($registration_id,$message)==true) 
								   {
									 $response['success'] = 1;
									 $response['message'] = 'Successfully Delete';
									 $response['form_data'] = $data;
									 echo json_encode($response);
								   }
								else
								   {
									   $response['success'] = 0;
									 $response['message'] = 'fail';					  
									 echo json_encode($response);
								   }
					}
					else
					{
								$selorderid = $this->newmodel->selectlogin($data);
								foreach($selorderid as $loginid)
										{
											$login_id= $loginid->login_id;	
										}  
								$wqwq=$this->newmodel->select_regid($login_id);
									
										foreach($wqwq as $regid)
										{
											$registration_id[] = $regid->registration_id;	
										}  
										$message = array('message' => "Your Order Is Cancelled");    
											
								//print_r($registration_id);exit;
									if($this->notify($registration_id,$message)==true) 
								//if($data)
								   {
									 $response['success'] = 1;
									 $response['message'] = 'Successfully Delete';
									 $response['form_data'] = $data;
									 echo json_encode($response);
								   }
								else
								   {
									   $response['success'] = 0;
									 $response['message'] = 'fail';					  
									 echo json_encode($response);
								   }
					}
				}  
		}
			else
			{		
				 $response['fail'] = 0;
				 $response['message'] = 'user not authorised';
					 echo json_encode($response);  
			}
}


function report()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			$to_date = $this->input->post('to_date');
			$date= explode('/', $to_date);
			$a = $date[0]+1;
			$next_date = $a."/".$date[1]."/".$date[2];
			
			$data = array(
					'to_date'           =>  $next_date,
					'from_date'      =>  $this->input->post('from_date'),
					'user_id'           =>  $this->input->post('user_id'),
					
					  );  						
					
				$data=$this->webservicemodel->report($data);
				if($data)
				   {
					   $sum = 0;
					   $sum1= 0;
					   $sum2= 0;
					   $pending=0;
					   foreach($data as $data)
					   {
						   if($data->is_deleted==1)
						   {
							   $pending= $sum+=$data->total_amount;
						   }
						   else
							   if($data->is_deleted==2)
						   {
							   $delivered= $sum1+=$data->total_amount;  
						   }
						   elseif($data->is_deleted==3)
						   {
							   $cancelled= $sum2+=$data->total_amount;
						   }  
					   }
					   
					   if( $pending==null)
					   {
						   $pending=0;
					   }
					   if( $delivered==null)
					   {
						    $delivered=0;
					   }
					  if($cancelled==null)
					   {
						   $cancelled=0;
					   }
					   $data = array(
					'pending'           =>  $pending,
					'delivered'           =>  $delivered,
					'cancelled'           => $cancelled,
				
					  );  			
					//   print_r($data);exit;
					 $response['success'] = 1;
					 $response['message'] = 'Report';
					 $response['form_data'] = $data;
					 
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'fail';					  
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



function offer_list()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
			 $login_id =$this->input->post('login_id');	
			 $unique_id =$this->input->post('unique_id');	
			 $role_id =$this->input->post('role_id');	
			if($role_id==3)
			{
				$data =$this->webservicemodel->offer_list($unique_id);
			}
			else{
			 $data =$this->webservicemodel->offer_list($unique_id);
			}
			if($data)
				{
					$response['success'] = 1;
					$response['message'] = 'Successfully Selected Data';
					$response['form_data'] = $data;
					echo json_encode($response);         
				}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
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
//stop//


//start notify create function sumit 25.5.16
function notify($registration_id,$message)   
{
		
			 $url = 'https://gcm-http.googleapis.com/gcm/send';
			$message1 = array('message'=> $this->input->post('message'));
			
			$registration_id1 = $this->input->post('registration_id');
			
			 $fields = array(
             'registration_ids'         => $registration_id,
             'data'                  		=>$message
								); 
				 $headers = array(
				'Authorization: key=AIzaSyCMjsrNwdvq3mtmHF5K2K8LiCMuRnfiLh8', //mysell
				 'Content-Type: application/json'
									);
				$ch = curl_init();

				 curl_setopt($ch, CURLOPT_URL, $url);
				
				 curl_setopt($ch, CURLOPT_POST, true);
				 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        
				 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   
				 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
				curl_setopt($ch, CURLOPT_PORT, 443);
				$result = curl_exec($ch);
				//print_r($headers);exit;
				
			 if ($result === FALSE) 
			 {
				die('Curl failed: ' . curl_error($ch));
			 }
			 else
			 {
					curl_close($ch);	
				return true;
			//print_r($result);exit;
			 }
}
//End notify create function sumit 25.5.16

function update_veg_category()
{
    $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
					$target_path1 = "uploads/mysell/";
					$server_ip = base_url();	
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/mysell/";
							
					if (isset($_FILES['image']['name'])) 
				{
						$target_path = $target_path . basename($_FILES['image']['name']);
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
							{		
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else{
							$response['message'] = 'File uploaded successfully!';						
							$file_path = $file_upload_url . basename($_FILES['image']['name']);
						
						}
						} catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
				}
				 else
				{
				$user_id = $this->input->post('user_id');
				$image_path = $this->webservicemodel->file_path($user_id);
				if($image_path)
				{
					foreach($image_path as $data)
						{
						$file_path = $data->image_path;						
						}				
					
					 
				}else
				{
					$response['success']    = 0;
					$response['message']    = 'image path not found of given user id.';
					echo json_encode($response);  
				}	
				}
					
			$form_data = array(
				'price'            	 		=> $this->input->post('price'), 
				'name'            	 		=> $this->input->post('name'),
				'unit'            			    => $this->input->post('unit'), 				
				'user_id'            	    => $this->input->post('user_id'), 
				'offerpercent'          => $this->input->post('offerpercent'), 
				'offerprice'              => $this->input->post('offerprice'), 
				'originalprice'           => $this->input->post('originalprice'), 
				'startdate'            	 => $this->input->post('startdate'), 
				'enddate'            	 => $this->input->post('enddate'), 
				'category_id'            	 => $this->input->post('category_id'), 
				'image_path'       => $file_path 
											);   
				
			$data=$this->webservicemodel->update_veg_category($form_data);
			if($data)
				   {
					 $response['success'] = 1;
					 $response['message'] = 'Successfully update';
					 echo json_encode($response);
				   }
		   	  	else
				   {
					   $response['success'] = 0;
					 $response['message'] = 'updatation fail';					  
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
	
	

	function update_password()
	{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$data = array(
						'password'              => $this->input->post('password')
									);  
			
						$user_id = $this->input->post('user_id');	
						$conpassword = $this->input->post('conpassword');	
						
				$check_login=$this->webservicemodel->update_password($data,$user_id,$conpassword);
				if($check_login)	
					{		
					$response['success'] = 1;
					$response['message'] = 'Update Successfully';
					$response['form_data'] = $check_login;
					echo json_encode($response);         
					 }
				else
					{		
						$response['success'] = 0;
						$response['message'] = 'Old password Is Incorrect';
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
	
	
	
		 function select_category()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		
		$form_data = $this->webservicemodel->select_category();
			if($form_data)
			
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							$response['form_data'] = $form_data;
							echo json_encode($response);
				}
				else{
							$response['success'] = 0;
							$response['message'] = 'fail';
							$response['data'] = $form_data;
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
	
	
	function select_sub_category()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$ads_category_id   = $this->input->post('ads_category_id');		
		$form_data = $this->webservicemodel->select_sub_category($ads_category_id);
			if($form_data)
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							$response['form_data'] = $form_data;
							echo json_encode($response);
				}
				else{
							$response['success'] = 0;
							$response['message'] = 'fail';
							$response['data'] = $form_data;
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
	
	
	
	function add_veg_category()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$target_path1 = "uploads/mysell/";
					$server_ip = base_url();	
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/mysell/";
							
					if (isset($_FILES['image']['name'])) 
				{ 
						$target_path = $target_path . basename($_FILES['image']['name']);
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
							{		
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else{
							$response['message'] = 'File uploaded successfully!';						
							$file_path = $file_upload_url . basename($_FILES['image']['name']);
						
						}
						} catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
				}
				$form_data = array(
				'ads_category_id'                 => $this->input->post('ads_category_id'),
				'ads_sub_category_id'        => $this->input->post('ads_sub_category_id'),
				'price'            	                       => $this->input->post('price'), 
				'name'            							 => $this->input->post('name'),
				'unit'            	 							=> $this->input->post('unit'), 				
				'user_id'            						 => $this->input->post('user_id'), 
				'offerpercent'            	 			=> $this->input->post('offerpercent'), 
				'offerprice'            					 => $this->input->post('offerprice'), 
				'originalprice'            				 => $this->input->post('originalprice'), 
				'startdate'            					 => $this->input->post('startdate'), 
				'enddate'            						 => $this->input->post('enddate'), 
				'stock'            						 => $this->input->post('stock'), 
				'image_path'      						 => $file_path 
											);  			
		if($this->webservicemodel->new_add_veg_category($form_data))
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							echo json_encode($response);
				}
				else
				{
							$response['success'] = 0;
							$response['message'] = 'fail';
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
	
	function edit_item()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		/* $target_path1 = "uploads/mysell/";
					$server_ip = base_url();	
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/mysell/";
							
					if (isset($_FILES['image']['name'])) 
				{
						$target_path = $target_path . basename($_FILES['image']['name']);
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
							{		
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else{
							$response['message'] = 'File uploaded successfully!';						
							$file_path = $file_upload_url . basename($_FILES['image']['name']);
						
						}
						} catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
				} */
				$form_data = array(
				//'ads_category_id'                 => $this->input->post('ads_category_id'),
				//'ads_sub_category_id'        => $this->input->post('ads_sub_category_id'),
				'category_id'            	                       => $this->input->post('category_id'), 
				'price'            	                       => $this->input->post('price'), 
				'name'            							 => $this->input->post('name'),
				'unit'            	 							=> $this->input->post('unit'), 				
				'user_id'            						 => $this->input->post('user_id'), 
				'offerpercent'            	 			=> $this->input->post('offerpercent'), 
				'offerprice'            					 => $this->input->post('offerprice'), 
				'originalprice'            				 => $this->input->post('originalprice'), 
				'startdate'            					 => $this->input->post('startdate'), 
				'enddate'            						 => $this->input->post('enddate'), 
				'stock'            						 => $this->input->post('stock')
			//	'image_path'      						 => $file_path 
											);  			
		if($this->webservicemodel->update_stock($form_data))
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							echo json_encode($response);
				}
				else
				{
							$response['success'] = 0;
							$response['message'] = 'fail';
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
	
	

		//created by Dhananjay//
//start//

function update_stock()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			$data = array(
					'category_id'              => $this->input->post('category_id'),
					'stock'  =>  $this->input->post('stock')
					  );  			
			//	print_r($data);exit;					  
				
				if($this->webservicemodel->update_stock($data)==true)
				{
					
									 $response['success'] = 1;
									 $response['message'] = 'Successfully Delete';
									 $response['form_data'] = $data;
									 echo json_encode($response);
				}
			else
			   {
									 $response['success'] = 0;
									 $response['message'] = 'fail';					  
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

	
	
	function add_main_category()
{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
					$form_data = array(
							'category_name' 						=> $this->input->post('category_name'),
							'category_image_path' 						=> 'http://192.168.1.6/seller/uploads/advertiesment/book.png',
								'login_id' 						=> $this->input->post('login_id')
													);  
					//	print_r($form_data); exit;
						if($this->webservicemodel->check_main_cat($form_data['category_name'],$form_data['login_id'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'category is exits';
								echo json_encode($response);         
							}
	else{
									if( $this->webservicemodel->add_main_category($form_data)==TRUE)	
									{		
										$response['success'] = 1;
										$response['message'] = 'successfully register';
										echo json_encode($response);         
									}
									else
									{
										$response['success'] = 0;
										$response['message'] = 'Fail register';
										echo json_encode($response);         
									}
	}
			}
			else
			{
				$response['fail'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   
}


function add_feedback()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		
				
				$form_data = array(
				
				'comment'      => $this->input->post('comment'), 				
				'user_id'      => $this->input->post('user_id'), 
				'rating'       => $this->input->post('rating')
											);  			
		if($this->webservicemodel->add_feedback($form_data))
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							echo json_encode($response);
				}
				else
				{
							$response['success'] = 0;
							$response['message'] = 'fail';
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



//created by hrushi add_sub_category
function add_sub_category()
{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
					$form_data = array(
							'ads_category_id' 					=> $this->input->post('ads_category_id'),
							'ads_sub_category_name' 		=> $this->input->post('ads_sub_category_name'),
								'ads_sub_category_image_path' 						=> 'http://192.168.1.6/seller/uploads/advertiesment/book.png'
													);  
					
						if($this->webservicemodel->check_sub_cat($form_data['ads_category_id'] , $form_data['ads_sub_category_name'])==TRUE)
							{
								$response['success'] = 0;
								$response['message'] = 'category is exits';
								echo json_encode($response);         
							}
	else{
									if( $this->webservicemodel->add_sub_category($form_data)==TRUE)	
									{		
										$response['success'] = 1;
										$response['message'] = 'successfully register';
										echo json_encode($response);         
									}
									else
									{
										$response['success'] = 0;
										$response['message'] = 'Fail register';
										echo json_encode($response);         
									}
	}
			}
			else
			{
				$response['fail'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}   
}

	}

?>