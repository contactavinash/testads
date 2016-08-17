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
$lat=$this->session->userdata('latitude');
		 $lng=$this->session->userdata('langitude');
if($site_mode==0){redirect('under_maintance','refresh');}

$google_analytics = $getadmindetails[0]->google_analytics;
?>

<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets_new/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets_new/fonts/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets_new/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets_new/css/owl.carousel.css" rel="stylesheet">
<style>
.search{
  border: none;
  background: none;
}
.cls_red_box {
background: #f4f4f4 none repeat scroll 0 0;
border: 1px solid #ff4848;
margin-bottom: 10px;
padding: 50px 25px;
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
            <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url()."uploads/adminpro/".$logo;?>" class="img-responsive" alt=""> </a>
          </div>
        </div>
        <div class="col-sm-5 col-md-5">
          <div class="search_top">
            <form>
              <div class="input-group">
                <div class="input-group-addon inr_cat"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" id='get_cate_id'>Categories <span class="caret"></span></a>
                  <div class="dropdown-menu" style="width="200px;">
                    <ul class="list-unstyled" >
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
                      <li><a href="javascript:void(0);" onclick="get_cate_id('<?php echo $catedetails->category_name;?>')"><?php echo $catedetails->category_name;?></a></li>
                      <?php     
                  }
                $ksss++;
                }
              }
              ?>
                      
                    </ul>
                  </div>
                </div>

                  <input type="text" placeholder="Search" class="form-control input-text" id="search_header1" value="<?php  if(isset($_POST['storehead'])){echo $storehead;}?>">

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
        <div class="col-md-4 col-sm-4">
		
		<div role="group" class="btn-group"> 
		<button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-org dropdown-toggle" type="button" id="btnGroupVerticalDrop1"><?php echo $udetails->first_name; ?> <span class="caret"></span> 
		</button> 
		<ul aria-labelledby="btnGroupVerticalDrop1" class="dropdown-menu"> 
		<li><a href="<?php echo base_url(); ?>myaccount">My account</a></li>
		<li><a href="<?php echo base_url(); ?>favorites">Wish list</a></li>
<li><a href="<?php echo base_url(); ?>logout">Logout</a></li>		
		</ul> 
		</div>
          <!--<div class="clslogin">
            <ul class="list-inline">
               <li><a href="<?php echo base_url(); ?>cashback/my_earnings"> <img src="<?php  echo base_url(); ?>assets_new/images/user_icon.png" alt=""> My Account</a></li>
              <li> | </li>
              <li> <a href="<?php echo base_url(); ?>cashback/favorites"> <i class="fa fa-heart"> Wishlist</i></a></li>
              <li> | </li>
<li> <a href="<?php echo base_url(); ?>cashback/logout"> <i class="fa fa-sign-out"> Logout</i></a> </li>
            </ul>
          </div>
        </div>-->

         <?php } 
          
         else{ ?>

             <div class="col-md-3 col-sm-4">
          <div class="clslogin">
            <ul class="list-inline">
				<!--  <li> 
                          <a href="javascript:void(0)"><i class="fa fa-sign-in" data-toggle="modal" data-target="#myModal12">Offline  Login</i></a></li> -->
                      	<li> 
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
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        
         
        <div class="col-md-4 col-sm-4  more_off_coupon" custom="offline">
         
          <div class="cls_red_bg_menu"> <a href="http://offline.achadiscount.in/#/listings/-1/<?php echo $lat;?>/<?php echo $lng;?>"  target="_blank">  <i class="fa fa-ticket"></i><b> Offline Discounts Sale Around You</b></a> </div>
          
          <div id="offline" class="hiddenf_more flyout_more col-md-8">
         
         
          
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
                
                            
                             <li class="dropdown">

                                <a href="http://offline.achadiscount.in/#/listings/-1/<?php echo $lat;?>/<?php echo $lng;?>" target="_blank">  Active Sales </a>
                            </li>
							<li class="dropdown">

                                <a href="http://offline.achadiscount.in/#/upcommingsales/-1"  target="_blank">  Upcoming Sales  </a>
                            </li>
							<li class="dropdown">

                                <a href="http://offline.achadiscount.in/#/expiredsales"  target="_blank">  Expired Sales   </a>
                            </li>
							<li class="dropdown">

                                <a href="http://offline.achadiscount.in/#/brandslisting"  target="_blank">  Brands   </a>
                            </li>
                            
                           
                           
                            
                        </ul><!-- end nav navbar-nav -->
                    </div><!--/.nav-collapse -->
                </div><!-- end navbar navbar-default clearfix -->
            </div><!-- end menu 1 -->  
        </div>
         
        
          </div>
  
        </div>
		
		<div class="col-md-4 col-sm-4 more_online" custom='online'>
        <div  id="menu_inner" class="cls_red_bg_menu">  <a href="<?php echo base_url(); ?>products/mobile-phones#category=mobile-phones"><i class="fa fa-reorder"></i><b>Online/Offline Price Comparison With Cashback</b></a>  </div>
        <div class="flyout hiddenf cls_inner_cate col-md-10" id="online">
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
                  $productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,10);
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

                                <a href="<?php echo base_url();?>category/<?php echo $catedetails->category_url;?>" data-toggle="dropdown" class="dropdown-toggle"> <span> <img src="<?php echo base_url();?>uploads/product_category/<?php echo $catedetails->category_icon;?>" alt="" style="height:25px;width:25px;"> </span> <?php echo $catedetails->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                <ul class="dropdown-menu vertical-dropdown-menu" role="menu">
                                 <?php
                  $productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,10);
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
		
        <div class="col-md-4 col-sm-4 more_off_coupon" custom="coupon">
                   <div class="cls_red_bg_menu"> <a href="<?php echo base_url(); ?>coupons" style="color:#FFF;"> <i class="fa fa-ticket"></i><b>Coupon Discounts</b> </a> </div>  

          
          <div id="coupon" class="hiddenf_more flyout_more">
          
          <div class="hero">
            <div id="vertical" class="hovermenu ttmenu dark-style menu-red-gradient col-md-8 col-sm-10">
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
				
					
              ?>
                                                 
                             <li class="dropdown">

                                <a href="<?php echo base_url(); ?>coupons/<?php echo $view->category_url; ?>"  ><?php echo $view->category_name;?>   <b class="" style="float: right;"><i class="fa fa-angle-right"></i></b></a>

                                

                            </li>
                            
                            <?php    
											
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
 </div>


<script>
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