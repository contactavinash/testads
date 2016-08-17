<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thank you | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> </title>
<?php $this->load->view('front/css_script');?>
</head>

<body>
<?php $this->load->view('front/header');?>

 


<section class="inner-page-sec clearfix  contacts-index-index">


  <div class="container">

      <section class="contact-section section section-on-bg">
        <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2" style="border: 1px solid rgb(204, 204, 204); box-shadow: 0px 0px 4px rgb(204, 204, 204); background: rgb(250, 250, 250) none repeat scroll 0% 0%; margin-bottom: 25px;">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
        <?php 
           $error = $this->session->flashdata('error');
           if($error!="") 
           {
            echo '<div class="alert alert-danger">
            <button data-dismiss="alert" class="close">x</button>
            <strong>Error! </strong>'.$error.'</div>';
            }
         ?>
         
        
       </div>
       </div>
        <h3 class="heading text-center"> Thank You </h3>
		<div class="bor bg-red"></div>
        
        <div class="privacy text-center" >
            <h4>Your registration is now completed Successfully!.</h4>
			<br>
              <form name="otp_send" id="otp_send" method="post" action="<?php echo base_url(); ?>otp_request">

             <div class="form-group  clearfix">
            
              <label class="">OTP  </label>
              
              <div class="col-md-12">
                <div class="col-md-2">
                </div>
                  <div class="col-md-8">
                  <input type="password" class="input-text required-entry form-control" maxlength="255" required name="otp" id="otp">
                  </div>
                <div class="col-md-4">

                </div>

              </div>
              
            </div>
           <div class="col-md-offset-5"> <input type="Submit" name="complete" id="complete" value="submit" class="btn btn-success col-md-4" ></div> 

          </form>
        
          <div class="clearfix"> </div>
            <br>
         <div class="col-md-offset-5"> <input type="submit" name="resend" id="resend" value="Resend" class="btn btn-danger col-md-4" onclick="return resend_otp('<?php echo $sms_email; ?>');"></div>
         <div class="clearfix"> </div>
            <br>
			<p>OR</p>
          <span id="resend_results"></span>

      <!--     <button type="submit" name="resend" id="resend" value="Resend" class="btn btn-primary">Resend</button> -->
			<h5>Activation mail has been sent to your email address.</h5>
			<!-- <h5>Click the activation link in your mail to activate your account</h5> -->
			           <br>
        </div>
        </div> 
        </div> 
        </section>
    </div>
</section>



<?php $this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	
?>

<?php  $this->load->view('front/js_scripts');?>

<script>
function resend_otp(id)
{
  // alert(id);
  $('#resend').html('');
  $.ajax({
    type:'POST',
    url:'<?php echo base_url(); ?>cashback/resend_otp',
    data:{"id":id},
    success:function(msg)
    {
      // alert(msg);
        $('#resend').html(msg);
    }
  });
  return true;
}
</script>

</body>
</html>
