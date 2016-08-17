<?php
//http%3A%2F%2Fwww_flipkart_com%2Fall%2Fpr%3Fsid=all&affExtParam2=102aab443c0f6bdeda53b5d5ce0945&affid=infocashi&affExtParam1=CSKRT230001

$redirect_url = $coupon->offer_page;
$available_for_provider = $this->front_model->available_for_provider($affid);
if($available_for_provider)
{
	$getredirect =  gerredirect($redirect_url);
	/*echo $getredirect;
	exit;*/
	$parse = parse_url($getredirect);
	$hostname = $parse['host'];
	$store_url = $store_details->site_url;
	$parse_store = parse_url($store_url);
	$store_hostname = $parse_store['host'];
	$affparam = $available_for_provider->affiliate_param;
	$afftraking = $available_for_provider->affiliate_traking_param;
		if($hostname==$store_hostname)
		{
			$affparamss = explode("=",$affparam);
			$new_param = $affparamss[0];
			$new_param_val = $affparamss[1];
				if (strpos($getredirect,$new_param) !== false) // check param in redirect url and if found means need to replace the values			
				{
					//$url = 'http://www.flipkart.com/all/pr?sid=all&affid=vcommission&affExtParam1=2_&affExtParam2=10269644aa82a1aec79526e7c27144';
					parse_str($getredirect, $vars);
					$i=1;
					foreach($vars as $key=>$val){
					if($i==1){
					$old_key =$key; 
					$newkey = str_replace("_",".",$key);
					}
					$i++;
					}
					$vars[$newkey] = $vars[$old_key];
					unset($vars[$old_key]);
					end($vars);
					
					$last_key     = key($vars);
					$last_value   = array_pop($vars);
					$vars          = array_merge(array($last_key => $last_value), $vars);


					//parse_str($getredirect, $vars);	
					//parse_str($getredirect, $vars);	
					unset($vars[$new_param]);
					unset($vars[$afftraking]);	
					 $vars[$new_param] = $new_param_val; // Replace item_id's value
					 $updated_userid = encode_userid($user_id);
					 $vars[$afftraking] = $updated_userid; 	
					 $url=   http_build_query($vars); 
					
					$redirect_url =  rawurldecode($url);					
				}
				else //otherwise build url
				{
					$updated_userid = encode_userid($user_id);
					$query = parse_url($redirect, PHP_URL_QUERY);
						if( $query ) 
						{
							$redirect_url .= '&'.$affparam.'&'.$afftraking.'='.$updated_userid;
						}
						else 
						{
							$redirect_url .= '?'.$affparam.'&'.$afftraking.'='.$updated_userid;
						}
				}
			//find traking id and replace. if not found means create  and redirect url build
		}
		else
		{
			//create user_id dynamicully and create redirect url
			$updated_userid = encode_userid($user_id);
			 $redirect= $coupon->offer_page;
			 $tracking = $coupon->Tracking;
				$query = parse_url($redirect, PHP_URL_QUERY);
				if( $query ) 
				{
					$redirect_url .= '&'.$tracking.'='.$updated_userid;
				}
				else 
				{
					$redirect_url .= '?'.$tracking.'='.$updated_userid;
				}
		}
	
}
else
{
		$updated_userid = encode_userid($user_id);
		$redirect= $coupon->offer_page;
		$tracking = $coupon->Tracking;
		$query = parse_url($redirect, PHP_URL_QUERY);
		if( $query ) {
			$redirect_url .= '&'.$tracking.'='.$updated_userid;
		}
		else {
			$redirect_url .= '?'.$tracking.'='.$updated_userid;
		}
}

/*echo $redirect_url;
 
exit;*/



?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="refresh" content="2; url=<?php echo $redirect_url; ?>" />
<title><?php $admindetailssss = $this->front_model->getadmindetails_main(); echo $admindetailssss->site_name; ?></title>
    
<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>	

<link href="<?php echo base_url();?>front/css/hover.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->

<div id="content">
<div class="page-intro" style="margin-top: 0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pad-rht"></i><a href="<?php echo base_url();?>">Home</a></li>
                                  <li class="active">Shops</li>
                             <!--   <li class="active">Add Missing Cashback</li>-->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
    <div class="container">
      <section class="mid-sec mar40">
        
         <div class="loading-sec clearfix">
         
         <div class="row">
         
         <div class="col-md-8 col-md-offset-2 ">
         
         <div class="clearfix  mar40">
         
         <div class="row">
         
           <div class="col-md-3">
         
         <img src="<?php echo base_url();?>uploads/adminpro/<?php echo $admindetails[0]->site_logo;?>" class="img-responsive pull-left ">
         
         </div>
         
         <div class="col-md-6">
         
       <!-- <div class="spinner">
      <div class="rect1"></div>
      <div class="rect2"></div>
      <div class="rect3"></div>
      <div class="rect4"></div>
      <div class="rect5"></div>
    </div>-->
    <center>
<img src="<?php echo base_url();?>assets/img/redirect.gif">
</center>
         
         
         </div>
         
         <div class="col-md-3">
         <img src="<?php echo base_url();?>uploads/affiliates/<?php echo $store_details->affiliate_logo;?>" class="img-responsive pull-left"> 
         
         </div>
         
         </div>
         
         </div>
         
         </div>
         
         <h2 class="text-center mar-bot20">CONGRATULATIONS, NOTHING MORE TO DO!</h2>
<h4 class="text-center mar-bot20 text-capitalize">Shop normally at <?php echo $store_details->affiliate_name;?>. Your cashback will automatically
get added in your <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> account within 72 hours.</h4>

<p class="text-center">If you are not automatically re-directed, please <?php echo anchor($redirect_url,'click here');?>    </p>
         
         </div>       
         
        </section>
        
        
    </div>
  </div>
</div>
 
                
</section>


        
        
    </div>
  </div>
</div>
<footer>
  <?php
//sub footer
	$this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	

?>
</footer>

<!-- FAQ --->




<?php $this->load->view('front/js_scripts');?>



 <!-- contact page specific js starts -->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/jquery.validate.min.js"></script>       
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/gmaps.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>front/js/map/map.js"></script>

<!-- Slider --> 




<script type="text/javascript">
$(function () { $("[data-toggle='tooltip']").tooltip(); });

</script>


<script type="application/javascript">

function toggle_st(num)
{
	$('.toggle'+num).toggle('slow');
	return false;	
}
</script> 



</body>
</html>
