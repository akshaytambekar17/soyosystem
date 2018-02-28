<!DOCTYPE html>
<html lang="en">
<head>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>			
    <style>
        .text-danger{
            color: red;
        }
        
    </style>
</head>

<body>
	<div class="container-fluid">
            <div class="row">
                <div class="right-column">
                        <main class="main-content p-5" role="main">
                                <div class="row">
                                    <div class="col-md-12">
                                            <h1><?= !empty($project_details)?'Edit':'Add' ?> Project</h1>
                                    </div>
                                </div>
                                <div class="row mb-12">
                                    <div class="col-md-12 mb-5">
                                            <div class="card">
                                                <div class="card-header">
                                                        <?= !empty($project_details)?'Edit Project Details':'Enter Your New Project Details' ?>
                                                </div>
                                            <?php
                                                $attribute=array('method'=>'post');
                                                echo form_open_multipart('',$attribute);
                                            ?>
                                            <div class="card-body">
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
                                                <div class="row">    
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php
                                                                    if($this->form_validation->run() == FALSE){	
                                                                            echo "<p class='text-danger'>".form_error('name')."</p>";
                                                                    }
                                                            ?>
                                                            <label for="exampleInputEmail1">Project Name</label>
                                                            <?php
                                                                    echo form_input(['type'=>'text','name'=>'name','class'=>'form-control','placeholder'=>'Project Name','value'=>!empty($project_details)?$project_details[0]->name:'']);
                                                            ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <?php
                                                                if($this->form_validation->run() == FALSE){
                                                                    echo "<p class='text-danger'>".form_error('description')."</p>";
                                                                }
                                                            ?>
                                                            <label for="exampleInputPassword1">Description</label>
                                                            <?php
                                                                echo form_textarea(['name'=>'description','class'=>'form-control','placeholder'=>'Description','rows'=>4,'value'=>!empty($project_details)?$project_details[0]->description:'']);
                                                            ?>
                                                        </div>


                                                        <button type="submit" class="btn btn-primary btn-gradient btn-block">
                                                                <i class="batch-icon batch-icon-key"></i>
                                                                <?= !empty($project_details)?'UPDATE':'ADD'?> PROJECT
                                                        </button>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php
                                                                if($this->form_validation->run() == FALSE){
                                                                    echo "<p class='text-danger'>".form_error('state_id')."</p>";
                                                                }
                                                            ?>
                                                            <label for="exampleInputEmail1">State</label>
                                                            <select id="state" name="state_id" class="form-control select2" placeholder="Select State" data-live-search="true" >

                                                                <option disabled selected>Select State</option>
                                                                <?php foreach ($state as $value) { 
                                                                        $sState = ($project_details[0]->state_id == $value['id'])?'selected="selected"':'';
                                                                ?>
                                                                    <option value="<?php echo $value['id'];?>" <?= $sState?>>
                                                                        <?php echo $value['name']; ?>      
                                                                    </option>
                                                                <?php } ?>  
                                                           </select>
                                                        </div>
                                                        <div class="form-group">
                                                                <?php
                                                                    if($this->form_validation->run() == FALSE){
                                                                            echo "<p class='text-danger'>".form_error('district_id')."</p>";
                                                                    }
                                                                ?>
                                                                <input id="district_hidden" type='hidden' name="district_hidden" value="<?= !empty($project_details)?$project_details[0]->district_id:'' ;?>" />
                                                                <label>Select District</label>
                                                                <select id="district" name="district_id" class="form-control select2" placeholder="Select District" data-live-search="true" >
                                                                    <option disabled selected>Select District</option>
                                                                </select> 
                                                        </div>
                                                        <div class="form-group">
                                                            <?php
                                                                if($this->form_validation->run() == FALSE){
                                                                    echo "<p class='text-danger'>".form_error('city')."</p>";
                                                                }
                                                            ?>
                                                            <label for="exampleInputPassword1">City</label>
                                                            <?php
                                                                echo form_input(['type'=>'text','name'=>'city','class'=>'form-control','placeholder'=>'City','value'=>!empty($project_details)?$project_details[0]->city:'']);
                                                            ?>
                                                        </div>
                                                        <?php if(empty($project_details)) { ?>
                                                            <input type="hidden" name="created_at" value="<?= date('Y-m-d h:i:sa')?>">
                                                        <?php } ?>
                                                        <input type="hidden" name="id" value="<?= !empty($project_details)?$project_details[0]->id:''?>">
                                                    </div>
                                                </div>
                                            </div>    
                                            <?= form_close();?>
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