<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['category1'])) {
        foreach ($_POST as $key => $value) {
            if (preg_match("/[0-9]+_name/", $key)) {
                if ($value != '') {
                    $key = strtok($key, '_');
                    $value = htmlspecialchars($value);
                    $sql = "UPDATE items SET name = '$value' WHERE id = '$key';";
                    $con->query($sql);
                }
            }
            if (preg_match("/[0-9]+_price/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET price = $value WHERE id = '$key';";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_description/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET description = '$value' WHERE id = '$key';";
                $con->query($sql);
            }
        }

        header("location: ../restaurant.php");
    }
}
?>