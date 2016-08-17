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
<?php $this->load->view('front/css_script_index');?>
<style>
.nivo-directionNav a
{z-index:100001;}
</style>
<script type="text/javascript">

$(function () {
	$('.homeslider').hide();
	$('#categoryhidesilde').hide();
	$('#ajaxloadeddiv').show();
	setTimeout(function(){
	 	$('.homeslider').show();
		$('#categoryhidesilde').show();
		$('#hidesettingsdiv').hide();
		$('#loadeddiv').show();		
		$('#ajaxloadeddiv').hide();
	}, 2000);
});
</script>
<script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };
  </script>
</head>

<body>
<?php $this->load->view('front/header');?>

<section class="slider-sec">

<div class="slider-group">
  <div class="container">
    <div class="row">
      <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12"> </div>
      <div class="col-md-9 col-sm-9">
      <div class="row">
          
		    <div class=" col-md-12 ">
			<div class="">
			
			<div class="marquee">
  <div>
    <span><a href="<?php echo base_url();?>cashback/products/mobile-phones#category=mobile-phones"><marquee>Compare prices of products both online and offline,select the best and avail cashback,reward points etc..
	 Also check for more offline discounts around you and avail additional coupon discount.</marquee></a></span>
  
  </div>
</div>
			
			
			</div>
			
          </div>
    </div>
      
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
            
            <!-- start enable -->
            <div class="ma-banner7-container">
              <div class="flexslider ma-nivoslider">
                <div class="ma-loading"></div>
                <div id="ma-inivoslider-banner7" class="slides"> 
                
                 <?php if($result){
					 $sk = 1;
				foreach($result as $imgs)
				{
					$view_img = $imgs->banner_image;
					$banner_url = $imgs->banner_url;
					$img_name = $imgs->banner_heading;
				?>
                 <a style="z-index:100000" target="_blank" href="<?php echo $banner_url; ?>" id="id_<?php echo $sk;?>" title="Read more"> 
                	<img style="display: none;" src="<?php echo base_url().'uploads/banners/'.$view_img; ?>" alt="<?php echo $img_name; ?>" title="#<?php echo $img_name; ?>"  /> 
                </a> 
                
                   
			  <?php $sk++;} } ?>
                  
                  
               </div>
                <!--<div id="banner7-caption1" class="banner7-caption nivo-html-caption nivo-caption">
                  <div class="timethai" style=" 
									position:absolute;
									top:0;
									left:0;
									background-color: rgba(38, 57, 64, 0.42);
									height:5px;
									-webkit-animation: myfirst 5000ms ease-in-out;
									-moz-animation: myfirst 5000ms ease-in-out;
									-ms-animation: myfirst 5000ms ease-in-out;
									animation: myfirst 5000ms ease-in-out;
								   
								   "> </div>
                  <div class="banner7-content slider-1 ">
                    <div class="bannerslideshow">
                      <h1 class="title1">New arrivals</h1>
                      <h2 class="title2" ><span>Apple wach 2015</span></h2>
                      <div class="banner7-des"> Watch Apple iPhone has more applications, 
                        the new iPad launch </div>
                      <div class="banner7-readmore"> <a href="#" title="shop now">Shop now</a> </div>
                    </div>
                  </div>
                </div>-->
                <!--<div id="banner7-caption2" class="banner7-caption nivo-html-caption nivo-caption">
                  <div class="timethai" style=" 
									position:absolute;
									top:0;
									left:0;
									background-color: rgba(38, 57, 64, 0.42);
									height:5px;
									-webkit-animation: myfirst 5000ms ease-in-out;
									-moz-animation: myfirst 5000ms ease-in-out;
									-ms-animation: myfirst 5000ms ease-in-out;
									animation: myfirst 5000ms ease-in-out;
								   
								   "> </div>
                  <div class="banner7-content slider-2 ">
                    <div class="bannerslideshow">
                      <h1 class="title1">New arrivals</h1>
                      <h2 class="title2" ><span>Adidas Originals</span></h2>
                      <div class="banner7-des"> Superstar 80's Deluxe White &amp; Black Trainers </div>
                      <div class="banner7-readmore"> <a href="#" title="shop now">Shop now</a> </div>
                    </div>
                  </div>
                </div>-->
                <script type="text/javascript">

			 $jq(window).load(function() {
				  $jq(document).off('mouseenter').on('mouseenter', '.pos-slideshow', function(e){
				  $jq('.ma-banner7-container .timethai').addClass('pos_hover');
			});

			$jq(document).off('mouseleave').on('mouseleave', '.pos-slideshow', function(e){
				$jq('.ma-banner7-container .timethai').removeClass('pos_hover');
			});
			});
            $jq(window).load(function() {
                $jq('#ma-inivoslider-banner7').nivoSlider({
                    effect: 'random',
                    slices: 15,
                    boxCols: 8,
                    boxRows: 4,
                    animSpeed: 600,
                    pauseTime: 5000,
                    startSlide: 0,
										                    controlNavThumbs: false,
                    pauseOnHover: true,
                    manualAdvance: false,
                    prevText: 'Prev',
                    nextText: 'Next',
                    afterLoad: function(){
                        $jq('.ma-loading').css("display","none");
                        //$jq('.banner7-title, .banner7-des, .banner7-readmore').css("left","100px") ;
                        },     
                    beforeChange: function(){ 
                        //$jq('.banner7-title, .banner7-des').css("left","-2000px" );
                        //$jq('.banner7-readmore').css("left","-2000px"); 
                    }, 
                    afterChange: function(){ 
                        //$jq('.banner7-title, .banner7-des, .banner7-readmore').css("left","40px") 
                    }
                });
            });
		</script> 
              </div>
            </div>
            <!-- end enable --> </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="column-right">
            <!-- <div class="red-bg text-center"> More Offline Sales </div>-->
            <!--<div class="image-block"> <a class="image-hover-effect" target="_blank" href="http://offline.alldiscountsale.com/"><img alt="image-block" class="img-responsive" src="<?php echo base_url(); ?>front/img/rht-banner.png"></a> </div>
            <div class="image-block"> </div>-->
			  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->


  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox"> 
  
  <?php
  $ads_banner = $this->front_model->getads();
  if($ads_banner)
  {
	  $s=1;
	  
	 foreach($ads_banner as $ads)
	 {
		$ads_url =  $ads->ads_url;
			?>
			<div class="item <?php if($s==1){echo "active";}?>">
			  <a target="_blank" href="<?php echo $ads_url;?>"><img src="<?php echo base_url(); ?>uploads/ads/<?php echo $ads->ads_image;?>" alt="ads<?php echo $s;?>"></a>
			  
			</div>
			<?php
			$s++;
	 }
  }
    ?>
  </div>


