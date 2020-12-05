<?php
include '../includes/connect.php';
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['admission'])) {
        $val = $_POST['admission'];
        $sql = "UPDATE incumbency SET admission = '$val' WHERE id = 2;";
        $con->query($sql);
    }

    echo '<script>alert("Ordering enabled");</script>';
    echo "<script>document.location.href='../all-orders.php';</script>";
}

?>