<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Comments | <?php echo $admin_details->site_name; ?> Admin</title>
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
                  <h3 class="page-title">
                    Comments
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/get_allcomments','Comments'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
                   <?php echo anchor('adminsettings/add_comments/'.$blog_id,'<button style="float:right" class="btn btn-success">Add Comments</button>'); ?> 
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
                            <h4><i class="icon-reorder"></i> Comments</h4>
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
							$k=0;
							if($allcms)
							{
								?>
                                <table class="table table-striped table-bordered" id="<?php if($allcms){echo 'sample_1';} ?>">
                            <thead>
                                <tr>
                                    <th style="width:10%;">#</th>
                                    <th style="width:10%;" class="hidden-phone">User</th>
                                    <th style="width:40%;">Comments</th>
                                    <th style="width:10%;" class="hidden-phone">Status</th>
                                    <th style="width:10%;" class="hidden-phone">Change Status</th>
                                    <!--<th style="width:10%;" class="hidden-phone">Edit</th>-->
                                    <th style="width:10%;" class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
								
							foreach($allcms as $cms){
							$k++;
							$bid =$cms->bid;
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>	
                                    <td><?php 
									if($cms->user_id!='Admin')
									{
										echo $this->admin_model->user_name($cms->user_id);
									}
									else
									{
										echo "Admin";
									}?></td>
                                    <td><?php echo $cms->comments; ?></td>
                                    <td><?php echo $cms->status; ?></td>
                                      <td>
                                      <?php
									  if($cms->status=='active')
									  {
										  $s = 'Deactive';
									  }
									  else
									  {
										  $s = 'Active';
									  }
									  ?>
                                      <center><?php echo anchor('adminsettings/status_change_comments/'.$cms->cid.'/'.$bid,'<button type="button" name="" class="brn btn-warning">'.$s.'</button>'); ?></center>
                                     </td>
                                    <!--<td class="hidden-phone">
									<?php echo anchor('adminsettings/editblog/'.$cms->cid,'<i class="icon-pencil"></i>'); ?>
									</td>-->
                                    <td class="center hidden-phone">
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this Blog detail?');");		
									echo anchor('adminsettings/delete_comments/'.$cms->cid.'/'.$bid,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php }
								?>
                                </tbody>
                       			 </table>
                                <?php
							}
							else
							{
								?>
                                 <table class="table table-striped table-bordered" id="sample_1">
                            <tr>
                                <td colspan="6">No comments in this blog</td>
                                </tr>
                                <?php
							}?>
                            </tbody>
                        </table>
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
