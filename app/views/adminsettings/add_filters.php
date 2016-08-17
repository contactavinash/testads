<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<?php $admin_details = $this->admin_model->get_admindetails(); ?>
<?php
$opt = '';
$page_dinamic = 'product_categories';
$titlong = 'Product Categories';
  $titless = $titlong;
  $opt = $category_set_id;
  if($category_name_title!='')
  {
	 $titlong = 'Product Sub Categories - '.$category_name_title;
	 $titless = $titlong; 
  }
?>
<title><?php echo $titless;?> | <?php echo $admin_details->site_name; ?> Admin</title>
<?php $this->load->view('adminsettings/script'); ?>
<link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />
<style>
    div.selector, div.selector span, div.checker span, div.radio span, div.uploader, div.uploader span.action, div.button, div.button span
    {
        background-image:none
    }
</style>
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
                  
					Filters
				  
                  </h3>
                   
                   
                                   
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> <?php echo "Filters";?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
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
						
                       <?php
					 // print_r($filters);
					  
					   if($filters!="")
					   {
						  $attribute = array('role'=>'form','name'=>'category','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/Add_filter_categories/edit',$attribute);
						?>
						 <?php
						 //echo "dfsdfgsd";
				$active_specifications = $this->admin_model->active_specifications();
				if($active_specifications)
					{
						$category_specifi = explode(',',$main_filters->category_specifications);
						$g=0;
						//print_r($category_specifi);
						foreach($active_specifications as $active_speci)
						{
							
							if(in_array($active_speci->specid,$category_specifi))
							{
								//echo $active_speci->specid;
								
								?>
								<div class="control-group">
                <label class="control-label"><?php echo $active_speci->specification; ?></label>
				<input type="hidden" name="spec_id[]" value="<?php echo $active_speci->specid; ?>">
				
				<?php 

				

				$filter_name = $this->admin_model->filter_name($active_speci->specid,$main_filters->cate_id); 

				if($filter_name)

					{

						?>



				<input type="hidden" name="fil_id[]" value="<?php echo $filter_name->f_id; ?>">



				<?php

				$fltr=unserialize($filter_name->filters);

				foreach($fltr as $fltrs)

				{

			?>

			

                <div class="controls append<?php echo $g; ?>">

				<br>

				

                 <input type="text" class="span6" name="sub_filters_<?php echo $g; ?>[]" id="fil" value="<?php echo $fltrs; ?>"/>

				 

                </div>

				<?php

				  } 

				} 

				else

					{ 

						// echo 'dssjhd';

						?>


<input type="hidden" name="fil_id[]" value="">
				  <div class="controls append<?php echo $g; ?>">


					

        		  <br>

        

                 <input type="text" class="span6" name="sub_filters_<?php echo $g; ?>[]" id="fil" value=""/>

         

                </div>

			     <?php } ?>

				
				<br>
				<div class="btn-deta" style="text-align:center;">
					<button type="button" name="appand" id="<?php echo $g; ?>" class="btn btn-info append_row">Add More</button>
					</div>
              </div>
							<?php $g++; }
							
						}
					}
				?>
				<input type="hidden" name="cate_id" value="<?php echo $main_filters->cate_id; ?>">

				<div class="btn-deta" style="text-align:center;">
					<input type="submit" name="save_offers" id="" value="Save" class="btn btn-success">
					</div>
					    <?php echo form_close(); 
					   }
					   else
					   {
							$attribute = array('role'=>'form','name'=>'category','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data'); 
							echo form_open('adminsettings/Add_filter_categories/add',$attribute);
						?>
						 <?php
				$active_specifications = $this->admin_model->active_specifications();
				//print_r($active_specifications);
				if($active_specifications)
					{
						$category_specifi = explode(',',$main_filters->category_specifications);
						$g=0;
						foreach($active_specifications as $active_speci)
						{
							if(in_array($active_speci->specid,$category_specifi))
							{
								?>
								<div class="control-group">
                <label class="control-label"><?php echo $active_speci->specification; ?></label>
				<input type="hidden" name="spec_id[]" value="<?php echo $active_speci->specid; ?>">
                <div class="controls append<?php echo $g; ?>">
				<br>
				
                 <input type="text" class="span6" name="sub_filters_<?php echo $g; ?>[]" id="fil" value=""/>
				 
                </div>
				<br>
				<div class="btn-deta" style="text-align:center;">
					<button type="button" name="appand" id="<?php echo $g; ?>" class="btn btn-info append_row">Add More</button>
					</div>
              </div>
							<?php $g++; }
							
						}
					}
				?>
				<input type="hidden" name="cate_id" value="<?php echo $main_filters->cate_id; ?>">

				<div class="btn-deta" style="text-align:center;">
					<input type="submit" name="save_offers" id="" value="Save" class="btn btn-success">
					</div>
					    <?php echo form_close(); 
						
					   }?> 
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>
            <!-- END ADVANCED TABLE widget-->
            <!-- END PAGE CONTENT-->
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
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>   
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
   <script>
      jQuery(document).ready(function() {
         // initiate layout and plugins
          App.init();

          });

       </script><?php $this->load->view('adminsettings/footer_script'); ?>
<script>
$(".append_row").click(function(){
		var id=this.id;
		
	 $("div.append"+id+":last").clone().find("input:text").val("").end().insertAfter("div.append"+id+":last");
	
	});

</script>
 
</body>
<!-- END BODY -->
</html>