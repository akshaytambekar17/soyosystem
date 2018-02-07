<?php
class Admin_products extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('manufacturers_model');
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

        //all the posts sent by the view
        //$manufacture_id = $this->input->post('manufacture_id');        
       
       
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $supid=$this->input->post('supervisor');
            $category=$this->input->post('category');
            $status=$this->input->post('status');
            $data['products'] = $this->products_model->get_products($supid,$category,$status);         
        }else{
            $data['products'] = $this->products_model->get_products();         
        }
        
        //load the view
        $data['main_content'] = 'admin/labours/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            
            //form validation
            $this->form_validation->set_rules('fullname', 'Full name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('mobno', 'Mobile No', 'required|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('email', 'Email ID' , 'required');
            $this->form_validation->set_rules('supid', 'Supervisor', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('payment', 'Payment', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'mobno' => $this->input->post('mobno'),
                    'email' => $this->input->post('email'),          
                    'supid' => $this->input->post('supid'),
                    'category' => $this->input->post('category'),
                    'payment' => $this->input->post('payment'),
                    'role' => 1,
                    'status'=>0,
                    'pending'=>1,
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->store_product($data_to_store)){
                    
                    $labour_name=$this->input->post('fullname');
                    $supervisers=$this->manufacturers_model->get_manufacture_by_id($this->input->post('supid'));
                    $name=$supervisers[0]['fullname'];
                    $regid=$supervisers[0]['regid'];
                    $message = "Hello ".$name." new labour ".$labour_name." is added.";
                    $notify_data=array('regid'=>$regid,
                                        'message' =>$message        
                                    );
                    $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
                    $success=json_decode($not_data);
                    if(!empty($success->success)){
                        $this -> session -> set_flashdata('message','Labour information add  sucessfully and notification send successfully'); 
                    }else{
                        $data_error=$success->results;
                        $this -> session -> set_flashdata('message','Labour information add  sucessfully but notification cannot send something went to wrong'); 
                    }
                    redirect('admin/labours/','refresh');   
                }else{
                    $this -> session -> set_flashdata('message','Somethinng wrong  please insert data properly..!'); 
                    $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
                    //load the view
                    $data['main_content'] = 'admin/labours/add';
                    $this->load->view('includes/template', $data);  
                }

            }

        }
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/labours/add';
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
            $this->form_validation->set_rules('fullname', 'Full name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('mobno', 'Mobile No', 'required|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('email', 'Email ID' , 'required');
            $this->form_validation->set_rules('supid', 'Supervisor', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('payment', 'Payment', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'mobno' => $this->input->post('mobno'),
                    'email' => $this->input->post('email'),          
                    'supid' => $this->input->post('supid'),
                    'category' => $this->input->post('category'),
                    'payment' => $this->input->post('payment'),
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->update_product($id, $data_to_store) == TRUE){
                    $this -> session -> set_flashdata('message','Labour information updated  sucessfully....!'); 
                    redirect('admin/labours/update/'.$id.'');
                }else{
                    $this -> session -> set_flashdata('message','Somethinng went wrong please enter valid data....!'); 
                    redirect('admin/labours/update/'.$id.'');
                }
        

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->products_model->get_product_by_id($id);
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/labours/edit';
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
        

        $labour=$this->manufacturers_model->get_manufacture_by_id($id);
        $supervisers=$this->manufacturers_model->get_manufacture_by_id($labour[0]['supid']);

        $name=$supervisers[0]['fullname'];
        $regid=$supervisers[0]['regid'];
        $message = "Hello ".$name." labour is deleted";
        $notify_data=array('regid'=>$regid,
                            'message' =>$message        
                            );

        $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
        
        $success=json_decode($not_data);
        if(!empty($success->success)){
            $this -> session -> set_flashdata('message',  'Labour Data Deleted Sucessfully and notification is send to superviser successfully..!'); 
        }else{
            $data_error=$success->results;
            $this -> session -> set_flashdata('message','Labour Data Deleted Sucessfully but Notifiction cannot send Somethinng went wrong  error is '.$data_error[0]->error); 
            //$this->products_model->update_status($id,$status,$run=0);
        }
        $this->products_model->delete_product($id);
        redirect('admin/labours');
    }//edit


    public function listattendance()
    {
        $id = $this->uri->segment(4);
	
        //all the posts sent by the view
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            
            $from_string = $this->input->post('from_string');
            $to_string = $this->input->post('to_string');        
            $wage = $this->input->post('wage');
            
            $pay=$this->products_model->get_advancepay($id);     
            $advancepay=0;
            $remaining_amt=end($pay);
            $advancepay=$remaining_amt['remainingamount'];
            
            $data['advancepay']=$advancepay; 
            $data['remainingamount']=$remaining_amt['remainingamount']; 
            $data['wage']=$wage;

            $data['from_string_selected']=$from_string;
            $data['to_string_selected']=$to_string;

            $data['products'] = $this->products_model->get_attendance($id,'',$from_string,$to_string,'', '','',''); 
            if(!empty($from_string) && !empty($to_string)){
                $data['leaveday']=1;
            }else{
                $data['leaveday']=0;
            }
        }else{
            
            $data['products'] = $this->products_model->get_attendance($id);
            $data['from_string_selected']='';
            $data['to_string_selected']="";
           
        }
        $data['labourdetails']=$this->products_model->get_product_by_id($id);
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        
        //load the view
        $data['main_content'] = 'admin/labours/listattendance';
        $this->load->view('includes/template', $data);  

    }//listattendance 


