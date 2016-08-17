<?php error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $admindetails[0]->homepage_title;?></title>
	<meta name="Description" content="<?php echo $admindetails[0]->meta_description;?>"/>    
    <meta name="keywords" content="<?php echo $admindetails[0]->meta_keyword;?>" />    
    <meta name="robots" CONTENT="INDEX, FOLLOW" />

<!-- Bootstrap -->
<?php $this->load->view('front/css_script_index'); ?>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
  <link rel="manifest" href="https://www.rupiyaback.com/manifest.json">
  
  <script>
    var OneSignal = OneSignal || [];

    OneSignal.push(["init", {path: "https://www.rupiyaback.com/", appId: "2b267a04-7303-11e5-b1ff-cb2b4e7ed35a"}]);
  </script>	

</head>

<body>
<div class="page">
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->
  <!-- Home Slider Block -->
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <div class="row">
	  <?php 
		$user_id = $this->session->userdata('user_id');
		if($user_id!=""){ ?>
		<div class="col-md-3 col-sm-3">
      
	<div id="magik-verticalmenu" class="block magik-verticalmenu">
		<div class="nav-title"> <span>My Account</span> </div>
   
    <div class="nav-content">
      <div class="navbar navbar-inverse">
        <div id="verticalmenu" class="verticalmenu" role="navigation">
          <div class="navbar">
            <div class="collapse navbar-collapse navbar-ex1-collapse">

            <!-- BEGIN NAV -->  
            <ul class="nav navbar-nav verticalmenu">
             <li class="parent">  <a href="<?php echo base_url(); ?>cashback/favorites"><span>Favorite Stores</span><b class="round-arrow"></b></a></li> 
             <li class="parent">  <a href="<?php echo base_url(); ?>cashback/click_history"><span>Click History</span><b class="round-arrow"></b></a> </li> 
             <li class="parent">  <a href="<?php echo base_url(); ?>cashback/my_earnings"><span>Payment History</span><b class="round-arrow"></b></a></li> 
             <li class="parent">  <a href="<?php echo base_url(); ?>cashback/refer_friends"><span>Refer A Friend</span><b class="round-arrow"></b></a> </li> 
             <li class="parent">   <a href="<?php echo base_url(); ?>cashback/add_withdraw"><span>Withdraw Money</span><b class="round-arrow"></b></a></li> 
             <li class="parent">   <a href="<?php echo base_url(); ?>cashback/myreviews"><span>My Reviews</span><b class="round-arrow"></b></a></li> 
             <li class="parent">   <a href="<?php echo base_url(); ?>cashback/myaccount"><span>Edit Profile</span><b class="round-arrow"></b></a></li> 
             <li class="parent">   <a href="<?php echo base_url(); ?>cashback/support"><span>Support</span><b class="round-arrow"></b></a></li> 
             <li class="parent">   <a href="<?php echo base_url(); ?>cashback/logout"><span>Logout</span><b class="round-arrow"></b></a></li> 
            </ul>
          </div> 
        </div> 
      </div> 
      
      </div>
      </div>
      
      </div>
      </div>
      
	  <?php } ?>
        <div class="col-lg-9 col-sm-12 col-md-8">
          <div id="rev_slider_4_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
            <div id="rev_slider_4" class="rev_slider fullwidthabanner">
              <ul>
			  <?php if($result){
				foreach($result as $imgs)
				{
					$view_img = $imgs->banner_image;
					$banner_url = $imgs->banner_url;
					$img_name = $imgs->banner_heading;
			  ?>
                <li class="black-text" data-transition="random" data-slotamount="7" data-masterspeed="1000"><img alt="banner" src="<?php echo base_url().'uploads/banners/'.$view_img; ?>" data-bgposition="left top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                </li>
			<?php } } ?>
              </ul>
              <div class="tp-bannertimer">&nbsp;</div>
            </div>
          </div>
        </div>
        
		<?php if($user_id==""){ ?>
		<div class="col-xs-12 col-sm-12 col-md-3">
          <div class="RHS-banner">
		   <?php $headerimg1 = $this->front_model->getads('Sidebar-1'); ?>
            <div class="add"> <a href="<?php echo $headerimg1->ads_url?>"> <img alt="banner-img" src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg1->ads_image?>" height="168" />
              <!--<div class="overlay"><span class="info">Learn More</div>-->
              </a></div>
			  
			<?php $headerimg2 = $this->front_model->getads('Sidebar-2'); ?>
            <div class="add"> <a href="<?php echo $headerimg2->ads_url?>"> <img alt="banner-img" src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg2->ads_image?>" height="168" />
              <!--<div class="overlay"><span class="info">Learn More</div>-->
              </a> </div>
          </div>
        </div>
		<?php } ?>
      </div>
    </div>
  </div>
  
  <!-- Store --->
  
  <section class="store-sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ma-newproductslider-container">
            <div class="ma-bestseller-sldier-title ma-title">
              <h2><span class="word1">Latest</span> <span class="word2">Stores</span></h2>
            </div>
			<?php
				$stores_list =  $this->front_model->get_top_cashback_stores_limit(20);
				if($stores_list){
			?>
            <div class="new-content padtb50">
              <ul class="owl">
			  <?php $k=0;
				$counting = count($stores_list);
				foreach($stores_list as $stores)
				{
					$affiliate_id = $stores->affiliate_id;
					$featured = $stores->featured;
					$affiliate_name = $stores->affiliate_name;
					$count_coupons = $this->front_model->count_coupons($affiliate_name);
					$get_coupons_sets = $this->front_model->get_coupons_sets($affiliate_name,2);
					if($k%3==0){
				?>	
                <li class='bestsellerproductslider-item'>
				<?php } ?>
                  <div class="item-inner">
                    <div class="ma-box-content clearfix">
						<div class="box-hidden"> <a href="<?php echo base_url(); ?>cashback/stores/<?php echo $stores->affiliate_url; ?>" class="product-image" title="<?php echo $stores->affiliate_name; ?>" ><img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $stores->affiliate_logo; ?>" alt="" class="img-responsive center-block" /></a>
                        <h4 class="text-center"><a href="<?php echo base_url(); ?>cashback/stores/<?php echo $stores->affiliate_url; ?>"> <?php $cppercentage='0%'; /* if($stores->cashback_percentage)
							{ */ 
							if($stores->affiliate_cashback_type=="Percentage"){
									$cppercentage = $stores->cashback_percentage."%";
								} else {
									$cppercentage = DEFAULT_CURRENCY." ".$stores->cashback_percentage;
								}
							echo "Up to ".$cppercentage;?>  <?php /*  }  */ ?> Cashback 
							<?php
							if(isset($count_coupons->counting) && $count_coupons->counting!=0)
							{
							?>
							& <?php echo $count_coupons->counting;?> Coupons
							<?php } ?> 
							</a></h4>
						</div>
						<div class="caption">
						  <div class="caption-content">
							<a href="<?php echo base_url(); ?>cashback/stores/<?php echo $stores->affiliate_url; ?>" class=" md-btn-danger md-btn-small"> <h4> Go to store, Get <?php echo $admindetails[0]->site_name;?></h4></a>
						  </div>
						</div>
                    </div>
				  </div>
				<?php  $k++; if($k%3==0){ ?>
                </li>
				<?php } } ?>
              </ul>
            </div>
			<?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!--- store sec ends here --->
  
  <!--- NEWSLETTER --->
  
  <section class="newsletter-bg">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="block-subscribe">
              <div class="newsletter">
                <form method="post" id="newsletter-validate-detail1">
                  <h4><span> Signup for <?php echo $admindetails[0]->site_name;?> Exclusive Offers</span></h4>
                  <input type="text" name="email" id="email" onkeypress="clears(1);" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" />
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
  
  <!--- How it Works --->
  
  <section class="howit-works">
  
  <div class="container">
    
  <div class="ma-bestseller-sldier-title ma-title">
	  <h2><span class="word1">How It</span> <span class="word2">Works</span> </h2>
	</div> 
	
	<p class="text-center pad100"><?php echo $admindetails[0]->site_name;?> is one of highest paying Indian Cashback and coupons website. Rupiyaback provide highest cashback on your shopping over and above offers, coupon provided by the store. We save your money on shopping by giving you EXTRA cashback. Just remember to go to online STORE via <?php echo $admindetails[0]->site_name;?> & shop.</p>
	
	<div class="row">
			<div class="col-md-4 col-sm-4" >
				<div class="service_single">
			<div class="service_block align_center">
			<div class="cls_num_bg"> 1 </div>
				<div class="octa_main col_center">
					<div class="octa_inner_1">
						<div class="octa_inner_2 service_icon">
							<div class="octa_content">
								<i class="fa fa-desktop fa-2x"></i> 
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="service_content">
				<h4>Browse</h4>
				<p>Browse our site and choose from 100s of retailers and exclusive offers.</p>
			</div>
			</div>
			</div>
				<div class="col-md-4 col-sm-4">
				<div class="service_single">
			<div class="service_block align_center">
			<div class="cls_num_bg"> 2 </div>
				<div class="octa_main col_center">
					<div class="octa_inner_1">
						<div class="octa_inner_2 service_icon">
							<div class="octa_content">
								<i class="fa fa-cart-plus fa-2x"></i> 
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="service_content">
				<h4>Shop</h4>
				<p>Click through to your favourite retailers and shop as usual.</p>
			</div>
		</div>
		</div>
			<div class="col-md-4 col-sm-4">
			
	<div class="service_single">
		<div class="service_block align_center">
		<div class="cls_num_bg"> 3 </div>
			<div class="octa_main col_center">
				<div class="octa_inner_1">
					<div class="octa_inner_2 service_icon">
						<div class="octa_content">
							<i class="fa fa-rupee fa-2x"></i> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="service_content">
			<h4>Get Rupiyaback</h4>
			<p>We will pay you extra cashback over and above offer, discount and we add this cashback to your earnings.</p>
		</div>
	</div>
   </div>
   </div>
   </div>
   
  </section>
  
  <!-- How it works ends here --->
  
<footer>
<?php
//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>
</footer>
</div>
<?php $this->load->view('front/js_scripts');?>

<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });

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
function clears(val)
{
	if(val==1)
		$('#email').css('border', '');
	else
		$('#news_email').css('border', '');
}    
</script> 
</body>
</html>