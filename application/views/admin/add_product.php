<!DOCTYPE html>
<html lang="en">
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>	
	<style type="text/css">
		.error{
			color: red;
		}
	</style>
</head>

<body>
	<?php
		if($this->session->userdata('admin'))
		{
			$session=$this->session->userdata('admin');
		}
		else if($this->session->userdata('distributer'))
		{
			$session=$this->session->userdata('distributer');
		}
		else
		{
			$session=$this->session->userdata('user');
		}

	?>
	<div class="container-fluid">
		<div class="row">
			<div class="right-column">
				<main class="main-content p-5" role="main">
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
					<div class="row mb-5" style="height: 450px">
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
								<div class="card-header text-center">
									Add Product
									<?php
									
									$attribute=array('method'=>'post');
									echo form_open_multipart('',$attribute);
									?>
									
								</div>
								<div class="card">
									<div class="col-lg-12" style="margin: 64px 0px;">
										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-4">
												<?php echo validation_errors('<div class="error">', '</div>'); ?>
												<div class="form-group">
													<label for="exampleInputEmail1">Product Name</label>
													<?php
														echo form_input(['type'=>'text','name'=>'pname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter product name','value'=>set_value('new_password')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Product Image</label>
													<?php
														echo form_input(['type'=>'file','name'=>'pimage','class'=>'form-control form-group']);
														echo form_input(['type'=>'hidden','name'=>'addedby','class'=>'form-control form-group','value'=>$session['user_id']]);
													?>
												</div>
												<button type="submit" name="product_submit" class="btn btn-primary btn-gradient btn-block">
														<i class="batch-icon batch-icon-key"></i>
														Add
												</button>
												
											</div>
											<div class="col-md-4"></div>	
										</form>
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
		
	<?php $this->load->view('includes/footer'); ?>
</body>
</html>