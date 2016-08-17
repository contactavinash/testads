<?php 
// echo '<pre>';
// print_r($user_contacts);
// exit;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - Refer Friends</title>

   <!-- Bootstrap -->
     <?php $this->load->view('front/css_script');?>	   
    <!-- tabs -->
    
</head>

<body>
<!-- Header -->

<?php $this->load->view('front/header') ?>

	<div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
				<li class=""> <strong>Refer Friends</strong> </li>
			  </ul>
			</div>
			<!--col-xs-12--> 
		  </div>
		  <!--row--> 
		</div>
		<!--container--> 
	</div>
	
	<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
        <div class="row" id="page-user-profile">
		  <?php $this->load->view('front/user_menu'); ?>
			 <!--<div class="col-md-3 col-sm-3"> -->    
			   <!-- BEGIN NAV -->  
				<?php //$this->load->view('front/menubar'); ?>   
			<!--</div> -->
          <div class="col-lg-9 col-sm-12 col-md-9">
		  <div class="md-card md-card-hover md-card-overlay md-card-overlay-active mar-top pad-no mar-tb20">
            <div id="mainContent" class="pad20">
            <div class="row">
              
              <div class="col-md-12">

                <div class="tab-content" id="generalTabContent">
                  
                  <div class="row">
                  
                  <div class="col-md-12">
                  
                  <h3 class="mar-bot20"> Refer Friends </h3>
                  
                  <p>Below is your unique referral link. When your friends click on this link and join they are automatically added to your referral network.</p>
                  
                  <div class="newsletter-bg pad clearfix">
                  
                  <div class="row">
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  
                   <h4 class="clr-wht fnt-sz-15">Your unique referral link:</h4>
                  
                  </div>
                  
                  <div class="col-md-5 col-sm-5 col-xs-12">
                <?php $result = $this->front_model->refer_friends();
				if($result)
				{
					foreach($result as $views)
					{
				?>
				<input type="text" class="form-control" value="<?php echo base_url().'cashback/register/'.$views->random_code; ?>">
				<input type="hidden" id="random_code" value="<?php echo $views->random_code; ?>">
                <?php }
				}?>  
                  </div>
                  
                  <div class="col-md-3 col-sm-3 col-xs-12">
                  
                  <h4 class="clr-wht fnt-sz-15"><strong>Friends referred: <?php echo count($this->front_model->referral_network());?></strong></h4>
                  
                  </div>
                  
                  </div>
                  
                  </div>
                  
                  <div class="row">
                  
                  <div class="col-md-12">
                  <div class="fw inviter">
					<h3 class="text-center">Import contacts from email or social media</h3>
					<p class="text-center">Personal details are not saved and all information entered is secure and encrypted</p>
					<p id="error" class="text-center" style="color:red;"></p><p id="success" class="text-center"></p>
						<ul class="fl fw">
						<div class="checkbox">
							<label>
							  <input type="checkbox" name="chech" title="Select/Deselect all" id="" name="toggle_all" onClick="selectAll(this)" class="fl">
								<strong>Select/Deselect all Email</strong>
							</label>
						</div>
							<!--<li class="fl"><input type="checkbox" name="chech" title="Select/Deselect all" id="" name="toggle_all" onClick="selectAll(this)" class="fl"></li>-->
							<!--<li class="fl txt"><strong>Name</strong></li>-->
							<!--<li class="fl txt"><strong>Email</strong></li>-->
						</ul>
							<div class="fl fw mails_list">
								<?php
								if($user_contacts)
								{ $cont = 0;
									foreach($user_contacts as $views)
									{ 
								?>
							
							<?php
								if($cont%2==0){
							?>
							<ul class="fl fw">
							<div class="row">
								<?php  } ?>
								<div class="col-md-6 col-sm-6">
									<div class="checkbox">
										  <label>
										   <input type="checkbox" class="fl" value="<?php echo $views->email; ?>" id="check" name="email[]" >
											<?php echo $views->email; ?>
										  </label>
									</div>
								</div>
								<?php $cont++;
								if($cont%2==0){
								?>
							</div>
							</ul>
							<?php } ?>
								<!-- <li class="fl"><input type="checkbox" class="fl" value="<?php echo $views->displayName; ?>" id="check" name="email[]" ></li>-->
								 <!--<li class="fl txt"><?php echo $views->displayName; ?></li>-->
								<!-- <li class="fl txt"><?php echo $views->email; ?></li>-->
								<?php } } ?>
							</div>
				<textarea rows="5" class="form-control" id="mail_text" readonly style="display:none;">Hi,
