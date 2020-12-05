<?php
include '../includes/connect.php';
if($_SESSION['customer_sid']==session_id()) {
    if (isset($_POST['rest'])) {
        $user_id = $_SESSION['user_id'];
        $rest = $_POST['rest'];
        $result = mysqli_query($con, "SELECT * FROM users WHERE name = '$rest'");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row["id"];
            header("location: ../category.php?pgid='$id'");
        }
    }
}

?>