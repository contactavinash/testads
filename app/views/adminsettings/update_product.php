<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD --><head>
	<meta charset="utf-8" />
	<?php $admin_details = $this->admin_model->get_admindetails(); ?>
 	<title>Update Product | <?php echo $admin_details->site_name; ?> Admin</title>
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
   
    <!-- jquery slider -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/jslider/css/jslider.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/jslider/css/jslider.blue.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/jslider/css/jslider.plastic.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/jslider/css/jslider.round.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/jslider/css/jslider.round.plastic.css" type="text/css">
    <!-- end -->
	
	<link href="<?php echo base_url();?>assets/assets/dropzone/css/dropzone.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/assets/dropzone/css/dropzone2.css" rel="stylesheet"/>
	
<style>
	#sample_1 th
	{
	   text-align:center !important;
	}
	.dropzone1
	{
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0.03);
		border: 1px solid rgba(0, 0, 0, 0.03);
		border-radius: 3px;
		min-height: 360px;
		padding: 23px;
	}

	.panel-heading .accordion-toggle:after {
		/* symbol for "opening" panels */
		font-family: 'FontAwesome';  /* essential for enabling glyphicon */
		content: "\f056";    /* adjust as needed, taken from bootstrap.css */
		float: right;        /* adjust as needed */
		color: grey;         /* adjust as needed */
	}
	.panel-heading .accordion-toggle.collapsed:after {
		/* symbol for "collapsed" panels */
		content: "\f055";    /* adjust as needed, taken from bootstrap.css */
	}
	.panel-heading h4{
		background-color: #efefef;
		padding: 10px;
		margin-bottom:10px !important;
	}
	
