<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('front_model');	
	}
	
	public function index()
	{
		$this->load->view('hauth/home');
	}

	public function login($provider)
	{
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.HAuth.login: user authenticated.');
					// echo '<pre>';
					//$user_profile = $service->getUserContacts();
					$user_profile = $service->getUserProfile();
					//print_r($user_profile);die;
					//$req_email=$user_profile->emailVerified;
					
					$this->load->model('home_model');
					$this->home_model->user_already_exist($user_profile);
					if ($this->session->userdata('redirect_to') != '') {
        				redirect($this->session->userdata('redirect_to'), 'refresh');
        			}
					redirect('user/edit_profile','refresh');
					//$this->home->user_already_exist($user_profile);


					log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));

					$data['user_profile'] = $user_profile;
					$this->load->view('hauth/done',$data);
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
	
	public function register($provider,$return_path=null)
	{
		
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();
					$this->load->model('front_model');
					$ins = $this->front_model->login_google($user_profile);
					if($ins==1)
					{
						if($return_path=='')
						{
							redirect('cashback/myaccount','refresh');
						}
						else
						{
							$decode_return = insep_decode($return_path);
							redirect($decode_return,'refresh');
						}
						
					}
					else
					{
						redirect('cashback/index','refresh');
					}
					/*print_r($user_profile);
					exit;*/

					/*log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));

					$data['user_profile'] = $user_profile;
					$data['user_contacts'] = $user_contacts;
					
					//$this->load->view('front/ref_friends',$data);
						
					$this->load->view('hauth/done',$data);*/
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}
	
	public function invite($provider)
    {
        
        $provider1=$provider;
        //$this->session->set_userdata('provider',$provider1);
        //$provider=$this->session->userdata('provider');
        log_message('debug', "controllers.HAuth.login($provider) called");
        try
        {
        log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
        $this->load->library('HybridAuthLib');
        if ($this->hybridauthlib->providerEnabled($provider))
        {
        log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
        $service = $this->hybridauthlib->authenticate($provider);
        
        if ($service->isUserConnected())
        {
        log_message('debug', 'controller.HAuth.login: user authenticated.');
        $user_profile = $service->getUserProfile();
        $user_contacts = $service->getUserContacts();
        log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
        $data['user_profile'] = $user_profile;
        $data['user_contacts'] = $user_contacts;
		//$this->load->view('front/ref_friends',$data);
		$this->load->view('hauth/done',$data);
		//$r=$this->signup_model->sent_invitation($user_contacts);
        //$this->session->set_flashdata('invite_suc','Invitation Send Successfully');
        
		//redirect('signup/signup_steps?skip=step1','refresh');
        //redirect('linkdrag/invite_friends/'.$user_contacts,'refresh');  
        }
        else // Cannot authenticate user
        {
        show_error('Cannot authenticate user');
        }
        }
        else // This service is not enabled.
        {
        //redirect('hauth/invite_friends/'.$provider,'refresh');
        //echo "error";
        //log_message('error', ' controllers.HAuth.login: This provider is not enabled ('.$provider.')');
        //show_404($_SERVER['REQUEST_URI']);
        }
    }
    catch(Exception $e)
    {
    $error = 'Unexpected error';
    switch($e->getCode())
    {
    case 0 : $error = 'Unspecified error.'; break;
    case 1 : $error = 'Hybriauth configuration error.'; break;
    case 2 : $error = 'Provider not properly configured.'; break;
    case 3 : $error = 'Unknown or disabled provider.'; break;
    case 4 : $error = 'Missing provider application credentials.'; break;
    case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
            //redirect();
            if (isset($service))
            {
            log_message('debug', 'controllers.HAuth.login: logging out from service.');
            $service->logout();
            }
            show_error('User has cancelled the authentication or the provider refused the connection.');
            break;
    case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
            break;
    case 7 : $error = 'User not connected to the provider.';
            break;
    }
    if (isset($service))
    {
    $service->logout();
    }
    log_message('error', 'controllers.HAuth.login: '.$error);
    show_error('Error authenticating user.');
    }
}	
	
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
