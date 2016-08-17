<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Admin Settings | <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>

   <link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/gritter/css/jquery.gritter.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/jquery-tags-input/jquery.tagsinput.css" />    
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/daterangepicker.css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   <?php $this->load->view('adminsettings/header'); ?>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
     <?php $this->load->view('adminsettings/sidebar'); ?>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                   <!-- BEGIN THEME CUSTOMIZER-->
                   <!--<div id="theme-change" class="hidden-phone">
                       <i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-gray" data-style="gray"></span>
                                <span class="color-purple" data-style="purple"></span>
                                <span class="color-navy-blue" data-style="navy-blue"></span>
                            </span>
                        </span>
                   </div>-->
                   <!-- END THEME CUSTOMIZER-->
                  <h3 class="page-title">
                     Admin Settings
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/settings','Settings'); ?>
							<span class="divider-last">&nbsp;</span>
                       </li>
                   </ul>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-cog"></i> Admin Settings</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div>
					 <br>
					 <span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked fields are mandatory.</span><br>
                     <div class="widget-body form">
					 <?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
						<button data-dismiss="alert" class="close">x</button>
						<strong>Error! </strong>'.$error.'</div>';
					} ?>
					<?php
				$success = $this->session->flashdata('success');
				if($success!="") {
						echo '<div class="alert alert-success">
								<button data-dismiss="alert" class="close">x</button>
								<strong>Success! </strong>'.$success.'</div>';			
				} ?>
                        <!-- BEGIN FORM-->
                        <!--<form action="#" class="form-horizontal">-->
						<?php
							$attribute = array('role'=>'form','method'=>'post','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit' =>'return validation();' ); 
							echo form_open('adminsettings/settingsupdate',$attribute);
						?>
					<h5><b>Admin & Site Details</b></h5>
						
                             <div class="control-group">
                              <label class="control-label">Site Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="site_name" id="site_name" value="<?php echo $site_name; ?>" required />&nbsp;<span class="">Name of the site</span>
                              </div>
                           </div>
						   
							
						    <div class="control-group">
                              <label class="control-label">Site URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="site_url" id="site_url" value="<?php echo $site_url; ?>" required />&nbsp;<span class="">Website of the site </span> 
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Homepage Title <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea name="homepage_title" id="homepage_title" required class="span6"><?php echo $homepage_title; ?></textarea>&nbsp;<span class="">Title of homepage  which is display in title bar </span>
                              </div>
                           </div>
						   <!-- seetha 09.09.2015 -->
						    <div class="control-group">
                              <label class="control-label">Site Prefix name <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="site_prefix" id="site_prefix" required class="span6"><?php echo $site_prefix; ?></textarea>&nbsp;<span class="">User identification code </span>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Address</label>
                              <div class="controls">
								<textarea class="span6" name="address" id="address" rows="5" required ><?php echo $address; ?></textarea>&nbsp;<span class="">Admin address</span>
                              </div>
                           </div>
						   
						   
                           
                           <div class="control-group">
                              <label class="control-label">Username <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="username" id="username" value="<?php echo $admin_username; ?>" required />&nbsp;<span class="">Username of admin</span>
                              </div>
                           </div>
						   <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id; ?>">
                                                  <input type="hidden" name="coin_code" id="coin_code" value="ADS">
						   <div class="control-group">
                              <label class="control-label">Email Address <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="email" class="span6" name="email" id="email" value="<?php echo $admin_email; ?>" required email/>&nbsp;<span class="">Email address of admin</span>
                              </div>
                           </div>
						   
                           <!--<div class="control-group">
                              <label class="control-label">Paypal Email Address</label>
                              <div class="controls">
                                <input type="email" class="span6" name="paypal_email" id="paypal_email" value="<?php echo $admin_paypal; ?>" required email/>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Paypal Mode</label>
                              <div class="controls">
                                 <label class="radio">
                                 <input type="radio" name="paypal_mode" value="sandbox" <?php if($paypal_mode=="sandbox"){ echo 'checked="checked"'; } ?> required />
								 Sandbox Mode
                                 </label>
                                 <label class="radio">
                                 <input type="radio" name="paypal_mode" value="paypal" <?php if($paypal_mode=="paypal"){ echo 'checked="checked"'; } ?> required />
                                  Live Mode
                                 </label>  
                              </div>
                           </div>-->
						   
						   <div class="control-group">
                              <label class="control-label">Admin Avatar</label>
                              <div class="controls">
                                <input type="file" class="span6" name="admin_logo" id="admin_logo" /><br>
								 <span>Note: Admin Avatar should be in (100 * 100) in size</span>
								<br>
								<span>Admin profile image</span><br>
								<img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $admin_logo; ?>" width="40" height="">
                              </div>
                           </div>
						   
							<input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $admin_logo; ?>">
							
						   <div class="control-group">
                              <label class="control-label">Site Logo</label>
                              <div class="controls">
                                <input type="file" class="span6" name="site_logo" id="site_logo" /><br>
								 <span>Note: Site Logo should be in (216 * 79) in size</span><br>
								 <span>Site Logo which display in home page</span><br>
								<img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $site_logo; ?>" width="150" height="250">	
                              </div>
                           </div>
						   
						   <input type="hidden" name="hidden_site_logo" id="hidden_site_logo" value="<?php echo $site_logo; ?>">
						   
						   <div class="control-group">
                              <label class="control-label">Site Favicon</label>
                              <div class="controls">
                                <input type="file" class="span6" name="site_favicon" id="site_favicon" /><br>
								<span>Note: Site Favicon should be in (50 * 50) in size</span><br>
								<span>Site Favicon display in title bar with page title</span><br>
								<img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $site_favicon; ?>" width="50" height="50">
                              </div>
                           </div>
						   
						   <input type="hidden" name="hidden_site_favicon" id="hidden_site_favicon" value="<?php echo $site_favicon; ?>">
						    <div class="control-group">
                              <label class="control-label">Contact Number <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="contact_number" id="contact_number" value="<?php echo $contact_number; ?>" required />&nbsp;<span class="">Admin contact number</span>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Site Mode</label>
                              <div class="controls">
								<select name="site_mode" class="span6">
									<option value="1" <?php if($site_mode=='1'){ echo 'selected="selected"'; }?>>Live Mode</option>
									<option value="0" <?php if($site_mode=='0'){ echo 'selected="selected"'; }?>>Under Maintenance</option>
								</select>&nbsp;<span class="">Choose site mode.If it is under maintaince no actions will be performed.</span>
                              </div>
                           </div>
                           
                           
                            <div class="control-group">
                              <label class="control-label">Default Currency</label>
                              <div class="controls">
                              <?php
							  $getallcurrencies = $this->admin_model->getallcurrencies();
							  ?>
								<select name="default_currency" class="span6">
                                <?php
								foreach($getallcurrencies as $currency)
								{
								?>
									<option value="<?php echo $currency->currency_id;?>" <?php if($default_currency==$currency->currency_id){ echo 'selected="selected"'; }?>><?php echo $currency->currency_name;?></option>
                               	<?php
								}
								?>
								</select>&nbsp;<span class="">Site Default Currency.</span>
                              </div>
                           </div>
                           
                           
                           <!-- seetha 11.12.2015-->
						    <div class="control-group">
                              <label class="control-label">Signup Bonus</label>
                              <div class="controls">
                                <input type="text" class="span6" name="startup_bonus" id="startup_bonus" value="<?php echo $startup_bonus; ?>" />&nbsp;<span class="">Signup Bonus</span>
                              </div>
                            </div>
						   <!-- seetha 11.12.2015-->
                           
                        <h5><b>Meta Description Details</b></h5>  
						   <!-- seetha 09.09.2015 -->
						   <div class="control-group">
                              <label class="control-label">Meta Keyword<span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="meta_keyword" id="meta_keyword" required class="span6"><?php echo $meta_keyword; ?></textarea>&nbsp;<span class="">Meta Keyword</span>
                              </div>
                           </div>
						 
						   <div class="control-group">
                              <label class="control-label">Meta Description <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="meta_description" id="meta_description" required class="span6"><?php echo $meta_description; ?></textarea>&nbsp;<span class="">Meta Description</span>
                              </div>
                           </div>
					  <!-- <h5><b>Mail Configuration Details</b></h5>  -->
						   <!--SMTP details seetha 27.8.15 -->
						  <!--  <div class="control-group">
                              <label class="control-label">SMTP Host Name <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="smtp_host_name" id="smtp_host_name" required class="span6"><?php echo $smtp_host_name; ?></textarea>&nbsp;<span class="">Host name for Mail configuration </span>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">SMTP Host Username <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="smtp_username" id="smtp_username" required class="span6"><?php echo $smtp_username; ?></textarea>&nbsp;<span class="">Host username for Mail configuration </span>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">SMTP Host Password <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="smtp_password" id="smtp_password" required class="span6"><?php echo $smtp_password; ?></textarea>&nbsp;<span class="">Host password for Mail configuration </span>
                              </div>
                           </div>
						    <div class="control-group">
                              <label class="control-label">SMTP Port <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="smtp_port" id="smtp_port" required class="span6"><?php echo $smtp_port; ?></textarea>&nbsp;<span class="">Port number for Mail configuration </span>
                              </div>
                           </div>-->
                            <input type="hidden" name="smtp_host_name" value="<?php echo $smtp_host_name; ?>">
                           <input type="hidden" name="smtp_username" value="<?php echo $smtp_username; ?>">
                           <input type="hidden" name="smtp_port" value="<?php echo $smtp_port; ?>">
                           <input type="hidden" name="smtp_password" value="<?php echo $smtp_password; ?>">
						   
						   <!--SMTP details seetha 27.8.15 -->
                           
						   <!--<div class="control-group">
                              <label class="control-label">Homepage Title <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="homepage_title" id="homepage_title" value="<?php echo $homepage_title; ?>" required />
                              </div>
                           </div>-->
                           
                           
						   
						<h5><b>Referral Cashback Details</b></h5>    
						   
						    <div class="control-group">
                              <label class="control-label">Referral Cashback <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="referral_cashback" id="referral_cashback" value="<?php echo $referral_cashback; ?>" required /> % &nbsp;<span class="">Cashback percentage of referral person</span>
                              </div>
                           </div>

						   <div class="control-group">
                              <label class="control-label">Minimum Withdraw <span class="required_field">*</span><br>  </label>
                              <div class="controls">
                                <input type="text" class="span6" name="minimum_cashback" id="minimum_cashback" value="<?php echo $minimum_cashback; ?>" required /> (in <?php echo DEFAULT_CURRENCY_CODE;?>)&nbsp;<span class="">Cashback withdraw amount</span>
                              </div>
                           </div>
						   
						<h5><b>Social Login Details</b></h5> 
						
						    <div class="control-group">
                              <label class="control-label">Facebook URL <span class="required_field"></span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="fb_url" id="fb_url" value="<?php echo $admin_fb; ?>"  />
                              </div>
                           </div>
						   
						    <div class="control-group">
                              <label class="control-label">Twitter URL <span class="required_field"></span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="twitter_url" id="twitter_url" value="<?php echo $admin_twitter; ?>"  />
                              </div>
                           </div>
						   
						    <div class="control-group">
                          
                           
                            <div class="control-group">
                              <label class="control-label">Google+ URL <span class="required_field"></span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="gplus_url" id="gplus_url" value="<?php echo $admin_gplus; ?>"  />
                              </div>
                           </div>
                           
                               <label class="control-label">Instagram URL <span class="required_field"></span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="admin_instagram" id="admin_instagram" value="<?php echo $admin_instagram; ?>"  />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Pinterest URL <span class="required_field"></span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="admin_pintrust" id="admin_pintrust" value="<?php echo $admin_pintrust; ?>" />
                              </div>
                           </div>
                           
						   
						   
                           
                            <div class="control-group">
                              <label class="control-label">Google analytics <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="google_analytics" id="google_analytics" required  class="span6"><?php echo $google_analytics; ?></textarea>&nbsp;<span class="">Script of google analytics</span>
                              </div>
                           </div>                      
                           
                            <div class="control-group">
                              <label class="control-label">Google Login Id <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="google_key" id="google_key" required class="span6"><?php echo $google_key; ?></textarea>&nbsp;<span class="">Google API Login Id </span>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Google Secret Key <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="google_secret" id="google_secret" required class="span6"><?php echo $google_secret; ?></textarea>&nbsp;<span class="">Google API secret key</span>
                              </div>
                           </div>
						   <!-- face book App Id & secret key  seetha -->
						   <div class="control-group">
                              <label class="control-label">Facebook Login Id <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="facebook_key" id="facebook_key" required class="span6"><?php echo $facebook_key; ?></textarea>&nbsp;<span class="">Facebook API Login Id </span>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">facebook Secret Key <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="facebook_secret" id="facebook_secret" required class="span6"><?php echo $facebook_secret; ?></textarea>&nbsp;<span class="">Google API secret key </span>
                              </div>
                           </div>
						   
                       <!-- <h5><b>Blog Details</b></h5> 
						 
						  <div class="control-group">
                              <label class="control-label">Blog URL <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="blog_url" id="blog_url" required class="span6"><?php echo $blog_url; ?></textarea>&nbsp;<span class="">Link of blog section</span>
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Enable Blog <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="enable_blog" class="span6">
									<option value="1" <?php if($enable_blog=='1'){ echo 'selected="selected"'; }?>>Enable</option>
									<option value="0" <?php if($enable_blog=='0'){ echo 'selected="selected"'; }?>>Disable</option>
								</select>
                              </div>
                           </div>-->
                           
<!--                           <input type="hidden" name="enable_shopping" value="0">-->
                           
                           <!-- <div class="control-group">
                              <label class="control-label">Enable Shopping <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="enable_shopping" class="span6">
									<option value="1" <?php if($enable_shopping=='1'){ echo 'selected="selected"'; }?>>Enable</option>
									<option value="0" <?php if($enable_shopping=='0'){ echo 'selected="selected"'; }?>>Disable</option>
								</select>
                              </div>
                           </div>-->
                           
                           <input type="hidden" name="enable_shopping" value="<?php echo $enable_shopping;?>"><!--Nathan-->
                           
                            <!-- seetha-->
						   <input type="hidden" name="enable_slider" id="enable_slider" value="0">
                           <!-- <div class="control-group">
                              <label class="control-label">Enable Home Slider <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="enable_slider" class="span6">
									<option value="1" <?php if($enable_slider=='1'){ echo 'selected="selected"'; }?>>Enable</option>
									<option value="0" <?php if($enable_slider=='0'){ echo 'selected="selected"'; }?>>Disable</option>
								</select>
                              </div>
                           </div>-->
                           
                           
                           
                         <!--    <div class="control-group">
                              <label class="control-label">Frontend Background Image <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="blog_url" id="blog_url" required class="span6"><?php echo $blog_url; ?></textarea>
                              </div>
                           </div>
                           -->
                        <!--   <div class="control-group">
                              <label class="control-label">Frontend Background Image</label>
                              <div class="controls">
                                <input type="file" class="span6" name="background_image" id="background_image" /><br>
								<span>Note: Frontend Background Image should be in (150 * 150) in size</span><br>
								<img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $background_image; ?>" width="150" height="250">
                              </div>
                           </div>-->
						   
						   <input type="hidden" name="hidden_site_background_image" id="hidden_site_background_image" value="<?php echo $background_image; ?>">
                           
                            
						   
						   
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success">
                           </div>
						   
						   <?php echo form_close(); ?>
                        <!--</form>-->
                        <!-- END FORM-->
                     </div>
                  </div>
                  <!-- END SAMPLE FORM widget-->
               </div>
            </div>
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
  <?php $this->load->view('adminsettings/footer'); ?>
   <!-- END FOOTER -->
   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js"></script>    
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/ckeditor/ckeditor.js"></script>
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap-fileupload.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.pack.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
          App.init();

          });

       </script><?php $this->load->view('adminsettings/footer_script'); ?>
     <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
                            