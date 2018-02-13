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
										<h1 class="card-user-profile-name">All Distributers</h1>
										<hr />
										<ul class="list-unstyled mt-5">
										<?php
										foreach($distributer as $row)
										{
										?>
											<li class="media">
												<div class="col-md-6">
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
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-4">
															<a href="<?php echo base_url();?>Admin_Manufracture/edit_distributer_view?id=<?php echo $row->user_id?>" class="btn btn-success btn-sm waves-effect waves-light"><b>Edit<br> Profile</b></a>
														</div>
														<div class="col-md-4">
															<a href="<?php echo base_url();?>Home_Controller/login?id=<?php echo $row->user_id?>" class="btn btn-secondary btn-sm waves-effect waves-light" target="_blank">Open Dashboard</a>
														</div>
														<div class="col-md-4">
															<a href="#" class="btn btn-danger btn-sm waves-effect waves-light" target="_blank">Delete Distributer</a>
														</div>
													</div>
												</div>
											</li>
										<?php
										}
										?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-4">
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


</body>
</html>