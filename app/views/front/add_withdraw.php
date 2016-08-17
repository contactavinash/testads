<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - Withdraw</title>
<?php $this->load->view('front/css_script');?>
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



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec gap-top-20  clearfix ">


  <div class="container">
    
         <div class="row">
         
        <?php $this->load->view('front/user_menu'); ?>
         
         <div class="col-md-9">         
         <div class="all clearfix">
			
			<?php
				$user_id = $this->session->userdata('user_id');
				$balcne =  $this->front_model->user_balance($user_id);
				$newbal =  number_format($balcne,2);
			?>
			 <input type="hidden" name="avail_bal" value="<?php echo $newbal;?>" id="avail_bal">
			 			 <input type="hidden" name="minimum_balance" value="<?php echo $admindetails->minimum_cashback; ?>" id="minimum_balance">
			<!-- Tab panes -->
			<div class="tab-content">
			<br>
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
				
			                                        
					<div class="panel" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
						<div class="panel-heading">
							<h4 class="mar-no">Withdraw Money </h4>
						</div>                        
                        <hr>
						<div class="panel-body">

						<div class="row">
						
      
                    <div class="box-bg panel-border clearfix">
                        <div class="md-card-content" id="canvas_1">
                           
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                               
                                <h3 class="text-center text-uppercase">   Available Balance</h3>
                            </div>
                            
                            <div class="price-box text-center"> <span class="price fnt-18"> <strong><?php echo DEFAULT_CURRENCY;?> <?php echo $newbal;?> </strong> </span></div>
                            
                            <p class="text-center text-uppercase"><strong>Minimum withdrawal amount should be <?php echo DEFAULT_CURRENCY;?> <?php echo $admindetails->minimum_cashback; ?></strong></p>
                        </div>
                    </div>     
     
					<div class="col-md-12">
					
						<form class="form-horizontal tabular-form" method="post" action="<?php echo base_url(); ?>cashback/add_withdraw">
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $results->user_id;?>">
							
								
						<div class="form-group">
							<label class="col-sm-4 control-label" for="form-password">Amount</label>
							<div class="col-sm-8 tabular-border">
								<input type="text"  id="req_amount" name="req_amount" class="form-control" required autocomplete="off">
								<span id="alertspan" class="alspsan"></span>
							</div>
						</div>
                       
						<div class="form-group" style="display:<?php if($user_type==1){echo "block";}else{echo "none";} ?>">
							<label class="col-sm-4 control-label" for="form-confirmpass">Password</label>
							<div class="col-sm-8 tabular-border">
								<input type="password" id="key" name="key"  class="form-control" required autocomplete="off" <?php if($user_type!=1){echo "disabled"; } ?>>
								<span id="alertspan2" class="alspsan"></span>
							</div>
						</div>			
						
							
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-4">
									<!--<button class="btn-danger btn bor-rad-no">Change Password</button>-->
									<input type="submit" onclick="return validationset(<?php echo $user_type; ?>);" name="save" id="save" class="btn-danger btn bor-rad-no" value="Submit"> 
									<a href="<?php echo base_url(); ?>"><button class="btn-default btn bor-rad-no">Cancel</button></a>
								</div>
							</div>
							</div>	
						</form>
						  </div>
						 </div>
						</div>						
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
<script type="text/javascript">
$('#req_amount').keyup(function(){
	var req_amount = $('#req_amount').val();
	if(parseFloat(req_amount)<=0){
		$('#req_amount').val("");
	} else {
		req_amount = req_amount.replace(/[^0-9\.]/g,'');
		if(req_amount.split('.').length>2) 
		req_amount = req_amount.replace(/\.+$/,"");
		$('#req_amount').val(req_amount);
	}
});
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
				// $('#table2').dataTable();
				//$('#example').dataTable();
} );
	
function validationset(type)
{
	//alert(type);
	var req_amount = $('#req_amount').val();
	if(req_amount=='')
	{
		$('#req_amount').attr('style','border: 1px solid red;');
		$('#alertspan').html("Please enter your withdraw amount");
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
		$('#alertspan').html("Minimum withdraw amount <?php echo DEFAULT_CURRENCY_CODE;?> "+minimum_balance);
		$('#requestset').show();
		return false;
	}

	if(parseFloat(avail_bal)<parseFloat(req_amount))
	{
		$('#alertspan').html("Your available balance only <?php echo DEFAULT_CURRENCY_CODE;?> "+avail_bal);
		$('#requestset').show();
		return false;
	}
	return true;
	
}

// $("#req_amount").blur(function(){
    // alert("This input field has lost its focus.");
// });

</script>


</body>
</html>
