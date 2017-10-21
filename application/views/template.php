<html>
    <head>
        <title> Hello World </title>
<!--        <link href="<?php echo base_url(); ?>assets/css/bootstrap-reboot.min.css"/>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-grid.min.css"/>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>-->
    </head>
    <body>
        <div id="menu">
            <li><a href="<?php echo site_url('checkin'); ?>">Check-in</a></li>
            <li><a href="<?php echo site_url('turn'); ?>">Turn</a></li>
            <!--<li><a href="#">Appointment</a></li>-->
        </div>

        <h2><?php echo date('D, d M'); ?></h2>
        <div id="main-content">
            <?php echo $content; ?>
        </div>

        <div id="footer">
            
        </div>
    </body>
</html>