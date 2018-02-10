<?php
class Admin_Manufracture extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->view('includes/include');
		$this->load->model('Home_model');
		$this->load->model('Admin_model');
		$this->load->model('Common_model');
		$this->load->model('Distributer_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
	 	$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['distributers_list']=$this->Home_model->get_distributers_list();
		$data['users_list']=$this->Home_model->get_users_list();
		$data['device_list']=$this->Admin_model->get_device_list();
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
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;

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

		$data['state']=$this->Common_model->get_state();	
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
	public function device_list(){
		$data['device_list']=$this->Admin_model->get_device_list();
		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/device_list';
		$this->load->view('includes/header',$data);		
	}
	public function add_device()
	{
		if($this->input->post()){
			//echo "<pre>"; print_r($this->input->post()); die;

			$data_to_update=array(	'device_name'=>$this->input->post('device_name'),
									'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
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

		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/form_device';
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
			$id=$this->input->post('id');
			$data_to_update=array(	'device_name'=>$this->input->post('device_name'),
									'drive_manufacture_id'=>$this->input->post('drive_manufacture'),
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

		$data['device_manufacture']=$this->Common_model->get_device_manufacture();	
		$data['main_content']='admin/form_device';
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

	public function sales_report(){
		$data['device_parameters_data']=$this->Admin_model->get_device_parameters_data();
		//echo "<pre>"; print_r($data['device_parameters_data']); die;			
		$data['main_content']='admin/sales_report';
		$this->load->view('includes/header',$data);
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
}
?>