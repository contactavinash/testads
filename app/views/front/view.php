<!DOCTYPE html>
<!-- saved from url=(0088)https://s3.amazonaws.com/tw-chat/attach/c07b49c8d2053dc8a4e1f5cb16e1a98f/view-store.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Stores</title>

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

          <div class="col-md-9 clsmin_height">
            
          
<div class="all clearfix">
          
          
          <!-- Nav tabs -->
          <div class="acc-table-style clearfix">
            <div class="mar-bot20">
              <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center mar-top10">View Store</h4>
                <div class="bor bg-red"></div>
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
                        <th class="text-center">Store Name</th>
                        <th class="text-center">Store Logo</th>
                        <th class="text-center">Address </th>
                        <th class="text-center">Status </th>
                        <th class="text-center">Action</th>
                     
                      </tr>
                    </thead>
                    <tbody class="text-center">

                      <?php
            if($result){
            $k=1;
            foreach($result as $rows)
            { ?>
                   <tr>
                        <!--<td><label class="ckbox ckbox-primary">
                            <input type="checkbox">
                            <span></span> </label></td>-->
                        <td class="alert"><?php echo $k; ?></td>

                        <td>
                          <center>
                            <?php echo $rows->store_name; ?>
                          </center>
                        </td>

                        <td class="alert">
                          <img  data-image="<?php echo $rows->store_logo;?>" src="<?php echo base_url();?>uploads/offline_stores/<?php echo $rows->store_logo; ?>" width="65px" height="60px" class=" img-center">
                        </td>
                       <td class="alert">
						   
                        <?php $view_address = $this->front_model->view_address($rows->store_id);
                          /*echo '<pre>';
                          print_r($view_address);die;*/
                          foreach($view_address as $view)
                          {  
                            echo ' '.$address = $view->address;
					
                          }
                            // echo $address; 
                          ?>
                        </td>

                        <td class="alert">
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

                    <td class="alert">

                      <center><?php echo anchor('update_stores/'.($rows->store_id),'<i class="fa fa-pencil"></i>'); ?>
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
                    <center>No Records found</center>
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
<!-- 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script> -->
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




</body></html>
