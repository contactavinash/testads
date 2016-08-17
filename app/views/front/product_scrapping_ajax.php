<?php

$coinvalue = round(($product->min_price/COINVALUE));
foreach($comparison_details as $comparison)
{
	$store_img = $comparison->affiliate_logo;
	$affiliate_name = $comparison->affiliate_name;
	$affiliate_id = $comparison->affiliate_id;
	$affiliate_url = $comparison->affiliate_url;
	$product_price = $comparison->product_price;
	$coupon_count = $this->front_model->count_coupons($comparison->affiliate_name)->counting;
	if($sort ==0)
	{
		if($coupon_count<1)
		{
			continue;
		}
	}

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
				<button type="button" class="btn btn-105-30 bor-rad3   btn-yellow">buy at store</button>
			  </li>
			  <li class="dropdown">
				<button class="btn btn-105-30 bor-rad3 dropdown-toggle  btn-price" aria-expanded="false" aria-haspopup="true" role="button" type="button" data-toggle="dropdown">view offer</button>
				<div class="view-off-cont dropdown-menu box-shad4">
				  <div class="head">about offer <span class="close">&times;</span></div>
				  <div class="cont">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque</p>
				  </div>
				</div>
			  </li>
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
?>