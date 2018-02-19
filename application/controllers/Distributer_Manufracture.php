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
            if($this->input->post()){
                    $post=$this->input->post();
                    //echo "<pre>"; print_r($post); die;
                    $this->form_validation->set_rules('name','Project Name','required');
                    $this->form_validation->set_rules('state_id','State','required');
                    $this->form_validation->set_rules('district_id','District','required');
                    $this->form_validation->set_rules('city','City','required');
                    $this->form_validation->set_rules('description','Description','required');
                    if($this->form_validation->run()==TRUE){
                        $data=array( 'id'=>$post['id'],
                                    'name'=>$post['name'],    
                                    'state_id'=>$post['state_id'],    
                                    'district_id'=>$post['district_id'],    
                                    'description'=>$post['description'],    
                                    'city'=>$post['city'],    
                                    'created_at'=>$post['created_at'],
                                    'distributer_id'=>$this->session->userdata('distributer')['user_id'],
                                );
                        $insert=$this->Distributer_model->add_project($data);
                        if($insert){
                            $this->session->set_flashdata('Message','Project added successfully.');
                            redirect('Distributer_Manufracture/add_project_view','refresh');
                        }else{
                            $this->session->set_flashdata('Error','Project not added.');
                            redirect('Distributer_Manufracture/add_project_view','refresh');
                        }
                    }
            }
            $data['state']=$this->Common_model->get_state();	
            $data['prdata']=$this->Distributer_model->all_distributer();
            $data['main_content'] = 'distributer/form_project';
            $this->load->view('includes/header_d',$data);
	}
	public function edit_project_view()
	{
            $get=$this->input->get();
            if($this->input->post()){
                    $post=$this->input->post();
                    //echo "<pre>"; print_r($post); die;
                    $this->form_validation->set_rules('name','Project Name','required');
                    $this->form_validation->set_rules('state_id','State','required');
                    $this->form_validation->set_rules('district_id','District','required');
                    $this->form_validation->set_rules('city','City','required');
                    $this->form_validation->set_rules('description','Description','required');
                    if($this->form_validation->run()==TRUE){
                        $data=array( 'id'=>$post['id'],
                                    'name'=>$post['name'],    
                                    'state_id'=>$post['state_id'],    
                                    'district_id'=>$post['district_id'],    
                                    'description'=>$post['description'],    
                                    'city'=>$post['city'],    
                                );
                        $update=$this->Distributer_model->edit_project($data);
                        if($update){
                            $this->session->set_flashdata('Message','Project Edit successfully.');
                            redirect('Distributer_Manufracture/list_project_view','refresh');
                        }else{
                            $this->session->set_flashdata('Error','Project not edited.');
                            redirect('Distributer_Manufracture/add_project_view','refresh');
                        }
                    }
                    $get['id']=$post['id'];
            }
            $data['state']=$this->Common_model->get_state();	
            $data['project_details']=$this->Distributer_model->get_project_by_id($get['id']);
            $data['main_content'] = 'distributer/form_project';
            $this->load->view('includes/header',$data);
	}
	public function list_project_view()
	{
            $data['projects']=$this->Distributer_model->get_all_projects();
            //echo "<pre>"; print_r($data['projects']); die;
            $data['main_content'] = 'distributer/list_project';
            $this->load->view('includes/header_d',$data);
	}
        public function delete_project()
	{
            if(!empty($_GET['id'])){
                $delete=$this->Distributer_model->delete_project($_GET['id']);
                if($delete){
                    $this->session->set_flashdata('Message','Project Deleted successfully.');
                }else{
                    $this->session->set_flashdata('Error','Project not deleted.');
                }
            }
            redirect('Distributer_Manufracture/list_project_view','refresh');
	}
}
?>