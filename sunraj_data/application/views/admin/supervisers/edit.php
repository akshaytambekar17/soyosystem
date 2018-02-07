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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

      <?php if($message = $this -> session -> flashdata('message')){?>
            <div class="col-md-12">
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

      echo form_open('admin/supervisers/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Full Name</label>
            <div class="controls">
              <input type="text" id="" name="fullname" value="<?php echo $manufacture[0]['fullname']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
              <input type="text" id="" name="address" value="<?php echo $manufacture[0]['address']; ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Mobile No</label>
            <div class="controls">
              <input type="text" id="" name="mobno" value="<?php echo $manufacture[0]['mobno'];?>" pattern="[789][0-9]{9}">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Email-id</label>
            <div class="controls">
              <input type="email" name="email" value="<?php echo $manufacture[0]['email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Username</label>
            <div class="controls">
              <input type="text" name="username" value="<?php echo $manufacture[0]['username']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Password</label>
            <div class="controls">
              <input type="text" name="password" value="<?php echo $manufacture[0]['password']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save Changes</button>
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