<?php
include 'includes/connect.php';
if($_SESSION['restaurant_sid']==session_id())
{
    $user_id = $_SESSION['user_id'];
    $counter = 0;

    $sql = mysqli_query($con, "SELECT * FROM orders where restaurantid= $user_id AND not deleted;");
    while($row = mysqli_fetch_array($sql)){
        if ($row['status'] == "Yet to be delivered"){
            $counter += 1;
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
        <title>Today's Menu</title>
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
                    <ul class="right">
                        <li><a class="waves-effect waves-light modal-trigger" href="#modal1"><i class="mdi-content-add"></i></a></li>
                        <li><a class="waves-effect waves-light" href="all-r-orders.php?status=Yet%20to%20be%20delivered"><?php

                                $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND restaurantid LIKE $user_id;");
                                $count = 0;
                                $total = 0;
                                while($row = mysqli_fetch_array($getamount)) {
                                    $count++;
                                    $total = 0;
                                    $total+=$count;
                                }
                                if ($total == 0){
                                    echo '<span class="new badge" style="background-color: transparent;font-size: 12px;"><span style="color: yellow;">'.$total.'</span></span>';
                                }
                                else{
                                    echo '<span class="new badge" style="background-color: transparent;font-size: 12px;"><span style="color: yellow;">'.$total.'</span></span>';
                                }

                                ?></a></li>
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
                    <li class="bold active"><a href="restaurant.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i>Menu</a>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-shopping-basket"></i> Orders
                                    <?php

                                    $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND restaurantid LIKE $user_id;");
                                    $count = 0;
                                    $total = 0;
                                    while($row = mysqli_fetch_array($getamount)) {
                                        $count++;
                                        $total = 0;
                                        $total+=$count;
                                    }
                                    if ($total == 0){
                                        echo '<span class="new badge">'.$total.'</span>';
                                    }
                                    else{
                                        echo '<span class="new badge">'.$total.'</span>';
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
                    <li class="bold"><a href="place-new-order.php" class="waves-effect waves-cyan"><i class="mdi-action-shop-two"></i>Hanker Order</a>
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

            <!-- Modal Structure -->
            <div id="modal1" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <ul class="collection with-header collapsible z-depth-0">
                        <li class="collection-header"><h4>Add Item</h4><p class="caption">To add a meal or item, enter the following information below then click add item.</p></li>
                        <li class="collection-item" style="background-color: white;color: black;">

                            <form class="formValidate" id="formValidate1" method="post" action="routers/add-item.php" novalidate="novalidate">
                                <div class="row" id="addanitem">
                                        <table>
                                            <tbody>
                                            <?php

                                            echo '<tr><td><div class="input-field col s12"><label for="name">Name</label>';
                                            echo '<input id="name" name="name" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div>';
                                            echo '<div class="input-field col s12 "><label for="price" class="">Price</label>';
                                            echo '<input id="price" name="price" type="text" data-error=".errorTxt02"><div class="errorTxt02"></div>';
                                            if($user_id == "331"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Start the day</option>
                      <option value="1">Lunch & Beyond</option>
                      <option value="2">Subs</option>
                      <option value="3">Wraps</option>
                      <option value="4">Chinese Fare</option>
                      <option value="5">Jamaican Fare</option>
                      <option value="6">Roti</option>
                      <option value="7">Soups</option>
                      <option value="8">Appetizers</option>
                      <option value="9">Salads</option>
                      <option value="10">Seafood</option>
                      <option value="11">Poultry</option>
                      <option value="12">From the Grill</option>
                      <option value="13">Vegetarian</option>
                      <option value="14">Pasta Fusion</option>
                      <option value="15">Eat, Meet, Sip, Talk</option>
                      <option value="16">Sides</option>
                      <option value = "17"> Mothers Day Special </option >
                      <option value = "18"> Fathers Day Special </option >
                    </select>';

                                            }
                                            else if($user_id == "430"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Salads</option>
                      <option value="1">Platters</option>
                      <option value="2">Burgers</option>
                      <option value="3">Wraps & Quesadillas</option>
                      <option value="4">Pastas</option>
                      <option value="5">Vegetarian</option>
                      <option value="6">Lunch Specials</option>
                    <option value="7">Deserts</option>
                    <option value="8">Main Courses</option>
                    <option value="9">Mix Drinks</option>
                    <option value="10">Side Orders</option>
                    <option value="11">Starters</option>
                    <option value="12">Specials</option>
                    </select>';

                                            }
                                            else if($user_id == "80"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Amazin 4</option>
                      <option value="1">Wings</option>
                      <option value="2">Sides</option>
                      <option value="3">Beverages</option>
                      <option value="4">Desserts</option>
                      <option value="5">Pasta</option>
                      <option value="6">Hut Combos</option>
                    </select>';

                                            }
                                            else if($user_id == "57"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Patties</option>
                      <option value="1">Chicken</option>
                      <option value="2">Burgers</option>
                      <option value="3">Breakfast Sandwiches</option>
                      <option value="4">Breakfast Meals</option>
                      <option value="5">Sandwiches</option>
                      <option value="6">Beverages</option>
                      <option value="7">Soups</option>
                      <option value = "8">Ice Cream</option>
                      <option value = "9">Pastry</option>
                    </select>';

                                            }
                                            else if($user_id == "79"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Specialty Pizza</option>
                      <option value="1">Chicken</option>
                      <option value="2">Sides</option>
                      <option value="3">Drinks</option>
                      <option value="4">Desserts</option>
                    </select>';

                                            }
                                            else if($user_id == "486"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Breakfast</option>
                      <option value="1">Lunch</option>
                      <option value="2">Dinner</option>
                      <option value="3">Dessert</option>
                      <option value="4">Sides</option>
                      <option value="5">Soup of the day</option>
                    </select>';

                                            }
                                            else if($user_id == "8"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Chicken</option>
                      <option value="1">Fish</option>
                      <option value="2">Sides</option>
                      <option value="3">Served With</option>
                      <option value="4">Meat</option>
                      <option value="5">Beverages</option>
                      <option value="6">Done to Order</option>
                      <option value="7">Pastries</option>
                    </select>';

                                            }
                                            else if($user_id == "53"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Big Deal</option>
                      <option value="1">Meal Deal</option>
                      <option value="2">Zingers</option>
                      <option value="3">Big Six</option>
                      <option value="4">Buckets</option>
                      <option value="5">Big Boxes</option>
                      <option value="6">Wings</option>
                    <option value="7">Krispers</option>
                    <option value="8">Value</option>
                    <option value="9">Sides</option>
                    <option value="10">Popcorn Chicken</option>
                    <option value="11">Salads</option>
                    <option value="12">Desserts</option>
                    <option value="13">Drinks</option>
                    <option value="14">Catering</option>
                    <option value="15">Secret Menu</option>
                    </select>';

                                            }
                                            else if($user_id == "540"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Appetizers</option>
                      <option value="1">Soup of day</option>
                      <option value="2">Entrees</option>
                      <option value="3">Steak</option>
                      <option value="4">Seafood</option>
                      <option value="5">Chicken</option>
                      <option value="6">Side Order</option>
                      <option value="7">Sauces</option>
                      <option value="8">Desserts</option>
                      <option value="9">Beverages</option>
                    </select>';

                                            }

                                            else if($user_id == "294"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Cakes</option>
                      <option value="1">Pastries</option>
                    </select>';

                                            }
                                            else if($user_id == "259"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Lunch Box Meals</option>
                      <option value="1">Fat 2 Fit Salads</option>
                      <option value="2">Lunch Box Specials</option>
                      <option value="3">Soups & Appetizers</option>
                      <option value="4">Chicken Dishes</option>
                      <option value="5">Chop Suey (Veg.)</option>
                      <option value="6">Tofu Dishes</option>
                      <option value="7">Pork Dishes</option>
                      <option value="8">Noodle Dishes</option>
                      <option value="9">Seafood Dishes</option>
                      <option value="10">Fried Rice</option>
                      <option value="11">Drinks</option>
                    </select>';

                                            }
                                            else if($user_id == "591"){
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Omelets</option>
                      <option value="1">Salads</option>
                      <option value="2">Specialty Burgers</option>
                      <option value="3">Pancakes & Waffles</option>
                      <option value="4">Parfaits / Muesli</option>
                      <option value="5">Wraps</option>
                      <option value="6">Tacos / Nachos</option>
                      <option value="7">Gyros</option>
                    </select>';

                                            }

                                            else if ($user_id == "1293") {
                                                echo '<select class="col s12 browser-default" name="category">
                        <option value="0">All</option>
                    </select>';
                                            }

                                            else if ($user_id == "54") {
                                                echo '<select class="col s12 browser-default" name="category">
                        <option value="0">Featured</option>
                        <option value="1">Chicken</option>
                        <option value="2">Yabba</option>
                        <option value="3">Sandwiches</option>
                        <option value="4">Soup</option>
                        <option value="5">Sides</option>
                        <option value="6">Beverages</option>
                        <option value="7">Nuggets</option>
                    </select>';
                                            }

                                            else {
                                                echo '<select class="col s12 browser-default" name="category">
                      <option value="0">Grains</option>
                      <option value="1">Entrees</option>
                      <option value="2">Sides</option>
                      <option value="3">Beverages</option>
                    </select>';
                                            }
                                            echo '<div class="input-field col s12"><label for="description">Description</label>';
                                            echo '<input id="description" name="description" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';
                                            echo '<td></tr>';
                                            ?>
                                            </tbody>
                                        </table>
                                </div>

                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="waves-effect waves-green btn-flat" type="submit" name="action" >Add item</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <ul class="collection with-header collapsible z-depth-0">
                    <li class="collection-header"><h4><?php echo $name; ?><a class="waves-effect waves-light modal-trigger right" href="#." style="font-size: 18px;"><i class="mdi-av-playlist-add"></i></a></h4><p class="caption">Welcome to your menu Tap <i class="mdi-content-add"></i> to add a new item</p></li>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM items where restaurantid = $user_id");
                        while($row = mysqli_fetch_array($result))
                        {
                            if ($row['deleted'] == "0"){
                                $text1 = 'selected';
                                $text2 = '';
                            }
                            if ($row['deleted'] == "1"){
                                $text1 = '';
                                $text2 = 'selected';
                            }

                            if ($row['category'] == "0"){
                                $cat1 = "Selected";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";
                            }
                            else if ($row['category'] == "1"){
                                $cat1 = "";
                                $cat2 = "Selected";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "2"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "Selected";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "3"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "Selected";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "4"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "Selected";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "5"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "Selected";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "6"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "Selected";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "7"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "Selected";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "8"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "Selected";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "9"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "Selected";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "10"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "Selected";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "11"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "Selected";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "12"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "Selected";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "13"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "Selected";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "14"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "Selected";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "15"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "Selected";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "16"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "Selected";
                                $cat18 = "";                    }
                            else if ($row['category'] == "17"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "Selected";
                            }
                            else if ($row['category'] == "18"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";
                                $cat19 = "Selected";
                            }

                            echo '<li  id="'.$row['id'].'" class="collection-item avatar" style="background-color: white;color: black;margin: 0 0 30px 0;border-radius: 8px;border-top: 8px solid #A82128;">
      <img src="'.$row["img_addr"].'" alt="" class="circle">
      <h6 class="title">'.$row["name"].'</h6>
      <h6 style="color: mediumseagreen;">$'.$row["price"].'</h6>
      <h6>Description: '.$row["description"].'</h6>
      ';


                            echo '<ul class="collapsible z-depth-0" data-collapsible="accordion">';

                            echo '
						<li>
							<div class="collapsible-header"><i class="mdi-notification-event-available"></i>Availability & Category</div>
							<div class="collapsible-body">';
                            echo  '
                    <div class="row">
                     <form class="formValidate" id="formValidate" action="/routers/hide_show.php" method="post" novalidate="novalidate">
                     <input  type="hidden" id="item" name="item" value="'.$row['id'].'">
                    <p><select class="col s12 browser-default" id="hide_showval" name="hide_show">
                    <option value="0"'.(!$row['deleted'] ? 'selected' : '').'>Available</option>
                     <option value="1"'.($row['deleted'] ? 'selected' : '').'>Not Available</option>
                    </select></p>';

                            if ($user_id == "331"){
                                echo '<div class="row">
                    <p><select class="col s12 browser-default" id="category" name = "category">
                      <option value = "0" '.$cat1.'>Start the day </option >
                      <option value = "1" '.$cat2.'>Lunch & Beyond </option >
                      <option value = "2" '.$cat3.'>Subs</option >
                      <option value = "3" '.$cat4.'>Wraps</option >
                      <option value = "4" '.$cat5.'>Chinese Fare </option >
                      <option value = "5" '.$cat6.'>Jamaican Fare </option >
                      <option value = "6" '.$cat7.'>Roti</option >
                      <option value = "7" '.$cat8.'>Soups</option >
                      <option value = "8" '.$cat9.'>Appetizers</option >
                      <option value = "9" '.$cat10.'>Salads</option >
                      <option value = "10" '.$cat11.'>Seafood</option >
                      <option value = "11" '.$cat12.'>Poultry</option >
                      <option value = "12" '.$cat13.'>From the Grill </option >
                      <option value = "13" '.$cat14.'>Vegetarian</option >
                      <option value = "14" '.$cat15.'>Pasta Fusion </option >
                      <option value = "15" '.$cat16.'>Eat, Meet, Sip, Talk </option >
                      <option value = "16" '.$cat17.'>Sides</option >
                      <option value = "17" '.$cat18.'>Mothers Day Special </option >
                      <option value = "18" '.$cat19.'>Fathers Day Special </option >
                    </select></p>
                     </div>';
                            }

                            else if ($user_id == "430") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Salads</option>
                      <option value="1" '.$cat2.'>Platters</option>
                      <option value="2" '.$cat3.'>Burgers</option>
                      <option value="3" '.$cat4.'>Wraps & Quesadillas</option>
                      <option value="4" '.$cat5.'>Pastas</option>
                      <option value="5" '.$cat6.'>Vegetarian</option>
                      <option value="6" '.$cat7.'>Lunch Specials</option>
                    <option value="7" '.$cat8.'>Deserts</option>
                    <option value="8" '.$cat9.'>Main Courses</option>
                    <option value="9" '.$cat10.'>Mix Drinks</option>
                    <option value="10" '.$cat11.'>Side Order</option>
                    <option value="11" '.$cat12.'>Starters</option>
                    <option value="12"'.$cat13.'>Specials</option>
                    </select></p>';
                            }
                            else if ($user_id == "53") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Big Deal</option>
                      <option value="1" '.$cat2.'>Meal Deal</option>
                      <option value="2" '.$cat3.'>Zingers</option>
                      <option value="3" '.$cat4.'>Big Six</option>
                      <option value="4" '.$cat5.'>Buckets</option>
                      <option value="5" '.$cat6.'>Big Boxes</option>
                      <option value="6" '.$cat7.'>Wings</option>
                    <option value="7" '.$cat8.'>Krispers</option>
                    <option value="8" '.$cat9.'>Value</option>
                    <option value="9" '.$cat10.'>Sides</option>
                    <option value="10" '.$cat11.'>Popcorn Chicken</option>
                    <option value="11" '.$cat12.'>Salads</option>
                    <option value="12"'.$cat13.'>Desserts</option>
                    <option value="13"'.$cat14.'>Drinks</option>
                    <option value="14"'.$cat15.'>Catering</option>
                    <option value="15"'.$cat16.'>Secret Menu</option>
                    </select></p>';
                            }

                            else if ($user_id == "80") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Amazin 4</option>
                      <option value="1" '.$cat2.'>Wings</option>
                      <option value="2" '.$cat3.'>Sides</option>
                      <option value="3" '.$cat4.'>Beverages</option>
                      <option value="4" '.$cat5.'>Desserts</option>
                      <option value="5" '.$cat6.'>Pasta</option>
                      <option value="6" '.$cat7.'>Hut Combos</option>
                    </select></p>';
                            }

                            else if ($user_id == "57") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Patties</option>
                      <option value="1" '.$cat2.'>Chicken</option>
                      <option value="2" '.$cat3.'>Burgers</option>
                      <option value="3" '.$cat4.'>Breakfast Sandwiches</option>
                      <option value="4" '.$cat5.'>Breakfast Meals</option>
                      <option value="5" '.$cat6.'>Sandwiches</option>
                      <option value="6" '.$cat7.'>Beverages</option>
                      <option value="7" '.$cat8.'>Soups</option>
                      <option value = "8" '.$cat9.'>Ice Cream</option>
                      <option value = "9" '.$cat10.'>Pastry</option>
                    </select></p>';
                            }

                            else if ($user_id == "294") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Cakes</option>
                      <option value="1" '.$cat2.'>Pastries</option>
                    </select></p>';
                            }

                            else if ($user_id == "79") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Specialty Pizza</option>
                      <option value="1" '.$cat2.'>Chicken</option>
                      <option value="2" '.$cat3.'>Sides</option>
                      <option value="3" '.$cat4.'>Drinks</option>
                      <option value="4" '.$cat5.'>Desserts</option>
                    </select></p>';
                            }

                            else if ($user_id == "486") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Breakfast</option>
                      <option value="1" '.$cat2.'>Lunch</option>
                      <option value="2" '.$cat3.'>Dinner</option>
                      <option value="3" '.$cat4.'>Dessert</option>
                      <option value="4" '.$cat5.'>Sides</option>
                      <option value="5" '.$cat6.'>Soup of the day</option>
                    </select></p>';
                            }
                            else if ($user_id == "8") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Chicken</option>
                      <option value="1" '.$cat2.'>Fish</option>
                      <option value="2" '.$cat3.'>Sides</option>
                      <option value="3" '.$cat4.'>Served With</option>
                      <option value="4" '.$cat5.'>Meat</option>
                      <option value="5" '.$cat6.'>Beverages</option>
                      <option value="6" '.$cat7.'>Done to Order</option>
                      <option value="7" '.$cat8.'>Pastries</option>
                    </select></p>';
                            }
                            else if ($user_id == "540") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                      <option value="0" '.$cat1.'>Appetizers</option>
                      <option value="1" '.$cat2.'>Soup of day</option>
                      <option value="2" '.$cat3.'>Entrees</option>
                      <option value="3" '.$cat4.'>Steak</option>
                      <option value="4" '.$cat5.'>Seafood</option>
                      <option value="5" '.$cat6.'>Chicken</option>
                      <option value="6" '.$cat7.'>Side Order</option>
                      <option value="7" '.$cat8.'>Sauces</option>
                      <option value="8" '.$cat8.'>Desserts</option>
                      <option value="9" '.$cat8.'>Beverages</option>
                    </select></p>';
                            }
                            else if ($user_id == "259") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                        <option value="0" '.$cat1.'>Lunch Box Meals</option>
                      <option value="1" '.$cat2.'>Fat 2 Fit Salads</option>
                      <option value="2" '.$cat3.'>Lunch Box Specials</option>
                      <option value="3" '.$cat4.'>Soups & Appetizers</option>
                      <option value="4" '.$cat5.'>Chicken Dishes</option>
                      <option value="5" '.$cat6.'>Chop Suey (Veg.)</option>
                      <option value="6" '.$cat7.'>Tofu Dishes</option>
                      <option value="7" '.$cat8.'>Pork Dishes</option>
                      <option value="8" '.$cat9.'>Noodle Dishes</option>
                      <option value="9" '.$cat10.'>Seafood Dishes</option>
                      <option value="10" '.$cat11.'>Fried Rice</option>
                      <option value="11" '.$cat12.'>Drinks</option>
                    </select></p>';
                            }
                            else if ($user_id == "591") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                        <option value="0" ' . $cat1 . '>Omelets</option>
                      <option value="1" ' . $cat2 . '>Salads</option>
                      <option value="2" ' . $cat3 . '>Specialty Burgers</option>
                      <option value="3" ' . $cat4 . '>Pancakes & Waffles</option>
                      <option value="4" ' . $cat5 . '>Parfaits / Muesli</option>
                      <option value="5" ' . $cat6 . '>Wraps</option>
                      <option value="6" ' . $cat7 . '>Tacos / Nachos</option>
                      <option value="7" ' . $cat8 . '>Gyros</option>
                    </select></p>';
                            }

                            else if ($user_id == "54") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                        <option value="0" '.$cat1.'>Featured</option>
                        <option value="1" '.$cat2.'>Chicken</option>
                        <option value="2" '.$cat3.'>Yabba</option>
                        <option value="3" '.$cat4.'>Sandwiches</option>
                        <option value="4" '.$cat5.'>Soup</option>
                        <option value="5" '.$cat6.'>Sides</option>
                        <option value="6" '.$cat7.'>Beverages</option>
                        <option value="7" '.$cat8.'>Nuggets</option>
                    </select></p>';
                            }
                            else if ($user_id == "1293") {
                                echo '<p><select class="col s12 browser-default" id="category" name="category">
                        <option value="0" '.$cat1.'>All</option>
                    </select></p>';
                            }

                            echo'<br>
