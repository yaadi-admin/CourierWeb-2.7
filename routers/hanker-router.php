<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['rest'])) {

        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);

       $payment_type = $_POST['payment_type'];
       $restaurant = $_POST['rest'];
       $fee = $_POST['del_fee'];
       $admn = "18763622910";
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

//                Customer order confirmation...
                $client->messages->create(
                    $contact,
                    array(
                        'from' => $twilio_number,
                        'body' => 'Order Placed!, Order: #'.$order_id.', Total: $'.$total.' => Yaadi.Co'));

//            Admin order notification...
                    $client->messages->create(
                        $admn,
                        array(
                            'from' => $twilio_number,
                            'body' => '(HANKER ODER) => #' . $order_id . ' => Total: $' . $total . ' => Restaurant: ' . $name . ''));

//            Rider order notification...
                $getriders = mysqli_query($con, "SELECT * FROM users WHERE (role='Rider' AND verified=1) AND not deleted;");
                while ($row = mysqli_fetch_array($getriders)) {
                    $rider = $row['contact'];
                    $client->messages->create(
                        $rider,
                        array(
                            'from' => $twilio_number,
                            'body' => '(HANKER ORDER) => #'.$order_id.' => Total: $'.$total.' => Restaurant: '.$name.''));
                }

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
