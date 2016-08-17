<?php
	if(!$products){
		echo '<div class="service-content"><div class=""><div class="alert alert-info text-center">No Products Available.</div></div></div>';
	}else{
		if(isset($specis))
							{
		foreach($products as $prod){
			$spec_option = '';
                            $specify = unserialize($prod->specification);
                            $specify_option = unserialize($prod->specification_option);
                            $specify_extra = unserialize($prod->specification_extra);
						//	print_r($specis[1]);
							
							//print_r($specify_extra);
							$aa=explode(',',$specis[1]);
						//	print_r($aa);//exit;
						
					
							
								
									$i=0;
									foreach($aa as $eee)
									{
								foreach($specify_extra as $kk=>$value)
								{
									
											if($kk==$eee)
											{
											//echo $value;
												if((strpos($value,'No')) === false)
												{
												//	echo 'sdsdds';
													$i++;
												}
											}
									}
								}
							
								//echo $i;
								
								if($i==count($aa))
											{
												$prosst[]=$prod->product_id;
											}
											}
									//	exit;	
											
							//exit;
											
				$prosss=array_unique($prosst);					
	if($prosss)
	{
		foreach($products as $prod){
			foreach($prosss as $prossf)
			{
			if($prossf==$prod->product_id)
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
			$store_avail=$prod->price_compare;
			$commision_details=$this->front_model->get_retailer_commision($prod->default_store);
			$c_get=unserialize($commision_details->what_get);
			$c_give=unserialize($commision_details->what_give);
			$c_catid=unserialize($commision_details->category_id);
			$cash_price=0;
			
			if(in_array($prod->parent_child_id,$c_catid))
							{
								$prod->parent_child_id;
							 $key = array_search($prod->parent_child_id,$c_catid );
							  $cash_price1=$min_price*($c_get[$key]/100);
							  
							 $cash_price=$cash_price1*(50/100);
							}
			// echo $pos = strpos($pro_title, ' ', 15);
			// exit;
			$title = substr($pro_title, 0 ,20);
			
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
  
  <li class="col-xs-12 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line">
    <div class="product-container">
      <div class="left-block">
	  <?php if($store_avail==0){ ?>
	  <div class="blu-box"><a href="<?php echo base_url(); ?>product/<?php echo $prod_url; ?>"/> Available From <?php echo $store['count']; ?> Stores</a></div><?php } ?>
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
			<a title="Add to Favorite" class="fav_<?php echo $prod_id; ?>" href="javascript:void(0);" onClick="return addfav('<?php echo $prod_id; ?>');"><span style="float: right; padding: 12px; position:absolute;"><i class="fa fa-heart"></i></span></a>
		<?php } else {  ?>
			<span style="float: right; padding: 12px;" title="Added to Favorites"><i style="color:#FF0000;" class="fa fa-heart"></i></span>	
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
          <h5 class="product-name text-uppercase text-center"><a href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" ><?php echo $title; ?></a></h5>
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
			  
		  
              </div>
              
            </div>
          </div>
          <div  class="price-box bor-ylw pad-bot5" > <span class="price product-price" style="font-size:17px;"> 
		  
		  <?php //echo DEFAULT_CURRENCY.' '.floor($min_price); ?>
		<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>
		  </span> <span class="price product-price clr-grey" style="font-size:17px;"><small> 
		  
		  <?php echo DEFAULT_CURRENCY.' '.number_format($prod->mrp,2);?>
		  
		  </small> </span> 
		  
		  
		   </div>
          <ul class="item-info-list" style="height:72px;">
          <?php
			$key_featurearray =  explode(",",$prod->key_feature);
			if($key_featurearray){
			$key_featurearray = array_slice($key_featurearray, 0, 4);
				$i=0;
			foreach($key_featurearray as $features)
			{$i++;
				if(!$features){continue;}if($i<5){?>
				 <li style="font-size: 12px;"><i class="fa fa-chevron-right" ></i> <?php echo $features;?></li>
			<?php }}}
		  ?>
           
          </ul>
        </div>
      </div>
      <div class="list-det clearfix mar-top mar-bot-no" >
         <h4 class="text-primary pull-left" style="font-size: 12px;"><strong><?php if($cash_price!="")
							  { echo DEFAULT_CURRENCY;?> <?php echo number_format($cash_price,2);?> cash back<?php }?></strong></h4>
        <?php
		
		$coinvalue = round(($min_price/COINVALUE));
		?>
<h5 class="pull-right" style="font-size: 13px;"><strong><?php if($point_limit->max_points>=$coinvalue){echo $coinvalue;}else{echo  $point_limit->max_points;} ?>points</strong></h5>
      </div>
      
	  <?php
	  if(!$brand_url && !$keyword)
	  {
	  ?> 
	<div class="checkbox check-bg text-center" id="">	  
	  <div class="compareicon compare_list" style="cursor:pointer;" id="compareproducttd_<?php echo $prod_id;?>" title="Add to compare" data-img_url="<?php echo $image; ?>" data-link_url="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" data-link_set_url="<?php echo $prod_url; ?>"data-title="<?php echo substr($title, 0 ,10);?>" data-id_product="<?php echo $prod_id;?>" data-id_category="1" data-price="<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>" >
      Add to compare
	  </div>
	   <div class="compare_list compare_remove" onClick="return closedivsingle(<?php echo $prod_id;?>);" style="cursor:pointer; display:none;" id="removecompare_<?php echo $prod_id;?>">
	  Remove from compare
    </div>
	</div>
	<?php
	  }
	  else
	  {
		  ?>
          <div class="checkbox check-bg text-center" id="">	  
	  <div class="compareicon compare_list" style="cursor:pointer;" id="compareproducttd_<?php echo $prod_id;?>" title="Add to compare" data-img_url="<?php echo $image; ?>" data-link_url="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" data-link_set_url="<?php echo $prod_url; ?>"data-title="<?php echo substr($title, 0 ,10);?>" data-id_product="<?php echo $prod_id;?>" data-id_category="1" data-price="<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>" >
      Add to compare
	  </div>
	   <div class="compare_list compare_remove" onClick="return closedivsingle(<?php echo $prod_id;?>);" style="cursor:pointer; display:none;" id="removecompare_<?php echo $prod_id;?>">
	  Remove from compare
    </div>
	</div>
		  <div class="text-center"><a class="sampel" href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>">View Details</a></div>
		  <?php
		 
	  }
	?>
  </li>
<?php
}
}
}
}
}	
	else {
		foreach($products as $prod){
			
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
			$store_avail=$prod->price_compare;
			$commision_details=$this->front_model->get_retailer_commision($prod->default_store);
			$c_get=unserialize($commision_details->what_get);
			$c_give=unserialize($commision_details->what_give);
			$c_catid=unserialize($commision_details->category_id);
			$cash_price=0;
			
			if(in_array($prod->parent_child_id,$c_catid))
							{
								$prod->parent_child_id;
							 $key = array_search($prod->parent_child_id,$c_catid );
							  $cash_price1=$min_price*($c_get[$key]/100);
							  
							 $cash_price=$cash_price1*(50/100);
							}
			// echo $pos = strpos($pro_title, ' ', 15);
			// exit;
			$title = substr($pro_title, 0 ,20);
			
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
  
  <li class="col-xs-12 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line">
    <div class="product-container">
      <div class="left-block">
	  <?php if($store_avail==0){ ?>
	  <div class="blu-box"><a href="<?php echo base_url(); ?>product/<?php echo $prod_url; ?>"/> Available From <?php echo $store['count']; ?> Stores</a></div><?php } ?>
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
			<a title="Add to Favorite" class="fav_<?php echo $prod_id; ?>" href="javascript:void(0);" onClick="return addfav('<?php echo $prod_id; ?>');"><span style="float: right; padding: 12px; position:absolute;"><i class="fa fa-heart"></i></span></a>
		<?php } else {  ?>
			<span style="float: right; padding: 12px;" title="Added to Favorites"><i style="color:#FF0000;" class="fa fa-heart"></i></span>	
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
          <h5 class="product-name text-uppercase text-center"><a href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" ><?php echo $title; ?></a></h5>
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
			  
		  
              </div>
              
            </div>
          </div>
          <div  class="price-box bor-ylw pad-bot5" > <span class="price product-price" style="font-size:17px;"> 
		  
		  <?php //echo DEFAULT_CURRENCY.' '.floor($min_price); ?>
		<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>
		  </span> <span class="price product-price clr-grey" style="font-size:17px;"><small> 
		  
		  <?php echo DEFAULT_CURRENCY.' '.number_format($prod->mrp,2);?>
		  
		  </small> </span> 
		  
		  
		   </div>
          <ul class="item-info-list" style="height:72px;">
          <?php
			$key_featurearray =  explode(",",$prod->key_feature);
			if($key_featurearray){
			$key_featurearray = array_slice($key_featurearray, 0, 4);
				$i=0;
			foreach($key_featurearray as $features)
			{$i++;
				if(!$features){continue;}if($i<3){?>
				 <li style="font-size: 12px;"><i class="fa fa-chevron-right" ></i> <?php echo $features;?></li>
			<?php }}}
		  ?>
           
          </ul>
        </div>
      </div>
      <div class="list-det clearfix mar-top mar-bot-no" >
        <h4 class="text-primary pull-left" style="font-size: 12px;"><strong><?php if($cash_price!="")
							  { echo DEFAULT_CURRENCY;?> <?php echo number_format($cash_price,2);?> cash back<?php }?></strong></h4>
        <?php
		$coinvalue = round(($min_price/COINVALUE));
		?>
<h5 class="pull-right" style="font-size: 13px;"><strong><?php if($point_limit->max_points>=$coinvalue){echo $coinvalue;}else{echo  $point_limit->max_points;} ?>points</strong></h5>
      </div>
      
	  <?php
	  if(!$brand_url && !$keyword)
	  {
	  ?> 
	<div class="checkbox check-bg text-center" id="">	  
	  <div class="compareicon compare_list" style="cursor:pointer;" id="compareproducttd_<?php echo $prod_id;?>" title="Add to compare" data-img_url="<?php echo $image; ?>" data-link_url="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" data-link_set_url="<?php echo $prod_url; ?>"data-title="<?php echo substr($title, 0 ,10);?>" data-id_product="<?php echo $prod_id;?>" data-id_category="1" data-price="<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>" >
      Add to compare
	  </div>
	   <div class="compare_list compare_remove" onClick="return closedivsingle(<?php echo $prod_id;?>);" style="cursor:pointer; display:none;" id="removecompare_<?php echo $prod_id;?>">
	  Remove from compare
    </div>
	</div>
	<?php
	  }
	  else
	  {
		  ?>
          <div class="checkbox check-bg text-center" id="">	  
	  <div class="compareicon compare_list" style="cursor:pointer;" id="compareproducttd_<?php echo $prod_id;?>" title="Add to compare" data-img_url="<?php echo $image; ?>" data-link_url="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>" data-link_set_url="<?php echo $prod_url; ?>"data-title="<?php echo substr($title, 0 ,10);?>" data-id_product="<?php echo $prod_id;?>" data-id_category="1" data-price="<?php echo DEFAULT_CURRENCY.' '.number_format($min_price,2);?>" >
      Add to compare
	  </div>
	   <div class="compare_list compare_remove" onClick="return closedivsingle(<?php echo $prod_id;?>);" style="cursor:pointer; display:none;" id="removecompare_<?php echo $prod_id;?>">
	  Remove from compare
    </div>
	</div>
		  <div class="text-center"><a class="sampel" href="<?php echo base_url(); ?>product_details/<?php echo $prod_url; ?>">View Details</a></div>
		  <?php
		 
	  }
	?>
  </li>
<?php } }
}?>

