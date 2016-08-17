<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rewards | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();
?>
<style>
.col-md-12 ul 
{
	border: 2px solid #ccc;
    line-height: 28px;
    padding: 17px;
}
</style>

</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- header ends here --->


<?php 
//get rewards details

$rewards_settings = $this->front_model->rewards_details();
if($rewards_settings){
	$cob_coins = $rewards_settings->cob_coins;
	$terms_conditions = $rewards_settings->terms_conditions;
}
?>
<!--- breadcrumb sec ends here --->

<section class="inner-page-sec gap-top-20  clearfix ">


  <div class="container">
  
  <div class="rewards clearfix">
  
 <h2 class="text-center text-uppercase"> Benifits of the program</h2>
 <div class="bor bg-red"></div>
 
 <h4 class="text-uppercase text-center"> Shop and earn reward points on evry purchase </h4>
 
 <hr>
    
	<div class="row">	 
	<div class="col-md-6">	 
		<div class="resume_content">
			<h2 class="resume_headings_left"><a href="javascript:void(0);">Benifits Of Shopping</a></h2>
			<div class="resume_main_content_left">
				<div class="resume_box">
					<h3>  <a href="javascript:void(0);"> Your shopping can now earn you exciting gifts.</a></h3>
				</div> 
				<div class="resume_box">
					<h3><a href="javascript:void(0);">With every purchase made through our website, Your earn points</a></h3>
				</div> 
				<div class="resume_box">
					<h3><a href="javascript:void(0);">You get 1 <?php echo $admindetailss[0]->coin_code;?>  Coin for every <?php echo DEFAULT_CURRENCY." ".$cob_coins;?> spent</a></h3>
				</div> 
				<div class="resume_box">
					<h3><a href="javascript:void(0);">Redeem points in exchange for PayTM vouchers, headphones, iPads and many more exciting gifts.</a></h3>
				</div> 
			</div>
		</div>
	</div>	 
	 <div class="col-md-6 col-sm-6">
	 <p> Any Purchase Worth</p>	 
	 <h1 class="text-center fnt-28"> <?php echo DEFAULT_CURRENCY." ".$cob_coins;?> = <img src="http://jewelfieprod.blob.core.windows.net/tc-106/c069617b-37da-48c6-9e6f-0a48beffd716?lastModified=635647082957900000" style="position: relative;"> <span style="position: absolute; left: auto; right: 130px; top: 49%; color: rgb(255, 72, 72); text-shadow: 2px 1px 0px rgb(0, 0, 0);"> 1 <?php echo $admindetailss[0]->coin_code;?> Coin </span></h1>
	 
	 
	 </div>
	</div>
      
     <!-- <div class="box-bg"> <h2 class="text-center text-uppercase"> <span class="clr-ylw"> Introductory offer </span> get free 200points on Sign-up <?php if($this->session->userdata('user_id')=='') { ?><a href="<?php echo base_url();?>cashback/rewards" class="btn btn-primary bor-rad-no"> Sign up for my rewards </a><?php } ?> </h2></div>-->
      
      <h2 class="text-center text-uppercase"> Exciting Rewards</h2>
      
      <hr>
      
      <div class="row">
		<?php
		 //get exciting rewards points
		if($getrewardsdetails)
		{
			$k=1;
			foreach($getrewardsdetails as $details)
			{
		?>
		  <div class="col-md-3">
		  
		  <h3 class="text-center text-uppercase mar-tb"> <?php echo $details->rewards_title;?></h3>
		  
		  <img style="width:151px;height:143px;" src="<?php echo base_url()?>uploads/rewards/<?php echo $details->rewards_image;?>" class="img-responsive center-block">
		  
		  <span class="wal-txt"><?php if($k<=4) { echo $details->rewards_title; }?></span>
		  
		  <h4  class="text-center text-uppercase mar-tb"> For <?php echo $details->cob_coins;?> <?php echo $admindetailss[0]->coin_code;?> Coins </h4>
		  
		  </div>
			<?php
			$k++;
			}
		}
		 ?>		 
	   </div>
	
      
      <h2 class="text-center text-uppercase">FAQ's</h2>
      
      <hr>
      
      <div class="row">
	  <div class="col-md-12">
		<div class="panel-group  " id="accordion1">
		<?php
			//rewards faq sections
			$reward_faq =$this->front_model->get_rewardsfaq();
			if($reward_faq)
			{
				$f=1;
				foreach($reward_faq as $faq)
				{
				
		?>
		  <div class="panel panel-primary">
			<div class="panel-heading panel-plus-link"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#<?php if($f==1) { echo 'collapseOne1'; }else{ echo 'collapseOne2';} ?>"><?php echo $faq->faq_qn;?><span class="pull-right ques-ans"> </span></a></div>
			<div id="<?php if($f==1) { echo 'collapseOne1'; } else { echo 'collapseOne2';}?>" class="panel-collapse collapse <?php if($f==1) { echo 'in'; }?>">
			  <div class="panel-body  ques-accord">
				<div class="qa-box">
				  <?php echo $faq->faq_ans;?>
				</div>
			  </div>
			</div>
		  </div>
		<?php
				$f++;
				}
			}
		?>
	
		</div>
		<!-- panel-group --> 
		
	  </div>
      
	</div>
	<h2 class="text-center text-uppercase">Terms & Conditions</h2>      
	<hr>      
	<div class="row">
		<div class="col-md-12">
			<?php echo $terms_conditions;?>
		</div>
	</div>
      </div>
      </div>
   
</section>

<!--- inner pagesec ends here --->
<?php $this->load->view('front/partners');

$this->load->view('front/sub_footer');

	
//Footer
	$this->load->view('front/site_intro');	
?>

<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
</body>
</html>
