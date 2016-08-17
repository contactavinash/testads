<?php

$this->db->where('admin_id','1');
$admin_det = $this->db->get('admin'); 
		$admin = $admin_det->row();
			 
		 $merchant_key = $admin->merchant_key;
		 $merchant_salt = $admin->merchant_salt;
		 $merchant_id = $admin->merchant_id;
		 $payment_mode = $admin->payment_mode;

// Merchant key here as provided by Payu
$MERCHANT_KEY = $merchant_key;


// Merchant product info.
// Populate name, merchantId, description, value, commission parameters as per your code logic; in case of multiple splits pass multiple json objects in paymentParts
$firstSplitArr = array("name"=>"splitID1", "value"=>"6", "merchantId"=>$merchant_id, "description"=>"test description", "commission"=>"2");
$paymentPartsArr = array($firstSplitArr);	
$finalInputArr = array("paymentParts" => $paymentPartsArr);
$Prod_info = json_encode($finalInputArr);
//var_dump($Prod_info);

// Merchant Salt as provided by Payu
$SALT = $merchant_salt;

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";

if($payment_mode==1)
{	
	$PAYU_BASE_URL = "https://secure.payu.in";	
}
else
{
	$PAYU_BASE_URL = "https://test.payu.in";	
}

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
        
  } 
  }

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
  
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
                  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';  
        foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
	  
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <h2></h2>
    <br/>
    <?php if($formError) { ?>
      <span style="color:red"></span>
      <br/>
      <br/>
    <?php } $user= $this->front_model->get_user();?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm" style="display:none;">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo htmlspecialchars($Prod_info); ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
		
		<tr>
          
		  <td>TxnId: </td>
          <td><input name="txnid" id="txnid" value="<?php echo (empty($posted['txnid'])) ? $txnid : $posted['txnid']; ?>" /></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($posted['amount'])) ? $this->session->userdata('sub_tot') : $posted['amount'] ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo $user->first_name; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo $user->email; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo $user->contact_no; ?>" /></td>
        </tr>
        
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php  echo  base_url(); ?>index.php/cashback/Payment_Success" size="64" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php  echo  base_url(); ?>index.php/cashback/Payment_Failure" size="64" /></td>
        </tr>

        <tr>
          <td>Service Provider: </td>
          <td colspan="3"><input name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? $this->session->userdata('hash_new') : $posted['lastname']; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl" value="" /></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input name="address1" value="<?php echo (empty($posted['address1'])) ? $this->session->userdata('hash_new') : $posted['address1']; ?>" /></td>
          <td>Address2: </td>
          <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? $this->session->userdata('hash_new') : $posted['address2']; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo (empty($posted['city'])) ? $this->session->userdata('hash_new') : $posted['city']; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo (empty($posted['state'])) ? $this->session->userdata('hash_new') : $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($posted['country'])) ? $this->session->userdata('hash_new') : $posted['country']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? $this->session->userdata('hash_new') : $posted['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? $this->session->userdata('hash_new') : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? $this->session->userdata('hash_new') : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? $this->session->userdata('hash_new') : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? $this->session->userdata('hash_new') : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? $this->session->userdata('hash_new') : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? $this->session->userdata('hash_new') : $posted['pg']; ?>" /></td>
        </tr>
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
			
          <?php } ?>
        </tr>
      </table>
    </form>
	<script>
document.getElementById("payuForm").submit();
	</script>
  </body>
</html>
