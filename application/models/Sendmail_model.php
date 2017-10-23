<?php
class Sendmail_model extends CI_Model
{
	private $templatetable 	= 	'email_templates';
	private $log_table 			= 	'email_log';
	private $logtable 	= 	'email_log';
	
	
	function __construct(){
		
		$this->log_table = 'email_log';
		$this->templatetable = 'email_templates';
	}
	
	/**
	* Function for get Email template from database
	*
	* @param template action name
	*
	* @return template body.
	*/
	function template_choose($action){
		$this->db->where('action',$action);
		$query = $this->db->get($this->templatetable);
		return $query->row();
	}
	

	/**
	* Function for get Email actions options
	*
	* @param template action name
	*
	* @return template action options. 
	*/
	function email_action_choose($action)
	{
		//die("action is $action");
		$this->db->where('action',$action);
		$query = $this->db->get($this->templatetable);
		return $query->row();
	}
	
	
	/**
	* Function for sending account disable email to user 
	*
	* @param Template,Actions,userdata. 
	*/
	function disable_email($Template,$Actions,$userdata){
		$cons 			= 	explode(',',$Actions->options);
		$constants 		= 	array();
		foreach($cons as $key=>$val){
			$constants[] = '{'.$val.'}';
		}
			$fullname	 =		$userdata->first_name.' '.$userdata->last_name;
			$email	 	 =		$userdata->email;
			$subject 	 =  	$Template->email_subject;
			$rep_Array 	 = 		array($fullname);
			$messageBody =  	str_replace($constants, $rep_Array, $Template->email_body);
			$messageBody = 		$this->load->view('email/emailTemplate.php',array('messageBody'=> $messageBody),TRUE);
			$mail_send 	 = 		$this->send_email($email,$fullname,$subject,$messageBody);
			if($mail_send)
			{
				$this->save_email_logs($Template->template_name, $email, 1);
				return true;
			}else
			{
				$this->save_email_logs($Template->template_name, $email, 2);
				return false;
			}		
	}
	
	
	/**
	* Function for sending account disable email to Admin 
	*
	* @param Template,Actions,userdata,adminEmail. 
	*/
	function disable_email_admin($Template,$Actions,$userdata,$adminemail)
	{
		$cons 		   	= 	explode(',',$Actions->options);
		$constants 	   	= 	array();
		foreach($cons as $key=>$val){
			$constants[] = '{'.$val.'}';
		}
		$fullname	 	=	$userdata->first_name.' '.$userdata->last_name;
		$subject 	 	=  	$Template->email_subject;
		$rep_Array 	 	= 	array($fullname);
		$messageBody 	=  	str_replace($constants, $rep_Array, $Template->email_body);
		$messageBody 	= 	$this->load->view('email/emailTemplate.php',array('messageBody'=> $messageBody),TRUE);
		$mail_send 	 	= 	$this->send_email($adminemail,$fullname,$subject,$messageBody);
		
		
		if($mail_send)
		{
			$this->save_email_logs($Template->template_name, $adminemail, 1);
			return true;
		}else
		{
			$this->save_email_logs($Template->template_name, $adminemail, 2);
			return false;
		}				
	}

