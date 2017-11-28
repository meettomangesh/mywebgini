<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skillset extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('admin/Model_skillset');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $data['page'] = 'skillset';
		$skillsets = $this->Model_skillset->skillset_list();
        $data['skillsets'] = $skillsets;
        $this->load->view('admin/vwManageSkillset',$data);
    }

    public function add_skillset() {
        $data['page'] = 'skillset';
		$skills = $this->Model_skillset->skillset_list();
		$data['skills'] = $skills;
        $this->load->view('admin/vwAddSkillset',$data);
    }
	public function insert_skillset(){
        $data['page'] = 'skillset';		
		$result = $this->Model_skillset->insert_skillset($_POST);
		if($result==1){
			$data['message']="Record inserted successfully!!!";
		}else{
			$data['message']="Error in record inserted!!!";
		}
		$skillsets = $this->Model_skillset->skillset_list();
        $data['skillsets'] = $skillsets;
        $this->load->view('admin/vwManageSkillset',$data);
	}
    public function edit_skillset() {
        $skillset_id = $this->uri->segment(4);
        $data['page'] = 'skillset';		
		$skillsets = $this->Model_skillset->get_skillset($skillset_id);
		$skills = $this->Model_skillset->skillset_list();
        $data['skillsets'] = $skillsets;
		$data['skills'] = $skills;
        $this->load->view('admin/vwEditSkillset',$data);
    }
	public function view_skillset() {
		$skillset_id = $this->uri->segment(4);
        $data['page'] = 'skillset';		
		$skillsets = $this->Model_skillset->get_skillset($skillset_id);
        $data['skillsets'] = $skillsets;
        $this->load->view('admin/vwViewSkillset',$data);
    }
    
     public function block_skillset() {
        // Code goes here
    }
    
     public function delete_skillset() {
        // Code goes here
		$skillset=$this->Model_skillset->delete_skillset($_POST);
		$data['page'] = 'skillset';
		$skillsets = $this->Model_skillset->skillset_list();
        $data['skillsets'] = $skillsets;
		if($skillset==1){
			echo "1";
		}else{
			echo "Error in deleting record.";
		}
        
    }
	public function update_skillset(){
		//echo "<pre>";print_r($_POST);
		$skillset=$this->Model_skillset->update_skillset($_POST);
		$data['page'] = 'skillset';
		$skillsets = $this->Model_skillset->skillset_list();
        $data['skillsets'] = $skillsets;
		if($skillset==1){
			$data['message'] ="Record updated successfully!!!";
		}
        $this->load->view('admin/vwManageSkillset',$data);
	}
	
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */