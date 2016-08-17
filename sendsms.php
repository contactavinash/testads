<?php
require('textlocal.class.php');
$textlocal = new Textlocal('george@achadiscount.in', 'Gkm12345');
$numbers = array(919629291354);
$sender = urlencode('TXTLCL');
$message = 'Hi sir Message from Alldiscountsale';

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    print_r($result);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>