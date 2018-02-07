<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservicemodel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');        
    }

//Token start//
  function checktoken($posttoken)
	{  
		$sessionToken = "c2VjdXJlZHRva2VuZm9yaW50ZWdyY";
		
		if($posttoken == $sessionToken)
		{
			return true;
		}
		else
		{
			return false;
		}
	}  
//Token stop//
	



	
//start register created by sumit 
function check_mob($mob_no)
    {
	$this->db->select('mob_no');
	$this->db->from('pk_user_data');
	$this->db->where('mob_no', $mob_no);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }

function check_email($email)
    {
	$this->db->select('email');
	$this->db->from('pk_user_data');
	$this->db->where('email', $email);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
function register($form_data)
	{
	$this->db->insert('pk_user_data',$form_data);	
	if ($this->db->affected_rows() == 1)
	{
		return true;
	}
        else
	{
		return FALSE;	
	}
    }
function update_mob_no($mob_no,$abc)
   {
	$this->db->where('mob_no', $mob_no);
	$this->db->update('pk_user_data', $abc);		
	if ($this->db->affected_rows() == 1)

	{
		return true;
	}
	else
	{
		return false;	
	}

   } 
//end register created by sumit    

// start view post
//created by yogita:07/10/2015
// reference function view_post
function get_single_user_post_data($all_id)
{	//print_r($all_id);exit;
	$no_of_user = count($all_id);
	for($i=0;$i<$no_of_user;$i++)
	{
	$this->db->distinct();	
	$this->db->select('a.*,b.user_id,f.follow_unfollow_status, b.name as user_name, c.*,d.user_id as friend_id, d.name as friend_name,e.page_name');
	$this->db->from('pk_post AS a');
	$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id ', 'LEFT');
	$this->db->join('pk_photo_gallery AS c', 'c.user_id = b.user_id', 'INNER');	
	$this->db->join('pk_friend_unfriend AS f', 'f.user_id = b.user_id', 'INNER');	
	$this->db->join('pk_user_data AS d', 'd.user_id = a.friend_id', 'LEFT');
	$this->db->join('pk_pages AS e', 'e.page_id = a.page_id', 'INNER');		
	$this->db->where('a.user_id', $all_id[$i]);
	$this->db->where('c.is_profile', 1);	
	//print_r($this->db->last_query());
	$q = $this->db->get();
	
	
	$tt[] = $q->result();

	 }
	
	$allItems = array();
	foreach ($tt as $arr) {
		
	$allItems = array_merge($allItems,$arr);
	
	}

     	if ($q->num_rows() >=0)
	{
		arsort($allItems);
		return $allItems;
	}  
	else
	{
		return false;
	} 
} 

//created by yogita 09/05/2015
// reference function view_post
function get_friendid_of_user($user_id)
{
	$this->db->select('added_friend_id,user_id');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('user_id', $user_id);
	$this->db->where('is_accepted', 4);
	$this->db->where('follow_unfollow_status', 1);
	$q = $this->db->get();  
	
     	if ($q->num_rows() >0)
	{
		$result = array();
		$b = $q->result();
		foreach ($b as $key=>$value)
		{
			$result[]= $value->added_friend_id; 		
		}	
		array_push($result,$user_id);	
		return $result;
		
	}  
	else
	{
		return false;
	} 
} 

function get_single_user_data($user_id)
{	
	$no_of_user = count($user_id);
	for($i=0;$i<$no_of_user;$i++)
	{				
		$this->db->select('a.*,b.user_id , b.name as user_name, c.*,b.user_id as friend_id, b.name as friend_name,d.name as friend_name,e.page_name');
		$this->db->from('pk_post AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = b.user_id', 'INNER');	
		$this->db->join('pk_user_data AS d', 'd.user_id = a.friend_id', 'LEFT');		
		$this->db->join('pk_pages AS e', 'e.page_id = a.page_id', 'INNER');		
		$this->db->where('a.user_id', $user_id);
		$this->db->where('c.is_profile', 1);
		//$this->db->order_by('a.post_id', 'desc');
		$q = $this->db->get();//print_r($user_id[$i]);
		//print_r($this->db->last_query());
		$tt[$i] = $q->result_array();
		$abc = $tt;
        }
		$allItems = array();
		foreach ($abc as $arr) 
	{ 
		$allItems = array_merge($allItems,$arr);
	}
     	if ($q->num_rows() >0)
	{
		//return $allItems;
		arsort($allItems);
		return $allItems;
	}  
	else
	{
		return false;
	}
			
		
		//print_r($allItems);
	
     	if ($q->num_rows() >0)
	{
		//return $allItems;
		arsort($allItems);
		return $allItems;
	}  
	else
	{
		return false;
	}
} 



//start contact search 
//Develop by Team leader-Jadhav
function contact_search($user_id)
		 {	
			$this->db->select('a.name,mob_no, c.image_path');
			$this->db->from('pk_user_data AS a');
			$this->db->join('pk_friend_unfriend AS b', 'b.added_friend_id = a.user_id', 'INNER');
			$this->db->join('pk_photo_gallery AS c', 'b.added_friend_id=c.user_id', 'INNER');
		 	$this->db->where('a.user_id', $user_id);
		 	$this->db->where('c.is_profile', 1);
		
	$q = $this->db->get();  
			
	
     if ($q->num_rows() >0)

	{
	return $q->result_array();
	}  

	 else
	 {
		return false;
	 } 
} 
//end contact search


//created by sumit 7.10.2015
function file_path($user_id)
	{		
		$this->db->select('*');
		$this->db->from('pk_photo_gallery');						
		$this->db->where('user_id',$user_id);		
		$query = $this->db->get();
					
		  if($query->num_rows() == 1) 
		{
			 return $query->result();			
			}  
			else
			{
			 return false;
			}		
			
	}


//end add profile pic



 //start add post like

 function like($form_data)

   { 
   		$this->db->insert('pk_like_unlike',$form_data); 

		$this->db->select('*');

		$this->db->from('pk_like_unlike AS A');
		$this->db->join('pk_user_data AS C', 'C.user_id = A.user_id', 'INNER');
		$this->db->join('pk_pages AS B', 'B.page_id = A.page_id', 'INNER');
		$this->db->join('pk_category AS D', 'D.category_id = A.category_id', 'INNER');
		$this->db->join('pk_post AS E', 'E.post_id = A.post_id', 'INNER');
		$this->db->join('pk_photo_gallery AS F', 'F.photo_id = A.profile_id', 'INNER');
		$this->db->where('A.user_id', $form_data['user_id']);
		$this->db->where('A.page_id', $form_data['page_id']);
		$this->db->where('A.category_id',$form_data['category_id']);
		$this->db->where('A.post_id', $form_data['post_id']);
		$this->db->where('A.profile_id', $form_data['profile_id']);

		 $q = $this->db->get();  
		 if ($this->db->affected_rows() >= 0)

   		{
  			return $q->result_array();
  
		 }  
 		else
 		{

   			 return false;
		 }

	} 

//end add post like


 //dumy function
 function counting_all_like()
	{
        $this->db->select('like_id');
        $this->db->distinct();
        $this->db->from('pk_like_unlike');
		
        $query = $this->db->get();
        return $query->num_rows();
		{
  return $q->result_array();
   }  
 return false;
    } 
 //end dummy function
 
  
//start add_comment
//reference function add_comment
 function add_comment($form_data)
        { 
		 $this->db->insert('pk_comment',$form_data);

					
	if ($this->db->affected_rows() == 1)
	{
		return True;
	}
else
	{
		return FALSE;	
	}
}

function update_total_comment($comment_count,$post_id)
   {	
		$this->db->where('post_id', $post_id);
		$this->db->update('pk_post', array('total_comment' =>$comment_count));		
		if ($this->db->affected_rows() == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}
  } 
  
  function select_comment_name($user_id)
    {    
		$this->db->select('name');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   }
   
  	function notify_to_comment($data)
    {    
		$this->db->select('c.user_id,c.registration_id');
        $this->db->from('pk_post AS a');
	$this->db->join('pk_user_data AS c', 'c.user_id = a.user_id', 'INNER');
	//$this->db->join('pk_friend_unfriend AS d', 'd.user_id = a.user_id', 'INNER');
        $this->db->where('a.post_id', $data['post_id']);
	 $this->db->where('a.user_id !=', $data['user_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   }
   
   function select_user_comment($post_id)
    {
	$this->db->select('comment_id');
	$this->db->from('pk_comment');
	//$this->db->where('user_id', $form_data['user_id']);
	$this->db->where('post_id', $post_id);
	//$this->db->where('profile_id', $form_data['profile_id']);
	$query = $this->db->get();
	//print_r($this->db->last_query());exit;
        if($query->num_rows() >= 1) 
	{
		return $query->result();
	}
		return false; 
    }
//end add-comment


//start add_profile_pic
function view_profile_pic($form_data)
{
		$this->db->select('user_id, image_path');
        $this->db->from('pk_photo_gallery');
        $this->db->where('user_id', $form_data['user_id']);						
		$q = $this->db->get();
		
	   if($q->num_rows() > 0)
        {
            return $q->result_array();
        }		
}

//end add_profile_pic
function check_friend($form_data)
{
	$this->db->select('user_id');
        $this->db->from('pk_friend_unfriend');
        $this->db->where('user_id', $form_data['added_friend_id']);
	$this->db->where('added_friend_id', $form_data['user_id']);
		
        $query = $this->db->get();
     
        if($query->num_rows() == 1) 
	{
            return true;
        }
	else
	{
        	return false; 
	}

		
} 

function insert_user_id($form_data) 
    {
		$this->db->insert('pk_friend_unfriend', $form_data);
											
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
	
function insert_accept_reject_block_request($form_data) 
    {
		$this->db->insert('pk_friend_unfriend', $form_data);
											
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	

function update_accept_reject_block_request($friend_data,$form_data)
{
	$this->db->where('user_id', $form_data['added_friend_id']);	
	$this->db->where('added_friend_id', $form_data['user_id']);		
	$this->db->update('pk_friend_unfriend', $friend_data);		
	if ($this->db->affected_rows() == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}
}

function select_name_user($user_id)
    {
		$this->db->select('name');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() == 1) 
		{
				return $query->result();
		}
		else
		{
				return FALSE; 
		}
   } 

function select_registration_id_to_user($form_data)
    {
		$this->db->select('registration_id');
        $this->db->from('pk_user_data');
		//$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
        $this->db->where('user_id', $form_data['added_friend_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() == 1) 
		{
				return $query->result();
		}
		else
		{
				return FALSE; 
		}
   } 
   

function update_user_status($friend_data,$form_data)
{
	$this->db->where('user_id', $form_data['added_friend_id']);	
	$this->db->where('added_friend_id', $form_data['user_id']);		
	$this->db->update('pk_friend_unfriend', $friend_data);		
	if ($this->db->affected_rows() == 1)

	{
		return true;
	}
	else
	{
		return false;	
	}

} 

function select_reject_delete($form_data)
{
	$this->db->where('added_friend_id', $form_data['user_id']);	
	$this->db->where('is_accepted', 2);	
	//$this->db->where('added_friend_id', $user_data['added_friend_id']);		
	$this->db->delete('pk_friend_unfriend');				
	if ($this->db->affected_rows() == 1)

	{
		return TRUE;
	}
	else
	{
		return FALSE;	
	}
}


function update_unfriend_user($user_data)
{
	$this->db->where('user_id', $user_data['user_id']);	
	$this->db->where('added_friend_id', $user_data['added_friend_id']);		
	$this->db->delete('pk_friend_unfriend');				
	if ($this->db->affected_rows() == 1)

	{
		return TRUE;
	}
	else
	{
		return FALSE;	
	}
}

function update_unfriend_friend($friend_data)
{
	$this->db->where('user_id', $friend_data['user_id']);	
	$this->db->where('added_friend_id', $friend_data['added_friend_id']);		
	$this->db->delete('pk_friend_unfriend');				
	if ($this->db->affected_rows() == 1)

	{
		return TRUE;
	}
	else
	{
		return FALSE;	
	}
}



//start profile_pic like created by Amol 10.10.15   Updated by Yogita 10.10.15   
function check_user_id($form_data)
    {
	$this->db->select('user_id');
        $this->db->from('pk_like_unlike');
        $this->db->where('user_id', $form_data['user_id']);
        $this->db->where('profile_id', $form_data['profile_id']);		
        $query = $this->db->get();
        if($query->num_rows() == 1) 
	{
            return TRUE;
        }
	else
	{
        	return FALSE; 
	}

		
    } 

//insert user_id created by Amol 10.10.15
function insert_user($form_data) 
    {
		$this->db->insert('pk_like_unlike', $form_data);			
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
    }
	 
//show profile pic like created by Yogita 10.10.15

function update_profile_pic($form_data)
       {
		$this->db->where('user_id', $form_data['user_id']);
		$this->db->where('profile_id', $form_data['profile_id']);						
		$this->db->update('pk_like_unlike', $form_data);
					
		if ($this->db->affected_rows() == 1)
		
		{
			return true;
		}
		else
		{
			return false;	
		}

		
        } 


//start add post
//reference function add post
function post($form_data)
		 {	
				$this->db->insert('pk_post',$form_data);			
				
					if ($this->db->affected_rows() == 1)
					{
						return True;
					}
			else
					{
						return FALSE;	
					}
}

function select_name_to_friend($user_id)
    {
		$this->db->select('name');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() == 1) 
		{
				return $query->result();
		}
		else
		{
				return FALSE; 
		}
   } 
   
function view_post_notify_all_friend($form_data)
    {    
	$this->db->select('c.user_id,c.registration_id');
        $this->db->from('pk_friend_unfriend AS a');
	$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
        $this->db->where('a.user_id', $form_data['user_id']);
	$this->db->where('a.is_accepted', 4);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   } 
//end post 
		/*$this->db->select('c.registration_id,c.name');
        $this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
		//$this->db->join('pk_post AS b', 'b.user_id = a.user_id', 'INNER');
        $this->db->where('a.user_id', $form_data['user_id']);
      
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() == 1) 
		{
				return $query->result_array();
		}
		else
		{
				return FALSE; 
		}*/

//start add post created by sumit
function add_photo($form_data)
		 {	
				$this->db->insert('pk_photo_gallery',$form_data);			
				if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return FALSE;	
		}
}
//end post
 
 
 //start select_profile created by sumit 10.10.15	 
function select_profile($user_id)
    {
        $this->db->select('*');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
	{
            return $query->result();
        }
	else{
        return false; 
	    }    
}
//end select_profile created by sumit 10.10.15
	 
//start Profile update created by sumit 9.10.15	 
	 function profile_update($form_data)
       {
		    $this->db->where('user_id', $form_data['user_id']);
			$this->db->update('pk_user_data', $form_data); 		
		if ($this->db->affected_rows() == 1)
				{
					return true;
				}
				else
				{
					return FALSE;	
				}	
        }
		
function notify_to_update_information($form_data)
    {    
		$this->db->select('c.registration_id');
        $this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
        $this->db->where('a.user_id', $form_data['user_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   }
//End Profile update created by sumit 9.10.15
 
 //start select_profile created by sumit 10.10.15	 
function view_multiple_profile($user_id)
    {
        $this->db->select('*');
        $this->db->from('pk_photo_gallery');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_profile !=', 3);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
		{
            return $query->result_array();
        }
		else
		{
			return false; 
	    }    
}
//start select_profile created by sumit 10.10.15	 
function select_profile_pic($user_id)
    {
        $this->db->select('A.user_id,A.photo_id,C.name,C.status,A.image_path,A.is_profile,A.frequency_day');
        $this->db->from('pk_photo_gallery AS A');
        $this->db->join('pk_user_data AS C', 'C.user_id = A.user_id', 'INNER');
        $this->db->where('A.user_id', $user_id);
        $this->db->where('A.is_profile', 1);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
		{
            return $query->result_array();
        }
		else
		{
			return false; 
	    }    
}
function select_profile_data($user_id)
    {
        $this->db->select('*');
        $this->db->from('pk_post');
        $this->db->where('user_id', $user_id);
		$this->db->where('is_profile', 2);
		$this->db->or_where('is_profile', 1);
        $query = $this->db->get();
		//print($this->db->last_query());exit;
        if($query->num_rows() >= 0) 
	{
            return $query->result();
        }
	else{
        return false; 
	    }    
}
 function update_time_is_profile($user_id)
  {
		    $timezone = new DateTimeZone("Asia/Kolkata" );
			$date = new DateTime();
			$date->setTimezone($timezone );	
			$a=$date->format("d-m-Y");//'21-01-2016';// 
			$is_profile = array(	
				'is_profile'   		=> 1
										);
										
			$set_profile = array(	
				'is_profile'   		=> 2
										);			
			$this->db->where('user_id', $user_id);	
			$this->db->update('pk_post', $set_profile); 		
		    $this->db->where('user_id', $user_id);
		    $this->db->where('future_date', $a);	
			$this->db->update('pk_post', $is_profile); 		
		//	 print_r($this->db->last_query());exit;
		 if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return FALSE;	
		}	
  }
//end select_profile created by sumit 10.10.15 
 
function update_multiple_datewise_profile($user_id,$future_date)
	{      
		$is_profile = array(	
			'is_profile'   		=> 2
		       	 );
		$profile = array(	
			'is_profile'   		=> 1
		       	 );
		$this->db->where('user_id', $user_id);
		$this->db->where('is_profile', 1);
		$this->db->where('future_date', $future_date);
		$this->db->update('pk_photo_gallery', $is_profile); 	
			
		 if ($this->db->affected_rows() == 1 )
		{
			return true;
		}
		else
		{
			return FALSE;	
		}	
		
	}

 function update_multiple_datewise_profile1($user_id,$future_date)
	{      
		$profile = array(	
			'is_profile'   		=> 1
		       	 );
			
		$this->db->where('user_id', $user_id);
		$this->db->where('future_date', $future_date);
		//$this->db->where('is_profile', 2);
		$this->db->update('pk_photo_gallery', $profile); 
		//print_r($this->db->last_query());exit;
		 if ($this->db->affected_rows() == 1 )
		{
			return true;
		}
		else
		{
			return FALSE;	
		}	
		
	}
 
//created by sumit 10.10.2015
function add_profile_pic($form_data,$user_id)
	{      
		$is_profile = array(	
			'is_profile'   		=> 0
		       	 );
		
		$this->db->where('user_id', $user_id);
		$this->db->where('is_profile', 1);
		$this->db->update('pk_photo_gallery', $is_profile); 	
		$this->db->insert('pk_photo_gallery',$form_data);
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return FALSE;	
		}
	}
	
	function notify_friend_search($user_id)
	{
		$this->db->select('added_friend_id');
		$this->db->from('pk_friend_unfriend');
		$this->db->where('is_accepted', 4);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
			{			
			return $query->result();
			}		
		else
			{
			return false;
			} 
	}

	function notify_profile_update($is_profile_notify,$added_friend_id)
   {
	   $count=count($added_friend_id);
	   for($i=0;$i<$count;$i++)
		{
	$this->db->where('added_friend_id', $added_friend_id[$i]);
	$this->db->update('pk_friend_unfriend', $is_profile_notify);	
		}	
	if ($this->db->affected_rows() == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}
   }
//end created by sumit 10.10.2015 
 

//start timeline created by sumit 10.10.2015
 function user_timeline($user_id)
	{	
				$this->db->select('a.*,b.status,b.user_id , b.name as user_name, c.*,d.user_id as friend_id, d.name as friend_name');
				$this->db->from('pk_post AS a');
				$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id ', 'LEFT');
				$this->db->join('pk_photo_gallery AS c', 'c.user_id = b.user_id', 'INNER');	
				$this->db->join('pk_user_data AS d', 'd.user_id = a.friend_id', 'LEFT');
				$this->db->where('a.user_id', $user_id);
				$this->db->where('c.is_profile', 1);				
					
				$q = $this->db->get();				
				$tt[] = $q->result_array();
	$abc = $tt;
	 
	$allItems = array();
	foreach ($abc as $arr) { 
	$allItems = array_merge($allItems,$arr);
	}

     	if ($q->num_rows() >0)
	{
		arsort($allItems);
		return $allItems;
	}  
	else
	{
		return false;
	} 
	    }
//end timeline created by sumit 10.10.2015 
 
//start requested_friend_list created by sumit 11.10.15
 function added_friendid($user_id,$is_accepted)
{
        $this->db->distinct();
	$this->db->select('added_friend_id');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('user_id', $user_id);
	$this->db->where('is_accepted', $is_accepted);
	$q = $this->db->get();  
	
     	if ($q->num_rows() >0)
	{
		$result = array();
		$b = $q->result();
		foreach ($b as $key=>$value)
		{
			$result[]= $value->added_friend_id;	//$allItems = array_merge($allItems,$arr);	
		}		
		
	
		return $result; 
	}  
	else
	{
		return false;
	} 
}

function request_accepted_friend_data($all_id, $is_accepted, $user_id)
{	
	$no_of_user = count($all_id);
	//print_r($all_id);
	for($i=0;$i<$no_of_user;$i++)
	{	
        $this->db->distinct();	
		$this->db->select('a.added_friend_id,c.photo_id,b.online_offline,b.status,b.name,b.email,b.mob_no,c.image_path,a.follow_unfollow_status');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');
		//$this->db->join('pk_photo_gallery AS d', 'd.user_id = a.added_friend_id', 'INNER');	
		$this->db->where('a.added_friend_id', $all_id[$i]);
		$this->db->where('a.is_accepted', $is_accepted);
		$this->db->where('c.is_profile', 1);	
		$q = $this->db->get(); 
		
		$tt[$i] = $q->result();
		
	}
	$abc = $tt;
	
		$allItems = array();
		foreach ($abc as $arr) { 
		    $allItems = array_merge($allItems,$arr);
	
		}

	     	if ($q->num_rows() >0)
		{	
			
	    		return $allItems;	
		
		}  
		else
		{
			return false;
		} 
} 
//end requested_friend_list created by sumit 11.10.15

//start friend_with_self list created by sumit 24.02.16
function addedfriendid($user_id,$is_accepted)
{
        $this->db->distinct();
	$this->db->select('added_friend_id');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('user_id', $user_id);
	$this->db->where('is_accepted', $is_accepted);
	$q = $this->db->get();  
	
     	if ($q->num_rows() >0)
	{
		$result = array();
		$b = $q->result();
		foreach ($b as $key=>$value)
		{
			$result[]= $value->added_friend_id;	
		}		
		$id[]=$user_id;
	
		$allItems = array_merge($result,$id);	
	
		return $allItems; 
	}  
	else
	{
		return false;
	} 
}

function friend_with_self($all_id, $is_accepted, $user_id)
{		
	$no_of_user = count($all_id);
	
	for($i=0;$i<$no_of_user;$i++)
	{	
        $this->db->distinct();	
		$this->db->select('a.added_friend_id,c.photo_id,b.online_offline,b.status,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');	
		$this->db->where('a.added_friend_id', $all_id[$i]);
		$this->db->where('a.is_accepted', $is_accepted);
		$this->db->where('c.is_profile', 1);	
		$q = $this->db->get(); 
		$tt[$i] = $q->result();
	}
	$abc = $tt;
		$allItems = array();
		foreach ($abc as $arr) { 
		    $allItems = array_merge($allItems,$arr);
		}
	     	if ($q->num_rows() >0)
		{	
	    		return $allItems;	
		}  
		else
		{
			return false;
		} 
} 
//end friend_with_self list created by sumit 24.02.16

//bookingdeleted start created sumit
 
 
//start comment on profile pic

function comment_on_profile_pic($data)

        { 
		 $this->db->insert('pk_comment',$data);

					
	if ($this->db->affected_rows() == 1)
	{
		return True;
	}
else
	{
		return FALSE;	
	}
}
//end comment on profile pic 
 
 

 
 

//start create page created by sumit 24.10.15
function create_page($form_data)
{
	$this->db->insert('pk_pages', $form_data);
											
		if ($this->db->affected_rows() == 1)
		{
			return True;
		}
		else
		{
			return False;	
		}
}
//end create page  created by sumit 24.10.15

//start view page for only my page
function view_page($user_id)
	{
		$this->db->select('page_id,page_name');
		$this->db->from('pk_pages');
		$this->db->where('is_deleted', 0);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
			{			
			return $query->result_array();
			}		
		else
			{
			return false;
			} 
	} 
//end view page for only my page
 
//start view page (all page) created by sumit
function view_all_page()
	{
		$this->db->select('page_name');
		$this->db->from('pk_pages');
		$this->db->where('is_deleted', 0);
		$this->db->where('follow_unfollow_page', 0/1);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
			{			
			return $query->result_array();
			}		
		else
			{
			return false;
			} 
	} 
//start view page (all page) created by sumit  

//start gallery

function photo_gallery($user_id)
{	
	$base= base_url();  
	$image=$base.'uploads/profile/default.jpg'; 
	$this->db->select('*');
	$this->db->from('pk_photo_gallery');
	$this->db->where('user_id', $user_id);
	$this->db->where('image_path !=', $image);

	$query = $this->db->get();					
	  if($query->num_rows() >= 0) 
	{			
		return $query->result_array();
	}		
	else
	{
		return false;
	} 
}
	

//end comment on profile pic


//start select_share created by sumit 10.10.15	 
function select_post($post_id)
    {
        $this->db->select('*');
        $this->db->from('pk_post');  
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
	{
                return $query->result();
        }
	else
	{
        	return false; 
	}    
}
//end select_share created by sumit 10.10.15

//start add post created by sumit
function insert_share($post_data)
{	
		$this->db->insert('pk_post',$post_data);			
				
                if ($this->db->affected_rows() == 1)
			{
				return true;
			}
	   else
		   {
				return FALSE;	
			}
}

function share_user_name($post_data)
    {
		$this->db->select('name');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $post_data['user_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() == 1) 
		{
				return $query->result();
		}
		else
		{
				return FALSE; 
		}
   } 

function notify_share_post($post_id,$user_id)
    {
	
	$this->db->select('c.registration_id');
        $this->db->from('pk_post AS a');
	$this->db->join('pk_user_data AS c', 'c.user_id = a.user_id', 'INNER');
        $this->db->where('a.post_id', $post_id);
	$this->db->where('a.user_id !=', $user_id);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() >= 1) 
		{
				return $query->result();
		}
		else
		{
				return FALSE; 
		}
   } 
function aselect_registration_id_to_added_friend($form_data)
    {    
		$this->db->select('registration_id');
        $this->db->from('pk_user_data ');
		//$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
        $this->db->where('user_id', $form_data['added_friend_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 1) 
		{
			
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   } 
//end post

//start share_profile created by sumit 10.10.15	 
function share_profile($profile_id)
    {
        $this->db->select('*');
        $this->db->from('pk_photo_gallery'); 
 
        $this->db->where('photo_id', $profile_id);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
	{
                return $query->result();
        }
	else
	{
        	return false; 
	}    
}
//end share_profile created by sumit 10.10.15

//start add post created by sumit
function insert_share_profile($profile_data)
		 {	
		$this->db->insert('pk_post', $profile_data);			
				
                if ($this->db->affected_rows() == 1)
		
			{
				return true;
			}
	  	 else
		   	{
				return FALSE;	
			}
}
//end post

//like created by sumit 8.10.15
//like, unlike, dislike post and profile  
function select_like($form_data)
    {
	$this->db->select('*');
	$this->db->from('pk_like_unlike');
	$this->db->where('user_id', $form_data['user_id']);
	$this->db->where('post_id', $form_data['post_id']);
	$this->db->where('profile_id', $form_data['profile_id']);
	$query = $this->db->get();
	
        if($query->num_rows() >= 1) 
	{
		return true;
	}
	{
	return false; 
    }
	}
	function select_user_id_post_id($form_data)
    {
		$this->db->select('user_id');
		$this->db->from('pk_post');
		$this->db->where('post_id', $form_data['post_id']);
		$query = $this->db->get();
		if($query->num_rows() >= 1) 
		{
			return$query->result();
		}
		else
		{
			return false; 
		}
    }
	
function update_like($form_data)
   {
	$this->db->where('user_id', $form_data['user_id']);
	$this->db->where('post_id', $form_data['post_id']);
	$this->db->where('profile_id', $form_data['profile_id']);
	$this->db->update('pk_like_unlike', $form_data);		
	if ($this->db->affected_rows() == 1)

	{
		return true;
	}
	else
	{
		return false;	
	}
   } 
   
	function update_user_like_post($like_count,$post_id)
   {	
		$this->db->where('post_id', $post_id);
		$this->db->update('pk_post', array('total_like' =>$like_count));		
		if ($this->db->affected_rows() == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}

   } 
   
    function select_update_like_name($user_id)
    {    
		$this->db->select('name');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   }
   
  	function notify_to_update_like($data)
    {    
		$this->db->select('c.*');
        $this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
        $this->db->where('a.user_id', $data['user_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   }
 function insert_like($form_data)
   { 
   		$this->db->insert('pk_like_unlike',$form_data); 
		if ($this->db->affected_rows() >= 0)
   		{
     			 return true;
		 }  
 		else
 		{
			 return false;
		 }
    } 
//end like created by sumit 8.10.2015
//like, unlike, dislike post and profile  
function select_user_like($post_id)
    {
	$this->db->select('like_id');
	$this->db->from('pk_like_unlike');
	//$this->db->where('user_id', $form_data['user_id']);
	$this->db->where('post_id', $post_id);
	$this->db->where('status', 1);
	//$this->db->where('profile_id', $form_data['profile_id']);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return $query->result();
	}
		return false; 
    }

	function update_user_like($like_count,$post_id)
   {	
		$this->db->where('post_id', $post_id);
		$this->db->update('pk_post', array('total_like' =>$like_count));		
		if ($this->db->affected_rows() == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}

   } 
   
   function update_is_like($is_like, $post_id)
   {	
		$this->db->where('post_id', $post_id);
		$this->db->update('pk_post', array('is_user_like' =>$is_like));		
		if ($this->db->affected_rows() == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}

   } 
//start view profile pic like created by sumit
function view_profile_pic_like($data)
	{
		$this->db->select('b.user_id,b.name,c.image_path');
		$this->db->from('pk_like_unlike AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.photo_id = a.profile_id', 'INNER');
		$this->db->where('a.status', 1);
		$this->db->where('c.photo_id', $data['profile_id']);
		$this->db->where('c.is_profile', 1);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 

		
	} 

//end view profile pic like

//start view post like created by sumit
function view_post_like($pid)
	{
		$this->db->select('b.user_id, b.name,d.image_path');
		$this->db->from('pk_like_unlike AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_post AS c', 'c.post_id = a.post_id', 'INNER');
		$this->db->join('pk_photo_gallery AS d', 'd.user_id = a.user_id', 'INNER');
		$this->db->where('c.post_id', $pid);
		$this->db->where('d.is_profile', 1);
		
		$query = $this->db->get();	

		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 

		
	} 

//end view profile pic like
//bookingdeleted start created sumit
function profile_remove2121($form_data)
	       {	
			$is_profile = array(	
			'is_profile'   		=> 0
		       	 );
		
			$this->db->where('photo_id', $form_data['photo_id']);
			$this->db->update('pk_photo_gallery',$is_profile);				
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}
	      }
//bookingdeleted start created sumit
//bookingdeleted start created sumit
function profile_remove($user_id)
	       {	
			$q = $this->db->query("DELETE FROM pk_photo_gallery WHERE user_id = '$user_id' AND is_profile ='1' "); 
		//	print_r($this->db->last_query());exit;
			if ($this->db->affected_rows() >= 0)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}
	      }
//bookingdeleted start created sumit
//start edit post created by sumit
function set_default_profile($default_image)
  {	
	$is_profile = array(	
			'is_profile'   	=> 0
		       	 );
	$this->db->where('user_id', $default_image['user_id']);
	$this->db->update('pk_photo_gallery', $is_profile);	
	//$this->db->where('image_path' ,$default_image['image_path']);
	$this->db->insert('pk_photo_gallery', $default_image);
		if ($this->db->affected_rows() == 1)
	{
		return true;
	}
        else
	{
		return FALSE;	
	}
   }

//start view post like created by sumit
function view_comment_on_post($data)
	{
		$this->db->select('a.comment_id,a.user_id,b.name,c.image_path,a.content,a.image');
		$this->db->from('pk_comment AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.user_id', 'INNER');
		$this->db->where('a.post_id', $data['post_id']);
		$this->db->where('c.is_profile', 1);
		$query = $this->db->get();
		//print_r($this->db->last_query());exit;				
		if($query->num_rows() >= 0) 
			{			
			return $query->result_array();
			}		
		else
			{
			return false;
			} 

		
	} 

//end view profile pic like

//start view comment on profile pic created by sumit
function view_comment_on_profile_pic($data)
	{
		$this->db->select('a.comment_id,a.user_id,b.name,c.image_path,a.content,a.image');
		$this->db->from('pk_comment AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.user_id', 'INNER');
		$this->db->where('a.profile_id', $data['profile_id']);
		$this->db->where('c.is_profile', 1);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
			{
			return $query->result_array();
			}		
		else
			{
			return false;
			} 

		
	} 

//end view profile pic like

//start check otp created by sumit
 function check_otp($form_data)

		 {	
			$this->db->select('*');
			$this->db->from('pk_user_data');
			$this->db->where('mob_no' , $form_data['mob_no']);
			$q = $this->db->get();		
			if ($this->db->affected_rows() >= 0)
			{
				return $q->result_array();

			}		
			else
			{
				return false;
			}
	}
//end
//start update verified created by sumit
function update_verified($data)
   {
	$this->db->where('mob_no', $data['mob_no']);
	$this->db->where('otp_code' , $data['otp_code']);
	$this->db->where('is_verified' , 0);
	$this->db->update('pk_user_data', $data);		
		
	if ($this->db->affected_rows() >= 0)
	{
		return true;

	}		
	else
	{
		return false;
	}
   }


function select_user_id($data)

		 {	
			$this->db->select('user_id');
			$this->db->from('pk_user_data');
			$this->db->where('mob_no', $data['mob_no']);
			$this->db->where('is_verified', 1);
			$q = $this->db->get();
			if ($this->db->affected_rows() >= 0)
			{
				return $q->result_array();

			}		
			else
			{
				return false;
			}
	}	

//end

function updated_user_id($user_id,$mob_no)
		 {	
			$this->db->select('user_id');
			$this->db->from('pk_user_data');
			$this->db->where('mob_no', $mob_no);
			$this->db->where('is_verified', 1);
			$q = $this->db->get();
		
			if ($this->db->affected_rows() >= 0)
			{
				return $q->result_array();

			}		
			else
			{
				return false;
			}
	}	

//start default image created by sumit
function default_image($default_image)
{
	$this->db->insert('pk_photo_gallery', $default_image);
	if ($this->db->affected_rows() == 1)
			{
				return true;
			}
	   else
		   {
				return FALSE;	
			}
 }
//end
//start update otp code created by sumit
function update_otp_code($form_data)
   {
	$this->db->where('mob_no', $form_data['mob_no']);
	$this->db->update('pk_user_data', $form_data);		
	if ($this->db->affected_rows() == 1)

	{
		return true;
	}
	else
	{
		return false;	
	}

   } 
//end 

//start update verified created by sumit
function update_user_id($data,$mob_no)
   {
	$this->db->where('mob_no', $mob_no);
	$this->db->update('pk_user_data', $data);			
	if ($this->db->affected_rows() >= 0)
	{
		return true;

	}		
	else
	{
		return false;
	}
   }
//end

//start post deleted created by sumit
function post_delete($form_data)
	       {
			$this->db->where('post_id', $form_data['post_id']);
			$this->db->delete('pk_post');
							
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}

		
	      }
//start post deleted created by sumit

//start photo_delete created by sumit
function photo_delete($photo_id)
{        
		$q = $this->db->query("DELETE FROM pk_photo_gallery WHERE photo_id IN ($photo_id) "); 
		$this->db->select('photo_id');
        $this->db->from('pk_photo_gallery');
        $this->db->where('photo_id', $photo_id);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
		{
            return True;
        }
		else
		{	
        return false; 
	    } 
}
//start edit post created by sumit
function edit_post($user_id,$post_id,$form_data)
   {
	$this->db->where('user_id', $user_id);
	$this->db->where('post_id', $post_id);
	$this->db->update('pk_post', $form_data);		
	if ($this->db->affected_rows() == 1)

	{
		return true;
	}
	else
	{
		return false;	
	}

   } 
//end edit post

//start profile created by sumit
function comment_delete($form_data)
	       {
			$this->db->where('comment_id', $form_data['comment_id']);
			$this->db->delete('pk_comment');		
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}

		
	      }
//start profile created by sumit
//start view page for only my page
function all_user($user_id)
	{
		$this->db->select('a.user_id,a.name,a.status,c.image_path');
		$this->db->from('pk_user_data AS a');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.user_id', 'INNER');		
		$this->db->where('c.is_profile', 1);
		$this->db->where("a.user_id !=",$user_id);
		$query = $this->db->get();
		if($query->num_rows() >= 0) 
			{			
			return $query->result_array();
			}		
		else
			{
			return false;
			} 
	} 
//end view page for only my page
//start follow_unfollow created by sumit 02/11/15	 
	 function follow_unfollow($form_data)
       {
		        $this->db->where('user_id', $form_data['user_id']);
			$this->db->where('added_friend_id', $form_data['added_friend_id']);
			$this->db->update('pk_friend_unfriend', $form_data); 		

			  if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return FALSE;	
		}	
        }
//End follow_unfollow created by sumit 02/11/15
//start all friend search created by sumit 3.11.15
function all_friend_search($name,$user_id )
{	
        $this->db->distinct();
		$this->db->select('a.user_id,c.photo_id,a.name,a.status,a.mob_no,c.image_path');
		$this->db->from('pk_user_data AS a');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.user_id', 'INNER'); 
		//$this->db->join('pk_friend_unfriend AS b', 'b.user_id = a.user_id', 'INNER'); 
	 	$this->db->like('a.name', $name);
		$this->db->or_like('a.mob_no', $name);
		$this->db->where('c.is_profile', 1);
		$this->db->where('a.is_verified', 1);
		//$this->db->where('b.is_accepted', 3);
		$this->db->where('a.user_id  !=',$user_id);
		$q = $this->db->get(); 
		//print_r($this->db->last_query());exit;
	        if ($q->num_rows() >0)
		{
			return $q->result_array();
		}  
		 else
		 {
			return false;
		 } 
} 
//End all friend search created by sumit 3.11.15
//start make profile pic created by sumit 4.11.15

function profile_photo_delete1($user_id)
{
			
			$this->db->where('is_profile', 2);
			//$this->db->or_where('is_profile', 1);
			$this->db->where('user_id', $user_id);
			$this->db->delete('pk_photo_gallery');		
			//print_r($this->db->last_query());exit;
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}
}


function make_profile_pic($form_data,$user_id)
	{      
		$is_profile = array(	
			'is_profile'   		=> 3
		       	 );
		$this->db->where('user_id', $user_id);
		$this->db->where('is_profile', 1);
		$this->db->update('pk_photo_gallery', $is_profile); 
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}

	function make_profile_pic_img_path($photo_id,$user_id)
    {    
		$this->db->select('image_path');
		$this->db->from('pk_photo_gallery');
        $this->db->where('user_id', $user_id);
        $this->db->where('photo_id', $photo_id);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   }
	
function make_profile_update($form_data, $user_id)
	{      
		$is_profile = array(	
			'is_profile'   		=> 1
		       	 );
		$this->db->where('photo_id', $form_data['photo_id']);
		$this->db->where('user_id', $user_id);
		$this->db->where('is_profile', 3);	
		$this->db->update('pk_photo_gallery',$is_profile);
	
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
//End make profile pic created by sumit 4.11.15
//start requested_friend_list created by sumit 11.10.15
 function select_friend($user_id,$is_accepted)
{
	$this->db->select('user_id');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('added_friend_id', $user_id);
	$this->db->where('is_accepted', $is_accepted);
	$q = $this->db->get();  
     	if ($q->num_rows() >0)
	{
		$result = array();
		$b = $q->result();
		foreach ($b as $key=>$value)
		{
			$result[]= $value->user_id;		
		}		
		
		return $result;
	}  
	else
	{
		return false;
	} 
}
//end requested_friend_list created by sumit 11.10.15

//start requested_friend_list created by sumit 11.10.15
function request_accepted_user($all_id, $is_accepted, $user_id)
{		
	$no_of_user = count($all_id);
	
	for($i=0;$i<$no_of_user;$i++)
	{		
		$this->db->select('a.user_id,a.added_friend_id,a.is_accepted, b.name,b.email,b.mob_no, c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.user_id', 'INNER');		
		$this->db->where('a.user_id', $all_id[$i]);
		$this->db->where('a.is_accepted', $is_accepted);
		//$this->db->where('c.is_profile', 1);
		$this->db->where('a.added_friend_id', $user_id);
		$this->db->order_by('a.friend_id', 'desc');
		$q = $this->db->get(); 
		
		$tt[$i] = $q->result();
		$abc = $tt;
	 }
	
		$allItems = array();
		foreach ($abc as $arr) { 
		    $allItems = array_merge($allItems,$arr);
	
		}

	     	if ($q->num_rows() >0)
		{			
	    		return $allItems;	
		
		}  
		else
		{
			return false;
		} 
} 
//end requested_friend_list created by sumit 11.10.15
//start requested_friend_list created by sumit 11.10.15
 function added_userid($added_friend_id,$is_accepted)
{
        $this->db->distinct();
	$this->db->select('user_id');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('added_friend_id', $added_friend_id);
	$this->db->where('is_accepted', $is_accepted);
	$q = $this->db->get();  
	
     	if ($q->num_rows() >0)
	{
		$result = array();
		$b = $q->result();
		foreach ($b as $key=>$value)
		{
			$result[]= $value->user_id;		
		}		
		
		return $result; 
	}  
	else
	{
		return false;
	} 
}
//end requested_friend_list created by sumit 11.10.15

//start requested_friend_list created by sumit 11.10.15
function request_accepted_user_data($all_id, $is_accepted, $added_friend_id)
{
	$no_of_user = count($all_id);
	for($i=0;$i<$no_of_user;$i++)
	{	 $this->db->distinct();	
		$this->db->select('a.user_id,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.user_id', 'INNER');	
		$this->db->where('a.user_id', $all_id[$i]);
		$this->db->where('a.is_accepted', $is_accepted);
		$this->db->where('c.is_profile', 1);	
		
		$q = $this->db->get(); 
		$tt[$i] = $q->result();
		
		 }
		$abc = $tt;
		$allItems = array();
		foreach ($abc as $arr) { 
		    $allItems = array_merge($allItems,$arr);
	
		}

	     	if ($q->num_rows() >0)
		{	
	    		return $allItems;	
		
		}  
		else
		{
			return false;
		} 
} 

function friend_request_count($user_id,$is_accepted)
    {
	$this->db->select('*');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('added_friend_id', $user_id);
	$this->db->where('is_accepted', $is_accepted);
	$query = $this->db->get();
	//print_r($this->db->last_query());
        if($query->num_rows() >= 1) 
	{
		return $query->result();
	}
		return false; 
    }

 //start send_friend_request created by sumit 8.10.2015
function check_friend_request($form_data)
    {
	$this->db->select('*');
	$this->db->from('pk_friend_unfriend');
	$this->db->where('user_id', $form_data['user_id']);
	$this->db->where('added_friend_id', $form_data['added_friend_id']);
	$query = $this->db->get();
//print_r($this->db->last_query());
        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
function send_friend_request($form_data)
	{
	$this->db->insert('pk_friend_unfriend',$form_data);	
	if ($this->db->affected_rows() == 1)
	{
		return true;
	}
        else
	{
		return FALSE;	
	}
    }
	
	function select_name_for_user($form_data)
    {
		$this->db->select('name');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $form_data['user_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() >=  1) 
		{
				return $query->result();
		}
		else
		{
				return FALSE; 
		}
   } 
   
	
	function select_registration_id_to_added_friend($form_data)
    {    
		$this->db->select('registration_id');
        $this->db->from('pk_user_data ');
		//$this->db->join('pk_user_data AS c', 'c.user_id = a.added_friend_id', 'INNER');
        $this->db->where('user_id', $form_data['added_friend_id']);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() > 0) 
		{
			
				return $query->result(); 
		}
		else
		{
				return FALSE; 
		}
   } 
		
	
//end send_friend_request created by sumit 8.10.2015
//start page delete created by sumit 25.11.15
function page_delete($form_data)
	       {
			//$this->db->where('user_id', $user_id);
			$this->db->where('page_id', $form_data['page_id']);
			$this->db->delete('pk_pages');				
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}

		
	      }
//End page delete created by sumit 25.11.15

function get_page_name($page_id)
    {
    	
	$this->db->select('page_name');
	$this->db->from('pk_pages');
	$this->db->where('page_id', $page_id);
	$q = $this->db->get();
			
        if ($q->num_rows() >0)
		{
		return $q->result_array();
		}  
	else{
		return false; 
		}
		
    }
//Start select_block_list created by sumit 30.11.15
function select_block_list($is_accepted, $added_friend_id)
{		
		$this->db->select('b.user_id,c.photo_id,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.user_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = b.user_id', 'INNER');	
		$this->db->where('a.added_friend_id', $added_friend_id);
		$this->db->where('a.is_accepted', $is_accepted);
		$this->db->where('c.is_profile', 1);	
		$q = $this->db->get(); 
		//print_r($this->db->last_query());
		if ($q->num_rows() >0)
		{	
	    return $q->result();
		}  
		else
		{
			return false;
		} 
}
//End select_block_list created by sumit 30.11.15
//start select ads on chat page created by sumit 30.11.15
function select_ads($page)
	{
		
		$this->db->select('*');
		$this->db->from('pk_ads');
		$this->db->where('is_deleted', 0);
		$this->db->where('page', $page);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result();
		}		
		else
		{
			return false;
		} 

		
	} 
//End select ads on chat page created by sumit 30.11.15
//start unblock url created by sumit 30/11/15
function unblock($user_id,$form_data)
{
			$this->db->where('user_id', $user_id);
			$this->db->where('added_friend_id', $form_data['added_friend_id']);
			$this->db->delete('pk_friend_unfriend');		
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}
}
//End unblock url created by sumit 30/11/15
//start post advertisement created by sumit 1.12.15
function post_advertisement($form_data)
    { //print_r($form_data);exit;
		$this->db->insert('pk_advertisement',$form_data);	
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		    else
		{
			return FALSE;	
		}
 }
 
 function edit_post_advertisement($form_data,$ads_id) 
    {
		//$this->db->where('user_id' ,$user_id);
		$this->db->where('ads_id' ,$ads_id);
		$this->db->update('pk_advertisement',$form_data);
			if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
			else
			{
				return false; 
			}
    }
//End post advertisement created by sumit 1.12.15
//start view post advertisement created by sumit 1.12.15
function view_post_advertisement($ads_sub_category_id )
	{
		$this->db->select('a.*,c.ads_sub_category_name');
		$this->db->from('pk_advertisement AS a');
		$this->db->join('pk_ads_sub_category AS c', 'c.ads_sub_category_id = a.ads_sub_category_id', 'INNER');
		$this->db->where('a.ads_sub_category_id ',   $ads_sub_category_id);
		$this->db->where('a.is_deleted', 0);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		}
	} 
	
	function area_wise_view_post_advertisement($ads_sub_category_id,$area)
	{
		$this->db->select('*');
		$this->db->from('pk_advertisement');
		$this->db->where('ads_sub_category_id ',   $ads_sub_category_id);
		$this->db->like('area ',   $area);
		$this->db->where('is_deleted', 0);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 

		
	} 
//End view post advertisement created by sumit 1.12.15
//start delete advertisement created by sumit 1.12.15
function delete_post_advertisement($ads_id)
	{
			//$this->db->where('user_id', $user_id);
			$this->db->where('ads_id',  $ads_id);
			$this->db->delete('pk_advertisement');		
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}
	} 
//End delete post advertisement created by sumit 1.12.15
//start select area created by sumit 1.12.15
function select_area($city_id)
	{
		$this->db->select('*');
		$this->db->from('pk_area');
		$this->db->where('city_id', $city_id);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 

		
	} 
//End select area created by sumit 1.12.15
//start select city created by sumit 1.12.15
function select_city()
	{
		$this->db->select('*');
		$this->db->from('pk_cities');
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 
	} 
//End select city created by sumit 1.12.15

//start select category created by sumit 1.12.15
function select_category()
	{
		$this->db->select('*');
		$this->db->from('pk_ads_category');
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result();
		}		
		else
		{
			return false;
		} 
	} 
//End select category created by sumit 1.12.15

//start select category created by sumit 1.12.15
function select_ads_sub_category($ads_category_id)
	{
		$this->db->select('*');
		$this->db->from('pk_ads_sub_category');
		$this->db->where('ads_category_id', $ads_category_id);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result();
		}		
		else
		{
			return false;
		} 
	} 
