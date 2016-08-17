<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php echo $product->product_name;?> - Products</title>
<?php $this->load->view('front/css_script_details');
$admindetailss = $this->front_model->getadmindetails();?>

<!-- seetha-->
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


</style>
<!-- seetha-->

</head>

<body>

<?php $this->load->view('front/header');
?>
<!-- header ends here --->



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    <div class="row">
      <div class="col-main col-lg-12 col-md-12 col-sm-9 col-xs-12 content-color color f-right">
        <div class="product-img-box clearfix col-md-5 col-sm-5 col-xs-12">
          <div class="product-view" >
            <div class="product-essential">
              <div class="product-img-content">
                <div class="product-image product-image-zoom">
                  <div class="product-image-gallery"> <!--<span class="sticker top-left"><span class="labelnew">Rs.8900 savings</span></span><span class="sticker top-right"><span class="labelsale"> 12.12% Discount</span></span>--> 
					<?php 
						if($gallery){
							$i=0;
							foreach($gallery as $img){
								$img = base_url()."uploads/products/".$img->image;
								if($i==0){
									echo '<img id="image-0" itemprop="image" class="gallery-image visible img-responsive" src="'.$img.'" alt="'.$product->product_name.$i.'" title="" />';
								}else{
									echo '<img id="image-'.$i.'" itemprop="image" class="gallery-image" src="'.$img.'" /> ';
								}
								$i++;
							}
					} ?>  
				  </div>
                </div>
                <div class="more-views">
                  <ul class="product-image-thumbs">
					<?php 
				if($gallery){
					$sm = 0;
					foreach($gallery as $sm_img)
					{
						$sm_img = base_url()."uploads/products/".$sm_img->image;
					?>
						<li> <a class="thumb-link" href="javascript:void(0);" title="" data-image-index="<?php echo $sm; ?>"> <img class="img-responsive" src="<?php echo $sm_img; ?>" alt="<?php echo $product->product_name.$sm;?>" /> </a> </li>
                    <?php $sm++;
					}
				} ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7 col-sm-7">
          <h2 class="text-uppercase"> <?php echo $product->product_name;?> </h2>
          <hr>
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="product-shop">
                <div class="product-detail-box">
                  <div class="product-detail-brand">
                    <div class="media">
                    <?php 
					if(isset($brandslist) && $brandslist!='')
					{
						$brand_img = $brandslist->brand_image;
						$brand_imgs = base_url()."uploads/brands/".$brand_img;
						?>
                        <div class="media-left media-top"> <a class="bor-rad3" href="javascript:void(0);"> <img alt="<?php echo $brandslist->brand_name;?>" src="<?php echo $brand_imgs; ?>" class="media-object img img-center"> </a> </div>
                      <div class="media-body media-top">
                        <ul class="list-unstyled nomargin">
                          <li>brand: <span class="text-orange"><?php echo $brandslist->brand_name;?></span></li>
                        </ul>
                      </div>
                    </div>
                        <?php
					}
					else
					{
						?>
                        <div class="media-left media-top"> <a class="bor-rad3" href="javascript:void(0);"> <img alt="" src="" class="media-object img img-center"> </a> </div>
                      <div class="media-body media-top">
                        <ul class="list-unstyled nomargin">
                          <li>New Brand: <span class="text-orange"</span></li>
                        </ul>
                      </div>
                    </div>
                        <?php
					}
					
					?>
                      
                  </div>
                  <div class="product-detail-price-box bor-rad3 mt5">
                    <div class="price-inner bor-rad3 text-center">
                      <ul class="list-inline">
                        <li class="pre-price"> <?php echo $currency;?><?php echo $product->max_price;?></li>
                        <li class="lat-price"> <?php echo $currency;?><?php echo $product->min_price;?></li>
                      </ul>
                      <ul class="list-inline ul-right">
                        <li>available <br>
                          stores</li>
                        <li class=""> <span class="avail-store-count bor-rad3"><?php echo $product->Totalstores;?></span></li>
                      </ul>
                      <div class="lowest-price-abs">
                        <p>lowest price</p>
                      </div>
                      <div class="price-abs">
                        <p>price</p>
                      </div>
                    </div>
                    <!--<p>apply coupons for discounts on this product</p>-->
                    <div class="price-inner bor-rad3 text-center mar-bot30 mar-top">
                      <ul class="list-inline col-md-6" >
                        <li class="">Before</li>
                        <li class="lat-price"><?php echo $currency;?><?php echo $product->min_price;?></li>
                      </ul>
                      <ul class="list-inline">
                        <li class="">After</li>
                        <li class="lat-price"><?php echo $currency;?><?php echo number_format(($product->min_price-$product->cashback_price),2);?></li>
                      </ul>
                      <div class="price-abs bg-green nopadding">
                        <p style="top:57px;">Cashback</p>
                      </div>
                    </div>
                    
                    <?php
					?>
                    <div class="price-inner best-price-inner bor-rad3">
                      <ul class="list-inline">
                        <?php if($store){
								$store_img = base_url().'uploads/affiliates/'.$store->affiliate_logo;
						?>
							<li class="pre-price col-md-5">
								<img alt="<?php echo $store->affiliate_name;?>" class="img img-responsive" src="<?php echo $store_img; ?>">
							</li>
                        <?php } ?>
						<li style="margin-left: 25px;">
						<?php
						
						$scrappingrow = $this->front_model->getscrapping_id($minprice_details->store_id,$minprice_details->product_id);
							if($product->affiliate_url)
								$product_url = $product->affiliate_url;
							else
								$product_url = $product->product_url;
						?> 
                          <a target="_blank" href="<?php echo base_url(); ?>cashback/visit_product/<?php echo $scrappingrow->pp_id;?>/<?php echo $product->product_id;?>" class="btn btn-buy-now mar-top">buy now</a>
                        </li>
                      </ul>
                      <div class="price-abs best-price-abs">
                        <p>best price</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="product-view-coupon">
                <div class="coupon-bot box-shad4 row-fluid clearfix mt15">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="media pad">
                        <div class="media-left media-middle">
                          <div class="cash-back-img"> </div>
                        </div>
                        <div class="media-body">
                          <h5><?php echo DEFAULT_CURRENCY;?><?php echo $product->cashback_price;?><!-- <span class="text-sky">(8%)</span>--></h5>
                          <p>Cash back</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="add-img"></div>
                    </div>
                    <div class="col-md-12">
                      <div class="media pad ">
                        <div class="media-left media-middle">
                          <div class="reward-point-img"> </div>
                        </div>
                        <div class="media-body">
                        <?php
						 $coinvalue = round(($product->min_price/COINVALUE));
						?>
                          <h5><?php echo $coinvalue; ?> <!--<span class="text-sky">(Rs.50)</span>--></h5>
                          <p>reward points</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--<div class="coupon-bot-bot-content">
                    <p>click for exact cashback rate | terms and conditions</p>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
          <div class="coupon-bot-buttons row-fluid clearfix mt15">
    <!--        <button data-target="#modal_embed" data-toggle="modal" class="btn btn-primary bor-rad-no" type="button"><i class="fa fa-code pad-rht"></i> embed</button>
            <button class="btn btn-ylw bor-rad-no" type="button"><i class="fa fa-star pad-rht"></i> like</button>
            <button data-target="#modal_compare" data-toggle="modal" class="btn btn-danger bor-rad-no" type="button"> <i class="fa fa-info-circle pad-rht"></i> compare</button>-->
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal --> 
  
    
    <div class="row-fluid clearfix mt20">
      <div class="col-md-8 nopadding about-product">
        <div class="tab-like-tab">
          <h3><span class="head"><span class="tab-ico-1"></span>about product</span> <span class=""> </span> </h3>
          <div class="box-shad4 tab-content tab-content-about-product">
            <p>
			<?php 
			$desc = $product->description;
			$strip_Desc = strip_tags($desc);
			echo $countstr =  strlen($strip_Desc);
			
			if($countstr>318)
			{
				echo $string2 = substr($strip_Desc, 0, 318);
				echo '<div class="btn-demo"><a class="btn btn-primary bor-rad-no" data-target="#modal_embed" data-toggle="modal">view more info</a>';
				if($product->key_feature)
				{
					echo '<a class="btn btn-primary bor-rad-no" data-target="#modal_embed_features" data-toggle="modal">View Key Features</a></div>';
				}
			}
			else
			{
				echo strip_tags($desc);
				
			}
			?></p>
            
           
           
          </div>
        </div>
      </div>
      <div class="col-md-4 nopadding key-features">
        <div class="tab-like-tab">
          <h3><span class="head"> <i class="fa fa-info-circle pad-rht"></i> Price Alert</span> <span class=""> </span> </h3>
          <div class="box-shad4 tab-content tab-content-about-product">
            <form class="form col-md-8 col-md-offset-2 gap-top-20">
              <div class="form-group clearfix">
                <input type="email" required placeholder="Enter Your Email Address" id="priceemail" class="form-control">
                <span class="unique_name_error"></span>
                <input type="hidden" name="product_id" id="product_id" value="<?php echo $product->product_id;?>">
              </div>
              <div class="form-group clearfix gap-bottom-45">
                <button class="btn  btn-primary bor-rad-no" id="pricealert" type="button"><span class="submit-price-icon"></span>Submit for price alerts</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid clearfix mt20">
      <div class="tab-category-container-slider">
        <div class="container-tab">
          <div class="container-inner">
            <div class="tab-category megashop">
              <div class="pos_tab">
                <ul class="tab_cates magictabs">
                  <li data-type="featured"  data-title="tabtitle_33" rel="tab_33"  class="item active loaded "><span class="title">Price Online</span></li>
                  <li data-type="latest" data-title="tabtitle_35" rel="tab_35" class="item " ><span class="title">Specifications</span></li>
                  <li data-type="latest" data-title="tabtitle_36" rel="tab_36" class="item " ><span class="title">Similar Products</span></li>
