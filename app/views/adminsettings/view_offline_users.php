<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Offline User Details | <?php echo $admin_details->site_name; ?> Admin</title>
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
                     User Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
               <span class="divider">&nbsp;</span>
                       </li>
             <li>
              <?php echo anchor('adminsettings/pending_offline','Offline Users'); ?>
              <span class="divider">&nbsp;</span>
                       </li>
                       <li>
              User Details<span class="divider-last">&nbsp;</span>
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
                        <h4><i class="icon-cog"></i>Offline User Details</h4>
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
            // print_r($res);die;
            if($res){
            foreach($res as $rr) {
              $attribute = array('role'=>'form','method'=>'post','class'=>'form-horizontal'); 
              echo form_open('adminsettings/update_offline/'.$rr->offline_userid,$attribute);
            ?>
                           <div class="control-group">
                              <label class="control-label">First Name</label>
                              <div class="controls">
                <label class="span6"><?php echo $rr->first_name; ?></label>
                              </div>
                           </div>
            
               <div class="control-group">
                              <label class="control-label">Last Name</label>
                              <div class="controls">
                <label class="span6"><?php echo $rr->last_name; ?></label>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">User Name</label>
                              <div class="controls">
                <label class="span6"><?php echo $rr->user_name; ?></label>
                              </div>
                           </div>
                             <div class="control-group">
                              <label class="control-label">User Email</label>
                              <div class="controls">
                <label class="span6"><?php echo $rr->user_email; ?></label>
                              </div>
                           </div>
                             <div class="control-group">
                              <label class="control-label">Contact No</label>
                              <div class="controls">
                <label class="span6"><?php echo $rr->contact_no; ?></label>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Business Address</label>
                              <div class="controls">
                <label class="span6"><?php echo $rr->buisness_address; ?></label>
                              </div>
                           </div>
                            <div class="control-group">
                              <label class="control-label">Country</label>
                              <div class="controls">
                <label class="span6">
                  <?php
         $country = $this->admin_model->get_country($rr->country);
         if($country!=''){
          echo $country->country_name;
          }
          else
          {
            echo '';
          }
              ?>
                    </label>
                              </div>
                           </div>
                            <div class="control-group">
                              <label class="control-label">City</label>
                              <div class="controls">
                <label class="span6"> <?php 
                    // get_city
                    // echo $coupon->city;
                    $city = $this->admin_model->get_city($rr->city);
                    if($city!='')
                    {
                      echo  $city->city_name; 
                    }
                    else
                    {
                      echo '';
                    }
                    ?></label>
                              </div>
                           </div>
                          
                            <div class="control-group">
                              <label class="control-label">Document</label>
                              <div class="controls">
                                <a href="<?php echo base_url();?>/uploads/user/<?php echo $rr->upload_doc;?>" download="<?php echo $rr->upload_doc;?>"><?php echo $rr->upload_doc;?></a></div>
                           </div>
                            <div class="control-group">
                              <label class="control-label">Status</label>
                              <div class="controls">
                <select name="status" id="status">
                <option value="1" <?php if($rr->admin_status=='1')
                {
                  echo 'selected';
                }?>>Active</option>
                  <option value="0" <?php if($rr->admin_status=='0')
                {
                  echo 'selected';
                }?>>Deactive</option>
                </select>
                              </div>
                           </div><div class="chk_reason" style="<?php if($rr->admin_status=='0')
                {
                  echo 'display:block';
                }
                else
                {
                  echo "display:none";
                }?>">
                            <div class="control-group">
                              <label class="control-label">Reason</label>
                              <div class="controls">
                <textarea type="text" name="reason" id="reason"><?php if($rr->reason!="")
                {
                  echo $rr->reason;
                }?></textarea>
                              </div>
                           </div></div>
                           <input type="hidden" name="user_id" id="user_id" value="<?php echo $rr->offline_userid; ?>">
             
                          
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success">
                           </div>
               
               <?php echo form_close(); ?>
               <?php }} ?>
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
       <script>
        $('#status').change(function()
        {
          var val=$(this).val();
          if(val=='0')
          {
            $('.chk_reason').show();
          }
          if(val=='1')
          {
            $('#reason').val('');
            $('.chk_reason').hide();
          }
        });
       </script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
