<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Welcome</title>


<link href="<?php echo base_url(); ?>assets_new/css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets_new/fonts/css/font-awesome.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets_new/css/style.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets_new/css/owl.carousel.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
  <div class="near_gray_bg">
    <div class="container">
      <div class="row  col-md-offset-2">
        <div class="col-md-9 col-sm-9">
         <div class="cls_gray_bg_i mar-top20">
      <div class="row">
      <div class="col-md-3">
      <div class="mar-top20"> 
        <a href="<?php echo base_url(); ?>cashback/coupons">
        <button type="button" value="submit" class="btn btn-danger bor-rad-0 cls_footer_btn"> Go back </button>
      </a>
      </div>
      </div>

      
      
      <div class="col-md-6">
     <div align="center" >
      <a href="#"><img src="assets/images/flipcart.jpg" alt="">
      </a>
    </div> 
      </div>
      <div class="col-md-3">
      <!-- <div class="mar-top20"> 
        <button type="button" value="submit" class="btn btn-danger  center-block bor-rad-0 cls_footer_btn"> More dealss </button>
      </div> -->
      
      </div>
      </div>
      
            <hr><p>&nbsp; </p>

            <?php
        $affid =  $store_details->affiliate_id;
        foreach($all_store_coupons as $coupons)
        {
          $coupon_id = $coupons->coupon_id;
          $expiry_date = $coupons->expiry_date;

          $exp = date('m/d/Y',strtotime($expiry_date));
          
          $date = DateTime::createFromFormat('m/d/Y', date('m/d/Y'));
          $date1 = date_create($date->format('Y-m-d'));
          
          $date = DateTime::createFromFormat('m/d/Y', $exp);
          $date2 = date_create($date->format('Y-m-d'));
          
          $diff=date_diff($date1,$date2);
          $coupondate =  $diff->format("%a days");
        }     
    ?>

            
            <h4 align="center">You're about to visit</h4>
            <center><h2 class=" text-uppercase clr-theme"><?php echo $store_details->affiliate_name;?></h2>  </center>   
      <hr>          
              <div class="desc std mar-top30 mar-bot"> <center>Your visit has been recorded. The cashback from any purchase(s) will soon show in your account.</center>
<p>&nbsp; </p>
<div class="clearfix">

                <?php
          if($coupons->type!='Promotion')
          {
          ?>
                  <div class="col-md-6 col-sm-6 col-xs-6 pad-no">
                    <button class="btn cls_green_btn btn-block" style="font-size: 22px; padding: 15px 10px; line-height: 31px; height: 50px;" type="button"><?php echo $store_details->affiliate_name;?></button>
                    <div class="clearfix"> </div>
                  </div>

                  <?php
            }
            else
            {
              ?>
              <a class="btn btn-danger" href="<?php echo $store_details->affiliate_url;?>"> Continue shopping at <?php echo $store_details->affiliate_url;?> for more great offers </a>
             <?php
            }
            ?>

            <?php
          if($coupons->type!='Promotion')
          {
          ?>

                  <div class="col-md-6 col-sm-6 col-xs-6  pad-no">
                    <button class="btn cls_org_btn  btn-block"  style="font-size: 22px; padding: 15px 10px; line-height: 31px; height: 50px;" type="button">  <?php echo $coupons->code;?></button>
                    <div class="clearfix"> </div>
                  </div>

           <?php
          }else{
          ?>

            <div style="display: block;" class="clr-theme voucher-code display-none">
            

            <center><b><p>Deal Activated. Please visit <?php echo $store_details->affiliate_name;?> to avail the offer.</p>
            <h2><a href="<?php echo $store_details->affiliate_url;?>"><?php echo $store_details->affiliate_name;?></a></h2></b></center>
             </div>
          <?php
          }
         ?>




          </div>

                
              <!--   <p align="center" class=" mar-top">since you chose 'continue without cashback' we won't be to credit you with any cashback amount. Sign-in or join ADS to earn estra cashback every time you shop online through us!</p> -->
                
                <p>&nbsp;</p>
                
                <div class="cls_gray_bg_i" align="center" style="background:#eee">
              <!--  <h4>Flat 20% off on prescription medicines + additional 240 cashback from us</h4> -->


<h5><?php if($store_details->cashback_percentage!="")
      {
        if($store_details->affiliate_cashback_type=="Percentage")
        {
          $cppercentage = $store_details->cashback_percentage."%";
        }
        else
        {
          $cppercentage = "Rs. ".$store_details->cashback_percentage;
        } 
        
        if($coupons->cashback_description=='')
        {
          $admindetails = $this->front_model->getadmindetails_main();
          echo " + Get additional upto ".$cppercentage." Cashback from ".$admindetails->site_name;
        }
        else
        {
          
          echo " + ".$coupons->cashback_description;
        }
      }
      else
      {     
        if($coupons->cashback_description!='')
        {
          echo " + ".$coupons->cashback_description;
        }
      }
        //minimum_cashback
        
      ?></h5>
                </div>
      
      </div>
      </div>
        
        
        
      </div>
      


      
    </div>
  </div>
  
  
  
  
  
  

</div>
<?php $this->load->view('front/sub_footer');

  
//Footer
  $this->load->view('front/site_intro');  
?>


<?php  $this->load->view('front/js_scripts');?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 

<script src="<?php echo base_url(); ?>assets_new/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets_new/js/owl.carousel.js"></script> 
<script type="text/javascript">
	var owl = jQuery('.owl-carousela');
	owl.owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:15000,
    autoplayHoverPause:true,
    responsive: {
	0: {
	items:2,
	nav: true
	},
	600: {
	items: 3,
	nav: true
	},
	768: {
	items:4,
	nav: true
	},
	1024: {
	items: 6,
	nav: true,
	loop: true,
	margin:0
	}
	}
	});
</script>

<script type="text/javascript">
	var owl = jQuery('.owl-carousel');
	owl.owlCarousel({
    loop:true,
    margin:10,
    autoplay:false,
    autoplayTimeout:15000,
    autoplayHoverPause:true,
    responsive: {
	0: {
	items:2,
	nav: true
	},
	600: {
	items: 3,
	nav: true
	},
	768: {
	items:4,
	nav: true
	},
	1024: {
	items: 4,
	nav: true,
	loop: true,
	margin:0
	}
	}
	});
	
	/**
* Project: TT Menu - Vertical Horizontal Bootstrap Mega Menu
* Author: Trending Templates Team
* Author URI: www.trendingtemplates.com
* Dependencies: Bootstrap's mega menu plugin
* A professional Bootstrap mega menu plugin with tons of options.
*/

(function($) {
	$(".hovermenu .dropdown").hover(
		function() { $(this).addClass('open') },
		function() { $(this).removeClass('open') }
	);
  $('.verticalmenu .dropdown').click('show.bs.dropdown', function(e){
    var $dropdown = $(this).find('.dropdown-menu');
      var orig_margin_top = parseInt("1", 10);
      $dropdown.css({'margin-left': (orig_margin_top + 65) + 'px', opacity: 0}).animate({'margin-left': orig_margin_top + 'px', opacity: 1}, 420, function(){
         $(this).css({'margin-left':''});
    });
  });

})(jQuery);

</script>

<script>
$("#menu_inner").hover(function(){
	//alert('mm');
    $('.flyout').removeClass('hiddenf');
},function(){
    //$('.flyout').addClass('hidden');
});

$("#vertical").hover(function(){
	//alert('mm');
    $('.flyout').removeClass('hiddenf');
},function(){
    $('.flyout').addClass('hiddenf');
});
$('.more_off_coupon').hover(function(){
	$('#'+$(this).attr('custom')).removeClass('hiddenf_more');
	},function(){
   $('#'+$(this).attr('custom')).addClass('hiddenf_more');
});

</script>

</body>
