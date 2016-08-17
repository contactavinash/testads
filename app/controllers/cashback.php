<?php
class Cashback extends CI_Controller
{
	/* Nathan Dec 15 2015 */
	public function __construct(){	
		parent::__construct();
		
                include('textlocal.class.php');
                include_once("ViaNettSMS.php"); 
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('front_model');
		$this->load->helper('captcha');
		/*Multi Currency */ 
		$this->front_model->getcurrency();		
		$default_currency = $this->session->userdata('default_currency');
		 $default_currency_code = $this->session->userdata('default_currency_code');		
		if($default_currency_code=='INR')
		{
			$default_currency = 'Rs.';
			$this->session->set_userdata('default_currency',$default_currency);
		}
		$coinsvalue = $this->front_model->coinsvalue();
		define('COINVALUE',$coinsvalue);
		define('DEFAULT_CURRENCY',$default_currency);
		define('DEFAULT_CURRENCY_CODE',$default_currency_code);	  
		 
		/*Multi Currency */ 	
	}
	/* Nathan Dec 15 2015 */
	function index(){
		$this->input->session_helper();		
		//redirect('cashback/under_maintance','refresh');
		
		$cookiehandlers = $this->security->cookie_handlers();
		$admindetails = $this->front_model->getadmindetails();
		$data['couponslist']= $this->front_model->get_shopping_coupons(); //get coupons list	
		$data['categories'] = $this->front_model->category();
		$data['admindetails'] = $admindetails;
		$data['result'] = $this->front_model->home_slider();
		$data['scrapping_list']=$this->front_model->scrapping_list();
		$data['topbrands'] = $this->front_model->topbrands_index(12);
		$data['latestproducts']  = $this->front_model->latestproducts();
		$data['top_products_home'] = $this->front_model->top_products_home(20002);
	 $ipaddress = $_SERVER['REMOTE_ADDR'];
		 
		@$tags = file_get_contents('http://www.telize.com/geoip/'.$ipaddress);

		$decodetag = json_decode($tags, true);
		
		$decodetags=json_decode(file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn='.$ipaddress), true);
		
		
		$url="http://maps.googleapis.com/maps/api/geocode/json?latlng=".$decodetags['geobyteslatitude'].",".$decodetags['geobyteslongitude']."&sensor=true";
		 
		$result=file_get_contents($url);
		$result=json_decode($result);
		//print_r($result);
		$data['location']=$result->results[0]->address_components[1];
		//print_r($data['location']);die;
		$data['city']=$result->results[0]->address_components[3];
		$data['latlang']=$result->results[0]->geometry->location;
		$this->session->set_userdata('latitude',$data['latlang']->lat);
		$this->session->set_userdata('langitude',$data['latlang']->lng);
	 $data['latlang']->lat;
		//print_r($data['latlang']);die; 
		
		$acha_cats=file_get_contents('http://offline.achadiscount.in/admin/index.php/json/getcategoryfrontend');
		
		$data['acha_cates']=json_decode($acha_cats);
		
		$acha_hot_off=file_get_contents('http://offline.achadiscount.in/admin/index.php/json/getallhotoffers?lat='.$data['latlang']->lat.'&long='.$data['latlang']->lng.'');
		$data['hot_offers']=json_decode($acha_hot_off);
		$acha_brands=file_get_contents('http://offline.achadiscount.in/admin/index.php/json/getallhotbrands');
		$data['hot_brands']=json_decode($acha_brands);
		$acha_n_offer=file_get_contents('http://offline.achadiscount.in/admin/index.php/json/getofferfrontend?lat=18.76876&long=72.876876');
		$data['normal_offers']=json_decode($acha_n_offer);
	
		$data['pagename'] = "index";
		$this->load->view('front/index',$data);
                
		$cookiehandlers = $this->security->cookie_handlers();
	}
	function getgeo()
	{
		if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
    //Send request and receive json data by latitude and longitude
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
    $json = @file_get_contents($url);
    $data = json_decode($json);
	$geo['location']=$data->results[0]->address_components[2]->long_name;
	 $geo['city']=$data->results[0]->address_components[5]->long_name;
	$geo['lat']= $data->results[0]->geometry->location->lat;
	 $geo['lng']=$data->results[0]->geometry->location->lng;
	 $this->session->set_userdata('latitude',$geo['lat']);
	 $this->session->set_userdata('langitude',$geo['lng']);
	 
	 
   /*  $status = $data->status;
    if($status=="OK"){
        return json_encode($geo);
    }else{
        $location =  '';
    } */
	echo json_encode($geo);
    //Print address 
    
}
	}
//login check (SL)
	function login()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id!="")
		{
			redirect('myaccount','refresh');
		} else {
					$this->load->view('front/login','refresh');
		}
		$cookiehandlers = $this->security->cookie_handlers();
	}
	
	function chk_invalid(){		
		if($this->input->post('signin')) {
				$result = $this->front_model->login();
				if($result==0)
				{
					$data['invalid_login']='Invalid username and password.';
					$this->load->view('front/login',$data);
				} 
				else if($result==2)
				{
					$data['invalid_login']='Your account is de-activated.';
					$this->load->view('front/login',$data);
				}
				else
				{
					$this->session->unset_userdata('offline_user_id');
					redirect('myaccount','refresh');
				}
			}
			else
			{
				redirect('login','refresh');
			}
			$cookiehandlers = $this->security->cookie_handlers();
	}
	
	//registration form_validation
	function register()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id!="")
		{
			redirect('myaccount','refresh');
		}
		if($this->input->post('register'))
		{
                       $sms_email = $this->input->post('user_email');
			if($this->input->post('first_name')=="" || $this->input->post('user_email')=="" || $this->input->post('user_pwd')=="" || $this->input->post('pwd_confirm')==""){
				$this->session->set_flashdata('error','Please fill all the fields.');
				redirect('register','refresh');
			} else {
				// if($this->session->userdata('sess_captcha_code')!=$this->input->post('chk')){
					// $this->session->set_flashdata('error','CAPTCHA answer is mismatched.');
					// redirect('cashback/register','refresh');
				// }
			   $ins_qry = $this->front_model->register();
			   if($ins_qry)
				{	
					// echo 'insert';die;
					$this->session->set_flashdata('success','Users details added successfully.');
					// redirect('cashback/register','refresh');
					redirect('complete/'.base64_encode($sms_email),'refresh');
				}
				else
				{
					// echo 'error';die;
					$this->session->set_flashdata('error','Errors occurs while adding users details.');
					redirect('register','refresh');
				} 
			}	
		} 
		$cookiehandlers = $this->security->cookie_handlers();
		$this->load->view('front/register');
		
	}
	
	//check email for registration
	function check_email()
	{
		
		$email = $this->input->post('email');
		$result = $this->front_model->check_email($email);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
		$cookiehandlers = $this->security->cookie_handlers();
	}
	
	
	//myaccount page
	function myaccount()
	{	
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}	 
		else
		{
		// echo $user_id;
			$edit_qry = $this->front_model->edit_account($user_id);

			$data['results'] = $edit_qry;
			/*foreach($edit_qry as $get)
			{
				$data['user_id'] = $get->user_id;
				$data['first_name'] = $get->first_name;
				$data['last_name'] = $get->last_name;
				$data['email'] = $get->email;
				$data['street'] = $get->street;
				$data['city'] = $get->city;
				$data['state'] = $get->state;
				$data['zipcode'] = $get->zipcode;
				$data['country_id'] = $get->country;
				$data['contact_no'] = $get->contact_no;
			}*/
			$data['user_type']=$this->front_model->get_us_pawd($user_id);
			$this->load->view('front/myaccount',$data);

		}
		$cookiehandlers = $this->security->cookie_handlers();
	}
	// update the user details
	function update_account()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} else
		{
			if($this->input->post('save_changes')){
	
				$updated = $this->front_model->update_account();
				if($updated){
					$this->session->set_flashdata('success', ' Users details updated successfully.');
					redirect('myaccount','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating the user details.');
					redirect('myaccount','refresh');
				}
			}
		}
		$cookiehandlers = $this->security->cookie_handlers();
	}
	
	//change password
	function change_password()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		//echo $user_id;
		if($user_id==""){
			redirect('index','refresh');
		} else 
		{
			if($this->input->post('save')){
			$result = $this->front_model->update_password();
				if($result){
					$this->session->set_flashdata('success', 'Password changed successfully.');
					redirect('myaccount','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Old Password did not match.');
					redirect('myaccount','refresh');
				}
			}	
		}
		$cookiehandlers = $this->security->cookie_handlers();
	}
	
	//bankpayment_form
	function bankpayment()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} else 
		{
			if($this->input->post('save_chages'))
			{	
				$res = $this->front_model->bankpayment();
				if($res){
					$this->session->set_flashdata('success', 'User Bankpayment details added successfully.');
					redirect('myaccount','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while adding the user bankpayment details.');
					redirect('myaccount','refresh');
				}
			}
		}
	$cookiehandlers = $this->security->cookie_handlers();
	}
	
	//cheque_payment
	function cheque_payment()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} else 
		{
			if($this->input->post('Save_Changes'))
			{	
				$res = $this->front_model->cheque_payment();
				if($res){
					$this->session->set_flashdata('success', 'cheque details added successfully.');
					redirect('myaccount','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while adding the cheque details.');
					redirect('myaccount','refresh');
				}
			} 
		}
		$this->security->cookie_handlers();
	}
	//forget_password
	function forgetpassword($usermail=null)
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id!=""){
			redirect('index','refresh');
		} else
		{
			if($this->input->post('reset'))
			{	
				if($this->session->userdata('sess_captcha_code_forgetp')!=$this->input->post('chk')){
					$this->session->set_flashdata('error','CAPTCHA code is mismatched.');
					$usermail=base64_encode($this->input->post('email'));
					redirect('cashback/forgetpassword/'.$usermail,'refresh');
				}
				$res = $this->front_model->forgetpassword($user_id);
				if($res){
					$this->session->set_flashdata('success', 'Your password  details sent successfully.');
					redirect('forgetpassword','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while send the password details.');
					redirect('forgetpassword','refresh');
				}
			} 
			$data['usermail']=$usermail;
			$this->load->view('front/forgetpassword',$data);
		}
		$this->security->cookie_handlers();
	}
	//thanku  
	function complete($id=null)
	{
               if($id=='')
		{
			redirect('broken','refresh');
		}
		else
		{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id!="")
		{
			redirect('myaccount','refresh');
		}		
		$this->session->set_userdata('complete','complete');
		$complete = $this->session->userdata('complete');
		if($complete!="")
		{
            $data['sms_email'] = base64_decode($id);
			$this->load->view('front/thanku',$data);
		}
		$this->session->unset_userdata($complete);
		$this->security->cookie_handlers();
           }
	}
	
	//reset_password
	function reset_password($a,$b,$c) 
	{
		/*if(($a=='') || ($b=='')|| ($c==''))	
		{
			redirect('cashback/register','refresh');
		}
		else
		{*/
			$user_id = $this->session->userdata('user_id');
			if($user_id=="")
			{
				redirect('index','refresh');
			}
			else 
				{
					if($this->input->post('Save'))
					{	
						$res = $this->front_model->reset_password($user_id);
						if($res){
							$this->session->set_flashdata('success', 'Your Password updated successfully.');
							redirect('reset_password','refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'Error occurred while updating your password.');
							redirect('reset_password','refresh');
						}
					}  
					$this->load->view('front/reset_password');
				} 
		/*}*/
		$this->security->cookie_handlers();
	}
 
	//logout section
	function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Logged Out successfully.');
		$this->security->cookie_handlers();
		$this->load->library('HybridAuthLib');
		$this->hybridauthlib->logoutAllProviders();
		redirect('index','refresh');
	}
// End (SL)	
	
//email subscribe
	
	function email_subscribe(){
		$email = $this->input->post('email');
		$vars = $this->front_model->email_sub($email);
		$this->security->cookie_handlers();
		echo $vars;
	}
//header menu page

	function header_menu($name)
	{
		$result = $this->front_model->header_menu($name);
		$this->security->cookie_handlers();
		echo $result;
	}	
//footer menu page
	
	function cms($names)
	{
		$data['result'] = $this->front_model->cms_content($names);
		
		$this->load->view('front/cms',$data);
		$this->security->cookie_handlers();
	}
	
//Refer friends
	function refer_friends()
	{		
	 	$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{
			$this->load->view('front/refer_friends');
		}
	}
	
//Invite Freiends and send mail
	function invite_mail()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{
			$result = $this->front_model->invite_mail();
			//echo $result;
		}
	}
	
//Referral Friends Network

	function referral_network()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{
			$data['result'] = $this->front_model->referral_network();
			$this->load->view('front/referral_network',$data);
		}
	}
	
//load contact
	function contact()
	{
		$this->security->cookie_handlers();
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$this->load->view('front/contact',$data);
	}	

//contact form details
	function contact_form()
	{
		$this->input->session_helper();
		$result = $this->front_model->contact_form();
		if($result){
			$this->session->set_flashdata('success', 'Your message has been sent successfully, we will contact you soon.');
			redirect('contact','refresh');
		}
		else{
			$this->session->set_flashdata('error', 'Error occurred while sending your message.');
			redirect('contact','refresh');
		}
		$this->security->cookie_handlers();
	}
	
	
	
