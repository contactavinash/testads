<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
</head>

<body>
<?php $this->load->view('front/header');?>


<section class="inner-page-sec clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="account-login">
         
			<?php
			 //begin form
				$attribute = array('role'=>'form','name'=>'login_form','id'=>'login_form','method'=>'post','class'=>'j-forms');				
				echo form_open('chk_invalid',$attribute);
				
			?>
			<?php if(isset($invalid_login)) {
				// echo "<i><font color='#CC0000'>".$invalid_login."</font></i>";
				echo '<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">x</button>
						<strong>'.$invalid_login.' </strong></div>';			
				} ?>
				<?php
					$success = $this->session->flashdata('success');
					if($success!="") {
					echo '<div class="alert alert-success">
						<button data-dismiss="alert" class="close">x</button>
						<strong>'.$success.'</strong></div>';
		   } ?>
            <input type="hidden" value="CL5r0ynl0anhKx4F" name="form_key">
            <div class="row">
            
              <div class="">

                    <div class="row">
                    <div class="fn center-block text-center modal-header-logo">
                      <img class="img-center" src="<?php echo base_url()."uploads/adminpro/".$logo;?>" alt="logo" style="height:50px;width:285px;align:center;">
                    </div>
                    </div>
                    
                  
                   
                    <div class="row">
                                    <div class="center-block ftn padding-top-20">
                                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="faceb">
                    
                    <center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
                    
                    </div>
                    <br>
                    </div>
                    
                    </div>
                               
                    
                    
                    
                    
                    </div>
                    </div>
                    
                    
                    <br>
                    
                    
                    <div class="row">
                          <center><span id="userstatus_ss1" style="color:red; font-weight:bold;"> </span></center>
                    <div class="col-md-8 col-sm-8 ftn center-block">
                  <?php
       //begin form
        $attribute = array('role'=>'form','name'=>'login_form_Without','id'=>'login_form_Without1','method'=>'post','class'=>'j-forms','onSubmit'=>'return setupajax_login_Without1();');       
        echo form_open('chk_invalid',$attribute);
        
      ?>
      <?php 
           $error = $this->session->flashdata('error');
           if($error!="") {
            echo '<div class="alert alert-error">
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
            
                      <div class="form-group">
                        <input type="email" placeholder="Email Address" name="email" class="form-control" title="Email Address" required id="email">
                      </div>
                      <div class="form-group">
                      <input type="password" title="Password" placeholder="Password" required id="pass" class="form-control validate-password" name="pwd">

                      </div>
                      
                      <div class="row">
                      <!--<div class="col-md-8 col-sm-8">
                       <div class="check-b">
                      <input type="checkbox" name="cc" id="c1">
                    <label for="c1"><span></span>Remember Me</label>
                     </div>
                     </div>-->
                      <div class="col-md-12 col-sm-4 padding-top-5"><a href="<?php echo base_url()?>forgetpassword" class="launch-modal3">Reset password?</a></div>
                      </div>
                        <br>
                        <p class="text-center padding-top-10 mar-top20">Don't have an account? <a href="<?php echo base_url(); ?>register">Sign Up</a></p>
                   
                      <br>
                    <div class="row">
                    <div class="col-md-12">
                     <center> 
                     <input type="hidden" name="signin" value="signin" />
            
                    <input type="submit" class="btn btn-danger bor-rad-0" name="signin1" title="Login" id="signin1"  value="Login">


</center>
                      </div>
                     <div class="col-md-6 padding-top-10"> </div>
                      </div>
            <div class="row">
                    </div>
          

                    
                    
                    <?php     
      //end form
      echo form_close();
      ?>
                    </div>
                    </div>
                    
                    
                    
                    </div>              
           </div>
            
          <?php			
			//end form
			echo form_close();
			?>
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

<?php $this->load->view('front/js_scripts'); ?>
</body>
</html>
