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
body {
	font-family: 'PT Sans', sans-serif;
	font-size:13px;
	line-height:20px;
	background:url(<?php echo base_url();?>front/images/body-bg_store.png) left top repeat;
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

<?php $this->load->view('front/header'); ?>

  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
      	<div class="col-xs-12">
	<ul>
	  	      <li class="home">
	      		  <a href="http://mas1.magikcommerce.com/index.php/polodemo2red/" title="Go to Home Page">Home</a>
	      	      		  <span> <i class="fa fa-angle-double-right"></i> </span>
	      	      </li>
	  	      <li class="category34">
	      		  <strong>Coupons</strong>
	      	      	      </li>
	  	</ul>
	  </div><!--col-xs-12-->
      </div> <!--row-->
    </div> <!--container-->
  </div>
  
  <!-- Home Slider Block -->
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3">
          <div id="magik-verticalmenu" class="block magik-verticalmenu">
            <div class="nav-title"> <span>Categories</span> </div>
            <div class="nav-content">
              <div class="navbar navbar-inverse">
                <div id="verticalmenu" class="verticalmenu" role="navigation">
                  <div class="navbar">
                    <div class="collapse navbar-collapse navbar-ex1-collapse"> 
                      
                      <!-- BEGIN NAV -->
                      <ul class="nav navbar-nav verticalmenu">
                        <li class="parent dropdown"> <a  class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Womens</span><b class="round-arrow"></b></a>
                          <div class="dropdown-menu" style="width:580px">
                            <div class="dropdown-menu-inner">
                              <div class="row">
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Clothing</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Western Wear</span></a> </li>
                                            <li> <a href="#"><span>Night Wear</span></a> </li>
                                            <li> <a href="#"><span>Ethnic Wear</span></a> </li>
                                            <li> <a href="#"><span>Designer Wear</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Watches</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Fashion</span></a> </li>
                                            <li> <a href="#"><span>Dress</span></a> </li>
                                            <li> <a href="#"><span>Sports</span></a> </li>
                                            <li> <a href="#"><span>Casual</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Styliest Bag</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Clutch Handbags</span></a> </li>
                                            <li> <a href="#"><span>Diaper Bags</span></a> </li>
                                            <li> <a href="#"><span>Bags</span></a> </li>
                                            <li> <a href="#"><span>Hobo Handbags</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Shoes</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Flat Shoes</span></a> </li>
                                            <li> <a href="#"><span>Flat Sandals</span></a> </li>
                                            <li> <a href="#"><span>Boots</span></a> </li>
                                            <li> <a href="#"><span>Heels</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="parent dropdown"> <a  class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Mens</span><b class="round-arrow"></b></a>
                          <div class="dropdown-menu" style="width:580px">
                            <div class="dropdown-menu-inner">
                              <div class="row">
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Clothing</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Casual Wear</span></a> </li>
                                            <li> <a href="#"><span>Formal Wear</span></a> </li>
                                            <li> <a href="#"><span>Ethnic Wear</span></a> </li>
                                            <li> <a href="#"><span>Denims</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Shoes</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Formal Shoes</span></a> </li>
                                            <li> <a href="#"><span>Sport Shoes</span></a> </li>
                                            <li> <a href="#"><span>Canvas Shoes</span></a> </li>
                                            <li> <a href="#"><span>Leather Shoes</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Watches</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Digital</span></a> </li>
                                            <li> <a href="#"><span>Chronograph</span></a> </li>
                                            <li> <a href="#"><span>Sports</span></a> </li>
                                            <li> <a href="#"><span>Casual</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Jackets</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Coats</span></a> </li>
                                            <li> <a href="#"><span>Formal Jackets</span></a> </li>
                                            <li> <a href="#"><span>Leather Jackets</span></a> </li>
                                            <li> <a href="#"><span>Blazers</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Sunglasses</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Ray Ban</span></a> </li>
                                            <li> <a href="#"><span>Fasttrack</span></a> </li>
                                            <li> <a href="#"><span>Police</span></a> </li>
                                            <li> <a href="#"><span>Oakley</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="parent dropdown"> <a  class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Electronics</span><b class="round-arrow"></b></a>
                          <div class="dropdown-menu" style="width:580px">
                            <div class="dropdown-menu-inner">
                              <div class="row">
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Mobiles</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Samsung</span></a> </li>
                                            <li> <a href="#"><span>Nokia</span></a> </li>
                                            <li> <a href="#"><span>iPhone</span></a> </li>
                                            <li> <a href="#"><span>Sony</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Accesories</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Mobile Memory Cards</span></a> </li>
                                            <li> <a href="#"><span>Cases & Covers</span></a> </li>
                                            <li> <a href="#"><span>Mobile Headphones</span></a> </li>
                                            <li> <a href="#"><span>Bluetooth Headsets</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Cameras</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Camcorders</span></a> </li>
                                            <li> <a href="#"><span>Point & Shoot</span></a> </li>
                                            <li> <a href="#"><span>Digital SLR</span></a> </li>
                                            <li> <a href="#"><span>Camera Accesories</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Audio & Video</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>MP3 Players</span></a> </li>
                                            <li> <a href="#"><span>IPods</span></a> </li>
                                            <li> <a href="#"><span>Speakers</span></a> </li>
                                            <li> <a href="#"><span>Video Players</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Computer</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>External Hard Disk</span></a> </li>
                                            <li> <a href="#"><span>Pendrives</span></a> </li>
                                            <li> <a href="#"><span>Headphones</span></a> </li>
                                            <li> <a href="#"><span>PC components</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="parent dropdown"> <a  class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Furniture</span><b class="round-arrow"></b></a>
                          <div class="dropdown-menu" style="width:580px">
                            <div class="dropdown-menu-inner">
                              <div class="row">
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Living Room</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Racks & Cabinets</span></a> </li>
                                            <li> <a href="#"><span>Sofas</span></a> </li>
                                            <li> <a href="#"><span>Chairs</span></a> </li>
                                            <li> <a href="#"><span>Tables</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Dining & Bar</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Dining Table Sets</span></a> </li>
                                            <li> <a href="#"><span>Serving Trolleys</span></a> </li>
                                            <li> <a href="#"><span>Bar Counters</span></a> </li>
                                            <li> <a href="#"><span>Dining Cabinets</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Bedroom</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Beds</span></a> </li>
                                            <li> <a href="#"><span>Chest of Drawers</span></a> </li>
                                            <li> <a href="#"><span>Wardrobes & Almirahs</span></a> </li>
                                            <li> <a href="#"><span>Nightstands</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Kitchen</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Kitchen Racks</span></a> </li>
                                            <li> <a href="#"><span>Kitchen Fillings</span></a> </li>
                                            <li> <a href="#"><span>Wall Units</span></a> </li>
                                            <li> <a href="#"><span>Benchers And Stools</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Home Improvement</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Hardware</span></a> </li>
                                            <li> <a href="#"><span>Essentials</span></a> </li>
                                            <li> <a href="#"><span>Tools</span></a> </li>
                                            <li> <a href="#"><span>Electrical</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="parent dropdown"> <a  class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Sports</span><b class="round-arrow"></b></a>
                          <div class="dropdown-menu" style="width:580px">
                            <div class="dropdown-menu-inner">
                              <div class="row">
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Exercise & Fitness</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Fitness Accessories</span></a> </li>
                                            <li> <a href="#"><span>Strength Training</span></a> </li>
                                            <li> <a href="#"><span>Cardio Equipment</span></a> </li>
                                            <li> <a href="#"><span>Sports Gadgets</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Badminton</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Racquets</span></a> </li>
                                            <li> <a href="#"><span>Shuttlecocks</span></a> </li>
                                            <li> <a href="#"><span>Complete Sets</span></a> </li>
                                            <li> <a href="#"><span>Equipment Bags</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Tennis</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Racquets</span></a> </li>
                                            <li> <a href="#"><span>Tennis Balls</span></a> </li>
                                            <li> <a href="#"><span>Racquet Grips</span></a> </li>
                                            <li> <a href="#"><span>Racquet Strings</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Swimming</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Goggles</span></a> </li>
                                            <li> <a href="#"><span>Swim Caps</span></a> </li>
                                            <li> <a href="#"><span>Swimwear</span></a> </li>
                                            <li> <a href="#"><span>Training Equipment</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#">Cricket</a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
                                            <li> <a href="#"><span>Bats</span></a> </li>
                                            <li> <a href="#"><span>Balls</span></a> </li>
                                            <li> <a href="#"><span>Gloves</span></a> </li>
                                            <li> <a href="#"><span>Protective Gear</span></a> </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-sm-12 col-md-9">
          <div class="filters mar-bot">
            <ul class="nav nav-pills">
              <li class="active"><a data-filter="*" href="#">All</a></li>
              <li class=""><a data-filter=".A" href="#">A</a></li>
              <li class=""><a data-filter=".B"  href="#">B</a></li>
              <li class=""><a data-filter=".C"  href="#">C</a></li>
              <li class=""><a data-filter=".D"  href="#">D</a></li>
              <li class=""><a data-filter=".E"  href="#">E</a></li>
              <li class=""><a data-filter=".F"  href="#">F</a></li>
              <li class=""><a data-filter=".G"  href="#">G</a></li>
              <li class=""><a data-filter=".H"  href="#">H</a></li>
              <li class=""><a data-filter=".I"  href="#">I</a></li>
              <li class=""><a data-filter=".J"  href="#">J</a></li>
              <li class=""><a data-filter=".K"  href="#">K</a></li>
              <li class=""><a data-filter=".L"  href="#">L</a></li>
              <li class=""><a data-filter=".M"  href="#">M</a></li>
              <li class=""><a data-filter=".N"  href="#">N</a></li>
              <li class=""><a data-filter=".O"  href="#">O</a></li>
              <li class=""><a data-filter=".P"  href="#">P</a></li>
              <li class=""><a data-filter=".Q"  href="#">Q</a></li>
              <li class=""><a data-filter=".R"  href="#">R</a></li>
              <li class=""><a data-filter=".S"  href="#">S</a></li>
              <li class=""><a data-filter=".T"  href="#">T</a></li>
              <li class=""><a data-filter=".U"  href="#">U</a></li>
              <li class=""><a data-filter=".V"  href="#">V</a></li>
              <li class=""><a data-filter=".W"  href="#">W</a></li>
              <li class=""><a data-filter=".X"  href="#">X</a></li>
              <li class=""><a data-filter=".Y"  href="#">Y</a></li>
              <li class=""><a data-filter=".Z"  href="#">Z</a></li>
              <!--<li class=""><a data-filter=".feature"  href="#">Feature</a></li>
                <li class=""><a data-filter=".store"  style="background-color:#a5d16c;" href="#">Store of the Week </a></li>
                <li><a data-filter=".offers"  style="background-color:#e74955;" href="#"> Offers</a></li>-->
            </ul>
          </div>
          
          <div class="rex-features  clearfix">
          
          <div class="row">
          <div class="col-md-4 col-sm-4">
          <div class="feature-item"><a href="#" data-toggle="modal" data-target="#couponmodal" >
          <div class="col-pad">
          <div class="triangle"></div>
          <div class="bg-wht"><img alt="" src="img/store-1-sm.png" width="70"></div>
          <hr>
          <h4 class="text-center">Paytm</h4>
          <p> Get Up to 5.60% Cashback & from Company Name  </p>
          </div></a>
          </div>
          </div>
          
          <!-- Modal -->
<div class="modal fade" id="couponmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header no-border">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>
      <div class="modal-body">
       <div class="row">
       <div class="col-md-4 col-sm-4">
       
       <div class="box-bg clearfix mar-no">
       
       <div class="md-bg-light-green pad"> <h4 class="text-center text-uppercase"> You Need to Login to earn Cashback</h4></div>
       <div class="row">
       <div class="col-md-12">
       
       <h4> Not a Member Yet?</h4>
       
       <hr>
       
       <h5> Signup and Start earning today? It's Totally Free! </h5>
       
       <p> <strong>Why Join Rupiya Back?</strong></p>
       
       <ul class="links">
       
       <li> <a href="#"> Free to Join </a> </li>
       
       <li> <a href="#"> &5.00 Bonus When you signup </a> </li>
       
       <li> <a href="#"> Refer Your Friend and earn &5.00 each </a> </li>
       
       <li> <a href="#"> Earn upto 35% Cashback Offers </a> </li>
       
       <li> <a href="#"> Coupon codes to help you save more </a> </li>
       
       <li> <a href="#"> Shop Online at your favorite stores </a></li>
       
       </ul>
       
       <p class="text-center"> <a href="#" class="md-btn md-btn-danger">  Signup </a></p>
       
       </div>
       </div>
       
       <div class="row">
       <div class="col-md-12">
       <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
            
            <ul class="list-inline clearfix uk-margin-bottom">
            
            <li><a class="btn btn-social btn-facebook btn-sm mar-bot"><i class="fa fa-facebook"></i> Sign in with Facebook </a></li>
            <li><a class="btn btn-social btn-google-plus btn-sm"><i class="fa fa-google-plus"></i> Sign in with Google+ </a></li>
            
            </ul>
            
            <hr>
            
            
                
                <form>
                    <div class="uk-form-row">
                        <label for="login_username">Email</label>
                        <input class="md-input" type="text" id="login_username" name="login_username" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="login_username" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="#" class="md-btn md-btn-primary md-btn-block">Sign In</a>
                    </div>
                    <div class="uk-margin-top">
                        <a href="#" id="" class="uk-float-right">Forgot Password</a>
                        <span class="icheck-inline">
                            <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                            <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                        </span>
                    </div>
                </form>
            </div>
      </div>
       </div>
       </div>
       
       </div>
       </div>
       <div class="col-md-8 col-sm-8">
       
       <ol class="products-lists">
      
      <li class="item">  
     
              <div class="inner-item ">     
               <div class="label-pro-new-blnk"><span>30%<br> Cashback</span></div>     
                 <div class="item-image" style="min-height:338px;">
                    <div class="inner"> 
                    <a class="product-image" href="#">  
                       <img class="first_image" src="img/store-3.jpg" alt="Ipad Air and iOS7"> 
                    </a>                
                   </div> 
                   
                    
                </div> 
               
                <div class="product-shop">
                    <div class="inner">   
                        <h2 class="product-name">
                        
                       
                        <a class="product-image" href="#">Myntra Shopping</a></h2>
    
                        <div class="desc std">
                        Cras id leo aliquet, dictum orci at, varius ligula. Duis aliquet pellentesque tincidunt. Vestibulum finibus augue sit amet ex elementum, non consequat libero mattis.                       </div>
                        
                        
                        
                       <div class="wrap-btn-prolist">
                       
                         <h4 class="product-name"> <a class="product-image" href="#">Conditions</a></h4>
                        
                        <ul class="list-unstyled clearfix">
                        
                        <li class="pad-no"><a href="#"> 10% on Fashions</a></li>
                        
                        <li><a href="#"> 15% on Sarees</a></li>
                        
                        <li><a href="#"> 20% on Accessories</a></li>
                        
                        </ul>    
                       
                       <h3 class="text-center md-card-head-text-over"> No Thanks I just want to Shop </h3>
                            
                       <p class="text-center"><a class="md-btn md-btn-danger">Continue Shopping without Cashback</a></p>
                                                   </div>
                    </div>
                </div>  
            </div>          
        </li>
        
        
        </ol>
       </div>
       </div>
      </div>
     
    </div>
  </div>
</div>
          
          <div class="col-md-4 col-sm-4">
          <div class="feature-item">
          <div class="col-pad">
          <div class="triangle"></div>
          <div class="bg-wht"><img alt="" src="img/store-2.jpg" width="75"></div>
          <hr>
          <h4 class="text-center">Flipkart</h4>
          <p> Get Up to 5.60% Cashback & from Company Name  </p>
          </div>
          </div>
          </div>
          
          <div class="col-md-4 col-sm-4">
          <div class="feature-item">
          <div class="col-pad">
          <div class="triangle"></div>
          <div class="bg-wht"><img alt="" src="img/store-3.jpg" width="75"></div>
          <hr>
          <h4 class="text-center">Myntra</h4>
          <p> Get Up to 5.60% Cashback & from Company Name  </p>
          </div>
          </div>
          </div>
          
          <div class="col-md-4 col-sm-4">
          <div class="feature-item">
          <div class="col-pad">
          <div class="triangle"></div>
          <div class="bg-wht"><img alt="" src="img/store-4.jpg" width="75"></div>
          <hr>
          <h4 class="text-center">Foodpanda</h4>
          <p> Get Up to 5.60% Cashback & from Company Name  </p>
          </div>
          </div>
          </div>
          
          <div class="col-md-4 col-sm-4">
          <div class="feature-item">
          <div class="col-pad">
          <div class="triangle"></div>
          <div class="bg-wht"><img alt="" src="img/store-1-sm.png"></div>
          <hr>
          <h4 class="text-center">Paytm</h4>
          <p> Get Up to 5.60% Cashback & from Company Name  </p>
          </div>
          </div>
          </div>
          
          <div class="col-md-4 col-sm-4">
          <div class="feature-item">
          <div class="col-pad">
          <div class="triangle"></div>
          <div class="bg-wht"><img alt="" src="img/store-2.jpg" width="75"></div>
          <hr>
          <h4 class="text-center">Flipkart</h4>
          <p> Get Up to 5.60% Cashback & from Company Name  </p>
          </div>
          </div>
          </div>
          
          
          
          </div>
          
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
  <!--- NEWSLETTER -->
  
  <section class="newsletter-bg mar-no">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="block-subscribe">
              <div class="newsletter">
                <form action="" method="post" id="newsletter-validate-detail1">
                  <h4><span> Signup for RupiyaBack Exclusive Offers</span></h4>
                  <input type="text" name="email" id="newsletter1" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" />
                  <button type="submit" title="Subscribe" class="subscribe"><span>Subscribe</span></button>
                </form>
              </div>
              <!--newsletter--> 
            </div>
            <!--block-subscribe--> </div>
          <!--col-xs-12 col-sm-6 col-md-7-->
          <!--<div class="col-xs-12 col-sm-6 col-md-5">
            <div class="social">
              <ul>
                <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
                <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
                <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
                <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
                <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
              </ul>
            </div>
          </div>-->
        </div>
      </div>
    </section>


    <footer>
  <?php
//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>
</footer>

<!-- FAQ -->




<?php $this->load->view('front/js_scripts');?>


 <!-- contact page specific js starts -->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/jquery.validate.min.js"></script>       
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/gmaps.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/map.js"></script>

<!-- Slider --> 







</body>
</html>
