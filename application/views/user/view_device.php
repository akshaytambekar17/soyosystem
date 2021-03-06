<!DOCTYPE html>
<html lang="en">
<head>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script data-require="jquery@2.2.4" data-semver="2.2.4" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link data-require="bootstrap@3.3.7" data-semver="3.3.7" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script data-require="bootstrap@3.3.7" data-semver="3.3.7" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <style>
        .checkbox-inline{
            margin: 6px;
        }

      .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
      .toggle.ios .toggle-handle { border-radius: 20px; }

    </style>
    
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="right-column">
                <main class="main-content p-5" role="main">
                    <div class="row mb-4">
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
                        <div class="col-md-12 alert-box">
                            <div class="card">
                                <div class="">
                                    <div class="profile-page-center">
                                            <h1 class="card-user-profile-name">&nbsp;List Site Information</h1>
                                        <hr />
                                        <?php if(!empty($user_device_site_information)){ ?>
                                        <ul class="list-unstyled mt-5">
                                        <?php
                                            foreach($user_device_site_information as $row){
                                        ?>
                                            <li class="media">
                                                <div class="col-md-12">
                                                    <div class="row">
<!--                                                        <div class="col-md-1">  
                                                            <input type="checkbox" data-id="<?= $row->id?>" name="site_id[]" value="<?= $row->id?>">
                                                        </div>-->
                                                        <div class="col-md-3">  
                                                            <h4>Site name</h4>
                                                            <p> <?php  echo $row->site_name; ?> </p>
                                                        </div>
                                                        <?php if($user_type==2){ ?>
                                                            <div class="col-md-3">  
                                                                <h4>Device Type</h4>
                                                                <p>
                                                                <?php
                                                                    $device_name=$this->Admin_model->get_device_by_id($row->device_type);
                                                                    echo $device_name[0]->device_name;
                                                                ?>
                                                                </p>
                                                            </div>
                                                        <?php }?>            
                                                        <div class="col-md-3">  
                                                            <div class="media-body">
                                                                <div class="media-title mt-0 mb-1">
                                                                    <h4>Device IMEI number</h4>
                                                                    <?= $row->imei_no;?>          
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">  
                                                            <div class="media-body">
                                                                <div class="media-title mt-0 mb-1">
                                                                    <a href="<?php echo base_url();?>User_Manufracture/edit_user_site?user_id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>&id=<?php echo $row->id?>" class="btn btn-info btn-sm waves-effect waves-light"><b>Edit User Site<br>Information</b></a>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="<?= $row->user_id?>" name="user_id_hidden" id="user_id_hidden">
                                                        <input type="hidden" value="<?php echo $_GET['user_type'];?>" name="user_type_hidden" id="user_type_hidden">
                                                        <?php if($user_type==1){ ?>
                                                        <div class="col-md-3">
                                                            <input data-toggle="toggle" data-style="ios" type="checkbox" data-size="small" data-id="<?php echo $row->user_id?>" data-on="Enabled" data-off="Disabled" onchange="status(this)" id="checkbox_<?= $row->user_id?>" <?= $row->status==1?'checked':''?> 
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                
                                            </li>


                                        <?php
                                        }
                                        ?>
                                        </ul>
                                        <?php } else{ ?>
                                            <h3 class="text-center">No Deivce is there</h3>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($user_device_site_information)){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="">
                                    <div class="container-fluid">
                                    <div class="profile-page-center" style="min-height: 210px;">
                                        <h3>Export device data</h3>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- <label class="radio-inline">
                                                    <input type="radio" name="exportsradio" value="single" >Single device data
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="exportsradio" value="all">All device data
                                                </label> -->
                                                <select id="deivce" name="deivce" class="form-control select2" data-live-search="true" >

                                                        <option disabled selected>Select Device Type</option>
                                                            <?php foreach ($device_details as $value_device) { ?>
                                                                <option  value="<?php echo $value_device['id'];?>">
                                                                    <?php echo $value_device['device_name']; ?>      
                                                                </option>
                                                           <?php  }  ?>  
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="device_parameter"></div>
                                        </div>
                                        <br> <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-success" id="export">Export</button>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </main>

            </div>
        </div>
    </div>


        <script>
            $(document).ready(function() {
//                $("#device").select2({
//                    allowClear:true,
//                    placeholder: 'Position'
//                });
                $("#deivce").change(function(){
                    var id=$(this).val();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "/Admin_Manufracture/get_device_parameters_by_id",
                        data: { 'id' : id },
                        dataType: 'json',
                        success: function(data){
                            $(".device_parameter").html('');
                            $(".device_parameter").append('<br><br><div class="col-md-12"><label class="radio-inline"><input type="radio" name="exportsradio" value="single" >Single device data </label><label class="radio-inline"><input type="radio" name="exportsradio" value="all">All device data</label></div><br><br>');
                            $.each(data, function (index, value) {
                                $(".device_parameter").append('<div class="col-md-6"><label class="checkbox-inline"><input type="checkbox" name="device_parameter_checkbox[]" value="'+index+'">'+value+'</label></div>');
                                    
                            });
                            

                        }
                    });

                });
                $("#device-div").hide();
                $("input[name='exportsradio']").click(function() {     
                    if($("input[name=exportsradio]:checked").val() =="single"){
                        $("#device-div").show();
                    }else{
                        $("#device-div").hide();
                    }
                    
                });
                $("#export").click(function(){
                    
                    if($("input[name=exportsradio]:checked").val() =="" || $("input[name=exportsradio]:checked").val() == undefined){
                        alert("please select device type mode");
                    }else{
                        var radiovalue=$("input[name=exportsradio]:checked").val();
                        if(radiovalue=='single'){
                             var values = new Array();
                            $.each($("input[name='device_parameter_checkbox[]']:checked"), function() {
                                values.push($(this).val());
                            });

                            values=JSON.stringify(values);
                            var device_type=$("input[name=exportsradio]:checked").val();
                            var device=$("#deivce").val();
                            var user_id=$("#user_id_hidden").val();
                            var user_type=$("#user_type_hidden").val();
                            window.location= '<?php echo base_url(); ?>User_Manufracture/export?device_type='+device_type+'&device_parameter='+values+'&device='+device+'&user_id='+user_id+'&user_type='+user_type;  
                        }else{
                            var device=$("#deivce").val();
                            var user_id=$("#user_id_hidden").val();
                            var user_type=$("#user_type_hidden").val();
                            var device_type=$("input[name=exportsradio]:checked").val();
                            var values='';
                            window.location= '<?php echo base_url(); ?>User_Manufracture/export?device_type='+device_type+'&device='+device+'&user_id='+user_id+'&user_type='+user_type; 
                        }
                    }
                    
                    
                })
                
            });
            function status(ths){
                var id=$(ths).data('id');
                if($(ths).is(':checked')){
                    var status=1;
                    var status_name="Enabled";
                }else{
                    var status=0;
                    var status_name="Disabled";
                }
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "/User_Manufracture/updateuserstatus",
                    data: { 'status' : status ,'id':id},
                    dataType: 'html',
                    success: function(data){
                        
                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                        $('.alert-box').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> User Status is '+status_name+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        $('.alert').fadeIn().delay(10000).fadeOut(function () {
                            $(this).remove();
                        });
                    }
                });

            }
        </script>
</body>
</html>