<!--                  <li data-type="latest" data-title="tabtitle_37" rel="tab_37" class="item " ><span class="title">User Reviews</span></li>-->
                  <li data-type="latest" data-title="tabtitle_38" rel="tab_38" class="item " ><span class="title">Price Drop Box</span></li>
                 <!-- <li data-type="latest" data-title="tabtitle_39" rel="tab_39" class="item " ><span class="title">Expert Reviews</span></li>-->
<!--                  <li data-type="latest" data-title="tabtitle_40" rel="tab_40" class="item " ><span class="title">Faq</span></li>
-->                </ul>
              </div>
              <div class="tab1_container">
               <div id="ajaxloading" style="display:none">
                <img src="<?php echo base_url().'front/img/loading_verti.gif'?>" class="ajax-loader">
                </div>
                <div id="tab_33" class="tab_category">
               
                  <div class="filterss clearfix">
                    <form class="form-inline" id="sortform">
                      <div class="filter-inr-left pull-left">
                        <div class="form-group">
                          <label for="">filters: </label>
                        </div>
                        <div class="form-group filter-check">
                          <input type="checkbox" class="sorting_checkbox" value="COD" name="filters[]" id="c1">
                          <label for="c1"><span></span>COD</label>
                        </div>
                        <div class="form-group filter-check">
                          <input type="checkbox"  class="sorting_checkbox" value="free_shipping" name="filters[]" id="c5">
                          <label for="c5"><span></span>Free Shipping</label>
                        </div>
                        <div class="form-group filter-check">
                          <input type="checkbox"  class="sorting_checkbox" value="returns" name="filters[]" id="c3">
                          <label for="c3"><span></span>Returns</label>
                        </div>
                        <div class="form-group filter-check">
                          <input type="checkbox"  class="sorting_checkbox" value="offers" name="filters[]" id="c4">
                          <label for="c4"><span></span>Offers</label>
                        </div>
                      </div>
                      <div class="filter-inr-right pull-right">
                        <!--<div class="form-group filter-check"> <span class="btn btn-danger bor-rad-no">Embed</span> </div>-->
                        <div class="form-group">
                          <label for="">Sort By</label>
                          <input type="hidden" name="product_id" id="product_id" value="<?php echo $product->product_id?>">
                          <select  name="sort_default" id="sort_default" class="sort_default_list dropdown dropdown-filter-div btn-140-28">
                          <option value="price_low">Price low</option>
                          <option value="price_high">Price high</option>
                          <!--<option value="store_rating">Store rating</option>-->
                          </select>
                          </div>
                       <!-- <div class="form-group filter-box"> <span><i class="fa fa-th-large"></i></span> </div>
                        <div class="form-group filter-box"> <span><i class="fa fa-list"></i></span> </div>-->
                      </div>
                    </form>
                  </div>
                  <div class="row" id="ajaxloadingdiv">
                  <?php
				  	if($comparison_details)
				  	{
					/*	print_r($comparison_details);
						exit;*/
					  	foreach($comparison_details as $comparison)
					  	{
							$store_img = $comparison->affiliate_logo;
							$affiliate_name = $comparison->affiliate_name;
							$affiliate_id = $comparison->affiliate_id;
							$affiliate_url = $comparison->affiliate_url;
							$product_price = $comparison->product_price;
							$coupon_count = $this->front_model->count_coupons($comparison->affiliate_name)->counting;

							?>
							<div class="col-md-3">
                              <div class="prod-view-coupon-product">
                                <div class="prod-box box-shad4 text-center">
                                  <div class="prod-brand"> <img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $store_img;?>" /> </div>
                                  <div class="prod-add-list clearfix">
                                   <!-- <ul class="list-inline nomargin">
                                      <li><a href="#"><img src="<?php echo base_url(); ?>front/img/rating.png"></a></li>
                                      <li><a href="#" class="rate-seller bor-rad3" data-target="#modal_user_review" data-toggle="modal">rate the seller</a></li>
                                    </ul>-->
                                  </div>
                                  <div class="prod-price">
                                    <div class="prod-price-left">
                                      <h5><?php echo DEFAULT_CURRENCY;?><?php echo $comparison->product_price;?> <a class="addi-content"> <!--<span class="add">+</span>-->
                                        <div class="addtional-content">
                                          <div class="head">
                                            <h5>other varients</h5>
                                          </div>
                                          <div class="content">
                                            <ul class="list-unstyled">
                                              <li>apple iphone 6 space grey <span class="pull-right">
                                                <button type="button" class="btn btn-yellow btn-sm">buy now</button>
                                                </span></li>
                                              <li>apple iphone 6 space grey <span class="pull-right">
                                                <button type="button" class="btn btn-yellow btn-sm">buy now</button>
                                                </span></li>
                                              <li>apple iphone 6 space grey <span class="pull-right">
                                                <button type="button" class="btn btn-yellow btn-sm">buy now</button>
                                                </span></li>
                                              <li>apple iphone 6 space grey <span class="pull-right">
                                                <button type="button" class="btn btn-yellow btn-sm">buy now</button>
                                                </span></li>
                                            </ul>
                                          </div>
                                        </div>
                                        </a></h5>
                                      <p>(seller price)</p>
                                    </div>
                                    <div class="prod-price-right">
                                   <?php $cmpproduct_price= number_format(($comparison->product_price-$product->cashback_price),2);?>
                                      <h5><?php echo DEFAULT_CURRENCY;?><?php echo $cmpproduct_price;?></h5>
                                      <p>(after savings)</p>
                                    </div>
                                  </div>
                                  <div class="prod-button">
                                    <ul class="list-inline nomargin">
                                      <li>
                                      <a target="_blank" href="<?php echo base_url(); ?>cashback/visit_product/<?php echo $comparison->pp_id;?>/<?php echo $product->product_id;?>" class=""><button type="button" class="btn btn-105-30 bor-rad3   btn-yellow">Buy at store</button></a>
                                      </li>
                                     <!-- <li class="dropdown">
                                        <button class="btn btn-105-30 bor-rad3 dropdown-toggle  btn-price" aria-expanded="false" aria-haspopup="true" role="button" type="button" data-toggle="dropdown">view offer</button>
                                        <div class="view-off-cont dropdown-menu box-shad4">
                                          <div class="head">about offer <span class="close">&times;</span></div>
                                          <div class="cont">
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque</p>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque</p>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque</p>
                                          </div>
                                        </div>
                                      </li>-->
                                    </ul>
                                  </div>
                                  <?php
								if($coupon_count!=0)
								{
									  ?>
                                      <div class="prod-discount" > <a style="color:#31cc32;" href="<?php echo base_url().'cashback/stores/'.$affiliate_url;?>" target="_blank"><?php echo $coupon_count;?> coupons Available </a></div>
                                      <?php
								}
								else
								{
									?>
                                      <div class="prod-discount"> No coupons available at this time </div>
                                      <?php
								}
								  ?>
								
                                  
                                  
                                  <div class="prod-detail clearfix">
                                    <ul class="list-unstyled clearfix nomargin">
                                      <li><span class="square"></span> free shipping</li>
                                      <li><span class="square"></span> EMI + cash on delivery</li>
                                      <li><span class="square"></span> 1-3 working days for shipping</li>
                                    </ul>
                                  </div>
                                  <?php

								  if($coupon_count!=0)
								  {
									  ?>
                                      <div class="coupon-available-abs bor-rad3"> <a href="<?php echo base_url().'cashback/stores/'.$affiliate_url;?>" target="_blank">coupons available </a></div>
                                      <?php
								  }
								  ?>
                                  
                                <!--  <div class="featured-abs"> featured seller </div>-->
                                  <div class="cashback-text-bot">
                                    <p><span class="text-red"><?php echo DEFAULT_CURRENCY;?><?php echo $product->cashback_price;?></span> <span class="text-sky"></span> cashback and <span class="text-red"><?php echo $coinvalue; ?></span> <!--<span class="text-sky">(rs.135)</span>--> reward points. <!--total savings <span class="text-red">Rs.785</span>--></p>
                                  </div>
                                  <!--<div class="feadback-hover"> <a href="#">89% positive feadback</a> </div>-->
                                </div>
                              </div>
                    </div>
                    		<?php
						}
				  	}
					else
					{
						?>
                         <div class="view-5more text-center"> <a class="view-5more-btn btn-price btn-215-30 btn"> No Stores Found</a> </div>
                        <?php
					}
				  ?>
                    
                   
                  </div>
                  </div>
                <div id="tab_35" class="tab_category">
                  <div class="row">
                    <div class="col-md-12">
                     <table class="table table-condensed table-hover">
                        <tbody>
							<?php
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
									?>
									 <tr class="bg-ylw clr-wht">
										<th colspan="2"><?php echo $spec_details->specification;?></th>
									  </tr>
									<?php
									foreach($specify_option as $opt)						
									{
										if(in_array($opt,$specfiidlists))
										{
											$spec_details_opt = $this->front_model->get_details_from_id($opt,'specifications','specid');
											?>
											 <tr>
												<td><?php echo $spec_details_opt->specification;?></td>
												<td><?php echo $specify_extra[$opt];?></td>
											  </tr>	
                                            <?php
										}
									}
								}
							}
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="tab_35" class="tab_category">
                    <div class="row"> </div>
                  </div>
                </div>
				<div id="tab_36" class="tab_category">				
					<div class="row mt20" >
					  <div id="center_column" class="center_column col-xs-12 col-sm-12">
						<div class="tab-category-container-slider">
						  <div class="container-tab">
							<div class="container-inner">
							  <div class="tab-category megashop">
								<div class="pos_tab bor-ylw">
								  <div class ='cate_title'>
									<div class="megashop ">
									  <h3 class="bg-ylw">You May Like</h3>
									</div>
								  </div>
								</div>
								<div class="row">
								  <div class="productTabCategorySlider2">
								  
								  <?php
							$similar_products =$this->front_model->similar_products($product->parent_id);
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
									}
									else{
										$fea_product_img =base_url().'front/img/rsz_default.jpg';
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
									<div class="cate_item">
									  <div class="item-inner">
										<div class="blu-box"><a style="color:#fff;" href="<?php echo base_url().'cashback/product_details/'.$product_url_sim;?>"> Available From <?php echo $feastore['count'];?> Stores</a></div>
										<a class ="bigpic_21_tabcategory product_image" href="<?php echo base_url().'cashback/product_details/'.$product_url_sim;?>" title="<?php echo substr($simproduct->product_name,0,20);?>"><img style="max-height: 100px;max-width: 100%;"  class="img-responsive center-block" src="<?php echo $fea_product_img;?>" alt="<?php echo substr($simproduct->product_name,0,20);?>" /> <span class="new">New</span> </a>
										<div class="grey-bg clearfix"> <img style="height:20%;width:106px;" src="<?php echo $store_img;?>" class="img-responsive pull-left">
                                        
                                       
<a class="btn btn-buy-now mar-top pull-right" style="width:97px;height:43px;" href="<?php echo base_url().'cashback/visit_product/'.$getminpricesim_row->pp_id.'/'.$getminpricesim_row->product_id;?>" target="_blank">Buy now</a>		  
										</div>
										<div class="product-content">
										  <h5 class="product-name text-center"><a href="<?php echo base_url().'cashback/product_details/'.$product_url_sim;?>" ><?php echo substr($simproduct->product_name,0,20);?></a></h5>
										  <div class="ratings">
											<div class="comments_note" itemprop="aggregateRating" itemscope itemtype="">
											  <div class="star_content text-center clearfix">
												<?php
												 $store_rating =$this->front_model->get_storerating($simproduct->store_id);
												if($store_rating)
												{
													 for($i=1;$i<=$store_rating->rate;$i++)
													 {
														echo '<div class="star fa fa-star"></div>';
													 }
												
												?>
											  </div>
											  <p class="nb-comments text-center"><?php echo $store_rating->counting;?> Review(s)</p>
											 <?php }?>
											</div>
										  </div>
										  <div  class="price-box text-center"> <span class="price product-price"><?php  echo DEFAULT_CURRENCY." ".$simproduct->min_price;?></span> <span class="price product-price clr-grey">
											<amall> <?php  echo DEFAULT_CURRENCY." ".$simproduct->max_price;?> </amall>
											</span></div>
										</div>
										<div class="grey-bg clearfix mar-bot-no">
										  <h4 class="text-primary pull-left"><strong><?php  echo DEFAULT_CURRENCY." ".$simproduct->cashback_price;?> 	</strong></h4>
                                           <?php
											 $coinvalue = round(($simproduct->min_price/COINVALUE));
											?>
										  <h5 class="pull-right"><strong><?php  echo $coinvalue." ".$admindetailss[0]->coin_code;?> coins </strong></h5>
										</div>
									  </div>
									</div>
								  <?php
									}
								$k++;
								}
							}
							else{
							?>	<div class="alert alert-danger bs-alert-old-docs">
										<center>
										  <strong>No data found!</strong>
										</center>
									</div>
								
							<?php
							} 
							?>
								  </div>
								</div>
								<!-- .tab_container -->
								<div class="boxprevnext"> <a class="prev prevtabcate2"><i class="fa fa-angle-double-left"></i></a> <a class="next nexttabcate2"><i class="fa fa-angle-double-right"></i></a> </div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					  <!-- #center_column --> 
					</div>
				</div>
                <div id="tab_38" class="tab_category">
                  <!--<div class="row">
                    <div class="col-md-12">
                      <div class="row-fluid clearfix top-content box-shad4">
                        <ul class="list-inline text-center nomargin">
                          <li><span>sinch launch</span><span class="data-box bor-rad3">85.12%</span></li>
                          <li><span>last 30 days</span><span class="data-box bor-rad3">85.12%</span></li>
                          <li><span>last 60 days</span><span class="data-box bor-rad3">85.12%</span></li>
                          <li><span>last 90 days</span><span class="data-box bor-rad3">85.12%</span></li>
                        </ul>
                      </div>
                    </div>
                  </div>-->
                </div>
              
              <div id="tab_39" class="tab_category">
                <div class="row-fluid clearfix mt20 box-shad4 pall expert-reviews-tab-inr-cont">
                  <ul class="list-inline nomargin">
                    <li class="bor-rad4">
                      <div class="media">
                        <div class="media-left media-middle"> <img src="<?php echo base_url(); ?>front/img/expert1.jpg" />
                          <div class="expert-perc back-green  bor-rad3"> 85% </div>
                        </div>
                        <div class="media-body">
                          <h4>technobaffalo <a class="btn-vread">watch video review</a><a class="btn-read" data-toggle="modal" data-target="#modal_critic_view">read complete review</a></h4>
                          <p>With the world's most advanced operating system, you can perform endless functions on your Apple iPhone 6 that were earlier not possible. The iOS operating system has added novel ways.</p>
                          <ul class="list-inline review-list nomargin">
                            <li><strong>was this review helpful to you?</strong></li>
                            <li><a href="#">yes</a></li>
                            <li><a href="#">no</a></li>
                            <li><a href="#">(report appropriate content)</a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="bor-rad4">
                      <div class="media">
                        <div class="media-left media-middle"> <img src="<?php echo base_url(); ?>front/img/expert2.jpg" />
                          <div class="expert-perc back-blue  bor-rad3"> 85% </div>
                        </div>
                        <div class="media-body">
                          <h4>technobaffalo <a href="#" class="btn-vread">watch video review</a><a href="#" class="btn-read">read complete review</a></h4>
                          <p>With the world's most advanced operating system, you can perform endless functions on your Apple iPhone 6 that were earlier not possible. The iOS operating system has added novel ways.</p>
                          <ul class="list-inline review-list nomargin">
                            <li><strong>was this review helpful to you?</strong></li>
                            <li><a href="#">yes</a></li>
                            <li><a href="#">no</a></li>
                            <li><a href="#">(report appropriate content)</a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="bor-rad4">
                      <div class="media">
                        <div class="media-left media-middle"> <img src="<?php echo base_url(); ?>front/img/expert3.jpg" />
                          <div class="expert-perc back-yellow bor-rad3"> 85% </div>
                        </div>
                        <div class="media-body">
                          <h4>technobaffalo <a href="#" class="btn-vread">watch video review</a><a href="#" class="btn-read">read complete review</a></h4>
                          <p>With the world's most advanced operating system, you can perform endless functions on your Apple iPhone 6 that were earlier not possible. The iOS operating system has added novel ways.</p>
                          <ul class="list-inline review-list nomargin">
                            <li><strong>was this review helpful to you?</strong></li>
                            <li><a href="#">yes</a></li>
                            <li><a href="#">no</a></li>
                            <li><a href="#">(report appropriate content)</a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="bor-rad4">
                      <div class="media">
                        <div class="media-left media-middle"> <img src="<?php echo base_url(); ?>front/img/expert4.jpg" />
                          <div class="expert-perc back-green bor-rad3"> 85% </div>
                        </div>
                        <div class="media-body">
                          <h4>technobaffalo <a href="#" class="btn-vread">watch video review</a><a href="#" class="btn-read">read complete review</a></h4>
                          <p>With the world's most advanced operating system, you can perform endless functions on your Apple iPhone 6 that were earlier not possible. The iOS operating system has added novel ways.</p>
                          <ul class="list-inline review-list nomargin">
                            <li><strong>was this review helpful to you?</strong></li>
                            <li><a href="#">yes</a></li>
                            <li><a href="#">no</a></li>
                            <li><a href="#">(report appropriate content)</a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div id="tab_40" class="tab_category">
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel-group  " id="accordion1">
                      <div class="panel panel-primary">
                        <div class="panel-heading panel-plus-link"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1"> Apple iPhone 6 offers you more than just 8 megapixels? <span class="pull-right ques-ans">
                          <button type="button" class="btn btn-sky-blue btn-115-23">answer this</button>
                          <span class="back-btn back-btn-yellow btn btn-40-27">6</span> answers </span> </a> </div>
                        <div id="collapseOne1" class="panel-collapse collapse in">
                          <div class="panel-body  ques-accord">
                            <div class="qa-box">
                              <p>Apple iPhone 6 offers you more than just 8 megapixels in its camera function. The primary camera has a new sensor with focus pixels and better exposure adjustments. It also features improved face detection technology and panorama functions.</p>
                              <p class="ans-by">by: david <span class="support-center"><span class="ico"></span> support center</span> 2 days ago</p>
                              <p><b>was this review helpful for you?</b> <a href="#">yes</a> <a href="#">no</a></p>
                            </div>
                            <div class="qa-box">
                              <p>Apple iPhone 6 offers you more than just 8 megapixels in its camera function. The primary camera has a new sensor with focus pixels and better exposure adjustments. It also features improved face detection technology and panorama functions.</p>
                              <p class="ans-by">by: david <span class="support-center"><span class="ico"></span> support center</span> 2 days ago</p>
                              <p><b>was this review helpful for you?</b> <a href="#">yes</a> <a href="#">no</a></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-primary">
                        <div class="panel-heading panel-plus-link"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1"> Apple iPhone 6 offers you more than just 8 megapixels? <span class="pull-right ques-ans">
                          <button type="button" class="btn btn-sky-blue btn-115-23">answer this</button>
                          <span class="back-btn back-btn-yellow btn btn-40-27">6</span> answers </span> </a> </div>
                        <div id="collapseTwo1" class="panel-collapse collapse">
                          <div class="panel-body  ques-accord">
                            <div class="qa-box">
                              <p>Apple iPhone 6 offers you more than just 8 megapixels in its camera function. The primary camera has a new sensor with focus pixels and better exposure adjustments. It also features improved face detection technology and panorama functions.</p>
                              <p class="ans-by">by: david <span class="support-center"><span class="ico"></span> support center</span> 2 days ago</p>
                              <p><b>was this review helpful for you?</b> <a href="#">yes</a> <a href="#">no</a></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-primary">
                        <div class="panel-heading panel-plus-link"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1"> Apple iPhone 6 offers you more than just 8 megapixels? <span class="pull-right ques-ans">
                          <button type="button" class="btn btn-sky-blue btn-115-23">answer this</button>
                          <span class="back-btn back-btn-yellow btn btn-40-27">6</span> answers </span> </a> </div>
                        <div id="collapseThree1" class="panel-collapse collapse">
                          <div class="panel-body  ques-accord">
                            <div class="qa-box">
                              <p>Apple iPhone 6 offers you more than just 8 megapixels in its camera function. The primary camera has a new sensor with focus pixels and better exposure adjustments. It also features improved face detection technology and panorama functions.</p>
                              <p class="ans-by">by: david <span class="support-center"><span class="ico"></span> support center</span> 2 days ago</p>
                              <p><b>was this review helpful for you?</b> <a href="#">yes</a> <a href="#">no</a></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-primary">
                        <div class="panel-heading panel-plus-link"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1"> Apple iPhone 6 offers you more than just 8 megapixels? <span class="pull-right ques-ans">
                          <button type="button" class="btn btn-sky-blue btn-115-23">answer this</button>
                          <span class="back-btn back-btn-yellow btn btn-40-27">6</span> answers </span> </a> </div>
                        <div id="collapseFour1" class="panel-collapse collapse">
                          <div class="panel-body  ques-accord">
                            <div class="qa-box">
                              <p>Apple iPhone 6 offers you more than just 8 megapixels in its camera function. The primary camera has a new sensor with focus pixels and better exposure adjustments. It also features improved face detection technology and panorama functions.</p>
                              <p class="ans-by">by: david <span class="support-center"><span class="ico"></span> support center</span> 2 days ago</p>
                              <p><b>was this review helpful for you?</b> <a href="#">yes</a> <a href="#">no</a></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- panel-group --> 
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid clearfix mt20 tab-chart-content box-shad4">
      <div id="container" style="min-width:1155px; height: 400px; margin: 0 auto"></div>
      <div class="chart-overlay">
       <!-- <ul class="list-inline nomargin">
          <li class="lowest bor-rad3"> lowest: rs.45,223</li>
          <li class="highest bor-rad3"> highest: rs.76,223</li>
          <li  class="complete bor-rad3">view complete index</li>
        </ul>-->
      </div>
    </div>
	
    <!--- Tab-sec ylw ends here --->
    
    <div class="row-fluid clearfix mt20">
      <div class="tab-like-tab  user-reviews-tab">
        <div class="pos_tab bor-ylw">
          <div class="cate_title">
            <div class="megashop ">
              <h3 class="bg-ylw">User Reviews And Q and A</h3>
            </div>
          </div>
        </div>
        <div class="box-shad4 tab-content clearfix">
          <div class="row-fluid clearfix">
            <h4 class="nomargin">customer ratings</h4>
          </div>
		  <?php
		  
		  //Seetha Dec 17-2015
		 $avg_rating =$this->front_model->avg_reviews_rating($product->product_id);
		 $count_rating =$this->front_model->count_rating($product->product_id);
		 $cntprocom = $this->front_model->get_cntprocom($product->product_id);
		 $cntprofun = $this->front_model->get_cntprofun($product->product_id);
		 $get_cntconscom = $this->front_model->get_cntconscom($product->product_id);
		 $get_cntconsfun = $this->front_model->get_cntconsfun($product->product_id);
		
		  ?>
          <div class="row">
            <div class="inner-cont0 cont">
              <ul class="list-inline mt10">
                <li>
			<?php
			for($i=1;$i<=5;$i++)
			{
				if(round($avg_rating->rate)==$i){
					echo '<img src="'.base_url().'front/img/rating/'.$i.'.png" />';				
				}
				
			}
		
			?>
				</li>
                <li class="fbold f14"><?php echo round($avg_rating->rate); ?></li>
                <?php 
				if($count_rating)
				{
					$ratingcount = $count_rating->counting;
				}
				else
				{
					$ratingcount = 0;
				}
				?>
                <li><?php echo $ratingcount;?> reviews</li>
              </ul>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo</p>
              <p>
			  <?php
			  if($this->session->userdata('user_id')!='')
			  {			  
			  ?>
                <button type="button" class="btn btn-user-review" data-toggle="modal" data-target="#modal_user_review">review this product</button>
			 <?php
			  }
			  else{?>
			  <button type="button" class="btn btn-user-review" data-toggle="modal" data-target="#LoginModal">review this product</button>
			  <?php } ?>
			 
              </p>
             <!-- <p><a href="#"><i class="fa fa-caret-right"></i> tips for writing a review</a></p>-->
            </div>
            <div class="inner-cont2 cont">
			<?php
			$overall =$this->front_model->getprogressbar_product($product->product_id);
			?>
              <h5 class="">overall rating totals</h5>
              <ul class="list-unstyled nomargin">
			  <?php	
	
	  
			   if($overall)
			   {
				  foreach($overall as $all)
				  {			  
						
			  ?>
                <li> <span class="name"><?php echo $all->rating;?> stars</span>
                  <div class="progress">
				  <?php $sd = ($all->Cnt/round($avg_rating->rate))*100;?>
                    <div style="width:<?php echo $sd;?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" class="progress-bar"> </div>
                  </div>
                  <span class="value">(<?php echo $all->Cnt;?>)</span> </li>
               <?php
				  }
			  }
			  ?>
              </ul>
            </div>
            <div class="inner-cont3 cont">
              <h5 class="">pros</h5>
              
              <?php

			  ?>
              <?php 
			  
			  ?>
              <ul class="list-inline mt5">
				<li>comfortable <span class="text-gray">(<?php if(isset($cntprocom->pros_com)) { echo $cntprocom->pros_com;} else { echo '0'; }?>)</span></li>
				<li>functional <span class="text-gray">(<?php if(isset($cntprofun->pros_fun)) { echo $cntprofun->pros_fun;} else { echo '0'; }?>)</span></li>		
              </ul>
             
              
            </div>
            <div class="inner-cont3 cont">
              <h5 class="">cons</h5>
              <ul class="list-inline mt5">               
                 <li>comfortable <span class="text-gray">(<?php if(isset($get_cntconscom->cons_com)) { echo $get_cntconscom->cons_com;} else { echo '0'; }?>)</span></li>
                 <li>functional <span class="text-gray">(<?php if(isset($get_cntconsfun->cons_fun)) { echo $get_cntconsfun->cons_fun;} else { echo '0'; }?>)</span></li>		         
                <!--<li><a href="#">+ see more cons</a></li>-->
              </ul>
            </div>
           <!-- <div class="inner-cont4 cont">
              <h3 class="">have a question?</h3>
              <div class="row">
                <div class="left">
                   <div class="qanda-bg">
                   <p><a href="#">get it answered > </a></p>
                  </div>
                </div>
                <div class="right">
                 <!-- <p>
				   <?php
				   if($this->session->userdata('user_id')!='')
				  {			  
				  ?>
                    <button type="button" class="btn btn-user-review" data-toggle="modal" data-target="#modal_user_question">ask question</button>
					
				  <?php }else{?>
				  <button type="button" class="btn btn-user-review" data-toggle="modal" data-target="#LoginModal">ask question</button>
				  <?php }  ?>
                  </p>
                  <p>(OR)</p>
                  <p>
				   <?php
				  if($this->session->userdata('user_id')!='')
				  {			  
				  ?>
                    <button type="button" class="btn btn-user-review" data-toggle="modal" data-target="#modal_user_review">review this product</button>
				  <?php } else {?>
				  <button type="button" class="btn btn-user-review" data-toggle="modal" data-target="#LoginModal">review this product</button>
				  <?php }?>
                  </p>
                </div>
              </div>
            </div>-->
          </div>
		<?php $reviews = $this->front_model->get_myproductreviews($product->product_id);
		if($reviews) 
		{ 
			$rr=0; 
			foreach($reviews  as $review)
			{ $rr++; 			
		?>
          <div class="row-fluid clearfix bot-content lirev" <?php if($rr>1){ echo "style='display:none;'";} ?>>
            <div class="left-content">
		
              <ul class="list-unstyled nomargin">
                <p><?php $date1 =$review->date_added; echo date('M d,Y', strtotime($date1));?></p>
                <p><?php for($ir=1;$ir<=5;$ir++){
				if($review->rating==$ir){
					echo '<img src="'.base_url().'front/img/rating/'.$ir.'.png" />';}}
				?>
			<strong><?php echo $review->rating;?> out of 5</strong></p>
                <h5>quality</h5>
                <p><?php for($iq=1;$iq<=5;$iq++){
				if($review->quality==$iq){
					echo '<img src="'.base_url().'front/img/bars/'.$iq.'.jpg" />';}}
				?> <strong><?php echo $review->quality;?> out of 5</strong></p>
                <h5>meet expectaions</h5>
                <p><?php for($ie=1;$ie<=5;$ie++){
				if($review->expectations==$ie){
					echo '<img src="'.base_url().'front/img/bars/'.$ie.'.jpg" />';}}
				?><strong><?php echo $review->expectations;?> out of 5</strong></p>
                <p><strong>primary use:</strong><?php echo $review->primary_user;?></p>
                <p><strong>brought this:</strong><?php echo $review->brought_this;?></p>            
              </ul>
            </div>
            <div class="right-content">
              <h3>bit overpriced</h3>
              <p class="head">pros</p>
              <p><?php echo $review->pros_summary;?></p>
              <p class="head">cons</p>
              <p><?php echo $review->cons_summary;?></p>
             <!-- <ul class="list-inline">
                <li><strong>was this review helpful to you?</strong></li>
                <li><a href="#">yes</a></li>
                <li><a href="#">no</a></li>
                <li><a href="#">report appropriate content</a></li>
              </ul>-->
              <ul class="list-inline social-share">
                <li>share this review:</li>
                <li class="fb"> <span class='st_sharethis_large' displayText='ShareThis'></span></li>
                <li class="fb"> <span class='st_facebook_large' displayText='Facebook'></span></li>
                <li class="fb"> <span class='st_twitter_large' displayText='Tweet'></span></li>
                <li class="fb"> <span class='st_linkedin_large' displayText='LinkedIn'></span></li>
                <li class="fb"> <span class='st_pinterest_large' displayText='Pinterest'></span></li>
                 <li class="fb"><span class='st_email_large' displayText='Email'></span></li>


               <!-- <li class="fb"><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="tw"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="go"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li class="blog"><a href="#"><i class="fa fa-bold"></i></a></li>
                <li class="vk"><a href="#"><i class="fa fa-vk"></i></a></li>
                <li class="in"><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
              </ul>
            </div>
          </div>
		  <?php
			}
		}else{
			echo "<div class='row-fluid clearfix bot-content lirev'>No reviews found.</div>
			";
		}?>
          <?php if($reviews) {?><div class="view-more mt10"> <a id="revshow" class="btn-embed btn-170-20 btn bor-rad0" href="javascript:;"> view more user reviews</a> </div><?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!--- inner pagesec ends here --->



<!--- partners ebds here --->



<!--- newsletter sec ends here --->

<?php 
	$this->load->view('front/sub_footer');
//Footer
	$this->load->view('front/site_intro');	
// footer ends here  
	$this->load->view('front/js_scripts');
?>

<!--- footer ends here ---> 

<a href="#" id="backtotop"><span class="fa fa-angle-up"></span><span class="back-to-top">Back to Top</span></a> 
<script type="text/javascript">
//<![CDATA[
    var searchForm = new Varien.searchForm('search_mini_form', 'search', 'Search ...');
    searchForm.initAutocomplete('', 'search_autocomplete');
    jQuery('#search_mini_form .ddslick').ddslick({
        width: 160,
        onSelected: function (opt) {
            jQuery('#search_mini_form #catsearch').val(opt.selectedData.value)
        }
    });
//]]>
</script> 
<script type="text/javascript">
//<![CDATA[
    jQuery(document).ready(function($) {     
        $('#block-categories-19088595111446117677 .wrap_item').owlCarousel({
         items: 4,
            itemsCustom: [ 
               [0, 2], 
               [480, 3], 
               [768, 5], 
               [992, 5], 
               [1200, 6] 
            ],
            pagination: false,
            slideSpeed : 800,
            addClassActive: true,
            scrollPerPage: false,
            touchDrag: false,
            afterAction: function (e) {
                if(this.$owlItems.length > this.options.items){
                    $('#block-categories-19088595111446117677 .navslider').show();
                }else{
                    $('#block-categories-19088595111446117677 .navslider').hide();
                }
            }            
        });
      $('#block-categories-19088595111446117677 .navslider .prev').on('click', function(e){
         e.preventDefault();
         $('#block-categories-19088595111446117677 .wrap_item').trigger('owl.prev');
      });
      $('#block-categories-19088595111446117677 .navslider .next').on('click', function(e){
         e.preventDefault();
         $('#block-categories-19088595111446117677 .wrap_item').trigger('owl.next');
      });
    });
//]]>
</script> 
<script type="text/javascript"> 
			$(document).ready(function() {
				var owl = $(".productTabCategorySlider2");
				owl.owlCarousel({
				items :4,
				slideSpeed: 1000,
				pagination : false,
				itemsDesktop : [1200,4],
				itemsDesktopSmall : [1024,3],
				itemsTablet: [980,2],
				itemsMobile : [480,1]
				});
				$(".nexttabcate2").click(function(){
				owl.trigger('owl.next');
				})
				$(".prevtabcate2").click(function(){
				owl.trigger('owl.prev');
				})  
			});
		</script> 
<script type="text/javascript"> 
			$(document).ready(function() {
				var owl = $(".productTabCategorySlider1");
				owl.owlCarousel({
				items :4,
				slideSpeed: 1000,
				pagination : false,
				itemsDesktop : [1200,4],
				itemsDesktopSmall : [1024,3],
				itemsTablet: [980,2],
				itemsMobile : [480,1]
				});
				$(".nexttabcate1").click(function(){
				owl.trigger('owl.next');
				})
				$(".prevtabcate1").click(function(){
				owl.trigger('owl.prev');
				})  
			});
		</script> 
<script type="text/javascript">

$(document).ready(function() {

	$(".tab2_category").hide();
	$(".tab2_category:first").show(); 
	$(".tab2_title").hide();
	$(".tab2_title:first").show();
	$("ul.tab2_cates li").click(function() {
		$("ul.tab2_cates li").removeClass("active");
		$(this).addClass("active");
		$(".tab2_category").hide();
		$(".tab2_title").hide();
		$(".tab2_category").removeClass("animate1 wiggle");
		var activeTab = $(this).attr("rel");
		var tab2_title = $(this).attr("data-title");				
		$("#"+activeTab) .addClass("animate1 wiggle");
		$("#"+activeTab).fadeIn(); 
		$("#"+tab2_title).fadeIn(); 
	});
});

</script> 
<script type="text/javascript">

$(document).ready(function() {

	$(".tab_category").hide();
	$(".tab_category:first").show();
		$(".tab_title").hide();
	$(".tab_title:first").show(); 

	$("ul.tab_cates li").click(function() {
		$("ul.tab_cates li").removeClass("active");
		$(this).addClass("active");
		$(".tab_category").hide();
		$(".tab_title").hide();
		$(".tab_category").removeClass("animate1 wiggle");
		var activeTab = $(this).attr("rel"); 
		var tab_title = $(this).attr("data-title"); 
		$("#"+activeTab) .addClass("animate1 wiggle");
		$("#"+activeTab).fadeIn(); 
		$("#"+tab_title).fadeIn(); 
	});
});

</script> 
<script type="text/javascript"> 
			$(document).ready(function() {
				var owl = $(".logo-slider");
				owl.owlCarousel({
				items :6,
				slideSpeed: 1000,
				pagination : false,
				itemsDesktop : [1200,6],
				itemsDesktopSmall : [980,5],
				itemsTablet: [767,4],
				itemsMobile : [480,2]
				});
				$(".nextlogo").click(function(){
				owl.trigger('owl.next');
				})
				$(".prevlogo").click(function(){
				owl.trigger('owl.prev');
				})  
			});
		</script> 
<script type="text/javascript"> 
			$(document).ready(function() {
				var owl = $("#partners-slider");
				owl.owlCarousel({
				items :6,
				slideSpeed: 1000,
				pagination : false,
				itemsDesktop : [1200,6],
				itemsDesktopSmall : [980,5],
				itemsTablet: [767,4],
				itemsMobile : [480,2]
				});
				$(".nextpart").click(function(){
				owl.trigger('owl.next');
				})
				$(".prevpart").click(function(){
				owl.trigger('owl.prev');
				})  
			});
		</script> 
<script type="text/javascript"> 
			$(document).ready(function() {
				var owl = $("#product-embed");
				owl.owlCarousel({
				items :3,
				slideSpeed: 1000,
				pagination : false,
				itemsDesktop : [1200,6],
				itemsDesktopSmall : [980,5],
				itemsTablet: [767,4],
				itemsMobile : [480,2]
				});
				$(".nextpartt").click(function(){
				owl.trigger('owl.next');
				})
				$(".prevpartt").click(function(){
				owl.trigger('owl.prev');
				})  
			});
		</script> 
<script type="text/javascript"> 
			$(document).ready(function() {
				var owl = $(".productTabCategorySlider3");
				owl.owlCarousel({
				items :1,
				slideSpeed: 1000,
				pagination : false,
				itemsDesktop : [1200,1],
				itemsDesktopSmall : [1024,1],
				itemsTablet: [980,2],
				itemsMobile : [480,1]
				});
				$(".nexttabcate4").click(function(){
				owl.trigger('owl.next');
				})
				$(".prevtabcate4").click(function(){
				owl.trigger('owl.prev');
				})  
			});
		</script> 
<script src="<?php echo base_url(); ?>front/js/bx-slider.js"></script>
  <!-- Modal embed code -->
    <div class="modal fade modal-embed" id="modal_embed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Product details</h4>
          </div>
          <div class="modal-body">
            <ul class="list-inline clearfix">
              
              <li class="col-md-12">
                <div class="product-detail-embed">                 
                  <p>
                  <?php echo strip_tags($product->description);?>
                  </p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal embed code -->
    
     <!-- Modal embed code Features -->
    <div class="modal fade modal-embed" id="modal_embed_features" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Product details</h4>
          </div>
          <div class="modal-body">
            <ul class="list-inline clearfix">
              
              <li class="col-md-12">
                <div class="product-detail-embed">                 
                  <p>
                  <?php echo $product->key_feature;?>
                  </p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
     <!-- Modal embed code Features -->
 <!-- Seetha Dec 15-2015 -->
 <!-- Modal user ask question -->
<div class="modal fade modal-user-question" id="modal_user_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" id="modalclosebutton" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      	<h3>have a question?</h3>
        <div class="row-fluid clearfix mt10">
			<span class="msg"></span>
        	<?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'question_form','id'=>'question_form', 'onSubmit'=>'return funct_questions_cat();', 'autocomplete'=>'off','method'=>'post');
				echo form_open('',$attribute);		
			?>
			<input type="hidden" name="save" value="Submit Questions" id="save" />
              <div class="form-group">
                <div class="form-group">
                <label for="">type a question</label> 
                </div>
                <textarea class="form-control text-center" placeholder="enter here" name="question" id="question" onkeypress="clearss(1);"></textarea>
              </div>
              
              <div class="form-group row mt20">
                <label for="" class="col-md-12 mb20">question category:</label>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch1" name="cc[]" value="quality" />
						<label for="ch1"><span></span>quality issues(physical)</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch2" name="cc[]" value="warranty"/>
						<label for="ch2"><span></span>warranty</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch3" name="cc[]" value="usageofproduct"/>
						<label for="ch3"><span></span>usage of product</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch4" name="cc[]" value="specifications" />
						<label for="ch4"><span></span>specifications</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch5" name="cc[]" value="usefulinformation"/>
						<label for="ch5"><span></span>useful information</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch6" name="cc[]" value="qualityissues"/>
						<label for="ch6"><span></span>quality issues(software)</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch7" name="cc[]" value="saleissues"/>
						<label for="ch7"><span></span>sale issues</label>
                </div>
                <div class="form-group filter-check check-modal col-md-4">
						<input type="checkbox" id="ch8" name="cc[]" value="others" />
						<label for="ch8"><span></span>others</label>
                </div>
              </div>
              
              <div class="form-group">
           <!--     <span class="facebook-share">share this review on <span class="text-blue">FACEBOOK, twitter, google plus</span> and get <span class="text-blue"><?php echo $product->reward_points;?></span> reward points</span>-->
                <input type="submit"  class="btn btn-yellow" name="saved" id="saved" value="Submit Questions"  onclick="return funct_questions_cat();">
              </div>
              
            </form>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal user ask question-->
<!-- Modal user review product -->
<div class="modal fade modal-user-review" id="modal_user_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" id="reviewcloseid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span class="msg"></span>
		<?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'revform','id'=>'revform', 'onSubmit'=>'return funct_setpremium_cat();', 'autocomplete'=>'off','method'=>'post');
				echo form_open('',$attribute);		
		?>
		<input type="hidden" name="submit" value="Submit review" id="submit" />
		<input type="hidden" id="product_id" name="product_id" value="<?php echo $product->product_id?>">
		<div class="row-fluid clearfix mt10">
        	<div class="rate-content">			
            	<ul class="list-inline nomargin text-center clearfix">
                	<li class="col-md-4">
                    	<p>overall rating</p>
                        <div class="rating">
						  <input type="radio" id="star5"  name="rating" value="5" />
						  <label for="star5">5 stars</label>
						  <input type="radio" id="star4"   name="rating" value="4" />
						  <label for="star4">4 stars</label>
						  <input type="radio" id="star3"   name="rating" value="3" />
						  <label for="star3">3 stars</label>
						  <input type="radio" id="star2"   name="rating" value="2" />
						  <label for="star2">2 stars</label>
						  <input type="radio" id="star1"   name="rating" value="1" />
						  <label for="star1">1 star </label>
						</div>
                    </li>
                    <li class="col-md-4">
                    	<p>quality</p>
                         <div class="rating">
						  <input type="radio" id="sstar5"  name="quality" value="5" />
						  <label for="sstar5">5 stars</label>
						  <input type="radio" id="sstar4"   name="quality" value="4" />
						  <label for="sstar4">4 stars</label>
						  <input type="radio" id="sstar3"   name="quality" value="3" />
						  <label for="sstar3">3 stars</label>
						  <input type="radio" id="sstar2"   name="quality" value="2" />
						  <label for="sstar2">2 stars</label>
						  <input type="radio" id="sstar1"   name="quality" value="1" />
						  <label for="sstar1">1 star </label>
						</div>
                    </li>
                    <li class="col-md-4">
                    	<p>meet expectations</p>
                         <div class="rating">
						  <input type="radio" id="ssstar5"  name="expectations" value="5" />
						  <label for="ssstar5">5 stars</label>
						  <input type="radio" id="ssstar4"   name="expectations" value="4" />
						  <label for="ssstar4">4 stars</label>
						  <input type="radio" id="ssstar3"   name="expectations" value="3" />
						  <label for="ssstar3">3 stars</label>
						  <input type="radio" id="ssstar2"   name="expectations" value="2" />
						  <label for="ssstar2">2 stars</label>
						  <input type="radio" id="ssstar1"   name="expectations" value="1" />
						  <label for="ssstar1">1 star</label>
						</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row-fluid clearfix mt10">
        	
              <div class="form-group">
                <label for="">review headline</label>
                <input type="text" class="form-control" onkeypress="clears(1);" id="review_title" name="review_title" placeholder="enter here">
              </div>
              <div class="form-group">
                <div class="form-group">
                <label for="">pros summary</label> 
                 </div>
                <textarea class="form-control text-center" onkeypress="clears(1);" id="pros_summary" name="pros_summary" placeholder="enter here"></textarea>
				
              </div>
			 <div class="form-group row">
                <label for="" class="col-md-3">pros reviews:</label>
                <label class="radio-inline col-md-2">
                  <input type="radio" name="pros_reviews"  required id="pros_reviews" value="0"> Comfortable
                </label>
                <label class="radio-inline col-md-3">
                  <input type="radio" name="pros_reviews"  required id="pros_reviews" value="1"> Functional
                </label>
              </div>
			 <div class="form-group">
                <div class="form-group">
                <label for="">cons summary</label>                
                </div>
                <textarea class="form-control text-center" required id="cons_summary" name="cons_summary"  onkeypress="clears(1);" placeholder="enter here"></textarea>	
              </div>
			  <div class="form-group row">
                <label for="" class="col-md-3">cons reviews:</label>
                <label class="radio-inline col-md-2">
                  <input type="radio" name="cons_reviews" id="cons_reviews" value="0"> Comfortable
                </label>
                <label class="radio-inline col-md-3">
                  <input type="radio" name="cons_reviews" id="cons_reviews" value="1"> Functional
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="rad1" id="rad1" value="0"> yes 1 wodld recommend this to others and friends
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="rad1" id="rad1" value="1"> no 1 wodld recommend this to others and friends
                </label>
              </div> 
              <div class="form-group row mt20">
                <label for="" class="col-md-3">primary use:</label>
                <label class="radio-inline col-md-2">
                  <input type="radio" name="primary_user" id="primary_user" value="home"> home
                </label>
                <label class="radio-inline col-md-3">
                  <input type="radio" name="primary_user" id="primary_user" value="office"> office
                </label>
                <label class="radio-inline col-md-3">
                  <input type="radio" name="primary_user" id="primary_user" value="others"> others
                </label>
              </div>
              <div class="form-group row">
                <label for="" class="col-md-3">brought this:</label>
                <label class="radio-inline col-md-2">
                  <input type="radio" name="brought_this" id="brought_this" value="online"> online
                </label>
                <label class="radio-inline col-md-3">
                  <input type="radio" name="brought_this" id="brought_this" value="office"> office(in store)
                </label>
              </div>
              <div class="form-group">
               <!-- <span class="facebook-share">share this review on <span class="text-blue"><a href="<?php if($admindetailss[0]->admin_fb) { echo $admindetailss[0]->admin_fb;}?>">FACEBOOK</a></span> and get <span class="text-blue"><?php echo $product->reward_points;?></span> reward points</span>-->
                <input type="submit"  class="btn btn-yellow" name="submit" id="submit" value="Submit review"  onclick="return funct_setpremium_cat();">
              </div>        
            
        </div>
		</form>
      </div>
    </div>
  </div>
</div>
<!-- Modal user review product -->
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	<div class="modal-content"> 
	<!--<div class="modal-header bor-no">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	</div>-->
	<div class="modal-body">
	<button type="button" class="close login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="row">
			<div class="account-login">
		  <div class="page-title text-center">
			<h1>Login or Create an Account</h1>
		  </div>
			<?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'login_form1','id'=>'login_form1','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login();');				
				echo form_open('cashback/chk_invalid',$attribute);
				
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
			<input type="hidden" name="signin" value="signin" id="signin" />
			<center><span id="userstatus" style="color:red; font-weight:bold;"> </span></center>
			<div class="col-md-12 col-sm-12">
			  <div class="registered-users">
				<div class="content">
				  <div class="account-login-title registered-users-title">
					<h2>Registered Customers</h2>
				  </div>
				  <p>If you have an account with us, please log in.</p>					
				  <ul class="form-list">
					<li>
					  <label class="required" for="email"><em>*</em>Email Address</label>
					  <div class="input-box">
						<input type="text" title="Email Address" class="input-text required-entry validate-email" id="email" value="" required name="email">
					  </div>
					</li>
					<li>
					  <label class="required" for="pass"><em>*</em>Password</label>
					  <div class="input-box">
						<input type="password" title="Password" required id="pass" class="input-text required-entry validate-password" name="pwd">
					  </div>
					</li>
				  </ul>				
				  <p class="required">* Required Fields</p>
				</div>
			  </div>
			  <div class="registered-users">
				<div class="buttons-set"> 
				<div class="row gap-bottom-45"><div class="col-md-12"><a class="f-left" href="<?php echo base_url()?>/cashback/forgetpassword">Forgot Your Password?</a>
				<!--<button id="signin" name="signin" title="Login" class="button" type="submit"><span><span>Login</span></span></button>-->
				<input type="submit" class="btn btn-primary pull-left" name="signin" title="Login" id="signin" value="Login">
				  
				</div></div>

				<?php
					$redirect_urlstring =  uri_string();
					if($redirect_urlstring=="")
					{
					  $redirect_urlstring = 'cashback/index';
					}
					$redirect_endcede = insep_encode($redirect_urlstring);					
				?>
				<!-- start social buttons -->
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="social-btn facebook">
							<i class="fa fa-facebook"></i>
							<a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><button type="button">Facebook</button><a/>
						</div>
						</div>
					<div class="col-md-6 col-sm-6">
						<div class="social-btn google-plus">
							<i class="fa fa-google-plus"></i>
							<a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><button type="button">Google+</button></a>
						</div>
					</div>
				</div>
				</div>             
			  </div>             
			  </div>                
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
 <!-- Seetha Dec 15-2015 -->
