<?php $admindetailss = $this->front_model->getadmindetails(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo $admindetailss[0]->homepage_title;?></title>

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

<?php $this->load->view('front/header');?>

<div class="wrapper">
  <div class="" style="background:#f9f9f9;">
    <div class="container">
      <div class="row  col-md-offset-2">
        <div class="col-md-9 col-sm-9 ">
         <div class="cls_gray_bg_i mar-top20 coupons-code-log-area">
      <div class="row">
      <div class="col-md-3">
      <div class="mar-top20"> 
         <div align="center" >
			 <?php $uri = $this->uri->segment(4); ?>
     <!--  <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."uploads/adminpro/".$admindetailss[0]->site_logo;?>" alt="">
      </a> -->
         <?php if($uri=='coupons')
         { ?>
       <a href="<?php echo base_url(); ?>coupons">
         <button type="button" value="submit" class="btn btn-danger bor-rad-0 cls_footer_btn"> Go back </button>
         </a>
      <?php } else{ ?>
         <a href="<?php echo base_url(); ?>stores/<?php echo $store_details->affiliate_url; ?>">
         <button type="button" value="submit" class="btn btn-danger bor-rad-0 cls_footer_btn"> Go back </button>
         </a>

      <?php } ?>
    </div> 
      </a>
      </div>
      </div>
      
      <div class="col-md-6">
     <div align="center" class="mar-top">
      <?php 
         if($store_details->affiliate_logo!='')
        {
          $img_url =base_url().'uploads/affiliates/'.$store_details->affiliate_logo;
        }
        else{
          $img_url =base_url().'front/img/rsz_default.jpg';
        }
    
       ?>
      <a href="<?php echo base_url(); ?>stores/<?php echo $store_details->affiliate_url; ?>">
        <img src="<?php echo $img_url; ?>" alt="" style="height:100px;width:100px;">
      </a> 
    </div>  
      </div>
     
       <div class="col-md-3">
      <div class="mar-top20"> 
         <a href="<?php echo base_url(); ?>stores/<?php echo $store_details->affiliate_url; ?>">
          <button type="button" value="submit" class="btn btn-danger  center-block bor-rad-0 cls_footer_btn"> More deals </button>
         </a>
      </div>
      

            <?php
        $affid =  $store_details->affiliate_id;
       /* foreach($all_store_coupons as $coupons)
        {*/
          /*echo '<pre>';
          print_r($coupons);*/
          
          $coupon_id = $coupons->coupon_id;
          $expiry_date = $coupons->expiry_date;

          $exp = date('m/d/Y',strtotime($expiry_date));
          
          $date = DateTime::createFromFormat('m/d/Y', date('m/d/Y'));
          $date1 = date_create($date->format('Y-m-d'));
          
          $date = DateTime::createFromFormat('m/d/Y', $exp);
          $date2 = date_create($date->format('Y-m-d'));
          
          $diff=date_diff($date1,$date2);
          $coupondate =  $diff->format("%a days");
        /*}*/     
    ?>

            
      
      </div>
           
      <div class="clearfix"></div>
      <hr>
              <div class="desc std mar-top30 mar-bot">
                
<?php if($coupons->type=='Promotion'){ ?>
<p style="width:100%" class="text-center">Deal Activated. We have opened <?php echo $store_details->affiliate_name;?> in the adjacent tab for you to avail this offer.</p>


<p style="width:100%" class="text-center">Your visit has been recorded and cashback from any purchase(s) will soon reflect in your account. </p>
<?php } else{ ?>

<h5 class="text-center">We have opened <?php echo $store_details->affiliate_name;?> in the adjacent tab for you to avail this offer.</h5>

<p style="width:100%" class="text-center">Click on ‘Copy’ to copy the coupon code and use that at the time of checkout.</p>

<?php } ?>

<p>&nbsp; </p>
<div class="clearfix">

                <?php
          if($coupons->type!='Promotion')
          {
          ?>
                  <div class="col-md-6 col-sm-6 col-xs-6 pad-no">
                    <button class="btn  btn-block" id="couponResult"  style="font-size: 22px; padding: 15px 10px; height: 50px; line-height: 25px; background: #ffff none repeat scroll 0% 0%; color: black;" type="button"><?php echo $coupons->code;?></button>
                    <div class="clearfix"> </div>
                  </div>
                
                  <div class="col-md-6 col-sm-6 col-xs-6  pad-no">
                    <button class="btn btn-block" id="copyCode" style="font-size: 22px; padding: 15px 10px; height: 50px; line-height: 25px; background: #d43f3a none repeat scroll 0% 0%; color: white;" type="button"> Copy</button>
                    <div class="clearfix"> </div>

           <?php
          }
         ?>




          </div>
          <?php if($coupons->type!='Promotion'){ ?>
<div class="clearfix"></div>
               <p style="width:100%" class="text-center mar-top20">Your visit has been recorded and cashback from any purchase(s) will soon reflect in your account. </p> 
          <?php } ?>
              <!--   <p align="center" class=" mar-top">since you chose 'continue without cashback' we won't be to credit you with any cashback amount. Sign-in or join ADS to earn estra cashback every time you shop online through us!</p> -->
                
                <p>&nbsp;</p>
                
                <div class="cls_gray_bg_i" align="center" style="background:#eee">
              <!--  <h4>Flat 20% off on prescription medicines + additional 240 cashback from us</h4> -->


<h4><b>
  <?php if($store_details->cashback_percentage!="")
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
          echo " Flat ".$cppercentage." Off on ".$coupons->offer_name. ". Earn Cashback from ".$admindetails->site_name;
        }
        else
        {
          
          echo " Upto ".$cppercentage." Off on ".$coupons->offer_name." on Cashback from".$admindetails->site_name;
        }
      }
      else
      {     
        if($coupons->description!='')
        {
          echo $coupons->description;
        }
      }
        //minimum_cashback
        
      ?></b></h4>
      <div class="">
            <p class="text-center">
             
              <?php if($coupons->type!='Coupon'){ ?>
              Flat <?php echo $cppercentage; ?> Off on <?php echo $coupons->offer_name; ?>.  No coupon required.</p>   
              <?php } else{  ?>
                <p>
                 <?php echo $coupons->description; ?> Use coupon code to avail this offer.
               </p>
               <?php } ?>      
      </div>
      </div>

      </div>
      
           
      
      </div>
      </div>
        
        
        
      </div>
      


      
    </div>
  </div>
  
  
  
   <!-- sharmi -->

      <div class="modal fade loginvlo" id="LoginModal<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        
          <div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                      <img class="img img-center" src="<?php echo base_url(); ?>/uploads/adminpro/15696logo.png" alt="logo">
                    </div>
                    </div>
                    <h4 class="text-center mar-top20">Registered Customers</h4>
                    <p class="text-center padding-top-10 mar-top20">If you have an account with us, please &nbsp;<a href="javascript:;">Log in.</a></p>
                    
                    
                    <div class="row">
                                    <div class="center-block ftn padding-top-20">
                                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center>
                      <a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span>
                      </a>
                    </center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div>
                    
                    <div class="or">or</div>
                    
                    
                    <div class="row">
                          <center><span id="userstatus_ss" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                      <?php
                      //begin form
                      $attribute = array('role'=>'form','name'=>'login_form1','id'=>'login_form1','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login();');       
                      echo form_open('chk_invalid',$attribute);

                      ?>  

                      <?php 
                        $error = $this->session->flashdata('error');
                        if($error!="") {
                        echo '<div class="alert alert-error">
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
                      <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>" id="coupon_id" />       

                      <input type="hidden" name="signin" value="signin" id="signin" />       
            
                      <div class="form-group">

<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
 <input type="text" title="Email Address" class="form-control" id="email" value="" required name="email" placeholder="Email Address">
</div>

                        

                     <!--    <input type="email" placeholder="Email Address" name="email" class="form-control" title="Email Address" required id="email"> -->

                      </div>
                      <div class="form-group">

<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
  <input type="password" title="Password" placeholder="Password" required id="pass" minLength="6" class="form-control validate-password" name="pwd">
</div>
                      <!-- <input type="password" title="Password" placeholder="Password" required minLength="6" id="pass" class="form-control validate-password" name="pwd"> -->

                    

                      </div>
                      
                      <div class="row">
                    
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row mar-top">
                      <div class="col-md-6">
                      
                       <input type="hidden" name="signin" value="signin" />
                      <input type="submit" class="btn btn-danger btn-block bor-rad-0" name="signin" title="Login" id="signin" value="Login">
                     
                        </div>

 <div class="col-md-6"><a href="<?php echo base_url(); ?>visit_shop/<?php echo $store_details->affiliate_id; ?>/<?php echo $coupon_id; ?>">
                        
                        <input type="submit" class="btn btn-primary bor-rad-0" name="" title="Without cashback" id="" value="Else without cashback">
                      </a> </div>
                      
                    </div>


                    
                    <?php     
            //end form
            echo form_close();
            ?>       
             
                    
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>
  
  
<p>&nbsp;</p>
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

<script type="text/javascript" src="<?php echo base_url();?>front/js/clipboard.min.js"></script>
<script>
var clipboard = new Clipboard('#copyCode', {
  text: function() 
  {
    var couponCode= document.getElementById("couponResult").innerHTML;
    return couponCode;
  }
});
clipboard.on('success', function(e) {
  document.getElementById("copyCode").innerHTML="Copied";
});
</script>


    <!-- seetha-->
     
<script>
function setupajax_login()
{
  var datas = $('#login_form1').serialize();
  //alert(datas);
   jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>cashback/logincheck",
        data: datas,
        cache: false,
        success: function(result)
        {
          if(result!=1)
          {
            $('#userstatus').html(result);
            return false;
          }
          else
          {
            <?php $redirect_urlset =  base_url(uri_string());?>
            window.location.href = '<?php echo $redirect_urlset; ?>';
            return false;
          }             
        }
      });
            
  return false;
}

$(document).ready(function(){  
  var coupon_id = document.getElementById('coupon_id').value;
    <?php if($user_id==""){ ?>
     $("#LoginModal"+coupon_id).modal('show');
    <?php } ?>
});
</script>

</body>
