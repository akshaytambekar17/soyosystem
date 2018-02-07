<?php
class User_Manufracture extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->view('includes/include');
		$this->load->model('User_model');
	}

	public function index()
	{
		$data['dev_val']=$this->User_model->get_dev_val();
  		$data['main_content'] = 'user/user_dashboard';
        $this->load->view('includes/template',$data);
	}
	public function all_user_view()
	{
		
                $data['user']=$this->User_model->get_all_user();
                $data['device_param']=$this->User_model->get_soyo_device_param();
                $data['main_content'] = 'admin/list_user';
                $this->load->view('includes/header',$data);
	}
        public function export() {

        $device_ime = $_GET['device'];
        $device_type = $_GET['device_type'];
        $machine_data = json_decode($_GET['machine_data']);
        $data_details=array('device_ime'=>$device_ime,
                            );
        if($device_type=='single'){
            $device_details = $this->User_model->get_soyo_device_param_single($data_details);
        }else{
            $device_details = $this->User_model->get_soyo_device_param_multiple();
        }
        //echo "<pre>"; print_r($device_details[0]); die;
        if (!empty($device_details)) {
            if(empty($device_ime)){
                $device_ime="All_device_";
            }else{
                $device_ime=$device_details[0]['dev_imei'];
            }
            $filename = $device_ime."_reports_" . rand() . ".csv";
            ob_clean();
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=\"$filename\"");

            $out = fopen("php://output", 'w');
            $flag = false;
            if (!$flag) {
                $i = 1;
                $header=array(0=>'device ime');
                foreach($machine_data as $datas){
                    $header[$i] = $datas;
                    $i++;
                }
                fputcsv($out, array_values($header), ',', '"');
                $flag = true;
            }
            $i=1;
            $footer=array();
            $flag=false;
            
            foreach ($device_details as $device_detail) {
                
                foreach ($device_detail as $key => $value) {
                    if($key=='dev_imei'){
                        $footer[0]=$value;
                    }
                    foreach($machine_data as $mach_value){
                        if($mach_value==$key){
                            $footer[$i]=$value;
                            $i++;
                        }
                    }

                }
                fputcsv($out, array_values($footer), ',', '"');
                $footer=array();
            }
            die;
            fclose($out);
            exit;
        }
    }

}
?>