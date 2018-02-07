<?php
class Admin_manufacturers extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/supervisers';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('manufacturers_model');
        $this->load->model('products_model');
        $this->load->library('notifications');
        $this->load->library('firebase');
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $status=$this->input->post('status');
            $data['manufacturers'] = $this->manufacturers_model->get_manufacturers('',$status,'','','','');        
        }else{
            $data['manufacturers'] = $this->manufacturers_model->get_manufacturers();        
        }
       
        //load the view
        $data['main_content'] = 'admin/supervisers/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('fullname', 'Fullname', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('mobno', 'Mobile number', 'required|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('uname', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'mobno' => $this->input->post('mobno'),
                    'email' => $this->input->post('email'), 
                    'username' => $this->input->post('uname'),
                    'password' => $this->input->post('password'),         
                    'supid' => 0,
                    'role' => 2
                );
                //if the insert has returned true then we show the flash message
                if($this->manufacturers_model->store_manufacture($data_to_store)){
                    // $name=$this->input->post('fullname');
                    // $regid=$supervisers[0]['regid'];
                    // $message = "Hello ".$name." you have been added to our supervisor list";
                    // $notify_data=array('regid'=>$regid,
                    //                     'message' =>$message        
                    //                 );
                    // $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
                    // $success=json_decode($not_data);
                    // if(!empty($success->success)){
                    //     $this -> session -> set_flashdata('message','Labour information add  sucessfully and notification send successfully'); 
                    // }else{
                    //     $data_error=$success->results;
                    //     $this -> session -> set_flashdata('message','Labour information add  sucessfully but notification cannot send something went to wrong'); 
                    // }
                    $this -> session -> set_flashdata('message','Supervisor information add  sucessfully'); 
                    redirect('admin/supervisers/','refresh');   
					
                }else{
                    $this -> session -> set_flashdata('message','Supervisor information cannot add  sucessfully something went wrong'); 
                    redirect('admin/supervisers/','refresh');   
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/supervisers/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('fullname', 'fullname', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('mobno', 'mobno', 'required|numeric');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()){
    
                $data_to_store = array(
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'mobno' => $this->input->post('mobno'),
                    'email' => $this->input->post('email'),  
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                );
                //if the insert has returned true then we show the flash message
                if($this->manufacturers_model->update_manufacture($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('message','Supervisor information updated successfully..!');
                }else{
                    $this->session->set_flashdata('message', 'Supervisor information cannot updated something went');
                }
                redirect('admin/supervisers/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['manufacture'] = $this->manufacturers_model->get_manufacture_by_id($id);
        //load the view
        $data['main_content'] = 'admin/supervisers/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->manufacturers_model->delete_manufacture($id);
        $this -> session -> set_flashdata('message','Supervisor Data Deleted Sucessfully....!'); 
        redirect('admin/supervisers');
    }//edit




      public function addshifttime()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
 
            //form validation
            $this->form_validation->set_rules('supid', 'supid', 'required');
            $this->form_validation->set_rules('intime', 'intime', 'required');
            $this->form_validation->set_rules('outtime', 'outtime', 'required');
           

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
               
                $data_to_store = array(
                    'fromtime' => $this->input->post('intime'),
                    'totime' => $this->input->post('outtime'),
                    'extendedtime' => $this->input->post('outtime'),
                    'spid' => $this->input->post('supid'),
                    'date' => date('Y-m-d'),
                );
                $fromtime=$this->input->post('intime');
                $totime=$this->input->post('outtime');
                //if the insert has returned true then we show the flash message
                $result=$this->manufacturers_model->addshifttime($data_to_store);
                if($result){
                    if($result==1){

                        $supervisers=$this->manufacturers_model->get_manufacture_by_id($this->input->post('supid'));
                        $name=$supervisers[0]['fullname'];
                        $regid=$supervisers[0]['regid'];
                        $message = "Hello ".$name." your shift time is ".$fromtime." to ".$totime;
                        $notify_data=array('regid'=>$regid,
                                            'message' =>$message        
                                        );
                        $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
                        $success=json_decode($not_data);
                        if(!empty($success->success)){
                            $this -> session -> set_flashdata('message','Shift Timing  add successfully notification send successfully'); 
                        }else{
                            $data_error=$success->results;
                            $this -> session -> set_flashdata('message','Shift Timing add successfully but notification cannot send something went to wrong'); 
                        }
                        redirect('admin/shift/listshift','refresh');   
                    }else{
                        $supervisers=$this->manufacturers_model->get_manufacture_by_id($this->input->post('supid'));
                        $name=$supervisers[0]['fullname'];
                        $this -> session -> set_flashdata('message',"Shift time of supervisor ".$name." is already added"); 
                        redirect('admin/shift/listshift','refresh');   
                    }
                    
                }else{
                    $this -> session -> set_flashdata('message','Somethinng wrong  please insert data properly..!'); 
                    $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
                    $data['main_content'] = 'admin/supervisers/addshifttime';
                    $this->load->view('includes/template', $data);   
                }

            }
        }
        //load the view
        //fetch manufacturers data into arrays
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        $data['main_content'] = 'admin/supervisers/addshifttime';
        $this->load->view('includes/template', $data);  
    }       

 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function listnotification()
    {
                          
       
         
        //initializate the panination helper 
       	$data['count_notification']= $this->manufacturers_model->count_notification();

        $data['manufacturers'] = $this->manufacturers_model->get_notification();
                
        //load the view
        $data['main_content'] = 'admin/notification/listnotification';
        $this->load->view('includes/template', $data);  

    }//listnotification

    public function deletenotification()
    {
        //product id 
         
        $id = $this->uri->segment(4);
       //print_r($id);exit();
        $this->manufacturers_model->delete_notification($id);
        redirect('admin/notification/listnotification');
    }//deletenotification
	
	
	 // public function approvenotification()
    // {
        // //product id 
         
        // $id = $this->uri->segment(4);
       // //print_r($id);exit();
        // $this->manufacturers_model->approve_notification($id);
        // redirect('admin/notification/listnotification');
    // }//approvenotification

	
	public function updatestatus()
    {
        //notification id 
        $id = $this->uri->segment(4);
        //status id 
        $status = $this->uri->segment(5);
        if($status=='approve'){
            $stat_msg="Approved";
        }else{
            $stat_msg="Rejected";
        }
        $result=$this->manufacturers_model->get_notification_id($id);
        
        $form_data=array('notid'=>$id,
                         'userid'=>$result[0]['senderid'], 
                         'status'=>$status,
                         'type'=>$result[0]['type'],
                    );

        if(($details=$this->manufacturers_model->approve_status($form_data)) == TRUE){
            $name=$details[0]['fullname'];
            $regid=$details[0]['regid'];
            if($result[0]['type']==1){
               $message = "Hello ".$name.", your shift time has been  ".$stat_msg;
            }else if($result[0]['type']==0){
                $message = "Hello ".$name.", labour confirmation has been  ".$stat_msg;
            }else if($result[0]['type']==2) {
                $message = "Hello ".$name.", leave confirmation has been  ".$stat_msg;
            }else if($result[0]['type']==4){
                $message = "Hello ".$name.", supervisor confirmation has been  ".$stat_msg;
            }else if($result[0]['type']==3){
                $message = "Hello ".$name.", labour delete confirmation has been  ".$stat_msg;
            }else{
                $message = "Add avance have only to admin portal notification it cannot send any notification to mobile device";
            }


            if($status=='reject' && $result[0]['type']==4){
                $this -> session -> set_flashdata('message',' Supervisor is Rejected cannot add'); 
            }else if($result[0]['type']==5){
                $this -> session -> set_flashdata('message','Add advanced have only to admin portal notification it cannot send any notification to mobile device'); 
            }else{

                $notify_data=array('regid'=>$regid, 
                                  'message' =>$message        
                                );

                $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
                $success=json_decode($not_data);
                
                if(!empty($success->success)){
                    $this -> session -> set_flashdata('message',$stat_msg.' notification send successfully'); 
                }else{
                    $data_error=$success->results;
                    $this -> session -> set_flashdata('message',$stat_msg.' notification cannot send something went to wrong error is '.$data_error[0]->error); 
                }
            }
            
        }else{
            $this -> session -> set_flashdata('message','Information cannot save something goes to worng'); 
        }
        redirect('admin/notification/listnotification');

        

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        // //product data 
        // $data['product'] = $this->products_model->get_product_by_id($id);
        // //fetch manufactures data to populate the select field
        // $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        // //load the view
        // $data['main_content'] = 'admin/labours';
        // $this->load->view('includes/template', $data);            

    }//update



    public function listshift()
    {
        $data['manufacturers'] = $this->manufacturers_model->get_shifts();        
        $data['main_content'] = 'admin/shift/listshift';
        $this->load->view('includes/template', $data);  

    }//listshift



