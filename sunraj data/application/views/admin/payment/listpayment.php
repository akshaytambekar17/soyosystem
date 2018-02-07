<?php  //echo "<pre>"; print_r($supervisor);die();  ?>

  
  <script type="text/javascript">
       $(document).ready(function() {
        
         
     /* $("#supervisor").change(function(){
              
              var supid = $("#supervisor").val();
              $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>admin/payment/supervisorajax",
                        data: { 'supid' : supid },
                        dataType: 'html',
                        success: function(data){
                          var obj = $.parseJSON(data);
                          console.log(obj);
                          $("#labour_dropdown").html('<option selected="selected" disabled="disabled">Select Labour</option>');
                          $("#labour_dropdown").append(obj);
                        

                        }
                  });
          });*/
      });
  </script>
  
  	<br><br><br><br>
    	<div class="col-md-12">
    		<div class="col-md-4"></div>
    		<div class="col-md-5"><h2 style="font-family:georgia san-serif;">Sunraj Admin Panel</h2></div>
    		<div class="col-md-3"></div>
    	</div>
    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2))." Management";?>
        </li>
      </ul>
      <?php if($message = $this -> session -> flashdata('message')){?>
            <div class="col-md-12 pull-right">
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$message ?>
                </div>
            </div>
      <?php }?> 
      <div class="page-header users-header">
          <h2>
              <?php echo ucfirst($this->uri->segment(2));?> 
          </h2>
      </div>
      <div class="well">
          <div class="row">
              <div class="columns col-md-10">
                  <?php

                      $attributes = array('class' => 'form-horizontal', 'id' => '','name'=>'listpayment-form');
                      //form validation
                      echo validation_errors();
                      echo form_open('admin/payment/listpayment', $attributes);
                  ?>
                  <div class="row">
                      
                      <div class="col-md-6">
                            <select class="selectpicker labour pull-left" id="labour_dropdown" name="labour" data-live-search="true">
                                <option selected="selected" disabled="disabled">Select Labour</option>
                                <?php foreach($labour as $value) {?>
                                  <option data-tokens="<?= $value['fullname']?>" value="<?= $value['userid']?>"><?= $value['fullname']?></option>
                                <?php }?>
                            </select>
                      </div>
                        
                      <div class="col-md-3">  
                          <button class="btn btn-success" type="submit">Search</button>
                      </div>

                  </div>
                 <?php echo form_close(); ?>  
              </div>
              <div class="col-md-2">
                  <a href="<?php echo site_url("admin")?>/payment/addpayment" class="btn btn-info pull-right">Add Payment</a>
              </div>
          </div>  
      </div>
      <div class="row">
          <div class="col-md-12">
              <ul class="nav nav-pills">
                  <li class="active"><a data-toggle="pill" href="#advancepay">Advance Pay</a></li>
                  <li><a data-toggle="pill" href="#salary">Salary Pay</a></li>
              </ul> 
              <div class="tab-content">
                  <div id="advancepay" class="tab-pane fade in active">  
                      <table class="table table-hover table-bordered" id="listpaymenttable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Labour Name</th>
                              <th>Given Amount</th>
                              <th>Remainig Amount</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $i=1;foreach($listpayment as $value){ ?>
                                <tr>
                                    <td><?= $i?></td>
                                    <td><?= $value['fullname']?></td>
                                    <td><?= $value['givenamount']?></td>
                                    <td><?= $value['remainingamount']?></td>
                                    <td><?= $value['datetime']?></td>
                                </tr>
                              <?php $i++; } ?>
                          </tbody>
                      </table>
                  </div>
                  <div id="salary" class="tab-pane fade">  
                      <table class="table table-hover table-bordered" id="listsalarytable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Labour Name</th>
                              <th>Salary Amount</th>
                              <th>Advance pay Amount</th>
                              <th>Remaining advance Amount</th>
                              <th>Deduction Amount</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $i=1;foreach($listsalary as $value){ ?>
                                <tr>
                                    <td><?= $i?></td>
                                    <td><?= $value['fullname']?></td>
                                    <td><?= $value['salamt']?></td>
                                    <td><?= $value['advancepay']?></td>
                                    <td><?= $value['remainimgadv']?></td>
                                    <td><?= $value['deduction']?></td>
                                    <td><?= $value['datetime']?></td>
                                </tr>
                              <?php $i++; } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

     
    </div>  
   
    <script type="text/javascript">
      //$('.selectpicker').selectpicker();
      $(document).ready(function(){
          $('#listpaymenttable').DataTable();
          $('#listsalarytable').DataTable();
      });
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
      
      
    </script>