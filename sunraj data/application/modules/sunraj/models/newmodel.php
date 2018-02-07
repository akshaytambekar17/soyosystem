<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
/* Description: Login model class
 */
class Newmodel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');        
    }

function select_regid($login_id)
    {
        //$this->db->select('registration_id');
        $this->db->select('*');
        $this->db->from('hotel_users');
        $this->db->where('login_id', $login_id);
		$this->db->where('role_id', 1);
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


function selectlogin($data)
    {
        $this->db->select('*');
        $this->db->from('hotel_orders');
        $this->db->where('order_id', $data['order_id']);
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

function select_logid($data)
    {
        $this->db->select('*');
        $this->db->from('hotel_orders');
        $this->db->where('order_id', $data['order_id']);
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


function select_sellerid($unique_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_users');
        $this->db->where('login_id', $unique_id);
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

function selectregid($user_id)
    {
        //$this->db->select('registration_id');
        $this->db->select('*');
        $this->db->from('hotel_users');
        $this->db->where('user_id', $user_id);
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



}
?>