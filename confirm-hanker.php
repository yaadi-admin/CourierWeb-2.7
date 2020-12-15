<?php
include 'includes/connect.php';
if($_SESSION['restaurant_sid']==session_id())
{
    $user_id = $_SESSION['user_id'];
    $counter = 0;
    $customer_name = $_POST['name'];
    $customer_contact = $_POST['contact'];
    $customer_address = $_POST['address'];
    $payment_type = $_POST['payment_type'];
    $myaddress = '';

    $sql = mysqli_query($con, "SELECT * FROM orders where restaurantid= $user_id AND not deleted;");
    while($row = mysqli_fetch_array($sql)){
        $myaddress = $row['address'];
        if ($row['status'] == "Yet to be delivered"){
            $counter += 1;
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

    $addressFrom = $myaddress;
    $addressTo   = $customer_address;
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

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Confirm Hanker Order</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo"></script>
        <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
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
        </style>
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
                    <ul class="left">
                        <li><h1 class="logo-wrapper" style="font-size:42px;"><a href="restaurant.php" class="brand-logo darken-1" style="font-size:40px;font-family: 'Modak', 'cursive';">Yaad<span style="color: yellow;">i</span></a><span class="logo-text">Logo</span></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div id="main">
        <div class="wrapper">
            <aside id="left-sidebar-nav" style="border-radius: 8px;">
                <ul id="slide-out" class="side-nav fixed leftnavset">
                    <li class="user-details teal lighten-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="account-page.php"><i class="mdi-social-person"></i>Account</a></li>
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
                    <li class="bold"><a href="restaurant.php" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert"></i>Active Orders</a>
                    </li>
                    <li class="bold"><a href="restaurant-menu.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i>Menu</a>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-shopping-basket"></i> Orders
                                    <?php

                                    $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND restaurantid LIKE $user_id;");
                                    $count = 0;
                                    $totalorders = 0;
                                    while($row = mysqli_fetch_array($getamount)) {
                                        $count++;
                                        $totalorders = 0;
                                        $totalorders+=$count;
                                    }
                                    if ($totalorders == 0){
                                        echo '<span class="new badge">'.$totalorders.'</span>';
                                    }
                                    else{
                                        echo '<span class="new badge">'.$totalorders.'</span>';
                                    }


                                    ?>
                                </a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="restaurant-orders.php">All Orders</a>
                                        </li>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
                                        while($row = mysqli_fetch_array($sql)){
                                            echo '<li><a href="all-r-orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="bold active"><a href="place-new-order.php" class="waves-effect waves-cyan"><i class="mdi-action-shop-two"></i>Hanker Order</a>
                    </li>
                    <li class="bold"><a href="account-page.php" class="waves-effect waves-cyan"><i class="mdi-action-account-circle"></i>Account</a>
                    </li>
                    <li class="bold"><a href="restaurant-rep.php" class="waves-effect waves-cyan"><i class="mdi-action-view-list"></i>Order Report</a>
                    </li>
                    <li class="bold"><a href="#." class="waves-effect waves-cyan"><i class="mdi-action-settings"></i>Settings</a>
                    </li>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>
            <section id="content">
                <div id="breadcrumbs-wrapper">
                    <div class="container">
                        <div class="row">
                        </div>
                    </div>
                </div>
        </div>
        <div class="container">

            <ul class="collection with-header" style="border-top-left-radius: 8px;border-top-right-radius: 8px;">
                <li class="collection-header"><h5>Confirm Order details</h5></li>
                    <li class="collection-item avatar">
                        <i class="mdi-content-content-paste red circle"></i>
                        <p><strong>Customer:</strong> <?php echo $customer_name; ?></p>
                        <p><strong>Contact:</strong> <?php echo $customer_contact; ?></p>
                        <p><strong>Address:</strong> <?php echo $customer_address; ?></p>
                        <p><strong>Payment Type:</strong> <?php echo $payment_type; ?></p>
                        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                    </li>
            </ul>

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
                                                    <div class="col s4">
                                                        <a href="place-order.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a>
                                                    </div>
                                                </div>
                                            </li>

                                            <?php
                                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                            $service_fee = $total * .08;
                                        }
                                        ?>

                                        <li class="collection-item">
                                            <div class="row">
                                                <div class="col s6">
                                                    <p class="collections-title">Service fee</p>
                                                </div>
                                                <div class="col s2">
                                                    <p class="collections-title">8%</p>
                                                </div>
                                                <div class="col s4">
                                                    <span><strong>$<?php echo number_format($service_fee); ?> JMD</strong></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="collection-item">
                                            <div class="row">
                                                <div class="col s8">
                                                    <p class="collections-title">Delivery fee</p>
                                                </div>
                                                <div class="col s4">
                                                    <span><strong>$<?php echo number_format($dis_fee); ?> JMD</strong></span>
                                                </div>
                                            </div>
                                        </li>

                                        <?php
                                        $total = $total + $service_fee + $dis_fee;
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
                                            <input type="hidden" name="service_fee" id="service_fee" value="<?php echo $service_fee; ?>">
                                            <input type="hidden" name="total" id="total" value="<?php echo $total; ?>">
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

            <ul class="collection with-header" style="border-top-left-radius: 8px;border-top-right-radius: 8px;">
                <li class="collection-header">
                    <h6>Submit Order</h6>
                </li>
                <form method="post" action="routers/request-delivery.php">
                <input type="hidden" name="pay_type" value="<?php echo $_POST['payment_type'];?>">
                <input type="hidden" name="rest" value="<?php echo $user_id; ?>">
                <input type="hidden" name="del_fee" value="<?php echo $dis_fee; ?>">
                <input type="hidden" name="pay_type" value="<?php echo $_POST['payment_type']; ?>">
                <input type="hidden" name="address" value="<?php echo $customer_address; ?>">
                <input type="hidden" name="contact" value="<?php echo $customer_contact; ?>">
                <input type="hidden" name="customer_name" value="<?php echo $customer_name; ?>">
                <?php if (isset($_POST['note'])) { echo'<input type="hidden" name="note" value="'.htmlspecialchars($_POST['note']).'">';}?>
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <input type="hidden" name="servicefee" value="<?php echo $service_fee; ?>">
                <div class="input-field col s12">
                    <button id="confirm" class="btn cyan waves-effect waves-light" type="submit" name="action" <?php if($_POST['payment_type'] == 'Wallet') {if ($balance-$total < 0) {echo 'disabled'; }}?> style="width:100%;background-color: white;border: 1px solid #a21318;border-radius: 8px;font-size: 12px;">Place Order
                    <i class="mdi-action-shopping-cart right"></i>
                    </button>
                </div>
                </form>
            </ul>
        </div>
        </section>
    </div>

    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="#" target="_blank">Yaadi.Co</a> All rights reserved.</span>
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#">The Ambassadors</a></span>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>

    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                <?php
                $result = mysqli_query($con, "SELECT * FROM items");
                while($row = mysqli_fetch_array($result))
                {
                    echo $row["id"].'_name:{
				required: true,
				minlength: 5,
				maxlength: 20 
				},';
                    echo $row["id"].'_price:{
				required: true,	
				min: 0
				},';
                }
                echo '},';
                ?>
                messages: {
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM items");
                    while($row = mysqli_fetch_array($result))
                    {
                        echo $row["id"].'_name:{
				required: "Ener item name",
				minlength: "Minimum length is 5 characters",
				maxlength: "Maximum length is 20 characters"
				},';
                        echo $row["id"].'_price:{
				required: "Ener price of item",
				min: "Minimum item price is $. 0"
				},';
                    }
                    echo '},';
                    ?>
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
    </script>
    <script type="text/javascript">
        $("#formValidate1").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                price: {
                    required: true,
                    min: 0
                },
            },
            messages: {
                name: {
                    required: "Enter item name",
                    minlength: "Minimum length is 5 characters"
                },
                price: {
                    required: "Enter item price",
                    minlength: "Minimum item price is Rs.0"
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
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-153638148-1');
    </script>
    </body>

    </html>
    <?php
}
else
{
    if($_SESSION['customer_sid']==session_id())
    {
        header("location:index.php");
    }
    else{
        header("location:login.php");
    }
}
?>