</style>
   
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top" >
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
                  <h3 class="page-title">
                     Update Product
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/products','Products'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							Product Details<span class="divider-last">&nbsp;</span>
                       </li>
                   </ul>
				    <?php echo anchor('adminsettings/products','<button style="float:right" class="btn btn-success">View Products</button>'); ?>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
			<div class="row-fluid">
   <div class="span12">
	  <div id="form_wizard_1" class="widget box blue">
		 <div class="widget-title">
			<h4>
			   <i class="icon-reorder"></i> Update Product Details
			</h4>
			<span class="tools">
			   <a class="icon-chevron-down" href="javascript:;"></a>
			   <a class="icon-remove" href="javascript:;"></a>
			</span>
		 </div>
		 
		  <div class="widget-body form">
          
          <div class="alert alert-success" id="alertsuccess" style="display: none;">
            <button class="close" data-dismiss="alert">x</button>
            <strong>Success! </strong> Product details updated successfully.
           </div> 
                                        
                                        
			<?php 
				$error = $this->session->flashdata('error');
				if($error!="") {
					echo '<div class="alert alert-error">
					<button data-dismiss="alert" class="close">x</button>
					<strong>Error! </strong>'.$error.'</div>';
				} 
				
				$success = $this->session->flashdata('success');
				if($success!="") {
					echo '<div class="alert alert-success">
								<button data-dismiss="alert" class="close">x</button>
								<strong>Success! </strong>'.$success.'</div>';			
				}
				$update_id = $product->product_id;
			?>
			
			   <div class="form-wizard">
				  <div class="navbar steps">
					 <div class="navbar-inner">
						<ul class="row-fluid nav nav-pills">
						   <li class="span2 active">
							  <a id="tab1cl" class="step active" data-toggle="tab" href="#tab1">
							  <span class="number">1</span>
							  <span class="desc"><i class="icon-ok"></i> Product </span>
							  </a>
						   </li>
						   
						   <li class="span2">
							  <a id="tab2cl" class="step" data-toggle="tab" href="#tab5">
							  <span class="number">2</span>
							  <span class="desc"><i class="icon-ok"></i> Brands</span>
							  </a> 
						   </li>
						 
						   <li  class="span2">
							  <a id="tab3cl" class="step" data-toggle="tab" href="#tab2">
							  <span class="number">3</span>
							  <span class="desc"><i class="icon-ok"></i> Gallery</span>
							  </a>
						   </li>
						   <li class="span2">
							  <a id="tab4cl" class="step" data-toggle="tab" href="#tab3">
							  <span class="number">4</span>
							  <span class="desc"><i class="icon-ok"></i> Stores</span>
							  </a>
						   </li>
						   <li class="span2">
							  <a id="tab5cl" class="step" data-toggle="tab" href="#tab4">
							  <span class="number">5</span>
							  <span class="desc"><i class="icon-ok"></i> Specifications</span>
							  </a> 
						   </li>
						   
						    
						</ul>
					 </div>
					 <br><span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked fields are mandatory.</span><br>
					
				  </div>
				  
				  
				  <!--<div class="progress progress-striped" id="bar">
					 <div class="bar" style="width: 25%;"></div>
				  </div>-->
				  
				  <div class="tab-content">
				  
					 
				 <div id="tab5" class="tab-pane">
					<?php
						
						$attribute = array('method'=>'post','enctype'=>'multipart/form-data','class'=>'form-horizontal','id'=>'brandsform','onSubmit'=>'return check_brads();'); 
						echo form_open('adminsettings/update_product/'.$update_id,$attribute);
					?>
                     <input type="hidden" name="save" value="Save">
					 <input type="hidden" value="brands" name="type" />
					 <div class="control-group">
						<label class="control-label">Brands <span class="required_field">*</span></label>
						  <div class="controls">
							<select data-placeholder="Choose Brands" class="chosen brand_name span6" id="brands" name="brands" tabindex="6" id="brands" style="width:400px;height:50px;">
							<?php 
							$brand = $this->admin_model->fetch_product_brand($update_id);
							if($brand){
								$brand_id = explode(',',$brand->category_brands);
								if($brand_id){
									foreach($brand_id as $brand_id){
										$brand_name = $this->admin_model->get_details_from_id($brand_id,'brands','brand_id');
										$brand_ids = $brand_name->brand_id;
										$product_brands = explode(',',$product->brands);
										//print_r($product_brands);
										if(in_array($brand_id,$product_brands)){
											$select = 'selected';
										}else{
											$select = '';
										}
							?>
									<option value="<?php echo $brand_id; ?>" <?php echo $select; ?>><?php echo $brand_name->brand_name; ?></option>;
							<?php		
								}}
							}
							?>
							</select>
						</div>
					   </div>
				   
				   <div class="" align="center" style="clear: both; overflow: hidden;">
					  <input type="submit" name="save" value="Save" id="submitlevel2" class="btn btn-success">
                       <img style="display:none" id="showajaxloadimbrands" src="<?php echo base_url();?>assets/img/loadaing.gif">
				   </div>
			   <?php echo form_close(); ?>
						   
					</div>
				
					 <div id="tab1" class="tab-pane active">
                     
                    
                     
                     
					 
						 <!--<form action="#" class="form-horizontal">-->
						<?php
							
							$attribute = array('role'=>'form','name'=>'product','method'=>'post','id'=>'product','enctype'=>'multipart/form-data','class'=>'form-horizontal'); 
							echo form_open('adminsettings/update_product/'.$update_id,$attribute);
							$parent_id = $product->parent_id;
							$parent_child_id = $product->parent_child_id;
							$child_id = $product->child_id;
							
							if($parent_child_id == '0')
								$style = 'style="display:none"';
							else
								$style = '';
							
							if($child_id == '0')
								$style_child = 'style="display:none"';
							else
								$style_child = '';
							
							
						?>
						 <input type="hidden" value="general" name="type" />
						 <input type="hidden" id="hidden_image_src" value="<?php echo $product->product_image; ?>" name="hidden_image" />
						 
                           <div class="control-group">
                              <label class="control-label">Product Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="product_name" id="product_name" value="<?php echo $product->product_name; ?>" onblur="return check_product();"  required />
                                
                                <input type="hidden" name="proname" id="proname" value="<?php echo $product->product_name; ?>">
								<div id="unique_name_error"></div>
                              </div>
							  <input type="hidden" class="span6" name="hidden_product_name" id="hidden_product_name" value="<?php echo $product->product_name; ?>">
                           </div>
						   
						  <div class="control-group">
                              <label class="control-label">Category <span class="required_field">*</span></label>
                              <div class="controls">
								  <select name="parent_id" class="span6" onChange="fetch_first_level(this.value,'main')" required >
									<option value=""> Select </option>		
									<?php 
										if($main_category){
											foreach($main_category as $main_cat){
										?>
										<option value="<?php echo $main_cat->cate_id; ?>" <?php if($product->parent_id == $main_cat->cate_id) echo 'selected'; ?>><?php echo $main_cat->category_name; ?></option>
									<?php }} ?>
									
								  </select>
                              </div>
                           </div>

						   
						<!--<div class="control-group sub_category" style="display:none">
							<label class="control-label">Sub Category</label>
							<div class="controls">
								<select data-placeholder="Category Filters" class="chosen span6" name="sub_cate_id[]" multiple="multiple" tabindex="6" id="tags" style="width:400px;height:50px;" onBlur="fetch_child_level(this.value)">
									
								</select>
							</div>
						</div>-->
						
						<div class="control-group sub_category" <?php echo $style; ?>>
							<label class="control-label">Sub Category</label>
							<div class="controls">
								<select class="span6" name="parent_child_id" id="tags" onChange="fetch_first_level(this.value,'sub')">
									<?php 
										$sub_cat = $this->admin_model->product_categories($parent_id);
										
										if($sub_cat){
											foreach($sub_cat as $sub_cat){
										?>
										<option value="<?php echo $sub_cat->cate_id; ?>" <?php if($product->parent_child_id == $sub_cat->cate_id) echo 'selected'; ?>><?php echo $sub_cat->category_name; ?></option>
									<?php }} ?>	
								</select>
							</div>
						</div>
			  
						 <div class="control-group child_category" <?php echo $style_child; ?>>
							<label class="control-label">Sub Category Child</label>
							<div class="controls">
								<select class="span6" name="child_id" id="child">
									<?php 
										$child_cat = $this->admin_model->product_categories($parent_child_id);
										
										if($child_cat){
											foreach($child_cat as $child_cat){
										?>
										<option value="<?php echo $child_cat->cate_id; ?>" <?php if($product->child_id == $child_cat->cate_id) echo 'selected'; ?>><?php echo $child_cat->category_name; ?></option>
									<?php }} ?>
								</select>
							</div>
						</div> 
                        
                        <div class="control-group">
                            <label class="control-label">Product Search Tags <span class="required_field">*</span></label>
                            <div class="span5">
                            
                               <input id="tags_1" type="text" name="product_tags" class="m-wra tags" value="<?php echo $product->product_tags; ?>" />
								<br><span id="error_tags"></span>
                            </div>
                         </div>
                         
                         
						  
						  <div class="control-group cat_image">
                              <label class="control-label">Product Image <span class="required_field">*</span></label>
                              <div class="controls">
                                
								<img id="product_image_src" src="<?php echo base_url().'uploads/products/'.$product->product_image; ?>" alt="" height="100" width="100"/> <br>
								<input type="file" class="span6" name="product_image" id="product_image"/><br>
								<!--<span>Note: Category Image should be minimum of (150 * 150) in size</span><br>-->
								<p id="display_error_img"></p>
                              </div>
                           </div>
						   
						 <div class="control-group">
							<label class="control-label">Product Description <span class="required_field">*</span></label>
							<div class="controls">
								<textarea id="product_description" class="span6 ckeditor" name="product_description"><?php echo stripslashes($product->description); ?></textarea>
								<br><span id="error_des"></span>
							</div>
						</div>
						
						<div class="control-group">
                              <label class="control-label">MRP <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="mrp"  id="mrp" value="<?php echo $product->mrp; ?>" required />
								<div id="unique_name_error"></div>
                              </div>
                           </div>
						   
						<!--   <div class="control-group">
                              <label class="control-label">Discount Percentage <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="discount"  id="discount" value="<?php echo $product->discount; ?>" required />
								<div id="unique_name_error"></div>
                              </div>
                           </div>-->
						   
						   <div class="control-group">
                              <label class="control-label">COD Available <span class="required_field">*</span></label>
                              <div class="controls">
                              <select name="codAvailable" required>
								  <option <?php if($product->codAvailable=='FALSE'){echo "selected='selected'";}?> value="TRUE">Yes</option>
								  <option<?php if($product->codAvailable=='FALSE'){echo "selected='selected'";}?> value="FALSE">No</option>
							  </select>
                              </div>
                           </div>
						   
						   
						    <div class="control-group">
                              <label class="control-label">EMI Available <span class="required_field">*</span></label>
                              <div class="controls">
                              <select name="emiAvailable" required>
								  <option <?php if($product->emiAvailable=='TRUE'){echo "selected='selected'";}?> value="TRUE">Yes</option>
								  <option <?php if($product->emiAvailable=='FALSE'){echo "selected='selected'";}?> value="FALSE">No</option>
							  </select>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Size</label>
                              <div class="controls">
                              <input type="text" class="span6" name="size"  id="size" value="<?php echo $product->size; ?>"  />
                              </div>
                           </div>
						   
						   
						   <div class="control-group">
                              <label class="control-label">Color</label>
                              <div class="controls">
                              <input type="text" class="span6" name="color"  id="color" value="<?php echo $product->color; ?>"  />
                              </div>
                           </div>
						   
                           
                            <div class="control-group">
							<label class="control-label">Key Features </label>
							<div class="controls">
								<textarea id="key_feature" class="span6" name="key_feature"><?php echo $product->key_feature; ?></textarea>&nbsp; <span class="">Please use comma Separater</span>
							</div>
						</div>
                        
                        
						
						
						
						<!--<div class="control-group">
						  <label class="control-label">Product Type</label>
						  <div class="controls">
							<input type="checkbox" class="" name="featured" id="featured" value="1" <?php if($product->featured == '1') echo 'checked'; ?>/> Featured Product
						  </div>
						</div>
						
						<div class="control-group">
						  <label class="control-label">Cashback Price</label>
						  <div class="controls">
							<input type="text" class="span6" name="cashback_price" id="cashback_price" value="<?php echo $product->cashback_price; ?>"/>
						  </div>
						</div>-->
						<!--
						<div class="control-group">
						  <label class="control-label">Reward Points</label>
						  <div class="controls">
							<input type="text" class="span6" name="reward_points" id="reward_points" value="<?php echo $product->reward_points; ?>"/>
						  </div>
						</div>-->
						<!--<div class="control-group">
						  <label class="control-label">Rating</label>
						<div class="controls">
                                            
						<?php
						   if($product->rating)
						   {
							for($i=0;$i<$product->rating;$i++) { ?>
							<i style="color:#f07746" class="icon-star"></i> 
							<?php } 
                            }?>
						</div>
						</div> --> 
						<br>
						<!--<div class="form_inputs slider clearfix">
							<div class="row-fluid">
								<div class="span2">
									<label class="control-label"> Rating </label>
								</div>

								<div class="span9">
									<input id="Slider1" type="slider" name="rating" value="<?php echo $product->rating; ?>" />
								</div>
							</div>
						</div>-->
						
					   <div class="form-actions">
                       <input type="hidden" name="save" value="Save">	
						  <input type="button" id="submitlevel1" name="save" value="Save" class="btn btn-success" onClick="validate_product();">
                          <img style="display:none" id="showajaxloadimg" src="<?php echo base_url();?>assets/img/loadaing.gif">
					   </div>
						   <?php echo form_close(); ?>
					 </div>
					 
				<div id="tab2" class="tab-pane">
					<div class="widget" >
					 <div class="widget-title">
                           <h4><i class="icon-globe"></i>Photo Gallery</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>                    
                        </div>
                      <div class="widget-body form">
                          <!--<form action="<?php echo base_url();?>gal_file/upload.php" class="dropzone" id="my-awesome-dropzone">-->
						  <form action="<?php echo base_url();?>adminsettings/upload_product_gallery/<?php echo $update_id; ?>" class="dropzone" id="my-awesome-dropzone">
                          
                          </form>
                      </div>
					</div>
					
					  <div class="widget" >
							<div class="widget-title">
							   <h4><i class="icon-globe"></i>Photo Gallery</h4>
							   <span class="tools">
							   <a href="javascript:;" class="icon-chevron-down"></a>
							   <a href="javascript:;" class="icon-remove"></a>
							   </span>                    
							</div>
							<div class="widget-body dropzone2  formss" id="dropzoneajax" style="height:450px; overflow-y:scroll; width:100%;">
							</div>
					 </div>
					  
					<input type="submit" class="btn btn-success" id="submitlevel3" value="Next" name="save" style="float:right">
				</div>
				
				<div id="tab3" class="tab-pane">
					<div class="panel-group" id="accordion">
					  <div class="panel panel-default">
					<?php
						//$update_id = $product->product_id;
						$attribute = array('role'=>'form','method'=>'post','enctype'=>'multipart/form-data','class'=>'form-horizontal','id'=>'stores_form','onSubmit'=>'return fillall();'); 
						echo form_open('adminsettings/update_product/'.$update_id,$attribute);
						
						if($astore){
							foreach($astore as $astore1){
								$store_name = $this->admin_model->view_store($astore1->affiliate_id);
								$store_url = $this->admin_model->fetch_store_url($astore1->affiliate_id,$update_id);
								 if($store_url){
									$active = 'in';
									$product_url = $store_url->product_url;
									$affiliate_url = $store_url->affiliate_url;
								}else{
									$active = '';
									$product_url = '';
									$affiliate_url = '';
								} 
								
								$remove_list=explode(',',$product->removed_lists);
								
					?>	
                     <input type="hidden" name="save" value="Save">
						<input type="hidden" value="store" name="type" />
						<input type="hidden" value="0" id="url_type_<?php echo $astore1->affiliate_id; ?>" />  					
						<input type="hidden" value="<?php echo $astore1->affiliate_id; ?>" name="store_id[]" id="store_id">
						<div class="panel-heading">
						  <h4 class="panel-title">
						  <input type="checkbox" name="remove_store[]" value="<?php echo $astore1->affiliate_id; ?>" <?php if(in_array($astore1->affiliate_id,$remove_list)){echo "checked";} ?>>
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $astore1->affiliate_id; ?>" onClick="return store_url('<?php echo $astore1->affiliate_id; ?>');" >
							
							  <?php echo $astore1->affiliate_name; ?>
							</a>
						  </h4>
						</div>
						<div id="collapse_<?php echo $astore1->affiliate_id; ?>" class="panel-collapse collapse <?php echo $active; ?>">
						  <div class="panel-body">
						  <div class="control-group">
						  <select class="span9" onchange="return hide_product_select('<?php echo $astore1->affiliate_id; ?>',this.value);" name="product_urls_<?php echo $astore1->affiliate_id; ?>" id="product_url1_<?php echo $astore1->affiliate_id; ?>" style="float:left;display:<?php if($astore1->affiliate_id==85){echo 'none';}else{'block';} ?>">
	                              
	                                <?php
									$store_url1 = $this->admin_model->fetch_store_url1($astore1->affiliate_id,$update_id);

									foreach($store_url1 as $url)
	                        		{ 
	                        			?>
	                                <option value="<?php echo $url->pp_id; ?>" <?php if($url->product_status==1){echo 'selected';} ?>>
	                                 <?php echo '['.$url->affiliate_url.']'.'-'.$url->product_price.'Rs';?> 
	                               </option>
	                                <?php } ?>

                               </select>
							   </div>
							<div class="control-group">
                              <label class="control-label span2">Product URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="url" class="span9" name="product_url[]" id="product_url_<?php echo $astore1->affiliate_id; ?>" value="<?php echo $product_url; ?>" />
								
                              </div>
							</div>
						   
						   <div class="control-group">
                              <label class="control-label span2">Affiliate URL <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="url" class="span9" name="affiliate_url[]" id="affiliate_url_<?php echo $astore1->affiliate_id; ?>" value="<?php echo $store_url->affiliate_url; ?>"/>
                              </div>
							</div>
						   
						  </div>
						</div>
						
					<?php }} ?>	
						<div class="form-actions">
						  <input type="submit" name="save" id="submitlevelstores" value="Save" class="btn btn-success">
                          
                           <img style="display:none" id="showajaxloadimstores" src="<?php echo base_url();?>assets/img/loadaing.gif">
                           
                           
					   </div>
					<?php echo form_close(); ?>
						   
						</div>
					</div>
				</div>
				
				<div id="tab4" class="tab-pane">
					<?php
						//$update_id = $product->product_id;
						
						$attribute = array('role'=>'form','id'=>'form_submit','method'=>'post','enctype'=>'multipart/form-data'); 
						echo form_open('adminsettings/update_product/'.$update_id,$attribute);
						
						$specification = $this->admin_model->fetch_product_specification($update_id);
						if($specification){
							$spec = explode(',',$specification->main_category_specifications);
								
					?>
					<input type="hidden" value="specify" name="type" />
                     <input type="hidden" name="save" value="Save">
					
					<div class="control-group">
						<label class="control-label">Specifications <span class="required_field">*</span></label>
						
						<?php
							$i=1;
							$specify = unserialize($product->specification);
							$specify_option = unserialize($product->specification_option);
							$specify_extra = unserialize($product->specification_extra);
							if($spec){
							foreach($spec as $spec_id){
								$spec_details = $this->admin_model->get_details_from_id($spec_id,'specifications','specid');
								$spec_option = $this->admin_model->specification_options($spec_details->specid);
								//print_r($spec_details);
								$j=1;
								if($spec_details){
						?>
							<div class="controls" style="padding-left:0px;">
								<input type="checkbox" class="span1 spec_detail" name="spec_id[<?php echo $spec_id; ?>]" id="spec_id_<?php echo $i; ?>" value="<?php echo $spec_id; ?>" <?php if(isset($specify[$spec_id])) echo 'checked'; ?> /> <?php echo $spec_details->specification; ?>
							
							<div style="overflow-y:auto;height:250px;width:75%;">
							&nbsp;&nbsp;&nbsp;
							<?php
							if($spec_option){
								foreach($spec_option as $spec_name){
							?>
							
							<div class="row-fluid">
								<div style="padding-left:30px" class="span6">
								<div class="controls">
									<input type="checkbox" class="span5 spec_option spec_option_id_<?php echo $i; ?>" name="spec_option_id[<?php echo $spec_name->specid; ?>]" id="spec_option_id_<?php echo $i.$j; ?>" value="<?php echo $spec_name->specid; ?>" <?php if(isset($specify_option[$spec_name->specid])) echo 'checked'; ?> onClick="return spec_extra_text(<?php echo $i.$j; ?>);" /> <?php echo $spec_name->specification; ?>
								</div>
								</div>
								<?php 
									if(isset($specify_extra[$spec_name->specid])){
										$style = '';
										$disable = '';
									}else{
										$style = 'style="display: none !important;"';
										$disable = 'disabled'; 
									}
								?>
								<div class="span4" id="chk_text_<?php echo $i.$j; ?>" >
									<input type="text" style="margin-bottom: 3px !important" class="spec_extra_<?php echo $i.$j; ?>" name="spec_extra[<?php echo $spec_name->specid; ?>]" id="spec_extra_<?php echo $i.$j; ?>" value="<?php if(isset($specify_extra[$spec_name->specid])) echo $specify_extra[$spec_name->specid]; ?>" onBlur="return clr_border(<?php echo $i.$j; ?>);" />
								</div>
							</div>	
							<?php
								$j++;
							} }
							?>	
							
							</div><br>
						</div>
							<?php $i++; }}} ?>
					</div>
					
				<?php } ?>
				<span id="form_error"></span>
					<div class="form-actions">
						<input type="hidden" name="save" value="Save">
						<input type="button" onClick='return submit_spec();' name="save" id="submitspec" value="Save" class="btn btn-success">
                        <img style="display:none" id="showajaxloadimspecifications" src="<?php echo base_url();?>assets/img/loadaing.gif">
					</div>
				<?php echo form_close(); ?>
					
				</div>
					 
					 
				 </div> <!-- End Tab -->
				 
			   </div>
		 </div>
	  </div>
   </div>
</div>
		 
		 
		 
		 </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
  <input type="hidden" id="error_val" value="" /> 
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
  <?php $this->load->view('adminsettings/footer'); ?>
   <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js" charset="utf-8"></script> <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/src/rating.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.container1').rating();
        });
    </script>   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/ckeditor/ckeditor.js" charset="utf-8"></script>
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap-fileupload.js" charset="utf-8"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js" charset="utf-8"></script>
   
   <script>
function check_product()
{
	var product_name = $('#product_name').val();
	var hidden_product_name = $('#hidden_product_name').val();
	if(product_name!="" && product_name!=hidden_product_name)
	{
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>adminsettings/check_product',
			data:{'product_name':product_name},
			 success:function(result){
				if(result==1)
				{
					$("#unique_name_error").css('color','#29BAB0');
  				 	$("#unique_name_error").html('available.');
				}
				else
				{
					$("#unique_name_error").css('color','#ff0000');					
					$("#unique_name_error").html(product_name+' is already exists.');
					$("#product_name").val('');
				}
			}
		});
	}
	/*else{
		$("#unique_name_error").css('color','#ff0000');					
		$("#unique_name_error").html(product_name+' is already exists.');
		$("#product_name").val('');
	}*/
	return false;
}
</script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.jquery.min.js" charset="utf-8"></script>
   <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js" charset="utf-8"></script>-->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js" charset="utf-8"></script> 
   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/clockface/js/clockface.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jquery-tags-input/jquery.tagsinput.min.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-datepicker/js/bootstrap-datepicker.js" charset="utf-8"></script>   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/date.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/daterangepicker.js" charset="utf-8"></script> 
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js" charset="utf-8"></script>  
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-timepicker/js/bootstrap-timepicker.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap-inputmask/bootstrap-inputmask.min.js" charset="utf-8"></script>
   <script src="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.pack.js" charset="utf-8"></script>
   
    
	
	<script src="<?php echo base_url(); ?>assets/assets/dropzone/dropzone.js" charset="utf-8"></script>
	
	 
	 
   <!-- jquery slider -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jslider/js/jshashtable-2.1_src.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jslider/js/jquery.numberformatter-1.2.3.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jslider/js/tmpl.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jslider/js/jquery.dependClass-0.1.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jslider/js/draggable-0.1.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/jslider/js/jquery.slider.js" charset="utf-8"></script>
    <!-- end -->
	<script src="<?php echo base_url(); ?>assets/js/scripts.js" charset="utf-8"></script>

   <script>
   
    jQuery(document).ready(function() {       
        // initiate layout and plugins
        App.init();
	});

	$(document).ready(function() { 
		jQuery("#Slider1").slider({ from: 5000, to: 150000, step: 1, dimension: '&nbsp;$' });
	});	
	
	
	</script>
	
	<?php $this->load->view('adminsettings/footer_script'); ?>
	
	<script>
	
	function validate_product(){
		var tags = $('#tags_1').val();
		
		var product_des = CKEDITOR.instances['product_description'].getData();
		
		var file_data = $('input[type="file"]')[0].files;
		
		if (file_data.length != '0') {
			for(var i = 0;i<file_data.length;i++){ 
				FileUploadPath = file_data[i].name;	
				var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
				if (Extension == "gif" || Extension == "png" || Extension == "jpeg" || Extension == "jpg" || Extension == "bmp") {
					$('#display_error_img').css('color','red').text('');
					//return true;
				} else { 
					//$('#display_error_img').css('color','#ff0000').append(file_data[i].name+' is not a valid file.<br>Only allowed file types are jpg, gif, jpeg, png.');
					$('#display_error_img').css('color','#ff0000').css({'color':'#b23f42','font-size': '14px'}).html('Invalid file format. Only allowed file types are jpg, gif, jpeg, png.');
					//$('#id_proof').val("");
					return true;
				}
			}
		}
		if(product_des == ''){
			$('#error_des').css('color','red').text('This field is required.');
			return true;
		}else{
			$('#error_des').css('color','red').text('');
		}
		if(tags == ''){
			alert('ahi');
			$('#error_tags').css('color','red').text('This field is required.');
			return true;
		}else{
			$('#error_tags').css('color','red').text('');
		}
		if(product_des!='' && tags!='')
		{
			$('#showajaxloadimg').show();
		$('#submitlevel1').prop('disabled', true);
		var formseri = $("#product").serialize();
		$.ajax({
			  type: 'POST',
               data: formseri,
			   url: '<?php echo base_url();?>adminsettings/update_product/<?php echo $update_id;?>', 
			   success: function(data){
					$("#tab2cl").trigger("click");  // this deactivates the home tab
					$('#showajaxloadimg').hide();
					$('#submitlevel1').prop('disabled', false);
					$('.icon-arrow-up').trigger('click');
				  }
		
			   });// you have missed this bracket	
			   
			return false;  
		}
		
	}
	
	function fetch_first_level(id,type){
		//alert(type);
		
		if(id!=''){
			$.ajax({
				type:'Post',
				url:'<?php echo base_url(); ?>adminsettings/fetch_first_level',
				data:{'cat_id':id},
				success:function(html){
					var data = html.trim();
					if(data != 'false'){
						if(type == 'main'){
							$('.sub_category').show();
							$("#tags").html(data);
							$('#tags').attr('required',true);
							//$("#tags").html(data).trigger('liszt:updated');
						}if(type == 'sub'){
							$('.child_category').show();
							$("#child").html(data);
							$('#child').attr('required',true);
							//$("#tags").html(data).trigger('liszt:updated');
						}
					}
				}
			});
		}	
	}
	
	$(".chosen").chosen().change(function(e, params){
		values = $(".chosen").chosen().val();
		//alert(values);
		 //values is an array containing all the results.
	});
	
	
	function check_brads(){
		//alert($('#brands').val());
		if($('#brands').val() == null){
			return false;
		}	
	}
	
	$(".brand_name").chosen().change(function(e, params){
		values = $(".chosen").chosen().val();
		//alert(values);
		 //values is an array containing all the results.
	});
	
	
	
	
	$(document).ready(function(){ 
		callload(); // This will run on page load
		setInterval(function(){
			callload() // this will run after every 5 seconds
		}, 5000);
		
 	 });
	 
	 function callload()
	 {
		  $.ajax({
          type: "POST",
        //  url: '<?php echo base_url();?>' + "view_gal.php", 
		 url: '<?php echo base_url();?>adminsettings/fetch_product_gallery/<?php echo $update_id ?>', 
          success: 
              function(data){
               $('#dropzoneajax').html(data);
              }
           });// you have missed this bracket
	 }
	 
	 function calfun(funid)
	 {
		 $("#selecturl"+funid).focus();
  		 $("#selecturl"+funid).select();
	 }
	 
	 function deletefile(img_id,product_id)
	 {
		 $('#delblo'+img_id).hide();
		 $('#delloader'+img_id).show();
		if(img_id!='') 
		{
			$.ajax({
			  type:"POST", //send it through get method
			  data: {'img_id':img_id,'product_id':product_id},
			  url: '<?php echo base_url();?>adminsettings/delete_product_gallery', 
			  success: 
				  function(data){
					$('#divhide'+img_id).hide();
				    $('#hidediv1').show();
				  }
			   });// you have missed this bracket	
		}
	 }
	 
	 
	//check checked check box
	
	
	
	$('.spec_detail').change(function () {
		
		var $checkbox = $(this);
		$checkbox.addClass('checked');
		return false;
		var $siblings = $checkbox.siblings('.spec_detail');
		
		if ($checkbox.is(':first-child')) {
			$('input.spec_detail').addClass('checked');
			
			$siblings.prop('checked', $checkbox.prop('checked'));
		} else {
			//$('.spec_detail').parent('span').removeClass('checked');
			$siblings.first().prop('checked', $siblings.not(':first-child').length == $siblings.filter(':checked').length);
		}
	});
	
	
	// Checkbox 
	
	function submit_spec() {
		
			
		var check = $('.spec_detail').val();
		

		if($(".spec_detail:checked").length == 0){
			
			//alert('main');
			$('#form_error').html('<div class="alert alert-error text-center"><button data-dismiss="alert" class="close">x</button><strong>Error! </strong> Choose Any one Specifications</div>');
			return false;
		}
		else{
			
			var error = '';	
			$('.spec_detail:checked').each(function() {	//specification
				var spec_no = this.id.match(/\d+/);
				//var spec_id = $(this).val();
				
				if($('.spec_option_id_'+spec_no+':checked').length == 0){
					
					var error = '1';
					$('#error_val').val(error);
					//alert(error);
					//return false;
				}else{
					
					$('.spec_option:checked').each(function() {	// specification option
						var cor_no = this.id.match(/\d+/);
						
						if($('#spec_extra_'+cor_no).val() == '' && $('.spec_option_id_'+spec_no+':checked')){
							var error = '1';
							$('#error_val').val(error);
							//alert('extra');
						}
					});
				}
});				
			
		}
				//$('#form_submit').submit();
				if($('#error_val').val() == '1'){
					//alert('anand');
					$('#error_val').val('');
					return false;
					
				}else{
					//alert('fsdf');
					
					$('#form_submit').submit();
				}
	}
	
	
	//show/hide specification textbox
	
	function spec_extra_text(id){
		var fields = $('#spec_option_id_'+id).prop("checked");
		//$('#spec_option_id_'+id).trigger('click');
		if(fields){
			//$('#chk_text_'+id).css({'display':'block'});
			$('#spec_extra_'+id).css({'border-color':'red'});
			//$('#spec_extra_'+id).attr('disabled',false);
			$('#spec_option_id_'+id).trigger('click');
		}else{
			//$('#spec_extra_'+id).attr('disabled',true);
			//$('#chk_text_'+id).css({'display':'none'});
			$('#spec_extra_'+id).val('');
			$('#spec_extra_'+id).css({'border-color':''});
			$('#spec_option_id_'+id).trigger('click');
			$('#spec_extra_'+id).css({'border-color':''});
		}
		return false;
	}
	
	function clr_border(id){
		var fields = $('#spec_option_id_'+id).prop("checked");
		if(fields){
			if($('#spec_extra_'+id).val())
				$('#spec_extra_'+id).css({'border-color':''});
			else
				$('#spec_extra_'+id).css({'border-color':'red'});
		}
	}
	
	// add required in store url
	function store_url(id){
		var aff = $('#affiliate_url_'+id).val();
		var product_url = $('#product_url_'+id).val();
		if($('#url_type_'+id).val() == 0){
			$('#url_type_'+id).val('1');
		} else {
			$('#url_type_'+id).val('0');
		}
		if($('#url_type_'+id).val() == 1){
			$('#affiliate_url_'+id).prop('required',true);
			$('#product_url_'+id).prop('required',true);
		}	
		if($('#url_type_'+id).val() == 0){
			if(aff == '' && product_url == ''){
				$('#affiliate_url_'+id).prop('required',false);
			$('#product_url_'+id).prop('required',false);
			}
		}
		if(aff!='' || product_url!=''){
			$('#affiliate_url_'+id).prop('required',true);
			$('#product_url_'+id).prop('required',true);
		}
		
	}	
	
	jQuery('#cashback_price').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	jQuery('#reward_points').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	
	/*jQuery('#submitlevel1').click(function (){
		alert('a');
		
	});*/
	
	$(document).ready(function() {
		
	$("#product_image").change(function(){
				 
    //$("#product").submit(function() {
		
	var formseri = $("#product").serialize();
	var fd = new FormData();
	fd.append("file", document.getElementById('product_image').files[0]);
	var proimg = $("#product_image")[0].files[0];

		$.ajax({
			  type: 'POST',
               data: fd,
               async: false,
			   cache: false,
               contentType: false,
               processData: false,
			   url: '<?php echo base_url();?>adminsettings/upload_product_gallery_main/<?php echo $update_id;?>', 
				success: function(data){
					var newimgsrc = '<?php echo base_url();?>uploads/products/'+data;
					$('#hidden_image_src').val(data);
					$('#product_image_src').attr('src',newimgsrc);
				  }
		
			   });// you have missed this bracket	
			return false;   
	})
	/* 
	
	$("#product").submit(function() {
		alert('YJWSGXJWSGJW');
		
	}) */
	
	
	
	$("#brandsform").submit(function() {
		$('#showajaxloadimbrands').show();
		$('#submitlevel1').prop('disabled', true);
		var formserei = $("#brandsform").serialize();
		$.ajax({
			  type: 'POST',
               data: formserei,
			   url: '<?php echo base_url();?>adminsettings/update_product/<?php echo $update_id;?>', 
			   success: function(data){
					$("#tab3cl").trigger("click");  // this deactivates the home tab
					$('#showajaxloadimbrands').hide();
					$('#submitlevel1').prop('disabled', false);
					$('.icon-arrow-up').trigger('click');
				  }
		
			   });// you have missed this bracket	
			   
			return false;  
	})
	
	
	$("#submitlevel3").click(function(){
		$("#tab4cl").trigger("click");
		$('.icon-arrow-up').trigger('click');
	})	
	
	$("#stores_form").submit(function() {
		$('#showajaxloadimstores').show();
		$('#submitlevelstores').prop('disabled', true);
		var formsereis = $("#stores_form").serialize();
		$.ajax({
			  type: 'POST',
               data: formsereis,
			   url: '<?php echo base_url();?>adminsettings/update_product/<?php echo $update_id;?>', 
			   success: function(data){
					$("#tab5cl").trigger("click");  // this deactivates the home tab
					$('#showajaxloadimstores').hide();
					$('#submitlevelstores').prop('disabled', false);
					$('.icon-arrow-up').trigger('click');
				  }
		
			   });// you have missed this bracket	
			   
			return false;  
	})
	
	
	
	$("#form_submit").submit(function() {
		$('#showajaxloadimspecifications').show();
		$('#submitspec').prop('disabled', true);
		var formsereis = $("#form_submit").serialize();
		$.ajax({
			  type: 'POST',
               data: formsereis,
			   url: '<?php echo base_url();?>adminsettings/update_product/<?php echo $update_id;?>', 
			   success: function(data){
					$("#tab1cl").trigger("click");  // this deactivates the home tab
					$('#showajaxloadimspecifications').hide();
					$('#submitspec').prop('disabled', false);
					$('.icon-arrow-up').trigger('click');
					$('#alertsuccess').show();
				  }
		
			   });// you have missed this bracket	
			   
			return false;  
	})
				
	
	});
	function hide_product_select(id,value)
	{
				
			$.ajax({
				type:"POST",
				url:'<?php echo base_url(); ?>adminsettings/get_affiliate_value',
				data:{"value":value},
				success:function(html)
				{
					if(html!='false')
					{
						{
							$('#product_url_'+id).val(html);
							$('#affiliate_url_'+id).val(html);
							
							
						}
				    }
			    }
			});
	}
	
	
	</script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>