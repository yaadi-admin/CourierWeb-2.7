<?php
include '../includes/connect.php';
if($_SESSION['customer_sid']==session_id()) {
    if (isset($_POST['address'])) {
        $user_id = $_SESSION['user_id'];
        $address = htmlspecialchars($_POST['address']);
        $resid = htmlspecialchars($_POST['rest']);
        $sql = "UPDATE users SET address='$address' WHERE id = $user_id;";
        if ($con->query($sql) == true) {
            $_SESSION['name'] = $name;
        }
        header("location: ../place-order.php?pgid=$resid");
    }
}
?>