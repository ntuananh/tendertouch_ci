<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Checkin extends MY_Controller {

    public function index() {

        $today = date('y-m-d');
        // Get uncheck-in list
        $uncheckin = $this->staff_model->getUncheckinList($today);
        $checkedin = $this->staff_model->getCheckedinList($today);

        $viewData = array(
            'uncheckin' => $uncheckin,
            'checkedin' => $checkedin,
        );

//        $content = $this->load->view('checkin', $viewData, true);
//        $this->load->view('template', ['content' => $content]);
        $this->template->set('title', 'Home');
        $this->template->set('activeClass', 'checkin');
        $this->template->load('template', 'contents', 'checkin', $viewData);
    }

    public function doCheckin() {

        $today = date('y-m-d');
        $sid = $this->input->post('sid');
        $params = array(
            'date' => $today,
            'staff_id' => $sid,
        );
        $this->staff_model->doCheckin($params);
        $this->turn_model->newWaiting($params);
        redirect('/checkin/index');
    }

}
