<?php
class Audit extends MY_Controller {

    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->library(array('session'));
		if($this->islogin() == false){
			redirect(site_url());
		}
        $this->load->model('system/Audit_model');
    }

    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //pagination settings
        $config['per_page'] = 200;
        $config['base_url'] = base_url().'system/audit';
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

         $data['count_records']= $this->audit_model->count_audits();
         $data['records'] = $this->audit_model->get_audit( '','', $order_type, $config['per_page'],$limit_end);
         $config['total_rows'] = $data['count_records'];

        //initializate the panination helper
        $this->pagination->initialize($config);

		print_r($data['records']);
        //load the view
        $data['main_content'] = 'system/audit/list';
        $this->load->view('admin/includes/template', $data);

    }//index
    /**
  	* Function for display audit logs
  	*
  	* @param null
  	*
  	* @return null.
  	*/
  	public function audit_logs()
	{
		//Data
  		$data['res'] = $this->Audit_model->audit_logs();  // get audit logs data.
		
        //load the view
        $data['main_content'] = 'system/audit/list';
		$data['page_title'] = PROJECT_NAME.'::Audit Logs';
        $this->load->view('admin/includes/template', $data);   
  	}
  	/**
  	* Function for get audit records from ajax
  	*
  	* @param null
  	*
  	* @return response data.
  	*/
  	public function ajax_audit_logs(){
  		$start							= 	$this->input->post('start');
  		$length							= 	$this->input->post('length');
  		$search							= 	$this->input->post('search[value]');
  		$order							=	  $this->input->post('order');
  		$column_id						=	  $order[0]['column'];
  		$column_order					=	  $order[0]['dir'];
  		$data['total_data'] 			= 	$this->Audit_model->count_audit_records();
  		if($search != null){
  			$data['table_data'] = $this->Audit_model->get_audit_ajax($search,$length,$start,$column_id,$column_order);
  		}else{
  			$data['table_data'] = $this->Audit_model->get_audit_ajax($search="",$length,$start,$column_id,$column_order);
  		}
  		$this->load->view('system/audit/ajax_list',$data);
  	}
	
	
	/**
	* Function to clear out audit logs
	*
	* @param null
	*
	* @return response data. 
	*/
	function clear()
	{
		$attempt = $this->Audit_model->clear_log();
		if($attempt == 1)
		{
			$this->session->set_flashdata('audit_log_msg','Log successfully cleared.');
			redirect('audit-logs');
		}
		else
		{
			$this->session->set_flashdata('audit_log_msg',"Error encountered while trying to clear log: $attempt");
		}	
			
	}
	
	
}