/**
    * Update item by his id
    * @return void
    */
    public function updateshift()
    {
        //product id 
        $id = $this->uri->segment(5);
        $status = $this->uri->segment(6);
        
        //if save button was clicked, get the data sent via post
       
        //if the insert has returned true then we show the flash message
        if($status=='approve'){
            $stat_msg="Approved";
        }else{
            $stat_msg="Rejected";
        }

        if(($result=$this->manufacturers_model->update_shift($id,$status,$run=1)) == TRUE){
            
            $supervisers=$this->manufacturers_model->get_manufacture_by_id($result[0]['spid']);
            $name=$supervisers[0]['fullname'];
            $regid=$supervisers[0]['regid'];
            $message = "Hello ".$name." your shift time is ".$stat_msg;
            //$message = "Hello ".$name;
            $notify_data=array('regid'=>$regid,
                                'message' =>$message        
                                );
            $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
            $success=json_decode($not_data);
            if(!empty($success->success)){
                $this -> session -> set_flashdata('message','Shift Timing  notification is send successfully'); 
            }else{
                $data_error=$success->results;
                $this -> session -> set_flashdata('message','Somethinng went wrong '.$data_error[0]->error); 
                $this->manufacturers_model->update_shift($id,$status,$run=0);
            }
            redirect('admin/shift/listshift');
        }else{
            $this ->session->set_flashdata('message','Somethinng went problem cannot send notification..!'); 
            redirect('admin/shift/listshift');
        }
        
        

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        /*$data['manufacture'] = $this->manufacturers_model->get_manufacture_by_id($id);
        //load the view
        $data['main_content'] = 'admin/shift/listshift';
        $this->load->view('includes/template', $data);            
*/
    }//updateshift


    public function deleteshift()
    {
        //product id 
         
        $id = $this->uri->segment(5);
        $this -> session -> set_flashdata('message','Deleted Shift Time Successfully...!'); 
        $this->manufacturers_model->delete_shift($id);
        redirect('admin/shift/listshift','refresh');
    }//deletenotification
    public function listpayment(){

    	if ($this->input->server('REQUEST_METHOD') === 'POST'){
    		$labour_id=$this->input->post('labour');
            $data['listpayment']=$this->manufacturers_model->getpaymentlist($labour_id);
    		$data['listsalary']=$this->manufacturers_model->getsalarylist($labour_id);
    	}else{

        	$data['listpayment']=$this->manufacturers_model->getpaymentlist();
            $data['listsalary']=$this->manufacturers_model->getsalarylist();
    	}
        //echo "<pre>"; print_r($data);die;
        $data['labour']=$this->manufacturers_model->getlabour();
        $data['main_content'] = 'admin/payment/listpayment';
        $this->load->view('includes/template', $data);          
    }
 	public function addpayment(){


        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('supervisor', 'Supervisor', 'required');
            $this->form_validation->set_rules('labour', 'Labour', 'required');
            $this->form_validation->set_rules('givenamount', 'Give Amount', 'required|numeric');
            //$this->form_validation->set_rules('remainingamount', 'Remaining Amount', 'required|numeric');
            $this->form_validation->set_rules('datetime', 'Date', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
           

            if ($this->form_validation->run()){
            	//$remainingamount=$this->input->post('remainingamount');
		        $labour=$this->input->post('labour');
		        $date=$this->input->post('datetime');

		        $remaining=$this->manufacturers_model->getremaingamount($labour);
		       	if(is_array($remaining)){
		        	if(count($remaining)>=1){
			        	$remaining_amt=end($remaining);
			        	if(!empty($remaining_amt)){
			        		$remainingamount=$this->input->post('givenamount')+$remaining_amt['remainingamount'];
			        	}
		        	}else{
		        		$remainingamount=$this->input->post('givenamount');
		        	}	
		        }else{
		        	$remainingamount=$this->input->post('givenamount');
		        }
                $data_to_store = array(
                    'spid' => $this->input->post('supervisor'),
                    'userid' => $this->input->post('labour'),
                    'givenamount' => $this->input->post('givenamount'),
                    'remainingamount' => $remainingamount,          
                    'datetime' => date_format(date_create($this->input->post('datetime')),"Y-m-d"),
                );
                //if the insert has returned true then we show the flash message
                if($this->manufacturers_model->addpayment($data_to_store)){
                   
                    $this -> session -> set_flashdata('message','Advance payment added successfully'); 
                    redirect('admin/payment/listpayment','refresh');   
					
                }else{
                    $data['labour']=$this->manufacturers_model->getlabour();
		        	$data['supervisor']=$this->manufacturers_model->get_manufacturers();
		        	$data['main_content'] = 'admin/payment/addpayment';
		        	$this->load->view('includes/template', $data);  
            	}

            }else{
            	$data['labour']=$this->manufacturers_model->getlabour();
		        $data['supervisor']=$this->manufacturers_model->get_manufacturers();
		        $data['main_content'] = 'admin/payment/addpayment';
		        $this->load->view('includes/template', $data);          
            }

        }

        $data['labour']=$this->manufacturers_model->getlabour();
        $data['supervisor']=$this->manufacturers_model->get_manufacturers();

        $data['main_content'] = 'admin/payment/addpayment';
        $this->load->view('includes/template', $data);          
    }

    public function supervisorajax(){
        $supid=$this->input->post('supid'); 
        $labour=$this->manufacturers_model->getlabour($supid);
        $data=array();
        if($labour){

            foreach ($labour as $value) {
                
                $data2 ='<option data-tokens="'.$value['fullname'].'"  value="'.$value['userid'].'">'.$value['fullname'].'</option>';
                $data[]=$data2;
            }   
        }
        $html= $data; 
        echo json_encode($html);
    }
    public function hoildaynotification(){
    	$text_notification=$this->input->post('text_notification'); 
        $form_data=array('datetime'=>date('Y-m-d'),
                         'message' =>$text_notification,   
                        );
        $this->manufacturers_model->save_hoilday_notification($form_data);
    	//$text_notification="On 8-oct-2016 there will be hoildays"; 
    	$supervisorlist = $this->manufacturers_model->get_manufacturers();

    	$result['error_name']=array();
    	
    	foreach ($supervisorlist as $value) {
    		# code...
    		
    		if(!empty($value['regid'])){

    			$notify_data=array(	'regid'=>$value['regid'],
		                            'message' =>$text_notification        
	                        	);

		        $not_data=$this->firebase->sendnotify($notify_data);
	         	$success=json_decode($not_data);
	            if(!empty($success->success)){
	                print_r($success);echo "<br>";
	            }else{
	                $result['error_name'][]=$value['fullname'];
	                
	            }
	            sleep(1);
    		}
    	}
    	echo json_encode($result);
    }
}