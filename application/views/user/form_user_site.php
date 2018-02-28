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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?= !empty($user_site_details)?'Update':'Add' ?> User Site Details
                                            <h5 class="text-info">User Site Information</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url();?>User_Manufracture/view_devices?id=<?php echo $user_id?>&user_type=<?php echo $user_type?>" class="text-left btn-sm waves-effect waves-light"><b>Back</b></a>
                                        </div>
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
                                                    <label for="exampleInputEmail1">Site Name</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('site_name');
                                                        }
                                                         echo form_input(['type'=>'text','name'=>'site_name','class'=>'form-control form-group','placeholder'=>'Site name','value'=>!empty($user_site_details[0]->site_name)?$user_site_details[0]->site_name:'']);
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
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">VFD Type</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('vfd_type');
                                                        }
                                                    ?>
                                                    <select id="drive_manufacture" name="vfd_type" class="form-control select2" data-live-search="true" >

                                                     <option disabled selected>Select VFD Type</option>
                                                        <?php foreach ($vfd_type as $value) { 

                                                                if(!empty($user_site_details)){

                                                                    $sManufacture = ($user_site_details[0]->vfd_type== $value['id'])?'selected="selected"':'';
                                                                }else{
                                                                    $sManufacture="";
                                                                }
                                                        ?>
                                                           <option value="<?php echo $value['id'];?>" <?= $sManufacture?> >
                                                                <?php echo $value['vfd_name']; ?>      
                                                           </option>
                                                                                <?php } ?>  
                                                    </select>  
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Device Type</label>
                                                    <?php
                                                    if($this->form_validation->run() == FALSE)
                                                        {
                                                            echo form_error('device_type');
                                                        }
                                                    ?>
                                                    <select id="project" name="device_type" class="form-control select2" placeholder="Select Device Type" data-live-search="true" >

                                                    <option disabled selected>Select Device Type</option>
                                                            <?php foreach ($device_type as $value) { 
                                                                $sProject = ($user_site_details[0]->device_type == $value['id'])?'selected="selected"':'';
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
                                                    <label for="exampleInputPassword1">Site Image</label>
                                                    <?php
                                                        echo form_input(['type'=>'file','name'=>'site_image','class'=>'form-control form-group']);
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                        if(!empty($user_site_details[0]->site_image)){
                                                    ?>
                                                    
                                                        <img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($user_site_details[0]->site_image)?$user_site_details[0]->site_image:'admin.png' ?>" width="144" height="144">
                                                    <br>    
                                                    <?php 
                                                        }
                                                        ?>
                                                </div>
                                                
                                                <?php
                                                  echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>!empty($user_site_details)?'Update':'Save']);
                                                ?>
                                            </div>
                                                
                                            
                                        </div>
                                        <?php
                                                    
                                            echo form_input(['type'=>'hidden','name'=>'user_id','value'=>!empty($user_site_details[0]->user_id)?$user_site_details[0]->user_id:$user_id]);
                                            echo form_input(['type'=>'hidden','name'=>'user_type','value'=>!empty($user_site_details[0]->type)?$get_user_type:$user_type]);
                                            echo form_input(['type'=>'hidden','name'=>'id','value'=>!empty($user_site_details[0]->id)?$user_site_details[0]->id:'']);
                                            echo form_input(['type'=>'hidden','name'=>'site_image_hidden','value'=>!empty($user_site_details[0]->site_image)?$user_site_details[0]->site_image:'']);
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