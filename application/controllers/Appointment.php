<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Appointment extends MY_Controller {

    public function index() {

        $date = $this->uri->segment(3);

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = DateTime::createFromFormat('Ymd', $date);

            $date = date_format($date, 'Y-m-d');
        }
        $technicians = $this->staff_model->getStaffList(array(1, 2));

        $appointments = $this->appointment_model->getAppointmentsByDate($date);
        $viewData = array(
            'date' => $date,
            'technicians' => $technicians,
            'appointments' => $appointments,
        );
        $this->template->set('title', 'Appointment List');
        $this->template->set('activeClass', 'appointment');
        $this->template->load('template', 'contents', 'appointment/list2', $viewData);
    }

    

    public function detail() {
        $apptId = $this->uri->segment(3);

        $viewData = array(
            'apptId' => $apptId,
        );
        $this->template->set('title', 'Appointment Detail');
        $this->template->set('activeClass', 'appointment');
        $this->template->load('template', 'contents', 'appointment/view', $viewData);
    }

}
