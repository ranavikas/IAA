<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class User_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	private $tablename 	= 	'users';

	/**
	* Function for get login user
	*
	* @param username,password
	*
	* @return userdata if login success else false.
	*/
	public function login($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('active',1);
		$query 	= 	$this->db->get($this->tablename);
		if($query->row()){
			return $query->row();
		}else{
			return false;
		}
	}
	
	/**
	* Function to log successful logins/logouts
	*
	* @param username,password
	*
	* @return userdata if login success else false.
	*/
	function log_login($user_id, $session_id, $ip=null)
	{
		$data = array(
			'user_id'		=> 	$user_id,
			'session_id'	=> 	$session_id,
			'login_timestamp' => date('Y-m-d H:i:s'),
			'ip_address'			=> 	$ip
		);
		
		$this->db->insert('logins',$data);
		
		$num = $this->db->affected_rows();	
	}

	/**
	* Function to log successful logouts
	*
	* @param username,password
	*
	* @return userdata if login success else false.
	*/
	function log_logout($session_id)
	{
		$ts = date('Y-m-d H:i:s');
		
		$data = array(
			'logout_timestamp' => $ts
		);
		
		$this->db->where('session_id', $session_id);
		$this->db->update('logins', $data); 
		
		$num = $this->db->affected_rows();	
	}

	/**
	* Function to get all permissions for specific user
	*
	* @param username
	*
	* @return array
	*/
	public function get_user_permissions($username){
		$this->db->select('page_name, page_url, permission_type as plevel');
		$this->db->where('username',$username);
		$query 	= 	$this->db->get('v_user_permissions');
		if($query->row()){
			return $query->result_array();
		}else{
			return false;
		}
	}

	

	/**
	* Function for get Admin details
	*
	* @param email
	*
	* @return userdata.
	*/
	public function get_admin(){
		$this->db->where('user_id',ADMIN_ID);
		$query 	= 	$this->db->get($this->tablename);
		$result = $query->row();
        return $result;
	}
	/**
	* Function for get user By Email
	*
	* @param email
	*
	* @return userdata.
	*/
	public function get_by_username($username){
		$this->db->where('username',$username);
		$query 	= 	$this->db->get($this->tablename);
		$result = $query->row();
        return $result;
	}
        
        /**
	* Function for get user By id
	*
	* @param user_id
	*
	* @return userdata.
	*/
        public function get_by_userid($user_id){
		$this->db->where('user_id',$user_id);
		$query 	= 	$this->db->get($this->tablename);
		$result = $query->row();
        return $result;
	}
	/**
	* Function for get user By Email
	*
	* @param email
	*
	* @return userdata.
	*/
	public function get_by_email($email){
		$this->db->where('email',$email);
		$query 	= 	$this->db->get($this->tablename);
		$result = $query->row();
        return $result;
	}
	/**
	* Function for change status of user Disabled
	*
	* @param user ID
	*
	* @return null.
	*/
	public function disable($id){
		$this->db->where('user_id',$id);
			$data = array(
				'active'	=> 0,
			);
			$result = $this->db->update('users', $data);
	}

	/**
	* Function for get user details by verification code
	*
	* @param user verification code
	*
	* @return user data.
	*/
	public function get_token_data($token){
		$this->db->where('token',$token);
		$this->db->where('token_status',1);
		$this->db->where('token_exp > NOW()');
		$query  = $this->db->get('password_reset');
		$result = $query->row();
        return $result;
	}
	/**
	* Function for Reset user password
	*
	* @param user
	*
	* @return user data.
	*/
	public function reset_password($id){
		$data = array(
				'password'			=> $this->input->post('newpassword'),
			);
		$data = $this->security->xss_clean($data);
		$this->db->where('user_id', $id);
		$result = $this->db->update($this->tablename, $data);
		if($result){
			return true;
		}else{
			return false;
		}
	}
	/**
	* Function for Save User password reset token into password_reset table
	*
	* @param userID,user_email,reset token
	*
	* @return response.
	*/
	function save_token($user_id,$user_email,$token){
        $this->db->where('email',$user_email);
		$query  		= 	$this->db->get('password_reset');
		$result	 		= 	$query->row();
		$startTime 		= 	date("Y-m-d H:i:s");
		$token_exp	 	= 	date('Y-m-d H:i:s',strtotime('+48 hour',strtotime($startTime)));
		if($result){
			$data = array(
				'user_id'		=> 	$user_id,
				'email'			=> 	$user_email,
				'ip'			=> 	$this->input->ip_address(),
				'token'			=> 	$token,
				'token_status'	=> 	1,
				'created_at'	=> 	$startTime,
				'token_exp'		=> 	$token_exp
			);
			$this->db->where('email',$user_email);
			$this->db->update('password_reset',$data);
		}else{
			$data = array(
				'user_id'		=> 	$user_id,
				'email'			=> 	$user_email,
				'ip'			=> 	$this->input->ip_address(),
				'token'			=> 	$token,
				'token_status'	=> 	1,
				'created_at'	=> 	$startTime,
				'token_exp'		=> 	$token_exp
			);
			$this->db->insert('password_reset',$data);
		}
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	/**
	* Function for update token status 0 if password reset success by user
	*
	* @param userID
	*
	* @return response.
	*/
	function update_token($id){
		$data = array(
			'token_status'	=> 0,
		);
		$this->db->where('user_id',$id);
		$update = $this->db->update('password_reset',$data);
		if($update){
			return 1;
		}else{
			return 0;
		}
	}

	

}
