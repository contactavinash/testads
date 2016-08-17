<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Affiliate Network | <?php echo $admin_details->site_name; ?> Admin</title>
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
                     Affiliate Network Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/affiliates','Affiliate Network'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							Affiliate Network Details<span class="divider-last">&nbsp;</span>
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
                        <h4><i class="icon-file"></i> Affiliate Network</h4>
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
							$attribute = array('role'=>'form','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/addaffiliate_list',$attribute);
						?>
						
                           <div class="control-group">
                              <label class="control-label">Affiliate Network <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="affiliate_name" id="affiliate_name" value="<?php if($sess_affiliate_name!=""){ echo $sess_affiliate_name;  }?>" required />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">API Key<span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="api_key" id="api_key" value="<?php if($sess_logo_url!=""){ echo $sess_logo_url;  }?>" required />
                              </div>
                           </div>
						   
						    <div class="control-group">
                              <label class="control-label">NetworkId <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="networkid" id="networkid" value="<?php if($sess_meta_keyword!=""){ echo $sess_meta_keyword;  }?>" required />
                              </div>
                           </div>                        
						   
						   <div class="control-group">
                              <label class="control-label">Affiliate Network Logo <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="span6" name="affiliate_logo" id="affiliate_logo" />
                              </div>
                           </div>             
						   					   
						   <div class="control-group">
                              <label class="control-label">Status</label>
                              <div class="controls">
                              <select name="affiliate_status">
								  <option value="1">Active</option>
								  <option value="0">De active</option>
							  </select>
                              </div>
                           </div>
                          
						   <!-- Added Section 28/11/14 -->
						   
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
							echo form_open('adminsettings/updataffiliate_list',$attribute);
						?>
                            <div class="control-group">
                              <label class="control-label">Affiliate Network  <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="affiliate_name" id="affiliate_name" value="<?php echo $affiliate_network; ?>" required />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">API Key <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="api_key" id="api_key" value="<?php echo $api_key;?>" required />
                              </div>
                           </div>
						   
						      <div class="control-group">
                              <label class="control-label">NetworkId <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="networkid" id="networkid" value="<?php if($networkid!=""){ echo $networkid;  }?>" required />
                              </div>
                           </div>                        
						   					   
						   <div class="control-group">
                              <label class="control-label">Affiliate Network Logo <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" name="affiliate_logo" id="affiliate_logo"/><br>
								<img src="<?php echo base_url();?>uploads/affiliates/<?php echo $affiliate_logo; ?>" width="180" height="35">
                              </div>
                           </div>
                           
						   
						   <input type="hidden" name="affiliate_id" id="affiliate_id" value="<?php echo $affiliate_id; ?>">
						   <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $affiliate_logo; ?>">
						   
						    <div class="control-group">
                              <label class="control-label">Store Status</label>
                              <div class="controls">
                              <select name="affiliate_status">
								  <option value="1" <?php if($status=='1'){ echo 'selected="selected"'; } ?>>Active</option>
								  <option value="0" <?php if($status=='0'){ echo 'selected="selected"'; } ?>>De active</option>
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
          $(document).ready(function() {       
             // initiate layout and plugins
          App.init();

          });

       </script><?php $this->load->view('adminsettings/footer_script'); ?>
   
<link href="<?php echo base_url(); ?>assets/assets/css/jquery-checktree.css" rel="stylesheet" type="text/css">


<script src="<?php echo base_url(); ?>assets/assets/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/assets/jquery-checktree.js"></script> 
<script>
$('#tree').checktree();
</script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>