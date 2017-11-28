<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('Model_countries');
		$this->load->model('Model_signup');
    }

    public function index() {
        $arr['page'] ='signup';
		$countries = $this->Model_countries->countries_list();
		$arr['countries'] = $countries;    
		$skillsets = $this->Model_signup->skillset_list();
		$arr['skillsets'] = $skillsets;
        $this->load->view('vwSignup',$arr);
    }
	public function signup() {
        $arr['page'] ='signup';
		$countries = $this->Model_countries->countries_list();
		$arr['countries'] = $countries;    
		$skillsets = $this->Model_signup->skillset_list();
		$arr['skillsets'] = $skillsets;
        $this->load->view('old_vwSignup',$arr);
    }
	public function check_email(){
		$emailid = $this->input->post('emailid');
                $is_provider_utilizer = $this->input->post('emailid');
		$result = $this->Model_signup->check_email($emailid,$is_provider_utilizer);
		if(!empty($result)){
			echo "Email id already used!!!!!";
		}
	}
	public function check_parent_skillset(){
		$ids = $this->input->post('id');
		$result = $this->Model_signup->check_parent_skillset($ids);
		print_r($result[0]->parent_id);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */