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
		$uname=$this->session->userdata('user_name');
		$get_imei=$this->db->where('username',$uname)->get('soyo_user_system');
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
}
?>