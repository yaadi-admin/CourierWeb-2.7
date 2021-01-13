<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['rest'])) {

       $payment_type = $_POST['payment_type'];
       $restaurant = $_POST['rest'];
       $fee = $_POST['del_fee'];
       $address = $_POST['address'];
       $contact = $_POST['contact'];
       $customer = $_POST['customer_name'];
       $total = $_POST['total'];
       $service_fee = $_POST['servicefee'];

       $default_id = 291;
       $type = "Hanker Order";
       $description = "N/A";
       $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
       $date->setTimezone(new DateTimeZone('America/Jamaica'));
       $timestamp = $date->format('Y-m-d H:i:sP');

        if ($fee != '0') {

            $sql = "INSERT INTO hanker_orders (customer, contact, address, restaurant_id, service_fee, fee, total, payment_type, date ) VALUES ('$customer', '$contact', '$address', '$user_id', '$service_fee', '$fee', '$total', '$payment_type', '$timestamp' )";

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

                    $result = mysqli_query($con, "SELECT * FROM items WHERE id='$id'");
                    while ($row = mysqli_fetch_array($result)) {
                        $price = $row['price'];
                    }
                    $sql = "INSERT INTO hanker_details (order_id, item_id, quantity, price, restaurant, variation, variation_type, variation_side, variation_drink) VALUES ('$order_id', '$id', '$quantity', '$price', '$name', '$variation', '$variation_type', '$variation_side', '$variation_drink')";
                    $con->query($sql) === TRUE;
                }
                unset($_SESSION["shopping_cart"]);




                echo '<script>alert("Your order #' . $order_id . ' has been placed!\n");</script>';
                echo '<script>window.location=" ../restaurant.php"</script>';

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
