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
        $this->db->select('ad.id did, ser.duration, ser.id service_id, ser.name service_name, sta.id staff_id, sta.name staff_name');
        $this->db->from('appointment_detail as ad');
        $this->db->join('service as ser', 'ad.service_id=ser.id');
        $this->db->join('staff as sta', 'ad.staff_id=sta.id');
        $this->db->where('appointment_id', $id);
        $result = $this->db->get();

        return $result->result_array();
    }

}
