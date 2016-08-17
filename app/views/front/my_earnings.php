<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - My Earnings</title>
<?php $this->load->view('front/css_script');?>


<!-- <link href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css"> -->
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

<section class="inner-page-sec gap-top-20  clearfix">


  <div class="container">
    
      
         
         <div class="row">
         
		<?php $this->load->view('front/user_menu'); ?>
         
         <div class="col-md-9">
         
         <div class="all clearfix">
          
          <h4> Balance History</h4>
          
          <div class="row ">
      
      <div class="col-md-8 col-sm-8">
			<?php
				$user_id = $this->session->userdata('user_id');
				$balcne =  $this->front_model->user_balance_coins($user_id);
				$newbal =  number_format($balcne->balance,2);
				$ads_points =  $balcne->ads_points;
				$paid_earnings =  $this->front_model->paid_earnings($user_id);
				$paid_earning =  number_format($paid_earnings,2);
				
				$pending_cb = $this->front_model->pending_cashback($user_id);
				$new_pending_cb =  number_format($pending_cb,2);
				
				$pending_ref = $this->front_model->pending_referral($user_id);
				$new_pending_ref =  number_format($pending_ref,2);
				
				$balcne_cb =  $this->front_model->user_cashback_balance($user_id);
				$new_cb_bal =  number_format($balcne_cb,2);

				$total_earnings =  $this->front_model->total_earnings($user_id);
				$total_earning =  number_format($total_earnings,2);

				$waiting =  $this->front_model->waiting_approval($user_id);
				$waiting_approval =  number_format($waiting,2);

				$reff =  $this->front_model->ref_earnings($user_id);
				$ref_earning =  number_format($reff,2);
			?>
            
      
      
      <div class="green-bor"> Pending CashBack Earning <span class="pull-right"> <?php echo DEFAULT_CURRENCY." ".$new_pending_cb;?> </span> </div>
      
      <div class="red-bor mar-top5"> Pending Referral Earning <span class="pull-right"> <?php echo DEFAULT_CURRENCY." ".$new_pending_ref;?></span> </div>
      
      
      <div class="blue-bor mar-top5"> Confirmed Cashback Earning <span class="pull-right"><?php echo DEFAULT_CURRENCY." ".$new_cb_bal;?> </span> </div>
      
      <div class="grey-bor mar-top5"> Confirmed Referral Earning<span class="pull-right"> <?php echo DEFAULT_CURRENCY." ".$ref_earning;?> </span> </div>
      
      <div class="pink-bor mar-top5"> Paid Earning <span class="pull-right"><?php echo DEFAULT_CURRENCY.' '.$paid_earning;?>  </span> </div>
      
      <div class="orange-bor mar-top5"> Earnings Available for payment<span class="pull-right"><?php echo DEFAULT_CURRENCY.' '.$newbal;?> </span> </div>
	  
      <div class="green-bor mar-top5"> Waiting for withdraw approval <span class="pull-right"><?php echo DEFAULT_CURRENCY." ".$waiting_approval;?> </span> </div>
	  
	  <div class="red-bor mar-top5"> Total Earnings <span class="pull-right"> <?php echo DEFAULT_CURRENCY." ".$total_earning;?></span> </div>
      </div>
	  
	  <div class="col-md-4 col-sm-4">
      
                    <div class="panel-balance clearfix">
                        <div class="md-card-content" id="canvas_1">
                           
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                               
                                <h3 class="text-center text-uppercase">   Available Balance</h3>
                            </div>
                            
                            <div class="price-box text-center"> <span class="price fnt-18"> <strong><?php echo DEFAULT_CURRENCY;?> <?php echo $newbal;?></strong> </span></div>
                            
                            <p class="text-center"><a href="<?php echo base_url(); ?>cashback/add_withdraw" class="btn btn-primary">Withdraw</a></p>
                            
                            <p class="text-center"><strong>Minimum withdrawal amount should be <?php echo DEFAULT_CURRENCY;?> <?php echo $admindetails->minimum_cashback; ?></strong></p>
                        </div>
                    </div>
					<!--<div class="panel-balance clearfix">
                        <div id="canvas_1" class="md-card-content">
                           
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                               
                                <h3 class="text-center text-uppercase">   ADS coins</h3>
                            </div>
                            
                            <div class="price-box text-center"> <span class="price fnt-18"> <strong><?php echo $ads_points; ?></strong> </span></div>
                                                       
                        </div>
                    </div>-->
      
      </div>
	  
	  
	  
    
      
      </div>
          <div class="acc-table-style clearfix">
		  <?php if($result_cashback){ ?>
            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center">Stores Cashback </h4>
				<div class="bor bg-red"></div>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                 <table class="table table-bordered table-striped-col nomargin table-hover-color" id="example">
                           
                            <thead>
                            <tr class="bg-ylw clr-wht">
                                <th>Date</th>
								<th>Store</th>
								<th>Cashback</th>
								<th>Status</th>
                            </tr>
                            </thead>
                            
                            <tbody>
							<?php
							foreach($result_cashback as $rows)
							{
							?>
                            <tr>
                                <td><?php $data = $rows->date_added; echo date('d/m/Y',strtotime($data)); ?></td>
								<td><?php echo $rows->affiliate_id; ?></td>
								<td><?php echo DEFAULT_CURRENCY.' '.$rows->cashback_amount; ?></td>
								<td><a href="#" class="md-btn md-btn-flat-success"> <i class="fa fa-check"></i> <?php echo $rows->status ; ?></a></td>
                            </tr>
                         <?php } ?>   
                            </tbody>
                        </table>
                </div>
                <!-- table-responsive --> 
              </div>
            </div>
            <?php } ?>	
			<?php  if($result_payments){ ?>
			
			<div class="acc-table-style clearfix mar-top10">
            <div class="">
              <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center">Payment History </h4>
                <div class="bor bg-red"></div>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
				
				
			
				
               <table class="table table-bordered table-striped-col nomargin table-hover-color" id="table2">
                           
                            <thead>
                            <tr class="bg-ylw clr-wht">
                                <th>Date Requested</th>
								<th>Request Amount</th>
								<th>Status</th>
                            </tr>
                            </thead>
                            
                            <tbody>
							<?php
								foreach($result_payments as $rows)
								{
							?>
                            <tr>
                                <td><?php $data = $rows->date_added; echo date('d/m/Y',strtotime($data)); ?></td>
								<td><?php echo DEFAULT_CURRENCY." ".$rows->requested_amount; ?></td>
								<td>
								 <?php
								if($rows->status=='Requested')
								{
									?>
									<a class="btn btn-success bor-rad-no" href="javascript:void(0);"> Requested </a></td>
									<?php
								}
								if($rows->status=='Processing')
								{
									?>
									<a class="btn btn-danger bor-rad-no" href="javascript:void(0);"> Processing </a></td>
									<?php
								}
								
								if($rows->status=='Completed')
								{
									?>
									<a class="btn btn-primary bor-rad-no" href="javascript:void(0);"> Completed </a></td>
									<?php
								}
								
								if($rows->status=='Cancelled')
								{
									?>
									<a class="btn btn-danger bor-rad-no" href="javascript:void(0);"> Completed </a></td>
									<?php
								}
								?></td>
                            </tr>
                        <?php } ?>   
                            
                            </tbody>
                        </table>
                 
                     </div>
                <!-- table-responsive --> 
              </div>
            </div>
          </div>
		  
			<?php }  ?>
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
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script> -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets_new/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets_new/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets_new/plugins/data-tables/DT_bootstrap.css"/>

