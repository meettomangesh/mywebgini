<?php 
if(!defined('BASEPATH')) exit("No direct access");
class Welcome extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->view('admin/welcome_message');
	}
}
?>