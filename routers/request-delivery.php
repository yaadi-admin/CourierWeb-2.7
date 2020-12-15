<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['contact'])) {
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $total = 0;
        $service_fee = 0;
        $fee = 500;
        $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));

        $date->setTimezone(new DateTimeZone('America/Jamaica'));
        $timestamp = $date->format('Y-m-d H:i:sP');
        $address = $_POST['address'];
        $pay_type = htmlspecialchars($_POST['payment_type']);
        if (isset($_POST['note'])) {
            $description = htmlspecialchars($_POST['note']);
        }
        if (!isset($_POST['note'])){
            $description = "No note added";
        }
        $payment_type = $_POST['payment_type'];
        $customer_name = $_POST['name'];
        $phone = $_POST["contact"];
        $address = $_POST["address"];

        if ($fee != '0') {

            $total = $_POST['total'];
            $service_fee = $_POST['service_fee'];

            $sql = "INSERT INTO orders (name, payment_type, address, total, description, service_fee, fee, date, restaurantid) VALUES ('$customer_name', '$payment_type', '$address', '$total', '$description', '$service_fee', '$fee', '$timestamp', '$user_id')";

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
                    $sql = "INSERT INTO order_details (order_id, item_id, quantity, price, restaurant, variation, variation_type, variation_side, variation_drink) VALUES ('$order_id', '$id', '$quantity', '$price', '$name', '$variation', '$variation_type', '$variation_side', '$variation_drink')";
                    $con->query($sql) === TRUE;
                }

                unset($_SESSION["shopping_cart"]);


                echo '<script>alert("Order #' . $order_id . ' has been placed!\n");</script>';
                echo '<script>window.location=" ../restaurant-orders.php"</script>';

//        Ending bracket - if order connection successful
            }

        } else {
            $fee = 0;
            $total = 0;
            echo '<script>alert("There was an error with your order! Try again.");</script>';
            echo '<script>window.location=" ../restaurant.php"</script>';
        }
    }
}
?>