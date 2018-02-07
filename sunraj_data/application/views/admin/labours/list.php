    <div class="container top">
      <div class="row"> 
            <div class="col-md-12">
              
                <h2 style="font-family:georgia san-serif; text-align: center;">Sunraj Admin Panel</h2>
            </div>
              
        </div>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <!-- <span class="divider">/</span> -->
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-info">Add New</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            
                echo form_open('admin/labours', $attributes);

            ?>
     
                  <div class="row">
                      
                      <div class="col-md-3">
                            <select class="selectpicker labour pull-left" id="supervisor_dropdown" name="supervisor" data-live-search="true">
                                <option selected="selected" disabled="disabled">Select Supervisor</option>
                                <?php foreach($manufactures as $value) {?>
                                  <option data-tokens="<?= $value['fullname']?>" value="<?= $value['userid']?>" <?php echo set_select('supervisor',$value['userid']); ?>><?= $value['fullname']?></option>
                                <?php }?>
                            </select>
                      </div>
                      <div class="col-md-3">
                        <select class="selectpicker" id="category" name="category" data-live-search="true">
                            <option selected="selected" disabled="disabled">Select Category</option>
                            <option data-tokens="Labour" value="labour" <?php echo  set_select('category', 'labour'); ?> >Labour</option>
                            <option data-tokens="Driver" value="driver" <?php echo  set_select('category', 'driver'); ?>>Driver</option>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <select class="selectpicker" id="status" name="status" data-live-search="true">
                            <option selected="selected" disabled="disabled">Select Status</option>
                            <option data-tokens="Approved" value="approve" <?php echo set_select('status','approve')?>>Approved</option>
                            <option data-tokens="Rejected" value="reject" <?php echo set_select('status','reject')?>>Rejected</option>
                        </select>
                      </div>
                        
                      
                      
                  </div>  
          
                <br>
                <div class="row">
                  <div class="col-md-1">  
                          <button class="btn btn-success" type="submit">Search</button>
                      </div>
                  <div class="col-md-3">  
                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal" id="export_modal">Export</button>
                  </div>  
                </div>
            <?php echo form_close(); ?>
          </div>
          <?php if($message = $this -> session -> flashdata('message')){?>
            <div class="col-md-12 pull-right">
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$message ?>
                </div>
            </div>
        <?php }?> 
          <table class="table table-striped table-bordered table-condensed" id="listlabour-table">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Full Name</th>
                <th class="green header">Address</th>
                <th class="red header">Mobile No.</th>
                <th class="red header">Email-Id</th>
                <th class="red header">Category</th>
                <th class="red header">Payment</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              foreach($products as $row)
              {
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                if($row['status']==2 || $row['isdeleted']==1){
                    echo '<td><a href="javascript:void(0)" class="btn btn-info">'.$row['fullname'].'</a></td>';
                }else{

                  echo '<td><a href="'.site_url("admin").'/labours/listattendance/'.$row['userid'].'" class="btn btn-info">'.$row['fullname'].'</a></td>';
                }
                echo '<td>'.$row['address'].'</td>';
                echo '<td>'.$row['mobno'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['category'].'</td>';
                echo '<td>'.$row['payment'].'</td>';
                
                if($row['status']==0 && $row['isdeleted']==0 && $row['pending']==0){
                   echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/labours/updatestatus/'.$row['userid'].'/approve" class="btn btn-info">Approve</a>  
                  <a href="'.site_url("admin").'/labours/updatestatus/'.$row['userid'].'/reject" class="btn btn-danger">Reject</a>
                </td>';
                  
                }else if($row['status']==1 && $row['isdeleted']==0 && $row['pending']==0) 
                {
                  echo '<td class="crud-actions">';
                  echo '<a href="'.site_url("admin").'/labours/update/'.$row['userid'].'" class="btn btn-info">View & Edit</a>  
                  <a href="'.site_url("admin").'/labours/delete/'.$row['userid'].'" class="btn btn-danger">Delete</a></td>';
                }elseif ($row['status']==0 && $row['isdeleted']==0 && $row['pending']==1) {
                    echo '<td class="crud-actions">';

                    echo '<a href="'.site_url("admin").'/labours/update/'.$row['userid'].'" class="btn btn-info">View & Edit</a>  
                    <a href="'.site_url("admin").'/labours/delete/'.$row['userid'].'" class="btn btn-danger">Delete</a>  ';
                    echo '<a href="javascript:void(0)" class="btn btn-warning">Pending</a></td>';
                }else if($row['status']==2){
                    echo '<td class="crud-actions">';
                    echo '<a href="'.site_url("admin").'/labours/delete/'.$row['userid'].'" class="btn btn-danger">Delete</a>
                      <a href="javascript:void(0)" class="btn btn-warning">Rejected</a>
                    </td>';

                }else{
                    echo '<td class="crud-actions">';
                    echo '<a href="'.site_url("admin").'/labours/delete/'.$row['userid'].'" class="btn btn-danger">Delete</a>
                    </td>';
                }
                echo '</tr>';
                $i++;
              }
              ?>      
            </tbody>
          </table>

      

      </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Download Export</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class=" col-md-6">
                    <div class="control-group">
                      <label for="inputError" class="control-label">From Date</label>
                      <div class="col-md-12">
                        <input type="text" id="from_date" name="from_date" class="datepicker1 form-control" value="<?php echo set_value('from_date'); ?>">
                        <!--<span class="help-inline">Cost Price</span>-->
                      </div>
                    </div>   
                  </div>
                  <div class="col-md-6">
                    <div class="control-group">
                      <label for="inputError" class="control-label">To Date</label>
                      <div class="col-md-12">
                        <input type="text" name="to_date" class="datepicker1 form-control" id="to_date" value="<?php echo set_value('to_date'); ?>">
                        <!--<span class="help-inline">Cost Price</span>-->
                      </div>
                    </div>   
                  </div>
                </div>

            </div>

            <div class="modal-footer">
              
                    <button class="btn btn-primary" type="button" id="export">Download</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
          </div>
          
        </div>
      </div>
    <style type="text/css">
      
      .modal{
          overflow: hidden;
          box-shadow: none !important;
          border: none !important;
          width: 730px;
          left: 663px !important;
          background-color: transparent !important;
      }
    </style>
    <script type="text/javascript">
      $(document).ready(function(){
          $('#listlabour-table').DataTable();
          $('#export').click(function(){
              var to_date= $("#to_date").val();
              var from_date= $("#from_date").val();
              if(to_date ==''){
                alert("Please enter To Date");
              }else if(from_date ==''){
                 alert("Please enter From Date"); 
              }else{
                  window.location= '<?php echo base_url(); ?>admin/export?from_date='+from_date+'&to_date='+to_date;  
              }
              //var status= $("#status").val();
              /*$.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>" + "admin/export",
                  data: { 'supervisor' : supervisor,'status' : status,'category' : category },
                  dataType: 'html',
                  success: function(data){
                    
                    console.log(data);
                  
                  }
              });*/
              
          });
      });
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
    </script>