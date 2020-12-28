<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['editid'])) {
        $editid = $_POST['editid'];
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
            if (preg_match("/[0-9]+_typeone/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typeone = '$value' WHERE id = '$key';";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_one/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET onee = '$value' WHERE id = '$key';";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type2/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type2 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_two/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET two = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type3/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type3 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_three/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET three = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type4/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type4 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_four/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET four = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type5/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type5 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_five/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET five = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type6/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type6 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_six/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET six = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type7/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type7 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_seven/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET seven = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type8/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type8 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_eight/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET eight = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type9/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type9 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_nine/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET nine = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_type10/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET type10 = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_ten/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET ten = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_typeeleven/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typeeleven = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_eleven/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET eleven = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_typetwelve/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typetwelve = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_twelve/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET twelve = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_typethirteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typethirteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_thirteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET thirteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_typefourteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typefourteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_fourteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET fourteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_typefifteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typefifteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_fifteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET fifteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_typesixteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET typesixteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
            if (preg_match("/[0-9]+_sixteen/", $key)) {
                $key = strtok($key, '_');
                $sql = "UPDATE items SET sixteen = '$value' WHERE id = $key;";
                $con->query($sql);
            }
        }

        header("location: ../restaurant-menu.php#$editid");
    }
}
?>