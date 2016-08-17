<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> -Welcome</title>
<?php $this->load->view('front/css_script');?>
</head>
<body>
<div class="page">
<?php $this->load->view('front/header');?>  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
           <li class="home"> <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
            <li class="category34"> <strong>My Reviews</strong> </li>
          </ul>
        </div>
        <!--col-xs-12--> 
      </div>
      <!--row--> 
    </div>
    <!--container--> 
  </div>  
  <!-- Home Slider Block -->
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <div class="row">
      <div class="col-md-3 col-sm-3">      
     <?php $this->load->view('front/menubar');?>
      </div>
        <div class="col-lg-9 col-sm-12 col-md-9">        
		<?php
				$headerimg = $this->front_model->getads('Header');
            ?>
			<a href="<?php echo $headerimg->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg->ads_image?>" class="img-responsive mar-bot" alt=""></a>
      <h4> My Reviews </h4>      
			<?php if($review){ ?>
      <div class="md-card md-card-hover md-card-overlay md-card-overlay-active mar-top pad-no mar-tb20">
				<div class="table-responsive pad20">
				<table class="table table-hover mar-no">
					<thead>
					<tr>
						<th width="20%">Store/Coupon Name</th>     
						<th width="36%">Comments </th>
						<th width="24%">Date </th>
						<th width="20%">Approval</th>
					   <!-- <th width="13%">Status</th> -->
					</tr>
					</thead>
					<tbody>	
					<?php
					 foreach($review as $row){ ?>
					<tr>		
					<?php $offer_name = $this->front_model->get_store_details_byid($row->store_id); ?>	
						<td><?php echo $offer_name->affiliate_name; ?></td> 
						<td><?php echo $row->comments; ?></td>
						<td><?php echo date('M d, Y',strtotime($row->date)); ?></td>
						<td><a href="#" class="md-btn md-btn-flat-danger">
						<?php if($row->status==1){ ?>
							<i class="fa fa-check"></i> Approved
						<?php } else { ?>
							<i class="fa fa-clock-o"></i> Pending 
						<?php }	?></a></td>
						<!--<td><a href="#" class="md-btn md-btn-flat-success"><i class="fa fa-random"></i> </a></td>-->
					</tr>
					 <?php }  ?>
					</tbody>
				</table>
				</div>	</div>
				<?php } else { ?>
				 <div class="row">
					  <div class="alert alert-danger bs-alert-old-docs">
						<center>
						  <strong>No Reviews found!</strong>
						</center>
					  </div>
					</div>
				<?php } ?>
        </div>       
      </div>
    </div>
  </div>  
  <!--- NEWSLETTER --->  
	<section class="newsletter-bg mar-no">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="block-subscribe">
              <div class="newsletter">
                <form action="" method="post" onsubmit="return false;" id="newsletter-validate-detail1">
                  <h4><span> Signup for <?php echo $admis->site_name;?> Exclusive Offers</span></h4>
                  <input type="text" name="email" id="emails" onkeypress="clears(2);" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" />
                  <button type="button" title="Subscribe" id="news_letter_submit" onClick="email_sub();" class="subscribe"><span>Subscribe</span></button>
				   <div id="msg" style="color:red;text-align:center;"></div>
                </form>
              </div>
              <!--newsletter--> 
            </div>
            <!--block-subscribe--> </div>
        </div>
      </div>
    </section>
  <footer>
<?php
//Footer
	$this->load->view('front/sub_footer');
	$this->load->view('front/site_intro');
?>
</footer>
 </div>
<?php $this->load->view('front/js_scripts');?>
<script type="text/javascript">
//Start Email subscribe
function email_sub()
{
	var email = $("#emails").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	if(!email || !emailReg.test(email))
		$('#emails').css('border', '2px solid red');
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
function clears(val)
{
	if(val==1)
		$('#invite_mail').css('border', '');
	else
		$('#emails').css('border', '');
} 
//End Email subscribe
</script>
</body>
</html>