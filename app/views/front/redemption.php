<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - My Redemption</title>
<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();
$user_id = $this->session->userdata('user_id');
				$balcne =  $this->front_model->user_balance_coins($user_id);
				$ads_points =  $balcne->ads_points;

?>
<style>
.error {
	color:#ff0000 !important;
	font-weight:normal !important;
}
.required_field {
	color:#ff0000 !important;
}

.alspsan
{
color:#ff0000 !important;
}
</style>
</head>

<body>
<?php $this->load->view('front/header');?>
<!-- header ends here --->

<input type="hidden" name="useridred" value="">
 
<!--- breadcrumb sec ends here --->

<section class="inner-page-sec gap-top-20  clearfix ">
<?php  $error = $this->session->flashdata('error');
				 if($error!="") {
					echo '<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">x</button>
					<strong>'.$error.'</strong></div>';
				} ?>
				<?php
					$success = $this->session->flashdata('success');
					if($success!="") {
					echo '<div class="alert alert-success">
						<button data-dismiss="alert" class="close">x</button>
						<strong>'.$success.' </strong></div>';
				} ?>

  <div class="container">  
  
    
         <div class="row">
         
         <?php $this->load->view('front/user_menu'); ?>
         <div class="col-md-9">
         
         <div class="all clearfix">
         
         <div class="row">
         
         <div class="col-md-7">
         
		 <h4 class="clr-theme">Redemption Slabs</h4>
        
		  <div class="bor bg-red"></div>
		<div class="table-responsive">
                  <table id="example" class="table table-bordered table-striped-col nomargin table-hover-color">
                    <thead>
					<tr class="bg-ylw clr-wht">
                        <th width="7%" class="text-center"><?php echo $admindetailss[0]->coin_code;?> Coins</th>
                        <th width="11%">Gift Available </th>                        
					</tr>
                    </thead>
                    <tbody>
					<?php
				if($get_redemption)
				{
					$k=1;
					foreach($get_redemption as $redemption)
					{
						
					?>
                      <tr>
                        <td class="alert"><?php echo $redemption->cob_coins;?></td>
                        <td class="alert"><h4><strong><?php echo $redemption->rewards_title;?></strong></h4>
						</td>
                      </tr>
                    <?php
					$k++;
					}
				}
					?>
					
                    </tbody>
                  </table>
                </div>
                </div>
                <input type='hidden' value="<?php echo $ads_points; ?>" id="avail_bal">
                <div class="col-md-5">                
                <div class="box-bg clearfix">                
                <h2 class="text-center">Your Available <?php echo $admindetailss[0]->coin_code;?> Coins</h2>
				<span class="price fnt-18"> <?php echo $ads_points; ?><strong> </strong> </span>
				<hr>                
                <p class="text-center"> 
				<button type="button" class="btn btn-primary bor-rad-no" data-toggle="modal" data-target="#myModal_redumption" <?php if($get_min_redeem>$ads_points){echo 'disabled';} ?>> Redeem Now </button>
				</p>                
                <h5 class="clr-red" style="display:none;">You dont have enough points to redeem</h5>                
                <p class="text-center"><a href="<?php echo base_url(); ?>cashback/ads_faq" class="text-center">Click here to view all redeem details</a></p>
                      
                </div>                
			    </div>
                
                </div>
			</div>
      </div>
         
      </div>
      </div>
   <input type='hidden' value="<?php echo $get_min_redeem; ?>" id="minimum_balance">
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



<!-- Modal -->
<div id="myModal_redumption" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#fff;">Redemption</h4>
      </div>
	   <form action="<?php echo base_url();?>cashback/add_redeamption" method="post" class="form-horizontal tabular-form">
      <div class="modal-body">
			<h2 class="text-center">Your Available ADS Coins : <span style="color: red; font-weight: bold;"><?php echo $ads_points; ?></span></h2>
       
							<input type="hidden" value="" id="user_id" name="user_id">
							
								
						<div class="form-group">
							<label for="form-password" class="col-sm-4 control-label">Coins</label>
							<div class="col-sm-8 tabular-border">
								<input type="text" autocomplete="off" required="" class="form-control" name="req_amount" id="req_amount">
								<span class="alspsan" id="alertspan"></span>
							</div>
						</div>
						<div class="form-group" style="display:<?php if($user_type==1){echo 'block';}else{echo 'none';} ?>;">
							<label for="form-confirmpass" class="col-sm-4 control-label">Password</label>
							<div class="col-sm-8 tabular-border">
								<input type="password" autocomplete="off" required="" class="form-control" name="key" id="key" <?php if($user_type!=1){echo 'disabled';}?>>
								<span class="alspsan" id="alertspan2"></span>
							</div>
						</div>			
						
							
						
						
      </div>
      <div class="modal-footer">
	  <input type="submit" value="Submit" class="btn-danger btn bor-rad-no" id="save" name="save" onclick="return validationset(<?php echo $user_type; ?>);"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>

  </div>
</div>


</body>
</html>
<script>
function validationset(type)
{
	//alert(type);
	var req_amount = $('#req_amount').val();
	if(req_amount=='')
	{
		$('#req_amount').attr('style','border: 1px solid red;');
		$('#alertspan').html("Please enter your points");
		// $('#requestset').show();
		return false;
	}
	if (isNaN(req_amount))
	{
		$('#req_amount').attr('style','border: 1px solid red;');
		$('#req_amount').val('');
		$('#alertspan').html("Please enter only numbers");
		return false;
	}	
	$('#alertspan').html('');
	$('#req_amount').attr('style','border: none');
	var key = $('#key').val();
	if(type==1)
	{
	if(key=='')
	{
		$('#key').attr('style','border: 1px solid red;');
		$('#alertspan2').html("Please enter your password");
		// $('#requestset').show();
		return false;
	}
	}
	$('#alertspan2').html('');
	$('#key').attr('style','border: none');
	
	var avail_bal = $('#avail_bal').val();
	
	var minimum_balance = $('#minimum_balance').val();
	
	if(parseFloat(req_amount)<parseFloat(minimum_balance))
	{
		$('#alertspan').html("Minimum points "+minimum_balance);
		$('#requestset').show();
		return false;
	}

	if(parseFloat(avail_bal)<parseFloat(req_amount))
	{
		
		$('#alertspan').html("Your available points only <?php echo DEFAULT_CURRENCY_CODE;?> "+avail_bal);
		$('#requestset').show();
		return false;
	}
	return true;
	
}
</script>