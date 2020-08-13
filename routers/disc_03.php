<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
$customer_ph = $_GET['phone'];
$order = $_GET['order'];
$paylink = htmlspecialchars($_POST["custom-promo"]);
$account_sid = 'AC8f235f78aa51cec01909115165e27a90';
$auth_token = '64b73f721643ba5f3b3630b75b792116';
$twilio_number = "+12029145139";
$client = new Client($account_sid, $auth_token);
$csurph = $customer_ph;
echo $customer_ph;
$client->messages->create(
    $csurph,
    array(
        'from' => $twilio_number,
        'body' => ''.$paylink.'
#Yaadi.Co, #PaymentLink
'));
echo '<script>alert("TPayment link sent");</script>';
echo '<script>window.location=" ../all-orders.php#'.$order.'"</script>';
?>