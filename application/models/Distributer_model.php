<?php
class Distributer_model extends CI_Model
{
	public function __construct()
	{
		//$this->load->library('database');
		$this->load->library('session');
	 	$this->load->driver('cache');
                if($this->session->userdata('admin')){
                    $session=$this->session->userdata('admin');
                }else if($this->session->userdata('distributor')){
                    $session=$this->session->userdata('distributor');
                }else{
                    $session=$this->session->userdata('user');
                }
	}
	public function add_project($post)
	{  
            //echo "<pre>"; print_r($post); die;
            $insert=$this->db->insert('soyo_projects',$post);
            if($insert){					
                    return TRUE;
            }else{
                    return FALSE;
            }
	}
	public function edit_project($post)
	{  
            $this->db->where('id',$post['id']);
            $update=$this->db->update('soyo_projects',$post);
            if($update){					
                return TRUE;
            }else{
                return FALSE;
            }
	}
	public function delete_project($id)
	{  
            $this->db->where('id',$id);
            if($this->db->delete('soyo_projects')){
                $result=true;
            }else{
                $result=false;
            }
            return $result;
	}
	public function profile_details()
	{
		$uid=$session['user_id'];
		$user_data=$this->db->where('user_id',$uid)->get('soyo_users');
		return $user_data->result();
	}
	public function update($data_to_update)
	{
		$result=$this->db->where('user_id',$session['user_id'])->update('soyo_users',$data_to_update);
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_project_by_id($pid)
	{
		$project_details=$this->db->where('id',$pid)->get('soyo_projects');
		return $project_details->result();
	}
	public function get_all_projects()
	{
            $query = $this->db->get('soyo_projects');
            return $query->result();
        }
	public function get_all_distributer()
	{
		$query = $this->db->where('type','2')->get('soyo_users');

        return $query->result();
	}
	public function get_distributers_by_id($id)
	{
		$query = $this->db->where('user_id',$id)->get('soyo_users');
		return $query->result();
	}
	public function all_distributer()
	{
		$query = $this->db->where('type','2')->get('soyo_users');

        return $query->result_array();
	}
	public function get_all_projects_by_dist_id($id)
	{
		$query=$this->db->where('distributer_id',$id)->get('soyo_projects');
		if($query)
		{
			return $query->result();
		}
		else
			return false;
	}
}
?>