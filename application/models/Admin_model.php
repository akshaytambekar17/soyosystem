<?php
class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	 	$this->load->driver('cache');
	}
	public function index()
	{
		
	}
	public function get_search()
	{
		$value=$this->input->post('euser');
		$utype=$this->input->post('utype');
		//$value='vish';
		$query=$this->db->where('type',$utype)->like('fname',$value)->get('soyo_users');
		return $query->result();
	}
}
?>