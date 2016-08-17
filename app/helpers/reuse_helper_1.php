<?php
function redirect_handler($coupon,$store_details,$front_model)

{

	$CI = & get_instance();  //get instance, access the CI superobject

  	$user_id = $CI->session->userdata('user_id');

    // You may need to load the model if it hasn't been pre-loaded

	$redirect_url = $coupon->offer_page;

	$affid = $store_details->affiliate_id; 

	$available_for_provider = $front_model->available_for_provider($affid);

	

	if($available_for_provider)

	{

		$getredirect =  gerredirect($redirect_url);

		$parse = parse_url($getredirect);

		

		$hostname = $parse['host'];

		$store_url = $store_details->logo_url;

		$parse_store = parse_url($store_url);

		

		if(isset($parse_store['host']))

		{

			$store_hostname = $parse_store['host'];

			$affparam = $available_for_provider->affiliate_param;

			$afftraking = $available_for_provider->affiliate_traking_param;

			

				$hostname_return = explode('.', $hostname);

				unset($hostname_return[0]);

				$hostname = implode('.',$hostname_return);

				

				$store_hostname_return = explode('.', $store_hostname);

				unset($store_hostname_return[0]);

				$store_hostname = implode('.',$store_hostname_return);

// exit;

			if($hostname==$store_hostname)

			{	

			

			

				$affparamss = explode("=",$affparam);

				 

				$new_param = $affparamss[0];

				$new_param_val = $affparamss[1];

					if (strpos($getredirect,$new_param) !== false) // check param in redirect url and if found means need to replace the values			

					{

					

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

						

						if(!$vars[$new_param]){

							$first_key = key($vars);

							unset($vars[key($vars)]);

							// $vars = array($first_key => $new_param_val) + $vars;

							$vars = array_merge(array($first_key => $new_param_val), $vars);

						} else {

							unset($vars[$new_param]);

						}

						

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

			// $redirect_url  = base_url();;

			$redirect_url  = $store_url;

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

	return $redirect_url;

}

function image_resizer($path="",$image="",$height="",$width="",$ratio=FALSE)
{
	$ci =& get_instance();
	$ci->load->library('image_lib');
	$config['image_library'] = 'gd2';
	$config['source_image'] = $path.$image;
	$config['maintain_ratio'] = $ratio;
	$config['width'] = $height;
	$config['height'] = $width;
	$config['overwrite'] = TRUE;
	$ci->image_lib->initialize($config);
	$ci->image_lib->resize();
	$ci->image_lib->clear();
}
function redirect_handler_store($redirect,$store_details,$front_model)

{

	$CI = & get_instance();  //get instance, access the CI superobject

  	$user_id = $CI->session->userdata('user_id');

    // You may need to load the model if it hasn't been pre-loaded

	$redirect_url = $redirect;

	$affid = $store_details->affiliate_id; 

	$available_for_provider = $front_model->available_for_provider($affid);

	

//	print_r($available_for_provider);

	if($available_for_provider)

	{

		$getredirect =  gerredirect($redirect_url);

		$parse = parse_url($getredirect);

		

		$hostname = $parse['host'];

		$store_url = $store_details->logo_url;

		$parse_store = parse_url($store_url);

		

		if(isset($parse_store['host']))

		{

			$store_hostname = $parse_store['host'];

			$affparam = $available_for_provider->affiliate_param;

			$afftraking = $available_for_provider->affiliate_traking_param;

			

				$hostname_return = explode('.', $hostname);

				unset($hostname_return[0]);

				$hostname = implode('.',$hostname_return);

				

				$store_hostname_return = explode('.', $store_hostname);

				unset($store_hostname_return[0]);

				$store_hostname = implode('.',$store_hostname_return);



			if($hostname==$store_hostname)

			{	

				$affparamss = explode("=",$affparam);

				 

				$new_param = $affparamss[0];

				$new_param_val = $affparamss[1];

					if (strpos($getredirect,$new_param) !== false) // check param in redirect url and if found means need to replace the values			

					{

					

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

				$redirect= $redirect;

				$store_name = $store_details->offer_name;

				$store_coupons = $front_model->get_coupons_from_store($store_name,null);

				if(count($store_coupons)!=0)

				{

					$tracking = $store_coupons[0]->Tracking;

				}

				else

				{

					$tracking = 'aff_sub';

				}

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

				$redirect= $redirect;

				$store_name = $store_details->offer_name;

				$store_coupons = $front_model->get_coupons_from_store($store_name,null);

				if(count($store_coupons)!=0)

				{

					$tracking = $store_coupons[0]->Tracking;

				}

				else

				{

					$tracking = 'aff_sub';

				}

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

				$redirect= $redirect;

				$store_name = $store_details->offer_name;

				$store_coupons = $front_model->get_coupons_from_store($store_name,null);

				if(count($store_coupons)!=0)

				{

					$tracking = $store_coupons[0]->Tracking;

				}

				else

				{

					$tracking = 'aff_sub';

				}

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

	

	return $redirect_url;

}

/*Seetha Dec 16-2015 */

function redirect_handler1($product,$store_details,$front_model)
{
	$CI = & get_instance();  //get instance, access the CI superobject
  	$user_id = $CI->session->userdata('user_id');
    // You may need to load the model if it hasn't been pre-loaded
	$redirect_url = $product->product_url;
	$affid = $store_details->affiliate_id; 
	$available_for_provider = $front_model->available_for_provider($affid);
	
	if($available_for_provider)
	{
		$getredirect =  gerredirect($redirect_url);
		$parse = parse_url($getredirect);
		
		$hostname = $parse['host'];
		$store_url = $store_details->logo_url;
		$parse_store = parse_url($store_url);
		
		if(isset($parse_store['host']))
		{
			$store_hostname = $parse_store['host'];
			$affparam = $available_for_provider->affiliate_param;
			$afftraking = $available_for_provider->affiliate_traking_param;
			
				$hostname_return = explode('.', $hostname);
				unset($hostname_return[0]);
				$hostname = implode('.',$hostname_return);
				
				$store_hostname_return = explode('.', $store_hostname);
				unset($store_hostname_return[0]);
				$store_hostname = implode('.',$store_hostname_return);
// exit;
			if($hostname==$store_hostname)
			{	
			
			
				$affparamss = explode("=",$affparam);
				 
				$new_param = $affparamss[0];
				$new_param_val = $affparamss[1];
					if (strpos($getredirect,$new_param) !== false) // check param in redirect url and if found means need to replace the values			
					{
					
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
						
						if(!$vars[$new_param]){
							$first_key = key($vars);
							unset($vars[key($vars)]);
							// $vars = array($first_key => $new_param_val) + $vars;
							$vars = array_merge(array($first_key => $new_param_val), $vars);
						} else {
							unset($vars[$new_param]);
						}
						
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
				$redirect= $product->product_url;
				$tracking = 'aff_sub';
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
			// $redirect_url  = base_url();;
			$redirect_url  = $store_url;
		}
		
	}
	else
	{	
		$updated_userid = encode_userid($user_id);
		$redirect= $product->product_url;
		$tracking = 'aff_sub';
		$query = parse_url($redirect, PHP_URL_QUERY);
		if( $query ) {	
			$redirect_url .= '&'.$tracking.'='.$updated_userid;
		}
		else {	
			$redirect_url .= '?'.$tracking.'='.$updated_userid;
		}
	}
	return $redirect_url;
}
  

function redirect_handler_store1($redirect,$store_details,$front_model)
{
	$CI = & get_instance();  //get instance, access the CI superobject
  	$user_id = $CI->session->userdata('user_id');
    // You may need to load the model if it hasn't been pre-loaded
	$redirect_url = $redirect;
	$affid = $store_details->affiliate_id; 
	$available_for_provider = $front_model->available_for_provider($affid);
	
//	print_r($available_for_provider);
	if($available_for_provider)
	{
		$getredirect =  gerredirect($redirect_url);
		$parse = parse_url($getredirect);
		
		$hostname = $parse['host'];
		$store_url = $store_details->logo_url;
		$parse_store = parse_url($store_url);
		
		if(isset($parse_store['host']))
		{
			$store_hostname = $parse_store['host'];
			$affparam = $available_for_provider->affiliate_param;
			$afftraking = $available_for_provider->affiliate_traking_param;
			
				$hostname_return = explode('.', $hostname);
				unset($hostname_return[0]);
				$hostname = implode('.',$hostname_return);
				
				$store_hostname_return = explode('.', $store_hostname);
				unset($store_hostname_return[0]);
				$store_hostname = implode('.',$store_hostname_return);

			if($hostname==$store_hostname)
			{	
				$affparamss = explode("=",$affparam);
				 
				$new_param = $affparamss[0];
				$new_param_val = $affparamss[1];
					if (strpos($getredirect,$new_param) !== false) // check param in redirect url and if found means need to replace the values			
					{
					
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
				$redirect= $redirect;
				/* $store_name = $store_details->affiliate_name;
				$store_coupons = $front_model->get_coupons_from_store($store_name,null);
				if(count($store_coupons)!=0)
				{
					$tracking = $store_coupons[0]->Tracking;
				}
				else
				{ */
					$tracking = 'aff_sub';
				//}
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
				$redirect= $redirect;
				/* $store_name = $store_details->offer_name;
				$store_coupons = $front_model->get_coupons_from_store($store_name,null);
				if(count($store_coupons)!=0)
				{
					$tracking = $store_coupons[0]->Tracking;
				}
				else
				{ */
					$tracking = 'aff_sub';
				//}
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
				$redirect= $redirect;
			/* 	$store_name = $store_details->offer_name;
				$store_coupons = $front_model->get_coupons_from_store($store_name,null);
				if(count($store_coupons)!=0)
				{
					$tracking = $store_coupons[0]->Tracking;
				}
				else
				{ */
					$tracking = 'aff_sub';
				//}
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
	
	return $redirect_url;
}
/*Seetha Dec 16-2015 */ 
?>