</div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-4 col-sm-3">
        <a target="_blank" href="<?php echo $ads_url;?>"><img src="<?php echo base_url(); ?>uploads/ads/youtube-homepage-ads-lg.jpg" width="280" height="264" alt="ads" class="img-responsive"></a>
        </div>
        
         <div class="col-md-4 col-sm-3">
          <a target="_blank" href="<?php echo $ads_url;?>"><img src="<?php echo base_url(); ?>uploads/ads/150804-adblocking.png" width="280" height="264" alt="ads" class="img-responsive"></a>
        </div>
        
         <div class="col-md-4 col-sm-3">  <a target="_blank" href="http://achadiscount.in"><img src="<?php echo base_url(); ?>uploads/ads/clickhere.gif" width="280" height="264" alt="ads" style="height:130px;" class="img-responsive"></a>
         <div style="font-size: 18px;   text-align: center; color: #ff4848;   vertical-align: middle;"> for  more offline discounts </div></div>
        
        </div>
        </div>
        
  </div>
</div>

</section>

<section class="category-tab">

<div class="container">

<h3 class="text-center text-uppercase"> BEST PRODUCTS </h3>
<div class="bor bg-red"></div>

	<div class="row">
		                                <div class="col-md-12 col-sm-12">
                                    <!-- Nav tabs --><div class="card" id="pro-tab">
                                    <div class="col-md-7 col-md-offset-3">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <!-- <li role="presentation"  class="active"><a href="#Latest-Products" aria-controls="profile" role="tab" data-toggle="tab">Latest Products</a></li>-->
                                      <!--  <li role="presentation"><a href="#Most-Viewed-Products" aria-controls="messages" role="tab" data-toggle="tab">Most Viewed Products</a></li>-->
                                    </ul>
                                    </div>
                                    
                                    <div class="clearfix"></div>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        
                                        <div role="tabpanel" class="tab-pane active" id="Latest-Products">
                                        <div class="row">
                                      
                                        <?php 
											
									$k=1;
									foreach($latestproducts as $lasproduct)
									{
										$product_idpp = $lasproduct->product_id;
										$getminpricesim_row = $this->front_model->getmin_price_product($product_idpp);
										if($lasproduct->product_image!='')
										{
											$fea_product_img =base_url().'uploads/products/'.$lasproduct->product_image;
											if (@getimagesize($fea_product_img)) {
											$fea_product_img = base_url().'uploads/products/'.$lasproduct->product_image;
											}
											else
											{
												$fea_product_img = base_url().'front/images/no_product.png';
											}
										}
										else{
											$fea_product_img =base_url().'front/images/no_product.png';
										}
										
									//get store name
									$getstoredetails = $this->front_model->get_store_details_byid($getminpricesim_row->store_id);
									if($getstoredetails)
									{
										if($getstoredetails->affiliate_logo)
										{
											$store_img =base_url().'uploads/affiliates/'.$getstoredetails->affiliate_logo;
											if (@getimagesize($store_img)) {
											$store_img = base_url().'uploads/affiliates/'.$getstoredetails->affiliate_logo;
											}
											else
											{
												$store_img = base_url().'front/img/rsz_default.jpg';
											}
										}
										else{
											$store_img =base_url().'front/img/rsz_default.jpg';
										}
										$feastore = $this->front_model->product_store_count($lasproduct->product_id);
										$offpercent =  ceil((($lasproduct->mrp-$lasproduct->product_price)/$lasproduct->mrp)*100);
									?>
                                            <div class="col-md-3 col-sm-3">
                                        
                                             <div class="cate_item">
                                              <div class="item-inner">
                                               
                                                <a title="<?php echo substr($lasproduct->product_name,0,20);?>" href="<?php echo base_url().'cashback/product_details/'.$lasproduct->product_url;?>" class="bigpic_21_tabcategory product_image">
                                                <img alt="<?php echo $lasproduct->product_name;?>" src="<?php echo $fea_product_img;?>" style="width:auto; height:200px;" class="img-responsive center-block"> <span class="new">New</span> </a>
                                                
                                                <div class="grey-bg clearfix">
                                                <div class="col-md-6 col-sm-6">
                                                <a href="<?php echo base_url().'cashback/visit_product/'.$getminpricesim_row->pp_id.'/'.$getminpricesim_row->product_id;?>" target="_blank">                                               
                                                <img class="img-responsive pull-left" src="<?php echo $store_img;?>"></a></div>
                                                <?php 
												if($offpercent!=0||$offpercent!='')
												{
												?>
                                                <div class="col-md-6 col-sm-6">
                                                  <h4 class="pull-right text-uppercase fnt-18"> <?php echo $offpercent;?>% Off</h4></div>
                                               
                                                <?php
												}
												?>
                                                 </div>
                                                <div class="product-content">
                                                  <div class="ratings">
                                                    <div itemtype="" itemscope="" itemprop="aggregateRating" class="comments_note">
                                                      <div class="star_content text-center clearfix">
                                                       <?php
														 $store_rating =$this->front_model->get_storerating($lasproduct->store_id);
														if($store_rating)
														{
															 for($i=1;$i<=$store_rating->rate;$i++)
															 {
																echo '<div class="star fa fa-star"></div>';
															 }
														}
													?>
                                                        <meta content="0" itemprop="worstRating">
                                                        <meta content="2" itemprop="ratingValue">
                                                        <meta content="5" itemprop="bestRating">
                                                      </div>
                                                    </div>
                                                   
                                                  </div>
                                                  <div class="price-box text-center"> <span class="price product-price" style="font-size:14px;"> 
                                                    <?php echo DEFAULT_CURRENCY." ".number_format(($lasproduct->product_price),2);?>
                                                  </span> <span class="price product-price clr-grey" style="font-size:14px;">
                                                    <amall>  <?php echo DEFAULT_CURRENCY." ".number_format(($lasproduct->mrp),2);?> </amall>
                                                    </span></div>
                                                </div>
                                                 
                                              </div>
                                              <div class="red-box"> <a style="color:white; text-decoration:none;" title="<?php echo substr($lasproduct->product_name,0,20);?>" href="<?php echo base_url().'cashback/product_details/'.$lasproduct->product_url;?>">Available From <?php echo $feastore['count'];?> Stores</a></div>
                                            </div>
                                        
                                        </div>
                                            <?php
									
										}
									$k++;
									}
										
										?>
                                        
                                      
                                        </div>
                                        </div>
                                       
                                    </div>
