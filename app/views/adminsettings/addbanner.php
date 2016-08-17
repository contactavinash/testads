<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Banner | <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>

   <link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/gritter/css/jquery.gritter.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/jquery-tags-input/jquery.tagsinput.css" />    
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" />
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
                     Banner Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/banners','Banner'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							Banner Details<span class="divider-last">&nbsp;</span>
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
                        <h4><i class="icon-file"></i> Banner</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div><br>
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
						$sess_banner_name = $this->session->flashdata('banner_name');

							$attribute = array('role'=>'form','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/addbanner',$attribute);
						?>
						
                           <div class="control-group">
                              <label class="control-label">Banner Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="banner_name" id="banner_name" value="<?php if($sess_banner_name!=""){ echo $sess_banner_name;  }?>" required />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Banner Image <span class="required_field">*</span></label>
                              <div class="controls">
								<span>Note: Banner Logo should be in (765 * 416) in size</span><br><!--seetha-->
                                <input type="file" class="span6" required name="banner_image" id="banner_image" />
                              </div>
                           </div>
                           
                           
                             <div class="control-group">
                              <label class="control-label">Banner URL <span class="required_field">*</span></label>
                              <div class="controls">
                              <textarea name="banner_url" required></textarea>
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Banner Position</label>
                              <div class="controls">
                              <select name="banner_position">
								  <option value="0">Home page</option>
								  <option value="1">Premium Coupon</option>
							  </select>
                              </div>
                           </div>
                           
							
						   <div class="control-group">
                              <label class="control-label">Banner Status</label>
                              <div class="controls">
                              <select name="banner_status">
								  <option value="1">Active</option>
								  <option value="0">De active</option>
							  </select>
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
							$attribute = array('role'=>'form','name'=>'faq','method'=>'post','id'=>'update_form','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/updatebanner',$attribute);
						?>
						   <div class="control-group">
                              <label class="control-label">Banner Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="banner_name" id="banner_name" value="<?php  echo $banner_name; ?>" required />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Store Logo <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" name="banner_image" id="banner_image"/><br>
								<span>Note: Store Logo should be in (765 * 416) in size</span><br><!--seetha-->
								<img src="<?php echo base_url();?>uploads/banners/<?php echo $banner_image; ?>" width="300" height="35">
                              </div>
                           </div>
                           
                           
                             <div class="control-group">
                              <label class="control-label">Banner URL <span class="required_field">*</span></label>
                              <div class="controls">
                              <textarea name="banner_url" required><?php  echo $banner_url; ?></textarea>
                              </div>
                           </div>


	

			
						   <input type="hidden" name="banner_id" id="banner_id" value="<?php echo $banner_id; ?>">
						   <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $banner_image; ?>">
                           
                           
                             <div class="control-group">
                              <label class="control-label">Banner Position</label>
                              <div class="controls">
                              <select name="banner_position">
								  <option <?php if($banner_position=='0'){ echo 'selected="selected"'; } ?> value="0">Home page</option>
								  <option <?php if($banner_position=='1'){ echo 'selected="selected"'; } ?> value="1">Premium Coupon</option>
							  </select>
                              </div>
                           </div>
                           

							<div class="control-group">
                              <label class="control-label">Banner Current Status</label>
                              <div class="controls">
                              <select name="banner_status">
								  <option value="1" <?php if($banner_status=='1'){ echo 'selected="selected"'; } ?>>Active</option>
								  <option value="0" <?php if($banner_status=='0'){ echo 'selected="selected"'; } ?>>De active</option>
							  </select>
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