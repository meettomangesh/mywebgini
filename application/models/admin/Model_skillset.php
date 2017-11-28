<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_skillset extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function skillset_list(){
        $sql = "SELECT * FROM tbl_skillset ORDER BY id";
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function get_skillset($skillset_id){
        $sql = "SELECT * FROM tbl_skillset WHERE id=".$skillset_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function insert_skillset($data){
		$parent_skillset = implode(',',$data['parent_skillset']);
		$sql = "INSERT into tbl_skillset SET skill='".$data['skillset']."', parent_id = '".$parent_skillset."'";
		$result = $this->db->query($sql);
        return $result;
	}
	public function update_skillset($data){
		$parent_skillset = implode(',',$data['parent_skillset']);
		$sql = "UPDATE tbl_skillset SET skill='".$data['skillset']."', parent_id = '".$parent_skillset."'  WHERE id = ".$data['skillset_id']."";		
		$result = $this->db->query($sql);
        return $result;
	}
	public function delete_skillset($data){
		$sql = "DELETE FROM tbl_skillset WHERE id=".$data['skillset_id'];
		$result = $this->db->query($sql);
        return $result;
	}
}
