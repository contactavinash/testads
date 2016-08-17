<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Wishlist - <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<?php $this->load->view('front/css_script');?>
<style>
.containerimg {
    width: auto;
    height: 150px;
}

/* resize images */
.containerimg img {
    height: 150px;
 	width: auto;
}
</style>


</head>

<body>
<?php $this->load->view('front/header');?>

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
        
        <?php $this->load->view('front/user_menu'); ?>
        
          <div id="center_column" class="center_column col-xs-12 col-sm-9">
            <h2 class="text-center text-uppercase" style="font-weight:bold"> 
				Wishlist
                </h2>
                
      
     <div class="bor bg-red"></div>
     
     
        <div class="content_sortPagiBar bor-no mar-no clearfix " style="position:relative" >
            
            <div class="displayGif loaderajaxs" id="loading-gif" style="z-index: 2147483647; ">
			  <div class="page-title category-title">
				<h1>Wishlist</h1>
			  </div>
			  <div class="toolbar bor-no mar-no">
				
				<!-- Products list -->
				<ul class="product_list grid row mar-no" id="ajax_product_list">
                
                
                
                
              <!--  
                <ul class="product_list grid row mar-no">-->
				<?php
			 if($favoriteslist)
			 { 
				foreach ($favoriteslist as $prod)
				{ 
					$store_id = $prod->store_id;
					$prod_id = $prod->product_id;
					$prod_url = $prod->product_url;
					$cashback_price = $prod->cashback_price;
					$reward_points  = $prod->reward_points;			
					$min_price = $prod->min_price;
					$max_price = $prod->max_price;
					$offer_price = (($max_price - $min_price)/$max_price)*100;
					$offer = floor($max_price - $min_price);
					$percentage = number_format($offer_price, 1); 
					$store = $this->front_model->product_store_count($prod_id);
					$pro_title = $prod->product_name;
					// echo $pos = strpos($pro_title, ' ', 15);
					// exit;
					$title = substr($pro_title, 0 ,25);
					
					$feature = unserialize($prod->specification_extra);
					if($prod->product_image){
						$image = base_url().'uploads/products/'.$prod->product_image;
						if (@getimagesize($image)) {
						$image = base_url().'uploads/products/'.$prod->product_image;
						}
						else
						{
							$image = base_url().'front/images/no_product.png';
						}
						
					}else{
						$image = base_url().'front/images/no_product.png';
					}
					$offpercent =  ceil((($prod->mrp-$min_price)/$prod->mrp)*100);
					
					$get_storedetails = $this->front_model->get_details_from_id($store_id,'affiliates','affiliate_id');
					 $cpercent = $get_storedetails->cashback_percentage;
					$cashbackpercent = '';
					if($cpercent!=0 || $cpercent!="")
					{
						if($get_storedetails->affiliate_cashback_type=='Percentage')
						{
							$cashbackpercent = $cpercent."%";
						}
						else
						{
							$cashbackpercent = DEFAULT_CURRENCY.' '.$cpercent;
						}
					}
					
					
		  ?>
		  
		  <li class="col-xs-12 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line" id="favr_<?php echo $prod_id; ?>">
			<div class="product-container">
			  <div class="left-block">
				<div class="blu-box"><a style="color:#fff;" href="<?php echo base_url(); ?>product/<?php echo $prod_url; ?>"/> Available From <?php echo $store['count']; ?> Stores</a></div>
				<?php
				if($this->session->userdata('user_id')=="")
				{ ?>
					<a title="Add to Favorite" href="javascript:void(0);"  data-toggle="modal" data-target="#myModal"><span style="float: right; padding: 12px; position:absolute;" ><i class="fa fa-heart"></i></span></a>
				<?php
				}else 
				{
					$chk_fav = $this->front_model->check_favorite($prod_id);
					if(!$chk_fav)
					{
				?>
					<a title="Add to Favorite" class="fav_<?php echo $prod_id; ?>" href="javascript:void(0);" onClick="return addfav('<?php echo $prod_id; ?>');"><span style="float: none; padding: 12px; display:inline-block; height:30px;"><i class="fa fa-heart"></i></span></a>
				<?php } else {  ?>
					<a href="javascript:void(0);" onClick="return removfav('<?php echo $prod_id; ?>');" ><span style="float: none; padding: 12px; display:inline-block; height:30px;" title="Added to Favorites"><i style="color:#FF0000;" class="fa fa-heart"></i></span></a>	
				<?php } 
				} ?>
				
				
			   <div class="containerimg">
				<a class ="bigpic_21_tabcategory product_image" href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" title="<?php echo $pro_title; ?>">
				<img class="img-responsive center-block" src="<?php echo $image; ?>" />
				</a>
				
				</div>
				
				 </div>
			  <div class="right-block">
				<div class="product-content">
				  <h5 class="product-name text-uppercase text-center" style="line-height:3px;"><a href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" ><?php echo $title; ?></a></h5>
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
						<meta itemprop="worstRating" content = "0" />
						<meta itemprop="ratingValue" content = "2" />
						<meta itemprop="bestRating" content = "5" />
					  <!--  <p class="pull-right"><?php echo $store_rating->counting;?> Review(s)</p>-->
					  <?php
						}
						?>
					  <?php
					  if($offpercent>0&&$offpercent!=''){?>
					  <span class="price-text-color pull-right" style="font-weight: bold; font-size: 14px; color:#e6000c;"> <?php echo $offpercent;?>% Off </span>
					  <?php } ?>
				  
					  </div>
					  
					</div>
				  </div>
				  <div  class="price-box bor-ylw pad-bot5" style="height:50px;" > <span class="price product-price" style="font-size:17px;"> 
				  
				  <?php //echo DEFAULT_CURRENCY.' '.floor($min_price); ?>
				<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>
				  </span> <span class="price product-price clr-grey" style="font-size:17px;"><small> 
				  
				  <?php echo DEFAULT_CURRENCY.' '.number_format($prod->mrp,2);?>
				  
				  </small> </span> 
				  
				  
				   </div>
				  <ul class="item-info-list" style="height:75px;">
				  <?php
					$key_featurearray =  explode(",",$prod->key_feature);
					if($key_featurearray){
					$key_featurearray = array_slice($key_featurearray, 0, 4);
					foreach($key_featurearray as $features)
					{if(!$features){continue;}?>
						 <li style="font-size:12px;"><i class="fa fa-chevron-right" ></i> <?php echo $features;?></li>
					<?php }}
				  ?>
				   
				  </ul>
				</div>
			  </div>
			  <div class="list-det clearfix mar-top mar-bot-no" style="height:60px;">
				<h4 class="text-primary pull-left"><strong><?php  if($cashbackpercent!=""){echo $cashbackpercent;?> cash back <?php }?></strong></h4>
				<?php
				$coinvalue = round(($min_price/COINVALUE));
				?>
		<h5 class="pull-right"><strong><?php echo $coinvalue;?>points</strong></h5>
			  </div>
			  <a href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>">
			  <div class="checkbox check-bg text-center">
			  <label>View Products</label>
			</div></a>
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
<script>
function removfav(id){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>cashback/remove_favorite',
		dataType:"json",
		data:"product_id="+id,
		success:function(msg){
			if(msg==1)
			{
				$('#favr_'+id).hide();
			}
		}
	});
}
</script>
</body>
</html>
