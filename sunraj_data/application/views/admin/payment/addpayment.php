<!-- <link href="<?php echo base_url(); ?>assets/css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script> -->

<style type="text/css">
    .form-horizontal .control-group > label {
        width: 110px;
    }
    .input-inline{
      width: 50%;
    }

</style>
<div class="container top">
      
    <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <!-- <span class="divider">/</span> -->
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/listpayment'; ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <!-- <span class="divider">/</span> -->
        </li>
        <li class="active">
          <a href="#">Add Payment</a>
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

      $attributes = array('class' => 'form-horizontal', 'id' => '','name'=>'addpaymentform');
      //form validation
      echo validation_errors();
      echo form_open('admin/payment/addpayment', $attributes);
  ?>
       <div class="control-group">
            <label for="inputError" class="control-label">Select Supervisor</label>
            <div class="controls">
              <select class="selectpicker supervisor" id="supervisor_dropdown" name="supervisor" data-live-search="true">
                    <option selected="selected" disabled="disabled">Select Supervisor</option>
                    <?php foreach($supervisor as $value) {?>
                      <option data-tokens="<?= $value['fullname']?>" value="<?= $value['userid']?>"><?= $value['fullname']?></option>
                    <?php }?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Select Labour</label>
            <div class="controls">
              <select class="selectpicker labour" id="labour_dropdown" name="labour" data-live-search="true">
                    <option selected="selected" disabled="disabled">Select Labour</option>
                    <?php foreach($labour as $value) {?>
                      <option data-tokens="<?= $value['fullname']?>" value="<?= $value['userid']?>"><?= $value['fullname']?></option>
                    <?php }?>
                  </select>
            </div>
        </div>
      

        <div class="control-group">
            <label for="inputError" class="control-label">Given Amount</label>
            <div class="controls">
              <input name="givenamount" type="text" class="givenamount form-control input-inline" value="<?php echo set_value('givenamount'); ?>" />
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
        <!-- <div class="control-group">
          <label for="inputError" class="control-label">Remaining Amount</label>
          <div class="controls">
            <input name="remainingamount" type="text" class="remainingamount form-control input-inline" value="<?= !empty($remainingamount)?$remainingamount:0?>" readonly />
          </div>
        </div> -->  
        <div class="control-group">
          <label for="inputError" class="control-label">Date</label>
          <div class="controls">
            <input name="datetime" type="text" class="datepicker1 datetime form-control input-inline" />
            <!--<span class="help-inline">Cost Price</span>-->
          </div>
        </div>         
        
        <div class="form-actions">
          <button class="btn btn-primary" type="submit">Save changes</button>
          <a href="<?=site_url("admin")?>/payment/listpayment" class="btn btn-danger">Back</a>
        </div>
        

      <?php echo form_close(); ?>

    </div>
     <script type="text/javascript">
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
     
    </script>