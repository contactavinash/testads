<!DOCTYPE html>
<!-- saved from url=(0093)https://s3.amazonaws.com/tw-chat/attach/0c034f5733f16753cc2f6b1f90c5ed9d/change-password.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Offline Change Password</title>

<style>
.error {
  color:#ff0000 !important;
  font-weight:normal !important;
}
.required_field {
  color:#ff0000 !important;
}
</style>
<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>

</head>
<body>
<!--<style>
.error
{
  color:red;
}
</style>  -->
<?php $this->load->view('front/header_off'); ?>



<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
        <?php $this->load->view('front/sun_menu'); ?>

          <div class="col-md-9">
            
          
<div class="all clearfix">

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

          
          <?php //form begin
              $attributes = array('role'=>'form','name'=>'account_form','id'=>'account_form','method'=>'post','class'=>'form-horizontal tabular-form');
              echo form_open('offline_change_password',$attributes);
              ?>
        <div class="fieldset">
            <h4>Change Password</h4>
            <hr>
            <div class="form-list">
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Current Password <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="password" class="form-control" id="old_password" name="old_password"></div>
            
            </div>
            
             <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Change Password <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">  <input type="password" class="form-control" id="new_password" name="new_password"></div>
            
            </div>
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Confirm Password <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="password" name="confirm_password"  class="form-control" id="confirm_password"></div>
            
            </div>
            
            <div class="form-group  clearfix">
            
            <button class="btn btn-danger bor-rad-0" value="submit" name="save" type="submit">Save</button>
            </div>
            
            </div>
            
        </div>
             
            <?php echo form_close(); ?>
          <!-- Nav tabs -->
          
        </div>

          
                       
        </div>
     
  </div>
  
  </div>
</section>




<?php $this->load->view('front/sub_footer'); ?>
<?php $this->load->view('front/js_scripts'); ?>
<script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 





<script>


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
</script>




</body></html>
