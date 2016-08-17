<?php
if($this->uri->segment(3)){
	$uniq_id = $this->uri->segment(3);
	$this->session->set_userdata('reg_uniq_id',$uniq_id);
} else if($this->session->userdata('reg_uniq_id')){
	$uniq_id = $this->session->userdata('reg_uniq_id');
} else {
	$uniq_id = '';
}
?>
<?php
	$redirect_urlstring =  uri_string();
	if($redirect_urlstring=="")
	{
	  $redirect_urlstring = 'cashback/index';
	}
	$redirect_endcede = insep_encode($redirect_urlstring);

?>
				
				
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Offline Register | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
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
<?php $this->load->view('front/header_off');?>

<section class="login-sec">

<div class="container">
<h3 class="text-center text-uppercase">Create An Account</h3>
<div class="bor bg-red"></div>
    <div class="row">
	<div class="login-b content">
   

<div class="row ">
<div class="col-md-9 col-sm-9 center-block ftn padding-top-20">
<!-- <div class="row">
<div class="col-md-6 col-sm-6">
<div class="faceb">
<center>
<a href="<?php echo base_url();?>HAuth/register/Facebook/<?php echo $redirect_endcede;?>"><span class="faceb2"><i class="fa fa-facebook"></i>Log In with Facebook</span></a></center>

</div>
<br>
</div>
<div class="col-md-6 col-sm-6">
<div class="faceb">
<center><a href="<?php echo base_url();?>HAuth/register/Google/<?php echo $redirect_endcede;?>"><span class="faceb4"><i class="fa fa-google-plus"></i>Log In with Google Plus</span></a></center>
</div>
<br>
</div>

</div> -->
           




</div>
</div>