	/**
	* Function for sending change password email to User 
	*
	* @param Template,Actions,userdata. 
	*/
	function change_password_email($Template,$Actions,$userdata){
		$cons 				= 	explode(',',$Actions->options);
		$constants 			= 	array();
		foreach($cons as $key=>$val){
			$constants[] 	= 	'[['.$val.']]';
		}
			$fullname	 	=	$userdata->first_name.' '.$userdata->last_name;
			$email	 	 	=	$userdata->email;
			$subject 	 	=  	$Template->email_subject;
			$rep_Array 	 	= 	array($fullname);
			$messageBody 	=  	str_replace($constants, $rep_Array, $Template->email_body);
			$messageBody 	= 	$this->load->view('email/emailTemplate.php',array('messageBody'=> $messageBody),TRUE);
			$mail_send 		= 	$this->send_email($email,$fullname,$subject,$messageBody);
			if($mail_send)
			{
				$this->save_email_logs($Template->template_name, $email, 1);
				return true;
			}else
			{
				$this->save_email_logs($Template->template_name, $email, 2);
				return false;
			}		
	}
	
	
	/**
	* Function for sending change password email to User 
	*
	* @param Template,Actions,userdata. 
	*/
	function forgot_password_email($Template,$Actions,$userdata,$token){
		$cons 				= 	explode(',',$Actions->options);
		$constants 			= 	array();
		foreach($cons as $key=>$val){
			$constants[] 	= 	'{'.$val.'}';
		}
			$fullname	 	=	$userdata->first_name.' '.$userdata->last_name;
			$reset_link  	= 	WEBSITE_URL.'/reset-password/'.$token;
			$email	 	 	=	$userdata->email;
			$subject 	 	=  	$Template->email_subject;
			$rep_Array 	 	= 	array($fullname,$reset_link,$reset_link);
			$messageBody 	=  	str_replace($constants, $rep_Array, $Template->email_body);
			$messageBody 	= 	$this->load->view('email/emailTemplate.php',array('messageBody'=> $messageBody),TRUE);
			$mail_send 		= 	$this->send_email($email,$fullname,$subject,$messageBody);
			
			if($mail_send)
			{
				$this->save_email_logs($Template->template_name, $email, 1);
				return true;
			}else
			{
				$this->save_email_logs($Template->template_name, $email, 2);
				return false;
			}			
	}
	
	/**
	* Function for sending new account notice to User
	*
	* @param Template,Actions,userdata. 
	*/
	function new_account_email($Template,$Actions,$userdata, $password)
	{
		$cons 				= 	explode(',',$Actions->options);
		$constants 			= 	array('{WEBSITE_URL}', '{SiteUsername}','{SitePassword}');
		foreach($cons as $key=>$val){
			$constants[] 	= 	'{'.$val.'}';
		}
			$fullname	 	=	$userdata->first_name.' '.$userdata->last_name;
			$username		=   $userdata->username;
			$email	 	 	=	$userdata->email;
			$subject 	 	=  	$Template->email_subject;
			
			$rep_Array 	 	= 	array(WEBSITE_URL,$username, $password);
			
			$messageBody 	=  	str_replace($constants, $rep_Array, $Template->email_body);
			
			
			$messageBody 	= 	$this->load->view('email/emailTemplate.php',array('messageBody'=> $messageBody),TRUE);
			$mail_send 		= 	$this->send_email($email,$fullname,$subject,$messageBody);
			if($mail_send)
			{
				$this->save_email_logs($Template->template_name,$email, 1);
				return true;
			}else
			{
				$this->save_email_logs($Template->template_name,$email, 2);
				return false;
			}
	}	



