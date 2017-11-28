<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_users extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
	public function insert_user($data,$file_name,$mapLat,$mapLong){
		//echo "<pre>";print_r($data);die;
		$password = $data['password'];
		$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		$enc_pass  = md5($salt.$password);
		$roles_of_company = implode(',',$data['roles_of_company']);
		$portfolio_description = implode("*#",$data['portfolio_description']);
		$portfolio_url = implode("*#",$data['portfolio_url']);
		
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$referral_code = '';
		$max = strlen($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
		  $referral_code .= $characters[mt_rand(0, $max)];
		}
		
		$sql = "INSERT tbl_user SET is_company_individual='".$data['is_company_individual']."',company_name='".$data['company_name']."',country='".$data['country_name']."',state='".$data['state_name']."',city='".$data['city_name']."',landmark='".$data['landmark']."',address='".$data['address']."',email='".$data['email']."',phone='".$data['phone']."',years_of_experience='".$data['years_of_experience']."',turn_over='".$data['turn_over']."',website='".$data['website']."',about_company='".$data['about_company']."',no_of_employee='".$data['no_of_employee']."',portfolio_description='".$portfolio_description."',portfolio_url='".$portfolio_url."',roles_of_company='".$roles_of_company."',photo = '".$file_name."', status='active',password='".$enc_pass."',latitude='".$mapLat."', longitude='".$mapLong."',  referral_code = '".$referral_code."', registration_date=now()";
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function register($data){
		//echo "<pre>";print_r($data);die;
		$password = $data['password'];
		$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		$enc_pass  = md5($salt.$password);
		$roles_of_company = implode(',',$data['roles_of_company']);
		
		
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$referral_code = '';
		$max = strlen($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
		  $referral_code .= $characters[mt_rand(0, $max)];
		}
		/****Insert Basic info into uses table*****/
		$sql = "INSERT tbl_user SET is_provider_utilizer='".$data['is_provider_utilizer']."',is_company_individual='".$data['is_company_individual']."',company_name='".$data['company_name']."',email='".$data['email']."',phone='".$data['phone']."', status='active',password='".$enc_pass."', referral_code = '".$referral_code."', registration_date=now()";
		
		$result = $this->db->query($sql);
		$insert_id = $this->db->insert_id();
		/***Insert Address details in address table******/
		$sql = "INSERT tbl_extra_address SET user_id='".$insert_id."',country='".$data['country_name']."',state='".$data['state_name']."',city='".$data['city_name']."'";
		
		$result = $this->db->query($sql);
		
		/****Insert Roles details in roles table****/
		foreach($data['roles_of_company'] as $role){
			$sql = "INSERT tbl_extra_roles SET user_id='".$insert_id."',roles_of_company='".$role."'";
		
			$result = $this->db->query($sql);
		}
						
		
        return $result;
	}
	public function get_user($user_id){
        //$sql = "SELECT u.*,c.name as country_name,s.name as state_name,ci.name as city_name,a.*,r.* FROM tbl_user as u LEFT JOIN tbl_extra_address as a ON a.user_id=u.id LEFT JOIN tbl_extra_roles as r ON r.user_id=u.id LEFT JOIN countries as c ON c.id=a.country LEFT JOIN states as s ON s.id=a.state LEFT JOIN cities as ci ON ci.id=a.city WHERE u.id=".$user_id;
		$sql="SELECT u.*, group_concat(a.landmark,a.address) as address, group_concat(r.roles_of_company,r.rates_to_role,r.no_of_projects) as roles 
FROM tbl_user as u 
LEFT JOIN tbl_extra_address as a ON a.user_id=u.id 
LEFT JOIN tbl_extra_roles as r ON r.user_id=u.id 
LEFT JOIN countries as c ON c.id=a.country 
LEFT JOIN states as s ON s.id=a.state 
LEFT JOIN cities as ci ON ci.id=a.city 
WHERE u.id=".$user_id."
group by u.id";
        $result = $this->db->query($sql);
        return $result->result();
    }
	public function update_user($data,$file_name,$mapLat,$mapLong){
		//echo $data['user_id'];
		$roles_of_company = implode(',',$data['roles_of_company']);
		$portfolio_description = implode("*#",$data['portfolio_description']);
		$portfolio_url = implode("*#",$data['portfolio_url']);
		
		
		$sql = "UPDATE tbl_user SET is_company_individual='".$data['is_company_individual']."',company_name='".$data['company_name']."',country='".$data['country_name']."',state='".$data['state_name']."',city='".$data['city_name']."',landmark='".$data['landmark']."',address='".$data['address']."',phone='".$data['phone']."',years_of_experience='".$data['years_of_experience']."',turn_over='".$data['turn_over']."',website='".$data['website']."',about_company='".$data['about_company']."',no_of_employee='".$data['no_of_employee']."',portfolio_url='".$portfolio_url."',portfolio_description='".$portfolio_description."',roles_of_company='".$roles_of_company."',latitude='".$mapLat."', longitude='".$mapLong."',photo='".$file_name."' WHERE id = ".$data['user_id']."";
		
		$result = $this->db->query($sql);
        return $result;
	}
	
}
