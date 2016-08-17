<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>API New Coupon | <?php echo $admin_details->site_name; ?> Admin</title>
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
                     New Coupon
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/addcoupon','New Coupon'); ?>
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
                        <h4><i class="icon-file"></i> New Coupon</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div><br>
					 <span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked fields are mandatory.</span><br>

					<?php
					/* if($action=="new"){
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
							$attribute = array('role'=>'form','name'=>'addcoupon','method'=>'post','id'=>'addcoupon','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/addcoupon',$attribute);
						?>

						 <!--  <div class="control-group">
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
                           </div>-->
						   
						   <div class="control-group">
                              <label class="control-label">Store Name <span class="required_field">*</span></label>
                              <div class="controls">
								<!--<input type="text" name="offer_name" id="offer_name" required class="span6">-->
                                <?php
								$aff_list  = $this->admin_model->affiliates();
								?>
                                    <select id="offer_name" class="span6" required="" name="offer_name" onchange="">
                                    <option  value="">-Select-</option>
                                    <?php
									
                                    foreach($aff_list as $stores)
                                    {
                                    ?>
                                    <option  value="<?php echo $stores->affiliate_name;?>"><?php echo $stores->affiliate_name;?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                
                                
                                <span class="small">eg : amazon</span>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Category <span class="required_field">*</span></label>
                              <div class="controls">
								<!--<input type="text" name="offer_name" id="offer_name" required class="span6">-->
                                <?php
								$cat_list  = $this->admin_model->categories();
								?>
                                    <select id="category_name" class="span6" required="" name="category_name" onchange="">
                                    <option  value="">-Select-</option>
                                    <?php
									
                                    foreach($cat_list as $cate)
                                    {
                                    ?>
                                    <option  value="<?php echo $cate->category_id;?>"><?php echo $cate->category_name;?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>                               
                                
                                <span class="small">eg : Mobiles</span>
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
								<input type="text" name="expiry_date" id="expiry_date" required class="span6 date-picker" onblur="return check_date();">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Title <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="title" id="title" required class="span6">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Description <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="description" id="description" required class="span6"></textarea>
                              </div>
                           </div>
						   
						  <!--/* <div class="control-group">
                              <label class="control-label">Category <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="category" id="category" required class="span6">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Type <span class="required_field">*</span></label>
                              <div class="controls">
							<!--	<input type="text" name="type" id="type" required class="span6">-->
                                <select onChange="change_coupon_status(this.value);" name="type" id="type" required class="span6">
                                	<option value="Promotion">Promotion</option>
                                  	<option value="Coupon">Coupon</option>
                                </select>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label">Cashback Description <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="cashback_description" id="cashback_description" class="span6"></textarea>
                                <span class="small">Default : Get additional upto [Retailler Cashback] Cashback from <?php echo $admin_details->site_name; ?></span>
                              </div>
                           </div>
						   
						   <div class="control-group" id="hidesh" style="display:none">
                              <label class="control-label">Coupon Code <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="code" id="code"  class="span6">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea name="offer_page" id="offer_page" rows="5" required class="span6"></textarea>
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Coupons Options </label>
                              <div class="controls">
                                <input type="radio" class="span3" name="coupon_options" id="featured" value="1" />Featured &nbsp;
                                 <input type="radio" class="span3" name="coupon_options" id="featured" value="2" />Exclusive
                              </div>
                           </div>
                           
                           <input type="hidden" class="span3" name="featured" id="featured" value="0" />
                            <input type="hidden" class="span3" name="exclusive" id="exclusive" value="0" />
                           
						    
						  <!-- <div class="control-group">
                              <label class="control-label">Featured </label>
                              <div class="controls">
                                <input type="checkbox" class="span3" name="featured" id="featured" value="1" />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Exclusive </label>
                              <div class="controls">
                                <input type="checkbox" class="span3" name="exclusive" id="exclusive" value="1" />
                              </div>
                           </div>-->
                           
                           
                           <div class="control-group">
                              <label class="control-label">Tracking Extra Param<span class="required_field">*</span> </label>
                              <div class="controls">
                              <input type="text" name="Tracking"  id="Tracking" required class="span6">
                              </div>
                           </div>
                           
                           
						   <input type="hidden" name="coupon_type" id="coupon_type" value="Other">

                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success">
                           </div>
						   
						   <?php echo form_close(); ?>
                        <!-- END FORM
                     </div>
					 <?php } */ ?>
					 
					 
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
							$attribute = array('role'=>'form','name'=>'addcoupon','method'=>'post','id'=>'addcoupon','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/api_updatecoupon',$attribute);
						?>

						  <!-- <div class="control-group">
                              <label class="control-label">Promo ID <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="promo_id" id="promo_id" required class="span6" value="<?php echo $promo_id; ?>">
                              </div>
                           </div>-->

						   <input type="hidden" name="coupon_id" id="coupon_id" value="<?php echo $coupon_id; ?>">
						   
						   
						  <!-- <div class="control-group">
                              <label class="control-label">Offer ID <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="offer_id" id="offer_id" required class="span6" value="<?php echo $offer_id; ?>">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Offer Name <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="offer_name" id="offer_name" required class="span6" value="<?php echo $offer_name; ?>">
                              </div>
                           </div>
                           
                           -->
                           
                            <div class="control-group">
                              <label class="control-label">Offer Name <span class="required_field">*</span></label>
                              <div class="controls">
								
                                 <?php
								$aff_list  = $this->admin_model->affiliates();
								?>
                                    <select id="offer_name" class="span6" required="" name="offer_name" onchange="">
									<option value="">-Select-</option>
                                    <?php
                                    foreach($aff_list as $stores)
                                    {
                                    ?>
                                    <option <?php if($stores->affiliate_name==$offer_name){echo 'selected="selected"';}?>  value="<?php echo $stores->affiliate_name;?>"><?php echo $stores->affiliate_name;?></option>
                                    
                                    <?php
                                    }
                                    ?>
                                    </select>
                                <span class="small">eg : amazon</span>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Category <span class="required_field">*</span></label>
                              <div class="controls">
								<!--<input type="text" name="offer_name" id="offer_name" required class="span6">-->
                                <?php
								$cat_list  = $this->admin_model->categories();
								?>
                                    <select id="category_name" class="span6" required="" name="category_name" onchange="">
									<option value="">-Select-</option>
                                    <?php
									
                                    foreach($cat_list as $cate)
                                    {
                                    ?>
                                    <option  <?php if($cate->category_id==$category_name){echo 'selected="selected"';}?>  value="<?php echo $cate->category_id;?>"><?php echo $cate->category_name;?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>                               
                                
                                <span class="small">eg : Mobiles</span>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Start Date </label>
                              <div class="controls">
								<input type="text" name="start_date" id="start_date" required class="span6 date-picker" value="<?php echo $start_date; ?>">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Expires On <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="expiry_date" id="expiry_date" required class="span6 date-picker" value="<?php echo $expiry_date; ?>" onblur="return check_date();">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Title <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="title" id="title" required class="span6" value="<?php echo $title; ?>">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Description <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="description" id="description" rows="5" required class="span6"><?php echo $description; ?></textarea>
                              </div>
                           </div>
						   
						<!--   <div class="control-group">
                              <label class="control-label">Category <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="category" id="category" required class="span6" value="<?php echo $category; ?>">
                              </div>
                           </div>
						   -->
						
                           
                           <div class="control-group">
                              <label class="control-label">Type <span class="required_field">*</span></label>
                              <div class="controls">
							<!--	<input type="text" name="type" id="type" required class="span6">-->
                                <select name="type" onChange="change_coupon_status(this.value);" id="type" required class="span6">
                                	<option <?php if($type=='Promotion'){echo "selected='selected'";}?> value="Promotion">Promotion</option>
                                  	<option <?php if($type=='Coupon'){echo "selected='selected'";}?> value="Coupon">Coupon</option>
                                </select>
                              </div>
                           </div>
						   
                           
                            <div class="control-group">
                              <label class="control-label">Cashback Description <span class="required_field">*</span></label>
                              <div class="controls">
								<textarea name="cashback_description" id="cashback_description" class="span6"><?php echo $cashback_description; ?></textarea>
                                <span class="small">Default : Get additional upto [Retailler Cashback] Cashback from <?php echo $admin_details->site_name; ?></span>
                              </div>
                           </div>
                           
                           
						   <div class="control-group" id="hidesh" <?php if($type=='Coupon'){echo "display='block'";}else{echo "display='none'";}?>>
                              <label class="control-label">Code <span class="required_field">*</span></label>
                              <div class="controls">
								<input type="text" name="code" id="code" class="span6" value="<?php echo $code; ?>">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea name="offer_page" id="offer_page" rows="5" required class="span6"><?php echo $offer_page; ?></textarea>
                              </div>
                           </div>
						   
						  <!--  <div class="control-group">
                              <label class="control-label">Featured </label>
                              <div class="controls">
                                <input type="checkbox" class="" name="featured" id="featured" value="1" <?php if($featured=="1"){ echo 'checked="checked"';} ?> />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Exclusive </label>
                              <div class="controls">
                                <input type="checkbox" class="" name="exclusive" id="exclusive" value="1" <?php if($exclusive=="1"){ echo 'checked="checked"';} ?> />
                              </div>
                           </div>-->
                           
                            <div class="control-group">
                              <label class="control-label">Coupons Options </label>
                              <div class="controls">
                                <input type="radio" class="span3" name="coupon_options" id="featured" <?php if($coupon_options=="1"){ echo 'checked="checked"';} ?> value="1" />Featured &nbsp;
                                 <input type="radio" class="span3" name="coupon_options" id="featured" <?php if($coupon_options=="2"){ echo 'checked="checked"';} ?> value="2" />Exclusive
                              </div>
                           </div>
                           
                           <input type="hidden" class="span3" name="featured" id="featured" value="0" />
                            <input type="hidden" class="span3" name="exclusive" id="exclusive" value="0" />
                           
                             <div class="control-group">
                              <label class="control-label">Tracking Extra Param<span class="required_field">*</span> </label>
                              <div class="controls">
                              <input type="text" name="Tracking"  id="Tracking" value="<?php echo $Tracking;?>" required class="span6">
                              </div>
                           </div>
                           
                           
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success" onclick="return validate_date();">
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
   <?php $this->load->view('adminsettings/footer_script'); ?>
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
      });
	  
	  function change_coupon_status(nowstar)
	  {
		 if(nowstar=='Coupon') 
		 {
			 $("#hidesh").show();
		 }
		 else
		 {
			 $("#hidesh").hide();
		 }
	  }
	  
	function check_date()
	 {
		var start_date =$("#start_date").val();		  
		var expiry_date =$("#expiry_date").val();
		var s = new Date(start_date);
		var e = new Date(expiry_date);
		
		
		var sups = s.setDate(s.getDate() + 2); 
		var sups2 = e.setDate(e.getDate() + 2); 
		if( sups > sups2)
		{
			
			alert('Please choose valid Expiry Date.');
		        return false;
		}
	 }
   </script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>