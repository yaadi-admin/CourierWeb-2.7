<?php
include '../includes/connect.php';
if($_SESSION['delivery_sid']==session_id()) {
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['del_assign'])) {
        $assign = $_POST['del_assign'];
        $sql = "UPDATE orders SET assignedto = '$user_id' WHERE id = $assign ;";
        $con->query($sql);
        header("location: ../delivery-dashboard.php");
    }
}
?>