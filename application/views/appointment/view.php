<form name="f" method="post" action="<?php echo site_url('appointment/edit/' . $apptId); ?>">
    <label for="dateIp">Date</label>
    <input type="text" id="dateIp" name="dateTime" disabled="disabled"/><br>
    <!--<label for="phoneIp">Phone</label>-->
    <!--<input type="text" name="phone" id="phoneIp" disabled="disabled"/><br>-->
    <label>Name</label>
    <input type="text" name="name" id="nameIp" disabled="disabled"/><br>
    <div id="serviceDiv">
        <div class="serviceDiv">
            <label for="service">Service</label>
            <select name="service[]" class="service"  disabled="disabled"></select> with <select name="staff[]" class="staff"  disabled="disabled"></select> <br>
        </div>
    </div>
    <textarea name="note" cols="200" rows="3" id="apptNote" placeholder="Note here!" disabled="disabled"></textarea>    <br>
    <input type="submit" value="Edit" id="editBtn"/>
    <input type="button" value="Cancel" id="cancelBtn"/>
    <input type="hidden" name="customer_id" value="1"/>
    <input type="hidden" name="detail" value="1"/>
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

        $('#cancelBtn').on('click', function () {
            window.location = '<?php echo site_url("appointment"); ?>';
        });

    });
</script>