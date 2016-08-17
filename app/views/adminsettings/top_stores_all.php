<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>India's Top Cashback Deals<?php echo date('Y')?>. Get Exclusive Cashback Offers in MR10Q.com</title>
<meta name="Description" content="Get the best Cashback Offers at top brands. Never pay full price again. Join now Free & Start Saving!"/>
<meta name="keywords" content="cashback, vouchers, coupons, discounts, offers, deals, promo codes, onlin shopping, best online shopping sites" />
<meta name="robots" CONTENT="INDEX, FOLLOW" />

<!-- Bootstrap -->

<?php $this->load->view('front/css_script'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>front/css/pre-pge.css" type="text/css">
</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->

<div class="wrap-top">
  <div id="content">
  <div class="page-intro" style="margin-top: 0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pad-rht"></i><a href="<?php echo base_url();?>">Home</a></li>
                                <li class=""><a href="<?php echo base_url();?>cashback/stores_list">All Stores in MR10Q.com</a></li>
                                 <!-- <li class="active">Referral Network</li>-->
                             <!--   <li class="active">Add Missing Cashback</li>-->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
    <div class="container">
      <section class="coupon-section mar40">
        <div class="row">
          <div class="col-md-3">
            <aside class="sidebar-left store-title">
              <h3 class="mar-no mar-bot20"><i class="fa fa-ticket"></i>Categories</h3>
              <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
                <li class="active"><?php echo anchor('cashback/stores_list','<i class="fa fa-ticket"></i>All'); ?> </li>
                <?php 

								$categories = $this->front_model->get_all_categories();
								$kt = 1;
								foreach($categories as $view)
								{
									$subcate =  $this->front_model->get_sub_categorys_list($view->category_id);
									if($subcate)
									{
										$s = 'class="dropdown-toggle " data-toggle="dropdown"';
									}
									else
									{
										$s = '';
									}
									if($kt>10)
									{
										$extracss = 'style="display:none"';
									}
									else
									{	
										$extracss='';
									}

									$category_name = $view->category_name; 

								?>
                <li class="dynamiccls" <?php echo $extracss." "; 
										
										?>>
										<a <?php echo $s;?> onClick="runcheck_1('<?php echo 'cashback/stores_list/'.$view->category_url;?>');" href="<?php echo base_url().'cashback/stores_list/'.$view->category_url;?>"><i class="fa fa-arrow-circle-right"></i><?php echo $view->category_name;?></a>
                                         <?php
										
										if(count($subcate)!=0)
										{
											if($subcate)
											{
												echo '<ul class="list-unstyled clsin_list">';
												$category_url = $view->category_url;
												
												foreach($subcate as $subcatelist)
												{
													$sub_category_name = $subcatelist->sub_category_name;
													$sub_category_url = $subcatelist->sub_category_url;
													$sun_category_id = $subcatelist->sun_category_id;
													
													?>
                                                    
													<li <?php echo $kt;?>><?php echo anchor('cashback/stores_list/'.$category_url.'/'.$sub_category_url,$sub_category_name); ?></li>
													<?php
												}
												echo " </ul>";
											}
										}
										
										?> 
										<?php //echo anchor('cashback/top_cashback/'.$view->category_url,'<i class="fa fa-arrow-circle-right"></i>'.$view->category_name); ?></li>
                <?php 

								$kt++;}

								?>
              </ul>
              <button class="btn btn-block btn-blue" id="load_m" onClick="show_cate();"> Load more   </button>
            </aside>
          </div>
          <section class="main-content col-md-9">
            <div class="store-title">
              <h3 class="mar-no mar-bot20">All Stores in MR10Q.com</h3>
            </div>
            <?php

	   if($stores_list)

	   {

		   ?>
            <!--<div class="filters">
              <ul class="nav nav-pills">
                <li class="active"><a data-filter="*" href="#">All</a></li>
                <li class=""><a data-filter=".feature" style="background-color:#32c2cd;" href="#">Feature</a></li>
                <li class=""><a data-filter=".store"  style="background-color:#a5d16c;" href="#">Store of the Week </a></li>
                <li><a data-filter=".offers"  style="background-color:#e74955;" href="#"> Offers</a></li>
              </ul>
            </div>-->
            <div class="row">
              <div class="img-boxes isotope-container" style="position: relative; height: 786.034px;">
                <?php

				   $k=1;

				foreach($stores_list as $stores)

				{

					$affiliate_id = $stores->affiliate_id;

					$featured = $stores->featured;

					$affiliate_name = $stores->affiliate_name;

					$count_coupons = $this->front_model->count_coupons($affiliate_name);

					$get_coupons_sets = $this->front_model->get_coupons_sets($affiliate_name,2);

					
					$setup = "";

							$namess = ""; //heading
							
							$colors_li= '';

					

					?>
                <div class="col-sm-6 col-md-4 col-xs-12 isotope-item <?php echo $setup;?>" style="position: absolute; left: 0px; top: 0px;">
                  <div class="item first products-grid no-margin">
                    <div class="row products-row">
                      <div class="col-lg-12 col-12 _item first product-col  ">
                        <div class="wrap-item">
                          <div class="product-block">
                            <!--<div class="on-sale-wrap"> <span class="ons-ale" <?php echo $colors_li; ?>> <?php echo $namess;?> </span> </div>-->
                            <div class="image ">
                              <div class="product-img img">
                                <?php 

										 $confirm = array("class"=>"product-image img","title"=>$stores->affiliate_name);	

										 echo anchor('cashback/stores/'.$stores->affiliate_url,'<img src="'.base_url().'uploads/affiliates/'.$stores->affiliate_logo.'"  class="img-responsive">',$confirm); ?>
                                
                                <!--<div class="action"> <a class="a-quickview ves-colorbox cboxElement" href="#detail"><span> </span></a> <br>

											<a href="images/cat-img2.png" class="colorbox product-zoom button cboxElement" data-rel="colorbox"><span>Zoom image </span></a> </div>-->
                                <div class="price-box"><span class="price"><?php echo $stores->affiliate_name; ?></span> </div>
                              </div>
                            </div>
                            <div class="product-meta product-shop">
                              <h3 class="product-name name"><a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>" title="<?php echo $stores->affiliate_name; ?>">
                            <?php if($stores->cashback_percentage)
							{ 

											if($stores->affiliate_cashback_type=="Percentage")

											{

												$cppercentage = $stores->cashback_percentage."%";

											}

											else

											{

												$cppercentage = DEFAULT_CURRENCY." ".$stores->cashback_percentage;

											}

										echo "Get Up to ".$cppercentage;?>
                                <?php 
							echo "Cashback ";
							}
							else
							{
								echo "Best Offers ";
							}?>
                                
								
								
								<?php
										if($count_coupons->counting!=0 && $count_coupons->counting!='')
										{
											if($stores->cashback_percentage)
											{
												echo '&';
											}
										?>
                                 <?php echo $count_coupons->counting;?> Coupons
                                <?php
										}
										 ?>
										 
										  from MR10Q.com</a></h3>
                              
                              <!--<div class="wrap-price">

										  <div class="price-box"> <span class="regular-price" id="product-price-15carousel3"> <span class="price">$149.00</span> </span> </div>

										</div>-->
                              
                              <div class="cart"> <a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>" title="<?php echo $stores->affiliate_name; ?>">
                                <button type="button" title="Add to Cart" class="btn btn-blue btn-block"><span><span> Visit Store Coupons </span></span></button>
                                </a> 
                                
                                <!-- <button type="button" title="Add to Cart" class="btn btn-warning btn-block"><span><span>  Discount added automatically </span></span></button>--> 
                                
                              </div>
                              <div class="action">
                                <div class="wishlist col-md-offset-3 col-sm-offset-3 col-xs-offset-3"> <a class="btn btn-warning btn-block" data-target="#myModal_<?php echo $stores->affiliate_url;?>" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-heart-o"></i>About Store</a> </div>
                                
                                <!--										  <div class="compare"> <a href="#" class="link-compare"><i class="fa fa-copy"></i>Terms &amp; COnditions</a> </div>--> 
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="myModal_<?php echo $stores->affiliate_url;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">About <?php echo $stores->affiliate_name; ?></h4>
                      </div>
                      <hr>
                      <div class="modal-body">
                        <p class="txt">
                          <?php

								  echo $stores->affiliate_desc;

								  ?>
                        </p>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
                <?php

					$k++;}



                 ?>
              </div>
            </div>
            <?php

	   }

	   else

	   {

		   ?>
            <div class="row">
              <div class="alert alert-danger bs-alert-old-docs">
                <center>
                  <strong>No Stores are available at this category!</strong>
                </center>
              </div>
            </div>
            <?php

	   }

	   ?>
          </section>
        </div>
      </section>
    </div>
  </div>
</div>
<footer>
  <?php

//sub footer

	$this->load->view('front/sub_footer');

	

//Footer

	$this->load->view('front/site_intro');	



?>
</footer>

<!-- FAQ --->

<?php $this->load->view('front/js_scripts');?>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.colorbox-min.js"></script> 
<script type="text/javascript">

                jQuery(document).ready(function() {

                    jQuery('.colorbox').colorbox({

                        overlayClose: true,

                        opacity: 0.5,

                        rel: false,

                        onLoad:function(){

                            jQuery("#cboxNext").remove(0);

                            jQuery("#cboxPrevious").remove(0);

                            jQuery("#cboxCurrent").remove(0);

                        }

                    });

                     

                });

          </script> 
<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery(".ves-colorbox").colorbox({

                width: '60%', 

                height: '80%',

                overlayClose: true,

                opacity: 0.5,

                iframe: true, 

        });

        

    });

</script> 

<!-- Modernizr javascript --> 

<script type="text/javascript" src="<?php echo base_url(); ?>front/js/modernizr.js"></script> 

<!-- Isotope javascript --> 

<script type="text/javascript" src="<?php echo base_url(); ?>front/js/isotope.pkgd.min.js"></script> 

<!-- Initialization of Plugins --> 

<script type="text/javascript" src="<?php echo base_url(); ?>front/js/template.js"></script> 

<!-- contact page specific js starts --> 

<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/jquery.validate.min.js"></script> 
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/gmaps.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/map.js"></script> 

<!-- Slider --> 

<!------------------------Product Slider--------------------> 

<script src="<?php echo base_url(); ?>front/js/owl.carousel.js"></script> 
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



</script> 
<script type="application/javascript">



function toggle_st(num)

{

	$('.toggle'+num).toggle('slow');

	return false;	

}

function show_cate()
{
	$('.dynamiccls').show();
	$('#load_m').hide();
}

</script>
<script type="text/javascript">
function runcheck_1(url)
{
	window.location.href="<?php echo base_url();?>"+url;
}
</script>
</body>
</html>
