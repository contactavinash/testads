<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>New Premium Coupon | <?php echo $admin_details->site_name; ?> Admin</title>
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
          
          <h3 class="page-title"> New Premium Coupon </h3>
          <ul class="breadcrumb">
            <li> <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?> <span class="divider">&nbsp;</span> </li>
            <li> <?php echo anchor('adminsettings/shoppingcoupons','Premium Coupons'); ?> <span class="divider">&nbsp;</span> </li>
            <li> <?php echo anchor('adminsettings/add_shoppingcoupon','New Premium Coupon'); ?> <span class="divider-last">&nbsp;</span> </li>
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
              <h4><i class="icon-file"></i> New Premium Coupon</h4>
              <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> 
              
              <!--<a href="javascript:;" class="icon-remove"></a>--> 
              
              </span> </div>
            <br>
            <span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked fields are mandatory.</span><br>
            <?php

					if($action=="new"){

					?>
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
              
					<?php
						$attribute = array('role'=>'form','name'=>'addcoupon','method'=>'post','id'=>'addcoupon','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit'=>'return ValidateFileUpload();'); 

						echo form_open('adminsettings/add_shoppingcoupon',$attribute);

					?>
              
              <!--

						  <div class="control-group">

                              <label class="control-label">Promo ID <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="promo_id" id="promo_id" required class="span6">

                              </div>

                           </div>

						   

						   <div class="control-group">

                              <label class="control-label">Offer ID <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="offer_id" id="offer_id" required class="span6">

                              </div>

                           </div>  

						   -->
              
              <div class="control-group">
                <label class="control-label">Coupon Name <span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="offer_name" id="offer_name" required class="span6">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Coupon Images <span class="required_field">*</span></label>
                <div class="controls">
					<span>Note: Coupon Images should be in (730 * 420) in size</span><br><!--seetha-->
                  <input type="file" title="Upload multiple images" name="coupon_image[]" id="coupon_image[]" required multiple class="span6">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Start Date</label>
                <div class="controls">
                  <input type="text" name="start_date" id="start_date" required class="span6 date-picker">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Expires On <span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="expiry_date" id="expiry_date" required class="span6 date-picker" >
                </div>
              </div>
              
              
              <!--<div class="control-group">
                              <label class="control-label">Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="description" id="description"></textarea>
                              </div>
                           </div>-->
              
              <!--

 						 <div class="control-group">

                              <label class="control-label">Title <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="title" id="title" required class="span6">

                              </div>

                           </div>

						   -->
              
              <div class="control-group">
                <label class="control-label">Short Description <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="description" rows="7" cols="11" id="description" required class="span6"></textarea>
                </div>
              </div>
              
              <div class="control-group">
                              <label class="control-label">Long Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="long_description" id="long_description"></textarea>
                              </div>
                           </div>
                           
                           
              <div class="control-group">
                <label class="control-label">About <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="about" rows="7" cols="11" id="about"  class="span6 ckeditor"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">In a nutshel <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="nutshel" rows="7" cols="11" id="nutshel" class="span6 ckeditor"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">The Fine print <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="fine_print" rows="7" cols="11" id="fine_print" class="span6 ckeditor"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Location<span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="location" id="location" required class="span6" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">The Company <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="company" rows="7" cols="11" id="company" required class="span6"></textarea>
                </div>
              </div>
              
              <!-- 

						  <div class="control-group">

                              <label class="control-label">Category <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="category" id="category" required class="span6">

                              </div>

                           </div> 

						   -->
              
              <div class="control-group">
                <label class="control-label">Category <span class="required_field">*</span></label>
                <?php

							 $category_list =  $this->admin_model->premium_categories();

							?>
                <div class="controls">
                  <div class="span4" id="tree_width" style="">
                    <ul id="tree" class="checktree-root">
                      <?php

							 foreach($category_list as $cate)

							 {

								 ?>
                      <li>
                        <label>
                          <input name="categorys_list[]" value="<?php echo $cate->category_id;?>" type="checkbox">
                          <?php echo $cate->category_name;?></label>
                        <?php

									  $cateid = $cate->category_id; 

									    

									  /*  

									  $sub_category_list =  $this->admin_model->premium_sub_categories($cateid);

									   if($sub_category_list)

									   {

										   foreach($sub_category_list as $subcate)

										   {

										   ?>

											<ul>                                            

												<li><label><input type="checkbox" name="size_<?php echo $cateid;?>[]" value="<?php echo $subcate->sun_category_id;?>"><?php echo $subcate->sub_category_name;?></label>

                                                </li>												

											</ul>

											<?php

										   }

										 } */

										?>
                      </li>
                      <?php



						     }

							 

							  ?>
                    </ul>
                  </div>
                </div>
              </div>
              
              <!--

						    <div class="control-group">

                              <label class="control-label">Type <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="type" id="type" required class="span6">

                              </div>

                           </div>

						    -->
              
              <div class="control-group">
                <label class="control-label">Amount in <?php echo DEFAULT_CURRENCY_CODE;?> <span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="amount" id="amount" required class="span6" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Web site URL <span class="required_field"></span></label>
                <div class="controls">
                  <input type="url"  name="offer_page" id="offer_page" class="span6">
                </div>
              </div>
              <?php 

							    $get_premiumfeatures=$this->input->post('premium_coupon_feature');  

								  

							  ?>
              <div class="control-group" >
                <label class="control-label">Features <span class="required_field"></span></label>
                <div class="controls">
                  <div >
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="new" <?php if((!empty($get_premiumfeatures)) && (in_array("new",$get_premiumfeatures))) { echo "checked";  }  ?> >
                    Newest
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="endingsoon" <?php if((!empty($get_premiumfeatures)) && (in_array("endingsoon",$get_premiumfeatures))) { echo "checked";  }   ?> >
                    Ending soon
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="popular" <?php if((!empty($get_premiumfeatures)) && (in_array("popular",$get_premiumfeatures))) { echo "checked";  }   ?>  >
                    Popular
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="featured" <?php if((!empty($get_premiumfeatures)) && (in_array("featured",$get_premiumfeatures))) { echo "checked";  }   ?>  >
                    Featured </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Code <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea required class="span6" name="code" id="code" ></textarea>
                </div>
              </div>
              
              
               <div class="control-group">
                <label class="control-label">Maximum Purchase Limit Per User <span class="required_field">*</span></label>
                <div class="controls">
                  <input id="txtboxToFilter" number class="span6" type="text" required="" value="2" name="user_max"> <strong>Note : Default value 2</strong>
                </div>
              </div>
              
              
              
              <!--

 						  <div class="control-group" id="add_remove">

						    <div>

                              <label class="control-label">Code <span class="required_field">*</span></label>

                              <div class="controls">

									<input type="text" name="code[]" id="code" required class="span4">

									&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/img/add.png" onclick="return add_remove();">

                              </div>

							</div>

                           </div>

                   -->
              
              <div class="form-actions">
                <input type="submit" name="save" value="Submit" class="btn btn-success" >
              </div>
              <?php echo form_close(); ?> 
              
              <!-- END FORM--> 
              
            </div>
            <?php } ?>
            <?php

					if($action=="edit"){

					?>
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
              
              <?php

							$attribute = array('role'=>'form','name'=>'addcoupon','method'=>'post','id'=>'addcoupon','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit'=>'return ValidateFile();'); 

							echo form_open('adminsettings/update_shoppingcoupon',$attribute);

						?>
              
              <!--

						   <div class="control-group">

                              <label class="control-label">Promo ID <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="promo_id" id="promo_id" required class="span6" value="<?php echo $promo_id; ?>">

                              </div>

                           </div>



						

						   

						   <div class="control-group">

                              <label class="control-label">Offer ID <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="offer_id" id="offer_id" required class="span6" value="<?php echo $offer_id; ?>">

                              </div>

                           </div> 

						   

						   -->
              
              <input type="hidden" name="shoppingcoupon_id" id="shoppingcoupon_id" value="<?php echo $shoppingcoupon_id; ?>">
              <div class="control-group">
                <label class="control-label">Coupon Name <span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="offer_name" id="offer_name" required class="span6" value="<?php echo $offer_name; ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Coupon Images <span class="required_field">*</span></label>
                <div class="controls">
				
                  <input type="file" title="Upload multiple images" name="coupon_image[]" id="coupon_image[]" multiple class="span6"><br>
				  <span>Note: Coupon Images should be in (730 * 420) in size</span><br><!--seetha-->
                  <br>
                  <?php

										$coupon_image = explode(',',$coupon_image);

										foreach($coupon_image as $get){

									?>
                  <img src="<?php echo base_url(); ?>uploads/premium/<?php echo $get; ?>" width="175" height="50">
                  <?php } 

								  $coupon_image = implode(',',$coupon_image);

								  ?>
                </div>
              </div>
              <input type="hidden" name="hidden_coupon_image" id="hidden_coupon_image" value="<?php echo $coupon_image; ?>">
              <div class="control-group">
                <label class="control-label">Start Date </label>
                <div class="controls">
                  <input type="text" name="start_date" id="start_date" required class="span6 date-picker" value="<?php echo $start_date; ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Expires On <span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="expiry_date" id="expiry_date" required class="span6 date-picker" value="<?php echo $expiry_date; ?>">
                </div>
              </div>
              
              <!-- 						

						<div class="control-group">

                              <label class="control-label">Title <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="title" id="title" required class="span6" value="<?php echo $title; ?>">

                              </div>

                           </div>

						    -->
              
              <div class="control-group">
                <label class="control-label">Short Description <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="description"  rows="7" cols="11" id="description" required class="span6">
                  <?php echo $description; ?>
                  </textarea>
                </div>
              </div>
              
              
              <div class="control-group">
                              <label class="control-label">Long Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="long_description" id="long_description"> <?php echo $long_description; ?></textarea>
                              </div>
                           </div>
                           
                           
              <div class="control-group">
                <label class="control-label">About <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="about" rows="7" cols="11" id="about"  class="span6 ckeditor"><?php echo $about; ?></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">In a nutshel <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="nutshel" rows="7" cols="11" id="nutshel"  class="span6 ckeditor"><?php echo $nutshel; ?></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">The Fine print <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="fine_print" rows="7" cols="11" id="fine_print"  class="span6 ckeditor"><?php echo $fine_print; ?></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Location<span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="location" id="location" required class="span6 "  value="<?php echo $location; ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">The Company <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea name="company" rows="7" cols="11" id="company" required class="span6"><?php echo $companys; ?></textarea>
                </div>
              </div>
              
              <!--   <div class="control-group">

                              <label class="control-label">Category <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="category" id="category" required class="span6" value="<?php echo $category; ?>">

                              </div>

                           </div>-->
              
              <div class="control-group">
                <label class="control-label">Store Category <span class="required_field">*</span></label>
                <?php

							 $category_list =  $this->admin_model->premium_categories();

							?>
                <div class="controls">
                  <div class="span4" id="tree_width" style="">
                    <ul id="tree" class="checktree-root">
                      <?php

							$sel_category = explode(",",$store_categorys);

							 foreach($category_list as $cate)

							 {

								 $subcatelevelid = '';

								 ?>
                      <li>
                        <label>
                          <input name="categorys_list[]" value="<?php echo $cate->category_id;?>" <?php if(in_array($cate->category_id,$sel_category)){ echo 'checked="checked"';} ?> type="checkbox">
                          <?php echo $cate->category_name;?></label>
                        <?php

									  $cateid = $cate->category_id;  

									  //get sub levels 

									   

									   /* 

									   

									   $affiliate_category_list =  $this->admin_model->get_premium_updated_categories($shoppingcoupon_id,$cateid);

									   //convert into array

									   if($affiliate_category_list)

									   {

										   foreach($affiliate_category_list as $sublevel)

										   {

											  $subcatelevelid[] =  $sublevel->sub_category_id;

										   }

									   }

									    $sub_category_list =  $this->admin_model->premium_sub_categories($cateid);

									   if($sub_category_list)

									   {

										   foreach($sub_category_list as $subcate)

										   {

										   ?>

											<ul>                                            

												<li><label><input type="checkbox" name="size_<?php echo $cateid;?>[]" <?php if($subcatelevelid!='') {if(in_array($subcate->sun_category_id,$subcatelevelid)){ echo 'checked="checked"';}} ?>  value="<?php echo $subcate->sun_category_id;?>"><?php echo $subcate->sub_category_name;?></label>

                                                </li>												

											</ul>

											<?php

										   }

										 } */

										?>
                      </li>
                      <?php



						     }

							 

							  ?>
                    </ul>
                  </div>
                </div>
              </div>
              
              <!--

						   <div class="control-group">

                              <label class="control-label">Type <span class="required_field">*</span></label>

                              <div class="controls">

								<input type="text" name="type" id="type" required class="span6" value="<?php echo $type; ?>">

                              </div>

                           </div>

						   -->
              
              <div class="control-group">
                <label class="control-label">Web site URL <span class="required_field"></span></label>
                <div class="controls">
                  <input type="url" name="offer_page"  id="offer_page"   class="span6" value="<?php echo $offer_page; ?>">
                </div>
              </div>
              <?php 

							   $exp_premiumfeatures=explode(",",$features);   

							

							?>
              <div class="control-group">
                <label class="control-label">Features <span class="required_field"></span></label>
                <div class="controls">
                  <div style="" >
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="new"  <?php if((!empty($exp_premiumfeatures)) && (in_array("new",$exp_premiumfeatures))) { echo "checked";  }  ?>  >
                    Newest
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="endingsoon" <?php if((!empty($exp_premiumfeatures)) && (in_array("new",$exp_premiumfeatures))) { echo "checked";  }  ?>  >
                    Ending soon
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="popular" <?php if((!empty($exp_premiumfeatures)) && (in_array("new",$exp_premiumfeatures))) { echo "checked";  }  ?>  >
                    Popular
                    <input type="checkbox" name="premium_coupon_feature[]" id="premium_coupon_feature1" class="span6" value="featured" <?php if((!empty($exp_premiumfeatures)) && (in_array("new",$exp_premiumfeatures))) { echo "checked";  }  ?>   >
                    Featured </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount in <?php echo DEFAULT_CURRENCY_CODE;?> <span class="required_field">*</span></label>
                <div class="controls">
                  <input type="text" name="amount" id="amount" required class="span6" value="<?php echo $amount; ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Code <span class="required_field">*</span></label>
                <div class="controls">
                  <textarea class="span6"  name="code" id="code" required ><?php echo $coupon_code;  ?></textarea>
                </div>
              </div>
              
              <!-- 

							 <div class="control-group" id="add_remove">

							 <div class="controls"> &nbsp;&nbsp;<button type="button" onclick="return add_removes();">Add More</button>	</div>

							 <?php

								// to fetch the code and amount using shoppingcoupon_id..

								$all_coupons = $this->admin_model->get_allcoupons($shoppingcoupon_id);

								if($all_coupons){

								foreach($all_coupons as $get){

							 ?> 

						   <div><br>

						   

					   

                              <label class="control-label">Code <span class="required_field">*</span></label>

                              <div class="controls">

							  <input type="hidden" name="shoppingcode_id[]" value="<?php echo $get->shoppingcode_id; ?>">

									<input type="text" name="code[]" id="code" required class="span4" value="<?php echo $get->code; ?>">&nbsp;&nbsp;

									<img src="<?php echo base_url(); ?>assets/img/cross.png" id="<?php echo $get->shoppingcode_id; ?>" class="remove_this_one">

                              </div>

							</div>

							  <?php } } ?>

                           </div>  

						   

						    -->
                            
                              <div class="control-group">
                <label class="control-label">Maximum Purchase Limit Per User <span class="required_field">*</span></label>
                <div class="controls">
                  <input id="txtboxToFilter" number class="span6" type="text" required="" value="<?php echo $user_max; ?>" name="user_max">
                </div>
              </div>
              
              <div class="form-actions">
                <input type="submit" name="save" value="Save Changes" class="btn btn-success">
              </div>
              <?php echo form_close(); ?> 
              
              <!-- END FORM--> 
              
            </div>
            <?php } ?>
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
 <script type="text/javascript" src="https://getbootstrap.com/2.3.2/assets/js/bootstrap-typeahead.js"></script>
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
<script type="text/javascript" src="<?php echo base_url(); ?> assets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script> 
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

       </script><?php $this->load->view('adminsettings/footer_script'); ?><?php $this->load->view('adminsettings/footer_script'); ?> 
<script type="text/javascript">

    function ValidateFileUpload() {

        var fuData = document.getElementById('coupon_image');

        var FileUploadPath = fuData.value;

 

//To check if user upload any file

        if (FileUploadPath == '') {

            alert("Please upload an image");

			$('#coupon_image').val("");

			return false;

        } else {

            var Extension = FileUploadPath.substring(

                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



			//The file uploaded is an image



			if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {



				// To Display

                // if (fuData.files && fuData.files[0]) {

                    // var reader = new FileReader();



                    // reader.onload = function(e) {

                        // $('#blah').attr('src', e.target.result);

                    // }



                    // reader.readAsDataURL(fuData.files[0]);

                // }

            } 



			// The file upload is NOT an image

			else {

                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

				$('#coupon_image').val("");

				return false;

            }

        }

    }	

	

	// for update functionality..

	    function ValidateFile() {

        var fuData = document.getElementById('coupon_image');

        var FileUploadPath = fuData.value;



//To check if user upload any file

        if (FileUploadPath == '') {

            // alert("Please upload an image");

			// $('#coupon_image').val("");

			// return false;

        } else {

            var Extension = FileUploadPath.substring(

                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



			//The file uploaded is an image



			if (Extension == "gif" || Extension == "png" || Extension == "bmp"

								|| Extension == "jpeg" || Extension == "jpg") {



				// To Display

                // if (fuData.files && fuData.files[0]) {

                    // var reader = new FileReader();



                    // reader.onload = function(e) {

                        // $('#blah').attr('src', e.target.result);

                    // }



                    // reader.readAsDataURL(fuData.files[0]);

                // }

            } 



			//The file upload is NOT an image

			else {

                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

				$('#coupon_image').val("");

				return false;

            }

        }

    }

	// add new code while creating new shopping coupon..

	function add_remove(){

		$('#add_remove').append('<div><br><label class="control-label">Code <span class="required_field">*</span></label>  <div class="controls"><input type="text" name="code[]" id="code" required class="span4">&nbsp;&nbsp; <img src="<?php echo base_url(); ?>assets/img/cross.png" class="remove_this"></div></div>');

	}

	

	// add new code while editing new shopping coupon..

	function add_removes(){

		$('#add_remove').append('<div><br><label class="control-label">Code <span class="required_field">*</span></label>  <div class="controls"><input type="text" name="codes[]" id="code" required class="span4">&nbsp;&nbsp; <img src="<?php echo base_url(); ?>assets/img/cross.png" class="remove_this"></div></div>');

	}

	

	// removes code while adding new shopping coupon..

	$('.remove_this').live('click', function() {

		// alert('click');

		$(this).parent().parent().remove();

	});

	

	// removes code on editing premium coupon..

	$('.remove_this_one').live('click', function() {

		// alert('click');

		// alert(this.id);

		var delete_id = this.id;

		// alert(delete_id);

		$(this).parent().parent().remove();

		$.ajax({

			type:'POST',

			url:'<?php echo base_url(); ?>adminsettings/delete_shopcoupon',

			data:{"id":delete_id},

			success:function(msg){

				if(msg==1){

					// alert('ok');

					// $('.remove_this_one').parent().parent().remove();

				} else {

					alert('Error occurred while deleting coupon code.');

				}

			}

		}); 

	});
	
	
	$(document).ready(function() {
    $("#txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

 $(document).ready(function() {
      		
		  $('input#location').typeahead({
          source: function (query, process) {
			   map = {};
			   objects = [];
            $.ajax({
              url: '<?php echo base_url();?>adminsettings/getcitys_listjson/'+query,
              type: 'POST',
              dataType: 'JSON',
              data: 'query=' + query,
              success: function(data) {
				  
				$.each(data, function (i, object) {
					map[object.city_name] = object;
					objects.push(object.city_name);
				});
                process(objects);
              }
            });
          }
        });
	  });
	  </script>
	

</script>
<link href="<?php echo base_url(); ?>assets/assets/css/jquery-checktree.css" rel="stylesheet" type="text/css">

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>