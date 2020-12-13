<?php
include '../includes/connect.php';
$success=false;
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $result = mysqli_query($con, "SELECT * FROM users WHERE username= '$username' AND role='Administrator' AND not deleted;");
    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($password, $row['password'])) {
            $success = true;
            $user_id = $row['id'];
            $name = $row['name'];
            $role = $row['role'];
            echo 'true';
        } else {
            echo 'Something is not quiet right here....!';
        }
    }
    if ($success == true) {
        session_start();
        $_SESSION['admin_sid'] = session_id();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        $_SESSION['name'] = $name;
        echo '<div class="progress"><div class="indeterminate"></div></div>';
        echo "<script>document.location.href='../admin.php';</script>";
    } else {

        echo "<script>Materialize.toast('Login credentials do not match. TRY AGAIN', 8000);</script>";
    }
}
?>