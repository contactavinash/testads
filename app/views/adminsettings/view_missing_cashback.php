<!DOCTYPE html>
 
<head>

 
   
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>View Missing cashback Details | <?php echo $admin_details->site_name; ?> Admin</title>
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
<body  class="fixed-top">
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
                     Missing Cashback
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
					   <li>
							<?php echo anchor('adminsettings/users','Users'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
                       <li>
							Missing Cashback<span class="divider-last">&nbsp;</span>
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
                        <h4><i class="icon-cog"></i>Missing Cashback</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div>
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
						//print_r($missing_cashback);
						
						if($missing_cashback){
							$user_details = $this->admin_model->view_user($missing_cashback->user_id);
							$fname = $user_details[0]->first_name;
							$lname = $user_details[0]->last_name;
							$usname = $fname." ".$lname;
							//foreach($user_detail as $user) {
						
							$attribute = array('role'=>'form', 'onSubmit'=>'return samplesub();','method'=>'post','class'=>'form-horizontal'); 
							echo form_open('adminsettings/cashbackupdate',$attribute);
							$cashback_id  = $missing_cashback->cashback_id;
									 $stat_num = 5000+$cashback_id;
									 $getclickdate = $missing_cashback->trans_date;
						?>
                           <div class="control-group">
                              <label class="control-label">User Name</label>
                              <div class="controls">
								<label class="span6"><?php echo $usname; ?></label>
                              </div>
                           </div>
						  
						   <div class="control-group">
                              <label class="control-label">Date of query</label>
                              <div class="controls">
                                <label class="span6"><?php echo $getclickdate; ?></label>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Merchant Name</label>
                              <div class="controls">
                                <label class="span6"><?php echo $missing_cashback->retailer_name; ?></label>
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Voucher Name</label>
                              <div class="controls">
                              <?php $click_id =  $missing_cashback->click_id;
							 		$clkdetail =  $this->admin_model->click_history_details($click_id);
							  ?>
                                <label class="span6"><?php echo $clkdetail->voucher_name; ?></label>
                              </div>
                           </div>                           
						   
						   <div class="control-group">
                              <label class="control-label">Transaction Amount</label>
                              <div class="controls">
								<label class="span6"><span class="indianRs"><?php echo DEFAULT_CURRENCY;?></span> <?php echo $missing_cashback->ordervalue; ?></label>	
                              </div>
                           </div>
                           
						    <div class="control-group">
                              <label class="control-label">Transaction Reference</label>
                              <div class="controls">
                              <label class="span6"><?php echo $missing_cashback->transaction_ref_id; ?></label>
                              </div>
                           </div>
                           
                             <div class="control-group">
                              <label class="control-label">Coupon Code Used</label>
                              <div class="controls">
                              <label class="span6"><?php echo $missing_cashback->coupon_code; ?></label>
                              </div>
                           </div>
                           
                           
                             <div class="control-group">
                              <label class="control-label">Details</label>
                              <div class="controls">
                              <label class="span6"><?php echo $missing_cashback->cashback_details;?></label>
                              </div>
                           </div>
                           
                           
                           <!--<div class="control-group">
                              <label class="control-label">Reference Image</label>
                              <div class="controls">
                              <?php
							  if($missing_cashback->attachment)
							  {
								  ?>
                                  <a href="javascript:void(0);" onClick="showset('show');"><img src="<?php echo base_url();?>uploads/missing_cashback/<?php echo $missing_cashback->attachment;?>" width="300" height=""></a>
                                  <span id="sample" style="cursor:pointer" onclick="showset('show');"><b>Show Large Image</b></span>
								<span id="sample_hide" style="cursor:pointer; display:none;"  onclick="showset('hide');"><b>Hide Large Image</b></span>-->
								 <!-- <label class="span6"><?php echo $missing_cashback->transaction_ref_id; ?></label>-->
                                 <!-- <?php
							  }
							  
							  ?>
                              
                              </div>
                           </div>-->
                           
                           <div class="control-group" id="showset" style="display:none">                             
                              <div class="controls1">
                              <?php
							  if($missing_cashback->attachment)
							  {
								  ?>
                                  <a href="javascript:void(0);"><img src="<?php echo base_url();?>uploads/missing_cashback/<?php echo $missing_cashback->attachment;?>" width="" height=""></a>
                                  <?php
							  }
							  
							  ?>
                              
                              </div>
                           </div>
						   
						    
						     <hr>
                             <?php  $missing_cashback_status = $missing_cashback->status;
							 if($missing_cashback_status!=0)
							 {
							 ?>
                             
						    <div class="control-group"><br>
                              <label class="control-label">Current Status</label>
                              <div class="controls">
							  
								<select name="status" id="change_sta" onChange="sa(this.value);" required>
                                  <option value="3" <?php if($missing_cashback_status=='3'){ echo 'selected="selected"'; } ?>> Created</option>
                                <option value="2" <?php if($missing_cashback_status=='2'){ echo 'selected="selected"'; } ?>>Sent to retailer</option>
								 <option value="1" <?php if($missing_cashback_status=='1'){ echo 'selected="selected"'; } ?>>Cancelled</option>
								  <option value="0" <?php if($missing_cashback_status=='0'){ echo 'selected="selected"'; } ?>>Completed</option>                                 
							  </select>
                              </div>
                           </div>
                           
                           <div class="control-group" id="cancel_reason" <?php if($missing_cashback_status==1){ echo 'style="display:block"'; } else {echo 'style="display:none"';} ?>>
                              <label class="control-label">Cancelled Reason<span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea  id="cancel_reason" rows="5" name="cancel_reason" class="span6"></textarea>	
                              </div>
                           </div>
                           
                           <div class="control-group" id="Cashback_Return_Amount" <?php if($missing_cashback_status==0){ echo 'style="display:block"'; } else {echo 'style="display:none"';} ?>>
                              <label class="control-label">Cashback Return Amount<span class="required_field">*</span></label>
                              <div class="controls">
                              <input id="ret_amut" class="span6" type="text"  onKeyPress="bluramount(this.value);" value="" name="Cashback_Return_Amount">
                              </div>
                           </div>
                           
                         <input type="hidden" name="ticket_details" id="ticket_details" value="">
                          <input type="hidden" name="username" id="username" value="<?php echo $usname?>">
                          <input type="hidden" name="us_email" id="us_email" value="<?php echo $user_details[0]->email?>">   
                           <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_details[0]->user_id?>">
                                                
                          <input type="hidden" name="status_update_date" id="status_update_date" value="<?php echo date("Y-m-d H:i:s");?>">
                         
                          <input type="hidden" name="cashback_id" id="cashback_id" value="<?php echo $missing_cashback->cashback_id; ?>">
                           <input type="hidden" name="retailer_name" id="retailer_name" value="<?php echo $missing_cashback->retailer_name; ?>">
                          
                          <input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $stat_num; ?>">
                           
                          
                           <div class="form-actions"> 
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success">
                           </div>
						   <?php
							 }
							 else
							 {
								 ?>
                                 <div class="control-group">
                                      <label class="control-label">Missing Cashback Status</label>
                                      <div class="controls">
                                      <label class="span6"><a class="btn btn-success btn-xs pop" href="javascript:void(0);"> Completed </a></label>
                                      </div>
                                   </div>
                                 <?php
							  }
						   ?>
						   <?php echo form_close(); ?>
						   <?php  } ?>
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
      <script type="text/javascript">
	  function sa(stats)
	  {
		  if(stats==1)
		  {
			 // alert('sasa');
			  
			  $("#cancel_reason").show();
	      }
		  else
		  {
			    $("#cancel_reason").hide();
		  }
		  if(stats==0)
		  {
				$('#Cashback_Return_Amount').show();			  			
		  }
		  else
		  {
			    $('#Cashback_Return_Amount').hide();
		  }
	  }
	  
	  function showset(actn)
	  {
		  if(actn=='show')
		  {
			  $('#sample_hide').show();
			  $('#sample').hide();
		 		$("#showset").show();
		  }
		  else
		  {
			    $('#sample_hide').hide();
			  $('#sample').show();
			  	$("#showset").hide();		  
		  }
	  }
	  function samplesub()
	  {
		  var change_sta = $('#change_sta').val();
		  if(change_sta==0)
		  {
			 var Cashback_Return_Amount =  $('#ret_amut').val();
			 if(Cashback_Return_Amount=="")
			 {
				 $('#ret_amut').css('border', '2px solid red');
				 return false;
			 }
			 else
			 {
				 return true;
			 }
			  
		  }
		 }
  </script>
  <script>
   	function bluramount(max_shipping_time)
	 {
		max_shipping_time = max_shipping_time.replace(/[^0-9\.]/g,'');
		if(max_shipping_time.split('.').length>2) 
		max_shipping_time = max_shipping_time.replace(/\.+$/,"");
		$('#ret_amut').val(max_shipping_time);
	 }
   </script>
  
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