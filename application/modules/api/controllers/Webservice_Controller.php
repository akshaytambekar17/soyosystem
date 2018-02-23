<?php
class Webservice_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webservice_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
		//$this->load->model('User_model');
	}
	public function upload()
	{
		
	}
	
}
?>