	/**
	* Default function for sending email.
	*
	* @param useremail,username,email subject,email body.
	* @return response true if mail sent otherwise false.
	*/
	public function send_email($to_email,$fullname,$subject,$messageBody){
	  $config['protocol']    	= 	PROTOCOL;
		$config['smtp_host']    = 	SMTP_HOST;
		$config['smtp_port']    = 	SMTP_PORT;
		$config['smtp_user']    = 	SMTP_USER;
		$config['smtp_pass']    = 	SMTP_PASS;
		$config['mailtype'] 		= 	MAIL_TYPE;
		$config['charset'] 			= 	CHARSET;
		$config['newline'] 			= 	"\r\n";

		$this->load->library('email',$config);
		$this->email->from(SMTP_USER, PROJECT_NAME);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($messageBody);
		if(!empty($this->email->send()))
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	
	
	/**
	* Function for saving email logs which is sent to user
	*
	* @param template_name,email,user ID.
	*/
	public function save_email_logs($template_name,$email, $result=1)
	{
		$data = array(
				'email_template'	=> 	$template_name,
				'recipient'				=> 	$email,
				'sent_at'					=> 	date("Y-m-d H:i:s"),
				'results'					=> 	$result
			);
			
		$this->db->insert($this->log_table,$data);
	}
	
	
	 /**
	* Function for sending email.
	*
	* @param template-data,userdata,variables,replace-array.
	* @calls default email function.
	*/
    public function email($template,$userdata,$variables,$replace_array){
    	foreach($variables as $cons){
				$constants[$cons['variable_name']] = '[['.$cons['variable_name'].']]';
			}
			$replace_array		=		array_merge($constants,$replace_array);
			$messageBody 			= 	str_replace($constants,$replace_array,$template->email_body);
			$messageBody 			= 	$this->load->view('emailtemplates/emailTemplate.php',array('messageBody'=> $messageBody),TRUE);
	    $fullname	 				=		$userdata->first_name.' '.$userdata->last_name;
			$email	 	 				=		$userdata->email;
			$subject 	 				=  	$template->email_subject;
			
			$mail_send 				= 	$this->send_email($email,$fullname,$subject,$messageBody);

			
			if($mail_send)
			{
				$this->save_email_logs($template->template_name, $email, 1);
				return true;
			}else
			{
				$this->save_email_logs($template->template_name, $email, 2);
				return false;
			}		
    }
	

	
	/**
	/**
	* Function for sending email.
	*
	* @param template-data,userdata,variables,replace-array.
	* @calls default email function.
	*/
    public function email_by_array($template,$userdata,$variables,$replace_array)
	{
		$constants  = array();
    	foreach($variables as $cons){
				
				$constants[] = "[[$cons]]";
				
			}

		
		$body = $template[0]['email_body'];
    	for($i=0; $i<sizeof($constants); $i++)
		{
			
			$body = str_replace($constants[$i], $replace_array[$i], $body);
				
		}
						
			
	        $fullname	 				=		$userdata['first_name'].' '.$userdata['last_name'];
			$email	 	 				=		$userdata['email'];
			$subject 	 				=  	$template[0]['email_subject'];

			$mail_send 				= 	$this->send_email($email,$fullname,$subject,$body);

			if($mail_send)
			{
				$this->save_email_logs($template[0]['template_name'], $email, 1);
				return true;
			}else
			{
				$this->save_email_logs($template[0]['template_name'], $email, 2);
				return false;
			}	
			
    }
	
	
	//Standardized function for sending emails based on templates
    function email_from_template($template, $userdata)
	{
	        $fullname =		$userdata['first_name'].' '.$userdata['last_name'];
			$email =		$userdata['email'];
			$subject =  	$template['email_subject'];
			$body = $template['email_body'];

			$mail_send	= 	$this->send_email($email, $fullname, $subject, $body);

			if($mail_send)
			{
				$this->save_email_logs($template['template_name'], $email, 1);
				return true;
			}else
			{
				$this->save_email_logs($template['template_name'], $email, 2);
				return false;
			}	
			
    }

	
	//Function for replacing placeholders in email templates with specific values
	function replace_placeholders($data=null, $str)
	{
		//Replace for site constants
		$str = str_replace('[[WEBSITE_URL]]', '<a href="'.WEBSITE_URL.'">'.WEBSITE_URL.'</a>', $str);
		$str = str_replace('[[SiteURL]]', '<a href="'.WEBSITE_URL.'">'.WEBSITE_URL.'</a>', $str);
		$str = str_replace('[[SiteURL]]', WEBSITE_URL, $str);
		$str = str_replace('[[PROJECT_NAME]]', PROJECT_NAME, $str);
		$str = str_replace('[[COMPANY_NAME]]', COMPANY_NAME, $str);
		$str = str_replace(' {WEBSITE_URL}', '<a href="'.WEBSITE_URL.'">'.WEBSITE_URL.'</a>', $str);
		$str = str_replace(' {SiteURL}', '<a href="'.WEBSITE_URL.'">'.WEBSITE_URL.'</a>', $str);
		$str = str_replace(' {SiteURL}', WEBSITE_URL, $str);
		$str = str_replace('{PROJECT_NAME}', PROJECT_NAME, $str);
		$str = str_replace('{COMPANY_NAME}', COMPANY_NAME, $str);
		

		//Replace for specific data
		foreach($data as $key => $val)
		{
			$str = str_replace("[[$key]]", $val, $str);
			$str = str_replace('{'.$key.'}', $val, $str);
		}
				
		return $str;
	}	
		
}
