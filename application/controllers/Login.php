<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends MY_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','cookie','security'));
        $this->load->library(array('session','form_validation'));
		$this->load->model(array('User_model','Login_attempts_model','Sendmail_model','system/Email_template_model'));
    }
	/**
	* Function for display login page
	*
	* @param null
	*
	* @return Dashboard page.
	*/
	public function index(){
		$login = $this->islogin();
		
		
		
		if($login == true)
		{
			redirect(site_url('participants'));
		}
		if(!empty($this->input->post()))
		{
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required|md5');
			//check validation
			if ($this->form_validation->run() == true) 
			{
				$username 	= 	$this->input->post('username');
				$password 	=	  $this->input->post('password');
				$username   = 	$this->security->xss_clean($username);
				$password   = 	$this->security->xss_clean($password);
				$userdata 	=	  $this->User_model->login($username,$password); //checks user credentials
				//$linked_person = $this->User_model->get_linked_person($username);

				//If account can not be located/incorrect credentials
				if($userdata == FALSE)
				{
                                    
					$this->session->set_flashdata('flash_error','Your account could not be located. Please ensure you are entering the correct username and password, and then try again.');
					redirect(site_url());
				}
				
				//get user permissions
				//$permissions = 	$this->User_model->get_user_permissions($username);
				//$userdata->person_id = $linked_person;
				
				//If userdate has already been retrieved
				if(!empty($userdata))
				{
                                   
					$this->session->set_userdata('user',$userdata);  // Save user data into session
					//$this->session->set_userdata('permissions',$permissions);  // Save user permissions into session
					//$this->session->set_userdata('person_id',$linked_person);
					$this->session->set_userdata('active_user_id',$userdata->user_id);  // Save user data into session
					$this->Login_attempts_model->clear($userdata->user_id);
					$this->session->set_flashdata('flash_success','You have successfully logged in.');
					
					// Sets a permanent session id.  The superglobal changes every 5 mns in CodeIgniter, so we are making one that will persist
					$this->session->set_userdata('sess_id', uniqid());  
					
					//Log login for dashboard status updates
					$this->User_model->log_login($userdata->user_id, $this->session->sess_id, $this->session->ip_address);					
							
					//Redirect to dashboard
					redirect(site_url('participants')); // if login success redirect to participant page.
				}
				else	//If no current userdata, bad login
				{
                                   
					$userdata	=	$this->User_model->get_by_username($username);
					if(!empty($userdata))
					{
						
                                                //If user account is active
						if($userdata->active == 1)
						{
							$result 			  =   $this->Login_attempts_model->create($userdata->user_id,$userdata->username);
							$attempt_number 	  =   $this->Login_attempts_model->check($userdata->user_id);
							$total_attempts 	  =	  2;
							$remaining_attempt 	  =	  $total_attempts-$attempt_number+1;
							
							//If too many bad login attempts, disable account
							if($attempt_number>$total_attempts)
							{
								$this->User_model->disable($userdata->user_id); // Disable the user
								
								/* Disable account email sending to user */
								$template  		    = 	$this->Sendmail_model->template_choose('account_disabled');
								$variables		    =	  $this->Email_template_model->get_variables(); // Get email variables
								$replace_array 	 	= 	array('UserUsername'=>$userdata->first_name.' '.$userdata->last_name);
								$mail_send	      	=	  $this->Sendmail_model->email($template,$userdata,$variables,$replace_array);
								/* Disable account email sending to Admin */
								$admindata 		    = 	 $this->User_model->get_admin();
								$template2 		    = 	 $this->Sendmail_model->template_choose('account_disabled_by_admin');
								$variables2		    =	 $this->Email_template_model->get_variables(); // Get email variables
								$replace_array2 	= 	 array('UserUsername'=>$userdata->first_name.' '.$userdata->last_name);
								$mail_send	      	=	 $this->Sendmail_model->email($template2,$admindata,$variables,$replace_array2);
								$this->session->set_flashdata('flash_error','Your account is disabled please contact your administrater.');
								redirect(site_url());
							}
							else	//If bad attempt, just log it
							{
								$message = $attempt_number.' unsuccessful attempt '.$remaining_attempt.' more tries available before your account gets disabled.';
								$this->session->set_flashdata('flash_error',$message);
								redirect(site_url());
							}
						}
						else
						{
							$this->session->set_flashdata('flash_error','Your account has been disabled please contact your administrator.');
							redirect(site_url());
						}
					}
					else
					{
						$this->session->set_flashdata('flash_error','Your username or password is incorrect.');
						redirect(site_url());
					}
				}
            }
			
		}
		//load the view
		$this->data['page_title'] 	= 	PROJECT_NAME.'::Login Page';
                $this->render('login/login','outer');
	}
	/**
	* Function for display Dashboard page
	*
	* @param null
	*
	* @return Dashboard page.
	*/
	public function dashboard(){
		$login = $this->islogin();
		if($login == false){
			redirect(base_url());
		}
    //load the view
		$this->data['page_title'] 	= 	PROJECT_NAME.'::Dashboard';
    $this->render('dashboard','inner');
	}
	/**
	* Function for Logout user
	*
	* @param null
	*
	* @return Login Page.
	*/
	public function logout()
	{		
		

                $this->User_model->log_logout($this->session->sess_id);
		
		$this->session->unset_userdata('user');
		$this->session->set_flashdata('flash_success','You have successfully logged out.');
		redirect(base_url());
	}
	/**
	* Function for generate Random string
	*
	* @param number
	* @return randomstring.
	*/
	function generate_random_string($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	/**
	* Function for Display forgot Password page and sending password request link to user.
	*
	* @null
	* @return login page
	*/
	public function forgotpassword(){
		$login = $this->islogin();
		if($login == true){
			redirect(site_url('participants'));
		}
		if(!empty($this->input->post())){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			if($this->form_validation->run() == true){
					$email 	=  $this->input->post('email');
					$email 	=  $this->security->xss_clean($email);
					$this->session->set_userdata('useremail', $email);
					$userdata 	=	$this->User_model->get_by_email($email);
				if(!empty($userdata)){
					if($userdata->active == 1){
						$token        	= 	$this->generate_random_string(20);
						$template     	=  	$this->Sendmail_model->template_choose('forgot_password');
						$variables    	=  	$this->Email_template_model->get_variables(); // Get email variables
						$reset_link   	=   site_url().'/reset-password/'.$token;
						$replace_array	= 	array('UserUsername'=>$userdata->first_name.' '.$userdata->last_name,'FORGOT_PASSWORD_LINK'=>$reset_link,'LINK'=>$reset_link);
						$mail_send	=	$this->Sendmail_model->email($template,$userdata,$variables,$replace_array);
							if($mail_send){
								$this->User_model->save_token($userdata->user_id,$email,$token);
								$this->session->set_flashdata('flash_success','Password reset link has been sent to your email address please check your email.');
								redirect(site_url());
							}else{
								$this->session->set_flashdata('flash_error','Technical error please try again later.');
								redirect(site_url('forgotpassword'));
							}
					}else{
						$this->session->set_flashdata('flash_error','Your account has been disabled please contact your administrator.');
						redirect(site_url('forgotpassword'));
					}
				}else{
					$this->session->set_flashdata('flash_error','You email is not registered with '.PROJECT_NAME);
					redirect(site_url('forgotpassword'));
				}
		}
	}
      //load the view
  		$this->data['page_title'] 	= 	PROJECT_NAME.'::Forgot Password';
      $this->render('login/forgotpassword','outer');
	}
	/**
	* Function Display Reset Password Page
	*
	* @param Reset Password Token
	* @Display Error 404 page if Reset Password Token is invalid.
	* @return login page if password reset successfull and return link is expired or invalid link.
	*/
	public function resetpassword($token){
		$login = $this->islogin();
		if($login == true){
			redirect(site_url('participants'));
		}
		$tokendata = $this->User_model->get_token_data($token);
		if($tokendata){
			$userdata  = $this->User_model->get_by_email($tokendata->email);
			if(!empty($this->input->post())){
				$this->form_validation->set_rules('newpassword','Password','trim|required|md5');
				$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|md5|matches[newpassword]');
				if($this->form_validation->run() == true){
						$passwordreset = $this->User_model->reset_password($userdata->user_id);
						if($passwordreset){
							$this->User_model->update_token($userdata->user_id);     // Set token status 0 if password reset success
							/* Sending password change infomation to User */
							$template 			 = 	$this->Sendmail_model->template_choose('password_reset');
							$variables		     =	$this->Email_template_model->get_variables(); // Get email variables
							$replace_array 	 	 = 	array('UserUsername'=>$userdata->first_name.' '.$userdata->last_name);
							$mail_send	       	 =	$this->Sendmail_model->email($template,$userdata,$variables,$replace_array);
							$this->session->set_flashdata('flash_success','You have successfully changed your Password.');
							redirect(site_url());
						}else{
								$this->session->set_flashdata('flash_error','Technical error please try again later.');
								redirect(site_url());
						}
				  }
			}
      //load the view
  		$this->data['page_title'] 	= 	PROJECT_NAME.'::Reset Password';
      $this->render('login/resetpassword','outer');
		}else{
			$this->session->set_flashdata('flash_error','Your reset password link is expired please generate new link.');
			redirect(site_url('forgotpassword'));
		}
  }
	/**
	* Function checks if user login or not
	*
	* if user logged in it redirects to dashboard page else it redirects to login page.
	*/
	public function islogin(){
		if($this->session->has_userdata('user')){
			return true;
		}else{
			return false;
		}
	}
}