<p><button class="btn-flat waves-effect waves-light black-text left" style="border-radius: 6px;background-color: white;border: 1px solid maroon;font-size: 10px;color: black;width: 100%;" id="hideshowbtn" type="submit" value="Change" name="submithide">Change Status
 <i class="mdi-image-assistant-photo right" style="color: maroon;"></i>
 </button></p>
                    </form>
                    </div>';
                        echo'
							</div>
						</li>';

                        echo '</ul>';

                            echo '<ul class="collapsible z-depth-0" data-collapsible="accordion">';
						echo '
						<li>
							<div class="collapsible-header"><i class="mdi-image-add-to-photos"></i>Image</div>
							<div class="collapsible-body">';
								echo '<div>
                    <form action="routers/upload.php?id=&resname=" method="post" enctype="multipart/form-data">
                    <span><div class="btn col s12">
                   <input type="file" name="fileToUpload" id="fileToUpload"">
                  </div></span><br>
                              <input type="hidden" name="item" value="'.$row["id"].'">
                              <input type="hidden" name="restname" value="'.$name.'">
                              <p><button class="btn-flat waves-effect waves-light black-text z-depth-1" style="border-radius: 6px;background-color: white;border: 1px solid maroon;font-size: 10px;color: maroon;width: 100%;" type="submit" name="submit">Upload
                              <i class="mdi-image-blur-on right" style="color: maroon;"></i>
                              </button></p>
                            </form>
                            </div>';
                        echo'
							</div>
						</li>';

					echo '</ul>';

                    echo '
      <a href="#." class="secondary-content waves-effect waves-light collapsible-header" style="border-bottom: 0px solid white;background-color: transparent;"><label style="font-size: 12px;">Info</label><i class="mdi-navigation-arrow-drop-down-circle" style="font-size: 21px;"></i></a>
      <div class="collapsible-body">
      
      
      <table cellspacing="0">
                        <tbody style="border: 5px solid white;">
                    <tr><td>
                    <form class="formValidate" id="formValidate" method="post" action="routers/menu-router-restaurant.php" novalidate="novalidate">
                        <div class="input-field col s9">
                        <input type="hidden" name="editid" value="'.$row['id'].'">
                        <label for="'.$row["id"].'_name">Item name</label>
                    <input value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;">
                    <div class="errorTxt'.$row["id"].'"></div>
                    </div>
                    
                    <div class="input-field col s3">
                    <label for="'.$row["id"].'_price">Price</label>
                    <input value="'.$row["price"].'" id="'.$row["id"].'_price" name="'.$row['id'].'_price" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;">
                    <div class="errorTxt'.$row["id"].'"></div>
                    </div>

                    <div class="input-field col s12"><label for="'.$row["id"].'_description">Description</label>
                    <textarea value="'.$row["description"].'" placeholder="'.$row["description"].'" id="'.$row["id"].'_description" name="'.$row['id'].'_description" type="text" data-error=".errorTxt'.$row["id"]. '" style="border-bottom-right-radius: 8px;border-bottom-left-radius: 0px;border-bottom: 1px solid black;border-left: 0px solid antiquewhite;border-right: 0px solid antiquewhite;border-top: 0px solid antiquewhite;width: 100%;height: 80px;">' .$row["description"].'</textarea><div class="errorTxt'.$row["id"].'"></div>
                    </div>
                    <div class="input-field col s12">
                    <table>
                    <tr><td><ul class="collapsible z-depth-0" data-collapsible="accordion">
                    <li>
							<div class="collapsible-header">Flavor<span class=""><i class="mdi-image-looks-one" style="color: #a21318;"></i></span></div>
							<div class="collapsible-body">
							
					<p class="col s9"><input placeholder="Add a Variation" value="'.$row["typeone"].'" id="'.$row["id"].'_typeone" name="'.$row['id'].'_typeone" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["onee"].'" id="'.$row["id"].'_onee" name="'.$row['id'].'_onee" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type2"].'" id="'.$row["id"].'_type2" name="'.$row['id'].'_type2" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["two"].'" id="'.$row["id"].'_two" name="'.$row['id'].'_two" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type3"].'" id="'.$row["id"].'_type3" name="'.$row['id'].'_type3" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["three"].'" id="'.$row["id"].'_three" name="'.$row['id'].'_three" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type4"].'" id="'.$row["id"].'_type4" name="'.$row['id'].'_type4" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["four"].'" id="'.$row["id"].'_four" name="'.$row['id'].'_four" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
							</div>
						</li>
						</ul></td></tr>
                    
                    
                    <tr><td>
                    <ul class="collapsible z-depth-0" data-collapsible="accordion">
						<li>
							<div class="collapsible-header">Type<span><i class="mdi-image-looks-two" style="color: #a21318;"></i></span></div>
							
							<div class="collapsible-body">
					<p class="col s9"><input placeholder="Add a Variation" value="'.$row["type5"].'" id="'.$row["id"].'_type5" name="'.$row['id'].'_type5" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
					<p class="col s3"><input placeholder="Variation Price" value="'.$row["five"].'" id="'.$row["id"].'_five" name="'.$row['id'].'_five" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type6"].'" id="'.$row["id"].'_type6" name="'.$row['id'].'_type6" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["six"].'" id="'.$row["id"].'_six" name="'.$row['id'].'_six" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type7"].'" id="'.$row["id"].'_type7" name="'.$row['id'].'_type7" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["seven"].'" id="'.$row["id"].'_seven" name="'.$row['id'].'_seven" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type8"].'" id="'.$row["id"].'_type8" name="'.$row['id'].'_type8" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["eight"].'" id="'.$row["id"].'_eight" name="'.$row['id'].'_eight" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
								
							</div>
						</li>
						</ul></td></tr>
                   
                    
                    <tr><td>
                    <ul class="collapsible z-depth-0" data-collapsible="accordion">
						<li>
							<div class="collapsible-header">Side<span><i class="mdi-image-looks-3" style="color: #a21318;"></i></span></div>
							
							<div class="collapsible-body">
					<p class="col s9"><input placeholder="Add a Variation" value="'.$row["type9"].'" id="'.$row["id"].'_type9" name="'.$row['id'].'_type9" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
					<p class="col s3"><input placeholder="Variation Price" value="'.$row["nine"].'" id="'.$row["id"].'_nine" name="'.$row['id'].'_nine" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["type10"].'" id="'.$row["id"].'_type10" name="'.$row['id'].'_type10" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["ten"].'" id="'.$row["id"].'_ten" name="'.$row['id'].'_ten" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["typeeleven"].'" id="'.$row["id"].'_typeeleven" name="'.$row['id'].'_typeeleven" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["eleven"].'" id="'.$row["id"].'_eleven" name="'.$row['id'].'_eleven" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["typetwelve"].'" id="'.$row["id"].'_typetwelve" name="'.$row['id'].'_typetwelve" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["twelve"].'" id="'.$row["id"].'_twelve" name="'.$row['id'].'_twelve" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>		
								
							</div>
						</li>
						</ul></td></tr>
                    <tr><td><ul class="collapsible z-depth-0" data-collapsible="accordion">
						<li>
							<div class="collapsible-header">Drink<span><i class="mdi-image-looks-4" style="color: #a21318;"></i></span></div>
							<div class="collapsible-body">
					<p class="col s9"><input placeholder="Add a Variation" value="'.$row["typethirteen"].'" id="'.$row["id"].'_typethirteen" name="'.$row['id'].'_typethirteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
					<p class="col s3"><input placeholder="Variation Price" value="'.$row["thirteen"].'" id="'.$row["id"].'_thirteen" name="'.$row['id'].'_thirteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["typefourteen"].'" id="'.$row["id"].'_typefourteen" name="'.$row['id'].'_typefourteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["fourteen"].'" id="'.$row["id"].'_fourteen" name="'.$row['id'].'_fourteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["typefifteen"].'" id="'.$row["id"].'_typefifteen" name="'.$row['id'].'_typefifteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["fifteen"].'" id="'.$row["id"].'_fifteen" name="'.$row['id'].'_fifteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    
                    <p class="col s9"><input placeholder="Add a Variation" value="'.$row["typesixteen"].'" id="'.$row["id"].'_typesixteen" name="'.$row['id'].'_typesixteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
                    <p class="col s3"><input placeholder="Variation Price" value="'.$row["sixteen"].'" id="'.$row["id"].'_sixteen" name="'.$row['id'].'_sixteen" type="text" data-error=".errorTxt'.$row["id"].'" style="border-bottom-right-radius: 8px;border-bottom: 1px solid black;"></p>
                    <div class="errorTxt'.$row["id"].'"></div>
							</div>
						</li>
						</ul>
                    
