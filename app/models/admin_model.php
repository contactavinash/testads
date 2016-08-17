
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
	function get_allusers($count)
	{
		if($count==0 & $count!='')
		{
			
			$date=date('Y-m-d');
			$this->db->where('DATE(date_added)',$date);
			$this->db->where('status',1);
		}
		else if($count==1)
		{
			$date=date('Y-m-d',strtotime('-'.$count.' days'));
			$this->db->where('DATE(date_added)=',$date);
			$this->db->where('status',1);
		}
		else if($count>1)
		{
			$date=date('Y-m-d',strtotime('-'.$count.' days'));
			$this->db->where('DATE(date_added)>=',$date);
			$this->db->where('status',1);
		}
		else
		{
			
		}
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
		if($logo!='')
		{
			$logo=$logo;
		}
		else
		{
			$logo=$this->input->post('affiliate_logo_hid');
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
		$content_pop = $this->input->post('message');
		$mail_temp = $this->db->query("select * from tbl_mailtemplates where mail_id='5'")->row();
				$fe_cont = $mail_temp->email_template;
				$name = $this->db->query("select * from admin")->row();
				$subject = "Your Missing Ticket Reply";
				
				$site_logo = $name->site_logo;
				$site_name  = $name->site_name;
				$contact_number = $name->contact_number;
				$servername = base_url();
				$nows = date('Y-m-d');	
				// $this->load->library('email');
				$gd_api=array(
							'###ADMINNO###'=>$contact_number,
							'###EMAIL###'=>'User',
							'###DATE###'=>$nows,
							'###CONTENT###'=>$content_pop,
							'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
							'###SITENAME###' =>$site_name
							);
						   
				$gd_message=strtr($fe_cont,$gd_api);
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
		
		$user_email = $emails;
		// echo $user_email;die;
		$mail_function = $this->mail_function($admin_email,$user_email,$subject_new,$gd_message);
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
								
								
								$this->db->select('category_id');
								$this->db->where('category_name',$category_name);
								$query=$this->db->get('categories');
								
								if($query->num_rows()>0)
								{
									
									 $category_name=$query->row('category_id');
								}
								else
								{
									$category_name='';
								}
								
								
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
				$current_msg = '<span style="font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:14px;line-height:22px;font-style:normal"> Dear '.$username.',<br><br>Thank you for sending us the details of your transaction. Your Missing Cashback Ticket: '.$ticket_id.' has been Completed Successfully. Your Cashback Amount Added into your Account.<br><br>Please let us know if you have any further queries. Thaks For your business.<br><br> Current Status: Completed<br><br> Warm regards,<br> '.$site_name.' Team</span>';
			break;
			case 1:
			$current_msg = '<span style="font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:14px;line-height:22px;font-style:normal"> Dear '.$username.',<br><br>Thank you for sending us the details of your transaction. Your Missing Cashback Ticket: '.$ticket_id.' has been Cancelled for the Following reason.<br><br>'.$cancel_reason.'<br><br>Please let us know if you have any further queries. Thaks For your business.<br><br> Current Status: Cancelled<br><br> Warm regards,<br> '.$site_name.' Team</span>';
			break;
			case 2:
				$current_msg = '<span style="font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:14px;line-height:22px;font-style:normal"> Dear '.$username.',<br><br>Thank you for sending us the details of your transaction. Your Missing Cashback Ticket: '.$ticket_id.' has been submitted to '.$retailer_name.'. Normally it takes up to 30-45 days to get a Missing Cashback Ticket resolved.<br><br>Please let us know if you have any further queries. We apologise for any inconvenience caused.<br><br> Current Status: Sent to retailer<br><br> Warm regards,<br> '.$site_name.' Team</span>';
			break;
			case 3:
				$current_msg ="";
			break;
			
		}
		$data = array(
			'status'=>$this->input->post('status'),
			'status_update_date'=>$this->input->post('status_update_date'),
			'cancel_msg'=>$this->input->post('cancel_msg'),
			'current_msg'=>$current_msg,
		);	
		$cashback_id = $this->input->post('cashback_id');
		$this->db->where('cashback_id',$cashback_id);
		$upd = $this->db->update('missing_cashback',$data);
		if($upd)
		{
			if($curr_status!=3)
			{
				$mail_temp = $this->db->query("select * from tbl_mailtemplates where mail_id='5'")->row();
				$fe_cont = $mail_temp->email_template;
				$name = $this->db->query("select * from admin")->row();
				$subject = "Your Missing Ticket Reply";
				$admin_emailid = $name->admin_email;
				$site_logo = $name->site_logo;
				$site_name  = $name->site_name;
				$contact_number = $name->contact_number;
				$servername = base_url();
				$nows = date('Y-m-d');	
				// $this->load->library('email');
				$gd_api=array(
							'###ADMINNO###'=>$contact_number,
							'###EMAIL###'=>$username,
							'###DATE###'=>$nows,
							'###CONTENT###'=>$current_msg,
							'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
							'###SITENAME###' =>$site_name
							);
						   
				$gd_message=strtr($fe_cont,$gd_api);
				//echo $gd_message;
				
				/*$config['protocol'] = 'sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;*/
				
				/*$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'vivek.developer@osiztechnologies.com',
				'smtp_pass' => 'iamnotlosero',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
				);*/
				/*$config = Array(
					 'mailtype'  => 'html',
					  'charset'   => 'utf-8',
					  );*/
				$list = array($us_email);
				
				/*$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from($admin_emailid);
				$this->email->to($list);
				$this->email->subject($subject);
				$this->email->message($gd_message);
				$this->email->send();
				$this->email->print_debugger();*/
				$this->mail_function($admin_emailid,$list,$subject,$gd_message);
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// delete user details..
	function delete_missing_cashback($id)
	{
		$this->db->connection_check();
		$this->db->delete('missing_cashback',array('cashback_id' => $id));  
		$this->db->delete('transation_details',array('details_id' => $id));     
		return true;
	}
	
	function update_users_balance($userid,$trans_amount,$mode,$newbalnce,$transation_reason,$details_id=null,$table=null)
	{
		$this->db->connection_check();
		$data = array(		
		'balance' => $newbalnce);
		$this->db->where('user_id',$userid);
		$update_qry = $this->db->update('tbl_users',$data);
		if($update_qry)
		{$now = date('Y-m-d H:i:s');
			// Transation
			
			
			$data = array(		
			'transation_amount' => $trans_amount,
			'user_id' => $userid,
			'transation_date' => $now,
			'transation_reason' => $transation_reason,
			'mode' => $mode,
			'details_id'=>$details_id,
			'table'=>$table,
			'transation_status ' => 'Paid');
			$this->db->insert('transation_details',$data);
			$user_deta = $this->view_user($userid);
			$name = $this->db->query("select * from admin")->row();
			if($user_deta->refer!=0)
			{
				$refer = $user_deta->refer;
				$caspe = $name->referral_cashback;
				$cal_percent =($trans_amount*$caspe)/100;
				
				$data = array(		
				'transation_amount' => $cal_percent,
				'user_id' => $userid,
				'transation_date' => $now,
				'transation_reason' => "Referal Payment",
				'mode' => $mode,
				'details_id'=>'',
				'table'=>'',
				'transation_status ' => 'Paid');
				$this->db->insert('transation_details',$data);
			}
			
			$this->db->where('cashback_id',$details_id);        
       		$querys = $this->db->get('missing_cashback')->row();
			$click_details = $this->click_history_details($querys->click_id);
		
			$data = array(		
			'user_id' => $userid,
			'coupon_id' => $click_details->voucher_name,
			'affiliate_id' => $querys->retailer_name,
			'status' => 'Completed',
			'cashback_amount'=>$trans_amount,
			'date_added' => $now);
			$this->db->insert('cashback',$data);
			
			
			return true;
		}
		else 
		{ 
			return false;
		}	
	}
	
	function user_balance($user_id=null)
	{
		$this->db->connection_check();
		if($user_id!="")
		{
			$this->db->where('user_id',$user_id);
			$allfaqs = $this->db->get('tbl_users');
			return $allfaqs->row("balance");
		}
		else
		{
			return 0;
		}
		
	}	
	
	function click_history_details($click_id)
	{
		$this->db->connection_check();
		$this->db->where('click_id',$click_id);
		$all = $this->db->get('click_history');
		if($all->num_rows > 0){
			return $all->row();
		}
		return false;
	}
	/************ Dec 11th *************/
	
	function bulk_stores($bulkcoupon)
	{
		$this->db->connection_check(); 
		$coupon_type = '';
		$this->load->library('CSVReader');
		$main_url = 'uploads/stores/'.$bulkcoupon;
	 	$result =   $this->csvreader->parse_file($main_url);
	
		if(count($result)!=0)
		{
			foreach($result as $res)
			{
				$new_random = mt_rand(0,99999);
				$affiliate_name = $res['affiliate_name'];
				$seo_url  = $this->admin_model->seoUrl($affiliate_name);
				$affiliate_logo_1 = $res['affiliate_logo'];
				
				//$file = 'http://media.themalaysianinsider.com/assets/uploads/articles/flipkart-logo-072914.jpg.jpg';
				// Open the file to get existing content
				$data = file_get_contents($affiliate_logo_1);
				
				$affiliate_logo = $new_random.'.jpg';
				
				// New file
				$new = 'uploads/affiliates/'.$affiliate_logo;
				// Write the contents back to a new file
				file_put_contents($new, $data);				
				$affiliate_desc = $this->db->escape_str($res['affiliate_desc']);
				$cashback_percentage = $res['cashback_percentage'];
				$site_url = $res['site_url'];
				
				/*$website_url = $res['website_url'];*/
				$meta_keyword = $this->db->escape_str($res['meta_keyword']);
				$meta_description = $this->db->escape_str($res['meta_description']);
				$affiliate_cashback_type = $this->db->escape_str($res['affiliate_cashback_type']);				
				$featured = $res['featured'];
				$now = date('Y-m-d H:i:s');
				$store_of_week = $res['store_of_week'];				
				$this->db->where('affiliate_name',$affiliate_name);
				$result = $this->db->get('affiliates');
				
				if($result->num_rows == 0)
				{
					$results = $this->db->query("INSERT INTO `affiliates` (`affiliate_name`, `affiliate_url`, `affiliate_logo`, `affiliate_desc`, `affiliate_status`, `cashback_percentage`, `logo_url`, `meta_keyword`, `meta_description`, `featured`, `affiliate_cashback_type`,`store_of_week`, `date_added`) VALUES ('$affiliate_name', '$seo_url', '$affiliate_logo', '$affiliate_desc', '1','$cashback_percentage', '$site_url', '$meta_keyword', '$meta_description', '$featured', '$affiliate_cashback_type','$store_of_week','$now');");
				}				
				
			}
		}
		
		return true;
	}
	
	
	function reports_upload($bulkcoupon){ 
		$this->db->connection_check();
		$coupon_type = '';
		$this->load->library('CSVReader');
		$main_url = 'uploads/reports/'.$bulkcoupon;
	 	$result =   $this->csvreader->parse_file($main_url);
		$name = $this->db->query("select * from admin")->row();
		$ref_cashbcak_percent =  $name->referral_cashback;
		if(count($result)!=0)
		{
			$s =1;
			foreach($result as $res)
			{
				$pay_out_amount = $res['pay_out_amount'];
				$sale_amount = $res['sale_amount'];
				$offer_provider = $res['offer_provider'];
				$transaction_id = $res['transaction_id'];
				$user_tracking_id = $res['user_tracking_id'];
				
			
				$store_details = $this->get_offer_provider_cashback($offer_provider);
			
				
				
				$get_userid = decode_userid($user_tracking_id);
			
				if($store_details)
				{
				
					if($store_details->cashback_percentage)
					{
						$affiliate_cashback_type = $store_details->affiliate_cashback_type;
					if($store_details->affiliate_cashback_type=='Percentage')//Percent
						{
							$is_cashback = 1;
							
							$cashback_percentage = $store_details->cashback_percentage;
							$cashback_calc = ($sale_amount*$cashback_percentage)/100;
							$cashback_amount = number_format($cashback_calc, 2);
							$check_ref = $this->check_ref_user($get_userid);
							$ref_cashback_amount = 0;
							if($check_ref>0)					
							{
								$ref_id  = $check_ref;
								$ref_cashback_percent = $ref_cashbcak_percent;
								$ref_cashback_amount = number_format((($cashback_amount*$ref_cashbcak_percent)/100), 2);
							}
							$total_Cashback_paid = $cashback_amount+$ref_cashback_amount;
						}
						else //Flat
						{
							$is_cashback = 1;
							$cashback_percentage = $store_details->cashback_percentage;
							//$cashback_calc = ($sale_amount*$cashback_percentage)/100;
							$cashback_amount = number_format($cashback_percentage, 2);
							$check_ref = $this->check_ref_user($get_userid);
							$ref_cashback_amount = 0;
							if($check_ref>0)					
							{
								$ref_id  = $check_ref;
								$ref_cashback_percent = $ref_cashbcak_percent;
								$ref_cashback_amount = number_format((($cashback_amount*$ref_cashbcak_percent)/100), 2);
							}
							$total_Cashback_paid = $cashback_amount+$ref_cashback_amount;
						}
					}
					else 
					{
						$is_cashback = 0;
						$cashback_percentage = 0;
						$cashback_amount=0;
						$ref_id = 0;
						$ref_cashback_percent= 0;
						$ref_cashback_amount =0;
						$total_Cashback_paid= 0;
						$affiliate_cashback_type ='';
					}
				}
				else
				{
					
						$is_cashback = 0;
						$cashback_percentage = 0;
						$cashback_amount=0;
						$ref_id = 0;
						$ref_cashback_percent= 0;
						$ref_cashback_amount =0;
						$total_Cashback_paid= 0;
						$affiliate_cashback_type='';
				}
				$date = $res['date'];
				$now = date('Y-m-d H:i:s');
				$last_updated = $now;
				
				$results = $this->db->query("INSERT INTO `tbl_report` (`offer_provider`, `date`, `pay_out_amount`, `sale_amount`, `transaction_id`, `user_tracking_id`, `last_updated`, `is_cashback`, `cashback_percentage`, `affiliate_cashback_type`,`cashback_amount`, `ref_id`, `ref_cashback_percent`,`ref_cashback_amount`,`total_Cashback_paid`, `status`) VALUES ('$offer_provider', '$date', '$pay_out_amount', '$sale_amount', '$transaction_id','$get_userid', '$last_updated', '$is_cashback', '$cashback_percentage', '$affiliate_cashback_type','$cashback_amount', '$ref_id','$ref_cashback_percent','$ref_cashback_amount','$total_Cashback_paid','$now');");
				
				
				$insert_id = $this->db->insert_id();
				
				if($is_cashback!=0)
				{
					$update_user_bal = $this->update_user_bal($get_userid,$cashback_amount);
					$now = date('Y-m-d H:i:s');
					$transation_reason = "Cashback";
					$mode = "Credited";
					$data = array(		
						'transation_amount' => $cashback_amount,
						'user_id' => $get_userid,
						'transation_date' => $now,
						'transation_reason' => $transation_reason,
						'mode' => $mode,
						'details_id'=>$insert_id,
						'table'=>'tbl_report',
						'transation_status ' => 'Paid');
					$this->db->insert('transation_details',$data);
				
					if($ref_cashback_amount!=0)
					{
						$update_user_bal = $this->update_user_bal($ref_id,$ref_cashback_amount);
						$data = array(		
							'transation_amount' => $ref_cashback_amount,
							'user_id' => $ref_id,
							'transation_date' => $now,
							'transation_reason' => 'Referal Payment',
							'mode' => $mode,
							'details_id'=>'',
							'table'=>'',
							'transation_status ' => 'Paid');						
						$this->db->insert('transation_details',$data);
					}
					
					
					
					$data = array(		
					'user_id' => $get_userid,
					'coupon_id' => $offer_provider,
					'affiliate_id' => $offer_provider,
					'status' => 'Completed',
					'transation_amount' =>$sale_amount,
					'cashback_amount'=>$cashback_amount,
					'date_added' => $now);
					$this->db->insert('cashback',$data);
				}
		
				$s++;
			}
		}
		
		return true;
	}
	
	function get_offer_provider_cashback($storename)
	{
		$this->db->connection_check();
		$this->db->like('affiliate_name', $storename);
		$this->db->limit(1,0);
		$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->row();
		}
		return false;
	}
	
	function check_ref_user($ref_user)
	{
		$this->db->connection_check();
		$this->db->where('user_id',$ref_user);        
		$result = $this->db->get('tbl_users');
		if($result->num_rows > 0){
			return $result->row('refer');
		}
		return false;
	}
	
	function update_user_bal($user_id,$newamount)
	{		
				$this->db->connection_check();	
				$old_bal = $this->user_balance($user_id);
				$new_bal = $old_bal+$newamount;
				$data = array(		
				'balance' => $new_bal);
				$this->db->where('user_id',$user_id);
				$update_qry = $this->db->update('tbl_users',$data);
	}
	
	function reports()
	{
		$this->db->connection_check();
		$this->db->order_by("report_id", "desc");
		$result = $this->db->get('tbl_report');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	
	function view_report($report_id)
	{
		$this->db->connection_check();
		$this->db->where('report_id',$report_id);        
        $query = $this->db->get('tbl_report');
        if($query->num_rows >= 1)
		{
          return $row = $query->row();
        }
        return false;
	}
	
	// view user email	
	function user_name($user_id)
	{
		$this->db->connection_check();	
		$result = $this->db->get_where('tbl_users',array('user_id'=>$user_id))->row('first_name');
		return $result;	
	}
		
	
	function transactions(){
			/*$this->db->connection_check();
			$this->db->select("*");
			$this->db->from("transation_details");
			$this->db->order_by("trans_id", "desc");
			$result = $this->db->get();
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;*/

		$this->db->connection_check();
			$this->db->where('status','1');
			$result = $this->db->get('pending');
			if($result->num_rows > 0)
			{
				return $result->result();
		    }
		return false;
	}
	
	
	
	//adding cms..
	function addblog($logo)
	{
		$now = date('Y-m-d H:i:s');
		$data = array(
		'cms_heading' => $this->input->post('page_title'),
		'cms_metatitle' => $this->input->post('meta_title'),
		'cms_metakey' => $this->input->post('meta_keyword'),
		'cms_metadesc' => $this->input->post('meta_description'),
		'cms_content' => $this->input->post('cms_content'),
		'affiliate_logo' => $logo,
		'blog_time' =>  $now,
		'cms_status' => $this->input->post('cms_status')
		);
		
		$this->db->insert('tbl_blog',$data);
		return true;
	}
	// get all cms
	function get_allblog(){
		
		$cms_query = $this->db->get('tbl_blog');
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
	function get_blogcontent($id){
	
		$this->db->where('cms_id',$id);        
        $query = $this->db->get('tbl_blog');
        if($query->num_rows >= 1)
		{
           $row = $query->row();			
            return $query->result();			
        }      
        return false;		
	}
	
	
	//update cms ..
	function updateblog($img){
	$now = date('Y-m-d H:i:s');
		$data = array(
			'cms_heading' => $this->input->post('page_title'),
			'cms_metatitle' => $this->input->post('meta_title'),
			'cms_metakey' => $this->input->post('meta_keyword'),
			'cms_metadesc' => $this->input->post('meta_description'),
			'cms_content' => $this->input->post('cms_content'),
			'cms_status' =>  $this->input->post('cms_status'),
			'blog_time' =>  $now,
			'affiliate_logo' =>  $img
		);
		$id =  $this->input->post('cms_id');
		$this->db->where('cms_id',$id);
		$upd = $this->db->update('tbl_blog',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}	
	}
	
	
	// delete cms..
	function deleteblog($id){
	
		$this->db->delete('tbl_blog',array('cms_id' => $id));
		return true;
	
	}
	
	function get_allcomments($blogid){
		$this->db->where('bid',$blogid);
		$cms_query = $this->db->get('tbl_bloguser_comments');
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
	
	function delete_comments($id){
	
		$this->db->delete('tbl_bloguser_comments',array('cid' => $id));
		return true;
	
	}
	
	function status_change_comments($changes_id)
	{
		$this->db->where('cid',$changes_id);
		$cms_query = $this->db->get('tbl_bloguser_comments')->row();
		if($cms_query->status=='active')
		{
			$st = 'deactive';
		}
		else
		{
			$st = 'active';
		}
		$data = array(
			'status' =>  $st
		);
		$this->db->where('cid',$changes_id);
		$upd = $this->db->update('tbl_bloguser_comments',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}	
	}
	
	function add_comments(){
		$now = date('Y-m-d H:i:s');
		$data = array(
		'bid'=>$this->input->post('blog_id'),
		'user_id'=>'Admin',
		'comments'=>$this->input->post('comments'),
		'created_date'=>$now,
		'c_date'=>$now,
		'status'=>'active'	
		);
		$this->db->insert('tbl_bloguser_comments',$data);		
		return true;
	}
	
	function add_manual_credit()
	{
		$user_bale = $this->view_balance($this->input->post('user_id'));
		$newbalnce= $user_bale+$this->input->post('transation_amount');
		$data = array(		
		'balance' => $newbalnce);
		$this->db->where('user_id',$this->input->post('user_id'));
		$update_qry = $this->db->update('tbl_users',$data);
		
		
		$now = date('Y-m-d');
		$data = array(
		'user_id'=>$this->input->post('user_id'),
		'transation_reason'=>$this->input->post('transation_reason'),
		'transation_amount'=>$this->input->post('transation_amount'),
		'transation_date'=>$now,
		'mode'=>'Credited',
		'transation_status'=>'Paid'	
		);
		$this->db->insert('transation_details',$data);		
		if($this->input->post('transation_reason')=="Cashback"){
			$refer_user = $this->view_user($this->input->post('user_id'));
			if($refer_user){
				foreach($refer_user as $single){
					$referral_user = $single->refer;
				}
				
				$referral_user_det = $this->view_user($referral_user);
				if($referral_user_det){
					foreach($referral_user_det as $single1){
						$referral_balance = $single1->balance;
						$referral_id = $single1->user_id;
					}
					
					$name = $this->db->query("select * from admin")->row();
					$caspe = $name->referral_cashback;
					$tr_amt = $this->input->post('transation_amount');
					$cal_percent =($tr_amt*$caspe)/100;
					
					$data = array(		
					'transation_amount' => $cal_percent,
					'user_id' => $referral_id,
					'transation_date' => $now,
					'transation_reason' => "Referal Payment",
					'mode'=>'Credited',

					'details_id'=>'',
					'table'=>'',
					'transation_status ' => 'Paid');
					$this->db->insert('transation_details',$data);
					
					$this->db->where('user_id',$referral_id);
					$this->db->update('tbl_users',array('balance'=>$referral_balance+$cal_percent));
				}
			}
		}
		return true;
	}
	
	function count_coupons($catename=null)
	{
		$count_coupons = $this->db->query("SELECT count(*) as counting FROM `coupons` where offer_name like '%$catename%'");
		if($count_coupons->num_rows > 0)
        {
            return $count_coupons->row();
        }
		else
		{
			return false;
		}
	}
	
	function count_clicks($catid)
	{
		$count_coupons = $this->db->query("SELECT count(*) as counting FROM `click_history` where affiliate_id='$catid'");
		if($count_coupons->num_rows > 0)
        {
            return $count_coupons->row();
        }
		else
		{
			return false;
		}
	}
	
	
	
	// add new shopping coupon..
function add_shoppingcoupon($img)
 {
	 $this->db->connection_check();
	   // premium_coupon_feature
	   
		$premium_coupon_feature = $this->input->post('premium_coupon_feature'); 
		$start_date = $this->input->post('start_date');
		if($start_date!=""){
			$start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		}
		else {
			$start_date = date('Y-m-d');
		}
		$expiry_date = date('Y-m-d',strtotime($this->input->post('expiry_date')));
		$stcat = $this->input->post('categorys_list');
		
		if($this->input->post('categorys_list'))
		{
			$store_categorys =implode(",",$this->input->post('categorys_list')); 
		}
		else
		{
			$store_categorys ='';
		}
		
		if($premium_coupon_feature)
		{
			$exp_couponfeatures =implode(",",$premium_coupon_feature);  
		}
		else
		{
			$exp_couponfeatures ='';  
		}
		
		 
		 $codes=$this->input->post('code');  
		  
			$seo_url  = $this->admin_model->seoUrl($this->input->post('offer_name'));
		$data = array(
			 
			'offer_name'=>$this->input->post('offer_name'),
			'coupon_image'=>$img,
			'description'=>$this->input->post('description'),
			'about'=>$this->input->post('about'),
			'nutshel'=>$this->input->post('nutshel'),
			'fine_print'=>$this->input->post('fine_print'),
			'company'=>$this->input->post('company'),
			'location'=>$this->input->post('location'),
			'user_max' => $this->input->post('user_max'),
			'seo_url'=>$seo_url,
				
			'category'=>$store_categorys,
			//'type'=>$this->input->post('type'),
			 // 'title'=>$this->input->post('title'),
			// 'code'=>$this->input->post('code'),
			'long_description' => $this->input->post('long_description'),
			'offer_page'=>$this->input->post('offer_page'),
			'amount'=>$this->input->post('amount'),
			 	'coupon_code'=>$codes,  
			'remain_coupon_code'=>$codes,   
			'status'=>"1",    
			'start_date'=>$start_date,
			'expiry_date'=>$expiry_date
		); 
		
		
		$this->db->insert('shopping_coupons',$data);
		$new_id = $this->db->insert_id();
		
		/* $codes = $this->input->post('code');
		foreach($codes as $val){
			
			$data = array(
				'shoppingcoupon_id'=>$new_id,
				'status'=>'1',
				'code'=>$val
			);
			
			
			$this->db->insert('shoppingcodes',$data);		
		} */
		
		/* 
		foreach($stcat as $maincat)
		 {
				$var="size_".$maincat;
				$subcat = $this->input->post($var);
				foreach($subcat as $subcategory)
				{
					$data = array(
					'category_id'=>$maincat,
					'sub_category_id'=>$subcategory,
					'store_id'=>$new_id
					);
					$this->db->insert('tbl_premium_sub_cate',$data);
			}
		} 
		
		*/ 
		 
		 
		return true;
 }
	
function update_shoppingcoupon($img) 
{
	$this->db->connection_check();
		/*print_r($this->input->post());
		exit;*/
		$premium_coupon_feature = $this->input->post('premium_coupon_feature'); 
		if($premium_coupon_feature)
		{
			$exp_couponfeatures =implode(",",$premium_coupon_feature); 
		}
		else
		{
			$exp_couponfeatures ='';
		}
			
		if($this->input->post('start_date')){
			$start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		}
		else {
			$start_date = date('Y-m-d');
		}
		$stcat = $this->input->post('categorys_list');
		if($this->input->post('categorys_list'))
		{
			$store_categorys =implode(",",$this->input->post('categorys_list'));
		}
		else
		{
			$store_categorys ='';
		}
		
		$expiry_date = date('Y-m-d',strtotime($this->input->post('expiry_date')));	
		$shoppingcoupon_id = $this->input->post('shoppingcoupon_id'); 
		$codes = $this->input->post('code');
$seo_url  = $this->admin_model->seoUrl($this->input->post('offer_name'));
		$data = array(
			 
			'offer_name'=>$this->input->post('offer_name'),  			
			'coupon_image'=>$img,
			'description'=>$this->input->post('description'),
			
				'about'=>$this->input->post('about'),
				'nutshel'=>$this->input->post('nutshel'),
				'fine_print'=>$this->input->post('fine_print'),
				'company'=>$this->input->post('company'),
				'location'=>$this->input->post('location'),
								
			'category'=>$store_categorys,
			// 'title'=>$this->input->post('title'),
			// 'type'=>$this->input->post('type'),
			// 'code'=>$this->input->post('code'),
			'amount'=>$this->input->post('amount'),
			
			
			'user_max' => $this->input->post('user_max'),
			'offer_page'=>$this->input->post('offer_page'),  
			'features'=>$exp_couponfeatures, 
			'coupon_code'=>$codes,  
			'remain_coupon_code'=>$codes,   
 			'start_date'=>$start_date,  
			
			'long_description' => $this->input->post('long_description'),
			
			'seo_url'=>$seo_url,
			'expiry_date'=>$expiry_date 
		);
		
		$this->db->where('shoppingcoupon_id',$shoppingcoupon_id);
		$updation = $this->db->update('shopping_coupons',$data);
   
		/*
		$codes = $this->input->post('code');
		$shoppingcode_id = $this->input->post('shoppingcode_id');
		if($codes)
		{
			foreach($codes as $key=>$val){
				
				$data = array(
					'code'=>$val
				);
				$this->db->where('shoppingcode_id',$shoppingcode_id[$key]);
				$updation = $this->db->update('shoppingcodes',$data);
			}  
		} */  
		  
		// this is for inserting new coupons..
		/* 	$new_codes = $this->input->post('codes');
			if($new_codes!=""){
				foreach($new_codes as $val){
			
					$data = array(
						'shoppingcoupon_id'=>$shoppingcoupon_id,
						'status'=>'1',
						'code'=>$val
					);
					$this->db->insert('shoppingcodes',$data); 
				}
			} */
			//print_r($this->input->post());  
			 
		/* 	foreach($stcat as $maincat)
			{
				
				$var="size_".$maincat;
				$subcat = $this->input->post($var);
				foreach($subcat as $subcategory)
				{
					$data = array(
					'category_id'=>$maincat,
					'sub_category_id'=>$subcategory,
					'store_id'=>$shoppingcoupon_id
					); 
					$this->db->insert('tbl_premium_sub_cate',$data);
			}
		}		 */  
		
	//	exit; 
		
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}
 }	
function reviews(){
	$this->db->connection_check();
	/* $this->db->order_by('id','desc');
	 $result = $this->db->get('revi ews');*/
	 
	  $result = $this->db->query("SELECT * FROM (reviews) ORDER BY `id` desc");
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	 
}
 function get_name($cis,$uid)
 {
	 $this->db->connection_check();
	 //echo $uid;die;
	 $this->db->where('user_id',$uid);
	 $result = $this->db->get('tbl_users');
	//echo $this->db->last_query();die;
		if($result->num_rows > 0){
			$uresult = $result->row();
			$uname = $uresult->first_name.' '.$uresult->last_name;
		}else{
			$uname = '';
		}
	
	 $this->db->where('product_id',$cis);

		$result = $this->db->get('products');
		if($result->num_rows > 0){
			$uresult = $result->row();
			$cname = $uresult->product_url;
			$seo_url = $uresult->seo_url;
		}else{
			$cname = '';
			$seo_url = '';
		}
		return $uname.",".$cname.",".$seo_url;
 }
	
	function changestatus($id,$status)
	{
		$this->db->connection_check();
		if($status==1) $var=0;else $var=1;
			$data = array(
			'approve'=>$var,
			
			);
			$this->db->where('id',$id);
			$updation = $this->db->update('reviews',$data);	
                        return true;
	}
	
	function orders()
	{
		$this->db->connection_check();
		$this->db->order_by('id','desc');
		$this->db->where('status','Paid');
		$result = $this->db->get('premium_order');
		if($result->num_rows > 0){
			return $result->result();
		}
			return false;
	}
	 
	 function sort_categorys_new()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('sort_arr');
		 foreach($sort_order as $key=>$val)
		 {
			  $data = array(
				'sort_order'=>$val			
				);
			$this->db->where('category_id',$key);
			$updation = $this->db->update('categories',$data);	
		 }
		 return true;
			
	 }
	 
	 function sort_premium_categorys_new()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('sort_arr');
		 foreach($sort_order as $key=>$val)
		 {
			  $data = array(
				'sort_order'=>$val			
				);
			$this->db->where('category_id',$key);
			$updation = $this->db->update('premium_categories',$data);	
		 }
		 return true;
			
	 }
	 
	 
	 function multi_delete_user()
	 {
		 $this->db->connection_check();
		 if($this->input->post('chkbox'))
		 {
			  $sort_order = $this->input->post('chkbox');
			  foreach($sort_order as $key=>$val)
			  {
				   $this->db->where('user_id',$key);
				   $query = $this->db->get('tbl_users');
				   $email = $query->row('email');
					
					$data = array(
						'admin_status' => 'deleted',
						'status' =>  '0'
					);
					$this->db->where('user_id',$key);
					$upd = $this->db->update('tbl_users',$data);
					$this->db->delete('referrals',array('referral_email' => $email));   
			  }
		 	return true;
		 }
			
	 }
	 
	 function sort_categorys_new_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			 $id = $key;
		
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
			
		 }
		 return true;
			
	 }
	 
	 
	 
	 
	  function sort_sub_categorys_new()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('sort_arr');
		 foreach($sort_order as $key=>$val)
		 {
			  $data = array(
				'sort_order'=>$val			
				);
			$this->db->where('sun_category_id',$key);
			$updation = $this->db->update('sub_categories',$data);	
		 }
		 return true;
			
	 }
	 
	  function sort_sub_categorys_new_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			 $id = $key;
		
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
			
		 }
		 return true;
			
	 }
	 		
	 function sort_premium_categorys_new_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			 $id = $key;		
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
			
		 }
		 return true;
			
	 }
	 
	 function delete_multi_site_affiliate()
	 {
		 $this->db->connection_check();
		  $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			 $id = $key;		
				$this->db->delete('providers',array('affiliate_id' => $id));			
		 }
		 return true;
	 }
	 
	 
	 function sort_affiliates()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('sort_arr');
		 foreach($sort_order as $key=>$val)
		 {
			  $data = array(
				'sort_order'=>$val			
				);
			$this->db->where('affiliate_id',$key);
			$updation = $this->db->update('affiliates',$data);	
		 }
		 return true;
	 }
	 
	 function sort_affiliates_delete()
	 {
		 $this->db->connection_check();
		  $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
				 $id = $key;
				 $this->db->delete('affiliates',array('affiliate_id' => $id));
				$this->db->delete('tbl_store_sub_cate',array('store_id' => $id));
				
				$this->db->delete('click_history',array('affiliate_id' => $id));	
					
		 }
		  return true;
		
	 }
	 
	 function click_history_bulk_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			 foreach($sort_order as $key=>$val)
			 {
					 $id = $key;
					 $this->db->delete('click_history',array('click_id'=>$id));
			 }
		return true;	
	 }
	 
	 function cashback_details_bulk_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			 foreach($sort_order as $key=>$val)
			 {
					 $id = $key;
					 $this->db->delete('category_cashback',array('cbid'=>$id));
			 }
		return true;	
	 }
	 
	 
	  function coupons_bulk_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			 foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					 $this->db->delete('coupons',array('coupon_id'=>$delete_id));
	
			 }
		return true;	
	 }
	 
	 
	 function bulk_shopping_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					$this->db->delete('shopping_coupons',array('shoppingcoupon_id'=>$delete_id)); 
			 }
		return true;
	 }
	 
	 function delete_bulk_orders()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					$this->db->delete('premium_order',array('id'=>$delete_id)); 
			 }
		return true;
	 }
	 
	 function bulk_reviews_delete()
	 {
		 $this->db->connection_check();
		$sort_order = $this->input->post('chkbox');
			foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					$this->db->delete('reviews',array('id'=>$delete_id)); 
			 }
		return true; 
	 }
	 
	 function reports_bulk_delete()
	 {
		 $this->db->connection_check();
			$sort_order = $this->input->post('chkbox');
			foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					$this->db->delete('tbl_report',array('report_id'=>$delete_id)); 
			 }
		return true;  
	 }
	 
	 
	 function delete_bulk_records($sort_order,$table,$feald)
	 {		 
		$this->db->connection_check();
		if($table=="cashback"){ // need to delete pending referral also..
			foreach($sort_order as $key=>$val)
			{
				$cashback_detail = $this->db->get_where('cashback',array('cashback_id'=>$key))->row();
				$status = $cashback_detail->status;
				$txn_id = $cashback_detail->txn_id;
				// $this->db->delete('cashback',array('cashback_id'=>$id));
				if($status=="Pending"){
					$this->db->delete('transation_details',array('trans_id'=>$txn_id));
				}
				$delete_id = $key;
				$this->db->delete($table,array($feald=>$delete_id)); 
			}
		} else {
			foreach($sort_order as $key=>$val)
			{
				$delete_id = $key;
				$this->db->delete($table,array($feald=>$delete_id)); 
			}
		}
		return true;  
	 }
	 
	 
	//forgetpassword
	function forgetpassword(){
		$this->db->connection_check();
		$email = $this->input->post('forget_email');
		
		 $admin_email = $this->db->get_where('admin', array('admin_id' =>'1'))->row('admin_email');
		
		if($admin_email!=$email){
			return false;
		}
		//send email 
			// $this->load->library('email');
			
			$this->db->where('admin_id',1);
			$admin_det = $this->db->get('admin');
			if($admin_det->num_rows >0) 
			{    
				 $admin = $admin_det->row();
				 $admin_email = $admin->admin_email;
				 $site_name = $admin->site_name;
				 $admin_no = $admin->contact_number;
				 $admin_password = $admin->admin_password;
				   $site_logo = $name->site_logo;
			}			
			$date =date('Y-m-d');
			
			$this->db->where('mail_id','6');
			$mail_template = $this->db->get('tbl_mailtemplates');
			if($mail_template->num_rows >0) 
			{        
			   $fetch = $mail_template->row();
			   $subject = $fetch->email_subject;  
			   $templete = $fetch->email_template;
			    /*$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',
				  'smtp_port' => 465,
				  'smtp_user' => 'vivek.developer@osiztechnologies.com',
				  'smtp_pass' => 'iamnotlosero',
				  'mailtype'  => 'html',
				  'charset'   => 'iso-8859-1'
				  );
				  $config = Array(
					 'mailtype'  => 'html',
					  'charset'   => 'utf-8',
					  );*/
     			/*$this->email->initialize($config);        
     			 $this->email->set_newline("\r\n");
			   $this->email->from($admin_email);
			   $this->email->to($user_email);
			   $this->email->subject($subject);*/

			  $sub_data = array(
						'###SITENAME###'=>$site_name
					);
			   $subject_new = strtr($subject,$sub_data);

			    $data = array(
					'###PASSWORD###'=>$admin_password,
					'###COMPANYLOGO###'=>'<img alt="" src='.base_url()."/uploads/adminpro/".$site_logo.' />',
					'###SITENAME###'=>$site_name,
					'###ADMINNO###'=>$admin_no,
					'###DATE###'=>$date
			    );
			   $content_pop=strtr($templete,$data);
		/*	   $this->email->message($content_pop);
			   $this->email->send();*/ 
			   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
				return 'success';
			}
			
	}
	
function multi_delete_banners()
{
	$this->db->connection_check();
		 if($this->input->post('chkbox'))
		 {
			  $sort_order = $this->input->post('chkbox');
			  foreach($sort_order as $key=>$val)
			  {
				  $this->db->delete('tbl_banners',array('banner_id' => $key));
			  }
		 	return true;
		 }
}
function payment_settings()
{
		$this->db->connection_check();
		$merchant_key = $this->input->post('merchant_key');
		$merchant_salt = $this->input->post('merchant_salt');
		$merchant_id = $this->input->post('merchant_id');
		$payment_mode = $this->input->post('payment_mode');
		//$data['payment_mode'] = $details->payment_mode;			
			$data = array(
			'merchant_key'=>$merchant_key,
			'merchant_salt'=>$merchant_salt,
			'merchant_id'=>$merchant_id,
			'payment_mode'=>$payment_mode
			);
			$this->db->where('admin_id',1);	
			$this->db->update('admin',$data);
			return true;
}
function category_cashback($cateid)
{
		$this->db->connection_check();
		$this->db->where('store_categorys !=', '');
		$this->db->where('affiliate_id',$cateid);	
		$all = $this->db->get('affiliates');
		if($all->num_rows > 0)
		{
			$results=  $all->row();
			$store_categorys = $results->store_categorys;
			//echo "SELECT * FROM `categories` where FIND_IN_SET(`category_id`,'$store_categorys')";
			$quers = $this->db->query("SELECT * FROM `categories` where FIND_IN_SET(`category_id`,'$store_categorys')");
			if($quers->num_rows > 0)
			{
				$fetch = $quers->result();
				return $fetch;
			//$catelist = explode(',',$store_categorys);
			}
			else
			{
				return false;
			}
						
		}
		else
		{
			return false;
		}
}
function cashback_details_category($catid,$storeid)
{
	$this->db->connection_check();
	$this->db->where('category_id',$catid);	
	$this->db->where('store_id',$storeid);
	$all = $this->db->get('category_cashback');
	if($all->num_rows > 0)
	{
		$results=  $all->row();
		return $results;
	}
	else
	{
		return false;
	}
	
}
	function update_catecashback_ins($caskbackid=null)
	{
		$this->db->connection_check();
		if($this->input->post('action')=='new')
		{
			$data = array(			
			'store_id' => $this->input->post('store_id'),
			'cashback_type' => $this->input->post('cashback_type'),
			'cashback' => $this->input->post('cashback'),
			'cashback_details' => $this->input->post('cashback_details'),
			'status' => $this->input->post('status')		
			);
			$this->db->insert('category_cashback',$data);
			return true;
		}
		else
		{
			$data = array(			
			'store_id' => $this->input->post('store_id'),
			'cashback_type' => $this->input->post('cashback_type'),
			'cashback' => $this->input->post('cashback'),
			'cashback_details' => $this->input->post('cashback_details'),
			'status' => $this->input->post('status')		
			);
			
			$cbid = $this->input->post('caskbackid');
			$this->db->where('cbid',$cbid);
			$updation = $this->db->update('category_cashback',$data);
			return true;
		}
		
	}
	function upload_reports($bulkcoupon)
	{
		$this->db->connection_check();
		$coupon_type = '';	
		$this->load->library('CSVReader');	
		$main_url = 'uploads/reports/'.$bulkcoupon;	
		$result =   $this->csvreader->parse_file($main_url);	
		$name = $this->db->query("select * from admin")->row();	
		$ref_cashbcak_percent =  $name->referral_cashback;	
		if(count($result)!=0)	
		{
			$s =1;				
			foreach($result as $res)	
			{	
				$pay_out_amount = $res['pay_out_amount'];	
				$sale_amount = $res['sale_amount'];	
				$offer_provider = $res['offer_provider'];	
				$transaction_id = $res['transaction_id'];
				$cashback = $res['cashback'];	
				$user_tracking_id = $res['user_tracking_id'];		

				$store_details = $this->get_offer_provider_cashback($offer_provider);
				$get_userid = decode_userid($user_tracking_id);
		
				$cashback_amount = $cashback;
				$check_ref = $this->check_ref_user($get_userid);
				$ref_cashback_amount = 0;
				$ref_id = 0;
				$referred = 0;
				$txn_id_new = 0;
				if($check_ref>0)		
				{
					$ref_id  = $check_ref;
					$return = $this->check_active_user($ref_id);
					if($return==1)
					{
						$referred = 1;
						$ref_cashback_percent = $ref_cashbcak_percent;
						$ref_cashback_amount = (($cashback_amount*$ref_cashbcak_percent)/100);
					}
				}
				
				$total_Cashback_paid = $cashback_amount+$ref_cashback_amount;
				
				//main contents
				$is_cashback = 1;	
				$cashback_percentage = 0;	
				$cashback_amount=$cashback;	
				$ref_id = $ref_id;	
				$ref_cashback_percent= $ref_cashbcak_percent;	
				$ref_cashback_amount =$ref_cashback_amount;	
				$total_Cashback_paid= $total_Cashback_paid;	
				$affiliate_cashback_type='';
				//main contents
				$date = $res['date'];	
				$now = date('Y-m-d H:i:s');	
				$last_updated = $now;
				$results = $this->db->query("INSERT INTO `tbl_report` (`offer_provider`, `date`, `pay_out_amount`, `sale_amount`, `transaction_id`, `user_tracking_id`, `last_updated`, `is_cashback`, `cashback_percentage`, `affiliate_cashback_type`,`cashback_amount`, `ref_id`, `ref_cashback_percent`,`ref_cashback_amount`,`total_Cashback_paid`, `status`) VALUES ('$offer_provider', '$date', '$pay_out_amount', '$sale_amount', '$transaction_id','$get_userid', '$last_updated', '$is_cashback', '$cashback_percentage', '$affiliate_cashback_type','$cashback_amount', '$ref_id','$ref_cashback_percent','$ref_cashback_amount','$total_Cashback_paid','$now');");	
				$insert_id = $this->db->insert_id();	
				if($is_cashback!=0)	
				{	
					// $update_user_bal = $this->update_user_bal($get_userid,$cashback_amount);	
					$now = date('Y-m-d H:i:s');	
					// $transation_reason = "Pending Cashback";	
					$mode = "Credited";	
					/* $data = array(		
						'transation_amount' => $cashback_amount,	
						'user_id' => $get_userid,	
						'transation_date' => $now,	
						'transation_reason' => $transation_reason,	
						'mode' => $mode,	
						'details_id'=>$insert_id,	
						'table'=>'tbl_report',	
						'transation_status ' => 'Progress');	
					$this->db->insert('transation_details',$data); */

					if($ref_cashback_amount!=0)	
					{
							// $update_user_bal = $this->update_user_bal($ref_id,$ref_cashback_amount);	
						$data = array(			
							'transation_amount' => $ref_cashback_amount,	
							'user_id' => $ref_id,	
							'transation_date' => $now,	
							'transation_reason' => 'Pending Referal Payment',	
							'mode' => $mode,	
							'details_id'=>'',	
							'table'=>'',	
							'transation_status ' => 'Progress');
						$this->db->insert('transation_details',$data);
						$txn_id_new = $this->db->insert_id();
					}

					$data = array(
					'user_id' => $get_userid,	
					'coupon_id' => $offer_provider,	
					'affiliate_id' => $offer_provider,	
					'status' => 'Pending',	
					'cashback_amount'=>$cashback_amount,	
					'date_added' => $now,
					'referral' => $referred,
					'txn_id' => $txn_id_new
					);	
					$this->db->insert('cashback',$data);	
					
				/* mail for pending cashback */
				$user_detail = $this->view_user($get_userid);
				if($user_detail){
					foreach($user_detail as $user_detail_single){
						$referral_balance = $user_detail_single->balance;
						$user_email = $user_detail_single->email;
						$user_name = $user_detail_single->first_name.' '.$user_detail_single->last_name;
					}
				}
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
				
				$this->db->where('mail_id',12);
				$mail_template = $this->db->get('tbl_mailtemplates');
				if($mail_template->num_rows >0) 
				{
				   $fetch = $mail_template->row();
				   $subject = $fetch->email_subject;
				   $templete = $fetch->email_template;
				   // $url = base_url().'cashback/my_earnings/';
				   
					/*$this->load->library('email');
					
					$config = Array(
						'mailtype'  => 'html',
						'charset'   => 'utf-8',
					);*/
					
					$sub_data = array(
						'###SITENAME###'=>$site_name
					);
					$subject_new = strtr($subject,$sub_data);
					
					/*$this->email->initialize($config);
					 $this->email->set_newline("\r\n");
					   $this->email->initialize($config);
					   $this->email->from($admin_email);
					   $this->email->to($user_email);
					   $this->email->subject($subject_new);*/
				   
					$data = array(
						'###NAME###'=>$user_name,
						'###COMPANYLOGO###' =>base_url()."uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
						'###AMOUNT###'=>$cashback_amount
				    );
				   
				   $content_pop=strtr($templete,$data);
				   // echo $content_pop; echo $subject_new;
				 /*  $this->email->message($content_pop);
				   $this->email->send();  */
				   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
				}
				/* mail for pending cashback */
				}
				$s++;
			}	
		}
		return true;
	}
	
	function ads(){
	$this->db->connection_check();
	// $this->db->order_by('ads_id','ASC');
	$this->db->order_by('ads_id','desc');

		$result = $this->db->get('ads');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	function get_ads($ads_id)
	{
		$this->db->connection_check();
		$result = $this->db->get_where('ads',array('ads_id'=>$ads_id))->row();
		return $result;
	}
	
	function addads($adsimg)
	{
		$data = array(
			'ads_url' => $this->input->post('ads_url'),
			'ads_position' => '',
			'ads_image' =>  $adsimg
		);
		$this->db->insert('ads',$data);
		return true;
	}
	
	
	
	function updateads($img)
	{
		$this->db->connection_check();
		$data = array(
			'ads_url' => $this->input->post('ads_url'),
			'ads_position' => $this->input->post('ads_position'),
			'ads_image' =>  $img
		);
		
		$id =  $this->input->post('ads_id');
		$this->db->where('ads_id',$id);
		$upd = $this->db->update('ads',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}	
	}
	
	function contacts()
	{
		$this->db->connection_check();
		$this->db->order_by('id','desc');
		$result = $this->db->get('tbl_contact');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	 }
	 
	 
	 function deletecontact($id)
	 {
		 $this->db->connection_check();	
		$this->db->connection_check();$this->db->delete('tbl_contact',array('id' => $id));
		return true;
	
	}
	
	function multi_delete_contacts()
	{
		$this->db->connection_check();
		 if($this->input->post('chkbox'))
		 {
			  $sort_order = $this->input->post('chkbox');
			  foreach($sort_order as $key=>$val)
			  {
				  $this->db->delete('tbl_contact',array('id' => $key));
			  }
		 	return true;
		 }
	}
	function select_table($tab_conti)
	{
	$this->db->connection_check();
	if($tab_conti=='active')
	{
		 $selqry="SELECT * FROM shopping_coupons  WHERE expiry_date >='".date('Y-m-d')."' order by shoppingcoupon_id desc";  
		 $result=$this->db->query("$selqry"); 
			if($result->num_rows > 0)
			{		
				return $result->result();
			}
	}
	else
	{
		 $selqry="SELECT * FROM shopping_coupons  WHERE expiry_date <='".date('Y-m-d')."' order by shoppingcoupon_id desc";  
		 $result=$this->db->query("$selqry"); 
			if($result->num_rows > 0)
			{		
				return $result->result();
			}
	}
	
		
	}
	function download_free_coupons()
	{
		$this->db->connection_check();
		 $selqry="SELECT * FROM  coupons  order by coupon_id desc";  
		 $result=$this->db->query("$selqry"); 
			if($result->num_rows > 0)
			{		
				return $result->result();
			}
	}
	function cashback_details_cb($cateid)
	{
	$this->db->connection_check();
	$this->db->order_by('cbid ','desc');
	$this->db->where('store_id',$cateid);
		$result = $this->db->get('category_cashback');
		
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
		
	}
	function cashback_details_byid($cashbackid)
	{
	$this->db->connection_check();
	$this->db->where('cbid',$cashbackid);
		$result = $this->db->get('category_cashback');
		
		if($result->num_rows > 0){
			return $result->row();
		}
		return false;
		
	}
	function get_typehead_citys_list($query)
	{
		$this->db->connection_check();
		$this->db->like('city_name', $query);	
		$query = $this->db->get('citys');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	function get_messages_full()
	{
			$this->db->select('messages.*,tbl_users.*');
			$this->db->from('messages');
			$this->db->join('tbl_users', 'messages.user_id = tbl_users.user_id', 'inner');
			$this->db->group_by('messages.user_id');
			$query = $this->db->get();
			if($query->num_rows>0){
				return $query->result();
			}else {
				return false;
			}
	}
	function get_messages_user($id)
	{
		    $this->db->select('messages.*,tbl_users.*');
			$this->db->from('messages');
			$this->db->join('tbl_users', 'messages.user_id = tbl_users.user_id', 'inner');
			$this->db->where('messages.user_id',$id);
			$query = $this->db->get();
			if($query->num_rows>0){
				return $query->result();
			}else {
				return false;
			}
	}
	function insert_support_message()
	{	
			
			$data = array('user_id'=>$this->input->post('user_id'),
					  'subject' =>$this->input->post('subject'),
					  'content' =>$this->input->post('message'),
					  'datetime' =>date('Y-m-d H:i:s'),
					  'type' =>'receive');

		$this->db->insert('messages',$data);

	}
	// sharmila store reviews..
	function storereview(){
		$this->db->connection_check();		
		$res = $this->db->query("SELECT * FROM (store_review) ORDER BY `store_review_id` desc");
		
		if($res->num_rows>0){
			return $res->result();
		}
			return false;
	}
	function storereviews_delete(){
		$this->db->connection_check();
		$sort_order = $this->input->post('chkbox');		
			foreach($sort_order as $key=>$val)
			 {
					$delete_id = $key;
					$this->db->delete('store_review',array('store_review_id'=>$delete_id)); 
			 }
		return true; 
	 }
	 
	function get_storename($cis,$uid)
	{
	 $this->db->connection_check();
	 //echo $uid;die;
	 $this->db->where('user_id',$uid);
	 $result = $this->db->get('tbl_users');
	//echo $this->db->last_query();die;
		if($result->num_rows > 0){
			$uresult = $result->row();
			$uname = $uresult->first_name;
		}else{
			$uname = '';
		}	
	 $this->db->where('shoppingcoupon_id',$cis);	
		$result = $this->db->get('shopping_coupons');
		if($result->num_rows > 0){
			$uresult = $result->row();
			$cname = $uresult->offer_name;
			$seo_url = $uresult->seo_url;
		}else{
			$cname = '';
			$seo_url = '';
		}
		return $uname.",".$cname.",".$seo_url;
	}
	function change_storestatus($id,$status)
	{
		$this->db->connection_check();
		if($status==1) $var=0;
		else $var=1;
			$data = array(
			'status'=>$var,			
			);
			$this->db->where('store_review_id',$id);
			$updation = $this->db->update('store_review',$data);	
	}
	
	//manage sub admin
	function check_sub_admin($email){
		$this->db->where('admin_email',$email);
		$res = $this->db->get('admin');
		if($res->num_rows > 0){
			return 0;	// exists.. failure..
		} else {
			return 1;	// not exists.. success..
		}
	}
	
	//add sub admin details
	function add_sub_admin($admin_logo){
	$main_access = serialize(array_filter($this->input->post('main_access')));
		 $sub_access = serialize(array_filter($this->input->post('sub_access')));
		if($_POST['perm'])
			$perm = serialize($_POST['perm']);
		else
			$perm = 'a:1:{i:0;s:1:"0";}';
		
		$data = array(
			'admin_username'=>$this->input->post('name'),
			'admin_password'=>$this->input->post('password'),
			'admin_email'=>$this->input->post('email'),
			'admin_logo'=>$admin_logo,
			// 'gender'=>$this->input->post('gender'),
			// 'job_role'=>$this->input->post('job_role'),
			// 'city'=>$this->input->post('city'),
			'contact_number'=>$this->input->post('number'),
			'contact_info'=>$this->input->post('content'),
			'status'=>$this->input->post('status'),
			'permission'=>$perm,
			'role'=>'sub',
			'main_access'=>$main_access,
			'sub_access'=>$sub_access
		);
		
		$ins = $this->db->insert('admin',$data);
		if($ins!=""){ 
			return true;
		} else { 
			return false;
		}
	}
	
	// fetch sub admin detail..
	function fetch_sub_admin(){		
		$this->db->where('role','sub');
		$this->db->order_by('admin_id','desc');
		$fetch = $this->db->get('admin');
		if($fetch->num_rows>0){
			return $fetch->result();
		}
		return false;
	}
	
	// edit sub admin detail..
	function get_sub_admin($ids){		
		$this->db->where('admin_id',$ids);
		$fetch = $this->db->get('admin');
		if($fetch->num_rows>0){
			return $fetch->row();
		}
		return false;
	}
	
	// update sub admin details..
	function update_sub_admin($admin_logo){
		
		$main_access = serialize(array_filter($this->input->post('main_access')));
			 $sub_access = serialize(array_filter($this->input->post('sub_access')));

		if($_POST['perm'])
			$perm = serialize($_POST['perm']);
		else
			$perm = 'a:1:{i:0;s:1:"0";}';

		if($this->input->post('password')!='')
			$password = $this->input->post('password');
		else
			$password = '';
		
		 

		$data = array(
			'admin_username'=>$this->input->post('name'),
			'admin_password'=>$password,
			'admin_email'=>$this->input->post('email'),
			'admin_logo'=>$admin_logo,
			// 'gender'=>$this->input->post('gender'),
			// 'job_role'=>$this->input->post('job_role'),
			// 'city'=>$this->input->post('city'),
			'contact_number'=>$this->input->post('number'),
			'contact_info'=>$this->input->post('content'),
			'status'=>$this->input->post('status'),
			'permission'=>$perm,
			'role'=>'sub',
			'main_access'=>$main_access,
			'sub_access'=>$sub_access
		);
		
		$this->db->where('admin_id',$this->input->post('admin_id'));
		$updation = $this->db->update('admin',$data);
		//echo $this->db->last_query();die;

		if($updation!=""){
			return true;
		} else { 
			return false;
		}
	}
	
	// delete sub admin..
	function delete_sub_admin($sub_admin_id){
	
		$this->db->delete('admin',array('admin_id'=>$sub_admin_id));
		return true;
	}
	
	function multi_delete_subadmin(){
		if($this->input->post('chkbox')) {
		  $sort_order = $this->input->post('chkbox');
		  foreach($sort_order as $key=>$val) {
				$this->db->where('admin_id',$key);
				$upd = $this->db->delete('admin');
		  }
			return true;
		}
	}
	
	function get_admin_pages(){	
		$fetch = $this->db->get('adminpages');
		if($fetch->num_rows>=1){
			return $fetch->result();
		} else {
			return false;
		}
	}
	function get_admin_pages1($id='')
	{	
	if($id!="")
	{
		$id=$id;
	}
	else
	{
		$id=0;
	}

	$this->db->where('sub_id',$id);
		$fetch = $this->db->get('admin_page_new');
		//echo $this->db->last_query();die;
		if($fetch->num_rows>=1){
			return $fetch->result();
		} else {
			return false;
		}
	}
	function get_admin_pages2($id='')
	{	
	if($id!="")
	{
		$id=$id;
	}
	else
	{
		$id=0;
	}

	$this->db->where('sub_id',$id);
		$fetch = $this->db->get('admin_page_new');
		//echo $this->db->last_query();die;
		if($fetch->num_rows>=1){
			return $fetch->result();
		} else {
			return false;
		}
	}
	function pending_cashback($type){
		if($type=='1-week')
		{
			 $type=date('Y-m-d',strtotime('-1 week'));
		}
		elseif($type=='15-days')
		{
			 $type=date('Y-m-d',strtotime('-15 day'));
		}
		elseif($type=='1-month')
		{
			 $type=date('Y-m-d',strtotime('-1 month'));
		}
		elseif($type=='2-months')
		{
			 $type=date('Y-m-d',strtotime('-2 month'));
		}
		else
		{
		$type=0;
		}
		
		$this->db->connection_check();
		if($type!=0){
		$this->db->where('date_added >=',$type);
		}
		$this->db->where('status','Pending');
		$this->db->order_by('cashback_id','desc');
		$this->db->order_by('date_added','desc');
		$result = $this->db->get('cashback');
		
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	function approve_cashback($cashback_id){
		$res=$this->input->post();
	
		$this->db->connection_check();
	
		
						
		$this->db->where('cashback_id',$cashback_id);
		$cb = $this->db->get('cashback');
		$user_id ='';
		if($cb){
			$cb_r = $cb->row();
			$user_id = $cb_r->user_id;
			if($res['status']=='success')
			{
				$transation_status='Paid';
			}
else
	{
		$transation_status='Pending';
	}
			/*transaction details add */
			$data = array(
							'payid' => $res['mihpayid'],
							'transation_status' => $transation_status,
							'txn_id' => $res['txnid'],
							'user_id'=>	$user_id,
							'transation_reason'=>'Pending Referal Payment',
							'transation_amount'=>$res['net_amount_debit'],
							'mode'=>'debited',
							'transation_date'=>$res['addedon']
						);
					
						$this->db->insert('transation_details',$data);		
									
						$trans = $this->db->insert_id();
						/* transaction end */
				if($trans)
				{		
			$cashback_amount = $cb_r->cashback_amount;
		
			$user = $this->view_user($user_id);
			if($user){
				foreach($user as $single){
					$balance = $single->balance;
					$balance = $single->balance;
					$user_email = $single->email;
					$user_name = $single->first_name.' '.$single->last_name;
				}
				$this->db->where('user_id',$user_id);
				$this->db->update('tbl_users',array('balance'=>$balance+$cashback_amount));
				
				//$ins_data = array('user_id'=>$user_id,'transation_amount'=>$cashback_amount,'mode'=>'Credited','transation_date'=>date('Y-m-d'),'transation_status'=>'Paid','transation_reason'=>'Cashback');
			
				//$this->db->insert('transation_details',$ins_data);
			
				$data = array('status'=>'Completed','txn_id'=>$trans);
				$this->db->where('cashback_id',$cashback_id);
				$this->db->update('cashback',$data);
				
				/* mail for pending cashback */
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
				
				$this->db->where('mail_id',10);
				$mail_template = $this->db->get('tbl_mailtemplates');
				if($mail_template->num_rows >0) 
				{
				   $fetch = $mail_template->row();
				   $subject = $fetch->email_subject;
				   $templete = $fetch->email_template;
				   $url = base_url().'cashback/my_earnings/';
				   
					/*$this->load->library('email');
					
					$config = Array(
						'mailtype'  => 'html',
						'charset'   => 'utf-8',
					);*/
					
					$sub_data = array(
						'###SITENAME###'=>$site_name
					);
					$subject_new = strtr($subject,$sub_data);
					
					/*$this->email->initialize($config);
					 $this->email->set_newline("\r\n");
					   $this->email->initialize($config);
					   $this->email->from($admin_email);
					   $this->email->to($user_email);
					   $this->email->subject($subject_new);*/
				   
					$data = array(
						'###NAME###'=>$user_name,
						'###COMPANYLOGO###' =>base_url()."uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
						'###AMOUNT###'=>$cashback_amount
				    );
				   
				   $content_pop=strtr($templete,$data);
				   // echo $content_pop; echo $subject_new;
				/*   $this->email->message($content_pop);
				   $this->email->send();  */

				   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
				}
				/* mail for pending cashback */

				// /*approve pending referral */
				// $this->db->where('cashback_id',$cashback_id);
				// $cashbacks = $this->db->get('cashback');
				// $cashback_data = $cashbacks->row();
				// if($cashback_data->referral!=0){
					// $this->db->where('trans_id',$cashback_data->txn_id);
					// $txn = $this->db->get('transation_details');
					// $txn_detail = $txn->row();
					// if($txn_detail){
						// $txn_id = $txn_detail->trans_id;
						// $ref_user_id = $txn_detail->user_id;
						// $transation_amount = $txn_detail->transation_amount;
						// $refer_user = $this->view_user($ref_user_id);
						// if($refer_user){
							// foreach($refer_user as $single){
								// $referral_balance = $single->balance;
								// $user_email = $single->email;
								// $user_name = $single->first_name.' '.$single->last_name;
							// }
							// $this->db->where('user_id',$ref_user_id);
							// $this->db->update('tbl_users',array('balance'=>$referral_balance+$transation_amount));
// 							
							// $data = array('transation_status'=>'Paid','transation_reason'=>'Referal Payment');
							// $this->db->where('trans_id',$txn_id);
							// $this->db->update('transation_details',$data);
							// /* mail for pending referral */
							// $this->db->where('admin_id',1);
							// $admin_det = $this->db->get('admin');
							// if($admin_det->num_rows >0) 
							// {    
								// $admin = $admin_det->row();
								// $admin_email = $admin->admin_email;
								// $site_name = $admin->site_name;
								// $admin_no = $admin->contact_number;
								// $site_logo = $admin->site_logo;
							// }
// 							
							// $date =date('Y-m-d');
// 							
							// $this->db->where('mail_id',11);
							// $mail_template = $this->db->get('tbl_mailtemplates');
							// if($mail_template->num_rows >0) 
							// {
							   // $fetch = $mail_template->row();
							   // $subject = $fetch->email_subject;
							   // $templete = $fetch->email_template;
							   // $url = base_url().'cashback/my_earnings/';
// 							   
								// $this->load->library('email');
// 								
								// $config = Array(
									// 'mailtype'  => 'html',
									// 'charset'   => 'utf-8',
								// );
// 								
								// $sub_data = array(
									// '###SITENAME###'=>$site_name
								// );
								// $subject_new = strtr($subject,$sub_data);
// 								
								// // $this->email->initialize($config);
								 // $this->email->set_newline("\r\n");
								   // $this->email->initialize($config);
								   // $this->email->from($admin_email);
								   // $this->email->to($user_email);
								   // $this->email->subject($subject_new);
// 							   
								// $data = array(
									// '###NAME###'=>$user_name,
									// '###COMPANYLOGO###' =>base_url()."uploads/adminpro/".$site_logo,
									// '###SITENAME###'=>$site_name,
									// '###ADMINNO###'=>$admin_no,
									// '###DATE###'=>$date,
									// '###AMOUNT###'=>$transation_amount
								// );
// 							   
							   // $content_pop=strtr($templete,$data);
							  // // echo $subject_new;  echo $content_pop;exit;
							   // $this->email->message($content_pop);
							   // $this->email->send();  
							// }
							// /* mail for pending referral */
						// }
					// }
				// }
			}
			}
			return true;
		}
		return false;
	}
	
	function pending_referral(){
		$this->db->connection_check();
		$this->db->select("*");
		$this->db->from("transation_details");
		$this->db->where('transation_reason','Pending Referal Payment');
		$this->db->order_by("trans_id", "desc");
		$result = $this->db->get();
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	function approve_referral($txn_id){
		$this->db->connection_check();
		$this->db->where('trans_id',$txn_id);
		$txn = $this->db->get('transation_details');
		if($txn){
			$txn_detail = $txn->row();
			$user_id = $txn_detail->user_id;
			$transation_amount = $txn_detail->transation_amount;
			
			$refer_user = $this->view_user($user_id);
			if($refer_user){
				foreach($refer_user as $single){
					$referral_balance = $single->balance;
				}
				$this->db->where('user_id',$user_id);
				$this->db->update('tbl_users',array('balance'=>$referral_balance+$transation_amount));
				
				$data = array('transation_status'=>'Paid','transation_reason'=>'Referal Payment');
				$this->db->where('trans_id',$txn_id);
				$this->db->update('transation_details',$data);
				return true;
			}
		}
		return false;
	}
	
	function check_active_user($user_id){
		
		$this->db->where('user_id',$user_id);
		$this->db->where('status','1');
		$this->db->where('admin_status','');
		$ret = $this->db->get('tbl_users');
		if($ret->num_rows>0){
			return 1;
		}
		return 0;
	}
	
	function getallcurrencies()
	{
		$this->db->connection_check();
        $query = $this->db->get('currency');
        if($query->num_rows >= 1)
		{
           return $query->result();
        }
        return false;
	}
	
	function getcurrency()
	{		
		$default_currency = $this->session->userdata('default_currency');
		if(!$default_currency)
		{
			$this->db->where('admin_id',1);
			$query = $this->db->get('admin');
			if($query->num_rows >= 1)
			{
			   $row = $query->row('default_currency');
			   $default_currency_sym = $this->getallcurrencies_byid($row);			   
  		       $this->session->set_userdata('default_currency',$default_currency_sym->symbol);
			   $this->session->set_userdata('default_currency_code',$default_currency_sym->currency_code);
			}
		}
	}
	
	function getallcurrencies_byid($id)
	{
		$this->db->connection_check();
		$this->db->where('currency_id',$id);
        $query = $this->db->get('currency');
        if($query->num_rows >= 1)
		{
           return $query->row();
        }
        return false;
	}
	
	/*seetha 07.09.15*/
	//view all banners
	function affiliate_network(){
		$this->db->connection_check();
		$this->db->order_by('id','desc');
		$affiliate_network = $this->db->get('affiliates_list');
		if($affiliate_network->num_rows > 0)
		{
			return $affiliate_network->result();		
		}
		return false;
	}
	// addaffiliate_list
	function addaffiliate_list($img){
	$this->db->connection_check();
		$data = array(
			'affiliate_network'=>$this->input->post('affiliate_name'),			
			'api_key'=>$this->input->post('api_key'),
			'networkid'=>$this->input->post('networkid'),
			'tracking_id'=>$this->input->post('tracking_id'),
			'affiliate_logo'=>$img,
			'status'=>$this->input->post('affiliate_status')
		);	
		$this->db->insert('affiliates_list',$data);
		return true;
	}
	//edit affiliate_list
	function get_affiliate_list($id){
	$this->db->connection_check();
		$this->db->where('id',$id);
		$affiliates = $this->db->get('affiliates_list');
		if($affiliates->num_rows > 0){
			return $affiliates->result();
		}
		return false;
	}
	// update affiliate_list
	function updataffiliate_list($img){
	$this->db->connection_check();
	$affiliate_id = $this->input->post('affiliate_id');
	$data = array(
		'affiliate_network'=>$this->input->post('affiliate_name'),
		'api_key'=>$this->input->post('api_key'),
		'networkid'=>$this->input->post('networkid'),
		'tracking_id'=>$this->input->post('tracking_id'),
		'affiliate_logo'=>$img,
		'status'=>$this->input->post('affiliate_status')		
	);
	$this->db->where('id',$affiliate_id);
	$update = $this->db->update('affiliates_list',$data);
		if($update!="")
		{
			return true;
		}
		else 
		{ 
			return false;   
		}
	}
	//  deleteaffiliate_list
	function deleteaffiliate_list($delete){ 
		$this->db->connection_check();
		$this->db->delete('affiliates_list',array('id' => $delete));
		return true;
	}
	function delete_multi_affiliatenetworks()
	 {
		 $this->db->connection_check();
		  $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			$id = $key;		
			$this->db->delete('affiliates_list',array('id' => $id));			
		 }
		 return true;
	 }
	function import_coupons($content)
	{
		//print_r($content);exit;
		$tracking =$this->input->post('tracking_id');
		$coupon_type = '';
		if(count($content)!=0){
			$array = array();
			$duplicate = 0;
			$duplicate_promo_id = '';		
			//print_r($content);exit;
			//unset($content['data'][0][0]);
			//unset($content['data'][0][1]);
		//	unset($content['data'][0][2]);
			foreach($content as $cont){
				
				$new_category_id='';
				
				if (array_key_exists('coupon_description', $cont)) 
				{
					$description =$this->db->escape_str($cont['coupon_description']);
				}	
				else
				{
					$description = '';
				}

				
				if (array_key_exists('category', $cont)) 
				{
				//	echo 'cate';
					$category_name =$this->db->escape_str($cont['category']);
				}	
				else
				{
					$category_name = '';
									
				}
				
				
				//echo $description;exit;
				if (array_key_exists('coupon_code', $cont)) 
				{
					$code =$this->db->escape_str($cont['coupon_code']);
				
				}else					
				{						
					$code = '';
				}
				if (array_key_exists('link', $cont)) 
				{
					$offer_page =$this->db->escape_str($cont['link']);
				
				}else					
				{						
					$offer_page = '';
				}
				//print_r($content['data']);exit;
				
				$cont_offname =$this->db->escape_str($cont['offer_name']);					
				$offname =preg_split("/[ ]/", $cont_offname); 
				$name =preg_split("/[.]/", $offname[0]);
				//print_r($name);exit;
				//echo $name[0], "<br />"; exit; 

			
				$offer_name =mysql_real_escape_string($name[0]);
			//	$offer_url =$offname[0]; 
				$offer_url  = $this->admin_model->seoUrl($name[0]);
				//print_r($offer_url);die;
				$promo_id = $cont['promo_id'];
				$title = $this->db->escape_str($cont['coupon_title']);
			 	//$description = $this->db->escape_str($cont['coupon_description']);
				//$category_name = $this->db->escape_str($cont['category']);
				$type = $cont['coupon_type'];
				//$code = $cont['coupon_code'];
				//$offer_page = $this->db->escape_str($cont['link']);				
				$expiry_date = date('m/d/Y',strtotime($cont['coupon_expiry']));
				$start_date = date('m/d/Y',strtotime($cont['added']));
				$featured = $cont['featured'];
				$exclusive = $cont['exclusive'];
				
				
				//add new category name
				if($category_name!=""){	
                     // echo 'yes_cate';				
					//$category_name = $this->db->escape_str($cont['category']);				
					$this->db->where('category_name',$category_name);
					$cat = $this->db->get('categories');
					if($cat->num_rows()==0){
						//  echo 'ssss';'
						$seo_url  = $this->admin_model->seoUrl($category_name);
						$data = array(
							'category_name' => $category_name,
							'category_url' => $seo_url,
							'category_status' => 1,						
						);
						$this->db->insert('categories',$data);					
						$new_category_id = $this->db->insert_id();
						$new_subcategory_id = '';
					} else{
						$rst = $cat->row();
						$new_category_id = $rst->category_id;
						$new_subcategory_id = '';
					}					
				}
				else
				{
					$category_name='other categories';
					$seo_url  = $this->admin_model->seoUrl($category_name);
					$this->db->where('category_name',$category_name);
					$get_cat=$this->db->get('categories');
					if($get_cat->num_rows()>0)
					{
						$rst = $get_cat->row();
						$new_category_id = $rst->category_id;
						$new_subcategory_id = '';
					}
					else
					{
					$data = array(
							'category_name' => $category_name,
							'category_url' => $seo_url,
							'category_status' => 1,						
						);
						$this->db->insert('categories',$data);					
						$new_category_id = $this->db->insert_id();
						$new_subcategory_id = '';	
						
					}
					
				}
				
				//Add new store name
				$this->db->where('affiliate_name',$offer_name);
				$aff = $this->db->get('affiliates');
				if($aff->num_rows()==0){
					$data = array(
						'affiliate_name' => $offer_name,
						'affiliate_url' => $offer_url,
						'store_categorys'=> $new_category_id,
						'affiliate_status' => '1',
					);
					$this->db->insert('affiliates',$data);
					$new_store_id = $this->db->insert_id();
				}else{
					$result = $aff->row();
					$new_store_id = $result->affiliate_id;
				}
				
				$this->db->where('promo_id',$promo_id);
				$result = $this->db->get('coupons');
				//echo $result->num_rows;
				if($result->num_rows == 0){					
					if($offer_name)
					{				
						
						$this->db->query("INSERT INTO `coupons` (`offer_name`, `promo_id`, `title`, `description`, `category_name`, `type`, `code`, `offer_page`, `start_date`,`expiry_date`,`featured`,`exclusive`,
						`Tracking`,`coupon_status`) VALUES ('$name[0]', '$promo_id','$title', '$description','$new_category_id','$type', '$code', '$offer_page', '$start_date','$expiry_date','$featured','$exclusive','$tracking','1')");
					}
				}else{
					$duplicate+=1;
					$duplicate_promo_id .= $promo_id.', ';
				}
				unset($cont);
			}
			$array['duplicate'] = $duplicate;
			$array['promo_id'] = rtrim($duplicate_promo_id,', ');
		}
		//print_r($array);die;
		return $array;		
	}
	
	
	function import_reports($content)
	{
               
             	$now = date('Y-m-d H:i:s');	
		$last_updated = $now;
		//$tracking =$this->input->post('tracking_id');
		$name = $this->db->query("select * from admin")->row();	
		$ref_cashbcak_percent =  $name->referral_cashback;	
		if(count($content)!=0)
		{
			$array = array();
			$duplicate = 0;
			$duplicate_trans_id = '';	
			if($content['response']['data']['data']!='')
			{
				$sampless =0;
				foreach($content['response']['data']['data'] as $cont){	
					$sampless++;
                   /* echo '<pre>';				
					 print_r($cont); */
					 $offer_provider =$this->db->escape_str($cont['Offer']['name']);
					//$offname =split ("\ ", $offer_provider); 
					$offname = explode(" ", $offer_provider, 2);					
					$offerurl_id=$this->db->escape_str($cont['OfferUrl']['id']);
					$offerurl_name=$this->db->escape_str($cont['OfferUrl']['name']);
					 $tracking1=$cont['Stat']['affiliate_info1'];
					
					if($tracking1!=''){
						$tracking_id = $tracking1;
					}else{
						$tracking_id = '';
						continue;
					}
					//$tracking_id= 'KDID230149';
					
					//echo $get_userid =  decode_userid($tracking_id);
					$get_userid=134;
					if($get_userid<=0 || $get_userid=='' )
					{
						continue;
					}
					$expdem = explode('.',$offer_provider);
					 $storenam = $expdem[0];
					$storeslisty = $this->get_offer_provider_cashback($storenam);
					 $store_id = $storeslisty->affiliate_id;
					$cashback_percentage = $storeslisty->cashback_percentage;
					$sale_amount = $cont['Stat']['sale_amount'];
					$approved_payout = $cont['Stat']['approved_payout'];
					if($storeslisty->affiliate_cashback_type=='Percentage')
					{	
						$cashback_amount = number_format(($approved_payout*$cashback_percentage)/100,2);
					}
					else
					{
						$cashback_amount =0;
						if($approved_payout>$cashback_percentage)
						{
							$cashback_amount = number_format(($cashback_percentage),2);
						}
					}
					$check_ref = $this->check_ref_user($get_userid);
					$ref_cashback_amount = 0;
					$ref_id = 0;
					$referred = 0;
					$txn_id_new = 0;
					if($check_ref>0)		
					{
						$ref_id  = $check_ref;
						$return = $this->check_active_user($ref_id);
						if($return==1)
						{
							$referred = 1;
							$ref_cashback_percent = $ref_cashbcak_percent;
							$ref_cashback_amount = number_format(($cashback_amount*$ref_cashbcak_percent)/100,2);
						}
					}
					
					$total_Cashback_paid = $cashback_amount+$ref_cashback_amount;
					
					$is_cashback = 1;	
					$affiliate_cashback_type=$storeslisty->affiliate_cashback_type;
					$transaction_id=$cont['Stat']['ad_id'];					
					$pay_out_amount =$cont['Stat']['approved_payout'];
					$sale_amount =$cont['Stat']['sale_amount'];
					 $date = $cont['Stat']['datetime'];
					$date1=date('Y-m-d',strtotime($cont['Stat']['datetime']));
					$date2=date('Y-m-d H',strtotime($cont['Stat']['datetime']));
					$offerid = $cont['Stat']['offer_id'];
					$status = $cont['Stat']['conversion_status'];
					
					 $this->db->like('store_name',$storenam);
					 $this->db->like('date_added',$date2);
					$this->db->where('DATE(date_added)',$date1);
					$this->db->where('user_id',$get_userid);
					
					$this->db->where('status',0);
					$result1=$this->db->get('click_history');
					echo $this->db->last_query();
					
					if($result1->num_rows >0)
					{
					$click_id=$result1->row('click_id');
					$this->db->where('click_id',$click_id);
					$array=array('status'=>1);
					$this->db->update('click_history',$array);
					
					
					// $this->db->where('transaction_id',$transaction_id);
					$this->db->where('date',$date);
					$this->db->where('sale_amount',$sale_amount);
					$result = $this->db->get('tbl_report');
					
					 
					$now = date('Y-m-d H:i:s');	
					$last_updated = $now;
					if($result->num_rows == 0)
					{ 
						$results = $this->db->query("INSERT INTO `tbl_report` (`offer_provider`, `date`, `pay_out_amount`, `sale_amount`, `transaction_id`, `user_tracking_id`, `last_updated`, `is_cashback`, `cashback_percentage`, `affiliate_cashback_type`,`cashback_amount`, `ref_id`, `ref_cashback_percent`,`ref_cashback_amount`,`total_Cashback_paid`, `status`) VALUES ('$storenam', '$date', '$pay_out_amount', '$sale_amount', '$transaction_id','$get_userid', '$last_updated', '$is_cashback', '$cashback_percentage', '$affiliate_cashback_type','$cashback_amount', '$ref_id','$ref_cashback_percent','$ref_cashback_amount','$total_Cashback_paid','$status');");	
						$insert_id = $this->db->insert_id();
						if($is_cashback!=0)	
						{	
							$now = date('Y-m-d H:i:s');	
							$mode = "Credited";	
							if($ref_cashback_amount!=0)	
							{
								$data = array(			
									'transation_amount' => $ref_cashback_amount,	
									'user_id' => $ref_id,	
									'transation_date' => $now,	
									'transation_reason' => 'Pending Referal Payment',	
									'mode' => $mode,	
									'details_id'=>'',	
									'table'=>'',	
									'transation_status' => 'Progress');
								$this->db->insert('transation_details',$data);
								$txn_id_new = $this->db->insert_id();
							}
		
							$data = array(
							'user_id' => $get_userid,	
							'coupon_id' => $storenam,	
							'affiliate_id' => $storenam,	
							'status' => 'Pending',	
							'cashback_amount'=>$cashback_amount,	
							'date_added' => $date,
							'referral' => $referred,
							'txn_id' => $txn_id_new
							);	
							$this->db->insert('cashback',$data);	
						
						/* mail for pending cashback */
						$user_detail = $this->view_user($get_userid);
						if($user_detail){
							foreach($user_detail as $user_detail_single){
								$referral_balance = $user_detail_single->balance;
								$user_email = $user_detail_single->email;
								$user_name = $user_detail_single->first_name.' '.$user_detail_single->last_name;
							}
						}
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
						
						$this->db->where('mail_id',10);
						$mail_template = $this->db->get('tbl_mailtemplates');
							if($mail_template->num_rows >0) 
							{
							   $fetch = $mail_template->row();
							   $subject = $fetch->email_subject;
							   $templete = $fetch->email_template;
							   // $url = base_url().'cashback/my_earnings/';
							   
								/*$this->load->library('email');
								
								$config = Array(
									'mailtype'  => 'html',
									'charset'   => 'utf-8',
								);*/
								
								$sub_data = array(
									'###SITENAME###'=>$site_name
								);
								$subject_new = strtr($subject,$sub_data);
								
								/*$this->email->initialize($config);
								 $this->email->set_newline("\r\n");
								   $this->email->initialize($config);
								   $this->email->from($admin_email);
								   $this->email->to($user_email);
								   $this->email->subject($subject_new);*/
							   
								$data = array(
									'###NAME###'=>$user_name,
									'###COMPANYLOGO###' =>base_url()."uploads/adminpro/".$site_logo,
									'###SITENAME###'=>$site_name,
									'###ADMINNO###'=>$admin_no,
									'###DATE###'=>$date,
									'###AMOUNT###'=>$cashback_amount
								);
							   
							   $content_pop=strtr($templete,$data);
							    //$content_pop; echo $subject_new;
								
							  /* $this->email->message($content_pop);
							   $this->email->send();  */
							   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
							}
						/* mail for pending cashback */
						}	
					}
					else{
						$duplicate+=1;
						$duplicate_trans_id .= $transaction_id.', ';
					}
					}
				}
				$array['duplicate'] = $duplicate;
				$array['trans_id'] = rtrim($duplicate_trans_id,', ');
			}			
		}
		//print_r($array);die;
		return $array;	
	}
	
	/*Nathan Oct 30*/
	/*Get all specfications*/
	function specifications()
	{
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('parant_id',0);
		$result = $this->db->get('specifications');
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
			return false;
	}
	
	/*function active_specifications()
	{
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('parant_id',0);
		$this->db->where('specification_status',1);
		$result = $this->db->get('specifications');
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
			return false;
	}*/

	function active_specifications()
{
	$this->db->connection_check();
	$result=$this->db->query("SELECT * FROM specifications where parant_id in(select specid from specifications where parant_id=0) and specification_status=1 order by specification Asc");
	    if($result->num_rows > 0)
	    {
	        return $result->result();                
	    }
	        return false;
}
	
	
	/*Sort specification New*/
	function sort_specification_new()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('sort_arr');
		 foreach($sort_order as $key=>$val)
		 {
			  $data = array(
				'sort_order'=>$val			
				);
			$this->db->where('specid',$key);
			$updation = $this->db->update('specifications',$data);	
		 }
		 return true;
			
	 }
	 	/*Sort Specification delete*/
	  function sort_specification_new_delete()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			 $id = $key;
			// get order of specifications which is to be deleted.
			$start_order = $this->db->get_where('specifications',array('specid'=>$id))->row('sort_order');
			
			$this->db->select_max('sort_order');
			$get_max = $this->db->get('specifications');
			$gets = $get_max->result();
			foreach($gets as $get){
				$end_order = $get->sort_order;
			}
	
			$this->db->delete('specifications',array('specid' => $id));
			$newval = $start_order;
			for($inc=$start_order; $inc<=$end_order;$inc++){
				$newval = $newval + 1;
				$data = array('sort_order'=>$inc);
				$this->db->where('sort_order',$newval);
				$this->db->update('specifications',$data);
			}
			
		 }
		 return true;
			
	 }
	 	 	/*Sort Specification delete*/
	 	/*Check Spec order*/
	 function change_spec_order($old_order,$new_order){
		$this->db->connection_check();
		// fetching spec id using sort_order id..
		$old_category = $this->db->get_where('specifications',array('sort_order'=>$old_order))->row('specid');
		$new_category = $this->db->get_where('specifications',array('sort_order'=>$new_order))->row('specid');
		
		$data1 = array('sort_order'=>$new_order);
		$this->db->where('specid',$old_category);
		$this->db->update('specifications',$data1);
		
		$data2 = array('sort_order'=>$old_order);
		$this->db->where('specid',$new_category);
		$updation = $this->db->update('specifications',$data2);
		if($updation!="")
		{
			return true;
		}
		else 
		{ 
			return false;
		}		
	}
	/*Check Spec order*/
	/*get_maxspecifications*/
	function get_maxspecifications(){
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('specifications');
		return $get_max->result();
	}
	/*get_maxspecifications*/
	
	// add new specifications
	function add_specifications()
	{	
		$this->db->connection_check();
		if(!$this->input->post('parant_id'))
		{
			$testres = 0;
		}
		else
		{
			$testres = $this->input->post('parant_id');
		}		
		$this->db->select_max('sort_order');
		$this->db->where('parant_id',$testres);
		$get_max = $this->db->get('specifications');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$seo_url  = $this->admin_model->seoUrl($this->input->post('specification'));
		$trimspecification = trim($this->input->post('specification'));
		$data = array(
			'specification'=>$trimspecification,
			'specification_status'=>$this->input->post('specification_status'),
			'sort_order'=>$maxval,
			'parant_id' => $this->input->post('parant_id')
		);	
		$this->db->insert('specifications',$data);
		return true;
	
	}
	// add new specifications
	/*Check specfication*/
	function check_specfic($specification)
	{
		$this->db->connection_check();
		$this->db->where('specification',$specification);
		$qry = $this->db->get('specifications');
		//echo $this->db->last_query();
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
	/*Check specfication*/
	
	// edit specification
	function get_specification($specification_id){
	$this->db->connection_check();
		$this->db->where('specid',$specification_id);
        $query = $this->db->get('specifications');
        if($query->num_rows >= 1)
		{
           return $query->row();
        }
        return false;	
	}
	/*edit specfication*/
	
	/*update specfication*/
	function update_specification()
	{
			$this->db->connection_check();
			$seo_url  = $this->admin_model->seoUrl($this->input->post('specification'));
			$trimspecification = trim($this->input->post('specification'));
			$data = array(
			'specification'=>$trimspecification,
			'specification_status'=>$this->input->post('specification_status'),
			'specification_url'=>$seo_url,
			'parant_id'=>$this->input->post('parant_id')
			);
			$id = $this->input->post('specid');
			$this->db->where('specid',$id);
			$upd = $this->db->update('specifications',$data);
			if($upd){
				return true;
			}
			else{
				return false;
			}
	}
	/*update specfication*/
	
	/*delete specfication*/
	function deletespecfication($id)
	{
		$this->db->connection_check();	
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('specifications',array('specid'=>$id))->row('sort_order');		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('specifications');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('specifications',array('specid' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('specifications',$data);
		}
		return true;
	}		
	/*delete specfication*/
	
	/*specification options*/
	function specification_options($specid)
	{
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('parant_id',$specid);
		$result = $this->db->get('specifications');
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
		return false;
	}
	/*specification options*/
	
	
	// view all Brands..
	function brands(){
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$result = $this->db->get('brands');
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}
	
	function active_brands(){
		$this->db->connection_check();
		$this->db->where('brand_status','1');
		$this->db->order_by('sort_order');
		$result = $this->db->get('brands');
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}
	
	
	function get_details_from_id($value,$table,$field)
	{		
		$this->db->connection_check();
		$this->db->where($field,$value);
        $query = $this->db->get($table);
	/* 	echo '<pre>';
		print_r($query->row());die; */
        if($query->num_rows >= 1)
		{
           return $query->row();
        }
        return false;	
	}
	
	function get_details_from_id_array($value,$table,$field)
	{		
		$this->db->connection_check();
		$this->db->where($field,$value);
        $query = $this->db->get($table);
        if($query->num_rows >= 1)
		{
           return $query->result();
        }
        return false;	
	}
	
	function get_details_from_id_dynamic($value,$table,$field)
	{		
		$this->db->connection_check();
		$s=0;
		foreach($field as $valkey)
		{
			$this->db->where($valkey,$value[$s]);
			$s++;
		}
        $query = $this->db->get($table);
        if($query->num_rows >= 1)
		{
           return $query->row();
        }
        return false;	
	}
	
	//check brand exeit
	function check_brand($brandid)
	{
		$this->db->connection_check();
		$this->db->where('brand_id',$brandid);
		$qry = $this->db->get('brands');
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
	
	//check brand exeit
	function addbrand($brand_image=NULL,$brandarr=NULL)
	{
		$this->db->connection_check();
		$brandna = $this->input->post('brand_name');
		if($brandna)
		{
			$brand_status = $this->input->post('brand_status');
			$popular_brand = $this->input->post('popular_brand');
		}
		else
		{
			$brandna = $brandarr['brand_name'];
			$brand_status = $brandarr['brand_status'];
			$popular_brand = $brandarr['popular_brand'];
		}
				
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('brands');
		$gets = $get_max->result();
		foreach($gets as $get){$max_val = $get->sort_order;}
		$maxval = $max_val + 1;
		$brand_namess = trim($brandna);
		$seo_url  = $this->admin_model->seoUrl($brand_namess);
		$data = array(
			'brand_name'=>$brand_namess,
			'sort_order'=>$maxval,
			'brand_image'=>$brand_image,
			'brand_status'=>$brand_status,
			'popular_brand'=>$popular_brand,
			'brand_url'=>$seo_url,
		);	
		$this->db->insert('brands',$data);
		return true;
	}	
	
	
	//get brand details
	
	function get_brand($brand_id){
	$this->db->connection_check();
		$this->db->where('brand_id',$brand_id);
        $query = $this->db->get('brands');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $row;
        }
        return false;	
	}
	
	//update brand
	function update_brand($brand_image)
	{
		
		$this->db->connection_check();
		$seo_url  = $this->admin_model->seoUrl($this->input->post('brand_name'));
		$data = array(
		'brand_name'=>$this->input->post('brand_name'),
		'brand_image'=>$brand_image,
		'brand_status'=>$this->input->post('brand_status'),
		'popular_brand'=>$this->input->post('popular_brand'),
		'brand_url'=>$seo_url
		);
		$id = $this->input->post('brand_id');
		$this->db->where('brand_id',$id);
		$upd = $this->db->update('brands',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	
	}
	
	
		// delete Brand
	function deletebrand($id)
	{
		$this->db->connection_check();	
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('brands',array('brand_id'=>$id))->row('sort_order');
		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('brands');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('brands',array('brand_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;
			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('brands',$data);
		}
		return true;
	}
	
	
	// get maximum brand order..
	function get_maxbrand(){
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('brands');
		return $get_max->result();
	}
	
	//sort_order_update
	 function sort_order_update($tablename,$fieldname)
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('sort_arr');
		 foreach($sort_order as $key=>$val)
		 {
			  $data = array(
				'sort_order'=>$val			
				);
			$this->db->where($fieldname,$key);
			$updation = $this->db->update($tablename,$data);	
		 }
		 return true;
			
	 }
	
	
	
	//sort_order_delete 
	 function sort_order_new_delete($tablename,$fieldname)
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
		 foreach($sort_order as $key=>$val)
		 {
			 $id = $key;
		
			// get order of category which is to be deleted.
			$start_order = $this->db->get_where($tablename,array($fieldname=>$id))->row('sort_order');
			
			$this->db->select_max('sort_order');
			$get_max = $this->db->get($tablename);
			$gets = $get_max->result();
			foreach($gets as $get){
				$end_order = $get->sort_order;
			}
	
			$this->db->delete($tablename,array($fieldname => $id));
			$newval = $start_order;
			for($inc=$start_order; $inc<=$end_order;$inc++){
				$newval = $newval + 1;
				$data = array('sort_order'=>$inc);
				$this->db->where('sort_order',$newval);
				$this->db->update($tablename,$data);
			}
			
		 }
		 return true;
			
	 }
	 
	 // get maximum brand order..
	function get_max_from_table($tablename,$fieldname){
		$this->db->connection_check();
		$this->db->select_max($fieldname);
		$get_max = $this->db->get($tablename);
		return $get_max->row();
	}
	
	
	//check brand exeit
	function check_details_in_db($tablename,$fieldname,$value,$level=NULL)
	{
		$this->db->connection_check();
		if($level)
		{
			$this->db->where('category_level',$level);
		}
		$this->db->where($fieldname,$value);
		$qry = $this->db->get($tablename);
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
	 
	 
	/*Nathan Oct 30*/
	
	/*Nathan Nov 01*/
	/*Get all specfications*/
	function product_categories($level)
	{
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('parent_id',$level);
		$this->db->where('cate_id !=', '0');
		$result = $this->db->get('product_categories');
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
			return false;
	}
	
	function count_sub_cate($cate_id)
	{	
		$this->db->select('count(*) as cout'); 
		$this->db->where('parent_id',$cate_id);
		$result = $this->db->get('product_categories');
		return $result->row();	
	}
	
	// add new product category
	function add_product_categories($category_image,$category_icon){
		$this->db->connection_check();
		if(!($this->input->post('category_specifications'))){$category_specifications='';}else{$category_specifications = implode(',',$this->input->post('category_specifications'));}
		if(!($this->input->post('category_brands'))){$category_brands ='';}else{$category_brands = implode(',',$this->input->post('category_brands'));}
		if(!($this->input->post('main_category_specifications'))){$main_category_specifications ='';}else{$main_category_specifications = implode(',',$this->input->post('main_category_specifications'));}
		$this->db->select_max('sort_order');
		$this->db->where('parent_id',$this->input->post('parent_id'));
		$this->db->where('category_level',$this->input->post('category_level'));	
		$get_max = $this->db->get('product_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$category_namess = trim($this->input->post('category_name'));
		$seo_url  = $this->admin_model->seoUrl($category_namess);
		if(!$this->input->post('parent_id'))
		{
			$parent = 0;
		}
		else
		{
			$parent =  $this->input->post('parent_id');
		}
		
		$active_store=serialize(array_filter($this->input->post('active_store')));
		$data = array(
			'category_name'=>$category_namess,
			'meta_keyword'=>$this->input->post('meta_keyword'),
			'meta_description'=>$this->input->post('meta_description'),
			'sort_order'=>$maxval,
			'category_image'=>$category_image,
			'category_status'=>$this->input->post('category_status'),
			'top_category'=>$this->input->post('top_category'),
			'parent_id'=>$parent,
			'category_level'=>$this->input->post('category_level'),
			'category_specifications'=>$category_specifications,
			'main_category_specifications'=>$main_category_specifications,
			'category_brands'=>$category_brands,
			'category_icon'=>$category_icon,
			'category_url'=>$seo_url,
			'active_store'=>$active_store,
			'price_compare'=>$this->input->post('price_compare'),
			
		);	
		$this->db->insert('product_categories',$data);
		return true;
	}	
	
	
		//update category
		function update_product_category($category_image,$category_icon)
		{
			$this->db->connection_check();
			
			if(!($this->input->post('category_specifications'))){$category_specifications='';}else{$category_specifications = implode(',',$this->input->post('category_specifications'));}
			if(!($this->input->post('category_brands'))){$category_brands ='';}else{$category_brands = implode(',',$this->input->post('category_brands'));}
		$active_store=serialize(array_filter($this->input->post('active_store')));
		if(!($this->input->post('main_category_specifications'))){$main_category_specifications ='';}else{$main_category_specifications = implode(',',$this->input->post('main_category_specifications'));}
			$category_namess = trim($this->input->post('category_name'));
			$seo_url  = $this->admin_model->seoUrl($category_namess);
			$data = array(
				'category_name'=>$category_namess,
				'meta_keyword'=>$this->input->post('meta_keyword'),
				'meta_description'=>$this->input->post('meta_description'),
				'category_image'=>$category_image,
				'category_status'=>$this->input->post('category_status'),
				'top_category'=>$this->input->post('top_category'),
				'parent_id'=>$this->input->post('parent_id'),
				'category_level'=>$this->input->post('category_level'),
				'category_icon'=>$category_icon,
				'category_url'=>$seo_url,
				'category_specifications'=>$category_specifications,
				'main_category_specifications'=>$main_category_specifications,
				'category_brands'=>$category_brands,
				'active_store'=>$active_store,
				'price_compare'=>$this->input->post('price_compare'),				
			);	
		
		$id = $this->input->post('cate_id');
		$this->db->where('cate_id',$id);
		$upd = $this->db->update('product_categories',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	// delete category
	function delete_product_category($id)
	{
		$this->db->connection_check();	
		$start_order = $this->db->get_where('product_categories',array('cate_id'=>$id))->row('sort_order');
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('product_categories');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$get_specification = $this->get_details_from_id($id,'product_categories','cate_id');
		$categoryimg 	= $get_specification->category_image;
		$categoryicon 	= $get_specification->category_icon;
		$categoryimg_path = './uploads/product_category/'.$categoryimg;
		$categoryicon_path = './uploads/product_category/'.$categoryicon;
		unlink($categoryimg_path);
		unlink($categoryicon_path);
		if($get_specification->cate_id!=0)
		{
			$get_specification_child = $this->get_details_from_id_array($id,'product_categories','parent_id');
			foreach($get_specification_child as $childs)
			{
				$categoryimg 	= $childs->category_image;
				$categoryicon 	= $childs->category_icon;
				$categoryimg_path = './uploads/product_category/'.$categoryimg;
				$categoryicon_path = './uploads/product_category/'.$categoryicon;
				unlink($categoryimg_path);
				unlink($categoryicon_path);
			}
		}
		$this->db->delete('product_categories',array('cate_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('product_categories',$data);
		}
		return true;
	}
	
	 function sort_order_new_delete_category($tablename,$fieldname)
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
		 if(count($sort_order)!=0)
		 {
			 foreach($sort_order as $key=>$val)
			 {
				$this->delete_product_category($key);			
			 }
		 }
		 return true;
			
	 }
	
	
	/*Nathan Nov 01*/
	/*Nathan Nov 07*/
	
	// view all Brands..
	function scrapping(){
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$result = $this->db->get('scrapping');
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}

// view all Brands..
	function scrapping_list(){
		$this->db->connection_check();
		$this->db->order_by('sort_order');
                $this->db->where('store_status',1);
		$result = $this->db->get('scrapping');
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}
	
	
	//ganesh 2-4-2016
	function scrapping_list1($pid)
		{
		$this->db->connection_check();
		
		$this->db->select('b.active_store');
		$this->db->from('products a');
		$this->db->join('product_categories b', 'a.parent_child_id = b.cate_id', 'left');
		$this->db->where('a.product_id', $pid);
		$results = $this->db->get();
		//echo $this->db->last_query();die;
		if($results->num_rows > 0)
		{
		$arr=$results->result();
		$stores=implode(',',unserialize($arr[0]->active_store));
		}
			
		$this->db->where_in('affiliate_id',unserialize($arr[0]->active_store));		
       	$result = $this->db->get('affiliates');
		
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
		}
	//add scrapping
	function add_scrapping()
	{
		$this->db->connection_check();
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('scrapping');
		$gets = $get_max->result();
		foreach($gets as $get){
			$max_val = $get->sort_order;
		}
		$maxval = $max_val + 1;
		$data = array(
			'store_name'=>$this->input->post('store_name'),
			'sort_order'=>$maxval,
			'store_status'=>$this->input->post('store_status'),
			'description1'=>htmlspecialchars($this->input->post('description1')),
			'description'=>htmlspecialchars($this->input->post('description'))
		);	
		$this->db->insert('scrapping',$data);
		return true;
	}	
	
	
	function check_scrapping($scrap_id)
	{
		$this->db->where('store_name',$scrap_id);
		$get_max = $this->db->get('scrapping');
		return $get_max->row();
	}
	
	
	/*Nathan Nov 07*/
	
	/*Nathan Nov 11*/
	//update brand
	function update_scrapping()
	{		
		$this->db->connection_check();
		$data = array(
		'store_name'=>$this->input->post('store_name'),
		'store_status'=>$this->input->post('store_status'),
		'description1'=>htmlspecialchars($this->input->post('description1')),
		'description'=>htmlspecialchars($this->input->post('description'))
		);
		$id = $this->input->post('scrap_id');
		$this->db->where('scrap_id',$id);
		$upd = $this->db->update('scrapping',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	
	}
	
	
	// delete Scrapping
	function deletescrapping($id)
	{
		$this->db->connection_check();	
		// get order of category which is to be deleted.
		$start_order = $this->db->get_where('scrapping',array('scrap_id'=>$id))->row('sort_order');
		
		$this->db->select_max('sort_order');
		$get_max = $this->db->get('scrapping');
		$gets = $get_max->result();
		foreach($gets as $get){
			$end_order = $get->sort_order;
		}
		$this->db->delete('scrapping',array('scrap_id' => $id));
		$newval = $start_order;
		for($inc=$start_order; $inc<=$end_order;$inc++){
			$newval = $newval + 1;
			
			$data = array('sort_order'=>$inc);
			$this->db->where('sort_order',$newval);
			$this->db->update('scrapping',$data);
		}
		return true;
	}
	
	/*Nathan Nov 11*/
/*Anandan Nov 30*/
	
	function add_products($product_image){
		
		if($this->input->post('parent_child_id'))
			$parent_child_id = $this->input->post('parent_child_id');
		else
			$parent_child_id = '';
		
		if($this->input->post('child_id'))
			$child_id = $this->input->post('child_id');
		else
			$child_id = '';
		
		$seo_url  = $this->admin_model->seoUrl($this->input->post('product_name'));
		
		$data = array(
			'product_url' => $seo_url,	
			'product_name' => $this->input->post('product_name'),	
			'parent_id' => $this->input->post('parent_id'),	
			'parent_child_id' => $parent_child_id,
			'child_id' => $child_id,	
			'product_image' => $product_image,	
			'product_tags' => $this->input->post('product_tags'),
			'description' => addslashes($this->input->post('product_description')),	
			'key_feature' => addslashes($this->input->post('key_feature')),	
			'rating' => $this->input->post('rating'),
			'product_tags' => $this->input->post('product_tags'),
			'cashback_price' => $this->input->post('cashback_price'),
			'reward_points' => $this->input->post('reward_points'),
			'mrp' => $this->input->post('mrp'),
			'codAvailable' => $this->input->post('codAvailable'),
			'discount' => $this->input->post('discount'),
			'emiAvailable' => $this->input->post('emiAvailable'),
			'size' => $this->input->post('size'),
			'color' => $this->input->post('color'),
			'status' => '0',
			);
		
		$ins = $this->db->insert('products',$data);
		
		//echo $this->db->last_query();die;
		$insert_id = $this->db->insert_id();
		if($ins)
			return $insert_id;
		else
			return false;
	}
	
	// update product
	function update_products($product_image=null){
		$update_id = $this->uri->segment(3);
		$type = $this->input->post('type');
		
		if($type == 'general'){
			if($this->input->post('parent_child_id'))
				$parent_child_id = $this->input->post('parent_child_id');
			else
				$parent_child_id = '';
			
			if($this->input->post('child_id'))
				$child_id = $this->input->post('child_id');
			else
				$child_id = '';
			
			$seo_url  = $this->admin_model->seoUrl($this->input->post('product_name'));
			
			$data = array(
				'product_url' => $seo_url,	
				'product_name' => $this->input->post('product_name'),	
				'parent_id' => $this->input->post('parent_id'),	
				'parent_child_id' => $parent_child_id,
				'child_id' => $child_id,	
				'product_image' => $product_image,	
				'description' => addslashes($this->input->post('product_description')),	
				'key_feature' => addslashes($this->input->post('key_feature')),	
				'rating' => $this->input->post('rating'),
				'product_tags' => $this->input->post('product_tags'),
				'cashback_price' => $this->input->post('cashback_price'),
				'reward_points' => $this->input->post('reward_points'),
				'mrp' => $this->input->post('mrp'),
				'codAvailable' => $this->input->post('codAvailable'),
				'discount' => $this->input->post('discount'),
				'emiAvailable' => $this->input->post('emiAvailable'),
				'size' => $this->input->post('size'),
				'color' => $this->input->post('color'),
				'featured' => $this->input->post('featured')
			);
		}		
		
		$this->db->where('product_id',$update_id);
		$update = $this->db->update('products',$data);
		if($update)
			return $update_id;
		else
			return false;
	}
	 
	// fetch store details
	
	function fetch_store_url($store_id,$product_id)
	{
		$this->db->where(array('store_id'=>$store_id,'product_id'=>$product_id,'product_status'=>1));
		$query1= $this->db->get('product_price');
		if($query1->num_rows>0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$this->db->where(array('store_id'=>$store_id,'product_id'=>$product_id,'product_status'=>$status));
		$query = $this->db->get('product_price');
		//echo $this->db->last_query();
		if($query->num_rows>0)
		{
		return $query->row();
		}
	}
	
	//  update product store
	function update_products_store($product_id){
		$store_id = $this->input->post('store_id');
		$product_url = $this->input->post('product_url');
		$affiliate_url = $this->input->post('affiliate_url');
		$remove_store = $this->input->post('remove_store');
		
		$remove_list=implode(',',$remove_store);
		$data1 = array('removed_lists'=>$remove_list);
		$this->db->where('product_id',$product_id);
		$this->db->update('products',$data1);
		//print_r($product_urls);die;
		foreach($store_id as $key=>$store){
			
			$product 	= $product_url[$key];
			$affiliate  = $affiliate_url[$key];
			$pp_id=$this->input->post('product_urls_'.$store);
			if($product != '' && $affiliate != ''){
				$this->db->where('product_id',$product_id);
				$pr_qry=$this->db->get('products');
				//echo $this->db->last_query();
				if($pr_qry->num_rows>0)
				{
					 $price=$pr_qry->row('mrp');
				}
				
				$this->db->where(array('store_id'=>$store,'product_id'=>$product_id));
				$query = $this->db->get('product_price');
				
				if($query->num_rows == '0'){
					$data = array(
						'store_id' => $store,
						'product_id' => $product_id,
						'product_url' => $product,
						'affiliate_url' => $affiliate,
						'product_price'=>$price,
						'type' => 'product'
						);
						
					$result = $this->db->insert('product_price',$data);
				}else{
					$data = array(
						'product_url' => $product,
						'affiliate_url' => $affiliate,
						'product_status'=>1
						);
					$this->db->where(array('store_id'=>$store,'product_id'=>$product_id,'pp_id'=>$pp_id));	
					$result = $this->db->update('product_price',$data);
					
					$data = array(
						'product_status'=>0
						);
						$this->db->where(array('store_id'=>$store,'product_id'=>$product_id,));	
						$this->db->where('pp_id !=',$pp_id);	
						$result = $this->db->update('product_price',$data);
					
					echo '<br>'.$this->db->last_query();
				}
			}
		}
		return $product_id;
		
	}
	
	//update product specifications
	
	function update_products_specify($product_id){
		$product_type = $this->input->post('type');
		if($product_type == 'specify'){
			/*print_r(array_filter($this->input->post('spec_id')));
			print_r(array_filter($this->input->post('spec_option_id')));
			echo $spec_option_value = implode(',',array_filter($this->input->post('spec_option_id')));;
			print_r(array_filter($this->input->post('spec_extra')));
			exit;*/
			
			$specify_id = serialize(array_filter($this->input->post('spec_id')));
			$spec_option_id = serialize(array_filter($this->input->post('spec_option_id')));
			$spec_option_value = implode(',',array_filter($this->input->post('spec_option_id')));
			$spec_extra = serialize(array_filter($this->input->post('spec_extra')));
			if($specify_id !='' && $spec_option_id !='' && $spec_extra !=''){				
				$data = array(
					'specification' => $specify_id,
					'specification_option' => $spec_option_id,
					'specification_extra' => $spec_extra,
					'specify_option_id' => $spec_option_value,
					);				
				$this->db->where('product_id',$product_id);			
				$update = $this->db->update('products',$data);
			}
		}
		if($product_type == 'brands'){
			$brands = $this->input->post('brands');
			$this->db->where('product_id',$product_id);
			$update = $this->db->update('products',array('brands'=>$brands));
		}
		
		if($update)
			return $product_id;
		else
			return false;
		
		/*  
		if($specify_id){
			
			foreach($specify_id as $key=>$spec){
				echo $spec.'<br>';
				
				foreach($spec_option_id as $key=>$spec_option){
					echo '<br>'.$spec_option = $spec_option;
					
					echo '<br>'.$extra = $spec_extra[$key];
				}
			}
			
		}
		die; */
		
		
	}
	
	// upload galley
	
	function upload_product_gallery($image,$product_id){
		
		$data = array(
			'product_id' => $product_id,
			'image' => $image
		);
		
		$update = $this->db->insert('product_gallery',$data);
		if($update)
			return true;
		else
			return false;
		
	}
	
	function fetch_product($id){
		$this->db->where('product_id',$id);
		$query = $this->db->get('products');
		if($query->num_rows == '1'){
			return $query->row();
		}
			return false;
		
	}
	
	// fetch product gallery
	function fetch_product_gallery($product_id){
		
		$this->db->where('product_id',$product_id);
		$query = $this->db->get(' product_gallery');
		if($query->num_rows > 0)
			return $query->result();
		else
			return false;
	}
	
	//Delete product gallery
	function delete_product_gallery(){
		
		$img_id = $this->input->post('img_id');
		$product_id = $this->input->post('product_id');
		
		$this->db->where(array('gallery_id'=>$img_id,'product_id'=>$product_id));
		$del = $this->db->delete('product_gallery');
		if($del)
			return true;
		else
			return false;
	}
	
	//fetch specification
	function fetch_product_specification($product_id){
		$this->db->where('product_id',$product_id);
		$query = $this->db->get('products');
		if($query->num_rows() == 1){
			$row = $query->row();
			$parent_id = $row->parent_id;
			$parent_child_id = $row->parent_child_id;
			$child_id = $row->child_id;
			
			if($child_id != '0')
				$cate_id = $child_id;
			else if($parent_child_id != '0')
				$cate_id = $parent_child_id;
			else
				$cate_id = $parent_id;
			
			$result = $this->get_details_from_id($cate_id,'product_categories','cate_id');
			//print_r($result);die;
			return $result;
		}else
			return false;
	}
	
	//fetch specification
	function fetch_product_brand($product_id){
		$this->db->where('product_id',$product_id);
		$query = $this->db->get('products');
		if($query->num_rows() == 1){
			$row = $query->row();
			$parent_id = $row->parent_id;
			$parent_child_id = $row->parent_child_id;
			$child_id = $row->child_id;
			
			if($child_id != '0')
				$cate_id = $child_id;
			else if($parent_child_id != '0')
				$cate_id = $parent_child_id;
			else
				$cate_id = $parent_id;
			
			$result = $this->get_details_from_id($cate_id,'product_categories','cate_id');
			//print_r($result);die;
			return $result;
		}else
			return false;
	}
	
	//update product status
	function update_product_status($product_id,$status){
		$this->db->where('product_id',$product_id);
		$query = $this->db->get('product_price');
		//echo $this->db->last_query();die;
		if($query->num_rows() == 0){
			return 1;
		}else{
			$this->db->where('product_id',$product_id);
			$this->db->update('products',array('status'=>$status));
			return 2;
		}
	}
		
	//fetch all products
	
	function fetch_products($cat_id=null,$perpage=null,$urisegment=null){
		$this->db->order_by('sort_order');
		if($perpage!="")
		{
		$this->db->limit($perpage,$urisegment);
		}
		if($cat_id!="all")
		{
			$this->db->where('parent_child_id',$cat_id);
		}
		$this->db->order_by('product_id','desc');
		$query = $this->db->get('products');
		//echo $this->db->last_query();die;
		if($query->num_rows > 0)
			return $query->result();
		else
			return false;
	}
	
	function count_products($cat_id)
	{
		if($cat_id!="all")
		{
			$count = $this->db->select('product_id')->from('products')->
			where(array('parent_child_id'=>$cat_id))->count_all_results();	
		}
		else{
			$count = $this->db->select('product_id')->from('products')->count_all_results();
		}
		
		return $count;
	}
	
	//delete product by id
	function delete_product($id){
		$this->db->connection_check();
		$this->db->delete('products',array('product_id' => $id));
		$this->db->delete('product_gallery',array('product_id' => $id));
		$this->db->delete('product_price',array('product_id' => $id));
		return true;
	}
	
	/*Anandan Nov 30*/
	
	/*Seetha Nov 30*/	
	function api_coupons(){
		
		$this->db->connection_check();
		$this->db->order_by("coupon_id", "desc");
		$this->db->where("coupon_status", "0");
		$result = $this->db->get('coupons');
		//echo $this->db->last_query();exit;
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	function api_editcoupon($coupon_id){
	$this->db->connection_check();
	$this->db->where('coupon_id',$coupon_id);
	$this->db->where('coupon_status','0');
	$coupons = $this->db->get('coupons');
		if($coupons->num_rows > 0){
			return $coupons->result();
		}
		return false;
	}
	// update coupon details..
	function api_updatecoupon()
	{
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
		$this->db->where('coupon_status','0');
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
	function api_deletecoupon($delete_id){
		$this->db->connection_check();
		$this->db->delete('coupons',array('coupon_id'=>$delete_id,'coupon_status'=>'0'));
		return true;	
	} 
	function api_changestatus($id,$status)
	{
		$this->db->connection_check();
		if($status==1) $var=0;else $var=1;
			$data = array(
				'coupon_status'=>$var,
		);
		$this->db->where('coupon_id',$id);
		$updation = $this->db->update('coupons',$data);	
		if($updation){
			return true;
		}
		else{
			return false;
		}
	}
	function api_coupons_bulk_delete()
	{
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			 foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					 $this->db->delete('coupons',array('coupon_id'=>$delete_id,'coupon_status'=>'0'));
			 }
		return true;	
	}
	function api_download_free_coupons()
	{
		$this->db->connection_check();
		$selqry="SELECT * FROM  coupons  where coupon_status='0' order by coupon_id desc";  
		$result=$this->db->query("$selqry"); 
		if($result->num_rows > 0)
		{		
			return $result->result();
		}
	}
	function get_categoryname($id)
	{
		$this->db->connection_check();
		$this->db->where('category_id',$id);
		$query = $this->db->get('categories');
		if($query->num_rows == 1){
			return $query->row();
		}else{
			return false;		
		}	
	}
	// view all categories..
	function inactive_categories(){
		$this->db->connection_check();
		$this->db->order_by('sort_order','desc');
		$this->db->where('category_status','0');
		$result = $this->db->get('categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function api_changestatuscate($id,$status)
	{
		$this->db->connection_check();
		if($status==1) $var=0;else $var=1;
			$data = array(
				'category_status'=>$var,
		);
		$this->db->where('category_id',$id);
		$updation = $this->db->update('categories',$data);	
		if($updation){
			return true;
		}
		else{
			return false;
		}
	}
	function inactivecoupons_bulk_delete()
	{
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			 foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					 $this->db->delete('categories',array('category_id'=>$delete_id,'category_status'=>'0'));
					// echo $this->db->last_query();
			 };
		return true;	
	}
	/*Seetha Nov 30*/
	
/*Nathan Dec 08, 2015*/

   /*Dynamic Price Scrapping*/
    function scrapping_cron($lmt=null)
    {
		
		//$query = $this->db->query("delete n1 from product_price n1, product_price n2 WHERE n1.pp_id > n2.pp_id AND n1.store_id = n2.store_id AND n1.product_id = n2.product_id");
		//$this->db->where("product_price", '');
		//$this->db->where('store_id',239);
		$this->db->where("status",1);
       $this->db->where("product_url !=", '');
       
       $query1 = $this->db->get('product_price');
	   
	 $count=$query1->num_rows();
	 $start=round($count/10)*$lmt;
	 $limit=round($count/10);
		
		
		$this->db->where("status",0);
       $this->db->where("product_url !=", '');
       $this->db->limit($limit,$start);
       $query = $this->db->get('product_price');
	   //echo $this->db->last_query();die;
       if($query->num_rows >= 1)
       {
          return $query->result();
       }
       return false;
    }
	
    function gettags($store_id)
    {
       $this->db->where("store_name =", $store_id);
       $query = $this->db->get('scrapping');
       if($query->num_rows >= 1)
       {
          return $query->row();
       }
       return false;
    }
    function update_cron_price_repeat($final_price, $request_id)
    {
       $state = 0;
	   if($final_price['out_stock']=="This item is out of stock." || $final_price['out_stock']=="Currently unavailable." || $final_price['out_stock']=="Currentlyunavailable." || $final_price['out_stock']=="Sold Out" ||
$final_price['out_stock']=="Out of Stock" || $final_price['out_stock']=="Out of Stock." ||
$final_price['out_stock']=="Oops The product you are looking for is currently out of stock." || $final_price['out_stock']=="No offer for sale on Naaptol.")
	   {
		   $stock=2;
	   }
	   else
	   {
		   $stock=1;
	   }
       $data = array('product_price'=>$final_price['prices'],'state'=>$state,'stock'=>$stock,'rating'=>$final_price['rating'],'date_time'=>date('Y-m-d H:i:s'),'status'=>1);
       $this->db->where('pp_id',$request_id);
       $update_qry = $this->db->update('product_price',$data);
	   echo $this->db->last_query();
	   echo "<br>";
       if($update_qry){
           return true;
       }else{ 
           return false;
       }
    }

    function update_cron_price($final_price, $request_id)
    {
		
       $state = 0;
	   if($final_price['out_stock']=="This item is out of stock." || $final_price['out_stock']=="Currently unavailable." || $final_price['out_stock']=="Currentlyunavailable." || $final_price['out_stock']=="Sold Out" ||
$final_price['out_stock']=="Out of Stock" || $final_price['out_stock']=="Out of Stock." ||
$final_price['out_stock']=="Oops The product you are looking for is currently out of stock." || $final_price['out_stock']=="No offer for sale on Naaptol.")
	   {
		   $stock=2;
	   }
	   else
	   {
		   $stock=1;
	   }
       $data = array('product_price'=>$final_price['prices'],'state'=>$state,'stock'=>$stock,'rating'=>$final_price['rating'],'date_time'=>date('Y-m-d H:i:s'),'status'=>1);
       $this->db->where('pp_id',$request_id);
       $update_qry = $this->db->update('product_price',$data);
	   echo $this->db->last_query();
	   echo "<br>";
       if($update_qry){
           return true;
       }else{ 
           return false;
       }
    }



    function scrapping_cron_repeat()
    {
		//$query = $this->db->query("delete n1 from product_price n1, product_price n2 WHERE n1.pp_id > n2.pp_id AND n1.store_id = n2.store_id AND n1.product_id = n2.product_id");		
       
      
	   //$this->db->where('store_id',$sid);
	   //$this->db->where('pp_id <',12593);
	   $this->db->where("product_url !=", '');
       $this->db->where("status",0);
       $query = $this->db->get('product_price');
	   echo $this->db->last_query();
       if($query->num_rows >= 1)
       {
          return $query->result();
       }
       return false;
    }
    /*Dynamic Price Scrapping*/

    /*Nathan Dec 08, 2015*/
     /*Seetha Dec 10 2015*/
	 //Rewards sections 
	function rewards(){
		$this->db->connection_check();
		$this->db->order_by('rewards_id','desc');
		$this->db->where('rewards_status','1');
		$result = $this->db->get('rewards');
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}
	function addrewards($rewards_image)
	{
		$this->db->connection_check();
		$cob_coins = trim($this->input->post('cob_coins'));
		$rewards_title = trim($this->input->post('rewards_title'));
		$rewards_status = trim($this->input->post('rewards_status'));
		$data = array(
			'cob_coins'=>$cob_coins,
			'rewards_title'=>$rewards_title,
			'rewards_image'=>$rewards_image,
			'rewards_status'=>$rewards_status
		);	
		$this->db->insert('rewards',$data);
		return true;
	}	
	//edit rewards
	function get_rewards($id){
	$this->db->connection_check();
		$this->db->where('rewards_id',$id);
		$banner = $this->db->get('rewards');
		if($banner->num_rows > 0){
			return $banner->result();
		}
		return false;
	}
	
	// update rewards
	function updaterewards($img){
		$this->db->connection_check();
		$rewards_id = $this->input->post('rewards_id');
		$data = array(
			'cob_coins'=>$this->input->post('cob_coins'),
			'rewards_title'=>$this->input->post('rewards_title'),
			'rewards_image'=>$img,
			'rewards_status'=>$this->input->post('rewards_status')		
		);
		$this->db->where('rewards_id',$rewards_id);
		$update = $this->db->update('rewards',$data);
		if($update!="")
		{
			return true;
		}
		else 
		{ 
			return false;   
		}
	}
	
	// delete rewards
	function deleterewards($delete){ 
		$this->db->connection_check();
		$this->db->delete('rewards',array('rewards_id' => $delete));
		return true;
	}
	function rewards_settings(){
		$this->db->connection_check();
		$this->db->where('res_id','1');
		$query_admin = $this->db->get('rewards_details');
		if($query_admin->num_rows >= 1){
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else
		{
			return false;		
		}	
	}
	function updaterewards_settings()
	{
		$this->db->connection_check();
		$data = array(
			'cob_coins'=>$this->input->post('cob_coins'),		
			'terms_conditions'=>$this->input->post('terms_conditions'),
			'status'=>$this->input->post('status'),
			'max_points'=>$this->input->post('max_points')	
		);
		$id = $this->input->post('res_id');
		$this->db->where('res_id',$id);
		$upd = $this->db->update('rewards_details',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	function get_allrewards_faqs(){
		$this->db->connection_check();
		$this->db->order_by('faq_id','desc');
		$allrewardsfaqs = $this->db->get('rewards_faqs');
		if($allrewardsfaqs->num_rows > 0)
        {
            $row = $allrewardsfaqs->row();
            return $allrewardsfaqs->result();
        }
		else
		{
			return false;
		}
	}
	
	// add new faq..
	function addrewardsfaqs(){
		$this->db->connection_check();
		$data = array(
		'faq_qn' => $this->input->post('faq_qn'),
		'faq_ans' => $this->input->post('faq_ans'),
		'status' => '1'
		);
		
		$this->db->insert('rewards_faqs',$data);
		return true;
	}
	// get particular faq
	function get_rewardsfaqcontent($id){
		$this->db->connection_check();
		$this->db->where('faq_id',$id);
        $query = $this->db->get('rewards_faqs');
        if($query->num_rows >= 1)
		{
           $row = $query->row();
           return $query->result();
        }
        return false;
	}
	
	// update faq details..
	function updaterewardsfaq(){
		$this->db->connection_check();
		$data = array(
			'faq_qn' => $this->input->post('faq_qn'),
			'faq_ans' => $this->input->post('faq_ans'),
			'status' =>  $this->input->post('status')
		);
		$id =  $this->input->post('faq_id');
		$this->db->where('faq_id',$id);
		$upd = $this->db->update('rewards_faqs',$data);
		if($upd){
			return true;
		}
		else{
			return false;
		}
	}
	
	// delete faq..
	function deleterewardsfaq($id)
	{
		$this->db->connection_check();
		$this->db->delete('rewards_faqs',array('faq_id' => $id));
		return true;
	}
	
	/*Dynamic Price Scrapping New*/
	function fetch_product_details($product_url)
	{
		$cnt = $this->db->query("select * from products a join product_price b on a.product_id=b.product_id where a.product_url='$product_url' and b.product_status=1");
		if($cnt->num_rows() > 0)
		{
			$c=1;
		}
		else
		{
			$c=0;
		}
		
		$query = $this->db->query("select * from products t2 join(select COUNT(distinct(t1.store_id)) Totalstores,t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from  products p left join product_price t1 on t1.store_id=p.default_store where t1.product_price > 0 and t1.product_status=$c group by t1.product_id)a on a.product_id = t2.product_id where t2.product_url='$product_url'");
		
		
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return $query->row();
		}else
			return false;
	}
	
	
	function update_product_current_price($product_id, $min_price,$todaydate)
	{
		$data = array(
		'product_id' => $product_id,
		'price' => $min_price,
		'date' => $todaydate
		);
		$this->db->insert('product_dailly_price',$data);
		return true;
	}
	
	/*Dynamic Price Scrapping New*/
	
	/*Seetha Dec 10 2015*/
    /*Seetha Dec 19 2015*/
	function check_product($product,$proid=NULL)
	{
		$this->db->connection_check();
		$this->db->where('product_name',$product);
		$qry = $this->db->get('products');
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
   /*Seetha Dec 19 2015*/

        function comparison_details($product_id)
	{
		$this->db->select('*');
		$this->db->from('product_price a');
		$this->db->join('affiliates b', 'a.store_id = b.affiliate_id', 'left');
		$this->db->where('a.product_id', $product_id);
		$this->db->where('a.product_price >', 0);
		$this->db->order_by("a.product_price", "asc");
		$query = $this->db->get(); 
		if($query->num_rows() != 0)
		{
			return $query->result();				
		}
		return false;
	}
	
	
	// function bulkproduct($bulkproduct){
	  	// $this->db->connection_check();
		// $coupon_type = '';
		// $this->load->library('CSVReader');
		// $main_url = 'uploads/products_csv/'.$bulkproduct;
	 	// $result =   $this->csvreader->parse_file($main_url);
		 // echo "<pre>";
		  // print_r($result);
		  // exit;
		// if(count($result)!=0)
		// {		
			// foreach($result as $res)
			// {
				// if(strtolower($res['inStock'])=='false'){continue;}
			
				// if(strtolower($res['inStock'])=='true')			//change to true
				// {
					// @extract($res);
					// if($categories)
					// {
						// if (stripos($categories, "nodeId=") !== false){continue;}						
						
						// $catexp = explode('>',$categories);
						// if(count($catexp)<1){continue;}
						// $countcat = count($catexp);
						// $endarraay = end($catexp);
						// $categorystring = $endarraay;
						
						// if($endarraay=='Handsets')
						// {
							// $categorystring = 'Mobile Phones';
						// }
						// $last_cate_id_details = $this->get_last_cate_id($categorystring);
					// /*	if(!$last_cate_id_details)
						// {
							// $new_categorystring = $catexp[$countcat-2];
							// $last_cate_id_details = $this->get_last_cate_id($new_categorystring);
						// }*/
						// if($last_cate_id_details)
						// {
							// $child_id = 0;
							// if($last_cate_id_details->category_level==2)
							// {
								// $child_id = $last_cate_id_details->cate_id;
								// $parent_child_id = $last_cate_id_details->parent_id;
								// $getparentid = $this->get_details_from_id($parent_child_id,'product_categories','cate_id');;
								// $parent_id =  $getparentid->parent_id;
							// }
							// else
							// {	
								// $parent_child_id = $last_cate_id_details->cate_id;
								// $parent_id =  $last_cate_id_details->parent_id;
								// $child_id = 0;
							// }
						// }
						// else
						// {
							// $categories_count = count($catexp);
							// if($categories_count>3)
							// {
								// unset($catexp[0]);
								// $procatearray = $this->add_product_category_dynamic($catexp);
							// }
							// else
							// {
								// $procatearray = $this->add_product_category_dynamic($catexp);
							// }
							// $parent_id =  $procatearray[0];
							// $parent_child_id = $procatearray[1];							
							// $child_id = $procatearray[2];
								
						// }
					// }
					// else{continue;}
					// $product_url  = $this->admin_model->seoUrl($title);
					// $prodetails = $this->get_details_from_id($product_url,'products','product_url');
					// $relation_id  = '';
					// if($prodetails)
					// {
						// $colorname		= str_replace(array('[',']'), "", $color);
						// $product_name	=	$title.' '.$colorname;
						// $product_url  	= $this->admin_model->seoUrl($product_name);
						// $relation_id	= $prodetails->product_id;
					// }
					// else{$product_name = $title;}
					// $checkbrand = $this->get_details_from_id($productBrand,'brands','brand_name');
					
					// if($checkbrand){$brands = $checkbrand->brand_id;}
					// else
					// {		
						// $brandarray = array('brand_name'=>$productBrand,'brand_status'=>1,'popular_brand'=>0);
						// $this->addbrand('',$brandarray);
					// }
					
					// if($imageUrlStr)
					// {
						// $product_imaghes = explode(';',$imageUrlStr);
						// list($pro_image) = $product_imaghes;						
						// $product_image =  basename($pro_image);  
					// }
					
					
				// /*Insert New Product*/
					// $data = array(
						// 'product_url' => $product_url,	
						// 'product_name' => $product_name,	
						// 'parent_id' => $parent_id,	
						// 'parent_child_id' => $parent_child_id,
						// 'child_id' => $child_id,	
						// 'product_image' => $product_image,	
						// 'description' => $description,	
						// 'key_feature' => '',
						// 'brands'=>$brands,
						// 'mrp' =>$mrp,
						// 'codAvailable'=>$codAvailable,
						// 'emiAvailable'=>$emiAvailable,
						// 'discount' => $discount,
						// 'size'	=> $size,						
						// 'color'	=> $color,
						// 'sizeUnit'	=> $sizeUnit,						
						// 'status' => '1',
					// );
					// $ins = $this->db->insert('products',$data);
					// $lastinsidpro = $this->db->insert_id();
					// /*Insert New Product*/
					
					// /*Insert product gallery*/					
					// if($imageUrlStr)
					// {
								// $proimage_name =  basename($product_imaghes[0]);  
								// file_put_contents('uploads/products/'.$proimage_name, file_get_contents($product_imaghes[0]));
								// $this->upload_product_gallery($proimage_name,$lastinsidpro);
					// }
					// /*Insert product gallery*/	
					
					// /*Current date price update*/
					// $todaydate =  'Date.UTC('.date("Y").','.date("m").','.date("d").')';
					// $this->update_product_current_price($lastinsidpro, $price,$todaydate);
					// /*Current date price update*/
					
					
					// /*Insert product into product price table*/
					// $store_id = 85;
					// $product_idsss = $lastinsidpro;
					// $affiliate_url = $productUrl;
					// $product_urlss = str_replace('http://dl.flipkart.com/dl','http://www.flipkart.com',$affiliate_url);
					// $product_price = $price;
					// $type = 'product';
					// $state = 0;
					// $data = array(
						// 'store_id' => $store_id,
						// 'product_id' => $product_idsss,
						// 'product_url' => $product_urlss,
						// 'affiliate_url' => $affiliate_url,
						// 'type' => 'product',
						// 'product_price'=>$product_price
					// );						
					// $result = $this->db->insert('product_price',$data);
					// /*Insert product into product price table*/
					// $this->insert_specifications_from_url($product_idsss,$product_urlss);
				// }
			// }
		// }
		
		
		// return true;
	// }
	
	
	//gaensh
	
	function bulkproduct_old($bulkproduct){
	  	$this->db->connection_check();
		$coupon_type = '';
		$this->load->library('CSVReader');
		$main_url = 'uploads/products_csv/'.$bulkproduct;
	 	$result =   $this->csvreader->parse_file($main_url);
		 //echo "<pre>";
		  //print_r($result);
		$select_cat= $this->input->post('category_products');
		 print_r($select_cat);
		if(count($result)!=0)
		{		
			foreach($result as $res)
			{
				if(strtolower($res['inStock'])=='false'){continue;}
			
				if(strtolower($res['inStock'])=='true')			//change to true
				{
					@extract($res);
					if($categories)
					{
						if (stripos($categories, "nodeId=") !== false){continue;}						
						
						$catexp = explode('>',$categories);
						if(count($catexp)<1){continue;}
						$countcat = count($catexp);
						if($countcat>3)
						{
							unset($catexp[0]);
						}
						$endarraay = end($catexp);
						$categorystring = $endarraay;
						$crct='';
						if($endarraay=='Handsets')
						{
							$categorystring = 'Mobile Phones';
						}
						if(in_array('Women',$catexp))
						{
							$crct=20184;
							 if (($key = array_search('Ethnic Wear', $catexp)) !== FALSE) {
							$catexp[$key] = 'Ethnic Clothing';
    }
						}
						if(in_array('Men',$catexp))
						{
							$crct=20176;
						}
						if(in_array('Baby Gear',$catexp))
						{
						 $crct=20195;
						}
						if (($key = array_search('Higher VAT Rate', $catexp)) !== FALSE) 
						{
							unset($catexp[$key]);
						}
						if (($key = array_search('Lower VAT Rate', $catexp)) !== FALSE) 
						{
							unset($catexp[$key]);
						}	
						
						$last_cate_id_details = $this->get_last_cate_id($categorystring);
												
						/*if(!$last_cate_id_details)
						{
							$new_categorystring = $catexp[$countcat-2];
							$last_cate_id_details = $this->get_last_cate_id($new_categorystring);
						}*/
						
						if($last_cate_id_details=="")
						{
							$last_cate_id_details=$this->get_last_cate_id($catexp[$countcat-2]);
							$first_cate_name=$catexp[$countcat-3];
						}
						else if($last_cate_id_details=="")
						{
							$last_cate_id_details=$this->get_last_cate_id($catexp[$countcat-3]);
							$first_cate_name=$catexp[$countcat-4];
						}
						else if($last_cate_id_details=="")
						{
							if($catexp[$countcat-4]!="")
						{
						$last_cate_id_details=$this->get_last_cate_id($catexp[$countcat-4]);
							$first_cate_name=$catexp[$countcat-5];						
						}
						}
						else
						{
							$last_cate_id_details=$last_cate_id_details;
							$first_cate_name=$catexp[$countcat-2];
						}
						print_r($last_cate_id_details);
						if($last_cate_id_details)
						{
							$child_id = 0;
							
							if($last_cate_id_details->category_level==2)
							{
								
								$parent_child_id1 = $last_cate_id_details->parent_id;
								$getparentid = $this->get_details_from_id($parent_child_id1,'product_categories','cate_id');
								$new_parent_id=$getparentid->parent_id;
								if($getparentid->category_level==1)
								{
									//echo "dfsdfsd5";die;
									if($crct!="")
									{
									 $parent_id=$crct;
									}
									else
									{
								 $parent_id =  $getparentid->parent_id;
									}
									 $child_id = $last_cate_id_details->cate_id;
									 $parent_child_id = $last_cate_id_details->parent_id;
									//die;
									
								}
								else
								{
									
								//echo "dfsdfsd4";die;
									$getparentid1 = $this->get_details_from_id($getparentid->parent_id,'product_categories','cate_id');
									if($crct!="")
									{
									$parent_id=$crct;
									}
									else
									{
									  $parent_id=$getparentid1->parent_id;
									}
									 $parent_child_id=$new_parent_id;
								  $child_id=$last_cate_id_details->parent_id;
									
								}
								
								
							}
							else if($last_cate_id_details->category_level==1)
							{
								$getparentid2 = $this->get_details_from_id($last_cate_id_details->parent_id,'product_categories','cate_id');
								if($getparentid2->category_level==1)
								{
									//echo "dfsdfsd3";die;
									if($crct!="")
									{
									$parent_id=$crct;
									}
									else
									{
								 $parent_id=$getparentid2->parent_id;
									}
								  $parent_child_id = $last_cate_id_details->parent_id;
								$child_id=$last_cate_id_details->cate_id;
								}
								else
								{
								//echo "dfsdfsd2";
								if($crct!="")
									{
									echo $parent_id=$crct;
									}
									else
									{
								 echo $parent_id=$last_cate_id_details->parent_id;
									}
								 echo $parent_child_id = $last_cate_id_details->cate_id;
								 echo $child_id=0;
								}
								
							
							}
							else
							{
								//echo "dfsdfsd1";die;
								$getparentid1 = $this->get_details_from_id($last_cate_id_details->parent_id,'product_categories','cate_id');
								
								if($crct!="")
									{
									$parent_id=$crct;
									}
									else
									{
									 $parent_id=$getparentid1->parent_id;
									}
									 $parent_child_id=$last_cate_id_details->parent_id;;
									 $child_id=0;
									
									
							}
							
						}
						
						else
						{
							//echo "dfsdfsd";die;
							$categories_count = count($catexp);
							if($categories_count>3)
							{
								unset($catexp[0]);
								$procatearray = $this->add_product_category_dynamic($catexp,$crct);
							}
							else
							{
								$procatearray = $this->add_product_category_dynamic($catexp,$crct);
							}
							if($crct!="")
									{
									$parent_id=$crct;
									}
									else
									{
							$parent_id =  $procatearray[0];
									}
							$parent_child_id = $procatearray[1];							
							$child_id = $procatearray[2];
								
						}
					}
					else{continue;}
					$product_url  = $this->admin_model->seoUrl($title);
					$prodetails = $this->get_details_from_id($product_url,'products','product_url');
					$relation_id  = '';
					if($prodetails)
					{
						$colorname		= str_replace(array('[',']'), "", $color);
						$product_name	=	$title.' '.$colorname;
						$product_url  	= $this->admin_model->seoUrl($product_name);
						$relation_id	= $prodetails->product_id;
					}
					else{$product_name = $title;}
					$checkbrand = $this->get_details_from_id($productBrand,'brands','brand_name');
					
					if($checkbrand){$brands = $checkbrand->brand_id;}
					else
					{		
						$brandarray = array('brand_name'=>$productBrand,'brand_status'=>1,'popular_brand'=>0);
						$this->addbrand('',$brandarray);
					}
					
					if($imageUrlStr)
					{
						$product_imaghes = explode(';',$imageUrlStr);
						list($pro_image) = $product_imaghes;						
						$product_image =  basename($pro_image);  
					}
					
					if(in_array($parent_id,$select_cat))
					{
						//echo "Hai";
				/*Insert New Product*/
					$data = array(
						'product_url' => $product_url,	
						'product_name' => $product_name,	
						'parent_id' => $parent_id,	
						'parent_child_id' => $parent_child_id,
						'child_id' => $child_id,	
						'product_image' => $product_image,	
						'description' => $description,	
						'key_feature' => '',
						'brands'=>$brands,
						'mrp' =>$mrp,
						'codAvailable'=>$codAvailable,
						'emiAvailable'=>$emiAvailable,
						'discount' => $discount,
						'size'	=> $size,						
						'color'	=> $color,
						'sizeUnit'	=> $sizeUnit,						
						'status' => '1',
					);
					$ins = $this->db->insert('products',$data);
					$lastinsidpro = $this->db->insert_id();
					//echo $this->db->last_query();die;
					/*Insert New Product*/
					
					/*Insert product gallery*/					
					if($imageUrlStr)
					{
								$proimage_name =  basename($product_imaghes[0]);  
								file_put_contents('uploads/products/'.$proimage_name, file_get_contents($product_imaghes[0]));
								$this->upload_product_gallery($proimage_name,$lastinsidpro);
					}
					/*Insert product gallery*/	
					
					/*Current date price update*/
					$todaydate =  'Date.UTC('.date("Y").','.date("m").','.date("d").')';
					$this->update_product_current_price($lastinsidpro, $price,$todaydate);
					/*Current date price update*/
					
					
					/*Insert product into product price table*/
					$store_id = 85;
					$product_idsss = $lastinsidpro;
					$affiliate_url = $productUrl;
					$product_urlss = str_replace('http://dl.flipkart.com/dl','http://www.flipkart.com',$affiliate_url);
					$product_price = $price;
					$type = 'product';
					$state = 0;
					$data = array(
						'store_id' => $store_id,
						'product_id' => $product_idsss,
						'product_url' => $product_urlss,
						'affiliate_url' => $affiliate_url,
						'type' => 'product',
						'product_price'=>$product_price
					);						
					$result = $this->db->insert('product_price',$data);
					//echo $this->db->last_query();die;
					/*Insert product into product price table*/
					$this->insert_specifications_from_url($product_idsss,$product_urlss);
					}
				}
			}
		}
		
		//exit;
		return true;
	}
	
	
	function bulkproduct($bulkproduct){
	  	$this->db->connection_check();
		$coupon_type = '';
		$this->load->library('CSVReader');
		$main_url = 'uploads/products_csv/'.$bulkproduct;
	 	$result =   $this->csvreader->parse_file($main_url);
		 /* echo "<pre>";
		 print_r($result);
                 die;  */
		  
		 $parent_id= $this->input->post('parent_id');
		$parent_child_id= $this->input->post('parent_child_id');
		 $child_id= $this->input->post('child_id');
		 $str_id= $this->input->post('store_id');
		 $price_compare=$this->input->post('price_compare');
		 
		if(count($result)!=0)
		{
           /*   echo '<pre>';
			print_r($result);die;  */
			foreach($result as $res)
			{
				// echo 'product'.$res['inStock'];
				// if(strtolower($res['inStock'])=='false'){continue;}
			
				if(strtolower($res['inStock'])=='true')			
				{
					// echo $res['inStock'];
					@extract($res);
					$product_url  = $this->admin_model->seoUrl($title);
					// echo $product_url;
					// print_r($res);die;
					//echo $res['inStock'];
					
					$prodetails = $this->get_details_from_id($product_url,'products','product_url');
					/* echo '<pre>';
					 print_r($prodetails); */
					$relation_id  = '';
					if($prodetails)
					{
						$colorname		= str_replace(array('[',']'), "", $color);
						$product_name	=	$title.' '.$colorname;
						$product_url  	= $this->admin_model->seoUrl($product_name);
						$relation_id	= $prodetails->product_id;
					}
					else
					{
						$product_name = $title;
					}
					// echo 'dfdfjd'.$productBrand;
					$checkbrand = $this->get_details_from_id($productBrand,'brands','brand_name');
					
					if($checkbrand){
						// echo 'chendf';
						$brands = $checkbrand->brand_id;}
					else
					{	
// echo 'dfdjfhdfdfdf';				
						$brandarray = array('brand_name'=>$productBrand,'brand_status'=>1,'popular_brand'=>0);
						$this->addbrand('',$brandarray);
					}
					// print_r($imageUrlStr);
					if($imageUrlStr)
					{
						$product_imaghes = explode(';',$imageUrlStr);
						list($pro_image) = $product_imaghes;						
						$product_image =  basename($pro_image);  
					}
					/* echo 'parent_id'.$parent_id;
					echo 'jfkjdghf'.$productId; */
					$get_exist=$this->admin_model->get_exist_product($parent_id,$productId);
					// echo 'get_exist';
					/* echo '<pre>';
					print_r($get_exist); */
						//echo "Hai";
				/*Insert New Product*/
				if($get_exist)
				{
					// echo 'sdsgkj';
					continue;
					}
				else
				{
					// echo 'insert';
					$data = array(
						'product_url' => mysql_real_escape_string($product_url),	
						'product_name' => mysql_real_escape_string($product_name),	
						'parent_id' => mysql_real_escape_string($parent_id),	
						'parent_child_id' => mysql_real_escape_string($parent_child_id),
						'child_id' => mysql_real_escape_string($child_id),	
						'product_image' => mysql_real_escape_string($product_image),	
						'description' => mysql_real_escape_string($description),	
						'key_feature' => '',
						'brands'=> mysql_real_escape_string($brands),
						'mrp' => mysql_real_escape_string($mrp),
						'codAvailable'=> mysql_real_escape_string($codAvailable),
						'emiAvailable'=> ($emiAvailable),
						'discount' => mysql_real_escape_string($discount),
						'size'	=> mysql_real_escape_string($size),						
						'color'	=> mysql_real_escape_string($color),
						'sizeUnit'	=> mysql_real_escape_string($sizeUnit),						
						'status' => '1',
						'store_pid'=> mysql_real_escape_string($productId),
						'price_compare' => mysql_real_escape_string($price_compare),
						'default_store' => mysql_real_escape_string($str_id),
								
					);
					 /* echo '<pre>';
					print_r($data); */
					
					$ins = $this->db->insert('products',$data);
					 // echo $this->db->last_query();
					$lastinsidpro = $this->db->insert_id();
					//echo $this->db->last_query();die;
					/*Insert New Product*/
					// echo $lastinsidpro;die;
					/*Insert product gallery*/					
					if($imageUrlStr)
					{
								$proimage_name =  basename($product_imaghes[0]);  
								file_put_contents('uploads/products/'.$proimage_name, file_get_contents($product_imaghes[0]));
								$this->upload_product_gallery($proimage_name,$lastinsidpro);
					}
					/*Insert product gallery*/	
					// echo 'lings';
					/*Current date price update*/
					$todaydate =  'Date.UTC('.date("Y").','.date("m").','.date("d").')';
					$this->update_product_current_price($lastinsidpro, $price,$todaydate);
					/*Current date price update*/
					
					//echo $productUrl;
					/*Insert product into product price table*/
					$store_id = $str_id;
					$product_idsss = $lastinsidpro;
					$affiliate_url = $productUrl;
					if($store_id==85)
					{
					$product_urlss = str_replace('http://dl.flipkart.com/dl','http://www.flipkart.com',$affiliate_url);
					}
					else if($store_id==239)
					{
						$product_urlss = str_replace('http://clk.omgt5.com/?AID=879958&PID=8137&Type=12&r=','',$affiliate_url);
						
					}
					else
					{
						$product_urlss = $productUrl;
					}
					 $product_price = $price;
					$type = 'product';
					$state = 0;
					$data = array(
						'store_id' => mysql_real_escape_string($store_id),
						'product_id' => mysql_real_escape_string($product_idsss),
						'product_url' => mysql_real_escape_string($product_urlss),
						'affiliate_url' => mysql_real_escape_string($affiliate_url),
						'type' => 'product',
						'product_price'=> mysql_real_escape_string($product_price)
					);	
					// print_r($data);die;
          					
					$result = $this->db->insert('product_price',$data);
					// echo $this->db->last_query();die;
					/*Insert product into product price table*/
					if($store_id==85)
					{
					  $this->insert_specifications_from_url($product_idsss,$product_urlss);
					}
					elseif($store_id==223)
					{
						$this->insert_specifications_from_craftvilla_url($product_idsss,$product_urlss);
					}
					else if($store_id==239)
					{
						
						$this->admin_model->insert_specifications_from_baby($product_idsss,$product_urlss);
					}
					else if($store_id==145)
					{
						$this->admin_model->insert_specifications_from_snapdeal($product_idsss,$product_urlss);
					}
					
					else if($store_id==221)
					{
						$this->admin_model->insert_specifications_from_amazon($product_idsss,$product_urlss);
					}
					
					else if($store_id==205)
					{
						$this->admin_model->insert_specifications_from_india($product_idsss,$product_urlss);
					}
					else if($store_id==210)
					{
						$this->admin_model->insert_specifications_from_ebay($product_idsss,$product_urlss);
					}
					else if($store_id==175)
					{
						$this->admin_model->insert_specifications_from_shopper($product_idsss,$product_urlss);
					}
					
					else if($store_id==232)
					{
						$this->admin_model->insert_specifications_from_shopclues($product_idsss,$product_urlss);
					}
					else if($store_id==208)
					{
						$this->admin_model->insert_specifications_from_infi($product_idsss,$product_urlss);
					}
					else if($store_id==153)
					{
						$this->admin_model->insert_specifications_from_yepme($product_idsss,$product_urlss);
					}
					else if($store_id==146)
					{
						$this->admin_model->insert_specifications_from_firstcry($product_idsss,$product_urlss);
					}
					else if($store_id==230)
					{
						$this->admin_model->insert_specifications_from_crom($product_idsss,$product_urlss);
					}
					else if($store_id==113)
					{
						$this->admin_model->insert_specifications_from_jabong($product_idsss,$product_urlss);
					}
					elseif($store_id==238)
					{
						$this->insert_specifications_from_landmark($product_idsss,$product_urlss);
					}
					elseif($store_id==206)
					{
						$this->insert_specifications_from_rediff($product_idsss,$product_urlss);
					}	
					elseif($store_id==237)
					{
						$this->insert_specifications_from_cross($product_idsss,$product_urlss);
					}
					else if($store_id==150)
					{
						$this->admin_model->insert_specifications_from_urbanladder($product_idsss,$product_urlss);
					}
					else if($store_id==209)
					{
						$this->admin_model->insert_specifications_from_naaptol($product_idsss,$product_urlss);
					}
					else if($store_id==329)
					{
						$this->admin_model->insert_specifications_from_themobile($product_idsss,$product_urlss);
					}
				}
					
				}
			}
			
		}
		
		//exit;
		return true;
	}
	
	function get_last_cate_id($catename,$level=2)
	{
		//$catename = 'aaa';
		$this->db->where('category_level',$level);
		$stp_catename = str_replace(' ', '', $catename);
		$this->db->like('category_name', $catename);
		$this->db->or_like('category_name', $stp_catename);
		$res1 = $this->db->get('product_categories')->row();
		//echo "<pre>";
		if(!$res1 && $level==2){
			$resapi = $this->get_last_cate_id($catename,$level=1);
			return $resapi;
		}
		else if(!$res1 && $level==1){
			return false;
		}
		else
		{
			return $res1;
		}
	}
	
	function add_product_category_dynamic($categorysarray,$crct=null)
	{
		$overall_parent_ids = '';
		$lev = 0;
		$parid = 0;
		//print_r($categorysarray);
		//exit;
		foreach($categorysarray as $newcate)
		{
			$resdp = $this->get_last_cate_id($newcate);
			if($resdp)
			{
				$parid = $resdp->cate_id;
				$overall_parent_ids[] = $parid;
				$lev++;
				continue;
			}
			//echo $newcate."<br>".$parid;exit;
			$this->db->select_max('sort_order');
			$this->db->where('parent_id',$parid);
			$this->db->where('category_level',$lev);	
			$get_max = $this->db->get('product_categories');
			$gets = $get_max->result();
			foreach($gets as $get){
				$max_val = $get->sort_order;
			}
			$maxval = $max_val + 1;
			$category_url = $this->admin_model->seoUrl($newcate);
			$meta_description = $meta_keyword = $category_name = $newcate;
			$parent_id = $parid;
			$category_level = $lev;
			$category_status = 0;
			$sort_order = $maxval;
			if($crct!="")
			{
				$parent_id=$crct;
			}
			$data = array(
			'category_name'=>$category_name,
			'meta_keyword'=>$meta_keyword,
			'meta_description'=>$meta_description,
			'sort_order'=>$sort_order,
			'category_status'=>$category_status,
			'parent_id'=>$parent_id,
			'category_level'=>$category_level,
			'category_url'=>$category_url			
			);	
			$this->db->insert('product_categories',$data);
			//echo $this->db->last_query();
			$parid = $this->db->insert_id();//die;
			$overall_parent_ids[] = $parid;
			
			
			
			$lev++;
		}
		/*print_r($overall_parent_ids);
		exit;*/
		if(count($overall_parent_ids)<3)
		{
			$overall_parent_ids[] = 0;
		}		
		return $overall_parent_ids;		
								
		
	}
	
	function insert_specifications_from_url($proid,$prourl)
	{
		$haveresults_set = $this->url_parsing($prourl);
		$haveresults_setn = preg_replace('/<div class="dummy-content">.*?<\/div>/s','',$haveresults_set);
		$haveresults_setn = preg_replace('/<div class="fk-hidden">.*?<\/div>/s','',$haveresults_setn);
		preg_match_all( '/<ul class="key-specifications fk-ul-disc lpadding20 line fk-font-11 fk-fontlight">(.*?)<\/ul>/mis', $haveresults_setn, $showMoreCompany );
 		$keyspec = rtrim(strip_tags(str_replace('</li>',',',$showMoreCompany[1][0])),',
    ');
		/*Key Featurs*/
		$keyfeatures = str_replace('                ','',$keyspec);
		$data = array(
		'key_feature'=>trim($keyfeatures)
		);
		$this->db->where('product_id',$proid);	
		$this->db->update('products',$data);
		/*Key Featurs*/
			
		/*Image Gallery*/
		preg_match_all('/<div class="imgWrapper">(.*?)<\/div>/s', $haveresults_setn, $imagesdiv);
		preg_match_all('/data-src="(.*?)"/i', $imagesdiv[1][0], $dealbodyrightarrayhred);
		$imageslist =	$dealbodyrightarrayhred[1];
		unset($imageslist[0]);
		foreach($imageslist as $imgs)
		{
				$proimage_name =  basename($imgs);  
				file_put_contents('uploads/products/'.$proimage_name, file_get_contents($imgs));
				$this->upload_product_gallery($proimage_name,$proid);
		}							
		/*Image Gallery*/
		
		//echo "<pre>";
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
			$array_specification = array();
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
								
				if($res)
				{				
					foreach($res as $res_key=>$res_val)
					{
						$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res_val;
					}
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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
	}
	
	function url_parsing($url)
	{
		$cookie_file_path = "cookies.tmp";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
		curl_setopt($ch, CURLOPT_USERAGENT,
			"Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		return $haveresults_set = curl_exec($ch);
		
	}
	
	function insert_records($tablename,$records)
	{
		$this->db->insert($tablename,$records);
		return $insert_id = $this->db->insert_id();
	}
	
	function update_records($table,$records,$whereid,$wherevalue)
	{
		$this->db->where($whereid,$wherevalue);
		$updation = $this->db->update($table,$records);
		return true;
	}
	
	function dynamic_spec_insert($key,$specfication_parant_id)
	{
			$result_array = $this->admin_model->check_specfic($key);
			if(!$result_array)
			{
				$checkspecifications = $this->admin_model->get_details_from_id($key,'specifications','specification');
				$specfication_id = $checkspecifications->specid;
			}
			else 
			{
				$this->db->select_max('sort_order');$this->db->where('parant_id',$specfication_parant_id);$get_max = $this->db->get('specifications');
				$gets = $get_max->row();$max_val = $gets->sort_order;$maxval = $max_val + 1;	
				$trimspecification = trim($key);			
				$records = array(
					'specification'=>$trimspecification,
					'specification_status'=>1,
					'sort_order'=>$maxval,
					'parant_id' => $specfication_parant_id
				);
				$resinsert = $this->admin_model->insert_records('specifications',$records);
				$specfication_id = $resinsert;
			}	
			return $specfication_id;	
	}
	
	function short_product_name($string)
	{
		$split=explode(' ',$string);
		$key = array_search('Series', $split);
		if(in_array('Series', $split, true)){
			unset($split[$key-1]);
			unset($split[$key]);
		}
		$final=implode(' ',$split);
		return  substr($final, 0, 18);
	}
	
	function get_product_list()
	{
		
		$this->db->connection_check();
		$this->db->where('get_link_status','0');
		$this->db->where('price_compare','0');
		//$this->db->limit(15,$var);
		//$this->db->where('brands',$bnd);
        $query = $this->db->get('products');
		//echo $this->db->last_query();die;
        if($query->num_rows >= 1)
		{
            return $query->result();
        }
        return false;	
	}

	function parse_tld($url) {
		$url = trim($url);    
		if (!preg_match('~^http://~i', $url))
			$url = "http://{$url}";    
		$inputdomain = parse_url($url, PHP_URL_HOST);    
		$inputdomain = preg_replace('~^www\.~', NULL, strtolower($inputdomain));    
		$parts = explode('.', $inputdomain);    
		return (count($parts) > 2) ? ".{$parts[1]}.{$parts[2]}" : '.' . end($parts);
	}
	
	function scrapping_list_storeslist($storename) {
		$this->db->connection_check();		
		$res = $this->db->query("SELECT a.store_name,LOWER(substring_index(SUBSTRING_INDEX(SUBSTRING_INDEX(b.affiliate_name, '@', -1), '.', 1) , ' ',1)) as affname FROM `scrapping` as a right JOIN affiliates as b on a.store_name=b.affiliate_id where 
a.store_status=1 and LOWER(substring_index(SUBSTRING_INDEX(SUBSTRING_INDEX(b.affiliate_name, '@', -1), '.', 1) , ' ',1))='$storename'");	
		//echo "<br>".$this->db->last_query();
		if($res->num_rows>0){
			return $res->row();
		}
			return false;
	}
	
	function checkthelink_is_already_exist($storeid,$proid)
	{
		$this->db->connection_check();
		$this->db->where('store_id',$storeid);
		$this->db->where('product_id',$proid);            
        $query = $this->db->get('product_price');
        if($query->num_rows >= 3)
		{
            return $query->row();
        }
        return false;	
	}
	
	function addstoreurl1($storeid,$product_id,$arrlisting,$prolink)
	{
		$allscrappingstores = $this->admin_model->scrapping_list_storeslist($arrlisting);
		if(!$allscrappingstores){continue;}
		//echo "bbbb";
		/*Insert product into product price table*/
		//http://www.amazon.in/gp/offer-listing/B00XKM026W?condition=new&sort=price&tag=comparerajaco-21
		$store_id = $storeid;
		$product_idsss = $product_id;
		$affiliate_url = $prolink;
		if($arrlisting=='amazon')
		{
			$parsedarray = parse_url($affiliate_url);
			$parse_asin = end(explode('/',$parsedarray['path']));
			$product_urlss = 'http://www.amazon.in/gp/product/'.$parse_asin;
		}	
		else{		
		$product_urlss = $this->admin_model->get_product_details_link($affiliate_url);
		}
		//echo $product_urlss;
		$product_price = '';
		$type = 'product';
		$state = 0;
		$data = array(
			'store_id' => $store_id,
			'product_id' => $product_idsss,
			'product_url' => $product_urlss,
			'affiliate_url' => $affiliate_url,
			'type' => 'product',
			'product_price'=>$product_price
		);						
		$result = $this->db->insert('product_price',$data);
		//echo $this->db->last_query();
		return true;
		/*Insert product into product price table*/
	}
	//suren
	
	function addstoreurl($storeid,$product_id,$arrlisting,$prolink,$price1,$product_name)
			{

						   
						$store_id = $storeid;
						$product_idsss = $product_id;
						$affiliate_url = $prolink;
						if($arrlisting=='amazon')
						{
						$newstring = explode("/", $affiliate_url);
						$parse_asin = $newstring[5];
						$product_urlss = 'http://www.amazon.in/gp/product/'.$parse_asin;
						}
						else{
						$product_urlss = $this->admin_model->get_product_details_link($affiliate_url);
						}
						
						$product_price = $price1;
						$type = 'product';
						$state = 0;
						$data = array(
						'store_id' => $store_id,
						'product_id' => $product_idsss,
						'product_price'=>$product_price,
						'product_name'=>$product_name,
						'product_url'=>$affiliate_url,
						'affiliate_url' => $affiliate_url,
						'type' => 'product',
						);

							$result = $this->db->insert('product_price',$data);
							//echo "<br>".$this->db->last_query();

							/*Insert product into product price table*/
			}
	function get_product_details_link($prolink)
	{
		$link = $prolink;
		$cookie_file_path = "cookies.tmp";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
		curl_setopt($ch, CURLOPT_USERAGENT,
			"Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $link);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$haveresults_set = curl_exec($ch);
		$s  =   curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		curl_close($ch);
		return $s;
	}
//ganesh mar 9
function change_status($uid,$st)
	{
		$this->db->connection_check();
				 $data = array(
						'status'=>$st
					);
					$this->db->where('user_id',$uid);
					$this->db->update('tbl_users',$data);
					
					return true;
	}

	function pending_transaction()
	{
		$this->db->connection_check();		
			$this->db->order_by('click_id','desc');
			$this->db->where('status',0);
			$results = $this->db->get('pending');
			//echo $this->db->last_query();die;
			if($results->num_rows > 0){
			return $results->result();
		}
		return false;
		
	}

function get_products_from_product_byid($productid)
	{
		
		$query = $this->db->query("select *,t2.product_url as purl from products t2 join(select t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0  group by t1.product_id)a on a.product_id = t2.product_id where t2.product_id='$productid'");
		
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return $query->row();
		}else
			return false;
	}
	 function get_store_details_byid($affiliate_id=null,$product_id=null)
	{
		$this->db->connection_check();
		$this->db->select('*');
		$this->db->from('affiliates');
		$this->db->join('product_price', 'affiliates.affiliate_id = product_price.store_id');
		$this->db->where('affiliates.affiliate_id',$affiliate_id);
		$this->db->where('product_price.product_id',$product_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	}
	function remove_ptrs($p_id)
	{
		$this->db->connection_check();
		
		
		$this->db->where('click_id', $p_id);
      $this->db->delete('pending'); 
	  //echo $this->db->last_query();die;
		return true;
	}
	function get_productcategories($count=null)
	{
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		$this->db->order_by('cate_id','asc');
		$this->db->where('category_status','1');
		$this->db->where('parent_id','0');
		$result = $this->db->get('product_categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
		
	}
	//ganesh 10 march
	function save_bank_offers()
	{
		extract($this->input->post());
		
		
		$off_id=$this->input->post('offer_id');
		$ff_desc=$this->input->post('off_desc');
		$off_amounts=$this->input->post('off_amounts');
		$o_st_date=$this->input->post('o_st_date');
		$o_ed_date=$this->input->post('o_ed_date');
		
		$st_date=date('Y-m-d',strtotime($b_st_date));
		$ed_date=date('Y-m-d',strtotime($b_ed_date));
				
		$this->db->where('retailer_id',$affiliate_ids);
		$result = $this->db->get('bank_offers');
		
		if($result->num_rows > 0)
		{
			
			if($boff_id!="")
			{

					$data = array(
					'retailer_id' => $affiliate_ids,
					'bank_name'=>$bank_name,
					'offer_desc' => "",
					'off_percent' => $off_percent,
					'off_amount' => $off_amount,
					
					'off_start'=>$st_date,
					'off_end'=>$ed_date
					);
					
					$this->db->where('off_id',$boff_id);
					$this->db->update('bank_offers',$data);
			
			}
			else
			{
				if($bank_name!="")
				{
								$data = array(
							'retailer_id' => $affiliate_ids,
							'bank_name'=>$bank_name,
							'offer_desc' => "",
							'off_percent' => $off_percent,
							'off_amount' => $off_amount,
							'off_type' => '1',
							'off_start'=>$st_date,
							'off_end'=>$ed_date
							);						
						$result = $this->db->insert('bank_offers',$data);
				}
			}
			
			
			for($j=0;$j<count($off_id);$j++)
			{
				
				if($off_id[$j]!="")
				{
					
										$data = array(
								'retailer_id' => $affiliate_ids,
								'bank_name'=>"",
								'offer_desc' => $ff_desc[$j],
								'off_percent' =>"",
								'off_amount' => $off_amounts[$j],
								'off_type' => '2',
								'off_start'=>date('Y-m-d',strtotime($o_st_date[$j])),
								'off_end'=>date('Y-m-d',strtotime($o_ed_date[$j]))
								);	
								$this->db->where('off_id',$off_id[$j]);
								$this->db->update('bank_offers',$data);
				}
			
				else
				{
					if($ff_desc[$j]!="" || $off_amounts[$j]!="")
					{
									$data = array(
								'retailer_id' => $affiliate_ids,
						'bank_name'=>"",
								'offer_desc' => $ff_desc[$j],
								'off_percent' =>"",
								'off_amount' => $off_amounts[$j],
								'off_type' => '2',
								'off_start'=>date('Y-m-d',strtotime($o_st_date[$j])),
								'off_end'=>date('Y-m-d',strtotime($o_ed_date[$j]))
								);	
								$result1 = $this->db->insert('bank_offers',$data);
					}
								
				}
			
			}
		}
		else
		{
		
				if($bank_name!="")
				{
					$data = array(
					'retailer_id' => $affiliate_ids,
					'bank_name'=>$bank_name,
					'offer_desc' => "",
					'off_percent' => $off_percent,
					'off_amount' => $off_amount,
					'off_type' => '1',
					'off_start'=>$st_date,
					'off_end'=>$ed_date
					);						
				$result = $this->db->insert('bank_offers',$data);
				}
				$ff_desc=$this->input->post('off_desc');
				$off_amounts=$this->input->post('off_amounts');
				$o_st_date=$this->input->post('o_st_date');
				$o_ed_date=$this->input->post('o_ed_date');
				
				
				for($i=0;$i<count($off_desc);$i++)
				{
					if($ff_desc[$i]!="")
					{
					$data = array(
					'retailer_id' => $affiliate_ids,
			'bank_name'=>"",
					'offer_desc' => $ff_desc[$i],
					'off_percent' =>"",
					'off_amount' => $off_amounts[$i],
					'off_type' => '2',
					'off_start'=>date('Y-m-d',strtotime($o_st_date[$i])),
					'off_end'=>date('Y-m-d',strtotime($o_ed_date[$i]))
					);	
					$result1 = $this->db->insert('bank_offers',$data);
					
					}
				}
		}
		return true;
		
	}
	function get_aff_bank_off($id)
	{
		$this->db->connection_check();
				
		$this->db->where('retailer_id',$id);
		$this->db->where('off_type','1');
		
		$result = $this->db->get('bank_offers');
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
		
	}
	function get_aff_other_off($id)
	{
		$this->db->connection_check();
				
		$this->db->where('retailer_id',$id);
		$this->db->where('off_type','2');
		
		$result = $this->db->get('bank_offers');
		
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function remove_bank_offers($id=null)
	{
		$this->db->where('off_id', $id);
		$this->db->delete('bank_offers');
	//echo $this->db->last_query();
		return true;
	}
	
	//ganesh 17-3-2016
	function get_categories()
	{
		$this->db->connection_check();	
		$this->db->where('category_level', 1 );
		$result = $this->db->get('product_categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	
	function save_retailer_commision()
	{
		extract($this->input->post());
		$get_commision=serialize(array_filter($what_get));
		$give_commision=serialize(array_filter($what_give));
		$cate_id=serialize(array_filter($cates_id));
		
		$data= array(
						'store_id' => $affiliate_idss,
						'category_id' => $cate_id,
						'what_get' => $get_commision,
						'what_give' => $give_commision,
				);
				$get_commision=$this->get_retailer_commision($affiliate_idss);
				if($get_commision!="")
				{
					$this->db->where('store_id',$affiliate_idss);
					$this->db->update('retailer_commision',$data);
					
				}
				else 
				{
				$this->db->insert('retailer_commision',$data);
				
				}
				return true;
		
	}
	function get_retailer_commision($aid)
	{
		
		$this->db->connection_check();	
		$this->db->where('store_id', $aid );
		$result = $this->db->get('retailer_commision');
	
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	}
   //lingeswari
function get_cash_detail($id)
{
	
		$this->db->connection_check();
		$this->db->select('*');
		$this->db->from('cashback');
		$this->db->join('tbl_users', 'cashback.user_id =tbl_users.user_id');
		$this->db->where('cashback_id',$id);
		
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	

}

//22/03/2016..
	function salable_coupons($store_name=null){
		$this->db->connection_check();
		$this->db->order_by("coupon_id", "desc");
		if($store_name)
		{
			$this->db->like('offer_name', $store_name);	
		}
		 $this->db->where('coupon_status', '1');
		$this->db->where('coupon_type', '1');
		$result = $this->db->get('coupons');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}

	function salable_addcoupon($category_image){
		$this->db->connection_check();
		// $start_date = $this->input->post('start_date');
		$this->db->where('store_id',$this->input->post('offer_name'));
		$st_dtls=$this->db->get('store_details');
		if($st_dtls->num_rows()>0)
		{
			$offer_name=$st_dtls->row('store_name');
		}
		else
		{
		$offer_name='';	
		}
		$start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		$expiry_date =$this->input->post('expiry_date');
		$data = array(
			 'offer_name'=>ucfirst($offer_name),
			'store_id'=>ucfirst($this->input->post('offer_name')),
			'store_location'=>implode(',',$this->input->post('offer_location')),
			'title'=>$this->input->post('title'),
			'description'=>$this->input->post('description'),
			'type'=>$this->input->post('type'),
			// 'code'=>$this->input->post('code'),
			'offer_page'=>$this->input->post('offer_page'),
			'expiry_date'=>$expiry_date,
			'start_date'=>$start_date,
			// 'start_date'=>date('Y-m-d h:i:s'),
			// 'featured'=>$this->input->post('featured'),
			// 'exclusive'=>$this->input->post('exclusive'),
			// 'Tracking'=>$this->input->post('Tracking'),			
			// 'coupon_options'=>$this->input->post('coupon_options'),
			// 'coupon_status'=>'1',
			'cashback_description'=>$this->input->post('cashback_description'),
			'store_description'=>$this->input->post('store_description'),
			'coupon_type'=>'1',
			'amount'=>$this->input->post('amount'),
			'coupon_image'=>$category_image,
			'coupon_status'=>$this->input->post('status'),
			'contact_details'=>$this->input->post('contact')
		);
		// print_r($data);die;
		$this->db->insert('coupons',$data);
		return true;	
	}
	
	// view coupon..	
	function salable_editcoupon($coupon_id){
		$this->db->connection_check();
		$this->db->where('coupon_id',$coupon_id);
		$this->db->where('coupon_type','1');
		// $this->db->where('coupon_status','1');
		$coupons = $this->db->get('coupons');
		if($coupons->num_rows > 0){
			return $coupons->result();
		}
		return false;
	}
	
	// update coupon details..
	function salable_updatecoupon($category_image) {
		$this->db->connection_check();
		// $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		// $start_date = $this->input->post('start_date');
		$this->db->where('store_id',$this->input->post('offer_name'));
		$st_dtls=$this->db->get('store_details');
		if($st_dtls->num_rows()>0)
		{
			$offer_name=$st_dtls->row('store_name');
		}
		else
		{
		$offer_name='';	
		}
		
		
		$start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		$expiry_date =$this->input->post('expiry_date');
		$coupon_id = $this->input->post('coupon_id');
		$data = array(
			 'offer_name'=>ucfirst($offer_name),
			'store_id'=>ucfirst($this->input->post('offer_name')),
			'store_location'=>implode(',',$this->input->post('offer_location')),
			'title'=>$this->input->post('title'),
			'description'=>$this->input->post('description'),
			'store_description'=>$this->input->post('store_description'),
			'type'=>$this->input->post('type'),
			// 'code'=>$this->input->post('code'),
			'offer_page'=>$this->input->post('offer_page'),
			'expiry_date'=>$expiry_date,
			'start_date'=>$start_date,
			// 'start_date'=>date('Y-m-d h:i:s'),
			// 'featured'=>$this->input->post('featured'),
			// 'exclusive'=>$this->input->post('exclusive'),
			// 'Tracking'=>$this->input->post('Tracking'),
			
			'coupon_options'=>$this->input->post('coupon_options'),
			
			'cashback_description'=>$this->input->post('cashback_description'),
			'amount'=>$this->input->post('amount'),
			'coupon_image'=>$category_image,
			'coupon_status'=>$this->input->post('status'),
			'contact_details'=>$this->input->post('contact')
		);
		$this->db->where('coupon_id',$coupon_id);
		// $this->db->where('coupon_status','1');
		$this->db->where('coupon_type','1');
		$updation = $this->db->update('coupons',$data);
		// echo $this->db->last_query();die;
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
	function salable_deletecoupon($delete_id){
		$this->db->connection_check();
		$this->db->delete('coupons',array('coupon_id'=>$delete_id,'coupon_status'=>'1'));
		return true;	
	}	
//lingeswari section here
	//referral section
	function getpending_referr()
	{
		$this->db->connection_check();	
		$this->db->order_by('referral_id','desc');
		$this->db->where('status', '0' );
		$result = $this->db->get('referrals');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function getconfirm_referr()
	{
		$this->db->connection_check();	
		$this->db->order_by('referral_id','desc');
		$this->db->where('status', '1' );
		$result = $this->db->get('referrals');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function delete_refer($id)
	{
		$this->db->connection_check();
		
		
		$this->db->where('referral_id', $id);
      $this->db->delete('referrals'); 
	  return true;
	}
  function get_pending_offline()
   {	
		$this->db->connection_check();	
		$this->db->order_by('offline_userid','desc');
		$this->db->where('admin_status', '0' );
		$result = $this->db->get('offline_users');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
   }
   
    function get_confirm_offline()
   {
        $this->db->connection_check();	
		$this->db->order_by('offline_userid','desc');
		$this->db->where('admin_status', '1' );
		$result = $this->db->get('offline_users');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
   }
   function view_offline_users($id)
   {
		$this->db->connection_check();	
		$this->db->where('offline_userid', $id );
		$result = $this->db->get('offline_users');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
   }
   function update_offline()
   {
   	$id=$this->input->post('user_id');
   	// $new_random = mt_rand(1000000,99999999);
   	$data = array('admin_status' =>$this->input->post('status'),
   	'reason'=>$this->input->post('reason'));	
	$this->db->where('offline_userid',$id);
	$res = $this->db->update('offline_users',$data);
	$data='';
		/*if($res)
		{	*/	
				// echo 'gghjkjl';die;
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
				$this->db->where('offline_userid',$this->input->post('user_id'));
				$get_uu1= $this->db->get('offline_users');
				
				$get_uu = $get_uu1->row();
			    $date =date('Y-m-d');
				
				$this->db->where('mail_id',16);
				$mail_template = $this->db->get('tbl_mailtemplates');
				if($mail_template->num_rows >0) 
				{
					// echo 'dfdjhfdjk';die;
					 $get_uu->random_code;
				   $fetch = $mail_template->row();
				   $subject = $fetch->email_subject;
				   $templete = $fetch->email_template;
				   // $url = base_url().'cashback/my_earnings/';
				    // $regurl=base_url().'cashback/offline_verify_account/'.$get_uu->random_code;
				    $regurl=base_url().'offline_login';
				  	
					
					$sub_data = array(
						'###SITENAME###'=>$site_name
					);
					$subject_new = strtr($subject,$sub_data);
					// echo $subject_new;die;
					$user_email = $get_uu->user_email;
					
					$mes='';
				   if($this->input->post('status')==1)
				   {
				   	$mes= 'Your account confirmed successfully';
				   }
				  if($this->input->post('status')==0)
				   {
				   	$mes= 'Your account deactived';
					$mes.= '<br>Reason: '.$this->input->post('reason');
				   }
				   
					$data = array(
						'###NAME###'=>$get_uu->user_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
						'###COMPANYLOGO###' =>base_url()."uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###USEREMAIL###'=>$get_uu->user_email,
						'###PASSWORD###'=>$get_uu->password,
					    '###MESSAGE###'=>$mes,
					    '###LINK###'=>$regurl
				    );
				   // print_r($data);die;
				   $content_pop=strtr($templete,$data);
				   // echo $content_pop;die;
				 //   echo $content_pop; echo $subject_new;
			//		exit;
				  /* $this->email->message($content_pop);
				   $this->email->send(); */ 
				   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
		           return true;
       }
    /* }*/
   }
   
	function get_confirm_coupons($type){
		if($type=='1-week')
		{
			 $type=date('Y-m-d',strtotime('-1 week'));
		}
		elseif($type=='15-days')
		{
			 $type=date('Y-m-d',strtotime('-15 day'));
		}
		elseif($type=='1-month')
		{
			 $type=date('Y-m-d',strtotime('-1 month'));
		}
		elseif($type=='2-months')
		{
			 $type=date('Y-m-d',strtotime('-2 month'));
		}
		else
		{
		$type=0;
		}
		
		$this->db->connection_check();
		if($type!=0){
		$this->db->where('date_added >=',$type);
		}
		$this->db->where('status','Completed');
		$this->db->order_by('date_added','desc');
		$result = $this->db->get('cashback');
		
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	function get_transaction($type)
	{
		if($type=='1')
		{
			$types="Cashback";
		}
		if($type=='2')
		{
			$types="Referal Payment";
		}
		$this->db->order_by('trans_id','desc');
		$this->db->where('transation_reason',$types);
		$txn = $this->db->get('transation_details');
		if($txn->num_rows > 0){
			return $txn->result();
		}
		return false;
	}
	
	//lingeswari end
   function off_affiliates()
	{
		$this->db->connection_check();
	    $this->db->order_by('store_id','desc');
		$result = $this->db->get('store_details');
		
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
		
	}
	function change_offline_status($id,$status)
	{
		$this->db->connection_check();
		if($status==1) $var=0;else $var=1;
			$data = array(
				'status'=>$var,
		);
		$this->db->where('store_id',$id);
		$updation = $this->db->update('store_details',$data);
		
		if($updation){
			return true;
		}
		else{
			return false;
		}
	}
	
	function delete_offaffiliate($id)
	{
		$this->db->connection_check();
		$this->db->where('store_id',$id);
		$updation = $this->db->delete('store_details');
		
		if($updation){
			return true;
		}
		else{
			return false;
		}
	}
	function change_onstore_status($id=null,$st=null)
	{
		$this->db->connection_check();
		if($st==1) $var=0;else $var=1;
			$data = array(
				'affiliate_status'=>$var,
		);
		$this->db->where('affiliate_id',$id);
		$updation = $this->db->update('affiliates',$data);
		//echo $this->db->last_query();die;
		if($updation){
			return true;
		}
		else{
			return false;
		}
	}
	function get_specifi($id){
			$this->db->where('parant_id',$id);
		$result = $this->db->get('specifications');
	//	echo $this->db->last_query();
		//exit;
		if($result->num_rows > 0){
	//	print_r($result->result());
	///	exit;
			return $result->result();
		}
		return false;
	}
	function update_speci($data){
		
		$this->db->where('cat_id',$data['cat_id']);
		$this->db->where('speci_id',$data['speci_id']);
		$get=$this->db->get('specification_cat');
		
		if($get->num_rows() > 0)
		{
		$arr=array('option_id'=>$data['option_id']);
		$this->db->where('speci_id',$data['speci_id']);
		$sel=$this->db->update('specification_cat',$arr);
		}
		else
			{
				$arr=array('option_id'=>$data['option_id'],'cat_id'=>$data['cat_id'],'speci_id'=>$data['speci_id']);
		//print_r($arr);
		//exit;
		$sel=$this->db->insert('specification_cat',$arr);
				
			}
		return true;
		
		
	}
	 function get_curr_speci($speci_id,$cat_id)
	  {
	  	$this->db->where('cat_id',$cat_id);
			$this->db->where('speci_id',$speci_id);
	
	  	$get=$this->db->get('specification_cat');
	//echo $this->db->last_query();
	//exit;
		if($get->num_rows() >0)
		{
			//	print_r($get->row());exit;
			return $get->row();
		}
		return false;
	  }

	  function get_city($con)
	  {
	  	// $this->db->where('country_id',$con);
	  	$this->db->where('id',$con);
	  	$ver = $this->db->get('city');
	  	// print_r($ver->row());die;
	  	if($ver->num_rows()==1)
	  	{
	  		return $ver->row();
	  	}
	  	else
	  	{
	  		return false;;
	  	}
	  }

	  function view_offline_stores($id)
	  {
	  	// echo 'sdksj';die;
	  	$this->db->where('store_id',$id);
	  	$ver = $this->db->get('store_details');
	  	if($ver->num_rows()==1)
	  	{
	  		return $ver->row();
	  	}
	  	else
	  	{
	  		return false;
	  	}
	  }

	  function get_Address($store_id)
	{
		$this->db->where('store_id',$store_id);
		$ver = $this->db->get('store_address');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}
	
	
	//ganesh 

function get_active_store($par_id,$cate_id)
{
	$this->db->connection_check();
	$this->db->select('active_store');
	$this->db->where('parent_id',$par_id);
	$this->db->where('cate_id',$cate_id);
	$result = $this->db->get('product_categories');
	//echo $this->db->last_query();
	if($result->num_rows > 0){
		
			$value=unserialize($result->row('active_store'));	
			
			return $value;
		}
		return false;
	
}
function get_aff_stores($af_id)
{
	$this->db->connection_check();
	
	$this->db->where('affiliate_id',$af_id);
	
	$result = $this->db->get('affiliates');
	//echo $this->db->last_query();
	if($result->num_rows > 0){
		
			 return $result->row();	
			
		}
		return false;
}
function get_active_links($store_id,$pro_id)
{
	$this->db->connection_check();
	
	$this->db->where('store_id',$store_id);
	$this->db->where('product_id',$pro_id);
	$result = $this->db->get('product_price');
	//echo $this->db->last_query();die;
	
	if($result->num_rows > 0){
		
			 return $result->result();	
			
		}
		return false;
}
//sharmila
function get_products_update()
{
$this->db->connection_check();
$id = $this->input->post('id');
$product_id = $this->input->post('product_id');
$pp_id = explode(',',$id);
foreach($pp_id as $value)
{
$data = array('product_status'=>'1');
$this->db->where('pp_id',$value);
$ver = $this->db->update('product_price',$data);
// echo $this->db->last_query();die;
}
if($ver)
{
// return true;
$data1 = array('product_status'=>'1');
$this->db->where('product_id',$product_id);
$res = $this->db->update('products',$data1);
return true;
}
else
{
return false;
}

}
function delete_products_update()
{
    $this->db->connection_check();
        $id = $this->input->post('id');
        $store_id = $this->input->post('store_id');
        $pp_id = explode(',',$id);
        foreach($pp_id as $value)
        {
             $this->db->where('store_id',$value);
             $this->db->where('product_id',$store_id);
             $ver = $this->db->delete('product_price');
             // echo $this->db->last_query();die;
        }
         if($ver)
         {
             return true;
         }
         else
         {
             return false;
         }

}
function get_price($param,$link)

	{

		$e_tag ='';

		$etag  ='';

		if($param == 'themobilestore')

		{

			$param='themobilestore';

		}

		if($param == 'askmebazaar')

		{

			$param='askmebazaar';

		}

		if($param == 'rediff')

		{

			$param='rediff';

		}

		if($param == 'infibeam')

		{

			$param='infibeam';

		}

		if($param == 'shopclues')

		{

			$param='shopclues';

		}

		if($param == 'ebay')

		{

			$param='ebay';

		}

		if($param == 'snapdeal')

		{

			$param='snapdeal';

		}

		if($param == 'crossword')

		{

			$param='crossword';

		}

		if($param == 'amazon')

		{

			$param='amazon';

		}

		if($param == 'naaptol')

		{

			$param='naaptol';

		}

		if($param == 'indiatimes')

		{

			$param='indiatimes';

		}

		if($param == 'shoppersstop')

		{

			$param='shoppersstop';

		}

		

		

		$url=array

    (

        "flipkart"=>$link,

        "snapdeal"=>$link,

        "ebay"=>$link,

        "amazon"=>$link,

        "shopclues"=>$link,

        "infibeam"=>$link,

        "indiatimes"=>$link,
    
        "jabong"=>$link,
     
        "naaptol"=>$link,

        "landmark"=>$link,

        "crossword"=>$link,
       
        "urbanladder"=>$link,

        "homeshop18"=>$link,

        "themobilestore"=>$link,

        "cromaretail"=>$link,

        "yepme"=>$link,

        "firstcry"=>$link,

        "rediff"=>$link,

        "askmebazaar"=>$link,

       "babyoye"=>$link,

        "craftsvilla"=>$link,

        "shoppersstop"=>$link

	);



	$start_tag=array

    (

        "flipkart"=>'<span class="selling-price omniture-field"[^>]*>',

        "snapdeal"=>'<span class="payBlkBig"  itemprop="price">',

        "ebay"=>'<span class="notranslate" id="prcIsum" itemprop="price"  style="">',

        "amazon"=>'<li id="result_0" class="a-size-medium a-color-price">',

        "shopclues"=>'<div class="product-pricing">',

        "infibeam"=>'<div id="price-after-discount">',

        "indiatimes"=>'<span class="offerprice flt" itemprop="price">',

        

        "jabong"=>'<span itemprop="price"[^>]*>',

        "theelectronicstore"=>'<span class="amount" itemprop="price">',

        "lenskart"=>'<span class="price">',

        "pepperfry"=>'<span id="price-val">',

        "naaptol"=>'<span itemprop="price">',

        "landmark"=>'<span class="price-current">',

        "crossword"=>'<div class="final-price">',

       

        "urbanladder"=>"<div[^>]* itemprop='price'>",

        
		"homeshop18"=>'<span id="hs18Price" itemprop="price"[^>]*>',

		
		"koovs"=>'<span itemprop="price">',

		"themobilestore"=>'<td class="orignal-amout">',

		

		"cromaretail"=>'<div class="cta">',

		

		"yepme"=>'<span id="lblPayHead">',

		"firstcry"=>'<span class="mp" itemprop="price">',


		"rediff"=>'<span itemprop="price" class="cinch_price_amount webprz" property="v:price" product_id="10468914" id="prod_prcs" api_type="radon">',

		"askmebazaar"=>'<div class="productpageprice">',

		"babyoye"=>'<span id="current_product_price" itemprop="price">',

		"craftsvilla"=>'<div class="products price-box">',

		"shoppersstop"=>'<span class="price">'

	);

    

    $end_tag=array

    (

        "flipkart"=>"<\/span>",         	//works 5935

        "snapdeal"=>"<\/span>",         	//works 34001

		"ebay"=>"<\/span>",             	//works 9040

        "amazon"=>"<\/span>",           	//works 5642,107

        "shopclues"=>"<\/div>",         	//works 1199

        "infibeam"=>"<\/div>",          	//works 8320

		"indiatimes"=>"<\/span>",       	//works 999

        "paytm"=>"<\/span>",                               //Not works     https://

        "jabong"=>"<\/span>",           	//works 404,375

        "theelectronicstore"=>"<\/span>",	//works 5880

        "lenskart"=>"<\/span>",                            //Not works     Encrypt form site

        "pepperfry"=>"<\/span>",        	//works 34799

        "naaptol"=>"<\/span>",          	//works 7499

        "landmark"=>"<\/span>",         	//works 2775

        "crossword"=>"<\/div>",         	//works 212

        "uread"=>"<\/div>",             	//works 1290,236

        "bookadda"=>"<\/span>",         	//works 2877

        "urbanladder"=>"<\/div>",       	//works 13999

        "zivame"=>"<\/span>",           	//works 495

        "fabfurnish"=>"<\/span>",       	//works 8999,8420

        "homeshop18"=>"<\/span>",       	//works 1799,1999

        "zansaar"=>"<\/span>",          	//works 29450

        "bluestone"=>"<\/span>",        	//works 54065

        "koovs"=>"<\/span>",            	//works 2750,1295

        "themobilestore"=>"<\/td>",   	    //works 849,3599

        "maniacstore"=>"<\/span>",      	//works 15795

        "cromaretail"=>"<\/div>",       	//works 21994

        "theitdepot"=>"<\/span>",			//works 2166

        "bagittoday"=>"<\/span>",			//works 399

        "saholic"=>"<\/span>",				//works 5299,6199

        "next"=>"<\/span>",				    //works 1775

        "ezoneonline"=>"<\/span>",			//works 7300

        "yepme"=>"<\/span>",				//works 1899

        "zovi"=>"<\/label>",                //works 779,399

        "fashionara"=>"<\/span>",		    //works 990,

        "grabmore"=>"<\/div>",				//works 2001

        "firstcry"=>"<\/span>",				//works 1509

        "cilory"=>"<\/span>",				//works 2399

        "fashionandyou"=>"<\/span>",                        //Not works     cannot get the html content

        "rediff"=>"<\/span>",				//works 3499

        "askmebazaar"=>"<\/div>",			//works 2031

        "babyoye"=>"<\/span>",				//works 2450

        "craftsvilla"=>"<\/div>",		    //works 349,699

        "shoppersstop"=>"<\/span>"			//works 1049,1099

	);

    

    $url 		= $url[$param];

    $start_tag 	= $start_tag[$param];

    $end_tag   	= $end_tag[$param]; 

    

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10; labnol;) ctrlq.org");

    curl_setopt($curl, CURLOPT_FAILONERROR, true);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

  	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $html = curl_exec($curl);

    curl_close($curl);



    

    $regex = "$start_tag(.*?)$end_tag/s";

    preg_match_all($regex, $html, $price);

	$countpric = count($price[0]);

	if($countpric > 1)

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

      	$prices = getpricefun($replace3);

		if(intval($prices == 0))

		{

			$prices = getpricefun($values);

		}		

	}





    if(intval($price[0][0] == 0) && count($price[0]) == 5 || count($price[0]) == 4) {		//shoppersstop

        $datat1 = array_pop($price[0]);

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

        preg_match_all($regex, $html, $price);



		

        $separate_values = strip_tags($price[0][0]);

		

		preg_match_all('/[0-9_.,]+|:|,|/', $separate_values, $separate);

        //print '<pre>'; print_r ($separate_values); print '</pre>';

        $filteredarray = array_values(array_filter($separate[0]));

        //print '<pre>'; print_r ($filteredarray); print '</pre>';

		/*exit;*/

        //$dataz = $filteredarray[0];



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

        else {

            //$dataz = $filteredarray[0];

            $dataz = preg_replace( "/^\.+|\.+$/", "", $filteredarray[0]);

        }





        $dataz1 = trim(strip_tags(str_replace(",", "", $dataz)));

        $prices = number_format((float)$dataz1, 2, '.', '');

    }

    return $prices;

	   

	

	}	

      function active_products()
	{
		// $this->db->order_by('sort_order');
		$this->db->where('parent_id =','0');
		$this->db->where('cate_id !=','0');
		$this->db->where('category_level =','0');
		$ver = $this->db->get('product_categories');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}



	/*function pricealert_sms()
	{
		$this->db->connection_check();
		$this->db->where('status','1');
		$qry = $this->db->get('price_alerts');
		if($qry->num_rows() > 0)
		{
			$stat = $qry->result();
		foreach($stat as $qry1)
		{
			$product_id = $qry1->product_id;
			$user_email = $qry1->email;

		$query1 = $this->db->query("select *,t2.product_id as product_id from price_alerts t2 join(select t1.product_price,t1.old_price,t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.product_id='$product_id'");
		
		if($query1)
		{
			
			$query = $query1->row();

			$new_price = $query->product_price;
			
			$old_price = $qry1->price;
			if($new_price < $old_price)
			{
				$mobile_number = $qry1->mobile_number;
				// $new_price = 
			$send_sms = $this->send_sms($mobile_number,$new_price);
				
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
		
		$this->db->where('mail_id',16);
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
		   
		 
		   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
			return true;                
		}
		    return 1;
		}
		else
			return 0;
	  }
	}
  }
}*/



	function mail_function($admin_email,$user_email,$subject,$content_pop)
   {
   		// echo 'hfgdhj';die;

   		// echo $subject;die;
            $from = $admin_email;
			$to= $user_email;
			$ci = get_instance();
			$ci->load->library('email');
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			/*$config['smtp_user'] = $ad['admin_smtp_email'];
			$config['smtp_pass'] = $ad['admin_smtp_pwd'];*/
			$config['smtp_user'] = 'anuangusamy@gmail.com';
			$config['smtp_pass'] = 'akanu1234';
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";
			$ci->email->initialize($config);
			$ci->email->from($from, $ad['email_name']);
			$ci->email->to($to);
			$this->email->reply_to($from, $ad['email_name']);
			$ci->email->subject($subject);
			$ci->email->message($content_pop);
			$send=$ci->email->send();
			// return true;
	}

	// sharmila 25/04/2016... start here..

	function main_coupon_details($id)
	{
		$this->db->where('coupon_id',$id);
		$ver = $this->db->get('coupons');
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}

	// user_details
	function user_details($id)
	{
		$this->db->where('user_id',$id);
		$ver = $this->db->get('tbl_users');
		
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}

	function get_coupon_code($id)
	{
		$this->db->order_by('salable_id','desc');
		$this->db->where('coupon_id',$id);
		$ver = $this->db->get('salable_coupon');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}


	function transaction_details($id)
	{
		$this->db->where('trans_id',$id);
		$ver = $this->db->get('transation_details');
		/*echo '<pre>';
		print_r($ver->row());die;*/
		// echo $this->db->last_query();die;
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}

	  function coupons_bulk_delete_code()
	 {
		 $this->db->connection_check();
		 $sort_order = $this->input->post('chkbox');
			 foreach($sort_order as $key=>$val)
			 {
					 $delete_id = $key;
					 $this->db->delete('salable_coupon',array('salable_id'=>$delete_id));
	
			 }
		return true;	
	 }
	 function get_cate_details($category_id)

{

	$this->db->connection_check();

			$this->db->select('category_name');

			$this->db->where('cate_id',$category_id);

            $ver = $this->db->get('product_categories');

			if($ver->num_rows>0)

			{

				return $ver->row('category_name');

			}

}


	// sharmila 25/04/2016.. end here


// view all offline stores...
	 function view_offline_storess()
	 {
	 	// echo 'sdsgh';die;
	 	$this->db->where('status','1');
	 	$this->db->order_by('store_id','desc');
	 	$ver = $this->db->get('store_details');
	 	if($ver->num_rows()>0)
	 	{
	 		return $ver->result();
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }

	 // store_location..
	 function store_location($id)
	 {
	 	$this->db->where('store_id',$id);
	 	$ver = $this->db->get('store_address');
	 	if($ver->num_rows()>0)
	 	{
	 		return $ver->result();
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }

	 // store_address
	 function store_address($id)
	 {
	 	$this->db->where_in('store_addid',explode(',',$id));
	 	$ver = $this->db->get('store_address');
		
	 	if($ver->num_rows()>1)
	 	{
	 		return $ver->result();
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }

	 function store_name($id)
	 {
	 	$this->db->where('store_id',$id);
	 	$ver = $this->db->get('store_details');
	 	if($ver->num_rows()==1)
	 	{
	 		return $ver->row();
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }
	 //ganesh may 3
	 function fetch_store_url1($store_id,$product_id){
		$this->db->where(array('store_id'=>$store_id,'product_id'=>$product_id));
		$query = $this->db->get('product_price');
		//echo $this->db->last_query();
		if($query->num_rows>0)
		{
		return $query->result();
		}
	}
function get_affiliate_value($value)
			{
				$this->db->select('affiliate_url');
			$this->db->where('pp_id',$value);
			$ver = $this->db->get('product_price');
			//echo $this->db->last_query();
			if($ver->num_rows>0)
			{
			return $ver->row('affiliate_url');
			}
			else
			{
			return false;
			}
			}

   // sharmila  05/05/2016....

			function coupons_det($id)
	{
		$query = $this->db->query("select * from coupons where coupon_id='$id' AND coupon_status='1' AND coupon_type='1'")->row();
		return $query;
	}

   // sharmila  05/05/2016....

	// 06/05/2016...

	 function store_filters($cate_id)
    {

        $res=$this->input->post();
        extract($res);

        for($i=0;$i<sizeof($spec_id);$i++)
        { 

            $temp='sub_filters_'.$i;
            //echo count($res[$temp]);
             $specid=$spec_id[$i];
             print_r($res[$temp]);
            if($res[$temp]!="")
            {
            $sub_filter=serialize(array_filter($res[$temp]));

            $arr=array('cate_id'=>$cate_id,'filters'=>$sub_filter,'spec_id'=>$specid);
            $sel=$this->db->insert('filter',$arr);
            // echo $this->db->last_query();
            }
        }
        return true;
    }
   

    function specification_name($spec_id)
    {
    	$this->db->where('specid',$spec_id);
    	$this->db->where('specification_status',1);
    	$ver = $this->db->get('specifications');
    	if($ver->num_rows()==1)
    	{
    		return $ver->row();
    	}
    	else
    	{
    		return false;
    	}
    }


function get_sub_filters($cate_id)
{
        $this->db->connection_check();
        $cate_id=str_replace('sub_','',$cate_id);
         $this->db->select('category_specifications');
        $this->db->where('cate_id',$cate_id);
        $result1=$this->db->get('product_categories');

        if($result1->num_rows>0)
        {
            $spe_id=$result1->row('category_specifications');
            $sp_id=explode(',',$spe_id);
        } 

        $this->db->where('cate_id',$cate_id);
        if($sp_id!="")
        {
            $this->db->where_in('spec_id',$sp_id);
        } 
        $result=$this->db->get('filter');
         //echo $this->db->last_query();die;
        if($result->num_rows>0)
        {
            return $result->result();    
        }
        return false;
    }

    function update_store_filters()
{
$res=$this->input->post();
            extract($res);

            //print_r($cate_id);die;
            //$spec_id = $this->input->post('spec_id');
            // print_r($spec_id);die;
            //$cate_id = $this->input->post('cate_id');

                    if($cate_id){
//print_r($fil_id);
                        foreach($spec_id as $key=>$value)
                        {    
                            $fid=$fil_id[$key];
                            $this->db->where('f_id',$fid);
                            $ftrs=$this->db->get('filter');
							//echo $this->db->last_query();
                             if($ftrs->num_rows>0)
                            {
								
                                $temp='sub_filters_'.$key;
                                $sub_filter=serialize(array_filter($res[$temp]));
                                $arr=array('filters'=>$sub_filter);
                                $this->db->where('f_id',$fid);
                                $this->db->update('filter',$arr);
                                // echo $this->db->last_query();

                            }
                            else
                            {
								
                                 $temp='sub_filters_'.$key;
                                $sub_filter=serialize(array_filter($res[$temp]));
                                $specid=$specid=$spec_id[$key];
                                $arr=array('cate_id'=>$cate_id,'filters'=>$sub_filter,'spec_id'=>$specid);
                                $this->db->insert('filter',$arr);
                                 //echo $this->db->last_query();
                            } 

                        }
						

                    }

                return true;
            }

	function get_cate_filters($cat_id)
	{
	    $this->db->connection_check();
	    $cate_id=str_replace('sub_','',$cat_id);
	    $this->db->where('cate_id',$cate_id);
	    $result=$this->db->get('product_categories');
	    //echo $this->db->last_query();
	    if($result->num_rows > 0){

	         return $result->row();    

	    }
	    return false;
	}


            // 06/05/2016...
			
			
			//ganesh may 7
			
			function get_online_stores()
		{
			$this->db->connection_check();
			$this->db->where('store_type','On1');
			$result=$this->db->get('affiliates');
			//echo $this->db->last_query();die;
			if($result->num_rows>0)
			{
				return $result->result();	
			}
			return false;
		}
		
		
		//ganesh may 7
		function insert_specifications_from_craftvilla_url($proid,$prourl)
		{
			$haveresults_set = $this->url_parsing($prourl);
			
		preg_match('/<div class="col-sm-offset-2 col-sm-8 col-xs-12 mtb20">.*?<\/div>/s',$haveresults_set,$craft_speci);
			
		preg_match_all( '/<ul class="col-sm-offset-[^>]* col-sm-4 col-xs-offset-1 col-xs-11 attrlist">(.*?)<\/ul>/mis', $craft_speci[0], $showMoreCompany );
		
		preg_match_all( '/<li>(.*?)<\/li>/s', $showMoreCompany[1][0], $tddetailsvaluearray );
		
		foreach($tddetailsvaluearray[1] as $spec)
		{
			$specvalue=explode(':',strip_tags($spec));
			$result[$specvalue[0]]=$specvalue[1];
		
		}
		
		
			$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids = array();
			$array_specification = array();
		
				$lastid = $this->admin_model->dynamic_spec_insert("specification",0);
				$mainspecid[$lastid] =$lastid;
			foreach($result as $key=>$res)
			{
				
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
								
				
						$last_subid = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$last_subid]=$last_subid;
						$array_specification[$last_subid]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		}
		
		function get_exist_product($parent_id,$productId)
		{
			$this->db->connection_check();
			$this->db->where('parent_id',$parent_id);
			$this->db->where('store_pid',$productId);
			$result=$this->db->get('products');
			/* echo '<pre>';
			print_r($result->result());die; */
			//echo $this->db->last_query();die;
			if($result->num_rows>0)
			{
				return true;	
			}
			return false;
		}
 function import_reports_products($content)
{
	$this->db->connection_check();
if($content)
{
	//print_r($content['response']['data']['data']);
	
				foreach($content['response']['data']['data'] as $cont)
				{
					
					$store_name=explode('.',$cont['Offer']['name']);
					$user_id=$cont['Stat']['affiliate_info1'];
					$usr_id=decode_userid($user_id);
					$price=$cont['Stat']['sale_amount'];
					$date=date('Y-m-d',strtotime($cont['Stat']['datetime']));
					$aff_date=date('Y-m-d H:i:s',strtotime($cont['Stat']['datetime']));
					$like_date=date('Y-m-d H',strtotime($cont['Stat']['datetime']));
					
					 $ads=$this->db->get('rewards_details');
					 if($ads->num_rows()>0)
					 {
						 $cob_coins=$ads->row('cob_coins');
					 }
					
					 $this->db->like('store_name',$store_name[0]);
					$this->db->where('DATE(date_added)',$date);
					$this->db->where('date_added <=',$aff_date);
					$this->db->where('user_id',$usr_id);
					$this->db->where('price',$price);
					$this->db->like('date_added',$like_date);
					$this->db->where('status',0);
					$result=$this->db->get('product_clickhistory'); 
					
					echo $this->db->last_query();
					 
					if($result->num_rows()>0)
					{
						$click_id=$result->row('click_id');
						$product_id=$result->row('product_id');
						$affiliate_id=$result->row('affiliate_id');
						$my_date=$result->row('date_added');
						$ads_coins=$result->row('price')/$cob_coins;
						$this->db->where('product_id',$product_id);
						$prodetailss=$this->db->get('products');
						//echo $this->db->last_query();
						if($prodetailss->num_rows()>0)
						{
							$prodetails = $prodetailss->row();
							$cat_id=$prodetails->parent_child_id;
						}
						$this->db->where('store_id',$affiliate_id);
						$com_detailss=$this->db->get('retailer_commision');
						//echo $this->db->last_query();
						if($com_detailss->num_rows()>0)
						{
							$com_details = $com_detailss->row();
							$cate_arr=unserialize($com_details->category_id);
							$commision=unserialize($com_details->what_give);
							$key=array_search($cat_id, $cate_arr);
							$comm=$commision[$key];
						}
						
						
						
						$data=array('status'=>1);
					$this->db->where('click_id',$click_id);
					$this->db->limit(1,0);
					$this->db->update('product_clickhistory',$data);
					//echo $this->db->last_query();
					if($comm>0)
					{
					$com_price=$cont['Stat']['approved_payout']*(50/100);
					//$com_price=$cont['Stat']['approved_payout']-$price_new;
					}
					else
					{
						$com_price=0;
					}
					

					$ver = array(
							'store_name'=>$store_name[0],
							'user_id'=>$usr_id,
							'price'=>$price,
							'date_added'=>$my_date,
							'update_date'=>$aff_date,
							'commision_price'=>$com_price,
							'ADS_coins'=>round($ads_coins),
							'status'=>0
						);
					$res = $this->db->insert('pending',$ver);
								
						
					
					}
									
				} 
}
}
//ganesh may 12

function affiliate_network_product($id)
{
	$this->db->connection_check();
		$this->db->where('id',$id);
		$this->db->order_by('id','desc');
		$affiliate_network = $this->db->get('affiliates_list');
		if($affiliate_network->num_rows > 0)
		{
			return $affiliate_network->result();		
		}
		return false;
}

function import_reports_products_snp($content)
{
	$this->db->connection_check();
if($content)
{
	//print_r($content['response']['data']['data']);
	
				foreach($content->productDetails as $cont)
				{
					//echo ($cont->product);die;
					$store_name='Snapdeal';
					 $user_id=$cont->affiliateSubId1;
					$usr_id=decode_userid($user_id);
					$price=$cont->sale;
					$date=date('Y-m-d',strtotime($cont->dateTime));
					$aff_date=date('Y-m-d H:i:s',strtotime($cont->dateTime));
					$like_date=date('Y-m-d H',strtotime($cont->dateTime));
					
					$ads=$this->db->get('rewards_details');
					 if($ads->num_rows()>0)
					 {
						 $cob_coins=$ads->row('cob_coins');
					 }
					 $this->db->like('store_name',$store_name);
					$this->db->where('DATE(date_added)',$date);
					$this->db->where('date_added <=',$aff_date);
					$this->db->where('user_id',$usr_id);
					$this->db->where('price',$price);
					$this->db->like('date_added',$like_date);
					$this->db->where('status',0);
					$result=$this->db->get('product_clickhistory'); 
					
					//echo $this->db->last_query();
					 
					if($result->num_rows()>0)
					{
						$click_id=$result->row('click_id');
						$product_id=$result->row('product_id');
						$affiliate_id=$result->row('affiliate_id');
						$my_date=$result->row('date_added');
						$ads_coins=$result->row('price')/$cob_coins;
						$this->db->where('product_id',$product_id);
						$prodetailss=$this->db->get('products');
						if($prodetailss->num_rows()>0)
						{
							$prodetails = $prodetailss->row();
							$cat_id=$prodetails->parent_child_id;
						}
						$this->db->where('store_id',$affiliate_id);
						$com_detailss=$this->db->get('retailer_commision');
						if($com_detailss->num_rows()>0)
						{
							$prodetails = $com_detailss->row();
							$cate_arr=unserialize($com_details->category_id);
							$commision=unserialize($com_details->what_give);
							$key=array_search($cat_id, $cate_arr);
							$comm=$commision[$key];
						}

					$data=array('status'=>1);
					$this->db->where('click_id',$click_id);
					$this->db->limit(1,0);
					$this->db->update('product_clickhistory',$data);
					if($comm>0)
					{
					$com_price=$cont->commissionEarned*(50/100);
					//$com_price=$cont['Stat']['approved_payout']-$price_new;
					}
					else
					{
						$com_price=0;
					}
					
					/* $price_new=$cont->commissionEarned*($comm/100);
					$com_price=$cont->commissionEarned-$price_new; */
					
					/*$now = date('Y-m-d H:i:s');
					$mode = "Credited";
					$data = array(			
									'transation_amount' => $cont->commissionEarned,	
									'user_id' => $usr_id,	
									'transation_date' => $now,	
									'transation_reason' => 'Cashback amount Payment',	
									'mode' => $mode,	
									'transation_status' => 'Progress',
									'txn_id'=>$cont->orderCode,
									);
					$this->db->insert('transation_details',$data);*/

					$ver = array(
							'store_name'=>$store_name,
							'user_id'=>$usr_id,
							'price'=>$price,
							'date_added'=>$my_date,
							'update_date'=>$aff_date,
							'commision_price'=>$com_price,
							'ADS_coins'=>$ads_coins,
							'status'=>0
						);
					$res = $this->db->insert('pending',$ver);
					
					}
									
				} 
}
}

// sharmila 12/05/2016...

	function tran_user_details($user_id)
	{
		$this->db->where('user_id',base64_decode($user_id));
		// $this->db->where('status','1');;
		$ver = $this->db->get('tbl_users');
		// echo $this->db->last_query();die;
		/*echo '<pre>';
		print_r($ver->row());die;*/
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}

	function transactions_detailss($trans_id)
	{
		$this->db->where('withdraw_id',base64_decode($trans_id));
		$ver = $this->db->get('withdraw');
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}

	// sharmila  12/05/2016....
function import_reports_products_omg($content)
{
	$this->db->connection_check();
if($content)
{
	//print_r($content['response']['data']['data']);
	
				foreach($content as $cont)
				{
					
					$date=$cont->ClickTime;
					preg_match('/(\d{10})(\d{3})([\+\-]\d{4})/', $date, $matches);
					$dt = DateTime::createFromFormat("U.u.O",vsprintf('%2$s.%3$s.%4$s', $matches));
						
					$click_date=$dt->format('Y-m-d');
					$aff_date=$dt->format('Y-m-d H:i:s');
					$like_date=$dt->format('Y-m-d H');
					$store_name=explode('.',$cont->Merchant);
					 $user_id=$cont->UID;
					$usr_id=decode_userid($user_id);
					$price=$cont->TransactionValue;
					$ads=$this->db->get('rewards_details');
					 if($ads->num_rows()>0)
					 {
						 $cob_coins=$ads->row('cob_coins');
					 }

					
					$this->db->like('store_name',$store_name[0]);
					$this->db->where('DATE(date_added)',$click_date);
					$this->db->where('date_added <=',$aff_date);
					$this->db->where('user_id',$usr_id);
					$this->db->where('price',$price);
					$this->db->like('date_added',$like_date);
					$this->db->where('status',0);
					$result=$this->db->get('product_clickhistory'); 
					echo $this->db->last_query();
					
					 
					if($result->num_rows()>0)
					{
						$click_id=$result->row('click_id');
						$product_id=$result->row('product_id');
						$affiliate_id=$result->row('affiliate_id');
						$my_date=$result->row('date_added');
						$ads_coins=$result->row('price')/$cob_coins;
						$this->db->where('product_id',$product_id);
						$prodetailss=$this->db->get('products');
						//echo $this->db->last_query();
						if($prodetailss->num_rows()>0)
						{
							$prodetails = $prodetailss->row();
							$cat_id=$prodetails->parent_child_id;
						}
						$this->db->where('store_id',$affiliate_id);
						$com_detailss=$this->db->get('retailer_commision');
						//echo $this->db->last_query();
						if($com_detailss->num_rows()>0)
						{
							$com_details = $com_detailss->row();
							$cate_arr=unserialize($com_details->category_id);
							$commision=unserialize($com_details->what_give);
							$key=array_search($cat_id, $cate_arr);
							 $comm=$commision[$key];
						}
						
						
						
						$data=array('status'=>1);
					$this->db->where('click_id',$click_id);
					$this->db->limit(1,0);
					$this->db->update('product_clickhistory',$data);
					if($comm>0)
					{
					$com_price=$cont->SR*(50/100);
					//$com_price=$cont['Stat']['approved_payout']-$price_new;
					}
					else
					{
						$com_price=0;
					}
					

				  $ver = array(
							'store_name'=>$store_name[0],
							'user_id'=>$usr_id,
							'price'=>$price,
							'date_added'=>$my_date,
							'update_date'=>$aff_date,
							'commision_price'=>$com_price,
							'ADS_coins'=>$ads_coins,
							'status'=>0
						);
					$res = $this->db->insert('pending',$ver);
					
					}
									
				} 
}
}

// sharmila 17/05/2016 ...
	function product_clickhistory()
	{
		$this->db->connection_check();		
			$this->db->order_by('click_id','desc');
			$this->db->where('status',0);
			$results = $this->db->get('product_clickhistory');
			//echo $this->db->last_query();die;
			if($results->num_rows > 0){
			return $results->result();
		}
		return false;
		
	}

	function pending_remove_ptrs($p_id)
	{
		$this->db->connection_check();
		
		
		$this->db->where('click_id', $p_id);
      $this->db->delete('pending'); 
	  //echo $this->db->last_query();die;
		return true;
	}

	// approve_status

	function approve_status($p_id)
	{
		$this->db->connection_check();
		$data = array(
					'status'=>'1',
			    );
		$this->db->where('click_id', $p_id);
        $ver = $this->db->update('pending',$data); 
	  //echo $this->db->last_query();die;
		if($ver)
		{	
					$this->db->where('click_id',$p_id);
					$baaa = $this->db->get('pending');
	 				 // echo $this->db->last_query();die;
					if($baaa->num_rows()==1)
					{
						$bn = $baaa->row();
						$amount = $bn->commision_price;
						$rewards=$bn->ADS_coins;
					}
					$this->db->where('user_id',$bn->user_id);
					$sss = $this->db->get('tbl_users');
					// echo $this->db->last_query();die;

					/*echo '<pre>';
					echo $this->db->last_query();die;*/
					/*echo '<pre>';
					print_r($sss->row());die;*/
					if($sss->num_rows()==1)
					{
						$bal = $sss->row();
						$resss = $bal->balance;
						$tot = $resss + $amount;
						$ads_coins=$bal->ads_points+$rewards;
						// echo $tot;
						$data1 = array(
								'balance'=>$tot,'ads_points'=>$ads_coins
							);
						$this->db->where('user_id',$bal->user_id);
						$this->db->update('tbl_users',$data1);
						return true;
					}
		}
		else
		{
			return false;
		}
	}

	// remove_transactions ....

	/*function remove_transactions($p_id)
	{
		$this->db->connection_check();
		$data = array(
					'status'=>'0',
			    );
		$this->db->where('click_id', $p_id);
        $ver = $this->db->update('pending',$data); 
	  //echo $this->db->last_query();die;
		if($ver)
		{	
			return true;
		}
		else
		{
			return false;
		}
	}
*/

	function remove_transactions($p_id)
	{
		$this->db->connection_check();
		$data = array(
					'status'=>'0',
			    );
		$this->db->where('click_id', $p_id);
        $ver = $this->db->update('pending',$data); 
		if($ver)
		{	
	        $this->db->where('click_id',$p_id);
			$baaa = $this->db->get('pending');
			if($baaa->num_rows()==1)
			{
				$bn = $baaa->row();
				$amount = $bn->commision_price;
				$rewards=$bn->ADS_coins;
			}
			$this->db->where('user_id',$bn->user_id);
			$sss = $this->db->get('tbl_users');
			
			if($sss->num_rows()==1)
			{
				$bal = $sss->row();
				$resss = $bal->balance;
				$tot = $resss - $amount;
				$ads_coins=$bal->ads_points-$rewards;
				
				// echo $tot;
				$data1 = array(
						'balance'=>$tot,'ads_points'=>$ads_coins
					);
				$this->db->where('user_id',$bal->user_id);
				$this->db->update('tbl_users',$data1);
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	

	
// sharmila 17/05/2016...
//ganesh 19-05-2016
function import_reports_products_amz($content)
{
	
	foreach($content->Item as $details)
	{
		
		 $click_date=date('Y-m-d',strtotime($details->attributes()->Date));
		 $price=str_replace(',','',$details->attributes()->Price);
		$store_name='Amazon';
		
					$this->db->like('store_name',$store_name);
					$this->db->where('DATE(date_added)',$click_date);
					//$this->db->where('user_id',$usr_id);
					 
					$this->db->where('price',$price);
					$this->db->where('status',0);
					$result=$this->db->get('product_clickhistory',$data); 
					
					//echo $this->db->last_query();die;
					 
					if($result->num_rows()>0)
					{
						$click_id=$result->row('click_id');
						$product_id=$result->row('product_id');
						$affiliate_id=$result->row('affiliate_id');
						$this->db->where('product_id',$product_id);
						$prodetailss=$this->db->get('products');
						if($prodetailss->num_rows()>0)
						{
							$prodetails = $prodetailss->row();
							$cat_id=$prodetails->parent_child_id;
						}
						$this->db->where('store_id',$affiliate_id);
						$com_detailss=$this->db->get('retailer_commision');
						if($com_detailss->num_rows()>0)
						{
							$prodetails = $com_detailss->row();
							$cate_arr=unserialize($com_details->category_id);
							$commision=unserialize($com_details->what_give);
							$key=array_search($cat_id, $cate_arr);
							$comm=$commision[$key];
						}
						$data=array('status'=>1);
						
					$this->db->where('click_id',$click_id);
					$this->db->limit(1,0);
					$this->db->update('product_clickhistory',$data);
					
					$price_new=$details->attributes()->Earnings*(50/100);
					$com_price=$details->attributes()->Earnings-$price_new;
					$ver = array(
							'store_name'=>$store_name,
							'user_id'=>$usr_id,
							'price'=>$price,
							'date_added'=>$my_date,
							'update_date'=>$aff_date,
							'commision_price'=>$com_price,
							'ADS_coins'=>$ads_coins,
							'status'=>0
						);
					$res = $this->db->insert('pending',$ver);
					
					/* $now = date('Y-m-d H:i:s');
					$mode = "Credited";
					$data = array(			
									'transation_amount' => $cont->commissionEarned,	
									'user_id' => $usr_id,	
									'transation_date' => $now,	
									'transation_reason' => 'Cashback amount Payment',	
									'mode' => $mode,	
									'transation_status' => 'Progress',
									'txn_id'=>$cont->orderCode,
									);
					$this->db->insert('transation_details',$data); */
								
					
					
					}
		
		
		
	}
}

			function filter_name($spec_id,$cate_id)
			{
			// echo 'dfdklfh';die;
			$this->db->where('spec_id',$spec_id);
			$this->db->where('cate_id',$cate_id);
			$ver = $this->db->get('filter');
			// echo $this->db->last_query();die;
			if($ver->num_rows()==1)
			{
			return $ver->row();
			}
			else
			{
			return false;
			}
			}
			
			function active_main_specifications()
{
	$this->db->connection_check();
	$result=$this->db->query("SELECT * FROM specifications where parant_id=0  and specification_status=1 order by specification Asc");
	    if($result->num_rows > 0)
	    {
	        return $result->result();                
	    }
	        return false;
}


function insert_specifications_from_snapdeal($proid,$prourl)
{
	  $haveresults_set = $this->url_parsing($prourl);
	  //print_r($haveresults_set);die;
		
		preg_match_all( '/<div class="pdp-e-i-keyfeatures">(.*?)<\/div>/s', $haveresults_set, $showMoreCompany );
		//print_r($showMoreCompany[0][0]);
		preg_match_all( '/<li title="[^>]*">(.*?)<\/li>/is', $showMoreCompany[0][0], $keyspec );
		
 		//$keyspec = rtrim(strip_tags(str_replace('</li>',',',$showMoreCompany[1][0])),',');
		/*Key Featurs*/
		$keyfeatures = str_replace('-&nbsp;','',$keyspec[1]);
		
		$data = array(
		'key_feature'=>implode(',',$keyfeatures)
		);
		//print_r($data);die;
		$this->db->where('product_id',$proid);	
		$this->db->update('products',$data);
		
		/*Key Featurs*/
			
		/*Image Gallery*/
		/* preg_match_all('/<div class="imgWrapper">(.*?)<\/div>/s', $haveresults_setn, $imagesdiv);
		preg_match_all('/data-src="(.*?)"/i', $imagesdiv[1][0], $dealbodyrightarrayhred);
		$imageslist =	$dealbodyrightarrayhred[1];
		unset($imageslist[0]);
		foreach($imageslist as $imgs)
		{
				$proimage_name =  basename($imgs);  
				file_put_contents('uploads/products/'.$proimage_name, file_get_contents($imgs));
				$this->upload_product_gallery($proimage_name,$proid);
		} */							
		/*Image Gallery*/
		
		//echo "<pre>";
		preg_match_all('/<div class="spec-body" itemprop="description">(.*?)<\/div>/s',$haveresults_set, $listpros); 
		//print_r(listpros);
		preg_match_all("/<table width='100%' border='0' cellspacing='2' cellpadding='0' class='product-spec'>(.*?)<\/table>/s", $listpros[0][0], $tableslisting);
		print_r($tableslisting);
		$result = array();
		$result_table = array();		
		foreach($tableslisting[1] as $tabledetails)
		{
				preg_match("/<th colspan='2'>(.*?)<\/th>/", $tabledetails, $tharraydetails);
				 $thname = trim($tharraydetails[1]);
				
				preg_match_all('/<tr>(.*?)<\/tr>/s',$tabledetails, $trarraydetails);
				unset($trarraydetails[1][0]);
				foreach($trarraydetails[1] as $trdetails)
				{
					preg_match("/<td  width='20%'>(.*?)<\/td>/", $trdetails, $tddetailsarray);
					if($tddetailsarray==''||!trim($tddetailsarray[1])){continue;}
					 $speckey = trim($tddetailsarray[1]);
					preg_match('/<td>(.*?)<\/td>/s', $trdetails, $tddetailsvaluearray);
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
			$array_specification = array();
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
								
				if($res)
				{				
					foreach($res as $res_key=>$res_val)
					{
						$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res_val;
					}
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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
}

function insert_specifications_from_amazon($proid,$prourl)
{
	$haveresults_set = $this->url_parsing($prourl);
	  //print_r($haveresults_set);die;
		
		/*  preg_match_all( '/<div class="pdp-e-i-keyfeatures">(.*?)<\/div>/s', $haveresults_set, $showMoreCompany ); 
		
		 preg_match_all( '/<li title="[^>]*">(.*?)<\/li>/is', $showMoreCompany[0][0], $keyspec ); 
		
 		
		$keyfeatures = str_replace('-&nbsp;','',$keyspec[1]);
		
		$data = array(
		'key_feature'=>implode(',',$keyfeatures)
		);
		
		$this->db->where('product_id',$proid);	
		$this->db->update('products',$data); */
		
		/*Key Featurs*/
			
		/*Image Gallery*/
		 /* preg_match_all('/<div class="imgWrapper">(.*?)<\/div>/s', $haveresults_setn, $imagesdiv);
		preg_match_all('/data-src="(.*?)"/i', $imagesdiv[1][0], $dealbodyrightarrayhred);
		$imageslist =	$dealbodyrightarrayhred[1];
		unset($imageslist[0]);
		foreach($imageslist as $imgs)
		{
				$proimage_name =  basename($imgs);  
				file_put_contents('uploads/products/'.$proimage_name, file_get_contents($imgs));
				$this->upload_product_gallery($proimage_name,$proid);
		}  */						
		/*Image Gallery*/
		
		//echo "<pre>";
		preg_match_all('/<div class="content pdClearfix">(.*?)<\/div>/s',$haveresults_set, $listpros); 
		//print_r($listpros);die;
		preg_match_all('/<table cellspacing="0" cellpadding="0" border="0">(.*?)<\/table>/s', $listpros[1][0], $tableslisting);
		//print_r($tableslisting[1][0]);die;
		$result = array();
		$result_table = array();		
		
				
				
				preg_match_all('/<tr>(.*?)<\/tr>/s',$tableslisting[1][0], $trarraydetails);
				//print_r($trarraydetails);die;
				
				foreach($trarraydetails[1] as $trdetails)
				{
					preg_match('/<td class="label">(.*?)<\/td>/', $trdetails, $tddetailsarray);
					if($tddetailsarray==''||!trim($tddetailsarray[1])){continue;}
					 $speckey = trim($tddetailsarray[1]);
					preg_match('/<td class="value">(.*?)<\/td>/s', $trdetails, $tddetailsvaluearray);
					 $specvalue = trim($tddetailsvaluearray[1]);			
					$result_table[$speckey]=$specvalue;
				}
				//print_r($result_table);die;
				/* if(!$result_table){continue;}
				$result_table = array_filter($result_table);
				if(!$result_table){continue;}
				$result[$thname]=$result_table;
				$result_table = '';
				$trarraydetails = ''; */
			
			$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
}
      function insert_specifications_from_baby($proid,$prourl)
{
//echo "cvvbxcvbxcvb";die;

    $haveresults_set = $this->admin_model->url_parsing($prourl);
	

    preg_match_all('/<p class="contents" itemprop="description">(.*?)<\/p>/s',$haveresults_set, $listpros);
	
	
    preg_match_all( '/<ul>(.*?)<\/ul>/mis', $listpros[0][0], $showMoreCompany );
	
    preg_match_all( '/<li>(.*?)<\/li>/s', $showMoreCompany[0][0], $tddetailsvaluearray );
	/* }
	else
	{
		print_r($listpros[0][0]);
		$array=explode('<br>',$listpros[0][0]);
		print_r($array);
		die;
	}

   print_r($tddetailsvaluearray);die; */
    $result = array();
    $result_table = array();        
    foreach($tddetailsvaluearray[1] as $tabledetails)
    {
        $specvalue=explode('-',strip_tags($tabledetails));
        //print_r($specvalue);
        $valu = $specvalue[0];
         $result[$valu]=$specvalue[1];
        }
        //print_r($result);die;
        $getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
		//print_r($getproductdetails);
        $brand_idslist = $getproductdetails->brands;        
        $mainspecids =array();
        $array_specification = array();
		$lastid = $this->admin_model->dynamic_spec_insert("specification",0);
		$mainspecid[$lastid] =$lastid;
        foreach($result as $key=>$res)
        {
            
            if($getproductdetails->child_id!=0){
                $catdetails = $this->admin_model->get_details_from_id($getproductdetails->child_id,'product_categories','cate_id');
            }
            else{
                $catdetails = $this->admin_model->get_details_from_id($getproductdetails->parent_child_id,'product_categories','cate_id');
            }            
            $category_specs = $catdetails->category_specifications;
			//print_r($category_specs);die;
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
            else
			{
				echo $category_specifications = $lastid;
				}
            $records = array('category_specifications'=>$category_specifications);
            $this->admin_model->update_records('product_categories',$records,'cate_id',$cate_id);

           
                     $lastspec_id = $this->admin_model->dynamic_spec_insert(trim($key),$lastid);
                    $sub_spec_id[$lastspec_id]=$lastspec_id;
                   $array_specification[$lastspec_id]=$res;
               
        }
		//print_r($array_specification);
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

        $categorybrands = $catdetails->category_brands;
        $cate_id = $catdetails->cate_id;
        $hiddenbrands = '';
        if($categorybrands)
        {
            $hiddenbrands = explode(',',$categorybrands);
            if (!in_array($brand_idslist, $hiddenbrands))
            {
                $hiddenbrands[] = $brand_idslist;
            }
            $category_brands_list = implode(',',$hiddenbrands);
        }
        else{$category_brands_list = $brand_idslist;}
        $dataarray_brands = array('category_brands' => $category_brands_list);
        $this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);    
        $hiddenbrands = '';    
        return true;
}

//Ganesh may 

function insert_specifications_from_india($proid,$prourl)
{
    
    $haveresults_set = $this->admin_model->url_parsing($prourl);
    /*print_r($prourl);
    echo $proid;*/
    //echo "<pre>";
    preg_match_all('/<div class="productdetails">(.*?)<\/div>/s',$haveresults_set, $listpros);

   
    preg_match_all('/<table width="100%" border="0" cellspacing="0" cellpadding="0">(.*?)<\/table>/s', $listpros[1][0], $tableslisting);
   
   
    $result = array();
    $result_table = array();        
    
           
            preg_match_all('/<tr>(.*?)<\/tr>/s',$tableslisting[1][0], $trarraydetails);
            echo '<pre>';
          
            $result = array();
    
            foreach($trarraydetails[1] as $trdetails)
            {
				$result_table = array(); 
				//print_r($trdetails);
                preg_match_all('/<td>(.*?)<\/td>/s', $trdetails, $tddetailsarray);
				$thname = trim($tddetailsarray[1][0]);
				if(strpos($tddetailsarray[1][1],'<dl>')!==false)
				{
					
				preg_match_all('/<dt>(.*?)<\/dt>/s', $trdetails, $tddetailskeyarray);
                $speckey = $tddetailskeyarray[1]; 
				
				preg_match_all('/<dd>(.*?)<\/dd>/s', $trdetails, $tddetailsvaluearray);
                $specvalue = $tddetailsvaluearray[1]; 
				foreach($speckey as $key=>$value)
				{
					$result_table[$value]=$specvalue[$key];	
				}
									
				}
				else
				{
					
					 $speckey = trim($tddetailsarray[1][0]);
					 $specvalue = trim($tddetailsarray[1][1]); 
					 $result_table[$speckey]=$specvalue;
					
				}
				 $result[$thname]=$result_table;
                
            }
			//print_r($result);
			
           
        
        $getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
        $brand_idslist = $getproductdetails->brands;        
        $mainspecids =array();
        $array_specification = array();
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

            if($res)
            {                
                foreach($res as $res_key=>$res_val)
                {
                    $lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
                    $sub_spec_id[$lastspec_id]=$lastspec_id;
                    $array_specification[$lastspec_id]=$res_val;
                }
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

        $categorybrands = $catdetails->category_brands;
        $cate_id = $catdetails->cate_id;
        $hiddenbrands = '';
        if($categorybrands)
        {
            $hiddenbrands = explode(',',$categorybrands);
            if (!in_array($brand_idslist, $hiddenbrands))
            {
                $hiddenbrands[] = $brand_idslist;
            }
            $category_brands_list = implode(',',$hiddenbrands);
        }
        else{$category_brands_list = $brand_idslist;}
        $dataarray_brands = array('category_brands' => $category_brands_list);
        $this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);    
        $hiddenbrands = '';    
        return true;
}


function insert_specifications_from_ebay($proid,$prourl)
{
	$haveresults_set = $this->url_parsing($prourl);
	
	
		preg_match_all('/<table width="100%" cellspacing="0" cellpadding="0">(.*?)<\/table>/s', $haveresults_set, $tableslisting);
		
		preg_match_all('/<tr>(.*?)<\/tr>/s',$tableslisting[1][0], $trarraydetails);
		
		foreach($trarraydetails[1] as $trdetails)
				{
					
					preg_match_all('/<td class="attrLabels">(.*?)<\/td>/s', $trdetails, $tddetailsarray);
					
					if($tddetailsarray==''){continue;}
					 $speckey = $tddetailsarray[1];
					
					preg_match_all('/<td width="50.0%">(.*?)<\/td>/s', $trdetails, $tddetailsvaluearray);
					 $specvalue = $tddetailsvaluearray[1];
					
				foreach($speckey as $key=>$value)		
				{
					if(strpos($specvalue[$key],'<div aria-live="polite">')!==false){continue;}
					//$value=str_replace(':','',$value);
					$result_table[trim($value)]=trim(strip_tags($specvalue[$key]));
				}				
					 
				}
				$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
	
}


function insert_specifications_from_shopper($proid,$prourl)
{
	//$page = $this->url_parsing($prourl);
	$cookie_file_path = "cookies.tmp";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders='');
			curl_setopt($ch, CURLOPT_URL, $prourl);
			curl_setopt($ch, CURLOPT_COOKIE, $cookie_file_path);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$page = curl_exec($ch) ; 

	//print_r($page);die;
    preg_match_all('/<div class="container container-responsive">(.*?)<\/div>/is', $page, $tableslisting);
	//print_r($tableslisting);die;
	preg_match_all('/<tr>(.*?)<\/tr>/s',$tableslisting[1][3], $trarraydetails);
	
	
		//print_r($trarraydetails[1]);die;
		
		foreach($trarraydetails[1] as $trdetails)
				{
					
					preg_match_all('/<td class="attrib">(.*?)<\/td>/is', $trdetails, $tddetailsarray);
					
					
					$speckey = $tddetailsarray[1][0].'-';
					
					
					preg_match_all('/<td>(.*?)<\/td>/is', $trdetails, $tddetailsvaluearray);
					
					$specvalue = $tddetailsvaluearray[1][0];
					$result_table[trim($speckey)]=trim($specvalue);
				}
				//print_r($result_table);
				$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
							//echo "SGP".$key;	
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
	
}

function insert_specifications_from_shopclues($proid,$prourl)
{
	
	$haveresults_set = $this->url_parsing($prourl);
	
	
		preg_match_all('/<div>(.*?)<\/div>/s', $haveresults_set, $divlisting);
		//print_r($divlisting);die;
		foreach($divlisting[1] as $trdetails)
		{
		if(strpos($trdetails,'<span>')!==false)
		{
			
					preg_match_all('/<label>(.*?)<\/label>/s', $trdetails, $tddetailsarray);
					
					if($tddetailsarray==''){continue;}
					 echo $speckey = $tddetailsarray[1][0];
					
					preg_match_all('/<span>(.*?)<\/span>/s', $trdetails, $tddetailsvaluearray);
					 echo  $specvalue = $tddetailsvaluearray[1][0];
					 
					 $result_table[trim($speckey)]=trim($specvalue);
					
		}
		}
		
				$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
	
}

function insert_specifications_from_infi($proid,$prourl)
{
	
	
	  $haveresults_set = $this->url_parsing($prourl);
	  //print_r($haveresults_set);die;
		
		preg_match_all( '/<div id="specs">(.*)<\/div>/is', $haveresults_set, $showMoreCompany );
		//print_r($showMoreCompany[1][0]);die;
		preg_match_all( '/<h3>(.*?)<\/h3>/is', $showMoreCompany[1][0], $thname );
		
		preg_match_all( '/<div class="features-list">(.*?)<\/div>/is', $showMoreCompany[1][0], $tabledatails );
		//print_r($tabledatails[1]);
		foreach($thname[1] as $key=>$th_name)
		{
			$result_table='';
			preg_match_all( '/<tr class="row">(.*?)<\/tr>/is', $tabledatails[1][$key], $trdatails );
			foreach($trdatails as $tr)
			{
				preg_match_all( '/<td valign="top" class="tdcolor[^>]*">(.*?)<\/td>/is', $tabledatails[1][$key], $speckey );
				//print_r($speckey[1]);
				
				preg_match_all( '/<td class="tdcolor[^>]*>(.*?)<\/td>/is', $tabledatails[1][$key], $specvalue );
				//print_r($specvalue[1]);die;
				foreach($speckey[1] as $key=>$value)
				{
					$result_table[$value]=$specvalue[1][$key];
				}
				
			}
			if($result_table!='')
			{
			$result[$th_name]=$result_table;
			}
			
		}
		
 		//$keyspec = rtrim(strip_tags(str_replace('</li>',',',$showMoreCompany[1][0])),',');
		/*Key Featurs*/
		/* $keyfeatures = str_replace('-&nbsp;','',$keyspec[1]);
		
		$data = array(
		'key_feature'=>implode(',',$keyfeatures)
		);
		//print_r($data);die;
		$this->db->where('product_id',$proid);	
		$this->db->update('products',$data); */
		
		/*Key Featurs*/
			
		
			$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
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
								
				if($res)
				{				
					foreach($res as $res_key=>$res_val)
					{
						$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res_val;
					}
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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
}


function insert_specifications_from_yepme($proid,$prourl)
{
	
	 $haveresults_set = $this->url_parsing($prourl);
	  //print_r($haveresults_set);die;
		
		preg_match_all( "/<div class='menu_body'>(.*)<\/div>/is", $haveresults_set, $showMoreCompany );
		//print_r($showMoreCompany[1]);
		preg_match_all( '/<li>(.*?)<\/li>/is',$showMoreCompany[1][0], $tddetails );
		
		foreach($tddetails[1] as $td)
		{
		if(strpos($td,'<p style="">')!==false)
		{
		$result=trim(strip_tags($td));
		$results=explode(':',$result);
		
		$speckey=$results[0];
		$specvalue=$results[1];
		$result_table[$speckey]=$specvalue;
		}
		}
		
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
}

function insert_specifications_from_firstcry($proid,$prourl)
{
	
	 $haveresults_set = $this->url_parsing($prourl);
	  //print_r($haveresults_set);die;
		
		preg_match_all( '/<div class="p_acr_sec1 lft dcp"[^>]*>(.*)<\/div>/is', $haveresults_set, $showMoreCompany );
		preg_match_all( '/<span style="[^>]*">(.*?)<\/span>/s', $showMoreCompany[1][0], $thdetails);
		
		echo $key=array_search("Specifications",$thdetails[1]);
		preg_match_all( '/<ul>(.*?)<\/ul>/s',$showMoreCompany[1][0], $trdetails );
		preg_match_all( '/<li>(.*?)<\/li>/s',$trdetails[1][$key], $tddetails );
		//print_r($tddetails);die;
		foreach($tddetails[1] as $td)
		{
			$spec=explode('-',$td);
			$spec_key=$spec[0].'-';
			$spec_value=$spec[1];
			$result_table[$spec_key]=$spec_value;
		}
		
		
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
}


function insert_specifications_from_crom($proid,$prourl)
	{
		
		
		$haveresults_set = $this->admin_model->url_parsing($prourl);
	
		
		preg_match_all('/<div id="view1"class="headline">(.*?)<\/table>/s',$haveresults_set, $listpros);
		 //print_r($listpros[1]);die;
		 
		
		 
		 //print_r($thdetails);die;
		 
		foreach($listpros[1] as $tables)
		{
			
			//unset($tables[0]);
			 //print_r($tables);
			
				$table_result = '';
			 // print_r($tables[1]);die;
			preg_match_all('/<tr>(.*?)<\/tr>/s',$tables,$trdetails);
			//print_r($trdetails);
			// echo '<pre>';
			 //print_r($trdetails);die;
			// print_r($trdetails[1][0]);die;
			foreach($trdetails[1] as $tddetails)
			{
				 
				preg_match_all('/<td class="attrib">(.*?)<\/td>/s',$tddetails,$speckey);
				
				preg_match_all('/<td>(.*?)<\/td>/s',$tddetails, $specvalue);
				
				
				 
				 $result_table[trim($speckey[1][0])]=trim($specvalue[1][0]);
				
			}
			
			
			
		}
		
$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
		
		
		
		
			
	}	
	function insert_specifications_from_jabong($proid,$prourl)
		{
			
			$haveresults_set = $this->admin_model->url_parsing($prourl);
			 //print_r($haveresults_set);die;
		
			
		preg_match_all( '/<ul class="prod-main-wrapper">(.*?)<\/ul>/mis', $haveresults_set,$craft_speci);
		
		 //print_r($craft_speci[1][0]);die;
		
		preg_match_all( '/<li>(.*?)<\/li>/s', $craft_speci[1][0], $tddetailsvaluearray );
		
		 //print_r($tddetailsvaluearray);die;
		 //print_r($tddetailsvaluearray);die;
		
		foreach($tddetailsvaluearray[1] as $spec)
		{
			preg_match_all( '/<span class="product-info-left">(.*?)<\/span>/s', $spec, $spec_key );
			
			preg_match_all( '/<span>(.*?)<\/span>/s', $spec, $spec_value );
			
			$result_table[trim($spec_key[1][0])]=trim(strip_tags($spec_value[1][0]));
		
		}
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
		}

	// sharmila ... 03/06/2016...

	function insert_specifications_from_landmark($proid,$prourl)
	{
		// $proid = 363;
		//$prourl = 'http://www.landmarkshops.in/Women/Accessories/Watches/GIORDANO-2734-33-Analog-Watch/p/1000004446908';
		
		$haveresults_set = $this->admin_model->url_parsing($prourl);
		
		preg_match_all('/<div class="col-sm-5 col-xs-6" id="product-details-lists-col1">(.*?)<\/div>/is',$haveresults_set, $listpros);
		
		preg_match_all('/<ul id="product-details-list1">(.*?)<\/ul>/is',$listpros[1][0], $thdetails);
		
		preg_match_all('/<li id="product-details-list-item(.*?)">(.*?)<\/li>/is',$thdetails[1][0], $speckey1);
		
		preg_match_all('/<ul id="product-details-list2">(.*?)<\/ul>/is',$haveresults_set, $listpros1);

		preg_match_all('/<li id="product-details-list-item(.*?)">(.*?)<\/li>/is',$listpros1[1][0], $speckey2);

		$speckey = array_merge($speckey1[2], $speckey2[2]);
		
		foreach($speckey as $spec)
		{	
			$specvalue=explode(':',strip_tags($spec));
			$result[$specvalue[0].'-']=$specvalue[1];
		}
		 
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids = array();
			$array_specification = array();
		
				$lastid = $this->admin_model->dynamic_spec_insert("specification",0);
				$mainspecid[$lastid] =$lastid;
			foreach($result as $key=>$res)
			{
				
				if($getproductdetails->child_id!=0)
				{
					$catdetails = $this->admin_model->get_details_from_id($getproductdetails->child_id,'product_categories','cate_id');
				}
				else{
					$catdetails = $this->admin_model->get_details_from_id($getproductdetails->parent_child_id,'product_categories','cate_id');
				}	
				/*echo 'dghjdgj';
				print_r($catdetails);die;*/
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
								
				
						$last_subid = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$last_subid]=$last_subid;
						$array_specification[$last_subid]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
	}

	function insert_specifications_from_rediff($proid,$prourl)
	{
		// $proid = 363;
		//$prourl = 'http://shopping.rediff.com/product/Foot-quotN-quotStyle-Black-Casual-Shoes-For-MenCode-3149/15126892?sc_cid=EditSec-cricket2_15126892';
		
		$haveresults_set = $this->admin_model->url_parsing($prourl);
		// print_r($haveresults_set);die;
		preg_match_all('/<div class="feature_left_details e_left_margin">(.*?)<\/table>/s',$haveresults_set, $listpros);
		// print_r($listpros);		
		preg_match_all('/<tr>(.*?)<\/tr>/is',$listpros[1][0], $thdetails);
		
		echo '<pre>';
		//print_r($thdetails[1][0]);die;
		preg_match_all('/<DIV class=lf>(.*?)<\/div>/s', $thdetails[1][0], $speckey);
	
		
		preg_match_all('/<DIV class=rt>(.*?)<\/div>/s', $thdetails[1][0], $specvalue);
		
		
		foreach($speckey[1] as $key=>$keyvalue)
		{	
			$result[$keyvalue]=$specvalue[1][$key];
		}
		 // print_r($result);die;
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;
			// print_r($getproductdetails);die;
			$mainspecids = array();
			$array_specification = array();
		
				$lastid = $this->admin_model->dynamic_spec_insert("specification",0);
				$mainspecid[$lastid] =$lastid;
			foreach($result as $key=>$res)
			{
				
				if($getproductdetails->child_id!=0)
				{
					// echo $getproductdetails->child_id;die;
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
								
				
						$last_subid = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$last_subid]=$last_subid;
						$array_specification[$last_subid]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
	}

	function insert_specifications_from_cross($proid,$prourl)
			{
				// $proid = 363;
				//$prourl = 'http://www.crossword.in/home/bollywood-deception-juggi-bhasin/p-1341200-17784703627-cat.html#variant_id=1341200-17784703627';
				$haveresults_set = $this->admin_model->url_parsing($prourl);
				// print_r($haveresults_set);die;
			preg_match('/<div id="features" class="clearfix">(.*?)<\/div>/s',$haveresults_set,$craft_speci);
				// print_r($craft_speci[1]);die;
			preg_match_all( '/<ul>(.*?)<\/ul>/mis', $craft_speci[1], $showMoreCompany );
			// print_r($showMoreCompany);die;
			preg_match_all( '/<li class="clearfix">(.*?)<\/li>/s', $showMoreCompany[1][0], $tddetailsvaluearray );
			// print_r($tddetailsvaluearray);die;
			foreach($tddetailsvaluearray[1] as $spec)
			{
				$specvalue=explode(':',strip_tags($spec));
				$result[$specvalue[0]]=$specvalue[1];
			
			}
		
			// print_r($result);die;
			$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids = array();
			$array_specification = array();
		
				$lastid = $this->admin_model->dynamic_spec_insert("specification",0);
				$mainspecid[$lastid] =$lastid;
			foreach($result as $key=>$res)
			{
				
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
								
				
						$last_subid = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$last_subid]=$last_subid;
						$array_specification[$last_subid]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		}
		
		function insert_specifications_from_urbanladder($proid,$prourl)
		{
			
			$haveresults_set = $this->admin_model->url_parsing($prourl);
			 
		 preg_match("/<div class='content  ' id='properties-[^>]*'>(.*?)<\/div>/s",$haveresults_set,$listpros);
			
		preg_match_all( '/<li>(.*?)<\/li>/s', $listpros[1], $trdetails);
		
		
		
		
		
		
		foreach($trdetails[1] as $spec)
		{
			
			preg_match_all( "/<span class='property_key'>(.*?)<\/span>/s", $spec, $spec_key);
			
			preg_match_all( "/<span class='property_val'>(.*?)<\/span>/s", $spec, $spec_value);
			
			$result_table[trim($spec_key[1][0]).'-']=trim(strip_tags($spec_value[1][0]));
		}
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
			$lastid = $this->admin_model->dynamic_spec_insert('specification',0);
				$mainspecid[$lastid] =$lastid;
			foreach($result_table as $key=>$res)
			{
				
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
								
						$lastspec_id = $this->admin_model->dynamic_spec_insert($key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res;
					

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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		}
		
		
		function insert_specifications_from_naaptol($proid,$prourl)
		{
			/* $proid=520;
			$prourl='http://www.naaptol.com/mobile-handsets/n/p/12541841.html'; */
			
			$haveresults_set = $this->admin_model->url_parsing($prourl);
			
			preg_match_all( '/<div class="produc_Details">(.*?)<\/div>/s', $haveresults_set, $showMoreCompany );
			
			preg_match_all( '/<li>(.*?)<\/li>/s',$showMoreCompany[1][0], $keyfeatures );
			
 		$keyfeaturess=implode(',',$keyfeatures[1]);
		/*Key Featurs*/
		
		$data = array(
		'key_feature'=>trim($keyfeaturess)
		);
		$this->db->where('product_id',$proid);	
		$this->db->update('products',$data);
		
		/*Key Featurs*/
			 
		 preg_match('/<div id="featureLayout">(.*?)<\/div>/s',$haveresults_set,$listpros);
		 
		 			
		preg_match_all( '/<ul class="specification_table clearfix" id="feature[^>]*">(.*?)<\/ul>/s', $listpros[1], $tabledetails);
		
		foreach($tabledetails[1] as $table)
		{
			$result_table='';
			preg_match_all( '/<p class="spec_head">(.*?)<\/p>/s', $table, $thname);
			//echo $thname[1][0];
			
			preg_match_all( "/<li>(.*?)<\/li>/s", $table, $spec_key);
			//print_r($spec_key[1]);
			foreach($spec_key[1] as $key=>$specs)
			{
				
				$specsval = preg_replace('/<a+[^>]*>.*?<\/a>/s','',$specs);
				
				if($key%2==0)
				{
									
					 $spec_key=$specsval.':'; 
										
				}
				else
				{
					if(strpos($specsval,'<span class="yes">')!==false)
					{
					
						 $spec_value='yes';
						}
				else
				{
					 $spec_value=$specsval;
				}
				$result_table[trim($spec_key)]=trim($spec_value);
				}
			}
			if($result_table!="")
			{
			$result[$thname[1][0]]=$result_table;
			}
		}
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
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
								
				if($res)
				{				
					foreach($res as $res_key=>$res_val)
					{
						$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res_val;
					}
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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
		}
		
		
		function insert_specifications_from_themobile($proid,$prourl)
		{
			 
			
			$haveresults_set = $this->admin_model->url_parsing($prourl);
			
			preg_match_all( '/<div class="feature_groups_new">(.*?)<\/div>/s', $haveresults_set, $showMoreCompany );
			$divdetails=$showMoreCompany[1][0];
			
			
				preg_match_all( '/<table class="specTable"[^>]*>(.*?)<\/table>/s',$divdetails, $tables );
				$result='';
				
				foreach($tables[1] as $tr)
				{
					preg_match_all( '/<th class="groupHead"[^>]*>(.*?)<\/th>/s',$tr, $tddetails );
					 $thname=strip_tags($tddetails[1][0]);
					preg_match_all( '/<tr>(.*?)<\/tr>/s',$tr, $trdetails );
					$result_table='';
					foreach($trdetails[1] as $td)
					{
						
						
						
						preg_match_all( '/<td class="specsKey">(.*?)<\/td>/s',$td, $speckey );
						$spec_key=$speckey[1][0];
						$speckey = preg_replace('/&nbsp;/s','',$spec_key);
						preg_match_all( '/<td class="specsValue">(.*?)<\/td>/s',$td, $specvalue );
						$specvalue=$specvalue[1][0];
						$specsval = preg_replace('/&nbsp;/s','',$specvalue);
						if($speckey)
						{
						$result_table[trim($speckey)]=trim(strip_tags($specsval));
						}
						
						
					}
					$result[$thname]=$result_table;
					
				}
			
 		
		$getproductdetails  = $this->admin_model->get_details_from_id($proid,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecids =array();
			$array_specification = array();
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
								
				if($res)
				{				
					foreach($res as $res_key=>$res_val)
					{
						$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res_val;
					}
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
				
			$categorybrands = $catdetails->category_brands;
			$cate_id = $catdetails->cate_id;
			$hiddenbrands = '';
			if($categorybrands)
			{
				$hiddenbrands = explode(',',$categorybrands);
				if (!in_array($brand_idslist, $hiddenbrands))
				{
					$hiddenbrands[] = $brand_idslist;
				}
				$category_brands_list = implode(',',$hiddenbrands);
			}
			else{$category_brands_list = $brand_idslist;}
			$dataarray_brands = array('category_brands' => $category_brands_list);
			$this->admin_model->update_records('product_categories',$dataarray_brands,'cate_id',$cate_id);	
			$hiddenbrands = '';	
			return true;
		
		}
		
		
		function get_redamptions()
		{
			$this->db->connection_check();
	$this->db->order_by('redamption_id','desc');
		$result = $this->db->get('redamptions');
		if($result->num_rows > 0){
			return $result->result();
		}
		}
		
		function view_points($user_id){
		$this->db->connection_check();
		$balace = $this->db->get_where('tbl_users',array('user_id'=>$user_id))->row('ads_points');
		return $balace;
	}
	
	function editredamptions($id){
		$this->db->connection_check();
		$this->db->where('redamption_id',$id);
		$result = $this->db->get('redamptions');
		if($result->num_rows > 0){
			return $result->result();
		}
		return false;
	}
	
	function updateredamption($id){
		$this->db->connection_check();
		 
		$current_status = $this->input->post('current_status');
		$date = date('Y-m-d');
		
			$data = array(
				'status'=>$current_status,
				'date_closed'=>$date
			);
				$this->db->where('redamption_id',$id);
		$updation = $this->db->update('redamptions',$data);
		
		$this->db->where('admin_id','1');
	$query_admin = $this->db->get('admin');
		if($query_admin->num_rows >= 1){
			 $admin_emailid=$query_admin->row('admin_email');
		}
		
		if($updation!="")
		{
		
		 $emails=$this->input->post('user_mail');;
		 $subject_new='ads';
		 $gd_message=$this->input->post('description');
		$send=$this->mail_function($admin_emailid,$emails,$subject_new,$gd_message);
		return true;
		}
		else 
		{ 
			return false;
		}
	}
	function delete_redamption($id)
	{
		$this->db->connection_check();
		$this->db->delete('redamptions',array('redamption_id'=>$id));
		return true;
	}
	
	function click_history1($count=null){
		$this->db->connection_check();
		if($count==0 & $count!='')
		{
			
			$date=date('Y-m-d');
			$this->db->where('DATE(date_added)',$date);
			
		}
		else if($count==1)
		{
			$date=date('Y-m-d',strtotime('-'.$count.' days'));
			$this->db->where('DATE(date_added)=',$date);
			
		}
		else if($count>1)
		{
			$date=date('Y-m-d',strtotime('-'.$count.' days'));
			$this->db->where('DATE(date_added)>=',$date);
			
		}
		else
		{
			
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
	
	function remove_pclickhistroy($de_pid)
	{
		$this->db->connection_check();
		
		
		$this->db->where('click_id', $de_pid);
      $this->db->delete('product_clickhistory'); 
	  $this->db->last_query();
		return true;
	}
	function contact_details($id)
	{
		$this->db->connection_check();
		$this->db->where('id', $id);
		$cont=$this->db->get('tbl_contact');
		if($cont->num_rows()>0)
		{
			return $cont->row();
		}
	}
	function send_rely_contact()
	{
		$this->db->connection_check();
		$id=$this->input->post('rid');
		$this->db->where('admin_id',1);
		$admin_det = $this->db->get('admin');
		if($admin_det->num_rows >0) 
		{    
			 $admin = $admin_det->row();
			 $admin_email = $admin->admin_email;
			 
		}
		$user=$this->input->post('mail');
		$message=$this->input->post('reply');
		$sub='reply from ADS';
		$this->mail_function($admin_email,$user,$sub,$message);
		
		$data=array('status'=>1);
		$this->db->where('id',$id);
		$this->db->update('tbl_contact',$data);
		return true;
	}
	function get_search_products($key=null)
	{
		$this->db->connection_check();
		$this->db->like('product_name', $key);
		$cont=$this->db->get('products');
		if($cont->num_rows()>0)
		{
			return $cont->result();
		}
	}
	/* function flipk()
	{
		$this->db->select('b.*');
		$this->db->from('products a');
		$this->db->join('product_price b', 'a.default_store = b.store_id');
		$this->db->where('a.spec_st =',0);
		$this->db->group_by('b.product_id');
		$pqry=$this->db->get();
		
		
		if($pqry->num_rows()>0)
		{
			$products=$pqry->result();
		}
		$i=0;
		//print_r($products);
		foreach($products as $pro)
		{
			echo $pro->product_url;
		$haveresults_set = $this->url_parsing($pro->product_url);
		
		preg_match_all('/<div id="veiwMoreSpecifications" class="productSpecs specSection viewmoreSpec specificationViewMore">(.*?)<\/div>/s',$haveresults_set, $listpros); 
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
			$getproductdetails  = $this->admin_model->get_details_from_id($$pro->product_id,'products','product_id');
			$brand_idslist = $getproductdetails->brands;		
			$mainspecid =array();
			$array_specification = array();
			$sub_spec_id=array();
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
								
				if($res)
				{	
			
					foreach($res as $res_key=>$res_val)
					{
						$lastspec_id = $this->admin_model->dynamic_spec_insert($res_key,$lastid);
						$sub_spec_id[$lastspec_id]=$lastspec_id;
						$array_specification[$lastspec_id]=$res_val;
					}
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
						'spec_st'=>1
				);
				$this->admin_model->update_records('products',$dataarray_spec,'product_id',$pro->product_id);	
				$i++;
		}
	} */

}

?>