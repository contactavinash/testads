<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - Favourite</title>
<?php $this->load->view('front/css_script');?>
</head>

<body>
<?php $this->load->view('front/header');?>

<!-- header ends here --->

<!--<section class="breadcrumb-sec clearfix">
  <div class="container">
    <div class="breadcrumb clearfix"> <a href="#" class="home">home</a> <span class="navigation-pipe">&gt;</span> Favourite</div>
  </div>
</section>-->

<!--- breadcrumb sec ends here --->

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div id="center_column" class="center_column col-xs-12 col-sm-12">
            <div class="content_scene_cat">
              <div class="content_scene_cat_bg"> <img class="img-responsive" src="<?php echo base_url();?>front/img/pro-slide-img.png" alt=""/> </div>
            </div>
            <div class="content_sortPagiBar bor-no mar-no clearfix">
              <div class="page-title category-title">
                <h1>Favourite Products</h1>
              </div>
              <div class="toolbar bor-no mar-no">
                
                
                <!-- Products list -->
                <ul class="product_list grid row mar-no">
				<?php
			 if($favoriteslist)
			 { 
				foreach ($favoriteslist as $value)
				{ 
					$store_id = $value->store_id;
					$cashback_price = $value->cashback_price;
					$reward_points  = $value->reward_points;
					$min_price = $value->min_price;
					$max_price = $value->max_price;
					$offer_price = (($max_price - $min_price)/$max_price)*100;
					$offer = floor($max_price - $min_price);
					$percentage = number_format($offer_price, 1); 
					$pro_title = $value->product_name;
					$pos = strpos($pro_title, ' ', 15);
					$title = substr($pro_title, 0 ,$pos);
					
					$feastore = $this->front_model->product_store_count($value->product_id);
					$feature = unserialize($value->specification_extra);
					if($value->product_image){
						$image = base_url().'uploads/products/'.$value->product_image;
						if (@getimagesize($image)) {
						$image = base_url().'uploads/products/'.$value->product_image;
						}
						else
						{
							$image = base_url().'front/images/no_product.png';
						}
					}else{
						$image = base_url().'front/images/no_product.png';
					}
				?>
                  <li class="col-xs-12 col-sm-6 col-md-3 first-in-line first-item-of-tablet-line first-item-of-mobile-line">
                    <div class="product-container">
                      <div class="left-block">
                        <div class="blu-box"> Available From <?php echo $feastore['count'];?> Stores</div>
                        <a class ="bigpic_21_tabcategory product_image" href="<?php echo base_url();?>cashback/product_details/<?php echo $value->product_url;?>" title="<?php echo $title?>"><img class="img-responsive center-block" src="<?php echo $image;?>" width="80" height="80" /> </a> </div>
                      <div class="right-block">
                        <div class="product-content">
                          <h5 class="product-name text-uppercase"><a href="<?php echo base_url();?>cashback/product_details/<?php echo $value->product_url;?>" ><?php echo $title?></a></h5>
                          <div class="ratings bor-ylw">
                            <div class="comments_note" itemprop="aggregateRating" itemscope itemtype="">
                              <div class="star_content clearfix">
                                <?php
								 $store_rating =$this->front_model->get_storerating($store_id);
								if($store_rating)
								{
									 for($i=1;$i<=$store_rating->rate;$i++)
									 {
										echo '<div class="star fa fa-star"></div>';
									 }
								?>
                              </div>
                              <p class="nb-comments"><?php echo $store_rating->counting;?> Review(s)</p>
							<?php }?>
                            </div>
                          </div>
                          <div  class="price-box bor-ylw pad-bot5" > <span class="price product-price"><?php echo DEFAULT_CURRENCY.' '.floor($min_price); ?></span> <span class="price product-price clr-grey"><small><?php echo DEFAULT_CURRENCY.' '.floor($max_price); ?> </small> </span> <!--<span class="price product-price clr-blk pull-right"> 5% Off </span>-->
						  </div>
						  <?php if($feature)
						  { ?>   
							  <ul class="item-info-list">
							<?php //print_r($feature);
								$ext = 0;
								foreach($feature as $feature){
									if($ext < 5){
										echo '<li class="info-item">'.$feature.'</li>';
									}
									$ext++;
								}
							?>
							  </ul>
						  <?php 
						  } ?>
                        </div>
                      </div>
					<?php if($cashback_price !='' || $reward_points != ''){ ?>
					<div class="grey-bg clearfix mar-top mar-bot-no">
					  <?php if($cashback_price){ ?>
						<h4 class="text-primary pull-left"><strong><?php echo DEFAULT_CURRENCY.' '.$cashback_price; ?> cash back</strong></h4>
						<?php } //if($reward_points){ 
							$coinvalue = round(($min_price/COINVALUE));
						?>
						<h5 class="pull-right"><strong><?php echo $coinvalue; ?>points</strong></h5>
					<?php }else{ echo ''; } ?> 
					</div>
					<a href="<?php echo base_url();?>cashback/product_details/<?php echo $value->product_url;?>"><div class="checkbox check-bg text-center">View Product</div> </a>
                    </div>
                  </li>
                <?php
				}
			}
			else{?>
				<div class="row">
				  <div class="alert alert-danger bs-alert-old-docs">
					<center>
					  <strong>No favorites!</strong>
					</center>
				  </div>
				</div>
			<?php		
			}?>
                </ul>
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
</body>
</html>
