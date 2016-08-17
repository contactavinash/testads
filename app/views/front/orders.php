<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - Referral Network</title>
  <!-- Bootstrap -->
     <?php $this->load->view('front/css_script'); ?>	
	 
   <!-- tabs -->

</head>

<body>
<!-- Header -->

<?php $this->load->view('front/header'); ?>

<!-- Header ends here -->
	<div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a> <span> <i class="fa fa-angle-double-right"></i> </span> </li>
				<li class="category34"> <strong>Orders</strong> </li>
			  </ul>
			</div>
			<!--col-xs-12--> 
		  </div>
		  <!--row--> 
		</div>
		<!--container--> 
	</div>

<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3">
			<?php $this->load->view('front/menubar'); ?>
		</div>
		<div class="col-lg-9 col-sm-12 col-md-9">
        <div class="md-card md-card-hover md-card-overlay md-card-overlay-active">
              <div class="col-md-12">
                  <h3>Orders</h3>
                  
                  <div class="earnings clearfix">
                  <h4 class="mar-tb20">My Orders</h4>

                  <div class="table-responsive">
             <?php
		  if($result)
		  {
			  ?>      
                  <table id="example" class="display table table-bordered">
          <thead>
            <tr>
				<th>Name</th>
				<th>Quantity</th>
				<th>Amount</th>		
                <th>Total Amount</th>
                <th>Date</th>	
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
						<td><?php echo $rows->offer_name; ?></td>
						<td><?php echo $rows->quantity; ?></td>
						<td><?php echo $rows->amount; ?></td>
                        <td><?php echo $rows->quantity*$rows->amount; ?></td>
                        <td><?php $data = $rows->date; echo date('d/m/Y',strtotime($data)); ?></td>
				  </tr>	    
				  <?php
				}
		  }
		  else
		  {
			  ?>
              <tr>
              <td colspan="3"> No records Found</td>
              </tr>
              <?php
		  }
				?>
			
		  </tbody>
        </table>
        <?php } else { ?>
		
              <table class="table table-hover table-bordered">
              <thead>
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Amount</th>		
					<th>Total Amount</th>
					<th>Date</th>	
				</tr>
			  </thead>
              <tr>
              <td colspan="5"><center> No records found</center></td>
              </tr>
              </table>
              <?php } ?>
                  </div>
                  </div>
                <!--<div class="panel-group responsive visible-xs visible-sm" id="collapse-undefined">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-undefined" href="#collapse-tab-activity"><i class="fa fa-bolt"></i>&nbsp;
                        Activity</a></h4>
                    </div>
                    <div id="collapse-tab-activity" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body"></div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-undefined" href="#collapse-tab-edit"><i class="fa fa-edit"></i>&nbsp;
                        Edit Profile</a></h4>
                    </div>
                    <div id="collapse-tab-edit" class="panel-collapse collapse in" style="">
                      <div class="panel-body"></div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-undefined" href="#collapse-tab-messages"><i class="fa fa-envelope-o"></i>&nbsp;
                        Messages</a></h4>
                    </div>
                    <div id="collapse-tab-messages" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body"></div>
                    </div>
                  </div>
                </div>-->
              </div>
        </div>
		</div>
    </div>
    </div>
</div>

<footer>
<?php
//Footer
	$this->load->view('front/sub_footer');
	$this->load->view('front/site_intro');
?>
</footer>

<?php $this->load->view('front/js_scripts'); ?>
	
<!--<link href="<?php echo base_url(); ?>front/data-tables/demo_table_jui.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>front/data-tables/jquery-ui-1.8.4.custom.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>front/data-tables/jquery.dataTables.js" type="text/javascript"></script>-->
<!-- Latest compiled and minified bootstrapcdn JavaScript -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	/*$('#datatables').dataTable({
		"sPaginationType":"full_numbers",
		"aaSorting":[[2, "desc"]],
		"iDisplayLength":10,
		"bJQueryUI":true
	});*/
});
</script>
<link href="<?php echo base_url(); ?>front/css/jquery.datatables.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>front/js/jquery.datatables.min.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable();
	});
</script>
</body>
</html>