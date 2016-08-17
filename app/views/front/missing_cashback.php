<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - Missing Cashback</title>
<?php $this->load->view('front/css_script');?>


<link href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css">

<style>
.error {
	color:#ff0000 !important;
	font-weight:normal !important;
}
.required_field {
	color:#ff0000 !important;
}
</style>
</head>

<body>
<?php $this->load->view('front/header');?>

<!-- header ends here --->



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec gap-top-20  clearfix ">


  <div class="container">
    
      
         
         <div class="row">
         
         <?php $this->load->view('front/user_menu'); ?>
         <div class="col-md-9">
         
         <div class="acc-table-style clearfix">
        
        <div class="panel">
              <div class="panel-border">
                <p class="panel-title">Missing any cashback? Simply add a new cashback ticket with details of your transaction, and we will speak with the retailer to see why it did not track. Below is a list of your existing cashback tickets and their status. For any other questions, please feel free to  <a href="<?php echo base_url();?>cashback/contact">contact us</a></p>
              </div>
              <div class="panel-body">
              
              <div class="box clearfix"> <h4 class="text-uppercase">Cashback Tickets  <span class="pull-right"><a href="<?php echo base_url();?>cashback/add_missing_cashback" class="btn btn-primary bor-rad-no"> Add Cashback Ticket </a></span></h4> </div>
			  <br>
                <div class="table-responsive">
                  <table <?php if($results){ ?> id="example" <?php } ?> class="table table-bordered table-striped-col nomargin table-hover-color">
                    <thead>
                      <tr class="bg-ylw clr-wht">
                        <th>Transaction date</th>
                        <th>Date of Query</th>
						<th>Retailer Name</th>
						<th>Transaction ID</th>
						<th>Transaction Amount (<?php echo DEFAULT_CURRENCY_CODE;?>)</th>
						<th>Status</th>
						 <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php
				if($results!='')
				{
					$kss=1;
					foreach($results as $res)
					{						
					?>
                      <tr>
						<td><?php echo $res->click_date;?></td>
						<td><?php echo $res->trans_date;?></td>
						<td><?php echo $res->retailer_name;?></td>
						<td><?php echo $res->transaction_ref_id;?></td>
						<td><?php echo $res->transation_amount;?></td>
                        <?php $details = $res->status;
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
								$getadmindetails = $this->front_model->getadmindetails();
								$site_logo = $getadmindetails[0]->site_logo;
							?>
                            <td><a data-toggle="modal" style="cursor:pointer" data-target="#myModal_view_<?php echo $kss;?>">View</a> </td>
                      </tr>
						<div class="modal fade cls_store_head" id="myModal_view_<?php echo $kss;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
									<div class="modal-header-default">
									<img width="" height="" class="logo" alt="<?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?>.com" src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $site_logo;?>">
										<?php
											$cashback_id  = $res->cashback_id;
											 $stat_num = 5000+$cashback_id;
											 //$getclickdate = date("d F Y", strtotime($res->trans_date));
											 $getclickdate = $res->trans_date;
											?>
											<h3 style="padding: 10px;">&nbsp;&nbsp;Details regarding Ticket no: <?=$stat_num?></h3>
									</div>
								</div>
							<div class="modal-body">
							<section class="popup">
								<div class="fw header">
									
								</div>
							   
								<div class="view_ticket">
									<label data-name="Date of query:" class="fw clearfix"><?=$getclickdate?></label>
									<label data-name="Merchant Name:" class="fw clearfix"><?=$res->retailer_name?></label>
									<label data-name="Transaction Amount:" class="fw clearfix"> <span class="indianRs"><?php echo DEFAULT_CURRENCY;?> </span> <?=$res->ordervalue?></label>
									<label data-name="Transaction reference:" class="fw clearfix">&nbsp;<?=$res->transaction_ref_id?></label>
									<label data-name="Coupon Code Used:" class="fw clearfix">&nbsp;<?=$res->coupon_code?></label>
									<label data-name="Details:" class="fw clearfix">&nbsp;<?=$res->cashback_details?></label>
									<?php
									switch($res->status)
									{
										case 0:
											$stra = 'Completed';
										break;
										case 1:
											$stra = 'Cancelled';
										break;
										case 2:
											$stra = 'Sent to retailer';
										break;
										case 3:
											$stra = ' Created';
										break;
									}
									?>
									
									<label data-name="Status:" class="fw clearfix">&nbsp;<?=$stra;?></label>
									<label data-name="Date of Status Update" class="fw clearfix"> &nbsp;<?=$res->status_update_date?></label>
								</div>
								
							</section>
							</div>
							</div>
							</div>
						</div>
                    </tbody>
				<?php
					$kss++;
					}
				}
				?>
                  </table>
                </div>
                <!-- table-responsive --> 
              </div>
            </div>
      
      </div>
      
      </div>
    </div>
         
      
        
      </div>
   
</section>

<!--- inner pagesec ends here --->
<?php $this->load->view('front/partners');?>

<!--- partners ebds here --->
<?php $this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
</script>
</body>
</html>
