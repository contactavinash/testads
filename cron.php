<?php
$link=mysql_connect('localhost','alldisco_adsale','uq)Be&h1T~el');
	$conn=mysql_select_db('alldisco_sale',$link);
	//echo "DELETE FROM coupons WHERE expiry_date =date_format( CURDATE() - INTERVAL 1 DAY, '%m/%d/%Y' )";

	mysql_query("DELETE FROM coupons WHERE expiry_date =date_format( CURDATE() - INTERVAL 1 DAY, '%m/%d/%Y' )");
echo "Expiry coupons Deleted Successfully";
?> 
