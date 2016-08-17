<!DOCTYPE html>
<html lang="en">
<head>
  <?php
   //Storing the previous encoding in case you have some other piece 
   //of code sensitive to encoding and counting on the default value.      
   $previous_encoding = mb_internal_encoding();
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $store_details->meta_keyword;?></title>

<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); 
$admindetailss = $this->front_model->getadmindetails();
?>
</head>
<body>

<?php $this->load->view('front/header'); ?>
<p>&nbsp;</p>
<section class="inner-page-sec clearfix  contacts-index-index">

  <div class="container">
    
        <div class="row">
         <div class="side-col col-sm-3 col-md-3">
              <!-- Side Widget -->
              <div class="side-widget no-margin-l">
              
                <!-- ul-toggle -->
        <ul class="ul-toggle font-size-sm">
        <?php
          $categories = $this->front_model->get_all_categories(12);
        if($categories)
        {
          $kt1 = 1;
          foreach($categories as $view)
          {
            if($view->category_name)
            {
          ?>
                  <li><a href="javascript:void(0);" onClick="runcheck_1('<?php echo 'stores_list/'.$view->category_url;?>');"><i class="icon fa fa-angle-right"></i><?php echo $view->category_name;?></a></li>
                  <?php
            }
          $kt1++;
          }
        }
        else{
          echo 'No category available!';
        }
        ?>
      </ul>
                <!-- /ul-toggle -->
          
              </div>
              <!-- /Side Widget -->
              


            </div>

          <div class="col-md-9">
            
          
<div id="carousel-example-generic" class="carousel slide store-slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators red-bullet">
     <?php
      $store_details_img =  explode(",",$store_details->coupon_image);
        //print_r($store_details_img);
      if($store_details_img!="" && $store_details_img[0]!="")
      {
        
        $k=0;
        foreach($store_details_img as $images_list)
        {
        
      ?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $k; ?>" class="<?php if($k==0){ echo 'active'; } ?>"></li>
    <?php $k++;} } ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

 <?php
      $store_details_img =  explode(",",$store_details->coupon_image);
        //print_r($store_details_img);
      if($store_details_img!="" && $store_details_img[0]!="")
      {
        
        $k=1;
        foreach($store_details_img as $images_list)
        {
           
          $classse = "";
          if($k==1)
          {
            $classse = 'active';
          }
        
      ?>

    <div class="item <?php echo $classse;?>">
      <img src="<?php echo base_url();?>uploads/store_banner/<?php echo $images_list;?>" class="img-responsive center-block" style="height:300px;width:1500px;">
    </div>
   
   <?php
        $k++;
        }
      } 
       ?>
   
  </div>


</div>

          
<div class="row">

  <?php 
       $count_coupons = $this->front_model->count_coupons($store_details->affiliate_name);
      //print_r($count_coupons);
      
        if($store_details->affiliate_logo!='')
        {
          $img_url =base_url().'uploads/affiliates/'.$store_details->affiliate_logo;
        }
        else{
          $img_url =base_url().'front/img/rsz_default.jpg';
        }
      ?>

<div class="col-md-12">

<div class="box-bg clearfix">

<img src="<?php echo $img_url;?>" class="img-responsive center-block mar-top" style="height:80px;width:80px;">

<h2 class="text-center text-uppercase mar-top">
	
  <?php echo $store_details->affiliate_name;?> Coupons - <?php echo $count_coupons->counting;?> Offers  
          <?php 
           if($store_details->cashback_percentage!='')
           {
                   if($store_details->affiliate_cashback_type=="Percentage")
                  {
                    $cppercentage = $store_details->cashback_percentage."%";
                  }
                  else
                  {
                    $cppercentage = "Rs. ".$store_details->cashback_percentage;
                  }
                  
            ?> to Earn Upto <?php echo $cppercentage; ?> Extra Cashback <?php 
          }?>
        </h2>

        <span class="" id="longdisp" style="display:none;"><?php echo strip_tags($store_details->affiliate_desc);?></span>
        <span class="" id="aaa">
          <p id="shortdispdel"><?php echo substr(strip_tags($store_details->affiliate_desc),0,130); ?></p>
          <a onClick='showhidediv();' style='color:blue; cursor: pointer;' >
          <button type="button" value="submit" class="btn btn-danger bor-rad-0"> Read More</button>
        </a>
        </span>


     <!--  <button type="button" value="submit" class="btn btn-danger bor-rad-0"> Read More</button> -->

