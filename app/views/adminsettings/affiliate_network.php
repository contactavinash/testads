<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<?php $admin_details = $this->admin_model->get_admindetails(); ?>
	<title>Affiliate Network | <?php echo $admin_details->site_name; ?> Admin</title>
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
                    Affiliate Network
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/affiliate_network','Affiliate Network'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
				    <?php echo anchor('adminsettings/addaffiliate_list','<button style="float:right" class="btn btn-success">Add Affiliate Network</button>'); ?> 
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
                            <h4><i class="icon-reorder"></i> Affiliate Network</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
						<span class="msg"></span>
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
				if($affiliate_network)
				{
				?>
                
                <form id="form2" name="form2" method="post" action="">
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th>#</th>
									<th style=""> <input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th>Affiliate Network </th> 
                                    <th class="hidden-phone">API key </th>
                                    <th class="hidden-phone">NetworkID </th>
									<th class="hidden-phone">Affiliate Logo </th>
                                    <th class="hidden-phone">Import </th>
                                    <th class="hidden-phone">Report </th>
                                    <th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">Edit</th>
                                    <th class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							foreach($affiliate_network as $affiliate){
							$k++;
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>
									<td><input type="checkbox"  class="check_b" name="chkbox[<?php echo $affiliate->id;?>]" /></td>
									<td><center><?php echo $affiliate->affiliate_network; ?></center></td>
									<td><center><?php echo substr($affiliate->api_key,0,25); ?></center></td>
                                    <td><center><?php echo $affiliate->networkid; ?></center></td>
                                    <td><center><img src="<?php echo base_url();?>uploads/affiliates/<?php echo $affiliate->affiliate_logo; ?>" width="180" height="35" /></center></td>
									<td class="hidden-phone"><center>
									<img src="<?php echo base_url();?>assets/img/loadaing.gif" id="import_loader" style="display:none;">
									<a href="javascript:void(0);"  name="import" id="import" onClick="return fun_import('<?php echo $affiliate->api_key; ?>','<?php echo $affiliate->networkid; ?>','<?php echo $affiliate->status; ?>');" title="Import Coupons" style="display:<?Php if($affiliate->id==11){echo "block";}else{echo "none";}; ?>"><i class="icon-cloud-download"></i></a></center></td>
								
									<!--seetha 21.09.215-->
									<td class="hidden-phone"><center>
									 <img src="<?php echo base_url();?>assets/img/loadaing.gif" id="report_loader" style="display:none;">
									<a href="javascript:void(0);"  name="report" id="report" onClick="return fun_fetchreport('<?php echo $affiliate->api_key; ?>','<?php echo $affiliate->networkid; ?>','<?php echo $affiliate->status; ?>');"  title="Upload reports" style="display:<?Php if($affiliate->id==11){echo "block";}else{echo "none";}; ?>"><i class="icon-upload"></i></i></a></center></td>
									<!--seetha 21.09.215-->
									<td>
									<?php
									$status = $affiliate->status;
										if($status=='1'){
											echo 'Activated';
										}else{
											echo 'De-activated';
										}
									?>
									</td>
                                    <td class="hidden-phone">
									<?php $attr =array('title'=>'Edit');
									echo anchor('adminsettings/editaddaffiliate_list/'.$affiliate->id,'<i class="icon-pencil"></i>',$attr); ?>
									</td>
                                    <td class="center hidden-phone">
									<?php
									$confirm = array("class"=>"confirm-dialog",'title'=>'Delete',"onclick"=>"return confirmDelete('Do you want to delete this affiliate detail?');");		
									echo anchor('adminsettings/deleteaffiliate_list/'.$affiliate->id,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
					<input type="hidden" name="tracking_id" value="<?php echo $affiliate->tracking_id;?>" id="tracking_id">
					<input type="hidden" value="hidd" name="hidd">
					<input id="GoUpdate" class="btn btn-warning" type="submit" name="GoUpdate" value="Delete Affiliate Networks">
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
                                    <th>Affiliate Network </th> 
                                    <th class="hidden-phone">API key </th>
                                    <th class="hidden-phone">NetworkID </th>
									<th class="hidden-phone">Affiliate Logo </th>
                                    <th class="hidden-phone">Import </th>
                                    <th class="hidden-phone">Report </th>
                                    <th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">Edit</th>
                                    <th class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td colspan="9">No records Found</td>
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
function fun_import(apikey,netwrkid,status){
	//alert(apikey);
	$('#import').hide();
	$('#import_loader').show();
	if(status==1)
	{
		var tracking_id =$('#tracking_id').val();
		$.ajax({
			type:'POST',
			dataType: 'JSON',
			url: '<?php echo base_url();?>adminsettings/get_coupons/'+apikey+'/'+netwrkid,
			data:'apikey='+apikey+'&netwrkid='+netwrkid+'&tracking_id='+tracking_id+'&status='+status,
			success:function(results){				
				$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong>'+results['success']+'</strong></div>');
				$('#import_loader').hide();
				$('#import').show();
				$("html, body").animate({ scrollTop: 0 }, "slow");
				setTimeout(function(){ window.location="<?php echo base_url();?>adminsettings/coupons"; }, 3000);
		
			}
		});
	}
	else {
		$('.msg').html('<div class="alert alert-error"><button data-dismiss="alert" class="close">x</button><strong>Affiliate Network is De-activated.</strong></div>');
        $('#import_loader').hide();
		$('#import').show();		
	}
	
}
</script>
<!-- upload the report automatically 
 seetha 21.09.2015-->
 <script>
function fun_fetchreport(apikey,netwrkid,status)
{
	//alert(apikey);
	$('#report').hide();
	$('#report_loader').show();
	 if(status==1)
	 {
		$.ajax({
			type:'POST',
			dataType: 'JSON',
			url: '<?php echo base_url();?>adminsettings/fetch_report/'+apikey+'/'+netwrkid,
			data:'apikey='+apikey+'&netwrkid='+netwrkid+'&status='+status,
			success:function(results){				
				$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong>'+results['success']+'</strong></div>');	
				$('#report_loader').hide();
				$('#report').show();
				$("html, body").animate({ scrollTop: 0 }, "slow");
		
			}
		});
	}
	else {
		$('.msg').html('<div class="alert alert-error"><button data-dismiss="alert" class="close">x</button><strong>Affiliate Network is De-activated.</strong></div>');
		$('#report_loader').hide();
		$('#report').show();
	}
	
}
</script>
</body>
<!-- END BODY -->
</html>
