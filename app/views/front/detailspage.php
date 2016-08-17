<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $admindetails[0]->homepage_title;?></title>
<meta name="Description" content="<?php echo $admindetails[0]->meta_description;?>"/>
<meta name="keywords" content="<?php echo $admindetails[0]->meta_keyword;?>" />
<link href='<?php echo base_url(); ?>front/css/pre-pge.css' rel='stylesheet' type='text/css'> 
<meta name="robots" CONTENT="INDEX, FOLLOW" />
<script type="text/javascript">

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
	//console.log($("input:radio[name=rating]:checked" ));
	var radio_rating = $("input:radio[name=rating]:checked").length;
	var coupons = $("#coupon_id").val();
	$.ajax({
	url:"<?php echo base_url(); ?>index.php/cashback/submit_ratings",
	data: "comments="+ review_text_new + "&rating=" + radio_rating +"&coupon="+coupons,    
	type:"POST",
	success:function(html_butadelike)
	{  
		$('.comments-list').append("Added Successfully");
		$('#myModal-review').css('display','none');
		$('.modal-backdrop').remove();
	}  
	});  

	

}

function add_to_cart()

{

	if($("#order_max").val()<=$("#user_max").val())
	{
		if($("#coupon_code").val())

		{
	
		$.ajax({  
	
		url:"<?php echo base_url(); ?>index.php/cashback/addtocart",
	
		data: "coupon="+$("#coupon_id").val(),     
	
		type:"POST",
	
		success:function(html_butadelike)
		{          
		if(html_butadelike==1)
		{
			$('#cart_succ').show();
			$('#addtocart').hide();
			$('#viewcart').show();
			window.location.href = '<?php echo base_url()."cashback/cart_listing_page";?>';
			//$('#result').load('<?php echo base_url()."cashback/detailspage";?>', function(){ $('#cart').attr("class","shopping-cart open"); });		
			
		}
		else
		{
			$('#cart_succ_already').show();
			$('#viewcart').show();
			$('#result').load('<?php echo base_url()."cashback/detailspage";?>', function(){ $('#cart').attr("class","shopping-cart open"); });		
		}

		}  
	
		});  	
	
		}
	
		else
	
		{
	
			alert("Coupon is not available");
	
		}
	}
	else
	{
		
		$('#cart_succ_already').html('User Limit Exceed');
		$('#cart_succ_already').show();
	}

	

}

</script>

<!-- Bootstrap -->

<?php $this->load->view('front/css_script'); ?>
</head>

<body>
<?php $this->load->view('front/header'); ?>

<div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a href="<?php echo base_url();?>">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
				<li class="active">Shopping <?php if($this->session->userdata('cityname'))
																{
																	echo "- ".$cityname = $this->session->userdata('cityname');
																} ?></li>
                                                                
			  </ul>
			</div>
			<!--col-xs-12--> 
		  </div>
		  <!--row--> 
		</div>
		<!--container--> 
	</div>
    
<div id="magik-slideshow" class="magik-slideshow">
  <div id="content">
  
  
    <div class="container">
      <section class="mid-sec mar40">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-7">
                <div class="fotorama" data-nav="thumbs" data-allowfullscreen="1" data-thumbheight="150" data-thumbwidth="150">
                  <?php                  $db_coupon_image=$details->coupon_image;

							 $exp_db_coupon_image=explode(",",$db_coupon_image);  							 

							 for($i=0;$i<count($exp_db_coupon_image);$i++) { 

							 ?>
                  <img src="<?php echo base_url(); ?>uploads/premium/<?php echo $exp_db_coupon_image[$i]; ?>" height="326"  alt=""  />
                  <?php } ?>
                </div>
              </div>
              <div class="col-md-5">
                <div class="product-info box comment">
                  <ul class="icon-group icon-list-rating comment-review-rate" title="4.5/5 rating">
                    <?php for($i=0;$i<$avg_rating->rate;$i++) { ?>
                    <li><i class="fa fa-star"></i> </li>
                    <?php } ?>
                  </ul>
                  
                  <!--  <small><a href="#" class="text-muted">based on 8 reviews</a></small>-->
                  
                  <h4><?php echo $details->offer_name; ?></h4>
                  <p class="product-info-price"><?php echo DEFAULT_CURRENCY." ".$details->amount; ?></p>
                  <p class="text-smaller text-muted"> <?php echo strip_tags($details->description)."...";   ?></p>
                  
                  <!-- <ul class="icon-list list-space product-info-list">

                    <li><i class="fa fa-check"></i>Pulvinar nulla</li>

                    <li><i class="fa fa-check"></i>Vitae aliquet</li>

                    <li><i class="fa fa-check"></i>Metus praesent</li>

                  </ul>-->
                  
                  <ul class="list-inline">
                    <?php  if($this->session->userdata('user_id')!='')  { ?>
                    <p id="cart_succ" style="color:green; display:none; font-weight:bold">Coupon added Successfully</p>
                    <p id="cart_succ_already" style="color:green; display:none; font-weight:bold">Coupon already added</p>
                    <li><a href="javascript:void(0);" id="addtocart" onclick="return add_to_cart();" class="btn btn-blue"><i class="fa fa-shopping-cart"></i> Add to cart</a> </li>
                    <li><a href="<?php echo base_url()."cashback/cart_listing_page";?>" id="viewcart" style="display:none" onclick="" class="btn btn-blue"><i class="fa fa-shopping-cart"></i> View Cart</a> </li>
                    <?php } else { ?>
                    <a  class="btn btn-blue" href="#myModal" data-toggle="modal"><i class="fa fa-sign-in pad-rht"></i>Sign in to add to cart</a>
                    <?php } ?>
                    
                    <!-- <li><a href="#" class="btn btn-default"><i class="fa fa-star"></i> To Wishlist</a> </li>-->
                    
                  </ul>
                </div>
              </div>
            </div>
            <div class="gap gap-small"></div>
            <div class="tabbable">
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Description"><i class="fa fa-info"></i>Description</a> </li>
                 <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-info"></i>The Deal</a> </li>
                <li class=""><a data-toggle="tab" href="#google-map-tab" onClick=""><i class="fa fa-map-marker"></i>Location</a> </li>
                
                <!--  <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-info"></i>Comments</a> </li>-->
                
                <li class=""><a data-toggle="tab" href="#tab-6"><i class="fa fa-info"></i>The Company</a> </li>
                
                <!--<li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-info"></i>The Deal</a> </li>

              <!--<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-tag"></i>The Deal</a> </li>

               <li class=""><a data-toggle="tab" href="#google-map-tab"><i class="fa fa-map-marker"></i>Location</a> </li>-->
                
                <li><a data-toggle="tab" href="#tab-3"><i class="fa fa-comments"></i>Reviews</a> </li>
              </ul>
              <div class="tab-content">
                <div id="tab-3" class="tab-pane fade">
                  <ul class="comments-list">
                    <?php if($reviews) {  foreach($reviews  as $review) { ?>
                    <li>
                      <article class="comment">
                        <div class="comment-author"> <img class="img-responsive"  alt="" src="http://mouzakinews.gr/wp-content/uploads/2013/07/user-icon-512.png" width="72" > </div>
                        <div class="comment-inner">
                          <ul title="4/5 rating" class="icon-group icon-list-rating comment-review-rate">
                          
                            <?php                       
							//echo $review->ratings;
							
							for($i=0;$i<$review->ratings;$i++) { ?>
                            <li><i class="fa fa-star"></i> </li>
                            <?php } ?>
                          </ul>
                          <h5 class="thumb-list-item-title"><a href="#"><?php echo $review->first_name; ?></a></h5>
                          <p class="thumb-list-item-author"><?php echo $review->comments; ?></p>
                        </div>
                      </article>
                    </li>
                    <?php } } ?>
                  </ul>
                  <?php  if($this->session->userdata('user_id')!='')  { ?>
                  <a data-toggle="modal" href="#myModal-review" class="popup-text btn btn-blue"><i class="fa fa-pencil"></i> Add a review</a>
                  <?php } else { ?>
                  <a class="popup-text" href="#myModal" data-toggle="modal"><i class="fa fa-sign-in pad-rht"></i>Sign in to add review</a>
                  <?php } ?>
                </div>
                <div id="Description" class="tab-pane fade active in">
                  <div class="row text-smaller">
                    <div class="col-md-12">
                      <!--<h4>Detailed Description</h4>-->
                      <p><?php echo $details->long_description; ?> </p>
                    </div>
                   
                  </div>
                </div>
                
                <div id="tab-1" class="tab-pane fade">
                  <div class="row text-smaller">
                    <div class="col-md-4">
                     <!-- <h4>About</h4>-->
                      <p><?php echo $details->about; ?> </p>
                    </div>
                    <div class="col-md-4">
                    <!--  <h4>In a Nutshel</h4>-->
                      <p><?php echo $details->nutshel; ?></p>
                    </div>
                    <div class="col-md-4">
                      <!--<h4>The Fine Print</h4>-->
                      <p><?php echo $details->fine_print; ?></p>
                    </div>
                  </div>
                </div>
                <div id="google-map-tab" class="tab-pane fade">
                
               
                
               
                
                
                
                  <iframe width="100%" height="350px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?q=<?php echo $details->location; ?>&ll=&spn=0.009935,0.01929&t=h&layer=c&cbll=&z=16&cbp=12,354.03,,0,-11.17&amp;source=embed&amp;output=svembed"></iframe>
                  <br/>
                  <small><a href="https://maps.google.com/?q=<?php echo $details->location; ?>&ll=&spn=0.009935,0.01929&t=h&layer=c&cbll=&z=16&cbp=12,354.03,,0,-11.17&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small> </div>
                <div id="tab-5" class="tab-pane fade"> 
                  
                  <!-- START COMMENTS -->
                  
                  
                  
                  <!-- END COMMENTS -->
                  
                  <div class="text-center"><a class="btn btn-primary"><i class="fa fa-pencil"></i> Leave a Comment</a> </div>
                </div>
                <div id="tab-6" class="tab-pane fade">
                  <h3><?php echo $details->title; ?></h3>
                  <p><?php echo $details->company; ?></p>
                <!--  <a  href="<?php echo $details->offer_page; ?>"class="btn btn-primary">Company Website <i class="fa fa-external-link"></i></a>-->
                  
                  <?php
				  if($details->offer_page) 
				  {
				  $attribute = array('class'=>'btn btn-primary');
				  echo anchor($details->offer_page,'Company Website <i class="fa fa-external-link"></i>'); 
				  }?>
                   </div>
                <div id="tab-4" class="tab-pane fade">
                  <h3><?php echo $details->title; ?></h3>
                  <p><?php echo $details->description; ?></p>
                </div>
              </div>
            </div>
            <div class="gap gap-small"></div>
            <h4>Related Products</h4>
            <div class="gap gap-mini"></div>
            <div class="row row-wrap">
            
            
                
                
              <?php if($related_products) { foreach($related_products as $related_product) { 

		                     $db_coupon_image=$related_product->coupon_image;

							 $exp_db_coupon_image=explode(",",$db_coupon_image);  							 

							 $f_dbcouponfirst_img=$exp_db_coupon_image[0];

							 $getremain_days=$this->front_model->find_remainingdays($related_product->expiry_date);

		    ?>
              <a href="<?php echo base_url(); ?>index.php/detailspage/<?php echo $related_product->shoppingcoupon_id; ?>/<?php echo $related_product->seo_url; ?>" class="col-md-4">
              <div class="product-thumb">
                <header class="product-header"> <img title="Hot mixer" style="width:234px;height:154px;" alt="Image Alternative text" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>"> </header>
                <div class="product-inner">
                  <h5 class="product-title">
				  
				  <?php echo   substr($related_product->offer_name,0,30)."...";   ?>
                  </h5>
                  <p class="product-desciption"><?php echo   substr($related_product->description,0,54)."...";  ?></p>
                  <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i>
                    <?php  echo $getremain_days['days']." days ".$getremain_days['hours']." h "." remaining";   ?>
                    </span>
                    <ul class="product-price-list">
                      <li><span class="btn btn-blue"><?php echo DEFAULT_CURRENCY.' '.$related_product->amount ?></span> </li>
                      
                      <!--  <li><span class="product-old-price">$141</span>

                                            </li>

                                            <li><span class="product-save">Save 63%</span>

                                            </li>-->
                      
                    </ul>
                  </div>
                  
                  <!--  <p class="product-location"><i class="fa fa-map-marker"></i> Boston</p>--> 
                  
                </div>
              </div>
              </a>
              <?php } } else { ?>
              <div class="alert alert-error">
                <button class="close" data-dismiss="alert">x</button>
                <strong>Oops! </strong> No products found </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-md-3">
            <aside class="sidebar-right">
              <div class="sidebar-box">
                <h5>Recent Viewed</h5>
                <ul class="thumb-list">
                  <?php 
				  $stk =0;
				   $kk=0;
				  if($recently_viewd)  
					  { 
					  $kk=1;
						$stk=1;
						  foreach($recently_viewd as $recently_view1) 
						  {
							  $stk=1;
								$recently_view=$this->front_model->details($recently_view1->product_id);  
								if($recently_view)
								{
									 $recently_view_image=$recently_view->coupon_image;
									 $exp_db_coupon_image_1=explode(",",$recently_view_image);  							 
									 $recently_view_load_image=$exp_db_coupon_image_1[0];
							 ?>
									  <li> <a href="<?php echo base_url(); ?>index.php/detailspage/<?php echo $recently_view->shoppingcoupon_id; ?>/<?php echo $recently_view->seo_url; ?>"> <img  src="<?php echo base_url(); ?>uploads/premium/<?php echo $recently_view_load_image; ?>" alt=""/> </a>
										<div class="thumb-list-item-caption">
										  <h5 class="thumb-list-item-title"><a href="<?php echo base_url(); ?>index.php/detailspage/<?php echo $recently_view->shoppingcoupon_id; ?>/<?php echo $recently_view->seo_url; ?>"><?php echo $recently_view->offer_name; ?></a></h5>
										  <p class="thumb-list-item-price"><?php echo DEFAULT_CURRENCY." ".$recently_view->amount; ?></p>
										</div>
									  </li>
							<?php
							$stk++;
							 }
					 
					  }
					} 
					else { ?>
                  <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">x</button>
                    <strong>Oops! </strong> No products found </div>
                  <?php } 
				 
				  if($stk<2 && $kk=1)
					{					
						 ?>
                      <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">x</button>
                        <strong>Oops! </strong> No products found </div>
                      <?php 
					}
				  ?>
                </ul>
              </div>
              <div class="sidebar-box">
                <h5>Popular</h5>
                <ul class="thumb-list">
                  <?php if($popular) { 
				
				//print_r($popular);
			
				foreach($popular as $popula) { 

				 $db_coupon_image=$popula->coupon_image;

							 $exp_db_coupon_image=explode(",",$db_coupon_image);  							 

							 $f_dbcouponfirst_img=$exp_db_coupon_image[0];

							

				 ?>
                  <li> <a href="<?php echo base_url(); ?>index.php/detailspage/<?php echo $popula->shoppingcoupon_id; ?>/<?php echo $popula->seo_url; ?>"> <img src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" alt=""/> </a>
                    <div class="thumb-list-item-caption">
                      <h5 class="thumb-list-item-title"><a href="#"><?php echo $popula->offer_name; ?></a></h5>
                      <p class="thumb-list-item-price"><?php echo DEFAULT_CURRENCY.' '.$popula->amount; ?></p>
                    </div>
                  </li>
                  <?php $exp_db_coupon_image='';} } else { ?>
                  <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">x</button>
                    <strong>Oops! </strong> No products found </div>
                  <?php } ?>
                </ul>
              </div>
              <div class="sidebar-box">
                <h5>Recent Reviews</h5>
                <ul class="thumb-list">
                  <?php if($recent_reviews) { foreach($recent_reviews  as $recent_review) { ?>
                  <li> <!--<a href="#"><img src="images/cat-img3.png" alt=""/> </a>-->
                    <div class="thumb-list-item-caption">
                      <ul class="icon-group icon-list-rating" title="5/5 rating">
                        <?php                       for($i=0;$i<$recent_review->ratings;$i++) { ?>
                        <li><i class="fa fa-star"></i> </li>
                        <?php } ?>
                      </ul>
                      <h5 class="thumb-list-item-title"><a href="#"><?php echo $recent_review->first_name; ?></a></h5>
                      <p class="thumb-list-item-author"><?php echo $recent_review->comments; ?></p>
                    </div>
                  </li>
                  <?php } } else { ?>
                  <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">x</button>
                    <strong>Oops! </strong> No reviews found </div>
                  <?php } ?>
                </ul>
              </div>
            </aside>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<input type="hidden" name="user_max" id="user_max" value="<?php echo $details->user_max;?>" >
 
<?php 
if($this->session->userdata('user_id'))
{
	$userid  = $this->session->userdata('user_id');
	$order_max = $this->db->query('SELECT count(*) as order_max FROM `premium_order` where user_id="'.$userid.'" and product_id="'.$details->shoppingcoupon_id.'"')->row('order_max');
	echo '<input type="hidden" name="order_max" id="order_max" value="'.$order_max.'" >';
}
?>




<footer>
  <div id="myModal-review" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a> </div>
        <div class="modal-body">
          <form class="form col-md-8 col-md-offset-2" action="#" method="post" onSubmit="return funct_setpremium_cat();">
            <h4> User Reviews</h4>
            <hr>
            <div class="form-group clearfix">
              <label class="col-md-3"> Write A Review </label>
              <div class="col-md-9">
                <textarea class="form-control" name="review_text" id="review_text"  rows="5"></textarea>
              </div>
            </div>
            <input type="hidden" value="<?php echo $details->remain_coupon_code; ?>" id="coupon_code">
            <input type="hidden" value="<?php echo $details->shoppingcoupon_id; ?>" id="coupon_id">
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
          </form>
        </div>
        <div class="modal-footer pad"> </div>
      </div>
      
      <!-- /.modal-content --> 
      
    </div>
    
    <!-- /.modal-dalog --> 
    
  </div>
  <?php

//sub footer

	$this->load->view('front/sub_footer');

	

//Footer

	$this->load->view('front/site_intro');	



?>
</footer>
<?php $this->load->view('front/js_scripts');?>

<!-- Google Map script --> 

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
<script>

 

 

var map;

/*function initialize() {

	//alert("AA");

 var mapOptions = {

   zoom: 6,

   center: new google.maps.LatLng(-34.397, 150.644)

 };

 map = new google.maps.Map(document.getElementById('map-canvas'),

     mapOptions);

         

          address = 'india'



   geocoder = new google.maps.Geocoder();

 

       geocoder.geocode( { 'address': address}, function(results, status) {



      map.setCenter(results[0].geometry.location);



       });

}



google.maps.event.addDomListener();*/



</script>
</body>
</html>
