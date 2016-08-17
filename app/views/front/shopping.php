<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $admindetails[0]->homepage_title;?></title>
<meta name="Description" content="<?php echo $admindetails[0]->meta_description;?>"/>
<meta name="keywords" content="<?php echo $admindetails[0]->meta_keyword;?>" />
<meta name="robots" CONTENT="INDEX, FOLLOW" />

<!-- Bootstrap -->

<?php $this->load->view('front/css_script'); ?>
<link href='<?php echo base_url(); ?>front/css/pre-pge.css' rel='stylesheet' type='text/css'> 
<style>
#loading-circle-overlay {
	background: rgba(255, 255, 255, 0.8);
	margin: 0 auto;
	min-height: 150px;
	width:100%;
	margin-top:-50px;
}
.loadinh_bg {
	margin: 0 auto !important;
	width:50% !important;
	background:none repeat scroll 0 0 white !important;
	margin-top:75px !important;
	position:relative;
	left:0;
	right:0;
}
.full-width {
	width: 100% !important;
}
</style>
<style>
#loading-circle-overlay {
	bottom: 0;
	left: 0;
	position: fixed;
	right: 0;
	top: 51px;
	z-index: 100;
	background:#ggg;
}
.loadinh_bg {
	border-radius: 10px;/*    margin: 200px auto 0;

    padding:10px;

    width:100px;
*/
}
.loader {
	border: 2px solid #555555 !important;
	font-style: italic;
	height: 75px;
	position: relative;
}
</style>
</head>

<body>
<?php $this->load->view('front/header'); ?>

<div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a href="<?php echo base_url();?>">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
				<li class="active">Shopping Premium Coupons <?php if($this->session->userdata('cityname'))
																{
																	echo "- ".$cityname = $this->session->userdata('cityname');
																} ?></li>
			  </ul>
			</div>
			<!--col-xs-12--> 
		  </div>
		  <!--row--> 
		</div>
		<!--container--> 
	</div>
    
    
