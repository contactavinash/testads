
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php  $admindetailss = $this->front_model->getadmindetails();?>
<title><?php echo $product->product_name;?> - <?php echo $admindetailss[0]->site_name; ?></title>
<?php $this->load->view('front/css_script');

?>
<link rel="stylesheet" href="<?php echo base_url();?>front/css/product_zoom.css">

<style>
.zoomWindow
{
	/*height:300px !important;*/
}
.price-inner li
{
	padding:0 !important;
}

.error
{
	color:#ff0000;
}
.required_field
{
 color:#ff0000;
}

#errors_set
{
	color:red;
}
.rating {
    float:left;
    border:none;
	margin-left: 68px;
}
.rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0, 0, 0, 0);
}
.rating:not(:checked) > label {
    float:right;
    width:1em;
    padding:0 .1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:100%;
    line-height:1.2;
    color:#ddd;
}
.rating:not(:checked) > label:before {
    /* content:'★ '; */
    content:"\f005";
	font-family: FontAwesome;
}
.rating > input:checked ~ label {
    color: #f70;
}
.rating:not(:checked) > label:hover, .rating:not(:checked) > label:hover ~ label {
    color: gold;
}
.rating > input:checked + label:hover, .rating > input:checked + label:hover ~ label, .rating > input:checked ~ label:hover, .rating > input:checked ~ label:hover ~ label, .rating > label:hover ~ input:checked ~ label {
    color: #ea0;
}
.rating > label:active {
    position:relative;
}
.addi-content {
    position: relative;
}
.addtional-content {
    background-color: #ffffff;
    border: 1px solid #dddddd;
    display: block;
    height: 100;
    left: -37px;
    opacity: 0;
    position: absolute;
    top: 50px;
    transition: all 0.3s ease 0s;
    visibility: hidden;
    width: 215px;
    z-index: 3;
}


.addtional-content::after {
    border-bottom: 8px solid #fff;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    content: "";
    left: 55px;
    position: absolute;
    top: -8px;
    z-index: 1;
}

.addi-content:hover .addtional-content {
    box-shadow: 0 0 4px #e4e4e4;
    display: block;
    min-height: 95px;
    opacity: 1;
    top: 30px;
    transition: all 0.3s ease 0s;
    visibility: visible;
}
.product-image-zoom.img-responsive {
   display: inline-block;
    height: auto !important;
    max-height: 400px;
    max-width: 200px;
    width: 100%;
}

</style>

</head>
<body> 

<?php $this->load->view('front/header');?>

 <div class="container">
 <div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb"> 
	<li><a href="<?php echo base_url(); ?>">Home</a></li> 
	<?php if($bcmps->cate1!=""){?>
		<li><a href="<?php echo base_url(); ?>category/<?php echo $bcmps->cate1; ?>"><?php echo $bcmps->cate1; ?></a></li>
		
	<?php } ?>
	
	<?php if($bcmps->brand_url!=""){?>
		<li><a href="<?php echo base_url(); ?>products/<?php echo $bcmps->brand_url; ?>_brands/<?php echo $bcmps->cate1.'_0'; ?>#brands=<?php echo $bcmps->brand_url; ?>#<?php echo $bcmps->cate1.'_0'; ?>"><?php echo $bcmps->brand_url; ?></a></li>
		
	<?php } ?>
	<?php if($bcmps->cate1!=""){?>
		<li class="active"><?php echo substr($bcmps->product_name,0,30).'...'; ?></li>
		
	<?php } ?>
	
	
	</ol>
  </div>
</div>
    <div class="row">
    
    
  
  <!--- breadcrumb sec ends here --->
  <div class="col-md-5 col-sm-12 col-xs-12 image-container product-img-box">
    
    <div class="product-view product-info" >
                    <div class="product-essential row">
                     <form action="" class="form-horizontal" method="post" id="product_addtocart_form">
                        <input name="form_key" type="hidden" value="U1shNP3FQxwMogS5" />
                        <div class="no-display">
                          <input type="hidden" name="product" value="77" />
                          <input type="hidden" name="related_product" id="related-products-field" value="" />
                        </div>
                    
    <div class=" image-container product-img-box">
                        
                        <div class="image" style="height:400px;"> 
                        
                        <a href="javascript:void(0);" title="Fashion excepteur occaecat cupidatat ipsum" class="colorbox"> 
                        <?php
                        $img = base_url()."uploads/products/".$gallery[0]->image;
						if (@getimagesize($img)) {
						$img = base_url().'uploads/products/'.$gallery[0]->image;
						}
						else
						{	$img = base_url().'front/images/no_product.png';
						}
						
                        
                        ?>
                        <img id="image-main" itemprop="image" src="<?php echo $img;?>" alt="<?php echo $product->product_name;?>" title="<?php echo $product->product_name;?>" data-zoom-image="<?php echo $img;?>" class="product-image-zoom img-responsive" /> 
                        
                        
                        </a>
                         </div> 
                         
                          
                          <div id="image-additional" class="image-additional slide carousel more-views">
                            <div class="carousel-inner" id="image-gallery-zoom"> 
                           
                           <?php
						   $i=0;
//						   print_r($gallery);
							foreach($gallery as $img){
								$imgag = base_url()."uploads/products/".$img->image;
								if (@getimagesize($imgag)) {
								$img = base_url()."uploads/products/".$img->image;
								}
								else
								{
									$img = base_url().'front/images/no_product.png';
								}
								
								if($i%4==0)
								{
								?>
								<div class="item row clearfix no-margin">
								<?php
								}
								?> 
                                <a class="colorbox col-xs-3" href="#" title="" data-zoom-image="<?php echo $img;?>" data-image="<?php echo $img;?>"> 
                                
                             <div  class="thumb" style="background:url(<?php echo $img;?>)">  <!-- <img id="image-0"  src="<?php echo $img;?>"  title="" alt="<?php echo $product->product_name;?>" data-zoom-image="<?php echo $img;?>" class="product-image-zoom img-responsive" />--></div> </a>                                 
                                <?php
								$i++;
								if($i%4==0 || $i==count($gallery))
								{
								?>
								</div>
								
								<?php
								}
								
								
							}
							
						   ?>
                           
                             
                              
                              

 
</div>
                            <!-- Controls -->
                            <div class="left carousel-control" style="border:0px solid #ffffff" href="#image-additional" data-slide="next"> <i class="fa fa-angle-left"></i> </div>
                            <div class="right carousel-control" style="border:0px solid #ffffff" href="#image-additional" data-slide="prev"> <i class="fa fa-angle-right"></i> </div>
                          </div>
                        </div>
                        
     </div>
     </div>    
     </form>               
                        
    
    
    
  </div>
  <div class="col-md-7 col-sm-7">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-uppercase">  <?php echo $product->product_name;?>  </h3>
        <div class="bor-lft bg-red"></div>
      </div>
     <!-- <div class="col-md-3"> 
        <div class="controls pull-right hidden-xs"> <a class="left fa fa-angle-left btn btn-default " href="#carousel-example" data-slide="prev"></a> <a class="right  fa fa-angle-right btn btn-default" href="#carousel-example"  data-slide="next"></a> </div>
      </div>-->
    </div>
    <div id="carousel-example" class="carousel slide hidden-xs " data-ride="carousel">
      
      <div class="col-md-2 yellow-colr">
	<?php

	if($avgrate->rate)
	{
		
		for($i=0;$i<$avgrate->rate;$i++)
		{
			echo '<i class="fa fa-star"></i>';
		}
	}
	else
	{
		for($i=0;$i<5;$i++)
		{
			echo '<i class="gry-star fa fa-star"></i>';
		}
	}
	?>
      

       </div>
      <div class=" col-md-6">
        <p><?php if($count_rating->counting)echo $count_rating->counting;else{echo 0;}?> customers reviews</p>
      </div>
      <!-- Wrapper for slides -->
      <div class="carousel-inner ">
      
       <?php if($store){
								$store_img = base_url().'uploads/affiliates/'.$store->affiliate_logo;
		}	
