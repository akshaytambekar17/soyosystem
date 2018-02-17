<html>
<head>
	
</head>

<body>
<?php foreach($dev_val as $row)
{?>
<div class="row dashboard" id="jobs">
	<div class="col-md-4 col-lg-4 col-xl-3 mb-5">
		<div class="card card-tile card-xs bg-primary bg-gradient text-center">
			<div class="card-body p-4">
				<!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
				<div class="tile-left">
					<i class="batch-icon batch-icon-bulb batch-icon-xxl"></i>
				</div>
				<div class="tile-right">
					<div class="tile-number"><?php echo $row->acv1;?></div>
					<div class="tile-description">AC Voltage 1</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-lg-4 col-xl-3 mb-5">
		<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
			<div class="card-body p-4">
				<div class="tile-left">
					<i class="batch-icon batch-icon-wave-alt batch-icon-xxl"></i>
				</div>
				<div class="tile-right">
					<div class="tile-number"><?php echo $row->acv2;?></div>
					<div class="tile-description">AC Voltage 2</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-lg-4 col-xl-3 mb-5">
		<div class="card card-tile card-xs bg-primary bg-gradient text-center">
			<div class="card-body p-4">
				<div class="tile-left">
					<i class="batch-icon batch-icon-list batch-icon-xxl"></i>
				</div>
				<div class="tile-right">
					<div class="tile-number"><?php echo $row->acv3;?></div>
					<div class="tile-description">AC Voltage 3</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-lg-4 col-xl-3 mb-5">
		<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
			<div class="card-body p-4">
				<div class="tile-left">
					<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
				</div>
				<div class="tile-right">
					<div class="tile-number"><?php echo $row->enrg;?></div>
					<div class="tile-description">Device Energy</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-lg-4 col-xl-3 mb-5">
		<div class="card card-tile card-xs bg-primary bg-gradient text-center">
			<div class="card-body p-4">
				<!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
				<div class="tile-left">
					<i class="batch-icon batch-icon-user-alt batch-icon-xxl"></i>
				</div>
				<div class="tile-right">
					<div class="tile-number"><?php echo $row->lph; ?></div>
					<div class="tile-description">Litter Per Hr. [LPH]</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-lg-4 col-xl-3 mb-5">
		<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
			<div class="card-body p-4">
				<div class="tile-left">
					<i class="batch-icon batch-icon-bulb-alt batch-icon-xxl"></i>
				</div>
				<div class="tile-right">
					<div class="tile-number"><?php echo $row->itp;?></div>
					<div class="tile-description">Input Terminal Power</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-lg-6 col-xl-8 mb-5">
			<div class="card">
				<div class="card-header">
					Energy
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
		<div class="col-md-6 col-lg-6 col-xl-4 mb-5">
			<div class="card card-md">
				<div class="card-header">
					Water Flow
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
				<div class="card-body text-center">
					<p class="text-left"></p>
					<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#07a7e3" data-chart-color-3="#07a7e3" data-chart-color-4="#07a7e3" data-chart-color-5="#ffffff">
						<canvas id="traffic-source"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php } ?>
	<script type="text/javascript">
        /*var auto_refresh = setInterval(
            function() {
                $('#jobs').load("<?php //echo base_url();?>User_Manufracture/refresh_view").fadeIn("slow");
            }, 15000); // refreshing after every 15000 milliseconds*/
         /* $(document).ready(function(){
			setInterval(function(){
			$("#jobs").load("<?php //echo base_url();?>User_Manufracture/refresh_view");
			}, 2000);
			});*/
    </script>

<?php
	//header("Refresh:7;url=".base_url()."User_Manufracture");
?>
</body>

</html>