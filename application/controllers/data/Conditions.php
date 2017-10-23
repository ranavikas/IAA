<?php
class Conditions extends CI_Controller {
 
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
         
        $this->load->model('data/Conditions_model');
    }
    
    
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //$this->session->set_flashdata('success', 'no');
		
        //pagination settings
        $config['per_page'] = 200;
        $config['base_url'] = base_url().'data/Conditions';
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
        
	
		$data['count_records']= $this->Conditions_model->count_records();
		$data['records'] = $this->Conditions_model->get_records( '','', $order_type, $config['per_page'],$limit_end);        
		$config['total_rows'] = $data['count_records'];

            
        //initializate the panination helper 
        $this->pagination->initialize($config);         
        
		
		//load the view
        $data['main_content'] = 'data/conditions/list';
        $this->load->view('includes/template', $data);  

    }//index
	
	
	
    public function add()
    {
           
		//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $btnvalue = $this->input->post('savebtn');
            
            //form validation
            //$this->form_validation->set_rules('client_status', 'Client Status', 'required');
            $this->form_validation->set_rules('medical_condition', 'Medical Condition', 'required');            
            
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$medical_condition = $this->input->post('medical_condition');
                $data_to_store = array(
                            'medical_condition' => $this->input->post('medical_condition')
                );
                
                
				//if the insert has returned true then we show the flash message
                $last_insert_id = $this->Conditions_model->add_record($data_to_store);
                if($last_insert_id>0)
				{  
                    
					$this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "$medical_condition successfully added.");
                                        
                    redirect('data/conditions/');
                    
                }
				else
				{
					$this->session->set_flashdata('success', FALSE);
				}


            }
       }
                
                
                                
		$data['main_content'] = 'data/conditions/add';
        $this->load->view('includes/template', $data);  
    }       
 
    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
		//Record id 
		$id = $this->uri->segment(4);
		
		//Get record
		$data['details'] = $this->Conditions_model->get_record_by_id($id);
       	
		//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {        
		
            //Form validation
            $this->form_validation->set_rules('medical_condition', 'Medical Condition', 'required');            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
			//If the form has passed through the validation
            if ($this->form_validation->run())
            {
				$medical_condition = $this->input->post('medical_condition');
                $data = array(
                            'medical_condition' => $this->input->post('medical_condition')
                );
                
				//Attempt to update
                if($this->Conditions_model->update_record($id, $data))
				{  
                    
					$this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully edited.");
					
					redirect('data/conditions/');
                }
				else
				{
					$this->session->set_flashdata('success', FALSE);
					$this->session->set_flashdata('msg', "ERROR: Record could not be deleted.");
				}
            }
       
	   
	   }        
        //Load the view
        $data['main_content'] = 'data/conditions/edit';
        $this->load->view('includes/template', $data);            

    }//update
    

	
    /**
    * Delete ethnicity record
    * @return void
    */
    public function delete()
    {
        		
        //ethnicity id 
        $id = $this->uri->segment(4);
		
		//delete
		if($this->Conditions_model->delete_record($id))
		{
			$this->session->set_flashdata('success', TRUE);
            $this->session->set_flashdata('msg', "Record successfully deleted.");
		}
		else
		{
			$this->session->set_flashdata('success', FALSE);
            $this->session->set_flashdata('msg', "ERROR: Record could not be deleted.");
		}
		

        redirect('data/conditions');
    }

}