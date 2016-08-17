<div class="col-md-3 col-sm-3">

<div class="left-aside mar-top20">
         
    <div class="left-navigation">
       
        <ul class="list-accordion">
            <?php $uri = $this->uri->segment(1);
                // echo $uri;die;
             ?>
                <li><a class="waves-effect <?php if($uri=='view_stores' || $uri=='update_stores'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>view_stores"><span class="nav-icon"><i class="fa fa-edit"></i></span><span>View Stores</span></a></li>
                
                <li><a class="hvr-sweep-to-bottom <?php if($uri=='add_offlinestores'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>add_offlinestores"><span class="nav-icon"><i class="fa fa-tasks"></i></span><span>Add Store</span></a></li>
                 <?php 
                    $offline_userid = $this->session->userdata('offline_user_id');
                    $store_id = $this->front_model->get_Stores($offline_userid);
                    if($store_id){
                 ?>
                 
                <li><a class="hvr-sweep-to-bottom <?php if($uri=='offline_products'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>offline_products"><span class="nav-icon"><i class="fa fa-money"></i></span><span>Add Products</span></a></li>
                  <?php } ?>

               <li><a class="hvr-sweep-to-bottom <?php if($uri=='offline_listofproducts'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>offline_listofproducts"><span class="nav-icon"><i class="fa fa-gear"></i></span><span>List of Products</span></a></li>

                <li><a class="hvr-sweep-to-bottom <?php if($uri=='view_coupons'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>view_coupons"><span class="nav-icon"><i class="fa fa-bars"></i></span><span>View Coupons</span></a></li>

                <li><a class="hvr-sweep-to-bottom <?php if($uri=='coupon_transaction'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>coupon_transaction"><span class="nav-icon"><i class="fa fa-money"></i></span><span>View Coupon Transactions</span></a></li>


                <li><a class="hvr-sweep-to-bottom <?php if($uri=='offline_change_password'){ ?> active <?php } ?>" href="<?php echo base_url(); ?>offline_change_password"><span class="nav-icon"><i class="fa fa-gear"></i></span><span>Change Password</span></a></li>
                
                <li><a class="hvr-sweep-to-bottom " href="<?php echo base_url(); ?>logout"><span class="nav-icon"><i class="fa fa-user-plus"></i></span><span>Logout</span></a></li>
                
              </ul>
        
    </div>

    </div>

</div>