/*********************Nathan Start*************************/
/******Nov 19 th*********/


	
	function my_earnings()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}	 
		else
		{
			$edit_qry = $this->front_model->edit_account($user_id);
			$data['results'] = $edit_qry;
			$data['result_payments'] = $this->front_model->my_payments($user_id);
			$data['result_cashback'] = $this->front_model->my_cashback($user_id);
			$data['user_id'] = $user_id;
			$this->load->view('front/my_earnings',$data);
		}
		$this->security->cookie_handlers();
	}
	
	function missing_cashback($action=null)
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}	 
		else
		{
			$missing_cashback = $this->front_model->missing_cashback($user_id);
			$data['results'] = $missing_cashback;
			$this->load->view('front/missing_cashback',$data);
			/*switch($action)
			{
				case "add":
				{
					echo "Add cashback Goes here";
					exit;
				}
				case "edit":
				{
					echo "sample";
					exit;
				}
				case "delete":
				{
					echo "sample";
					exit;
				}
				default:
				{
					$missing_cashback = $this->front_model->missing_cashback($user_id);
					$data['results'] = $missing_cashback;
					$this->load->view('front/missing_cashback',$data);
				}
			}*/
		}
		$this->security->cookie_handlers();
	}
	
	function add_missing_cashback($action=null)
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}	 
		else
		{
			
					$missing_cashback = $this->front_model->missing_cashback($user_id);
					$data['results'] = $missing_cashback;
					$this->load->view('front/add_missing_cashback',$data);
		}
		$this->security->cookie_handlers();
	}
	
	
	function my_payments($status=null)
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{	
			$data['status'] = $status;
			$data['result'] = $this->front_model->my_payments($user_id);
			$this->load->view('front/my_payments',$data);
		}
		$this->security->cookie_handlers();
	}
	
	function add_withdraw()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{
			if($this->input->post('save')){
				$user = $this->front_model->edit_account($user_id);
				if($user->password!=$this->input->post('key')){
					$this->session->set_flashdata('error','Wrong Password given. Please try again.');
					redirect('add_withdraw','refresh');
				}
				$post_price = $this->input->post('req_amount');
				$res = $this->front_model->update_user_balance($user_id,$post_price);
				if($res){
					$this->session->set_flashdata('success','Withdraw request successfully sent.');
					redirect('add_withdraw','refresh');
				} else {
					$this->session->set_flashdata('error','Invalid amount given.');
					redirect('add_withdraw','refresh');
				}
			} else {
				$data['user_type']=$this->front_model->get_us_pawd($user_id);
				$this->load->view('front/add_withdraw',$data);
			}
		}
		$this->security->cookie_handlers();
	}
	

	/*function addtocart()
	{
		echo "Add to cart page goes here";
		exit;
	}*/
	
	
	/******Nov 19 th*********/
	/******Nov 26 th*********/
	
	function old_stores($store_id)
	{
		echo "Stores Page Inprogress";
		exit;
		if($categoryurl==""){
			//redirect('index','refresh');    // Need to remove this comment
		} 
		$category_details = $this->front_model->get_category_details($categoryurl); // gategory details
		$data['category_details'] = $category_details;
		$category_id= $category_details->category_id;
		
		$stores_list = $this->front_model->get_stores_list($category_id); //get stores list
		
		
		$subcategories = $this->front_model->get_subcategories($category_id); //get all sub categories
		if($subcategories!='')
		{
			foreach($subcategories as $subcat)
			{
				$subcategory_id[] = $subcat->sun_category_id;
				$sub_category_name[] = $subcat->sub_category_name;
			}
			$sub_category_name[] = $category_details->category_name;			
		}
		$sub_category_name[] = $category_details->category_name; 
		
		print_r($coupons_list);
		$this->security->cookie_handlers();
	}
	
	
	function stores($store_url)
	{
		$this->input->session_helper();
		if($store_url==""){
			redirect('index','refresh');    // Need to remove this comment
		} 

		//$store_url  = $this->front_model->seoUrl($store_url);

		$store_details = $this->front_model->get_store_details($store_url);
		if($store_details)
		{
			$data['store_details'] = $store_details;
			$store_name = $store_details->affiliate_name;
			$store_coupons = $this->front_model->get_coupons_from_store($store_name,20);
			$data['store_coupons'] = $store_coupons;
			$user_id = $this->session->userdata('user_id');
			$data['user_id'] = $user_id;
			$this->load->view('front/stores',$data);
		}
		else
		{
			$data['no_records'] = '1';
			$this->load->view('front/no_products',$data);
		}
	}
	
	
	function logincheck(){
		$this->input->session_helper();
		if($this->input->post('signin')) {
			
				$result = $this->front_model->login();
				if($result==0)
				{
					echo "Invalid username or password";
					
				} 
				else if($result==2)
				{
					echo "Your account is de-activated.";
				}
				else{
					$this->session->unset_userdata('offline_user_id');
					echo 1;
					//redirect('cashback/myaccount','refresh');
				}
			}
			else
			{
			redirect('login','refresh');
			}
			$this->security->cookie_handlers();
	}
	/******Nov 26 th*********/
	
	/************ Dec 1 st *************/
	function verify_account($verify_code)
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id!="")
		{
			redirect('myaccount','refresh');
		}
		
		$verify = $this->front_model->verify_account($verify_code);
		if($verify==1)
		{
			$data['verify_msg'] = $verify;
		}
		else
		{
			$data['verify_msg'] = $verify;
		}
		
		$this->load->view('front/verify_account',$data);	
		$this->security->cookie_handlers();
	}
	
	
	/************ Dec 1 st *************/
	/************ Dec 8th *************/
	
	function ajaxcall()
	{
		$getdate_old = $this->input->post('date');
		$getdate = date("Y/m/d", strtotime($getdate_old));
		$user_id = $this->session->userdata('user_id');
		$get_details = $this->front_model->get_details_ajax($getdate,$user_id);
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($get_details);
	}
	
	function get_clicked_store_details()
	{
		$this->input->session_helper();
		$getdate_old = $this->input->post('date');
		$click_store = $this->input->post('click_store');
		$getdate = date("Y/m/d", strtotime($getdate_old));
		$user_id = $this->session->userdata('user_id');
		$get_user_click_details = $this->front_model->get_clicked_details_ajax($getdate, $click_store, $user_id);
		if($get_user_click_details)
		{
			foreach($get_user_click_details as $clicks)
			{
				$get_exp = $this->front_model->get_clicked_expirycheck_ajax($clicks->click_id);
				$getclickdate = date("d F Y h:i A", strtotime($clicks->date_added));
				
				?>
                        <tr>
                            <td><?php echo $getclickdate;?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><?php echo $clicks->voucher_name;?></td>
                            <?php
							if($get_exp)
							{
								switch($get_exp->status)
								{
									case 0:
										$s =  'Completed';
									?>
                                    <?php
									break;
									case 1:
									$s =  'Cancelled';
									?>
                                   
                                    <?php
									break;
									case 2:
									$s =  'Sent to retailer';
									
									break;
									case 3:
									$s =  'Created';
									break;
									
								}
								?>
								 <td><a style="color: green; font-weight: bold;" href="javascript:void(0)"><?php echo $s;?></a></td>
                                 <?php
							}
							else
							{
							?>
                            <td><a style="color: green; font-weight: bold;" href="javascript:void(0)" onclick="final_step('<?php echo $clicks->click_id?>');">Click to raise ticket</a></td>
                            <?php
							}
							?>
                        </tr>
				<?php
			}
		}
		else
		{
			echo "<tr><td align='center' colspan='6'>No Records Found</td></tr>";
		}
	}
	
	/************ Dec 8th *************/
	/************ Dec 9th *************/
	function missing_Cashback_submit()
	{		
	$this->input->session_helper();
	$admin_id = $this->session->userdata('user_id');
		if($admin_id==""){
			redirect('index','refresh');
		} else
		{		
		
			if($this->input->post('save')){
				
				$flag=0;
				$banner_image = '';
				/* $ticket_attachment = $this->input->post('ticket_attachment');
				
				 $banner_image = $_FILES['ticket_attachment']['name'];
					if($banner_image!="") {
						$new_random = mt_rand(0,99999);
						$banner_image = $_FILES['ticket_attachment']['name'];
						$banner_image = remove_space($new_random.$banner_image);
						$config['upload_path'] ='uploads/missing_cashback';
						$config['allowed_types'] = '*';
						$config['file_name']=$banner_image;
						
						//print_r($config);
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						
						if($banner_image!="" && (!$this->upload->do_upload('ticket_attachment')))
						{
							$banner_imageerror = $this->upload->display_errors();
						}
						
						if(isset($banner_imageerror))
						{
							$flag=1;
							$this->session->set_flashdata('banner_name',$ticket_attachment);
							$this->session->set_flashdata('error',$banner_imageerror);
							redirect('cashback/add_missing_cashback','refresh');
						}
					} */
					if($flag==0){
						$results = $this->front_model->missing_Cashback_submit_mod($banner_image);
						if($results){
							$this->session->set_flashdata('success', ' Your cashback query has been submitted successfully. You can track the status of your query under Cashback Tickets.');
							redirect('missing_cashback','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding missing cashback.');
							redirect('missing_cashback','refresh');
						}
					}
				
			}
			else
			{
				redirect('add_missing_cashback','refresh');
			}
		}
		
	
	}
	/************ Dec 9th *************/
	
	/************ Dec 12th *************/
	function top_cashback($categoryurl=null,$sub_categoryurl=null)
	{		
		$this->input->session_helper();
		if($categoryurl==""){
			
			$stores_list = $this->front_model->get_top_cashback_stores_list(); //get stores list
			$data['stores_list'] = $stores_list;
			//print_r($stores_list);
			$this->load->view('front/top_cashback_all',$data);
			
			//redirect('index','refresh');    // Need to remove this comment
		} 
		else
		{
			$category_details = $this->front_model->get_category_details($categoryurl); // Category details
			if($category_details)
			{
				$category_id= $category_details->category_id;
				$category_name = $category_details->category_name;
				if($sub_categoryurl!="")
				{
					$sub_categorys = $this->front_model->sub_category_details($sub_categoryurl);
					$data['category_details'] = $sub_categorys;
					$data['main_category'] = $category_name;
				}
				else
				{
					$data['category_details'] = $category_details;
					$data['main_category'] = $category_name;
				}
				
				$stores_list = $this->front_model->get_top_cashback_stores_list_cate($category_id); //get stores list
				$data['stores_list'] = $stores_list;
				//print_r($stores_list);
				$this->load->view('front/top_cashback',$data);
			}
			else
			{
				$data['no_records'] = '1';
				$this->load->view('front/no_products',$data);
			}
		}
		
	}
	
	
	/************ Dec 12th *************/
	
	/************ Dec 13th *************/
	function blog()
	{		
		$blog_details = $this->front_model->get_blog_details();
		$data['blog_details'] = $blog_details; 
			$this->load->view('front/blog',$data);
	
	}
	
	function blog_details($blog_id=null)
	{
		$this->input->session_helper();
		if($blog_id=="")
		{
			redirect('index','refresh');			
		}
		
		$blog_details = $this->front_model->blog_details($blog_id);
		$block_comments = $this->front_model->blog_comments($blog_id);
		$data['block_comments'] = $block_comments; 
			$data['blog_details'] = $blog_details; 
			
			$this->load->view('front/blog_details',$data);
	}
	
	function blog_comment()
	{
		if($this->input->post('blog_commentregister'))
		{
			$blog_id = $this->input->post('blog_id');
			$ins_qry = $this->front_model->post_comments();
		   if($ins_qry)
			{	
				$this->session->set_flashdata('success','Comments added successfully.');
				redirect('blog_details/'.$blog_id,'refresh');
			}
			else
			{
					$this->session->set_flashdata('error','Errors occurs while adding Comments.');
					redirect('blog_details/'.$blog_id,'refresh');
			} 
		} 
	}
	
	
	
	
	/************ Dec 13th *************/
	

/*********************Nathan End*************************/	

