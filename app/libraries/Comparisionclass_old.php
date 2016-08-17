<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comparisionclass
{
	public function get_price_from_store($producturl,$beginning_tag,$ending_tag)
	{
		//echo $producturl;
		error_reporting(0);
			/* start tag string manipulation begin here */
			$str_replece1 = str_replace("<p>","", $beginning_tag);
			$str_replece2 = str_replace("</p>","", $str_replece1);	
			$str_replece3 = str_replace("&lt;","<",$str_replece2); 
			$str_replece4 = str_replace("&gt;",">",$str_replece3);
			$str_replece4 = str_replace("&nbsp;"," ",$str_replece4);
			$tag_to_start = str_replace("&quot;",'"',$str_replece4);
			$tag_to_start = str_replace("&#39;","'",$tag_to_start);
			
			/* start tag string manipulation end here */
			
			/* end tag string manipulation begin here */
			$str_replece5 = str_replace("<p>","", $ending_tag);
			$str_replece6 = str_replace("</p>","", $str_replece5);
			$str_replace7 = str_replace("&gt;",">",$str_replece6);	
			$str_replece8 = str_replace("&lt;","'<\'",$str_replace7);
			$tag_to_end = str_replace("'","",$str_replece8); 
			/* end tag string manipulation end here */
			
			$start_tag 	= trim($tag_to_start);				//Start Tag 
    		$end_tag   	= trim($tag_to_end);				//End tag
			$page_html = $this->get_page($producturl);

                        if(strpos($start_tag,'<span id="priceblock_saleprice" class="a-size-medium a-color-price">')!== false)
	                {
		            if(strpos($page_html,'<span class="a-size-medium a-color-price">')!== false)
		            {
			         $start_tag = '<span class="a-size-medium a-color-price">';
		            }
	                }

                      if(strpos($start_tag,'<span class="price ftl">')!== false)
	              {
		           if (strpos($page_html,'<span class="price ftl">') === false) 
		           {
			      $start_tag = '<span class="price">';
		           }
	              }
			$regex = "/$start_tag(.*?)$end_tag/s";
			preg_match_all($regex, $page_html, $price);
			/*print_r($price);
			exit;*/
			$countpric = count($price[0]);
			if($countpric>1)
			{
				$price[0][0]= $price[0][1];
			}
		
			if(!empty($price[0][0])) {
				$datas1 = $price[0][0];
				$values = $price[0][0];
				$contentq = preg_replace('/<span[^>]+\><\/span>/s','',$values);
				$content  =  preg_replace('/<span[^>]+\>.*?<\/span>/s','',$contentq);
				$replace1 = trim(str_replace('&#8377;',"", $content));
				$replace2 = trim(str_replace('Rs.',"", $content));
				$replace3 = trim(str_replace(',',"", $replace2));
				$prices = $this->getpricefun($replace3);
				if(intval($prices == 0))
				{
					$prices = $this->getpricefun($values);
				}
				/*echo "ssss";
				echo $prices;	
				exit;	*/
			}
		
			if(intval($price[0][0] == 0) && count($price[0]) == 5 || count($price[0]) == 4 || count($price[0]) == 6) 			//shoppersstop	
			{		
				$dps1 =   min(array_filter($price[0]));
				if(strip_tags($dps1)!=''){$datat1 = $dps1;}else{$datat1 = array_pop($price[0]);	}
				$datat1 = filter_var($datat1,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
				$datat2 = trim(strip_tags(str_replace("R", "", $datat1)));
				$datat3 = trim(strip_tags(str_replace(",", "", $datat2)));
				$datat4 = trim(strip_tags(str_replace("s.", "", $datat3)));
				$datat5 = trim(strip_tags(str_replace(":", "", $datat4)));
				$datat6 = trim(strip_tags(str_replace("Price", "", $datat5)));
				$datat7 = trim(strip_tags(str_replace("Selling", "", $datat6)));
				$prices = number_format((float)$datat7, 2, '.', '');
			}
				
		
			if(intval($prices == 0) || $price[0][0]=='')
			{	
				//if($prices == 0.00) {
				if($end_tag == "<\/span>") {
					$e_tag += "</div>";
				}
		
				if($end_tag == "<\/div>") {
					$e_tag += "</span>";
				}
				$regex = "/$start_tag(.*?)$$etag/s";
				preg_match_all($regex, $page_html, $price);
				
				
				$separate_values = strip_tags($price[0][0]);
				
				preg_match_all('/[0-9_.,]+|:|,|/', $separate_values, $separate);
				//print '<pre>'; print_r ($separate_values); print '</pre>';
				$filteredarray = array_values(array_filter($separate[0]));
				if(strpos($start_tag,'saleprice') !== false && count($filteredarray)<1)
				{
					$start_tag = str_replace("saleprice", "dealprice", $start_tag);	
					$regex = "/$start_tag(.*?)$$etag/s";
					preg_match_all($regex, $page_html, $price);		
					$separate_values = strip_tags($price[0][0]);
					preg_match_all('/[0-9_.,]+|:|,|/', $separate_values, $separate);
					//print '<pre>'; print_r ($separate_values); print '</pre>';
					$filteredarray = array_values(array_filter($separate[0]));	
				}
				
				/*print '<pre>'; print_r ($filteredarray); print '</pre>';
				exit;*/
	
				if($filteredarray[0] == 1840 && $filteredarray[1] == 8377)
				{
					$dataz = $filteredarray[2];
				}
				elseif($filteredarray[0] == '.' && $filteredarray[2] == '.' && $filteredarray[4] == '.')   //homeshop18
				{
					$dataz = $filteredarray[1];
				}
				elseif($filteredarray[0] == '.' && $filteredarray[2] == '.' && $filteredarray[4] == ',')   //fashionara
				{
					$dataz = $filteredarray[3];
				}
				elseif($filteredarray[0] == 8377 || $filteredarray[0] == '.' )
				{
					$dataz = $filteredarray[1];
				}
				else 
				{
					$dataz = preg_replace( "/^\.+|\.+$/", "", $filteredarray[0]);
				}
				$dataz1 = trim(strip_tags(str_replace(",", "", $dataz)));
				$prices = number_format((float)$dataz1, 2, '.', '');
			}

			return $prices;
	}
	
	public function get_page($url)
	{               $curl = curl_init($url);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10; labnol;) ctrlq.org");
			curl_setopt($curl, CURLOPT_FAILONERROR, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$html = curl_exec($curl);
			curl_close($curl);
			return $html;
	}
	
	public function getpricefun($getbval)
	{
        $str = preg_replace('~<p[^>]*>.*?</p>~s', '', $getbval, 1);
		$datas1 = filter_var($str,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		if($datas1){$datas1 = $getbval;$datas1 = filter_var($datas1,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);}
		//echo $datas1;
		//$datafinal = preg_replace("/[^0-9,.]/", "", $datas1);
        $datas2 = trim(strip_tags(str_replace("R", "", $datas1)));
        $datas3 = trim(strip_tags(str_replace(",", "", $datas2)));
        $datas4 = trim(strip_tags(str_replace("s.", "", $datas3)));
        $datas5 = trim(strip_tags(str_replace(":", "", $datas4)));
        $datas6 = trim(strip_tags(str_replace("Price", "", $datas5)));
        $datas7 = trim(strip_tags(str_replace("Selling", "", $datas6)));
        $datas8 = trim(strip_tags(str_replace("Off", "", $datas7)));
        $datas9 = trim(strip_tags(str_replace("In stock", "", $datas8))); 
        $datas10 = trim(strip_tags(str_replace("`", "", $datas9)));
        $datas11 = trim(strip_tags(str_replace("1840", "", $datas10)));
		$datas11 = trim(strip_tags(str_replace("IN ", "", $datas11)));	
		$datas11 = trim(str_replace('&#8377;',"", $datas11));
		/*$datas11 = filter_var($datas11, FILTER_SANITIZE_NUMBER_INT);
		if($datas11==""){$datas11 = 0;}		*/
		$prices = number_format((float)$datas11, 2, '.', '');
		if($prices=="0.00" && $datas11!="" && (strpos($datas11, '%')=== false)){$datas11 = filter_var($datas11, FILTER_SANITIZE_NUMBER_INT);$prices = 0;$prices = number_format((float)$datas11, 2, '.', '');}
        return $prices;
	}
	
	
	
}
?>