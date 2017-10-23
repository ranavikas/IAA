<?php
class Profile extends CI_Controller {
 
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
		
		 
                 
                $this->load->model('admin/Profile_model');
                $this->load->library('email');
		$this->load->model('Sendmail_model');
		$this->load->model('User_model');
		$this->load->helper('log_helper');                              
    }
    
    
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

         //load the view
        $data['main_content'] = 'admin/profile/list';
        $this->load->view('admin/includes/template', $data);  

    }//index
	
	

    
     public function changepassword()
    {
      
	$user_id = $this->session->userdata('user')->user_id;  
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
                
                			
                $data_to_store = array(
                            
                            'password' => md5($this->input->post('password')),
                            'last_mod' =>  date('Y-m-d H:i:s')
                    );
                
                
                 //if the insert has returned true then we show the flash message
                if($this->Profile_model->passwordchange($user_id, $data_to_store ) == TRUE){
                    $log_to_store = array(
                                'page_id' => get_page_id('Users')->page_id,
                                'action' => 'Password Changed',
								'record_id' => $this->active_user_id ,
                                'user_id' => $this->session->userdata('user')->user_id,
                                'action_ts' =>  date('Y-m-d H:i:s')
                        );
                    log_audit($log_to_store); // create an helper function for log 
                    
                    //Email target user
                        $Template  		= 	$this->Sendmail_model->template_choose('reset_password');
                        $template = get_object_vars($Template);
                        $Actions 		= 	$this->Sendmail_model->email_action_choose('reset_password');
                        $userdata		=	$this->User_model->get_by_userid($user_id);
                        $userdata = get_object_vars($userdata);
                        
                        //Set up placeholder replacements
                        $data = array(
                                'SiteUsername' => $this->input->post('username')
                        );

                        //Replace placeholders
                        $email_body = $this->Sendmail_model->replace_placeholders($data, $template['email_body']);
                        $template['email_body'] = $email_body;

                        $this->Sendmail_model->email_from_template($template,$userdata);
                    

                    redirect('admin/profile/changepassword');
                    
					$this->session->set_flashdata('flash_message', 'success');
                    $data['flash_message'] = TRUE; 
                }else{
                    
					$this->session->set_flashdata('flash_message', 'error');
                    $data['flash_message'] = FALSE; 
                }
                
	
            }
       }
               
              $data['user'] = $this->Profile_model->get_user_by_id($user_id);             
              $data['username'] = $data['user'][0]['username'];
              $data['user_id'] = $user_id;
              
              
                
		$data['main_content'] = 'admin/profile/changepassword';
                $this->load->view('admin/includes/template', $data);  
    }  
    
    
    
    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
	  	//If user doe snot permissions to add new records, redirect to users page
		if(is_null($this->page_access ) || $this->page_access < 2)
		 {
			$this->session->set_userdata(array('msg'=>''));
			redirect('/admin/users', 'location');
		 }	

		 
        //product id 
        $id = $this->uri->segment(4);
	        
        
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		
		  
            //form validation
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            $this->form_validation->set_rules('username', 'User Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('user_role', 'User Role', 'required');
            $this->form_validation->set_rules('record_status', 'Status', 'required');
            
		
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $permission= '';
                $permissionarray = $this->input->post('permission');
                if (!empty($permissionarray)) {
                    $permission = implode(',', $permissionarray);
                }
              			
                $data_to_store = array(
                            'first_name' => $this->input->post('fname'),
                            'last_name' => $this->input->post('lname'),
                            'username' => $this->input->post('username'),
                            'email' => $this->input->post('email'),
                            'active' => $this->input->post('record_status'),
                            'user_role' => $this->input->post('user_role'),
							'person_id' => null,
                            'created' =>  date('Y-m-d H:i:s')
                    );
                
				//We only want to do this if a person was sleected to link to
			   if(!is_null($this->Users_model->get_person_id($this->input->post('person'))))
			   {
					$person = $this->Users_model->get_person_id($this->input->post('person'));
					$person_id = null;
					if(!empty($person))
						$person_id = $person[0]['pid']; 
					
					$data_to_store['person_id'] = $person_id;
			   }

				
                //if the insert has returned true then we show the flash message
                if($this->Users_model->update_user($id, $data_to_store , $permission, $this->input->post('is_estimator')) == TRUE){
                    $log_to_store = array(
                                'page_id' => get_page_id('Users')->page_id,
                                'action' => 'Add/Update User',
                                'user_id' => $this->session->userdata('user')->user_id,
                                'action_ts' =>  date('Y-m-d H:i:s')
                        );
                    log_audit($log_to_store); // create an helper function for log 
                    
                    
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            }
       }

	  
        //product data 
        $data['user'] = $this->Users_model->get_user_by_id($id); 
		 
		//Determine if estimator
		$is_estimator = null;
		$check = $this->Users_model->is_estimator($data['user'][0]['user_id']);
		if($check->user_id > 0)
			$is_estimator = 'checked';
		
		$data['is_estimator'] = $is_estimator;
		
		/*
        $person = $this->Users_model->get_person_name($data['user'][0]['person_id']);		
        
        $data['person_name'] = null;
        if($person != '')
                $data['person_name'] = $person[0]['pname'];
        
        */
				
		//We only want to do this if a person was sleected to link to
		$data['person_name'] = null;
		if(!is_null($data['user'][0]['person_id']))
		{
			if(!is_null( $this->Users_model->get_person_name($data['user'][0]['person_id'])))
			{
				$person = $this->Users_model->get_person_name($data['user'][0]['person_id']);		
				
				if(!is_null($person[0]['pname']))
					$data['person_name'] = $person[0]['pname'];
			}
        }
		
        $perms = $this->Users_model->get_permission_by_id($id);
        $user_permis = array();
        
        
            if (!empty($perms)) {
                for($i = 0; $i<count($perms);$i++)
                {
                $user_permis[$i] =  $perms[$i]['page_id'].'-'.$perms[$i]['permission_type'];                

                }
             }
  
        $data['user_permissions'] = $user_permis;
         
        $data['user_role'] = $this->Users_model->get_roles();
        $data['permissions_type'] = $this->Users_model->get_permissions_types();
        $data['pages'] = $this->Users_model->get_pages();
        $data['persons'] = $this->Users_model->get_person();
		//print_r($data['persons']);
		
		
		$data['user_id'] = $this->session->userdata('user')->user_id;

        //load the view
        $data['main_content'] = 'admin/users/edit';
        $this->load->view('admin/includes/template', $data);            

    }//update

    

}