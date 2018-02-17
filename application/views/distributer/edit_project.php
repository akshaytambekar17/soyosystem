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
							<h1>Edit Project</h1>
						</div>
					</div>
					<div class="row mb-4">
						<div class="col-md-6 mb-5">
							<div class="card">
								<div class="card-header">
									Select Project To Update
									<?php
									if($this->session->flashdata('project_added'))
									{
										echo "<p class='text-success'>".$this->session->flashdata('project_added')."</p>";
									}
									if($this->session->flashdata('project_add_fail'))
									{
										echo "<p class='text-danger'>".$this->session->flashdata('project_add_fail')."</p>";
									}
									?>
								</div>
								<div class="card-body">
								<?php 
									echo form_open('Distributer_Manufracture/edit_project');?>
										<div class="form-group">
											<label for="exampleInputPassword1">Select Project To Edit</label>
											<?php
											$attributes=array('class'=>'form-control');
											$options = array(0 => "Select Project");
											$selected= array('Select Project');
								            foreach ($prdata as $row)
								            {
								              $options[$row['project_id']] = $row['project_name'];
								            }
								             echo form_dropdown('project_id', $options,$selected,$attributes);
											?>
										</div>
										<button type="submit" class="btn btn-primary btn-gradient btn-block">
											<i class="batch-icon batch-icon-key"></i>
											Edit
										</button>
									</form>
									<?php
									
										echo form_open('Distributer_Manufracture/edit_project');
									?>
										<div class="form-group">
											<?php
											if($this->form_validation->run() == FALSE)
											{echo "<p class='text-danger'>".form_error('pname')."</p>";}
											?>
											<label for="exampleInputEmail1">Project Name</label>
											<?php
												echo form_input(['type'=>'text','name'=>'pname','class'=>'form-control','value'=>'Project Name']);
											?>
										</div>
										<div class="form-group">
											<?php
											if($this->form_validation->run() == FALSE)
											{echo "<p class='text-danger'>".form_error('state')."</p>";}
											?>
											<label for="exampleInputPassword1">State</label>
											<?php
												echo form_input(['type'=>'text','name'=>'state','class'=>'form-control','value'=>'State']);
											?>
										</div>
										<div class="form-group">
											<?php
											if($this->form_validation->run() == FALSE)
											{echo "<p class='text-danger'>".form_error('dist')."</p>";}
											?>
											<label for="exampleInputPassword1">District</label>
											<?php
												echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control','value'=>'District']);
											?>
										</div>
										<div class="form-group">
											<?php
											if($this->form_validation->run() == FALSE)
											{echo "<p class='text-danger'>".form_error('city')."</p>";}
											?>
											<label for="exampleInputPassword1">City</label>
											<?php
												echo form_input(['type'=>'text','name'=>'city','class'=>'form-control','value'=>'City']);
											?>
										</div>
										<div class="form-group">
											<?php
											if($this->form_validation->run() == FALSE)
											{echo "<p class='text-danger'>".form_error('systype')."</p>";}
											?>
											<label for="exampleInputPassword1">System type</label>
											<?php
												echo form_input(['type'=>'text','name'=>'systype','class'=>'form-control','value'=>'System Type']);
											?>
										</div>
										<button type="submit" class="btn btn-primary btn-gradient btn-block">
											<i class="batch-icon batch-icon-key"></i>
											Save Changes
										</button>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row mb-4 ">
								<div class="col-md-12 mb-5">
									<div class="card edit-field">
										<div class="card-header">
											EDIT PROJECT
										</div>
										<div class="card-table">
										
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

</body>
</html>