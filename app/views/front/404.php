<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8" />
       <meta charset="utf-8" />
    <title>404 - Page Not found</title>
    <meta name="keywords" content="404 Page Not found" />
    <meta name="description" content="404 Page Not found" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Libs CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>front/404assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Template CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>front/404assets/css/style.css" rel="stylesheet" />
    <!-- Responsive CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>front/404assets/css/respons.css" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>front/404assets/img/favicons/favicon144x144.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>front/404assets/img/favicons/favicon114x114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>front/404assets/img/favicons/favicon72x72.png" />
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>front/404assets/img/favicons/favicon57x57.png" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>front/404assets/img/favicons/favicon.png" />
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

</head>
<body>

    <!-- Load page -->
    <div class="animationload">
        <div class="loader">
        </div>
    </div>
    <!-- End load page -->

    <!-- Content Wrapper -->
    <div id="wrapper">
        <div class="container" style="margin-top:-40px;">
            <!-- Switcher -->
            <div class="switcher">
                <input id="sw" type="checkbox" class="switcher-value">
                <label for="sw" class="sw_btn"></label>
                <div class="bg"></div>
                <div class="text">Turn <span class="text-l">off</span><span class="text-d">on</span><br />the light</div>
            </div>
            <!-- End Switcher -->

            <!-- Dark version -->
            <div id="dark" class="row text-center">
                <div class="info">
                    <img src="<?php echo base_url(); ?>front/404assets/img/404-dark.png" alt="404 error" />
                    <p style="color:#343F69;">The page you are looking for was moved, removed,<br />
                        renamed or might never existed.</p>
                         <a href="<?php echo base_url(); ?>" class="btn">Go Home</a>
                    <a href="<?php echo base_url(); ?>cashback/contact" class="btn btn-brown">Contact Us</a>
                </div>
            </div>
            <!-- End Dark version -->

            <!-- Light version -->
            <div id="light" class="row text-center">
                <!-- Info -->
                <div class="info">
                    <img src="<?php echo base_url(); ?>front/404assets/img/404-light.gif" alt="404 error" />
                    <!-- end Rabbit -->
                    <p>The page you are looking for was moved, removed,<br />
                        renamed or might never existed.</p>
                    <a href="<?php echo base_url(); ?>" class="btn">Go Home</a>
                    <a href="<?php echo base_url(); ?>cashback/contact" class="btn btn-brown">Contact Us</a>
                </div>
                <!-- end Info -->
            </div>
            <!-- End Light version -->

        </div>
        <!-- end container -->
    </div>
    <!-- end Content Wrapper -->


    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>front/404assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front/404assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front/404assets/js/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front/404assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front/404assets/js/scripts.js" type="text/javascript"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</body>
</html>