</td></tr>
                    </tbody>
                    </table>
                    
                    <div class="input-field col s12" id="updatediv">
                              <button class="btn-flat waves-effect waves-light black-text left" type="submit" name="action" style="border-radius: 6px;background-color: white;border: 1px solid maroon;font-size: 10px;color: black;width: 100%;">Update Meal
                                <i class="mdi-notification-event-available right"></i>
                              </button>
                            </div>
                            </form>';

echo '</td></tr></tbody>
                    </table></div></li>';
                        }
                        ?>

                </ul>
                </div>
<span id="message"></span>

        </div>
        </section>
    </div>

<!--    <div id="addcategory" class="modal">-->
<!--        <div class="modal-content" style="border-radius: 8px;">-->
<!--            <h5>Add Category</h5>-->
<!--            <form class="col s12" method="post" action="routers/add-category.php">-->
<!--                <div class="row">-->
<!--                    --><?php
//                    $getcat = mysqli_query($con, "SELECT * FROM items where restaurantid = $user_id");
//                    while($row = mysqli_fetch_array($getcat))
//                    {
//                    ?>
<!--                    <div class="input-field col s6">-->
<!--                        <i class="mdi-action-shopping-basket"></i>-->
<!--                        <input placeholder="Variation Price" value="--><?php //echo $row["two"]; ?><!--" id="--><?php //echo ''.$row["id"].'_two'; ?><!--" name="--><?php //echo ''.$row["id"].'_two'; ?><!--" type="text">-->
<!--                        <label for="category1">Category</label>-->
<!--                    </div>-->
<!--                    <div class="input-field col s6">-->
<!--                        <i class="mdi-action-shopping-basket"></i>-->
<!--                        <input id="category2" type="text" class="validate">-->
<!--                        <label for="category2">Category</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--        <div class="modal-footer">-->
<!--            <a type="submit" class="modal-close waves-effect waves-green btn-flat submit">Agree</a>-->
<!--        </div>-->
<!--    </div>-->

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
        $(document).ready(function () {
            HideShowBTN();
        })
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
				required: "Enter item name",
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

        function HideShowBTN() {
            $(document).on('click', "#hideshowbtnn", function (e) {
                e.preventDefault();
                var hideshow = $('#hide_showval').val();
                var category = $('#category').val();
                var item = $('#item').val();

                if (hideshow === '' || category === '' || item === ''){
                    Materialize.toast('Theres an error...', 8000);

                }
                else {
                    $.ajax({
                        url: '../routers/hide_show.php',
                        method: 'post',
                        data:{hide_show:hideshow,category:category,item:item},
                        success: function (data) {
                            $('#message').html(data);

                        }
                    })
                }
            })
        }

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