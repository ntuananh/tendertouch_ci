<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_AController extends MY_Controller {

    public function __construct() {
        parent::__construct();

        // Check login status
        if (!isset($this->session->userdata['logged_in'])) {
            $this->template->set('title', 'Login');
            $this->template->set('activeClass', '');
            $this->template->load('template', 'contents', 'login', array());
        }
    }

}
