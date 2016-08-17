<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Retailer | <?php echo $admin_details->site_name; ?> Admin</title>
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
<style>
   body
{
  font-family: Arial, Sans-serif;
}
.error
{
color:red;
font-family:verdana, Helvetica;
}
 </style>
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
                     Retailer Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/affiliates','Retailer'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							Retailers Details<span class="divider-last">&nbsp;</span>
                       </li>
                   </ul>
                   <span style="float:right">
                   <a href="<?php echo base_url();?>adminsettings/affiliates" class="btn btn-success">View Retailer</a> &nbsp;
                   <a href="<?php echo base_url();?>adminsettings/bulk_store" class="btn btn-success">Import Retailers</a></span>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-file"></i> Retailer</h4>
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
						$sess_affiliate_desc = $this->session->flashdata('affiliate_desc');
						$sess_affiliate_name = $this->session->flashdata('affiliate_name');
						$sess_logo_url = $this->session->flashdata('logo_url');
						$sess_meta_keyword = $this->session->flashdata('meta_keyword');
						$sess_meta_description = $this->session->flashdata('meta_description');
						$sess_cashback_percentage = $this->session->flashdata('cashback_percentage');

							$attribute = array('role'=>'form','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/addaffiliate',$attribute);
						?>
						
                           <div class="control-group">
                              <label class="control-label">Retailer Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="affiliate_name" id="affiliate_name" value="<?php if($sess_affiliate_name!=""){ echo $sess_affiliate_name;  }?>"  />
                              </div>
                           </div>
                           
                           <!-- <div class="control-group">
                              <label class="control-label">Webiste URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="site_url" id="site_url" value="" required />
                              </div>
                           </div>-->
						   
						   <div class="control-group">
                              <label class="control-label">Retailer URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="url" class="span6" name="logo_url" id="logo_url" value="<?php if($sess_logo_url!=""){ echo $sess_logo_url;  }?>"  />
                              </div>
                           </div>
						   
						    <div class="control-group">
                              <label class="control-label">Meta Keyword <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="meta_keyword" id="meta_keyword" value="<?php if($sess_meta_keyword!=""){ echo $sess_meta_keyword;  }?>" required />
                              </div>
                           </div>
						      
                           <div class="control-group">
                              <label class="control-label">Meta Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6" name="meta_description" rows="5" id="meta_description" required><?php if($sess_meta_description!=""){ echo $sess_meta_description; }?></textarea>	
                              </div>
						   </div>
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Logo <span class="required_field">*</span></label>
							  <span>Note: Retailer Logo should be in (150 * 93) in size</span>
                              <div class="controls">
							     <input type="file" class="span6" required name="affiliate_logo" id="affiliate_logo" />
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label">Retailer Category </label>
                              <?php
							 $category_list =  $this->admin_model->categories();
							?>
                             <div class="controls container">
                                <div class="span4" id="tree_width" style="">
                                <ul id="tree" class="checktree-root">
                            <?php
							 foreach($category_list as $cate)
							 {
								 ?>
								 <li>
                                    <label>
                                      <input name="categorys_list[]" value="<?php echo $cate->category_id;?>" type="checkbox"><?php echo $cate->category_name;?></label>
                                        
                                  </li>
                                 <?php

						     }
							 
							  ?>
                             
                               
                                  </ul></div>
                              </div>
                           </div>
                           
                           

						  <div class="control-group">
                              <label class="control-label">Retailer Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="affiliate_desc" id="affiliate_desc">
								<?php 
								if($sess_affiliate_desc!=""){
									echo $sess_affiliate_desc;
								}								
								?>
								</textarea>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label">Cashback Type</label>
                              <div class="controls">
                              <select name="affiliate_cashback_type">
							  <option value="" >Select</option>
								  <option value="Percentage">Percentage</option>
								  <option value="Flat">Flat</option>
							  </select>
                              </div>
                           </div>
                           
                           
						   
						   <div class="control-group">
                              <label class="control-label">Cashback for user </label>
                              <div class="controls">
                                <input type="text" class="span3" name="cashback_percentage" id="cashback_percentage" value="<?php if($sess_cashback_percentage!=""){ echo $sess_cashback_percentage;  }?>" />  
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Status</label>
                              <div class="controls">
                              <select name="affiliate_status">
								  <option value="1">Active</option>
								  <option value="0">De active</option>
							  </select>
                              </div>
                           </div>
                           
                           
                          
						   <div class="control-group">
                              <label class="control-label">Featured </label>
                              <div class="controls">
                                <input type="checkbox" class="span3" name="featured" id="featured" value="1" />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Of The Week </label>
                              <div class="controls">
                                <input type="checkbox" class="span3" name="store_of_week" id="store_of_week" value="1" />

                              </div>
                           </div>
						   <!-- Added Section 28/11/14 -->
						      <div class="control-group">
                              <label class="control-label">Retailer Banner Images </label>
                              <div class="controls">
								<input type="file" name="coupon_image[]" id="coupon_image[]" multiple class="span6">  <br><span>Note: Banner image should be in (1920 * 555) in size</span><!-- seetha-->
								 
									
                              </div>
                           </div>
                           
                           
                           <!-- <div class="control-group">
                              <label class="control-label">Retailer Banner URL</label>
                              <div class="controls">
                                <textarea class="span6" name="retailer_ban_url" rows="5" id="retailer_ban_url" ></textarea>	
                              </div>
						   </div>-->
                           
                           
                           <div class="control-group">
                              <label class="control-label">How to Get this Offer</label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="how_to_get_this_offer" id="how_to_get_this_offer"></textarea>
                              </div>
                           </div>
                           
                           
                            <div class="control-group">
                              <label class="control-label">Terms & Conditions  </label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="terms_and_conditions" id="terms_and_conditions"></textarea>
                              </div>
                           </div>
                           
                           
                    <!--        <div class="control-group">
                              <label class="control-label">Sidebar Image </label>
							  <span>Note: Sidebar image should be in (180 * 35) in size</span> <div class="controls">
                                <input type="file" name="sidebar_image" id="sidebar_image"/><br>
                               
                              </div>
                           </div>
                           
                           
                             <div class="control-group">
                              <label class="control-label">Sidebar URL</label>
                              <div class="controls">
                                <textarea class="span6" name="sidebar_image_url" rows="5" id="sidebar_image_url" ></textarea>	
                              </div>
						   </div> -->
						   
						   
						   <!-- Added Section 28/11/14 -->
						   
                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success" id='valid'>
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
							echo form_open('adminsettings/updateaffiliate',$attribute);
						?>
                            <div class="control-group">
                              <label class="control-label">Retailer Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="affiliate_name" id="affiliate_name" value="<?php echo $affiliate_name; ?>" />
                              </div>
                           </div>
                           
						  <!-- <div class="control-group">
                              <label class="control-label">Website URL<span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="site_url" id="site_url" value="<?php echo $site_url;?>" required />
                              </div>
                           </div>-->
                           
						   <div class="control-group">
                              <label class="control-label">Retailer URL<span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="url" class="span6" name="logo_url" id="logo_url" value="<?php echo $logo_url;?>" />
                              </div>
                           </div>
						   
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
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Logo <span class="required_field">*</span></label>
							  Note: Retailer Logo should be in (150 * 93) in size<!-- seetha-->
                              <div class="controls">							    
                                <input type="file" name="affiliate_logo" id="affiliate_logo"/><br>
								<img src="<?php echo base_url();?>uploads/affiliates/<?php echo $affiliate_logo; ?>" width="180" height="35">
                              </div>
                           </div>
                           
                             <div class="control-group">
                              <label class="control-label">Retailer Category </label>
                              <?php
							 $category_list =  $this->admin_model->categories();
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
                                      <input name="categorys_list[]" value="<?php echo $cate->category_id;?>" <?php if(in_array($cate->category_id,$sel_category)){ echo 'checked="checked"';} ?> type="checkbox"><?php echo $cate->category_name;?></label>
                                      
                                        
                                  </li>
                                 <?php

						     }
							 
							  ?>
                                  </ul></div>
                              </div>
                           </div>
						   
						   <input type="hidden" name="affiliate_id" id="affiliate_id" value="<?php echo $affiliate_id; ?>">
						   <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $affiliate_logo; ?>">
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="affiliate_desc" id="affiliate_desc"><?php echo $affiliate_desc; ?></textarea>
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Cashback Type</label>
                              <div class="controls">
                              <select name="affiliate_cashback_type">
							  <option >Select</option>
								  <option <?php if($affiliate_cashback_type=='Percentage'){ echo 'selected="selected"'; } ?> value="Percentage">Percentage</option>
								  <option <?php if($affiliate_cashback_type=='Flat'){ echo 'selected="selected"'; } ?> value="Flat">Flat</option>
							  </select>
                              </div>
                           </div>
                           
						   
						    <div class="control-group">
                              <label class="control-label">Cashback for user </label>
                              <div class="controls">
                                <input type="text" class="span3" name="cashback_percentage" id="cashback_percentage" value="<?php echo $cashback_percentage; ?>" /> 
                              </div>
                           </div>
						
						    <div class="control-group">
                              <label class="control-label">Retailer Status</label>
                              <div class="controls">
                              <select name="affiliate_status">
								  <option value="1" <?php if($affiliate_status=='1'){ echo 'selected="selected"'; } ?>>Active</option>
								  <option value="0" <?php if($affiliate_status=='0'){ echo 'selected="selected"'; } ?>>De active</option>
							  </select>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Featured </label>
                              <div class="controls">
                                <input type="checkbox" class="" name="featured" id="featured" value="1" <?php if($featured=="1"){ echo 'checked="checked"';} ?> />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Of The Week </label>
                              <div class="controls">
                                <input type="checkbox" class="" name="store_of_week" id="store_of_week" value="1" <?php if($store_of_week=="1"){ echo 'checked="checked"';} ?> />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Retailer Banner Images </label>
								<div class="controls">								
                                <span>	Note: Banner image should be in (1920 * 555) in size</pan><br><!-- seetha-->
								<input type="file" name="coupon_image[]" id="coupon_image[]" multiple class="span6">
								  <br> 
									<?php
										$coupon_image = explode(',',$coupon_image);
									/*	print_r($coupon_image);
										exit;*/
										if($coupon_image[0])
										{
										foreach($coupon_image as $get){
											?>
										  <img src="<?php echo base_url(); ?>uploads/store_banner/<?php echo $get; ?>" width="175" height="50">
										<?php }
										}
										$coupon_image = implode(',',$coupon_image);
								  ?>
                              </div>
                           </div>
                           
                              <div class="control-group">
                              <label class="control-label">Retailer Banner URL</label>
                              <div class="controls">
                                <textarea class="span6" name="retailer_ban_url" rows="5" id="retailer_ban_url" ><?php echo $retailer_ban_url; ?></textarea>	
                              </div>
						   </div>
                           
                           
                           
                            <div class="control-group">
                              <label class="control-label">How to Get this Offer</label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="how_to_get_this_offer" id="how_to_get_this_offer"><?php echo $how_to_get_this_offer; ?></textarea>
                              </div>
                           </div>
                           
                           
                            <div class="control-group">
                              <label class="control-label">Terms & Conditions  </label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="terms_and_conditions" id="terms_and_conditions"><?php echo $terms_and_conditions; ?></textarea>
                              </div>
                           </div>
                           
                           
                          <!--  <div class="control-group">
                              <label class="control-label">Sidebar Image </label>
                              <div class="controls">
                                <input type="file" name="sidebar_image" id="sidebar_image"/><br>
								<span>Note: Sidebar image should be in (180 * 35) in size</span><br>
                
                                <?php
								if($sidebar_image)
								{
								?>
								<img src="<?php echo base_url();?>uploads/sidebar_image/<?php echo $sidebar_image; ?>" width="180" height="35">
                                <?php
								}
								?>
                              </div>
                           </div>
                           
                           
                             <div class="control-group">
                              <label class="control-label">Sidebar URL</label>
                              <div class="controls">
                                <textarea class="span6" name="sidebar_image_url" rows="5" id="sidebar_image_url" ><?php echo $sidebar_image_url; ?></textarea>	
                              </div>
						   </div> -->
                           
                           
						   <input type="hidden" name="sidebar_image_hid" id="sidebar_image_hid" value="<?php echo $sidebar_image; ?>">

						   <input type="hidden" name="hidden_coupon_image" id="hidden_coupon_image" value="<?php echo $coupon_image; ?>">
                          
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success" id='valid1'>
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
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> 


<script>
$('#tree').checktree();

$('#valid').click(function()
{
	
 $("#change_pwd").validate({
	 ignore: [],
	 debug: false,
    rules: {
        affiliate_name: "required",
       affiliate_desc:{
		    required: function() 
                        {
                         CKEDITOR.instances.affiliate_desc.updateElement();
                        },

                         minlength:10
	   },
        logo_url: {
            required: true,
            url: true
           
        },
		'categorys_list[]': {
                required: true,
                
            }
		
    },
    messages: {
        affiliate_name: "Enter Retailer name",
        affiliate_desc:{
			required:"Please enter Description",
                        minlength:"Please enter 10 characters"
		},
        logo_url: {
            required: "Enter Url",
           url:"enter correct format"
        },
		'categorys_list[]': {
                required: "You must check at least 1 category",

            }
		
    },
	errorPlacement: function(error, element) 
        {
            if ( element.is(":checkbox") ) 
            {
                error.appendTo( element.parents('.container') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         },
	 submitHandler: function(form) {
                    form.submit();
                }
});
});


</script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>