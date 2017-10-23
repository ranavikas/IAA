<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login_attempts_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	private $tablename = 'login_attempts';
	/**
	* Function insert login failed attempt
	*
	* @param user ID and Username
	*
	* @return response . 
	*/
	public function create($userid,$username){
		$data = array(
				'user_id' 		=> $userid,
				'username'		=> $username,
				'ip_address'	=> $this->input->ip_address(),
				'created_at'	=> date('Y-m-d H:i:s')
		
		);
		$this->db->insert($this->tablename,$data);
		if($this->db->affected_rows() > 0){
            return true;
        } 
        else{
            return false;
        } 
	}
	/**
	* Function checks if wrong attempt are more than 3
	*
	* @param user ID
	*
	* @return true if more than 3 and false vice versa. 
	*/
	public function check($userid){
		$this->db->where('user_id',$userid);
		$query = $this->db->get($this->tablename);
		$attempt_numbers =  $query->num_rows();
		return $attempt_numbers;
	}
	/**
	* Function clear login attempts if user logged in.
	*
	* @param Username
	* 
	* @function calls a specific mysql procedure.
	* @return response. 
	*/
	public function Clear($username){
		$result = $this->db->query('CALL Clear_login_attempts("'.$username.'")');
	}
	
}