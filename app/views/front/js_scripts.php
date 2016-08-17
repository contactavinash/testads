<?php  $search_name =$this->front_model->search_name();
$getadmindetails = $this->front_model->getadmindetails(); 
$logo = $getadmindetails[0]->site_logo;
?>
<!--
<script type="text/javascript">
//<![CDATA[
    var searchForm = new Varien.searchForm('search_mini_form', 'search', 'Search ...');
    searchForm.initAutocomplete('', 'search_autocomplete');
    jQuery('#search_mini_form .ddslick').ddslick({
        width: 160,
        onSelected: function (opt) {
            jQuery('#search_mini_form #catsearch').val(opt.selectedData.value)
        }
    });
//]]>
</script> -->

<style>

.ui-autocomplete {
    font-weight: normal !important;
    height: 242px !important;
    overflow-x: hidden !important;
    overflow-y: auto !important;
    padding: 10px;
    width:30% !important;
}

</style>

<?php
					$redirect_urlstring =  uri_string();
					if($redirect_urlstring=="")
					{
					  $redirect_urlstring = 'index';
					}
					$redirect_endcede = insep_encode($redirect_urlstring);
				?>
                
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button aria-label="Close" id="tri_one" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        
        	<div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                    	<img class="img-center" src="<?php echo base_url()."uploads/adminpro/".$logo;?>" alt="logo">
                    </div>
                    </div>
                    
                    <p class="text-center padding-top-10 mar-top20">Don't have an account? <a href="<?php echo base_url(); ?>register">Sign Up</a></p>
                   <!--  <p class="text-center padding-top-10 mar-top20" style="Color:red;">If you want cashback login here</p> -->

                    <p style="Color:red;" class="text-center padding-top-10 mar-top20">If you want cashback login here</p>
                    
                    
                    <div class="row">
                                    <div class="center-block ftn padding-top-20">
                                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center>
                    <a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div>
                    
                    
                    <br>
                    
                    
                    <div class="row">
                    			<center><span id="userstatus_ss" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                  <?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'login_form_Without','id'=>'login_form_Without','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login_Without();');				
				echo form_open('chk_invalid',$attribute);
				
			?>
			<?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
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
            
                      <div class="form-group">
                        <input type="email" placeholder="Email Address" autocomplete="off" name="email" class="form-control" title="Email Address" required id="email">
                      </div>
                      <div class="form-group">
                      <input type="password" title="Password" placeholder="Password"  autocomplete="off"  required id="pass" class="form-control validate-password" name="pwd">

                      </div>
                      
                      <div class="row">
                      <!--<div class="col-md-8 col-sm-8">
                       <div class="check-b">
                      <input type="checkbox" name="cc" id="c1">
                    <label for="c1"><span></span>Remember Me</label>
                     </div>
                     </div>-->
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                     <input type="hidden" name="signin" value="signin" />
                     <input type="hidden" name="set_url" id="gt_url">
                    <input type="submit" class="btn btn-danger bor-rad-0" name="signin" title="Login" id="signin" value="Login">


</center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>
                     <div class="row">
                    <div class="col-md-12">
                     <center> 
					 <a href="" id="st_url" target="_blank" class="btn btn-success bor-rad-0">Else click without cashback</a>
					 </center></div></div>
                    
                    <?php			
			//end form
			echo form_close();
			?>
                    </div>
                    </div>
                    
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="myModal11" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        
        	<div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                    	<img class="img-center" src="<?php echo base_url()."uploads/adminpro/".$logo;?>" alt="logo" style="height:50px;width:285px;align:center;">
                    </div>
                    </div>
                    
                    <p class="text-center padding-top-10 mar-top20">Don't have an account? <a href="<?php echo base_url(); ?>register">Sign Up</a></p>
                   
                   <?php 
                      $uri_seg = $this->uri->segment(1);
                      if($uri_seg=='salable_coupons' || $uri_seg=='')
                      {
                      }
                      else{
                     ?>
                    <p style="Color:red;" class="text-center padding-top-10 mar-top20">
                    If you want cashback login here</p>
                    
                    <?php } ?>
                    <div class="row">
                                    <div class="center-block ftn padding-top-20">
                                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div>
                    
                    
                    <br>
                    
                    
                    <div class="row">
                    			<center><span id="userstatus_ss1" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                  <?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'login_form_Without','id'=>'login_form_Without1','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login_Without1();');				
				echo form_open('chk_invalid',$attribute);
				
			?>
			<?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
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
            
                      <div class="form-group">
                        <input type="email" placeholder="Email Address" name="email" class="form-control" title="Email Address" required id="email">
                      </div>
                      <div class="form-group">
                      <input type="password" title="Password" placeholder="Password" required id="pass" class="form-control validate-password" name="pwd">

                      </div>
                      
                      <div class="row">
                      <!--<div class="col-md-8 col-sm-8">
                       <div class="check-b">
                      <input type="checkbox" name="cc" id="c1">
                    <label for="c1"><span></span>Remember Me</label>
                     </div>
                     </div>-->
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                     <input type="hidden" name="signin" value="signin" />
					  
                    <input type="submit" class="btn btn-danger bor-rad-0" name="signin1" title="Login" id="signin1"  value="Login">


