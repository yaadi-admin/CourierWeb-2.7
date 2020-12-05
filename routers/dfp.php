<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['dfp'])) {
        $customer_ph = $_POST['dfp'];
        $cus_id = $_POST['dfpd'];
        $dfp = '@Yaadi12';
        $hsh = password_hash($dfp, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password = '$hsh' WHERE id = $cus_id ;";
        $con->query($sql);
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $customer_ph,
            array(
                'from' => $twilio_number,
                'body' => 'Yaadi.Co => Password Reset. Your New Password is: @Yaadi12 :)'));
        echo '<script>alert("Password reset complete, the user was notified!");</script>';
        echo '<script>window.location=" ../am_pa.php"</script>';
    }
}
?>