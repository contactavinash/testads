<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?> - Transaction</title>
<?php $this->load->view('front/css_script');?>

<!-- <link href="<?php echo base_url(); ?>assets/assets/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css">
 -->
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
         <h4 class="clr-theme">Transations</h4>
			  <div class="bor bg-red"></div>
			  
          <div class="acc-table-style clearfix">
	
        <div class="panel">
       
        <div class="panel-body">
          <div class="table-responsive">
		  
            <table <?php if($result){ ?> id="example" <?php } ?> class="table table-bordered table-striped-col table-hover-color">
              <thead>
                <tr class="bg-ylw clr-wht">
					<th>No</th>
					<th>Transaction Reason</th>
					<th>Transaction Amount</th>
					<th>Type</th>
					<th>Transaction Date</th>
					<th>Status</th>		
                  </tr>
              </thead>
              <tbody>
				<?php
        if($result){
				$k=1;
				foreach($result as $rows)
				{
				?>
                <tr>
					<td><?php echo $k; ?></td>
					<td><?php echo $rows->transation_reason; ?></td>
					<td><?php echo DEFAULT_CURRENCY." ".$rows->transation_amount; ?></td>
					 <td><?php echo $rows->mode; ?></td>
					<td><?php echo date('jS F Y',strtotime($rows->transation_date)); ?></td>
				
					<td>
					<?php
					if($rows->transation_status!='Paid')
					{
						?>
						<a class="btn btn-danger btn-xs pop" href=""> Pending </a></td>
						<?php
					}
					else
					{
						?>
						<a class="btn btn-success btn-xs pop" href=""> Success </a></td>
						<?php
					}
					?>
                  </tr>
				<?php
				  $k++;
				} }
        else{
				?>
          <tr>
          <td colspan=6re><center>No Records Found !!!</center></td>
        </tr>
        <?php } ?>
              
              </tbody>
            </table>
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
<!-- DATATABLES -->

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
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$(function() {
    $('#startdatepicker, #enddatepicker').datepicker({
        beforeShow: customRange,
        dateFormat: "mm/dd/yy",
        firstDay: 1,
        changeFirstDay: false
    });
});

function customRange(input) {
    var min = null, // Set this to your absolute minimum date
        dateMin = min,
        dateMax = null,
        dayRange = 30; // Restrict the number of days for the date range
    
    if ($('#select1').val() === '2') {
        if (input.id === "startdatepicker") {
            if ($("#enddatepicker").datepicker("getDate") != null) {
                dateMax = $("#enddatepicker").datepicker("getDate");
                dateMin = $("#enddatepicker").datepicker("getDate");
                dateMin.setDate(dateMin.getDate() - dayRange);
                if (dateMin < min) { dateMin = min; }
            } else {  }
        } else if (input.id === "enddatepicker") {
            dateMin = $("#startdatepicker").datepicker('getDate');
            dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 30);
            if ($('#startdatepicker').datepicker('getDate') != null) {
                var rangeMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
                if (rangeMax < dateMax) { dateMax = rangeMax; }
            }
        }
    } else if ($('#select1').val() != '2') {
        if (input.id === "startdatepicker") {
            if ($('#enddatepicker').datepicker('getDate') != null) {
                dateMin = null;
            } else {  }
        } else if (input.id === "enddatepicker") {
            dateMin = $('#startdatepicker').datepicker('getDate');
            dateMax = null;
            if ($('#startdatepicker').datepicker('getDate') != null) { dateMax = null; }
        }
    }
    return {
        minDate: dateMin,
        maxDate: dateMax
    };
}

$('.datepicker').datepicker('widget').delegate('.ui-datepicker-close', 'mouseup', function() {
    var inputToBeCleared = $('.datepicker').filter(function() { 
      return $(this).data('pickerVisible') == true;
    });    
    $(inputToBeCleared).val('');
});
});//]]>
</script>
</body>
</html>
