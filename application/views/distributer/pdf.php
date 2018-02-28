<!DOCTYPE html>
<html lang="en">  
    <head>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/batch-icons/css/batch-icons.css">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.min.css">
        <!-- Material Design Bootstrap -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery-3.1.1.min.js"></script>
        <!-- Popper.js - Bootstrap tooltips -->
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
    </head>
    <body>
     
        <div class="table-responsive">
            <table id="datatable-1" class="table table-datatable table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th><b>User Name</b></th>
                        <th><b>Aadhar number</b></th>
                        <th><b>Device Type</b></th>
                        <th><b>Device Imei</b></th>
                        <th><b>Installation Date</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($user_details as $row){
                    ?>                  
                        <tr>
                            <td>
                                <?php

                                    $username=$this->User_model->get_user_by_id($row->user_id);
                                    echo $username[0]->fname." ". $username[0]->lname;
                                    //echo $row['user_id'];
                                ?>
                            </td>
                            <td>
                                <?php echo $row->adhar; ?>
                            </td>
                            <td>
                                <?php
                                    $device_type=$this->Admin_model->get_device_by_id($row->project);
                                    echo $device_type[0]->device_name;
                                ?>
                            </td>
                            <td>
                                <?php echo $row->imei_no; ?>
                            </td>
                            <td>
                                <?php echo $row->installation_date; ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>        
        </div> 
    </body>
</html>