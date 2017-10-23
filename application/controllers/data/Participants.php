<?php
class Participants extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
	   
	 
	ob_start(); 
	parent::__construct();
        
       $this->load->model('data/Participants_model');
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
        $config['base_url'] = base_url().'data/participants';
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
        
	
		$data['count_records']= $this->Participants_model->count_records();
		$data['records'] = $this->Participants_model->get_records( '','', $order_type, $config['per_page'],$limit_end);        
		$config['total_rows'] = $data['count_records'];

            
        //initializate the panination helper 
        $this->pagination->initialize($config);         
        
		
		//load the view
        $data['main_content'] = 'data/participants/list';
        $this->load->view('includes/template', $data);  

    }//index
	
	
	
    public function add()
    {
         $admin_id = ADMIN_ID;
       
	//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
           //form validation
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $photo_name = '';
                 $config['upload_path'] = './participant';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024'; // max file size 1 mb
                $config['max_width']  = '1024';
                $config['max_height']  = '768';

                $this->load->library('upload', $config);


                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error); //debug it here 
                }
                else
                {        
                    $image_info = $this->upload->data();
                    //var_dump($image_info);
                    $photo_name =  $image_info['file_name'];

                }


                $edu_level = $this->input->post('edu_level');
                $edu_sublevel = $this->input->post('sublevel');

                if($edu_sublevel != '-1')
                    $education = $edu_sublevel;
                    else
                    $education = $edu_level;    

                $data_to_store = array(
                                'firstname' => $this->input->post('fname'),
                                'middlename' => $this->input->post('mname'),
                                'lastname' => $this->input->post('lname'),
                                'address1' => $this->input->post('address1'),
                                'address2' => $this->input->post('address2'),
                                'city' => $this->input->post('city'),
                                'state' => $this->input->post('state'),
                                'zip' => $this->input->post('zip'),
                                'country' => $this->input->post('country'), 
                                'phone' => $this->input->post('phone'),
                                'phone_ext' => $this->input->post('phone_ext'),
                                'alternate_phone' => $this->input->post('alt_phone'),
                                'alternate_phone_ext' => $this->input->post('alt_phone_ext'),
                                'email' => $this->input->post('email'),
                                'alternate_email' => $this->input->post('alt_email'),
                                'dob' => $this->input->post('dob'),
                                'age' => $this->input->post('age'),
                                'gender' => $this->input->post('gender'),
                                'ethnicity' => $this->input->post('ethnicity'),
                                'education' => $education,
                                'occupation' => $this->input->post('occupation'),
                                'employer' => $this->input->post('employer'),
                                'transportation' => $this->input->post('transport'),
                                'photo_src' => $photo_name,
                                'do_not_call' => $this->input->post('do_not_call'),
                                'do_not_email' => $this->input->post('do_not_email'),
                                'decreased' => $this->input->post('decreased')

                        );


                    $medicalarray = $this->input->post('medical');
                    $occupationarray = $this->input->post('occupatn');
                    $classificationarray = $this->input->post('classification');

                     $notesalarray = $this->input->post('notes');
                    $statusarray = $this->input->post('status');
                    $studyarray = $this->input->post('study');
                    $dateearray = $this->input->post('datee');

                    $photolog_array = array();

                    for($i = 0; $i<count($notesalarray); $i++)
                    { 

                      if($notesalarray[$i] != '' || $statusarray[$i] != '' || $studyarray[$i] != '' || $dateearray[$i] != '')  
                        $photolog_array[$i] =  $notesalarray[$i].'_'.$statusarray[$i].'_'.$studyarray[$i].'_'. $dateearray[$i];

                    }


                    //if the insert has returned true then we show the flash message
                    $last_insert_id = $this->Participants_model->store_record($data_to_store , $medicalarray ,$occupationarray , $classificationarray , $photolog_array);  


                    if($last_insert_id>0){  

                        $this->session->set_flashdata('success', TRUE);
                        $this->session->set_flashdata('msg', "Record successfully added.");

                        redirect('data/participants/');

                    }else{
                        $this->session->set_flashdata('success', FALSE);
                    }

            }
       }
                
       
            $data['gender_rec'] = $this->Participants_model->get_gender();
            $data['edu_level_rec'] = $this->Participants_model->get_education_level();
            $data['ethnicity_rec'] = $this->Participants_model->get_ethnicity();
            $data['occupation_rec'] = $this->Participants_model->get_occupation();
            
            $data['medical_condition_rec'] = $this->Participants_model->get_medical_condition();
            $data['classification_rec'] = $this->Participants_model->get_classification();
           
            
            $count_record = $this->Participants_model->count_autosave_record_by_userid($admin_id);
 
            if($count_record > 0)
            {
                //autosave secord data 
                $record = $this->Participants_model->get_autosave_record_by_userid($admin_id);
                
                $data['firstname'] = $record[0]['firstname'];
                $data['middlename'] = $record[0]['middlename'];
                $data['lastname'] = $record[0]['lastname'];
                $data['phone'] = $record[0]['phone'];
                $data['phone_ext'] = $record[0]['phone_ext'];
                $data['alternate_phone'] = $record[0]['alternate_phone'];
                $data['alternate_phone_ext'] = $record[0]['alternate_phone_ext'];
                $data['email'] = $record[0]['email'];
                $data['alternate_email'] = $record[0]['alternate_email'];
                $data['address1'] = $record[0]['address1'];
                $data['address2'] = $record[0]['address2'];
                $data['city'] = $record[0]['city'];

                $data['state'] = $record[0]['state'];
                $data['zip'] = $record[0]['zip'];
                $data['transportation'] = $record[0]['transportation'];
                $data['dob'] = $record[0]['dob'];
                $data['age'] = $record[0]['age'];
                $data['gender'] = $record[0]['gender'];

                $data['ethnicity'] = $record[0]['ethnicity'];
               
                $data['occupation'] = $record[0]['occupation'];
                $data['employer'] = $record[0]['employer'];
                
                $data['do_not_call'] = $record[0]['do_not_call'];
                $data['do_not_email'] = $record[0]['do_not_email'];
                $data['decreased'] = $record[0]['decreased'];
                
                
                
                $education_id = -1;
                $education_id = $record[0]['education'];
                $edu = $this->Participants_model->get_edu_parent($education_id);
                $edu_par_id = @$edu[0]['parent_education_level'];
                if($edu_par_id != null)
                {
                     $data['edu_lvl'] = $edu_par_id;
                      $data['edu_sublvl'] = $education_id;
                    
                }else
                {
                    $data['edu_lvl'] = $education_id;
                      $data['edu_sublvl'] = -1;
                }
               
                
                
                $participant_id = $this->Participants_model->get_autosave_participant_id($admin_id);
            
            
                $data['medical_autosave'] = $this->Participants_model->get_autosave_medical($participant_id);
                $data['classification_autosave'] = $this->Participants_model->get_autosave_classification($participant_id);
                $data['occupation_autosave'] = $this->Participants_model->get_autosave_occupation($participant_id);
                
                $data['photolog_autosave'] = $this->Participants_model->get_autosave_photolog($participant_id);
                
                
                //echo '<pre>';
                //print_r($data['photolog_autosave']);
                
                //die('sss');
                
            }else{
                $data['firstname'] = '';
                $data['middlename'] = '';
                $data['lastname'] = '';
                
                $data['phone'] = '';
                $data['phone_ext'] = '';
                $data['alternate_phone'] = '';
                $data['alternate_phone_ext'] = '';
                $data['email'] = '';
                $data['alternate_email'] = '';
                $data['address1'] = '';
                $data['address2'] = '';
                $data['city'] = '';

                $data['state'] = '';
                $data['zip'] = '';
                $data['transportation'] = '';
                $data['dob'] = '';
                $data['age'] = '';
                $data['gender'] = '';

                $data['ethnicity'] = '';
                $data['edu_lvl'] = -1;
                $data['edu_sublvl'] = -1;
                $data['occupation'] = '';
                $data['employer'] = '';
                
                $data['do_not_call'] = '';
                $data['do_not_email'] = '';
                $data['decreased'] = '';
				
				$data['guid'] = uniqid();
                
            }   
            
            
            
            $data['main_content'] = 'data/participants/add';
            $this->load->view('includes/template', $data);   
    }  
    
     public function update()
    {
        //participant id 
        echo $participant_id = $this->uri->segment(4);
       
	//If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
           //form validation
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $photo_name = '';
                 $config['upload_path'] = './participant';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024'; // max file size 1mb
                $config['max_width']  = '1024';
                $config['max_height']  = '768';

                $this->load->library('upload', $config);


                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                   // print_r($error); //debug it here 
                }
                else
                {        
                    $image_info = $this->upload->data();
                    //var_dump($image_info);
                    $pho_name =  $image_info['file_name'];

                }

                if($pho_name != '')
                    $photo_name =  $pho_name;
                else
                    $photo_name =  $this->input->post('photo');
                
                
                
                $edu_level = $this->input->post('edu_level');
                $edu_sublevel = $this->input->post('sublevel');

                if($edu_sublevel != '-1')
                    $education = $edu_sublevel;
                    else
                    $education = $edu_level;    

                $data_to_store = array(
                                'firstname' => $this->input->post('fname'),
                                'middlename' => $this->input->post('mname'),
                                'lastname' => $this->input->post('lname'),
                                'address1' => $this->input->post('address1'),
                                'address2' => $this->input->post('address2'),
                                'city' => $this->input->post('city'),
                                'state' => $this->input->post('state'),
                                'zip' => $this->input->post('zip'),
                                'country' => $this->input->post('country'), 
                                'phone' => $this->input->post('phone'),
                                'phone_ext' => $this->input->post('phone_ext'),
                                'alternate_phone' => $this->input->post('alt_phone'),
                                'alternate_phone_ext' => $this->input->post('alt_phone_ext'),
                                'email' => $this->input->post('email'),
                                'alternate_email' => $this->input->post('alt_email'),
                                'dob' => $this->input->post('dob'),
                                'age' => $this->input->post('age'),
                                'gender' => $this->input->post('gender'),
                                'ethnicity' => $this->input->post('ethnicity'),
                                'education' => $education,
                                'occupation' => $this->input->post('occupation'),
                                'employer' => $this->input->post('employer'),
                                'transportation' => $this->input->post('transport'),
                                'photo_src' => $photo_name,
                                'do_not_call' => $this->input->post('do_not_call'),
                                'do_not_email' => $this->input->post('do_not_email'),
                                'decreased' => $this->input->post('decreased')

                        );


                    $medicalarray = $this->input->post('medical');
                    $occupationarray = $this->input->post('occupatn');
                    $classificationarray = $this->input->post('classification');

                     $notesalarray = $this->input->post('notes');
                    $statusarray = $this->input->post('status');
                    $studyarray = $this->input->post('study');
                    $dateearray = $this->input->post('datee');

                    $photolog_array = array();

                    for($i = 0; $i<count($notesalarray); $i++)
                    { 

                      if($notesalarray[$i] != '' || $statusarray[$i] != '' || $studyarray[$i] != '' || $dateearray[$i] != '')  
                        $photolog_array[$i] =  $notesalarray[$i].'_'.$statusarray[$i].'_'.$studyarray[$i].'_'. $dateearray[$i];

                    }
 
                    
                      if($this->Participants_model->update_record($participant_id , $data_to_store , $medicalarray ,$occupationarray , $classificationarray , $photolog_array) == TRUE){
                    
                        $this->session->set_flashdata('success', TRUE);
                        $this->session->set_flashdata('msg', "Record successfully edited.");
                        redirect('data/participants/');

                        }else{

                           $this->session->set_flashdata('success', FALSE);
                           $this->session->set_flashdata('msg', "ERROR: Record could not be edited.");
                        }
                    
                    

            }
       }
                
       
            $data['gender_rec'] = $this->Participants_model->get_gender();
            $data['edu_level_rec'] = $this->Participants_model->get_education_level();
            $data['ethnicity_rec'] = $this->Participants_model->get_ethnicity();
            $data['occupation_rec'] = $this->Participants_model->get_occupation();
            
            $data['medical_condition_rec'] = $this->Participants_model->get_medical_condition();
            $data['classification_rec'] = $this->Participants_model->get_classification();
           
            
            $count_record = $this->Participants_model->count_record_by_id($participant_id);
 
            if($count_record > 0)
            {
                //autosave secord data 
                $record = $this->Participants_model->get_record_by_id($participant_id);
                
                $data['firstname'] = $record[0]['firstname'];
                $data['middlename'] = $record[0]['middlename'];
                $data['lastname'] = $record[0]['lastname'];
                $data['phone'] = $record[0]['phone'];
                $data['phone_ext'] = $record[0]['phone_ext'];
                $data['alternate_phone'] = $record[0]['alternate_phone'];
                $data['alternate_phone_ext'] = $record[0]['alternate_phone_ext'];
                $data['email'] = $record[0]['email'];
                $data['alternate_email'] = $record[0]['alternate_email'];
                $data['address1'] = $record[0]['address1'];
                $data['address2'] = $record[0]['address2'];
                $data['city'] = $record[0]['city'];

                $data['state'] = $record[0]['state'];
                $data['zip'] = $record[0]['zip'];
                $data['transportation'] = $record[0]['transportation'];
                $data['dob'] = $record[0]['dob'];
                $data['age'] = $record[0]['age'];
                $data['gender'] = $record[0]['gender'];

                $data['ethnicity'] = $record[0]['ethnicity'];
               
                $data['occupation'] = $record[0]['occupation'];
                $data['employer'] = $record[0]['employer'];
                
                $data['do_not_call'] = $record[0]['do_not_call'];
                $data['do_not_email'] = $record[0]['do_not_email'];
                $data['decreased'] = $record[0]['decreased'];
                $data['photo'] = $record[0]['photo_src'];
                
                
                
                $education_id = -1;
                $education_id = $record[0]['education'];
                $edu = $this->Participants_model->get_edu_parent($education_id);
                $edu_par_id = @$edu[0]['parent_education_level'];
                if($edu_par_id != null)
                {
                     $data['edu_lvl'] = $edu_par_id;
                      $data['edu_sublvl'] = $education_id;
                    
                }else
                {
                    $data['edu_lvl'] = $education_id;
                      $data['edu_sublvl'] = -1;
                }
               
                
                
                //$participant_id = $this->Participants_model->get_autosave_participant_id($admin_id);
            
            
                $data['medical_autosave'] = $this->Participants_model->get_participant_medical($participant_id);
                $data['classification_autosave'] = $this->Participants_model->get_participant_classification($participant_id);
                $data['occupation_autosave'] = $this->Participants_model->get_participant_occupation($participant_id);
                
                $data['photolog_autosave'] = $this->Participants_model->get_participant_photolog($participant_id);
                
                
                //echo '<pre>';
                //print_r($data['photolog_autosave']);
                
                //die('sss');
                
            }else{
                $data['firstname'] = '';
                $data['middlename'] = '';
                $data['lastname'] = '';
                
                $data['phone'] = '';
                $data['phone_ext'] = '';
                $data['alternate_phone'] = '';
                $data['alternate_phone_ext'] = '';
                $data['email'] = '';
                $data['alternate_email'] = '';
                $data['address1'] = '';
                $data['address2'] = '';
                $data['city'] = '';

                $data['state'] = '';
                $data['zip'] = '';
                $data['transportation'] = '';
                $data['dob'] = '';
                $data['age'] = '';
                $data['gender'] = '';

                $data['ethnicity'] = '';
                $data['edu_lvl'] = -1;
                $data['edu_sublvl'] = -1;
                $data['occupation'] = '';
                $data['employer'] = '';
                
                $data['do_not_call'] = '';
                $data['do_not_email'] = '';
                $data['decreased'] = '';
                $data['photo'] = '';
                
            }   
            
            
            
            $data['main_content'] = 'data/participants/edit';
            $this->load->view('includes/template', $data);   
    } 
    
    public function loadData()
    {
        
        $levelId=$_POST['eduId'];
      
        $result=$this->Participants_model->get_education_sublevel($levelId);
        $HTML="";

        if($result->num_rows() > 0){
          foreach($result->result() as $list){
            $HTML.="<option value='".$list->id."'>".$list->education_level."</option>";
          }
        } else {
            $HTML = 0;
        }
        
        echo $HTML;
    }
     public function loadDataupdate()
    {
        
        $levelId=$_POST['eduId'];
        $sublevelId=$_POST['edusubId'];
        $result=$this->Participants_model->get_education_sublevel($levelId);
        $HTML="";

        if($result->num_rows() > 0){
          foreach($result->result() as $list){
              if ($list->id == $sublevelId)
                        $sel = 'selected';
                    else
                        $sel = '';

            $HTML.="<option value='".$list->id."' ".$sel.">".$list->education_level."</option>";
          }
        } else {
            $HTML = 0;
        }
        
        echo $HTML;
    }
    
    public function autosave()
    {
         
        $admin_id = ADMIN_ID;
        //If save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $edu_level = $this->input->post('edu_level');
            $edu_sublevel = $this->input->post('sublevel');
            
            
            $photo_name = '';
            //if($this->input->post('partImage')) {
                

                $config['upload_path'] = './participant';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';

                $this->load->library('upload', $config);


                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error); //debug it here 
                }
                else
                {        
                    $image_info = $this->upload->data();
                    //var_dump($image_info);
                    $photo_name =  $image_info['file_name'];

                }
             
           // }
          
            
            if($edu_sublevel != '-1')
                $education = $edu_sublevel;
                else
                $education = $edu_level;    
            
            $data_to_store = array(
                            'user_id' => $admin_id,
                            'firstname' => $this->input->post('fname'),
                            'middlename' => $this->input->post('mname'),
                            'lastname' => $this->input->post('lname'),
                            'address1' => $this->input->post('address1'),
                            'address2' => $this->input->post('address2'),
                            'city' => $this->input->post('city'),
                            'state' => $this->input->post('state'),
                            'zip' => $this->input->post('zip'),
                            'country' => $this->input->post('country'), 
                            'phone' => $this->input->post('phone'),
                            'phone_ext' => $this->input->post('phone_ext'),
                            'alternate_phone' => $this->input->post('alt_phone'),
                            'alternate_phone_ext' => $this->input->post('alt_phone_ext'),
                            'email' => $this->input->post('email'),
                            'alternate_email' => $this->input->post('alt_email'),
                            'dob' => $this->input->post('dob'),
                            'age' => $this->input->post('age'),
                            'gender' => $this->input->post('gender'),
                            'ethnicity' => $this->input->post('ethnicity'),
                            'education' => $education,
                            'occupation' => $this->input->post('occupation'),
                            'employer' => $this->input->post('employer'),
                            'transportation' => $this->input->post('transport'),
                            'photo_src' => $photo_name,
                            'do_not_call' => $this->input->post('do_not_call'),
                            'do_not_email' => $this->input->post('do_not_email'),
                            'decreased' => $this->input->post('decreased')
                    );
            
            
                $medicalarray = $this->input->post('medical');
                $occupationarray = $this->input->post('occupatn');
                $classificationarray = $this->input->post('classification');
                
                
                
                $notesalarray = $this->input->post('notes');
                $statusarray = $this->input->post('status');
                $studyarray = $this->input->post('study');
                $dateearray = $this->input->post('datee');
                
                $photolog_array = array();
                
                for($i = 0; $i<count($notesalarray); $i++)
                { 
                    
                  if($notesalarray[$i] != '' || $statusarray[$i] != '' || $studyarray[$i] != '' || $dateearray[$i] != '')  
                    $photolog_array[$i] =  $notesalarray[$i].'_'.$statusarray[$i].'_'.$studyarray[$i].'_'. $dateearray[$i];
                    
                }
                
         
                //print_r($data_to_store);
		//if the insert has returned true then we show the flash message
                $this->Participants_model->autosave_record($data_to_store , $medicalarray ,$occupationarray , $classificationarray , $photolog_array);  
                
                
               die('Auto Save Transaction done');
       }
	//$data['main_content'] = 'data/participants/add';
        //$this->load->view('includes/template', $data);   
    }       
 
 
     /**
    * Delete ethnicity record
    * @return void
    */
    public function delete()
    {
        		
        //ethnicity id 
        $id = $this->uri->segment(4);
		
		//delete
		if($this->Participants_model->delete_record($id))
		{
                    $this->session->set_flashdata('success', TRUE);
                    $this->session->set_flashdata('msg', "Record successfully deleted.");
		}
		else
		{
                    $this->session->set_flashdata('success', FALSE);
                    $this->session->set_flashdata('msg', "ERROR: Record could not be deleted.");
		}
		

        redirect('data/participants/');
    }

}