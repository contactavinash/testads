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
if($site_mode==0)
{
	redirect('cashback/under_maintance','refresh');
}

echo $google_analytics = $getadmindetails[0]->google_analytics;
?>

 


<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()."uploads/adminpro/".$site_favicon;?>">


<header>
  <div class="header-container header-color color">
    <div class="header_full">
      <div class="header">
        <div class="header-top">
          <div class="container">
            <div class="row">
              <div class="top-right col-md-6 col-md-offset-6 col-sm-6 col-xs-12">
                <div class="header-setting">
                  <div class="settting-switcher">
                    <div class="dropdown-toggle">
                      <div class="text-setting">My Account</div>
                    </div>
                    <div class="dropdown-switcher">
                      <div class="top-links-alo">
                        <div class="header-top-link">
                          <ul class="links">
                            <li class="first" ><a href="#" title="My Account" >My Account</a></li>
                            <li ><a href="#" title="Testimonial" >Testimonial</a></li>
                            <li class=" last" ><a href="#" title="Log In" >Log In</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="support-link"> <a href="#">Services</a> <a href="#">Support</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-content">
          <div class="container">
            <div class="row">
              <div class="content-logo col-xs-12 col-sm-12 col-md-3">
                <div class="header-logo"> <a href="#"  class="logo"><img class="img-responsive" src="img/logo.png"  /></a> </div>
              </div>
              <div class="content-seach col-xs-7 col-sm-8 col-md-7">
                <div class="header-search header-search-box">
                  <form id="search_mini_form" action="" method="get">
                    <div class="form-search clearfix">
                      <div class="form-imput-serach">
                        <input id="search" type="text" name="q" class="input-text" placeholder="Search ..." />
                      </div>
                      <input id="catsearch" type="hidden" name="cat" />
                      <select class="ddslick"  id="cat" name="cat">
                        <option value="">Categories</option>
                        <option value="3">Fashion</option>
                        <option value="5">-Men's</option>
                        <option value="41">-&nbsp;-Skirts</option>
                        <option value="42">-&nbsp;-Jackets</option>
                        <option value="43">-&nbsp;-Tops</option>
                        <option value="44">-&nbsp;-Scarves</option>
                        <option value="45">-&nbsp;-Pants</option>
                        <option value="6">-Women's</option>
                        <option value="46">-&nbsp;-Skirts</option>
                        <option value="47">-&nbsp;-Jackets</option>
                        <option value="48">-&nbsp;-Tops</option>
                        <option value="49">-&nbsp;-Scarves</option>
                        <option value="50">-&nbsp;-Pants</option>
                        <option value="7">-Kids</option>
                        <option value="51">-&nbsp;-Shoes</option>
                        <option value="52">-&nbsp;-Clothing</option>
                        <option value="53">-&nbsp;-Tops</option>
                        <option value="54">-&nbsp;-Scarves</option>
                        <option value="55">-&nbsp;-Accessories</option>
                        <option value="8">-Trending</option>
                        <option value="56">-&nbsp;-Men's Clothing</option>
                        <option value="57">-&nbsp;-Kid's Clothing</option>
                        <option value="58">-&nbsp;-Women's Clothing</option>
                        <option value="59">-&nbsp;-Accessories</option>
                        <option value="4">Sports</option>
                        <option value="13">-Tennis</option>
                        <option value="69">-&nbsp;-Scarves</option>
                        <option value="70">-&nbsp;-Pants</option>
                        <option value="71">-&nbsp;-Skirts</option>
                        <option value="72">-&nbsp;-Jackets</option>
                        <option value="14">-Football</option>
                        <option value="118">-&nbsp;-Coats & Jackets</option>
                        <option value="119">-&nbsp;-Blouses & Shirts</option>
                        <option value="120">-&nbsp;-Tops & Tees</option>
                        <option value="124">-&nbsp;-Intimates</option>
                        <option value="15">-Swimming</option>
                        <option value="73">-&nbsp;-Accessories</option>
                        <option value="74">-&nbsp;-Men's Clothing</option>
                        <option value="75">-&nbsp;-Kid's Clothing</option>
                        <option value="76">-&nbsp;-Women's Clothing</option>
                        <option value="16">-Climbing</option>
                        <option value="121">-&nbsp;-Dresses</option>
                        <option value="122">-&nbsp;-Coats & Jackets</option>
                        <option value="123">-&nbsp;-Blouses & Shirts</option>
                        <option value="60">-Asian</option>
                        <option value="61">-&nbsp;-Vietnamese Pho</option>
                        <option value="62">-&nbsp;-Noodles</option>
                        <option value="63">-&nbsp;-Seafood</option>
                        <option value="64">-Sausages</option>
                        <option value="65">-&nbsp;-Meat Dishes</option>
                        <option value="66">-&nbsp;-Desserts</option>
                        <option value="67">-&nbsp;-Tops</option>
                        <option value="9">Electronics</option>
                        <option value="17">-Television</option>
                        <option value="18">-Air Conditional</option>
                        <option value="19">-ARM</option>
                        <option value="20">-Theater</option>
                        <option value="21">-Chicken</option>
                        <option value="23">-&nbsp;-Italian Pizza</option>
                        <option value="24">-&nbsp;-French Cakes</option>
                        <option value="22">-Sandwich</option>
                        <option value="25">-&nbsp;-Salad</option>
                        <option value="26">-&nbsp;-Paste</option>
                        <option value="10">Digital</option>
                        <option value="31">-Accessories</option>
                        <option value="27">-&nbsp;-Mobile</option>
                        <option value="28">-&nbsp;-Tablets</option>
                        <option value="30">-&nbsp;-Memory Cards</option>
                        <option value="129">-Swimming</option>
                        <option value="130">-Computers & Networking</option>
                        <option value="131">-Flashlights & Lamps</option>
                        <option value="11">Furniture </option>
                        <option value="35">-Accessories</option>
                        <option value="32">-&nbsp;-Television</option>
                        <option value="33">-&nbsp;-Air Conditional</option>
                        <option value="34">-&nbsp;-Theater</option>
                        <option value="12">Jewelry</option>
                        <option value="36">-Accessories</option>
                        <option value="37">-&nbsp;-Sweaters</option>
                        <option value="38">-&nbsp;-Heels & Sandals</option>
                        <option value="39">-&nbsp;-Jeans & Shorts</option>
                        <option value="40">-&nbsp;-Boats</option>
                        <option value="78">Smartphone & Tablets</option>
                        <option value="77">Sports & Outdoors</option>
                        <option value="97">-Tennis</option>
                        <option value="112">-&nbsp;-Tennis</option>
                        <option value="113">-&nbsp;-Coats & Jackets</option>
                        <option value="114">-&nbsp;-Blouses & Shirts</option>
                        <option value="115">-&nbsp;-Tops & Tees</option>
                        <option value="116">-&nbsp;-Hoodies & Sweatshirts</option>
                        <option value="117">-&nbsp;-Intimates</option>
                        <option value="98">-Swimming</option>
                        <option value="106">-&nbsp;-Dresses</option>
                        <option value="107">-&nbsp;-Coats & Jackets</option>
                        <option value="108">-&nbsp;-Blouses & Shirts</option>
                        <option value="109">-&nbsp;-Tops & Tees</option>
                        <option value="110">-&nbsp;-Hoodies & Sweatshirts</option>
                        <option value="111">-&nbsp;-Intimates</option>
                        <option value="99">-Shoes</option>
                        <option value="100">-&nbsp;-Dresses</option>
                        <option value="101">-&nbsp;-Coats & Jackets</option>
                        <option value="102">-&nbsp;-Blouses & Shirts</option>
                        <option value="103">-&nbsp;-Tops & Tees</option>
                        <option value="104">-&nbsp;-Hoodies & Sweatshirts</option>
                        <option value="105">-&nbsp;-Intimates</option>
                        <option value="79">Health & Beauty Bags</option>
                        <option value="80">Shoes & Accessories</option>
                        <option value="81">Toys & Hobbies</option>
                        <option value="82">Computers & Networking</option>
                        <option value="83">Laptops & Accessories</option>
                        <option value="84">Jewelry & Watches</option>
                        <option value="85">Flashlights & Lamps</option>
                        <option value="96">Television</option>
                        <option value="95">Cameras & Photo</option>
                        <option value="133">Computers & Networking</option>
                        <option value="134">Toys & Hobbies</option>
                        <option value="135">Jewelry & Watches</option>
                        <option value="141">Sale Off</option>
                        <option value="136">-Up To 40% Off</option>
                        <option value="137">-Up To 50% Off</option>
                        <option value="138">-Up To 60% Off</option>
                        <option value="139">-Up To 70% Off</option>
                        <option value="140">-Up To 80% Off</option>
                      </select>
                      <button type="submit" title="Search" class="button"><span><span><i class="fa fa-search"></i></span></span></button>
                      <div id="search_autocomplete" class="search-autocomplete"></div>
                    </div>
                  </form>
                  
                </div>
              </div>
              <div class="content-cart group-button-header col-xs-5 col-sm-3 col-md-2">
                <div class="tool-header">
                  <div class="miniCartWrap">
                    <div class="mini-maincart">
                      <div class="cartSummary">
                        <div class="crat-icon">
                        
                        </div>
                        <div class="cart-header">
                          <p class="cart-tolatl"> 
                            <!--<span class="toltal"></span>--> 
                           
                        </div>
                      </div>
                      <div class="mini-contentCart" style="display:none">
                        <div class="block-content">
                      
                        </div>
                      </div>
                    </div>
                  </div>
                  <a title="My wishlist" href="#" class="btn-heart">wishlist</a> <a title="Compare" href="#" class="btn-compare">compare</a> </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-bottom">
          <div class="header-sticker">
            <div class="container">
              <div class="border-bottom menu-mobile">
                <div class="row menu-mobile-none">
                  <div class="header-config-bg col-xs-12 col-sm-12 col-md-12">
                    <div class="header-wrapper-bottom">
                      <div class="custom-menu">
                        <div class="vmagicmenu clearfix">
                          <div class="block-title block-title-vmagicmenu"> <span class="fa fa-bars"></span> <span class="vmagicmenu-subtitle">Categories</span> </div>
                          <div class="block-vmagicmenu-content">
                            <ul class="vmagicmenu-narrow clearfix">
                              <li class="level0 cat  hasChild dropdown"><a class="level-top" href="#"><img class="img-responsive" alt="Electronics" src="img/icon/ele.png"><span>Electronics</span><span class="boder-menu"></span></a>
                                <ul class="level0">
                                  <li class="level1"><a href="#"><span>Television</span></a> </li>
                                  <li class="level1"><a href="#"><span>Air Conditional</span></a> </li>
                                  <li class="level1"><a href="#"><span>ARM</span></a> </li>
                                  <li class="level1"><a href="#"><span>Theater</span></a> </li>
                                  <li class="level1 hasChild"><a href="#"><span>Chicken</span></a>
                                    <ul class="level1">
                                      <li class="level2"><a href="#"><span>Italian Pizza</span></a> </li>
                                      <li class="level2"><a href="#"><span>French Cakes</span></a> </li>
                                    </ul>
                                  </li>
                                  <li class="level1 hasChild"><a href="#"><span>Sandwich</span></a>
                                    <ul class="level1">
                                      <li class="level2"><a href="#"><span>Salad</span></a> </li>
                                      <li class="level2"><a href="#"><span>Paste</span></a> </li>
                                    </ul>
                                  </li>
                                </ul>
                              </li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Smartphone & Tablets" src="img/icon/14.png"><span>Smartphone & Tablets</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat  hasChild" ><a class="level-top" href="#"><img class="img-responsive" alt="Sports & Outdoors" src="img/icon/13.png"><span>Sports & Outdoors</span><span class="boder-menu"></span></a>
                                <div class="level-top-mega">
                                  <div class="content-mega">
                                    <div class="content-mega-horizontal">
                                      <ul class="level0 mage-column cat-mega">
                                        <li class="children level1"><a href="#"><span>Tennis</span></a>
                                          <ul class="level1">
                                            <li class="level2"><a href="#"><span>Tennis</span></a> </li>
                                            <li class="level2"><a href="#"><span>Coats & Jackets</span></a> </li>
                                            <li class="level2"><a href="#"><span>Blouses & Shirts</span></a> </li>
                                            <li class="level2"><a href="#"><span>Tops & Tees</span></a> </li>
                                            <li class="level2"><a href="#"><span>Hoodies & Sweatshirts</span></a> </li>
                                            <li class="level2"><a href="#"><span>Intimates</span></a> </li>
                                          </ul>
                                        </li>
                                        <li class="children level1"><a href="#"><span>Swimming</span></a>
                                          <ul class="level1">
                                            <li class="level2"><a href="#"><span>Dresses</span></a> </li>
                                            <li class="level2"><a href="#"><span>Coats & Jackets</span></a> </li>
                                            <li class="level2"><a href="#"><span>Blouses & Shirts</span></a> </li>
                                            <li class="level2"><a href="#"><span>Tops & Tees</span></a> </li>
                                            <li class="level2"><a href="#"><span>Hoodies & Sweatshirts</span></a> </li>
                                            <li class="level2"><a href="#"><span>Intimates</span></a> </li>
                                          </ul>
                                        </li>
                                        <li class="children level1"><a href="#"><span>Shoes</span></a>
                                          <ul class="level1">
                                            <li class="level2"><a href="#"><span>Dresses</span></a> </li>
                                            <li class="level2"><a href="#"><span>Coats & Jackets</span></a> </li>
                                            <li class="level2"><a href="#"><span>Blouses & Shirts</span></a> </li>
                                            <li class="level2"><a href="#"><span>Tops & Tees</span></a> </li>
                                            <li class="level2"><a href="#"><span>Hoodies & Sweatshirts</span></a> </li>
                                            <li class="level2"><a href="#"><span>Intimates</span></a> </li>
                                          </ul>
                                        </li>
                                        <li>
                                          <div class='mage-column mega-block-bottom'>
                                            <div class="mega-custom-html"><a href="#"><img alt="" src="img/banner.jpg" /></a></div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Health & Beauty Bags" src="img/icon/15.png"><span>Health & Beauty Bags</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Shoes & Accessories" src="img/icon/16.png"><span>Shoes & Accessories</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Toys & Hobbies" src="img/icon/17.png"><span>Toys & Hobbies</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Computers & Networking" src="img/icon/18.png"><span>Computers & Networking</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Laptops & Accessories" src="img/icon/19.png"><span>Laptops & Accessories</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Jewelry & Watches" src="img/icon/20.png"><span>Jewelry & Watches</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Flashlights & Lamps" src="img/icon/21.png"><span>Flashlights & Lamps</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Cameras & Photo" src="img/icon/22.png"><span>Cameras & Photo</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Computers & Networking" src="img/icon/18.png"><span>Computers & Networking</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Toys & Hobbies" src="img/icon/17.png"><span>Toys & Hobbies</span><span class="boder-menu"></span></a></li>
                              <li class="level0 cat "><a class="level-top" href="#"><img class="img-responsive" alt="Jewelry & Watches" src="img/icon/20.png"><span>Jewelry & Watches</span><span class="boder-menu"></span></a></li>
                            </ul>
                            <div class="all-cat"><span>All Categories</span><span style="display:none">Close</span></div>
                          </div>
                        </div>
                        <div class="magicmenu clearfix">
                          <ul class="nav-desktop sticker">
                            <li class="level0 cat  "><a class="level-top" href="#"><span>Coupons</span><span class="boder-menu"></span></a> </li>
                            <li class="level0 cat  " ><a class="level-top" href="#"><span>Brands</span><span class="boder-menu"></span></a> </li>
                            <li class="level0 cat   "><a class="level-top" href="#"><span>Stores</span><span class="boder-menu"></span></a> </li>
                            <li class="level0 cat"><a class="level-top" href="#"><span>Best Deals </span><span class="boder-menu"></span></a> </li>
                            <li class="level0 cat "><a class="level-top" href="#"><span>Advertise</span><span class="boder-menu"></span></a></li>
                            <li class="level0 cat "><a class="level-top" href="#"><span>Submit Store</span></a></li>
                            <li class="level0 cat "><a class="level-top" href="#"><span>Contact Us</span></a></li>
                          </ul>
                        </div>
                        <div class="nav-mobile">
                          <h3 class="mobi-title">Categories</h3>
                          <ul>
                            <li class="level0"><a class="level-top" href="#"><span>Coupons</span><span class="boder-menu"></span></a> </li>
                            <li class="level0"><a class="level-top" href="#"><span>Brands</span><span class="boder-menu"></span></a> </li>
                            <li class="level0"><a class="level-top" href="#"><span>Stores</span><span class="boder-menu"></span></a> </li>
                            <li class="level0"><a class="level-top" href="#"><span>Best Deals</span><span class="boder-menu"></span></a> </li>
                            <li class="level0"><a class="level-top" href="#"><span>Advertise </span><span class="boder-menu"></span></a> </li>
                            <li class="level0"><a class="level-top" href="#"><span>Submit Store</span><span class="boder-menu"></span></a> </li>
                            <li class="level0"><a class="level-top" href="#"><span>Contact Us</span><span class="boder-menu"></span></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="header-setting header-setting-icon">
                  <div class="settting-switcher">
                    <div class="dropdown-toggle">
                      <div class="text-setting">Links</div>
                    </div>
                    <div class="dropdown-switcher">
                      <div class="top-links-alo">
                        <div class="header-top-link">
                          <ul class="links">
                            <li class="first" ><a href="#" title="My Account" >My Account</a></li>
                            <li ><a href="#" title="Testimonial" >Testimonial</a></li>
                            <li class=" last" ><a href="#" title="Log In" >Log In</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- CART ICON ON MMENU --> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>


