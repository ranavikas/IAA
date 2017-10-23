<?php class Contacts_model extends CI_Model {
 
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
    public function get_record_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('contacts');
		$this->db->where('contact_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    
     /**
    * Count the number of rows
    * @return int
    */
    function count_records()
    {
		$this->db->select('*');
		$this->db->from('contacts');
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    

    public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('contacts');
                
                if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('contact_id', $order_type);
		}
                
		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
  
    /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_record($data)
    {
	
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        $success = $this->db->insert('contacts', $data);
        $last_insert_id =  $this->db->insert_id(); 
        
        $this->db->trans_complete();

        return $success;  
        	
    }

    
    
    /**
    * Update user
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_record($id, $data)
    {
		
         $success = FALSE;
       
        //Run these queries as a transaction, we want to make sure we do all or nothing
            $this->db->trans_start();   
            $this->db->where('contact_id', $id);
            $success = $this->db->update('contacts', $data);
            $this->db->trans_complete();
            return $success;       
	}
	
    /**
    * Delete user
    * @param int $id - user id
    * @return boolean
    */
	function delete_record($id)
	{
       
	   $success = $this->db->delete('contacts', array('contact_id' => $id));
	      
		return $success;
	
	}
	
}
?>	