</center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>
					  <div class="row">
                    </div>
					

                    
                    
                    <?php			
			//end form
			echo form_close();
			?>
                    </div>
                    </div>
                    
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>






<!-- offline login -->

<div class="modal fade" id="myModal12" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        
        	<div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                    	<img class="img-center" src="<?php echo base_url()."uploads/adminpro/".$logo;?>" alt="logo">
                    </div>
                    </div>
                    
                    <p class="text-center padding-top-10 mar-top20">Don't have an account? <a href="<?php echo base_url(); ?>offline_register">Sign Up</a></p>

                 
                    
                    
                    <!-- <div class="row">
                                    <div class="center-block ftn padding-top-20">
                                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>

                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div> -->
                    
                    
                    <br>
                    
                    
                    <div class="row">
                    			<center><span id="offline_userstatus_ss" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                  <?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'offline_login_form_Without','id'=>'offline_login_form_Without','method'=>'post','class'=>'j-forms','onSubmit'=>'return offline_setupajax_login_Without();');				
				echo form_open('offline_chk_invalid',$attribute);
				
			?>
			<?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
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
            
                      <div class="form-group">
                        <input type="email" placeholder="Email Address" name="email" class="form-control" title="Email Address" required id="email">
                      </div>
                      <div class="form-group">
                      <input type="password" title="Password" placeholder="Password" required minLength="6" id="pass" class="form-control validate-password" name="pwd">

                      </div>
                      
                      <div class="row">
                      <!--<div class="col-md-8 col-sm-8">
                       <div class="check-b">
                      <input type="checkbox" name="cc" id="c1">
                    <label for="c1"><span></span>Remember Me</label>
                     </div>
                     </div>-->
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>offline_forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                     <input type="hidden" name="signin" value="signin" />
                    <input type="submit" class="btn btn-danger bor-rad-0" name="signin" title="Login" id="signin" value="Login">


</center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>
                    
                    
                    <?php			
			//end form
			echo form_close();
			?>
                    </div>
                    </div>
                    
                    
                    
                    </div>
        
      </div>
      
    </div>
  </div>
</div>

<!-- offline login -->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<script src="<?php echo base_url(); ?>front/js/jquery.min.1.11.3.js"></script> 
<script>
$("#menu_inner").hover(function(){
	//alert('mm');
    $('.flyout').removeClass('hiddenf');
},function(){
    //$('.flyout').addClass('hidden');
});

/* $("#vertical").hover(function(){
	//alert('mm');
    $('.flyout').removeClass('hiddenf');
},function(){
    $('.flyout').addClass('hiddenf');
}); */
$('.more_off_coupon').hover(function(){
	$('#'+$(this).attr('custom')).removeClass('hiddenf_more');
	},function(){
   $('#'+$(this).attr('custom')).addClass('hiddenf_more');
});
$('.more_online').hover(function(){
	$('#'+$(this).attr('custom')).removeClass('hiddenf_more');
	},function(){
   $('#'+$(this).attr('custom')).addClass('hiddenf_more');
});

function get_url(url)
{
	//alert(url);
	if(url!="")
	{
		$('#st_url').attr('href',url);
		$('#gt_url').val(url);
	}
	else
	{
		
		/*<?php $redirect_urlset =  base_url(uri_string()); ?>
		$('#st_url').attr('href','<?php echo $redirect_urlset; ?>');*/
		location.reload();
		
	}
	}

