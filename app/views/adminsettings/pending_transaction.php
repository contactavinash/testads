<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Pending Transaction | <?php echo $admin_details->site_name; ?> Admin</title>
   <?php $this->load->view('adminsettings/script'); ?>
   <link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />
   <style>
   div.selector, div.selector span, div.checker span, div.radio span, div.uploader, div.uploader span.action, div.button, div.button span
   {
    background-image:none}
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
                    Pending Transaction
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/pending_cashback','Pending Cashback'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
			    <?php $affiliate=$this->admin_model->affiliate_network_product(11); 
			 
			   ?>
			   <a href="javascript:void(0);" style="float:right" class="btn btn-success" onClick="return fun_fetchreport('<?php echo $affiliate[0]->api_key; ?>','<?php echo $affiliate[0]->networkid; ?>','<?php echo $affiliate[0]->status; ?>');">Import report from Vcommision</a>
			   <?php $affiliate1=$this->admin_model->affiliate_network_product(12); 
			 
			   ?>
			   <a href="javascript:void(0);" style="float:right" class="btn btn-success" onClick="return fun_fetchreport1('<?php echo $affiliate1[0]->api_key; ?>','<?php echo $affiliate1[0]->networkid; ?>','<?php echo $affiliate1[0]->status; ?>');">Import report from Snapdeal</a>
			   
			   <?php $affiliate2=$this->admin_model->affiliate_network_product(13); 
			 
			   ?>
			   <a href="javascript:void(0);" style="float:right" class="btn btn-success" onClick="return fun_fetchreport2('<?php echo $affiliate2[0]->api_key; ?>','<?php echo $affiliate2[0]->networkid; ?>','<?php echo $affiliate2[0]->status;?>','<?php echo $affiliate2[0]->tracking_id;?>');">Import report from Optimise</a>
			   
			   <a href="" style="float:right" class="btn btn-success" data-toggle="modal" data-target="#myModal">Import report from Amazon</a>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-money"></i> Pending transaction</h4>
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
                            <table class="table table-striped table-bordered" <?php if($pendings){ ?>id="sample_1"<?php } ?>>
                            <thead>
                              <tr>
                                <th><center>S.no</center></th>
                                <th><center>Users</center></th>
                                <!--  <th><center>Product</center></th> -->
                                <th><center>Store</center></th>
                                <th><center>click Date</center></th>
								<th><center>Updated date</center></th>
                                <th><center>Price</center></th>
                                <!--  <th><center>Ads coin</center></th> -->
                                <th><center>Commission Amount</center></th>
                                <th><center>Status</center></th>
                                <th><center>Delete</center></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $k=1;
                                if($pendings){
                                foreach($pendings as $pending){
                                $get_productdetails  =$this->admin_model->get_products_from_product_byid($pending->product_id);

                                ?>
                                <tr class="odd gradeX">
                                  <td><?php echo $k; ?></td>
                                  <td><center><?php // view user email..
                                  $email = $this->admin_model->user_email($pending->user_id);					
                                  $attr = array('target'=>'_blank');
                                  echo anchor('adminsettings/view_user/'.$pending->user_id,$email,$attr);			
                                  ?></center>

                                <!--   <td><a href="<?php echo base_url(); ?>cashback/product_details/<?php echo $get_productdetails->purl;?>"><?php echo $get_productdetails->product_name;?> </a></td> -->
                                  <td><?php
                                  //get store name
                                  //$get_Storename =$this->admin_model->get_store_details_byid($pending->affiliate_id,$pending->product_id);
                                  echo $pending->store_name;
                                  ?>
                                  </td>
                                  </td>
                                  <td><?php echo $data = $pending->date_added; ?></td>
								  <td><?php echo $data = $pending->update_date; ?></td>
                                  <td><?php echo $pending->price?></td>
                                  <!-- <td><?php echo $get_productdetails->reward_points;?></td> -->
                                  <td><?php echo DEFAULT_CURRENCY." ".$pending->commision_price; ?></td>
                                  <td>
                                  <?php 

                                  if($pending->status=='0')
                                  {

                                  ?>
                                  <span class="btn btn-danger">

                                  <a href="<?php echo base_url(); ?>adminsettings/approve_status/<?php echo base64_encode($pending->click_id); ?>"> 
                                  Pending
                                  </a>
                                  <?php
                                  }
                                  else
                                  { ?>
                                  <span class="btn btn-success">
                                  <?php 
                                  echo 'Approved';
                                  }

                                  ?> 
                                  </td>
                                  <td><a href="<?php echo base_url().'adminsettings/pending_remove_ptrs/'.base64_encode($pending->click_id);?>" onclick="return confirm_delete();">Delete</a></td>
                                  </tr>
                                  <?php $k++;} } else { ?>
                                  <tr>
                                  <td colspan="10"><center>No cashbacks found.</center></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
						
						
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
function confirmDelete(m)  // Confirm before delete cashback..
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
<!-- seetha-->
<script>
	  $(document).ready(function() {
		$(".check_b").attr("style", "opacity: 1;");
	  });
	function checkAll(ele) {    //multiple delete cashback
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
 
  function fun_fetchreport(apikey,netwrkid,status)
{
	//alert(apikey);
	
	 if(status==1)
	 {
		$.ajax({
			type:'POST',
			//dataType: 'JSON',
			
			url: '<?php echo base_url();?>adminsettings/get_report_vcommision/'+apikey+'/'+netwrkid,
			data:'apikey='+apikey+'&netwrkid='+netwrkid+'&status='+status,
			 beforeSend: function () {
				$(".bs-example-modal-sm").modal('show');
					}, 
			
			success:function(msg){	
			
				
					 $(".bs-example-modal-sm").modal('hide');
					 location.reload();
					 
				/*$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong>'+results['success']+'</strong></div>');	 */
				
		
			}
		});
	}
	/* else {
		$('.msg').html('<div class="alert alert-error"><button data-dismiss="alert" class="close">x</button><strong>Affiliate Network is De-activated.</strong></div>');
		
	} */
	
}


function fun_fetchreport1(apikey,netwrkid,status)
{
	//alert(apikey);
	
	 if(status==1)
	 {
		$.ajax({
			type:'POST',
			//dataType: 'JSON',
			url: '<?php echo base_url();?>adminsettings/get_report_snapdeal/'+apikey+'/'+netwrkid,
			data:'apikey='+apikey+'&netwrkid='+netwrkid+'&status='+status,
			 beforeSend: function () {
				$(".bs-example-modal-sm").modal('show');
					}, 
			
			success:function(msg){	
			
				
					 $(".bs-example-modal-sm").modal('hide');
					 location.reload();
					 
				/*$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong>'+results['success']+'</strong></div>');	 */
				
		
			}
		});
	}
	
	
}

function fun_fetchreport2(apikey,netwrkid,status,track_id)
{
	//alert(apikey);
	
	 if(status==1)
	 {
		$.ajax({
			type:'POST',
			//dataType: 'JSON',
			url: '<?php echo base_url();?>adminsettings/get_report_OMG/'+apikey,
			data:'apikey='+apikey+'&status='+status+'&track_id='+track_id+'&networkid='+netwrkid,
			 beforeSend: function () {
				$(".bs-example-modal-sm").modal('show');
					}, 
			
			success:function(msg){	
			
				
					 $(".bs-example-modal-sm").modal('hide');
					 location.reload(); 
					 
				/*$('.msg').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong>'+results['success']+'</strong></div>');	 */
				
		
			}
		});
	}
	
	
}
</script>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Report (Amazon)</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>adminsettings/get_report_amazon" method="post" enctype="multipart/form-data">
		<div class="control-group" >
							<label class="control-label">Upload file</label>
							<div class="controls">
								<input type="file" name="upload_xml" id="xml"> 
									
								
							</div>
							(xml format)
						</div>
						<div class="control-group" >
							<div class="controls">
							<input type="submit" name="submit" value="upload">	
							</div>
						</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <img src="<?php echo base_url();?>assets/img/loadaing.gif" id="report_loader" >Importing...
    </div>
  </div>
</div>
</body>
<!-- END BODY -->
</html>