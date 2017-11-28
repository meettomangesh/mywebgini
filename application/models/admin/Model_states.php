<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_states extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function states_list(){
        $sql = "SELECT s.id,s.name,s.country_id,c.name as country_name FROM states s LEFT JOIN countries c ON c.id=s.country_id ORDER BY id";
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function get_states($states_id){
        $sql = "SELECT s.id,s.name,s.country_id,c.name as country_name FROM states s LEFT JOIN countries c ON c.id=s.country_id WHERE id=".$states_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function get_countrywise_states($country_id){
        $sql = "SELECT s.id,s.name,s.country_id,c.name as country_name FROM states s LEFT JOIN countries c ON c.id=s.country_id WHERE country_id=".$country_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
}
