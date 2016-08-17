<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo $admindetails[0]->homepage_title;?></title>
<?php
$ip_address = $_SERVER['REMOTE_ADDR'];
$getadmindetails = $this->front_model->getadmindetails(); 
$logo = $getadmindetails[0]->site_logo;
$site_name = $getadmindetails[0]->site_name;
$blog_url = $getadmindetails[0]->blog_url;
$site_mode = $getadmindetails[0]->site_mode;
$background_image = $getadmindetails[0]->background_image;
$site_favicon = $getadmindetails[0]->site_favicon;
$ip = $_SERVER['REMOTE_ADDR'];
$udetails= $this->front_model->get_uname();
$unique_visits = $this->front_model->unique_visits($ip); 
$user_id = $this->session->userdata('user_id');
$offline_userid = $this->session->userdata('offline_user_id');
if($site_mode==0){redirect('under_maintance','refresh');}

$google_analytics = $getadmindetails[0]->google_analytics;

?>

<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets_new/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets_new/fonts/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets_new/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets_new/css/owl.carousel.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<style>
.search{
  border: none;
  background: none;
}
.cls_red_box {
background: #f4f4f4 none repeat scroll 0 0;
border: 1px solid #ff4848;
margin-bottom: 10px;
padding: 18px 25px;
}
.cls_red_box h3
{
	font-size:13px;
}
</style>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="cls_head_main">
      <div class="row">
      <div class="col-md-3 col-sm-3">
          <div class="logo">
            <a href="#">
            <img src="<?php echo base_url()."uploads/adminpro/".$logo;?>" class="img-responsive" alt=""> </a>
          </div>
        </div>
        <div class="col-sm-5 col-md-5">
          <div class="search_top">
            <form>
              <div class="input-group">
                <div class="input-group-addon inr_cat"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Categories <span class="caret"></span></a>
                  <div class="dropdown-menu">
                    <ul class="list-unstyled">
                       <?php
              $get_productcate =$this->front_model->get_productcategories(10);
              if($get_productcate)  
              { 
                $ksss=1;
                foreach($get_productcate as $catedetails)
                {
                  if($catedetails->category_name)
                  {
              ?>
                      <li><a href="<?php echo base_url();?>category/<?php echo $catedetails->category_url;?>"><?php echo $catedetails->category_name;?></a></li>
                      <?php     
                  }
                $ksss++;
                }
              }
              ?>
                      
                    </ul>
                  </div>
                </div>

                  <input type="text" id="search_header1" style="border:none;outline:none;morgin-top:5px" >

                   <input id="catsearch" type="hidden" name="cat" />

                <div class="input-group-addon inr-btn"> 
                  <button type="submit" class="search" id="headersearch" title="Search" >
                  <i class="fa fa-search"></i> 
                </button>
                </div>

              </div>
            </form>
          </div>
        </div>

         <?php if($user_id!=''){ ?>
		 <div role="group" class="btn-group"> 
		<button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-org dropdown-toggle" type="button" id="btnGroupVerticalDrop1"><?php echo $udetails->first_name; ?> <span class="caret"></span> 
		</button> 
		<ul aria-labelledby="btnGroupVerticalDrop1" class="dropdown-menu"> 
		<li><a href="<?php echo base_url(); ?>myaccount">My account</a></li>
		<li><a href="<?php echo base_url(); ?>favorites">Wish list</a></li>
<li><a href="<?php echo base_url(); ?>logout">Logout</a></li>		
		</ul> 
		</div>
        <!--<div class="col-md-4 col-sm-4">
          <div class="clslogin">
            <ul class="list-inline">
               <li><a href="<?php echo base_url(); ?>cashback/myaccount"> <img src="<?php  echo base_url(); ?>assets_new/images/user_icon.png" alt=""> My Account</a></li>
              <li> | </li>
              <li> <a href="<?php echo base_url(); ?>cashback/favorites"> <i class="fa fa-heart"> Wishlist</i></a></li>
              <li> | </li>
<li> <a href="<?php echo base_url(); ?>cashback/logout"> <i class="fa fa-sign-out"> Logout</i></a> </li>
            </ul>
          </div>
        </div>-->
         <?php 
	 }
	 else if($offline_userid!=''){
          $offline_userdet = $this->front_model->offline_userdet($offline_userid); 
         ?>
          <div class="col-md-3 col-sm-4">
          <div class="clslogin">
            <ul class="list-inline">
              <li>
                <a href="javascript:;"> 
                  <img src="<?php  echo base_url(); ?>assets_new/images/user_icon.png" alt=""><?php echo $offline_userdet->user_name; ?></a>
              </li>
              
            </ul>
          </div>
        </div>

         <?php }
			 else{ ?>

             <div class="col-md-3 col-sm-4">
          <div class="clslogin">
            <ul class="list-inline">
				  <li>
                 <a href="javascript:void(0)"><i class="fa fa-sign-in" data-toggle="modal" data-target="#myModal12">Offline Login</i></a></li>
              <li> <a href="#"> | </a></li>
              <li>
                 <a href="javascript:void(0)"><i class="fa fa-sign-in" data-toggle="modal" data-target="#myModal11"> Login</i></a></li>
              <li> <a href="#"> | </a></li>
              <li><a href="<?php echo base_url(); ?>register"> <i class="fa fa-sign-out"> Register</i></a> </li>
            </ul>
          </div>
        </div>

         <?php } ?>

      </div>
    </div>
  </div>
  <div class="cls_litting_bg">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-5">
        <div id="menu_inner" class="cls_new_head"> <i class="fa fa-reorder"></i><span class="mar-lft"> <a href="<?php echo base_url(); ?>product_index" style="color:#FFF;">Online/Offline Price Comparison</a></span>  </div>
        <div class="flyout hiddenf cls_inner_cate col-md-8">
    	 <div class="hero">
            <div id="vertical" class="hovermenu ttmenu dark-style menu-red-gradient">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div><!-- end navbar-header -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <?php
              $get_productcate =$this->front_model->get_productcategories(10);
              if($get_productcate)  
              { 
                $ksss=1;
                foreach($get_productcate as $catedetails)
                {
                  if($catedetails->category_name)
                  {
              ?>
                           <!-- <li class="dropdown ttmenu-full"><a href="<?php echo base_url();?>cashback/category/<?php echo $catedetails->category_url;?>" data-toggle="dropdown" class="dropdown-toggle"> <span> <img src="<?php echo base_url();?>uploads/product_category/<?php echo $catedetails->category_icon;?>" alt=""> </span> <?php echo $catedetails->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                <ul class="dropdown-menu vertical-menu">
                                    <li>
                                    <div class="ttmenu-content">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="box">
                                                    <ul>
                                                      <?php
                  $productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,4);
                  if($productsubcategories)
                  {
                    $an = 1;
                    foreach($productsubcategories as $subcate)
                    { 
                      ?>                   

                      <li><a href="<?php echo base_url()?>cashback/products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"> <i class="fa fa-angle-right"></i> <?php echo $subcate->category_name;?></a></li>
                      <?php  
                       $an++;
                    }
                  } ?>

                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li> -->
                            
                            <li class="dropdown">

                                <a href="<?php echo base_url();?>category/<?php echo $catedetails->category_url;?>" data-toggle="dropdown" class="dropdown-toggle"> <span> <img src="<?php echo base_url();?>uploads/product_category/<?php echo $catedetails->category_icon;?>" alt=""> </span> <?php echo $catedetails->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                <ul class="dropdown-menu vertical-dropdown-menu" role="menu">
                                 <?php
                  $productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,4);
                  if($productsubcategories)
                  {
                    $an = 1;
                    foreach($productsubcategories as $subcate)
                    { 
                      ?>         <li class="dropdown-submenu">

                                        <a href="<?php echo base_url()?>products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"> <i class="fa fa-angle-right"></i> <?php echo $subcate->category_name;?></a>

                                        <!-- <ul class="dropdown-menu">

                                            <li class="dropdown-submenu">

                                                <a href="#">Even More.. <span class="dropme-left"></span></a>

                                                <ul class="dropdown-menu">

                                                    <li><a href="#">3rd level</a></li>

                                                    <li><a href="#">3rd level</a></li>

                                                </ul>

                                            </li>
                                           
                                        </ul> -->

                                    </li>
                                    <?php }} ?>

                                    

                                </ul>

                            </li>
                            
                            <?php     
                  }
                $ksss++;
                }
              }
              ?>
                           
                            
                        </ul><!-- end nav navbar-nav -->
                    </div><!--/.nav-collapse -->
                </div><!-- end navbar navbar-default clearfix -->
            </div><!-- end menu 1 -->  
        </div>
          </div>
        </div>
         
        <div class="col-md-4 col-sm-5 more_off_coupon" custom="offline">
         
          <div class="cls_new_head"> <i class="fa fa-ticket"></i><span class="mar-lft"><a href="http://achadiscount.in" style="color:#FFF;" target="_blank"> More Offline Discounts Sale Around You</a></span>  </div> 
          
          <div id="offline" class="hiddenf_more flyout_more ">
         
         
          
              <div class="hero">
            <div id="vertical" class="hovermenu ttmenu dark-style menu-red-gradient">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div><!-- end navbar-header -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <?php
              $get_productcate =$this->front_model->get_productcategories(4);
              if($get_productcate)  
              { 
                $ksss=1;
                foreach($get_productcate as $catedetails)
                {
                  if($catedetails->category_name)
                  {
              ?>
                      <!--  <li class="dropdown ttmenu-full"><a href="<?php echo base_url();?>cashback/category/<?php echo $catedetails->category_url;?>" data-toggle="dropdown" class="dropdown-toggle"> <span> <img src="<?php echo base_url();?>uploads/product_category/<?php echo $catedetails->category_icon;?>" alt=""> </span> <?php echo $catedetails->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                <ul class="dropdown-menu vertical-menu">
                                    <li>
                                    <div class="ttmenu-content">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="box">
                                                    <ul>
                                                      <?php
                  $productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,4);
                  if($productsubcategories)
                  {
                    $an = 1;
                    foreach($productsubcategories as $subcate)
                    { 
                      ?>                   

                      <li><a href="<?php echo base_url()?>cashback/products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"> <i class="fa fa-angle-right"></i> <?php echo $subcate->category_name;?></a></li>
                      <?php  
                       $an++;
                    }
                  } ?>

                                                        
                                                    </ul>
                                                </div> 
                                            </div> 
                                           
                                        </div> 
                                    </div> 
                                    </li>
                                </ul>
                            </li> -->
                            
                             <li class="dropdown">

                                <a href="http://achadiscount.in" data-toggle="dropdown" class="dropdown-toggle"> <span> <img src="<?php echo base_url();?>uploads/product_category/<?php echo $catedetails->category_icon;?>" alt=""> </span> <?php echo $catedetails->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                <ul class="dropdown-menu vertical-dropdown-menu" role="menu">
                                 <?php
                  $productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,4);
                  if($productsubcategories)
                  {
                    $an = 1;
                    foreach($productsubcategories as $subcate)
                    { 
                      ?>         <li class="dropdown-submenu">

                                        <a href="http://achadiscount.in"> <i class="fa fa-angle-right"></i> <?php echo $subcate->category_name;?></a>

                                        <!-- <ul class="dropdown-menu">

                                            <li class="dropdown-submenu">

                                                <a href="#">Even More.. <span class="dropme-left"></span></a>

                                                <ul class="dropdown-menu">

                                                    <li><a href="#">3rd level</a></li>

                                                    <li><a href="#">3rd level</a></li>

                                                </ul>

                                            </li>
                                           
                                        </ul> -->

                                    </li>
                                    <?php }} ?>

                                    

                                </ul>

                            </li>
                            
                            <?php     
                  }
                $ksss++;
                }
              }
              ?>
                           
                            
                        </ul><!-- end nav navbar-nav -->
                    </div><!--/.nav-collapse -->
                </div><!-- end navbar navbar-default clearfix -->
            </div><!-- end menu 1 -->  
        </div>
         
        
          </div>
  
        </div>
        <div class="col-md-3 col-sm-2 more_off_coupon" custom="coupon">
                  <div class="cls_new_head pull-right"> <i class="fa fa-ticket"></i><span class="mar-lft"><a href="<?php echo base_url(); ?>coupons" style="color:#FFF;"> Coupons </a></span>  </div> 

          
          <div id="coupon" class="hiddenf_more flyout_more">
          
          <div class="hero">
            <div id="vertical" class="hovermenu ttmenu dark-style menu-red-gradient">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div><!-- end navbar-header -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                           <?php
               $categories = $this->front_model->get_all_categories(12);
        if($categories)
        {
          $kt1 = 1;
          foreach($categories as $view)
          {
            if($view->category_name)
            {
				if($kt1>=3)
				{
					
              ?>
                                                 
                             <li class="dropdown">

                                <a href="<?php echo base_url(); ?>coupons/<?php echo $view->category_url; ?>"  ><?php echo $view->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                

                            </li>
                            
                            <?php    
				}							
                  }
				  $kt1++;
			}
                }
              
              ?>
                           
                            
                        </ul><!-- end nav navbar-nav -->
                    </div><!--/.nav-collapse -->
                </div><!-- end navbar navbar-default clearfix -->
            </div><!-- end menu 1 -->  
        </div>
          
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class=" col-md-12 ">
        <div class="">
          <div class="marquee">
            <div> <span><a href="#">
              <marquee>
              Compare prices of products both online and offline,select the best and avail cashback,reward points etc..
              Also check for more offline discounts around you and avail additional coupon discount.
              </marquee>
              </a></span> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    
      <div class="col-md-5 col-sm-12">
        <div class="top_banner">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
            <!-- Indicators -->
            <ol class="carousel-indicators">
                 <?php if($result){
           $sk = 0;
        foreach($result as $imgs)
        {
          $view_img = $imgs->banner_image;
          $banner_url = $imgs->banner_url;
          $img_name = $imgs->banner_heading;
        ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $sk; ?>" class="<?php if($sk==0){echo 'active';} ?>">
              </li>
               <?php $sk++;} } ?>
              
            </ol>
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php if($result){
           $sk = 1;
        foreach($result as $imgs)
        {
          $view_img = $imgs->banner_image;
          $banner_url = $imgs->banner_url;
          $img_name = $imgs->banner_heading;
        ?>
              <div class="item <?php if($sk==1){ echo 'active'; }?>"> 
                <img src="<?php echo base_url().'uploads/banners/'.$view_img; ?>" alt="<?php echo $img_name; ?>" title="#<?php echo $img_name; ?>" > 
              </div>

               <?php $sk++;} } ?>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-md-6 col-sm-6 col-xs-6">
            <div> <a href="#">
              <img src="<?php echo base_url(); ?>assets_new/images/ima_banner.png" style="height:160px"  class="img-responsive" alt=""></a></div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-6">
            <div> <a href="#"><img src="<?php echo base_url(); ?>assets_new/images/ima_banner1.png" class="img-responsive" style="height:160px"  alt=""></a></div>
          </div>

        </div>
      </div>
      
       <div class="col-md-7 col-sm-12">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="cls_red_box">
