<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php
   $typ=$this->uri->segment(3);
   $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Retailers | <?php echo $admin_details->site_name; ?> Admin</title>
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
                   
                   <!-- END THEME CUSTOMIZER-->
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <h3 class="page-title">
                    Retailers
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/affiliates','Retailers'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
				   <?php if($typ!="On1") { ?>
                   <span style="float:right">
                   <a href="<?php echo base_url();?>adminsettings/addaffiliate" class="btn btn-success">Add Retailer</a> &nbsp;
                   <a href="<?php echo base_url();?>adminsettings/bulk_store" class="btn btn-success">Import Retailers</a></span><?php } ?>
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
                            <h4><i class="icon-reorder"></i> Retailers</h4>
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
                        
                       <div class="row-fluid">
    <div class="span3">
                        <table width="100%" cellspacing="2" cellpadding="3" border="0" align="center">
                        <tbody><tr>
                            <td valign="middle" align="left" class="tb2">Featured </td>
                            <td valign="middle" align="right" class="stat_s"><span class="badge badge-info">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td valign="middle" align="left" class="tb2">Retailer Of The Week </td>
                            <td valign="middle" align="right" class="stat_s"><span class="badge badge-success">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td valign="middle" align="left" class="tb2">Featured &amp; Retailer Of The Week </td>
                            <td valign="middle" align="right" class="stat_s"><span class="badge badge-important">&nbsp;</span></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"><div class="sline"></div></td>
                        </tr>
                        </tbody></table>
						</div>
  </div>
  <br>
                        
                        
                        <form id="form2" action="" method="post" name="form2">
                            <table class="table table-striped table-bordered" id="<?php if($affiliates){echo 'sample_1';} ?>">
                            <thead>
                                <tr >
                                    <th>#</th>
                                     <th style=""> <input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th>Retailer Name</th> 
                                     <th>Sort Order</th>                                     
                                    <th class="hidden-phone">Retailer Logo</th>
									<?php if($typ!="On1") { ?>
                                     <th class="hidden-phone">Cashback</th>
                                     <th class="hidden-phone">Type</th>
                                      <th class="hidden-phone">Coupons</th>
                                        
                                        <th>Cashbacks</th>
                                        <th>Visits</th>
									<?php } ?>
                                    <th class="hidden-phone">Status</th>
									<th class="hidden-phone">Activate</th>
                                    <th class="hidden-phone">Edit</th>
									<?php if($typ!="On1") { ?>
                                    <th class="hidden-phone">Delete</th>
									<?php } ?>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							if($affiliates){
							foreach($affiliates as $affiliate){
							$k++;
							//echo 'gfdg'.$affiliate->featured;
							
							if($affiliate->featured==1){
								$extraset = 'style="background-color:#32c2cd"';
							}else if($affiliate->store_of_week==1){
								$extraset = 'style="background-color:#a5d16c"';
							}else if($affiliate->store_of_week==1 && $affiliate->featured==1){
								$extraset = 'style="background-color:#e74955"';
							}else{
								$extraset = '';
							}
							//echo $extraset;
							
							
							?>
                                <tr class="odd gradeX" style="" >
                                    <td style=""><?php echo $k; ?></td>
                                      <td><input type="checkbox"  class="check_b" name="chkbox[<?php echo $affiliate->affiliate_id;?>]" /></td>
                                    <td><a target="_blank" href="<?php echo base_url();?>cashback/stores/<?php echo $affiliate->affiliate_url;?>"><?php echo $affiliate->affiliate_name; ?></a>
                                    <!--<img src="<?php echo base_url();?>assets/img/web_scraping_icon.png" style="float:right; width: 41px;">--></td>
                                   
                                     <?php
									if($affiliate->sort_order!='')
									{
										$sort_order = $affiliate->sort_order;
									}
									else
									{
										$sort_order = 0;
									}
									?>
                                    
                                     <td><input class="span12" type="number" size="4" value="<?php echo $sort_order;?>" name="sort_arr[<?php echo $affiliate->affiliate_id;?>]"></td>
                                   
                                    <td <?php echo $extraset;?>><center><img src="<?php echo base_url();?>uploads/affiliates/<?php echo $affiliate->affiliate_logo; ?>" width="110" height="35" /></center></td>
									<?php if($typ!="On1") { ?>
                                     <td><?php if($affiliate->cashback_percentage)
									 			{
													
													if($affiliate->affiliate_cashback_type=='Flat')
													{
														echo $s= DEFAULT_CURRENCY_CODE." ".$affiliate->cashback_percentage;
													}
													else
													{
														echo $s= $affiliate->cashback_percentage.'%';
													}
												}
												else
												{
													echo $s=0;
												} ?></td>
												
                                                   <td><?php echo $affiliate->affiliate_cashback_type; ?></td>
                                                <td><a href="<?php echo base_url();?>adminsettings/coupons/<?php echo $affiliate->affiliate_name;?>"><?php $get_count= $this->admin_model->count_coupons($affiliate->affiliate_name); echo $get_count->counting; ?></a></td>
                                             
                                             <td><a href="<?php echo base_url();?>adminsettings/cashback_details/<?php echo $affiliate->affiliate_id;?>"><i class="icon-tasks"></i></a></td>
                                             
                                             
                                      
                                       <td><?php $get_count= $this->admin_model->count_clicks($affiliate->affiliate_id);?><a href="<?php echo base_url();?>adminsettings/click_history/<?php echo $affiliate->affiliate_name;?>"><?php echo $get_count->counting; ?></a></td><?php } ?>
									<td>
												
                                      <img src="<?php echo base_url();?>assets/img/loadaing.gif" id="import_loader<?php echo $affiliate->affiliate_id; ?>" style="display:none;">
                                  <p id="sts<?php echo $affiliate->affiliate_id; ?>">
									<?php
										$status = $affiliate->affiliate_status;
										
										if($status=='1'){
											echo 'Active';
										}else{
											echo 'De-active';
										}
										
									?></p>
									</td>
									<td id="id_sts<?php echo $affiliate->affiliate_id; ?>"> <button  type="button" onclick="return change_onstore_status('<?php echo $affiliate->affiliate_id; ?>','<?php echo $status ?>');"><i class="icon-exchange"></i></button></td>
                                    <td class="hidden-phone">
                   <?php if($affiliate->store_type=='On1'){ ?>
									 <?php echo anchor('adminsettings/editaffiliate/'.$affiliate->affiliate_id.'/'.$affiliate->store_type,'<i class="icon-pencil"></i>'); ?>
                   <?php } else{ ?>
                    <?php echo anchor('adminsettings/editaffiliate/'.$affiliate->affiliate_id,'<i class="icon-pencil"></i>'); ?>
                    <?php } ?>
									</td>
									<?php if($typ!="On1" ) { ?>
                                    <td class="center hidden-phone">
									<?php
									
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this affiliate detail?');");	
if($affiliate->store_type!="On1"){									
echo anchor('adminsettings/deleteaffiliate/'.$affiliate->affiliate_id,'<i class="icon-trash"></i>',$confirm);  } ?>
									</td>
									<?php } ?>
                                </tr>
                                
								<?php } } else { ?>
								<tr><td colspan="6">
									<center><strong>No affiliates found.</strong></center>
								</td></tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="hidd" value="hidd">
                        <input id="GoUpdate" class="btn btn-warning" type="submit" value="Update Retailers" name="GoUpdate">
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
   <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js"></script>-->
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
 function change_onstore_status(id,status)
 {
	 $('#sts'+id).hide();
	 $('#import_loader'+id).show();
	 
	 $.ajax({
			  type: 'POST',
               data: 'id='+id+'&st='+status,
			   url: '<?php echo base_url();?>adminsettings/change_onstore_status', 
			   success: function(data){
				   if(data==1)
				   {
					$('#import_loader'+id).hide();
					
					if(status==1)
					{
						$('#sts'+id).show();
						$('#sts'+id).html('De-active');
						$('#id_sts'+id).html('<button  type="button" onclick="return change_onstore_status('+id+',0);"><i class="icon-exchange"></i></button>');
					}
					else
					{
						$('#sts'+id).show();
						$('#sts'+id).html('Active');
						$('#id_sts'+id).html('<button  type="button" onclick="return change_onstore_status('+id+',1);"><i class="icon-exchange"></i></button>');
					}
				   }
				  }
		
			   });
 }
 
   </script>
</body>
<!-- END BODY -->
</html>
                            