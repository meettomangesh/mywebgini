<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_users extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function user_list(){
        $sql = "SELECT id,is_company_individual,company_name,email,status,registration_date FROM tbl_user ORDER BY id";
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function get_user($user_id){
        $sql = "SELECT u.*,c.name as country_name,s.name as state_name,ci.name as city_name FROM tbl_user as u LEFT JOIN countries as c ON c.id=u.country LEFT JOIN states as s ON s.id=u.state LEFT JOIN cities as ci ON ci.id=u.city WHERE u.id=".$user_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function update_user($data){
		//echo $data['user_id'];
		$sql = "UPDATE tbl_user SET is_company_individual='".$data['is_company_individual']."',company_name='".$data['company_name']."',country='".$data['country_name']."',state='".$data['state_name']."',city='".$data['city_name']."',landmark='".$data['landmark']."',address='".$data['address']."',email='".$data['email']."',phone='".$data['phone']."',years_of_experience='".$data['years_of_experience']."',turn_over='".$data['turn_over']."',website='".$data['website']."',about_company='".$data['about_company']."',no_of_employee='".$data['no_of_employee']."',portfolio='".$data['portfolio']."',roles_of_company='".$data['roles_of_company']."',status='".$data['status']."' WHERE id = ".$data['user_id']."";
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function delete_user($data){
		$sql = "UPDATE tbl_user SET status='deleted' WHERE id=".$data['user_id'];
		$result = $this->db->query($sql);
        return $result;
	}
}
