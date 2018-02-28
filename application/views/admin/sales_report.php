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
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>		
	<!-- <link rel="stylesheet" href="https://base5builder.com/livedemo/quillpro/v1.2/demo_files/assets/plugins/datatables/css/responsive.dataTables.min.css">
	<script type="text/javascript" src="https://base5builder.com/livedemo/quillpro/v1.2/demo_files/assets/plugins/		datatables/js/jquery.dataTables.min.js"></script> -->
	<style type="text/css">
		.error{
			color: red;
		}
	</style>
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
										<br>
										<br>
										<form action="" method="post">
										<?php echo validation_errors('<div class="error">', '</div>'); ?>
										<div class="row">
											<div class="col-md-3">
												<select id="distributer" name="distributer" class="form-control select2"  data-live-search="true" >

	                                                <option disabled selected>Select Distributor</option>
                                                        <?php foreach ($distributer as $value) { ?>
                                                           <option value="<?php echo $value->user_id;?>">
                                                                <?php echo $value->fname." ".$value->lname; ?>      
                                                           </option>
	                                                   <?php } ?>  
	                                            </select>
											</div>
											<div class="col-md-3">
												<select id="user" name="user" class="form-control select2" data-live-search="true" >
                                                    <option disabled selected>Select User</option>
	                                            </select> 	
											</div>	
											<div class="col-md-3">
												<input type="submit" name="serach" value="Search"  class="btn btn-success" />
											</div>
											<div class="col-md-3">
												<p class="text-right">
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exports</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0)" id="csv_export">CSV File</a>
															<a class="dropdown-item" href="javascript:void(0)" id="pdf_export">PDF File</a>
															<!-- <a class="dropdown-item" href="javascript:void(0)">PDF File</a> -->
														</div>
													</div>
												</p>
											</div>

										</div>
										</form>
										<input type="hidden" name="user_id" value="<?= !empty($user_id)?$user_id:''?>" id="user_id">
										<input type="hidden" name="distributer_id" value="<?= !empty($distributer_id)?$distributer_id:''?>" id="distributer_id">
										<br>
										<br>
										<br>
										<table id="datatable-1" class="table table-datatable table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th><b>User Name</b></th>
													<th><b>Aadhar number</b></th>
													<th><b>Device Type</b></th>
													<th><b>Device Imei</b></th>
													<th><b>Installation Date</b></th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($user_details as $row){
												?>					
													<tr>
														<td>
															<?php

																$username=$this->User_model->get_user_by_id($row->user_id);
																echo $username[0]->fname." ". $username[0]->lname;
																//echo $row['user_id'];
															?>
														</td>
														<td>
															<?php echo $row->adhar; ?>
														</td>
														<td>
															<?php
																$device_type=$this->Admin_model->get_device_by_id($row->device_type);
																echo $device_type[0]->device_name;
															?>
														</td>
														<td>
															<?php echo $row->imei_no; ?>
														</td>
														<td>
															<?php echo $row->installation_date; ?>
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
		
		$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
		$("#distributer").change(function(){
			var distributer = $(this).val();
			$.ajax({
              	type: "POST",
              	url: "<?php echo base_url(); ?>" + "/Admin_Manufracture/get_user_by_distributer",
              	data: { 'distributer' : distributer},
              	dataType: 'html',
              	success: function(data){
	                var obj = $.parseJSON(data);
	                console.log(obj);
	                jQuery("#user").html('<option disabled selected> Select User</option>');
	                jQuery("#user").append(obj);

              	}
	        });
		});
		$("#csv_export").click(function(){
            
            var user_id=$("#user_id").val();
            var distributer_id=$("#distributer").val();
            
            if(user_id=='' &&  (distributer_id=='' || distributer_id==null)){
                alert("User is not selected all data will export");
                window.location= '<?php echo base_url(); ?>Admin_Manufracture/sale_reports_export'; 
            }else if (user_id=='' &&  (distributer_id!='' || distributer_id!=null)){
            	alert("Distributor is only selected all user related to distributer will export");
               window.location= '<?php echo base_url(); ?>Admin_Manufracture/sale_reports_export?distributer_id='+distributer_id;  
            }else{
               window.location= '<?php echo base_url(); ?>Admin_Manufracture/sale_reports_export?user_id='+user_id; 
            }
        });
        $("#pdf_export").click(function(){
            
            var user_id=$("#user_id").val();
            var distributer_id=$("#distributer_id").val();
            if(user_id=='' &&  (distributer_id=='' || distributer_id==null)){
                alert("User is not selected all data will export");
                window.location= '<?php echo base_url(); ?>Admin_Manufracture/sale_reports_pdf_export'; 
            }else if (user_id=='' &&  (distributer_id!='' || distributer_id!=null)){
            	alert("Distributor is only selected all user related to distributer will export");
                window.location= '<?php echo base_url(); ?>Admin_Manufracture/sale_reports_pdf_export?distributer_id='+distributer_id;  
            }else{
                
                window.location= '<?php echo base_url(); ?>Admin_Manufracture/sale_reports_pdf_export?user_id='+user_id; 
            }
        });

	});
	
</script>

</body>
</html>