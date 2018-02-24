<?php
class Webservice_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	 	$this->load->driver('cache');
	}
	public function insert_request($vfd_data,$get)
	{
            
            $this->db->where('username',$get['username']);
            $this->db->where('password',$get['password']);
            $query=$this->db->get('soyo_users');
            $user_details=$query->result();
            //echo "<pre>"; print_r($vfd_data); die;
            if(!empty($user_details)){
                foreach ($vfd_data as $key => $value) {
                    $data=array('parameter'=>$value->unique_id,
                                'value'=>$get[$value->unique_id],
                                'imei'=>$get['imei'],
                                'vfd_id'=>$get['vfd'],
                                'device_type'=>$get['device_type'],
                                'user_id'=>$user_details[0]->user_id,
                            );
                    if($value->unique_id=='F2' || $value->unique_id=='F3' || $value->unique_id=='F4' || $value->unique_id=='F5' || $value->unique_id=='F6' || $value->unique_id=='F7' || $value->unique_id=='F9'){
                        if($get[$value->unique_id]==1){
                            $flag[]=1;
                        }else{
                            $flag[]=0;
                        }
                    }
                    if($this->db->insert('soyo_device_request',$data)){
                        $insert=true;
                    }else{
                        $insert=false;
                    }

                }
                if(in_array("0", $flag)){
                    $user_site_details=$this->User_model->get_user_site_by_imei($get['imei']);
                    $notifiy_data=array('message'=>"Fault has found in the site '".$user_site_details[0]->site_name,
                                    'send_to'=>$user_details[0]->user_id,
                                    'send_from'=>1,
                                    'type'=>2,
                                    'user_id'=>$user_details[0]->user_id,
                                    'created_at'=>date('Y-m-d h:i:sa'),

                                );
                    $this->db->insert('soyo_notification',$notifiy_data);
                }
                return $insert;
            }else{
                return false;
            }
	   	
	}
	public function get_user_by_imei($imei)
	{
            $this->db->select("*");
            $this->db->from("soyo_user_site_information");
            $this->db->where("imei_no",$imei);
            $query = $this->db->get();
            $result=$query->result_array(); 
            if($result){
                $this->db->select('*');
                $this->db->from('soyo_users su');
                $this->db->join('soyo_user_site_information susi','susi.user_id=su.user_id');
                $this->db->where("su.user_id",$result[0]['user_id']);
                $query = $this->db->get();
                return $query->result_array(); 
            }else{
                return false;
            }

           	
	}
    public function get_user_by_imei_status($data)
    {
            $this->db->select("*");
            $this->db->from("soyo_user_site_information");
            $this->db->where("imei_no",$data['imei']);
            $query = $this->db->get();
            $result=$query->result_array(); 
            if($result){
                $this->db->select("*");
                $this->db->from("soyo_users");
                $this->db->where("user_id",$result[0]['user_id']);
                $query = $this->db->get();
                return $query->result_array(); 
            }else{
                return false;
            }

            
    }
    public function get_all_details($data)
    {
        $this->db->select("*");
        $this->db->from("soyo_site_pump_status");
        $this->db->where("imei",$data['imei']);
        $this->db->order_by("id","desc");
        $query_site_pump_status = $this->db->get();
        $result_site_pump_status=$query_site_pump_status->result(); 
        
        $this->db->select("*");
        $this->db->from("soyo_user_site_information");
        $this->db->where("imei_no",$data['imei']);
        $query = $this->db->get();
        $result=$query->result_array(); 
        if($result){
            $this->db->select("*");
            $this->db->from("soyo_users");
            $this->db->where("user_id",$result[0]['user_id']);
            $query_user = $this->db->get();
            $result_user= $query_user->result(); 
        }
        $all_details=array('pump_status'=>!empty($result_site_pump_status)?$result_site_pump_status[0]->status:'',
                            'pump_request'=>!empty($result_user)?$result_user[0]->status:'',
                            'uploading_status'=> 0,
                            'password_changes'=>0,
                           );
        return $all_details;

            
    }
	
}
?>