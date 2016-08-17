<div id="mylisted_seems">
<div class="row">
     <?php
     if(count($couponslist)<=0 || $couponslist=='')
     {?>
          <div class="col-md-12">
          <div class="feature-item"><a href="#" data-toggle="modal" data-target="#couponmodal" >
          <div class="col-pad">
             <h4 class="text-center">No Coupons found</h4>
          </div>
          </div><?php 
     }
     else
     {
        foreach($couponslist as $value) {
			
			$store = $this->front_model->get_store_from_coupon($value->offer_name);
			if($store){
			
		?>
		  <div class="col-md-4 col-sm-4">
			  <div class="feature-item">
			  <a href="<?php echo base_url();?>cashback/stores/<?php echo $store->affiliate_url; ?>" >
				  <div class="col-pad" style="min-height: 326px;">
				  <div class="triangle"></div>
				  <div class="bg-wht">
					   <img alt="image" width="70" height="50" src="<?php echo base_url(); ?>/uploads/affiliates/<?php echo $store->affiliate_logo; ?>">
				  </div>
				  <hr>
				  <h4 class="text-center"><?php echo substr($value->title, 0,30); ?></h4>
				  <p> <?php echo substr($value->description, 0,100); ?> </p>
				  </div></a>
			  </div>
		  </div>
	  <?php }	}	}	?>
</div>

</div>