<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $admindetails[0]->homepage_title;?></title>
	<meta name="Description" content="<?php echo $admindetails[0]->meta_description;?>"/>    
    <meta name="keywords" content="<?php echo $admindetails[0]->meta_keyword;?>" />     
    <meta name="robots" CONTENT="INDEX, FOLLOW" />

<!-- Bootstrap --> 
<?php $this->load->view('front/css_script'); ?>	
  
</head>

<body> 
 
 <?php $this->load->view('front/header'); ?>
<script type="text/javascript">
function pay_using_site()
{
	var otot=tot=quan=price=product_id=0;
	var i_val=$('#i').val();
	var concat_var='';
	for(i=1;i<=$('#i').val();i++)
	{
		quan=$('#quantity_'+i).val();
		price=$('#price_'+i).val();
		product_id=$('#product_id'+i).val();
		tot=quan*price;
		otot=otot+$('#quantity_'+i).val()*$('#price_'+i).val();
		concat_var=concat_var+"&quan"+i+"="+quan+"&price"+i+"="+price+"&product_id"+i+"="+product_id+"&tot"+i+"="+tot;
	}		
	$.ajax({  
	url:"<?php echo base_url(); ?>index.php/cashback/payusing_site",	
	type:"POST",
	data: "i_val="+i_val+"&otot="+otot+concat_var, 
	success:function(data)
	{
		if(data==1)
		{          
	window.location.href="<?php echo base_url(); ?>index.php/cashback/thankyou";
		}
	}  
	}); 
}
function pay_using_umoney()
{
document.getElementById("checkout").submit();
}	
function delete_cart(id)
{
	alert(id);
	$.ajax({  
	url:"<?php echo base_url(); ?>index.php/cashback/delete_cart",
	data: "id="+id,     
	type:"POST",
	success:function(data)
	{  	
	window.location.href="<?php echo base_url(); ?>index.php/cashback/cart_listing_page";
	return false;
	}
	}); 
	return false;
}

$(document).on('click', '.number-spinner button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		max_value=btn.closest('.number-spinner').find('input').attr('ref'),
		ref_value=btn.closest('.number-spinner').find('input').attr('refernce'),
		newVal = 0;
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	if(max_value>=newVal)
	{
	btn.closest('.number-spinner').find('input').val(newVal);

	$('#sub_totla_'+ref_value).val(newVal*$('#price_'+ref_value).val());
	var otot=0;
	
	for(i=1;i<=$('#i').val();i++)
	{
		otot=otot+$('#quantity_'+i).val()*$('#price_'+i).val();
	}	
	$('#sub_tot').val(otot);
	$('#pay').css('display','none');
	}
	else
	{
		
	}
	return false
});

function check_open()
{
var oveltotal=$('#sub_tot').val();	
$.ajax({  
	url:"<?php echo base_url(); ?>index.php/cashback/check_amount",
	data: "amount="+oveltotal,     
	type:"POST",
	success:function(sara)
	{          
	if(sara==0)
	{
	$('#v_site').css('display','none');
    $('#h_site').css('display','none');	
	}
	}  
	}); 
	
$('#pay').css('display','block');



}

</script>
<div class="wrap-top">
  <div id="content">
    <div class="container">
    
      <section class="mid-sec">
       
        <div class="row">
