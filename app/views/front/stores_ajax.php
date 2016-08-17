<?php
$affid =  $store_details->affiliate_id;

	if($store_coupons!="")
	{
		$val_aj = $pagenum*20;
		$kt= $val_aj + 1;
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
			<?php
			$kt++;
			}
		
  
	}
?>
