<!DOCTYPE html>
<html lang="en">
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
								<div class="">
									<div class="profile-page-center">
										<h1 class="card-user-profile-name">&nbsp;All Distributors</h1>
										<hr />
										<ul class="list-unstyled mt-5">
										<?php
										foreach($distributer as $row)
										{
										?>
											<li class="media">
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-3">	
															<div class="profile-picture bg-gradient bg-primary mb-4">
																<img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($row->profile_image)?$row->profile_image:'admin.png' ?>" width="55" height="55">
															</div>
														</div>
														<div class="col-md-9">	
															<div class="media-body">
																<div class="media-title mt-0 mb-1">
																	<a href="<?php echo base_url();?>Admin_Manufracture/edit_distributer_view?id=<?php echo $row->user_id?>"><?php echo $row->fname." ".$row->lname;?></a> <small> <em><?php echo $row->dist.", ".$row->city;?></em></small>
																</div>
																<em><?= $row->date?></em> |
																<em><?= $row->time?></em>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="row">
														<div class="col-md-3">
															<a href="<?php echo base_url();?>Admin_Manufracture/edit_distributer_view?id=<?php echo $row->user_id?>" class="btn btn-default btn-sm waves-effect waves-light pull-right"><b>Edit<br> Profile</b></a>
														</div>
														<div class="col-md-3">
															<a href="<?php echo base_url();?>Home_Controller/login?id=<?php echo $row->user_id?>" class="btn btn-secondary btn-sm waves-effect waves-light" target="_blank">Open<br> Dashboard</a>
														</div>
														<div class="col-md-3">
															<a href="<?php echo base_url();?>Admin_Manufracture/delete_distributer?id=<?php echo $row->user_id?>" class="btn btn-danger btn-sm waves-effect waves-light deletedistributer" data-confirm="Are you sure you want to delete this distributer?">Delete<br> Distributor</a>
														</div>
													</div>
												</div>
											</li><hr>
										<?php
										}
										?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>

<script>
	var deleteLinks = document.querySelectorAll('.deletedistributer');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
        window.location.href = this.getAttribute('href');
      }
  });
}
</script>
</body>
</html>