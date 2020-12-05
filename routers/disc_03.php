<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['phoneto'])) {
        $customer_ph = $_POST['phoneto'];
        $order = $_POST['orderid'];
        $message = htmlspecialchars($_POST["custom-promo"]);
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        echo $customer_ph;
        $client->messages->create(
            $customer_ph,
            array(
                'from' => $twilio_number,
                'body' => ''. $message .' => #Orders@Yaadi.Co'));
        echo '<script>alert("Message sent");</script>';
        echo '<script>window.location=" ../all-orders.php#' . $order . '"</script>';
    }
}
?>