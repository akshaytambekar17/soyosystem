<html>
<head>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
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
                            <p><b>Site name </b>
                                <?php 
                                    $site=$this->User_model->get_user_site_by_imei($latest_user_sites[0]->imei);
                                    echo $site[0]->site_name;
                                ?>
                                
                            </p>
                                <input type="hidden" value="<?= $site[0]->site_name?>" id="site_name_hidden" name="site_name_hidden">
                                <input type="hidden" value="<?= $latest_user_sites[0]->imei?>" id="imei_no" name="imei_no">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                        <div class="container">
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
                                                            $network_value=ceil($lus->value);
                                                        }
                                                        if($lus->parameter=='P6'){
                                                            $voltage3=$lus->value;
                                                        }
                                                        if($lus->parameter=='P11'){
                                                            $energy=$lus->value;
                                                        }
                                                        if($lus->parameter=='P12'){
                                                            $lph=$lus->value;
                                                        }
                                                        if($lus->parameter=='P3'){
                                                            $itp=$lus->value;
                                                        }
                                                    }
                                                }
                                                if(in_array("0", $flag)){


                                            ?>
                                                            <input type="hidden" id="fault_indication" value="1">
                                                <div class="led-box">
                                                                            <div class="led-red"></div>
                                                                        </div>  
                                                                        Fault Found 
                                                                <?php } else{ ?>
                                                                <input type="hidden" id="fault_indication" value="0">
                                                                        <div class="led-box">
                                                                            <div class="led-green"></div>
                                                                        </div>
                                                                        No Fault Found 
                                                                <?php } ?>

                                                        </div>
                                    </a>
                            </div>
                            <div class="col-md-4">
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
                                    <input id="pump_checkbox" data-toggle="toggle" data-style="ios" type="checkbox" data-size="small"  data-on="Enabled" data-off="Disabled" onchange="status(this)" data-imei="<?= $latest_user_sites[0]->imei?>" <?= $checked?> > 
                                </span>
                            </div>
                            <div class="col-md-4">
                                <span>
                                    <!-- <img src="<?php echo base_url();?>assets/img/network.png" width="50" height="20" alt="Soyo Systems" class="pull-right"> -->
                                    Network Range
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
                            </div>.
                            


                            
                            
                        </div>
                    </div>
        </div>
    </div>
