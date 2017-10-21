<?php

function createHtmlForEachHour($technicians) {
    $startHour = 9;
    $endHour = 18;
    $interval = array('00', '15', '30', '45');
    $html = '';
    for ($i = $startHour; $i <= $endHour; $i++) {
        foreach ($interval as $value) {

            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $value . '</td>';
            foreach ($technicians as $person) {
                $html .= '<td tid="' . $person['id'] . '" time="' . $i . ':' . $value . '" class="appointable">';

                if (isset($_SESSION['logged_in'])) {
                    $html .= '<a class="newAppt"><img src="'. base_url().'assets/picture/add.png" alt="new appointment" /></a>';
                }
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
    }

    return $html;
}
?>
<?php if ($this->session->flashdata('msg')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>

<?php } ?>
<input id="dateIp">
<table border="1" id="apptTbl">
    <thead>
    <th colspan="2">Time</th>
    <?php foreach ($technicians as $person) { ?>
        <th tid="<?php echo $person['id']; ?>" class="technicianCol"><?php echo $person['name']; ?></th>
    <?php } ?>
</thead>  
<tbody>
    <?php echo createHtmlForEachHour($technicians); ?>
</tbody>
</table>

<form id="f" name="f" method="post" action="<?php echo site_url('admin/appointment/new_appointment'); ?>">
    <input type="hidden" name="datetime"/>
    <input type="hidden" name="tech_id"/>
</form>

<div id="dialog-message" title="Appointment">
    <table>
        <tbody id="detailbodyTbl">
            <tr>
                <td class="detailtPopup1"><label>Date</label></td>
                <td class="detailtPopup2"><label id="dateLbl"></label></td>
            </tr>
            <tr>
                <td><label>Name</label></td>
                <td><label id="nameLbl"></label></td>
            </tr>
        </tbody>
    </table>

    <table id="serviceDetail">
        <tbody>
        </tbody>
    </table>

</div>
<input type="hidden" id="detailIdHidden" />
<script>
    function detail(apptId) {
        var result = getDetailAppointment(apptId);
//    console.log(result);
        $('#dateLbl').text(result['time']);
        $('#nameLbl').text(result['name']);
        var serviceCont = '';
        for (var i = 0; i < result['detail'].length; i++) {

            serviceCont += '<tr><td class="detailtPopup1"><label>' + result['detail'][i]['service_name'] + '</label></td><td class="detailtPopup2"><label>' + result['detail'][i]['staff_name'] + '</label></td></tr>';
        }

        if (result['note'] !== null && result['note'] !== '') {
            serviceCont += '<tr><td colspan=2"><textarea disabled="disabled" class="detailApptNote">' + result['note'] + '</textarea></td></tr>'
        }
        $('#serviceDetail tbody').empty().append(serviceCont);
        $('#dialog-message').attr('apptId', apptId).dialog('open');
    }

    function attachAppointments() {
        // Attach appointments
        var date = $('#dateIp').val().replace(/-/gi, '');
        var appointments = getAppointments(date);
        console.log(appointments);
        var $appTd = [];
        for (var i = 0; i < appointments.length; i++) {
            var detail = appointments[i]['detail'];
            var hour = appointments[i]['hour'];
            var min = appointments[i]['min'];
            for (var j = 0; j < detail.length; j++) {
                var tech_id = detail[j]['staff_id'];
                var $td = $('#apptTbl').find('td[tid="' + tech_id + '"][time="' + hour + ':' + min + '"]');
                // Check if appoinment was cancled
                var className = '';
                if (appointments[i]['status'] == 1) {
                    className += 'apptCancelled';
                }
                $td.append(' <a href="#" class="' + className + '" onclick="detail(' + appointments[i]['id'] + ')">' + detail[j]['service_name'] + '</a>');
                if (tech_id === '1' || tech_id === '') {
                } else {

                    var duration = $td.attr('duration');
                    if (duration == undefined) {
                        duration = 0;
                    } else {
                        duration = parseInt(duration);
                    }

                    if (appointments[i]['status'] == 0) {
                        duration += parseInt(detail[j]['duration']);
                    }

                    if (duration > 0) {
                        $td.addClass('appointment_time');
                        $td.find('img').remove();
                    }
                    $td.attr('duration', duration);
                }
            }
        }

        // Change cell color
        $tds = $('#apptTbl tbody td.appointment_time');
        $.each($tds, function (index) {
            var duration = parseInt($(this).attr('duration'));
            var cellIndex = $(this).index();
            var rowIndex = $(this).parent().index();
            var apptTbl = $('#apptTbl tbody');
            for (var j = 0; j < parseInt(duration) / 15; j++) {
                var tr = apptTbl.find('tr').eq(rowIndex + j);
                var td = tr.find('td').eq(cellIndex);
                td.find('img').remove();
                td.addClass('appointment_time');
            }
        });
        //End

    }

    $(document).ready(function () {
        $('#dateIp').datetimepicker({
            timepicker: false,
            //            defaultDate: new Date(),
            format: 'Y-m-d',
            value: '<?php echo $date; ?>',
            onChangeDateTime: function (dp, $input) {
                //                $dateParam = $input.val().replace(/-/gi,'');
                //                window.location = '<?php // echo site_url("appointment/index");                                                                        ?>/'+$dateParam;
                //                console.log($input.val());
            },
            onSelectDate: function (dp, $input) {
                $dateParam = $input.val().replace(/-/gi, '');
                window.location = '<?php echo site_url("appointment/index"); ?>/' + $dateParam;
            },
        });
        $('.newAppt').click(function () {
            var day = $('#dateIp').val();
            var time = $(this).parents('td').attr('time');
            var datetime = Date.parse(day + ' ' + time);
            var tech_id = $(this).parents('td').attr('tid');
            $('input[name=datetime]').val(datetime);
            $('input[name=tech_id]').val(tech_id);
            $('#f').submit();
        });


        attachAppointments();

        // Popup Dettail
        $("#dialog-message").dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
        });
<?php if (isset($this->session->userdata['logged_in'])) { ?>
            $("#dialog-message").dialog({
                buttons: {
                    "Edit": function () {
                        window.location = '<?php echo site_url('admin/appointment/edit/'); ?>' + $("#dialog-message").attr('apptId');
                    },
                    "Cancel this appointment": function () {
                        window.location = '<?php echo site_url('admin/appointment/cancel/'); ?>' + $("#dialog-message").attr('apptId');
                    }
                }
            });

<?php } ?>
        // End


    });

</script>