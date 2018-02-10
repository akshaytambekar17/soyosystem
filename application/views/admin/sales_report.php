<!DOCTYPE html>
<?php 
	/*$this->load->model('User_model');
	$this->load->model('Admin_model');
	$this->load->model('Common_model');*/
	$CI =& get_instance();
	$CI->load->model('User_model');
?>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://base5builder.com/livedemo/quillpro/v1.2/demo_files/assets/plugins/datatables/css/responsive.dataTables.min.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>		
	<script type="text/javascript" src="https://base5builder.com/livedemo/quillpro/v1.2/demo_files/assets/plugins/datatables/js/jquery.dataTables.min.js"></script>

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

										<h1 class="card-user-profile-name">Sales Report</h1>
										<p class="text-right">
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exports</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="javascript:void(0)">CSV File</a>
													<a class="dropdown-item" href="javascript:void(0)">PDF File</a>
												</div>
											</div>
										</p>
										<br>
										<br>
										<br>
										<table id="datatable-1" class="table table-datatable table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th>Username</th>
													<th>Device Name</th>
													<th>Drive Manufacture name</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($device_parameters_data as $row){
												?>					
														<tr>
														<td>
															<?php

																/*$username=$this->User_model->get_user_by_id($row['user_id']);
																echo $username[0]->fname." ". $username[0]->lname;*/
																echo $row['user_id'];
															?>
														</td>
														<td>
															<?php
																
																/*$device_detail=$this->Admin_model->get_device_by_id($row['dev_imei']);
																echo $device_detail[0]->name;*/
																echo $row['dev_imei'];
															?>
														</td>
														<td>
															<?php
																
																/*$drive_manufacture=$this->Common_model->get_drive_manufacture_by_id($device_detail[0]->drive_manufacture_id);
																echo $drive_manufacture[0]->name;*/
																echo $row['dev_imei'];
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
	<script type="text/javascript">
	$(document).ready(function(){
		
		$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
		

	});
	
</script>

</body>
</html>