<div class="wrap-top">
  <div id="loading-circle-overlay" class="loading-circle-overlay" style="display:none;">
    <div id="model-back">
      <div class="loadinh_bg">
        <div class="main_content_bg">
          <div class="details_bg">
            <div style="overflow:hidden;clear:both;">
              <div > <!--<font size="-1" color="#A2A2A2" style="margin-left: 26px;">Please Wait...</font>--> 
                
                <img src="<?php echo base_url();?>front/images/inspiroo_logo_loader_pop.gif" class="img-responsive center-block" /> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <section class="mid-sec mar40">
        <div class="row">
          <?php 

	             $rest_catcoupon=$this->front_model->getcnt_allpremiumcoupon_incat();    

				?>
          <div class="col-md-3 col-xs-12">
            <aside class="sidebar-left">
              <ul id="removeclass" class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
                <li class="active" id="claa_all"> <a href="javascript:void('0');"  onclick="funct_setpremium_cat('all','cat');"> <i class="fa fa-ticket"></i>All<span><?php echo $rest_catcoupon; ?></span></a> </li>
                <?php  

						      

						        $rest_catcoupon=$this->front_model->get_allpremiumcoupon_cat();    

							  

						        if($rest_catcoupon!="")

								{

								 

								 foreach($rest_catcoupon as $fet_premiumcat) 

								 { 

										     $db_category_id=$fet_premiumcat->category_id;  

										     $db_category_name=$fet_premiumcat->category_name; 

										     $db_catdate_added=$fet_premiumcat->date_added; 

										     $rest_pcatcnt=$this->front_model->get_countofpremiumcat_addcoupon($db_category_id);  

						   ?>
                <li id="claa_<?php echo $db_category_id  ?>"><a href="javascript:void('0');"  onclick="funct_setpremium_cat('<?php echo $db_category_id; ?>','cat');"   ><i class="fa fa-arrow-circle-right" ></i><?php echo $db_category_name;  ?><span><?php echo $rest_pcatcnt; ?></span></a> </li>
                <?php    

							      } 

							 }

							?>
              </ul>
              <div class="sidebar-box">
                <h5>Filter By Price</h5>
                <input type="text" id="price-slider_1" onblur="funct_setpremium_cat(1,0)" >
              </div>
              <div class="sidebar-box">
                <h5>Product Feature</h5>
                <ul class="checkbox-list">
                  <li class="checkbox" >
                    <label onClick="funct_setpremium_cat('new','feature')">
                      <input type="checkbox"  value="new"  class="i-check" >
                      <span >New</span> <small></small>
                      <input type="hidden" id="new"  value="0 " class="i-check" >
                    </label>
                  </li>
                  <li class="checkbox" >
                    <label onClick="funct_setpremium_cat('es','feature')">
                      <input type="checkbox" value="es"  class="i-check" >
                      <span >Ending Soon</span> <small></small>
                      <input type="hidden" id="es"  value="0 " class="i-check" >
                    </label>
                  </li>
                  <li class="checkbox" >
                    <label onClick="funct_setpremium_cat('popular','feature')">
                      <input type="checkbox"   value="popular"  class="i-check" >
                      <span>Popular</span> <small></small>
                      <input type="hidden" id="popular"  value="0" class="i-check" >
                    </label>
                  </li>
                  <li class="checkbox" >
                    <label onClick="funct_setpremium_cat('featured','feature')">
                      <input type="checkbox"  value="featured" class="i-check" >
                      <span>Featured</span> <small></small>
                      <input type="hidden" id="featured"  value="0" class="i-check" >
                    </label>
                  </li>
                </ul>
              </div>
            </aside>
          </div>
          <div class="col-md-9 col-xs-12">
            <div class="slier-sec clearfix mar-bot20">
              <div id="myCarousel" class="carousel slide" data-ride="carousel" > 
                
                <!-- Wrapper for slides -->
                
                <div class="carousel-inner" >
                  <?php

					$resultsss = $this->front_model->premium_home_slider();

					$k=1;

					foreach($resultsss as $imgs)

					{

						$view_img = $imgs->banner_image;

						$banner_url = $imgs->banner_url;

						$img_name = $imgs->banner_heading;

						if($k==1)

						{

							$st = 'active';

							//$st = '';

						}

						else

						{

							$st = '';

						}

				

						?>
                  <div class="item <?php echo $st;?>" > <a href="<?php echo $banner_url;?>"> <img  height="408" width="776" class="img-responsive" src="<?php echo base_url().'uploads/banners/'.$view_img; ?>"></a> </div>
                  <?php $k++;} ?>
                  
                  <!-- End Item --> 
                  
                </div>
                <!-- End Carousel Inner --> 
                
                <!--

    	<ul class="nav nav-pills nav-justified">

          <li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#">About<small>Lorem ipsum dolor sit</small></a></li>

          <li data-target="#myCarousel" data-slide-to="1"><a href="#">Projects<small>Lorem ipsum dolor sit</small></a></li>

          <li data-target="#myCarousel" data-slide-to="2"><a href="#">Portfolio<small>Lorem ipsum dolor sit</small></a></li>

          <li data-target="#myCarousel" data-slide-to="3"><a href="#">Services<small>Lorem ipsum dolor sit</small></a></li>

        </ul>--> 
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="demos bor-no pad-no">
                  <div class="divide20"></div>

                  <!-- DEMO IV. -->
                                    <!--Nathan Comment Start-->
                  
                  <!--<div id="category-slide1" class="showbiz-container darkbg"> 
                  
                
                  <div class="showbiz" data-left="#showbiz_left_4" data-right="#showbiz_right_4"> 
                   
                    <div class="overflowholder"> 
                    
                      <ul>
                        <?php if($featured_product) { foreach($featured_product as $featured_produc) {
						  $db_coupon_image=$featured_produc->coupon_image;
							 $exp_db_coupon_image=explode(",",$db_coupon_image);  
							   $f_dbcouponfirst_img=$exp_db_coupon_image[0];
								  ?>
                        <li class="sb-showcase-skin"> 
                          
                        
                          
                          <div class="mediaholder ">
                            <div class="mediaholder_innerwrap"> <img alt="" width="213px" height="115px" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>"> </div>
                          </div>
                          
                         
                          
                           <div class="detailholder">
                          <h4 class="showbiz-title txt-center" style="min-height:120px"><a href="#"><?php echo substr($featured_produc->offer_name,0,150)."...";   ?></a></h4>
                          <div class="divide5"></div>
                          <p class="txt-center" style=""><?php echo substr($featured_produc->description,0,100)."...";  ?> </p>
                        </div>
                          
                        
                          
                          <div class="reveal_container tofullwidth"> 
                            
                          
                            
                            <div class="reveal_wrapper"> 
                              
                            
                              <div class="heightadjuster table"> 
                                
                             
                                
                                <div class="table-cell onethird"> <img alt=""  src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" width="100%"> </div>
                            
                                
                                <div class="table-cell pl20">
                                  <h3 class="showbiz-title large"><?php echo $featured_produc->title; ?> </h3>
                                  <div class="divide20"></div>
                                  <p>
                                    <?php 
								  $newstring = substr($featured_produc->description,0,280);
								  echo $newstring."..."; ?>
                                  </p>
                                  <div class="divide20"></div>
                                  <div class="showbiz-price pull-left"><span class="currency">$</span><span class="number clr"><?php echo $featured_produc->amount; ?></span></div>
                                  <a href="<?php echo base_url(); ?>index.php/cashback/detailspage/<?php echo $featured_produc->shoppingcoupon_id; ?>/<?php echo $featured_produc->seo_url; ?>" class="btn btn-blue pull-right">Read more...</a> </div>
                                
                               
                                
                              </div>
                              
                              
                              
                            </div>
                            
                          
                            
                            <div class="reveal_opener opener_big_grey"> <span class="openme">+</span> <span class="closeme">-</span> </div>
                            
                          
                            
                          </div>
                        
                        </li>
                        <?php } } ?>
                      </ul>
                      <div class="sbclear"></div>
                    </div>
                   
                    <div class="sbclear"></div>
                  </div>
                </div>-->
                  
                  <!--Nathan Comment End-->
                  
                </div>
              </div>
            </div>
            <div id="resp_scrool"></div>
            <div id="response">
              <?php

					

					   if($result!="0")

					   { 

					     

					 ?>
              <div class="row row-wrap">
                <?php 

				     foreach($result as $fetrest)

					 { 

				            $shoppingcoupon_id=$fetrest->shoppingcoupon_id;

				            $db_offer_name=$fetrest->offer_name;

				            $db_coupon_description=$fetrest->description;

				            $db_coupon_image=$fetrest->coupon_image;

				            $db_expiry_date=$fetrest->expiry_date;

				            $db_cp_price=$fetrest->amount;

							

							 $exp_db_coupon_image=explode(",",$db_coupon_image);  

							 

							   $f_dbcouponfirst_img=$exp_db_coupon_image[0];

							    

								$len_db_offer_name=strlen($db_offer_name);  

								$len_db_coupon_desc=strlen($db_coupon_description);  

						   

						         if($len_db_offer_name>=10)

								 {
	
								      $f_dbcp_name=substr($db_offer_name,0,30)."..."; 

								 }

								 else

								 {

								     $f_dbcp_name=$db_offer_name; 

								 }



								 if($len_db_coupon_desc>=54)

								 {

								      $f_dbcp_desc=substr($db_coupon_description,0,54)."..."; 

								 }

								 else

								 {

								     $f_dbcp_desc=$db_coupon_description; 

								 } 

								  

								  $getremain_days=$this->front_model->find_remainingdays($fetrest->expiry_date);  

								  

								  // print_r($getremain_days); 

								    // echo "$days days $hours hours remain<br />";  



									

				   ?>
                <a class="col-md-4 col-sm-4 col-xs-12" href="<?php echo base_url(); ?>index.php/cashback/detailspage/<?php echo $fetrest->shoppingcoupon_id; ?>/<?php echo $fetrest->seo_url; ?>">
                <div class="product-thumb">
                  <header class="product-header"> <img width="" height="" style="height: 161px; width:236px"  class="img-responsive" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" alt="Image Alternative text" title="Hot mixer" /> </header>
                  <div class="product-inner">
                    <h5 class="product-title">
                      <?php  echo $f_dbcp_name;  ?>
                    </h5>
                    <p class="product-desciption"><?php echo $f_dbcp_desc;  ?> </p>
                    <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i>
                      <?php  echo $getremain_days['days']." days ".$getremain_days['hours']." h "." remaining";   ?>
                      </span>
                      <ul class="product-price-list">
                        <li><span class="btn btn-blue"><?php echo DEFAULT_CURRENCY;?><?php echo " ".$db_cp_price; ?></span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </a>
                <?php 

						 }

						?>
              </div>
              <?php 

					  }

					  else

					  {

					?>
                  
              <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">x</button>
                <strong>Oops! </strong> <?php echo $notfound;  ?> </div>
              <?php 

					  }

					?>
              <?php if($result!=0)  echo $this->pagination->create_links();      ?>
            </div>
            
            <!--

 			   <ul class="pagination">

                        <li class="prev disabled">

                            <a href="#"></a>

                        </li>

                        <li class="active"><a href="#">1</a>

                        </li>

                        <li><a href="#">2</a>

                        </li>

                        <li><a href="#">3</a>

                        </li>

                        <li><a href="#">4</a>

                        </li>

                        <li><a href="#">5</a> 

                        </li>

                        <li class="next">

                            <a href="#"></a>

                        </li>

                    </ul>

                    -->
            
            <div class="gap"></div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<?php  $maxva = $this->db->query('SELECT max(amount) as maxva FROM `shopping_coupons`')->row('maxva');

