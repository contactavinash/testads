	<span id="hidediv1" style="display:none"><center>
	<h5 style="color: red; font-weight: 600;">Image deleted successfully</h5>
	</center></span>
	<?php 
		if($product_img){
			foreach($product_img as $img){
				$image = base_url().'uploads/products/'.$img->image;
				$product_id = $img->product_id;
				$img_id = $img->gallery_id;	
	?>
	
		<div style="cursor:pointer" id="divhide<?php echo $img_id; ?>" class="preview processing success image-preview">
		   
			<a onclick="deletefile('<?php echo $img_id; ?>','<?php echo $product_id; ?>');" id="delblo1"><i class="icon icon-remove"></i></a>
                <div class="details">
                   <div class="filename">
                    <div class="sizes">
                    <a data-target="#myModalnewmo1" data-toggle="modal"><img alt="<?php echo $image; ?>" src="<?php echo $image; ?>"></a>
                    </div>
					
                    </div>
            </div>	
        </div>
		
	<?php } }?>	
				  
