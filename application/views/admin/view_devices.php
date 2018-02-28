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
                        <div class="col-md-12 alert-box">
                            <div class="card">
                                <div class="card-header">
                                    <div class="profile-page-center">
                                            <h1 class="card-user-profile-name">&nbsp;All Devices</h1>                                 
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mt-5">
                                        <?php
                                        foreach($devices as $row)
                                        {
                                            echo "<li>";
                                            echo $row->imei_no;
                                            echo "</li>";
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

</body>
</html>