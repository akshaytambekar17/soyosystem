<?php
class Webservice_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webservice_model');
		$this->load->model('Home_model');
		$this->load->model('Admin_model');
		$this->load->model('Common_model');
		$this->load->model('Distributer_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
		//$this->load->model('User_model');
	}
	public function upload()
	{
		$get=$this->input->get();
                $device_data =$this->Admin_model->get_device_parameters_by_id($get['device_type']);
		$result=$this->Webservice_model->insert_request($device_data,$get);
		if($result){
			echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?status=0";
		}else{
			echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?status=2";
		}

	}
	public function getImei()
	{
		$get=$this->input->get();
        $user_data=$this->Webservice_model->get_user_by_imei($get['imei']);
        if($user_data){
			echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?result=0&username=".$user_data[0]['username']."&password=".$user_data[0]['password']."&vfd_type=".$user_data[0]['vfd_type'];
		}else{
			echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?status=2";
		}

	}
	public function getstatus(){
            $get=$this->input->get();
            $user_data=$this->Webservice_model->get_user_by_imei_status($get);
            if($user_data){
			echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?status=".$user_data[0]['status']."&username=".$user_data[0]['username']."&password=".$user_data[0]['password'];
            }else{
                    echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?error=1";
            }		
	}
	public function getsitestatusrequest(){
            $get=$this->input->get();
            $user_data=$this->Webservice_model->get_all_details($get);
            if($user_data){
                echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?pump_status=".$user_data['pump_status']."&pump_request=".$user_data['pump_request']."&uploading_status=".$user_data['uploading_status']."&password_changes=".$user_data['password_changes'];
            }else{
                echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?error=1";
            }		
	}
	public function getsiteinformation(){
            $get=$this->input->get();
            $user_data=$this->User_model->get_user_site_by_imei($get['imei']);
            if($user_data){
			echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?pump-diameter=".$user_data[0]->pipe_diameter."&no_lbows=".$user_data[0]->no_lbows;
            }else{
                echo "http://soyosystem.aspirevisions.com/Webservice_Controller/return?error=1";
            }		
	}

	
	
}
?>