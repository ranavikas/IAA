<?php class Conditions_model extends CI_Model {
 
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
		$this->db->from('medical_conditions');
		$query = $this->db->get();
		return $query->num_rows();        
    }

	
    public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('medical_conditions');
		
        if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
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
		$this->db->from('medical_conditions');
		$this->db->where('id', $id);
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
		$medical_condition = $data['medical_condition'];
		
		$success = $this->db->insert('medical_conditions', array('medical_condition' => $medical_condition));
	      
		return $success;    
	}
	
	
    
	//Updates record
    function update_record($id, $data)
    {
		                      
		$this->db->where('id', $id);
		$success = $this->db->update('medical_conditions', $data);
			
		return $success;
	}
	

    /**
    * Delete record from ethnicities table
    * @param int $id 
    * @return bool
    */
	function delete_record($id)
	{
       
	   $success = $this->db->delete('medical_conditions', array('id' => $id));
	      
		return $success;
	}
	
}
?>	
