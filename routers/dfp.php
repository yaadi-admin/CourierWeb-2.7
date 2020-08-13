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

$cus_id = $_GET['id'];
$dfp = '@Yaadi12';
$hsh = password_hash($dfp, PASSWORD_BCRYPT);
echo $customer_ph;
echo $cus_id;
$sql = "UPDATE users SET password = '$hsh' WHERE id = $cus_id ;";
$con->query($sql);

$client->messages->create(
$csurph,
array(
'from' => $twilio_number,
'body' => 'Yaadi.Co | Your Password was Reset.
Your New Password is: @Yaadi2020
Remember to change Your password after logging in. :)'));
echo '<script>alert("Password reset complete, the user was notified!");</script>';
echo '<script>window.location=" ../am_pa.php"</script>';
?>