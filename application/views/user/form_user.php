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
                                <?php if(!empty($user_details[0]->profile_image)){ ?>
                                        <div class="profile-page-left">
                                            <div class="row">
                                                    <div class="col-lg-12 mb-4">
                                                            <div class="profile-picture profile-picture-lg bg-gradient bg-primary mb-4">
                                                                    <!-- <img src="assets/img/profile-pic.jpg" width="144" height="144"> 
                                                                    -->
                                                                    <img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'admin.png' ?>" width="144" height="144">

                                                            </div>
                                                            <a class="btn btn-primary btn-block btn-gradient" href="javascript:void(0)">
                                                                    <i class="batch-icon batch-icon-user-alt-add-2"></i>
                                                                    Change Profile
                                                            </a>
                                                    </div>
                                            </div>

                                        </div>
                                <?php } ?>
                                <div class="profile-page-center">
                                    <div class="comment-block edit-profile">
                                        <div class="form-group">
                                            <h3><?= !empty($user_details)?'Update':'Add' ?> Details</h3>
                                            <?php

                                                

                                                $attribute=array('method'=>'post');
                                                echo form_open_multipart("",$attribute);

                                                echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control form-group','placeholder'=>'First name','value'=>!empty($user_details[0]->fname)?$user_details[0]->fname:'']);

                                                echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control form-group','placeholder'=>'Last name','value'=>!empty($user_details[0]->lname)?$user_details[0]->lname:'']);

                                                echo form_input(['type'=>'email','name'=>'email','class'=>'form-control form-group','placeholder'=>'Email','value'=>!empty($user_details[0]->email)?$user_details[0]->email:'']);

                                                echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control form-group','placeholder'=>'Mobile Number','value'=>!empty($user_details[0]->mobile)?$user_details[0]->mobile:'']);
                                                
                                                echo form_input(['type'=>'text','name'=>'adhar','class'=>'form-control form-group','placeholder'=>'Aadhaar Number','value'=>!empty($user_details[0]->adhar)?$user_details[0]->adhar:'']);
                                                
                                                echo form_input(['type'=>'text','name'=>'address','class'=>'form-control form-group','placeholder'=>'Address','value'=>!empty($user_details[0]->address)?$user_details[0]->address:'']);

                                                
                                            ?>	
                                            <select id="state" name="state" class="form-control select2" placeholder="Select State" data-live-search="true" >

                                                <option disabled selected>Select State</option>
                                                        <?php foreach ($state as $value) { 
                                                                $sState = ($user_details[0]->state == $value['id'])?'selected="selected"':'';
                                                        ?>
                                                           <option value="<?php echo $value['id'];?>" <?= $sState?> >
                                                                        <?php echo $value['name']; ?>      
                                                           </option>
                                                   <?php } ?>  
                                            </select>
                                            <input id="district_hidden" type='hidden' name="district_hidden" value="<?php echo !empty($user_details[0]->dist)?$user_details[0]->dist:'' ;?>" />
                                            <select id="district" name="dist" class="form-control select2" placeholder="Select District" data-live-search="true" >
                                                    <option disabled selected>Select District</option>
                                            </select> 

                                                        <!-- <input type="file" name="image" class="form-control form-group"> -->

                                                <?php 
                                                    echo form_input(['type'=>'text','name'=>'city','class'=>'form-control form-group','placeholder'=>'City','value'=>!empty($user_details[0]->city)?$user_details[0]->city:'']);
                                                    echo form_input(['type'=>'text','name'=>'username','class'=>'form-control form-group','placeholder'=>'Username','value'=>!empty($user_details[0]->username)?$user_details[0]->username:'']);
                                                    echo form_input(['type'=>'password','name'=>'password','class'=>'form-control form-group','placeholder'=>'Password','value'=>!empty($user_details[0]->password)?$user_details[0]->password:'']);
                                                    
                                                ?>
                                            
                                                <h4>Site Information</h4>
                                                <?php 
                                                    echo form_input(['type'=>'text','name'=>'location','class'=>'form-control form-group','placeholder'=>'Location','value'=>!empty($user_site_details[0]->location)?$user_site_details[0]->location:'']);
                                                    echo form_input(['type'=>'text','name'=>'owner','class'=>'form-control form-group','placeholder'=>'Owner','value'=>!empty($user_site_details[0]->owner)?$user_site_details[0]->owner:'']);
                                                    echo form_input(['type'=>'text','name'=>'solar_panel','class'=>'form-control form-group','placeholder'=>'Solar Panel','value'=>!empty($user_site_details[0]->solar_panel)?$user_site_details[0]->solar_panel:'']);
                                                    echo form_input(['type'=>'text','name'=>'pump','class'=>'form-control form-group','placeholder'=>'Pump','value'=>!empty($user_site_details[0]->pump)?$user_site_details[0]->pump:'']);
                                                    echo form_input(['type'=>'text','name'=>'pipe_height','class'=>'form-control form-group','placeholder'=>'Pipe Height','value'=>!empty($user_site_details[0]->pipe_height)?$user_site_details[0]->pipe_height:'']);
                                                    echo form_input(['type'=>'text','name'=>'pipe_diameter','class'=>'form-control form-group','placeholder'=>'Pipe Diameter','value'=>!empty($user_site_details[0]->pipe_diameter)?$user_site_details[0]->pipe_diameter:'']);
                                                    echo form_input(['type'=>'text','name'=>'no_lbows','class'=>'form-control form-group','placeholder'=>'No of Lbows','value'=>!empty($user_site_details[0]->no_lbows)?$user_site_details[0]->no_lbows:'']);
                                                    echo form_input(['type'=>'text','name'=>'installer','class'=>'form-control form-group','placeholder'=>'Installer','value'=>!empty($user_site_details[0]->installer)?$user_site_details[0]->installer:'']);
                                                    echo form_input(['type'=>'text','name'=>'warranty','class'=>'form-control form-group','placeholder'=>'Warranty','value'=>!empty($user_site_details[0]->warranty)?$user_site_details[0]->warranty:'']);
                                                ?>  
                                                <select id="project" name="project" class="form-control select2" placeholder="Select Project" data-live-search="true" >

                                                    <option disabled selected>Select Project</option>
                                                            <?php foreach ($project as $value) { 
                                                                $sProject = ($user_site_details[0]->project == $value['id'])?'selected="selected"':'';
                                                            ?>
                                                               <option value="<?php echo $value['id'];?>" <?= $sProject?> >
                                                                            <?php echo $value['device_name']; ?>      
                                                               </option>
                                                       <?php } ?>  
                                                </select>
                                                <?php 
                                                    echo form_input(['type'=>'text','name'=>'imei_no','class'=>'form-control form-group','placeholder'=>'IMEI number','value'=>!empty($user_site_details[0]->imei_no)?$user_site_details[0]->imei_no:'']);
                                                    echo form_input(['type'=>'text','name'=>'drive_model_no','class'=>'form-control form-group','placeholder'=>'Drive Model No','value'=>!empty($user_site_details[0]->drive_model_no)?$user_site_details[0]->drive_model_no:'']);
                                                ?> 
                                                <select id="drive_manufacture" name="drive_manufacture" class="form-control select2" placeholder="Select Drive Manufacture" data-live-search="true" >

                             <option disabled selected>Select Drive Manufacture</option>
                                <?php foreach ($device_manufacture as $value) { 

                                		if(!empty($user_site_details)){

                            		 		$sManufacture = ($user_site_details[0]->drive_manufacture_id == $value['id'])?'selected="selected"':'';
                                		}else{
                                			$sManufacture="";
                                		}
                            	?>
                                   <option value="<?php echo $value['id'];?>" <?= $sManufacture?> >
                               			<?php echo $value['name']; ?>      
                                   </option>
                                                        <?php } ?>  
                                                </select>   
                                                <label>Profile Image</label>
                                                <?php
                                                    echo form_input(['type'=>'file','name'=>'profile_image','class'=>'form-control form-group']);
                                                ?>
                                                <label>Site Image</label>
                                                <?php 
                                                
                                                    echo form_input(['type'=>'file','name'=>'site_image','class'=>'form-control form-group']);
                                                    echo form_input(['type'=>'hidden','name'=>'user_id','value'=>!empty($user_details[0]->user_id)?$user_details[0]->user_id:'']);
                                                    echo form_input(['type'=>'hidden','name'=>'user_type','value'=>!empty($user_details[0]->type)?$get_user_type:'']);
                                                    echo form_input(['type'=>'hidden','name'=>'profile_image_hidden','value'=>!empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'']);
                                                    echo form_input(['type'=>'hidden','name'=>'site_image_hidden','value'=>!empty($user_details[0]->site_image)?$user_details[0]->site_image:'']);
                                                    if(!empty($user_details[0]->site_image)){
                                                ?>
                                                    
                                                        <img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_details[0]->site_image)?$user_details[0]->site_image:'admin.png' ?>" width="144" height="144">
                                                    <br>    
                                                <?php 
                                                    }
                                                    echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>!empty($user_details)?'Update':'Save']);
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