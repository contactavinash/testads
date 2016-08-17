<!DOCTYPE html>
<!-- saved from url=(0088)https://s3.amazonaws.com/tw-chat/attach/c07b49c8d2053dc8a4e1f5cb16e1a98f/view-store.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>List of Products</title>

<!-- Bootstrap -->
<?php $this->load->view('front/css_script'); ?>
<!-- <link href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css"> -->

</head>
<body>

<?php $this->load->view('front/header_off'); ?>

<section class="inner-page-sec clearfix  contacts-index-index">
  <div class="container">
    
        <div class="row">
<?php $this->load->view('front/sun_menu'); ?>

          <div class="col-md-9">
            
          
<div class="all clearfix">
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
          
          <!-- Nav tabs -->
          <div class="acc-table-style clearfix">
            <div class="mar-bot20">
              <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center mar-top10">List of Products</h4>
                <div class="bor bg-red"></div>
                 <div>
                   <?php 
                    $offline_userid = $this->session->userdata('offline_user_id');
                    $store_id = $this->front_model->get_Stores($offline_userid);
                    if($store_id!='')
                    {
                 ?>
                  <a href="<?php echo base_url(); ?>offline_products">
                    <button class="btn btn-danger">Add Products</button>
                  </a>
                  <?php } else{ ?>
                    <a href="<?php echo base_url(); ?>add_offlinestores">
                    <button class="btn btn-danger">Add Stores</button>
                  </a>
                    <?php } ?>
                </div>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table <?php if($result){ ?> id="example" <?php } ?> class="table table-bordered table-striped-col nomargin table-hover-color">
                    <thead>
                     <tr class="bg-ylw clr-wht">
                      <!--  <th class="text-center"> <label class="ckbox ckbox-primary">
                            <input type="checkbox">
                            <span></span> </label>

                        </th>-->
                        <th class="text-center">S.No </th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Product Logo</th>
                        
                        <!-- <th class="text-center">Status </th> -->
                        <th class="text-center">Action</th>
                     
                      </tr>
                    </thead>
                    <tbody class="text-center">

                      <?php
            if($result){
            $k=1;
            foreach($result as $rows)
            { 
              $product_name = $this->front_model->get_Productname($rows->product_id);
              ?>
                   <tr>
                        <!--<td><label class="ckbox ckbox-primary">
                            <input type="checkbox">
                            <span></span> </label></td>-->
                        <td class="alert"><?php echo $k; ?></td>

                        <td>
                          <center>
                            <?php echo $product_name->product_name; ?>
                          </center>
                        </td>

                        <td class="alert">
                          <img  data-image="<?php echo $product_name->product_image;?>" src="<?php echo base_url();?>uploads/products/<?php echo $product_name->product_image; ?>" width="65px" height="60px" class="img-center">
                        </td>
                    

                    <!--     <td class="alert">
                        <?php if($rows->status=='1'){ ?>
                          <a class="btn btn-success btn-xs pop" href="javascript:;"> 
                            Active 
                          </a>
                        <?php }else{ ?>
                          <a class="btn btn-danger btn-xs pop" href="javascript:;"> 
                            De-active
                          </a>
                        <?php } ?>
                      </td>
 -->
                    <td class="alert">

                      <center>
                      <?php 
                      $confirm = array("class"=>"confirm-dialog","onclick"=>"return confirmDelete('Do you want to delete this Product detail?');"); 

                      echo anchor('delete_products/'.($rows->ofline_id),'<i class="fa fa-trash"></i>',$confirm); 
                      ?>
                      </center>
                    </td>

                       <!--    <td class="alert"><a class="btn btn-success bor-rad-no btn-sm" href="https://s3.amazonaws.com/tw-chat/attach/c07b49c8d2053dc8a4e1f5cb16e1a98f/view-store.html#"> Edit </a>
                        <a class="btn btn-primary bor-rad-no btn-sm" href="https://s3.amazonaws.com/tw-chat/attach/c07b49c8d2053dc8a4e1f5cb16e1a98f/view-store.html#"> View </a>
                        <a class="btn btn-info bor-rad-no btn-sm" href="https://s3.amazonaws.com/tw-chat/attach/c07b49c8d2053dc8a4e1f5cb16e1a98f/view-store.html#"> Active </a>
                        <a class="btn btn-warning bor-rad-no btn-sm" href="https://s3.amazonaws.com/tw-chat/attach/c07b49c8d2053dc8a4e1f5cb16e1a98f/view-store.html#"> Deactive </a>
                        </td> -->
                      
                      </tr>
                      <?php
            $k++;
            }
              }
              else{ ?>
                      
                      <tr>
                  <td colspan=8>
                    <center>No Records found !!!</center>
                  </td>
                </tr>
              <?php }
            ?>
                      
                      
                      
                      
                      
                    </tbody>
                  </table>
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



<?php $this->load->view('front/partners');?>

<!--- partners ebds here --->
<?php $this->load->view('front/sub_footer');
  
//Footer
  $this->load->view('front/site_intro');  
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->

<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>  -->


<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets_new/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets_new/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets_new/plugins/data-tables/DT_bootstrap.css"/>

<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/data-tables/DT_bootstrap.js"></script>

<script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
        $('#example').dataTable();
      } );
</script>

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

</body>
</html>