?>
<input type="hidden" name="max_val" id="max_val" value="<?php echo $maxva;?>" >
<footer>

<!-- Modal -->
<div id="myModal2" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a><!-- seetha -->
        <h4 class="modal-title text-center" id="myModalLabel"> Subscribe with <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></h4>
       
      </div>
      <div class="modal-body">
        <div class="account-login">
          <div class="col-md-6 no-left-margin">
            <div class="registered-users bot-shadow">
              <div class="content">
                <div id="login">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-wrap">
                        <h1>Subscribe with <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></h1>
                          
                          
      <div class="signin-or">
        <hr class="hr-or">
        <span class="span-or"></span>
      </div>
                        <?php
					 //begin form
						$attribute = array('role'=>'form','name'=>'sub_form_1','id'=>'sub_form', 'onsubmit'=>'return onlyAlphabets();', 'autocomplete'=>'off','method'=>'post');
						echo form_open('cashback/email_subscribe_shoppping',$attribute);						
					?>
                    <?php
					if(!$this->session->userdata('user_id'))
					{
					?>
                          <div class="form-group">
                           <center><span id="userstatus" style="color:red; font-weight:bold;"> </span></center>
                            <label for="email" class="sr-only">Email<span class="required_field">*</span></label>
                            <input type="email" required id="email" class="form-control input-lg" placeholder="somebody@example.com" name="email" autocomplete="off"  >
                          </div>
                       <?php
					} 
					   ?>
                          <div class="form-group">
                            <label for="key" class="sr-only">Location<span class="required_field">*</span></label>
                            <input type="text" required id="Location" class="form-control input-lg" name="location" onsubmit="return onlyAlphabets()"  placeholder="Enter Your Location" >
                             <div id="notification" style="color: red;"></div>
                          </div>
                        <!--  <div class="checkbox"> <span  style="border:none;"class="character-checkbox" onclick=""></span> <input type="checkbox" name="rememberme" id="RememberMe"><span class="label">Remember Me</span> </div>-->
                         
                          <input type="submit"  class="btn btn-custom btn-lg btn-block" name="signin" id="signin" value="Submit">
                        </form>
                       <!-- <a href="<?php echo base_url()?>cashback/forgetpassword" class="forget">Forgot your password?</a>-->
                        <hr>
                      </div>
                    </div>
                    <!-- /.col-xs-12 --> 
                  </div>
                  <!-- /.row --> 
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 no-right-margin">
            <div class="new-user">
              <div class="content">
                <div class="section-line">
                 <!-- <h4 class="text-capitalize">Join India's No.1 Cashback & Coupon website</h4>
                  
                  
                  <div class="buttons-set">
               <a href="<?php echo base_url()?>cashback/register"> <button class="btn btn-warning" title="Create an Account" type="button"> Signup Start Earning </button></a>
              </div>-->
              <?php
			  $getadmindetails = $this->front_model->getadmindetails(); 
				$logo = $getadmindetails[0]->site_logo;
				?>
              
			<center><img src="<?php echo base_url();?>uploads/adminpro/<?php echo $logo;?>" class="img-responsive">              </center>
              <hr>
              
              <h3 class="clr-blu">SAVE MONEY at 500+ brands -<small> why pay more when you can pay less? </small></h3>
              
              <ul class="list-inline clearfix mar40">
              
              <li><a href="<?php echo base_url();?>cashback/stores_list" ><img src="<?php echo base_url();?>front/images/store-img-1.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              <li><a  href="<?php echo base_url();?>cashback/stores_list"><img src="<?php echo base_url();?>front/images/store-img-2.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              <li><a  href="<?php echo base_url();?>cashback/stores_list"><img src="<?php echo base_url();?>front/images/store-img-3.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              <li><a href="<?php echo base_url();?>cashback/stores_list" ><img src="<?php echo base_url();?>front/images/store-img-4.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              <li><a href="<?php echo base_url();?>cashback/stores_list" ><img src="<?php echo base_url();?>front/images/store-img-5.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              <li><a href="<?php echo base_url();?>cashback/stores_list" ><img src="<?php echo base_url();?>front/images/store-img-6.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
               <li><a href="<?php echo base_url();?>cashback/stores_list" ><img src="<?php echo base_url();?>front/images/store-img-7.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              <li><a  href="<?php echo base_url();?>cashback/stores_list"><img src="<?php echo base_url();?>front/images/store-img-8.png" class="img-thumbnail mar-bot" width="70"></a></li>
              
              </ul>
              
               <hr>
                </div>
                
                
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer"> </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dalog --> 
</div>
 <!-- /.modal -->
  <?php

