<div class="col-md-3" style="padding:10px;">
         
         <div class="left-aside">
         
         <div class="left-navigation">
         
        <ul class="list-accordion">
		<?php
			$method = $this->router->fetch_method(); // for method
		?>
               
                
                <li><a class="waves-effect <?php if($method=='my_earnings'){echo 'active';}?>" href="<?php echo base_url();?>my_earnings"><span class="nav-icon"><i class="fa fa-tasks"></i></span><span>My Earnings</span></a></li>
				
				 <li><a class="waves-effect <?php if($method=='myaccount'){echo 'active';}?>" href="<?php echo base_url();?>myaccount"><span class="nav-icon"><i class="fa fa-edit"></i></span><span>Account Settings</span></a></li>
				 
                
                <li><a class="waves-effect <?php if($method=='my_payments'){echo 'active';}?>" href="<?php echo base_url();?>my_payments"><span class="nav-icon"><i class="fa fa-money"></i></span><span>Payments</span></a></li>
                
                <li><a class="waves-effect <?php if($method=='missing_cashback'){echo 'active';}?>" href="<?php echo base_url();?>missing_cashback"><span class="nav-icon"><i class="fa fa-gear"></i></span><span>Missing Cashback</span></a></li>
                
                <li><a class="waves-effect <?php if($method=='refer_friends'){echo 'active';}?>" href="<?php echo base_url();?>refer_friends"><span class="nav-icon"><i class="fa fa-user-plus"></i></span><span>Refer Friends</span></a></li>

                 <li><a class="waves-effect <?php if($method=='my_coupons'){echo 'active';}?>" href="<?php echo base_url();?>my_coupons"><span class="nav-icon"><i class="fa fa-gift"></i></span><span>My Coupons</span></a></li>
                
                <li><a class="waves-effect <?php if($method=='referral_network'){echo 'active';}?>" href="<?php echo base_url();?>referral_network"><span class="nav-icon"><i class="fa fa-wrench"></i></span><span>Referral Network</span></a></li>                 
				
                <li><a class="waves-effect <?php if($method=='transations'){echo 'active';}?>" href="<?php echo base_url();?>transations"><span class="nav-icon"><i class="fa fa-suitcase"></i></span><span>Transactions</span></a></li>

				        <li><a class="waves-effect <?php if($method=='redemption'){echo 'active';}?>" href="<?php echo base_url();?>redemption"><span class="nav-icon"><i class="fa fa-gift"></i></span><span>Redemption</span></a></li>

				      <li><a class="waves-effect <?php if($method=='pending_transactions'){echo 'active';}?>" href="<?php echo base_url();?>pending_transactions"><span class="nav-icon"><i class="fa fa-gift"></i></span><span>Pending Transactions</span></a></li>

				    <li><a class="waves-effect <?php if($method=='favorites'){echo 'active';}?>" href="<?php echo base_url();?>favorites"><span class="nav-icon"><i class="fa fa-list-alt"></i>
</span><span>Favorites Products</span></a></li>                
              </ul>
        
    </div>
    </div>
         
</div>