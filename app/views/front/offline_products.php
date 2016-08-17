<!DOCTYPE html>
<!-- saved from url=(0085)https://s3.amazonaws.com/tw-chat/attach/3f155f150775bbe5e7cb5bfaf59ddc8e/product.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Offline Products</title>

<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>

</head>
<body>

<?php $this->load->view('front/header_off'); ?>

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
         <?php $this->load->view('front/sun_menu'); ?>

          <div class="col-md-9">
            
          
<div class="all clearfix">
          
          
          <!-- Nav tabs -->
          <div class="acc-table-style clearfix">
            <div class="mar-bot20">
              <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center mar-top10">Add Products</h4>
                <div class="bor bg-red"></div>
              </div>
              <?php
              $attribute = array('role'=>'form','name'=>'product','method'=>'post','id'=>'product','enctype'=>'multipart/form-data','class'=>'form-horizontal'); 
              echo form_open('cashback/offline_products',$attribute);
            ?>
              <ul class="list-inline mar-bot">
              <li class="col-md-3 col-sm-3">
                <select name="parent_id" id="parent_id" class="form-control" onChange="fetch_first_level(this.value,'main')" required >
                <!-- <select class="form-control" > -->
                <option value=""> Select </option>    
                  <?php 
                    if($main_category){
                      foreach($main_category as $main_cat){
                    ?>
                    <option value="<?php echo $main_cat->cate_id; ?>">
                      <?php echo $main_cat->category_name; ?></option>
                  <?php }} ?> 
                </select>
              </li>
                        
              <li class="sub_category col-md-3 col-sm-3" style="display:none">
                <select class="form-control" name="parent_child_id" id="tags" onChange="fetch_first_level(this.value,'sub'),get_products();">
                <!-- <select class="form-control sub_category" style="display:none"> -->
                
                </select>
              </li>
            <!--            
              <li class="child_category" style="display:none"> 
                <select class="form-control" name="child_id" id="child" onchange="get_products();">
                              
              </select>
            </li> -->

                 <li class="product_category col-md-3 col-sm-3" id="product_category" style="display:none"> 
                    <select class="form-control " name="product_id" id="product_id">
              
                  </select>
                </li>
                <li>
                    <a class="btn btn-danger bor-rad-no btn-sm" href="javascript:void(0);" onclick="return get_pro_details();">
                     Search 
                    </a>
               </li>
			   <li id='loader' style="display:none"> <img src="<?php echo base_url(); ?>uploads/adminpro/6782loading.gif" /></li>
 
                        </ul>
                      <?php echo form_close(); ?>
                      <div class="error" style="color:red"></div> <div class="success"></div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped-col nomargin table-hover-color" <?php if($main_category){ ?> id="example" <?php } ?>>
                    <thead>
                     <tr class="bg-ylw clr-wht">
                      <!--  <th class="text-center"> <label class="ckbox ckbox-primary">
                            <input type="checkbox">
                            <span></span> </label>

                        </th>-->
                        <th class="text-center">Product Name </th>
                        <th class="text-center">Stores </th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Offer </th>     
                      </tr>
                    </thead>
                    <tbody class="text-center" id="body_cont">
                 
                       <tr><td colspan="4">No Results found!!</td></tr>
                      
                      
                    </tbody>
                  </table>
                  <div style="text-align: center; margin: 10px 0px 0px;">
                    <a class="btn btn-danger bor-rad-no btn-sm" href="javascript:void(0);" id="add_save">
                     Save 
                    </a>
                  </div>
                </div>
                <!-- table-responsive --> 
              </div>
            </div>
          </div>
        </div>

          
                       
        </div>
     
  </div>
  
  </div>
</section>




<?php 
  $this->load->view('front/sub_footer');
  $this->load->view('front/site_intro');  
  $this->load->view('front/js_scripts');
?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 



<script>
function fetch_first_level(id,type)
{
  // alert(type);
  
  if(id!=''){
    $jq.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/fetch_first_level',
      data:{'cat_id':id},
      success:function(html){
        var data = html.trim();
        if(data != 'false')
        {
          if(type == 'main')
          {
            $jq('.sub_category').show();
            $jq("#tags").html(data);
          }
          if(type == 'sub'){
            $jq('.product_id').show();
            $jq("#product_id").html(data);
          }
        }
      }
    });
  } 
}

