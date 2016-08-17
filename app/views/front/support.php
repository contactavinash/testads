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

 	<title>Support - <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
	<meta name="Description" content="Coupons"/>    
    <meta name="keywords" content="Coupons" /> 
	
    <meta name="robots" CONTENT="INDEX, FOLLOW" />
    
<!-- Bootstrap -->

<?php $this->load->view('front/css_script'); 
$admindetailss = $this->front_model->getadmindetails();

?>	

<link href="<?php echo base_url();?>front/css/hover.css" rel="stylesheet" type="text/css">
<style>
/* body {
	font-family: 'PT Sans', sans-serif;
	font-size:13px;
	line-height:20px;
	background:url(<?php echo base_url();?>front/images/body-bg_store.png) left top repeat;
} */
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
            <li class="home"> <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
            <li class="category34"> <strong>Support</strong> </li>
          </ul>
        </div>
        <!--col-xs-12--> 
      </div>
      <!--row--> 
    </div>
    <!--container--> 
  </div>
  
  <!-- Home Slider Block -->
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <div class="row">
      <div class="col-md-3 col-sm-3">
      
       <?php $this->load->view('front/menubar'); ?>
      
      </div>
        <div class="col-lg-9 col-sm-12 col-md-9">
        <?php
            $headerimg = $this->front_model->getads('Header');
            ?>
           <a href="<?php echo $headerimg->ads_url?>"> <img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg->ads_image?>" class="img-responsive mar-bot" alt=""></a>
        
      <h3> Members Support </h3>
      
      <div class="box-bg clearfix">
      
      <p>Get your questions answered! Please fill form below and we'll be happy to help you as soon as possible</p>
    
        
        <?php 
        echo $this->session->flashdata('msg');
        $attr = array('class'=>'suuport_form');
        echo form_open('cashback/support_submit_fro',$attr); ?>
                      <div class="uk-form-row">
                        <label for="register_username">Subject</label>
                        <input class="md-input subject" type="text" id="register_username" name="subject"/>
                      </div>
                     
                      <div class="uk-form-row">
                        <label for="register_username">Message</label>
                        <textarea class="md-input message" name="messgae" rows="3"></textarea>
                      </div>
                      
                      <div class="uk-margin-medium-top"> <a href="#" class="md-btn md-btn-danger sent">Send Message</a> </div>
                    </form>
                    
      </div>
      <?php if($messageslist){ ?>
       <h3> My Messages </h3>
      
      <div class="box-bg clearfix" style="height: 500px; overflow-y: scroll;">

        <?php

           foreach ($messageslist as $value) {?>
             <div class="comment clearfix">
                  <div class="comment-avatar">
                    <img alt="avatar" src="<?php echo base_url(); ?>uploads/user/no_photo.jpg" width="50" height="50" class="img-circle">
                  </div>
                  <header>
                    <h4><?php echo $value->subject; ?></h4><?php
                    if($value->type=='send'){ $sender = 'You'; }else { $sender = 'admin'; } ?>
                    <div class="comment-meta">By <a href="#"><?php echo $sender; ?></a> | <?php echo $value->datetime; ?></div>
                  </header>
                  <div class="comment-content">
                    <div class="comment-body clearfix" style="margin-left: 64px;">
                      <p><?php echo $value->content; ?> </p>
                      <a class="btn-sm-link link-dark pull-right" href="#"><i class="fa fa-reply"></i> Reply</a>
                    </div>
                  </div>
                    </div><?php                  
           }?>
      
                 
                  
                  <!-- comment end -->

                </div>
		<?php } ?>
      </div>
      
          
        </div>
       
      </div>
    </div>
  </div>
  

  
  <!--- NEWSLETTER -->


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

<script type="text/javascript">

$('.sent').click(function(){
  

  var subject = $('.subject').val();
  var message = $('.message').val();
  var flag = 0;

  if(subject=='')
  {
    $('.subject').css('border','1px solid red');
    flag =1;
  }
  else
  {
    $('.subject').css('border','');
  }

  if(message=='')
  {
    $('.message').css('border','1px solid red');
    flag =1;
  }
  else
  {
    $('.message').css('border','');
  }

  if(flag!=1)
  {
    $('.suuport_form').submit();
  }
return false;
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/jquery.validate.min.js"></script>       
</body>
</html>