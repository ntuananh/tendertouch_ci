<a href="<?php echo site_url('appointment/new_appointment'); ?>">New Appointment</a>
<table>
    <thead>
    <th>Time</th>
    <th>Customer</th>
    <th>Service</th>
    <th>Technician</th>
</thead>
<tbody>
    <?php foreach ($appointments as $appointment) { ?>
        <tr>
            <td><?php echo date_format(date_create($appointment['time']), 'H:i'); ?></td>
            <td><?php echo $appointment['name'] ?></td>
            <td><?php // echo $appoinment['service']               ?></td>
            <td><?php // echo $appoinment['service']               ?></td>
        </tr>
    <?php } ?>
</tbody>
</table>