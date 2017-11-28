<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_change_password');
		if (!$this->session->userdata('is_login')) {
            redirect('home');
        }		
	}
	public function index(){
		$data = array();
		$this->load->view("vwViewChangePassword");		
	}
	public function update_password(){
		$data = array();
		$this->Model_change_password->update_password($_POST);
		$data['error_message'] = "Password updated successfully!!!";
		$this->load->view("vwViewChangePassword",$data);		
	}
}
?>