<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_enquiry extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_enquiry_skillset');
    }

    function form_insert($data) {
        $skillEnqData = [];
        $skillIdArr = $data['skill'];
        unset($data['skill']);
        $enquiryId = $this->db->insert('enquiry', $data);
        foreach ($skillIdArr as $value) {
            $skillEnqData[] = array('enquiry_id' => $enquiryId,'skillset_id'=>$value,'created_by'=>$data['utilizer_id']);
        }
        $this->Model_enquiry_skillset->form_insert($skillEnqData);
        return $enquiryId;
    }

    function getEnquiryByProviderId($data) {
        $this->db->select('a.*');
        $this->db->from('expreimburse a');
        $this->db->where('reportid', $getcode);

        $result = $this->db->get();
        //echo $this->db->last_query();

        return $result->result();
    }

}

?>