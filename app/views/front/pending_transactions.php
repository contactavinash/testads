<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - My payments</title>
<?php $this->load->view('front/css_script');
$admindetailss = $this->front_model->getadmindetails();?>

<!--<link href="<?php //echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css">-->
<style>
#example td{
padding:2px !important;
font-size:14px !important;
}
</style>
</head>

<body>
<?php $this->load->view('front/header'); ?>





<section class="inner-page-sec gap-top-20  clearfix">


  <div class="container">
    
      
         
         <div class="row">
		 
         <?php $this->load->view('front/user_menu'); ?>
         
         <div class="col-md-9">
         
         <div class="all clearfix">
          <?php
					if($status!="") 
						{
								echo '<div class="alert alert-success">
                      				  		<button data-dismiss="alert" class="close">x</button>
                       					 	<strong>Withdraw Request Successfully sent!.... </strong>
                    				 </div>';
			} ?>
		   <h4 class="clr-theme">Pending Transactions</h4>
        
		  <div class="bor bg-red"></div>
         
          <div class="acc-table-style clearfix">
            <div class="panel">
			
             
              <div class="panel-body">
                <div class="table-responsive">
                 <table <?php if($result){ ?> id="example" <?php } ?>  class="table table-bordered table-striped-col nomargin table-hover-color">
                           
                            <thead>
                            <tr class="bg-ylw clr-wht">
								<th> S.No </th>
								<th width="">Date </th>
								<th width="">"Go To Store" ID </th>
								<!-- <th width="17%">Product </th> -->
								<th width="">Store</th>
								<th width="">Price</th>
								<!-- <th width="17%"><?php echo $admindetailss[0]->coin_code;?> coins(Expected)</th> -->
								<th width="">Status</th>
                                <th width="">Delete</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                           
						<?php
						if($result){
						$k=1;
						foreach($result as $rows)
						{
							//get product details
							$get_productdetails  =$this->front_model->get_products_from_product_byid($rows->product_id);
						  ?>
							<tr>
							<td><?php echo $k; ?></td>
							<td><?php $data = $rows->date_added; echo date('d/m/Y',strtotime($data)); ?></td>
							<td><a href="<?php echo $get_productdetails->product_url;?>"><?php echo date('Ymd',strtotime(date("Y-m-d"))).$get_productdetails->product_id;?></a></td>
							<!-- <td><a href="<?php echo base_url(); ?>product_details/<?php echo $get_productdetails->purl;?>"><?php echo $get_productdetails->product_name;?> </a></td> -->
							<td><?php
								//get store name
								/*$get_Storename =$this->front_model->get_store_details_byid1($rows->affiliate_id,$rows->product_id);
								echo $get_Storename->affiliate_name;*/
								 	 echo $result->store_name; 
								?>
							</td>
							<td><?php echo $result->price;?></td>
							<!-- <td><?php echo $get_productdetails->reward_points;?></td> -->
							<td><a class="" href="">  
								<?php 

									if($result->status=='0')
									{

									?>
									<span class="btn btn-danger">
										Pending
									</span>
									<?php
									}
									else
									{ ?>
									<span class="btn btn-success">
										Approved
									</span>
									<?php 
									
									}

								?>  
							</a>
               				</td>
                            <td><a href="<?php echo base_url().'remove_ptrs/'.base64_encode($rows->click_id);?>" onclick="return confirm_delete();"><i class="glyphicon glyphicon-trash"></i></a></td>
							
                            </tr>
                         <?php
						$k++;
						}
						}
						else
						{
						?>
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

 <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>  

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets_new/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets_new/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets_new/plugins/data-tables/DT_bootstrap.css"/>

<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_new/plugins/data-tables/DT_bootstrap.js"></script>

<!--<script type="text/javascript" src="<?php e//cho base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>-->

<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
</script>
<script>
function confirm_delete()
{
var r = confirm("Are Your sure want to delete  Yes / No ?");
if (r == true) {
 
   return true;
} else {
  return false;
}
}
</script>

</body>
</html>
