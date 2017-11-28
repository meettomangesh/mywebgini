<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Countries extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('admin/Model_countries');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $data['page'] = 'countries';
		$countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('admin/vwManageCountries',$data);
    }

    public function add_countries() {
        $data['page'] = 'countries';
        $this->load->view('admin/vwAddCountries',$data);
    }

    public function edit_countries() {
        $data['page'] = 'countries';
        $this->load->view('admin/vwEditCountries',$data);
    }
	public function view_Countries() {
		$countries_id = $this->uri->segment(4);
        $data['page'] = 'countries';		
		$countries = $this->Model_countries->get_countries($countries_id);
        $data['countries'] = $countries;
        $this->load->view('admin/vwViewCountries',$data);
    }
    
     public function block_countries() {
        // Code goes here
    }
    
     public function delete_countries() {
        // Code goes here
    }
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */