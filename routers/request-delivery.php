<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['customer_sid']==session_id()) {
    if (isset($_POST['rest'])) {
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $total = 0;
        $service_fee = 0;
        $fee = htmlspecialchars($_POST['del_fee']);
        $selec_rest = $_POST['rest'];
        $restid = $_POST['rest'];
        $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));

        $date->setTimezone(new DateTimeZone('America/Jamaica'));
        $timestamp = $date->format('Y-m-d H:i:sP');
        $address = "";
        $restname = '';
        $pay_type = htmlspecialchars($_POST['payment_type']);
        if (isset($_POST['note'])) {
            $description = htmlspecialchars($_POST['note']);
        }
        if (!isset($_POST['note'])){
            $description = "No note added";
        }
        $payment_type = $_POST['payment_type'];
            $phone = $_POST["phone"];
            $address = $_POST["address"];


        $getrest = mysqli_query($con, "SELECT * FROM items WHERE restaurantid= $user_id AND not deleted;");
        while ($row = mysqli_fetch_array($getrest)) {
            $restid = $selec_rest;
        }

        $getrest2 = mysqli_query($con, "SELECT * FROM users WHERE id= $user_id AND not deleted;");
        while ($row = mysqli_fetch_array($getrest2)) {
            $restname = $row['name'];
        }

        if ($_POST['del_fee'] != '0') {

            $total = $_POST['total'];
            $service_fee = $_POST['servicefee'];

            $sql = "INSERT INTO orders (customer_id, payment_type, address, total, description, service_fee, fee, date, restaurantid, pay_type) VALUES ('$user_id', '$payment_type', '$address', '$total', '$description', '$service_fee', '$fee', '$timestamp', '$restid', '$pay_type')";

            if ($con->query($sql) === TRUE) {

                $order_id = $con->insert_id;

                foreach ($_SESSION["shopping_cart"] as $key => $value) {
                    $id = $value["item_id"];
                    $quantity = $value["item_quantity"];
                    $price = $value["item_price"];
                    $variation = $value["item_variation"];
                    $variation_type = $value["item_variation_type"];
                    $variation_side = $value["item_variation_side"];
                    $variation_drink = $value["item_variation_drink"];

                    $result = mysqli_query($con, "SELECT * FROM items WHERE id=$id");
                    while ($row = mysqli_fetch_array($result)) {
                        $price = $row['price'];
                    }
                    $sql = "INSERT INTO order_details (order_id, item_id, quantity, price, restaurant, variation, variation_type, variation_side, variation_drink) VALUES ('$order_id', '$id', '$quantity', '$price', '$restname', '$variation', '$variation_type', '$variation_side', '$variation_drink')";
                    $con->query($sql) === TRUE;
                }

                unset($_SESSION["shopping_cart"]);


                echo '<script>alert("Your order #' . $order_id . ' has been placed!\n");</script>';
                echo '<script>window.location=" ../orders.php"</script>';

//        Ending bracket - if order connection successful
            }

        } else {
            $fee = 0;
            $total = 0;
            echo '<script>alert("There was an error with your order! Try again.");</script>';
            echo '<script>window.location=" ../index.php"</script>';
        }
    }
}
?>