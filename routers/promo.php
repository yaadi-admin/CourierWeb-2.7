<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['promomsg']) && $_POST['promomsg'] != '') {

        $id = "";
        $msg = $_POST['promomsg'];
        $result = mysqli_query($con, "SELECT * FROM users WHERE name='$name';");
        while($row = mysqli_fetch_array($result))
        {
            $id = $row['id'];
        }
        $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
        $date->setTimezone(new DateTimeZone('America/Jamaica'));
        $timestamp = $date->format('Y-m-d H:i:sP');
        $url = $_SERVER['REQUEST_URI'];
        $action = "Sent promo message: $msg";
        $sql = "INSERT INTO timeline (user_id, action, url, date) VALUES ('$id', '$action', '$url', '$timestamp')";
        $con->query($sql);

        $gettarget = mysqli_query($con, "SELECT * FROM users WHERE (role='Customer' AND email not LIKE '') AND not deleted;");
        while($row1 = mysqli_fetch_array($gettarget))
        {


                $phone = $row1['contact'];
                $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
                $auth_token = '64b73f721643ba5f3b3630b75b792116';
                $twilio_number = "+12029145139";
                $client = new Client($account_sid, $auth_token);
                $client->messages->create(
                    $phone,
                    array(
                        'from' => $twilio_number,
                        'body' => ''.$msg.''));
                echo '<script>alert("Promotion message sent");</script>';
                echo '<script>window.location=" ../am_adv.php"</script>';

        }

    }
    else{
        echo '<script>alert("Promotion message NOT sent: Error while sending....");</script>';
        echo '<script>window.location=" ../am_adv.php"</script>';
    }
}
else{
    header("location:login.php");
}
?>