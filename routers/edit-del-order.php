<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['delivery_sid']==session_id()) {
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $id = $_POST['id'];
        $csurph = "";
        $sql = "UPDATE orders SET status='$status' WHERE id=$id;";
        $con->query($sql);
        $sqlu = mysqli_query($con, "SELECT * FROM orders WHERE id= $id AND not deleted;");
        while ($row = mysqli_fetch_array($sqlu)) {
            $customer_id = $row["customer_id"];
        }
        $sql3u = mysqli_query($con, "SELECT * FROM users WHERE id= $customer_id AND not deleted;");
        while ($row = mysqli_fetch_array($sql3u)) {
            $phone = $row["contact"];
            $csurph = $phone;
        }
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $csurph,
            array(
                'from' => $twilio_number,
                'body' => 'Yaadi.Co ORDER #' . $id . ' =>
Status: => ' . $status . ''));

        header("location: ../delivery-dashboard.php#$id");
    }
}
?>