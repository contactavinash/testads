<?php
class Adminsettings extends CI_Controller
{
	public function __construct(){
		parent::__construct();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('admin_model');
		$this->input->session_helper();
		$this->load->helper('captcha');
		/*Multi Currency */ 
		$this->admin_model->getcurrency();		
		$default_currency = $this->session->userdata('default_currency');
		$default_currency_code = $this->session->userdata('default_currency_code');
		define('DEFAULT_CURRENCY',$default_currency);
		define('DEFAULT_CURRENCY_CODE',$default_currency_code);	
		date_default_timezone_set("Asia/Kolkata");
		/*Multi Currency */ 	
	}
	function pageconfig($total_rows,$base,$perpage)
	{

		   $perpage = $perpage;
		   $pages = (ceil($total_rows/$perpage));
			/* if($cat_id!='')
			{
				$urisegment=$this->uri->segment(4);
			}
			else
			{  
				$urisegment=$this->uri->segment(3); 
			} */
			$urisegment=$this->uri->segment(4);
		   $this->load->library('pagination');

		   $config['base_url'] = base_url().'/adminsettings/'.$base;

		   $config['total_rows'] = $total_rows;
		   
		   $config['uri_segment'] = '4';

		   $config['per_page'] = $perpage;

		   $config['num_links']= 3; // Number of "digit" links to show before/after the currently viewed page

		   $config['full_tag_open'] = '';

		   $config['full_tag_close'] = '';

		   $config['cur_tag_open'] = '<li class="active"><a href="">';

		   $config['cur_tag_close'] = '</li></a>';

		   /*$config['first_link'] = '<li>First</li>';*/

		   $config['first_link'] = 'First';

		   $config['first_tag_open'] = '<li>';

		   $config['first_tag_close'] = '</li>';

		   $config['last_link'] = 'last';

		   $config['last_tag_open'] = '<li>';

		   $config['last_tag_close'] = '</li>';

		   $config['prev_link'] = '<i class="fa fa-arrow-left"></i> Previous ';

		   $config['prev_tag_open'] = '<li>';

		   $config['prev_tag_close'] = '</li>';

		   $config['next_link'] = ' Next <i class="fa fa-arrow-right"></i> ';

		   $config['next_tag_open'] = '<li class="next">';

		   $config['next_tag_close'] = '</li>';

		   $config['num_tag_open'] = '<li>';

		   $config['num_tag_close'] = '</li>';    

		   $this->pagination->initialize($config);            

	}
	function check_cate()
	{
		$this->input->session_helper();
		$category = $this->input->post('category_name');
		$result = $this->admin_model->check_cate($category);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
	}
	
	function check_sub_cate()
	{
		$this->input->session_helper();
		$category = $this->input->post('category_name');
		$maincate = $this->input->post('maincate');
		$result = $this->admin_model->check_sub_cate($category,$maincate);
		if($result)
		{
			echo 1;
		} 
		else {
			echo 0;
		}
	}
	
	
	// admin login..
	public function index(){
		//echo "hai";die;
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id!=""){
			redirect('adminsettings/dashboard','refresh');
		}
		$this->load->view('adminsettings/login');
	}
	
	// login check
	function logincheck()
	{
		$this->input->session_helper();
		if($this->input->post('signin')){
			$code = $this->input->post('code');
			if($this->session->userdata('sess_captcha_code_forgetp')!=$code){
				$this->session->set_flashdata('invalid_login','CAPTCHA code is mismatched.');
				redirect('adminsettings/index','refresh');
			}
			$result = $this->admin_model->logincheck();	
			if(!$result){
				$this->session->set_flashdata('invalid_login','Invalid username or password.');
				redirect('adminsettings/index','refresh');
			} else {
				redirect('adminsettings/dashboard','refresh');
			}			
		} else {
			redirect('adminsettings/index','refresh');
		}
	}
	
	// admin dashboard
	function dashboard()
	{	
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}
		else {
			$this->load->view('adminsettings/dashboard');
		}
	}
	
		// admin settings page..
	function settings()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if($admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else {
			$admin_details = $this->admin_model->getadmindetails();
			if($admin_details){
				foreach($admin_details as $details){
					$data['admin_id'] = $details->admin_id;
                                        $data['startup_bonus']=$details->startup_bonus;
					$data['admin_username'] = $details->admin_username;
					$data['admin_email'] = $details->admin_email;
					$data['admin_paypal'] = $details->admin_paypal;
					$data['paypal_mode'] = $details->paypal_mode;
					$data['admin_logo'] = $details->admin_logo;
					$data['site_logo'] = $details->site_logo;
					$data['site_favicon'] = $details->site_favicon;
					$data['homepage_title'] = $details->homepage_title;
					$data['referral_cashback'] = $details->referral_cashback;
					$data['minimum_cashback'] = $details->minimum_cashback;
					$data['site_name'] = $details->site_name;
					$data['site_url'] = $details->site_url;
					$data['admin_fb'] = $details->admin_fb;
					$data['admin_twitter'] = $details->admin_twitter;
					$data['admin_gplus'] = $details->admin_gplus;					
					$data['admin_pintrust'] = $details->admin_pintrust;					
					$data['admin_instagram'] = $details->admin_instagram;
					$data['contact_number'] = $details->contact_number;
					$data['contact_info'] = $details->contact_info;					
					$data['address'] = $details->address;					
					$data['enable_blog'] = $details->enable_blog;					
					$data['enable_shopping'] = $details->enable_shopping;	
					$data['site_prefix'] = $details->site_prefix;
					$data['enable_slider'] = $details->enable_slider;						
					$data['site_mode'] = $details->site_mode;
					$data['meta_title'] = $details->meta_title; //28-11-14 -- suhirdha added section starts..
					$data['meta_keyword'] = $details->meta_keyword;
					$data['meta_description'] = $details->meta_description;
					$data['google_analytics'] = $details->google_analytics;
					$data['google_key'] = $details->google_key;
					$data['google_secret'] = $details->google_secret;
					$data['facebook_key'] = $details->facebook_key; //seetha 18.08.2015
					$data['facebook_secret'] = $details->facebook_secret; 
					$data['blog_url'] = $details->blog_url;
					$data['smtp_host_name'] = $details->smtp_host_name;
					$data['smtp_username'] = $details->smtp_username;
					$data['smtp_password'] = $details->smtp_password;
					$data['smtp_port'] = $details->smtp_port;
					$data['default_currency'] = $details->default_currency;	
					$data['background_image'] = $details->background_image;
					$data['payu_email']=$details->payu_email;
					
				}
				$this->load->view('adminsettings/settings',$data);
			}			
		}		
	}
	
		//admin settings
	function settingsupdate(){
		$this->input->session_helper();
		if($this->input->post('save')){
		// echo 'test';
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
			$new_random = mt_rand(0,99999);
			$admin_logo = $_FILES['admin_logo']['name'];
			$site_logo = $_FILES['site_logo']['name'];
			$this->security->cookie_handlers();
			$background_image = $_FILES['background_image']['name'];
			$site_favicon = $_FILES['site_favicon']['name'];
			$referral_cashback = $this->input->post('referral_cashback');
			$minimum_cashback = $this->input->post('minimum_cashback');
			if(($referral_cashback < 1 ) || ($referral_cashback > 100 ) || (!is_numeric($referral_cashback))){
			
				$this->session->set_flashdata('error','Referral cashback value should be from 1 to 100.');
				redirect('adminsettings/settings','refresh');
			}
			if(($minimum_cashback < 1 ) ||(!is_numeric($minimum_cashback))) { 
				$this->session->set_flashdata('error','Minimum cashback value should be from 1 and it should be an integer.');
				redirect('adminsettings/settings','refresh');
			}
			if($background_image!="") {
				$background_image = remove_space($new_random.$background_image);
				$config['upload_path'] ='uploads/adminpro';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name']=$background_image;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($background_image!="" && (!$this->upload->do_upload('background_image')))
				{
					$background_imageerror = $this->upload->display_errors();
				}
					if(isset($background_imageerror))        
					{
						$this->session->set_flashdata('error',$background_imageerror);
						redirect('adminsettings/settings','refresh');
					}
			}
			else
			{
				$background_image = $this->input->post('hidden_site_background_image');
			}
			
			if($admin_logo!="") {
				$admin_logo = remove_space($new_random.$admin_logo);
				$config['upload_path'] ='uploads/adminpro';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name']=$admin_logo;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($admin_logo!="" && (!$this->upload->do_upload('admin_logo')))
				{
					$admin_logoerror = $this->upload->display_errors();
				}
					if(isset($admin_logoerror))        
					{
						$this->session->set_flashdata('error',$admin_logoerror);
						redirect('adminsettings/settings','refresh');
					}
			}
			else
			{
				$admin_logo = $this->input->post('hidden_img');
			}
			
			if($site_logo!="") {
				$site_logo = remove_space($new_random.$site_logo);
				$config['upload_path'] ='uploads/adminpro';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name']=$site_logo;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($site_logo!="" && (!$this->upload->do_upload('site_logo')))
				{
					$site_logoerror = $this->upload->display_errors();
				} else {
					$this->load->library('image_lib');
				   $configs['image_library'] = 'gd2';
				   $configs['source_image'] = 'uploads/adminpro/'.$site_logo;
				   $configs['maintain_ratio'] = FALSE;
/*				   $configs['width'] = 192;
				   $configs['height'] = 55;*/
				   $configs['overwrite'] = TRUE;
				   $this->image_lib->initialize($configs);
				   $this->image_lib->resize();
				   $this->image_lib->clear();
				   // $adm =  image_resizer('uploads/adminpro/',$site_logo,10,10,'');
				}
					if(isset($site_logoerror))        
					{
						$this->session->set_flashdata('error',$site_logoerror);
						redirect('adminsettings/settings','refresh');
					}
			}	
			else
			{
				$site_logo = $this->input->post('hidden_site_logo');
			}
			if($site_favicon!="") {
				$site_favicon = remove_space($new_random.$site_favicon);
				$config['upload_path'] ='uploads/adminpro';
				$config['allowed_types'] = 'ico|gif|jpg|jpeg|png';
				$config['file_name']=$site_favicon;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($site_favicon!="" && (!$this->upload->do_upload('site_favicon')))
				{
					$site_faviconerror = $this->upload->display_errors();
				}
					if(isset($site_faviconerror))        
					{
						$this->session->set_flashdata('error',$site_faviconerror);
						redirect('adminsettings/settings','refresh');
					}
			}	
			else
			{
				$site_favicon = $this->input->post('hidden_site_favicon');
			}
			$updated = $this->admin_model->updatesettings($admin_logo,$site_logo,$site_favicon,$background_image);
			if($updated)
			{
				$this->session->set_flashdata('success', 'Admin settings updated successfully. ');
				redirect('adminsettings/settings','refresh');
			}  
			else
			{
				$this->session->set_flashdata('error', 'Admin settings not updated successfully.');
				redirect('adminsettings/settings','refresh');
			} 
		}		
	}
	
	// change password..
	function change_password()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}  else if((!(in_array('1',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			if($this->input->post('save')){
			$result = $this->admin_model->update_password();
				if($result){
					$this->session->set_flashdata('success', 'Password changed successfully.');
					redirect('adminsettings/change_password','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Old Password did not match.');
					redirect('adminsettings/change_password','refresh');
				}
			}	
			$this->load->view('adminsettings/changepassword');		
		}
		$this->security->cookie_handlers();
	}
		// view all cms content
	function cms(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}  else if((!(in_array('151',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['allcms'] = $this->admin_model->get_allcms();
			$this->load->view('adminsettings/cms',$data);
		}	
	}
	
	// add cms contents..
	function addcms(){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
	$this->security->cookie_handlers();
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('150',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$cms_content = $this->input->post('cms_content');
				if($cms_content==""){
					$this->session->set_flashdata('error', 'Please enter CMS content.');
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addcms','refresh');
				}
				else{
					$results = $this->admin_model->addcms();
					if($results){
						$this->session->set_flashdata('success', ' CMS details added successfully.');
						redirect('adminsettings/cms','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while adding CMS.');
						redirect('adminsettings/addcms','refresh');
					}
				}
			}
			$data['action']='new';
			$this->load->view('adminsettings/addcms',$data);
		}
	}
	
	// view cms content
	function editcms($cms_editid)
	{
		$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
	
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('152',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_cms = $this->admin_model->get_cmscontent($cms_editid);
			$this->security->cookie_handlers();
			foreach($get_cms as $get){
				$data['cms_id'] = $get->cms_id;
				$data['cms_heading'] = $get->cms_heading;
				$data['cms_metatitle'] = $get->cms_metatitle;
				$data['cms_metakey'] = $get->cms_metakey;
				$data['cms_metadesc'] = $get->cms_metadesc;
				$data['cms_content'] = $get->cms_content;
				
				$data['cms_position'] = $get->cms_position;
				$data['cms_status'] = $get->cms_status;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/addcms',$data);
		}
	}
	
	// update cms contents..	
	function updatecms()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$this->security->cookie_handlers();
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('26',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$cms_content = $this->input->post('cms_content');
				if($cms_content=="") {
					$this->session->set_flashdata('error', 'Please enter CMS content.');
					$data['action']="Edit";
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addcms','refresh');
				}
				else {
					$updated = $this->admin_model->updatecms();
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' CMS details updated successfully.');
						redirect('adminsettings/cms','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating CMS details.');
						redirect('adminsettings/cms','refresh');
					}
				}
			}		
		}
	}
	
	// delete cms content 
	function deletecms($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');	
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('153',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletecms($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' CMS details deleted successfully.');
				redirect('adminsettings/cms','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting CMS details.');
				redirect('adminsettings/cms','refresh');
			}
		}
	}
	
		// view all faqs content
	function faqs()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$this->security->cookie_handlers();
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('146',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'tbl_faq','faq_id');
				 }
				if($results){
					
					$this->session->set_flashdata('success', 'FAQ details deleted successfully.');
					redirect('adminsettings/faqs','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating FAQ details.');
					redirect('adminsettings/faqs','refresh');
				}
			}
			$data['allfaqs'] = $this->admin_model->get_allfaqs();
			$this->load->view('adminsettings/faq',$data);
		}	
	}
	
	// add faqs
	function addfaqs()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('145',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$faq_content = $this->input->post('faq_ans');
				if($faq_content==""){
					$this->session->set_flashdata('error', 'Please enter FAQ content.');
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addfaqs','refresh');
				}
				else{
					$results = $this->admin_model->addfaqs();
					if($results){
						$this->session->set_flashdata('success', ' FAQ details added successfully.');
						redirect('adminsettings/faqs','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while adding FAQ.');
						redirect('adminsettings/addfaqs','refresh');
					}
				}
			}
			$data['action']='new';
			$this->security->cookie_handlers();
			$this->load->view('adminsettings/addfaq',$data);
		}
	}
	
	// view faq content
	function editfaq($faq_editid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if(($admin_id=="") || ($faq_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('147',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_faq = $this->admin_model->get_faqcontent($faq_editid);
			foreach($get_faq as $get){
				$data['faq_id'] = $get->faq_id;
				$data['faq_qn'] = $get->faq_qn;
				$data['faq_ans'] = $get->faq_ans;
				$data['status'] = $get->status;
			}
			$data['action'] = "edit";
			$this->security->cookie_handlers();
			$this->load->view('adminsettings/addfaq',$data);
		}
	}
	
	// updating faq content
	function updatefaq(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('24',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$faq_ans = $this->input->post('faq_ans');
				if($faq_ans=="") {
					$this->session->set_flashdata('error', 'Please enter FAQ content.');
					$data['action']="Edit";
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addfaq','refresh');
				}
				else {
					$updated = $this->admin_model->updatefaq();
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' FAQ details updated successfully.');
						redirect('adminsettings/faqs','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating FAQ details.');
						redirect('adminsettings/faqs','refresh');
					}
				}
			}		
		}	
	}	
	
	// delete faq content 
	function deletefaq($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('148',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletefaq($id);
			if($deletion){
				$this->session->set_flashdata('success', ' FAQ details deleted successfully.');
				redirect('adminsettings/faqs','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting FAQ details.');
				$this->security->cookie_handlers();
				redirect('adminsettings/faqs','refresh');
			}
		}
	}
	
	
	// view all users..
	function users($count){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('18',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				//print_r($this->input->post());
				
				$results = $this->admin_model->multi_delete_user();
				if($results){
					
					$this->session->set_flashdata('success', 'Users deleted successfully.');
					redirect('adminsettings/users','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleted user details.');
					redirect('adminsettings/users','refresh');
				}
			}
			
			$data['allusers'] = $this->admin_model->get_allusers($count);
			$this->load->view('adminsettings/users',$data);
		}	
	}
	
	// view particular user details..
	function view_user($userid){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if(($admin_id=="") || ($userid=="")) {
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('59',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['user_detail'] = $this->admin_model->view_user($userid);
			$this->load->view('adminsettings/viewuser',$data);
		}	
	}
	
	// update user status..
	function userupdate(){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") {
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('60',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
			$updated = $this->admin_model->userupdate();
			$this->security->cookie_handlers();
				if($updated){
					$this->session->set_flashdata('success', ' User details updated successfully.');
					redirect('adminsettings/users','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating user details.');
					redirect('adminsettings/users','refresh');
				}
			}
		}	
	}
	
	// delete user details..
	function deleteuser($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('61',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->deleteuser($id);
			if($deletion){
				$this->session->set_flashdata('success', ' User details deleted successfully.');
				redirect('adminsettings/users','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting user details.');
				redirect('adminsettings/users','refresh');
			}
		}
	}
	
	// view all categories..
	function categories()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('32',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_categorys_new();
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_categorys_new_delete();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Category details updated successfully.');
					redirect('adminsettings/categories','refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/categories','refresh');
				}
			}
			$data['categories'] = $this->admin_model->categories();
			$this->load->view('adminsettings/categories',$data);
		}
	}
	
	//view Premium category
	function premium_categories()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_premium_categorys_new();
				if($this->input->post('chkbox'))
				 {
					 $this->security->cookie_handlers();
					 $results = $this->admin_model->sort_premium_categorys_new_delete();
				 }
				
				if($results){
					
					$this->session->set_flashdata('success', 'Category details updated successfully.');
					redirect('adminsettings/premium_categories','refresh');
				}
				else{
					;
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/premium_categories','refresh');
				}
			}
			$data['categories'] = $this->admin_model->premium_categories();
			$this->load->view('adminsettings/premium_categories',$data);
		}
	}
	
	
	// add category
	function addcategory()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('31',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			if($this->input->post('save'))
			{
				if($this->input->post('category_type')==0) //Normal Coupon
				{
					$this->security->cookie_handlers();
					$category_image = $_FILES['category_image']['name'];
					$category_icon = $_FILES['category_icon']['name'];
			
					if($category_image!="") {
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('category_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('adminsettings/categories','refresh');
							}
					}
					
					if($category_icon!="") {
						$new_random = mt_rand(0,99999);
						$category_icon = remove_space($new_random.$category_icon);
						$config['upload_path'] ='uploads/category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_icon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_icon!="" && (!$this->upload->do_upload('category_icon')))
						{
							$category_iconerror = $this->upload->display_errors();
						}
							if(isset($category_iconerror))        
							{
								$this->session->set_flashdata('error',$category_iconerror);
								redirect('adminsettings/categories','refresh');
							}
					}
					$results = $this->admin_model->addcategory($category_image,$category_icon);
					if($results)
					{
						$this->session->set_flashdata('success', ' Category details added successfully.');
						redirect('adminsettings/categories','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while adding category.');
						redirect('adminsettings/addcategory','refresh');
					}
				}
				else//Premium Coupon
				{
					$results = $this->admin_model->addpremiumcategory();
					if($results)
					{
						$this->session->set_flashdata('success', ' Category details added successfully.');
						redirect('adminsettings/premium_categories','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while adding category.');
						redirect('adminsettings/addcategory','refresh');
					}
				}
			}
			$data['action']='new';
			$this->load->view('adminsettings/addcategory',$data);
		}
	}
	
	
	// edit category..
	function editcategory($cate_editid,$in=null)
	{
		$this->input->session_helper();			
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if(($admin_id=="") || ($cate_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('101',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_specification = $this->admin_model->get_details_from_id($cate_editid,'categories','category_id');
			if(!$get_specification)
			{
				redirect('adminsettings/categories','refresh');
			}
				
			$this->security->cookie_handlers();
			$get_category = $this->admin_model->get_category($cate_editid);
			foreach($get_category as $get){
				$data['category_id'] = $get->category_id;
				$data['category_name'] = $get->category_name;
				$data['meta_keyword'] = $get->meta_keyword;
				$data['meta_description'] = $get->meta_description;
				$data['category_image'] = $get->category_image;
				$data['category_status'] = $get->category_status;
				$data['top_category'] = $get->top_category;
				$data['category_icon'] = $get->category_icon;
			}
			$data['action'] = "edit";
			$data['check_null'] = $in;
			$this->load->view('adminsettings/addcategory',$data);
		}
	}
	
	// edit category..
	
	
	// edit category..
	function editpremiumcategory($cate_editid)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if(($admin_id=="") || ($cate_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			$get_category = $this->admin_model->get_premium_category($cate_editid);
			foreach($get_category as $get){
				$data['category_id'] = $get->category_id;
				$data['category_name'] = $get->category_name;
				$data['meta_keyword'] = $get->meta_keyword;
				$data['meta_description'] = $get->meta_description;
				$data['category_status'] = $get->category_status;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/addpremiumcategory',$data);
		}
	}
	
	function productsp()
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
	
	
	// update category	
	function updatecategory()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('103',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			if($this->input->post('save')){
				$id = $this->input->post('category_id');
				$category_image = $_FILES['category_image']['name'];
				$category_icon = $_FILES['category_icon']['name'];
					if($category_image!="") {
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('category_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('adminsettings/settings','refresh');
							}
					} else {
						$category_image = $this->input->post('hidden_category_image');
					}
					if($category_icon!="") {
						$new_random = mt_rand(0,99999);
						$category_icon = remove_space($new_random.$category_icon);
						$config['upload_path'] ='uploads/category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_icon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_icon!="" && (!$this->upload->do_upload('category_icon')))
						{
							$category_iconerror = $this->upload->display_errors();
						}
							if(isset($category_iconerror))        
							{
								$this->session->set_flashdata('error',$category_iconerror);
								redirect('adminsettings/settings','refresh');
							}
					} else {
						$category_icon = $this->input->post('hidden_category_icon');
					}
					
				$updated = $this->admin_model->update_category($category_image,$category_icon);
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Category details updated successfully.');
					if($this->input->post('check_null')){
						redirect('adminsettings/inactive_categories','refresh');
					}else{
						redirect('adminsettings/categories','refresh');
					}
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/editcategory/'.$id.'/'.$this->input->post('check_null'),'refresh');
				}
			}		
		}
	}
	
	
	function updatepremiumcategory()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			$id = $this->input->post('category_id');
			if($this->input->post('save')){
				$updated = $this->admin_model->update_premium_category();
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', 'Premium Category details updated successfully.');
					redirect('adminsettings/premium_categories','refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/editpremiumcategory/'.$id,'refresh');
				}
			}		
		}	
	}
	
	//delete category..
	function deletecategory($id,$in=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->deletecategory($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Category deleted successfully.');
				if($in){
						redirect('adminsettings/inactive_categories','refresh');
					}else{
						redirect('adminsettings/categories','refresh');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting category.');
				if($in){
						redirect('adminsettings/inactive_categories','refresh');
					}else{
						redirect('adminsettings/categories','refresh');
				}
			}
		}	
	}
	
	//delete premium  category..
	function delete_premium_category($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletepremiumcategory($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Premium Category deleted successfully.');
				redirect('adminsettings/premium_categories','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting category.');
				redirect('adminsettings/premium_categories','refresh');
			}
		}	
	}
	
	// view all affiliates..
	function affiliates()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('24',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_affiliates();
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_affiliates_delete();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Affiliates details updated successfully.');
					redirect('adminsettings/affiliates','refresh');
				}
				else{
					;
					$this->session->set_flashdata('error', 'Error occurred while updating affiliates details.');
					redirect('adminsettings/affiliates','refresh');
				}
			}
			$type= $this->uri->segment(3);
			$data['affiliates'] = $this->admin_model->affiliates($type);
			$this->load->view('adminsettings/affiliates',$data);
		}
	}
	
	// add new affiliate
	
	function addaffiliate()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('33',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$flag=0;
				$affiliate_name = $this->input->post('affiliate_name');
				$affiliate_desc = $this->input->post('affiliate_desc');
				$logo_url = $this->input->post('logo_url');
				
				
				/*$site_url = $this->input->post('site_url');*/
				$meta_keyword = $this->input->post('meta_keyword');
				$meta_description = $this->input->post('meta_description');
				$cashback_percentage = $this->input->post('cashback_percentage');
				$affiliate_logo = $_FILES['affiliate_logo']['name'];
				
				$sidebar_image = $_FILES['sidebar_image']['name'];
				
				if($affiliate_desc==""){
					$flag=1;
					$this->session->set_flashdata('affiliate_name',$affiliate_name);
					$this->session->set_flashdata('cashback_percentage',$cashback_percentage);
					$this->session->set_flashdata('logo_url',$logo_url);
					$this->session->set_flashdata('meta_keyword',$meta_keyword);
					$this->session->set_flashdata('meta_description',$meta_description);
					$this->session->set_flashdata('error', 'Please enter Retailer Description.');
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addaffiliate','refresh');
				}
				else if($affiliate_logo==""){
					$flag=1;
					$this->session->set_flashdata('affiliate_name',$affiliate_name);
					$this->session->set_flashdata('affiliate_desc',$affiliate_desc);
					$this->session->set_flashdata('cashback_percentage',$cashback_percentage);
					$this->session->set_flashdata('logo_url',$logo_url);
					$this->session->set_flashdata('meta_keyword',$meta_keyword);
					$this->session->set_flashdata('meta_description',$meta_description);
					$this->session->set_flashdata('error', 'Please upload an image .');
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addaffiliate','refresh');
				}				
				else {
					$flag=0;
					if($affiliate_logo!="") {
						$new_random = mt_rand(0,99999);
						$affiliate_logo = $_FILES['affiliate_logo']['name'];
						$affiliate_logo = remove_space($new_random.$affiliate_logo);
						$config['upload_path'] ='uploads/affiliates';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$affiliate_logo;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
						{
							$affiliate_logoerror = $this->upload->display_errors();
						}
						if(isset($affiliate_logoerror))
						{
							$flag=1;
							$this->session->set_flashdata('affiliate_name',$affiliate_name);
							$this->session->set_flashdata('affiliate_desc',$affiliate_desc);
							$this->session->set_flashdata('logo_url',$logo_url);
							$this->session->set_flashdata('meta_keyword',$meta_keyword);
							$this->session->set_flashdata('meta_description',$meta_description);
							$this->session->set_flashdata('cashback_percentage',$cashback_percentage);
							$this->session->set_flashdata('error',$affiliate_logoerror);
							redirect('adminsettings/addaffiliate','refresh');
						}
					}
					
						if($sidebar_image!="") {
						$new_random = mt_rand(0,99999);
						$sidebar_image = $_FILES['sidebar_image']['name'];
						$sidebar_image = remove_space($new_random.$sidebar_image);
						$config['upload_path'] ='uploads/sidebar_image';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$sidebar_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($sidebar_image!="" && (!$this->upload->do_upload('sidebar_image')))
						{
							$sidebar_imageerror = $this->upload->display_errors();
						}
						if(isset($sidebar_imageerror))
						{
							$flag=1;
							$this->session->set_flashdata('affiliate_name',$affiliate_name);
							$this->session->set_flashdata('affiliate_desc',$affiliate_desc);
							$this->session->set_flashdata('logo_url',$logo_url);
							$this->session->set_flashdata('meta_keyword',$meta_keyword);
							$this->session->set_flashdata('meta_description',$meta_description);
							$this->session->set_flashdata('cashback_percentage',$cashback_percentage);
							$this->session->set_flashdata('error',$sidebar_imageerror);
							redirect('adminsettings/editaffiliate/'.$affiliate_id,'refresh');
						}
					}
			
					if($flag==0){
						$coupon_image = $_FILES['coupon_image']['name'];
						if($coupon_image[0])
						{
											
								$flag=0;
								// start..
								$name="coupon_image";
								foreach($_FILES[$name] as $key => $val)
								{
									for($i=0;$i<count($val);$i++)
									{
										unset($_FILES['coupon_image'][$key]);
										$_FILES['coupon_image'][$i][$key]=$val[$i];
									}
								}
								$files=$_FILES;
								$all_images = "";
								for($i=0;$i<count($files[$name]);$i++)
								{
									$_FILES['coupon_image1']=$files[$name][$i];
									$coupon_image = $_FILES['coupon_image1']['name'];
									
									$ext = pathinfo($coupon_image, PATHINFO_EXTENSION);
									$file_without_ext = pathinfo($coupon_image, PATHINFO_FILENAME);;
									
									$image_new =  $this->admin_model->seoUrl($file_without_ext);
									$newimage =  $image_new.".".$ext;
									// $this->upload->do_upload("coupon_image1");
									$random_no = mt_rand(100,99999);
									$coupon_img = $random_no.$newimage;
									
									$coupon_img =  str_replace(" ","_",$coupon_img);
									$config['upload_path'] ='uploads/store_banner';
									$config['allowed_types'] = 'gif|jpg|jpeg|png';
									$config['file_name']=$coupon_img;
									$this->load->library('upload', $config);
									$this->upload->initialize($config);
									if($coupon_img!="" && (!$this->upload->do_upload('coupon_image1')))
									{
										$coupon_imageerror = $this->upload->display_errors();
									}
									$shoppingcoupon_id = $this->input->post("shoppingcoupon_id");
									// $this->upload->display_errors();
									if(isset($coupon_imageerror))
									{						
										$flag=1;
										$this->session->set_flashdata('error',$coupon_imageerror);
										redirect('adminsettings/editaffiliate/'.$affiliate_id,'refresh');
									}
									$all_images.= $coupon_img.',';
								}
								$coupon_img1 = rtrim($all_images,',');
								$coupon_img =  str_replace(" ","_",$coupon_img1);
								
							}
						else{
						$flag=0;
						$coupon_img = $this->input->post('hidden_coupon_image');
					}
				/*	echo $coupon_img;
					exit;*/
					
					
									   
						if($sidebar_image!="")			   
						{
							$results = $this->admin_model->addaffiliate($affiliate_logo,$coupon_img,$sidebar_image);
						}
						else
						{
							$results = $this->admin_model->addaffiliate($affiliate_logo,$coupon_img,$sidebar_image);
						}
						if($results){
							$this->session->set_flashdata('success', ' Store details added successfully.');
							redirect('adminsettings/affiliates','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding affiliate.');
							redirect('adminsettings/addaffiliate','refresh');
						}
					}
				}
			}
			$data['action']='new';
			$this->load->view('adminsettings/addaffiliate',$data);
		}
	}
	
	// edit affiliate	
	function editaffiliate($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('83',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['get_aff_bank_off']=$this->admin_model->get_aff_bank_off($id);
			
			
			$data['get_aff_other_off']=$this->admin_model->get_aff_other_off($id);
			
			$get_affiliate = $this->admin_model->get_affiliate($id);
			foreach($get_affiliate as $get){
				$data['affiliate_id'] = $get->affiliate_id;
				$data['affiliate_name'] = $get->affiliate_name;
				$data['affiliate_logo'] = $get->affiliate_logo;
				$data['logo_url'] = $get->logo_url;
				
				/*$data['site_url'] = $get->site_url;*/
				
				$data['affiliate_desc'] = $get->affiliate_desc;
				$data['meta_keyword'] = $get->meta_keyword;
				$data['meta_description'] = $get->meta_description;
				$data['affiliate_status'] = $get->affiliate_status;
				$data['cashback_percentage'] = $get->cashback_percentage;
				$data['featured'] = $get->featured;
				$data['store_of_week'] = $get->store_of_week;
				$data['store_categorys'] = $get->store_categorys;
				$data['affiliate_cashback_type'] = $get->affiliate_cashback_type;				
				$data['coupon_image'] = $get->coupon_image;
				$data['coupon_image'] = $get->coupon_image;
				$data['retailer_ban_url'] = $get->retailer_ban_url;				
				
				$data['how_to_get_this_offer'] = $get->how_to_get_this_offer;				
				$data['terms_and_conditions'] = $get->terms_and_conditions;
				$data['sidebar_image'] = $get->sidebar_image;
				$data['sidebar_image_url'] = $get->sidebar_image_url;
				
				
			}
			$data['action'] = "edit";
			//$this->load->view('adminsettings/addaffiliate',$data);
$data['categories']=$this->admin_model->get_categories();
			$data['commision']=$this->admin_model->get_retailer_commision($data['affiliate_id']);
$this->load->view('adminsettings/editaffliatesnew',$data);			
		}
	}
	
	// update affiliate
	function updateaffiliate()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('85',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$store_type = $this->input->post('store_type');
				/*print_r($this->input->post());
				exit;*/
				$flag=0;
				$affiliate_name = $this->input->post('affiliate_name');
				$affiliate_desc = $this->input->post('affiliate_desc');
				$cashback_percentage = $this->input->post('cashback_percentage');
				$logo_url = $this->input->post('logo_url');
				
				/*$site_url = $this->input->post('site_url');*/
				$meta_keyword = $this->input->post('meta_keyword');
				$meta_description = $this->input->post('meta_description');
				$affiliate_logo = $_FILES['affiliate_logo']['name'];
				
				$sidebar_image = $_FILES['sidebar_image']['name'];
				$affiliate_id = $this->input->post('affiliate_id');
				
				
					$flag=0;
					if($affiliate_logo!="") {
						$new_random = mt_rand(0,99999);
						$affiliate_logo = $_FILES['affiliate_logo']['name'];
						$affiliate_logo = remove_space($new_random.$affiliate_logo);
						$config['upload_path'] ='uploads/affiliates';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$affiliate_logo;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
						{
							$affiliate_logoerror = $this->upload->display_errors();
						}
						if(isset($affiliate_logoerror))
						{
							$flag=1;
							$this->session->set_flashdata('affiliate_name',$affiliate_name);
							$this->session->set_flashdata('affiliate_desc',$affiliate_desc);
							$this->session->set_flashdata('logo_url',$logo_url);
							$this->session->set_flashdata('meta_keyword',$meta_keyword);
							$this->session->set_flashdata('meta_description',$meta_description);
							$this->session->set_flashdata('cashback_percentage',$cashback_percentage);
							$this->session->set_flashdata('error',$affiliate_logoerror);
							redirect('adminsettings/editaffiliate/'.$affiliate_id,'refresh');
						}
					}
					else {
						$affiliate_logo = $this->input->post('hidden_img');
					}
					
					if($sidebar_image!="") {
						$new_random = mt_rand(0,99999);
						$sidebar_image = $_FILES['sidebar_image']['name'];
						$sidebar_image = remove_space($new_random.$sidebar_image);
						$config['upload_path'] ='uploads/sidebar_image';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$sidebar_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($sidebar_image!="" && (!$this->upload->do_upload('sidebar_image')))
						{
							$sidebar_imageerror = $this->upload->display_errors();
						}
						if(isset($sidebar_imageerror))
						{
							$flag=1;
							$this->session->set_flashdata('affiliate_name',$affiliate_name);
							$this->session->set_flashdata('affiliate_desc',$affiliate_desc);
							$this->session->set_flashdata('logo_url',$logo_url);
							$this->session->set_flashdata('meta_keyword',$meta_keyword);
							$this->session->set_flashdata('meta_description',$meta_description);
							$this->session->set_flashdata('cashback_percentage',$cashback_percentage);
							$this->session->set_flashdata('error',$sidebar_imageerror);
							redirect('adminsettings/editaffiliate/'.$affiliate_id,'refresh');
						}
					}
					else {
						$sidebar_image = $this->input->post('sidebar_image_hid');
					}
				
					if($flag==0){
						$coupon_image='';
						$coupon_image = $_FILES['coupon_image']['name'];
						if($coupon_image[0])
						{
											
								$flag=0;
								// start..
								$name="coupon_image";
								foreach($_FILES[$name] as $key => $val)
								{
									for($i=0;$i<count($val);$i++)
									{
										unset($_FILES['coupon_image'][$key]);
										$_FILES['coupon_image'][$i][$key]=$val[$i];
									}
								}
								$files=$_FILES;
								$all_images = "";
								for($i=0;$i<count($files[$name]);$i++)
								{
									$_FILES['coupon_image1']=$files[$name][$i];
									$coupon_image = $_FILES['coupon_image1']['name'];
									
									$ext = pathinfo($coupon_image, PATHINFO_EXTENSION);
									$file_without_ext = pathinfo($coupon_image, PATHINFO_FILENAME);;
									
									$image_new =  $this->admin_model->seoUrl($file_without_ext);
									$newimage =  $image_new.".".$ext;
					
					
									// $this->upload->do_upload("coupon_image1");
									$random_no = mt_rand(100,99999);
									$coupon_img = $random_no.$newimage;
									
									$coupon_img =  str_replace(" ","_",$coupon_img);
									$config['upload_path'] ='uploads/store_banner';
									$config['allowed_types'] = 'gif|jpg|jpeg|png';
									$config['file_name']=$coupon_img;
									$this->load->library('upload', $config);
									$this->upload->initialize($config);
									if($coupon_img!="" && (!$this->upload->do_upload('coupon_image1')))
									{
										$coupon_imageerror = $this->upload->display_errors();
									}
									$shoppingcoupon_id = $this->input->post("shoppingcoupon_id");
									// $this->upload->display_errors();
									if(isset($coupon_imageerror))
									{						
										$flag=1;
										$this->session->set_flashdata('error',$coupon_imageerror);
										redirect('adminsettings/editaffiliate/'.$affiliate_id,'refresh');
									}
									$all_images.= $coupon_img.',';
								}
								$coupon_img1 = rtrim($all_images,',');
								$coupon_img =  str_replace(" ","_",$coupon_img1);
								/*echo $coupon_img;
								exit;*/
						
							
										}
						else{
							$flag=0;
							$coupon_img = $this->input->post('hidden_coupon_image');
						}				
						$results = $this->admin_model->updateaffiliate($affiliate_logo,$coupon_img,$sidebar_image);
						if($store_type=='')
						{
						if($results){
							$this->session->set_flashdata('success', ' Store details updated successfully.');
							redirect('adminsettings/affiliates','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while updating store details.');
							redirect('adminsettings/addaffiliate','refresh');
						}
					}
						else
						{
							if($results)
							{
								// echo 'dfjdkhf'.$store_type;die;
								$this->session->set_flashdata('success', ' Store details updated successfully.');
								redirect('adminsettings/affiliates/On1','refresh');
							}

							else{
								$this->session->set_flashdata('error', 'Error occurred while updating store details.');
								redirect('adminsettings/addaffiliate','refresh');
							}
						}
				}
			}	
		}
	}	
	
	// delete affiliate
	function deleteaffiliate($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('7',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deleteaffiliate($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Store details deleted successfully.');
				redirect('adminsettings/affiliates','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting store details.');
				redirect('adminsettings/affiliates','refresh');
			}
		}
	}
	
	// view all banners
	function banners()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('139',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			    if($this->input->post('hidd'))
				{	
						$results = $this->admin_model->multi_delete_banners();
								if($results){		
									$this->session->set_flashdata('success', 'Banners deleted successfully.');
									redirect('adminsettings/banners','refresh');
								}
								else
								{
								$this->session->set_flashdata('error', 'Error occurred while deleted Banners details.');
								redirect('adminsettings/banners','refresh');
								}
				}
			$data['banners'] = $this->admin_model->banners();
			$this->load->view('adminsettings/banners',$data);
		}	
	}
	
	// add new banner
	function addbanner()
	{
		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('138',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$flag=0;
				$banner_name = $this->input->post('banner_name');
				$banner_image = $_FILES['banner_image']['name'];
				if($banner_image==""){
					$flag=1;
					$this->session->set_flashdata('banner_name',$banner_name);
					$this->session->set_flashdata('error', 'Please upload an image .');
					redirect('adminsettings/addbanner','refresh');
				}				
				else {
					$flag=0;
					if($banner_image!="") {
						$new_random = mt_rand(0,99999);
						$banner_image = $_FILES['banner_image']['name'];
						$banner_image = remove_space($new_random.$banner_image);
						$config['upload_path'] ='uploads/banners';
						$config['allowed_types'] = '*';
						$config['file_name']=$banner_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($banner_image!="" && (!$this->upload->do_upload('banner_image')))
						{
							$banner_imageerror = $this->upload->display_errors();
						}
						if(isset($banner_imageerror))
						{
							$flag=1;
							$this->session->set_flashdata('banner_name',$banner_name);
							$this->session->set_flashdata('error',$banner_imageerror);
							redirect('adminsettings/addbanner','refresh');
						}
					}
					if($flag==0){
						$results = $this->admin_model->addbanner($banner_image);
						if($results){
							$this->session->set_flashdata('success', ' Banner details added successfully.');
							redirect('adminsettings/banners','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding banner.');
							redirect('adminsettings/addbanner','refresh');
						}
					}
				}
			}	
			$data['action']='new';
			$this->load->view('adminsettings/addbanner',$data);
		}
	}	
	
	
	// edit banner
	function editbanner($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('142',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_banner = $this->admin_model->get_banner($id);
			foreach($get_banner as $get){
				$data['banner_id'] = $get->banner_id;
				$data['banner_name'] = $get->banner_heading;
				$data['banner_image'] = $get->banner_image;
				$data['banner_status'] = $get->banner_status;
				$data['banner_position'] = $get->banner_position;
				$data['banner_url'] = $get->banner_url;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/addbanner',$data);
		}
	}
	
	//update banner
	function updatebanner()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('23',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{		
			if($this->input->post('save')){
				$flag=0;
				$banner_name = $this->input->post('banner_name');
				$banner_image = $_FILES['banner_image']['name'];
				if($banner_image!="") {
					$new_random = mt_rand(0,99999);
					$banner_image = $_FILES['banner_image']['name'];
					//$banner_image = $new_random.$banner_image;
					$banner_image = remove_space($new_random.$banner_image);
					$config['upload_path'] ='uploads/banners';
					$config['allowed_types'] = '*';
					$config['file_name']=$banner_image;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($banner_image!="" && (!$this->upload->do_upload('banner_image')))
					{
						$banner_imageerror = $this->upload->display_errors();
					}
					if(isset($banner_imageerror))
					{
						$flag=1;
						$this->session->set_flashdata('banner_name',$banner_name);
						$this->session->set_flashdata('error',$banner_imageerror);
						redirect('adminsettings/addbanner','refresh');
					}
				}
				else {
					$flag=0;
					$banner_image = $this->input->post('hidden_img');
				}
				if($flag==0){
					$results = $this->admin_model->updatebanner($banner_image);
					if($results){
						$this->session->set_flashdata('success', ' Banner details updated successfully.');
						redirect('adminsettings/banners','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating banner.');
						redirect('adminsettings/addbanner','refresh');
					}
				}
			}	
			$data['action']='new';
			$this->load->view('adminsettings/addbanner',$data);
		}
	}
	// delete banner
	function deletebanner($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('143',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletebanner($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Banner details deleted successfully.');
				redirect('adminsettings/banners','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting banner details.');
				redirect('adminsettings/banners','refresh');
			}
		}
	}
	
	// view all subscribers..
	function subscribers()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('135',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'subscribers','subscriber_id');
				 }	
				if($results){
					
					$this->session->set_flashdata('success', 'Subscribers details deleted successfully.');
					redirect('adminsettings/subscribers','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Subscribers details.');
					redirect('adminsettings/subscribers','refresh');
				}
			}
			$data['subscribers'] = $this->admin_model->subscribers();
			$this->load->view('adminsettings/subscribers',$data);
		}	
	}
	
	
	// delete subscriber..
	function deletesubscriber($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('136',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletesubscriber($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Subscriber email deleted successfully.');
				redirect('adminsettings/subscribers','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting subscriber email.');
				redirect('adminsettings/subscribers','refresh');
			}
		}		
	}
	
	// compose new msg..
	function compose_newsletter(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('134',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			$data['action'] = "new";
			$this->load->view('adminsettings/compose_email',$data);
		}
	}
	
	// send newsletter mail..
	function send_newsletter()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('19',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$to = $this->input->post('to');
				$message = $this->input->post('message');
				$subject = $this->input->post('subject');
				if($message==""){
					$this->session->set_flashdata('subject', $subject);
					$this->session->set_flashdata('error', 'Please enter some message.');
					redirect('adminsettings/compose_newsletter','refresh');
				}
				else { 
					$results = $this->admin_model->send_mail();
					if($results) {
						$this->session->set_flashdata('success', ' Mail Sent successfully.');
						redirect('adminsettings/subscribers','refresh');
					}
					else {
						$this->session->set_flashdata('error', 'Error occurred while sending mail.');
						redirect('adminsettings/compose_newsletter','refresh');
					}
				}
			}
		} 
	}
	
	// edit email template
	function email_template($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if(($admin_id=="") || ($id=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('22',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_email_template = $this->admin_model->get_email_template($id);
			foreach($get_email_template as $get){
				$data['mail_id'] = $get->mail_id;
				$data['email_subject'] = $get->email_subject;
				$data['email_template'] = $get->email_template;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/mailtemplates',$data);
		}
	}
	
	// update email template
	function update_email_template()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('22',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$email_subject = $this->input->post('email_subject');
				$email_template = $this->input->post('email_template');
				$mail_id = $this->input->post('mail_id');
				if($email_template==""){
					$this->session->set_flashdata('email_subject', $email_subject);
					$this->session->set_flashdata('mail_id', $mail_id);
					$this->session->set_flashdata('error', 'Please enter some message.');
					redirect('adminsettings/email_template/'.$mail_id,'refresh');
				}
				else { 
					$results = $this->admin_model->update_email_template();
					if($results) {
						$this->session->set_flashdata('success', ' Email Template updated successfully.');
						redirect('adminsettings/email_template/'.$mail_id,'refresh');
					}
					else {
						$this->session->set_flashdata('error', 'Error occurred while updating template.');
						redirect('adminsettings/email_template/'.$mail_id,'refresh');
					}
				}
			}
		}
	}
	
	// referrals..
	function referrals()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('20',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');
								 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'referrals','referral_id');
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Referrals details Deleted successfully.');
					redirect('adminsettings/referrals','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Referrals details.');
					redirect('adminsettings/referrals','refresh');
				}
			}
			$data['referrals'] = $this->admin_model->referrals();
			$this->load->view('adminsettings/referrals',$data);
		}
	}
	
	// delete referral by user id..	
	function deletereferral($user_id)
	{
		$this->input->session_helper();
		// $user_id -> is a user who referred the other users..
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('20',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		$deletion = $this->admin_model->deletereferral($user_id);
		if($deletion){
				$this->session->set_flashdata('success', ' Referral details deleted successfully.');
				redirect('adminsettings/referrals','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting referral details.');
				redirect('adminsettings/referrals','refresh');
			}
		}
	}
	
	// view all coupons..	
	function coupons($store_name=null){

	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('37',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->coupons_bulk_delete();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Coupons details Deleted successfully.');
					redirect('adminsettings/coupons','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting Coupon details.');
					redirect('adminsettings/coupons','refresh');
				}
			}
			
			//pagination 
			$perpage = 15;
			if($this->uri->segment(3)!='')
			{
				$urisegment=$this->uri->segment(4);
			}
			else
			{  
				$urisegment=$this->uri->segment(3); 
			}
			$base="coupons/all";
			$total_rows = $this->admin_model->count_couponsactive();
			
			$this->pageconfig($total_rows,$base,$perpage);
			
			$data['coupons'] = $this->admin_model->coupons($store_name,$perpage,$urisegment);
			$this->load->view('adminsettings/coupons',$data);
		}
	}	
	
	// upload bulk coupons
	function bulkcoupon(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('35',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$flag=0;
			if($this->input->post('save')){
				$bulkcoupon = $_FILES['bulkcoupon']['name'];
				if($bulkcoupon==""){
					$flag=1;
					$this->session->set_flashdata('error', 'Please upload the file.');
					redirect('adminsettings/bulkcoupon','refresh');
				}
				else {
					$flag=0;
					if($bulkcoupon!="") {
						$new_random = mt_rand(0,99999);
						$bulkcoupon = $_FILES['bulkcoupon']['name'];
						$bulkcoupon = remove_space($new_random.$bulkcoupon);
						$config['upload_path'] ='uploads/coupon';
						$config['allowed_types'] = '*';
						$config['file_name']=$bulkcoupon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($bulkcoupon!="" && (!$this->upload->do_upload('bulkcoupon')))
						{
							$bulkcouponerror = $this->upload->display_errors();
						}
						if(isset($bulkcouponerror))
						{
							$flag=1;
							$this->session->set_flashdata('error',$bulkcouponerror);
							redirect('adminsettings/bulkcoupon','refresh');
						}
					}
					if($flag==0){
						$results = $this->admin_model->bulkcoupon($bulkcoupon);
						if($results){
							$this->session->set_flashdata('success', ' Coupon details added successfully.');
							redirect('adminsettings/coupons','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding coupon details.');
							redirect('adminsettings/bulkcoupon','refresh');
						}
					}
				}
			$result = $this->admin_model->bulkcoupon();
			if($result){
					$this->session->set_flashdata('success', ' Coupon details added successfully.');
					redirect('adminsettings/coupons','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while adding coupon details.');
					redirect('adminsettings/bulkcoupon','refresh');
				}
			}
			$data['action'] = "new";
			$this->load->view('adminsettings/bulkcoupon',$data);
		}	
	}
	
	// add single coupon
	function addcoupon(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('36',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			if($this->input->post('save')){
				
			$insert = $this->admin_model->addcoupon();
				if($insert){
					$this->session->set_flashdata('success', ' Coupon details added successfully.');
					redirect('adminsettings/coupons','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while adding coupon details.');
					redirect('adminsettings/addcoupon','refresh');
				}
			}
		
			$data['action'] = "new";
			$this->load->view('adminsettings/addcoupon',$data);
		}	
	}
	
	// view particular coupon details..
	function editcoupon($coupon_id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('109',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else {
			$coupons = $this->admin_model->editcoupon($coupon_id);
			foreach($coupons as $get){
				$data['coupon_id'] = $get->coupon_id;
				$data['offer_name'] = $get->offer_name;
				$data['title'] = $get->title;
				$data['description'] = $get->description;
				$data['type'] = $get->type;
				$data['code'] = $get->code;
				$data['category_name']=$get->category_name;
				$data['offer_page'] = $get->offer_page;
				$data['expiry_date'] = $get->expiry_date;
				$data['start_date'] = $get->start_date;
				$data['featured'] = $get->featured;	//28/11/14 Suhirdha added starts ...
				$data['exclusive'] = $get->exclusive;	//28/11/14 Suhirdha ends...	
				$data['Tracking'] = $get->Tracking;	
				$data['coupon_options'] = $get->coupon_options;	
				
				$data['cashback_description'] = $get->cashback_description;	
				
				
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/addcoupon',$data);			
		}
	}
	
	// update coupon..
	function updatecoupon(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('9',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$updated = $this->admin_model->updatecoupon();
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Coupon details updated successfully.');
					redirect('adminsettings/coupons','refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating coupon details.');
					redirect('adminsettings/coupons','refresh');
				}
			}
		}
	}
	
	// delete coupon..
	function deletecoupon($delete_id){
		$this->input->session_helper();
		$user_access=$this->session->userdata('user_access');
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('110',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletecoupon($delete_id);
			if($deletion){
				$this->session->set_flashdata('success', 'Coupon deleted successfully.');
				redirect('adminsettings/coupons','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting coupon.');
				redirect('adminsettings/coupons','refresh');
			}
		}
	}
	
	//  view all shopping coupons..
	function shoppingcoupons(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->bulk_shopping_delete();
				 }
				 	
				if($results){					
					$this->session->set_flashdata('success', 'Shopping Coupons details deteted successfully.');
					redirect('adminsettings/shoppingcoupons','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Shopping Coupons details.');
					redirect('adminsettings/shoppingcoupons','refresh');
				}
			}
			$data['shoppingcoupons'] = $this->admin_model->shoppingcoupons();
			$this->load->view('adminsettings/shoppingcoupons',$data);
		}
	}
	
	//  view all shopping coupons..
	function expired_coupons()
	{	
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->bulk_shopping_delete();
				 }
				if($results)
				{		
					$this->session->set_flashdata('success', 'Premium Shopping Coupons details deteted successfully.');
					redirect('adminsettings/expired_coupons','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while updating Shopping Coupons details.');
					redirect('adminsettings/expired_coupons','refresh');
				}
			}
			$data['shoppingcoupons'] = $this->admin_model->exp_shoppingcoupons();
			$this->load->view('adminsettings/expired_coupons',$data);
		}
	}
	
	//download coupons
	function download_coupons($status)
	{
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->load->helper('csv_helper');
			$result =$this->admin_model->select_table($status);
			
				$t_date=date('Y-m-d');
					$filename="active_coupons-".$t_date.".xls";
				
				 $test=" offer Name  \t About \t In a nutshel \t The Fine print \t company \t  Location \t Coupon codes \t start_date \t expiry_date";
				   $test.="\n";
				  if(isset($result)){
					  $k=1;
					  foreach($result as $row)
					  {
						   $offer_name=$row->offer_name;
						   //$description = $row->description;
						   $about = $row->about;
						   $nutshel = $row->nutshel;
						   $fine_print = $row->fine_print;
						   $company = $row->company;
						   $location=$row->location;						   
						   $coupon_code = $row->coupon_code;
						  // $remain_coupon_code = $row->remain_coupon_code;
						   $start_date = $row->start_date;
   						   $expiry_date = $row->expiry_date;						   
						   $test.=$offer_name."\t".$about."\t".$nutshel."\t".$fine_print."\t".$company."\t".$location."\t".$coupon_code."\t".$start_date."\t".$expiry_date;
						   $test.="\n";
						  
					   } 
				   }
				   
				   
				 header("Content-type: application/csv");
				//header("Content-type: application/vnd.ms-word");
				//header("Content-type: text/plain");
				header("Content-Disposition: attachment; filename=".$filename);
				header("Pragma: no-cache");
				header("Expires: 2");
				$this->load->helper('file');
				write_file('./backup/'.$filename, $test);
				$data = file_get_contents("./backup/".$filename);
				$urfile=$status."_coupons-".$t_date.".csv";
				$this->load->helper('download');
				force_download($urfile, $data); 
			}
	}
	
	// update shopping coupon..
	function update_shoppingcoupon(){
		$this->input->session_helper();
		$coupon_image = '';
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
			
			$coupon_image = $_FILES['coupon_image']['name'];
		
		/*	if($coupon_image[0]){
				$flag=0;
				$random_no = mt_rand(0,99999);
				$coupon_img = $random_no.$coupon_image;
				$config['upload_path'] ='uploads/premium';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name']=$coupon_img;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($coupon_image!="" && (!$this->upload->do_upload('coupon_image')))
				{
					$coupon_imageerror = $this->upload->display_errors();
				}
				if(isset($coupon_imageerror))
				{
					$flag=1;
					echo $this->session->set_flashdata('error',$coupon_imageerror);
					//print_r($coupon_image);
			exit;
					redirect('adminsettings/add_shoppingcoupon','refresh');
				}
			}*/
			
			if($coupon_image[0]){
				$flag=0;
				// start..
				$name="coupon_image";
				foreach($_FILES[$name] as $key => $val)
				{
					for($i=0;$i<count($val);$i++)
					{
						unset($_FILES['coupon_image'][$key]);
						$_FILES['coupon_image'][$i][$key]=$val[$i];
					}
				}
				$files=$_FILES;
				$all_images = "";
				for($i=0;$i<count($files[$name]);$i++)
				{
					$_FILES['coupon_image1']=$files[$name][$i];
					$coupon_image = $_FILES['coupon_image1']['name'];
					
						$ext = pathinfo($coupon_image, PATHINFO_EXTENSION);
									$file_without_ext = pathinfo($coupon_image, PATHINFO_FILENAME);;
									
									$image_new =  $this->admin_model->seoUrl($file_without_ext);
									$newimage =  $image_new.".".$ext;
					// $this->upload->do_upload("coupon_image1");
					$random_no = mt_rand(100,99999);
					$coupon_img = $random_no.$newimage;
					$config['upload_path'] ='uploads/premium';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name']=$coupon_img;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($coupon_img!="" && (!$this->upload->do_upload('coupon_image1')))
					{
						$coupon_imageerror = $this->upload->display_errors();
					}
					$shoppingcoupon_id = $this->input->post("shoppingcoupon_id");
					// $this->upload->display_errors();
					if(isset($coupon_imageerror))
					{
						$shoppingcoupon_id = $this->input->post("shoppingcoupon_id");
						$flag=1;
						$this->session->set_flashdata('error',$coupon_imageerror);
						redirect('adminsettings/edit_shoppingcoupon/'.$shoppingcoupon_id,'refresh');
					}
					$all_images.= $coupon_img.',';
				}
				$coupon_img1 = rtrim($all_images,',');
				$coupon_img =  str_replace(" ","_",$coupon_img1);
				/*echo $coupon_img;
				exit;*/
		
			}
			else{
				$flag=0;
				$coupon_img = $this->input->post('hidden_coupon_image');
			}
				if($flag==0){
				/*	echo $coupon_img;
					exit;*/
					$updated = $this->admin_model->update_shoppingcoupon($coupon_img);
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' Shopping coupon details updated successfully.');
						redirect('adminsettings/shoppingcoupons','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating shopping coupon details.');
						redirect('adminsettings/shoppingcoupons','refresh');
					}
				}	
			}
		}
	}
	
	// delete shopping coupon..
	function delete_shoppingcoupon($delete_id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->delete_shoppingcoupon($delete_id);
			if($deletion){
				$this->session->set_flashdata('success', 'Shopping Coupon deleted successfully.');
				redirect('adminsettings/shoppingcoupons','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting shopping coupon.');
				redirect('adminsettings/shoppingcoupons','refresh');
			}
		}
	}
	
	
	// delete Exp shopping coupon..
	function delete_exp_shoppingcoupon($delete_id){
		$this->input->session_helper();	
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->delete_shoppingcoupon($delete_id);
			if($deletion){
				$this->session->set_flashdata('success', 'Shopping Coupon deleted successfully.');
				redirect('adminsettings/expired_coupons','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting shopping coupon.');
				redirect('adminsettings/expired_coupons','refresh');
			}
		}
	}
	
	// view all cashback
	function cashback(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			if($this->input->post('hidd'))   //delete multiple cashback  seetha
			{
				if($this->input->post('chkbox'))
				 {
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'cashback','cashback_id');
				 }				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Cashback details deleted successfully.');
					redirect('adminsettings/cashback','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating cashback details.');
					redirect('adminsettings/cashback','refresh');
				}
			}	
			$data['cashbacks'] = $this->admin_model->cashback();
			$this->load->view('adminsettings/cashback',$data);
		}
	}
	
	// view cashback details
	function editcashback($id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else {
			$cashback = $this->admin_model->cashback_details($id);
			if($cashback){
				foreach($cashback as $get){
					$data['cashback_id'] = $get->cashback_id;				
					$data['store'] = $get->affiliate_id;
					$data['coupon_id'] = $get->coupon_id;
					$data['user_id'] = $get->user_id;
					$data['status'] = $get->status;
					$data['cashback_id'] = $get->cashback_id;
					$data['cashback_id'] = $get->cashback_id;
					$data['cashback_id'] = $get->cashback_id;			
				}
				$data['action']='new';
				$this->load->view('adminsettings/editcashback',$data);
			} else {
				redirect('adminsettings/cashback','refresh');
			}
		}	
	}
	
	// update cashback status..
	function updatecashback(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$id = $this->input->post('cashback_id');
				$updation = $this->admin_model->updatecashback($id);
				if($updation){
					$this->session->set_flashdata('success', 'Cashback status updated successfully.');
					redirect('adminsettings/cashback','refresh');
				} else {
					$data['action']="new";
					$this->session->set_flashdata('error', 'Error occurred while updating cashback status.');
					redirect('adminsettings/editcashback/'.$id,'refresh');
				}
			}
		}
	}
	
	// delete cashback details..
	function deletecashback($id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletecashback($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Cashback details deleted successfully.');
				redirect('adminsettings/cashback','refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred while deleting cashback details.');
				redirect('adminsettings/cashback','refresh');
			}
		}
	}	
	
	// view all withdraws..	
	function withdraw(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'withdraw','withdraw_id');
				 }				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Withdraw details deleted successfully.');
					redirect('adminsettings/withdraw','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating withdraw details.');
					redirect('adminsettings/withdraw','refresh');
				}
			}
			$data['withdraws'] = $this->admin_model->withdraw();
			$this->load->view('adminsettings/withdraw',$data);
		}
	}
	
	// change withdraw status..
	function editwithdraw($id){
	$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$withdraw = $this->admin_model->editwithdraw($id);
			if($withdraw){
				foreach($withdraw as $get) { 
					$data['withdraw_id'] = $get->withdraw_id;
					$data['user_id'] = $get->user_id;
					$data['requested_amount'] = $get->requested_amount;
					$data['date_added'] = $get->date_added;
					$data['closing_date'] = $get->closing_date;
					$data['status'] = $get->status;
				}
			} else {
				redirect('adminsettings/withdraw','refresh');
			}
			$data['action'] = 'new';
			$this->load->view('adminsettings/editwithdraw',$data);
		}
	}
	
	
	// change withdraw status..
	function updatewithdraw(){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$id = $this->input->post('withdraw_id');
				$updation = $this->admin_model->updatewithdraw($id);
				if($updation){ 
					$this->session->set_flashdata('success', ' Withdraw status updated successfully.');
					redirect('adminsettings/withdraw','refresh');
				} else { 
					$data['action']="new";
					$this->session->set_flashdata('error', 'Error occurred while updating withdraw status.');
					redirect('adminsettings/editwithdraw/'.$id,'refresh');
				}
			}
		}
	}
	// delete withdraw..
	function deletewithdraw($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletewithdraw($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Withdraw details deleted successfully.');
				redirect('adminsettings/withdraw','refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred while deleting withdraw details.');
				redirect('adminsettings/withdraw','refresh');
			}
		}
	}
	
	// removes code on editing premium coupon.. (through ajax..)
	function delete_shopcoupon(){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else
		{
			$ids = $this->input->post('id');
			$result = $this->admin_model->delete_shopcoupon($ids);
			if($result){
				echo 1;
			}
			else {
				echo 0;
			}
		}	
	}
	
	// change category order..
	function change_cate_order($position,$order_no,$category_id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			// echo $position; echo $order_no; echo $category_id; exit;
			if($position=='up'){
				$new_order = $order_no - 1;
				$result = $this->admin_model->change_cate_order($order_no,$new_order);
				if($result){
					$this->session->set_flashdata('success', 'Category order changed successfully.');
					redirect('adminsettings/categories','refresh');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred while changing category order.');
					redirect('adminsettings/categories','refresh');
				}
			}
			else if($position=='down'){
				$new_order = $order_no + 1;
				$result = $this->admin_model->change_cate_order($order_no,$new_order);
				if($result){
					$this->session->set_flashdata('success', 'Category order changed successfully.');
					redirect('adminsettings/categories','refresh');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred while changing category order.');
					redirect('adminsettings/categories','refresh');
				}
			}
		}
	}
	
	function change_premium_cate_order($position,$order_no,$category_id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			// echo $position; echo $order_no; echo $category_id; exit;
			if($position=='up'){
				$new_order = $order_no - 1;
				$result = $this->admin_model->change_premium_cate_order($order_no,$new_order);
				if($result){
					$this->session->set_flashdata('success', 'Premium Category order changed successfully.');
					redirect('adminsettings/premium_categories','refresh');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred while changing category order.');
					redirect('adminsettings/premium_categories','refresh');
				}
			}
			else if($position=='down'){
				$new_order = $order_no + 1;
				$result = $this->admin_model->change_premium_cate_order($order_no,$new_order);
				if($result){
					$this->session->set_flashdata('success', 'Premium Category order changed successfully.');
					redirect('adminsettings/premium_categories','refresh');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred while changing category order.');
					redirect('adminsettings/premium_categories','refresh');
				}
			}
		}
	}
	
	// get all referrals using use email.. (through ajax..)
	function all_referrals(){
	$this->input->session_helper();	
		$email = $this->input->post('email');
		$all_emails = $this->admin_model->all_referrals($email);
		$final='';
		foreach($all_emails as $get){
			$final .= '<li>'.$get->referral_email.'</li>';
		}
		echo $final;
	}
	
	// function click_history(){
		// echo 'aaa';
	// }
	// view all click history..
	function click_history($user_id=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('43',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->click_history_bulk_delete();
				 }
				if($results){
					$this->session->set_flashdata('success', 'Click History details Deleted successfully.');
					redirect('adminsettings/click_history','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while Deleting Click History details.');
					redirect('adminsettings/click_history','refresh');
				}	
			}
		$data['click_histories'] = $this->admin_model->click_history($user_id);
		$this->load->view('adminsettings/click_history',$data);
		}
	}
	
	//delete click history..
	function deletehistory($id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('118',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletehistory($id);
			if($deletion){
				$this->session->set_flashdata('success', 'History details deleted successfully.');
				redirect('adminsettings/click_history','refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred while deleting history details.');
				redirect('adminsettings/click_history','refresh');
			}
		}
	}
	
	
	//deletecashback
	function deletecashbackdetails($store_id,$id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletecashbackdetails($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Cashback details deleted successfully.');
				redirect('adminsettings/cashback_details/'.$store_id,'refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred while deleting Cashback details.');
				redirect('adminsettings/cashback_details/'.$store_id,'refresh');
			}
		}
	}
	
	// admin signing off..
	function logout() 
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Logged Out successfully.');
		redirect('adminsettings/index','refresh');
	}
	
	// view all sub categories..
	function sub_categories($category=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_sub_categorys_new();
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_sub_categorys_new_delete();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Sub Category details updated successfully.');
					redirect('adminsettings/sub_categories/'.$category,'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Sub category details.');
					redirect('adminsettings/sub_categories/'.$category,'refresh');
				}
			}
			$data['category_id'] = $category;
			$data['categories'] = $this->admin_model->sub_categories($category);
			$this->load->view('adminsettings/sub_categories',$data);
		}
	}
	
	// view all sub categories..
	function premium_sub_categories($category=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['category_id'] = $category;
			$data['categories'] = $this->admin_model->premium_sub_categories($category);
			$this->load->view('adminsettings/premium_sub_categories',$data);
		}
	}
	
	
		// add sub category
	function add_sub_category($categoryid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$results = $this->admin_model->addsubcategory();
				if($results){
					$this->session->set_flashdata('success', 'Sub Category details added successfully.');
					redirect('adminsettings/sub_categories/'.$categoryid,'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while adding category.');
					redirect('adminsettings/add_sub_category/'.$categoryid,'refresh');
				}			
			}
			$data['categoryid']=$categoryid;
			$data['action']='new';
			$this->load->view('adminsettings/add_sub_category',$data);
		}
	}
	
	
		// add sub category
	function add_premium_sub_category($categoryid){
	$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$results = $this->admin_model->addpremiumsubcategory();
				if($results){
					$this->session->set_flashdata('success', 'Sub Category details added successfully.');
					redirect('adminsettings/premium_sub_categories/'.$categoryid,'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while adding category.');
					redirect('adminsettings/add_premium_sub_category/'.$categoryid,'refresh');
				}			
			}
			$data['categoryid']=$categoryid;
			$data['action']='new';
			$this->load->view('adminsettings/add_premium_sub_category',$data);
		}
	}
	
	
	
	// edit sub category..
	function editsubcategory($cate_editid){
	$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if(($admin_id=="") || ($cate_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_category = $this->admin_model->get_subcategory($cate_editid);
			foreach($get_category as $get){
				$data['sun_category_id'] = $get->sun_category_id;
				$data['cate_id'] = $get->cate_id;
				$data['sub_category_name'] = $get->sub_category_name;
				$data['meta_keyword'] = $get->meta_keyword;
				$data['meta_description'] = $get->meta_description;
				$data['category_status'] = $get->category_status;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_sub_category',$data);
		}
	}
	
	// edit sub category..
	function editpremiumsubcategory($cate_editid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if(($admin_id=="") || ($cate_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_category = $this->admin_model->get_premium_subcategory($cate_editid);
			foreach($get_category as $get){
				$data['sun_category_id'] = $get->sun_category_id;
				$data['cate_id'] = $get->cate_id;
				$data['sub_category_name'] = $get->sub_category_name;
				$data['meta_keyword'] = $get->meta_keyword;
				$data['meta_description'] = $get->meta_description;
				$data['category_status'] = $get->category_status;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_premium_sub_category',$data);
		}
	}
	
	// update sub category	
	function updatesubcategory($categoryid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$updated = $this->admin_model->update_subcategory();
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', 'Sub Category details updated successfully.');
					redirect('adminsettings/sub_categories/'.$categoryid,'refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/sub_categories/'.$categoryid,'refresh');
				}
			}		
		}	
	}
	
	// update sub category	
	function updatepremiumsubcategory($categoryid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$updated = $this->admin_model->update_permiumsubcategory();
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', 'Sub Category details updated successfully.');
					redirect('adminsettings/premium_sub_categories/'.$categoryid,'refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/premium_sub_categories/'.$categoryid,'refresh');
				}
			}		
		}	
	}
	
	//delete sub category..
	function deletesubcategory($id,$mainid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletesubcategory($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Sub Category deleted successfully.');
				redirect('adminsettings/sub_categories/'.$mainid,'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting category.');
				redirect('adminsettings/sub_categories'.$mainid,'refresh');
			}
		}	
	}
	
	//delete sub category..
	function deletepremiumsubcategory($id,$mainid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletepremiumsubcategory($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Sub Category deleted successfully.');
				redirect('adminsettings/premium_sub_categories/'.$mainid,'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting category.');
				redirect('adminsettings/premium_sub_categories'.$mainid,'refresh');
			}
		}	
	}
	
	
	// view all affiliates..
	function site_affiliates(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->delete_multi_site_affiliate();
				 }
				if($results){
					
					$this->session->set_flashdata('success', 'Site Affiliates Deleted successfully.');
					redirect('adminsettings/site_affiliates','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting Site Affiliates details.');
					redirect('adminsettings/site_affiliates','refresh');
				}
			}
			
			$data['affiliates'] = $this->admin_model->site_affiliates();
			$this->load->view('adminsettings/site_affiliates',$data);
		}
	}
	
	// add new affiliate
	
	function site_addaffiliate(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('51',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$flag=0;
				
						$results = $this->admin_model->site_addaffiliate();
						if($results){
							$this->session->set_flashdata('success', ' Affiliate details added successfully.');
							redirect('adminsettings/site_affiliates','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding affiliate.');
							redirect('adminsettings/site_addaffiliate','refresh');
						}
					
				}
			}
			$data['action']='new';
			$this->load->view('adminsettings/site_addaffiliate',$data);
		}
	
	// edit affiliate	
	function site_editaffiliate($id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('124',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_affiliate = $this->admin_model->site_get_affiliate($id);
			foreach($get_affiliate as $get){
				$data['affiliate_id'] = $get->affiliate_id;
				$data['affiliate_name'] = $get->affiliate_name;
				$data['affiliate_type'] = $get->affiliate_type;
				$data['affiliate_status'] = $get->affiliate_status;
				$data['affiliate_param'] = $get->affiliate_param;
				$data['affiliate_traking_param'] = $get->affiliate_traking_param;
				$data['affiliate_traking_param2'] = $get->affiliate_traking_param2;
				$data['aff_url'] = $get->aff_url;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/site_addaffiliate',$data);		
		}
	}
	
	// update affiliate
	function site_updateaffiliate(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$flag=0;
				$affiliate_id = $this->input->post('affiliate_id');		
						$results = $this->admin_model->site_updateaffiliate();
						
						if($results){
							$this->session->set_flashdata('success', ' Affiliates details updated successfully.');
							redirect('adminsettings/site_affiliates','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while updating store details.');
							redirect('adminsettings/site_addaffiliate','refresh');
						}
					}
		}
	}
	
	// delete affiliate
	function site_deleteaffiliate($id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('125',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->site_deleteaffiliate($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Affiliates details deleted successfully.');
				redirect('adminsettings/site_affiliates','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting Affiliates details.');
				redirect('adminsettings/site_affiliates','refresh');
			}
		}
	}
	
	/************ Dec 11th *************/
	
		// Missing cashback
	function missing_cashback(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('46',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				
				 if($this->input->post('chkbox'))
				 {
					 $sort_order = $this->input->post('chkbox');
					 $results = $this->admin_model->delete_bulk_records($sort_order,'missing_cashback','cashback_id');
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Missing Cashback details updated successfully.');
					redirect('adminsettings/missing_cashback','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Missing Cashback details.');
					redirect('adminsettings/missing_cashback','refresh');
				}
			}
			$data['allmissing_cashbacks'] = $this->admin_model->get_all_missing_cashback();
			$this->load->view('adminsettings/missing_cashback',$data);
		}	
	}
	
	// view particular cashback details..
	function view_missing_cashback($cashbcakid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if(($admin_id=="") || ($cashbcakid=="")) {
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('123',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['missing_cashback'] = $this->admin_model->view_missing_cb($cashbcakid);
			$this->load->view('adminsettings/view_missing_cashback',$data);
		}	
	}
	
	// update cashback status..
	function cashbackupdate(){
		$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id=="") {
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('15',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		/*	print_r($this->input->post());
			exit;*/
			if($this->input->post('save')){
			$updated = $this->admin_model->missiing_cashback_update();
				if($updated){
					$this->session->set_flashdata('success', 'Missing Cashback details updated successfully.');
					redirect('adminsettings/missing_cashback','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Missing Cashback details.');
					redirect('adminsettings/missing_cashback','refresh');
				}
			}
		}	
	}
	
	// delete cashback details..
	function delete_missing_cashback($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('121',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->delete_missing_cashback($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Missing Cashback deleted successfully.');
				redirect('adminsettings/missing_cashback','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting Missing Cashback details.');
				redirect('adminsettings/missing_cashback','refresh');
			}
		}
	}
	
	
	/************ Dec 11th *************/
	
	
	/************ Dec 12th *************/
	// upload bulk Stores
	function bulk_store(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('7',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$flag=0;
			if($this->input->post('save')){
				$bulkcoupon = $_FILES['bulkcoupon']['name'];
				if($bulkcoupon==""){
					$flag=1;
					$this->session->set_flashdata('error', 'Please upload the file.');
					redirect('adminsettings/bulk_store','refresh');
				}
				else {
					$flag=0;
					if($bulkcoupon!="") {
						$new_random = mt_rand(0,99999);
						$bulkcoupon = $_FILES['bulkcoupon']['name'];
						$bulkcoupon = remove_space($new_random.$bulkcoupon);
						$config['upload_path'] ='uploads/stores';
						$config['allowed_types'] = '*';
						$config['file_name']=$bulkcoupon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($bulkcoupon!="" && (!$this->upload->do_upload('bulkcoupon')))
						{
							$bulkcouponerror = $this->upload->display_errors();
						}
						if(isset($bulkcouponerror))
						{
							$flag=1;
							$this->session->set_flashdata('error',$bulkcouponerror);
							redirect('adminsettings/bulk_store','refresh');
						}
					}
					if($flag==0){
						$results = $this->admin_model->bulk_stores($bulkcoupon);
						if($results){
							$this->session->set_flashdata('success', ' Store details added successfully.');
							redirect('adminsettings/affiliates','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding Store details.');
							redirect('adminsettings/bulk_store','refresh');
						}
					}
				}
			$result = $this->admin_model->bulk_stores();
			if($result){
					$this->session->set_flashdata('success', ' Store details added successfully.');
					redirect('adminsettings/affiliates','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while adding Store details.');
					redirect('adminsettings/bulk_store','refresh');
				}
			}
			$data['action'] = "new";
			$this->load->view('adminsettings/bulk_store',$data);
		}	
	}
	
	
	function report_upload()
	{
		$this->input->session_helper();
		/*$st = 'CSKRT230001';
		echo $ss = decode_userid($st);*/
			$sub_access=$this->session->userdata('sub_access');
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('44',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$flag=0;
			if($this->input->post('save')){
				$bulkcoupon = $_FILES['bulkcoupon']['name'];
				if($bulkcoupon==""){
					$flag=1;
					$this->session->set_flashdata('error', 'Please upload the file.');
					redirect('adminsettings/report_upload','refresh');
				}
				else {
					$flag=0;
					if($bulkcoupon!="") {
						$new_random = mt_rand(0,99999);
						$bulkcoupon = $_FILES['bulkcoupon']['name'];
						$bulkcoupon =remove_space($new_random.$bulkcoupon);
						$config['upload_path'] ='uploads/reports';
						$config['allowed_types'] = '*';
						$config['file_name']=$bulkcoupon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($bulkcoupon!="" && (!$this->upload->do_upload('bulkcoupon')))
						{
							$bulkcouponerror = $this->upload->display_errors();
						}
						if(isset($bulkcouponerror))
						{
							$flag=1;
							$this->session->set_flashdata('error',$bulkcouponerror);
							redirect('adminsettings/report_upload','refresh');
						}
					}
					if($flag==0){
						$results = $this->admin_model->upload_reports($bulkcoupon);
						if($results){
							$this->session->set_flashdata('success', 'Reports uploaded successfully.');
							redirect('adminsettings/pending_cashback','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while uploading reports.');
							redirect('adminsettings/report_upload','refresh');
						}
					}
				}
			$result = $this->admin_model->upload_reports();
				if($result){
						$this->session->set_flashdata('success', 'Reports uploaded successfully.');
						redirect('adminsettings/pending_cashback','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while uploading reports.');
						redirect('adminsettings/report_upload','refresh');
					}
			}
			$data['action'] = "new";
			$this->load->view('adminsettings/report_upload',$data);
		}	
	}
	
	function reports()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('45',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->reports_bulk_delete();
				 }
				if($results){
					
					$this->session->set_flashdata('success', 'reports details updated successfully.');
					redirect('adminsettings/reports','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating reports details.');
					redirect('adminsettings/reports','refresh');
				}
			}
			$data['coupons'] = $this->admin_model->reports();
			$this->load->view('adminsettings/reports',$data);
		}
	}
	
	function view_report($report_id){
		$admin_id = $this->session->userdata('admin_id');
			$sub_access=$this->session->userdata('sub_access');
		
		if(($admin_id=="") || ($report_id=="")) {
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('120',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
			{
				$data['user'] = $this->admin_model->view_report($report_id);
				$this->load->view('adminsettings/view_report',$data);
			}	
	}
	
	
	function transactions()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('26',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'transation_details','trans_id');
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Transactions details updated successfully.');
					redirect('adminsettings/transactions','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating transactions details.');
					redirect('adminsettings/transactions','refresh');
				}
			}
			$data['coupons'] = $this->admin_model->transactions();
			$this->load->view('adminsettings/transactions',$data);
		}
	}
	
	
	
	
	/************ Dec 12th *************/
	
	
	/************* Dec 13th ********************/
		// view all cms content
	function blog(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['allcms'] = $this->admin_model->get_allblog();
			$this->load->view('adminsettings/blog',$data);
		}	
	}
	
	// add cms contents..
	function addblog()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
		
				$logo_url = $this->input->post('logo_url');
				
			/*	$site_url = $this->input->post('site_url');*/
				$cms_content = $this->input->post('cms_content');
				$affiliate_logo = $_FILES['affiliate_logo']['name'];
				if($cms_content==""){
					$this->session->set_flashdata('error', 'Please enter BLOG content.');
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addblog','refresh');
				}
				else{
					if($affiliate_logo!="") {
						$new_random = mt_rand(0,99999);
						$affiliate_logo = $_FILES['affiliate_logo']['name'];
						$affiliate_logo = remove_space($new_random.$affiliate_logo);
						$config['upload_path'] ='uploads/blog';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$affiliate_logo;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
						{
							$affiliate_logoerror = $this->upload->display_errors();
						}
						if(isset($affiliate_logoerror))
						{
							$this->session->set_flashdata('error',$affiliate_logoerror);
							redirect('adminsettings/addaffiliate','refresh');
						}
						
					}
					$results = $this->admin_model->addblog($affiliate_logo);
					if($results){
						$this->session->set_flashdata('success', ' BLOG details added successfully.');
						redirect('adminsettings/blog','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while adding BLOG.');
						redirect('adminsettings/addblog','refresh');
					}
				}
			}
			$data['action']='new';
			$this->load->view('adminsettings/addblog',$data);
		}
	}
	
	// view cms content
	function editblog($cms_editid)
	{
		$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_cms = $this->admin_model->get_blogcontent($cms_editid);
			foreach($get_cms as $get){
				$data['cms_id'] = $get->cms_id;
				$data['cms_heading'] = $get->cms_heading;
				$data['cms_metatitle'] = $get->cms_metatitle;
				$data['cms_metakey'] = $get->cms_metakey;
				$data['cms_metadesc'] = $get->cms_metadesc;
				$data['cms_content'] = $get->cms_content;
				$data['cms_status'] = $get->cms_status;
				$data['affiliate_logo'] = $get->affiliate_logo;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/addblog',$data);
		}
	}
	
	// update cms contents..	
	function updateblog()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				
				$cms_content = $this->input->post('cms_content');
				$cms_id = $this->input->post('cms_id');
				
				if($cms_content=="") {
					$this->session->set_flashdata('error', 'Please enter BLOG content.');
					$data['action']="Edit";
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addblog','refresh');
				}
				else {
					$affiliate_logo = $_FILES['affiliate_logo']['name'];
					if($affiliate_logo!="") {
						$new_random = mt_rand(0,99999);
						$affiliate_logo = $_FILES['affiliate_logo']['name'];
						$affiliate_logo =remove_space($new_random.$affiliate_logo);
						$config['upload_path'] ='uploads/blog';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$affiliate_logo;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
						{
							$affiliate_logoerror = $this->upload->display_errors();
						}
						if(isset($affiliate_logoerror))
						{
							
							$this->session->set_flashdata('error',$affiliate_logoerror);
							redirect('adminsettings/editblog'.$cms_id,'refresh');
							
						}
					}
					else {
						$affiliate_logo = $this->input->post('hidden_img');
					}
					
					
					$updated = $this->admin_model->updateblog($affiliate_logo);
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' BLOG details updated successfully.');
						redirect('adminsettings/blog','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating BLOG details.');
						redirect('adminsettings/blog','refresh');
					}
				}
			}		
		}
	}
	
	// delete cms content 
	function deleteblog($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deleteblog($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Blog details deleted successfully.');
				redirect('adminsettings/cms','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting Blog details.');
				redirect('adminsettings/cms','refresh');
			}
		}
	}
	
	
		function get_allcomments($blog_id){
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['blog_id'] = $blog_id;
			$data['allcms'] = $this->admin_model->get_allcomments($blog_id);
			$this->load->view('adminsettings/comments',$data);
		}	
	}
	
	
	function status_change_comments($refid,$blogid)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			//if($this->input->post('save')){
				$flag=0;
						$results = $this->admin_model->status_change_comments($refid);
						
						if($results){
							$this->session->set_flashdata('success', ' Comment Status updated successfully.');
							redirect('adminsettings/get_allcomments/'.$blogid,'refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while updating  Comment Status .');
							redirect('adminsettings/get_allcomments/'.$blogid,'refresh');
						}
					/*}*/
		}
	}
	
	//delete premium  category..
	function delete_comments($id,$blogid)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->delete_comments($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Comments deleted successfully.');
				redirect('adminsettings/get_allcomments/'.$blogid,'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting Comments.');
				redirect('adminsettings/get_allcomments/'.$blogid,'refresh');
			}
		}	
	}
	
	
	function add_comments($blog_id=null)
	{	
			$this->input->session_helper();
			$admin_id = $this->session->userdata('admin_id');
			if($admin_id==""){
				redirect('adminsettings/index','refresh');
			} else
			{
				if($this->input->post('save')){
					$comments = $this->input->post('comments');
					if($comments==""){
						$this->session->set_flashdata('error', 'Please enter Your Comment.');
						// $post_title = $this->input->post('page_title');
						redirect('adminsettings/add_comment','refresh');
					}
					else{
						$blog_id = $this->input->post('blog_id');
						$results = $this->admin_model->add_comments();
						if($results){
							$this->session->set_flashdata('success', ' Comment added successfully.');
							redirect('adminsettings/get_allcomments/'.$blog_id,'refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding Comment.');
							redirect('adminsettings/add_comment','refresh');
						}
					}
				}
				$data['blog_id']=$blog_id;
				$data['blog_id']=$blog_id;
				$data['action']='new';
				$this->load->view('adminsettings/add_comment',$data);
			}
			
	}
	/*****************Dec 13th *****************/
	
	/*****************Dec 15th *****************/
	function manual_credit($passing_userid=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
				$sub_access=$this->session->userdata('sub_access');
			if($admin_id==""){
				redirect('adminsettings/index','refresh');
			} else if((!(in_array('58',$this->session->userdata('sub_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else
			{
				if($this->input->post('save'))
				{
					$results = $this->admin_model->add_manual_credit();
					if($results){
						$this->session->set_flashdata('success', ' Transaction has been successfully complete.');
						redirect('adminsettings/manual_credit','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while Transaction.');
						redirect('adminsettings/manual_credit','refresh');
					}
				}
				$data['action']='new';
				$data['passing_userid']=$passing_userid;
				$this->load->view('adminsettings/manual_credit',$data);
			}
	}	
	/*****************Dec 15th *****************/
// 5/12/2014   renuka  
// edit particular coupon..   
 
	function edit_shoppingcoupon($coupon_id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('10',$this->session->userdata('user_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else {
			$coupons = $this->admin_model->edit_shoppingcoupon($coupon_id);
			foreach($coupons as $get){
				$data['shoppingcoupon_id'] = $get->shoppingcoupon_id;
				$data['promo_id'] = $get->promo_id;
				$data['offer_id'] = $get->offer_id;
				$data['offer_name'] = $get->offer_name;
				$data['title'] = $get->title;
				$data['coupon_image'] = $get->coupon_image;
				$data['description'] = $get->description;
				$data['store_categorys'] = $get->category;
				
				$data['user_max'] = $get->user_max;
				$data['type'] = $get->type;
				$data['amount'] = $get->amount;    
				$data['features'] = $get->features; 
				$data['coupon_code'] = $get->coupon_code;   
				
				
					$data['about'] = $get->about;
				$data['company'] = $get->company;    
				$data['nutshel'] = $get->nutshel; 
				$data['fine_print'] = $get->fine_print;   
			
				$data['location'] = $get->location; 
				
				$data['companys'] = $get->company;   
				
				$data['long_description'] = $get->long_description;  
				
				$data['seo_url'] = $get->seo_url;        
				// $data['code'] = $get->code;  	features 	coupon_code
				$data['offer_page'] = $get->offer_page;
				$data['start_date'] = date('m/d/Y',strtotime($get->start_date));
				$data['expiry_date'] = date('m/d/Y',strtotime($get->expiry_date));
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_shoppingcoupon',$data);			
		}
	}	
 
 function add_shoppingcoupon()
 {
  $this->input->session_helper(); 
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('10',$this->session->userdata('user_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else
		{	
			if($this->input->post('save')){
				// echo "<pre>";
				// print_r($this->input->post());
				// exit;
			$coupon_images = $_FILES['coupon_image']['name'];
			
			 
			$all_images='';
			if($coupon_images!=""){
				$flag=0;
				 
				$name="coupon_image";
				foreach($_FILES[$name] as $key => $val)
				{
					for($i=0;$i<count($val);$i++)
					{
						unset($_FILES['coupon_image'][$key]);
						$_FILES['coupon_image'][$i][$key]=$val[$i];
					}
				}
				$files=$_FILES;
				for($i=0;$i<count($files[$name]);$i++)
				{
					$_FILES['coupon_image1']=$files[$name][$i];
					$coupon_image = $_FILES['coupon_image1']['name'];
					$ext = pathinfo($coupon_image, PATHINFO_EXTENSION);
					$file_without_ext = pathinfo($coupon_image, PATHINFO_FILENAME);;
					
					$image_new =  $this->admin_model->seoUrl($file_without_ext);
					$newimage =  $image_new.".".$ext;
					// $this->upload->do_upload("coupon_image1");
					$random_no = mt_rand(100,99999);
					$coupon_img = $random_no.$newimage;
					$config['upload_path'] ='uploads/premium';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name']=$coupon_img;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($coupon_img!="" && (!$this->upload->do_upload('coupon_image1')))
					{
						$coupon_imageerror = $this->upload->display_errors();
					}
					// $this->upload->display_errors();
					if(isset($coupon_imageerror))
					{
						$flag=1;
						$this->session->set_flashdata('error',$coupon_imageerror);
						redirect('adminsettings/add_shoppingcoupon','refresh');
					}
					$all_images.= $coupon_img.',';
				}
				$all_images = rtrim($all_images,',');
				//end..
				
		/* 		foreach($coupon_images as $key=>$get) {
					$coupon_image = $_FILES['coupon_image']['name'][$key];
					$coupon_image = $get;
					$random_no = mt_rand(100,99999);
					$coupon_img = $random_no.$coupon_image;
					$config['upload_path'] ='uploads/premium';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name']=$coupon_img;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($coupon_images!="" && (!$this->upload->do_multi_upload('coupon_image')))
					{
						$coupon_imageerror = $this->upload->display_errors();
					}
					if(isset($coupon_imageerror))
					{
						$flag=1;
						$this->session->set_flashdata('error',$coupon_imageerror);
						redirect('adminsettings/add_shoppingcoupon','refresh');
					}
					$all_images.= $coupon_img.',';
				}
				$all_images = rtrim($all_images,','); */
			}
				if($flag==0){
					$insert = $this->admin_model->add_shoppingcoupon($all_images);
					if($insert){
						$this->session->set_flashdata('success', ' Shopping Coupon details added successfully.');
						redirect('adminsettings/shoppingcoupons','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while adding coupon details.');
						redirect('adminsettings/add_shoppingcoupon','refresh');
					}
				}
			}
			$data['action'] = "new";
			$this->load->view('adminsettings/add_shoppingcoupon',$data);
		}	
 }
function reviews()
{
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('12',$this->session->userdata('user_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->bulk_reviews_delete();
				 }
				if($results){
					
					$this->session->set_flashdata('success', 'Reviews details deleted successfully.');
					redirect('adminsettings/reviews','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting reviews details.');
					redirect('adminsettings/reviews','refresh');
				}
			}
			
			$data['reviews'] = $this->admin_model->reviews();
			$this->load->view('adminsettings/reviews',$data);
		}
}
function change_approval($id,$status)
{
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('12',$this->session->userdata('user_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else
		{
			$res1 = $this->admin_model->changestatus($id,$status);
                        if($res1){
				$this->session->set_flashdata('success', ' Reviews approved updated successfully');
				redirect('adminsettings/reviews','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while approve the reviews.');
				redirect('adminsettings/reviews','refresh');
			}
			
		}
	
}
function orders()
{
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('11',$this->session->userdata('user_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->delete_bulk_orders();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Orders Deleted successfully.');
					redirect('adminsettings/orders','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating order details.');
					redirect('adminsettings/orders','refresh');
				}
			}
			
			
			$data['orders'] = $this->admin_model->orders();
			$this->load->view('adminsettings/orders',$data);
		}
}
function forgetpassword()
{
	$this->input->session_helper();	
		if($this->input->post('forget')){
			$result = $this->admin_model->forgetpassword();
			if(!$result){
			$this->session->set_flashdata('error','Email address is incorrect.');
					redirect('adminsettings/forgetpassword','refresh');
			}	
	    	else 
			{
				$this->session->set_flashdata('success','An email is sent to your email address.');
				redirect('adminsettings/forgetpassword','refresh');
			}					
		}
		$this->load->view('adminsettings/forgetpassword');
	
	}
	
	function payment_settings()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if($admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else {
			
				if($this->input->post('save')){
					
				$results = $this->admin_model->payment_settings();
					if($results){
						$this->session->set_flashdata('success', ' Payment details Updated successfully.');
						redirect('adminsettings/payment_settings','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating Payment details .');
						redirect('adminsettings/payment_settings','refresh');
					}
				
			
				}
			
			$admin_details = $this->admin_model->getadmindetails();
			if($admin_details){
				foreach($admin_details as $details){
					$data['merchant_key'] = $details->merchant_key;
					$data['merchant_salt'] = $details->merchant_salt;
					$data['merchant_id'] = $details->merchant_id;
					$data['payment_mode'] = $details->payment_mode;					
				}
				$this->load->view('adminsettings/payment_settings',$data);
			}			
		}		
	}
	
	function gallery()
	{
		$this->input->session_helper();
		$this->load->view('adminsettings/photo_gal');
	}
	
	function category_cashback($category_id=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($category_id=='')
			{
				redirect('adminsettings/affiliates','refresh');
			}
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->click_history_bulk_delete();
				 }
				if($results){
					$this->session->set_flashdata('success', 'Category cashback details Deleted successfully.');
					redirect('adminsettings/category_cashback.php','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while Deleting Category cashback details.');
					redirect('adminsettings/category_cashback.php','refresh');
				}	
			}
		$data['categorys'] = $this->admin_model->category_cashback($category_id);
		$data['store_id'] = $category_id;
		$this->load->view('adminsettings/category_cashback',$data);
		}
	}
	
	function cashback_details($category_id=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('7',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($category_id=='')
			{
				redirect('adminsettings/affiliates','refresh');
			}
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->cashback_details_bulk_delete();
				 }
				if($results){
					$this->session->set_flashdata('success', 'Cashback details Deleted successfully.');
					redirect('adminsettings/cashback_details/'.$category_id,'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while Deleting Cashback details.');
					redirect('adminsettings/cashback_details/'.$category_id,'refresh');
				}	
			}
			$data['cashbacks'] = $this->admin_model->cashback_details_cb($category_id);
			$data['store_details'] = $this->admin_model->site_get_store($category_id);			
			$data['store_id'] = $category_id;
			$this->load->view('adminsettings/cashback_details',$data);
		}
	}
	
	function update_catecashback($store_id,$action,$caskbackid=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('7',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
				if($this->input->post('save')){	
				if($action=='new')
				{
					$results = $this->admin_model->update_catecashback_ins();
				}
				else
				{
					$results = $this->admin_model->update_catecashback_ins($caskbackid);
				}
					if($results){
						$this->session->set_flashdata('success', ' Payment details Updated successfully.');
						redirect('adminsettings/cashback_details/'.$store_id,'refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating Payment details .');
						redirect('adminsettings/cashback_details/'.$store_id,'refresh');
					}
					
				}
				else
				{
					redirect('adminsettings/affiliates','refresh');
				}
					
			
		}
	}
	
	
	// view all affiliates..
	function ads()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('137',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['ads'] = $this->admin_model->ads();
			$this->load->view('adminsettings/ads',$data);
		}
	}
	
	function addads()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('137',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} 
		else
		{
			$this->input->session_helper();
				if($this->input->post('save')){
					$affiliate_logo = $_FILES['affiliate_logo']['name'];
					
					if($affiliate_logo!="") {
						$affiliate_logo = mt_rand(0,99999);
						$affiliate_logo = $_FILES['affiliate_logo']['name'];
						$affiliate_logo =remove_space($affiliate_logo);
						$config['upload_path'] ='uploads/ads';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$affiliate_logo;						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
						{
							$affiliate_logoerror = $this->upload->display_errors();
						}
						
						if(isset($affiliate_logoerror))
						{
							$this->session->set_flashdata('error',$affiliate_logoerror);
							redirect('adminsettings/addads','refresh');
						}
					}
					else {
						$affiliate_logo = $this->input->post('hidden_img');
					}
					
					$updated = $this->admin_model->addads($affiliate_logo);
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' Ads details added successfully.');
						redirect('adminsettings/ads','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating Ads details.');
						redirect('adminsettings/addads','refresh');
					}
			}	
				else
				{
					$this->load->view('adminsettings/edit_ads',$data);
				}
		}
		
	}
	
	
	
	
	
	function update_ads()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('2',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->input->session_helper();
			if($this->input->post('save')){
				$ads_id = $this->input->post('ads_id');
					$affiliate_logo = $_FILES['affiliate_logo']['name'];
					
					if($affiliate_logo!="") {
						$affiliate_logo = mt_rand(0,99999);
						$affiliate_logo = $_FILES['affiliate_logo']['name'];
						$affiliate_logo =remove_space($affiliate_logo.$affiliate_logo);
						$config['upload_path'] ='uploads/ads';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$affiliate_logo;						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
						{
							$affiliate_logoerror = $this->upload->display_errors();
						}
						
						if(isset($affiliate_logoerror))
						{
							$this->session->set_flashdata('error',$affiliate_logoerror);
							redirect('adminsettings/editads/'.$ads_id,'refresh');
						}
					}
					else {
						$affiliate_logo = $this->input->post('hidden_img');
					}
					
					$updated = $this->admin_model->updateads($affiliate_logo);
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' Ads details updated successfully.');
						redirect('adminsettings/editads/'.$ads_id,'refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating Ads details.');
						redirect('adminsettings/editads/'.$ads_id,'refresh');
					}
			}	
		}
	}
	
	//delete premium  category..
	function deleteads($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
	
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('141',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deleteads($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Ads deleted successfully.');
				redirect('adminsettings/ads','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting ads.');
				redirect('adminsettings/ads/','refresh');
			}
		}	
	}
	
	
	
	function editads($ads_id)
	{
		$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('140',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get = $this->admin_model->get_ads($ads_id);
				$data['ads_id'] = $get->ads_id;
				$data['ads_image'] = $get->ads_image;
				$data['ads_url'] = $get->ads_url;
				$data['ads_position'] = $get->ads_position;
			$data['action'] = "edit";
	
			$this->load->view('adminsettings/edit_ads',$data);
		}
	}
	
	function contacts()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('16',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
				if($this->input->post('hidd'))
				{
					$results = $this->admin_model->multi_delete_contacts();
					if($results)
					{
						$this->session->set_flashdata('success', 'Contacts deleted successfully.');
						redirect('adminsettings/contacts','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while deleted Contacts details.');
						redirect('adminsettings/contacts','refresh');
					}			
				}
			$data['contacts'] = $this->admin_model->contacts();
			$this->load->view('adminsettings/contacts',$data);
		}
	}
	
	function deletecontact($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('149',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletecontact($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Contact details deleted successfully.');
				redirect('adminsettings/contacts','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting Contact details.');
				redirect('adminsettings/contacts','refresh');
			}
		}
	}
	
	function download_free_coupons($status)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('9',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->load->helper('csv_helper');
			$result =$this->admin_model->download_free_coupons();
			
				$t_date=date('Y-m-d');
					$filename="coupons-".$t_date.".xls";
				
				 $test=" offer Name  \t Title \t Description \t Type \t Code \t  Offer Page \t start date \t Expiry \t Featured \t Exclusive \t Tracking Extra parameter";
				   $test.="\n";
				  if(isset($result)){
					  $k=1;
					  foreach($result as $row)
					  {
						   $offer_name=$row->offer_name;
						   $title=$row->title;
						   $description=$row->description;
						   $type=$row->type;
						   $code=$row->code;
						   $offer_page=$row->offer_page;
						   $start_date=$row->start_date;
						   $expiry_date=$row->expiry_date;
						   $featured=$row->featured;
						   //$description = $row->description;
						   $exclusive = $row->exclusive;
						   $Tracking = $row->Tracking;
						   					   
						   $test.=$offer_name."\t".$title."\t".$description."\t".$type."\t".$code."\t".$offer_page."\t".$start_date."\t".$expiry_date."\t".$featured."\t".$exclusive."\t".$Tracking;
						   $test.="\n";
						  
					   } 
				   }
				   
				   
				 header("Content-type: application/csv");
				//header("Content-type: application/vnd.ms-word");
				//header("Content-type: text/plain");
				header("Content-Disposition: attachment; filename=".$filename);
				header("Pragma: no-cache");
				header("Expires: 2");
				$this->load->helper('file');
				write_file('./backup/'.$filename, $test);
				$data = file_get_contents("./backup/".$filename);
				$urfile="coupons-".$t_date.".csv";
				$this->load->helper('download');
				force_download($urfile, $data); 
			}
	}
	
	
	
	// add store contents..
	function addstore_cashback($store_id)
	{
		$this->input->session_helper();	
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else {
			$data['action']='new';
			
			$data['store_id']=$store_id;
			$data['store_details'] = $this->admin_model->site_get_store($store_id);			
			$this->load->view('adminsettings/update_catecashback',$data);
		}	
	}
	
	// view store cashback content
	function editstore_cashback($store_id,$cashbackid){
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['store_details'] = $this->admin_model->site_get_store($store_id);			
			$cashback_details = $this->admin_model->cashback_details_byid($cashbackid);
				$data['caskbackid'] = $cashback_details->cbid;				
				$data['cashback_type'] = $cashback_details->cashback_type;
				$data['cashback'] = $cashback_details->cashback;
				$data['cashback_details'] = $cashback_details->cashback_details;
				$data['status'] = $cashback_details->status;
			$data['action'] = "edit";
			$this->load->view('adminsettings/update_catecashback',$data);
		}
	}
	
	// update cms contents..	
	function updatestore_cashback(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				
					if($action=='new')
					{
						$results = $this->admin_model->update_catecashback_ins();
					}
					else
					{
						$results = $this->admin_model->update_catecashback_ins($caskbackid);
					}
						if($results){
							$this->session->set_flashdata('success', ' Payment details Updated successfully.');
							redirect('adminsettings/category_cashback/'.$store_id,'refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while updating Payment details .');
							redirect('adminsettings/update_catecashback/'.$category_id.'/'.$store_id.'/'.$action,'refresh');
						}
						
			}		
		}
	}
	
	// delete cms content 
	function deletestore_cashback($id)
	{
		$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('13',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deletecms($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' CMS details deleted successfully.');
				redirect('adminsettings/cms','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting CMS details.');
				redirect('adminsettings/cms','refresh');
			}
		}
	}
	
	
	function getcitys_listjson($query)
	{
		$this->input->session_helper();
		if($query)
		{
			$citys_list = $this->admin_model->get_typehead_citys_list($query);
		}
		echo json_encode($citys_list);
	}
	function messages()
	{  
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('4',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$fet['messageslist'] = $this->admin_model->get_messages_full();
			$this->load->view('adminsettings/messages',$fet);
		}

	}
	function reply($id)
	{
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('4',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$fet['messages_user'] = $this->admin_model->get_messages_user($id);		
			$this->load->view('adminsettings/reply',$fet);
		}
	}
	function submit_details()
	{
		$this->admin_model->insert_support_message();
		$this->session->set_flashdata('msg','Success ! Message sent successfully');

		redirect('adminsettings/messages','refresh');
	}
	
	// sharmila store reviews...
	function storeviews(){		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		// print_r($admin_id);exit;
		if($admin_id==""){			
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('21',$this->session->userdata('user_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->storereviews_delete();	
				 }				
				if($results){						
					$this->session->set_flashdata('success', 'Store Reviews details deleted successfully.');
					redirect('adminsettings/storeviews','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting Store Reviews details.');
					// redirect('adminsettings/storeviews','refresh');
				}
			}	
			$data['reviews'] = $this->admin_model->storereview();
			$this->load->view('adminsettings/store_review',$data);
		}
	}
	
	function change_status_rev($id,$status)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
			if($admin_id==""){
				redirect('adminsettings/index','refresh');
			} else if((!(in_array('21',$this->session->userdata('user_access')))) && $admin_id!=1) {
				redirect('adminsettings/index','refresh');
			} else
			{
				$data['reviews'] = $this->admin_model->change_storestatus($id,$status);
				redirect('adminsettings/storeviews','refresh');
			}	
	}
	
	//manage sub admins
	function sub_admin($section=null,$sub_admin_id=null,$status=null){
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==''){
			redirect('adminsettings/index','refresh');
		} else { 
			switch($section){
					case "add":
						if($this->input->post('save')){
							$new_random = mt_rand(0,99999);
							$admin_logo = $_FILES['image']['name'];
							if($admin_logo!="") {
							$admin_logo =remove_space($new_random.$admin_logo);
							//$admin_logo = format_filename($admin_logo);  // replaces the non alpha numeric characters with '_'
							$config['upload_path'] ='uploads/adminpro';
							$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico';
							$config['file_name']=$admin_logo;
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);	
							if($admin_logo!="" && (!$this->upload->do_upload('image'))){
								$admin_logoerror = $this->upload->display_errors();
							}
							if(isset($admin_logoerror)){
								$this->session->set_flashdata('error',$admin_logoerror);
								redirect('adminsettings/sub_admin','refresh');
							}
						}
						$result = $this->admin_model->add_sub_admin($admin_logo);
						if($result){
							$this->session->set_flashdata('success', 'Sub admin account added successfully.');
							redirect('adminsettings/sub_admin','refresh');
						} else {
							$this->session->set_flashdata('error', 'Error occurred while adding the sub admin account.');
							redirect('adminsettings/sub_admin','refresh');
						}
					} else {
						$data['page_view'] = 'add';
						$this->load->view('adminsettings/sub_admin',$data);
					}
				break;
				
				case "edit":
					if($this->input->post('save')){
						$new_random = mt_rand(0,99999);
						$admin_logo = $_FILES['update_image']['name'];
						if($admin_logo!=''){
							$new_random = mt_rand(0,99999);							
							$admin_logo =remove_space($new_random.$admin_logo);
							//$admin_logo = format_filename($admin_logo);  // replaces the non alpha numeric characters with '_'
							$config['upload_path'] ='uploads/adminpro';
							$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|ico';
							$config['file_name']=$admin_logo;
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);	
							if($admin_logo!="" && (!$this->upload->do_upload('update_image'))){
								$admin_logoerror = $this->upload->display_errors();
							}
							if(isset($admin_logoerror)){
								$this->session->set_flashdata('error',$admin_logoerror);
								redirect('adminsettings/sub_admin','refresh');
							}
						}else {
							$admin_logo = $this->input->post('hidden_img');
						}
						$result = $this->admin_model->update_sub_admin($admin_logo);
						if($result){
							$this->session->set_flashdata('success', 'Sub admin account updated successfully.');
							redirect('adminsettings/sub_admin','refresh');
						} else {
							$this->session->set_flashdata('error', 'Error occurred while updating the sub admin account.');
							redirect('adminsettings/sub_admin','refresh');
						}
					} else {
						$details = $this->admin_model->get_sub_admin($sub_admin_id);
						if(!$details){
							// $this->session->set_flashdata('error', 'Invalid sub admin account.');
							redirect('adminsettings/sub_admin','refresh');
						} else {
							$data['sub_admin'] = $details;
							$data['page_view'] = 'edit';
							$this->load->view('adminsettings/sub_admin',$data);
						}
					}
				break;
				
				case "delete":
					$result = $this->admin_model->delete_sub_admin($sub_admin_id);
					if($result){
						$this->session->set_flashdata('success', 'Sub admin account deleted successfully.');
						redirect('adminsettings/sub_admin','refresh');
					} else {
						$this->session->set_flashdata('error', 'Error occurred while deleting the sub admin account.');
						redirect('adminsettings/sub_admin','refresh');
					}
				break;
				
				case "status":
					$result = $this->admin_model->change_sub_adminstatus($sub_admin_id,$status);
					if($result){
						if($status=='1'){
							$this->session->set_flashdata('success', 'Sub admin account activated successfully.');
							redirect('adminsettings/sub_admin','refresh');
						} else {
							$this->session->set_flashdata('success', 'Sub admin account de-activated successfully.');
							redirect('adminsettings/sub_admin','refresh');
						} 
					} else {
						$this->session->set_flashdata('error', 'Error occurred while changing the sub admin account.');
						redirect('adminsettings/sub_admin','refresh');
					}
				break;
				case "check":	// through ajax..
					$email = $this->input->post('email');
					if($email!=""){
						$result = $this->admin_model->check_sub_admin($email);
						if($result==0){
							echo 0;	// exists.. failure..
						} else {
							echo 1;	// not exists.. success..
						}
					}
				break;
				default:
					if($this->input->post('hidd')){
						$results = $this->admin_model->multi_delete_subadmin();
						if($results){		
							$this->session->set_flashdata('success', 'Users deleted successfully.');
							redirect('adminsettings/sub_admin','refresh');
						}else{
							$this->session->set_flashdata('error', 'Error occurred while deleted Users details.');
							redirect('adminsettings/sub_admin','refresh');
						}
					}else{
						$data['sub_admins'] = $this->admin_model->fetch_sub_admin();
						$data['page_view'] = 'list';
						$this->load->view('adminsettings/sub_admin',$data);
					}	
				break;
			}
		}
	}
	
	function pending_cashback($process=null,$cashback_id=null){
		$this->input->session_helper();
		$change_type =  $this->uri->segment(3);
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			switch($process){
				case "withdraw_payu":
				$res['user']=$this->admin_model->get_cash_detail($cashback_id);
				/*echo '<pre>';
				print_r($res);die;*/
				$this->load->view('adminsettings/withdarw_payu',$res);
				break;
			case "approve":
	
				$results = $this->admin_model->approve_cashback($cashback_id);
				if($results){
					$this->session->set_flashdata('success', 'Cashback approved successfully.');
					redirect('adminsettings/pending_cashback','refresh');
				} else {
					$this->session->set_flashdata('error', 'Error occurred while approving cashback.');
					redirect('adminsettings/pending_cashback','refresh');
				}
				$data['cashbacks'] = $this->admin_model->pending_cashback($change_type);
				$data['change_type']=$change_type;
				$this->load->view('adminsettings/pending_cashback',$data);
			break;
			case "delete":
				$deletion = $this->admin_model->deletecashback($cashback_id);
				if($deletion){
					$this->session->set_flashdata('success', 'Cashback deleted successfully.');
					redirect('adminsettings/pending_cashback','refresh');
				} else {
					$this->session->set_flashdata('error', 'Error occurred while deleting cashback.');
					redirect('adminsettings/pending_cashback','refresh');
				}
$data['cashbacks'] = $this->admin_model->pending_cashback($change_type);
				$data['change_type']=$change_type;
				$this->load->view('adminsettings/pending_cashback',$data);
			break;
			default:
				if($this->input->post('hidd'))   //delete multiple cashback  seetha
				{
					if($this->input->post('chkbox'))
					{
						$sort_order = $this->input->post('chkbox');					 
						$results = $this->admin_model->delete_bulk_records($sort_order,'cashback','cashback_id');
					}				
					
					if($results){
						
						$this->session->set_flashdata('success', 'Cashback details deleted successfully.');
						redirect('adminsettings/pending_cashback','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating cashback details.');
						redirect('adminsettings/pending_cashback','refresh');
					}
					
				}	
				$data['cashbacks'] = $this->admin_model->pending_cashback($change_type);
				$data['change_type']=$change_type;
				$this->load->view('adminsettings/pending_cashback',$data);
			break;	
			}
		}	
	}
	
	function pending_referral($process=null,$txn_id=null){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('13',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			switch($process){
			case "approve":
				$results = $this->admin_model->approve_referral($txn_id);
				if($results){
					$this->session->set_flashdata('success', 'Referral approved successfully.');
					redirect('adminsettings/pending_referral','refresh');
				} else {
					$this->session->set_flashdata('error', 'Error occurred while approving referral.');
					redirect('adminsettings/pending_referral','refresh');
				}
			break;
			default:
				if($this->input->post('hidd'))
				{
					if($this->input->post('chkbox'))
					{
						$sort_order = $this->input->post('chkbox');
						$results = $this->admin_model->delete_bulk_records($sort_order,'transation_details','trans_id');
					}
					if($results){
						$this->session->set_flashdata('success', 'Referral details updated successfully.');
						redirect('adminsettings/pending_referral','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating referral details.');
						redirect('adminsettings/pending_referral','refresh');
					}
				}
				$data['coupons'] = $this->admin_model->pending_referral();
				$this->load->view('adminsettings/pending_referral',$data);
			break;	
			}
		}	
	}
	
	// view all affiliate_list
	function affiliate_network()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('53',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			    if($this->input->post('hidd'))
				{	
						$results = $this->admin_model->delete_multi_affiliatenetworks();
								if($results){		
									$this->session->set_flashdata('success', 'Affiliate Network deleted successfully.');
									redirect('adminsettings/affiliate_network','refresh');
								}
								else
								{
								$this->session->set_flashdata('error', 'Error occurred while deleted affiliate network  details.');
								redirect('adminsettings/affiliate_network','refresh');
								}
				}
			$data['affiliate_network'] = $this->admin_model->affiliate_network();
			$this->load->view('adminsettings/affiliate_network',$data);
		}	
	}
	function addaffiliate_list()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('52',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			if($this->input->post('save')){
				$flag=0;
				 $affiliate_name = $this->input->post('affiliate_name');
				 $api_key = $this->input->post('api_key');
				 $networkid = $this->input->post('networkid');
				 $tracking_id = $this->input->post('tracking_id');
				 $affiliate_logo = $_FILES['affiliate_logo']['name'];
				 $affiliate_status = $this->input->post('affiliate_status');
					if($affiliate_logo==""){
						$flag=1;
						$this->session->set_flashdata('affiliate_logo',$affiliate_logo);
						$this->session->set_flashdata('error', 'Please upload an image .');
						redirect('adminsettings/addaffiliate_list','refresh');
					}				
					else 
					{
						$flag=0;
						if($affiliate_logo!="") 
						{
							$new_random = mt_rand(0,99999);
							$affiliate_logo = $_FILES['affiliate_logo']['name'];
							$affiliate_logo = remove_space($new_random.$affiliate_logo);
							$config['upload_path'] ='uploads/affiliates';
							$config['allowed_types'] = 'gif|jpg|jpeg|png';
							$config['file_name']=$affiliate_logo;
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
							{
								$affiliate_logoerror = $this->upload->display_errors();
							}
							if(isset($affiliate_logoerror))
							{
								$flag=1;
								$this->session->set_flashdata('affiliate_name',$affiliate_name);
								$this->session->set_flashdata('error',$affiliate_logoerror);
								redirect('adminsettings/addaffiliate_list','refresh');
							}
						}
					if($flag==0)
					{
						$results = $this->admin_model->addaffiliate_list($affiliate_logo);
						if($results){
							$this->session->set_flashdata('success', ' Affiliate Network details added successfully.');
							redirect('adminsettings/affiliate_network','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding affiliate network.');
							redirect('adminsettings/addaffiliate_list','refresh');
						}
					}
				}
			}	
			$data['action']='new';
			$this->load->view('adminsettings/addaffiliate_list',$data);
		}
	}	
	
	
	// edit affiliate_list
	function editaddaffiliate_list($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('126',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			$affiliates = $this->admin_model->get_affiliate_list($id);
			foreach($affiliates as $get){
				$data['affiliate_id'] = $get->id;
				$data['affiliate_network'] = $get->affiliate_network;
				$data['api_key'] = $get->api_key;
				$data['networkid'] = $get->networkid;
				$data['tracking_id'] = $get->tracking_id;
				$data['affiliate_logo'] = $get->affiliate_logo;
				$data['status'] = $get->status;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/addaffiliate_list',$data);
		}
	}
	
	//update affiliate_list
	function updataffiliate_list()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{		
			if($this->input->post('save')){
				$flag=0;
				$affiliate_logo = $this->input->post('affiliate_logo');
				$affiliate_logo = $_FILES['affiliate_logo']['name'];
				if($affiliate_logo!="") {
					$new_random = mt_rand(0,99999);
					$affiliate_logo = $_FILES['affiliate_logo']['name'];
					//$banner_image = $new_random.$banner_image;
					$affiliate_logo = remove_space($new_random.$affiliate_logo);
					$config['upload_path'] ='uploads/affiliates';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name']=$affiliate_logo;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($affiliate_logo!="" && (!$this->upload->do_upload('affiliate_logo')))
					{
						$affiliate_logoerror = $this->upload->display_errors();
					}
					if(isset($affiliate_logoerror))
					{
						$flag=1;
						$this->session->set_flashdata('affiliate_logo',$affiliate_logo);
						$this->session->set_flashdata('error',$affiliate_logoerror);
						redirect('adminsettings/addaffiliate_list','refresh');
					}
				}
				else {
					$flag=0;
					$affiliate_logo = $this->input->post('hidden_img');
				}
				if($flag==0){
					$results = $this->admin_model->updataffiliate_list($affiliate_logo);
					if($results){
						$this->session->set_flashdata('success', ' Affiliate Network details updated successfully.');
						redirect('adminsettings/affiliate_network','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating affiliate network.');
						redirect('adminsettings/addaffiliate_list','refresh');
					}
				}
			}	
			$data['action']='new';
			$this->load->view('adminsettings/addaffiliate_list',$data);
		}
	}
	// delete affiliate_list
	function deleteaffiliate_list($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('127',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deleteaffiliate_list($id);
			if($deletion){
				//$data['action']="Edit";
				$this->session->set_flashdata('success', ' Affiliate Network details deleted successfully.');
				redirect('adminsettings/affiliate_network','refresh');
			}
			else{
			//	$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting affiliate network  details.');
				redirect('adminsettings/affiliate_network','refresh');
			}
		}
	}
	function fetch_report($apikey,$netwrkid)
	{	
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}
		else
		{
			$flag=0;
			if($apikey!='')
			{
				//$url ='https://api.hasoffers.com/Apiv3/json?NetworkId='.$netwrkid.'&Target=Affiliate_Report&Method=getConversions&api_key='.$apikey;
				$url ='https://api.hasoffers.com/Apiv3/json?NetworkId=vcm&Target=Affiliate_Report&Method=getConversions&api_key='.$apikey.'&fields%5B%5D=Browser.display_name&fields%5B%5D=Browser.id&fields%5B%5D=Country.name&fields%5B%5D=Goal.name&fields%5B%5D=Offer.name&fields%5B%5D=OfferUrl.id&fields%5B%5D=OfferUrl.name&fields%5B%5D=OfferUrl.preview_url&fields%5B%5D=PayoutGroup.id&fields%5B%5D=PayoutGroup.name&fields%5B%5D=Stat.ad_id&fields%5B%5D=Stat.affiliate_info1&fields%5B%5D=Stat.affiliate_info2&fields%5B%5D=Stat.affiliate_info3&fields%5B%5D=Stat.affiliate_info4&fields%5B%5D=Stat.affiliate_info5&fields%5B%5D=Stat.approved_payout&fields%5B%5D=Stat.conversion_status&fields%5B%5D=Stat.count_approved&fields%5B%5D=Stat.currency&fields%5B%5D=Stat.offer_id&fields%5B%5D=Stat.datetime&fields%5B%5D=Stat.is_adjustment&fields%5B%5D=Stat.month&fields%5B%5D=Stat.offer_url_id&fields%5B%5D=Stat.sale_amount&fields%5B%5D=Stat.session_datetime&fields%5B%5D=Stat.user_agent';
				//echo $url;exit;
				$content = json_decode(file_get_contents($url),true);
				/* echo '<pre>';
				print_r($content);*/
				//echo $content['response']['status'];
			}
			if($content['response']['status']==1)
			{				
				if($flag==0)
				{
					$results = $this->admin_model->import_reports($content);
					//print_r($results);die;
					$msg =array();					
					/* if($results['output'] ==1){				
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['output']!=1)
					{							
						$msg['success'] = 'Error occurred while importing report details' ;
					}	 */

					if($results['duplicate'] == 0){
						/* $this->session->set_flashdata('success', ' Coupon details added successfully.');
						redirect('adminsettings/affiliate_network','refresh'); */
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['duplicate']!=0){
						
						$msg['success'] = 'New Report details added successfully and <span style="color:red">'.$results['duplicate'].'</span> duplicate records neglected. The duplicate transactions ids are '.$results['trans_id'];
					}					
				}
				
			}
			else {
				$msg['success'] = 'No data found.';
			}
			echo json_encode($msg);		
		}
		
	}
	
	
	function get_coupons($apikey,$netwrkid)
	{			
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}
		else
		{
			$flag=0;
			if($apikey!='')
			{
				// echo $apikey;die;
				//$url = 'http://tools.vcommission.com/coupons/api?NetworkToken='.$apikey.'&NetworkId='.$netwrkid;
				// $url = 'http://tools.vcommission.com/coupons/api?id=48172';
		$url = 'http://tools.vcommission.com/api/coupons.php?apikey='.$apikey;

		
				$content = json_decode(file_get_contents($url),true);
			/*echo '<pre>';
				print_r($content); exit;*/
			}
			// if($content['success']==1)
			// {				
				if($flag==0)
				{
					$results = $this->admin_model->import_coupons($content);
					$msg =array();
					if($results['duplicate'] == 0){
						/* $this->session->set_flashdata('success', ' Coupon details added successfully.');
						redirect('adminsettings/affiliate_network','refresh'); */
						$msg['success'] = 'Coupon details added successfully.';
					}
					else if($results['duplicate']!=0){
						
						$msg['success'] = 'New Coupon details added successfully and <span style="color:red">'.$results['duplicate'].'</span> duplicate records neglected. The duplicate promo ids are '.$results['promo_id'];
					}
				}
				else {
				$msg['success'] = 'Network ID or Token is Missing.';
			    }
			//}
			
			echo json_encode($msg);		
		}
		
	}
	
	/*Nathan Oct 30*/
	// view all specifications..
	function specifications()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('19',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_specification_new();
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_specification_new_delete();
				 }
				if($results)
				{	
					$this->session->set_flashdata('success', 'Specifications details updated successfully.');
					redirect('adminsettings/specifications','refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating specifications details.');
					redirect('adminsettings/specifications','refresh');
				}
			}
			$data['specifications'] = $this->admin_model->specifications();
			$this->load->view('adminsettings/specifications',$data);
		}
	}
	
	
	// change category order..
	function change_spec_order($position,$order_no,$specid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			// echo $position; echo $order_no; echo $specid; exit;
			if($position=='up'){
				$new_order = $order_no - 1;
				$result = $this->admin_model->change_spec_order($order_no,$new_order);
				if($result){
					$this->session->set_flashdata('success', 'Specfication order changed successfully.');
					redirect('adminsettings/specifications','refresh');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred while changing Specfication order.');
					redirect('adminsettings/specifications','refresh');
				}
			}
			else if($position=='down'){
				$new_order = $order_no + 1;
				$result = $this->admin_model->change_spec_order($order_no,$new_order);
				if($result){
					$this->session->set_flashdata('success', 'Specfication order changed successfully.');
					redirect('adminsettings/specifications','refresh');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred while changing Specfication order.');
					redirect('adminsettings/specifications','refresh');
				}
			}
		}
	}
	
	
	function add_specifications($spec=NULL)
	{		
		$this->input->session_helper();
		$admin_id		=	$this->session->userdata('admin_id');
		$user_access	= 	$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('65',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['specfiname']='';
			if($spec)
			{
				$get_specification = $this->admin_model->get_specification($spec);
				if(!$get_specification)
				{
					redirect('adminsettings/specification_options/'.$spec,'refresh');
				}
				$data['specfiname']  = $get_specification->specification;
			}
			if($this->input->post('save'))
			{
				$this->security->cookie_handlers();
				$results = $this->admin_model->add_specifications();
				if($results)
				{
					$this->session->set_flashdata('success', 'Specification details added successfully.');
					if($this->input->post('parant_id')!=0)
					{
						redirect('adminsettings/specification_options/'.$this->input->post('parant_id'),'refresh');
					}
					else
					{
						redirect('adminsettings/specifications','refresh');						
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while adding Specification.');
					if($spec)
					{
						redirect('adminsettings/add_specifications/'.$spec,'refresh');
					}
					else
					{
						redirect('adminsettings/add_specifications','refresh');						
					}
				}
			}
			$data['spec'] = $spec;
			$data['action']='new';
			$this->load->view('adminsettings/add_specifications',$data);
		}
	}
	
	
	function check_specfic()
	{
		$this->input->session_helper();
		$specification = $this->input->post('specification');
		$result = $this->admin_model->check_specfic($specification);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
	}
	
	
	function update_specification()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('64',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			if($this->input->post('save')){
				$id = $this->input->post('specid');
				$updated = $this->admin_model->update_specification();
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Specfication details updated successfully.');
					if($this->input->post('parant_id')!=0)
					{
						redirect('adminsettings/specification_options/'.$this->input->post('parant_id'),'refresh');
					}
					else
					{
						redirect('adminsettings/specifications','refresh');				
					}
					
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating Specfication details.');
					redirect('adminsettings/editspecification/'.$id,'refresh');
				}
			}		
		}
	}
	
	
	// edit specfication..
	function editspecfication($spec_editid)
	{
		$this->input->session_helper();			
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
	
		if(($admin_id=="") || ($spec_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('62',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			$get_specification = $this->admin_model->get_specification($spec_editid);
			if(!$get_specification)
			{
				redirect('adminsettings/specifications','refresh');
			}
				$data['specification'] = $get_specification->specification;
				$data['specification_status'] = $get_specification->specification_status;
				$data['parent'] = $get_specification->parant_id;
				$data['specid'] = $get_specification->specid;
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_specifications',$data);
		}
	}
	
	// edit specfication..
	
	// delete specfication..
	function deletespecfication($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
	
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('63',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_specification = $this->admin_model->get_specification($id);
			if(!$get_specification)
			{
				redirect('adminsettings/specifications','refresh');
			}
			$parant_id = $get_specification->parant_id;
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->deletespecfication($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Specfication deleted successfully.');
				if($parant_id!=0)
				{
					redirect('adminsettings/specification_options/'.$parant_id,'refresh');	
				}
				else
				{
					redirect('adminsettings/specifications','refresh');
				}
				
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting Specfication.');
				if($parant_id!=0)
				{
					redirect('adminsettings/specification_options/'.$parant_id,'refresh');	
				}
				else
				{
					redirect('adminsettings/specifications','refresh');
				}
			}
		}	
	}
	
	// edit specification_option..
	function specification_options($specid=NULL)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if(!isset($specid))
			{
				redirect('adminsettings/specifications/','refresh');
			}
			else
			{
				$get_specification = $this->admin_model->get_specification($specid);
				if(!$get_specification)
				{
					redirect('adminsettings/specifications/','refresh');
				}
			}
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_specification_new();
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_specification_new_delete();
				 }
				if($results)
				{					
					$this->session->set_flashdata('success', 'Specifications details updated successfully.');
					redirect('adminsettings/specification_options/'.$specid,'refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating specifications details.');
					redirect('adminsettings/specification_options/'.$specid,'refresh');
				}
			}
			$data['specfiname']  = $get_specification->specification;
			$data['specifications_id'] = $specid;
			$data['specifications'] = $this->admin_model->specification_options($specid);
			$this->load->view('adminsettings/specifications',$data);
		}
	}
	
	// view all Brands..
	function brands()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('20',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_order_update('brands','brand_id');
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_order_new_delete('brands','brand_id');
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Brand details updated successfully.');
					redirect('adminsettings/brands','refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating brand details.');
					redirect('adminsettings/brands','refresh');
				}
			}
			$data['brands'] = $this->admin_model->brands();
			$this->load->view('adminsettings/brands',$data);
		}
	}
	
	
	// add Brand
	function addbrands()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('68',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			if($this->input->post('save'))
			{
					$this->security->cookie_handlers();
					$brand_image = $_FILES['brand_image']['name'];
			
					if($brand_image!="") {
						$new_random = mt_rand(0,99999);
						$brand_image = remove_space($new_random.$brand_image);
						$config['upload_path'] ='uploads/brands';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$brand_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($brand_image!="" && (!$this->upload->do_upload('brand_image')))
						{
							$brand_imageerror = $this->upload->display_errors();
						}
							if(isset($brand_imageerror))        
							{
								$this->session->set_flashdata('error',$brand_imageerror);
								redirect('adminsettings/addbrands','refresh');
							}
					}
					
					$results = $this->admin_model->addbrand($brand_image);
					if($results)
					{
						$this->session->set_flashdata('success', ' Brand details added successfully.');
						redirect('adminsettings/brands','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while adding brand.');
						redirect('adminsettings/addbrands','refresh');
					}
				
			}
			$data['action']='new';
			$this->load->view('adminsettings/addbrand',$data);
		}
	}
	
	//Check Brand
	function check_brand()
	{
		$this->input->session_helper();
		$brand = $this->input->post('brand_name');
		$result = $this->admin_model->check_brand($brand);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
	}
	
	
	//edit brand
	function editbrand($brand_id)
	{
		$this->input->session_helper();			
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		
		if(($admin_id=="") || ($brand_id=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('66',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_specification = $this->admin_model->get_details_from_id($brand_id,'brands','brand_id');
			if(!$get_specification)
			{
				redirect('adminsettings/brands','refresh');
			}
				
			$this->security->cookie_handlers();
			$get_brand = $this->admin_model->get_brand($brand_id);
			$data['brand_id'] 		= $get_brand->brand_id;
			$data['brand_name']		= $get_brand->brand_name;
			$data['brand_image'] 	= $get_brand->brand_image;
			$data['popular_brand']	= $get_brand->popular_brand;
			$data['brand_url'] 		= $get_brand->brand_url;
			$data['brand_status'] 	= $get_brand->brand_status;
			$data['action'] = "edit";
			$this->load->view('adminsettings/addbrand',$data);
		}
	}
	
		// update brand	
	function updatebrand()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('69',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		
			$this->security->cookie_handlers();
			if($this->input->post('save')){
				$id = $this->input->post('brand_id');
				$brand_image = $_FILES['brand_image']['name'];
				if($brand_image!="") {
						$new_random = mt_rand(0,99999);
						$brand_image = remove_space($new_random.$brand_image);
						$config['upload_path'] ='uploads/brand';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$brand_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($brand_image!="" && (!$this->upload->do_upload('brand_image')))
						{
							$brand_imageerror = $this->upload->display_errors();
						}
							if(isset($brand_imageerror))        
							{
								$this->session->set_flashdata('error',$brand_imageerror);
								redirect('adminsettings/brands','refresh');
							}
					} else {
						$brand_image = $this->input->post('hidden_brand_image');
					}
					
				$updated = $this->admin_model->update_brand($brand_image);
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Brand details updated successfully.');
					redirect('adminsettings/brands','refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating brand details.');
					redirect('adminsettings/editbrand/'.$id,'refresh');
				}
			}	
			else
			{
				redirect('adminsettings/brands','refresh');
			}	
		}
	}
	
	
	//delete Brand..
	function deletebrand($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('67',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_specification = $this->admin_model->get_details_from_id($id,'brands','brand_id');
			if(!$get_specification)
			{
				redirect('adminsettings/brands','refresh');
			}
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->deletebrand($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Brand deleted successfully.');
				redirect('adminsettings/brands','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting brand.');
				redirect('adminsettings/brands','refresh');
			}
		}	
	}
	
	
	/*Nathan Oct 30*/
	
	/*Nathan Nov 01*/
	
	//View all product_categories
	function product_categories($first_level=NULL,$second_level=NULL)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('21',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data = $this->checkleveldetails($first_level,$second_level);			
			$cateredierct_id = $data['category_set_id'];
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_order_update('product_categories','cate_id');
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_order_new_delete_category('product_categories','cate_id');
				 }
				if($results)
				{	
					$this->session->set_flashdata('success', 'Product category details updated successfully.');
					redirect('adminsettings/product_categories/'.$cateredierct_id,'refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating product category details.');
					redirect('adminsettings/product_categories/'.$cateredierct_id,'refresh');
				}
			}
			$data['product_categories'] = $this->admin_model->product_categories($data['category_parent_id']);
			$this->load->view('adminsettings/product_categories',$data);
		}
	}
	
	// add category level
	function checkleveldetails($first_level,$second_level)
	{
			if($first_level==''&&$second_level=='')
			{
				$data['category_level'] =0;
				$data['category_name_title'] ='';
				$data['category_set_id'] ='';
				$data['category_parent_id'] ='';
			}
			else if($first_level!=''&&$second_level=='')
			{
				$data['category_level'] =1;
				$catesp = explode('_',$first_level);
				$cate_id = end($catesp);
				$keyset = array($cate_id,0);
				$valset = array('cate_id','category_level');
				$get_specification = $this->admin_model->get_details_from_id_dynamic($keyset,'product_categories',$valset);
				if(!$get_specification)
				{
					$this->session->set_flashdata('error', 'Error occurred while checking the product category  details.');
					redirect('adminsettings/product_categories','refresh');
				}
				$data['category_name_title'] =$get_specification->category_name;
				$data['category_set_id'] ='sub_'.$get_specification->cate_id;
				$data['category_parent_id'] =$get_specification->cate_id;;
			}
			else
			{
				$catesp = explode('_',$first_level);
				$cate_id = end($catesp);
				$keyset = array($cate_id,0);
				$valset = array('cate_id','category_level');
				$get_specification = $this->admin_model->get_details_from_id_dynamic($keyset,'product_categories',$valset);				
				$catesp2 = explode('_',$second_level);
				$cate_id2 = end($catesp2);
				$keyset2 = array($cate_id2,1);
				$valset2 = array('cate_id','category_level');
				$get_specification2 = $this->admin_model->get_details_from_id_dynamic($keyset2,'product_categories',$valset2);
				if(!$get_specification || !$get_specification2)
				{
					$this->session->set_flashdata('error', 'Error occurred while checking the product category details.');
					redirect('adminsettings/product_categories','refresh');
				}
				
				$data['category_level'] =2;	
				$data['category_name_title'] =$get_specification->category_name.' - '.$get_specification2->category_name;
				$data['category_set_id'] ='sub_'.$get_specification->cate_id.'/'.'sub_'.$get_specification2->cate_id;	
				$data['category_parent_id'] =$get_specification2->cate_id;;		
			}
			return $data;
	}
	
	// add Product category
	function add_product_categories($first_level=NULL,$second_level=NULL)
	{
		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('73',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			$data = $this->checkleveldetails($first_level,$second_level);	
			if($this->input->post('save'))
			{		$cpid = $this->input->post('category_set_id');
					$this->security->cookie_handlers();
					$category_image = $_FILES['category_image']['name'];
					$category_icon = $_FILES['category_icon']['name'];
			
					if($category_image!="") {
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/product_category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('category_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('adminsettings/product_categories/'.$cpid,'refresh');
							}
					}
					
					if($category_icon!="") {
						$new_random = mt_rand(0,99999);
						$category_icon = remove_space($new_random.$category_icon);
						$config['upload_path'] ='uploads/product_category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_icon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_icon!="" && (!$this->upload->do_upload('category_icon')))
						{
							$category_iconerror = $this->upload->display_errors();
						}
							if(isset($category_iconerror))        
							{
								$this->session->set_flashdata('error',$category_iconerror);
								redirect('adminsettings/product_categories/'.$cpid,'refresh');
							}
					}
					$results = $this->admin_model->add_product_categories($category_image,$category_icon);
					
					if($results)
					{
						$this->session->set_flashdata('success', 'Product category details added successfully.');
						redirect('adminsettings/product_categories/'.$cpid,'refresh');
					}
					else
					{

						$this->session->set_flashdata('error', 'Error occurred while adding product category.');
						redirect('adminsettings/add_product_categories/'.$cpid,'refresh');
					}
				}
			$data['action']='new';
			$this->load->view('adminsettings/add_product_categories',$data);
		}
	}
	
	//Check Product category
	function check_product_category()
	{
		$this->input->session_helper();
		$category_name = $this->input->post('category_name');
		$category_level = $this->input->post('category_level');		
		$result = $this->admin_model->check_details_in_db('product_categories','category_name',$category_name,$category_level);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
	}
	
	
		// edit  Product category..
	function edit_product_category($cate_id,$first_level=NULL,$second_level=NULL)
	{
		$this->input->session_helper();			
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		
		if(($admin_id=="") || ($cate_id=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('70',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data = $this->checkleveldetails($first_level,$second_level);
			$catesp = explode('_',$cate_id);
			$cate_editid = end($catesp);
			$get_specification = $this->admin_model->get_details_from_id($cate_editid,'product_categories','cate_id');
			if(!$get_specification)
			{
				redirect('adminsettings/product_categories','refresh');
			}
			$this->security->cookie_handlers();
			$data['cate_id'] = $get_specification->cate_id;
			$data['category_name'] = $get_specification->category_name;
			$data['price_compare']=$get_specification->price_compare;
			$data['category_url'] = $get_specification->category_url;
			$data['meta_keyword'] = $get_specification->meta_keyword;
			$data['meta_description'] = $get_specification->meta_description;
			$data['category_image'] = $get_specification->category_image;
			$data['category_status'] = $get_specification->category_status;
			$data['top_category'] = $get_specification->top_category;
			$data['category_icon'] = $get_specification->category_icon;
			$data['category_level'] = $get_specification->category_level;
			$data['category_specifications'] = $get_specification->category_specifications;
			$data['main_category_specifications']=$get_specification->main_category_specifications;
			$data['category_brands'] = $get_specification->category_brands;
			$data['parent_id'] = $get_specification->parent_id;
			$data['active_store'] = $get_specification->active_store;
		
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_product_categories',$data);
		}
	}
	
	
	// update category	
	function update_product_category()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('72',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			if($this->input->post('save')){
				$cpid = $this->input->post('category_set_id');
				$id = $this->input->post('cate_id');
				$category_name = $this->input->post('category_name');
				$category_image = $_FILES['category_image']['name'];
				$category_icon = $_FILES['category_icon']['name'];
					if($category_image!="") {
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/product_category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('category_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('adminsettings/edit_product_category/'.$category_url.'_'.$id.'/'.$cpid,'refresh');
							}
					} else {
						$category_image = $this->input->post('hidden_category_image');
					}
					if($category_icon!="") {
						$new_random = mt_rand(0,99999);
						$category_icon = remove_space($new_random.$category_icon);
						$config['upload_path'] ='uploads/product_category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_icon;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_icon!="" && (!$this->upload->do_upload('category_icon')))
						{
							$category_iconerror = $this->upload->display_errors();
						}
							if(isset($category_iconerror))        
							{
								$this->session->set_flashdata('error',$category_iconerror);
								redirect('adminsettings/edit_product_category/'.$category_url.'_'.$id.'/'.$cpid,'refresh');
							}
					} else {
						$category_icon = $this->input->post('hidden_category_icon');
					}
					
				$updated = $this->admin_model->update_product_category($category_image,$category_icon);
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Category details updated successfully.');
					redirect('adminsettings/product_categories'.'/'.$cpid,'refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating category details.');
					redirect('adminsettings/edit_product_category/'.$category_url.'_'.$id.'/'.$cpid,'refresh');
				}
			}		
		}
	}
	
	
	//delete delete_product_category..
	function delete_product_category($id,$first_level=NULL,$second_level=NULL)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('71',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$this->security->cookie_handlers();
			$data = $this->checkleveldetails($first_level,$second_level);
			$cateredierct_id = $data['category_set_id'];

			$deletion = $this->admin_model->delete_product_category($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Category deleted successfully.');
				redirect('adminsettings/product_categories/'.$cateredierct_id,'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting category.');
				redirect('adminsettings/product_categories/'.$cateredierct_id,'refresh');
			}
		}	
	}
	
	/*Nathan Nov 01*/
	
	
	/*Nathan Nov 07*/
	
	function scrapping()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_order_update('scrapping','scrap_id');
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_order_new_delete('scrapping','scrap_id');
				 }
				if($results){
					
					$this->session->set_flashdata('success', 'Scrapping details updated successfully.');
					redirect('adminsettings/scrapping','refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating Scrap details.');
					redirect('adminsettings/scrapping','refresh');
				}
			}
			$data['scrapping'] = $this->admin_model->scrapping();
			$this->load->view('adminsettings/scrapping',$data);
		}
	}
	
	
	// add Scrapping
	function add_scrapping()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			if($this->input->post('save'))
			{
					$this->security->cookie_handlers();
					$results = $this->admin_model->add_scrapping();
					if($results)
					{
						$this->session->set_flashdata('success', ' Scrapping details added successfully.');
						redirect('adminsettings/scrapping','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while scrap brand.');
						redirect('adminsettings/add_scrapping','refresh');
					}
				
			}
			$data['action']='new';
			$this->load->view('adminsettings/add_scrapping',$data);
		}
	}
	
	
	/*Nathan Nov 07*/
	
	
	/*Nathan Nov 11*/
	
	// update Scrapping	
	function update_scrapping()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{		
			$this->security->cookie_handlers();
			if($this->input->post('save')){
				$id = $this->input->post('scrap_id');
				$updated = $this->admin_model->update_scrapping();
				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Scrapping details updated successfully.');
					redirect('adminsettings/scrapping','refresh');
				}
				else{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating Scrapping details.');
					redirect('adminsettings/edit_scrapping/'.$id,'refresh');
				}
			}	
			else
			{
				redirect('adminsettings/scrapping','refresh');
			}	
		}
	}
	
	// Edit Scrapping	
	function edit_scrapping($scrap_id)
	{
		$this->input->session_helper();			
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if(($admin_id=="") || ($scrap_id=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_specification = $this->admin_model->get_details_from_id($scrap_id,'scrapping','scrap_id');
			if(!$get_specification)
			{
				redirect('adminsettings/scrapping','refresh');
			}
				
			$this->security->cookie_handlers();
			$data['scrap_id'] 		= $get_specification->scrap_id;
			$data['store_name']		= $get_specification->store_name;
			$data['sort_order'] 	= $get_specification->sort_order;
			$data['store_status']	= $get_specification->store_status;
			$data['description1'] 		= $get_specification->description1;
			$data['description'] 	= $get_specification->description;
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_scrapping',$data);
		}
	}
	
	//delete Brand..
	function deletescrapping($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_specification = $this->admin_model->get_details_from_id($id,'scrapping','scrap_id');
			if(!$get_specification)
			{
				redirect('adminsettings/scrapping','refresh');
			}
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->deletescrapping($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Scrapping details deleted successfully.');
				redirect('adminsettings/scrapping','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting scraping details.');
				redirect('adminsettings/scrapping','refresh');
			}
		}	
	}
	
	
	/*Nathan Nov 11*/
/*Anand Nov 27 */
	
	// add Product
	function add_product(){
		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('75',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{	
			//$data = $this->checkleveldetails($first_level,$second_level);	
			if($this->input->post('save'))
			{		
				$product_image = $_FILES['product_image']['name'];
				
				$new_random = mt_rand(0,99999);
				$product_image = remove_space($new_random.$product_image);
				$config['upload_path'] = 'uploads/products';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $product_image;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($product_image!="" && (!$this->upload->do_upload('product_image')))
				{
					$product_image_error = $this->upload->display_errors();
					if(isset($product_image_error))        
					{
						$this->session->set_flashdata('error',$product_image_error);
						redirect('adminsettings/add_product','refresh');
					}
				}
				
				$results = $this->admin_model->add_products($product_image);
				
				if($results)
				{
					$this->session->set_flashdata('success', 'Product added successfully.');
					redirect('adminsettings/update_product/'.$results,'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while adding product.');
					redirect('adminsettings/add_product','refresh');
				}
			}
			$data['action']='new';
			$data['main_category'] = $this->admin_model->product_categories('0');
			$this->load->view('adminsettings/add_product',$data);
		}
	}
	
	// view all Products..
	function products($cat_id='')
	{
		$this->input->session_helper();
		if($this->uri->segment(3)!='')
		{
			if(base64_decode($this->uri->segment(3))!='all')
			{
				$cat_id = base64_decode($this->uri->segment(3));
			}
			else
			{ 
				$cat_id = base64_decode($this->uri->segment(3)); 
			}
		}
		else
		{
			$cat_id = 'all';
		}
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('22',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_order_update('products','product_id');
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_order_new_delete('products','product_id');
				 }
				if($results){
					$this->session->set_flashdata('success', 'Product details updated successfully.');
					redirect('adminsettings/products','refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating product details.');
					redirect('adminsettings/products','refresh');
				}
			}
			$data['main_category']=$this->admin_model->get_productcategories(10);
			//pagination 
			$perpage = 15;
			if($this->uri->segment(3)!='')
			{
				$urisegment=$this->uri->segment(4);
			}
			else
			{  
				$urisegment=$this->uri->segment(3); 
			}
			$base="products/".base64_encode($cat_id);
			$total_rows = $this->admin_model->count_products($cat_id);
			
			$this->pageconfig($total_rows,$base,$perpage);
			
			$data['products'] = $this->admin_model->fetch_products($cat_id,$perpage,$urisegment);
			$this->load->view('adminsettings/view_products',$data);
		}

	}
	
	//delete Product..
	function delete_product($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('79',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->get_details_from_id($id,'products','product_id');
			if(!$deletion)
			{
				redirect('adminsettings/products','refresh');
			}
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->delete_product($id);
			if($deletion){
				$this->session->set_flashdata('success', ' Product deleted successfully.');
				redirect('adminsettings/products','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting product.');
				redirect('adminsettings/products','refresh');
			}
		}	
	}
	
	//Update status Product..
	function update_product_status($id,$status)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('80',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->get_details_from_id($id,'products','product_id');
			if(!$deletion)
			{
				redirect('adminsettings/products','refresh');
			}
			$this->security->cookie_handlers();
			$deletion = $this->admin_model->update_product_status($id,$status);
			if($deletion == '2'){
				$this->session->set_flashdata('success', 'Product status updated successfully.');
				redirect('adminsettings/products','refresh');
			}
			if($deletion == '1'){
				$this->session->set_flashdata('error', 'Please fill required fields to publish this product');
				redirect('adminsettings/products','refresh');
			}
		}	
	}
	
	//ajax fetch first level category

	function fetch_first_level(){
		
		$cat_id = $this->input->post('cat_id');
		$result = $this->admin_model->product_categories($cat_id);
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
	
	
	// upload galley
	
	function upload_product_gallery($product_id){
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else{
			if($_FILES["file"]["name"]){
				$product_image = $_FILES["file"]["name"];
				$new_random = mt_rand(0,99999);
				$product_image = remove_space($new_random.$product_image);
				$config['upload_path'] = 'uploads/products';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $product_image;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($product_image!="" && (!$this->upload->do_upload('file')))
				{
					$product_image_error = $this->upload->display_errors();
					if(isset($product_image_error))        
					{
						$this->session->set_flashdata('error',$product_image_error);
						redirect('adminsettings/add_product','refresh');
					}
				}else{
					$results = $this->admin_model->upload_product_gallery($product_image,$product_id);
				}
			}
		}
		
	}
	
	// fetch product gallery
	
	function fetch_product_gallery($product_id){
		$result = $this->admin_model->fetch_product_gallery($product_id);
		if($result){
			$data['product_img'] = $result;
			$this->load->view('adminsettings/ajax_load_gallery',$data);
		}
	}
	
	//Delete product gallery
	function delete_product_gallery(){
		$result = $this->admin_model->delete_product_gallery($product_id);
		
	}
	
	
	/*Anand Nov 27 */
	/*Seetha Nov 30*/
	// view all coupons..	
	function api_coupons()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
	
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} 
		else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					$results = $this->admin_model->api_coupons_bulk_delete();
				 }		
				
				if($results){
					
					$this->session->set_flashdata('success', 'Coupons details Deleted successfully.');
					redirect('adminsettings/api_coupons','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting Coupon details.');
					redirect('adminsettings/api_coupons','refresh');
				}
			}
			$data['api_coupons'] = $this->admin_model->api_coupons();
			$this->load->view('adminsettings/api_coupons',$data);
		}
	}	
	//view particular coupon details..
	function api_editcoupon($coupon_id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else {
			$coupons = $this->admin_model->api_editcoupon($coupon_id);
			foreach($coupons as $get){
				$data['coupon_id'] = $get->coupon_id;
				$data['offer_name'] = $get->offer_name;
				$data['category_name'] = $get->category_name;
				$data['title'] = $get->title;
				$data['description'] = $get->description;
				$data['type'] = $get->type;
				$data['code'] = $get->code;
				$data['offer_page'] = $get->offer_page;
				$data['expiry_date'] = $get->expiry_date;
				$data['start_date'] = $get->start_date;
				$data['featured'] = $get->featured;	//28/11/14 Suhirdha added starts ...
				$data['exclusive'] = $get->exclusive;	//28/11/14 Suhirdha ends...	
				$data['Tracking'] = $get->Tracking;	
				$data['coupon_options'] = $get->coupon_options;					
				$data['cashback_description'] = $get->cashback_description;					
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/api_addcoupons',$data);			
		}
	}
	
	//update coupon..
	function api_updatecoupon(){
	$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$coupon_id = $this->input->post('coupon_id');
				$start_date = $this->input->post('start_date');
				$expiry_date =$this->input->post('expiry_date');
				if($start_date > $expiry_date)
				{	
					$this->session->set_flashdata('error', 'Please Enter valid Expiry date.');
					$data['action'] = "edit";
					redirect('adminsettings/api_editcoupon/'.$coupon_id,'refresh');
				}
				else 
				{
				
					$updated = $this->admin_model->api_updatecoupon();
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' Coupon details updated successfully.');
						redirect('adminsettings/api_coupons','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating coupon details.');
						redirect('adminsettings/api_coupons','refresh');
					}
				}
			}
		}
	}
	
	//delete coupon..
	function api_deletecoupon($delete_id){
	$this->input->session_helper();
	
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->api_deletecoupon($delete_id);
			if($deletion){
				$this->session->set_flashdata('success', 'Coupon deleted successfully.');
				redirect('adminsettings/api_coupons','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting coupon.');
				redirect('adminsettings/api_coupons','refresh');
			}
		}
	}
	function api_change_approval($id,$status)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			$res= $this->admin_model->api_changestatus($id,$status);
			if($res){
				$this->session->set_flashdata('success', ' API Coupons approved updated successfully');
				redirect('adminsettings/api_coupons','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while approve api coupon.');
				redirect('adminsettings/api_coupons','refresh');
			}
			//redirect('adminsettings/api_coupons','refresh');
		}
	
	}
	function api_download_free_coupons($status)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}
		else
		{
			//$this->load->helper('csv_helper');
			//$result =$this->admin_model->api_download_free_coupons();
			
				$t_date=date('Y-m-d');
				$filename="coupons-".$t_date.".xls";
			    $this->load->dbutil();
				$this->load->helper('download');
				$delimiter = ",";
				$newline = "\n";
				$query = $this->db->query("SELECT `offer_name`, `title`, `description`, `type` ,`code`,`offer_page`,`start_date`,`expiry_date`,`featured`,`exclusive`,`Tracking` FROM `coupons` ");
				$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
				force_download($filename, $data);

				/*$test="offer Name  \t\t\t\t Title \t\t Description \t\t Type \t\t Code \t\t  Offer Page \t\t start date \t\t Expiry \t\t Featured \t\t Exclusive \t\t Tracking Extra parameter";
				   $test.="\n";
					if(isset($result)){
					  $k=1;
					  foreach($result as $row)
					  {
						   $offer_name=$row->offer_name;
						   $title=$row->title;
						   $description=stripcslashes($row->description);
						   $type=$row->type;
						   $code=$row->code;
						   $offer_page=$row->offer_page;
						   $start_date=$row->start_date;
						   $expiry_date=$row->expiry_date;
						   $featured=$row->featured;
						   //$description = $row->description;
						   $exclusive = $row->exclusive;
						   $Tracking = $row->Tracking;
						   					   
						   $test.=$offer_name."\t".$title."\t".$description."\t".$type."\t".$code."\t".$offer_page."\t".$start_date."\t".$expiry_date."\t".$featured."\t".$exclusive."\t".$Tracking;
						   $test.="\n";
						  
					   } 
				   }
				   
				   
				header("Content-type: application/csv");
				//header("Content-type: application/vnd.ms-word");
				//header("Content-type: text/plain");
				header("Content-Disposition: attachment; filename=".$filename);
				header("Pragma: no-cache");
				header("Expires: 2");
				$this->load->helper('file');
				write_file('./backup/'.$filename, $test);
				$data = file_get_contents("./backup/".$filename);
				$urfile="coupons-".$t_date.".csv";
				$this->load->helper('download');
				force_download($urfile, $data); */
			}
	}
	function inactive_categories()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('4',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					$results = $this->admin_model->inactivecoupons_bulk_delete();
				 }		
				
				if($results){
					
					$this->session->set_flashdata('success', 'Inactive Category details Deleted successfully.');
					redirect('adminsettings/inactive_categories','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting inactive category details.');
					redirect('adminsettings/inactive_categories','refresh');
				}
			}
			$data['inactive_categories'] = $this->admin_model->inactive_categories();
			$this->load->view('adminsettings/inactive_categories',$data);
		}
	}
	function api_change_approvalcate($id,$status)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			$updated = $this->admin_model->api_changestatuscate($id,$status);
			if($updated){
				
				$this->session->set_flashdata('success', ' Category approved updated successfully.');
				redirect('adminsettings/inactive_categories','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while approve category details.');
				redirect('adminsettings/inactive_categories/'.$id,'refresh');
			}
			//redirect('adminsettings/inactive_categories','refresh');
		}
	
	}
	/*Seetha Nov 30*/

