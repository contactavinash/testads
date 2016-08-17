<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <?php $admin_details = $this->admin_model->get_admindetails(); ?>
  <title>Products | <?php echo $admin_details->site_name; ?> Admin</title>
	<?php $this->load->view('adminsettings/script'); ?>

   <link href="<?php echo base_url(); ?>assets/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/uniform/css/uniform.default.css" /><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/chosen-bootstrap/chosen/chosen.css" />
   <link href="<?php echo base_url(); ?>assets/css/jplist.min.css" rel="stylesheet" />
   <style>
   div.selector, div.selector span, div.checker span, div.radio span, div.uploader, div.uploader span.action, div.button, div.button span
   {
    background-image:none}
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
                    Products
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <?php echo anchor('adminsettings/dashboard','<i class="icon-home"></i>'); ?>
						   <span class="divider">&nbsp;</span>
                       </li>
                       <li><?php echo anchor('adminsettings/products','Products'); ?>
							<span class="divider-last">&nbsp;</span>
					   </li>
                   </ul>
				   <br>
     <div class="clearfix"></div>
<span style="font-size: 15px; color: rgb(0, 0, 0); float: left; line-height: 29px; margin-right: 10px;">Filters :</span>
				   
							<select name="categories" onchange="return change_categories(this.value);">
							<option value=''>choose categories</option>
							<?php if($main_category)
foreach($main_category as $cat)
{					   ?>
				   <option value="<?php echo $cat->cate_id;?>"><?php echo $cat->category_name;?></option>
						
<?php } ?>
							</select>
							
							<select  id="tags" onChange="return get_change_cate(this.value);" style="display:none;">
									
								</select>
						
                  
                 
                 <?php echo anchor('adminsettings/add_product','<button style="float:right" class="btn btn-success">Add Product</button>'); ?> 
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
                            <h4><i class="icon-reorder"></i> Products</h4>
							
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
						
						<div id="demo" class="jplist">
						<div class="panel jplist-panel">
                        <input  type="text" value="" placeholder="Filter by Title"  class="form-control"  id="search_key"/><input type="button" value="Search" class="btn btn-success" onclick="return get_serach_value();"></div>
						<div class="box jplist-no-results text-shadow align-center" style="dispaly:none;">
