<!DOCTYPE html>
<html lang="en">
<head>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script data-require="jquery@2.2.4" data-semver="2.2.4" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link data-require="bootstrap@3.3.7" data-semver="3.3.7" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script data-require="bootstrap@3.3.7" data-semver="3.3.7" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    
    <style>
        .checkbox-inline{
            margin: 6px;
        }
    </style>
    
</head>

<body>

	<div class="container-fluid">
            <div class="row">
                <div class="right-column">
                    <main class="main-content p-5" role="main">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-user-profile">
                                        <div class="profile-page-center">
                                                <h1 class="card-user-profile-name">All Users</h1>
                                            <hr />
                                            <ul class="list-unstyled mt-5">
                                            <?php
                                            foreach($user as $row)
                                            {
                                            ?>
                                                    <li class="media">
                                                            <div class="profile-picture bg-gradient bg-primary mb-4">
                                                                    <img src="assets/img/profile-pic.jpg" width="44" height="44">
                                                            </div>
                                                            <div class="media-body">
                                                                    <div class="media-title mt-0 mb-1">
                                                                            <a href="#"><?php echo $row->fname." ".$row->lname;?></a> <small> <em><?php echo $row->dist.", ".$row->city;?></em></small>
                                                                    </div>
                                                                    <em>3 Systems</em> |
                                                                    <em>9 Devices</em>
                                                            </div>
                                                    </li>
                                            <?php
                                            }
                                            ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-user-profile">
                                        <div class="profile-page-center" style="min-height: 210px;">
                                            <h3>Export device data</h3>
                                            <br>
                                            <div class="col-md-12">
                                                <label class="radio-inline">
                                                    <input type="radio" name="exportsradio" value="single" >Single device data
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="exportsradio" value="all">All device data
                                                </label>
                                            </div>
                                            <div class="col-md-5" id="device-div">
                                                <br>
                                                <select id="device" name="device" class="form-control"  data-live-search="true">
                                                    <option selected="selected" disabled="disabled">Select Device</option>
                                                    <?php foreach($device_param as $dp){ ?>
                                                        <option value="<?= $dp['dvc_id']?>"><?= $dp['dev_imei']?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <br> <br>
                                            <div class="col-md-12">
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="itv">itv</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="itc">itc</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="itp">itp</label> 
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acc1">acc1</label> 
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acc2">acc2</label> 
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acc3">acc3</label> 
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acv1">acv1</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acv2">acv2</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acv3">acv3</label> 
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acv1">frq</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acv2">enrg</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="acv3">lph</label> 
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="temp">temp</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="sig_str">sig_str</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="p_stat">p_stat</label> 
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="nlc">nlc</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="drc">drc</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="srt_ckt">srt_ckt</label> 
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="x_heat">x_heat</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="o_load">o_load</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="dcb_err">dcb_err</label> 
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="temp_sen_abst">temp_sen_abst</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="machine_name[]" value="emrg">emrg</label>
                                            </div>
                                            <br> <br>
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-success" id="export">Export</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                                <div class="col-md-12">
                                        <footer>
                                                Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a>
                                        </footer>
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
        </script>
        
</body>
</html>