<?php
class Home_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
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
					if($rows->type == 1)
					{
						$this->session->set_userdata($session_data);
						redirect(base_url().'Admin_Manufracture');
					}
					else if($rows->type == 2)
					{
						$this->session->set_userdata($session_data);
						//$data['main_content'] = 'distributer/distributer_dashboard';
        				//$this->load->view('includes/template',$data);
        				redirect(base_url().'Distributer_Manufracture');
					}
					else 
					{
						$this->session->set_userdata($session_data);
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
		$this->Home_model->destroy_session();
	}
	public function view_notification()
	{
		$query=$this->Home_model->get_notification();
		if($query)
		{
			$data['note']=$query;
			$data['main_content']='admin/notification';
			$this->load->view('includes/header',$data);
		}
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