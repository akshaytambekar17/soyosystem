<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-waitingfor/1.2.4/bootstrap-waitingfor.js"></script> -->
<!-- <meta http-equiv="refresh" content="5" /> -->
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
          <?php echo ucfirst("Notifications");?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst("Notifications");?> 
          
           <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#hoildaynotifcation_modal" id="">Hoilday Notification</button>
        </h2>
    
      <?php if($message = $this -> session -> flashdata('message')){?>
            <div class="col-md-12">
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$message ?>
                </div>
            </div>
      <?php }?> 
      <div class="row">
        <div class="span12 columns">
          <table class="table table-striped table-bordered table-condensed" id="listnotification-table">
            <thead>
                <tr>
                  <th class="header">#</th>
                  <th class="yellow header headerSortDown">Message</th>
                  <th class="yellow header headerSortDown">Date</th>
                  <th class="yellow header headerSortDown">Sender</th>
        				 <th class="yellow header headerSortDown">Status</th>
        				 <th class="yellow header headerSortDown">Type</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;
              foreach($manufacturers as $row)
              {

                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row['message'].'</td>';
                echo '<td>'.$row['datetime'].'</td>';
                echo '<td>'.$row['fullname'].'</td>';
				
				
          				if($row['isread']==0)
          				{
          					 echo '<td class="crud-actions">  
                              <a href="'.site_url("admin").'/notification/updatestatus/'.$row['notid'].'/approve" class="btn btn-info">Approve</a>  
                            <a href="'.site_url("admin").'/notification/updatestatus/'.$row['notid'].'/reject" class="btn btn-danger">Reject</a>
                          </td>';
          				}
          				else
          				{
          					 echo '<td class="crud-actions">  
          					  <a href="'.site_url("admin").'/notification/deletenotification/'.$row['notid'].'" class="btn btn-danger">Delete</a>
          					</td>';
          				}
          					 
          			
          				if($row['type']==0)
          				{
          					 echo '<td class="btn btn-primary">Labour Confirmation</td>';
          				}
          				else if($row['type']==1)
          				{
          					 echo '<td class="btn btn-warning">shift management</td>';
          				}
          				else if($row['type']==2)
          				{
          					 echo '<td class="btn btn-info">leave confirmation</td>';
          				}
          				else if($row['type']==3)
                  {
                     echo '<td class="btn btn-danger">Delete Labour confirmation</td>';
                  }
                  else if($row['type']==4)
                  {
                     echo '<td class="btn btn-primary">Supervisor Confirmation</td>';
                  }
                  else if($row['type']==5)
                  {
                     echo '<td class="btn btn-success">Advance Amount</td>';
                  }
                      
                      echo '</tr>';
                      $i++;
              }
              ?>      
            </tbody>

      </div>
    </div>
  </div>
    <div class="modal fade custom-modal" id="hoildaynotifcation_modal" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Holiday Notification</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class=" col-md-6">
                    <div class="control-group">
                      <label for="inputError" class="control-label">Message</label>
                      <div class="col-md-12">
                        <input type="text" id="text_notification" name="text_notification" class="form-control">
                        <!--<span class="help-inline">Cost Price</span>-->
                      </div>
                    </div>   
                  </div>
                  
                 
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center loader">
                      <img src="http://sunraj7.aspirevisions.com/myapp/assets/img/loader2.gif" width="100" alt="">
                        <p>Please Wait....</p>
                    </div>
                    <div class="col-xs-12 msg-success">
                      
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="sent">Send</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
          </div>
          
        </div>
      </div>
    
    <style type="text/css">
      
      .custom-modal{
          overflow: hidden;
          box-shadow: none !important;
          border: none !important;
          width: 730px;
          left: 663px !important;
          background-color: transparent !important;
      }
    
        .custom-p{
          color: green;
        }
    </style>
    <script type="text/javascript">
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
      $(document).ready(function(){
          $('#listnotification-table').DataTable();
          setInterval( function () {

              $('#listnotification-table').ajax.reload();
            }, 3000 );
           $(".loader").hide();
           $(".msg-success").hide();

          $('#sent').click(function(){
              var text_notification= $("#text_notification").val();
              if(text_notification ==''){
                alert("Please enter Message");
              }else{
                $(".loader").show();
                $("#sent").prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "admin/hoildaynotification",
                    data: { 'text_notification' : text_notification },
                    dataType: 'html',
                    success: function(data){
                        console.log(data);
                        $(".loader").hide();
                        $("#sent").prop('disabled', false);
                        $(".msg-success").show();                       
                        $(".msg-success").append('<p class="custom-p"> Notification Send Succssfully....!</p>')
                        
                    
                    }
                });
                  
              }
              
              
          });
         
      });
    </script>