/*Nathan Dec 08 2015*/

/*Dynamic Price Scrapping*/
	function comparision_cron()
	{	
		$overall_request = $this->admin_model->scrapping_cron(1);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron1()
	{	
		$overall_request = $this->admin_model->scrapping_cron(2);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron2()
	{	
		$overall_request = $this->admin_model->scrapping_cron(3);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron3()
	{	
		$overall_request = $this->admin_model->scrapping_cron(4);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron4()
	{	
		$overall_request = $this->admin_model->scrapping_cron(5);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron5()
	{	
		$overall_request = $this->admin_model->scrapping_cron(6);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron6()
	{	
		$overall_request = $this->admin_model->scrapping_cron(6);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron7()
	{	
		$overall_request = $this->admin_model->scrapping_cron(8);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron8()
	{	
		$overall_request = $this->admin_model->scrapping_cron(9);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}
	function comparision_cron9()
	{	
		$overall_request = $this->admin_model->scrapping_cron(10);
		
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id	= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 	= $this->admin_model->gettags($store_id);
		        $beginning_tag 	= $gettags->description;
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
		        $final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);		
			$this->admin_model->update_cron_price($final_price, $request_id);

		}
	}

        function comparision_cron_repeat()
	{	
		$overall_request = $this->admin_model->scrapping_cron_repeat();
		foreach($overall_request as $request)
		{
			$producturl 	= $request->product_url;
			$store_id		= $request->store_id;
			$request_id 	= $request->pp_id;
			$gettags 		= $this->admin_model->gettags($store_id);
			$beginning_tag 	= $gettags->description;
			
			$ending_tag 	= $gettags->description1;
			$this->load->library('Comparisionclass');
			$final_price = $this->comparisionclass->get_price_from_store($producturl,$beginning_tag,$ending_tag);
			
			$this->admin_model->update_cron_price_repeat($final_price, $request_id);

		}
	}
	/*Dynamic Price Scrapping*/

    /*Nathan Dec 08 2015*/
   /*	Seetha Dec 10 2015*/
	//Rewards sections 
	function rewards()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('55',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_order_update('rewards','rewards_id');
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_order_new_delete('rewards','rewards_id');
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Rewards details updated successfully.');
					redirect('adminsettings/rewards','refresh');
				}
				else{
					$this->security->cookie_handlers();
					$this->session->set_flashdata('error', 'Error occurred while updating rewards details.');
					redirect('adminsettings/rewards','refresh');
				}
			}
			$data['rewards'] = $this->admin_model->rewards();
			$this->load->view('adminsettings/rewards',$data);
		}
	}	
	function addrewards()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('130',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			if($this->input->post('save'))
			{
					$this->security->cookie_handlers();
					$rewards_image = $_FILES['rewards_image']['name'];
			
					if($rewards_image!="") {
						$new_random = mt_rand(0,99999);
						$rewards_image = remove_space($new_random.$rewards_image);
						$config['upload_path'] ='uploads/rewards';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|php';
						$config['file_name']=$rewards_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($rewards_image!="" && (!$this->upload->do_upload('rewards_image')))
						{
							$rand_imageerror = $this->upload->display_errors();
						}
							if(isset($rand_imageerror))        
							{
								$this->session->set_flashdata('error',$rand_imageerror);
								redirect('adminsettings/addrewards','refresh');
							}
					}
					
					$results = $this->admin_model->addrewards($rewards_image);
					if($results)
					{
						$this->session->set_flashdata('success', ' Rewards details added successfully.');
						redirect('adminsettings/rewards','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred while adding rewards.');
						redirect('adminsettings/addrewards','refresh');
					}
				
			}
			$data['action']='new';
			$this->load->view('adminsettings/add_rewards',$data);
		}
	}
	function editrewards($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('128',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_rewards = $this->admin_model->get_rewards($id);
			foreach($get_rewards as $get){
				$data['rewards_id'] = $get->rewards_id;
				$data['cob_coins'] = $get->cob_coins;
				$data['rewards_title'] = $get->rewards_title;
				$data['rewards_image'] = $get->rewards_image;
				$data['rewards_status'] = $get->rewards_status;
			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/add_rewards',$data);
		}
	}
	
	//update rewards
	function updaterewards()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else
		{		
			if($this->input->post('save')){
				$flag=0;
				$id = $this->input->post('rewards_id');
				$rewards_image = $_FILES['rewards_image']['name'];
				if($rewards_image!="") {
					$new_random = mt_rand(0,99999);
					$rewards_image = remove_space($new_random.$rewards_image);
					$config['upload_path'] ='uploads/rewards';
					$config['allowed_types'] = 'php|gif|jpg|jpeg|png';
					$config['file_name']=$rewards_image;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($rewards_image!="" && (!$this->upload->do_upload('rewards_image')))
					{
						$rewards_imageerror = $this->upload->display_errors();
					}
					if(isset($rewards_imageerror))
					{
						$flag=1;
						$this->session->set_flashdata('rewards_image',$rewards_image);
						$this->session->set_flashdata('error',$rewards_imageerror);
						redirect('adminsettings/editrewards/'.$id,'refresh');
					}
				}
				else {
					$flag=0;
					$rewards_image = $this->input->post('hidden_rewards_image');
				}
				if($flag==0){
					$results = $this->admin_model->updaterewards($rewards_image);
					if($results){
						$this->session->set_flashdata('success', ' Rewards details updated successfully.');
						redirect('adminsettings/rewards','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating rewards.');
						redirect('adminsettings/addrewards','refresh');
					}
				}
			}	
			$data['action']='new';
			$this->load->view('adminsettings/add_rewards',$data);
		}
	}
	
	// delete rewards
	function deleterewards($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('129',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deleterewards($id);
			if($deletion){
				$data['action']="Edit";
				$this->session->set_flashdata('success', ' Rewards details deleted successfully.');
				redirect('adminsettings/rewards','refresh');
			}
			else{
				$data['action']="Edit";
				$this->session->set_flashdata('error', 'Error occurred while deleting rewards details.');
				redirect('adminsettings/rewards','refresh');
			}
		}
	}
	//rewards settings	
	function rewards_settings()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('56',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else {
			$rewards_details = $this->admin_model->rewards_settings();
			if($rewards_details){
				foreach($rewards_details as $det){
					$data['res_id'] = $det->res_id;
					$data['cob_coins'] = $det->cob_coins;
					$data['terms_conditions'] = $det->terms_conditions;
					$data['max_points'] = $det->max_points;					
					$data['status'] = $det->status;					
				}
				$this->load->view('adminsettings/rewards_settings',$data);
			}			
		}		
	}		
	function updaterewards_settings()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$this->security->cookie_handlers();
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('5',$user_access))) && $admin_id!=1) {

			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$terms_conditions = $this->input->post('terms_conditions');
				if($terms_conditions=="") {
					$this->session->set_flashdata('error', 'Please enter Terms and conditions.');
					$data['action']="Edit";
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/rewards_settings','refresh');
				}
				else {
					$updated = $this->admin_model->updaterewards_settings();
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' Rewards details updated successfully.');
						redirect('adminsettings/rewards_settings','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating rewards details.');
						redirect('adminsettings/rewards_settings','refresh');
					}
				}
			}		
		}
	}
	function rewards_faqs()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$this->security->cookie_handlers();
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('57',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'rewards_faqs','faq_id');
				 }
				if($results){
					
					$this->session->set_flashdata('success', 'FAQ details deleted successfully.');
					redirect('adminsettings/rewards_faqs','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating FAQ details.');
					redirect('adminsettings/rewards_faqs','refresh');
				}
			}
			$data['allrewardsfaqs'] = $this->admin_model->get_allrewards_faqs();
			$this->load->view('adminsettings/rewards_faq',$data);
		}	
	}
	
	// add faqs
	function addrewardsfaqs()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('133',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$faq_content = $this->input->post('faq_ans');
				if($faq_content==""){
					$this->session->set_flashdata('error', 'Please enter FAQ content.');
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addrewardsfaqs','refresh');
				}
				else{
					$results = $this->admin_model->addrewardsfaqs();
					if($results){
						$this->session->set_flashdata('success', ' FAQ details added successfully.');
						redirect('adminsettings/rewards_faqs','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while adding FAQ.');
						redirect('adminsettings/addrewardsfaqs','refresh');
					}
				}
			}
			$data['action']='new';
			$this->security->cookie_handlers();
			$this->load->view('adminsettings/add_rewardsfaq',$data);
		}
	}
	
	// view faq content
	function editrewardsfaq($faq_editid){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if(($admin_id=="") || ($faq_editid=="")){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('131',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$get_faq = $this->admin_model->get_rewardsfaqcontent($faq_editid);
			foreach($get_faq as $get){
				$data['faq_id'] = $get->faq_id;
				$data['faq_qn'] = $get->faq_qn;
				$data['faq_ans'] = $get->faq_ans;
				$data['status'] = $get->status;
			}
			$data['action'] = "edit";
			$this->security->cookie_handlers();
			$this->load->view('adminsettings/add_rewardsfaq',$data);
		}
	}
	
	// updating faq content
	function updaterewardsfaq(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('24',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$faq_ans = $this->input->post('faq_ans');
				if($faq_ans=="") {
					$this->session->set_flashdata('error', 'Please enter FAQ content.');
					$data['action']="Edit";
					// $post_title = $this->input->post('page_title');
					redirect('adminsettings/addrewardsfaqs','refresh');
				}
				else {
					$updated = $this->admin_model->updaterewardsfaq();
					if($updated){
						$data['action']="Edit";
						$this->session->set_flashdata('success', ' FAQ details updated successfully.');
						redirect('adminsettings/rewards_faqs','refresh');
					}
					else{
						$data['action']="Edit";
						$this->session->set_flashdata('error', 'Error occurred while updating FAQ details.');
						redirect('adminsettings/rewards_faqs','refresh');
					}
				}
			}		
		}	
	}	
	
	// delete faq content 
	function deleterewardsfaq($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('132',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->deleterewardsfaq($id);
			if($deletion){
				$this->session->set_flashdata('success', ' FAQ details deleted successfully.');
				redirect('adminsettings/rewards_faqs','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting FAQ details.');
				$this->security->cookie_handlers();
				redirect('adminsettings/rewards_faqs','refresh');
			}
		}
	}
	
	
		function cron_update_price()
		{
			date_default_timezone_set('Asia/Kolkata'); 
			$todaydate =  'Date.UTC('.date("Y").','.date("m").','.date("d").')';
			$type="all";
			$overall_products = $this->admin_model->fetch_products($type);
			foreach($overall_products as $products)
			{
				$productdetails = $this->admin_model->fetch_product_details($products->product_url);
				if($productdetails->Totalstores<1)continue;
				$product_id = $productdetails->product_id;
				$min_price =  $productdetails->min_price;
				$todaydate =  'Date.UTC('.date("Y").','.date("m").','.date("d").')';
				$this->admin_model->update_product_current_price($product_id, $min_price,$todaydate);
			}
		}
		
		
	/*	Seetha Dec 10 2015*/
      /*	Seetha Dec 19 2015*/
	function check_product()
	{
		$this->input->session_helper();
		$product = $this->input->post('product_name');
		$result = $this->admin_model->check_product($product);
		if($result)
		{
			echo 1;
		} else {
			echo 0;
		}
	}


	
	/*	Seetha Dec 19 2015*/


         function upload_product_gallery_main($product_id){
		$admin_id = $this->session->userdata('admin_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else{
			if($_FILES["file"]["name"]){
				$product_image = $_FILES["file"]["name"];
				$new_random = mt_rand(0,99999);
				$product_image = remove_space($new_random.$product_image);
				$config['upload_path'] = 'uploads/products';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $product_image;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				if($product_image!="" && (!$this->upload->do_upload('file')))
				{
					$product_image_error = $this->upload->display_errors();
					if(isset($product_image_error))        
					{
						$this->session->set_flashdata('error',$product_image_error);
						redirect('adminsettings/add_product','refresh');
					}
				}else{
					echo $product_image;
					//$results = $this->admin_model->upload_product_gallery($product_image,$product_id);
				}
			}
		}
		
	}


function update_product($update_id){
		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$deletion = $this->admin_model->get_details_from_id($update_id,'products','product_id');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('5',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}
		else if($update_id=='') {
			redirect('adminsettings/add_product','refresh');
		}
		else if(!$deletion) {
			redirect('adminsettings/add_product','refresh');
		}
		else
		{	
			//$data = $this->checkleveldetails($first_level,$second_level);	
			/*echo $this->input->post('save');
			exit;*/
		
			
			if($this->input->post('save'))
			{		
				$product_type = $this->input->post('type');				
				if($product_type == 'general'){					
					$old_img = $this->input->post('hidden_image');
					if($_FILES['product_image']['name']){
						
						$product_image = $_FILES['product_image']['name'];
						$new_random = mt_rand(0,99999);
						$product_image = remove_space($new_random.$product_image);
						$config['upload_path'] = 'uploads/products';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name'] = $product_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($product_image!="" && (!$this->upload->do_upload('product_image')))
						{
							$product_image_error = $this->upload->display_errors();
							if(isset($product_image_error))        
							{
								$this->session->set_flashdata('error',$product_image_error);
								redirect('adminsettings/add_product','refresh');
							}
						}
					}else{
						$product_image = $old_img;
					}
					
					$results = $this->admin_model->update_products($product_image);
				}
				
				if($product_type == 'store'){
					
					$results = $this->admin_model->update_products_store($update_id);
				}
				
				if($product_type == 'specify'){
					$results = $this->admin_model->update_products_specify($update_id);
				}
				
				if($product_type == 'brands'){
					
					$results = $this->admin_model->update_products_specify($update_id);
				}	
				
				if($results)
				{
					$this->session->set_flashdata('success', 'Product details updated successfully.');
					redirect('adminsettings/update_product/'.$results,'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error occurred while updated product.');
					redirect('adminsettings/update_product/'.$results,'refresh');
				}
			}
			$data['action']='new';
			$data['main_category'] = $this->admin_model->product_categories('0');
			$data['product'] = $this->admin_model->fetch_product($update_id);
			$data['astore'] = $this->admin_model->scrapping_list1($update_id);
			$data['stores'] = $this->admin_model->scrapping_list1();
			$data['specifications'] = $this->admin_model->specifications();
			
			$this->load->view('adminsettings/update_product',$data);
		}
	}
	
	
	// Delete Bulk Products
	function uploadproducts(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('23',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$flag=0;
			if($this->input->post('save')){
				$bulkproduct = $_FILES['bulkproduct']['name'];
				if($bulkproduct==""){
					$flag=1;
					$this->session->set_flashdata('error', 'Please upload the file.');
					redirect('adminsettings/uploadproducts','refresh');
				}
				else {
					$flag=0;
					if($bulkproduct!="") {
						$new_random = mt_rand(0,99999);
						$bulkproduct = $_FILES['bulkproduct']['name'];
						$bulkproduct = remove_space($new_random.$bulkproduct);
						$config['upload_path'] ='uploads/products_csv';
						$config['allowed_types'] = '*';
						$config['file_name']=$bulkproduct;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($bulkproduct!="" && (!$this->upload->do_upload('bulkproduct')))
						{
							$bulkproducterror = $this->upload->display_errors();
						}
						if(isset($bulkproducterror))
						{
							$flag=1;
							$this->session->set_flashdata('error',$bulkproducterror);
							redirect('adminsettings/uploadproducts','refresh');
						}
					}
					if($flag==0){
						$results = $this->admin_model->bulkproduct($bulkproduct);
						if($results){
							$this->session->set_flashdata('success', ' Product details added successfully.');
							redirect('adminsettings/products','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding product details OR choose category');
							redirect('adminsettings/uploadproducts','refresh');
						}
					}
				}
			$result = $this->admin_model->bulkcoupon();
			if($result){
					$this->session->set_flashdata('success', ' Product details added successfully.');
					redirect('adminsettings/products','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while adding product details.');
					redirect('adminsettings/uploadproducts','refresh');
				}
			}
			$data['action'] = "new";
			$this->load->view('adminsettings/uploadproducts',$data);
		}	
	}
	
	function testsp()
	{
		$proid = '23';
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
		
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
		$brand_idslist = $getproductdetails->brands;		
		$mainspecids =array();
		foreach($result as $key=>$res)
		{
			$lastid = $this->admin_model->dynamic_spec_insert($key,0);
			$mainspecid[$lastid] =$lastid;
			if($getproductdetails->child_id!=0){
				$catdetails = $this->admin_model->get_details_from_id($getproductdetails->child_id,'product_categories','cate_id');
			}
			else{
				$catdetails = $this->admin_model->get_details_from_id($getproductdetails->parent_child_id,'product_categories','cate_id');
			}			
			$category_specs = $catdetails->category_specifications;
			$cate_id = $catdetails->cate_id;
			$hiddenspecids = '';
			if($category_specs)
			{
				$hiddenspecids = explode(',',$category_specs);
				if (!in_array($lastid, $hiddenspecids))
				{
					$hiddenspecids[] = $lastid;
				}
				$category_specifications = implode(',',$hiddenspecids);
			}
			else{$category_specifications = $lastid;}
			$records = array('category_specifications'=>$category_specifications);
		
			$this->admin_model->update_records('product_categories',$records,'cate_id',$cate_id);
			$array_specification = array();				
			if($res)
			{				
				foreach($res as $res_key=>$res_val)
				{
					$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
					$sub_spec_id[$lastspec_id]=$lastspec_id;
					$array_specification[$lastspec_id]=$res_val;
				}
			}
			$specify_id = serialize(array_filter($mainspecid));
			$spec_option_id = serialize(array_filter($sub_spec_id));
			$spec_option_value = implode(',',array_filter($sub_spec_id));
			$spec_extra = serialize(array_filter($array_specification));
			$dataarray_spec = array(
					'specification' => $specify_id,
					'specification_option' => $spec_option_id,
					'specification_extra' => $spec_extra,
					'specify_option_id' => $spec_option_value,
			);
			$this->admin_model->update_records('products',$dataarray_spec,'product_id',$proid);			
		}
		$categorybrands = $catdetails->category_brands;
		$cate_id = $catdetails->cate_id;
		$hiddenbrands = '';
		if($categorybrands)
		{
			$hiddenbrands = explode(',',$categorybrands);
			if (!in_array($lastid, $hiddenbrands))
			{
				$hiddenbrands[] = $brand_idslist;
			}
			$category_brands_list = implode(',',$hiddenbrands);
		}
		else{$category_brands_list = $brand_idslist;}
		$dataarray_brands = array('category_brands' => $category_brands_list);
		$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);			
		return true;
	}
	
	
	function get_product_links_dynamic()
	{
		// echo $this->admin_model->get_product_details_link('http://www.amazon.in/gp/offer-listing/B00XKM026W?condition=new&sort=price&tag=comparerajaco-21');
		// exit;
		$prolist = $this->admin_model->get_product_list();
		if($prolist)
		{
			foreach($prolist as $products)
			{
				$proname = $products->product_name;
				$product_id = $products->product_id;
				$datadetails = array('get_link_status' => '2');
				$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);					
				$color = $products->color;
				$newproname = str_replace($color,'',$proname);
				$shorten_name =  $this->admin_model->short_product_name($newproname); //we get the shorten product name
				$newproname = str_replace(' ','-',$shorten_name);
				echo $search_product_url = 'http://www.compareraja.in/search?q='.$newproname.'&c=all';
				$scrappage = $this->admin_model->url_parsing($search_product_url);
				$url = preg_match('/<a class="prdct" href="(.+)">/', $scrappage, $match);
				if($match[1])
				{
					//echo "Product Found";
					$detailpage = $this->admin_model->url_parsing($match[1]);
					preg_match_all('/<ul[^>]+class="nemcomp-price-row-nw[^>]*">(.*?)<div id="Features1"><\/div>/s',$detailpage, $pricediv); 
					preg_match_all('/<li class="cp-c6">(.*?)<\/li>/s',$pricediv[1][0], $divdetailsspl);
					$s = 0; 
					/*print_r($divdetailsspl[1]);
					exit;*/
					$listarray =array();
					foreach($divdetailsspl[1] as $devdetails)
					{
						preg_match('/onclick="(.*?)"/i', $devdetails, $storedetgails);
						$stodedivs = str_replace(array('exitoblnew(',')',"'"),'',$storedetgails[1]);
						$expdivarr = explode(',',$stodedivs);
						if (array_key_exists($expdivarr[3], $listarray)) {
							continue;
						}
						else
						{
							$tld =  $this->admin_model->parse_tld($expdivarr[3]);
							$parseddomain = str_replace($tld, NULL, $expdivarr[3]);
							$storename =  strtolower(current(explode(' ', $parseddomain)));
							$listarray[$storename] = $expdivarr[0];
						}
					}
					if(count($listarray)<1){continue;}
					foreach($listarray as $arrlisting=>$prolink)
					{
						$allscrappingstores = $this->admin_model->scrapping_list_storeslist($arrlisting);
						if(!$allscrappingstores){continue;}
						$storeid = $allscrappingstores->store_name;
						$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
						//echo "<pre>";
						//print_r($resultorun);
						if($resultorun){continue;}
						$this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$prolink);
					}
					$datadetails = array('get_link_status' => '1');
					$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);
					sleep(2);
				}
				else
				{
					$datadetails = array('get_link_status' => '2');
					$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);
					echo "<br>Product Not found<br>";
				}
				//exit;
			}
			
		}
	}
	//ganesh mar 9
	function change_status()
	{
		$uid=$this->input->post('user_id');
		$status=$this->input->post('status');
		$st_chng=$this->admin_model->change_status($uid,$status);
		if($st_chng)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	function pending_transaction()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('25',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
				$data['pendings'] = $this->admin_model->pending_transaction();
		$this->load->view('adminsettings/pending_transaction',$data);
		}
	}
	function remove_ptrs($pid=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('88',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		echo $de_pid = base64_decode($pid);
		$delete=$this->admin_model->remove_ptrs($de_pid);
		if($delete)
		{
			redirect('adminsettings/pending_transaction','refresh');
		}
		}
	}
	function change_categories(){
		
		 $cat_id = $this->input->post('cat_id');
		$result = $this->admin_model->product_categories($cat_id);
		//print_r($result);
		
		$input = '';
		if($result){
			$input .='<option value=""> Select </option>';
			foreach($result as $name){
				$input .= '<option value="'.base64_encode($name->cate_id).'">'.$name->category_name.'</option>';
			}
		}else{
			$input .='false';
		}
			echo $input;
	}
	//ganesh 10-3-2016
	function addaffiliateoffers()
	{
		extract($this->input->post());
		$store_offer=$this->admin_model->save_bank_offers();
		if($store_offer){
			
							$this->session->set_flashdata('success', ' bank offers added successfully.');
							redirect('adminsettings/affiliates','refresh');
						}
						else{
							$this->session->set_flashdata('error', 'Error occurred while adding offers.');
							redirect('adminsettings/affiliates','refresh');
						}
	}
	
	function remove_bank_offers()
	{
		$id=$this->input->post('id');
		$del=$this->admin_model->remove_bank_offers($id);
		if($del)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	function save_retailer_commision()
	{
	extract($this->input->post());
	$commision=$this->admin_model->save_retailer_commision();
	if($commision)
	{
		$this->session->set_flashdata('success', ' commision added successfully.');
							redirect('adminsettings/affiliates','refresh');
	}
	else{
		$this->session->set_flashdata('error', 'Error occurred while adding bank commision .');
							redirect('adminsettings/affiliates','refresh');
	}
	
	
}	

//22/03/2016 ...
function salable_coupons($store_name=null){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('42',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->coupons_bulk_delete();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Coupons details Deleted successfully.');
					redirect('adminsettings/salable_coupons','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting Coupon details.');
					redirect('adminsettings/salable_coupons','refresh');
				}
			}
			$data['coupons'] = $this->admin_model->salable_coupons($store_name);
			$this->load->view('adminsettings/salable_coupons',$data);
		}
	}

	function salable_addcoupon()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
				$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('41',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{	
			if($this->input->post('save')){

				$category_image = $_FILES['coupon_image']['name'];
				// echo $category_image;die;
					if($category_image!="") 
					{
						// echo 'fdfhdjk';die;
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('coupon_image')))
						{
							// echo 'not upload';die;
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								// echo 'ghfghf';die;
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('adminsettings/salable_coupons','refresh');
							}
					}
				
			$insert = $this->admin_model->salable_addcoupon($category_image);
			// echo $insert;die;
				if($insert){
					// echo 'djjdfjkd';die;
					$this->session->set_flashdata('success', ' Coupon details added successfully.');
					redirect('adminsettings/salable_coupons','refresh');
				}
				else{
					// echo 'ffjkhgkjf';die;
					$this->session->set_flashdata('error', 'Error occurred while adding coupon details.');
					redirect('adminsettings/salable_addcoupon','refresh');
				}
			}
		
			$data['action'] = "new";
			$this->load->view('adminsettings/salable_addcoupon',$data);
		}	
	}

	function salable_editcoupon($coupon_id){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('115',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else {
			$coupons = $this->admin_model->salable_editcoupon($coupon_id);
			foreach($coupons as $get){
				$data['coupon_id'] = $get->coupon_id;
				$data['offer_name'] = $get->offer_name;
				$data['title'] = $get->title;
				$data['description'] = $get->description;
				$data['type'] = $get->type;
				$data['code'] = $get->code;
				$data['offer_page'] = $get->offer_page;
				$data['expiry_date'] = $get->expiry_date;
				$data['start_date'] = $get->start_date;
				$data['featured'] = $get->featured;	//28/11/14 Suhirdha added starts ...
				$data['exclusive'] = $get->exclusive;	//28/11/14 Suhirdha ends...	
				$data['Tracking'] = $get->Tracking;	
				$data['coupon_options'] = $get->coupon_options;	
				$data['amount'] = $get->amount;
				$data['cashback_description'] = $get->cashback_description;	
				$data['coupon_image'] = $get->coupon_image;
				$data['status'] = $get->coupon_status;
				$data['store_description'] = $get->store_description;
				$data['store_id'] = $get->store_id;
				$data['store_location'] = $get->store_location;
				$data['contact']=$get->contact_details;

			}
			$data['action'] = "edit";
			$this->load->view('adminsettings/salable_addcoupon',$data);			
		}
	}
	
	// update coupon..
	function salable_updatecoupon(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('9',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$category_image = $_FILES['coupon_image']['name'];
					if($category_image!="") {
						$new_random = mt_rand(0,99999);
						$category_image = remove_space($new_random.$category_image);
						$config['upload_path'] ='uploads/category';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['file_name']=$category_image;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	
						if($category_image!="" && (!$this->upload->do_upload('coupon_image')))
						{
							$category_imageerror = $this->upload->display_errors();
						}
							if(isset($category_imageerror))        
							{
								$this->session->set_flashdata('error',$category_imageerror);
								redirect('adminsettings/settings','refresh');
							}
					} else {
						$category_image = $this->input->post('hidden_category_image');
					}
					
				$updated = $this->admin_model->salable_updatecoupon($category_image);

				if($updated){
					$data['action']="Edit";
					$this->session->set_flashdata('success', ' Coupon details updated successfully.');
					redirect('adminsettings/salable_coupons','refresh');
				}
				else
				{
					$data['action']="Edit";
					$this->session->set_flashdata('error', 'Error occurred while updating coupon details.');
					redirect('adminsettings/salable_coupons','refresh');
				}
			}
		}
	}
	
	// delete coupon..
	function salable_deletecoupon($delete_id)
	{
		$this->input->session_helper();
		$user_access=$this->session->userdata('user_access');
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('116',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->salable_deletecoupon($delete_id);
			if($deletion){
				$this->session->set_flashdata('success', 'Coupon deleted successfully.');
				redirect('adminsettings/salable_coupons','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred while deleting coupon.');
				redirect('adminsettings/salable_coupons','refresh');
			}
		}
	}
//lingeswari
//lingeswari code mar 22
	//referral section
	function pending_referrals()
	{
		extract($_REQUEST);
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('47',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
	//	print_r($_REQUEST);
		$rrs=implode(',',array_keys($_REQUEST['chkbox']));
		if(isset($_REQUEST['GoUpdate']))
		{
		if($_REQUEST['GoUpdate']='Delete Referrals')
		{
			 if((!(in_array('90',$sub_access))) && $admin_id!=1) {
			 	redirect('adminsettings/index','refresh');
			 }else{
			$delet=$this->admin_model->delete_refer($rrs);
			redirect('adminsettings/pending_referrals','refresh');
			 }
		}}else{
			$data['referrs']=$this->admin_model->getpending_referr();
		$this->load->view('adminsettings/view_pending_referr',$data);
		
		}
		}
		
	}
	
	function confirm_referrals()
	{
		extract($_REQUEST);
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('48',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		//	print_r($_REQUEST);
			$rrs=implode(',',array_keys($_REQUEST['chkbox']));
			if(isset($_REQUEST['GoUpdate']))
			{
			if($_REQUEST['GoUpdate']='Delete Referrals')
			{
				if((!(in_array('91',$sub_access))) && $admin_id!=1) {
			 	redirect('adminsettings/index','refresh');
			 }else{
				$delet=$this->admin_model->delete_refer($rrs);
				redirect('adminsettings/confirm_referrals','refresh');
			 }
			}}else{
				$data['referrs']=$this->admin_model->getconfirm_referr();
			$this->load->view('adminsettings/view_confirm_referr',$data);
			
			}
			}
		
	}
function update_offline()
		{
					//	print_r($this->input->post());
		//	exit;
			$data=$this->admin_model->update_offline();
			if($this->input->post('status')=='1')
			{
				$this->session->set_flashdata('success', 'Status updated successfully.');
			redirect('adminsettings/confirm_offline','refresh');
		}
		else
		{
			$this->session->set_flashdata('success', 'Status updated successfully.');
		
		redirect('adminsettings/pending_offline','refresh');
		}
		}
function pending_offline($process=null,$id=null)
	{
			$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('29',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			switch($process){
			case "view":
				
				$results['res'] = $this->admin_model->view_offline_users($id);
				if($results){
					if((!(in_array('97',$sub_access))) && $admin_id!=1) {
						redirect('adminsettings/index','refresh');
					}else{
					$this->load->view('adminsettings/view_offline_users',$results);
					}
				} else {
					$this->session->set_flashdata('error', 'Error occurred while view user.');
					redirect('adminsettings/pending_offline','refresh');
				}
			break;
			default:
					$data['offline']=$this->admin_model->get_pending_offline();
	$this->load->view('adminsettings/view_offline',$data);
			break;	
			}
		}	

	

		
	}
	function confirm_offline($process=null,$id=null)
	{
			$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('38',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			switch($process){
			case "view":
				$results['res'] = $this->admin_model->view_offline_users($id);
				if($results){
					if((!(in_array('98',$sub_access))) && $admin_id!=1) {
						redirect('adminsettings/index','refresh');
				}
			else{
					
					$this->load->view('adminsettings/view_offline_users',$results);
					}
				} else {
					$this->session->set_flashdata('error', 'Error occurred while view user.');
					redirect('adminsettings/confirm_offline','refresh');
				}
			break;
			default:
					$data['offline']=$this->admin_model->get_confirm_offline();
	                $this->load->view('adminsettings/cofirm_offline',$data);
			break;	
			}
		}	

	

		
	}
	function confirm_coupon($process=null,$cashback_id=null)
		{
		
	$this->input->session_helper();
		$change_type =  $this->uri->segment(3);
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('39',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			switch($process){
			
			case "delete":
				if((!(in_array('114',$sub_access))) && $admin_id!=1) {
						redirect('adminsettings/index','refresh');
				}
				else {
					
			
				$deletion = $this->admin_model->deletecashback($cashback_id);
				if($deletion){
					$this->session->set_flashdata('success', 'Cashback deleted successfully.');
					redirect('adminsettings/confirm_coupon','refresh');
				} else {
					$this->session->set_flashdata('error', 'Error occurred while deleting cashback.');
					redirect('adminsettings/confirm_coupon','refresh');
				}
					}

			break;
			default:
				if($this->input->post('hidd'))   //delete multiple cashback  seetha
				{
					if($this->input->post('chkbox'))
					{
						$sort_order = $this->input->post('chkbox');					 
						$results = $this->admin_model->delete_bulk_records($sort_order,'cashback','cashback_id');
					}				
					
					if($results){
						
						$this->session->set_flashdata('success', 'Cashback details deleted successfully.');
						redirect('adminsettings/confirm_coupon','refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating cashback details.');
						redirect('adminsettings/confirm_coupon','refresh');
					}
				}	
				$data['cashbacks'] = $this->admin_model->get_confirm_coupons($change_type);
				$data['change_type']=$change_type;
				$this->load->view('adminsettings/confirm_coupons',$data);
			break;	
			}
		}	
	
		}
function transaction_details($type=null,$trans_id=null)
		{
		
	$this->input->session_helper();
		$change_type =  $this->uri->segment(3);
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/dashboard','refresh');
		} else if((!(in_array('49',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else 
		{
			
				if($this->input->post('hidd'))   //delete multiple cashback  seetha
				{
					if($this->input->post('chkbox'))
					{
						$sort_order = $this->input->post('chkbox');					 
						 $results = $this->admin_model->delete_bulk_records($sort_order,'transation_details','trans_id');
					}				
					
					if($results){
						
						$this->session->set_flashdata('success', 'Transaction details deleted successfully.');
						redirect('adminsettings/transaction_details/'.$type,'refresh');
					}
					else{
						$this->session->set_flashdata('error', 'Error occurred while updating Transaction details.');
						redirect('adminsettings/transaction_details/'.$type,'refresh');
					}
				}	
				$data['coupons'] = $this->admin_model->get_transaction($change_type);
				$data['change_type']=$change_type;
				$this->load->view('adminsettings/transaction_all',$data);
			
			
		}	
	
		}
	//ganesh 26-mar
	function off_affiliates()
	{
		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('28',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				$results = $this->admin_model->sort_affiliates();
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->sort_affiliates_delete();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Affiliates details updated successfully.');
					redirect('adminsettings/off_affiliates','refresh');
				}
				else{
					;
					$this->session->set_flashdata('error', 'Error occurred while updating affiliates details.');
					redirect('adminsettings/off_affiliates','refresh');
				}
			}
		
			$data['off_affiliates'] = $this->admin_model->off_affiliates();
			$this->load->view('adminsettings/off_affiliates',$data);
		}
	}	
	
	function change_offline_status($id,$status)
	{
	extract($this->input->post());
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('96',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			$res= $this->admin_model->change_offline_status($id,$st);
			if($res){
				echo 1;
			}
			else{
				echo 0;
			}
			
		}
	}
	function delete_offaffiliate($id)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('95',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			$res= $this->admin_model->delete_offaffiliate($id);
			if($res){
				$this->session->set_flashdata('success', ' Store deleted successfully');
				redirect('adminsettings/off_affiliates','refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error occurred ');
				redirect('adminsettings/off_affiliates','refresh');
			}
			
		}
	}
	function change_onstore_status()
	{
		extract($this->input->post());
		
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}else
		{
			$res= $this->admin_model->change_onstore_status($id,$st);
			if($res)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			
		}
	}
	function get_product_links_dynamic_amz()
				{

				$prolist = $this->admin_model->get_product_list();
				
				if($prolist)
				{
					
				foreach($prolist as $products)
				{
				$proname = $products->product_name;
				$product_id = $products->product_id;
				$datadetails = array('get_link_status' => '2');
				$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);

						if($proname)
						{

							$color = $products->color;
							echo $proname;
							$newproname = str_replace($color,'',$proname);
							$newproname=str_replace(' ','+',$newproname);

							$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name
							$newproname = $shorten_name;
							echo $search_product_url = 'http://www.amazon.in/s/?field-keywords='.$newproname;

							$detailpage = $this->admin_model->url_parsing($search_product_url);
							print_r($detailpage);
							preg_match('/<h1 id="noResultsTitle" class="a-size-medium a-spacing-base a-spacing-top-small a-color-base a-text-normal">(.*?)<\/h1>/s', $detailpage, $div1);
							
							
									echo $var=substr($div1[1],-27);//find mismatch
									if($var=="did not match any products.")
									{
										echo "mismatch";
									}
									die;
							



							preg_match('#<div id="atfResults" class="a-row s-result-list-parent-container">\s*<ul id="s-results-list-atf" class="s-result-list s-col-1 s-col-ws-1 s-result-list-hgrid s-height-equalized s-list-view s-text-condensed">(.*?)</ul>\s*</div>#is', $detailpage, $div1);
print_r($div1);die;
				preg_match_all('/<li id="result_0" data-asin="[^>]*" class="s-result-item celwidget">(.*?)<\/li>/s',$div1[1], $divdetailsspl);

						//    $divdetailsspl=preg_match_all('#^<li id="result_0" class="s-result-item celwidget" data-asin="B00FXLC4">|</li>$#','', $div1[1]);

						  //  $s = 0; class="a-link-normal s-access-detail-page a-text-normal"
						   $divdetailsspl[0][0];



							preg_match_all('/<a.+(href ?= ?("|\')[^\2]*\2).*>.*<\/a>/U', $divdetailsspl[0][0], $matches);

				foreach($matches[0] as $key => $match)
				if (preg_match('/class=(\'|")[^\1]a-link-normal s-access-detail-page a-text-normal[^\1]\1/', $match))
				unset($matches[1][$key]);
				$matches1 = $matches[1];
				// echo "<pre>";
				// print_r($matches1);

							  $var=$matches1[0];

				$var1 =substr($var,6);
				$prolink= substr($var1,0,-1);

								  $storeid = "221";
								  $arrlisting="amazon";
								$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
								//echo "<pre>";
								//print_r($resultorun);
								if($resultorun)
								{
									continue;
									}
								$this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$prolink);
						   // }
							$datadetails = array('get_link_status' => '1');
							$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);
							sleep(2);
						}
						else
						{
							$datadetails = array('get_link_status' => '2');
							$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);
							echo "<br>Product Not found<br>";
						}

					}




				}

}

function get_sub_speci()
{
	$id=$this->input->post('id');
	$cat_id=$this->input->post('cat_id');
	$qu=$this->admin_model->get_specifi($id);

	echo '<label class="control-label">Specification option for filter<span class="required_field"></span></label>
                <div class="controls"><input type="hidden" name="put_id" id="put_id" value="'.$id.'">';
				$thsd=$this->admin_model->get_curr_speci($id,$cat_id);
if($thsd)
{
					$ex=explode(',',$thsd->option_id);
					
	
		foreach($qu as $qq) 	
		{echo '<input type="checkbox"';
			foreach($ex as $thii)
	{	
			if($qq->specid==$thii)
			{
		echo ' checked '; 
			}
			}
			echo 'class="mail-checkbox" id="'.$qq->specid.'" name="chk_filter[]" value="'.$qq->specid.'">'.$qq->specification.'<br>';
			
			
		
	}
}
else
	{
		foreach($qu as $qq) 	
	{
		
		echo '<input type="checkbox" class="mail-checkbox" id="'.$qq->specid.'" name="chk_filter[]" value="'.$qq->specid.'">'.$qq->specification.'<br>';
	}
	}
				
	echo '<br><button type="button" class="btn btn-info" id="saves" name="saves">Save</button></div>';
}
function update_speci()
{
	$data['cat_id']=$this->input->post('cat_id');
	$data['speci_id']=$this->input->post('put_id');
		$data['option_id']=rtrim($this->input->post('option_id'), ",");
	
		$qu=$this->admin_model->update_speci($data);
		if($qu)
		{
			echo '1';
		}
	
}

//suren & ganesh
//surendar


function get_product_links_dynamic_common()
{

$max="3";


$prolist = $this->admin_model->get_product_list();

if($prolist)

{

foreach($prolist as $products)

{
 
  $proname = $products->product_name;
 
  $product_id = $products->product_id;
 
 $category_id=$products->parent_id;
 
 $default=$products->default_store;
 
 $get_cate=$this->admin_model->get_cate_details($category_id);

 if($get_cate=='Mobiles')
 {
	 $pieces=explode(' ',$proname);
 $proname=implode(" ", array_splice($pieces,0,3));
 }
 if($get_cate=='Laptops')
 {
	 if(strpos($proname,'(')!==false)
	 {
		 $proname=strstr($proname, '(', true);
	 }
	 else
	 {
		 $pieces=explode(' ',$proname);
		$proname=implode(" ", array_splice($pieces,0,5));
	 }
	
 }
 if($get_cate=='Tv/Entertainment')
 {
	 $pieces=explode(' ',$proname);
	$proname=implode(" ", array_splice($pieces,0,3));
 }
  if($get_cate=='Men' || $get_cate=='Woman')
 {
	 $pieces=explode(' ',$proname);
		$proname=implode(" ", $pieces);
 }
 else{
	 $pieces=explode(' ',$proname);
		$proname=implode(" ", $pieces);
 }



  $get_active_store=$this->admin_model->get_active_store($products->parent_id,$products->parent_child_id);
  
		if (($key = array_search($default, $get_active_store)) !== false)
			{
			unset($get_active_store[$key]);
			}
			//print_r($get_active_store);die;
				$datadetails = array('get_link_status' => '2');

			$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);

            if($proname)

            {
			$site=$this->db->query("select * from affiliates WHERE store_type = 'On1'")->result();

			$i=1;

			foreach($site as $site1)

			{

			$store_id=$site1->affiliate_id;
			if($get_active_store)
			{

			if(in_array(210,$get_active_store))

			{
				echo "ebay";
				$color = $products->color;

				//$newproname = str_replace($color,'',$proname);

				//$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				//$newproname = $shorten_name;

				$proname = str_replace($color,'',$proname);

				 $proname1=str_replace(' ','+',$proname);


				  $search_product_url = 'http://www.ebay.in/sch/i.html?_nkw='.$proname1;

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				preg_match_all('/<h3 class="lvtitle">(.*?)<\/h3>/s',$detailpage, $href);

				if($href != "")

				{

				for($i="0";$i<$max;$i++)

				{

				$dom = new DOMDocument;

				@$dom->loadHTML($href[0][$i]);

				foreach ($dom->getElementsByTagName('a') as $tag) 

					{

				   $link=$tag->getAttribute('href'); 
				

				  $product_name=$tag->nodeValue;

				   // echo   $pro_name=$tag->getAttribute('title');

					$param='ebay';

				   $price1=$this->admin_model->get_price($param,$link);

					$storeid = "210";

					$arrlisting="ebay";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    

                    if($resultorun)

					{

						continue;

						}


						if($i < $max)

						{
	

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
					

						}

  
}



}



}

}

if(in_array(85,$get_active_store))

			{
				
				$color = $products->color;

				//$newproname = str_replace($color,'',$proname);

				//$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				//$newproname = $shorten_name;

				$proname = str_replace($color,'',$proname);

				 $proname1=str_replace(' ','+',$proname);


				  $search_product_url = 'www.flipkart.com/search?q='.$proname1;

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				preg_match_all('/<div class="pu-title fk-font-13">(.*?)<\/div>/s',$detailpage, $href);

				if($href != "")

				{

				for($i="0";$i<$max;$i++)

				{

				$dom = new DOMDocument;

				@$dom->loadHTML($href[0][$i]);

				foreach ($dom->getElementsByTagName('a') as $tag) 

					{

				   $link=$tag->getAttribute('href'); 
				
				  $product_name=$tag->nodeValue;

				    //$pro_name=$tag->getAttribute('title');

					$param='flipkart';

				   $price1=$this->admin_model->get_price($param,$link);

					$storeid = "85";

					$arrlisting="flipkart";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    if($resultorun)

					{

						continue;

						}

						if($i < $max)

						{
	
                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
					
						}

}

}

}

}

sleep(2);
if(in_array(209,$get_active_store))

{
echo "napptol";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

			

				echo $search_product_url = "http://www.naaptol.com/search.html?type=srch_catlg&kw=$proname1";

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				
preg_match_all('/<div class="item_title">(.*?)<\/div>/s',$detailpage, $href);



					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

	if($tag->getAttribute('id') == "")

	{

		  $link="http://www.naaptol.com".$tag->getAttribute('href'); 

		 $product_name=$tag->nodeValue;

		$param='naaptol';

		 $price1=$this->admin_model->get_price($param,$link);

	}

					$storeid = "209";

					$arrlisting="Naaptol";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    
                    if($resultorun)

					{

						continue;

						}

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}



}


}

	if(in_array(205,$get_active_store))

{
echo "indiatime";
				$color = $products->color;

				

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

				echo $search_product_url = "http://shopping.indiatimes.com/mtkeywordsearch?SEARCH_STRING=$proname1";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

preg_match_all('/<a class="product-anchor" data-ga-en="[^>]*" href="[^>]*" onClick="[^>]*">(.*?)<\/a>/s',$detailpage, $href);

				



					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

		 $link="http://shopping.indiatimes.com".$tag->getAttribute('href'); 

			  $product_name=$tag->getAttribute('title');
		
		 $param='indiatimes';

		  $price1=$this->admin_model->get_price($param,$link);


					$storeid = "205";

					$arrlisting="Indiatimes Shopping";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{
				

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
					
						}

}

}

}

}
sleep(2);
	if(in_array(175,$get_active_store))

{
echo "shopperstop";
				$color = $products->color;

			

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
				
				echo $search_product_url = "https://www.shoppersstop.com/search/?text=$proname1";

                $detailpage = $this->admin_model->url_parsing($search_product_url);


preg_match_all('/<div class="pro-info">(.*?)<\/div>/s',$detailpage, $href);

					if($href != "")

					{						

			for($i="0";$i<$max;$i++)

			{

			$dom = new DOMDocument;

			@$dom->loadHTML($href[0][$i]);

			foreach ($dom->getElementsByTagName('a') as $tag) 

			{

		 $link="https://www.shoppersstop.com".$tag->getAttribute('href'); 

		$product_name=$tag->nodeValue;

		$price1='';

		$param='shoppersstop';

		$price1=$this->admin_model->get_price($param,$link);

	    

	

					$storeid = "175";

					$arrlisting="ShoppersStop.com";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    if($resultorun)

					{

						continue;

						}
	

						if($i < $max)

						{
		

                   $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}

}

}

}


sleep(2);
if(in_array(206,$get_active_store))

{
echo "rediff";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
				 
				$search_product_url = 'http://shopping.rediff.com/product/'.$proname1.'?sc_cid=shopping_inhomesrch';


                $detailpage = $this->admin_model->url_parsing($search_product_url);


			preg_match_all('/<div id="catmore_0">(.*)<\/div>/s',$detailpage, $divdetailsspl);

			preg_match_all('/<h4 class="mitemname_h4">(.*?)<\/h4>/s',$divdetailsspl[0][0], $href);

		if($href != "")

		{			

				for($i="0";$i<$max;$i++)

				{

				$dom = new DOMDocument;

				@$dom->loadHTML($href[0][$i]);

				foreach ($dom->getElementsByTagName('a') as $tag) 

				{

					$link=$tag->getAttribute('href'); 

					$product_name=$tag->getAttribute('title');


				 $param='rediff';

				  $price1=$this->admin_model->get_price($param,$link);



					$storeid = "206";

					$arrlisting="Rediff Shopping";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                   if($resultorun)

					{
						continue;

						}

						if($i < $max)

						{

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}


}

}sleep(2);

if(in_array(145,$get_active_store))

{
echo "snapdeal";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

				echo $search_product_url = "http://www.snapdeal.com/search?keyword=$proname1&santizedKeyword=&catId=&categoryId=&suggested=false&vertical=&noOfResults=48&clickSrc=go_header&lastKeyword=&prodCatId=&changeBackToAll=false&foundInAll=false&categoryIdSearched=&cityPageUrl=&url=&utmContent=&dealDetail=&sort=rlvncy";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);


				preg_match_all('/<div class="product-desc-rating title-section-expand">(.*?)<\/div>/s',$detailpage, $href);



					if($href != "")

					{						

			for($i="0";$i<$max;$i++)

			{

			$dom = new DOMDocument;

			@$dom->loadHTML($href[0][$i]);

			foreach ($dom->getElementsByTagName('a') as $tag) 

			{

				   $link=$tag->getAttribute('href'); 

				 $product_name=$tag->nodeValue;

				$param='snapdeal';

				  $price1=$this->admin_model->get_price($param,$link);

	
					$storeid = "145";

					$arrlisting="snapdeal";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    
                    if($resultorun)

					{
						continue;
						}
					if($i < $max)

					{

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

					}

              

}

}

}

}





sleep(2);

if(in_array(221,$get_active_store))

{

		echo "amazon";		
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

				 
				echo  $search_product_url = 'http://www.amazon.in/s/?field-keywords='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);
			

				preg_match_all('/<div class="a-row a-spacing-small">(.*?)<\/div>/s',$detailpage, $href);

				if($href != "")

				{
				for($i="2";$i<4;$i++)

				{
				$dom = new DOMDocument;

				@$dom->loadHTML($href[0][$i]);

				foreach ($dom->getElementsByTagName('a') as $tag) 

				{

   $link=$tag->getAttribute('href'); 

     $product_name=$tag->getAttribute('title');

   
 // $param='amazon';

   $price1='';

   $storeid = "221";

					$arrlisting="Amazon";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    if($resultorun)

					{
						continue;

						}

						if($i < $max)

						{

                   $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}



}



}
sleep(2);
	if(in_array(232,$get_active_store))

{
echo "shopclues";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

				echo  $search_product_url = 'http://search.shopclues.com/?q='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

			preg_match_all('/<div class="products_list">(.*)<\/div>/s',$detailpage, $divdetailsspl);

			preg_match_all('/<h5>(.*?)<\/h5>/s',$divdetailsspl[0][0], $href);

			if($href != "")

			{				

			for($i="0";$i<$max;$i++)

			{

			$dom = new DOMDocument;

			@$dom->loadHTML($href[0][$i]);

			foreach ($dom->getElementsByTagName('a') as $tag) 

			{

				   $link=$tag->getAttribute('href'); 

				   $product_name=$tag->nodeValue;


				  $param='shopclues';

				 $rr=file_get_contents($link);

				preg_match_all('/<div class="price">(.*?)<\/div>/s',$rr, $divdetailsspl);

				 $str1=strip_tags($divdetailsspl[0][0]);


				 $price1 = str_replace('Deal Price:Rs.','', $str1);


					$storeid = "232";

					$arrlisting="ShopClues";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    
                    if($resultorun)

					{

						continue;

						}
					if($i < $max)

						{
		        $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}


}

}

}
sleep(2);
if(in_array(237,$get_active_store))

{
echo "crossword";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

			 $search_product_url = "http://www.crossword.in/search?q=$proname1";
			
                $detailpage = $this->admin_model->url_parsing($search_product_url);
				
preg_match_all('/<span class="variant-title">(.*?)<\/span>/s',$detailpage, $href);


					if($href != "")

					{						

				for($i="0";$i<$max;$i++)

				{

				$dom = new DOMDocument;

				@$dom->loadHTML($href[0][$i]);

				foreach ($dom->getElementsByTagName('a') as $tag) 

				{

			$link="http://www.crossword.in".$tag->getAttribute('href'); 

			$product_name=$tag->nodeValue;

			$param='crossword';

		  $price1=$this->admin_model->get_price($param,$link);

	

					$storeid = "237";

					$arrlisting="Crossword";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    
                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}



}	

}
sleep(2);
if(in_array(208,$get_active_store))

{
echo "infibeam";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

				
			$search_product_url = 'http://www.infibeam.com/search?q='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

		preg_match_all('/<div class="product-content col-md-12 col-xs-8">(.*)<\/div>/s',$detailpage, $divdetailsspl);

		preg_match_all('/<div class="title">(.*?)<\/div>/s',$divdetailsspl[0][0], $href);



			if($href != "")

			{

			for($i="0";$i<$max;$i++)

			{

			$dom = new DOMDocument;

			@$dom->loadHTML($href[0][$i]);

			foreach ($dom->getElementsByTagName('a') as $tag) 

			{

				  $link="http://www.infibeam.com".$tag->getAttribute('href'); 

				  $product_name=$tag->getAttribute('title');

				  $param='infibeam';

				  $price1=$this->admin_model->get_price($param,$link);

 

 

						$storeid = "208";

					$arrlisting="Infibeam.com";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);


                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}



}

}

	sleep(2);

if(in_array(500,$get_active_store))

{
echo "mobilestore";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);

				$search_product_url = 'http://www.themobilestore.in/catalogsearch/result/?q='.$proname1.'&order=saleability&dir=asc';

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);
		

				preg_match_all('/<div class="product_name">(.*?)<\/div>/s',$detailpage, $divdetailsspl);



		if($divdetailsspl != "")

		{

			for($i="0";$i<$max;$i++)

			{					

			$dom = new DOMDocument;

			@$dom->loadHTML($divdetailsspl[1][$i]);

			foreach ($dom->getElementsByTagName('a') as $tag) 

			{

				   $link=$tag->getAttribute('href'); 

					$product_name=$tag->getAttribute('title');

				   $param='themobilestore';

				  $price1=$this->admin_model->get_price($param,$link);

  
					$storeid = "232";

					$arrlisting="Themobilestore";

					$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}



}
	

}
sleep(2);
if(in_array(170,$get_active_store))
{
	echo "homeshop18";
$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
				
				 $search_product_url = 'http://www.homeshop18.com/search:'.$proname1;
			
                $detailpage = file_get_contents($search_product_url);
				
		preg_match_all('/<p class="product_title">(.*?)<\/p>/s',$detailpage, $divdetailsspl);

			
          if($divdetailsspl != "")
		{
				for($i="0";$i<10;$i++)
				{					
				$dom = new DOMDocument;
				@$dom->loadHTML($divdetailsspl[1][$i]);
				foreach ($dom->getElementsByTagName('a') as $tag) 
				{	
				  $link="http://www.homeshop18.com".$tag->getAttribute('href'); 
				 
				  
				  $product_name=$tag->getAttribute('title');
				 
				  $param='homeshop18';
					$price1=$this->admin_model->get_price($param,$link);
 
					 $storeid = "170";
					 $arrlisting="homeshop18";
					 $resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
                    //echo "<pre>";
                    //print_r($resultorun);
                    if($resultorun)
					{
						continue;
						}
						
						if($i < $max)
						{
                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
						}
               	
}

}

}	
}sleep(2);
if(in_array(217,$get_active_store))
{
	echo "pepperfry";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
				
				 $search_product_url = "http://www.pepperfry.com/site_product/search?q=$proname1";
			
                $detailpage = $this->admin_model->url_parsing($search_product_url);
				
			preg_match_all('/<div class="card-header">(.*?)<\/div>/s',$detailpage, $divdetailsspl);
		
          if($divdetailsspl != "")
		{
				for($i="0";$i<10;$i++)
				{					
				$dom = new DOMDocument;
				@$dom->loadHTML($divdetailsspl[0][$i]);
				foreach ($dom->getElementsByTagName('a') as $tag) 
				{
					$link=$tag->getAttribute('href');
				  
				  $product_name=$tag->getAttribute('title');
				  
				  $param='Pepperfry';
				  $price1=$this->admin_model->get_price($param,$link);
  
					$storeid = "217";
					$arrlisting="Pepperfry";
					$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
                    
                    if($resultorun)
					{
						continue;
						}
						
						if($i < $max)
						{
                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
						}
               
		
}

}

}
}

sleep(2);
if(in_array(146,$get_active_store))
{
	echo "firstcry";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
			
				 $search_product_url = 'http://www.firstcry.com/search.aspx?q='.$proname1;
			
                $detailpage = $this->admin_model->url_parsing($search_product_url);
				
			preg_match_all('/<div class="li_txt1 wifi lft">(.*?)<\/div>/s',$detailpage, $divdetailsspl);
			if($divdetailsspl != "")
			{
			for($i="0";$i<10;$i++)
			{					
			$dom = new DOMDocument;
			@$dom->loadHTML($divdetailsspl[1][$i]);
			foreach ($dom->getElementsByTagName('a') as $tag) 
			{	
						$link="http://www.firstcry.com".$tag->getAttribute('href'); 
				 
						$product_name=$tag->getAttribute('title');
				   
				  $param='firstcry';
				  $price1=$this->admin_model->get_price($param,$link);
				  
 
					$storeid = "146";
					$arrlisting="firstcry";
					$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
                   
                    if($resultorun)
					{
						continue;
						}
						
						if($i < $max)
						{
                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
						}
               
		
}


}

}
}
sleep(2);
if(in_array(233,$get_active_store))
{
	echo "koovs";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
								
				$search_product_url = "http://www.koovs.com/$proname1";
				$detailpage = file_get_contents($search_product_url);
				preg_match_all('/<div class="prodDescp">(.*?)<\/div>/s',$detailpage, $divdetailsspl);
			if($divdetailsspl != "")
				{
					for($i="0";$i<10;$i++)
					{					
							$dom = new DOMDocument;
							@$dom->loadHTML($divdetailsspl[1][$i]);
					foreach ($dom->getElementsByTagName('a') as $tag)
							{	
							  $link=$tag->getAttribute('href'); 
													
							 $product_name=$tag->nodeValue;
														
								$param='koovs';
								$price1=$this->admin_model->get_price($param,$link);

								$storeid = "233";
								$arrlisting="koovs";
							$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
											//echo "<pre>";
															//print_r($resultorun);
					if($resultorun)
										{
											continue;
										}
																
										if($i < $max)
											{
											$this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
											}
									   
								
														}

												}
					
										}
}
sleep(2);
if(in_array(238,$get_active_store))
{
	echo "landmark";
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
				
			$search_product_url = "http://www.landmarkonthenet.com/search/?q=$proname1";
			
				$detailpage = file_get_contents($search_product_url);
				
			preg_match_all('/<h1>(.*?)<\/h1>/s',$detailpage, $divdetailsspl);
			if($divdetailsspl != "")
				{
			for($i=1;$i<11;$i++)
				{					
				$dom = new DOMDocument;
				@$dom->loadHTML($divdetailsspl[1][$i]);
			foreach ($dom->getElementsByTagName('a') as $tag)
					{	
					  $link="http://www.landmarkonthenet.com".$tag->getAttribute('href'); 
							
						$product_name=$tag->nodeValue;
														
							$param='landmark';
						$price1=$this->admin_model->get_price($param,$link);
															
							$storeid = "238";
						$arrlisting="landmark";
						$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
						//echo "<pre>";
						//print_r($resultorun);
						if($resultorun)
							{
								continue;
								}
							if($i < $max)
									{
							$this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
									}
									   
									}

								}
							}

}sleep(2);
if(in_array(230,$get_active_store))
{
	
				$color = $products->color;

				$proname = str_replace($color,'',$proname);

				$proname1=str_replace(' ','+',$proname);
						
			$search_product_url = "http://www.croma.com/search/?text=$proname1";
			 $detailpage = $this->admin_model->url_parsing($search_product_url);
									 
			preg_match_all('/<h2>(.*?)<\/h2>/s',$detailpage, $divdetailsspl);
									 
									
				if($divdetailsspl != "")
					{
					for($i="0";$i<10;$i++)
								{					
								$dom = new DOMDocument;
								@$dom->loadHTML($divdetailsspl[1][$i]);
								foreach ($dom->getElementsByTagName('a') as $tag)
								{	
								 $link="http://www.croma.com".$tag->getAttribute('href'); 
								
								$product_name=$tag->getAttribute('title');
							
								$param='cromaretail';
								$price1=$this->admin_model->get_price($param,$link);
								
								$storeid = "230";
								$arrlisting="cromaretail";
								$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);
								
								if($resultorun)
								{
									continue;
								}
									if($i < $max)
									{
									$this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
									}
									   
								
								}

						}
						
				}
				
}

//die;
//end if

$datadetails = array('get_link_status' => '1');

                $this->admin_model->update_records('products',$datadetails,'product_id',$product_id);

}
			
		}
			}

}

}

}

//surendhar
/* function get_product_links_dynamic_common()
{

$max="10";

$prolist = $this->admin_model->get_product_list();
//print_r($prolist);die;
if($prolist)

{

foreach($prolist as $products)

{

 $proname = $products->product_name;

 $product_id = $products->product_id;

 
 $get_active_store=$this->admin_model->get_active_store($products->parent_id,$products->parent_child_id);
if (($key = array_search('85', $get_active_store)) !== false) {
    unset($get_active_store[$key]);
}
print_r($get_active_store);
	$datadetails = array('get_link_status' => '2');

	$this->admin_model->update_records('products',$datadetails,'product_id',$product_id);


            if($proname)

            {

				$site=$this->db->query("select * from affiliates WHERE store_type = 'On1'")->result();

$i=1;

foreach($site as $site1)

{

$store_id=$site1->affiliate_id;
if($get_active_store)
{

if(in_array(210,$get_active_store))

{

				$color = $products->color;

				

				$newproname = str_replace($color,'',$proname);

				

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				$newproname = $shorten_name;

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				

				 $proname1=str_replace(' ','+',$pronam);

				// $proname1="iphone+6s+16gb";

			

				 $search_product_url = 'http://www.ebay.in/sch/i.html?_nkw='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

			

				

preg_match_all('/<h3 class="lvtitle">(.*?)<\/h3>/s',$detailpage, $href);



				



if($href != "")

{

				

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

  echo   $link=$tag->getAttribute('href'); 

  echo "<br>";

  echo $product_name=$tag->nodeValue;

   // echo   $pro_name=$tag->getAttribute('title');

   echo "<br>";

 $param='ebay';

  $price1=$this->admin_model->get_price($param,$link);

 echo $price1;

		

				$storeid = "210";

					$arrlisting="ebay";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
					

						}

               

		

}



}



}

}





if(in_array(209,$get_active_store))

{

	

	

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				//$pronam="shirts";

				

				

				$proname1=str_replace(' ','+',$pronam);

				$search_product_url = "http://www.naaptol.com/search.html?type=srch_catlg&kw=$proname1";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				// print_r($detailpage);

				// exit;

				

preg_match_all('/<div class="item_title">(.*?)<\/div>/s',$detailpage, $href);



					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

	if($tag->getAttribute('id') == "")

	{

		echo   $link="http://www.naaptol.com".$tag->getAttribute('href'); 

		echo "<br>";

		echo $product_name=$tag->nodeValue;

		echo "<br>";

		$param='naaptol';

		echo $price1=$this->admin_model->get_price($param,$link);

	

		echo "<br>";

		

	}

					$storeid = "209";

					$arrlisting="Naaptol";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

              

		

}



}



}



	

}

	if(in_array(205,$get_active_store))

{

	

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				//$pronam="shirts";

				

				

				$proname1=str_replace(' ','+',$pronam);

				$search_product_url = "http://shopping.indiatimes.com/mtkeywordsearch?SEARCH_STRING=$proname1";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

preg_match_all('/<a class="product-anchor" data-ga-en="[^>]*" href="[^>]*" onClick="[^>]*">(.*?)<\/a>/s',$detailpage, $href);

				



					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

	

		echo   $link="http://shopping.indiatimes.com".$tag->getAttribute('href'); 

		echo "<br>";

		 echo   $product_name=$tag->getAttribute('title');

		

		 echo "<br>";

		 $param='indiatimes';

		 echo $price1=$this->admin_model->get_price($param,$link);

	

		 echo "<br>";

					$storeid = "205";

					$arrlisting="Indiatimes Shopping";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);
					

						}

              

		

}



}



}



}

	

	if(in_array(175,$get_active_store))

{

	

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				

				//$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				$pronam="shirts";

				

				

				$proname1=str_replace(' ','+',$pronam);

				$search_product_url = "https://www.shoppersstop.com/search/?text=$proname1";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

				

				

preg_match_all('/<div class="pro-info">(.*?)<\/div>/s',$detailpage, $href);



// print_r($href);

// exit;

				



					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

	

		echo   $link="https://www.shoppersstop.com".$tag->getAttribute('href'); 

		echo "<br>";

		echo $product_name=$tag->nodeValue;

		echo "<br>";

		$price1='';

		// $param='shoppersstop';

		// echo $price1=$this->admin_model->get_price($param,$link);

	    echo "<br>";

	

					$storeid = "175";

					$arrlisting="ShoppersStop.com";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                   $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

              

		

}



}



}



}



if(in_array(206,$get_active_store))

{

	

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				$newproname = $shorten_name;

				// $pronam=substr($proname,0,24);

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				 $proname1=str_replace(' ','+',$pronam);

				 //$proname1="iphone+6s";

			

				 $search_product_url = 'http://shopping.rediff.com/product/'.$proname1.'?sc_cid=shopping_inhomesrch';

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

				

preg_match_all('/<div id="catmore_0">(.*)<\/div>/s',$detailpage, $divdetailsspl);



preg_match_all('/<h4 class="mitemname_h4">(.*?)<\/h4>/s',$divdetailsspl[0][0], $href);

		if($href != "")

		{			

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

  echo   $link=$tag->getAttribute('href'); 

  echo "<br>";

  echo   $product_name=$tag->getAttribute('title');

  echo "<br>";

 $param='rediff';

  $price1=$this->admin_model->get_price($param,$link);

 echo $price1;

	echo "<br>";

	

					$storeid = "206";

					$arrlisting="Rediff Shopping";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

}



}



}



}



if(in_array(145,$get_active_store))

{

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				//$pronam="Density Oxygen Running";

				

				

				$proname1=str_replace(' ','+',$pronam);

				

				$search_product_url = "http://www.snapdeal.com/search?keyword=$proname1&santizedKeyword=&catId=&categoryId=&suggested=false&vertical=&noOfResults=48&clickSrc=go_header&lastKeyword=&prodCatId=&changeBackToAll=false&foundInAll=false&categoryIdSearched=&cityPageUrl=&url=&utmContent=&dealDetail=&sort=rlvncy";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

			// print_r($detailpage);

			// exit;

				

preg_match_all('/<div class="product-desc-rating title-section-expand">(.*?)<\/div>/s',$detailpage, $href);



					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

		echo   $link=$tag->getAttribute('href'); 

		echo "<br>";

		echo $product_name=$tag->nodeValue;

		echo "<br>";

		$param='snapdeal';

		 echo $price1=$this->admin_model->get_price($param,$link);

	

		echo "<br>";

		

		

					$storeid = "145";

					$arrlisting="snapdeal";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

              

		

}



}



}

}







if(in_array(221,$get_active_store))

{


				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				$newproname = $shorten_name;

				// $pronam=substr($proname,0,24);

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				

				 $proname1=str_replace(' ','+',$pronam);

				 //$proname1="iphone+6s+16gb";

			

				 $search_product_url = 'http://www.amazon.in/s/?field-keywords='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

				

preg_match_all('/<div class="a-row a-spacing-small">(.*?)<\/div>/s',$detailpage, $href);



if($href != "")

{

for($i="2";$i<4;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

  echo   $link=$tag->getAttribute('href'); 

  echo "<br>";

    echo   $product_name=$tag->getAttribute('title');

    echo "<br>";

 // $param='amazon';

   $price1='';

 // echo $price1;

// exit;

					$storeid = "221";

					$arrlisting="Amazon";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                   $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

               

		

}



}



}



	

	

}

	if(in_array(204,$get_active_store))

{

	

				

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				$newproname = $shorten_name;

				// $pronam=substr($proname,0,24);

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				$proname1=str_replace(' ','+',$pronam);

				 //$proname1="iphone+6s+16gb";

			

				 $search_product_url = 'http://search.shopclues.com/?q='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

preg_match_all('/<div class="products_list">(.*)<\/div>/s',$detailpage, $divdetailsspl);



				

preg_match_all('/<h5>(.*?)<\/h5>/s',$divdetailsspl[0][0], $href);

				

				

if($href != "")

{				

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

  echo   $link=$tag->getAttribute('href'); 

  echo "<br>";

  echo $product_name=$tag->nodeValue;

   // echo   $pro_name=$tag->getAttribute('title');

   //echo "<br>";

  $param='shopclues';

 $rr=file_get_contents($link);





preg_match_all('/<div class="price">(.*?)<\/div>/s',$rr, $divdetailsspl);

 $str1=strip_tags($divdetailsspl[0][0]);



//$str = "Deal Price:Rs.15,399";

echo $price1 = str_replace('Deal Price:Rs.','', $str1);

 

	 echo "<br>";

	 $storeid = "204";

					$arrlisting="ShopClues";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

               

		

}



}



}

	

}







if(in_array(237,$get_active_store))

{

	

	

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				

				$pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				//$pronam="iphone 6s 16gb";

				

				

				$proname1=str_replace(' ','+',$pronam);

				$search_product_url = "http://www.crossword.in/search?q=$proname1";

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

preg_match_all('/<span class="variant-title">(.*?)<\/span>/s',$detailpage, $href);



			// print_r($href);

			// exit;

					if($href != "")

					{						

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

		echo   $link="http://www.crossword.in".$tag->getAttribute('href'); 

		echo "<br>";

		echo $product_name=$tag->nodeValue;

		echo "<br>";

		$param='crossword';

		 echo $price1=$this->admin_model->get_price($param,$link);

	

		echo "<br>";

		

		

					$storeid = "237";

					$arrlisting="Crossword";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

             

		

}



}



}	

}









if(in_array(208,$get_active_store))

{

	

				

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				$newproname = $shorten_name;

				// $pronam=substr($proname,0,24);

				 $pronam=implode(' ', array_slice(str_word_count($proname, 2), 0, 3));

				 $proname1=str_replace(' ','+',$pronam);

				// $proname1="iphone+6s";

			

				 $search_product_url = 'http://www.infibeam.com/search?q='.$proname1;

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

				

				



preg_match_all('/<div class="product-content col-md-12 col-xs-8">(.*)<\/div>/s',$detailpage, $divdetailsspl);





preg_match_all('/<div class="title">(.*?)<\/div>/s',$divdetailsspl[0][0], $href);

				













if($href != "")

{

				

for($i="0";$i<$max;$i++)

{

$dom = new DOMDocument;

@$dom->loadHTML($href[0][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

	

  echo   $link="http://www.infibeam.com".$tag->getAttribute('href'); 

  echo "<br>";

   echo   $product_name=$tag->getAttribute('title');

  echo "<br>";

 $param='infibeam';

  $price1=$this->admin_model->get_price($param,$link);

 echo $price1;

 

 $storeid = "208";

					$arrlisting="Infibeam.com";

					$resultorun  = $this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    //echo "<pre>";

                    //print_r($resultorun);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

							

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

               

		

}



}



}

}

	

if(in_array(232,$get_active_store))

{

				$color = $products->color;

				$newproname = str_replace($color,'',$proname);

				

				$shorten_name = $this->admin_model->short_product_name($newproname); //we get the shorten product name

				$newproname = $shorten_name;

				

				//$pronam="iphone 6s 16gb";

				

				  $proname1=str_replace(' ','+',$pronam);

			

				
			

				 $search_product_url = 'http://www.themobilestore.in/catalogsearch/result/?q='.$proname1.'&order=saleability&dir=asc';

			

                $detailpage = $this->admin_model->url_parsing($search_product_url);

				

				

				

preg_match_all('/<div class="product_name">(.*?)<\/div>/s',$detailpage, $divdetailsspl);



		if($divdetailsspl != "")

		{

for($i="0";$i<$max;$i++)

{					

$dom = new DOMDocument;

@$dom->loadHTML($divdetailsspl[1][$i]);

foreach ($dom->getElementsByTagName('a') as $tag) 

{

  echo   $link=$tag->getAttribute('href'); 

  echo "<br>";

  echo   $product_name=$tag->getAttribute('title');

  echo "<br>";

  $param='themobilestore';

  $price1=$this->admin_model->get_price($param,$link);

  echo $price1;

	echo "<br>";

	

 

					$storeid = "232";

					$arrlisting="Themobilestore";

					$resultorun=$this->admin_model->checkthelink_is_already_exist($storeid,$product_id);

                    if($resultorun)

					{

						continue;

						}

						

						if($i < $max)

						{

                    $this->admin_model->addstoreurl($storeid,$product_id,$arrlisting,$link,$price1,$product_name);

						}

              

		

}



}



}



	

}





//end if





$datadetails = array('get_link_status' => '1');

                $this->admin_model->update_records('products',$datadetails,'product_id',$product_id);



}



				
		}
			}

			

			

			

	

}



}

} */
//sharmila
function get_products_update()
{
    $id = $this->input->post('id');
    if($id!='')
    {
        $res = $this->admin_model->get_products_update();
    }
}

function delete_products_update()
{
    $id = $this->input->post('id');
    $store_id = $this->input->post('store_id');

    if($id!='')
    {
        $res = $this->admin_model->delete_products_update();
    }
}

function view_stores($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") {
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('59',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['rr'] = $this->admin_model->view_offline_stores($id);
			$this->load->view('adminsettings/view_stores',$data);
		}	
	}

	function pricealert_sms()
	{
		// echo 'hkjkj';die;
		// $this->db->connection_check();
		$this->db->where('status','1');
		$qry = $this->db->get('price_alerts');
		// echo $this->db->last_query();die;
		if($qry->num_rows() > 0)
		{
			$stat = $qry->result();
			/*echo '<pre>';
		
			print_r($stat);*/
				$i=0;
		foreach($stat as $qry1)
		{
			
			$product_id = $qry1->product_id;

		$query1 = $this->db->query("select *,t2.product_id as product_id from price_alerts t2 join(select t1.product_price,t1.old_price,t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.product_id='$product_id'");
		// echo $this->db->last_query();die;
		
		
		if($query1)
		{
			
			$query = $query1->row();

		    $new_price = $query->product_price;
			
		    $old_price = $qry1->price;
			if($new_price < $old_price)
			{
				
				 $mobile_number = $qry1->mobile_number;
				 $user_email = $qry1->email;
			// $send_sms = $this->send_sms($mobile_number,$new_price);
				
		$this->db->where('admin_id',1);
		$admin_det = $this->db->get('admin');
		if($admin_det->num_rows >0) 
		{    
			// echo 'dfhdkh';die;
			 $admin = $admin_det->row();
			 $admin_email = $admin->admin_email;
			 $site_name = $admin->site_name;
			 $admin_no = $admin->contact_number;
			  $site_logo = $admin->site_logo;
		}
		
		$date =date('Y-m-d');
		
		$this->db->where('mail_id',17);
		$mail_template = $this->db->get('tbl_mailtemplates');
		if($mail_template->num_rows >0) 
		{        
		   $fetch = $mail_template->row();
		   $subject = $fetch->email_subject;  
		   $templete = $fetch->email_template;

			    $sub_data = array(
						'###SITENAME###'=>$site_name
					);
	             $subject_new = strtr($subject,$sub_data);
		   
		   // echo $subject_new;die;
		   $data = array(
						'###NAME###'=>$email,
						'###COMPANYLOGO###' =>base_url()."/uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
						'###PRICE###' =>$old_price,
						'###PRICE1###' =>$new_price,
		   );
		   
		   $content_pop=strtr($templete,$data);	
		   // echo $content_pop;die;
		   // echo $user_email;die;
		   $this->admin_model->mail_function($admin_email,$user_email,$subject_new,$content_pop);
		
		}
		    
		}
		// echo $i++;
		
	  }

	 
	}
	 return true;
  }
}

// sharmila  25/04/2016 start here..

function get_coupon_code($coupon_id)
{
	// echo $coupon_id;die;
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") 
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('59',$sub_access))) && $admin_id!=1)
		 {
			redirect('adminsettings/index','refresh');
		} else
		{
			$data['coupon'] = $this->admin_model->main_coupon_details($coupon_id);

			$data['code'] = $this->admin_model->get_coupon_code($coupon_id);
			// print_r($data['code']);die;
			
			$this->load->view('adminsettings/coupon_code',$data);
		}	
	}

// sharmila end here  25/04/2016..

	 function get_coupon_codes($coupon_id)
{
	// echo $coupon_id;die;
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") 
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('59',$sub_access))) && $admin_id!=1)
		 {
			redirect('adminsettings/index','refresh');
		}
		else
		{
			if($this->input->post('hidd'))
			{
				 if($this->input->post('chkbox'))
				 {
					 $results = $this->admin_model->coupons_bulk_delete_code();
				 }
				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Coupons code details Deleted successfully.');
					redirect('adminsettings/get_coupon_codes/'.$coupon_id,'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while deleting Coupon details.');
					redirect('adminsettings/get_coupon_codes/'.$coupon_id,'refresh');
				}
			}
			$data['coupon'] = $this->admin_model->main_coupon_details($coupon_id);

			$data['code'] = $this->admin_model->get_coupon_code($coupon_id);
			// print_r($data['code']);die;
			
			$this->load->view('adminsettings/coupon_codes',$data);
		}	
	}

	// sharmila 29/04/2016...

	function store_location()
{
	// echo $coupon_id;die;
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") 
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('59',$sub_access))) && $admin_id!=1)
		 {
			redirect('adminsettings/index','refresh');
		} else
		{
			$id = $this->input->post('id');
			$result = $this->admin_model->store_location($id);
			$input = '';
			if($result){
			
			foreach($result as $name){
				$input .= '<option value="'.$name->store_addid.'">'.$name->address.'</option>';
			}
		}else{
			$input .='false';
		}
			echo $input;
		}	
	}
 
  	// update_store_location

  	function update_store_location()
{
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
	$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") 
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('59',$sub_access))) && $admin_id!=1)
		 {
			redirect('adminsettings/index','refresh');
		} else
		{
			$id = $this->input->post('id');
			$result = $this->admin_model->store_location($id);
			$input = '';
			if($result){
			
			foreach($result as $name){
				$input .= '<option value="'.$name->store_addid.'">'.$name->address.'</option>';
			}
		}else{
			$input .='false';
		}
			echo $input;
		}	
	}

	// sharmila 29/04/2016....
	
	
	function get_affiliate_value()
			{
			$value = $this->input->post('value');
			$result = $this->admin_model->get_affiliate_value($value);
			$input = '';
			if($result)
			{
			$input .= $result;
			}
			else
			{
			$input .='';
			
			}
			echo $input;
}

	// 06/05/2016   ....

	function Add_filter_categories($second_level=NULL)
	{
		// echo 'ini';die;
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		$type = $this->uri->segment(3);
		if($admin_id=="") 
		{
			redirect('adminsettings/index','refresh');
		}
		else if((!(in_array('59',$sub_access))) && $admin_id!=1) 
		{
			redirect('adminsettings/index','refresh');
		} 
		else
		{
			if($type=="add")
			{
				// echo 'addd';
			$save=$this->admin_model->store_filters($this->input->post('cate_id'));
			if($save)
			{
				$this->session->set_flashdata('success', ' Filters Added successfully');
				redirect('adminsettings/product_categories','refresh');
		    }
		else
		{
			$this->session->set_flashdata('error', 'Error occurred ');
			redirect('adminsettings/product_categories','refresh');
		}
		}
		elseif($type=="edit")
		{
			$result = $this->admin_model->update_store_filters();
			if($result)
			{
				$this->session->set_flashdata('success', ' Filters Updated Successfully');
				redirect('adminsettings/product_categories','refresh');
		    }
		else
		{
			$this->session->set_flashdata('error', 'Error occurred ');
			redirect('adminsettings/product_categories','refresh');
		}

		}
		else
		{
			// echo $second_level;die;
			$data['filters'] = $this->admin_model->get_sub_filters($second_level);
			$data['main_filters'] = $this->admin_model->get_cate_filters($second_level);
			// echo '<pre>';
			// print_r($data);
			$this->load->view('adminsettings/add_filters',$data);
		}
	 }
	}

	// 06/05/2016...
	
	//ganesh may6 
	function change_categories1(){
		
		 $cat_id = $this->input->post('cat_id');
		$result = $this->admin_model->product_categories($cat_id);
		//print_r($result);
		
		$input = '';
		if($result){
			$input .='<option value=""> Select </option>';
			foreach($result as $name){
				$input .= '<option value="'.$name->cate_id.'">'.$name->category_name.'</option>';
			}
		}else{
			$input ='0';
		}
			echo $input;
	}
	
	function get_report_vcommision($apikey,$netwrkid)
	{
	
				 $this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}
		else
		{
			
			if($apikey!='')
			{
				
				 $url ='https://api.hasoffers.com/Apiv3/json?NetworkId='.$netwrkid.'&Target=Affiliate_Report&Method=getConversions&api_key='.$apikey.'&fields%5B%5D=Browser.display_name&fields%5B%5D=Browser.id&fields%5B%5D=Country.name&fields%5B%5D=Goal.name&fields%5B%5D=Offer.name&fields%5B%5D=OfferUrl.id&fields%5B%5D=PayoutGroup.id&fields%5B%5D=PayoutGroup.name&fields%5B%5D=Stat.ad_id&fields%5B%5D=Stat.affiliate_info1&fields%5B%5D=Stat.affiliate_info2&fields%5B%5D=Stat.affiliate_info3&fields%5B%5D=Stat.affiliate_info4&fields%5B%5D=Stat.approved_payout&fields%5B%5D=Stat.datetime&fields%5B%5D=Stat.sale_amount&fields%5B%5D=Stat.session_datetime&sort%5BStat.datetime%5D=desc&limit=100';
				//echo $url;exit;
				$content = json_decode(file_get_contents($url),true);
				 
				//echo $content['response']['status'];
			}
			if($content['response']['status']==1)
			{				
				
					$results = $this->admin_model->import_reports_products($content);
					if($results)
					{
						$msg='Imported successfully';
					}
						
				
				
			}
			else {
				$msg= 'No data found.';
			}
			echo 'xfbvdfgdfg'.$msg;		
		} 
		
		
	}
	
	function get_report_snapdeal($apikey,$netwrkid)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}
		else
		{
			$now=date('Y-m-d');
			$sdate=date('Y-m-d',strtotime('-15 days',strtotime($now)));
			$flag=0;
			if($apikey!='')
			{ 
				
				 $cmd='curl -H "Snapdeal-Affiliate-Id:'.$apikey.'" -H "Snapdeal-Token-Id:'.$netwrkid.'" "affiliate-feeds.snapdeal.com/feed/api/order?startDate='.$sdate.'&endDate='.$now.'&status=approved" -H "Accept:application/json"';
					
					
					$content=json_decode(shell_exec($cmd));
					
					
			}
			if($content->productDetails!='')
			{				
				
					$results = $this->admin_model->import_reports_products_snp($content);
					//print_r($results);die;
					$msg =array();					
					

					if($results['duplicate'] == 0){
						
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['duplicate']!=0){
						
						$msg['success'] = 'New Report details added successfully and <span style="color:red">'.$results['duplicate'].'</span> duplicate records neglected. The duplicate transactions ids are '.$results['trans_id'];
					}					
				
				
			}
			else {
				$msg['success'] = 'No data found.';
			}
			echo json_encode($msg);		
		}
		
	}

	
 
 
 function get_report_OMG($apikey)
 {
	 $this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		}else if((!(in_array('6',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		}
		else
		{
			$flag=0;
			if($apikey!='')
			{
				 
			date_default_timezone_set("UTC");
			$t = microtime(true);
			$micro = sprintf("%03d",($t - floor($t)) * 1000);
			 $utc = gmdate('Y-m-d H:i:s.', $t).$micro;
			  
			 $private_key=$this->input->post('networkid');
			
			$concateData = $private_key.$utc;
			 $sig = md5($concateData);
			 $utc=str_replace(' ','%20',$utc);
				$mode='cbc';
				$blockSize = 128;
				//$aes = $this->AES($sig_data, $private_key, $blockSize, $mode);
				//echo $enc = $this->AES>encrypt();		
				$aff_id=$this->input->post('track_id');
				
				$edate=date('Y-m-d');
				$sdate=date('Y-m-d',strtotime('-1 month',strtotime($edate)));
				 $url='https://api.omgpm.com/network/OMGNetworkApi.svc/v1.2/Reports/Affiliate/TransactionsOverview?AID='.$aff_id.'&CountryCode=IN&AgencyID=95&MID=&PID=&Status=-1&StartDate='.$sdate.'&EndDate='.$edate.'&NumberOfRecords=&Key='.$apikey.'&Sig='.$sig.'&SigData='.$utc;
			
				/* $fileContents = file_get_contents($url);
				 print_r($content);die; */
				
				 
				$ch = curl_init();
				$headers = array(
				"Content-Type: application/json",
				"Accept: application/json",
				"Access-Control-Request-Method: GET"
				);
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch,CURLOPT_HEADER, false);
				$content=curl_exec($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				//$json = json_encode($simpleXml);
				 $content=(json_decode($content));
				 
				//echo $content['response']['status'];
			}
			if($content!="") 
			{				
				
					$results = $this->admin_model->import_reports_products_omg($content);
					//print_r($results);die;
					$msg =array();					
					/* if($results['output'] ==1){				
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['output']!=1)
					{							
						$msg['success'] = 'Error occurred while importing report details' ;
					}	 */

					if($results['duplicate'] == 0){
						/* $this->session->set_flashdata('success', ' Coupon details added successfully.');
						redirect('adminsettings/affiliate_network','refresh'); */
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['duplicate']!=0){
						
						$msg['success'] = 'New Report details added successfully and <span style="color:red">'.$results['duplicate'].'</span> duplicate records neglected. The duplicate transactions ids are '.$results['trans_id'];
					}					
				
				
			}
			else {
				$msg['success'] = 'No data found.';
			}
			echo json_encode($msg);		
		}
		
 }


 // sharmila 17/05/2016  product_clickhistory

	function product_clickhistory()
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('25',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
				$data['pendings'] = $this->admin_model->product_clickhistory();
		$this->load->view('adminsettings/product_clickhistory',$data);
		}
	}


	function pending_remove_ptrs($pid=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('88',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		$de_pid = base64_decode($pid);
		$delete=$this->admin_model->pending_remove_ptrs($de_pid);
		if($delete)
		{
			redirect('adminsettings/product_clickhistory','refresh');
		}
	 }
	}

	// approve_status

	function approve_status($pid=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('88',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		$de_pid = base64_decode($pid);
		$delete=$this->admin_model->approve_status($de_pid);
		if($delete)
		{
			redirect('adminsettings/pending_transaction','refresh');
		}
	 }
	}

	// remove_transactions

	function remove_transactions($pid=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="")
		{
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('88',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		$de_pid = base64_decode($pid);
		$delete=$this->admin_model->remove_transactions($de_pid);
		if($delete)
		{
			redirect('adminsettings/pending_transaction','refresh');
		}
	 }
	}

	function confirm_transactions($user_id=NULL,$trans_id=NULL)
	{	

		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id=="") 
		{
			redirect('adminsettings/index','refresh');
		} 
		else if((!(in_array('59',$sub_access))) && $admin_id!=1)
	    {
			redirect('adminsettings/index','refresh');
		} else
		{
			/*echo $user_id;
			echo $trans_id; die;*/
			$data['user_det'] = $this->admin_model->tran_user_details($user_id);
			/*echo '<pre>';
			print_r($data['user_det']);die;*/
			$data['trans_det'] = $this->admin_model->transactions_detailss($trans_id);
			/*echo '<pre>';
			print_r($data['trans_det']);die;*/
			$this->load->view('adminsettings/transaction_payu',$data);
		}	
		
	}

	function transaction_confirmation($user_id=NULL,$trans_id=NULL)
	{	
		extract($_REQUEST);
    	$ver=$this->input->post();
		$date=date('Y-m-d');
    	// print_r($ver);die;
    	$this->db->where('withdraw_id',base64_decode($trans_id));
    	$vari =  $this->db->get('withdraw');
    	if($vari->num_rows()==1)
    	{
    		$vary = $vari->row();
    		$req = $vary->requested_amount;
    	}
    	if($ver['status']=='success')
			{
				$transation_status='Paid';
			}
		else
			{
				$transation_status='Pending';
			}
		    	$data = array(
									'payid' => $ver['mihpayid'],
									'transation_status' => $transation_status,
									'txn_id' => $ver['txnid'],
									'user_id'=>	base64_decode($user_id),
									'transation_reason'=>'Cashback Amount',
									'transation_amount'=>$ver['net_amount_debit'],
									'mode'=>'Credited',
									'transation_date'=>$ver['addedon']
								);
				 $res = $this->db->insert('transation_details',$data);

				 $data1 = array(
				 'closing_date'=>$date,
				 			'status'=>'Completed',
				 		  );
				$this->db->where('withdraw_id',base64_decode($trans_id));
				$this->db->where('user_id',base64_decode($user_id));
				$shar = $this->db->update('withdraw',$data1);
				
				if($shar)
				{
					redirect('adminsettings/withdraw');
				}
	}
	
	function get_report_amazon()
	{
		
		 $import = $_FILES['upload_xml']['name'];
		 $xml = simplexml_load_file($_FILES['upload_xml']['tmp_name']);
		 
		 $details=$xml->Items;
		 echo "<pre>";
		 print_r($details);die;
		 if($details!="") 
			{				
				
					$results = $this->admin_model->import_reports_products_amz($details);
					//print_r($results);die;
					$msg =array();					
					/* if($results['output'] ==1){				
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['output']!=1)
					{							
						$msg['success'] = 'Error occurred while importing report details' ;
					}	 */

					if($results['duplicate'] == 0){
						/* $this->session->set_flashdata('success', ' Coupon details added successfully.');
						redirect('adminsettings/affiliate_network','refresh'); */
						$msg['success'] = 'Reports details imported successfully.';
					}
					else if($results['duplicate']!=0){
						
						$msg['success'] = 'New Report details added successfully and <span style="color:red">'.$results['duplicate'].'</span> duplicate records neglected. The duplicate transactions ids are '.$results['trans_id'];
					}					
				
				
			}
			else {
				$msg['success'] = 'No data found.';
			}
			echo json_encode($msg);
		
		 
		
		
		
	}
	
	
function redemptions(){
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('hidd'))
			{
				
				 if($this->input->post('chkbox'))
				 {
					
					$sort_order = $this->input->post('chkbox');					 
					 $results = $this->admin_model->delete_bulk_records($sort_order,'Redamption','Redamption_id');
				 }				
				
				if($results){
					
					$this->session->set_flashdata('success', 'Redamption details deleted successfully.');
					redirect('adminsettings/Redamption','refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Error occurred while updating Redamption details.');
					redirect('adminsettings/Redamption','refresh');
				}
			}
			$data['redamption'] = $this->admin_model->get_redamptions();
			$this->load->view('adminsettings/redamption',$data);
		}
	}
	
	function editredamptions($id){
	$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$withdraw = $this->admin_model->editredamptions($id);
			if($withdraw){
				foreach($withdraw as $get) { 
					$data['redamption_id'] = $get->redamption_id;
					$data['user_id'] = $get->user_id;
					$data['requested_points'] = $get->requested_points;
					$data['date_added'] = $get->date_added;
					$data['closing_date'] = $get->closing_date;
					$data['status'] = $get->status;
				}
			} else {
				redirect('adminsettings/redamption','refresh');
			}
			$data['action'] = 'new';
			$this->load->view('adminsettings/editredamptions',$data);
		}
	}
	
	function updateredamption(){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			if($this->input->post('save')){
				$id = $this->input->post('redamption_id');
				$updation = $this->admin_model->updateredamption($id);
				if($updation){ 
					$this->session->set_flashdata('success', ' Redamption status updated successfully.');
					redirect('adminsettings/redemptions','refresh');
				} else { 
					$data['action']="new";
					$this->session->set_flashdata('error', 'Error occurred while updating Redamption status.');
					redirect('adminsettings/editredamptions/'.$id,'refresh');
				}
			}
		}
	}
	
	function delete_redamption($id){
	$this->input->session_helper();
	$admin_id = $this->session->userdata('admin_id');
	$user_access=$this->session->userdata('user_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('17',$user_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			$deletion = $this->admin_model->delete_redamption($id);
			if($deletion){
				$this->session->set_flashdata('success', 'Redemption details deleted successfully.');
				redirect('adminsettings/redemptions','refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred while deleting Redemption details.');
				redirect('adminsettings/redemptions','refresh');
			}
		}
	}
	
	function change_status_price_cron()
	{
		$data=array('status'=>0);
		//$this->db->where('store_id',$var);
		$this->db->update('product_price',$data);
		echo $this->db->last_query();
	}
 //ganesh june 9
 function click_history1($count=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
			$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){ 
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('43',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
			
		$data['click_histories'] = $this->admin_model->click_history1($count);
		$this->load->view('adminsettings/click_history',$data);
		}
	}
	function remove_pclickhistroy($id=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$user_access=$this->session->userdata('user_access');
		$sub_access=$this->session->userdata('sub_access');
		
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('88',$sub_access))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
		 $de_pid = base64_decode($id);
		$delete=$this->admin_model->remove_pclickhistroy($de_pid);
		if($delete)
		{
			redirect('adminsettings/product_clickhistory','refresh');
		}
		}
	}
	function reply_contact($id=null)
	{
		$this->input->session_helper();
		$admin_id = $this->session->userdata('admin_id');
		$sub_access=$this->session->userdata('sub_access');
		if($admin_id==""){
			redirect('adminsettings/index','refresh');
		} else if((!(in_array('16',$this->session->userdata('sub_access')))) && $admin_id!=1) {
			redirect('adminsettings/index','refresh');
		} else
		{
				if($this->input->post('reply'))
				{
					$id=$this->input->post('rid');
					$results = $this->admin_model->send_rely_contact();
					if($results)
					{
						$this->session->set_flashdata('success', 'reply successfully.');
						redirect('adminsettings/contacts','refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'Error occurred.');
						redirect('adminsettings/contacts','refresh');
					}			
				} 
			$data['contacts'] = $this->admin_model->contact_details($id);
		
			$this->load->view('adminsettings/reply_contact',$data);
		}
		
	}
	
	function get_serach_product()
	{
		$this->input->session_helper();
		if($this->input->post('key'))
		{
			$key=$this->input->post('key');
			$get=$this->admin_model->get_search_products($key);
			if($get)
			{
				foreach($get as $product)
				{
					$k++;
							$product_id = $product->product_id;
							?>
                                <tr class="odd gradeX tbl-item">
                                    <td><?php echo $k; ?></td>
                                    <td><input type="checkbox"  class="check_b" name="chkbox[<?php echo $product_id;?>]" /></td>
                                    <td class=""><p class="titles "> <?php echo $product->product_name; ?> </p></td>
                                    <?php 
									if($product->product_image)
									{
									?>
                                    <td><center><img width="100" height="100" src="<?php echo base_url();?>uploads/products/<?php echo $product->product_image; ?>"></center></td>
                                    <?php
									}
									else
									{
										?>
                                        <td>&nbsp;</td>
                                        <?php
									}
									?>
                                    <?php
									$prodetail = $this->admin_model->fetch_product_details($product->product_url);
									//print_r($get_products_from_product_byid);
									/*exit;*/
									?>
                                    <td><?php echo DEFAULT_CURRENCY;?><?php 
									if($prodetail->Totalstores)
										echo $prodetail->min_price;
									else
										echo 0;
									?>
                                    </td>
                                    <td><?php 
									if($prodetail->Totalstores)
										echo $prodetail->Totalstores;
									else
										echo 0;
									?>
                                    </td>
                                    
                                    <td>
                                    <?php
									if($prodetail->Totalstores)
									{
										$comparisonprices = $this->admin_model->comparison_details($product_id);
										?>
                                       <a href="#myModal<?php echo $product_id;?>" class="btn btn-warning" role="button" data-toggle="modal">View Prices</a>
                                       <div id="myModal<?php echo $product_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel"> Price List</h3>
                                          </div>
                                          <div class="modal-body">
                                            <table width="354" height="107" class="table table-striped table-bordered" id="">
                                            <thead>
                                              <tr>
                                                 <td style="text-align:center;"> No</td>
                                                 <td style="text-align:center;"> Store</td>
                                                 <td style="text-align:center;"> Price</td>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
											$s =1;
											foreach($comparisonprices as $storess)
											{
											?>
                                              <tr>
                                                <td><?php echo $s;?></td>
                                                <td style="text-align:center"><img style="height:65px;" src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $storess->affiliate_logo;?>" /></td>
                                                <td><?php echo DEFAULT_CURRENCY;?><?php echo $storess->product_price;?></td>
                                              </tr>
                                             <?php
											 $s++;
											}
											 ?>
                                             </tbody>
                                            </table>
                                          </div>
                                          <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                            <!--<button class="btn btn-primary">Save changes</button>-->
                                          </div>
                                        </div>
                                        <?php
									}
									
									?>
                                    </td>
                                    <?php
									if($product->sort_order!='')
									{
										$sort_order =$product->sort_order;
									}
									else
									{
										$sort_order=0;
									}
									?>
                                    <td><input class="textbox" style="width:100px;" type="number"  size="4" value="<?php echo $sort_order;?>" name="sort_arr[<?php echo $product_id;?>]"></td>
								<td>

                                    <?php

                  $get_active_store=$this->admin_model->get_active_store($product->parent_id,$product->parent_child_id);

                  

                  //print_r($prodetail);die;

                  if(count($get_active_store)>0)

                  {

                     // print_r($get_active_store);

                

                    ?>



                    <?php if($product->product_status!='1'){ ?>

                                       

                                       <a href="#myModal1<?php echo $product_id;?>" id="store_<?php echo $product_id;?>" class="btn btn-warning" role="button" data-toggle="modal">Un Verified</a>

                    <?php } else{ ?>



                     <a href="javascript:;" id="store_<?php echo $product_id;?>" class="btn btn-warning" role="button">Verified</a>



                      <?php } ?>



                                       <div id="myModal1<?php echo $product_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                          <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h3 id="myModalLabel"> Price List</h3>

                                          </div>

                                          <div class="modal-body">

                                            <table width="354" height="107" class="table table-striped table-bordered" id="">

                                            <thead>

                                              <tr>

                                                 <td style="text-align:center;"> No</td>

                                                  <td style="text-align:center;">

                                                   <input type="checkbox" id="check_b1" class="check_b1;?>"  name="chk[]" /></td>

                                                 <td style="text-align:center;"> Store</td>

                                                 <td style="text-align:center;"> Links</td>

                                              </tr>

                                            </thead>

                                            <tbody>

                                            <?php

                      $s =1;

                      foreach($get_active_store as $st_ids)

                      {

                        $get_store=$this->admin_model->get_aff_stores($st_ids);

                        $get_active_links=$this->admin_model->get_active_links($st_ids,$product_id);

                        

                        

                      ?>

                                              <tr>

                                                <td><?php echo $s;?></td>

                                                 <td>

                          <input type="checkbox"  class="check_b1_<?php echo $product_id;?>" id="chk_<?php echo $product_id; ?>" name="chkbox1[]" value="<?php echo $get_store->affiliate_id; ?>"/></td>

                                                <td style="text-align:center"><img style="height:49px; width:135px;" src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $get_store->affiliate_logo;?>" /></td>

                                                <td>

                         <select name="affiliate_url[]" class="affiliate_url_<?php echo $product_id; ?>" required>







                        <?php foreach($get_active_links as $url)



                        { ?>



                        <option value="<?php echo $url->pp_id; ?>">



                        <?php echo $url->product_name;?>/<?php echo $url->product_price;?>



                        </option>



                        <?php } ?>



                        </select>

                        </td>

                                              </tr>

                                             <?php

                       $s++;

                      }

                       ?>

                                             </tbody>

                                            </table>

                                          </div>

                                          <div class="modal-footer">

                                          <!--   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->

                                            <!--<button class="btn btn-primary">Save changes</button>-->



                                             <input type="button" class="btn btn-warning" onclick="formSubmit('<?php echo $product_id;?>')" value="Save Changes" />



                                            <input type="button" class="btn btn-warning" onclick="form_delete('<?php echo $product_id;?>');" value="Delete">

                                          </div>

                                        </div>

                                        <?php

                  }

                  

                  ?>

                                    </td>	
									<td  style="text-align:center">
									<?php
									$status = $product->status;
										if($status=='1'){
											echo 'Activated';
											$lock = 'icon-unlock';
											$stat = '0';
										}else{
											echo 'De-activated';
											$lock = 'icon-lock';
											$stat = '1';
										}
									?>
									</td>
                                    <td  style="text-align:center" class="hidden-phone">
									<?php echo anchor('adminsettings/update_product_status/'.$product->product_id.'/'.$stat,'<i class="'.$lock.'"></i>'); ?>
									&nbsp;
									<?php echo anchor('adminsettings/update_product/'.$product->product_id,'<i class="icon-pencil"></i>'); ?>
									&nbsp;
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this product detail?');");		
									echo anchor('adminsettings/delete_product/'.$product->product_id,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php $s++;
				}
			}
		}
	}
	/* function flipk()
	{
		$this->admin_model->flipk();
	} */
}
?>