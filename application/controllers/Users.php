<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_users');
        $this->load->model('Model_countries');
        $this->load->model('Model_signup');
        $this->load->helper(array('form', 'url'));
    }

    public function insert_user() {
        //echo "<pre>";print_r($_POST);die;
        $config['upload_path'] = './images/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 500;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (isset($_FILES) && $_FILES['userfile']['name'] != '') {
            $file_name = $_FILES['userfile']['name'];
        } else {
            $file_name = '';
        }
        // Get lat long from google
        $latlong = $this->get_lat_long($_POST['landmark'] . " " . $_POST['address']); // create a function with the name "get_lat_long" given as below
        $map = explode(',', $latlong);
        $mapLat = $map[0];
        $mapLong = $map[1];
        $user = $this->Model_users->insert_user($_POST, $file_name, $mapLat, $mapLong);
        $data['page'] = 'user';
        if ($user == 1) {
            $data['message'] = "Record inserted successfully!!!";
        }
        //$this->load->view('vwRegistrationSuccess',$data);
        redirect('/Users/RegisterSuccess');
    }

    public function register() {
        $user = $this->Model_users->register($_POST);
        $data['page'] = 'user';
        if ($user) {
            $data['message'] = "Record inserted successfully!!!";
        }
        //$this->load->view('vwRegistrationSuccess',$data);
        redirect('/Users/RegisterSuccess');
    }

    public function RegisterSuccess() {
        $this->load->view('vwRegistrationSuccess');
    }

    public function edit_profile() {
        if ($this->session->userdata('id') != '') {
            $user_id = $this->session->userdata('id');
            $data['page'] = 'edit_profile';
            $users = $this->Model_users->get_user($user_id);
            $data['users'] = $users;
            $members = $this->Model_users->get_members($user_id);
            $data['members'] = $members;
            $portfolios = $this->Model_users->get_portfolios($user_id);
            $data['portfolios'] = $portfolios;
            $skills = $this->Model_users->getSkillsByProviderId($user_id);
            $data['skills'] = $skills;
            //echo "<pre>";print_r($users);die;
            $countries = $this->Model_countries->countries_list();
            $data['countries'] = $countries;
            $skillsets = $this->Model_signup->skillset_list();
            $data['skillsets'] = $skillsets;

            $this->load->view('vwEditProfile', $data);
        } else {
            redirect('/home');
        }
    }

    public function update_user() {
        //echo "<pre>";print_r($_POST);die;
        if (isset($_FILES) && isset($_FILES['userfile']) && $_FILES['userfile']['name'] != '') {
            $config['upload_path'] = '' . getcwd() . '/images/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 500;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
        }

        if (isset($_FILES) && isset($_FILES['userfile']) && $_FILES['userfile']['name'] != '') {
            $file_name = $_FILES['userfile']['name'];
        } else {
            $file_name = $_POST['hidden_photo'];
        }
        $user = $this->Model_users->update_user($_POST, $file_name);
        //echo "<pre>";print_r($_POST);die;
        if (isset($_POST['address'][0]) && $_POST['address'][0] != '' && count($_POST['address']) > 0) {
            for ($i = 0; $i < count($_POST['address']); $i++) {
                // Get lat long from google
                $latlong = $this->get_lat_long($_POST['landmark'][$i] . " " . $_POST['address'][$i]); // create a function with the name "get_lat_long" given as below
                $map = explode(',', $latlong);
                //print_r($map);//die;
                $mapLat = $map[0];
                $mapLong = $map[1];
                //echo "==".$_POST['address_id'][$i]."**";die;
                if ($_POST['as_head_office'] == ($i + 1)) {
                    $as_head_office = 'yes';
                } else {
                    $as_head_office = 'no';
                }
                if (isset($_POST['address_id'][$i]) && $_POST['address_id'][$i] != '0' && $_POST['address_id'][$i] != '') {
                    $this->Model_users->update_address($_POST['address_id'][$i], $_POST['address'][$i], $_POST['landmark'][$i], $_POST['city_name'][$i], $_POST['state_name'][$i], $_POST['country_name'][$i], $mapLat, $mapLong, $_POST['extra_emailid'][$i], $_POST['extra_phone'][$i], $as_head_office);
                } else {
                    $this->Model_users->insert_address($_POST['address'][$i], $_POST['landmark'][$i], $_POST['city_name'][$i], $_POST['state_name'][$i], $_POST['country_name'][$i], $mapLat, $mapLong, $_POST['extra_emailid'][$i], $_POST['extra_phone'][$i], $as_head_office);
                }
            }
        }
        //echo "<pre>";print_r($_FILES);die;
        //upload member photo
        $file_name = array();
        if (isset($_FILES) && isset($_FILES['member_image']) && count($_FILES['member_image']) > 0) {
            $config['upload_path'] = '' . getcwd() . '/images/members';
            $config['allowed_types'] = '*';
            $config['max_size'] = 500;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $files = $_FILES['member_image'];
            $this->load->library('upload', $config);
            for ($i = 0; $i < count($_POST['member_id']); $i++) {
                $_FILES['uploadedimage']['name'] = $files['name'][$i];
                $_FILES['uploadedimage']['type'] = $files['type'][$i];
                $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['uploadedimage']['error'] = $files['error'][$i];
                $_FILES['uploadedimage']['size'] = $files['size'][$i];
                if (!$this->upload->do_upload('uploadedimage')) {
                    //echo "NOt Uploaded";die;
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $file_name[$i] = array('upload_data' => $this->upload->data());
                    //echo "Upload";die;
                }
            }
        }

        //echo "<pre>";print_r($_POST);die;

        if (isset($_POST['member_id'][0]) && $_POST['member_id'][0] != '' && count($_POST['member_id']) > 0) {
            for ($i = 0; $i < count($_POST['member_id']); $i++) {
                if (isset($_POST['member_id'][$i]) && ($_POST['member_id'][$i] != '')) {
                    if (isset($file_name[$i])) {
                        $this->Model_users->update_member($_POST['member_id'][$i], $_POST['member_name'][$i], $_POST['member_designation'][$i], $_POST['member_description'][$i], $file_name[$i]['upload_data']['file_name']);
                    } else {
                        $this->Model_users->update_member($_POST['member_id'][$i], $_POST['member_name'][$i], $_POST['member_designation'][$i], $_POST['member_description'][$i], '');
                    }
                } else {
                    if (isset($file_name[$i])) {
                        $this->Model_users->insert_member($_POST['member_name'][$i], $_POST['member_designation'][$i], $_POST['member_description'][$i], $file_name[$i]['upload_data']['file_name']);
                    } else {
                        $this->Model_users->insert_member($_POST['member_name'][$i], $_POST['member_designation'][$i], $_POST['member_description'][$i], '');
                    }
                }
            }
        }
        if (isset($_POST['portfolio_id'][0]) && $_POST['portfolio_id'][0] != '' && count($_POST['portfolio_id']) > 0) {
            for ($i = 0; $i < count($_POST['portfolio_id']); $i++) {
                if (isset($_POST['portfolio_id'][$i]) && $_POST['portfolio_id'][$i] != '') {
                    $this->Model_users->update_portfolio($_POST['portfolio_id'][$i], $_POST['portfolio_url'][$i], $_POST['portfolio_features'][$i], $_POST['portfolio_description'][$i]);
                } else {
                    $this->Model_users->insert_portfolio($_POST['portfolio_url'][$i], $_POST['portfolio_features'][$i], $_POST['portfolio_description'][$i]);
                }
            }
        }
        if (isset($_POST['roles_of_company']) && count($_POST['roles_of_company']) > 0) {
            for ($i = 0; $i < count($_POST['roles_of_company']); $i++) {
                $this->Model_users->update_roles_of_company($_POST['role_id'][$i], $_POST['roles_of_company'][$i], $_POST['rates_to_role_' . $_POST['roles_of_company'][$i]], $_POST['no_of_projects_' . $_POST['roles_of_company'][$i]]);
            }
        }
        $data['page'] = 'user';
        if ($user == 1) {
            $data['message'] = "Record updated successfully!!!";
        }
        $user_id = $this->session->userdata('id');
        $data['page'] = 'edit_profile';
        $users = $this->Model_users->get_user($user_id);
        $data['users'] = $users;
        $members = $this->Model_users->get_members($user_id);
        $data['members'] = $members;
        $portfolios = $this->Model_users->get_portfolios($user_id);
        $data['portfolios'] = $portfolios;
        $skills = $this->Model_users->getSkills($user_id);
        $data['skills'] = $skills;
        $countries = $this->Model_countries->countries_list();
        $data['countries'] = $countries;
        $skillsets = $this->Model_signup->skillset_list();
        $data['skillsets'] = $skillsets;
        $this->load->view('vwDashboard', $data);
    }

    // function to get  the address
    public function get_lat_long($address) {

        $address = str_replace(" ", "+", $address);
        //echo $address;

        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $json = json_decode($json);
        if (isset($json->{'results'}[0]) && $json->{'results'}[0] != "") {
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        } else {
            $lat = "";
            $long = "";
        }
        //echo $lat.','.$long.",";die;
        return $lat . ',' . $long . ",";
    }

    public function delete_roles_of_company() {
        $role_id = $this->input->post('role_id');
        $this->Model_users->delete_roles_of_company($role_id);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */