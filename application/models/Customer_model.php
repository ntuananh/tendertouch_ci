<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customer_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }
    
    public function insert($param) {
        $this->db->insert('customer', $param);
        return $this->db->insert_id();
    }
}