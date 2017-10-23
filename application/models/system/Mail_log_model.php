<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mail_log_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	private $tablename 	    = 	'email_log';
	/**
	* Function for get email logs
	*
	* @param null
	*
	* @return response results.
	*/
	public function logs(){
		$this->db->order_by('email_id','desc');
		$q = $this->db->get($this->tablename);
		$result = $q->result_array();
		//print_r($result);
		return $result;
	}

	/**
	* Function for count email logs record
	*
	* @param null
	*
	* @return number of records.
	*/
	 public function count_log_records(){
       $q 	= $this->db->get($this->tablename);
		   $total_records = $q->num_rows();
		   return $total_records;
    }
    /**
  	* Function for get email logs from ajax
  	*
  	* @param search,limit,offset,column_id,column_order(asc,desc)
  	*
  	* @return response results.
  	*/
  	public function get_logs_ajax($search,$limit=10,$offset=0,$column_id=null,$column_order=null){
  		$column_name = array('email_template','recipient','results','sent_at');
  		if($search != ''){
  			$where = "";
  			$where .= "(email_log.email_template LIKE '%$search%' OR ";

  			$where .= "email_log.sent_at LIKE '%$search%' OR ";
  			$where .= "email_log.results LIKE '%$search%' OR ";
  			$where .= "email_log.recipient LIKE '%$search%')";
  			$this->db->where($where);
  			$this->db->limit($limit,$offset);
  			$this->db->order_by($column_name[$column_id],$column_order);
  			$q 	= $this->db->get($this->tablename);
  			$filtered_records = $q->num_rows();
  			$result = $q->result_array();
  			return array($filtered_records,$result);
  		}
    		else{
    			$this->db->limit($limit,$offset);
    			$this->db->order_by($column_name[$column_id],$column_order);
    			$q 	= $this->db->get($this->tablename);
    			$filtered_records = $q->num_rows();
    			$result = $q->result_array();
    			return array($filtered_records,$result);
    	}
  	}
	
	
	//Truncate the email log table
	function clear_log()
	{
		try
		{
			$this->db->truncate('email_log'); 
			
			$data = array(
			
				'page_id' => 5,
				'action' => 'Cleared Email Log',
				'user_id' => $this->session->userdata('active_user_id'),
				'action_ts' => date('Y-m-d H:i:s')
			);
			
			log_audit($data);
			return 1;
		}
		catch (Exception $e)
		{
			return $this->db->error();
		}
	}
	
	
}