/*********************Nathan End*************************/	  

 
 // 5/12/2014  renuka 
 
 function shopping()
 {	
 $this->input->session_helper();
			$admindetails = $this->front_model->getadmindetails();
			$data['admindetails'] = $admindetails;
			$data['result'] = $this->front_model->home_slider();     

              $urisegment=$this->uri->segment(3);
	          $perpage=$this->front_model->getrowsperpage(); 
               $result=$this->front_model->getall_premiumcoupons($perpage,$urisegment); 
			   
	           $data['featured_product']=$this->front_model->getall_fetured_products();
				if(!$result)  
				{			
					$data['view']="view";  
					$data['result']=$result;   
					$data['segment']="shopping";
					$data['notfound']="No Coupons are found at this time";         
					$this->load->view('front/shopping',$data);   
				}	  
				else     
				{	 
					$total_rows = $this->front_model->getall_premiumcouponscount(); 
 					$base="shopping";             
					$data['view']="view"; 
					$data['segment']="shopping"; 
					    
				    $this->pageconfig($total_rows,$base);          
 					$data['result']=$this->front_model->getall_premiumcoupons($perpage,$urisegment);  					
					$this->load->view('front/shopping',$data);      
				}  	
				 
 }
 
 function ajaxsess_setpremiumcategory() 
{
    /*if($this->input->post('catid')!=0)
	{*/
	$this->session->set_userdata("sess_cashback_premiumcatid",$this->input->post('catid'));   
	/*}*/
	//echo "sasa";
	//print_r($this->input->post())
	 $this->session->set_userdata("sess_cashback_starting_price",$this->input->post('starting_price'));   
	$this->session->set_userdata("sess_cashback_end_price",$this->input->post('end_price'));   

	$this->session->set_userdata("sess_cashback_featured",$this->input->post('featured'));   
	$this->session->set_userdata("sess_cashback_popular",$this->input->post('popular'));   
	$this->session->set_userdata("sess_cashback_new",$this->input->post('new'));   
	$this->session->set_userdata("sess_cashback_es",$this->input->post('es'));   

	
         	$admindetails = $this->front_model->getadmindetails();
			$data['admindetails'] = $admindetails;
			$data['result'] = $this->front_model->home_slider();     

              $urisegment=$this->uri->segment(3);
	          $perpage=$this->front_model->getrowsperpage();         
	            $ajax=1;
               $result=$this->front_model->getall_premiumcoupons($perpage,$urisegment,$ajax); 
	       
				if(!$result)  
				{			
					$view="view";  
					$result=$result;   
					$segment="shopping";
					$notfound="No Coupons Are Found";         
					 
				}	  
				else     
				{	 
					$total_rows = $this->front_model->getall_premiumcouponscount($ajax); 
 					$base="shopping";             
					$view="view"; 
					$segment="shopping"; 
					    
				    $this->pageconfig($total_rows,$base);          
 					$result=$this->front_model->getall_premiumcoupons($perpage,$urisegment,$ajax);  					
					 
				}  	
	
	
					
					   if($result!="0")
					   { 
					     
					?>
                    
                <div class="row row-wrap"> 
				   <?php 
				     foreach($result as $fetrest)
					 { 
				            $shoppingcoupon_id=$fetrest->shoppingcoupon_id;
				            $db_offer_name=$fetrest->offer_name;
				            $db_coupon_description=$fetrest->description;
				            $db_coupon_image=$fetrest->coupon_image;
				            $db_expiry_date=$fetrest->expiry_date;
				            $db_cp_price=$fetrest->amount;
							
							 $exp_db_coupon_image=explode(",",$db_coupon_image);  
							 
							   $f_dbcouponfirst_img=$exp_db_coupon_image[0];
							    
								$len_db_offer_name=strlen($db_offer_name);  
								$len_db_coupon_desc=strlen($db_coupon_description);  
						   
						         if($len_db_offer_name>=10)
								 {
								      $f_dbcp_name=substr($db_offer_name,0,9)."..."; 
								 }
								 else
								 {
								     $f_dbcp_name=$db_offer_name; 
								 }

								 if($len_db_coupon_desc>=54)
								 {
								      $f_dbcp_desc=substr($db_coupon_description,0,54)."..."; 
								 }
								 else
								 {
								     $f_dbcp_desc=$db_coupon_description; 
								 } 
								  
								  $getremain_days=$this->front_model->find_remainingdays($db_expiry_date);  
								  
								  // print_r($getremain_days); 
								    // echo "$days days $hours hours remain<br />";  

									
				   ?>  
                        <a class="col-md-4" href="<?php echo base_url(); ?>detailspage/<?php echo $shoppingcoupon_id; ?>">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img width="235" height="195" src="<?php echo base_url(); ?>uploads/premium/<?php echo $f_dbcouponfirst_img; ?>" alt="Image Alternative text" title="Hot mixer" />
                                </header>      
                                <div class="product-inner">
                                    <h5 class="product-title"><?php  echo $f_dbcp_name;  ?></h5>
                                    <p class="product-desciption"><?php echo $f_dbcp_desc;  ?> </p> 
                                    <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> <?php  echo $getremain_days['days']." days ".$getremain_days['hours']." h "." remaining";   ?> </span>   
                                        <ul class="product-price-list">
                                            <li><span class="btn btn-blue"><?php echo DEFAULT_CURRENCY_CODE;?><?php echo " ".$db_cp_price; ?></span> 
                                            </li>
                                            <!--<li><span class="product-old-price">$141</span>
                                            </li>
                                            <li><span class="product-save">Save 63%</span>
                                            </li> -->
                                        </ul>
                                    </div>
                                   <!-- <p class="product-location"><i class="fa fa-map-marker"></i> Boston</p>  -->
                                </div>
                            </div> 
                        </a>
                        <?php 
						 }
						?>
                        
                        
                        
                    </div>
					
					
					<?php 
					  }
					  else
					  {
					?> 
					  
						<div class="alert alert-error">
								<button class="close" data-dismiss="alert">x</button>
								<strong>Oops! </strong>
								 <?php echo $notfound;  ?>
						</div>
					<?php 
					  }
				 if($result!=0)  echo $this->pagination->create_links();     
}  


function pageconfig($total_rows,$base) 
{	 
	$this->input->session_helper();
	$perpage = $this->front_model->getrowsperpage();
	$urisegment=$this->uri->segment(3);
	$this->load->library('pagination');
	$config['base_url'] = base_url().'index.php/cashback/'.$base.'/';    
	$config['total_rows'] = $total_rows;   
	$config['per_page'] = $perpage;
	$config['num_links']=  2; // Number of "digit" links to show before/after the currently viewed page
	$config['full_tag_open'] = '';
	$config['full_tag_close'] = '';
	$config['cur_tag_open'] = '<span class="this-page">&nbsp; <b>';
	$config['cur_tag_close'] = '&nbsp;</b></span>'; 
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';
	$config['prev_link'] = '&laquo;';  
	$config['next_link'] = '&raquo';
	$config['last_tag_open'] = '';
	$config['last_tag_close'] = '';
	$config['next_tag_open']= '&nbsp;';
	$config['next_tag_close']= '&nbsp;';
	$config['prev_tag_open']= '&nbsp;'; 
	$this->pagination->initialize($config); 
	$data['pagination']=$this->pagination->create_links();
	  
}	  
	function detailspage($id,$details=null)
	{
		$this->input->session_helper();
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$data['details']=$details=$this->front_model->details($id);  
		$data['related_products']=$this->front_model->related_products($details->category); 
		$data['popular']=$this->front_model->popular_products();  	
		$data['recently_viewd']=$this->front_model->recently_viewed();  
		$data['recent_reviews']=$this->front_model->recent_reviews($details->shoppingcoupon_id);  	
		$data['reviews']=$this->front_model->reviews($details->shoppingcoupon_id);  
		$data['avg_rating']=$this->front_model->avg_rating($details->shoppingcoupon_id);  	
		$this->load->view('front/detailspage',$data);
	}
	function submit_ratings()
	{
		$inserty = $this->front_model->insert_comments();
		?>
		 <li>
		  <article class="comment">
			<div class="comment-author"> <img  alt="" src="images/review-img.png"> </div>
			<div class="comment-inner">
			  <ul title="4/5 rating" class="icon-group icon-list-rating comment-review-rate">
			  <?php for($i=0;$i< $this->input->post('rating');$i++) { ?>
				<li><i class="fa fa-star"></i> </li>
			  <?php } ?>
			  </ul>
			  <span class="comment-author-name">
			  <?php echo $this->session->userdata('user_email') ?></span>
			  <p class="comment-content"> <?php echo $this->input->post('comments') ?></p>
			</div>
		  </article>
		</li>
		<?php
	}


	function addtocart()
	{
		echo $inserty = $this->front_model->insert_coupon();
	}
	function cart_listing_page()
	{
		$this->input->session_helper();
		/*$this->session->set_userdata("user_id",'1');
		$this->session->set_userdata("user_email","saravanan@osiztechnologies.com"); */  	
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$data['cart']= $this->front_model->getuser_cart();
		$this->load->view('front/cartpage',$data);
	}
	function delete_cart()
	{
		$this->input->session_helper();
		  $query = $this->db->where('id', $this->input->post('id'));
		  $query = $this->db->delete('premium_cart');
		  
		  echo 1;
		  exit;
	}
	function check_amount()
	{
	echo	$admindetails = $this->front_model->check_amount();
	}
	function payusing_site()
	{
		echo $cal=$this->front_model->cal_amount();
	}
	function thankyou()
	{
		$this->input->session_helper();
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
	
		$this->load->view('front/thankyou',$data);
	}
	function PayUmoney()
	{
		echo "<pre>";
		//print_r($this->input->post());exit;
		$data['sub_tot'] =$this->input->post('sub_tot');
		$this->input->session_helper();
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$data['hash_new'] = $txnid;
		$this->session->set_userdata('sub_tot',$this->input->post('sub_tot'));
		$this->session->set_userdata('hash_new',$txnid);
		$id_id = $this->front_model->insert_umoney_order($txnid);
		$this->load->view('front/PayUmoney',$data);
	}
	function Payment_Success()
	{
	
		
		$this->input->session_helper();
		//print_r($_REQUEST);
		$mihpayid=$_REQUEST['mihpayid'];
		$TxnID=$_REQUEST['txnid'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$ipaddress =$_SERVER['REMOTE_ADDR']; 
		$old_id = $_REQUEST['udf1'];
		/*seetha 19.8.2015*/
		$admindetails = $this->front_model->update_pay_u_money($mihpayid,$TxnID,$useragent,$ipaddress,$old_id);
		redirect('thankyou','refresh');
	}
	function Payment_Failure()
	{
		echo 'Error try again';
		exit;
	}
	function orders()
	{
		redirect('cashback','refresh');
		$this->input->session_helper();
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails']= $admindetails;
		$data['result']= $this->front_model->get_orders();
		$this->load->view('front/orders',$data);
	}
	
	function transations()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		// echo $user_id;die;
		if($user_id=="")
		{
			redirect('index','refresh');
		}
		else
		{
			if($this->input->post('submit')) 
			{
				$transations = $this->front_model->transations_bydate($user_id);					
			}
			else
			{
				$transations= $this->front_model->gettransations($user_id);	
			}
			
			 $data['result']= $transations;
			/* echo '<pre>';
			 print_r($data);die;*/
			$this->load->view('front/transations',$data);
		}
	}
	function store_ajax($pagenum,$store_name)
	{
		
		$this->input->session_helper();
		$store_details = $this->front_model->get_store_details($store_name);
		if($store_details)
		{
		$data['store_details'] = $store_details;
		$store_name = $store_details->affiliate_name;
		$store_coupons = $this->front_model->store_ajax($pagenum,$store_name);
		if($store_coupons)	
		{
			$data['store_coupons'] = $store_coupons;
			$data['pagenum'] = $pagenum;
			$user_id = $this->session->userdata('user_id');
			$data['user_id'] = $user_id;
			$this->load->view('front/stores_ajax',$data);
		}
		else
		{
			echo 0;
		}
		}
					
	}
	
	function password_reset($resetpass=null)
	{
				
			$this->input->session_helper();		
			$reset_id = insep_decode($resetpass);
			if($this->input->post('Save'))
			{	
					$user_id = $this->input->post('user_id');
					$res = $this->front_model->reset_password($user_id);
					if($res){
						$this->session->set_flashdata('success', 'Password updated successfully. Please <a href="'.base_url().'login">Login</a> to continue.');
						redirect('password_reset','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while updating your password.');
						redirect('password_reset','refresh');
					}
			}
			else
			{
					$data['user_id'] = $reset_id;
					$this->load->view('front/password_reset',$data);
			}
	
	}
	
	function testt()
	{
		print_r($_POST);
		exit;
	}
		
	function stores_list($categoryurl=null,$sub_categoryurl=null)
	{		
		$this->input->session_helper();
		if($categoryurl==""){
			
			$stores_list = $this->front_model->get_top_stores_list_cate(); //get stores list
			$data['stores_list'] = $stores_list;
			//print_r($stores_list);
			$this->load->view('front/top_stores_all',$data);
			
			//redirect('cashback/index','refresh');    
			// Need to remove this comment
		} 
		else
		{
			$category_details = $this->front_model->get_category_details($categoryurl); // Category details
			if($category_details)
			{
				$category_id= $category_details->category_id;
				$category_name = $category_details->category_name;
				if($sub_categoryurl!="")
				{
					$sub_categorys = $this->front_model->sub_category_details($sub_categoryurl);
					$data['category_details'] = $sub_categorys;
					$data['main_category'] = $category_name;
				}
				else
				{
					$data['category_details'] = $category_details;
					$data['main_category'] = $category_name;
				}
				
				$stores_list = $this->front_model->get_stores_cashback_stores_list_cate($category_id); //get stores list
				$data['stores_list'] = $stores_list;
				//print_r($stores_list);
				$this->load->view('front/top_stores',$data);
			}
			else
			{
				$data['no_records'] = '1';
				$this->load->view('front/no_products',$data);
			}
		}
	}
	function under_maintance()
	{
		$this->input->session_helper();
		$this->load->view('front/under_maintance');		
	}
	
	function downsp()
	{
		$this->input->session_helper();
		$this->load->dbutil();		
		$backup =& $this->dbutil->backup();		
		$this->load->helper('file');
		write_file('/images/mybackup.gz', $backup);		
		$this->load->helper('download');
		force_download('mybackup.gz', $backup);
		unlink('/images/mybackup.gz'); 
	}
	
	function getstores_listjson($query)
	{
		$this->input->session_helper();
		//$query = $this->input->post('query');
		if($query)
		{
			$stores_list = $this->front_model->get_typehead_list($query);
			//print_r($stores_list);
		}
		echo json_encode($stores_list);
	}
	
	
	function getcitys_listjson($query)
	{
		if($query)
		{
			$citys_list = $this->front_model->get_typehead_citys_list($query);
		}
		echo json_encode($citys_list);
	}
	
	function email_subscribe_shoppping(){
		$this->input->session_helper();
		$email = $this->input->post('email');
		$location = $this->input->post('location');
		$this->session->set_userdata('cityname',$location);
		$vars = $this->front_model->email_sub($email);
		$this->security->cookie_handlers();
		redirect('shopping','refresh');
	}
	
	function change_location(){
		$this->input->session_helper();
		$location = $this->input->post('location');
		$this->session->set_userdata('cityname',$location);
		$this->security->cookie_handlers();
		redirect('shopping','refresh');
	}
	
	function profile_pic(){
		$this->input->session_helper();
	        $json = array();
		$new_random = mt_rand(0,99999);
		$files = $_FILES['files']['name'];
		$files = $new_random.$files;
		if($files!="") {
			$files = format_filename($files);  // replaces the non alpha numeric characters with '_'
			$config['upload_path'] ='uploads/user';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['file_name']=$files;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			if($files!="" && (!$this->upload->do_upload('files'))){
				$site_logoerror = $this->upload->display_errors();
			}
			if(isset($site_logoerror)){
				$this->session->set_flashdata('error',$site_logoerror);
				$json['response']=0;
			} else {
				$this->front_model->changeProfilePic($files);
				$json['response']=1;
				$json['content'] = $files;
			}
			echo json_encode($json);
		}
	}
	

	function submit_store_ratings(){
		$this->input->session_helper();
	        $res = $this->front_model->submit_store_ratings();
		if($res){
			echo 1;
		} else {
			echo 0;
		}
	}
	
		// sharmila...
	function myreviews(){	
		$this->input->session_helper();
	    $user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}
		else
		{
			$data['review'] = $this->front_model->get_myreviews();		
			$this->load->view('front/myreview',$data);	
		}
	}
	function click_history(){
		$this->input->session_helper();
	    $user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}
		else
		{
			$data['history'] = $this->front_model->get_history();
			$this->load->view('front/click_history',$data);
		}
	}
	
	/* function coupons_list()
	{
		$this->input->session_helper();
		$fe['couponslist'] = $this->front_model->get_shopping_coupons();	
		$this->load->view('front/mylist',$fe);
	} */
	
	function support()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}
		else
		{
			$fet['messageslist'] = $this->front_model->get_messages();
			$this->load->view('front/support',$fet);
		}
	}

	function support_submit_fro()
	{
		$this->input->session_helper();
	        $this->front_model->insert_support_message();
		$this->session->set_flashdata('msg','<div class="alert alert-success"> 
				Success ! Message sent successfully</div>');
		redirect('support','refresh');
	}

	function remfav($id){
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}
		else
		{
			$id = insep_decode($id);
			$this->db->delete('favorites',array('id'=>$id));
			$this->session->set_flashdata('success', 'Store removed from favorites list.');
			redirect('favorites','refresh');
		}
	}
	
	function broken()
	{
		$this->input->session_helper();
		$this->load->view('front/404');	
	}
	/*Seetha Dec 01*/
	function coupons($categoryurl=null,$sub_categoryurl=null)
	{		
		$this->input->session_helper();
		if($categoryurl==""){
			
			$data['couponslist']= $this->front_model->get_shopping_coupons(); //get coupons list	
			$data['categories'] = $this->front_model->category();			
			$this->load->view('front/coupons',$data);
			
		} 
		else
		{
			$category_details = $this->front_model->get_category_details($categoryurl); // Category details
			if($category_details)
			{
				$category_id= $category_details->category_id;
				$category_name = $category_details->category_name;
				if($sub_categoryurl!="")
				{
					$sub_categorys = $this->front_model->sub_category_details($sub_categoryurl);
					$data['category_details'] = $sub_categorys;
					$data['main_category'] = $category_name;
				}
				else
				{
					$data['category_details'] = $category_details;
					$data['main_category'] = $category_name;
				}
				
				$data['couponslist'] = $this->front_model->get_stores_cashback_coupons_list_cate($category_id); //get stores list
				
				$this->load->view('front/coupons',$data);
			}
			else
			{
				$data['no_records'] = '1';
				$this->load->view('front/no_products',$data);
			}
		}
	}	

	function visit_shop($storeid=null,$couponid=null)
	{
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$store_details = $this->front_model->get_store_details_byid($storeid);
		/*print_r($store_details);
		exit;*/
		if($store_details=='')
		{
				redirect('index','refresh');
		}
		$data['store_details'] = $store_details;
		$store_name = $store_details->affiliate_name;
		$useragent = $_SERVER['HTTP_USER_AGENT']; //seetha 27.8.15
		if($couponid){
			$coupon = $this->front_model->get_coupons_from_coupon_byid($couponid);
			if($coupon=='')
			{
					redirect('index','refresh');
			}
		
			$user_id = $this->session->userdata('user_id');
			if($user_id!='')
			{
				$click_history = $this->front_model->click_history($storeid,$couponid,$user_id,$useragent);
			}
			$data['user_id'] = $user_id;
			$data['coupon'] = $coupon;
		} else {
			$couponid = 0;
			$data['redirect'] = $store_details->logo_url;
			$user_id = $this->session->userdata('user_id');
			if($user_id!='')
			{
				$click_history = $this->front_model->click_history($storeid,$couponid,$user_id,$useragent);
			}
			$data['user_id'] = $user_id;
		}
		$this->load->view('front/visit_shop',$data);
	}

	function getsearch_details($searchkey)
	{
	
		$this->input->session_helper();
		//$query = $this->input->post('query');	
		if($searchkey!='')
		{
			
			$query = $this->db->query("SELECT * FROM (`affiliates`) WHERE `affiliate_status` = '1' AND `affiliate_url` like '%$searchkey%' limit 20");
			$query2 = $this->db->query("SELECT * FROM (`categories`) WHERE `category_status` = '1' AND `category_url` like '%$searchkey%' limit 20");
			/*Seetha Dec 14 2015*/
			$query3 = $this->db->query("SELECT * FROM (`product_categories`) WHERE `category_status` = '1' AND `category_url` like '%$searchkey%' limit 20");
			$query4 = $this->db->query("SELECT * FROM (`brands`) WHERE `brand_status` = '1' AND `brand_url` like '%$searchkey%' limit 20");
			/*Seetha Dec 14 2015*/
			$numrows = $query->num_rows();
			if($numrows==1)
			{	
				redirect('stores/'.$searchkey,'refresh');
			}
			else if($query2->num_rows()==1)	{
				redirect('stores_list/'.$searchkey,'refresh');
			}
			else if($query3->num_rows()==1)	{  //product category
				redirect('products/'.$searchkey.'#category='.$searchkey,'refresh');
			}
			else if($query4->num_rows()==1)	{ //product brands
				redirect('products/'.$searchkey.'#brands='.$searchkey,'refresh');
					
			}
			else{
				redirect('index','refresh');
			}
			
		}
		
	}
	

	/*Seetha Dec 01*/
