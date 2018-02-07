<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Sunraj</title>
  <meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
  	<link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
	
  	
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
	<link href="<?php echo base_url(); ?>assets/css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  	<link href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  	<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  	
  	

</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand">Sunraj Builder</a>
	      <ul class="nav">
	        <li <?php if($this->uri->segment(2) == 'labours'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/labours">Labours</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'supervisers'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/supervisers">Supervisers</a>
	        </li>
	       <li <?php if($this->uri->segment(2) == 'shift'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/shift/listshift">Shift Management</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'payment'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/payment/listpayment">Payment Management</a>
	        </li>
			<li <?php if($this->uri->segment(2) == 'notification'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/notification/listnotification">Notifications<span class="badge badge-secondary"><sup style="backgroud-color:red;"><?php echo $this->manufacturers_model->count_notification(); ?></sup> </span> <?php echo $this->notifications->display_js(); ?></a>
	        </li>
			<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
	          <ul class="dropdown-menu">	            
	            <li>
	              <a href="<?php echo base_url(); ?>admin/privacy">Edit</a>
	            </li>           
	            <li>
	              <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
	            </li>  
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>