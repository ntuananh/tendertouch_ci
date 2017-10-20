<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Api extends MY_Controller {

    public function getStaffIdAndName() {
        $type = $this->input->post('type');

        $result = $this->staff_model->getStaffList($type);
        echo json_encode($result);
    }

    public function getServices() {

        $result = $this->service_model->getServices();
        echo json_encode($result);
    }

    public function getAppointments() {
        $date = $this->input->post('date');

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = DateTime::createFromFormat('Ymd', $date);

            $date = date_format($date, 'Y-m-d');
        }
        $result = $this->appointment_model->getAppointmentsByDate($date);
        foreach ($result as $key => $value) {
            $time = new DateTime($result[$key]['time']);
            $result[$key]['hour'] = $time->format('G');
            $result[$key]['min'] = $time->format('i');
            $result[$key]['detail'] = $this->appointmentdetail_model->get($value['id']);

        }
        echo json_encode($result);
    }
    
    public function getDetailAppointment() {
        $apptId = $this->uri->segment(3);

        $appt = $this->appointment_model->get($apptId);
        $appt['detail'] = $this->appointmentdetail_model->get($apptId);
        
        echo json_encode($appt);
    }

}
