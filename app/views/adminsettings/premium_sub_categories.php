<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Premium Sub Categories | <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>

   <link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />
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
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <?php
                          $catetory_name = $this->admin_model->get_premium_category_name($category_id);
						  ?>
                  <h3 class="page-title">
                   Sub Categories - <?php echo $catetory_name;?>
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/premium_categories','Categories'); ?>
							 <span class="divider">&nbsp;</span>
					   </li>
                       
                       <li><?php echo anchor('adminsettings/premium_sub_categories/'.$category_id,'Sub Categories'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
                  <!-- END PAGE TITLE & BREADCRUMB-->
                     <!-- Start Sub Category-->
                 <?php echo anchor('adminsettings/add_premium_sub_category/'.$category_id,'<button style="float:right" class="btn btn-success">Add Sub Category</button>'); ?> 
                      <!-- End Sub Category-->
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
                        
                            <h4><i class="icon-reorder"></i> Sub Categories  -   <span style="color:green;font-size:16px"><?php echo $catetory_name;?></span></h4>
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
                        if($categories)
						{
						?>
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th style="">#</th>
                                    <th style="">Sub Category Name</th>
                                    <th style="" class="hidden-phone">Category Name</th>
                                    <th style="" class="hidden-phone">Status</th>
                                    <th style="" class="hidden-phone">Edit</th>
                                    <th style="" class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							// get maximum category order..
							$maximum_order = $this->admin_model->get_maxcategory();
							foreach($maximum_order as $get){
								$max_order = $get->sort_order;
							}
							
							if($categories){
							foreach($categories as $category){
							$k++;
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>
                                    <td><?php echo $category->sub_category_name; ?></td>
                                    
									<td>
                                   <?php $cateid =  $category->cate_id;
								   $catetory_name = $this->admin_model->get_premium_category_name($cateid);
								   echo $catetory_name;
								    ?>
									
                                            
									</td>
									<td>
									<?php
									$status = $category->category_status;
										if($status=='1'){
											echo 'Activated';
										}else{
											echo 'De-activated';
										}
									?>
									</td>
                                    <td class="hidden-phone">
									<?php echo anchor('adminsettings/editpremiumsubcategory/'.$category->sun_category_id,'<i class="icon-pencil"></i>'); ?>
									</td>
                                    <td class="center hidden-phone">
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this category detail?');");		
									echo anchor('adminsettings/deletepremiumsubcategory/'.$category->sun_category_id.'/'.$cateid ,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php } } else { ?>
								<tr><td colspan="5">
									<center><strong>No Sub Categories found.</strong></center>
								</td></tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <?php
						}
						else
						{
							?>
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th style="">#</th>
                                    <th style="">Sub Category Name</th>
                                    <th style="" class="hidden-phone">Category Name</th>
                                    <th style="" class="hidden-phone">Status</th>
                                    <th style="" class="hidden-phone">Edit</th>
                                    <th style="" class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                            <?php
						}
						?>
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
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
   <script>
      jQuery(document).ready(function() {
         // initiate layout and plugins
          App.init();

          });

       </script><?php $this->load->view('adminsettings/footer_script'); ?>
<script type="text/javascript">
function confirmDelete(m)  // Confirm before delete cms..
{
	if(!confirm(m))
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</body>
<!-- END BODY -->
</html>