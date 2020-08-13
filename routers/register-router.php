<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);
$date = date('Y-m-d');
$phone = $_POST['phone'];
$hsh = password_hash($password, PASSWORD_BCRYPT);
function number($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}
if($_POST['name'] && $_POST['phone'] != '') {

    $sql = "INSERT INTO users (name, password, contact, verified) VALUES ('$name', '$hsh', '$phone', 1);";
    if ($con->query($sql) == true) {
        $user_id = $con->insert_id;
        $sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
        if ($con->query($sql) == true) {
            $wallet_id = $con->insert_id;
            $cc_number = number(16);
            $cvv_number = number(3);
            $sql = "INSERT INTO wallet_details(wallet_id, number, cvv) VALUES ($wallet_id, $cc_number, $cvv_number)";
            $con->query($sql);
        }


        $to = 'yaadiltd@gmail.com';
        $subject = '' . $name . ' Registered';
        $message = '<html>
<head>
  <title>' . $name . ' Registered</title>
</head>
<body>
  <p>' . $name . ' Registered A New Account</p>
  <table cellspacing="0" style="border: 1px solid #bbb; width: 100%;"> 
            <tr> 
                <th>Customer: ' . $name . '</th> 
            </tr> 
            <tr style="background-color: #bbb"> 
                <th>' . $phone . '</td> 
            </tr> 
            
            <tr style="background-color: #bbb"> 
                <th>' . $date . '</td> 
            </tr> 
            <tr> 
                <th>GOTO:</th><td><a href="https://www.yaadi.co">Yaadi</a></td> 
            </tr> 
    </table> 
</body>
</html>
';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: <register@yaadi.co>';
        mail($to, $subject, $message, implode("\r\n", $headers));
    }
    echo '<script>alert("Account Created! \nWelcome to Yaadi, Please log in.");</script>';
    echo '<script>window.location=" ../login.php"</script>';
}
?>