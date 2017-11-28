<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_search extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
	public function search_by_keyword($keyword){
		$data = array();
		$sql = "SELECT skill FROM tbl_skillset WHERE skill LIKE '%".$keyword."%' ORDER BY id";
        $result = $this->db->query($sql);
		
		foreach($result->result() as $row){
			$data[] = $row->skill;
		}
		return json_encode($data);
	}
	public function simple_search($data,$limit,$offset){
		//echo "=========".$offset;
		if($offset==''){
			$offset=0;
		}
		if((isset($data['skills']) && !empty($data['skills'])) || isset($data['country_name']) && !empty($data['country_name'])){
		if(isset($data['skills']) && $data['skills']!=''){
			$skills = explode(',',$data['skills']);			
		}else{
			$skills = array();
		}
		if(isset($data['country_name']) && $data['country_name']!=''){
			$country_name = $data['country_name'];			
		}else{
			$country_name = '';
		}		
		//array_map and trim function remove spaces from array
		$skills = array_map('trim',$skills);
		//implode array into formatted string 
		$skills = "'" . implode ( "', '", $skills ) . "'";
		
		$sql = "SELECT id FROM tbl_skillset WHERE skill IN(".$skills.")";
        $result = $this->db->query($sql);
		$roles = $result->result();
		if(isset($roles) && !empty($roles)){
			foreach($roles as $role){
				$r[] = $role->id;
			}
			$roles = implode(',',$r);
		}else{
			$roles='';
		}		
		    $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			WHERE 1=1";
			if($roles!=''){
				//$sql .=" AND er.roles_of_company IN('".$roles."') ";
			}
			if($country_name!=''){
				//$sql .=" AND c.name IN('".$country_name."') ";
			}
		}else{
			$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			WHERE u.status='active'";
		}
		$sql .= ' LIMIT '.$offset.','.$limit;
		//echo $sql;
		$result = $this->db->query($sql);
		return $result->result();
	}
	public function simple_search_count($data){
		if((isset($data['skills']) && !empty($data['skills'])) || isset($data['country_name']) && !empty($data['country_name'])){
		if(isset($data['skills']) && $data['skills']!=''){
			$skills = explode(',',$data['skills']);			
		}else{
			$skills = array();
		}
		if(isset($data['country_name']) && $data['country_name']!=''){
			$country_name = $data['country_name'];			
		}else{
			$country_name = '';
		}		
		//array_map and trim function remove spaces from array
		$skills = array_map('trim',$skills);
		//implode array into formatted string 
		$skills = "'" . implode ( "', '", $skills ) . "'";
		
		$sql = "SELECT id FROM tbl_skillset WHERE skill IN(".$skills.")";
        $result = $this->db->query($sql);
		$roles = $result->result();
		if(isset($roles) && !empty($roles)){
			foreach($roles as $role){
				$r[] = $role->id;
			}
			$roles = implode(',',$r);
		}else{
			$roles='';
		}		
		    $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			WHERE 1=1";
			if($roles!=''){
				//$sql .=" AND er.roles_of_company IN('".$roles."') ";
			}
			if($country_name!=''){
				//$sql .=" AND c.name IN('".$country_name."') ";
			}
		}else{
			$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			WHERE u.status='active'";
		}
		$result = $this->db->query($sql);
		return $result->num_rows();
	}
	public function advance_search($data){
		if(isset($data['skills']) && $data['skills']!=''){
			$skills = explode(',',$data['skills']);			
		}else{
			$skills = array();
		}
		/*if(isset($data['skills']) && count($skills)>0){
			array_pop($skills);
		}*/
		$skills = array_map('trim',$skills);
		$skills = "'" . implode ( "', '", $skills ) . "'";

		$sql = "SELECT id FROM tbl_skillset WHERE skill IN(".$skills.")";
        $result = $this->db->query($sql);
		$roles = $result->result();
		$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id WHERE ";
		if(isset($data['skills']) && $data['skills']!=''){
			$sql.=" ( "; //this is for extra OR condiation added in for loop.
		}
		foreach($roles as $role){
			$sql .=" FIND_IN_SET(".$role->id.", er.roles_of_company) OR";
		}
		if(isset($data['skills']) && $data['skills']!=''){
			$sql.=" 1!=1 ) "; //this is for extra OR condiation added in for loop.
		}
		if(isset($data['skills']) && $data['skills']!='' && isset($data['country_name']) && $data['country_name']!=''){
			
			$sql .=" AND ";
		}
		if(isset($data['country_name']) && $data['country_name']!=''){
			
			$country_id_sql = "SELECT id FROM countries WHERE name='".$data['country_name']."'";
			$country_id_result = $this->db->query($country_id_sql);
			$id = $country_id_result->result();
			
			$sql .=" u.country='".$id[0]->id."' AND "; 
		}
		if(isset($data['skills']) && $data['skills']!='' && isset($data['country_name']) && $data['country_name']==''){
			$sql .=" AND ";
		}
		$sql .=" 1=1 ";
		
		$result = $this->db->query($sql);
		return $result->result();
	}
	public function country_name(){
		$data = array();
		$sql = "SELECT name FROM countries WHERE 1=1 ORDER BY id";
        $result = $this->db->query($sql);
		
		foreach($result->result() as $row){
			$data[]['name'] = $row->name;			
		}
		return json_encode($data);
	}
	public function getSkills(){
		$data = array();
		$sql = "SELECT skill FROM tbl_skillset WHERE 1=1 ORDER BY id";
        $result = $this->db->query($sql);
		
		foreach($result->result() as $row){
			$data[]['skill'] = $row->skill;
		}
		return json_encode($data);
	}
	public function getSkillsArray(){
		$data = array();
		$sql = "SELECT * FROM tbl_skillset WHERE 1=1 ORDER BY id";
        $result = $this->db->query($sql);		
		return $result->result();
	}
	public function total_count($who=''){
		$data = array();
		if($who!=''){
			if($who!='other_skills'){
			$sql = "SELECT count(*) as count_number FROM tbl_user WHERE is_company_individual='".$who."' AND status='active'";
			}else{
			$sql = "SELECT count(*) as count_number FROM tbl_user as u LEFT JOIN tbl_extra_roles as eer ON eer.user_id=u.id
			WHERE  eer.roles_of_company IS NULL AND u.status='active'";
			}
		}else{
			$sql = "SELECT count(*) as count_number FROM tbl_user WHERE status='active'";
		}
        $result = $this->db->query($sql);
		$res = $result->result();
		return $res[0];
	}
	public function roles_count($role){
		$data = array();
		$sql = "SELECT count(*) as count_number FROM tbl_extra_roles as er LEFT JOIN tbl_user as u ON u.id=er.user_id WHERE FIND_IN_SET( '".$role."',roles_of_company) AND u.status='active'";		
		$result = $this->db->query($sql);		
		$res = $result->result();
		return $res[0];
	}
	public function getResult($who=''){
		$data = array();
		if($who!=''){
			$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id   WHERE u.is_company_individual='".$who."' AND status='active'";		
		}else{
			$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id WHERE status='active'";
		}
		//echo $sql;
		$result = $this->db->query($sql);		
		return $result->result();
	}
	public function getRoleResult($role){
		$data = array();
		$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			LEFT JOIN tbl_extra_roles as eer ON eer.user_id=u.id
			WHERE FIND_IN_SET('".$role."',eer.roles_of_company) AND u.status='active' ";
		$result = $this->db->query($sql);		
		return $result->result();
	}
	public function other_skills(){
		$data = array();
		$sql = "SELECT u.*, skills.skill, city.city_name 
			FROM tbl_user AS u LEFT JOIN 
			( SELECT er.user_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.user_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			LEFT JOIN tbl_extra_roles as eer ON eer.user_id=u.id
			WHERE  eer.roles_of_company IS NULL AND u.status='active' ";
		$result = $this->db->query($sql);		
		return $result->result();
	}
	public function getMapElements($data){
		$sql = "SELECT u.*,ea.*, c.name as country_name, s.name as state_name, ci.name as city_name 
			FROM tbl_user AS u 
			LEFT JOIN tbl_extra_address as ea ON ea.user_id=u.id 
			LEFT JOIN countries as c ON ea.country=c.id 
			LEFT JOIN states as s ON ea.state = s.id 
			LEFT JOIN cities as ci ON ea.city=ci.id 			
			WHERE  ea.country=".$data['country_id']." AND ea.state=".$data['state_id']." AND ea.city=".$data['city_id']." AND u.status='active' ";
		$result = $this->db->query($sql);		
		return $result->result();
	}	
}

?>