//echo $product->product_id;		
		$scrappingrow = $this->front_model->getscrapping_id($min_details->store_id,$product->product_id);
		// print_r($scrappingrow);
		// exit;
		$storec = $this->front_model->product_store_count($product->product_id);
		if($product->affiliate_url)
			$product_url = $product->affiliate_url;
		else
			$product_url = $product->product_url;
		
	 ?>
	 <div class="col-sm-7" style="display:<?php if($price_compare==1){echo 'block';}else{echo 'none';}; ?>">
              <div class="col-item">
			  <p align="center"><?php if($price_compare==1){echo "lowest price in Online";}?></p>
                <div style="margin-left: -5px;" class="photo col-sm-6 "> <img src="<?php echo base_url(); ?>uploads/affiliates/<?php  echo$min_details->affiliate_logo;?>" class="img-responsive" alt="<?php echo $product->product_name;?>" /> </div>
                <div class="info" >
                  <div class="">
                    <div class="price12">
                      <h5 style="margin-top:9px;" class="price-text-color"><?php echo DEFAULT_CURRENCY.' '.number_format($min_details->product_price,2);?>
					  
					 </h5>
					 
                    </div>
									
                  </div>
                  <div  class=" clear-left">
                    <p class="" style="float:left;margin-right:20px;">
                    <?php  $url1=base_url()."cashback/visit_product/".$min_details->pp_id."/".$product->product_id; ?>
                    <a  <?php if($user_id==""){?> data-toggle="modal" data-target="#myModal" onclick="return get_url('<?php echo $url1; ?>');"<?php }else{?> target="_blank" href="<?php echo base_url(); ?>cashback/visit_product/<?php echo $min_details->pp_id;?>/<?php echo $product->product_id;?>"<?php } ?> class="btn btn-danger bor-rad-0 ">Go to Store</a>
                    </p>
						<p>
					<a data-target="#detail-pop" data-toggle="modal" class="btn btn-primary bor-rad-0 " href="javascript:void(0);">Price drop alert</a>
					</p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
              </div>
            </div>
      <div class="col-sm-4" style="display:<?php if($price_compare==0){echo 'block';}else{echo 'none';}; ?>">
              <div class="col-item">
			  <p align="center">lowest price in Online</p>
                <div class="photo col-sm-12 ">
					 <img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $min_details->affiliate_logo;?>" class="img-responsive" alt="<?php echo $product->product_name;?>" /> </div>
                <div class="info" >
                  <div class="">
                    <div class="price12">
                      <h5 class="price-text-color text-center"><?php echo DEFAULT_CURRENCY.' '.number_format($min_details->product_price,2);?>
					  
					 </h5>
                    </div>
                  </div>
                  <div class=" clear-left">
                    <p class="text-center">
                    <?php  $url1=base_url()."visit_product/".$min_details->pp_id."/".$product->product_id; ?>
                    <a  <?php if($user_id==""){?> data-toggle="modal" data-target="#myModal" onclick="return get_url('<?php echo $url1; ?>');"<?php }else{?> target="_blank" href="<?php echo base_url(); ?>visit_product/<?php echo $min_details->pp_id;?>/<?php echo $product->product_id;?>"<?php } ?> class="btn btn-danger bor-rad-0 mar-top10">Go to Store</a>
                    </p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
              </div>
            </div>
			<?php if($get_offline_price){ ?>
            <div class="col-sm-4" style="display:<?php if($price_compare==0){echo 'block';}else{echo 'none';}; ?>">
              <div class="col-item" >
			  <p align="center">lowest price in Offline</p>
			  <?php 
			/*  foreach($get_offline_stores as $oflne)
					  	{
							$oflne_price=$oflne->product_price;
						}*/
						//print_r($get_offline_price);die;
						$add=25;
						//$new_oflne_price=$oflne_price+$add;
						$new_oflne_price=$get_offline_price->price;
						
						//$strnale1 = str_replace(' ','+',$offlinestores[0]['offline_store_name']).'+'.$offlinestores[0]['replaced_address'];
						$strnale1 = str_replace(' ','+',$get_offline_price->store_name);
						
						//echo $strnale1;die;
			  ?>
                <div class="photo col-sm-12 "> 
                <img src="<?php echo base_url() ?>uploads/offline_stores/<?php echo $get_offline_price->store_logo;?>" class="img-responsive" alt="<?php echo $get_offline_price->product_name;?>" /> 
                </div>
                <div class="info" >
                  <div class="">
                    <div class="price12">
                      <h5 class="price-text-color text-center"><?php echo DEFAULT_CURRENCY.' '.number_format($new_oflne_price,2);?>
					 </h5>
                    </div>
                  </div>
                  <div class=" clear-left">
                    <p class="text-center">
					<?php  $url1=base_url()."visit_product/".$scrappingrow->pp_id."/".$product->product_id; ?>
                     <a href="javascript:void(0);"
 NAME="View map"  class="btn btn-danger bor-rad-no" title=" Map "
 onClick=window.open("https://www.google.com/maps?q=<?php echo $strnale1;?>","Ratting","width=650,height=600,0,status=0");>
 View Store
 </a>
                    </p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
              </div>
            </div><?php } ?>
            <div class="col-sm-4 pad-no" style="display:<?php if($price_compare==0){echo 'block';}else{echo 'none';}; ?>">

              <div class="col-item">
                <div class="photo">
                <div class="price05">
                      <h5 class="text-center"> <?php  echo $storec['count'];?> Stores</h5>
                    </div>
                    
                     <div class="clear-left">
                    <p class="text-center"> <a href="#User_Profile" class="btn btn-danger bor-rad-0">View prices</a></p>
                  </div>
                  
                  
                    
                    
                 <!-- <p style="text-align:center;"><?php echo count($comparison_details);?> Online Stores</p>
                <a style="text-align:center;" class="btn btn-danger bor-rad-0 mar-top10" href="http://localhost/projects/alldiscountsale/cashback/visit_product/80/1">View prices</a>-->
                </div>
                <div class="info" style="padding:0;margin:12px;">
                  <div class="">
                    <div class="new_price">
                      <h5 class="text-center mar-top30"> Price to High ?</h5>
                    </div>
                  </div>
                  <div class="clear-left">
                    <p class="text-center"> <a href="javascript:void(0);" class="btn btn-primary bor-rad-0 " data-toggle="modal" data-target="#detail-pop">Price drop alert</a></p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
              </div>
            </div>
       
                        
      
   
      
      </div>
    
        <div class="clearfix"></div>
     
      <?php
			$key_featurearray =  explode(",",$product->key_feature);
			//print_r($key_featurearray);
			if($key_featurearray){
			array_filter($key_featurearray);
			$key_featurearray = array_slice($key_featurearray, 0, 6);			
			$at=0;
			foreach($key_featurearray as $features)
			{if(!$features){continue;}
			if($at==0)
			{
				?>
                 <h4 class="text-center mar-top10">Quick Overview</h4>
      			<div class="bor bg-red"></div>
				<?php
			}
			if($at%3==0)
			{	
			?>
         		<div class="col-md-6 col-sm-6">
       			<ul class="pad-li">
         	<?php
			}
		  	?>
              <li><i class="fa fa-chevron-right "></i> <?php echo $features;?></li>
		    <?php
			 $at++;
			if($at%3==0 || $at==count($key_featurearray))
			{
			?>
                </ul>
    		  	</div>
          	<?php
			}
		  }}
		  ?>
          
      </div>
      <div class="clearfix"></div>
      <div class="coupon-bot-buttons  ">
    
     <?php
		if($this->session->userdata('user_id')=="")
		{ ?>
       <a title="Add to Favorite" href="javascript:void(0);"  data-toggle="modal" data-target="#myModal">  <button type="button" class="btn btn-warning bor-rad-no mar-top10"><i class="fa fa-heart pad-rht"></i> Add to Wishlist</button></a>
      
		<?php
		}else 
		{
			$chk_fav = $this->front_model->check_favorite($product->product_id);
			if(!$chk_fav)
			{
				
		?>
          <a title="Add to Favorite" class="fav_<?php echo $product->product_id; ?>" href="javascript:void(0);" >  <button type="button" class="btn btn-warning bor-rad-no mar-top10" onClick="return addfav('<?php echo $product->product_id; ?>');"><i class="fa fa-heart pad-rht"></i> Add to Wishlist</button></a>
     
		<?php } else { 
		 ?>
        <a title="Add to Favorite" class="fav_<?php echo $product->product_id; ?>" href="javascript:void(0);" >
		<button class="btn btn-warning bor-rad-no mar-top10" type="button" onClick="return removfav('<?php echo $product->product_id; ?>');">
        <i style="color:#FF0000;" class="fa fa-heart"></i> 
       Remove from Wishlist
        </button></a>
		<?php } 
		} ?>
         
		 
        <?php 	$prod_id =  $product->product_id;
				$title =$product->product_name;
				$productimage = $product->product_image;

				if($productimage){
				$image = base_url().'uploads/products/'.$productimage;
				if (@getimagesize($image)) {
						$image = base_url().'uploads/products/'.$productimage;
					}
					else
					{
						$image = base_url().'front/images/no_product.png';
					}				
				}else{
					$image = base_url().'front/images/no_product.png';
				}
		?>
		<input type="hidden" name="catesupid" value="<?php echo $cate_id_id;?>" id="catesupid">

	    <button type="button" class="btn btn-danger bor-rad-no mar-top10 compareicon compare_list" style="cursor:pointer;" id="compareproducttd_<?php echo $prod_id;?>" title="Add to compare" data-img_url="<?php echo $image; ?>" data-link_url="<?php echo base_url(); ?>product_details/<?php echo $pro_url; ?>" data-link_set_url="<?php echo $pro_url; ?>"data-title="<?php echo substr($title, 0 ,10);?>" data-id_product="<?php echo $prod_id;?>" data-id_category="1" data-price="<?php echo DEFAULT_CURRENCY.' '.number_format($product->min_price,2);?>" >
		Add to compare
		</button>
		<button type="button" class="btn btn-danger bor-rad-no mar-top10 compare_list compare_remove" onClick="return closedivsingle(<?php echo $prod_id;?>);" style="cursor:pointer; display:none;" id="removecompare_<?php echo $prod_id;?>">
		  Remove from compare
		</div>
    <!--  <h5 class="pull-right mar-top10"><b>Categoris:</b> Electronics, Mobiles</h5>-->
    </div>
  
    </div>
    
  </div>
