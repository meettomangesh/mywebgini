<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class States extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('admin/Model_states');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $data['page'] = 'states';
		$states = $this->Model_states->states_list();
        $data['states'] = $states;
        $this->load->view('admin/vwManageStates',$data);
    }

    public function add_states() {
        $data['page'] = 'states';
        $this->load->view('admin/vwAddStates',$data);
    }

    public function edit_states() {
        $data['page'] = 'states';
        $this->load->view('admin/vwEditStates',$data);
    }
	public function view_States() {
		$states_id = $this->uri->segment(4);
        $data['page'] = 'states';		
		$states = $this->Model_states->get_states($states_id);
        $data['states'] = $states;
        $this->load->view('admin/vwViewStates',$data);
    }
    
     public function block_states() {
        // Code goes here
    }
    
    public function delete_states() {
        // Code goes here
    }
    public function get_countrywise_states() {
		$country_id = $this->input->post('country_id');
        $states = $this->Model_states->get_countrywise_states($country_id);
		$state_data = '<select name="state_name" id="state_name" class="form-control" onchange="get_cities(this.value);">';
		$state_data .='<option value="">Select State</option>';
		foreach($states as $state){
			$state_data .='<option value="'.$state->id.'" >'.$state->name.'</option>';
		}
		$state_data.='</select>';
		print_r($state_data);
    }
	
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */