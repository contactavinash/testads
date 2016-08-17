<?php $index = ''; // when we remove index.php comment this simply          <!--Nathan Hide details-->
$role_id=$this->session->userdata('admin_id');
$main_access = $this->session->userdata('main_access');
$sub_access = $this->session->userdata('sub_access');


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
					
					<li><a class="" href="<?php echo base_url().$index;?>adminsettings/sub_admin">Sub Admin</a></li>
					<!--<li><a class="" href="<?php echo base_url().$index;?>adminsettings/payment_settings">Payment Settings</a></li>--><!--Nathan-->
                <?php } ?>
                <?php if(in_array('5',$main_access) OR $role_id == '1'){ ?>
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
		
		

		<?php if(in_array('4',$user_access) OR $role_id == '1'){ ?>
		<!--<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/messages" class="">
				<span class="icon-box"> <i class="icon-envelope"></i></span> Messages
			</a>
		</li>-->
        <?php } ?>
        
        
        <?php if(in_array('1',$main_access) OR $role_id == '1'){
			 ?>
            <li class="has-sub <?php 
                   if((strpos($_SERVER['REQUEST_URI'],'adminsettings/specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/specification_options') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editspecfication') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/brands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addbrands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editbrand') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_product_category') == true)){
                    echo 'open'; } ?>">
                <a href="javascript:;" class="">
                    <span class="icon-box"> <i class="icon-tasks"></i></span>Online 
                    <span class="arrow <?php 
                    if((strpos($_SERVER['REQUEST_URI'],'adminsettings/specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/specification_options') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editspecfication') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/brands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addbrands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editbrand') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_product_category') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/products') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/update_product') == true)){
                    echo 'open'; } ?>"></span>
                </a>
                <ul class="sub" <?php 
                    if((strpos($_SERVER['REQUEST_URI'],'adminsettings/specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/specification_options') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_specifications') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editspecfication') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/brands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/addbrands') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editbrand') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/add_product_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_product_category') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/products') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/update_product') == true)){
                    echo 'style="display:block;"'; } ?>>
					<?php if(in_array('18',$sub_access) OR $role_id == '1'){ ?>
					<li ><a href="<?php echo base_url().$index;?>adminsettings/users" class="">	 Members</a></li><?Php } 
					if(in_array('19',$sub_access) OR $role_id == '1'){?>
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/specifications">Specifications</a></li>
					<?php }
					if(in_array('20',$sub_access) OR $role_id == '1'){
					?>
                   	<li><a class="" href="<?php echo base_url().$index;?>adminsettings/brands">Brands</a></li>
					<?php }
					if(in_array('21',$sub_access) OR $role_id == '1'){
					?>
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/product_categories">Categories</a></li>
					<?php } if(in_array('22',$sub_access) OR $role_id == '1'){ ?>
		   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/products">Products</a></li>
		   <?php } ?>
		   <?php if(in_array('12',$user_access) OR $role_id == '1'){ ?>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/reviews">Reviews</a></li>
				<?php } ?>
		   <?php if(in_array('23',$sub_access) OR $role_id == '1'){ ?>
           <li><a class="" href="<?php echo base_url().$index;?>adminsettings/uploadproducts">Bulk uploads</a></li>
		   <?php } 
		   if(in_array('24',$sub_access) OR $role_id == '1'){ ?>
		   
		   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliates/On1">Online Store</a></li>
		   <?php } ?>

		 <?php if(in_array('25',$sub_access) OR $role_id == '1'){  ?>
		<li ><a href="<?php echo base_url().$index;?>adminsettings/product_clickhistory" class="">Product Click History</a></li>
        <?php } ?>


		   <?php if(in_array('25',$sub_access) OR $role_id == '1'){  ?>
		<li ><a href="<?php echo base_url().$index;?>adminsettings/pending_transaction" class="">Pending Transaction	</a></li>
        <?php } ?>
		<?php if(in_array('26',$sub_access) OR $role_id == '1'){  ?>
        <li ><a href="<?php echo base_url().$index;?>adminsettings/transactions" class="">Complete Transactions </a></li>
		<?php } ?>
           
                   <!--Nathan Hide details-->
                    <!-- <li><a class="" href="<?php echo base_url().$index;?>adminsettings/reviews">Reviews</a></li>-->
                            <!--Nathan Hide details-->
                </ul>
				<?php 
		} ?>
            </li><?php if(in_array('7',$main_access) OR $role_id == '1'){ ?>
            <li class="has-sub">
                <a href="javascript:;" class="">
                    <span class="icon-box"> <i class="icon-tasks"></i></span>Referrals
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
				<?php  if(in_array('47',$sub_access) OR $role_id == '1'){ ?>
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/pending_referrals">Pending Referrals</a></li>
				<?php } if(in_array('48',$sub_access) OR $role_id == '1'){ ?>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/confirm_referrals">Confirmed Referrals</a></li>
				<?php }  if(in_array('49',$sub_access) OR $role_id == '1'){ ?>
               <li><a class="" href="<?php echo base_url().$index;?>adminsettings/transaction_details/2">Transaction Referrals</a></li>
				<?php } ?>
              
                </ul>
            </li><?php }?>
			<?php if(in_array('2',$main_access) OR $role_id == '1'){ ?>

            <li class="has-sub">
                <a href="javascript:;" class="">
                    <span class="icon-box"> <i class="icon-tasks"></i></span>Offline Stores
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
				<?php if(in_array('29',$sub_access) OR $role_id == '1'){ ?>
                    <li><a class="" href="<?php echo base_url().$index;?>adminsettings/pending_offline">Pending Users</a></li>
				<?php } if(in_array('30',$sub_access) OR $role_id == '1'){ ?>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/confirm_offline">Confirmed Users</a></li>
				<?php } if(in_array('28',$sub_access) OR $role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/off_affiliates/">Offline Store</a></li>
				<?php } if(in_array('41',$sub_access) OR $role_id == '1'){ ?>
				 
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/salable_addcoupon">Add Salable coupons</a></li> 
				 
			  	<?php } if(in_array('42',$sub_access) OR $role_id == '1'){ ?>

              	<li><a class="" href="<?php echo base_url().$index;?>adminsettings/salable_coupons">View Salable coupons</a></li>

              	<?php } ?>

                </ul>
            </li>
			<?php } ?>
			<!-- seetha dec 14-->
			
		
        
        
        <!--Nathan Hide details-->
		<?php 
		
		if(in_array('6',$main_access) OR $role_id == '1'){ ?>
        <li class="has-sub <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcategory') == true)){
				echo 'open'; } ?>">
			<a href="javascript:;" class="">
				<span class="icon-box"> <i class="icon-tasks"></i></span>Coupons
				<span class="arrow <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcategory') == true)){
				echo 'open'; } ?>"></span>
			</a>
			<ul class="sub" <?php 
				if((strpos($_SERVER['REQUEST_URI'],'adminsettings/addcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/premium_categories') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/editpremiumcategory') == true)||(strpos($_SERVER['REQUEST_URI'],'adminsettings/edit_premium_categories') == true)){
				echo 'style="display:block;"'; } ?>>
		<?php   if(in_array('31',$sub_access) OR $role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/addcategory">Add Coupons category </a></li>
				<?php } if(in_array('32',$sub_access) OR $role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/categories">View Coupons category  List</a></li>
				
				<?php } if(in_array('33',$sub_access) OR $role_id == '1'){ ?>
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addaffiliate">Add coupon store</a></li>
				 
                <?php } if(in_array('34',$sub_access) OR $role_id == '1'){ ?>	 
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliates/">Coupon Store</a></li>
				<?php } if(in_array('35',$sub_access) OR $role_id == '1'){ ?>
				 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/bulkcoupon">Upload coupons</a></li>
				 <?php } if(in_array('36',$sub_access) OR $role_id == '1'){ ?>
				 
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addcoupon">Add coupons</a></li>
				<?php } if(in_array('37',$sub_access) OR $role_id == '1'){ ?>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/coupons">View coupons</a></li>
				 
				 
				 <?php } if(in_array('38',$sub_access) OR $role_id == '1'){ ?>
				   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/pending_cashback">Pending Coupons</a></li>
				 <?php } if(in_array('39',$sub_access) OR $role_id == '1'){ ?>
                <li><a class="" href="<?php echo base_url().$index;?>adminsettings/confirm_coupon">Confirmed Coupons</a></li>
				   <?php } if(in_array('40',$sub_access) OR $role_id == '1'){ ?>
               <li><a class="" href="<?php echo base_url().$index;?>adminsettings/transaction_details/1">Transaction Coupons</a></li>
			   
				<?php } if(in_array('43',$sub_access) OR $role_id == '1'){ ?>

        		<li ><a href="<?php echo base_url().$index;?>adminsettings/click_history" class=""> Click History</a></li>
				 
		
	   <?php } if(in_array('44',$sub_access) OR $role_id == '1'){ ?>
		<li><a class="" href="<?php echo base_url().$index;?>adminsettings/report_upload">Upload CSV-report</a></li>
		<?php } if(in_array('45',$sub_access) OR $role_id == '1'){ ?>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/reports">View Reports</a></li>
		<?php } if(in_array('46',$sub_access) OR $role_id == '1'){ ?>
		
        
        <li>
        <a href="<?php echo base_url().$index;?>adminsettings/missing_cashback" class=""> Missing Cashback</a>
        </li>
        <?php } if(in_array('21',$user_access) OR $role_id == '1'){?>

		<li>
			<a href="<?php echo base_url().$index;?>adminsettings/storeviews" class="">
				 Store Reviews
			</a>
		</li>
		<?php } ?>
				 
               <!-- <li><a class="" href="<?php echo base_url().$index;?>adminsettings/premium_categories">View Premium List</a></li>  -->
			</ul>
		</li>
		<?php } ?>
                <!--Nathan Hide details-->
				
  
        <?php if(in_array('8',$main_access) OR $role_id == '1'){ ?>
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
				<?php if(in_array('50',$sub_access) OR $role_id == '1'){ ?>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/site_addaffiliate">Add New</a></li>
				<?php } if(in_array('51',$sub_access) OR $role_id == '1'){ ?>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/site_affiliates">View All</a></li>
				   <?php } ?>
			</ul>
		</li>
        <?php } ?>
        
        <!--Nathan Hide details-->
        
        
        <?php if(in_array('9',$main_access) OR $role_id == '1'){ ?>
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
				<?php if(in_array('53',$sub_access) OR $role_id == '1'){ ?>
           		 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/addaffiliate_list">Add New</a></li>
				 
				 <!--<li><a class="" href="<?php echo base_url().$index;?>adminsettings/api_coupons">API Coupons</a></li> -->
				<?php } if(in_array('55',$sub_access) OR $role_id == '1'){ ?>
				 <!--<li><a class="" href="<?php echo base_url().$index;?>adminsettings/inactive_categories">Inactive Categories</a></li>-->
				 <?php } if(in_array('54',$sub_access) OR $role_id == '1'){ ?>
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/affiliate_network">View All</a></li>
				 <?php } ?>
			</ul>
		</li>
        <?php } ?>
        <!--Nathan Hide details-->
		
		
        
		
        
        
        <!--Nathan Hide details-->
        
        
		<!--<?php if(in_array('9',$user_access) OR $role_id == '1'){ ?>
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
		<?php } ?>-->

              <!--<?php if(in_array('9',$user_access) OR $role_id == '1'){ ?>
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
		<?php } ?>-->
        
        
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

		
		
		
		
		<?php if(in_array('10',$main_access) OR $role_id == '1'){
			 ?>
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
				<?php  if(in_array('55',$sub_access) OR $role_id == '1'){ ?>
           		<li><a class="" href="<?php echo base_url().$index;?>adminsettings/rewards">Rewards Details</a></li>
				<?php } if(in_array('56',$sub_access) OR $role_id == '1'){ ?>
           		<li><a class="" href="<?php echo base_url().$index;?>adminsettings/rewards_settings">Rewards Settings</a></li>
				<?php } if(in_array('57',$sub_access) OR $role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/rewards_faqs">Rewards Faq's</a></li>
                <?php } 
				if($role_id == '1'){ ?>
				<li><a class="" href="<?php echo base_url().$index;?>adminsettings/redemptions">Redemptions</a></li>
                <?php } ?>
			</ul>
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
		
		<?php if(in_array('11',$main_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/manual_credit" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Manual Credit
			</a>
		</li>
		<?php } ?>
		
		<?php if(in_array('12',$main_access) OR $role_id == '1'){ ?>
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
		
		<?php if(in_array('13',$main_access) OR $role_id == '1'){ ?>
		<!--<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/referrals" class="">
				<span class="icon-box"> <i class="icon-group"></i></span> Referrals
			</a>
			<ul class="sub">
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/referrals">View All</a></li>
			</ul>
		</li>--><!--Nathan-->
		<?php } ?>
		
	<!--	<?php if(in_array('21',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/storeviews" class="">
				<span class="icon-box"> <i class="icon-comment"></i></span> Store Reviews
			</a>
		</li>
		<?php } ?>  -->
		
		<?php if(in_array('13',$main_access) OR $role_id == '1'){ ?>
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
                 <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/14">Offline User Registration</a></li>
                   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/15">Forget Password - Offline User</a></li>
                   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/16">Offline User Confimation</a></li>
				   <li><a class="" href="<?php echo base_url().$index;?>adminsettings/email_template/18">Contact us mail</a></li>
			</ul>
		</li>
		<?php } ?>
		
		<?php if(in_array('14',$main_access) OR $role_id == '1'){ ?>
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
		
		<?php if(in_array('15',$main_access) OR $role_id == '1'){ ?>
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

        <?php if(in_array('17',$user_access) OR $role_id == '1'){ ?>
		<li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/withdraw" class="">
				<span class="icon-box"> <i class="icon-money"></i></span> Withdraw 
				<!--<span class="arrow"></span>  -->
			</a>
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
        
		<?php if(in_array('16',$main_access) OR $role_id == '1'){ ?>
        <li class="has-sub">
			<a href="<?php echo base_url().$index;?>adminsettings/contacts" class="">
				<span class="icon-box"> <i class="icon-envelope"></i></span> Contacts
			</a>
		</li>
		<?php } ?>
		
		<?php if(in_array('17',$main_access) OR $role_id == '1'){ ?>
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