//sub footer

	$this->load->view('front/sub_footer');

	

//Footer

	$this->load->view('front/site_intro');	



?>
</footer>
<?php $this->load->view('front/js_scripts');?>
</body>
<script src="<?php echo base_url(); ?>front/js/ionrangeslider.js"></script>
<script src="<?php echo base_url(); ?>front/js/icheck.js"></script>
<script>



$(document).ready(function() {

$( "#price-slider" ).blur(function() {

alert( "Handler for .blur() called." );

});

});

 

 function funct_setpremium_cat(catid,cat)

 {   

  $(".loading-circle-overlay").show();

	if(cat=="feature")

	{

      if($("#"+catid).val()==0)

	  {

		  $("#"+catid).val('1');

	  }

	  else

	  {

		  $("#"+catid).val('0');

	  }

 	}

	

	if(cat=="cat")

	{

	  catid	=catid;

	  $('#removeclass li').removeClass( "active" );

	  $('#claa_'+catid).addClass( "active" );

	}

	else

	{

	  catid="0";	

	}



	var starting_price=$(".irs-from").text().split('Rs');

	var end_price=$(".irs-to").text().split('Rs');

/*	if(starting_price)

 	{

		alert(starting_price);

		alert(end_price);

	}

	else

	{

		alert('ssssssss');

	}*/

	

	if (starting_price.length == 1) 

	{

		var final_start_price = starting_price[0];

  	// not found

	}  else {

		var final_start_price = starting_price[1];

 	 // multiple items found

	}

	

	if (end_price.length == 1)

	 {

  		var final_send_price = end_price[0];

	}  else

	 {

		 var final_send_price = end_price[1];

 	 // multiple items found

	}





	

	var featured=$("#featured").val();

	var popular=$("#popular").val();

	var new1=$("#new").val();

	var es=$("#es").val();



	   $.ajax({  

	url:"<?php echo base_url(); ?>index.php/cashback/ajaxsess_setpremiumcategory",

	data: "catid="+catid+"&starting_price="+final_start_price+"&end_price="+final_send_price+"&featured="+featured+"&popular="+popular+"&new="+new1+"&es="+es,     

	type:"POST",

	success:function(html_butadelike)

	{          

	$('#response').html(html_butadelike);

	 $(".loading-circle-overlay").hide();

	 $('html, body').animate({

        'scrollTop' : $("#resp_scrool").position().top

    });

	 //resp_scrool

	}  

	});     

  

 }    

