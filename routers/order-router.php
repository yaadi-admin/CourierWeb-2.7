<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
$account_sid = 'AC8f235f78aa51cec01909115165e27a90';
$auth_token = '64b73f721643ba5f3b3630b75b792116';
$twilio_number = "+12029145139";
$client = new Client($account_sid, $auth_token);
$total = 0;
$fee = htmlspecialchars($_POST['del_fee']);
$selec_rest = $_GET['id'];
$restid = $_GET['id'];
$date = date('Y-m-d');
$restname = '';
$pay_type = htmlspecialchars($_POST['pay_type']);
$description = htmlspecialchars($_POST['note']);
$usrph = "";
 $admn = "18763622910";
 $admn2 = "18767004142";
    $deliv = "18765542331";
    $deliv2 = "";
       $phone_nt = "";
       $phone_nt2 = "";
       $usr = $_SESSION['customer_sid'];
        $sqlu = mysqli_query($con, "SELECT * FROM users WHERE id= $user_id AND not deleted;");
        while($row = mysqli_fetch_array($sqlu))
        {
        $phone = $row["contact"];
        $usrph = $phone;

        }
$result = mysqli_query($con, "SELECT * FROM items WHERE restaurantid= $selec_rest AND not deleted;");
				while($row = mysqli_fetch_array($result))
				{
                    $restid = $selec_rest;
                    $phone_nt = $row["notphone"];
                    $phone_nt2 = $row["notphone2"];
                }
echo $restid;
if ($restid == "1"){
                $restname = 'yaadi.co';
                    }
else
$getname = mysqli_query($con, "SELECT * FROM users WHERE id= $restid AND not deleted;");
				while($row = mysqli_fetch_array($getname))
				{

                    $restname = $row['name'];
                }

$address = htmlspecialchars($_POST['address']);
$payment_type = $_POST['pay_type'];
if($_POST['del_fee'] != '0'){
    $total = $_POST['total'];
    $sql = "INSERT INTO orders (customer_id, payment_type, address, total, description, fee, restaurantid, pay_type) VALUES ($user_id, '$payment_type', '$address', $total, '$description', $fee, $restid, '$pay_type')";
    if ($con->query($sql) === TRUE){
        $order_id =  $con->insert_id;
        foreach ($_SESSION["shopping_cart"] as $key => $value)
        {
            $id = $value["item_id"];
            $quantity = $value["item_quantity"];
            $price = value["item_price"];
            $variation = value["item_variation"];

            $result = mysqli_query($con, "SELECT * FROM items WHERE id=$id");
            while($row = mysqli_fetch_array($result))
            {
                $price = $row['price'];
            }
            echo $restname;
            $sql = "INSERT INTO order_details (order_id, item_id, quantity, price, restaurant, variation) VALUES ($order_id, $id, '$quantity', $price, '$restname', '$variation')";
            $con->query($sql) === TRUE;
        }
        unset($_SESSION["shopping_cart"]);

            $client->messages->create(
                $usrph,
                array(
                'from' => $twilio_number,
                'body' => 'Thank you for your order, Order: #'.$order_id.', Total: $'.$total.', Yaadi.Co'));

            $client->messages->create(
                $admn,
                array(
                'from' => $twilio_number,
                'body' => '#'.$order_id.', Total: $'.$total.' | Rest: '.$restname.' address: '.$address.''));

            $client->messages->create(
                $admn2,
                array(
                'from' => $twilio_number,
                'body' => '#'.$order_id.', Total: $'.$total.' | Rest: '.$restname.' address: '.$address.''));

//                $client->messages->create(
//                $deliv,
//                array(
//                'from' => $twilio_number,
//                'body' => 'New delivery order #'.$order_id.' | Ordered From '.$restname.''));

//                $client->messages->create(
//                $deliv2,
//                array(
//                'from' => $twilio_number,
//                    'body' => 'Yaadi.Co | NEW ORDER #'.$order_id.' | '.$restname.''));

//                O M G........
        if ($restname == "O M G"){
            $to = 'diningroom.omg@gmail.com';
            $subject = 'New Order';
            $message = '<html>
<head>
  <title>New order</title>
</head>
<body>
  <p>We do not display order information within emails, please login to view more order information</p>
  <table cellspacing="0" style="border: 1px solid #bbb; width: 100%;"> 
            <tr> 
                <th>Customer: '.$name.'</th> 
            </tr> 
            <tr style="background-color: #bbb"> 
                <th>'.$address.'</td> 
            </tr> 
            
            <tr style="background-color: #bbb"> 
                <th>'.$total.'</td> 
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
            $headers[] = 'From: <orders@yaadi.co>';
            mail($to, $subject, $message, implode("\r\n", $headers));
        }

//        Gizmos.....
        else if ($restname == "Gizmos Chillspot"){
//            $client->messages->create(
//                $phone_nt,
//                array(
//                    'from' => $twilio_number,
//                    'body' => 'Yaadi.Co | NEW ORDER #'.$order_id.' | $'.$total.''));

                        $to = 'gizmosja@gmail.com';
                        $subject = 'New Order';
                        $message = '<html>
            <head>
              <title>New order</title>
            </head>
            <body>
              <p>We do not display order information within emails, please login to view more order information</p>
              <table cellspacing="0" style="border: 1px solid #bbb; width: 100%;"> 
                        <tr> 
                            <th>Customer: '.$name.'</th> 
                        </tr> 
                        <tr style="background-color: #bbb"> 
                            <th>'.$address.'</td> 
                        </tr> 
                        
                        <tr style="background-color: #bbb"> 
                            <th>'.$total.'</td> 
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
                        $headers[] = 'From: <orders@yaadi.co>';
                        mail($to, $subject, $message, implode("\r\n", $headers));

        }

//                Flamin Wok Catering.....
        else if ($restname == "Flamin Wok"){
//            $client->messages->create(
//                $phone_nt,
//                array(
//                    'from' => $twilio_number,
//                    'body' => 'Yaadi.Co | NEW ORDER #'.$order_id.' | $'.$total.''));

            $to = 'flaminnotify@gmail.com';
            $subject = 'New Delivery Order';
            $message = '
            <html>              
            <head>
              <title>New order</title>
            </head>
            <body>
              <p>We do not display order information within emails, please login to view more order information</p>
              <table cellspacing="0" style="border: 1px solid #bbb; width: 100%;"> 
                        <tr> 
                            <th>Customer: '.$name.'</th> 
                        </tr> 
                        <tr style="background-color: #bbb"> 
                            <th>'.$address.'</td> 
                        </tr> 
                        
                        <tr style="background-color: #bbb"> 
                            <th>'.$total.'</td> 
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
                        $headers[] = 'From: <orders@yaadi.co>';
                        mail($to, $subject, $message, implode("\r\n", $headers));

        }

        echo '<script>alert("Your order #'.$order_id.' has been placed!");</script>';
        echo '<script>window.location=" ../orders.php"</script>';
    }
        }

    else {
        $fee = 0;
        $total = 0;
        echo '<script>alert("There was an error with your order! Try again.");</script>';
        echo '<script>window.location=" ../index.php"</script>';
    }
?>