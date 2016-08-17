<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Missing cashback</title>
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
                    Missing Cashback
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/missing_cashback','Missing Cashbacks'); ?>
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
                            <h4><i class="icon-reorder"></i> Missing Cashbacks</h4>
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
                <form id="form2" action="" method="post" name="form2">
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th style=""><center><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></center></th>
                                    <th>User Name</th>
                                    <th>Date of Query</th>
                                    <th>Retailer Name</th>
                                    <th>Transaction Amount (<?php echo DEFAULT_CURRENCY_CODE;?>)</th>  
                                    <!--<th>Cashback Amount (Rs.)</th>     -->            
                                    <th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">View</th>
                                    <th class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							//print_r($allmissing_cashbacks);
						
							$k=0;
							foreach($allmissing_cashbacks as $res){
							$k++;
							$user_details = $this->admin_model->view_user($res->user_id);
							$fname = $user_details[0]->first_name;
							$lname = $user_details[0]->last_name;
							$usname = $fname." ".$lname;
							$details = $res->status;
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>	
                                     <td><center><input type="checkbox"  class="check_b" name="chkbox[<?php echo $res->cashback_id;?>]" /></center></td> 
                                    <td><?php echo $usname;?></td>
									 <td><?php echo $res->trans_date;?></td>
                                     <td><?php echo $res->retailer_name;?></td>
                                      <td><center><?php echo $res->transation_amount;?></center></td>
                                       <?php 
										switch($details)
										{
											case 0:
											?>
											 <td><a href="" class="btn btn-success btn-xs pop"> Completed </a></td>
											<?php
											break;
											case 1:
											?>
											 <td><a href="" class="btn btn-danger btn-xs pop"> Cancelled </a></td>
											<?php
											break;
											case 2:
											?>
											 <td><a href="" class="btn btn-danger btn-xs pop"> Sent to retailer </a></td>
											<?php
											break;
											case 3:
											?>
											 <td><a href="" class="btn btn-danger btn-xs pop"> Created </a></td>
											<?php
											break;
											
										}
										
									?>
                                    <td class="hidden-phone"><center>
									<?php echo anchor('adminsettings/view_missing_cashback/'.$res->cashback_id,'<i class="icon-eye-open"></i>'); ?></center>
									</td>
                                    <td class="center hidden-phone"><center>
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this Cashback?');");
									echo anchor('adminsettings/delete_missing_cashback/'.$res->cashback_id,'<i class="icon-trash"></i>',$confirm); ?></center>
									</td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="hidd" value="hidd">
                        <input id="GoUpdate" class="btn btn-warning" type="submit" value="Delete Missing Cashback" name="GoUpdate">
                        </form>
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
</body>
<!-- END BODY -->
</html>