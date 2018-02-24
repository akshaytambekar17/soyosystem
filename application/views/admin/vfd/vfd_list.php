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
									<div class="profile-page-center" style="width: 100%;">
										<h1 class="card-user-profile-name">All VFD</h1>
										<hr />
										<ul class="list-unstyled mt-5">
										<?php foreach($vfd_list as $row){ ?>
											<li class="media">
												<div class="col-md-4">
													<div class="media-body">
														<div class="media-title mt-0 mb-1">
															<p>VFD Name</p>
														</div>
														<div class="media-title mt-0 mb-1">
															<a href="<?php echo base_url();?>Admin_Manufracture/edit_vfd?id=<?php echo $row['id']?>"><?php echo $row['vfd_name'];?></a> 

														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="media-body">
														<div class="media-title mt-0 mb-1">
															<p>Drive Manufacture</p>
														</div>
														<div class="media-title mt-0 mb-1">
															<?php
																$drive=$this->Common_model->get_drive_manufacture_by_id($row['drive_manufacture_id']);
															?>
															<h5><?= $drive[0]->name ?></h5>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-6">
															<a href="<?php echo base_url();?>Admin_Manufracture/edit_vfd?id=<?php echo $row['id']?>" class="btn btn-success waves-effect waves-light">Edit VFD</a>
														</div>
														<div class="col-md-6">
															<a href="<?php echo base_url();?>Admin_Manufracture/delete_vfd?id=<?php echo $row['id']?>" class="btn btn-secondary waves-effect waves-light deletevfd" data-confirm="Are you sure to delete this VFD?">Delete VFD</a>
														</div>
													</div>
												</div>
											</li>
										<?php } ?>
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
<script>
	var deleteLinks = document.querySelectorAll('.deletevfd');

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