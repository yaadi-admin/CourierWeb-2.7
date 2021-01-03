<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['phoneto']) && isset($_POST['custommsg'])) {
        $customer_ph = $_POST['phoneto'];
        $order = $_POST['orderid'];
        $message = htmlspecialchars($_POST["custommsg"]);
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $customer_ph,
            array(
                'from' => $twilio_number,
                'body' => ''. $message .' => #Orders@Yaadi'));
        $result = mysqli_query($con, "SELECT * FROM users WHERE name='$name';");
        $id = "";
        while($row = mysqli_fetch_array($result))
        {
            $id = $row['id'];
        }
        $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
        $date->setTimezone(new DateTimeZone('America/Jamaica'));
        $timestamp = $date->format('Y-m-d H:i:sP');
        $url = $_SERVER['REQUEST_URI'];
        $action = "Viewed all Orders";
        $sql = "INSERT INTO timeline (user_id, action, url, date) VALUES ('$id', '$action', '$url', '$timestamp')";
        $con->query($sql);

        echo "<script>Materialize.toast('Message sent successfully 😋', 8000);</script>";
    }
}
?>