function get_products()
{
  var id = $jq('#parent_id').val();
  var parent_child_id = $jq('#tags').val();
  // var child = $jq('#child').val();
   // alert(child);
  $jq.ajax({
    url: '<?php echo base_url();?>cashback/get_products',
    type: 'POST',
    data:{"id":id,"parent_child_id":parent_child_id},
    success: function(data)
    {
      if(data != 'false')
        {
            $jq('.product_category').show();
            $jq("#product_id").html(data);
        }
      else
        {
            $jq('#product_category').hide();
        }

    }
  });
  return false;
}
function get_pro_details()
{
  var val=$jq('#product_id').val();
  // alert(val);
   if(val!=''){
    $jq.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/get_pro_detail',
      data:{'pid':val},
	  beforeSend: function() {
        $('#loader').show();
		
        
    },
      success:function(html){
      $jq('#body_cont').html(html);
	  $('#loader').hide();
        }
     
    });
   }
}
 $jq(document).on('blur','.price',function()
 {
$jq('.error').html('');
  
  var val=$jq(this).val();
  var id=$jq(this).attr('id');
  var brand=$jq('#brand').val();
  var ss = $( '#strore_name_'+id).val() || [];
 if(ss!='' && ss!='0'){
   if(val!='' && val!='0'){
    $jq.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/insert_price',
      data:{'price':val,'pid':id,'store':ss,'brand':brand},
      success:function(html){
    $jq('.success').html('<div class="alert alert-success"><strong>Success!</strong>Product offer added successfully.</div>');
           }
     
    });
   }
   else
  {
    $jq('.error').html('Please add product price');
  }
}
  else
  {
    $jq('.error').html('Please add store');
    // alert('Please add store');
  }
});

$jq(document).on('click','.updater',function()
 {
$jq('.error').html('');
  
  var id=$jq(this).val();
  var val=$jq('#'+id).val();
  
  var brand=$jq('#brand').val();
  var ss = $( '#strore_name_'+id).val() || [];
  alert(ss);
 if(ss!='' && ss!='0'){
   if(val!='' && val!='0'){
    $jq.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/insert_price',
      data:{'price':val,'pid':id,'store':ss,'brand':brand},
      success:function(html){
    $jq('.success').html('<div class="alert alert-success"><strong>Success!</strong>Product offer added successfully.</div>');
           }
     
    });
   }
   else
  {
    $jq('.error').html('Please add product price');
  }
}
  else
  {
    $jq('.error').html('Please add store');
    // alert('Please add store');
  }
});


$jq(document).on('blur','.offer',function()
 {
  $jq('.error').html('');
var pp=$jq('.price').val();
if(pp!="" && pp!="0")
{
  var val=$jq(this).val();
  // var id=$jq('#pid').val();
  var id = $jq(this).attr('id');
  var brand=$jq('#brand').val();
  //var ss=$jq('#strore_name').val();
   var ss = $( '#strore_name_'+id).val() || [];
   if(val!=''){
    $jq.ajax({
      type:'Post',
      url:'<?php echo base_url(); ?>cashback/insert_offer',
      data:{'offer':val,'pid':id,'store':ss,'brand':brand},
      success:function(html){
    //  $jq('#body_cont').html(html);
      $jq('.success').html('<div class="alert alert-success"><strong>Success!</strong>Product offer added successfully.</div>');
        }
     
    });
   }
  }
  else
  {
    $jq('.error').html('Please add product price');
  }
});
$jq(document).on('click','#add_save',function()
 {
//alert('gfgf');
    var id=$jq('#pid').val();
    if(id!="" && id!="0")
    {
      var pp=$jq('#price').val();
if(pp!="" && pp!="0")
{
}
else
{
    $jq('.error').html('Please add product price');
 
}

}
else
{
  //alert('ggg');
    $jq('.error').html('Please Select any product');
 
}
});
  
</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">
      $jq(document).ready(function() 
      {
        $jq('#example').dataTable();
      } );
</script>


</body></html>
