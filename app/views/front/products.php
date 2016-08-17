<?php $pagetitle =  ucwords($category_name); 
if($brand_url)
{
	$brand_details = $this->front_model->get_details_from_id($brand_url,'brands','brand_url');
	$pagetitle =  ucwords($brand_details->brand_name); 
}

if($keyword)
{
	$pagetitle =  ucwords(urldecode($keyword)); 
	
}

if($pagetitle=='')
{
	$pagetitle = $searchword;
}


	?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $pagetitle;?> | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
<link href="<?php echo base_url();?>front/css/nouislider.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>front/css/magicaccordion.css" rel="stylesheet" type="text/css">

<style>
.displayGif{
	background-repeat:no-repeat;
	display:block;
	width:500px;
	height:300px;
	/*background-image: url(<?php echo base_url();?>front/images/loadset.gif);*/
	/*background-image: url(<?php echo base_url();?>front/images/loading-x.gif); */
}
.loaderajaxs
{
position: absolute;  left: 400px; top: 250px;
}
.containerimg {
    width: auto;
    height: 150px;
}

/* resize images */
.containerimg img {
    height: 150px;
 	width: auto;
}
</style>

</head>
<body>
<?php $this->load->view('front/header');?>

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
		<?php
		//print_r($products);
		if($products)
		{
		?> 
          <div class="column col-xs-12 col-sm-3">
            <div id="layered_block_left" class="block pad clearfix">
            
              <div class="block_content">
                <form action="#" id="layered_form">
                  <div>
                  <?php
					if($products)
					{
					?>            
                  <div class="layered_subtitle_heading"> <span class="layered_subtitle">Price</span> 
                      <div class="range-slider">
                          <div id="price" class="filter-price"></div>
                    <ul class="list-inline nomargin range-slider-box mar-top10">
                          <li>Rs.<span class="range-slider-value"><span class="example-val" id="price-lower"></span></span></li>
                          <li>Rs.<span class="range-slider-value"><span class="example-val" id="price-upper"></span></span></li>
                          </ul>
                          </div>                       
                    </div>
                   <?php 
					}
					else{?>
					
						<img src="<?php echo base_url();?>front/img/noDataAvailableEN.png">
					<?php }
					if($brands)
					{?>   
                         <div class="layered_filter clearfix">
                      <div class="layered_subtitle_heading"> <span class="layered_subtitle">Brands <span class="pull-right"> <a href="javascript:void(0)" onclick="return brands_get('brand','clear');"> Clear</a></span></span> </div>
                       <div class="checkbox pro-list">
                       <?php			
			
					$brand_id = explode(',',$brands);						
					foreach($brand_id as $brand_id){
							$brand_count = $this->front_model->get_count_from_id_brands($brand_id,$cate_level_id,$cate_id_id);							
							$spec_details = $this->front_model->get_details_from_id($brand_id,'brands','brand_id');
							if($spec_details){
					?>
                    <label>
                            <input type="checkbox" class="checkbox" name="brands" value="<?php echo $spec_details->brand_name.$brand_id; ?>" onclick="return brands_get('brand','');" />
                             <label> <a href="javascript:void(0);" data-rel="nofollow"><?php echo ucwords($spec_details->brand_name); ?><span> (<?php echo $brand_count; ?>)</span></a> </label>
                            
                        </label>
							
					<?php }else{ echo 'No Brands found';}
					} ?>
                      </div>
                      
                    </div>
					<?php
					}
					?>   
                    
                    <?php
					
					if($specification!="" && $brand_url=="")
					{
						
						$spec_id = explode(',',$specification);
						if($spec_id){
							foreach($spec_id as $sp_id){
								
							
								$spec_details = $this->front_model->get_details_from_id($sp_id,'specifications','specid');
							
								
							if($spec_details){
					?>	
                    
                    <div class="layered_filter clearfix">
                      <div class="layered_subtitle_heading"> <span class="layered_subtitle"><?php echo ucwords($spec_details->specification); ?></span> </div>
                                   <div class="checkbox pro-list">
                                   <?php
                                   $spec_option=$this->front_model->filter_specification($cate_id_id,$sp_id);
                                  
								if($spec_option){

									$filters=unserialize($spec_option->filters);
									foreach($filters as $fltr)
									{

									
									?>
                                       <label>
                                            <input type="checkbox" class="checkbox" name="specify" specification_id="<?php echo $sp_id; ?>" value="<?php echo $fltr; ?>" onClick="return brands_get('specify');" />
                                             <label> <a href="javascript:void(0);" data-rel="nofollow"><?php echo ucwords($fltr); ?></a> </label>
                                            
                                        </label>
									<?php 
											
									}
										}else{ echo 'No records found'; }
									?>  
                                    </div>
                               </div>
							
					<?php
							}
						}
						}
					}
					?> 
                    <?php
					echo $brand_url;
					if($brand_url)
					{
						
						$spec_id = explode(',',$specification);
						if($spec_id){
							foreach($spec_id as $sp_id){
								
							
								$spec_details = $this->front_model->get_details_from_id($sp_id,'specifications','specid');
							
								
							if($spec_details){
					?>	
                    
                    <div class="layered_filter clearfix">
                      <div class="layered_subtitle_heading"> <span class="layered_subtitle"><?php echo ucwords($spec_details->specification); ?></span> </div>
                                   <div class="checkbox pro-list">
                                   <?php
                                   $spec_option=$this->front_model->filter_specification($pcate_id,$sp_id);
                                  
								if($spec_option){

									$filters=unserialize($spec_option->filters);
									foreach($filters as $fltr)
									{

									
									?>
                                       <label>
                                            <input type="checkbox" class="checkbox" name="specify" specification_id="<?php echo $sp_id; ?>" value="<?php echo $fltr; ?>" onClick="return brands_get('specify');" />
                                             <label> <a href="javascript:void(0);" data-rel="nofollow"><?php echo ucwords($fltr); ?></a> </label>
                                            
                                        </label>
									<?php 
											
									}
										}else{ echo 'No records found'; }
									?>  
                                    </div>
                               </div>
							
					<?php
							}
						}
						}
					}
					?>
									
                  </div>
                </form>
              </div>
            </div>
          </div>
		  
		  <?php
		}
		  ?>

         
  
  
  <!-- end sidebar -->
		<!--  <div id="center_column" class="center_column col-xs-12 col-sm-9">
            <div class="content_scene_cat">
              <div class="content_scene_cat_bg"> <img class="img-responsive" src="<?php echo base_url() ?>front/img/pro-slide-img.png" alt=""/> </div>
            </div>-->
            
					
            <div id="center_column" class="center_column col-xs-12 <?php if(!$products){echo "col-sm-12";}else{echo "col-sm-9";}?>">
            <h2 class="text-center text-uppercase" style="font-weight:bold"> 
				<?php echo $pagetitle;?>
                </h2>
                
      
     <div class="bor bg-red"></div>
	 <?php if($products)
	 {?>
     <form class="form-inline" >
  <div class="form-group">
    <label for="exampleInputName2">Sort by : </label>
     <select id="scrapping_sort" onchange="return brands_get('filter');" class="form-control">
	 <option value=""> Best Match</option>
     <option value="lowtohigh"> Low to high</option>
     <option value="hightolow"> high to Low</option>
	 <option value="offers"> Best Offers</option>
     </select>
  </div>
  </form>
	 <?php } ?>
            
            
            
			<div class="content_sortPagiBar bor-no mar-no clearfix " style="position:relative" >
            
            <div class="displayGif loaderajaxs" id="loading-gif" style="z-index: 2147483647; ">
			  <div class="page-title category-title">
				<h1><?php echo $pagetitle;?></h1>
			  </div>
			  <div class="toolbar bor-no mar-no">
				
				<!-- Products list -->
				<ul class="product_list grid row mar-no" id="ajax_product_list">
				
					<!-- load products call ajax function ajax_product_list -->    
				
				</ul>
                <div id="loadid" style="display:none;"><center><img src="<?php echo base_url();?>front/images/loadset.gif"></center></div>
                <br>
			  </div>
			  
			  <div class="service-content no-product" style="display:none"><div class=""><div class="alert alert-info text-center">No More Products Available.</div></div></div>
			  
			  <div class="service-content no-product_none" style="display:none"><div class=""><div class="alert alert-info text-center">No matching products available..</div></div></div>
			  
			  
              </div>
              
			</div>
		  </div>
        </div>
      </div>
    </div>
  </div>
  
	<div class="bg-compa" id="product_div" style="display:none">
		<button type="button" class="close" data-dismiss="modal" onclick="close_div('close');"><span aria-hidden="true">&times;</span></button>
		
		<ul class="list-unstyled clearfix mar-top20" id="product_ul">
			<!--<li> <div class="bg-blue"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <img src="<? echo base_url(); ?>front/img/prod1.jpg" width="100" height="120" alt="" class="img-responsive center-block"> <h5 class="clr-blu text-uppercase text-center"> Samsung Galaxy</h5> <p></p></div></li>-->
			<div id="compare_product"></div>
		</ul>
		<p class="text-center mar-top">
		<form id="compare_form" action="<?php echo base_url(); ?>compare_products" method="post">
			<input type="hidden" name="category_url" value="<?php echo $this->uri->segment(3); ?>"/>
			<input type="hidden" name="brand_url" value="<?php echo $this->uri->segment(3); ?>"/>
			<input type="hidden" name="product_ids" id="product_ids"/>
			<input type="submit" class="btn btn-primary bor-rad-no" value="Compare"> 
			<button type="button" class="btn btn-ylw bor-rad-no" onclick="close_div('remove_all');"> Remove all</button>
		</form>	
		</p>
		
	</div>
	
