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
								<div class="card-user-profile">
									<div class="profile-page-center">
										<h1 class="card-user-profile-name">All Projects</h1>
										<hr />
										<ul class="list-unstyled mt-5">
										<?php
										foreach($pro as $row)
										{
										?>
											<li class="media">
												<div class="profile-picture bg-gradient bg-primary mb-4">
													<img src="assets/img/profile-pic.jpg" width="44" height="44">
												</div>
												<div class="media-body">
													<div class="media-title mt-0 mb-1">
														<a href="#"><?php echo $row->project_name;?></a> <small> <em><?php echo $row->project_state.", ".$row->project_dist.", ".$row->project_city;?></em></small>
													</div>
													<em>4 Users</em> |
													<em>7 Systems</em>
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