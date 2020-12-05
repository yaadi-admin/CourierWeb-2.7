<?php
include '../includes/connect.php';
$opencloser = "";
$openclose = mysqli_query($con, "SELECT * FROM incumbency WHERE id= 1");
while ($row = mysqli_fetch_array($openclose)) {
$opencloser = $row['admission'];
}

if ($opencloser == 0) {
    $success = false;
    if (isset($_POST['contact'])) {
        $username = $_POST['contact'];
        $password = $_POST['password'];
        $date = date('Y-m-d');
        $hash = password_hash($password, PASSWORD_BCRYPT);

// check to see if user is a restaurant and if values match...
        $result = mysqli_query($con, "SELECT * FROM users WHERE contact='$username' AND role='Restaurant' AND not deleted;");

        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username) == false || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password) == false) {

            while ($row = mysqli_fetch_array($result)) {
                if (password_verify($password, $row['password'])) {
                    $success = true;
                    $user_id = $row['id'];
                    $name = $row['name'];
                    $role = $row['role'];
                } else {
                    echo 'Something is not quiet right here....!';
                }
            }
        }

// if Restaurant success is true...
        if ($success == true) {
//            $lifetime=14400000;
            session_start();
//            setcookie(session_name(),session_id(),time()+$lifetime);
            $_SESSION['restaurant_sid'] = session_id();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;
            echo '<div class="progress"><div class="indeterminate"></div></div>';
            echo "<script>document.location.href='../restaurant.php';</script>";
        }
// End restaurant check....


// Start other Checks
        else {
//    check to see if user is a Customer and if values match...
            $result = mysqli_query($con, "SELECT * FROM users WHERE contact='$username' AND role='Customer' AND not deleted;");
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username) == false || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password) == false) {
                while ($row = mysqli_fetch_array($result)) {
                    if (password_verify($password, $row['password'])) {
                        $success = true;
                        $user_id = $row['id'];
                        $name = $row['name'];
                        $role = $row['role'];
                    } else {
                        echo 'Something is not quiet right here....!';
                    }
                }
            }

//    if Customer success is true...
            if ($success == true) {
                session_start();
                $_SESSION['customer_sid'] = session_id();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role;
                $_SESSION['name'] = $name;
                echo '<div class="progress"><div class="indeterminate"></div></div>';

                echo "<script>document.location.href='../deliverto.php';</script>";
            } else {
//    check to see if user is a Rider and if values match...
                $result = mysqli_query($con, "SELECT * FROM users WHERE contact='$username' AND (role='Rider' OR role='Delivery') AND not deleted;");
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username) == false || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password) == false) {
                    while ($row = mysqli_fetch_array($result)) {
                        if (password_verify($password, $row['password'])) {
                            $success = true;
                            $user_id = $row['id'];
                            $name = $row['name'];
                            $role = $row['role'];
                        } else {
                            echo 'Something is not quiet right here....!';
                        }
                    }
                }

//    if Rider success is true...
                if ($success == true) {
                    session_start();
                    $_SESSION['delivery_sid'] = session_id();
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['role'] = $role;
                    $_SESSION['name'] = $name;
                    echo '<div class="progress"><div class="indeterminate"></div></div>';
                    echo "<script>document.location.href='../delivery-dashboard.php';</script>";
                }
            }
        }
// Default....
        echo "<script>Materialize.toast('Login credentials do not match. TRY AGAIN', 4000);</script>";
    }
}
elseif ($opencloser == 1){
    echo "<script>Materialize.toast('Logins are closed momentarily. We apologize for the inconvenience', 4000);</script>";
    echo "<script>document.location.href='../login.php';</script>";
}
?>