/*Anand Dec 03*/
	function products($category_url=null,$cat_lev=null){
		$this->input->session_helper();
	if($this->session->userdata('latitude')=='' && $this->session->userdata('langitude')=='')
	{
		redirect('index','refresh');
	}		
		$find ='_brands';
		$keyword = '';
		$keyfind = 'keyword-';
		$O_cate='';
		if($category_url)
		{
			$pos = strpos($category_url, $keyfind);
			if ($pos !== false) {
				$keyword_arr = explode('keyword-',$category_url);
				$keyword = end($keyword_arr);
			}
			$pos = strpos($category_url, $find);			
			if ($pos !== false) {
				$cate_brands = explode('_',$category_url);
			}						
		}
		if($cate_brands[0]){
			
			$category = $this->front_model->product_single_brands($cate_brands[0]);
	
				
				$vals=explode('_',$cat_lev);	
				
			 $val=$vals[0];
			 $level=$vals[1];
			$category1 = $this->front_model->product_single_category($val,$level);
			
			$cate_id = $category->brand_id;	
			 $data['pcate_id']=$category1->cate_id;
			 $O_cate=$category1->cate_id;
		 	  $data['brand_url'] = $cate_brands[0];
			$cate_level ='';
			$category1->category_brands='';
			 $specifications=$this->front_model->product_specification_filter($O_cate);
			
		}
		else if($keyword)
		{
			$cate_id = $keyword;		
			$cate_level ='keyword';
			// $catenae = $this->front_model->find_category_by_name($keyword);
			// print_r($catenae);
			// exit;
			
		}
		else{
			
			$category1 = $this->front_model->product_single_category($category_url);
			 $cate_id = $category1->cate_id;
			$data['brand_url'] = '';
			$cate_level = $category1->category_level;
			
		 $specifications=$this->front_model->product_specification_filter($cate_id);
		}
		
		
		$data['searchword'] = $category_url;
			$data['keyword'] = $keyword;
			$data['category_name'] = $category1->category_name;
			 $data['category_url'] = $category1->category_url;
			 $data['specification'] = $specifications;
			$data['brands'] = $category1->category_brands;
			$data['cate_level_id'] = $cate_level;			
			$data['cate_id_id'] = $cate_id;
			
			$admin_data = $this->front_model->get_admindetails(); // admin details
			$currency = $this->front_model->getallcurrencies_byid($admin_data->default_currency); // get currency symbol
			$data['currency'] = $currency->symbol;
			$data['products'] = $this->front_model->fetch_all_products($cate_id,$cate_level,$limit=NULL,$O_cate,$level);
			$data['products_max_min'] = $this->front_model->fetch_all_products($cate_id,$cate_level,'limit',$O_cate,$level);
			
			$this->load->view('front/products',$data);
	}
	
	function products_pagination($category_url=null){
		$this->input->session_helper();
		$a = $this->input->post('brands');		
		$find ='_brands';
		$keyword = '';
		$keyfind = 'keyword-';
		$level='';
		$val=$this->input->post('type');
		if($val)
		{
		 $cat_val=explode('#',$this->input->post('type'));
		 $cats=explode('_',$cat_val[1]);
		 $cat=$cats[0];
		 $level=$cats[1];
		}
		else
		{
		$cat='';	
		}
		
		
		if($category_url)
		{
			$pos = strpos($category_url, $keyfind);
			if ($pos !== false) {
				$keyword_arr = explode('keyword-',$category_url);
				$keyword = end($keyword_arr);
			}
			$pos = strpos($category_url, $find);			
			if ($pos !== false) {
				$cate_brands = explode('_',$category_url);
			}						
		}
		if($cate_brands[0]){
			$category = $this->front_model->product_single_brands($cate_brands[0]);
			
			$category1 = $this->front_model->product_single_category($cat,$level);
			$cate_id = $category->brand_id;	
			$O_cate=$category1->cate_id;			
		 	$data['brand_url'] = $cate_brands[0];
			$cate_level ='';
			
		}
		else if($keyword)
		{
			$cate_id = $keyword;		
			$cate_level ='keyword';
		}
		else{
			
			$category = $this->front_model->product_single_category($category_url);
			$cate_id = $category->cate_id;
			$data['brand_url'] = '';
			$cate_level = $category->category_level;
		}
			$data['keyword'] = $keyword;		
			$data['category_name'] = $category->category_name;		
			$admin_data = $this->front_model->get_admindetails(); // admin details
			$currency = $this->front_model->getallcurrencies_byid($admin_data->default_currency); // get currency symbol
			$data['currency'] = $currency->symbol;	
			$data['point_limit']=$this->front_model->get_reward_points();			
			$result = $this->front_model->fetch_all_products($cate_id,$cate_level,$limit=NULL,$O_cate,$level);
			if($result){
				$data['products'] = $result;
				if($this->input->post('specify')!="")
				{
				$data['specis']=$this->input->post('specify');
				}
				$this->load->view('front/ajax_product_list',$data);
			}
			else{
				echo '0';
			}
	}


	function compare_products($compare_product){
		$this->session->unset_userdata('compare_data');
		$this->input->session_helper();
		$count_product = count(explode(',',$compare_product));
		//$product_ids = $this->input->post('product_ids');
		$category_url = $this->input->post('category_url');
		//$count_product = count(preg_grep('~^[0-9]$~', str_split($product_ids)));
		
		$product_list = $this->front_model->compare_products($compare_product);
		
		if(!$compare_product){
			redirect('index','refresh');
		}else if($count_product < 2){
			redirect('products/'.$category_url,'refresh');
		}else if(!$product_list){
			redirect('products/'.$category_url,'refresh');
		}else{
			$data['products'] = $product_list;
			$this->load->view('front/product_compare',$data);
		}
	}
	
	
	
	/*Anand Dec 03*/
       	/* Seetha Dec 04 */
	function category($category_url)
	{
		
		$data =array();	
		if($category_url)
		{
			$get_catid = $this->front_model->get_categoryid($category_url);
			
			if($get_catid)
			{
				$data['categoryid']=$get_catid->cate_id;
				$data['product_categorydetails']=$this->front_model->get_productsubcategory_details($get_catid->cate_id);
			}
			
		}
		
		$this->load->view('front/category',$data);
	}
	
	/* Seetha Dec 04 */
    /* Seetha Dec 11 2015 */
	function brands()
	{
		$this->input->session_helper();
		$data['allbrands'] = $this->front_model->get_topbrans();
		$this->load->view('front/brands',$data);
	}
	/* Seetha Dec 11 2015 */
	/* Seetha Dec 14 2015 */
	function rewards()
	{
		$this->input->session_helper();
		$data['getrewardsdetails']= $this->front_model->getexciting_rewards(8);		
		$this->load->view('front/rewards',$data);
	}
	function redemption()
	{
		
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		$data['get_redemption']= $this->front_model->getexciting_rewards(8);
		$data['get_min_redeem']= $this->front_model->get_min_rewards(8);	
			$data['user_type']=$this->front_model->get_us_pawd($user_id);
		$this->load->view('front/redemption',$data);
	}
	/* Seetha Dec 14 2015 */
	
	
	/* Nathan Dec 15 2015 */
	
		function product_details($product_url=null){
		$this->input->session_helper();		
		if($this->session->userdata('latitude')=='' && $this->session->userdata('langitude')=='')
	{
		redirect('index','refresh');
	}
		$details = $this->front_model->fetch_product_details($product_url);
		/* ganesh bread crump feb 23*/
		$bcmps=$this->front_model->fetch_bread_crump($product_url);
		$user_id = $this->session->userdata('user_id');
		 $lat=$this->session->userdata('latitude');
		 $lng=$this->session->userdata('langitude');
		/* ----*/
		if(!$details){
			redirect('index','refresh');
		}else{
			if(isset($details->child_id)&&$details->child_id!=0)
			{
				$data['cate_level_id'] = 2;			
				$data['cate_id_id'] = $details->child_id;
			
				
			}
			else if(isset($details->parent_child_id)&&$details->parent_child_id!=0)
			{
				$data['cate_level_id'] = 1;	
				$data['cate_id_id'] = $details->parent_child_id;
			}
			else
			{
				$data['cate_level_id'] = 0;	
				$data['cate_id_id'] = $details->parent_id;
			}
			if($details->removed_lists!='')
			{
			$remove_list=explode(',',$details->removed_lists);
			}
			//print_r($remove_list);
			$get_price_compare=$this->front_model->get_price_compare($details->parent_child_id);
			 $data['price_compare']=$details->price_compare;
			 $data['act_store']=unserialize($get_price_compare->active_store);
			 if($remove_list!='')
			 {
			$data['act_store']=array_diff($data['act_store'],$remove_list);
			 }
			 		
			$product_id = $details->product_id;
			$getminprice_row = $this->front_model->getmin_price_product($product_id);
			$store_id = $getminprice_row->store_id;			
			$brandid = $details->brands;
			$data['reward_point']=$this->front_model->get_reward_points();
			$get_branddetails = $this->front_model->get_details_from_id($brandid,'brands','brand_id');
			$data['minprice_details']=$getminprice_row;
			$data['gallery'] = $this->front_model->fetch_product_gallery($product_id);
			$data['comparison_details'] = $this->front_model->comparison_details($product_id);
			$data['min_details']=$this->front_model->min_comparison_details($product_id); 
			//print_r($data['min_details']);die;
			$storedetails =  $this->front_model->get_store_details_byid($store_id);
			$data['store'] = $storedetails;
			$default_currency = $this->session->userdata('default_currency');
			$data['currency'] = $default_currency;
			$data['product'] = $details;
			$data['bcmps']=$bcmps;
			$data['cate_id']=$details->parent_child_id;
			$data['user_id']=$user_id;
			$data['brandslist'] = $get_branddetails;
			$data['latestproducts']  = $this->front_model->latestproducts();
			$avgrate  =$this->front_model->avg_reviews_rating($data['product']->product_id);
			$data['avgrate']  = $avgrate;
	 		$data['count_rating']  =$this->front_model->count_rating($data['product']->product_id);
			$data['pro_url'] = $product_url;
		    $data['get_offline_stores']  =$this->front_model->get_offline_stores($data['product']->product_id);
			//print_r($data['get_offline_stores']);die;
		    $data['get_offline_price']  =$this->front_model->get_offline_price($data['product']->product_id);
			 // print_r($data['comparison_details']);
			 // exit;
			$this->load->view('front/product_detail',$data);
		}
	}
	
	function pricealert()
	{
			$this->security->cookie_handlers();
			$email = $this->input->post('priceemail');
			$product_id = $this->input->post('product_id');
			$mobile_number = $this->input->post('priceemobile');
			$vars = $this->front_model->pricealert($email,$product_id,$mobile_number);	
			// echo $vars;
			if($vars){
				echo 1;
			}
			else
			{
				echo 0;
			}
	}
	
	function scrapping_sort()
	{
		$sortdefaltval = $this->input->post('sort_default');
		$filters = $this->input->post('filters');
		$a = 1;
		if($filters)
		{
			 $a = 0;
		}
		$data['sort'] = $a;		
		$product_id = $this->input->post('product_id');
		
		$comp  = $this->front_model->comparison_details($product_id,$sortdefaltval);
		$prodetails = $this->front_model->get_details_from_id($product_id,'products','product_id');
		$data['product'] = $this->front_model->fetch_product_details($prodetails->product_url);
		if($comp)
		{
			$data['comparison_details'] = $comp;
			$this->load->view('front/product_scrapping_ajax',$data);
		}
		return 0;
	}
	
	function create_product_json($product_id,$callback=NULL)
	{
		$callback =  $this->input->get('callback', TRUE);
		
		
		if (!$callback) $callback = 'callback';
		$productjason_array  = $this->front_model->create_product_json($product_id);
		/*$json='[';*/
		foreach($productjason_array as $jsona)
		{
			// $prodate = $jsona->date;
			$prodate = explode(',',$jsona->date);
			$month = $prodate[1]-1;
		    $prodate = str_replace(','.$prodate[1].',', ','.$month.',', $jsona->date);
			$price = $jsona->price;
			$jsons[] ='['.$prodate.','.$price.']';			
		}
		// $json = implode(',',$jsons);
		$json = "[".implode(',',$jsons)."]";

		/*exit;*/
		/*$respledd = trim($json,',');
		$respledd .=']';*/
		//$json = '[[Date.UTC(2013,5,2),0.7695],[Date.UTC(2013,5,3),0.7648],[Date.UTC(2013,5,4),0.7645],[Date.UTC(2013,5,5),0.7638]]';

		header('Content-Type: text/javascript');
		echo "$callback($json);";
	}
	
	
	/* Nathan Dec 15 2015 */
	/* Seetha Dec 16 2015 */
	function visit_product($pp_id=null,$productid=null)
	{
		$pp_details = $this->front_model->get_details_from_id($pp_id,'product_price','pp_id');
		$storeid =$pp_details->store_id; 
		$price=$pp_details->product_price;
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$store_details = $this->front_model->get_store_details_byid($pp_details->store_id);
		
		if($store_details=='')
		{
				redirect('index','refresh');
		}
		$data['store_details'] = $store_details;
		$store_name = $store_details->affiliate_name;
		$useragent = $_SERVER['HTTP_USER_AGENT']; //seetha 27.8.15
		if($productid){
			$product = $this->front_model->get_products_from_product_byid($productid);
			if($product=='')
			{
					redirect('index','refresh');
			}
		
			$user_id = $this->session->userdata('user_id');
			if($user_id!='')
			{
				$click_history = $this->front_model->productclick_history($storeid,$productid,$user_id,$useragent,$price);
			}
			$data['user_id'] = $user_id;
			$data['product'] = $product;
			$data['scrappingdetails'] = $pp_details;
		} else {
			$productid = 0;
			$data['redirect'] = $store_details->logo_url;
			$user_id = $this->session->userdata('user_id');
			if($user_id!='')
			{
				$click_history = $this->front_model->productclick_history($storeid,$productid,$user_id,$useragent,$price);
			}
			$data['user_id'] = $user_id;
		}
		$this->load->view('front/visit_product',$data);
	}
	function pending_transactions($status=null)
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{	
			$data['status'] = $status;
			$data['result'] = $this->front_model->pending_transactions($user_id);
			$this->load->view('front/pending_transactions',$data);
		}
		$this->security->cookie_handlers();
	}
	/*ganesh 12-3-2016*/
	function remove_ptrs($pid=null)
	{
		echo $de_pid = base64_decode($pid);
		$delete=$this->front_model->remove_ptrs($de_pid);
		if($delete)
		{
			redirect('pending_transactions','refresh');
		}
	}
	function submit_product_ratings()
	{		
	
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} else
		{	
			if($this->input->post('submit')) 
			{			
				$result = $this->front_model->submit_product_ratings();
				if($result)
				{
					echo 1;					
				} 
				else {
					echo 0;
				}					
			}		
			$cookiehandlers = $this->security->cookie_handlers();
		}
	}
	function submit_questions()
	{			
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} else
		{	
			if($this->input->post('question')) 
			{		
				$result = $this->front_model->submit_questions();
				if($result)
				{
					echo 1;					
				} 
				else {
					echo 0;
				}					
			}		
			$cookiehandlers = $this->security->cookie_handlers();
		}
	}
	
	/* Seetha Dec 16 2015 */
    /* Seetha Dec 23 2015 */
	function add_favorite(){
		$this->input->session_helper();
	        $res = $this->front_model->add_favorite($this->input->post('product_id'));
		if($res){
			echo 1;
		} else {
			echo 0;
		}
	}
	//gaensh 
	function remove_favorite(){
		$this->input->session_helper();
	        $res = $this->front_model->remove_favorite($this->input->post('product_id'));
		if($res){
			echo 1;
		} else {
			echo 0;
		}
	}
	function favorites()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id=="")
		{
			redirect('index','refresh');
		}
		else
		{
			$fet['favoriteslist'] = $this->front_model->get_favorites();
			$this->load->view('front/favorites',$fet);
		}
	}
	/* Seetha Dec 23 2015 */
       
	 function searchproducts()
	{
		$cate_id = $this->input->post('cate_id');
		$cate_level = $this->input->post('catpos');
		$keyword = $this->input->post('term');
		if(trim($cate_id)!=""&&trim($cate_level)!=""&&trim($keyword)!="")
		{
			echo $prolist = json_encode($this->front_model->searchproducts());
		}
		
		
	  }


	function product_index()
	{
		$this->input->session_helper();		
		$cookiehandlers = $this->security->cookie_handlers();
		$admindetails = $this->front_model->getadmindetails();
		$data['admindetails'] = $admindetails;
		$data['result'] = $this->front_model->home_slider();
		$data['scrapping_list']=$this->front_model->scrapping_list();
		$data['topbrands'] = $this->front_model->topbrands_index(12);
		$data['latestproducts']  = $this->front_model->latestproducts();
		$data['top_products_home'] = $this->front_model->top_products_home(20003);
		$data['pagename'] = "index";
		$this->load->view('front/index1',$data);
		$cookiehandlers = $this->security->cookie_handlers();
	}  
          
      
	  //ganesh feb25
	   function comparision_products()
	  {
		
		  
			   
			   // $compare_product = array();
			   if(!$this->session->userdata['compare_data']['product_id'])
			   {
				   $product_id = $this->input->post("product_id");
				$title = $this->input->post("title");
				$price = $this->input->post("price");
				$img_url = $this->input->post("img_url");
				$link_url = $this->input->post("link_url");
				$link_set_url = $this->input->post("link_set_url");
				
						   $compare_product = array(
							'product_id' => $product_id,
						   'title' => $title,
						   'price' => $price,
						   'img_url' => $img_url,
						   'link_url'=>$link_url,
						   'link_set_url'=>$link_set_url
										);
			$this->session->set_userdata('compare_data',$compare_product);
			
			   }
			   else{
				    $product_id = $this->session->userdata['compare_data']['product_id'].','.$this->input->post("product_id");
					$title = $this->session->userdata['compare_data']['title'].','.$this->input->post("title");
					$price = $this->session->userdata['compare_data']['price'].';'.$this->input->post("price");
					$img_url = $this->session->userdata['compare_data']['img_url'].','.$this->input->post("img_url");
					$link_url = $this->session->userdata['compare_data']['link_url'].','.$this->input->post("link_url");
					$link_set_url = $this->session->userdata['compare_data']['link_set_url'].','.$this->input->post("link_set_url");
					
					$compare_product = array(
							'product_id' => $product_id,
						   'title' => $title,
						   'price' => $price,
						   'img_url' => $img_url,
						   'link_url'=>$link_url,
						   'link_set_url'=>$link_set_url
										);
										$this->session->set_userdata('compare_data',$compare_product);
				   
			   }
			
			print_r($this->session->userdata('compare_data'));
			
	  }

        	function codes($store_name,$coupon_id)
	{
		$this->input->session_helper();
		if($store_name=="")
		{
			redirect('index','refresh');    
		} 				
		$store_details = $this->front_model->get_store_details($store_name);
		if($store_details)
		{
			$data['store_details'] = $store_details;
			$store_name = $store_details->affiliate_name;		
			$all_store_coupons = $this->front_model->get_coupons_api($store_name,$coupon_id); 
			$data['coupons'] = $all_store_coupons;
			$user_id = $this->session->userdata('user_id');
			$data['user_id'] = $user_id;
			$this->load->view('front/new_design',$data);
		}
		
	}

    //   19/03/2016...
    
        function otp_request()
    {
    	// echo 'vhjffg';die;
    	if($this->input->post('complete'))
    	{	
    		$result = $this->front_model->otp_request();
    		if($result)
    		{
    			redirect('login','refresh');
    		}
    		else
    		{
    			$this->session->set_flashdata('error','Please Enter valid Password details');
    			redirect('complete','refresh');
    		}
    	}
    }

    function resend_otp()
    {
    	if($this->input->post('id'))
    	{
	    	 $mail_id = $this->input->post('id');
	    	$new_random = mt_rand(1000000,99999999);
	    	$result = $this->front_model->resend_otp($mail_id,$new_random);
    	if($result)
    	{
    		redirect('login','refresh');
    	}
    	else
    	{
    		$this->session->set_flashdata('error','Please Enter valid Password details');
    			redirect('complete','refresh');
    	}
    }
    } 

