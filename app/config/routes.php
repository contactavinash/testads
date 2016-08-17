<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "Cashback";
$route['404_override'] = 'cashback/broken';
//$route['(:any)']= 'cashback/$1';
$route['coupons'] = 'cashback/coupons';
$route['coupons/(:any)'] = 'cashback/coupons/$1';
$route['my_earnings'] = 'cashback/my_earnings';
$route['my_payments'] = 'cashback/my_payments';
$route['missing_cashback'] = 'cashback/missing_cashback';
$route['refer_friends'] = 'cashback/refer_friends';
$route['referral_network'] = 'cashback/referral_network';
$route['redemption'] = 'cashback/redemption';
$route['pending_transactions'] = 'cashback/pending_transactions';
$route['favorites'] = 'cashback/favorites';
$route['myaccount'] = 'cashback/myaccount';
$route['transations'] = 'cashback/transations';
$route['salable_coupons'] = 'cashback/salable_coupons';
$route['top_cashback'] = 'cashback/top_cashback';
$route['top_cashback/(:any)'] = 'cashback/top_cashback/$1';
$route['stores_list'] = 'cashback/stores_list';
$route['stores_list/(:any)'] = 'cashback/stores_list/$1';
$route['stores/(:any)'] = 'cashback/stores/$1';
$route['codes/(:any)'] = 'cashback/codes/$1';
$route['visit_shop/(:any)'] = 'cashback/visit_shop/$1';
// paysalable_coupons
$route['paysalable_coupons/(:any)'] = 'cashback/paysalable_coupons/$1';
$route['forgetpassword'] = 'cashback/forgetpassword';
$route['update_stores/(:any)'] = 'cashback/update_stores/$1';
$route['view_stores'] = 'cashback/view_stores';
$route['add_offlinestores'] = 'cashback/add_offlinestores';
$route['offline_products'] = 'cashback/offline_products';
$route['offline_change_password'] = 'cashback/offline_change_password';
$route['offline_listofproducts'] = 'cashback/offline_listofproducts';
$route['logout'] = 'cashback/logout';
$route['offline_login'] = 'cashback/offline_login';
$route['update_offline_stores'] = 'cashback/update_offline_stores';
$route['delete_products/(:any)'] = 'cashback/delete_products/$1';
$route['category/(:any)'] = 'cashback/category/$1';
$route['offline_register'] = 'cashback/offline_register';
$route['product_index'] = 'cashback/product_index';
$route['products/(:any)'] = 'cashback/products/$1/$2';
// $route['products/(:any)/([a-z]+)/(\d+)'] = "cashback/products/$1/id_$2";
$route['visit_product/(:any)'] = 'cashback/visit_product/$1';
$route['under_maintance'] = 'cashback/under_maintance';
$route['register'] = 'cashback/register';
$route['product_details/(:any)'] = 'cashback/product_details/$1';
$route['index'] = 'cashback/index';
$route['login'] = 'cashback/login';
$route['complete/(:any)'] = 'cashback/complete/$1';
$route['forgetpassword'] = 'cashback/forgetpassword';
$route['offline_register'] = 'cashback/offline_register';
$route['offline_chk_invalid'] = 'cashback/offline_chk_invalid';
$route['chk_invalid'] = 'cashback/chk_invalid';

$route['offline_forgetpassword'] = 'cashback/offline_forgetpassword';
$route['cms/(:any)'] = 'cashback/cms/$1';
$route['broken'] = 'cashback/broken';
$route['otp_request'] = 'cashback/otp_request';
$route['offline_reset_password'] = 'cashback/offline_reset_password';
$route['reset_password'] = 'cashback/reset_password';
$route['contact'] = 'cashback/contact';
$route['add_withdraw'] = 'cashback/add_withdraw';
$route['detailspage/(:any)'] = 'cashback/detailspage/$1';
$route['thankyou'] = 'cashback/thankyou';
$route['password_reset'] = 'cashback/password_reset';
$route['shopping'] = 'cashback/shopping';
$route['support'] = 'cashback/support';
$route['offline_password_reset'] = 'cashback/offline_password_reset';
$route['cart_listing_page'] = 'cashback/cart_listing_page';
$route['compare_products'] = 'cashback/compare_products';
$route['success_withdraw/(:any)'] = 'cashback/success_withdraw/$1';
$route['offline_verify_account/(:any)'] = 'cashback/offline_verify_account/$1';
// $route['products/([a-z]+)/(\d+)'] = "$1/id_$2";
$route['view_coupons'] = 'cashback/view_coupons';
$route['coupon_transaction'] = 'cashback/coupon_transaction';
$route['my_coupons'] = 'cashback/my_coupons';
$route['delete_coupon_id/(:any)'] = 'cashback/delete_coupon_id/$1';
$route['pay_nowsalable_coupons/(:any)'] = 'cashback/pay_nowsalable_coupons/$1';
$route['contact_me']='cashback/contact_me';
// success_withdraw 
// $route['(:any)']= 'multicoin/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */