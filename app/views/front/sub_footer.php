<?php
	$getadmindetails = $this->front_model->getadmindetails(); 
	$admin = $this->front_model->getadmindetails_main();
	$blog_url = $getadmindetails[0]->blog_url;
	$enable_blog = $getadmindetails[0]->enable_blog;
	
	
	$product_id=explode(',',$this->session->userdata['compare_data']['product_id']);
	$price=explode(';',$this->session->userdata['compare_data']['price']);
	$title = explode(',',$this->session->userdata['compare_data']['title']);
	$img_url = explode(',',$this->session->userdata['compare_data']['img_url']);
	$link_url = explode(',',$this->session->userdata['compare_data']['link_url']);
	$link_set_url = explode(',',$this->session->userdata['compare_data']['link_set_url']);
?>
<footer>

<div class="footer-bg clearfix">

<div class="container">

<div class="row">

<div class="col-sm-3">

<h4> About Us</h4>

<p> <?php 
$cms_Details = $this->front_model->cms_content('about-us');
$big=  $cms_Details[0]->cms_content;
echo $small = substr($big, 0, 250);
?></p>
<?php 
	$off = $this->session->userdata('offline_user_id');
	if($off==""){
 ?>
<form action="" method="post" onsubmit="return false;" id="newsletter-validate-detail1">
 

  <a href="<?php echo base_url(); ?>offline_register" class="btn btn-danger bor-rad-0 "> Offline Register</a>
  
</form>

<br>

<ul class="list-unstyled clearfix foot-list">

  <li><a rel="" title="Offline Login" href="javascript:;"><i data-target="#myModal12" data-toggle="modal" class="fa fa-sign-in"> Offline Login</i></a></li>
               
</ul>

<!-- <p style="font-size:16px;margin-left:10px;">
  <i data-target="#myModal12" data-toggle="modal" class="fa fa-sign-in"> Offline Login</i>
</p> -->
<?php } ?>
</div>

<div class="col-sm-3">

<h4> INFORMATION </h4>

<ul class="list-unstyled clearfix foot-list">

					<?php 
					$result = $this->front_model->sub_menu();
					$k = 1;
					foreach($result as $view)
					{
					?>
                    <li><a href="<?php echo base_url();?>cms/<?php echo $view->cms_title;?>" title="<?php echo $view->cms_heading;?>" rel="nofollow"><?php echo $view->cms_heading;?></a></li>
                    <?php 
					$k++; 
					} 
					if($enable_blog=='1')
					{
					?>
                    <li><a href="<?php echo blog_url;?>" title="Blog" rel="nofollow">Blog</a></li>
					<?php
					}?>
					<li><a href="<?php echo base_url();?>cms/faq" title="Faq">FAQ</a></li>
                    
                    



</ul>

</div>

<!--<div class="col-sm-2">

<h4> OUR SERVICES </h4>

<ul class="list-unstyled clearfix foot-list">

<li> <a href="#"> Delivery Information</a></li>

<li> <a href="#">Shipping </a></li>

<li> <a href="#">Product Return </a></li>

<li> <a href="#">Faqs </a></li>

<li> <a href="#">About Us </a></li>

</ul>

</div>-->

<div class="col-sm-3">

<h4> Top Categories </h4>

<ul class="list-unstyled clearfix foot-list">

<?php
				$categories =$this->front_model->get_productcategories(7);
				$kt=1;
				if($categories)
				{
					foreach($categories as $view)
					{	
						if($view->category_name)
						{
				?>
                <li> <a href="javascript:void(0);" onClick="runcheck_1('category/<?php echo $view->category_url; ?>');" title="<?php echo $view->category_name;?>" target="_blank;"><?php echo $view->category_name;?></a></li>
				<?php
						}
					$kt++;
					}
				}
				?>    
                
                

<!--<li> <a href="#">My Account</a></li>

<li> <a href="#">Privacy Policy </a></li>

<li> <a href="#">Cart</a></li>

<li> <a href="#">Checkout </a></li>

<li> <a href="#">Shipping </a></li>-->

</ul>

</div>

<div class="col-sm-3">

<h4> NEWS LETTER</h4>

<p>Sign up for Newsletter & promotion</p>

