<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Turn extends MY_Controller {

    public function index() {

        $today = date('y-m-d');
        $param = array(
            'date' => $today,
        );
        $turnList = $this->turn_model->getTurnList($param);
        $viewData = array(
            'turnList' => $turnList,
        );

        $this->template->set('title', 'Home');
        $this->template->set('activeClass', 'turn');
        $this->template->load('template', 'contents', 'turn', $viewData);
    }

    public function startTurn() {
        $turnId = $this->input->post('turn_id');

        $param = array(
            'turn_id' => $turnId,
            'checkin_time' => date('y-m-d G:i:s')
        );

        $this->turn_model->startTurn($param);
        redirect('turn');
    }

    public function finishTurn() {
        $turnId = $this->input->post('turn_id');
        $isHalfTurn = $this->input->post('half_turn');
        var_dump($isHalfTurn);
        exit;

        $turnInfo = $this->turn_model->get($turnId);

        $param = array(
            'turn_id' => $turnId,
            'checkout_time' => date('y-m-d G:i:s')
        );

        $this->turn_model->finishTurn($param);
        $param4newWaiting = array(
            'staff_id' => $turnInfo['staff_id'],
            'date' => date('y-m-d'),
        );

        $this->turn_model->newWaiting($param4newWaiting);
        redirect('turn');
    }

}
