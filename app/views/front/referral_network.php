<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - Referral Network</title>
<?php $this->load->view('front/css_script');?>

<!-- <link href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css"> -->

</head>

<body>
<?php $this->load->view('front/header');?>

<!-- header ends here --->



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec gap-top-20  clearfix ">


  <div class="container">
    
      
         
         <div class="row">
         
         <?php $this->load->view('front/user_menu'); ?>
         
         <div class="col-md-9">
         
          <div class="acc-table-style clearfix">
        
        <div class="panel">
		
		<div class="panel-body refer-frnd">
              <h4 class="clr-theme">Referral Network</h4>
			  <div class="bor bg-red"></div>
			  
			  
              
          <div class="panel-body">
              
              
                <div class="table-responsive">
                  <table <?php if($result){ ?> id="example" <?php } ?> class="table table-bordered table-striped-col nomargin table-hover-color">
                    <thead>
                      <tr class="bg-ylw clr-wht">
                        <th>Date Joined</th>
						<th>Referral Name</th>
						<th>Referral Account Status</th>
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
									<td><?php echo $rows->referral_email; ?></td>
									<td><?php echo 'Active'; ?></td>
							  </tr>	    
							  <?php
							}
						}
						else
						{
						?>
							  <tr>
							  <td colspan="3"> No records Found !!!</td>
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
   
</section>

<!--- inner pagesec ends here --->
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/data-tables/jquery.dataTables.js"></script>  -->

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