</div>

<div class="col-md-12 pad-no">
        <h4 class="popup-text  text-uppercase"> <?php echo $store_details->affiliate_name; ?> Reviews 
          <span class="pull-right">
           <?php  if($this->session->userdata('user_id')!=''){ ?>
            <a href="javascript:void(0);" data-target="#myModal-review" data-toggle="modal"class="btn-danger btn bor-rad-no"><i class="fa fa-pencil"></i>Add a review</a>
            <?php } else { ?>
            <a class="btn-danger btn bor-rad-no" href="javascript:void(0);" data-toggle="modal" data-target="#LoginModal_Review" target="_blank;"><i class="fa fa-sign-in pad-rht"></i> Add a review</a>
            <?php } ?>
          </span> 
        </h4>
            </div>

      <div class="row">
      <div class="col-md-12 mar-top">
      <?php 
      $reviews = $this->front_model->all_store_reviews($store_details->affiliate_id);
      if($reviews) { ?> 
      <a id="revshow" href="javascript:;" class="btn btn-primary bor-rad-no">View all reviews</a><?php } ?>
       <ul class="comments-list mar-top">
        <?php 
        if($reviews) {  $rr=0; foreach($reviews  as $review) { $rr++; ?>
        <li class="lirev" style="background:#f1f1f1; border:1px solid #ccc; <?php if($rr>1){ echo 'display:none;';} ?>">
          <article class="comment">
          <div class="comment-author">  </div>
          <div class="comment-inner"style="padding-left:18px;">
            <ul class="icon-group icon-list-rating comment-review-rate" style="float:right;padding-right:10px;">
            <li><?php
            //echo $review->ratings;
            for($i=0;$i<$review->rating;$i++) { ?>
            <i class="fa fa-star"></i> 
            <?php } ?></li>
            </ul>
            <h4 class="thumb-list-item-title"><a href="javascript:;"><?php
            $user = $this->front_model->edit_account($review->user_id);
            if($user){ echo $user->first_name; } else { echo 'User'; } ?></a></h4>
            <p class="thumb-list-item-author"><?php echo $review->comments; ?></p>
          </div>
          </article>
        </li><span class="lirev" <?php if($rr>1){ echo 'style="display:none;"';} ?>><hr></span>
        <?php } } else { ?>
          <li class="mar-top">No reviews found!</li><hr>
        <?php } ?>
        </ul>
      </div>
      </div>



<div class="col-md-12 clearfix">

<?php
      $affid =  $store_details->affiliate_id;
      
      if($store_coupons!="")
      {
        echo "<div id='sampleajax'>";
        $kt=1;
        foreach($store_coupons as $coupons)
        {
            $coupon_id = $coupons->coupon_id;
            $expiry_date = $coupons->expiry_date;
            $exp = date('m/d/Y',strtotime($expiry_date));
            $date = DateTime::createFromFormat('m/d/Y', date('m/d/Y'));
            $date1 = date_create($date->format('Y-m-d'));
            $date = DateTime::createFromFormat('m/d/Y', $exp);
            $date2 = date_create($date->format('Y-m-d'));
            $diff=date_diff($date1,$date2);
            $coupondate =  $diff->format("%a days");
        //exit;
      ?>

<div class="demo_container_item" style="background:#fafafa;border:solid 1px #ccc; padding:5px;">
      <?php        
        if($user_id!='')
        {?>
          <h5 style="line-height: 24px; text-align:center; font-weight: 700; font-size: 15px;" class="mar-top text-uppercase mar-bot30 text-center">
            <a data-toggle="modal" href="<?php echo base_url();?>stores/<?php echo $store_details->affiliate_name;?>" class="popup-text after_login" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>" target="_blank">

              <?php echo $coupons->title?> 
              <?php if($store_details->cashback_percentage!="")
            {
              if($store_details->affiliate_cashback_type=="Percentage")
              {
                $cppercentage = $store_details->cashback_percentage."%";
              }
              else
              {
                $cppercentage = "Rs. ".$store_details->cashback_percentage;
              } 
              
              if($coupons->cashback_description=='')
              {
                $admindetails = $this->front_model->getadmindetails_main();
                echo " + Get additional upto ".$cppercentage." Cashback from ".$admindetails->site_name;
              }
              else
              {
                
                echo " + ".$coupons->cashback_description;
              }
            }
            else
            {     
              if($coupons->cashback_description!='')
              {
                echo " + ".$coupons->cashback_description;
              }
            }?>
            from <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>

            </a>
            <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a> 
        <?php
        }else
        {?>
          <a href="<?php echo base_url();?>stores/<?php echo $store_details->affiliate_name;?>" class="popup-text dsf" target="_blank"  data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>"showcoupon_id="<?php echo $coupon_id;?>">
           <?php echo $coupons->title?> 
          <?php if($store_details->cashback_percentage!="")
          {
            if($store_details->affiliate_cashback_type=="Percentage")
            {
              $cppercentage = $store_details->cashback_percentage."%";
            }
            else
            {
              $cppercentage = "Rs. ".$store_details->cashback_percentage;
            } 
            
            if($coupons->cashback_description=='')
            {
              $admindetails = $this->front_model->getadmindetails_main();
              echo " + Get additional upto ".$cppercentage." Cashback from ".$admindetails->site_name;
            }
            else
            {
              
              echo " + ".$coupons->cashback_description;
            }
          }
          else
          {     
            if($coupons->cashback_description!='')
            {
              echo " + ".$coupons->cashback_description;
            }
          }?>
          from <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> 
          </a>
          <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
        <?php
        }
        ?>
          </h5>
    
    <p class="text-center mar-bot20 mar-top20"> 
      <?php
      /*    if($user_id=="")
          {
          ?>

          <a class="btn btn-primary bor-rad-no dsf" href="<?php echo base_url();?>cashback/codes/<?php echo $store_details->affiliate_name;?>/<?php echo $coupon_id; ?>" target="_blank" data-id="<?php echo base_url();?>cashback/visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>"> Join or Sign-in to get Offer </a> 

          <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a>  

          <?php
          }
          else
          { ?>
   
           <a class="btn btn-primary bor-rad-no after_login" href="<?php echo base_url(); ?>cashback/codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>"  target="_blank" data-id="<?php echo base_url();?>cashback/visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
           Click to activate Offer & visit site  
           </a>

            <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;">
            </a>  
          <?php
           } */
           
      if($coupons->type=='Promotion')
      {
        if($user_id!='')
        {
      ?>

       
 <!--  </p>
          <p class="text-center mar-bot30">-->
           <a  href="<?php echo base_url(); ?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>" class="popup-text after_login" target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
              <button class="btn btn-success">Get Deal </button>
          </a>

          <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a> 
          <?php
        }
        else
        {?>
          <a  href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name;?>/<?php echo $coupon_id; ?>" class="popup-text dsf" target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>"><button class="btn btn-success">Get Deal  </button></a>
          <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
      <?php
        }
      }
      else
      {
        if($user_id!='')
        {
        ?>
          <a  href="<?php echo base_url(); ?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>" class="popup-text after_login"  target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
            <button class="btn btn-primary">Show Code</button></a>

          <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a>
      <?php 
        }
        else
        {?>
          <a  href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name;?>/<?php echo $coupon_id; ?>" class="popup-text dsf" target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>"><button class="btn btn-primary"> Show Code </button></a>
          <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
      <?php
        }
      }
      ?>
           </p>
                     
      <div class="hovers text-center mar-top20" >

        <span class="hovers_item hovers_effect_13">
        <i class="hovers_icon icon-hover-home"></i>
          <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_how_to_get">How to Get this Offer</a>
        </span>
        
       <span class="hovers_item hovers_effect_13">
          <i class="hovers_icon icon-hover-mail"></i>
          <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_terms" >Terms &amp; Conditions</a>
        </span>
      
      <span class="hovers_item hovers_effect_13">
              <i class="hovers_icon icon-hover-calendar"></i>
          <span class="hovers_text">Expires in <?php echo $coupondate;?></span>
        </span>
      
      </div>
           
    </div>
  
   <!-- seetha-->
      <div class="modal cls_store_head fade cus_modal" id="myModal_visit_store<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg">
                  <div class="modal-content" id="newcontent<?php echo $kt;?>" style="display:block;"><!---->
          <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <div class="modal-header-default">
                        <div style="background: url('<?php echo base_url()."uploads/adminpro/".$admindetailss[0]->site_logo;?>') no-repeat scroll 0px 0px transparent; height: 69px; padding: 5px 0px 0px 271px;">
                            <p class="lead3 m-warning display-none" style="display: block;color:#000;">You're about to visit</p>
                            <h3 class="pull-right" style="position: relative; right: 8%; top: -28%;"><?php echo $store_details->affiliate_name;?></h3>
                        </div>                            
                        </div>
          </div>
                      
                      <div class="modal-body-default">
                      
            <span class="alert alert-block" style="display: block; font-size: 16px;line-height: 25px;">
              <span>
                <center>Your visit has been recorded. The cashback from any purchase(s) will soon show in your account.</center>
                            </span>
            </span>
            <center><span><?php echo $coupons->title;?></span><center><br>
            <?php
            if($coupons->type=='Promotion')
            {
            ?>
            <div class="cou-cl" >No Coupons available</div>
            <?php
            }else
            {?>
            <div class="cou-cl" ><?php echo $coupons->code;?></div>
            <?php } ?>
            <?php if($coupons->type=='Coupon') {?>
            <p>Copy and enter the coupon code at checkout!</p>
            <?php }?>
                            <?php
            /*  if($coupons->type!='Promotion')
              {
              ?>
                                <div style="display: block;" class="voucher-code display-none">
                                <p><?php echo $this->lang->line('voucher_code');?> &amp; <?php echo $this->lang->line('the_checkout');?></p>
                                <span> <?php echo $coupons->code;?></span>
                               </div>
                           <?php
              } */
               ?>
                      </div><br>
            <div class="modal-footer" style="display: block;">
            <div class="continue-hide m-non-warning display-none" style="display: block;margin-right: 29px;">
              <p class="copy-medium">           
                <a class="btn btn-primary bor-rad-no" href="<?php echo base_url();?>" target="_blank"> Continue shopping at <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>for more great offers  </a>
              <br>
              </p>
            </div>
            </div>
                       <hr>
                    </div>
                  </div>
            </div>

     

      <!-- seetha-->
      <!-- sharmi -->

      <div class="modal fade" id="LoginModal<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        
          <div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                      <img class="img img-responsive img-center" src="<?php echo base_url(); ?>/uploads/adminpro/15696logo.png" alt="logo">
                    </div>
                    </div>
                    <h2>Registered Customers</h2>
                    <p class="text-center padding-top-10 mar-top20">If you have an account with us, please &nbsp;<a href="javascript:;">Log in.</a></p>
                    
                    
                    <div class="row">
                                    <div class="center-block ftn padding-top-20">
                                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center>
                      <a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span>
                      </a>
                    </center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div>
                    
                    
                    <br>
                    
                    
                    <div class="row">
                          <center><span id="userstatus_ss" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                      <?php
                      //begin form
                      $attribute = array('role'=>'form','name'=>'login_form1','id'=>'login_form1','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login();');       
                      echo form_open('chk_invalid',$attribute);

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

                      <input type="hidden" name="signin" value="signin" id="signin" />       
            
                      <div class="form-group">

                         <input type="text" title="Email Address" class="form-control" id="email" value="" required name="email" placeholder="Email Address">

                     <!--    <input type="email" placeholder="Email Address" name="email" class="form-control" title="Email Address" required id="email"> -->

                      </div>
                      <div class="form-group">
                      <!-- <input type="password" title="Password" placeholder="Password" required minLength="6" id="pass" class="form-control validate-password" name="pwd"> -->

                      <input type="password" title="Password" placeholder="Password" required id="pass" minLength="6" class="form-control validate-password" name="pwd">

                      </div>
                      
                      <div class="row">
                    
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                      <div class="col-md-12">
                       <center> 
                       <input type="hidden" name="signin" value="signin" />
                      <input type="submit" class="btn btn-danger bor-rad-0" name="signin" title="Login" id="signin" value="Login">
                      </center>
                        </div>
                       <div class="col-md-6 padding-top-10"> </div>
                    </div>

                      
                    
                    <?php     
            //end form
            echo form_close();
            ?>     
                      <div class="row">
                      <div class="col-md-12">
                       <center> 
                       <a href="<?php echo base_url(); ?>visit_shop/<?php echo $store_details->affiliate_id; ?>/<?php echo $coupon_id; ?>">
                        <input type="submit" class="btn btn-primary bor-rad-0" style="margin-top:10px;" name="" title="Without cashback" id="" value="Else without cashback">
                      </a>
                      </center>
                        </div>
                       <div class="col-md-6 padding-top-10"> </div>
                    </div>            
                       </div>
                    </div>
                    
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>

      <!-- sharmi -->

      <?php
      $kt++;
      }
      echo "</div>";
      ?>
        </div>
      
       <div class="row">
 
      <div class="col-md-12">
       <a id="more_button" href="javascript:void(0);" class="uppercase full-width btn btn-lg btn-info center-block">load more</a> 
       <center>
        <a id="loader_more" style="display:none" class="full-width btn"><img src="http://www.phx.co.in/images/loading.gif" />
        </a>    
      </center>    
        <a id="more_button_null" style="display:none" class="uppercase full-width btn btn-lg btn-danger center-block">Sorry! No more results found</a>
          </div>
          </div>
    <?php   
    }
    else
    {
      ?>
      <div class="alert alert-danger bs-alert-old-docs">
                <center>
                  <strong>No Coupons  available in this time!!!</strong>
                </center>
            </div>
      <?php
    }
    ?>

      
       
   <!-- <div class="col-md-6">

