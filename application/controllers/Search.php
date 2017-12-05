<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_search');
        $this->load->model('Model_countries');
        $this->load->helper("url");
        $this->load->library("pagination");
    }

    public function simple_search() {
        $config = array();
        $config["base_url"] = base_url() . "search/simple_search";
        $config["total_rows"] = $this->Model_search->simple_search_count($_POST);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $data = array();
        $result = $this->Model_search->simple_search($_POST, 5, $this->uri->segment(3));
        $data["links"] = $this->pagination->create_links();
        //print_r($data['links']);die;
        $data['profiles'] = $result['data'];
        $data['page'] = "search";
        $data['total_count'] = $this->Model_search->total_count('');
        $data['company_count'] = $this->Model_search->total_count('company');
        $data['individual_count'] = $this->Model_search->total_count('individual');
        $data['other_skills_count'] = $this->Model_search->total_count('other_skills');
        $data['skills'] = $this->Model_search->getSkillsArray();
        $k = 0;
        foreach ($data['skills'] as $skill) {
            $data['refine_skills'][$k]["count"] = $this->Model_search->roles_count($skill->id);
            $data['refine_skills'][$k]["skill"] = $skill->skill;
            $data['refine_skills'][$k]["id"] = $skill->id;
            $k++;
        }
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('vwSearchResult', $data);
    }

    public function advance_search() {
        $data = array();
        $result = $this->Model_search->advance_search($_POST);
        $data['profiles'] = $result;
        $data['page'] = "search";
        $data['total_count'] = $this->Model_search->total_count('');
        $data['company_count'] = $this->Model_search->total_count('company');
        $data['individual_count'] = $this->Model_search->total_count('individual');
        $data['other_skills_count'] = $this->Model_search->total_count('other_skills');
        $data['skills'] = $this->Model_search->getSkillsArray();
        $k = 0;
        foreach ($data['skills'] as $skill) {
            $data['refine_skills'][$k]["count"] = $this->Model_search->roles_count($skill->id);
            $data['refine_skills'][$k]["skill"] = $skill->skill;
            $data['refine_skills'][$k]["id"] = $skill->id;
            $k++;
        }
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('vwSearchResult', $data);
    }

    public function search_by_keyword() {
        $keyword = $this->input->get('term');
        $result = $this->Model_search->search_by_keyword($keyword);
        print_r($result);
    }

    public function getSkills() {
        $result = $this->Model_search->getSkills();
        print_r($result);
    }

    public function country_name() {
        $result = $this->Model_search->country_name();
        print_r($result);
    }

    public function company_wise_search() {
        $who = $this->uri->segment('3');
        $result = $this->Model_search->getResult($who);
        $data['profiles'] = $result;
        $data['page'] = "search";
        $data['total_count'] = $this->Model_search->total_count('');
        $data['company_count'] = $this->Model_search->total_count('company');
        $data['individual_count'] = $this->Model_search->total_count('individual');
        $data['other_skills_count'] = $this->Model_search->total_count('other_skills');
        $data['skills'] = $this->Model_search->getSkillsArray();
        $k = 0;
        foreach ($data['skills'] as $skill) {
            $data['refine_skills'][$k]["count"] = $this->Model_search->roles_count($skill->id);
            $data['refine_skills'][$k]["skill"] = $skill->skill;
            $data['refine_skills'][$k]["id"] = $skill->id;
            $k++;
        }
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('vwSearchResult', $data);
    }

    public function individual_wise_search() {
        $who = $this->uri->segment('3');
        $result = $this->Model_search->getResult($who);
        $data['profiles'] = $result;
        $data['page'] = "search";
        $data['total_count'] = $this->Model_search->total_count('');
        $data['company_count'] = $this->Model_search->total_count('company');
        $data['individual_count'] = $this->Model_search->total_count('individual');
        $data['other_skills_count'] = $this->Model_search->total_count('other_skills');
        $data['skills'] = $this->Model_search->getSkillsArray();
        $k = 0;
        foreach ($data['skills'] as $skill) {
            $data['refine_skills'][$k]["count"] = $this->Model_search->roles_count($skill->id);
            $data['refine_skills'][$k]["skill"] = $skill->skill;
            $data['refine_skills'][$k]["id"] = $skill->id;
            $k++;
        }
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('vwSearchResult', $data);
    }

    public function role_wise_search() {
        $role = $this->uri->segment('3');
        $role = base64_decode($role);
        $result = $this->Model_search->getRoleResult($role);
        $data['profiles'] = $result;
        $data['page'] = "search";
        $data['total_count'] = $this->Model_search->total_count('');
        $data['company_count'] = $this->Model_search->total_count('company');
        $data['individual_count'] = $this->Model_search->total_count('individual');
        $data['other_skills_count'] = $this->Model_search->total_count('other_skills');
        $data['skills'] = $this->Model_search->getSkillsArray();
        $k = 0;
        foreach ($data['skills'] as $skill) {
            $data['refine_skills'][$k]["count"] = $this->Model_search->roles_count($skill->id);
            $data['refine_skills'][$k]["skill"] = $skill->skill;
            $data['refine_skills'][$k]["id"] = $skill->id;
            $k++;
        }
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('vwSearchResult', $data);
    }

    public function other_skills() {
        $result = $this->Model_search->other_skills();
        $data['profiles'] = $result;
        $data['page'] = "search";
        $data['total_count'] = $this->Model_search->total_count('');
        $data['company_count'] = $this->Model_search->total_count('company');
        $data['individual_count'] = $this->Model_search->total_count('individual');
        $data['other_skills_count'] = $this->Model_search->total_count('other_skills');
        $data['skills'] = $this->Model_search->getSkillsArray();
        $k = 0;
        foreach ($data['skills'] as $skill) {
            $data['refine_skills'][$k]["count"] = $this->Model_search->roles_count($skill->id);
            $data['refine_skills'][$k]["skill"] = $skill->skill;
            $data['refine_skills'][$k]["id"] = $skill->id;
            $k++;
        }
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $this->load->view('vwSearchResult', $data);
    }

    public function getMapElements() {
        /* $country_id = $this->input->post('country_id');
          $state_id = $this->input->post('state_id');
          $city_id = $this->input->post('city_id');
         */
        $result = $this->Model_search->getMapElements($_POST);
        //print_r($result);die;
        header("Content-type: text/xml");
        // Start XML file, echo parent node
        echo '<markers>';

        // Iterate through the rows, printing XML nodes for each
        foreach ($result as $row) {
            //Add to XML document node
            echo '<marker ';
            echo 'id="' . $row->user_id . '" ';
            echo 'name="' . $row->company_name . '" ';
            echo 'address="' . $row->address . ', ' . $row->landmark . '" ';
            echo 'lat="' . $row->latitude . '" ';
            echo 'lng="' . $row->longitude . '" ';
            echo 'country_name="' . $row->country_name . '" ';
            echo 'state_name="' . $row->state_name . '" ';
            echo 'city_name="' . $row->city_name . '" ';
            echo '/>';
        }

        // End XML file
        echo '</markers>';
    }

    /* public function hire_expert(){

      } */
}

?>
