<?php class Dashboard_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get user by his is
    * @param int $id 
    * @return array
    */
    public function get_dashboard($user_id)
    {
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('client_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	function _get_last_login($user_id)
	{		
		$this->db->select('logout_timestamp');
		$this->db->from('logins');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("logout_timestamp", "desc");
		$query = $this->db->get();
		
		return $query->row(); 
	}
	
	
	function get_new_clients($timestamp)
	{
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('created_at >=', $timestamp);
		$query = $this->db->get();
		
		return $query->result_array(); 
	}
	
	
	function get_new_orders($timestamp)
	{
		$this->db->select('*');
		$this->db->from('v_work_order_record');
		$this->db->where('created_at >=', $timestamp);
		$query = $this->db->get();
		
		return $query->result_array(); 
	}
    
    
    

	
}
?>	
