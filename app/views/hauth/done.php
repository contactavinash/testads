<?php
//echo '<pre>';
//print_r($user_contacts);
//exit;

$data['user_contacts'] = $user_contacts;
//$this->session->set_userdata('admins',$user_contact);
$this->load->view('front/ref_friends',$data);


//redirect('cashback/refer_friends','refresh');
// $this->session->set_userdata('admins',$user_contacts);
// print_r($admins);


// echo '<pre>';
// print_r($user_contacts);
// exit;
//	var_dump($user_profile);

?>
