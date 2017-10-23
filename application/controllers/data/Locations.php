<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
 * Locations Controller Class 
 */
 class Locations extends CI_Controller {

    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {


    	ob_start(); 
    	parent::__construct();

        //If user is not logged in, redirect them to the login page
    	$userarray = get_object_vars($this->session->userdata('user'));
    	$sess_id = $userarray['user_id'];
    	if(empty($sess_id))
    	{
    		$this->session->set_userdata(array('msg'=>''));
    		redirect('/login', 'location');
    	}

    	$this->load->model('data/Locations_model');
    	$this->load->library(array('session','form_validation'));

    }
    
    
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //pagination settings
    	$config['per_page'] = 200;
    	$config['base_url'] = base_url().'locations';
    	$config['use_page_numbers'] = TRUE;
    	$config['num_links'] = 20;
    	$config['full_tag_open'] = '<ul>';
    	$config['full_tag_close'] = '</ul>';
    	$config['num_tag_open'] = '<li>';
    	$config['num_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a>';
    	$config['cur_tag_close'] = '</a></li>';

        //limit end
    	$page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
    	$limit_end = ($page * $config['per_page']) - $config['per_page'];
    	if ($limit_end < 0){
    		$limit_end = 0;
    	} 
    	$order_type = 'Asc';


    	$data['count_records']= $this->Locations_model->count_records();
    	$data['records'] = $this->Locations_model->get_records( '','', $order_type, $config['per_page'],$limit_end);        
    	$config['total_rows'] = $data['count_records'];


        //initializate the panination helper 
    	$this->pagination->initialize($config);         


		//load the view
    	$data['main_content'] = 'locations/list';
    	$this->load->view('includes/template', $data);  

    }//index



    public function update( $id = 0 )
    {

    	$data['locations'] = $this->Locations_model->load_data_details( $id );
    	$data['location_type'] = $this->Locations_model->location_type ();
    	$data['location_id'] = $id ;      
    	$data['main_content'] = 'locations/edit';
    	$this->load->view('includes/template', $data);   
    } 

    public function do_update()
    {
    	$this->Locations_model->update ();
    }



     /**
    * Delete ethnicity record
    * @return void
    */
     public function delete()
     {

        //ethnicity id 
     	$id = $_POST['id'];

		//delete
     	if($this->Locations_model->delete_record($id))
     	{
     		$this->session->set_flashdata('success', TRUE);
     		$this->session->set_flashdata('msg', "Record successfully deleted.");
     	}
     	else
     	{
     		$this->session->set_flashdata('success', FALSE);
     		$this->session->set_flashdata('msg', "ERROR: Record could not be deleted.");
     	}

     }

 }