</div>
</div>
<div class="clearfix"></div>
<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="all clearfix mar-bot20">
          <ul class="nav nav-tabs" role="tablist">
            <?php if($price_compare==0){?><li role="presentation"  ><a href="#User_Profile" aria-controls="User_Profile" role="tab" data-toggle="tab">Prices</a></li><?php } ?>
			
            <li role="presentation" ><a href="#Edit_Profile" aria-controls="Edit_Profile" role="tab" data-toggle="tab">Specfications</a></li>
            <li role="presentation"><a href="#Settings" aria-controls="Settings" role="tab" data-toggle="tab">Related Products</a></li>
            <li role="presentation"><a href="#Payment_settings" aria-controls="Payment_settings" role="tab" data-toggle="tab">Reviews</a></li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content panel-border">
		  <?php if($price_compare==0){?>
            <div role="tabpanel" class="tab-pane active" id="User_Profile" >
              <div class="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                <div class="panel-heading">
                  <h4 class="mar-no text-center">Price Online</h4>
                  <div class="bor bg-red"></div>
                </div>
                <div class="acc-table-style clearfix mar-top10">
                  <div class="">
                    <div class="panel-body" style="padding: 0px;">
                      <div class="table-responsive">
                      <?php

                      ?>
                        <table class="table nomargin table-hover-color">
                          <thead>
                            <tr class="bg-ylw clr-wht">
                              <th class="">Store</th>
                              <th class="">Store Rating/Address </th>
                              <th class="">Product colour / variants</th>
                              <th class="">Price</th>
                              <th class="">Cash Back</th>
                              
							  <th class="">approximate amount</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="">
						  
						   
							
                          <?php
						  if($act_store)
						{
							$act_store=$act_store;
						}
						else
						{
							$act_store='';
						}
				  	if($comparison_details)
				  	{
					  	foreach($comparison_details as $comparison)
					  	{
							$store_rating='';
							if(in_array($comparison->affiliate_id,$act_store))
							{
							$store_img = $comparison->affiliate_logo;
							$affiliate_name = $comparison->affiliate_name;
							$affiliate_id = $comparison->affiliate_id;
							$affiliate_url = $comparison->affiliate_url;
							$product_price = $comparison->product_price;
							 $store_rating=$comparison->rating;
							 $cpercent = $comparison->cashback_percentage;
							$cashbackpercent = '';
							if($cpercent!=0 || $cpercent!="")
							{
								if($comparison->affiliate_cashback_type=='Percentage')
								{
									$cashbackpercent = $cpercent."%";
								}
								else
								{
									$cashbackpercent = DEFAULT_CURRENCY.' '.$cpercent;
								}
							}
							
							$commision_details=$this->front_model->get_retailer_commision($affiliate_id);
							$c_get=unserialize($commision_details->what_get);
							$c_give=unserialize($commision_details->what_give);
							$c_catid=unserialize($commision_details->category_id);
							$cash_price=0;
							if(in_array($cate_id,$c_catid))
							{
							 $key = array_search($cate_id,$c_catid );
							 $cash_price1=$comparison->product_price*($c_get[$key]/100);
							  
							 $cash_price=$cash_price1*(50/100);
							 
							}
							
							$coupon_count = $this->front_model->count_coupons($comparison->affiliate_name)->counting;
							?>
                           <tr>
                              <td style="vertical-align: middle;"><img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $store_img;?>" class="" alt="<?php echo $affiliate_name;?>"/></td>
                              <td class="yellow-colr" style="vertical-align: middle;">
                              <?php
							
						
								if($store_rating)
								{
									 for($i=1;$i<=$store_rating;$i++)
									 {
										echo '<i class="fa fa-star"></i>';
									 }
								}
								?>
                             </td>
                                <td style="vertical-align: middle;"><?php if($product->codAvailable=='true')echo "Cash on Delivery<br>";?>
                             	 <?php if($product->emiAvailable!='')echo "EMI Available<br>";?>
                                <?php if($product->color!='')echo "Color : ".$product->color."<br>";?>
                                  <?php if($coupon_count!=0) echo $coupon_count." coupons Available<br>";?>
                                
                                
                                </td>
                              <td style="vertical-align: middle;">
                              
                              <?php $cmpproduct_price= number_format(($comparison->product_price),2);?>
                              <div class="price1"><div class="col-item" style="border: none; background:none;"><h5 class="price-text-color"><?php echo DEFAULT_CURRENCY;?><?php echo $cmpproduct_price;?></h5></div></div>
                              </td>
							  <td style="vertical-align: middle; color:green;font-size:12px;">
							  <p><?php if($cash_price!="")
							  {
								  //$cshbk_price=$comparison->product_price*($cpercent/100);
								?> <i class="fa fa-check fa-fw"></i> + UPTO <?php echo DEFAULT_CURRENCY;?> <?php echo number_format($cash_price,2);?> Cashback 							  
								
							  <?php }else
							  {
								 ?><i class="fa fa-close fa-fw"></i>  NO CASHBACK AVAILABLE<?php
							  }?></p>
							  <p><?php
							  $rpnts=round($comparison->product_price/$reward_point->cob_coins);
							  if($reward_point->max_points>=$rpnts) {echo $rpnts ;}
else{echo $reward_point->max_points;}							  ?> reword points
							  </p>
							  <?php $get_bank_offers=$this->front_model->get_bank_offers($affiliate_id); ?>
							  
							  <?php if($get_bank_offers) { ?>
                               <div class="addi-content">
                                      <span class="add"><?php echo count($get_bank_offers); ?> Offers</span>
                                      <div class="addtional-content">
                                      <div class="head">
                                        <h5>Offers</h5>
										<hr>
                                        </div>
                                        <div class="">
                                       <?php 
								$order=1;
								$offer_commision=0;
								foreach($get_bank_offers as $bank_off){
									if($bank_off->off_type ==1)
									{ 
								$com_per=$comparison->product_price*($bank_off->off_percent/100);
								
								if($com_per<$bank_off->off_amount)
								{
									$price_commision=$com_per;
								}
								else
								{
									$price_commision=$bank_off->off_amount;
								}
								echo '<p>'.$order.")".$bank_off->bank_name." ".$bank_off->off_percent.'% cashback or 
								upto '.DEFAULT_CURRENCY.$bank_off->off_amount.
								' cashback</p>';
								 }
								 else
								 {
									 $offer_commision=$offer_commision+$bank_off->off_amount;
									 echo '<p>'.$order.")".$bank_off->offer_desc." ".DEFAULT_CURRENCY.$bank_off->off_amount.'</p>';
								 }
								 $order++;
								}
								?>
                                        
										 
										 
										  
                                        
                                        </div>
                                    </div>
                                    
                                    </div>

						<?php } ?>
							  
							  </td>
							   <td style="vertical-align: middle;"><div class="col-item" style="border: none; background:none;"><h5 class="price-text-color"><?php 
							  $sum=str_replace(',','',$cmpproduct_price);
							  /* if($comparison->affiliate_cashback_type=='Percentage')
								{
							  $val=$cpercent/100;
							
							$sub=str_replace(',','',(number_format($sum*$val)));
							echo DEFAULT_CURRENCY;
							echo $sum-$sub-$price_commision-$offer_commision.'*';
							
								}
								else
								{
									echo DEFAULT_CURRENCY;
									echo $sum-$cpercent-$price_commision-$offer_commision.'*';
								} */
								
								echo DEFAULT_CURRENCY;
								echo number_format($sum-$cash_price-$price_commision-$offer_commision,2).'*';
							 ?></h5></div></td>
                              <?php
							 


							  $url=base_url()."visit_product/".$comparison->pp_id."/".$product->product_id; ?>
                              <td style="vertical-align: middle;"><p><a <?php if($user_id==""){?> data-toggle="modal" data-target="#myModal" onclick="return get_url('<?php echo $url; ?>');" <?php }else{?> target="_blank" href="<?php echo base_url(); ?>visit_product/<?php echo $comparison->pp_id;?>/<?php echo $product->product_id;?>"<?php } ?> class="btn btn-danger bor-rad-no"> <?php if( $comparison->stock==2){echo 'out of stock';}else{echo 'Go to Store';} ?></a></p>
							  
							  
							  
							  
							  </td>
                            </tr>
                            <?php
						}
						
						//print_r($offlinestores);
						//exit;
						 
						
						}
						
						$tot = 25;
						//print_r($get_offline_stores);die;
						$newpriceoffline =  $comparison->product_price;
						foreach($get_offline_stores as $get_offline_storess)
						{
						 $offg=$this->front_model->get_offline_sto($get_offline_storess->store_id);
						foreach($offg as $offline)
						{	
						
							$newpriceoffline = $newpriceoffline+$tot;
							 $strnale = str_replace(' ','+',$offline->store_name).'+'.$offline->address;
							 //$address = $this->front_model->distance($offline->store_id);
							?>
							<tr>
                              <td style="vertical-align: middle;">
								 <img width="100" src="<?php echo base_url().'uploads/offline_stores/'.$offline->store_logo;?>"><h4><?php echo $offline->offline_store_name;?></h4></td>
                              <td style="vertical-align: middle;"> <div style="width:200px;"> <?php echo $offline->address;?></div></td>
                              <td></td>
							  
                              <td style="vertical-align: middle;">
                             <div class="price1">
								 <div class="col-item" style="border: none; background:none;"><h5 class="price-text-color"><?php echo DEFAULT_CURRENCY;?><?php echo number_format(($get_offline_storess->price),2);;?></h5></div></div>
                              </td>
							  <td>
								  <i class="fa fa-check fa-fw"></i>
								  <?php if($get_offline_storess->offline_offer){ echo $get_offline_storess->offline_offer.'%'; }
									else {
										echo '';
										}
								   ?>
							  </td>
                              <td><div class="price1">
								 <div class="col-item" style="border: none; background:none;"><h5 class="price-text-color"><?php echo DEFAULT_CURRENCY;?><?php echo number_format(($get_offline_storess->price-($get_offline_stores->price*($get_offline_storess->offline_offer/100))),2);;?></h5></div></div></td>
                          <td style="vertical-align: middle;">
							  <a href="javascript:void(0);"
 NAME="View map"  class="btn btn-danger bor-rad-no" title=" Map "
 onClick=window.open("https://www.google.com/maps?q=<?php echo $strnale;?>","Ratting","width=650,height=600,0,status=0");>View Store</a>
 </td>
							</tr>
							<?php
						}}
				  	}
					else
					{
						?>
                         <div class="view-5more text-center"> <a class="view-5more-btn btn-price btn-215-30 btn"> No Stores Found</a> </div>
                        <?php
					}
					
					
					
					// echo $cmpproduct_price;
					// exit;
				  ?>
                          
                          </tbody>
                        </table>
                        
              <!--    <div class="">
                    <div class="">
                      <button class="btn-default btn bor-rad-no">Continue Shopping</button>
                   
                    </div>
                 
                </div>-->
                      </div>
                      <!-- table-responsive --> 
                    </div>
                  </div>
                </div>
              </div>
		  </div><?php } ?>
            <div role="tabpane1 " class="tab-pane <?php if($price_compare==1){ ?>active<?php } ?>" id="Edit_Profile">
              <div class="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                <div class="panel-heading">
                  <h4 class="mar-no text-center">Specfications</h4>
                  <div class="bor bg-red"></div>
                </div>
                <div class="panel-body" style="padding: 0px;">
					      	
                            
                            <?php
							$spec_option = '';
                            $specify = unserialize($product->specification);
                            $specify_option = unserialize($product->specification_option);
                            $specify_extra = unserialize($product->specification_extra);
							//print_r($specify_extra);exit;
							if($specify)
							{
								
								foreach($specify as $spec)
								{
									$spec_details = $this->front_model->get_details_from_id($spec,'specifications','specid');
									$spec_option = $this->front_model->specfication_ids($spec_details->specid);		
									$specfiidlists =  explode(';',$spec_option->specfiids);
									if($specify_option)
									{
										//print_r($specify_option);
									?>
                                    <div class="about-area">
                                        <h4><?php echo $spec_details->specification;?></h4>
                                         <div class="table-responsive">
                                          <table class="table">
                                            <tbody>
                                            <?php
                                            foreach($specify_option as $opt)						
                                            {
                                                if(in_array($opt,$specfiidlists))
                                                {
                                                    $spec_details_opt = $this->front_model->get_details_from_id($opt,'specifications','specid');
                                                    ?>
                                                     <tr>
                                                        <td style="width:250px;"><?php echo $spec_details_opt->specification;?></td>
                                                        <td><?php echo $specify_extra[$opt];?></td>
                                                      </tr>	
                                                    <?php
                                                }
                                            }
											?>
                                            </tbody>
                                            </table>
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
            <div role="tabpanel" class="tab-pane" id="Settings">
              <div class="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                <div class="panel-heading">
                  <h4 class="mar-no text-center">Related Products</h4>
                  <div class="bor bg-red"></div>
                </div>
                
                
                
                <div class="item">
          <div class="row">
          
           <?php
							$similar_products =$this->front_model->similar_products($product->parent_id,$product->brands,4);
							if($similar_products)
							{
								$k=1;
								foreach($similar_products as $simproduct)
								{
									/*echo ($simproducts->product_url);
									exit;*/
									$product_idpp = $simproduct->product_id;
									$getminpricesim_row = $this->front_model->getmin_price_product($product_idpp);

									$product_url_sim = $simproduct->product_url;
									 if($simproduct->product_image!='')
									{
										$fea_product_img =base_url().'uploads/products/'.$simproduct->product_image;
										if (@getimagesize($fea_product_img)) {
										$fea_product_img = base_url().'uploads/products/'.$simproduct->product_image;
										}
										else
										{
											$fea_product_img = base_url().'front/images/no_product.png';
										}
										
									}
									else{
										$fea_product_img =base_url().'front/images/no_product.png';
									}
									
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
									 $feastore = $this->front_model->product_store_count($simproduct->product_id);
								  ?>
                                  
                                  
           						 <div class="col-sm-3">
                                  <div class="col-item">
                                    <div class="photo"> <a href="<?php echo base_url().'product_details/'.$product_url_sim;?>"><img src="<?php echo $fea_product_img;?>" class="img-responsive" style="width:auto; height:200px;" alt="<?php echo $simproduct->product_name;?>" /></a> </div>
                                    <div class="info">
                                      <div class="">
                                      <div class="text-center">
                                          <h4 class=""> <?php echo $simproduct->product_name;?></h4>
                                        </div>
                                      </div>
                                      <div class=" clear-left">
                                        <p class="text-center"> <a href="<?php echo base_url().'product_details/'.$product_url_sim;?>" class="btn btn-danger bor-rad-0 mar-top10">View Detail</a></p>
                                      </div>
                                      <div class="clearfix"> </div>
                                    </div>
                                  </div>
                                </div>
            
            
            					 <?php
									}
								$k++;
								}
							}
							else{
							?>	
                            
                            <div class="alert alert-danger bs-alert-old-docs">
										<center>
										  <strong>No data found!</strong>
										</center>
									</div>
								
							<?php
							} 
							?>
                            
            
       
            
          </div>
        </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="Payment_settings">
              <div class="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                <div class="panel-heading">
             
                  <h4 class="mar-no text-center">Reviews</h4>
                   <?php
					if($this->session->userdata('user_id')=="")
					{ ?>
				     <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"> <button class="btn btn-warning bor-rad-no" style="float: right; margin: -11px;" type="button ">
                    Write Review
                    </button></a>
				  
					<?php
					}else 
					{
						$chk_fav = $this->front_model->check_favorite($product->product_id);
						
						?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#reviewpop"> <button class="btn btn-warning bor-rad-no" style="float: right; margin: -11px;" type="button ">Write Review</button></a>
						
						<?php
					}
				?>
                  <div class="bor bg-red"></div>
                   
                </div>
                 
                
                    
				<?php
				$reviews = $this->front_model->get_myproductreviews($product->product_id);
				if($reviews) 
				{ 
				  $rr=0; 
				  $r_cunt=count($reviews);
					foreach($reviews  as $review)
					{ $rr++;
						$get_userdetails = $this->front_model->get_details_from_id($review->user_id,'tbl_users','user_id');
						$fna = $get_userdetails->first_name;
						$emil = $get_userdetails->email;
						if(!$fna)
						{
							$expmail = explode('@',$emil);
							$fna = reset($expmail);
						}
						
						?>
                        <div class="panel-body" style="padding: 0px;">
                              <div class="col-md-1">
                              <img style="height: 55px;" src="<?php echo base_url();?>front/images/defaultusericon.png"/>
                              </div>
                               <div class="col-md-11">
                               <div class="col-md-10">
                               <h5><?php echo $fna;?></h5>
                               <p><?php echo $review->review_title;?></p>
                          </div>
                                 <div class="col-md-2">
                                 <div class="yellow-colr">
                                 <?php 
								 for($j=1;$j<6;$j++)
								 {
									 if($review->rating>=$j)
									 {
										 echo '<i class="fa fa-star"></i>';
									 }
									 else
									 {
										  echo '<i class="gry-star fa fa-star"></i>';
									 }
								 }
								 ?>
                                 </div>
                                 </div>
                                   </div>
                               
                              
                            </div>
                        <?php
						if($r_cunt>1)
						{
						
							echo "<hr>";
							
						}
					}
					
				}
				else
				{
					?>
					<div class="alert alert-danger" role="alert">
                        <a href="javascript:void(0);" class="alert-link">No reviews Found</a>
                    </div>
                    <?php
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
<div class="container">
<div class="row-fluid clearfix mt20 tab-chart-content box-shad4"><!--<div class="chart-overlay">
        <ul class="list-inline pull-right">
          <li class="lowest bor-rad3"> lowest: rs.45,223</li>
          <li class="highest bor-rad3"> highest: rs.76,223</li>
          <li  class="complete bor-rad3">view complete index</li>
        </ul>
      </div>-->
      <div id="container" style="min-width:1155px; height: 400px; margin: 0 auto"></div>
      
    </div>
   </div>
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
										}
										else{
											$fea_product_img =base_url().'front/img/rsz_default.jpg';
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
										$feastore = $this->front_model->product_store_count($lasproduct->product_id);
										$offpercent =  ceil((($lasproduct->mrp-$lasproduct->product_price)/$lasproduct->mrp)*100);
									?>
                                            <div class="col-md-3 col-sm-3">
                                        
                                             <div class="cate_item">
                                              <div class="item-inner">
                                               <div class="bst_pdt">
                                                <a title="<?php echo substr($lasproduct->product_name,0,20);?>" href="<?php echo base_url().'product_details/'.$lasproduct->product_url;?>" class="bigpic_21_tabcategory product_image">
                                                <img alt="<?php echo $lasproduct->product_name;?>" src="<?php echo $fea_product_img;?>"  class="img-responsive center-block"> <span class="new">New</span> </a></div>
												 <div class="text-center clearfix">
                                                
                                                <h4><?php echo $lasproduct->product_name;?></h4></div>
                                                <div class="grey-bg clearfix">
                                                <div class="col-md-6 col-sm-6">
                                                <a href="<?php echo base_url().'visit_product/'.$getminpricesim_row->pp_id.'/'.$getminpricesim_row->product_id;?>" target="_blank">                                               
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
                                                  </span> <span class="price product-price clr-grey" style="font-size:14px; display:block;">
                                                    <amall>  <?php echo DEFAULT_CURRENCY." ".number_format(($lasproduct->mrp),2);?> </amall>
                                                    </span></div>
                                                </div>
                                                 
                                              </div>
                                              <div class="red-box"> <a style="color:white; text-decoration:none;" title="<?php echo substr($lasproduct->product_name,0,20);?>" href="<?php echo base_url().'product_details/'.$lasproduct->product_url;?>">Available From <?php echo $feastore['count'];?> Stores</a></div>
                                            </div>
                                        
                                        </div>
                                            <?php
									
										}
									$k++;
									if($k>4)break;
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

<div class="modal fade" id="detail-pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="price_close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal">
      <div class="modal-body">
      
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" required placeholder="Enter Your Email Address" id="priceemail" class="form-control">
       <input type="hidden" name="product_id" id="product_id" value="<?php echo $product->product_id;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
    <div class="col-sm-10">
      <input type="text" required  class="form-control" id="priceemobile"  id="inputPassword3" placeholder="Mobile Number">
    </div>
  </div>
      </div>
      <div class="modal-footer">
      <span class="unique_name_error"></span>
      <button class="btn btn-danger bor-rad-0" id="pricealert" type="button" value="submit"><span class="submit-price-icon"></span>Confirm</button>
      </div>
      </form></div>
  </div>
</div>


<div class="modal fade" id="reviewpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">Review
        <button type="button" id="reviewcloseid" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <span class="msg"></span>
      <form class="form-horizontal" id="revform">
      <div class="modal-body">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Rating</label>
    <div class="col-sm-10">
      <div class="rating">
						  <input type="radio" value="5" name="rating" id="sstar5">
						  <label for="sstar5">5 stars</label>
						  <input type="radio" value="4" name="rating" id="sstar4">
						  <label for="sstar4">4 stars</label>
						  <input type="radio" value="3" name="rating" id="sstar3">
						  <label for="sstar3">3 stars</label>
						  <input type="radio" value="2" name="rating" id="sstar2">
						  <label for="sstar2">2 stars</label>
						  <input type="radio" value="1" name="rating" id="sstar1">
						  <label for="sstar1">1 star </label>
						</div>
                        
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Review</label>
    <div class="col-sm-10">
	<textarea id="review_title" class="form-control"  required name="review_title"></textarea>
    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product->product_id?>">
    
      <input type="hidden" name="submit" id="submit" value="submit">
    </div>
  </div>
      </div>
      <div class="modal-footer">
      <span class="unique_name_error"></span>
      <button class="btn btn-danger bor-rad-0" id="product_review" type="button" value="submit"><span class="submit-price-icon"></span>Save</button>
      </div>
      </form></div>
  </div>
</div>



<?php 
	$this->load->view('front/sub_footer');
//Footer
	$this->load->view('front/site_intro');	
// footer ends here  
	$this->load->view('front/js_scripts');
?>

<script type="text/javascript" src="<?php echo base_url();?>front/js/product.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>front/js/tabs.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>front/js/elevatezoom-min.js"></script> 

<script type="text/javascript">
jQuery('#image-additional .item:first').addClass('active');
jQuery('#image-additional').carousel({interval:false})
</script> 

<script type="text/javascript">
      jQuery("#image-main").elevateZoom({
      gallery:'image-additional', 
      cursor: 'pointer',
      easing : false,
      easingType : "easeOutExpo",
      easingDuration : 2000,
     // lensShape : "round",
     // lensSize    : 10,
      galleryActiveClass: 'active'});
     // ProductMediaManager.initZoom('slider', 'basic', 'basic', 150);
</script> 

<script type="text/javascript" src="<?php echo base_url();?>front/js/jquery.easing.min.js"></script> 

 <script src="<?php echo base_url();?>front/js/highcharts.js"></script>
<script src="<?php echo base_url();?>front/js/exporting.js"></script>

<script>$(function () {
    $.getJSON('<?php echo base_url();?>cashback/create_product_json/<?php echo $product->product_id;?>/?callback=?', function (data) {

        $('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        '' : ''
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Product Price  <?php echo $currency;?>',
                data: data
            }]
        });
    });
});</script> 

        <script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script>
        

