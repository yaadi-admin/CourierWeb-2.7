<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;

$status = $_POST['status'];
$id = $_POST['id'];
$customer_id = $_GET['cos'];

$sql = "UPDATE orders SET status='$status' WHERE id=$id;";
$con->query($sql);



$account_sid = 'AC8f235f78aa51cec01909115165e27a90';
$auth_token = '64b73f721643ba5f3b3630b75b792116';
$twilio_number = "+12029145139";
$client = new Client($account_sid, $auth_token);


$csurph = "";
 $sqlu = mysqli_query($con, "SELECT * FROM orders WHERE id= $id AND not deleted;");
  while($row = mysqli_fetch_array($sqlu))
 {

 $customer_id = $row["customer_id"];
  }
 $sql3u = mysqli_query($con, "SELECT * FROM users WHERE id= $customer_id AND not deleted;");
while($row = mysqli_fetch_array($sql3u))
{
$phone = $row["contact"];
$csurph = $phone;
}

echo $customer_id;
echo $csurph;

$client->messages->create(
$csurph,
array(
'from' => $twilio_number,
'body' => 'Yaadi® | ORDER | #'.$id.' |
Status: => '.$status.'
'));

header("location: ../restaurant-orders.php");
?>