</div>
        <div class="row dashboard" id="jobs">
            <div class="col-md-8 col-lg-8 col-xl-8 mb-5">
                <div class="card">
                    <div class="card-header">
                        Total pump On time
                        <div class="header-btn-block">
                            <span class="data-range dropdown">
                                <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                    <i class="batch-icon batch-icon-calendar"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button" id="revenue_report_time">
                                    <a class="dropdown-item revenue_report_a " href="javascript:void(0)" data-id="year" id="year" onclick="time_function(this)">Year</a>
                                    <a class="dropdown-item revenue_report_a" href="javascript:void(0)" data-id="month" id="month" onclick="time_function(this)">Month</a>
                                    <!--                                        <a class="dropdown-item revenue_report_a" href="javascript:void(0)" data-id="week">This Week</a>-->
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="card-body " id="sales_graph_div">
                        <!-- <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders" data-chart-height="281">
                            <canvas id="sales-overview"></canvas>
                            </div> -->
                        <div id="columnchart_values" style="width: 800px; height: 300px;"></div>
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
                                    <div class="tile-number"><?= !empty($voltage3) ? $voltage3 : '0' ?></div>
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
                                    <div class="tile-number"><?= !empty($energy) ? $energy : '0' ?></div>
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
                                    <div class="tile-number"><?= !empty($lph) ? $lph : '0' ?></div>
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
                                    <div class="tile-number"><?= !empty($itp) ? $itp : '0' ?></div>
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
                        Total Power
                        <div class="header-btn-block">
        <!--                    <span class="data-range dropdown">
                                <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                    <i class="batch-icon batch-icon-calendar"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbar-dropdown-traffic-sources-header-button">
                                    <a class="dropdown-item" href="today">Today</a>
                                    <a class="dropdown-item" href="week">This Week</a>
                                    <a class="dropdown-item" href="month">This Month</a>
                                    <a class="dropdown-item active" href="year">This Year</a>
                                </div>
                            </span>-->
                        </div>
                    </div>
                    <input type="hidden" value="<?= $power ?>" id="power" name="power">
                    <div class="card-body">
                        <div class="col-md-12 col-lg-12 col-xl-12 mb-5">
                            <!--                                    <div class="js-gauge js-gauge--1 gauge"></div>-->
                            <div id="container-speed" style="width: 300px; height: 200px; float: left"></div>
                        </div>
                    </div>
                </div>
                <br>
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
                                foreach ($product as $row) {
                                    echo "<div class='col-md-4'>";
                                    echo "<img src='" . base_url() . "assets/uploads/" . $row->product_img . "' height='200px' width='200px'>";
                                    echo "<div class='container'><a href='javascript:void(0)'><h4 class=''>" . $row->product_name . "</h4></a></div>";
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
        <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/kuma-gauge.jquery.js"></script> -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

    <script>
        if($("#fault_indication").val()==1){
            $('#pump_checkbox').attr('disabled', true);
        }else{
            $('#pump_checkbox').attr('disabled', false);
        }
            /*$('.js-gauge--1').kumaGauge({
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
                left : '',
                right : 'Max',
                fontFamily : 'Helvetica',
                fontColor : '#1E4147',
                fontSize : '11',
                fontWeight : 'bold'
            }
            });*/
            var imei_no=$('#imei_no').val();
            var site_name=$('#site_name_hidden').val();
            var time_id="year";
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "/User_Manufracture/getpumpbargraph",
                data: { 'imei_no' : imei_no, 'time_id' : time_id},
                dataType: 'json',
                success: function(data1){

                        google.charts.load("current", {packages:['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Year');
                            data.addColumn('number', 'Values');
                            $.each(data1, function (index, value) {
                                data.addRow([index, parseInt(value)]);
                            });
                            var options = {
                                            chart: {
                                              title: 'Pump Status Graph',
                                              subtitle: 'Site name '+ site_name,
                                            },
                                            width: 800,
                                            height: 300,
                                            colors: ['red' ]

                                        };
                            var chart = new google.charts.Bar(document.getElementById('columnchart_values'));
                            chart.draw(data, options);

                        }
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
            
            var gaugeOptions = {

                                chart: {
                                    type: 'solidgauge'
                                },
                                title: null,
                                pane: {
                                    center: ['50%', '85%'],
                                    size: '140%',
                                    startAngle: -90,
                                    endAngle: 90,
                                    background: {
                                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                                        innerRadius: '60%',
                                        outerRadius: '100%',
                                        shape: 'arc'
                                    }
                                },
                                tooltip: {
                                    enabled: false
                                },
                                // the value axis
                                yAxis: {
                                    stops: [
                                        [0.1, '#55BF3B'], // green
                                        [0.5, '#DDDF0D'], // yellow
                                        [0.9, '#DF5353'] // red
                                    ],
                                    lineWidth: 0,
                                    minorTickInterval: null,
                                    tickAmount: 2,
                                    title: {
                                        y: -70
                                    },
                                    labels: {
                                        y: 16
                                    }
                                },
                                plotOptions: {
                                    solidgauge: {
                                        dataLabels: {
                                            y: 5,
                                            borderWidth: 0,
                                            useHTML: true
                                        }
                                    }
                                }
                            };
                            var power=parseFloat($("#power").val());
                            // The speed gauge
                            var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
                                yAxis: {
                                    min: 0,
                                    max: 1000000,
                                    title: {
                                        text: 'Power'
                                    }
                                },

                                credits: {
                                    enabled: false
                                },

                                series: [{
                                    name: 'Power',
                                    data: [power],
                                    dataLabels: {
                                        format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                               '<span style="font-size:12px;color:silver">watt</span></div>'
                                    },
                                    tooltip: {
                                        valueSuffix: ' Watt'
                                    }
                                }]

                            }));
            
            
            function time_function(ths){
                $.each($(".revenue_report_a"), function() {
                    var each_id=$(this).attr('id');
                    $("#"+each_id).removeClass("active");
                });
                $(ths).addClass("active");
                var imei_no=$('#imei_no').val();
                var site_name=$('#site_name_hidden').val();
                var time_id=$('#revenue_report_time').find('.revenue_report_a.active').data('id');
                if(time_id==''){
                        alert("Please select time period");
                }else{
                    if(time_id=='year'){
                            var time_name="Year";
                    }else if(time_id="month"){
                            var time_name="Month";  
                    }else{
                            var time_name="Day";    
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "/User_Manufracture/getpumpbargraph",
                        data: { 'imei_no' : imei_no, 'time_id' : time_id},
                        dataType: 'json',
                        success: function(data1){

                                google.charts.load("current", {packages:['bar']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string', time_name);
                                    data.addColumn('number', 'Values');
                                    $.each(data1, function (index, value) {
                                        data.addRow([index, parseInt(value)]);
                                    });
                                    var options = {
                                                    chart: {
                                                      title: 'Pump Status Graph',
                                                      subtitle: 'Site name '+ site_name,
                                                    },
                                                    width: 800,
                                                    height: 300,
                                                    colors: ['red' ]

                                                };
                                    var chart = new google.charts.Bar(document.getElementById('columnchart_values'));
                                    chart.draw(data, options);

                                }
                        }
                    });
                }
            }

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