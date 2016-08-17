<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reset Password | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<?php $this->load->view('front/css_script');?>
<style>
.error {
	color:#ff0000 !important;
	font-weight:normal !important;
}
.required_field {
	color:#ff0000 !important;
}
</style>
</head>

<body>
<?php $this->load->view('front/header');?>
<!-- header ends here --->

<section class="inner-page-sec clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title">
          <h1>Reset Password</h1>
        </div>
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
        <?php
				//form begin
				$attribute = array('role'=>'form','name'=>'reset_password','id'=>'reset_password','method'=>'post');
				echo form_open('password_reset/',$attribute);
		?>
			<input type="hidden" name="user_id" value="<?php echo $user_id;?>" id="" >
          <div class="fieldset">
            <div class="form-list">
              <label for="email_address" class="required"><em>*</em>New Password</label>
              <div class="input-box">
                <input type="password" name="email" alt="new_password" id="new_password" class="input-text required-entry validate-email" value="" />
              </div>
            </div>
			<div class="form-list">
              <label for="email_address" class="required"><em>*</em>Confirm Password </label>
              <div class="input-box">
                <input type="password" name="email" alt="confirm_password" id="confirm_password" class="input-text required-entry validate-email" value="" />
              </div>
            </div>
          <div class="buttons-set">
            <p class="required">* Required Fields</p>
			<input type="submit" name="Save" id="Save" value="Save!" class="btn btn-primary pull-left">
            <!--<button type="submit" title="Submit" class="button"><span><span>Submit</span></span></button>-->
          </div>
         <?php echo form_close();?>
      </div>
    </div>
  </div>
</section>

<!--- inner pagesec ends here --->
<?php $this->load->view('front/partners');?>

<!--- partners ebds here --->
<?php $this->load->view('front/sub_footer');

	
//Footer
	$this->load->view('front/site_intro');	
?>
<?php $this->load->view('front/js_scripts'); ?>
<script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script>
<script type="text/javascript">
/* form validation*/
 $(document).ready(function() {
         $("#reset_password").validate({
	          rules: {
				new_password: {
                    required: true,
					minlength: 6
                },
				confirm_password: {
                    required: true,
					minlength: 6,
					equalTo:'#new_password'
                }
			},
            messages: {
				new_password: {
                    required: "Please enter the password.",
					minlength: "Passwords must be minimum 6 characters."    
                },
				confirm_password: {
                    required: "Please confirm your password.",
					minlength: "Passwords must be minimum 6 characters.",
					equalTo : "Please enter the same password."
                    
                }
			}
				
        });
});
</script>
</body>
</html>
