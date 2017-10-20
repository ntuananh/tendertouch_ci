<?php

class Turn_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }
    
    public function get($turn_id) {
        $sql = "SELECT * FROM turn WHERE id = $turn_id";
        $query = $this->db->query($sql);
        $resultArray = $query->result_array();
        return $resultArray[0];
    }

    public function newWaiting($param) {
        $sql = "INSERT INTO turn(date, staff_id) VALUES('" . $param['date'] . "','" . $param['staff_id'] . "')";

        $this->db->query($sql);
        return $this->db->affected_rows() == 1;
    }

    public function startTurn($param) {
        $sql = "UPDATE turn SET checkin_time = '".$param['checkin_time']."' WHERE id = ".$param['turn_id'];
        $this->db->query($sql);
        return $this->db->affected_rows() == 1;
    }

    public function finishTurn($param) {
        $sql = "UPDATE turn SET checkout_time = '".$param['checkout_time']."' WHERE id = ".$param['turn_id'];
        $this->db->query($sql);
        return $this->db->affected_rows() == 1;
    }

    public function getTurnList($param) {
        $sql = "SELECT t.id tid, t.date, s.name, s.id sid, t.checkin_time, t.checkout_time FROM turn t JOIN staff s ON t.staff_id = s.id WHERE t.date ='" . $param['date'] . "' ORDER BY t.created";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
