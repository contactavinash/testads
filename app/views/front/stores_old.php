<?php
/*$str = '12/24/2013';
$date = DateTime::createFromFormat('m/d/Y', $str);
echo $date->format('Y-m-d'); // => 2013-12-24*/
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

 	<title><?php echo $store_details->meta_keyword;?></title>
	<meta name="Description" content="<?php echo $store_details->meta_description;?>"/>    
    <meta name="keywords" content="<?php echo $store_details->meta_keyword;?> " /> 
	
    <meta name="robots" CONTENT="INDEX, FOLLOW" />
    
<!-- Bootstrap -->

<?php $this->load->view('front/css_script'); 
$admindetailss = $this->front_model->getadmindetails();
?>	
<link href="<?php echo base_url();?>front/css/hover.css" rel="stylesheet" type="text/css">
<style>
.rating {
    float:left;
    border:none;
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
    font-size:200%;
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
.loadedcontent {min-height: 1200px; }
.cus_modal .modal-header-default > .lead3 p {
    background-color: #eef6fc;
    border-radius: 4px;
    line-height: 18px;
    padding: 10px 10px 10px 35px;
}

.cus_modal .modal-header-default > .lead3 {
    margin-top: 15px;
}
.cus_modal .modal-header-default > div:first-child h3 {
    color: #1d7bce;
    font-size: 25px;
    line-height: 25px;
	font-weight:bold;
}
.cus_modal .voucher-code p {
    color: #004a86;
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    padding-bottom: 10px;
}
.cus_modal .voucher-code {
    text-align: center;
}
.cus_modal .voucher-code, .cus_modal .follow-retailer, .cus_modal .refer {
    border-radius: 4px;
    margin: 0 0 25px;
    padding: 10px;
}
.cus_modal .voucher-code span {
    background: url("//static.quidco.com/v3/assets/img/common/modal/voucher-icon.png") no-repeat scroll 6px 2px transparent;
    border: 1px dashed #f00;
    display: block;
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    padding: 4px 0;
}
.copy-medium, .copy-medium p, ul.copy-medium li, ol.copy-medium li {
    font-size: 14px;
    line-height: 22px;
}

.copy-medium .modal-body p {
    font-size: 16px;
    font-weight: 300;
    line-height: 24px;
}
.copy-medium .alert-info {
    background-color: #f4f8fd;
    border-color: #1d7bce;
    color: #444;
	
}

</style>

</head>



<body>

<?php	$this->load->view('front/header'); ?>

<!-- Header ends here -->
<div class="page">

  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a href="<?php echo base_url();?>">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li> 
			<li class=""> <a href="<?php echo base_url();?>cashback/stores_list">Stores</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
            <li class="category34"> <strong><a href="<?php echo base_url();?>cashback/stores/<?php echo $store_details->affiliate_url;?>"><?php echo $store_details->affiliate_name;?></a></strong> </li>
			
          </ul>
        </div>
        <!--col-xs-12--> 
      </div>
      <!--row--> 
    </div>
    <!--container--> 
  </div>
<!-- Home Slider Block -->
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-sm-12 col-md-9">
			<?php
				$headerimg = $this->front_model->getads('Header');
            ?>
			<a href="<?php echo $headerimg->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg->ads_image?>" class="img-responsive mar-bot" alt=""></a>
			
          <ol id="products-list" class="products-list">
            <li class="item odd">
				<?php
				if($store_details->cashback_percentage!=""){
				$store_categorysss = $store_details->store_categorys;
				$str_id = $store_details->affiliate_id;
				$newres = $this->db->query("SELECT * FROM `category_cashback` where store_id=$str_id and cashback!=0 and status='Active'");
				$cppercentage='0%';
				// if($newres->num_rows == 0)
				// {			
					if($store_details->affiliate_cashback_type=="Percentage")
					{
						$cppercentage = $store_details->cashback_percentage."%";
					}
					else
					{
						$cppercentage = DEFAULT_CURRENCY." ".$store_details->cashback_percentage;
					}
				// }
				?>
				<div class="label-pro-new-blnk"> <span style=" font-size: 13px;left: 6px;text-align: center;top: 8px;" class="fnt-15"><?php echo $cppercentage; ?> <br><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name;?> </span></div>
				<?php } ?>
              <div class="row">
                <div class="product-images col-sm-4 col-md-3">
                  <div class="box-images"> 
				    <?php
					 if($user_id=="")
					 {
						$ss_button_1 = '<a href="#myModalz" data-toggle="modal" class="product-image"> <img width="180" height="35" src="'.base_url().'uploads/affiliates/'.$store_details->affiliate_logo.'" class="img-responsive center-block"></a>';
						// $anew = '<a href="#myModal" data-toggle="modal" class="">';
						
					 }
					 else
					 {
						 $ss_button_1 = '<a href="'.base_url().'cashback/visit_shop/'.$store_details->affiliate_id.'" target="_blank" class="product-image"><img width="180" height="35" src="'.base_url().'uploads/affiliates/'.$store_details->affiliate_logo.'" class="img-responsive center-block"> </a>';
						 // $anew = '<a href="'.$store_details->logo_url.'" target="_blank" class="">';
					 }
					 echo $ss_button_1;
					 ?>
				  
				  </div>
				  <?php
					$store_name = $store_details->affiliate_name;
					$store_coupons1 = $this->front_model->get_coupons_from_store($store_name,null);
				  ?>
                  <p class="text-center text-info"> <?php if($store_coupons1!=""){ echo '<a href="javascript:;" onclick="scrolling();">'.count($store_coupons1); } else { echo 0; } ?> Coupons <i class="fa fa-tags pad"></i><?php if($store_coupons1!=""){ echo '</a>'; } ?></p>
                </div>
                <div class="product-shop col-sm-8 col-md-9 ">
					<?php  if($user_id=="")
					 { ?>
                  <h2 class="product-name"><a title="<?php echo $store_details->affiliate_name;?>" href="#myModalz" data-toggle="modal"><?php echo $store_details->affiliate_name;?></a></h2>
				  <?php } else {  ?>
				  <h2 class="product-name"><a title="<?php echo $store_details->affiliate_name;?>" href="<?php echo base_url().'cashback/visit_shop/'.$store_details->affiliate_id; ?>"><?php echo $store_details->affiliate_name;?></a></h2>
				  <?php } ?>
                  <div class="ratings clearfix">
					<?php	$reviews = $this->front_model->all_store_reviews($store_details->affiliate_id);
							if($reviews){
								$width=0; $initial_star_count=0;
								$total_count_rev = count($reviews);
								if($reviews){
									foreach($reviews as $total_rev_single){
										$initial_star_count = $initial_star_count + $total_rev_single->rating;
									}
									$width = floor($initial_star_count/$total_count_rev);
								}
							} else {
								$width=0;
							}  ?>
                    <!--<div class="rating-box">
                      <div style="width:<?php echo $width; ?>%" class="rating"></div>
                    </div>-->
					<div><?php	for($five_rating=1;$five_rating<=5;$five_rating++){
								if($five_rating>$width)
									$attach = '-o';
								else
									$attach = '';
								echo '<i class="fa fa-star'.$attach.'"></i> ';
							} ?></div>
                   <!-- <p class="rating-links"> <a href="#">(1 Reviews)</a> <span class="separator">|</span> <a href="#" class="add-review">Add Your Review</a> </p>-->
                  </div>
                  <!--<div class="price-box">
                    <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $122.00 </span> </p>
                    <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $90.00 </span> </p>
                  </div>-->
                  <div class="desc std"> 
				  <span class="" id="longdisp" style="display:none;"><?php echo $store_details->affiliate_desc;?> </span>
					<span class="" id="aaa"><p id="shortdispdel"><?php echo substr($store_details->affiliate_desc,0,130)." <a onClick='showhidediv();' style='color:blue; cursor: pointer;' >More</a>";?> </p></span>
					<?php
					if($user_id=="")
					{ ?>
					<div class="last add-to-Compare mar-top addfav"><a class="link-compare" href="#myModal" data-toggle="modal"><i class="fa fa-heart-o text-info"></i> <strong>Add to Favorites</strong></a></div>
					<?php } else {
					$chk_fav = $this->front_model->check_favorite($store_details->affiliate_id);
					if(!$chk_fav){
				  ?>
					<div class="last add-to-Compare mar-top addfav"><a class="link-compare" href="javascript:;" onClick="return addfav('<?php echo $store_details->affiliate_id; ?>');"><i class="fa fa-heart-o text-info"></i> <strong>Add to Favorites</strong></a></div>
                   
                  <?php } else { ?>
					<div class="last add-to-Compare mar-top"><a class="link-compare"><i class="fa fa-heart text-info"></i> Added to Favorites</a></div>
				  <?php } } ?>
                  </div>
                  <ul class="add-to-links mar-no">
                    <li>
					<?php if($user_id==""){ ?>
                      <a class="md-btn md-btn-danger" href="#myModalz" data-toggle="modal"> Go to Store and Get Rupiya Back</a>
					  <?php } else { ?>
					   <a target="_blank" href="<?php echo base_url().'cashback/visit_shop/'.$store_details->affiliate_id; ?>" class="md-btn md-btn-danger" > Go to Store and Get Rupiya Back</a>
					  <?php } ?>
                    </li>
                   <!-- <li class="last add-to-Compare"><a class="link-compare" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Add to Favorites" rel="tooltip"><i class="fa fa-heart text-info"></i></a></li>
                     <li class="add-to-wishlist"><a class="link-wishlist" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Coupon Option" rel="tooltip"><i class="fa fa-tag text-danger"></i></a></li>
                    <li class="add-to-wishlist"><a class="link-wishlist" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Submit Coupon" rel="tooltip"><i class="fa fa-tags text-warning"></i></a></li>-->
                  </ul>
                </div>
              </div>
            </li>
          </ol>
		   
          <div class="row">
            <div class="col-md-12">
              <h4 class=""> <?php echo $store_details->affiliate_name; ?> Reviews
			  <span class="pull-right">
			   <?php  if($this->session->userdata('user_id')!=''){ ?>
                  <a data-toggle="modal" href="#myModal-review" class="md-btn md-btn-danger mar-bot20"><i class="fa fa-pencil"></i> Add a review</a>
                  <?php } else { ?>
                  <a class="md-btn md-btn-danger mar-bot20" href="#myModal" data-toggle="modal"><i class="fa fa-sign-in pad-rht"></i> Sign in to add review</a>
                  <?php } ?>
			  </span> </h4>
            </div>
			<div class="col-md-12 mar-top">
			<?php 
			if($reviews) { ?> <a id="revshow" href="javascript:;" class="md-btn md-btn-danger mar-bot20">View all reviews</a><?php } ?>
			 <ul class="comments-list mar-top">
				<?php 
				if($reviews) {  $rr=0; foreach($reviews  as $review) { $rr++; ?>
				<li class="lirev" style="background:#f1f1f1; border:1px solid #ccc; <?php if($rr>1){ echo 'display:none;';} ?>">
				  <article class="comment">
					<div class="comment-author">  </div>
					<div class="comment-inner"style="padding-left:18px;">
					  <ul class="icon-group icon-list-rating comment-review-rate" style="float:right;padding-right:10px;">
						<li><?php
						//echo $review->ratings;
						for($i=0;$i<$review->rating;$i++) { ?>
						<i class="fa fa-star"></i> 
						<?php } ?></li>
					  </ul>
					  <h4 class="thumb-list-item-title"><a href="javascript:;"><?php
						$user = $this->front_model->edit_account($review->user_id);
					  if($user->first_name){ echo $user->first_name; } else { echo 'User'; } ?></a></h4>
					  <p class="thumb-list-item-author"><?php echo $review->comments; ?></p>
					</div>
				  </article>
				</li><span class="lirev" <?php if($rr>1){ echo 'style="display:none;"';} ?>><hr></span>
				<?php } } else { ?>
					<li class="mar-top">No reviews found.</li><hr>
				<?php } ?>
			  </ul>
			</div>
          </div><span id="scrollingelm">&nbsp;</span>	  
		
		
		<div class="row">
		<div class="col-md-12">
		<h3 class="cls_blue_bg"><?php echo $store_details->affiliate_name;?> Coupons</h3>
		</div>
		</div>
          <div class="row"  >
            <div class="col-md-12">
			<?php
			$affid =  $store_details->affiliate_id;
			
			if($store_coupons!="")
			{
				echo "<div id='sampleajax'>";
				$kt=1;
				foreach($store_coupons as $coupons)
				{
					$coupon_id = $coupons->coupon_id;
					$expiry_date = $coupons->expiry_date;

					$exp = date('m/d/Y',strtotime($expiry_date));
					
					$date = DateTime::createFromFormat('m/d/Y', date('m/d/Y'));
					$date1 = date_create($date->format('Y-m-d'));
					
					$date = DateTime::createFromFormat('m/d/Y', $exp);
					$date2 = date_create($date->format('Y-m-d'));
					
					$diff=date_diff($date1,$date2);
					$coupondate =  $diff->format("%a days");
			?>
              <div class="featured-item-container">
                <div class="featured-item">
				 <?php
				 if($coupons->coupon_options==1)
				 {
				 ?>
				  <div class="label-pro-new-blnk" style="right:15px;"> <span style=" left: 2px;text-align: center; top: 16px;" class="fnt-15">Featured</span></div>
				  <?php
				 }
				 if($coupons->coupon_options==2)
				 {
				 ?>
				   <!--<div class="label-pro-new-blnk" style="right:15px;"> <span style="text-align: center; top: 4px; left: 11px;" class="fnt-15">Exclusive</span></div>-->
				 <?php } ?>
				  <?php
					  if($user_id=="")
					 {
						$hres =  '<a class="popup-text" href="#myModaly'.$kt.'" data-toggle="modal">';
						$ss_button = '<a href="#myModaly'.$kt.'" data-toggle="modal" class="btn btn-blue"> Join or Sign-in to get Offer </a>';
					 }
					 else
					 {
						 $hres =  '<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_visit_store'.$kt.'" target="_blank">';
						 $ss_button = '<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_visit_store'.$kt.'" class="btn btn-blue"> Click to activate Offer & visit site </a>';		 }
					 ?>
                  <!--<div class="logotype">
                    <div class="logotype-image">
					<img width="93" height="72" alt="logotype-3" class="attachment-shop_logo wp-post-image" src="img/store-1-sm.png">
					</div>
                  </div>-->
				   <?php
					  if($user_id=="")
					 { ?>
					 
                  <a data-codeid="99" class="md-btn md-btn-success md-btn-block" target="_blank" href="#myModaly<?php echo $kt;?>" data-toggle="modal" > Get Coupon </a>
				  <?php } else { ?>
				   <a data-codeid="99" class="md-btn md-btn-success md-btn-block" target="_blank" href="#myModal_visit_store<?php echo $kt;?>" data-toggle="modal" > Get Coupon </a>
				  <?php } ?>
                  <div class="featured-item-content"> <?php echo $hres;?><?php echo $coupons->title?> 
			<?php if($store_details->cashback_percentage!="")
			{
				if($store_details->affiliate_cashback_type=="Percentage")
				{
					$cppercentage = $store_details->cashback_percentage."%";
				}
				else
				{
					$cppercentage = DEFAULT_CURRENCY." ".$store_details->cashback_percentage;
				} 
				
				if($coupons->cashback_description=='')
				{
					$admindetails = $this->front_model->getadmindetails_main();
					echo " + Get additional upto ".$cppercentage." Cashback from ".$admindetails->site_name;
				}
				else
				{
					
					echo " + ".$coupons->cashback_description;
				}
			}
			else
			{			
				if($coupons->cashback_description!='')
				{
					echo " + ".$coupons->cashback_description;
				}
			}
				//minimum_cashback
				
			?></a>
                    <p><?php echo $coupons->cashback_description; ?></p>
                   <p class="text-center mar40"> <?php echo $ss_button;?>
		
		
		 <?php 
		 if($user_id!="")
		 {
			 if($coupons->type=='Promotion')
			 {
				?>
				 <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_visit_store<?php echo $kt;?>" target="_blank"><button class="btn btn-orange"> Discount Added Automatically </button></a>
			 <?php
			 }
			 else
			 {
				 ?>
                 
                 
                  <a href="" onClick="open_in_new_tab('<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>');" data-toggle="modal" data-target="#myModal_redam<?php echo $kt;?>"> <button class="btn btn-orange" id="hideline<?php echo $kt;?>" onClick="showhidecode('<?php echo $kt;?>');"> Reveal Code & get cashback</button></a>
                  
                  
                  
				 <a href="<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>" target="_blank"><button class="btn btn-orange" id="showcode<?php echo $kt;?>"  style="min-width: 35%; display:none"> <?php echo $coupons->code;?></button></a>
                 
				<?php
			 }
		 }
		 else
		 {
			 ?>
			 <?php //echo $hres;?>
			  <a href="" onClick="open_in_new_tab('<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>');" data-toggle="modal" data-target="#myModal_redam<?php echo $kt;?>"> <button class="btn btn-orange" id="hideline<?php echo $kt;?>" onClick="showhidecode('<?php echo $kt;?>');"> Discount Added Automatically </button></a>
			  
			  	 <a href="<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>" target="_blank"><button class="btn btn-orange" id="showcode<?php echo $kt;?>"  style="min-width: 35%; display:none"> <?php echo $coupons->code;?></button></a>
			 <?php
				}
			 ?>
		 </p>
		 <div class="modal fade cls_store_head cus_modal" id="myModal_redam<?php echo $kt;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    
                    <!--Old popup-->
                    <div class="modal-content" id="newcontent<?php echo $kt;?>" style=""><!---->
                      <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <div class="modal-header-default">
                        <div style="background: url('<?php echo base_url()."uploads/adminpro/".$admindetailss[0]->site_logo;?>') no-repeat scroll 0px 0px transparent; height: 69px; padding: 0px 0px 0px 271px;">
                            <p class="lead3 m-warning display-none" style="display: block;color:#fff;">You're about to visit</p>
                            <h3><?php echo $store_details->affiliate_name;?></h3>
                        </div>
                            
                        </div>
                            </div>
                      
                      <div class="modal-body-default">
                      
                      <span class="alert alert-block" style="display: block; font-size: 16px;line-height: 25px;">
                      	<span>
                      		<center>Your visit has been recorded. The cashback from any purchase(s) will soon show in your account.</center>
                            
                            </span></span>
                            <?php
							if($coupons->type!='Promotion')
							{
							?>
                                <div style="display: block;" class="voucher-code display-none">
                                <p>Copy this voucher code &amp; paste at the checkout</p>
                                <span> <?php echo $coupons->code;?></span>
                               </div>
                           <?php
							}
						   ?>
                        
                        

                      </div>
                        <div class="modal-footer" style="display: block;">
							<div class="continue-hide m-non-warning display-none" style="display: block;margin-right: 29px;">
								<p class="copy-medium">
								  <?php
								if($coupons->type!='Promotion')
								{
								?>
									<a class="btn btn-primary" href="<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>"> Visit <?php echo $store_details->affiliate_name;?> and redeem code</a>
								 <?php
								}
								else
								{
									?>
									<a class="btn btn-primary" href="<?php echo base_url();?>"> Continue shopping at <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> for more great offers </a>
								 <?php
								}
								 ?>
								<br>
								</p>
							</div>
						</div>
                       <hr>
                    </div>
                  </div>
                </div>

				<!--<div data-post_id="99" data-can_vote="yes" class="item-ratings"> <i class="fa fa-star" backup-class="fa fa-star"></i><i class="fa fa-star" backup-class="fa fa-star"></i><i class="fa fa-star" backup-class="fa fa-star"></i><i class="fa fa-star" backup-class="fa fa-star"></i><i class="fa fa-star-o" backup-class="fa fa-star-o"></i> <span> (306 rates)</span> </div>-->
                  </div>
                  <div class="item-meta">
                    <ul class="list-inline list-unstyled">
                      <li><span class="fa fa-clock-o"></span> <?php echo $coupondate; ?></li>
                      <!--<li> <a href="#"> <span class="fa fa-tag"></span>Coupon </a> </li>
                      <li class="pull-right"> <a href="#"> <span class="fa fa-plus-square"></span> </a> </li>-->
                    </ul>
                  </div>
                </div>
              </div>
			  
				<div class="modal cls_store_head fade cus_modal" id="myModal_visit_store<?php echo $kt;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content" id="newcontent<?php echo $kt;?>" style="display:none;"><!---->
                      <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <div class="modal-header-default">
                        <div style="background: url('<?php echo base_url()."uploads/adminpro/".$admindetailss[0]->site_logo;?>') no-repeat scroll 0px 0px transparent; height: 69px; padding: 0px 0px 0px 271px;">
                            <p class="lead3 m-warning display-none" style="display: block;color:#fff;">You're about to visit</p>
                            <h3><?php echo $store_details->affiliate_name;?></h3>
                        </div>
                            
                        </div>
                            </div>
                      
                      <div class="modal-body-default">
                      
                      <span class="alert alert-block" style="display: block; font-size: 16px;line-height: 25px;">
                      	<span>
                      		<center>Your visit has been recorded. The cashback from any purchase(s) will soon show in your account.</center>
                            
                            </span></span>
                            <?php
							if($coupons->type!='Promotion')
							{
							?>
                                <div style="display: block;" class="voucher-code display-none">
                                <p>Copy this voucher code &amp; paste at the checkout</p>
                                <span> <?php echo $coupons->code;?></span>
                               </div>
                           <?php
							}
						   ?>
                        
                        

                      </div>
					  <div class="modal-footer" style="display: block;">
						<div class="continue-hide m-non-warning display-none" style="display: block;margin-right: 29px;">
							<p class="copy-medium">
							  <?php
							if($coupons->type!='Promotion')
							{
							?>
								<a class="btn btn-primary" href="<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>"> Visit <?php echo $store_details->affiliate_name;?> and redeem code</a>
							 <?php
							}
							else
							{
								?>
								<a class="btn btn-primary" href="<?php echo base_url();?>"> Continue shopping at <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> for more great offers </a>
							 <?php
							}
							 ?>
							<br>
							</p>
						</div>
					  </div>
                       <hr>
                    </div>

                    <div class="modal-content" id="oldcontent<?php echo $kt;?>">
                      <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <div class="modal-header-default">
                        <div style="background: url('<?php echo base_url()."uploads/adminpro/".$admindetailss[0]->site_logo;?>') no-repeat scroll 0px 0px transparent; height: 69px; padding: 0px 0px 0px 271px;">
                            <p class="lead3 m-warning display-none" style="display: block;color:#fff;">You're about to visit</p>
                            <h3><?php echo $store_details->affiliate_name;?></h3>
                        </div>
                            
                        </div>
                            </div>
                      
                      <div class="modal-body-default">
                      <span class="alert alert-block" style="display: block; font-size: 16px;line-height: 25px;">
                      	<span>
                      		<ul>
                                <li><strong>After you shop, within 72 hours we add your Cashback to your <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> account & send you an email. This remains in 'Pending' status till the retailer pays us</strong></li>
                                </ul>
                                <ul>
                                <li>  As soon as we get the commission from retailers we change the status of
your Cashback to 'Confirmed'. This usually takes between 4-12 weeks (Retailers wait for the 30 days cancellation period to pass and pay us in the following month. We pay you as soon as we get paid!)</li>          </ul>
                                <ul>
                                <li>When you have <?php echo DEFAULT_CURRENCY;?> <?php echo $admindetails->minimum_cashback; ?>  or more as 'Confirmed' Cashback , you can request payment and we transfer the money to your bank account for free                  </li>
                                </ul></span></span>
                      </div>
						<div class="modal-footer" style="display: block;">
							<div class="continue-hide m-non-warning display-none" style="display: block;margin-right: 29px;">
								<p class="copy-medium">
								<a class="btn btn-primary" onClick="showhiddenmodal(<?php echo $kt;?>);" href="<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>" target="_blank">I understand, visit retailer </a>
								<br>
								</p>
							</div>
						</div>
                       <hr>     
                    </div>
                  </div>
                </div>
				<div class="modal fade" id="myModaly<?php echo $kt;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel">Login or Create an Account</h4>
					  </div>
					  <div class="modal-body">
					  
					  <div class="row">
					  
					  <div class="col-md-6">
					 
						<div class="md-card" id="login_card">
							<div class="md-card-content large-padding" id="login_form">
							<?php  $redirect_urlstring =  uri_string();
								if($redirect_urlstring=="")
								{
									$redirect_urlstring = 'cashback/index';
								}
								$redirect_endcede = insep_encode($redirect_urlstring);
								?>
								
							<ul class="list-inline clearfix uk-margin-bottom">
								<li><a class="btn btn-social btn-facebook btn-sm" href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><i class="fa fa-facebook"></i> Sign in with Facebook </a></li>
								<li><a class="btn btn-social btn-google-plus btn-sm" href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><i class="fa fa-google-plus"></i> Sign in with Google+ </a></li>
							</ul>
							
							<hr>
								 <?php
									 //begin form
										$attribute = array('role'=>'form','name'=>'login_form','id'=>'loginform_old', 'onSubmit'=>'return setupajax_login_old();', 'autocomplete'=>'off','method'=>'post');
										echo form_open('cashback/chk_invalid',$attribute);
									?>
									<center><span id="userstatus_old" style="color:red; font-weight:bold;"> </span></center>
									<div class="uk-form-row">
										<label for="login_username">Email</label>
										<input class="md-input" type="text" required id="emailid" name="email" autocomplete="off" />
									</div>
									<div class="uk-form-row">
										<label for="login_password">Password</label>
										<input class="md-input" type="password" id="login_password" name="pwd" autocomplete="off" required />
									</div><input id="signin" type="hidden" value="signin" name="signin">
									<div class="uk-margin-medium-top">
										<input type="submit" class="md-btn md-btn-danger md-btn-block" name="sign_in" id="signin" value="Sign In">
									</div>
									<div class="uk-margin-top">
										<a href="<?php echo base_url(); ?>cashback/forgetpassword" id="" class="uk-float-right">Forgot Password</a>
										<span class="icheck-inline pull-right">
											<input type="checkbox" name="rememberme" id="RememberMe" data-md-icheck />
											<label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
										</span>
									</div>
								</form>
							</div>
					  </div>
					  </div>
					  
					   <div class="col-md-6">
					   
					   <div class="new-user">
							  <div class="content">
								<div class="section-line">
								  <h4 class="text-capitalize"><?php echo $store_details->affiliate_name;?></h4>
								 
									<div class="label-pro-new-blnk" style="right:15px;"> <span style="text-align: center; top: 4px; left: 11px;" class="fnt-15"> <?php echo $cppercentage; ?> <br><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name;?></span></div>
									<p class="links mar40">
										<?php echo substr($store_details->affiliate_desc,0,130);?>
									</p>
									<div class="buttons-set">
										<a href="<?php echo base_url().'cashback/visit_shop/'.$affid.'/'.$coupon_id;?>"> <button type="button" class="md-btn md-btn-danger uk-margin-top"> Visit <?php echo $store_details->affiliate_name;?> and redeem code</button></a>
									</div>
								<hr>
								</div>
							  </div>
							</div>
					   </div>
					   </div>
					  </div>
					</div>
				  </div>
				</div>
			<?php $kt++; } echo '</div>'; ?>
			<div class="row">
				<div class="col-md-12">
					 <a id="more_button" href="javascript:void(0);" class="uppercase full-width btn btn-lg btn-info center-block">load more</a> 
					 <center> <a id="loader_more" style="display:none" class="full-width btn"><img src="http://www.phx.co.in/images/loading.gif" /></a>    </center>      <a id="more_button_null" style="display:none" class="uppercase full-width btn btn-lg btn-danger center-block">Sorry! No more results found</a>
				</div>
			</div>
			
			<?php } else {	?>
					<div class="store-title_red"><h3 class="text-center mar-no mar-bot20">No coupons available at this time</h3></div>
				<?php } ?>
			</div>
          </div>
			<?php
				$stores_list = $this->front_model->get_latest_stores();
				if($stores_list)
				{
			?>
          <div class="row">
            <div class="col-md-12">
              <h4> You might also like</h4>
              <div class="row ">
                <ul class="products-grid row mar-top">
				<?php
				$k=0;
				foreach($stores_list as $stores)
				{
					$affiliate_id = $stores->affiliate_id;
					$featured = $stores->featured;
					 $affiliate_name = $stores->affiliate_name;
					$count_coupons = $this->front_model->count_coupons($affiliate_name);
					$get_coupons_sets = $this->front_model->get_coupons_sets($affiliate_name,2);
				?>
                  <li class="ma-item_slider col-sm-4 col-sms-12 item first">
                    <div class="item-inner">
                      <div class="products clearfix">
                        <div class="product images-container"> <a class="product-image" title="<?php echo $stores->affiliate_name; ?>" href="<?php echo base_url(); ?>cashback/stores/<?php echo $stores->affiliate_url;?>"><img class="center-block" alt="" style="width:150px;height:100px;" src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $stores->affiliate_logo; ?>"></a> </div>
                      </div>
                      <h4 class="product-name text-center"><a title="<?php echo $stores->affiliate_name; ?>" href="<?php echo base_url(); ?>cashback/stores/<?php echo $stores->affiliate_url;?>"><?php echo $stores->affiliate_name; ?></a></h4>
                      <p class="text-center" style="height:60px;padding:10px;"> <?php if($stores->cashback_percentage)
							{ 
											if($stores->affiliate_cashback_type=="Percentage")
											{
												$cppercentage = $stores->cashback_percentage."%";
											}
											else
											{
												$cppercentage = DEFAULT_CURRENCY." ".$stores->cashback_percentage;
											}
										echo "Get Up to ".$cppercentage;?>
                                <?php 
							echo "Cashback ";
							}
							else
							{
								echo "Best Offers ";
							}?>
							<?php
								if($count_coupons->counting!=0 && $count_coupons->counting!='')
								{
									if($stores->cashback_percentage)
									{
										echo '&';
									}
								?>
							 <?php echo $count_coupons->counting;?> Coupons
							<?php	}	 ?> from <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> </p>
                      <p class="text-center"> <a href="<?php echo base_url(); ?>cashback/stores/<?php echo $stores->affiliate_url;?>" class="md-btn md-btn-danger cls_drak_bg"> Go to Store </a> </p>
                    </div>
                  </li>
				  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
		  <?php } ?>
        </div>
        <div class="col-md-3 col-sm-3"> 
			<?php
			if($store_details->sidebar_image)
			{	?>
				<a href="<?php echo $store_details->sidebar_image_url;?>"><img class="img-responsive" src="<?php echo base_url();?>uploads/sidebar_image/<?php echo $store_details->sidebar_image;?>"></a>
				<?php } ?>
			
          <div class="ma-item_slider">
            <div class="item-inner clearfix pad20 mar-tb20">
              <h4 class="text-center"> Our Cashback offers</h4>
              <p>This Cashback is paid over & above coupons and discounts</p>
              <hr>
              <h4 class="text-danger text-center">8% Cashback</h4>
            
<?php 
	if($store_details->cashback_percentage=="") 
	{
		?>
       		<center><h4 class="clr-blu">Currently no Cashback is available on <?php echo $store_details->affiliate_name?> </h4></center>
        <?php
	}
	else
	{	
		$store_categorysss = $store_details->store_categorys;
		$str_id = $store_details->affiliate_id;
		$newres = $this->db->query("SELECT * FROM `category_cashback` where store_id=$str_id and cashback!=0 and status='Active'");
		if($newres->num_rows == 0)
		{			
				if($store_details->affiliate_cashback_type=="Percentage")
				{
					$cppercentage = $store_details->cashback_percentage."%";
				}
				else
				{
					$cppercentage = DEFAULT_CURRENCY." ".$store_details->cashback_percentage;
				}				
			?>
       		<h3 class="clr-blu"><?php echo $cppercentage?>  Cashback</h3>
            <p><?php echo $store_details->affiliate_desc;?> </p><hr>
        	<?php
		}
		else
		{
			$resul = $newres->result();
			foreach($resul as $respi)
			{
				$category_id = $respi->category_id;
				$cat_details = $this->front_model->get_category_details_byid($category_id);
				$cashback = $respi->cashback;
				$cashback_type = $respi->cashback_type;	
				$cashback_details = $respi->cashback_details;
				
				if($cashback_type=="Percentage")
				{
					$cppercentage = $cashback."%";
				}
				else
				{
					$cppercentage = DEFAULT_CURRENCY." ".$cashback;
				}	
				?>
				<h3 class="clr-blu"><?php echo $cppercentage?>  Cashback</h3>
				<p> <?php echo $cashback_details?></p><hr>
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
  </div>

    <div id="myModal-review" class="modal cls_store_head fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title text-center"> User Reviews</h4>
		</div>
          <form class="form col-md-8 col-md-offset-2" action="#" method="post" onSubmit="return funct_setpremium_cat();">
        <div class="modal-body">
            <div class="form-group clearfix">
              <label class="col-md-3"> Write A Review </label>
              <div class="col-md-9">
                <textarea class="form-control" name="review_text" id="review_text"  rows="5"></textarea>
              </div>
            </div>
            <div class="form-group clearfix">
              <label class="col-md-3"> Rating </label>
              <div class="col-md-9">
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
                  <label for="star1">1 star</label>
                </div>
              </div>
            </div>
            <div class="from-group clearfix">
              <div class="col-md-9 col-md-offset-3">
                <button class="btn btn-success" type="button" onclick="return funct_setpremium_cat();"> Submit </button>
              </div>
            </div>
        </div>
          </form>
        <div class="modal-footer pad"> </div>
      </div>
    </div>
  </div>
    
  <!--- NEWSLETTER --->
  <section class="newsletter-bg mar-no">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="block-subscribe">
              <div class="newsletter">
                <form action="" method="post" onsubmit="return false;" id="newsletter-validate-detail1">
                  <h4><span> Signup for <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name;?> Exclusive Offers</span></h4>
                  <input type="text" name="email" id="emails" onkeypress="clears(2);" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" />
                  <button type="button" title="Subscribe" id="news_letter_submit" onClick="email_sub();" class="subscribe"><span>Subscribe</span></button>
				   <div id="msg" style="color:red;text-align:center;"></div>
                </form>
              </div>
              <!--newsletter--> 
            </div>
            <!--block-subscribe--> </div>
        </div>
      </div>
    </section>
  <!--continue-->
  <div class="modal fade" id="myModalz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Login or Create an Account</h4>
      </div>
      <div class="modal-body">
      
      <div class="row">
      
      <div class="col-md-6">
     
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
            <?php  $redirect_urlstring =  uri_string();
				if($redirect_urlstring=="")
				{
					$redirect_urlstring = 'cashback/index';
				}
				$redirect_endcede = insep_encode($redirect_urlstring);
				?>
				
            <ul class="list-inline clearfix uk-margin-bottom">
				<li><a class="btn btn-social btn-facebook btn-sm" href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><i class="fa fa-facebook"></i> Sign in with Facebook </a></li>
				<li><a class="btn btn-social btn-google-plus btn-sm" href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><i class="fa fa-google-plus"></i> Sign in with Google+ </a></li>
			</ul>
            
            <hr>
				 <?php
					 //begin form
						$attribute = array('role'=>'form','name'=>'login_form','id'=>'loginform_new', 'onSubmit'=>'return setupajax_login_new();', 'autocomplete'=>'off','method'=>'post');
						echo form_open('cashback/chk_invalid',$attribute);
					?>
					<center><span id="userstatus_new" style="color:red; font-weight:bold;"> </span></center>
                    <div class="uk-form-row">
                        <label for="login_username">Email</label>
                        <input class="md-input" type="text" required id="emailid" name="email" autocomplete="off" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="pwd" autocomplete="off" required />
                    </div><input id="signin" type="hidden" value="signin" name="signin">
                    <div class="uk-margin-medium-top">
						<input type="submit" class="md-btn md-btn-danger md-btn-block" name="sign_in" id="signin" value="Sign In">
                    </div>
                    <div class="uk-margin-top">
                        <a href="<?php echo base_url(); ?>cashback/forgetpassword" id="" class="uk-float-right">Forgot Password</a>
                        <span class="icheck-inline pull-right">
                            <input type="checkbox" name="rememberme" id="RememberMe" data-md-icheck />
                            <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                        </span>
                    </div>
                </form>
            </div>
      </div>
      </div>
      
       <div class="col-md-6">
       
       <div class="new-user">
              <div class="content">
                <div class="section-line">
                  <h4 class="text-capitalize"><?php echo $store_details->affiliate_name;?></h4>
                 
					<div class="label-pro-new-blnk" style="right:15px;"> <span style="text-align: center; top: 4px; left: 11px;" class="fnt-15"> <?php echo $cppercentage; ?> <br><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name;?></span></div>
					<p class="links mar40">
						<?php echo substr($store_details->affiliate_desc,0,130);?>
					</p>
                  <div class="buttons-set">
				   <a href="<?php echo base_url().'cashback/visit_shop/'.$store_details->affiliate_id; ?>"> <button type="button" class="md-btn md-btn-danger uk-margin-top">Continue Shopping without Cashback</button></a>
				  </div>
				<hr>
                </div>
              </div>
            </div>
       </div>
       </div>
      </div>
    </div>
  </div>
</div>
  <!--continue-->
<input type="hidden" name="pagenum" id="pagenum" value="2">
<input type="hidden" name="store_name" id="store_name" value="<?php echo $store_details->affiliate_url?>">
<footer>
  <?php
//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>
</footer>

<!-- FAQ --->
</div>



<?php $this->load->view('front/js_scripts');?>

<script type="text/javascript">
//Start Email subscribe
function email_sub()
{
	var email = $("#emails").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	if(!email || !emailReg.test(email))
		$('#emails').css('border', '2px solid red');
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
function clears(val)
{
	if(val==1)
		$('#invite_mail').css('border', '');
	else
		$('#emails').css('border', '');
} 
//End Email subscribe
$(function () { 
$("#more_button").click(function(){
	$('#loader_more').show();
	$("#more_button").hide();
	var pagenum = $('#pagenum').val();
//	var pagenum = 1;
	var store_name = $('#store_name').val();
	$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>cashback/store_ajax/'+pagenum+'/'+store_name,
			 success:function(result){

				if(result!=0)
				{
					$('#loader_more').hide();
					$('#sampleajax').append(result);
					var updated_page_num = parseInt(pagenum)+parseInt(1);
					$('#pagenum').val(updated_page_num);
					$("#more_button").show();
				}
				else
				{
					$('#loader_more').hide();
					$("#more_button").hide();
					$("#more_button_null").show();					
				}
			}
		});
});
});
</script>

 <!-- contact page specific js starts -->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/jquery.validate.min.js"></script>       
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/gmaps.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/map.js"></script>

<!-- Slider --> 




<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });

</script>


<script type="application/javascript">

function toggle_st(num)
{
	$('.toggle'+num).toggle('slow');
	return false;	
}


</script> 

<script type="application/javascript">

function showhidediv()
{
	$('#longdisp').show();
	$('#aaa').hide();
	return false;
}
function showhidecode(hidediv)
{
	$('#showcode'+hidediv).show();
	$('#hideline'+hidediv).hide();
	return false;	
}

function open_in_new_tab(url )
{
  var win=window.open(url, '_blank');
  win.focus();
}

function showhiddenmodal(id)
{
	$('#oldcontent'+id).hide();
	$('#newcontent'+id).show();
}
$('.btn-cart').click(function(){
	var url ='<?php echo $store_details->logo_url; ?>';
	var win = window.open(url, '_blank');
	win.focus();
});

function addfav(id){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>cashback/add_favorite',
		dataType:"json",
		data:"store_id="+id,
		success:function(msg){
			if(msg==1){
				$('.addfav').html('<a class="link-compare" href="javascript:;" ><i class="fa fa-heart text-info"></i> Added to Favorites</a>');
			}
		}
	});
}

function funct_setpremium_cat()
 {   
	//alert('sasas_1');
	if($("#review_text").val()==''){
		alert("Please enter the comments");
		return false;
	}
	if($('input:radio[name=rating]:checked').length == 0){
		alert("Please enter the rating");
		return false;
	}
	
	var review_text_new = $("#review_text").val();
	var radio_rating = $("input:radio[name=rating]:checked").length;
	var radio_ratings = $("input:radio[name=rating]:checked").val();
	var store = '<?php echo $store_details->affiliate_id; ?>';
	$.ajax({
	url:"<?php echo base_url(); ?>index.php/cashback/submit_store_ratings",
	data: "comments="+ review_text_new + "&rating=" + radio_ratings +"&store="+store,    
	type:"POST",
	success:function(msg)
	{  
		$('.comments-list').before('<div class="alert alert-success revlist"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <b>Success!</b> Your review has been submitted.</div>');
		$('#myModal-review').css('display','none');
		$('.revlist').delay(2000).fadeOut();
		$('.modal-backdrop').remove();
	}  
	});  

}
function scrolling(){

  $('html, body').animate({
        scrollTop: $("#scrollingelm").offset().top
    }, 2000);
}
function setupajax_login_new()
{
	var datas = $('#loginform_new').serialize();
	 $.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>cashback/logincheck",
		data: datas,
		cache: false,
		success: function(result)
		{
			if(result!=1)
			{
				$('#userstatus_new').html(result);
				return false;
			}
			else
			{
				if($('#navrefer_id').val()=='1'){
					<?php $redirect_urlset =  base_url();?>
					window.location.href = '<?php echo $redirect_urlset; ?>cashback/refer_friends';
				} else {
					<?php $redirect_urlset =  base_url(uri_string());?>
					window.location.href = '<?php echo $redirect_urlset; ?>';
				}
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

function setupajax_login_old()
{
	var datas = $('#loginform_old').serialize();
	 $.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>cashback/logincheck",
		data: datas,
		cache: false,
		success: function(result)
		{
			if(result!=1)
			{
				$('#userstatus_old').html(result);
				return false;
			}
			else
			{
				if($('#navrefer_id').val()=='1'){
					<?php $redirect_urlset =  base_url();?>
					window.location.href = '<?php echo $redirect_urlset; ?>cashback/refer_friends';
				} else {
					<?php $redirect_urlset =  base_url(uri_string());?>
					window.location.href = '<?php echo $redirect_urlset; ?>';
				}
				return false;
			}
		}
	});
	return false;
}

</script> 
</body>
</html>