</body>
<style>

</style>
<script type="text/javascript">
	$( ".sort_default_list" ).change(function() {
		$("#ajaxloading").show();
		$('#tab_33').hide();
	 	var sortdefaltval = $(this).val();
		var product_id = $('#product_id').val();
		scrapping_sort(product_id,sortdefaltval);
		
	});
	
	$('.sorting_checkbox').click(function(){
		$("#ajaxloading").show();
		$('#tab_33').hide();
		var product_id = $('#product_id').val();
		if($(this).is(':checked'))
		{
			var checkedval = $(this).val();
			scrapping_sort(product_id,checkedval);
		}
		else
		{
			var checkedval =  $(this).val();
			scrapping_sort(product_id,'');
		}
		
	});

</script>
<script type="text/javascript">
$('#pricealert').click(function(){
var priceemail = $('#priceemail').val();
var product_id = $('#product_id').val();
if(!priceemail)
{
	$('#priceemail').css('border','2px solid red');
	return false;
}
if(!validateEmail(priceemail))
{
	$('#priceemail').css('border','2px solid red');
	return false;
}
$('#priceemail').css('border','');
	$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>cashback/pricealert',
			data:{'priceemail':priceemail,'product_id':product_id,},
			 success:function(result){
				if(result==1)
				{
					$(".unique_name_error").css('color','#29BAB0');
  				 	$(".unique_name_error").html('Price drop alert set successfully');
					$("#priceemail").val('');
				}
				else
				{
					$(".unique_name_error").css('color','#ff0000');					
					$(".unique_name_error").html('Price drop alert already set');
					$("#priceemail").val('');
				}
			}
		});
});


