<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Referrals | <?php echo $admin_details->site_name; ?> Admin</title>
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
                    Referrals
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/referrals','Referrals'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
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
                            <h4><i class="icon-reorder"></i> Referrals</h4>
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
				}
				 ?>
                 <?php
							$k=0;
							if($referrals){
								?>
                 <form id="form2" action="" method="post" name="form2">
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                     <th style=""><center><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></center></th>
                                    <th><center>User Email</center></th>
                                    <th><center>Referral Count</center></th>
                                    <th><center>View</center></th>
                                    <th class="hidden-phone"><center>Delete</center></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							if($referrals){
							foreach($referrals as $referral){
							$k++;
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>
									<td><center><input type="checkbox"  class="check_b" name="chkbox[<?php echo $referral->referral_id;?>]" /></center></td> 
                                    <td><center><?php 
									$attr = array('target'=>'_blank');
									echo anchor('adminsettings/view_user/'.$referral->user_id,$referral->user_email,$attr);
									?></center></td>
									
                                    <td><center><?php // to find the over all referral count from this user..
										echo $total_count = $this->admin_model->referral_count($referral->user_email);
									?></center></td>
									
									<td><center>
										<a href="#myModal1" role="button" data-toggle="modal" onclick="return getall('<?php echo $referral->user_email; ?>');"><i class="icon-eye-open"></i></a>
										</center>
									</td>

                                    <td class="center hidden-phone"><center>
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this referral details?');");
									echo anchor('adminsettings/deletereferral/'.$referral->user_id,'<i class="icon-trash"></i>',$confirm); ?></center>
									</td>
                                </tr>
								<?php } } else { ?>
								<tr>
								<td colspan="5">No Referrals Found.</td>
								</tr>
								<?php } ?>
                            </tbody>
                        </table>
                         <input type="hidden" name="hidd" value="hidd">
                        <input id="GoUpdate" class="btn btn-warning" type="submit" value="Delete Referrals" name="GoUpdate">
                        </form>
                        <?php
							}
							else
							{
								?>
                                <table class="table table-striped table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        
                                        <th><center>User Email</center></th>
                                        <th><center>Referral Count</center></th>
                                        <th><center>View</center></th>
                                        <th class="hidden-phone"><center>Delete</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
								<td colspan="5">No Referrals Found.</td>
								</tr>
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
   <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel1">Referral List</h3>
		</div>
		<div class="modal-body" id="modal_body">
			
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
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
   <script type="text/javascript">
function confirmDelete(m)  // Confirm before delete referral..
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
<script type="text/javascript">
function getall(email){

// alert(email);

	$.ajax({
		type:'POST',
		url:'<?php echo base_url(); ?>adminsettings/all_referrals',
		data:{'email':email},
		success:function(msg){
			$('#modal_body').html('<ul style="list-style-type:none;">'+msg+'</ul>');
		}
	});
}

</script>
<script>
      $(document).ready(function() {
		$(".check_b").attr("style", "opacity: 1;");
      });
	  function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
 
 
   </script>
</body>
<!-- END BODY -->
</html>