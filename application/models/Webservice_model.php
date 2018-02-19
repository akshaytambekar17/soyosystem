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
            foreach ($vfd_data as $key => $value) {
                $data=array('parameter'=>$value->unique_id,
                            'value'=>$get[$value->unique_id],
                            'imei'=>$get['imei'],
                            'vfd_id'=>$get['vfd'],
                            'product_type'=>$get['product_type'],
                        );
                if($this->db->insert('soyo_device_request',$data)){
                    $insert=true;
                }else{
                    $insert=false;
                }

            }
            return $insert;
	   	
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
	
}
?>