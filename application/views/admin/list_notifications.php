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
					<div class="row mb-5">
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
								<div class="card-header">
									All Notifications
									<h6>
										<?php 
										$notification=$this->Home_model->get_notification();	
										?>
										<span class="task-list-completed">
											<?php //if(count($notification)>0){ ?>
												<?= count($notification)?>
											<?php //} ?>
										</span> Notifications
									</h6>
									<div class="progress">
										<div class="progress-bar progress-bar-sm bg-gradient" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
									</div>
									<!--div class="header-btn-block">
										<a href="task-manager.html" class="btn btn-primary">
											<i class="batch-icon batch-icon-add"></i> 
											Add New Task
										</a>
									</div-->
								</div>
								<div class="card-task-list">
									<ul class="task-list">
										<?php foreach($notifications as $row)
										{?>
										<li class="task-list-item">
											<div class="checkbox" data-toggle="buttons">
												<label class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input">
													<span class="custom-control-indicator"></span>
													<span class="custom-control-description"><?php echo $row['message'];?></span><br>
													<span class="text-default"><em>&nbsp;<?php echo $row['created_at'];?></em></span>
												</label>
											</div>
											<div class="task-item-details">
												<p>From :<span class="text-primary"> <?php
																$username=$this->User_model->get_user_by_id($row['send_from']);
																if($username[0]->user_id==1){
																	echo "Admin Soyo";	
																}else{
																	echo $username[0]->fname." ". $username[0]->lname;	
																}
																
															?>
													</span></p>
												<p>User :<span class="text-primary"> <?php
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
													</span></p>
											</div>
											<div class="task-item-controls">
												<a role="button" class="btn btn-info btn-sm show-task" href="#">
													<span class="batch-icon batch-icon-arrow-down"></span>
												</a>
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
				</main>
			</div>
		</div>
	</div>

	<!--div class="container-fluid">
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
	</div-->

	<script type="text/javascript">
	$(document).ready(function(){
		$('#list_notification').DataTable();
		$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
		

	});
	
</script>
<?php $this->load->view('includes/footer');?>
</body>
</html>