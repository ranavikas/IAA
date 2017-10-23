<?php
class Users extends CI_Controller {
 
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
        
        $this->load->model('admin/Users_model');
		$this->load->model('User_model');
		$this->load->helper('log_helper');
    }
    
    
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //pagination settings
        $config['per_page'] = 200;
        $config['base_url'] = base_url().'admin/users';
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
        
         $data['count_user']= $this->Users_model->count_users();
         $data['users'] = $this->Users_model->get_user( '','', $order_type, $config['per_page'],$limit_end);        
         $config['total_rows'] = $data['count_user'];
		 
		 
         $data['active_user_id'] = $this->active_user_id;
        //initializate the panination helper 
        $this->pagination->initialize($config);         
       
        $data['main_content'] = 'admin/users/list';
        $this->load->view('includes/template', $data);  

    }//index
	
	
	
    /**
    * Add new user.
    * @return void
    */
    public function add()
    {
      	//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            //$this->form_validation->set_rules('username', 'User Name', 'required|callback_check_username[' . $this->input->post('username') . ']');
            $this->form_validation->set_rules('username', 'User Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
            $this->form_validation->set_rules('record_status', 'Status', 'required');
            
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $user_role_array = $this->input->post('user_role');				
                $data_to_store = array(
                            'first_name' => $this->input->post('fname'),
                            'last_name' => $this->input->post('lname'),
                            'username' => $this->input->post('username'),
                            'email' => $this->input->post('email'),
                            'password' => md5($this->input->post('password')),
                            'active' => $this->input->post('record_status'),
                            'created' =>  date('Y-m-d H:i:s')
                    );
                
                    $new_user = $this->input->post('fname').' '.$this->input->post('lname');
                    //We only want to do this if a person was selected to link to
		
			
				//if the insert has returned true then we show the flash message
                if($this->Users_model->store_user($data_to_store,$user_role_array)){  
                    
                    $data['flash_message'] = TRUE; 
                    
                    //Email target user
                    /*$Template  		= 	$this->Sendmail_model->template_choose('user_registration_admin');
                    $template = get_object_vars($Template);
                    $Actions 		= 	$this->Sendmail_model->email_action_choose('user_registration_admin');
                    $userdata		=	$this->User_model->get_by_username($this->input->post('username'));
                    $userdata = get_object_vars($userdata)
                    ;
                    //Set up placeholder replacements
                    $data = array(

                            'UserFullName' => $data_to_store['first_name'].' '.$data_to_store['last_name'],
                            'SiteUsername' => $data_to_store['username'],
                            'SitePassword' => $this->input->post('password')
                    );

                    //Replace placeholders
                    $email_body = $this->Sendmail_model->replace_placeholders($data, $template['email_body']);
                    $template['email_body'] = $email_body;

                    $this->Sendmail_model->email_from_template($template,$userdata);*/
 
                    //Redirect
                    redirect('admin/users/');
                    
                }else{
                    $data['flash_message'] = FALSE; 
                }
				
			
            }
       }
              
        $data['rec_user_role'] = $this->Users_model->get_roles();

        $data['main_content'] = 'admin/users/add';
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
 
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		
		  
            //form validation
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            $this->form_validation->set_rules('username', 'User Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('record_status', 'Status', 'required');
            
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $user_role_array = $this->input->post('user_role');			
                $data_to_store = array(
                            'first_name' => $this->input->post('fname'),
                            'last_name' => $this->input->post('lname'),
                            'username' => $this->input->post('username'),
                            'email' => $this->input->post('email'),
                            'active' => $this->input->post('record_status'),
                            'created' =>  date('Y-m-d H:i:s')
                    );
                
				
                //if the insert has returned true then we show the flash message
                if($this->Users_model->update_user($id, $data_to_store, $user_role_array)){  
                     
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            }
       }

	  
        //product data 
        $data['user'] = $this->Users_model->get_user_by_id($id); 
        $data['roles_edit'] = $this->Users_model->get_roles_edit($id);
        
        $data['rec_user_role'] = $this->Users_model->get_roles();
   				
        $data['user_id'] = $this->session->userdata('user')->user_id;

        //load the view
        $data['main_content'] = 'admin/users/edit';
        $this->load->view('includes/template', $data);            

    }//update

    
    
    public function changepassword()
    {
      
		
		 
	$user_id = $this->uri->segment(4);  
	
		//if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		
		  
            //form validation
           
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
            
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $id = $this->input->post('user_id');				
                $data_to_store = array(
                            
                            'password' => md5($this->input->post('password')),
                            'last_mod' =>  date('Y-m-d H:i:s')
                    );
                
                
                 //if the insert has returned true then we show the flash message
                if($this->Users_model->passwordchange($id, $data_to_store ) == TRUE){
                   
                    /*
                    //Email target user
                        $Template  		= 	$this->Sendmail_model->template_choose('reset_password');
                        $template = get_object_vars($Template);
                        $Actions 		= 	$this->Sendmail_model->email_action_choose('reset_password');
                        $userdata		=	$this->User_model->get_by_userid($this->input->post('user_id'));
                        $userdata = get_object_vars($userdata)
                        ;
                        
                        $data['user'] = $this->Profile_model->get_user_by_id($this->input->post('user_id'));             
                         $username = $data['user'][0]['username'];
                        //Set up placeholder replacements
                        $data = array(
                                'SiteUsername' => $username
                        );

                        //Replace placeholders
                        $email_body = $this->Sendmail_model->replace_placeholders($data, $template['email_body']);
                        $template['email_body'] = $email_body;

                        $this->Sendmail_model->email_from_template($template,$userdata); */
                    

                    redirect('admin/users/');
                    
                    $data['flash_message'] = TRUE; 
                }else{
                    
                    $data['flash_message'] = FALSE; 
                }
                
	
            }
       }
                
                
                $data['user_id'] = $user_id;
                $data['get_user'] = $this->Users_model->get_all_user();
                
		$data['main_content'] = 'admin/users/changepassword';
                $this->load->view('includes/template', $data);  
    }  
    
    public function check_username($username)
    {
         $result = $this->Users_model->user_exist($username);
         if($result > 0){
          $this->form_validation->set_message('check_username', 'Username already exist.');
          return false;  
         }else{
             return true;
         }
    } 
    
    
 
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
	  

        //user id 
        $id = $this->uri->segment(4);
				
            if($this->Users_model->delete_user($id)){
                
            $this->db->delete('user_assign_role', array('user_id' => $id));
            
                $data['flash_message'] = TRUE; 
		
                }else{
                $data['flash_message'] = FALSE; 
            
            }    

            redirect('admin/users');
    }//edit

}