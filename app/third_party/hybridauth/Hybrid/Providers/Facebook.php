<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
*/

/**
 * Hybrid_Providers_Facebook provider adapter based on OAuth2 protocol
 * 
 * Hybrid_Providers_Facebook use the Facebook PHP SDK created by Facebook
 * 
 * http://hybridauth.sourceforge.net/userguide/IDProvider_info_Facebook.html
 */ 
  
class Hybrid_Providers_Facebook extends Hybrid_Provider_Model
{
	// default permissions, and alot of them. You can change them from the configuration by setting the scope to what you want/need
	
/* 	public $scope = "email, user_about_me, user_birthday, user_hometown, user_website, read_stream, offline_access, publish_stream,read_friendlists,user_likes,user_actions.music,user_activities,user_groups,user_friends,user_hometown,user_location,user_work_history,user_games_activity,user_interests"; */  

 	
	/* public $scope = "email, user_about_me, user_birthday, user_hometown, user_website, read_stream, offline_access, publish_stream,read_friendlists,user_actions.books,user_actions.fitness,user_actions.music,user_actions.news,user_actions.video,user_activities,user_education_history,user_events,user_friends,user_games_activity,user_groups,user_interests,user_likes,user_location,user_photos,user_relationship_details,user_relationships,user_religion_politics,user_status,user_tagged_places,user_videos,user_website,user_work_history"; */
	 	 public $scope = "email, user_about_me, user_birthday, user_hometown, user_location, user_website, read_stream, publish_actions, read_custom_friendlists";
    
	/**
	* IDp wrappers initializer     
	*/ 
	   
	function initialize() 
	{
		if ( ! $this->config["keys"]["id"] || ! $this->config["keys"]["secret"] ){
			throw new Exception( "Your application id and secret are required in order to connect to {$this->providerId}.", 4 );
		} 

		if ( ! class_exists('FacebookApiException', false) ) {
			require_once Hybrid_Auth::$config["path_libraries"] . "Facebook/base_facebook.php";
			require_once Hybrid_Auth::$config["path_libraries"] . "Facebook/facebook.php";
		}
		
		if ( isset ( Hybrid_Auth::$config["proxy"] ) ) {
			BaseFacebook::$CURL_OPTS[CURLOPT_PROXY] = Hybrid_Auth::$config["proxy"];
		}

		$this->api = new Facebook( ARRAY( 'appId' => $this->config["keys"]["id"], 'secret' => $this->config["keys"]["secret"] ) ); 

		if ( $this->token("access_token") ) {
			$this->api->setAccessToken( $this->token("access_token") );
			$this->api->setExtendedAccessToken();
			$access_token = $this->api->getAccessToken();

			if( $access_token ){
				$this->token("access_token", $access_token );
				$this->api->setAccessToken( $access_token );
			}

			$this->api->setAccessToken( $this->token("access_token") );
		}

		$this->api->getUser();
	}

	/**
	* begin login step
	* 
	* simply call Facebook::require_login(). 
	*/
	function loginBegin()
	{
		$parameters = array("scope" => $this->scope, "redirect_uri" => $this->endpoint, "display" => "page");
		$optionals  = array("scope", "redirect_uri", "display");

		foreach ($optionals as $parameter){
			if( isset( $this->config[$parameter] ) && ! empty( $this->config[$parameter] ) ){
				$parameters[$parameter] = $this->config[$parameter];
			}
		}

		// get the login url 
		$url = $this->api->getLoginUrl( $parameters );

		// redirect to facebook
		Hybrid_Auth::redirect( $url );
	}

	/**
	* finish login step 
	*/
	function loginFinish()
	{ 
		// in case we get error_reason=user_denied&error=access_denied
		if ( isset( $_REQUEST['error'] ) && $_REQUEST['error'] == "access_denied" ){ 
			throw new Exception( "Authentication failed! The user denied your request.", 5 );
		}

		// try to get the UID of the connected user from fb, should be > 0 
		if ( ! $this->api->getUser() ){
			throw new Exception( "Authentication failed! {$this->providerId} returned an invalid user id.", 5 );
		}

		// set user as logged in
		$this->setUserConnected();

		// store facebook access token 
		$this->token( "access_token", $this->api->getAccessToken() );
	}

