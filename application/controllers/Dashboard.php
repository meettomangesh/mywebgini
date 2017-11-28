<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_home');
        $this->load->model('Model_users');
        $this->load->model('Model_signup');
        $this->load->model('Model_countries');
        $this->load->model('Model_enquiry');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $user_id = $this->session->userdata('id');
        $is_provider_utilizer = $this->session->userdata('is_provider_utilizer');

        $data['page'] = 'user';
        $users = $this->Model_users->get_user($user_id, $is_provider_utilizer);
        $data['users'] = $users;
        $data['enquiry'] = $data['members'] = $data['portfolios'] = $data['skills'] = array();
        if ($is_provider_utilizer == 'provider') {
            $members = $this->Model_users->get_members($user_id);
            $data['members'] = $members;
            $portfolios = $this->Model_users->get_portfolios($user_id);
            $data['portfolios'] = $portfolios;
        }
        $skills = $this->Model_users->getSkillsRolesByProviderUtilizerId($user_id, $is_provider_utilizer);
        $data['skills'] = $skills;

        $enquiry = $this->Model_users->getEnquiriesByProviderUtilizerId($user_id, $is_provider_utilizer);
        $data['enquiry'] = $enquiry;


        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $skillsets = $this->Model_signup->skillset_list();
        $data['skillsets'] = $skillsets;
        $data['is_provider_utilizer'] = $is_provider_utilizer;
        if ($is_provider_utilizer == 'provider') {
            $this->load->view('vwDashboardProvider', $data);
        } else {
            $this->load->view('vwDashboard', $data);
        }
    }

    public function addEnquiry() {
        $data = array(
            'utilizer_id' => $this->input->post('user_id'),
            'enquiry_title' => $this->input->post('enquiry_title'),
            'enquiry_text' => $this->input->post('description'),
            'skill' => $this->input->post('skill')
        );
//Transfering data to Model
        $result = $this->Model_enquiry->form_insert($data);
        $enquiry = $this->Model_users->getEnquiriesByProviderUtilizerId($this->input->post('user_id'), 'utilizer');
        $responseEnquiry = $this->load->view('ajax/getEnquiriesForUtilizer', array('enquiry' => $enquiry), TRUE);
        if ($result) {
            $response['from'] = 'add-enquiry';
            $response['status'] = 'success';
            $response['enquiry'] = $responseEnquiry;
            $response['message'] = 'Enquiry added successfully.';
        } else {
            $response['from'] = 'add-enquiry';
            $response['status'] = 'error';
            $response['message'] = 'There is problem to add enquiry.';
        }

        $this->output->set_output(json_encode($response));
    }

    public function getEditEnquiryForm() {
        $enquiryId = $this->input->post('enquiryId');
        $userId = $this->input->post('userId');
        $skillsets = $this->Model_signup->skillset_list();
        $data['skillsets'] = $skillsets;
        $data['is_provider_utilizer'] = $is_provider_utilizer;
        $data['user'] = $this->Model_users->getUserDataByProviderUtilizerId($userId, 'utilizer');
        $responseEnquiry = $this->load->view('ajax/getEditEnquiriesFormForUtilizer', $data, TRUE);
        if ($result) {
            $response['from'] = 'edit-enquiry';
            $response['status'] = 'success';
            $response['editEnquiryForm'] = $responseEnquiry;
            $response['message'] = 'Enquiry added successfully.';
        }
    }

}

?>