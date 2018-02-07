    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li class="active">
          <?php echo "Attendance";?>
        </li>
      </ul>
      <div id="result"></div>
      <div class="page-header users-header">
        <h2>
          <?php echo "Attendance";?> 
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            $options_manufacture = array(0 => "all");
            foreach ($manufactures as $row)
            {
              $options_manufacture[$row['userid']] = $row['fullname'];
            }
            //save the columns names in a array that we will use as filter         
            $options_products = array();    
            foreach ($products as $array) {
              foreach ($array as $key => $value) {
                $options_products[$key] = $key;
              }
              break;
            }

            echo form_open('admin/labours/listattendance/'.$this->uri->segment(4), $attributes);

            echo '<div class="row">';
            echo '<div class="col-md-1">';
            echo form_label('From:', 'from_string');
            echo "</div>";

            echo '<div class="col-md-2">';
      			echo form_input('from_string', $from_string_selected, 'class="datepicker1 form-control"','style="width: 100px;
      height: 26px;"');
            echo "</div>";
            echo '<div class="col-md-1">';
            echo form_label('To:', 'to_string');
            echo "</div>";
            echo '<div class="col-md-2">';
            echo form_input('to_string', $to_string_selected,'class="datepicker1 form-control"', 'style="width: 100px;
height: 26px;"');
            echo "</div>";
            echo '<div class="col-md-2">';
            echo form_label('Wage per Day:', 'wage');
            echo "</div>";

		          $attributes_wages=array(
												'name'=>'wage',
                        'id'=>'wage',
												'class' => 'form-control',
												'value'=>$labourdetails[0]['payment'],
												//'style'=>'width: 100px;height: 20px;'
											);
              echo '<div class="col-md-2">';
              echo form_input($attributes_wages);
              echo "</div>";
              echo '<div class="col-md-2">';
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-success', 'value' => 'Search','style'=>'margin: 0 30px;');
              echo "</div>";

              echo form_submit($data_submit);
              echo "</div>";
			         
			  
            

            echo form_close();
            ?>

          </div>
          <?php if($message = $this -> session -> flashdata('message')){?>
            <div class="col-md-12 pull-right">
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$message ?>
                </div>
            </div>
        <?php }?> 
          <input type="hidden" name="userid" id="userid" value="<?= !empty($products)?$products[0]['userid']:'';?>">
          <input type="hidden" name="spid" id="spid" value="<?= !empty($products)?$products[0]['spid']:'';?>">
          <h4> Present Days</h4>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Date</th>
                <th class="green header">In-Time</th>
                <th class="red header">Out-Time</th>
                <th class="red header">Location</th>
                <th class="red header">Day Status</th>
               
              </tr>
            </thead>
            <tbody>
              <?php
              $half_day=0;
              $full_day=0;
              $present=0;
		          $sumofday=0;

              //echo "<pre>";print_r($products);die;
              foreach($products as $row){
                  

                $dateDiff=intval((strtotime($row['outtime'])-strtotime($row['intime']))/60);
                $hours = intval($dateDiff/60);
                $min = intval($dateDiff%60);
                $referenceTimestamp = strtotime( $row['datetime'] );
                $fromTimestamp = strtotime($from_string_selected);
                $toTimestamp = strtotime( $to_string_selected );  
               /* $start = new DateTime($to_string_selected);
                $end = new DateTime($from_string_selected);
                $days = $start->diff($end, true)->days;

                $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

                echo $sundays;die();*/
                if($row['selfleave']==0){

                      if(!empty($fromTimestamp) && !empty($toTimestamp)){
                          
                          if(($referenceTimestamp >= $fromTimestamp) && ($referenceTimestamp <= $toTimestamp)){
                              $present++;
                              
                              echo '<tr>';
                              echo '<td>'.$row['attendaceid'].'</td>';
                              echo '<td>'.$row['datetime'].'</td>';
                              echo '<td>'.$row['intime'].'</td>';
                              echo '<td>'.$row['outtime'].'</td>';
                              echo '<td>'.$row['location'].'</td>';
            				          
                              if($hours>=4 && $min>0){  
                                  $full_day++;  
                                  echo '<td>Full Day</td>';
                              
                              }else if($hours>=5 && $min<=0){  
                                
                                  $full_day++;  
                                  echo '<td>Full Day</td>';
                              }
                              else{
                              
                                  $half_day++;
                                  echo '<td>Half Day</td>';
                                
                              }
                          }
                  		}else{
                        //$present++;
                        echo '<tr>';
                        echo '<td>'.$row['attendaceid'].'</td>';
                        echo '<td>'.$row['datetime'].'</td>';
                        echo '<td>'.$row['intime'].'</td>';
                        echo '<td>'.$row['outtime'].'</td>';
                        echo '<td>'.$row['location'].'</td>';
                      
                        if($hours>=4 && $min>0){  
                				    $full_day++;  
                            echo '<td>Full Day</td>';
                        }else if($hours>=5 && $min<=0){  
                				  
                            $full_day++;  
                            echo '<td>Full Day</td>';
                        }
                				else{
                            $half_day++;
                            echo '<td>Half Day</td>';
                        }
                    }              
                    echo '</tr>';
                  }
              }
          ?>      
            </tbody>
      </table>

      <h4> Leave Days</h4>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Date</th>
                <th class="green header">In-Time</th>
                <th class="red header">Out-Time</th>
                <th class="red header">Location</th>
                <th class="red header">Status</th>
               
              </tr>
            </thead>
            <tbody>
            <?php
              $leave=0;
              foreach($products as $row){
                  

                $dateDiff=intval((strtotime($row['outtime'])-strtotime($row['intime']))/60);
                $hours = intval($dateDiff/60);
                $min = intval($dateDiff%60);
                $referenceTimestamp = strtotime( $row['datetime'] );
                $fromTimestamp = strtotime($from_string_selected);
                $toTimestamp = strtotime( $to_string_selected );  
               /* $start = new DateTime($to_string_selected);
                $end = new DateTime($from_string_selected);
                $days = $start->diff($end, true)->days;

                $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

                echo $sundays;die();*/
                if($row['selfleave']==1){
                      $leave++;
                      if(!empty($fromTimestamp) && !empty($toTimestamp)){
                          
                          if(($referenceTimestamp >= $fromTimestamp) && ($referenceTimestamp <= $toTimestamp)){
                              $present++;
                              
                              echo '<tr>';
                              echo '<td>'.$row['attendaceid'].'</td>';
                              echo '<td>'.$row['datetime'].'</td>';
                              echo '<td>'.$row['intime'].'</td>';
                              echo '<td>'.$row['outtime'].'</td>';
                              echo '<td>'.$row['location'].'</td>';
                              echo "<td>Self Leave</td>";      
                          }
                      }else{
                        //$present++;
                        echo '<tr>';
                        echo '<td>'.$row['attendaceid'].'</td>';
                        echo '<td>'.$row['datetime'].'</td>';
                        echo '<td>'.$row['intime'].'</td>';
                        echo '<td>'.$row['outtime'].'</td>';
                        echo '<td>'.$row['location'].'</td>';
                        echo "<td>Self Leave </td>";
                        
                    }              
                    echo '</tr>';
                  }
              }
            
                     // print_r($full_day." ".$half_day);exit;
          ?>      
                    </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; 
  
				if(isset($_POST['mysubmit'])){


					$date1=date_create($from_string_selected);
					$date2=date_create($to_string_selected);
					$diff=date_diff($date1,$date2);
					$totalday=$diff->format("%a ");
          $totalday=$totalday+1;	
          				//$totalday=$diff->format("%R%a ");
					$start = new DateTime($from_string_selected);
          $end = new DateTime($to_string_selected);
          $days = $start->diff($end, true)->days;
          $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

          
		 ?>
      <div class="well">
        <div class="row">
            <div class="col-md-3" style="width: 19%">
              <label >Given Advance Payment</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="advancepay"  id="advancepay" class="form-control col-md-3" value="<?php echo !empty($advancepay)?$advancepay:0?>" readonly>
            </div>
            <div class="col-md-3">
              <label>Extra Deduction</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="deduction"  id="deduction" class="form-control" value="0">
            </div>
        </div>
        <div class="row">
               <div class="col-md-3" style="width: 19%">
                  <label >Wages Advance Payment</label>
                </div>
                <div class="col-md-3">
                  <input type="text" name="wagesadvancepay"  id="wagesadvancepay" class="form-control col-md-3" value="0">
                </div>
              <div class="col-md-3" style="width: 25%" >
                  <label >Remaining Advance Payment</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="remainingamount"  id="remainingamount" class="form-control col-md-3" value="<?php echo !empty($remainingamount)?$remainingamount:0?>" readonly>
              </div>
           
        </div>
      </div>
        <br>
        
				<table class="table  table-bordered table-condensed"> 
				  <thead>
							  <tr>
								<th class="header">Day Status</th>
								<th class="yellow header headerSortDown">Days Count</th>
								<th class="yellow header headerSortDown">Sub-Total</th>
								</tr>
				  </thead>
				  <tbody>
							 <?php
							 
									echo '<tr>';
					 				echo '<th>Full Days</th>';
									echo '<td>'.$full_day.'</td>';
									echo '<td>'.$full_day*($_POST['wage']).'/-</td>';
									echo '</tr>';
									echo '<tr>';
									echo '<th>Half Days</th>';
									echo '<td>'.$half_day.'</td>';
									echo '<td>'.$half_day*($_POST['wage']/2).'/-</td>';
									echo '</tr>';
									echo '<tr>';
									if($leaveday==1){
										//$leave_day=$totalday-$present;
										echo '<th>Leave Days</th>';
										echo '<td>'.$leave.'</td>';
										echo '<td>0</td>';
										echo '</tr>';
										echo '<tr>';
									}
                  if($labourdetails[0]['category']=="driver"){
                      echo '<tr>';
                      echo '<th>Total Sundays</th>';
                      echo '<td>'.$sundays.'</td>';
                      echo '<td>'.$sundays*($_POST['wage']).'/-</td>';
                     echo '</tr>';
                  }else{
                      $sundays=0;
                  } 
                   
                    $totalsalary=$full_day*($_POST['wage'])+$half_day*($_POST['wage']/2)+$sundays*($_POST['wage']);
                    echo '<tr>';
                    echo '<th colspan="2">Total</th>';
                    echo '<td>'.$totalsalary.' /-</td>';
                    echo '</tr>';
								
								
							 ?>
               <input type="hidden" name="salary" id="salary" value="<?=$totalsalary?>">
               </tbody>
			</table>
        <div class="row">
            <div class="col-md-2">
              <label>Total Salary</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="totalsalary" id="totalsalary" class="form-control" value="<?php echo !empty($totalsalary)?$totalsalary:''?>" readonly>
            </div>
            
            
        </div>
        <div class="row">
            <button class="btn btn-success" id="save" style="margin-left: 20px;" > Save</button>
        </div>
			<?php }?>
      </div>
    </div>
<script type="text/javascript">
  $(document).ready(function () {
      var remainingamount_recent=$("#remainingamount").val();
      var advancepay=$("#advancepay").val();
      if(advancepay<=0){
        
          $("#wagesadvancepay").prop("disabled","true");
      }else{
          $("#wagesadvancepay").removeAttr("disabled");    
      }
      $('#wagesadvancepay').on('keyup keypress blur focus',function(){
          var advancepay=$("#advancepay").val();
          var wagesadvancepay=$("#wagesadvancepay").val();
          var remainingamount=parseInt(advancepay)-parseInt(wagesadvancepay);
          if(remainingamount==''){
              $("#remainingamount").val(parseInt(remainingamount_recent));
          }else{
              $("#remainingamount").val(parseInt(remainingamount));
          }


      });
      $('#deduction,#wagesadvancepay').on('keyup keypress blur focus',function(){
         // var advancepay=$("#advancepay").val();
          var deduction=$("#deduction").val();
          var wagesadvancepay=$("#wagesadvancepay").val();
          var remainingamount=$("#remainingamount").val();
          var salary=$("#salary").val();
          //alert(advancepay);
          var totalsalary=parseInt(salary)-parseInt(deduction)-parseInt(wagesadvancepay);

          $("#totalsalary").val(totalsalary);
      });
        


      $('#save').click(function () {
          var userid=$("#userid").val();
          var spid=$("#spid").val();
          var totalsalary=$("#totalsalary").val();
          var advancepay=$("#advancepay").val();
          var wagesadvancepay=$("#wagesadvancepay").val();
          var remainingamount=$("#remainingamount").val();
          var deduction=$("#deduction").val();
          var wage=$("#wage").val();
          if(totalsalary<=0){
              $('html, body').animate({scrollTop:0}, 1000); 
              $("#result").html('<div class="alert alert-success"><button type="button" class="close">×</button>Please add wages</div>');
              $(".alert").delay(5000).slideUp(200, function() {
                        $(this).alert('close');
              });

          }else{
              $.ajax({
                url: "<?php echo base_url();?>admin/labours/addsalary",
                type: "POST",
                data: {'userid':userid,'spid':spid,'totalsalary':totalsalary,'advancepay':advancepay,'wagesadvancepay':wagesadvancepay,'remainingamount':remainingamount,'deduction':deduction},
                success: function(data) {
                    $('html, body').animate({scrollTop:0}, 1000); 
                    if(data==1){

                      $("#result").html('<div class="alert alert-success"><button type="button" class="close">×</button>Successfully Added</div>');
                    }else{
                      $("#result").html('<div class="alert alert-success"><button type="button" class="close">×</button>Successfully Updated</div>');
                    }
                    $(".alert").delay(5000).slideUp(200, function() {
                        $(this).alert('close');
                    });
                  
                }
              });
          }
          
      });
  });
</script>

