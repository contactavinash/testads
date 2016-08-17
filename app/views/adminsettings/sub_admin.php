<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Sub Admin | <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>

   <link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   <?php $this->load->view('adminsettings/header'); ?>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
     <?php $this->load->view('adminsettings/sidebar'); ?>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                   <!-- END THEME CUSTOMIZER-->
                  <h3 class="page-title">
                     Sub Admin Details
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li>
							<?php echo anchor('adminsettings/sub_admin','Sub Admin'); ?>
							<span class="divider">&nbsp;</span>
                       </li>
					   <li>
							New Sub Admin<span class="divider-last">&nbsp;</span>
                       </li>
                   </ul>
               </div>
            </div>
			<a href="<?php echo base_url(); ?>/adminsettings/sub_admin/add"><button class="btn btn-success" style="float:right">Add user</button></a>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-file"></i> Sub Admin</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--<a href="javascript:;" class="icon-remove"></a>-->
                        </span>
                     </div><br>
					 <span> <span class="required_field"> &nbsp;&nbsp;&nbsp;*</span> marked fields are mandatory.</span><br>
					<?php
					if($page_view=="add"){
					?>
                     <div class="widget-body form">
					 <?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
						<button data-dismiss="alert" class="close">x</button>
						<strong>Error! </strong>'.$error.'</div>';
					} ?>					
					<?php
						$success = $this->session->flashdata('success');
						if($success!="") {
								echo '<div class="alert alert-success">
									<button data-dismiss="alert" class="close">x</button>
									<strong>Success! </strong>'.$success.'</div>';
						} ?>
                        <!-- BEGIN FORM-->
                        <!--<form action="#" class="form-horizontal">-->
						<?php
							$attribute = array('role'=>'form','method'=>'post','id'=>'change_pwd','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit'=>'return ValidateFileUpload();'); 
							echo form_open('adminsettings/sub_admin/add',$attribute);
						?>
						
                           <div class="control-group">
                              <label class="control-label">Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="name" id="name" required />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Email Address <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="email" class="span6" name="email" id="email" onblur="return checkAdmin(1);" required autocomplete="off" />
								<br><span id="email_result"></span>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Password <span class="required_field">*</span></label>
                              <div class="controls">
                               <input type="password" class="span6" name="password" id="password" required autocomplete="off" />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Profile Picture <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" class="" name="image" id="image" required accept="image/*" />
                               <br/><span id="error_file"></span>
							  </div>
							</div>
							
							<!--<div class="control-group">
                              <label class="control-label">Gender</label>
                              <div class="controls">
                              <select name="gender" class="span6">
								  <option value="1">Male</option>
								  <option value="0">Female</option>
							  </select>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Job Role <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="job_role" id="job_role" required />
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">City <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="city" id="city" required />
                              </div>
                           </div>-->
						   <div class="control-group">
                              <label class="control-label">Contact Number <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="number" id="number" required />
                              </div>
                           </div>
							
						   <div class="control-group">
                              <label class="control-label">Contact Information <span class="required_field">*</span></label>
                              <div class="controls">
                              <textarea name="content" class="span6" id="content" required></textarea>
                              </div>
                           </div>
                           
						   <div class="control-group">
                              <label class="control-label">Status</label>
                              <div class="controls">
								<select name="status" class="span6">
									<option value="1">Active</option>
									<option value="0">Deactive</option>
								</select>
                              </div>
                           </div>
						   
                           <!--<div class="control-group">
                              <label class="control-label">Permission <span class="required_field">*</span></label>
                              <div class="controls">
                                <?php 
									$i = 0;
									$admin_pages=$this->admin_model->get_admin_pages();
									if($admin_pages)
									{
										foreach($admin_pages as $admin_page)  
										{ if($i%2==0){ ?>
										<div class="">
										<?php } ?>
											<span class="span3"><input type="checkbox" class="check_b" value="<?php echo $admin_page->id; ?>" name="perm[]" /> <?php echo $admin_page->title; ?></span>

											<?php $i++; if($i%2==0){ ?>
										</div>
							    <?php } } } ?>
                              </div>
                           </div>-->
						    <div class="control-group">
						<label class="control-label">Permissions <span class="required_field">*</span></label>
						
						<?php
						$j=0;
											
						$admin_pages=$this->admin_model->get_admin_pages1();
									if($admin_pages)
									{
										
									foreach($admin_pages as $admin_page)
										{		
											?>
							<div class="controls" style="padding-left:0px;">
								<input type="checkbox" class="span1 spec_detail" name="main_access[]" id="spec_id_<?php echo $i; ?>" value="<?php echo $admin_page->id; ?>" /><b><?php echo $admin_page->title; ?></b>
							
							<div style="overflow-y:auto;height:100%;width:100%;">
							&nbsp;
							
							<?php $sub_admin_page=$this->admin_model->get_admin_pages1($admin_page->id);
							if($sub_admin_page)
							{
								foreach($sub_admin_page as $sub_admins_page)
														
							{
								
							?>
							<div class="row-fluid">
								<div style="padding-left:10px" class="span8">
								<div class="controls">
									<input type="checkbox" class="span3 spec_option spec_option_id_<?php echo $i; ?>" name="sub_access[]" id="spec_option_id_<?php echo $sub_admins_page->id; ?>" value="<?php echo $sub_admins_page->id; ?>"   /><?php echo $sub_admins_page->title; ?> 
								</div>
								</div>
								
								
							</div>	
							<?php 
							$sub_admin_page1=$this->admin_model->get_admin_pages2($sub_admins_page->id);
							if($sub_admin_page1)
							{
								foreach($sub_admin_page1 as $sub_admin_pages)
														
							{
								?><div class="row-fluid">
								<div style=" margin: 0 0 0 59px;
    padding-left: 10px;" class="span8">
								<div class="controls">
									<input type="checkbox" class="span3 spec_option spec_option_id_<?php echo $i; ?>" name="sub_access[]" id="spec_option_id_<?php echo $sub_admin_pages->id; ?>" value="<?php echo $sub_admin_pages->id; ?>"   /><?php echo $sub_admin_pages->title; ?> 
								</div>
								</div>
								
								
							</div>	<?php
								
							}
							}} } ?>
							</div>
						</div>
									<?php $j++;}} ?>
							
					</div>
						   
						   
                           <div class="form-actions">
                              <input type="submit" name="save" value="Submit" class="btn btn-success">
                           </div>
						   
						   <?php echo form_close(); ?>
                        <!--</form>-->
                        <!-- END FORM-->
                     </div>
					 <?php } ?>
					 <?php
						if($page_view=="edit"){
						?>
                     <div class="widget-body form">
					
                        <!-- BEGIN FORM-->
                        <!--<form action="#" class="form-horizontal">-->
						<?php
							$attribute = array('role'=>'form','name'=>'faq','method'=>'post','id'=>'update_form','class'=>'form-horizontal','enctype'=>'multipart/form-data','onSubmit'=>'return update_Upload();'); 
							echo form_open('adminsettings/sub_admin/edit',$attribute);
						?>
						   <div class="control-group">
                              <label class="control-label">Name <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" name="name" class="span6" id="name" value="<?php echo $sub_admin->admin_username; ?>" required />
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">Email Address <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="email" class="span6" name="email" id="email" value="<?php echo $sub_admin->admin_email; ?>" onblur="return checkAdmin(2);" required />
								<input type="hidden" id="hidden_email" value="<?php echo $sub_admin->admin_email; ?>" />
								<br><span id="email_result"></span>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Password <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="password" class="span6" name="password" id="password" required value="<?php echo $sub_admin->admin_password; ?>" />
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Profile Picture <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="file" name="update_image" id="update_image" accept="image/*" /><br>
								<span id="update_error_file"></span><br>
								<img src="<?php echo base_url();?>uploads/adminpro/<?php echo $sub_admin->admin_logo; ?>" width="100" height="100">
                              </div>
                           </div>
						   <!--<div class="control-group">
                              <label class="control-label">Gender</label>
                              <div class="controls">
                              <select name="gender" class="span6">
								  <option value="1" <?php if($sub_admin->gender == '1') echo 'selected'; ?>>Male</option>
								  <option value="0" <?php if($sub_admin->gender == '0') echo 'selected'; ?>>Female</option>
							  </select>
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Job Role <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="job_role" id="job_role" value="<?php echo $sub_admin->job_role; ?>" required />
                              </div>
                           </div>
						   <div class="control-group">
                              <label class="control-label">City <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="city" id="city" value="<?php echo $sub_admin->city; ?>" required />
                              </div>
                           </div>-->
                           <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $sub_admin->admin_id; ?>">
						   <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $sub_admin->admin_logo; ?>">
                           <div class="control-group">
                              <label class="control-label">Contact Number <span class="required_field">*</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="number" id="number" value="<?php echo $sub_admin->contact_number; ?>" required />
                              </div>
                           </div>
						    
						   <div class="control-group">
                              <label class="control-label">Contact Information <span class="required_field">*</span></label>
                              <div class="controls">
                              <textarea name="content" class="span6" id="content" required><?php echo $sub_admin->contact_info; ?></textarea>
                              </div>
                           </div>

						   <div class="control-group">
                              <label class="control-label">Status</label>
                              <div class="controls">
                              <select name="status" class="span6">
								  <option value="1" <?php if($sub_admin->status == '1') echo 'selected'; ?>>Active</option>
								  <option value="0" <?php if($sub_admin->status == '0') echo 'selected'; ?>>Deactive</option>
							  </select>
                              </div>
                           </div>
						   
						   <!-- <div class="control-group">
                              <label class="control-label">Permission <span class="required_field">*</span></label>
                              <div class="controls">
                                <?php 
									$i = 0;
									$admin_pages=$this->admin_model->get_admin_pages();
									if($admin_pages)
									{
										foreach($admin_pages as $admin_page)  
										{ if($i%2==0){ ?>
										<div class="">
										<?php } ?>
											<span class="span3"><input type="checkbox" class="check_b" value="<?php echo $admin_page->id; ?>" name="perm[]" <?php
								if(unserialize($sub_admin->permission)){
									if( in_array($admin_page->id, unserialize($sub_admin->permission)) )
										echo "checked=\"checked\"";
								} ?> /> <?php echo $admin_page->title; ?></span>

											<?php $i++; if($i%2==0){ ?>
										</div>
							    <?php } } } ?>
                              </div>
                           </div>-->
						 <div class="control-group">
						<label class="control-label">Permissions <span class="required_field">*</span></label>
						
						<?php
						$main_access = unserialize($sub_admin->main_access);
						$sub_access = unserialize($sub_admin->sub_access);
						
						$admin_pages=$this->admin_model->get_admin_pages1();
									if($admin_pages)
									{
										$i=0;
										foreach($admin_pages as $admin_page)
										{
											$t='';
											if(in_array($admin_page->id,$main_access))
											{
												$t='checked';
											}
											
											?>
							<div class="controls" style="padding-left:0px;">
								<input type="checkbox" class="span1 spec_detail" name="main_access[]" id="spec_id_<?php echo $i; ?>" value="<?php echo $admin_page->id; ?>" <?php echo $t; ?>/><b><?php echo $admin_page->title; ?></b>
							
							<div style="overflow-y:auto;height:100%;width:100%;">
							&nbsp;
							
							<?php $sub_admin_page=$this->admin_model->get_admin_pages1($admin_page->id);
							if($sub_admin_page)
							{
								foreach($sub_admin_page as $sub_admins_page)
														
							{
								$t1='';
											if(in_array($sub_admins_page->id,$sub_access))
											{
												$t1='checked';
											}
							?>
							<div class="row-fluid">
								<div style="padding-left:10px" class="span8">
								<div class="controls">
									<input type="checkbox" class="span3 spec_option spec_option_id_<?php echo $i; ?>" name="sub_access[]" id="spec_option_id_<?php echo $sub_admins_page->id; ?>" value="<?php echo $sub_admins_page->id; ?>" <?php echo $t1; ?>   /><?php echo $sub_admins_page->title; ?> 
								</div>
								</div>
								
								
							</div>	
							<?php 
							$sub_admin_page1=$this->admin_model->get_admin_pages2($sub_admins_page->id);
							if($sub_admin_page1)
							{
								foreach($sub_admin_page1 as $sub_admin_pages)
														
							{$t2='';
											if(in_array($sub_admin_pages->id,$sub_access))
											{
												$t2='checked';
											}
							?>
							<div class="row-fluid">
								<div style=" margin: 0 0 0 59px;
    padding-left: 10px;" class="span8">
								<div class="controls">
									<input type="checkbox" class="span3 spec_option spec_option_id_<?php echo $i; ?>" name="sub_access[]" id="spec_option_id_<?php echo $sub_admin_pages->id; ?>" value="<?php echo $sub_admin_pages->id; ?>" <?php echo $t2; ?>   /><?php echo $sub_admin_pages->title; ?> 
								</div>
								</div>
								
								
							</div>	<?php
							
							}
							} }
							} ?>
							</div>
						</div>
									<?php $i++;}} ?>
							
					</div>
                           <div class="form-actions">
                              <input type="submit" name="save" value="Save Changes" class="btn btn-success">
                           </div>
						   <?php echo form_close(); ?>
                        <!--</form>-->
                        <!-- END FORM-->
                     </div>
					 <?php } ?>
					 <?php
				if($page_view=='list'){
			?>
				
			<div class="widget-body">
						 <?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-error">
						<button data-dismiss="alert" class="close">x</button>
						<strong>Error! </strong>'.$error.'</div>';
					} ?>
					<?php
						$success = $this->session->flashdata('success');
						if($success!="") {
								echo '<div class="alert alert-success">
										<button data-dismiss="alert" class="close">x</button>
										<strong>Success! </strong>'.$success.'</div>';			
						} ?>
                        <form id="form2" name="form2" method="post" action="">
						 <?php 
						 
						 if($sub_admins){ ?>		
						   <table class="table table-striped table-bordered" id="sample_1">
                           
							<thead>
                                <tr>
                                    <th>#</th>
                                    <th><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th class="hidden-phone">Name</th>
                                    <th class="hidden-phone">Email</th>
									<th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">Edit</th>
                                    <th class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							
							foreach($sub_admins as $sub_admin){
							$k++;
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>
                                     <td><input type="checkbox" class="check_b" name="chkbox[<?php echo $sub_admin->admin_id;?>]" /></td>	
                                    <td><?php echo $sub_admin->admin_username; ?></td>
                                    <td><?php echo $sub_admin->admin_email; ?></td>
									<td>
									<?php
									$status = $sub_admin->status;
										if($status=='1'){
											echo 'Activated';
										}else{
											echo 'De-activated';
										}
									?>
									</td>
                                    <td class="hidden-phone">
									<?php echo anchor('adminsettings/sub_admin/edit/'.$sub_admin->admin_id,'<i class="icon-pencil"></i>'); ?>
									</td>
                                    <td class="center hidden-phone">
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this user detail?');");		
									echo anchor('adminsettings/sub_admin/delete/'.$sub_admin->admin_id,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
						<?php }else{ ?>
							<table class="table table-striped table-bordered" id="">
                           
							<thead>
                                <tr>
                                    <th>#</th>
                                    <th><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th class="hidden-phone">Name</th>
                                    <th class="hidden-phone">Email</th>
									<th class="hidden-phone">Status</th>
                                    <th class="hidden-phone">Edit</th>
                                    <th class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
								<tr><td colspan="8">
									<center><strong>No users found.</strong></center>
								</td></tr>
							</tbody>
						</table>		
						<?php } ?>
						<br>	
                         <input type="hidden" value="hidd" name="hidd">
							<input id="GoUpdate" class="btn btn-warning" type="submit" name="GoUpdate" value="Delete Users">
                        </form>
                        </div>
                    </div>
			<?php } ?>
                  </div>
                  <!-- END SAMPLE FORM widget-->
               </div>
            </div>
			
			
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
  <?php $this->load->view('adminsettings/footer'); ?>
   <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js"></script>    
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.js"></script>
    <?php $this->load->view('adminsettings/footer_script'); ?>
<script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
      });
	var dateToday = new Date();
	jQuery('#exp_date').datepicker({
		startDate: 0
	});

function ValidateFileUpload() {
	var avatar = $("#image").val();
	var fileExtension = ['jpeg','jpg','png','gif','bmp'];
	if ($.inArray(avatar.split('.').pop().toLowerCase(), fileExtension) == -1) {
		$('#error_file').css('color','red').text('Invalid file format.');
		return false;
	}else{
		$('#error_file').css('color','red').text('');
		return true;
	}
}

<?php if($page_view=="edit"){ ?>
//update
function update_Upload() {
	var avatar = $("#update_image").val();
	var fileExtension = ['jpeg','jpg','png','gif','bmp'];
	if(avatar!=''){
		if ($.inArray(avatar.split('.').pop().toLowerCase(), fileExtension) == -1) {
			$('#update_error_file').css('color','red').text('Invalid file format.');
			return false;
		}
	}
}
<?php } ?>

<?php if($page_view=="add"){ ?>
// check admin exists on add..
function checkAdmin(val){
	var email = $('#email').val();
	$('#email_result').html('');
	if(email!=""){
		$.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>adminsettings/sub_admin/check",
			data:{"email":email},
			beforeSend:function(){
				$('#email').after('<img src="<?php echo base_url(); ?>uploads/loading.gif" style="width:25px !important;" class="loading">');
			},
			complete:function(){
				$('.loading').remove();
			},
			success:function(msg){
				if(msg==0){
					$('#email_result').css('color','#f00').html('This email is already exists.');
					$('#email').val('');
				} else {
					$('#email_result').css('color','#22c022').html('This email is available.');
				}
			}
		});
	}
}
<?php } ?>

<?php if($page_view=="edit"){ ?>
// check admin exists on add..
function checkAdmin(val){
	var email = $('#email').val();
	var old_email = $('#hidden_email').val();
	
	$('#email_result').html('');
	if(email != old_email ){
		$.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>adminsettings/sub_admin/check",
			data:{"email":email},
			beforeSend:function(){
				$('#email').after('<img src="<?php echo base_url(); ?>uploads/loading.gif" style="width:25px !important;" class="loading">');
			},
			complete:function(){
				$('.loading').remove();
			},
			success:function(msg){
				if(msg==0){
					$('#email_result').css('color','#f00').html('This email is already exists.');
					$('#email').val('');
				} else {
					$('#email_result').css('color','#22c022').html('This email is available.');
				}
			}
		});
	}
}
<?php } ?>

jQuery('#number').keyup(function(){
	var contact_number = $('#number').val();
	if(parseFloat(contact_number)<=0){
		$('#number').val("");
	} else {
		contact_number = contact_number.replace(/[^0-9\.]/g,'');
		if(contact_number.split('.').length>0) 
		contact_number = contact_number.replace(/\.+$/,"");
		$('#number').val(contact_number);
	}
});

function confirmDelete(m)  // Confirm before delete cms..
{
	if(!confirm(m))
	{
		return false;
	}
	else
	{
		return true;
	}
}
	$(document).ready(function() {
		$(".check_b").attr("style", "opacity: 1;");
      });
	  function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
</script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>