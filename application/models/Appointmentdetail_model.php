<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Appointmentdetail_model extends MY_Model {

    public function insert_batch($param) {
        $this->db->insert_batch('appointment_detail', $param);
    }

    public function get($id) {
        $this->db->select('*');
        $this->db->from('appointment_detail');
        $this->db->join('service', 'appointment_detail.service_id=service.id');
        $this->db->where('appointment_id', $id);
        $result = $this->db->get();

        return $result->result_array();
    }

}
