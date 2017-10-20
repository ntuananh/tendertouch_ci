<h2><?php echo date('D, d M'); ?></h2>
<form name="f" method="post" action="<?php echo site_url('checkin/doCheckin/'); ?>">
    <table>
        <thead>
        <th>Name</th>
        <th>Check-in</th>
        </thead>
        <tbody>
            <?php foreach ($uncheckin as $person) { ?>
                <tr sid="<?php echo $person['id']; ?>">
                    <td><?php echo $person['name']; ?></td>
                    <td><input type="button" value="check-in" class="checkinBtn"/></td>
                </tr>
            <?php } ?>

            <?php foreach ($checkedin as $person) { ?>
                <tr>
                    <td><?php echo $person['name']; ?></td>
                    <td><?php echo date_format(date_create($person['updated']), 'H:i:s'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <input type="hidden" name="sid"/>
</form>
<script>
    $('.checkinBtn').click(function () {
        $('input[name=sid]').val($(this).parents('tr').attr('sid'));
        $('form[name=f]').submit();
    });
</script>
