<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Comparisionclass {
	public function get_price_from_store($producturl, $beginning_tag, $ending_tag) {
		

		

		error_reporting(0);
		/* start tag string manipulation begin here */
		if($beginning_tag)
		{
		$str_replece1 = str_replace("<p>", "", $beginning_tag);
		$str_replece2 = str_replace("</p>", "", $str_replece1);
		$str_replece3 = str_replace("&lt;", "<", $str_replece2);
		$str_replece4 = str_replace("&gt;", ">", $str_replece3);
		$str_replece4 = str_replace("&nbsp;", " ", $str_replece4);
		$tag_to_start = str_replace("&quot;", '"', $str_replece4);
		$tag_to_start = str_replace("&#39;", "'", $tag_to_start);
		
		$start_tag = trim($tag_to_start);
		//Start Tag
		}

		/* start tag string manipulation end here */
		if($ending_tag)
		{

		/* end tag string manipulation begin here */
		$str_replece5 = str_replace("<p>", "", $ending_tag);
		$str_replece6 = str_replace("</p>", "", $str_replece5);
		$str_replace7 = str_replace("&gt;", ">", $str_replece6);
		$str_replece8 = str_replace("&lt;", "'<\'", $str_replace7);
		$tag_to_end = str_replace("'", "", $str_replece8);
		/* end tag string manipulation end here */
		$end_tag = trim($tag_to_end);
		//End tag
		}
		
		$page_html = $this -> get_page($producturl);

		
		if (strpos($start_tag, '<span id="priceblock_saleprice" class="a-size-medium a-color-price">') !== false) {
			if (strpos($page_html, '<span class="a-size-medium a-color-price">') !== false) {
				$start_tag = '<span class="a-size-medium a-color-price">';
			}
		}
		if (strpos($page_html, '<span id="priceblock_dealprice" class="a-size-medium a-color-price">') !== false) {
			
			$start_tag = '<span id="priceblock_dealprice" class="a-size-medium a-color-price">';
		}
		//landmarkshops
		if (strpos($page_html, '<span
				id="products-details-price-current-01"') !== false) {
			
				$start_tag = '<span
				id="products-details-price-current-01"[^>]*>';
			
		}
		//babyoye
		if (strpos($page_html, '<span id="current_product_price">') !== false) {
			
				$start_tag = '<span id="current_product_price">';
			
		}
		//yepme lingesh
		if (strpos($page_html, '<span id="lblPayHead">') !== false) {

			$start_tag = '<span id="lblPayHead">';
		}

		//firstcry
		if (strpos($page_html, '<span class="mp" itemprop="price">') !== false) {

			$start_tag = '<span class="mp" itemprop="price">';
		}
		//craftsvilla
		if (strpos($page_html, '<span itemprop="price">') !== false) {
			$start_tag = '<span itemprop="price">';
		}
		if(strpos($page_html,'<span id="sec_discounted_price_')!==false)
		{
			$start_tag = '<span id="sec_discounted_price_[^>]*">';
		}
		if (strpos($page_html, '<div class="product-pricing"') !== false) {
			if (strpos($page_html, '<div class="price">') !== false) {
			$start_tag = '<div class="price">';
		}
		else if(strpos($page_html, '<div class="product-pricing" itemprop="offers" itemscope itemtype="http://schema.org/Offer">') !== false){
			$start_tag = '<div class="product-pricing" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
		}
		else{
			$start_tag = '<div class="product-pricing">';
		}
		}

		if (strpos($page_html, '<div class="col-xs-4 col-sm-4 col-md-3 nomargin nopadding price_details">') !== false) {

			$start_tag = '<div class="col-xs-4 col-sm-4 col-md-3 nomargin nopadding price_details">';
		}

		//rediff
		if (strpos($page_html, '<span id="price_bottom">') !== false) {

			$start_tag = '<span id="price_bottom">';
		}

		//themobilestore.
		if (strpos($page_html, '<span class="price" id="product-price') !== false) {

			$start_tag = '<span class="price" id="product-price';

		}
		if (strpos($page_html, '<span class="price" itemprop="price">') !== false) {
			$start_tag = '<span class="price" itemprop="price">';

		}
		//koovs
		if (strpos($page_html, '<span itemprop="price">') !== false) {
			$start_tag = '<span itemprop="price">';

		}
		if (strpos($page_html, "<span class='product-price'>") !== false) {
			$start_tag = "<span class='product-price'>";

		}

		//grocermax
		if (strpos($page_html, '<span class="raa_special_price">') !== false) {
			$start_tag = '<span class="raa_special_price">';

		}
		//urbanladder
		if (strpos($page_html, "<div class='price' itemprop='price'>") !== false) {
			$start_tag = "<div class='price' itemprop='price'>";

		}
		if (strpos($page_html, "<span class='label price_align'><label for='options'") !== false) {
			$start_tag = "<span class='label price_align'><label for='options'";

		}
		//crossword

		if (strpos($page_html, '<div class="seo-price hide"') !== false) {

			$start_tag = '<div class="seo-price hide"';

		}
		//ebay

		if (strpos($page_html, '<span class="notranslate" id="prcIsum" itemprop="price"  style="">') !== false) {
			$start_tag = '<span class="notranslate" id="prcIsum" itemprop="price"  style="">';

		}

		//voylla

		if (strpos($page_html, '<span class="price selling" style="color: #247581;font-size: 13pt;">') !== false) {

			$start_tag = '<span class="price selling" style="color: #247581;font-size: 13pt;">';

		}
		//naaptol
		if (strpos($page_html, '<span itemprop="price">') !== false) {
			$start_tag = '<span itemprop="price">';

		}
		//pepperfry

		if (strpos($page_html, '<span id="Ofprice">') !== false) {
			$start_tag = '<span id="Ofprice">';

		}
		//askme
		if (strpos($page_html, '<div class="price special-price">Selling Price: <span>') !== false) {

			$start_tag = '<div class="price special-price">Selling Price: <span>';

		}

		//gamesh homeshop18

		if (strpos($page_html, '<span id="hs18Price" itemprop="price"') !== false) {
			if (strpos($page_html, '<span id="hs18Price" itemprop="price" title=') === false) {

				$start_tag = '<span id="hs18Price" itemprop="price">';
			} else {

				$start_tag = '<span id="hs18Price" itemprop="price" title="Price of [^>]*">';
			}
		}

		if (strpos($page_html, "<span class='a-color-price'>") !== false) {

			$start_tag = "<span class='a-color-price'>";
		}
		if (strpos($page_html, '<span id="priceblock_ourprice" class="a-size-medium a-color-price">') !== false) {

			$start_tag = '<span id="priceblock_ourprice" class="a-size-medium a-color-price">';
		}

		if (strpos($start_tag, '<span class="price ftl">') !== false) {
			if (strpos($page_html, '<span class="price ftl">') === false) {
				$start_tag = '<span class="price">';
			}
		}

		//out of stock
		//flipkart
		if (strpos($page_html, '<div class="out-of-stock-status">') !== false) {

			$sout_start = '<div class="out-of-stock-status">';

		}
		//firstcry
		if (strpos($page_html, '<div class="p_stock_avail p_lft">') !== false) {
			$sout_start = '<div class="p_stock_avail p_lft">';

		}
		//grocermax
		if (strpos($page_html, '<p class="availability out-of-stock">') !== false) {

			$sout_start = '<p class="availability out-of-stock">Availability: <span>';

		}
		//amazon
		if (strpos($page_html, '<span class="a-size-medium a-color-price">') !== false) {
			$sout_start = '<span class="a-size-medium a-color-price">';
		}
		//ebay
		if (strpos($page_html, '<span id="w1-4-_msg" class="msgTextAlign" >') !== false) {
			$sout_start = '<span id="w1-4-_msg" class="msgTextAlign" >';

		}
		//craftsvilla

		if (strpos($page_html, '<div class="out-of-stock">') !== false) {
			$sout_start = '<div class="out-of-stock">';

		}

		//rediff
		if (strpos($page_html, "<div style='border:solid 1px #d5d5d5;padding:6px;' class='grey1 f16 bold'>") !== false) {
			$sout_start = "<div style='border:solid 1px #d5d5d5;padding:6px;' class='grey1 f16 bold'>";

		}

		//the mobile store
		if (strpos($page_html, '<p class="availability out-of-stock">') !== false) {

			$sout_start = '<p class="availability out-of-stock">';

		}
		//koovs

		if (strpos($page_html, '<div class="soldOutNotification  ">') !== false) {

			$sout_start = '<div class="soldOutNotification  ">';

		}
		//urbanladder
		if (strpos($page_html, "<div class='sold-out text-center'>") !== false) {

			$sout_start = "<div class='sold-out text-center'>";

		}
		//crossward
		if (strpos($page_html, "<span class='out_of_stock'>") !== false) {

			$sout_start = "<span class='out_of_stock'>";

		}
		//homeshop

		if (strpos($page_html, '<strong class="out_stock">') !== false) {
			$sout_start = '<span id="stock-status" class="instock_neo">';

		}
		//naaptol
		if (strpos($page_html, '<p class="button_head">') !== false) {
			$sout_start = '<p class="button_head">';

		}
		//pepperfry
		if (strpos($page_html, '<p class="capsBold">This Item is <span class="red"><strong>') !== false) {
			$sout_start = '<p class="capsBold">This Item is <span class="red"><strong>';

		}
		if (strpos($page_html, '<div class="soldleftImg btn">') !== false) {
			$sout_start = '<div class="soldleftImg btn">';

		}
		if (strpos($page_html, '<div class="status soldout " content="out_of_stock.">') !== false) {
			$sout_start = '<div class="status soldout " content="out_of_stock.">';

		}
		//indiatime shopping
		if (strpos($page_html, '<span class="comingdiv flt zur">') !== false) {
			$sout_start = '<span class="comingdiv flt zur">';

		}
		if (strpos($page_html, '<div class="soldleftImg btn">') !== false) {
			$sout_start = '<div class="soldleftImg btn">';

		}
		if (strpos($page_html, '<div class="status soldout " content="out_of_stock.">') !== false) {
			$sout_start = '<div class="status soldout " content="out_of_stock.">';

		}

		//rating

		//snapdeal
		if (strpos($page_html, '<span itemprop="ratingValue">') !== false) {
			//echo 'fff';exit;
			$rat_start = '<span itemprop="ratingValue">';
			$rat_end = '<\/span>';

		}
		//amazon
		if (strpos($page_html, '<div id="averageCustomerReviewRating" class="txtnormal clearboth">') !== false) {
			$rat_start = '<div id="averageCustomerReviewRating" class="txtnormal clearboth">';
			$rat_end = '<\/div>';
		}
		if (strpos($page_html, '<div id="avgRating" class="a-row a-spacing-small a-color-secondary">') !== false) {
			$rat_start = '<div id="avgRating" class="a-row a-spacing-small a-color-secondary">';
			$rat_end = '<\/div>';
		}

		//rediff
		if (strpos($page_html, '<span itemprop="ratingValue" class') !== false) {
			//	echo 'fddd';exit;
			$rat_start = '<span itemprop="ratingValue" [^>]*>';
			$rat_end = '<\/span>';
		}
		//flipkart

		if (strpos($page_html, '<span class="rating-out-of-five fk-inline-block fk-bg-green">') !== false) {
			//echo 'fddd';exit;
			$rat_start = '<span class="rating-out-of-five fk-inline-block fk-bg-green">';
			$rat_end = '<\/span>';
		}

		//india time
		if (strpos($page_html, '<span itemprop="ratingValue">') !== false) {
			$rat_start = '<span itemprop="ratingValue">';
			$rat_end = '<\/span>';
		}
		//home shop 18
		if (strpos($page_html, '<span class="product_rating_5" >') !== false) {
			$rat_start = '<span class="product_rating_5" >';
			$rat_end = '<\/span>';
		}

		//naaptol
		if (strpos($page_html, 'class="ogImg star') !== false) {
			$rat_start = '/<span title="(.+) Out of 5 Stars" class="ogImg star[^>]*">/';
			$rat_end = '';
		}

		//check rate end tag

		$sregex1 = "/$rat_start(.*?)$rat_end/s";
		//exit;
		if ($rat_end == '') {
			preg_match($rat_start, $page_html, $rating);
		} else {

			preg_match($sregex1, $page_html, $rating);
		}

		if (strpos($page_html, '<span class="rating-out-of-five fk-inline-block fk-bg-green">') !== false) {
			$rating = str_replace("/ 5", '', strip_tags($rating[0]));
		} else if (strpos($page_html, '<span itemprop="ratingValue"') !== false) {
			$rating = str_replace("'bold'>", '', strip_tags($rating[1][0]));
		} else {
			$rating = str_replace('out of 5 stars', '', strip_tags($rating[1][0]));
		}
		
		$data['rating'] = trim($rating);
		

		//check the end tag
		if (strpos($page_html, '<p class="capsBold">This Item is <span class="red"><strong>') !== false) {
			$sout_end = '<\/strong><\/span><\/p>';

		} else if (strpos($page_html, '<p class="button_head">') !== false) {
			$sout_end = '<\/p>';
		} else if (strpos($page_html, "<span class='out_of_stock'>") !== false) {
			$sout_end = '<\/span>';
		} else if (strpos($page_html, '<p class="availability out-of-stock">') !== false) {
			$sout_end = '<\/p>';
		} else if (strpos($page_html, '<p class="availability out-of-stock">') !== false) {
			$sout_end = '<\/span><\/p>';
		} else if (strpos($page_html, '<span id="w1-4-_msg" class="msgTextAlign" >') !== false) {
			$sout_end = '<\/span>';
		} else if (strpos($page_html, '<span class="a-size-medium a-color-price">') !== false) {
			$sout_end = '<\/span>';
		} else {
			$sout_end = '<\/div>';
		}

		$sregex = "/$sout_start(.*?)$sout_end/s";
		//exit;
		preg_match_all($sregex, $page_html, $sold_out);

		if ($count_stock > 1) {
			$sold_out = str_replace('!', '', strip_tags($sold_out[0][1]));
		} else {
			$sold_out = str_replace('!', '', strip_tags($sold_out[1][0]));
		}

		$data['out_stock'] = trim($sold_out);

		echo $regex = "/$start_tag(.*?)$end_tag/s";
		preg_match_all($regex, $page_html, $price);
		//print_r($price);die;

		$countpric = count($price[0]);

		if ($countpric > 1) {

			$price[0][0] = $price[0][1];
		}

		if (!empty($price[0][0])) {

			$datas1 = $price[0][0];

			$values = $price[0][0];
			$contentq = preg_replace('/<span[^>]+\><\/span>/s', '', $values);
			$contentq = preg_replace('/<span[^>]+-[^>]*\><\/span>/s', '', $values);
			$contentq = preg_replace('/<span[^>]+_[^>]*\><\/span>/s', '', $values);
			$content = preg_replace('/<span[^>]+\>.*?<\/span>/s', '', $contentq);
			$replace1 = trim(str_replace('&#8377;', "", $content));
			$replace2 = trim(str_replace('Rs.', "", $content));
			$replace3 = trim(str_replace(',', "", $replace2));
			$prices = $this -> getpricefun($replace3);
			if (intval($prices == 0)) {
				$prices = $this -> getpricefun($values);
			}
			$data['prices'] = $prices;
			
		}

		if (intval($price[0][0] == 0) && count($price[0]) == 5 || count($price[0]) == 4 || count($price[0]) == 6)//shoppersstop
		{
			$dps1 = min(array_filter($price[0]));
			if (strip_tags($dps1) != '') {$datat1 = $dps1;
			} else {$datat1 = array_pop($price[0]);
			}
			$datat1 = filter_var($datat1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$datat2 = trim(strip_tags(str_replace("R", "", $datat1)));
			$datat3 = trim(strip_tags(str_replace(",", "", $datat2)));
			$datat4 = trim(strip_tags(str_replace("s.", "", $datat3)));
			$datat5 = trim(strip_tags(str_replace(":", "", $datat4)));
			$datat6 = trim(strip_tags(str_replace("Price", "", $datat5)));
			$datat7 = trim(strip_tags(str_replace("Selling", "", $datat6)));
			$prices = number_format((float)$datat7, 2, '.', '');
		}

		if (intval($prices == 0) || $price[0][0] == '') {
			//if($prices == 0.00) {
			if ($end_tag == "<\/span>") {
				$e_tag += "</div>";
			}

			if ($end_tag == "<\/div>") {
				$e_tag += "</span>";
			}
			$regex = "/$start_tag(.*?)$$etag/s";
			preg_match_all($regex, $page_html, $price);

			$separate_values = strip_tags($price[0][0]);
			

			preg_match_all('/[0-9_.,]+|:|,|/', $separate_values, $separate);
			
			$filteredarray = array_values(array_filter($separate[0]));
			
			if (strpos($start_tag, 'saleprice') !== false && count($filteredarray) < 1) {
				$start_tag = str_replace("saleprice", "dealprice", $start_tag);
				$regex = "/$start_tag(.*?)$$etag/s";
				preg_match_all($regex, $page_html, $price);
				$separate_values = strip_tags($price[0][0]);

				preg_match_all('/[0-9_.,]+|:|,|/', $separate_values, $separate);

				
				$filteredarray = array_values(array_filter($separate[0]));

			}

			if ($filteredarray[0] == 1840 && $filteredarray[1] == 8377) {
				$dataz = $filteredarray[2];
			} elseif ($filteredarray[0] == '.' && $filteredarray[2] == '.' && $filteredarray[4] == '.')//homeshop18
			{
				$dataz = $filteredarray[1];
			}
			elseif ($filteredarray[2] == ',' && $filteredarray[3] == '.' && $filteredarray[4] == '.')//landmark
			{
				 $dataz = strip_tags($filteredarray[0]); 
			}

			elseif ($filteredarray[0] == '.' && $filteredarray[2] == '.' && $filteredarray[4] == ',')//fashionara
			{
				$dataz = $filteredarray[3];
			} elseif ($filteredarray[0] == 8377 || $filteredarray[0] == '.') {
				$dataz = $filteredarray[1];
			} else {
				$dataz = preg_replace("/^\.+|\.+$/", "", $filteredarray[0]);
			}
			$dataz1 = trim(strip_tags(str_replace(",", "", $dataz)));
			$data['prices'] = number_format((float)$dataz1, 2, '.', '');
			if ($data['out_stock'] == "") {

				preg_match_all('/[a-z_.,]+|:|,|/i', $separate_values, $strings);
				$string_array = array_values(array_filter($strings[0]));
				
				$data['out_stock'] = $string_array[0] . $string_array[1];
			}
			if ($data['rating'] == "") {

				preg_match_all('/[a-z_.,]+|:|,|/i', $separate_values, $strings);
				$string_array = array_values(array_filter($strings[0]));
				
				$data['rating'] = $string_array[0] . $string_array[1];
			}

		}
		
	

		return $data;
	}

	public function get_page($url) {               $curl = curl_init($url);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10; labnol;) ctrlq.org");
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$html = curl_exec($curl);
		curl_close($curl);
		//print_r($html);die;
		return $html;
	}

	public function getpricefun($getbval) {
		$str = preg_replace('~<p[^>]*>.*?</p>~s', '', $getbval, 1);
		$datas1 = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		if ($datas1) {$datas1 = $getbval;
			$datas1 = filter_var($datas1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		}
		
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
		$datas11 = trim(str_replace('&#8377;', "", $datas11));
		
		$prices = number_format((float)$datas11, 2, '.', '');
		if ($prices == "0.00" && $datas11 != "" && (strpos($datas11, '%') === false)) {$datas11 = filter_var($datas11, FILTER_SANITIZE_NUMBER_INT);
			$prices = 0;
			$prices = number_format((float)$datas11, 2, '.', '');
		}

		return $prices;
	}

}
?>