<h3> More offline discounts around you </h3>
<div class="">
<input type="hidden" name="latitude" id="lat" value="">

<input type="hidden" name="langitude" id="lng" value="">

<select class="form-control mar-top20" id="acha_cat">

<?php foreach($acha_cates as $acates){ ?>
<option value="<?php echo $acates->id; ?> "><?php echo $acates->name; ?></option>
<?php } ?>
</select>
<!--<select class="form-control mar-top20">
<option><?php echo $city->long_name; ?></option>
</select>
<select class="form-control mar-top20 mar-btn20">
<option><?php echo $location->long_name;; ?></option>
</select>-->
<input type="text" class="form-control mar-top20" name="city" id="city" value="" onfocus="geolocate()">
<input type="text" class="form-control mar-top20" name="location" id="location" value="" readonly>
</div>
<div class="mar-top">
<input type="button" value="search" onclick="return go_acha();" class="btn btn-org center-block">
</div>
</div> 

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
   <?php
   $br=0;

   foreach($hot_brands as $brands) {?>	
    <div class="item active">
	
     	<div class="cls_gray_box">
		<a href="http://offline.achadiscount.in/#/branddetails/<?php echo $brands->id; ?>"   target="_blank">
              <h4> <?php echo $brands->name; ?> </h4>
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-4">
                  <div><img  style="height:80px; width:125px;" class=" img-responsive" src="http://offline.achadiscount.in/admin/uploads/<?php echo $brands->image; ?>"> </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-8">
                  <p><?php echo substr($brands->description,0,80); ?> </p>
                </div>
              </div>
			  </a>
            </div>
    </div>
		
		<?php $br++;
		if($br==1){break;}} ?>
   <?php foreach($hot_brands as $brands) {
	   if($br>=1){?>	
    <div class="item ">
	
     	<div class="cls_gray_box">
		<a href="http://offline.achadiscount.in/#/branddetails/<?php echo $brands->id; ?>"   target="_blank">
              <h4> <?php echo $brands->name; ?></h4>
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-4">
                  <div><img  style="height:80px; width:125px;" class=" img-responsive" src="http://offline.achadiscount.in/admin/uploads/<?php echo $brands->image; ?>"> </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-8">
                  <p><?php echo substr($brands->description,0,80); ?> </p>
                </div>
              </div>
			  </a>
            </div>
    </div>
		
	   <?php }$br++;} ?>
		
 
  </div>

  
