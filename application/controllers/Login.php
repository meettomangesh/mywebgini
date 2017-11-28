<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_home');
        $this->load->model('Model_users');
    }

    public function index() {
        if ($this->session->userdata('is_login')) {
            redirect('dashboard');
        } else {
            $this->load->view('vwLogin');
        }
    }

    public function do_login() {
        $data = array();
        if ($this->session->userdata('is_login')) {
            redirect('dashboard');
        } else {
            $user = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $is_provider_utilizer = isset($_POST['is_provider_utilizer']) ? $_POST['is_provider_utilizer'] : '';
            
            /*$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
            $enc_pass = md5($salt . $password);*/
            $val = $this->Model_users->authenticateUser($user, $this->Model_users->generatePassword($password),$is_provider_utilizer);
            //print_r($val);die;
            if (!empty($val)) {
                foreach ($val as $recs => $res) {
                    $this->session->set_userdata(array(
                        'id' => $res->id,
                        'is_login' => true,
                        'email' => $res->email,
                        'company_name' => $res->company_name,
                        'is_provider_utilizer' => $is_provider_utilizer
                            )
                    );
                }
                redirect('dashboard');
            } else {
                $data['error'] = 'Username or Password incorrect';
                $this->load->view('vwLogin', $data);
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('company_name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_login');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }

}

?>