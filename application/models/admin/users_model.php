<?php class Users_model extends CI_Model {
 
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
    
    

    public function get_user( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('users');
	
                
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('user_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_assign_roles($user_id)
    {
        $this->db->select('user_roles.role , user_roles.color');
        $this->db->from('user_roles');
        $this->db->join('user_assign_role', 'user_roles.role_id = user_assign_role.role_id', 'inner');
        $this->db->join('users', 'user_assign_role.user_id = users.user_id', 'inner');
        $this->db->where('users.user_id', $user_id);
        $query = $this->db->get();
        $res =  $query->result_array(); 
        
        
        $val = '';
        for($i= 0; $i<count($res);$i++){
          
          if($i == 0)  
          $val = '<span style="color:'.$res[$i]['color'].'">'.$res[$i]['role'].'</span>';
          else
           $val .= ','.'<span style="color:'.$res[$i]['color'].'">'.$res[$i]['role'].'</span>';   
            
        }
        
        return $val;
        
    }
    
    
    public function get_roles_edit($user_id)
    {
        $this->db->select('role_id');
        $this->db->from('user_assign_role');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'role_id'); 
           
    }
  
    /**
    * Count the number of rows
    * @return int
    */
    function count_users()
    {
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    
    public function get_all_user( )
    {
	    
		$this->db->select('*');
		$this->db->from('v_active_users');
	
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_roles()
    {
		$this->db->select('*');
		$this->db->from('user_roles');
                $this->db->where('record_status', 1);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
 
    /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_user($data , $user_role_array)
    {		
        $success = FALSE;
        
        $loged_in_user_id = $this->session->userdata('user')->user_id;
  
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();
        
        $user_name = $this->input->post('username');
        $this->db->where('username', $user_name);
	$query = $this->db->get('users');

        $user_id = $this->get_id_by_username($user_name);
        
        if($query->num_rows() > 0)
	{ // if user already exist
            $this->db->where('username', $user_name);
            $success = $this->db->update('users', $data);
            
            //first delete then update value
            $this->db->delete('user_assign_role', array('user_id' => $user_id));
            
            //insert record into location table.
            if (!empty($user_role_array)) {
                foreach($user_role_array as $val){
                     $data_to_role = array(
                            'user_id' => $user_id,
                            'role_id' => $val
                             );
                     
                     $success = $this->db->insert('user_assign_role', $data_to_role);
                     
                }  
            }
            
            
        }else
	{ // if user does not already exist.
           $success =  $this->db->insert('users', $data);
		   
           $last_insert_id =  $this->db->insert_id();
            
           //insert record into location table.
            if (!empty($user_role_array)) {
                foreach($user_role_array as $val){
                     $data_to_role = array(
                            'user_id' => $last_insert_id,
                            'role_id' => $val
                             );
                     
                     $success = $this->db->insert('user_assign_role', $data_to_role);
                     
                }  
            }
			
			            
        }  
		
			
        $this->db->trans_complete();

        $success &= $this->db->trans_status();

        return $success;   
        
		
    }

    
    function user_exist($username)
    {
	$this->db->where('username', $username);
        $query = $this->db->get('users');
        // echo $this->db->last_query();
        return $query->num_rows();
		
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
    function update_user($id , $data , $user_role_array)
    {
       $success = FALSE;       
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();   
                                
         $this->db->where('user_id', $id);
            $success = $this->db->update('users', $data);
            
            //first delete then update value
            $this->db->delete('user_assign_role', array('user_id' => $id));
            
            //insert record into location table.
            if (!empty($user_role_array)) {
                foreach($user_role_array as $val){
                     $data_to_role = array(
                            'user_id' => $id,
                            'role_id' => $val
                             );
                     
                     $success = $this->db->insert('user_assign_role', $data_to_role);
                     
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

    /**
    * Delete user
    * @param int $id - user id
    * @return boolean
    */
	function delete_user($id){
            $success = FALSE;
            
            if($id == 1)
                return $success;
                
            //Run these queries as a transaction, we want to make sure we do all or nothing
            $this->db->trans_start(); 
            
            $data_to_delete = array(
                    'active' => 3		
                );
		//delete record from tour table	
		$this->db->where('user_id', $id);
		$success = $this->db->update('users', $data_to_delete); 
            
            $this->db->trans_complete();

            $success &= $this->db->trans_status();

            return $success;    
                
	}
	
}
?>	
