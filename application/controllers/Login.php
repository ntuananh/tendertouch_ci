<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends MY_Controller {

    public function index() {

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($username == 'anh' && $password = "em") {
                $session_data = array(
                    'username' => $username,
                );
                $this->session->set_userdata('logged_in', $session_data);
                redirect('appointment');
            } else {
                $this->session->set_flashdata('msg', 'Login Fail');
                redirect('login');
            }
        } else {
            $this->template->set('title', 'Login');
            $this->template->set('activeClass', '');
            $this->template->load('template', 'contents', 'login', array());
        }
    }

}
