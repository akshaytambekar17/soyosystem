<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?php echo base_url();?>assets/img/logo.png">

	<title>SoyoSystems|Realtime Monitoring</title>
	<!--My Style.css-->
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

	<!-- CSS - REQUIRED - START -->
	<!-- Batch Icons -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/batch-icons/css/batch-icons.css">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.min.css">
	<!-- Material Design Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/mdb.min.css">
	<!-- Custom Scrollbar -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css">
	<!-- Hamburger Menu -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/hamburgers/hamburgers.css">

	<!-- CSS - REQUIRED - END -->

	<!-- CSS - OPTIONAL - START -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome/css/font-awesome.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome/css/font-awesome.min.css">
	<!-- JVMaps -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvmaps/jqvmap.min.css">
	<!-- CSS - OPTIONAL - END -->

	<!-- QuillPro Styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/quillpro/quillpro.css">
	

	
</head>

<body>
<div class="container-fluid">
		<div class="row">
			<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
				<ul class="nav nav-pills flex-column">
					<li class="logo-nav-item">
						<a class="navbar-brand" href="#">
							<img src="<?php echo base_url();?>assets/img/logo.png" width="145" height="32.3" alt="Soyo Systems">
						</a>

					</li>
					<li>
						<h4 class="nav-header">General</h4>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>Admin_Manufracture">
							<i class="batch-icon batch-icon-browser-alt"></i>
							Dashboard <span class="sr-only">(current)</span>
						</a><br>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>Admin_Manufracture/profile/<?php echo $this->session->userdata('user_id');?>">
							<i class="batch-icon batch-icon-polaroid"></i>
							Profile
						</a><br>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-parent" href="starter-kit.html">
							<i class="batch-icon batch-icon-paragraph-alt-justify"></i>
							Reports
						</a>
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<a class="nav-link" href="layout-left-menu-hidden.html">
									<i class="batch-icon batch-icon-star"></i>
								Sales Report</a><br>
							</li>
						</ul>
					</li>
					<?php
					if($this->session->userdata('user_type') == 1)
					{
					?>
					<li class="nav-item"><br>
						<a class="nav-link nav-parent" href="starter-kit.html">
							<i class="batch-icon batch-icon-users"></i>
							Distributers
						</a>
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Admin_Manufracture/add_distributer_view">
									<i class="batch-icon batch-icon-user-alt-add"></i>
								Add Distributer</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Admin_Manufracture/edit_distributer_view">
									<i class="batch-icon batch-icon-compose-alt-3"></i>
								Edit Distributer</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Distributer_Manufracture/all_distributer_view">
									<i class="batch-icon batch-icon-menu-alt"></i>
								List</a>
							</li>
						</ul>
					</li>
					<?php }?>
					<?php
					if($this->session->userdata('user_type') == 3)
					{
					?>
					<li class="nav-item"><br>
						<a class="nav-link nav-parent" href="#">
							<i class="batch-icon batch-icon-user-alt-3"></i>
							Systems
						</a>
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Distributer_Manufracture/add_project_view">
									<i class="batch-icon batch-icon-add"></i>
								Add System</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Distributer_Manufracture/edit_project_view">
									<i class="batch-icon batch-icon-compose-alt-3"></i>
								Moniter System</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="layout-left-menu-normal.html">
									<i class="batch-icon batch-icon-menu"></i>
								List</a>
							</li>
						</ul>
					</li>
					<?php
					}
					else
					{?>
					<li class="nav-item"><br>
						<a class="nav-link nav-parent" href="#">
							<i class="batch-icon batch-icon-user-alt-3"></i>
							Users
						</a>
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Admin_Manufracture/add_distributer_view">
									<i class="batch-icon batch-icon-user-alt-add"></i>
								Add User</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Admin_Manufracture/edit_user_view">
									<i class="batch-icon batch-icon-compose-alt-3"></i>
								Edit User</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>User_Manufracture/all_user_view">
									<i class="batch-icon batch-icon-menu"></i>
								User List</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					<?php
					if($this->session->userdata('user_type') != 3)
					{
					?>
					<li class="nav-item"><br>
						<a class="nav-link nav-parent" href="#">
							<i class="batch-icon batch-icon-exclude"></i>
							Projects
						</a>
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Distributer_Manufracture/add_project_view">
									<i class="batch-icon batch-icon-add"></i>
								New Project</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Distributer_Manufracture/edit_project_view">
									<i class="batch-icon batch-icon-compose-alt-3"></i>
								Edit Project</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="layout-left-menu-normal.html">
									<i class="batch-icon batch-icon-menu"></i>
								Project List</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					<li class="nav-item"><br>
						<a class="nav-link" href="<?php echo base_url();?>Home_Controller/view_notification">
							<i class="batch-icon batch-icon-watch"></i>
							Notification
						</a>
					</li>
					<li class="nav-item"><br>
						<a class="nav-link" href="starter-kit.html">
							<i class="batch-icon batch-icon-watch"></i>
							AMC Status
						</a><br>
					</li>
					<li class="nav-item logout">
						<a class="nav-link" href="<?php echo base_url();?>Home_Controller/logout">
							<i class="batch-icon batch-icon-outgoing-alt"></i>
							Logout
						</a>
					</li>
				</ul>
			</nav>

			<div class="right-column">
				<nav class="navbar navbar-expand-lg navbar-light bg-white">
					<button class="hamburger hamburger--slider" type="button" data-target=".sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Sidebar">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>

					<div class="navbar-collapse" id="navbar-header-content">
						<ul class="navbar-nav navbar-language-translation mr-auto">
							<li class="nav-item dropdown">
									<i class="batch-icon batch-icon-book-alt-"></i>
									English
							</li>
						</ul>
						<ul class="navbar-nav navbar-notifications float-right">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbar-notification-search" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<i class="batch-icon batch-icon-search"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-fullscreen" aria-labelledby="navbar-notification-search">
									<li>
										<form class="form-inline my-2 my-lg-0 no-waves-effect">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Search for...">
												<span class="input-group-btn">
													<button class="btn btn-primary btn-gradient waves-effect waves-light" type="button">Search</button>
												</span>
											</div>
										</form>
									</li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle no-waves-effect" id="navbar-notification-calendar" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<i class="batch-icon batch-icon-calendar"></i>
									<span class="notification-number">6</span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right dropdown-menu-md" aria-labelledby="navbar-notification-calendar">
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">Meeting with Project Manager</h6>
												<div class="notification-text">
													Cras sit amet nibh libero
												</div>
												<span class="notification-time">Right now</span>
											</div>
										</a>
									</li>
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">Sales Call</h6>
												<div class="notification-text">
													Nibh amet cras sit libero
												</div>
												<span class="notification-time">One hour from now</span>
											</div>
										</a>
									</li>
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">Email CEO new expansion proposal</h6>
												<div class="notification-text">
													Cras sit amet nibh libero
												</div>
												<span class="notification-time">In 3 days</span>
											</div>
										</a>
									</li>
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">Team building exercise</h6>
												<div class="notification-text">
													Cras sit amet nibh libero
												</div>
												<span class="notification-time">In one week</span>
											</div>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle no-waves-effect" id="navbar-notification-misc" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<i class="batch-icon batch-icon-bell"></i>
									<span class="notification-number">4</span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right dropdown-menu-md" aria-labelledby="navbar-notification-misc">
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-bell batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">General Notification</h6>
												<div class="notification-text">
													Cras sit amet nibh libero
												</div>
												<span class="notification-time">Just now</span>
											</div>
										</a>
									</li>
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-cloud-download batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">Your Download Is Ready</h6>
												<div class="notification-text">
													Nibh amet cras sit libero
												</div>
												<span class="notification-time">5 minutes ago</span>
											</div>
										</a>
									</li>
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">New Order</h6>
												<div class="notification-text">
													Cras sit amet nibh libero
												</div>
												<span class="notification-time">Yesterday</span>
											</div>
										</a>
									</li>
									<li class="media">
										<a href="task-list.html">
											<i class="batch-icon batch-icon-pull batch-icon-xl d-flex mr-3"></i>
											<div class="media-body">
												<h6 class="mt-0 mb-1 notification-heading">Pull Request</h6>
												<div class="notification-text">
													Cras sit amet nibh libero
												</div>
												<span class="notification-time">3 day ago</span>
											</div>
										</a>
									</li>
								</ul>
							</li>
						</ul>
						</a>
						<?php if(!empty($this->session->userdata('user_id'))){
								$this->load->model('Home_model');
								$user_details=$this->Home_model->profile_details($this->session->userdata('user_id'));
								$image=$user_details[0]->profile_image;
								if(empty($image)){
									$image="admin.png";	
								}
							}else{
								$image="admin.png";
							}
						?>
						<ul class="navbar-nav ml-5 navbar-profile">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<div class="profile-name">
										<?php
										if($this->session->userdata())
										{
											echo $this->session->userdata('user_fname')." ".$this->session->userdata('user_lname');
										}
										?>
									</div>
									<div class="profile-picture bg-gradient bg-primary has-message float-right">
										<img src="<?php echo base_url();?>assets/uploads/<?= $image?>" width="44" height="44">
									</div>

								<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-navbar-profile">
									<li><a class="dropdown-item" href="<?php echo base_url();?>Admin_Manufracture/profile/<?php echo $this->session->userdata('user_id');?>"><b>Profile</b></a></li>
									<li><a class="dropdown-item" href="#"><b>Settings</b></a></li>
									<li><a class="dropdown-item" href="<?php echo base_url();?>Home_Controller/logout"><b>Logout</b></a></li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
				<main>
					<?php $this->load->view($main_content); ?>
				</main>
			</div>
		</div>
	</div>

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