public function updatestatus()
    {
        //user id 
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        if($status=='approve'){
            $stat_msg="Approved";
        }else{
            $stat_msg="Rejected";
        }


        if(($result=$this->products_model->update_status($id, $status,$run=1)) == TRUE){
            $supervisers=$this->manufacturers_model->get_manufacture_by_id($result[0]['supid']);
            $name=$supervisers[0]['fullname'];
            $regid=$supervisers[0]['regid'];
            $message = "Hello ".$name." labour is ".$stat_msg;
            $notify_data=array('regid'=>$regid,
                                'message' =>$message        
                                );

            $not_data=$this->firebase->sendnotify($notify_data);  //sent notification
            
            $success=json_decode($not_data);
            if(!empty($success->success)){
                $this -> session -> set_flashdata('message',  $stat_msg.' notification is send successfully'); 
            }else{
                $data_error=$success->results;
                $this -> session -> set_flashdata('message','Notifiction cannot send Somethinng went wrong  error is '.$data_error[0]->error); 
                $this->products_model->update_status($id,$status,$run=0);
            }
            redirect('admin/labours');    
        }else{
            $this->session->set_flashdata('message', 'Cannot Updated Approved or Reject Notifiction Somethinng went wrong..!');
            redirect('admin/labours');
        }
        
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->products_model->get_product_by_id($id);
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/labours';
        $this->load->view('includes/template', $data);            

    }//update

    public function addsalary(){

        $advancepay=$this->input->post('advancepay');
        $totalsalary=$this->input->post('totalsalary');
        $wagesadvancepay=$this->input->post('wagesadvancepay');
        $remainingamount=$this->input->post('remainingamount');
        

        $form_data=array(
                        'userid'=>$this->input->post('userid'),
                        'datetime' =>date("Y-m-d"),
                        'spid'=>$this->input->post('spid'),
                        'salamt'=>$this->input->post('totalsalary'),    
                        'advancepay'=>$wagesadvancepay,
                        'remainimgadv'=>$remainingamount, 
                        'deduction'=>$this->input->post('deduction'),   
                    );

        $update_data=$this->products_model->updateadvancepay($form_data);
        $data=$this->products_model->addsalary($form_data);       

        echo $data;

    }
    public function export(){
        
        $from_date=$_GET['from_date'];
        $to_date=$_GET['to_date'];
        //$status=$_GET['status'];
        //$labourlist = $this->products_model->get_products($supervisor,$category,$status);     
        $labourlist = $this->products_model->get_products();     
        
        $from_date = date("Y-m-d", strtotime($from_date));
        $to_date = date("Y-m-d", strtotime($to_date));
        if(!empty($labourlist)) {
            $fromTimestamp = strtotime($from_date);
            $toTimestamp = strtotime($to_date);
        	$filename = "Labour_report_" . rand() . ".csv";
            ob_clean();
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=\"$filename\"");
            
            $out = fopen("php://output", 'w');
            $flag = false;

           
            $header  = array(
                    '0' => 'Full name',
                    );
            if(!$flag) {
                //fputcsv($out, array_values($header), ',', '"');
                $i=1;
                for ($currentDateTS = $fromTimestamp; $currentDateTS <= $toTimestamp; $currentDateTS += (60 * 60 * 24)) {
                    $currentDateStr1 = date('Y-m-d',$currentDateTS);
                    $thedate = explode("-", $currentDateStr1);
                    $header[$i] =$thedate[2];
                    $i++;    
                }
                fputcsv($out, array_values($header), ',', '"');  
                $flag = true;
            }
            foreach ($labourlist as $key_labour => $value_labour) {
                $attendcelist=$this ->products_model->get_attendance($value_labour['userid']);
                $i=1;
                $footer =array(0=>$value_labour['fullname']);
                for ($currentDateTS = $fromTimestamp; $currentDateTS <= $toTimestamp; $currentDateTS += (60 * 60 * 24)) {
                    $flag=0;
                    foreach (array_reverse($attendcelist) as $key_attendce => $value_attendce) {
                        $referenceTimestamp = strtotime( $value_attendce['datetime'] );
                        if($currentDateTS == $referenceTimestamp){
                            $flag=1;    
                        }
                    }
                    if($flag==1){
                        $footer[$i]="P";
                    }else{
                            $footer[$i]="A";
                    }
                    $i++;
                }
                fputcsv($out, array_values($footer), ',', '"');    
            }
            fclose($out);
            exit;
            
        }
    }    
}
