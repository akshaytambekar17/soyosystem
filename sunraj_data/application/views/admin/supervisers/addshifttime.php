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
          <a href="#">Superviser Sift Time</a>
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
 
 

    $options_manufacture = array();
      foreach ($manufactures as $row)
            {
              $options_manufacture[$row['userid']] = $row['fullname'];
            }

             //form data
$attributes = array('class' => 'form-horizontal', 'id' => '');
//form validation
      echo validation_errors();
      echo form_open('admin/supervisers/addshifttime', $attributes);
      ?>

      <div class="control-group">
             <fieldset>
             <div class="control-group">
         <?php
          echo form_label('Superviser:', 'supid');
        echo form_dropdown('supid', $options_manufacture, '0', 'class="span2"');
 ?>
    </div>

          <div class="control-group">
            <label for="inputError" class="control-label">In-Time</label>
            <div class="controls">
              <input name="intime" type="text" class="datepicker" value="<?php echo set_value('intime'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Out-Time</label>
            <div class="controls">
              <input name="outtime" type="text" class="datepicker" value="<?php echo set_value('outtime'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
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