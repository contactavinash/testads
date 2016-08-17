<?php
          //get coupons list
          //  //print_r($couponslist);
        if($couponslist){
          $kt=1;
          foreach($couponslist as $coupons)
          {
            $coupon_id = $coupons->coupon_id;
            $store_details =$this->front_model->get_Storedetails($coupons->offer_name);
          if($store_details)
          {
            $affiliate_name = $store_details->affiliate_name;
            $affid = $store_details->affiliate_id;
            $setup =  strtoupper($affiliate_name[0]);
            
            if($store_details->affiliate_logo!='')
            {
              $img_url =base_url().'uploads/affiliates/'.$store_details->affiliate_logo;
            }
            else{
              $img_url =base_url().'front/img/rsz_default.jpg';
            }
        ?>
	<div class="col-sm-6 col-md-4 col-xs-12 isotope-item <?php echo $setup;?>">

	  <div class="item first products-grid stores-bg" style="height:320px;">                   
		  <div class="_item first product-col">
			<div class="wrap-item">
			  <div class="product-block">
				<div class="image ">
				  <div class="product-img img">
					<?php
					  if($user_id!='')
					{?>
					<a href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>/coupons" target="_blank;" class="product-image img after_login" title="<?php echo $affiliate_name;?>" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">

					  <img style="height:50px;width:111px;" src="<?php echo $img_url;?>"  class="img-responsive center-block">
					</a>
					
					<a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a> 
					  <?php
					  }else
					  {?>
						<a href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>/coupons"  target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" class="product-image img dsf" title="<?php echo $affiliate_name;?>" showcoupon_id="<?php echo $coupon_id;?>">

						<img style="height:50px;width:111px;"  src="<?php echo $img_url;?>"  class="img-responsive center-block"></a>
						<a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
					  <?php 
					  } ?>
				  
					<p class="text-center mar-top"><span class="price "><?php echo $affiliate_name;?></span> </p>
				  </div>
				</div>
				<div class="product-meta product-shop">
				  <h3 class="product-name name">
	<?php
	if($user_id!='')
	{?>
	  <a class="after_login" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>/coupons" target="_blank;" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>"><?php echo substr($coupons->title,0,45);?></a>

	  <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;">
	  </a>  
	<?php
	}
	else{
	?>
	  <a class="dsf" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>/coupons" target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>"><?php echo substr($coupons->title,0,45);?></a>

	  <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
	<?php
	}
	?>
	</h3>                              
				   <div class="cart mar-top">
<?php
	
if($coupons->type=='Promotion')
{
	if($user_id!='')
	{
?>                  

	  <a class="after_login" href="<?php echo base_url(); ?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>/coupons "  target="_blank" title="<?php echo $affiliate_name;?>"   data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">

	  <button type="button" title="<?php echo $affiliate_name;?>" class="btn btn-primary bor-rad-no btn-block mar-bot">Activate Deal</button>
	  </a>

	  <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;">
	  </a>

	<?php
	}else{
	?>

            <a class="dsf" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>/coupons" target="_blank" title="<?php echo $affiliate_name;?>"data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>">

            <button type="button" title="<?php echo $affiliate_name;?>" class="btn btn-primary bor-rad-no btn-block mar-bot">Activate Deal</button>
            </a>

          <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 

	  
	   
			<?php
			}
		}

		else{

		  if($user_id!='')
		  {
		?>                  
			  <a class="after_login" href="<?php echo base_url(); ?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>/coupons"  target="_blank" title="<?php echo $affiliate_name;?>"  data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
				
			  <button type="button" title="Add to Cart" class="btn btn-primary bor-rad-0 btn-block mar-bot">Show Code</button>
			  </a>   
								<a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a>                 
		  <?php
		  }else{
		  ?>
					  <a class="dsf" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?>/coupons" target="_blank" title="<?php echo $affiliate_name;?>"data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>">
					  <button type="button" title="<?php echo $affiliate_name;?>" class="btn btn-primary bor-rad-no btn-block mar-bot">Show Code</button>
					  </a>  
					  <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a>                 
				  <?php
				  }       

				}
				?>
				  </div>
				  <div class="action">
					<p class="wishlist text-center">
					<a class="btn btn-danger bor-rad-0 btn-block" data-target="#myModal_<?php echo $store_details->affiliate_url;?>" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-heart-o"></i>About Store</a> </p>
				</div>
				</div>
			  </div>
			</div>
		  </div>
	   </div>
	  </div>

	   <!-- model -->
        <div class="modal fade" id="myModal_<?php echo $store_details->affiliate_url;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">About <?php echo $store_details->affiliate_name; ?></h4>
                      </div>
                      
                      <div class="modal-body">
                        <p class="txt">
                          <?php
                  echo $store_details->affiliate_desc;
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

Since you chose ‘Continue without Cashback’, we won’t be able to credit you with any cashback amount. Sign-in or join Alldiscountsale to earn extra cashback every time you shop online through us!
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
                    
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
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
                        
                        <input type="submit" class="btn btn-primary bor-rad-0" style="margin-top:10px;" name="" title="Without cashback" id="" value="Else without cashback">
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
          } $kt++; 
        }
        } 
         
          ?>
          </div>