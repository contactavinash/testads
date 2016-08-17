<?php $user_id = $this->session->userdata('user_id');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Coupons | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>

<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();
?>


</head>

<body>
<?php $this->load->view('front/header');?>
<!-- header ends here --->

<!--<section class="breadcrumb-sec clearfix">
  <div class="container">
    <div class="breadcrumb clearfix"> <a href="<?php echo base_url();?>" class="home">home</a> <span class="navigation-pipe">&gt;</span> Coupons</div>
  </div>
</section>-->



<section class="inner-page-sec">
  <div class="container">    
        <div class="row">
          <!--<div class="side-col col-sm-3 col-md-3">
             
              <div class="side-widget no-margin-l">
              
               
                <ul class="ul-toggle font-size-sm">
        <?php
          $categories = $this->front_model->get_all_categories(15);
        if($categories)
        {
          $kt1 = 1;
          foreach($categories as $view)
          {
            if($view->category_name)
            {
          ?>
                  <li><a href="javascript:void(0);" onClick="runcheck_1('<?php echo 'top_cashback/'.$view->category_url;?>');"><i class="icon fa fa-angle-right"></i><?php echo $view->category_name;?></a></li>
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
                
          
              </div>
             
              


            </div>-->



          <div class="col-md-12">
            <div class="fil_bg">

               <div class="row mar-top10">
    <div class="col-md-3">
      <a href="<?php echo base_url(); ?>stores_list">
      <button class="btn btn-danger btn-block  bor-rad-0" type="button">Top Stores</button>
    </a>
    </div>

<div class="col-md-3">
    <a href="<?php echo base_url(); ?>coupons">
      <button type="button" class="btn btn-info btn-block  bor-rad-0 ">Coupons</button>
    </a>
    </div>

<div class="col-md-3">
    <a href="<?php echo base_url(); ?>salable_coupons">
      <button type="button" class="btn btn-primary btn-block  bor-rad-0 ">Salable Coupons</button>
    </a>
    </div>


<div class="col-md-3">
    <a href="<?php echo base_url(); ?>top_cashback">
      <button type="button" class="btn btn-warning btn-block bor-rad-0">Top cashbak</button>
    </a>
    </div>
  </div>
  <br>
            
     <div class="row">

     

          <div class="col-md-12" style="padding:10px;">
    <?php
    if($couponslist)
    {
    ?>
            <div class="filters">
              <ul class="nav nav-pills">
                <li class="active"><a data-filter="*" href="#">All</a></li>
                 <?php
                foreach (range('A', 'Z') as $char) {
                    echo '<li class=""><a data-filter=".'.$char . '"  href="#">'.$char . '</a></li>';
                }
        ?>
              </ul>
            </div>
            <div class="col-md-11 col-md-offset-3">
         <!--    <form id="filter" action="" method="post">
              <div class="form-search" style="z-index:99;">
                <label for="search_category">Search:</label>
                <div class="box-search-select">
                
                  <input type="text" autocomplete="off" id="search"  class="input-text  ui-autocomplete-input" value="" placeholder="Search ...">
                  <input type="hidden" id="" name="cat" oninput="return search_name(this.value);">
                  
           
                
          <div id="search_autocomplete" class="search-autocomplete"></div>
                  
                  
                
                </div>
              </div>
            </form> -->
          </div>
            <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="img-boxes isotope-container">
			  <div id="msg-box" class="text-center" style="display:none; background-color:pink;">No Results Found!!</div>

<br>			  
              
              <div class="row">
                
                <?php
          //get coupons list
          //  //print_r($couponslist);
          $kt=1;
          foreach($couponslist as $coupons)
          {
			  
            $coupon_id = $coupons->coupon_id;
            // $store_details =$this->front_model->get_Storedetails($coupons->offer_name);
             $date = date('Y-m-d');
          if($coupons->start_date==$date){
          if($coupons->coupon_type=='1')
           {
           $affiliate_name = $coupons->offer_name ;
            
            /*$affiliate_name = $store_details->affiliate_name;
            $affid = $store_details->affiliate_id;*/
            $setup =  $affiliate_name[0];
            
            if($coupons->coupon_image!='')
            {
              $img_url =base_url().'uploads/category/'.$coupons->coupon_image;
            }
            else{
              $img_url =base_url().'front/img/rsz_default.jpg';
            }
        ?>
	<div class="col-sm-6 col-md-3 col-xs-12 isotope-item <?php echo $setup;?>">

	  <div class="item first products-grid stores-bg" style="height:380px;">                   
		  <div class="_item first product-col">
			<div class="wrap-item">
			  <div class="product-block">
				<div class="image ">
				  <div class="product-img img">
					   <span class="new">Salable</span>
             
           <?php  $uri_string = base_url()."paysalable_coupons/".($coupon_id); ?>

					<a <?php if($user_id=="")
                    {?> data-toggle="modal" data-target="#myModal11" onclick="return get_url('<?php echo $uri_string; ?>');"<?php }else{ ?> class="after_login" href="<?php echo base_url(); ?>paysalable_coupons/<?php echo ($coupon_id); ?>" <?php } ?>>
           
					  <img style="height:110px;width:111px;" src="<?php echo $img_url;?>"  class="img-responsive center-block">
					</a>
				  
					<p class="text-center mar-top"><span class="price ">
            <?php echo $coupons->offer_name;?></span> </p>
				  </div>
				</div>
				<div class="product-meta product-shop">
				  <h3 class="product-name name">
		  <a <?php if($user_id=="")
                    {?> data-toggle="modal" data-target="#myModal11" onclick="return get_url('<?php echo $uri_string; ?>');"<?php }else{ ?> class="after_login" href="<?php echo base_url(); ?>paysalable_coupons/<?php echo ($coupon_id); ?>" <?php } ?>>
       <?php echo substr($coupons->description,0,44); ?>
    </a>

	</h3>
  <h4><b> <?php echo DEFAULT_CURRENCY.$coupons->amount; ?></b></h4>




				   <div class="cart mar-top">
   

           <a <?php if($user_id=="")
                    {?> data-toggle="modal" data-target="#myModal11" onclick="return get_url('<?php echo $uri_string; ?>');"<?php }else{ ?> class="after_login" href="<?php echo base_url(); ?>paysalable_coupons/<?php echo ($coupon_id); ?>" <?php } ?>>
              <button type="button" title="" class="btn btn-primary bor-rad-0 btn-block mar-bot">Buy Now</button>
          </a>   
				  </div>
				   <div class="action">
					<p class="wishlist text-center">
					<a class="btn btn-danger bor-rad-0 btn-block" data-target="#myModal_<?php echo $coupon_id;?>" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-heart-o"></i>About Store</a> </p>
				</div>
				</div>
			  </div>
			</div>
		  </div>
	   </div>
	  </div>

     <!-- model -->
        <div class="modal fade" id="myModal_<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">About <?php echo $coupons->offer_name; ?></h4>
                      </div>
                      
                      <div class="modal-body">
                        <p class="txt">
                        <?php
                        if($coupons->store_description)
                        {
                          echo $coupons->store_description;
                        }
                        else
                        {
                          echo 'No Description available!!!';
                        }
                        ?>
                        </p>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
        <!-- model -->

	   

        <!-- seetha-->
        <div class="modal cls_store_head fade cus_modal" id="myModal_visit_store<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog poplayer modal-lg">
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
            <div class="cou-cl"><a href="<?php echo base_url(); ?>">

Deal Activated. We have opened Paytm in the adjacent tab for you to avail this offer.

Since you chose ‘Continue without Cashback’, we won’t be able to credit you with any cashback amount. Sign-in or join Khojdeal to earn extra cashback every time you shop online through us!
i</a></div>
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
                    <h2><center>Registered Customers</center></h2>
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
                      $attribute = array('role'=>'form','name'=>'login_form1','id'=>"login_form1_".$coupon_id,'method'=>'post','class'=>'j-forms','onSubmit'=>"return setupajax_login('$coupon_id','$affiliate_name');");       
                      echo form_open('cashback/chk_invalid',$attribute);

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
                    
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>/cashback/forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                       <input type="hidden" name="signin" value="signin" />
                      <input type="submit" class="btn btn-success bor-rad-0" name="signin" title="Login" id="signin" value="Login" >

                      
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
                      <input type="submit" value="With out Cashback" id="signin" title="Without cashback" name="signin" class="btn btn-primary bor-rad-0" style="margin-top:10px;">
                      </a>
                    </center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>    
                       </div>
			   
                    </div>
                    
			<!--<div class="form-group"  id="without_shopping" style="display:block;"><center><a 
              target="_blank;" href="<?php echo base_url();?>cashback/visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>"  target="_blank" class="btn btn-danger without_viji" id="without_viji">ELSE CONTINUE WITHOUT CASHBACK</a></center>
              </div>   -->
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>



      <!-- sharmi -->
		
		
               
        
                <?php
          } }
          else if($coupons->start_date<=$date)
          {
            if($coupons->coupon_type=='1')
           {
              $affiliate_name = $coupons->offer_name ;
             $setup =  $affiliate_name[0];
            /*$affiliate_name = $store_details->affiliate_name;
            $affid = $store_details->affiliate_id;
            $setup =  strtoupper($affiliate_name[0]);*/
            
            if($coupons->coupon_image!='')
            {
              $img_url =base_url().'uploads/category/'.$coupons->coupon_image;
            }
            else{
              $img_url =base_url().'front/img/rsz_default.jpg';
            }
        ?>
  <div class="col-sm-6 col-md-3 col-xs-12 isotope-item <?php echo $setup;?>">

    <div class="item first products-grid stores-bg" style="height:380px;">                   
      <div class="_item first product-col">
      <div class="wrap-item">
        <div class="product-block">
        <div class="image ">
          <div class="product-img img">
             <span class="new">Salable</span>
           <?php  $uri_string = base_url()."paysalable_coupons/".($coupon_id); ?>

          <a <?php if($user_id=="")
                    {?> data-toggle="modal" data-target="#myModal11" onclick="return get_url('<?php echo $uri_string; ?>');"<?php }else{ ?> class="after_login" href="<?php echo base_url(); ?>paysalable_coupons/<?php echo ($coupon_id); ?>" <?php } ?>>
           
            <img style="height:110px;width:111px;" src="<?php echo $img_url;?>"  class="img-responsive center-block">
          </a>
          
          <p class="text-center mar-top"><span class="price ">
            <?php echo $coupons->offer_name;?></span> </p>
          </div>
        </div>
        <div class="product-meta product-shop">
          <h3 class="product-name name">
      <a <?php if($user_id=="")
                    {?> data-toggle="modal" data-target="#myModal11" onclick="return get_url('<?php echo $uri_string; ?>');"<?php }else{ ?> class="after_login" href="<?php echo base_url(); ?>paysalable_coupons/<?php echo ($coupon_id); ?>" <?php } ?>>
       <?php echo substr($coupons->description,0,44); ?>
    </a>

  </h3> 
  <h4><b> <?php echo DEFAULT_CURRENCY.$coupons->amount; ?></b></h4>                             
           <div class="cart mar-top">
   

           <a <?php if($user_id=="")
                    {?> data-toggle="modal" data-target="#myModal11" onclick="return get_url('<?php echo $uri_string; ?>');"<?php }else{ ?> class="after_login" href="<?php echo base_url(); ?>paysalable_coupons/<?php echo ($coupon_id); ?>" <?php } ?>>
              <button type="button" title="" class="btn btn-primary bor-rad-0 btn-block mar-bot">Buy Now</button>
          </a>   
          </div>
           <div class="action">
          <p class="wishlist text-center">
          <a class="btn btn-danger bor-rad-0 btn-block" data-target="#myModal_<?php echo $coupon_id;?>" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-heart-o"></i>About Store</a> </p>
        </div> 
        </div>
        </div>
      </div>
      </div>
     </div>
    </div>

     <!-- model -->
        <div class="modal fade" id="myModal_<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">About <?php echo $coupons->offer_name; ?></h4>
                      </div>
                      
                      <div class="modal-body">
                        <p class="txt">
                        <?php
                        if($coupons->store_description)
                        {
                          echo $coupons->store_description;
                        }
                        else
                        {
                          echo 'No Description available!!!';
                        }
                        ?>
                        </p>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
        <!-- model -->

     

        <!-- seetha-->
        <div class="modal cls_store_head fade cus_modal" id="myModal_visit_store<?php echo $coupon_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog poplayer modal-lg">
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
            <div class="cou-cl"><a href="<?php echo base_url(); ?>">

Deal Activated. We have opened Paytm in the adjacent tab for you to avail this offer.

Since you chose ‘Continue without Cashback’, we won’t be able to credit you with any cashback amount. Sign-in or join Khojdeal to earn extra cashback every time you shop online through us!
i</a></div>
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
                    <h2><center>Registered Customers</center></h2>
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
                      $attribute = array('role'=>'form','name'=>'login_form1','id'=>"login_form1_".$coupon_id,'method'=>'post','class'=>'j-forms','onSubmit'=>"return setupajax_login('$coupon_id','$affiliate_name');");       
                      echo form_open('cashback/chk_invalid',$attribute);

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
                    
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>/cashback/forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                       <input type="hidden" name="signin" value="signin" />
                      <input type="submit" class="btn btn-success bor-rad-0" name="signin" title="Login" id="signin" value="Login" >

                      
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
                       
                      <a href="<?php echo base_url(); ?>cashback/visit_shop/<?php echo $store_details->affiliate_id; ?>/<?php echo $coupon_id; ?>">
                      <input type="submit" value="With out Cashback" id="signin" title="Without cashback" name="signin" class="btn btn-primary bor-rad-0" style="margin-top:10px;">
                      </a>
                    </center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>    
                       </div>
         
                    </div>
                    
      <!--<div class="form-group"  id="without_shopping" style="display:block;"><center><a 
              target="_blank;" href="<?php echo base_url();?>cashback/visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>"  target="_blank" class="btn btn-danger without_viji" id="without_viji">ELSE CONTINUE WITHOUT CASHBACK</a></center>
              </div>   -->
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>



      <!-- sharmi -->
    
    
               
        
                <?php
          }
          }
           $kt++;}?>
                </div>       
                
              </div>
              
              </div>
            </div>
       <?php
    }
    else
    {
    ?>
      <div class="row">
              <div class="alert alert-danger bs-alert-old-docs">
                <center>
                  <strong>No Salable Coupons are available at this time!</strong>
                </center>
              </div>
            </div>
    <?php
    }?>
          </div>   
            
      </div>
    </div>
        </div>
     
  </div>
  
  </div>
</section>


<?php $this->load->view('front/sub_footer');

  
//Footer
  $this->load->view('front/site_intro');  
?>


<?php  $this->load->view('front/js_scripts');?>


<script type="text/javascript" src="<?php echo base_url();?>front/js/isotope.pkgd.min.js"></script>
<script>
// Isotope filters

if ($('.isotope-container').length>0) {
$(window).load(function() {
  var $container = $('.isotope-container').isotope({
    itemSelector: '.isotope-item',
    layoutMode: 'masonry',
    transitionDuration: '0.6s',
    filter: "*"
  });
  // filter items on button click
  $('.filters').on( 'click', 'ul.nav li a', function() {
    var filterValue = $(this).attr('data-filter');
    $(".filters").find("li.active").removeClass("active");
    $(this).parent().addClass("active");
    $container.isotope({ filter: filterValue });
	if ( !$container.data('isotope').filteredItems.length ) {
				$('#msg-box').show();
	}
  
				else{
					$('#msg-box').hide();
					}
    return false;
  });
});
};

function open_in_new_tab(url )
{
  var win=window.open(url, '_self');
  win.focus();
  //document.cookie="usern=seetha";
}
//before login
$('.dsf').click(function(){ 
  // alert('shsrmi');
  var url = ($(this).attr('data-id'));
  // alert(url);
  var showcoupon_id = ($(this).attr('showcoupon_id'));
  // alert(showcoupon_id);
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
    //$("div#myModal_visit_store"+sessionStorage["show_id"]).modal({backdrop: 'static',keyboard: false});
    sessionStorage["StorePopupShown1"] = 'no';
   sessionStorage["Storeshow_id"] = '';
    $("#show_modal_"+sessionStorage["Storeshow_id"])[0].click();    
    
  } else {
    sessionStorage["Storeshow_id"] = '';
    sessionStorage["StorePopupShown1"] = 'no';
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
function setupajax_login(ids,affid)
{
  var datas = $('#login_form1_'+ids).serialize();
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
            // alert(affid);
            // <?php $redirect_urlset =  base_url(uri_string());?>
            // window.location.href = '<?php echo $redirect_urlset; ?>';
            window.location.href = '<?php echo base_url(); ?>cashback/codes/'+affid+'/'+ids;
            return false;
          }             
        }
      });
            
  return false;
}

function search_name(){
  // alert('hgfjhgj');
var filterfrm=$("#filter").serialize();

$.ajax({
url: '<?php echo base_url();?>proffie/bro_job_ajax',
type: 'POST',
data:filterfrm,
beforeSend: function() {
$("#loading").show();
},
success: function(data)
{
$("#loading").hide();
$('#filterajax').html(data);
page_script();
}
});
}

function get_url(url)
{
  //alert(url);
  if(url!="")
  {
    $('#st_url').attr('href',url);
    $('#gt_url').val(url);
  }
  else
  {
    
    /*<?php $redirect_urlset =  base_url(uri_string()); ?>
    $('#st_url').attr('href','<?php echo $redirect_urlset; ?>');*/
    location.reload();
    
  }
  }
</script>

<!-- Initialization of Plugins -->

</body>
</html>
