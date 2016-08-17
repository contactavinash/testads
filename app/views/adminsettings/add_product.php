<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Add Product | <?php echo $admin_details->site_name; ?> Admin</title>
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
                  <h3 class="page-title">
                     Add Product
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
			   <i class="icon-reorder"></i> Add Product Details
			</h4>
			<span class="tools">
			   <a class="icon-chevron-down" href="javascript:;"></a>
			   <a class="icon-remove" href="javascript:;"></a>
			</span>
		 </div>
		 
		  <div class="widget-body form">
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
			?>
			   <div class="form-wizard">
				  <div class="navbar steps">
					 <div class="navbar-inner">
						<ul class="row-fluid nav nav-pills">
						   <li class="span2 active">
							  <a class="step active" data-toggle="tab" href="#tab1">
							  <span class="number">1</span>
							  <span class="desc"><i class="icon-ok"></i> Product </span>
							  </a>
						   </li>
						    <li class="span2">
							  <a class="step" href="#">
							  <span class="number">2</span>
							  <span class="desc"><i class="icon-ok"></i> Brands</span>
							  </a> 
						   </li>
						   </li>
						   <li class="span2">
							  <a class="step" href="#">
							  <span class="number">3</span>
							  <span class="desc"><i class="icon-ok"></i> Gallery</span>
							  </a>
						   </li>
						   <li class="span2">
							  <a class="step" href="#">
							  <span class="number">4</span>
							  <span class="desc"><i class="icon-ok"></i> Stores </span>
							  </a>
						   </li>
						   <li class="span2">
							  <a class="step" href="#">
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
				  
					 <div id="tab1" class="tab-pane active">
					 
						 <!--<form action="#" class="form-horizontal">-->
						<?php
							$attribute = array('role'=>'form','name'=>'product','method'=>'post','id'=>'product','enctype'=>'multipart/form-data','class'=>'form-horizontal','onSubmit'=>'return validate_product();'); 
							echo form_open('adminsettings/add_product',$attribute);
						?>
						 
                           <div class="control-group">
                              <label class="control-label">Product Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="product_name" onblur="return check_product();"  id="product_name" value="" required />
								<div id="unique_name_error"></div>
                              </div>
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
										<option value="<?php echo $main_cat->cate_id; ?>"><?php echo $main_cat->category_name; ?></option>
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
						
						<div class="control-group sub_category" style="display:none">
							<label class="control-label">Sub Category</label>
							<div class="controls">
								<select class="span6" name="parent_child_id" id="tags" onChange="fetch_first_level(this.value,'sub')" >
									
								</select>
							</div>
						</div>
			  
						 <div class="control-group child_category" style="display:none">
							<label class="control-label">Sub Category Child</label>
							<div class="controls">
								<select class="span6" name="child_id" id="child" >
									
								</select>
							</div>
						</div> 
					<div class="control-group">
                            <label class="control-label">Product Search Tags <span class="required_field">*</span></label>
                            <div class="span5">
                                <input id="tags_1" type="text" name="product_tags" class="m-wra tags" value="" />
								<br><span id="error_tags"></span>
                            </div>
                         </div>
						   
						  <div class="control-group cat_image">
                              <label class="control-label">Product Image <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="span6" name="product_image" id="product_image" required/><br>
								<!--<span>Note: Category Image should be minimum of (150 * 150) in size</span><br>-->
								<p id="display_error_img"></p>
                              </div>
                           </div>
						   
						 <div class="control-group">
							<label class="control-label">Product Description <span class="required_field">*</span></label>
							<div class="controls">
								<textarea id="product_description" class="span6 ckeditor" name="product_description" ></textarea>
								<br><span id="error_des"></span>
							</div>
						</div>
						
						<div class="control-group">
                              <label class="control-label">MRP <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="mrp"  id="mrp" value="" required />
								<div id="unique_name_error"></div>
                              </div>
                           </div>
						   
						   <!--<div class="control-group">
                              <label class="control-label">Discount Percentage <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="discount"  id="discount" value="" required />
								<div id="unique_name_error"></div>
                              </div>
                           </div>-->
						   
						   <div class="control-group">
                              <label class="control-label">COD Available <span class="required_field">*</span></label>
                              <div class="controls">
                              <select name="codAvailable" required>
								  <option value="TRUE">Yes</option>
								  <option value="FALSE">No</option>
							  </select>
                              </div>
                           </div>
						   
						   
						    <div class="control-group">
                              <label class="control-label">EMI Available <span class="required_field">*</span></label>
                              <div class="controls">
                              <select name="emiAvailable" required>
								  <option value="TRUE">Yes</option>
								  <option value="FALSE">No</option>
							  </select>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Size</label>
                              <div class="controls">
                              <input type="text" class="span6" name="size"  id="size" value=""  />
                              </div>
                           </div>
						   
						   
						   <div class="control-group">
                              <label class="control-label">Color </label>
                              <div class="controls">
                              <input type="text" class="span6" name="color"  id="color" value=""  />
                              </div>
                           </div>
						   
						   <div class="control-group">
							<label class="control-label">Key Features </label>
							<div class="controls">
								<textarea id="key_feature" class="span6" name="key_feature"></textarea>&nbsp; <span class="">Please use comma Separater</span>
							</div>
						</div>
                        
                        
						   
						<!--<div class="control-group">
							<label class="control-label">Key Features </label>
							<div class="controls">
								<textarea id="key_feature" class="span6 ckeditor" name="key_feature"></textarea>
							</div>
						</div>
						
						<div class="control-group">
						  <label class="control-label">Product Type</label>
						  <div class="controls">
							<input type="checkbox" class="" name="featured" id="featured" value="1"/> Featured Product
						  </div>
						</div>
						-->
					<!--	<div class="control-group">
						  <label class="control-label">Cashback Price</label>
						  <div class="controls">
							<input type="text" class="span6" name="cashback_price" id="cashback_price" value=""/>
						  </div>
						</div>
						
						<div class="control-group">
						  <label class="control-label">Reward Points</label>
						  <div class="controls">
							<input type="text" class="span6" name="reward_points" id="reward_points" value=""/>
						  </div>
						</div>-->
					<div class="control-group">
						  <label class="control-label">Rating</label>
						<div class="controls">
							<section class="container1">
								<input type="radio" name="rating" class="rating" value="1" />
								<input type="radio" name="rating" class="rating" value="2" />
								<input type="radio" name="rating" class="rating" value="3" />
								<input type="radio" name="rating" class="rating" value="4" />
								<input type="radio" name="rating" class="rating" value="5" />
							</section>
						</div>
					</div>
						<br>
						<!--<div class="form_inputs slider clearfix">
							<div class="row-fluid">
								<div class="span2">
									<label class="control-label"> Rating </label>
								</div>

								<div class="span9">
									<input id="Slider1" type="slider" name="rating" value="0" />
								</div>
							</div>
						</div>-->
						
					   <div class="form-actions">
						  <input type="submit" name="save" value="Submit" class="btn btn-success">
					   </div>
						   <?php echo form_close(); ?>
					 </div>
				 </div>
				 
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
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
  <?php $this->load->view('adminsettings/footer'); ?>
   <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js" charset="utf-8"></script> 
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/src/rating.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.container1').rating();
        });
    </script>
	<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js" charset="utf-8"></script>-->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/ckeditor/ckeditor.js" charset="utf-8"></script>
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap-fileupload.js" charset="utf-8"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js" charset="utf-8"></script>
   
<script>
function check_product()
{

	var product_name = $('#product_name').val();
	if(product_name)
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
	return false;
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.jquery.min.js" charset="utf-8"></script>

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
				return false;
			}
		}
	}
	if(product_des == ''){
		$('#error_des').css('color','red').text('This field is required.');
		return false;
	}else{
		$('#error_des').css('color','red').text('');
	}
	if(tags == ''){
		$('#error_tags').css('color','red').text('This field is required.');
		return false;
	}else{
		$('#error_tags').css('color','red').text('');
	}
       if($('input:radio[name=rating]:checked').length == 0){
		alert("Please enter the rating");
		$('#rating').focus();
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
	alert(values);
	 //values is an array containing all the results.
});

jQuery('#cashback_price').keyup(function () { 
	this.value = this.value.replace(/[^0-9\.]/g,'');
});
jQuery('#reward_points').keyup(function () { 
	this.value = this.value.replace(/[^0-9\.]/g,'');
});

</script>
	
	

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>