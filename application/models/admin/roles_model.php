<?php class Roles_model extends CI_Model {
 
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

    /**
    * Count the number of rows
    * @return int
    */
    function count_roles()
    {
		$this->db->select('*');
		$this->db->from('user_roles');
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new role into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_role($data)
    {
		
        
        $this->db->insert('user_roles', $data);
            return $this->db->insert_id();
	    
		//return $insert;
    }

    /**
    * Update role
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_role($id, $data)
    {
		$this->db->where('role_id', $id);
		$this->db->update('user_roles', $data);
		$report = array();
		$report['error'] =  $this->db->error();
		//$report['message'] = $this->db->_error_message();
                //$this->db->error();
		if($report !== 0){
                    
			return true;
		}else{
		
                    return false;
		}
	}

    /**
    * Delete roles
    * @param int $id - roles id
    * @return boolean
    */
	function delete_role($id){
            
            $data_to_delete = array(
                    'record_status' => 3		
                );
		//delete record from tour table	
		$this->db->where('role_id', $id);
		$this->db->update('user_roles', $data_to_delete); 
	}
	
}
?>	
