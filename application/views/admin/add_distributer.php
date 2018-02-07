<!DOCTYPE html>
<html lang="en">
<head>
	
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="right-column">
				<main class="main-content p-5" role="main">
					<div class="row">
						<div class="col-md-12">
							<h1>Forms Wizard</h1>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									Registration
									<?php
									if($this->session->flashdata('registration_success'))
									{
										echo "<p class='text-success'>".$this->session->flashdata('registration_success')."</p>";
									}
									if($this->session->flashdata('registration_fail'))
									{
										echo "<p class='text-danger'>".$this->session->flashdata('registration_fail')."</p>";
									}

									$attribute=array('method'=>'post');
									echo form_open('Home_Controller/register',$attribute);
									?>
									<div class="progress">
										<div class="progress-bar progress-bar-sm bg-gradient" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
									</div>
								</div>
								<div class="card">
									<div class="col-lg-12">
										<div class="row">
											<div class="col-md-6">
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
													<label for="exampleInputEmail1">Mobile</label>
													<?php
														echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control','placeholder'=>'Enter Mobile']);
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
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Email address</label>
													<?php
														echo form_input(['type'=>'email','name'=>'email','class'=>'form-control','id'=>'exampleInputEmail1','aria-describedb'=>'emailHelp','placeholder'=>'Enter email']);
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
											</div>
												</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
							<footer>
								Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a>
							</footer>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>

	<?php $this->load->view('includes/footer'); ?>
</body>
</html>