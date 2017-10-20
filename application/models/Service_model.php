<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Service_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }
    
    public function getServices() {
        $sql = "SELECT * FROM service s";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
}