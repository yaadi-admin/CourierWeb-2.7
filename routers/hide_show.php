<?php
include '../includes/connect.php';

$item_id = $_GET['item_id'];
echo $item_id;

if(isset($_POST['hide_show'])){
    $val = $_POST['hide_show'];
    echo $val;

    $sql = "UPDATE items SET deleted = '$val' WHERE id = '$item_id';";
    $con->query($sql);
    header("location: ../restaurant.php#$item_id");
}
if(isset($_POST['category'])){
    $val = $_POST['category'];
    echo $val;

    $sql = "UPDATE items SET category = '$val' WHERE id = '$item_id';";
    $con->query($sql);
    header("location: ../restaurant.php#$item_id");
}
else {
    header("location: ../restaurant.php#$item_id");
}
?>