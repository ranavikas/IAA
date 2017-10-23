<?php class Leads_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

	
	

    /**
    * Get all audits records
    * @return array
    */
    public function get_audit( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('v_audit_trail');
	
                
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('audit_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }




    /**
    * Count the number of rows
    * @return int
    */
    function count_audits()
    {
		$this->db->select('*');
		$this->db->from('v_audit_trail');
		$query = $this->db->get();
		return $query->num_rows();        
    }

	
}
?>	
