~<!DOCTYPE html>
<html lang="en">
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>			
</head>

<body>

        <div class="container-fluid">
            <div class="row">
                <div class="right-column">
                    <main class="main-content p-5" role="main">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                            Projects List
                                    </div>
                                    <div class="card-body">
                                        <?php if($message = $this ->session->flashdata('Message')){?>
                                            <div class="col-md-12 ">
                                                <div class="alert alert-dismissible alert-success">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <?=$message ?>
                                                </div>
                                            </div>
                                        <?php }?> 
                                        <?php if($message = $this ->session->flashdata('Error')){?>
                                            <div class="col-md-12 ">
                                                <div class="alert alert-dismissible alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <?=$message ?>
                                                </div>
                                            </div>
                                        <?php }?> 
                                        <ul class="list-unstyled mt-5">
                                        <?php
                                            foreach($projects as $row){
                                        ?>
                                            <li class="media">
                                                    
                                                <div class="col-md-6">
                                                    <div class="media-body">
                                                        <div class="media-title mt-0 mb-1">
<!--                                                            <h4>Project Name</h4>-->
                                                            <a href="<?php echo base_url();?>Distributer_Manufracture/edit_project_view?id=<?php echo $row->id?>"><?php echo $row->name;?></a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="<?php echo base_url();?>Distributer_Manufracture/edit_project_view?id=<?php echo $row->id?>" class="btn btn-default btn-sm waves-effect waves-light"><b>Edit Project</b></a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="<?php echo base_url();?>Distributer_Manufracture/delete_project?id=<?php echo $row->id?>" class="btn btn-sm btn-danger waves-effect waves-light">Delete Project</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </main>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function() {
            $(".alert").delay(5000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
    </script>

</body>
</html>