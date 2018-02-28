<html>
    <head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>	
        <script>
            $('#myCarousel').carousel({
              interval: 40000
            });

            $('.carousel .item').each(function(){
              var next = $(this).next();
              if (!next.length) {
                next = $(this).siblings(':first');
              }
              next.children(':first-child').clone().appendTo($(this));

              if (next.next().length>0) {

                  next.next().children(':first-child').clone().appendTo($(this)).addClass('rightest');

              }
              else {
                  $(this).siblings(':first').children(':first-child').clone().appendTo($(this));

              }
            });
        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js//html2canvas.js"></script>
        <script type="text/javascript">

                function screenshot(){
                        html2canvas([document.getElementById('sales_graph_div')], {   
                        onrendered: function(canvas)  
                        {
                            var img = canvas.toDataURL();
                            $.post("<?php echo base_url();?>Admin_Manufracture/imagesave", {data: img}, function (file) {
                            window.location.href =  "<?php echo base_url();?>Admin_Manufracture/download?path="+ file});   
                        }
                });
                }
                function sale_bar_graph(ths){	
                    var id=$(ths).data('id');
                    var div_id=$(ths).attr('id');
                    $.each($(".sales_bar_graph_class"), function() {
                        var each_id=$(this).attr('id')
                        $("#"+each_id).removeClass("active");
                    });
                    $("#"+div_id).addClass('active');
                        var name=$(ths).data('name');
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "/Distributer_Manufracture/getsalebargraph",
                        data: { 'id' : id },
                        dataType: 'json',
                        success: function(data1){

                                google.charts.load("current", {packages:['bar']});
                                    google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                                var data = new google.visualization.DataTable();

                                        data.addColumn('string', 'States');
                                        data.addColumn('number', 'Users');
                                        $.each(data1, function (index, value) {
                                                data.addRow([index, parseInt(value)]);

                                });

                                        var options = {
                                                chart: {
                                                  title: 'Sales Graph',
                                                  subtitle: 'Device name '+ name,
                                                },
                                                width: 1100,
                                                height: 300,
                                                colors: ['red' ]

                                                /*axes: {
                                                        x: {
                                                            0: {side: 'top'}
                                                        }
                                                }*/
                                        };
                                        var chart = new google.charts.Bar(document.getElementById('columnchart_values'));
                                        chart.draw(data, options);

                                        }


                        }
                });  		
            }
            function time_function(ths){
                $.each($(".revenue_report_a"), function() {
                    var each_id=$(this).attr('id');
                    $("#"+each_id).removeClass("active");
                });
                $(ths).addClass("active");
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
                        url: "<?php echo base_url(); ?>" + "/Distributer_Manufracture/getrevenuegraph",
                        data: { 'time_id' : time_id },
                        dataType: 'json',
                        success: function(data1){

                                google.charts.load("current", {packages:['corechart', 'line']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                    var data = new google.visualization.DataTable();

                                    data.addColumn('string', 'Year');
                                    data.addColumn('number', 'No. of Sites');
                                    $.each(data1, function (index, value) {
                                            data.addRow([index, parseInt(value)]);

                                    });

                                    var options = {
                                            chart: {
                                              title: 'Total Number of Sites added ',
                                              //subtitle: 'Device name '+ device_name,
                                            },
                                            width: 950,
                                            height: 300,
                                            colors: ['blue' ]


                                    };
                                    var chart = new google.charts.Line(document.getElementById('linechart_values'));
                                    chart.draw(data, options);
                                }


                        }
                    });
                }
            }
        </script>
        <style type="text/css">
                .device-panel img
                {
                        height:70%;
                        width:33%;
                }
        </style>
    </head>

    <body>
        <div class="row dashboard">
            <div class="col-md-4 col-lg-4 col-xl-4 mb-5">
                <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                    <div class="card-body p-4">
                        <!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-list-alt batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number">24</div>
                            <div class="tile-description">Total Projects</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 mb-5">
                <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                    <div class="card-body p-4">
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-users batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number">90</div>
                            <div class="tile-description">Total Users</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 mb-5">
                <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                    <div class="card-body p-4">
                        <div class="tile-left">
                            <i class="batch-icon batch-icon-switch-on batch-icon-xxl"></i>
                        </div>
                        <div class="tile-right">
                            <div class="tile-number">200</div>
                            <div class="tile-description">No of Pumps</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row dashboard">
            <div class="col-md-12 col-lg-12">
                <div class="card card-md" style="height: 500px;">
                    <div class="card-header sales_graph_div">
                        <div class="row">
                            <div class="col-md-6">
                                Sales Bar graph 
                            </div>
                            <div class="col-md-6">

                                <div class="header-btn-block" style="top: 0px !important;">
                                    <span class="data-range dropdown">
                                        <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                            <i class="batch-icon batch-icon-calendar"></i>  Select Deivce Type
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button" id="sales_report_id_div">
                                            <?php
                                            $i = 1;
                                            foreach ($device_list as $device) {
                                                if ($i == 1) {
                                                    $active = 'active';
                                                    $i++;
                                                } else {
                                                    $active = '';
                                                }
                                                ?>
                                                <a class="dropdown-item sales_bar_graph_class <?= $active ?>" href="javascript:void(0)" id="<?= $device['id'] ?>_device" onclick="sale_bar_graph(this)" data-id="<?= $device['id'] ?>" data-name="<?= $device['device_name'] ?>"><?= $device['device_name'] ?></a>
                                            <?php } ?>

                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type='button' id='but_screenshot' value='Export to Image' class="btn btn-success" onclick='screenshot();'>

                            </div>
                        </div>
                    </div>
                    <div class="card-body " id="sales_graph_div">
                        <!-- <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders" data-chart-height="281">
                                <canvas id="sales-overview"></canvas>
                                </div> -->
                        <div id="columnchart_values" style="width: 1000px; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="row dashboard">
            <div class="col-md-12 col-lg-12">
                <div class="card card-md">
                    <div class="card-header">
                        Revenue Graph
                        <div class="header-btn-block">
                            <span class="data-range dropdown">
                                <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                    <i class="batch-icon batch-icon-calendar"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
                                    <a class="dropdown-item" href="today">Today</a>
                                    <a class="dropdown-item" href="week">This Week</a>
                                    <a class="dropdown-item" href="month">This Month</a>
                                    <a class="dropdown-item active" href="year">This Year</a>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders" data-chart-height="281">
                            <canvas id="sales-overview"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>	-->
        <div class="row dashboard">
            <div class="col-md-12 col-lg-12">
                <div class="card card-md" style="height: 500px;">
                    <div class="card-header revenue_graph_div" id="revenue_graph_div">
                        <div class="row">
                            <div class="col-md-9">
                                Revenue Graph
                            </div>
                            <div class="col-md-3">
                                <div class="header-btn-block">
                                    <span class="data-range dropdown">
                                        <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                            <i class="batch-icon batch-icon-calendar"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button" id="revenue_report_time">
                                            <a class="dropdown-item revenue_report_a " href="javascript:void(0)" data-id="year" id="year" onclick="time_function(this)">Year</a>
                                            <a class="dropdown-item revenue_report_a" href="javascript:void(0)" data-id="month" id="month" onclick="time_function(this)">Month</a>
                                            <!--										<a class="dropdown-item revenue_report_a" href="javascript:void(0)" data-id="week">This Week</a>-->
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type='button' id='but_screenshot' value='Export to Image' class="btn btn-success" onclick='screenshot_revenue();'>

                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="">
                        <div id="linechart_values" style="width: 1000px; height: 300px;"></div>
                    </div>

                </div>
            </div>
        </div>
