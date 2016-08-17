
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Salable Coupon Details | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>

</head>

<body>
<?php $this->load->view('front/header');?>


<div class="container">
<h3 class="text-center text-uppercase">Salable Coupon Details </h3>
<div class="bor bg-red"></div>

    <div class="row">
  
  <!--- breadcrumb sec ends here ---->
  <div class="col-md-4 col-sm-12 col-xs-12 image-container product-img-box">
    <div class="coupon_img">
        <img src="<?php echo base_url();?>uploads/category/<?php echo $coupon_id->coupon_image; ?>" class="img img-responsive cxou">
    </div>
  </div>
  <div class="col-md-8 col-sm-7" style="margin-top: 89px; !important">
    <div class="row">
      <div class="coupon-heading">
        <h5 class="text-uppercase"> <?php echo $store_name->store_name; ?> </h5>
       
        <p><?php echo $coupon_id->store_description;?></p>
      </div>
      <div class="coupon_btns">
      <ul class="list-inline nomargin fs0">
          <li class="inr_price"><?php echo DEFAULT_CURRENCY." ".$coupon_id->amount; ?></li>
		  <li class="inr_btn"><a href="<?php echo base_url(); ?>pay_nowsalable_coupons/<?php echo $coupon_id->coupon_id; ?>" class="btn btn-success bor-rad-0 ">PAY NOW </a></li>
      </ul>
      </div>
	  
      <div class="coupon_details">
      <ul class="list-inline nomargin fs0">
          
          <li class=""><i class="fa fa-phone"></i><?php echo $coupon_id->contact_details; ?></li>
          
      </ul>
	  
      </div>
	  <div class="coupon_details1">
      <ul class="list-inline nomargin fs0">
          
          <li class="">Expired On:<?php echo date('d-M-Y',strtotime($coupon_id->expiry_date)); ?></li>
          
      </ul>
	  
      </div>
    </div>    
  </div>
</div>
</div>
<section class="coupon_tab mar-top20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="all clearfix mar-bot20">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#User_Profile" aria-controls="User_Profile" role="tab" data-toggle="tab">Description</a></li>
            <li role="presentation"><a href="#Edit_Profile" aria-controls="Edit_Profile" role="tab" data-toggle="tab">Location</a></li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="User_Profile">
              <div class="row">
                  <div class="col-md-12">
                      <ul class="pad-li">
					  <li><i class="fa fa-chevron-right "></i> <?php echo $coupon_id->description; ?></li>
                        
                      </ul>
                  </div>
                  
              </div>
            </div>
            <div role="tabpane1" class="tab-pane" id="Edit_Profile">
              <div class="row">
                  <div class="col-md-12">
                      <ul class="pad-li">
					  <?php 
					  foreach($store_address as $address){
						  
						  ?>
					  
                        <li><i class="fa fa-chevron-right "></i><?php echo $address->address; ?> </li>
					  <?php } ?>
                        
                        
                      </ul>
                  </div>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<?php 
	$this->load->view('front/sub_footer');
	$this->load->view('front/site_intro');	
    $this->load->view('front/js_scripts'); 
 ?>

</body>
</html>
