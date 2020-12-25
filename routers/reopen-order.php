<?php
include '../includes/connect.php';
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['reopen'])) {
        $item_id = $_POST['itemid'];
        $val = $_POST['reopen'];
        $valtwo = 'Yet to be delivered';
        $sql = "UPDATE orders SET deleted = '$val', status = '$valtwo' WHERE id = '$item_id';";
        $con->query($sql);
        echo '<script>Materialize.toast("Order re-open", 8000);</script>';
        header("location: ../all-orders.php");
    } else {
        echo '<script>Materialize.toast("Item could not be updated", 8000);</script>';
    }
}
?>