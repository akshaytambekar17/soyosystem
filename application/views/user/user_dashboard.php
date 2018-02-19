<html>
<head>
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
</head>

<body>
<div class="col-md-12 col-sm-12 col-xl-12">
	<div class="card">
		<div class="card-body">
	
			
			 <a href="#"><i class="batch-icon batch-icon-nope"></i>
			 Fault</a>&nbsp;|&nbsp;
			<span class="data-range dropdown">
				<a href="#" class="dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
					<i class="batch-icon batch-icon-calendar"></i>
					Pump ON/OFF
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
					<?php
					foreach($device as $row)
					{
					?>
					<p class="dropdown-item"><?php echo $row->imei_no;?>
						<span><input checked data-toggle="toggle" data-size="small" data-style="ios" type="checkbox">
						</span>
					</p>
					<?php
					}
					?>
				</div>
			</span>
			<span>
				<img src="<?php echo base_url();?>assets/img/network.png" width="50" height="20" alt="Soyo Systems" class="pull-right">
			</span>

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
						<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
							<i class="batch-icon batch-icon-calendar"></i>
							Export
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
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
								echo "<div class='container'><a href='".base_url()."Home_Controller/add_product'><h4 class=''>".$row->product_name."</h4></a></div>";
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
		</script>

<?php
	//header("Refresh:7;url=".base_url()."User_Manufracture");
?>
</body>

</html>