<h2><?php echo date('D, d M'); ?></h2>
<form name="f" action="" method="post">
    <table>
        <thead>
        <th>Name</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Note</th>
        </thead>
        <tbody>
            <?php foreach ($turnList as $item) { ?>
                <tr turn_id="<?php echo $item['tid']; ?>">
                    <td><?php echo $item['name']; ?></td>
                    <?php if ($item['checkin_time'] == NULL) { ?>
                        <td><button class="startBtn">Start</button></td>
                        <td></td>
                    <?php } else if ($item['checkout_time'] == NULL) {
                        ?>
                        <td><?php echo date_format(date_create($item['checkin_time']), 'H:i:s'); ?></td>
                        <td><button class="finishBtn">Finish</button></td>
                    <?php } else { ?>

                        <td><?php echo date_format(date_create($item['checkin_time']), 'H:i:s'); ?></td>
                        <td><?php echo date_format(date_create($item['checkout_time']), 'H:i:s'); ?></td>
                    <?php } ?>
                    <td><input type="checkbox" name="half_turn"/></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <input type="hidden" name="turn_id" />
    <input type="hidden" name="half_turn" />
</form>
<script>
    $('.startBtn').click(function () {
        $tr = $(this).parents('tr');
        $tr.addClass('working');

        $('input[name=turn_id]').val($tr.attr('turn_id'));
        $('form[name=f]').attr('action', '<?php echo site_url("turn/startTurn"); ?>').submit();
    });

    $('.finishBtn').click(function () {
        $tr = $(this).parents('tr');
        $tr.removeClass('working').addClass('done');
        console.log($tr.find('input[name=half_turn]').is(':checked'));
        $('input[name=turn_id]').val($tr.attr('turn_id'));
        $('input[name=halfturn]').val($tr.find('input[name=half_turn]').is(':checked'));
        //$('form[name=f]').attr('action', '<?php // echo site_url("turn/finishTurn");  ?>').submit();
    });
</script>

