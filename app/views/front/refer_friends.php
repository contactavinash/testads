<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - Refer Friends</title>
<?php $this->load->view('front/css_script');?>
</head>
<body>
<?php $this->load->view('front/header');?>
<!-- header ends here --->

<!--- breadcrumb sec ends here --->
<section class="inner-page-sec gap-top-20  clearfix ">
  <div class="container">
    
      
         
         <div class="row">
         
          <?php $this->load->view('front/user_menu'); ?>
         
         <div class="col-md-9">
            
<div class="acc-table-style clearfix">
        
          <div class="panel panel-primary">
            <div class="panel-body refer-frnd">
              <h4 class="clr-theme">Refer Friends & Earn  <?php echo $this->front_model->referal_percentage()?>% Cashback forever!</h4>
			  <div class="bor bg-red"></div>
				<?php
						$k = 5000;
						$earn_price = ($k*$this->front_model->referal_percentage())/100;
				?>
              <h5 class="clr-pink">Invite your friends and get <?php echo $this->front_model->	referal_percentage()?>% of their cashback earnings forever! For example, say your friend earned <span class="indianRs"><?php echo DEFAULT_CURRENCY;?> </span> 5000 cashback, you would get <span class="indianRs"><?php echo DEFAULT_CURRENCY;?> </span> <?php echo $earn_price;?> as a referral bonus from us. Imagine how much you can earn if you refer 100s of your friends to join <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>! Help your friends save and earn money for yourself also!<br>
			  <br>
                    Below is your unique referral link. When your friends click on this link and join they are automatically added to your referral network.
				</h5>
				
				
				<hr class="clearfix">
				
				<div class="box clearfix">
                <div class="form-group clearfix mar-no">
                  <div class="row">
                     <div class="col-md-3">
                   <h4 class="fnt-sz-15">Your unique referral link:</h4>
                   </div>
                    <div class="col-md-6">
					<?php $result = $this->front_model->refer_friends();
						if($result)
						{
						foreach($result as $views)
						{
					?>
                    <div class="col-md-12">
                      <input type="text" class="form-control" value="<?php echo base_url().'/cashback/register/'.$views->random_code; ?>">
					   <input type="hidden" id="random_code" value="<?php echo $views->random_code; ?>">
                    </div>
					<?php } } ?>  
					
                    </div>
                    <div class="col-md-3">
                      <p class="mar-no"><a class="btn btn-primary bor-rad-no" href="javascript:void(0);"> Friends Referred : <?php echo count($this->front_model->referral_network());?></a></p>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='login-page demo4 clearfix'>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="clearfix">
                      <h4 class="text-uppercase clr-theme mar-bot30">Invite your Email Contacts</h4>
                      <a target="_blank" href="<?php echo base_url().'HAuth/invite/Google'; ?>"><img src="<?php echo base_url();?>front/img/Gmail.png" class="center-block mar-top60"></a> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="apsl-login-networks theme-14 clearfix"> <span class="text-uppercase  mar-bot30">invite via Social Media Networks</span>
                      <div class="social-networks mar-top30">
					  
					  


						<a target="_blank" href="http://twitter.com/home?status=<?php echo base_url().'cashback/register/'.$views->random_code; ?>"><div class="apsl-icon-block icon-twitter  clearfix"> <img src="<?php echo base_url();?>front/img/twittershare.png"> </div>
                        </a> 
						<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url().'cashback/register/'.$views->random_code; ?>" ><div class="apsl-icon-block icon-facebook  clearfix"> <img src="<?php echo base_url();?>front/img/fbshare.png"> </div>
                        </a>
						<a target="_blank" href="https://plus.google.com/share?url=<?php echo base_url().'cashback/register/'.$views->random_code; ?>" ><div class="apsl-icon-block icon-google  clearfix"> <img src="<?php echo base_url();?>front/img/gooplus.png">  </div>
                        </a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="invite-email gap-top-20 clearfix">
                <h4 class="text-uppercase mar-top30 clr-theme text-center mar-bot30"><strong>Invite by Email</strong></h4>
				<div class="bor bg-red"></div>

				<div id="success" class="text-center" style="color:green;"></div>
                <form class="form col-md-8 col-md-offset-2 mar-top20">
                  <div class="form-group clearfix">
                    <input placeholder="Friends Email (Separate IDs by Comma)" class="form-control" onclick="clears(1);" id="invite_mail">
                  </div>
                  <div class="form-group clearfix">
                    <textarea class="form-control" rows="5">Hi,
					<?php echo '&#13;&#10;'; ?>
					I've been using <?php $admindetailssss = $this->front_model->getadmindetails_main(); echo $admindetailssss->site_name; ?> to save money on websites I use anyway like Flipkart, Yatra, Jabong and more. I thought this would be useful for you too. 
					<?php echo '&#13;&#10;'; ?>
					It's free to join and you can easily save <?php echo DEFAULT_CURRENCY;?> 10,000 every year. You've got nothing to lose by trying it!  
					<?php echo '&#13;&#10;'; ?>
					<?php echo '&#13;&#10;'; ?>
					Enjoy!
					<?php echo '&#13;&#10;'; ?>
					<?php
							echo $result[0]->first_name.' '.$result[0]->last_name;
							echo '&#13;&#10;';
							echo '&#13;&#10;';
						
					?></textarea>
                  </div>
                  <div class="form-group clearfix">

                    <button value="Send invites"onClick="send_mail();"  class="btn btn-primary bor-rad-no center-block" type="button" id="name_change"> Send Invites</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
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
<?php  $this->load->view('front/js_scripts');?>
<script>
//Friends Invite Mail
function send_mail()
{
	$('#name_change').html('');
	var mail = $('#invite_mail').val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	
	var emails = mail.split(',');
	var random = $('#random_code').val();
	var text = $('#mail_text').val();
	
	if(mail=='')
		$('#invite_mail').css("border","2px solid red");
	else if(mail!='')
	{
		var err=0;
		for (var i = 0; i < emails.length; i++) {
			value = emails[i];
			if(!emailReg.test(value)){
				$('#invite_mail').css("border","2px solid red");
				err=1;
				}
		}
		if(err == 0)
		{
			$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>cashback/invite_mail/",
			data: {'email':mail,'random':random,'mail_text':text},
			 beforeSend:function()
			 {
			      $('#name_change').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
			      $('#name_change').attr('disabled',true);
		     },
		      complete:function()
		      {
			      $('#name_change').html('Send Invites');
			      $('#name_change').attr('disabled',false);
		     },
			success: function()
			{
				$('#invite_mail').val('');
				$('#success').text('Mail has been Sent Successfully');
			}
		
		});
		}
	}
}
</script>
</body>
</html>