<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

 	<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> Blog details</title>
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
                    <article class="post">
                        <header class="post-header">
                            <div class="fotorama">
                                <img src="<?php echo base_url()."uploads/blog/".$blog_details->affiliate_logo?>" alt=""  />
                            </div>
                        </header>
                        <?php
                        $get_commnents = $this->front_model->blog_comments($blog_details->cms_id);
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
                        <div class="post-inner">
                            <h4 class="post-title"><?php echo $blog_details->cms_heading?></h4>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i><a href="javascript:void(0);"><?php echo $blog_details->blog_time?></a>
                                </li>
                                <li><i class="fa fa-user"></i>by <a href="javascript:void(0);">Admin</a>
                                </li>
                                <li><i class="fa fa-comments"></i><a href="javascript:void(0);"><?php echo $count_comments?> Comments</a>
                                </li>
                            </ul>
                            <div class="gap gap-mini"></div>
                            <p class="text-justify"><?php echo $blog_details->cms_content;?></p>
                           
                        </div>
                    </article>
                    
                    <?php
					$user_id = $this->session->userdata('user_id');
					if($user_id!="")
					{
					?>
                    <?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
						<button data-dismiss="alert" class="close">x</button>
						<strong>'.$error.'</strong></div>';
					} ?>
					<?php
						$success = $this->session->flashdata('success');
						if($success!="") {
								echo '<div class="alert alert-success">
									<button data-dismiss="alert" class="close">x</button>
									<strong>'.$success.' </strong></div>';
					} ?>	
                     <div class="sidebar-box clearfix">
                    <h4>Leave a Comment</h4>
                    <?php
								$atrtibute = array('role'=>'form','name'=>'regform','id'=>'regform','method'=>'post');
								echo form_open('cashback/blog_comment',$atrtibute);
								
						?>
                        <input type="hidden" name="blog_id" value="<?php echo $blog_details->cms_id;?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                  <!--      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="" value="" placeholder="Type Your Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" name="" value="" placeholder="Your E-mail Address" class="form-control">
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea name="comments" id="comments" class="form-control" required placeholder="Your Comment Here"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="blog_commentregister" value="Post a Comment" class="btn btn-primary">
                    </form>
                    
                    </div>
                    
                    <?php
					}
					?>
                    <h4 class="mb20">Comments</h4>
                    <!-- START COMMENTS -->
                    <div class="sidebar-box clearfix">
                    <ul class="comments-list">
                    <?php
					if($block_comments)
					{
						foreach($block_comments as $comments)
						{
							//echo $comments->user_id;
							
							if($comments->user_id=='Admin')
							{
								$com_username = "Admin";								
							}
							else
							{
								$com_username = $this->front_model->user_name($comments->user_id);
							}
							
							if(is_array($com_username))
							{
								$com_username = "Unknown User";
							}
							
							?>
                            <li>
	                            <article class="comment">
                                <!--<div class="comment-author">
                                    <img src="<?php echo base_url();?>/front/images/review-img.png" alt=""  />
                                </div>-->
                                <div class="comment-inner"><span class="comment-author-name"><?php echo $com_username;?></span>
                                    <p class="comment-content"><?php echo $comments->comments?></p><span class="comment-time"><?php echo $comments->created_date;?></span><!--<a class="comment-reply" href="#"><i class="fa fa-reply"></i> Reply</a><a class="comment-like" href="#"><i class="fa fa-heart"></i> 5</a>-->
                                </div>
                            </article>
                       		 </li>
                            <?php
						}
						
					}
					else
					{
						?>
                        <li>
	                            <article class="comment">
									<div class="comment-inner">
                                    <p class="comment-content">No comments</p>
                                </div>
                            </article>
                       		 </li>
                        <?php
					}
					?>
                    
                    <?php
					if($user_id=="")
					{
						?>
                    <a class="btn btn-success popup-text" href="#myModal" data-toggle="modal">Add Comment</a>
                    <?php
					}
					else
					{
						?>
                         <a class="btn btn-success" href="javascript:void(0);" onClick="post_focus();" data-toggle="modal">Add Comment</a>
                        <?php
						
					}
					?>
                        
                       <!-- <li>
                            
                            <article class="comment">
                                <div class="comment-author">
                                    <img src="images/review-img.png" alt="" />
                                </div>
                                <div class="comment-inner"><span class="comment-author-name">Ava McDonald</span>
                                    <p class="comment-content">Senectus luctus ante natoque mollis quam netus parturient nisi convallis sit accumsan congue sociis</p><span class="comment-time">15 seconds ago</span><a class="comment-reply" href="#"><i class="fa fa-reply"></i> Reply</a><a class="comment-like" href="#"><i class="fa fa-heart"></i> 14</a>
                                </div>
                            </article>
                            <ul>
                                <li>
                                    
                                    <article class="comment">
                                        <div class="comment-author">
                                            <img src="images/review-img.png" alt=""  />
                                        </div>
                                        <div class="comment-inner"><span class="comment-author-name">Neil Davidson</span>
                                            <p class="comment-content">Morbi diam imperdiet ligula cubilia odio nisl lectus id nascetur porttitor laoreet consectetur ut et dapibus pharetra donec ipsum sollicitudin ultrices habitant</p><span class="comment-time">15 seconds ago</span><a class="comment-reply" href="#"><i class="fa fa-reply"></i> Reply</a><a class="comment-like" href="#"><i class="fa fa-heart"></i> 33</a>
                                        </div>
                                    </article>
                                    
                            </ul>
                            </li>-->
                    </ul>
                    </div>
                    <!-- END COMMENTS -->
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

function post_focus()
{
	$('#comments').focus();
}
</script> 



</body>
</html>

                            