//22/03/2016...

       function paysalable_coupons($coupon_id='')
    {
       	$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{	
			$data['coupon_id'] = $this->front_model->coupon_detalis($coupon_id);
			
		    $data['user_details'] = $this->front_model->user_details($user_id);
			$data['offline_user']=$this->front_model->offline_user_details($data['coupon_id']->store_id);
		    $store = $data['coupon_id']->store_location;
		   	$data['store_address']=$this->front_model->offline_store_address($store);
		   	$data['store_name'] = $this->front_model->store_Name($store);
			$this->load->view('front/coupon_details',$data);
			// $this->load->view('front/withdrawpayu',$data);
		}
		$this->security->cookie_handlers();
    }

    function success_withdraw($coupon_id='')
    {
		
    //	 echo '<pre>';
    	//print_r($this->input->post());
    	 extract($_REQUEST);
    	$res=$this->input->post();
	if($res['status']=='success')
			{
				$transation_status='Paid';
			}
	else
			{
				$transation_status='Pending';
			}
		    	$data = array(
									'payid' => $res['mihpayid'],
									'transation_status' => $transation_status,
									'txn_id' => $res['txnid'],
									'user_id'=>	$this->session->userdata('user_id'),
									'transation_reason'=>'Salable Amount',
									'transation_amount'=>$res['net_amount_debit'],
									'mode'=>'Credited',
									'transation_date'=>$res['addedon']
								);
				$res = $this->db->insert('transation_details',$data);
				// redirect('cashback/salable_coupons','refresh');
			if($res)
			{
				$txn_id = $this->db->insert_id();
				 $coupon_id = base64_decode($coupon_id);
				$user_id = $this->session->userdata('user_id');
				/*$data = array('txn_id'=>$txn_id,'coupon_id'=>$coupon_id,'user_id'=>$user_id);
				$this->db->insert('salable_coupon',$data);*/
				$user = $this->front_model->user_details($user_id);
				$user_email = $user->email;
				$coupon_code = $this->generate_random_password();
				$random_code = $coupon_code;
				$data = array('txn_id'=>$txn_id,'coupon_id'=>$coupon_id,'user_id'=>$user_id,'coupon_code'=>$random_code,'date_added'=>date('Y-m-d h:i:s'));
				$this->db->insert('salable_coupon',$data);
				// echo $coupon_id;die;
				$ver = $this->front_model->salable_coupon_detals($coupon_id,$random_code);
				// $ver = $this->front_model->coupon_detalis($coupon_id);
				/* mail for salable coupon */
				$this->db->where('admin_id',1);
				$admin_det = $this->db->get('admin');
				if($admin_det->num_rows >0) 
				{    
					$admin = $admin_det->row();
					$admin_email = $admin->admin_email;
					$site_name = $admin->site_name;
					$admin_no = $admin->contact_number;
					$site_logo = $admin->site_logo;
				}
				 
				$date =date('Y-m-d');
				
				$this->db->where('mail_id',13);
				$mail_template = $this->db->get('tbl_mailtemplates');
				if($mail_template->num_rows >0) 
				{
				   $fetch = $mail_template->row();
				   $subject = $fetch->email_subject;
				   $templete = $fetch->email_template;
				   // $this->load->library('email');
					/*$config = Array(
						'mailtype'  => 'html',
						'charset'   => 'utf-8',
					);*/
					
					$sub_data = array(
						'###SITENAME###'=>$site_name
					);
					$subject_new = strtr($subject,$sub_data);
					// echo $subject_new;die;
					// $this->email->initialize($config);
					 /*$this->email->set_newline("\r\n");
					   $this->email->initialize($config);
					   $this->email->from($admin_email);
					   $this->email->to($user->email);
					   $this->email->subject($subject_new);*/
				   
					$data = array(
						'###NAME###'=>$user_name,
						'###COMPANYLOGO###' =>base_url()."uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
						'###AMOUNT###'=>$ver->amount,
						'###CODE###'=>$ver->code
				    );
				   
				   $content_pop=strtr($templete,$data);
				   // echo $content_pop; die;
				   // echo $subject_new;
				   /*$this->email->message($content_pop);
				   $this->email->send();  */

				 $this->front_model->mail_function($admin_email,$user_email,$subject_new,$content_pop);
				   
				}

				
				/* mail for salable amount */				
			}	
			redirect('salable_coupons','refresh');	
											
		    //	exit;
		  
								
			
		    }

	function salable_coupons()
    {
    	$data['couponslist']= $this->front_model->get_salable_coupons();
    	$this->load->view('front/salable_coupons',$data);
    }
    
    
    //24/03/2016..
    
    function coupons_result()
    {
    	$user_id = $this->session->userdata('user_id');
    	$coupon_results = $this->input->post('coupon_results');
		$cate_name = $this->input->post('cate_types');
		
		$this->db->where('category_url',$cate_name);
		$ctypes=$this->db->get('categories');
		if($ctypes->num_rows()>0)
		{
			$cate_ids=$ctypes->row('category_id');
			$this->db->where('category_name',$cate_ids);
		}
		
		
    	if($coupon_results!='')
    	{
    		// echo 'fjgfjk';die;
    		$coupon_results=$coupon_results;
			$this->db->like('offer_name',$coupon_results);
    	}
    	

    	
		
    	$this->db->where('coupon_status','1');
    	$this->db->where('coupon_type','');
    	$ver = $this->db->get('coupons');
		/* echo $this->db->last_query();
    	 exit; */
    	if($ver->num_rows()>0)
    	{

    		$result = $ver->result();
    		/*echo '<pre>';
    		print_r($result);
    		die;*/
    		$kt=1;
    		foreach($result as $rows)
    		{
    			$coupon_id = $rows->coupon_id;
    			 $store_details =$this->front_model->get_Storedetails($rows->offer_name);
		          if($store_details)
		          {
		            $affiliate_name = $store_details->affiliate_name;
		            $affid = $store_details->affiliate_id;
		            $setup =  strtoupper($affiliate_name[0]);
		            
		            if($store_details->affiliate_logo!='')
		            {
		              $img_url =base_url().'uploads/affiliates/'.$store_details->affiliate_logo;
		            }
		            else{
		              $img_url =base_url().'front/img/rsz_default.jpg';
		            }
		    		}
		    		$title = $rows->title;
		    		$descrition = $row->descrition; ?>

<div class="col-sm-6 col-md-4 col-xs-12 isotope-item <?php echo $setup;?>">

	  <div class="item first products-grid stores-bg" style="min-height:320px;">                   
		  <div class="_item first product-col">
			<div class="wrap-item">
			  <div class="product-block">
				<div class="image ">
				  <div class="product-img img">
					<?php
					  if($user_id!='')
					{
						// echo $user_id;die;
						?>
         

					<a href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>" target="_blank;" class="product-image img after_login" title="<?php echo $affiliate_name;?>" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
           
					  <img style="height:50px;width:111px;" src="<?php echo $img_url;?>"  class="img-responsive center-block">
					</a>
					
					<a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a> 
					  <?php
					  }else
					  {
					  	// echo 'ghfkjghk';die;
					  	?>
             
             
						<a href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>"  target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" class="product-image img dsf" title="<?php echo $affiliate_name;?>" showcoupon_id="<?php echo $coupon_id;?>">
              
						<img style="height:50px;width:111px;"  src="<?php echo $img_url;?>"  class="img-responsive center-block"></a>
						<a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
					  <?php 
					  } ?>
				  
					<p class="text-center mar-top"><span class="price "><?php echo $affiliate_name;?></span> </p>
				  </div>
				</div>
				<div class="product-meta product-shop">
				  <h3 class="product-name name">
	<?php
	if($user_id!='')
	{?>
	  <a class="after_login" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>" target="_blank;" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
       <?php echo substr($title,0,44); ?>
    </a>

	  <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;">
	  </a>  
	<?php
	}
	else{
	?>
	  <a class="dsf" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id; ?>" target="_blank" data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>">
       <?php echo substr($title,0,44); ?>
      
    </a>

	  <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 
	<?php
	}
	?>
	</h3>                              
				   <div class="cart mar-top">
<?php
	
if($rows->type=='Promotion')
{
	if($user_id!='')
	{
?>                  

	  <a class="after_login" href="<?php echo base_url(); ?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupons->coupon_id;?> "  target="_blank" title="<?php echo $affiliate_name;?>"   data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">

	  <button type="button" title="Add to Cart" class="btn btn-primary bor-rad-no btn-block mar-bot">Activate Deal</button>
	  </a>

	  <a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;">
	  </a>

	<?php
	}else{
	?>

            <a class="dsf" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id;?>" target="_blank" title="<?php echo $affiliate_name;?>"data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>">

            <button type="button" title="Add to Cart" class="btn btn-primary bor-rad-no btn-block mar-bot">Activate Deal</button>
            </a>

          <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a> 

	  
	   
			<?php
			}
		}

		else{

		  if($user_id!='')
		  { ?>
		      
			      <a class="after_login" href="<?php echo base_url(); ?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id;?>/coupons"  target="_blank" title="<?php echo $affiliate_name;?>"  data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" show_id="<?php echo $coupon_id;?>">
				      
			        <button type="button" class="btn btn-primary bor-rad-0 btn-block mar-bot">Show Code</button>
			        </a>   
							<a href="javascript:;" data-target="#myModal_visit_store<?php echo $coupon_id;?>" data-toggle="modal" id="show_modal_<?php echo $coupon_id;?>" style="display:none;"></a>  
           

		  <?php
		  }else{
         
		  ?>
					  <a class="dsf" href="<?php echo base_url();?>codes/<?php echo $store_details->affiliate_name; ?>/<?php echo $coupon_id;?>" target="_blank" title="<?php echo $affiliate_name;?>"data-id="<?php echo base_url();?>visit_shop/<?php echo $affid;?>/<?php echo $coupon_id;?>" showcoupon_id="<?php echo $coupon_id;?>">
					  <button type="button" title="Add to Cart" class="btn btn-primary bor-rad-no btn-block mar-bot">Show Code</button>
					  </a>  
					  <a href="javascript:;" data-target="#LoginModal<?php echo $coupon_id;?>" data-toggle="modal" id="show_loginmodal_<?php echo $coupon_id;?>" style="display:none;"></a>                 
              

				  <?php
				   }       

				}
				?>
				  </div>
				  <div class="action">
					<p class="wishlist text-center">
					<a class="btn btn-danger bor-rad-0 btn-block" data-target="#myModal_<?php echo $store_details->affiliate_url;?>" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-heart-o"></i>About Store</a> </p>
				</div>
				</div>
			  </div>
			</div>
		  </div>
	   </div>
	  </div>

		    <?php 
		    $kt++;
		}
		}
    	else
    	{?>
    		
			<div class="alert alert-info bs-alert-old-docs" style="margin-left:30px; margin-right:30px;">
                <center>
                  <strong>No  Results  Found!!!</strong>
                </center>
            </div>
    	<?php }
  }


