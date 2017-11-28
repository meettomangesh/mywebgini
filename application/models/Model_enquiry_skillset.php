<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_enquiry_skillset extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    function form_insert($data) {
        return $this->db->insert_batch('enquiry_skillset', $data);   
    }
}

?>