<?php
$admis=$this->admin_model->get_admindetails();
//echo '<pre>';
//print_r($admis);die;
$amount = $user->cashback_amount;
//echo $amount;die;
//print_r($user_details);die;
$phone= $admis->contact_number;
$email=$user_details->email;
$firstname=$admis->admin_username;

$rnumber =  date('U');

// Merchant key here as provided by Payu
  $MERCHANT_KEY = $user->payu_key;

  $SALT = $user->salt;

//echo $this->config->item('payu_mode'); die;
// End point – change to https://secure.payu.in for LIVE mode
/*if($this->config->item('payu_mode')=='0')
{
    $PAYU_BASE_URL = "https://test.payu.in";
}
else
{
    $PAYU_BASE_URL = "https://secure.payu.in";
}
*/

$PAYU_BASE_URL = "https://test.payu.in";
$action = '';

$posted = array();
if(!empty($_POST)) {
foreach($_POST as $key => $value)
 {
$posted[$key] = $value;

}
}
$formError = 0;
//print_r($posted); die;
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
// $posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
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
?><html>
<head>
<script>
var hash = '<?php echo $hash ?>';
function submitPayuForm() {
  var payuForm = document.forms.payuForm;
payuForm.submit();
if(hash == '') {
return;
}
}
</script>
</head>
<body onLoad="submitPayuForm()">
<br/>
<?php if($formError) { ?>
<!--<span style="color:red">Please fill all mandatory fields.</span>-->
<br/>
<br/>
<?php } ?>
<form action="<?php echo $action; ?>" method="post" name="payuForm">
<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
<input type="hidden" name="hash" value="<?php echo $hash ?>"/>
<input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
<input type="hidden" name="productinfo" value="dfdfdf" />
<table>
<tr>
<!--<td><b>Mandatory Parameters</b></td>-->
</tr>
<tr>

<td>
<input name="amount" value="<?php echo $amount; ?>" type="hidden"/>
</td>

<td><input name="firstname" id="firstname" value="<?php echo $firstname ?>" type="hidden" /></td>
</tr>

<tr>

<td>
<input name="email" id="email" value="<?php echo $email; ?>" type="hidden"/></td>
<td><input name="phone" value="<?php echo $phone; ?>" type="hidden"/></td>
</tr>

<tr>

<!-- <td colspan="3"><input type="hidden" value="<?php echo $user->cashback_id; ?>" name="productinfo" >  -->
</td>
</tr>

<tr>

<td colspan= "3"><input name="surl" value="<?php echo base_url()?>adminsettings/pending_cashback/approve/<?php echo $user->cashback_id;?>" size="64" type="hidden"/></td></tr>
<tr>

<td colspan="3"><input name="furl" value="<?php echo base_url()?>adminsettings/pending_cashback" size="64" type="hidden"/></td>
</tr>

<tr>

<td colspan="3">
<input name="service_provider" value="payu_paisa" size="64" type="hidden" />
</td>
</tr>
<?php if(!$hash) { ?>
<td colspan="4">
<input class="btn btn-primary btn-small" type="submit" value="Confirm Order">
</td>
<?php } ?>
</tr>
</table>

</form>
</body>
</html>
<div align="center">
  <div class="page-container">
    <div class="alert alert-info">   
      <a class="close" data-dismiss="alert">×</a>
      
      
    </div>
  </div>
</div>
