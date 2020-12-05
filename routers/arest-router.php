<?php
include '../includes/connect.php';
if($_SESSION['admin_sid']==session_id()) {
    foreach ($_POST as $key => $value) {
        if (preg_match("/[0-9]+_role/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET role = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_verified/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET verified = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_opentime/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET opentime = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_password/", $key)) {
            $key = strtok($key, '_');
            $hsh = password_hash($value, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET password = '$hsh' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_email/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET email = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_address/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET address = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_contact/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET contact = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_ocassion/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET ocassion = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_deleted/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET deleted = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_verified/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET verified = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_mondayopen/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET mon = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_mondayclose/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET monc = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_longitude/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET ulong = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_latitude/", $key)) {
            $key = strtok($key, '_');
            $sql = "UPDATE users SET ulat = '$value' WHERE id = $key;";
            $con->query($sql);
        }
        if (preg_match("/[0-9]+_balance/", $key)) {
            $key = strtok($key, '_');
            $result = mysqli_query($con, "SELECT * from wallet WHERE customer_id = $key;");
            if ($row = mysqli_fetch_array($result)) {
                $wallet_id = $row['id'];
                $sql = "UPDATE wallet_details SET balance = '$value' WHERE wallet_id = $wallet_id;";
                $con->query($sql);
            }
        }
    }
    header("location: ../am_rest.php");
}
?>