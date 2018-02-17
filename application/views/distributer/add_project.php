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
							<h1>Add New Projectct</h1>
						</div>
					</div>
					<div class="row mb-4">
						<div class="col-md-6 mb-5">
							<div class="card">
								<div class="card-header">
									Enter Your New Project Details
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
								echo form_open('Distributer_Manufracture/new_project');
								?>
									<div class="form-group">
										<?php
										if($this->form_validation->run() == FALSE)
										{echo "<p class='text-danger'>".form_error('pname')."</p>";}
										?>
										<label for="exampleInputEmail1">Project Name</label>
										<?php
											echo form_input(['type'=>'text','name'=>'pname','class'=>'form-control','placeholder'=>'Project Name']);
										?>
									</div>
									<div class="form-group">
										<?php
										if($this->form_validation->run() == FALSE)
										{echo "<p class='text-danger'>".form_error('state')."</p>";}
										?>
										<label for="exampleInputEmail1">State</label>
											<?php
												//echo form_input(['type'=>'text','name'=>'state','class'=>'form-control','aria-describedb'=>'emailHelp','placeholder'=>'Enter state']);
											?>
											 <select id="state" name="state" class="form-control select2" placeholder="Select State" data-live-search="true" >

					                             <option disabled selected>Select State</option>
					                                <?php foreach ($state as $value) { ?>
					                                   <option value="<?php echo $value['id'];?>" <?php echo  set_select('category',$value['id'] ); ?>
					                                   	>
				                                   			<?php echo $value['name']; ?>      
					                                   </option>
				                                   <?php } ?>  
				                            </select>
									</div>
									<div class="form-group">
										<?php
										if($this->form_validation->run() == FALSE)
										{echo "<p class='text-danger'>".form_error('dist')."</p>";}
										?>
										<label for="exampleInputPassword1">District</label>
										<?php
											echo form_input(['type'=>'text','name'=>'dist','class'=>'form-control','placeholder'=>'District']);
										?>
									</div>
									<div class="form-group">
										<?php
										if($this->form_validation->run() == FALSE)
										{echo "<p class='text-danger'>".form_error('city')."</p>";}
										?>
										<label for="exampleInputPassword1">City</label>
										<?php
											echo form_input(['type'=>'text','name'=>'city','class'=>'form-control','placeholder'=>'City']);
										?>
									</div>
									<button type="submit" class="btn btn-primary btn-gradient btn-block">
										<i class="batch-icon batch-icon-key"></i>
										ADD PROJECT
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
											Recently Added Projects
										</div>
										<div class="card-table">
										<?php 
										echo form_open('Distributer_Manufracture/edit_project');?>
											<div class="form-group">
												
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
								
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		
	    $("#state").change(function(){
	    	var state = $("#state").val();
            $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>" + "/Admin_Manufracture/getdistrictlist",
                      data: { 'state' : state },
                      dataType: 'html',
                      success: function(data){
                        var obj = $.parseJSON(data);
                        console.log(obj);
                        jQuery("#district").html('<option disabled selected> Select District</option>');
                        jQuery("#district").append(obj);

                      }
            });
        });
	      $(".alert").delay(5000).slideUp(200, function() {
	          $(this).alert('close');
	      });
	});
	</script>

</body>
</html>