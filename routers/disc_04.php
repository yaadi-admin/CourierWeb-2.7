<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
$customer_ph = $_GET['phone'];

$account_sid = 'AC8f235f78aa51cec01909115165e27a90';
$auth_token = '64b73f721643ba5f3b3630b75b792116';
$twilio_number = "+12029145139";
$client = new Client($account_sid, $auth_token);

$csurph = $customer_ph;


$client->messages->create(
$csurph,
array(
'from' => $twilio_number,
'body' => 'YAADI® | PROMOTIONS™ | FOOD |
Yow!, You just got a 10% discount!
ON "www.yaadi.co/"
AnyWhere | AnyTime | OnLine!
'));

header("location: ../am_adv.php");

?>