<div class="row">
<div class="col-md-6  ftn center-block padding-top-20">
    
          
         <?php $error = $this->session->flashdata('error');
			 if($error!="") {
				echo '<div class="alert alert-danger">
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
			$atrtibute = array('role'=>'form','name'=>'regform','id'=>'regform','method'=>'post','enctype'=>'multipart/form-data','class'=>'j-forms');
			echo form_open('cashback/offline_register',$atrtibute);
			
			
		?>
        
        <div class="fieldset">
            <h4>Personal Information</h4>
            <hr>
            <div class="form-list">
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">First Name <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="text" id="first_name"  onkeyup="this.value=this.value.replace(/[^a-zA-Z. ]/g,'');"  name="first_name"  maxlength="255" class="input-text required-entry form-control" value="<?php if($reg_val['f_name']){echo $reg_val['f_name'];} ?>" />           </div>
            
            </div>
            
             <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Last Name <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="text" id="last_name"  onkeyup="this.value=this.value.replace(/[^a-zA-Z. ]/g,'');"  name="last_name"  maxlength="255" class="input-text required-entry form-control" value="<?php if($reg_val['lname']){echo $reg_val['lname'];} ?>" /></div>
            
            </div>

             <div class="form-group  clearfix">
            
            <label class="col-md-4 ">User Name <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="text" id="user_name"  onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9. ]/g,'');"  name="user_name"  maxlength="255" class="input-text required-entry form-control" value="<?php if($reg_val['uname']){echo $reg_val['uname'];} ?>" /></div>
            
            </div>

           
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Email Address <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
            	<input type="email" id="user_email" name="user_email" onchange="return check_email();"  maxlength="255" class="input-text required-entry form-control" value="<?php if($reg_val['email']){echo $reg_val['email'];} ?>" />
            	<span id="unique_name_error"></span>
            </div>
            
            </div>

             <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Mobile Number <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
            	<input type="text" id="contact" name="contact"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php if($reg_val['phone']){echo $reg_val['phone'];} ?>"   class="input-text required-entry form-control"  /></div>
            
            </div>


             <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Buisness Address  </label>
            
            <div class="col-md-8">
            	<input type="text" id="buisness_address" name="buisness_address"   class="input-text required-entry form-control"  value="<?php if($reg_val['badd']){echo $reg_val['badd'];} ?>"/></div>
            
            </div>

            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Document Updation<em class="clr-red">*</em> </label>
            
	            <div class="col-md-8">
	            	<input type="file" id="document_upload" name="document_upload"  maxlength="" class="input-text required-entry "  />
	            	<!-- <p id="display_error_img"></p> -->
	            	<span  style="font-size:13px;">Note : Upload gif,jpg,jpeg,doc,docx Files</span>
	            </div>
            
            </div>



            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Country <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
           

            <select id="country" name="country"  onChange="fetch_first_level(this.value,'main')" class="input-text required-entry form-control"> 
            	<option value="">Select</option>
            	<?php foreach($country as $con){ ?>
            	<option value="<?php echo $con->id; ?>"><?php echo $con->country_name; ?></option>
            	<?php } ?>
            </select>
            </div>
            
            </div>


            <div class="form-group  clearfix sub_category" style="display:none">
            
            <label class="col-md-4 ">State<em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
            	<select id="tags" name="state" onChange="get_state(this.value,'sub')" class="input-text required-entry form-control"> 
            
            </select>
            
            </div>
        </div>

            <div class="form-group  clearfix child_category" style="display:none">
            
            <label class="col-md-4 ">City<em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
            	<select id="child" name="city" class="input-text required-entry form-control"> 
            	<!-- <option value="">Select</option>
            	<?php foreach($country as $con){ ?>
            	<option value="<?php echo $con->id; ?>"><?php echo $con->country_name; ?></option>
            	<?php } ?> -->
            </select>
            
            </div>


            
           <!-- <div class="form-group  clearfix">
            
            <div class="checkbox col-md-12">  <label> <input id="agreeterms" type="checkbox" data-md-icheck="" name="agreeterms">
            <span class="clearfix">
            I Agree to the <a target="_blank" href="<?php echo base_url(); ?>cashback/cms/terms-and-conditions" >Terms & Conditions</a></span>
            
             </label></div>
            </div>
            -->


            </div>
            
        </div>
            <div class="fieldset">
            <h4 class="legend">Login Information</h4>
            <hr>
            <div class="form-list">
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Password <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
            <input type="password" id="user_pwd" value="<?php echo set_value("user_pwd"); ?>" name="user_pwd"  maxlength="255" class="input-text required-entry form-control"  /></div>
            </div>
            
             <div class="form-group  clearfix">
            
            <label class="col-md-4 "> Confirm Password <em class="clr-red">*</em> </label>
            
            <div class="col-md-8"><input type="password" value="<?php echo set_value("pwd_confirm"); ?>" id="pwd_confirm" name="pwd_confirm" maxlength="255" class="input-text required-entry form-control"  /></div>
            
            </div>
            
           
           
        </div>
        <div class="buttons-set">
        
        <div class="">
        
        <div class="col-md-12">
            <p class="required">* Required Fields</p>
           
       
        <input type="hidden" name="uni_id" value="<?php echo $uniq_id; ?>">
			<input type="submit" name="register" value="Create an Account" class="btn btn-danger bor-rad-0 ">
           </div></div>
            
        
        </div>
        </div>
              <?php  echo form_close();?>
        
      </div>
</div>



</div>
    </div>
</div>
</section>

<?php $this->load->view('front/sub_footer');

	$this->load->view('front/site_intro');	
?>
<?php $this->load->view('front/js_scripts'); ?>
<script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script> 
<script type="text/javascript">
/* form validation*/

//check email for  registration
function check_email()
{
	$('#unique_name_error').html('');
	var email = $('#user_email').val();
	// alert(email);
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
	{
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>cashback/offline_check_email',
			data:{'email':email},
			 success:function(result){
				if(result.trim()==1)
				{
					$("#unique_name_error").css('color','#29BAB0');
					
					 $("#unique_name_error").html('available.');
				}
				else
				{
					$("#unique_name_error").css('color','#ff0000');
					$("#unique_name_error").html('This email is already exists.');	
					$('#user_email').val('');
				}
			}
		});
	}
	return false;


}

