<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - Click History</title>
<?php $this->load->view('front/css_script');?>
<style>
.error {
	color:#ff0000 !important;
	font-weight:normal !important;
}
.required_field {
	color:#ff0000 !important;
}
</style>
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
			 <h4 class="text-uppercase">Click History</h4> 
              <div class="panel-heading">
                <p class="panel-title">Below you will find the latest stores you've visited. So you can track the stores you have looked at.</p>
              </div>
              <div class="panel-body">
              
              
                <div class="table-responsive">
                  <table <?php if($history){ ?> id="example" <?php } ?> class="table table-bordered table-striped-col nomargin table-hover-color">
                    <thead>
                      <tr class="bg-ylw clr-wht">
                        
                        <th>Store</th>
						<th>Reference ID</th>
						<th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php
				if($history!='')
				{
					$kss=1;
					foreach($history as $row)
					{						
					?>
                      <tr>
						<td><span class="text-danger"> <i class="fa fa-check-circle pad-rht"></i><?php echo $row->store_name; ?></span></td>
						<td><?php echo $row->click_id; ?></td>
						<td><?php echo date('d M Y',strtotime($row->date_added)); ?></td>
                       </tr> 
                    </tbody>
				<?php
					$kss++;
					}
				}
				?>
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
<?php $this->load->view('front/partners');?>

<!--- partners ebds here --->
<?php $this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
</script>
</body>
</html>
