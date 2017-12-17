<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller {

    public $footer_skills;
    public function __construct() {
        parent::__construct();

        $this->load->model('Model_search');
        $this->footer_skills = $this->Model_search->getFooterSkills();
        $this->load->vars($this->footer_skills);
        
    }



}