//26/03/2016

 function get_city()
  {
  	// echo 'hgfjkhgk';
  		$cat_id = $this->input->post('cat_id');
		$result = $this->front_model->get_city($cat_id);
		//print_r($result);
		
		$input = '';
		if($result)
		{
			$input .='<option value=""> Select </option>';
			foreach($result as $name){
				$input .= '<option value="'.$name->id.'">'.$name->state_name.'</option>';
			}
		}
		else
		{
			$input .='false';
		}
			echo $input;
  }

  function get_state()
  {
  		$cat_id = $this->input->post('cat_id');
		$result = $this->front_model->get_statess($cat_id);
		//print_r($result);
		
		$input = '';
		if($result)
		{
			$input .='<option value=""> Select </option>';
			foreach($result as $name){
				$input .= '<option value="'.$name->id.'">'.$name->city_name.'</option>';
			}
		}
		else
		{
			$input .='false';
		}
			echo $input;
  }

  function offline_login()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id!="")
		{
			 redirect('view_stores','refresh');
		} 
		else 
		{
			$this->load->view('front/offline_login','refresh');
		}
		$cookiehandlers = $this->security->cookie_handlers();
	}


	function offline_chk_invalid()
	{		
		if($this->input->post('signin')) 
		{
				$result = $this->front_model->offline_login();
				if($result==0)
				{
					$data['invalid_login']='Invalid username and password.';
					$this->load->view('front/offline_login',$data);
				} 
				else if($result==2)
				{
					$data['invalid_login']='Your account is de-activated.';
					$this->load->view('front/offline_login',$data);
				}
				else{
					$this->session->unset_userdata('user_id');
					redirect('view_stores','refresh');
				}
			}
			else
			{
				redirect('offline_login','refresh');
			}
			$cookiehandlers = $this->security->cookie_handlers();
	}  
 	//splendidsharmi@gmail.com
	function offline_logincheck(){
		$this->input->session_helper();
		if($this->input->post('signin')) 
		{
			// echo 'dfdjkfdkj';die;
				$result = $this->front_model->offline_login();
				if($result==0)
				{
					echo "Invalid username or password";
					
				} 
				else if($result==2)
				{
					echo "Your account is de-activated.";
				}
				else{
					$this->session->unset_userdata('user_id');
					echo 1;
					//redirect('cashback/myaccount','refresh');
				}
			}
			else
			{
			redirect('offline_login','refresh');
			}
			$this->security->cookie_handlers();
	}

	/*function psss()
	{
		$this->load->view('front/offline_products');
	}*/

	// offline_change_password

	function offline_change_password()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		//echo $user_id;
		if($user_id==""){
			redirect('index','refresh');
		} else 
		{
			if($this->input->post('save'))
			{
				// echo 'ghfkjhgjk';die;
				// echo $user_id;die;
			$result = $this->front_model->offline_update_password($user_id);
				if($result){
					// echo 'dfdhf';die;
					$this->session->set_flashdata('success', 'Password changed successfully.');
					redirect('offline_change_password','refresh');
				}
				else
				{
					// echo 'fghfjkghfj';die;
					$this->session->set_flashdata('error', 'Old Password did not match.');
					redirect('offline_change_password','refresh');
				}
			}	
		}
		$this->load->view('front/offline_change');
		$cookiehandlers = $this->security->cookie_handlers();
	}

	function offline_products()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		//echo $user_id;
		if($user_id=="")
		{
			redirect('index','refresh');
		} else
		{
			$data['main_category'] = $this->front_model->product_categories('0');
			/* echo '<pre>';
			 print_r($data);die;*/
		    // $data['products'] = $this->front_model->get_products();
			$this->load->view('front/offline_products',$data);
		}
	}