<div class="demo_container_item">
      
          <h5 style="line-height: 24px; font-weight: 700; font-size: 15px;" class="mar-top text-uppercase mar-bot30 text-center"><a data-toggle="modal" href="#myModal" class="popup-text">Upto Rs.10000 Cashback LED TVs  + Get additional upto Rs. 4 Cashback from cashcraft</a></h5>
    
    <p class="text-center mar-bot20"> <a class="btn btn-primary bor-rad-no"> Join or Sign-in to get Offer </a>  
       
    </p>
          <p class="text-center mar-bot30"> <a  href="#" class="popup-text"><button class="btn btn-danger bor-rad-no"> Discount Added Automatically </button></a>
           </p>
                     
      <div class="hovers">
        
        
          <a href="#">How to Get this Offer |</a>
        
      
          <a href="#">Terms &amp; Conditions |</a>
      
      
          <a href="#">Expires in 75 days</a>
      
      </div>
           
    </div>
        </div>     --> 
    
</div>
 
            
                      </div>
        </div>
     
  </div>
  
  </div>
  <!-- How to get this Offer -->
<div class="modal fade" id="myModal_how_to_get" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">How to Get this Offer </h4>
      </div>
     
      <div class="modal-body">
      <p class="txt">
      <?php
    if($store_details->how_to_get_this_offer){
     echo $store_details->how_to_get_this_offer;
    }
    else{
    ?>
      
          <strong>Step 1:</strong> Join <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>.com Free &amp; login<br><br>
          <strong>Step 2:</strong> Click on the offer that you want. This will take you to <?php echo $store_details->affiliate_name;?>'s website. 
         <br><br>
         <strong>Step 3:</strong> Shop normally at <?php echo $store_details->affiliate_name?>. Pay as you normally do, including by Cash-on-delivery<br><br>
         <strong>Step 4:</strong> Your Cashback will track automatically &amp; be added to your <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> account within 48 hours
         <?php
    }
   ?>
     </p>
      </div>
       <hr>     
    </div>
  </div>