</div>

          
	 
			
            
				
          </div>
          <div class="col-md-6 col-sm-6">
		  <?php
		  $ho=0;

		  foreach($hot_offers as $hot_off) { ?>
            <div class="cls_gray_box">
			<a href="http://offline.achadiscount.in/#/saledetails/<?php echo $hot_off->id; ?>" target="_blank">
              <h4> <?php echo substr($hot_off->offertitle,0,25)."..."; ?> </h4>
              <div class="row">
                <div class="col-md-5 col-sm-4 col-xs-4">
                  <div><img  class="img-responsive" src="http://offline.achadiscount.in/admin/uploads/<?php echo $hot_off->image; ?>"> </div>
                </div>
                <div class="col-md-7 col-sm-8 col-xs-8">
                  <p><?php echo substr($hot_off->description,0,100)."...."; ?> </p>
                </div>
              </div>
			  </a>
            </div>
		  <?php $ho++;
if($ho==3){break;}		  } ?>
          </div>
        </div>
      </div>


    </div>
  <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="cls_best_product">
          <h3>best products <span></span></h3>
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
                      if (@getimagesize($fea_product_img)) {
                      $fea_product_img = base_url().'uploads/products/'.$lasproduct->product_image;
                      }
                      else
                      {
                        $fea_product_img = base_url().'front/images/no_product.png';
                      }
                    }
                    else{
                      $fea_product_img =base_url().'front/images/no_product.png';
                    }
                    
                  //get store name
                  $getstoredetails = $this->front_model->get_store_details_byid($getminpricesim_row->store_id);
                  if($getstoredetails)
                  {
                    if($getstoredetails->affiliate_logo)
                    {
                      $store_img =base_url().'uploads/affiliates/'.$getstoredetails->affiliate_logo;
                      if (@getimagesize($store_img)) {
                      $store_img = base_url().'uploads/affiliates/'.$getstoredetails->affiliate_logo;
                      }
                      else
                      {
                        $store_img = base_url().'front/img/rsz_default.jpg';
                      }
                    }
                    else{
                      $store_img =base_url().'front/img/rsz_default.jpg';
                    }
                    $feastore = $this->front_model->product_store_count($lasproduct->product_id);
                    $offpercent =  ceil((($lasproduct->mrp-$lasproduct->product_price)/$lasproduct->mrp)*100);
                  ?>

            <div class="col-md-2 col-sm-2">
              <div class="cls_pro_bg">
                <div class="image01"> 
                  <div style="height:150px;">
                  <img alt="<?php echo $lasproduct->product_name;?>" src="<?php echo $fea_product_img;?>"  class="center-block">
                </div>
                  <div class="ovrly"></div>
                  <div class="buttons"> 

                    <a class="fa fa-link" href="<?php echo base_url().'visit_product/'.$getminpricesim_row->pp_id.'/'.$getminpricesim_row->product_id;?>" target="_blank"></a> 

                    <a class="fa fa-search" href="<?php echo base_url().'product_details/'.$lasproduct->product_url;?>" target="_blank">
                    </a>

                   </div>
                </div>
                <h3><?php echo substr($lasproduct->product_name,0,28);?></h3>
                <div class="border_bot">
                   <?php
                           $store_rating =$this->front_model->get_storerating($lasproduct->store_id);
                          if($store_rating)
                          {
                             for($i=1;$i<=$store_rating->rate;$i++)
                             {
                              echo '<div class="star fa fa-star mar-bot"></div>';
                             }
                          }
                        ?>
                </div>
                <h5>  <?php echo DEFAULT_CURRENCY." ".number_format(($lasproduct->product_price),2);?> </h5>
                <p><?php echo $feastore['count'];?> stores at </p>
              
                <?php echo DEFAULT_CURRENCY." ".number_format(($lasproduct->product_price),2);?>
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

     <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="cls_best_product">
          <h3 style="margin-bottom:10px !important ">compare prices from</h3>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="owl-carousela carousel_custom_ico mar-top25">

              
          
                   <?php
        $k=0;
        foreach($scrapping_list as $scrapp)
        {
          
            ?>
                <div class="item">
                  <div class="cls_img-pats">
                    <a href="javascript:void(0)">
                    <img src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $scrapp->affiliate_logo;?>" alt="" ></a>
                     </div>
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

 <div class="near_gray_bg">
    <div class="container">
      <div class="row">
        <div class="cls_store_head">
          <h3>check nearby  offline sales <span> around you </span></h3>
          <div class="owl-carousel carousel_custom_ico mar-top25">
		  <?php foreach($normal_offers as $n_off){ ?>
                <div class="item">
                <div class="cls_new_store">
                <div class="horizontal-smallsquare-noborder">
                  <section class="img-rotation">
                    <a href="http://offline.achadiscount.in/#/saledetails/<?php echo $n_off->id; ?>" target="_blank"><img  class=" img-responsive"  src="http://offline.achadiscount.in/admin/uploads/<?php echo $n_off->image; ?>"></a></section>
                </div>
                <div class="clearfix"> </div>
                <h4 class="center-block"><?php echo $n_off->offertitle; ?> </h4>
                <div class="clearfix"> </div>
                <div class="clearfix">
                  <div class="col-md-6 col-sm-6 col-xs-6 pad-no">
                    <a class="btn cls_green_btn btn-block" href="http://achadiscount.in" target="_blank">
                    <img src="<?php echo base_url(); ?>assets_new/images/calender_icon1.png" alt=""> Starts</a>
                    <div class="clearfix"> </div>
                    <div class="text-center mar-top mar-bot"><?php echo date('d-M-Y',strtotime($n_off->startdate)); ?></div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6  pad-no">
                    <a class="btn cls_org_btn  btn-block" href="http://achadiscount.in" target="_blank"> <img src="<?php echo base_url(); ?>assets_new/images/calender_icon2.png" alt=""> Ends</a>
                    <div class="clearfix"> </div>
                    <div class="text-center mar-top mar-bot"><?php echo date('d-M-Y',strtotime($n_off->enddate)); ?></div>
                  </div>
                </div>
              </div>
                </div>
		  <?php } ?>
                
             
                
              <div class="mar-top40">
              <div class="col-md-5 col-md-offset-5 col-xs-10 col-xs-offset-1">
                <button class="btn btn btn-org col-md-6 col-xs-12  btn-org c" type="button"> load more </button>
              </div>
            </div>
                </div>
          
        </div>
        
        <div class="mar-top40">
              <div class="col-md-5 col-md-offset-5 col-xs-10 col-xs-offset-1">
                <button class="btn btn btn-org col-md-6 col-xs-12  btn-org c" type="button"> load more </button>
              </div>
            </div>
      </div>
      
      
      <br>
      <div class="row">
        <div class="cls_store_head">
          <h3>offline store <span> partners </span></h3>
          <div class="col-md-12 col-sm-12">
            <div class="owl-carousela carousel_custom_ico mar-top25">
			<?php foreach($hot_brands as $brands){ ?>
              <div class="item">
                <div class="cls_img-pats"><a href="http://offline.achadiscount.in/#/branddetails/<?php echo $brands->id; ?>" target="_blank"><img  class=" img-responsive" src="http://offline.achadiscount.in/admin/uploads/<?php echo $brands->image; ?>" alt=""></a> </div>
              </div>
			  <?php } ?>
              
            </div>
          </div>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>

 <div class="container">
    <div class="cls_hot_offers">
      <h3>hot coupons &  offers <span> of the day </span> </h3>
         <div class="owl-carousel carousel_custom_ico mar-top25">
         
              
             
             <?php 
			   $kt=1;
          foreach($couponslist as $coupons)
          {
            $coupon_id = $coupons->coupon_id;
            $store_details =$this->front_model->get_Storedetails($coupons->offer_name);
          if($store_details)
          {
            $affiliate_name = $store_details->affiliate_name;
            $affid = $store_details->affiliate_id;
            $setup =  strtoupper($affiliate_name[0]);
            
            if($store_details->affiliate_logo!='')
            {
              $img_url =base_url().'uploads/affiliates/'.$store_details->affiliate_logo;
            }
            else
			{
              $img_url =base_url().'front/img/rsz_default.jpg';
            }
			 ?>
                
                <div class="item">
                <div class="cls_couponbg">
            <div  align="center"><img src="<?php echo $img_url; ?>" style="width:150px;height:100px;"  class="center-block img-responsive" alt="" ></div>
            <p><?php echo substr($coupons->title,0,45);?></p>
            <?php 
			if($coupons->type=='Promotion')
{
			if($user_id!=''){ 
			?>
            <a class="btn cls_green_btn_info center-block mar_top15" href="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" target="_blank"> get this deal</a>
            <?php }else
			{ 
			$url1=base_url().'visit_shop/'.$affid.'/'.$coupon_id; ?>
            <a class="btn cls_green_btn_info center-block mar_top15" data-toggle="modal" data-target="#myModal" onclick="return get_url('<?php echo $url1; ?>');"> get this deal</a>
            <?php }}
			else
			{
			              
			if($user_id!=''){ ?>
            <a class="btn cls_green_btn_info center-block mar_top15" href="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" target="_blank"> Show code</a>
            <?php }else
			{ 
			$url1=base_url().'visit_shop/'.$affid.'/'.$coupon_id; ?>
            <a class="btn cls_green_btn_info center-block mar_top15" data-toggle="modal" data-target="#myModal" onclick="return get_url('<?php echo $url1; ?>');"> Show code</a>
            <?php }
                
			}?>
          </div>
                </div>
                
                <?php } $kt++; } ?>
               
                </div>
      
    </div>


    <div class="clearfix"> </div>
    <div class="mar-top40">
              <div class="col-md-5 col-md-offset-5 col-xs-10 col-xs-offset-1">
               <a href="<?php echo base_url(); ?>coupons">
                <button type="button" class="btn btn btn-org col-md-6 col-xs-12  btn-org c"> load more </button>
               </a>
              </div>
            </div>
    <div class="clearfix"> </div>
    <div class="row">
      <div class="cls_store_head">
        <h3>coupon <span> partner </span></h3>
        <div class="col-md-12 col-sm-12">
          <div class="owl-carousela carousel_custom_ico mar-top25">
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon5.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon4.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon3.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon2.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon1.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon3.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon4.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon3.png" alt=""></a> </div>
            </div>
            <div class="item">
              <div class="cls_img-pat"><a href="http://achadiscount.in" target="_blank"><img src="<?php echo base_url(); ?>assets_new/images/our_icon1.png" alt=""></a> </div>
            </div>
          </div>
        </div>
        <p>&nbsp;</p>
      </div>
    </div>
  </div>

  
  <div class=" cls_popular_bg">
  
  
  <div class="container">
    <div class="cls_popular_brands">
  <h3>popular mobile brands  <span class="cls_small_font"> <a href="<?php echo base_url(); ?>category/mobiles"> View All Mobiles </a> </span></h3>

  <div class="row">

       <?php
     // echo $top_products_home->category_brands;die;
        $get_brands_name = $this->front_model->get_brands($top_products_home->category_brands,6);
       
        foreach($get_brands_name as $brand_name)
        {
          if($brand_name->brand_image!='')
              {
                $brans_img =base_url().'uploads/brands/'.$brand_name->brand_image;
              }
              else{
                $brans_img =base_url().'front/img/rsz_default.jpg';
              }

      ?>
  
  <div class="col-md-2 col-sm-2">
  <div class="cls_brnad_bg center-block" align="center">
       <a href="<?php echo base_url();?>products/<?php echo $brand_name->brand_url;?>_brands#brands=<?php echo $brand_name->brand_url;?>" class=""> 
        <img src="<?php echo $brans_img;?>" class="" alt="<?php echo $brand_name->brand_name;?>" style="width:50px;height:70px;" />
    <!-- <a href="#"><img src="assets/images/footer_logo3.jpg" alt=""> -->
    </a>
  </div>
    <p><?php echo substr($brand_name->brand_name,0,40);?></p>

  </div>

   <?php
            } 
          
        
        ?>
  
  
  </div>
  
  </div>
  
  
  </div>
  
  </div>
  
  <?php

//sub footer
  $this->load->view('front/sub_footer');
  
//Footer
  $this->load->view('front/site_intro');  

?>

<?php $this->load->view('front/js_scripts');?>

</div>

<!-- Include all compiled plugins (below), or include individual files as needed --> 

<!--<script src="<?php echo base_url(); ?>assets_new/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets_new/js/owl.carousel.js"></script> 
<script type="text/javascript">
	var owl = jQuery('.owl-carousela');
	owl.owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:15000,
    autoplayHoverPause:true,
    responsive: {
	0: {
	items:2,
	nav: true
	},
	600: {
	items: 3,
	nav: true
	},
	768: {
	items:4,
	nav: true
	},
	1024: {
	items: 6,
	nav: true,
	loop: true,
	margin:0
	}
	}
	});
