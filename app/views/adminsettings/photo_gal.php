<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Photo Gallery</title>
	<?php $this->load->view('adminsettings/script'); ?>

    <link href="<?php echo base_url();?>assets/assets/dropzone/css/dropzone.css" rel="stylesheet"/>
     <link href="<?php echo base_url();?>assets/assets/dropzone/css/dropzone2.css" rel="stylesheet"/>
   
   <style>
    #sample_1 th
    {
	   text-align:center !important;
	}
	.dropzone1
	{
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0.03);
		border: 1px solid rgba(0, 0, 0, 0.03);
		border-radius: 3px;
		min-height: 360px;
		padding: 23px;
	}
	
   </style>
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
                   <!-- BEGIN THEME CUSTOMIZER-->
                   <!--<div id="theme-change" class="hidden-phone">
                       <i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-gray" data-style="gray"></span>
                                <span class="color-purple" data-style="purple"></span>
                                <span class="color-navy-blue" data-style="navy-blue"></span>
                            </span>
                        </span>
                   </div>-->
                   <!-- END THEME CUSTOMIZER-->
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <h3 class="page-title">
                   Photo Gallery
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/gallery','Photo Gallery'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <div class="widget" >
                        <div class="widget-title">
                           <h4><i class="icon-globe"></i>Photo Gallery</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>                    
                        </div>
                      <div class="widget-body form">
                          <form action="<?php echo base_url();?>gal_file/upload.php" class="dropzone" id="my-awesome-dropzone">
                          </form>
                      </div>
                      
                      <br>
                      
            </div>
            
              <div class="widget" >
                        <div class="widget-title">
                           <h4><i class="icon-globe"></i>Photo Gallery</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>                    
                        </div>
            <div class="widget-body dropzone2  formss" id="dropzoneajax" style="height:450px; overflow-y:scroll; width:100%;">
                      
                      
               </div>
                 </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   </div>
   </div>

   
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <?php $this->load->view('adminsettings/footer'); ?>
   
   
   
   <!-- END FOOTER -->
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>

    <script>
   $(document).ready(function(){ 

   callload(); // This will run on page load
	setInterval(function(){
		callload() // this will run after every 5 seconds
	}, 5000);
	
		

 	 });
	 function callload()
	 {
		  $.ajax({
          type: "POST",
          url: '<?php echo base_url();?>' + "view_gal.php", 
          success: 
              function(data){
               $('#dropzoneajax').html(data);
              }
           });// you have missed this bracket
	 }
	 function calfun(funid)
	 {
		 $("#selecturl"+funid).focus();
  		 $("#selecturl"+funid).select();
	 }
	 
	 function deletefile(filename,divid)
	 {
		 $('#delblo'+divid).hide();
		 $('#delloader'+divid).show();
		if(filename!='') 
		{
			$.ajax({
			  type:"get", //send it through get method
			  data: {'file':filename},
			  url: '<?php echo base_url();?>' + "del_gal.php", 
			  success: 
				  function(data){
				   $('#divhide'+divid).hide();
				     $('#hidediv1').show();
				   
				  }
			   });// you have missed this bracket	
		}
	 }
	 
	 
   </script>
   
  
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/uniform/jquery.uniform.min.js"></script>
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script src="<?php echo base_url(); ?>assets/assets/dropzone/dropzone.js"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
   <script>
      $(document).ready(function() {       
         // initiate layout and plugins
         App.init();
	//	alert('sasas');
		 });
   </script>
  
   
   
 
</body>
<!-- END BODY -->
</html>