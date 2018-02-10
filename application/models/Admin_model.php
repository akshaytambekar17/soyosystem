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
	function add_distributer($data)
    {
    	$this->db->select('*');
    	$this->db->from('soyo_users');
    	$this->db->where('username',$data['username']);
    	$query = $this->db->get();
    	if(!$query->result()){

        	$insert = $this->db->insert('soyo_users', $data);
        	$insert=true;
    	}else{
    		$insert=false;
    	}
        return $insert;
    }
    function update_distributer($data)
    {
    	$this->db->select('*');
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
        return $insert;
    }
    function get_device_list()
    {
    	
		$this->db->select('*');
		$this->db->from('soyo_device');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    function get_device_by_id($id)
    {
    	
		$this->db->select('*');
		$this->db->from('soyo_device');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result(); 
    }
    function get_device_parameters_by_id($id)
    {
    	
		$this->db->select('*');
		$this->db->from('soyo_device_paramters');
		$this->db->where('device_id',$id);
		$query = $this->db->get();
		return $query->result(); 
    }
    
    function add_device($data)
    {
    	
	 	$this->db->insert('soyo_device', $data);
	  	$insert_id = $this->db->insert_id();
       	
        return $insert_id;
    }
    function add_device_paramter($data,$insert_id)
    {
    	foreach ($data as $key => $value) {
    		$data_details=array('name'=>$value,
    							 'device_id'=>$insert_id,
    							);
    		if($this->db->insert('soyo_device_paramters', $data_details)){
    			$insert=true;		
    		}else{
    			$insert=false;		
    		}	
    		# code...
    	}
    	
	 	
        return $insert;
    }
    function update_device($data)
    {
    	$this->db->where('id',$data['id']);
	 	$this->db->update('soyo_device', $data);
	  	$update=true;
        return $update;
    }
    function update_device_paramter($data,$device_id)
    {

    	$this->db->where('device_id',$device_id);
    	$this->db->delete('soyo_device_paramters');

    	foreach ($data as $key => $value) {
    		$data_details=array('name'=>$value,
    							 'device_id'=>$device_id,
    							);
    		if($this->db->insert('soyo_device_paramters', $data_details)){
    			$insert=true;		
    		}else{
    			$insert=false;		
    		}	
    		# code...
    	}
    	
	 	
        return $insert;
    }
    function delete_device($id)
    {
    	$this->db->where('id',$id);
	 	if($this->db->delete('soyo_device')){
	 		$result=true;
	 	}else{
	 		$result=false;
	 	}
	  	
        return $result;
    }
    function get_device_parameters_data()
    {
    	
		$this->db->select('*');
		$this->db->from('soyo_device_param');
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>