<p> <div class="alert alert-danger" align="center"> No products found!!!</div></p>
</div>
                            <table class="table table-striped table-bordered demo-tbl" id="<?php if($products){echo 'sample_121212';} ?>">
                            <thead>
                                <tr>
                                    <th style="">#</th>
                                     <th style=""><input type="checkbox" id="check_b" class="check_b" onchange="checkAll(this)" name="chk[]" /></th>
                                    <th style="">Product Name</th>
                                    <th style="">Product Image</th>                                    
                                    <th style="">Product Price</th>
                                    <th style="">Available Stores</th>
                                     <th style="">View Prices</th>
                                    <th style="" class="hidden-phone">Sort Order</th>
									 <th style="" class="hidden-phone">Verified</th>

                                    <th style="" class="hidden-phone">Status</th>
                                    <th style="" class="hidden-phone">Action</th>
                                 </tr>
                            </thead>
                            <tbody id='search_results'>
							<?php
							if($this->uri->segment(4)!="")
							{
								$k=$this->uri->segment(4);
							}
							else
							{
								$k=0;
							}	
							
							// get maximum brand order..
							$maximum_order = $this->admin_model->get_maxbrand();
							foreach($maximum_order as $get){
								$max_order = $get->sort_order;
							}
							
							if($products){
								$s=1;
							foreach($products as $product){
							$k++;
							$product_id = $product->product_id;
							?>
                                <tr class="odd gradeX tbl-item">
                                    <td><?php echo $k; ?></td>
                                    <td><input type="checkbox"  class="check_b" name="chkbox[<?php echo $product_id;?>]" /></td>
                                    <td class=""><p class="titles "> <?php echo $product->product_name; ?> </p></td>
                                    <?php 
									if($product->product_image)
									{
									?>
                                    <td><center><img width="100" height="100" src="<?php echo base_url();?>uploads/products/<?php echo $product->product_image; ?>"></center></td>
                                    <?php
									}
									else
									{
										?>
                                        <td>&nbsp;</td>
                                        <?php
									}
									?>
                                    <?php
									$prodetail = $this->admin_model->fetch_product_details($product->product_url);
									//print_r($get_products_from_product_byid);
									/*exit;*/
									?>
                                    <td><?php echo DEFAULT_CURRENCY;?><?php 
									if($prodetail->Totalstores)
										echo $prodetail->min_price;
									else
										echo 0;
									?>
                                    </td>
                                    <td><?php 
									if($prodetail->Totalstores)
										echo $prodetail->Totalstores;
									else
										echo 0;
									?>
                                    </td>
                                    
                                    <td>
                                    <?php
									if($prodetail->Totalstores)
									{
										$comparisonprices = $this->admin_model->comparison_details($product_id);
										?>
                                       <a href="#myModal<?php echo $product_id;?>" class="btn btn-warning" role="button" data-toggle="modal">View Prices</a>
                                       <div id="myModal<?php echo $product_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel"> Price List</h3>
                                          </div>
                                          <div class="modal-body">
                                            <table width="354" height="107" class="table table-striped table-bordered" id="">
                                            <thead>
                                              <tr>
                                                 <td style="text-align:center;"> No</td>
                                                 <td style="text-align:center;"> Store</td>
                                                 <td style="text-align:center;"> Price</td>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
											$s =1;
											foreach($comparisonprices as $storess)
											{
											?>
                                              <tr>
                                                <td><?php echo $s;?></td>
                                                <td style="text-align:center"><img style="height:65px;" src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $storess->affiliate_logo;?>" /></td>
                                                <td><?php echo DEFAULT_CURRENCY;?><?php echo $storess->product_price;?></td>
                                              </tr>
                                             <?php
											 $s++;
											}
											 ?>
                                             </tbody>
                                            </table>
                                          </div>
                                          <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                            <!--<button class="btn btn-primary">Save changes</button>-->
                                          </div>
                                        </div>
                                        <?php
									}
									
									?>
                                    </td>
                                    <?php
									if($product->sort_order!='')
									{
										$sort_order =$product->sort_order;
									}
									else
									{
										$sort_order=0;
									}
									?>
                                    <td><input class="textbox" style="width:100px;" type="number"  size="4" value="<?php echo $sort_order;?>" name="sort_arr[<?php echo $product_id;?>]"></td>
								<td>

                                    <?php

                  $get_active_store=$this->admin_model->get_active_store($product->parent_id,$product->parent_child_id);

                  

                  //print_r($prodetail);die;

                  if(count($get_active_store)>0)

                  {

                     // print_r($get_active_store);

                

                    ?>



                    <?php if($product->product_status!='1'){ ?>

                                       

                                       <a href="#myModal1<?php echo $product_id;?>" id="store_<?php echo $product_id;?>" class="btn btn-warning" role="button" data-toggle="modal">Un Verified</a>

                    <?php } else{ ?>



                     <a href="javascript:;" id="store_<?php echo $product_id;?>" class="btn btn-warning" role="button">Verified</a>



                      <?php } ?>



                                       <div id="myModal1<?php echo $product_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                          <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h3 id="myModalLabel"> Price List</h3>

                                          </div>

                                          <div class="modal-body">

                                            <table width="354" height="107" class="table table-striped table-bordered" id="">

                                            <thead>

                                              <tr>

                                                 <td style="text-align:center;"> No</td>

                                                  <td style="text-align:center;">

                                                   <input type="checkbox" id="check_b1" class="check_b1;?>"  name="chk[]" /></td>

                                                 <td style="text-align:center;"> Store</td>

                                                 <td style="text-align:center;"> Links</td>

                                              </tr>

                                            </thead>

                                            <tbody>

                                            <?php

                      $s =1;

                      foreach($get_active_store as $st_ids)

                      {

                        $get_store=$this->admin_model->get_aff_stores($st_ids);

                        $get_active_links=$this->admin_model->get_active_links($st_ids,$product_id);

                        

                        

                      ?>

                                              <tr>

                                                <td><?php echo $s;?></td>

                                                 <td>

                          <input type="checkbox"  class="check_b1_<?php echo $product_id;?>" id="chk_<?php echo $product_id; ?>" name="chkbox1[]" value="<?php echo $get_store->affiliate_id; ?>"/></td>

                                                <td style="text-align:center"><img style="height:49px; width:135px;" src="<?php echo base_url(); ?>uploads/affiliates/<?php echo $get_store->affiliate_logo;?>" /></td>

                                                <td>

                         <select name="affiliate_url[]" class="affiliate_url_<?php echo $product_id; ?>" required>







                        <?php foreach($get_active_links as $url)



                        { ?>



                        <option value="<?php echo $url->pp_id; ?>">



                        <?php echo $url->product_name;?>/<?php echo $url->product_price;?>



                        </option>



                        <?php } ?>



                        </select>

                        </td>

                                              </tr>

                                             <?php

                       $s++;

                      }

                       ?>

                                             </tbody>

                                            </table>

                                          </div>

                                          <div class="modal-footer">

                                          <!--   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->

                                            <!--<button class="btn btn-primary">Save changes</button>-->



                                             <input type="button" class="btn btn-warning" onclick="formSubmit('<?php echo $product_id;?>')" value="Save Changes" />



                                            <input type="button" class="btn btn-warning" onclick="form_delete('<?php echo $product_id;?>');" value="Delete">

                                          </div>

                                        </div>

                                        <?php

                  }

                  

                  ?>

                                    </td>	
									<td  style="text-align:center">
									<?php
									$status = $product->status;
										if($status=='1'){
											echo 'Activated';
											$lock = 'icon-unlock';
											$stat = '0';
										}else{
											echo 'De-activated';
											$lock = 'icon-lock';
											$stat = '1';
										}
									?>
									</td>
                                    <td  style="text-align:center" class="hidden-phone">
									<?php echo anchor('adminsettings/update_product_status/'.$product->product_id.'/'.$stat,'<i class="'.$lock.'"></i>'); ?>
									&nbsp;
									<?php echo anchor('adminsettings/update_product/'.$product->product_id,'<i class="icon-pencil"></i>'); ?>
									&nbsp;
									<?php
									$confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this product detail?');");		
									echo anchor('adminsettings/delete_product/'.$product->product_id,'<i class="icon-trash"></i>',$confirm); ?>
									</td>
                                </tr>
								<?php $s++;} } else { ?>
								<tr><td colspan="7">
									<center><strong>No products found.</strong></center>
								</td></tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="hidd" value="hidd">
                        <input id="GoUpdate" class="btn btn-warning" type="submit" value="Update Products" name="GoUpdate">
						</div>
						<div class="span11"><div class="dataTables_paginate paging_bootstrap pagination"><ul><?php  echo $this->pagination->create_links(); ?></ul></div></div>
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
   	    <script src="<?php echo base_url(); ?>assets/js/jplist.min.js"></script>
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
	 
	  /*   $('#sample_121212').dataTable({
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }]
        }); */ 
		
		
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

function change_categories(id)
{
	$.ajax({
		type:'POST',
		url:'<?php echo base_url();?>adminsettings/change_categories',
		data:{'cat_id':id},
		success:function(msg){
			$('#tags').show();
			$('#tags').html(msg);
			
		}
		
		
	})
}

function get_change_cate(cate)
{
	 window.location.href = '<?php echo base_url(); ?>adminsettings/products/'+cate;
}	
   </script>
   
   
   <script>
$('document').ready(function () {
$('#demo').jplist({

itemsBox: '.demo-tbl'
, itemPath: '.tbl-item'
, panelPath: '.jplist-panel'

//save plugin state
//, storage: 'localstorage' //'', 'cookies', 'localstorage'
//, storageName: 'jplist-tabl'
});
});
function jp_search()
{
$('#demo').jplist({

itemsBox: '.demo-tbl'
, itemPath: '.tbl-item'
, panelPath: '.jplist-panel'
});
}
</script>
<script>

     function formSubmit(id)

     {

      var chkArray = [];

       var form_sub ='affiliate_url_'+id;

       // alert(form_sub);

$('.affiliate_url_'+id).each(function() 

{

chkArray.push($(this).val());



});

var selected;

selected = chkArray.join(',') + ",";



if(selected.length > 1){

$.ajax({

type: "POST",

url: "<?php echo base_url(); ?>adminsettings/get_products_update",

// data:"id="+selected,

data:{"id":selected,"product_id":id},

success: function(html)

{

        // alert('Stores Added Suucessfully');

        $('#myModal1'+id).modal('hide');

        $('#store_'+id).html('Defined');



    }

});

}

else{

alert("Please at least one of the checkbox");

}

}



    </script>

<script>

   function form_delete(id)

     {

       var chkArray = [];

  $('.check_b1_'+id+':checked').each(function() 

  {

   

  chkArray.push($(this).val());

  });

  var selected;

  selected = chkArray.join(',') + ",";

  if(selected.length > 1){

    

        // var st = $('#chk_'+id).val();

         // alert(st);

      

  $.ajax({

  type: "POST",

  url: "<?php echo base_url(); ?>adminsettings/delete_products_update",

  // data:"id="+selected,

  data:{"id":selected,"store_id":id},

  success: function(html)

  {

          // alert('Deleted Suucessfully');

          $('#myModal1'+id).modal('hide');

          $('#store_'+id).html('Defined');



    }

  });

  }

  else

  {

  alert("Please at least one of the checkbox");

  }

  }
function get_serach_value()
{
	var id=$('#search_key').val();
	$.ajax({

  type: "POST",
  url: "<?php echo base_url(); ?>adminsettings/get_serach_product",
  data:{"key":id},
  success: function(html)
  {
     
          $('#search_results').html(html);

  }

  });
}
</script>
</body>
<!-- END BODY -->
</html>