<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class States extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_states');
        $this->load->model('Model_countries');
    }

    public function index() {
        $data['page'] = 'states';
        $states = $this->Model_states->states_list();
        $data['states'] = $states;
        $this->load->view('vwManageStates', $data);
    }

    public function add_states() {
        $data['page'] = 'states';
        $this->load->view('vwAddStates', $data);
    }

    public function edit_states() {
        $data['page'] = 'states';
        $this->load->view('vwEditStates', $data);
    }

    public function view_States() {
        $states_id = $this->uri->segment(4);
        $data['page'] = 'states';
        $states = $this->Model_states->get_states($states_id);
        $data['states'] = $states;
        $this->load->view('vwViewStates', $data);
    }

    public function block_states() {
        // Code goes here
    }

    public function delete_states() {
        // Code goes here
    }

    public function get_countrywise_states() {
        $state_data = "";
        $country_id = $this->input->post('country_id');
        $div_id = $this->input->post('div_id');
        $states = $this->Model_states->get_countrywise_states($country_id);
        $state_data = '<select name="state_name[]" id="state_name_' . $div_id . '" class="form-control" onchange="get_cities(this.id,this.value);">';
        $state_data .= '<option value="">Select State</option>';
        foreach ($states as $state) {
            $state_data .= '<option value="' . $state->id . '" >' . $state->name . '</option>';
        }
        $state_data .= '</select>';
        print_r($state_data);
    }

    public function get_states() {
        $country_name = $this->input->post('country_name');
        $countryName = $this->Model_countries->getCountryByName($country_name);
        $country_id = $countryName->id;
        $states = $this->Model_states->get_countrywise_states($country_id);
        $state_data = '';
        //$state_data = '<select name="state_name" id="state" class="form-control" onchange="get_cities(this.id,this.value);">';
        $state_data = '<option value="">Select State</option>';
        foreach ($states as $state) {
            $state_data .= '<option value="' . $state->id . '" >' . $state->name . '</option>';
        }
        //$state_data.='</select>';
        print_r($state_data);
    }

    public function get_country_states() {
        $country_id = $this->input->post('country_id');
        $states = $this->Model_states->get_countrywise_states($country_id);

        print_r(json_encode($states));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */