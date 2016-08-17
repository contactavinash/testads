<?php $index = ''; // when we remove index.php comment this simply          <!--Nathan Hide details-->
$role_id=$this->session->userdata('admin_id');
$user_access = $this->session->userdata('user_access');
?>
<div id="sidebar" class="nav-collapse collapse">
<?php
// echo $_SERVER['REQUEST_URI'];
?>
	<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	<div class="sidebar-toggler hidden-phone"></div>

	<?php
		// $dashb = 'adminsettings/dashboard';
	?>
	<ul class="sidebar-menu">
		<li class="has-sub <?php 
		if((strpos($_SERVER['REQUEST_URI'],'adminsettings/dashboard') == true)|| (strpos($_SERVER['REQUEST_URI'],'adminsettings/settings') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/change_password') == true)){
		echo 'open'; } ?>">
		
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-dashboard"></i></span> Dashboard
				
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/dashboard') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/settings') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/change_password') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
		if((strpos($_SERVER['REQUEST_URI'],'adminsettings/dashboard') == true)|| (strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate_list') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliate_network') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaddaffiliate_list') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/settings') == true)|| (strpos($_SERVER['REQUEST_URI'],'adminsettings/payment_settings') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/change_password') == true)){
		echo 'style="display:block;"'; } ?>>
				<li class=""><a class="" href="<?php echo base_url().$index;?>adminsettings/dashboard">Dashboard</a></li>
				
				<?php if($role_id==1){ ?>
					<li><a class="" href="<?php echo base_url().$index;?>adminsettings/settings">Settings</a></li>
					<!--<li><a class="" href="<?php echo base_url().$index;?>adminsettings/payment_settings">Payment Settings</a></li>--><!--Nathan-->
                <?php } ?>
                <?php if(in_array('1',$user_access) OR $role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/change_password">Change Password</a></li>
				<?php } ?>
	
                
                <?php  /*if(in_array('2',$user_access) OR $role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliate_network">Affiliate Network</a></li>
				<?php }*/  ?>
			</ul>
		</li>

		<?php if($role_id==1){ ?>
	<!--	<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/sub_admin') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/sub_admin') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-user"></i></span> Sub Admin
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/sub_admin') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/sub_admin') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/sub_admin') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/sub_admin') == true)){
				echo 'style="display:block;"'; } ?>>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/sub_admin/add">Add New</a></li>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/sub_admin">View List</a></li>
            </ul>
		</li>--><!--Nathan-->
		<?php } ?>
		
		<?php if(in_array('3',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/users" class="">
				<span class="icon-box"> <i class="icon-user"></i></span> Members
			</a>
		</li>
		<?php } ?>

		<?php if(in_array('4',$user_access) OR $role_id == '1'){ ?>
		<!--<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/messages" class="">
				<span class="icon-box"> <i class="icon-envelope"></i></span> Messages
			</a>
		</li>-->
        <?php } ?>
        
        
        <?php if(in_array('5',$user_access) OR $role_id == '1'){
			 ?>
            <li class="has-sub <?php 
                   if((strpos($_SERVER['REQUEST_URI'],'adminsettings/specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/specification_options') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editspecfication') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/brands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addbrands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editbrand') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_product_category') == true)){
                    echo 'open'; } ?>">
                <a href="javascript:;" class="">
                    <span class="icon-box"> <i class="icon-tasks"></i></span>Products
                    <span class="arrow <?php 
                    if((strpos($_SERVER['REQUEST_URI'],'adminsettings/specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/specification_options') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editspecfication') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/brands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addbrands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editbrand') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_product_category') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/products') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/update_product') == true)){
                    echo 'open'; } ?>"></span>
                </a>
                <ul class="sub" <?php 
                    if((strpos($_SERVER['REQUEST_URI'],'adminsettings/specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/specification_options') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editspecfication') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/brands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addbrands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editbrand') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_product_category') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/products') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/update_product') == true)){
                    echo 'style="display:block;"'; } ?>>
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/specifications">Specifications</a></li>
                   	<li><a class="" href="<?php echo base_url().$index;?>adminsettings/brands">Brands</a></li>
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/product_categories">Categories</a></li>
		   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/products">Products</a></li>
           <li><a class="" href="<?php echo base_url().$index;?>adminsettings/uploadproducts">Bulk uploads</a></li>
           
                   <!--Nathan Hide details-->
                    <!-- <li><a class="" href="<?php echo base_url().$index;?>adminsettings/reviews">Reviews</a></li>-->
                            <!--Nathan Hide details-->
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;" class="">
                    <span class="icon-box"> <i class="icon-tasks"></i></span>Offline Users
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/pending_offline">Pending Users</a></li>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/confirm_offline">Confirmed Users</a></li>
             
                </ul>
            </li>
			<!-- seetha dec 14-->
			<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addrewards') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/rewards') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editrewards') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tasks"></i></span>Rewards
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addrewards') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/rewards') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editrewards') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addrewards') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/rewards') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editrewards') == true)){
				echo 'style="display:block;"'; } ?>>
           		<li><a class="" href="<?php echo base_url().$index;?>adminsettings/rewards">Rewards Details</a></li>
           		<li><a class="" href="<?php echo base_url().$index;?>adminsettings/rewards_settings">Rewards Settings</a></li>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/rewards_faqs">Rewards Faq's</a></li>                
			</ul>
			</li>
		<?php 
		} ?>
        
        
        <!--Nathan Hide details-->
		<?php 
		
		if(in_array('5',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcategory') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tasks"></i></span>Coupon Category
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcategory') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/premium_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editpremiumcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_premium_categories') == true)){
				echo 'style="display:block;"'; } ?>>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/addcategory">Add New</a></li>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/categories">View Normal List</a></li>
               <!-- <li><a class="" href="<?php echo base_url().$index;?>adminsettings/premium_categories">View Premium List</a></li>  -->
			</ul>
		</li>
		<?php } ?>
                <!--Nathan Hide details-->
  
        <?php if(in_array('6',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/site_addaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/site_affiliates') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/site_editaffiliate') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-user"></i></span> Direct Affiliates
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/site_addaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/site_affiliates') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/site_editaffiliate') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/site_addaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/site_affiliates') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/site_editaffiliate') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/site_addaffiliate">Add New</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/site_affiliates">View All</a></li>
			</ul>
		</li>
        <?php } ?>
        
        <!--Nathan Hide details-->
        
        
        
       <li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate_list') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliate_network') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaddaffiliate_list') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-user"></i></span>Affiliate Network
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate_list') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliate_network') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaddaffiliate_list') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate_list') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliate_network') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaddaffiliate_list') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addaffiliate_list">Add New</a></li>
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/api_coupons">API Coupons</a></li> 
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/inactive_categories">Inactive Categories</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliate_network">View All</a></li>
			</ul>
		</li>
        
        <!--Nathan Hide details-->
		
		<?php if(in_array('7',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliates') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/bulk_store') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/gallery') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/category_cashback') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-user"></i></span><!--Nathan Hide details--><!--Coupon--><!--Nathan Hide details--> Retailers
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliates') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/bulk_store') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaffiliate') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/gallery') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/category_cashback') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addaffiliate') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/affiliates') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/bulk_store') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editaffiliate') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/gallery') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/category_cashback') == true)){
				echo 'style="display:block;"'; } ?>>
              <!--Nathan Hide details--> <!-- <li><a class="" href="<?php echo base_url().$index;?>adminsettings/bulk_store">Upload</a></li>--><!--Nathan Hide details-->
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addaffiliate">Add New</a></li>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliates/On1">Online Store</a></li>
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/off_affiliates/">Offline Store</a></li>
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliates/">Coupon Store</a></li>
                 <!--<li> <a href="<?php echo base_url().$index;?>adminsettings/storeviews" class=""> Store Reviews	</a></li>--><!--Nathan-->
                 <!--<li><a class="" href="<?php echo base_url().$index;?>adminsettings/gallery">Gallery</a></li>-->
			</ul>
		</li>
		<?php } ?>
        
		<?php if(in_array('8',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/click_history" class="">
				<span class="icon-box"> <i class="icon-time"></i></span> Click History
			</a>
		</li>
        <?php } ?>
        
        
        <!--Nathan Hide details-->
        
        
		<?php if(in_array('9',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/bulkcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/coupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcoupon') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tags"></i></span> Coupons
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/bulkcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/coupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcoupon') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/bulkcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/coupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcoupon') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/bulkcoupon">Upload</a></li>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addcoupon">Add New</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/coupons">View All</a></li>
			</ul>
		</li>
		<?php } ?>

              <?php if(in_array('9',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_addcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_coupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_editcoupon') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tags"></i></span> Salable Coupons
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_addcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_coupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_editcoupon') == true)){
				echo 'open'; } ?>"></span>
			</a>

			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_addcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/salable_editcoupon') == true)){
				echo 'style="display:block;"'; } ?>>
           		 
           	  <li><a class="" href="<?php echo base_url().$index;?>adminsettings/salable_addcoupon">Add New</a></li> 

              <li><a class="" href="<?php echo base_url().$index;?>adminsettings/salable_coupons">View All</a></li>

			</ul>
		</li>
		<?php } ?>
        
        
        <!--Nathan Hide details-->
		
		<?php if((in_array('10',$user_access) || in_array('11',$user_access) || in_array('12',$user_access)) OR $role_id == '1'){ ?>
		<!--<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/add_shoppingcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/shoppingcoupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_shoppingcoupon') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tag"></i></span> Premium Coupon
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/add_shoppingcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/shoppingcoupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_shoppingcoupon') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/add_shoppingcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/shoppingcoupons') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_shoppingcoupon') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/orders') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/expired_coupons') == true)){
				echo 'style="display:block;"'; } ?>>
				<?php if(in_array('10',$user_access) OR $role_id == '1'){ ?>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/add_shoppingcoupon">Add New</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/shoppingcoupons">Active Coupons</a></li>
                  <li><a class="" href="<?php echo base_url().$index;?>adminsettings/expired_coupons">Expired Coupons</a></li>
				<?php } ?>
				<?php if(in_array('11',$user_access) OR $role_id == '1'){ ?>
					<li><a class="" href="<?php echo base_url().$index;?>adminsettings/orders">Orders</a></li>
				<?php } ?>
				<?php if(in_array('12',$user_access) OR $role_id == '1'){ ?>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/reviews">Reviews</a></li>
				<?php } ?>
			</ul>
		</li>--><!--Nathan-->
		<?php } ?>

		<?php if(in_array('13',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/cashback" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Cashbacks 
			</a>
		</li>
        <?php } ?>
		
		<?php if(in_array('13',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/pending_cashback" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Pending Cashbacks 
			</a>
		</li>
        <?php } ?>
		<?php if(in_array('13',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/pending_transaction" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Pending Transaction
			</a>
		</li>
        <?php } ?>
		<?php if(in_array('13',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/pending_referral" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Pending Referrals 
			</a>
		</li>
        <?php } ?>
		
		<?php if(in_array('14',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/reports') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/view_report') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/report_upload') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tag"></i></span> Reports
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/reports') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/view_report') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/report_upload') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/reports') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/view_report') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/report_upload') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/report_upload">Upload CSV-report</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/reports">View All</a></li>
			</ul>
		</li>
        <?php } ?>
		
		<?php if(in_array('15',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/missing_cashback" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Missing Cashback <!--<span class="arrow"></span>-->
			</a>
		</li>
        <?php } ?>
		
		<?php if(in_array('16',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/transactions" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Transactions  <!--<span class="arrow"></span>-->
			</a>
		</li>
		<?php } ?>
		
		<?php if(in_array('17',$user_access) OR $role_id == '1'){ ?>
		<!--<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/withdraw" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Withdraw <!--<span class="arrow"></span>
			</a>
			<ul class="sub">
           		 <!--<li><a class="" href="<?php echo base_url().$index;?>adminsettings/add_shoppingcoupon">Add New</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/shoppingcoupons">View All</a></li>
			</ul>
		</li>-->
        <?php } ?>
		
		<?php if(in_array('18',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/manual_credit" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Manual Credit
			</a>
		</li>
		<?php } ?>
		
		<?php if(in_array('19',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/compose_newsletter') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/subscribers') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-envelope-alt"></i></span> Subscribers
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/compose_newsletter') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/subscribers') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/compose_newsletter') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/subscribers') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/compose_newsletter">Send Newsletter</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/subscribers">View All</a></li>
			</ul>
		</li>
		<?php } ?>
		
		<?php if(in_array('20',$user_access) OR $role_id == '1'){ ?>
		<!--<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/referrals" class="">
				<span class="icon-box"> <i class="icon-group"></i></span> Referrals
			</a>
			<ul class="sub">
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/referrals">View All</a></li>
			</ul>
		</li>--><!--Nathan-->
		<?php } ?>
		
		<?php if(in_array('21',$user_access) OR $role_id == '1'){ ?>
		<!--<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/storeviews" class="">
				<span class="icon-box"> <i class="icon-comment"></i></span> Store Reviews
			</a>
		</li>-->
		<?php } ?>
		
		<?php if(in_array('22',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if(strpos($_SERVER['REQUEST_URI'],'adminsettings/email_template') == true){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-envelope"></i></span> Email Templates
				<span class="arrow <?php 
				if(strpos($_SERVER['REQUEST_URI'],'adminsettings/email_template') == true){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if(strpos($_SERVER['REQUEST_URI'],'adminsettings/email_template') == true){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/1">User Registration</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/2">Forget Password</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/5">Newsletter</a></li> 
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/6">Forget Password - Admin</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/7">Welcome Email</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/8">Friend Referral</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/9">Missing Cashback</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/10">Approve Cashback Mail</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/11">Approve Referral Mail</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/12">Pending Cashback Mail</a></li>
			</ul>
		</li>
		<?php } ?>
		
		<?php if(in_array('23',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addbanner') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/ads') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addads') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editads') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/banners') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-picture"></i></span> Banners
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addbanner') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/ads') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addads') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editads') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/banners') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addbanner') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/ads') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addads') == true) ||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editads') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/banners') == true)){
				echo 'style="display:block;"'; } ?>>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/ads">ADS</a></li>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addbanner">Add New</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/banners">View All</a></li>
			</ul>
		</li>
		<?php } ?>
		
		<?php if(in_array('24',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addfaqs') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/faqs') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editfaq') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-question-sign"></i></span> FAQ
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addfaqs') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/faqs') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editfaq') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addfaqs') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/faqs') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editfaq') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addfaqs">Add FAQ</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/faqs">View All</a></li>
			</ul>
		</li>
        <?php } ?>
        
        		 <!--<li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addblog') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/blog') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editblog') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-question-sign"></i></span> Blog
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addblog') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/blog') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editblog') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addblog') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/blog') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editblog') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addblog">Add Blog</a></li>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/blog">View Blog</a></li>
			</ul>
		</li>-->
        
		<?php if(in_array('25',$user_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/contacts" class="">
				<span class="icon-box"> <i class="icon-envelope"></i></span> Contacts
			</a>
		</li>
		<?php } ?>
		
		<?php if(in_array('26',$user_access) OR $role_id == '1'){ ?>
		 <li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcms') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/cms') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcms') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-file"></i></span> CMS Pages
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcms') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/cms') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcms') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcms') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/cms') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcms') == true)){
				echo 'style="display:block;"'; } ?>>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addcms">Add New</a></li>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/cms">View All</a></li>
			</ul>
		</li>
		<?php } ?>
		
		<li><a class="" href="<?php echo base_url().$index;?>adminsettings/logout"><span class="icon-box"><i class="icon-signout"></i></span> Logout</a></li>
	</ul>
	<!-- END SIDEBAR MENU -->
</div>
