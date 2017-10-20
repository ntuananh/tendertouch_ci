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
                $html .= '<td tid="' . $person['id'] . '" time="' . $i . ':' . $value . '" class="appointable">' . '<a class="newAppt"><img src="http://tendertouch.local/assets/picture/add.png" alt="new appointment" /></a>' . '</td>';
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

<form id="f" name="f" method="post" action="<?php echo site_url('appointment/new_appointment'); ?>">
    <input type="hidden" name="datetime"/>
    <input type="hidden" name="tech_id"/>
</form>

<script>

    $(document).ready(function () {
        $('#dateIp').datetimepicker({
            timepicker: false,
            //            defaultDate: new Date(),
            format: 'Y-m-d',
            value: '<?php echo $date; ?>',
            onChangeDateTime: function (dp, $input) {
                //                $dateParam = $input.val().replace(/-/gi,'');
                //                window.location = '<?php // echo site_url("appointment/index");                               ?>/'+$dateParam;
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

        // Attach appointments
        var date = $('#dateIp').val().replace(/-/gi, '');
        //        console.log(date);
        var appointments = getAppointments(date);

        var $appTd = [];
        for (var i = 0; i < appointments.length; i++) {
            var detail = appointments[i]['detail'];

            var hour = appointments[i]['hour'];
            var min = appointments[i]['min'];
            for (var j = 0; j < detail.length; j++) {
                var tech_id = detail[j]['staff_id'];

                var $td = $('#apptTbl').find('td[tid="' + tech_id + '"][time="' + hour + ':' + min + '"]');

                $td.append(' <a href="<?php echo site_url('appointment/detail') ?>/' + appointments[i]['id'] + '">' + detail[j]['name'] + '</a>');

                if (tech_id === '1' || tech_id === '') {
                } else {
                    $td.find('img').remove();

                    var duration = $td.attr('duration');

                    if (duration == undefined) {
                        duration = 0;
                    } else {
                        duration = parseInt(duration);

                    }
                    duration += parseInt(detail[j]['duration']);
                    $td.attr('duration', duration).addClass('appointment_time');
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

    });
</script>