<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/data-tables/DT_bootstrap.js"></script>


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
				$('#table2').dataTable();
				$('#example').dataTable();
} );
	
function validationset()
{

	var req_amount = $('#req_amount').val();
	if(req_amount=='')
	{
		$('#req_amount').attr('style','border: 1px solid red;');
		$('#alertspan').html("Please Enter your Withdraw Amount");
		$('#requestset').show();
		return false;
	}
	if (isNaN(req_amount))
	{
		$('#req_amount').attr('style','border: 1px solid red;');
		$('#req_amount').val('');
		$('#alertspan').html("Please Enter only numbers");
		$('#requestset').show();
		return false;
	}
	
	var avail_bal = $('#avail_bal').val();
	var minimum_balance = $('#minimum_balance').val();
	
	if(parseFloat(req_amount)<parseFloat(minimum_balance))
	{
		$('#alertspan').html("Minimum Withdraw amount <?php echo DEFAULT_CURRENCY_CODE;?> "+minimum_balance);
		$('#requestset').show();
		return false;
	}

	if(parseFloat(avail_bal)<parseFloat(req_amount))
	{
		$('#alertspan').html("Your available balance only <?php echo DEFAULT_CURRENCY_CODE;?> "+avail_bal);
		$('#requestset').show();
		return false;
	}
	
		$('#testloader').show();
					$('#btn-login_btk').hide();
					
					//alert(req_amount);
		
	$.ajax({
		type:'POST',
		url:'<?php echo base_url(); ?>cashback/add_withdraw',
		data:{'request':req_amount},
		success:function(msg){
			$('#testloader').hide();
			$('#btn-login_btk').show();
			window.location.href = "<?php echo base_url(); ?>cashback/my_payments/pending";
		}
	});
	
}
</script>
</body>
</html>
