<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Admin Settings | <?php echo $admin_details->site_name; ?> Admin</title>
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
   
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/bootstrap-daterangepicker/daterangepicker.css" />
	<!-- seetha-->
	<!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
   
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
                    Theme Customize
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/theme_customize','Theme Customize'); ?>
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
                        <h4><i class="icon-cog"></i> Theme Customize</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div>
					 <br>
					 <span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked fields are mandatory.</span><br>
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
							$attribute = array('role'=>'form','method'=>'post','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit' =>'return validation();' ); 
							echo form_open('adminsettings/theme_customize',$attribute);
						?>
						<input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id; ?>">
                           <!-- seetha 11.08.2015 preheader-->
						   <h5><b>Preheader </b> </h5>
						    <div class="control-group">
                              <label class="control-label">Preheader Background Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-preheader1" style="width:130px">
									<input type="text" id="prehead_backcolor" name="prehead_backcolor" value="<?php echo $prehead_backcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
							<h5><b>Header </b></h5>
						   <div class="control-group">
                              <label class="control-label">Header Background Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-header1" style="width:130px">
									<input type="text" id="header_backgndcolor" name="header_backgndcolor"  value="<?php echo $header_backgndcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						    <div class="control-group">
                              <label class="control-label">Header Text Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-header2" style="width:130px">
									<input type="text" id="header_txtcolor" name="header_txtcolor"  value="<?php echo $header_txtcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Header Font Family </label>
                             <div class="controls">							
							<select name="header_fontfamily" class="span6" id="header_fontfamily">
							<option value="'PT Sans',sans-serif" <?php if($header_fontfamily=="'PT Sans',sans-serif") echo 'selected'; ?>>'PT Sans',sans-serif</option>
							<option value="Verdana, Geneva, sans-serif" <?php if($header_fontfamily=="Verdana, Geneva, sans-serif") echo 'selected'; ?>>Verdana, Geneva, sans-serif</option>
							<option value="Georgia, 'Times New Roman', Times, serif" <?php if($header_fontfamily=="Georgia, 'Times New Roman', Times, serif") echo 'selected'; ?>>Georgia, 'Times New Roman', Times, serif</option>
							<option value="'Courier New', Courier, monospace" <?php if($header_fontfamily=="'Courier New', Courier, monospace") echo 'selected'; ?>>'Courier New', Courier, monospace</option>
							<option value="Arial, Helvetica, sans-serif" <?php if($header_fontfamily=="Arial, Helvetica, sans-serif") echo 'selected'; ?>>Arial, Helvetica, sans-serif</option>
							<option value="Tahoma, Geneva, sans-serif" <?php if($header_fontfamily=="Tahoma, Geneva, sans-serif") echo 'selected'; ?>>Tahoma, Geneva, sans-serif</option>
							<option value="'Trebuchet MS', Arial, Helvetica, sans-serif" <?php if($header_fontfamily=="'Trebuchet MS', Arial, Helvetica, sans-serif") echo 'selected'; ?>>'Trebuchet MS', Arial, Helvetica, sans-serif</option>
							<option value="'Arial Black', Gadget, sans-serif" <?php if($header_fontfamily=="'Arial Black', Gadget, sans-serif") echo 'selected'; ?>>'Arial Black', Gadget, sans-serif</option>
							<option value="'Times New Roman', Times, serif" <?php if($header_fontfamily=="'Times New Roman', Times, serif") echo 'selected'; ?>>'Times New Roman', Times, serif</option>
							<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" <?php if($header_fontfamily=="'Palatino Linotype', 'Book Antiqua', Palatino, serif") echo 'selected'; ?>>'Palatino Linotype', 'Book Antiqua', Palatino, serif</option>
							<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" <?php if($header_fontfamily=="'Lucida Sans Unicode', 'Lucida Grande', sans-serif") echo 'selected'; ?>>'Lucida Sans Unicode', 'Lucida Grande', sans-serif</option>
							<option value="'MS Serif', 'New York', serif" <?php if($header_fontfamily=="'MS Serif', 'New York', serif") echo 'selected'; ?>>'MS Serif', 'New York', serif</option>
							<option value="'Lucida Console', Monaco, monospace" <?php if($header_fontfamily=="'Lucida Console', Monaco, monospace") echo 'selected'; ?>>'Lucida Console', Monaco, monospace</option>
							<option value="'Comic Sans MS', cursive" <?php if($header_fontfamily=="'Comic Sans MS', cursive") echo 'selected'; ?>>'Comic Sans MS', cursive</option>							
							</select>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Header Font Size <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="header_fontsize"  id="header_fontsize" class="span6">
									<?php for($hf=10;$hf<=40;$hf++){?>
									<option value="<?php echo $hf;?>" <?php if($header_fontsize==$hf){ echo 'selected="selected"'; }?>><?php echo $hf;?></option>
								<?php } ?>
									
								</select>
                              </div>
                           </div>
						   <h5><b>Prefooter </b> </h5>
						   <div class="control-group">
                              <label class="control-label">Prefooter Background Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-prefooter1" style="width:130px">
									<input type="text" id="prefooter_backgndcolor" name="prefooter_backgndcolor" value="<?php echo $prefooter_backgndcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						    <div class="control-group">
                              <label class="control-label">Prefooter Text Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-prefooter2" style="width:130px">
									<input type="text" id="prefooter_txtcolor" name="prefooter_txtcolor" value="<?php echo $prefooter_txtcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Link Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-link" style="width:130px">
									<input type="text" id="linkcolor" name="linkcolor" value="<?php echo $linkcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Prefooter Font Family </label>
                             <div class="controls">							
							<select name="prefooter_fontfamily" class="span6" id="prefooter_fontfamily">
							<option value="'PT Sans',sans-serif" <?php if($prefooter_fontfamily=="'PT Sans',sans-serif") echo 'selected'; ?>>'PT Sans',sans-serif</option>
							<option value="Verdana, Geneva, sans-serif" <?php if($prefooter_fontfamily=="Verdana, Geneva, sans-serif") echo 'selected'; ?>>Verdana, Geneva, sans-serif</option>
							<option value="Georgia, 'Times New Roman', Times, serif" <?php if($prefooter_fontfamily=="Georgia, 'Times New Roman', Times, serif") echo 'selected'; ?>>Georgia, 'Times New Roman', Times, serif</option>
							<option value="'Courier New', Courier, monospace" <?php if($prefooter_fontfamily=="'Courier New', Courier, monospace") echo 'selected'; ?>>'Courier New', Courier, monospace</option>
							<option value="Arial, Helvetica, sans-serif" <?php if($prefooter_fontfamily=="Arial, Helvetica, sans-serif") echo 'selected'; ?>>Arial, Helvetica, sans-serif</option>
							<option value="Tahoma, Geneva, sans-serif" <?php if($prefooter_fontfamily=="Tahoma, Geneva, sans-serif") echo 'selected'; ?>>Tahoma, Geneva, sans-serif</option>
							<option value="'Trebuchet MS', Arial, Helvetica, sans-serif" <?php if($prefooter_fontfamily=="'Trebuchet MS', Arial, Helvetica, sans-serif") echo 'selected'; ?>>'Trebuchet MS', Arial, Helvetica, sans-serif</option>
							<option value="'Arial Black', Gadget, sans-serif" <?php if($prefooter_fontfamily=="'Arial Black', Gadget, sans-serif") echo 'selected'; ?>>'Arial Black', Gadget, sans-serif</option>
							<option value="'Times New Roman', Times, serif" <?php if($prefooter_fontfamily=="'Times New Roman', Times, serif") echo 'selected'; ?>>'Times New Roman', Times, serif</option>
							<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" <?php if($prefooter_fontfamily=="'Palatino Linotype', 'Book Antiqua', Palatino, serif") echo 'selected'; ?>>'Palatino Linotype', 'Book Antiqua', Palatino, serif</option>
							<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" <?php if($prefooter_fontfamily=="'Lucida Sans Unicode', 'Lucida Grande', sans-serif") echo 'selected'; ?>>'Lucida Sans Unicode', 'Lucida Grande', sans-serif</option>
							<option value="'MS Serif', 'New York', serif" <?php if($prefooter_fontfamily=="'MS Serif', 'New York', serif") echo 'selected'; ?>>'MS Serif', 'New York', serif</option>
							<option value="'Lucida Console', Monaco, monospace" <?php if($prefooter_fontfamily=="'Lucida Console', Monaco, monospace") echo 'selected'; ?>>'Lucida Console', Monaco, monospace</option>
							<option value="'Comic Sans MS', cursive" <?php if($prefooter_fontfamily=="'Comic Sans MS', cursive") echo 'selected'; ?>>'Comic Sans MS', cursive</option>							
							</select>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Heading Font Size <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="prefooter_headfontsize"  id="prefooter_headfontsize" class="span6">
									<?php for($hf=10;$hf<=40;$hf++){?>
									<option value="<?php echo $hf;?>" <?php if($prefooter_headfontsize==$hf){ echo 'selected="selected"'; }?>><?php echo $hf;?></option>
								<?php } ?>
									
								</select>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Menu Font Size <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="prefooter_menufontsize"  id="prefooter_menufontsize" class="span6">
									<?php for($hf=10;$hf<=40;$hf++){?>
									<option value="<?php echo $hf;?>" <?php if($prefooter_menufontsize==$hf){ echo 'selected="selected"'; }?>><?php echo $hf;?></option>
								<?php } ?>
									
								</select>
                              </div>
                           </div>
						   <h5><b>Footer </b> </h5>
                           <div class="control-group">
                              <label class="control-label">Footer Background Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-footer1" style="width:130px">
									<input type="text" id="footer_backgndcolor" name="footer_backgndcolor"  value="<?php echo $footer_backgndcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Footer Text Color</label>
                              <div class="controls">
                                <div class="input-group colorpicker-component demo demo-footer2" style="width:130px">
									<input type="text" id="footer_txtcolor" name="footer_txtcolor"  value="<?php echo $footer_txtcolor; ?>" class="form-control"/>
									<span class="input-group-addon"><i></i></span>
								</div> 
							  </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Footer Font Family </label>
                             <div class="controls">							
							<select name="footer_fontfamily" class="span6" id="footer_fontfamily">
							<option value="'PT Sans',sans-serif" <?php if($footer_fontfamily=="'PT Sans',sans-serif") echo 'selected'; ?>>'PT Sans',sans-serif</option>
							<option value="Verdana, Geneva, sans-serif" <?php if($footer_fontfamily=="Verdana, Geneva, sans-serif") echo 'selected'; ?>>Verdana, Geneva, sans-serif</option>
							<option value="Georgia, 'Times New Roman', Times, serif" <?php if($footer_fontfamily=="Georgia, 'Times New Roman', Times, serif") echo 'selected'; ?>>Georgia, 'Times New Roman', Times, serif</option>
							<option value="'Courier New', Courier, monospace" <?php if($footer_fontfamily=="'Courier New', Courier, monospace") echo 'selected'; ?>>'Courier New', Courier, monospace</option>
							<option value="Arial, Helvetica, sans-serif" <?php if($footer_fontfamily=="Arial, Helvetica, sans-serif") echo 'selected'; ?>>Arial, Helvetica, sans-serif</option>
							<option value="Tahoma, Geneva, sans-serif" <?php if($footer_fontfamily=="Tahoma, Geneva, sans-serif") echo 'selected'; ?>>Tahoma, Geneva, sans-serif</option>
							<option value="'Trebuchet MS', Arial, Helvetica, sans-serif" <?php if($footer_fontfamily=="'Trebuchet MS', Arial, Helvetica, sans-serif") echo 'selected'; ?>>'Trebuchet MS', Arial, Helvetica, sans-serif</option>
							<option value="'Arial Black', Gadget, sans-serif" <?php if($footer_fontfamily=="'Arial Black', Gadget, sans-serif") echo 'selected'; ?>>'Arial Black', Gadget, sans-serif</option>
							<option value="'Times New Roman', Times, serif" <?php if($footer_fontfamily=="'Times New Roman', Times, serif") echo 'selected'; ?>>'Times New Roman', Times, serif</option>
							<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" <?php if($footer_fontfamily=="'Palatino Linotype', 'Book Antiqua', Palatino, serif") echo 'selected'; ?>>'Palatino Linotype', 'Book Antiqua', Palatino, serif</option>
							<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" <?php if($footer_fontfamily=="'Lucida Sans Unicode', 'Lucida Grande', sans-serif") echo 'selected'; ?>>'Lucida Sans Unicode', 'Lucida Grande', sans-serif</option>
							<option value="'MS Serif', 'New York', serif" <?php if($footer_fontfamily=="'MS Serif', 'New York', serif") echo 'selected'; ?>>'MS Serif', 'New York', serif</option>
							<option value="'Lucida Console', Monaco, monospace" <?php if($footer_fontfamily=="'Lucida Console', Monaco, monospace") echo 'selected'; ?>>'Lucida Console', Monaco, monospace</option>
							<option value="'Comic Sans MS', cursive" <?php if($footer_fontfamily=="'Comic Sans MS', cursive") echo 'selected'; ?>>'Comic Sans MS', cursive</option>							
							</select>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Heading Font Size <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="footer_headfontsize"  id="footer_headfontsize" class="span6">
									<?php for($hf=10;$hf<=40;$hf++){?>
									<option value="<?php echo $hf;?>" <?php if($footer_headfontsize==$hf){ echo 'selected="selected"'; }?>><?php echo $hf;?></option>
								<?php } ?>
									
								</select>
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Footer Font Size <span class="required_field">*</span></label>
                             <div class="controls">
								<select name="footer_fontsize"  id="footer_fontsize" class="span6">
									<?php for($hf=10;$hf<=40;$hf++){?>
									<option value="<?php echo $hf;?>" <?php if($footer_menufontsize==$hf){ echo 'selected="selected"'; }?>><?php echo $hf;?></option>
								<?php } ?>
									
								</select>
                              </div>
                           </div>
                           <!-- seetha 11.08.2015-->
						
                         				   
						   
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success">
                           </div>
						   
						   <?php echo form_close(); ?>
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
	<!-- seetha-->
	<!--<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>-->
	<script>
		$('.demo-preheader1').colorpicker();
		$('.demo-header1').colorpicker();
		$('.demo-header2').colorpicker();
		$('.demo-prefooter1').colorpicker();
		$('.demo-prefooter2').colorpicker();
		$('.demo-footer1').colorpicker();
		$('.demo-footer2').colorpicker();
		$('.demo-link').colorpicker();
	</script>
     <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
                            