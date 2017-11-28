<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('admin/Model_users');
		$this->load->model('admin/Model_countries');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $data['page'] = 'user';
		$users = $this->Model_users->user_list();
        $data['users'] = $users;
        $this->load->view('admin/vwManageUser',$data);
    }

    public function add_user() {
        $data['page'] = 'user';
        $this->load->view('admin/vwAddUser',$data);
    }

    public function edit_user() {
        $user_id = $this->uri->segment(4);
        $data['page'] = 'user';		
		$users = $this->Model_users->get_user($user_id);
		$countries = $this->Model_countries->countries_list();
        $data['users'] = $users;
		$data['countries'] = $countries;
        $this->load->view('admin/vwEditUser',$data);
    }
	public function view_user() {
		$user_id = $this->uri->segment(4);
        $data['page'] = 'user';		
		$users = $this->Model_users->get_user($user_id);
        $data['users'] = $users;
        $this->load->view('admin/vwViewUser',$data);
    }
    
     public function block_user() {
        // Code goes here
    }
    
     public function delete_user() {
        // Code goes here
		$user=$this->Model_users->delete_user($_POST);
		$data['page'] = 'user';
		$users = $this->Model_users->user_list();
        $data['users'] = $users;
		if($user==1){
			echo "1";
		}else{
			echo "Error in deleting record.";
		}
        
    }
	public function update_user(){
		//echo "<pre>";print_r($_POST);
		$user=$this->Model_users->update_user($_POST);
		$data['page'] = 'user';
		$users = $this->Model_users->user_list();
        $data['users'] = $users;
		if($user==1){
			$data['message'] ="Record updated successfully!!!";
		}
        $this->load->view('admin/vwManageUser',$data);
	}
	
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */