<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title><?php echo $category_details->meta_keyword;?></title>
<meta name="Description" content="<?php echo $category_details->meta_keyword;?>"/>
<meta name="keywords" content="<?php echo $category_details->meta_description;?>" />
<meta name="robots" CONTENT="INDEX, FOLLOW" />

<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>front/css/pre-pge.css" type="text/css">
</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->

<div class="wrap-top">
  <div id="content">
    <div class="page-intro" style="margin-top: 0px;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><i class="fa fa-home pad-rht"></i><a href="<?php echo base_url();?>">Home</a></li>
              <!--<li class=""><a href="<?php echo base_url();?>cashback/products/<?php echo $categoryurl;?>"><?php echo $categoryurl;?></a></li>-->
              <li class="active"><?php echo $category_details->category_name;?></li>
              <!--   <li class="active">Add Missing Cashback</li>-->
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <section class="coupon-section mar40">
        <div class="row">
          <div class="col-md-3">
            <aside class="sidebar-left store-title">
              <h3 class="mar-no mar-bot20"><i class="fa fa-ticket"></i>Categories</h3>
              <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
                <?php 
								$categories = $this->front_model->get_all_categories();
								$kt = 1;
								foreach($categories as $view)
								{
									$category_name = $view->category_name; 
									$subcate =  $this->front_model->get_sub_categorys_list($view->category_id);
									if($subcate)
									{
										$s = 'class="dropdown-toggle " data-toggle="dropdown"';
									}
									else
									{
										$s = '';
									}
									if($kt>10)
									{
										$extracss = 'style="display:none"';
									}
									else
									{	
										$extracss='';
									}
								?>
                <li class="dynamiccls" <?php echo $extracss." "; 
										if($main_category==$category_name)
										{
											echo 'class="active"';
										}
										?>> <a <?php echo $s;?> onClick="runcheck_1('<?php echo 'cashback/products/'.$view->category_url;?>');" href="<?php echo base_url().'cashback/products/'.$view->category_url;?>"><i class="fa fa-arrow-circle-right"></i><?php echo $view->category_name;?></a>
                  <?php
										
										if(count($subcate)!=0)
										{
											if($subcate)
											{
												echo '<ul class="list-unstyled clsin_list">';
												$category_url = $view->category_url;
												
												foreach($subcate as $subcatelist)
												{
													$sub_category_name = $subcatelist->sub_category_name;
													$sub_category_url = $subcatelist->sub_category_url;
													$sun_category_id = $subcatelist->sun_category_id;
													
													?>
                <li <?php echo $kt;?>><?php echo anchor('cashback/products/'.$category_url.'/'.$sub_category_url,$sub_category_name); ?></li>
                <?php
												}
												echo " </ul>";
											}
										}										
										?>
                <?php //echo anchor('cashback/products/'.$view->category_url,'<i class="fa fa-arrow-circle-right"></i>'.$view->category_name); ?>
                </li>
                <?php 
								$kt++;} ?>
              </ul>
              <button class="btn btn-block btn-blue" id="load_m" onClick="show_cate();"> Load more </button>
            </aside>
          </div>
          <div class="col-md-9">
            <div class="store-title">
              <h3 class="mar-no mar-bot20"><?php echo $category_details->category_name;?> Coupon Codes& Cashback Offers</h3>
            </div>
            <div class="row">
              <?php
	   if($stores_list)
	   {
		   $k=1;
	 	foreach($stores_list as $stores)
		{
			$affiliate_id = $stores->affiliate_id;
			$affiliate_name = $stores->affiliate_name;
			$featured = $stores->featured;
			$count_coupons = $this->front_model->count_coupons($affiliate_name);
			$get_coupons_sets = $this->front_model->get_coupons_sets($affiliate_name,2);
					if($featured!=0)
					{

						$setup = "feature";

						$namess = "Feature"; //heading
						$colors_li= 'style="background-color:#32c2cd;"';

					}

					else

					{

						$store_of_week = $stores->store_of_week;

						if($store_of_week!=0)

						{

							$setup = "store";

							$namess = "Store of the Week "; //heading
							
							$colors_li= 'style="background-color:#a5d16c;"';

						}

						else

						{

							$setup = "offers";

							$namess = "Offers "; //heading
							
							$colors_li= 'style="background-color:#e74955;"';

						}

					}
			?>
              <div class="col-md-6">
                <div class="product-container">
                  <div class="on-sale-wrap1"> <span class="ons-sale" <?php echo $colors_li;?> > <?php echo $namess?> </span> </div>
                  <div class="row">
                    <div class="left-block col-md-4">
                      <div class="product-image-container"> <?php echo anchor('cashback/stores/'.$stores->affiliate_url,'<img src="'.base_url().'uploads/affiliates/'.$stores->affiliate_logo.'" width="105" height="52" class="">'); ?> </div>
                    </div>
                    <div class="center-block col-md-8">
                      <div class="product-flags"><span class="discount"><?php echo anchor('cashback/stores/'.$stores->affiliate_url,$stores->affiliate_name); ?><small>-
                        <?php if($stores->cashback_percentage)
						{ 
						if($stores->affiliate_cashback_type=="Percentage")
						{
							$cppercentage = $stores->cashback_percentage."%";
						}
						else
						{
							$cppercentage = DEFAULT_CURRENCY_CODE." ".$stores->cashback_percentage;
						}
				
							echo "Up to ".$cppercentage;?>
                        <?php 
						}?>
                        Cashback  
						
						<?php
										if($count_coupons->counting!=0 && $count_coupons->counting!='')
										{
											if($stores->cashback_percentage)
											{
												echo '&';
											}
										?>
                                 <?php echo $count_coupons->counting;?> Coupons
                                <?php
										}
										 ?>
                                         
                                         
                        
						</small></span></div>
                      <h5> <a href="" onClick="return toggle_st(<?=$k?>);" id="toggle<?=$k?>" class="clr-blu"> <i class="fa fa-arrow-circle-o-right"></i> Click to Expand </a></h5>
                      <div class="toggle<?=$k?>" id="toggle<?=$k?>" style="display:none;">
                        <h4> Top Offers <small> <?php echo anchor('cashback/stores/'.$stores->affiliate_url,'See All Offers',array('class' => 'clr-blu')); ?> </small></h4>
                        <hr>
                        <?php
						//print_r($get_coupons_sets);
						
						if($get_coupons_sets)
						{
							foreach($get_coupons_sets as $get_coupons)
							{
							?>
                        <p> <strong>></strong> <?php echo $get_coupons->title; 
								  	if($stores->cashback_percentage)
								  	{
										echo " + Get additional <strong>".$stores->cashback_percentage."%</strong> Cashback ";
									}
								  ?> </p>
                        
                        <!-- <h5> Expires in 6 days</h5>
                            
                        </p>
                        <?php
							}
						}
						?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
			$k++;
		}
	   }
	   else
	   {
		   ?>
              <div class="alert alert-danger bs-alert-old-docs">
                <center>
                  <strong>No Coupons found on this category!</strong>
                </center>
                </a> </div>
              <?php
		}
	   ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<footer>
  <?php
//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>
</footer>

<!-- FAQ --->

<?php $this->load->view('front/js_scripts');?>

<!-- contact page specific js starts --> 

<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/jquery.validate.min.js"></script> 
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/gmaps.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/map.js"></script> 

<!-- Slider --> 

<!------------------------Product Slider--------------------> 
<script src="<?php echo base_url(); ?>front/js/owl.carousel.js"></script> 
<script>
$(document).ready(function() {
	
	 // begin first table
      
		
		
$('.owl-carousel').owlCarousel({
loop: true,
margin: 1,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: true
},
600: {
items: 2,
nav: true
},
1150: {
items: 4,
nav: true,
loop: false,
margin:0
}
}
})
})

</script> 
<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });

</script> 
<script type="application/javascript">

function toggle_st(num)
{
	$('.toggle'+num).toggle('slow');
	return false;	
}
//id="load_m" onClick="show_cate();
function show_cate()
{
	$('.dynamiccls').show();
	$('#load_m').hide();
}
</script> 
<script type="text/javascript">
function runcheck_1(url)
{
	window.location.href="<?php echo base_url();?>"+url;
}
</script>
</body>
</html>
