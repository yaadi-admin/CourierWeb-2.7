<?php
include '../includes/connect.php';
if($_SESSION['customer_sid']==session_id()) {
    if(isset($_POST['addemail'])) {
        $user_id = $_SESSION['user_id'];
        $email = htmlspecialchars($_POST['addemail']);
        $sql = "UPDATE users SET email='$email'WHERE id = $user_id;";
        if ($con->query($sql) == true) {
            header("location: ../index.php");
        }
    }

    if(isset($_POST['addaddress']) && $_POST['addaddress'] !== ' ') {

        $apiKey = 'AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo';

        $addressTo = "Hillside Close, Knockpatrick, Jamaica";

        $formattedAddrTo     = str_replace(' ', '+', $addressTo);

        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
        $outputTo = json_decode($geocodeTo);
        if(!empty($outputTo->error_message)){
            return $outputTo->error_message;
        }

        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

        $user_id = $_SESSION['user_id'];
        $address = htmlspecialchars($_POST['addaddress']);
        $sql = "UPDATE users SET address='$address', ulong='$longitudeTo', ulat='$latitudeTo' WHERE id = $user_id;";
        if ($con->query($sql) == true) {
            echo '<div class="progress"><div class="indeterminate"></div></div>';
            echo "<script>document.location.href='../index.php';</script>";
        }
        else{
            Materialize.toast('Address was not added. TRY AGAIN', 4000);
        }
    }
    else{
        Materialize.toast('Address was not added. TRY AGAIN', 4000);
    }

}

?>