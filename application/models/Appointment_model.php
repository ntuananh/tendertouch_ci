<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Appointment_model extends MY_Model {

    public function insert($param) {
        $this->db->insert('appointment', $param);
        return $this->db->insert_id();
    }

    public function getAppointmentsByDate($date) {
        $sql = "SELECT app.id, app.customer_id, app.time, app.status, cus.phone, cus.name FROM appointment app JOIN customer cus ON app.customer_id = cus.id WHERE DATE(app.time)='$date' ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get($id) {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->join('customer', 'appointment.customer_id=customer.id');
        $this->db->where('appointment.id', $id);
        $result = $this->db->get()->result_array();

        return $result[0];
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

}
