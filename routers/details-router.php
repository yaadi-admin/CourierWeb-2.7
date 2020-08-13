<?php
include '../includes/connect.php';
$user_id = $_SESSION['user_id'];


$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password =  htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];
$email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);
$hash = password_hash($password, PASSWORD_BCRYPT);
$sql = "UPDATE users SET name = '$name', username = '$username', password='$hash', contact=$phone, email='$email', address='$address' WHERE id = $user_id;";
if($con->query($sql)==true){
	$_SESSION['name'] = $name;
}
header("location: ../details.php");
?>