</script>
<script type="text/javascript">
	 $("#music").on('click', function(event) {
            $("#musicinfo").show();
        });
		$(document).ready(function(){
			$(".my_class li").on('click', function(event) {
				alert('aaaa');
			}); 
		});
		
</script>
<script src="<?php echo base_url(); ?>front/js/bootstrap.min.js"></script> 
<script type="text/javascript">
//<![CDATA[
var VMEGAMENU_POPUP_EFFECT = 2;


$(document).ready(function(){
	$(".my_class li").on('click', function(event) {
		alert('aaaa');
	}); 
    $("#pt_menu_link ul li").each(function(){
        var url = document.URL;
        $("#pt_menu_link ul li a").removeClass("act");
        $('#pt_menu_link ul li a[href="'+url+'"]').addClass('act');
    }); 
        
    $('.pt_menu').hover(function(){
        if(VMEGAMENU_POPUP_EFFECT == 0) $(this).find('.popup').stop(true,true).slideDown('slow');
        if(VMEGAMENU_POPUP_EFFECT == 1) $(this).find('.popup').stop(true,true).fadeIn('slow');
        if(VMEGAMENU_POPUP_EFFECT == 2) $(this).find('.popup').stop(true,true).show('slow');
    },function(){
        if(VMEGAMENU_POPUP_EFFECT == 0) $(this).find('.popup').stop(true,true).slideUp('fast');
        if(VMEGAMENU_POPUP_EFFECT == 1) $(this).find('.popup').stop(true,true).fadeOut('fast');
        if(VMEGAMENU_POPUP_EFFECT == 2) $(this).find('.popup').stop(true,true).hide('fast');
    })
});
//]]>
</script> 
<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function(){
			
			$('#pt_vmegamenu .category-vmega_toggle .more-wrap').click(function(){
				$('#pt_vmegamenu .category-vmega_toggle .extra_menu').slideToggle();
				$(".extra_menu").css("overflow","visible");
				if($("#pt_vmegamenu .category-vmega_toggle .more-view").hasClass('open'))
				{
					$("#pt_vmegamenu .category-vmega_toggle .more-view").removeClass('open');
					$("#pt_vmegamenu .category-vmega_toggle .more-view").html('<em class="more-categories"> More Categories</em>');
				}
				else
				{
					$("#pt_vmegamenu .category-vmega_toggle .more-view").addClass('open');
					$("#pt_vmegamenu .category-vmega_toggle .more-view").html('<em class="closed-menu">Close Menu</em>');
				}
			});
		});
		//]]>
</script> 
<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function(){
			$(".navleft-container").hide();
			$(".title-categories").click(function(){
				$(".navleft-container").toggle();
			});
			
			$(".cms-index-index .navleft-container").show();
			$(".cms-index-index .title-categories").click(function(){
				$(".navleft-container").show();
			});
		});
		
		
		//]]>
</script>
<script src="<?php echo base_url(); ?>front/js/jquery-ui.min.js"></script> 
<script type="text/javascript">
//<![CDATA[
var CUSTOMMENU_POPUP_EFFECT = 0;
var CUSTOMMENU_POPUP_TOP_OFFSET = 60;

//]]>
$(document).ready(function(){
	if($('body').hasClass("cms-index-index"))
	{
		$("#pt_menu_homema_stepre_miscellaneous1_home").addClass('act');
	}
});
</script>