	/**
	* logout
	*/
	function logout()
	{ 
		$this->api->destroySession();

		parent::logout();
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		// request user profile from fb api
		try {
			$fields = array(
				'id', 'name', 'first_name', 'last_name', 'link', 'website',
				'gender', 'locale', 'about', 'email', 'hometown', 'location'
				);
			$data = $this->api->api('/me?fields=' . implode(',', $fields));
		}
		catch (FacebookApiException $e) {
		throw new Exception("User profile request failed! {$this->providerId} returned an error: $e", 6);
		}
		// if the provider identifier is not received, we assume the auth has failed
		if (!isset($data["id"])) {
		throw new Exception("User profile request failed! {$this->providerId} api returned an invalid response.", 6);
		}
		# store the user profile.
		$this->user->profile->identifier = (array_key_exists('id', $data)) ? $data['id'] : "";
		$this->user->profile->username = (array_key_exists('username', $data)) ? $data['username'] : "";
		$this->user->profile->displayName = (array_key_exists('name', $data)) ? $data['name'] : "";
		$this->user->profile->firstName = (array_key_exists('first_name', $data)) ? $data['first_name'] : "";
		$this->user->profile->lastName = (array_key_exists('last_name', $data)) ? $data['last_name'] : "";
		$this->user->profile->photoURL = "https://graph.facebook.com/" . $this->user->profile->identifier . "/picture?width=150&height=150";
		$this->user->profile->coverInfoURL = "https://graph.facebook.com/" . $this->user->profile->identifier . "?fields=cover&access_token=" . $this->api->getAccessToken();
		$this->user->profile->profileURL = (array_key_exists('link', $data)) ? $data['link'] : "";
		$this->user->profile->webSiteURL = (array_key_exists('website', $data)) ? $data['website'] : "";
		$this->user->profile->gender = (array_key_exists('gender', $data)) ? $data['gender'] : "";
		$this->user->profile->language = (array_key_exists('locale', $data)) ? $data['locale'] : "";
		$this->user->profile->description = (array_key_exists('about', $data)) ? $data['about'] : "";
		$this->user->profile->email = (array_key_exists('email', $data)) ? $data['email'] : "";
		$this->user->profile->emailVerified = (array_key_exists('email', $data)) ? $data['email'] : "";
		$this->user->profile->region = (array_key_exists("location", $data) && array_key_exists("name", $data['location'])) ? $data['location']["name"] : "";
		if (!empty($this->user->profile->region)) {
		$regionArr = explode(',', $this->user->profile->region);
		if (count($regionArr) > 1) {
		$this->user->profile->city = trim($regionArr[0]);
		$this->user->profile->country = trim($regionArr[1]);
		}
		}
		if (array_key_exists('birthday', $data)) {
		list($birthday_month, $birthday_day, $birthday_year) = explode("/", $data['birthday']);
		$this->user->profile->birthDay = (int) $birthday_day;
		$this->user->profile->birthMonth = (int) $birthday_month;
		$this->user->profile->birthYear = (int) $birthday_year;
		}
		//print_r($this->user->profile);exit;
		return $this->user->profile;
	}

	/**
	* load the user contacts
	*/
	function getUserContacts()
	{
		try{ 
			$response = $this->api->api('/me/friends'); 
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User contacts request failed! {$this->providerId} returned an error: $e" );
		} 
 
		if( ! $response || ! count( $response["data"] ) ){
			return ARRAY();
		}

		$contacts = ARRAY();
 
		foreach( $response["data"] as $item ){
			$uc = new Hybrid_User_Contact();

			$uc->identifier  = (array_key_exists("id",$item))?$item["id"]:"";
			$uc->displayName = (array_key_exists("name",$item))?$item["name"]:"";
			$uc->profileURL  = "https://www.facebook.com/profile.php?id=" . $uc->identifier;
			$uc->photoURL    = "https://graph.facebook.com/" . $uc->identifier . "/picture?width=150&height=150";

			$contacts[] = $uc;
		}

		return $contacts;
 	}

	/**
	* update user status
	*/
	function setUserStatus( $status )
	{
		$parameters = array();

		if( is_array( $status ) ){
			$parameters = $status;
		}
		else{
			$parameters["message"] = $status; 
		}

		try{ 
			$response = $this->api->api( "/me/feed", "post", $parameters );
		}
		catch( FacebookApiException $e ){
			throw new Exception( "Update user status failed! {$this->providerId} returned an error: $e" );
		}
 	}

