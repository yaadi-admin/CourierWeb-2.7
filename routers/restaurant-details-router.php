<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['name'])) {
        $user_id = $_SESSION['user_id'];
        $name = htmlspecialchars($_POST['name']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $phone = $_POST['phone'];
        $email = htmlspecialchars($_POST['email']);
        $address = htmlspecialchars($_POST['address']);
        $phone_n1 = $_POST['phone2'];
        $phone_n2 = $_POST['phone3'];
        $hsh = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET name = '$name', username = '$username', password='$hsh', contact=$phone, notphone='$phone_n1', notphone2='$phone_n2', email='$email', address='$address' WHERE id = $user_id";
        if ($con->query($sql) == true) {
            $_SESSION['name'] = $name;
        }
        header("location: ../account-page.php");
    }
}
?>