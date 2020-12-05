<?php
session_start();
$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "dbyaadi";
$name = $_SESSION['name'];
$role = $_SESSION['role'];
$con = new mysqli($servername, $server_user, $server_pass, $dbname);

//// Check connection
//if ($con) {
//    
//    echo "Successfully connected to the database.";
//}
//else{
//    die("Connection failed.");
//} 
//
//$con->close();

?>