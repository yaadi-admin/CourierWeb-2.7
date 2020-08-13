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
//echo $phone;

$result = mysqli_query($con, "SELECT * FROM users WHERE contact='$phone' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
        
        $temphold = $row["contact"];
	}

echo $temphold;

if ($temphold == "") {
echo '<script>alert("Number not in system! \nTry Either 1876XXXXXXX OR 876XXXXXXX");</script>';
echo '<script>window.location=" ../for_pw.php"</script>'; 
}

else{
$dfp = '@Yaadi12';
$hsh = password_hash($dfp, PASSWORD_BCRYPT);
$sql = "UPDATE users SET password = '$hsh' WHERE contact='$phone' AND not deleted;";
$con->query($sql);    
$client->messages->create(
$temphold,
array(
'from' => $twilio_number,
'body' => 'YAADI® | PASSWORD | WWW.YAADI.CO |
Your New Password: @Yaadi12
Remember to change Your password after logging in. :)'));
    
$to = 'yaadiltd@gmail.com';
$subject = 'New Password Request';
$message = '
<html>
<head>
  <title>New Password Request</title>
</head>
<body>
  <p>Password change Request</p>
  <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
            <tr> 
                <th>Use the phone number to identify and reset customer password.</th> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Contact Number:</th><td>'.$phone.'</td> 
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
echo '<script>alert("Request sent successfully! \nPlease await your YAADI.CO text message!");</script>'; 
echo '<script>window.location=" ../login.php"</script>';    
}
?>