<!-- DATATABLES -->

<script>
$(document).ready(function(){

var currW=$('#image-main').css('width');
var currH=$('#image-main').css('height');
alert(currW);
var ratio = currH / currW;
var maxW=200;
var maxH=200;


if(currW >= maxW &amp;&amp; ratio <= 1)
{

currW = maxW;

currH = currW * ratio;

} 
else >if(currH >= maxH)
{

currH = maxH;

currW = currH / ratio;

}

})
</script>
<script type="text/javascript">

$('#pricealert').click(function(){
var priceemail = $('#priceemail').val();
var priceemobile = $('#priceemobile').val();


var product_id = $('#product_id').val();
if(!priceemail)
{
	$('#priceemail').css('border','2px solid red');
	return false;
}
if(!priceemobile)
{
	$('#priceemobile').css('border','2px solid red');
	return false;
}
/*if(!validateEmail(priceemail))
{
	$('#priceemail').css('border','2px solid red');
	return false;
}*/
$('#priceemail').css('border','');
$('#priceemobile').css('border','');
	$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>cashback/pricealert',
			data:{'priceemail':priceemail,'product_id':product_id,'priceemobile':priceemobile},
			 success:function(result){
				if(result==1)
				{
					$(".unique_name_error").css('color','#29BAB0');
  				 	$(".unique_name_error").html('Price drop alert set successfully');
					$("#priceemail").val('');
					$('#priceemobile').val('');
          setTimeout(function() {
              $('#price_close').trigger('click');   
            }, 2000); 
				}
				else
				{
					$(".unique_name_error").css('color','#ff0000');					
					$(".unique_name_error").html('Price drop alert already set');
					$("#priceemail").val('');
					$('#priceemobile').val('');
          setTimeout(function() {
              $('#price_close').trigger('click');   
            }, 2000); 
				}
			}
		});
});
function addfav(id){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>cashback/add_favorite',
		dataType:"json",
		data:"product_id="+id,
		success:function(msg){
			if(msg==1){
				$('.fav_'+id).html('<button class="btn btn-warning bor-rad-no mar-top10" type="button" onClick="return removfav('+id+');"><i style="color:#FF0000;" class="fa fa-heart"></i> Remove from Wishlist</button>');
				$('.fav_'+id).prop("onclick", null);
			}
		}
	});
}

