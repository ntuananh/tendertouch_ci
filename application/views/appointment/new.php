<?php
if (!isset($datetime)) {
    $datetime = "";
}

if (!isset($tech_id)) {
    $tech_id = "";
}

if (!isset($datetime)) {
    $datetime = "";
} else {

    $datetime = date('Y/m/d H:i', $datetime / 1000);
}
?>
<form name="f" method="post" action="<?php echo site_url('admin/appointment/create_appointment'); ?>">
    <label for="dateIp">Date</label>
    <input type="text" id="dateIp" name="dateTime"/><br>
    <label for="phoneIp">Phone</label>
    <input type="text" name="phone" id="phoneIp"/><br>
    <label>Name</label>
    <input type="text" name="name" id="nameIp"/><br>
    <div id="serviceDiv">
        <div class="serviceDiv">
            <label for="service">Service</label>
            <select name="service[]" class="service"></select> with <select name="staff[]" class="staff"></select> <br>
        </div>
        <div class="serviceDiv">
            <label for="service">Service</label>
            <select name="service[]" class="service"></select> with <select name="staff[]" class="staff"></select> <br>
        </div>
    </div>

    <textarea name="note" cols="200" rows="3" id="apptNote" placeholder="Note here!"></textarea>    <br>

    <input type="button" value="Save" id="saveBtn"/>
    <input type="button" value="Cancel" id="cancelBtn"/>
    <input type="hidden" name="customer_id" value="1"/>
    <input type="hidden" name="detail" value="1"/>
</form>
<button id="addmoreBtn">Add more</button><br>
<script>
    $(document).ready(function () {

        generateStaffSelect($('.staff'), true);
        $('select.staff').eq(0).val('<?php echo $tech_id; ?>');

        generateServiceSelect($('.service'), true);

        var logic = function (currentDateTime) {
            // 'this' is jquery object datetimepicker
            if (currentDateTime.getDay() == 7) {
                this.setOptions({
                    minTime: '11:00',
                    maxTime: '17:00'
                });
            } else {
                this.setOptions({
                    minTime: '9:00',
                    maxTime: '18:00'
                });
            }
        };

        $('#dateIp').datetimepicker({
//            onChangeDateTime: logic,
//            onShow: logic,
            step: 15,
            dayOfWeekStart: 1,
            lang: 'en',
            startDate: new Date(),
//            format: 'D, M-d H:i',

            todayButton: true,
//            defaultValue: new Date(<?php // echo $datetime;     ?>),
            value: '<?php echo $datetime; ?>',
            format: 'Y/m/d H:i',

        });

        // Add more service button
        $('#addmoreBtn').click(function () {
            $('.serviceDiv').eq(0).clone().appendTo($('#serviceDiv'));
        });

        $('#saveBtn').on('click', function () {
            
            var detail = [];
            $('.serviceDiv').each(function (index) {
                console.log($(this));
                var service_id = $(this).find('select.service').val();
                var staff_id = $(this).find('select.staff').val();
                if (service_id !== '' || staff_id !== '') {
                    detail.push({
                        service_id: service_id,
                        staff_id: staff_id
                    });
                }
            });
            
            $('input[name=detail]').val(JSON.stringify(detail));
            $('form[name=f]').submit();
        });
        
        $('#cancelBtn').on('click', function () {
            window.location = '<?php echo site_url("appointment");?>';
        });
    });

</script>