<script>
$(document).ready(function() {
    $('#Carousel').carousel({
        interval: 5000
    })
	$('.cls_input_compare').val('');
	for(var n=1;n<=4;n++){
(function($){
 // console.log(n);
  var $project = $('#proid'+n);
//var $project = $($project).attr('id'));
  // $project = $('#'+id);
  var r=1;
  $project.autocomplete({
    minLength: 0,
	open: function () {
        $(this).data("uiAutocomplete").menu.element.addClass("my_class");
		//$(this).data("uiAutocomplete").menu.element
		
		//alert('tyhitupuy');
    },
    source: function (request, response) {
		var cateid = $('#catesupid').val();
		var catesellevel = '<?php echo $cate_level_id;?>';
		if($.trim(request.term))
		{
        $.ajax({
            url: "<?php echo base_url();?>cashback/searchproducts",
            type: "POST",
            dataType: "json",
            data:
            {
                term: $.trim(request.term),
				cate_id: cateid,
				catpos: catesellevel
            },
            success: function (data)
            {
				//console.log(data);
                response(data);
            }
        });
		}
	},
	 change: function( event, ui ) {
		 console.log('test');
            
      },
    focus: function( event, ui ) {
		// console.log('har');
      //$project.val( ui.item.product_name );
	  
	  // $('.my_class li').on('click', function(event) {
				// alert('ooo');
			 // });
      return false;
    }
  });
  $project.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    //console.log(ul);
    var $li = $('<li>'),
        $img = $('<img>');

	var imgsr= '<?php echo base_url();?>uploads/products/' + item.product_image;
	var size_image = getImageSizeInBytes(imgsr);
	if(size_image==0)
	{
		var imgsr = '<?php echo base_url();?>front/images/no_product.png';
	}
    $img.attr({
      src: imgsr,
      alt: item.product_name,
	  height: '50px',
	  width:'25px'
    });
	//alert('pppppppp');
    $li.attr('data-title', item.product_name.substr(0, 10));
	$li.attr('id', 'compareproducttd_'+item.product_id);
	$li.attr('data-link_set_url', item.product_url);
	$li.attr('data-link_url', '<?php echo base_url();?>cashback/product_details/'+item.product_url);
	$li.attr('data-id_product', item.product_id);	
	$li.attr('data-price', '<?php echo DEFAULT_CURRENCY;?> '+item.min_price);
	$li.attr('data-id_product', item.product_id);
	$li.attr('data-img_url', imgsr);
	$li.append('<div class="popupblock">');
    $li.find('.popupblock').append('<div class="thumbnailicon">');
    $li.find('.thumbnailicon').append($img);
    $li.find('.popupblock').append('<div class="popupproname"><div class="brandtitle ellipsis">'+item.product_name+'</div><div class="priceauto">'+item.min_price+'</div></div>');
	
	if(r==1)
	{
		var setcompids = $('#setcompids').val();
		if(setcompids!=1)
		{
			setTimeout(function(){		
			$('#setcompids').val('1');
				$(document).on("click", ".my_class li", d);	
			},30); 
		}
	}
	r++;
    return $li.appendTo(ul);
  };


})(jQuery);

}

	
});


 //$('body').html($('body').html().replace(/{REPLACETEXT}/i, "More important text"));
 var loaded = false;
  $(document).ready(function() {
	  
        // $(document).on("click", ".footertab", a);
        // $(document).on("click", ".compare li", f);
        // $(document).on("click", ".popupclose", l);
        // $(document).on("focusin", ".comparesuggest", c);
        // $(document).on("keyup", ".comparesuggest", h);
        // $(document).on("click", ".popupblock ul li", p);
		 if(!loaded){
               $(document).on("click", ".compareicon", d);
                loaded = true
               }
        
        // $(document).on("click", ".comparedclose", m);
        // $(document).on("click", ".removeall", g);
        // $(document).on("click", ".comparenow", y);
        // $.cookie.json = true
    });

		 
		// $(".occupiedclose").on('click', function(event) {
				// console.log($(this));
		// });
		
		
