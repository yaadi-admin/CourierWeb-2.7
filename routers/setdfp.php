<?php
include '../includes/connect.php';
$cus_id = $_GET['id'];
$dfp = '@Yaadi12';
$hsh = password_hash($dfp, PASSWORD_BCRYPT);
$sql = "UPDATE users SET password = '$hsh' WHERE id = $cus_id ;";
$con->query($sql);
header("location: ../am_pa.php");
?>