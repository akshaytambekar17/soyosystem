<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class MY_Controller extends CI_Controller {
	function __construct()
		 {
			  parent::__construct();
		    	  $this->load->library('form_validation');
		    	  $this->load->model('webservicemodel');
		    	  $this->load->helper(array('form', 'url'));
		    	  $this->load->library('session');
		    	  $this->load->library('email'); 
		    	  $this->load->helper('cookie');
				  $this->load->library('curl');
				
		 }
}