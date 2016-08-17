<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - Contact Us</title>
<?php $this->load->view('front/css_script');
 $admin = $admindetails[0];?>
</head>

<body>
<?php
	$s = str_replace('<br>',',',$admin->address);
	$prepAddr = str_replace(' ','+',$s);

	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($prepAddr).'&sensor=false');
	$geo = json_decode($geocode, true);


	if ($geo['status'] = 'OK') {
		@$lat = $geo['results'][0]['geometry']['location']['lat'];
		@$long = $geo['results'][0]['geometry']['location']['lng'];
	}
?>
<?php $this->load->view('front/header');?>
<!-- header ends here --->



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec clearfix  contacts-index-index">


  <div class="container">
    <div class="row">
      <div class="col-md-12">
       
          <div class="page-title">
            <h1>Contact Us</h1>
          </div>
         <?php
			$success = $this->session->flashdata('success');
			if($success) {
					echo '<div class="alert alert-success">
							<button data-dismiss="alert" class="close">&times;</button>
							<strong>Success! </strong>'.$success.'</div>';
			} ?>
			<?php
			$attribute = array('role'=>'form','method'=>'post','id'=>'contact-form','class'=>'contact-form','novalidate'=>'novalidate','onSubmit'=>'return fillall();'); 
			echo form_open('cashback/contact_form',$attribute);
		?>
	<div class="contact-content row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			    <h3 class="page-subheading">Get in Touch</h3>
				
				<div class="form-list ">
				
					<label for="name" class="required"><em>*</em>Your name</label>
					<div class="input-box">
						<input name="name"  required="" minlength="2" placeholder="Your name" name="name" id="name"  aria-required="true" onClick="clears(2);" class="input-text required-entry" type="text" />
					</div>
				
				
					<label for="email" class="required"><em>*</em>Email address</label>
					<div class="input-box">
						<input required placeholder="Your email address" name="email" id="email" aria-required="true" onClick="clears(3);" class="input-text required-entry validate-email" type="email" />
					</div>
				
				
					<label for="telephone">Your message</label>
					<div class="input-box">
						<textarea required rows="12" placeholder="Enter your message" name="message" id="message" class="required-entry input-text" aria-required="true" onClick="clears(4);"></textarea>
					</div>
					<!--<div class="input-box">
						<button class="btn btn-block btn-blue md-btn md-btn-danger" type="submit">Send Message</button>
					</div>	-->			
				</div>	
			
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="map-conttact">
				<h3 class="page-subheading">Information</h3>
				<?php 
					$cms_Details = $this->front_model->cms_content('about-us');

					 $big=  $cms_Details[0]->cms_content;
					echo $small = substr($big, 0, 600);
				?>
				<br/>
				<ul class="store_info">
					<li><i class="fa fa-home"></i><?php echo $admin->address;?></li>
					<li><i class="fa fa-phone"></i><span><?php echo $admin->contact_number;?></span></li>
					<!--<li><i class="fa fa-phone"></i><span>+ 020.566.6666</span></li>-->
					<li><i class="fa fa-envelope"></i>Email: <span><a href="mailto:suport@companyname.com"><?php echo $admin->admin_email;?></a></span></li>
				</ul> 
			</div>
		</div>
		<div class="buttons-set buttons-set-contact col-md-12">
			<p class="required">* Required Fields</p>
			<input type="text" name="hideit" id="hideit" value="" style="display:none !important;" />
			<button type="submit" title="Submit" class="button"><span><span>Send Message</span></span></button>
		</div>
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
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
<script>
function clears(val)
{
	if(val==1)
		$('#invite_mail').css('border', '');
	if(val==2)
		$('#name').css('border', '');
	if(val==3)
		$('#email').css('border', '');
	if(val==4)
		$('#message').css('border', '');		
	else
		$('#news_email').css('border', '');
} 

//End Email subscribe

//Form validation

function fillall()
{
	var name = $('#name').val();
	var email = $('#email').val();
	var msg = $('#message').val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	if(name=='')
	{	
		$('#name').css("border","1px solid red");
		return false;
	}	
	if(email=='' || !emailReg.test(email))
	{	
		$('#email').css("border","1px solid red");
		return false;
	}	
	if(msg=='')
	{	
		$('#message').css('border', '1px solid red');
		return false;
	}	
}

</script>
</body>
</html>