</script>

<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>

<script type="text/javascript">
	var owl = jQuery('.owl-carousel');
	owl.owlCarousel({
    loop:true,
    margin:10,
    autoplay:false,
    autoplayTimeout:15000,
    autoplayHoverPause:true,
    responsive: {
	0: {
	items:2,
	nav: true
	},
	600: {
	items: 3,
	nav: true
	},
	768: {
	items:4,
	nav: true
	},
	1024: {
	items: 4,
	nav: true,
	loop: true,
	margin:0
	}
	}
	});
	
	/**
* Project: TT Menu - Vertical Horizontal Bootstrap Mega Menu
* Author: Trending Templates Team
* Author URI: www.trendingtemplates.com
* Dependencies: Bootstrap's mega menu plugin
* A professional Bootstrap mega menu plugin with tons of options.
*/

(function($) {
	$(".hovermenu .dropdown").hover(
		function() { $(this).addClass('open') },
		function() { $(this).removeClass('open') }
	);
  $('.verticalmenu .dropdown').click('show.bs.dropdown', function(e){
    var $dropdown = $(this).find('.dropdown-menu');
      var orig_margin_top = parseInt("1", 10);
      $dropdown.css({'margin-left': (orig_margin_top + 65) + 'px', opacity: 0}).animate({'margin-left': orig_margin_top + 'px', opacity: 1}, 420, function(){
         $(this).css({'margin-left':''});
    });
  });

})(jQuery);

