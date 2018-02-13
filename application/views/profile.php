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
							<img class="card-img" src="	<?php echo base_url();?>assets/img/featured.png" alt="Feature Image">
							<div class="card-user-profile">
								<div class="profile-page-left">
									<div class="row">
										<div class="col-lg-12 mb-4">
											<div class="profile-picture profile-picture-lg bg-gradient bg-primary mb-4">

												<img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'admin.png' ?>" width="144" height="144">
											</div>
											<a class="btn btn-primary btn-block btn-gradient" href="#">
												<i class="batch-icon batch-icon-user-alt-add-2"></i>
												Change Profile
											</a>
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
									<!--<h5>
										<i class="batch-icon batch-icon-users"></i>
										Friends
									</h5>
									 <div class="profile-page-block-outer clearfix">
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-2.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-3.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-4.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-5.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-secondary">
												<img src="assets/img/profile-pic-6.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-2.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-3.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-secondary">
												<img src="assets/img/profile-pic-4.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-5.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-secondary">
												<img src="assets/img/profile-pic-6.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-secondary">
												<img src="assets/img/profile-pic-2.jpg" width="44" height="44">
											</div>
										</div>
										<div class="profile-page-block">
											<div class="profile-picture bg-gradient bg-primary">
												<img src="assets/img/profile-pic-3.jpg" width="44" height="44">
											</div>
										</div>
										<a class="float-right mt-2" href="#">More</a>
									</div>
									<hr />
									<h5>
										<i class="batch-icon batch-icon-image"></i>
										Album
									</h5>
									<a href="#">
										<img src="assets/img/album-image.jpg" class="img-fluid img-thumbnail" />
									</a>
									<a class="float-right mt-2" href="#">More</a>
								-->
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
											echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control form-group','value'=>$row->fname]);
											echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control form-group','value'=>$row->lname]);
											echo form_input(['type'=>'email','name'=>'email','class'=>'form-control form-group','value'=>$row->email]);
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
				                            <select id="district" name="dist" class="form-control select2" placeholder="Select District" data-live-search="true" >

						                         	<option disabled selected>Select District</option>
						                          
					                        </select> 
											<!-- echo form_input(['type'=>'text','name'=>'state','class'=>'form-control form-group','value'=>$row->state]);
											echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control form-group','value'=>$row->dist]); -->
											<?php 
											echo form_input(['type'=>'text','name'=>'city','class'=>'form-control form-group','value'=>$row->city]);
											echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control form-group','value'=>$row->mobile]);
											echo form_input(['type'=>'file','name'=>'profile_image','class'=>'form-control form-group']);
											echo form_input(['type'=>'hidden','name'=>'uid','value'=>$row->user_id]);
											echo form_input(['type'=>'hidden','name'=>'profile_image_hidden','value'=>$row->profile_image]);
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
<?php $this->load->view('includes/footer');?>
</body>

</html>