</div>   
 <!-- How to get this Offer -->
<!-- Store Terms & Conditions -->
<div class="modal fade" id="myModal_terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Terms & Conditions </h4>
      </div>
    
      <div class="modal-body">
      
       <?php
    if($store_details->terms_and_conditions){
     echo $store_details->terms_and_conditions;
    }
    else{
     ?>
           <ul>
                 <li><b><?php echo $store_details->affiliate_name?> does NOT accept any Missing Cashback Claims. Hence, we do not get paid for any missing transactions and are unable to pay you Cashback</b></li>
                    <li><b> Please add products in your <?php echo $store_details->affiliate_name?> cart only AFTER you click out of <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> &amp; not before. Else your Cashback will not track</b></li>
                        <li><b>Your cashback will track 4 days after your shipment has been dispatched for delivery</b></li>
                        <li><b> Cashback is not payable if you return or exchange, all or any part of your order. In all these cases Cashback for the full order will be Cancelled</b></li>
                        <li>Missing Cashback tickets for <?php echo $store_details->affiliate_name?> will be marked as Resolved as we are not allowed to forward them to <?php echo $store_details->affiliate_name?></li>
                        <li>Offer mentioned in this coupon is valid for a limited time only while stocks last</li>
                        <li>To earn Cashback, remember to login to <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>.com, click out to the ecommerce site through us &amp; then place your order</li>
                        <li>Complete your purchase in the same session after clicking from <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>.com</li>
                        <li>Cashback may not be paid on purchases made using store credits/gift vouchers</li>
                        <li>Do not visit any other price comparison, coupon or deal site in between clicking-out from <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> &amp; ordering on retailer's site</li>
                        <li>Only use Coupons available on <?php $admindetailssss = $this->front_model->getadmindetails_main(); echo $admindetailssss->site_name; ?> to ensure validity &amp; Cashback tracking. Restrictions may apply in some cases</li>
                        <li>Please ensure you follow T&amp;Cs and best practices listed at the end of this page to ensure Cashback tracks</li></ul>
         <?php
    }
         ?>
      </div>
       <hr>     
    </div>
  </div>
