<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
$account_sid = 'AC8f235f78aa51cec01909115165e27a90';
$auth_token = '64b73f721643ba5f3b3630b75b792116';
$twilio_number = "+12029145139";
$client = new Client($account_sid, $auth_token);
$phone = $_POST["phone"];
$temphold = "";
if (isset($_POST["phone"])) {
    $result = mysqli_query($con, "SELECT * FROM users WHERE contact='$phone' AND not deleted;");
    while ($row = mysqli_fetch_array($result)) {

        $temphold = $row["contact"];
    }

    if ($temphold == "") {
        echo '<script>Materialize.toast("Account not found! Try Either 1876XXXXXXX OR 876XXXXXXX", 10000);</script>';
    } else {
        $dfp = 'Yaadi20';
        $hsh = password_hash($dfp, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password = '$hsh' WHERE contact='$phone' AND not deleted;";
        $con->query($sql);
        $client->messages->create(
                    $temphold,
                    array(
                        'from' => $twilio_number,
                        'body' => 'Your new password is => Yaadi20 (change password after login)'));

        $to = 'yaadiltd@gmail.com';
        $subject = 'New Password Request';
        $message = '
<html>
<head>
  <title>New Password Requested</title>
</head>
<body>
  <p>Password change Requested</p>
  <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
            <tr> 
                <th>This number requested a password reset, reset was confirmed and password was sent to the user.</th> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Contact Number:</th><td>' . $phone . '</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="https://www.yaadi.co">www.yaadi.co</a></td> 
            </tr> 
    </table> 
</body>
</html>
';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: <support@yaadi.co>';
        mail($to, $subject, $message, implode("\r\n", $headers));
        echo '<script>Materialize.toast("Reset complete! Please check your phone", 10000);</script>';
    }
}
?>