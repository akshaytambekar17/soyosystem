<html>
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>		
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
								<div class="profile-page-center">
									<div class="comment-block edit-profile">
										<div class="form-group">
											<h3><?= !empty($vfd_details)?'Update':'Add' ?> VFD</h3>
											<?php echo validation_errors('<div class="error">', '</div>'); ?>
											<?php
											
												
												$attribute=array('method'=>'post');
												echo form_open_multipart('',$attribute);

												echo form_input(['type'=>'text','name'=>'vfd_name','class'=>'form-control form-group','placeholder'=>'VFD name','value'=>!empty($vfd_details[0]->vfd_name)?$vfd_details[0]->vfd_name:set_value('vfd_name')]);
		
											?>	
											<select id="state" name="drive_manufacture" class="form-control select2" placeholder="Select Drive Manufacture" data-live-search="true" >

						                             <option disabled selected>Select Drive Manufacture</option>
						                                <?php foreach ($device_manufacture as $value) { 

						                                		if(!empty($vfd_details)){

					                                		 		$sManufacture = ($vfd_details[0]->drive_manufacture_id == $value['id'])?'selected="selected"':'';
						                                		}else{
						                                			$sManufacture="";
						                                		}
					                                	?>
						                                   <option value="<?php echo $value['id'];?>" <?= $sManufacture?> >
					                                   			<?php echo $value['name']; ?>      
						                                   </option>
					                                   <?php } ?>  
				                            </select>
				                            
											<?php
												
												echo form_input(['type'=>'hidden','name'=>'id','value'=>!empty($vfd_details[0]->id)?$vfd_details[0]->id:'']);

												echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>!empty($device_details)?'Update':'Save']);
											?>
											
											</form>
										</div>
									</div>
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
<?php $this->load->view('includes/footer');?>
</body>

</html>