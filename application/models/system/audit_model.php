<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Audit_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	private $tablename 		= 	'audit';
  /**
	* Function for get audit logs
	*
	* @param null
	*
	* @return response results.
	*/
	public function audit_logs(){
		$this->db->order_by('audit_id','desc');
		$q = $this->db->get('v_audit_records');
		$result = $q->result_array();
		return $result;
	}
	/**
	* Function for get count of audit logs
	*
	* @param null
	*
	* @return response results.
	*/
	 public function count_audit_records(){
        $q 	= $this->db->get($this->tablename);
		$total_records = $q->num_rows();
		return $total_records;
    }
    /**
	* Function for get audit logs from ajax
	*
	* @param search,limit,offset
	*
	* @return response results.
	*/
	public function get_audit_ajax($search,$limit=10,$offset=0,$column_id=null,$column_order=null){
		$column_name = array('page_name','action','username','action_ts');
		if($search != ''){
			$this->db->select('*');
			$this->db->from($this->tablename);
			$this->db->join('pages', 'pages.page_id = audit.page_id', 'left');
			$this->db->join('users', 'users.user_id = audit.user_id', 'left');
			$where = "";
			$where .= "(pages.page_name LIKE '%$search%' OR ";
			$where .= "audit.action LIKE '%$search%' OR ";
			$where .= "users.username LIKE '%$search%' OR ";
			$where .= "audit.action_ts LIKE '%$search%')";
			$this->db->where($where);
			$this->db->limit($limit,$offset);
			$this->db->order_by($column_name[$column_id],$column_order);
			$q 	= $this->db->get();
			$filtered_records = $q->num_rows();
			$result = $q->result_array();
			return array($filtered_records,$result);
		}
		else{
			$this->db->select('*');
			$this->db->from($this->tablename);
			$this->db->join('pages', 'audit.page_id = pages.page_id', 'left');
			$this->db->join('users', 'audit.user_id = users.user_id', 'left');
			$this->db->limit($limit,$offset);
			$this->db->order_by($column_name[$column_id],$column_order);
			$q 	= $this->db->get();
			$filtered_records = $q->num_rows();
			$result = $q->result_array();
			return array($filtered_records,$result);
	}
	}
	
	//Truncate the audit log table
	function clear_log()
	{
		try
		{
			$this->db->truncate('audit'); 
			
			$data = array(
			
				'page_id' => 4,
				'action' => 'Cleared Audit Log',
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
