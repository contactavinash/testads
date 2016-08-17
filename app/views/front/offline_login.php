<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Offline Login | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
</head>

<body>
<?php $this->load->view('front/header_off');?>


<section class="inner-page-sec clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="account-login">
          <div class="page-title">
            <h1>Login or Create an Account</h1>
          </div>
			<?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'login_form','id'=>'login_form','method'=>'post','class'=>'j-forms');				
				echo form_open('offline_chk_invalid',$attribute);
				
			?>
			<?php if(isset($invalid_login)) {
				// echo "<i><font color='#CC0000'>".$invalid_login."</font></i>";
				echo '<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">x</button>
						<strong>'.$invalid_login.' </strong></div>';			
				} ?>
				<?php
					$success = $this->session->flashdata('success');
					if($success!="") {
					echo '<div class="alert alert-success">
						<button data-dismiss="alert" class="close">x</button>
						<strong>'.$success.'</strong></div>';
		   } ?>
            <input type="hidden" value="CL5r0ynl0anhKx4F" name="form_key">
            <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="new-users">
                <div class="content">
                  <div class="account-login-title new-users-title">
                    <h2>New Customers</h2>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus velit erat, ornare sit amet urna quis, iaculis suscipit odio. Sed et nibh hendrerit, auctor libero id, venenatis augue.</p>
                </div>
              </div>
              <div class="new-users">
                <div class="buttons-set">
                  <a href="<?php echo base_url();?>cashback/register"><button class="button" title="Create an Account" type="button"><span><span>Create an Account</span></span></button></a>
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6">
              <div class="registered-users">
                <div class="content">
                  <div class="account-login-title registered-users-title">
                    <h2>Registered Customers</h2>
                  </div>
                  <p>If you have an account with us, please log in.</p>					
                  <ul class="form-list">
                    <li>
                      <label class="required" for="email"><em>*</em>Email Address</label>
                      <div class="input-box">
                        <input type="text" title="Email Address" class="input-text required-entry validate-email" id="email" value="" required name="email">
                      </div>
                    </li>
                    <li>
                      <label class="required" for="pass"><em>*</em>Password</label>
                      <div class="input-box">
                        <input type="password" title="Password" required id="pass" class="input-text required-entry validate-password" name="pwd">
                      </div>
                    </li>
                  </ul>				
                  <p class="required">* Required Fields</p>
				  
				  <div class="row gap-bottom-45"><div class="col-md-12"><a class="f-left" href="<?php echo base_url()?>/cashback/forgetpassword">Forgot Your Password?</a>
				<!--<button id="signin" name="signin" title="Login" class="button" type="submit"><span><span>Login</span></span></button>-->
				<input type="submit" class="btn btn-primary pull-left" name="signin" title="Login" id="signin" value="Login">
                  
				</div></div>
                </div>
              </div>
              <div class="registered-users">
                <div class="buttons-set"> 
                

				<?php
					$redirect_urlstring =  uri_string();
					if($redirect_urlstring=="")
					{
					  $redirect_urlstring = 'cashback/index';
					}
					$redirect_endcede = insep_encode($redirect_urlstring);
				?>
				<!-- start social buttons -->
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="social-btn facebook">
							<i class="fa fa-facebook"></i>
							<a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><button type="button">Facebook</button><a/>
						</div>
						</div>
					<div class="col-md-6 col-sm-6">
						<div class="social-btn google-plus">
							<i class="fa fa-google-plus"></i>
							<a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><button type="button">Google+</button></a>
						</div>
					</div>
				</div>
                </div>             
              </div>             
              </div>                
           </div>
            
          <?php			
			//end form
			echo form_close();
			?>
        </div>
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
<!--- footer ends here ---> 

<?php $this->load->view('front/js_scripts'); ?>
</body>
</html>
