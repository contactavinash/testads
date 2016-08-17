<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<?php $admindeta = $this->admin_model->get_admindetails(); ?>

  <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  
  <title><?php echo $admin_details->site_name;?> Administrator Login</title>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<link href="<?php echo base_url(); ?>assets/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/style_responsive.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body id="login-body">
  <div class="login-header">
      <!-- BEGIN LOGO -->
      <div id="logo" class="center">
	  <?php echo anchor('adminsettings/','<img src="'.base_url().'assets/img/logo.png" alt="logo" class="center" />'); ?>
	  <!-- <img src="<?php //echo base_url(); ?>assets/img/admin_logo.png" alt="logo" class="center" />-->
      </div>
      <!-- END LOGO -->
  </div>

  <!-- BEGIN LOGIN -->
  <div id="login">
   <?php if(isset($invalid_login)) {
			// echo "<i><font color='#CC0000'>".$invalid_login."</font></i>";
			echo '<div class="alert alert-error">
					<button data-dismiss="alert" class="close">x</button>
					<strong>Error! </strong>'.$invalid_login.'</div>';			
			} ?>
			<?php
				$success = $this->session->flashdata('success');
				if($success!="") {
						echo '<div class="alert alert-success">
								<button data-dismiss="alert" class="close">x</button>
								<strong>Success! </strong>'.$success.'</div>';
				} ?>
    <!-- BEGIN LOGIN FORM -->
    <?php $form_attribute = array('role'=>'form','method'=>'post','id'=>'loginform','class'=>'form-vertical no-padding no-margin'); 
		   echo form_open('adminsettings/logincheck',$form_attribute); ?>
      <div class="lock">
          <i class="icon-lock"></i>
      </div>
      <div class="control-wrap">
          <h4><?php echo $admindeta->site_name;?> Administrator Login</h4>
		  
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-user"></i></span>
					  <input id="input-username" type="text" name="username" required placeholder="Username" />
                  </div>
				  <div><font color="#CC0000"><?php echo form_error('username'); ?></font></div>
              </div>
          </div>
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-key"></i></span>
					  <input id="input-password" type="password" name="password" required placeholder="Password" />
                  </div>
				  <div><font color="#CC0000"><?php echo form_error('password'); ?></font></div>
                  <div class="mtop10">
                      <!--<div class="block-hint pull-left small">
                          <input type="checkbox" id=""> Remember Me
                      </div>-->
                      <div class="block-hint pull-right">
                          <a href="<?php echo base_url(); ?>adminsettings/forgetpassword" class="" id="forget-password">Forgot Password?</a>
                      </div>
                  </div>

                  <div class="clearfix space5"></div>
              </div>
          </div>
      </div>
      <input type="submit" id="login-btn" class="btn btn-block login-btn" name="signin" value="Login" />
    <?php echo form_close(); ?>
    <!-- END LOGIN FORM -->        
    <!-- BEGIN FORGOT PASSWORD FORM -->
	<?php 
		$attr = array('role'=>'form','method'=>'post','id'=>'forgotform','class'=>'form-vertical no-padding no-margin hide'); 
		echo form_open('adminsettings/forgetpassword',$attr);
	?>
    <form id="forgotform" class="form-vertical no-padding no-margin hide" method="post" action="">
      <p class="center">Enter your e-mail address below to reset your password.</p>
      <div class="control-group">
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
			<input type="text" id="input-email" name="forget_email" required email placeholder="Email"  />
          </div>
        </div>
        <div class="space20"></div>
      </div>
      <input type="submit" id="forget-btn" class="btn btn-block login-btn" name="forget" value="Submit" />
    </form>
    <!-- END FORGOT PASSWORD FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div id="login-copyright">
     	<?php echo date('Y')?> &copy; <?php echo $admindeta->site_name;?> Admin 
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>