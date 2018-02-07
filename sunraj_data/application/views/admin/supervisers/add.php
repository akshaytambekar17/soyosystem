<div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 

        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 

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
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/supervisers/add', $attributes);
      ?>
             <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Full Name</label>
            <div class="controls">
              <input type="text" id="" name="fullname" value="<?php echo set_value('fullname'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
              <input type="text" id="" name="address" value="<?php echo set_value('address'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Mobile No</label>
            <div class="controls">
              <input type="text" id="" name="mobno" value="<?php echo set_value('mobno'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Email-Id</label>
            <div class="controls">
              <input type="email" name="email" value="<?php echo set_value('email'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Username</label>
            <div class="controls">
              <input type="text" name="uname" value="<?php echo set_value('uname'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Password</label>
            <div class="controls">
              <input type="password" name="password" value="<?php echo set_value('password'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?=site_url("admin")?>/supervisers" class="btn btn-danger">Back</a>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     <script type="text/javascript">
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
    </script>