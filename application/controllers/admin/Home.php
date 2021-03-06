<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('admin/Model_home');
    }

    public function index() {
         if ($this->session->userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
        $this->load->view('admin/vwLogin');
        }
    }

     public function do_login() {

        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/home/dashboard');
        } else {
            $user = isset($_POST['username'])?$_POST['username']:'';
            $password = isset($_POST['password'])?$_POST['password']:'';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
				$err['error'] = 'Enter Username and Password';
                $this->load->view('admin/vwLogin',$err);
            } else {
                $salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
                $enc_pass  = md5($salt.$password);
                $val = $this->Model_home->get_user($user,$enc_pass);
				//echo "<pre>";print_r($val);
                if (!empty($val)){
                    foreach ($val as $recs => $res) {
                        $this->session->set_userdata(array(
                            'id' => $res->id,
                            'username' => $res->username,
                            'email' => $res->email,                            
                            'is_admin_login' => true,
                            'user_type' => $res->user_type
                                )
                        );
                    }
                    redirect('admin/dashboard');
                } else {
					$err['error'] = 'Username or Password incorrect';
                    $this->load->view('admin/vwLogin', $err);
                }
            }
        }
           }

        
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('is_admin_login');   
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin/home', 'refresh');
    }

    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */