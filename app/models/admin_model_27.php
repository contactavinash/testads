<?php
class Admin_model extends CI_Model
{
	// this is to login check 
	function logincheck(){	
		$this->db->connection_check();
		$admin_username = $this->input->post('username');
		$admin_password = $this->input->post('password');
		
		$this->db->where('admin_username',$admin_username);
		$this->db->where('admin_password',$admin_password);
		$this->db->where('status','1');
		$query = $this->db->get('admin');
		if($query->num_rows==1){
			$fetch = $query->row();
			$admin_id = $fetch->admin_id;
			$admin_username = $fetch->admin_username;
			$admin_email = $fetch->admin_email;
			
			$main_access=$fetch->main_access;
			$sub_access=$fetch->sub_access;
			
			$this->session->set_userdata('admin_id',$admin_id);
			$this->session->set_userdata('admin_username',$admin_username);
			$this->session->set_userdata('admin_email',$admin_email);
			$this->session->set_userdata('main_access',unserialize($main_access));
			$this->session->set_userdata('sub_access',unserialize($sub_access));
			return true;
		}
		return false;
	}
	
	// get admin details..
	function getadmindetails(){
		$this->db->connection_check();
	$this->db->where('admin_id','1');
	$query_admin = $this->db->get('admin');
		if($query_admin->num_rows >= 1){
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else
		{
			return false;		
		}	
	}
	function get_admindetails()
	{
		$this->db->connection_check();
		$this->db->where('admin_id','1');
		$query_admin = $this->db->get('admin');
			if($query_admin->num_rows == 1){
				return $query_admin->row();
			}else{
				return false;		
			}	
	}
	function check_cate($cate)
	{
		$this->db->connection_check();
		$this->db->where('category_name',$cate);
		$qry = $this->db->get('categories');
		$numrows1 = $qry->num_rows();
		if($numrows1 == 0)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	function check_sub_cate($sub,$cate)
	{
		$this->db->connection_check();
		$this->db->where('sub_category_name',$sub);
		$this->db->where('cate_id',$cate);
		$qry = $this->db->get('sub_categories');
		$numrows1 = $qry->num_rows();
		if($numrows1 == 0)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	
	
	// update admin settings..
	function updatesettings($logo,$site_logo,$site_favicon,$background_image)
	{
		$this->db->connection_check();
		$admin_logo = $logo;
		$posted = $this->input->post('username');
		$this->session->set_userdata('admin_username',$posted);
		$data = array(
		'admin_username'=>$this->input->post('username'),
		'admin_email'=>$this->input->post('email'),
		'admin_paypal'=>$this->input->post('paypal_email'),
		'paypal_mode'=>$this->input->post('paypal_mode'),
		'admin_logo'=>$admin_logo,
		'site_logo'=>$site_logo,
		'default_currency'=>$this->input->post('default_currency'),		
		'background_image'=>$background_image,
		'site_prefix'=>$this->input->post('site_prefix'),
		'site_favicon'=>$site_favicon,
		'homepage_title'=>$this->input->post('homepage_title'),
		'referral_cashback'=>$this->input->post('referral_cashback'),
		'minimum_cashback'=>$this->input->post('minimum_cashback'),
		'site_name'=>$this->input->post('site_name'),
		'site_url'=>$this->input->post('site_url'),
		'admin_fb'=>$this->input->post('fb_url'),
		'admin_twitter'=>$this->input->post('twitter_url'),
		'admin_gplus'=>$this->input->post('gplus_url'),		
		'admin_instagram'=>$this->input->post('admin_instagram'),		
		'admin_pintrust'=>$this->input->post('admin_pintrust'),
		'contact_number'=>$this->input->post('contact_number'),
		'contact_info'=>$this->input->post('contact_info'),		
		'address'=>$this->input->post('address'),		
		'meta_title'=>$this->input->post('meta_title'),
		'meta_keyword'=>$this->input->post('meta_keyword'),
		'meta_description'=>$this->input->post('meta_description'),
		'site_mode'=>$this->input->post('site_mode'),
		'google_analytics'=>$this->input->post('google_analytics'),
		'google_key'=>$this->input->post('google_key'),
		'google_secret'=>$this->input->post('google_secret'),
                 'startup_bonus'=>$this->input->post('startup_bonus'),
		/*facebook App Id & secret key seetha -----*/
		'facebook_key'=>$this->input->post('facebook_key'),
		'facebook_secret'=>$this->input->post('facebook_secret'),
		
		'smtp_host_name'=>$this->input->post('smtp_host_name'),
		'smtp_username'=>$this->input->post('smtp_username'),
		'smtp_password'=>$this->input->post('smtp_password'),
		'smtp_port'=>$this->input->post('smtp_port'),		
		/*-----*/
                'coin_code'=>$this->input->post('coin_code'),
		'enable_blog'=>$this->input->post('enable_blog'),
		
		'enable_shopping'=>$this->input->post('enable_shopping'),
		
		'enable_slider'=>$this->input->post('enable_slider'),
		
		'blog_url'=>$this->input->post('blog_url')
		);
		$id = $this->input->post('admin_id');
		$this->db->where('admin_id',$id);
		$updation = $this->db->update('admin',$data);
		$default_currency_sym = $this->getallcurrencies_byid($this->input->post('default_currency'));			   
  		$this->session->set_userdata('default_currency',$default_currency_sym->symbol);
		$this->session->set_userdata('default_currency_code',$default_currency_sym->currency_code);
		
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;   
		}
	
	}
	
	//  change password for main admin
	function update_password()
	{
	
		$this->db->connection_check();
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$id = $this->input->post('admin_id');
		
		$where = array('admin_password'=>$old_password,'admin_id'=>$id);
		$this->db->where($where);
		$query_admin = $this->db->get('admin');
		if($query_admin->num_rows >= 1) 
		{
			$data = array(
			'admin_password'=>$new_password
			);
			$this->db->where('admin_id',$id);	
			$this->db->update('admin',$data);
			return true;
		}    
		else 
		{     
			return false;
		}			
	}
	
	// get referral cashback %
	function get_referral_percent(){
		$this->db->connection_check();
		$result = $this->db->get_where('admin',array('admin_id'=>'1'))->row('referral_cashback');
		return $result;
	
	}
	//adding cms..
	function addcms(){
		$this->db->connection_check();
		$seo_url  = $this->admin_model->seoUrl($this->input->post('page_title'));
		$data = array(
		'cms_heading' => $this->input->post('page_title'),
		'cms_metatitle' => $this->input->post('meta_title'),
		'cms_metakey' => $this->input->post('meta_keyword'),
		'cms_metadesc' => $this->input->post('meta_description'),
		'cms_content' => $this->input->post('cms_content'),
		
		'cms_position' => $this->input->post('cms_position'),	
		
		'cms_title' => $seo_url,	
		'cms_status' => $this->input->post('cms_status')
		);
		
		$this->db->insert('tbl_cms',$data);
		return true;
	}
	// get all cms
	function get_allcms()
	{
		$this->db->connection_check();
		$this->db->order_by('cms_id','desc');
		$cms_query = $this->db->get('tbl_cms');
		if($cms_query->num_rows > 0)
        {
            $row = $cms_query->row();
            return $cms_query->result();
        }
		else
		{
			return false;		
		}
	}
	
	// get particular cms
	function get_cmscontent($id){
		$this->db->connection_check();
		$this->db->where('cms_id',$id);        
        $query = $this->db->get('tbl_cms');
        if($query->num_rows >= 1)
		{
           $row = $query->row();			
            return $query->result();			
        }      
        return false;		
	}
	
	
	//update cms ..
	function updatecms()
	{
		$this->db->connection_check();
	$seo_url  = $this->admin_model->seoUrl($this->input->post('page_title'));
		$data = array(
			'cms_heading' => $this->input->post('page_title'),
			'cms_metatitle' => $this->input->post('meta_title'),
			'cms_metakey' => $this->input->post('meta_keyword'),
			'cms_metadesc' => $this->input->post('meta_description'),
			'cms_content' => $this->input->post('cms_content'),
			
			'cms_position' => $this->input->post('cms_position'),	
			
			'cms_title' => $seo_url,		
			'cms_status' =>  $this->input->post('cms_status')
		);
		$id =  $this->input->post('cms_id');
		$this->db->where('cms_id',$id);
		$upd = $this->db->update('tbl_cms',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}	
	}
	
	
	// delete cms..
	function deletecms($id){
		$this->db->connection_check();
		$this->db->delete('tbl_cms',array('cms_id' => $id));
		return true;
	
	}
	
	function deleteads($id){
		$this->db->connection_check();
		$this->db->delete('ads',array('ads_id' => $id));
		return true;
	}
	
	
	
	// get all faqs..
	function get_allfaqs(){
		$this->db->connection_check();
		$this->db->order_by('faq_id','desc');
		$allfaqs = $this->db->get('tbl_faq');
		if($allfaqs->num_rows > 0)
        {
            $row = $allfaqs->row();
            return $allfaqs->result();
        }
		else
		{
			return false;
		}
	}
	
	// add new faq..
	function addfaqs(){
		$this->db->connection_check();
		$data = array(
		'faq_qn' => $this->input->post('faq_qn'),
		'faq_ans' => $this->input->post('faq_ans'),
		'status' => '1'
		);
		
		$this->db->insert('tbl_faq',$data);
		return true;
	}
	// get particular faq
	function get_faqcontent($id){
		$this->db->connection_check();
		$this->db->where('faq_id',$id);
        $query = $this->db->get('tbl_faq');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $query->result();
        }
        return false;
	}
	
	// update faq details..
	function updatefaq(){
		$this->db->connection_check();
		$data = array(
			'faq_qn' => $this->input->post('faq_qn'),
			'faq_ans' => $this->input->post('faq_ans'),
			'status' =>  $this->input->post('status')
		);
		$id =  $this->input->post('faq_id');
		$this->db->where('faq_id',$id);
		$upd = $this->db->update('tbl_faq',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	// delete faq..
	function deletefaq($id)
	{
		$this->db->connection_check();
		$this->db->delete('tbl_faq',array('faq_id' => $id));
		return true;
	}
	
// view all users..
	function get_allusers()
	{
		$this->db->connection_check();
		$this->db->where('admin_status','');
		$this->db->order_by('date_added','desc');
		$user_query = $this->db->get('tbl_users');
		if($user_query->num_rows > 0)
        {
            $row = $user_query->row();
            return $user_query->result();
        }
		else
		{
			return false;
		}
	}
	// view user details
	function view_user($userid)
	{
		$this->db->connection_check();
		$this->db->where('user_id',$userid);        
        $query = $this->db->get('tbl_users');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
            return $query->result();
        }
        return false;
	}	
	// update user status..
	function userupdate()
	{
		$this->db->connection_check();
	$data = array(
		'status' => $this->input->post('status')
	);
	
		$user_id = $this->input->post('user_id');
		$this->db->where('user_id',$user_id);
		$upd = $this->db->update('tbl_users',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	// delete user details..
	function deleteuser($id)
	{
		$this->db->connection_check();
		$this->db->where('user_id',$id);        
        $query = $this->db->get('tbl_users');
		$email = $query->row('email');
		$data = array(
			'admin_status' => 'deleted',
			'status' =>  '0'
		);
		$this->db->where('user_id',$id);
		$upd = $this->db->update('tbl_users',$data);
		
		$this->db->delete('referrals',array('referral_email' => $email));            
		//$this->db->delete('tbl_users',array('user_id' => $id)); 
		return true;
	}
	
	// get country name
	function get_country($country)
	{
		$this->db->connection_check();	
		$this->db->where('id',$country);
		$res = $this->db->get('country');
		if($res->num_rows > 0){
			return $res->row();
		}
		return false;	
	}	
	// view all categories..
	function premium_categories()
	{	
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		
		 
		 $this->db->where('category_status',1);
		 	
		$result = $this->db->get('premium_categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	
	// view all categories..
	function categories(){
		$this->db->connection_check();
		$this->db->order_by('sort_order','desc');
		$this->db->where('category_status','1');
		$result = $this->db->get('categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	// add premium  category
	function addpremiumcategory()
	{	
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('premium_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$seo_url  = $this->admin_model->seoUrl($this->input->post('category_name'));
		$data = array(
		'category_name'=>$this->input->post('category_name'),
		'meta_keyword'=>$this->input->post('meta_keyword'),
		'meta_description'=>$this->input->post('meta_description'),
		'sort_order'=>$maxval,
		'category_status'=>$this->input->post('category_status'),
		'category_url'=>$seo_url
		);
		
		$this->db->insert('premium_categories',$data);
		return true;
	}	
	
	// add new category
	// add new category
	function addcategory($category_image,$category_icon){
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$seo_url  = $this->admin_model->seoUrl($this->input->post('category_name'));
		$data = array(
			'category_name'=>$this->input->post('category_name'),
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'sort_order'=>$maxval,
			'category_image'=>$category_image,
			'category_status'=>$this->input->post('category_status'),
			'top_category'=>$this->input->post('top_category'),
			'category_icon'=>$category_icon,
			'category_url'=>$seo_url
		);	
		$this->db->insert('categories',$data);
		return true;
	}	
	
	// edit category
	function get_category($category_id){
	$this->db->connection_check();
		$this->db->where('category_id',$category_id);
        $query = $this->db->get('categories');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $query->result();
        }
        return false;	
	}
	
	function get_premium_category($category_id){
		$this->db->connection_check();
		$this->db->where('category_id',$category_id);
        $query = $this->db->get('premium_categories');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $query->result();
        }
        return false;	
	}
	
	//update category
		function update_category($category_image,$category_icon)
		{
			$this->db->connection_check();
			$seo_url  = $this->admin_model->seoUrl($this->input->post('category_name'));
			$data = array(
			'category_name'=>$this->input->post('category_name'),
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'category_image'=>$category_image,
			'category_status'=>$this->input->post('category_status'),
			'top_category'=>$this->input->post('top_category'),
			'category_icon'=>$category_icon,
			'category_url'=>$seo_url
		);
		$id = $this->input->post('category_id');
		$this->db->where('category_id',$id);
		$upd = $this->db->update('categories',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	//update premium category
		function update_premium_category()
		{
		$this->db->connection_check();
		$seo_url  = $this->admin_model->seoUrl($this->input->post('category_name'));
			$data = array(
			'category_name'=>$this->input->post('category_name'),
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'category_status'=>$this->input->post('category_status'),
			'category_url'=>$seo_url
		);
		$id = $this->input->post('category_id');
		$this->db->where('category_id',$id);
		$upd = $this->db->update('premium_categories',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	// delete category
	function deletecategory($id)
	{
		$this->db->connection_check();	
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('categories',array('category_id'=>$id))->row('sort_order');
		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('categories',array('category_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;
			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('categories',$data);
		}
		return true;
	}
	
	// delete category
	function deletepremiumcategory($id)
	{
		$this->db->connection_check();
	
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('premium_categories',array('category_id'=>$id))->row('sort_order');
		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('premium_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('premium_categories',array('category_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;
			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('premium_categories',$data);
		}
		return true;
	}
	
	// view all affiliates
	function affiliates($type=null)
	{
		$this->db->connection_check();
		if($type!="")
		{
			$this->db->where('store_type',$type);
		}
	$this->db->order_by('affiliate_id','desc');
		$result = $this->db->get('affiliates');
		
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	// view all affiliates
	function active_affiliates()
	{
		$this->db->connection_check();
		$this->db->order_by('affiliate_id','desc');
		$this->db->where('affiliate_status',1);
		$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	// add new affiliates
	// add new affiliates
	function addaffiliate($logo, $ban,$sidebar_image=null)
	{
		$this->db->connection_check();
		$stcat = $this->input->post('categorys_list');
		
		
		if($this->input->post('categorys_list'))
		{
			$store_categorys =implode(",",$this->input->post('categorys_list'));
		}
		else
		{
			$store_categorys='';
		}
		$seo_url  = $this->admin_model->seoUrl($this->input->post('affiliate_name'));
		$data = array(
		'affiliate_name'=>$this->input->post('affiliate_name'),
		'affiliate_logo'=>$logo,
		
		/*'site_url' => $this->input->post('site_url'),*/
		'logo_url'=>$this->input->post('logo_url'),
		'affiliate_desc'=>$this->input->post('affiliate_desc'),
		'cashback_percentage'=>$this->input->post('cashback_percentage'),
		'meta_keyword'=>$this->input->post('meta_keyword'),
		'meta_description'=>$this->input->post('meta_description'),
		'featured'=>$this->input->post('featured'),
		'store_of_week'=>$this->input->post('store_of_week'),
		'affiliate_status'=>$this->input->post('affiliate_status'),
		'affiliate_cashback_type'=>$this->input->post('affiliate_cashback_type'),
		'retailer_ban_url'=>$this->input->post('retailer_ban_url'),	
		
		'how_to_get_this_offer'=>$this->input->post('how_to_get_this_offer'),				
		
		'terms_and_conditions'=>$this->input->post('terms_and_conditions'),		
		
		'sidebar_image_url'=>$this->input->post('sidebar_image_url'),
						
		'coupon_image'=>$ban,
		
		'sidebar_image'=>$sidebar_image,
		'affiliate_url'=>$seo_url,
		'store_categorys'=>$store_categorys
		);
		$this->db->insert('affiliates',$data);
		$store_id = $this->db->insert_id();
		$store_category_count	=	count($stcat);
		if($stcat!="")
		{
			foreach($stcat as $maincat)
			{
				$var="size_".$maincat;
				$subcat = $this->input->post($var);
				if($subcat)
				{
					foreach($subcat as $subcategory)
					{
						$data = array(
						'category_id'=>$maincat,
						'sub_category_id'=>$subcategory,
						'store_id'=>$store_id
						);
						$this->db->insert('tbl_store_sub_cate',$data);
					}
				}
			}
		}
		return true;
	}
	
	// view affiliate
	function get_affiliate($id)
	{
	$this->db->connection_check();	
	$this->db->where('affiliate_id',$id);
	$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->result();		
		}	
	}
	
	
	// update affiliate
	function updateaffiliate($logo,$banimg,$sidebar_image){
		$this->db->connection_check();
		$affiliate_id = $this->input->post('affiliate_id');
		
		if($this->input->post('categorys_list'))
		{	
		$stcat = $this->input->post('categorys_list');	
			$store_categorys =implode(",",$this->input->post('categorys_list'));
		}
		else
		{
			$stcat = '';	
			$store_categorys='';
		}
		$seo_url  = $this->admin_model->seoUrl($this->input->post('affiliate_name'));
		
		$this->db->delete('tbl_store_sub_cate',array('store_id' => $affiliate_id));
		
		$data = array(
			'affiliate_name'=>$this->input->post('affiliate_name'),
			'affiliate_logo'=>$logo,
			'logo_url'=>$this->input->post('logo_url'),
			
			//'site_url' => $this->input->post('site_url'),
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'affiliate_desc'=>$this->input->post('affiliate_desc'),
			'cashback_percentage'=>$this->input->post('cashback_percentage'),
			'featured'=>$this->input->post('featured'),
			'store_of_week'=>$this->input->post('store_of_week'),
			'affiliate_status'=>$this->input->post('affiliate_status'),
			'affiliate_cashback_type'=>$this->input->post('affiliate_cashback_type'),
			
			'retailer_ban_url'=>$this->input->post('retailer_ban_url'),
			'how_to_get_this_offer'=>$this->input->post('how_to_get_this_offer'),				
			
			'terms_and_conditions'=>$this->input->post('terms_and_conditions'),		
			
			'sidebar_image_url'=>$this->input->post('sidebar_image_url'),		
			
			'affiliate_url'=>$seo_url,
			'coupon_image'=>$banimg,
			
			'sidebar_image'=>$sidebar_image,
			'store_categorys'=>$store_categorys
		);
		
		$this->db->where('affiliate_id',$affiliate_id);
		$updation = $this->db->update('affiliates',$data);
		$store_id= $affiliate_id;
		if($updation!="" )
		{
			if($stcat!='')
			{
				foreach($stcat as $maincat)
				{
					$var="size_".$maincat;
					$subcat = $this->input->post($var);
					if($subcat)
					{
						foreach($subcat as $subcategory)
						{
							$data = array(
							'category_id'=>$maincat,
							'sub_category_id'=>$subcategory,
							'store_id'=>$store_id
							);
							$this->db->insert('tbl_store_sub_cate',$data);
						}
					}
				}
			}
		
			return true;
		}
		else 
		{ 
			return false;   
		}
	//	return true;
	}
	
	// delete affiliate
	function deleteaffiliate($id){
	$this->db->connection_check();
		$this->db->delete('affiliates',array('affiliate_id' => $id));
		$this->db->delete('tbl_store_sub_cate',array('store_id' => $id));
		
		$this->db->delete('click_history',array('affiliate_id' => $id));
		
		return true;	
	}
	
	//view all banners
	function banners(){
		$this->db->connection_check();
		$this->db->order_by('banner_id','desc');
		$banners = $this->db->get('tbl_banners');
		if($banners->num_rows > 0){
			return $banners->result();		
		}
		return false;
	}
	
	// add banner
	function addbanner($img){
	$this->db->connection_check();
		$data = array(
			'banner_heading'=>$this->input->post('banner_name'),
			'banner_image'=>$img,
			'banner_url'=>$this->input->post('banner_url'),
			'banner_position'=>$this->input->post('banner_position'),
			'banner_status'=>$this->input->post('banner_status')
		);
	
		$this->db->insert('tbl_banners',$data);
		return true;
	}
	
	//edit banner
	function get_banner($id){
	$this->db->connection_check();
		$this->db->where('banner_id',$id);
		$banner = $this->db->get('tbl_banners');
		if($banner->num_rows > 0){
			return $banner->result();
		}
		return false;
	}
	
	// update banner
	function updatebanner($img){
	$this->db->connection_check();
	$banner_id = $this->input->post('banner_id');
	$data = array(
		'banner_heading'=>$this->input->post('banner_name'),
		'banner_image'=>$img,
		'banner_url'=>$this->input->post('banner_url'),
		'banner_position'=>$this->input->post('banner_position'),
		'banner_status'=>$this->input->post('banner_status')		
	);
	
	$this->db->where('banner_id',$banner_id);
	$update = $this->db->update('tbl_banners',$data);
		if($update!="")
		{
			return true;
		}
		else 
		{ 
			return false;   
		}
	}
	
	// delete banner
	function deletebanner($delete){ 
		$this->db->connection_check();
		$this->db->delete('tbl_banners',array('banner_id' => $delete));
		return true;
	}
	
	// view all subscribers
	function subscribers(){	
		$this->db->connection_check();
                $this->db->order_by('subscriber_id','desc');
		$all = $this->db->get('subscribers');
		if($all->num_rows > 0) {
			return $all->result();
		}
		return false;
	}
	// delete subscriber
	function deletesubscriber($id){
		$this->db->connection_check();
		$this->db->delete('subscribers',array('subscriber_id' => $id));
		return true;
	}
	
	
	function send_mail(){
	$this->db->connection_check();
		// $this->load->library('email');
		
		// get admin email
		$admin_email = $this->db->get_where('admin', array(
			'admin_id'=>'1'
		))->row('admin_email');
		
		$to_users = $this->input->post('to');
		
		if($to_users=="users"){
			$users = $this->db->get('tbl_users');
			$results = $users->result();
			$emails='';
			foreach($results as $get){
				$emails .= $get->email.',';
			}
			$emails = rtrim($emails,',');
			// echo $emails;
		} else if($to_users=="subscribers"){
			$subscribers = $this->db->get('subscribers');
			$results = $subscribers->result();
			$emails='';
			foreach($results as $get){
				$emails .= $get->subscriber_email.',';
			}
			$emails = rtrim($emails,',');
			
		}
		$subject_new = $this->input->post('subject');
		$content_pop = $this->input->post('message');
		$user_email = $emails;
		// echo $user_email;die;
		$mail_function = $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
		/*$config = Array(
					 'mailtype'  => 'html',
					  'charset'   => 'utf-8',
					  );
		$this->email->initialize($config);
		$this->email->from($admin_email);
		$this->email->to("");
		$this->email->bcc($emails);
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->input->post('message')); */
		return true;
		
		/*if($mail_function)
        {
        	echo 'dfhdjkf';die;
           return true;
        }
		else
		{
            
			 return false;
        }*/
	}
	
	//get email template content..
	function get_email_template($id){
		$this->db->connection_check();
		$this->db->where('mail_id',$id);
		$mail_template = $this->db->get('tbl_mailtemplates');
		if($mail_template->num_rows > 0){
			return $mail_template->result();
		}
		return false;	
	}
	
	// update template
	function update_email_template(){
		$this->db->connection_check();
		$mail_id = $this->input->post('mail_id');
			
		$data = array(
			'email_subject'=>$this->input->post('email_subject'),
			'email_template'=>$this->input->post('email_template')			
		);
		
		$this->db->where('mail_id',$mail_id);
		$update = $this->db->update('tbl_mailtemplates',$data);
		if($update!="")
		{
			return true;
		}
		else 
		{ 
			return false;   
		}	
	}
	
	// all referrals
	function referrals(){
		$this->db->connection_check();
		$this->db->group_by('user_id');
		$referrals = $this->db->get('referrals');
		if($referrals->num_rows > 0)
        {
           return $referrals->result();
        }
		else
		{
			return false;
		}
	}
	
	// total count for referral
	function referral_count($email){
		$this->db->connection_check();
		$this->db->where('user_email',$email);
		$count = $this->db->get('referrals');
		return $count->num_rows();
	}	
	
	// delete referral by user id
	function deletereferral($user_id){
		$this->db->connection_check();
		$this->db->delete('referrals',array('user_id'=>$user_id));
		return true;
	}
	
	// view all coupons..
	function coupons($store_name=null,$perpage,$urisegment){
		$this->db->connection_check();
		$this->db->limit($perpage,$urisegment);
		$this->db->order_by("coupon_id", "desc");
		if($store_name!='all')
		{
			$this->db->like('offer_name', $store_name);	
		}
		$this->db->where('coupon_status', '1');
		$this->db->where('coupon_type','');
		$result = $this->db->get('coupons');
		//echo $this->db->last_query();die;
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	} 
	function count_couponsactive()
	{
		$count = $this->db->select('coupon_id')->from(' coupons')->count_all_results();
		return $count;
	}
	
	//bulk coupon action..
	function bulkcoupon($bulkcoupon){
	  	$this->db->connection_check();
	    // delete all the previously added coupons of the coupon type (vcommission/icubewire)
		// $coupon_type = $this->input->post('coupon_type');
		$coupon_type = '';
		//$this->db->delete('coupons',array('coupon_type'=>$coupon_type));
		//$this->db->truncate('coupons');
		/*$this->db->delete('coupons');*/
		$this->load->library('CSVReader');
		$main_url = 'uploads/coupon/'.$bulkcoupon;
	 	$result =   $this->csvreader->parse_file($main_url);
		if(count($result)!=0)
		{
			
			foreach($result as $res)
			{
				
				$strdate = date('m/d/Y',strtotime($res['start_date(m/d/Year)']));
				
				$exp = date('m/d/Y',strtotime($res['Expiry']));
				$offer_url = $res['Offer Page  ( Ctrl C to copy )'];
				$Offer_Name = $this->db->escape_str($res['Offer Name']);
				$Title = $this->db->escape_str($res['Title']);
				$Description = $this->db->escape_str($res['Description']);
                                $category_name = $this->db->escape_str($res['category_name']);
				$Type = $res['Type'];
				$Code = $res['Code'];
				$start_date = $strdate;
				$Expiry = $exp;
				
				$Coupon_featured = $res['Coupon_featured'];
				/*$Featured = $res['Featured ( 0 or 1)'];
				$Exclusive = $res['Exclusive (0 or 1)'];*/
				$traking_param = $res['Tracking Extra parameter'];	

                                //Add new store name
				$this->db->where('affiliate_name',$Offer_Name);
				$aff = $this->db->get('affiliates');
				if($aff->num_rows()==0){
					$data = array(
						'affiliate_name' => $Offer_Name,
						'affiliate_url' => $offer_url,
						'affiliate_status' => '1',
					);
					$this->db->insert('affiliates',$data);
					$new_store_id = $this->db->insert_id();
				}else{
					$result = $aff->row();
					$new_store_id = $result->affiliate_id;
				}
                                 
				$results = $this->db->query("INSERT INTO `coupons` (`offer_name`, `title`, `description`, `category_name`,`type`, `code`, `offer_page`, `start_date`, `expiry_date`, `coupon_options`, `Tracking`,`coupon_status`) VALUES ('$Offer_Name', '$Title', '$Description', '$category_name','$Type', '$Code', '$offer_url', '$start_date', '$Expiry', '$Coupon_featured', '$traking_param','1');");
			}
		}
		
		
		return true;
	}

	
	// add new coupon..
	function addcoupon(){
		$this->db->connection_check();
		$start_date = $this->input->post('start_date');
		
		
		$expiry_date =$this->input->post('expiry_date');
		
				
		$data = array(
			'offer_name'=>$this->input->post('offer_name'),
                        'category_name'=>$this->input->post('category_name'),
			'title'=>$this->input->post('title'),
			'description'=>$this->input->post('description'),
			'type'=>$this->input->post('type'),
			'code'=>$this->input->post('code'),
			'offer_page'=>$this->input->post('offer_page'),
			'expiry_date'=>$expiry_date,
			'start_date'=>$start_date,
			'featured'=>$this->input->post('featured'),
			'exclusive'=>$this->input->post('exclusive'),
			'Tracking'=>$this->input->post('Tracking'),			
			'coupon_options'=>$this->input->post('coupon_options'),
			'coupon_status'=>'1',
			'cashback_description'=>$this->input->post('cashback_description')
			
			
			
		);
		$this->db->insert('coupons',$data);
		return true;	
	}
	
	// view coupon..	
	function editcoupon($coupon_id){
		$this->db->connection_check();
		$this->db->where('coupon_id',$coupon_id);
		$this->db->where('coupon_status','1');
		$coupons = $this->db->get('coupons');
		if($coupons->num_rows > 0){
			return $coupons->result();
		}
		return false;
	}
	
	// update coupon details..
	function updatecoupon() {
		$this->db->connection_check();
			$start_date = $this->input->post('start_date');
		
		$expiry_date = date('Y-m-d',strtotime($this->input->post('expiry_date')));
		$coupon_id = $this->input->post('coupon_id');
		$data = array(
			'offer_name'=>$this->input->post('offer_name'),
                        'category_name'=>$this->input->post('category_name'),
			'title'=>$this->input->post('title'),
			'description'=>$this->input->post('description'),
			'type'=>$this->input->post('type'),
			'code'=>$this->input->post('code'),
			'offer_page'=>$this->input->post('offer_page'),
			'expiry_date'=>$expiry_date,
			'start_date'=>$start_date,
			'featured'=>$this->input->post('featured'),
			'exclusive'=>$this->input->post('exclusive'),
			'Tracking'=>$this->input->post('Tracking'),
			
			'coupon_options'=>$this->input->post('coupon_options'),
			
			'cashback_description'=>$this->input->post('cashback_description')
		);
		$this->db->where('coupon_id',$coupon_id);
		$this->db->where('coupon_status','1');
		$updation = $this->db->update('coupons',$data);
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}
	}		
	
	// delete coupon..
	function deletecoupon($delete_id){
		$this->db->connection_check();
		$this->db->delete('coupons',array('coupon_id'=>$delete_id,'coupon_status'=>'1'));
		return true;	
	}	
	
	// view all shopping coupons..
	function shoppingcoupons(){
		$this->db->connection_check();
	//expiry_date >='".date('Y-m-d')."' 
	 $selqry="SELECT * FROM shopping_coupons  WHERE expiry_date >='".date('Y-m-d')."' order by shoppingcoupon_id desc";   
	 
	//$result = $this->db->get('shopping_coupons');
	
	 $result=$this->db->query("$selqry"); 
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	function exp_shoppingcoupons(){
	$this->db->connection_check();
	//expiry_date >='".date('Y-m-d')."' 
	 $selqry="SELECT * FROM shopping_coupons  WHERE expiry_date <='".date('Y-m-d')."' order by shoppingcoupon_id desc";   	 
	//$result = $this->db->get('shopping_coupons');
	
	 $result=$this->db->query("$selqry"); 
	//$result = $this->db->get('shopping_coupons');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	// add new shopping coupon..
	
	// edit shopping coupon
	function edit_shoppingcoupon($coupon_id){
	$this->db->connection_check();
	$this->db->where('shoppingcoupon_id',$coupon_id);
		$coupons = $this->db->get('shopping_coupons');
		if($coupons->num_rows > 0){
			return $coupons->result();
		}
		return false;	
	}
	
	// update shopping coupon details..	
	
	// delete shopping coupon..
	function delete_shoppingcoupon($delete_id){
	$this->db->connection_check();
		$this->db->delete('shopping_coupons',array('shoppingcoupon_id'=>$delete_id));
		return true;
	}	
	// view user email	
	function user_email($user_id){
		$this->db->connection_check();
		$result = $this->db->get_where('tbl_users',array('user_id'=>$user_id))->row('email');
		return $result;	
	}
	
	// view store name
	function view_store($affiliate_id){
		$this->db->connection_check();
		$result = $this->db->get_where('affiliates',array('affiliate_id'=>$affiliate_id))->row('affiliate_name');
		return $result;
	}
	
	// get promo id
	function view_promo($coupon_id){
		$this->db->connection_check();
		$result = $this->db->get_where('coupons',array('coupon_id'=>$coupon_id))->row('promo_id');
		return $result;
	}
	
	// get cashback % from store..
	function get_fromstore($affiliate_id){
		$this->db->connection_check();
		$result = $this->db->get_where('affiliates',array('affiliate_id'=>$affiliate_id))->row('cashback_percentage');
		return $result;	
	}
	
	// view all cashback details
	function cashback(){
		$this->db->connection_check();
		$this->db->order_by('date_added','desc');
		$result = $this->db->get('cashback');
		if($result->num_rows > 0){
	
			return $result->result();
		}
		return false;
	}
	
	// get cashback details
	function cashback_details($id){
		$this->db->connection_check();
		$this->db->where('cashback_id',$id);
		$result = $this->db->get('cashback');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	// update cashback status..
	function updatecashback($id){
		$this->db->connection_check();
		$current_status = $this->input->post('current_status');
			$data = array(
				'status'=>$current_status
			);
		$this->db->where('cashback_id',$id);
		$updation = $this->db->update('cashback',$data);
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}
	}
	
	// delete cashback details..
	function deletecashback($id){
			$this->db->connection_check();
		$txn_id = $this->db->get_where('cashback',array('cashback_id'=>$id))->row('txn_id');
		$this->db->delete('cashback',array('cashback_id'=>$id));
		$this->db->delete('transation_details',array('trans_id'=>$txn_id));
		return true;
	}
	// view balance..
	function view_balance($user_id){
		$this->db->connection_check();
		$balace = $this->db->get_where('tbl_users',array('user_id'=>$user_id))->row('balance');
		return $balace;
	}
	// withdraw ..
	function withdraw(){
		$this->db->connection_check();
	$this->db->order_by('withdraw_id','desc');
		$result = $this->db->get('withdraw');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;	
	}
	
	// view withdraw details..
	function editwithdraw($id){
		$this->db->connection_check();
		$this->db->where('withdraw_id',$id);
		$result = $this->db->get('withdraw');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}	
	
	// update withdraw status..
	function updatewithdraw($id){
		$this->db->connection_check();
		$current_status = $this->input->post('current_status');
		$date = date('Y-m-d');
		if($current_status=='Completed'){
			$this->db->where('withdraw_id',$id);
			$fetch_with_1 = $this->db->get('withdraw');
			$fetch_with = $fetch_with_1->row();
			$requested_amount = $fetch_with->requested_amount;
			$user_id = $fetch_with->user_id;
			$data_txn = array(		
				'transation_reason' => "Withdraw money",
				'transation_amount' => $requested_amount,
				'mode' => "debited",
				'transation_status' => "Paid",
				'transation_date' => date('Y-m-d'),
				'user_id' => $user_id
			);
			$this->db->insert('transation_details',$data_txn);
			$data = array(
				'closing_date'=>$date,
				'status'=>$current_status
			);
		} else {
			$data = array(
				'status'=>$current_status
			);
		}
		$this->db->where('withdraw_id',$id);
		$updation = $this->db->update('withdraw',$data);
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}
	}
	
	// deleting withdraw..
	function deletewithdraw($id){
		$this->db->connection_check();
		$this->db->delete('withdraw',array('withdraw_id'=>$id));
		return true;
	}
	
	// to check the user is referral..
	function check_refer($email){
		$this->db->connection_check();
		$this->db->where('referral_email',$email);
		$refer = $this->db->get('referrals');
		// print_r($refer->num_rows());
		return $refer->num_rows();
	}
	
	// to fetch the code and amount using shoppingcoupon_id..
	function get_allcoupons($id){
		$this->db->connection_check();
		$this->db->where('shoppingcoupon_id',$id);
		$results = $this->db->get('shoppingcodes');
		if($results->num_rows > 0){
			return $results->result();
		}
		return false;
	}
	
	//  removes code on editing premium coupon..
	function delete_shopcoupon($ids){
	$this->db->connection_check();
		$this->db->delete('shoppingcodes',array('shoppingcode_id'=>$ids));
		return true;
	}
	
	// change  category order..
	function change_cate_order($old_order,$new_order){
		$this->db->connection_check();
		// fetching category id using sort_order id..
		$old_category = $this->db->get_where('categories',array('sort_order'=>$old_order))->row('category_id');
		$new_category = $this->db->get_where('categories',array('sort_order'=>$new_order))->row('category_id');
		
		$data1 = array('sort_order'=>$new_order);
		$this->db->where('category_id',$old_category);
		$this->db->update('categories',$data1);
		
		$data2 = array('sort_order'=>$old_order);
		$this->db->where('category_id',$new_category);
		$updation = $this->db->update('categories',$data2);
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}		
	}
	
	// change  premium category order..
	function change_premium_cate_order($old_order,$new_order)
	{	
		$this->db->connection_check();
		// fetching category id using sort_order id..
		$old_category = $this->db->get_where('premium_categories',array('sort_order'=>$old_order))->row('category_id');
		$new_category = $this->db->get_where('premium_categories',array('sort_order'=>$new_order))->row('category_id');
		
		$data1 = array('sort_order'=>$new_order);
		$this->db->where('category_id',$old_category);
		$this->db->update('premium_categories',$data1);
		
		$data2 = array('sort_order'=>$old_order);
		$this->db->where('category_id',$new_category);
		$updation = $this->db->update('premium_categories',$data2);
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}		
	}
	
	// get maximum category order..
	function get_maxcategory(){
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('categories');
		return $get_max->result();
	}
	
	// get overall count for shopping coupon code..
	function get_countshopcoupon($shopping_id){
		$this->db->connection_check();
		//$this->db->where('shoppingcoupon_id',$shopping_id);
		
		$result = $this->db->query("SELECT LENGTH(coupon_code) - LENGTH(REPLACE(coupon_code, ',', '')) as counting FROM `shopping_coupons` where shoppingcoupon_id=".$shopping_id);
		//$result = $this->db->get('shoppingcodes');
		if($result->num_rows > 0){
			return $result->row()->counting;
		}
		return false;
	}
	
	// get all referral emails..
	function all_referrals($email){
		$this->db->connection_check();
	$this->db->order_by('referral_id','desc');
		$this->db->where('user_email',$email);
		$referrals = $this->db->get('referrals');
		if($referrals->num_rows > 0){
			return $referrals->result();
		}
		return false;
	}
	
	// get all click history..
	function click_history($userid=null){
		$this->db->connection_check();
		if($userid!='')
		{
			if(is_numeric($userid))
			{
				$this->db->where('user_id',$userid);
			}
			else
			{
				$this->db->where('store_name',$userid);
			}
		}
		/*if($store_name!="")
		{
			$this->db->where('store_name',$store_name);
		}*/
		$this->db->order_by('click_id','desc');
		$all = $this->db->get('click_history');
		if($all->num_rows > 0){
			return $all->result();
		}
		return false;
	}
	
	// delete click history..
	function deletehistory($id){
		$this->db->connection_check();
		$this->db->delete('click_history',array('click_id'=>$id));
		return true;
	}
	
	//delete cashback
	function deletecashbackdetails($id){
		$this->db->connection_check();
		$this->db->delete('category_cashback',array('cbid'=>$id));
		return true;
	}
	
	//nathan
	
	// view all categories..
	function sub_categories($cateid){
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('cate_id',$cateid);
		$result = $this->db->get('sub_categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	// view all premium categories..
	function premium_sub_categories($cateid){
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('cate_id',$cateid);
		$result = $this->db->get('premium_sub_categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	// view cat name from id..
	function get_category_name($cateid){
		$this->db->connection_check();
		$this->db->where('category_id',$cateid);
		$result = $this->db->get('categories');
		if($result->num_rows > 0){
			return $result->row('category_name');	
		}
			return false;
	}
	// view cat name from id..
	function get_premium_category_name($cateid){
		$this->db->connection_check();
		$this->db->where('category_id',$cateid);
		$result = $this->db->get('premium_categories');
		if($result->num_rows > 0){
			return $result->row('category_name');	
		}
			return false;
	}
	// view sub cat name from id..
	function get_sub_category_name($sub_cateid){
		$this->db->connection_check();
		$this->db->where('sun_category_id',$sub_cateid);
		$result = $this->db->get('sub_categories');
		if($result->num_rows > 0){
			return $result->result('sub_category_name');	
		}
			return false;
	}
	
	// add new category
	function addsubcategory(){
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('sub_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$seo_url  = $this->admin_model->seoUrl($this->input->post('sub_category_name'));
		
		$data = array(
		'sub_category_name'=>$this->input->post('sub_category_name'),
		'cate_id'=>$this->input->post('cate_id'),
		'meta_keyword'=>$this->input->post('meta_keyword'),
		'meta_description'=>$this->input->post('meta_description'),
		'sort_order'=>1,
		'category_status'=>$this->input->post('category_status'),
		'sub_category_url'=> $seo_url
		);
		
		$this->db->insert('sub_categories',$data);
		return true;
	}		
	
	// add new premium category
	function addpremiumsubcategory(){
	/*print_r($this->input->post());
	exit;*/
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('premium_sub_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$seo_url  = $this->admin_model->seoUrl($this->input->post('sub_category_name'));
		
		$data = array(
		'sub_category_name'=>$this->input->post('sub_category_name'),
		'cate_id'=>$this->input->post('cate_id'),
		'meta_keyword'=>$this->input->post('meta_keyword'),
		'meta_description'=>$this->input->post('meta_description'),
		'sort_order'=>1,
		'category_status'=>$this->input->post('category_status'),
		'sub_category_url'=> $seo_url
		);
		
		$this->db->insert('premium_sub_categories',$data);
		return true;
	}		
	
	
	// edit category
	function get_subcategory($category_id){
		$this->db->connection_check();
		$this->db->where('sun_category_id',$category_id);
        $query = $this->db->get('sub_categories');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $query->result();
        }
        return false;	
	}
	
	// edit category
	function get_premium_subcategory($category_id){
		$this->db->connection_check();
		$this->db->where('sun_category_id',$category_id);
        $query = $this->db->get('premium_sub_categories');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $query->result();
        }
        return false;	
	}
	
	//update category
	function update_subcategory(){
			$this->db->connection_check();
	$seo_url  = $this->admin_model->seoUrl($this->input->post('sub_category_name'));
		$data = array(
			'cate_id'=>$this->input->post('cate_id'),
			'sub_category_name'=>$this->input->post('sub_category_name'),
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'category_status'=>$this->input->post('category_status'),
			'sub_category_url'=>$seo_url
		);
		$id = $this->input->post('sun_category_id');
		$this->db->where('sun_category_id',$id);
		$upd = $this->db->update('sub_categories',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	//update category
	function update_permiumsubcategory(){
	$this->db->connection_check();
	$seo_url  = $this->admin_model->seoUrl($this->input->post('sub_category_name'));
		$data = array(
			'cate_id'=>$this->input->post('cate_id'),
			'sub_category_name'=>$this->input->post('sub_category_name'),
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'category_status'=>$this->input->post('category_status'),
			'sub_category_url'=>$seo_url
		);
		$id = $this->input->post('sun_category_id');
		$this->db->where('sun_category_id',$id);
		$upd = $this->db->update('premium_sub_categories',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	// delete category
	function deletesubcategory($id){
		$this->db->connection_check();
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('sub_categories',array('sun_category_id'=>$id))->row('sort_order');
		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('sub_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('sub_categories',array('sun_category_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;
			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('sub_categories',$data);
		}
		return true;
	}
	
	// delete category
	function deletepremiumsubcategory($id){
		$this->db->connection_check();
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('premium_sub_categories',array('sun_category_id'=>$id))->row('sort_order');
		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('sub_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('premium_sub_categories',array('sun_category_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('premium_sub_categories',$data);
		}
		return true;
	}
	
	
	function seoUrl($string) {
		$this->db->connection_check();
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	
	function get_updated_categories($cateid,$maincateid)
	{
		$this->db->connection_check();
		$this->db->where('category_id',$maincateid);
		$this->db->where('store_id',$cateid);
        $query = $this->db->get('tbl_store_sub_cate');
        if($query->num_rows >= 1)
		{
           return $query->result();
        }
        return false;	
	}
	
	function get_premium_updated_categories($cateid,$maincateid)
	{
		$this->db->connection_check();
		$this->db->where('category_id',$maincateid);
		$this->db->where('store_id',$cateid);
        $query = $this->db->get('tbl_premium_sub_cate');
        if($query->num_rows >= 1)
		{
           return $query->result();
        }
        return false;	
	}
	
	// view all affiliates
	function site_affiliates(){
		$this->db->connection_check();
		$this->db->order_by('affiliate_id','desc');
		$result = $this->db->get('providers');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	// add new affiliates
	// add new affiliates
	function site_addaffiliate(){
		$this->db->connection_check();
		$data = array(
		'affiliate_name'=>$this->input->post('affiliate_name'),
		'affiliate_type'=>$this->input->post('affiliate_type'),
		'affiliate_status'=>$this->input->post('affiliate_status'),
		'affiliate_param'=>$this->input->post('affiliate_param'),
		'affiliate_traking_param'=>$this->input->post('affiliate_traking_param'),
		'aff_url'=>$this->input->post('aff_url'),
		'affiliate_traking_param2'=>$this->input->post('affiliate_traking_param2')		
		);
		$this->db->insert('providers',$data);		
		return true;
	}
	
	// view affiliate
	function site_get_affiliate($id){
	$this->db->connection_check();
	$this->db->where('affiliate_id',$id);
	$result = $this->db->get('providers');
		if($result->num_rows > 0){
			return $result->result();		
		}	
	}
	
	
	function site_get_store($id){
	$this->db->connection_check();
	$this->db->where('affiliate_id',$id);
	$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->row();		
		}	
	}
	
	
	
	
	
	// update affiliate
	function site_updateaffiliate(){
		$this->db->connection_check();
		
		$affiliate_id = $this->input->post('affiliate_id');
		$data = array(
			'affiliate_name'=>$this->input->post('affiliate_name'),
			'affiliate_type'=>$this->input->post('affiliate_type'),
			'affiliate_status'=>$this->input->post('affiliate_status'),
			'affiliate_traking_param'=>$this->input->post('affiliate_traking_param'),
			'affiliate_traking_param2'=>$this->input->post('affiliate_traking_param2'),
			'aff_url'=>$this->input->post('aff_url'),
			'affiliate_param'=>$this->input->post('affiliate_param')
		
		);
		
		$this->db->where('affiliate_id',$affiliate_id);
		$updation = $this->db->update('providers',$data);
		return true;	
	}
	
	// delete affiliate
	function site_deleteaffiliate($id)
	{	
		$this->db->connection_check();
		$this->db->delete('providers',array('affiliate_id' => $id));
		return true;	
	}
	
	/************ Dec 11th *************/
	
	// view all cashbcak..
	function get_all_missing_cashback(){
		$this->db->connection_check();
		$this->db->order_by('cashback_id','desc');
		$this->db->order_by('status','desc');
		$user_query = $this->db->get('missing_cashback');
		if($user_query->num_rows > 0)
        {
            return $user_query->result();
        }
		else
		{
			return false;
		}
	}
	
	function view_missing_cb($cbid)
	{
		$this->db->connection_check();
		$this->db->where('cashback_id',$cbid);        
        $query = $this->db->get('missing_cashback');
        if($query->num_rows >= 1)
		{
          return  $row = $query->row();
           // return $query->result();
        }
        return false;
	}
	
	
	
	// update user status..
	function missiing_cashback_update()
	{
		$name = $this->db->query("select * from admin")->row();
				$site_name  = $name->site_name;
				
		$this->db->connection_check();
		 $curr_status = $this->input->post('status');	
		 $cashback_id = $this->input->post('cashback_id');
		 $username = $this->input->post('username');
		 $us_email = $this->input->post('us_email');	
		$ticket_id = $this->input->post('ticket_id');
		$retailer_name = $this->input->post('retailer_name');
		$cancel_reason = $this->input->post('cancel_reason');
		$Cashback_Return_Amount = $this->input->post('Cashback_Return_Amount');
		$user_id = $this->input->post('user_id');
		switch($curr_status)
		{
			case 0:
				$userbalance = $this->user_balance($user_id);
				$new_balnce = $userbalance+$Cashback_Return_Amount;
				$mode = "Credited";
				$transation_reason = 'Cashback';
				$details_id = $this->input->post('cashback_id');
				$this->update_users_balance($user_id,$Cashback_Return_Amount,$mode,$new_balnce,$transation_reason,$details_id,'missing_cashback');				
				$current_msg = '<span style="font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:14px;line-height:22px;font-style:normal"> Dear '.$username.',<br><br>Thank you for sending us the details of your transaction. Your Missing Cashback Ticket: '.$ticket_id.' has been Completed Successfully. Your Cashback Amount Added into your Account.<