<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> - Add Missing Cashback</title>
<?php $this->load->view('front/css_script');?>
<style>
.error
{
	color:#ff0000;
}
.required_field
{
 color:#ff0000;
}
.error_b {
    border: 1px solid #dd4b39 !important;
}
#errors_set
{
	color:red;
}
.extdesign td
{
	border: 1px solid rgba(0, 0, 0, 0.1) !important;
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
        
			<div class="col-md-12">

                      <h3 class="text-center text-uppercase">Add Missing Cashback Ticket</h3>
					  <div class="bor bg-red"></div>
                      <p>Please note that retailers accept missing cashback claims only for transactions made in the last 10 days.</p>
                       <?php 
					 $error = $this->session->flashdata('error');
					 if($error!="") {
						echo '<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">x</button>
						'.$error.'</div>';
					} ?>					
					<?php
						$success = $this->session->flashdata('success');
						if($success!="") {
								echo '<div class="alert alert-success">
									<button data-dismiss="alert" class="close">x</button>
									'.$success.'</div>';
						} ?>
                      <div class="earnings clearfix">
                         <form class="form-horizontal serial_missing_cashback" id="serial_missing_cashback" enctype="multipart/form-data" action="missing_Cashback_submit" method="post" onSubmit="return serial_missing_cashback_submit()"   role="form">
                        <div id="accordion" class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                             <h4 class="panel-title"><a href="#collapse-1" data-parent="#accordion" data-toggle="collapse" class="collapsed">Select Date of Transaction</a></h4>
                            </div>
                            <div id="collapse-1" class="panel-collapse collapse" style="height: 0px;">
                              <div class="panel-body">
                                <input type="text" class="form-control" value="<?php echo date("m/d/Y");?>" data-date-format="mm/dd/yy" id="dp2" name='click_date' >
                                <span class="err"></span>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title"><a href="#collapse-2" data-parent="#accordion" data-toggle="collapse" class="collapsed">Select Retailer</a></h4>
                            </div>
                            <div id="collapse-2" class="panel-collapse collapse">
                              <div class="panel-body">
                              <select class="form-control" onChange="get_click_details_ajax(this.value)" id="store" name="store">
                              <option value="">--Select--</option>
                           <!--   <option>Select</option>
                              <option>Select</option>-->
                              </select>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title"><a href="#collapse-3" data-parent="#accordion" data-toggle="collapse" class="collapsed">Transaction Details</a></h4>
                            </div>
                            <div id="collapse-3" class="panel-collapse collapse">
                              <div class="panel-body">
                              <div class="table-responsive" id="tbl1">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-hover" >
                              <tr class="extdesign">
                                <td >Exit Click Time</td>
                                <td>Transaction ID</td>
                                <td>Transaction Amount (<?php echo DEFAULT_CURRENCY_CODE;?>)</td>
                                <td>CashbackEarned (<?php DEFAULT_CURRENCY_CODE;?>)</td>
                                <td>Voucher Details</td>
                                <td>Status</td>
                              </tr>
							  <tbody id="tbls"></tbody>
                            </table>

                              </div>
                              
                              <p>Unsure about the time of transaction? Don't worry, just select any of the above listed exit clicks & we will take care of the rest!</p>
                        	</div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title"><a href="#collapse-4" data-parent="#accordion" data-toggle="collapse" class="collapsed">Enter Your Transaction Details</a></h4>
                            </div>
                            <div id="collapse-4" class="panel-collapse collapse">
                              <div class="panel-body">

						<fieldset>
						  <!-- Text input-->
						  <div class="form-group">
							<label class="col-sm-3 control-label" for="textinput">Transaction ID <span class="clr-red fnt-sz-13">* </span> </label>
							<div class="col-sm-9">
							  <input id="transaction_reference"  placeholder="Transaction ID"  class="form-control error_b" type="text" value="" name="transaction_reference" required>
							  <p class="help-block"><em>This is your Order ID / Transaction ID</em></p>
							</div>
						  </div>

						  <!-- Text input-->
						  <div class="form-group">
							<label class="col-sm-3 control-label" for="textinput">Total amount paid <span class="clr-red fnt-sz-13">* </span></label>
							<div class="col-sm-9">
							  <input id="ordervalue" placeholder="Total amount paid"  class="form-control error_b" type="text" value="" name="ordervalue" required>
							  <p class="help-block"> <em> Please exclude coupon discount </em></p>
							</div>
						  </div>

						  <!-- Text input-->
						  <div class="form-group">
							<label class="col-sm-3 control-label" for="textinput">Coupon Code Used</label>
							<div class="col-sm-9">
							  <input id="coupon_used" type="text" class="form-control" placeholder="Coupon Code Used"  name="coupon_used">
							</div>
						  </div>

						  <!-- Text input-->
						  <div class="form-group">
							<label class="col-sm-3 control-label" for="textinput">Details of Transaction <span class="clr-red fnt-sz-13">* </span></label>
							<div class="col-sm-9">
							  <textarea id="details" class="form-control detail error_b" name="details" rows="5" required></textarea>
							  <p class="help-block"><em> Please list all the products bought </em></p>
							</div>
					   
						  </div>



						  <!-- Text input-->
						 <!-- <div class="form-group">
							<label class="col-sm-3 control-label" for="textinput">Add Attachment:</label>
							<div class="col-sm-7">
							  <span class="btn btn-blue btn-file">
								  <span class="fileupload-new"></span>
								  <input id="ticket_attachment" class="col-md-12" type="file" value="" name="ticket_attachment" onchange="CheckFileType(this)" accept="image/*">
								</span>
								<span id="errors_set"></span>
							</div>
						  </div>-->
						  
						  <div class="form-group">
						  
						  <div class="col-sm-10 col-sm-offset-1">
						  
						  <ul class="list">
							<li>Retailers do not accept missing cashbacks older than 10 days</li>
							<li>Missing Cashback Tickets may take 30-45 days to get resolved and show in your Cashback Account</li>
							<li>Incorrect Information may lead to Cancellation of Cashback. Please do not raise multiple tickets for the same transaction. This may also lead to the Retailer declining the enquiry</li>
							<li>Cashback added from a Missing ticket may take more than 90 days to Confirm.</li>
							<li>Your Cashback may be updated at the time of confirmation</li>
							<li>While we shall try our best to resolve and get your missing cashback approved the retailer's decision is final</li>

						  
						  </ul>
						  
						  </div>
						  
						  </div>
						  
						  <div class="form-group">
						  <div class="colmd-11 col-md-offset-1">
						  <div class="checkbox">  <label>   <input id="terms_conditions" class="error_b" type="checkbox" value="Yes" name="terms_conditions" required>Have read and understood the terms and conditions.  </label></div>
						  
						  </div>
						  </div>
 
						  <div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" name="save" value="save" onClick="return serial_missing_cashback_submit();" class="btn btn-danger">Submit</button>
							</div>
						  </div>
						  
						  

						</fieldset>
						<input type="hidden" name="hid_click_id" value="" id="hid_click_id">
					<input type="hidden" name="err_hidden" value="" id="err_hidden">
                              
                        	</div>
                            </div>
                          </div>
                        </div>
                          </form>
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
<!--<script src="<?php echo base_url();?>front/js/bootstrap-datepicker.js"></script>-->
<script>
	if (top.location != location) 
	{
    	top.location.href = document.location.href ;
 	 }
  	
		$(function(){
			window.prettyPrint && prettyPrint();
		});

</script>
<script>

var changed_date = null;
$(document).ready(function() {    
  $('#ordervalue').keyup(function(e) {      
    if(e.keyCode != 9) {
      var acc_no = $('#ordervalue').val();
      patt=/^[0-9\.]*$/i;
      result = patt.test(acc_no);
      result == false ? $('#ordervalue').val(acc_no.replace(/[^0-9\.]/ig,'')) : null;
    }
  });  
});
$(function() {
	$("#dp2").datepicker({ 
				maxDate: new Date, 
				maxDate: '0',				
				minDate: new Date(2013, 6, 12),
				onSelect: function(dateText, inst) {
					 if(dateText >= (new Date() - 3*24*60*60*1000)) {
					  alert('Please allow upto 72 hours for your cashback to track. If it does not track in your <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?> account within 72 hours, you should raise a Missing Cashback Ticket. Our customer care team shall help resolve this for you at the earliest.');
						 $('#store').empty();
						 $('#store').append($('<option>', { value: "", text : "--Select--" }));
						 //$("#details_section").children("ul.child").remove();
						// $('#exit_id').val('');

					  return false;
					 }  
					
					hideTransationerror();
					 $.ajax({
						type: "POST",
						url: "<?php echo base_url();?>cashback/ajaxcall",
						data :'date='+dateText,
						cache: false,
						dataType:"JSON",
						success: function(result)
						{
							if(result!="")
							{
								$('#err_hidden').val(1);
								var s=0;
								$('#store option[value!=""]').remove();
								 $.each(result, function() {
									 var items = result[s];			 
									 $("#store").append("<option value=\""+items['store_name']+"\">"+items['store_name']+"</option>");
									 s++;
								  });
								  	
								$("#collapse-1").attr('class', 'panel-collapse collapse');	
								$("#collapse-2").attr('class', 'panel-collapse collapse in');
								$("#collapse-2").attr('style', '')
								return false;
							}
							else
							{
								ShowTransactionDateError();
								$('#err_hidden').val(0);
								return false;
							}							
						}
					});
						
				} 
	});
	

  
   $( document ).ajaxStart(function() {
   $('#page_loading').show();
  });
	
});
	
function ShowTransactionDateError() {
$("#dp2").next('p.error').remove();
$("#dp2").after("<p class='txt error'>Sorry, we don't see any clicks from your account on this date. Please select a valid date of transaction</p>");
 $('#store').empty();
 $('#err_hidden').val(0);
 $('#store').append($('<option>', { value: "", text : "--Select--" }));
 $('#tbl1 tr:not(:first)').remove();
}

function hideTransationerror()
{
	$("#dp2").next('p.error').remove();
}

function get_click_details_ajax(click_store)
{
	var dateText = $("#dp2").val();
	$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>cashback/get_clicked_store_details",
						data :'date='+dateText+'&click_store='+click_store,
						cache: false,
						success: function(result)
						{
							
							if(result!="")
							{
								$('#err_hidden').val(2);
								 //$('#tbl1 tr').last().after(result);
								$('#tbls').html(result);
								$("#collapse-2").attr('class', 'panel-collapse collapse');	
								$("#collapse-3").attr('class', 'panel-collapse collapse in');	
								$("#collapse-3").attr('style', '');				  
								//return false;
							}
							else
							{
								ShowTransactionDateError();
								$('#err_hidden').val(0);
								return false;
							}							
						}
					});
}

function final_step(stepid)
{
	$('#hid_click_id').val(stepid);
	$('#err_hidden').val(3);
	$("#collapse-3").attr('class', 'panel-collapse collapse');	
	$("#collapse-4").attr('class', 'panel-collapse collapse in');	
	$("#collapse-4").attr('style', '');	
}

function CheckFileType(ctlFileName) {
    strFileName = ctlFileName.value;
    var strFN = new String(strFileName);
    var aryFN = Array();
    aryFN = strFN.split(".");
    var strExt = new String(aryFN[aryFN.length-1]);
    strExt = strExt.toLowerCase();
    if (strExt !== 'png' && strExt !== 'jpg' && strExt !== 'jpeg'
        && strExt !== 'gif' && strExt !== 'pdf') {
        ctlFileName.value='';
        show_errors(ctlFileName,'Please select image file.');
        return false;
    }
    
    // 5 MB  = 5242880
    if(ctlFileName.files[0].size > 5242880) {
      ctlFileName.value='';
      show_errors(ctlFileName,'File size is large, Select below 5MB.');
      return false;
    }
    
    hide_errors(ctlFileName);
    return true;
}		
function show_errors(obj,error){
  //$("#errors_set").addClass('error_b');
  $("#errors_set").html(error);
}
function hide_errors(obj){
 // $("#errors_set").removeClass('error_b');
  $("#errors_set").html('');
}


function serial_missing_cashback_submit()
{
	var err_hidden = $('#err_hidden').val();
	if(err_hidden==3)
	{
		$("#serial_missing_cashback").submit();
		return true;
	}
	else
	{
		$("#collapse-4").attr('class', 'panel-collapse collapse');	
		$("#collapse-1").attr('class', 'panel-collapse collapse in');
		$("#collapse-1").attr('style', '');			
		ShowTransactionDateError();
		return false;
	}
}
</script>
</body>
</html>
