<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = PROJECT_NAME;
        $this->data['page_description'] = PROJECT_NAME;
    }

    protected function render($the_view = NULL, $template = 'outer')
    {
        if($template == 'json' || $this->input->is_ajax_request())
        {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        else if(is_null($template))
        {
            $this->load->view($the_view,$this->data);
        }
        else
        {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
	/**
	* Function checks if user login or not
	*
	* if user logged in it redirects to dashboard page else it redirects to login page. 
	*/
	public function islogin(){
		if($this->session->has_userdata('user')){			
				return true;
			}else{
				return false;
			}
	}
}