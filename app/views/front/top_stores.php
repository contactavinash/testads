<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>India's Top Cashback Deals<?php echo date('Y')?>. Get Exclusive Cashback Offers in <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<meta name="Description" content="Get the best Cashback Offers at top brands. Never pay full price again. Join now Free & Start Saving!"/>
<meta name="keywords" content="cashback, vouchers, coupons, discounts, offers, deals, promo codes, onlin shopping, best online shopping sites" />
<meta name="robots" CONTENT="INDEX, FOLLOW" />
<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();
?>
</head>

<body>
<?php $this->load->view('front/header');?>


<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
          <div class="side-col col-sm-3 col-md-3">

              <!-- Side Widget -->
              <div class="side-widget no-margin-l">
              
                <!-- ul-toggle -->
                <ul class="ul-toggle font-size-sm">
				<?php
					$categories = $this->front_model->get_all_categories(15);
				if($categories)
				{
					$kt1 = 1;
					foreach($categories as $view)
					{
						if($view->category_name)
						{
				  ?>
                  <li><a href="javascript:void(0);" onClick="runcheck_1('<?php echo 'stores_list/'.$view->category_url;?>');"><i class="icon fa fa-angle-right"></i><?php echo $view->category_name;?></a></li>
                  <?php
						}
					$kt1++;
					}
				}
				else{
					echo 'No category available!';
				}
				?>
                </ul>
                <!-- /ul-toggle -->
          
              </div>
              <!-- /Side Widget -->
              


            </div>
          <div class="col-md-9">

         <div class="row mar-top10">
    <div class="col-md-3">
      <a href="<?php echo base_url(); ?>stores_list">
      <button class="btn btn-danger btn-block  bor-rad-0" type="button">Top Stores</button>
    </a>
    </div>

<div class="col-md-3">
    <a href="<?php echo base_url(); ?>coupons">
      <button type="button" class="btn btn-info btn-block  bor-rad-0 ">Coupons</button>
    </a>
    </div>

<div class="col-md-3">
    <a href="<?php echo base_url(); ?>salable_coupons">
      <button type="button" class="btn btn-primary btn-block  bor-rad-0 ">Salable Coupons</button>
    </a>
    </div>