<!--        <div class="row dashboard">		
            <div class="col-md-12 col-lg-12">
                <div class="card card-md">
                    <div class="card-header">
                        Sales Graph
                        <div class="header-btn-block">
                            <span class="data-range dropdown">
                                <a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                    <i class="batch-icon batch-icon-calendar"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-traffic-sources-header-button">
                                    <a class="dropdown-item" href="today">Today</a>
                                    <a class="dropdown-item active" href="week">This Week</a>
                                    <a class="dropdown-item" href="month">This Month</a>
                                    <a class="dropdown-item" href="year">This Year</a>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders">
                            <canvas id="demo-stacked-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row dashboard">		
            <div class="card col-lg-12">
                <div class="card-header">
                    All Products
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
        <script type="text/javascript">
                var id=$('#sales_report_id_div').find('.sales_bar_graph_class.active').data('id');
                var name=$('#sales_report_id_div').find('.sales_bar_graph_class.active').data('name');

                $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "/Distributer_Manufracture/getsalebargraph",
                        data: { 'id' : id },
                        dataType: 'json',
                        success: function(data1){

                                google.charts.load("current", {packages:['bar']});
                                    google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                                var data = new google.visualization.DataTable();

                                        data.addColumn('string', 'States');
                                        data.addColumn('number', 'Users');
                                        $.each(data1, function (index, value) {
                                                data.addRow([index, parseInt(value)]);

                                });

                                        var options = {
                                                chart: {
                                                  title: 'Sales Graph',
                                                  subtitle: 'Device name '+ name,
                                                },
                                                width: 970,
                                                height: 300,
                                                colors: ['red' ]

                                                /*axes: {
                                                        x: {
                                                            0: {side: 'top'}
                                                        }
                                                }*/
                                        };
                                        var chart = new google.charts.Bar(document.getElementById('columnchart_values'));
                                        chart.draw(data, options);

                                        }


                        }
                });  			
                var time_id="year";
                $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "/Distributer_Manufracture/getrevenuegraph",
                        data: { 'time_id' : time_id },
                        dataType: 'json',
                        success: function(data1){

                                google.charts.load("current", {packages:['corechart', 'line']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                    var data = new google.visualization.DataTable();

                                    data.addColumn('string', 'Year');
                                    data.addColumn('number', 'No. of Sites');
                                    $.each(data1, function (index, value) {
                                            data.addRow([index, parseInt(value)]);

                                    });

                                    var options = {
                                            chart: {
                                                title: 'Total Number of Sites added ',
                                              //subtitle: 'Device name '+ device_name,
                                            },
                                            width: 970,
                                            height: 300,
                                            colors: ['blue' ]


                                    };
                                    var chart = new google.charts.Line(document.getElementById('linechart_values'));
                                    chart.draw(data, options);
                                }


                        }
                });
        </script>
    </body>
</html>