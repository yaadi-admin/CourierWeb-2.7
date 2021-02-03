<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['hide_show'])) {
        $item_id = $_POST['item'];
        $val = $_POST['hide_show'];
        $sql = "UPDATE items SET deleted = '$val' WHERE id = '$item_id';";
        $con->query($sql);
        header("location: ../restaurant.php#$item_id");
    }
    if (isset($_POST['category'])) {
        $item_id = $_POST['item'];
        $val = $_POST['category'];
        $sql = "UPDATE items SET category = '$val' WHERE id = '$item_id';";
        $con->query($sql);
        header("location: ../restaurant-menu.php#$item_id");
    } else {
        header("location: ../restaurant-menu.php#$item_id");
    }
}