<?php echo '&#13;&#10;'; ?>
I've been using <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> to save money on websites I use anyway like Flipkart, Yatra, Jabong and more. I thought this would be useful for you too. 
<?php echo '&#13;&#10;'; ?>
It's free to join and you can easily save <?php echo DEFAULT_CURRENCY;?> 10,000 every year. You've got nothing to lose by trying it!  
<?php echo '&#13;&#10;'; ?>
<?php echo '&#13;&#10;'; ?>
Enjoy!
<?php 
if($result)
{
	foreach($result as $views)
	{ 
		echo $views->first_name.' '.$views->last_name;
		echo '&#13;&#10;';
		echo '&#13;&#10;';
		echo $views->email;
	} 
}
else
{
	echo "No results Found";
}
?>
</textarea>
                <hr><input type="submit" value="Send invites" onClick="send_mail();" name="send" class="fl md-btn md-btn-danger pop" id='invites'>
				<div id='loader' style="display:none"> <img src="<?php echo base_url(); ?>uploads/adminpro/6782loading.gif" /></div>
                   
    </div>
    
    </div>
                  
                  </div>
                  
                  </div>
                  
                  </div>
                  
                </div>
                <div class="panel-group responsive visible-xs visible-sm" id="collapse-undefined">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-undefined" href="#collapse-tab-activity"><i class="fa fa-bolt"></i>&nbsp;
                        Activity</a></h4>
                    </div>
                    <div id="collapse-tab-activity" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body"></div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-undefined" href="#collapse-tab-edit"><i class="fa fa-edit"></i>&nbsp;
                        Edit Profile</a></h4>
                    </div>
                    <div id="collapse-tab-edit" class="panel-collapse collapse in" style="">
                      <div class="panel-body"></div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-undefined" href="#collapse-tab-messages"><i class="fa fa-envelope-o"></i>&nbsp;
                        Messages</a></h4>
                    </div>
                    <div id="collapse-tab-messages" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div> </div>
    </div>
    </div>


<footer style="margin-top:25px;">
<?php

//Footer
	$this->load->view('front/site_intro');	
	$this->load->view('front/sub_footer');	

?>
</footer>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  
  <?php $this->load->view('front/js_scripts');?>

<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
margin: 1,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: true
},
600: {
items: 2,
nav: true
},
1150: {
items: 4,
nav: true,
loop: false,
margin:0
}
}
})
})
</script> 
<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });

//Start Email subscribe

function email_sub()
{
	var email = $("#email").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	if(!email || !emailReg.test(email))
		$('#email').css('border', '2px solid red');
	else
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cashback/email_subscribe/",
			data: {'email':email},
			success: function(msg)
			{
				if(msg==1)
				{
					$('#msg').text('Activated Successfully');
					$('#email').css('border', '');
				}
				else
				{
					$('#msg').text('Already Activated');
					$('#email').css('border', '');
				}	
			}
		});
	}	
}
/*function email_news()
{
	var email = $("#news_email").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	if(!email || !emailReg.test(email))
	{
		$('#news_email').css('border', '2px solid red');
	}	
	else
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cashback/email_subscribe/",
			data: {'email':email},
			success: function(msg)
			{
				if(msg==1)
				{
					$('#new_msg').text('Activated Successfully');
					$('#news_email').css('border', '');
				}
				else
				{
					$('#new_msg').text('Already Activated');
					$('#news_email').css('border', '');
				}	
			}
		});
	}	
}*/

function clears(val)
{
	if(val==1)
		$('#invite_mail').css('border', '');
	else
		$('#news_email').css('border', '');
} 

//End Email subscribe

//Friends Invite Mail
function send_mail()
{
	 var random = $('#random_code').val();
     var text = $('#mail_text').val();
	 var result = "";
     $('input[type=checkbox]').each(function (e) {
         if ($(this).is(':checked'))
		 result = result + $(this).val() + ", ";
     });
	if(result == '')
		$('#error').text('No Email Selected');
	else
	{	
		$.ajax({
		type: "post",
		url: "<?php echo base_url(); ?>cashback/invite_mail/",
		data: {'email':result,'random':random,'mail_text':text},
		beforeSend: function() {
        $('#loader').show();
		$('#invites').hide();
        
    },
		success: function()
		{
			$(':checkbox:checked').removeAttr('checked');
			$('#success').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong>Mail Sent Successfully</strong></div>');
			$("html, body").animate({ scrollTop: 0 }, "fast");
			window.setTimeout(function(){
				<?php $this->session->set_userdata('success_invited','Mail Sent Successfully'); ?>
				window.location.href = "<?php echo base_url();?>cashback/refer_friends";
			}, 600);
			
		}
		});
	}	
}

function MyPopUpWin(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2",
    "status=no,height=" + height + ",width=" + width + ",resizable=yes,left="
    + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY="
    + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}

function selectAll(source) {
		checkboxes = document.getElementsByName('email[]');
		var n=checkboxes.length;
		//alert(n);
		for(var i=0;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
	}
   
</script>
</body>
</html>