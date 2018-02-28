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
		$session=$this->session->userdata('distributer');
		$data['distributers_list']=$this->Home_model->get_distributers_list();
		$data['users_list']=$this->Home_model->get_users_list();
		$data['users']=$this->User_model->get_all_user_by_distributer($session['user_id']);
		$data['device_list']=$this->Admin_model->get_device_list();
		$data['project_list']=$this->Distributer_model->get_all_projects_by_dist_id($session['user_id']);
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
            $this->load->view('includes/header_d',$data);
	}
	public function list_project_view()
	{
	    $session=$this->session->userdata('distributer');
            //$data['projects']=$this->Distributer_model->get_all_projects();
            $data['projects']=$this->Distributer_model->get_all_projects_by_dist_id($session['user_id']);
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

    public function getsalebargraph(){
        $post=$this->input->post();
        $distributer_id=$this->session->userdata('distributer')['user_id'];
        $user_details=$this->User_model->get_user_list_by_added_by($distributer_id,$post['id']);
        $state=$this->Common_model->get_state();
        $result_data=array();
        foreach($state as $state_value){
            $i=0;
            foreach ($user_details as $key => $value) {
                if($state_value['id']==$value->state){
                    $i++;
                    $result_data[$state_value['abbr']]=$i;
                }else{
                    $result_data[$state_value['abbr']]=$i;
                }
            }
        }
        echo json_encode($result_data);
    }    
    public function sales_report()
    {
        $get=$this->input->get();
        if($this->input->post()){
            $post=$this->input->post();
            $this->form_validation->set_rules('project', 'Select Project', 'required');
            //$this->form_validation->set_rules('user', 'Select User', 'required');
            if($this->form_validation->run() == TRUE){
                if(!empty($post['user']))
                {
                    $data['user_details']=$this->User_model->get_all_user_with_user_site_information_by_user($post['user']);        
                    $data['user_id']=$post['user'];
                }
                else
                {
                    $data['user_details']=$this->User_model->get_all_user_with_user_site_information_by_project($post['project']);
                }
                $data['project_id']=$post['project'];
            }else{
                $data['user_details']=$this->User_model->get_all_user_with_user_site_information_by_distributer($get['id']);
            }
            
        }else{
            $data['user_details']=$this->User_model->get_all_user_with_user_site_information_by_distributer($get['id']); 
        }
        $data['device_parameters_data']=$this->Admin_model->get_device_parameters_data();
        $data['projects']=$this->Distributer_model->get_all_projects_by_dist_id($get['id']);
        $data['main_content']='distributer/sales_report';
        $this->load->view('includes/header_d',$data);
    }
     public function get_user_by_project() {
        
        $project=$this->input->post('project'); 
        
        $user= $this ->User_model->get_all_user_by_project($project);
          
        $data=array();
        if($user){
            foreach ($user as $value) { 
                $data2 =' <option data-tokens="'.$value->fname." ".$value->lname.'"  value="'.$value->user_id.'" > '.$value->fname." ".$value->lname.'</option>';
                $data[]=$data2;
            }   
        }else{
            $data='<option>No user Found</option>';
        }
        $html= $data;  

         
        echo json_encode($html);
    }
    public function sale_reports_export() {
        $session=$this->session->userdata('distributer');
        if(!empty($_GET['user_id']) && empty($_GET['project_id'])){
            $user_details = $this->User_model->get_all_user_with_user_site_information_by_user($_GET['user_id']);
        }else if(empty($_GET['user_id']) && !empty($_GET['project_id'])){
            $user_details = $this->User_model->get_all_user_with_user_site_information_by_project($_GET['project_id']);
        }else{
            //$user_details = $this->User_model->get_all_user_with_user_site_information();
            $user_details = $this->User_model->get_all_user_with_user_site_information_by_distributer($session['user_id']);
        }
        
        if (!empty($user_details)) {
            if(!empty($_GET['user_id']) && empty($_GET['project_id'])){
                $name=$user_details[0]->fname."_". $user_details[0]->lname;
            }else if(empty($_GET['user_id']) && !empty($_GET['project_id'])){
                $name= "By_Project_";
            }else{
                $name="All_Users_";
            }
            $filename = $name."_reports_" . rand() . ".csv";
            ob_clean();
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=\"$filename\"");

            $out = fopen("php://output", 'w');
            $flag = false;
            if (!$flag) {
                
                $header=array( 0=>'#',
                               1=>'Name',
                               2=>'Aadhar number',
                               3=>'Device Type',
                               4=>'Device Imei',
                               5=>'Installation Date',
                        );
                fputcsv($out, array_values($header), ',', '"');
                $flag = true;
            }
            $footer=array();
            $flag=false;
            $i=1;
            foreach ($user_details as $value) {
                
                $footer[0]=$i;
                $footer[1]=$value->fname." ". $value->lname;
                $footer[2]=$value->adhar;
                $device_type=$this->Admin_model->get_device_by_id($value->device_type);
                $footer[3]=$device_type[0]->device_name;
                $footer[4]=$value->imei_no;
                $footer[5]=$value->installation_date;
                fputcsv($out, array_values($footer), ',', '"');
                $footer=array();
                $i++;
            }
            fclose($out);
            exit;
        }
    }
    public function sale_reports_pdf_export(){

        if(!empty($_GET['user_id']) && empty($_GET['project_id'])){
            $data['user_details'] = $this->User_model->get_all_user_with_user_site_information_by_user($_GET['user_id']);
        }else if(empty($_GET['user_id']) && !empty($_GET['project_id'])){
            $data['user_details'] = $this->User_model->get_all_user_with_user_site_information_by_project($_GET['project_id']);
        }else{
            $data['user_details'] = $this->User_model->get_all_user_with_user_site_information();
        }
        $this->load->library('M_pdf'); 
        
        $html=$this->load->view('admin/pdf',$data); 
        
        $pdfFilePath ="sales_report_".time().".pdf";        
        
        $stylesheet = '<style>'.file_get_contents('assets/css/bootstrap.min.css').'</style>';
        
        ob_clean();
        $this->m_pdf->pdf->WriteHTML($stylesheet,1,true);
        $this->m_pdf->pdf->WriteHTML($html,true);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $this->m_pdf->pdf->Output($pdfFilePath, "D");

        exit;

    }
}
?>