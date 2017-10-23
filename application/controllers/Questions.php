<?php
class Questions extends CI_Controller {
 
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
         
       $this->load->model('studies/Questions_model');

    }
    
    
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //pagination settings
        $config['per_page'] = 200;
        $config['base_url'] = base_url().'questions';
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

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 
        $order_type = 'Asc';
        
	
		$data['count_records']= $this->Questions_model->count_records();
		$data['records'] = $this->Questions_model->get_records( '','', $order_type, $config['per_page'],$limit_end);        
		$config['total_rows'] = $data['count_records'];

            
        //initializate the panination helper 
        $this->pagination->initialize($config);         
        
		
		//load the view
        $data['main_content'] = 'studies/questions/list';
        $this->load->view('includes/template', $data);  

    }//index
	
	
	
    public function add()
    {
      

		//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $btnvalue = $this->input->post('savebtn');
            //form validation
            $this->form_validation->set_rules('question', 'Question', 'required');
            $this->form_validation->set_rules('question', 'Question', 'required|callback_check_question[' . $this->input->post('question') . ']');
           
              if($this->input->post('question_type') != 3)
              { 
                $this->form_validation->set_rules('question_option', 'Question option', 'required');
              }    
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $question_opt = $this->input->post('question_option');
                $question_opt=preg_replace('/\s+/', '-', $question_opt);
                $question_option = explode("-", $question_opt);
           
      
                $data_to_store = array(
                            'question' => $this->input->post('question'),
                            'question_type' => $this->input->post('question_type'),
                            'last_modified' =>  date('Y-m-d H:i:s')
                    );
                
                
                //if the insert has returned true then we show the flash message
                $last_insert_id = $this->Questions_model->store_record($data_to_store , $question_option);
                if($last_insert_id>0){  
                    
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully added.");
                    
                      if($btnvalue == 1)
                       redirect('questions/add');
                        else
                        redirect('questions/');
                    
                }else{
                    $this->session->set_flashdata('success', FALSE);
                }

            }
       }
                
                
            $data['main_content'] = 'studies/questions/add';
            $this->load->view('includes/template', $data);   
    }       
 
    public function add_question()
    {
      

		//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $btnvalue = $this->input->post('savebtn');
            $study_id = $this->input->post('study_id');
            //form validation
            $this->form_validation->set_rules('question', 'Question', 'required');
            $this->form_validation->set_rules('question', 'Question', 'required|callback_check_question[' . $this->input->post('question') . ']');
           
              if($this->input->post('question_type') != 3)
              { 
                $this->form_validation->set_rules('question_option', 'Question option', 'required');
              }    
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $question_opt = $this->input->post('question_option');
                $question_opt=preg_replace('/\s+/', '-', $question_opt);
                $question_option = explode("-", $question_opt);
           
      
                $data_to_store = array(
                            'question' => $this->input->post('question'),
                            'question_type' => $this->input->post('question_type'),
                            'last_modified' =>  date('Y-m-d H:i:s')
                    );
                
                
                //if the insert has returned true then we show the flash message
                $last_insert_id = $this->Questions_model->store_record($data_to_store , $question_option);
                if($last_insert_id>0){  
                    
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully added.");
                    
                     
                       redirect("studies/study/".$study_id);
                   
                }else{
                    redirect("studies/study/".$study_id);
                    $this->session->set_flashdata('success', FALSE);
                }

            }
       }
            $data['study_id'] =  $this->input->get('study_id');    
                
            $data['main_content'] = 'studies/questions/add_question';
            $this->load->view('includes/template_model', $data);   
    }   
    
    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        
        
    //client id 
      $id = $this->uri->segment(3);
	
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		
		  
             //form validation
            $this->form_validation->set_rules('question', 'Question', 'required');
            $this->form_validation->set_rules('question', 'Question', 'required|callback_check_question[' . $this->input->post('question') . ']');
           
            if($this->input->post('question_type') != 3)
            { 
              $this->form_validation->set_rules('question_option', 'Question option', 'required');
            }   
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $question_opt = $this->input->post('question_option');
                $question_opt=preg_replace('/\s+/', '-', $question_opt);
                $question_option = explode("-", $question_opt);
           
      
                $data_to_store = array(
                            'question' => $this->input->post('question'),
                            'question_type' => $this->input->post('question_type'),
                            'last_modified' =>  date('Y-m-d H:i:s')
                    );
                
                
                //if the insert has returned true then we show the flash message
                if($this->Questions_model->update_record($id, $data_to_store , $question_option) == TRUE){
                    
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully edited.");
                    redirect('questions/');
                    
                }else{
                    
                   $this->session->set_flashdata('success', FALSE);
                   $this->session->set_flashdata('msg', "ERROR: Record could not be edited.");
                }

            }
       }
       
       
        //product data 
        $data['record'] = $this->Questions_model->get_record_by_id($id); 
        $question_option = $this->Questions_model->get_question_options($id);
       
        $data['question_opt']   = implode("\n", $question_option);
        
        //Load the view
        $data['main_content'] = 'studies/questions/edit';
        $this->load->view('includes/template', $data);               

    }//update
    
    
     /**
    * Delete ethnicity record
    * @return void
    */
    public function delete()
    {
        		
        //ethnicity id 
        $id = $this->uri->segment(3);
		
		//delete
		if($this->Questions_model->delete_record($id))
		{
                    $this->db->delete('screener_question_options', array('screener_question' => $id));
                    
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully deleted.");
		}
		else
		{
                    $this->session->set_flashdata('success', FALSE);
                    $this->session->set_flashdata('msg', "ERROR: Record could not be deleted.");
		}
		

         redirect('questions/');
    }

    
    public function check_question($question)
    {
         $result = $this->Questions_model->question_exist($question);
         if($result > 0){
          $this->form_validation->set_message('check_question', 'Question already exist.');
          return false;  
         }else{
             return true;
         }
    } 
}