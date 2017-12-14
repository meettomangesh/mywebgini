<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_countries extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function countries_list() {
        $sql = "SELECT * FROM countries ORDER BY id";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function get_countries($countries_id) {
        $sql = "SELECT * FROM countries WHERE id=" . $countries_id;
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getCountryByName($country_name) {
        $this->db->select('c.*');
        $this->db->from('countries c');
        $this->db->where('name', $country_name);

        $result = $this->db->get();
        //echo $this->db->last_query();

        return $result->row();
    }

}
