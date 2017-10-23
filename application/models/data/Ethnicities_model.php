<?php class Ethnicities_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

	
    /**
    * Count the number of rows
    * @return int
    */
    function count_records()
    {
		$this->db->select('*');
		$this->db->from('ethnicities');
		$query = $this->db->get();
		return $query->num_rows();        
    }

	
    public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('ethnicities');
		
        if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('ethnicity_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
	
	
	
    /**
    * Get user by his is
    * @param int $id 
    * @return array
    */
    public function get_record_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('ethnicities');
		$this->db->where('ethnicity_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
	
    /**
    * Add new record to ethnicities table
    * @param array $data 
    * @return bool
    */
    public function add_record($data)
    {
		$ethnicity = $data['ethnicity'];
		
		$success = $this->db->insert('ethnicities', array('ethnicity' => $ethnicity));
	      
		return $success;    
	}
	
	
    
	//Updates record
    function update_record($id, $data)
    {
		                      
		$this->db->where('ethnicity_id', $id);
		$success = $this->db->update('ethnicities', $data);
			
		return $success;
	}
	

    /**
    * Delete record from ethnicities table
    * @param int $id 
    * @return bool
    */
	function delete_record($id)
	{
       
	   $success = $this->db->delete('ethnicities', array('ethnicity_id' => $id));
	      
		return $success;
	}
	
}
?>	