function d(e)
{
	console.log('eee');
	$('#musicinfo').show();
	if($(".empty").size()>0)
	{
		
		var t = $(this);
		var proid = t.data("id_product");
		var title = t.data("title");
		var price = t.data("price");
		var link_url = t.data("link_url");
		var link_set_url = t.data("link_set_url");
		var img_url = t.data("img_url");
		var numItems = $('#product_comp_'+proid).length;
		//alert(numItems);
		$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>cashback/comparision_products',
		data:"product_id="+proid+"&title="+title+"&price="+price+"&link_url="+link_url+"&link_set_url="+link_set_url+"&img_url="+img_url,
		success:function(msg){
			
			}
		
	});
		if(numItems>0)
		{
			alert('Already Added.');
			return false;
		}
		$('.empty').eq(0).attr('id', 'product_comp_'+proid);
		$('.empty').eq(0).removeClass('empty');
		$('#product_comp_'+proid).find('input').hide();
		$('#product_comp_'+proid).find('.product_comp').html('<div class="cls_inbox_close"> <a onclick="closedivsingle('+proid+')" id="'+proid+'"  href="javascript:void(0);" class="occupiedclose occupcls_'+proid+'" > <i class="fa fa-close"></i> </a> </div><div class="left-block occupied" style="min-height: 63px;"><a title="'+title+'" href="'+link_url+'" class="bigpic_21_tabcategory product_image"><input type="hidden" class="sortenurl" value="'+link_set_url+'"><img width="35" height="auto" src="'+img_url+'" class="img-responsive center-block"></a></div><p class="occupied"><a href="'+link_url+'">'+title+'</a></p><div class="rate occupied"> '+price+' </div> ');
		$("#compareproducttd_"+proid).hide();
		$("#removecompare_"+proid).show();
		return false;
		
	}else{
		alert('You can not add more then 4 product to compare');
	}

	
	
	//console.log($(this));
	// $("#navSub").children().hide(); 
	
	return false;
}
function closedivsingle(prosid)
{
	// alert(prosid);
	$('#product_comp_'+prosid).attr('class', 'cls_img_bottom blockng empty');
	$('#product_comp_'+prosid).find('.product_comp').html('');
	$('#product_comp_'+prosid).find('input').val('');
	$('#product_comp_'+prosid).find('input').show();
	$('#product_comp_'+prosid).removeAttr('id');
	$('#removecompare_'+prosid).hide();
	$('#compareproducttd_'+prosid).show();
}



function overallhide()
{
	$('#musicinfo').hide();
}

$("#removeall").on('click', function(event) {
	$('.product_comp').html('');
	$('.cls_input_compare').val('');
	$('.cls_input_compare').show();
	$('.blockng').attr('class', 'cls_img_bottom blockng empty');
	$('.blockng').removeAttr('id');
	$('.compare_remove').hide();
	$('.compareicon').show();	
}); 


$("#compareall").on('click', function(event) {
	var textboxvalues = $('.sortenurl').map(function(){
    return $.trim(this.value);
	}).get().join(',');
	var arraytextboxvals = textboxvalues.split(",");
	if(arraytextboxvals.length < 2){
		alert('Please select at least 2 unique products for comparison.');
		return false;
	}
	var buildurl = '<?php echo base_url();?>cashback/compare_products/'+textboxvalues;
	window.location.href=buildurl;
}); 



 function getImageSizeInBytes(imgURL) {
    var request = new XMLHttpRequest();
    request.open("HEAD", imgURL, false);
    request.send(null);
    var headerText = request.getAllResponseHeaders();
    var re = /Content\-Length\s*:\s*(\d+)/i;
    re.exec(headerText);
    return parseInt(RegExp.$1);
}

</script>


		
		





<!-- seetha -->
<script type="text/javascript">
//<![CDATA[
    jQuery(document).ready(function($) {     
       
      $('#block-categories-19088595111446117677 .navslider .prev').on('click', function(e){
         e.preventDefault();
         $('#block-categories-19088595111446117677 .wrap_item').trigger('owl.prev');
      });
      $('#block-categories-19088595111446117677 .navslider .next').on('click', function(e){
         e.preventDefault();
         $('#block-categories-19088595111446117677 .wrap_item').trigger('owl.next');
      });
    });
//]]>
</script> 

<script type="text/javascript">

$(document).ready(function() {

	$(".tab2_category").hide();
	$(".tab2_category:first").show(); 
	$(".tab2_title").hide();
	$(".tab2_title:first").show();
	$("ul.tab2_cates li").click(function() {
		$("ul.tab2_cates li").removeClass("active");
		$(this).addClass("active");
		$(".tab2_category").hide();
		$(".tab2_title").hide();
		$(".tab2_category").removeClass("animate1 wiggle");
		var activeTab = $(this).attr("rel");
		var tab2_title = $(this).attr("data-title");				
		$("#"+activeTab) .addClass("animate1 wiggle");
		$("#"+activeTab).fadeIn(); 
		$("#"+tab2_title).fadeIn(); 
	});
});

</script> 

<script type="text/javascript">

$(document).ready(function() {

	$(".tab_category").hide();
	$(".tab_category:first").show();
		$(".tab_title").hide();
	$(".tab_title:first").show(); 

	$("ul.tab_cates li").click(function() {
		$("ul.tab_cates li").removeClass("active");
		$(this).addClass("active");
		$(".tab_category").hide();
		$(".tab_title").hide();
		$(".tab_category").removeClass("animate1 wiggle");
		var activeTab = $(this).attr("rel"); 
		var tab_title = $(this).attr("data-title"); 
		$("#"+activeTab) .addClass("animate1 wiggle");
		$("#"+activeTab).fadeIn(); 
		$("#"+tab_title).fadeIn(); 
	});
});