//End select category created by sumit 1.12.15
//created by sumit 10.10.2015
function profile_photo_delete($user_id)
{
			
			$this->db->where('is_profile', 2);
			$this->db->or_where('is_profile', 1);
			$this->db->where('user_id', $user_id);
			$this->db->delete('pk_photo_gallery');		
			//print_r($this->db->last_query());exit;
			if ($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
			{
				return FALSE;	
			}
}
//end post
//start add post created by sumit
function add_multiple_profile_pic($form_data)
{	
		$this->db->insert('pk_photo_gallery',$form_data);		
		$this->db->select('*');
		$this->db->from('pk_photo_gallery');
		$this->db->where('user_id' ,$form_data['user_id']);
		//$this->db->where('sequence' , 1,);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 
		
}
//end post
//end created by sumit 10.10.2015 
function deleteq()
{
	$this->db->where('user_id', 7922022);	
	$this->db->delete('pk_post');		
}

function delete_message_scheduling($msj_id)
{
	$this->db->where('msj_id', $msj_id);	
	$this->db->delete('pk_message_schedule');		
	if ($this->db->affected_rows() == 1)
		{
				return true;
		}
		else
		{
			return false;	
		}
}

//start feedback1
 function feedback($form_data) 
    {
	$this->db->insert('pk_feedback',$form_data);
        
        if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
	    else
			{
			return false; 
			}
    }

//Start select all friend  display list created by sumit date 8/1/16	
function friend_display_list()
{
		$this->db->select('a.*,b.*');
		$this->db->from('pk_user_data AS a');
		$this->db->join('pk_photo_gallery AS b', 'b.user_id = a.user_id', 'INNER');
		//$this->db->join('pk_friend_unfriend AS c', 'c.user_id = a.user_id', 'INNER');
		$this->db->where('a.is_verified' ,1);
		//$this->db->where('a.user_id !=' ,$user_id);
		$this->db->where('b.is_profile' ,1);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 
} 
//Start select all friend  display list created by sumit date 8/1/16	
//start ofline online status update created by sumit 8.1.16
function user_online_offline($form_data,$user_id) 
    {
		$this->db->where('user_id' ,$user_id);
		$this->db->update('pk_user_data',$form_data);
       // if ($this->db->affected_rows() == 1)
			if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
			else
			{
				return false; 
			}
    }
//end ofline online status update created by sumit 8.1.16


function notify($fields)
	{
		$this->db->select('*');
		$this->db->from('pk_user_data');
		$this->db->where('device_id' ,$fields['device_id']);
		$query = $this->db->get();				
		if($query->num_rows() >= 0) 
		{			
			return $query->result_array();
		}		
		else
		{
			return false;
		} 
	} 
	
//start  select_send_mob_no by sumit 10.10.15	 
function select_friend_id_mob_no($form_data)
    {
        $this->db->select('mob_no');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $form_data['friend_id']);
        $this->db->where('is_verified', 1);
        $query = $this->db->get();
		//print_r($this->db->last_query());
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }    
}

