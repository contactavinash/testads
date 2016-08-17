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


</style>

</head>
<body>






 

<?php $this->load->view('front/header');?>

 <div class="container">
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
                        
                        <div class="image" style="height:auto;"> 
                        
                        <a href="javascript:void(0);" title="Fashion excepteur occaecat cupidatat ipsum" class="colorbox"> 
                        <?php
                        $img = base_url()."uploads/products/".$gallery[0]->image;
                        
                        ?>
                        <img id="image-main" itemprop="image" src="<?php echo $img;?>" alt="<?php echo $product->product_name;?>" title="<?php echo $product->product_name;?>" data-zoom-image="<?php echo $img;?>" class="product-image-zoom img-responsive"/> 
                        
                        
                        </a>
                         </div> 
                         
                          
                          <div id="image-additional" class="image-additional slide carousel more-views">
                            <div class="carousel-inner" id="image-gallery-zoom"> 
                           
                           <?php
						   $i=0;
							foreach($gallery as $img){
								$img = base_url()."uploads/products/".$img->image;
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
      <div class="col-md-9">
        <h3 class="text-uppercase">  <?php echo $product->product_name;?>  </h3>
        <div class="bor-lft bg-red"></div>
      </div>
      <div class="col-md-3"> 
        <!-- Controls -->
        <div class="controls pull-right hidden-xs"> <a class="left fa fa-angle-left btn btn-default " href="#carousel-example" data-slide="prev"></a> <a class="right  fa fa-angle-right btn btn-default" href="#carousel-example"  data-slide="next"></a> </div>
      </div>
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
      <div class="carousel-inner">
      
    <?php
	if($comparison_details)
	{
		$k = 0;
		foreach($comparison_details as $comparison)
		{
			$store_img = $comparison->affiliate_logo;
			$affiliate_name = $comparison->affiliate_name;
			$affiliate_id = $comparison->affiliate_id;
			$affiliate_url = $comparison->affiliate_url;
			$product_price = $comparison->product_price;
			//$coupon_count = $this->front_model->count_coupons($comparison->affiliate_name)->counting;
			if($k%4==0)
			{	
			?>
         	<div class="item <?php if($k==0){echo "active";}?>">
          	<div class="row">
         	<?php
			}
		  	?>
          	<div class="col-sm-3">
              <div class="col-item">
                <div class="photo"> <img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $store_img;?>" class="img-responsive" alt="<?php echo $affiliate_name;?>" /> </div>
                <div class="info">
                  <div class="">
                    <div class="price col-md-6">
                      <h5 class="price-text-color"> <?php echo DEFAULT_CURRENCY;?><?php echo number_format($comparison->product_price, 2);?></h5>
                    </div>
                  </div>
                  <div class=" clear-left">
                    <p class="text-center"> <a target="_blank" href="<?php echo base_url(); ?>cashback/visit_product/<?php echo $comparison->pp_id;?>/<?php echo $product->product_id;?>" class="btn btn-danger bor-rad-0 mar-top10">Buy Now</a></p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
              </div>
            </div>
          	<?php
			/**/
			$k++;	
			if($k%4!=0 && $k==count($comparison_details))
			{
				?>
                <div class="col-sm-3">
              <div class="col-item">
                <div class="photo">
                  <p style="text-align:center;"><?php echo count($comparison_details);?> Online Stores</p>
                </div>
                <div class="info">
                  <div class="">
                    <div class="price">
                      <h5 class=""> Price to High ?</h5>
                    </div>
                  </div>
                  <div class="clear-left">
                    <p class="text-center"> <a href="javascript:void(0);" class="btn btn-primary bor-rad-0 mar-top10" data-toggle="modal" data-target="#detail-pop">Price Alert</a></p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
              </div>
            </div>
                <?php
			}
			if($k%4==0 || $k==count($comparison_details))
			{
			?>
            </div>
       		</div>
          	<?php
			}
		  	?>
        
		<?php
			
		}
	}
	  ?>
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
  
    </div>
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
       
      
      <button type="button" class="btn btn-danger bor-rad-no mar-top10" data-toggle="modal" data-target="#modal_compare"> <i class="fa fa-info-circle pad-rht"></i> Compare</button>
    <!--  <h5 class="pull-right mar-top10"><b>Categoris:</b> Electronics, Mobiles</h5>-->
    </div>
  </div>
</div>
</div>
<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="all clearfix mar-bot20">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#User_Profile" aria-controls="User_Profile" role="tab" data-toggle="tab">Prices</a></li>
            <li role="presentation"><a href="#Edit_Profile" aria-controls="Edit_Profile" role="tab" data-toggle="tab">Specfications</a></li>
            <li role="presentation"><a href="#Settings" aria-controls="Settings" role="tab" data-toggle="tab">Related Products</a></li>
            <li role="presentation"><a href="#Payment_settings" aria-controls="Payment_settings" role="tab" data-toggle="tab">Reviews</a></li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content panel-border">
            <div role="tabpanel" class="tab-pane active" id="User_Profile">
              <div class="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                <div class="panel-heading">
                  <h4 class="mar-no text-center">Price Online</h4>
                  <div class="bor bg-red"></div>
                </div>
                <div class="acc-table-style clearfix mar-top10">
                  <div class="">
                    <div class="panel-body">
                      <div class="table-responsive">
                      <?php

                      ?>
                        <table class="table nomargin table-hover-color">
                          <thead>
                            <tr class="bg-ylw clr-wht">
                              <th class=""></th>
                              <th class="">Store Rating </th>
                              <th class="">Product colour / variants</th>
                              <th class="">Price</th>
                              <th class=""></th>
                            </tr>
                          </thead>
                          <tbody class="">
                          <?php
				  	if($comparison_details)
				  	{
					  	foreach($comparison_details as $comparison)
					  	{
							$store_img = $comparison->affiliate_logo;
							$affiliate_name = $comparison->affiliate_name;
							$affiliate_id = $comparison->affiliate_id;
							$affiliate_url = $comparison->affiliate_url;
							$product_price = $comparison->product_price;
							$coupon_count = $this->front_model->count_coupons($comparison->affiliate_name)->counting;
							?>
                           <tr>
                              <td><img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $store_img;?>" class="" alt="<?php echo $affiliate_name;?>"/></td>
                              <td class="yellow-colr">
                              <?php

								$store_rating =$this->front_model->get_storerating($affiliate_id);
								if($store_rating)
								{
									 for($i=1;$i<=$store_rating->rate;$i++)
									 {
										echo '<i class="fa fa-star"></i>';
									 }
								}
								?>
                             </td>
                                <td><?php if($product->codAvailable=='true')echo "Cash on Delivery<br>";?>
                             	 <?php if($product->emiAvailable!='')echo "EMI Available<br>";?>
                                <?php if($product->color!='')echo "Color : ".$product->color."<br>";?>
                                  <?php if($coupon_count!=0) echo $coupon_count." coupons Available<br>";?>
                                
                                
                                </td>
                              <td>
                              
                              <?php $cmpproduct_price= number_format(($comparison->product_price),2);?>
                              
                              <?php echo DEFAULT_CURRENCY;?><?php echo $cmpproduct_price;?></td>
                              <td><a target="_blank" href="<?php echo base_url(); ?>cashback/visit_product/<?php echo $comparison->pp_id;?>/<?php echo $product->product_id;?>" class="btn btn-danger bor-rad-no"> Buy Now</a></td>
                            </tr>
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
            </div>
            <div role="tabpane1" class="tab-pane" id="Edit_Profile">
              <div class="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                <div class="panel-heading">
                  <h4 class="mar-no text-center">Specfications</h4>
                  <div class="bor bg-red"></div>
                </div>
                <div class="panel-body">
					      	
                            
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
							$similar_products =$this->front_model->similar_products($product->parent_id,4);
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
                                  
                                  
           						 <div class="col-sm-3">
                                  <div class="col-item">
                                    <div class="photo"> <a href="<?php echo base_url().'cashback/product_details/'.$product_url_sim;?>"><img src="<?php echo $fea_product_img;?>" class="img-responsive" style="width:auto; height:200px;" alt="<?php echo $simproduct->product_name;?>" /></a> </div>
                                    <div class="info">
                                      <div class="">
                                      <div class="text-center">
                                          <h4 class=""> <?php echo $simproduct->product_name;?></h4>
                                        </div>
                                      </div>
                                      <div class=" clear-left">
                                        <p class="text-center"> <a href="<?php echo base_url().'cashback/product_details/'.$product_url_sim;?>" class="btn btn-danger bor-rad-0 mar-top10">View Detail</a></p>
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
                        <div class="panel-body">
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

<h3 class="text-center text-uppercase mar-top40"> BEST PRODUCTS </h3>
<div class="bor bg-red"></div>

	<div class="row">
		                                <div class="col-md-12 col-sm-12">
                                    <!-- Nav tabs --><div id="pro-tab" class="card">
                                    <div class="col-md-7 col-md-offset-3">
                                    <ul role="tablist" class="nav nav-tabs">
                                       <!-- <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#Products">Products</a></li>
                                        <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#Latest-Products">Latest Products</a></li>
                                        <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="messages" href="#Most-Viewed-Products">Most Viewed Products</a></li>-->
                                    </ul>
                                    </div>
                                    
                                    <div class="clearfix"></div>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="Products" class="tab-pane active" role="tabpanel">
                                        
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
                                               
                                                <a title="<?php echo substr($lasproduct->product_name,0,20);?>" href="<?php echo base_url().'cashback/product_details/'.$lasproduct->product_url;?>" class="bigpic_21_tabcategory product_image">
                                                <img alt="<?php echo substr($lasproduct->product_name,0,20);?>" src="<?php echo $fea_product_img;?>" style="width:auto; height:200px;" class="img-responsive center-block"> <span class="new">New</span> </a>
                                                
                                                <div class="grey-bg clearfix">
                                                <div class="col-md-6 col-sm-6">
                                                <a href="<?php echo base_url().'cashback/visit_product/'.$getminpricesim_row->pp_id.'/'.$getminpricesim_row->product_id;?>" target="_blank">                                               
                                                <img class="img-responsive pull-left" src="<?php echo $store_img;?>"></a></div>
                                                <div class="col-md-6 col-sm-6">
                                                  <h4 class="pull-right text-uppercase fnt-18"> <?php echo $offpercent;?>% Off</h4></div>
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
                                                  <div class="price-box text-center"> <span class="price product-price">  <?php  echo DEFAULT_CURRENCY." ".$lasproduct->product_price;?> </span> <span class="price product-price clr-grey">
                                                    <amall> <?php  echo DEFAULT_CURRENCY." ".$lasproduct->mrp;?>  </amall>
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

<div class="modal fade" id="detail-pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
      <div class="modal-header">
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
      <button class="btn btn-danger bor-rad-0" id="product_review" type="button" value="submit"><span class="submit-price-icon"></span>Confirm</button>
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
if(!validateEmail(priceemail))
{
	$('#priceemail').css('border','2px solid red');
	return false;
}
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
				}
				else
				{
					$(".unique_name_error").css('color','#ff0000');					
					$(".unique_name_error").html('Price drop alert already set');
					$("#priceemail").val('');
					$('#priceemobile').val('');
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
	$('#rating').focus();
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
						 setTimeout(function() {
							$('#reviewcloseid').trigger('click');		
						}, 1000);				
					}
					else {					
						$('.msg').html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">x</button><strong>Error occurred while submit your review details.</strong></div>');
								
					}				
				}
			});
						
	return false;
});



</script>






</body>
</html>