function removfav(id){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>cashback/remove_favorite',
		dataType:"json",
		data:"product_id="+id,
		success:function(msg){
			if(msg==1){
				$('.fav_'+id).html('<button class="btn btn-warning bor-rad-no mar-top10" type="button" onClick="return addfav('+id+');"><i style="color:#FF0000;" class="fa fa-heart"></i> Add to Wishlist</button>');
				$('.fav_'+id).prop("onclick", null);
			}
		}
	});
}


$('#product_review').click(function(){
if($('input:radio[name=rating]:checked').length == 0){
	alert("Please enter the overall rating");
	
	return false;
}

if($("#review_title").val()==''){
		$('#review_title').focus();
		$('#review_title').css('border','2px solid red');
		return false;
}


$('#review_title').css('border','');

	var datas = $('#revform').serialize();
	
	
	 jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cashback/submit_product_ratings",
				data: datas,
				cache: false,
				success: function(result)
				{
					if(result==1){
						$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong> Your review has been submitted successfully & waiting for admin approvel </strong></div>');
						$('#revform').trigger('click');
						$("#review_title").val('');
						 
							$('#reviewcloseid').trigger('click');		
						$('.modal-backdrop').remove();			
					}
					else {					
						$('.msg').html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">x</button><strong>Error occurred while submit your review details.</strong></div>');
								
					}				
				}
			});
						
	return false;
});

function get_url(url)
{
	//alert(url);
	if(url!="")
	{
		
		
		
		$('#st_url').attr('href',url);
		$('#gt_url').val(url);
		 $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>cashback/sessions_product_url",
      data: 'url='+url,
	  success: function(result)
				{
				}
   })
	}
	else
	{
		
		/*<?php $redirect_urlset =  base_url(uri_string()); ?>
		$('#st_url').attr('href','<?php echo $redirect_urlset; ?>');*/
		location.reload();
		
	}
	}
	$('.popoverData').popover();
$('#popoverOption').popover({ trigger: "hover" });

	 /* $('#product_review').click(function(){
		// alert('hai');
    $('#reviewcloseid').trigger('click');
		
	});  */

</script>






</body>
</html>
