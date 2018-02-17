<!DOCTYPE html>
<html lang="en">
<head>
	
</head>

<body>

	<div class="container-fluid">
		<div class="row">
			<div class="right-column">
				<main class="main-content p-5" role="main">
					<div class="row">
						<div class="col-md-12">
							<h1>Notifications</h1>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									All Notifications
									<div class="progress">
										<div class="progress-bar progress-bar-sm bg-gradient" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
									</div>
									<div class="header-btn-block">
										<a href="" class="btn btn-primary">
											<i class="batch-icon batch-icon-add"></i> 
											Add New Task
										</a>
									</div>
								</div>
								<div class="card-task-list">
									<ul class="task-list">
										<?php
										foreach($note as $row)
										{?>
										<li class="task-list-item">
											<div class="checkbox" data-toggle="buttons">
												<label class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input">
													<span class="custom-control-indicator"></span>
													<span class="custom-control-description">
													New User
													</span>
												</label>
											</div>
											<div class="task-item-details">
												<?php echo $row->message; ?>
											</div>
											<div class="task-item-controls">
												<a role="button" class="btn btn-info btn-sm show-task" href="#">
													<span class="batch-icon batch-icon-arrow-down"></span>
												</a>
											</div>
										</li>
										<?php }
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-5">
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


</body>
</html>