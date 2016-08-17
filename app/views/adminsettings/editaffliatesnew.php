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
	.span3 > input {
    margin-top: 19px;
}
.m-ctrl-medium.date-picker {
    margin-top: 20px;
}
.btn.btn-info {
    margin-top: 21px;
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
	  <div id="form_wizard_1" class="widget box blue">
		 <div class="widget-title">
			<h4>
			   <i class="icon-file"></i> Retailer
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
				
			?>
			
			   <div class="form-wizard">
				  <div class="navbar steps">
					 <div class="navbar-inner">
						<ul class="row-fluid nav nav-pills">
						   <li class="span2 active">
							  <a id="tab1cl" class="step active" data-toggle="tab" href="#tab1">
							  <span class="number">1</span>
							  <span class="desc"><i class="icon-ok"></i> Retailer </span>
							  </a>
						   </li>
						   
						   <li class="span2">
							  <a id="tab2cl" class="step" data-toggle="tab" href="#tab5">
							  <span class="number">2</span>
							  <span class="desc"><i class="icon-ok"></i> Offers</span>
							  </a> 
						   </li>
						 <li class="span2">
							  <a id="tab2cl" class="step" data-toggle="tab" href="#tab2">
							  <span class="number">3</span>
							  <span class="desc"><i class="icon-ok"></i> Commision</span>
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
				  <div id="tab2" class="tab-pane">
				 <?php 
				$attribute = array('role'=>'form','method'=>'post','class'=>''); 
							echo form_open('adminsettings/save_retailer_commision',$attribute);
				?>
					<div class="cond-exist">
					<div class="conbdr">
					<div class="span4">
					<label class="control-label"><b>Category name</b></label>
					</div>
					
					<div class="span4">
					<label class="control-label"><b>What we get</b></label>
					</div>
					<div class="span4">
					<label class="control-label"><b>What we given</b></label>
					</div>
					</div>
					
					<?php
					$mv=1;
					$c_get=unserialize($commision->what_get);
					$c_give=unserialize($commision->what_give);
					$c_catid=unserialize($commision->category_id);
					
				foreach($categories as $cates) {?>
				 <div class="conbdr">
		        <div class="span4">
                
				<label class="control-label"><?php echo $cates->category_name; ?></label>
					</div>
					<div class="span4">
					<input type="hidden" name="affiliate_idss" id="affiliate_idss" value="<?php echo $affiliate_id; ?>">
					<input type="hidden" value="<?php echo $cates->cate_id; ?>" name="cates_id[]">
					<input type="text" class=""  value="<?php if(in_array($cates->cate_id,$c_catid)){ $key = array_search($cates->cate_id,$c_catid );
echo $c_get[$key];					} ?>" id="" name="what_get[]"  oninput="return given_commision(this.value,'<?php echo $mv; ?>');" >
					</div>
					<div class="span4">
					<input type="text" id="Give<?php echo $mv; ?>"  value="<?php if(in_array($cates->cate_id,$c_catid)){ $key1 = array_search($cates->cate_id,$c_catid );
echo $c_give[$key1];					} ?>" id="" name="what_give[]">
					</div>
					
					</div>
					<?php $mv++;} ?>
												
					<div style="text-align:center;" class="btn-deta">
					<input class="btn btn-success" type="submit" value="Save" id="" name="save_commision">
					</div>
					</div>
					<?php echo form_close(); ?>
				</div>
					 
				 <div id="tab5" class="tab-pane">
				 <?php 
				$attribute = array('role'=>'form','method'=>'post','class'=>'form-horizontal'); 
							echo form_open('adminsettings/addaffiliateoffers',$attribute);
				?>
				 <div class="cond-exist">
				 <div class="conbdr">
		        <div class="span3">
                
				<label class="control-label">Exist Bank<span class="required_field"></span></label>
					</div>
					<div class="span3">
					<input type="hidden" value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->off_id;} ?>" name="boff_id">
					<input type="text"  value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->bank_name;} ?>" id="" name="bank_name" required>
					</div>
					<div class="span3">
					<input type="text"  value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->off_percent;} ?>" id="" name="off_percent" placeholder="percentage">
					</div>
					<div class="span3">
					<input type="text"  value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->off_amount;} ?>" id="" name="off_amount" placeholder="amount">
					</div>
					</div>
									 <div class="conbdr">
		        <div class="span3">
					</div>
					<div class="span3">
					</div>
					<div class="span3">
					<input type="text" class=" m-ctrl-medium date-picker"  value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->off_start;} ?>" id="" name="b_st_date" placeholder="start date">
					</div>
					<div class="span3">
					<input type="text" class=" m-ctrl-medium date-picker"  value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->off_end;} ?>" id="" name="b_ed_date" placeholder="end date">
					</div>
					</div>
					<button  type="button" class="remove" value="<?php if($get_aff_bank_off!=""){ echo $get_aff_bank_off->off_id;} ?>" >remove</button>
					</div>
					<?php
					if($get_aff_other_off!="")
					{
					foreach($get_aff_other_off as $other_off) { 
					
					?>
					<div class="cond-bank">
					
					<div class="conbdr ">
					<div class="span3">
						<label class="control-label">Other Offers<span class="required_field"></span></label>
					</div>

					<div class="span3">
					
					</div>
					<div class="span3">
					<input type="hidden" value="<?php if($other_off!=""){ echo $other_off->off_id;} ?>" name="offer_id[]">
					<input type="text"  value="<?php if($other_off!=""){ echo $other_off->offer_desc;} ?>" id="" name="off_desc[]" placeholder="description" required>
					</div>
					<div class="span3">
					<input type="text"  value="<?php if($other_off!=""){ echo $other_off->off_amount;} ?>" id="" name="off_amounts[]" placeholder="amount">
					</div>
					</div>
					
					 <div class="conbdr">
					<div class="span3">
					
					</div>

					<div class="span3">
				
					</div>
					<div class="span3">
					<input type="text"  class="start_date m-ctrl-medium date-picker" value="<?php if($other_off!=""){ echo $other_off->off_start;} ?>"  name="o_st_date[]" placeholder="start date">
					</div>
					<div class="span3">
					<input type="text"  class="end_date m-ctrl-medium date-picker" value="<?php if($other_off!=""){echo $other_off->off_end;} ?>"  name="o_ed_date[]" placeholder="end date">
					</div>
					</div>
					<button  type="button" class="remove" value="<?php if($other_off!=""){ echo $other_off->off_id;} ?>" >remove</button>
					</div>
					<?php } } else{?>
										<div class="cond-bank">
					
					<div class="conbdr ">
					<div class="span3">
						<label class="control-label">Other Offers<span class="required_field"></span></label>
					</div>

					<div class="span3">
					
					</div>
					<div class="span3">
					<input type="hidden" value="" name="offer_id[]">
					<input type="text"  value="" id="" name="off_desc[]" placeholder="description" required>
					</div>
					<div class="span3">
					<input type="text"  value="" id="" name="off_amounts[]" placeholder="amount">
					</div>
					</div>
					
					 <div class="conbdr">
					<div class="span3">
					
					</div>

					<div class="span3">
				
					</div>
					<div class="span3">
					<input type="text"  class="start_date m-ctrl-medium date-picker" value="" name="o_st_date[]" placeholder="start date">
					</div>
					<div class="span3">
					<input type="text"  class="end_date m-ctrl-medium date-picker" value="" name="o_ed_date[]" placeholder="end date">
					</div>
					</div>
					<button type="button" class="remove" value="" >remove</button>
					</div>
					<?php } ?>
                    <input type="hidden" name="affiliate_ids" id="affiliate_ids" value="<?php echo $affiliate_id; ?>">
					<div style="text-align:center;" class="btn-deta">
					<input class="btn btn-info" type="button" value="Add More" id="append_row" name="appand">
					</div>
                    <br>
                    <div style="text-align:center;" class="btn-deta">
					<input class="btn btn-success" type="submit" value="Save" id="" name="save_offers">
					</div>
					
                     <?php echo form_close(); ?>
					
				</div>
				
					 <div id="tab1" class="tab-pane active">
                     
					 
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
                                <input type="url" class="span6" name="logo_url" id="logo_url" value="<?php if($sess_logo_url!=""){ echo $sess_logo_url;  }?>" />
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
                              <div class="controls"><!-- seetha-->
							     <input type="file" class="span6"  name="affiliate_logo" id="affiliate_logo" />
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
                              <select name="affiliate_cashback_type" >
							  <option value="">Select</option>
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
						   </div> -->
                           
                           
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
                           
                           
                       <!--     <div class="control-group">
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
							echo form_open('adminsettings/updateaffiliate',$attribute);
						?>
                            <div class="control-group">
                              <label class="control-label">Retailer Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="affiliate_name" id="affiliate_name" value="<?php echo $affiliate_name; ?>" required />
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
                                <input type="url" class="span6" name="logo_url" id="logo_url" value="<?php echo $logo_url;?>" required />
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
                              <label class="control-label">Retailer Logo </label>
							  Note: Retailer Logo should be in (150 * 93) in size<!-- seetha-->
                              <div class="controls">							    
                                <input type="file" name="affiliate_logo" id="affiliate_logo" value="" />
								<input type="hidden" name='affiliate_logo_hid' value="<?php echo $affiliate_logo; ?>"><br>
								<img src="<?php echo base_url();?>uploads/affiliates/<?php echo $affiliate_logo; ?>" width="180" height="35">
                              </div>
                           </div>

                            <?php $uri = $this->uri->segment(4); ?>
                            		 <input type="hidden" id="store_type" name="store_type" value="<?php echo $uri; ?>">
                            	   <?php  if($uri!='On1'){
                            ?>
                           
                             <div class="control-group container">
                              <label class="control-label">Retailer Category </label>
                              <?php
							 $category_list =  $this->admin_model->categories();
							?>
                             <div class="controls ">
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
						     <?php } ?>
						   <input type="hidden" name="affiliate_id" id="affiliate_id" value="<?php echo $affiliate_id; ?>">
						   <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $affiliate_logo; ?>">
						   
						   <div class="control-group">
                              <label class="control-label">Retailer Description <span class="required_field">*</span></label>
                              <div class="controls">
                                <textarea class="span6 ckeditor" name="affiliate_desc" id="affiliate_desc"><?php echo $affiliate_desc; ?></textarea>
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label">Cashback Type<span class="required_field">*</span></label>
                              <div class="controls">
                              <select name="affiliate_cashback_type">
							  <option value="" >Select</option>
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
                           
                             <!-- <div class="control-group">
                              <label class="control-label">Retailer Banner URL</label>
                              <div class="controls">
                                <textarea class="span6" name="retailer_ban_url" rows="5" id="retailer_ban_url" ><?php echo $retailer_ban_url; ?></textarea>	
                              </div>
						   </div>-->
                           
                           
                           
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
                               <input type="text" class="span6" name="sidebar_image_url" rows="5" id="sidebar_image_url" value="<?php echo $sidebar_image_url; ?>" /> 
                              
                              </div>
						   </div>  -->
                           
                           
						   <input type="hidden" name="sidebar_image_hid" id="sidebar_image_hid" value="<?php echo $sidebar_image; ?>">

						   <input type="hidden" name="hidden_coupon_image" id="hidden_coupon_image" value="<?php echo $coupon_image; ?>">
                          
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success" id="valid_edit">
                           </div>
						   <?php echo form_close(); ?>
                        <!--</form>-->
                        <!-- END FORM-->
                     </div>
					 <?php } ?>
                     </div> 
                    
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
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

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
	 function randomString(length, chars) {
		var result = '';
		for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
		return result;
	}
	$("#append_row").click(function(){
		
	 $("div.cond-bank:last").clone().find("input:text").val("").end().find("input:hidden").val("").end().insertAfter("div.cond-bank:last");
	
	
	 var rString = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
	
	$("div.cond-bank:last").find('.start_date').attr('id',rString);
	$('#'+rString).datepicker();
	var rString = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
	$("div.cond-bank:last").find('.end_date').attr('id',rString);
	$('#'+rString).datepicker();
	});
	/*$('body').on('focus',".m-ctrl-medium date-picker", function(){
    $(this).datepicker();
	});
*/	

$('.remove').on('click', function(){
	var id=$(this).val();
	var div=$(this);
	if(id!="")
	{
	$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>adminsettings/remove_bank_offers",
				data: "id="+id,
				cache: false,
				success: function(result)
				{
					
					if(result==1)
					{
						
				div.closest('div').remove();
					}
				}
				});
	}
	else
	{
		div.closest('div').remove();
	}
})
function given_commision(val,id)
{
	var commision=val*(50/100);
	
	$("#Give"+id).val(commision);
}
$('#valid_edit').click(function()
{
	
 $("#update_form").validate({
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
	   'categorys_list[]': {
                required: true,
                
            },
        logo_url: {
            required: true,
            url: true
           
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