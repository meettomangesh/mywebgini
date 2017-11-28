<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_users extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
	public function insert_user($data){
		//echo $data['user_id'];
		$password = $data['password'];
		$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		$enc_pass  = md5($salt.$password);
		$roles_of_company = implode(',',$data['roles_of_company']);
		
		$sql = "INSERT tbl_user SET is_company_individual='".$data['is_company_individual']."',company_name='".$data['company_name']."',country='".$data['country_name']."',state='".$data['state_name']."',city='".$data['city_name']."',landmark='".$data['landmark']."',address='".$data['address']."',email='".$data['email']."',phone='".$data['phone']."',years_of_experience='".$data['years_of_experience']."',turn_over='".$data['turn_over']."',website='".$data['website']."',about_company='".$data['about_company']."',no_of_employee='".$data['no_of_employee']."',portfolio='".$data['portfolio']."',roles_of_company='".$roles_of_company."',status='active',password='".$enc_pass."',registration_date=now()";
		
		$result = $this->db->query($sql);
        return $result;
	}
}
