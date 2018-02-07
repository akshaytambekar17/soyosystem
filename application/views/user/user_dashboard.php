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
					<i class="batch-icon batch-icon-user-alt batch-icon-xxl"></i>
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
					<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
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
					<div class="tile-number"><?php echo $row->lph; }?></div>
					<div class="tile-description">Litter Per Hr. [LPH]</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row dashboard">
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
</div>
</div>


<?php $this->load->view('includes/footer');?>
<?php
	header("Refresh:5;url=".base_url()."User_Manufracture");
?>
</body>

</html>