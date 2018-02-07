<div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <!-- <span class="divider">/</span> -->
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <!-- <span class="divider">/</span> -->
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
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
            //form data
            $attributes = array('class' => 'form-horizontal', 'method' => 'POST');
            

            //form validation
            echo validation_errors();
            
            echo form_open('admin/labours/add', $attributes);
            ?>
              <fieldset>
                <div class="control-group">
                  <label for="inputError" class="control-label">Full Name</label>
                  <div class="col-md-4">
                    <input type="text" id="" name="fullname" class="form-control" value="<?php echo set_value('fullname'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                  </div>
                </div>
                <div class="control-group">
                  <label for="inputError" class="control-label">Address</label>
                  <div class="col-md-4">
                    <input type="text" id="" name="address" class="form-control" value="<?php echo set_value('address'); ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                  </div>
                </div>          
                <div class="control-group">
                  <label for="inputError" class="control-label">Mobile No</label>
                  <div class="col-md-4">
                    <input type="text" id="" name="mobno" class="form-control" value="<?php echo set_value('mobno'); ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                  </div>
                </div>
                <div class="control-group">
                  <label for="inputError" class="control-label">Email-Id</label>
                  <div class="col-md-4">
                    <input type="email" name="email"  class="form-control"  value="<?php echo set_value('email'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="inputError" class="control-label">Category</label>
                  <div class="col-md-4">
                    <!-- <input type="text" name="category" class="form-control"  value="<?php echo set_value('category'); ?>"> -->
                    <select class="selectpicker" id="category" name="category" data-live-search="true">
                        <option selected="selected" disabled="disabled">Select Category</option>
                        <option data-tokens="Labour" value="labour" <?php echo  set_select('category', 'labour'); ?> >Labour</option>
                        <option data-tokens="Driver" value="driver" <?php echo  set_select('category', 'driver'); ?>>Driver</option>
                    </select>
                  </div>
                </div>
                
                <?php
               /* echo '<div class="control-group">';
                  echo '<label for="manufacture_id" class="control-label">Superwiser</label>';
                  echo '<div class="controls">';
                    //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');
                    
                    echo form_dropdown('supid', $options_manufacture, set_value('supid'), 'class="span2"');

                  echo '</div>';
                echo '</div">';*/
                ?>
                <div class="control-group">
                    <label for="manufacture_id" class="control-label">Superviser</label>
                    <div class="col-md-4">
                        <select class="selectpicker labour" id="supid" name="supid" data-live-search="true">
                          <option selected="selected" disabled="disabled">Select Supervisor</option>
                          <?php foreach($manufactures as $value) {?>
                            <option data-tokens="<?= $value['fullname']?>" value="<?= $value['userid']?>" <?php echo  set_select('supid', $value['userid']); ?>><?= $value['fullname']?></option>
                          <?php }?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                      <label for="inputError" class="control-label">Payment</label>
                      <div class="col-md-4">
                        <input type="text" name="payment"  class="form-control"  value="<?php echo set_value('payment'); ?>">
                      
                      </div>
                </div>
                <div class="form-actions">
                  <button class="btn btn-primary" type="submit">Save changes</button>
                  <a href="<?=site_url("admin")?>/labours" class="btn btn-danger">Back</a>

                  <!-- <button class="btn" type="reset">Cancel</button> -->
                </div>
              </fieldset>

            <?php echo form_close(); ?>
          </div>
      </div>  

    </div>
     
    <script type="text/javascript">
      $(".alert").delay(5000).slideUp(200, function() {
          $(this).alert('close');
      });
    </script>