<form action="" method="post" onsubmit="return false;" id="newsletter-validate-detail1">
  <input type="email" required="required" placeholder="Enter your email address"  size="18" name="email" id="emails" class="form-control bor-rad-0 mar-bot">
  <button class="btn btn-danger bor-rad-0" id="news_letter_submit" type="button" onClick="email_sub();"> <span>Subscribe</span> </button>
  <a href="javascript:void(0)" class="btn btn-danger bor-rad-0 "> Download App</a>
  <div id="msg" style="color:green;padding: 0 65px;"></div>
</form>
      <br>
<ul class="list-unstyled clearfix foot-list">
<a href="<?php echo base_url();?>contact_me" class="btn btn-danger bor-rad-0 "> Contact us</a>
</ul>        
              

</div>

</div>

</div>

</div>

<div class="copyright-bg">

<div class="container">

<div class="row">

<div class="col-md-12 col-sm-12">

<!--<p class="text-center"> © 2016 All Discount Sale. All Rights Reserved</p>
-->
<p class="text-center">Copyright © <?php echo date('Y');?> <a href="<?php echo base_url();?>"><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></a>. All rights reserved.</p>
 
 

</div>



</div>

</div>

</div>

</footer>



<div >
<input type="hidden" id="setcompids" value="" >
<div class="col-md-6 col-sm-6 col-xs-3"  id="musicinfo" style="display:none;">

