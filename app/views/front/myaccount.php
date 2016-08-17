<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - My Account</title>
<?php $this->load->view('front/css_script');?>
<style>
.error {
	color:#ff0000 !important;
	font-weight:normal !important;
}
.required_field {
	color:#ff0000 !important;
}
</style>
</head>

<body>
<?php $this->load->view('front/header');?>

<!-- header ends here --->



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec gap-top-20  clearfix ">


  <div class="container">
    
         <div class="row">
         
        <?php $this->load->view('front/user_menu'); ?>
         
         <div class="col-md-9">         
         <div class="all clearfix">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#User_Profile" aria-controls="User_Profile" role="tab" data-toggle="tab">Personal Info</a></li>
				<li role="presentation"><a href="#Edit_Profile" aria-controls="Edit_Profile" role="tab" data-toggle="tab">Edit Profile</a></li>
				<li role="presentation" style="display:<?php if($user_type==1){echo "block";}else{echo "none";} ?>" ><a href="#Settings" aria-controls="Settings" role="tab" data-toggle="tab">Password</a></li>
				<li role="presentation"><a href="#Payment_settings" aria-controls="Payment_settings" role="tab" data-toggle="tab">Payment Settings</a></li>
                                      
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			<br>
				<?php  $error = $this->session->flashdata('error');
							 if($error!="") {
								echo '<div class="alert alert-warning">
								<button data-dismiss="alert" class="close">x</button>
								<strong>'.$error.'</strong></div>';
							} ?>
							<?php
								$success = $this->session->flashdata('success');
								if($success!="") {
								echo '<div class="alert alert-success">
									<button data-dismiss="alert" class="close">x</button>
									<strong>'.$success.' </strong></div>';
				} ?>

				<?php 
				if($results->payu_id=='' && $results->payu_key=='' && $results->salt=='' && $results->payu_email==''){	
				echo '<div class="alert alert-danger fade in">
				<strong>Please Fill your Profile Details !!! <a href="#Edit_Profile" aria-controls="Edit_Profile" role="tab" data-toggle="tab">Edit Profile</a></strong></div>';
			}
			else
			{
				$url=$this->session->userdata('redirect_url');
				if($url)
				{
					
				header('Location:'.$url);
				$this->session->unset_userdata('redirect_url');
				}
				else
				{
					
				}
			}
			?>


				<div role="tabpanel" class="tab-pane active" id="User_Profile">
					
					<div class="panel" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
						<div class="panel-heading">
								<h4 class="text-center text-uppercase">About</h4>
								<div class="bor bg-red"></div>
								
						</div>							
						<hr>
						<div class="panel-body">							
							<div class="about-area">
								<h4>Basic Information</h4>
									<div class="table-responsive">
									  <table class="table">
										<tbody>
										  <!--<tr>
											<th>Web</th>
											<td><a href="#">www.johndoe.com</a></td>
										  </tr>-->
										  <tr>
											<th style="width:345px;">Email</th>
											<td><a href="#"><?php echo $results->email;?></a></td>
										  </tr>
										  <tr>
											<th>Phone</th>
											<td><?php echo $results->contact_no; ?></td>
										  </tr>
										  <!--<tr>
											<th>Position</th>
											<td>Designer</td>
										  </tr>
										  <tr>
											<th>Status</th>
											<td>Member</td>
										  </tr>-->
										  
										</tbody>
									  </table>
									</div>
							</div>
							<div class="about-area">
								<h4>Personal Information</h4>
									<div class="table-responsive">
									  <table class="table about-table">
										<tbody>
										  <tr>
											<th>Full Name</th>
											<td><?php $fname = $results->first_name; $lname =$results->last_name; echo $fname.' '.$lname;?></td>
										  </tr>
										  <!--<tr>
											<th>Birth Date</th>
											<td>1 January</td>
										  </tr>
										  <tr>
											<th>Birth Year</th>
											<td>1980</td>
										  </tr>
										  <tr>
											<th>Gender</th>
											<td>Male</td>
										  </tr>-->
										  <tr>
											<th>Street</th>
											<td><?php echo $results->street; ?></td>
										  </tr>
										  <tr>
											<th>City</th>
											<td><?php echo $results->city; ?></td>
										  </tr>
										  <tr>
											<th>State</th>
											<td><?php echo $results->state; ?></td>
										  </tr>
										  <tr>
											<th>Country</th>
											<td>India</td>
										  </tr>
										</tbody>
									  </table>
									</div>
							</div>
						</div>
					</div>                                        
				</div>
				<div role="tabpane1" class="tab-pane" id="Edit_Profile">                                     
					<div class="panel" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
						<div class="panel-heading">
							<h4 class="mar-no">Edit Profile</h4>
						</div>
                        
                        <hr>
						<div class="panel-body">
						<div class="row">
							<div class="col-md-12">							
							<?php	//form begin
							$attributes = array('role'=>'form','name'=>'profile_form','id'=>'profile_forms','method'=>'post','class'=>'form-horizontal tabular-form');
							echo form_open('cashback/update_account',$attributes); ?>
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $results->user_id;?>">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">First Name</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="First Name"  maxlength="20"  id="first_name" name="first_name" class="form-control" required value="<?php echo $results->first_name;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Last Name</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Last Name"  maxlength="20"  id="last_name" name="last_name" class="form-control" required value="<?php echo $results->last_name;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Email Address</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" readonly id="email" name="email" class="form-control" required value="<?php echo $results->email;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Street</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Street" maxlength="50" id="street" name="street" class="form-control" required value="<?php echo $results->street;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">City</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="City" maxlength="50" id="city" name="city" class="form-control" required value="<?php echo $results->city;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">State</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="State" maxlength="50" id="state" name="state" class="form-control" required value="<?php echo $results->last_name;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Zipcode</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Zipcode"  maxlength="7" id="zipcode" name="zipcode" class="form-control" required value="<?php echo $results->zipcode;?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Country</label>
								<div class="col-sm-8 tabular-border">
									<input type="text"  readonly id="country" name="country" class="form-control" required value="India" autocomplete="off">
									<input type="hidden" placeholder="Country" id="country" name="country" class="form-control" required value="103" autocomplete="off">
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Contact No </label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Contact No" id="contact_no" name="contact_no" class="form-control" required value="<?php echo $results->contact_no;?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Merchant Key </label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Merchant Key" id="merchant_key" name="merchant_key" class="form-control"  value="<?php echo $results->payu_key;?>" autocomplete="off">
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Merchant Id </label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Merchant Id" id="merchant_id" name="merchant_id" class="form-control"  value="<?php echo $results->payu_id;?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Salt Id No </label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Salt Id" id="salt_id" name="salt_id" class="form-control"  value="<?php echo $results->salt;?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-name">Payu Email </label>
								<div class="col-sm-8 tabular-border">
									<input type="email" placeholder="Payu Email" id="payu_email" name="payu_email" class="form-control" required value="<?php echo $results->payu_email;?>" autocomplete="off">
								</div>
							</div>

													
							<div class="panel-footer">
								<div class="row">
									<div class="col-sm-8 col-sm-offset-4">
										<!--<button class="btn-danger btn bor-rad-no">Save Changes</button>-->
										<input type="submit"  name="save_changes" id="save_changes" class="btn-danger btn bor-rad-no" value="Save Changes">
										<a href="<?php echo base_url(); ?>"><button class="btn-default btn bor-rad-no">Cancel</button></a>
									</div>
								</div>
							</div>
									
						  <?php echo form_close(); ?>
							</div>
						</div>
					</div>					
					</div>                              
				</div>
				<div role="tabpanel" class="tab-pane" id="Settings">                                        
					<div class="panel" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
						<div class="panel-heading">
							<h4 class="text-center text-uppercase">Change Password</h4>
								<div class="bor bg-red"></div>
						</div>                        
                        <hr>
						<div class="panel-body">
						<div class="row">
					<div class="col-md-12">
							<?php	//form begin
							$attributes = array('role'=>'form','name'=>'account_form','id'=>'account_form','method'=>'post','class'=>'form-horizontal tabular-form');
							echo form_open('cashback/change_password',$attributes);
							?>
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $results->user_id;?>">
							
								
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-password">Current Password</label>
								<div class="col-sm-8 tabular-border">
									<input type="password" placeholder="Password" maxlength="20" id="old_password" name="old_password" maxlength="20" class="form-control" required autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-confirmpass">New Password</label>
								<div class="col-sm-8 tabular-border">
									<input type="password" placeholder="New Password" maxlength="20"  id="new_password" name="new_password"  class="form-control" required autocomplete="off">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-confirmpass">Re-type New Password</label>
								<div class="col-sm-8 tabular-border">
									<input type="password" placeholder="Re-type New Password" maxlength="20"  id="confirm_password" name="confirm_password" class="form-control" required autocomplete="off">
								</div>
							</div>
								
							<div class="panel-footer">
								<div class="row">
									<div class="col-sm-8 col-sm-offset-4">
										<!--<button class="btn-danger btn bor-rad-no">Change Password</button>-->
										<input type="submit" name="save" id="save" class="btn-danger btn bor-rad-no" value="Change Password"> 
										<a href="<?php echo base_url(); ?>"><button class="btn-default btn bor-rad-no">Cancel</button></a>
									</div>
								</div>
							</div>	
							<?php echo form_close(); ?>
						  </div>
						 </div>
						</div>						
					</div>    
				</div>
				<div role="tabpanel" class="tab-pane" id="Payment_settings">				
					<div class="panel" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
							<div class="panel-heading">
							
							<h4 class="text-center text-uppercase">Enter Bank Details</h4>
								<div class="bor bg-red"></div>
								
								<h4 class="mar-no">Enter Bank Details</h4>
							</div>                        
							<hr>
							<div class="panel-body">
							<div class="row">
							<div class="col-md-12">
							<?php	//form begin
										$attributes = array('role'=>'form','name'=>'bankpayment_form','id'=>'bankpayment_form','method'=>'post','class'=>'form-horizontal tabular-form');
										echo form_open('cashback/bankpayment',$attributes);
							?>
							 <input type="hidden" name="user_id" id="user_id" value="<?php echo $results->user_id;?>">
							 <input type='hidden' name='type_user' value='<?php echo $user_type; ?>'>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-password">Name of Bank Account Holder </label>
								<div class="col-sm-8 tabular-border">
									<input type="text" maxlength="50" placeholder="Name of Bank Account Holder" name="act_holder" value="<?php echo $results->account_holder;?>" id="act_holder" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-confirmpass">Bank name</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Bank name" maxlength="50" name="bank_name" id="bank_name" value="<?php echo $results->bank_name;?>" autocomplete="off" required class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-confirmpass">Bank Branch Name</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Bank Branch Name" maxlength="50" name="bank_brch_name" value="<?php echo $results->branch_name;?>" id="bank_brch_name" required autocomplete="off"class="form-control">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-confirmpass">Bank Account Number</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="Bank Account Number" maxlength="50" name="act_no" value="<?php echo $results->account_number;?>" id="act_no" required autocomplete="off" class="form-control">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="form-confirmpass">IFSC Code for Bank</label>
								<div class="col-sm-8 tabular-border">
									<input type="text" placeholder="IFSC Code for Bank" maxlength="50" name="ifsc_code" id="ifsc_code" value="<?php echo $results->ifsc_code;?>" required autocomplete="off" class="form-control">
								</div>
							</div>
							
							 <div class="form-group" style="display:<?php if($user_type==1){echo "block";}else{echo "none";} ?>">
								<label class="col-sm-4 control-label" for="form-confirmpass">Enter password to confirm</label>
								<div class="col-sm-8 tabular-border">
									<input type="password" placeholder="Enter password to confirm" maxlength="50" name="con_pwd" id="con_pwd" required autocomplete="off" class="form-control">
								</div>
							</div>	
 							<div class="panel-footer">
								<div class="row">
								<div class="col-sm-8 col-sm-offset-4">
									<!--<button class="btn-danger btn bor-rad-no">Save Changes</button>-->
									<input type="submit" name="save_chages" id="save_chages" value="Save Changes" class="btn-danger btn bor-rad-no">
									<button class="btn-default btn bor-rad-no">Cancel</button>
								</div>
								</div>
							</div>
						<?php echo form_close(); ?>
						</div>
						</div>
						</div>
					
					</div>				
				</div>
		   
			</div>
		</div>
      </div>
         
      </div>
      </div>
   
