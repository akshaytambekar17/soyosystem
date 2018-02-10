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

		$vfd_data=$this->Admin_model->get_device_parameters_by_id($get['vfd']);
		$result=$this->Webservice_model->insert_request($vfd_data,$get);
		if($result){
			echo 0;
		}else{
			echo 2;
		}

	}
	
}
?>