<?php
include 'includes/connect.php';

function getDistance($addressFrom, $addressTo, $unit = ''){
    // Google API key
    $apiKey = 'AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo';

    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);

    // Geocoding API request with start address
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }

    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }

    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;

    // Convert unit and return distance
    $unit = strtoupper($unit);
    if($unit == "K"){
        return round($miles * 1.609344, 2).' km';
    }elseif($unit == "M"){
        return round($miles * 1609.344, 2).' meters';
    }else{
        return round($miles, 2).' miles';
    }
}

$addressFrom = $_POST['restaurant'];
$addressTo = $_POST['customer'];
$distance = getDistance($addressFrom, $addressTo, "K");

$dis_fee = 0;

if($distance <= 0.5 && $distance > 0.0){
    $dis_fee = 350;
}
if($distance <= 1.0 && $distance > 0.5){
    $dis_fee = 400;
}
if($distance <= 1.5 && $distance > 1.0){
    $dis_fee = 450;
}
if($distance <= 2.0 && $distance >= 1.5){
    $dis_fee = 500;
}
if($distance <= 2.5 && $distance >= 2.0){
    $dis_fee = 550;
}
if($distance <= 3.0 && $distance >= 2.5){
    $dis_fee = 600;
}
if($distance <= 3.5 && $distance >= 3.0){
    $dis_fee = 650;
}
if($distance <= 4.0 && $distance >= 3.5){
    $dis_fee = 700;
}
if($distance <= 4.5 && $distance >= 4.0){
    $dis_fee = 750;
}
if($distance <= 5.0 && $distance >= 4.5){
    $dis_fee = 800;
}
if($distance <= 5.5 && $distance >= 5.0){
    $dis_fee = 850;
}
if($distance <= 6.0 && $distance >= 5.5){
    $dis_fee = 900;
}
if($distance <= 6.5 && $distance >= 6.0){
    $dis_fee = 950;
}
if($distance <= 7.0 && $distance >= 6.5){
    $dis_fee = 1000;
}
echo $dis_fee;

?>