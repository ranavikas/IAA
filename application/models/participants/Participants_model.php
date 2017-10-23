<?php class Participants_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get role by his is
    * @param int $id 
    * @return array
    */
    public function get_role_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('user_roles');
		$this->db->where('role_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }


    public function get_role( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('user_roles');
	
                
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('role_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

	
	public function get_search_options()
	{
		
	}
	
	public function get_search_option_values()
	{
		
	}
	
	function get_list_from_table()
	{
		
	}
	
	public function get_total_payment($participant_id)
	{
		$this->db->select('*');
		$this->db->from('vw_Participant_Payment');
		$this->db->where('participant_id', $participant_id);
		$query = $this->db->get();
		
		return $query->result_array(); 
	}
}
?>	
