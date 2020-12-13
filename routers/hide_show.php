<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['hide_show'])) {
        $item_id = $_POST['item'];
        $val = $_POST['hide_show'];
        $sql = "UPDATE items SET deleted = '$val' WHERE id = '$item_id';";
        $con->query($sql);
        header("location: ../restaurant.php#$item_id");
        if ($val === '0'){
            echo '<script>Materialize.toast("Item set to available", 8000);</script>';
        }
        else{
            echo '<script>Materialize.toast("Item set to not available", 8000);</script>';
        }

    }
    if (isset($_POST['category'])) {
        $item_id = $_POST['item'];
        $val = $_POST['category'];
        $sql = "UPDATE items SET category = '$val' WHERE id = '$item_id';";
        $con->query($sql);
        echo '<script>Materialize.toast("Category updated", 8000);</script>';
    } else {
        echo '<script>Materialize.toast("Item could not be updated", 8000);</script>';
    }
}
?>