var maxsel = <?php echo $maxva;?>;
$("#price-slider_1").ionRangeSlider({

    min: 0,

    max: maxsel,

    type: 'double',

    prefix: "<?php echo DEFAULT_CURRENCY_CODE;?>",

    prettify: false,

    hasGrid: false,

	onFinish: function (obj) {

   			funct_setpremium_cat(1,0);

	}

});

/*$(".irs-from").text(<?php echo $this->session->userdata("sess_cashback_starting_price"); ?>);

$(".irs-to").text(<?php echo $this->session->userdata("sess_cashback_end_price"); ?>);*/



</script>

 <script type="text/javascript">
 	var hiddenuserid = $('#hidden_user_id').val();

		if(hiddenuserid=='')
		{
		 $(document).ready(function() {
		   $('#myModal2').modal({
			 show: true,
			 backdrop: 'static',
			 keyboard: false
		   })
		 });
		}
		

		function onlyAlphabets() {

			  var regex = /^[a-zA-Z]*$/;
			  if (regex.test(document.sub_form_1.location.value)) {
			
				  //document.getElementById("notification").innerHTML = "Watching.. Everything is Alphabet now";
				  return true;
			  } else {
				  document.getElementById("notification").innerHTML = "Alphabets Only";
				  return false;
			  }	
		
		}
</script>
</html>
