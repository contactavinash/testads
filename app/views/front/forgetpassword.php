<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forget Password | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
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


<section class="login-sec">

<div class="container">
<h3 class="text-center text-uppercase">Forgot Your Password? </h3>
<div class="bor bg-red"></div>
    <div class="row">
	<div class="login-b content">
   

<h4 class="text-center">Reset your password here</h4>




<div class="row">
<div class="col-md-5 col-sm-5 ftn center-block padding-top-20">
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
				$attributes = array('role'=>'form','name'=>'forget_password','id'=>'forget_password','method'=>'post');
					echo form_open('forgetpassword/',$attributes);
		?>
  <div class="form-group form-list">
  <label class="required" for="email_address"><em>*</em>Email Address</label>
    <input type="text" name="email" alt="email" id="email" class="input-text required-entry validate-email form-control" value="<?php echo base64_decode($usermail); ?>" />
  </div>
  
  <div class="form-group form-list clear">
  
   <label for="email_address" class="required"><em>*</em>Security Code</label>
			 <div class="col-md-4">
					<?php
							$a = rand(1000,9999);
							$this->session->set_userdata('sess_captcha_code_forgetp',$a);
							$vals = array(
								'word' => $a,
								'img_width' => '120',
								'img_height' => 36
							);
							$cap = create_captcha($vals);
							echo $cap['image'];
					?>
			</div>
			 <div class="input-box">			 
			 <input type="text" class="input-text form-control" id="chk" name="chk"  required><span class="md-input-bar"></span>
				
			 </div>
             
 
  </div>
  
  
 
  
  <div class="">
  
 <div class="buttons-set">
            <p class="required">* Required Fields</p>
          
          </div>
  </div>
  <br/>
<div class="row">
<div class="col-md-12 ne-b-3">
 <center> 
 <input type="submit" name="reset" id="reset" value="Submit" class="btn btn-danger bor-rad-0 ">
 </center>
  </div>
 <div class="col-md-6 padding-top-10"> </div>
  </div>

 <?php echo form_close();?>
</div>
</div>



</div>
    </div>
</div>
</section>
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
         $("#forget_password").validate({
	          rules: {
				email: {
                     required: true,
						email :true
                },			
				chk :{
					required: true		
				}				
            },
            messages: {
				email: {
                   required: "Please enter  your valid Emailid."                  
                },			
				chk :{
					required: "Please enter the CAPTCHA code."
				}
			}
				
        });
});
</script>
</body>
</html>
