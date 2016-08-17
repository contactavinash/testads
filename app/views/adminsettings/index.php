<?php error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title><?php echo $admindetails[0]->homepage_title;?></title>
<meta name="Description" content="<?php echo $admindetails[0]->meta_description;?>"/>
<meta name="keywords" content="<?php echo $admindetails[0]->meta_keyword;?>" />
<meta name="robots" CONTENT="INDEX, FOLLOW" />

<!-- Bootstrap -->
<?php $this->load->view('front/css_script_index'); ?>
</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->

<div class="wrap-top">
  <div id="content">
    <div class="container">
      <div class="quick-links clearfix">
        <ul class="list-inline clearfix">
          <li>
            <h5> Quick Links</h5>
          </li>
          <li> <i class="fa fa-long-arrow-right"></i> </li>
          <?php 
	$categories = $this->front_model->get_all_categories(9);
	foreach($categories as $view)
	{
	?>
          <li><?php echo anchor('cashback/products/'.$view->category_url,$view->category_name); ?></li>
          <li> | </li>
          <?php } ?>
        </ul>
      </div>
      <section class="slider-sec mar-bot20">
        <div class="row">
          <div class="col-md-9">
            <div class="banner clearfix"> 
              <!--            <span>
           <div class="embed-responsive embed-responsive-4by3">

 <iframe class="embed-responsive-item" src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-142165939892256859' width="100%"></iframe>