function select_user_id_mob_no($form_data)
    {
        $this->db->select('mob_no');
        $this->db->from('pk_user_data');
        $this->db->where('user_id', $form_data['user_id']);
        $this->db->where('is_verified', 1);
        $query = $this->db->get();
		//print_r($this->db->last_query());
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }    
}
//end select_profile created by sumit 10.10.15
function insert_message_scheduling($form_data)
	{
		$this->db->insert('pk_message_schedule',$form_data);	
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
	
function message_scheduling_list($user_id)
    {
        $this->db->select('a.*,b.*');
        $this->db->from('pk_message_schedule as a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.friend_id', 'INNER');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.is_deleted', 1);
        $query = $this->db->get();
		//print_r($this->db->last_query());exit;
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }    
}




function frndsdata($user_id)
{	
		
       	$this->db->distinct();	
	$this->db->select('a.friend_id,a.user_id,a.added_friend_id,c.photo_id,a.is_accepted,b.online_offline,b.status,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');	
		//$this->db->where('a.user_id', $user_id);
		$this->db->where('a.added_friend_id', $user_id);
		$this->db->where('a.is_accepted', 4);
		//$this->db->or_where('is_accepted', 1);
		$this->db->where('c.is_profile', 1);	
		$query = $this->db->get(); 
		
		

	     	if ($query->num_rows() >=0)
		{	
	    		return $query->result();
		
		}  
		else
		{
			return false;
		} 
} 

