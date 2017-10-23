<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Workflow_model extends CI_Model{
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
	
	//return all email recipients
	function production_emails()
	{
        $this->db->select("*, CONCAT(first_name, ' ', last_name) as rname");
        $this->db->from('production_emails');
        //$this->db->where('clients.client_id', $id);
        
        $query = $this->db->get();
        return $query->result_array();  

	}
	
	function get_recipient($id)
	{
        $this->db->select("*, CONCAT(first_name, ' ', last_name) as rname");
        $this->db->from('production_emails');
        $this->db->where('recipient_id', $id);
        
        $query = $this->db->get();
		//echo $this->db->last_query(); die();
        return $query->result_array();  
	}
	
	function add_recipient($data)
	{
		$success = $this->db->insert('production_emails', $data); //store data in to client table
		
		if($success)
		{
			$id =  $this->db->insert_id();
			return true;
		}
		else
		{
			return false;
		}
			
		
	}
	
	
	function update($id, $firstname, $lastname, $email)
	{
        $data = array(
            'first_name' => 	$firstname,
            'last_name' => 	$lastname,
            'email' => 	$email,
			
         );
		 
        $this->db->where('recipient_id', $id);
        if($this->db->update('production_emails', $data))
		{
			$this->db->flush_cache();
			$this->db->reset_query();	

			return true;
		}
		else
		{
			return false;
		}


	}
	
	
	function delete($id)
	{
        $success = FALSE;
            
        $data_to_delete = array(
            'recipient_id' => 	$id	
         );
		 
		if($this->db->delete('production_emails', $data_to_delete))
		{
			$log_to_store = array
			(
				'page_id' => get_page_id('ProductionEmails')->page_id,
				'action' => 'Deleted recipient',
				'user_id' => $this->session->userdata('user')->user_id,
				'record_id' => $id,
				'action_ts' =>  date('Y-m-d H:i:s')
			);
			
			
			log_audit($log_to_store); // create an helper function for log 
			
			return true;
		}
		else 
		{
			return false;
		}
	
	}
	
}
