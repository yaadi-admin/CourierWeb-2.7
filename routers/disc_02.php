<?php
include '../includes/connect.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['open']) && isset($_POST['close'])) {
            $key = $_POST['id'];
            $open = $_POST['open'];
            $close = $_POST['close'];
            $sql = "UPDATE users SET mon = '$open' WHERE id = $key;";
            $con->query($sql);
        echo "<script>Materialize.toast('Opening time changed successfully 😋', 8000);</script>";
            $sql = "UPDATE users SET monc = '$close' WHERE id = $key;";
            $con->query($sql);
        echo "<script>Materialize.toast('Closing time changed successfully 😋', 8000);</script>";

    }
}
?>