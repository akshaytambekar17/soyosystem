<?php
class Distributer_Manufracture extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->load->model('Distributer_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
	}

	public function index()
	{
  		$data['main_content'] = 'distributer/distributer_dashboard';
        $this->load->view('includes/template',$data);
	}
	public function all_distributer_view()
	{
		$data['dist']=$this->Distributer_model->get_all_distributer();
		$data['main_content'] = 'admin/list_distributer';
        $this->load->view('includes/header',$data);
	}
	public function add_project_view()
	{
		$data['prdata']=$this->Distributer_model->all_distributer();
		$data['main_content'] = 'distributer/add_project';
        $this->load->view('includes/header',$data);
	}
	public function edit_project_view()
	{
		$data['prdata']=$this->Distributer_model->get_all_projects();
		$data['main_content'] = 'distributer/edit_project';
        $this->load->view('includes/header',$data);
	}
	public function new_project()
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
				$this->session->set_flashdata('project_added','Project added successfully..');
				//redirect(base_url().'/'.$regvalue);
				$this->add_project_view();
			}
			else
			{
				$this->session->set_flashdata('project_add_fail','Project is not added. Please try again');
				$this->add_project_view();
			}
		}
		else
		{
			$this->add_project_view();
		}
	}
	public function view_project($pid)
	{
		$project_details['pdata']=$this->Distributer_model->get_project($pid);
		return $project_details;
	}
	public function get_projects()
	{
		$data['projectdata']=$this->Distributer_model->get_all_projects();
		return $data;
		//print_r($data);
		//redirect('Distributer_Manufracture/add_project_view',$data);
	}
}
?>