</div>
                                </div>
	</div>

</div>

</section>

<section class="compare-sec">

<div class="container">

<h3 class="text-center text-uppercase"> COMPARE PRICES FROM </h3>
<div class="bor bg-red"></div>

<div class="row">
		<div class="col-md-12">
                <div id="Carousel" class="carousel slide">
                <!-- Carousel items -->
                <div class="carousel-inner">
                <?php
				$k=0;
				foreach($scrapping_list as $scrapp)
				{
					if($k%4==0)
					{
						?>
                        <div class="item <?php if($k==0){echo "active";}?>">
                		<div class="row">
                        <?php
					}
					?>
                    <div class="col-md-3"><a style="text-align:center;" href="javascript:void(0)" class="thumbnail"><p><img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $scrapp->affiliate_logo;?>" alt="Image" style="max-width:100%;"></p></a></div>
                    <?php					
					$k++;
					if($k%4==0){
						?>
                         </div>
                         </div>
                        <?php
					}	
				}
				?>
                    
              
                 
              
                 
                </div><!--.carousel-inner-->
                <!--  <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                  <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>-->
                </div><!--.Carousel-->
                 
		</div>
	</div>

</div>

</section>

<section class="bot-top">

<div class="container">

<div class="row">

<div class="col-md-4 col-sm-4">

