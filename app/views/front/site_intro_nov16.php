<?php if($this->session->userdata('user_id')==''){ ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Login or Create an Account</h4>
      </div>
      <div class="modal-body">
      
      <div class="row">
      
      <div class="col-md-6">
     
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
            <?php  $redirect_urlstring =  uri_string();
				if($redirect_urlstring=="")
				{
					$redirect_urlstring = 'cashback/index';
				}
				$redirect_endcede = insep_encode($redirect_urlstring);
				?>
				
            <ul class="list-inline clearfix uk-margin-bottom">
				<li><a class="btn btn-social btn-facebook btn-sm" href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><i class="fa fa-facebook"></i> Sign in with Facebook </a></li>
				<li><a class="btn btn-social btn-google-plus btn-sm" href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><i class="fa fa-google-plus"></i> Sign in with Google+ </a></li>
			</ul>
            
            <hr>
				 <?php
					 //begin form
						$attribute = array('role'=>'form','name'=>'login_form','id'=>'loginform', 'onSubmit'=>'return setupajax_login();', 'autocomplete'=>'off','method'=>'post');
						echo form_open('cashback/chk_invalid',$attribute);
					?>
					<center><span id="userstatus" style="color:red; font-weight:bold;"> </span></center>
                    <div class="uk-form-row">
                        <label for="login_username">Email</label>
                        <input class="md-input" type="text" required id="emailid" name="email" autocomplete="off" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="pwd" autocomplete="off" required />
                    </div><input id="signin" type="hidden" value="signin" name="signin">
                    <div class="uk-margin-medium-top">
						<input type="submit" class="md-btn md-btn-danger md-btn-block" name="sign_in" id="signin" value="Sign In">
                    </div>
                    <div class="uk-margin-top">
                        <a href="<?php echo base_url(); ?>cashback/forgetpassword" id="" class="uk-float-right">Forgot Password</a>
                        <span class="icheck-inline pull-right">
                            <input type="checkbox" name="rememberme" id="RememberMe" data-md-icheck />
                            <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                        </span>
                    </div>
                </form>
            </div>
      </div>
      </div>
      
       <div class="col-md-6">
       
       <div class="new-user">
              <div class="content">
                <div class="section-line">
                  <h4 class="text-capitalize">Signup to Join one of highest paying Indian Cashback and coupons website</h4>
                  <ul class="links">
                    <li><a> Join Free</a></li>
                    <li><a> Save Money on online shopping</a></li>
                    <li> <a> Cashback is paid over and above all discounts, coupon used/offered by store.</a></li>
                    <li><a>  Earn 15% of referral cashback for lifetime.</a></li>
                  </ul>
                  
                  <div class="buttons-set">
				   <a href="<?php echo base_url(); ?>cashback/register"> <button type="button" title="Create an account" class="md-btn md-btn-danger uk-margin-top" style="text-transform:none;"> SIGNUP and START EARNING </button></a>
				  </div>
              
              <hr>
              
              <h4 class="clr-blu">Save Rupiya on all leading online stores -<small> Get cashback over and above offers and discount from us. </small></h4>
              
              <ul class="list-inline clearfix mar40">
              <img src="<?php echo base_url(); ?>front/img/amazon.png" alt="" width="0" height="0" style="display: block !important;"/>
              <li><img width="70" class="img-thumbnail mar-bot" src="<?php echo base_url(); ?>front/img/amazon-1.png"></li>
              
              <li><img width="70" class="img-thumbnail mar-bot" src="<?php echo base_url(); ?>front/img/store-2.jpg"></li>
              
              <li><img width="70" class="img-thumbnail mar-bot" src="<?php echo base_url(); ?>front/img/snapdeal.png"></li>
              
              <li><img width="70" class="img-thumbnail mar-bot" src="<?php echo base_url(); ?>front/img/store-4.jpg"></li>
              
              <li><img width="70" class="img-thumbnail mar-bot" src="<?php echo base_url(); ?>front/img/store-1.jpg"></li>
              </ul>
                </div>
              </div>
            </div>
       </div>
       </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>