function fetch_first_level(id,type){
  // alert('dfjdh');
  if(id!=''){
    $.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/get_city',
      data:{'cat_id':id},
      success:function(html){
        var data = html.trim();
        if(data != 'false'){
          if(type == 'main'){
            // alert(html);
            $('.sub_category').show();
            $("#tags").html(data);
            //$("#tags").html(data).trigger('liszt:updated');
          }
          if(type == 'sub'){
            // alert(html);
            $('.child_category').show();
            $("#child").html(data);
            //$("#tags").html(data).trigger('liszt:updated');
          }
        }
      }
    });
  } 
}

// get_state
function get_state(id,type){
  // alert('dfjdh');
  if(id!=''){
    $.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/get_state',
      data:{'cat_id':id},
      success:function(html){
        var data = html.trim();
        if(data != 'false'){
          if(type == 'sub'){
            // alert(html);
            $('.child_category').show();
            $("#child").html(data);
            //$("#tags").html(data).trigger('liszt:updated');
          }
          /*if(type == 'sub'){
            // alert(html);
            $('.child_category').show();
            $("#child").html(data);
            //$("#tags").html(data).trigger('liszt:updated');
          }*/
        }
      }
    });
  } 
}


</script>
<script>
function isNumberKey(evt)
{
	// alert('fghfjkg');
	// alert(evt);
         var charCode = (evt.which) ? evt.which : event.keyCode;
         // alert(charCode);
      if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))  
       {
       		// alert(charCode);
          return false;
       }
       else
       {  
        // alert('dfgdh');
           return true; 
      }
}

$(document).ready(function() {
	// alert('fgjfkjg');
	$("#regform").validate({
		// alert('fgjfkjg');
		rules: {

			first_name: {
				required: true
			},
			last_name: {
				required: true
			},
			user_email: {
				required: true,
				email :true
			},
			user_pwd: {
				required: true,
				minlength: 6
			},
			store_name: {
				required: true,
			},
			pwd_confirm: {
				required: true,
				minlength: 6,
				equalTo:'#user_pwd'
			},
			contact: {
			required: true,
			//minlength: 10,
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
			
			document_upload: {
				required: true,
				
			},
			user_name: {
				required: true,
				 //minlength: 6
			},
			zipcode: {
				required: true,
				 minlength: 6
			},
			country: {
				required: true
			},
			agreeterms :{
				required: true
			},			
			chk :{
				required: true
			}
		},
		messages: {
			first_name: {
				required: "Please enter your first name."                    
			},
			last_name: {
				required: "Please enter  your last name."
				
			},
			user_email: {
				required: "Please enter  your valid Email id."
				
			},
			store_name: {
				required: "Please enter  your Store Details."
				
			},
			user_pwd: {
				required: "Please enter the password.",
				minlength: "Passwords must be minimum 6 characters."    
			},
			pwd_confirm: {
				required: "Please confirm your password.",
				minlength: "Passwords must be minimum 6 characters.",
				equalTo : "Please enter the same password."
			},
			document_upload: {
				required: "Please enter  your street name.",
				
			},
			street: {
				required: "Please enter  your street name."
			},
			city: {
				required: "Please enter  your city name."
			},
			user_name: {
				required: "Please enter  your state name."
			},
			state: {
				required: "Please enter  your state name."
			},
			zipcode: {
				required: "Please Enter  your  zip code.",
				minlength: "Zipcode must be minimum 6 digits."
			},
			country: {
				required: "Please select your country."
			},
			contact: {
				required: "Please enter your contact number.",
				
			},
			agreeterms: {
				required: "Please accept our policy."
			},			
			chk :{
				required: "Please fill the answer."
			}		
		}
	});
});
</script>