function scrapping_sort(product_id,sortdefaltval)
{
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>cashback/scrapping_sort',
			data:$('#sortform').serialize(),
			 success:function(result){
				if(result!=0)
				{
					$("#ajaxloadingdiv").html(result);
					$("#ajaxloading").hide();
					$('#tab_33').show();
				}
				else
				{
					$("#ajaxloadingdiv").html(' <div class="view-5more text-center" id="nostores"> <a class="view-5more-btn btn-price btn-215-30 btn"> No Stores Found</a> </div>');
					$("#ajaxloading").hide();
					$('#tab_33').show();
					
				}
			}
		});
}

/*SELECT price, image_bucket,mm.imagename as image, mm.title as title,mm.category as category, url FROM
 msp_category mc,msp_master mm ,msp_pricetable mp WHERE mm.mspid = '2439' AND mp.mspid = '2439' AND mc
.category = mm.category;*/

function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( email ) ) {
        return false;
    } else {
        return true;
    }
}

</script>

<style>
#ajaxloading {
  /*position: relative;*/
 /* background-color: gray; *//* for demonstration */
  min-height: 300px;
}
.ajax-loader {
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -32px; /* -1 * image width / 2 */
  margin-top: -32px; /* -1 * image height / 2 */
}
</style>
<!--seetha dec17-2015-->
<script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script> 
<script>
function funct_setpremium_cat()
{
	if($('input:radio[name=rating]:checked').length == 0){
		alert("Please enter the overall rating");
		$('#rating').focus();
		return false;
	}
	if($('input:radio[name=quality]:checked').length == 0){
		alert("Please enter the quality");
		$('#quality').focus();
		return false;
	}
	if($('input:radio[name=expectations]:checked').length == 0){
		alert("Please enter the expectations");
		$('#expectations').focus();
		return false;
	}   
	if($("#review_title").val()==''){
		$('#review_title').css('border', '2px solid red');
		$('#review_title').focus();
		return false;
	}
	if($("#pros_summary").val()==''){
		$('#pros_summary').css('border', '2px solid red');
		$('#pros_summary').focus();
		return false;
	}
	if($('input:radio[name=pros_reviews]:checked').length == 0){
		alert("Please choose the pros reviews");
		$('#pros_reviews').focus();
		return false;
	}
	if($("#cons_summary").val()==''){
		$('#cons_summary').css('border', '2px solid red');
		$('#cons_summary').focus();
		return false;
	}  
	if($('input:radio[name=cons_reviews]:checked').length == 0){
		alert("Please choose the cons reviews");
		$('#cons_reviews').focus();
		return false;
	}
	if($('input:radio[name=primary_user]:checked').length == 0){
		alert("Please choose the primary user");
		$('#primary_user').focus();
		return false;
	}	
	if($('input:radio[name=brought_this]:checked').length == 0){
		alert("Please choose the brought this value");
		$('#brought_this').focus();
		return false;
	}	
	
  
	var datas = $('#revform').serialize();
	//alert(datas);
	 jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cashback/submit_product_ratings",
				data: datas,
				cache: false,
				success: function(result)
				{
					if(result==1){
						$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong> Your review has been submitted</strong></div>');
						$('#revform').reset();
						$('#reviewcloseid').trigger('click');						
					}
					else {					
						$('.msg').html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">x</button><strong>Error occurred while submit your review details.</strong></div>');		
					}				
				}
			});
						
	return false;
}

