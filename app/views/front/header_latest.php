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
$unique_visits = $this->front_model->unique_visits($ip); 
$user_id = $this->session->userdata('user_id');
$udetails= $this->front_model->get_uname();
if($site_mode==0){redirect('cashback/under_maintance','refresh');}

$google_analytics = $getadmindetails[0]->google_analytics;
?>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<style>
.table-responsive
{
	overflow-x:hidden !important;
}
</style>
<?php
if($user_id!='')
{?>
<style>
.top-list li {
    padding: 0 0px !important;
}
</style>
<?php } ?>
 
                  
                  
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()."uploads/adminpro/".$site_favicon;?>">
<header>
<div class="cls_offser"><a class="" target="_blank" href="http://achadiscount.in"><img alt="offline store" src="<?php echo base_url()."front/img/";?>special-offer-img2.png"></a>  </div>
<div class="header-container">
  <div class="header">
    <div class="container">
      <div class="container-inner">
        <div class="row">
          <div class=" top-logo col-xs-12 col-md-4 col-lg-3">
            <h1 class="logo"><a href="<?php echo base_url();?>" class="logo"><img src="<?php echo base_url()."uploads/adminpro/".$logo;?>" alt="logo" /></a></h1>
          </div>
          <div class="col-xs-12 col-md-7 col-lg-9">
		  <div class="row">
		  <div class="col-md-6 col-sm-6 col-xs-12">
		   <form id="search_mini_form" action="" method="get">
		   <div class="form-search">
                <label for="search_category">Search:</label>
                <div class="box-search-select">
                  <!--<select class="selectpicker"  id="cat" name="cat">
                    <option value="">All Categories</option>
                    <option value="240">Electtronic</option>
                    <option value="241">Fashion</option>
                    <option value="242">Kitchenware</option>
                    <option value="243">Tools</option>
                    <option value="244">Wine</option>
                    <option value="447">versace</option>
                    <option value="448">Apple</option>
                    <option value="449">Lenovo</option>
                    <option value="450">Hennessy</option>
                    <option value="451">Johnnie Walker</option>
                    <option value="452">Lock and Lock</option>
                  </select>-->
<!--                  <input id="search_category" type="text" name="q" class="input-text" />-->
                  <input id="search" type="text" name="store" class="input-text search_header" value="<?php  if(isset($_POST['storehead'])){echo $storehead;}?>" placeholder="Search ..." />
                  <input id="catsearch" type="hidden" name="cat" />
                  
                  <button type="submit" id="headersearch" title="Search" class="button"><span><span><i class="fa fa-search ">&nbsp;</i>Search</span></span></button>
                
				  <div id="search_autocomplete" class="search-autocomplete"></div>
                  
                  
                  <!--<div id="search_autocomplete" class="search-autocomplete"></div>--> 
                </div>
              </div>
            </form>
		  
		  </div>
		  <div class="col-md-6 col-sm-6 col-xs-12">
		   <div class="header-wrapper clearfix">
		    <div class="top-cart-wrapper">
                <div class="top-cart-contain"> 
                  <script type="text/javascript">
    $jq(document).ready(function(){
         var enable_module = $jq('#enable_module').val();
         if(enable_module==0) return false;
    })

</script>		<?php
				if($user_id!='')
				{?>
                  	<div id ="mini_cart_block" >
                    	<ul class="list-inline clearfix top-list">
                        <li> <a href="#">  <?php echo ucfirst($udetails->first_name); ?></a></li> <li>|</li>
                      	<li> <a href="<?php echo base_url(); ?>cashback/my_earnings"> <i class="fa fa-user"> My Account</i></a></li> <li> | </li> <li> <a href="<?php echo base_url(); ?>cashback/favorites"> <i class="fa fa-heart"> Wishlist</i></a></li>
						<li> | </li> 
                      	<li> <a href="<?php echo base_url(); ?>cashback/logout"> <i class="fa fa-sign-out"> Logout</i></a> </li>
                    	</ul>
                  	</div>
                  <?php
				}
				else
				{
					?>
                    <div id ="mini_cart_block" >
                    	<ul class="list-inline clearfix top-list">
                      	<li> <a href="javascript:void(0)"><i class="fa fa-sign-in" data-toggle="modal" data-target="#myModal11"> Login</i></a></li> <li> | </li>
                      	<li> <a href="<?php echo base_url(); ?>cashback/register"> <i class="fa fa-sign-out"> Register</i></a> </li>
                    	</ul>
                  	</div>
                    <?php
				}
				  ?>
                  
                  
                </div>
              </div>
            </div>
		  
		  </div>
		  </div>
            
              
            
            
            
