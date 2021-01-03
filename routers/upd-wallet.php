<?php
include '../includes/connect.php';
include '../includes/wallet.php';
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['useid'])) {
        $id = $_POST['useid'];
        foreach ($_POST as $key => $value) {
            if (preg_match("/[0-9]+_balance/", $key)) {
                if ($value != '') {
                    $sql = mysqli_query($con,"SELECT * from wallet WHERE customer_id = $id;");
                    if($row1 = mysqli_fetch_array($sql)){
                        $wallet_id = $row1['id'];
                        $sql1 = mysqli_query($con,"SELECT * from wallet_details WHERE wallet_id = $wallet_id;");
                        if($row2 = mysqli_fetch_array($sql1)){
                            $balance = $row2['balance'];
                            $key = strtok($key, '_');
                            $value = htmlspecialchars($value);
                            $sql2 = "UPDATE wallet_details SET balance = '$value' WHERE id = $wallet_id;";
                            $con->query($sql2);
                        }
                    }
                }
            }
        }

        header("location: ../am_wal.php#$id");
    }
}
if($_SESSION['customer_sid']==session_id()) {
    if (isset($_POST['customer'])) {
        $id = $_POST['customer'];
        $phone = "";
        $getcustinfo = mysqli_query($con,"SELECT * from users WHERE id = '$id' AND not deleted;");
        if($row5 = mysqli_fetch_array($getcustinfo)){
            $phone = $row5['contact'];
        }
        $getcust = mysqli_query($con,"SELECT * from wallet WHERE customer_id = '$id';");
        if($row = mysqli_fetch_array($getcust)){
            $wallet_id = $row['id'];
            $getwal = mysqli_query($con,"SELECT * from wallet_details WHERE wallet_id = '$wallet_id';");
            if($row2 = mysqli_fetch_array($getwal)){
                $balance = $row2['balance'];
                $value = htmlspecialchars($_POST['cash']);
                $balance += $value;

                $to = 'yaadiltd@gmail.com';
                $subject = 'Wallet top Up requested';
                $message = '
<html>
<head>
  <title>'.$name.' requests a Top up</title>
</head>
<body>
  <p>Please login and make the necessary top up to the customer account if payment is confirmed.</p>
  <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
  <tr><p>Top up request was confirmed by the customer</p></tr> 
            <tr style="background-color: #e0e0e0;">
            
                <th>Contact Number:</th><td>' . $phone . '</td> 
                <th>Requested Amount:</th><td>$' . $value . '</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="https://www.yaadi.co/admin-login.php">YAADI ADMIN</a></td> 
            </tr> 
    </table> 
</body>
</html>
';
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = 'From: <wallet@yaadi.co>';
                mail($to, $subject, $message, implode("\r\n", $headers));
//                $updwal = "UPDATE wallet_details SET balance = '$balance' WHERE id = $wallet_id;";
//                $con->query($updwal);
                echo "<script>Materialize.toast('Wallet top up request Sent', 8000)</script>";
            }
        }
    }
}

?>