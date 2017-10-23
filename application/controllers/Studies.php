<?php
class Studies extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
	   
	 
	ob_start(); 
	parent::__construct();
        
        //If user is not logged in, redirect them to the login page
        $userarray = get_object_vars($this->session->userdata('user'));
        $sess_id = $userarray['user_id'];
         if(empty($sess_id))
         {
                $this->session->set_userdata(array('msg'=>''));
                redirect('/login', 'location');
         }
         
        $this->load->model('studies/Studies_model');
        $this->load->library(array('session','form_validation'));

    }
    
    
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //pagination settings
        $config['per_page'] = 200;
        $config['base_url'] = base_url().'studies';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        
        //limit end
        $page = $this->uri->segment(3);
        
        $data['study_year']  = '';
        $study_year = '';
        if ($this->input->get('study_year')) {
            $study_year = $this->input->get('study_year', TRUE);
             $data['study_year']  = $study_year;
        }
              
        $client = '';
        $data['client_ids'] = '';
        if ($this->input->get('client_id')) {
            $client = $this->input->get('client_id', TRUE);           
            $data['client_ids'] = $client;
   
        }
        
         $product_ids = '';
         $data['product_ids'] = '';
        if ($this->input->get('product_id')) {
            $product_ids = $this->input->get('product_id', TRUE);
            $data['product_ids'] = $product_ids;
        }
        
        
        $product_type = '';
        $data['product_type'] = '';
        if ($this->input->get('product_type')) {
            $product_type = $this->input->get('product_type', TRUE);
             $data['product_type'] = $product_type;
        }
        
        
        
        $study_status = '';
        $data['study_status'] = '';
        if ($this->input->get('study_status')) {
            $study_status = $this->input->get('study_status', TRUE);
             $data['study_status'] = $study_status;
        }
        
        $study_location = '';
        $data['study_location'] = '';
        if ($this->input->get('study_location')) {
            $study_location = $this->input->get('study_location', TRUE);
             $data['study_location'] = $study_location;
        }
        
        
        
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 
        $order_type = 'Asc';
        
	
        $data['count_records']= $this->Studies_model->count_records();
        $data['records'] = $this->Studies_model->get_records($study_year , $client, $product_ids, $product_type,$study_status , $study_location, $order_type);        
        $config['total_rows'] = $data['count_records'];

        $data['clients_rec'] = $this->Studies_model->get_clients();
        $data['products_rec'] = $this->Studies_model->get_products();
        $data['products_type_rec'] = $this->Studies_model->get_products_type();
        $data['study_status_rec'] = $this->Studies_model->get_study_status();  
        $data['study_type_rec'] = $this->Studies_model->get_study_type();       
        $data['location_rec'] = $this->Studies_model->get_locations();
        
        //initializate the panination helper 
        $this->pagination->initialize($config);         


		//Save this page in user's session
     	
	//load the view
        $data['main_content'] = 'studies/list';
        $this->load->view('includes/template', $data);  

    }//index
    
    
    public function studyList()
    {
      
        
        $data['filter_type']  = '';
        $filter_type = '';
        if ($this->input->get('filterType')) {
            $filter_type = $this->input->get('filterType', TRUE);
            
        }
         
        $data['filter_val']  = '';
        $filter_val = '';
        if ($this->input->get('filterVal')) {
            $filter_val = $this->input->get('filterVal', TRUE);
            
        }
        
       
        
        $data['records'] = $this->Studies_model->get_filter_records($filter_type , $filter_val);        
      

        /*$data['clients_rec'] = $this->Studies_model->get_clients();
        $data['products_rec'] = $this->Studies_model->get_products();
        $data['products_type_rec'] = $this->Studies_model->get_products_type();
        $data['study_status_rec'] = $this->Studies_model->get_study_status();  
        $data['study_type_rec'] = $this->Studies_model->get_study_type();       
        $data['location_rec'] = $this->Studies_model->get_locations();*/
 
	//load the view
        $data['main_content'] = 'studies/study_list';
        $this->load->view('includes/template_potential', $data);  

    }//index
    
    public function filter_select()
    {
        $data['clients_rec'] = $this->Studies_model->get_clients();
        $data['products_rec'] = $this->Studies_model->get_products();
        $data['products_type_rec'] = $this->Studies_model->get_products_type();
        $data['study_status_rec'] = $this->Studies_model->get_study_status();  
        $data['study_type_rec'] = $this->Studies_model->get_study_type();       
        $data['location_rec'] = $this->Studies_model->get_locations();
        
        $data['filter_id']  = $this->input->get('filterId'); 
         
	//load the view
        $data['main_content'] = 'studies/filter_type';
        $this->load->view('includes/template_potential', $data);  

    }//index
	
    
    public function selected_study()
    {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
      
                
            $participantIds = $this->input->post('participantIds');
            
            $study_user_group = $this->input->post('study_user_group');
            
           
            $participants = '';
            
            if (!empty($participantIds)) 
            $participants = explode(',', $participantIds);
 
            
                //if the insert has returned true then we show the flash message
                $last_insert_id =  $this->Studies_model->store_participant_study($participants , $study_user_group);

              
                if($last_insert_id>0){  
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully added/updated.");

                    redirect('participants/');

                }else{
                     redirect('participants/');
                    $this->session->set_flashdata('success', FALSE);
                }

        }    
        
        $participantIds = $this->input->get('participantIds'); 
        
        $data['participantIds']  = $participantIds;
        $data['records'] = $this->Studies_model->get_records_usergroup( );        

	//load the view
        $data['main_content'] = 'studies/study_usergroup';
        $this->load->view('includes/template_model', $data);  

    }//index
    
     public function change_user_group()
    {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
      
            $study_id = $this->input->post('study_id');
            $participantIds = $this->input->post('participantIds');
            $study_user_group = $this->input->post('study_user_group');
            
           
            $participants = '';
            
            if (!empty($participantIds)) 
            $participants = explode(',', $participantIds);
            
                //if the insert has returned true then we show the flash message
                $last_insert_id =  $this->Studies_model->update_user_group($participants , $study_user_group , $study_id);
              
                if($last_insert_id>0){  
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully added/updated.");

                    redirect("studies/study/".$study_id);

                }else{
                     redirect("studies/study/".$study_id);
                    $this->session->set_flashdata('success', FALSE);
                }

        }    
        
        $participantIds = $this->input->get('participantIds'); 
        $study_id = $this->input->get('study_id'); 
         
        $data['participantIds']  = $participantIds;
        $data['study_id']  = $study_id;
        $data['usergroup'] = $this->Studies_model->get_study_usergroup($study_id);

	//load the view
        $data['main_content'] = 'studies/update_usergroup';
        $this->load->view('includes/template_model', $data);  

    }//index
	
    public function remove_selected_participant()
    {   
        $participantIds = $this->input->get('participantIds'); 
        $groupId = $this->input->get('onegroup'); 
        $study_id = $this->input->get('study_id'); 
        
        
        $participants = '';
            
        if (!empty($participantIds)) 
        $participants = explode(',', $participantIds);
            
        
        $this->Studies_model->remove_participant_selected($participants , $groupId);
        
//after delete redirected to the relevan page.
        redirect("studies/study/".$study_id);
         

    }
    
    
    public function move_scheduled()
    {   
        $participantIds = $this->input->get('participantIds'); 
        $groupId = $this->input->get('onegroup'); 
        $study_id = $this->input->get('study_id'); 
        
        
        $participants = '';
            
        if (!empty($participantIds)) 
        $participants = explode(',', $participantIds);
            
        
        $this->Studies_model->move_participant_scheduled($participants , $groupId);
        
        //after delete redirected to the relevan page.
        redirect("studies/study/".$study_id);
         

    }
    
    public function move_potential()
    {   
        $participantIds = $this->input->get('participantIds'); 
        $groupId = $this->input->get('onegroup'); 
        $study_id = $this->input->get('study_id'); 
        
        
        $participants = '';
            
        if (!empty($participantIds)) 
        $participants = explode(',', $participantIds);
         
  
        $this->Studies_model->move_participant_potential($participants , $groupId);
        
        //after delete redirected to the relevan page.
        redirect("studies/study/".$study_id);
         

    }
	
    public function copy_study()
    {   
        $studyIds = $this->input->get('studyIds'); 
      
        $studies = '';
            
        if (!empty($studyIds)) 
        $studies = explode(',', $studyIds);
         
        for($i = 0 ; $i<count($studies); $i++)
        {
            $this->Studies_model->copy_study_feature($studies[$i]);
        }    
 
        //after copy study redirected to the relevant page.
        redirect("studies/");
    }
	
	
    public function add()
    {
        
        $user_id = $this->session->userdata('active_user_id');
       
	//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
           //form validation
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
            $product_name = $this->input->post('product_name');
            $product_name_other = $this->input->post('product_name_other');
            
            $product_type = $this->input->post('product_type');
            $product_type_other = $this->input->post('product_type_other');
            
            $client_id = $this->input->post('client_id');
            $client_id_other = $this->input->post('client_id_other');
            
            $data_to_store = array(
                            'study_type' => $this->input->post('study_type'),
                            'number_of_usergroups' => $this->input->post('user_group_no'),
                            'start_date' => $this->input->post('start_date'),
                            'end_date' => $this->input->post('end_date'),
                            'study_number' => $this->input->post('study_number'),
                            'study_dnq_notes' => $this->input->post('study_dnq_notes'),
                            'study_notes' => $this->input->post('study_notes'),
                
                            'study_status' => $this->input->post('study_status'),
                            'focus_vision' => $this->input->post('focus_vision'),
                            'recruiter' => $this->input->post('recruiter'),
                            'lead' => $this->input->post('lead'),
                            'datalogger' => $this->input->post('datalogger'),
                            'av' => $this->input->post('av'),
                            'client_contact_info' => $this->input->post('contactinfo'),
                            'created' =>  date('Y-m-d')
                    );
            
            
                $locationarray = $this->input->post('location');
                
                $user_group_idarray = $this->input->post('user_group_id');
               
                $dnq_studyarray = $this->input->post('dnq_study');
                $user_grouparray = $this->input->post('user_group');
                
                $participant_noarray = $this->input->post('participant_no');
                $payment_amountarray = $this->input->post('payment_amount');
                $trainingarray = $this->input->post('training');
                $session_orderarray = $this->input->post('session_order');
                
                
                $study_group_array = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                    $study_group_array[$i] =  $user_group_idarray[$i].'_'.$user_grouparray[$i].'_'.$participant_noarray[$i].'_'.$payment_amountarray[$i].'_'. $trainingarray[$i].'_'. $session_orderarray[$i];                   
                }
                
                //sessiontime_1_1
                $sessiontime = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                  // echo  $session_orderarray[$i];
                  // echo '<br>';     
                    $sessiontime[$i+1] =  $this->input->post('sessiontime_'.$session_orderarray[$i]);
                    
                }
                
                //echo '<pre>';
                //print_r($sessiontime);
               
               //if the insert has returned true then we show the flash message
                $last_insert_id =  $this->Studies_model->store_record($data_to_store ,$product_name , $product_name_other , $product_type , $product_type_other ,$client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray);

              
                    if($last_insert_id>0){  

                        $this->session->set_flashdata('success', TRUE);
                        $this->session->set_flashdata('msg', "Record successfully added.");

                        redirect('studies/');

                    }else{
                        $this->session->set_flashdata('success', FALSE);
                    }

            } //end of validation
        }
                
        //all data fetch from differect databse tables.        
            $data['max_study_id'] = $this->Studies_model->max_study_id(); 
            
            $data['clients_rec'] = $this->Studies_model->get_clients();
            $data['products_rec'] = $this->Studies_model->get_products();
            $data['products_type_rec'] = $this->Studies_model->get_products_type();
            $data['study_type_rec'] = $this->Studies_model->get_study_type();
            $data['study_status_rec'] = $this->Studies_model->get_study_status();
            
            $data['recruiter_rec'] = $this->Studies_model->get_users();          
            $data['lead_rec'] = $this->Studies_model->get_users();          
            $data['datalogger_rec'] = $this->Studies_model->get_users();
            $data['av_rec'] = $this->Studies_model->get_users();
            
            $data['user_group_rec'] = $this->Studies_model->get_user_groups();
            $data['location_rec'] = $this->Studies_model->get_locations();
            $data['dnq_study_rec'] = $this->Studies_model->get_dnq_study();
            
            
            
            $count_record = $this->Studies_model->count_autosave_record_by_userid($user_id);
 
            if($count_record > 0)
            {
				//$data['study'] = $this->Studies_model->get_study($study_id);

                //autosave secord data 
                $record = $this->Studies_model->get_autosave_record_by_userid($user_id);
                
                $data['client_id'] = $record[0]['client_id'];
                $data['product_name'] = $record[0]['product_name'];
                $data['product_type'] = $record[0]['product_type'];
                $data['study_type'] = $record[0]['study_type'];
                $data['number_of_usergroups'] = $record[0]['number_of_usergroups'];
                $data['start_date'] = $record[0]['start_date'];
                $data['end_date'] = $record[0]['end_date'];
                $data['study_status'] = $record[0]['study_status'];
                $data['focus_vision'] = $record[0]['focus_vision'];
                $data['recruiter'] = $record[0]['recruiter'];
                $data['lead'] = $record[0]['lead'];
                $data['datalogger'] = $record[0]['datalogger'];

                $data['av'] = $record[0]['av'];
                $data['study_number'] = $record[0]['study_number'];
                $data['study_notes'] = $record[0]['study_notes'];
                $data['study_dnq_notes'] = $record[0]['study_dnq_notes'];
                $data['client_contact_info'] = $record[0]['client_contact_info'];
                
                
            
                $study_id = $this->Studies_model->get_autosave_study_id($user_id);
            
                $data['location_autosave'] = $this->Studies_model->get_autosave_location($study_id);                
                $data['study_dnq_autosave'] = $this->Studies_model->get_autosave_study_dnq($study_id);
                
                $user_groups_autosave = $this->Studies_model->get_autosave_user_groups($study_id);
             
                $data['user_groups_autosave'] = $this->Studies_model->get_array_unique($user_groups_autosave);
                
                
            }else{
                 $data['client_id'] = '';
                $data['product_name'] = '';
                $data['product_type'] = '';
                $data['study_type'] = '';
                $data['number_of_usergroups'] = '1';
                $data['start_date'] = '';
                $data['end_date'] = '';
                $data['study_status'] = '';
                $data['focus_vision'] = '';
                $data['recruiter'] = '';
                $data['lead'] = '';
                $data['datalogger'] = '';

                $data['av'] = '';
                $data['study_number'] = '';
                $data['study_notes'] = '';
                $data['study_dnq_notes'] = '';
                $data['client_contact_info'] = '';
            }   
            
            
            $data['main_content'] = 'studies/add';
            $this->load->view('includes/template', $data);   
    }  
    
     public function update()
    {
        //participant id 
        $study_id = $this->uri->segment(3);
       
	//If save button was clicked, get the data sent via post    
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
                //form validation
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
            $product_name = $this->input->post('product_name');
            $product_name_other = $this->input->post('product_name_other');
            
            $product_type = $this->input->post('product_type');
            $product_type_other = $this->input->post('product_type_other');
            
            $client_id = $this->input->post('client_id');
            $client_id_other = $this->input->post('client_id_other');
            
            $data_to_store = array(
                            'study_type' => $this->input->post('study_type'),
                            'number_of_usergroups' => $this->input->post('user_group_no'),
                            'start_date' => $this->input->post('start_date'),
                            'end_date' => $this->input->post('end_date'),
                            'study_number' => $this->input->post('study_number'),
                            'study_dnq_notes' => $this->input->post('study_dnq_notes'),
                            'study_notes' => $this->input->post('study_notes'),
                
                            'study_status' => $this->input->post('study_status'),
                            'focus_vision' => $this->input->post('focus_vision'),
                            'recruiter' => $this->input->post('recruiter'),
                            'lead' => $this->input->post('lead'),
                            'datalogger' => $this->input->post('datalogger'),
                            'av' => $this->input->post('av'),
                            'client_contact_info' => $this->input->post('contactinfo'),
                            'noted_last_modified' =>  date('Y-m-d')
                    );
            
            
                $locationarray = $this->input->post('location');
                $dnq_studyarray = $this->input->post('dnq_study');
                
                $user_group_idarray = $this->input->post('user_group_id');
                
                $user_grouparray = $this->input->post('user_group');
                $participant_noarray = $this->input->post('participant_no');
                $payment_amountarray = $this->input->post('payment_amount');
                $trainingarray = $this->input->post('training');
                $session_orderarray = $this->input->post('session_order');
                
                
                $study_group_array = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                    $study_group_array[$i] =  $user_group_idarray[$i].'_'.$user_grouparray[$i].'_'.$participant_noarray[$i].'_'.$payment_amountarray[$i].'_'. $trainingarray[$i].'_'. $session_orderarray[$i];                   
                }
                
                //sessiontime_1_1
                $sessiontime = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                  // echo  $session_orderarray[$i];
                  // echo '<br>';     
                    $sessiontime[$i+1] =  $this->input->post('sessiontime_'.$session_orderarray[$i]);
                    
                }
                
                 if($this->Studies_model->update_record($study_id , $data_to_store ,$product_name , $product_name_other ,$product_type , $product_type_other ,$client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray) == TRUE){
                    
                   $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully edited.");
                   redirect("studies/study/".$study_id);

                }else{

                       $this->session->set_flashdata('success', FALSE);
                       $this->session->set_flashdata('msg', "ERROR: Record could not be edited.");
                }   
                

            } //end of validation
        
            
        }

            $data['clients_rec'] = $this->Studies_model->get_clients();
            $data['products_rec'] = $this->Studies_model->get_products();
            $data['products_type_rec'] = $this->Studies_model->get_products_type();
            $data['study_type_rec'] = $this->Studies_model->get_study_type();
            $data['study_status_rec'] = $this->Studies_model->get_study_status();
            
            $data['recruiter_rec'] = $this->Studies_model->get_users();          
            $data['lead_rec'] = $this->Studies_model->get_users();          
            $data['datalogger_rec'] = $this->Studies_model->get_users();
            $data['av_rec'] = $this->Studies_model->get_users();
            
            $data['user_group_rec'] = $this->Studies_model->get_user_groups();
            $data['location_rec'] = $this->Studies_model->get_locations();
            $data['dnq_study_rec'] = $this->Studies_model->get_dnq_study();
            
            
            
            $count_record = $this->Studies_model->count_record_by_id($study_id);
 
            if($count_record > 0)
            {
                //autosave secord data 
                $record = $this->Studies_model->get_record_by_id($study_id);
                
                $data['client_id'] = $record[0]['client_id'];
                $data['product_name'] = $record[0]['product_name'];
                $data['product_type'] = $record[0]['product_type'];
                $data['study_type'] = $record[0]['study_type'];
                $data['number_of_usergroups'] = $record[0]['number_of_usergroups'];
                $data['start_date'] = $record[0]['start_date'];
                $data['end_date'] = $record[0]['end_date'];
                $data['study_status'] = $record[0]['study_status'];
                $data['focus_vision'] = $record[0]['focus_vision'];
                $data['recruiter'] = $record[0]['recruiter'];
                $data['lead'] = $record[0]['lead'];
                $data['datalogger'] = $record[0]['datalogger'];

                $data['av'] = $record[0]['av'];
                $data['study_number'] = $record[0]['study_number'];
                $data['study_notes'] = $record[0]['study_notes'];
                $data['study_dnq_notes'] = $record[0]['study_dnq_notes'];
                $data['client_contact_info'] = $record[0]['client_contact_info'];
                
            
                $data['location'] = $this->Studies_model->get_location_edit($study_id);                
                $data['study_dnq'] = $this->Studies_model->get_study_dnq_edit($study_id);
                
                $user_groups = $this->Studies_model->get_user_groups_edit($study_id);
             
                $data['user_groups'] = $this->Studies_model->get_array_unique($user_groups);
                
                
            }else{
                 $data['client_id'] = '';
                $data['product_name'] = '';
                $data['product_type'] = '';
                $data['study_type'] = '';
                $data['number_of_usergroups'] = '1';
                $data['start_date'] = '';
                $data['end_date'] = '';
                $data['study_status'] = '';
                $data['focus_vision'] = '';
                $data['recruiter'] = '';
                $data['lead'] = '';
                $data['datalogger'] = '';

                $data['av'] = '';
                $data['study_number'] = '';
                $data['study_notes'] = '';
                $data['study_dnq_notes'] = '';
                $data['client_contact_info'] = '';
            }   
            
            $data['main_content'] = 'studies/edit';
            $this->load->view('includes/template', $data);   
    } 
    
    
    public function update_autosave()
    {
        //participant id 
        $study_id = $this->uri->segment(3);
       
	//If save button was clicked, get the data sent via post    
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
                //form validation
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
            $product_name = $this->input->post('product_name');
            $product_name_other = $this->input->post('product_name_other');
            
            $product_type = $this->input->post('product_type');
            $product_type_other = $this->input->post('product_type_other');
            
            $client_id = $this->input->post('client_id');
            $client_id_other = $this->input->post('client_id_other');
            
            $data_to_store = array(
                            'study_type' => $this->input->post('study_type'),
                            'number_of_usergroups' => $this->input->post('user_group_no'),
                            'start_date' => $this->input->post('start_date'),
                            'end_date' => $this->input->post('end_date'),
                            'study_number' => $this->input->post('study_number'),
                            'study_dnq_notes' => $this->input->post('study_dnq_notes'),
                            'study_notes' => $this->input->post('study_notes'),
                
                            'study_status' => $this->input->post('study_status'),
                            'focus_vision' => $this->input->post('focus_vision'),
                            'recruiter' => $this->input->post('recruiter'),
                            'lead' => $this->input->post('lead'),
                            'datalogger' => $this->input->post('datalogger'),
                            'av' => $this->input->post('av'),
                            'client_contact_info' => $this->input->post('contactinfo'),
                            'noted_last_modified' =>  date('Y-m-d')
                    );
            
            
                $locationarray = $this->input->post('location');
                $dnq_studyarray = $this->input->post('dnq_study');
                
                $user_group_idarray = $this->input->post('user_group_id');
                
                $user_grouparray = $this->input->post('user_group');
                $participant_noarray = $this->input->post('participant_no');
                $payment_amountarray = $this->input->post('payment_amount');
                $trainingarray = $this->input->post('training');
                $session_orderarray = $this->input->post('session_order');
                
                
                $study_group_array = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                    $study_group_array[$i] =  $user_group_idarray[$i].'_'.$user_grouparray[$i].'_'.$participant_noarray[$i].'_'.$payment_amountarray[$i].'_'. $trainingarray[$i].'_'. $session_orderarray[$i];                   
                }
                
                //sessiontime_1_1
                $sessiontime = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                  // echo  $session_orderarray[$i];
                  // echo '<br>';     
                    $sessiontime[$i+1] =  $this->input->post('sessiontime_'.$session_orderarray[$i]);
                    
                }
                
                //$this->Studies_model->update_record($study_id , $data_to_store ,$product_name , $product_name_other , $study_group_array , $sessiontime , $locationarray , $dnq_studyarray);
                  $res =  $this->Studies_model->update_autosave_record($study_id , $data_to_store ,$product_name , $product_name_other ,$product_type , $product_type_other ,$client_id ,$client_id_other, $study_group_array , $sessiontime , $locationarray , $dnq_studyarray);
                  //echo '<pre>';
                  $str = json_encode($res);
                  print_r($str);
                  die();

            } //end of validation
        
            
        }

    } 
    
    public function study()
    {
        //participant id 
        $study_id = $this->uri->segment(3);

        //detail study tab
         $data['clients_rec'] = $this->Studies_model->get_clients();
            $data['products_rec'] = $this->Studies_model->get_products();
            $data['products_type_rec'] = $this->Studies_model->get_products_type();
            $data['study_type_rec'] = $this->Studies_model->get_study_type();
            $data['study_status_rec'] = $this->Studies_model->get_study_status();
            
            $data['recruiter_rec'] = $this->Studies_model->get_users();          
            $data['lead_rec'] = $this->Studies_model->get_users();          
            $data['datalogger_rec'] = $this->Studies_model->get_users();
            $data['av_rec'] = $this->Studies_model->get_users();
            
            $data['user_group_rec'] = $this->Studies_model->get_user_groups();
            $data['location_rec'] = $this->Studies_model->get_locations();
            $data['dnq_study_rec'] = $this->Studies_model->get_dnq_study();
            
            
            
            $count_record = $this->Studies_model->count_record_by_id($study_id);
 
            if($count_record > 0)
            {
                //autosave secord data 
                $record = $this->Studies_model->get_record_by_id($study_id);
                
                $data['client_id'] = $record[0]['client_id'];
                $data['product_name'] = $record[0]['product_name'];
                $data['product_type'] = $record[0]['product_type'];
                $data['study_type'] = $record[0]['study_type'];
                $data['number_of_usergroups'] = $record[0]['number_of_usergroups'];
                $data['start_date'] = $record[0]['start_date'];
                $data['end_date'] = $record[0]['end_date'];
                $data['study_status'] = $record[0]['study_status'];
                $data['focus_vision'] = $record[0]['focus_vision'];
                $data['recruiter'] = $record[0]['recruiter'];
                $data['lead'] = $record[0]['lead'];
                $data['datalogger'] = $record[0]['datalogger'];

                $data['av'] = $record[0]['av'];
                $data['study_number'] = $record[0]['study_number'];
                $data['study_notes'] = $record[0]['study_notes'];
                $data['study_dnq_notes'] = $record[0]['study_dnq_notes'];
                $data['client_contact_info'] = $record[0]['client_contact_info'];
                
            
                $data['location'] = $this->Studies_model->get_location_edit($study_id);                
                $data['study_dnq'] = $this->Studies_model->get_study_dnq_edit($study_id);
                
                $user_groups = $this->Studies_model->get_user_groups_edit($study_id);
             
                $data['user_groups'] = $this->Studies_model->get_array_unique($user_groups);
                
                
            }
        
        //end detail study tab
        
        
        //for potential tabs
        $data['records'] = $this->Studies_model->get_records_potential($study_id); 
        $data['usergroup'] = $this->Studies_model->get_usergroup_potential($study_id); 
        $data['study_id'] = $study_id; 
        // end for potential tab
		
		
        $data['main_content'] = 'studies/study';
        $this->load->view('includes/template', $data);   
    }
    
    
    
    public function usergroup_participant()
    {
 
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
             
            $post_data = $this->input->post();
            
            //echo '<pre>';
            //print_r($post_data);
            
            $this->Studies_model->save_answer($post_data); 
        }    
        
        
        $usergroup_id = $this->input->get('usergroupp');   
        $data['usergroup_id'] = $usergroup_id;
        
        $data['study_participant_status'] = $this->Studies_model->get_study_participant_status();
        $data['adit_column'] = $this->Studies_model->get_aditional_column($usergroup_id); 
        
        $data['records'] = $this->Studies_model->get_usergroup_participant($usergroup_id); 
        $data['usergroup_question'] = $this->Studies_model->get_usergroup_questions($usergroup_id); 
  
        $data['main_content'] = 'studies/userparticipant';
        $this->load->view('includes/template_potential', $data);   
    } 
    
    
    public function usergroup_scheduled()
    {
 
        /*if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
             
            $post_data = $this->input->post();
            
            
            $this->Studies_model->save_answer($post_data); 
        } */   
        
        
        $usergroup_id = $this->input->get('usergroupp');   
        $data['usergroup_id'] = $usergroup_id;
       
        $data['study_participant_status'] = $this->Studies_model->get_study_participant_status(); 
        $data['records'] = $this->Studies_model->get_usergroup_scheduled($usergroup_id); 
        $data['usergroup_question'] = $this->Studies_model->get_usergroup_questions($usergroup_id); 
  
        $data['main_content'] = 'studies/userscheduled';
        $this->load->view('includes/template_potential', $data);   
    } 
    
     public function usergroup_dnq()
    {
 
        /*if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
             
            $post_data = $this->input->post();
            
            
            $this->Studies_model->save_answer($post_data); 
        } */   
        
        
        $usergroup_id = $this->input->get('usergroupp');   
        $data['usergroup_id'] = $usergroup_id;
        
        $data['study_participant_status'] = $this->Studies_model->get_study_participant_status(); 
        $data['dnq_records'] = $this->Studies_model->get_usergroup_dnq($usergroup_id); 
        
        $data['main_content'] = 'studies/userdnq';
        $this->load->view('includes/template_potential', $data);   
    } 
    
    public function iaa_schedules()
    {
    
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {            
            $study_id = $this->input->post('study_id');  
            $post_data = $this->input->post();  
            
            //echo '<pre>';
            //print_r($post_data);
            
            $this->Studies_model->save_schedule($study_id , $post_data); 
        }  
        
        
        
         
        $study_id = $this->input->get('studyId');   
    
        //For participant tracker
        $data['record'] = $this->Studies_model->study_schedule_Date($study_id);
        $data['study_participant'] = $this->Studies_model->study_participant($study_id);
        $data['participant_status'] = $this->Studies_model->get_study_participant_status();
        $data['study_id'] = $study_id;
       // echo '<pre>';
       // print_r($data['study_participant']);
       //  die();
         
        $data['main_content'] = 'studies/iaa_schedule';
        $this->load->view('includes/template_potential', $data);   
    } 

    
    
    public function partcipant_tracker()
    {
    
        $study_id = $this->input->get('studyId');   
    
        //For participant tracker
        $data['participant_tracker'] = $this->Studies_model->participant_tracker($study_id);
      
       // $have = $this->Studies_model->get_study_participant_count(6, $study_id);
       // $data['participant_tracker'] = $need; 
       // $data['participant_tracker_have'] = $have;   
       
        $data['main_content'] = 'studies/participant_tracker';
        $this->load->view('includes/template_potential', $data);   
    } 
    
    
    public function screener_questions()
    {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
             
            $study_id = $this->input->post('study_id');
            $questionIds = $this->input->post('questions_ids');
            
            $btnvalue = $this->input->post('savebtn');
          
            $groupIds = '';
            
            if (!empty($btnvalue)) 
            $groupIds = explode(',', $btnvalue);
 
            
                //if the insert has returned true then we show the flash message
                $last_insert_id =  $this->Studies_model->store_usergroup_question($groupIds , $questionIds);

              
                if($last_insert_id>0){  
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully added/updated.");

                    redirect("studies/study/".$study_id);

                }else{
                     redirect("studies/study/".$study_id);
                    $this->session->set_flashdata('success', FALSE);
                }
 
        } // end of post method    
        
        $data['allgroups'] = $this->input->get('allgroups'); 
        $data['onegroup']  = $this->input->get('onegroup'); 
        $data['study_id'] =  $this->input->get('study_id');
        
        $data['group_name'] = $this->Studies_model->get_usergroup_name($data['onegroup']); 
     
        $data['records'] = $this->Studies_model->get_screene_questions(); 
        $data['main_content'] = 'studies/screner_question';
        $this->load->view('includes/template_model', $data);   
    } 
 
    
    public function remove_screener_questions()
    {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
             
            $study_id = $this->input->post('study_id');
            $questionIds = $this->input->post('questions_ids');
            $groupId = $this->input->post('savebtn');
          
                if($this->Studies_model->remove_usergroup_question($groupId , $questionIds)){  
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Questions are dissocitaed from usergroup.");

                    redirect("studies/study/".$study_id);

                }else{
                     redirect("studies/study/".$study_id);
                    $this->session->set_flashdata('success', FALSE);
                }
 
        } // end of post method    
        
        $data['onegroup']  = $this->input->get('onegroup'); 
        $data['study_id'] =  $this->input->get('study_id');
        
        $data['group_name'] = $this->Studies_model->get_usergroup_name($data['onegroup']); 
     
        $data['records'] = $this->Studies_model->get_screene_questions_usergroup($data['onegroup']); 
        $data['main_content'] = 'studies/remove_screner_question';
        $this->load->view('includes/template_model', $data);   
    } 
 
    
    
    public function clientContactinfo()
    {  
        $clientId=$_POST['clientId'];
      
        $result=$this->Studies_model->get_contact_info($clientId);
       
       if (!empty($result)) {    
           
        $html = 'Name : '. $result[0]['firstname'] .' '.$result[0]['lastname'];
        $html .= "\n";
        $html .= 'Email : '. $result[0]['email'];
        $html .= "\n";
        $html .= 'Phone : '. $result[0]['phone'];
        $html .= "\n";
        $html .= 'Organization : '. $result[0]['organization'];
        
        echo $html;
       }
    }
    
    
    public function autosave()
    {
         
        $user_id = $this->session->userdata('active_user_id');
        //If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
  
            
            $product_name = $this->input->post('product_name');
            $product_name_other = $this->input->post('product_name_other');
            
             $product_type = $this->input->post('product_type');
            $product_type_other = $this->input->post('product_type_other');
            
             $client_id = $this->input->post('client_id');
            $client_id_other = $this->input->post('client_id_other');
            
            $data_to_store = array(
                            'user_id' => $user_id,
                            'study_type' => $this->input->post('study_type'),
                            'number_of_usergroups' => $this->input->post('user_group_no'),
                            'start_date' => $this->input->post('start_date'),
                            'end_date' => $this->input->post('end_date'),
                            'study_number' => $this->input->post('study_number'),
                            'study_dnq_notes' => $this->input->post('study_dnq_notes'),
                            'study_notes' => $this->input->post('study_notes'),
                
                            'study_status' => $this->input->post('study_status'),
                            'focus_vision' => $this->input->post('focus_vision'),
                            'recruiter' => $this->input->post('recruiter'),
                            'lead' => $this->input->post('lead'),
                            'datalogger' => $this->input->post('datalogger'),
                            'av' => $this->input->post('av'),
                            'client_contact_info' => $this->input->post('contactinfo'),
                    );
            
            
                $locationarray = $this->input->post('location');
               $user_group_idarray = $this->input->post('user_group_id');
                
                $dnq_studyarray = $this->input->post('dnq_study');
                $user_grouparray = $this->input->post('user_group');
                $participant_noarray = $this->input->post('participant_no');
                $payment_amountarray = $this->input->post('payment_amount');
                $trainingarray = $this->input->post('training');
                $session_orderarray = $this->input->post('session_order');
                
                
                $study_group_array = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                    $study_group_array[$i] =  $user_group_idarray[$i].'_'.$user_grouparray[$i].'_'.$participant_noarray[$i].'_'.$payment_amountarray[$i].'_'. $trainingarray[$i].'_'. $session_orderarray[$i];                   
                }
                
                //sessiontime_1_1
                $sessiontime = array();
                
                for($i = 0; $i<count($user_grouparray); $i++)
                { 
                  // echo  $session_orderarray[$i];
                  // echo '<br>';     
                    $sessiontime[$i+1] =  $this->input->post('sessiontime_'.$session_orderarray[$i]);
                    
                }
                
                //echo '<pre>';
                //print_r($sessiontime);
               
               //if the insert has returned true then we show the flash message
                $res = $this->Studies_model->autosave_record($data_to_store ,$product_name , $product_name_other ,$product_type , $product_type_other , $client_id ,$client_id_other , $study_group_array , $sessiontime , $locationarray , $dnq_studyarray);
				
		$str = json_encode($res);
                print_r($str);
                die();
                
                
                /*print_r($user_grouparray);
                print_r($payment_amountarray);
                print_r($trainingarray);
                print_r($session_orderarray);

                print_r($study_group_array);
                print_r($sessiontime);
                print_r($locationarray);*/

                
              
       }
       
    }       
     /**
    * Delete ethnicity record
    * @return void
    */
    public function delete()
    {
        		
        //ethnicity id 
        $id = $this->uri->segment(3);
		
		//delete
		if($this->Studies_model->delete_record($id))
		{
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully deleted.");
		}
		else
		{
                    $this->session->set_flashdata('success', FALSE);
                    $this->session->set_flashdata('msg', "ERROR: Record could not be deleted.");
		}
		

        redirect('studies/');
    }
    

    public function user_group_delete()
    {
        $id =  $this->input->post('groupId');
        //delete
        $this->Studies_model->delete_group_record($id);
    }
    
    public function user_group_autosave_delete()
    {
        $id =  $this->input->post('groupId');
        //delete
        $this->Studies_model->delete_group_autosave_record($id);
    }
    
}