<h3 class="text-uppercase"> Popular Price List </h3>
<div class="bor-lft bg-red"></div>

<ul class="list-inline clearfix pro-list" style="max-height:none !important">
<?php
foreach($topbrands as $topbrad)
{
	?>
    <li><a href="<?php echo base_url();?>cashback/products/<?php echo $topbrad->brand_url;?>_brands#brands=<?php echo $topbrad->brand_url;?>"><img src="<?php echo base_url(); ?>uploads/brands/<?php echo $topbrad->brand_image;?>" class="img-responsive" alt="<?php echo $topbrad->brand_name;?>"> </a></li>

    <?php
}

?>


</ul>

</div>

<div class="col-md-8 col-sm-8">

<div class="row">
            <div class="col-md-9">
                <h3 class="text-uppercase"> Popular Mobile Phones </h3>
<div class="bor-lft bg-red"></div>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-angle-left btn btn-default " href="#carousel-example" data-slide="prev"></a>
                    <a class="right  fa fa-angle-right btn btn-default" href="#carousel-example"  data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
            
            <?php
			$s = 0;
			foreach($top_products_home as $topmobiles)
			{
				$product_idpp_mob = $topmobiles->product_id;
				$getminpricesim_row = $this->front_model->getmin_price_product($product_idpp_mob);
				if($topmobiles->product_image!='')
				{
					$fea_product_img =base_url().'uploads/products/'.$topmobiles->product_image;
					if (@getimagesize($fea_product_img)) {
						$fea_product_img = base_url().'uploads/products/'.$topmobiles->product_image;
						}
						else
						{
							$fea_product_img = base_url().'front/images/no_product.png';
						}
				}
				else{
					$fea_product_img =base_url().'front/images/no_product.png';
				}
				
			//get store name
			$getstoredetails = $this->front_model->get_store_details_byid($getminpricesim_row->store_id);
			if($getstoredetails)
			{
				if($getstoredetails->affiliate_logo)
				{
					$store_img =base_url().'uploads/affiliates/'.$getstoredetails->affiliate_logo;
				}
				else{
					$store_img =base_url().'front/img/rsz_default.jpg';
				}
				$feastore = $this->front_model->product_store_count($topmobiles->product_id);
				$offpercent =  ceil((($topmobiles->mrp-$topmobiles->product_price)/$topmobiles->mrp)*100);
				
				if($s%3==0)
					{
						?>
                        <div class="item <?php if($s==0){echo "active";}?>">
                		<div class="row">
                        <?php
					}
					?>
                    <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                     <a href="<?php echo base_url().'cashback/product_details/'.$topmobiles->product_url;?>" class=""> <img src="<?php echo $fea_product_img;?>" class="img-responsive" alt="<?php echo $topmobiles->product_name;?>" style="width:100px;height:200px;" /></a>
                                </div>
                                <div class="info">                                
                                <p><?php echo substr($topmobiles->product_name,0,40);?></p>
                                    <div class="row">
                                        <div class="price col-md-6"  style="padding:0 10px;" >
                                            
                                            <h5 class="price-text-color" style="font-size:14px; margin-top:10px; font-weight:bold;">
                                            
                                            <?php echo DEFAULT_CURRENCY." ".number_format(($topmobiles->min_price),2);?>
							</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                         <?php
														 $store_rating =$this->front_model->get_storerating($topmobiles->store_id);
														if($store_rating)
														{
															 for($i=1;$i<=$store_rating->rate;$i++)
															 {
																echo '<i class="fa fa-star"></i>';
															 }
														}
													?>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                       
                                        <p class="text-center">
                                            <a href="<?php echo base_url().'cashback/product_details/'.$topmobiles->product_url;?>" class="btn btn-danger bor-rad-0">View Product</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                     <?php					
					$s++;
					if($s%3==0){
						?>
                         </div>
                         </div>
                        <?php
						}
					}	
				}
				?>
            
            </div>
        </div>

</div>

</div>

</div>

</section>




<?php

//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>

<?php $this->load->view('front/js_scripts');?>

<script>
$('.nivo-main-image').on('click', function(){
	alert('aaa');
});
</script>
  
</body>
</html>
