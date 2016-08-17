<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Withdraw Details | <?php echo $admin_details->site_name; ?> Admin</title>
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
                     Withdraw Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/withdraw','Withdraw Details'); ?>
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
                        <h4><i class="icon-file"></i> Withdraw Details</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div><br>
					 <!--<span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked field is mandatory.</span><br>-->

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
							$attribute = array('role'=>'form','name'=>'addwithdraw','method'=>'post','id'=>'addwithdraw','class'=>'form-horizontal','enctype'=>'multipart/form-data');
							echo form_open('adminsettings/updatewithdraw',$attribute);
						?>

						   <div class="control-group">
                              <label class="span3">Current Withdraw Status </label>
                              <div class="controls">
								<label class="span6"><?php echo $status; ?></label>
                              </div>
                           </div>
						   <?php // view user details..
								$user_details = $this->admin_model->view_user($user_id);
								foreach($user_details as $get){
									$useremail = $get->email;
									$balance = $get->balance;
									$account_holder = $get->account_holder;
									$bank_name = $get->bank_name;
									$branch_name = $get->branch_name;
									$account_number = $get->account_number;
								}
						   ?>
						   <div class="control-group">
                             <label class="span3">User Email </label>
                              <div class="controls">
								<label class="span6"><?php
									$attr = array('target'=>'_blank');
									echo anchor('adminsettings/view_user/'.$user_id,$useremail,$attr);
								?></label>
                              </div>
                           </div>

						   <div class="control-group">
                              <label class="span3">User Current Balance </label>
                              <div class="controls">
								<label class="span6"><?php echo $balance; ?></label>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="span3">Bank Account Holder </label>
                              <div class="controls">
								<label class="span6"><?php
								if($account_holder!=""){
								echo $account_holder;
								} else {
								echo 'Not Provided.';
								} ?></label>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="span3">Bank Name </label>
                              <div class="controls">
								<label class="span6"><?php if($bank_name!=""){
								echo $bank_name;
								} else {
								echo 'Not Provided.';
								} ?></label>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="span3">Branch </label>
                              <div class="controls">
								<label class="span6"><?php if($branch_name!=""){
								echo $branch_name;
								} else {
								echo 'Not Provided.';
								} ?></label>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="span3">Bank Account Number </label>
                              <div class="controls">
								<label class="span6"><?php if($account_number!=""){
									echo $account_number;
								} else {
									echo 'Not Provided.';
								} ?></label>
                              </div>
                           </div>
						   
						    <div class="control-group">
                              <label class="span3">Withdraw Requested On </label>
                              <div class="controls">
								<label class="span6"><?php  echo date('d-M-Y',strtotime($date_added)); ?></label>
                              </div>
                           </div>

						   <div class="control-group">
                             <label class="span3">Closing Date </label>
                              <div class="controls">
								<label class="span6"><?php 
									if(($status=='Requested') || ($status=='Processing')){
										echo 'Not Closed.';
									}
									else {
										echo date('d-M-Y',strtotime($closing_date));
									} ?></label>
                              </div>
                           </div>
                           
                           <?php 
						   if($status=="Completed")
						   {
							  ?>
                              <div class="control-group">
                              <label class="span3">Status</label>
                              <div class="controls">
								<label class="span6"><?php  echo "Completed"; ?></label>
                              </div>
                           </div>
                              <?php 
						   }
						   else
						   {
						   ?>
						   
						   <div class="control-group">
                             <label class="span3">Status </label>
                              <div class="controls">
								<select name="current_status">	
									<option value="Requested" <?php if($status=="Requested"){ echo 'selected="selected"'; }?>>Requested</option>
									<option value="Processing" <?php if($status=="Processing"){ echo 'selected="selected"'; }?>>Processing</option>
                                    <option value="Cancelled" <?php if($status=="Cancelled"){ echo 'selected="selected"'; }?>>Cancelled</option>
									<option value="Completed" <?php if($status=="Completed"){ echo 'selected="selected"'; }?>>Completed</option>                                    
                                    
								</select>
                              </div>
                           </div>
                           <input type="hidden" name="withdraw_id" id="withdraw_id" value="<?php echo $withdraw_id; ?>">

                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success">
                           </div>
                           <?php
						   }
						   ?>

						   

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