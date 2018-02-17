<html>
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
                                    <?= !empty($user_details)?'Update':'Add' ?> User Details
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-sm bg-gradient" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="col-lg-12">
                                         <?php 
                                                $attribute=array('method'=>'post');
                                                echo form_open_multipart('',$attribute);
                                                ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="text-info">Personal Information</h5>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">First Name</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('fname');
                                                        }
                                                       echo form_input(['type'=>'text','name'=>'fname','class'=>'form-control form-group','placeholder'=>'First name','value'=>!empty($user_details[0]->fname)?$user_details[0]->fname:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Last Name</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('lname');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'lname','class'=>'form-control form-group','placeholder'=>'Last name','value'=>!empty($user_details[0]->lname)?$user_details[0]->lname:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('mobile');
                                                        }
                                                         echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control form-group','placeholder'=>'Mobile Number','value'=>!empty($user_details[0]->mobile)?$user_details[0]->mobile:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('email');
                                                        }
                                                        echo form_input(['type'=>'email','name'=>'email','class'=>'form-control form-group','placeholder'=>'Email','value'=>!empty($user_details[0]->email)?$user_details[0]->email:'']);
                                                    ?>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="exampleInputEmail1">Aadhaar Number</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('adhar');
                                                        }
                                                       echo form_input(['type'=>'text','name'=>'adhar','class'=>'form-control form-group','pattern'=>'[0-9]{16}','placeholder'=>'Aadhaar Number','value'=>!empty($user_details[0]->adhar)?$user_details[0]->adhar:'']);
                                                    ?>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('address');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'address','class'=>'form-control form-group','placeholder'=>'Address','value'=>!empty($user_details[0]->address)?$user_details[0]->address:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">State</label>
                                                    <?php
                                                       if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('state');
                                                        }
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">District</label>
                                                    <?php
                                                       if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('dist');
                                                        }
                                                    ?>
                                                     <input id="district_hidden" type='hidden' name="district_hidden" value="<?php echo !empty($user_details[0]->dist)?$user_details[0]->dist:'' ;?>" />
                                                    <select id="district" name="dist" class="form-control select2" placeholder="Select District" data-live-search="true" >
                                                            <option disabled selected>Select District</option>
                                                    </select> 
                                                </div>
                                                 <div class="form-group">
                                                    <label for="exampleInputEmail1">City</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('city');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'city','class'=>'form-control form-group','placeholder'=>'City','value'=>!empty($user_details[0]->city)?$user_details[0]->city:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Username</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('username');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'username','class'=>'form-control form-group','placeholder'=>'Username','value'=>!empty($user_details[0]->username)?$user_details[0]->username:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Password</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('password');
                                                        }
                                                        echo form_input(['type'=>'password','name'=>'password','class'=>'form-control form-group','placeholder'=>'Password','value'=>!empty($user_details[0]->password)?$user_details[0]->password:'']);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="text-info">Site Information</h5>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Location</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('location');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'location','class'=>'form-control form-group','placeholder'=>'Location','value'=>!empty($user_site_details[0]->location)?$user_site_details[0]->location:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Owner</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('owner');
                                                        }
                                                         echo form_input(['type'=>'text','name'=>'owner','class'=>'form-control form-group','placeholder'=>'Owner','value'=>!empty($user_site_details[0]->owner)?$user_site_details[0]->owner:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Solar Panel</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('solar_panel');
                                                        }
                                                       echo form_input(['type'=>'text','name'=>'solar_panel','class'=>'form-control form-group','placeholder'=>'Solar Panel','value'=>!empty($user_site_details[0]->solar_panel)?$user_site_details[0]->solar_panel:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Pump</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('pump');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'pump','class'=>'form-control form-group','placeholder'=>'Pump','value'=>!empty($user_site_details[0]->pump)?$user_site_details[0]->pump:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Pipe Height</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('pipe_height');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'pipe_height','class'=>'form-control form-group','placeholder'=>'Pipe Height','value'=>!empty($user_site_details[0]->pipe_height)?$user_site_details[0]->pipe_height:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Pipe Diameter</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('pipe_diameter');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'pipe_diameter','class'=>'form-control form-group','placeholder'=>'Pipe Diameter','value'=>!empty($user_site_details[0]->pipe_diameter)?$user_site_details[0]->pipe_diameter:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">No of Elbows</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('no_lbows');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'no_lbows','class'=>'form-control form-group','placeholder'=>'No of Lbows','value'=>!empty($user_site_details[0]->no_lbows)?$user_site_details[0]->no_lbows:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Installer</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('installer');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'installer','class'=>'form-control form-group','placeholder'=>'Installer','value'=>!empty($user_site_details[0]->installer)?$user_site_details[0]->installer:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Warranty</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('warranty');
                                                        }
                                                        echo form_input(['type'=>'text','name'=>'warranty','class'=>'form-control form-group','placeholder'=>'Warranty','value'=>!empty($user_site_details[0]->warranty)?$user_site_details[0]->warranty:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Device Type</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('project');
                                                        }
                                                    ?>
                                                    <select id="project" name="project" class="form-control select2" placeholder="Select Device Type" data-live-search="true" >

                                                    <option disabled selected>Select Device Type</option>
                                                            <?php foreach ($project as $value) { 
                                                                $sProject = ($user_site_details[0]->project == $value['id'])?'selected="selected"':'';
                                                            ?>
                                                               <option value="<?php echo $value['id'];?>" <?= $sProject?> >
                                                                            <?php echo $value['device_name']; ?>      
                                                               </option>
                                                       <?php } ?>  
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">IMEI Number</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('imei_no');
                                                        }
                                                         echo form_input(['type'=>'text','name'=>'imei_no','class'=>'form-control form-group','placeholder'=>'IMEI number','value'=>!empty($user_site_details[0]->imei_no)?$user_site_details[0]->imei_no:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Drive Model No</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('drive_model_no');
                                                        }
                                                         echo form_input(['type'=>'text','name'=>'drive_model_no','class'=>'form-control form-group','placeholder'=>'Drive Model No','value'=>!empty($user_site_details[0]->drive_model_no)?$user_site_details[0]->drive_model_no:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Drive Manufacture</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('drive_manufacture');
                                                        }
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Profile Image</label>
                                                    <?php
                                                        echo form_input(['type'=>'file','name'=>'profile_image','class'=>'form-control form-group']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Site Image</label>
                                                    <?php
                                                        echo form_input(['type'=>'file','name'=>'site_image','class'=>'form-control form-group']);
                                                    echo form_input(['type'=>'hidden','name'=>'user_id','value'=>!empty($user_details[0]->user_id)?$user_details[0]->user_id:'']);
                                                    echo form_input(['type'=>'hidden','name'=>'user_type','value'=>!empty($user_details[0]->type)?$get_user_type:'']);
                                                    echo form_input(['type'=>'hidden','name'=>'profile_image_hidden','value'=>!empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'']);
                                                    echo form_input(['type'=>'hidden','name'=>'site_image_hidden','value'=>!empty($user_details[0]->site_image)?$user_details[0]->site_image:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                        if(!empty($user_details[0]->site_image)){
                                                    ?>
                                                    
                                                        <img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_details[0]->site_image)?$user_details[0]->site_image:'admin.png' ?>" width="144" height="144">
                                                    <br>    
                                                    <?php 
                                                        }
                                                        ?>
                                                </div>
                                                <hr>
                                               <?php
                                                 echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>!empty($user_details)?'Update':'Save']);
                                               ?>
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