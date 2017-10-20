<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('staff_model');
        $this->load->model('turn_model');
        $this->load->model('appointment_model');
        $this->load->model('appointmentdetail_model');
        $this->load->model('service_model');
        $this->load->model('customer_model');
    }

}
