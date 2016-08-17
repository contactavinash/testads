<?php
$getadmindetailss = $this->front_model->getadmindetails(); 
$site_favicon = $getadmindetailss[0]->site_favicon;
?>
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>front/css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="<?php echo base_url(); ?>front/css/font-awesome.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>front/css/bootstrap-select.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>front/css/style.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/script.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()."uploads/adminpro/".$site_favicon;?>">
<link href="<?php echo base_url(); ?>front/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/wow.js"></script>
