<?php class Profile_model extends CI_Model {
 
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
    public function get_user_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
     public function get_all_user( )
    {
	    
		$this->db->select('*');
		$this->db->from('users');
	
                $this->db->join('user_roles', 'users.user_role = user_roles.role_id', 'left');
                $this->db->where('user_roles.record_status', 1);
                
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }


    function get_id_by_username($username)
    {
	$this->db->select('user_id');
        $this->db->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    /**
    * Update user
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_user($id, $data , $permission, $estimator=null)
    {
		
         $success = FALSE;
       
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();   
                      
            $this->db->where('user_id', $id);
            $success = $this->db->update('users', $data);
            //$report = array();
            //$report['error'] =  $this->db->error();

            
            
            
            if($permission != ''){
                $user_prmission  = explode(',', $permission);
                $success = $this->db->delete('user_permissions', array('user_id' => $id));
                
				foreach($user_prmission as $val )
				{
                    $user_prm  = explode('-', $val);
					
					//Don't insert unless user has permissions
					if($user_prm[1] > 0 )
					{
						$permission_to_store = array(
								'user_id' => $id,
								'page_id' => $user_prm[0],
								'permission_type' => $user_prm[1]          
						);
						
						$success = $this->db->insert('user_permissions', $permission_to_store);
					}
                }
            }
			
			//If estimator checkbox is filled
			if($estimator == 'on')
			{
				if($this->db->delete('estimators', array('user_id' => $id)))
				{
					$sql = $this->db->insert_string('estimators', array('user_id' => $id)) . ' ON DUPLICATE KEY UPDATE user_id=user_id';
					$this->db->query($sql);
					$id = $this->db->insert_id();
				}
			}
			
            
            $this->db->trans_complete();

            $success &= $this->db->trans_status();

            return $success;       
	}
        
        
        
    function passwordchange($id, $data)
    {
		
         $success = FALSE;
       
        //Run these queries as a transaction, we want to make sure we do all or nothing
            $this->db->trans_start();   
                      
            $this->db->where('user_id', $id);
            $success = $this->db->update('users', $data);
            
            $this->db->trans_complete();

            $success &= $this->db->trans_status();

            return $success;       
	}    

    
	
}
?>	
