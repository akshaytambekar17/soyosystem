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
      .btn-font
        {
            font-size:10px;
        }
      

    </style>
    
</head>

<body>

	<div class="container-fluid">
        <div class="row">
            <div class="right-column">
                <main class="main-content p-5" role="main">
                    <div class="row mb-4">
                        <div class="col-md-12 alert-box">
                            <div class="card">
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
                                
                                    <div class="profile-page-center">
                                            <h1 class="card-user-profile-name">&nbsp;All Users</h1>
                                        <hr /> 
                                        <ul class="list-unstyled mt-5">
                                        <?php
                                        foreach($user as $row)
                                        {
                                        ?>
                                            <li class="media">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-3">  
                                                            <div class="profile-picture bg-gradient bg-primary mb-4">
                                                                <img src="<?php echo base_url();?>assets/uploads/<?php echo !empty($row->profile_image)?$row->profile_image:'admin.png' ?>" width="55" height="55">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">  
                                                            <div class="media-body">
                                                                <div class="media-title mt-0 mb-1">
                                                                    <a href="<?php echo base_url();?>User_Manufracture/edit_user?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>"><?php echo $row->fname." ".$row->lname;?></a> <small> <em><?php echo $row->dist.", ".$row->city;?></em></small>
                                                                </div>
                                                                <em><?= $row->date?></em> |
                                                                <em><?= $row->time?></em>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <a href="<?php echo base_url();?>Home_Controller/login?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>" class="btn btn-sm btn-secondary waves-effect waves-light pull-left btn-font" target="_blank">Open <br>Dashboard</a>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <?php if($user_type==2){ ?>
                                                        <div class="col-md-2">
                                                            <a href="<?php echo base_url();?>User_Manufracture/add_user_site?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>" class="btn btn-success btn-sm waves-effect waves-light btn-font">Add<br>Device</a>
                                                        </div>
                                                        <?php } ?>
                                                        <div class="col-md-2">
                                                            <a href="<?php echo base_url();?>User_Manufracture/view_devices?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>" class="btn btn-view btn-sm waves-effect waves-light pull-left btn-font">View<br> Device</a>

                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <a href="<?php echo base_url();?>User_Manufracture/edit_user?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>" class="btn btn-info btn-sm waves-effect waves-light pull-left btn-font">Edit<br> Profile</a>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="<?php echo base_url();?>User_Manufracture/delete_user?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>" class="btn btn-sm btn-danger waves-effect waves-light deleteuser pull-left btn-font" data-confirm="Are you sure to delete this user?">Delete <br>User</a>
                                                        </div>
<!--                                                    <div class="col-md-4">
                                                            <a href="<?php echo base_url();?>User_Manufracture/delete_user?id=<?php echo $row->user_id?>&user_type=<?php echo $user_type?>" class="btn btn-sm btn-danger waves-effect waves-light">Delete User</a>
                                                        </div>-->
                                                        <?php if($user_type==1){ ?>
                                                        <div class="col-md-3">
                                                        <!--input data-toggle="toggle" data-style="ios" type="checkbox" data-size="small" data-id="<?php echo $row->user_id?>" data-on="Enabled" data-off="Disabled" onchange="status(this)" id="checkbox_<?= $row->user_id?>" <?= $row->status==1?'checked':''?> -->
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li><hr>


                                        <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
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
                        alert("please select device data single or all");
                    }else if ($("input[name='machine_name[]']:checked")=="" || $("input[name='machine_name[]']:checked").val() == undefined ) {
                        alert("please select machines");
                    }else{
                        var values = new Array();
                        $.each($("input[name='machine_name[]']:checked"), function() {
                            values.push($(this).val());
                        });
                        values=JSON.stringify(values);
                        var device_type=$("input[name=exportsradio]:checked").val();
                        if(device_type=='all'){
                            var device="";
                        }else{
                            var device=$("#device").val();
                        }
                        window.location= '<?php echo base_url(); ?>User_Manufracture/export?device_type='+device_type+'&machine_data='+values+'&device='+device;  
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
        <script>
            var deleteLinks = document.querySelectorAll('.deleteuser');

        for (var i = 0; i < deleteLinks.length; i++) {
          deleteLinks[i].addEventListener('click', function(event) {
              event.preventDefault();

              var choice = confirm(this.getAttribute('data-confirm'));

              if (choice) {
                window.location.href = this.getAttribute('href');
              }
          });
        }
        </script>

</body>
</html>