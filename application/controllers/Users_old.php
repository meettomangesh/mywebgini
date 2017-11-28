<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('Model_users');
		$this->load->model('Model_countries');
    }

	public function insert_user(){
		//echo "<pre>";print_r($_POST);die;
		$user=$this->Model_users->insert_user($_POST);
		$data['page'] = 'user';
		if($user==1){
			$data['message'] ="Record inserted successfully!!!";
		}
        $this->load->view('vwSignup',$data);
	}
	
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */