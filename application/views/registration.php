<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/include.php');?>
		
</head>

<body>

	<div class="container-fluid">
		<div class="row">
			<div class="right-column sisu">
				<div class="row mx-0">
					<div class="col-md-4 order-md-2 signin-right-column px-5 bg-dark">
						<a class="signin-logo d-sm-block d-md-none" href="#">
							<img src="assets/img/logo-white.png" width="145" height="32.3" alt="SoyoSystem">
						</a>
						<h1 class="display-4">Sign Up To get Started</h1>
						<p class="lead mb-5">
							Big data latte SpaceTeam unicorn cortado hacker physical computing paradigm.
						</p>
					</div>
					
					<div class="col-md-4 order-md-1 signin-left-column bg-white px-5"><br>
						<div class="col-md-8 order-md-2 px-5 bg-dark">
						<a class="signin-logo d-sm-none d-md-block" href="#">
							<img src="<?php echo base_url();?>assets/img/logo.jpg" width="145" height="32.3" alt="SoyoSystem">
						</a>
					</div>
						<?php
						if($this->session->flashdata('registration_fail_uname_exist'))
						{
							echo "<p class='text-danger'>".$this->session->flashdata('registration_fail_uname_exist')."</p>";
						}
						if($this->session->flashdata('registration_success'))
						{
							echo "<p class='text-success'>".$this->session->flashdata('registration_success')."</p>";
						}
						if($this->session->flashdata('registration_fail'))
						{
							echo "<p class='text-success'>".$this->session->flashdata('registration_fail')."</p>";
						}

						$attribute=array('method'=>'post');
						echo form_open('Home_Controller/register',$attribute);
						?>
							<div class="form-group">
								<label for="exampleInputEmail1">First Name</label>
								<?php
									echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter first name']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Last Name</label>
								<?php
									echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter last name']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<?php
									echo form_input(['type'=>'email','name'=>'email','class'=>'form-control','id'=>'exampleInputEmail1','aria-describedb'=>'emailHelp','placeholder'=>'Enter email']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Select Category</label>
								<?php
									$options=array('distributer'=>'Distributer',
													'user'=>'User');
									$attributes=array('class'=>'form-control');
									$selected= array('user');
									echo form_dropdown('category',$options,$selected,$attributes);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">State</label>
								<?php
									echo form_input(['type'=>'text','name'=>'state','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter state']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">District</label>
								<?php
									echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter district']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">City</label>
								<?php
									echo form_input(['type'=>'text','name'=>'city','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter city']);
								?>
							</div>
					</div>
					<div class="col-md-4 order-md-1 signin-left-column bg-white px-5"><br>
						<div class="col-md-8 order-md-2 px-5 form_part ">
						<a class="signin-logo d-sm-none d-md-block" href="#">
							
						</a>
					</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Mobile</label>
								<?php
									echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control','placeholder'=>'Enter Mobile']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<?php
									echo form_input(['type'=>'text','name'=>'uname','class'=>'form-control','placeholder'=>'Enter username']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<?php
									echo form_input(['type'=>'password','name'=>'password','class'=>'form-control','id'=>'exampleInputPassword','placeholder'=>'Password']);
								?>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Confirm Password</label>
								<?php
									echo form_input(['type'=>'password','name'=>'c_password','class'=>'form-control','id'=>'exampleInputPassword','placeholder'=>'Confirm Password']);
								?>
							</div>
							<hr>
							<button type="submit" class="btn btn-primary btn-gradient btn-block">
								<i class="batch-icon batch-icon-key"></i>
								Sign Up
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- SCRIPTS - REQUIRED START -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- Bootstrap core JavaScript -->
	<!-- JQuery -->
	<script type="text/javascript" src="assets/js/jquery/jquery-3.1.1.min.js"></script>
	<!-- Popper.js - Bootstrap tooltips -->
	<script type="text/javascript" src="assets/js/bootstrap/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="assets/js/bootstrap/mdb.min.js"></script>
	<!-- Velocity -->
	<script type="text/javascript" src="assets/plugins/velocity/velocity.min.js"></script>
	<script type="text/javascript" src="assets/plugins/velocity/velocity.ui.min.js"></script>
	<!-- Custom Scrollbar -->
	<script type="text/javascript" src="assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<!-- jQuery Visible -->
	<script type="text/javascript" src="assets/plugins/jquery_visible/jquery.visible.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script type="text/javascript" src="assets/js/misc/ie10-viewport-bug-workaround.js"></script>

	<!-- SCRIPTS - REQUIRED END -->

	<!-- SCRIPTS - OPTIONAL START -->
	<!-- Image Placeholder -->
	<script type="text/javascript" src="assets/js/misc/holder.min.js"></script>
	<!-- SCRIPTS - OPTIONAL END -->

	<!-- QuillPro Scripts -->
	<script type="text/javascript" src="assets/js/scripts.js"></script>
</body>
</html>