<!-- Button trigger modal -->
	<button type="button" id="alert_modal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalalert" style="display:none">Modal</button>

<!-- Modal -->
	<div class="modal fade" id="myModalalert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Warning!</h4>
		  </div>
		  <div class="modal-body">
			<span id="compare_msg">You can't compare more than 3 products at one time.</span>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

<!-- End Modal -->
</section>

<input type="hidden" name="catesupid" value="<?php echo $cate_id_id;?>" id="catesupid">

<input type="hidden" value="12" id="page_limit" />
<!--- inner pagesec ends here --->
<!--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
<?php 
	$this->load->view('front/sub_footer');
//Footer
	$this->load->view('front/site_intro');	
// footer ends here  
	$this->load->view('front/js_scripts');
?>

<script src="<?php echo base_url();?>front/js/nouislider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>front/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url();?>front/js/magicaccordion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>front/js/isotope.pkgd.min.js"></script>
<script>
// Isotope filters
//-----------------------------------------------
if ($('.isotope-container').length>0) {
$(window).load(function() {
	var $container = $('.isotope-container').isotope({
		itemSelector: '.isotope-item',
		layoutMode: 'masonry',
		transitionDuration: '0.6s',
		filter: "*"
	});
	// filter items on button click
	$('.filters').on( 'click', 'ul.nav li a', function() {
		var filterValue = $(this).attr('data-filter');
		$(".filters").find("li.active").removeClass("active");
		$(this).parent().addClass("active");
		$container.isotope({ filter: filterValue });
		return false;
	});
});
};
function open_in_new_tab(url )
{
	var win=window.open(url, '_self');
	win.focus();
	document.cookie="usern=seetha";
}
//after login sections
$('.after_login').click(function(){	
 //alert('seeha');
	var url = ($(this).attr('data-id'));
	var show_id = ($(this).attr('show_id'));
	//alert(show_id);
	var win=window.open(url, '_self');
	win.focus();
	sessionStorage["PopupShown1"] = 'yes';
	sessionStorage["show_id"] = show_id;
	
})
$().ready(function(){
	
	url = window.location.href;
	var filters = 'filter';
	var filtersz_id = url.match('[?&]' + filters + '=([^&]+)');
	if(filtersz_id!='' && filtersz_id!=null)
	{
			$('#scrapping_sort').val(filtersz_id[filtersz_id.length-1]);
	}
	ajax_search_products(); //search key filter by product
	
	loc = $('<a>', {href:window.location})[0];
	if(history.pushState){
		var brandulr = '<?php echo $brand_url;?>';
		var keyword = '<?php echo $keyword;?>';
		if(window.location.hash) {
		 var oldhash = window.location.hash;
		} else {
		  var oldhash ='';
		}
		if(oldhash=='')
		{
			if(brandulr){
				history.pushState(null, null, loc.pathname+'#brands='+brandulr);
			}
			else if(keyword)
			{
				history.pushState(null, null, loc.pathname+'#keyword=<?php echo $keyword;?>');	
			}			
			else{
				history.pushState(null, null, loc.pathname+'#category=<?php echo $category_url; ?>');	
			}
		}
		else
		{
			if(brandulr){
				history.pushState(null, null, loc.pathname+oldhash);
			}
			else{
				history.pushState(null, null, loc.pathname+oldhash);	
			}
		}
		
	}
	if(sessionStorage["PopupShown1"] == 'yes') 
	{ 
		//$("div#myModal_visit_store"+sessionStorage["show_id"]).modal({backdrop: 'static',keyboard: false});
		$("#show_modal_"+sessionStorage["show_id"])[0].click();
		sessionStorage["PopupShown1"] = 'no';
		sessionStorage["show_id"] = '';
	} else {
		sessionStorage["show_id"] = '';
	}	
})
</script>

