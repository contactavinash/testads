<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Upload Products | <?php echo $admin_details->site_name; ?> Admin</title>
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
                     Upload Products
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/uploadproducts','Upload Products'); ?>
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
                        <h4><i class="icon-file"></i> Upload Products</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div><br>
					 <span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked field is mandatory.</span><br>

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
							$attribute = array('role'=>'form','name'=>'bulkproduct','method'=>'post','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit'=>'return ValidateFileUpload();'); 
							echo form_open('adminsettings/uploadproducts',$attribute);
						?>

						 <!--  <div class="control-group">
                              <label class="control-label">Affiliate Network </label>
                              <div class="controls">
                                <select name="coupon_type">
									<option value="VCommission">VCommission</option>
									<option value="Icubewire">Icubewire</option>
								</select>
                              </div>
                           </div>-->
						   
						   <div class="control-group">
                              <label class="control-label">Upload Product File <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" name="bulkproduct" id="bulkproduct"><span style="margin-left: 10px;"><a style="color: rgb(135, 206, 4);" href="<?php echo base_url(); ?>uploads/csv_examples/products.csv"><img align="absmiddle" src="<?php echo base_url(); ?>front/images/csv.png"> example.csv</a></span>
								<br>
								<span id="error_file"></span>
								<br>
								  <p>Supported File Formats : .csv </p>
                              </div>
                           </div>
						   <div class="control-group">
						   <label class="control-label">Select Store </label>
			   <div class="controls">
			  <?php  $get_stores = $this->admin_model->get_online_stores(); ?>
			   <select data-placeholder="Stores" class="chosen span6 cat_spe" name="store_id"  tabindex="6"  id="str_id">
			   <option value="">Select Store<option>
                    <?php
          if($get_stores)
          {   
            // $category_specifi = explode(',',$category_specifications);        
            foreach($get_stores as $str)
            {
              echo '<option value="'.$str->affiliate_id.'">'.$str->affiliate_name.'</option>';
            }
          }
          ?>
                  </select>
				  <br>
								<span id="error_file1"></span>
								<br>
			  
			   </div>
			   </div>


                            <div class="control-group">
                <label class="control-label">Product Categories </label>
                <div class="controls">
                <?php
                  $active_products = $this->admin_model->active_products();
                ?>
                  <select data-placeholder="Product Category" class="chosen span6 cat_spe" name="parent_id"  tabindex="6" onchange="return change_categories(this.value,'1');" id="par_id">
				  <option value="">Select Category<option>
                    <?php
          if($active_products)
          {   
            // $category_specifi = explode(',',$category_specifications);        
            foreach($active_products as $act_prod)
            {
              echo '<option value="'.$act_prod->cate_id.'">'.$act_prod->category_name.'</option>';
            }
          }
          ?>
                  </select>
				  <br>
								<span id="error_file2"></span>
								<br>
				  				
								
				  
                  <div class="show_product"></div>
                </div>
              </div>
			  
			   <div class="control-group">
			   <div class="controls">
			   <select  id="tags" class="span6"  onchange="return change_categories(this.value,'2');" style="display:none;" name="parent_child_id">
					</select>
					</div>
			   </div>
			   <div class="control-group">
			   <div class="controls">
			   <select  id="subbb" class="span6" style="display:none;" name="child_id">
					</select>
			   
			   <div></div>
               <div class="control-group">
			   <div class="controls">
			   <input type="checkbox" value="1" name="price_compare"> don't want price comparision for this products
			   </div></div>

                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success">
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
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
          App.init();

          });

       </script><?php $this->load->view('adminsettings/footer_script'); ?>
<script type="text/javascript">
function ValidateFileUpload() {
	var avatar = $("#bulkproduct").val();
	var ext = avatar.split('.').pop().toLowerCase();
	var str=$("#str_id").val();
	var cat=$("#par_id").val()
	//alert(str);
	if(ext == ''){
		$('#error_file').css('color','red').text('Choose your upload file.');
		return false;
	}else if(ext != 'csv'){	
		$('#error_file').css('color','red').text('Invalid File Format.');
		return false;
	}
	if(str == ''){
		$('#error_file1').css('color','red').text('Choose Stores.');
		return false;
	}
	if(cat == ''){
		$('#error_file2').css('color','red').text('Choose Category.');
		return false;
	}
}

function change_categories(id,tp)
{
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>adminsettings/change_categories1',
		data:{'cat_id':id},
		success:function(msg){
			if(msg!=0)
			{
			if(tp==1)
			{
			$('#tags').show();
			$('#tags').html(msg);
			}
			if(tp==2)
			{
			$('#subbb').show();
			$('#subbb').html(msg);
			}
			}
			else
			{
				$('#subbb').hide();
			}
			
		}
		
		
	})
}

</script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>