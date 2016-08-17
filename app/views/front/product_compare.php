<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Compare Products | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
<link href="<?php echo base_url();?>front/css/price-compare.css" rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>front/css/table-component.css" rel='stylesheet' type='text/css'>


</head>

<body>

<?php $this->load->view('front/header');?>

<section class="terms mar-bot20">

<div class="container">
<h3 class="text-center text-uppercase">Price Compare</h3>
<div class="bor bg-red"></div>

        <div class="row">
          
          <div class="wrapperwide">
<div class="gridheader panel-border">
<span class="pull-left gridheader__compare">Compare</span>
	<?php 
	
	
		if($products){
			foreach($products as $title){
				$pro_title = $title->product_name;
				$compare_title = substr($pro_title, 0 ,25);
	?>
	<span class="compare-product" data-mspid="4340">
	<!--<i class="fa fa-close"></i>--> <?php echo $compare_title; ?>	</span>
	<?php }} ?>	

</div>



<!-- For non mobile -->
<!-- End for non mobile -->


<div class="table-responsive">

<table>
	<thead>
		<tr>
		

		<th width="20%" class="pad20">
			<br><br><br><br><br><br><br><br>
			 <label class="mar-top40">
			Best Price
			  </label>
		</th>
								
								
	<?php 
	if($products){
		foreach($products as $prod){
			$product_url = $prod->product_url;
			$pro_title = $prod->product_name;
			
			//$pro_title = substr($pro_title, 0 ,25);
				
			if($prod->product_image){
				$image = base_url().'uploads/products/'.$prod->product_image;
				if (@getimagesize($image)) {
					$image = base_url().'uploads/products/'.$prod->product_image;
					}
					else
					{
						$image = base_url().'front/images/no_product.png';
					}
			}else{
				$image = base_url().'front/images/no_product.png';
			}
	?>
	
		
			<th width="25%" class="pad20">

			<img alt="<?php echo $pro_title; ?>" src="<?php echo $image; ?>" class="center-block" width="90" height="184">
			<a class="item-title" target="_blank" href="<?php echo base_url()."cashback/product_details/".$product_url; ?>"><?php 
			$title = substr($pro_title, 0 ,25);
			
			echo $title; ?></a>
			<div class="rating">
			<div style="width: 88%;" class="rating-wrap">
			<div class="star-rating">
			<div data-callout="Rated 4.4 out of 5 stars" class="rating-input callout-target"></div>
			

			</div>
			
			</div>
			
			</div>
			<p class="mar-top5">  <?php echo DEFAULT_CURRENCY.' '.number_format($prod->min_price,2);?> </p>
		</th>
							
		
	<?php }} ?>	
		
		</thead>
		<tbody>
	<?php 
	if($products){
		$sp_ids = '';
		//$sp_val = '';
		$pro_ids = '';
		foreach($products as $sp_id){
			$sp_ids .= $sp_id->specify_option_id.',';
			$pro_ids .= $sp_id->product_id.',';
			
		}
		$sp_ids = rtrim($sp_ids,',');
		$pro_ids = rtrim($pro_ids,',');
		
		$explode_sp_ids = explode(',',$sp_ids);
		//$explode_pro_ids = explode(',',$pro_ids);
		$explode_sp_ids=array_unique($explode_sp_ids);
		
	$i=1;
	?>
	
	<?php
		foreach($explode_sp_ids as $spec_id){
			$spec_menu = $this->front_model->get_details_from_id($spec_id,'specifications','specid');
			if($spec_menu){
	?>
		<tr>
			<th class="text-center">
			<?php
				echo $spec_menu->specification;
			?>
			</th>
			<?php 
				
				foreach($products as $spc_val){
					$price = $spc_val->min_price;
					$spc_id = $spc_val->specify_option_id;
					$spc_text = unserialize($spc_val->specification_extra);
					//print_r($spc_text);
			?>
			<td class="text-center">
			<?php 
				if(isset($spc_text[$spec_id])){ 
					echo $spc_text[$spec_id];
				}else{
					echo '--';
				}
			?>
			</td>
			<?php }?>
				
			<!--<td><i class="fa fa-rupee"></i> 27,000</td>
			<td><i class="fa fa-rupee"></i> 9,999</td>
			<td></td>-->
		</tr>

		
	<?php } $i++; }} ?>                  
						
	<tr>
		<th></th>
		<?php 
			foreach($products as $spc_val){
				$product_id = $spc_val->product_id;
				$product_url = $spc_val->product_url;
				$store_id = $spc_val->store_id;
				$store = $store_id.'/'.$product_id;
				echo '<td><p  class="text-center mar-no"> <a target="_blank" href="'.base_url().'cashback/product_details/'.$product_url.'" class="btn btn-primary bor-rad-no"> Go to Product </a></p></td>';
		
			}
		?>
	</tr>				
                        
		<tr><td  colspan="5"><div class="compare-head clearfix">
<div class="pull-left">
<span class="compare-title">	Price Compare </span>
</div>
</div></td></tr>



	<?php
		//foreach($explode_pro_ids as $pro_id){
			$stores = $this->front_model->fetch_store_price($pro_ids);
			if($stores){
				foreach($stores as $store){
					$pp_id = $store->pp_id;
					$prodd_id = $store->product_id;
					$store_id  = $store->store_id;
					$store_name = $store->affiliate_name;
					$price = $store->product_price;
					if($store->affiliate_logo){
						$store_image = base_url().'uploads/affiliates/'.$store->affiliate_logo;
						if (@getimagesize($store_image)) {
						$store_image = base_url().'uploads/affiliates/'.$store->affiliate_logo;
						}
						else
						{
							$store_image = base_url().'front/images/no_product.png';
						}
					}else{
						$store_image = base_url().'front/images/no_product.png';
					}
	?>
			<tr>
				<th>
				<!--<a target="_blank" href="<?php echo base_url().'cashback/visit_product/'.$pp_id.'/'.$prodd_id; ?>">-->
					<img src="<?php echo $store_image; ?>" alt="<?php echo $store_name; ?>" title="<?php echo $store_name; ?>" class="img-responsive" width="115" height="30">
				<!--</a>	-->
				</th>
			<?php
			$proidsliat = explode(',',$pro_ids);
				foreach($proidsliat as $proids)
				{
					$getproductprice = $this->front_model->getproductprice_main($proids,$store_id);
					echo "<td>";
					if($getproductprice)
					{
					?>
								<div class="storerate">
								<?php echo DEFAULT_CURRENCY.' '.number_format($getproductprice->product_price,2);?>
								 </div>
                                 <div class="gostorebtn">
                                        <a title="Go To Store" class="btn btn-danger bor-rad-no" target="_blank" href="<?php echo base_url(); ?>cashback/visit_product/<?php echo $getproductprice->pp_id;?>/<?php echo $proids;?>">
                                        Go to Store </a>
                                  </div>
                                                            
															
					<?php
					}
					else
					{
						?>
						<div class="na"> NA</div>
						<div class="gostore">
                                        <a style="color: red;"> Not Available On this Store</a>
                                    </div>
									
						<?php
					}
					echo "</td>";
					?>
				<?php 
				}
				?>					
			</tr>
		<?php }} ?>	
			
			
		</tbody>
	</table>
                
    </div>


</div>
</div>
</div>
          
          </div>
          
     
  </div>
  
  </div>
</section>

<!--- inner pagesec ends here --->

<?php 
	$this->load->view('front/sub_footer');
//Footer
	$this->load->view('front/site_intro');	
// footer ends here  
	$this->load->view('front/js_scripts');
?>

<!--- footer ends here ---> 


</body>
</html>