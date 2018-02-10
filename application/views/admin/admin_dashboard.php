<html>
<head>
	
</head>

<body>
	<div class="row dashboard">
		<div class="col-md-6 col-lg-6 col-xl-3 mb-5">
			<div class="card card-tile card-xs bg-primary bg-gradient text-center">
				<div class="card-body p-4">
					<!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
					<div class="tile-left">
						<i class="batch-icon batch-icon-user-alt batch-icon-xxl"></i>
					</div>
					<div class="tile-right">
						<div class="tile-number"><?= count($device_list)?></div>
						<div class="tile-description">Number of Pumps</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-xl-3 mb-5">
			<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
				<div class="card-body p-4">
					<div class="tile-left">
						<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
					</div>
					<div class="tile-right">
						<div class="tile-number"><?= count($distributers_list)?></div>
						<div class="tile-description">Distributers</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-xl-3 mb-5">
			<div class="card card-tile card-xs bg-primary bg-gradient text-center">
				<div class="card-body p-4">
					<div class="tile-left">
						<i class="batch-icon batch-icon-list batch-icon-xxl"></i>
					</div>
					<div class="tile-right">
						<div class="tile-number">26</div>
						<div class="tile-description">Total Projects</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-xl-3 mb-5">
			<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
				<div class="card-body p-4">
					<div class="tile-left">
						<i class="batch-icon batch-icon-list batch-icon-xxl"></i>
					</div>
					<div class="tile-right">
						<div class="tile-number">7</div>
						<div class="tile-description">Faulty Pumps</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row dashboard">
		<div class="col-sm-4 mb-5">
			<div class="card card-sm bg-info">
				<div class="card-body">
					<div class="mb-4 clearfix">
						<div class="float-left text-warning text-left">
							<i class="fa fa-twitter batch-icon-xxl"></i>
						</div>
						<div class="float-right text-right">
							<h6 class="m-0">Total Sale</h6>
						</div>
					</div>
					<div class="text-right clearfix">
						<div class="display-4">65,452</div>
						<div class="m-0">+7 Today</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 mb-5">
			<div class="card card-sm">
				<div class="card-body">
					<div class="mb-4 clearfix">
						<div class="float-left text-warning text-left">
							<i class="batch-icon batch-icon-star batch-icon-xxl"></i>
						</div>
						<div class="float-right text-right">
							<h6 class="m-0">Reviews</h6>
						</div>
					</div>
					<div class="text-right clearfix">
						<div class="display-4">7,842</div>
						<div class="m-0">
							<a href="#">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 mb-5">
			<div class="card card-sm bg-danger">
				<div class="card-body">
					<div class="mb-4 clearfix">
						<div class="float-left text-left">
							<i class="batch-icon batch-icon-reply batch-icon-xxl"></i>
						</div>
						<div class="float-right text-right">
							<h6 class="m-0">Products Returned</h6>
						</div>
					</div>
					<div class="text-right clearfix">
						<div class="display-4">231</div>
						<div class="m-0">-4% Today</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="row dashboard">
		<div class="col-md-12 col-lg-12">
			<div class="card">
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
	</div>
	<div class="row dashboard">		
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
	</div>
</div>


<?php $this->load->view('includes/footer');?>
</body>

</html>