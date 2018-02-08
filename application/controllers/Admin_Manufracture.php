<?php
class Admin_Manufracture extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->view('includes/include');
		$this->load->model('Home_model');
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
	 	$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
  		$data['main_content'] = 'admin/admin_dashboard';
  		$this->load->view('includes/template',$data);
	}
	public function profile()
	{
		if(isset($_POST['select_user'])){
			$uid=$this->input->post('uid');
			$utype=$this->input->post('utype');
		}else{

			$uid=$this->uri->segment(3);
		}

		$data['user_details']=$this->Home_model->profile_details($uid);
		if($this->session->userdata('user_id') == $uid){
			$data['main_content']='profile';
		}else{
			if($utype == 2){
				$data['main_content']='admin/edit_distributer';
			}else{
				$data['main_content']='admin/edit_user';
			}
		}

		$this->load->view('includes/header',$data);
	}
	public function add_distributer_view()
	{
		$data['main_content']='admin/add_distributer';
		$this->load->view('includes/header',$data);
	}
	public function edit_distributer_view()
	{
		$data['main_content']='admin/edit_distributer';
		$this->load->view('includes/header',$data);
	}
	public function edit_user_view()
	{
		$data['main_content']='admin/edit_user';
		$this->load->view('includes/header',$data);
	}
	public function update_profile()
	{
		$uid=$this->input->post('uid');
		$utype=$this->input->post('utype');

		$update_result=$this->Home_model->update();
		if($update_result){
			$this->session->set_flashdata('update_success','Information Updated Successfully');
		}else{
			$this->session->set_flashdata('update_success','Information Not Updated');
		}
		if($this->session->userdata('user_id') == $uid){
			redirect("Admin_Manufracture/profile/".$this->session->userdata('user_id'));
		}
		else{
			if($utype == 2){
				redirect('Admin_Manufracture/edit_distributer_view');
			}else{
				redirect('Admin_Manufracture/edit_user_view');
			}
			
		}
		
	}
	public function get_details()
	{
		$imei=$this->uri->segment(3);
		//$imei=866762020580492;
		$data=array();
		if($this->Home_model->get_det($imei))
		{
			echo "get";
			$data['d']=$this->Home_model->get_det($imei);
			foreach($data['d'] as $row)
			{
				//echo $row->username;
				//echo $row->password;
				redirect(base_url().'Admin_Manufracture/display/?uname='.$row->username.'&pass='.$row->password);
			}
			//redirect()
		}
	}
	public function display()
	{
		echo "Username = ".$this->uri->segment(3);
		echo "Password = ".$this->uri->segment(4);
	}
	public function put_val()
	{
		//$imei=866762020580492;
		//$data=array();
		if($this->Home_model->get_det_val())
		{
			echo "Value inserted seuccessfully...!";
		}
	}
	public function search_user()
	{
		$data['user']=$this->Admin_model->get_search();
		$data['main_content']='admin/edit_distributer';
		$this->load->view('includes/header',$data);
	}
}
?>