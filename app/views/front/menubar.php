<div id="magik-verticalmenu" class="block magik-verticalmenu">
	<div class="nav-title"> <span>My Account</span> </div>
	<div class="nav-content">
	  <div class="navbar navbar-inverse">
		<div id="verticalmenu" class="verticalmenu" role="navigation">
		  <div class="navbar">
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			  <!-- BEGIN NAV -->
			  <?php $uri = $this->uri->segment(2);
				$uri_3 = $this->uri->segment(3); ?>
			  <ul class="nav navbar-nav verticalmenu">
				<li class="parent <?php echo ($uri=="stores_list"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/favorites"><span>Favorite Stores</span><b class="round-arrow"></b></a></li>
				
				<li class="parent"> <a href="<?php echo base_url(); ?>cashback/click_history"><span>Click History</span><b class="round-arrow"></b></a> </li>
				
				<li class="parent <?php echo ($uri=="my_earnings"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/my_earnings"><span>Payment History</span><b class="round-arrow"></b></a></li>
				
				<li class="parent <?php echo ($uri=="refer_friends"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/refer_friends"><span>Refer A Friend</span><b class="round-arrow"></b></a> </li>
				
				<li class="parent <?php echo ($uri=="referral_network"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/referral_network"><span>Referral Network</span><b class="round-arrow"></b></a> </li>
			
				<li class="parent <?php echo ($uri=="missing_cashback"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/missing_cashback"><span>Missing Cashback</span><b class="round-arrow"></b></a></li>
				
				<li class="parent <?php echo ($uri=="add_withdraw"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/add_withdraw"><span>Withdraw Money</span><b class="round-arrow"></b></a></li>
				
				<li class="parent"> <a href="<?php echo base_url(); ?>cashback/myreviews"><span>My Reviews</span><b class="round-arrow"></b></a></li>
				
				<li class="parent <?php echo ($uri=="myaccount"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/myaccount"><span>Edit Profile</span><b class="round-arrow"></b></a></li>
				
				<!--<li class="parent <?php echo ($uri=="orders"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/orders"><span>Orders</span><b class="round-arrow"></b></a></li>-->
				
				<li class="parent <?php echo ($uri=="transations"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/transations"><span>Transactions</span><b class="round-arrow"></b></a></li>
				
				<li class="parent <?php echo ($uri=="support"?"active":""); ?>"> <a href="<?php echo base_url(); ?>cashback/support"><span>Support</span><b class="round-arrow"></b></a></li>
				
				<li class="parent"> <a href="<?php echo base_url(); ?>cashback/logout"><span>Logout</span><b class="round-arrow"></b></a></li>
			  </ul>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
<?php $headerimg1 = $this->front_model->getads('Sidebar-1'); ?>
<a href="<?php echo $headerimg1->ads_url?>">
<img src="<?php echo base_url(); ?>uploads/ads/<?php echo $headerimg1->ads_image?>" class="img-responsive mar-bot">
</a>