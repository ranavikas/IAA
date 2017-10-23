<?php class Questions_model extends CI_Model {
 
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
		$this->db->from('screener_questions');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    
    public function get_question_options($id)
    {
        $this->db->select('option');
        $this->db->from('screener_question_options');
        $this->db->where('screener_question', $id);
        $query = $this->db->get();
       return array_column($query->result_array(),'option');
    }
    
    
     /**
    * Count the number of rows
    * @return int
    */
    function count_records()
    {
		$this->db->select('*');
		$this->db->from('screener_questions');
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    

    public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('screener_questions');
                
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
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_record($data , $question_option)
    {
	
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        $success = $this->db->insert('screener_questions', $data);
        $last_insert_id =  $this->db->insert_id();
        
        if($this->input->post('question_type') != 3)
        {    
            //update record into occupation.
            if (!empty($question_option)) {
                //add record in the form of insertion
                $num = 1;
                foreach($question_option as $val){

                        $data_to_occ = array(
                            'screener_question' => $last_insert_id,
                            'option' => $val,
                            'order' => $num
                             );
                        $success = $this->db->insert('screener_question_options', $data_to_occ);

                    $num++;
                }  
            } 
        }
        
        $this->db->trans_complete();
        return $success;  
        	
    }

    
    
    /**
    * Update user
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_record($id, $data , $question_option)
    {
		
         $success = FALSE;
        //Run these queries as a transaction, we want to make sure we do all or nothing
            $this->db->trans_start();
            
            $this->db->delete('screener_question_options', array('screener_question' => $id));
            
            
            
            $this->db->where('id', $id);
            $success = $this->db->update('screener_questions', $data);
            
            if($this->input->post('question_type') != 3)
            {    
                //update record into occupation.
                if (!empty($question_option)) {
                    //add record in the form of insertion
                    $num = 1;
                    foreach($question_option as $val){

                            $data_to_occ = array(
                                'screener_question' => $id,
                                'option' => $val,
                                'order' => $num
                                 );
                            $success = $this->db->insert('screener_question_options', $data_to_occ);

                        $num++;
                    }  
                } 
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
       
	   $success = $this->db->delete('screener_questions', array('id' => $id));
	      
		return $success;
	
	}
        
        
    function question_exist($question)
    {
	$this->db->where('question', $question);
        $query = $this->db->get('screener_questions');
        // echo $this->db->last_query();
        return $query->num_rows();
		
    }
	
}
?>	