</div>
<!-- review model window-->


  <!-- log in pop up  -->
  
  <div class="modal fade" id="LoginModal_Review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        
          <div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                      <img class="img img-responsive img-center" src="<?php echo base_url(); ?>/uploads/adminpro/15696logo.png" alt="logo">
                    </div>
                    </div>
                    
                    <h2><center>Registered Customers</center></h2>
                    <p class="text-center padding-top-10 mar-top20">If you have an account with us, please &nbsp;<a href="javascript:;">Log in.</a></p>
                    
                    
                    <div class="row">
                      <div class="center-block ftn padding-top-20">
                        <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div>
                    
                    
                    <br>
                    
                    
                    <div class="row">
                          <center><span id="userstatus_ss" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                  <?php
       //begin form
        $attribute = array('role'=>'form','name'=>'login_form_Without','id'=>'login_form_Without','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login_Without();');       
        echo form_open('chk_invalid',$attribute);
        
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
            
                      <div class="form-group">
                        <input type="email" placeholder="Email Address" name="email" class="form-control" title="Email Address" required id="email">
                      </div>
                      <div class="form-group">
                      <input type="password" title="Password" placeholder="Password" required minLength="6" id="pass" class="form-control validate-password" name="pwd">

                      </div>
                      
                      <div class="row">
                      <!--<div class="col-md-8 col-sm-8">
                       <div class="check-b">
                      <input type="checkbox" name="cc" id="c1">
                    <label for="c1"><span></span>Remember Me</label>
                     </div>
                     </div>-->
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                     <input type="hidden" name="signin" value="signin" />
                    <input type="submit" class="btn btn-danger bor-rad-0" name="signin" title="Login" id="signin" value="Login">


</center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>
                    
                    
                    <?php     
      //end form
                    echo form_close();
                    ?>
                    </div>
                    </div>
                    
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>

  <!-- login pop up end -->

<!-- review model window-->
<input type="hidden" name="pagenum" id="pagenum" value="2">
<input type="hidden" name="store_name" id="store_name" value="<?php echo $store_details->affiliate_name?>">

</section>
<p>&nbsp;</p>

