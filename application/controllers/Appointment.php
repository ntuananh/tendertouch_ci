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

    public function new_appointment() {
        $isPost = $this->input->post();
        $viewData = array();

        if ($isPost) {
            $tech_id = $this->input->post('tech_id');
            $datetime = $this->input->post('datetime');

            $viewData = array(
                'tech_id' => $tech_id,
                'datetime' => $datetime,
            );
        }
        $this->template->set('title', 'New Appointment');
        $this->template->set('activeClass', 'appointment');
        $this->template->load('template', 'contents', 'appointment/new', $viewData);
    }

    public function create_appointment() {
        $date = $this->input->post('dateTime');
        $phone = $this->input->post('phone');
        $name = $this->input->post('name');
        $note = $this->input->post('note');

        $detail = json_decode($this->input->post('detail'));

        $customer_id = $this->customer_model->insert(array(
            'phone' => $phone,
            'name' => $name,
        ));

        $appointmentData = array(
            'time' => $date,
            'customer_id' => $customer_id,
            'note' => $note,
        );

        $appId = $this->appointment_model->insert($appointmentData);

        $appointmentDataDetail = array();

        foreach ($detail as $item) {
            if ($item->service_id != '' && $item->staff_id != '') {
                array_push($appointmentDataDetail, array(
                    'appointment_id' => $appId,
                    'service_id' => $item->service_id,
                    'staff_id' => $item->staff_id,
                ));
            }
        }

        $this->appointmentdetail_model->insert_batch($appointmentDataDetail);

        redirect('appointment');
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

    public function edit() {
        $apptId = $this->uri->segment(3);

        $viewData = array(
            'apptId' => $apptId,
        );
        $this->template->set('title', 'Appointment Detail');
        $this->template->set('activeClass', 'appointment');
        $this->template->load('template', 'contents', 'appointment/edit', $viewData);
    }

    public function update() {
        $apptId = $this->input->post('apptId');

        $cancelFlg = $this->input->post('cancel');
        if ($cancelFlg === 'on') {
            $updateData = array(
                'status' => 1,
            );
        } else {
            $time = $this->input->post('dateTime');
            $note = $this->input->post('note');
            $updateData = array(
                'time' => $time,
                'note' => $note,
            );
        }


        $this->appointment_model->update($apptId, $updateData);

        $this->session->set_flashdata('msg', 'Updated successfully');
        redirect('appointment');
    }

}