</div>
            </span>-->
              <?php
            $headerimg = $this->front_model->getads('Header');
            ?>
              <a href="<?php echo $headerimg->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg->ads_image?>" class="img-responsive mar20" alt=""></a> </div>
            <div class="owl-carousel owl-slider" id="owl-carousel-slider" data-pagination="false" data-nav="top-right">
              <?php
					foreach($result as $imgs)
					{
						$view_img = $imgs->banner_image;
						$banner_url = $imgs->banner_url;
						$img_name = $imgs->banner_heading;
				?>
              <div>
                <div class="bg-holder"> <a href="<?php echo $banner_url;?>"> <img src="<?php echo base_url().'uploads/banners/'.$view_img; ?>" alt="" class="img-responsive" height="408" width="776" /></a>
                  <div class="text-white text-center slider-caption slider-caption-bottom">
                    <h2 class="text-left"><?php echo $img_name; ?></h2>
                    <div class="countdown countdown-big" data-countdown="Jul 29, 2014 5:30:00"></div>
                  </div>
                  <a href="<?php echo $banner_url;?>"> <img src="<?php echo base_url().'uploads/banners/'.$view_img; ?>" alt="" class="img-responsive sli-img" width="776" height="408" /></a> </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="banner clearfix">
              <?php
            $headerimg1 = $this->front_model->getads('Sidebar-1');
            ?>
              <a href="<?php echo $headerimg1->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg1->ads_image?>" class="img-responsive mar20" alt=""></a>
              <?php
            $headerimg2 = $this->front_model->getads('Sidebar-2');
            ?>
              <a href="<?php echo $headerimg2->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg2->ads_image?>" class="img-responsive mar20" alt=""></a>
              <?php
            $headerimg3 = $this->front_model->getads('Sidebar-2');
            ?>
              <a href="<?php echo $headerimg3->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg3->ads_image?>" class="img-responsive mar20" alt=""></a>
              <?php
            $headerimg4 = $this->front_model->getads('Sidebar-3');
            ?>
              <a href="<?php echo $headerimg4->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg4->ads_image?>" class="img-responsive mar20" alt=""></a> </div>
          </div>
        </div>
      </section>
      <?php
	  $getadmindetails = $this->front_model->getadmindetails(); 
      	$enable_slider = $getadmindetails[0]->enable_slider;
		if($enable_slider==1)
		{
	  ?>
      <section class="category-new">
        <div class="recent-posts "> 
          
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="active featured"><a href="#Featured" role="tab" data-toggle="tab">Featured</a></li>
            <li class=" latest"><a href="#Latest" role="tab" data-toggle="tab">Latest</a></li>
            <li class="popular"><a href="#Popular" role="tab" data-toggle="tab">Popular</a></li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active " id="Featured">
              <div class="demos"> 
                
                <!-- THE NAVIGATION  -- OUTSIDE THE SHOWBIZ CONTAINER FOR BG COLORISING-->
                <div class="showbiz-navigation center sb-nav-dark">
                  <div id="showbiz_left_4" class="sb-navigation-left"><i class="fa fa-chevron-left"></i></div>
                  <div id="showbiz_right_4" class="sb-navigation-right"><i class=" fa fa-chevron-right"></i></div>
                  <div class="sbclear"></div>
                </div>
                <!-- END OF THE NAVIGATION -->
                
                <div class="divide20"></div>
                
                <!-- DEMO IV. -->
                <div id="category-slide1" class="showbiz-container darkbg"> 
                  
                  <!--	THE PORTFOLIO ENTRIES	-->
                  <div class="showbiz" data-left="#showbiz_left_4" data-right="#showbiz_right_4"> 
                    <!-- THE OVERFLOW HOLDER CONTAINER, DONT REMOVE IT !! -->
                    <div class="overflowholder"> 
                      <!-- LIST OF THE ENTRIES -->
                      <ul>
                        <?php if($featured_product) { foreach($featured_product as $featured_produc) {
						  $db_coupon_image=$featured_produc->coupon_image;
							 $exp_db_coupon_image=explode(",",$db_coupon_image);  
							   $f_dbcouponfirst_img=$exp_db_coupon_image[0];
								  ?>
                        <li class="sb-showcase-skin"> 
                          
                          <!-- THE MEDIA HOLDER HERE -->
                          
                          <div class="mediaholder ">
                            <div class="mediaholder_innerwrap"> <img alt="" width="213px" height="115px" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>"> </div>
                          </div>
                          
                          <!-- END OF MEDIA CONTAINER --> 
                          
                          <!-- SOME ALWAYS VISIBLE CONTENT -->
                          
                          <div class="detailholder">
                            <h4 class="showbiz-title txt-center"><a href="#"><?php echo substr($featured_produc->offer_name,0,200)."...";   ?></a></h4>
                            <div class="divide5"></div>
                            <p class="txt-center" style=""><?php echo substr($featured_produc->description,0,100)."...";  ?> </p>
                          </div>
                          
                          <!-- END OF DEATIL CONTAINER --> 
                          
                          <!-- THE REVEAL CONTAINER - OPENING IN FULLWIDTH -->
                          
                          <div class="reveal_container tofullwidth"> 
                            
                            <!-- THE REVEL HIDDEN / VISIBLE CONTAINER -->
                            
                            <div class="reveal_wrapper"> 
                              
                              <!-- THE HEIGHT ADJUSTER CONTAINER -->
                              
                              <div class="heightadjuster table"> 
                                
                                <!-- TABLE CONSTRUCT FOR LEFT / RIGHT CONTENTS -->
                                
                                <div class="table-cell onethird"> <img alt=""  src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" width="100%"> </div>
                                
                                <!-- CONTENT IN TABLE -->
                                
                                <div class="table-cell pl20">
                                  <h3 class="showbiz-title large"><?php echo $featured_produc->title; ?> </h3>
                                  <div class="divide20"></div>
                                  <p>
                                    <?php 
								  $newstring = substr($featured_produc->description,0,280);
								  echo $newstring."..."; ?>
                                  </p>
                                  <div class="divide20"></div>
                                  <div class="showbiz-price pull-left"><span class="currency">$</span><span class="number clr"><?php echo $featured_produc->amount; ?></span><!-- <span class="number clr-blu" style="text-decoration:line-through;"><small class="clr-blu"> $25.49 </small></span>--></div>
                                  <a href="<?php echo base_url(); ?>index.php/cashback/detailspage/<?php echo $featured_produc->shoppingcoupon_id; ?>" class="btn btn-blue pull-right">Read more...</a> </div>
                                
                                <!-- END OF CONTENT  --> 
                                
                              </div>
                              
                              <!-- END OF HEIGHT ADJUSTER CONTAINER --> 
                              
                            </div>
                            
                            <!-- END OF REVEAL HIDDEN/VISIBLE CONTAINER --> 
                            
                            <!-- THE CLOSER / OPENER FUNCTION -->
                            
                            <div class="reveal_opener opener_big_grey"> <span class="openme">+</span> <span class="closeme">-</span> </div>
                            
                            <!-- END OF CLOSER / OPENER --> 
                            
                          </div>
                          
                          <!-- END OF THE REVEAL CONTAINER --> 
                        </li>
                        <?php } } ?>
                      </ul>
                      <div class="sbclear"></div>
                    </div>
                    <!-- END OF OVERFLOWHOLDER -->
                    <div class="sbclear"></div>
                  </div>
                </div>
                <!-- END OF DEMO IV. --> 
                
              </div>
            </div>
            <div class="tab-pane " id="Latest">
              <div class="demos"> 
                
                <!-- THE NAVIGATION  -- OUTSIDE THE SHOWBIZ CONTAINER FOR BG COLORISING-->
                <div class="showbiz-navigation center sb-nav-dark">
                  <div id="showbiz_left_3" class="sb-navigation-left"><i class="fa fa-chevron-left"></i></div>
                  <div id="showbiz_right_3" class="sb-navigation-right"><i class=" fa fa-chevron-right"></i></div>
                  <div class="sbclear"></div>
                </div>
                <!-- END OF THE NAVIGATION -->
                
                <div class="divide20"></div>
                
                <!-- DEMO IV. -->
                <div id="category-slide" class="showbiz-container darkbg"> 
                  
                  <!--	THE PORTFOLIO ENTRIES	-->
                  <div class="showbiz" data-left="#showbiz_left_3" data-right="#showbiz_right_3"> 
                    <!-- THE OVERFLOW HOLDER CONTAINER, DONT REMOVE IT !! -->
                    <div class="overflowholder"> 
                      <!-- LIST OF THE ENTRIES -->
                      <ul>
                        <?php   if($latest) { 	
							foreach($latest as $latests) 
							{
										 $db_coupon_image=$latests->coupon_image;
										 $exp_db_coupon_image=explode(",",$db_coupon_image);  							 
										 $f_dbcouponfirst_img=$exp_db_coupon_image[0];
				 				?>
                        <li class="sb-showcase-skin"> 
                          <!-- THE MEDIA HOLDER HERE -->
                          <div class="mediaholder ">
                            <div class="mediaholder_innerwrap"> <img alt="" width="213px" height="115px" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>"> </div>
                          </div>
                          <div class="detailholder">
                            <h4 class="showbiz-title txt-center"><a href="#"><?php echo substr($latests->offer_name,0,9)."...";   ?></a></h4>
                            <div class="divide5"></div>
                            <p class="txt-center"><?php echo substr($latests->title,0,54)."...";  ?> </p>
                          </div>
                          <div class="reveal_container tofullwidth"> 
                            
                            <!-- THE REVEL HIDDEN / VISIBLE CONTAINER -->
                            
                            <div class="reveal_wrapper"> 
                              
                              <!-- THE HEIGHT ADJUSTER CONTAINER -->
                              
                              <div class="heightadjuster table"> 
                                
                                <!-- TABLE CONSTRUCT FOR LEFT / RIGHT CONTENTS -->
                                
                                <div class="table-cell onethird"> <img alt=""  src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" width="100%"> </div>
                                
                                <!-- CONTENT IN TABLE -->
                                
                                <div class="table-cell pl20">
                                  <h3 class="showbiz-title large"><?php echo $latests->title; ?> </h3>
                                  <div class="divide20"></div>
                                  <p>
                                    <?php 
								  $newstring = substr($latests->description,0,280);
								  echo $newstring."..."; ?>
                                  </p>
                                  <div class="divide20"></div>
                                  <p class="orange bigger bolder">
                                    <?php // echo $latests->offer_percentage; ?>
                                  </p>
                                  <div class="showbiz-price pull-left"><span class="currency">$</span><span class="number clr"><?php echo $latests->amount; ?></span><!-- <span class="number clr-blu" style="text-decoration:line-through;"><small class="clr-blu"> $25.49 </small></span>--></div>
                                  <a href="<?php echo base_url(); ?>index.php/cashback/detailspage/<?php echo $latests->shoppingcoupon_id; ?>" class="btn btn-blue pull-right">Read more...</a> </div>
                                
                                <!-- END OF CONTENT  --> 
                                
                              </div>
                              
                              <!-- END OF HEIGHT ADJUSTER CONTAINER --> 
                              
                            </div>
                            
                            <!-- END OF REVEAL HIDDEN/VISIBLE CONTAINER --> 
                            
                            <!-- THE CLOSER / OPENER FUNCTION -->
                            
                            <div class="reveal_opener opener_big_grey"> <span class="openme">+</span> <span class="closeme">-</span> </div>
                            
                            <!-- END OF CLOSER / OPENER --> 
                            
                          </div>
                          
                          <!-- END OF THE REVEAL CONTAINER --> 
                        </li>
                        <?php } } ?>
                      </ul>
                      <div class="sbclear"></div>
                    </div>
                    <!-- END OF OVERFLOWHOLDER -->
                    <div class="sbclear"></div>
                  </div>
                </div>
                <!-- END OF DEMO IV. --> 
                
              </div>
            </div>
            <div class="tab-pane" id="Popular">
              <div class="demos"> 
                
                <!-- THE NAVIGATION  -- OUTSIDE THE SHOWBIZ CONTAINER FOR BG COLORISING-->
                <div class="showbiz-navigation center sb-nav-dark">
                  <div id="showbiz_left_5" class="sb-navigation-left"><i class="fa fa-chevron-left"></i></div>
                  <div id="showbiz_right_5" class="sb-navigation-right"><i class=" fa fa-chevron-right"></i></div>
                  <div class="sbclear"></div>
                </div>
                <!-- END OF THE NAVIGATION -->
                
                <div class="divide20"></div>
                
                <!-- DEMO IV. -->
                <div id="category-slide2" class="showbiz-container darkbg"> 
                  
                  <!--	THE PORTFOLIO ENTRIES	-->
                  <div class="showbiz" data-left="#showbiz_left_5" data-right="#showbiz_right_5"> 
                    <!-- THE OVERFLOW HOLDER CONTAINER, DONT REMOVE IT !! -->
                    <div class="overflowholder"> 
                      <!-- LIST OF THE ENTRIES -->
                      <ul>
                        <?php   if($popular) { 	
							foreach($popular as $popula) 
							{
										 $db_coupon_image=$popula->coupon_image;
										 $exp_db_coupon_image=explode(",",$db_coupon_image);  							 
										 $f_dbcouponfirst_img=$exp_db_coupon_image[0];
				 				?>
                        <li class="sb-showcase-skin"> 
                          <!-- THE MEDIA HOLDER HERE -->
                          <div class="mediaholder ">
                            <div class="mediaholder_innerwrap"> <img alt="" width="213px" height="115px" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>"> </div>
                          </div>
                          <div class="detailholder">
                            <h4 class="showbiz-title txt-center"><a href="#"><?php echo substr($popula->offer_name,0,9)."...";   ?></a></h4>
                            <div class="divide5"></div>
                            <p class="txt-center"><?php echo substr($popula->title,0,54)."...";  ?> </p>
                          </div>
                          <div class="reveal_container tofullwidth"> 
                            
                            <!-- THE REVEL HIDDEN / VISIBLE CONTAINER -->
                            
                            <div class="reveal_wrapper"> 
                              
                              <!-- THE HEIGHT ADJUSTER CONTAINER -->
                              
                              <div class="heightadjuster table"> 
                                
                                <!-- TABLE CONSTRUCT FOR LEFT / RIGHT CONTENTS -->
                                
                                <div class="table-cell onethird"> <img alt=""  src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" width="100%"> </div>
                                
                                <!-- CONTENT IN TABLE -->
                                
                                <div class="table-cell pl20">
                                  <h3 class="showbiz-title large"><?php echo $popula->title; ?> </h3>
                                  <div class="divide20"></div>
                                  <p>
                                    <?php 
								  $newstring = substr($popula->description,0,280);
								  echo $newstring."..."; ?>
                                  </p>
                                  <div class="divide20"></div>
                                  <p class="orange bigger bolder">
                                    <?php // echo $popula->offer_percentage; ?>
                                  </p>
                                  <div class="showbiz-price pull-left"><span class="currency">$</span><span class="number clr"><?php echo $popula->amount; ?></span><!-- <span class="number clr-blu" style="text-decoration:line-through;"><small class="clr-blu"> $25.49 </small></span>--></div>
                                  <a href="<?php echo base_url(); ?>index.php/cashback/detailspage/<?php echo $popula->shoppingcoupon_id; ?>" class="btn btn-blue pull-right">Read more...</a> </div>
                                
                                <!-- END OF CONTENT  --> 
                                
                              </div>
                              
                              <!-- END OF HEIGHT ADJUSTER CONTAINER --> 
                              
                            </div>
                            
                            <!-- END OF REVEAL HIDDEN/VISIBLE CONTAINER --> 
                            
                            <!-- THE CLOSER / OPENER FUNCTION -->
                            
                            <div class="reveal_opener opener_big_grey"> <span class="openme">+</span> <span class="closeme">-</span> </div>
                            
                            <!-- END OF CLOSER / OPENER --> 
                            
                          </div>
                          
                          <!-- END OF THE REVEAL CONTAINER --> 
                        </li>
                        <?php } } ?>
                      </ul>
                      <div class="sbclear"></div>
                    </div>
                    <!-- END OF OVERFLOWHOLDER -->
                    <div class="sbclear"></div>
                  </div>
                </div>
                <!-- END OF DEMO IV. --> 
                
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
		}
	  ?>
      <section class="popular-stores">
        <h3 class="heading text-center">Popular Online Stores </h3>
        <div data-ride="carousel" class="carousel slide" id="product-carousel">
          <?php
		 $stores_list =  $this->front_model->get_top_cashback_stores_limit(12);
		  ?>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <?php
	
		?>
            <div class="item active">
              <div class="row">
                <?php
		$k=1;
		$counting = count($stores_list);
		foreach($stores_list as $stores)
		{
				$affiliate_id = $stores->affiliate_id;
					$featured = $stores->featured;
					$affiliate_name = $stores->affiliate_name;
					$count_coupons = $this->front_model->count_coupons($affiliate_name);
					$get_coupons_sets = $this->front_model->get_coupons_sets($affiliate_name,2);
			?>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="store-box clearfix">
                    <center>
                      <?php 
				$confirm = array("class"=>"img-responsive center-block mar20 img-hgt","title"=>$stores->affiliate_name);	
				echo anchor('cashback/stores/'.$stores->affiliate_url,'<img src="'.base_url().'uploads/affiliates/'.$stores->affiliate_logo.'" style="height:100%"  class="img-responsive">',$confirm); ?>
                    </center>
                    <!-- <img src="<?php echo base_url();?>front/images/store-img-1.png" class="img-responsive center-block mar20 img-hgt">-->
                    <p class="text-center"><a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>" title="<?php echo $stores->affiliate_name; ?>">
                      <?php if($stores->cashback_percentage)
										{ 
										if($stores->affiliate_cashback_type=="Percentage")
											{
												$cppercentage = $stores->cashback_percentage."%";
											}
											else
											{
												$cppercentage = DEFAULT_CURRENCY_CODE." ".$stores->cashback_percentage;
											}
						
										echo "Up to ".$cppercentage;?>
                      <?php }?>
                      Cashback
                      <?php
										if(isset($count_coupons->counting) && $count_coupons->counting!=0)
										{
										?>
                      & <?php echo $count_coupons->counting;?> Coupons
                      <?php
										}
										?>
                      </a></p>
                    <div class="caption">
                      <div class="caption-content"> <a class="animated fadeInDown" href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>"><i class="fa fa-link fa-2x"></i></a> <a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>">
                        <h4>Go To <?php echo $stores->affiliate_name;?></h4>
                        </a> </div>
                    </div>
                  </div>
                </div>
                <?php
				if($k%4==0 && $k!=$counting)
			{
				?>
              </div>
            </div>
            <div class="item">
              <div class="row">
                <?php
			}
			
			
		$k++;
		}
		   ?>
              </div>
            </div>
          </div>
          
          <!-- Controls --> 
          <a data-slide="prev" href="#product-carousel" class="left c-control"> <i class="fa fa-chevron-right"></i> </a> <a data-slide="next" href="#product-carousel" class="right c-control"> <i class="fa fa-chevron-left"></i> </a> </div>
      </section>
      <?php
	  $recently_viewd = $this->front_model->recently_viewed_index();
	  
	  ?>
      <section class="recent">
        <div class="row">
          <div class="col-md-3">
            <h4 class="heading-in text-center"> Recently Viewed </h4>
            <div class="recent-box clearfix">
              <?php
			foreach($recently_viewd as $recently_view)
			{				
			?>
              <a href="<?php echo base_url(); ?>index.php/cashback/detailspage/<?php echo $recently_view->product_id; ?>"> <img  src="<?php echo base_url(); ?>uploads/premium/<?php echo $recently_view->image; ?>" class="img-responsive center-block"></a>
              <p class="text-center"><?php echo $recently_view->name; ?> </p>
              <p class="clr-blu text-center"><?php echo DEFAULT_CURRENCY;?> <?php echo $recently_view->price; ?></p>
              <hr>
              <?php
			}
			 ?>
            </div>
          </div>
          <div class="col-md-9">
            <div class="browse">
              <h4 class="heading-in"> Recommendation Based on Browsing History </h4>
              <?php
				  $recom_viewd = $this->front_model->clock_history_stores();
				  
				  ?>
              <div class="carousel slide" id="carousel" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="item active">
                    <?php
					$kt=1;
					$cting = count($recom_viewd);

					foreach($recom_viewd as $recom)
					{
						$store_name = $recom->store_name;
					$store_aff_url = $this->front_model->seoUrl($store_name);
					$stores = $this->front_model->get_store_details($store_aff_url);
					
					$affiliate_id = $stores->affiliate_id;
					$featured = $stores->featured;
					$affiliate_name = $stores->affiliate_name;
					$count_coupons_1 = $this->front_model->count_coupons($affiliate_name);
					$ctp = $count_coupons_1->counting;
					$update_lo = '<img width="120" height="75"  src="'.base_url().'uploads/affiliates/'.$stores->affiliate_logo.'"  class="img-responsive">';
					
                  ?>

                    <div class="col-sm-4 col-md-4 col-xs-12">
                      <div class="featured-item-container">
                        <div class="featured-item">
                          <div class="featured-mask">
                            <p>POPULAR</p>
                          </div>
                          <div class="logotype">
                            <div class="logotype-image">
                              <center>
                                <a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>"> <?php echo $update_lo;?></a>
                              </center>
                            </div>
                          </div>
                          <div class="featured-item-content"> <a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>">
                            <center>
                              <h4><?php echo $affiliate_name;?></h4>
                            </center>
                            </a>
                            <center>
                              <p style="min-height:41px"><a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>" title="<?php echo $stores->affiliate_name; ?>">
                                <?php if($stores->cashback_percentage)
										{ 
											if($stores->affiliate_cashback_type=="Percentage")
											{
												$cppercentage = $stores->cashback_percentage."%";
											}
											else
											{
												$cppercentage = DEFAULT_CURRENCY_CODE." ".$stores->cashback_percentage;
											}
						
						
										echo "Up to ";
										if($cppercentage!='' && $cppercentage!=0){
										echo 	$cppercentage;?>
                                <?php }?>
                                Cashback
                                <?php
										}
										?>
                                <?php
										if($count_coupons_1->counting!=0 && $count_coupons_1->counting!='')
										{
											if($stores->cashback_percentage)
											{
												echo '&';
											}
										?>
                                 <?php echo $count_coupons_1->counting;?> Coupons
                                <?php
										}
										 ?>
                                         
                                </a></p>
                            </center>
                          </div>
                          <div class="item-meta">
                            <ul class="list-inline list-unstyled">
                              <?php if($stores->cashback_percentage)
							 {
											 if($stores->affiliate_cashback_type=="Percentage")
											{
												$cppercentage = $stores->cashback_percentage."%";
											}
											else
											{
												$cppercentage = DEFAULT_CURRENCY_CODE." ".$stores->cashback_percentage;
											}
											
							 ?>
                              <li> <a href="javascript:void(0);"><?php echo $cppercentage;?> cashback</a> </li>
                              <?php
							}	
							if($ctp!=0)
							{
							 ?>
                              <li> <a href="javascript:void(0)"> <span class="fa fa-tag"></span><?php echo $ctp;?> Coupons </a> </li>
                              <?php
							}
							?>
                              <!-- <li class="pull-right"> <a href="<?php echo base_url();?>cashback/stores/<?php echo $stores->affiliate_url;?>"> <span class="fa fa-plus-square"></span> </a>-->
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
					?>
                  </div>
                  <div class="item">
                    <?php
					}
					?>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a> <a class="right carousel-control" href="#carousel" data-slide="next"><i class="fa fa-chevron-right"></i></a> </div>
              <div class="banner clearfix">
                <?php
					$headerimg = $this->front_model->getads('Footer');
					?>
                <a href="<?php echo $headerimg->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg->ads_image?>" class="img-responsive mar20" alt=""></a> </div>
             
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="fl fw blue_divider_2 clearfix">
    <div class="divider subscribe">
      <div class="container">
        <div class="pull-left pad-rht">
          <div class="icon-env clearfix"><i class="fa fa-envelope-o fa-4x pad-rht"></i></div>
          <div class="">
            <h2>Sign up for MR10Q.com Exclusive Offers!</h2>
            <p>Share your Email ID and never miss another deal - it's FREE</p>
          </div>
        </div>
        <form class="form pad20 pull-right">
          <input type="text" id="email" onkeypress="clears(1);" placeholder="Enter your Email ID to get best offers" class="form-control" />
          <a id="news_letter_submit" class="submit pop" onClick="email_sub();" style="cursor:pointer">Subscribe</a> &nbsp;
          <div id="msg" style="color:red"></div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="wrap-top">
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cls_cash_back_works">
            <h4> How Cashback Works </h4>
            <p>MR10Q.com is India's No.1 website to save on all your online shopping. We give you EXTRA CASHBACK when you shop at any of our 500+ partner brands. This is over and above Coupons and Discounts that might already be running on the retailer's website. Just remember to go via MR10Q.com & shop. We get paid commission which we pass to you as Cashback.. </p>
          </div>
        </div>
        <div> </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="cls_cash_works" align="center">
            <h4>Browse</h4>
            <div class="cls_num_bg"> 1 </div>
            <div class="hi-icon">
              <div class="cls_img_icon"> <img src="<?php echo base_url();?>front/images/icon_1.png" alt=""/> </div>
            </div>
            <div class="cls_text_co"> Browse our site and choose from 100s of retailers and exclusive offers.</div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="cls_cash_works" align="center">
            <h4>Shop</h4>
            <div class="cls_num_bg">2 </div>
            <div class="hi-icon">
              <div class="cls_img_icon"> <img src="<?php echo base_url();?>front/images/icon2.png" alt=""/> </div>
            </div>
            <div class="cls_text_co">Click through to your favourite retailers and shop as usual.</div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="cls_cash_works" align="center">
            <h4>Earn Cashback</h4>
            <div class="cls_num_bg"> 3 </div>
            <div class="hi-icon">
              <div class="cls_img_icon"> <img src="<?php echo base_url();?>front/images/icon3.png" alt=""/> </div>
            </div>
            <div class="cls_text_co">The retailer pay us commission foryour purchase and we add this as cashback to your earnings.</div>
          </div>
        </div>
      </div>
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
<?php $this->load->view('front/js_scripts');?>

<!-- Slider --> 

<script type='text/javascript'>
        
        $(document).ready(function() 
		{	
								run = false;
					var multiple = function() {
					$('.carousel .item').each(function () {
						var next = $(this).next();
						if (!next.length) {
							 next = $(this).siblings(':first');
						}
						next.children(':first-child').clone().appendTo($(this));
						run = true;
						 if (next.next().length>0) {
						next.next().children(':first-child').clone().appendTo($(this));
					  }
					  else {
						$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
					  }
						
					});
					};
					var undo = function() {
					$('.carousel .item').each(function () {
						$(this).children().last().remove();
						run = false;
					});
					};
					
					
					if ($(window).width() > 768) {
						multiple( 0 );
					};
					$(window).resize(function() {
						if (run==false && $(window).width() >= 768) {
						multiple( 2 );
					} else if (run == true && $(window).width() < 768) {
						undo( 0 );
					}
					
					
					});
        });
        
        </script> 

<!-- THE SHOWBIZ JS FILES  --> 
<script type="text/javascript" src="<?php echo baseurl();?>front/js/category/jquery.themepunch.plugins.min.js"></script> 
<script type="text/javascript" src="<?php echo baseurl();?>front/js/category/jquery.themepunch.showbizpro.min.js"></script> 
<script type="text/javascript">

				jQuery(document).ready(function() {

					jQuery('#category-slide, #category-slide1, #category-slide2').showbizpro({
						dragAndScroll:"off",
						visibleElementsArray:[5,3,2,1],
						carousel:"on",
						speed:680,
						easing:"Power3.easeInOut"
					});


					

				});
				
				$('.nav-tabs').bind('click', function (e){ $(window).trigger("resize"); });

			</script> 
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
		$('#email').css('border', '');
	else
		$('#news_email').css('border', '');
}    
</script> 
<script>
 
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );



function showPassword() {
    
    var key_attr = $('#key').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#key').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#key').attr('type', 'password');
        
    }
    
}
</script>
</body>
</html>
