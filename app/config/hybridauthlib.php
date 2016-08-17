<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$query = mysql_fetch_array(mysql_query("select * from admin where admin_id='1'"));
$google_key =  $query['google_key'];
$google_secret =  $query['google_secret'];
$facebook_key =  $query['facebook_key'];   //seetha
$facebook_secret =  $query['facebook_secret'];

$config['base_url'] = "http://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/'; 

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/HAuth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => true
			),

			"Yahoo" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "dj0yJmk9YXRHc3ZxZTdEc1VDJmQ9WVdrOVdVMWtUWGRuTlRBbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD1hMA--", "secret" => "bf265cc9e38913b3d18cc272e658a98860df24f9" ),
			),

			"AOL"  => array (
				"enabled" => true
			),

			"Google" => array (
				"enabled" => true,
				//"keys"    => array ( "id" => "1075655333809-iqccmcm9h9hn8v0g34b2n5b8dj7ifng1.apps.googleusercontent.com", "secret" => "XMwmgwgWlqeivTCfTpyAJnWX" ),
				//"keys"    => array ( "id" => "897945217637-irpstgnm1q7ii81637un7vo596pgndpf.apps.googleusercontent.com", "secret" => "IRqYdpWO6USQr4W5oJJebXA0" ),
				"keys"    => array ( "id" => $google_key, "secret" => $google_secret ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => $facebook_key, "secret" => $facebook_secret ),
				 /* "keys"    => array ( "id" => "1027598403932187", "secret" => "e4652701fbc4654605a905f4998b642a" ),
                               "keys"    => array ( "id" =>$facebook_key, "secret" => $facebook_secret ),  //seetha */
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			// windows live
			"Live" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => (ENVIRONMENT == 'development'),

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */