<?php class Studies_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $userarray = get_object_vars($this->session->userdata('user'));
        $user_id = $userarray['user_id'];

    }

    
    
    
      /**
    * Count the number of rows
    * @return int
    */
    function count_records()
    {
		$this->db->select('*');
		$this->db->from('studies');
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    

    public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('studies');
                
                if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('study_id', $order_type);
		}
                
		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
  
    
    public function get_clients()
    {
        $this->db->select('*');
        $this->db->from('clients');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_products()
    {
        $this->db->select('*');
        $this->db->from('products');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_products_type()
    {
        $this->db->select('*');
        $this->db->from('product_types');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_study_type()
    {
        $this->db->select('*');
        $this->db->from('study_types');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_study_status()
    {
        $this->db->select('*');
        $this->db->from('study_status');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function get_study($study_id)
    {
        $this->db->select('*');
        $this->db->from('studies');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_users()
    {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_user_groups()
    {
        $this->db->select('*');
        $this->db->from('user_groups');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_locations()
    {
        $this->db->select('*');
        $this->db->from('locations');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_dnq_study()
    {
        $this->db->select('*');
        $this->db->from('studies_view');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function max_study_id()
    {
        $this->db->select_max('study_id');
        $result = $this->db->get('studies')->row();  
        return $result->study_id+1;   
    }
    
    
    public function get_contact_info($client_id)
    {
        $this->db->select('*');
        $this->db->from('contacts');
        $this->db->join('client_contacts', 'contacts.contact_id = client_contacts.contact_id', 'inner');
        $this->db->where('client_id', $client_id);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function count_autosave_record_by_userid($user_id)
    {
		$this->db->select('*');
		$this->db->from('studies_autosave');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->num_rows();   
    }
    
    public function get_autosave_record_by_userid($user_id)
    {
		$this->db->select('*');
		$this->db->from('studies_autosave');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    
    public function get_autosave_study_id($user_id)
    {
        $this->db->select('*');
        $this->db->from('studies_autosave');
        $this->db->where('user_id',$user_id );
        $query = $this->db->get();
        $study =  $query->result_array();  
        $study_id = $study[0]['study_id'];
        
        return $study_id;
    }
    
    
    public function get_autosave_location($study_id)
    {
        $this->db->select('location_id');
        $this->db->from('study_locations_autosave');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'location_id'); 
           
    }
    
    
    public function get_autosave_study_dnq($study_id)
    {
        $this->db->select('dnq_study_id');
        $this->db->from('study_dnq_autosave');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'dnq_study_id'); 
           
    }
    
    
    public function get_autosave_user_groups($study_id)
    {
		$this->db->select('study_user_groups_autosave.* , study_group_sessions_autosave.session_order ,study_group_sessions_autosave.session_time ');
		$this->db->from('study_user_groups_autosave');
                $this->db->join('study_group_sessions_autosave', 'study_user_groups_autosave.id = study_group_sessions_autosave.study_user_group', 'right');
		 $this->db->where('study_user_groups_autosave.study_id', $study_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function get_array_unique($array)
    {
		$new_values = array();
                    foreach($array as $value) {
                        if(isset($new_values[$value['id']])) {
                            $temp = $new_values[$value['id']];
                            $temp['session_time'] .= ',' . $value['session_time'];
                            
                            $new_values[$value['id']] = $temp;
                        } else {
                            $new_values[$value['id']] = $value;
                        }
                    }

                    $new_values = array_values($new_values); // reindex keys
                    
                    return $new_values;
    }
    
   
    /**
    * Get user by his is
    * @param int $id 
    * @return array
    */
    public function get_record_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('studies');
		$this->db->where('study_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function count_record_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('studies');
		$this->db->where('study_id', $id);
		$query = $this->db->get();
		return $query->num_rows();
    }
    
    
    
     public function get_location_edit($study_id)
    {
        $this->db->select('location_id');
        $this->db->from('study_locations');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'location_id'); 
           
    }
    
    
    public function get_study_dnq_edit($study_id)
    {
        $this->db->select('dnq_study_id');
        $this->db->from('study_dnq');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'dnq_study_id'); 
           
    }
   
    
     public function get_user_groups_edit($study_id)
    {
		$this->db->select('study_user_groups.* , study_group_sessions.session_order ,study_group_sessions.session_time ');
		$this->db->from('study_user_groups');
                $this->db->join('study_group_sessions', 'study_user_groups.id = study_group_sessions.study_user_group', 'right');
		 $this->db->where('study_user_groups.study_id', $study_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_record($data , $product_name , $product_name_other , $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
    {
            
        $study_id = $this->get_autosave_study_id($user_id);
        
        
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
       //if lead source is other insert value intio load sources table
        if($product_name == 'other')
        {
            
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('product_name', $product_name_other);
            $query = $this->db->get();
           
            if ($query->num_rows() == 0) {
            
                
                    $product_val = array(
                            'product_type_id' => $data['product_type'],
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
            
        }    
        else{
            
            $product_id = $product_name;
        }
        
        $data['product_name'] = $product_id;        

  
        //insert record into participant_autosave table
        $success = $this->db->insert('studies', $data);
        $last_insert_id =  $this->db->insert_id(); 
        //echo $this->db->last_query();
        
            
        //insert record into location table.
            if (!empty($locationarray)) {
                foreach($locationarray as $val){
                     $data_to_loc = array(
                            'study_id' => $last_insert_id,
                            'location_id' => $val
                             );
                     
                     $success = $this->db->insert('study_locations', $data_to_loc);
                     
                }  
            }
            
            //update record into occupation.
            if (!empty($dnq_studyarray)) {
                //add record in the form of insertion
                foreach($dnq_studyarray as $val){
                     $data_to_study = array(
                            'study_id' => $last_insert_id,
                            'dnq_study_id' => $val
                             );
                     
                     $success = $this->db->insert('study_dnq', $data_to_study);
                     
                }  
            }    
      
            //update record into study_user_groups_autosave.
            
            if (!empty($study_group_array)) {
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $study = explode('_', $val);
                    
                    $sess = explode('_', $study[4]);
                    $session_no = $sess[0];
                    
                     $data_to_study = array(
                            'study_id' => $last_insert_id,
                            'user_group' => $study[0],
                            'number_of_participants' => $study[1],
                            'payment_amount' => $study[2],
                            'training' => $study[3],
                            'number_of_sessions' => $session_no
                             );
                     
                     $success = $this->db->insert('study_user_groups', $data_to_study);
                     $last_insert_study_group_id =  $this->db->insert_id(); 
                     
                     // this section is user to inser recordin to study group session table
                     $sess_time = array();
                     $sess_time = $sessiontime[$j];
                   
                     for($i = 0 ; $i<count($sess_time) ; $i++)
                     {
                         if($sess_time[$i] != ''){
                             $data_to_session = array(
                            'study_id' => $last_insert_id,
                            'study_user_group' => $last_insert_study_group_id,
                            'session_order' => $session_no,
                            'session_time' => $sess_time[$i]
                             );
                    
                            $success = $this->db->insert('study_group_sessions', $data_to_session);
                         }
                         
                     }
                  $j++;   
                }  
            } // study group array
            
        // delete all record from aotusave tables
        $this->db->delete('studies_autosave', array('user_id' => $user_id));      
        $this->db->delete('study_locations_autosave', array('study_id' => $study_id));
        $this->db->delete('study_dnq_autosave',  array('study_id' => $study_id));
        $this->db->delete('study_user_groups_autosave',  array('study_id' => $study_id));
        $this->db->delete('study_group_sessions_autosave', array('study_id' => $study_id));
 
        $this->db->trans_complete();

        return $success;  
        	
    }
    
      /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function update_record($study_id ,$data , $product_name , $product_name_other , $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
    {
        
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        //if lead source is other insert value intio load sources table
        if($product_name == 'other')
        {
            
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('product_name', $product_name_other);
            $query = $this->db->get();
           
            if ($query->num_rows() == 0) {
            
                
                    $product_val = array(
                            'product_type_id' => $data['product_type'],
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
            
        }    
        else{
            
            $product_id = $product_name;
        }
        
        $data['product_name'] = $product_id;        


//first delete all record from aotusave tables
        $this->db->delete('study_locations', array('study_id' => $study_id));
        $this->db->delete('study_dnq',  array('study_id' => $study_id));
        $this->db->delete('study_user_groups',  array('study_id' => $study_id));
        $this->db->delete('study_group_sessions', array('study_id' => $study_id));
  
     
        
        $this->db->where('study_id', $study_id);
        $success = $this->db->update('studies', $data);
        
            
        //insert record into location table.
            if (!empty($locationarray)) {
                foreach($locationarray as $val){
                     $data_to_loc = array(
                            'study_id' => $study_id,
                            'location_id' => $val
                             );
                     
                     $success = $this->db->insert('study_locations', $data_to_loc);
                     
                }  
            }
            
            //update record into occupation.
            if (!empty($dnq_studyarray)) {
                //add record in the form of insertion
                foreach($dnq_studyarray as $val){
                     $data_to_study = array(
                            'study_id' => $study_id,
                            'dnq_study_id' => $val
                             );
                     
                     $success = $this->db->insert('study_dnq', $data_to_study);
                     
                }  
            }    
      
            //update record into study_user_groups_autosave.
            
            if (!empty($study_group_array)) 
			{
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $study = explode('_', $val);
                    
                    $sess = explode('_', $study[4]);
                    $session_no = $sess[0];
                    
                     $data_to_study = array(
                            'study_id' => $study_id,
                            'user_group' => $study[0],
                            'number_of_participants' => $study[1],
                            'payment_amount' => $study[2],
                            'training' => $study[3],
                            'number_of_sessions' => $session_no
                             );
                     
                     $success = $this->db->insert('study_user_groups', $data_to_study);
                     $last_insert_study_group_id =  $this->db->insert_id(); 
                     
                     // this section is user to inser recordin to study group session table
                     $sess_time = array();
                     $sess_time = $sessiontime[$j];
                   
                     for($i = 0 ; $i<count($sess_time) ; $i++)
                     {
                         if($sess_time[$i] != ''){
                             $data_to_session = array(
                            'study_id' => $study_id,
                            'study_user_group' => $last_insert_study_group_id,
                            'session_order' => $session_no,
                            'session_time' => $sess_time[$i]
                             );
                    
                            $success = $this->db->insert('study_group_sessions', $data_to_session);
                         }
                         
                     }
                  $j++;   
                }  
            } // study group array
            
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    
     /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    //function autosave_record($data ,$medicalarray ,$occupationarray , $classificationarray , $photologarray)
    function autosave_record($data , $product_name , $product_name_other , $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
    {
	
        $success = FALSE;  

        //Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
                  
        //if lead source is other insert value intio load sources table
        if($product_name == 'other')
        {
            
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('product_name', $product_name_other);
            $query = $this->db->get();
           
        
            
            if ($query->num_rows() == 0) {
            
                
                    $product_val = array(
                            'product_type_id' => $data['product_type'],
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
            
        }    
        else{
            
            $product_id = $product_name;
        }
        
        $data['product_name'] = $product_id;
        
        
        $this->db->select('*');
        $this->db->from('studies_autosave');
        $this->db->where('user_id',$user_id );
        $query = $this->db->get();
        $studies =  $query->result_array(); 
		return $studies; die("ok");
 
		//If there is already an autosave record
        if($query->num_rows() > 0)
        {
			$autosave_id = $studies[0]'study_id'];

        // update record in studies_autosave
           $this->db->where('user_id', $user_id);
           $success = $this->db->update('studies_autosave', $data);
           //echo $this->db->last_query();
           
           $study_autosave_id = $studies[0]['study_id'];
   
            //insert record into location table.
            if (!empty($locationarray)) {
                 //first delete all record from relvant participant id
                $success = $this->db->delete('study_locations_autosave', array('study_id' => $study_autosave_id));
                
                foreach($locationarray as $val){
                     $data_to_loc = array(
                            'study_id' => $study_autosave_id,
                            'location_id' => $val
                             );
                     
                     $success = $this->db->insert('study_locations_autosave', $data_to_loc);
                     
                }  
            }
            else{
                
                $success = $this->db->delete('study_locations_autosave', array('study_id' => $study_autosave_id));
            }
            
            //update record into occupation.
            if (!empty($dnq_studyarray)) {
                 //first delete all record from relvant participant id
                $success = $this->db->delete('study_dnq_autosave', array('study_id' => $study_autosave_id));
                
                //add record in the form of insertion
                foreach($dnq_studyarray as $val){
                     $data_to_study = array(
                            'study_id' => $study_autosave_id,
                            'dnq_study_id' => $val
                             );
                     
                     $success = $this->db->insert('study_dnq_autosave', $data_to_study);
                     
                }  
            }else{
                $success = $this->db->delete('study_dnq_autosave', array('study_id' => $study_autosave_id)); 
            }    
           
     
             //update record into study user group.
            if (!empty($study_group_array)) {
                
                //first delete all record from relvant participant id
                $success = $this->db->delete('study_user_groups_autosave', array('study_id' => $study_autosave_id));
                $success = $this->db->delete('study_group_sessions_autosave', array('study_id' => $study_autosave_id));
                
                    //echo '<pre>';
                    // print_r($study_group_array);
                  $j = 1;   
                //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $study = explode('_', $val);
                    
                    $sess = explode('_', $study[4]);
                    $session_no = $sess[0];
                    
                     $data_to_study = array(
                            'study_id' => $study_autosave_id,
                            'user_group' => $study[0],
                            'number_of_participants' => $study[1],
                            'payment_amount' => $study[2],
                            'training' => $study[3],
                            'number_of_sessions' => $session_no
                             );
                     
                     $success = $this->db->insert('study_user_groups_autosave', $data_to_study);
                     $last_insert_study_group_id =  $this->db->insert_id(); 
                     
                     // this section is user to inser recordin to study group session table
                     $sess_time = array();
                     $sess_time = $sessiontime[$j];
                     
                     for($i = 0 ; $i<count($sess_time) ; $i++)
                     {
                         if($sess_time[$i] != ''){
                             $data_to_session = array(
                            'study_id' => $study_autosave_id,
                            'study_user_group' => $last_insert_study_group_id,
                            'session_order' => $session_no,
                            'session_time' => $sess_time[$i]
                             );
                    
                            $success = $this->db->insert('study_group_sessions_autosave', $data_to_session);
                         }
                         
                     }
                    
                     $j++;
                }  
            }else{
                $success = $this->db->delete('study_user_groups_autosave', array('study_id' => $study_autosave_id));
                $success = $this->db->delete('study_group_sessions_autosave', array('study_id' => $study_autosave_id));
            } 
              
        }

		//If no previous autosave record...
		else
		{
			//insert record into participant_autosave table
            $success = $this->db->insert('studies_autosave', $data);
            $last_insert_id =  $this->db->insert_id(); 
            //echo $this->db->last_query();
        
            
			//insert record into location table.
            if (!empty($locationarray)) 
			{
                foreach($locationarray as $val){
                     $data_to_loc = array(
                            'study_id' => $last_insert_id,
                            'location_id' => $val
                             );
                     
                     $success = $this->db->insert('study_locations_autosave', $data_to_loc);
                     
                }  
            }
            
            //update record into dnq
            if (!empty($dnq_studyarray)) 
			{
                //add record in the form of insertion
                foreach($dnq_studyarray as $val){
                     $data_to_study = array(
                            'study_id' => $last_insert_id,
                            'dnq_study_id' => $val
                             );
                     
                     $success = $this->db->insert('study_dnq_autosave', $data_to_study);
                     
                }  
            }    
      
            //update record into study_user_groups_autosave.
            if (!empty($study_group_array)) 
			{
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $study = explode('_', $val);
                    
                    $sess = explode('_', $study[4]);
                    $session_no = $sess[0];
                    
                     $data_to_study = array(
                            'study_id' => $last_insert_id,
                            'user_group' => $study[0],
                            'number_of_participants' => $study[1],
                            'payment_amount' => $study[2],
                            'training' => $study[3],
                            'number_of_sessions' => $session_no
                             );
                     
                     $success = $this->db->insert('study_user_groups_autosave', $data_to_study);
                     $last_insert_study_group_id =  $this->db->insert_id(); 
                     
                     // this section is user to inser recordin to study group session table
                     $sess_time = array();
                     $sess_time = $sessiontime[$j];
                   
                     for($i = 0 ; $i<count($sess_time) ; $i++)
                     {
                         if($sess_time[$i] != ''){
                             $data_to_session = array(
                            'study_id' => $last_insert_id,
                            'study_user_group' => $last_insert_study_group_id,
                            'session_order' => $session_no,
                            'session_time' => $sess_time[$i]
                             );
                    
                            $success = $this->db->insert('study_group_sessions_autosave', $data_to_session);
                         }
                         
                     }
                  $j++;   
                }  
            } // study group array
              
        }
        
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
       
	   $success = $this->db->delete('studies', array('study_id' => $id));
	      
		return $success;
	
	}
	
}
?>	
