<?php
class Home_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		/*$this->load->model('Home_model');
		$this->load->model('Admin_model');
		$this->load->model('Common_model');
		$this->load->model('User_model');*/
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
		//$this->load->model('User_model');
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function registration()
	{
		$this->load->view('registration');
	}
	public function login()
	{

		if(!empty($_GET['id'])){
			$user_data=$this->User_model->get_user_by_id($_GET['id']);
			$session_data=array('user_id'=>$user_data[0]->user_id,
                                            'user_fname'=>$user_data[0]->fname,
                                            'user_lname'=>$user_data[0]->lname,
                                            'user_email'=>$user_data[0]->email,
                                            'user_name'=>$user_data[0]->username,
                                            'user_type'=>$user_data[0]->type);
			
			if($user_data[0]->type == 1){
				$this->session->sess_expiration = '300'; // 5 Minutes
			   	$this->session->sess_expire_on_close = 'true';
				$this->session->set_userdata('admin',$session_data);
				redirect(base_url().'Admin_Manufracture');
			}else if($user_data[0]->type == 2){
				$this->session->sess_expiration = '60'; // 15 Minutes
			   	$this->session->sess_expire_on_close = 'true';
				$this->session->set_userdata('distributer',$session_data);
                redirect(base_url().'Distributer_Manufracture');
			}else {
				$this->session->sess_expiration = '60'; //5 Minutes
			  	$this->session->sess_expire_on_close = 'true';
			  	$this->session->set_userdata('user',$session_data);
			  	//echo "<pre>"; print_r($this->session->all_userdata());die;
                redirect(base_url().'User_Manufracture');
			}

		}
		$this->form_validation->set_rules('uname','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		
		if($this->form_validation->run())
		{
			$uname=$this->input->post('uname');
			$password=$this->input->post('password');
			
			$login_result=$this->Home_model->login_valid($uname,$password);
			//$rows=$login_result->row_array();
			$data['user']=null;
			if($login_result)
			{
				
				$data['user']=$login_result;
				$session_data=array();
				foreach($data['user'] as $rows)
				{
					$session_data=array('user_id'=>$rows->user_id,
									'user_fname'=>$rows->fname,
									'user_lname'=>$rows->lname,
									'user_email'=>$rows->email,
									'user_name'=>$rows->username,
									'user_type'=>$rows->type);
					if($rows->type == 1){
						$this->session->set_userdata('admin',$session_data);
                                                //echo  "<pre>"; print_r($this->session->userdata('admin')); die;
						redirect(base_url().'Admin_Manufracture');
					}else if($rows->type == 2){
						$this->session->set_userdata('distributer',$session_data);
						redirect(base_url().'Distributer_Manufracture');
					}else {
						$this->session->set_userdata('user',$session_data);
						redirect(base_url().'User_Manufracture');
					}

				}
			}
			else
			{
				$this->session->set_flashdata('login_fail_invaliduser','Please enter valid Username and Password...');
				redirect(base_url().'Home_Controller');
			}
		}
		else
		{
			redirect(base_url().'Home_Controller');
		}
	}

	public function register()
	{
		$this->form_validation->set_error_delimiters('<h6 class="text-danger">','</h6>');
		$this->form_validation->set_rules('fname','First name','required|alpha');
		$this->form_validation->set_rules('lname','Last name','required|alpha');
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('mobile','Mobile','required|numeric');
		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('state','State','required|alpha');
		$this->form_validation->set_rules('dist','District','required|alpha');
		$this->form_validation->set_rules('city','City','trim|required|alpha');
		$this->form_validation->set_rules('uname','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('c_password','Confirm password','trim|required|matches[password]');
			
		if($this->form_validation->run())
		{
			$insert=$this->Home_model->register_user();
			if($insert == 'TRUE')
			{
				$this->session->set_flashdata('registration_success','Registration Successfull.');
				//redirect(base_url().'/'.$regvalue);
				redirect(base_url().'Admin_Manufracture/add_distributer_view');
			}
			else
			{
				$this->session->set_flashdata('registration_fail','Registration Fail. Please check your connection or you have enetered username is already exist.');
				redirect(base_url().'Admin_Manufracture/add_distributer_view');
			}
		}
		else
		{
			redirect(base_url().'Admin_Manufracture/add_distributer_view');
		}
	}
	public function logout()
	{
		$utype=$this->uri->segment(3);
		if($utype == 1){
			$this->session->unset_userdata('admin');
		}else if($utype == 2){
			$this->session->unset_userdata('distributer');
		}else{
			$this->session->unset_userdata('user');
		}
		//echo "<pre>"; print_r($this->session->all_userdata()); die;
		$this->load->view('login');
		//$this->Home_model->destroy_session();
	}
	public function view_notification()
	{
		$query=$this->Home_model->get_notification();
		if($query){
			$data['note']=$query;
			$data['main_content']='admin/notification';
			$this->load->view('includes/header',$data);
		}
	}
	public function list_notification()
	{
		$query=$this->Home_model->get_notifications();
		if($query){
			$this->Home_model->update_notifcations_by_view();
		}
		$data['notifications']=$query;
		$data['main_content']='admin/list_notifications';
		$this->load->view('includes/header',$data);
		
	}
	public function get_notify()
	{
		$query=$this->Home_model->get_notification();
		if($query)
		{
			$data['note']=$query;
			$data['main_content']='admin/notification';
			$this->load->view('includes/heaere',$data);
		}
	}
}
?>