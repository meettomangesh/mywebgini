<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cities extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_cities');
    }

    public function index() {
        $data['page'] = 'cities';
        $cities = $this->Model_cities->cities_list();
        $data['cities'] = $cities;
        $this->load->view('vwManageCities', $data);
    }

    public function add_cities() {
        $data['page'] = 'cities';
        $this->load->view('vwAddCities', $data);
    }

    public function edit_cities() {
        $data['page'] = 'cities';
        $this->load->view('vwEditCities', $data);
    }

    public function view_Cities() {
        $cities_id = $this->uri->segment(4);
        $data['page'] = 'cities';
        $cities = $this->Model_cities->get_cities($cities_id);
        $data['cities'] = $cities;
        $this->load->view('vwViewCities', $data);
    }

    public function block_cities() {
        // Code goes here
    }

    public function delete_cities() {
        // Code goes here
    }

    public function get_statewise_cities() {
        $state_id = $this->input->post('state_id');
        $div_id = $this->input->post('div_id');
        $cities = $this->Model_cities->get_statewise_cities($state_id);
        $city_data = '<select name="city_name[]" id="city_name_' . $div_id . '" class="form-control">';
        $city_data .= '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $city_data .= '<option value="' . $city->id . '" >' . $city->name . '</option>';
        }
        $city_data .= '</select>';
        print_r($city_data);
    }

    public function get_cities() {
        $state_id = $this->input->post('state_id');
        $cities = $this->Model_cities->get_statewise_cities($state_id);
        $city_data = '';
        $city_data .= '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $city_data .= '<option value="' . $city->id . '" >' . $city->name . '</option>';
        }
        print_r($city_data);
    }

    public function get_cities_by_name() {
        $state_name = $this->input->post('state_name');
        $cities = $this->Model_cities->get_statewise_cities_state_name($state_name);
        $city_data = '';
        $city_data .= '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $city_data .= '<option value="' . $city->name . '" >' . $city->name . '</option>';
        }
        print_r($city_data);
    }

    public function get_state_cities() {
        $state_id = $this->input->post('state_id');
        $cities = $this->Model_cities->get_statewise_cities($state_id);
        print_r(json_encode($cities));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */