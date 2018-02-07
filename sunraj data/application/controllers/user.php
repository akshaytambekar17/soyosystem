<?php

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('manufacturers_model');
        $this->load->model('Users_model');
		$this->load->library('notifications');
        $this->load->library('firebase');
    }
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('admin/labours');
        }else{
        	$this->load->view('admin/login');	
        }
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		//$password = $this->__encrip_password($this->input->post('password'));
		$password = $this->input->post('password');
		$is_valid = $this->Users_model->validate($user_name, $password);
		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('admin/labours');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);	
		}
	}	

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
	public function privacy(){
		if($this->session->userdata('user_name')){
			
		 	if ($this->input->server('REQUEST_METHOD') === 'POST'){

		 		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
	            $this->form_validation->set_rules('mobno', 'Mobile number','regex_match[/^[0-9]{10}$/]');
	            $this->form_validation->set_rules('email', 'Email', 'required');
	            $this->form_validation->set_rules('username', 'Username', 'required');
	            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

	            if ($this->form_validation->run()){
	            	if(!empty($this->input->post('password'))){

	            		$form_data=$this->input->post();
	            	}else{
	            		$form_data=array(
	            						'fullname'=>$this->input->post('fullname'),
	            						'username'=>$this->input->post('username'),
	            						'mobno'=>$this->input->post('mobno'),
	            						'email'=>$this->input->post('email'),
	            						);
	            	}

	            	$result=$this->Users_model->updateprivacy($form_data);
	            	if($result){
	            		$this -> session -> set_flashdata('message','Information Updated Successfully....!'); 
                    	redirect('admin/privacy','refresh'); 
	            	}else{
	            		$this -> session -> set_flashdata('message','Information cannot updated successfully something went wrong...!'); 
	            		redirect('admin/privacy','refresh');  
	            	}

	            }else{
	            	$username=$this->session->userdata('user_name');
					$data['userdetails']=$this->Users_model->get_userdetails($username);
				 	$data['main_content'] = 'admin/privacy';
		        	$this->load->view('includes/template', $data);  

	            }

		 	}
			$username=$this->session->userdata('user_name');
			$data['userdetails']=$this->Users_model->get_userdetails($username);
		 	$data['main_content'] = 'admin/privacy';
        	$this->load->view('includes/template', $data);  

        }else{
        	$this -> session -> set_flashdata('message','Something went wrong please login through admin...!'); 
       	}
		

		
	}

}