	/**
	* load the user latest activity  
	*    - timeline : all the stream
	*    - me       : the user activity only  
	*/
	function getUserActivity( $stream )
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/feed' ); 
			}
			else{
				$response = $this->api->api('/me/home'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		$activities = ARRAY();

		foreach( $response['data'] as $item ){
			if( $stream == "me" && $item["from"]["id"] != $this->api->getUser() ){
				continue;
			}

			$ua = new Hybrid_User_Activity();

			$ua->id                 = (array_key_exists("id",$item))?$item["id"]:"";
			$ua->date               = (array_key_exists("created_time",$item))?strtotime($item["created_time"]):"";

			if( $item["type"] == "video" ){
				$ua->text           = (array_key_exists("link",$item))?$item["link"]:"";
			}

			if( $item["type"] == "link" ){
				$ua->text           = (array_key_exists("link",$item))?$item["link"]:"";
			}

			if( empty( $ua->text ) && isset( $item["story"] ) ){
				$ua->text           = (array_key_exists("link",$item))?$item["link"]:"";
			}

			if( empty( $ua->text ) && isset( $item["message"] ) ){
				$ua->text           = (array_key_exists("message",$item))?$item["message"]:"";
			}

			if( ! empty( $ua->text ) ){
				$ua->user->identifier   = (array_key_exists("id",$item["from"]))?$item["from"]["id"]:"";
				$ua->user->displayName  = (array_key_exists("name",$item["from"]))?$item["from"]["name"]:"";
				$ua->user->profileURL   = "https://www.facebook.com/profile.php?id=" . $ua->user->identifier;
				$ua->user->photoURL     = "https://graph.facebook.com/" . $ua->user->identifier . "/picture?type=square";

				$activities[] = $ua;
			}
		}

		return $activities;
 	}
	 
	 //  renuka 
	 
	function getUserLikes($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/likes' ); 
			}
			else{
				$response = $this->api->api('/me/likes'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	
	function getUserEvents($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/events' ); 
			}
			else{
				$response = $this->api->api('/me/events'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}  
	
	//  music ,  videos    
	  
	/*  user_actions.music,user_activities,user_groups,user_friends,user_hometown,user_location,user_work_history,user_games_activity,user_interests */
	 
	function getUserActivities($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/activities' ); 
			}
			else{
				$response = $this->api->api('/me/activities'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	
	
	function getUserActionMusic($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/music' ); 
			}
			else{
				$response = $this->api->api('/me/music'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
 
	function getUserGroups($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/groups' ); 
			}
			else{
				$response = $this->api->api('/me/groups'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	
	function getUserFriends($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/friends' ); 
			}
			else{
				$response = $this->api->api('/me/friends'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	/* 	
  function getUserHomeTown($stream="")  // error hometown 
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me?fields=hometown' ); 
			}
			else{
				$response = $this->api->api('/me?fields=hometown'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}  
	
 
   	function getUserLocations($stream="") // error locations   
	{  
	   //  ?fields=location,hometown,work

		try{
			if( $stream == "me" ){
				$response = $this->api->api('/me?fields=location'); 
			}
			else{
				$response = $this->api->api('/me?fields=location'); 
			}
		} 
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	  
  	function getUserWorkHistory($stream="") // error work_history   
	{
		   // ?fields=location,hometown,work
		    
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me?fields=work' ); 
			}
			else{
				$response = $this->api->api('/me?fields=work'); 
			}
		} 
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}  */
	
	
	
   	function getUserGamesActivity($stream="")  
	{
		  
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/games' ); 
			}
			else{
				$response = $this->api->api('/me/games'); 
			}
		} 
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	
   	function getUserInterests($stream="") //   
	{
		  
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/interests' ); 
			}
			else{
				$response = $this->api->api('/me/interests'); 
			}
		} 
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	
    
	function getUserActionVideos($stream="")
	{
		try{
			if( $stream == "me" ){
				$response = $this->api->api( '/me/videos' ); 
			}
			else{
				$response = $this->api->api('/me/videos'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		return $response;
	}
	
	 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
