<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Model_home extends CI_Model{
		public function __construct() {
			parent::__construct();
		}
		public function get_user($username,$password){
			$sql = "SELECT * FROM tbl_admin_users WHERE username='".$username."' AND password = '".$password."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
	}
?>