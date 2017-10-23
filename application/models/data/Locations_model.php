<?php 

class Locations_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
    	$this->load->database();
    }

    public function delete_record( $id ) {

    	$this->db->where("location_id", $id);
    	return $this->db->delete("locations");
    }

    public function location_type() {


    	$result = $this->db->get("location_types")->result_array();

    	return $result;
    }  

    public function update() {

    	$location_id = $_POST['location_id'];

    	unset($_POST['savebtn']);
    	unset($_POST['location_id']);

    	if ( $location_id == '0' ) {

    		$this->db->insert("locations", $_POST);
    		$location_id = $this->db->insert_id();

    	}else {

    		$this->db->where("location_id", $location_id);
    		$this->db->update("locations", $_POST);
    	}

    	$this->session->set_flashdata("success", TRUE);
    	$this->session->set_flashdata("msg", 'Locations Saved Successfully');

    	redirect("data/locations/update/".$location_id);
    }

    public function load_data_details( $id ) {

    	$table_fields = array( 
    		"location_name",
    		"address1",
    		"address2",
    		"city",
    		"state",
    		"zip",
    		"email",
    		"phone",
    		"location_type"
    		);

    	$result = $this->db->get_where("locations", array(
    		"location_id" => $id 
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
     	$this->db->from('locations');
     	$query = $this->db->get();
     	return $query->num_rows();        
     }



     public function get_records( $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
     {
     	$this->db->select("locations.*, location_types.location_type");
     	$this->db->from('locations');
     	$this->db->join('location_types', 'locations.location_type = location_types.id', 'left');

     	if($order){
     		$this->db->order_by($order, $order_type);
     	}else{
     		$this->db->order_by('location_id', $order_type);
     	}

     	$this->db->limit($limit_start, $limit_end);

     	$query = $this->db->get();

     	return $query->result_array(); 	
     }




 }
 ?>	
