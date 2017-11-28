<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Model_signup extends CI_Model{
		public function __construct() {
			parent::__construct();
		}
		public function check_email($emailId,$isProviderUtilizer){
			$sql = "SELECT id FROM providers where email ='".$emailId."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function skillset_list(){
			$sql = "SELECT * FROM skillset ORDER BY id";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function check_parent_skillset($ids){
			$sql = "SELECT parent_id FROM tbl_skillset WHERE id IN(".$ids.") ORDER BY id";
			$result = $this->db->query($sql);
			return $result->result();
		} 
	}
?>