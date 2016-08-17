<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - My payments</title>
<?php $this->load->view('front/css_script');?>

<!-- <link href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css"> -->

</head>

<body>
<?php $this->load->view('front/header'); ?>
<!-- header ends here --->



<!--- breadcrumb sec ends here --->

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
         <h4 class='panel-title text-uppercase text-center'>My Payments</h4>
		 <div class="bor bg-red"></div>
         
          <div class="acc-table-style clearfix">
            <div class="panel">
			
              <!--<div class="panel-heading">
                <h4 class="panel-title text-uppercase">My Payments</h4>
              </div>-->
              <div class="panel-body">
                <div class="table-responsive">
                 <table <?php if($result){ ?> id="example" <?php } ?>  class="table table-bordered table-striped-col nomargin table-hover-color">
                           
                            <thead>
                            <tr class="bg-ylw clr-wht">
                               <th>Date Requested</th>
								<th>Request Amount</th>
								<th>Closing Date</th>
								<th>Status</th>		
                            </tr>
                            </thead>
                            
                            <tbody>
                           
						<?php
						if($result)
						{
						foreach($result as $rows)
						{
						  ?>
								<tr>
							<td><?php $data = $rows->date_added; echo date('d/m/Y',strtotime($data)); ?></td>
							<td><?php echo DEFAULT_CURRENCY.' '.$rows->requested_amount; ?></td>
							<td><?php if($rows->status=='Completed')
							{
								echo $rows->closing_date;
							}
							else
							{
								echo "---";
							}								?></td>
							<td>
							<?php
							if($rows->status=='Requested')
							{
								?>
								<a class="btn btn-info btn-xs pop" href=""> Requested </a></td>
								<?php
							}
							if($rows->status=='Processing')
							{
								?>
								<a class="btn btn-danger btn-xs pop" href=""> Processing </a></td>
								<?php
							}
							
							if($rows->status=='Completed')
							{
								?>
								<a class="btn btn-success btn-xs pop" href=""> Completed </a></td>
								<?php
							}
							
							if($rows->status=='Cancelled')
							{
								?>
								<a class="btn btn-danger btn-xs pop" href=""> Completed </a></td>
								<?php
							}
							
							
							?>
                            </tr>
                         <?php
						}
						}
						else
						{
						?>
						<tr>
						<td colspan=3>No records found !!!</td>
						</tr>
						<?php
						}
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

<!--- inner pagesec ends here --->
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
</body>
</html>
