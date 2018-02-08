<?php
class Home_model extends CI_Model
{
	public function __construct()
	{
		//$this->load->library('database');
		$this->load->library('session');
	 	$this->load->driver('cache');
	}
	public function login_valid($uname,$pass)
	{
		$data=$this->db->where(['username'=>$uname,'password'=>$pass])->get('soyo_users');
		if($data->num_rows() == 1)
		{
			return $data->result();
		}
		else
		{
			return FALSE;
		}
	}
	public function register_user()
	 {
		$uname=$this->input->post('uname');
		$name=$this->input->post('fname')." ".$this->input->post('lname');
		$cat=$this->input->post('category');
		date_default_timezone_set("Asia/Kolkata");
		$format="%Y-%m-%d";
		$date=mdate($format);
		$datestring = '%h:%i %a';
		$time = time();
		$final_time=mdate($datestring, $time);
		$type=0;
		if($cat == 'distributer')
		{
			$type=2;
		}
		else if($cat == 'user')
		{
			$type=3;
		}

		$user_data=array(
		'fname' => $this->input->post('fname'),
		'lname' => $this->input->post('lname'),
		'email' => $this->input->post('email'),
		'mobile' => $this->input->post('mobile'),
		'state' => $this->input->post('state'),
		'dist' => $this->input->post('dist'),
		'type' => $type,
		'username' => $this->input->post('uname'),
		'city' => $this->input->post('city'),
		'password' => $this->input->post('password'),
		'date'=>$date,
		'time'=>$final_time
		);
		
		$check_uname=$this->db->where('username',$uname)->get('soyo_users');
		if($check_uname->num_rows() > 0)
		{
			return FALSE;
		}
		else
			{
				$insert=$this->db->insert('soyo_users',$user_data);
				if($insert)
				{		
					$uid=$this->db->where('username',$uname)->get('soyo_users')->row('user_id');
					$note_data=array('message'=>$name.'has registered. Waiting for your response.',
									'send_to'=>1,
									'send_from'=>$uid,
									'type'=>1);	
					$this->db->insert('soyo_notification',$note_data);		
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
	public function profile_details($uid)
	{
		//$uid=$this->session->userdata('user_id');
		$user_data=$this->db->where('user_id',$uid)->get('soyo_users');
		return $user_data->result();
	}
	public function update()
	{
		$uid=$this->input->post('uid');
		
        
		if(!empty($_FILES['profile_image']['name'])){

                
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['profile_image']['name'];
                 
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                $this->upload->do_upload('profile_image');	
        				        
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            	
        }else{
        	$picture=$this->input->post('profile_image_hidden');
        }
		$data_to_update=array('fname'=>$this->input->post('fname'),
								'lname'=>$this->input->post('lname'),
								'lname'=>$this->input->post('lname'),
								'email'=>$this->input->post('email'),
								'state'=>$this->input->post('state'),
								'dist'=>$this->input->post('dist'),
								'city'=>$this->input->post('city'),
								'mobile'=>$this->input->post('mobile'),
								'profile_image'=>$picture
							);
						
		$result=$this->db->where('user_id',$uid)->update('soyo_users',$data_to_update);
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function destroy_session()
	{
	    $this->session->sess_destroy();
	    $this->cache->clean();
	   	redirect(base_url().'Home_Controller');
	}
	public function get_det($imei)
	{
		$query=$this->db->where('sys_imei',$imei)->get('soyo_user_system');
		return $query->result();
	}
	public function get_det_val()
	{
		$imei=$this->uri->segment(3);
		$data=array('acv1'=>$this->uri->segment(4),
		'acv2'=>$this->uri->segment(5),
		'acv3'=>$this->uri->segment(6),
		'enrg'=>$this->uri->segment(7),
		'lph'=>$this->uri->segment(8)
		);

		$query=$this->db->where('dev_imei',$imei)->update('soyo_device_param',$data);
		if($query)
		{
			return TRUE;
		}
	}
	public function get_notification()
	{
		$uid=$this->session->userdata('user_id');
		$note_data=$this->db->where('send_to',$uid)->get('soyo_notification');
		if($note_data)
		{
			return $note_data->result();
		}
		else
		{
			return FALSE;
		}
	}
}
?>