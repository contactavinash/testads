<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Category | <?php echo $admin_details->site_name; ?> Admin</title>
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
                        </span>adminsettings
                   </div>-->
                   <!-- END THEME CUSTOMIZER-->
                  <h3 class="page-title">
                     Category
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/categories','Category'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							Category Details<span class="divider-last">&nbsp;</span>
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
                        <h4><i class="icon-file"></i> Category</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div> <br>
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
                        <!--<form action="#" class="form-horizontal">-->
						<?php
							$attribute = array('role'=>'form','name'=>'category','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/addcategory',$attribute);
						?>
                           <div class="control-group">
                              <label class="control-label">Category Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" onblur="return check_cate();" name="category_name" id="category_name" value="" required />
                                 <div id="unique_name_error"></div>
                              </div>
                           </div>
						   
						  <div class="control-group">
                              <label class="control-label">Meta Keyword <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="meta_keyword" id="meta_keyword" value="" required />
                              </div>
                           </div>
						      
                           <div class="control-group">
                              <label class="control-label">Meta Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6" name="meta_description" rows="5" id="meta_description" required></textarea>	
                              </div>
                           </div>	
                           
                           <!-- <div class="control-group">
                              <label class="control-label">Category Type</label>
                              <div class="controls">
                              <select name="category_type">
                              	<option value="0">Normal Coupon Category</option>		
                                <option value="1">Premium Coupon Category</option>								  						
							  </select>
                              </div>
                           </div>	-->	
                           
                           <input type="hidden" name="category_type" value="0"><!--Nathan-->
                          
						  <div class="control-group cat_image">
                              <label class="control-label">Category Image <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="span6" name="category_image" id="category_image" required/><br>
								<span>Note: Category Image should be minimum of (150 * 150) in size</span><br>
								<p id="display_error_img"></p>
                              </div>
                           </div>
						   
						  <div class="control-group">
                              <label class="control-label">Category Status</label>
                              <div class="controls">
                              <select name="category_status">
                                <option value="1">Active</option>
								  <option value="0">Deactive</option>								
							  </select>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Top Category </label>
                              <div class="controls">
                                <input type="checkbox" class="span3" name="top_category" id="top_category" value="1" />
                              </div>
                           </div>
						   <div class="control-group cat_image">
                              <label class="control-label">Category Icon <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="span6" name="category_icon" id="category_icon" required/><br>
								<span>Note: Category Icon should be minimum of (45 * 45) in size</span><br>
								<p id="display_error_img1"></p>
                              </div>
                           </div>
						   
                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success">
                           </div>
						   <?php echo form_close(); ?>
                        <!--</form>-->
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
                        <!--<form action="#" class="form-horizontal">-->
						<?php
							$attribute = array('role'=>'form','name'=>'category','method'=>'post','id'=>'update_form','class'=>'form-horizontal','enctype'=>'multipart/form-data');
							echo form_open('adminsettings/updatecategory',$attribute);
						?>
						<div class="control-group">
                              <label class="control-label">Category Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" readonly name="category_name" id="category_name" value="<?php echo $category_name; ?>" required />
                              </div>
                           </div>	 
						   
						   <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>">
 <input type="hidden" name="check_null" id="check_null" value="<?php echo $check_null; ?>">
					
						   <div class="control-group">
                              <label class="control-label">Meta Keyword <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="meta_keyword" id="meta_keyword" value="<?php echo $meta_keyword; ?>" required />
                              </div>
                           </div>
						      
                           <div class="control-group">
                              <label class="control-label">Meta Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6" name="meta_description" rows="5" id="meta_description" required><?php echo $meta_description; ?></textarea>	
                              </div>
                           </div>
						    <div class="control-group cat_image">
                              <label class="control-label">Category Image <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="span6" name="category_image" id="category_image" /><br>
								<span>Note: Category Image should be minimum of (150 * 150) in size</span><br>
								<img src="<?php echo base_url(); ?>uploads/category/<?php echo $category_image; ?>" width="150">
								<p id="display_error_img"></p>
								<input type="hidden" name="hidden_category_image" id="hidden_category_image" value="<?php echo $category_image; ?>">
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Category Status</label>
                              <div class="controls">
                              <select name="category_status">
								  <option value="0" <?php if($category_status=='0'){ echo 'selected="selected"'; } ?>>De active</option>
								  <option value="1" <?php if($category_status=='1'){ echo 'selected="selected"'; } ?>>Active</option>
							  </select>
                              </div>
                           </div>
                            <div class="control-group">
                              <label class="control-label">Top Category  </label>
                              <div class="controls">
                                <input type="checkbox" class="" name="top_category" id="top_category" value="1" <?php if($top_category=="1"){ echo 'checked="checked"';} ?> />
                              </div>
                           </div>
						   <div class="control-group cat_image">
                              <label class="control-label">Category Icon <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="span6" name="category_icon" id="category_icon"/><br>
								<span>Note: Category Icon should be minimum of (45 * 45) in size</span><br>
								<img src="<?php echo base_url(); ?>uploads/category/<?php echo $category_icon; ?>" width="150" style="background: none repeat scroll 0 0 #000;">
								<p id="display_error_img1"></p>
								<input type="hidden" name="hidden_category_icon" id="hidden_category_icon" value="<?php echo $category_icon; ?>">
                              </div>
                           </div>
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success">
                           </div>
						   <?php echo form_close(); ?>
                        <!--</form>-->
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
   <script>
   function check_cate()

{

	var category_name = $('#category_name').val();
	if(category_name)
	{
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>adminsettings/check_cate',
			data:{'category_name':category_name},
			 success:function(result){
				if(result==1)
				{
					$("#unique_name_error").css('color','#29BAB0');
  				 	$("#unique_name_error").html('available.');
				}
				else
				{
					$("#unique_name_error").css('color','#ff0000');					
					$("#unique_name_error").html(category_name+' category is already exists.');
					$("#category_name").val('');
				}
			}
		});
	}
	return false;
}
   </script>
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