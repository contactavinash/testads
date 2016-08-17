<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

 	<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> Blog</title>
	<meta name="Description" content="<?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>"/>    
    <meta name="keywords" content="<?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> " /> 
	
    <meta name="robots" CONTENT="INDEX, FOLLOW" />
    
<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>	

<link href="<?php echo base_url();?>front/css/hover.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>front/css/pre-pge.css" rel="stylesheet" type="text/css">

</head>

<body>

<?php
 $this->load->view('front/header'); 

//print_r($store_details);?>

<!-- Header ends here -->

<div class="wrap-top">
  <div id="content">
    <div class="container">
    
<section class="mid-sec mar40">

 <div class="row">
                <div class="col-md-3">
                    <aside class="sidebar-left hidden-phone">
                        <div class="sidebar-box">
                            <h5>Coupon Categories</h5>
                            <ul class="icon-list blog-category-list">
                              <?php 
								$categories = $this->front_model->get_all_categories(13);
								foreach($categories as $view)
								{
									$category_name = $view->category_name; 
								?>
									<li><?php echo anchor('cashback/products/'.$view->category_url,'<i class="fa fa-angle-right"></i>'.$view->category_name); ?></li>
                                </li>
								<?php 
								} ?>
                                 </ul>
                                
                        </div>


                        <div class="sidebar-box">

                            <h5>Newsletter singup</h5>
                            <form class="sign-up">
                               <!-- <input type="text" class="form-control" placeholder="E-mail">-->
                                <input id="news_email" class="cls_text_fild form-control" type="text" placeholder="Email Address" value="" onkeypress="clears(2);">
                                <small class="help-block">*We never send spam</small>
                               <!-- <input type="submit" class="btn btn-blue" value="Subscribe">-->
                                <button class="btn btn-blue" onclick="email_news();" type="button">Subscribe</button>
                            </form>
                        </div>

                    </aside>


                </div>
                <div class="col-md-9">
                    <!-- BLOG POST -->
                    
                    <!-- BLOG POST -->
                    
                    <?php
					if($blog_details)
					{
						foreach($blog_details as $blog)
						{
							 $get_commnents = $this->front_model->blog_comments($blog->cms_id);
							 //print_r($get_commnents);
							 if(is_array($get_commnents))
							 {
								  $count_comments = count($get_commnents);
							 }
							 else
							 {
								 $count_comments = 0;
							 }
							
							?>
							<article class="post">
                        <header class="post-header">
                            <blockquote style="line-height:25px"><?php echo $blog->cms_heading?></blockquote>
                        </header>
                        <div class="post-inner">
                           <!-- <h4 class="post-title"><a href="#">Quoute Post Type</a></h4>-->
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i><a href="<?php echo base_url()."cashback/blog_details/".$blog->cms_id;?>"><?php echo $blog->blog_time?></a>
                                </li>
                                <li><i class="fa fa-user"></i><a href="javascript:void(0);">Admin</a>
                                </li>
                               <!-- <li><i class="fa fa-tags"></i><a href="#">Web</a>
                                </li>-->
                                <li><i class="fa fa-comments"></i><a href="<?php echo base_url()."cashback/blog_details/".$blog->cms_id;?>"><?php echo $count_comments;?> Comments</a>
                                </li>
                            </ul>
                            <p class="post-desciption"><?php echo substr($blog->cms_content,350);?></p><a class="btn btn-sm btn-blue" href="<?php echo base_url()."cashback/blog_details/".$blog->cms_id;?>">Read More</a>
                        </div>
                    </article>
                    		<?php
						}
					}
					?>
                    
                    
                    
                    <!-- BLOG POST -->
                    
                    
                    <!-- BLOG POST -->
                    
                    
                    <!--<ul class="pagination">
                        <li class="prev disabled">
                            <a href="#"></a>
                        </li>
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li class="next">
                            <a href="#"></a>
                        </li>
                    </ul>-->
                    <div class="gap"></div>
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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
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
