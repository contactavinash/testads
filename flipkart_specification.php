<?php
//http://www.flipkart.com/alberts-embriodered-assam-silk-sari/p/itmebhf98psgsh2z?pid=SAREBHF9ZKCUPP7Y&al=RFA2cbhbYBFoN1R49sa2OcldugMWZuE7eGHgUTGjVrrfeHEUcEwg8rKTVeJ3I2aeUKim3LKKmTI%3D&ref=L%3A-7053260496719557662&srno=b_2&findingMethod=hp_mod
$affurlurl = 'http://www.flipkart.com/furniturekraft-metal-dining-set/p/itmeb9zqd9f9xswh?pid=DISEB9ZQTRPGCHUG&al=RFA2cbhbYBEYIgfXgN1IU8ldugMWZuE7FrnKNFONe23f5dvLRsq9AZcg1BVm793WtXe6AkJyfII%3D&ref=L%3A-3543185294490582067&srno=b_8&findingMethod=Menu';
$url = str_replace('http://dl.flipkart.com/dl','http://www.flipkart.com',$affurlurl);
$urscrap = $url;
$cookie_file_path = "cookies.tmp";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_URL, $urscrap);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
curl_setopt($ch, CURLOPT_USERAGENT,
	"Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $urscrap);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
$haveresults_set = curl_exec($ch);
// $haveresults_setn = preg_replace('#<div class="dummy-content(.*?)</div>#', ' ', $haveresults_set);
$haveresults_setn = preg_replace('/<div class="dummy-content">.*?<\/div>/s','',$haveresults_set);
$haveresults_setn = preg_replace('/<div class="fk-hidden">.*?<\/div>/s','',$haveresults_setn);
 
/*preg_match_all('/<div class="imgWrapper">(.*?)<\/div>/s', $haveresults_setn, $imagesdiv);
preg_match_all('/data-src="(.*?)"/i', $imagesdiv[1][0], $dealbodyrightarrayhred);
$imageslist =	$dealbodyrightarrayhred[1];
unset($imageslist[0]);
$imgcount = implode($imageslist);

print_r($dealbodyrightarrayhred[1]);
exit;
 

 
 preg_match_all( '/<ul class="key-specifications fk-ul-disc lpadding20 line fk-font-11 fk-fontlight">(.*?)<\/ul>/mis', $haveresults_setn, $showMoreCompany );
 echo $keyspec = rtrim(strip_tags(str_replace('</li>',',',$showMoreCompany[1][0])),',
    ');
 
 exit;*/
 
 //$haveresults_setn = preg_replace('#<div class="dummy-content">(.*?)</div>#', '', $haveresults_set);
echo "<pre>";
preg_match_all('/<div class="productSpecs specSection">(.*?)<\/div>/s',$haveresults_setn, $listpros); 
preg_match_all('/<table cellspacing="0" .*?>(.*?)<\/table>/s', $listpros[0][0], $tableslisting);
$result = array();
$result_table = array();

foreach($tableslisting[1] as $tabledetails)
{
		preg_match('/<th class="groupHead" colspan="2">(.*?)<\/th>/', $tabledetails, $tharraydetails);
		$thname = trim($tharraydetails[1]);
		preg_match_all('/<tr>(.*?)<\/tr>/s',$tabledetails, $trarraydetails);
		unset($trarraydetails[1][0]);
		foreach($trarraydetails[1] as $trdetails)
		{
			preg_match('/<td class="specsKey">(.*?)<\/td>/', $trdetails, $tddetailsarray);
			if($tddetailsarray==''||!trim($tddetailsarray[1])){continue;}
			$speckey = trim($tddetailsarray[1]);
			preg_match('/<td class="specsValue">(.*?)<\/td>/s', $trdetails, $tddetailsvaluearray);
			$specvalue = trim($tddetailsvaluearray[1]);			
			$result_table[$speckey]=$specvalue;
		}
		if(!$result_table){continue;}
		$result_table = array_filter($result_table);
		if(!$result_table){continue;}
		$result[$thname]=$result_table;
		$result_table = '';
		$trarraydetails = '';
}

print_r($result);

exit;
?>