function clears(val)
{
	if(val==1){
		$('#review_title').css('border', '');
		$('#pros_summary').css('border', '');
		$('#cons_summary').css('border', '');
	}
		
	
} 
function funct_questions_cat(){
	
	var question = $("#question").val();
	if($("#question").val()==''){
		$('#question').css('border', '2px solid red');
		$('#question').focus();
		return false;
	}
	var finals = '';
    $('input:checkbox[name="cc[]"]').each(function(){        
        var values =$(this).val();
        finals += values+',';
    });
    //alert(finals);

	 jQuery.ajax({
				url: "<?php echo base_url(); ?>cashback/submit_questions",
				data: "question="+ question + "&category=" + finals,
				type:"POST",
				success: function(result)
				{
					if(result==1){
						$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong> Your Questions has been submitted.</strong></div>');
						$('#modalclosebutton').trigger('click');
											
					}
					else {					
						$('.msg').html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">x</button><strong>Error occurred while submit your question.</strong></div>');		
					}				
				}
	});
	return false;
} 
function clearss(val)
{
	if(val==1){
		$('#question').css('border', '');
	}	
} 

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

$('#revshow').click(function(){
	$('.lirev').show();
	$('#revshow').hide();
});


</script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "d64a0e09-3fb3-4878-997b-55efd197bbab", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<!--seetha dec17-2015-->
</html>