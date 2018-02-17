<?php
class Admin_Manufracture extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->view('includes/include');
		/*$this->load->model('Home_model');
		$this->load->model('Admin_model');
		$this->load->model('Common_model');
		$this->load->model('Distributer_model');
		$this->load->model('User_model');*/
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
                
		$data['distributers_list']=$this->Home_model->get_distributers_list();
		$data['users_list']=$this->Home_model->get_users_list();
		$data['device_list']=$this->Admin_model->get_device_list();
		$data['product']=$this->Home_model->get_products();
		$data['main_content'] = 'admin/admin_dashboard';
  		$this->load->view('includes/template',$data);
	}
	public function profile()
	{
                
        $get=$this->input->get();
        
		if(isset($get['id'])){
			$uid=$get['id'];	
		}else{
			$uid=1;
		}
		$data['user_details']=$this->Home_model->profile_details($uid);
		$data['state']=$this->Common_model->get_state();	
		$data['type']=$get['type'];
		$data['main_content']='profile';
		/*if($get['type'] == 1){
        	$data['main_content']='profile';
		}else if($get['type'] == 2){
			redirect("User_Manufracture/edit_user?id=".$get['id']);
		}else{
			redirect("Distributer_Manufracture/edit_distributer_view?id=".$get['id']);
		}*/
		if($get['type'] == 1){
			$this->load->view('includes/header',$data);
		}else if($get['type'] == 2){
			$this->load->view('includes/header_d',$data);
		}else{
			$this->load->view('includes/header_u',$data);
		}
	}
	public function add_distributer_view()
	{
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;
			$this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|numeric');
			$this->form_validation->set_rules('state', 'State', 'trim|required|alpha');
			$this->form_validation->set_rules('district', 'District', 'trim|required|alpha');
			$this->form_validation->set_rules('city', 'City', 'trim|required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');

			if($this->form_validation->run() == TRUE)
			{
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
		        	$picture='';
		        }
				$data_to_update=array('fname'=>$this->input->post('fname'),
										'lname'=>$this->input->post('lname'),
										'username'=>$this->input->post('username'),
										'password'=>$this->input->post('password'),
										'email'=>$this->input->post('email'),
										'state'=>$this->input->post('state'),
										'dist'=>$this->input->post('district'),
										'city'=>$this->input->post('city'),
										'mobile'=>$this->input->post('mobile'),
										'date'=>date("Y-m-d"),
										'time'=>date("h:i:sa"),
										'type'=>2,
										'status'=>1,
										'profile_image'=>$picture
									);
				//echo "<pre>"; print_r($data_to_update); die;			
				$result=$this->Admin_model->add_distributer($data_to_update);
				if($result){
					$this ->session-> set_flashdata('Message','Distributer Addedd Successfully'); 
					redirect('Admin_Manufracture/add_distributer_view','refresh');
				}else{
					$this ->session-> set_flashdata('Error','Username already exist'); 
				}
			}
		}

		$data['state']=$this->Common_model->get_state();	
		$data['main_content']='admin/add_distributer';
		$this->load->view('includes/header',$data);
	}
	public function edit_distributer_view()
	{
		$id=$this->input->get('id');
		$data['user_details']=$this->Distributer_model->get_distributers_by_id($id);
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;
			$this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|numeric');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('district', 'District', 'required');
			$this->form_validation->set_rules('city', 'City', 'trim|required|alpha');

			if($this->form_validation->run() == TRUE)
			{

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
				$data_to_update=array(  'fname'=>$this->input->post('fname'),
										'lname'=>$this->input->post('lname'),
										'username'=>$this->input->post('username'),
										'password'=>$this->input->post('password'),
										'email'=>$this->input->post('email'),
										'state'=>$this->input->post('state'),
										'dist'=>$this->input->post('district'),
										'city'=>$this->input->post('city'),
										'mobile'=>$this->input->post('mobile'),
										'user_id'=>$this->input->post('user_id'),
										'profile_image'=>$picture
									);
				$result=$this->Admin_model->update_distributer($data_to_update);
				if($result){
					$this ->session-> set_flashdata('Message','Distributer Updated Successfully'); 
					redirect('Admin_Manufracture/edit_distributer_view?id='.$id,'refresh');
				}else{
					$this ->session-> set_flashdata('Error','Username already exist'); 
				}
			}
		}
		$data['state']=$this->Common_model->get_state();	
		$data['main_content']='admin/edit_distributer';
		$this->load->view('includes/header',$data);
	}
	public function delete_distributer(){
		if($this->input->get('id')){
			$id=$this->input->get('id');
			$result=$this->Admin_model->delete_distributer($id);	
			$this ->session-> set_flashdata('Message','Distributer Deleted Successfully'); 
			redirect('Distributer_Manufracture/all_distributer_view','refresh');
		}
	}
	public function edit_user_view()
	{
		$data['main_content']='admin/edit_user';
		$this->load->view('includes/header',$data);
	}
	public function update_profile()
	{
		$uid=$this->input->post('uid');
		$utype=$this->input->post('type');

		$update_result=$this->Home_model->update();
		if($update_result){
			$this->session->set_flashdata('update_success','Information Updated Successfully');
		}else{
			$this->session->set_flashdata('update_success','Information Not Updated');
		}

		redirect("Admin_Manufracture/profile?id=".$uid."&type=".$utype);

		redirect("Admin_Manufracture/profile/?id=".$uid."&type=".$utype);
	

		/*if($session['user_id'] == $uid){
			redirect("Admin_Manufracture/profile/".$session['user_id']);
		}
		else{
			if($utype == 2){
				redirect('Admin_Manufracture/edit_distributer_view');
			}else{
				redirect('Admin_Manufracture/edit_user_view');
			}
			
		}*/		
	}
	public function device_list(){
		$data['device_list']=$this->Admin_model->get_device_list();
		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/device/device_list';
		$this->load->view('includes/header',$data);		
	}
	public function add_device()
	{
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;
			$this->form_validation->set_rules('device_name','Device name','required');
			$this->form_validation->set_rules('category','Drive Manufacture','required');
			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
				
			if($this->form_validation->run())
			{

				$data_to_update=array(	'device_name'=>$this->input->post('device_name'),
										//'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
										'created_at'=>date('Y-m-d h:i:sa')									
									);

				//echo "<pre>"; print_r($data_to_update); die;			
				$insert_id=$this->Admin_model->add_device($data_to_update);
				$result=$this->Admin_model->add_device_paramter($this->input->post('device_parameter'),$insert_id,$this->input->post('unique_id'));
				if($result){
					$this ->session-> set_flashdata('Message','Device Added Successfully'); 
					redirect('Admin_Manufracture/add_device','refresh');
				}else{
					$this ->session-> set_flashdata('Error','Something went wrong'); 
				}
			}

		}

		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/device/form_device';
		$this->load->view('includes/header',$data);
	}
	public function edit_device()
	{
		if($this->input->get('id')){
			$id=$this->input->get('id');
			$data['device_details']=$this->Admin_model->get_device_by_id($id);	
			$data['device_parameter']=$this->Admin_model->get_device_parameters_by_id($id);
		}
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;
			$this->form_validation->set_rules('device_name','Device name','required');
			$this->form_validation->set_rules('category','Drive Manufacture','required');
			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			if($this->form_validation->run())
			{
				$id=$this->input->post('id');
				$data_to_update=array(	'device_name'=>$this->input->post('device_name'),
										//'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
										'id'=>$id,
									);

				//echo "<pre>"; print_r($data_to_update); die;			
				$udpate=$this->Admin_model->update_device($data_to_update);
				$result=$this->Admin_model->update_device_paramter($this->input->post('device_parameter'),$id,$this->input->post('unique_id'));
				if($result){
					$this ->session-> set_flashdata('Message','Device Updated Successfully'); 
					$data['device_details']=$this->Admin_model->get_device_by_id($id);	
					$data['device_parameter']=$this->Admin_model->get_device_parameters_by_id($id);
					redirect('Admin_Manufracture/edit_device?id='.$id,'refresh');
				}else{
					$this ->session-> set_flashdata('Error','Something went wrong'); 
				}
			}
		}

		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/device/form_device';
		$this->load->view('includes/header',$data);
	}
	public function delete_device(){
		if($this->input->get('id')){
			$id=$this->input->get('id');
			$result=$this->Admin_model->delete_device($id);	
			$this ->session-> set_flashdata('Message','Device Deleted Successfully'); 
			redirect('Admin_Manufracture/device_list','refresh');
		}
	}
	
	public function vfd_list(){
		$data['vfd_list']=$this->Admin_model->get_vfd_list();
		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/vfd/vfd_list';
		$this->load->view('includes/header',$data);		
	}
	public function add_vfd()
	{
		if($this->input->post()){

				//echo "<pre>"; print_r($this->input->post()); die;
			$this->form_validation->set_rules('vfd_name', 'VFD Name', 'required');
			$this->form_validation->set_rules('drive_manufacture', 'Select Drive Manufacture', 'required');
			if($this->form_validation->run() == TRUE){

				$data_to_update=array(	'vfd_name'=>$this->input->post('vfd_name'),
										'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
										'created_at'=>date('Y-m-d h:i:sa')									
									);

				//echo "<pre>"; print_r($data_to_update); die;			
				$result=$this->Admin_model->add_vfd($data_to_update);
				if($result){
					$this ->session-> set_flashdata('Message','VFD Added Successfully'); 
					redirect('Admin_Manufracture/add_vfd','refresh');
				}else{
					$this ->session-> set_flashdata('Error','Something went wrong'); 
				}
			}
		}

		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/vfd/form_vfd';
		$this->load->view('includes/header',$data);
	}
	public function edit_vfd()
	{
		if($this->input->get('id')){
			$id=$this->input->get('id');
			$data['vfd_details']=$this->Admin_model->get_vfd_by_id($id);	

		}
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;
			$this->form_validation->set_rules('vfd_name','VFD Name','required');
			$this->form_validation->set_rules('drive_manufacture','Drive Manufacture','required');
				
			if($this->form_validation->run())
			{

				$id=$this->input->post('id');
			
				$data_to_update=array(	'vfd_name'=>$this->input->post('vfd_name'),
										'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
										'id'=>$id,
									);
				$result=$this->Admin_model->update_vfd($data_to_update);
				if($result){
					$this ->session-> set_flashdata('Message','VFD Updated Successfully'); 
					redirect('Admin_Manufracture/edit_vfd?id='.$id,'refresh');
				}else{
					$this ->session-> set_flashdata('Error','Something went wrong'); 
					$data['vfd_details']=$this->Admin_model->get_vfd_by_id($id);	
				}
			}
		}
		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/vfd/form_vfd';
		$this->load->view('includes/header',$data);
	}
	public function delete_vfd(){
		if($this->input->get('id')){
			$id=$this->input->get('id');
			$result=$this->Admin_model->delete_vfd($id);	
			$this ->session-> set_flashdata('Message','VFD Deleted Successfully'); 
			redirect('Admin_Manufracture/vfd_list','refresh');
		}
	}

	public function sales_report()
	{
		if($this->input->post()){
			$post=$this->input->post();
			$this->form_validation->set_rules('distributer', 'Select Distributer', 'required');
			$this->form_validation->set_rules('user', 'Select User', 'required');
			if($this->form_validation->run() == TRUE){
				$data['user_details']=$this->User_model->get_all_user_with_user_site_information_by_user($post['user']);		
				$data['user_id']=$post['user'];
				$data['distributer_id']=$post['distributer'];
			}else{
				$data['user_details']=$this->User_model->get_all_user_with_user_site_information();
			}
			
		}else{
			$data['user_details']=$this->User_model->get_all_user_with_user_site_information();	
		}
		$data['device_parameters_data']=$this->Admin_model->get_device_parameters_data();
		$data['distributer']=$this->Distributer_model->get_all_distributer();
		$data['main_content']='admin/sales_report';
		if($this->uri->segment(3) == 1)
		{
			$this->load->view('includes/header',$data);
		}
		else if($this->uri->segment(3) == 2)
		{
			$this->load->view('includes/header_d',$data);
		}
		else
		{
			$this->load->view('includes/header_u',$data);
		}
	}
	public function change_password(){
		if($this->uri->segment(3) == 1)
		{
			$session=$this->session->userdata('admin');
		}
		else if($this->uri->segment(3) == 2)
		{
			$session=$this->session->userdata('distributer');
		}
		else
		{
			$session=$this->session->userdata('user');
		}
		if($session['user_id']){
			if($this->input->post()){

				$this->form_validation->set_rules('new_password', 'New Password', 'required');
				$this->form_validation->set_rules('confrim_password', 'Confirm Password', 'required|matches[new_password]');
				if($this->form_validation->run() == TRUE){
					
					$result=$this->Admin_model->change_password($this->input->post('new_password'),$session['user_id']);
					$this ->session-> set_flashdata('Message','Password has successfully changed'); 
		redirect('Admin_Manufracture/change_password/'.$session['user_id'],'refresh');

				}else{
					$data['main_content']='admin/change_password';
					if($session['user_type'] == 1)
					{
						$this->load->view('includes/header',$data);	
					}
					else if($session['user_type'] == 2)
					{
						$this->load->view('includes/header_d',$data);	
					}
					else
					{	
						$this->load->view('includes/header_u',$data);	
					}	
				}
			}	
			//$data['device_parameters_data']=$this->Admin_model->get_device_parameters_data();
			//echo "<pre>"; print_r($data['device_parameters_data']); die;		
			$data['main_content']='admin/change_password';	
			if($session['user_type'] == 1)
				{
					$this->load->view('includes/header',$data);	
				}
				else if($session['user_type'] == 2)
				{
					$this->load->view('includes/header_d',$data);	
				}
				else
				{	
					$this->load->view('includes/header_u',$data);	
				}	
		}else{
			$data['main_content']='admin/change_password';
			if($session['user_type'] == 1)
				{
					$this->load->view('includes/header',$data);	
				}
				else if($session['user_type'] == 2)
				{
					$this->load->view('includes/header_d',$data);	
				}
				else
				{
					
					$this->load->view('includes/header_u',$data);	
				}				
		}
	}
	/*public function view_noti(){
		$data['device_parameters_data']=$this->Admin_model->get_device_parameters_data();
		//echo "<pre>"; print_r($data['device_parameters_data']); die;			
		$data['main_content']='admin/sales_report';
		$this->load->view('includes/header',$data);
	}*/

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
	public function getdistrictlist() {
        
        $state=$this->input->post('state'); 
        $district_hidden=$this -> input -> post('district_hidden'); 
		
        $district= $this ->Common_model->get_district_by_state($state);
     	  
        $data=array();

       	foreach ($district as $value) { 
       		$sdistrict = ($district_hidden == $value['id'])?'selected="selected"':'';
            $data2 =' <option data-tokens="'.$value['name'].'"  value="'.$value['id'].'" '.$sdistrict.' > '.$value['name'].'</option>';
            $data[]=$data2;
     	}	
     	$html= $data;  

     	 
     	echo json_encode($html);
    }
    public function get_user_by_distributer() {
        
        $distributer=$this->input->post('distributer'); 
        
        $user= $this ->User_model->get_all_user_by_distributer($distributer);
     	  
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
    	if(!empty($_GET['user_id']) && empty($_GET['distributer_id'])){
            $user_details = $this->User_model->get_all_user_with_user_site_information_by_user($_GET['user_id']);
        }else if(empty($_GET['user_id']) && !empty($_GET['distributer_id'])){
        	$user_details = $this->User_model->get_all_user_with_user_site_information_by_distributer($_GET['distributer_id']);
        }else{
            $user_details = $this->User_model->get_all_user_with_user_site_information();
        }
        
        if (!empty($user_details)) {
            if(!empty($_GET['user_id']) && empty($_GET['distributer_id'])){
                $name=$user_details[0]->fname."_". $user_details[0]->lname;
            }else if(empty($_GET['user_id']) && !empty($_GET['distributer_id'])){
	        	$name= "By_Distributor_";
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
                $device_type=$this->Admin_model->get_device_by_id($value->project);
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

    	if(!empty($_GET['user_id']) && empty($_GET['distributer_id'])){
            $data['user_details'] = $this->User_model->get_all_user_with_user_site_information_by_user($_GET['user_id']);
        }else if(empty($_GET['user_id']) && !empty($_GET['distributer_id'])){
        	$data['user_details'] = $this->User_model->get_all_user_with_user_site_information_by_distributer($_GET['distributer_id']);
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
    public function view_devices()
    {
    	$get=$this->input->get();
    	$data['devices']=$this->Admin_model->get_devices_by_user($get['id']);
    	//echo $get['id'];
		$data['main_content']='admin/view_devices';
		if($get['user_type'] == 1)
			{
				$this->load->view('includes/header',$data);	
			}
			else if($get['user_type'] == 2)
			{
				$this->load->view('includes/header_d',$data);	
			}
			else
			{	
				$this->load->view('includes/header_u',$data);	
			}
	}
    public function getsalebargraph(){
    	$post=$this->input->post();
    	$user_details=$this->User_model->get_user_list_by_devicetype($post['id']);
    	$state=$this->Common_model->get_state();
    	$result_data=array();
    	foreach($state as $state_value){
    		$i=0;
    		foreach ($user_details as $key => $value) {
    			if($state_value['id']==$value->state){
    				$i++;
    				$result_data[$state_value['name']]=$i;
    			}else{
    				$result_data[$state_value['name']]=$i;
    			}
    		}
    	}
    	echo json_encode($result_data);

    }
    public function imagesave(){
		$data = $_POST['data'];
		$file = md5(uniqid()) . '.png';
		 
		// remove "data:image/png;base64,"
		$uri =  substr($data,strpos($data,",")+1);
		 
		// save to file
		file_put_contents('./'.$file, base64_decode($uri));
		 
		// return the filename
		echo $file; exit;
    }
    public function download(){
		$file = trim($_GET['path']);
 
		// force user to download the image
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: image/png');

			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			unlink($file);
			exit;
		}
		else {
			echo "$file not found";
		}

    }
    public function get_device_parameters_by_id(){
    	$post=$this->input->post();
    	$paramters_details=$this->Admin_model->get_device_parameters_by_id($post['id']);
    	$result_data=array();
    	foreach($paramters_details as $value){
    		$result_data[$value->unique_id]=$value->name;
    		
    	}
    	echo json_encode($result_data);
    }
}
?>