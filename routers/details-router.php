<?php
include '../includes/connect.php';
if($_SESSION['customer_sid']==session_id()) {
    if(isset($_POST['Nm'])) {
        $user_id = $_SESSION['user_id'];
        $name = htmlspecialchars($_POST['Nm']);
//        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['Pc']);
        $phone = $_POST['Pnn'];
        $email = htmlspecialchars($_POST['Em']);
        $address = htmlspecialchars($_POST['Ad']);
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET name = '$name', password='$hash', contact='$phone', email='$email', address='$address' WHERE id = $user_id;";
        if ($con->query($sql) == true) {
            $_SESSION['name'] = $name;
            echo "Successful";
        }

    }
}

?>