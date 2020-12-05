<?php
include '../includes/connect.php';
if($_SESSION['customer_sid']==session_id()) {
    if(isset($_POST['addemail'])) {
        $user_id = $_SESSION['user_id'];
        $email = htmlspecialchars($_POST['addemail']);
        $sql = "UPDATE users SET email='$email'WHERE id = $user_id;";
        if ($con->query($sql) == true) {
            header("location: ../index.php");
        }
    }

    if(isset($_POST['addaddress']) && $_POST['addaddress'] !== ' ') {
        $user_id = $_SESSION['user_id'];
        $address = htmlspecialchars($_POST['addaddress']);
        $sql = "UPDATE users SET address='$address'WHERE id = $user_id;";
        if ($con->query($sql) == true) {
            echo '<div class="progress"><div class="indeterminate"></div></div>';
            echo "<script>document.location.href='../index.php';</script>";
        }
        else{
            Materialize.toast('Address was not added. TRY AGAIN', 4000);
        }
    }
    else{
        Materialize.toast('Address was not added. TRY AGAIN', 4000);
    }

}

?>