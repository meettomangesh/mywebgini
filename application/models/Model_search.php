<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_search extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function search_by_keyword($keyword) {
        $data = array();
        $sql = "SELECT skill FROM tbl_skillset WHERE skill LIKE '%" . $keyword . "%' ORDER BY id";
        $result = $this->db->query($sql);

        foreach ($result->result() as $row) {
            $data[] = $row->skill;
        }
        return json_encode($data);
    }

    public function simple_search($data, $limit, $offset) {
        //echo "=========".$offset;
        if ($offset == '') {
            $offset = 0;
        }
        if ((isset($data['skills']) && !empty($data['skills'])) || isset($data['country_name']) && !empty($data['country_name'])) {
            $country_name = $skills = '';
            if (isset($data['skills']) && $data['skills'] != '') {
                $skills = str_replace(',', '|', $data['skills']);
            }

            if (isset($data['country_name']) && $data['country_name'] != '') {
                $country_name = $data['country_name'];
            }
            $roles = $this->db->select('id,skill')->where("skill REGEXP '" . $skills . "'")->where("status", '1')->get('skillset')->result();

            if (isset($roles) && !empty($roles)) {
                foreach ($roles as $role) {
                    $r[] = $role->id;
                }
                $roles = implode('|', $r);
            } else {
                $roles = '';
            }
            $sql = $this->db->select('p.*,c.name as city_name')
                    ->from('providers as p')
                    ->join('tbl_extra_roles as ter', 'ter.provider_id = p.id', 'left')
                    ->join('tbl_extra_address as tea', 'tea.provider_id=p.id', 'left')
                    ->join('countries as c', 'c.id=tea.country', 'left')
                    ->where('p.status', '1');


            if ($roles != '') {
                $sql->where("ter.roles_of_company REGEXP '" . $roles . "'");
                //$sql .= " AND ter.roles_of_company IN('" . $roles . "') ";
            }
            if ($country_name != '') {
                $sql->where("c.name REGEXP '" . $country_name . "'");

                //$sql .= " AND c.name IN('" . $country_name . "') ";
            }
            $sql->group_by('p.id');

            //$sql->limit($limit, $offset);
            return $sql->get()->result();
        }
    }

    public function getAllProviderUtilizer() {
        $sql = $this->db->select('p.id as provider_id,p.*,ct.name as city_name,tea.*,pr.rating_count, FORMAT((pr.total_points / pr.rating_count),0) as average_rating')
                ->from('providers as p')
                ->join('tbl_extra_roles as ter', 'ter.provider_id = p.id', 'left')
                ->join('tbl_extra_address as tea', 'tea.provider_id=p.id', 'left')
                ->join('providers_rating as pr', 'pr.provider_id = p.id', 'left')
                ->join('countries as c', 'c.id=tea.country', 'left')
                ->join('cities as ct', 'ct.id=tea.city', 'left')
                ->join('states as st', 'st.id=tea.state', 'left')
                ->where('p.status', '1')
                ->limit(1000, 0);

        return $sql->get()->result();
    }

    public function search($data) {
        //echo "=========".$offset;
        //if ((isset($data['skills']) && !empty($data['skills'])) || isset($data['country']) && !empty($data['country'])) {
        $country_name = $skills = $state = $city = '';
        $noofemp = $noofexp = $iscomind = 0;
        if (!empty($data['skills'])) {
            $skills = str_replace(',', '|', $data['skills']);
        }

        if (!empty($data['country'])) {
            $country_name = $data['country'];
        }

        if (!empty($data['city'])) {
            $city = $data['city'];
        }

        if (!empty($data['state'])) {
            $state = $data['state'];
        }
        if (!empty($data['noofemp'])) {
            $noofemp = $data['noofemp'];
        }

        if (!empty($data['noofexp'])) {
            $noofexp = $data['noofexp'];
        }
        if (!empty($data['iscomind'])) {
            $iscomind = $data['iscomind'];
        }

        if (!empty($skills)) {
            $roles = $this->db->select('id,skill')->where("skill REGEXP '" . $skills . "'")->where("status", '1')->get('skillset')->result();
        }
        if (isset($roles) && !empty($roles)) {
            foreach ($roles as $role) {
                $r[] = $role->id;
            }
            $roles = implode('|', $r);
        } else {
            $roles = '';
        }
        /*$sql = $this->db->select('p.id as provider_id,p.*,ct.name as city_name,tea.*,pr.rating_count, FORMAT((pr.total_points / pr.rating_count),0) as average_rating,group_concat(s.skill) AS skill')
                ->from('providers as p')
                ->join('tbl_extra_roles as ter', 'ter.provider_id = p.id', 'left')
                ->join('skillset as s','ter.roles_of_company=s.id','left')
                ->join('tbl_extra_address as tea', 'tea.provider_id=p.id', 'left')
                ->join('providers_rating as pr', 'pr.provider_id = p.id', 'left')
                ->join('countries as c', 'c.id=tea.country', 'left')
                ->join('cities as ct', 'ct.id=tea.city', 'left')
                ->join('states as st', 'st.id=tea.state', 'left')
                ->where('p.status', '1');*/
                
        $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM providers AS u LEFT JOIN 
			( SELECT er.provider_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN skillset AS s ON er.roles_of_company=s.id GROUP BY er.provider_id ) skills ON u.id = skills.provider_id 
			LEFT JOIN ( SELECT ea.provider_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.provider_id ) city ON u.id = city.provider_id WHERE u.status='1'";        

        if ($roles != '') {
            $sql .= "AND ter.roles_of_company REGEXP '" . $roles . "',"
        }
        if ($country_name != '') {
            $sql .= "c.name REGEXP '" . $country_name . "',";
        }
        if ($state != '') {
            $sql .= "st.name REGEXP '" . $state . "',";
        }
        if ($city != '') {
            $sql.= "ct.name REGEXP '" . $city . "',";
        }
        if ($noofemp != 0) {
            $sql.= "p.no_of_employee >=".$noofemp." ,";
        }
        if ($noofexp != 0) {
            $sql.= "p.years_of_experience >=". $noofexp." ,";
        }
        if ($iscomind != 0) {
            $sql.= "p.is_company_individual =". $iscomind;
        }
         $sql.= "GROUP BY p.id";
         /*
        if ($roles != '') {
            $sql->where("ter.roles_of_company REGEXP '" . $roles . "'");
            //$sql .= " AND ter.roles_of_company IN('" . $roles . "') ";
        }
        if ($country_name != '') {
            $sql->where("c.name REGEXP '" . $country_name . "'");
        }
        if ($state != '') {
            $sql->where("st.name REGEXP '" . $state . "'");
        }
        if ($city != '') {
            $sql->where("ct.name REGEXP '" . $city . "'");
        }
        if ($noofemp != 0) {
            $sql->where('p.no_of_employee >=', $noofemp);
        }
        if ($noofexp != 0) {
            $sql->where('p.years_of_experience >=', $noofexp);
        }
        if ($iscomind != 0) {
            $sql->where('p.is_company_individual =', $iscomind);
        }
        $sql->group_by('p.id');
        */
        $sqlRes  = $this->db()->query($sql);
        if ($data['debug'] == 1) {
            print_r($sql);
            pre($sqlRes->get()->result());
        }
        
        //$sql->limit($limit, $offset);
        return $sqlRes->get()->result();
        // }
    }

    public function simple_search_count($data) {
        if ((isset($data['skills']) && !empty($data['skills'])) || isset($data['country_name']) && !empty($data['country_name'])) {
            $country_name = $skills = '';
            if (isset($data['skills']) && $data['skills'] != '') {
                $skills = str_replace(',', '|', $data['skills']);
            }

            if (isset($data['country_name']) && $data['country_name'] != '') {
                $country_name = $data['country_name'];
            }
            $roles = $this->db->select('id,skill')->where("skill REGEXP '" . $skills . "'")->where("status", '1')->get('skillset')->result();

            if (isset($roles) && !empty($roles)) {
                foreach ($roles as $role) {
                    $r[] = $role->id;
                }
                $roles = implode(',', $r);
            } else {
                $roles = '';
            }
            $sql = "SELECT p.* FROM providers as p 
                        LEFT JOIN tbl_extra_roles as ter ON ter.provider_id = p.id
                        LEFT JOIN tbl_extra_address as tea on tea.provider_id=p.id
                        LEFT JOIN cities as c on c.id=tea.city
			WHERE p.status='1'";
            if ($roles != '') {
                $sql .= " AND ter.roles_of_company IN('" . $roles . "') ";
            }
            if ($country_name != '') {
                $sql .= " AND c.name IN('" . $country_name . "') ";
            }
        } else {
            $sql = "SELECT p.* FROM providers as p 
                        LEFT JOIN tbl_extra_roles as ter ON ter.provider_id = p.id
                        LEFT JOIN tbl_extra_address as tea on tea.provider_id=p.id
                        LEFT JOIN cities as c on c.id=tea.city
			WHERE p.status='1'";
        }
        $sql .= 'GROUP by p.id';

        $result = $this->db->query($sql);
        return $result->num_rows();
    }

    public function advance_search($data) {
        if (isset($data['skills']) && $data['skills'] != '') {
            $skills = explode(',', $data['skills']);
        } else {
            $skills = array();
        }
        /* if(isset($data['skills']) && count($skills)>0){
          array_pop($skills);
          } */
        $skills = array_map('trim', $skills);
        $skills = "'" . implode("', '", $skills) . "'";

        $sql = "SELECT id FROM tbl_skillset WHERE skill IN(" . $skills . ")";
        $result = $this->db->query($sql);
        $roles = $result->result();
        $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM providers AS u LEFT JOIN 
			( SELECT er.provider_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.provider_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id WHERE ";
        if (isset($data['skills']) && $data['skills'] != '') {
            $sql .= " ( "; //this is for extra OR condiation added in for loop.
        }
        foreach ($roles as $role) {
            $sql .= " FIND_IN_SET(" . $role->id . ", er.roles_of_company) OR";
        }
        if (isset($data['skills']) && $data['skills'] != '') {
            $sql .= " 1!=1 ) "; //this is for extra OR condiation added in for loop.
        }
        if (isset($data['skills']) && $data['skills'] != '' && isset($data['country_name']) && $data['country_name'] != '') {

            $sql .= " AND ";
        }
        if (isset($data['country_name']) && $data['country_name'] != '') {

            $country_id_sql = "SELECT id FROM countries WHERE name='" . $data['country_name'] . "'";
            $country_id_result = $this->db->query($country_id_sql);
            $id = $country_id_result->result();

            $sql .= " u.country='" . $id[0]->id . "' AND ";
        }
        if (isset($data['skills']) && $data['skills'] != '' && isset($data['country_name']) && $data['country_name'] == '') {
            $sql .= " AND ";
        }
        $sql .= " 1=1 ";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function country_name() {
        $data = array();
        $sql = "SELECT name FROM countries WHERE 1=1 ORDER BY id";
        $result = $this->db->query($sql);

        foreach ($result->result() as $row) {
            $data[]['name'] = $row->name;
        }
        return json_encode($data);
    }

    public function getSkills() {
        $data = array();
        $result = $this->getSkillsArray();

        foreach ($result as $row) {
            $data[] = array('id' => $row->id, 'skill' => $row->skill);
        }
        return json_encode($data);
    }

    public function getFooterSkills() {
        $data = array();
        $result = $this->db->where('view_at_footer', '1')->where('status', '1')->order_by('id')->get('skillset')->result();
        foreach ($result as $row) {
            $data[] = array('id' => $row->id, 'skill' => $row->skill);
        }
        return $data;
    }

    public function getSkillsArray() {
        return $this->db->order_by('id')->get('skillset')->result();
    }

    public function total_count($who = '') {
        $data = array();
        if ($who != '') {
            if ($who != 'other_skills') {
                $sql = "SELECT count(*) as count_number FROM providers WHERE is_company_individual='" . $who . "' AND status='active'";
            } else {
                $sql = "SELECT count(*) as count_number FROM providers as u LEFT JOIN tbl_extra_roles as eer ON eer.provider_id=u.id
			WHERE  eer.roles_of_company IS NULL AND u.status='active'";
            }
        } else {
            $sql = "SELECT count(*) as count_number FROM providers WHERE status='active'";
        }
        $result = $this->db->query($sql);
        $res = $result->result();
        return $res[0];
    }

    public function roles_count($role) {
        $data = array();
        $sql = "SELECT count(*) as count_number FROM tbl_extra_roles as er LEFT JOIN providers as u ON u.id=er.provider_id WHERE FIND_IN_SET( '" . $role . "',roles_of_company) AND u.status='1'";
        $result = $this->db->query($sql);
        $res = $result->result();
        return $res[0];
    }

    public function getResult($who = '') {
        $data = array();
        if ($who != '') {
            $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM providers AS u LEFT JOIN 
			( SELECT er.provider_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.provider_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id   WHERE u.is_company_individual='" . $who . "' AND status='active'";
        } else {
            $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM providers AS u LEFT JOIN 
			( SELECT er.provider_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.provider_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id WHERE status='active'";
        }
        //echo $sql;
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getRoleResult($role) {
        $data = array();
        $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM providers AS u LEFT JOIN 
			( SELECT er.provider_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.provider_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			LEFT JOIN tbl_extra_roles as eer ON eer.provider_id=u.id
			WHERE FIND_IN_SET('" . $role . "',eer.roles_of_company) AND u.status='active' ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function other_skills() {
        $data = array();
        $sql = "SELECT u.*, skills.skill, city.city_name 
			FROM providers AS u LEFT JOIN 
			( SELECT er.provider_id, group_concat(s.skill) AS skill 
			FROM tbl_extra_roles AS er 
			LEFT JOIN tbl_skillset AS s ON er.roles_of_company=s.id GROUP BY er.provider_id ) skills ON u.id = skills.user_id 
			LEFT JOIN ( SELECT ea.user_id, group_concat(c.name ORDER BY FIELD(as_head_office, 'yes', 'no')) AS city_name 
			FROM tbl_extra_address AS ea 
			LEFT JOIN cities as c ON ea.city = c.id 
			GROUP BY ea.user_id ) city ON u.id = city.user_id
			LEFT JOIN tbl_extra_roles as eer ON eer.provider_id=u.id
			WHERE  eer.roles_of_company IS NULL AND u.status='active' ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getMapElements($data) {
        $sql = "SELECT u.*,ea.*, c.name as country_name, s.name as state_name, ci.name as city_name 
			FROM providers AS u 
			LEFT JOIN tbl_extra_address as ea ON ea.user_id=u.id 
			LEFT JOIN countries as c ON ea.country=c.id 
			LEFT JOIN states as s ON ea.state = s.id 
			LEFT JOIN cities as ci ON ea.city=ci.id 			
			WHERE  ea.country=" . $data['country_id'] . " AND ea.state=" . $data['state_id'] . " AND ea.city=" . $data['city_id'] . " AND u.status='active' ";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>
