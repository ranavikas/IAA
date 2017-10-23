<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Email_template_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	private $template_table 	= 	'email_templates';
	private $variable_table 	= 	'mail_variables';
	/**
	* Function for get template data
	*
	* @param null
	*
	* @return response.
	*/

	public function get(){
		$this->db->where('status','1');
		$this->db->order_by("template_id", "desc");
		$q = $this->db->get($this->template_table);
		$result = $q->result_array();
		return $result;
	}

	/**
	* Function for edit template
	*
	* @param id
	*
	* @return update record of table.
	*/

	public function edit_template($key){
		$data = array(
			'template_name'  =>  $this->input->post('name'),
      'action' 		     =>  $this->input->post('action'),
			'email_subject'  =>  $this->input->post('subject'),
			'email_body'     =>  $this->input->post('body'),
			);
		$this->db->where('template_id',$key);
		$this->db->update($this->template_table,$data);
	}
	/**
	* Function for add a new template
	*
	* @param null
	*
	* @return insert new record into table.
	*/
	public function add_template(){
		$data = array(
			'template_name'   =>$this->input->post('name'),
			'action' 		      =>$this->input->post('action'),
			'email_subject'   =>$this->input->post('subject'),
			'email_body'      =>$this->input->post('body'),
			);
		$this->db->insert($this->template_table,$data);
	}
	/**
	* Function for get a record by id
	*
	* @param id
	*
	* @return response.
	*/
	public function get_by_id($id){
		$this->db->where('template_id',$id);
		$q = $this->db->get($this->template_table);
		$result = $q->result_array();
		return $result;
	}
	/**
	* Function for delete email template
	*
	* @param id
	*
	* @return response true if delete success otherwise false.
	*/
	public function delete($id){
		$this->db->where('template_id',$id);
		$this->db->set('status', '3', FALSE);
		$result = $this->db->update($this->template_table);
		if(!$result){
			return false;
		}
		return true;
	}
	/**
	* Function for get email variables
	*
	* @param null
	*
	* @return response results on success otherwise false.
	*/
	function get_variables(){
		$query		=		$this->db->get($this->variable_table);
		if($query->num_rows() > 0){
			$results 	=		$query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	/**
	* Function for get count of total records of email templates.
	*
	* @param null
	*
	* @return response results.
	*/
	 public function count_records(){
		$this->db->where('status',1);
        $q 	= $this->db->get($this->template_table);
		$total_records = $q->num_rows();
		return $total_records;
    }
    /**
	* Function for get email templates.
	*
	* @param search,limit,offset,column_id,column_order
	*
	* @return response results.
	*/
	public function get_templates($search,$limit=10,$offset=0,$column_id=null,$column_order=null){
		$column_name = array('template_id','template_name','email_subject');
		if($search != ''){
			$where = "";
			$where .= "(email_templates.template_name LIKE '%$search%' OR ";
			$where .= "email_templates.email_subject LIKE '%$search%')";
			$this->db->where($where);
			$this->db->where('status','1');
			$this->db->limit($limit,$offset);
			$this->db->order_by($column_name[$column_id],$column_order);
			$q 	= $this->db->get($this->template_table);
			$filtered_records = $q->num_rows();
			$result = $q->result_array();
			return array($filtered_records,$result);
		}else{
			$this->db->where('status','1');
			$this->db->limit($limit,$offset);
      if($column_order){
        $this->db->order_by($column_name[$column_id],$column_order);
      }else{
        $this->db->order_by('template_id','desc');
      }
			$q 	= $this->db->get($this->template_table);
			$filtered_records = $q->num_rows();
			$result = $q->result_array();
			return array($filtered_records,$result);
	}
  }
  /**
  * Function checks if template name already exists or not.
  *
  * @param id,name
  *
  * @return response results.
  */
  function unique_template_name($id = '', $name) {
       $this->db->where('status',1);
       $this->db->where('template_name', $name);
       if($id) {
           $this->db->where_not_in('template_id', $id);
       }
       return $this->db->get($this->template_table)->num_rows();
   }
}
