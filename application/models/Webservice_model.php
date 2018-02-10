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
	
}
?>