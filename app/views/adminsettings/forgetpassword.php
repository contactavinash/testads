<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Forget Password Administrator </title>
<?php $this->load->view('adminsettings/script'); ?>
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
				$error = $this->session->flashdata('error');
				if($error!="") {
						echo '<div class="alert alert-danger">
								<button data-dismiss="alert" class="close">x</button>
								<strong>Error! </strong>'.$error.'</div>';
				} ?>
			<?php
				$success = $this->session->flashdata('success');
				if($success!="") {
						echo '<div class="alert alert-success">
								<button data-dismiss="alert" class="close">x</button>
								<strong>Success! </strong>'.$success.'</div>';
				} ?>
    <!-- BEGIN LOGIN FORM -->
     <!-- BEGIN FORGOT PASSWORD FORM -->
	<?php 
		$attr = array('role'=>'form','method'=>'post','id'=>'','class'=>'form-vertical no-padding no-margin '); 
		echo form_open('adminsettings/forgetpassword',$attr);
	?><div class="lock">
          <i class="icon-lock"></i>
      </div>
  
     <!-- <p class="center">Enter your e-mail address below to reset your password.</p>-->
      <div class="control-group">
       <h4>Administrator Forget Password</h4>
       <br>
       <br>
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span>
          <!--  <span class="add-on"><i class="icon-envelope"></i></span>-->
			<input type="email" id="forget_email" name="forget_email" required placeholder="Email"  />
          </div>
           <div class="block-hint pull-right">
                          <a href="<?php echo base_url(); ?>adminsettings" class="" id="forget-password">Back to Login?</a>
                      </div>
        </div>
        <div class="space20"></div>
      </div>
      <input type="submit" id="forget-btn" class="btn btn-block login-btn" name="forget" value="Submit" />
    <?php echo form_close(); ?><div class="space20"></div>
 <div class="block-hint pull-right">
                         <!-- <a href="<?php echo base_url(); ?>adminsettings/index" class="" id="login">Click here to login</a>-->
                      </div>        <div class="space20"></div>
    <!-- END FORGOT PASSWORD FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div id="login-copyright">
  <?php $admindeta = $this->admin_model->get_admindetails(); ?>
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