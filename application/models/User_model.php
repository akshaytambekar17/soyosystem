<?php

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	 	$this->load->driver('cache');
	}
	public function get_dev_val()
	{
		$user_session=$this->session->userdata('user');
		$get_imei=$this->db->where('username',$user_session['user_name'])->get('soyo_user_system');
		$get_config=$this->db->where('dev_imei',$get_imei->row('sys_imei'))->get('soyo_device_param');
		return $get_config->result();
	}
	public function get_all_user()
	{
		$query = $this->db->where('type','3')->get('soyo_users');
                return $query->result();
	}
    public function get_soyo_device_param(){
        $this->db->select("*");
        $this->db->from("soyo_device_param");
        $result= $this->db->get();
        return $result->result_array();
    }
    public function get_soyo_device_param_single($data){
        $this->db->select("*");
        $this->db->from("soyo_device_param");
        $this->db->where('dvc_id',$data['device_ime']);
        $result= $this->db->get();
        return $result->result_array();
    }
    public function get_soyo_device_param_multiple(){
        $this->db->select("*");
        $this->db->from("soyo_device_param");
        $result= $this->db->get();
        return $result->result_array();
    }
    public function get_user_by_id($id)
    {
        $query = $this->db->where('user_id',$id)->get('soyo_users');
        return $query->result();
    }
    public function get_user_site_by_id($id)
    {
        $query = $this->db->where('user_id',$id)->get('soyo_user_site_information');
        return $query->result();
    }
    function update_user($data)
    {

        /*$this->db->select('*');
        $this->db->from('soyo_users');
        $this->db->where('user_id !=',$data['user_id'],false);
        $this->db->where('username',$data['username']);
        $query = $this->db->get();
        if(!$query->result()){
            $this->db->where('user_id',$data['user_id']);
            $insert=$this->db->update('soyo_users',$data);
            
            $insert=true;
        }else{
            $insert=false;
        }
        return $insert;*/
        $this->db->select('*');
    	$this->db->from('soyo_users');
    	$this->db->where('user_id !=',$data['user_id'],false);
    	$this->db->where('username',$data['username']);
    	$query = $this->db->get();
        $result=$query->result();
        if(count($result)<=0){
            
            $this->db->where('user_id',$data['user_id']);
            $insert=$this->db->update('soyo_users',$data);
            $insert=true;
    	}else{
            $insert=false;
    	}
        
        return $insert;
    }
    function update_user_site($data)
    {
        $this->db->where('user_id',$data['user_id']);
        if($this->db->update('soyo_user_site_information',$data)){
            return true;
        }else{
            return false;
        }
    }
    function add_user($data)
    {
    	$this->db->insert('soyo_users', $data);
	   $insert_id = $this->db->insert_id();
	   return $insert_id;
    }
    function add_user_site($data)
    {
        if($this->db->insert('soyo_user_site_information', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_all_user_by_distributer($id)
    {
        $this->db->where('type','3');
        $this->db->where('added_by',$id);
        $query =$this->db->get('soyo_users');
        return $query->result();
    }
    public function notify($note_data)
    {
        if($this->db->insert('soyo_notification',$note_data)){
                $insert=true;
            }else{
                $insert=false;  
            }
        return $insert;
    }
    
    function updateuserstatus($status,$id)
    {
        $data=array('status'=>$status);
        $this->db->where('user_id',$id);
        if($this->db->update('soyo_users',$data)){
            return true;
        }else{
            return false;
        }
    }
}   
?>