<?php class Studies_model extends CI_Model {
 
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
        $this->db->from('studies');
        $query = $this->db->get();
        return $query->num_rows();        
    }
    
    

    public function get_records($study_year , $client_ids, $product_ids, $product_type, $study_status , $study_location, $order='Asc')
    {
                $this->db->distinct();
		$this->db->select('studies.study_id , studies.study_number , studies.start_date , studies.end_date , clients.client_name , products.product_name , product_types.product_type , study_types.study_type , study_status.status_name');
		$this->db->from('studies');
                $this->db->join('clients', 'studies.client_id = clients.client_id', 'left');
                $this->db->join('products', 'studies.product_name = products.product_id', 'left');
                $this->db->join('product_types', 'studies.product_type = product_types.id', 'left');
                $this->db->join('study_types', 'studies.study_type = study_types.id', 'left');
                $this->db->join('study_status', 'studies.study_status = study_status.id', 'left');
                $this->db->join('study_locations', 'studies.study_id = study_locations.study_id', 'left');
                 
               
                if($study_year != '')
                {    
                    $study_year_mon_day = $study_year.'-12'.'-30';
                    $this->db->where('studies.start_date <=', $study_year_mon_day);
                }
                
                
                if ($client_ids) {
                    $this->db->where_in("studies.client_id", $client_ids);
                }
                
                if ($product_ids) {
                    $this->db->where_in("studies.product_name", $product_ids);
                }
                
                if ($product_type) {
                    $this->db->where_in("studies.product_type", $product_type);
                }
                
                if ($study_status) {
                    $this->db->where_in("studies.study_status", $study_status);
                }
                
                if ($study_location) {
                    $this->db->where_in("study_locations.location_id", $study_location);
                }
                
                $this->db->order_by('study_id', $order);
                
		
		$query = $this->db->get();
		
               // echo $this->db->last_query();
		return $query->result_array(); 	
    }
    
    
    public function get_filter_records($filter_type , $filter_val)
    {
                $this->db->distinct();
		$this->db->select('studies.study_id , studies.study_number , studies.start_date , studies.end_date , clients.client_name , products.product_name , product_types.product_type , study_types.study_type , study_status.status_name');
		$this->db->from('studies');
                $this->db->join('clients', 'studies.client_id = clients.client_id', 'left');
                $this->db->join('products', 'studies.product_name = products.product_id', 'left');
                $this->db->join('product_types', 'studies.product_type = product_types.id', 'left');
                $this->db->join('study_types', 'studies.study_type = study_types.id', 'left');
                $this->db->join('study_status', 'studies.study_status = study_status.id', 'left');
                $this->db->join('study_locations', 'studies.study_id = study_locations.study_id', 'left');
                 
               
                if($filter_type == 1)
                {    
                    $study_year_mon_day_start = $filter_val.'-01'.'-01';
                    $study_year_mon_day_end = $filter_val.'-12'.'-30';
                     
                    $this->db->where('studies.start_date >=', $study_year_mon_day_start);
                    $this->db->where('studies.start_date <=', $study_year_mon_day_end);
                }
                
                if($filter_type == 2)
                {    
                    if($filter_val != 'null')
                    {   
                        $clientarray = explode(',', $filter_val);
                        if (!empty($clientarray)){ 
                        $this->db->where_in("studies.client_id", $clientarray);
                        }
                        
                    }
                }
                
                if($filter_type == 3)
                {    
                    if($filter_val != 'null')
                    {   
                        $productnamearray = explode(',', $filter_val);
                        if (!empty($productnamearray)){ 
                        $this->db->where_in("studies.product_name", $productnamearray);
                        }
                        
                    }
                }
               
                
                if($filter_type == 4)
                {    
                    if($filter_val != 'null')
                    {   
                        $producttypearray = explode(',', $filter_val);
                        if (!empty($producttypearray)){ 
                        $this->db->where_in("studies.product_type", $producttypearray);
                        }
                        
                    }
                }
                
                if($filter_type == 5)
                {    
                    if($filter_val != 'null')
                    {   
                        $studystatusarray = explode(',', $filter_val);
                        if (!empty($studystatusarray)){ 
                        $this->db->where_in("studies.study_status", $studystatusarray);
                        }
                        
                    }
                }
                
                if($filter_type == 6)
                {    
                    if($filter_val != 'null')
                    {   
                        $studylocationsarray = explode(',', $filter_val);
                        if (!empty($studylocationsarray)){ 
                        $this->db->where_in("study_locations.location_id", $studylocationsarray);
                        }
                        
                    }
                }
                
                $this->db->order_by('study_id', 'Asc');
                
		
		$query = $this->db->get();
		
                //echo $this->db->last_query();
		return $query->result_array(); 	
    }
    
    
    public function get_records_usergroup()
    {
                $this->db->distinct();
		$this->db->select('studies.study_id , studies.study_number ,  clients.client_name , products.product_name , study_types.study_type ');
		$this->db->from('studies');
                $this->db->join('clients', 'studies.client_id = clients.client_id', 'left');
                $this->db->join('products', 'studies.product_name = products.product_id', 'left');
                $this->db->join('study_types', 'studies.study_type = study_types.id', 'left');              
                
                $this->db->order_by('study_id', 'Asc');		
		$query = $this->db->get();
		
               // echo $this->db->last_query();
		return $query->result_array(); 	
    }
    
    
    public function get_study_usergroup($study_id)
    {
                
		$this->db->select('study_user_groups.id ,multi_usergroup.group_name ');
		$this->db->from('study_user_groups');
                $this->db->join('multi_usergroup', 'study_user_groups.user_group = multi_usergroup.id', 'join');             
                $this->db->where('study_id', $study_id);
                $this->db->order_by('study_id', 'Asc');		
		$query = $this->db->get();
		
               // echo $this->db->last_query();
		return $query->result_array(); 	
    }
    
    
    
     public function get_records_potential($study_id)
    {
                $this->db->distinct();
		$this->db->select('studies.study_id , studies.study_number ,  clients.client_name , products.product_name , study_types.study_type ');
		$this->db->from('studies');
                $this->db->join('clients', 'studies.client_id = clients.client_id', 'left');
                $this->db->join('products', 'studies.product_name = products.product_id', 'left');
                $this->db->join('study_types', 'studies.study_type = study_types.id', 'left');              
                 $this->db->where('study_id', $study_id);
                $this->db->order_by('study_id', 'Asc');		
		$query = $this->db->get();
		
               // echo $this->db->last_query();
		return $query->result_array(); 	
    }
    
    
    public function get_usergroup_potential($study_id)
    {
                
		$this->db->select('study_user_groups.id , study_user_groups.number_of_participants ,multi_usergroup.group_name ');
		$this->db->from('study_user_groups');
                $this->db->join('multi_usergroup', 'study_user_groups.user_group = multi_usergroup.id', 'join');             
                $this->db->where('study_id', $study_id);
                $this->db->order_by('study_id', 'Asc');		
		$query = $this->db->get();
		
               // echo $this->db->last_query();
		return $query->result_array(); 	
    }
    
    
    
    public function get_usergroup_participant( $user_group_id)
    {
	    
		$this->db->select('participants.participant_id, participants.firstname , participants.middlename ,participants.lastname ,participants.age ,participants.employer ,participants.classification, genders.gender ,  ethnicities.ethnicity ,occupations.occupation , study_participant_status.status ,study_participants.participant_status as study_participant_status');
		$this->db->from('study_participants');
                $this->db->join('participants', 'study_participants.participant_id = participants.participant_id', 'join');
                $this->db->join('genders', 'participants.gender = genders.gender_id', 'left');
                $this->db->join('ethnicities', 'participants.ethnicity = ethnicities.ethnicity_id', 'left');
                $this->db->join('occupations', 'participants.occupation = occupations.id', 'left');
                $this->db->join('study_participant_status', 'study_participants.participant_status = study_participant_status.id', 'left');
                $this->db->where('study_participants.study_user_group', $user_group_id);
                $this->db->where_in('study_participants.participant_status', array('1','2','3','4','5'));   
		$this->db->order_by('participant_id', 'Asc');
		
                
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_usergroup_scheduled( $user_group_id)
    {
	    
		$this->db->select('participants.participant_id, participants.firstname , participants.middlename ,participants.lastname ,participants.age ,participants.employer ,participants.classification, genders.gender ,  ethnicities.ethnicity ,occupations.occupation , study_participant_status.status ,study_participants.participant_status as study_participant_status');
		$this->db->from('study_participants');
                $this->db->join('participants', 'study_participants.participant_id = participants.participant_id', 'join');
                $this->db->join('genders', 'participants.gender = genders.gender_id', 'left');
                $this->db->join('ethnicities', 'participants.ethnicity = ethnicities.ethnicity_id', 'left');
                $this->db->join('occupations', 'participants.occupation = occupations.id', 'left');
                $this->db->join('study_participant_status', 'study_participants.participant_status = study_participant_status.id', 'left');
                $this->db->where('study_participants.study_user_group', $user_group_id);
                $this->db->where_in('study_participants.participant_status', array('4' ,'5' ,'8'));   
		$this->db->order_by('participant_id', 'Asc');
		
                
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_usergroup_demographic( $user_group_id)
    {
	    
		$this->db->select('participants.participant_id, participants.firstname , participants.middlename ,participants.lastname ,participants.age ,participants.employer ,participants.classification, genders.gender ,  ethnicities.ethnicity ,occupations.occupation , study_participant_status.status ,study_participants.participant_status as study_participant_status');
		$this->db->from('study_participants');
                $this->db->join('participants', 'study_participants.participant_id = participants.participant_id', 'join');
                $this->db->join('genders', 'participants.gender = genders.gender_id', 'left');
                $this->db->join('ethnicities', 'participants.ethnicity = ethnicities.ethnicity_id', 'left');
                $this->db->join('occupations', 'participants.occupation = occupations.id', 'left');
                $this->db->join('study_participant_status', 'study_participants.participant_status = study_participant_status.id', 'left');
                $this->db->where('study_participants.study_user_group', $user_group_id);
                $this->db->where_not_in('study_participants.participant_status', array('7'));   
		$this->db->order_by('participant_id', 'Asc');
		
                
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_usergroup_dnq( $user_group_id)
    {
	    
		$this->db->select('participants.participant_id, participants.firstname , participants.middlename ,participants.lastname ,participants.age ,participants.employer ,participants.classification, genders.gender ,  ethnicities.ethnicity ,occupations.occupation , study_participant_status.status ,study_participants.participant_status as study_participant_status , study_user_groups.study_id');
		$this->db->from('study_participants');
                $this->db->join('participants', 'study_participants.participant_id = participants.participant_id', 'join');
                $this->db->join('genders', 'participants.gender = genders.gender_id', 'left');
                $this->db->join('ethnicities', 'participants.ethnicity = ethnicities.ethnicity_id', 'left');
                $this->db->join('occupations', 'participants.occupation = occupations.id', 'left');
                $this->db->join('study_participant_status', 'study_participants.participant_status = study_participant_status.id', 'left');
                $this->db->join('study_user_groups', 'study_participants.study_user_group = study_user_groups.id', 'left');
                $this->db->where('study_participants.study_user_group', $user_group_id);
                $this->db->where_in('study_participants.participant_status', array('7'));   
		$this->db->order_by('participant_id', 'Asc');
		
                
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    
    public function get_usergroup_questions( $user_group_id)
    {
	    
		$this->db->select('screener_questions.id , screener_questions.question, screener_questions.question_type');
		$this->db->from('study_screener_questions');
                $this->db->join('screener_questions', 'study_screener_questions.screener_question = screener_questions.id', 'join');
                $this->db->where('study_screener_questions.study_user_group', $user_group_id);
                
		$this->db->order_by('screener_questions.id', 'Asc');
	
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    
    public function get_usergroup_deomgraphic_questions( $user_group_id)
    {
	    
		$this->db->select('screener_questions.id , screener_questions.question, screener_questions.question_type');
		$this->db->from('study_screener_questions');
                $this->db->join('screener_questions', 'study_screener_questions.screener_question = screener_questions.id', 'join');
                $this->db->where('screener_questions.demographic', 1);
                $this->db->where('study_screener_questions.study_user_group', $user_group_id);
		$this->db->order_by('screener_questions.id', 'Asc');
	
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_question_option($question_id , $question_type , $participant_id , $group_id)
    {
               
		
               if($question_type == 3){
                   $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                    if (!empty($answer)) 
                   $answer_val = $answer['0']['answer'];
                   else
                     $answer_val = '';   
                 
                    if($answer_val != ''){
                    return '<input type="text" name="written-'.$question_id.'-'.$participant_id.'-'.$group_id.'" value="'.$answer_val.'">'; 
                    }else{
                        return '<input type="text" name="written-'.$question_id.'-'.$participant_id.'-'.$group_id.'" value="">'; 
                    }
                    
               } 
               if($question_type == 2){
                   
                    $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                    $answer_val_array = '';
                    if(!empty($answer)){ 
                        $answer_val = $answer['0']['answer'];
                        $answer_val_array = explode(',', $answer_val);
                    }else{
                        $answer_val = '';  
                    }
                    $this->db->select('screener_question_options.option , screener_question_options.order');
                    $this->db->from('screener_question_options');
                    $this->db->where('screener_question_options.screener_question', $question_id);
                    $this->db->order_by('screener_question_options.order', 'Asc');
                    $query = $this->db->get();
                    $result =  $query->result_array(); 
                   
                    if (!empty($result)) {
                        
                        
                        $res = '<select class="form-control question_option potential-select" name="multiple-'.$question_id.'-'.$participant_id.'-'.$group_id.'[]"   multiple="multiple">';
                            if($answer_val != ''){
                                for( $i=0; $i<sizeof($result); $i++) {
                                    
                                    if(in_array($result[$i]['option'] , $answer_val_array))
                                      $selected='selected'; 
                                     else 
                                      $selected='' ; //otherwise, ensure the variable is empty
                                    
                                    $res .= '<option value="'.$result[$i]['option'].'" '.$selected.' >'.$result[$i]['option'].'</option>';
                                 }
                            } else{        
                                for( $i=0; $i<sizeof($result); $i++) {
                                    $res .= '<option value="'.$result[$i]['option'].'" >'.$result[$i]['option'].'</option>';
                                 }
                            } 
                             
                             
                        $res .= '</select>'; 
                         
                    }
                    
                    return $res;
               }
               
                 if($question_type == 1){
                     
                    $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                     if (!empty($answer)) 
                        $answer_val = $answer['0']['answer'];
                        else
                          $answer_val = '';  
                    
         
                    $this->db->select('screener_question_options.option , screener_question_options.order');
                    $this->db->from('screener_question_options');
                    $this->db->where('screener_question_options.screener_question', $question_id);
                    $this->db->order_by('screener_question_options.order', 'Asc');
                    $query = $this->db->get();
                    $result =  $query->result_array(); 
                   
                    if (!empty($result)) {
                        $res = '<select class="form-control" name="single-'.$question_id.'-'.$participant_id.'-'.$group_id.'">';
                                    
                           if($answer_val != ''){
                                for( $i=0; $i<sizeof($result); $i++) {
                                    
                                    if($result[$i]['option'] == $answer_val)
                                      $selected='selected'; 
                                     else 
                                      $selected='' ; //otherwise, ensure the variable is empty
                                    
                                    $res .= '<option value="'.$result[$i]['option'].'" '.$selected.' >'.$result[$i]['option'].'</option>';
                                 }
                            } else{        
                                for( $i=0; $i<sizeof($result); $i++) {
                                    $res .= '<option value="'.$result[$i]['option'].'" >'.$result[$i]['option'].'</option>';
                                 }
                            }    
                        $res .= '</select>'; 
                         
                    }
                    
                    return $res;
               }
               
               
               
               
               
    }
    
    
    public function get_scheduled_question_option($question_id , $question_type , $participant_id , $group_id)
    {
               
		$answer_val = '';
               if($question_type == 3){
                   $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                    if (!empty($answer)) 
                   $answer_val = $answer['0']['answer'];
                   else
                     $answer_val = '';   
                 
                   return $answer_val;
                    
               } 
               if($question_type == 2){
                   
                    $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                    if(!empty($answer)){ 
                        $answer_val = $answer['0']['answer'];
                       
                    }
                    
                    return $answer_val;
               }
               
                 if($question_type == 1){
                     
                    $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                     if (!empty($answer)) 
                        $answer_val = $answer['0']['answer'];
                        else
                          $answer_val = '';  
                    
                    return $answer_val;
               }
       
    }
    
      public function export_scheduled_question_option($question_id , $question_type , $participant_id , $group_id)
    {
               
		
               if($question_type == 3){
                   $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                    if (!empty($answer)) 
                   $answer_val = $answer['0']['answer'];
                   else
                     $answer_val = '';   
                 
                   return $answer_val;
                    
               } 
               if($question_type == 2){
                   
                    $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                   $answer_val = '';
                    if(!empty($answer)){ 
                        $answer_val = $answer['0']['answer'];
                        
                        $val = explode(',' , $answer_val);
                        
                       $answer_val = implode('-', $val);
                    }
                    
                    return $answer_val;
               }
               
                 if($question_type == 1){
                     
                    $answer = $this->get_screene_answer($group_id , $participant_id ,  $question_id);
                  
                     if (!empty($answer)) 
                        $answer_val = $answer['0']['answer'];
                        else
                          $answer_val = '';  
                    
                    return $answer_val;
               }
       
    }
    
    //multiple-questionId-participantId-groupId in this order
    public function save_answer($data)
    {
        if (!empty($data)) {
            foreach ($data as $key=>$val){
               
                $qname = explode('-', $key);
                
                if($qname[0] == 'multiple')
                {
                    $answerval = implode(',' , $val);
                    if($answerval != '')
                    {
                     //first delete record then inser data   
                     $this->db->delete('screener_answers', array('study_user_group_id' =>  $qname[3] ,'participant_id' =>  $qname[2] , 'screener_question' =>  $qname[1] ));
                     
                      $data_to_save = array(
                            'study_user_group_id' => $qname[3],
                            'participant_id' => $qname[2],
                            'screener_question' => $qname[1],
                            'answer' => $answerval
                             );
                     
                      $success = $this->db->insert('screener_answers', $data_to_save);  
                         
                    }
                    
                }
                else
                    
                   if($qname[0] == 'written')  
                    {
                    
                   $answerval = $val;
                    
                    if($answerval != '')
                    {
                       //first delete record then inser data   
                     $this->db->delete('screener_answers', array('study_user_group_id' =>  $qname[3] ,'participant_id' =>  $qname[2] , 'screener_question' =>  $qname[1] ));
                      
                      $data_to_save = array(
                            'study_user_group_id' => $qname[3],
                            'participant_id' => $qname[2],
                            'screener_question' => $qname[1],
                            'answer' => $answerval
                             );
                     
                      $success = $this->db->insert('screener_answers', $data_to_save);  
                         
                    }
                    
                }
                else
                    
                  if($qname[0] == 'single')  
                    {
                    
                   $answerval = $val;
                    
                    if($answerval != '')
                    {
                       //first delete record then inser data   
                     $this->db->delete('screener_answers', array('study_user_group_id' =>  $qname[3] ,'participant_id' =>  $qname[2] , 'screener_question' =>  $qname[1] ));
                      
                      $data_to_save = array(
                            'study_user_group_id' => $qname[3],
                            'participant_id' => $qname[2],
                            'screener_question' => $qname[1],
                            'answer' => $answerval
                             );
                     
                      $success = $this->db->insert('screener_answers', $data_to_save);  
                         
                    }
                    
                }
                else
                    
                 if($qname[0] == 'statuus')  
                    {
                    
                   $statusval = $val;
                    
                    if($statusval != '')
                    {
                      
                        $this->db->where('study_user_group',  $qname[2]);
                        $this->db->where('participant_id',  $qname[1]);
                        $success = $this->db->update('study_participants',array('participant_status' => $statusval));  
                    }
                    
                }   
                
                else
                    
                 if($qname[0] == 'columnnn' && $qname[1] == 'gender')  
                    {
                    
                   $columnval = $val;
                    
                    if($columnval != '')
                    {
                       //first delete record then inser data   
                     $this->db->delete('potential_additional_columns', array('column_name' =>  'gender' ,'study_user_group' =>  $qname[2] ));
                      
                      $data_to_save = array(
                           'study_user_group' => $qname[2],
                            'column_name' => 'gender',
                            'column_value' => $columnval
                             );
                      $success = $this->db->insert('potential_additional_columns', $data_to_save);  
                    }else{
                       $this->db->delete('potential_additional_columns', array('column_name' =>  'gender' ,'study_user_group' =>  $qname[2] ));
                      
                    }
                    
                }   
                else
                    
                 if($qname[0] == 'columnnn' && $qname[1] == 'age')  
                    {
                    
                   $columnval = $val;
                    
                    if($columnval != '')
                    {
                       //first delete record then inser data   
                     $this->db->delete('potential_additional_columns', array('column_name' =>  'age' ,'study_user_group' =>  $qname[2] ));
                      
                      $data_to_save = array(
                           'study_user_group' => $qname[2],
                            'column_name' => 'age',
                            'column_value' => $columnval
                             );
                     
                      $success = $this->db->insert('potential_additional_columns', $data_to_save);  
                         
                    }else{
                        $this->db->delete('potential_additional_columns', array('column_name' =>  'age' ,'study_user_group' =>  $qname[2] ));
                     
                    }
                    
                }   
                else
                    
                 if($qname[0] == 'columnnn' && $qname[1] == 'ethnicity')  
                    {
                    
                   $columnval = $val;
                    
                    if($columnval != '')
                    {
                       //first delete record then inser data   
                     $this->db->delete('potential_additional_columns', array('column_name' =>  'ethnicity' ,'study_user_group' =>  $qname[2] ));
                      
                      $data_to_save = array(
                           'study_user_group' => $qname[2],
                            'column_name' => 'ethnicity',
                            'column_value' => $columnval
                             );
                     
                      $success = $this->db->insert('potential_additional_columns', $data_to_save);  
                         
                    }else{
                       $this->db->delete('potential_additional_columns', array('column_name' =>  'ethnicity' ,'study_user_group' =>  $qname[2] ));
                      
                    }
                    
                }   
                else
                    
                 if($qname[0] == 'columnnn' && $qname[1] == 'occupation')  
                    {
                    
                   $columnval = $val;
                    
                    if($columnval != '')
                    {
                       //first delete record then inser data   
                     $this->db->delete('potential_additional_columns', array('column_name' =>  'occupation' ,'study_user_group' =>  $qname[2] ));
                      
                      $data_to_save = array(
                           'study_user_group' => $qname[2],
                            'column_name' => 'occupation',
                            'column_value' => $columnval
                             );
                     
                      $success = $this->db->insert('potential_additional_columns', $data_to_save);  
                         
                    }else{
                        $this->db->delete('potential_additional_columns', array('column_name' =>  'occupation' ,'study_user_group' =>  $qname[2] ));
                      
                    }
                    
                }   
                    
                    
                
                echo '<br>';
            }
        }    
    }
    
    // iaa_schedule  value save in schedule and schedule detial table 
    public function save_schedule($study_id , $data)
    {
         $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
     
        if (!empty($data['lists'])) {
            for($i = 1; $i<=count($data['lists']); $i++){
               // echo '<pre>';
               // echo ($data['lists'][$i]);
                //echo '<br>';
                
                $schedule_date  = $data['lists'][$i];
                if($schedule_date != ''){
                
                    $check_val = $this->check_iaa_schedule($study_id , $schedule_date);
                    if($check_val == 0)
                    {
                        $data_to_save = array(
                                'study_id' => 	$study_id,
                                'schedule_date' => $schedule_date
                                 );

                         $success = $this->db->insert('schedule', $data_to_save); 
                         $last_insert_id =  $this->db->insert_id();
                         
                        for($j = 0; $j<count($data['list'][$i]); $j++){
                             
                            $part = explode('-', $data['list'][$i][$j][2]);
                            $participant = $part[0];
                            $user_group = $part[1];

                             $schedule_to_save = array(

                                    'schedule_id' => 	$last_insert_id,
                                    'start_time' => 	$data['list'][$i][$j][0],
                                    'end_time' =>       $data['list'][$i][$j][1],
                                    'participant' => 	$participant,
                                    'user_group' =>         $user_group,
                                    'training_condition' => $data['list'][$i][$j][3],
                                    'participant_status' => $data['list'][$i][$j][4],
                                    'participant_order' =>  $data['list'][$i][$j][5]
                                     );
                             //print_r($schedule_to_save);
                             $success = $this->db->insert('schedule_details', $schedule_to_save);

                        }   
                        
                    }else{
                            $schedule_id = $this->get_schedule_id($study_id , $schedule_date); 

                                $this->db->delete('schedule_details', array('schedule_id' =>  $schedule_id[0] ));
                         
                                for($j = 0; $j<count($data['list'][$i]); $j++){
                             
                                    $part = explode('-', $data['list'][$i][$j][2]);
                                    $participant = $part[0];
                                    $user_group = $part[1];

                                     $schedule_to_save = array(

                                            'schedule_id' => 	$schedule_id[0],
                                            'start_time' => 	$data['list'][$i][$j][0],
                                            'end_time' =>       $data['list'][$i][$j][1],
                                            'participant' => 	$participant,
                                            'user_group' =>         $user_group,
                                            'training_condition' => $data['list'][$i][$j][3],
                                            'participant_status' => $data['list'][$i][$j][4],
                                            'participant_order' =>  $data['list'][$i][$j][5]
                                             );

                                     $success = $this->db->insert('schedule_details', $schedule_to_save);

                                }   
                        
                    }
                
                }
                
                
                                               
            }
        }
        
        $this->db->trans_complete();
        return $success;      
        
    }
  
  
    function check_iaa_schedule($study_id , $schedule_date){
		$this->db->where('study_id',$study_id);
                $this->db->where('schedule_date',$schedule_date);
		$query 	= 	$this->db->get('schedule');	
		return $query->num_rows();    
    }
    

    
    public function get_schedule_id($study_id , $schedule_date)
    {
        $this->db->select('schedule_id');
        $this->db->from('schedule');
        $this->db->where('study_id',$study_id);
        $this->db->where('schedule_date',$schedule_date);
        $query = $this->db->get();
        return array_column($query->result_array(),'schedule_id');         
    }
    
    public function get_saved_schedule($study_id , $schedule_date)
    {
        $this->db->select('schedule.schedule_id , schedule_details.* , multi_usergroup.group_name');
        $this->db->from('schedule');
        $this->db->join('schedule_details', 'schedule.schedule_id = schedule_details.schedule_id', 'left');
        $this->db->join('multi_usergroup', 'schedule_details.user_group = multi_usergroup.id', 'left');
        $this->db->where('schedule.study_id',$study_id);
        $this->db->where('schedule.schedule_date',$schedule_date);
        
	$query = $this->db->get();
	return $query->result_array(); 	     
    }
   
    
    public function get_screene_questions()
    {
		$this->db->select('screener_questions.id, screener_questions.question , screener_questions.question_type');
		$this->db->from('screener_questions');
                
		$this->db->order_by('id', 'Asc');
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    public function get_screene_questions_usergroup($user_group_id)
    {
		$this->db->select('screener_questions.id, screener_questions.question , screener_questions.question_type');
		$this->db->from('screener_questions');
                $this->db->join('study_screener_questions', 'screener_questions.id = study_screener_questions.screener_question', 'right');
                 $this->db->where('study_screener_questions.study_user_group',$user_group_id);
		$this->db->order_by('id', 'Asc');
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
     public function get_screene_answer($group_id , $participant_id , $question_id)
    {
		$this->db->select('screener_answers.answer');
		$this->db->from('screener_answers');
                $this->db->where('study_user_group_id', $group_id);
                $this->db->where('participant_id', $participant_id);
                $this->db->where('screener_question', $question_id);
                
		$query = $this->db->get();
		
		return  $query->result_array(); 
              
                
    }

    
    
    public function get_total_participant($study_id)
    {
        $this->db->select('SUM(study_user_groups.number_of_participants) as total_participant');
        $this->db->from('study_user_groups');
        $this->db->where('study_id', $study_id);
         $this->db->group_by('study_id'); 
        $query = $this->db->get();
        $res =  $query->result_array(); 
        if(count($res)>0)
        return $res[0]['total_participant'];
    }
    
    public function study_participant_status_byid($status_id)
    {
        $this->db->select('status');
        $this->db->from('study_participant_status');
        $this->db->where('id', $status_id);
        $query = $this->db->get();
        $res =  $query->result_array(); 
        return $res[0]['status'];
    }
    
    public function get_study_location($study_id)
    {
        $this->db->select('locations.location_name');
        $this->db->from('locations');
        $this->db->join('study_locations', 'locations.location_id = study_locations.location_id', 'inner');
        $this->db->join('studies', 'study_locations.study_id = studies.study_id', 'inner');
        $this->db->where('study_locations.study_id', $study_id);
        $query = $this->db->get();
        $res =  $query->result_array(); 
        $val = '';
        for($i= 0; $i<count($res);$i++){
          
          if($i == 0)  
          $val =  $res[$i]['location_name'];
          else
           $val .= ','.$res[$i]['location_name'];   
            
        }
        
        return $val;
        
    }
    
    public function get_medical_condition($study_id)
    {
        $this->db->select('multi_usergroup.group_name');
        $this->db->from('multi_usergroup');
        $this->db->join('study_user_groups', 'multi_usergroup.id = study_user_groups.user_group', 'right');
        $this->db->where('study_user_groups.study_id', $study_id);
        $this->db->where('multi_usergroup.group_type', 2);
        $query = $this->db->get();
        $res =  $query->result_array(); 
        $val = '';
        for($i= 0; $i<count($res);$i++){
          
          if($i == 0)  
          $val =  $res[$i]['group_name'];
          else
           $val .= ','.$res[$i]['group_name'];   
            
        }
        
        return $val;
        
    }
    
    public function get_dnq_studies($study_id)
    {
        $this->db->select('studies_view.*');
        $this->db->from('studies_view');
        $this->db->join('study_dnq', 'studies_view.study_id = study_dnq.dnq_study_id', 'join');
        $this->db->where('study_dnq.study_id', $study_id);
        $query = $this->db->get();
        $res =  $query->result_array(); 
        $val = '';
        for($i= 0; $i<count($res);$i++){
          
          if($i == 0)  
          $val =  $res[$i]['study_number'].':'.$res[$i]['client_name'].' '.$res[$i]['product_name'].' '.$res[$i]['study_type'];
          else
           $val .= '<br>'.$res[$i]['study_number'].':'.$res[$i]['client_name'].' '.$res[$i]['product_name'].' '.$res[$i]['study_type'];   
            
        }
        
        return $val;
        
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
    
    public function get_study_participant_status()
    {
        $this->db->select('*');
        $this->db->from('study_participant_status');
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
        $this->db->from('multi_usergroup');
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
    
    public function get_aditional_column($group_id)
    {
        $this->db->select('*');
        $this->db->from('potential_additional_columns');
       $this->db->where('study_user_group', $group_id);
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
    
    
    public function get_autosave_study_id($admin_id)
    {
        $this->db->select('*');
        $this->db->from('studies_autosave');
        $this->db->where('user_id',$admin_id );
        $query = $this->db->get();
        $study =  $query->result_array();  
        $study_id = $study[0]['study_id'];
        
        return $study_id;
    }
    
    
    public function get_participant_name($participant_id)
    {
        $this->db->select('participants.firstname , participants.lastname');
        $this->db->from('participants');
        $this->db->where('participants.participant_id',$participant_id );
        $query = $this->db->get();
        $partt =  $query->result_array();  
        $part_name = $partt[0]['firstname'].' '.$partt[0]['lastname'] ;
        
        return $part_name;
    }
    
    
    public function get_participant_status_name($status_id)
    {
        $this->db->select('study_participant_status.status');
        $this->db->from('study_participant_status');
        $this->db->where('study_participant_status.id',$status_id );
        $query = $this->db->get();
        $partt =  $query->result_array();  
        $staruss_name = $partt[0]['status'];
        
        return $staruss_name;
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
    
    
    public function get_usergroup_name($group_id)
    {
        $this->db->select('multi_usergroup.group_name');
        $this->db->from('multi_usergroup');
        $this->db->join('study_user_groups', 'study_user_groups.user_group = multi_usergroup.id', 'join');
        $this->db->where('study_user_groups.id', $group_id);
        $query = $this->db->get();
        return array_column($query->result_array(),'group_name'); 
           
    }
    
    public function get_autosave_user_groups($study_id)
    {
		$this->db->select('study_user_groups_autosave.* , study_group_sessions_autosave.session_order ,study_group_sessions_autosave.session_time ');
		$this->db->from('study_user_groups_autosave');
                $this->db->join('study_group_sessions_autosave', 'study_user_groups_autosave.id = study_group_sessions_autosave.study_user_group', 'left');
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
                $this->db->join('study_group_sessions', 'study_user_groups.id = study_group_sessions.study_user_group', 'left');
		 $this->db->where('study_user_groups.study_id', $study_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    /**
    * Store the new study into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_record($data , $product_name , $product_name_other ,$product_type , $product_type_other , $client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
    {
    
        $admin_id = $this->session->userdata('active_user_id');
        
        $study_id = $this->get_autosave_study_id($admin_id);
        
        
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
                if($product_name_other != ''){
                    $product_val = array(
                            'product_type_id' => 0,
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
                }else{  $product_id = '';}     
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
        }    
        else{ $product_id = $product_name; }
        $data['product_name'] = $product_id;    
                
         //if product type is other insert value intio load sources table
        if($product_type == 'other')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('product_types');
            $this->db->where('product_type', $product_type_other);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
                if($product_type_other != ''){
                    $product_type_val = array(
                            'product_type' => $product_type_other
                    );
                    $success = $this->db->insert('product_types', $product_type_val); //store data in to client table
                    $product_type_id =  $this->db->insert_id();
                }else{  $product_type_id = '';}     
            } else{
               $pro = $query->result_array();
               $product_type_id =  $pro[0]['id'];
            }
        }    
        else{ $product_type_id = $product_type; }
        $data['product_type'] = $product_type_id; 
        
        //if clinet is other insert value intio client table         
        if($client_id == 'other')
        {
           //this query is check if we select other in client name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('clients');
            $this->db->where('client_name', $client_id_other);
            $query = $this->db->get();
            
            echo $this->db->last_query();
            if ($query->num_rows() == 0) {
                
                if($client_id_other != '')
                {    
                    $cal_val = array(
                            'client_name' => $client_id_other,
                            'default_location' => '',
                            'default_contact' => '',
                            'shipping_carrier' => '',
                            'shipping_account' => ''
                    );
                    
                   $success = $this->db->insert('clients', $cal_val); //store data in to client table
                   $client_ide =  $this->db->insert_id();
                }else{
                   $client_ide = ''; 
                }
                   
                   
            } else{
               $pro = $query->result_array();
               $client_ide =  $pro[0]['client_id'];
            }      
        }    
        else{
            $client_ide = $client_id;
        }
        $data['client_id'] = $client_ide;  
     
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
   //0=>group_id , 1=>group_name , 2=>participnt_no , 3=>payment , 4=>status , 5=>session , 6=>session_order
            
            if (!empty($study_group_array)) {
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $groop = explode('_', $val);
                        
                         $data_to_study = array(
                                'study_id' => $last_insert_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                         //echo '<pre>';
                         //print_r($data_to_study);
                         //echo '<br>';
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
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                                 
                               // echo '<pre>';
                               // print_r($data_to_session);
                               // echo '<br>';  
                                $success = $this->db->insert('study_group_sessions', $data_to_session);
                             }
                             
                         }
                     
                 $j++; 
                  
                }  //end of group foreach loop
            } // study group array
            
        // delete all record from aotusave tables
        $this->db->delete('studies_autosave', array('user_id' => $admin_id));      
        $this->db->delete('study_locations_autosave', array('study_id' => $study_id));
        $this->db->delete('study_dnq_autosave',  array('study_id' => $study_id));
        $this->db->delete('study_user_groups_autosave',  array('study_id' => $study_id));
        $this->db->delete('study_group_sessions_autosave', array('study_id' => $study_id));
 
        $this->db->trans_complete();

        return $success;  
        	
    }
    /*
    function store_participant_study($participantIds , $study_user_group)
    {

        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        for($i = 0; $i<count($participantIds); $i++)
        {       
            for($j = 0; $j<count($study_user_group); $j++)
            {              
               
                if($participantIds[$i] != '' && $study_user_group[$j] != '')
                {    
                 
                    $check_val = $this->check_participant_usergroup($participantIds[$i] , $study_user_group[$j]);   

                    if($check_val > 0)
                    {
                        $this->db->where('study_user_group',  $study_user_group[$j]);
                        $this->db->where('participant_id',  $participantIds[$i]);
                         $success = $this->db->update('study_participants',array('participant_status' => '1')); 
                    } 
                    else{
                        $val = array(
                                'participant_id' => $participantIds[$i],
                                'study_user_group' => $study_user_group[$j],
                                'participant_status' => '1'
                        );
                        $success = $this->db->insert('study_participants', $val); //store data in to client table                    
                    }
                }
                else{
                   
                    return $success;
                }
            }    
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }*/
    
    function store_participant_study($participantIds , $study_user_group)
    {

        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        for($i = 0; $i<count($participantIds); $i++)
        {       
            for($j = 0; $j<count($study_user_group); $j++)
            {              
               
                if($participantIds[$i] != '' && $study_user_group[$j] != '')
                {    
                 
                    
                    
                    $userg = explode('-', $study_user_group[$j]);
                    
                    $study_user_group = $userg[0];
                    $study_id = $userg[1];
                    
                    $check_val = $this->check_update_usergroup($participantIds[$i] , $study_user_group , $study_id); 
                        
                    if($check_val == 0)   
                    {
                        //to check this user already exist in usergroup of same study.
                        
                        $check_participant_exist = $this->check_user_by_study($participantIds[$i] , $study_user_group , $study_id); 
                       
                        if(count($check_participant_exist) != 0)
                        {
                           //first delete already associated participant with usergroup
                            $participant_exist_id = $check_participant_exist[0]['id'];
                            
                            $this->db->where('id',  $participant_exist_id);
                            $success = $this->db->update('study_participants',array('study_user_group' => $study_user_group)); 
                        // echo $this->db->last_query();
                         //die();
                            
                        } 
                        else{
                            
                           $val = array(
                                    'participant_id' => $participantIds[$i],
                                    'study_user_group' => $study_user_group,
                                    'participant_status' => '1'
                            );
                            $success = $this->db->insert('study_participants', $val); //store data in to client table 
                        }
                    }
                }
                else{
                   
                    return $success;
                }
            }    
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    function update_user_group($participantIds , $study_user_group , $study_id)
    {
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        for($i = 0; $i<count($participantIds); $i++)
        {       
            for($j = 0; $j<count($study_user_group); $j++)
            {              
               
                if($participantIds[$i] != '' && $study_user_group[$j] != '')
                {    
                 
                    $check_val = $this->check_update_usergroup($participantIds[$i] , $study_user_group[$j] , $study_id); 
                        
                    if($check_val == 0)   
                    {
                        //to check this user already exist in usergroup of same study.
                        
                        $check_participant_exist = $this->check_user_by_study($participantIds[$i] , $study_user_group[$j] , $study_id); 
                       
                        if(count($check_participant_exist) != 0)
                        {
                           //first delete already associated participant with usergroup
                            $participant_exist_id = $check_participant_exist[0]['id'];
                           /* $this->db->delete('study_participants', array('id' => $participant_exist_id));
                          
                            $val = array(
                                    'participant_id' => $participantIds[$i],
                                    'study_user_group' => $study_user_group[$j],
                                    'participant_status' => '1'
                            );
                            $success = $this->db->insert('study_participants', $val); //store data in to client table 
                            */
                            
                            
                            $this->db->where('id',  $participant_exist_id);
                            $success = $this->db->update('study_participants',array('study_user_group' => $study_user_group[$j])); 
                        // echo $this->db->last_query();
                         //die();
                            
                        } 
                        else{
                            
                           $val = array(
                                    'participant_id' => $participantIds[$i],
                                    'study_user_group' => $study_user_group[$j],
                                    'participant_status' => '1'
                            );
                            $success = $this->db->insert('study_participants', $val); //store data in to client table 
                        }
                    }
                }
                else{
                   
                    return $success;
                }
            }    
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    function copy_study_feature($study_id){
         
                $study_number = $this->max_study_id();
                //duplicate row into studies table
                $this->db->query("DROP TEMPORARY TABLE IF EXISTS tmp_study;");
                $this->db->query("CREATE TEMPORARY TABLE tmp_study SELECT * from studies WHERE study_id = '$study_id';");
                $this->db->query("UPDATE tmp_study SET study_number = '$study_number';");
                $this->db->query("ALTER TABLE tmp_study drop study_id;");
                $this->db->query("INSERT INTO studies SELECT 0,tmp_study.* FROM tmp_study;");
                $this->db->query("DROP TABLE tmp_study;");
                
                $query = $this->db->query('SELECT LAST_INSERT_ID()');
                $row = $query->row_array();
                $last_insert_id =  $row['LAST_INSERT_ID()'];

                //duplicate row into study_location table
                $this->db->query("INSERT INTO study_locations (study_id , location_id) SELECT '$last_insert_id' ,location_id FROM study_locations where study_id = '$study_id';");
                
                //duplicate row into study_dnq table
                $this->db->query("INSERT INTO study_dnq (study_id , dnq_study_id) SELECT '$last_insert_id' ,dnq_study_id FROM study_dnq where study_id = '$study_id';");
                
                //duplicate row into study_user_groups and  study_group_sessions table
                $query = $this->db->get_where('study_user_groups', array('study_id' => $study_id));
                foreach ($query->result() as $row)
                {
                   $group_id = $row->id;
                    
                    $this->db->query("DROP TEMPORARY TABLE IF EXISTS tmp_user_group;");
                    $this->db->query("CREATE TEMPORARY TABLE tmp_user_group SELECT * from study_user_groups WHERE id = '$group_id' AND study_id = '$study_id';");
                    $this->db->query("UPDATE tmp_user_group SET study_id = '$last_insert_id';");
                    $this->db->query("ALTER TABLE tmp_user_group drop id;");
                    $this->db->query("INSERT INTO study_user_groups SELECT 0,tmp_user_group.* FROM tmp_user_group;");
                    $this->db->query("DROP TABLE tmp_user_group;");
                    
                    $query = $this->db->query('SELECT LAST_INSERT_ID()');
                    $row = $query->row_array();
                    $last_insert_group_id =  $row['LAST_INSERT_ID()'];
               
                    //duplicate row into study_location table
                    $this->db->query("INSERT INTO study_group_sessions (study_id ,study_user_group ,session_order ,session_time) SELECT '$last_insert_id' , '$last_insert_group_id' ,session_order ,session_time FROM study_group_sessions where study_user_group = '$group_id' AND study_id = '$study_id';");
               
                    
                }
                
        }
    
     function check_update_usergroup($participant , $user_group , $study_id){
         
                $this->db->select('study_participants.*');
		$this->db->from('study_participants');
                $this->db->join('study_user_groups', 'study_participants.study_user_group = study_user_groups.id', 'join');             
                $this->db->where('study_participants.participant_id',$participant);
                $this->db->where('study_participants.study_user_group',$user_group);
                $this->db->where('study_user_groups.study_id', $study_id);
                $this->db->order_by('study_id', 'Asc');		
		$query = $this->db->get();
		
		return $query->num_rows(); 	
         
    }
    
    
     function check_user_by_study($participant , $user_group , $study_id){
         
                $this->db->select('study_participants.id');
		$this->db->from('study_participants');
                $this->db->join('study_user_groups', 'study_participants.study_user_group = study_user_groups.id', 'join');             
                $this->db->where('study_participants.participant_id',$participant);
                //$this->db->where('study_participants.study_user_group',$user_group);
                $this->db->where('study_user_groups.study_id', $study_id);
                $this->db->order_by('study_id', 'Asc');		
		$query = $this->db->get();
		
                
                echo $this->db->last_query();
                
		return $query->result_array(); 
         
    }
    
    
    function remove_participant_selected($participantIds , $groupId)
    {

        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        for($i = 0; $i<count($participantIds); $i++)
        {       
        
                if($participantIds[$i] != '' && $groupId != '')
                {    
                 
                    $check_val = $this->check_participant_usergroup($participantIds[$i] , $groupId);   

                    if($check_val > 0)
                    {
                      $success = $this->db->delete('study_participants', array('participant_id' => $participantIds[$i] , 'study_user_group' => $groupId ));  
                    } 
                 
                }
                else{
                   
                    return $success;
                }
                
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    function move_participant_scheduled($participantIds , $groupId)
    {

        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        for($i = 0; $i<count($participantIds); $i++)
        {       
        
                if($participantIds[$i] != '' && $groupId != '')
                {    
                 
                    $check_val = $this->check_participant_usergroup($participantIds[$i] , $groupId);   

                    if($check_val > 0)
                    {
                        $this->db->where('study_user_group',  $groupId);
                        $this->db->where('participant_id',  $participantIds[$i]);
                         $success = $this->db->update('study_participants',array('participant_status' => '8')); 
                    } 
                 
                }
                else{
                   
                    return $success;
                }
                
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    
    function move_participant_potential($participantIds , $groupId)
    {

        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        for($i = 0; $i<count($participantIds); $i++)
        {       
        
                if($participantIds[$i] != '' && $groupId != '')
                {    
                 
                    $check_val = $this->check_participant_usergroup($participantIds[$i] , $groupId);   

                    if($check_val > 0)
                    {
                        $this->db->where('study_user_group',  $groupId);
                        $this->db->where('participant_id',  $participantIds[$i]);
                         $success = $this->db->update('study_participants',array('participant_status' => '1')); 
                    } 
                 
                }
               
                
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    function check_participant_usergroup($participant , $user_group){
		$this->db->where('participant_id',$participant);
                $this->db->where('study_user_group',$user_group);
		$query 	= 	$this->db->get('study_participants');
	
		return $query->num_rows();    
    }
    
    function store_usergroup_question($groupIds , $questionIds)
    {

        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
        
        for($i = 0; $i<count($groupIds); $i++)
        {       
            for($j = 0; $j<count($questionIds); $j++)
            {              
               
                if($groupIds[$i] != '' && $questionIds[$j] != '')
                {    
                 
                    $check_val = $this->check_usergroup_question($groupIds[$i] , $questionIds[$j]);   

                    if($check_val > 0)
                    {
                       
                    //first delete all record if record already exist.
                        $this->db->delete('study_screener_questions', array('study_user_group' => $groupIds[$i] , 'screener_question' => $questionIds[$j] ));  
                        
                        $val = array(
                                'study_user_group' => $groupIds[$i],
                                'screener_question' => $questionIds[$j]
                        );
                        $success = $this->db->insert('study_screener_questions', $val); //store data in to client table    
                    } 
                    else{
                        
                        $val = array(
                                'study_user_group' => $groupIds[$i],
                                'screener_question' => $questionIds[$j]
                        );
                        $success = $this->db->insert('study_screener_questions', $val); //store data in to client table                    
                    }
                }
                else{
                   
                    return $success;
                }
            }    
        }       
        $this->db->trans_complete();
        return $success;  
        	
    }
    
    
    function remove_usergroup_question($groupId , $questionIds)
    {
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
            for($j = 0; $j<count($questionIds); $j++)
            {    
                if($groupId[$i] != '')
                {    
                    $success = $this->db->delete('study_screener_questions', array('study_user_group' => $groupId , 'screener_question' => $questionIds[$j] ));           
                }
                else{
                    return $success;
                }
            }  
        $this->db->trans_complete();
        return $success;  
    }
    
     function check_usergroup_question($groupIds , $questionIds){
		$this->db->where('study_user_group',$groupIds);
                $this->db->where('screener_question',$questionIds);
		$query 	= $this->db->get('study_screener_questions');
	
		return $query->num_rows();    
 
    }
    
    
    
      /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
     /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function update_record($study_id ,$data , $product_name , $product_name_other ,$product_type , $product_type_other , $client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
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
            
                if($product_name_other != '')
                {    
                    $product_val = array(
                            'product_type_id' => 0,
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
                }else{
                    
                    $product_id = '';
                }   
                    
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
            
        }    
        else{
            
            $product_id = $product_name;
        }
        
        $data['product_name'] = $product_id; 
        
         //if product type is other insert value intio load sources table
        if($product_type == 'other')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('product_types');
            $this->db->where('product_type', $product_type_other);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
                if($product_type_other != ''){
                    $product_type_val = array(
                            'product_type' => $product_type_other
                    );
                    $success = $this->db->insert('product_types', $product_type_val); //store data in to client table
                    $product_type_id =  $this->db->insert_id();
                }else{  $product_type_id = '';}     
            } else{
               $pro = $query->result_array();
               $product_type_id =  $pro[0]['id'];
            }
        }    
        else{ $product_type_id = $product_type; }
        $data['product_type'] = $product_type_id; 
        
        
          
        //if clinet is other insert value intio client table         
        if($client_id == 'other')
        {
           //this query is check if we select other in client name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('clients');
            $this->db->where('client_name', $client_id_other);
            $query = $this->db->get();
            
            echo $this->db->last_query();
            if ($query->num_rows() == 0) {
                
                if($client_id_other != '')
                {    
                    $cal_val = array(
                            'client_name' => $client_id_other,
                            'default_location' => '',
                            'default_contact' => '',
                            'shipping_carrier' => '',
                            'shipping_account' => ''
                    );
                    
                   $success = $this->db->insert('clients', $cal_val); //store data in to client table
                   $client_ide =  $this->db->insert_id();
                }else{
                   $client_ide = ''; 
                }
                   
                   
            } else{
               $pro = $query->result_array();
               $client_ide =  $pro[0]['client_id'];
            }      
        }    
        else{
            $client_ide = $client_id;
        }
        $data['client_id'] = $client_ide;  
 

//first delete all record from aotusave tables
        $this->db->delete('study_locations', array('study_id' => $study_id));
        $this->db->delete('study_dnq',  array('study_id' => $study_id));
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
         
            //0=>group_id , 1=>group_name , 2=>participnt_no , 3=>payment , 4=>status , 5=>session , 6=>session_order
           
            if (!empty($study_group_array)) {
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $groop = explode('_', $val);
                    
                    if($groop[0] == '0000'){    
                        
                        
                         $data_to_study = array(
                                'study_id' => $study_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                         //echo '<pre>';
                         //print_r($data_to_study);
                         //echo '<br>';
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
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                                 
                               // echo '<pre>';
                               // print_r($data_to_session);
                               // echo '<br>';  
                                $success = $this->db->insert('study_group_sessions', $data_to_session);
                             }
                             
                         }
                         
                    }else{
                        //udate the records in study_user_group
                        $study_user_group = $groop[0];

                         $data_to_study = array(
                                'study_id' => $study_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                       
                         
                        $this->db->where('id', $study_user_group);
                        $success = $this->db->update('study_user_groups', $data_to_study);
                         
                         
                         
                         
                         //delete the record before insertion
                         $success = $this->db->delete('study_group_sessions', array('study_id' => $study_id , 'study_user_group' =>  $study_user_group));
                         
                         // this section is user to inser recordin to study group session table
                         $sess_time = array();
                         $sess_time = $sessiontime[$j];

                         for($i = 0 ; $i<count($sess_time) ; $i++)
                         {
                             if($sess_time[$i] != ''){
                                 $data_to_session = array(
                                'study_id' => $study_id,
                                'study_user_group' => $study_user_group,
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                               
                                $success = $this->db->insert('study_group_sessions', $data_to_session);
                             }
                             
                         }
                    }
                 $j++; 
                  
                }  //end of group foreach loop
            } // study group array
            
        $this->db->trans_complete();
        return $success;  
        	
    }
    
      /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function update_autosave_record($study_id ,$data , $product_name , $product_name_other ,$product_type , $product_type_other , $client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
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
            
                if($product_name_other != '')
                {    
                    $product_val = array(
                            'product_type_id' => 0,
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
                }else{
                    
                    $product_id = '';
                }   
                    
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
            
        }    
        else{
            
            $product_id = $product_name;
        }
        
        $data['product_name'] = $product_id; 
        
         //if product type is other insert value intio load sources table
        if($product_type == 'other')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('product_types');
            $this->db->where('product_type', $product_type_other);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
                if($product_type_other != ''){
                    $product_type_val = array(
                            'product_type' => $product_type_other
                    );
                    $success = $this->db->insert('product_types', $product_type_val); //store data in to client table
                    $product_type_id =  $this->db->insert_id();
                }else{  $product_type_id = '';}     
            } else{
               $pro = $query->result_array();
               $product_type_id =  $pro[0]['id'];
            }
        }    
        else{ $product_type_id = $product_type; }
        $data['product_type'] = $product_type_id; 
        
        
          
        //if clinet is other insert value intio client table         
        if($client_id == 'other')
        {
           //this query is check if we select other in client name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('clients');
            $this->db->where('client_name', $client_id_other);
            $query = $this->db->get();
            
            echo $this->db->last_query();
            if ($query->num_rows() == 0) {
                
                if($client_id_other != '')
                {    
                    $cal_val = array(
                            'client_name' => $client_id_other,
                            'default_location' => '',
                            'default_contact' => '',
                            'shipping_carrier' => '',
                            'shipping_account' => ''
                    );
                    
                   $success = $this->db->insert('clients', $cal_val); //store data in to client table
                   $client_ide =  $this->db->insert_id();
                }else{
                   $client_ide = ''; 
                }
                   
                   
            } else{
               $pro = $query->result_array();
               $client_ide =  $pro[0]['client_id'];
            }      
        }    
        else{
            $client_ide = $client_id;
        }
        $data['client_id'] = $client_ide;  
 

//first delete all record from aotusave tables
        $this->db->delete('study_locations', array('study_id' => $study_id));
        $this->db->delete('study_dnq',  array('study_id' => $study_id));
        //$this->db->delete('study_user_groups',  array('study_id' => $study_id));
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
         
            //0=>group_id , 1=>group_name , 2=>participnt_no , 3=>payment , 4=>status , 5=>session , 6=>session_order
            $resultarray = array();
            if (!empty($study_group_array)) {
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $groop = explode('_', $val);
                    
                    if($groop[0] == '0000'){    
                        
                        
                         $data_to_study = array(
                                'study_id' => $study_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                         //echo '<pre>';
                         //print_r($data_to_study);
                         //echo '<br>';
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
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                                 
                               // echo '<pre>';
                               // print_r($data_to_session);
                               // echo '<br>';  
                                $success = $this->db->insert('study_group_sessions', $data_to_session);
                             }
                             
                         }
                         
                      $resultarray[$groop[6]] =   $last_insert_study_group_id; 
                      
                    }else{
                        //udate the records in study_user_group
                        $study_user_group = $groop[0];

                         $data_to_study = array(
                                'study_id' => $study_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                       
                         
                        $this->db->where('id', $study_user_group);
                        $success = $this->db->update('study_user_groups', $data_to_study);
                         
                         
                         
                         
                         //delete the record before insertion
                         $success = $this->db->delete('study_group_sessions', array('study_id' => $study_id , 'study_user_group' =>  $study_user_group));
                         
                         // this section is user to inser recordin to study group session table
                         $sess_time = array();
                         $sess_time = $sessiontime[$j];

                         for($i = 0 ; $i<count($sess_time) ; $i++)
                         {
                             if($sess_time[$i] != ''){
                                 $data_to_session = array(
                                'study_id' => $study_id,
                                'study_user_group' => $study_user_group,
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                               
                                $success = $this->db->insert('study_group_sessions', $data_to_session);
                             }
                             
                         }
                    }
                 $j++; 
                  
                }  //end of group foreach loop
            } // study group array
            
        $this->db->trans_complete();
        return $resultarray;  
        	
    }
     /**
    * Store the new user into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    //function autosave_record($data ,$medicalarray ,$occupationarray , $classificationarray , $photologarray)
    function autosave_record($data , $product_name , $product_name_other ,$product_type , $product_type_other, $client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray)
    {
	
        $success = FALSE;  
        //Run these queries as a transaction, we want to make sure we do all or nothing
	$this->db->trans_start();
   
        $admin_id = $this->session->userdata('active_user_id');
          
          //if lead source is other insert value intio load sources table
        if($product_name == 'other')
        {
            
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('product_name', $product_name_other);
            $query = $this->db->get();
           
            if ($query->num_rows() == 0) {
            
                if($product_name_other != ''){
                    $product_val = array(
                            'product_type_id' => 0,
                            'product_name' => $product_name_other
                    );
                    $success = $this->db->insert('products', $product_val); //store data in to client table
                    $product_id =  $this->db->insert_id();
                }else{
                  $product_id = '';  
                }    
                    
                    
            } else{
               $pro = $query->result_array();
               $product_id =  $pro[0]['product_id'];
            }
            
        }    
        else{
            
            $product_id = $product_name;
        }      
        $data['product_name'] = $product_id;
        
         //if product type is other insert value intio load sources table
        if($product_type == 'other')
        {
           //this query is check if we select other in product name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('product_types');
            $this->db->where('product_type', $product_type_other);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
                if($product_type_other != ''){
                    $product_type_val = array(
                            'product_type' => $product_type_other
                    );
                    $success = $this->db->insert('product_types', $product_type_val); //store data in to client table
                    $product_type_id =  $this->db->insert_id();
                }else{  $product_type_id = '';}     
            } else{
               $pro = $query->result_array();
               $product_type_id =  $pro[0]['id'];
            }
        }    
        else{ $product_type_id = $product_type; }
        $data['product_type'] = $product_type_id; 
        
        //if clinet is other insert value intio client table         
        if($client_id == 'other')
        {
           //this query is check if we select other in client name the added product already exist in db ar not.
            $this->db->select('*');
            $this->db->from('clients');
            $this->db->where('client_name', $client_id_other);
            $query = $this->db->get();
            
           // echo $this->db->last_query();
            if ($query->num_rows() == 0) {
                
                if($client_id_other != '')
                {    
                    $cal_val = array(
                            'client_name' => $client_id_other,
                            'default_location' => '',
                            'default_contact' => '',
                            'shipping_carrier' => '',
                            'shipping_account' => ''
                    );
                    
                   $success = $this->db->insert('clients', $cal_val); //store data in to client table
                   $client_ide =  $this->db->insert_id();
                }else{
                   $client_ide = ''; 
                }
                   
                   
            } else{
               $pro = $query->result_array();
               $client_ide =  $pro[0]['client_id'];
            }      
        }    
        else{
            $client_ide = $client_id;
        }
        $data['client_id'] = $client_ide;  
        
        
     
        
        $this->db->select('*');
        $this->db->from('studies_autosave');
        $this->db->where('user_id',$admin_id );
        $query = $this->db->get();
        $studies =  $query->result_array(); 
 
        if($query->num_rows() > 0)
        {
        
        // update record in studies_autosave
           $this->db->where('user_id', $admin_id);
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
           
   
            //update record into study_user_groups_autosave.
            //echo '<pre>';
            //print_r($study_group_array);
            
            
            $resultarray = array();
            //0=>group_id , 1=>group_name , 2=>participnt_no , 3=>payment , 4=>status , 5=>session , 6=>session_order         
            if (!empty($study_group_array)) {
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $groop = explode('_', $val);
                    
                    if($groop[0] == '0000'){    
                        
                        
                         $data_to_study = array(
                                'study_id' => $study_autosave_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                         //echo '<pre>';
                         //print_r($data_to_study);
                         //echo '<br>';
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
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                                 
                               // echo '<pre>';
                               // print_r($data_to_session);
                               // echo '<br>';  
                                $success = $this->db->insert('study_group_sessions_autosave', $data_to_session);
                             }
                             
                         }
                         
                     $resultarray[$groop[6]] =   $last_insert_study_group_id;  
                    }else{
                        //udate the records in study_user_group
                        $study_user_group = $groop[0];

                         $data_to_study = array(
                                'study_id' => $study_autosave_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                       
                         
                        $this->db->where('id', $study_user_group);
                        $success = $this->db->update('study_user_groups_autosave', $data_to_study);
                         
                         
                         
                         
                         //delete the record before insertion
                         $success = $this->db->delete('study_group_sessions_autosave', array('study_id' => $study_autosave_id , 'study_user_group' =>  $study_user_group));
                         
                         // this section is user to inser recordin to study group session table
                         $sess_time = array();
                         $sess_time = $sessiontime[$j];

                         for($i = 0 ; $i<count($sess_time) ; $i++)
                         {
                             if($sess_time[$i] != ''){
                                 $data_to_session = array(
                                'study_id' => $study_autosave_id,
                                'study_user_group' => $study_user_group,
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                               
                                $success = $this->db->insert('study_group_sessions_autosave', $data_to_session);
                             }
                             
                         }
                    }
                 $j++; 
                  
                }  //end of group foreach loop
            } 
            else{
                $success = $this->db->delete('study_user_groups_autosave', array('study_id' => $study_autosave_id));
                $success = $this->db->delete('study_group_sessions_autosave', array('study_id' => $study_autosave_id));
            }
            
  
        }else{
        //insert record into participant_autosave table
            $success = $this->db->insert('studies_autosave', $data);
            $last_insert_id =  $this->db->insert_id(); 
            //echo $this->db->last_query();
        
            
        //insert record into location table.
            if (!empty($locationarray)) {
                foreach($locationarray as $val){
                     $data_to_loc = array(
                            'study_id' => $last_insert_id,
                            'location_id' => $val
                             );
                     
                     $success = $this->db->insert('study_locations_autosave', $data_to_loc);
                     
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
                     
                     $success = $this->db->insert('study_dnq_autosave', $data_to_study);
                     
                }  
            }    
      
            $resultarray = array();
            //update record into study_user_groups_autosave.           
            //0=>group_id , 1=>group_name , 2=>participnt_no , 3=>payment , 4=>status , 5=>session , 6=>session_order         
            if (!empty($study_group_array)) {
                $j = 1;
            //add record in the form of insertion
                foreach($study_group_array as $val){
                    
                    $groop = explode('_', $val);
                    
                    if($groop[0] == '0000'){    
                        
                        
                         $data_to_study = array(
                                'study_id' => $last_insert_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                         //echo '<pre>';
                         //print_r($data_to_study);
                         //echo '<br>';
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
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                                 
                               // echo '<pre>';
                               // print_r($data_to_session);
                               // echo '<br>';  
                                $success = $this->db->insert('study_group_sessions_autosave', $data_to_session);
                             }
                             
                         }
                         
                    $resultarray[$groop[6]] =   $last_insert_study_group_id;   
                    }else{
                        //udate the records in study_user_group
                        $study_user_group = $groop[0];

                         $data_to_study = array(
                                'study_id' => $last_insert_id,
                                'user_group' => $groop[1],
                                'number_of_participants' => $groop[2],
                                'payment_amount' => $groop[3],
                                'training' => $groop[4],
                                'number_of_sessions' => $groop[5]
                                 );
                       
                         
                        $this->db->where('id', $study_user_group);
                        $success = $this->db->update('study_user_groups_autosave', $data_to_study);
                         
                         
                         
                         
                         //delete the record before insertion
                         $success = $this->db->delete('study_group_sessions_autosave', array('study_id' => $last_insert_id , 'study_user_group' =>  $study_user_group));
                         
                         // this section is user to inser recordin to study group session table
                         $sess_time = array();
                         $sess_time = $sessiontime[$j];

                         for($i = 0 ; $i<count($sess_time) ; $i++)
                         {
                             if($sess_time[$i] != ''){
                                 $data_to_session = array(
                                'study_id' => $study_user_group,
                                'study_user_group' => $study_user_group,
                                'session_order' => $groop[5],
                                'session_time' => $sess_time[$i]
                                 );
                               
                                $success = $this->db->insert('study_group_sessions_autosave', $data_to_session);
                             }
                             
                         }
                    }
                 $j++; 
                  
                }  //end of group foreach loop
            } // study group array
              
        }
        
        $this->db->trans_complete();
        return $resultarray;
        //return $success;  
        	
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
	
        function delete_group_record($id)
	{
       
	   $success = $this->db->delete('study_group_sessions', array('study_user_group' => $id));
           $success = $this->db->delete('study_participants', array('study_user_group' => $id));
           $success = $this->db->delete('study_user_groups', array('id' => $id));
	      
            return $success;
	
	}
        
         function delete_group_autosave_record($id)
	{
       
	   $success = $this->db->delete('study_group_sessions_autosave', array('study_user_group' => $id));
           $success = $this->db->delete('study_user_groups_autosave', array('id' => $id));
	      
            return $success;
	
	}
	
	function participant_tracker($study_id)
	{
        $this->db->select('*');
        $this->db->from('vw_participant_tracker');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
		
		return $query->result_array(); 	
	}
        
        function study_schedule_Date($study_id)
	{
        $this->db->select('studies.start_date , studies.end_date  , locations.location_name');
        $this->db->from('studies');
        $this->db->join('study_locations', 'studies.study_id = study_locations.study_id', 'left');
        $this->db->join('locations', 'locations.location_id = study_locations.location_id', 'left');
        $this->db->where('studies.study_id', $study_id);
        $query = $this->db->get();
		
		return $query->result_array(); 	
	}
        
        function study_participant($study_id)
	{
        $this->db->select('participants.participant_id , participants.firstname  , participants.lastname , study_user_groups.user_group , multi_usergroup.group_name');
        $this->db->from('participants');
        $this->db->join('study_participants', 'participants.participant_id = study_participants.participant_id', 'join');
        $this->db->join('study_user_groups', 'study_participants.study_user_group = study_user_groups.id', 'right');
        $this->db->join('multi_usergroup', 'study_user_groups.user_group = multi_usergroup.id', 'left');
        $this->db->where('study_user_groups.study_id', $study_id);
        $query = $this->db->get();
		
		return $query->result_array(); 	
	}
        
        
	
	function get_study_participant_count($status, $study_id=null)
	{
        $this->db->select('*');
        $this->db->from('study_participants');
        $this->db->join('study_user_groups', 'study_participants.study_user_group = study_user_groups.id', 'left');
		$this->db->where('participant_status', $status);
		
		if(!is_null($study_id))
			$this->db->where('study_id', $study_id);
		
		
        $query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function get_study_participant_count_by_usergroup($status, $study_id)
	{
        $this->db->select('distinct participant_id');
        $this->db->from('study_participants');
		$this->db->where_in('study_user_group', "SELECT DISTINCT id FROM study_user_groups WHERE study_id = $study_id");
		$this->db->where('participant_status', $status);
		
        $query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function get_study_participants_needed($study_id)
	{
        $this->db->select('SUM(number_of_participants) as cnt');
        $this->db->from('study_user_groups');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
		
		return $query->row(); 	
	}
	
	function get_participants_status_count($status , $group_id)
	{
        $this->db->select('id');
        $this->db->from('study_participants');
        $this->db->where('participant_status', $status);
        $this->db->where('study_user_group', $group_id);
        $query = $this->db->get();
		
	return $query->num_rows(); 
	}
        
        function get_potential_screen_count($status , $group_id)
	{
        $this->db->select('id');
        $this->db->from('study_participants');
        $this->db->where('participant_status', $status);
        $this->db->where('study_user_group', $group_id);
         $this->db->where_in('study_participants.participant_status', array('1','2','3','4','5')); 
        $query = $this->db->get();
		
	return $query->num_rows(); 
	}
        
        function get_screen_count($status , $group_id)
	{
        $this->db->select('id');
        $this->db->from('study_participants');
        $this->db->where('participant_status', $status);
        $this->db->where('study_user_group', $group_id);
        $query = $this->db->get();
		
	return $query->num_rows(); 
	}
        
        
        function participant_have_count($status , $group_id)
	{
            $this->db->select('id');
            $this->db->from('study_participants');
            $this->db->where('participant_status', $status);
            $this->db->where('study_user_group', $group_id); 
            $query = $this->db->get();

            return $query->num_rows(); 
	}
        
        
        
        function study_number_exist($study_number)
        {
	$this->db->where('study_number_manual', $study_number);
        $query = $this->db->get('studies');
        // echo $this->db->last_query();
        return $query->num_rows();
		
        }
		
		
		
	/**********************************************************************
    * Grabs content for HandsOnTable
	* Called by HandsOnTable
	* @study_id int
    * @return array 
	**********************************************************************/
	public function get_tracker($study_id)
	{
        $this->db->select('*');
        $this->db->from('study_tracker');
        $this->db->where('study_id', $study_id);
        $query = $this->db->get();
		
		return $query->result_array(); 	
	}
	
	
	/**********************************************************************
    * Updates tracker tab data
	* Called by HandsOnTable
	* @study_id int
    * @matrix string - stringified objects from HandsOnTable
    * @return int 
	**********************************************************************/
	public function update_tracker($study_id, $matrix)
	{
		$now = date("Y-m-d H:i:s");
		$data = array('matrix_csv' => $matrix, 'last_modified' => $now);
		
		$this->db->where('study_id', $study_id);
		$this->db->update('study_tracker', $data); 
				
		return $this->db->affected_rows();
	}
	
	

	
}
?>	
