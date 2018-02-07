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
//Token stop/
	
//creted by dhananjay 15/2/2017
	function getName()
{
//	print_r("check");exit;
	$this->db->select('fullname');
	$this->db->from('sun_user');

	$q=$this->db->get();
	//print_r($q);exit;
	if($q->num_rows()>=1)
	{
		return $q->result();
	}
	else{
		return false;
	}
}
function getNameId($userid)
{
	
	//print_r($userid);exit;
	$this->db->select('*');
	$this->db->from('sun_user');
	$this->db->where('userid',$userid);
	$q=$this->db->get();
	//$result=$q->result_array();
	//print_r($q);exit;
	if($q->num_rows()>=1)
	{
		return $q->result_array();
	}
	else{
		return false;
	}
}

//login start created by dhananjay
function login_data($data,$registration_id)
		 {	//print_r($data);exit;
			$this->db->where('username' , $data['username']);
			$this->db->where('password' , $data['password']);
			$this->db->update('sun_user', $registration_id);
			$this->db->select('*');
			$this->db->from('sun_user');
			$this->db->where('password' , $data['password']);
			$this->db->where('username' , $data['username']);
			
			
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




	
//start register created by dhananjay 
function check_mob($mob_no)
    {
	$this->db->select('mobno');
	$this->db->from('sun_user');
	$this->db->where('mobno', $mob_no);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }

function check_username($username)
    {
	$this->db->select('username');
	$this->db->from('sun_user');
	$this->db->where('username', $username);
	$query = $this->db->get();

        if($query->num_rows() >= 1) 
	{
		return true;
	}
		return false; 
    }
	
	
	
	

	
function register($form_data)
	{
		$this->db->insert('sun_user',$form_data);	
		if ($this->db->affected_rows() == 1)
		{
			 return TRUE;
		}
		else
		{
			return FALSE;	
		}
    }

//end register created by dhananjay    

////supervisor registration backup
	function register11($form_data,$image)
	{
		$this->db->insert('sun_user',$form_data);	
		if ($this->db->affected_rows() == 1)
		{
			 $registration_id = array(
						'regid'              => $this->db->insert_id()
												  ); 
												  
				$logindata= $this->login_data($form_data, $registration_id);
						 
						 foreach($logindata as $arr)
						 {
							 $image['userid']=$arr['userid'];
							 $image['spid']=$arr['supid'];
							 
						 }
						 
				$this->db->insert('sun_thumb',$image);

				if ($this->db->affected_rows() == 1)	
		      {
			          return $logindata;
			          
		        }
				
					else
		      {
		          	return FALSE;	
		        }
		}
			else
		{
			return FALSE;	
		}
    }

//end register created by dhananjay    

	
//start register created by mayuri 

	function registerlabour($form_data)
	{		

		$this->db->insert('sun_user',$form_data);
		if ($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;	
		}		
	}
	
	



//end add profile pic

//end register created by mayuri 











function updateregistration($form_data)
	{
		
				
				$this->db->where('userid',$form_data['userid']);
				$this->db->update('sun_user',$form_data);
				
			
				 	
					if ($this->db->affected_rows() > 0)
					{
					//	print_r("in if"); exit;
						return true;
					}
					else
					{
					//	print_r("in else"); exit;
						return false;	
					}		
    }
	

//end updateregistration


	
//start thumbpunching created by dhananjay 

function thumbpunching($form_data)
{
	//print_r($form_data);exit;
	$this->db->select('*');
	$this->db->from('sun_attendance');
	$this->db->where('datetime', $form_data['datetime']);
	$this->db->where('userid', $form_data['userid']);
	$q = $this->db->get();  
	//print_r($q->result_array() );exit;
//$formateddate=$this->date_format_change($form_data['intime']);
//$formateddate=$this->time_convert(form_data['intime']);
//print_r($form_data['outtime']); exit;
    if ($q->num_rows() >0)
	{
		$data=$q->result_array();
		$givendate=$form_data['datetime'];
		$giventime=$form_data['outtime'];
		$userid=$form_data['userid'];
	//print_r($givendate);
	//print_r($data); exit;
		foreach ($data as $arr) 
			{ 
			$changeddate=$arr['datetime'];
			
			 if($givendate==$changeddate)
				{
					
					$this->db->where('datetime',''.$givendate);
					$this->db->where('userid',''.$userid);
					$this->db->update('sun_attendance', array('outtime' =>$giventime));
					
					if ($this->db->affected_rows() > 0)
					{
					//	print_r("in if"); exit;
						return true;
					}
					else
					{
					//	print_r("in else"); exit;
						return false;	
					}					
				} 
//print_r("in foreach"); exit;
			}
	}
	else{
		$this->db->insert('sun_attendance',$form_data);
		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
			else
		{
			return FALSE;
		}
	}
}

function date_convert($timestamp){
   return date('d/m/Y', $timestamp);
}

function time_convert($timestamp){
   return date('H:i', $timestamp);
}


 function date_format_change($datetime)
  {
		   // $timezone = $datetime;
		    $timezone = new DateTimeZone("Asia/Kolkata" );
			$date = new DateTime();
			$date->setTimeZone($timezone );
			$date->date('l Y/m/d H:i', $timestamp);
			$a=$date->format("d-m-Y");//'21-01-2016';// 
				
			return $a;
			
  }


  //start contact search 
//created by dhananjay 25/2/2017
function labourlist($spid,$status)
		 {	
			$this->db->select('*');
			$this->db->from('sun_user');
		 	$this->db->where('supid',$spid);
		 	$this->db->where('isblocked', '0');
		 	$this->db->where('isdeleted', '0');
		 	$this->db->where('status', $status);
		 //$this->db->limit($limit,$offset);
		
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



 //start labourlistall
//created by dhananjay 25/2/2017
function labourlistall($spid)
		 {	
			$this->db->select('*');
			$this->db->from('sun_user');
		 	$this->db->where('supid',$spid);
		 	$this->db->where('isblocked', '0');
		 	$this->db->where('isdeleted', '0');
		 	
		 //$this->db->limit($limit,$offset);
		
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
//end labourlistall



//Start delete_labour created by mayuri  27/02/17 
    function delete_labour($form_data)
    {
		// $delete = array(
		// 				'isdeleted' 	=> 1
		// 			);
		
		// $this->db->where('userid', $form_data['senderid']);
  //       $this->db->update('sun_user', $delete);
        
		
		// if ($this->db->affected_rows() == 1)
		// {
		// 	return true;
		// }
		// else
		// {
		// 	return false;	
		// }   
		return true;
	}
//end delete_labour created by mayuri  27/02/17



  //start salarycalculation created by dhananjay  3/3/2017

function salarycalculation($form_data)
{
	//print_r($form_data);
	$this->db->select('*');
	$this->db->from('sun_attendance');
	$this->db->where('datetime >=', $form_data['fromdate']);
	$this->db->where('datetime <=', $form_data['todate']);
	$this->db->where('userid', $form_data['userid']);
	$q = $this->db->get();  
	//print_r($q->result_array() );exit;

    if ($q->num_rows() >0)
	{
		$data=$q->result_array();

			return $data;
	}
	else{
	
		return false;
	}
}



function advancecalculation($form_data)
{
	
	
	
	   $query ="select * from sun_advancepay where userid= ".$form_data['userid']." order by advsalid DESC limit 1";

     $res = $this->db->query($query);

    if ($res->num_rows() >0)
	{
		$data=$res->result_array();

			return $data;
	}
	else{
	
		return false;
	}
}
	
	
	//end salarycalculation

  //start gettime created by mayuri 

function gettime($form_data)
{
	//print_r($form_data);exit;
	$this->db->select('*');
	$this->db->from('sun_shift');
	$this->db->where('spid', $form_data['spid']);
	$query = $this->db->get();  
	
    if ($query->num_rows() >0){
		$result=$query->result_array();
		return $result;
	}else{
		return FALSE;
	}
}
  
  
  //start sendextendedtime created by mayuri  3/3/2017

function sendextendedtime($form_data)
{
	
	
	$this->db->where((!empty($form_data['shiftid'])?'shiftid':'spid'), (!empty($form_data['shiftid'])?$form_data['shiftid']:$form_data['spid']));
	$this->db->update('sun_shift', $form_data);
	
	
  	if ($this->db->affected_rows() >0){
  		return true;
  	}else{
  		return false;
  	}
  	
}
//end sendextendedtime
  
  
  
//start savesaldata created by mayuri  3/3/2017

function savesaldata($form_data1,$form_data2)
{
     

	$this->db->insert('sun_advancepay',$form_data1);	
	

		if ($this->db->affected_rows() == 1)
		{
			 $this->db->insert('sun_salary',$form_data2);	
			 if ($this->db->affected_rows() == 1)
		{
			 return true;
		}
			else
		{
			return FALSE;	
		}
		}
			else
		{
			return FALSE;	
		}
    }
			
	//end savesaldata
	



function addleave($form_data)
{
	
	$this->db->select('*');
	$this->db->from('sun_attendance');
	$this->db->where('datetime', $form_data['datetime']);
	$this->db->where('userid', $form_data['userid']);
	$q = $this->db->get();  

    if ($q->num_rows() >0)
	{
						return false;
	}
	else{
		
		if($form_data['userid'] !=0 && $form_data['selfleave'] !=0 )
		{
			$this->db->insert('sun_attendance',$form_data);
		
			if ($this->db->affected_rows() ==1)
			{
				return true;
			}
				else
			{
				return FALSE;
			}
		}
	else{
		$labourlist=$this->labourlist($form_data['spid'],'0');
		foreach($labourlist as $arr)
		{
			$form_data['userid']=$arr['userid'];
		$this->db->insert('sun_attendance',$form_data);
		}
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			else
		{
			return FALSE;
		}
	}
	}
}
//end of addleave	


//created by dhananjay 25/2/2017
function getthumblist($spid)
		 {	
			$this->db->select('*');
			$this->db->from('sun_thumb');
			$this->db->where('spid' , $spid);
		 
		 //$this->db->limit($limit,$offset);
		
	$q = $this->db->get();  
			
	
     if ($q->num_rows() >0)
	{
		$images=$q->result_array();
		foreach($images as $img)
		{
		$images['thumb1']=''.base64_decode($img['thumb']);
		}
		
		//print_r($images);exit;
	return $images;
	}  

	 else
	 {
		return false;
	 } 
} 
//end contact search



//start update_forgot_password created by sumit
	function update_forgot_password($form_data)
  	{
		$this->db->where('mob_no', $form_data['mob_no']);
		$this->db->update('sun_user', $form_data);		
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

  	function insert_notification($form_notification){
	  
	  	$this->db->insert('sun_notification',$form_notification);
	  	return $this->db->insert_id();
	  	
  	}
  	function addadvance($form_data){
	  	
	  	$this->db->where(array('userid' => $form_data['userid'], 'spid' => $form_data['spid']));
	  	$this->db->update('sun_salary', $form_data);		
	  	if ($this->db->affected_rows() == 1)

		{
			return true;
		}
		else
		{
			return false;	
		}
	  	
  	}
  	function forgot_password($form_data){
  	
		$this->db->select('*');
		$this->db->from('sun_user');
		$this->db->where(array('username'=>$form_data['username'],'email'=>$form_data['email']));
		$query = $this->db->get();  
		if($query->num_rows() >0){

			$result=$query->result_array();
			return $result;
		}else{

			return false;
		}	
  	
  	}
}
?>