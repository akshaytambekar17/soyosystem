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
					<div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark">
						<a class="signin-logo d-sm-block d-md-none" href="#">
							<img src="assets/img/logo-white.png" width="145" height="32.3" alt="SoyoSystem">
						</a>
						<h1 class="display-4">Sign In To get Started</h1>
						<p class="lead mb-5">
							Big data latte SpaceTeam unicorn cortado hacker physical computing paradigm.
						</p>
					</div>
					<div class="col-md-5 order-md-1 signin-left-column bg-white px-5"><br><br><br><br>
						<a class="signin-logo d-sm-none d-md-block" href="#">
							<img src="<?php echo base_url();?>assets/img/logo.jpg" width="145" height="32.3" alt="SoyoSystem">
						</a>
						<?php
							echo form_open('Home_Controller/login');
						?>
							<div class="form-group">
								<?php
								if($this->form_validation->run() == FALSE)
								{echo "<p class='text-danger'>".form_error('uname')."</p>";}
								?>
								<label for="exampleInputEmail1">Username</label>
								<?php
									echo form_input(['type'=>'text','name'=>'uname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Username']);
								?>
							</div>
							<div class="form-group">
								<?php
								if($this->form_validation->run() == FALSE)
								{echo "<p class='text-danger'>".form_error('password')."</p>";}
								?>
								<label for="exampleInputPassword1">Password</label>
								<?php
									echo form_input(['type'=>'password','name'=>'password','class'=>'form-control','id'=>'exampleInputPassword','placeholder'=>'Password']);
								?>
							</div>
							<div class="form-check">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"> Keep Me Signed In</span>
								</label>
							</div>
							<button type="submit" class="btn btn-primary btn-gradient btn-block">
								<i class="batch-icon batch-icon-key"></i>
								Sign In
							</button>
							<hr>
							<p class="text-center">
								Don't Have An Account? <a href="<?php echo base_url();?>Home_Controller/registration">Sign Up here</a>
							</p>
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