function friend_blocklist($user_id)
{	
        	$this->db->distinct();	
	$this->db->select('a.friend_id,a.user_id,a.added_friend_id,c.photo_id,a.is_accepted,b.online_offline,b.status,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');	
		$this->db->where('a.is_accepted', 3);	
		$this->db->where('c.is_profile', 1);
		$this->db->where('a.added_friend_id', $user_id);
		$this->db->or_where('a.user_id', $user_id);
		$this->db->where('a.is_accepted', 3);	
		$this->db->where('c.is_profile', 1);
		
		
		$query = $this->db->get(); 
		
		

	     	if ($query->num_rows() >=0)
		{	
	    		return $query->result();
		
		}  
		else
		{
			return false;
		} 
}


function friend_rejectlist($user_id)
{	
        	$this->db->distinct();	
	$this->db->select('a.friend_id,a.user_id,a.added_friend_id,c.photo_id,a.is_accepted,b.online_offline,b.status,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');	
		$this->db->where('a.is_accepted', 2);
		$this->db->where('c.is_profile', 1);
		$this->db->where('a.added_friend_id', $user_id);
		$this->db->or_where('a.user_id', $user_id);
		$this->db->where('a.is_accepted', 2);
		$this->db->where('c.is_profile', 1);	
		$query = $this->db->get(); 
		
		

	     	if ($query->num_rows() >=0)
		{	
	    		return $query->result();
		
		}  
		else
		{
			return false;
		} 
}


