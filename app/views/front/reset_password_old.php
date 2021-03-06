<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>

    <!-- Bootstrap -->
     <?php $this->load->view('front/css_script');?>	   
    <!-- tabs -->
    
<style>
.error
{
	color:#ff0000;
}
.required_field
{
 color:#ff0000;
}
</style>
    
</head>

<body>
<!-- header -->
  <?php $this->load->view('front/header');?>
<!-- Header ends here -->

<div class="wrap-top">

<div id="content">

  <div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
				<li class="">Reset Password</li>
			  </ul>
			</div>
			<!--col-xs-12--> 
		  </div>
		  <!--row--> 
		</div>
		<!--container--> 
	</div>
	  <section class="inner-page">
<div class="container">

<section class="body-sign">
			<div class="center-sign">
				
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Reset Password</h2>
					</div>
					
					<div class="panel-body">
					<?php
					
					 //begin form
						$attribute = array('role'=>'form','name'=>'reset_password','id'=>'reset_password','method'=>'post');
						echo form_open('cashback/reset_password/',$attribute);
						
					?>
						<div class="form-group mb-lg">
													
								<label>New Password <span class="required_field">*</span></label>
								<div class="input-group input-group-icon">
									<input type="password" class="form-control input-lg" name="new_password"  id="new_password"autocomplete="off" >
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>
							<!--<input type="hidden" name="user_id" id="user_id" value="">
							<input type="hidden" name="email_id" id="email_id" value="">-->
							
							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left"> Confirm Password <span class="required_field">*</span></label>
								</div>
								<div class="input-group input-group-icon">
									<input type="password" class="form-control input-lg" name="confirm_password"  id="confirm_password" autocomplete="off" >
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<!--<input type="checkbox" name="rememberme" id="RememberMe">
										<label for="RememberMe">Remember Me</label>-->
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<!--<button class="btn btn-danger hidden-xs pop" type="submit" name="signin">Sign In</button>-->
									<center><input type="submit"  class="md-btn md-btn-danger" name="Save" id="Save" value="Save"></center>
									<!--<button class="btn btn-block btn-lg visible-xs mt-lg btn-blue pop" type="submit" name="signin" >Sign In</button>-->
								</div>
							</div>

							<!--<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<p class="text-center">Don't have an account yet? 
							<?php
								 $attributes = array('class'=>'btn btn-blue btn-sm pop');
								echo anchor('cashback/register','Sign Up!',$attributes);?>
							</p>-->
						<?php
						
						//end form
						echo form_close();
						?>
					</div>
				</div>

			</div>
		</section>

</div>
</section>
</div>

</div>
<!-- footer -->
<?php $this->load->view('front/site_intro');?>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>front/js/bootstrap.min.js"></script>
    
  
    
 <!-- Slider -->
 
<!-- Scripts queries -->
<?php $this->load->view('front/js_scripts');?>	  
<script src="<?php echo base_url();?>front/js/jquery.min.js"></script>
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

<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>

</body>
</html>
