
<?php
	$redirect_urlstring =  uri_string();
	if($redirect_urlstring=="")
	{
	  $redirect_urlstring = 'cashback/index';
	}
	$redirect_endcede = insep_encode($redirect_urlstring);

?>
				
				
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>

</head>

<body>
<?php $this->load->view('front/header');?>

<section class="login-sec">

<div class="container">
<h3 class="text-center text-uppercase">Contact Us</h3>
<div class="bor bg-red"></div>
    <div class="row">
	<div class="login-b content">
   

<div class="row ">
<div class="col-md-9 col-sm-9 center-block ftn padding-top-20">

           




</div>
</div>



<div class="row">
<div class="col-md-6  ftn center-block padding-top-20">
    
          
         <?php $error = $this->session->flashdata('error');
			 if($error!="") {
				echo '<div class="alert alert-danger">
				<button data-dismiss="alert" class="close">x</button>
				<strong>'.$error.'</strong></div>';
			} ?>
		<?php
			$success = $this->session->flashdata('success');
				if($success!="") {
				echo '<div class="alert alert-success">
					<button data-dismiss="alert" class="close">x</button>
					<strong>'.$success.' </strong></div>';
			} ?>
		<?php
			$atrtibute = array('role'=>'form','name'=>'contact','id'=>'contact','method'=>'post','class'=>'j-forms');
			echo form_open('cashback/contact_me',$atrtibute);
		?>
        
        <div class="fieldset">
            <h4>Contact us</h4>
            <hr>
            <div class="form-list">
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">User Name <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="text" id="u_name"  name="u_name"  maxlength="255" class="input-text required-entry form-control"  />           </div>
            
            </div>
            
             
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Email Address <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="email" id="user_email" name="user_email"  maxlength="255" class="input-text required-entry form-control"  /></div>
            
            </div>
            <div class="form-group  clearfix">
            
            <label class="col-md-4 "> Message <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><textarea name="description"  class="input-text required-entry form-control"  /></textarea></div>
            
            </div>
           
            </div>
			
            
        </div>
        <div class="buttons-set">
        
        <div class="">
        
        <div class="col-md-12">
            <p class="required">* Required Fields</p>
           
       
        
			<input type="submit" name="cantact_us" value="Send" class="btn btn-danger bor-rad-0 ">
           </div></div>
            
        
        </div>
		 <?php  echo form_close();?>
        </div>
        
        </div>
             
        
      </div>
</div>



</div>
    </div>
</div>
</section>


<!-- header ends here --->




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
	$("#contact").validate({
		rules: {
			u_name: {
				required: true
			},
			
			user_email: {
				required: true,
				email :true
			},
						
			description:{
				required: true
			},			
			
		},
		messages: {
			u_name: {
				required: "Please enter your name."                    
			},
			
			user_email: {
				required: "Please enter  your valid Emailid."
				
			},
			description: {
				required: "Please enter  description."
				
			},
				
		}
	});
});
//check email for  registration

</script>
</body>
</html>