<div class="modal cls_store_head fade cus_modal" id="myModal-review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="newcontent<?php echo $kt;?>" style="display:block;"><!---->
    <div class="modal-header">
      <button aria-hidden="true" id="reviews_close" data-dismiss="modal" class="close" type="button">&times;</button>
      <div class="modal-header-default">
                                
      </div>
    </div>
      
      
      
      <div class="modal-body">
	  
	   <div align="center">  
      <img src="<?php echo base_url()."uploads/adminpro/".$admindetailss[0]->site_logo;?>" alt="logo">       
      </div> 
	  <div class="clearfix"></div><br>
      <form class="" id="revform" action="#" method="post" onSubmit="return funct_setpremium_cat();">
       <!--  <h3 class="pull-right" style="position: relative; right: 8%; top: -28%;"><?php echo $store_details->affiliate_name;?></h3>-->

      <div id="revcomments"></div>
        <div class="form-group clearfix">
          <label class="col-md-4">Write A Review </label>
          <div class="col-md-8">
          <textarea class="form-control" name="review_text" id="review_text"  rows="5"></textarea>
          </div>
        </div>
        <div class="form-group clearfix">
          <label class="col-md-4">Rating </label>
          <div class="col-md-8">
          <div class="rating">
            <input type="radio" id="star5"  name="rating" value="5" />
            <label for="star5">5 stars</label>
            <input type="radio" id="star4"   name="rating" value="4" />
            <label for="star4">4 stars</label>
            <input type="radio" id="star3"   name="rating" value="3" />
            <label for="star3">3 stars</label>
            <input type="radio" id="star2"   name="rating" value="2" />
            <label for="star2">2 stars</label>
            <input type="radio" id="star1"   name="rating" value="1" />
            <label for="star1">1 star </label>
          </div>
          </div>
        </div>
        <div class="form-group clearfix">
          <div class="col-md-9 col-md-offset-3">
          <button class="btn btn-primary bor-rad-no" id="rev_sub" type="button" onclick="return funct_setpremium_cat();">Submit </button>
          </div>
        </div>
      </div>
        </form>
       <div class="modal-footer pad"> </div>    
    </div>
    </div>
  </div>

<?php $this->load->view('front/sub_footer'); ?>

<?php  $this->load->view('front/js_scripts');?>


<script>

$('#rev_sub').click(function(){
		$('#reviews_close').trigger('click');
		//$("div.modal-backdrop").remove();
		$('.modal-backdrop').removeClass('modal-backdrop fade in');
		 
   //$("#myModal-review").modal('hide');
		
	}); 

</script>



<script type="application/javascript">

function showhidediv()
{
  $('#longdisp').show();
  $('#aaa').hide();
  return false; 
}

 $('#rev_sub').click(function(){
		$('#reviews_close').trigger('click');
		//$("div.modal-backdrop").remove();
		$('.modal-backdrop').removeClass('modal-backdrop fade in');
		 
   //$("#myModal-review").modal('hide');
		
	}); 

/* function open_in_new_tab(url )
{
  var win=window.open(url, '_self');
  win.focus();
} */
//before login
$('.dsf').click(function(){ 
  var url = ($(this).attr('data-id'));
  var showcoupon_id = ($(this).attr('showcoupon_id'));
  //alert(showcoupon_id);
  var win=window.open(url, '_self');
  win.focus();
  sessionStorage["StorePopupShown"] = 'yes';
  sessionStorage["Storeshowcoupon_id"] = showcoupon_id;
  
})
//after login sections
$('.after_login').click(function(){ 
  //alert('seeha');
  var url1 = ($(this).attr('data-id'));
  var show_id = ($(this).attr('show_id'));
  //alert(show_id);
  var win=window.open(url1, '_self');
  win.focus();
  sessionStorage["StorePopupShown1"] = 'yes';
  sessionStorage["Storeshow_id"] = show_id;
  
})
$().ready(function(){
  
  if(sessionStorage["StorePopupShown1"] == 'yes') 
  { 
    sessionStorage["StorePopupShown1"] = 'no';
    sessionStorage["Storeshow_id"] = '';
    //$("div#myModal_visit_store"+sessionStorage["show_id"]).modal({backdrop: 'static',keyboard: false});
    $("#show_modal_"+sessionStorage["Storeshow_id"])[0].click();    
    sessionStorage["StorePopupShown1"] = 'no';
    sessionStorage["Storeshow_id"] = '';
  } else {
    sessionStorage["Storeshow_id"] = '';
  } 
  
  //before login
  if(sessionStorage["StorePopupShown"] == 'yes') 
  { 
    //alert(sessionStorage["Storeshowcoupon_id"]);
    //$("div#myModal_visit_store"+sessionStorage["showcoupon_id"]).modal({backdrop: 'static',keyboard: false});
    sessionStorage["StorePopupShown"] = 'no';
    sessionStorage["Storeshowcoupon_id"] = '';
    $("#show_loginmodal_"+sessionStorage["Storeshowcoupon_id"])[0].click();     
    sessionStorage["StorePopupShown"] = 'no';
    sessionStorage["Storeshowcoupon_id"] = '';
  } else {
    sessionStorage["Storeshowcoupon_id"] = '';
  } 
})
$(".without_viji").click(function(){
  //jQuery("div#LoginModal").modal('hide');
  $( ".login" ).trigger( "click" );

})
$(function () { 
$("#more_button").click(function(){
  $('#loader_more').show();
  $("#more_button").hide();
  var pagenum = $('#pagenum').val();
//  var pagenum = 1;
  var store_name = $('#store_name').val();
  $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>cashback/store_ajax/'+pagenum+'/'+store_name,
       success:function(result){
        if(result!=0)
        {
          $('#loader_more').hide();
          $('#sampleajax').append(result);
          var updated_page_num = parseInt(pagenum)+parseInt(1);
          $('#pagenum').val(updated_page_num);
          $("#more_button").show();
        }
        else
        {
          $('#loader_more').hide();
          $("#more_button").hide();
          $("#more_button_null").show();          
        }
      }
    });
});
});

