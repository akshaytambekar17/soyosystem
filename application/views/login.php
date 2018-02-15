<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/include.php');?>
<link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet" type="text/css">
</head>

<body id="body">
 <section>
 	<div class="container-fluid">
	 	<div class="col-md-12 col-xs-12 col-sm-12">
	 		<div class="row logo">
	 			<img src="<?php echo base_url();?>assets/img/logo.png" class="col-md-2 col-sm-4 col-xs-4">
	 		</div>
	 	</div>
 	</div>
 </section>

<section>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row heading">
				<h1 class="col-md-12">WELCOME TO SOYO REAL-TIME <br>MONITORING SYSTEM</h1>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container-fluid">
		<div class="col-md-12 row"> 
			<div class=" paragraph col-md-9">
				<p>
					We are engaged in engineering/design/manufacturing/supply and installation of solar photovoltaic Power plants ,Solar water pumping systems, Solar water heating systems, solar off grid systems, solar on grid systems, solar MPPT chargers, solar street lights, solar home lighting systems, solar lanterns etc. The SOYO Real time Monitoring System is used to track and record data from various instruments installed by the company at different parts of the countrly. The status of the equipments like Excess Temperature, Fan status, Short Circuit and various parameters like Voltage, Current, Temperature, Energy etc can be viewed online. Since the data can be monitored realtime users can manage their equipments effeciently. There are Distributor and User consoles for data monitoring.
				</p>
			</div>
			<div class="col-md-3">
					<?php
						echo form_open('Home_Controller/login');
					?>
						<div class="form-group">
							<?php
							if($this->form_validation->run() == FALSE)
							{echo "<p class='text-danger'>".form_error('uname')."</p>";}
							?>
							
							<?php
								echo form_input(['type'=>'text','name'=>'uname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Username']);
							?>
						</div>
						<div class="form-group">
							<?php
							if($this->form_validation->run() == FALSE)
							{echo "<p class='text-danger'>".form_error('password')."</p>";}
							?>
							
							<?php
								echo form_input(['type'=>'password','name'=>'password','class'=>'form-control','id'=>'exampleInputPassword','placeholder'=>'Password']);
							?>
						</div>
						<!--div class="form-check">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-indicator"></span>
								<span class="custom-control-description"> Keep Me Signed In</span>
							</label>
						</div-->
						<button type="submit" class="btn btn-primary btn-gradient btn-block">
							<i class="batch-icon batch-icon-key"></i>
							Sign In
						</button>
						<hr>
						<p class="text-center">
							Don't Have An Password? <a href="<?php echo base_url();?>">Forget Password?</a>
						</p>
						<!--p class="text-center">
							Don't Have An Account? <a href="<?php echo base_url();?>Home_Controller/registration">Sign Up here</a>|<a href="<?php echo base_url();?>Home_Controller/registration">Forget Password</a>
						</p-->
					</form>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row address">
				<address class="col-md-5">
					 <p>For more details contact :</p>
						<h6>Soyo Systems</h6>
						<h6>Kishor Dhake (Proprietor contact: 08079451944)</h6>
						<h6>Plot No. M-91, M. I. D. C. Area,</h6>
						<h6>Near Godavari Engineering Collage</h6>
						<h6>Jalgaon - 425003, Maharashtra, India</h6>
				</address>
			</div>
		</div>
	</div>
</section>

<!-- SCRIPTS - REQUIRED START -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- Bootstrap core JavaScript -->
	<!-- JQuery -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery-3.1.1.min.js"></script>
	<!-- Popper.js - Bootstrap tooltips -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/mdb.min.js"></script>
        
        <!-- Velocity -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/velocity/velocity.min.js"></script>
        
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/velocity/velocity.ui.min.js"></script>
	<!-- Custom Scrollbar -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<!-- jQuery Visible -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery_visible/jquery.visible.min.js"></script>
	<!-- jQuery Visible -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery_visible/jquery.visible.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/misc/ie10-viewport-bug-workaround.js"></script>

	<!-- SCRIPTS - REQUIRED END -->
        
	<!-- SCRIPTS - OPTIONAL START -->
	<!-- ChartJS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/chartjs/chart.bundle.min.js"></script>
	<!-- JVMaps -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jvmaps/jquery.vmap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jvmaps/maps/jquery.vmap.usa.js"></script>
	<!-- Image Placeholder -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/misc/holder.min.js"></script>
	<!-- SCRIPTS - OPTIONAL END -->

	<!-- QuillPro Scripts -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js"></script>
</body>
</html>