</script>

<script>
$("#menu_inner").hover(function(){
	//alert('mm');
    $('.flyout').removeClass('hiddenf');
},function(){
    //$('.flyout').addClass('hidden');
});

$("#vertical").hover(function(){
	//alert('mm');
    $('.flyout').removeClass('hiddenf');
},function(){
    $('.flyout').addClass('hiddenf');
});
$('.more_off_coupon').hover(function(){
	$('#'+$(this).attr('custom')).removeClass('hiddenf_more');
	},function(){
   $('#'+$(this).attr('custom')).addClass('hiddenf_more');
});

function get_url(url)
{
	//alert(url);
	if(url!="")
	{
		$('#st_url').attr('href',url);
		$('#gt_url').val(url);
	}
	else
	{
		
		/*<?php $redirect_urlset =  base_url(uri_string()); ?>
		$('#st_url').attr('href','<?php echo $redirect_urlset; ?>');*/
		location.reload();
		
	}
	}

</script>



<script>

$(document).ready(function(){

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(showLocation);

    } else { 

        $('#location').html('Geolocation is not supported by this browser.');

    }

});



function showLocation(position) {

	var latitude = position.coords.latitude;

	var longitude = position.coords.longitude;

	$.ajax({

		type:'POST',

		url:'<?php echo base_url(); ?>getgeo',

		data:'latitude='+latitude+'&longitude='+longitude,

		success:function(msg){

            if(msg){
				var obj = $.parseJSON( msg );
				//alert(obj.lat); 

               $('#lat').val(obj.lat);
			   $('#lng').val(obj.lng);
			   $('#city').val(obj.city);
			   $('#location').val(obj.location);

            }else{

                //$("#location").html('Not Available');

            }

		}

	});

}

