<form name="f" method="post" action="<?php echo site_url('appointment/update'); ?>">
    <div><label><input type="checkbox" name="cancel"/>Cancel</label></div>
    <label for="dateIp">Date</label>
    <input type="text" id="dateIp" name="dateTime"/><br>
    <label for="phoneIp">Phone</label>
    <input type="text" name="phone" id="phoneIp" disabled="disabled"/><br>
    <label>Name</label>
    <input type="text" name="name" id="nameIp" disabled="disabled"/><br>
    <div id="serviceDiv">
        <div class="serviceDiv">
            <label for="service">Service</label>
            <select name="service[]" class="service"></select> with <select name="staff[]" class="staff"></select> <br>
        </div>
    </div>
    <textarea name="note" cols="200" rows="3" id="apptNote" placeholder="Note here!"></textarea>    <br>
    <input type="submit" value="Update" id="updateBtn"/>
    <input type="button" value="Cancel" id="cancelBtn"/>
    <input type="hidden" name="customer_id" value="1"/>
    <input type="hidden" name="apptId" value="<?php echo $apptId; ?>"/>
</form>
<script>
    $(document).ready(function () {

        generateStaffSelect($('.staff'), true);
        generateServiceSelect($('.service'), true);

        var data = getDetailAppointment(<?php echo $apptId; ?>);
        $('#dateIp').val(data['time']);
        $('#phoneIp').val(data['name']);
        $('#nameIp').val(data['phone']);
        $('#apptNote').val(data['note']);

        for (var i = 0; i < data['detail'].length - 1; i++) {
            $('.serviceDiv').eq(0).clone().appendTo($('#serviceDiv'));
        }
        $('.serviceDiv').each(function (i, e) {
            $(this).find('select.service').val(data['detail'][i]['service_id']);
            $(this).find('select.staff').val(data['detail'][i]['staff_id']);
        });

        $('#dateIp').datetimepicker({
            step: 15,
            dayOfWeekStart: 1,
            lang: 'en',
            todayButton: true,
            value: data['time'],
            format: 'Y/m/d H:i',
//            minTime: '09:00',
//            maxTime: '18:00'
        });

        $('input[name=cancel]').on('change', function () {
            if ($(this).is(':checked')) {
                $('#dateIp').attr('disabled', true);
                $('select').attr('disabled', true);
                $('#apptNote').attr('disabled', true);
            } else {
                $('#dateIp').attr('disabled', false);
                $('select').attr('disabled', false);
                $('#apptNote').attr('disabled', false);
            }
        });
        
        $('#cancelBtn').on('click', function(){
           window.location = '<?php echo site_url("appointment");?>';
        });

    });
</script>