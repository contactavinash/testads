<?php
if(!$redirect){
$redirect_url = redirect_handler($coupon,$store_details,$this->front_model);
} else {
$redirect_url = redirect_handler_store($redirect,$store_details,$this->front_model);;
}
// echo $redirect_url;die;
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="refresh" content="2; url=<?php echo $redirect_url; ?>" />
<title><?php $admindetailssss = $this->front_model->getadmindetails_main(); echo $admindetailssss->site_name; ?></title>
    
<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>	

<link href="<?php echo base_url();?>front/css/hover.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->

<div id="content">

            
<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
        
         <div class="loading-sec clearfix">
         
         <div class="row box-bg clearfix">
         
         <div class="col-md-10 col-md-offset-1">
         
         <div class="clearfix  mar40" style="background:padding: 10px;">
         
         <div class="row">
         
           <div class="col-md-3">
         
         <img src="<?php echo base_url();?>uploads/adminpro/<?php echo $admindetails[0]->site_logo;?>" class="img-responsive pull-left ">
         
         </div>
         
         <div class="col-md-6">
         
       <!-- <div class="spinner">
      <div class="rect1"></div>
      <div class="rect2"></div>
      <div class="rect3"></div>
      <div class="rect4"></div>
      <div class="rect5"></div>
    </div>-->
    <center>
<img src="<?php echo base_url();?>assets/img/redirect.gif">
</center>
         
         
         </div>
         
         <div class="col-md-3">
			 <?php 
				    if($store_details->affiliate_logo!='')
            {
              $img_url =base_url().'uploads/affiliates/'.$store_details->affiliate_logo;
            }
            else{
              $img_url =base_url().'front/img/rsz_default.jpg';
            }
			 ?>
         <img src="<?php echo $img_url;?>" class="img-responsive pull-left"> 
         
         </div>
         
         </div>
         
         </div>
         
         </div>
         
         <h2 class="text-center mar-bot20">CONGRATULATIONS, NOTHING MORE TO DO!</h2>
<h4 class="text-center mar-bot20 text-capitalize">Shop normally at <?php echo $store_details->affiliate_name;?>. Your cashback will automatically
get added in your <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> account within 72 hours.</h4>

<p class="text-center">If you are not automatically re-directed, please <?php echo anchor($redirect_url,'click here');?>    </p>
         
         </div>       
 
        
    </div>
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