<script>

		
//declaring variables
	var base_url = '<?php echo base_url(); ?>';
	 
 //customize this as your need
	var request_ajax = true;
	var ajax_is_on = false;
	var product_name = '<?php echo $this->uri->segment('2'); ?>';
	var objHeight=$(window).height()-50;//customize this as your need
	var last_scroll_top = 0;
	$('.no-product').hide();
	$(window).scroll(function(event) {

	var offset = $('#page_limit').val();
	//console.log(offset);
		var st = $(this).scrollTop();
	   	url = window.location.href;
	var brand = 'brands';
	var specify = 'specify';
	var brand_id = url.match('[?&]' + brand + '=([^&]+)');
		var prices = url.match('[?&]' + price + '=([^&]+)');
	var specify_id = url.match('[?&]' + specify + '=([^&]+)');
		if(st > last_scroll_top){

			if ($(window).scrollTop() + 500 > $(document).height() - $(window).height()) {

		if (request_ajax === true && ajax_is_on === false) {
			ajax_is_on = true;
			//$("#loading-gif").removeClass('hideGif').addClass('displayGif');
			//$("#loading-gif").addClass('displayGif');
			$("#loadid").show();
			var type = window.location.hash.substr(1);
			
			/*var brand_id = url.match('[?&]' + brand + '=([^&]+)');
			var specify_id = url.match('[?&]' + specify + '=([^&]+)');
			var prices = url.match('[?&]' + price + '=([^&]+)');*/
		
			//	alert(brand_id);
		
			var filter = $('#scrapping_sort').val();
		/*			var low_price = $("#price-lower").html();
					var lows = $("#price-upper").html();
					if(!low_price)
					{
						$("#loadid").hide();
						return false;
					}
					var pricess = "&price="+low_price+'-'+lows;
					prices2 = low_price+'-'+lows;
					
					var prices = new Array( pricess, prices2 );*/
					
			$.ajax({
				url: base_url + 'cashback/products_pagination/'+product_name,
				data: {'brands': brand_id,'specify': specify_id,'page_limit': offset,'price':prices,'type':type,'filter':filter},
				type: 'post',
				success: function(data) {
				$("#loadid").hide();	
					if (data != 0) {
						$('#ajax_product_list').append(data);
								$('#page_limit').val(parseInt(offset)+parseInt(6));
								//offset += 6;
								
					}else{
						//$(".no-product").fadeIn(500);
						   //request_ajax = false;
						$('.no-product').show();
						//$(".no-product").fadeOut(5000);
						
					}
					//alert('fdsf');
					
			
					ajax_is_on = false;
				}  
			});
		}  
		}}	
		 last_scroll_top = st;
	});
	

	function ajax_search_products(){
		$('.no-product_none').hide();
		$("#loadid").show();
		var type = window.location.hash.substr(1);
		//console.log(type);		
		url = window.location.href;
		var brand = 'brands';
		var specify = 'specify';
		var price = 'price';
		var filter = 'filter';
		var brand_id = url.match('[?&]' + brand + '=([^&]+)');
		var specify_id = url.match('[?&]' + specify + '=([^&]+)');
		var prices = url.match('[?&]' + price + '=([^&]+)');
		var filter = url.match('[?&]' + filter + '=([^&]+)');
		$("#loading-gif").removeClass('displayGif');
					$("#loading-gif").removeClass('loaderajaxs');
					$('#ajax_product_list').hide();
				
		$.ajax({
				url: base_url + 'cashback/products_pagination/'+product_name,
				//data:{'cat_id':id},
				type: 'post',
				data: {'brands': brand_id,'specify': specify_id,'price':prices,'type':type,'filter':filter},
				success: function(data) {
					
					$("#loadid").hide();
					if (data != 0) {
						$('#ajax_product_list').html(data);
						$('#ajax_product_list').show();
					}else{
						//$(".no-product").fadeIn(500);
						
						$('.no-product_none').show();
						//$(".no-product").fadeOut(5000);
					}
					
					
				}  
			});
	}
	
	function brands_get(type,clear){
		//var loc = $('<a>', {href:window.location})[0];
		
		$('.no-product').hide();
		//console.log(divContent);
		/* alert(divContent);
		//alert(text);
		var min = $("#layered_price_slider").slider("option", "min");
		alert(min); */
		$('#ajax_product_list').hide();
		var loc1 = window.location.href;
		var brand = 'brands';
		var specify = 'specify';
		var price = 'price';
		var filter = 'filter';
		var tags = [];
		if(type == 'brand'){
			if(clear == 'clear'){
				$("input[name='brands']:checkbox").prop('checked',false);
			}
			var loc = loc1.replace(/&?brands=[^&]*/, '');
			$('input:checkbox[name=brands]:checked').each(function() {
				var id = $(this).val().match(/\d+/);
			tags.push(id);
			});
			data = tags.join(',');
			
			//alert(loc);
			//$.post('/ajax-post-url/', data);
			//var new_url = old_url.substring(0, old_url.indexOf('&'));
			if(history.pushState){
				history.pushState(null, null, loc+'&brands='+data);
			}
		}
		if(type == 'specify'){
			//alert(loc1);
			var loc = loc1.replace(/&?specify=[^&]*/, '');
			
			$('input:checkbox[name=specify]:checked').each(function() {
				// tags.push($(this).val());
				tags.push($(this).attr('specification_id')+'_'+$(this).val());
			});
			data = tags.join(',');
			
			//$.post('/ajax-post-url/', data);
			if(history.pushState){
				history.pushState(null, null, loc+'&specify='+data);
			}
			
		}
		<!-- seetha -->
		if(type == 'price'){
			//alert(type);
			var loc = loc1.replace(/&?price=[^&]*/, '');
			
			var low_price = $("#price-lower").html();
			var lows = $("#price-upper").html();
			//alert(lows);
			tags.push(low_price);
			tags.push(lows);
			//data = tags.join('&eprice=');
			data = low_price+'-'+lows;
			
			//$.post('/ajax-post-url/', data);
			if(history.pushState){
				history.pushState(null, null, loc+'&price='+data);
				
			}
			
		}
		
		if(type == 'filter'){
			//alert(loc1);
			var loc = loc1.replace(/&?filter=[^&]*/, '');
			
			tags.push($('#scrapping_sort').val());
				
				data = tags.join(',');
				
				//$.post('/ajax-post-url/', data);
				if(history.pushState){
					history.pushState(null, null, loc+'&filter='+data);
				}
		
		}
		$('#page_limit').val('12');
		$("#loadid").show();
		setTimeout(function(){ ajax_search_products(); }, 3000);
		
	}
	
	function clear_specify(id){
		//var loc = $('<a>', {href:window.location})[0];
		var loc1 = window.location.href;
		var specify = 'specify';
		var tags = [];
		$("input[name='specify"+id+"']:checkbox").prop('checked',false);
		
		var loc = loc1.replace(/&?specify=[^&]*/, '');
			
		$('input:checkbox[name=specify]:checked').each(function() {
			tags.push($(this).val());
		});
		data = tags.join(',');
		
		//$.post('/ajax-post-url/', data);
		if(history.pushState){
			history.pushState(null, null, loc+'&specify='+data);
		}
	}	
	
	$("document").ready(function () {

		var $ulVal = $("#ulVal"),
			$li = $ulVal.children(),
			$checks = $ulVal.find(':checkbox');

		$("#brand_search").keyup(function () {

			var regex = new RegExp(this.value, "gi");

			$li.hide();
			$checks.filter(function() {
				return regex.test(this.value);
			}).parent().show();
		});
	});	

	$("#searchText").on("keyup", function (e) {
        var input  = $(this).val();
        $("#ulVal input[type=checkbox]").each(function (index, element) {
            var regex = new RegExp($.trim(input), "gi");
            if($(element).val().match(regex) !== null) {
                $(element).parent().show();
            } else {
                $(element).parent().hide();
            }
        });
    });
	
	//add product compare
	
	function add_product(id,img,title,url){
		$('#checkbox_text'+id).html('Added to Compare');
		var count = $("[type='checkbox']:checked").length;
		$('#product_div').show();
		var pro_id = $('#product_ids').val();
		if(count > 3){
			$("#alert_modal")[0].click();
			$('#compare_msg').html("You can't compare more than 3 products at one time.");
			$("#checkbox_value"+id).prop('checked',false);
		}else{
			if($("#checkbox_value"+id).is(':checked')){
				if(pro_id == ''){
					$('#product_ids').val(url);
				}else{
					var total = pro_id+','+url;
					$('#product_ids').val(total);
				}
				var li = '<li id="compare_product_li'+id+'"> <div class="bg-blue"><button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="remove_product_li(\''+url+'\','+id+');"><span aria-hidden="true">&times;</span></button> <img src="'+img+'" width="100" height="120" alt="" class="img-responsive center-block"> <h5 class="clr-blu text-uppercase text-center">'+title+'</h5> <p></p></div></li>';
				$('#compare_product').append(li);
			}else{
				//alert('un'); 
				var tmp = pro_id.split(',');
				var index = tmp.indexOf(url);
				if (index !== -1) {
					tmp.splice(index, 1);
					data = tmp.join(',');
				}
				$('#product_ids').val(data);
				//alert(data);
				$("#compare_product_li"+id).remove();
			}
		}
	}
	
	//close product compare
	function close_div(type){
		if(type == 'close'){
			$('#product_ids').val('');
			$('#product_ul li').remove();
			$('#product_div').hide();
			$('input:checkbox').removeAttr('checked');
		}if(type == 'remove_all'){
			$('#product_ids').val('');
			$('#product_ul li').remove();
			$('input:checkbox').removeAttr('checked');
		}
	}
	
	//remove product li
	function remove_product_li(url,id){
		var pro_id = $('#product_ids').val();
		var tmp = pro_id.split(',');
		var index = tmp.indexOf(url);
		if (index !== -1) {
			tmp.splice(index, 1);
			data = tmp.join(',');
		}
		$('#product_ids').val(data);
		
		$('#checkbox_text'+id).html('Add to Compare');
		$("#checkbox_value"+id).prop('checked',false);
		$("#compare_product_li"+id).remove();
		
	}
	
	$('#compare_form').submit(function (event)
	{
		var count = $("[type='checkbox']:checked").length;
		if(count < 2){
			$("#alert_modal")[0].click();
			$('#compare_msg').html("Please add at least 2 products in the compare list.");
			//$("#checkbox_value"+id).prop('checked',false);
			return false;
		}else{
			var param = $('#product_ids').val();
			var newaction = '<?php echo base_url(); ?>cashback/compare_products/'+param;
			$(this).attr('action', newaction);
		}
	});
	/* $('.ui-slider-range').on('change', function() {
	  alert('dss'); // or $(this).val()
	});
	
	$(".ui-slider-handle").change(function(){
		alert('aaa');
	});
	 */
	 

</script>
<script>
var skipSlider = document.getElementById('price');
url = window.location.href;
var price = 'price';
var prices = url.match('[?&]' + price + '=([^&]+)');
if(prices)
{
	var arrayprice = prices[1];
	var pricesarr = arrayprice.split("-"); 
	
	var minpricestart = parseFloat(pricesarr[0]);
	var maxpriceend = parseFloat(pricesarr[1]);

}
else
{
	var minpricestart = <?php echo $products_max_min->minprice;?>;
	var maxpriceend = <?php echo $products_max_min->maxprice;?>;
}
var minpric = <?php echo $products_max_min->minprice;?>;
var maxprice = <?php echo $products_max_min->maxprice;?>;	

noUiSlider.create(skipSlider, {
  start: [ minpricestart, maxpriceend],
  connect: true,
  range: {
    'min':minpric,
    'max':maxprice
  }
});
var skipValues = [
  document.getElementById('price-lower'),
  document.getElementById('price-upper')
];

skipSlider.noUiSlider.on('update', function( values, handle ) {
  skipValues[handle].innerHTML = values[handle];
 
  
});
skipSlider.noUiSlider.on('change', function( ){
	brands_get('price');
});




</script>


<!-- Initialization of Plugins -->
</body>
</html>