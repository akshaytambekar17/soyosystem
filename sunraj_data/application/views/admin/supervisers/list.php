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
            <?php echo ucfirst($this->uri->segment(2));?>
          </li>
        </ul>

        <div class="page-header users-header">
            <h2>
                <?php echo ucfirst($this->uri->segment(2));?> 
                <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-info">Add New</a>
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
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            
            echo form_open('admin/supervisers', $attributes);
            ?>
              <div class="row">
                  
                  <div class="col-md-3">
                    <select class="selectpicker" id="status" name="status" data-live-search="true">
                        <option selected="selected" disabled="disabled">Select Status</option>
                        <option data-tokens="Approved" value="approve" <?php echo set_select('status','approve')?>>Approved</option>
                        <option data-tokens="Rejected" value="reject" <?php echo set_select('status','reject')?>>Rejected</option>
                    </select>
                  </div>
                    
                  <div class="col-md-3">  
                      <button class="btn btn-success" type="submit">Search</button>
                  </div>

              </div> 
             
           <?php echo form_close(); ?>

          </div>
        
          <table class="table table-striped table-bordered table-condensed" id="listsupervisor-table">
              <thead>
                <tr>
                  <th class="header">#</th>
                  <th class="yellow header headerSortDown">Name</th>
                  <th class="yellow header headerSortDown">Mobile No</th>
                  <th class="yellow header headerSortDown">Username</th>
                  <th class="yellow header headerSortDown">Password</th>
                  <th class="yellow header headerSortDown" style="width: 27%;">Actions</th>
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
                        echo '<td>'.$row['mobno'].'</td>';
                        echo '<td>'.$row['username'].'</td>';
                        echo '<td>'.$row['password'].'</td>';

                        echo '<td class="crud-actions">';
                        echo '<a href="'.site_url("admin").'/supervisers/update/'.$row['userid'].'" class="btn btn-info">view & edit</a>';  
                        echo ' <a href="'.site_url("admin").'/supervisers/delete/'.$row['userid'].'" class="btn btn-danger">delete</a> ';
                        if($row['status']==0){
                            echo ' <a href="javascript:void(0)" class="btn btn-warning">Pending</a> ';
                        }else if($row['status']==1){    
                            echo ' <a href="javascript:void(0)" class="btn btn-success">Approved</a>'; 
                        }else{
                            echo ' <a href="javascript:void(0)" class="btn btn-primary">Rejected</a>' ;
                        }
                            
                        echo '</td>';
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
          $('#listsupervisor-table').DataTable();
      });
      $(".alert").delay(4000).slideUp(200, function() {
          $(this).alert('close');
      });
    </script>