</script>
<script>
function go_acha()
{
	
	var id=$('#acha_cat').val(); 
	var lat=$('#lat').val();
	var lng=$('#lng').val();
	window.open('http://offline.achadiscount.in/#/listing/'+id+'/'+lat+'/'+lng, '_blank');
	 win.focus();
}
</script><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&libraries=places&callback=initAutocomplete"
        async defer></script> 
<script>
// [END region_geolocation]
var placeSearch, autocomplete;
var componentForm = {
street_number1: 'short_name',
route1: 'long_name',
locality1: 'long_name',
administrative_area_level_11: 'short_name',
country1: 'long_name',
postal_code1: 'short_name'
};

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('city')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);  
   //    autocomplete.addListener('place_changed', fillInAddress,'componentForm'); 
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
  var lattttsss=place.geometry.location;
  //console.log(place);
  
$('#location').val(place.address_components[0].long_name);
$('#city').val(place.address_components[2].long_name);

var geo = String(place.geometry.location);
var geo_re = geo.substring(1, geo.length-1);
 
var latttt = geo_re.split(",");
//var longgggg = geo_re.split(",", 2);

   $("#lat").val(latttt[0]); 
   $("#lng").val($.trim(latttt[1])); 



    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    } 



     // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {  



      var addressType = place.address_components[i].types[0];
         console.log(addressType); 
      if (componentForm[addressType]) { 
        var val = place.address_components[i][componentForm[addressType]];
    alert(val);  

        document.getElementById(addressType).value = val; 
      }
    }
  } 

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.

  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
         // autocomplete.setBounds(circle.getBounds());
      });
    }
  }

</script>


</body>
