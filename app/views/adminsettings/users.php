<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<?php $admin_details = $this->admin_model->get_admindetails(); ?>
	<title>Members | <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>

   <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
   <style>
    #sample_1 th
    {
	   text-align:center !important;
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
                    Members
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/users','Members'); ?>
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
                            <h4><i class="icon-reorder"></i> Members</h4>
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
				if($allusers)
				{
				?>
                
                <form id="form2" name="form2" method="post" action="">
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th>User Id</th>
                                    <th>User Tracking Id</th>
                                    <th>Name</th>
                                    
                                    <th>Email Address</th>
                                    <th>Balance (in <?php echo DEFAULT_CURRENCY_CODE;?>)</th>
                                    <th>Clicks</th>
                                    <th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">Signup Date</th>
                                    
                                    <th class="hidden-phone">Actions</th>
                                    <th class="hidden-phone"></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							foreach($allusers as $users){
							$k++;
							$users_id = $users->user_id;
							$date_added = date("d F Y", strtotime($users->date_added));
							$total_click_ss = $this->db->query("SELECT COUNT(*) as counting FROM `click_history` where user_id='$users_id'");
							$total_click = $total_click_ss->row('counting');//unsolved Missing cashbacks
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>	
                                     <td><input type="checkbox"  class="check_b" name="chkbox[<?php echo $users_id;?>]" /></td>	
                                      <td><?php echo $users->user_id; ?></td>
                                      <td><?php echo $updated_userid = encode_userid($users->user_id);  ?></td>		
                                    <td><?php echo $users->first_name.' '.$users->last_name; ?></td>
									<td><?php echo $users->email; ?></td>
									<td><center><?php echo DEFAULT_CURRENCY." ".$users->balance; ?></center></td>
                                    <td><center><?php echo anchor('adminsettings/click_history/'.$users->user_id,$total_click); ?></center></td>
									<td><center><?php 
									$status = $users->status;
									if($status=='1'){ 
										echo 'Activated';
									}else {
										echo 'De-activated';
									} 
									?></center>
									</td>
                                     <td><center><?php echo $date_added; ?></center></td>
                                    <td class="hidden-phone" ><center>
									<?php echo anchor('adminsettings/manual_credit/'.$users->user_id,'<i alt="Transfer Money" class="icon-money"></i>'); ?>&nbsp;<?php echo anchor('adminsettings/view_user/'.$users->user_id,'<i alt="View User" class="icon-eye-open"></i>'); ?></center>
									</td>
                                    <td class="center hidden-phone" id="chng_st<?php echo $users->user_id;  ?>"><center>
									<?php if($status=='0'){  ?>
									<a href="javascript:void(0);" onclick="return change_status('<?php echo $users->user_id; ?>','1');">Activate</a>
									<?php }
									else{
										?>
										<a href="javascript:void(0);" onclick="return change_status('<?php echo $users->user_id; ?>','0');">Deactivate</a>
										<?php 
									}									?></center>
									</td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <input type="hidden" value="hidd" name="hidd">
					<input id="GoUpdate" class="btn btn-warning" type="submit" name="GoUpdate" value="Delete Users">
                        </form>
                <?php
				}
				else
				{
					?>
                     <table class="table table-striped table-bordered" id="">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                  <!--  <th><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>-->
                                    <th>User Id</th>
                                    <th>Name</th>
                                    
                                    <th>Email Address</th>
                                    <th>Balance (in <?php echo DEFAULT_CURRENCY_CODE;?>)</th>
                                    <th>Clicks</th>
                                    <th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">Signup Date</th>
                                    
                                    <th class="hidden-phone">Actions</th>
                                    <th class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td colspan="12">No users Found</td>
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
<!--   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js"></script>-->
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
    <script>
   function change_status(uid,st)
   {
	   
	   $.ajax({
		  type:'POST',
		url:'<?php echo base_url(); ?>adminsettings/change_status',
		data:"user_id="+uid+"&status="+st,
		success:function(msg){
			if(st==0)
			{
			var status=1;
			$('#chng_st'+uid).html('<a href="javascript:void(0);" onclick="return change_status('+uid+','+status+');">Activate</a>');
			}
			else
			{
				var status=0;
			$('#chng_st'+uid).html('<a href="javascript:void(0);" onclick="return change_status('+uid+','+status+');">Deactivate</a>');
			}
			
		}
		
	   });
	   
   }
   </script>
</body>
<!-- END BODY -->
</html>