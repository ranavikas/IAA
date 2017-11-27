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
    * Get user by his is
    * @param int $id 
    * @return array
    */
    public function get_record_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('participants');
		$this->db->where('participant_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function count_record_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('participants');
		$this->db->where('participant_id', $id);
		$query = $this->db->get();
		return $query->num_rows();
    }
    
    
     public function count_autosave_record_by_userid($user_id)
    {
		$this->db->select('*');
		$this->db->from('participants_autosave');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->num_rows();   
    }
    
    public function get_autosave_record_by_userid($user_id)
    {
		$this->db->select('*');
		$this->db->from('participants_autosave');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    
    public function get_edu_parent($edu_id)
    {
		$this->db->select('parent_education_level');
		$this->db->from('education_status');
		$this->db->where('id', $edu_id);
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
		$this->db->from('participants');
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
     public function get_screene_questions()
    {
		$this->db->select('screener_questions.id, screener_questions.question , screener_questions.question_type');
		$this->db->from('screener_questions');
                
		$this->db->order_by('id', 'Asc');
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    

    public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('participants.participant_id, participants.firstname , participants.middlename ,participants.lastname ,participants.age ,participants.employer ,classifications.classification, genders.gender ,  education_status.education_level ,participants.occupation  , participants.phone , participants.alternate_phone , participants.city , participants.state , participants.do_not_call , participants.do_not_email , participants.decreased ');
		$this->db->from('participants');
                $this->db->join('genders', 'participants.gender = genders.gender_id', 'left');
                $this->db->join('education_status', 'participants.education = education_status.id', 'left');
                $this->db->join('classifications', 'participants.classification = classifications.classification_id', 'left');
                
                if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('participant_id', $order_type);
		}
                
		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    
    public function get_search_records($posted)
    {
           
                //echo '<pre>';
                //print_r($posted);
                //die(); 
        
		$this->db->select('*');
		$this->db->from('vw_participant_search');
               
                if($posted['select_screen_question'] != '')
                {    
                    $question = $posted['select_screen_question'];
                    $question_val = explode(',',$question);
                    
                    $this->db->where_in("vw_participant_search.screener_question", $question_val);
                  
                }
                
                if($posted['medical_condition'] != 'null')
                {    
                    $medical = $posted['medical_condition'];
                    $medical_val = explode(',',$medical);
                    
                    $this->db->where_in("vw_participant_search.medical_condition", $medical_val);
                  
                }
                
                
                if($posted['general'] != 'null')
                {    
                    $user_group = $posted['general'];
                    $user_group_val = explode(',',$user_group);
                    
                    $this->db->where_in("vw_participant_search.usergroup_id", $user_group_val);
                  
                }
                
                if($posted['occupation'] != 'null')
                {    
                    $occupation = $posted['occupation'];
                    $occupation_val = explode(',',$occupation);
                    
                    $this->db->where_in("vw_participant_search.occupation_id", $occupation_val);
                  
                }
               
                if($posted['gender'] != '')
                {
                    $this->db->where('vw_participant_search.gender', $posted['gender']);
                }
                
                if($posted['minage'] != '')
                {
                    $this->db->where('vw_participant_search.age >=', $posted['minage']);
                }
                
                if($posted['maxage'] != '')
                {
                    $this->db->where('vw_participant_search.age <=', $posted['maxage']);
                }
                
                if($posted['edulevel'] != '')
                {
                    $this->db->where('vw_participant_search.education', $posted['edulevel']);
                }
                
                if($posted['ethnicity'] != 'undefined' && $posted['ethnicity'] != '' )
                {
                     $this->db->where('vw_participant_search.ethnicity', $posted['ethnicity']);
                }
                
                
                if($posted['employer'] != 'undefined' && $posted['employer'] != '' )
                {
                     $this->db->where('vw_participant_search.employer', $posted['employer']);
                }
                
                if($posted['city'] != 'undefined' && $posted['city'] != '' )
                {
                     $this->db->where('vw_participant_search.city', $posted['city']);
                }
                
                if($posted['zip'] != 'undefined' && $posted['zip'] != '' )
                {
                     $this->db->where('vw_participant_search.zip', $posted['zip']);
                }
                
                
                if($posted['transport'] != 'undefined' && $posted['transport'] != '' )
                {
                     $this->db->where('vw_participant_search.transportation', $posted['transport']);
                }
                
                if($posted['esl'] != 'undefined' && $posted['esl'] != '' )
                {
                     $this->db->where('vw_participant_search.esl', $posted['esl']);
                }
                
                if($posted['need_wheelchair'] != 'undefined' && $posted['need_wheelchair'] != '' )
                {
                     $this->db->where('vw_participant_search.need_wheelchair', $posted['need_wheelchair']);
                }
                
                
                if($posted['deceased'] != 'undefined' &&  $posted['deceased'] != '' )
                {
                     $this->db->where('vw_participant_search.decreased', $posted['deceased']);
                }
                
                if($posted['do_not_call'] != 'undefined' &&  $posted['do_not_call'] != '' )
                {
                     $this->db->where('vw_participant_search.do_not_call', $posted['do_not_call']);
                }
                
                if($posted['do_not_email'] != 'undefined' &&  $posted['do_not_email'] != '' )
                {
                     $this->db->where('vw_participant_search.do_not_email', $posted['do_not_email']);
                }
              
                
                if($posted['participant_classfication'] != 'undefined' && $posted['participant_classfication'] != '' )
                {
                     $this->db->where('vw_participant_search.classification', $posted['participant_classfication']);
                }
                
                $this->db->order_by('participant_id', 'Asc');
                
		
		$query = $this->db->get();
		
                //echo $this->db->last_query();
		return $query->result_array(); 
    }
    
    
    public function get_csv_records()
    {
	    
		$this->db->select('participants.participant_id, participants.dob , participants.employer ,participants.email ,participants.alternate_email ,participants.zip ,participants.transportation,participants.esl,participants.need_wheelchair,participants.do_not_call,participants.do_not_email,participants.decreased,participants.photo_src,ethnicities.ethnicity,classifications.classification');
		$this->db->from('participants');
                $this->db->join('ethnicities', 'participants.ethnicity = ethnicities.ethnicity_id', 'left');
                $this->db->join('classifications', 'participants.classification = classifications.classification_id', 'left');
                
		$this->db->order_by('participant_id', 'Asc');
		
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
  
    /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_record($data ,$parti_occupation ,$parti_employer , $medicalarray ,$occupationarray , $usergrouparray )
    {
	$admin_id = $this->session->userdata('active_user_id');
        
        $participant_id = $this->get_autosave_participant_id($admin_id);
        
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        //first delete all record from aotusave tables
        $this->db->delete('participants_autosave', array('user_id' => $admin_id));
        
        $this->db->delete('participant_conditions_autosave', array('participant_id' => $participant_id));
        $this->db->delete('participant_occupations_autosave',  array('participant_id' => $participant_id));
        $this->db->delete('participant_usergroup_autosave',  array('participant_id' => $participant_id));
        $this->db->delete('participant_photolog_autosave', array('participant_id' => $participant_id));
        
        //add record into partcipant_occupation table
        if($parti_occupation != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_occupations');
            $this->db->where('parti_occupation', $parti_occupation);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_occupation' => $parti_occupation
                    );
                    $success = $this->db->insert('participant_occupations', $parti_val); //store data in to client table
                    $data['occupation'] = $parti_occupation;  
            } else{
                $data['occupation'] = $parti_occupation;
            }
        }    
        else{ $data['occupation'] = ''; }
        
        //add record into partcipant_employer table
        if($parti_employer != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_employers');
            $this->db->where('parti_employer', $parti_employer);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_employer' => $parti_employer
                    );
                    $success = $this->db->insert('participant_employers', $parti_val); //store data in to client table
                    $data['employer'] = $parti_employer;  
            } else{
                $data['employer'] = $parti_employer;
            }
        }    
        else{ $data['employer'] = ''; }
      
        $success = $this->db->insert('participants', $data);
        $last_insert_id =  $this->db->insert_id(); 
        
        //insert record into medical condition.
            if (!empty($medicalarray)) {
                foreach($medicalarray as $val){
                     $data_to_med = array(
                            'participant_id' => $last_insert_id,
                            'medical_condition' => $val
                             );
                     
                     $success = $this->db->insert('participant_conditions_ug', $data_to_med);
                     
                }  
            }
            
            //update record into occupation.
            if (!empty($occupationarray)) {
                //add record in the form of insertion
                foreach($occupationarray as $val){
                     $data_to_occ = array(
                            'participant_id' => $last_insert_id,
                            'occupation_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_occupations_ug', $data_to_occ);
                     
                }  
            }    
            
            
        //update record into classification.
            if (!empty($usergrouparray)) {
                
                //add record in the form of insertion
                foreach($usergrouparray as $val){
                     $data_to_cla = array(
                            'participant_id' => $last_insert_id,
                            'usergroup_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_usergroup_ug', $data_to_cla);
                     
                }  
            }  
     
        
        $this->db->trans_complete();

        return $success;  
        	
    }
    
    
     /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_participant_record($data ,$parti_occupation ,$parti_employer , $medicalarray ,$occupationarray , $usergrouparray , $group_id )
    {
	$admin_id = $this->session->userdata('active_user_id');
        
        $participant_id = $this->get_autosave_participant_id($admin_id);
        
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        //first delete all record from aotusave tables
        $this->db->delete('participants_autosave', array('user_id' => $admin_id));
        
        $this->db->delete('participant_conditions_autosave', array('participant_id' => $participant_id));
        $this->db->delete('participant_occupations_autosave',  array('participant_id' => $participant_id));
        $this->db->delete('participant_usergroup_autosave',  array('participant_id' => $participant_id));
        $this->db->delete('participant_photolog_autosave', array('participant_id' => $participant_id));
        
        
        //add record into partcipant_occupation table
        if($parti_occupation != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_occupations');
            $this->db->where('parti_occupation', $parti_occupation);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_occupation' => $parti_occupation
                    );
                    $success = $this->db->insert('participant_occupations', $parti_val); //store data in to client table
                    $data['occupation'] = $parti_occupation;  
            } else{
                $data['occupation'] = $parti_occupation;
            }
        }    
        else{ $data['occupation'] = ''; }
        
        //add record into partcipant_employer table
        if($parti_employer != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_employers');
            $this->db->where('parti_employer', $parti_employer);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_employer' => $parti_employer
                    );
                    $success = $this->db->insert('participant_employers', $parti_val); //store data in to client table
                    $data['employer'] = $parti_employer;  
            } else{
                $data['employer'] = $parti_employer;
            }
        }    
        else{ $data['employer'] = ''; }
        
        $success = $this->db->insert('participants', $data);
        $last_insert_id =  $this->db->insert_id(); 
        
        if($group_id != '')
        {
          $val = array(
                        'participant_id' => $last_insert_id,
                        'study_user_group' => $group_id,
                        'participant_status' => '1'
                );
                $success = $this->db->insert('study_participants', $val); //store data in to client table       
            
        }    
        
       
        //insert record into medical condition.
            if (!empty($medicalarray)) {
                foreach($medicalarray as $val){
                     $data_to_med = array(
                            'participant_id' => $last_insert_id,
                            'medical_condition' => $val
                             );
                     
                     $success = $this->db->insert('participant_conditions_ug', $data_to_med);
                     
                }  
            }
            
            //update record into occupation.
            if (!empty($occupationarray)) {
                //add record in the form of insertion
                foreach($occupationarray as $val){
                     $data_to_occ = array(
                            'participant_id' => $last_insert_id,
                            'occupation_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_occupations_ug', $data_to_occ);
                     
                }  
            }    
            
            
        //update record into classification.
            if (!empty($usergrouparray)) {
                
                //add record in the form of insertion
                foreach($usergrouparray as $val){
                     $data_to_cla = array(
                            'participant_id' => $last_insert_id,
                            'usergroup_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_usergroup_ug', $data_to_cla);
                     
                }  
            }  
     
        
        $this->db->trans_complete();

        return $success;  
        	
    }
    
      /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function update_record($participant_id , $data ,$parti_occupation ,$parti_employer , $medicalarray ,$occupationarray , $usergrouparray , $photologarray)
    {
        
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        
        $this->db->delete('participant_conditions_ug', array('participant_id' => $participant_id));
        $this->db->delete('participant_occupations_ug',  array('participant_id' => $participant_id));
        $this->db->delete('participant_usergroup_ug',  array('participant_id' => $participant_id));
        $this->db->delete('participant_photolog', array('participant_id' => $participant_id));
        
        
         //add record into partcipant_occupation table
        if($parti_occupation != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_occupations');
            $this->db->where('parti_occupation', $parti_occupation);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_occupation' => $parti_occupation
                    );
                    $success = $this->db->insert('participant_occupations', $parti_val); //store data in to client table
                    $data['occupation'] = $parti_occupation;  
            } else{
                $data['occupation'] = $parti_occupation;
            }
        }    
        else{ $data['occupation'] = ''; }
        
        //add record into partcipant_employer table
        if($parti_employer != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_employers');
            $this->db->where('parti_employer', $parti_employer);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_employer' => $parti_employer
                    );
                    $success = $this->db->insert('participant_employers', $parti_val); //store data in to client table
                    $data['employer'] = $parti_employer;  
            } else{
                $data['employer'] = $parti_employer;
            }
        }    
        else{ $data['employer'] = ''; }
        
      
        $this->db->where('participant_id', $participant_id);
        $success = $this->db->update('participants', $data);
        
        
        //insert record into medical condition.
            if (!empty($medicalarray)) {
                foreach($medicalarray as $val){
                     $data_to_med = array(
                            'participant_id' => $participant_id,
                            'medical_condition' => $val
                             );
                     
                     $success = $this->db->insert('participant_conditions_ug', $data_to_med);
                     
                }  
            }
            
            //update record into occupation.
            if (!empty($occupationarray)) {
                //add record in the form of insertion
                foreach($occupationarray as $val){
                     $data_to_occ = array(
                            'participant_id' => $participant_id,
                            'occupation_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_occupations_ug', $data_to_occ);
                     
                }  
            }    
            
            
        //update record into classification.
            if (!empty($usergrouparray)) {
                
                //add record in the form of insertion
                foreach($usergrouparray as $val){
                     $data_to_cla = array(
                            'participant_id' => $participant_id,
                            'usergroup_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_usergroup_ug', $data_to_cla);
                     
                }  
            }  
            
            //insert record into photolog.
            if (!empty($photologarray)) {
                
                
                //add record in the form of insertion
                foreach($photologarray as $val){
                    
                    $photolog = explode('_', $val);
                    
                     $data_to_pho = array(
                            'participant_id' => $participant_id,
                            'notes' => $photolog[0],
                            'status' => $photolog[1],
                            'study' => $photolog[2],
                            'datee' => $photolog[3]
                             );
                     
                     $success = $this->db->insert('participant_photolog', $data_to_pho);
                     
                }  
            } 
            
            
        
        $this->db->trans_complete();

        return $success;  
        	
    }
    
    
     /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function autosave_record($data , $parti_occupation ,$parti_employer , $medicalarray ,$occupationarray , $usergrouparray )
    {
	
       echo '<pre>'; 
       print_r($data);
        
        // $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	//$this->db->trans_start();
        
        //add record into partcipant_occupation table
        if($parti_occupation != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_occupations');
            $this->db->where('parti_occupation', $parti_occupation);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_occupation' => $parti_occupation
                    );
                    $success = $this->db->insert('participant_occupations', $parti_val); //store data in to client table
                    $data['occupation'] = $parti_occupation;  
            } else{
                $data['occupation'] = $parti_occupation;
            }
        }    
        else{ $data['occupation'] = ''; }
        
        //add record into partcipant_employer table
        if($parti_employer != '')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('participant_employers');
            $this->db->where('parti_employer', $parti_employer);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
               //if value not exist then insert value
                    $parti_val = array(
                            'parti_employer' => $parti_employer
                    );
                    $success = $this->db->insert('participant_employers', $parti_val); //store data in to client table
                    $data['employer'] = $parti_employer;  
            } else{
                $data['employer'] = $parti_employer;
            }
        }    
        else{ $data['employer'] = ''; }
        
        
       $admin_id = $this->session->userdata('active_user_id');
        
        $this->db->select('*');
        $this->db->from('participants_autosave');
        $this->db->where('user_id',$admin_id );
        $query = $this->db->get();
        $participant =  $query->result_array(); 
        
        
        if($query->num_rows() > 0)
        {
        
        // update record in participants_autosave
           $this->db->where('user_id', $admin_id);
           $success = $this->db->update('participants_autosave', $data);
           //echo $this->db->last_query();
           
           $participant_autosave_id = $participant[0]['participant_autosave_id'];
        //update record into medical condition.
            if (!empty($medicalarray)) {
                
                //first delete all record from relvant participant id
                $success = $this->db->delete('participant_conditions_autosave', array('participant_id' => $participant_autosave_id));
                //add record in the form of insertion
                foreach($medicalarray as $val){
                     $data_to_med = array(
                            'participant_id' => $participant_autosave_id,
                            'medical_condition' => $val
                             );
                     
                     $success = $this->db->insert('participant_conditions_autosave', $data_to_med);
                     
                }  
            }else{
                $success = $this->db->delete('participant_conditions_autosave', array('participant_id' => $participant_autosave_id));
            }
            
            
            
            
         //update record into occupation.
            if (!empty($occupationarray)) {
                
                //first delete all record from relvant participant id
                $success = $this->db->delete('participant_occupations_autosave', array('participant_id' => $participant_autosave_id));
                //add record in the form of insertion
                foreach($occupationarray as $val){
                     $data_to_occ = array(
                            'participant_id' => $participant_autosave_id,
                            'occupation_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_occupations_autosave', $data_to_occ);
                     
                }  
            } else{
                $success = $this->db->delete('participant_occupations_autosave', array('participant_id' => $participant_autosave_id));
            }   
            
            
        //update record into classification.
            if (!empty($usergrouparray)) {
                
                //first delete all record from relvant participant id
                $success = $this->db->delete('participant_usergroup_autosave', array('participant_id' => $participant_autosave_id));
                //add record in the form of insertion
                foreach($usergrouparray as $val){
                     $data_to_cla = array(
                            'participant_id' => $participant_autosave_id,
                            'usergroup_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_usergroup_autosave', $data_to_cla);
                     
                }  
            }else{
                $success = $this->db->delete('participant_usergroup_autosave', array('participant_id' => $participant_autosave_id));
            } 
            
     
            
            
            
        }else{
        //insert record into participant_autosave table
            $success = $this->db->insert('participants_autosave', $data);
            $last_insert_id =  $this->db->insert_id(); 
            //echo $this->db->last_query();
            
        //insert record into medical condition.
            if (!empty($medicalarray)) {
                foreach($medicalarray as $val){
                     $data_to_med = array(
                            'participant_id' => $last_insert_id,
                            'medical_condition' => $val
                             );
                     
                     $success = $this->db->insert('participant_conditions_autosave', $data_to_med);
                     
                }  
            }
            
            //update record into occupation.
            if (!empty($occupationarray)) {
                //add record in the form of insertion
                foreach($occupationarray as $val){
                     $data_to_occ = array(
                            'participant_id' => $last_insert_id,
                            'occupation_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_occupations_autosave', $data_to_occ);
                     
                }  
            }    
            
            
        //update record into classification.
            if (!empty($usergrouparray)) {
                
                //add record in the form of insertion
                foreach($usergrouparray as $val){
                     $data_to_cla = array(
                            'participant_id' => $last_insert_id,
                            'usergroup_id' => $val
                             );
                     
                     $success = $this->db->insert('participant_usergroup_autosave', $data_to_cla);
                     
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
       
	   $success = $this->db->delete('participants', array('participant_id' => $id));
	      
		return $success;
	
	}
        
        
        
    public function get_gender()
    {
        $this->db->select('*');
        $this->db->from('genders');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function get_ethnicity()
    {
        $this->db->select('*');
        $this->db->from('ethnicities');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_occupation()
    {
        $this->db->select('*');
        $this->db->from('occupations');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_parti_occupation()
    {
        $this->db->select('*');
        $this->db->from('participant_occupations');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
     public function get_parti_employer()
    {
        $this->db->select('*');
        $this->db->from('participant_employers');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_part_classification()
    {
        $this->db->select('*');
        $this->db->from('classifications');
        $query = $this->db->get();
        return $query->result_array(); 
    }
        
        
    public function get_education_level()
    {
        $this->db->select('*');
        $this->db->from('education_status');
        $this->db->where('parent_education_level', NUll);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function get_education_sublevel($id)
    {
        $this->db->select('*');
        $this->db->from('education_status');
        $this->db->where('parent_education_level', $id);
        $query = $this->db->get();
        return $query;
        //return $query->result_array();  
        
    }
    
    
    public function get_medical_condition()
    {
        $this->db->select('*');
        $this->db->from('medical_conditions');
        $this->db->where('record_status', 1);
        $query = $this->db->get();
       return $query->result_array();         
    }
    
    
    public function get_classification()
    {
        $this->db->select('*');
        $this->db->from('classifications');
        $query = $this->db->get();
       return $query->result_array();         
    }
    
     public function get_user_group()
    {
        $this->db->select('*');
        $this->db->from('user_groups');
        $query = $this->db->get();
       return $query->result_array();         
    }
    
    
    public function get_autosave_participant_id($admin_id)
    {
        $this->db->select('*');
        $this->db->from('participants_autosave');
        $this->db->where('user_id',$admin_id );
        $query = $this->db->get();
        $participant =  $query->result_array();  
        $participant_autosave_id = $participant[0]['participant_autosave_id'];
        
        return $participant_autosave_id;
    }
    
    public function get_autosave_medical($participant_id)
    {
        $this->db->select('medical_condition');
        $this->db->from('participant_conditions_autosave');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'medical_condition'); 
           
    }
    
    
    public function get_autosave_usergroup($participant_id)
    {
        $this->db->select('usergroup_id');
        $this->db->from('participant_usergroup_autosave');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'usergroup_id'); 
                
    }
        
    public function get_autosave_occupation($participant_id)
    {
        $this->db->select('occupation_id');
        $this->db->from('participant_occupations_autosave');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
       return array_column($query->result_array(),'occupation_id');
    }
    
    
    public function get_autosave_photolog($participant_id)
    {
        
        $this->db->select('*');
        $this->db->from('participant_photolog_autosave');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
       return $query->result_array();     
    }
    
       
    public function get_participant_classification($participant_id)
    {
        $this->db->select('classification_id');
        $this->db->from('participant_classifications_ug');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'classification_id'); 
                
    }
    
    //for edit participant
    
     public function get_participant_medical($participant_id)
    {
        $this->db->select('medical_condition');
        $this->db->from('participant_conditions_ug');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'medical_condition'); 
           
    }

    
    public function get_participant_usergroup($participant_id)
    {
        $this->db->select('usergroup_id');
        $this->db->from('participant_usergroup_ug');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'usergroup_id'); 
                
    }
    
        
    public function get_participant_occupation($participant_id)
    {
        $this->db->select('occupation_id');
        $this->db->from('participant_occupations_ug');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
       return array_column($query->result_array(),'occupation_id');
    }
    
    
    
     //for cvs file download user group
    
     public function get_participant_medical_name($participant_id)
    {
        $this->db->select('medical_conditions.medical_condition');
        $this->db->from('medical_conditions');
        $this->db->join('participant_conditions_ug', 'medical_conditions.id = participant_conditions_ug.medical_condition', 'right');   
        $this->db->where('participant_conditions_ug.participant_id', $participant_id);
        $query = $this->db->get();
        //return $query->result_array();    
        return array_column($query->result_array(),'medical_condition'); 
           
    }

    
    
    public function get_participant_usergroup_name($participant_id)
    {
        $this->db->select('user_groups.group_name');
        $this->db->from('user_groups');
        $this->db->join('participant_usergroup_ug', 'user_groups.id = participant_usergroup_ug.usergroup_id', 'right');      
        $this->db->where('participant_usergroup_ug.participant_id', $participant_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'group_name'); 
                
    }
    
        
    public function get_participant_occupation_name($participant_id)
    {
        $this->db->select('occupations.occupation');
        $this->db->from('occupations');
        $this->db->join('participant_occupations_ug', 'occupations.id = participant_occupations_ug.occupation_id', 'right');  
        $this->db->where('participant_occupations_ug.participant_id', $participant_id);
        $query = $this->db->get();
       return array_column($query->result_array(),'occupation');
    }
    
    
    
    
    
    
    public function get_participant_photolog($participant_id)
    {
        
        $this->db->select('*');
        $this->db->from('participant_photolog');
        $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
       return $query->result_array();     
    }
    
    public function get_participant_notes($participant_id)
    {
        
        $this->db->select('study_participant_status.status , studies.study_notes ,studies.study_number , studies.created  , studies.noted_last_modified , studies_view.study_id , studies_view.client_name , studies_view.product_name , studies_view.study_type');
        $this->db->from('study_participants');
        $this->db->join('study_participant_status', 'study_participants.participant_status = study_participant_status.id', 'left');
        $this->db->join('study_user_groups', 'study_participants.study_user_group = study_user_groups.id', 'left');
        $this->db->join('studies', 'study_user_groups.study_id = studies.study_id', 'left');
        $this->db->join('studies_view', 'studies.study_id = studies_view.study_id', 'left');
          
         $this->db->where('participant_id', $participant_id);
        $query = $this->db->get();
       return $query->result_array();     
    }
    
    
    public function get_study_participant_status()
    {
        $this->db->select('*');
        $this->db->from('study_participant_status');
        $query = $this->db->get();
        return $query->result_array(); 
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
