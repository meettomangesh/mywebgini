<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Model_change_password extends CI_Model{
		public function __construct() {
			parent::__construct();
		}
		public function update_password($data){
			$password = $data['new_password'];
			$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
            $enc_pass  = md5($salt.$password);
                
			$sql = "UPDATE tbl_admin_users SET password='".$enc_pass."' WHERE id=".$this->session->userdata('id')."";
			$result = $this->db->query($sql);
			return $result;
		}
	}
?>