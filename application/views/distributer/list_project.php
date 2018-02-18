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
								<div class="card-header">
									Projects List
								</div>
								<div class="card-body">
									<ul class="list-unstyled mt-5">
									<?php
									//foreach($pro as $row)
									//{
									?>
										<li class="media">
											<div class="profile-picture bg-gradient bg-primary mb-4">
												<img src="assets/img/profile-pic.jpg" width="44" height="44">
											</div>&nbsp;
											<div class="media-body">
												<!--div class="media-title mt-0 mb-1">
													<a href="#"><?php echo $row->project_name;?></a> <small> <em><?php echo $row->project_state.", ".$row->project_dist.", ".$row->project_city;?></em></small>
												</div-->
												<div class="media-title mt-0 mb-1">
													<a href="#">Project name</a> <small> <em>State, District, City</em></small>
												</div>
												<em>4 Users</em> |
												<em>7 Systems</em>
											</div>
										</li>
									<?php
									//}
									?>
									</ul>
								</div>
							</div>
						</div>
					</div> 
				</main>
			</div>
		</div>
	</div>


</body>
</html>