</script> 

<script src="<?php echo base_url();?>front/js/jquery-ui.js"></script>

<script>
           $('#myModal11').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
</script>

<script>

var availableTagss2 =<?php echo $search_name;?>;
	 jQuery( "#search_header1" ).autocomplete({
	
       source: availableTagss2,		
       select: function (event, ui) 
       {
			  autoFocus: true;
		      location.href = ui.item.the_link;

        $("#product_id").val(ui.item.product_id); 

       },

  
   }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        var msg = '<div style="margin:8px;"><span><i class="fa fa-envelope-oed"></i><strong>'+item.label+'</strong></span></div>'; 		 
        return $( "<li>" )		
       .append( msg )	   
       .appendTo( ul );

};
function runcheck_1(url)
{
	window.location.href="<?php echo base_url();?>"+url;
}    

function addfav(id){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>cashback/add_favorite',
		dataType:"json",
		data:"product_id="+id,
		success:function(msg){
			if(msg==1){
				$('.fav_'+id).html('<span title="Added to Favorites"><i style="color:#FF0000;"float: right; padding: 12px;" class="fa fa-heart"></i></span>');
			}
		}
	});
}
function setupajax_login_Without()
{
	var datas = $('#login_form_Without').serialize();
	//alert(datas);
	 jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cashback/logincheck",
				data: datas,
				cache: false,
				success: function(result)
				{
					if(result!=1)
					{
						$('#userstatus_ss').html(result);
						return false;
					}
					else
					{
						<?php $redirect_urlset =  base_url(uri_string());?>
						var redirect_url=$('#gt_url').val();
						 
						if(redirect_url!="")
						{
							location.reload();
							window.open(redirect_url,'_blank');
							
						}
						else
						{ 
						window.location.href = '<?php echo $redirect_urlset; ?>';
						return false;
						 } 
					}							
				}
			});
						
	return false;
}
function setupajax_login_Without1()
{
	var datas = $('#login_form_Without1').serialize();
	//alert(datas);
	 jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cashback/logincheck",
				data: datas,
				cache: false,
				success: function(result)
				{
					
					if(result!=1)
					{
						$('#userstatus_ss1').html(result);
						return false;
					}
					else
					{
						<?php $redirect_urlset =  base_url(uri_string());?>
						var redirect_url=$('#gt_url').val();
						 
						if(redirect_url!="")
						{
							location.reload();
							window.open(redirect_url,'_blank');
							
						}
						else
						{ 
						window.location.href = '<?php echo $redirect_urlset; ?>';
						return false;
						 } 
					}							
				}
			});
						
	return false;
}


$("#headersearch").on('click', function(event) {
		var searchkey = $('#search_header1').val();
		
		var cat=$.trim($('#get_cate_id').text());
		
		if(cat=='Categories')
		{
			
			cat='all';
		}
		
		window.location.href= '<?php echo base_url()?>/products/'+searchkey+'_brands/'+cat+'_0#brands='+searchkey+'#'+cat+'_0';
		return false;
	}); 
	
	$('#st_url').click(function(){
		
    $('#tri_one').trigger('click');
		/*$('#myModal').modal('hide');
     $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();*/
	});
	
	$('#pricealert').click(function(){
		
    $('#price_close').trigger('click');
		
	});
	
	pricealert
	function offline_setupajax_login_Without()
{
	
	var datas = $('#offline_login_form_Without').serialize();
	//alert(datas);
	 jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cashback/offline_logincheck",
				data: datas,
				cache: false,
				success: function(result)
				{
					if(result!=1)
					{
						$('#offline_userstatus_ss').html(result);
						return false;
					}
					else
					{
						<?php //$redirect_urlset =  base_url(uri_string());?>
						window.location.href = '<?php echo base_url(); ?>view_stores';
						return false;
					}							
				}
			});
						
	return false;
}
</script>

<script>
$('.nav li').click(function()
                   {
                     $('.alert').remove();
                   });
				   
	function get_cate_id(id)
  {
	  $('#get_cate_id').text(id);
  }
</script>