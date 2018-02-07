<?php
class Distributer_model extends CI_Model
{
	public function __construct()
	{
		//$this->load->library('database');
		$this->load->library('session');
	 	$this->load->driver('cache');
	}
	public function register_project()
	{
		$project_data=array(
		'd_id' => $this->input->post('distributer'),
		'project_name' => $this->input->post('pname'),
		'project_state' => $this->input->post('state'),
		'project_dist' => $this->input->post('dist'),
		'project_city' => $this->input->post('city'),
		'sys_type' => $this->input->post('systype')
		);
		
		$insert=$this->db->insert('project_data',$project_data);
		if($insert)
		{					
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function profile_details()
	{
		$uid=$this->session->userdata('user_id');
		$user_data=$this->db->where('user_id',$uid)->get('soyo_users');
		return $user_data->result();
	}
	public function update($data_to_update)
	{
		$result=$this->db->where('user_id',$this->session->userdata('user_id'))->update('soyo_users',$data_to_update);
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_project($pid)
	{
		$project_details=$this->db->where('project_id',$pid)->get('project_data');
		return $project_details->result();
	}
	public function get_all_projects()
	{
		$query = $this->db->get('project_data');

        return $query->result_array();
	}
	public function get_all_distributer()
	{
		$query = $this->db->where('type','2')->get('soyo_users');

        return $query->result();
	}
	public function all_distributer()
	{
		$query = $this->db->where('type','2')->get('soyo_users');

        return $query->result_array();
	}
}
?>