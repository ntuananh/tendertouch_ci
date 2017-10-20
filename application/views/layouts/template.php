<html>
    <head>
        <title><?php echo $title ?></title>
        <link href="http://tendertouch.local/assets/css/bootstrap.css" rel="stylesheet">
        <link href="http://tendertouch.local/assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="http://tendertouch.local/assets/css/jquery.datetimepicker.css" rel="stylesheet">
        <link href="http://tendertouch.local/assets/css/jquery-ui.css" rel="stylesheet">
        <link href="http://tendertouch.local/assets/css/myStyle.css" rel="stylesheet">

        <script type="text/javascript" src="http://tendertouch.local/assets/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://tendertouch.local/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://tendertouch.local/assets/js/jquery-ui.js"></script>
        <script type="text/javascript" src="http://tendertouch.local/assets/js/api.js"></script>
        <script type="text/javascript" src="http://tendertouch.local/assets/js/common.js"></script>

    </head>
    <body>
        <header id="header">
            <div class="navbar navbar-fixed-top navbar-default">
                <div class="navbar-inner">
                    <div class="container">
                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <!--<li class="<?php if ($activeClass == 'checkin') echo 'active'; ?>"><a href="<?php // echo site_url('checkin'); ?>">Check-in</a></li>-->
                                <!--<li class="<?php if ($activeClass == 'turn') echo 'active'; ?>"><a href="<?php // echo site_url('turn'); ?>">Turn</a></li>-->
                                <li class="<?php if ($activeClass == 'appointment') echo 'active'; ?>"><a href="<?php echo site_url('appointment'); ?>">Appointment</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container" style="padding-top:45px;height:540px">

            <div id="contents" style =""><?php echo $contents ?></div> 

    </body>

    <script type="text/javascript" src="http://tendertouch.local/assets/js/jquery.datetimepicker.full.js"></script>

</html>