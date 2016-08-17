<?php
function prefix()
{
	 $CI =& get_instance();
	 $CI->load->database();
	 $CI->load->model('admin_model');
	 $admin_details = $CI->admin_model->get_admindetails();
	 $site_prefix =$admin_details->site_prefix;
	 return $site_prefix;
}
function gerredirect($parent_url){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $parent_url);
	
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$a = curl_exec($ch); // $a will contain all headers
	
	 $shttpssres = curl_getinfo($ch);
	 //print_r($shttpssres);
	if($shttpssres['http_code']==200)
	{
		 $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); 
	}
	else
	{
		$url = $parent_url; 
	}
	//$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
	return $url;
}

function encode_userid($userid)
{
	$start_num = 230000;
	$site_prefix =prefix();
	$prefix =$site_prefix;
	$newuserid = $start_num+$userid;
	$updated_userid = $prefix.$newuserid;
	return $updated_userid;
}

function decode_userid($encodeid)//CSKRT230001
{
	$start_num = 230000;
	$site_prefix =prefix();
	$descd = explode($site_prefix,$encodeid);
	$userid = $descd[1]-$start_num;
	return $userid;
}

function insep_encode($value){
	$skey= "SuPerEncKey2010";
	if(!$value){return false;}
	 $text = $value;
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
	return trim(safe_b64encode($text));
}

function insep_decode($value){
	$skey= "SuPerEncKey2010";
	if(!$value){return false;}
	$crypttext = safe_b64decode($value);
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
	return trim($crypttext);
}

 function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

	function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
	
	
	function remove_space($upload_file)
	{
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $upload_file);
		   $newname =  str_replace(".","_",$withoutExt);
		   $extensionss = pathinfo($upload_file, PATHINFO_EXTENSION);
		   $upload_file = $newname.".".$extensionss;        
		 return  $upload_file = preg_replace('/[^A-Za-z0-9\.\']/', '_', $upload_file);
	}
	
	function format_filename($filename){
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$newname = str_replace(".","_",$withoutExt);
		$extensionss = pathinfo($filename, PATHINFO_EXTENSION);
		$filename = $newname.".".$extensionss;
		$filename = preg_replace('/[^A-Za-z0-9\.\']/', '_', $filename);
		return $filename;
	} 
		

	function compareByName($a, $b) {
	  return strcmp($a["affiliate_name"], $b["affiliate_name"]);
	}  
?>