<?php
class Distributer_Manufracture extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->load->model('Admin_model');
		$this->load->model('Distributer_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
	}

	public function index()
	{
		$data['distributers_list']=$this->Home_model->get_distributers_list();
		$data['users_list']=$this->Home_model->get_users_list();
		$data['device_list']=$this->Admin_model->get_device_list();
		$data['product']=$this->Home_model->get_products();
  		$data['main_content'] = 'distributer/distributer_dashboard';
        $this->load->view('includes/header_d',$data);
	}
	public function all_distributer_view()
	{
		$data['distributer']=$this->Distributer_model->get_all_distributer();
		$data['main_content'] = 'admin/list_distributer';
        $this->load->view('includes/header',$data);
	}
	public function add_project_view()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('pname','Project Name','required|alpha');
			//$this->form_validation->set_rules('distributer','Distributer Name','required');
			$this->form_validation->set_rules('state','State','required|alpha');
			$this->form_validation->set_rules('dist','District','trim|required');
			$this->form_validation->set_rules('city','City','required|alpha');
			$this->form_validation->set_rules('systype','System Type','required');
				
			if($this->form_validation->run())
			{
				$insert=$this->Distributer_model->register_project();
				if($insert == 'TRUE')
				{
					$this->session->set_flashdata('Message','Project added successfully..');
					//redirect(base_url().'/'.$regvalue);
					redirect('Distributer_Manufracture/add_project_view','refresh');
				}
				else
				{
					$this->session->set_flashdata('Error','Project not added.');
					redirect('Distributer_Manufracture/add_project_view','refresh');
				}
			}
		}
		$data['prdata']=$this->Distributer_model->all_distributer();
		$data['main_content'] = 'distributer/add_project';
        $this->load->view('includes/header_d',$data);
	}
	public function edit_project_view()
	{
		$data['prdata']=$this->Distributer_model->get_all_projects();
		$data['main_content'] = 'distributer/edit_project';
        $this->load->view('includes/header',$data);
	}
	public function list_project_view()
	{
		//$data['prdata']=$this->Distributer_model->all_distributer();
		$data['main_content'] = 'distributer/list_project';
        $this->load->view('includes/header_d',$data);
	}
}
?>