<html>
<head>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>

    
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
  ul.mobiletower li{ display:inline-block; border: 1px solid #009bd4;}
  /*ul.mobiletower li:hover { border-color: #e00; background-color: #e00; }*/
  ul.mobiletower .oneicon { width: 7px; height: 15px; background-color:#009bd4;}
  ul.mobiletower .towicon {   width: 7px; height: 20px; background-color:#009bd4;}
  ul.mobiletower .threeicon { width: 7px; height: 25px; background-color:#009bd4;}
  ul.mobiletower .fouricon { width: 7px; height: 30px; background-color:#009bd4;}
  ul.mobiletower .fiveicon { width: 7px; height: 35px; background-color:#009bd4;}
  ul.mobiletower .blank {background-color:#fff;border: 1px solid #009bd4;}
  
    .led-box {
      height: 30px;
      width: 25%;
      margin: 10px 0;
      float: left;
    }

    .led-box p {
      font-size: 12px;
      text-align: center;
      margin: 1em;
    }

    .led-red {
      margin: 0 auto;
      width: 24px;
      height: 24px;
      background-color: #F00;
      border-radius: 50%;
      box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 12px;
      -webkit-animation: blinkRed 0.5s infinite;
      -moz-animation: blinkRed 0.5s infinite;
      -ms-animation: blinkRed 0.5s infinite;
      -o-animation: blinkRed 0.5s infinite;
      animation: blinkRed 0.5s infinite;
    }

    @-webkit-keyframes blinkRed {
        from { background-color: #F00; }
        50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
        to { background-color: #F00; }
    }
    @-moz-keyframes blinkRed {
        from { background-color: #F00; }
        50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
        to { background-color: #F00; }
    }
    @-ms-keyframes blinkRed {
        from { background-color: #F00; }
        50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
        to { background-color: #F00; }
    }
    @-o-keyframes blinkRed {
        from { background-color: #F00; }
        50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
        to { background-color: #F00; }
    }
    @keyframes blinkRed {
        from { background-color: #F00; }
        50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
        to { background-color: #F00; }
    }

    
    .led-green {
      margin: 0 auto;
      width: 24px;
      height: 24px;
      background-color: #ABFF00;
      border-radius: 50%;
      box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #304701 0 -1px 9px, #89FF00 0 2px 12px;
    }

</style>
</head>

<body>
<div class="col-md-12 col-sm-12 col-xl-12 alert-box">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <select id="site_name" name="site_name" class="form-control select2" data-live-search="true" >
                       <?php if(!empty($user_sites)){ ?>
                            <option disabled selected>Select Site Name</option>
                            <?php foreach ($user_sites as $user_site) { ?>
                                <option  value="<?php echo $user_site->id;?>">
                                    <?php echo $user_site->site_name; ?>      
                                </option>
                           <?php  }  ?>  
                        <?php } else{ ?>
                                <option disabled selected>No Sites Found</option>
                        <?php  }  ?>  
                    </select>
                </div>
                <div class="col-md-2">
                    <p><b>Site name </b><br>
                        <?php 
                            $site=$this->User_model->get_user_site_by_imei($latest_user_sites[0]->imei);
                            echo $site[0]->site_name;
                        ?>
                        
                    </p>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <?php  
                                $flag=array();
                                if(!empty($latest_user_sites)){

                                    foreach($latest_user_sites as $lus){ 
                                        if($lus->parameter=='F2' || $lus->parameter=='F3' || $lus->parameter=='F4' || $lus->parameter=='F5' || $lus->parameter=='F6' || $lus->parameter=='F7' || $lus->parameter=='F9'){
                                            if($lus->value==1){
                                                $flag[]=1;
                                            }else{
                                                $flag[]=0;
                                            }
                                        }
                                        if($lus->parameter=='P14'){
                                            $network_value=$lus->value;
                                        }
                                    }
                                }
                                if(in_array("0", $flag)){


                            ?>  
                                Fault Found 
                                <div class="led-box">
                                    <div class="led-red"></div>
                                </div> 
                            <?php } else{ ?>
                                No Fault Found 
                                <div class="led-box">
                                    <div class="led-green"></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="data-range dropdown">
                                <!-- <i class="batch-icon batch-icon-calendar"></i> -->
                                <?php 
                                    $status=$this->User_model->getsitepumpstatus($latest_user_sites[0]->imei);

                                    if(!empty($status)){
                                        if($status[0]->status==1){
                                            $checked='checked';
                                        }else{
                                            $checked='';
                                        }
                                    }else{
                                        $checked='';
                                    }
                                ?>
                                Pump ON/OFF
                                <input data-toggle="toggle" data-style="ios" type="checkbox" data-size="small"  data-on="Enabled" data-off="Disabled" onchange="status(this)" data-imei="<?= $latest_user_sites[0]->imei?>" <?= $checked?> > 
                            </span>
                        </div>  
                    </div>
                </div>
                 <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-12">
                        <span>
                            <ul class="pull-right list-inline mobiletower"> 

                                <?php if($network_value<=20){ 
                                    echo "<li class='oneicon'></li>";
                                    echo "<li class='towicon blank'></li>&nbsp";    
                                    echo "<li class='threeicon blank'></li>&nbsp";  
                                    echo "<li class='fouricon blank'></li>&nbsp";
                                    echo "<li class='fiveicon blank'></li>&nbsp<br>"; 
                                    echo "<li><b>Low</b></li>&nbsp"; 
                                    }else if($network_value<=40 && $network_value >20){
                                    echo "<li class='oneicon'></li>&nbsp";
                                    echo "<li class='towicon'></li>&nbsp";  
                                    echo "<li class='threeicon blank'></li>&nbsp";  
                                    echo "<li class='fouricon blank'></li>&nbsp";
                                    echo "<li class='fiveicon blank'></li>&nbsp<br>";
                                    echo "<li><b>weak</b></li>&nbsp";  
                                    }else if($network_value<=60 && $network_value >40){ 
                                    echo "<li class='oneicon'></li>&nbsp";
                                    echo "<li class='towicon'></li>&nbsp";  
                                    echo "<li class='threeicon'></li>&nbsp";
                                    echo "<li class='fouricon blank'></li>&nbsp";
                                    echo "<li class='fiveicon blank'></li>&nbsp<br>";
                                    echo "<li><b>Medium</b></li>&nbsp";  
                                    }else if($network_value<=80 && $network_value >60){
                                    echo "<li class='oneicon'></li>&nbsp;";
                                    echo "<li class='towicon'></li>&nbsp;"; 
                                    echo "<li class='threeicon'></li>&nbsp;";   
                                    echo "<li class='fouricon'></li>&nbsp;";
                                    echo "<li class='fiveicon blank'></li>&nbsp<br>";
                                    echo "<li><b>Strong</b></li>&nbsp";  
                                    }else{
                                    echo "<li class='oneicon'></li>&nbsp";
                                    echo "<li class='towicon'></li>&nbsp";  
                                    echo "<li class='threeicon'></li>&nbsp";    
                                    echo "<li class='fouricon'></li>&nbsp";
                                    echo "<li class='fiveicon'></li>&nbsp<br>"; 
                                    echo "<li><b>Very Strong</b></li>&nbsp";   
                                 } ?>       
                            </ul>
                        </span>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row dashboard" id="jobs">
    <div class="col-md-8 col-lg-8 col-xl-8 mb-5">
        <div class="card">
            <div class="card-header">
                Energy
                <div class="header-btn-block">
                    <span class="data-range dropdown">
                        <a href="<?php echo base_url(); ?>/User_Manufracture/export_device_view" class="btn btn-primary" data-flip="false" aria-haspopup="true" aria-expanded="false">
                            <i class="batch-icon batch-icon-calendar"></i>
                            Export
                        </a>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders">
                    <canvas id="demo-bar-chart"></canvas>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6 mb-5">
                <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                    <div class="card-body p-4">
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-list batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number"><?= !empty($dev_val[0]->acv3)?$dev_val[0]->acv3:'0'?></div>
                            <div class="tile-description">AC Voltage 3</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 mb-5">
                <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                    <div class="card-body p-4">
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number"><?= !empty($dev_val[0]->enrg)?$dev_val[0]->enrg:'0'?></div>
                            <div class="tile-description">Device Energy</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 mb-5">
                <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                    <div class="card-body p-4">
                        <!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-user-alt batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number"><?= !empty($dev_val[0]->lph)?$dev_val[0]->lph:'0'?></div>
                            <div class="tile-description">Litter Per Hr. [LPH]</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 mb-5">
                <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                    <div class="card-body p-4">
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-bulb-alt batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number"><?= !empty($dev_val[0]->itp)?$dev_val[0]->itp:'0'?></div>
                            <div class="tile-description">Input Terminal Power</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4 col-xl-4 mb-5">
        <div class="card">
            <div class="card-header">
                Power
                <div class="header-btn-block">
                    <span class="data-range dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                            <i class="batch-icon batch-icon-calendar"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbar-dropdown-traffic-sources-header-button">
                            <a class="dropdown-item" href="today">Today</a>
                            <a class="dropdown-item" href="week">This Week</a>
                            <a class="dropdown-item" href="month">This Month</a>
                            <a class="dropdown-item active" href="year">This Year</a>
                        </div>
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-5">
                    <div class="js-gauge js-gauge--1 gauge"></div>
                </div>
            </div>
        </div><br>
        <div class="card">
            <div class="card-header">
                Power
                <div class="header-btn-block">
                    <span class="data-range dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                            <i class="batch-icon batch-icon-calendar"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbar-dropdown-traffic-sources-header-button">
                            <a class="dropdown-item" href="today">Today</a>
                            <a class="dropdown-item" href="week">This Week</a>
                            <a class="dropdown-item" href="month">This Month</a>
                            <a class="dropdown-item active" href="year">This Year</a>
                        </div>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-sm bg-primary bg-gradient text-center">
                    <div class="card-body">
                        <i class="batch-icon batch-icon-database batch-icon-xxl"></i>
                        <h6 class="mt-1">Database Load</h6>
                        <div class="card-chart" data-chart-color-1="#FFFFFF" data-chart-color-2="#FFFFFF">
                            <canvas id="database-load"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-12 col-xl-12 mb-5">
        <div class="card">
            <div class="card-header">
                Products
            </div>
            <div class="card-body product_div">
                <div class="col-lg-12">
                    <div class="row">
                        <!--div class="col-md-4"></div-->
                            <?php
                            foreach($product as $row)
                            {
                                echo "<div class='col-md-4'>";
                                echo "<img src='".base_url()."assets/uploads/".$row->product_img."' height='200px' width='200px'>";
                                echo "<div class='container'><a><h4 class=''>".$row->product_name."</h4></a></div>";
                                echo "</div>";
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/kuma-gauge.jquery.js"></script>


        <script>
            $('.js-gauge--1').kumaGauge({
                value : Math.floor((Math.random() * 99) + 1)
            });

            $('.js-gauge--1').kumaGauge('update', {
                value : Math.floor((Math.random() * 99) + 1)
            });

            $('.js-gauge--2').kumaGauge({
                value : Math.floor((Math.random() * 99) + 1),
                fill : '#F34A53',
                gaugeBackground : '#1E4147',
                gaugeWidth : 10,
                showNeedle : false,
                label : {
                    display : true,
                    left : 'Min',
                    right : 'Max',
                    fontFamily : 'Helvetica',
                    fontColor : '#1E4147',
                    fontSize : '11',
                    fontWeight : 'bold'
                }
            });
    

            var update = setInterval(function() {
                var newVal = Math.floor((Math.random() * 99) + 1);
                $('.js-gauge--1').kumaGauge('update',{
                    value : newVal
                });     
            }, 1000);
            $("#site_name").change(function(){
                var site_id=$(this).val();
                window.location.href = "<?php echo base_url(); ?>" + "/User_Manufracture/index?site_id="+site_id;
            });
            function status(ths){
                var imei=$(ths).data('imei');
                if($(ths).is(':checked')){
                    var status=1;
                    var status_name="Enabled";
                }else{
                    var status=0;
                    var status_name="Disabled";
                }
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "/User_Manufracture/updatesitestatus",
                    data: { 'status' : status ,'imei':imei},
                    dataType: 'html',
                    success: function(data){
                        
                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                        $('.alert-box').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Pump  is '+status_name+' successfully <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        $('.alert').fadeIn().delay(10000).fadeOut(function () {
                            $(this).remove();
                        });
                    }
                });

            }
        </script>

<?php
    //header("Refresh:7;url=".base_url()."User_Manufracture");
?>
</body>

</html>