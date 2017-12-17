<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_cities extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function cities_list(){
        $sql = "SELECT ci.id,ci.name,s.name as state_name,s.country_id,c.name as country_name FROM cities ci LEFT JOIN states s ON ci.state_id=s.id LEFT JOIN countries c ON c.id=s.country_id ORDER BY id Limit 5000";
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function get_cities($cities_id){
        $sql = "SELECT * FROM cities WHERE id=".$cities_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function get_statewise_cities($state_id){
        $sql = "SELECT ci.id,ci.name,ci.state_id,s.name as state_name FROM cities ci LEFT JOIN states s ON s.id=ci.state_id WHERE state_id=".$state_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
    
    	public function get_statewise_cities_state_name($state_name){
        $sql = "SELECT ci.id,ci.name,ci.state_id,s.name as state_name FROM cities ci LEFT JOIN states s ON s.id=ci.state_id WHERE s.name='".$state_name."'";
        $result = $this->db->query($sql);
        return $result->result();
    }
}