<div class="mar-top20 table-responsive">
<form action="<?php echo base_url();?>index.php/cashback/PayUmoney" method="post" id="checkout" name="checkout">

	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th width="48%" style="width:50%">Product</th>
							<th width="8%" style="width:10%">Price</th>
							<th width="21%" style="width:8%">Quantity</th>
							<th width="15%" class="text-center" style="width:22%">Subtotal</th>
							<th width="8%" style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                    
                    <?php $sub_total=0; $i=0; if($cart) { foreach($cart as $carts) {  $i++;
					$product_details=$this->front_model->details($carts->product_id);
					$db_coupon_image=$product_details->coupon_image;
							 $exp_db_coupon_image=explode(",",$db_coupon_image);  	
							 $maximum_count=explode(",",$product_details->remain_coupon_code);
					 ?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="<?php echo base_url(); ?>uploads/premium/<?php echo $exp_db_coupon_image[0]; ?>" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"><?php echo $product_details->offer_name ?></h4>
										<p><?php echo $product_details->title ?></p>
									</div>
								</div>
							</td>
							<td data-th="Price"><?php echo DEFAULT_CURRENCY;?> <?php echo $product_details->amount ?></td>
							<td data-th="Quantity">
								<div class="input-group number-spinner">
                                
                                <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="dwn"><span class="fa fa-minus"></span></button>
                                </span>
                                <input type="text" class="form-control text-center" name="quantity_<?php echo  $i; ?>" id="quantity_<?php echo  $i; ?>" value="1" ref="<?php echo count($maximum_count); ?>"  refernce="<?php echo $i; ?>" readonly>
                                <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="up"><span class="fa fa-plus"></span></button>
                                </span>
                                
								</div>
		
							</td>
							<td data-th="Subtotal" class="text-center">
                            <input type="hidden"  name="price_<?php echo  $i; ?>" id="price_<?php echo  $i; ?>" value="<?php echo  $product_details->amount; ?>" >
                            <input type="hidden"  name="product_id<?php echo  $i; ?>" id="product_id<?php echo  $i; ?>" value="<?php echo  $carts->product_id; ?>" >
                            <input type="text"  class="form-control text-center" value="<?php echo $product_details->amount*$carts->quantity  ; ?>" id="sub_totla_<?php echo $i; ?>" name="sub_totla_<?php echo $i; ?>" readonly>
							<?php 
							 $sub_total+=$product_details->amount*$carts->quantity;?></td>
							<td class="actions" data-th="">
								<!--<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>-->
								<button class="btn btn-danger btn-sm"  onclick="return delete_cart(<?php echo $carts->id;  ?>);"><i class="fa fa-trash-o"></i></button>								
							</td>
						</tr>
                        
                    <?php } } else { ?>
                    <tr>
							<td data-th="Product">
                            No records Found
                            </td>
                            </tr>
                    <?php } ?>
                    <input type="hidden"  name="i"  id="i" value="<?php echo  $i; ?>">
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total <input  class="form-control text-center" type="text" id="sub_tot1"  name="sub_tot" value="<?php echo $sub_total; ?>" readonly></strong></td>
						</tr>
						<tr>
							<td><a href="<?php echo base_url(); ?>index.php/cashback/shopping" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
<?php                            if($cart) {  ?>
							<td class="hidden-xs text-center"><strong>Total Rs<input  class="form-control text-center" type="text" id="sub_tot" name="sub_tot" value="<?php echo $sub_total; ?>" readonly></strong></td>
							<td><a href="javascript:void(0)" onclick="check_open();" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                            <?php }?>
						</tr>
					</tfoot>
				</table>
                </form>

</div><!-- .large-9 -->



<!-- .large-3 -->
</div>
                
         
        </section>
          <section class="mid-sec">
       
        <div class="row">
<div class="mar-top20 table-responsive">


	<table id="pay" class="table table-hover table-condensed" style="display:none">
    				<thead>
						<tr>
							<th width="48%" style="width:20%"><center>Choose payment method</center></th>
							<th width="8%" style="width:30%"><center>Netbanking / PayUMoney (Credit / Debit Card / Netbanking via PayUMoney)</center> </th>
							<th width="21%" style="width:30%" id="h_site"><center>Pay using cash in cart </center></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-th="Price"></td>
                            <td data-th="Price"><a class="btn btn-success btn-block" href="javascript:void(0)" onclick="pay_using_umoney();">Pay <i class="fa fa-angle-right"></i></a></td>
                            <td data-th="Price" id="v_site"><a class="btn btn-success btn-block" href="javascript:void(0)" onclick="pay_using_site();">Pay <i class="fa fa-angle-right"></i></a></td>
                         </tr>
				</table>

</div><!-- .large-9 -->



<!-- .large-3 -->
</div>
                
         
        </section>
        
        
    </div>
  </div>
</div>

<body> 
 


 <?php
//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>
</footer>
  
<?php $this->load->view('front/js_scripts');?>

</body> 
</html>