</section>

<!--- inner pagesec ends here --->

<?php $this->load->view('front/partners');?>

<!--- partners ebds here --->

<?php $this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
<script type="text/javascript">
$('#contact_no').keyup(function(){
	var contact_no = $('#contact_no').val();
	if(parseFloat(contact_no)<=0){
		$('#contact_no').val("");
	} else {
		contact_no = contact_no.replace(/[^0-9\.]/g,'');
		if(contact_no.split('.').length>0) 
		contact_no = contact_no.replace(/\.+$/,"");
		$('#contact_no').val(contact_no);
	}
});	
$('#zipcode').keyup(function(){
	var zipcode = $('#zipcode').val();
	if(parseFloat(zipcode)<=0){
		$('#zipcode').val("");
	} else {
		zipcode = zipcode.replace(/[^0-9\.]/g,'');
		if(zipcode.split('.').length>0) 
		zipcode = zipcode.replace(/\.+$/,"");
		$('#zipcode').val(zipcode);
	}
}); 

</script>
<script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#profile_form").validate({
		rules: {
			first_name: {
				required: true,
				minlength:5
			},
			last_name: {
				required: true
			},
			street: {
				required: true
			},
			city: {
				required: true
			},
			state: {
				required: true
			},
			zipcode: {
				required: true,
				number :true,
				maxlegth: 7
			},
			country: {
				required: true
			},
			merchant_id: {
				required: true,
			},
			merchant_key: {
				required: true,
			},
			salt_id: {
				required: true,
			},
			payu_email: {
				required: true,
				email:true
			},
			contact_no: {
				required: true
				//minlength: 10
			}
		},
		messages: {
			first_name: {
				required: "Please enter your first name."
			},
			last_name: {
				required: "Please enter  your last name."
			},
			street: {
				required: "Please enter  your street name."
			},
			city: {
				required: "Please enter  your city name."
			},
			state: {
				required: "Please enter  your state name."
			},
			zipcode: {
				required: "Please Enter  your  zip code.",
				number : "Please Enter only number.",
				maxlegth: "Zipcode must be maximum of 7 digits."
			},
			country: {
				required: "Please select your country."
			},
			merchant_id: {
				required: "Please enter your Merchant Id."
			},
			merchant_key: {
				required: "Please enter your Merchant Key."
			},
			salt_id: {
				required: "Please enter your Salt Id."
			},
			payu_email: {
				required: "Please enter your Payu Email Address."
			},
			contact_no: {
				required: "Please enter your contact number."
				//minlength: "Contact number must be minimum 10 digits."
			}
		}
	});

	$("#account_form").validate({
		rules: {
			old_password: {
				required: true
			},
			new_password: {
				required: true,
				minlength: 6
			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo:'#new_password'
			}
		},
		messages: {
			old_password: {
				required: "Please enter your Correct old password."                    
			},
			 new_password: {
				required: "Please enter the password.",
				minlength: "Passwords must be minimum 6 characters."    
			},
			confirm_password: {
			   required: "Please confirm your password.",
				minlength:"Passwords must be minimum 6 characters.",
				equalTo : "Please enter the same password."
			}
		}		
	});

	/* form validation*/
	$("#bankpayment_form").validate({
		rules: {
			act_holder: {
				required: true
			},
			 bank_name: {
				required: true
			},
			bank_brch_name: {
				required: true					
			},
			act_no: {
				required: true
			},
			 ifsc_code: {
				required: true,
				minlength: 5
			},			
			con_pwd: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			act_holder: {
				required: "Please enter the account holder name."
			},
			 bank_name: {
			   required: "Please enter  your bank name."
			},
			 bank_brch_name: {
				required: "Please enter  your bank branch name."
			},
			  act_no: {
				required: "Please enter the account number."
			},
			ifsc_code: {
				required: "Please enter  IFSC code."
			},
			con_pwd: {
				required: "Please confirm your password.",
				minlength: "Passwords must be minimum 6 characters."
			}  
		}
	});
});
</script>
</body>
</html>
