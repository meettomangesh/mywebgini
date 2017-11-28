<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/Model_change_password');
				
	}
	public function index(){
		$data = array();
		$this->load->view("admin/vwViewChangePassword");		
	}
	public function update_password(){
		//echo "<pre>";print_r($_POST);
		$data = array();
		$this->Model_change_password->update_password($_POST);
		$data['error_message'] = "Password updated successfully!!!";
		$this->load->view("admin/vwViewChangePassword",$data);		
	}
}
?>