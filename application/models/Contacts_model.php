<?php 

class Contacts_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
    	$this->load->database();
    }

    public function delete_record( $id ) {

    	$this->db->where("contact_id", $id);
    	return $this->db->delete("contacts");
    }

    public function update() {

    	$contact_id = $_POST['contact_id'];

    	unset($_POST['savebtn']);
    	unset($_POST['contact_id']);

    	if ( $contact_id == '0' ) {

    		$this->db->insert("contacts", $_POST);
    		$contact_id = $this->db->insert_id();

    	}else {

    		$this->db->where("contact_id", $contact_id);
    		$this->db->update("contacts", $_POST);
    	}

    	$this->session->set_flashdata("success", TRUE);
    	$this->session->set_flashdata("msg", 'Contacts Saved Successfully');

    	redirect("contacts/update/".$contact_id);
    }

    public function load_data_details( $id ) {

    	$table_fields = array( 
    		"firstname",
    		"lastname",
    		"title",
    		"email",
    		"email2",
    		"phone",
    		"phone_ext",
    		"phone2",
    		"phone2_ext",
    		"organization"
    		);

    	$result = $this->db->get_where("contacts", array(
    		"contact_id" => $id 
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
    * Count the number of rows
    * @return int
    */
     function count_records()
     {
     	$this->db->select('*');
     	$this->db->from('contacts');
     	$query = $this->db->get();
     	return $query->num_rows();        
     }



     public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
     {
     	$this->db->select("contacts.*");
     	$this->db->from('contacts');
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
