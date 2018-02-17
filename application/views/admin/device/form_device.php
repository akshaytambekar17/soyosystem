<html>
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>		
</head>

<body>
<div class="container-fluid">
	<div class="row">
		<div class="right-column">
			<main class="main-content p-5" role="main">
				<div class="row mb-4">
					<div class="col-md-12">
						<?php if($message = $this ->session->flashdata('Message')){?>
					            <div class="col-md-12 ">
					                <div class="alert alert-dismissible alert-success">
					                    <button type="button" class="close" data-dismiss="alert">&times;</button>
					                    <?=$message ?>
					                </div>
					            </div>
				        <?php }?> 
				        <?php if($message = $this ->session->flashdata('Error')){?>
				            <div class="col-md-12 ">
				                <div class="alert alert-dismissible alert-danger">
				                    <button type="button" class="close" data-dismiss="alert">&times;</button>
				                    <?=$message ?>
				                </div>
				            </div>
				        <?php }?> 
						<div class="card">
							<div class="card-header">
								<?= !empty($device_details)?'Update':'Add' ?> Device data
							</div>
							<div class="card">
								<div class="col-lg-12">
									<?php		
									$attribute=array('method'=>'post');
									echo form_open_multipart('',$attribute);
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleInputEmail1">Device Name</label>
												<?php
													if($this->form_validation->run() == FALSE)
													{echo form_error('device_name');}

													echo form_input(['type'=>'text','name'=>'device_name','class'=>'form-control form-group','placeholder'=>'Device name','value'=>!empty($device_details[0]->device_name)?$device_details[0]->device_name:set_value('device_name')])
												?>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Select Drive Manufacture</label>
												<?php
													if($this->form_validation->run() == FALSE)
												{echo form_error('category');}
												?>
												<select id="category" name="category" class="form-control select2" placeholder="Select Category" data-live-search="true" >
				                            		
				                             	<option disabled selected>Select Category</option>
						                        <option value="flags" <?= !empty($device_details[0]->category)?
						                        	$device_details[0]->category=='flags'?"selected":'':''?> >
			                                   			Flags      
			                                   	</option>
			                                   	<option value="values" <?= !empty($device_details[0]->category)?
						                        	$device_details[0]->category=='values'?"selected":'':''?> >
			                                   			Values      
			                                   	</option>
					                                   
					                            </select>
						                        <label class="control-label" for="memberfamilyrelation-name">Device  Paramters </label>

												<div class="col-sm-12 fields_wrap">
				                                    <?php  $count=1;
				                                    		$flags=1;
				                                    		$values=1;	
				                                    if(!empty($device_parameter)){ 
				                                        foreach($device_parameter as $value){

				                                     ?>  
				                                     <div class="row field-bg">
				                                         <div class="col-sm-5">
				                                             <div class="form-group field-memberfamilyrelation-name">
			                                                 	<input aria-invalid="true" id="device_parameter" class="form-control" name="device_parameter[<?=$count;?>]" maxlength="200" type="text" value="<?=$value->name?>"
			                                                 	placeholder="Paramters name" >
				                                             </div>
				                                         </div>
				                                         <div class="col-sm-5">
				                                             <div class="form-group">
			                                                 	<input aria-invalid="true" id="unique_id" class="form-control" name="unique_id[<?=$count;?>]" maxlength="200" type="text" value="<?=$value->unique_id?>" 
			                                                 	placeholder="Unique id">
				                                             </div>
				                                         </div>
				                                          
				                                         <div class="col-sm-2 text-right pull-right">
				                                             <a href="javascript:void(0)" class="remove_field remove-family-member btn btn-danger waves-effect waves-light">×</a>
				                                         </div>
				                                     </div>
				                                     <?php 
				                                     		$count++; 
				                                     		if("F".$flags==$value->unique_id){
				                                     			$flags++;
				                                     		}
				                                     		if("P".$values==$value->unique_id){
				                                     			$values++;
				                                     		}

				                                 		}  } ?>        
				                                 </div>		
	                                 			<input type="hidden" name="countHidden" id="countHidden" value="<?php echo $count?>" />
	                                 			<input type="hidden" name="flagshidden" id="flagshidden" value="<?php echo $flags?>" />
	                                 			<input type="hidden" name="valueshidden" id="valueshidden" value="<?php echo $values?>" />
					                            <div class="row">
					                                <div class="col-sm-12 private-public">
					                                    <a href="javascript:void(0)" class="add_pages add-family-member btn btn-info waves-effect waves-light" id="add_device_paramters"> <i class="fa fa-plus" aria-hidden="true"></i>Add Device Parameter</a>
					                                    <div id="message_r_cms"></div>
					                                </div>
					                            </div>
					                            <?php
												//echo form_input(['type'=>'text','name'=>'city','class'=>'form-control form-group','value'=>$user_details[0]->city]);

												
												echo form_input(['type'=>'hidden','name'=>'id','value'=>!empty($device_details[0]->id)?$device_details[0]->id:'']);

												echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>!empty($device_details)?'Update':'Save']);
												
											
												?>	
											</div>
										</div>
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
		
		$(".alert").delay(5000).slideUp(200, function() {
          	$(this).alert('close');
      	});
		var max_fields_cms      = 20//maximum input boxes allowed
        var wrapper         = $(".fields_wrap"); //Fields wrapper
        var count      = $("#countHidden").val();  
        var flags=$("#flagshidden").val();
        var values=$("#valueshidden").val();
        $('#add_device_paramters').on('click',function(e){
        	var category=$("#category").val();
        	
        	if(category!=null){

	         	e.preventDefault();
	         	if(count <= max_fields_cms){
	         		
	         		if(category=='flags'){
	         			var unique_id='F'+flags;
	         			flags++;
	         		}else{
	         			var unique_id='P'+values;
	         			values++;
	         		}
	         		html='<div class="row field-bg">';
		            html+='<div class="col-sm-5 private-public">';
		            html+='<div class="form-group field-memberfamilyrelation-name">';
		            html+='<input aria-invalid="true" id="device_parameter" class="form-control" name="device_parameter['+count+']" maxlength="100" type="text" placeholder="Paramters name">';
		            html+='</div></div>';
		            html+='<div class="col-sm-5 private-public">';
		            html+='<div class="form-group">';
		            html+='<input aria-invalid="true" id="unique_id" class="form-control" name="unique_id['+count+']" maxlength="100" type="text" placeholder="Unique id" value='+unique_id+'>';
		            html+='</div></div>';
	             	html+='<div class="col-sm-2 text-right pull-right"><a href="javascript:void(0)" class="remove_field remove-family-member btn btn-danger waves-effect waves-light">×</a></div>';
	                html+='</div>';
	                $(wrapper).append(html);  
	                count++;
	        	}else{

	                $('#message_r_cms').addClass('alert-success');
	                $('#message_r_cms').html("You can add upto 20 Paramters.").fadeIn().delay(2000).fadeOut();  
	            }
        	}else{
        		
       			alert("Please Select Category"); 		
        	}
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); count--;
        });

	});
	
</script>

</body>

</html>