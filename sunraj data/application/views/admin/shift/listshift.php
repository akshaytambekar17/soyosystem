
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
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2))." Management";?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2))." Management";?> 
           <a  href="<?php echo site_url("admin")?>/supervisers/addshifttime" class="btn btn-success">Add Shift Time</a>
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
        <div class="span12 columns">
          

          <table class="table table-striped table-bordered table-condensed" id="listshifttime-table">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="yellow header headerSortDown">In-Time</th>
                <th class="yellow header headerSortDown">Out-Time</th>
                <th class="yellow header headerSortDown">Extended-Time</th>
                <th class="yellow header headerSortDown">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              foreach($manufacturers as $row)
              {
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row['fullname'].'</td>';
                echo '<td>'.$row['fromtime'].'</td>';
                echo '<td>'.$row['totime'].'</td>';
                echo '<td>'.$row['extendedtime'].'</td>';
                if($row['totime']!=$row['extendedtime'])
                {
                  if(empty($row['isapproved_shift'])){
                      echo '<td class="crud-actions">
                            <a href="'.site_url("admin").'/shift/listshift/updateshift/'.$row['shiftid'].'/approve" class="btn btn-info">Approve</a>  
                            <a href="'.site_url("admin").'/shift/listshift/updateshift/'.$row['shiftid'].'/reject" class="btn btn-danger">Reject</a>
                          </td>';  
                  }else{
                      echo '<td class="crud-actions">
                            <a href="'.site_url("admin").'/shift/listshift/deleteshift/'.$row['shiftid'].'" class="btn btn-danger">Delete</a>  
                          </td>';
                  }
                  
                }
                else
                {
                  echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/shift/listshift/deleteshift/'.$row['shiftid'].'" class="btn btn-danger">Delete</a>  
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
    <script type="text/javascript">
      $(document).ready(function(){
          $('#listshifttime-table').DataTable();
      });
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
    </script>