<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['customer_sid']==session_id()) {
    if(isset($_POST['status'])) {
        $status = $_POST['status'];
        $id = $_POST['id'];
        $sql = "UPDATE orders SET status='$status', deleted=1 WHERE id=$id;";
        $con->query($sql);
        $sql = mysqli_query($con, "SELECT * FROM orders where id=$id");
        while ($row1 = mysqli_fetch_array($sql)) {
            $total = $row1['total'];
        }
        if ($_POST['payment_type'] == 'Wallet') {
            $balance = $balance + $total;
            $sql = "UPDATE wallet_details SET balance = $balance WHERE wallet_id = $wallet_id;";
            $con->query($sql);
        }
        $yaadi = "18763622910";
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $yaadi,
            array(
                'from' => $twilio_number,
                'body' => 'Order '.$id.' => Cancelled'));
        header("location: ../orders.php");
    }
}
?>