/*
	function get_products()
	{
		$parent_id = $this->input->post('id');
		$parent_child_id = $this->input->post('parent_child_id');
		// $child = $this->input->post('child');
		
		if($parent_id!='')
		{
			$result = $this->front_model->get_offline_products($parent_id,$parent_child_id);
			$input = '';
			if($result)
			{
				$input .='<option value=""> Select </option>';
				foreach($result as $name)
				{
					$input .= '<option value="'.$name->product_id.'">'.$name->product_name.'</option>';
				}
			}
			else
			{
				$input .='false';
			}
				echo $input;

		}
	}*/

	function offline_check_email()
	{
		
		$email = $this->input->post('email');
		$result = $this->front_model->offline_check_email($email);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
		$cookiehandlers = $this->security->cookie_handlers();
	}
	
	function offline_register()
	{	
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id!="")
		{
			redirect('myaccount','refresh');
		}
		if($this->input->post('register'))
		{
			
			 $data['reg_val']=array(
				'f_name'=>$this->input->post('first_name'),
				'email'=>$this->input->post('user_email'),
				'lname'=>$this->input->post('last_name'),
				'uname'=>$this->input->post('user_name'),
				'phone'=>$this->input->post('contact'),
				'badd'=>$this->input->post('buisness_address')

				); 
				$data['country'] = $this->front_model->get_allcounties();
			// echo 'dfdjhgf';die;
			if($this->input->post('first_name')=="" || $this->input->post('user_email')=="" || $this->input->post('user_pwd')=="" || $this->input->post('pwd_confirm')=="")
			{
				
				$this->session->set_flashdata('error','Please fill all the fields.');
				//redirect('offline_register/','refresh');
				$this->load->view('front/offline_reg',$data);
				return false;
			} 
			else 
			{
				 //echo 'jfhgjkf';die;
				$category_image = $_FILES['document_upload']['name'];
				
				// echo $category_image;die;
				if($category_image!="") 
					{
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/document';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('document_upload')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								
								//redirect('offline_register','refresh');
								$this->load->view('front/offline_reg',$data);
								return false;
							}
					}

			   $ins_qry = $this->front_model->offline_register($category_image);
			   if($ins_qry)
				{	
					$this->session->set_flashdata('success','Registration Completed Successfully and Waiting for Approval!!!');
					redirect('offline_register','refresh');
					 // redirect('cashback/add_offlinestores','refresh');
				}
				else
				{
					$this->session->set_flashdata('error','Errors occurs while adding users details.');
					redirect('offline_register','refresh');
				} 
			}	
		} 
		$cookiehandlers = $this->security->cookie_handlers();
		$data['country'] = $this->front_model->get_allcounties();
		$this->load->view('front/offline_reg',$data);
	}

	function add_offlinestores()
	{
		// echo $this->input->post('register');die;
		if($this->input->post('register'))
		{
					$store_image = $_FILES['store_image']['name'];
					if($store_image!="") 
					{
						$new_random = mt_rand(0,99999);
						$store_image = remove_space($new_random.$store_image);
						$config['upload_path'] ='uploads/offline_stores';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$store_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($store_image!="" && (!$this->upload->do_upload('store_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('add_offlinestores','refresh');
							}
					}
			$result = $this->front_model->add_offlinestores($store_image);	
			if($result)
			{
				$this->session->set_flashdata('success','Store Details Added Successfully');
				redirect('view_stores','refresh');
			}
			else
			{
				$this->session->set_flashdata('error','Error occurred While Adding Store Detalis');
				redirect('add_offlinestores','refresh');	
			}
		}
		$this->load->view('front/add_offlinestores');
	}

	function get_sub_categories()
	{
		$prop_id = $_REQUEST['val'];
		// echo $prop_id;die;
	    $main_service = $this->front_model->get_subcategory_types($prop_id);  
	    // echo '<option value="">Select the Subcategories</option>';
	    foreach($main_service as $val)
	    {
	     echo '<option value='.$val->cate_id.'  name="'.$val->category_name.'">'.$val->category_name.'</option>';
	    }       
	}

	function view_stores()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{	
			$data['result'] = $this->front_model->view_stores();
			 // print_r($data['result']);die;
			$this->load->view('front/view',$data);
		}
		$this->security->cookie_handlers();
	}

 

    function ajax_morelatdiv()
    {  
    	$data['nextval']=$this->input->post('nextval');  
    	$this->load->view('front/ajax_morelatdiv',$data); 
    }
    // update_ajax_morelatdiv

    function update_ajax_morelatdiv()
    {  
    	$data['nextval']=$this->input->post('nextval');  
    	$this->load->view('front/update_ajax_morelatdiv',$data); 
    }

   function update_offline_stores()
    {
    		$store_image = $_FILES['store_image']['name'];
					if($store_image!="") 
					{
						$new_random = mt_rand(0,99999);
						$store_image = remove_space($new_random.$store_image);
						$config['upload_path'] ='uploads/offline_stores';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$store_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($store_image!="" && (!$this->upload->do_upload('store_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('update_offline_stores','refresh');
							}
					
			$result = $this->front_model->update_offline_stores($store_image);	
					}
					else {
						$store_image="";
						$result = $this->front_model->update_offline_stores($store_image);	
				
					}
			if($result)
			{
				$this->session->set_flashdata('success','Store Details Updated Successfully');
				redirect('view_stores','refresh');
			}
			else
			{
				$this->session->set_flashdata('error','Error occurred While Updating Store Detalis');
				redirect('update_offline_stores','refresh');	
			}
    }
    function update_stores($store_id='')
    {
		//echo 'dfhd';die;
    	//$store_id = insep_decode($store_id);
    	//echo 'fgklgjfk'.$store_id;die;
    	$data['count'] = $this->front_model->update_count($store_id);
    	$data['result'] = $this->front_model->update_stores($store_id);
    	$data['row'] = $this->front_model->update_address($store_id);
    	/*echo '<pre>';
    	print_r($data['row']);die;*/
        $this->load->view('front/update_stores',$data);	
    }
    
    function fetch_first_level(){
		
		$cat_id = $this->input->post('cat_id');
		$result = $this->front_model->product_categories($cat_id);
		//print_r($result);
		
		$input = '';
		if($result){
			$input .='<option value=""> Select </option>';
			foreach($result as $name){
				$input .= '<option value="'.$name->cate_id.'">'.$name->category_name.'</option>';
			}
		}else{
			$input .='false';
		}
			echo $input;
	}
//28-03-2016 Lingeswari
/*	function get_pro_detail()
	{
		$pid = $this->input->post('pid');
		$get=$this->front_model->get_al_offline($pid);
	//	print_r($get);
	//	exit;
		
		if($pid!='')
		{
			if($get)
		{
			
			$result1 = $this->front_model->get_pro_details($pid);
			extract($result1);
	
			$input = '';
			if($result1)
			{
				
				$rw1=$this->front_model->get_price_det($result1->product_id);
				//print_r($rw1);
				
				$pri1=$rw1->product_price;
				if($pri1!="" || $pri1!="0")
				{
					$pp1=$pri1;
				}
				else {
					$pp1='0';
				}
				
				$input.='<tr>
				<td class="alert">'.$result1->product_name.' '.$pp1.'</td>
                      
                        <td class="alert">
                        <select name="store_name" id="strore_name" multiple>';
                     $sel1=$this->front_model->get_stores_user();
					$i=0;
					 foreach($sel1 as $ss1)
					 {
					 	$i++;
					 	//echo $ss->store_name;
					 	if($get->store_id==$ss1->store_id)   
						{
                     $input.='<option value="'.$ss1->store_id.'" selected>'.$ss1->store_name.'</option>';
						}
						
						else
							{
								$input.='<option value="'.$ss1->store_id.'">'.$ss1->store_name.'</option>';
						
							}
                        }
					  //exit;
					  
                      $input.='</select>
                      
                      <input type="hidden" name="pid" id="pid" value="'.$get->product_id.'"
                      </td>
                      
                      <td class="alert">
                      <input type="text" name="price" id="price" value="'.$get->price.'">
                      <input type="hidden" name="pid" id="pid" value="'.$get->product_id.'"
                      </td>
                        <td class="alert">
                        <input type="text" name="offer" id="offer"  value="'.$get->offline_offer.'">% offer
                        </td>
                      
                      </tr>';
                      
			}
			else
			{
				$input .='false';
			}
		}
		else {
			
		
			$result = $this->front_model->get_pro_details($pid);
			extract($result);
	
			$input = '';
			if($result)
			{
				
				$rw=$this->front_model->get_price_det($result->product_id);
				//print_r($rw);
				$pri=$rw->product_price;
				if($pri!="" || $pri!="0")
				{
					$pp=$pri;
				}
				else {
					$pp='0';
				}
				$input.='<tr><td class="alert">'.$result->product_name.' '.$pp.'</td>
                      
                        <td class="alert"><select name="store_name" id="strore_name" multiple>';
                     $sel=$this->front_model->get_stores_user();
				//	 print_r($sel);
						$i=0;
					 foreach($sel as $ss)
					 {
					 	$i++;
					 	//echo $ss->store_name;
					 	if($i=='1')   
						{
                     $input.='<option value="'.$ss->store_id.'" selected>'.$ss->store_name.'</option>';
						}
						
						else
							{
								$input.='<option value="'.$ss->store_id.'">'.$ss->store_name.'</option>';
						
							}
                        }
					  //exit;
                      $input.='</select></td>
                      <td class="alert"><input type="text" name="price" id="price" ><input type="hidden" name="pid" id="pid" value="'.$result->product_id.'">
                        </td>
                        <td class="alert"><input type="text" name="offer" id="offer">% offer
                        </td>
                      
                      </tr>';
                      
			}
			else
			{
				$input .='false';
			}
				
				}
echo $input;
		}
	}*/
	/*
function insert_price()
{
		$pid = $this->input->post('pid');
		$price= $this->input->post('price');
		$store=$this->input->post('store');
		$result = $this->front_model->insert_price($pid,$price,$store);
}*/
/*
function insert_offer()
{
		$pid = $this->input->post('pid');
		$offer= $this->input->post('offer');
		$store=$this->input->post('store');
		$result = $this->front_model->insert_offer($pid,$offer,$store);
}
*/
//sharmila 29/03/2016
//forget_password
	function offline_forgetpassword()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id!="")
		{
			redirect('index','refresh');
		} else
		{
			if($this->input->post('reset'))
			{	
				if($this->session->userdata('sess_captcha_code_offline_forgetp')!=$this->input->post('chk')){
					$this->session->set_flashdata('error','CAPTCHA code is mismatched.');
					//redirect('offline_forgetpassword','refresh');
					  $data['email']=$this->input->post('email');
					$this->load->view('front/offline_forgetpassword',$data);
					return false;
				}
				$res = $this->front_model->offline_forgetpassword($user_id);
				if($res){
					$this->session->set_flashdata('success', 'Your password  details sent successfully.');
					redirect('offline_forgetpassword','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while send the password details.');
					redirect('offline_forgetpassword','refresh');
				}
			} 
			$this->load->view('front/offline_forgetpassword');
		}
		$this->security->cookie_handlers();
	}

	function offline_reset_password($a,$b,$c) 
	{
		/*if(($a=='') || ($b=='')|| ($c==''))	
		{
			redirect('cashback/register','refresh');
		}
		else
		{*/
			$user_id = $this->session->userdata('offline_user_id');
			if($user_id=="")
			{
				redirect('index','refresh');
			}
			else 
				{
					if($this->input->post('Save'))
					{	
						// echo 'fgfhg';die;
						$res = $this->front_model->offline_reset_password($user_id);
						if($res){
							// echo 'update';die;
							$this->session->set_flashdata('success', 'Your Password updated successfully.');
							redirect('offline_reset_password','refresh');
						}
						else
						{
							// echo 'not';die;
							$this->session->set_flashdata('error', 'Error occurred while updating your password.');
							redirect('offline_reset_password','refresh');
						}
					}  
					$this->load->view('front/offline_reset_password');
				} 
		/*}*/
		$this->security->cookie_handlers();
	}

	function offline_password_reset($resetpass=null)
	{
				
			$this->input->session_helper();		
			$reset_id = insep_decode($resetpass);
			if($this->input->post('Save'))
			{	
					$user_id = $this->input->post('user_id');
					// echo 'gfhj';die;
					$res = $this->front_model->offline_reset_password($user_id);
					if($res){
						// echo 'login';die;
						$this->session->set_flashdata('success', 'Password updated successfully. Please <a href="'.base_url().'offline_login">Login</a> to continue.');
						redirect('offline_password_reset','refresh');
					}
					else
					{
						// echo 'fghjg';die;
						$this->session->set_flashdata('error', 'Error occurred while updating your password.');
						redirect('offline_password_reset','refresh');
					}
			}
			else
			{
				// echo 'dfhdjkh';die;
					$data['user_id'] = $reset_id;
					// echo $data['user_id'];die;
					$this->load->view('front/offline_password_reset',$data);
			}
	
	}
	//lingeshwari 02-04-2016
	function get_pro_detail()
{
$pid = $this->input->post('pid');

$getss=$this->front_model->get_al_offline($pid);
print_r($getss);
foreach($getss as $p_value)
{
?>
<tr>
<input type="hidden" name="brand" id="brand" value="<?php echo $pid;?>">
<?php
$pro_price = $this->front_model->getProPrice($p_value->product_id);
if($pro_price)
{
if($pro_price->store_id!='')
{
$off_stor_id = explode(',',$pro_price->store_id);
}
else
{
$off_stor_id ="";
}
echo '<td class="alert">'.$p_value->product_name.'-'.$p_value->product_price.'</td>';
echo '<td class="alert">
<select name="store_name" id="strore_name_'.$p_value->product_id.'" multiple><option value=""></option>';

$get_stores_user = $this->front_model->get_stores_user();
foreach ($get_stores_user as $str_value)
{
if(in_array($str_value->store_id,$off_stor_id))
{
echo '<option value="'.$str_value->store_id.'" selected>'.$str_value->store_name.'</option>';
}
else
{
echo '<option value="'.$str_value->store_id.'">'.$str_value->store_name.'</option>';
}

                   } 
                  echo '</select></td>';

        if($pro_price)
        {
            if($pro_price->price!='')
            {
                echo '<td class="alert"><input type="text"  name="price" class="price" value="'.$pro_price->price.'" id="'.$p_value->product_id.'"><button type="button" value="'.$p_value->product_id.'" class="updater">update</button></td>';
            }
            else
            {
                echo '<td class="alert"><input type="text" name="price" class="price" value="" id="'.$p_value->product_id.'"></td>';
            }
            if($pro_price->offline_offer!='')
            {
                echo '<td class="alert"><input type="text" name="offer" class="offer" id="'.$p_value->product_id.'"  value="'.$pro_price->offline_offer.'">% offer</td>';

            }
            else
            {
                echo '<td class="alert"><input type="text" name="offer" class="offer" id="'.$p_value->product_id.'"  value="">% offer</td>';
            }
        }
        else
            {
                echo '<td class="alert"><input type="text" name="price" class="price" value="" id="'.$p_value->product_id.'"></td>';
                echo '<td class="alert"><input type="text" name="offer" class="offer" id="'.$p_value->product_id.'"  value="">% offer</td>';
            }
          echo '</tr>';
    }
    else
{
	echo '<td class="alert">'.$p_value->product_name.'-'.$p_value->product_price.'</td>';
echo '<td class="alert">
<select name="store_name" id="strore_name_'.$p_value->product_id.'" multiple><option value=""></option>';
$get_stores_user = $this->front_model->get_stores_user();
$i=0;
foreach ($get_stores_user as $str_value)
{
	$i++;
if($i=='1')
{
echo '<option value="'.$str_value->store_id.'" >'.$str_value->store_name.'</option>';
}
else
{
echo '<option value="'.$str_value->store_id.'">'.$str_value->store_name.'</option>';
}

                   } 
                  echo '</select></td>';

    
                echo '<td class="alert"><input type="text" name="price" class="price" value="" id="'.$p_value->product_id.'"></td>';
         
       
                echo '<td class="alert"><input type="text" name="offer" class="offer" id="'.$p_value->product_id.'"  value="">% offer</td>';
       
       
    echo '</tr>';
}
}

}
function insert_price()
{
$pid = $this->input->post('pid');
$brand=$this->input->post('brand');
$price= $this->input->post('price');
$store=$this->input->post('store');
$result = $this->front_model->insert_price($pid,$price,$store,$brand);
}
function insert_offer()
{
$pid = $this->input->post('pid');
$brand=$this->input->post('brand');
$offer= $this->input->post('offer');
$store=$this->input->post('store');
$result = $this->front_model->insert_offer($pid,$offer,$store,$brand);
}

function get_products()
	{
		$parent_id = $this->input->post('id');
		$parent_child_id = $this->input->post('parent_child_id');
		// $child = $this->input->post('child');
		/*echo $parent_child_id;
		echo $child;*/
		if($parent_id!='')
		{
			$result = $this->front_model->get_offline_products($parent_id,$parent_child_id);
			$input = '';
			if($result)
			{
				$input .='<option value=""> Select </option>';
				foreach($result as $name)
				{
					$input .= '<option value="'.$name->brand_id.'">'.$name->brand_name.'</option>';
				}
			}
			else
			{
				// $input .='false';
				$input .= '<option value="">No Products</option>';
			}
				echo $input;

		}
	}

	function offline_listofproducts()
{
	// echo 'fhjk';die;
	$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{	
			$data['result'] = $this->front_model->list_products($user_id);
			 // print_r($data['result']);die;
			$this->load->view('front/list_products',$data);
		}
		$this->security->cookie_handlers();
}

function delete_products($ofline_id)
{
	// $ofline_id = insep_decode($ofline_id);
	$result = $this->front_model->delete_products($ofline_id);
	if($result)
	{
		$this->session->set_flashdata('success','Products deleted Successfully');
		redirect('offline_listofproducts','refresh');
	}
	else
	{
		$this->session->set_flashdata('error','Error occurred while deleting prod');
		redirect('offline_listofproducts','refresh');
	}
	
}

function generate_random_password($length = 5) {
    $alphabets = range('A','Z');
    $numbers = range('0','9');
    $additional_characters = array('_','.');
    $final_array = array_merge($alphabets,$numbers,$additional_characters);
         
    $code = '';
  
    while($length--) {
      $key = array_rand($final_array);
      $code .= $final_array[$key];
    }
  
    return $code;
  }

  // offline_verify_account

  function offline_verify_account($verify_code)
	{
		$this->input->session_helper();
		$offline_user_id = $this->session->userdata('offline_user_id');
		if($user_id!="")
		{
			redirect('view_stores','refresh');
		}
		
		$verify = $this->front_model->offline_verify_account($verify_code);
		// echo $verify;die;
		if($verify)
		{
			echo 'sdjk';die;
			$data['verify_msg'] = $verify;
		}
		else
		{
			$data['verify_msg'] = $verify;
		}
		
		$this->load->view('front/offline_verify_account',$data);	
		$this->security->cookie_handlers();
	}

	// sharmila 26/04/2016 ...

	function store_ajax_coupon($pagenum)
	{
		
		$this->input->session_helper();
		$store_details= $this->front_model->get_shopping_coupons();
		if($store_details)
		{
	     $data['couponslist'] = $store_details;
		
		$store_coupons = $this->front_model->coupon_ajax($pagenum);

		if($store_coupons)	
		{
			// $data['store_coupons'] = $store_coupons;
			$data['pagenum'] = $pagenum;
			$user_id = $this->session->userdata('user_id');
			$data['user_id'] = $user_id;
			$this->load->view('front/stores_ajax_coupon',$data);
		}
		else
		{
			echo 0;
		}
		
		}			
	}

	// sharmila 29/04/2016 ...

	function view_coupons()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id==""){
			redirect('cashback/index','refresh');
		} 
		else
		{	
			$data['result'] = $this->front_model->view_coupons();
		$this->load->view('front/view_coupons',$data);	
		}
		$this->security->cookie_handlers();

		
	}
 
	function coupon_transaction()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id==""){
			redirect('cashback/index','refresh');
		} 
		else
		{	
			$data['result'] = $this->front_model->coupon_transaction();
			$this->load->view('front/coupon_transaction',$data);	
		}
		$this->security->cookie_handlers();
	}

	 function delete_coupon_id($id)
  {
  	$this->input->session_helper();
		$user_id = $this->session->userdata('offline_user_id');
		if($user_id==""){
			redirect('cashback/index','refresh');
		} 
		else
		{	
			// echo $id;die;
			// $id = $this->input->post('id');
			$result = $this->front_model->delete_coupon_id($id);
			if($result)
			{
				// echo '1';
				
				$this->session->set_flashdata('success','Coupons details Deleted successfully !!!.');
				redirect('coupon_transaction','refresh');
			}
			else
			{
				// echo '0';
				$this->session->set_flashdata('error','Error Occurred while deleting Coupons Details !!!');
				redirect('coupon_transaction','refresh');
			}
			
		}
		$this->security->cookie_handlers();
  }

	// my_coupons
  	function my_coupons()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{
			$data['result'] = $this->front_model->my_coupons();
			/*echo '<pre>';
			print_r($data);die;*/
			$this->load->view('front/my_coupons',$data);
		}
	}

	// sharmila 09/05/2016...

	function pay_nowsalable_coupons($coupon_id='')
    {
       	$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{	
			$data['coupon_id'] = $this->front_model->coupon_detalis($coupon_id);
			
		    $data['user_details'] = $this->front_model->user_details($user_id);
		    
			// $this->load->view('front/coupon_details',$data);

			$this->load->view('front/withdrawpayu',$data);
		}
		$this->security->cookie_handlers();
    }
	//ganesh june 4
