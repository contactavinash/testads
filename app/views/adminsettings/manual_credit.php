<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>manual Credit| <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>
	<!--seetha--> 
	<link href="<?php echo base_url(); ?>assets/assets/boostrap-select/bootstrap-combined.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/assets/boostrap-select/bootstrap-select.min.css"> 	
	<!--seetha--> 
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
                     Manual Credit Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/manual_credit',' Manual Credit'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							Store Details<span class="divider-last">&nbsp;</span>
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
                        <h4><i class="icon-file"></i>  Manual Credit</h4>
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
						$sess_affiliate_name = $this->session->flashdata('affiliate_name');
						$sess_affiliate_status = $this->session->flashdata('affiliate_status');
						$sess_affiliate_type = $this->session->flashdata('affiliate_type');

							$attribute = array('role'=>'form','method'=>'post','id'=>'affiliates_a','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/manual_credit',$attribute);
						?>
						
                       

                           
                        <div class="control-group extra_hidden">
                              <label class="control-label">Amount<span class="required_field">*</span></label>
                              <div class="controls">
                                <?php echo DEFAULT_CURRENCY_CODE; ?>:  <input type="text" onKeyPress="bluramount(this.value);" class="span5" name="transation_amount" id="transation_amount" value="" placeholder="" required />
                              </div>
                           </div>
                           
                           <?php
						   $get_allusers = $this->admin_model->get_allusers();
						   ?>
                           
                            <div class="control-group extra_hidden">
                              <label class="control-label " >User Email<span class="required_field">*</span></label>
                              <div class="controls">
                              <select name="user_id" required class="span6 selectpicker" data-live-search="true"> 
                              <?php
							 	foreach($get_allusers as $users)
								{
							 	 ?>							     
								  <option <?php if($passing_userid==$users->user_id){ echo "selected=selected";}?> value="<?php echo $users->user_id;?>"><?php echo $users->email;?></option>
	                           	 <?php
								}
							  ?>
                               </select>
                              </div>
                           </div>
                           
                           
                           <div class="control-group extra_hidden">
                              <label class="control-label">Payment Type<span class="required_field">*</span></label>
                              <div class="controls">
                                  <select name="transation_reason" id="transation_reason" required class="span6"> 								  					     
                                   <option  value="Credit Account">Credit Account</option>
                                    <option  value="Cashback">Cashback</option>
                                    <option  value="Referal Payment">Referal Payment</option>
                               </select>
                              </div>
                           </div>
                           
                           
                       <!--  /*  <div class="control-group extra_hidden">
                              <label class="control-label">Tracking Param Name<span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="affiliate_traking_param" id="affiliate_traking_param" placeholder="Eg : ascsubtag" value="" required />
                              </div>
                           </div>*/-->
						 <!--</span>-->
						   
						  
						   <!-- Added Section 28/11/14 -->
						   
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
   

<script>

function changetypes(method)
{
	if(method=='Direct')
	{
		$('.extra_hidden').show();
		$('#hidden_sub').hide();
		
	}
	else
	{
		$('.extra_hidden').hide();
		$('#hidden_sub').show();
	}
}





</script>

<script>
function bluramount(max_shipping_time)
 {
	max_shipping_time = max_shipping_time.replace(/[^0-9\.]/g,'');
	if(max_shipping_time.split('.').length>2) 
	max_shipping_time = max_shipping_time.replace(/\.+$/,"");
	$('#transation_amount').val(max_shipping_time);
 }
</script>
<!-- seetha 19.8.15-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/assets/boostrap-select/bootstrap-select.min.js"></script>
<script>
$(document).ready(function(e) 
{ 
	$('.selectpicker').selectpicker();
});
</script>


   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>