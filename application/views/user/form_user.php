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
                                    <h5 class="text-info">Personal Information</h5>
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
                                                         echo form_input(['type'=>'text','name'=>'mobile','class'=>'form-control form-group','placeholder'=>'Mobile Number','pattern'=>'[789][0-9]{9}','value'=>!empty($user_details[0]->mobile)?$user_details[0]->mobile:'']);
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
                                                       echo form_input(['type'=>'text','name'=>'adhar','class'=>'form-control form-group','pattern'=>'[0-9]{12}','placeholder'=>'Aadhaar Number','value'=>!empty($user_details[0]->adhar)?$user_details[0]->adhar:'']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Projects</label>
                                                    <?php
                                                        if($this->form_validation->run() == FALSE){
                                                            echo form_error('project_id');
                                                        }
                                                    ?>
                                                     <select id="project_id" name="project_id" class="form-control select2"  data-live-search="true" >
                                                        <option disabled selected>Select Project</option>
                                                                <?php foreach ($projects as $value) {
                                                                    $sProject = ($user_details[0]->project_id == $value->id)?'selected="selected"':'';
                                                                    
                                                                ?>
                                                                   <option value="<?php echo $value->id;?>" <?= $sProject?> >
                                                                                <?php echo $value->name; ?>      
                                                                   </option>
                                                           <?php } ?>  
                                                    </select>
                                                </div>
                                                <?php
                                                  echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>!empty($user_details)?'Update':'Save']);
                                                ?>
                                            </div>
                                                
                                            <div class="col-md-6">
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
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Profile Image</label>
                                                    <?php
                                                        echo form_input(['type'=>'file','name'=>'profile_image','class'=>'form-control form-group']);
                                                    ?>
                                                    <?php
                                                        if(!empty($user_details[0]->profile_image)){
                                                    ?>
                                                    <br>
                                                        <img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'admin.png' ?>" width="144" height="144">
                                                    <br>    
                                                    <?php 
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                    
                                            echo form_input(['type'=>'hidden','name'=>'user_id','value'=>!empty($user_details[0]->user_id)?$user_details[0]->user_id:'']);
                                            echo form_input(['type'=>'hidden','name'=>'user_type','value'=>!empty($user_details[0]->type)?$get_user_type:'']);
                                            echo form_input(['type'=>'hidden','name'=>'profile_image_hidden','value'=>!empty($user_details[0]->profile_image)?$user_details[0]->profile_image:'']);
                                        ?>
                                        <?= form_close();?>
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