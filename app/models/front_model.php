<?php
class Front_model extends CI_Model
{
	function home_slider()
	{
		$this->db->connection_check();
		$this->db->where("banner_status",'1');
		$this->db->where("banner_position",'0');
		$query = $this->db->get('tbl_banners');
		return $query->result();
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
	function email_sub($email)
	{
		$this->db->connection_check();
		$this->db->where('subscriber_email',$email);
		$query = $this->db->get('subscribers');
		if($query->num_rows() == 0)
		{
			$date = date('Y-m-d h:m:s');
			$data = array(
			'subscriber_email' => $email,
			'subscriber_status' => '1',
			'date_subscribed' => $date
			);
			$this->db->insert('subscribers',$data);
			return 1;
		}
		else
			return 0;
	}
	
//list out Header menu

	function header_menu()
	{
		$this->db->connection_check();
		$this->db->where('cms_status','1');
		$this->db->where('cms_position','header');
		$query = $this->db->get('tbl_cms');
		if($query->num_rows() > 0)
			return $query->result();
	}
	
//list out sub footer menu
	
	function sub_menu()
	{
		$this->db->connection_check();
		$this->db->where('cms_status','1');
		$this->db->where('cms_position','footer');
		$query = $this->db->get('tbl_cms');
		if($query->num_rows() > 0)
			return $query->result();
	}

//header menu link
	function cms_content($names)
	{
		$this->db->connection_check();
		$this->db->where("cms_title",$names);
		$this->db->order_by('cms_id','desc');
		$query = $this->db->get('tbl_cms');
		//$result = $this->db->query("select * from tbl_cms where cms_title='$names'")->row();
		if($query->num_rows() > 0)
			return $query->result();
	}

//Refer Friends

	function refer_friends()
	{
		$this->db->connection_check();
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id',$user_id);
		$this->db->where('admin_status','');
		$query = $this->db->get('tbl_users');
		
		//$result = $this->db->get_where('tbl_users',array('user_id'=>'2'))->row('random_code');
		return $query->result();
	}

//mail function
	
	function invite_mail()
	{
		$this->db->connection_check();
		$mail = $this->input->post('email');
		$random = $this->input->post('random');
		$mail_text = $this->input->post('mail_text');
		
		$mail_temp = $this->db->query("select * from tbl_mailtemplates where mail_id='8'")->row();
			$fe_cont = $mail_temp->email_template;
			$subject = $mail_temp->email_subject;
			$name = $this->db->query("select * from admin")->row();
			echo $admin_emailid = $name->admin_email;
			$contact_number = $name->contact_number;
			 $site_logo = $name->site_logo;
			$servername = base_url();
		$nows = date('Y-m-d');	
		$sep_email = explode(',',$mail);
		$this->load->library('email');
		//echo "sasa";
		if($sep_email){
			foreach($sep_email as $emails)
			{
				
				$gd_api=array(
					'###EMAIL###'=>$emails,
					'###SITENAME###'=>$name->site_name,
					'###ADMINNO###'=>$contact_number,
					'###DATE###'=>$nows,
					'###CONTENT###'=>$mail_text."<br><br> <h2><a href='".base_url()."cashback/register/".$random."'>Click here to Activate</a> and get all the offers</h2>",
					'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
					'###URL###'=>'<a href='.$servername.$random.'></a>'
				);
				
				 $gd_message=strtr($fe_cont,$gd_api);

				
				$sub_data = array(
						'###SITENAME###'=>$site_name
					);
		   
	    		 $subject_new = strtr($subject,$sub_data);
				/*$config = Array(
					 'mailtype'  => 'html',
					  'charset'   => 'utf-8',
					  );*/
				/*$this->email->initialize($config);        
				$this->email->set_newline("\r\n");
				$this->email->from($admin_emailid);
				$this->email->to($emails);
				$this->email->subject($subject);
				$this->email->message($gd_message);
				$this->email->send();
				$this->email->print_debugger();*/
				$this->mail_function($admin_emailid,$emails,$subject_new,$gd_message);
				
			}
			return true;		
		}
		return false;
	}
	
	/* function mail_content()
	{
		
		
		$this->db->where('mail_id',6);
		$result = $this->db->get('tbl_mailtemplates');
		$results = $this->db->get('admin');
		return $result;
		
	} */

//insert contact form
	function contact_form()
	{
		$this->db->connection_check();
		$data = array(
		'name' => $this->input->post('name'),
		'email' => $this->input->post('email'),
		'message' => $this->input->post('message'),
		);
		$this->db->insert('tbl_contact',$data);
		
		//send email 		
		
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
		$name = $this->input->post('name');
		$useremail = $this->input->post('email');
		$message = $this->input->post('message');
		
		$this->db->where('mail_id',7);
		$mail_template = $this->db->get('tbl_mailtemplates');
		if($mail_template->num_rows >0) 
		{        
		   $fetch = $mail_template->row();
		   $subject = $fetch->email_subject;  
		   $templete = $fetch->email_template;  
		   //$regurl=base_url().'cashback/verify_account/'.$new_random;
		   
			/*$this->load->library('email'); 
			  
			$config = Array(
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
			);*/
				// $this->email->initialize($config);        
			/* $this->email->set_newline("\r\n");
			    
			   
			   $this->email->initialize($config);        
			   $this->email->from($useremail);
			   $this->email->to($admin_email);
			   $this->email->subject($subject);		   */
		   $sub_data = array(
						'###SITENAME###'=>$site_name
					);
		   // print_r($sub_data);die;
	    $subject_new = strtr($subject,$sub_data);
		   
			$data = array(
				        '###USERNAME###'=>$name,
						'###CONTENT###'=>$message,
						'###COMPANYLOGO###' =>base_url()."/uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date						
						
		   );
		   // print_r($data);die;
		   $content_pop=strtr($templete,$data);		
		  // echo $content_pop;exit;		   
		  /* $this->email->message($content_pop);
		   $this->email->send(); */ 
		   $this->mail_function($admin_email,$useremail,$subject_new,$content_pop);
		}
		return true;
	}

////Referral Friends Network	
	function referral_network()
	{
		$this->db->connection_check();
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get("referrals");
		if($query->num_rows() > 0)
			return $query->result();
	}	

//login (SL) 
	function login()
	{
		
		$this->db->connection_check();
		$user_email = $this->input->post('email');
		$user_pwd = $this->input->post('pwd');
		if($user_pwd==" " || $user_pwd=="  " || $user_pwd=="   " || $user_pwd=="    " || $user_pwd=="     ")
		{
			$user_pwd="/*@";
		}
		else
		{
			$user_pwd=$user_pwd;
		}
		
		
		$this->db->where('email',$user_email);
		$this->db->where('password like BINARY "'.$user_pwd.'"',NULL, FALSE);
		$this->db->where('admin_status','');
	
		$query = $this->db->get('tbl_users');
		$numrows = $query->num_rows();
		if($numrows==1)
		{
			$fetch = $query->row();
			$user_id = $fetch->user_id;
			$user_email=$fetch->email;
			$status = $fetch->status;
			if($status =='0'){
				return 2;
			} else {			
			//set session 
			$this->session->set_userdata('user_id',$user_id);
			$this->session->set_userdata('user_email',$user_email);
			//echo $this->session->userdata('user_id');
			//echo $this->session->userdata('user_email');
			return 1;
			}
	   }
		
		return 0;
	}
	
	//registration form..	
	function register()
	{
		$this->db->connection_check();
		$user_contact = $this->input->post('contact_no');
		$new_random = mt_rand(1000000,99999999);
		$user_email = $this->input->post('user_email');
		$date = date('Y-m-d h:i:s');
		$uni_id = $this->input->post('uni_id');
		if($uni_id)
		{
			$this->db->where('random_code',$uni_id);
			$this->db->where('admin_status','');
			$query = $this->db->get('tbl_users');
			if($query->num_rows > 0)
			{	
				$fetch = $query->row();
				$user_id = $fetch->user_id;
			}
			else
			{
				$user_id = 0;
			}
		}
		else
		{
			$user_id = 0;
		}
		$data = array(		
		'first_name'=>$this->input->post('first_name'),
		/*'last_name'=>$this->input->post('last_name'),*/
		'email'=>$user_email,
		/*'street'=>$this->input->post('street'),
		'city'=>$this->input->post('city'),
		'state'=>$this->input->post('state'),
		'zipcode'=>$this->input->post('zipcode'),
		'country'=>$this->input->post('country'),*/
		'contact_no'=>$this->input->post('contact_no'),
		'password'=>$this->input->post('user_pwd'),
		'random_code'=>$new_random,
		'refer'=>$user_id,
		'date_added'=>$date
		);
		//print_r($data);
		//exit;
		$this->db->insert('tbl_users',$data);
		 //echo $this->db->last_query();die;
		if($this->session->userdata('reg_uniq_id')){
			$this->session->unset_userdata('reg_uniq_id');
		}
		$uni_id = $this->input->post('uni_id');
		if($uni_id)
		{
			$this->db->where('random_code',$uni_id);
			$this->db->where('admin_status','');
			$query = $this->db->get('tbl_users');
			if($query->num_rows() > 0)
			{	
				$fetch = $query->row();
				$user_id = $fetch->user_id;
				$email =$fetch->email;
				
				$datas = array(
				'user_id' => $user_id,
				'user_email' => $email,
				'referral_email' => $user_email,
				'date_added' => $date
				);
				 $this->db->insert('referrals',$datas);
			}
		}
		 //return true;
		  // $sms = $this->send_sms($user_contact,$new_random);

		 // print_r($sms);die;

		//send email ...
		/*if($sms)
		{*/
			// echo 'dfhdjh';die;
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
		
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$user_email = $this->input->post('user_email');
		
		$this->db->where('mail_id',1);
		$mail_template = $this->db->get('tbl_mailtemplates');
		if($mail_template->num_rows >0) 
		{        
		   $fetch = $mail_template->row();
		   $subject = $fetch->email_subject;  
		   $templete = $fetch->email_template;  
		   $regurl=base_url().'cashback/verify_account/'.$new_random;
		   
		  
			   // $this->email->subject($subject);
			    $sub_data = array(
						'###SITENAME###'=>$site_name
					);
			   $subject_new = strtr($subject,$sub_data);
		   
		   
		   $data = array(
						'###USERNAME###'=>$first_name,
						'###COMPANYLOGO###' =>base_url()."/uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
						'###LINK###'=>'<a href='.$regurl.'>'.$regurl.'</a>'
						
		   );
		   // print_r($data);die;
		   $content_pop=strtr($templete,$data);	
		  /*  $from = $admin_email;
			$to= $user_email;*/
			/*$ci = get_instance();
			$ci->load->library('email');
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = $ad['admin_smtp_email'];
			$config['smtp_pass'] = $ad['admin_smtp_pwd'];
			$config['smtp_user'] = 'anuangusamy@gmail.com';
			$config['smtp_pass'] = 'abinandu';
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";
			$ci->email->initialize($config);
			$ci->email->from($from, $ad['email_name']);
			$ci->email->to($to);
			$this->email->reply_to($from, $ad['email_name']);
			$ci->email->subject($subject_new);
			$ci->email->message($content_pop);
			$send=$ci->email->send();*/
			$this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
			return true;                
		}
	/*}*/	
		 // return true;   
	}
	
	//check Email 
	function check_email($email)
	{
		$this->db->connection_check();
		$this->db->where('email',$email);
		$this->db->where('admin_status','');
		
		$qry = $this->db->get('tbl_users');
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
	
	
	
	//get all countries
	function get_allcounties()
	{
		$this->db->connection_check();
		$fetcountry = $this->db->get('country');
		if($fetcountry->num_rows > 0)
		{		
			return $fetcountry->result();
		}
		return false;
	}
	//get the particular users details
	function edit_account($user_id)
	{
		$this->db->connection_check();
	   $this->db->where('user_id',$user_id);
	   $this->db->where('admin_status','');
		$user_details = $this->db->get('tbl_users');
		if($user_details->num_rows > 0){
			return $user_details->row();
		}
		return false;	
	}
	//update the user details
	function update_account()
	{
		$this->db->connection_check();
		$edit_id = $this->input->post('user_id');
		$data = array(		
		'first_name' => $this->input->post('first_name'),
		'last_name' => $this->input->post('last_name'),
		'street' => $this->input->post('street'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'contact_no' => $this->input->post('contact_no'),
		'payu_key'=>$this->input->post('merchant_key'),
		'payu_id'=>$this->input->post('merchant_id'),
		'salt'=>$this->input->post('salt_id'),
		'payu_email'=>$this->input->post('payu_email')
		);
		
		$this->db->where('user_id',$edit_id);
		$this->db->where('admin_status','');
		$update_qry = $this->db->update('tbl_users',$data);
		if($update_qry)
		{
			return true;
		}
		else 
		{ 
			return false;
		}	
	}
	
	//update password
	function update_password()
	{
		$this->db->connection_check();
		 $old_password = $this->input->post('old_password');
		 $new_password = $this->input->post('new_password');
		 $id = $this->input->post('user_id');
		
			$where = array('password'=>$old_password,'user_id'=>$id);
			$this->db->where($where);
			
			$query = $this->db->get('tbl_users');
			if($query->num_rows >= 1) 
			{
				$data = array(
				'password'=>$new_password
				);
				//print_r($data);
				//exit;
				$this->db->where('user_id',$id);	
				$this->db->update('tbl_users',$data);
				return true;
			}    
			else 
			{     
				return false;
			}			
	}
	
	//bankpayment form
	function bankpayment()
	{
		$this->db->connection_check();
		 $new_id = $this->input->post('user_id');
		 $con_pwd = $this->input->post('con_pwd');
		 $type=$this->input->post('type_user');
		 
		/* $where = array('password'=>$con_pwd,'user_id'=>$new_id);
		$this->db->where($where); */
		if($type!=0)
		{
		$this->db->where('password',$con_pwd);
		}
		$this->db->where('user_id',$new_id);
		$query = $this->db->get('tbl_users');
		if($query->num_rows >= 1) 
		{
			$data = array(		
			'account_holder' => $this->input->post('act_holder'),
			'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('bank_brch_name'),
			'account_number' => $this->input->post('act_no'),
			'ifsc_code' => $this->input->post('ifsc_code')
			);
			//print_r($data);
			//exit;
			$this->db->where('user_id',$new_id);	
			$this->db->update('tbl_users',$data);
			return true;
		}    
		else 
		{     
			return false;
		}			
	}
	//get all state
	function get_state($user_id)
	{
		$this->db->connection_check();
		$result = $this->db->get_where('tbl_users',array('user_id'=>$user_id))->row('country');
		//print_r($result);
		
		$this->db->where('country_id',$result);
		$res = $this->db->get('state');
		if($res->num_rows > 0){
			return $res->result();
		}
		return false;	
		
	}
	//cheque_payment
	function cheque_payment()
	{
		$this->db->connection_check();
		$us_id = $this->input->post('user_id');
		$con_pwd = $this->input->post('cheque_confirm_pwd');
		
		$where = array('password'=>$con_pwd,'user_id'=>$us_id);
		$this->db->where($where);
		$query = $this->db->get('tbl_users');
		if($query->num_rows >= 1) 
		{
			$data = array(		
			'cheque_full_name' => $this->input->post('cheque_full_name'),
			'cheque_full_address' => $this->input->post('cheque_full_adr'),
			'cheque_city' => $this->input->post('cheque_city'),
			'cheque_state' => $this->input->post('cheque_state'),
			'cheque_postel_code' => $this->input->post('cheque_postal_code'),
			'cheque_contact_no' => $this->input->post('cheque_contact_no')
			);
			//print_r($data);
			//exit;
			$this->db->where('user_id',$us_id);	
			$this->db->update('tbl_users',$data);
			return true;
		}    
		else 
		{     
			return false;
		}	
	}
	
	
	//forget password
	function forgetpassword()
	{
		$this->db->connection_check();
		$email =$this->input->post('email');
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
			  $site_logo = $admin->site_logo;
		}
		
		$date =date('Y-m-d');
		
		$this->db->where('email',$email);
		$this->db->where('admin_status','');
		$query = $this->db->get('tbl_users');
		if($query->num_rows >0) 
		{
			$getuser = $query->row();
			$user_id = $getuser->user_id;
			$password = $getuser->password;
			$first_name = $getuser->first_name;
			$last_name = $getuser->last_name;
		    $user_email =  $getuser->email;
			$random_id =$getuser->random_code;
			$this->db->where('mail_id',2);
			$mail_template = $this->db->get('tbl_mailtemplates');
			// echo $admin_email;die;
			if($mail_template->num_rows >0) 
			{   
				// echo 'fdhfhdk';die;
			   $fetch = $mail_template->row();
			   $subject = $fetch->email_subject; 
			   // echo $subject; 
			   $templete = $fetch->email_template;  
			   // echo $templete;die;
			  $regurl=base_url().'cashback/password_reset/'.insep_encode($user_id);
			 
			 	
		
			    $sub_data = array(
						'###SITENAME###'=>$site_name
					);
			   $subject_new = strtr($subject,$sub_data);
			   
			   $data = array(
							'###USERNAME###'=>$first_name.' '.$last_name,
							'###PASSWORD###'=>$password,
							'###SITENAME###'=>$site_name,
							'###ADMINNO###'=>$admin_no,
							'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
							'###DATE###'=>$date,
							'###LINK###'=>'<a href='.$regurl.'>'.'Click here'.'</a>'
							
			   );
			   // print_r($data);die;
			   $content_pop=strtr($templete,$data); 
				

			/*$from = $admin_email;
			$to= $user_email;
			$ci = get_instance();
			$ci->load->library('email');
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = $ad['admin_smtp_email'];
			$config['smtp_pass'] = $ad['admin_smtp_pwd'];
			$config['smtp_user'] = 'anuangusamy@gmail.com';
			$config['smtp_pass'] = 'abinandu';
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";
			$ci->email->initialize($config);
			$ci->email->from($from, $ad['email_name']);
			$ci->email->to($to);
			$this->email->reply_to($from, $ad['email_name']);
			$ci->email->subject($subject_new);
			$ci->email->message($content_pop);
			$send=$ci->email->send();*/
			$this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
			return true;    	          
			}
			       
		}
		   
			else{
				return false;                
			}   
		
		
	}
	//reset_password
	function reset_password($user_id)
	{
		/*echo $user_id;
		exit;*/
		$this->db->connection_check();
		if(!isset($user_id))
		{
			$user_id = $this->input->post('user_id');
		}
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
					
		$where = array('user_id'=>$user_id);
		// print_r($where);
		// exit;
		$this->db->where($where);
		
		$query = $this->db->get('tbl_users');
		if($query->num_rows >0) 
		{
			$data = array(
			'password'=>$new_password
			);
			//print_r($data);
			//exit; 
			$this->db->where('user_id',$user_id);	
			$this->db->update('tbl_users',$data);
			return true;
		}    
		else 
		{     
			return false;
		}		
		
	}
	//refer_friends
	function get_random($user_id)
	{
		$this->db->connection_check();
		$res =$this->db->get_where('tbl_users',array('user_id'=>$user_id))->row('random_code');
			
			return $res;
	}
//End (SL)
//End (SL)

/*********************Nathan Start*************************/
/******Nov 19 th*********/
	function get_category_details($categoryurl) //get_category_details
	{
		$this->db->connection_check();
		$this->db->where('category_url',$categoryurl);
		$query = $this->db->get('categories');
		if($query->num_rows >= 1)
		{
		   $row = $query->row();
		   return $row;
		}
		return false;
	}
	
	function get_category_details_byid($categoryid) //get_category_details
	{
		$this->db->connection_check();
			$this->db->where('category_id',$categoryid);
			$query = $this->db->get('categories');
			if($query->num_rows >= 1)
			{
			   $row = $query->row();
			   return $row;
			}
			return false;
	}
	
	

	function get_subcategories($category_id)
	{
		$this->db->connection_check();
			$this->db->where('cate_id',$category_id);
			$query = $this->db->get('sub_categories');
			if($query->num_rows >= 1)
			{
			   $row = $query->row();
			   return $query->result();
			}
			return false;
	}
	
	function get_coupons($categories)
	{
		$this->db->connection_check();
		$k=0;
		foreach($categories as $catenames)
		{
			if($k==0)
			{
				$this->db->like('title', $catenames);				
			}
			else
			{
				$this->db->or_like('title', $catenames); 
			}
			$k++;
		}
		
		
		
	}
	
	function get_stores_list($category_id)
	{
		$this->db->connection_check();
		$this->db->order_by("sort_order", "ASC");		
		$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('affiliate_status','1');
		$query = $this->db->get('affiliates');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	
	function referal_percentage()
	{
		$this->db->connection_check();
		$query = $this->db->get('admin');
		if($query->num_rows >= 1)
		{
		   return $query->row('referral_cashback');
		}
	}
	
	// get all faqs..
	function get_allfaqs(){
		$this->db->connection_check();
		$this->db->where('status','1');
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
	
	function user_balance($user_id=null)
	{
		$this->db->connection_check();
		if($user_id!="")
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('admin_status','');
			$allfaqs = $this->db->get('tbl_users');
			return $allfaqs->row("balance");
		}
		else
		{
			return 0;
		}
		
	}
	
	
	function missing_cashback($user_id=null)
	{
		$this->db->connection_check();
		if($user_id!="")
		{	
			$this->db->where('user_id',$user_id);
			$miss_cashbacks = $this->db->get('missing_cashback');
			return $miss_cashbacks->result();
		}
		else
		{
			return 0;
		}
	}
	
	function minimum_withdraw()
	{
		$this->db->connection_check();
			$minimum_cashback = $this->db->get('admin');
			return $minimum_cashback->row("minimum_cashback");
	}
	
	function my_payments($user_id)
	{
		$this->db->connection_check();		
		if($user_id!="")
		{	
			$this->db->where('user_id',$user_id);
			$this->db->order_by('withdraw_id','desc');
			$miss_cashbacks = $this->db->get('withdraw');
			
			return $miss_cashbacks->result();
		}
		else
		{
			return 0;
		}
	}
		
	function my_cashback($user_id)
	{
		$this->db->connection_check();
		if($user_id!="")
		{	
			$this->db->where('user_id',$user_id);
			$this->db->order_by('date_added','desc');
			$cashback = $this->db->get('cashback');
                       	return $cashback->result();
		} else {
			return 0;
		}
	}
	
	function update_user_balance($userid,$requestpay)
	{
		//balance
		$this->db->connection_check();
	
		$userbalance = $this->user_balance($userid);
		
		if($requestpay > $userbalance){
			return false;
		}
		$this->db->where('admin_id','1');
		$query_admin = $this->db->get('admin');
		$res = $query_admin->row();
		$minimum_cashback = $res->minimum_cashback;
		if($requestpay < $minimum_cashback){
			return false;
		}
		
		$new_balnce = $userbalance-$requestpay;
		$data = array(		
		'balance' => $new_balnce);
		$this->db->where('user_id',$userid);
		$update_qry = $this->db->update('tbl_users',$data);
		if($update_qry)
		{$now = date('Y-m-d H:i:s');
			// withdraw
			$data = array(		
			'requested_amount' => $requestpay,
			'user_id' => $userid,
			'date_added' => $now,
			'status ' => 'Requested');
			$this->db->insert('withdraw',$data);
			return true;
		}
		else 
		{ 
			return false;	
		}	
	}
	
	function paid_earnings($userid)
	{	
		$this->db->connection_check();
		$this->db->select('SUM(requested_amount) as completed_bal');
		$this->db->where('status','Completed');
		$this->db->where('user_id',$userid);
		$paid_earning= $this->db->get('withdraw');
		if($paid_earning->num_rows > 0)
        {
            return $paid_earning->row('completed_bal');
        }
		else
		{
			return false;
		}
	}
	
	function total_earnings($userid)
	{	
		$this->db->connection_check();
		$this->db->select('SUM(transation_amount) as completed_bal');
		$this->db->where('user_id',$userid);
		$this->db->where('mode','Credited');
		$this->db->where('transation_status','Paid');
		$paid_earning= $this->db->get('transation_details');
		$waitng = $paid_earning->row('completed_bal');			
		$balcne =  $this->user_balance($userid);	
		//$newbalset =  $waitng+$balcne;
                $newbalset =  $waitng;
		if($paid_earning->num_rows > 0)
        {
            return $newbalset;
        }
		else
		{
			return false;
		}
	}
	
	function waiting_approval($userid)
	{
		$this->db->connection_check();
		$this->db->select('SUM(requested_amount) as completed_bal');
		$this->db->where('user_id',$userid);
				$this->db->where("(`status`='Requested' or `status`='Processing')");
		$paid_earning= $this->db->get('withdraw');		
		if($paid_earning->num_rows > 0)
                {
                   return $paid_earning->row('completed_bal');
                }
		else
		{
			return false;
		}
	}
	
	
	function get_all_stores($count=null)
	{
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}
		$this->db->where('affiliate_status','1');
		$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	
	function getmaincategorys()
	{
		$this->db->connection_check();
		$results = $this->db->query("SELECT
			category_id,category_name,category_url,
			count(c.cate_id) AS num_categorys
			FROM
				categories AS p
				JOIN sub_categories AS c 
					ON p.category_id = c.cate_id
			where p.category_status=1 
			GROUP BY c.cate_id
			order by p.sort_order ASC");
			
			if($results->num_rows > 0){
				return $results->result();	
			}
			return false;
	}
	
	
	function get_stores_category()
	{
		$this->db->connection_check();
		$results = $this->db->query("SELECT * FROM categories as a WHERE a.category_id NOT IN (SELECT cate_id FROM sub_categories)");
		if($results->num_rows > 0)
		{
				return $results->result();	
		}
		else
		{
			return false;
		}
	}
	
	
	function get_available_store_cate()
	{
		$this->db->connection_check();
		$results = $this->db->query("SELECT 
		category_id,category_url, category_name 
		FROM `categories` as c 
		join (select store_categorys from affiliates) as a 
		WHERE 
		c.category_status=1 and FIND_IN_SET(c.category_id,a.store_categorys) 
		GROUP BY category_id order by c.sort_order ASC");
		
		if($results->num_rows > 0)
		{
				return $results->result();	
		}
		else
		{
			return false;
		}
	}
	
	function get_available_affiliates($cateid)
	{
		$this->db->connection_check();
		//$this->db->order_by("sort_order", "ASC");
		$results = $this->db->query("SELECT affiliate_url,affiliate_name,affiliate_id from affiliates as a WHERE affiliate_status=1 and FIND_IN_SET($cateid,a.store_categorys) ORDER BY  a.sort_order ");
		if($results->num_rows > 0)
		{
				return $results->result();	
		}
		else
		{
			return false;
		}
	}
	
	function sub_category_details($subcateurl=null)
	{
		$this->db->connection_check();
		if($subcateurl=='')
		{
			return false;
		}
		$factal_subcat = $this->db->query("SELECT sun_category_id as category_id,sub_category_url as category_url,sub_category_name as category_name, meta_keyword, meta_description FROM `sub_categories` where sub_category_url='$subcateurl'");
		if($factal_subcat->num_rows > 0)
        {
            return $factal_subcat->row();
        }
		else
		{
			return false;
		}
	}
	
	function count_coupons($catename=null)
	{
		$this->db->connection_check();
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
	
	function get_coupons_sets($store,$coupon_count=null)
	{
		$this->db->connection_check();
		if($coupon_count!="")
		{
			$this->db->limit($coupon_count,0);
		}	
		$this->db->like('offer_name', $store);	
		$result = $this->db->get('coupons');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	/******Nov 19 th*********/
	/******Nov 26 th*********/
	
	function get_store_details($affiliate_url=null)
	{
		$this->db->connection_check();
		$this->db->like('affiliate_url', $affiliate_url);	
		$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	}
	
	function get_coupons_from_store($store,$coupon_count=null)
	{
		$this->db->connection_check();
		if($coupon_count!="")
		{
			$this->db->limit($coupon_count,0);
		}	
		$this->db->order_by('coupon_options','desc');
		$this->db->like('offer_name', $store);	
		$this->db->where('coupon_status','1');
		$this->db->where('coupon_type','');
		$result = $this->db->get('coupons');
		//echo $this->db->last_query();die;
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	
/******Nov 26 th*********/

	function get_store_details_byid($affiliate_id=null)
	{
		$this->db->connection_check();
		$this->db->where('affiliate_id',$affiliate_id);
		$result = $this->db->get('affiliates');
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	}
	
	function get_coupons_from_coupon_byid($coupon_id)
	{
		$this->db->connection_check();
		$this->db->where('coupon_id',$coupon_id);
		$result = $this->db->get('coupons');
		if($result->num_rows > 0)
		{
			return $result->row();	
		}
			return false;
	}
	
	// get admin details..
	function getadmindetails()
	{
		$this->db->connection_check();
	$this->db->where('admin_id','1');
	$query_admin = $this->db->get('admin');
		if($query_admin->num_rows >= 1) 
		{
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else
		{
			return false;		
		}	
	}	
	
	function available_for_provider($affid)
	{
		$this->db->connection_check();
		$this->db->where('affiliate_name',$affid);
		$query_admin = $this->db->get('providers');
		//echo $this->db->last_query();die;
		if($query_admin->num_rows >= 1) 
		{
			return $query_admin->row();
		}
		else
		{
			return false;		
		}	
	}
	
	function click_history($store_id,$coupon_id,$userid,$useragent)
	{
		$this->db->connection_check();
		$store_details = $this->get_store_details_byid($store_id);
		
		$coupon_details = $this->get_coupons_from_coupon_byid($coupon_id);		
		$voucher_name = $coupon_details->title;
		$store_name = $store_details->affiliate_name;
		$store_id = $store_details->affiliate_id;
		$ip_address  = $this->input->ip_address();
		$admindetailssss = $this->front_model->getadmindetails_main(); 
			if($store_details->cashback_percentage!="")
			{
				$cppercentage = $store_details->cashback_percentage;
				$voucher_name .=  " + Get additional ".$cppercentage."% Cashback from ".$admindetailssss->site_name;
			}			
			/*Get current Indian Date time */
			$timezone = new DateTimeZone("Asia/Kolkata" );
			$date = new DateTime();
			$date->setTimezone($timezone );
			$current_date_time = $date->format( 'Y-m-d H:i:s' );
			/*Get current Indian Date time */
			$data = array(
			'voucher_name' => $voucher_name,
			'store_name' => $store_name,
			'affiliate_id' => $store_id,
			'user_id' => $userid,
			'ip_address'=>$ip_address,
			'date_added' => $current_date_time,
			'useragent' => $useragent //seetha 27.8.15			
			);
			$this->db->insert('click_history',$data);
			return true;
	}
	
	function verify_account($verifyid)
	{
		$this->db->connection_check();
		$where = array('random_code'=>$verifyid,'status'=>'0');
		$this->db->where($where);
		$this->db->where('admin_status','');
		$query = $this->db->get('tbl_users');
                        $this->db->where('admin_id',1);
			$admin_det = $this->db->get('admin');
			if($admin_det->num_rows >0) 
			{    
				$admin = $admin_det->row();
				$admin_email = $admin->admin_email;
				$site_name = $admin->site_name;
				$admin_no = $admin->contact_number;
				$site_logo = $admin->site_logo;
				$startup_bonus = $admin->startup_bonus;
			}
			if($query->num_rows >= 1) 
			{

			$data = array(		
				'status' => 1,
				'balance' =>$startup_bonus
			);
			$this->db->where('random_code',$verifyid);	
			$this->db->update('tbl_users',$data);

								
			
			$fetch = $query->row();
			$first_name=$fetch->first_name;
			$user_id = $fetch->user_id;
			$user_email=$fetch->email;
			$this->session->set_userdata('user_id',$user_id);
			$this->session->set_userdata('user_email',$user_email);
                        $txn_data = array(		
						'transation_reason' => "Signup Bonus",		
						'transation_amount' => $startup_bonus,		
						'mode' => "Credited",
						'transation_status' => "Paid",			
						'transation_date' => date('Y-m-d'),		
						'user_id' => $user_id,		
						);
				
						$this->db->insert('transation_details',$txn_data);		
			/* send welcome email */
		    
			
			$date =date('Y-m-d');
			$this->db->where('mail_id',7);
			$mail_template = $this->db->get('tbl_mailtemplates');
			if($mail_template->num_rows >0) 
			{        
			   $fetch = $mail_template->row();
			   $subject = $fetch->email_subject;  
			   $templete = $fetch->email_template;  
			   // $regurl=base_url().'cashback/verify_account/'.$new_random;
			   
				 /* $this->load->library('email'); 
				  
					$config = Array(
					 'mailtype'  => 'html',
					  'charset'   => 'utf-8',
					  );*/
					// $this->email->initialize($config);        
					/*$this->email->set_newline("\r\n");
				   
				   $this->email->initialize($config);        
				   $this->email->from($admin_email);
				   $this->email->to($user_email);
				   $this->email->subject($subject);*/

		        $sub_data = array(
						'###SITENAME###'=>$site_name
					);
	            $subject_new = strtr($subject,$sub_data);
			   
			   $data = array(
					'###USERNAME###'=>$first_name,
					'###COMPANYLOGO###' =>base_url()."/uploads/adminpro/".$site_logo,
					'###SITENAME###'=>$site_name,
					'###ADMINNO###'=>$admin_no,
					'###DATE###'=>$date,
					'###LINK###'=>'<a href='.$regurl.'>'.$regurl.'</a>'
			   );
			   
			   $content_pop=strtr($templete,$data);	
			   /*$this->email->message($content_pop);
			   $this->email->send();*/
			   $this->mail_function($admin_email,$user_email,$subject_new,$content_pop);
			}
		   /* send welcome email */
			return 1;
		}  
		else
		{
			return 0;
		}  
	}
	
	/************ Dec 8th *************/
	function get_details_ajax($ajdate,$user_id)
	{
		$this->db->connection_check();
		$this->db->where('DATE(`date_added`)',$ajdate);
		$this->db->where('user_id',$user_id);
		$this->db->group_by('store_name'); 
		$query_details_ses = $this->db->get('click_history');
		
		if($query_details_ses->num_rows >= 1) 
		{
			return $query_details_ses->result();
		}
		else
		{
			return false;		
		}	
	}
	
	function get_clicked_details_ajax($ajdate,$click_store,$user_id)
	{
		$this->db->connection_check();
		$this->db->where('DATE(`date_added`)',$ajdate);
		$this->db->where('store_name',$click_store);
		$this->db->where('user_id',$user_id);
		$query_details_ses = $this->db->get('click_history');		
		if($query_details_ses->num_rows >= 1) 
		{
			return $query_details_ses->result();
		}
		else
		{
			return false;		
		}			
	}
	/************ Dec 8th *************/
	
	/************ Dec 9th *************/
	function missing_Cashback_submit_mod($img)
	{
		$name = $this->db->query("select * from admin")->row();
				$site_name  = $name->site_name;
		$this->db->connection_check();
		$user_id = $this->session->userdata('user_id');
		$date = date('d/m/y');
		$data = array(
			'user_id'=>$user_id,
			'attachment'=>$img,
			'retailer_name'=>$this->input->post('store'),
			'transaction_ref_id'=>$this->input->post('transaction_reference'),
			'transation_amount'=>$this->input->post('ordervalue'),
			'click_id'=>$this->input->post('hid_click_id'),
			'coupon_code'=>$this->input->post('coupon_used'),
			'ordervalue'=>$this->input->post('ordervalue'),
			'cashback_details'=>$this->input->post('details'),
			'click_date'=>date('d/m/Y',strtotime($this->input->post('click_date'))),
			'status'=>3,
			'trans_date'=>$date
		);	
		$this->db->insert('missing_cashback',$data);
		$user_details = $this->edit_account($user_id);
		$mail = $user_details->email;
		$username = $user_details->first_name." ".$user_details->last_name;
		 // $admindetailssss = $this->front_model->getadmindetails_main();  
		// $mail_text = '<p><span style="font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:14px;line-height:26px;font-style:normal">Hope you are well.We have received your Missing Cashback ticket for Ebay. We will get on it right away &amp; here is what happens next:<br><br> a) Within 7 days the status of this Missing Cashback will be updated to either "Resolved" (and Cashback will be added to your '.$admindetailssss->site_name.' account in "Pending" status immediately), or Sent to retailer (in this case Pending Cashback will be added to your account within 45 days) <br><br> b) We will then share your order details with the retailer to check why your Cashback did not track. If this was just a tracking error, retailer will honour this transaction and status of your Cashback will change to "Confirmed". However if the retailer believes that you did not follow Terms &amp; Conditions then they will not pay us and your Cashback will be "Cancelled"<br><br> Please note that as retailers look at Missing Cashback queries out of the normal process, it takes approx 30-45 days to get back. Rest assured that we will keep trying to get an answer for you ASAP but unfortunately will just have to wait for the retailer decision.<br><br> You can check the status of your Missing Cashback Ticket under Missing Cashback section in your '.$admindetailssss->site_name.' account though we will email you as soon as there is an update. <br><br> Many thanks for your support and co-operation,<br> Team '.$site_name.' </span></p>';
				
		$mail_temp = $this->db->query("select * from tbl_mailtemplates where mail_id='9'")->row();
			$fe_cont = $mail_temp->email_template;
			// $admindetailssss = $this->front_model->getadmindetails_main(); 
			// $subject = $admindetailssss->site_name." has recieved your Missing Cashback Ticket";
			
			$subject_1 = $mail_temp->email_subject;
			$sub = array(
				'###SITENAME###'=>$site_name
			);
			$subject_new = strtr($subject_1,$sub);
			
		$name = $this->db->query("select * from admin")->row();
		
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
				'###STORE###'=>$this->input->post('store'),
				'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
				'###SITENAME###' =>$site_name
			);
			
			$gd_message=strtr($fe_cont,$gd_api);
			//echo $gd_message;
			
			/*$config['protocol'] = 'sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			
			$config = Array(
				 'mailtype'  => 'html',
				  'charset'   => 'utf-8',
				  ); */
			$list = array($mail, $admin_emailid);
			/*$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($admin_emailid);
			$this->email->to($list);
			$this->email->subject($subject);
			$this->email->message($gd_message);
			$this->email->send();
			$this->email->print_debugger();*/
			$this->mail_function($admin_emailid,$list,$subject_new,$gd_message);
		
		return true;
	}
	
	/************ Dec 9th *************/
	
	/************ Dec11th *************/
	function user_cashback_balance($user_id=null)
	{
		$this->db->connection_check();
		if($user_id!="")
		{
			//SELECT sum(transation_amount) FROM `transation_details` where user_id=1 and transation_reason='Cashback'
			$this->db->select('SUM(transation_amount)');
			$this->db->where('user_id',$user_id);
			$this->db->where('transation_reason','Cashback');
			$allfaqs = $this->db->get('transation_details');
			return $allfaqs->row('SUM(transation_amount)');
		}
		else
		{
			return 0;
		}
	}
	
	function get_clicked_expirycheck_ajax($click_id)
	{
		$this->db->where('click_id',$click_id);
		$all = $this->db->get('missing_cashback');
		if($all->num_rows > 0){
			return $all->row();
		}
		return false;
	}
	
	/************ Dec11th *************/
	
	/************ Dec 13 th *************/
	function get_top_cashback_stores_list_cate($category_id)
	{
		$this->db->connection_check();
		$this->db->order_by('cashback_percentage','desc');
		$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('affiliate_status','1');
		$query = $this->db->get('affiliates');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	function get_top_cashback_stores_list()
	{
		$this->db->connection_check();
		$this->db->order_by('cashback_percentage','desc');
		//$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('affiliate_status','1');
		$query = $this->db->get('affiliates');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	function get_top_cashback_stores_limit($limit)
	{
		$this->db->connection_check();
		$this->db->limit($limit,0);
		//$this->db->order_by('cashback_percentage','desc');
		//$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('affiliate_status','1');
		$this->db->order_by('sort_order','DESC');
		$query = $this->db->get('affiliates');
		if($query->num_rows >= 1)
		{
		   return $query->result();
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
	
	function get_blog_details()
	{
		$this->db->connection_check();
		$this->db->order_by('cms_id','desc');
		//$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('cms_status','1');
		$query = $this->db->get('tbl_blog');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	function blog_comments($blog_id)
	{
		$this->db->connection_check();
		//echo $blog_id;
		$this->db->where('bid',$blog_id);
		$query = $this->db->get('tbl_bloguser_comments');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	function blog_details($blog_id)
	{
		$this->db->connection_check();
		//echo $blog_id;
		$this->db->where('cms_id',$blog_id);
		$query = $this->db->get('tbl_blog');
		if($query->num_rows >= 1)
		{
		   return $query->row();
		}
		return false;
	}
	
	function post_comments()
	{
		$this->db->connection_check();
		$now = date('Y-m-d H:i:s');
		$data = array(
		'bid'=>$this->input->post('blog_id'),
		'user_id'=>$this->input->post('user_id'),
		'comments'=>$this->input->post('comments'),
		'created_date'=>$now,
		'c_date'=>$now,
		'status'=>'deactive'	
		);
		$this->db->insert('tbl_bloguser_comments',$data);		
		return true;
	}
	
	// site visits..
	function unique_visits($ip_address)
	{
		$this->db->connection_check();
		$date = date('Y-m-d');
		
		$this->db->where('date_added',$date);
		$this->db->where('ip_address',$ip_address);		
		$check = $this->db->get('site_visits');
		if($check->num_rows == 0){
			
			$data = array(
				'ip_address'=>$ip_address,
				'date_added'=>$date
			);
			$this->db->insert('site_visits',$data);
			return true;
		}
	}
	
	/************ Dec 13 th *************/
	
	

/*********************Nathan End*************************/
	
	
	 //  5/12/2014  renuka  
 
 function get_allpremiumcoupon_cat()
 { 
		 $this->db->connection_check();/**/
      //    premium_categories 	category_id 	category_name 	category_url 	meta_keyword 	meta_description 	sort_order 	category_status 	date_added
	   
 		$this->db->where('category_status','1');  
		$query = $this->db->get('premium_categories');
		if($query->num_rows >= 1) 
		{ 
			  $result=$query->result();  
			return $result;
		}  
		else
		{
		    return false; 
		}          
 
 } 
 
 function get_countofpremiumcat_addcoupon($db_category_id) 
 { 
 $this->db->connection_check();
  $location =  $this->session->userdata('cityname');
      //    premium_categories 	category_id 	category_name 	category_url 	meta_keyword 	meta_description 	sort_order 	category_status 	date_added   category   
	    $this->db->where('location',$location);
 		$this->db->where( "FIND_IN_SET ('$db_category_id',category) >", 0 ); 
		$this->db->where('remain_coupon_code <>','');
		$this->db->where('expiry_date >=',date('Y-m-d'));
		
		//$this->db->where( "t2.remain_coupon_code !=", '' ); 
		$query=$this->db->get('shopping_coupons');  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->num_rows;  
			 return $num_rows; 
		}  
		else 
		{
		     return $num_rows=0;  
		}             
 }
     
 function getcnt_allpremiumcoupon_incat() 
 { 
      //    premium_categories 	category_id 	category_name 	category_url 	meta_keyword 	meta_description 	sort_order 	category_status 	date_added   category   
	   $this->db->connection_check();
	   $location =  $this->session->userdata('cityname');
	   $selqry="SELECT `t1`.* FROM (`premium_categories` as t1) JOIN `shopping_coupons` as t2 ON  FIND_IN_SET (`t1`.`category_id`,`t2`.`category`) > 0 WHERE `t1`.`category_status` = '1' AND  `t2`.`status` = '1'  and t2.remain_coupon_code!='' and t2.expiry_date >='".date('Y-m-d')."' GROUP BY t2.shoppingcoupon_id ";     
	     
		 $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->num_rows;  
			return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;  
		}          
  
 }   
 
  function getall_premiumcoupons($perpage,$urisegment,$ajax='') 
 {  
 		$this->db->connection_check();
		if($urisegment=="")
		{
              $urisegment=0; 
		} 
		else
		{
              $urisegment=$urisegment; 
		}   
 	      
		  $sess_cashback_premiumcatid=trim($this->session->userdata("sess_cashback_premiumcatid"));
		  $sess_cashback_starting_price=trim($this->session->userdata("sess_cashback_starting_price"));
		  $sess_cashback_cashback_end_price=trim($this->session->userdata("sess_cashback_end_price"));
		  $sess_cashback_featured=trim($this->session->userdata("sess_cashback_featured"));
		  $sess_cashback_popular=trim($this->session->userdata("sess_cashback_popular"));
		  $sess_cashback_new=trim($this->session->userdata("sess_cashback_new"));
		  $sess_cashback_es=trim($this->session->userdata("sess_cashback_es"));
		
		  //print_r($this->session->userdata);
		
		  $query='';
	 	
	     if($sess_cashback_premiumcatid!='' &&  $sess_cashback_premiumcatid!="all" && $sess_cashback_premiumcatid!='0')
		   {
			   $sess_cashback_premiumcatid;
			   
		   $query.= "AND FIND_IN_SET($sess_cashback_premiumcatid,`t2`.`category`) ";
		   }
	    if($sess_cashback_starting_price!='' && $sess_cashback_cashback_end_price!='')
		  {
			 $query.=" AND (amount BETWEEN $sess_cashback_starting_price AND $sess_cashback_cashback_end_price) ";
		  }
		  $sess_cashback_feature_query='';
		  $sess_cashback_feature_query1='';
		  $sess_cashback_feature_query2='';
		  
		  if($sess_cashback_featured!='0' || $sess_cashback_popular!='0' || $sess_cashback_new!='0' || $sess_cashback_es!='0') 
		  {
			$sess_cashback_feature_query1="AND (  ";
			$sess_cashback_feature_query2=" OR ";
		  }
		  if($sess_cashback_featured!='0')
		  {
			if($sess_cashback_feature_query=='')			  
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('featured',`t2`.`features`) ";
			 else
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('featured',`t2`.`features`) ";
			 
		  }
		  if($sess_cashback_popular!='0')
		  {
			 if($sess_cashback_feature_query=='')			
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('popular',`t2`.`features`) ";  		
			 else
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('popular',`t2`.`features`) ";
			
		  }
		  if($sess_cashback_new!='0')
		  {
			  //echo $sess_cashback_new;
			 if($sess_cashback_feature_query=='')	
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('new',`t2`.`features`) ";
			 else
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('new',`t2`.`features`) ";
		  }
		  if($sess_cashback_es!='0')
		  {
			  if($sess_cashback_feature_query=='')	
			  $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('endingsoon',`t2`.`features`) ";
			  else
			  $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('endingsoon',`t2`.`features`) ";
			
		  }
		  if($sess_cashback_feature_query!='')
		  {
			  $sess_cashback_feature_query.=" ) ";
		  }		




		  $query.=$sess_cashback_feature_query;
		  if($ajax=='')
		  {
			$query='';  
		  }
		 $location =  $this->session->userdata('cityname');
		 //   $selqry="SELECT `t2`.* FROM (`premium_categories` as t1) JOIN `shopping_coupons` as t2 ON  FIND_IN_SET (`t1`.`category_id`,`t2`.`category`) > 0 WHERE `t1`.`category_status` = '1' AND `t2`.`status` = '1' and t2.location='".$location."' and `t2`.`remain_coupon_code`!='' and t2.expiry_date >='".date('Y-m-d')."' $query  GROUP BY t2.shoppingcoupon_id  limit $urisegment,$perpage ";     
		 
		     $selqry="SELECT `t2`.* FROM (`premium_categories` as t1) JOIN `shopping_coupons` as t2 ON  FIND_IN_SET (`t1`.`category_id`,`t2`.`category`) > 0 WHERE `t1`.`category_status` = '1' AND `t2`.`status` = '1' and `t2`.`remain_coupon_code`!='' and t2.expiry_date >='".date('Y-m-d')."' $query  GROUP BY t2.shoppingcoupon_id  limit $urisegment,$perpage ";    
		 
 

		 $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			$result=$query->result();  
			return $result; 
		}  
		else  
		{
		    return "0";   			
		}          
 
 }
 
 function getall_fetured_products()
 {
	 $this->db->connection_check();
	 $selqry="SELECT * FROM shopping_coupons  WHERE FIND_IN_SET('featured',`features`)  and `remain_coupon_code`!='' AND `status` = '1' and expiry_date >='".date('Y-m-d')."' order by shoppingcoupon_id desc";     
 	
		 $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			$result=$query->result();  
			return $result; 
		}  
		else  
		{
		    return "0";   			
		}           
 }
 function getall_premiumcouponscount($ajax='') 
 { 
 	$this->db->connection_check();
  $sess_cashback_premiumcatid=$this->session->userdata("sess_cashback_premiumcatid");
		  $sess_cashback_starting_price=$this->session->userdata("sess_cashback_starting_price");
		  $sess_cashback_cashback_end_price=$this->session->userdata("sess_cashback_end_price");
		  $sess_cashback_featured=$this->session->userdata("sess_cashback_featured");
		  $sess_cashback_popular=$this->session->userdata("sess_cashback_popular");
		  $sess_cashback_new=$this->session->userdata("sess_cashback_new");
		  $sess_cashback_es=$this->session->userdata("sess_cashback_es");
		  
		  $query='';
	 	
	      if($sess_cashback_premiumcatid!='' &&  $sess_cashback_premiumcatid!="all" && $sess_cashback_premiumcatid!='0')
		   {
		   $query.= "AND FIND_IN_SET($sess_cashback_premiumcatid,`t2`.`category`) ";
		   }
	    if($sess_cashback_starting_price!='' && $sess_cashback_starting_price!=0 && $sess_cashback_cashback_end_price!='' && $sess_cashback_cashback_end_price!=0)
		  {
			 $query.=" AND (amount BETWEEN $sess_cashback_starting_price AND $sess_cashback_cashback_end_price) ";
		  }
		  $sess_cashback_feature_query='';
		  $sess_cashback_feature_query1='';
		  $sess_cashback_feature_query2='';
		  
		  if($sess_cashback_featured!='0' || $sess_cashback_popular!='0' || $sess_cashback_new!='0' || $sess_cashback_es!='0') 
		  {
			$sess_cashback_feature_query1="AND (  ";
			$sess_cashback_feature_query2=" OR ";
		  }
		  if($sess_cashback_featured!='0')
		  {
			if($sess_cashback_feature_query=='')			  
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('featured',`t2`.`features`) ";
			 else
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('featured',`t2`.`features`) ";
			 
		  }
		  if($sess_cashback_popular!='0')
		  {
			 if($sess_cashback_feature_query=='')			
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('popular',`t2`.`features`) ";  		
			 else
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('popular',`t2`.`features`) ";
			
		  }
		  if($sess_cashback_new!='0')
		  {
			 if($sess_cashback_feature_query=='')	
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('new',`t2`.`features`) ";
			 else
			 $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('new',`t2`.`features`) ";
		  }
		  if($sess_cashback_es!='0')
		  {
			  if($sess_cashback_feature_query=='')	
			  $sess_cashback_feature_query.=" $sess_cashback_feature_query1 FIND_IN_SET('endingsoon',`t2`.`features`) ";
			  else
			  $sess_cashback_feature_query.=" $sess_cashback_feature_query2 FIND_IN_SET('endingsoon',`t2`.`features`) ";
			
		  }
		  if($sess_cashback_feature_query!='')
		  {
			  $sess_cashback_feature_query.=" ) ";
		  }		
		  $query.=$sess_cashback_feature_query;
		  if($ajax=='')
		  {
			 $query=''; 
		  }
		  $location =  $this->session->userdata('cityname');
		    
		   
		   
		  $selqry="SELECT `t2`.* FROM (`premium_categories` as t1) JOIN `shopping_coupons` as t2 ON  FIND_IN_SET (`t1`.`category_id`,`t2`.`category`) > 0 WHERE `t1`.`category_status` = '1' AND  `t2`.`status` = '1' and t2.location='".$location."' and `t2`.`remain_coupon_code`!='' and t2.expiry_date >='".date('Y-m-d')."' $query  GROUP BY t2.shoppingcoupon_id";  
		  
		  
	    
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->num_rows;   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}          
 
 }
  
  
   
 function getrowsperpage()
{ 
	$this->db->connection_check();
    	/* $query=$this->db->get('admin');
        if($query->num_rows==1)
         {   
              $row=$query->row();   
			$rowsperpage=$row->intRows_front;    
         }  
		//  $rowsperpage="10"; */
		 
	return $rowsperpage=6;     
 }
	
	function find_remainingdays($datestr=null)
 {
	 $this->db->connection_check();
   
   //Convert to date
  //$datestr="2014-12-25 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
 
//Calculate difference
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
   $data['days']=$days; 
   $data['hours']=$hours; 
   
   
   return $data; 
  //Report  
  // echo "$days days $hours hours remain<br />";  
 
 }
	
	function details($id)
	{
		$this->db->connection_check();
		  $selqry="SELECT * FROM shopping_coupons  WHERE shoppingcoupon_id = $id";        
	    
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->row(); 
			    
			  $ip_addr = $this->input->ip_address();
			  $db_coupon_image=$num_rows->coupon_image;
							 $exp_db_coupon_image=explode(",",$db_coupon_image);  							 
							 $f_dbcouponfirst_img=$exp_db_coupon_image[0];
							 
							   $selqry1="SELECT * FROM recently_viewed  WHERE ip = '".$ip_addr."' order by date ASC"; 
							   $query1=$this->db->query("$selqry1"); 	
							   
							    $selqry2="SELECT * FROM recently_viewed  WHERE product_id =$num_rows->shoppingcoupon_id order by date ASC"; 
							   $query2=$this->db->query("$selqry2"); 	
							   
							   if($query2->num_rows ==0) 
							   {
							   						   
							   if($query1->num_rows >= 3) 
							   
								{ 
								$num_rows1=$query1->row(); 
								$selqry="update   recently_viewed set product_id='".$num_rows->shoppingcoupon_id."',name='".$num_rows->title."',image='".$f_dbcouponfirst_img."',price='".$num_rows->amount."',ip='".$ip_addr."' WHERE ip = '".$ip_addr."' and date='".$num_rows1->date."'  ";
								}
								else
								{									
			    $selqry="insert into recently_viewed (product_id,name,image,price,ip) values ('".$num_rows->shoppingcoupon_id."','".$num_rows->title."','".$f_dbcouponfirst_img."','".$num_rows->amount."','".$ip_addr."') ";
								}
							   }
	    $this->db->query("$selqry"); 
			  
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}          
	}
	function related_products($id)
	{
	$this->db->connection_check();	
		$explode=explode(",",$id);
		$query="";
		for($i=0;$i<count($explode);$i++)
		{
			if($i==0)
			$query.="AND (  FIND_IN_SET($explode[$i],`category`)";
			else
			$query.=" OR FIND_IN_SET($explode[$i],`category`)";
			
		}
		$query.=" ) ";
		$selqry="SELECT * FROM shopping_coupons  WHERE status = '1'  and `remain_coupon_code`!='' and expiry_date >='".date('Y-m-d')."' $query LIMIT 3";        
	 
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->result();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  
	}
	function popular_products()
	{
		$this->db->connection_check();

		$selqry="SELECT * FROM shopping_coupons  WHERE status = '1' and `remain_coupon_code`!='' and expiry_date >='".date('Y-m-d')."' AND  FIND_IN_SET('popular',`features`) LIMIT 3";        
	 
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->result();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  
	}
	
	function popular_products_index()
	{
		$this->db->connection_check();

		$selqry="SELECT * FROM shopping_coupons  WHERE status = '1' and `remain_coupon_code`!='' and expiry_date >='".date('Y-m-d')."' AND  FIND_IN_SET('popular',`features`) order by shoppingcoupon_id desc";        
	 
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->result();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  
	}
	
	function latest_products_index()
	{
		$this->db->connection_check();

		$selqry="SELECT * FROM shopping_coupons  WHERE status = '1' and `remain_coupon_code`!='' and expiry_date >='".date('Y-m-d')."' AND  FIND_IN_SET('new',`features`) order by shoppingcoupon_id desc";        
	 
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->result();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  
	}
	
	
	function avg_rating($id)
	{
		$this->db->connection_check();
		$selqry="SELECT AVG(ratings) as rate FROM reviews r join tbl_users  u on r.user_id=u.user_id WHERE coupon_id = '".$id."' and r.approve=1 "; 
		$query=$this->db->query("$selqry")  ;   
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->row();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  	
	}
	
	
	function recently_viewed()
	{
		$this->db->connection_check();
		 $ip_addr = $this->input->ip_address();
         $selqry="SELECT * FROM recently_viewed  WHERE ip = '".$ip_addr."' group by `product_id`";        
	     
	    $query=$this->db->query("$selqry"); 
		  
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->result();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  	
	}
			function recent_reviews($id)
			{
				
				$this->db->connection_check();
				 $selqry="SELECT * FROM reviews r join tbl_users  u on r.user_id=u.user_id WHERE coupon_id = '".$id."' and r.approve=1  LIMIT 3";        
				 
				$query=$this->db->query("$selqry"); 
				  
				if($query->num_rows >= 1) 
				{ 
					  $num_rows=$query->result();   
					   return $num_rows; 
				}  
				else  
				{
					return $num_rows=0;   
				}  	
			}
			function reviews($id)
			{
				$this->db->connection_check();
				 $selqry="SELECT * FROM reviews r join tbl_users  u on r.user_id=u.user_id WHERE coupon_id = '".$id."' and r.approve=1 ";        
				 
				$query=$this->db->query("$selqry"); 
				  
				if($query->num_rows >= 1) 
				{ 
					  $num_rows=$query->result();   
					   return $num_rows; 
				}  
				else  
				{
					return $num_rows=0;   
				}  	
			}
			function insert_comments()
			{
				$this->db->connection_check();
				$data = array(
					'comments' =>$this->input->post('comments'),
					'ratings' => $this->input->post('rating'),
					'coupon_id' =>$this->input->post('coupon'),
					'user_id'=>$this->session->userdata('user_id')
					);
					$var=$this->db->insert('reviews',$data);
					if($var==1)
					{
						return true;
					}
					else
					{
						return false;
					}
			}
		 function insert_coupon()
		 {
			 $this->db->connection_check();
			 $selqry1="SELECT * FROM premium_cart  WHERE product_id= '".$this->input->post('coupon')."' and user_id = '".$this->session->userdata('user_id')."'";        
			 $query1=$this->db->query("$selqry1"); 
					if($query1->num_rows >= 1) 
					{  
					$var = 0;
					}
					else
					{
					 $data = array(
					'product_id' =>$this->input->post('coupon'),
					'quantity' => '1',			
					'user_id'=>$this->session->userdata('user_id')
					);
					$var=$this->db->insert('premium_cart',$data);
					}
					
					if($var==1)
					{			
						return $var;		
					}
					else
					{
						return $var;
					}
		 }
		 function getuser_cart()
		 {			
		 		$this->db->connection_check();
				if($this->session->userdata('user_id'))			
				{
				 	$selqry="SELECT * FROM premium_cart  WHERE user_id= '".$this->session->userdata('user_id')."'";   
				 	$query=$this->db->query("$selqry");  
					if($query->num_rows >= 1) 
					{ 
						 $num_rows=$query->result();   
						 return $num_rows;
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
		 function check_amount()
		 {
			 $this->db->connection_check();
			  $selqry="SELECT balance FROM tbl_users  WHERE user_id= '".$this->session->userdata('user_id')."'";   
			  $query=$this->db->query("$selqry");  
				if($query->num_rows >= 1) 
					{ 
						 $num_rows=$query->row(); 
						 if($this->input->post('amount')<=$num_rows->balance)  
						 return true;
					}
					else
					{
						return false;
					}
		 }
		 function cal_amount()
		 {
			 $this->db->connection_check();
			 $selqry="SELECT balance FROM tbl_users  WHERE user_id= '".$this->session->userdata('user_id')."'";   
			  $query=$this->db->query("$selqry");  
				if($query->num_rows >= 1) 
					{ 
						 $num_rows=$query->row(); 
						 $remain_amount=$num_rows->balance-$this->input->post('otot');
						 
						 $data = array(		
						'balance' => $remain_amount,		
						);
				
						$this->db->where('user_id',$this->session->userdata('user_id'));
						$update_qry = $this->db->update('tbl_users',$data);
						
						$data = array(		
						'transation_reason' => "premium coupon",		
						'transation_amount' => $this->input->post('otot'),		
						'mode' => "debited",
						'transation_status' => "Paid",			
						'transation_date' => date('Y-m-d'),		
						'user_id' => $this->session->userdata('user_id'),		
						);
				
						$this->db->insert('transation_details',$data);				
						 
						 for($i=1;$i<=$this->input->post('i_val');$i++)
						 {
							  	
								
							
						  $data = array(		
								'amount' => $this->input->post('price'.$i),
								'tot_amount' => $this->input->post('tot'.$i),
								'quantity' => $this->input->post('quan'.$i),
								'product_id' => $this->input->post('product_id'.$i),	
								'user_id' => $this->session->userdata('user_id'),
								'status' => "Paid",	
								);
								$this->db->insert('premium_order',$data);							
					
						 }
						 $query = $this->db->where('user_id', $this->session->userdata('user_id'));
						 $query = $this->db->delete('premium_cart');
						 
						 return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
						 
					}
					else
					{
						return false;
					}
			 
		 }
		 function get_user()
		 {
			 $this->db->connection_check();
			  $selqry="SELECT * FROM tbl_users  WHERE user_id= '".$this->session->userdata('user_id')."'";   
			  $query=$this->db->query("$selqry");  
				if($query->num_rows >= 1) 
					{ 
						 $num_rows=$query->row();   
						 return $num_rows;
					}
					else
					{
						return false;
					}
			  
		 }
		 function insert_umoney_order($hash)
		 {
			$this->db->connection_check();
			for($i=1;$i<=$this->input->post('i');$i++)
				 {
					  $data = array(		
						'amount' => $this->input->post('price_'.$i),
						'tot_amount' => $this->input->post('quantity_'.$i)*$this->input->post('price_'.$i),
						'quantity' => $this->input->post('quantity_'.$i),
						'product_id' => $this->input->post('product_id'.$i),	
						'user_id' => $this->session->userdata('user_id'),
						'hash_id' => $hash,	
						'status' => 'pending',	
						);
						$this->db->insert('premium_order',$data);
										
				 } 
		 }
		 function sendmailcoupon($new_coupon_last_trim,$prod_id)
		 {
			 $this->db->connection_check();
				$new_coupon_last_trim = explode(",",$new_coupon_last_trim);
				
				
				$shoping_coupon = $this->db->query("select * from shopping_coupons where shoppingcoupon_id=$prod_id")->row();
				
					$current_msg = '<center><h2>Your Coupon Code for: <span style="color:yellow">'.$shoping_coupon->offer_name.'</span> </h2></center><table align="center">';
																	for($i=0;$i<count($new_coupon_last_trim);$i++)
																	{
																	$current_msg.=' <tr>
																	<td>Coupon Code 1 : </td><td style="color:white; background:black">'.$new_coupon_last_trim[$i].'</td>
																	
																	</tr>
																   ';
																	}
																   $current_msg.= ' </table>';
				
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
						$this->load->library('email');
						$gd_api=array(
									'###ADMINNO###'=>$contact_number,
									'###EMAIL###'=>$this->session->userdata('user_email'),
									'###DATE###'=>$nows,
									'###CONTENT###'=>$current_msg,
									'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
									'###SITENAME###' =>$site_name
									);
								   
						$gd_message=strtr($fe_cont,$gd_api);

						$subject_new = "Coupon Code";
						//echo $gd_message;
						
				/*$config = Array(
				 'mailtype'  => 'html',
				  'charset'   => 'utf-8',
				  );*/
     // $this->email->initialize($config);        
     		   /*$this->email->set_newline("\r\n");
			   $this->email->initialize($config);        
			   $this->email->from($admin_emailid);
			   $this->email->to($user_email);
	
						$this->email->subject("Coupon Code");
						$this->email->message($gd_message);
						$this->email->send();
						 $this->email->print_debugger();*/
						 
			 $this->mail_function($admin_emailid,$user_email,$subject_new,$gd_message);			
			return true;			
							
		 }
		 function update_pay_u_money($mihpayid,$TxnID,$useragent,$ipaddress,$old_id)/*seetha 19.8.2015*/
		 {
			 $this->db->connection_check();
			$data = array('transaction_id' => $mihpayid, 
							'status'=>'Paid',
							'useragent'=>$useragent,
							'ipaddress'=>$ipaddress,
							'hash_id'=>$TxnID);
			$this->db->where('hash_id',$old_id);
			
			$update_qry = $this->db->update('premium_order',$data); 
			
			$selqry00="SELECT * FROM premium_order  WHERE hash_id='".$TxnID."'";        	     
							$query00=$this->db->query("$selqry00"); 
						//	echo $selqry00;
						//	print_r($query00->result());
						//	exit;
			
			foreach($query00->result() as $query_result)
			{
			$selqry1="SELECT * FROM shopping_coupons  WHERE shoppingcoupon_id= '".$query_result->product_id."'";     
			//echo $selqry1."<br/>";   	     
							$query1=$this->db->query("$selqry1"); 
							
							if($query1->num_rows >= 1) 
							{ 
								 $num_rows1=$query1->row();   
								 
								 $old_coupon=$num_rows1->coupon_code;
								 
								 $new_coupon=explode(",",$num_rows1->remain_coupon_code);
								 $new_coupon_last='';
								 
								 for($c=0;$c<count($this->input->post($query_result->quantity));$c++)
								 {
								 $new_coupon_last.=$new_coupon[$c].",";
								 }
								 $new_coupon_last_trim=rtrim($new_coupon_last,",");
								 $coupon_code=$num_rows1->coupon_code.",".$new_coupon_last_trim;
								 
								 $remain_coupon_code=str_replace("$new_coupon_last","",$num_rows1->remain_coupon_code);
								 
							   $this->sendmailcoupon($new_coupon_last_trim,$query_result->product_id);
								 
								 $data = array(		
								 'coupon_code' => $coupon_code,
								 'remain_coupon_code' => $remain_coupon_code,				
								 );
								 
						
							$this->db->where('shoppingcoupon_id',$query_result->product_id);
							$update_qry = $this->db->update('shopping_coupons',$data);
		
						  }  

			}
			 $query = $this->db->where('user_id', $this->session->userdata('user_id'));
			 $query = $this->db->delete('premium_cart');
									 // exit;
			return true;
		 }
		 function update_hash($old,$new)
		 {
			 $this->db->connection_check();
			$data = array('hash_id' => $new);
			$this->db->where('hash_id',$old);
			$update_qry = $this->db->update('premium_order',$data); 
			return true;
		 }
		 function get_orders()
		 {
			 $this->db->connection_check();
			  $selqry="SELECT * FROM premium_order join shopping_coupons on shopping_coupons.shoppingcoupon_id=premium_order.product_id   WHERE premium_order.status='Paid' and premium_order.user_id= '".$this->session->userdata('user_id')."' ORDER BY `id` desc ";   
			  $query=$this->db->query($selqry); 		  
				if($query->num_rows >= 1) 
					{ 
						 $num_rows=$query->result();   
						 return $num_rows;
					}
					else
					{
						return false;
					}
			  
		 }
		 
		 function gettransations($userid)
		 {
			 $this->db->connection_check();
			 if($userid!="")
			{	
				$this->db->where('user_id',$userid);
				$miss_cashbacks = $this->db->get('transation_details');
				return $miss_cashbacks->result();
			}
			else
			{
				return 0;
			}
		 }
		 
		 function ref_earnings($userid)
		{
			$this->db->connection_check();	
			$this->db->select('SUM(transation_amount) as ref_amount');
			$this->db->where('user_id',$userid);
			$this->db->where('transation_reason','Referal Payment');
			$paid_earning= $this->db->get('transation_details');
			 $waitng = $paid_earning->row();	
/*			 print_r($waitng);
			 exit;*/
			if($paid_earning->num_rows > 0)
			{
				return $waitng->ref_amount;
			}
			else
			{
				return 0;
			}
		}
		
		function premium_home_slider()
		{
			$this->db->connection_check();
			$this->db->where("banner_status",'1');
			$this->db->where("banner_position",'1');
			$query = $this->db->get('tbl_banners');
			return $query->result();
		}
		
		
		function recently_viewed_index()
		{	
			$this->db->connection_check();
			 $selqry="SELECT * FROM recently_viewed order by id desc limit 0,2";        
			 
			$query=$this->db->query("$selqry"); 
			  
			if($query->num_rows >= 1) 
			{ 
				  $num_rows=$query->result();   
				   return $num_rows; 
			}  
			else  
			{
				return $num_rows=0;   
			}  	
		}
		
		
		function clock_history_stores()
		{	
			$this->db->connection_check();
			 $selqry="SELECT * FROM `click_history` as a INNER JOIN affiliates as b on a.store_name=b.affiliate_name  group by store_name order by click_id ";        			 
			$query=$this->db->query("$selqry"); 
			  
			if($query->num_rows >= 1) 
			{ 
				  $num_rows=$query->result();   
				   return $num_rows; 
			}  
			else  
			{
				return $num_rows=0;   
			}  	
		}
		
		function seoUrl($string) 
		{
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
	
	function login_google($user_details)
	{
		$this->db->connection_check();
		$user_email = $user_details->email;
		$selqry="SELECT * FROM  tbl_users where email='$user_email' and admin_status=''";        			 
		$query=$this->db->query("$selqry");
		$numrows = $query->num_rows();
		if($numrows==1)
		{
			$fetch = $query->row();
			$user_id = $fetch->user_id;
			$user_email=$fetch->email;
			$this->session->set_userdata('user_id',$user_id);
			$this->session->set_userdata('user_email',$user_email);
			return 1;
	   }
	   else
	   {
                      $this->db->where('admin_id',1);
			$admin_det = $this->db->get('admin');
			if($admin_det->num_rows >0) 
			{    
			 $admin = $admin_det->row();
			  $admin_email = $admin->admin_email;
			  $site_name = $admin->site_name;
			  $admin_no = $admin->contact_number;
			  $site_logo = $admin->site_logo;
                         $startup_bonus = $admin->startup_bonus;
			}
		    $new_random = mt_rand(1000000,99999999);
		    $user_email = $user_details->email;
		    if($user_email!=""){
			    $date = date('Y-m-d h:i:s');
			    $data = array(		
					'first_name'=>$user_details->firstName,
					'last_name'=>$user_details->lastName,
					'email'=>$user_email,
					'street'=>$user_details->address,
					'city'=>$user_details->city,
					'state'=>$user_details->region,
					'zipcode'=>$user_details->zip,
					'country'=>$user_details->country,
					'contact_no'=>$user_details->phone,
					'random_code'=>$new_random,
					'refer'=>0,
					'status'=>1,	
                                        'balance'=>$startup_bonus,		
					'date_added'=>$date
				);
				//print_r($data);
				//exit;
				$this->db->insert('tbl_users',$data);
				$insert_id = $this->db->insert_id();
				$this->session->set_userdata('user_id',$insert_id);
				$this->session->set_userdata('user_email',$user_email);
                                 $txn_data = array(		
						'transation_reason' => "Signup Bonus",		
						'transation_amount' => $startup_bonus,		
						'mode' => "Credited",
						'transation_status' => "Paid",			
						'transation_date' => date('Y-m-d'),		
						'user_id' => $insert_id,		
						);				
						$this->db->insert('transation_details',$txn_data);	

				$uni_id = $this->session->userdata('reg_uniq_id');
				if($this->session->userdata('reg_uniq_id')){
					$this->session->unset_userdata('reg_uniq_id');
				}
				if($uni_id!="")
				{
					$this->db->where('random_code',$uni_id);
					$this->db->where('admin_status','');
					$query = $this->db->get('tbl_users');
					if($query->num_rows > 0)
					{	
						$fetch = $query->row();
						$user_id = $fetch->user_id;
						$email =$fetch->email;
						
						$datas = array(
						'user_id' => $user_id,
						'user_email' => $email,
						'referral_email' => $user_email,
						'date_added' => $date
						);
						$this->db->insert('referrals',$datas);
					}
				}
				return 1;
			} else {
				return 0;
			}
	   }
		
		
	}
	
	
		 function transations_bydate($userid)
		 {	
		 	$this->db->connection_check();		
			 if($userid!="")
			{	
				$start_date_s = $this->input->post('start_date');
				$end_date_s = $this->input->post('end_date');				
				$start_date = date("Y-m-d", strtotime($start_date_s));
				$end_date = date("Y-m-d", strtotime($end_date_s));
				$this->db->where('user_id',$userid);
				$this->db->where("transation_date BETWEEN '$start_date' AND '$end_date'");
				$miss_cashbacks = $this->db->get('transation_details');

				return $miss_cashbacks->result();
			}
			else
			{
				return 0;
			}
		 }
		
		function store_ajax($page_num,$store_name)
		{
			
			$this->db->connection_check();
			$last = $page_num*20;
			$old_page = $page_num-1;
			$first = $old_page*20;			
			$this->db->limit($last,$first);
			$this->db->order_by('coupon_id','desc');
			$this->db->like('offer_name', $store_name);	
			$result = $this->db->get('coupons');
		//echo $this->db->last_query();
		
			if($result->num_rows > 0){
				return $result->result();	
			}
				return false;
		}
		
		function get_top_stores_list_cate()
		{	
		$this->db->connection_check();			
		$this->db->order_by('affiliate_status','ASC');
		//$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('affiliate_status','1');
		$this->db->order_by('sort_order','DESC');
		$query = $this->db->get('affiliates');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	
		}	
		
	function get_stores_cashback_stores_list_cate($category_id)
	{
		$this->db->connection_check();
		$this->db->order_by('affiliate_status','ASC');
		$this->db->where("FIND_IN_SET('$category_id',store_categorys) !=", 0);
		$this->db->where('affiliate_status','1');
		$query = $this->db->get('affiliates');
		//echo $this->db->last_query();
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	function getads($position=NULL)
	{
		$this->db->connection_check();
		if($position)
		{
			$this->db->where('ads_position',$position);
		}
		$query = $this->db->get('ads');
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	
	function get_typehead_list($query)
	{
		$this->db->connection_check();
		$this->db->select('affiliate_name');
		$this->db->like('affiliate_name', $query);	
		$this->db->where('affiliate_status','1');
		$query = $this->db->get('affiliates');
		if($query->num_rows >= 1)
		{
		   return $query->result();
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
	
	function getadmindetails_main()
	{
		$this->db->connection_check();
		$this->db->connection_check();
		$this->db->where('admin_id','1');
		$query_admin = $this->db->get('admin');
		if($query_admin->num_rows >= 1) 
		{
			return $row = $query_admin->row();
		}
		else
		{
			return false;		
		}	
	}	
	function get_alreadyexist_useremail($email) 
    {  
$this->db->connection_check();            
$this->db->where('email',$email);	       
 			$query=$this->db->get("tbl_users");  
			if($query->num_rows >= 1)  
			{ 
			    return $row=$query->row();  
			} 
			else 
			{ 
		      	return false;
			}	
    }
	
	function changeProfilePic($files){
		$this->db->connection_check();
                $data_user = array('profile_pic'=>$files);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$upd = $this->db->update('tbl_users',$data_user);
		if($upd){
			return true;
		} else {
			return false;
		}
	}
	
	
	function submit_store_ratings(){
		$this->db->connection_check();
                $insert = array(
			'user_id'=>$this->session->userdata('user_id'),
			'store_id'=>$this->input->post('store'),
			'rating'=>$this->input->post('rating'),
			'comments'=>$this->input->post('comments'),
			'status'=>0
		);
		$this->db->insert('store_review',$insert);
		echo $this->db->last_query();die;
		return true;
	}
	
	function all_store_reviews($store_id){
	
		$this->db->connection_check();
        $this->db->where('store_id',$store_id);
        $this->db->where('status','1');
		$this->db->order_by('date','desc');
		$res = $this->db->get('store_review');
		if($res->num_rows>0){
			return $res->result();
		} else {
			return false;
		}
	}
	
	// sharmila..
	function get_myreviews(){
		$this->db->connection_check();
        $this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->order_by('date','desc');
		$res = $this->db->get('store_review');
		if($res->num_rows>0){
			return $res->result();
		}
			return false;
	}	
	
	function get_offer($shoppingcoupon_id){
		$this->db->connection_check();
                $this->db->where('shoppingcoupon_id',$shoppingcoupon_id);
		$sel = $this->db->get('shopping_coupons');
		if($sel->num_rows==1){
			return $sel->row();
		}
			return false;
	}
	function get_history(){
		$this->db->connection_check();
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->order_by('date_added','desc');
		$hist = $this->db->get('click_history');
		if($hist->num_rows>0){
			return $hist->result();
		}
			return false;
	}	
	
	
	function category(){
		 $this->db->where('category_status','1');
		//$this->db->where('top_category','1');
		$this->db->order_by('date_added','desc');
		$res = $this->db->get('categories');
		if($res){
			return $res->result();
		}
		return false;
	}	
	function get_shopping_coupons_ajax()
	{
       $this->db->connection_check();
		$sele = $this->input->post('va');
		// $this->db->like('title', $sele, 'both'); 
		$this->db->where("title REGEXP '^[".$sele."]'");
		// $data =  array('status'=>'1');
		// $category = $this->input->post('cate');
		// $this->db->like('category', $category, 'both'); 
		// $this->db->where($data);
		$query = $this->db->get('coupons');
		if($query->num_rows>0){
			return $query->result();
		}else {
			return false;
		}
	
	}

	function get_perimum_categories()
	{
		$this->db->connection_check();
		$data =  array('status'=>'1');
		$query = $this->db->get('premium_categories');
		if($query->num_rows>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	function get_messages()
	{
		$this->db->connection_check();
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->order_by('message_id','DESC');
		$query = $this->db->get('messages');
		if($query->num_rows>0){
			return $query->result();
		}else {
			return false;
		}
	}
	function insert_support_message()
	{	
		$this->db->connection_check();
		$data = array('user_id'=>$this->session->userdata('user_id'),
					  'subject' =>$this->input->post('subject'),
					  'content' =>$this->input->post('messgae'),
					  'datetime' =>date('Y-m-d H:i:s'),
					  'type' =>'send');
		$this->db->insert('messages',$data);
	}
		
	function get_store_from_coupon($offer_name){
		
		$this->db->connection_check();
                $this->db->like('affiliate_name', $offer_name, 'both');
		$this->db->where('affiliate_status','1');
		$res = $this->db->get('affiliates');
		if($res){
			return $res->row();
		}
		return false;
	}	

	function get_latest_stores(){
		
		$this->db->connection_check();
		$this->db->order_by('date_added','RANDOM');
		$this->db->where('affiliate_status','1');
		$this->db->limit(3);
		$res = $this->db->get('affiliates');
		if($res){
			return $res->result();
		}
		return false;
	}
	
	function pending_cashback($user_id){
		$this->db->connection_check();
		$this->db->select('SUM(cashback_amount) as cb_amount');
		$this->db->where('user_id',$user_id);
		$this->db->where('status','Pending');
		$result = $this->db->get('cashback');
                $var = 0;
		if($result){
			$var = $result->row('cb_amount');
		}
		return $var;
	}
	
	function pending_referral($user_id){
		$this->db->connection_check();
		$this->db->select('SUM(transation_amount) as ref_amount');
		$this->db->where('user_id',$user_id);
		$this->db->where('mode','Credited');
		$this->db->where('transation_status','Progress');
		$result = $this->db->get('transation_details');
		$var = 0;
		if($result){
			$var = $result->row('ref_amount');
		}
		return $var;
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
	/* Seetha nov 30 */
	function get_shopping_coupons()
	{
		$this->db->connection_check();
		$this->db->order_by('coupon_id','desc');
		$this->db->where('coupon_status','1');
		$this->db->where('coupon_type','');
			$this->db->limit(18);
		$query = $this->db->get('coupons');
		//echo $this->db->last_query();die;
		if($query->num_rows>0){
			return $query->result();
		} else {
			return false;
		}
	}
       function get_stores_cashback_coupons_list_cate($category_id)
	{
		//$cat_name=str_replace('&amp;','&',$category_id);		
		$this->db->connection_check();
		$this->db->order_by('coupon_id','desc');
		$this->db->where('coupon_status','1');
		$this->db->where('category_name',$category_id);
		$query = $this->db->get('coupons');
		
		if($query->num_rows != 0)
		{
			
		   return $query->result();
		}
		return false;
	}
	function get_Storedetails($store_name)
	{
		$this->db->connection_check();
		$this->db->where('affiliate_name',$store_name);	
		$this->db->where('affiliate_status','1');
		$result = $this->db->get('affiliates');
		//echo $this->db->last_query();die;
		// print_r($result->result());die;
		if($result->num_rows >= 1)
		{
           return $result->row();
        }
		
        return false;
	}
	function get_coupons_categories($count=null)
	{
		$this->db->connection_check();
		$limit='';
		if($count!="")
		{
			$limit = "limit 0,".$count;
		}
		//$this->db->where('category_name',$category_id);
		$query = $this->db->query("SELECT c.category_id,c.category_name,c.category_status,cou.* from coupons as cou join categories as c on cou.category_name=c.category_id where cou.coupon_status='1' group by cou.category_name $limit");
		//echo $this->db->last_query();
		if($query->num_rows >= 1)
		{
		   return $query->result();
		}
		return false;
	}
	function get_categoryname($id)
	{
		$this->db->connection_check();
		$this->db->where('category_id',$id);
		$this->db->where('category_status','1');
		$query = $this->db->get('categories');
		if($query->num_rows == 1){
			return $query->row();
		}else{
			return false;		
		}	
	}
	
	
	function search_name_1()
    {
       //$my_data=$_GET['q'];
       $graphnew=array();    
       $graphnew1=array();    
       $graphnew2=array();    
       $graphnew3=array();    
	
		$query = $this->db->query("SELECT `affiliate_url`, 'Website' as tabledeails FROM (`affiliates`) WHERE `affiliate_status` = '1' order by affiliate_name");
		
		$query1 = $this->db->query("SELECT `category_url`, 'Category' as tabledeails  FROM (`categories`) WHERE `category_status` = '1' order by category_name");
		
		/*Seetha Dec 14 2015*/
		//product based search
		$query2 = $this->db->query("SELECT `category_url`, 'Product Category' as tabledeails FROM (`product_categories`) WHERE `category_status` = '1' order by category_name");
		$query3 = $this->db->query("SELECT `brand_url`, 'Brands' as tabledeails FROM (`brands`) WHERE `brand_status` = '1' order by brand_name");
		/*Seetha Dec 14 2015*/
    
       if(count($query)!='0')
       {
           $cnt=0;
           foreach($query->result() as $val)    
           {
               $graphnew[$cnt] = array(
                           'label' => $val->affiliate_url,  
                            'type'      =>'Website',                          
                           'the_link'=>base_url().'cashback/getsearch_details/'.$val->affiliate_url

                       ); 
               $cnt++;
               //echo $val->name."\n";
           }
           $array2 =($graphnew);
       }
       else
       {
           return 'no';
       }
	   if(count($query1)!='0')
       {
           $cnt=0;
           foreach($query1->result() as $val)    
           {
               $graphnew1[$cnt] = array(
                           'label' => $val->category_url,
                            'type'      =>'Category',                           
                           'the_link'=>base_url().'cashback/getsearch_details/'.$val->category_url

                       ); 
               $cnt++;
               //echo $val->name."\n";
           }
           $array1 =($graphnew1);
       }
       else
       {
           return 'no';
       }
	   /*Seetha Dec 14 2015*/
		//product based search
	   if(count($query2)!='0')
       {
           $cnt=0;
           foreach($query2->result() as $val)    
           {
               $graphnew2[$cnt] = array(
                           'label' => $val->category_url,
                           'type'      =>'Product Category',                           
                           'the_link'=>base_url().'cashback/getsearch_details/'.$val->category_url

                       ); 
               $cnt++;
               //echo $val->name."\n";
           }
           $array3 =($graphnew2);
       }
       else
       {
           return 'no';
       }
	   if(count($query3)!='0')
       {
           $cnt=0;
           foreach($query3->result() as $val)    
           {
               $graphnew3[$cnt] = array(
                           'label' => $val->brand_url,
                           'type'      =>'Brands',                           
                           'the_link'=>base_url().'cashback/getsearch_details/'.$val->brand_url

                       ); 
               $cnt++;
               //echo $val->name."\n";
           }
           $array4 =($graphnew3);
       }
       else
       {
           return 'no';
       }
	   /*Seetha Dec 14 2015*/	
	   return json_encode (array_merge($array1,$array2,$array3,$array4));
    }
	/* Seetha nov 30 */
	/* Seetha Dec 02 */
	function get_all_categories($count=null)
	{
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		$this->db->order_by('sort_order','ASC');
		$this->db->where('category_status','1');
		$result = $this->db->get('categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}
	function get_sub_categorys_list($category_id)
	{
		$this->db->connection_check();
		$results = $this->db->query("SELECT * FROM `sub_categories` where cate_id=$category_id and category_status=1 order by sort_order ASC");
		//echo $this->db->last_query();
		if($results->num_rows > 0)
		{
			return $results->result();	
		}
		else
		{
			return false;
		}
	}
	
	/* Seetha Dec 02 */
        /* Seetha Dec 04 */
	function get_productcategories($count=null)
	{
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		//$this->db->order_by('cate_id','asc');
		$this->db->where('category_status','1');
		$this->db->where('parent_id','0');
		$this->db->order_by('sort_order','ASC');
		$result = $this->db->get('product_categories');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
		
	}
	/* Seetha Dec 04 */
/* Anand Dec 05 */
	
	function product_single_category($category_url,$lev=null)
	{
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where('category_url',$category_url);
		
		if($lev>=0 && $lev!='')
		{
			$this->db->where('category_level',$lev);
		}
		else
		{
			$this->db->where('parent_id !=', '0');
		}
		
		$result = $this->db->get('product_categories');
		//echo $this->db->last_query();die;
		if($result->num_rows > 0)
		{
			return $result->row();				
		}
			return false;
	}
	function product_single_brands($brands_url)
	{
		
		$this->db->connection_check();	
		$this->db->select();		
	 	$this->db->order_by('sort_order');
		$this->db->where('brand_url',$brands_url);
		$result = $this->db->get('brands');
		//echo $this->db->last_query();
		if($result->num_rows > 0)
		{
			return $result->row();	
			//$store_details = $this->fetch_all_products($rows->brand_id,'');	
		}
		return false;
	}
	//fetch single row
	function get_details_from_field($value,$table,$field)
	{		
		$this->db->connection_check();
		$this->db->where($field,$value);
        $query = $this->db->get($table);
		//echo $this->db->last_query();die;
        if($query->num_rows >= 1)
		{
           return $query->row();
        }
        return false;	
	}
	
	//fetch all products
	
	function fetch_all_products($cate_id,$cate_level=null,$limite=NULL,$O_cate=NULL,$level=null){
		
		
		$input = '';
		if($cate_level == '1')
			$tbl_field = 'parent_child_id';
		else if($cate_level == '2')
			$tbl_field = 'child_id';
		else if($cate_level == '')
			$tbl_field = 'brands';
		else if($cate_level == 'keyword')
			$tbl_field = 'product_name';
		else
			$tbl_field = 'parent_id';
		
		
		
		//product search
		if($this->input->post('brands')){
			$brand = $this->input->post('brands');
			$brand_id = $brand[1];
			//echo $brand_id;exit;
			
			 $input .= " AND t2.brands IN($brand_id)";
			
		}
		
	/*	if($this->input->post('specify')){
			$specify = $this->input->post('specify');
			$specify_id = $specify[1];
			$exs=explode(',',$specify_id);
			foreach($exs as $erds)
			{
			$input .= " AND find_in_set($erds,t2.specify_option_id) <> 0 ";
			}
		}
  */
		if($this->input->post('price')){
	
			 $price = $this->input->post('price');
 			$plevels = explode('-',$price[1]);
			//print_r($plevels);
			$input .= " AND a.min_price between $plevels[0] and $plevels[1]";
		 }

		 // sharmila ...12/05/2016...

		 if($this->input->post('specify'))
		{
			$specify = $this->input->post('specify');
			
			$specify_id = $specify[1];
			
			$specify_ids = explode(',',$specify_id);
			
			foreach($specify_ids as $key=>$sp_id)
			{
				$arr[] =  explode('_',$sp_id);
			}
			
			 if(!empty($arr))
			 {
                 $input.=" AND  ";  
			 } 
			   $search_dummy=''; 
			   
			foreach($arr as $erds)
			{
				 $erds1 = $erds[0];
				 $erds2 = $erds[1];
				 $erds3 = urldecode($erds2);
				 $new_array[$erds1][] = $erds3;
			} 
				$viji='';
				foreach($new_array as $key=>$erd)
				{	
					$search_dummy = '';
					foreach($erd as $rd)
				 	{	
						$rrr='(t2.specification_extra like #%'.$key.';s:%%:"'.$rd.'%";%#) OR ';
						$search_dummy.=str_replace("#", "'", $rrr);
			 		}
			 	
			 		//$viji.=rtrim($search_dummy," OR ").' AND ';
                                          $viji.='('.rtrim($search_dummy," OR ").')'.' AND ';
				}

			  if($viji!="")
			  {
                    $input.=rtrim($viji," AND "); 
			  }
			  
			  if(!empty($arr))
			 {
                 $input.=" ";  
			 } 
		}
		
		 // sharmila ... 12/05/2016...
		 
		// $input .= " ORDER BY RAND()";
		
		
		
		 
		  if($this->input->post('filter')){
			 $filter = $this->input->post('filter');
			 if(!is_array($filter))
			 {
				$filter_id = $filter;
			 }else{$filter_id = $filter[1];}
			 
			 if($filter_id=='lowtohigh')
			 {
				 $input .= " ORDER BY CAST(min_price AS DECIMAL(10,2)) ASC";
			 }
			 else if($filter_id == 'hightolow')
			 {
				 $input .= " ORDER BY CAST(min_price AS DECIMAL(10,2)) DESC";
			 }
			 elseif($filter_id=='offers'){
				 $input .= " ORDER BY CAST(discount AS DECIMAL(10,2)) DESC";
			 }
			 else
			 {
				 $input .= " ORDER BY RAND()";
			 }
			
		 }
		 else
		 {
			$input .= " ORDER BY RAND()";
		 }
				
		
		//pagination limit set
		if($this->input->post('page_limit'))
			$limit = $this->input->post('page_limit');
		else
			$limit = 0;
		$joinvar ='';
		
		if($cate_level=='keyword')
		{
			if(strpos($cate_id, '%20') > 0)
   			{
				$keyslist = explode('%20',$cate_id);
				foreach($keyslist as $keytp)
				{
					$joinvar .= "t2.$tbl_field LIKE '%".$keytp."%' or " ;
				}
				$joinvar .= "t2.product_tags LIKE '%".$keytp."%' or ";
				$joinvar = "(".rtrim($joinvar,' or').")";
			}
			else
			{
				$joinvar .= "(t2.product_tags LIKE '%".$cate_id."%' or t2.$tbl_field LIKE '%".$cate_id."%')";
			}
		}
		else
		{
			
			$joinvar .= "t2.$tbl_field='".$cate_id."'";
			if($tbl_field=='brands')
			{
				if($level==0)
				{
					if($O_cate)
					{
						$joinvar .='and t2.parent_id='.$O_cate;
					}
					else
					{
						$joinvar .='';
					}
						
						
				}
				else
				{
				$joinvar .='and t2.parent_child_id='.$O_cate;
				}
				
			}
		}
	
		if($limite)
		{
	
			$query = $this->db->query("select  min(CAST(min_price AS DECIMAL(10,2))) as minprice, max(CAST(min_price AS DECIMAL(10,2))) as maxprice from products t2 join(select t1.product_id,t1.store_id, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from products p left join product_price t1 on t1.store_id=p.default_store where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' AND a.store_id=t2.default_store AND $joinvar $input  ");
		}
		else{
			if($limit=='0')
			{	
		
		$query = $this->db->query("select * from products t2 join(select t1.product_id,t1.store_id, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from products p left join product_price t1 on t1.store_id=p.default_store where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' AND a.store_id=t2.default_store AND $joinvar $input  limit $limit, 12");
		
			}
			else
		{
			//$lu=$limit+6;
			
			
			
			$query = $this->db->query("select * from products t2 join(select t1.product_id,t1.store_id, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from products p left join product_price t1 on t1.store_id=p.default_store where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' AND a.store_id=t2.default_store AND $joinvar $input  limit  $limit,6");
		
		}}
		
		//echo $this->db->last_query();
               //die;
		if($query->num_rows() > 0){
			if($limite)
			{return $query->row();}
			else{return $query->result();}
		}else
			return false;
	}
	function fetch_product_details($product_url)
	{
		
		$nearest = $this->db->query("select * from products a join product_price b on a.product_id=b.product_id where a.product_url='$product_url' and b.store_id=85");
		if($nearest->num_rows>0)
		{
			$n_price=$nearest->row('product_price');
		}
		$cnt = $this->db->query("select * from products a join product_price b on a.product_id=b.product_id where a.product_url='$product_url' and b.product_status=1");
		$join="";
		if($cnt->num_rows() > 0)
		{
			$c=1;
		}
		else
		{
			$c=0;
			//$join="ORDER BY ABS(t1.min_price - $n_price)";
		}
		
		$query = $this->db->query("select * from products t2 join(select COUNT(distinct(t1.store_id)) Totalstores,t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 and t1.product_status=$c group by t1.product_id $join)a on a.product_id = t2.product_id where t2.product_url='$product_url'");
		
		
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return $query->row();
		}else
			return false;
	}
	/* ganesh feb 23*/
	function fetch_bread_crump($product_url)
	{
		$query= $this->db->query("SELECT pc.category_url as cate1 ,pc1.category_url as cate2,b.brand_url , p.product_name  FROM `products`  p left join product_categories  pc on p.parent_id=pc.cate_id left join product_categories  pc1 on p.parent_child_id=pc1.cate_id left join brands b on p.brands=b.brand_id  WHERE p.product_url LIKE '$product_url'");
		if($query->num_rows() > 0)
		{
			
			return $query->row();
		}else
			return false;
	}
	/*--------ganesh*/
	
	// total count for referral
/*function product_store_count($product_id){
		$this->db->connection_check();
		$this->db->where('product_price >',0);
		$this->db->where('product_id',$product_id);
		$count = $this->db->get('product_price');
		//echo $this->db->last_query();die;
		$array = array();
		if($count->num_rows > 0){
			$row = $count->row();
			$array['count'] = $count->num_rows();
			$array['price'] = $row->product_price;
			return $array;
		}else{
			return '0';
		}
	}*/
	
// product sidebar list
	
	function get_details_from_id($value,$table,$field)
	{		
		$this->db->connection_check();
		$this->db->where($field,$value);
        $query = $this->db->get($table);
        if($query->num_rows >= 1)
		{
           return $query->row();
        }
        return false;	
	}
	
	
	function get_count_from_id($value,$table,$field)
	{		
		$this->db->connection_check();
		$this->db->where($field,$value);
        $query = $this->db->get($table);
		//echo $this->db->last_query();die;
        return $query->num_rows();
    }
	
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
	
	// product specify count
	
	function product_specify_count($specify_id){
		$this->db->connection_check();
		$id_serialize = '"'.$id.'"';
		$result = $this->db->query("SELECT * FROM products WHERE specification_option LIKE '%$id_serialize%'");
		//echo $this->db->last_query();die;
        return $result->num_rows();
	}

	//products compare section 
	function compare_products($product_url){
		$this->db->connection_check();
		$pro_url = "'" . implode("','", explode(',', $product_url)) . "'";
		$result = $this->db->query("select * from products t2 join(select t1.product_id,t1.store_id,t1.product_url as ppurl,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.product_url IN($pro_url) group by t2.product_name");
		
		//echo $this->db->last_query();die;
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
			return false;
	}
	
	// fetch product stores & price
	 function fetch_store_price($product_id){
		
		$query = $this->db->query("select *,p.affiliate_url as store_url from product_price p join affiliates a on p.store_id = a.affiliate_id where p.product_id IN($product_id) AND p.product_price > 0 group by p.store_id");
		
		//echo $this->db->last_query();die;
		if($query->num_rows > 0)
		{
			return $query->result();				
		}
			return false;
	 }
	 
	 function fetch_store_price_comp($product_id){
		
		$query = $this->db->query("select *,p.affiliate_url as store_url from product_price p join affiliates a on p.store_id = a.affiliate_id where p.product_id IN($product_id) AND p.product_price > 0 group by p.store_id");
		
		//echo $this->db->last_query();die;
		if($query->num_rows > 0)
		{
			return $query->row();				
		}
			return false;
	 }
	 
	 

//product details section
	// get product gallery
	
	function fetch_product_gallery($product_id)
	{
		$this->db->connection_check();
		$this->db->where('product_id',$product_id);
		$result = $this->db->get('product_gallery');
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
			return false;
	}
	
	function product_click_history()
	{
		$this->db->connection_check();
		$store_details = $this->get_store_details_byid($store_id);
		
		$coupon_details = $this->get_coupons_from_coupon_byid($coupon_id);		
		$voucher_name = $coupon_details->title;
		$store_name = $store_details->affiliate_name;
		$store_id = $store_details->affiliate_id;
		$ip_address  = $this->input->ip_address();
		$admindetailssss = $this->front_model->getadmindetails_main(); 
			if($store_details->cashback_percentage!="")
			{
				$cppercentage = $store_details->cashback_percentage;
				$voucher_name .=  " + Get additional ".$cppercentage."% Cashback from ".$admindetailssss->site_name;
			}			
			/*Get current Indian Date time */
			$timezone = new DateTimeZone("Asia/Kolkata" );
			$date = new DateTime();
			$date->setTimezone($timezone );
			$current_date_time = $date->format( 'Y-m-d H:i:s' );
			/*Get current Indian Date time */
			$data = array(
			'voucher_name' => $voucher_name,
			'store_name' => $store_name,
			'affiliate_id' => $store_id,
			'user_id' => $userid,
			'ip_address'=>$ip_address,
			'date_added' => $current_date_time,
			'useragent' => $useragent //seetha 27.8.15			
			);
			$this->db->insert('click_history',$data);
			return true;
	}
	
	/* Anand */
        /* Seetha Dec 05*/
	function get_categoryid($category_url)
	{
		$this->db->connection_check();
		$this->db->where('category_url',$category_url);
		$this->db->where('parent_id','0');
		$query = $this->db->get('product_categories');
		if($query->num_rows == 1){
			return $query->row();
		}else{
			return false;		
		}	
		
	}
	function get_productsubcategory_details($cate_id)
	{
		$this->db->connection_check();
		$this->db->where('category_status','1');
		$this->db->where('parent_id',$cate_id);
		$result = $this->db->get('product_categories');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function get_nextlevel_category($nxtlvl_id)
	{
		$this->db->connection_check();
		$this->db->where('category_status','1');
		$this->db->where('parent_id',$nxtlvl_id);
		$result = $this->db->get('product_categories');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function get_brands($category_brands,$limit=NULL) 
	{
		if($limit!="")
		{
			$this->db->limit($limit,0);
		}
		$this->db->connection_check();
		$sf =explode(',',$category_brands);
		$this->db->where_in('brand_id',$sf);
		$this->db->where('brand_status','1');
		$result = $this->db->get('brands');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	/*Seetha Dec 09 2015*/
	function get_featuredstores($fid=null)
	{
		$this->db->connection_check();
		$featured='';
		if($fid)
		{
			$featured= "and t2.featured='1'";
		}
		if($limit)
		{
			$limit= " limit 0, $limit";
		}
		
		$result =$this->db->query("select * from products t2 join (select t1.product_id, t1.store_id,min(t1.product_price) as product_price from product_price t1 where t1.product_price >0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' ".$featured." ".$limit." ");	
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	function get_storerating($store_id)
	{
		$this->db->connection_check();
        $result = $this->db->query("SELECT AVG(rating) as rate,count(user_id) as counting  FROM store_review where store_id='$store_id' and status='1'");
		if($result->num_rows>0)
		{
           return $result->row();
        }else {
			return false;
		}
	}
	function get_topbrans($count=null)
	{
		
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		/*$result = $this->db->query("select t2.*,b.* from products t2 join (select t1.product_id, t1.store_id ,min(t1.product_price) as product_price from product_price t1 where t1.product_price >0 group by t1.product_id)a  join brands b  on a.product_id = t2.product_id and t2.brands=b.brand_id where t2.status='1'");*/
		$this->db->where('brand_status','1');
		$result = $this->db->get('brands');	
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	} 
	function get_productsbsd_categories($product_id)
	{
		$this->db->connection_check();
		$result = $this->db->query("select t1.*,t2.* from products t1 join product_categories t2  on t1.parent_id=t2.cate_id where t1.parent_id='$product_id' and t1.status='1' limit 0,12");
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	function count_products($cateid=null)
	{
		$this->db->connection_check();
		$count_products = $this->db->query("SELECT count(*) as counting FROM `products` where parent_id like '%$cateid%'");
		
		if($count_products->num_rows > 0)
        {
            return $count_products->row();
        }
		else
		{
			return false;
		}
	}
	
	/*Seetha Dec 09 2015*/
	/*Seetha Dec 10 2015*/
	//get product min price
	function get_product_price($productid)
	{
		$this->db->connection_check();
		$product_price = $this->db->query("SELECT a.affiliate_id,a.affiliate_cashback_type,a.cashback_percentage,p.* FROM   product_price as p join  affiliates as a on p.store_id=a.affiliate_id  WHERE `product_price` > 0 AND `product_id` = '$productid' group by product_id");
		if($product_price->num_rows > 0)
        {
            return $product_price->row();
        }
		else
		{
			return false;
		}
	}
	function get_scrabingstors($count=null)
	{
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		$result =$this->db->query("SELECT s.*,a.* FROM `scrapping` s join affiliates a on s.store_name=a.affiliate_id where s.store_status='1' and a.affiliate_status='1'");
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
	}
	/*Seetha Dec 10 2015*/
        /*Seetha Dec 11 2015*/
	function getallbrand_bsdid($categoryid)
	{
		$this->db->connection_check();
		$this->db->where('brand_status','1');
		$result = $this->db->get('brands');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	/*Seetha Dec 11 2015*/
     /*Seetha Dec 14 2015*/
	function getproductname($cate_id)
	{
		$this->db->connection_check();
		$this->db->where('category_status','1');
		$this->db->where('cate_id',$cate_id);
		$this->db->where('parent_id','0');
		$result = $this->db->get('product_categories');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	}
	//rewards sections
	function rewards_details()
	{
		$this->db->connection_check();
        $this->db->where('status','1');
		$result = $this->db->get('rewards_details');
		if($result->num_rows>0)
		{
           return $result->row();
        }else {
			return false;
		}
	}
	function getexciting_rewards($count=null)
	{		
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		$result = $this->db->query("SELECT * FROM `rewards`  where rewards_status=1 ORDER BY CAST( replace(`cob_coins`, ',', '') AS DECIMAL(10,2)) ASC");
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	function get_rewardsfaq()
	{
		$this->db->connection_check();
		$this->db->where('status','1');
		$result = $this->db->get('rewards_faqs');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	/*Seetha Dec 14 2015*/
	
	
	/*Nathan Dec 10 2015*/
/*	function pricealert($email,$product_id)
	{
		$this->db->connection_check();
		$this->db->where('email',$email);
		$this->db->where('product_id',$product_id);
		$query = $this->db->get('price_alerts');
		if($query->num_rows() == 0)
		{
			$date = date('Y-m-d h:m:s');
			$data = array(
			'email' => $email,
			'product_id' => $product_id,
			'date_subscribed' => $date
			);
			$this->db->insert('price_alerts',$data);
			//mail podanum
			return 1;
		}
		else
			return 0;
	}*/

	function pricealert($email,$product_id,$mobile_number)
	{
		$this->db->connection_check();

		$this->db->where('email',$email);
		$this->db->where('product_id',$product_id);
		$this->db->where('mobile_number',$mobile_number);
		$query = $this->db->get('price_alerts');
		$query1 = $this->db->query("select *,t2.product_url as purl from products t2 join(select t1.product_price,t1.old_price,t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.product_id='$product_id'");
		if($query1)
		{
			$price = $query1->row();
			$new_price = $price->product_price;
		}
		// echo $this->db->last_query();die;
		if($query->num_rows() == 0)
		{
			$date = date('Y-m-d h:m:s');
			$data = array(
			'email' => $email,
			'product_id' => $product_id,
			'mobile_number' => $mobile_number,
			'price' => $new_price,
			'status' => '1',
			'date_subscribed' => $date
			);
			$this->db->insert('price_alerts',$data);
			// echo $this->db->last_query();
			//mail podanum
			return 1;
		}
		else
			return 0;
	}
	/*Nathan Dec 10, 2015*/
	
		/*Nathan Dec 14 2015*/
	function comparison_details($product_id,$comparison_details=null)
	{
		$this->db->select('*');
		$this->db->from('products a');
		$this->db->join('product_price b', 'a.default_store=b.store_id','left');
		$this->db->where('b.product_price >',0);
		$this->db->where('b.product_id',$product_id);
		$this->db->where('a.product_id',$product_id);
		$default = $this->db->get();
		if($default->num_rows >0)
		{
			 $default->row('product_price');
			
			 $percentage=$default->row('product_price')*(.25);
			 $start_price=$default->row('product_price')-$percentage;
			
			 $end_price=$default->row('product_price')+$percentage;
		
		}
		//echo $this->db->last_query();die;
		
		$this->db->connection_check();
		$this->db->where('product_status',1);
		$this->db->where('product_id',$product_id);
		$query=$this->db->get('product_price');
		//echo $this->db->last_query();die;
		if($query->num_rows >0)
		{
			$c=1;
		}
		else
		{
			$c=0;
		}
		$this->db->select('*');
		$this->db->from('product_price a');
		$this->db->join('affiliates b', 'a.store_id = b.affiliate_id', 'left');
		$this->db->where('a.product_id', $product_id);
		//$this->db->where('a.product_price >', 0);
		$this->db->where('a.product_price >=', $start_price);
		$this->db->where('a.product_price <=', $end_price);
		$this->db->where('a.product_status', $c);
		$this->db->group_by('b.affiliate_id');
		//$this->db->order_by(ABS(`a`.`product_price` - 2999),'asc');
		
		if($comparison_details)
		{
			//"CAST(a.product_price AS DECIMAL(10,2))"
			switch($comparison_details)
			{
				case 'price_high':
					$this->db->order_by("CAST(`a`.`product_price` AS DECIMAL(10))", "DESC");
				break;
				case 'price_low':
					$this->db->order_by("CAST(`a`.`product_price` AS DECIMAL(10))", "asc");
				break;	
				default:
					$this->db->order_by("CAST(`a`.`product_price` AS DECIMAL(10))", "asc");		
			}
		}
		else
		{
			$this->db->order_by('CAST(`a`.`product_price` AS DECIMAL(10))', "asc");
		}
		$query = $this->db->get(); 
		//echo $this->db->last_query();die;
		if($query->num_rows() != 0)
		{
			return $query->result();				
		}
			return false;
	}
	
	function coinsvalue()
	{
		$res  = $this->db->query("SELECT cob_coins FROM `rewards_details`")->row();
		return $res->cob_coins;
	}
	
	function specfication_ids($specid)
	{
		$res =  $this->db->query("SELECT GROUP_CONCAT(DISTINCT specid ORDER BY specid ASC SEPARATOR ';') as specfiids FROM specifications where parant_id=".$specid);
		if($res->num_rows() != 0)
		{
			return $res->row();				
		}
		return false;
	}
	
	function create_product_json($product_id)
	{
		$this->db->connection_check();
		$this->db->where('product_id',$product_id);
        $query = $this->db->get('product_dailly_price');
        if($query->num_rows >0)
		{
           return $query->result();
        }
        return false;
	}
	
	/*Nathan Dec 14, 2015*/
      /*Seetha Dec 15, 2015*/
	function get_products_from_product_byid($productid)
	{
		$query = $this->db->query("select *,t2.product_url as purl from products t2 join(select t1.product_id,t1.store_id,t1.product_url,t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.product_id='$productid'");
		
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return $query->row();
		}else
			return false;
	}
	function productclick_history($store_id,$productid,$userid,$useragent,$price)
	{
		$this->db->connection_check();
		$store_details = $this->get_store_details_byid($store_id);
		
		$product_details = $this->get_products_from_product_byid($productid);		
		$voucher_name = $product_details->product_name;
		$product_id = $product_details->product_id;
		$store_name = $store_details->affiliate_name;
		$store_id = $store_details->affiliate_id;
		$ip_address  = $this->input->ip_address();
		$admindetailssss = $this->front_model->getadmindetails_main(); 
			if($store_details->cashback_percentage!="")
			{
				$cppercentage = $store_details->cashback_percentage;
				$voucher_name .=  " + Get additional ".$cppercentage."% Cashback from ".$admindetailssss->site_name;
			}			
			/*Get current Indian Date time */
			$timezone = new DateTimeZone("Asia/Kolkata" );
			$date = new DateTime();
			$date->setTimezone($timezone );
			$current_date_time = $date->format( 'Y-m-d H:i:s' );
			/*Get current Indian Date time */
			$data = array(
			'voucher_name' => $voucher_name,
			'store_name' => $store_name,
			'affiliate_id' => $store_id,
			'product_id' => $product_id,
			'price'=>$price,
			'user_id' => $userid,
			'ip_address'=>$ip_address,
			'date_added' => $current_date_time,
			'useragent' => $useragent //seetha 27.8.15			
			);
			$this->db->insert('product_clickhistory',$data);
			return true;
	}
	function pending_transactions($user_id)
	{
		$this->db->connection_check();		
		if($user_id!="")
		{	
			$this->db->where('user_id',$user_id);
			$this->db->where('status','0');
			$this->db->order_by('click_id','desc');
			$results = $this->db->get('pending');
			
			return $results->result();
		}
		else
		{
			return 0;
		}
	}
	
	
	/*ganesh 2-3-2016*/
	function remove_ptrs($p_id)
	{
		$this->db->connection_check();
		 $user_id=$this->session->userdata('user_id');
		$this->db->where('user_id', $user_id);
		$this->db->where('click_id', $p_id);
      $this->db->delete('product_clickhistory'); 
	  //echo $this->db->last_query();die;
		return true;
	}
	function submit_product_ratings()
	{
		$this->db->connection_check();		
		$data = array('user_id'=>$this->session->userdata('user_id'),
					  'product_id' =>$this->input->post('product_id'),
					  'rating' =>$this->input->post('rating'),
					  'quality' =>$this->input->post('quality'),
					  'expectations' =>$this->input->post('expectations'),
					  'review_title' =>$this->input->post('review_title'),
					  'pros_summary' =>$this->input->post('pros_summary'),
					  'pros_reviews' =>$this->input->post('pros_reviews'),
					  'cons_summary' =>$this->input->post('cons_summary'),
					  'cons_reviews' =>$this->input->post('cons_reviews'),
					  'rad1' =>$this->input->post('rad1'),
					  'primary_user' =>$this->input->post('primary_user'),
					  'brought_this' =>$this->input->post('brought_this'),
					  'date_added' =>date('Y-m-d H:i:s')
					);
		$ins =$this->db->insert('reviews',$data);
		if($ins){
			return true;
		}else{
			return false;
		}
	}
	function submit_questions(){
		
		$this->db->connection_check();
			$insert = array(
			'user_id'=>$this->session->userdata('user_id'),
			'question_title'=>$this->input->post('question'),
			'category'=>$this->input->post('category'),
			'date_added'=>date('Y-m-d H:i:s')
		);
		$insert =$this->db->insert('ask_questions',$insert);
		if($insert){
			return true;
		}else{
			return false;
		}
	}
	/*Seetha Dec 15, 2015*/
	/*Seetha Dec 18, 2015*/
	function avg_reviews_rating($id)
	{
		$this->db->connection_check();
		$selqry="SELECT AVG(rating) as rate FROM reviews r join tbl_users  u on r.user_id=u.user_id WHERE product_id = '".$id."' and r.approve=1 "; 
		$query=$this->db->query("$selqry");  		
		if($query->num_rows >= 1) 
		{ 
			  $num_rows=$query->row();   
			   return $num_rows; 
		}  
		else  
		{
		    return $num_rows=0;   
		}  	
	}
	function count_rating($id=null)
	{
		$this->db->connection_check();
		$count_rating = $this->db->query("SELECT count(*) as counting FROM `reviews` where product_id='$id' and approve='1' group by product_id");
		
		if($count_rating->num_rows > 0)
        {
            return $count_rating->row();
        }
		else
		{
			return false;
		}
	}
	function get_cntprocom($id=null)
	{
		$this->db->connection_check();
		$cntprocom = $this->db->query("SELECT count(*) as pros_com FROM `reviews` where product_id='$id' and approve='1' and pros_reviews='0' group by product_id");
		if($cntprocom->num_rows > 0)
        {
            return $cntprocom->result();
        }
		else
		{
			return false;
		}
	}	
	function get_cntprofun($id=null)
	{
		$this->db->connection_check();
		$cntprofun = $this->db->query("SELECT count(*) as pros_fun FROM `reviews` where product_id='$id' and approve='1' and pros_reviews='1' group by product_id");
		if($cntprofun->num_rows > 0)
        {
            return $cntprofun->result();
        }
		else
		{
			return false;
		}
	}	
	function get_cntconscom($id=null)
	{
		$this->db->connection_check();
		$cntconscom = $this->db->query("SELECT count(*) as cons_com FROM `reviews` where product_id='$id' and approve='1' and cons_reviews='0' group by product_id");		
		if($cntconscom->num_rows > 0)
        {
            return $cntconscom->row();
        }
		else
		{
			return false;
		}
	}
	function get_cntconsfun($id=null)
	{
		$this->db->connection_check();
		$cntconsfun = $this->db->query("SELECT count(*) as cons_fun FROM `reviews` where product_id='$id' and approve='1' and cons_reviews='1' group by product_id");		
		if($cntconsfun->num_rows > 0)
        {
            return $cntconsfun->row();
        }
		else
		{
			return false;
		}
	}
	
	function get_myproductreviews($product_id){
		$this->db->connection_check();
       		$this->db->order_by('date_added','desc');
		$this->db->where('product_id',$product_id);
		$this->db->where('approve','1');		
		$res = $this->db->get('reviews');
		//echo $this->db->last_query();
		if($res->num_rows>0){
			return $res->result();
		}
			return false;
	}	
	function getprogressbar_product($id=null)
	{
		$this->db->connection_check();
		$countsprogres= $this->db->query("SELECT rating, count(*) as 'Cnt' FROM reviews where approve='1'  and product_id='$id' GROUP BY rating order by rating desc");
		if($countsprogres->num_rows>0){
			return $countsprogres->result();
		}
			return false;
	}
	function similar_products($parent_id,$brandid,$limit=NULL)
	{
		$limit = "limit 0,".$limit;
		$query = $this->db->query("SELECT * FROM products t2 JOIN ( SELECT t1.product_id, t1.pp_id, t1.store_id, t1.product_url as purl, t1.affiliate_url, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price FROM product_price t1 WHERE t1.product_price > 0 GROUP BY t1.product_id ) a ON a.product_id = t2.product_id WHERE t2.parent_id = '$parent_id' and  t2.brands = '$brandid' $limit");
		
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return $query->result();
		}else
			return false;
	}
	
	/*Seetha Dec 18, 2015*/ 
/*Nathan Dec 22, 2015*/ 

function getscrapping_id($store_id,$product_id)
	{
		$this->db->where('product_id',$product_id);
		$this->db->where('store_id',$store_id);		
		$res = $this->db->get('product_price');
		if($res->num_rows>0){
			return $res->row();
		}
			return false;
	}
	
	function getmin_price_product($product_id)
	{
		
		$res = $this->db->query('SELECT * FROM `product_price` WHERE product_price = (SELECT min( CAST( product_price AS DECIMAL( 10, 2 ) ) ) FROM product_price where product_id='.$product_id.' and product_price>0) and product_id='.$product_id.' and product_price>0');
		//echo $this->db->last_query();die;
		if($res->num_rows>0){
			return $res->row();
		}
			return false;
	}

         function get_count_from_id_brands($value,$catelevel,$cateid)
	{	
		if($catelevel == '1')
			$tbl_field = 'parent_child_id';			
		if($catelevel == '2')
			$tbl_field = 'child_id';
		$this->db->group_by('product_price.product_id');
		$this->db->where('products.brands',$value);
		$this->db->where('product_price.product_price >',0);
		$this->db->where('products.'.$tbl_field,$cateid);	
		$this->db->join('product_price', 'product_price.product_id = products.product_id');	
        $query = $this->db->get('products');
	//	echo $this->db->last_query();
        return $query->num_rows();
    }

	/*Nathan Dec 22, 2015*/ 
	/*Seetha Dec 23, 2015*/ 
	function add_favorite($product_id){
		
		$this->db->connection_check();
        $insert = array(
			'user_id'=>$this->session->userdata('user_id'),
			'product_id'=>$product_id,
			'date_added'=>date('Y-m-d H:i:s'),
			'status'=>'1'
		);
		$this->db->insert('favorites',$insert);
		return true;
	}
	function remove_favorite($product_id){
		
		$this->db->connection_check();
        $data = array(
			'status'=>'0'
		);
		$user_id=$this->session->userdata('user_id');
		$this->db->where('user_id',$user_id);
		$this->db->where('product_id',$product_id);
		$this->db->update('favorites',$data);
		//echo $this->db->last_query();die;
		return true;
	}
	
	function check_favorite($product_id){
		$this->db->connection_check();
        $this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('product_id',$product_id);
		$this->db->where('status',1);
		$res = $this->db->get('favorites');
		if($res->num_rows>0){
			return true;
		} else {
			return false;
		}
	}
	function get_favorites()
	{
		$this->db->connection_check();
		//products p left join product_price t1 on t1.store_id=p.default_store
		//$this->db->where('user_id',$this->session->userdata('user_id'));
		
		$query=$this->db->query("SELECT * FROM products t2 JOIN ( SELECT t1.product_id, t1.pp_id, t1.store_id,t1.product_url as purl, t1.affiliate_url,min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price FROM products p left join product_price t1 on t1.store_id=p.default_store  WHERE t1.product_price > 0 GROUP BY t1.product_id ) a ON a.product_id = t2.product_id JOIN (select f.user_id,f.product_id from favorites f where status=1) as b ON b.product_id = t2.product_id WHERE b.user_id = '".$this->session->userdata('user_id')."'  group by t2.product_id");
		//echo $this->db->last_query();die;
		if($query->num_rows>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	function get_productsubcategories($parentid,$count=null)
	{
		$this->db->connection_check();
		if($count!="")
		{
			$this->db->limit($count,0);
		}	
		$this->db->order_by('sort_order','asc');
		$this->db->where('category_status','1');
		$this->db->where('parent_id',$parentid);
		$result = $this->db->get('product_categories');
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
		
	}
	
	function scrapping_list(){
		$this->db->connection_check();
		$this->db->select('*');
		$this->db->from('scrapping a');
		$this->db->join('affiliates b', 'a.store_name = b.affiliate_id', 'left');
		$this->db->where('a.store_status', 1);
		$this->db->order_by("a.sort_order", "DESC");
		$result = $this->db->get(); 		
		if($result->num_rows > 0){
			return $result->result();	
		}
		return false;
	}
	
	function topbrands_index($count=NULL)
	{
		$limit = "limit 0,".$count;
		
		$query=$this->db->query("SELECT COUNT(a.brand_id) as brandcount,a.brand_url,a.brand_image, a.brand_name FROM brands a LEFT JOIN products b ON b.brands=a.brand_id where a.brand_image!='' GROUP BY a.brand_id order by brandcount desc $limit ");
		if($query->num_rows>0){
			return $query->result();
		}else {
			return false;
		}
		
		
	}
	
	
	/*Seetha Dec 09 2015*/
	function latestproducts()
	{
		$this->db->connection_check();
		
		$result =$this->db->query("select * from products t2 join (select t1.product_id, t1.store_id,t1.pp_id,t1.product_price as product_price from product_price t1 where t1.product_price >0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' and a.store_id=t2.default_store ORDER BY RAND() limit 0,6");	
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	
	function mostviewedproducts()
	{
		$this->db->connection_check();
		$result =$this->db->query("select * from products t2 join (select t1.product_id, t1.store_id,min(t1.product_price) as product_price from product_price t1 where t1.product_price >0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' order by t2.product_id desc limit 0,4 ");	
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;  
	}
	
	
	function top_products_home($cateid)
	{
		$this->db->connection_check();
		/*$result =$this->db->query("SELECT * FROM products t2 JOIN ( SELECT t1.product_id, t1.store_id, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price FROM product_price t1 WHERE t1.product_price > 0 GROUP BY t1.product_id ) a ON a.product_id = t2.product_id WHERE t2.status = '1' AND t2.parent_child_id = '$cateid' order by CAST(min_price AS DECIMAL(10,2)) DESC  limit 0,6 ");	*/

		$this->db->where('category_status','1');
		
		$this->db->where('cate_id',20003);
		$this->db->where('parent_id',$cateid);
		$result = $this->db->get('product_categories');
               //echo $this->db->last_query();die;
		if($result->num_rows == 1){
			return $result->row();	
		}
			return false;  
			
		
	}
	
	
	function search_name()
    {
       	$graphnew=array();    
       
		$query = $this->db->query("SELECT product_name,product_url FROM products t2 JOIN ( SELECT t1.product_id, t1.store_id, MIN(t1.product_price) AS min_price, MAX(t1.product_price) AS max_price FROM product_price t1 WHERE t1.product_price > 0 GROUP BY t1.product_id ) a ON a.product_id = t2.product_id WHERE t2.status = '1'");
       if(count($query)!='0')
       {
           $cnt=0;
           foreach($query->result() as $val)    
           {
               $graphnew[$cnt] = array(
                           'label' => $val->product_name,          
                           'the_link'=>base_url().'cashback/product_details/'.$val->product_url

                       ); 
               $cnt++;
               //echo $val->name."\n";
           }
           $array2 =($graphnew);
       }
       else
       {
           return 'no';
       }
	   
	   /*Seetha Dec 14 2015*/	
	   return json_encode ($array2);
    
	}
	
	/*Seetha Dec 23, 2015*/ 
	
	
	function searchproducts(){
		
		$cate_id = $this->input->post('cate_id');
		$cate_level = $this->input->post('catpos');
		$keyword = $this->input->post('term');
		$input = '';
		if($cate_level == '1')
			$tbl_field = 'parent_child_id';
		else if($cate_level == '2')
			$tbl_field = 'child_id';
		else
			$tbl_field = 'parent_id';
		
			$input .= " ORDER BY RAND()";

			$limit = 0;
		$query = $this->db->query("select t2.product_id, t2.product_url, SUBSTR(t2.product_name,1,50) as product_name,t2.product_image,a.min_price from products t2 join(select t1.product_id,t1.store_id, min( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS min_price,max( CAST( t1.product_price AS DECIMAL( 10, 2 ) ) ) AS max_price from product_price t1 where t1.product_price > 0 group by t1.product_id)a on a.product_id = t2.product_id where t2.status='1' and t2.product_name LIKE '$keyword%' AND t2.$tbl_field='$cate_id' $input  limit $limit, 4");
		
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return $query->result();
		}else
			return false;
	}
	
	function getproductprice_main($proid,$storeid)
	{
		$query = $this->db->query("SELECT * FROM `product_price` where product_id=".$proid." and store_id=".$storeid." and product_price>0 GROUP BY store_id");
		if($query->num_rows() > 0){
			return $query->row();
		}else
			return false;
		
	}
	
	function find_category_by_name($keyword)
	{
		$query = $this->db->query("SELECT * FROM `product_categories` WHERE category_name LIKE '%$keyword%' AND category_level=0 limit 0,1");
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			$query1 = $this->db->query("SELECT * FROM `product_categories` WHERE category_name LIKE '%$keyword%' AND category_level=1 limit 0,1");
			if($query1->num_rows() > 0)
			{
				return $query1->row();
			}
			else
			{
				$query2 = $this->db->query("SELECT * FROM `product_categories` WHERE category_name LIKE '%$keyword%' AND category_level=2 limit 0,1");
				if($query2->num_rows() > 0)
				{
					return $query2->row();
				}
			}
		}
		return false;
	}
	
	//ganesh 5-3-2106
	function get_us_pawd($id=null)
	{
	$this->db->select('*');
		$this->db->where('user_id', $id);
		$this->db->where('password !=',"");
		$result=$this->db->get('tbl_users'); 
		return  $result->num_rows();
		
	}
	function get_uname()
	{
		$user_id = $this->session->userdata('user_id');
		$this->db->select('first_name');
		$this->db->where('user_id', $user_id);
		$result=$this->db->get('tbl_users');
	 //$this->db->last_query();
			if($result->num_rows>0)
			{
				return $result->row();
			}	
		
		
	}
	//ganesh 11 march
	function get_bank_offers($id)
	{
		
		
		$this->db->where('retailer_id',$id);
		$this->db->where('off_end >=',date('Y-m-d'));		
		$result = $this->db->get('bank_offers');
		//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->result();	
		}
			return false;
		
	}
	
	function get_store_details_byid1($affiliate_id=null,$product_id=null)
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
     
      function get_coupons_api($store,$coupon_id)
	{
		$this->db->connection_check();
		$this->db->where('offer_name', $store);	
		$this->db->where('coupon_id',$coupon_id);
		$result = $this->db->get('coupons');
		if($result->num_rows == 1)
		{
			return $result->row();	
		}
			return false;
	}
	//ganesh 18-3-2016
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

      function send_sms($user_contact,$new_random)
 {
	/*$Username = "umadevi@osiztechnologies.com"; 
	$Password = "h3ygu";*/
	 	/*$Username = "swethaosiztech@gmail.com"; 
	    $Password = "rto4o";*/
	//echo $user_contact;die;
	/*$Username = "splendidsharmi@gmail.com"; 
	$Password = "2arxa"; */
	// $MsgSender = "YourSender, example: a phone number like 4790000000"; 
	$MsgSender = "9942619966"; 
	 //$DestinationAddress = "919751896864"; 
	//$DestinationAddress = $user_contact;
          $DestinationAddress = "+91".$user_contact;
            //echo $DestinationAddress;die;
	// $Message = "Hello World!"; 
	$Message = $new_random;
	// Create ViaNettSMS object with params $Username and $Password 
	$ViaNettSMS = new ViaNettSMS($Username, $Password); 
	try 
	{ 
	    // Send SMS through the HTTP API 
	    $Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message); 
	    // Check result object returned and give response to end user according to success or not. 
	    if ($Result->Success == true) 
	        $Message = "Message successfully sent!"; 
	    else 
	        $Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage; 
	} 
	catch (Exception $e) 
	{ 
	    //Error occured while connecting to server. 
	    $Message = $e->getMessage(); 
	} 
 }

 	function otp_request()
 	{
 		$otp = $this->input->post('otp');
 		$this->db->where('random_code',$otp);
 		$ver = $this->db->get('tbl_users');
 		$sms_id = $ver->user_id;
 		if($ver->num_rows()==1)
 		{
 			$data = array('status'=>'1');
 			$this->db->where('random_code',$otp);
 			// print_r($data);die;

 			$res = $this->db->update('tbl_users',$data);
 			// echo $this->db->last_query();die;
 			/*if($res)
 			{
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
				
				$first_name = $ver->first_name;
				$last_name =  $ver->last_name;
				$user_email = $ver->email;
				
				$this->db->where('mail_id',1);
				$mail_template = $this->db->get('tbl_mailtemplates');
				if($mail_template->num_rows >0) 
				{        
				   $fetch = $mail_template->row();
				   $subject = $fetch->email_subject;  
				   $templete = $fetch->email_template;  
				   $regurl=base_url().'cashback/verify_account/'.$ver->random_code;
				   
				   	  $this->load->library('email'); 
					  
						$config = Array(
						 'mailtype'  => 'html',
						  'charset'   => 'utf-8',
						  );
		     // $this->email->initialize($config);        
		     			 $this->email->set_newline("\r\n");
					    
					   
					   $this->email->initialize($config);        
					   $this->email->from($admin_email);
					   $this->email->to($user_email);
					   $this->email->subject($subject);
					   
				   
				   
				   $data = array(
								'###USERNAME###'=>$first_name,
								'###COMPANYLOGO###' =>base_url()."/uploads/adminpro/".$site_logo,
								'###SITENAME###'=>$site_name,
								'###ADMINNO###'=>$admin_no,
								'###DATE###'=>$date,
								'###LINK###'=>'<a href='.$regurl.'>'.$regurl.'</a>'
								
				   );
				   
				   $content_pop=strtr($templete,$data);	
				   // echo $content_pop;die;
				   $this->email->message($content_pop);
				   $this->email->send();
					// return true;                
				}	
 			}*/
 			return true;
 		}
 		else
 		{
 			return false;
 		}	
 	}

 	function resend_otp($mail_id,$new_random)
 	{	
 		// echo $mail_id;die;
 		$data = array('random_code'=>$new_random,'status'=>'1');
 		$this->db->where('email',$mail_id);
 		$ver = $this->db->update('tbl_users',$data);
 		if($ver)
 		{
 			$sms = $this->send_sms($user_contact,$new_random);
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 		
 	
 	}
   //22/03/2016...

     function user_details($user_id)
	{
		// echo 'jfhgjfkg';die;
		$this->db->where('user_id',$user_id);
		$this->db->where('admin_status','');
		$ver = $this->db->get('tbl_users');
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
	function offline_user_details($str_id)
	{
		$this->db->select('*');
		$this->db->from('offline_users o');
		$this->db->join('store_details s', 'o.offline_userid=s.user_id','left');
		$this->db->where('s.store_id',$str_id);
		$ver = $this->db->get();

		
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}
	function offline_store_address($store)
	{
		$storeadd=explode(',',$store);
		$this->db->where_in('store_addid',$storeadd);
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

	function coupon_detalis($coupon_id)
	{
		$this->db->where('coupon_id',$coupon_id);
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

	function get_salable_coupons()
	{
		$this->db->connection_check();
		$this->db->order_by('coupon_id','desc');
		/*$date = date('m/d/y');
		$this->db->where('start_date', $date);
		$this->db->or_where('start_date >=', $date);*/
		$this->db->where('coupon_status','1');
		$this->db->where('coupon_type','1');
		$query = $this->db->get('coupons');
		 // echo $this->db->last_query();die;
		if($query->num_rows>0){
			return $query->result();
		} else {
			return false;
		}
	}
	
		function salable_coupon_detals($coupon_id,$random_code)
	{
		$data = array('code'=>$random_code);
		$this->db->where('coupon_id',$coupon_id);
		$res = $this->db->update('coupons',$data);
		if($res)
		{
			$this->db->where('coupon_id',$coupon_id);
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
	}
	// 25/03/2016..

	function offline_login()
	{
		//echo 'dfhdhfg';die;
		$this->db->connection_check();
		$user_email = $this->input->post('email');
		$user_pwd = $this->input->post('pwd');
		$this->db->where('user_email',$user_email);
		$this->db->where('password',$user_pwd);
		$this->db->where('admin_status','1');
		$query = $this->db->get('offline_users');
		// echo $this->db->last_query();die;
		$numrows = $query->num_rows();
		if($numrows==1)
		{
			$fetch = $query->row();
			$user_id = $fetch->offline_userid;
			$user_email=$fetch->user_email;
			$status = $fetch->status;
			if($status =='0')
			{
				return 2;
			}
			else 
			{
			$this->session->set_userdata('offline_user_id',$user_id);
			$this->session->set_userdata('offline_user_email',$user_email);
			return 1;
			}
	   }
		return 0;
	}

	function offline_update_password($user_id)
	{
		$this->db->connection_check();
		 $old_password = $this->input->post('old_password');
		 $new_password = $this->input->post('new_password');
		// $id = $this->input->post('user_id');
		 $id = $user_id;
		
			$where = array('password'=>$old_password,'offline_userid'=>$id);
			$this->db->where($where);
			
			$query = $this->db->get('offline_users');
			if($query->num_rows >= 1) 
			{
				$data = array(
				'password'=>$new_password
				);
				//print_r($data);
				//exit;
				$this->db->where('offline_userid',$id);	
				$this->db->update('offline_users',$data);
				// echo $this->db->last_query();die;
				return true;
			}    
			else 
			{     
				return false;
			}	
	}

	function get_city($cat_id)
	{
		$this->db->where('country_id',$cat_id);
		$ver = $this->db->get('state');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}

	function get_statess($cat_id)
	{
		$this->db->where('state_id',$cat_id);
		$ver = $this->db->get('city');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}
/*
	function get_offline_products($parent_id,$parent_child_id)
	{
		$this->db->where('parent_id',$parent_id);
		$this->db->where('parent_child_id',$parent_child_id);
		// $this->db->where('child_id',$child);
		$ver = $this->db->get('products');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}
*/
	//check Email 
	function offline_check_email($email)
	{
		$this->db->connection_check();
		$this->db->where('user_email',$email);
		// $this->db->where('admin_status','');
		$qry = $this->db->get('offline_users');
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
	
	function offline_register($category_image)
	{
		// echo 'register';die;
		$this->db->connection_check();
		$new_random = mt_rand(1000000,99999999);
		$user_email = $this->input->post('user_email');
		$date = date('Y-m-d h:i:s');
		$uni_id = $this->input->post('uni_id');
		if($uni_id)
		{
			// echo 'user';die;
			$this->db->where('random_code',$uni_id);
			$this->db->where('admin_status','0');
			$query = $this->db->get('offline_users');
			if($query->num_rows > 0)
			{	
				$fetch = $query->row();
				$user_id = $fetch->user_id;
			}
			else
			{
				$user_id = 0;
			}
		}
		else
		{
			// echo 'user0';die;
			$user_id = 0;
		}
		// $store_name = explode(',',$this->input->post('store_name'));
		$data = array(		
		'first_name'=>$this->input->post('first_name'),
		'last_name'=>$this->input->post('last_name'),
		'user_name'=>$this->input->post('user_name'),
		'user_email'=>$user_email,
		'contact_no'=>$this->input->post('contact'),
		'buisness_address'=>$this->input->post('buisness_address'),
		'upload_doc'=>$category_image,
		'password'=>$this->input->post('user_pwd'),
		'random_code'=>$new_random,
		'country'=>$this->input->post('country'),
		'state'=>$this->input->post('state'),
		'city'=>$this->input->post('city'),
		'date_added'=>$date,
		
		);
		/*print_r($data);
		exit;*/
		$this->db->insert('offline_users',$data);
		// echo $this->db->last_query();die;
		if($this->session->userdata('reg_uniq_id'))
		{
			$this->session->unset_userdata('reg_uniq_id');
		}
		 
		//send email 
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
		
		 $first_name = $this->input->post('first_name');
		 $last_name = $this->input->post('last_name');
		 $user_email = $this->input->post('user_email');
		
		$this->db->where('mail_id',14);
		$mail_template = $this->db->get('tbl_mailtemplates');
		if($mail_template->num_rows >0) 
		{        
		   $fetch = $mail_template->row();
		   $subject = $fetch->email_subject;  
		   $templete = $fetch->email_template;  
		   
		   	/*  $this->load->library('email'); 
			  
				$config = Array(
				 'mailtype'  => 'html',
				  'charset'   => 'utf-8',
				  );
     		   
     		   $this->email->set_newline("\r\n");
			   $this->email->initialize($config);        
			   $this->email->from($admin_email);
			   $this->email->to($user_email);
			   $this->email->subject($subject); */
			   $sub_data = array(
						'###SITENAME###'=>$site_name
					);
			   $subject_new = strtr($subject,$sub_data);
		   
		   $data = array(
						'###USERNAME###'=>$first_name,
						'###COMPANYLOGO###' =>base_url()."/uploads/adminpro/".$site_logo,
						'###SITENAME###'=>$site_name,
						'###ADMINNO###'=>$admin_no,
						'###DATE###'=>$date,
		   );
		   
		   $content_pop=strtr($templete,$data);	
		   
		/*   $this->email->message($content_pop);
		   $this->email->send(); */
                       // $from=$ad['email'];
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
			$config['smtp_pass'] = 'abinandu';
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";
			$ci->email->initialize($config);
			$ci->email->from($from, $ad['email_name']);
			$ci->email->to($to);
			$this->email->reply_to($from, $ad['email_name']);
			$ci->email->subject($subject_new);
			$ci->email->message($content_pop);
			$send=$ci->email->send();

		   return true;                
		}
	}

	function get_product_sub_categories()
	{
		$this->db->connection_check();
		$this->db->order_by('sort_order');
		$this->db->where_not_in('parent_id','0');
		$result = $this->db->get('product_categories');
		/*echo '<pre>';
		print_r($result->result());die;*/
		if($result->num_rows > 0)
		{
			return $result->result();				
		}
		else{
			return false;
		}
	}

	function get_subcategory_types($prop_id="")
	{
		if($prop_id!="")
		{
	       $this->db->where('parent_id',$prop_id);
	       $rex=$this->db->get('product_categories');
   		}
   		 if($rex->num_rows()>0)
		    {
		       return $rex->result();
		    }
		    else
		    {
		       return false;
		   }
	}
  	
  	function get_all_products()
  	{
  		$this->db->where('status','1');
  		$this->db->where('product_id','asc');
  		$ver = $this->db->get('products');
  		if($ver->num_rows()>0)
  		{
  			return $ver->result();
  		}
  		else
  		{
  			return false;
  		}
  	}  

  	//function add_offlinestores($store_image)
  	//{
  		//$user_id = $this->session->userdata('offline_user_id');
		//$store_name = $this->input->post('store_name');				
		//$address = $this->input->post('address');
		//$latitude = $this->input->post('latitude');
		//$longtitude = $this->input->post('longtitude');
		//$data = array('store_name'=>$store_name,'store_logo'=>$store_image,'date_added'=>date('Y-m-d h:m:s'),'user_id'=>$user_id);
		//$res = $this->db->insert('store_details',$data);
		//$store_id = $this->db->insert_id();
		//if($res)
		//{				
				//foreach ($address as $key => $field)
				//{	
					//$datacc[ 'store_id'] = $store_id;
					//$datacc['address'] = $address[$key];
					//$datacc['latitude'] = $latitude[$key];
					//$datacc['longtitude'] = $longtitude[$key];
				    //$ver = $this->db->insert('store_address', $datacc);
				     //echo $this->db->last_query();die;
				//}
				//if($ver)
				//{
					//return true;
				//}
				//else
				//{
					//return false;
				//}
        //}
        //else
        //{
        	//return false;
        //}

		
  	//} 
  	
  	function add_offlinestores($store_image)
  	{
  		 //echo 'fgdhjf';die;
  		$user_id = $this->session->userdata('offline_user_id');
		$store_name = $this->input->post('store_name');				
		$address = $this->input->post('address');
		//print_r($address);die;
		$street_address = $this->input->post('route');
		$postal_code = $this->input->post('postal_code');
		$country = $this->input->post('country');
		$latitude = $this->input->post('lat');
		$longtitude = $this->input->post('lng');
		$state = $this->input->post('administrative_area_level_1');
		$city = $this->input->post('locality');
		$data = array('store_name'=>$store_name,'store_logo'=>$store_image,'date_added'=>date('Y-m-d h:m:s'),'user_id'=>$user_id);
		$res = $this->db->insert('store_details',$data);
		$store_id = $this->db->insert_id();
		if($res)
		{	
			//echo ' hfjdhfkjd';die;
				foreach ($address as $key => $field)
				{	
					//echo 'insert';die;
					$datacc[ 'store_id'] = $store_id;
					$datacc['address'] = $address[$key];
					$datacc['street_address'] = $street_address[$key];
					$datacc['latitude'] = $latitude[$key];
					$datacc['longtitude'] = $longtitude[$key];
					$datacc['postal_code'] = $postal_code[$key];
					$datacc['city'] = $city[$key];
					$datacc['country'] = $country[$key];
					$datacc['state'] = $state[$key];
				    $ver = $this->db->insert('store_address', $datacc);
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
        else
        {
        	return false;
        }

		
  	} 

  	function view_stores()
  	{
  		// echo 'dfdhjgfdjh';die;
  		$this->db->connection_check();
  		$this->db->order_by('store_id','desc');
  		$this->db->where('status','1');
  		$this->db->where('user_id',$this->session->userdata('offline_user_id'));
		$result = $this->db->get('store_details');
		/*echo '<pre>';
		print_r($result->result());die;*/
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return false;
		}
  	}

  function update_stores($store_id)
  {
  	$this->db->connection_check();
  	$this->db->where('store_id',$store_id);
  	$this->db->where('status','1');
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

  function view_address($store_id)
  {
  	$this->db->connection_check();
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

  function update_offline_stores($store_image)
  	{
		
		$user_id = $this->session->userdata('offline_user_id');
		$store_id = $this->input->post('store_id');
		$store_name = $this->input->post('store_name');				
		$address = $this->input->post('address');
		//print_r($address);die;
		$street_address = $this->input->post('route');
		$postal_code = $this->input->post('postal_code');
		$country = $this->input->post('country');
		$latitude = $this->input->post('lat');
		$longtitude = $this->input->post('lng');
		$state = $this->input->post('administrative_area_level_1');
		$city = $this->input->post('locality');
		
  	//	print_r($this->input->post());//exit;
  	
  	/*	$store_id = $this->input->post('store_id');
		$store_name = $this->input->post('store_name');				
		$address = $this->input->post('address');
		$latitude = $this->input->post('lat');
		$longtitude = $this->input->post('longtitude'); */
		if($store_image!="")
		{
		$data = array('store_name'=>$store_name,'store_logo'=>$store_image);
		}
		else {
			$data = array('store_name'=>$store_name);
		
		}
		/*echo '<pre>';
		print_r($data);die;*/	
		$this->db->where('store_id',$store_id);
		$ver = $this->db->update('store_details',$data);
		 $query = $this->db->where('store_id',$store_id);
						 $query = $this->db->delete('store_address');
						// $ddd=explode(',',$address);
						// print_r($ddd);
						 $i=0;
						 foreach($address as $ddw=>$rr)
						 {
						 //echo $ddw;
						 	$i++;
						//echo	$latitude[$ddw];
$data = array('address'=>$rr,'store_id'=>$store_id,'latitude'=>$latitude[$ddw],'longtitude'=>$longtitude[$ddw]);

 			$this->db->insert('store_address',$data);
	}
 		//exit;	// print_r($data);die;

 			//$res = $this->db->update('tbl_users',$data);
		if($ver)
		{
			return true;
		}
		else
		{
			return false;
		}
  	} 

  	function update_address($store_id)
  	{
  		$this->db->connection_check();
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
	
	//28-03-2016 Lingeswari
	
function get_pro_details($id)
{
	$this->db->connection_check();
	$this->db->where('status','1');
  		$this->db->where('product_id',$id);
  		$ver = $this->db->get('products');
	//	echo $this->db->last_query();
	//	exit;
  		if($ver->num_rows()>0)
  		{
  			return $ver->row();
			
			
  		}
  		else
  		{
  			return false;
  		}
}
function get_price_det($id)
{
	$this->db->connection_check();
	$this->db->order_by('product_price', 'asc'); 
	$this->db->limit(1);
	$this->db->where('product_id',$id);
		$count = $this->db->get('product_price');
		
			if($count->num_rows()>0)
  		{
  			return $rrr=$count->row();
  		
  		}
  		else
  		{
  			return false;
  		}
}
function get_stores_user()
{
	$user_id = $this->session->userdata('offline_user_id');
	$this->db->connection_check();
  		$this->db->order_by('store_id','asc');
  		$this->db->where('user_id',$user_id);
		$result = $this->db->get('store_details');
		//echo '<pre>';
		//print_r($result->result());die;
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return false;
		}
}
/*
function get_al_offline($pid)
{
	$user_id = $this->session->userdata('offline_user_id');
	$this->db->connection_check();
  	$this->db->where('product_id',$pid);
	$this->db->where('offline_userid',$user_id);
		$result = $this->db->get('offline_products');
		
		if($result->num_rows()>0)
		{
			return $result->row();
		}
		else
		{
			return false;
		}
}*/
/*
function insert_price($pid,$price,$store)
{
	$user_id = $this->session->userdata('offline_user_id');
	$this->db->connection_check();
  	$this->db->where('product_id',$pid);
	
	$this->db->where('offline_userid',$user_id);
		$rest = $this->db->get('offline_products');
	
		if($rest->num_rows()>0)
		{
			$result=$rest->row();
			//echo $result->ofline_id;
			$gew=implode(',',$store);
	$data = array(
			'store_id' => $gew,
			'price'=>$price
			
			);
			$this->db->where('ofline_id',$result->ofline_id);
			$this->db->update('offline_products',$data);
		}
		else {
		
	print_r($store);
	//exit;
$gew=implode(',',$store);
	$data = array(
			'offline_userid' => $user_id,
			'store_id' => $gew,
			'product_id' => $pid,
			'price'=>$price
			);
			$this->db->insert('offline_products',$data);
		}
			return true;
}
*/
/*
function insert_offer($pid,$offer,$store)
{
	$user_id = $this->session->userdata('offline_user_id');
	$this->db->connection_check();
  	$this->db->where('product_id',$pid);
	
	$this->db->where('offline_userid',$user_id);
		$rest = $this->db->get('offline_products');
	
		if($rest->num_rows()>0)
		{
			$result=$rest->row();
			//echo $result->ofline_id;
			$gew=implode(',',$store);
	$data = array(
			'store_id' => $gew,
			'offline_offer'=>$offer
			
			);
			$this->db->where('ofline_id',$result->ofline_id);
			$this->db->update('offline_products',$data);
		}
		else {
		
	print_r($store);
	//exit;
$gew=implode(',',$store);
	$data = array(
			'offline_userid' => $user_id,
			'store_id' => $gew,
			'product_id' => $pid,
			'offline_offer'=>$offer
			);
			$this->db->insert('offline_products',$data);
		}
			return true;
}*/
function offline_userdet($offline_userid)
{
$this->db->where('offline_userid',$offline_userid);
$ver = $this->db->get('offline_users');
if($ver->num_rows()==1)
{
return $ver->row();
}
else
{
return false;
}
}


    function get_offline_stores($prop_id)
   {
   		 //echo $lat;die;
		
		 
   		$this->db->connection_check();
		
		
				 $selqry="SELECT * FROM offline_products as r  WHERE r.product_id = '".$prop_id."' order by r.price asc";        
				
				$query=$this->db->query($selqry); 
				 //echo "hia";die;
				/*echo '<pre>';
				print_r($query->result());die;*/
					if($query->num_rows>0)
		{
			return $offline = $query->result();
			
		}
		else
		{
			return false;
		}
   }


   function get_offline_sto($store_id)
   {
	   //echo "hai";die;
	if($store_id!=''){
   $this->db->connection_check();
  $lat=$this->session->userdata('latitude');
   $lng=$this->session->userdata('langitude');
     /* echo  $sql="SELECT *,( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longtitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM store_details as u left join store_address as g on g.store_id=u.store_id where u.store_id in($store_id) HAVING distance < 10 ";die;   */
    if($store_id!='')
			 {
				$join_g='u.store_id in('.$store_id.')';
			 }
			 else
			 {
				$join_g='u.store_id in(-1)'; 
			 }
   
				  $selqry="SELECT *,( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longtitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM store_details as u left join store_address as g on g.store_id=u.store_id where u.status=1 and $join_g HAVING distance < 10 ";

				$query=$this->db->query($selqry); 
				/*echo '<pre>';
				print_r($query->result());die;*/
					if($query->num_rows>0)
		{
			return $offline = $query->result();
			//print_r($offline);die;
		}
		else
		{
			return false;
		}
	}
   }
   
   function get_offline_price($prop_id)
   {
   	$selqry="SELECT * FROM offline_products as r left join store_details as u on FIND_IN_SET (u.store_id,r.store_id) WHERE r.product_id = '".$prop_id."' and u.status=1 order by r.price ASC";
		//print_r($selqry);die; 
			$query=$this->db->query($selqry);
			
					if($query->num_rows()>0)
		{
			return $offline = $query->row();
			//print_r($offline);die;
		}
		else
		{
			return false;
		}
   }
   
   //sharmila
   //forget password
	function offline_forgetpassword()
	{
		$this->db->connection_check();
		$email =$this->input->post('email');
		//send email 
		$this->load->library('email');
		
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
		
		$this->db->where('user_email',$email);
		$this->db->where('admin_status','1');
		$query = $this->db->get('offline_users');
		if($query->num_rows >0) 
		{
			$getuser = $query->row();
			 $user_id = $getuser->offline_userid;
			$password = $getuser->password;
			$first_name = $getuser->first_name;
			// echo $first_name;
			$last_name = $getuser->last_name;
		    $user_email =  $getuser->user_email;
			$random_id =$getuser->random_code;
			$this->db->where('mail_id',15);
			$mail_template = $this->db->get('tbl_mailtemplates');
			if($mail_template->num_rows >0) 
			{        
			   $fetch = $mail_template->row();
			   $subject = $fetch->email_subject;  
			   $templete = $fetch->email_template;  
			    $regurl=base_url().'cashback/offline_password_reset/'.insep_encode($user_id);
			 
			 
					   
				   
			/* $config = Array(
				 'mailtype'  => 'html',
				  'charset'   => 'utf-8',
				  );*/
     // $this->email->initialize($config);        
     		  /* $this->email->set_newline("\r\n");
			   $this->email->initialize($config);        
			   $this->email->from($admin_email);
			   $this->email->to($user_email);
			   $this->email->subject($subject);*/
			   
			   $sub_data = array(
						'###SITENAME###'=>$site_name
					);
	           $subject_new = strtr($subject,$sub_data);
		   
			   
			   $data = array(
							'###USERNAME###'=>$first_name.' '.$last_name,
							'###PASSWORD###'=>$password,
							'###SITENAME###'=>$site_name,
							'###ADMINNO###'=>$admin_no,
							'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
							'###DATE###'=>$date,
							'###LINK###'=>'<a href='.$regurl.'>'.'Click here'.'</a>'
							
			   );
			   
			   $content_pop=strtr($templete,$data); 
			   // print_r($content_pop);die;
			 //  exit;
			   
			   /*$this->email->message($content_pop);
			   $this->email->send();*/
				$mail=$this->mail_function($admin_email,$user_email,$subject_new,$content_pop);  
				
				          
			}
			 return true;          
		}
		   
			else{
				return false;                
			}   
		
		
	}

	//reset_password
	function offline_reset_password($user_id)
	{
			/*echo $user_id;
			exit;*/
			$this->db->connection_check();
			if(!isset($user_id))
			{
				$user_id = $this->input->post('user_id');
			}
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
						
			$where = array('offline_userid'=>$user_id);
			// print_r($where);
			// exit;
			$this->db->where($where);
			
			$query = $this->db->get('offline_users');
			// echo $this->db->last_query();die;
			if($query->num_rows >0) 
			{
				$data = array(
				'password'=>$new_password
				);
				//print_r($data);
				//exit; 
				$this->db->where('offline_userid',$user_id);	
				$this->db->update('offline_users',$data);
				// echo $this->db->last_query();die;
				return true;
			}    
			else 
			{     
				return false;
			}		
		
	}
	 function get_speci_option($cat_id,$speci_id)
	  {
	  	$this->db->where('cat_id',$cat_id);
			$this->db->where('speci_id',$speci_id);
	
	  	$get=$this->db->get('specification_cat');
	
		if($get->num_rows() >0)
		{
				//print_r($get->row());exit;
			return $get->row();
		}
		return false;
	  }
	
//lingeshwari 02-04-2016
	function get_al_offline($pid)
	{
				$this->db->connection_check();
		$this->db->select('P.product_id,P.product_name,PR.product_price');
		$this->db->join('product_price as PR','P.product_id=PR.product_id');
		$this->db->group_by('PR.product_id');
		$this->db->where('P.brands',$pid);
		$result = $this->db->get('products as P');

		if($result->num_rows()>0)
		{
			
		return $result->result();
		}
		else
		{
		return false;
		}
		}
		function getProPrice($pro_id)
		{
		$this->db->where('product_id',$pro_id);
		$query = $this->db->get('offline_products');
		if($query)
		{
		return $query->row();
		}
		else
		{
		return false;
		}
	}
	function insert_price($pid,$price,$store,$brand)
	{
		$user_id = $this->session->userdata('offline_user_id');
		$this->db->connection_check();
		$this->db->where('product_id',$pid);
		$this->db->where('brand_id',$brand);
		$this->db->where('offline_userid',$user_id);
		$rest = $this->db->get('offline_products');

			if($rest->num_rows()>0)
			{
				$result=$rest->row();
				$gew=implode(',',$store);
		$data = array(
				'store_id' => $gew,
				'price'=>$price

				);

				$this->db->where('ofline_id',$result->ofline_id);
				$this->db->update('offline_products',$data);
				 echo $this->db->last_query();die;
			}
			else {

			$gew=implode(',',$store);
		$data = array(
				'offline_userid' => $user_id,
				'store_id' => $gew,
				'brand_id' => $brand,
				'product_id'=>$pid,
				'price'=>$price
				);
				$this->db->insert('offline_products',$data);
				// echo $this->db->last_query();die;
			}
				return true;

	}

	function insert_offer($pid,$offer,$store,$brand)
	{

		$user_id = $this->session->userdata('offline_user_id');
		$this->db->connection_check();
		  $this->db->where('product_id',$pid);
		$this->db->where('brand_id',$brand);
		$this->db->where('offline_userid',$user_id);
		$rest = $this->db->get('offline_products');
			if($rest->num_rows()>0)
			{
				$result=$rest->row();
				$gew=implode(',',$store);
		$data = array(
				'store_id' => $gew,
				'offline_offer'=>$offer

				);
				$this->db->where('ofline_id',$result->ofline_id);
				$this->db->update('offline_products',$data);

			}
			else {
			$gew=implode(',',$store);
				$data = array(
						'offline_userid' => $user_id,
						'store_id' => $gew,
						'product_id' => $pid,
						'brand_id'=> $brand,
						'offline_offer'=>$offer
						);
						$this->db->insert('offline_products',$data);
			}
				return true;

	}
	function get_Stores($offline_userid)
	{
		$this->db->where('user_id',$offline_userid);
		$ver = $this->db->get('store_details');
		if($ver->num_rows>0)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}
	

	function get_offline_products($parent_id,$parent_child_id)
	{
		$this->db->select('*');
	    $this->db->from('brands');
	    $this->db->where('products.parent_id',$parent_id);
	    $this->db->where('products.parent_child_id',$parent_child_id);
		$this->db->group_by('brands.brand_id');
	    $this->db->join('products', 'products.brands = brands.brand_id', 'right');
	    $query = $this->db->get();
	     //echo $this->db->last_query();die;
			if($query->num_rows()>0)
			{
				return $offline = $query->result();
				//print_r($offline);die;
			}
			else
			{
				return false;
			}
	}

	function list_products($user_id)
	{
                $this->db->order_by('ofline_id','desc');
		$this->db->where('offline_userid',$user_id);
		$ver = $this->db->get('offline_products');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
				return false;
		}
	}


	function get_Productname($product_id)
	{
		$this->db->where('product_id',$product_id);
		$ver = $this->db->get('products');
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
	}

	function delete_products($ofline_id)
	{
		// echo'dfd';die;
		$this->db->where('ofline_id',$ofline_id);
		$this->db->delete('offline_products');
		return true;
	}
	function update_count($store_id)
	{
		$this->db->connection_check();
		$this->db->where('store_id',$store_id);
		$ver = $this->db->get('store_address');
		if($ver->num_rows()>0)
		{
		return $ver->num_rows();
		}
		else
		{
		return false;
		}
	}

// total count for referral
	function product_store_count($product_id){
		$this->db->connection_check();
		
		$this->db->select('*');
		$this->db->from('products a');
		$this->db->join('product_price b', 'a.default_store=b.store_id','left');
		$this->db->where('b.product_price >',0);
		$this->db->where('b.product_id',$product_id);
		$this->db->where('a.product_id',$product_id);
		$default = $this->db->get();
		//echo $this->db->last_query();
		if($default->num_rows >0)
		{
			 $default->row('product_price');
			
			 $percentage=$default->row('product_price')*(.25);
			 $start_price=$default->row('product_price')-$percentage;
			
			 $end_price=$default->row('product_price')+$percentage;
		
		}
		
		
		// echo $product_id;
		// echo "SELECT COUNT(*) AS store_id FROM product_price  WHERE product_id = '".$product_id."'";
  	$selqry=$this->db->query("SELECT COUNT(*) AS store_id FROM product_price  WHERE product_id = '".$product_id."' group by store_id");
  	//echo $this->db->last_query();die;
  	if($selqry)
  	{
  		// echo 'dfdhg';
  		
  		$sele = $selqry->row();
  		$online_st = $sele->store_id;
  		// echo $online_st;
  	}
  	else
  	{
  		$online_st = 0;		
  	}
  	// echo "SELECT store_id FROM offline_products  WHERE product_id = '".$product_id."'";
	$sel=$this->db->query("SELECT store_id FROM offline_products  WHERE product_id = '".$product_id."'");
	 //echo $this->db->last_query();die;
	 $lat=$this->session->userdata('latitude');
	$lng=$this->session->userdata('langitude');
			
		if($sel)
		{
			
			
			$offline_sts = $sel->result();
			
			$store_ids='';
			 foreach($offline_sts as $offline_st)
			 {
				 if(count($offline_sts)>1)
				 {
					 $store_id=$store_ids.','.$offline_st->store_id;
					 $arr_str=explode(',',$store_id);
					 $arr_str=array_filter($arr_str);
					 
					 $store_ids=implode(',',$arr_str);
				 }
					else
					{
						$store_ids=$offline_st->store_id;
					}
				 
			 }
			 if($store_ids!='')
			 {
				$join_g='u.store_id in('.$store_ids.')';
			 }
			 else
			 {
				$join_g='u.store_id in(-1)'; 
			 }
			 
			  $selqry="SELECT *,( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longtitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM store_details as u left join store_address as g on g.store_id=u.store_id where u.status=1 and $join_g HAVING distance < 10 ";
			$query=$this->db->query($selqry);
			$offline_count=$query->num_rows();
			 
			// print_r($count);die;
	    }
	    if($default->num_rows >0)
		{
			 $default->row('product_price');
			
			 $percentage=$default->row('product_price')*(.25);
			 $start_price=$default->row('product_price')-$percentage;
			
			 $end_price=$default->row('product_price')+$percentage;
			 
			 
			 
		$this->db->where('product_price >=',$start_price);
		$this->db->where('product_price <=',$end_price);
		}
		else
		{
			$this->db->where('product_price >',0);
		}
		
		$this->db->where('product_id',$product_id);
		$this->db->group_by('store_id');
		$count = $this->db->get('product_price');
		
		//echo $this->db->last_query();die;
		$array = array();
		if($count->num_rows > 0)
		{
			$row = $count->row();
			$array['count'] = $count->num_rows+$offline_count;
			// print_r($array['count']);
			$array['price'] = $row->product_price;
			//print_r($array);die;
			return $array;
		}else{
			return '0';
		}
			
	}


	function offline_verify_account($verifyid)
	{
		$this->db->connection_check();
		$where = array('random_code'=>$verifyid,'admin_status'=>'0');
		$this->db->where($where);
		$this->db->where('admin_status','0');
		$query = $this->db->get('offline_users');
          
			if($query->num_rows >= 1) 
			{

			$data = array(		
				'admin_status' => 1,
			);
			$this->db->where('random_code',$verifyid);	
			$this->db->update('offline_users',$data);
			$fetch = $query->row();
			// echo $fetch->random_code;die;
			/*echo '<pre>';
			print_r($fetch);*/
			echo $user_id = $fetch->offline_userid;die;
			$user_email=$fetch->user_email;
			$this->session->set_userdata('offline_user_id',$user_id);
			$this->session->set_userdata('offline_user_email',$user_email);
			return 1;
		}  
		else
		{
			return 0;
		}  
	}

	function mail_function($admin_email,$user_email,$subject,$content_pop)
   {
   		// echo 'hfgdhj';die;
   		// echo $content_pop;die;
            $from = $admin_email;
			$to= $user_email;
			// echo $to;
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
	}
	
	//ganesh
	
	function get_price_compare($cat_id=null)
	{
		$this->db->connection_check();	
		$this->db->where('cate_id', $cat_id );
		$result = $this->db->get('product_categories');
	//echo $this->db->last_query();
		if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
	}

	// 26/04/2016 sharmila...

	function coupon_ajax($page_num)
		{
			
			$this->db->connection_check();
			$last = $page_num*20;
			$old_page = $page_num-1;
			$first = $old_page*20;			
			$this->db->limit($last,$first);
			$this->db->order_by('coupon_id','desc');
			
			$result = $this->db->get('coupons');
		//echo $this->db->last_query();
		
			if($result->num_rows > 0){
				return $result->result();	
			}
				return false;
		}

		// sharmila  29/04/2016...

   function view_coupons()
	{	
		$offline_id = $this->session->userdata('offline_user_id');
		$this->db->order_by('store_id','desc');
		$this->db->where('user_id',$offline_id);
		$this->db->where('status','1');
		$ver = $this->db->get('store_details');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return fasle;
		}
	}

	function store_Name($id)
	{	
		$this->db->where('store_id',$id);
		$this->db->where('status','1');
		$ver = $this->db->get('store_details');
		// echo $this->db->last_query();
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
		
		
	}

	// store_Location
	function store_Location($id,$store_id)
	{
		$query = $this->db->query("select * from store_address where store_addid='$id' AND store_id ='$store_id'")->row();
		return $query;
	}

	// coupon_transaction
	function coupon_transaction()
	{
		$query = $this->db->query("select * from salable_coupon ORDER BY salable_id='desc'")->result();
		// echo $this->db->last_query();
		return $query;
	}

	

	function coupons_det($id)
	{
		$query = $this->db->query("select * from coupons where coupon_id='$id' AND coupon_status='1' AND coupon_type='1'")->row();
		return $query;
	}

	

	function transaction_details($id)
	{
		$this->db->where('trans_id',$id);
		$ver = $this->db->get('transation_details');
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

	function check_store($store_name)
	{
		$this->db->where('store_name',$store_name);
		$ver = $this->db->get('store_details');
		$num_row = $ver->num_rows();
		if($num_row == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function coupon_res($id)
	{
		$this->db->where('store_id',$id);
		$this->db->where('coupon_status','1');
		$this->db->where('coupon_type','1');
		$ver = $this->db->get('coupons');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}

	function store_name_details($id)
	{	
		$this->db->where('store_id',$id);
		$this->db->where('status','1');
		$ver = $this->db->get('store_details');
		// echo $this->db->last_query();
		if($ver->num_rows()==1)
		{
			return $ver->row();
		}
		else
		{
			return false;
		}
		
		
	}

	function view_coupons_salable()
	{
		$this->db->where('coupon_status','1');
		$this->db->where('coupon_type','1');
		$ver = $this->db->get('coupons');
		if($ver->num_rows()>0)
		{
			return $ver->result();
		}
		else
		{
			return false;
		}
	}

	// sharmila 04/05/2016 ....

	function delete_coupon_id($id)
	{
		$id = base64_decode($id);
		$this->db->where('salable_id',$id);
		$ver = $this->db->delete('salable_coupon');
		return true;
	}

	function my_coupons()
	{
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id',$user_id);
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

	function filter_specification($cate_id=null,$spec_id=null)
{
	
	$this->db->connection_check();
	$this->db->where('cate_id', $cate_id );
	$this->db->where('spec_id', $spec_id );
	$result = $this->db->get('filter');
	// echo $this->db->last_query();
	if($result->num_rows > 0){
			return $result->row();	
		}
			return false;
}

function min_comparison_details($product_id)
{
	
	$this->db->select('*');
		$this->db->from('products a');
		$this->db->join('product_price b', 'a.default_store=b.store_id','left');
		$this->db->where('b.product_price >',0);
		$this->db->where('b.product_id',$product_id);
		$this->db->where('a.product_id',$product_id);
		$default = $this->db->get();
		if($default->num_rows >0)
		{
			 $default->row('product_price');
			
			 $percentage=$default->row('product_price')*(.25);
			 $start_price=$default->row('product_price')-$percentage;
			
			 $end_price=$default->row('product_price')+$percentage;
		
		}
		//echo $this->db->last_query();die;
		
		$this->db->connection_check();
		$this->db->where('product_status',1);
		$this->db->where('product_id',$product_id);
		$query=$this->db->get('product_price');
		//echo $this->db->last_query();die;
		if($query->num_rows >0)
		{
			$c=1;
		}
		else
		{
			$c=0;
		}
		$this->db->select('*');
		$this->db->from('product_price a');
		$this->db->join('affiliates b', 'a.store_id = b.affiliate_id', 'left');
		$this->db->where('a.product_id', $product_id);
		//$this->db->where('a.product_price >', 0);
		$this->db->where('a.product_price >=', $start_price);
		$this->db->where('a.product_price <=', $end_price);
		$this->db->where('a.product_status', $c);
		$this->db->group_by('b.affiliate_id');
		//$this->db->order_by(ABS(`a`.`product_price` - 2999),'asc');
		
		if($comparison_details)
		{
			//"CAST(a.product_price AS DECIMAL(10,2))"
			switch($comparison_details)
			{
				case 'price_high':
					$this->db->order_by("CAST(`a`.`product_price` AS DECIMAL(10))", "DESC");
				break;
				case 'price_low':
					$this->db->order_by("CAST(`a`.`product_price` AS DECIMAL(10))", "asc");
				break;	
				default:
					$this->db->order_by("CAST(`a`.`product_price` AS DECIMAL(10))", "asc");		
			}
		}
		else
		{
			$this->db->order_by('CAST(`a`.`product_price` AS DECIMAL(10))', "asc");
		}
		$this->db->limit('1','0');
		$query = $this->db->get(); 
		//echo $this->db->last_query();die; 
		if($query->num_rows() != 0)
		{
			return $query->row();				
		}
			return false;
}

//ganesh june 4
function user_balance_coins($user_id=null)
{
	$this->db->connection_check();
		if($user_id!="")
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('admin_status','');
			$allfaqs = $this->db->get('tbl_users');
			
			return $allfaqs->row();
		}
		else
		{
			return 0;
		}
}

function get_min_rewards($lmt=null)
 {
	 $this->db->connection_check();
		if($lmt!="")
		{
			$this->db->limit($lmt,0);
		}	
		$result = $this->db->query("SELECT min(cob_coins) as min_value FROM `rewards`  where rewards_status=1 ORDER BY CAST( replace(`cob_coins`, ',', '') AS DECIMAL(10,2)) ASC");
		//echo $this->db->last_query();
		if($result->num_rows > 0)
		{
			return $result->row('min_value');	
		}
			return false;
 } 
	function update_user_points($userid,$requestpay)
	{
		//balance
		$this->db->connection_check();
	
		$userbalance = $this->user_points($userid);
		
		if($requestpay > $userbalance){
			return false;
		}
		
		if($requestpay < $minimum_cashback){
			return false;
		}
		
		$new_balnce = $userbalance-$requestpay;
		$data = array(		
		'ads_points' => $new_balnce);
		$this->db->where('user_id',$userid);
		$update_qry = $this->db->update('tbl_users',$data);
		if($update_qry)
		{
			$now = date('Y-m-d H:i:s');
			// redamption
			$data = array(		
			'requested_points' => $requestpay,
			'user_id' => $userid,
			'date_added' => $now,
			'status ' => 'Requested');
			$this->db->insert('redamptions',$data);
		}
		return true;
			
	}
	
	function user_points($user_id=null)
	{
		$this->db->connection_check();
		if($user_id!="")
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('admin_status','');
			$allfaqs = $this->db->get('tbl_users');
			return $allfaqs->row("ads_points");
		}
		else
		{
			return 0;
		}
		
	}
	function chk_user_deactivate($user_id)
	{
		$this->db->connection_check();
		$this->db->where('user_id',$user_id);
		$this->db->where('status',0);
		$query=$this->db->get('tbl_users');
		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
		
	}
	
	//ganesh june 18
	function product_specification_filter($cat_id)
	{
		
		$this->db->connection_check();
		
		$this->db->where('cate_id',$cat_id);
		
		$query=$this->db->get('product_categories');
		return $query->row('category_specifications');
		
		/* for($i=0;$i<count($result);$i++)
		{
			$specify[]=$result[$i]->spec_id;
		}
		return $specs=implode(',',$specify); */
		
	}
	//ganesh jjune 27
	function get_reward_points()
	{
		$this->db->connection_check();
		$this->db->select('*');
		$query=$this->db->get('rewards_details');
		if($query->num_rows()>0)
		{
			return $query->row();
		}
	}
	function contact_us()
	{
		$this->db->connection_check();
		$mailto=$this->input->post('user_email');
		$data = array(		
		'name'=>$this->input->post('u_name'),
		
		'email'=>$this->input->post('user_email'),
		'message'=>$this->input->post('description'),
		);
		$this->db->insert('tbl_contact',$data);
		
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
		$nows=date('d-m-Y');
		$mail_temp = $this->db->query("select * from tbl_mailtemplates where mail_id='18'")->row();
			$fe_cont = $mail_temp->email_template;
			$subject = $mail_temp->email_subject;
			$gd_api=array(
					'###NAME###'=>$this->input->post('u_name'),
					'###SITENAME###'=>$site_name,
					'###ADMINNO###'=>$admin_no,
					'###DATE###'=>$nows,
					
					'###COMPANYLOGO###'=>base_url()."/uploads/adminpro/".$site_logo,
					
				);
				
				 $gd_message=strtr($fe_cont,$gd_api);

				
				$sub_data = array(
						'###SITENAME###'=>$site_name
					);
		   
	    		 $subject_new = strtr($subject,$sub_data);
				 
			$this->mail_function($admin_email,$mailto,$subject_new,$gd_message);
			
		return true;
	}
	
}
?>