<!--Last Work-->

<div class="header-container">
    <?php 
		$user_id = $this->session->userdata('user_id');
		if($user_id!=""){
		$user_details = $this->front_model->edit_account($user_id);
	?>
		
	<?php } ?>	

    <div class="header container">
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div class="logo"> <a href="<?php echo base_url(); ?>">
            <div><img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $logo;?>" alt="<?php echo $site_name; ?>" title="<?php echo $site_name; ?>" /></div>
            </a> </div>
          <!--logo--> 
        </div>
		<?php if($user_id!=""){ ?>
		<div class="col-lg-8 col-sm-8 col-md-8">
		<div class="toplinks">
				  <div class="links">
					<div class=""><a href="<?php echo base_url(); ?>cashback/myaccount" title=""> <span class="">WELCOME : <?php echo $this->front_model->user_name($user_id); ?></span></a> </div>
					<div class=""><a href="<?php echo base_url(); ?>cashback/my_earnings" title=""><span class="">BALANCE :  <?php echo DEFAULT_CURRENCY.' '.$user_details->balance; ?></span></a> </div>
					 <div class=""><a href="<?php echo base_url(); ?>cashback/referral_network" title=""><span class="">MY REFERRAL : <?php echo count($this->front_model->referral_network());?></span></a> </div>
					 <div class=""><a href="<?php echo base_url(); ?>cashback/logout" title=""><span class="">LOGOUT</span></a> </div>
				  </div>
				  <!--links--> 
				</div>
		<?php } else { ?>
		 <div class="col-lg-6 col-sm-6 col-md-6">
		<?php } ?>
          <div class="advanced-search" <?php if($user_id==""){ ?>style="padding-top:5px;"<?php } else { ?> style="padding:
		  10px 0px 10px;"<?php } ?>><!-- padding:3px 0px 10px;--><!-- pop up 20px-->
            <div class="inner-box"> <span class="btn-search-mobile"></span>
			  <?php
			  if((strpos($_SERVER['REQUEST_URI'],'cashback/shopping') == true))
			  { ?>
			  <form id="search_mini_form" method="get" onsubmit="return submit_form();">
					<div class="form-search">
						<div class="box-search-select">
							<input id="Location" type="text" name="store" class="input-text typeahead" autocomplete="off" required placeholder="Location name" value="<?php if($this->session->userdata('cityname')){
								echo $cityname = $this->session->userdata('cityname');	} ?>" data-provide="typeahead" />
								
								<button style="line-height:23px !important;border-bottom: 1px solid #eaeaea;border-right: 1px solid #eaeaea;"  type="submit" title="Search" class="button"><i class="fa fa-search"></i><span class="pad-no"> </span></button>
							<!--<div id="search_autocomplete" class="search-autocomplete"></div>-->
						</div>	
					</div>
				</form>
			  <?php } else { ?>
				<form id="search_mini_form" method="get" onsubmit="return submit_form();">
					<div class="form-search">
						<div class="box-search-select">
							<input id="search" type="text" name="store" class="input-text typeahead" autocomplete="off" required placeholder="Search for Online Store" value="<?php  if(isset($_POST['storehead'])){echo $storehead;}?>" data-provide="typeahead" />
								<button style="line-height:23px !important;border-bottom: 1px solid #eaeaea;border-right: 1px solid #eaeaea;"  type="submit" title="Search" class="button"><i class="fa fa-search"></i><span class="pad-no"> </span></button>
							<!--<div id="search_autocomplete" class="search-autocomplete"></div>-->
						</div>	
					</div>
				</form>
				<script type="text/javascript">
				//<![CDATA[
					// var searchForm = new Varien.searchForm('search_mini_form', 'search', 'Search for Store, Retailer...');
					//searchForm.initAutocomplete('http://demo4plazathemes.com/19/ma_betashop/index.php/catalogsearch/ajax/suggest/', 'search_autocomplete');
				//]]>
				</script>
				<form id="dummyform" method="post">
				  <input type="hidden" name="storehead" id="storehead" value="">
				</form>
			<?php } ?>	
            </div>
          </div>
        </div>
        <?php if($user_id==""){ ?>
        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="toplinks mar-tb20; margin:0px 0 !impportant;">
              <div class="links">
                <div class=""><a data-toggle="modal" onclick="navrefer('0');"  href="#myModal" title=""> <span class="">LOGIN</span></a> </div>
                <div class=""><a href="<?php echo base_url(); ?>cashback/register" title=""><span class="">JOIN NOW</span></a> </div>
			  </div>
              <!--links--> 
            </div>
          </div>
		 <?php } ?> 
      </div>
    </div>
    <!--header container--> 
  </div>
  <!--header-container-->
  <nav>
    <div class="container">
      <div class="nav-inner">
        <div class="logo-small"> <a class="logo" href="<?php echo base_url(); ?>" title="<?php echo $site_name; ?>">
          <div><img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $logo;?>"  alt="<?php echo $site_name; ?>" title="<?php echo $site_name; ?>" /></div>
          </a> </div>
        <!--logo-small-->
        
        <div id="mobile-menu" class="hidden-desktop">
          <ul class="navmenu">
            <li>
              <div class="menutop">
                <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                <h2>Menu</h2>
              </div>
			  <?php $uri = $this->uri->segment(2);
				$uri_3 = $this->uri->segment(3); ?>
              <ul class="submenu" style="display:none;">
                <li>
                  <ul class="topnav">
                    <li class="level0 nav-1 level-top first parent"> <a href="<?php echo base_url(); ?>" class="level-top"> <span>Home</span> </a></li>
					
					<li class="level0 nav-2 level-top parent"> <a href="<?php echo base_url(); ?>cashback/stores_list" class="level-top"> <span>Stores</span> </a> </li>
					<?php	$enable_shopping = $getadmindetails[0]->enable_shopping;
					if($enable_shopping==1)
					{	?> 
                    <li class="level0 nav-2 level-top parent"> <a href="<?php echo base_url(); ?>cashback/shopping" class="level-top"> <span>Shopping</span> </a> </li>
					<?php } ?>
                   
					<li class="level0 nav-3 level-top parent"> <a href="<?php echo base_url(); ?>cashback/coupons" class="level-top"> <span>Coupons</span> </a></li>
                    
					<li class="level0 nav-4 level-top parent"> <a href="<?php echo base_url(); ?>cashback/top_cashback" class="level-top"> <span>Featured Offers</span> </a></li>
					<?php if($user_id!="")
						{ ?>
                    <li class="level0 nav-5 level-top parent"> <a href="<?php echo base_url(); ?>cashback/favorites" class="level-top"> <span>Favorites</span> </a></li>
					<?php } ?>
					
					<li class="level0 nav-6 level-top parent"> <a href="<?php echo base_url(); ?>cashback/cms/how-it-works" class="level-top <?php echo ($uri_3=="how-it-works"?"active":""); ?>"> <span>How it Works</span> </a></li>
					
					<?php if($user_id!=""){ ?>
					<li class="level0 nav-7 level-top parent"> <a href="<?php echo base_url(); ?>cashback/refer_friends" class="level-top <?php echo ($uri=="refer_friends"?"active":""); ?>"> <span>Refer Friends</span> </a></li>
					<?php } else { ?>
                    <li class="level0 nav-7 level-top parent"> <a data-toggle="modal" onclick="navrefer('1');" href="#myModal" class="level-top"> <span>Refer Friends</span> </a></li>
					<?php } ?>
					<li class="level0 nav-8 level-top last parent"> <a href="<?php echo base_url(); ?>cashback/cms/faq" class="level-top <?php echo ($uri_3=="faq"?"active":""); ?>"> <span>Help</span> </a></li>
					<?php  $enable_blog = $getadmindetails[0]->enable_blog;
					if($enable_blog==1)
					{ ?>
					<li class="level0 nav-8 level-top last parent"> <a href="<?php echo $blog_url; ?>" class="level-top"> <span>Blog</span> </a></li>
					<?php } ?>
					<?php $result = $this->front_model->header_menu();
					   if($result){
					   foreach($result as $view){
					?>
					<li class="level0 nav-8 level-top last parent"> <?php echo anchor('cashback/cms/'.$view->cms_title,'<span>'.$view->cms_heading.'</span>',array('class'=>'level-top')); ?> </li>
					<?php } } ?>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          <!--navmenu--> 
        </div>
        
        <!-- BEGIN NAV -->
        <ul id="nav" class="hidden-xs">
          <li id="nav-home" class="level0 parent drop-menu"><a class="level-top <?php echo ($uri==""?"active":""); ?>" href="<?php echo base_url(); ?>"><span>Home</span></a></li>
          <li class="level0"> <a class="level-top" href="<?php echo base_url(); ?>cashback/stores_list"><span>Stores</span></a></li>
		  <?php
			  $enable_shopping = $getadmindetails[0]->enable_shopping;
			  if($enable_shopping==1)
			  {
			  ?> 
			  
          <li class="level0"> <a class="level-top" href="<?php echo base_url(); ?>cashback/shopping"><span>Shopping</span></a></li>
		   <li class="level0 shopping-cart" id="cart"><a class="level-top" href="#" data-toggle="dropdown" id="dropdownMenu2"><i class="fa fa-shopping-cart"></i>My Cart</a>
		    <?php
				$cart =  $this->front_model->getuser_cart();
				?>
				<ul aria-labelledby="dropdownMenu2" role="menu" class="dropdown-menu">
				<!-- No Items Found-->
					<li>
				<?php 
				$sub_total=0; $i=0; 
				if($cart) {
					?>
					   
							<table class="table hcart">
								<tbody>
					
					<?php
					$s=1; 
					$new_check_out='';
					foreach($cart as $carts) 
					{  $i++;
						$product_details=$this->front_model->details($carts->product_id);
						if($product_details->remain_coupon_code!='')
						{
							$new_check_out=1;
						$db_coupon_image=$product_details->coupon_image;
						$exp_db_coupon_image=explode(",",$db_coupon_image);  	
						$maximum_count=explode(",",$product_details->remain_coupon_code);
				 ?>
					<tr id="">
						<td class="text-center">
								<a href="javascript:void(0)">
								<img class="img-thumbnail img-responsive" width="80" height="80" title="image" alt="image" src="<?php echo base_url(); ?>uploads/premium/<?php echo $exp_db_coupon_image[0]; ?>">
							</a>
						</td>
						<td class="text-left">
							<a href="javascript:void(0)">
								<?php echo substr($product_details->offer_name,0,9)."...";   ?>
							</a>
						</td>
						<td class="text-right">x 1</td>
						<td class="text-right"><?php echo DEFAULT_CURRENCY." ".$product_details->amount ?></td>
						<!--<td class="text-center">
							<a href="#" onclick="return delete_cart_header(<?php echo $carts->id;  ?>,<?php echo $s;?>);">
							
								<i class="fa fa-times"></i>
							</a>
						</td>-->
					</tr>
					<?php 
						$sub_total+=$product_details->amount*$carts->quantity;?>
					<?php }
					else
					{
						$this->db->query('DELETE from premium_cart where id='.$carts->id);
					}
					
					$s++;}?>
					</tbody></table>
				</li>
 
				<li>
					<table class="table table-bordered total">
						<tbody>
						<!--	<tr>
								<td class="text-right"><strong>Sub-Total</strong></td>
								<td class="text-left">$1,101.00</td>
							</tr>
							<tr>
								<td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
								<td class="text-left">$4.00</td>
							</tr>
							<tr>
								<td class="text-right"><strong>VAT (17.5%)</strong></td>
								<td class="text-left">$192.68</td>
							</tr>-->
							
							<tr>
								<td class="text-right"><strong>Total</strong></td>
								<td class="text-left"><?php echo DEFAULT_CURRENCY." ".$sub_total; ?></td>
							</tr>
						</tbody>
					</table>
					<p class="text-right btn-block1">
						<a href="<?php echo base_url();?>cashback/cart_listing_page" class="btn btn-blue">View Cart		</a>
						<!--<a href="#" class="btn btn-default">	Checkout</a>-->
					</p>
				</li>
						
				<?php
					}
					else { ?>
					
					 <li>
						 No Items Found
					</li>
					
				<?php } ?>
				</ul>
						
					</li>
		  <?php } ?>
          <li class="level0"> <a class="level-top" href="<?php echo base_url(); ?>cashback/coupons"><span>Coupons</span></a></li>
          <li class="level0"> <a class="level-top" href="<?php echo base_url(); ?>cashback/top_cashback"><span>Featured Offers</span></a> </li>
		  <?php if($user_id!="") { ?>
          <li class="level0"> <a class="level-top" href="<?php echo base_url(); ?>cashback/favorites"><span>Favorites</span></a> </li>
		  <?php } ?>
          <li class="level0"> <a class="level-top <?php echo ($uri_3=="how-it-works"?"active":""); ?>" href="<?php echo base_url(); ?>cashback/cms/how-it-works"><span>How it Works</span></a></li>
          <?php if($user_id!="") { ?>
		  <li class="level0"> <a href="<?php echo base_url(); ?>cashback/refer_friends" class="level-top <?php echo ($uri=="refer_friends"?"active":""); ?>"> <span>Refer Friends</span> </a></li>
		  <?php } else { ?>
          <li class="level0"> <a data-toggle="modal" onclick="navrefer('1');" href="#myModal" class="level-top"> <span>Refer Friends</span> </a></li><input type="hidden" id="navrefer_id" value="0">
		  <?php } ?>
		  <?php if($user_id!="") { ?>
		  <!--<li class="level0"> <a href="<?php echo base_url(); ?>cashback/support" class="level-top <?php echo ($uri=="support"?"active":""); ?>"> <span>Support</span> </a></li>-->
		  <?php } ?>
		  <li class="level0"> <a href="<?php echo base_url(); ?>cashback/cms/faq" class="level-top <?php echo ($uri_3=="faq"?"active":""); ?>"> <span>Help</span> </a></li>
		  <?php  $enable_blog = $getadmindetails[0]->enable_blog;
			  if($enable_blog==1)
			  { ?>
			  <li class="level0"> <a href="<?php echo $blog_url; ?>" class="level-top"> <span>Blog</span> </a></li>
              <?php }  ?>
			  <?php  $result = $this->front_model->header_menu();
			   if($result){
			   foreach($result as $view){
				?>
				 <li class="level0"> <?php echo anchor('cashback/cms/'.$view->cms_title,'<span>'.$view->cms_heading.'</span>',array('class'=>'level-top')); ?> </li>
				<?php } } ?>
			  </ul>
        <!--nav--> 
      </div>
      <!--nav-inner--> 
    </div>
    <!--container--> 
  </nav>