<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<?php $admin_details = $this->admin_model->get_admindetails(); ?>
<?php
$opt = '';
$page_dinamic = 'product_categories';
$titlong = 'Product Categories';
  $titless = $titlong;
  $opt = $category_set_id;
  if($category_name_title!='')
  {
	 $titlong = 'Product Sub Categories - '.$category_name_title;
	 $titless = $titlong; 
  }
?>
<title><?php echo $titless;?> | <?php echo $admin_details->site_name; ?> Admin</title>
<?php $this->load->view('adminsettings/script'); ?>
<link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" />
<style>
    div.selector, div.selector span, div.checker span, div.radio span, div.uploader, div.uploader span.action, div.button, div.button span
    {
        background-image:none
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
                  <h3 class="page-title">
                  <?php
					echo $titlong;
				  ?>
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/product_categories','Product Categories'); ?>
							
					<?php
                    if($titless!='Product Categories')
                    {
                    ?>
                            <span class="divider">&nbsp;</span>
                               </li>
                        	<li><?php echo $titless;?><span class="divider-last">&nbsp;</span>
					   		</li>
                     <?php
					}
					else
					{
						?>
                       <span class="divider-last">&nbsp;</span>
			        </li>
                        <?php
					}
					?>
                   </ul>
                   
                   <span style="float:right">
                     <?php echo anchor('adminsettings/product_categories/'.$opt,'<button style="" class="btn btn-success">View all '.$titless.'</button>'); ?> 
                 	<?php echo anchor('adminsettings/add_product_categories/'.$opt,'<button style="" class="btn btn-success">Add '.$titless.'</button>'); ?> 
                    </span>                  
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> <?php echo $titlong;?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
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
                        <form id="form2" action="" method="post" name="form2">

                        
                            <table class="table table-striped table-bordered" id="<?php if($product_categories){echo 'sample_1';} ?>">
                            <thead>
                                <tr>
                                    <th style="">#</th>
                                     <th style=""><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th style="">Category Name</th>
                                    <?php 
									if($category_level<'2')
									{
									?>
                                   	 <th style="">View Sub Categories</th>
                                     <th style="" class="hidden-phone">No.of Sub categories</th>
                                     <?php 
									}
									?>
                                    <th style="" class="hidden-phone">Filter</th>

                                   <!--  <th style="" class="hidden-phone">What we get</th>
									                  <th style="" class="hidden-phone">What we given</th> -->
                                    <th style="" class="hidden-phone">Sort Order</th>
                                    <th style="" class="hidden-phone">Status</th>
                                    <th style="" class="hidden-phone">Edit</th>
                                    <th style="" class="hidden-phone">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$k=0;
							// get maximum category order..
							$max_order = 0;
							$maximum_order = $this->admin_model->get_max_from_table('product_categories','sort_order');
							if($maximum_order->sort_order!='')
							{
									$max_order = $maximum_order->sort_order;
							}
							if($product_categories){
								$s=1;
							foreach($product_categories as $product_category)
							{							
								$k++;
								$category_id = $product_category->cate_id;
								$tot =  $this->admin_model->count_sub_cate($category_id);
							
							?>
                                <tr class="odd gradeX">
                                    <td><?php echo $k; ?></td>
                                    <td><input type="checkbox"  class="check_b" name="chkbox[<?php echo $category_id;?>]" /></td>
                                    <td><?php echo $product_category->category_name; ?></td>
                                    
                                    <?php
									if($category_level<'2')
									{
									?>
                                        <td align="center" style="text-align:center">
                                        <?php
                                        $confirms = array("class"=>"btn btn-success");		
                                        echo anchor('adminsettings/product_categories/'.$opt.'/sub_'.$category_id,'Sub categories',$confirms); ?>
                                         </td>
                                          <td><center><?php echo $tot->cout; ?></center></td>
                                    <?php
									}
									?>
                                    <?php
									if($product_category->sort_order!='')
									{
										$sort_order =$product_category->sort_order;
									}
									else
									{
										$sort_order=0;
									}
									?>

                   <td align="center" style="text-align:center">
                    <?php
                    $confirms = array("class"=>"btn btn-success");    
                    echo anchor('adminsettings/Add_filter_categories/sub_'.$category_id,'Filters',$confirms); ?>
                </td>

									<!-- <td><?php echo $product_category->commision_add." %"; ?></td>
									<td><?php echo $product_category->commision_get." %"; ?></td> -->
                                    <td><input class="textbox" type="number"  size="4" value="<?php echo $sort_order;?>" name="sort_arr[<?php echo $category_id;?>]"></td>
									<td  style="text-align:center">
									<?php
									$status = $product_category->category_status;
										if($status=='1'){
											echo 'Activated';
										}else{
											echo 'De-activated';
										}
									?>
									</td>
                                    <td  style="text-align:center" class="hidden-phone">
									<?php echo anchor('adminsettings/edit_product_category/'.$product_category->category_url.'_'.$product_category->cate_id.'/'.$opt,'<i class="icon-pencil"></i>'); ?>
									</td>
                                    <td  style="text-align:center" class="center hidden-phone">
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this category detail?');");		
									echo anchor('adminsettings/delete_product_category/'.$product_category->cate_id.'/'.$opt,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php $s++;} } else { ?>
								<tr><td colspan="9">
									<center><strong>No <?php echo $titless;?> found.</strong></center>
								</td></tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="hidd" value="hidd">
                        <input id="GoUpdate" class="btn btn-warning" type="submit" value="Update <?php echo $titless;?>" name="GoUpdate">
                        </form>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>
            <!-- END ADVANCED TABLE widget-->
            <!-- END PAGE CONTENT-->
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
   <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>   
   <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
   <script>
      jQuery(document).ready(function() {
         // initiate layout and plugins
          App.init();

          });

       </script><?php $this->load->view('adminsettings/footer_script'); ?>
<script type="text/javascript">
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
</script>
 <script>
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
 
 $(document).ready(function() {
    $(".textbox").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
	
   </script>
</body>
<!-- END BODY -->
</html>