<script type="text/javascript">
    jQuery('.selectpicker').selectpicker({
        'selectedText': 'cat'
    });
</script><script type="text/javascript">
//<![CDATA[
    var searchForm = new Varien.searchForm('search_mini_form', 'search', 'Search entire store here...');
//]]>
</script>
           
             
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
    
  <div class="top-menu">
    <div class="container">
      <div class="container-inner">
        <div class="row">
          <div class="col-xs-12 col-md-3 col-sm-12 mega-menu">
          
          <?php
		  if (isset($pagename)&& $pagename=='index') {
   
		  ?>
         	<div class="categories-inner visible-lg visible-md">
              <div class="title-categories">
                <h2> <i class="fa fa-bars"> </i> Categories</h2>
              </div>
              <div class="navleft-container">
                <div id="pt_vmegamenu" class="pt_vmegamenu"> 
                  <?php
		   }else {
			   ?>
			   <div class="categories-inner visible-lg visible-md vmagicmenu clearfix">
              <div class="title-categories block-title block-title-vmagicmenu">
                <h2> <i class="fa fa-bars"> </i> Categories</h2>         
                  </div>
                <div class="block-vmagicmenu-content">
                <div class="navleft-container">
                <div id="pt_vmegamenu" class="pt_vmegamenu">
                 <?php
            }
		  ?>
                 <div class="category-vmega_toggle">
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
                            <div id="pt_menu240" class="pt_menu <?php if($ksss==1){echo "first";}?>" >
                              <div class="parentMenu"> <a href="<?php echo base_url();?>cashback/category/<?php echo $catedetails->category_url;?>"> <span class="icon-span"> <img  src="<?php echo base_url();?>uploads/product_category/<?php echo $catedetails->category_icon;?>" class="img-responsive" alt="<?php echo $catedetails->category_name;?>"> </span> <span><?php echo $catedetails->category_name;?></span> </a> </div>
                              <div class="wrap-popup">
                                <div id="popup240" class="popup" >
                                  <div class="arrow-left-menu" id="arrow-left-menu240"> </div>
                                  <div class="box-popup">
                                    <div class="block1">
                                    <?php
									$productsubcategories = $this->front_model->get_productsubcategories($catedetails->cate_id,4);
									if($productsubcategories)
									{
										$an = 1;
										foreach($productsubcategories as $subcate)
										{
											
											
											?>
                                            <?php 
											if($an%2!=0)
											{
											?>
                                           	<div class="column <?php if($an==1){echo "first";}?> col1" style="float:left;">
                                             <?php
											}
											?>
                                                <div class="itemMenu level1">
                                                
                                                <?php 
												if($an%2!=0)
												{
												?>
                                                  <a class="itemMenuName level1" href="<?php echo base_url()?>cashback/products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"><span><?php echo $subcate->category_name;?></span></a>
                                                  <div class="itemSubMenu level1">
                                                    <div class="itemMenu level2">
                                                    <?php
                                                    $productsubsubcategories = $this->front_model->get_productsubcategories($subcate->cate_id,4);
													
                                                    if($productsubsubcategories)
                                                    { 
														foreach($productsubsubcategories as $subsubcate)
														{
															?>
															<a class="itemMenuName level2" href="<?php echo base_url()?>cashback/products/<?php echo $subsubcate->category_url;?>#category=<?php echo $subsubcate->category_url;?>"><span><?php echo $subsubcate->category_name;?></span></a>
															<?php
														}
														$productsubsubcategories = '';
													}
													else
													{
														?>
                                                        <a class="itemMenuName level2" href="<?php echo base_url()?>cashback/products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"><span>All <?php echo $subcate->category_name;?> </span></a>
                                                        <?php
													}
													?>
                                                    <!--<a class="itemMenuName level2" href="#"><span>HP&nbsp;Laptops</span></a><a class="itemMenuName level2" href="#"><span>Lenovo&nbsp;Laptops</span></a><a class="itemMenuName level2" href="#"><span>Apple&nbsp;Laptops</span></a>--></div>
                                                  </div>
                                                 <?php
												}
												else
												{
												 ?>                                                  
                                                  <a class="itemMenuName level1" href="<?php echo base_url()?>cashback/products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"><span><?php echo $subcate->category_name;?></span></a>
                                                  <div class="itemSubMenu level1">
                                                    <div class="itemMenu level2">
                                                     <?php
                                                    $productsubsubcategories = $this->front_model->get_productsubcategories($subcate->cate_id,4);
													
                                                    if($productsubsubcategories)
                                                    { 
														foreach($productsubsubcategories as $subsubcate)
														{
															?>
															<a class="itemMenuName level2" href="<?php echo base_url()?>cashback/products/<?php echo $subsubcate->category_url;?>#category=<?php echo $subsubcate->category_url;?>"><span><?php echo $subsubcate->category_name;?></span></a>
															<?php
														}
														$productsubsubcategories ='';
													}
													else
													{
														?>
                                                        <a class="itemMenuName level2" href="<?php echo base_url()?>cashback/products/<?php echo $subcate->category_url;?>#category=<?php echo $subcate->category_url;?>"><span>All <?php echo $subcate->category_name;?> </span></a>
                                                        <?php
													}
													?>
                                                    </div>
                                                    
                                                  </div>
                                                 <?php
												}
												 ?>
                                                </div>
                                                
                                             
                                            <?php
											if($an%2==0)
											{
												echo " </div>";
											}
											$an++;
											
										}
										
									}
									
									?>                                      
                             
                                      <div class="clearBoth"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
							<?php			
									}
								$ksss++;
								}
							}
							?>
                    <div class="clearBoth"></div>
                  </div>
                </div>
                
                
                </div>
              </div>
             </div>  
            <?php
		if (!isset($pagename)&& $pagename!='index') {	
		  ?>                 
        		 </div>
           <?php
            }
		  ?>
         
            
          
          
          <div class="col-xs-12 col-md-9 col-sm-12 custom-menu">
            <div class="ma-nav-mobile-container visible-xs">
              <div class="navbar">
                <div id="navbar-inner" class="navbar-inner navbar-inactive">
                  <div class="menu-mobile"> <a class="btn btn-navbar navbar-toggle"> <span class="icon-bar">&nbsp;</span> <span class="icon-bar">&nbsp;</span> <span class="icon-bar">&nbsp;</span> </a> <span class="brand navbar-brand">Categories</span> </div>
                  <ul id="ma-mobilemenu" class="mobilemenu nav-collapse collapse">
             	 <?php
				  
                  $get_productcate_mobile =$this->front_model->get_productcategories(8);
							if($get_productcate_mobile)	
							{	
								$ksss_mobile=1;
								foreach($get_productcate_mobile as $catedetailsmobie)
								{
									if($catedetailsmobie->category_name)
									{
                                  ?>  
                 					 <li class="level0 nav-6 level-top"> <a href="<?php echo base_url();?>cashback/category/<?php echo $catedetailsmenu->category_url;?>" class="level-top"> <span><?php echo $catedetailsmobie->category_name;?></span> </a> </li>
                  					<?php
									}
									$ksss_mobile++;
								}								
							}
						?>                        
                  </ul>
                </div>
              </div>
            </div>
            <div class="nav-container visible-lg visible-md">
              <div id="pt_custommenu" class="pt_custommenu">
                <div class="pt_custommenu_content">
                  <div id="pt_menu_link" class="pt_menu">
                    <div class="parentMenu">
                      <ul>
                      <?php
							$get_productcateslist =$this->front_model->get_productcategories(9);
							if($get_productcate)	
							{	
								$spdetails=1;
								foreach($get_productcateslist as $catedetailsmenu)
								{
									if($catedetailsmenu->category_name)
									{
									?>                            
                     			 	<li><a href="<?php echo base_url();?>cashback/category/<?php echo $catedetailsmenu->category_url;?>"><?php echo $catedetailsmenu->category_name;?> </a></li>
                     			 	<?php			
									}
								$spdetails++;
								}
							}
							?>
                            
                      
                      </ul>
                    </div>
                  </div>
                  <div class="clearBoth"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</header>


