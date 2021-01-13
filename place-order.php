<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$total = 0;
if($_SESSION['customer_sid']==session_id())
{
    $usr_address = "";
    $useraddress = mysqli_query($con, "SELECT * FROM users WHERE name= '$name'");
    while($row = mysqli_fetch_array($useraddress))
    {
        $usr_address = $row['address'];
    }
    $selec_rest = $_GET['pgid'];
    $restid = $_GET['pgid'];
    $restaddress = "";
    $res_name = '';
    $note_id = '';
    $long = "";
    $lat = "";
    $dist = "";

    $getlonglat = mysqli_query($con, "SELECT * FROM users where id = $restid");
    while($row = mysqli_fetch_array($getlonglat)){
        $long = $row['ulong'];
        $lat = $row['ulat'];
        $restaddress = $row['address'];
    }

    $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
    while($row = mysqli_fetch_array($result)){
        $name = $row['name'];
        $address = $row['address'];
        $contact = $row['contact'];
        $verified = $row['verified'];
    }

    if(isset($_POST["add_note"]))  {
        if(isset($_SESSION["side_note"]))  {
            $item_array_id = array_column($_SESSION["side_note"], "item_id");
            if(!in_array($_GET["id"], $item_array_id))
            {
                $count = count($_SESSION["side_note"]);
                $item_array = array(
                    'note_id'               =>     $_GET["id"],
                    'item_name'               =>     $_POST["hidden_name"]
                );
                $_SESSION["side_note"][$count] = $item_array;
            }
            else
            {
                echo '<script>alert("(Double Add) Item Already Added To Cart")</script>';
                echo '<script>window.location="category.php?pgid='.$restid.'"</script>';
            }
        }
        else
        {
            $item_array = array(
                'note_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"]
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }
    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="place-order.php?pgid='.$restid.'"</script>';
                }
            }
        }
    }

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

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Delivery Details</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style type="text/css">
            .input-field div.error{
                position: relative;
                top: -1rem;
                left: 0rem;
                font-size: 0.8rem;
                color:#FF4081;
                -webkit-transform: translateY(0%);
                -ms-transform: translateY(0%);
                -o-transform: translateY(0%);
                transform: translateY(0%);
            }
            .input-field label.active{
                width:100%;
            }
            .left-alert input[type=text] + label:after,
            .left-alert input[type=password] + label:after,
            .left-alert input[type=email] + label:after,
            .left-alert input[type=url] + label:after,
            .left-alert input[type=time] + label:after,
            .left-alert input[type=date] + label:after,
            .left-alert input[type=datetime-local] + label:after,
            .left-alert input[type=tel] + label:after,
            .left-alert input[type=number] + label:after,
            .left-alert input[type=search] + label:after,
            .left-alert textarea.materialize-textarea + label:after{
                left:0px;
            }
            .right-alert input[type=text] + label:after,
            .right-alert input[type=password] + label:after,
            .right-alert input[type=email] + label:after,
            .right-alert input[type=url] + label:after,
            .right-alert input[type=time] + label:after,
            .right-alert input[type=date] + label:after,
            .right-alert input[type=datetime-local] + label:after,
            .right-alert input[type=tel] + label:after,
            .right-alert input[type=number] + label:after,
            .right-alert input[type=search] + label:after,
            .right-alert textarea.materialize-textarea + label:after{
                right:70px;
            }
            ul.side-nav.leftnavset{top:64px;overflow:hidden;  }
            .side-nav.fixed.leftnavset .collapsible-body li.active{background-color:rgba(0,0,0,0.04)}
            .side-nav .collapsible-body li a{margin:0 1rem 0 3rem}ul.side-nav.leftnavset{top:64px;overflow:hidden}
            ul.side-nav.leftnavset hr{display:block;height:1px;border:0;border-top:1px solid #e0e0e0;margin:1em 0;padding:0}
            ul.side-nav.leftnavset li{line-height:44px}
            ul.side-nav.leftnavset li:hover{background-color:rgba(0,0,0,0.04)}
            ul.side-nav.leftnavset li.active{background-color:rgba(0,0,0,0.04)}
            ul.side-nav.leftnavset li a{font-size:14px;font-weight:400}
            ul.side-nav.leftnavset li.user-details{background:url("../images/user-bg.jpg") no-repeat center center;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;margin-bottom:15px;padding:15px 0 0 15px}
            ul.side-nav.leftnavset li.user-details #profile-dropdown a{padding:8px 15px}
            ul.side-nav.leftnavset .profile-btn{margin:0;text-transform:capitalize;padding:0;text-shadow:1px 1px 1px #444;font-size:15px}
            ul.side-nav.leftnavset ul.collapsible-accordion{background-color:#fff}
            .side-nav.fixed.leftnavset .collapsible-body li.active>a{color:#A82128}ul.side-nav.leftnavset li.active>a{color:#A82128}
            label{
                color: black;
            }
        </style>
        <script>
            $(document).ready(function(){
                $("#receipt").click(function(){
                    $("#work-collections").toggle();
                });
            });
        </script>
       <script>
           var searchInput = 'changeaddress';

           $(document).ready(function () {
               var autocomplete;
               autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                   types: ['geocode'],
               });

               google.maps.event.addListener(autocomplete, 'place_changed', function () {
                   var near_place = autocomplete.getPlace();
                   document.getElementById('loc_lat').value = near_place.geometry.location.lat();
                   document.getElementById('loc_long').value = near_place.geometry.location.lng();

                   document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
                   document.getElementById('longitude_view').innerHTML = near_place.geometry.location.lng();
               });
           });

           $(document).on('change', '#'+searchInput, function () {
               document.getElementById('latitude_input').value = '';
               document.getElementById('longitude_input').value = '';

               document.getElementById('latitude_view').innerHTML = '';
               document.getElementById('longitude_view').innerHTML = '';
           });

       </script>

    </head>
    <body>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul style="background-color: white;">
                        <label class="center" style="font-size: 10px;color: #a21318;font-weight: 600;"><b>DELIVERING TO <span id="nearby"></span></b></label>
                        <li class="center"><a href="deliverto.php" class="brand-logo darken-1" style="font-size: 12px;color: black;"><?php echo $usr_address; ?></a></li>
                        <li class="right"><a id="addnoe" class="waves-effect waves-light modal-trigger" href="#addnote"><i class="mdi-notification-event-note" style="color: #a21318;"></i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div id="main">
        <div class="wrapper">
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav menu fixed leftnavset" style="border-top-right-radius: 8px;">
                    <nav class="nav-extended">
                        <li class="user-details teal lighten-2">
                            <div class="row">
                                <div class="col col s4 m4 l4">
                                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                                </div>
                                <div class="col col s8 m8 l8">
                                    <ul id="profile-dropdown" class="dropdown-content">

                                        <li><a href="routers/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col col s8 m8 l8">
                                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                                    <p class="user-roal"><?php echo $role;?></p>
                                </div>
                            </div>
                        </li>
                        <li class="bold active"><a href="index.php"><i class="mdi-action-shop-two"></i> Order Food</a>
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>My Orders</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="orders.php">My Orders</a>
                                            </li>
                                            <?php
                                            $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE customer_id = $user_id;");
                                            while($row = mysqli_fetch_array($sql)){
                                                echo '<li><a href="orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i>Tickets</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="tickets.php">My Tickets</a>
                                            </li>
                                            <?php
                                            $sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets WHERE poster_id = $user_id AND not deleted;");
                                            while($row = mysqli_fetch_array($sql)){
                                                echo '<li><a href="tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="bold"><a href="wallet.php" class="waves-effect waves-cyan"><i class="mdi-action-account-balance-wallet"></i>My Wallet</a>
                        </li>
                        <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-action-account-box"></i>Account</a>
                        </li>
                        <li class="bold"><a href="#." class="waves-effect waves-cyan"><i class="mdi-action-settings"></i>Settings</a>
                        </li>
                    </nav>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only z-depth-0" style="color: #a21318"><i class="mdi-navigation-menu" style="color: white;"></i></a>
            </aside>

            <div id="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </div>

            <section id="content">

                <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                    <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="confirm-order.php?id=<?php echo $restid ?>" novalidate="novalidate">
                        <li class="collection-header" style="border-top-right-radius: 8px;border-top-left-radius: 8px;"><h5>Payment Method</h5></li>
                        <li class="collection-item" style="height: auto;"><label for="payment_type">How will you pay?</label>
                            <select class="browser-default" id="pay_type" name="pay_type">
                                <option value="Select how you pay" <?php if(!$verified) echo 'disabled';?> selected>Select how you pay</option>
                                <option value="Cash" <?php if(!$verified) echo 'disabled';?>>Cash</option>
                                <option value="Online Card" <?php if(!$verified) echo 'disabled';?>>Visa, Mastercard</option>
                                <option value="Bank Transfer" <?php if(!$verified) echo 'disabled';?>>NCB, Scotia, JN</option>
                                <option value="Online" <?php if(!$verified) echo 'disabled';?>>PayPal</option>
                                <?php
                                if ($balance !== 0)
                                {?>
                                    <option value="Wallet" <?php if(!$verified) echo 'disabled';?>>Wallet $<?php echo number_format($balance); ?></option>
                                    <?php
                                }?>
<!--                                <option value="Pick-Up" --><?php //if(!$verified) echo 'disabled';?><!-- disabled>Pick-Up</option>-->
                            </select></li>
                        <?php
                        $addressFrom = $restaddress;
                        $addressTo   = $address;
//                      Get distance in km
                        $distance = getDistance($addressFrom, $addressTo, "K");
                        ?>
                        <li class="collection-item" style="height: auto;border-top-right-radius: 8px;border-top-left-radius: 8px;">
                            <?php

                            if ($distance > 30 && $address !== ""){
                                echo 'Cannot locate address, <strong>Delivery fee will be Estimated</strong><input name="distance" id="distance" for="distance" value="1.5" hidden>';
                            }
                            else if ($distance < 30 && $address !== "") {
                                echo "<p><label>Delivering to</label> <br>$address</p>";
                                echo '<input name="distance" id="distance" for="distance" value="' . $distance . '" hidden>';
                            }
                            ?>
                        </li>
                </ul>
            </section>

            <section>
                <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                        <li class="collection-header"><h4>

                                <?php
                                if ($distance < 30 && $address !== ""){
                                    echo "$distance <span style='font-size: 12px;'>Away</span>";
                                }
                                ?>

                            </h4></li>
                </ul>
            </section>

            <section>
                <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                    <li class="collection-item">
                        <?php
                        if(!empty($_POST['note']))
                            echo '<p><label>Side note</label><br>'.htmlspecialchars($_POST['note']).'</p>';
                        ?>
                        <?php

                        $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND not deleted;");
                        while($row = mysqli_fetch_array($result))
                        {
                            $restid = $selec_rest;
                        }

                        foreach ($_POST as $key => $value)
                        {
                            if($key == 'action' || $value == ''){
                                break;
                            }
                            echo '<input name="'.$key.'" type="hidden" value="'.$value.'">';
                        }
                        ?>
                    </li>
                </ul>
            </section>

            <section>
                <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                        <li class="collection-item">
                            <?php

                            if ($address === ""){
                            }
                            else if ($address !== '' && $distance != 0.00) {
                                echo '<button id="confirm" class="btn cyan waves-effect waves-light" type="submit" name="action" style="width:100%;background-color: white;border: 1px solid antiquewhite;border-radius: 6px;font-size: 12px;">Checkout
                                                        <i class="mdi-action-shopping-cart right"></i>
                                                    </button>';
                            }
                            ?>
                        </li>
                    </form>
                </ul>
            </section>


            <section>
                <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                    <li class="collection-item">
                        <div id="work-collections" class="section" >
                            <div class="row">
                                <div>
                                    <ul id="issues-collection" class="collection" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                                        <?php
                                        if(!empty($_SESSION["add_note"]))
                                        {
                                            $total = 0;
                                            foreach($_SESSION["add_note"] as $keys => $values)
                                            {
                                                $note_id = $values["note_id"];
                                                $note = $values["name"];
                                            }
                                            ?>

                                            <?php
                                        }
                                        ?>

                                        <?php
                                        $result = mysqli_query($con, "SELECT * FROM users where id= $user_id AND not deleted;");
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $phone = $row['contact'];
                                        }

                                        echo '<li class="collection-item avatar">
                                        <i class="mdi-content-content-paste red circle"></i>
                                        <p><strong>Name:</strong> '.$name.'</p>
                                        <p><strong>Contact Number:</strong> '.$phone.'</p>';
                                        ?>
                                        <?php
                                        echo'<a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';
                                        ?>


                                        <?php
                                        if(!empty($_SESSION["shopping_cart"]))
                                        {
                                            $total = 0;
                                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                                            {
                                                ?>
                                                <li class="collection-item">
                                                    <div class="row">
                                                        <div class="col s1"><br>
                                                            <h6 class="left"><span class="left" style="background-color: mediumaquamarine;color: black;border-radius: 8px;font-size: 12px;">(<?php echo $values["item_quantity"];?>)</span></h6>
                                                        </div>
                                                        <div class="col s7">
                                                            <p class="collections-title"><?php echo $values["item_name"]; ?><br>
                                                                <?php
                                                                if (isset($values["item_variation"])) {
                                                                    echo ' 
                                                                <label>Flavor: </label><label>'.$values["item_variation"].'</label><br>';
                                                                }

                                                                if (isset($values["item_variation_type"])){
                                                                 echo '   
                                                                <label>Type: </label><label>'.$values["item_variation_type"].'</label><br>';
                                                                 }

                                                                if (isset($values["item_variation_side"])){
                                                                 echo '  
                                                                <label>Side: </label><label>'.$values["item_variation_side"].'</label><br>';
                                                                 }

                                                                if (isset($values["item_variation_drink"])) {
                                                                    echo '  
                                                                <label>Drink: </label><label>'.$values["item_variation_drink"].'</label><br>';
                                                                }
                                                                ?>
                                                                </p>
                                                        </div>

                                                        <div class="col s4"><br>
                                                            <span>$<?php echo $values["item_price"]; ?> JMD</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <?php
                                                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                            }
                                            ?>


                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s8">
                                                        <p class="collections-title"> Subtotal</p>
                                                    </div>
                                                    <div class="col s4">
                                                        <span><strong>$<?php echo number_format($total); ?> JMD</strong></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>







                            <div id="modal1" class="modal bottom-sheet" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                                <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="routers/up-address-router.php" novalidate="novalidate">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="mdi-action-home prefix"></i>
                                                <textarea spellcheck="true" id="changeaddress" name="changeaddress" placeholder="Street, Road or Address" class="materialize-textarea validate" data-error=".errorTxt1"><?php echo $address;?></textarea>
                                                <input type="hidden" name="rest" value="<?php echo $restid; ?>">
                                                <label for="address" class="">Delivering to</label>
                                                <div class="errorTxt1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn modal-close waves-effect waves-green btn-flat" type="submit" style="background-color: white;border: 1px solid antiquewhite;border-radius: 6px;">Update</button>
                                    </div>
                                </form>
                            </div>

                            <div id="addnote" class="modal bottom-sheet" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                                <form action="place-order.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>" method="post">
                                    <div class="modal-content">
                                        <h4>Add a side note</h4>
                                        <p>Adding a side note allows the restaurant and the courier to better fill your order.</p>
                                        <div class="row">
                                                <div class="input-field col s12">
                                                    <i class="mdi-editor-mode-edit prefix"></i>
                                                    <textarea spellcheck="true" id="note" name="note" class="materialize-textarea"></textarea>
                                                    <label for="note" class="">Add note here...</label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="waves-effect waves-light btn z-depth-0" type="submit" name="action" style="border-radius: 6px;background-color: white;border: 1px solid antiquewhite;font-size: 12px;color: black;"><i class="mdi-communication-chat"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
        </div>
    </div>

    <!--    footer -->
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="yaadiltd.php" target="_blank">Yaadi.Co</a>, all rights reserved.</span>
                <span class="right"><a class="grey-text text-lighten-4" href="tercon.php" target="_blank">Terms & Conditions</a></span>
            </div>
        </div>
    </footer>
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="yaadiltd.php" target="_blank">Yaadi.Co</a>, all rights reserved.</span>
                <span class="right"><a class="grey-text text-lighten-4" href="tercon.php" target="_blank">Terms & Conditions</a></span>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                address: {
                    required: true,
                    minlength: 5
                },
                cc_number: {
                    required: false,
                    minlength: 16,
                    maxlength: 16,
                },
                cvv_number: {
                    required: false,
                    minlength: 3,
                },
            },
            messages: {
                address:{
                    required: "Enter a address",
                    minlength: "Enter at least 5 characters"
                },
                cc_number:{
                    required: "Please provide card number",
                    minlength: "Enter at least 16 digits",
                    maxlength: "Enter a maximum of 16 digits",
                },
                cvv_number:{
                    required: "Please provide CVV number",
                    minlength: "Enter at least 3 digits",
                },
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $('#cc_number').formatter({
            'pattern': '{{9999}}-{{9999}}-{{9999}}-{{9999}}',
            'persistent': true
        });
        $('#cvv_number').formatter({
            'pattern': '{{9}}-{{9}}-{{9}}',
            'persistent': true
        });
        $("#cc_number").prop('disabled', true);
        $("#cvv_number").prop('disabled',true);
        $("#confirm").prop('disabled', true);
        $('#payment_type').change(function() {
            if ($(this).val() === 'Mandeville') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled',true);
            }
        });
        $('#pay_type').change(function() {
            if ($(this).val() === 'Select how you pay') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled',true);
                $("#confirm").prop('disabled', true);
            }
            if ($(this).val() === 'Cash') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }
            if ($(this).val() === 'Online Card') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }
            if ($(this).val() === 'Bank Transfer') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }
            if ($(this).val() === 'Online') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }
            if ($(this).val() === 'Wallet') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }

        });
    </script>



    </body>
    </html>

    <?php
}



else
{
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin.php");
    }
    else{
        header("location:login.php");
    }
}
?>