function ads_faq()
	{
		
		
		$this->load->view('front/ads_faq');
		$this->security->cookie_handlers();
	}
	
	function add_redeamption()
	{
		$this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{
			if($this->input->post('save')){
				
				$user = $this->front_model->edit_account($user_id);
				if($user->password!=$this->input->post('key')){
					//echo "wrong password";die;
					$this->session->set_flashdata('error','Wrong Password given. Please try again.');
					redirect('redemption','refresh');
				}
				$post_price = $this->input->post('req_amount');
				$res = $this->front_model->update_user_points($user_id,$post_price);
				if($res){
					$this->session->set_flashdata('success','Withdraw request successfully sent.');
					redirect('redemption','refresh');
				} else {
					$this->session->set_flashdata('error','Invalid amount given.');
					redirect('redemption','refresh');
				}
			} 
		}
		$this->security->cookie_handlers();
	}
   function sessions_product_url()
   {
	   $this->session->set_userdata('redirect_url',$this->input->post('url'));
	   
   }
   function chk_user_deactivate()
   {
	 $this->input->session_helper();
		$user_id = $this->session->userdata('user_id');
		if($user_id==""){
			redirect('index','refresh');
		} 
		else
		{ 
			$res = $this->front_model->chk_user_deactivate($user_id);
			if($res)
			{
				$this->session->sess_destroy();
				//redirect('logout','refresh');
			}
		}	
   }
   
   //ganesh june 28
   function contact_me()
   {
	   if($this->input->post('description'))
	   {
		   $cont=$this->front_model->contact_us();
	   }
	  $this->load->view('front/contact_me'); 
   }

}
?>
