<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
$customer_ph = "";

$promo = htmlspecialchars($_POST["globalpush"]);
$account_sid = 'AC8f235f78aa51cec01909115165e27a90';
$auth_token = '64b73f721643ba5f3b3630b75b792116';
$twilio_number = "+12029145139";
$client = new Client($account_sid, $auth_token);

$sql = mysqli_query($con, "SELECT * FROM users WHERE role='Customer' AND not deleted;");
while($row = mysqli_fetch_array($sql)){
$customer_ph = $row['contact'];

    $csurph = $customer_ph;
    echo $customer_ph;

    if ($customer_ph != 0 || $customer_ph != "") {

        $client->messages->create(
            $csurph,
            array(
                'from' => $twilio_number,
                'body' => '' . $promo . '
                #yaadi.co, #adverts'));

        echo '<script>alert("Push notification sent to all valid customer contacts.");</script>';
        echo '<script>window.location=" ../am_adv.php"</script>';
    }
    else {
        echo '<script>alert("There was an error sending push notification, please try again.");</script>';
        echo '<script>window.location=" ../am_adv.php"</script>';
    }

}






?>