function requested_user($user_id)
{	
        	$this->db->distinct();	
	$this->db->select('a.friend_id,a.user_id,a.added_friend_id,c.photo_id,a.is_accepted,b.online_offline,b.status,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');	
		//$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.is_accepted', 1);
		//$this->db->or_where('is_accepted', 1);
		$this->db->where('c.is_profile', 1);	
		$query = $this->db->get(); 
		
		

	     	if ($query->num_rows() >=0)
		{	
	    		return $query->result();
		
		}  
		else
		{
			return false;
		} 
}


function requeste_response($user_id)
{	
        	$this->db->distinct();	
		$this->db->select('a.friend_id,a.user_id,a.added_friend_id,c.photo_id,a.is_accepted,b.status,b.name,b.email,b.mob_no,c.image_path');
		$this->db->from('pk_friend_unfriend AS a');
		$this->db->join('pk_user_data AS b', 'b.user_id = a.added_friend_id', 'INNER');
		$this->db->join('pk_photo_gallery AS c', 'c.user_id = a.added_friend_id', 'INNER');	
		$this->db->where('a.added_friend_id', $user_id);
		$this->db->where('a.is_accepted', 1);
		$this->db->where('c.is_profile', 1);	
		$query = $this->db->get(); 
		//print_r($this->db->last_query());exit;
	     	if ($query->num_rows() >=0)
		{	
	    		return $query->result();
		
		}  
		else
		{
			return false;
		} 
}

function selectfriend($form_data)
    {
	$this->db->select('*');
        $this->db->from('pk_friend_unfriend');
        $this->db->where('user_id', $form_data['user_id']);
	$this->db->where('is_accepted', 4);
        $query = $this->db->get();
	//print_r($this->db->last_query());exit;
        if($query->num_rows() >= 0) 
		{
			return $query->result();
		}
		else
		{
			return FALSE; 
		}
   }



}
?>
