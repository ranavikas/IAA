<?php 

class Clients_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
    	$this->load->database();
    }

    public function get_list($table_list) {
    	return $this->db->get($table_list)->result_array();
    }

    public function delete_record( $id ) {

    	$this->db->where("client_id", $id);
    	return $this->db->delete("clients");
    }

    public function update() {

    	$client_id = $_POST['client_id'];

    	unset($_POST['savebtn']);
    	unset($_POST['client_id']);

    	if ( $client_id == '0' ) {

    		$this->db->insert("clients", $_POST);
    		$client_id = $this->db->insert_id();

    	}else {

    		$this->db->where("client_id", $client_id);
    		$this->db->update("clients", $_POST);
    	}

    	$this->session->set_flashdata("success", TRUE);
    	$this->session->set_flashdata("msg", 'Clients Saved Successfully');

    	redirect("data/clients/update/".$client_id);
    }

    public function load_data_details( $id ) {

    	$table_fields = array( 
    		"client_name",
    		"default_location",
    		"default_contact",
    		"shipping_carrier",
    		"shipping_account"
    		);

    	$result = $this->db->get_where("clients", array(
    		"client_id" => $id 
    		))->result_array();

    	$details = array();

    	if ( sizeof($result) > '0' ) {

    		foreach ( $table_fields as $field ) {

    			$details[$field] = $result[0][$field];
    		}
    	}else {

    		foreach ( $table_fields as $field ) {

    			$details[$field] = '';
    		}
    	}

    	return $details;
    }

    /**
    * Get user by his is
    * @param int $id 
    * @return array
    */
    public function get_record_by_id($id)
    {
    	$this->db->select('*');
    	$this->db->from('participants');
    	$this->db->where('participant_id', $id);
    	$query = $this->db->get();
    	return $query->result_array(); 
    }
    
    public function count_record_by_id($id)
    {
    	$this->db->select('*');
    	$this->db->from('participants');
    	$this->db->where('participant_id', $id);
    	$query = $this->db->get();
    	return $query->num_rows();
    }
    
    
    public function count_autosave_record_by_userid($user_id)
    {
    	$this->db->select('*');
    	$this->db->from('participants_autosave');
    	$this->db->where('user_id', $user_id);
    	$query = $this->db->get();
    	return $query->num_rows();   
    }
    
    public function get_autosave_record_by_userid($user_id)
    {
    	$this->db->select('*');
    	$this->db->from('participants_autosave');
    	$this->db->where('user_id', $user_id);
    	$query = $this->db->get();
    	return $query->result_array(); 
    }
    
    
    public function get_edu_parent($edu_id)
    {
    	$this->db->select('parent_education_level');
    	$this->db->from('education_status');
    	$this->db->where('id', $edu_id);
    	$query = $this->db->get();
    	return $query->result_array(); 
    }
    
     /**
    * Count the number of rows
    * @return int
    */
     function count_records()
     {
     	$this->db->select('*');
     	$this->db->from('clients');
     	$query = $this->db->get();
     	return $query->num_rows();        
     }



     public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
     {
     	$this->db->select("clients.*, locations.location_name, contacts.firstname, contacts.lastname");
     	$this->db->from('clients');
     	$this->db->join('locations', 'locations.location_id = clients.default_location', 'left');
     	$this->db->join('contacts', 'contacts.contact_id = clients.default_contact', 'left');

     	if($order){
     		$this->db->order_by($order, $order_type);
     	}else{
     		$this->db->order_by('contact_id', $order_type);
     	}

     	$this->db->limit($limit_start, $limit_end);

     	$query = $this->db->get();

     	return $query->result_array(); 	
     }




 }
 ?>	
