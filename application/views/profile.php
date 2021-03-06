<html>
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
						<div class="card">
							<img class="card-img" src="	<?php echo base_url();?>assets/img/bg2.png" alt="Feature Image">
							<div class="card-user-profile">
								<div class="profile-page-left">
									<div class="row">
										<div class="col-lg-12 mb-4">
											<div class="profile-picture profile-picture-lg bg-gradient bg-primary mb-4">

												<img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'admin.png' ?>" width="144" height="144">
											</div>
											<!--a class="btn btn-primary btn-block btn-gradient" href="#">
												<i class="batch-icon batch-icon-user-alt-add-2"></i>
												Change Profile
											</a-->
											<h4 class="text-center"><?= $user_details[0]->fname." ".$user_details[0]->lname?></h4>
										</div>
										<!-- <div class="col-sm-6">
											<h5 class="my-0">Followers</h5>
											<div class="h3 my-0">
												<a href="#">682</a>
											</div>
										</div>
										<div class="col-sm-6">
											<h5 class="my-0">Following</h5>
											<div class="h3 my-0">
												<a href="#">341</a>
											</div>
										</div> -->
									</div>
									<hr />
									
								</div> 
								<div class="profile-page-center">
									<h1 class="card-user-profile-name">
										<?php
										if($this->session->userdata('user_fname'))
										{
											echo $this->session->userdata('user_fname')." ".$this->session->userdata('user_lname');
										}
										?>
									</h1>
									<hr />
									<div class="comment-block edit-profile">
										<div class="form-group">
											<h3>Personal Details</h3>
											<?php
											if($this->session->flashdata('update_success'))
											{
												echo "<p class='text-success'>".$this->session->flashdata('update_success')."</p>";
											}
											foreach($user_details as $row)
											{
											echo form_open_multipart('Admin_Manufracture/update_profile');

											echo "<label>First Name</label>";
											if($this->form_validation->run() == FALSE)
														{
															echo form_error('fname');
														}
											echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control form-group','value'=>$row->fname]);

											echo "<label>Last Name</label>";
											if($this->form_validation->run() == FALSE)
														{
															echo form_error('lname');
														}
											echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control form-group','value'=>$row->lname]);

											echo "<label>Email</label>";
											if($this->form_validation->run() == FALSE)
														{
															echo form_error('email');
														}
											echo form_input(['type'=>'email','name'=>'email','class'=>'form-control form-group','value'=>$row->email]);
											?>

											<label>Select State</label>
											<?php
											if($this->form_validation->run() == FALSE)
														{
															echo form_error('state');
														}
											?>
											<select id="state" name="state" class="form-control select2" placeholder="Select State" data-live-search="true" >

					                             <option disabled selected>Select State</option>
					                                <?php foreach ($state as $value) { 

				                                		 	$sState = ($row->state == $value['id'])?'selected="selected"':'';
				                                	?>
					                                   <option value="<?php echo $value['id'];?>" <?= $sState?> >
				                                   			<?php echo $value['name']; ?>      
					                                   </option>
				                                   <?php } ?>  
				                            </select>
				                            <input id="district_hidden" type='hidden' name="district_hidden" value="<?php echo $row->dist ;?>" />

				                            <label>Select District</label>
				                            <?php
				                            if($this->form_validation->run() == FALSE)
														{
															echo form_error('dist');
														}
				                            ?>
				                            <select id="district" name="dist" class="form-control select2" placeholder="Select District" data-live-search="true" >

						                         	<option disabled selected>Select District</option>
						                          
					                        </select> 
											<!-- echo form_input(['type'=>'text','name'=>'state','class'=>'form-control form-group','value'=>$row->state]);
											echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control form-group','value'=>$row->dist]); -->
											<?php 

											echo "<label>City</label>";
											if($this->form_validation->run() == FALSE)
														{
															echo form_error('city');
														}
											echo form_input(['type'=>'text','name'=>'city','class'=>'form-control form-group','value'=>$row->city]);

											echo "<label>Mobile</label>";
											if($this->form_validation->run() == FALSE)
														{
															echo form_error('mobile');
														}
											echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control form-group','pattern'=>'[789][0-9]{9}','value'=>$row->mobile]);

											echo "<label>Profile Image</label>";
											echo form_input(['type'=>'file','name'=>'profile_image','class'=>'form-control form-group']);
											echo form_input(['type'=>'hidden','name'=>'uid','value'=>$row->user_id]);
											echo form_input(['type'=>'hidden','name'=>'profile_image_hidden','value'=>$row->profile_image]);
											echo form_input(['type'=>'hidden','name'=>'utype','value'=>$row->type]);
											echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Save Changes']);
											}
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
		districtlist();
	    $("#state").change(districtlist);
      	$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
	});
	function districtlist(){
		var state = $("#state").val();
		var district_hidden = $("#district_hidden").val();
		
        $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>" + "/Admin_Manufracture/getdistrictlist",
                  data: { 'state' : state ,'district_hidden':district_hidden},
                  dataType: 'html',
                  success: function(data){
                    var obj = $.parseJSON(data);
                    console.log(obj);
                    jQuery("#district").html('<option disabled selected> Select District</option>');
                    jQuery("#district").append(obj);

                  }
        });

	}
</script>

</body>

</html>