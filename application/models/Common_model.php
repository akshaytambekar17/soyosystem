<?php
class Common_model extends CI_Model
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
	public function get_state()
	{
		$this->db->select('*');
		$this->db->from('soyo_state');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function get_device_manufacture()
	{
		$this->db->select('*');
		$this->db->from('soyo_drive_manufacture');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function get_drive_manufacture_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('soyo_drive_manufacture');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result(); 
	}
	public function get_district_by_state($state)
	{
		$this->db->select('*');
		$this->db->from('soyo_district');
		$this->db->where('state_id',$state);
		$query = $this->db->get();
		return $query->result_array(); 
	}
}
?>