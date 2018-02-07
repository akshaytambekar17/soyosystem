<div class="container top">
      <div class="row"> 
            <div class="col-md-12">
              
                <h2 style="font-family:georgia san-serif; text-align: center;">Sunraj Admin Panel</h2>
            </div>
              
      </div>
      <ul class="breadcrumb">
        
        <li class="active">
           Privacy
        </li>
      </ul>
      
      <div class="page-header users-header">
          <h2>Edit Admin Information</h2>
      </div>
    
      <?php if($message = $this -> session -> flashdata('message')){?>
          <div class="col-md-12 pull-right">
              <div class="alert alert-dismissible alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <?=$message ?>
              </div>
          </div>
      <?php }?> 
      <div class="row">
          <div class="col-sm-12">
            <?php
                if($this->session->userdata('user_name')){


                  $attributes = array('class' => 'form-horizontal', 'method' => 'POST');
                  
                  echo validation_errors();
              
                  echo form_open('admin/privacy', $attributes);

                  foreach ($userdetails as $key => $value) {
                    # code...
                
            ?>
                    <fieldset>
                      <div class="control-group">
                        <label for="inputError" class="control-label">Fullname</label>
                        <div class="col-md-4">
                          <input type="text" id="" name="fullname" class="form-control" value="<?php echo $value['fullname'];?>" >
                          <!--<span class="help-inline">Woohoo!</span>-->
                        </div>
                      </div>
                              
                      <div class="control-group">
                        <label for="inputError" class="control-label">Email Id</label>
                        <div class="col-md-4">
                          <input type="email" id="" name="email" class="form-control" value="<?php echo $value['email']; ?>">
                          <!--<span class="help-inline">Cost Price</span>-->
                        </div>
                      </div>
                      <div class="control-group">
                        <label for="inputError" class="control-label">Address</label>
                        <div class="col-md-4">
                          <input type="text" id="" name="address" class="form-control" value="<?php echo !empty($value['address'])?$value['address']:set_value('address'); ?>">
                          <!--<span class="help-inline">Cost Price</span>-->
                        </div>
                      </div>
                      <div class="control-group">
                        <label for="inputError" class="control-label">Mobile No</label>
                        <div class="col-md-4">
                          <input type="text" id="" name="mobno" class="form-control" value="<?php echo !empty($value['mobno'])?$value['mobno']:set_value('mobno');?>">
                          <!--<span class="help-inline">Cost Price</span>-->
                        </div>
                      </div>
                      <div class="control-group">
                        <label for="inputError" class="control-label">Username</label>
                        <div class="col-md-4">
                          <input type="text" name="username"  class="form-control"  value="<?php echo $value['username']; ?>" readonly>
                          <!--<span class="help-inline">OOps</span>-->
                        </div>
                      </div>
                      <div class="control-group">
                        <label for="inputError" class="control-label">New Password</label>
                        <div class="col-md-4">
                          <input type="password" name="password"  class="form-control"  value="<?php echo set_value('password') ?>">
                          <!--<span class="help-inline">OOps</span>-->
                        </div>
                      </div>
                      <div class="form-actions">
                        
                          <button class="btn btn-primary" type="submit">Save</button>
                          <a href="<?=site_url("admin")?>/labours" class="btn btn-danger">Back</a>  
                        <!-- <button class="btn" type="reset">Cancel</button> -->
                      </div>
                    </fieldset>

            <?php 
                  } 
                  echo form_close();
                }

            ?>
          </div>
      </div>
</div>
<script type="text/javascript">
    $(".alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
    });
</script>