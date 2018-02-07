<html>
<head>
	
</head>

<body>
<div class="container-fluid">
	<div class="row">
		<div class="right-column">
			<main class="main-content p-5" role="main">
				<div class="row mb-4">
					<div class="col-md-12">
						<div class="card">
							
							<div class="card-user-profile">
								<div class="profile-page-left">
									<div class="row">
										<div class="col-lg-12 mb-4">
											<div class="profile-picture profile-picture-lg bg-gradient bg-primary mb-4">
												<img src="assets/img/profile-pic.jpg" width="144" height="144">
											</div>
											<a class="btn btn-primary btn-block btn-gradient" href="#">
												<i class="batch-icon batch-icon-user-alt-add-2"></i>
												Change Profile
											</a>
										</div>
										<div class="col-sm-6">
											<h5 class="my-0">Followers</h5>
											<div class="h3 my-0">
												<a href="#">682</a>
											</div>
										</div>
										<div class="col-sm-6">
											<h5 class="my-0">Following</h5>
											<div class="h3 my-0">
												<a href="#">341</a>
											</div>
										</div>
									</div>
									<hr />
									<h5>
										<i class="batch-icon batch-icon-users"></i>
										Search User
									</h5>
									<div class="profile-page-block-outer clearfix">
										<?php
										echo form_open('Admin_Manufracture/search_user');
										?>
										<div class="input-group">
											<input type="search" name="euser" class="form-control" placeholder="Search for...">
											<input type="hidden" name="utype" class="form-control" value="3">
											<span class="input-group-btn">
												<button class="btn btn-primary btn-gradient waves-effect waves-light" name="val_search" type="submit"><span class="gradient">Search</span></button>
											</span>
										</div>
										</form>
										<a class="float-right mt-2" href="#">More</a>
									</div>
									<hr />
									<h5>
										<i class="batch-icon batch-icon-image"></i>
										Search Result
									</h5>
									<p class="text-danger">
										<?php
										if($this->session->flashdata('no_result'))
										{
											echo $this->session->flashdata('no_result');
										}
										?>
									</p>
									<ul class="search-results-lis list-unstyled">
									<?php
									if(isset($_POST['val_search']))
									{
										foreach($user as $row)
										{?>
										<li class="media mt-4">
											<div class="profile-picture bg-gradient bg-primary mb-4">
												<img src="<?php echo base_url();?>assets/img/featured.png" width="44" height="44">
											</div>
											<div class="media-body">
												<div class="media-title mt-0 mb-1">
													<?php echo $row->fname." ".$row->lname; ?>
												</div>
												<em>City : <?php echo $row->city; ?></em> 
												<?php
												echo form_open('Admin_Manufracture/profile');
													?>
													<div class="input-group">
														<input type="hidden" name="uid" value="<?php echo $row->user_id;?>">
														<input type="hidden" name="utype" value="3">
														<button class="btn btn-primary btn-gradient waves-effect waves-light" name="select_user" type="submit"><span class="gradient"><em>Edit</em></span></button>
													</div>
												</form>
											</div>
										</li>
										<?php
										}
									}
									?>
									</ul>
								</div>
								<div class="profile-page-center">
									<h1 class="card-user-profile-name">
										<?php
										if($this->session->userdata('user_fname'))
										{
											echo $this->session->userdata('user_fname')." ".$this->session->userdata('user_lname');
										}
										?>
									</h1>
									<hr />
									<div class="comment-block edit-profile">
										<div class="form-group">
											<h3>Edit User Personal Details</h3>
											<?php
											if($this->session->flashdata('update_success'))
											{
												echo "<p class='text-success'>".$this->session->flashdata('update_success')."</p>";
											}
											if(isset($_POST['select_user']))
											{
												foreach($user_details as $row)
												{
												echo form_open('Admin_Manufracture/update_profile');

												echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control form-group','value'=>$row->fname]);

												echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control form-group','value'=>$row->lname]);

												echo form_input(['type'=>'email','name'=>'email','class'=>'form-control form-group','value'=>$row->email]);

												echo form_input(['type'=>'text','name'=>'state','class'=>'form-control form-group','value'=>$row->state]);

												echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control form-group','value'=>$row->dist]);

												echo form_input(['type'=>'text','name'=>'city','class'=>'form-control form-group','value'=>$row->city]);

												echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control form-group','value'=>$row->mobile]);

												echo form_input(['type'=>'hidden','name'=>'uid','value'=>$row->user_id]);
												echo form_input(['type'=>'hidden','name'=>'utype','value'=>$row->type]);

												echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Save Changes']);
												}
											}
											?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer');?>
</body>
</html>