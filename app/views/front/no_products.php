<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

 	<title>No Products Found</title>
	<meta name="Description" content=""/>    
    <meta name="keywords" content="" />    
    
<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>	

   <link rel="stylesheet" href="<?php echo base_url();?>front/css/pre-pge.css" type="text/css">

</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->

<div class="wrap-top">
  <div id="content">
  <div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
				<li class="category34"> <strong>Stores</strong> </li>
			  </ul>
			</div>
			<!--col-xs-12--> 
		  </div>
		  <!--row--> 
		</div>
		<!--container--> 
	</div>  

	<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
       <div class="row">
       <div class="col-md-3">
		<div id="magik-verticalmenu" class="block magik-verticalmenu">
            <div class="nav-title"> <span>Categories</span> </div>
			<div class="nav-content">
              <div class="navbar navbar-inverse">
			  <div id="verticalmenu" class="verticalmenu" role="navigation">
			  <div class="navbar">
				<div class="collapse navbar-collapse navbar-ex1-collapse"> 
              <ul class="nav navbar-nav verticalmenu">
                <li class="active"><?php echo anchor('cashback/stores_list','<i class="fa fa-ticket"></i>All'); ?> </li>
				 <?php 
						$categories = $this->front_model->get_all_categories();
						$kt = 1;
						foreach($categories as $view)
						{
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
							$category_name = $view->category_name; 
					?>
				<li class="parent dropdown dynamiccls" <?php echo $extracss." "; ?>>
				<a  <?php echo $s;?> onClick="runcheck_1('<?php echo 'cashback/stores_list/'.$view->category_url;?>');"  class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url().'cashback/stores_list/'.$view->category_url;?>"><span><?php echo $view->category_name;?></span><b class="round-arrow"></b></a>
						<?php if(count($subcate)!=0)
						{
							if($subcate)
							{
								$category_url = $view->category_url;
								?>
                         <!--<div class="dropdown-menu" style="width:580px">
                            <div class="dropdown-menu-inner">
                            <div class="row">
                                <div class="mega-col col-sm-6" data-widgets="wid-5" data-colwidth="6">
                                  <div class="mega-col-inner">
                                    <div class="ves-widget" id="wid-5">
                                      <div class="menu-title"><a href="#"><?php echo $view->category_name;?></a></div>
                                      <div class="widget-html">
                                        <div class="widget-inner">
                                          <ul>
										  <?php
										  foreach($subcate as $subcatelist)
											{
												$sub_category_name = $subcatelist->sub_category_name;
												$sub_category_url = $subcatelist->sub_category_url;
												$sun_category_id = $subcatelist->sun_category_id;
										  ?>
                                           <li <?php echo $kt;?>><?php echo anchor('cashback/stores_list/'.$category_url.'/'.$sub_category_url,$sub_category_name); ?></li>
											<?php } ?>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            </div>
                          </div>-->
						<?php }
						}
						?> 	
					<?php $kt++;} ?>
                </li>
              </ul>
			  </div>
			  </div>
			  </div>
			  </div>
              <button class="btn btn-block btn-blue" id="load_m" onClick="show_cate();"> Load more </button>
            </div>
          </div>
		  

                </div>
       
       <div class="col-md-9">

		<div class="store-title_red"><h3 class="mar-bot20 text-center">No Records Found for Your Search</h3></div>
        </div>

       </div> 
        
     
        
        
    </div>
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

<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>

<script type="application/javascript">
function toggle_st(num)
{
	$('.toggle'+num).toggle('slow');
	return false;
}
</script>
</body>
</html>