function funct_setpremium_cat()
 {   
  //alert('sasas_1');
  if($("#review_text").val()=='')
  {
    // alert("<?php echo $this->lang->line('rev_val1');?>");
    alert("Please Add your reviews");
    return false;
  }
  if($('input:radio[name=rating]:checked').length == 0){
    // alert("<?php echo $this->lang->line('rev_val2');?>");
    alert("Please Add your Ratings");
    return false;
  }
  
  var review_text_new = $("#review_text").val();
  var radio_rating = $("input:radio[name=rating]:checked").length;
  var radio_ratings = $("input:radio[name=rating]:checked").val();
  var store = '<?php echo $store_details->affiliate_id; ?>';
  $.ajax({
  url:"<?php echo base_url(); ?>cashback/submit_store_ratings",
  data: "comments="+ review_text_new + "&rating=" + radio_ratings +"&store="+store,    
  type:"POST",
  success:function(msg)
  {  
  
    //$('#reviews_close').trigger('click');
     $('.comments-list').before('<div class="alert alert-success revlist"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <b>Success!</b> Your review has been submitted.</div>'); 
    $('#revcomments').html('<div class="alert alert-success revlist"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <b>Success!</b>Your review has been submitted.</div>');
    // $('#myModal-review').css('display','none');
    // $('.revlist').delay(2000).fadeOut();
    // $('.modal-backdrop').remove();
    $('#revform').trigger('reset');
     
  }  
  });  

}
function scrolling(){

  $('html, body').animate({
        scrollTop: $("#scrollingelm").offset().top
    }, 2000);
}
$('#revshow').click(function(){
  $('.lirev').show();
  $('#revshow').hide();
});
function setupajax_login()
{
  var datas = $('#login_form1').serialize();
  //alert(datas);
   jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>cashback/logincheck",
        data: datas,
        cache: false,
        success: function(result)
        {
          if(result!=1)
          {
            $('#userstatus').html(result);
            return false;
          }
          else
          {
            <?php $redirect_urlset =  base_url(uri_string());?>
            window.location.href = '<?php echo $redirect_urlset; ?>';
            return false;
          }             
        }
      });
            
  return false;
}
function setupajax_login_review()
{
  var datas = $('#login_form_review').serialize();
  //alert(datas);
   jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>cashback/logincheck",
        data: datas,
        cache: false,
        success: function(result)
        {
          if(result!=1)
          {
            $('#userstatus1').html(result);
            return false;
          }
          else
          {
            <?php $redirect_urlset =  base_url(uri_string());?>
            window.location.href = '<?php echo $redirect_urlset; ?>';
            return false;
          }             
        }
      });
            
  return false;
}
</script>
<!-- reviews_close -->
</body>
</html>
