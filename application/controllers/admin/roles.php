<?php
class Roles extends CI_Controller {
 
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
		 
		
		$this->active_user_id = $this->session->userdata('active_user_id');
		 
                $this->load->model('admin/Roles_model');	
		
		
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        
        //pagination settings
        $config['per_page'] = 200;
        $config['base_url'] = base_url().'admin/roles';
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
        
         $data['count_role']= $this->Roles_model->count_roles();
         $data['roles'] = $this->Roles_model->get_role( '','', $order_type, $config['per_page'],$limit_end);        
         $config['total_rows'] = $data['count_role'];
	

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/roles/list';
		
        $this->load->view('includes/template', $data);  

    }//index
	
	
	
	
    public function add()
    {
      
//if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		
		  
            //form validation
            $this->form_validation->set_rules('role', 'Role', 'required');
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              

                $data_to_store = array(
                            'role' => $this->input->post('role'),
                            'description' => $this->input->post('desc'),
                            'color' => $this->input->post('color'),
                            'record_status' => $this->input->post('record_status')
                    );
                
                
		//if the insert has returned true then we show the flash message
		$last_insert_id =  $this->Roles_model->store_role($data_to_store);
                if($last_insert_id >0){  $data['flash_message'] = TRUE; 
		redirect('admin/roles/');
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }
       }
 
	
		 $data['main_content'] = 'admin/roles/add';
                $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation			
			$this->form_validation->set_rules('role', 'Role', 'required');
  			
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
               $data_to_store = array(
                    'role' => $this->input->post('role'),
                    'description' => $this->input->post('desc'),
                    'color' => $this->input->post('color'),
                    'record_status' => $this->input->post('record_status')
					
                );
                //if the insert has returned true then we show the flash message
                if($this->Roles_model->update_role($id, $data_to_store) == TRUE){
                    
                	$this->session->set_flashdata('flash_message', 'updated');
                }else{
                    
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
               
                //redirect('admin/roles/update/'.$id.'');

            }//validation run

        }

        //product data 
        $data['role'] = $this->Roles_model->get_role_by_id($id);
       
        
        
	    //load the view
        $data['main_content'] = 'admin/roles/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //user_role id 
        $id = $this->uri->segment(4);
				
		if($id != 1)
			$this->Roles_model->delete_role($id);
		
		redirect('admin/roles');
    }//edit

}