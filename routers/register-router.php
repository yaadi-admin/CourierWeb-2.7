<?php
include '../includes/connect.php';
if (isset($_POST['phone'])) {
    $name = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);
    $date = date('Y-m-d');
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hsh = password_hash($password, PASSWORD_BCRYPT);
    $success = false;
    function number($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    if ($_POST['name'] && $_POST['phone'] != '') {
        $count = 0;
        $check = mysqli_query($con, "SELECT * FROM users WHERE contact='$phone' AND role='Customer' AND not deleted;");
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $phone) == false || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password) == false) {
            while ($row = mysqli_fetch_array($check)) {
                $count++;
                if ($count != '0') {
                    echo "<script>Materialize.toast('Account already exist <button>Reset</button>', 8000);</script>";
                }
            }
        }
                if ($count == '0') {
                    $sql = "INSERT INTO users (name, email, password, contact, verified) VALUES ('$name', '$email', '$hsh', '$phone', 1);";
                    if ($con->query($sql) == true) {
                        $user_id = $con->insert_id;
                        $sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
                        if ($con->query($sql) == true) {
                            $wallet_id = $con->insert_id;
                            $cc_number = number(16);
                            $cvv_number = number(3);
                            $sql = "INSERT INTO wallet_details(wallet_id, number, cvv) VALUES ($wallet_id, $cc_number, $cvv_number)";
                            $con->query($sql);

                            $lognusr = mysqli_query($con, "SELECT * FROM users WHERE contact='$phone' AND role='Customer' AND not deleted;");
                            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $phone) == false || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password) == false) {
                                while ($row = mysqli_fetch_array($lognusr)) {
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
                            if ($success == true) {
                                session_start();
                                $_SESSION['customer_sid'] = session_id();
                                $_SESSION['user_id'] = $user_id;
                                $_SESSION['role'] = $role;
                                $_SESSION['name'] = $name;
                                echo "<script>Materialize.toast('Account successfully created, Welcome to Yaadi', 4000);</script>";
                                echo '<div class="progress"><div class="indeterminate"></div></div>';
                                $to = 'yaadiltd@gmail.com';
                                $subject = '' . $name . ' Registered';
                                $message = '<html>
<head>
  <title>' . $name . ' Registered</title>
</head>
<body>
  <p>' . $name . ' Registered A New Account</p>
  <table cellspacing="0" style="border: 1px solid #bbb; width: 100%;"> 
            <tr> 
                <th>Customer: ' . $name . '</th> 
            </tr> 
            <tr style="background-color: #bbb"> 
                <th>' . $phone . '</td> 
            </tr> 
            
            <tr style="background-color: #bbb"> 
                <th>' . $date . '</td> 
            </tr> 
            <tr> 
                <th>GOTO:</th><td><a href="https://www.yaadi.co">Yaadi</a></td> 
            </tr> 
    </table> 
</body>
</html>
';
                                $headers[] = 'MIME-Version: 1.0';
                                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                                $headers[] = 'From: <register@yaadi.co>';
                                mail($to, $subject, $message, implode("\r\n", $headers));
                                echo "<script>document.location.href='../deliverto.php';</script>";
                            }
                        }
                    }
                }
    }
}
?>