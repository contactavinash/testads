<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Update Cashback for <?php echo $store_details->affiliate_name?> | <?php echo $admin_details->site_name; ?> Admin</title>
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
                     <?php
						if($action=="new"){
							echo "Add";
						}
						else{
							echo "Update";
							}
						?> Cashback - <?php echo $store_details->affiliate_name?> 
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>                     
					   <li>
							<?php
						if($action=="new"){
							echo "Add";
						}
						else{
							echo "Update";
							}
						?> Cashback<span class="divider-last">&nbsp;</span>
                       </li>
                   </ul>
                     <span style="float:right">
                   <a href="<?php echo base_url();?>adminsettings/addstore_cashback/<?php echo $store_details->affiliate_id;?>" class="btn btn-success">Add Cashback</a> &nbsp;
                   <a href="<?php echo base_url();?>adminsettings/cashback_details/<?php echo $store_details->affiliate_id;?>" class="btn btn-success">View Cashbacks - <?php echo $store_details->affiliate_name?> </a></span>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-file"></i> 
                        <?php
						if($action=="new"){
							echo "Add";
						}
						else{
							echo "Update";
							}
						?>
                        Cashback - <?php echo $store_details->affiliate_name?> </h4>
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
							$attribute = array('role'=>'form','name'=>'category','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal'); 
							echo form_open('adminsettings/update_catecashback/'.$store_id.'/'.$action,$attribute);
						?>
                                                      
                            <div class="control-group">
                              <label class="control-label">Cashback Type</label>
                              <div class="controls">
                              <select name="cashback_type">
                               <option value="Flat">Flat</option>	
                              	<option value="Percentage">Percentage</option>		
                               							  						
							  </select>
                              </div>
                           </div>		
                            <div class="control-group">
                              <label class="control-label">Cashback <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" onKeyUp="bluramount(this.value);" name="cashback" id="cashback" value="" required />
                              </div>
                           </div>
                           
                             <div class="control-group">
                              <label class="control-label">Cashback Details</label>
                              <div class="controls">
                            	<textarea  class="form-control span6" name="cashback_details"></textarea>
                              </div>
                           </div>	
                           
                           
                           <div class="control-group">
                              <label class="control-label">Cashback Status</label>
                              <div class="controls">
                              <select name="status" class="span6">
                                 <option value="Active">Active</option>
                                 <option value="Deactive">Deactive</option>                                  								  						
							  </select>
                              </div>
                           </div>	
                           
                           
                           
                        
                          <input type="hidden" name="store_id" value="<?php echo $store_details->affiliate_id;?>">
                           <input type="hidden" name="action" value="<?php echo $action;?>">                           						   
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
							$rowfet = $this->db->query("SELECT * FROM `category_cashback` where cbid='$caskbackid'")->row();
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
							$attribute = array('role'=>'form','name'=>'category','method'=>'post','id'=>'update_form','class'=>'form-horizontal');
							echo form_open('adminsettings/update_catecashback/'.$store_details->affiliate_id.'/'.$action.'/'.$caskbackid,$attribute);
						?>
						 <div class="control-group">
                              <label class="control-label">Cashback Type</label>
                              <div class="controls">
                              <select name="cashback_type" class="span6">
                                 <option value="Flat" <?php if($rowfet->cashback_type=='Flat'){ echo 'selected="selected"'; } ?>>Flat</option>
                                 <option value="Percentage" <?php if($rowfet->cashback_type=='Percentage'){ echo 'selected="selected"'; } ?>>Percentage</option>                                  								  						
							  </select>
                              </div>
                           </div>		
                            <div class="control-group">
                              <label class="control-label">Cashback <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" onKeyUp="bluramount(this.value);" name="cashback" id="cashback" value="<?php echo $rowfet->cashback;?>" required />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Cashback Details</label>
                              <div class="controls">
                            	<textarea  class="form-control span6" name="cashback_details"><?php echo $rowfet->cashback_details;?></textarea>
                              </div>
                           </div>	
                           
                           
                           <div class="control-group">
                              <label class="control-label">Cashback Status</label>
                              <div class="controls">
                              <select name="status" class="span6">
                                 <option value="Active" <?php if($rowfet->status=='Active'){ echo 'selected="selected"'; } ?>>Active</option>
                                 <option value="Deactive" <?php if($rowfet->status=='Deactive'){ echo 'selected="selected"'; } ?>>Deactive</option>                                  								  						
							  </select>
                              </div>
                           </div>	
                           
                           
                           
                           <input type="hidden" name="caskbackid" value="<?php echo $caskbackid;?>">
                          
                           <input type="hidden" name="store_id" value="<?php echo $store_details->affiliate_id;?>">
                           <input type="hidden" name="action" value="<?php echo $action;?>">                           						   
                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success">
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
   	function bluramount(max_shipping_time)
	 {
		max_shipping_time = max_shipping_time.replace(/[^0-9\.]/g,'');
		if(max_shipping_time.split('.').length>2) 
		max_shipping_time = max_shipping_time.replace(/\.+$/,"");
		$('#cashback').val(max_shipping_time);
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