<!DOCTYPE html>

<html lang="en">
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>		
	<link href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  	<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<!-- <link rel="stylesheet" href="https://base5builder.com/livedemo/quillpro/v1.2/demo_files/assets/plugins/datatables/css/responsive.dataTables.min.css">
	<script type="text/javascript" src="https://base5builder.com/livedemo/quillpro/v1.2/demo_files/assets/plugins/datatables/js/jquery.dataTables.min.js"></script> -->

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

										<h1 class="card-user-profile-name">All Notifications</h1>
										
										<table id="list_notification" class="table table-datatable table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th>Message</th>
													<th>From</th>
													<th>User</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($notifications as $row){
												?>					
														<tr>
														<td>
															<?php echo $row['message'];?>
														</td>
														<td>
															<?php
																$username=$this->User_model->get_user_by_id($row['send_from']);
																if($username[0]->user_id==1){
																	echo "Admin Soyo";	
																}else{
																	echo $username[0]->fname." ". $username[0]->lname;	
																}
																
															?>
														</td>
														<td>
															<?php
																
																$username=$this->User_model->get_user_by_id($row['user_id']);
																if(!empty($username)){
																	if($username[0]->user_id==1){
																		echo "Admin Soyo";	
																	}else{
																		echo $username[0]->fname." ". $username[0]->lname;	
																	}
																}else{
																	echo "No user";
																}
															?>
														</td>
													</tr>
												<?php
													}
												?>
											</tbody>
										</table>
										
										
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
		$('#list_notification').DataTable();
		$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
		

	});
	
</script>

</body>
</html>