<div class="col-md-3">
    <a href="<?php echo base_url(); ?>top_cashback">
      <button type="button" class="btn btn-warning btn-block bor-rad-0">Top cashbak</button>
    </a>
    </div>
  </div>
  <br>
            
             <div class="row">
          <div class="col-md-12">
		<?php
	   if($stores_list)
		{
		?>
            <div class="filters">
              <ul class="nav nav-pills">
                <li class="active"><a data-filter="*" href="#">All</a></li>
                <?php
                foreach (range('A', 'Z') as $char) {
                    echo '<li class=""><a data-filter=".'.$char . '"  href="#">'.$char . '</a></li>';
                }
				?>
              </ul>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="img-boxes isotope-container">  
 <div id="msg-box" class="text-center" style="display:none; background-color:pink;">No Results Found!!</div>			  
              <div class="row">
				<?php
				$k=0;
				foreach($stores_list as $stores)
				{
					$affiliate_id = $stores->affiliate_id;
					$featured = $stores->featured;
					 $affiliate_name = $stores->affiliate_name;
					$count_coupons = $this->front_model->count_coupons($affiliate_name);
					$get_coupons_sets = $this->front_model->get_coupons_sets($affiliate_name,2);
					$setup = "";
					$namess = ""; //heading
					$colors_li= '';
					$setup =  strtoupper($affiliate_name[0]);
					
					if($stores->affiliate_logo!='')
					{
						$img_url =base_url().'uploads/affiliates/'.$stores->affiliate_logo;
					}
					else{
						$img_url =base_url().'front/img/rsz_default.jpg';
					}
				?>                
                <div class="col-sm-6 col-md-4 col-xs-12 isotope-item <?php echo $setup;?>">
                   <div class="stores-bg clearfix">
                  
                  <div class="product-block">
                           
                            <div class="image ">
                              <div class="product-img img" style="height:110px;">
                                <a href="<?php echo base_url();?>stores/<?php echo $stores->affiliate_url;?>" target="_blank;" class="product-image img" title="<?php echo $stores->affiliate_name; ?>">
                                  <img src="<?php echo $img_url;?>"  class="img-responsive center-block"></a>                                
                              
                                <p class="text-center mar-top"><span class="price "><?php echo $stores->affiliate_name; ?></span> </p>
                              </div>
                            </div>
                <div class="product-meta product-shop" style="height: 180px;">
                  <h3 class="product-name name" style="min-height:80px;">
                  <a href="<?php echo base_url();?>stores/<?php echo $stores->affiliate_url;?>" target="_blank;" title="<?php echo $stores->affiliate_name; ?>">
                                
                  <?php 
                  if($stores->cashback_percentage)
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
                <?php }?> from 
                <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> 
                               <!--   Get Up to Rs. 4 Cashback  &  135 Coupons from cashcraft  -->
                </a>
                </h3>
                         
                              
                              <div class="cart mar-top"> 
                                <a href="<?php echo base_url();?>stores/<?php echo $stores->affiliate_url;?>" target="_blank;" title="<?php echo $stores->affiliate_name; ?>">

                                <button type="button" title="<?php echo $stores->affiliate_name; ?>" class="btn btn-primary bor-rad-0 btn-block mar-bot">  Visit Store Coupons  </button>
                                </a> 
                             
                              </div>
                              <div class="action">

                                <p class="wishlist text-center">
                                 <a class="btn btn-danger bor-rad-0 btn-block" data-target="#myModal_<?php echo $stores->affiliate_url;?>" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-heart-o"></i>About Store</a>
                                 </p>
                                
                               
                                
                              </div>
                            </div>
                          </div>
                  
                  </div>
				 
                </div>
				 <!-- model -->
					<div class="modal fade" id="myModal_<?php echo $stores->affiliate_url;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">About <?php echo $stores->affiliate_name; ?></h4>
						  </div>
						  <div class="modal-body">
							<p class="txt">
							  <?php
									  echo $stores->affiliate_desc;
							  ?>
							</p>
						  </div>
						  <hr>
						</div>
					  </div>
					</div>
				<!-- model -->
				<?php $k++;
				} ?>
                
                </div>               
              </div>              
              </div>
            </div>
			<?php 
		} else
		{ ?>
            <div class="row">
              <div class="alert alert-danger bs-alert-old-docs">
                <center>
                  <strong>No Stores are available in this time!</strong>
                </center>
              </div>
            </div>
		<?php  
		}   ?> 
			
			
          </div>   
            
	  </div>
        </div>
     
  </div>
  
  </div>
</section>

<!--- inner pagesec ends here --->
<?php $this->load->view('front/sub_footer');

	
//Footer
	$this->load->view('front/site_intro');	
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
<script type="text/javascript" src="<?php echo base_url();?>front/js/isotope.pkgd.min.js"></script>

<!-- Initialization of Plugins -->
<script>

// Isotope filters
//-----------------------------------------------
if ($('.isotope-container').length>0) {
	$(window).load(function() {
		var $container = $('.isotope-container').isotope({
			itemSelector: '.isotope-item',
			layoutMode: 'masonry',
			transitionDuration: '0.6s',
			filter: "*"
		});
		// filter items on button click
		$('.filters').on( 'click', 'ul.nav li a', function() {
			var filterValue = $(this).attr('data-filter');
			$(".filters").find("li.active").removeClass("active");
			$(this).parent().addClass("active");
			$container.isotope({ filter: filterValue });
			if ( !$container.data('isotope').filteredItems.length ) {
				$('#msg-box').show();
			}
				else{
					$('#msg-box').hide();
					}
			return false;
		});
	});
};     

</script>

</body>
</html>
