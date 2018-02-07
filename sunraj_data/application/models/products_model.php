<?php
class Products_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_product_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('sun_user');
		$this->db->where('userid', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function num_rows()
	{
		$this->db->select('*');
		$this->db->from('sun_user');
		$query = $this->db->get();
		return $query->result(); 
	}
	
	  
    /**
    * Fetch products data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_products($manufacture_id=null, $category=null, $status=null, $order_type='Desc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('sun_user');
        $this->db->where('role', '1');
		if(!empty($manufacture_id) && $manufacture_id != null && $manufacture_id != 0){
			$this->db->where('supid', $manufacture_id);
		}
		if(!empty($status) && $status != 'null'){
			
			$this->db->where('isapproved',$status);
			if($status=='approve'){
				$this->db->where('status',1);
			}else{
				$this->db->where('status',2);
			}
		}
		if(!empty($category) && $category!= 'null'){
			$this->db->where('category',$category);
		}
		

		//$this->db->join('sun_user', 'userid = supid', 'left');

		$this->db->group_by('userid');

		
		$this->db->order_by('userid', $order_type);

		//$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_products($manufacture_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('sun_user');
        $this->db->where('role', '1');
		if($manufacture_id != null && $manufacture_id != 0){
			$this->db->where('supid', $manufacture_id);
		}
		if($search_string){
			$this->db->like('fullname', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('userid', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_product($data)
    {
        $insert = $this->db->insert('sun_user', $data);
        return $insert;
    }

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {
		$this->db->where('userid', $id);
		$this->db->update('sun_user', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}


 /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_status($id,$status,$run)
    {
		if($run==1){ 
			if($status=='approve'){
				$statusval=1;
				$isapproved='approve';
			}else if($status=='reject'){
				$statusval=2;
				$isapproved='reject';
			}else{
				$statusval=0;
			}

			$formdata=array(
						'isapproved'=>$isapproved,
						'status'=>$statusval
					);
			
			$this->db->where('userid', $id);
			$this->db->update('sun_user', $formdata);
			
			$this->db->select('*');
			$this->db->from('sun_user');
			$this->db->where('userid', $id);
			$query=$this->db->get();
			$result=$query->result_array();	

			$data=array('isread'=>$statusval);
			$this->db->where('notid', $result[0]['notifyid']);
			$this->db->update('sun_notification', $data);

			return $result;

			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();
			if($report !== 0){
				return true;
			}else{
				return false;
			}
		}else{
			// $formdata=array(
			// 			'isapproved'=>'',
			// 			'status'=>'0'
			// 		);
			
			// $this->db->where('userid', $id);
			// $this->db->update('sun_user', $formdata);			
		}
				
	}




    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function delete_product($id){
		$this->db->select('*');
		$this->db->from('sun_user');
		$this->db->where('userid', $id);
		$query = $this->db->get();
		$result= $query->result_array(); 	

		if($result[0]['isdeleted']==1){
			$this->db->where('userid', $id);
			$this->db->delete('sun_user'); 
		}else{
			$form_data=array('isdeleted'=>1);
			$this->db->where('userid', $id);
			$this->db->update('sun_user', $form_data);
		}

	}
 



 public function get_attendance($id,$manufacture_id=null, $from_string=null,$to_string=null, $order=null, $order_type='Desc',$limit_start=null, $limit_end=null)
    {
	   // print_r( $from_string." ".$to_string);exit;
		$this->db->select('*');
		$this->db->from('sun_attendance');
		if($id!=0)
		{
        $this->db->where('userid', $id);
		}
		if($manufacture_id != null && $manufacture_id != 0){
			$this->db->where('spid', $manufacture_id);
		}
		if($from_string!=null){
			//print_r($from_string);
			$this->db->where('datetime >=', $from_string);
		}
		if($to_string!=null){
			//print_r($to_string);exit;
			$this->db->where('datetime <=', $to_string);
		}

		//$this->db->join('sun_user', 'userid = supid', 'left');

		$this->db->group_by('attendaceid');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('attendaceid', $order_type);
		}

		
		$query = $this->db->get();
		//print_r($query->num_rows());exit;
		return $query->result_array(); 	
    }
    public function get_attendance_listall()
    {
	   // print_r( $from_string." ".$to_string);exit;
		$this->db->select('*');
		$this->db->from('sun_attendance');
		$query = $this->db->get();
		return $query->result_array(); 	
    }
    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */

    function count_attendance($id,$manufacture_id=null, $from_string=null,$to_string=null, $order=null)
    {
		
		$this->db->select('*');
		$this->db->from('sun_attendance');
       if($id!=0)
		{
        $this->db->where('userid', $id);
		}
		
		if($manufacture_id != null && $manufacture_id != 0){
			$this->db->where('spid', $manufacture_id);
		}
		if($from_string!=null){
			
			$this->db->where('datetime >=', $from_string);
		}
		if($to_string!=null){
			$this->db->where('datetime <=', $to_string);
		}
		if($order){
			$this->db->order_by($order, 'Desc');
		}else{
		    $this->db->order_by('attendaceid', 'Desc');
		}
		
		$query = $this->db->get();
		return $query->num_rows();        
    }
    public function addsalary($formdata)
    {
		$this->db->select('*');
		$this->db->from('sun_salary');
		$this->db->where('userid',$formdata['userid']);
		$this->db->where('spid',$formdata['spid']);
		$this->db->where('datetime',$formdata['datetime']);

		$query=$this->db->get();
		if($query->num_rows>0){
			$this->db->where('userid',$formdata['userid']);
			$this->db->where('spid',$formdata['spid']);
			$this->db->where('datetime',$formdata['datetime']);
			$this->db->update('sun_salary', $formdata);			
		}else{
			$result=$this->db->insert('sun_salary', $formdata);
		}
		if ($this->db->affected_rows() == 1){
		 	return 1;
		}else{
			return 0;
		}

    }
    public function get_advancepay($id){

    	$this->db->select('*');
		$this->db->from('sun_advancepay');
		$this->db->where('userid',$id);
		$query=$this->db->get();
		$result=$query->result_array();	

		return $result;

	}
	public function updateadvancepay($formdata){

    	$this->db->select('*');
		$this->db->from('sun_advancepay');
		$this->db->where('userid',$formdata['userid']);
		$query=$this->db->get();
		$result=$query->result_array();

		$result_data=end($result);

		$form_data=array('remainingamount'=>$formdata['remainimgadv']);

		$this->db->where('advsalid',$result_data['advsalid']);
		$fina_result=$this->db->update('sun_advancepay', $form_data);	

		return $fina_result;

	}
	public function getattendancelist($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('sun_advancepay');
		$this->db->where('userid',$formdata['userid']);
		$query=$this->db->get();
		$result=$query->result_array();

	}



}
?>	
