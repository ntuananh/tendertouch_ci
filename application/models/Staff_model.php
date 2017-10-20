<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    public function getStaffList($type = null) {
        if ($type != null) {
            $this->db->where_in('type', $type);
        }
        $this->db->where('status', 0);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('staff');

        return $query->result_array();
    }

    public function getUncheckinList($date) {
        $query = $this->db->query("SELECT * FROM staff s WHERE s.status = 0 and type=1 AND s.id not IN (SELECT staff_id FROM attendance a WHERE date = '$date') ORDER BY s.name ASC");
        return $query->result_array();
    }

    public function getCheckedinList($date) {
        $query = $this->db->query("SELECT * FROM staff s JOIN attendance a ON s.id = a.staff_id WHERE a.date = '$date' and type=1  ORDER BY a.date DESC");
        return $query->result_array();
    }

    public function doCheckin($param) {
        $sql = "INSERT INTO attendance (date, staff_id) VALUES (" . $this->db->escape($param['date']) . ", " . $this->db->escape($param['staff_id']) . ")";
        $this->db->query($sql);
        return $this->db->affected_rows() == 1;
    }

}
