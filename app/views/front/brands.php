<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Brands | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();
?>
</head>

<body>
<?php $this->load->view('front/header');?>
<!-- header ends here --->

<!--<section class="breadcrumb-sec clearfix">
  <div class="container">
    <div class="breadcrumb clearfix"> <a href="<?php echo base_url();?>" class="home">home</a> <span class="navigation-pipe">&gt;</span> Brands</div>
  </div>
</section>-->

<!--- breadcrumb sec ends here --->

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
         <!-- <div class="side-col col-sm-3 col-md-3">

              <!-- Side Widget 
              <div class="side-widget no-margin-l">
              
                <!-- ul-toggle 
                <ul class="ul-toggle font-size-sm">
                  <?php
					$categories = $this->front_model->get_all_categories(12);
				if($categories)
				{
					$kt1 = 1;
					foreach($categories as $view)
					{
						if($view->category_name)
						{
				  ?>
                  <li><a href="javascript:void(0);" onClick="runcheck_1('<?php echo 'cashback/stores_list/'.$view->category_url;?>');"><i class="icon fa fa-angle-right"></i><?php echo $view->category_name;?></a></li>
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
                <!-- /ul-toggle         
              </div>
              <!-- /Side Widget 
		  </div>-->
		<div class="col-md-12">
            
		 <div class="row">
          <div class="col-md-12">
		<?php
	    if($allbrands)
		{
		?>
            <div class="filters">
              <ul class="nav nav-pills">
                <li class="active"><a data-filter="*" href="javascript:void(0);">All</a></li>
                <?php
                foreach (range('A', 'Z') as $char) {
                    echo '<li class=""><a data-filter=".'.$char . '"  href="javascript:void(0);">'.$char . '</a></li>';
                }
				?>
              </ul>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="img-boxes isotope-container">
              
              <div class="row">
                <?php
				$k=0;
				foreach($allbrands as $brands)
				{
					$brands_name = $brands->brand_name;
					$setup =  strtoupper($brands_name[0]);
					if($brands->brand_image!='')
					{
						$img_url =base_url().'uploads/brands/'.$brands->brand_image;
					}
					else{
						$img_url =base_url().'front/img/rsz_default.jpg';
					}
				?>
                
                <div class="col-sm-6 col-md-3 col-xs-12 isotope-item <?php echo $setup;?>">
                  <div class="item first products-grid">
                   
                      <div class="_item first product-col  ">
                        <div class="wrap-item">
                          <div class="product-block">
                           
                            <div class="image ">
                              <div class="product-img img">
                               	<div class="box-bg">					 
									<a href="<?php echo base_url();?>cashback/products/<?php echo $brands->brand_url;?>_brands#brands=<?php echo $brands->brand_url;?>" title="<?php echo $brands->brand_name; ?>" ><img class="img-responsive center-block" src="<?php echo $img_url;?>" style="height:49px;width:83px;"></a>					 
									<h4 class="text-uppercase mar-top" style="height: 32px;"><?php echo $brands->brand_name; ?></h4>	
									<div class="product-meta product-shop">                          
									<div class="cart mar-top"> <a href="<?php echo base_url();?>cashback/products/<?php echo $brands->brand_url;?>_brands#brands=<?php echo $brands->brand_url;?>" title="<?php echo $brands->brand_name; ?>">
									<button type="button" title="Add to Cart" class="btn btn-primary bor-rad-no btn-block">  VIEW PRODUCT  </button>
									</a>									 
									  </div>                             
									</div>					
								</div>                 
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                   
                  </div>
                </div>
				<?php $k++;
				}
				?>
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
                  <strong>No Brands are available in this time!</strong>
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
			return false;
		});
	});
};     
</script>

</body>
</html>