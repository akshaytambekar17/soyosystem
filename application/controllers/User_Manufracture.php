<?php
class User_Manufracture extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->view('includes/include');
        $this->load->model('User_model');
        $this->load->model('Home_model');
       $this->load->library('form_validation');
        //$this->load->helper('form');
        
        //$this->load->library('validation');
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    public function index()
    {
            $session=$this->session->userdata('user');
            $data['dev_val']=$this->User_model->get_dev_val();
            $data['product']=$this->Home_model->get_products();
            $data['user_sites']=$this->User_model->get_user_site_by_user_id($session['user_id']);
            if(isset($_GET['site_id'])){
                $details=$this->User_model->get_latest_user_site_by_site_id($_GET['site_id']);
                $data['latest_user_sites']=array_slice($details, 0, 23, true);
            }else{
                $details=$this->User_model->get_latest_user_site_by_user_id($session['user_id']);
                $data['latest_user_sites']=array_slice($details, 0, 23, true);
            }
            $data['main_content'] = 'user/user_dashboard';
            $this->load->view('includes/header_u',$data);
    }
    public function refresh_view()
    {
        $this->load->view('user/user_dashboard');
    }
    public function add_user()
    {
        $get=$this->input->get();
        if($this->input->post()){
            //echo "<pre>"; print_r($this->input->post());die;
            $this->form_validation->set_rules('fname','First Name','trim|required');
            $this->form_validation->set_rules('lname','Last Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            $this->form_validation->set_rules('mobile','Mobile Number','trim|required|numeric');
            $this->form_validation->set_rules('adhar','Aadhaar','trim|required');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('state','State','required');
            $this->form_validation->set_rules('dist','District','required');
            $this->form_validation->set_rules('project_id','Project','required');
            $this->form_validation->set_rules('city','City','trim|required|alpha');
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Password','required');

            /*$this->form_validation->set_rules('location','Location','trim|required|alpha');
            $this->form_validation->set_rules('owner','Owner','trim|required|alpha');
            $this->form_validation->set_rules('solar_panel','Solar Panel','trim|required');
            $this->form_validation->set_rules('pump','Pump','trim|required');
            $this->form_validation->set_rules('pipe_height','Pump Height ','trim|required|numeric');
            $this->form_validation->set_rules('pipe_diameter','Pump Diameter','trim|required|numeric');
            $this->form_validation->set_rules('no_lbows','No of Elbows','trim|required|numeric');
            $this->form_validation->set_rules('installer','Installer','trim|required|alpha');
            $this->form_validation->set_rules('warranty','Warranty','trim|required|numeric');
            $this->form_validation->set_rules('project','Device type','required');
            $this->form_validation->set_rules('imei_no','IMEI No','required|numeric');
            $this->form_validation->set_rules('drive_model_no','Drive Model No','trim|required');
            $this->form_validation->set_rules('drive_manufacture','Drive Manufacture','required');
            */

            if($this->form_validation->run() == TRUE){
                
            
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
//                if(!empty($_FILES['site_image']['name'])){
//
//                    
//                    $config['upload_path'] = './assets/uploads/';
//                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
//                    $config['file_name'] = $_FILES['site_image']['name'];
//                     
//                    //Load upload library and initialize configuration
//                    $this->load->library('upload',$config);
//                    $this->upload->initialize($config);
//                    $this->upload->do_upload('site_image');  
//                                    
//                    $uploadData = $this->upload->data();
//                    $site_picture= $uploadData['file_name'];
//                    
//                }else{
//                    $site_picture=$this->input->post('site_image_hidden');
//                }
                $data_user=array(  'fname'=>$this->input->post('fname'),
                                    'lname'=>$this->input->post('lname'),
                                    'username'=>$this->input->post('username'),
                                    'password'=>$this->input->post('password'),
                                    'email'=>$this->input->post('email'),
                                    'mobile'=>$this->input->post('mobile'),
                                    'address'=>$this->input->post('address'),
                                    'adhar'=>$this->input->post('adhar'),
                                    'state'=>$this->input->post('state'),
                                    'dist'=>$this->input->post('dist'),
                                    'city'=>$this->input->post('city'),
                                    'project_id'=>$this->input->post('project_id'),
                                    'type'=>3,
                                    'profile_image'=>$picture,
                                    'date'=>date("Y-m-d"),
                                    'time'=>date("h:i:sa"),
                                    'created_at'=>date('Y-m-d h:i:sa'),
                                    'added_by'=>$this->session->userdata('distributer')['user_id']
                                    );
                $insert_id=$this->User_model->add_user($data_user);
//                $data_user_site=array(  
//                                        'user_id'=>$insert_id,
//                                        'location'=>$this->input->post('location'),
//                                        'owner'=>$this->input->post('owner'),
//                                        'solar_panel'=>$this->input->post('solar_panel'),
//                                        'pump'=>$this->input->post('pump'),
//                                        'pipe_height'=>$this->input->post('pipe_height'),
//                                        'pipe_diameter'=>$this->input->post('pipe_diameter'),
//                                        'no_lbows'=>$this->input->post('no_lbows'),
//                                        'installer'=>$this->input->post('installer'),
//                                        'installation_date'=>date('Y-m-d h:i:sa'),
//                                        'warranty'=>$this->input->post('warranty'),
//                                        'project'=>$this->input->post('project'),
//                                        'imei_no'=>$this->input->post('imei_no'),
//                                        'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
//                                        'drive_model_no'=>$this->input->post('drive_model_no'),
//                                    );
//                $result=$this->User_model->add_user_site($data_user_site);
                if($insert_id){
                    $d_id=$this->session->userdata('distributer');
                    $note_data=array('send_from'=>$d_id['user_id'],
                                        'send_to'=>1,
                                        'message'=>$d_id['user_fname'].' '.$d_id['user_lname'].' added new user '.$this->input->post('fname').' '.$this->input->post('lname'),
                                        'created_at'=>date("Y-m-d h:i:sa"),
                                        'user_id'=>$insert_id,
                                        'view'=>0,
                                        'status'=>0, 
                                    );

                    $this->User_model->notify($note_data);

                    $this ->session-> set_flashdata('Message','Profile Added Successfully'); 
                    //redirect('User_Manufracture/add_user?user_type='.$get['user_type'],'refresh');
                    redirect('User_Manufracture/add_user?user_type=2','refresh');
                }else{
                    $this ->session-> set_flashdata('Error','Username already exist');
                    $get['user_type']=2;
                }
            }else{
                $get['user_type']=2;
            }
        }
        $data['state']=$this->Common_model->get_state();    
        $data['device_manufacture']=$this->Common_model->get_device_manufacture();  
        $data['projects']=$this->Distributer_model->get_all_projects(); 
        $data['main_content']='user/form_user';
        if($get['user_type']==1){
            $this->load->view('includes/header',$data);
        }else if($get['user_type']==2){
            $this->load->view('includes/header_d',$data);
        }else{
            $this->load->view('includes/header_u',$data);
        }
    }
    public function edit_user()
    {
        $get=$this->input->get();
        
        if($this->input->post()){
            //echo "<pre>"; print_r($this->input->post()); die;
            $this->form_validation->set_rules('fname','First Name','trim|required');
            $this->form_validation->set_rules('lname','Last Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            $this->form_validation->set_rules('mobile','Mobile Number','trim|required|numeric');
            $this->form_validation->set_rules('adhar','Aadhaar','trim|required');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('state','State','required');
            $this->form_validation->set_rules('dist','District','required');
            $this->form_validation->set_rules('project_id','Project','required');
            $this->form_validation->set_rules('city','City','trim|required|alpha');
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Password','required');
            
            if($this->form_validation->run() == TRUE){
                
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
                $data_user=array(  'fname'=>$this->input->post('fname'),
                                    'lname'=>$this->input->post('lname'),
                                    'username'=>$this->input->post('username'),
                                    'password'=>$this->input->post('password'),
                                    'email'=>$this->input->post('email'),
                                    'mobile'=>$this->input->post('mobile'),
                                    'address'=>$this->input->post('address'),
                                    'adhar'=>$this->input->post('adhar'),
                                    'state'=>$this->input->post('state'),
                                    'dist'=>$this->input->post('dist'),
                                    'city'=>$this->input->post('city'),
                                    'profile_image'=>$picture,
                                    'user_id'=>$this->input->post('user_id'),
                                    );
                $result=$this->User_model->update_user($data_user);
//                $data_user_site=array(  
//                                        'user_id'=>$this->input->post('user_id'),
//                                        'location'=>$this->input->post('location'),
//                                        'owner'=>$this->input->post('owner'),
//                                        'solar_panel'=>$this->input->post('solar_panel'),
//                                        'pump'=>$this->input->post('pump'),
//                                        'pipe_height'=>$this->input->post('pipe_height'),
//                                        'pipe_diameter'=>$this->input->post('pipe_diameter'),
//                                        'no_lbows'=>$this->input->post('no_lbows'),
//                                        'installer'=>$this->input->post('installer'),
//                                        'warranty'=>$this->input->post('warranty'),
//                                        'project'=>$this->input->post('project'),
//                                        'imei_no'=>$this->input->post('imei_no'),
//                                        'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
//                                        'drive_model_no'=>$this->input->post('drive_model_no'),
//                                    );
                //$result=$this->User_model->update_user_site($data_user_site);
                if($result){
                    $this ->session-> set_flashdata('Message','Profile Updated Successfully'); 
                    redirect('User_Manufracture/edit_user?id='.$this->input->post('user_id').'&user_type='.$this->input->post('user_type'),'refresh');
                }else{
                    $this ->session-> set_flashdata('Error','Username already exist'); 
                }
            }

        }
        $data['user_details']=$this->User_model->get_user_by_id($get['id']);
        $data['user_site_details']=$this->User_model->get_user_site_by_id($get['id']);
        $data['state']=$this->Common_model->get_state();    
        $data['device_manufacture']=$this->Common_model->get_device_manufacture();  
        $data['projects']=$this->Distributer_model->get_all_projects(); 
        $data['get_user_type']=$get['user_type'];   
        $data['main_content']='user/form_user';
        if($get['user_type']==1){
            $this->load->view('includes/header',$data);
        }else if($get['user_type']==2){
            $this->load->view('includes/header_d',$data);
        }else{
            $this->load->view('includes/header_u',$data);
        }
    }
    public function all_user_view()
    {
        $get=$this->input->get();
        if($get['user_type']==1){
            $data['user']=$this->User_model->get_all_user();
        }
        if($get['user_type']==2){
            $data['user']=$this->User_model->get_all_user_by_distributer($this->session->userdata('distributer')['user_id']);
        }
        $data['device_param']=$this->User_model->get_soyo_device_param();
        $data['main_content'] = 'user/list_user';
        $data['user_type']=$get['user_type'];
        if($get['user_type']==1){
            $this->load->view('includes/header',$data);
        }else if($get['user_type']==2){
            $this->load->view('includes/header_d',$data);
        }else{
            $this->load->view('includes/header_u',$data);
        }
    }
    public function add_user_site()
    {
        $get=$this->input->get();
        if($this->input->post()){
            
            
            $this->form_validation->set_rules('location','Location','trim|required');
            $this->form_validation->set_rules('site_name','Site Name','trim|required');
            $this->form_validation->set_rules('solar_panel','Solar Panel','trim|required');
            $this->form_validation->set_rules('pump','Pump','trim|required');
            $this->form_validation->set_rules('pipe_height','Pump Height ','trim|required|numeric');
            $this->form_validation->set_rules('pipe_diameter','Pump Diameter','trim|required|numeric');
            $this->form_validation->set_rules('no_lbows','No of Elbows','trim|required|numeric');
            $this->form_validation->set_rules('installer','Installer','trim|required');
            $this->form_validation->set_rules('warranty','Warranty','trim|required|numeric');
            $this->form_validation->set_rules('imei_no','IMEI No','required');
            $this->form_validation->set_rules('vfd_type','VFD Type','trim|required');
            $this->form_validation->set_rules('device_type','Device Type','required');
            

            if($this->form_validation->run() == TRUE){
                
                if(!empty($_FILES['site_image']['name'])){

                    
                    $config['upload_path'] = './assets/uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $_FILES['site_image']['name'];
                     
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config); 
                    $this->upload->initialize($config);
                    $this->upload->do_upload('site_image');  
                                    
                    $uploadData = $this->upload->data();
                    $site_picture= $uploadData['file_name'];
                    
                }else{
                    $site_picture=$this->input->post('site_image_hidden');
                }
                //echo "<pre>"; print_r($this->input->post());
                $data_user_site=array(  
                                        'user_id'=>$this->input->post('user_id'),
                                        'location'=>$this->input->post('location'),
                                        'site_name'=>$this->input->post('site_name'),
                                        'solar_panel'=>$this->input->post('solar_panel'),
                                        'pump'=>$this->input->post('pump'),
                                        'pipe_height'=>$this->input->post('pipe_height'),
                                        'pipe_diameter'=>$this->input->post('pipe_diameter'),
                                        'no_lbows'=>$this->input->post('no_lbows'),
                                        'installer'=>$this->input->post('installer'),
                                        'installation_date'=>date('Y-m-d h:i:sa'),
                                        'warranty'=>$this->input->post('warranty'),
                                        'imei_no'=>$this->input->post('imei_no'),
                                        'vfd_type'=>$this->input->post('vfd_type'),
                                        'device_type'=>$this->input->post('device_type'),
                                        'site_image'=>$site_picture,
                                    );
                //echo "<pre>"; print_r($data_user_site);die;    
                $result=$this->User_model->add_user_site($data_user_site);
                if($result){
                    $d_id=$this->session->userdata('distributer');
                    $note_data=array('send_from'=>$d_id['user_id'],
                                        'send_to'=>1,
                                        'message'=>$d_id['user_fname'].' '.$d_id['user_lname'].' added new device imei '.$this->input->post('imei_no'),
                                        'created_at'=>date("Y-m-d h:i:sa"),
                                        'user_id'=>$this->input->post('user_id'),
                                        'view'=>0,
                                        'status'=>0, 
                                    );

                    $this->User_model->notify($note_data);

                    $this ->session-> set_flashdata('Message','User Site Information Added Successfully'); 
                    //redirect('User_Manufracture/add_user?user_type='.$get['user_type'],'refresh');
                    redirect('User_Manufracture/all_user_view?user_type=2','refresh');
                }else{
                    $this ->session-> set_flashdata('Error','Something went wrong');
                    $get['user_type']=2;
                    $get['id']=$this->input->post('user_id');
                }
            }else{
                $get['user_type']=2;
                $get['id']=$this->input->post('user_id');
            }
        }
        $data['state']=$this->Common_model->get_state();    
        $data['vfd_type']=$this->Admin_model->get_vfd_list();   
        $data['device_type']=$this->Admin_model->get_device_list(); 
        $data['projects']=$this->Distributer_model->get_all_projects(); 
        $data['user_id']=$get['id'];
        $data['user_type']=$get['user_type'];
        $data['main_content']='user/form_user_site';
        if($get['user_type']==1){
            $this->load->view('includes/header',$data);
        }else if($get['user_type']==2){
            $this->load->view('includes/header_d',$data);
        }else{
            $this->load->view('includes/header_u',$data);
        }
    }
    public function edit_user_site()
    {
        $get=$this->input->get();
        if($this->input->post()){
            
            $this->form_validation->set_rules('location','Location','trim|required');
            $this->form_validation->set_rules('site_name','Site Name','trim|required');
            $this->form_validation->set_rules('solar_panel','Solar Panel','trim|required');
            $this->form_validation->set_rules('pump','Pump','trim|required');
            $this->form_validation->set_rules('pipe_height','Pump Height ','trim|required|numeric');
            $this->form_validation->set_rules('pipe_diameter','Pump Diameter','trim|required|numeric');
            $this->form_validation->set_rules('no_lbows','No of Elbows','trim|required|numeric');
            $this->form_validation->set_rules('installer','Installer','trim|required');
            $this->form_validation->set_rules('warranty','Warranty','trim|required|numeric');
            $this->form_validation->set_rules('imei_no','IMEI No','required');
            $this->form_validation->set_rules('vfd_type','VFD Type','trim|required');
            $this->form_validation->set_rules('device_type','Device Type','required');
            

            if($this->form_validation->run() == TRUE){
                
                if(!empty($_FILES['site_image']['name'])){
                    
                    $config['upload_path'] = './assets/uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $_FILES['site_image']['name'];
                     
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config); 
                    $this->upload->initialize($config);
                    $this->upload->do_upload('site_image');  
                                    
                    $uploadData = $this->upload->data();
                    $site_picture= $uploadData['file_name'];
                    
                }else{
                    $site_picture=$this->input->post('site_image_hidden');
                }
                //echo "<pre>"; print_r($this->input->post());
                $data_user_site=array(  
                                        'user_id'=>$this->input->post('user_id'),
                                        'location'=>$this->input->post('location'),
                                        'site_name'=>$this->input->post('site_name'),
                                        'solar_panel'=>$this->input->post('solar_panel'),
                                        'pump'=>$this->input->post('pump'),
                                        'pipe_height'=>$this->input->post('pipe_height'),
                                        'pipe_diameter'=>$this->input->post('pipe_diameter'),
                                        'no_lbows'=>$this->input->post('no_lbows'),
                                        'installer'=>$this->input->post('installer'),
                                        'warranty'=>$this->input->post('warranty'),
                                        'imei_no'=>$this->input->post('imei_no'),
                                        'vfd_type'=>$this->input->post('vfd_type'),
                                        'device_type'=>$this->input->post('device_type'),
                                        'site_image'=>$site_picture,
                                        'id'=>$this->input->post('id'),
                                    );
                //echo "<pre>"; print_r($data_user_site);die;    
                $result=$this->User_model->update_user_site($data_user_site);
                if($result){
                    $this ->session-> set_flashdata('Message','User Site Information Updated Successfully'); 
                    //redirect('User_Manufracture/add_user?user_type='.$get['user_type'],'refresh');
                    redirect('User_Manufracture/view_devices?id='.$this->input->post('user_id').'&user_type=2','refresh');
                }else{
                    $this ->session-> set_flashdata('Error','Something went wrong');
                    $get['user_type']=2;
                    $get['id']=$this->input->post('id');
                    $get['user_id']=$this->input->post('user_id');
                }
            }else{
                $get['user_type']=2;
                $get['id']=$this->input->post('id');
                $get['user_id']=$this->input->post('user_id');
            }
        }
        $data['user_site_details']=$this->User_model->get_user_site_by_id($get['id']);    
        $data['state']=$this->Common_model->get_state();    
        $data['vfd_type']=$this->Admin_model->get_vfd_list();   
        $data['device_type']=$this->Admin_model->get_device_list(); 
        $data['projects']=$this->Distributer_model->get_all_projects(); 
        $data['user_id']=$get['user_id'];
        $data['user_type']=$get['user_type'];
        $data['main_content']='user/form_user_site';
        if($get['user_type']==1){
            $this->load->view('includes/header',$data);
        }else if($get['user_type']==2){
            $this->load->view('includes/header_d',$data);
        }else{
            $this->load->view('includes/header_u',$data);
        }
    }
    public function view_devices()
    {
        $get=$this->input->get();
        
        $data['device_param']=$this->User_model->get_soyo_device_param();
        $data['user_device_site_information']=$this->User_model->get_all_user_with_user_site_information_by_user($get['id']);
        $data['device_details']=$this->Admin_model->get_device_list();
        $data['main_content'] = 'user/view_device';
        $data['user_type']=$get['user_type'];
        if($get['user_type']==1){
            $this->load->view('includes/header',$data);
        }else if($get['user_type']==2){
            $this->load->view('includes/header_d',$data);
        }else{
            $this->load->view('includes/header_u',$data);
        }
    }
    public function export() {

        $get=$this->input->get();

        $device = $_GET['device'];
        $user_id=$_GET['user_id'];
        $device_type = $_GET['device_type'];
        if(!empty($_GET['device_parameter'])){
            $device_parameter = json_decode($_GET['device_parameter']);
        }else{
            $device_parameter='';
        }
        $device_details = $this->User_model->get_soyo_device_request_user_id($user_id);
        $user_site=$this->User_model->get_all_user_with_user_site_information_by_user($user_id);
        $device_parameter_all=$this->Admin_model->get_device_parameters_by_id($device);
        //echo "<pre>"; print_r($device_details);die;
        if (!empty($device_details)) {

            $name="All_device_paramerter_";
            $filename = $name."_reports_" . rand() . ".csv";
            ob_clean();
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=\"$filename\"");

            $out = fopen("php://output", 'w');

            $flag = false;
            if (!$flag) {
                $i = 2;
                $header=array(0=>'Device IMEI',
                              1=>'Site Name' 
                            );
                if(!empty($device_parameter)){
                    foreach($device_parameter as $datas){
                        $header[$i] = $datas;
                        $i++;
                    }
                }else{
                    foreach($device_parameter_all as $datas){
                        $header[$i] = $datas->unique_id;
                        $i++;
                    }
                }
                fputcsv($out, array_values($header), ',', '"');
                $flag = true;
            }
            $i=2;
            $footer=array();
            $flag=false;
            if(!empty($device_parameter)){
                foreach($user_site as $value_site){
                    $footer[0]=$value_site->imei_no;
                    $footer[1]=$value_site->site_name;
                    foreach ($device_details as $key=>$value) {
                        if($value['imei']==$value_site->imei_no){
                            foreach($device_parameter as $dev_value){
                                if($dev_value ==$value['parameter']){
                                    $footer[$i]=$value['value'];
                                    $i++;
                                }
                            }
                        }
                    }
                    fputcsv($out, array_values($footer), ',', '"');
                    $footer=array();
                }

            }else{
                foreach($user_site as $value_site){
                    $footer[0]=$value_site->imei_no;
                    $footer[1]=$value_site->site_name;
                    foreach ($device_details as $key => $value) {
                        if($value['imei']==$value_site->imei_no){
                            foreach($device_parameter_all as $dev_value){
                                if($dev_value->unique_id==$value['parameter']){
                                    $footer[$i]=$value['value'];
                                    $i++;
                                }
                            }
                        }
                    }
                    fputcsv($out, array_values($footer), ',', '"');
                    $footer=array();
                }
            }
            fclose($out);
            exit;
        }
    }
    public function updateuserstatus(){
        $status=$this->input->post('status');
        $id=$this->input->post('id');
        $result=$this->User_model->updateuserstatus($status,$id);
        echo true;
    }
    public function updatesitestatus(){
        $status=$this->input->post('status');
        $imei=$this->input->post('imei');
        $result=$this->User_model->updatesitestatus($status,$imei);
        echo true;
    }
    public function export_device_view()
    {
        $session=$this->session->userdata('user');
        $data['device_param']=$this->User_model->get_soyo_device_param();
        $data['user_device_site_information']=$this->User_model->get_all_user_with_user_site_information_by_user($session['user_id']);
        $data['device_details']=$this->Admin_model->get_device_list();
        $data['user_sites']=$this->User_model->get_user_site_by_user_id($session['user_id']);
        $data['main_content'] = 'user/device_export';
        $this->load->view('includes/header_u',$data);
    }
    public function user_export() {

        $get=$this->input->get();

        $device = $_GET['device'];
        $user_id=$_GET['user_id'];
        $device_type = $_GET['device_type'];
        if(!empty($_GET['device_parameter'])){
            $device_parameter = json_decode($_GET['device_parameter']);
        }else{
            $device_parameter='';
        }
        $device_details = $this->User_model->get_soyo_device_request_user_id($user_id);
        $user_site=$this->User_model->get_all_user_with_user_site_information_by_user($user_id);
        $device_parameter_all=$this->Admin_model->get_device_parameters_by_id($device);
        //echo "<pre>"; print_r($device_details);die;
        if (!empty($device_details)) {

            $name="All_device_paramerter_";
            $filename = $name."_reports_" . rand() . ".csv";
            ob_clean();
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=\"$filename\"");

            $out = fopen("php://output", 'w');

            $flag = false;
            if (!$flag) {
                $i = 2;
                $header=array(0=>'Device IMEI',
                              1=>'Site Name' 
                            );
                if(!empty($device_parameter)){
                    foreach($device_parameter as $datas){
                        $header[$i] = $datas;
                        $i++;
                    }
                }else{
                    foreach($device_parameter_all as $datas){
                        $header[$i] = $datas->unique_id;
                        $i++;
                    }
                }
                fputcsv($out, array_values($header), ',', '"');
                $flag = true;
            }
            $i=2;
            $footer=array();
            $flag=false;
            if(!empty($device_parameter)){
                foreach($user_site as $value_site){
                    $footer[0]=$value_site->imei_no;
                    $footer[1]=$value_site->site_name;
                    foreach ($device_details as $key=>$value) {
                        if($value['imei']==$value_site->imei_no){
                            foreach($device_parameter as $dev_value){
                                if($dev_value ==$value['parameter']){
                                    $footer[$i]=$value['value'];
                                    $i++;
                                }
                            }
                        }
                    }
                    fputcsv($out, array_values($footer), ',', '"');
                    $footer=array();
                }

            }else{
                foreach($user_site as $value_site){
                    $footer[0]=$value_site->imei_no;
                    $footer[1]=$value_site->site_name;
                    foreach ($device_details as $key => $value) {
                        if($value['imei']==$value_site->imei_no){
                            foreach($device_parameter_all as $dev_value){
                                if($dev_value->unique_id==$value['parameter']){
                                    $footer[$i]=$value['value'];
                                    $i++;
                                }
                            }
                        }
                    }
                    fputcsv($out, array_values($footer), ',', '"');
                    $footer=array();
                }
            }
            fclose($out);
            exit;
        }
    }

}
?>