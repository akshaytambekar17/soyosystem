<!DOCTYPE html>
<html lang="en">
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>		
</head>

<body>

	<div class="container-fluid">
		<div class="row">
			<div class="right-column">
				<main class="main-content p-5" role="main">
					<div class="row mb-4">
						<div class="col-md-12">
							<?php if($message = $this ->session->flashdata('Message')){?>
						            <div class="col-md-12 ">
						                <div class="alert alert-dismissible alert-success">
						                    <button type="button" class="close" data-dismiss="alert">&times;</button>
						                    <?=$message ?>
						                </div>
						            </div>
					        <?php }?> 
					        <?php if($message = $this ->session->flashdata('Error')){?>
					            <div class="col-md-12 ">
					                <div class="alert alert-dismissible alert-danger">
					                    <button type="button" class="close" data-dismiss="alert">&times;</button>
					                    <?=$message ?>
					                </div>
					            </div>
					        <?php }?> 
							<div class="card">
								<div class="card-user-profile">
									<div class="profile-page-center">
										<h1 class="card-user-profile-name">All Device</h1>
										<hr />
										<ul class="list-unstyled mt-5">
										<?php
										foreach($device_list as $row)
										{
										?>
											<li class="media">
												<div class="col-md-6">
													<div class="media-body">
														<div class="media-title mt-0 mb-1">
															<p>Device Name</p>
														</div>
														<div class="media-title mt-0 mb-1">
															<a href="<?php echo base_url();?>Admin_Manufracture/edit_device?id=<?php echo $row['id']?>"><?php echo $row['device_name'];?></a> 

														</div>
														
													</div>
														
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<a href="<?php echo base_url();?>Admin_Manufracture/edit_device?id=<?php echo $row['id']?>" class="btn btn-primary btn-sm waves-effect waves-light">Edit Device</a>
														</div>
														<div class="col-md-6">
															<a href="<?php echo base_url();?>Admin_Manufracture/delete_device?id=<?php echo $row['id']?>" class="btn btn-secondary btn-sm waves-effect waves-light">Delete Device</a>
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
				</main>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
		

	});
	
</script>

</body>
</html>