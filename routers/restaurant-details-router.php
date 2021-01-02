<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if(isset($_POST['Nm'])) {
        $userdetails = mysqli_query($con, "SELECT * FROM users WHERE name= '$name' AND not deleted;");
        while($row = mysqli_fetch_array($userdetails))
        {
            if (password_verify($_POST['Pc'], $row['password'])) {
                $user_id = $_SESSION['user_id'];
                $name = htmlspecialchars($_POST['Nm']);
                $password = htmlspecialchars($_POST['Pc']);
                $phone = $_POST['Pnn'];
                $email = htmlspecialchars($_POST['Em']);
                $address = htmlspecialchars($_POST['Ad']);
                $phone_n1 = $_POST['Pnnt'];
                $sql = "UPDATE users SET name = '$name', username = '$username', contact=$phone, notphone='$phone_n1', email='$email', address='$address' WHERE id = $user_id";
                if ($con->query($sql) == true) {
                    $_SESSION['name'] = $name;
                }
            } else {
                echo "<script>Materialize.toast('Password did not match, try again....!', 5000);</script>";
            }
        }
    }
}
?>