<div class="cls_slider_box" style="background: #fff none repeat scroll 0 0;bottom: 0;display: block; position: fixed;z-index: 9999; width: 42%;">
<div class="cls_inbox_close"> <a href="javascript:void(0);" onclick="overallhide();"><i class="fa fa-close"></i></a> </div>
<div class="">



					<div class="cls_img_bottom blockng <?php if($product_id[0]=="") {?>empty<?php } ?>" data-id_block="product_1" style="vertical-align:middle;" <?php if($product_id[0]!="") {?> id="product_comp_<?php echo $product_id[0]; ?>"<?php } ?>>
					
                     <input class="cls_input_compare project1" id="proid1" type="text" placeholder="Add Product" <?php if($product_id[0]!="") {?>style="display:none;"<?php } ?> >
					
					 <div class='product_comp'>
					 <?php if($product_id[0]!="") {?>
						<div class="cls_inbox_close">
						
						<a onclick="closedivsingle(<?php echo $product_id[0]; ?>)" id="<?php echo $product_id[0]; ?>"  href="javascript:void(0);" class="occupiedclose occupcls_'<?php echo $product_id[0]; ?>" > <i class="fa fa-close"></i> </a> 
						</div>
						<div class="left-block occupied" style="min-height: 63px;">
						
						<a title="<?php echo $title[0]; ?>" href="<?php echo $link_url[0]; ?>" class="bigpic_21_tabcategory product_image">
						<input type="hidden" class="sortenurl" value="<?php echo $link_set_url[0]; ?>">
						<img width="35" height="auto" src="<?php echo $img_url[0]; ?>" class="img-responsive center-block"></a>
						</div>
						<p class="occupied"><a href="'+link_url+'"><?php echo $title[0]; ?></a></p><div class="rate occupied"> <?php echo $price[0]; ?> </div> 
					 <?php } ?>
					 </div>
                    </div>
					
					<div class="cls_img_bottom blockng <?php if($product_id[1]=="") {?>empty<?php } ?>" data-id_block="product_2" <?php if($product_id[1]!="") {?> id="product_comp_<?php echo $product_id[1]; ?>"<?php } ?> >
					
					    <input class="cls_input_compare project2" id="proid2" type="text" placeholder="Add Product" <?php if($product_id[1]!="") {?>style="display:none;"<?php } ?>>
					
						<div class='product_comp'>
						 <?php if($product_id[1]!="") {?>
						<div class="cls_inbox_close">
						
						<a onclick="closedivsingle(<?php echo $product_id[1]; ?>)" id="<?php echo $product_id[1]; ?>"  href="javascript:void(0);" class="occupiedclose occupcls_'<?php echo $product_id[1]; ?>" > <i class="fa fa-close"></i> </a> 
						</div>
						<div class="left-block occupied" style="min-height: 63px;">
						
						<a title="<?php echo $title[1]; ?>" href="<?php echo $link_url[1]; ?>" class="bigpic_21_tabcategory product_image">
						<input type="hidden" class="sortenurl" value="<?php echo $link_set_url[1]; ?>">
						<img width="35" height="auto" src="<?php echo $img_url[1]; ?>" class="img-responsive center-block"></a>
						</div>
						<p class="occupied"><a href="'+link_url+'"><?php echo $title[1]; ?></a></p><div class="rate occupied"> <?php echo $price[1]; ?> </div> 
					 <?php } ?>
						</div>
                    </div>
					
					<div class="cls_img_bottom blockng <?php if($product_id[2]=="") {?>empty<?php } ?>" data-id_block="product_3" <?php if($product_id[2]!="") {?> id="product_comp_<?php echo $product_id[2]; ?>"<?php } ?>>
					
					<input class="cls_input_compare project3" id="proid3" type="text" placeholder="Add Product" <?php if($product_id[2]!="") {?>style="display:none;"<?php } ?>>
					
						<div class='product_comp'>
						 <?php if($product_id[2]!="") {?>
						<div class="cls_inbox_close">
						
						<a onclick="closedivsingle(<?php echo $product_id[2]; ?>)" id="<?php echo $product_id[2]; ?>"  href="javascript:void(0);" class="occupiedclose occupcls_'<?php echo $product_id[2]; ?>" > <i class="fa fa-close"></i> </a> 
						</div>
						<div class="left-block occupied" style="min-height: 63px;">
						
						<a title="<?php echo $title[2]; ?>" href="<?php echo $link_url[2]; ?>" class="bigpic_21_tabcategory product_image">
						<input type="hidden" class="sortenurl" value="<?php echo $link_set_url[2]; ?>">
						<img width="35" height="auto" src="<?php echo $img_url[2]; ?>" class="img-responsive center-block"></a>
						</div>
						<p class="occupied"><a href="'+link_url+'"><?php echo $title[2]; ?></a></p><div class="rate occupied"> <?php echo $price[2]; ?> </div> 
					 <?php } ?>
						</div>  
                    </div>
					<div class="cls_img_bottom blockng <?php if($product_id[3]=="") {?>empty<?php } ?>" data-id_block="product_4" <?php if($product_id[3]!="") {?> id="product_comp_<?php echo $product_id[3]; ?>"<?php } ?>>
					
					<input class="cls_input_compare project4" id="proid4" type="text" placeholder="Add Product" <?php if($product_id[3]!="") {?>style="display:none;"<?php } ?>>
					
						<div class='product_comp'>
						 <?php if($product_id[3]!="") {?>
						<div class="cls_inbox_close">
						
						<a onclick="closedivsingle(<?php echo $product_id[3]; ?>)" id="<?php echo $product_id[3]; ?>"  href="javascript:void(0);" class="occupiedclose occupcls_'<?php echo $product_id[3]; ?>" > <i class="fa fa-close"></i> </a> 
						</div>
						<div class="left-block occupied" style="min-height: 63px;">
						
						<a title="<?php echo $title[3]; ?>" href="<?php echo $link_url[3]; ?>" class="bigpic_21_tabcategory product_image">
						<input type="hidden" class="sortenurl" value="<?php echo $link_set_url[3]; ?>">
						<img width="35" height="auto" src="<?php echo $img_url[3]; ?>" class="img-responsive center-block"></a>
						</div>
						<p class="occupied"><a href="'+link_url+'"><?php echo $title[3]; ?></a></p><div class="rate occupied"> <?php echo $price[3]; ?> </div> 
					 <?php } ?>
						</div> 
                    </div>


<div class=""  style="width: 100px; float: left;color:white;">
<div class="" style="margin-top:33px;">
            <input type="button" title="Compare"  id="compareall" value="Compare" class="btn btn-default btn-sm btn-block">
            <input type="button" title="Remove All" id="removeall" value="Remove All" class="btn btn-default btn-sm btn-block">
        </div>
		</div>
		
</div>
</div>
</div>
</div>
<?php  $this->load->view('front/js_scripts');?>


<script>
//Start Email subscribe
function email_sub()
{
	var email = $("#emails").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
	if(!email || !emailReg.test(email))
		$('#emails').css('border', '2px solid red');
	else
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cashback/email_subscribe/",
			data: {'email':email},
			success: function(msg)
			{
				if(msg==1)
				{
					$('#msg').text('Activated Successfully');
					$('#email').css('border', '');
				}
				else
				{
					$('#msg').text('Already Activated');
					$('#email').css('border', '');
				}	
			}
		});
	}	
}
function clears(val)
{
	if(val==1)
		$('#invite_mail').css('border', '');
	else
		$('#emails').css('border', '');
} 
//End Email subscribe
</script>


<script type="text/javascript">

</script>


<!--- footer ends here --->
