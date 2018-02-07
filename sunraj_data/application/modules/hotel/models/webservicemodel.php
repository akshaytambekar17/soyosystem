<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
/* Description: Login model class
 */
class Webservicemodel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');        
    }

//Token start//
  function checktoken($posttoken)
	{  
		$sessionToken = "c2VjdXJlZHRva2VuZm9yaW50ZWdyYX";
		
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
	$this->db->from('hotel_users');
	$this->db->where('mob_no', $mob_no);
	$this->db->where('is_deleted', 0);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
	
	function checkemail_id($email_id)
    {
	$this->db->select('email_id');
	$this->db->from('hotel_users');
	$this->db->where('email_id', $email_id);
	$this->db->where('is_deleted', 0);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
	
function register_to_user($form_data)
	{
		$this->db->insert('hotel_users',$form_data);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
    
    
  function add_feedback($form_data)
	{
		$this->db->insert('hotel_feedback',$form_data);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }  
    
    
    

//start check otp created by sumit
 function login_data($data,$registration_id)
		 {	//print_r($data);exit;
			$this->db->where('email_id' , $data['email_id']);
			$this->db->or_where('mob_no' , $data['email_id']);
			$this->db->or_where('login_id' , $data['email_id']);
			$this->db->where('password' , $data['password']);
			$this->db->update('hotel_users', $registration_id);
			$this->db->select('*');
			$this->db->from('hotel_users');
			$this->db->where('password' , $data['password']);
			$this->db->where('email_id' , $data['email_id']);
			$this->db->or_where('mob_no' , $data['email_id']);
			$this->db->or_where('login_id' , $data['email_id']);
			
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
	
		   function selectid($form_data)
		 {	
			$this->db->select('user_id,created_date');
			$this->db->from('hotel_users');
			$this->db->where('mob_no' , $form_data['mob_no']);
			$q = $this->db->get();		
			if ($this->db->affected_rows() >= 0)
			{
				return $q->result();
			}		
			else
			{
				return false;
			}
	}
	
		   function cateselectdata($id)
		 {	
			$this->db->select('*');
			$this->db->from('hotel_productlist');
			$query = $this->db->get();
			$tt[] = $query->result_array();
			$abc = $tt;

			$allItems = array();
			$userid = array(
		'user_id'           => $id
									);	
			foreach ($abc as $re) 
			{
					foreach ($re as $arr) 
				{
						$allItems = array_merge($userid,$arr);
						
				}
			}
		print_r($allItems);
		//print_r($allItems);exit;
		 if($query->num_rows() >= 0) 
		{
            return $allItems;
        }
		else
		{
			return false; 
	    }  
	}
	
		function insertcet($form_data)
	{
		$this->db->insert('hotel_category',$form_data);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
	
	
	function register_subscriber($form_subs)
	{
		$this->db->insert('hotel_subscriber',$form_subs);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
	
	function update_login_id($mob_no,$abc)
   {
		$this->db->where('mob_no', $mob_no);
		$this->db->update('hotel_users', $abc);	
		if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
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
	$this->db->where('is_verify' , 0);
	$this->db->update('bike_users', $data);		
		
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
function select_user_id($data)
		 {	
			$this->db->select('user_id,name,mob_no,email_id,image_path');
			$this->db->from('bike_users');
			$this->db->where('mob_no', $data['mob_no']);
			$this->db->where('is_verify', 1);
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

//start update_forgot_password created by sumit
function update_forgot_password($form_data)
   {
	$this->db->where('mob_no', $form_data['mob_no']);
	$this->db->update('hotel_users', $form_data);		
	if ($this->db->affected_rows() == 1)

	{
		return true;
	}
	else
	{
		return false;	
	}
   } 
//end update_forgot_password created by sumit


	
	function display_product_list()
		 {	
			$this->db->select('*');
			$this->db->from('hotel_category');
			
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

 function DispalySlider()
		 {	
			$this->db->select('*');
			$this->db->from('hotel_slider');
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

//start seller_hotel_list by  created by sumit   03/02/16
	function seller_hotel_list($user_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_category');
        $this->db->where('user_id', $user_id);

	//$this->db->where('is_selected', 0);
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
 //end seller_hotel_list by  created by sumit   03/02/16
function seller_view_user_list($unique_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_users');
       // $this->db->where('user_id !=', $user_id);
        $this->db->where('unique_id', $unique_id);
        $this->db->where('is_deleted', 0);
        $this->db->where('role_id !=', 1);
        $query = $this->db->get();
	//	print_r($this->db->last_query());exit;
        if($query->num_rows() >= 0) 
	{
            return $query->result();
        }
	else
	{
        return false; 
	    }    
}

function employee_view_user_list($unique_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_users');
       // $this->db->where('user_id !=', $user_id);
        $this->db->where('unique_id', $unique_id);
        $this->db->where('is_deleted', 0);
        $this->db->where('role_id', 1);
        $query = $this->db->get();
	//	print_r($this->db->last_query());exit;
        if($query->num_rows() >= 0) 
	{
            return $query->result();
        }
	else
	{
        return false; 
	    }    
}
//start update_user_data by  created by sumit  16/12/15


function subscriber_update_to_seller($form_data,$user_id)
	{
		$subscribedata = array(
							'is_request' 	=> 1
							);
		$delete = array(
							'is_deleted' 	=> 1
							);
		$this->db->where('user_id', $user_id);
		$this->db->update('hotel_subscriber', $subscribedata);		
		$this->db->where('user_id', $user_id);
		$this->db->update('hotel_subscriber', $delete);		
		
		$this->db->insert('hotel_subscriber',$form_data);	
		$this->db->select('*');
        $this->db->from('hotel_subscriber');
		$this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 0);
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


//Start user_delete_to_seller created by sumit  03/02/16
	function user_delete_to_seller($user_id,$delete)
    {
        $this->db->where('user_id', $user_id);
       // $this->db->where('unique_id', $unique_id);
        $this->db->update('hotel_users', $delete);
		//print_r($this->db->last_query());exit;				
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}   
}
//end user_delete_to_seller created by sumit  03/02/16

//start add_hotel_category created by sumit  03/02/16
function add_hotel_category($form_data) 
    {
	$this->db->insert('hotel_category',$form_data);
        
        if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
	    else
			{
			return false; 
			}
    }
//start add_hotel_category created by sumit  03/02/16

//Start update_price_to_category created by sumit  03/02/16
function update_price_to_category($user_id,$category_id,$form_data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('category_id', $category_id);
        $this->db->update('hotel_category', $form_data);
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}   
}
//end update_price_to_category created by sumit  03/02/16

function selectselleritem($form_data) 
    {
	$this->db->insert('hotel_checkseller',$form_data);
        
        if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
	    else
			{
			return false; 
			}
    }

//Start check_box_updated created by sumit  03/02/16
function check_box_updated($user_id,$form_data,$category_id)
    {	
		$category_id= explode(',', $category_id);
		$count=count($category_id);
		//print_r($count);exit;
	   for($i=0;$i<$count;$i++)
		{
		$this->db->where('user_id', $user_id);
        $this->db->where('category_id', $category_id[$i]);
        $this->db->update('hotel_category', $form_data);
		}
		
		$this->db->select('*');
        $this->db->from('hotel_category');
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



function delete_item($user_id,$category_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('category_id', $category_id);
        $this->db->delete('hotel_category');
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}   
}
//end check_box_updated created by sumit  03/02/16
	
//Start delete_category_to_seller created by sumit  03/02/16
function delete_category_to_seller($user_id,$category_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('category_id', $category_id);
        $this->db->delete('hotel_category');
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}   
}
//end delete_category_to_seller created by sumit  03/02/16

//Start view_orderlist_item_seller created by sumit  03/02/16
function view_todays_item_seller($user_id)
    {  
        $this->db->select('*');
        $this->db->from('hotel_category');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_selected', 1);
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
//end view_orderlist_item_seller created by sumit  03/02/16

//Start view_orderlist_item_seller created by sumit  03/02/16
function selected_sellerid($unique_id)
    {  
        $this->db->select('*');
        $this->db->from('hotel_users');
        $this->db->where('login_id', $unique_id);
        //$this->db->where('is_selected', 1);
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

function view_todays_item_user($ads_category_id)
    {  
        $this->db->select('*');
        $this->db->from('hotel_category');
        $this->db->where('ads_category_id', $ads_category_id);
        $this->db->where('stock', 1);	//Modified by Dhananjay
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
//end view_orderlist_item_seller created by sumit  03/02/16

function search_todays_item_user()
    {  
        $this->db->select('*');
        $this->db->from('hotel_category');
       // $this->db->where('ads_category_id', $ads_category_id);
        $this->db->where('stock', 1);	//Modified by Dhananjay
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
//end view_orderlist_item_seller created by mayuri 14/12/16


	
//Start view_orderlist_item_seller created by sumit  03/02/16
function view_orderlist_item_seller($login_id)
    {  
        $this->db->select('a.*,b.full_name,b.address,b.mob_no,b.location,');
        $this->db->from('hotel_orders AS a');
        $this->db->join('hotel_users AS b', 'b.user_id=a.user_id','INNER');		
        $this->db->where('a.login_id', $login_id);
        $this->db->where('a.is_deleted !=', '0');
		
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
//end view_orderlist_item_seller created by sumit  03/02/16

//start booking_to_item created by sumit 03/02/16
function booking_all_amount($form_data) 
    {
	$this->db->insert('hotel_orders',$form_data);
        
        if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
	    else
			{
			return false; 
			}
    }
	
	function select_orders_id($user_id)
    {
        $this->db->select_max ('order_id');
        $this->db->from('hotel_orders');
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

function booking_to_item($data) 
    {
	$this->db->insert('hotel_order_items',$data);
           $this->db->select('*');
        $this->db->from('hotel_order_items');
        $this->db->where('order_id', $data['order_id']);
        $query = $this->db->get();
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }   
		
function select_regid($login_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_users');
        $this->db->where('login_id', $login_id);
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
		

// modified by dhananjay 

		
    /*     if ($this->db->affected_rows() == 1)
			{               
				return true;                  
			}
	    else
			{
			return false; 
			} */
    }
//start booking_to_item created by sumit  03/02/16

//Start user_list_of_all_item created by sumit  04/02/16
function user_list_of_all_item($login_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_category');
        $this->db->where('unique_id', $login_id);
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
//end user_list_of_all_item created by sumit  04/02/16

//Start details_of_user_place_order created by sumit  04/02/16
function details_of_user_place_order_old($category_id)
    {
		$query = $this->db->query("select * from hotel_order_items where category_id  IN($category_id) ");
       
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }    
}


function details_of_user_place_order($order_id)
    { 
		$this->db->select('a.*,b.*');
		$this->db->from('hotel_order_items AS a');
		$this->db->join('hotel_category AS b', 'b.category_id = a.category_id', 'INNER');
		$this->db->where('a.order_id', $order_id);
		$query = $this->db->get();
		// print_r($this->db->last_query());exit;
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }    
}
//end details_of_user_place_order created by sumit  04/02/16

//Start user_cancel_book_item created by sumit  09/02/16
function user_cancel_book_item($category_id,$order_id )
    {
        $this->db->where('category_id', $category_id);
        $this->db->where('order_id ', $order_id );
        $this->db->delete('hotel_order_items');
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}   
	}
	
	
	function selectamount($category_id,$order_id)
    { 
		$this->db->select_sum('total_price');
		$this->db->from('hotel_order_items');
		$this->db->where('order_id', $order_id);
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
	
//end user_cancel_book_item created by sumit  09/02/16


//Start update_quantity for booking item created by sumit  29.03.2016
function update_quantity($form_data,$order_id,$category_id )
   {
		$this->db->where('order_id', $order_id);
		$this->db->where('category_id', $category_id);
		$this->db->update('hotel_order_items', 	$form_data);	
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }

   
   function updatePriceID($order_id,$se,$category_id )
   {		
		$this->db->where('order_id', $order_id);
		$this->db->where('category_id', $category_id);
		$this->db->update('hotel_order_items', 	$se);	
		
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }

   
    function UpdateAmount($order_id,$Amount)
   {		
		$this->db->where('order_id', $order_id);
		$this->db->update('hotel_orders', 	$Amount);	
		
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }

   	
   function SelectPriceID($order_id,$category_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_order_items');
        $this->db->where('order_id', $order_id);
        $this->db->where('category_id', $category_id);
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
 
function SElectcategoryid($category_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_category');
        $this->db->where('category_id', $category_id);
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

function SelectAllCat($order_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_order_items');
        $this->db->where('order_id', $order_id);
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

function desc_order()
    {
       $this->db->select_max('order_id');
        $this->db->from('hotel_orders');
      // $this->db->order_by("order_id","desc");
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

//end update_quantity for booking item created by sumit  29.03.2016

function user_list_of_all_item1($user_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_orders');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted !=', 0);
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


function subscriber_data($user_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_subscriber');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 0);
        //$this->db->where('is_request', 0);
        $query = $this->db->get();	
		$tt[] = $query->result_array();
		$abc = $tt;
	
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone );
		$current_date= $date->format( 'd-m-Y' );
		$Amount = array(
		'current_date'           => $current_date
									);		
				
		$e = array(
			'current_date'           => $date
							);
			
		$allItems = array();
		foreach ($abc as $arr) 
		{ 
			foreach ($arr as $re) 
			{
					$allItems = array_merge($Amount,$re);
			}
		}
        if($query->num_rows() >= 0) 
		{
            return $allItems;
        }
		else
		{
			return false; 
	    }    
}

function update_address($data,$user_id)

   {

		$this->db->where('user_id', $user_id);
		$this->db->update('hotel_users', $data);	
		$this->db->select('*');
        $this->db->from('hotel_users');
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
   
   
   // created by pooja//
   //start//
   
   function seller_registration($form_data)
	{
		$this->db->insert('hotel_users',$form_data);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
//end//


 function update_order_status($data)
   {		
		$this->db->where('order_id',$data['order_id']);
		$this->db->update('hotel_orders',$data);	
		
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }
   
   
   
   function report($data)
    {
     
		$a=$data['from_date'];
		$b=$data['to_date'];
		$query= $this->db->query("SELECT * FROM `hotel_orders` WHERE is_deleted !=0 AND  (order_date BETWEEN '$a' AND '$b')");
	
        if($query->num_rows() >= 0) 
		{
            return $query->result();
        }
		else
		{
			return false; 
	    }    
}
   
   
   
   function offer_list($login_id)
    {
				$this->db->select('*');
				$this->db->from('hotel_offer');
				$this->db->where('login_id', $login_id);
				$this->db->where('is_deleted', 0);
				
				$query = $this->db->get();
			//	print_r($this->db->last_query());exit;
				if($query->num_rows() >= 0) 
			{
					return $query->result();
			}
			else
			{
				return false; 
			}    
	}
	
	
	
	function file_path($user_id)
	{		
		$this->db->select('*');
		$this->db->from('hotel_category');						
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

	
	 function update_hotel_category($form_data)
   {		
		$this->db->where('category_id',$form_data['category_id']);
		$this->db->where('user_id',$form_data['user_id']);
		$this->db->update('hotel_category',$form_data);	
		
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }

   function check_password($conpassword,$user_id)
   {
		$this->db->select('password');
		$this->db->from('hotel_users');
		$this->db->where('password', $conpassword);
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
   
   function check_pass($conpassword)
    {
	$this->db->update('password');
	$this->db->from('hotel_users');
	$this->db->where('password', $conpassword);
	$this->db->where('is_deleted', 0);
	$query = $this->db->get();
    if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }

      function update_password($data,$user_id,$conpassword)
   {
		$this->db->where('user_id', $user_id);
		$this->db->where('password', $conpassword);
		$this->db->update('hotel_users', $data);	
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }
   
   
   function select_category()
	{
		$this->db->select('*');
		$this->db->from('hotel_ads_category');
		$this->db->where('is_deleted', 0);
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
	
	
	function select_sub_category($ads_category_id)
	{
		$this->db->select('*');
		$this->db->from('hotel_ads_sub_category');
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
	
	
	function new_add_hotel_category($form_data)
    {
		$this->db->insert('hotel_category',$form_data);	
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		    else
		{
			return FALSE;	
		}
 }
   
 
  
   function update_stock($data)
   {
	   $this->db->where('category_id',$data['category_id']);
		$this->db->update('hotel_category',$data);	
		
		if ($this->db->affected_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return false;	
		}
   }
 
 
 function add_main_category($form_data)
	{
		$this->db->insert('hotel_ads_category',$form_data);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
	function check_main_cat($category_name,$login_id)
    {
	$this->db->select('*');
	$this->db->from('hotel_ads_category');
	$this->db->where('login_id', $login_id);
	$this->db->where('category_name', $category_name);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
	//created by hrushi
 function add_sub_category($form_data)
	{
		$this->db->insert('hotel_ads_sub_category,',$form_data);	
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;	
		}
    }
	
	function check_sub_cat($ads_category_id,$ads_sub_category_name)
    {
	$this->db->select('*');
	$this->db->from('hotel_ads_sub_category');
	$this->db->where('ads_category_id', $ads_category_id);
	$this->db->where('ads_sub_category_name',$ads_sub_category_name);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
	
	
	
}
?>