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
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
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
									Distributer Registration
									<?php
									if($this->session->flashdata('registration_success'))
									{
										echo "<p class='text-success'>".$this->session->flashdata('registration_success')."</p>";
									}
									if($this->session->flashdata('registration_fail'))
									{
										echo "<p class='text-danger'>".$this->session->flashdata('registration_fail')."</p>";
									}

									$attribute=array('method'=>'post');
									echo form_open_multipart('',$attribute);
									?>
									<div class="progress">
										<div class="progress-bar progress-bar-sm bg-gradient" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
									</div>
								</div>
								<div class="card">
									<div class="col-lg-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">First Name</label>
													<?php
														echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter first name','value'=>set_value('fname')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Last Name</label>
													<?php
														echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter last name','value'=>set_value('lname')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Mobile</label>
													<?php
														echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control','placeholder'=>'Enter Mobile','value'=>set_value('mobile')]);
													?>
												</div>
												<!-- <div class="form-group">
													<label for="exampleInputEmail1">Select Category</label>
													<?php
														$options=array('distributer'=>'Distributer',
																		'user'=>'User');
														$attributes=array('class'=>'form-control');
														$selected= array('user');
														echo form_dropdown('category',$options,$selected,$attributes);
													?>
												</div> -->
												<div class="form-group">
													<label for="exampleInputEmail1">State</label>
													<?php
														//echo form_input(['type'=>'text','name'=>'state','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter state']);
													?>
													 <select id="state" name="state" class="form-control select2" placeholder="Select State" data-live-search="true" >

							                             <option disabled selected>Select State</option>
							                                <?php foreach ($state as $value) { ?>
							                                   <option value="<?php echo $value['id'];?>" <?php echo  set_select('category',$value['id'] ); ?>
							                                   	>
						                                   			<?php echo $value['name']; ?>      
							                                   </option>
						                                   <?php } ?>  
						                            </select>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">District</label>
													<?php
														//echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter district']);
													?>
													<select id="district" name="district" class="form-control select2" placeholder="Select District" data-live-search="true" >

							                         	<option disabled selected>Select District</option>
							                          
							                        </select> 
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">City</label>
													<?php
														echo form_input(['type'=>'text','name'=>'city','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter city','value'=>set_value('city')]);
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Email address</label>
													<?php
														echo form_input(['type'=>'email','name'=>'email','class'=>'form-control','id'=>'exampleInputEmail1','aria-describedb'=>'emailHelp','placeholder'=>'Enter email','value'=>set_value('email')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Username</label>
													<?php
														echo form_input(['type'=>'text','name'=>'username','class'=>'form-control','placeholder'=>'Enter username','value'=>set_value('username')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<?php
														echo form_input(['type'=>'password','name'=>'password','class'=>'form-control','id'=>'exampleInputPassword','placeholder'=>'Password','value'=>set_value('password')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Confirm Password</label>
													<?php
														echo form_input(['type'=>'password','name'=>'c_password','class'=>'form-control','id'=>'exampleInputPassword','placeholder'=>'Confirm Password','value'=>set_value('c_password')]);
													?>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Profile Image</label>
													<?php
														echo form_input(['type'=>'file','name'=>'profile_image','class'=>'form-control form-group']);
													?>
												</div>
												<hr>
												<button type="submit" class="btn btn-primary btn-gradient btn-block">
													<i class="batch-icon batch-icon-key"></i>
													Sign Up
												</button>
											</div>
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
			
		    $("#state").change(function(){
		    	var state = $("#state").val();
	            $.ajax({
	                      type: "POST",
	                      url: "<?php echo base_url(); ?>" + "/Admin_Manufracture/getdistrictlist",
	                      data: { 'state' : state },
	                      dataType: 'html',
	                      success: function(data){
	                        var obj = $.parseJSON(data);
	                        console.log(obj);
	                        jQuery("#district").html('<option disabled selected> Select District</option>');
	                        jQuery("#district").append(obj);

	                      }
                });
	        });
		      $(".alert").delay(5000).slideUp(200, function() {
		          $(this).alert('close');
		      });
		});
		</script>
		
	<?php $this->load->view('includes/footer'); ?>
</body>
</html>