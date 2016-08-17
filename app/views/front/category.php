<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strtoupper($this->uri->segment(3));?> | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();
?>
<style>
.searchcate
{
 min-height:127px;
}
</style>
</head>

<body>

<?php $this->load->view('front/header'); ?>

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
       

<div class=" col-sm-3 col-md-3">
          
          <ul class="nav nav-pills nav-stacked side-col">
                
                <li class="nav-parent active">
                  <a href=""><i class="fa fa-star"></i> <span>Popular Price Lists</span></a>
                  <ul class="children">
                   <?php
					$getproductname =$this->front_model->getproductname($categoryid);
					$popular_brandslist = $this->front_model->get_nextlevel_category($categoryid);
					if($popular_brandslist)
					{
						$strs = '';
						foreach($popular_brandslist as $brands_list){
						        if($brands_list->category_brands){
								//echo 'seetha';
								$strs .= $brands_list->category_brands.','; 
							}else{
								$strs .="";
							}
						 }

						$sdf = $this->front_model->get_brands(rtrim($strs,','));
                                                if($sdf)
						{
						   foreach($sdf as $listf)
						    {
					     ?>
						   <li><a href="<?php echo base_url();?>products/<?php echo $listf->brand_url;?>_brands/<?php echo $getproductname->category_name.'_0' ?>#brands=<?php echo $listf->brand_url;?>#<?php echo $getproductname->category_name.'_0' ?>"><i class="fa fa-dot-circle-o "></i> <?php echo $listf->brand_name." ".$getproductname->category_name;?> </a></li>
						    <?php
						    }
					        }else{
							echo '<br>';
						echo '<li>No Brands avaliable at this time!.</li>.';
					      }
                                         }?>
                                     </ul>
                </li>
               
              </ul>

            </div>



          <div class="col-md-9">
            
          
<!--<div id="carousel-example-generic" class="carousel slide store-slide" data-ride="carousel">

  <ol class="carousel-indicators red-bullet">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>


  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/slider21.jpg" class="img-responsive center-block ">
    
    </div>
    <div class="item">
      <img src="img/slider5.jpg" class="img-responsive center-block ">
    
    </div>
    <div class="item">
      <img src="img/slider6.jpg" class="img-responsive center-block ">
    
    </div>
  </div>


</div>-->

          
                       <div class="">


           <div class="img-boxes isotope-container">
              
              <div class="">
              <?php
			if(isset($product_categorydetails))
			{	
		
				$kat=0;
				foreach($product_categorydetails as $category)
				{
						if($category->category_image!='')
						{
							$img_url1 =base_url().'uploads/product_category/'.$category->category_image;
						}
						else{
							$img_url1 =base_url().'front/img/rsz_default.jpg';
						}
								
						?>
                
              <h3 class="text-center text-uppercase"><?php echo $category->category_name;?></h3>
              <div class="bor bg-red"></div>
              
              <?php
				$nextevel_category =$this->front_model->get_nextlevel_category($category->cate_id);
				if($nextevel_category)
				{
					$kot=0;
					foreach($nextevel_category as $nxtlvlcate)	
					{
							if($nxtlvlcate->category_image!='')
							{
								$img_url =base_url().'uploads/product_category/'.$nxtlvlcate->category_image;
							}
							else{
								$img_url =base_url().'front/img/rsz_default.jpg';
							}
					?>

                <div class="col-md-3 col-xs-12 isotope-item A search-item ">
                  <div class="search-bg searchcate clearfix">
                  
                  <div class="product-block">
                           
                            <div class="image ">
                              <div class="product-img img">
                                <a href="<?php echo base_url();?>products/<?php echo $nxtlvlcate->category_url;?>#category=<?php echo $nxtlvlcate->category_url;?>" class="product-image img" title="<?php echo $nxtlvlcate->category_name;?>"><img style="height:49px;width:83px;" src="<?php echo $img_url;?>" class="img-responsive center-block"></a>                           
                              </div>
                            </div>
                            <div class="product-meta product-shop">
                        <h4 class="mar-top"> <a href="<?php echo base_url();?>products/<?php echo $nxtlvlcate->category_url;?>#category=<?php echo $nxtlvlcate->category_url;?>">  <?php echo $nxtlvlcate->category_name;?></a>  </h4>
                            </div>
                          </div>
                  
                  </div>
                </div>
                
                
                <?php							
				
				$kot++;
				}
				if($kot%4!=0)
				{?>
                <div class="clearfix"></div>
                <?php					
				}
			}			
				else
				{
					?>
					<div class="col-md-3 col-xs-12 isotope-item A search-item ">
					  <div class="search-bg clearfix">                  
					  <div class="product-block">                           
								<div class="image ">
								  <div class="product-img img">
									<a href="<?php echo base_url();?>products/<?php echo $category->category_url;?>#category=<?php echo $category->category_url;?>" class="product-image img" title="All <?php echo $category->category_name;?>"><img style="height:49px;width:83px;" src="<?php echo $img_url1;?>" class="img-responsive center-block"></a>                           
								  </div>
								</div>
								<div class="product-meta product-shop">
							<h4 class="mar-top"> <a href="<?php echo base_url();?>products/<?php echo $category->category_url;?>#category=<?php echo $category->category_url;?>"> All <?php echo $category->category_name;?></a> </h4>
								</div>
							  </div>
					 </div>
					</div>
				 <?php
					
					$getbrands =$this->front_model->get_brands($category->category_brands,7);
					if($getbrands)
					{
						
						foreach($getbrands as $brands)
						{
							if($brands->brand_image!='')
							{
								$brans_img =base_url().'uploads/brands/'.$brands->brand_image;
							}
							else{
								$brans_img =base_url().'front/img/rsz_default.jpg';
							}
							
				?>
				
				<div class="col-md-3 col-xs-12 isotope-item A search-item ">
					  <div class="search-bg clearfix">                  
					  <div class="product-block">                           
								<div class="image ">
								  <div class="product-img img">
									<a href="<?php echo base_url();?>products/<?php echo $brands->brand_url;?>_brands/<?php echo $category->category_url.'_1'; ?>#brands=<?php echo $brands->brand_url;?>#<?php echo $category->category_url.'_1'; ?>" class="product-image img" title="<?php echo $brands->brand_name;?>"><img style="height:49px;width:83px;" src="<?php echo $brans_img;?>" class="img-responsive center-block"></a>                           
								  </div>
								</div>
								<div class="product-meta product-shop">
							<h4 class="mar-top"><a href="<?php echo base_url();?>products/<?php echo $brands->brand_url;?>_brands/<?php echo $category->category_url.'_1'; ?>#brands=<?php echo $brands->brand_url;?>#<?php echo $category->category_url.'_1'; ?>" class="product-image img"> <?php echo $brands->brand_name;?></a></h4>
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
                      <div class="clearfix"></div>
						 <?php
					}
				?>
				   
					<?php
				}
			
		
				$kat++;
				}
			
	}
			?>
         
                </div>
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
     
<!--<script src="<?php echo base_url();?>front/js/bx-slider.js"></script>-->

</body>
</html>