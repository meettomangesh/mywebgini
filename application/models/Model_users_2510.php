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
		if($data['is_provider_utilizer']=='utilizer'){
			$password = $data['password'];
			$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
			$enc_pass  = md5($salt.$password);
			$roles_of_company = implode(',',$data['roles_of_company']);
			
			$sql = "INSERT tbl_utilizer SET utilizer_name='".$data['utilizer_name']."',emailid='".$data['email']."',phone='".$data['phone']."', status='active',password='".$enc_pass."',looking_for='".$roles_of_company."',country='".$data['country_name']."',state='".$data['state_name']."',city='".$data['city_name']."', registration_date=now(),login_date=now()";
			
			$result = $this->db->query($sql);
			
			
		}else{
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
			$sql = "INSERT tbl_user SET is_company_individual='".$data['is_company_individual']."',company_name='".$data['company_name']."',email='".$data['email']."',phone='".$data['phone']."', status='active',password='".$enc_pass."', referral_code = '".$referral_code."', registration_date=now()";
			
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
						
		}
        return $result;
	}
	public function get_user($user_id){
		$data =array();
        //$sql = "SELECT u.*,c.name as country_name,s.name as state_name,ci.name as city_name,a.*,r.* FROM tbl_user as u LEFT JOIN tbl_extra_address as a ON a.user_id=u.id LEFT JOIN tbl_extra_roles as r ON r.user_id=u.id LEFT JOIN countries as c ON c.id=a.country LEFT JOIN states as s ON s.id=a.state LEFT JOIN cities as ci ON ci.id=a.city WHERE u.id=".$user_id;
		$sql="SELECT u.*, 
		group_concat(a.extra_emailid SEPARATOR '|') as extra_emailid, group_concat(a.extra_phone SEPARATOR '|') as extra_phone, group_concat(a.landmark SEPARATOR '|') as landmark, 
		group_concat(a.address SEPARATOR '|') as address,  
		group_concat(c.name SEPARATOR '|') as country,  
		group_concat(s.name SEPARATOR '|') as state,  
		group_concat(ci.name SEPARATOR '|') as city,  
		group_concat(a.country SEPARATOR '|') as country_ids,  
		group_concat(a.state SEPARATOR '|') as state_ids,  
		group_concat(a.city SEPARATOR '|') as city_ids, 
		group_concat(a.latitude SEPARATOR '|') as latitude,  group_concat(a.longitude SEPARATOR '|') as longitude,  group_concat(a.as_head_office SEPARATOR '|') as as_head_office,   group_concat(a.id SEPARATOR '|') as address_id 		
		FROM tbl_user as u 
		LEFT JOIN tbl_extra_address as a ON a.user_id=u.id
		LEFT JOIN countries as c ON c.id=a.country 
		LEFT JOIN states as s ON s.id=a.state 
		LEFT JOIN cities as ci ON ci.id=a.city 
		WHERE u.id=".$user_id."
		group by u.id";
        $result = $this->db->query($sql);
        $data = $result->result();		
		return $data;
    }
	public function get_members($user_id){
		$data =array();
		$sql="SELECT * FROM tbl_extra_members
		WHERE user_id=".$user_id."";
        $result = $this->db->query($sql);
		$data = $result->result();	
		return $data;
	}
	public function get_portfolios($user_id){
		$data =array();
		$sql="SELECT * FROM tbl_extra_portfolio
		WHERE user_id=".$user_id."";
        $result = $this->db->query($sql);
		$data = $result->result();	
		return $data;
	}
	/*public function getSkills($user_id){	
		$data =array();
		$sql="SELECT
		group_concat(ss.skill SEPARATOR '|') as roles_of_company,
		group_concat(r.roles_of_company SEPARATOR '|') as roles_of_company_id,		
		group_concat(r.rates_to_role SEPARATOR '|') as rates_to_role,
		group_concat(r.no_of_projects SEPARATOR '|') as no_of_projects 
		FROM tbl_user as u
		LEFT JOIN tbl_extra_roles as r ON r.user_id=u.id  
		LEFT JOIN tbl_skillset as ss ON r.roles_of_company=ss.id 
		WHERE u.id=".$user_id."
		group by u.id";
        $result = $this->db->query($sql);
		$data = $result->result();	
		return $data;
	}*/
	public function getSkills($user_id){	
		$data =array();
		$sql="SELECT * FROM tbl_extra_roles
		WHERE user_id=".$user_id."";
        $result = $this->db->query($sql);
		$data = $result->result();	
		return $data;
	}
	public function update_user($data,$file_name){
		//echo "<pre>";print_r($data);die;
		$sql = "UPDATE tbl_user SET
		company_name='".$data['company_name']."',
		phone='".$data['phone']."',
		years_of_experience='".$data['years_of_experience']."',
		turn_over='',
		website='".$data['website']."',
		about_company='".$data['about_company']."',
		no_of_employee='".$data['no_of_employee']."',
		photo='".$file_name."' 
		WHERE id = ".$data['user_id']."";
		//echo $sql;die;
		$result = $this->db->query($sql);
        return $result;
	}
	public function update_address($address_id,$address,$landmark,$city_name,$state_name,$country_name,$latitude,$longitude,$extra_emailid,$extra_phone,$as_head_office){
		$sql = "UPDATE tbl_extra_address SET
		extra_emailid='".$extra_emailid."',
		extra_phone='".$extra_phone."',
		country='".$country_name."',
		state='".$state_name."',
		city='".$city_name."',
		address='".$address."',
		landmark='".$landmark."',
		latitude='".$latitude."',
		longitude='".$longitude."',
		as_head_office='".$as_head_office."'
		WHERE id = ".$address_id."";//die;
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function insert_address($address,$landmark,$city_name,$state_name,$country_name,$latitude,$longitude,$extra_emailid,$extra_phone,$as_head_office){
		$sql = "INSERT tbl_extra_address SET 
		user_id='".$this->session->userdata('id')."',
		extra_emailid='".$extra_emailid."',
		extra_phone='".$extra_phone."',
		address='".$address."',
		landmark='".$landmark."',
		latitude='".$latitude."',
		longitude='".$longitude."',
		country='".$country_name."',
		state='".$state_name."',
		city='".$city_name."',
		as_head_office='".$as_head_office."'";
			
		$result = $this->db->query($sql);
        return $result;
	}
	public function update_member($member_id,$member_name,$member_designation,$member_description,$file_name){
		if($file_name!=''){
		$sql = "UPDATE tbl_extra_members SET
		member_name='".$member_name."',
		member_designation='".$member_designation."',
		member_description='".$member_description."',
		member_image='".$file_name."'
		WHERE id = ".$member_id."";
		}else{
		$sql = "UPDATE tbl_extra_members SET
		member_name='".$member_name."',
		member_designation='".$member_designation."',
		member_description='".$member_description."'
		WHERE id = ".$member_id."";
		}
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function insert_member($member_name,$member_designation,$member_description,$file_name){
		$sql = "INSERT tbl_extra_members SET
		user_id='".$this->session->userdata('id')."',
		member_name='".$member_name."',
		member_designation='".$member_designation."',
		member_description='".$member_description."',
		member_image='".$file_name."'";
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function update_portfolio($portfolio_id,$portfolio_url,$portfolio_features,$portfolio_description){
		$sql = "UPDATE tbl_extra_portfolio SET
		portfolio_url='".$portfolio_url."',
		portfolio_description='".$portfolio_description."',
		portfolio_features='".$portfolio_features."'
		WHERE id = ".$portfolio_id."";
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function insert_portfolio($portfolio_url,$portfolio_features,$portfolio_description){
		$sql = "INSERT tbl_extra_portfolio SET
		user_id='".$this->session->userdata('id')."',
		portfolio_url='".$portfolio_url."',
		portfolio_description='".$portfolio_description."',
		portfolio_features='".$portfolio_features."'";
		
		$result = $this->db->query($sql);
        return $result;
	}
	public function update_roles_of_company($id,$roles_of_company,$rates_to_role,$no_of_projects){
		
		$sql = "SELECT id FROM tbl_extra_roles WHERE user_id='".$this->session->userdata('id')."' AND id='".$id."'";
		
		$result = $this->db->query($sql);
		$res = $result->result();
		if(isset($res[0]->id) && $res[0]->id!=''){
			$sql = "UPDATE tbl_extra_roles SET
			roles_of_company='".$roles_of_company."',
			no_of_projects='".$no_of_projects."',
			rates_to_role='".$rates_to_role."'
			WHERE id = ".$id."";
			
			$result = $this->db->query($sql);
		}else{
			$sql = "INSERT tbl_extra_roles SET
			user_id='".$this->session->userdata('id')."',
			roles_of_company='".$roles_of_company."',
			no_of_projects='".$no_of_projects."',
			rates_to_role='".$rates_to_role."'";
			
			$result = $this->db->query($sql);	
		}
	}
	public function delete_roles_of_company($role_id){
		$sql = "DELETE FROM tbl_extra_roles WHERE user_id='".$this->session->userdata('id')."' AND roles_of_company='".$role_id."'";
		$result = $this->db->query($sql);
		print_r($result);
		
	}
	
}
