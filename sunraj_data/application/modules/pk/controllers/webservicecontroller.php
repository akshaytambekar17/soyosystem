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
 
//start register created by sumit
function register()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$form_data = array(
		'name' 		=>$this->input->post('name'),
		'mob_no' 	=> $this->input->post('mob_no'),
		'email' 	=> $this->input->post('email'),
		'city' 	=> $this->input->post('city')
									);   

		if($this->webservicemodel->check_mob($form_data['mob_no'])==TRUE)
		{
			$response['success'] = 0;
			$response['message'] = 'mobile number is exist';
			echo json_encode($response);         
		}
		else
		if($this->webservicemodel->check_email($form_data['email'])==TRUE)
		{
			$response['success'] = 0;
			$response['message'] = 'email is exist';
			echo json_encode($response);         
		}
		else
		{		
		if( $this->webservicemodel->register($form_data)==TRUE )
			{  
			$mob_no= $form_data['mob_no'];
			$ran= rand(100000,999999);
			$sort=substr($ran, 10); 
			$username = urlencode("kailashc");
			$password = urlencode("dCUDfNDPXPbVQR");
			$api_id   = urlencode("3565960");
			$to       = urlencode($mob_no);
			$message  = urlencode($ran);
			$otp_code = 123456; 
			
			$abc=array(
			'otp_code'  =>$otp_code								
				);
			  //file_get_contents("https://api.clickatell.com/http/sendmsg"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
			if($this->webservicemodel->update_mob_no($mob_no,$abc)==TRUE)
			{
				$response['success'] = 1;
				$response['message'] = 'successfully register';
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
//end of register//

		//start add post created by yogita
		//Add post to display in timeline like facebook
		function add_post()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
	    		{				
				if (isset($_FILES['image']['name'])) 
				{
					$target_path1 = "uploads/post/";
					$server_ip = base_url();
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/post/";
					$count = $this->input->post("no_of_files");
					for($i=0;$i<$count;$i++)
					{
						$path = $target_path . basename($_FILES['image']['name'][$i]);			
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $path)) 
							{		
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else
							{
								$response['message'] = 'File uploaded successfully!';			
								$file_path[$i] = $file_upload_url . basename($_FILES['image']['name'][$i]);
								$post_images =  json_encode($file_path);				
							}
						}
						catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
					}
				}else
				{				
					$post_images = '';				
				}
				$form_data = array(
					'user_id'           => $this->input->post('user_id'), 
					'post_content'      => urldecode($this->input->post('post_content')),
					'page_id'           => $this->input->post('page_id'),
					'post_gallery_path' => $post_images
											);  //print_r($form_data);
					$user_id = $this->input->post('user_id');
				if($this->webservicemodel->post($form_data)==True)
				{	
					if($this->webservicemodel->selectfriend($form_data)==True)
						{ 
					$user_name=$this->webservicemodel->select_name_user($user_id);
						
					foreach($user_name as $user_name)
									{
									    $user=$user_name->name; 
									}
					$data =$this->webservicemodel->view_post_notify_all_friend($form_data);
							//print_r($data);exit;	
									foreach($data as $regid)
									{
										$registration_id[] = $regid->registration_id;	
									}  
											
							$message = array('message' => $user." Added Post");    
						//print_r($registration_id);		  
						if($this->notify($registration_id,$message)==true)  		
								{
								$response['success'] = 1;
								$response['message'] = 'successfully post';
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
							$response['success'] = 1;
							$response['message'] = 'successfully post';
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
//end add post

 //start send_friend_request created by sumit 8.10.2015
	function send_friend_request()
	{
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				 $form_data = array(
			   	 'user_id'                           =>$this->input->post('user_id'), 
			   	 'added_friend_id'				=>$this->input->post('added_friend_id'),
			   	 'is_accepted'		         	=>$this->input->post('is_accepted')
				 
					    );  
			if($this->webservicemodel->check_friend_request($form_data)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'already friend.';
					echo json_encode($response);  	
				}
			else
					
						if($this->webservicemodel->select_reject_delete($form_data)==true)
					{
						if($this->webservicemodel->send_friend_request($form_data));
						{
							$data=$this->webservicemodel->select_name_for_user($form_data);
								   
									foreach($data as $regid)
									{
									    $name=$regid->name; 
									}
							
							$data=$this->webservicemodel->select_registration_id_to_added_friend($form_data);
								
									foreach($data as $regid)
									{
										$registration_id[] = $regid->registration_id;	
									}
										$message = array('message' => "You Have Request From ".$name );    
									
									if($this->notify($registration_id,$message)==true)  
										{
										$response['success'] = 1;
										$response['message'] = 'successfully sent friend request.';
										echo json_encode($response);  
									}
						
									else
									{
										$response['success'] = 0;
										$response['message'] = 'fails';
										echo json_encode($response);   
									}
						}
					}else
						if($this->webservicemodel->send_friend_request($form_data));
						{
							$data=$this->webservicemodel->select_name_for_user($form_data);
								   
									foreach($data as $regid)
									{
									    $name=$regid->name; 
									}
							
							$data=$this->webservicemodel->select_registration_id_to_added_friend($form_data);
								
									foreach($data as $regid)
									{
										$registration_id[] = $regid->registration_id;	
									}
										$message = array('message' => "You Have Request From ".$name );    
									
									if($this->notify($registration_id,$message)==true)  
										{
										$response['success'] = 1;
										$response['message'] = 'successfully sent friend request.';
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
	
	//start send_friend_request created by sumit 8.10.2015
		//view post //created by yogita:07/10/2015
		//To display all post of that user_id
		function view_post()
		{
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$user_id     = $this->input->post('user_id');
				$all_id = $this->webservicemodel->get_friendid_of_user($user_id);
				if($all_id)
				{
				     	$form_data=$this->webservicemodel->get_single_user_post_data($all_id);
					if($form_data)
					{ 
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
                       				$response['total_post'] = count($form_data);	
						$response['form_data'] = $form_data;
						echo json_encode($response);
					}else
					{
						$response['success'] = 0;
						$response['message'] = 'fails2';
						echo json_encode($response); 
					} 
				}
				else
				{
					$form_data=$this->webservicemodel->get_single_user_data($user_id);
					if($form_data)
					{						
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						$response['total_post'] = count($form_data);
						$response['form_data'] =$form_data;
						echo json_encode($response);
					}else
					{
						$response['success'] = 0;
						$response['message'] = 'fails1';
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
	//end view post

		//start contact search  Develop by Team leader-Jadhav	
		// Get all data of friend of that user_id
		function contact_search()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)		
			{		
				$user_id      = $this->input->post('user_id');		
				$form_data=$this->webservicemodel->contact_search($user_id);					
				if($form_data)
		       		{
					$response['success'] = 1;
					$response['message'] = 'Successfully Search';
					$response['form_data'] = $form_data;
			    		echo json_encode($response);         
		      		}
			   	else
				{		
					$response['success'] = 0;
					$response['message'] = 'Data not exist';
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
		//end contact search 

		//start add comment created by sumit 
		function add_comment()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
	    		{				
				if (isset($_FILES['image']['name'])) 
				{
					$target_path1 = "uploads/comment/";
					$server_ip = base_url();
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/comment/";
					$count = $this->input->post("no_of_files");	
					for($i=0;$i<$count;$i++)
					{
						$path = $target_path . basename($_FILES['image']['name'][$i]);			
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $path)) 
							{		
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else
							{
								$response['message'] ='File uploaded successfully'; 					
								$file_path[$i] = $file_upload_url . basename($_FILES['image']['name'][$i]);
								$post_images =  json_encode($file_path);
							}
						} 
						catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
					}
				}
				else
				{				
					$post_images = '';				
				}
		 		$data = array(
				   	 'user_id'                 =>$this->input->post('user_id'), 
					 'post_id'                 =>$this->input->post('post_id'),
					 'profile_id'              =>$this->input->post('profile_id'),
					 'content'                 => urldecode($this->input->post('content')),
				     'image'                   =>$post_images 
				    		);   
					 $post_id                 = $this->input->post('post_id');
					$user_id                 = $this->input->post('user_id');
					$form_data=$this->webservicemodel->add_comment($data);
					$comment_data =$this->webservicemodel->select_user_comment($post_id); 
								if($comment_data)
								{ 
									$comment_count = count($comment_data); 
									if($this->webservicemodel->update_total_comment($comment_count, $post_id)==true)
									{
										
											$username=$this->webservicemodel->select_comment_name($user_id);
											
												foreach($username as $user)
													{
														$name=$user->name; 
													}
											$data=$this->webservicemodel->notify_to_comment($data);  
								 
												foreach($data as $regid)
													{
														$registration_id[] = $regid->registration_id;	
													} // print_r($registration_id);exit;
														$message = array('message' => $name." Commented On Your Post");    
													//print_r($registration_id);	exit;
											if($this->notify($registration_id,$message)==true)  
											{
												 $response['success'] = 1;
												 $response['message'] = 'successfully comment';
												 echo json_encode($response);      
											}
											else
											{
												 $response['success'] = 0;
												 $response['message'] = 'comment fails';
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
	
//end add_comment created by sumit

//start created by sumit 9.10.15
		// To add or Update user in friend_unfriend table for block user, 
		//send friend request to user, accept friend request of user, unfriend user, etc.
	 	function accept_reject_block_request()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
				$form_data = array(								
					'added_friend_id'            => $this->input->post('added_friend_id'),
					'user_id'                    => $this->input->post('user_id'),
					'is_accepted'                =>$this->input->post('is_accepted'),
				
					          );
				$user_id = $this->input->post('user_id');		
				$friend_data = array(								
					
					'is_accepted'                =>$this->input->post('is_accepted'),
				
					          ); 
				 if($this->webservicemodel->check_friend($form_data)==true)
				{
					if($form_data['is_accepted']==4)
					{
						if($this->webservicemodel->insert_accept_reject_block_request($form_data)==true)  
						{
							if($this->webservicemodel->update_accept_reject_block_request($friend_data,$form_data)==true)  
							{
								$user_name=$this->webservicemodel->select_name_to_friend($user_id);
						
								foreach($user_name as $name)
									{
									    $user=$name->name; 
									}
								$data=$this->webservicemodel->select_registration_id_to_user($form_data);
								 
									foreach($data as $regid)
									{
										$registration_id[] = $regid->registration_id;	
									    
									}
										$message = array('message' => $user." Accepted Your Request");    
										
										if($this->notify($registration_id,$message)==true)  
							{
								$response['success'] = 1;
								$response['message'] = 'updated and inserted Accept/Reject/Block request.';			
								echo json_encode($response);
							} 
							else
							{
								$response['success'] = 0;
								$response['message'] = 'updated and inserted fail Accept/Reject/Block request';
								echo json_encode($response);
						   	} 
							} 
							else
							{
								$response['success'] = 0;
								$response['message'] = 'updated and inserted fail Accept/Reject/Block request';
								echo json_encode($response);
						   	} 
						} 
						else
						{
							$response['success'] = 0;
							$response['message'] = 'Insert Fail';
							echo json_encode($response);
					   	} 
					}
					else
					{
					if($this->webservicemodel->update_user_status($friend_data,$form_data)==true)
					{	
						$response['success'] = 1;
						$response['message'] = 'updated Reject/Block request';			
						echo json_encode($response);
					}
					else
					{
						$response['success'] = 0;
						$response['message'] = ' updated fail Reject/Block request';
						echo json_encode($response);
					}
					
					}
				
				}else
				{ 
			  	       	$response['success'] = 0;
						$response['message'] = 'Friend not found for update/insert';
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
		//end created by sumit 9.10.15
	
		function unfriend_request()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
				$user_data = array(								
					'added_friend_id'            => $this->input->post('added_friend_id'),
					'user_id'                    => $this->input->post('user_id'),
					'is_accepted'                =>5
					          );
				$friend_data = array(								
					'added_friend_id'            => $this->input->post('user_id'),
					'user_id'                    => $this->input->post('added_friend_id'),
					'is_accepted'                =>5
					          );
				if($this->webservicemodel->update_unfriend_user($user_data)==TRUE)
				{
					if($this->webservicemodel->update_unfriend_friend($friend_data)==true)  
					{
						$response['success'] = 1;
						$response['message'] = 'successfully insert.';		
						echo json_encode($response);			
					} 
					else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
						echo json_encode($response);
					} 				
				}else
				{    
					$response['success'] = 0;
					$response['message'] = ' selection fail';
					echo json_encode($response);   
				}
			}
		}
//start profile pic like created by Yogita 10.10.15
		function profile_pic_like()
		{
			//check user is exist
			// if exist run update query
			// if not exist run insert query
		 	$posttoken = $this->input->post('token');  
		  	if($this->webservicemodel->checktoken($posttoken)==TRUE)
		  	{
	  			$form_data = array(
					'user_id'          	 =>$this->input->post('user_id'), 
					'profile_id'       	 =>$this->input->post('profile_id'),
					'status'		 =>$this->input->post('status')
					);			
			 	if($this->webservicemodel->check_user_id ($form_data)==FALSE)
				{
					if($this->webservicemodel->insert_user($form_data)==true)  
					{
						$response['success'] = 1;
						$response['message'] = 'successfully insert.';	
						$response['like'] = count($form_data);		
						echo json_encode($response);			
					} 
					else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
						echo json_encode($response);
					} 				
				}else
				{ 
			  	       if($this->webservicemodel->update_profile_pic($form_data)==True)
					{
						$response['success'] = 1;
						$response['message'] = 'update successfully';			
						echo json_encode($response);		
					}
					else
					{
						$response['success'] = 0;
						$response['message'] = ' selection fail';
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

	 	//start add_photo created by sumit 9.10.2015 
		//upload multiple photos for photo gallery
		function add_photo()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
	    		{
					$count = $this->input->post("no_of_files");
				for($i=0;$i<$count;$i++)
			{
				if (isset($_FILES['image']['name'])) 
				{
					$target_path1 = "uploads/uploadphoto/";
					$server_ip = base_url();
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/uploadphoto/";
					
						$target_path = $target_path . basename($_FILES['image']['name'][$i]);	
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path)) 
							{	
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else
							{
								$response['message'] = 'File uploaded successfully!';					
								$file_path[$i] = $file_upload_url . basename($_FILES['image']['name'][$i]);
								$add_images = ($file_path[$i]);
							}
						}
						catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
					}
				else
				{			
					$add_images = '';				
				}
				$form_data = array(
					'user_id'           => $this->input->post('user_id'), 
					'image_path'        => $add_images,
					'is_profile'        => 3
						);  
				$data=$this->webservicemodel->add_photo($form_data);
					}	
				if($data)
				{
					$response['success'] = 1;
					$response['message'] = 'successfully add photo';
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
		//end add_photo created by sumit 9.10.2015	
	
		//start select profile created by sumit 10/10/15
		//Select user data of user to display name and status
		function select_user_data()
	 	{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
		  		$user_id =$this->input->post('user_id');
		  		$data =$this->webservicemodel->select_profile($user_id);
		  		if($data)
	       			{
					$response['success'] = 1;
					$response['message'] = 'Data Selected';
					$response['data'] = $data;
				        echo json_encode($response);         
	       			}
				else
				{
					$response['fail'] = 0;
					$response['message'] = 'fails';
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
		//start select profile created by sumit 10/10/15

		//start Profile update created by sumit 10/10/15
		//User name and status update
		function user_data_update()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
				$form_data = array(				
				    'name'                       => urldecode($this->input->post('name')),			    
				    'status'                     => urldecode($this->input->post('status')),				    	
				    'user_id'                    =>$this->input->post('user_id')			
						   );  			
						   $user_id = $this->input->post('user_id');		
				 if($this->webservicemodel->profile_update($form_data))
				{
					$username=$this->webservicemodel->select_comment_name($user_id);
											
												foreach($username as $user)
													{
														$name=$user->name; 
													}
											$data=$this->webservicemodel->notify_to_update_information($form_data);  
								 
												foreach($data as $regid)
													{
														$registration_id[] = $regid->registration_id;	
													}
														$message = array('message' => $name." Update Information");    
													//print_r($registration_id);	exit;
											if($this->notify($registration_id,$message)==true)  
											{
												$response['success'] = 1;
												$response['message'] = 'successfully Updated Data';			
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
				 $response['fail'] = 0;
				 $response['message'] = 'user not authorised';
			   	 echo json_encode($response);  
			}
		}
		//end user data update created by sumit 10/10/15

//start select profile created by sumit 10/10/15
//Add profile pic of user
		function add_multiple_profile_pic_time($post_data)
		{
			$count =1;// count($post_data); 
			print_r($post_data);
							
							
							$timezone = new DateTimeZone("Asia/Kolkata" );
							$date = new DateTime();
							$date->setTimezone($timezone );
							$current_date = $date->format( 'd-m-Y' );//print_r($current_date);exit;
						
							for($i=0;$i<$count;$i++)
							{
									if (isset($_FILES['image']['name'])) 
									{
										$target_path1 = "uploads/";
										$server_ip = base_url();
										$file_upload_url = $server_ip . $target_path1;
										$target_path = "uploads/";
											$target_path = $target_path . basename($_FILES['image']['name'][$i]);	
											try 
											{
												if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path)) 
												{	
													$response['error'] = true;
													$response['message'] = 'Could not move the file!';
												}
												else
												{
													$response['message'] = 'File uploaded successfully!';					
													$file_path[$i] = $file_upload_url . basename($_FILES['image']['name'][$i]);
													$add_images = ($file_path[$i]);
												}
											}
											catch (Exception $e) 
											{
												$response['error'] = true;
												$response['message'] = $e->getMessage();					
											}
									
										 if($i==0)
										{
											 $post_data; 
										}
										else
										{
											$day = $this->input->post('frequency_day');
											$date = new DateTime($current_date);
											$date->modify("+2 day");
											$current_date= $date->format("d-m-Y");
									
											 $post_data;
										}	
										
									$data=$this->webservicemodel->add_multiple_profile_pic($post_data);
									} 
							}  		//print_r($post_data);exit;
						if($data==true)
						{
							$response['success'] = 1;
							$response['message'] = 'successfully add photo';
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
// end create by sumit 10.10.2015

function view_multiple_profile()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
		   		$user_id =$this->input->post('user_id');	
		 		 $data =$this->webservicemodel->view_multiple_profile($user_id);
		 		if($data)
	       			{
					$response['success'] = 1;
					$response['message'] = 'Data Selected';
					$response['data'] = $data;
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


function view_profile_pic()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
		   		$user_id =$this->input->post('user_id');	
		 		 $data =$this->webservicemodel->select_profile_pic($user_id);
		 		if($data)
	       			{
					$response['success'] = 1;
					$response['message'] = 'Data Selected';
					$response['data'] = $data;
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
		//end
		//start 
		function update_multiple_datewise_profile()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
		   		$user_id =$this->input->post('user_id');	
		   		$future_date =$this->input->post('future_date');	
		 		 $data =$this->webservicemodel->update_multiple_datewise_profile($user_id,$future_date);
				$data1 =$this->webservicemodel->update_multiple_datewise_profile1($user_id,$future_date);
		 		if($data1)
	       			{
					$response['success'] = 1;
					$response['message'] = 'Data Selected';
					$response['data'] = $data;
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
//get profile pic to display profile of user
function view_profile_pic2()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
				$user_id =$this->input->post('user_id');	print_r($user_id);exit;
				// $data =$this->webservicemodel->select_profile_pic($user_id);
				/*  foreach($data as $data)
							{
								if($data['is_profile']==1)
								{
									$profile_data=$this->webservicemodel->select_profile_data($user_id);
									$count =count($profile_data); 
									$timezone = new DateTimeZone("Asia/Kolkata" );
							$date = new DateTime();
							$date->setTimezone($timezone );
							$current_date = $date->format( 'd-m-Y' );
									for($i=0;$i<$count;$i--)
									{
										if($i==0)
										{
											$form_data = array(
											'user_id'           	  => $this->input->post('user_id'), 
											'image_path'        => $data['image_path'],
											'frequency_day'   =>  $data['frequency_day'], 
											'sequence'   		  => $i+1,
											'future_date'        => $current_date,
											'is_profile'        => 1
																	);   //print_r($form_data);
										}else{
											$day = $this->input->post('frequency_day');
											$date = new DateTime($current_date);
											$date->modify("+2 day");
											$current_date= $date->format("d-m-Y");
										//print_r($current_date);exit;
										$form_data = array(
											'user_id'           	  => $this->input->post('user_id'), 
											'image_path'        => $add_images,
											'frequency_day'   =>  $this->input->post('frequency_day'), 
											'sequence'   		  => $i+1,
											'future_date'        => $current_date,
											'is_profile'           => 2
																	);  //print_r($form_data);
										}	
										
									$data1=$this->webservicemodel->add_multiple_profile_pic($form_data);
									}
									
									
										}
										else{
										//	print_r("sajfsa;lfa");
										}
									} */
					

				// $this->webservicemodel->update_time_is_profile($user_id);
				 $data =$this->webservicemodel->select_profile_pic($user_id);
		 		 if($data)
	       			{
					$response['success'] = 1;
					$response['message'] = 'Data Selected';
					$response['data'] = $data;
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
		//start select profile created by sumit 10/10/15	


		//create by sumit 10.10.2015
		//Add profile pic of user
		function add_profile_pic()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		    	{			
				$target_path1 = "uploads/profile/";
				$server_ip = base_url();	
				$file_upload_url = $server_ip . $target_path1;
				$target_path = "uploads/profile/";
			    $user_id = $this->input->post('user_id');		
			   $this->webservicemodel->profile_photo_delete($user_id);
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
					'image_path'  	        => $file_path,
					'user_id'   		=> $this->input->post('user_id'),
					'is_profile'   		=> 1
		       			   );
				$user_id = $this->input->post('user_id'); 
			if($this->webservicemodel->add_profile_pic($form_data, $user_id))
									{
										$response['success'] = 1;
										$response['message'] = 'success update';
										echo json_encode($response); 
									}
									else
									{
										$response['success'] = 0;
										$response['message'] = ' selection fail';
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
		// end create by sumit 10.10.2015

		//start timeline created by sumit 10.10.2015
		//display own timeline data of user
	 	function user_timeline()
	 	{	 
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{    
				$user_id =$this->input->post('user_id');
				$data= $this->webservicemodel->user_timeline($user_id);
			      	if($data)
			       	{
					$response['success'] = 1;
					$response['message'] = 'success';
                                        $response['total_self_post']= count($data);
					$response['data']    = $data;
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
		//end timeline created by sumit 10.10.2015	

		//start created by sumit 11.10.15
		//requested,block,friend,unfriend list 
	 	//start requested,block,friend,unfriend list created by sumit 11.10.15
 function user_all_list()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$user_id      = $this->input->post('user_id');
				$is_accepted  = $this->input->post('is_accepted');
				$all_id = $this->webservicemodel->added_friendid($user_id,$is_accepted);	   
				if($all_id)
				{
					//print_r($all_id);
			     	$form_data=$this->webservicemodel->request_accepted_friend_data($all_id, $is_accepted, $user_id);		
					if($form_data)
					{      
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						$response['form_data'] = $form_data;
						echo json_encode($response); 
				
					}
					else
					{ 
						$response['success'] = 0;
						$response['message'] = 'failss';
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
			else
			{
				$response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}					
	 	}
//start my unfriend list created by sumit 11.10.15

//start friend_with_self list created by sumit 24.02.16
	function friend_with_self()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$user_id      = $this->input->post('user_id');
				$is_accepted  = $this->input->post('is_accepted');
				$all_id = $this->webservicemodel->addedfriendid($user_id,$is_accepted);	   
				if($all_id)
				{
			     	$form_data=$this->webservicemodel->friend_with_self($all_id, $is_accepted, $user_id);		
					if($form_data)
					{      
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						$response['form_data'] = $form_data;
						echo json_encode($response); 
				
					}
					else
					{ 
						$response['success'] = 0;
						$response['message'] = 'failss';
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
			else
			{
				$response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}					
	 	}
//end friend_with_self list created by sumit 24.02.16

	 	//start remove profile created sumit 11.10.15
		//To remove profile
		function profile_remove()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
							
			    $form_data = array( 
					//	   'is_profile'   =>0, 			
				  // 'photo_id'     =>  $this->input->post('photo_id'),
				   'user_id'      => $this->input->post('user_id')  
				     	);	
				$user_id = $this->input->post('user_id');		
				if($this->webservicemodel->profile_remove($user_id)==true)
				{
				$base_url = base_url();
				//print_r($base_url);
				$image = $base_url.'uploads/profile/default.jpg';
				//print_r($image);exit;
				$default_image =array(
				'user_id'   =>$this->input->post('user_id'),
				'image_path' =>$image,
				'is_profile'       =>1,
						);
				if($this->webservicemodel->set_default_profile($default_image)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'remove success';			
					echo json_encode($response);
				
				}
				else{
					
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
	//end remove profile created sumit 11.10.15	
	

		//comment on profile pic
		//created by Amol
		function comment_on_profile_pic()
	 	{
			$posttoken = $this->input->post('token');  
	 	 	if($this->webservicemodel->checktoken($posttoken)==TRUE)
		    	{     
            $target_path1 = "uploads/profile/";
			$server_ip = base_url();
			$file_upload_url = $server_ip . $target_path1;
			$target_path = "uploads/profile/";
			//echo ($target_path);exit;	

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
				$data = array(
				   	 'user_id'                              =>$this->input->post('user_id'), 
					 'profile_id'                           =>$this->input->post('profile_id'),
					 'post_id'                           	=>$this->input->post('post_id'),
					 'content'                              =>urldecode($this->input->post('content')),
				    	 'image'                                =>$file_path
					    );     
				$form_data=$this->webservicemodel->comment_on_profile_pic($data);
				if($form_data)
				{
					$response['success'] = 1;
					$response['message'] = 'successfully commented';
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
		//end comment on profile pic
	
		 	
	

	
//start create page created by sumit 24.10.15
function create_page()
	{
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				 $form_data = array(

			   	 'user_id'                              =>$this->input->post('user_id'), 
			   	 'page_name'				=>urldecode($this->input->post('page_name'))
				 
					    );  
			$form_data=$this->webservicemodel->create_page($form_data);
			if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'successfully create page.';
						$response['form_data'] = $form_data;
					
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
//end create page created by sumit 24.10.15

//start view page for only my page created by sumit 24.10.15
function view_page()
	{
			$posttoken = $this->input->post('token');  
			//if($this->webservicemodel->checktoken($posttoken)==TRUE)
		//{
			$user_id =$this->input->post('user_id');
			$form_data=$this->webservicemodel->view_page($user_id);
			if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'successfully create page.';
						$response['form_data'] = $form_data;
						echo json_encode($response);  
					}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'fails';
					echo json_encode($response);   
				}
		//}
				/*else
				{
					$response['success'] = 0;
					$response['message'] = 'user not authorised';
					echo json_encode($response);  
				}*/					
	}
//start view page for only my page created by sumit 24.10.15

//start view page (all page) created by sumit 24.10.15
function view_all_page()
	{
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
			$form_data=$this->webservicemodel->view_all_page();
			if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'successfully create page.';
						$response['form_data'] = $form_data;
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
//start view page (all page) created by sumit 24.10.15

	//start photo gallery
	function photo_gallery()
	{
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				 $user_id        =$this->input->post('user_id'); 
			   	
			$form_data=$this->webservicemodel->photo_gallery($user_id);
			if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'success.';
						$response['form_data'] = $form_data;
					
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
	//end of create page
	
	

	//start select post created by sumit 10/10/15
	//share post of another user
	function share_post()
	 {
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
		   $post_id =$this->input->post('post_id');
			$user_id =$this->input->post('user_id');
		  $form_data=$this->webservicemodel->select_post($post_id);
	       		if($form_data)
				{
				foreach($form_data as $form_data)
				{
					$post_data = array(
						'user_id' => $this->input->post('user_id'),
						'friend_id'=>$form_data->user_id,
						'post_content'=>$form_data->post_content,
						'post_gallery_path'=>$form_data->post_gallery_path,
						'share_content' => urldecode($this->input->post('share_content')),
						'is_share' =>1
						 );	
		             if($this->webservicemodel->insert_share($post_data)==true)
					 {
						 $user_name=$this->webservicemodel->share_user_name($post_data);
						
									foreach($user_name as $user_name)
									{
									    $user=$user_name->name; 
									}
										$data=$this->webservicemodel->notify_share_post($post_id,$user_id);
							
									foreach($data as $regid)
									{
										$registration_id[] = $regid->registration_id;
									}
										$message = array('message' => $user." Shared Your Post");    
									//	print_r($registration_id);exit;
								if($this->notify($registration_id,$message)==true)  
								{	
									$response['success'] = 1;
									$response['message'] = 'Successfully Post Share';				
									echo json_encode($response);
								}
								else
								{
									$response['success'] = 0;
									$response['message'] = ' Post Share Fail';
									echo json_encode($response);
								}	
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
	//end select post created by sumit 10/10/15

	//start share profile created by sumit 10/10/15
function share_profile()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
		   $profile_id =$this->input->post('photo_id');  print_r($profile_id);exit;
		  $form_data=$this->webservicemodel->share_profile($profile_id);
	       		if($form_data)
				{
					foreach($form_data as $form_data)
						{	
							$profile_data = array(
								'user_id'           => $this->input->post('user_id'),
								'friend_id'         =>$form_data->user_id,
								'profile_id'          =>$form_data->photo_id,
								'post_gallery_path' =>$form_data->image_path,
								'share_content'     =>$this->input->post('share_content'),
								'is_share'          =>2,
								'is_profile'        =>1
											 );	
					  if($this->webservicemodel->insert_share_profile($profile_data)==true)
						  {
							  $user_name=$this->webservicemodel->share_user_name($post_data);
								
											foreach($user_name as $user_name)
											{
												$user=$user_name->name; 
											}
												$data=$this->webservicemodel->notify_share_profile($post_data);
										   
											foreach($data as $regid)
											{
												$registration_id = $regid->registration_id;
											}
												$message = array('message' => $user." Share You Post");    
												
										if($this->notify($registration_id,$message)==true)  
											{
												$response['success'] = 1;
												$response['message'] = 'share profile successfully.';			
												echo json_encode($response);
											}
											else
										   {
											$response['success'] = 0;
											$response['message'] = ' share profie fail.';
											echo json_encode($response);
											}	
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
//end share profile created by sumit 10/10/15



	//start like created by sumit 8.10.15 
	//like, unlike, dislike post and profile  
	function like()
	{
		$posttoken = $this->input->post('token');  
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	    {
			$form_data = array(
			'user_id'          =>$this->input->post('user_id'), 
			'post_id'          =>$this->input->post('post_id'),
			'profile_id'       =>$this->input->post('profile_id'),
			'status'           =>$this->input->post('status')
						); 
			$post_id = $this->input->post('post_id');
			$user_id = $this->input->post('user_id');
			$is_like = $this->input->post('status');
			if($this->webservicemodel->select_like($form_data)==true)
			{  //Will update in like_unlike table
				$sc =$this->webservicemodel->select_user_id_post_id($form_data); //get user_id to check who is a owner of the post
					foreach($sc as $sc) 
					{
						$tt = $sc->user_id;
						if($tt==$form_data['user_id'])
						{
							
							$user_like = $this->webservicemodel->update_is_like($is_like, $post_id); //update is_user_like in a post table.
							if($this->webservicemodel->update_like($form_data))  //update status in like unlike 
							{
								$like_data =$this->webservicemodel->select_user_like($post_id); //select like id for counting total like.
								$unlike_like_count = count($like_data); 
								if($is_like==2 && $unlike_like_count==1)
								{
									$unlike_like_count=0;
									//print_r($unlike_like_count);
								}
								if($this->webservicemodel->update_user_like_post($unlike_like_count, $post_id)==true) //update total like in post table
								{
									$username=$this->webservicemodel->select_update_like_name($user_id);
											
												foreach($username as $user)
													{
														$name=$user->name; 
													}
											$data=$this->webservicemodel->notify_to_update_like($form_data);  
												foreach($data as $regid)
													{
														$registration_id[] = $regid->registration_id;	
													}
											$message = array('message' => $name." Like Your Post");    
														
											if($this->notify($registration_id,$message)==true)  
													{
														 $response['success'] = 1;
														 $response['message'] = 'successfully like';
														 echo json_encode($response);      
													}
													else
													{
														 $response['success'] = 0;
														 $response['message'] = 'like fail123';
														 echo json_encode($response); 
													}
								}
							}
						}else
						{
							if($this->webservicemodel->update_like($form_data))  //update status in like unlike 
							{
								$like_data =$this->webservicemodel->select_user_like($post_id); //select like id for counting total like.
								$unlike_like_count = count($like_data); 
								if($is_like==2 && $unlike_like_count==1)
								{
									$unlike_like_count=0;
									//print_r($unlike_like_count);
								}
								if($this->webservicemodel->update_user_like_post($unlike_like_count, $post_id)==true) //update total like in post table
								{
									$username=$this->webservicemodel->select_update_like_name($user_id);
											
												foreach($username as $user)
													{
														$name=$user->name; 
													}
											$data=$this->webservicemodel->notify_to_update_like($form_data);  
												foreach($data as $regid)
													{
														$registration_id[] = $regid->registration_id;	
													}
											$message = array('message' => $name." Like Your Post");    
														
											if($this->notify($registration_id,$message)==true)  
										{
											 $response['success'] = 1;
											 $response['message'] = 'successfully like';
											 echo json_encode($response);      
										}
										else
										{
											 $response['success'] = 0;
											 $response['message'] = 'like fail12';
											 echo json_encode($response); 
										}
								}
							}
						}
					}	
			}
			else
			{	 //Will insert in like_unlike table
				$sc =$this->webservicemodel->select_user_id_post_id($form_data);
					foreach($sc as $sc)
					{
						$tt = $sc->user_id;
						if($tt==$form_data['user_id'])
						{
							$is_like = $this->input->post('status');
							$user_like = $this->webservicemodel->update_is_like($is_like, $post_id);	
							if($this->webservicemodel->insert_like($form_data))
							{
								$like_data =$this->webservicemodel->select_user_like($post_id); 
								if($like_data)
								{ 
									$like_count = count($like_data);
									if($this->webservicemodel->update_user_like($like_count, $post_id)==true)
									{
									$username=$this->webservicemodel->select_update_like_name($user_id);
											
												foreach($username as $user)
													{
														$name=$user->name; 
													}
											$data=$this->webservicemodel->notify_to_update_like($form_data);  
												foreach($data as $regid)
													{
														$registration_id = $regid->registration_id;	
													}
											$message = array('message' => $name." Like Your Post");    
														
											if($this->notify($registration_id,$message)==true)  
											{
												 $response['success'] = 1;
												 $response['message'] = 'successfully like';
												 echo json_encode($response);      
											}
											 else
											{
												 $response['success'] = 0;
												 $response['message'] = 'like fail1234';
												 echo json_encode($response); 
											}
									}
								}				
							}
						}else
						{
							if($this->webservicemodel->insert_like($form_data))
							{
								$like_data =$this->webservicemodel->select_user_like($post_id); 
								if($like_data)
								{ 
									$like_count = count($like_data);
									if($this->webservicemodel->update_user_like($like_count, $post_id)==true)
									{
										$username=$this->webservicemodel->select_update_like_name($user_id);
											//print_r($username);
												foreach($username as $user)
													{
														$name=$user->name; 
													}
											$data=$this->webservicemodel->notify_to_update_like($form_data);  
											
												foreach($data as $regid)
													{
														$registration_id = $regid->registration_id;	
													}
											$message = array('message' => $name." Like Your Post");    
														
											if($this->notify($registration_id,$message)==true)  
											{
												 $response['success'] = 1;
												 $response['message'] = 'successfully like';
												 echo json_encode($response);      
											}
											 else
											{
												 $response['success'] = 0;
												 $response['message'] = 'like fail12344';
												 echo json_encode($response); 
											}
									}
								}				
							}
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
	//end like create by sumit 8.10.15

//start view profile_pic_like created by sumit
function view_profile_pic_like()
 {
	$posttoken = $this->input->post('token');  
  	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	  	{
	  			$data = array(
					
					'profile_id'       	 =>$this->input->post('profile_id')
						   );
				$form_data=$this->webservicemodel->view_profile_pic_like($data);  
					if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'Data viewed.';	
						$response['like'] = count($form_data);	
						$response['form_data'] = $form_data;		
						echo json_encode($response);			
					} 
				else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
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
//start view post like created by sumit 
function view_post_like()
 {
	$posttoken = $this->input->post('token');  
  	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	  	{
	  			$pid = $this->input->post('post_id');
				$form_data=$this->webservicemodel->view_post_like($pid);  
					if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'Data viewed.';	
						$response['like'] = count($form_data);	
						$response['form_data'] = $form_data;		
						echo json_encode($response);			
					} 
				else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
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
//start view comment_on_post created by sumit 
function view_comment_on_post()
 {
	$posttoken = $this->input->post('token');  
  	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	  	{
	  		$data = array(
				'post_id'       	 =>$this->input->post('post_id')
				     );//print_r($data);
				$form_data=$this->webservicemodel->view_comment_on_post($data);  
					if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'Data viewed.';	
						$response['comment'] = count($form_data);	
						$response['form_data'] = $form_data;		
						echo json_encode($response);			
					} 
				else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
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
//End view comment on post created by sumit 

//start view comment_on_profile_pic created by sumit 
function view_comment_on_profile_pic()
 {
	$posttoken = $this->input->post('token');  
  	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	  	{
	  		$data = array(
			'profile_id'       	 =>$this->input->post('profile_id')
				     );
			$form_data=$this->webservicemodel->view_comment_on_profile_pic($data);  
					if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'Data viewed.';	
						$response['comment'] = count($form_data);	
						$response['form_data'] = $form_data;		
						echo json_encode($response);			
					} 
				else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
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
//End view comment_on_profile_pic created by sumit

//check otp created by sumit 14.10.15
function check_otp()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$data = array(
				'mob_no'           => $this->input->post('mob_no'),
				'otp_code'          => $this->input->post('otp_code'),
				'is_verified'           =>1,
				'device_id'               => $this->input->post('device_id'),
				  );  		
		
		$check_otp=$this->webservicemodel->check_otp($data);
		if($check_otp)	
		{
					
			$data1=$this->webservicemodel->update_verified($data);
			if($data1)	
			{	
				$form_data=$this->webservicemodel->select_user_id($data);
				if($form_data)
				{
					$response['success'] = 1;
					$response['message'] = 'verified Done';
					$response['form_data'] = $form_data;
						echo json_encode($response);         
					 }
				else
				{		
					$response['success'] = 0;
					$response['message'] = 'verified fail';
					echo json_encode($response);
			
				} 
				
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
//check otp created by sumit 14.10.15
//start otp recent created by sumit 14.10.15
function otp_recent()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{

			  
			$mob_no= $this->input->post('mob_no');
			$ran= rand(100000,999999);
			$sort=substr($ran, 10); 
			$username = urlencode("kailashc");
			$password = urlencode("dCUDfNDPXPbVQR");
			$api_id   = urlencode("3565960");
			$to       = urlencode($mob_no);
			$message  = urlencode($ran);
			$otp_code = urlencode($ran);
			
				$form_data =array(
				'mob_no'    =>$mob_no,
				'device_id' =>$this->input->post('device_id'),
				'otp_code'  =>$otp_code								
					);
	  file_get_contents("https://api.clickatell.com/http/sendmsg"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
			if($this->webservicemodel->update_otp_code($form_data)==TRUE)
			{
				$response['success'] = 1;
				$response['message'] = 'update in data';
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
//end opt recent created by sumit

function update_user_id()

	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$data = array(
				'user_id'           => $this->input->post('user_id'),
				'registration_id'           => $this->input->post('registration_id')
				  );  		
			$mob_no           = $this->input->post('mob_no');
			$user_id        = $this->input->post('user_id');
		if($this->webservicemodel->update_user_id($data,$mob_no)==true)	
		{	
			
			$default_image =array(
			'image_path'       =>'http://gobike.integrationsolution.in/uploads/profile/default.jpg',
			'is_profile'       =>1,
			'user_id'          =>$user_id
					);
			
			if($this->webservicemodel->default_image($default_image))
			{
				$response['success'] = 1;
				$response['message'] = 'verified Done';
				echo json_encode($response);
	      		 }
		   	else
			{		
				$response['success'] = 0;
				$response['message'] = 'image set not done';
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
	}
//start post deleted created sumit 11.10.15
function post_delete()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
			    $form_data = array( 	
				   'post_id'     =>  $this->input->post('post_id'),
				   'is_deleted'  =>1
					      );			
				     
				if($this->webservicemodel->post_delete($form_data)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'remove success';			
					echo json_encode($response);
				
				}
				else{
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
//end post deleted created sumit 11.10.15

//start photo deleted created sumit 11.10.15
function photo_delete()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
				$photo_id = $this->input->post('photo_id'); 
				if($this->webservicemodel->photo_delete($photo_id)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'remove success';			
					echo json_encode($response);
				}
				else
				{
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
//end photo deleted created sumit 11.10.15
  
function fdelete(){
$file = "uploads/adevertisement/4.png";
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }
}
//start edit post created sumit 11.10.15
function edit_post()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
			    $form_data = array( 	
				   'post_content'     => urldecode($this->input->post('post_content'))
					      );			
				   $user_id   = $this->input->post('user_id');  
				   $post_id   = $this->input->post('post_id');  
				     
				if($this->webservicemodel->edit_post($user_id,$post_id,$form_data)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'edit success';			
					echo json_encode($response);
				
				}
				else{
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
//end edit post created sumit 11.10.15

//start comment deleted created sumit 11.10.15
function comment_delete()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
			    $form_data = array( 	
				   'comment_id'     =>  $this->input->post('comment_id'),
				   'is_deleted'  =>1
					      );			
				     
				if($this->webservicemodel->comment_delete($form_data)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'remove success';			
					echo json_encode($response);
				
				}
				else{
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
//end comment deleted created sumit 11.10.15

//start all user created by sumit 24.10.15
function all_user()
	{
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{
			$user_id =$this->input->post('user_id');
			$form_data=$this->webservicemodel->all_user($user_id);
			if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'successfully create page.';
						$response['form_data'] = $form_data;
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
//end all user created by sumit 24.10.15
//start follow_unfollow created by sumit 02/11/15
function follow_unfollow()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			$form_data = array(				
			    'follow_unfollow_status'  =>$this->input->post('follow_unfollow_status'),
			    'user_id'                 =>$this->input->post('user_id'),
			    'added_friend_id'         =>$this->input->post('added_friend_id')
					   );  
				
			 if($this->webservicemodel->follow_unfollow($form_data))
			{
				$response['success'] = 1;
				$response['message'] = 'successfully';			
				echo json_encode($response);				 
			}
			else{
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
//start follow_unfollow created by sumit 02/11/15
//start all friend search created by sumit 3.11.15
function all_friend_search()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)		
		{		
			$name      = urldecode($this->input->post('name'));	
			$user_id      = $this->input->post('user_id');			
			$form_data=$this->webservicemodel->all_friend_search($name,$user_id );					
			if($form_data)
	       		{
				$response['success'] = 1;
				$response['message'] = 'Successfully Search';
				$response['form_data'] = $form_data;
		    		echo json_encode($response);         
	      		}
		   	else
			{		
				$response['success'] = 0;
				$response['message'] = 'Friend not exist';
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
//End all friend search created by sumit 3.11.15
//start make profile pic created by sumit 4.11.15
function make_profile_pic()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	    	{	
				$user_id = $this->input->post('user_id'); 			
				$this->webservicemodel->profile_photo_delete1($user_id);
				$photo_id = $this->input->post('photo_id'); 		
				$data=$this->webservicemodel->make_profile_pic_img_path($photo_id,$user_id);
				//print_r($data);exit;
				foreach($data as $data)
				{
					$file_path = $data->image_path;		//print_r($file_path);exit;			
				}
				//print_r($file_path);exit;	
			$form_data = array(	
					'photo_id'  	        => $this->input->post('photo_id'),
					'user_id'  	            => $this->input->post('user_id'),
			        'is_profile'   		    => 1,
			        'image_path'   		=> $file_path
		       			   );
				
				if($this->webservicemodel->make_profile_pic($form_data, $user_id)==true)
					{		
						if($this->webservicemodel->make_profile_update($form_data, $user_id))
					{		
						$response['success']    = 1;
						$response['message']    = 'update_profile_pic';
						$response['form_data']  = $form_data;
						echo json_encode($response);  
					}
					else
					{
						$response['fail'] = 0;
						$response['message'] = 'fail to update profile pic';
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
//End make profile pic created by sumit 4.11.15	
//Start request user created by sumit 6.11.15	
function request_user()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$user_id      = $this->input->post('user_id');
				$is_accepted  = $this->input->post('is_accepted');
				$all_id = $this->webservicemodel->select_friend($user_id,$is_accepted);
				if($all_id>0)
				{
				     	$form_data=$this->webservicemodel->request_accepted_user($all_id, $is_accepted, $user_id);
				
					if($form_data)
					{      
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						$response['form_data'] = $form_data;
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
//End request user created by sumit 6.11.15	
//start requested,block,friend,unfriend list created by sumit 11.10.15
 function friend_all_list()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$added_friend_id      = $this->input->post('added_friend_id');
				$is_accepted          = $this->input->post('is_accepted');
				$all_id = $this->webservicemodel->added_userid($added_friend_id,$is_accepted);	  
				if($all_id)
				{ 
			     	$form_data=$this->webservicemodel->request_accepted_user_data($all_id, $is_accepted, $added_friend_id);
				if($form_data)
					{      
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						//$response['total_request'] = count($form_data);	
						$response['form_data'] = $form_data;
						echo json_encode($response); 
				
					}
					else
					{ 
						$response['success'] = 0;
						$response['message'] = 'failss';
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
			else
			{
				$response['success'] = 0;
				$response['message'] = 'user not authorised';
				echo json_encode($response);  
			}					
	 	}
//start my unfriend list created by sumit 11.10.15

//start requested,block,friend,unfriend list created by sumit 11.10.15
 function friend_request_count()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$user_id      = $this->input->post('user_id');
				$is_accepted          = $this->input->post('is_accepted');
				$all_id = $this->webservicemodel->friend_request_count($user_id,$is_accepted);	  
				if($all_id)
				{ 
			     	$response['success'] = 1;
					$response['message'] = 'Display List Successfully';
					$response['total_request'] = count($all_id);
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
//start my unfriend list created by sumit 11.10.15

//start page delete created by sumit 25.11.15
function page_delete()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
			    $form_data = array( 	
				   'page_id'     =>  $this->input->post('page_id'),
				   'is_deleted'  =>1
					      );			
				   //$user_id   = $this->input->post('user_id');  
				     
				if($this->webservicemodel->page_delete($form_data)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'page remove success';			
					echo json_encode($response);
				
				}
				else{
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
//End page delete created by sumit 25.11.15
//Start select_block_list created by sumit 30.11.15
 function select_block_list()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$added_friend_id = $this->input->post('added_friend_id');
				$is_accepted     = $this->input->post('is_accepted');
				 //print_r($added_friend_id);exit;
			     	$form_data=$this->webservicemodel->select_block_list($is_accepted, $added_friend_id);		
					if($form_data)
					{      
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						$response['form_data'] = $form_data;
						echo json_encode($response); 
					}
					else
					{ 
						$response['success'] = 0;
						$response['message'] = 'failss';
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
//Start select_block_list created by sumit 30.11.15
//start select ads on chat page created by sumit 30.11.15
function select_ads()
 {
	$posttoken = $this->input->post('token');  
  	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	  	{
				$page = $this->input->post('page');  
				$form_data=$this->webservicemodel->select_ads($page);  
					if($form_data)
					{
						$response['success'] = 1;
						$response['message'] = 'Data viewed.';	
						$response['form_data'] = $form_data;		
						echo json_encode($response);			
					} 
				else
					{
						$response['success'] = 0;
						$response['message'] = 'data selection fail';
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
//End select ads on chat page created by sumit 30.11.15
//start unblock url created by sumit 30/11/15
function unblock()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		 	{
			    $form_data = array( 	
				   'added_friend_id'     =>  $this->input->post('added_friend_id'),
					              );			
				   $user_id   = $this->input->post('user_id');				     
				if($this->webservicemodel->unblock($user_id,$form_data)==true)
				{
					$response['success'] = 1;
					$response['message'] = 'remove success';			
					echo json_encode($response);
				
				}
				else{
					$response['success'] = 0;
					$response['message'] = 'remove fail';
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
//end unblock url created by sumit 30/11/15
//start post advertisement created by sumit 1.12.15
function post_advertisement()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		if (isset($_FILES['image']['name'])) 
				{
					$target_path1 = "uploads/advertisement/";
					$server_ip = base_url();
					$file_upload_url = $server_ip . $target_path1;
					$target_path = "uploads/advertisement/";
					$count = $this->input->post("no_of_files");
					for($i=0;$i<$count;$i++)
					{
						$path = $target_path . basename($_FILES['image']['name'][$i]);			
						try 
						{
							if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $path)) 
							{		
								$response['error'] = true;
								$response['message'] = 'Could not move the file!';
							}
							else
							{
								$response['message'] = 'File uploaded successfully!';			
								$file_path[$i] = $file_upload_url . basename($_FILES['image']['name'][$i]);
								$adevertisement_images =   json_encode($file_path);							
							}
						}
						catch (Exception $e) 
						{
							$response['error'] = true;
							$response['message'] = $e->getMessage();					
						}
					}
				}else
				{				
					$adevertisement_images = '';				
				}
				$form_data = array(
				'user_id'                       => $this->input->post('user_id'), 			
				'ads_description'           => $this->input->post('ads_description'),	
				'ads_title'                      => $this->input->post('ads_title'),				
				'ads_category_id'          => $this->input->post('ads_category_id'),
				'ads_sub_category_id'   => $this->input->post('ads_sub_category_id'),
				'ads_image'                  => $adevertisement_images,
				'name'                          => $this->input->post('name'),	
				'email'                          => $this->input->post('email'),		
				'phone_no'                    => $this->input->post('phone_no'),
				'area'                            => $this->input->post('area'),					
				'price'                           => $this->input->post('price'),					
				'brand'                          => $this->input->post('brand')			
											);  			//print_r($form_data);
		if($this->webservicemodel->post_advertisement($form_data))
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							//$response['data'] = $form_data;
							echo json_encode($response);
				}
				else{
							$response['success'] = 0;
							$response['message'] = 'fail';
							//$response['data'] = $form_data;
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
//End post advertisement created by sumit 1.12.15
//start view post advertisement created by sumit 1.12.15
	 function view_post_advertisement()

	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$ads_sub_category_id =$this->input->post('ads_sub_category_id');
		
		$form_data = $this->webservicemodel->view_post_advertisement($ads_sub_category_id );
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
//End view post advertisement created by sumit 1.12.15

//start view post advertisement created by sumit 1.12.15
	 function area_wise_view_post_advertisement()

	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$ads_sub_category_id   =$this->input->post('ads_sub_category_id');
		$area                           =$this->input->post('area');
		$form_data = $this->webservicemodel->area_wise_view_post_advertisement($ads_sub_category_id,$area);
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
//End view post advertisement created by sumit 1.12.15

//start  created by sumit 1.12.15
	function edit_post_advertisement()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		
				$form_data = array(
				'ads_description'           => $this->input->post('ads_description'),	
				'ads_title'                      => $this->input->post('ads_title'),				
			//	'ads_category_id'                      => $this->input->post('ads_category_id'),				
				'ads_sub_category_id'                      => $this->input->post('ads_sub_category_id'),				
				'name'                          => $this->input->post('name'),	
				'email'                          => $this->input->post('email'),		
				'phone_no'                    => $this->input->post('phone_no'),
				'price'                           => $this->input->post('price'),					
				'brand'                          => $this->input->post('brand')			
											);  		//print_r($form_data);
				//$user_id = $this->input->post('user_id');		
				$ads_id = $this->input->post('ads_id');		 //print_r($ads_id);exit;
		if($this->webservicemodel->edit_post_advertisement($form_data,$ads_id))
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							//$response['data'] = $form_data;
							echo json_encode($response);
				}
				else{
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
//End view post advertisement created by sumit 1.12.15
//start delete post advertisement created by sumit 1.12.15
	 function delete_post_advertisement()

	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
			//$user_id = $this->input->post('user_id');		
			$ads_id = $this->input->post('ads_id');		

		$form_data = $this->webservicemodel->delete_post_advertisement($ads_id);
			if($form_data)
			
				{
							$response['success'] = 1;
							$response['message'] = 'successfully';
							$response['data'] = $form_data;
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
//End delete post advertisement created by sumit 1.12.15
//start select_area created by sumit 1.12.15
	 function select_area()

	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$city_id = $this->input->post('city_id');	
		$form_data = $this->webservicemodel->select_area($city_id);
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
//End select area created by sumit 1.12.15
//start select_city created by sumit 1.12.15
	 function select_city()

	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$form_data = $this->webservicemodel->select_city();
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
//End select city created by sumit 1.12.15
//start select_category created by sumit 1.12.15
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
//End select category created by sumit 1.12.15

//start select ads sub category created by sumit 13.1.16
	 function select_ads_sub_category()
	{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
	{
		$ads_category_id   = $this->input->post('ads_category_id');		
		$form_data = $this->webservicemodel->select_ads_sub_category($ads_category_id);
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
//start select ads sub category created by sumit 13.1.16


function dates()
{
$today=date('d-m-Y');

			$next_date= date('d-m-Y', strtotime($today. ' + 0 days'));

			echo $next_date;
}
//Add profile pic of user
		function add_multiple_profile_pic()
		{
			$posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
	    		{
							$count = $this->input->post("no_of_files");
							$timezone = new DateTimeZone("Asia/Kolkata" );
							$date = new DateTime();
							$date->setTimezone($timezone );
							$current_date = $date->format( 'd-m-Y' );//print_r($current_date);exit;
							$user_id = $this->input->post('user_id');		
							$this->webservicemodel->profile_photo_delete($user_id);
								
							for($i=0;$i<$count;$i++)
							{
									if (isset($_FILES['image']['name'])) 
									{
										$target_path1 = "uploads/";
										$server_ip = base_url();
										$file_upload_url = $server_ip . $target_path1;
										$target_path = "uploads/";
											$target_path = $target_path . basename($_FILES['image']['name'][$i]);	
											try 
											{
												if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path)) 
												{	
													$response['error'] = true;
													$response['message'] = 'Could not move the file!';
												}
												else
												{
													$response['message'] = 'File uploaded successfully!';					
													$file_path[$i] = $file_upload_url . basename($_FILES['image']['name'][$i]);
													$add_images = ($file_path[$i]);
												}
											}
											catch (Exception $e) 
											{
												$response['error'] = true;
												$response['message'] = $e->getMessage();					
											}
											
										 if($i==0)
										{
											$form_data = array(
											'user_id'           	  => $this->input->post('user_id'), 
											'image_path'        => $add_images,
											'frequency_day'   =>  $this->input->post('frequency_day'), 
											'sequence'   		  => $i+1,
											'future_date'        => $current_date,
											'is_profile'        => 1
																	);   
										}else{
											$day = $this->input->post('frequency_day');
											$date = new DateTime($current_date);
											//$date->modify("+".$frequency_day." day");
											$date->modify("+".$frequency_day." day");
											$current_date= $date->format("d-m-Y");
										//print_r($current_date);exit;
										$form_data = array(
											'user_id'           	  => $this->input->post('user_id'), 
											'image_path'        => $add_images,
											'frequency_day'   =>  $this->input->post('frequency_day'), 
											'sequence'   		  => $i+1,
											'future_date'        => $current_date,
											'is_profile'           => 2
																	); 
										}	//print_r($form_data);
										
									$data=$this->webservicemodel->add_multiple_profile_pic($form_data);
									}
							}
						if($data)
						{
							$response['success'] = 1;
							$response['message'] = 'successfully add photo';
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
// end create by sumit 10.10.2015

function delete_que()
{
	$this->webservicemodel->deleteq();
}

function feedback()
	{
			 $posttoken = $this->input->post('token');		
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{  
			   $form_data = array(
					'user_id'	  =>$this->input->post('user_id'),
					'name'         => $this->input->post('name'),            
					'email_id'   	  => $this->input->post('email_id'),
					'comment'   => $this->input->post('comment'),
					);   
					 
					if($this->webservicemodel->feedback($form_data)==TRUE)
				   {
						$response['success'] = 1;
						$response['message'] = 'success';
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
	//end feedback
//start apk downloade created by sumit date 6/1/16
	function apk_downloade()
	{
		$file = 'uploads/uploads/';
		$filename ="MYAPP";
			if (file_exists($file)) 
				{
					header('Content-Description: File Transfer');
					header('Content-Type: application/vnd.android.package-archive');
					header("Content-Disposition:attachment; filename=\"$filename\"");
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					ob_clean();
					flush();
					readfile($file);
					exit;
				}
	}
	//End apk downloade created by sumit date 6/1/16
	
//Start select all friend  display list created by sumit date 8/1/16	
function friend_display_list()
{
		$posttoken = $this->input->post('token');		
		if($this->webservicemodel->checktoken($posttoken)==TRUE)
		{   
				$data =$this->webservicemodel->friend_display_list();
				if($data)
			   {
					$response['success'] = 1;
					$response['message'] = 'success';
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
//end select all friend  display list created by sumit date 8/1/16	
	
function user_online_offline()
{
	$posttoken=$this->input->post('token');
	if($this->webservicemodel->checktoken($posttoken)==true)
	{
			$form_data = array(
			'online_offline'  => $this->input->post('online_offline')
											);
			$user_id  = $this->input->post('user_id');
			if($this->webservicemodel->user_online_offline($form_data,$user_id))
			{
				$response['success'] = 1;
				$response['message'] = 'success';
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
				 'Authorization: key=AIzaSyDPVdxJI86jnBek_4tbt6kLqyKFUSqFIfA',
				//'Authorization: key=AIzaSyB1lXd8VTcCbZaxktKx7gFeUuwi6t8ivPA',
				 //'Authorization: key=AIzaSyC7kdm9sNgyWDOzRvkc9CjQbJSYCqjQ8F0 ',
				// 'Content-Type: application/x-www-form-urlencoded'
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
			
				
			 if ($result === FALSE) 
			 {
				die('Curl failed: ' . curl_error($ch));
			 }else{
					curl_close($ch);	
				return true;
				
			 }
}
//

function notify1($registration_id,$message)   
{
		
			 
			
		
         $fields = array(
             'registration_ids' => $registration_id,
             'data' => $message,
         );
		
			  if ($fields === FALSE) 
			 {
				die('Curl failed:');
			 }else{
					
				return true;
				
			 }
}
//select_send_mob_no created by sumit 26/12/15
function offline_messages_sending()
{
        $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			$form_data = array(
					'user_id'                 => $this->input->post('user_id'), 
					'friend_id'    			 => $this->input->post('friend_id')
										);   
					$sms               = $this->input->post('message');
				$data1=$this->webservicemodel->select_user_id_mob_no($form_data);  
					foreach($data1 as $u_mob)
							{
								$user_id_mob= $u_mob->mob_no;  //print_r($user_id_mob);exit;
							}	
			
				$data=$this->webservicemodel->select_friend_id_mob_no($form_data);  
					if($data)	
							foreach($data as $mobile)
							{
								$mob= $mobile->mob_no;  
							}		
					{  
							$mob_no= $mob; 
							//$ran= rand(100000,999999);
							//$sort=substr($ran, 10); 
							$username = urlencode("kailashc");
							$password = urlencode("dCUDfNDPXPbVQR");
							$api_id      = urlencode("3565960");
							$to            = urlencode($mob_no);
							$message  = urlencode($sms);
							
							$message_send = file_get_contents("https://api.clickatell.com/http/sendmsg"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
							if($message_send==true)
					
							{
								$response['success'] = 1;
								$response['message'] = 'success';
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
			 $response['fail'] = 0;
			 $response['message'] = 'user not authorised';
			 echo json_encode($response);  
		}
	}
//start text_sms_send created by sumit 26/12/15
function text_sms_send()
{
	    $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			$form_data = array(
					'message'                 => $this->input->post('message'), 
					'mob_no'    			   => $this->input->post('mob_no')
										);   
		 
			$mob_no= $form_data['mob_no'];
			$ran= $form_data['message'];
			$sort=substr($ran, 10); 
			$username = urlencode("kailashc");
			$password = urlencode("dCUDfNDPXPbVQR");
			$api_id   = urlencode("3565960");
			$to       = urlencode($mob_no);
			$message  = urlencode($ran);
						
			  file_get_contents("https://api.clickatell.com/http/sendmsg"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
			if( $form_data==TRUE )
			{
				$response['success'] = 1;
				$response['message'] = 'successfully register';
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
//end text_sms_send created by sumit 26/12/15

//start message_scheduling created by sumit 30/01/16
function message_scheduling()
{
	    $posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
		$friend_id = $this->input->post('friend_id');
			$friends= explode(",", $friend_id);
		
			$count = count($friends);
	
			for($i=0;$i<$count;$i++)
			{
			$form_data = array(
					'message'                 => $this->input->post('message'), 
					//'mob_no'    			   => $this->input->post('mob_no'),
					'user_id'    			   	   => $this->input->post('user_id'),
					'friend_id'    			   => $friends[$i],
					'date'    			           => $this->input->post('date'),
					'time'    			  		   => $this->input->post('time')
										);   
		 $mob_no = $this->input->post('mob_no');
			$data1=$this->webservicemodel->insert_message_scheduling($form_data); 
			} 
			{
			$mob_no= 		$mob_no;
			$ran= 				$form_data['message'];
			$sort=				substr($ran, 10); 
			$username = 	urlencode("kailashc");
			$password = 	urlencode("dCUDfNDPXPbVQR");
			$api_id   = 		urlencode("3565960");
			$to       = 			urlencode($mob_no);
			$message  =		urlencode($ran);
						
			file_get_contents("https://api.clickatell.com/http/sendmsg"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
				if( $form_data==TRUE)
			{
				$response['success'] = 1;
				$response['message'] = 'successfully send';
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
}

function message_scheduling_list()
{
	$posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			
					$user_id			   	   = $this->input->post('user_id');		
				
		$form_data = $this->webservicemodel->message_scheduling_list($user_id);
			if($form_data)
			{
				$response['success'] = 1;
				$response['message'] = 'Successfully Display Message Scheduling list.';
				$response['form_data'] = $form_data;
				echo json_encode($response);    
			}
			else
			{
				$response['success'] = 0;
				$response['message'] = 'Message Scheduling List not found.';
				echo json_encode($response);    
			}
		}
}

function delete_message_scheduling()
{
	$posttoken = $this->input->post('token');		
	if($this->webservicemodel->checktoken($posttoken)==TRUE)
	 	{
			
					$msj_id			   	   = $this->input->post('msj_id');		
					
			if($this->webservicemodel->delete_message_scheduling($msj_id))
			{
				$response['success'] = 1;
				$response['message'] = 'Successfully Deleted Message Scheduling.';
				echo json_encode($response);    
			}
			else
			{
				$response['success'] = 0;
				$response['message'] = 'Message Scheduling delete fail.';
				echo json_encode($response);    
			}
		}
}

//end message_scheduling created by sumit 30/01/16


function frndall_list()
	 	{	
			$posttoken = $this->input->post('token');  
			if($this->webservicemodel->checktoken($posttoken)==TRUE)
			{
				$user_id      = $this->input->post('user_id');
				$data =$this->webservicemodel->friend_blocklist($user_id);
				$reject =$this->webservicemodel->friend_rejectlist($user_id);
				//print_r($reject);exit;
				$all_id = $this->webservicemodel->frndsdata($user_id);	   
				   $requested_user = $this->webservicemodel->requested_user($user_id);	
				 $requested_response = $this->webservicemodel->requeste_response($user_id);	
					$allItems = array_merge($data,$reject,$all_id,$requested_user,$requested_response);	
				if($allItems)
					{ 
						$response['success'] = 1;
						$response['message'] = 'Fetched all data of user.';
						$response['form_data'] = $allItems;
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




}
?>
