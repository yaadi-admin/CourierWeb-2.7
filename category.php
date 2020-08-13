<?php
include 'includes/connect.php';
include 'includes/wallet.php';
if($_SESSION['customer_sid']==session_id())
{
    $selec_rest = $_GET['pgid'];
    $restid = $_GET['pgid'];
    $Rnme = '';
    $counter = 0;
    $image_dir = "";

    $result = mysqli_query($con, "SELECT * FROM users where id= $restid AND not deleted;");
    while($row = mysqli_fetch_array($result))
    {
        $image = $row['image_dir'];

        if ($image != ''){
            $image_dir = $image;
        }
        else if ($image == ''){
            $image_dir = 'images/yaadi-food.jpg';
        }
    }

    if(!empty($_SESSION["shopping_cart"]))
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
            $counter += 1;
        }

    }
    $result = mysqli_query($con, "SELECT * FROM users where id= $restid AND not deleted;");
    while($row = mysqli_fetch_array($result))
    {
        $restid = $selec_rest;
        $Rnme = $row['name'];
    }

    if(isset($_POST["add_to_cart"]))  {
        if(isset($_SESSION["shopping_cart"]))  {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if(!in_array($_GET["id"], $item_array_id))
            {
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id'               =>     $_GET["id"],
                    'item_name'               =>     $_POST["hidden_name"],
                    'item_price'          =>     $_POST["hidden_price"],
                    'item_quantity'          =>     $_POST["quantity"],
                    'item_variation'        =>    $_POST["variation"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                $Itemnm = $_POST["hidden_name"];
                echo '<script>alert("'.$Itemnm.' was added to your cart");</script>';
            }
            else
            {
                echo '<script>alert("Item Already Added To Cart")</script>';
                echo '<script>window.location="category.php?pgid='.$restid.'"</script>';
            }
        }
        else
        {
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"],
                'item_variation'        =>    $_POST["variation"]
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
                    echo '<script>window.location="category.php?pgid='.$restid.'"</script>';
                }
            }
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
        <title>Menu</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/stylecategory.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
        <style type="text/css">
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
            @media (min-width: 20px) and (max-width: 450px)
            {
                .menu-restaurant
                {
                    width: 100%;
                }
            }
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
                        <li><h1 class="logo-wrapper" style="font-size:42px;"><a href="index.php" class="brand-logo darken-1" style="font-size:40px;font-family: 'Open Sans', ;font-family: 'Akronim';">Yaadi<span style="font-size: 16px;color: mediumspringgreen;"> Food Delivery</span></a><span class="logo-text">Logo</span></h1></li>
                    </ul>

                    <ul class="right" style="background-color: transparent;border: 0px;margin 0px;margin-bottom: 0px;">
                        <li>
                            <a id="viewcart" class="waves-effect waves-light modal-trigger" href="#modal1" style="color: white;"><i class="mdi-action-shopping-basket"></i></a>

                        </li>

                    </ul>

                </div>

            </nav>
        </div>
    </header>

    <div id="main">
        <div class="wrapper">
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav menu fixed leftnavset">
                    <nav>
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
                        <li class="bold active"><a href="index.php"><i class="mdi-editor-border-color"></i>Order Food</a>
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
                        <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i>Account</a>
                        </li>
                    </nav>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu" style="color: mediumaquamarine;"></i></a>
            </aside>

            <section id="content">
                <div id="breadcrumbs-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m12 l12" style="background: url(<?php echo $image_dir; ?>) repeat fixed center;border-radius: 16px;border-top-left-radius: 0px;border-top-right-radius: 0px;">
                                <div class="col s4 m4 l4">
                                    <img src="<?php echo  $image_dir; ?>" alt="" class="circle responsive-img valign profile-image" width="80px;" height="80px;" style="object-fit: scale-down;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Notice Board-->
                <div class="container">
                    <p class="caption">
                    <blockquote style="border-radius: 8px;">

                        <b>Welcome to <?php echo $Rnme; ?> ♨️</b>
                        <div class="responsive col-md-10 text-center" id="menu-filters">
                            <ul>

                                <?php

                                $result3 = mysqli_query($con, "SELECT * FROM users where id= $restid AND not deleted;");
                                while($row = mysqli_fetch_array($result3))
                                {
                                    $restid = $selec_rest;
                                    $Rnme = $row['name'];

                                    if ($row['name'] == "O M G") {
                                        echo '<div class="fixed-action-btn" style="width: 320px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".Starttheday" style="background-color: white;color: black;font-weight: 800;">🌭 Start the day</a></li>
                                                         <li class="right"><a class="filter " data-filter=".LunchBeyond" style="background-color: white;color: black;font-weight: 800;">🍔 Lunch & Beyond</a></li>
                                                         <li class="left"><a class="filter" data-filter=".Subs" style="background-color: white;color: black;font-weight: 800;">🌯 Subs</a></li>
                                                         <li class="right"><a class="filter" data-filter=".Wraps" style="background-color: white;color: black;font-weight: 800;">🌯 Wraps</a></li>
                                                          <li class="left"><a class="filter" data-filter=".ChineseFare" style="background-color: white;color: black;font-weight: 800;">🥡 Chinese Fare</a></li>
                                                          <li class="right"><a class="filter" data-filter=".JamaicanFare" style="background-color: white;color: black;font-weight: 800;">Jamaican Fare</a></li>
                                                          <li class="left"><a class="filter" data-filter=".Roti" style="background-color: white;color: black;font-weight: 800;">🌯 Roti</a></li>
                                                          <li class="right"><a class="filter" data-filter=".Soups" style="background-color: white;color: black;font-weight: 800;">🍲 Soups</a></li>
                                                          <li class="left"><a class="filter" data-filter=".Appetizers" style="background-color: white;color: black;font-weight: 800;">🍗 Appetizers</a></li>
                                                          <li class="right"><a class="filter" data-filter=".Salads" style="background-color: white;color: black;font-weight: 800;">🥗 Salads</a></li>
                                                          <li class="left"><a class="filter" data-filter=".Seafood" style="background-color: white;color: black;font-weight: 800;">🍣 Seafood</a></li>
                                                          <li class="right"><a class="filter" data-filter=".Poultry" style="background-color: white;color: black;font-weight: 800;">🍗 Poultry</a></li>
                                                          <li class="left"><a class="filter" data-filter=".FromtheGrill" style="background-color: white;color: black;font-weight: 800;">🥩 From the Grill</a></li>
                                                          <li class="right"><a class="filter" data-filter=".Vegetarian" style="background-color: white;color: black;font-weight: 800;">🥦 Vegetarian</a></li>
                                                          <li class="left"><a class="filter" data-filter=".PastaFusion" style="background-color: white;color: black;font-weight: 800;">🍝 Pasta Fusion</a></li>
                                                          <li class="left"><a class="filter" data-filter=".EatMeetSipTalk" style="background-color: white;color: black;font-weight: 800;">🍹 Eat, Meet, Sip, Talk</a></li>
                                                          <li class="right"><a class="filter" data-filter=".Sides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
  </ul>
</div>
        ';
                                    }
                                    else if ($row['name'] == "K.F.C") {
                                        echo '<div class="fixed-action-btn" style="width: 320px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".bigdeal" style="background-color: white;color: black;font-weight: 800;">🍗 Big Deal</a></li>
                                                         <li class="right"><a class="filter " data-filter=".mealdeal" style="background-color: white;color: black;font-weight: 800;">🍗 Meal Deal</a></li>
                                                         <li class="left"><a class="filter" data-filter=".zingers" style="background-color: white;color: black;font-weight: 800;">🍔 Zingers</a></li>
                                                         <li class="right"><a class="filter" data-filter=".bigsix" style="background-color: white;color: black;font-weight: 800;">🍗 Big Six</a></li>
                                                          <li class="left"><a class="filter" data-filter=".buckets" style="background-color: white;color: black;font-weight: 800;">🥡 Buckets</a></li>
                                                          <li class="right"><a class="filter" data-filter=".bigboxes" style="background-color: white;color: black;font-weight: 800;">📦 Big Boxes</a></li>
                                                          <li class="left"><a class="filter" data-filter=".wings" style="background-color: white;color: black;font-weight: 800;">🍗 Wings</a></li>
                                                          <li class="right"><a class="filter" data-filter=".krispers" style="background-color: white;color: black;font-weight: 800;">🍖 Krispers</a></li>
                                                          <li class="left"><a class="filter" data-filter=".value" style="background-color: white;color: black;font-weight: 800;">🍗 Value</a></li>
                                                          <li class="right"><a class="filter" data-filter=".kfsides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
                                                          <li class="left"><a class="filter" data-filter=".popcornchicken" style="background-color: white;color: black;font-weight: 800;">🍿 Popcorn Chicken</a></li>
                                                          <li class="right"><a class="filter" data-filter=".kfsalads" style="background-color: white;color: black;font-weight: 800;">🥗 Salads</a></li>
                                                          <li class="left"><a class="filter" data-filter=".desserts" style="background-color: white;color: black;font-weight: 800;">🥧 Desserts</a></li>
                                                          <li class="right"><a class="filter" data-filter=".drinks" style="background-color: white;color: black;font-weight: 800;">🍹 Drinks</a></li>
                                                          <li class="left"><a class="filter" data-filter=".catering" style="background-color: white;color: black;font-weight: 800;">🍗 Catering</a></li>
  </ul>
</div>
        ';
                                    }
                                    else if ($row['name'] == "Burger King") {
                                        echo '<div class="fixed-action-btn" style="width: 320px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".bkburgers" style="background-color: white;color: black;font-weight: 800;">🍔 Burgers</a></li>
                                                         <li class="right"><a class="filter " data-filter=".otherfavourites" style="background-color: white;color: black;font-weight: 800;">🍗 Other Favourites</a></li>
                                                         <li class="left"><a class="filter" data-filter=".bksalads" style="background-color: white;color: black;font-weight: 800;">🥗 Salads & Veggie</a></li>
                                                         <li class="right"><a class="filter" data-filter=".bkbeverages" style="background-color: white;color: black;font-weight: 800;">🍹 Beverages</a></li>
                                                          <li class="left"><a class="filter" data-filter=".bksides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
                                                          <li class="right"><a class="filter" data-filter=".bkdesserts" style="background-color: white;color: black;font-weight: 800;">🥧 Desserts</a></li>
                                                          <li class="left"><a class="filter" data-filter=".kingdeal" style="background-color: white;color: black;font-weight: 800;">🍔 King Deals Value Menu</a></li>
                                                          <li class="right"><a class="filter" data-filter=".bkkingjr" style="background-color: white;color: black;font-weight: 800;">🍔 King Jr™ Meals</a></li>
  </ul>
</div>                                                   
        ';
                                    }

                                    else if ($row['name'] == "Gizmos Chillspot") {
                                        echo '<div class="fixed-action-btn" style="width: 320px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".gizmosalads" style="background-color: white;color: black;font-weight: 800;">🥗 Salads</a></li>
                                                         <li class="right"><a class="filter " data-filter=".gizmoplatters" style="background-color: white;color: black;font-weight: 800;">🥘 Platters</a></li>
                                                         <li class="left"><a class="filter" data-filter=".gizmoburgers" style="background-color: white;color: black;font-weight: 800;">🍔 Burgers</a></li>
                                                         <li class="right"><a class="filter" data-filter=".gizmowrapsquesadilla" style="background-color: white;color: black;font-weight: 800;">🌯 Wraps & Quesadillas</a></li>
                                                          <li class="left"><a class="filter" data-filter=".gizmopasta" style="background-color: white;color: black;font-weight: 800;">🍝 Pastas</a></li>
                                                          <li class="right"><a class="filter" data-filter=".gizmovegetarian" style="background-color: white;color: black;font-weight: 800;">🥦 Vegetarian</a></li>
                                                          <li class="left"><a class="filter" data-filter=".gizmoluncspecial" style="background-color: white;color: black;font-weight: 800;">🍣 Lunch Special</a></li>
                                                            <li class="right"><a class="filter" data-filter=".gizmodesert" style="background-color: white;color: black;font-weight: 800;">🥧 Deserts</a></li>
                                                            <li class="left"><a class="filter" data-filter=".gizmomain" style="background-color: white;color: black;font-weight: 800;">🍗 Main Courses</a></li>
                                                            <li class="right"><a class="filter" data-filter=".gizmomixdrink" style="background-color: white;color: black;font-weight: 800;">🍹 Mix Drink</a></li>
                                                            <li class="left"><a class="filter" data-filter=".gizmosideorder" style="background-color: white;color: black;font-weight: 800;">🍟 Side Order</a></li>
                                                            <li class="right"><a class="filter" data-filter=".gizmostarter" style="background-color: white;color: black;font-weight: 800;">🍗 Starters</a></li>
                                                            <li class="left"><a class="filter" data-filter=".gizmospecial" style="background-color: white;color: black;font-weight: 800;">🎊 Specials</a></li>
  </ul>
</div>                                                   
        ';
                                    }
                                    else if ($row['name'] == "Pizza Hut") {
                                        echo '<div class="fixed-action-btn" style="width: 220px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".pizzahutamazin" style="background-color: white;color: black;font-weight: 800;">🍕 Amazin 4</a></li>
                                                         <li class="right"><a class="filter " data-filter=".pizzahutwings" style="background-color: white;color: black;font-weight: 800;">🍗 Wings</a></li>
                                                         <li class="left"><a class="filter" data-filter=".pizzahutsides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
                                                         <li class="right"><a class="filter" data-filter=".pizzahutbeverages" style="background-color: white;color: black;font-weight: 800;">🍹 Beverages</a></li>
                                                          <li class="left"><a class="filter" data-filter=".pizzahutdeserts" style="background-color: white;color: black;font-weight: 800;">🥧 Deserts</a></li>
                                                          <li class="right"><a class="filter" data-filter=".pizzahutpasta" style="background-color: white;color: black;font-weight: 800;">🍝 Pasta</a></li>
                                                          <li class="left"><a class="filter" data-filter=".pizzahutcombos" style="background-color: white;color: black;font-weight: 800;">🎊 Hut Combos</a></li>
  </ul>
</div>
        ';
                                    }
                                    else if ($row['name'] == "Mothers") {
                                        echo '<div class="fixed-action-btn" style="width: 320px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".motherspatties" style="background-color: white;color: black;font-weight: 800;">🥖 Patties</a></li>
                                                         <li class="right"><a class="filter " data-filter=".motherschicken" style="background-color: white;color: black;font-weight: 800;">🍗 Chicken</a></li>
                                                         <li class="left"><a class="filter" data-filter=".mothersburgers" style="background-color: white;color: black;font-weight: 800;">🍔 Burgers</a></li>
                                                         <li class="right"><a class="filter" data-filter=".mothersbreakfastsandwiches" style="background-color: white;color: black;font-weight: 800;">🥪 Breakfast Sandwiches</a></li>
                                                          <li class="left"><a class="filter" data-filter=".motherbreakfastsmeals" style="background-color: white;color: black;font-weight: 800;">🥪 Breakfast Meals</a></li>
                                                          <li class="right"><a class="filter" data-filter=".motherssandwiches" style="background-color: white;color: black;font-weight: 800;">🥪 Sandwiches</a></li>
                                                          <li class="left"><a class="filter" data-filter=".mothersbeverages" style="background-color: white;color: black;font-weight: 800;">🍹 Beverages</a></li>
                                                          <li class="right"><a class="filter" data-filter=".motherssoups" style="background-color: white;color: black;font-weight: 800;">🍲 Soups</a></li>
                                                          <li class="left"><a class="filter" data-filter=".mothersicecream" style="background-color: white;color: black;font-weight: 800;">🍦 Ice Cream</a></li>
                                                          <li class="right"><a class="filter" data-filter=".motherspastry" style="background-color: white;color: black;font-weight: 800;">🥧 Pastry</a></li>
  </ul>
</div>                                                
        ';
                                    }
                                    else if ($row['name'] == "Dominos") {
                                        echo '<div class="fixed-action-btn" style="width: 300px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".dominosspecialtypizza" style="background-color: white;color: black;font-weight: 800;">🍕 Specialty Pizza</a></li>
                                                         <li class="right"><a class="filter " data-filter=".dominoschicken" style="background-color: white;color: black;font-weight: 800;">🍗 Chicken</a></li>
                                                         <li class="left"><a class="filter" data-filter=".dominosides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
                                                         <li class="right"><a class="filter" data-filter=".dominosdrinks" style="background-color: white;color: black;font-weight: 800;">🍹 Drinks</a></li>
                                                          <li class="left"><a class="filter" data-filter=".dominosdesserts" style="background-color: white;color: black;font-weight: 800;">🥧 Desserts</a></li>
  </ul>
</div>                                                   
        ';
                                    }
                                    else if ($row['name'] == "Tha Ville") {
                                        echo '<div class="fixed-action-btn" style="width: 300px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".thavillechicken" style="background-color: white;color: black;font-weight: 800;">🍗 Chicken</a></li>
                                                         <li class="right"><a class="filter " data-filter=".thavillefish" style="background-color: white;color: black;font-weight: 800;">🍣 Fish</a></li>
                                                         <li class="left"><a class="filter" data-filter=".thavillesides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
                                                         <li class="right"><a class="filter" data-filter=".thavilleservedwith" style="background-color: white;color: black;font-weight: 800;">🍛 Served With</a></li>
                                                          <li class="left"><a class="filter" data-filter=".thavillemeat" style="background-color: white;color: black;font-weight: 800;">🍖 Meat</a></li>
                                                          <li class="right"><a class="filter" data-filter=".thavillebeverages" style="background-color: white;color: black;font-weight: 800;">🍹 Beverages</a></li>
                                                          <li class="left"><a class="filter" data-filter=".thavilledonetoorder" style="background-color: white;color: black;font-weight: 800;">⌛ Done to Order</a></li>
                                                          <li class="right"><a class="filter" data-filter=".thavillepastries" style="background-color: white;color: black;font-weight: 800;">🥧 Pastries</a></li>
  </ul>
</div>
        ';
                                    }
                                    else if ($row['name'] == "Pablos 2020") {
                                        echo '<div class="fixed-action-btn" style="width: 300px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".pablos2020breakfast" style="background-color: white;color: black;font-weight: 800;">🥓 Breakfast</a></li>
                                                         <li class="right"><a class="filter " data-filter=".pablos2020lunch" style="background-color: white;color: black;font-weight: 800;">🥪 Lunch</a></li>
                                                         <li class="left"><a class="filter" data-filter=".pablos2020dinner" style="background-color: white;color: black;font-weight: 800;">🍛 Dinner</a></li>
                                                         <li class="right"><a class="filter" data-filter=".pablos2020dessert" style="background-color: white;color: black;font-weight: 800;">🥧 Dessert</a></li>
                                                          <li class="left"><a class="filter" data-filter=".pablos2020sides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>
                                                          <li class="right"><a class="filter" data-filter=".pablos2020soupoftheday" style="background-color: white;color: black;font-weight: 800;">🍲 Soup of the day</a></li>
  </ul>
</div>
        ';
                                    }
                                    else if ($row['name'] == "GL Steakhouse") {
                                        echo '<div class="fixed-action-btn" style="width: 300px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".glsteakhouseappetizers" style="background-color: white;color: black;font-weight: 800;">🥩 Appetizers</a></li>
                                                         <li class="right"><a class="filter " data-filter=".glsteakhousesoupofday" style="background-color: white;color: black;font-weight: 800;">🍲 Soup of day</a></li>
                                                         <li class="left"><a class="filter" data-filter=".glsteakhouseentrees" style="background-color: white;color: black;font-weight: 800;">🍖 Entrees</a></li>
                                                         <li class="right"><a class="filter" data-filter=".glsteakhousesteak" style="background-color: white;color: black;font-weight: 800;">🥓 Steak</a></li>
                                                          <li class="left"><a class="filter" data-filter=".glsteakhouseseafood" style="background-color: white;color: black;font-weight: 800;">🍣 Seafood</a></li>
                                                          <li class="right"><a class="filter" data-filter=".glsteakhousechicken" style="background-color: white;color: black;font-weight: 800;">🍗 Chicken</a></li>
                                                          <li class="left"><a class="filter" data-filter=".glsteakhousesideorder" style="background-color: white;color: black;font-weight: 800;">🍟 Side Order</a></li>
                                                          <li class="right"><a class="filter" data-filter=".glsteakhousesauces" style="background-color: white;color: black;font-weight: 800;">🍛 Sauces</a></li>
                                                          <li class="left"><a class="filter" data-filter=".glsteakhousedessert" style="background-color: white;color: black;font-weight: 800;">🥧 Desserts</a></li>
                                                          <li class="right"><a class="filter" data-filter=".glsteakhousebeverages" style="background-color: white;color: black;font-weight: 800;">🍹 Beverages</a></li>
  </ul>
</div>
        ';
                                    }
                                    else if ($row['name'] == "Flamin Wok") {
                                        echo '<div class="fixed-action-btn" style="width: 320px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul class="" style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".flaminlunchboxmeals" style="background-color: white;color: black;font-weight: 800;">🥓 Lunch Box Meals</a></li>
                                                         <li class="left"><a class="filter " data-filter=".flaminfat2fitsalads" style="background-color: white;color: black;font-weight: 800;">🥗 Fat 2 Fit Salads</a></li>
                                                         <li class="left"><a class="filter" data-filter=".flaminlunchboxspecials" style="background-color: white;color: black;font-weight: 800;">🍖 Lunch Box Specials</a></li>
                                                         <li class="left"><a class="filter" data-filter=".flaminsoups&appetizers" style="background-color: white;color: black;font-weight: 800;">🍲  Soups & Appetizers</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flaminchickendishes" style="background-color: white;color: black;font-weight: 800;">🍗 Chicken Dishes</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flaminchopsuey" style="background-color: white;color: black;font-weight: 800;">🥦 Chop Suey (Veg.)</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flamintofudishes" style="background-color: white;color: black;font-weight: 800;">🍱 Tofu Dishes</a></li>
                                                          <li class="right"><a class="filter" data-filter=".flaminporkdishes" style="background-color: white;color: black;font-weight: 800;">🥩 Pork Dishes</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flaminnoodledishes" style="background-color: white;color: black;font-weight: 800;">🍲 Noodle Dishes</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flaminseafooddishes" style="background-color: white;color: black;font-weight: 800;">🍣 Seafood Dishes</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flaminfriedrice" style="background-color: white;color: black;font-weight: 800;">🍚 Fried Rice</a></li>
                                                          <li class="left"><a class="filter" data-filter=".flamindrinks" style="background-color: white;color: black;font-weight: 800;">🥤 Beverages</a></li>
  </ul>
</div>                                                  
        ';
                                    }
                                    else if ($row['name'] == "Naufragada") {
                                        echo '
<div class="fixed-action-btn" style="width: 300px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul style="width: inherit;height: inherit;">
    <li class="left"><a class="filter active" data-filter=".naufragadaomlets" style="background-color: white;color: black;font-weight: 800;">🥟 Omelets</a></li>
                                                         <li class="left"><a class="filter " data-filter=".naufragadasalads" style="background-color: white;color: black;font-weight: 800;">🥗 Salads</a></li>
                                                         <li class="left"><a class="filter" data-filter=".naufragadaspecialtyburger" style="background-color: white;color: black;font-weight: 800;">🍔 Specialty Burgers</a></li><br>
                                                         <li class="left"><a class="filter" data-filter=".naufragadapancakeswaffles" style="background-color: white;color: black;font-weight: 800;">🥞 Pancakes & Waffles</a></li>
                                                          <li CLASS="left"><a class="filter" data-filter=".naufragadaparfaits" style="background-color: white;color: black;font-weight: 800;">🥛 Parfaits / Muesli</a></li>
                                                          <li class="left"><a class="filter" data-filter=".naufragadawraps" style="background-color: white;color: black;font-weight: 800;">🌯 Wraps</a></li><br>
                                                          <li class="left"><a class="filter" data-filter=".naufragadataconacho" style="background-color: white;color: black;font-weight: 800;">🌮 Tacos / Nachos</a></li>
                                                          <li class="left"><a class="filter" data-filter=".naufragadagyros" style="background-color: white;color: black;font-weight: 800;">🍣 Gyros</a></li>
  </ul>
</div>                                                   
        ';
                                    }
                                    else {
                                        echo '

                                          <div class="fixed-action-btn" style="width: 300px;">
  <a class="btn-floating waves-effect waves-light btn-large red right z-depth-4">
    <i class="mdi-maps-restaurant-menu teal"></i>
  </a>
  <ul style="width: inherit;">
    <li class="left"><a class="filter active" data-filter=".menu-restaurant" style="background-color: white;color: black;font-weight: 800;">🍛 All</a></li>
     <li class="right"><a class="filter " data-filter=".casuals" style="background-color: white;color: black;font-weight: 800;">🍛 Main</a></li>
     <li class="left"><a class="filter" data-filter=".entrees" style="background-color: white;color: black;font-weight: 800;">🍛 Entrees</a></li>
     <li class="right"><a class="filter" data-filter=".sides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li><br>
     <li class="left"><a class="filter" data-filter=".beverages" style="background-color: white;color: black;font-weight: 800;">🍹 Beverages</a></li>
  </ul>
</div>
';
                                    }
                                }


                                ?>

                            </ul>
                        </div>
                    </blockquote>

                     </p>
                </div>
                <!--                End of notice board-->
            </section>

            <div id="modal1" class="modal bottom-sheet">
                <div class="modal-content">
                    <h6>My Cart</h6>
                    <ul id="issues-collection" class="collection center-align" style="border-radius:16px;width: auto;">
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM users where id= $user_id AND not deleted;");
                        while($row = mysqli_fetch_array($result))
                        {
                            $res_name = $row['name'];
                            $phone = $row["contact"];

                            echo '<li class="collection-item avatar" style="width: 100%;">
                        <i class="mdi-content-content-paste red circle"></i>
                        <p><strong>Name:</strong> '.$name.'</p>
                        <p><strong>Contact:</strong> '.$phone.'</p>
                        </li>';
                        }
                        ?>
                        <?php
                        if(!empty($_SESSION["shopping_cart"]))
                        {
                            $total = 0;
                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                            {
                                ?>
                                <li class="collection-item" style="width: 100%;">
                                    <div class="row">
                                        <div class="col s8">
                                            <p class="collections-title"><strong><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;width: 20px;">(<?php echo $values["item_quantity"];?>)</span></strong> <?php echo $values["item_name"]; ?></p>
                                            <span style="font-size: 12px;"><?php echo $values["item_variation"]; ?></span>
                                        </div>

                                        <div class="col s4"><br>
                                            <span>$<?php echo $values["item_price"]; ?> JMD</span>
                                        </div>
                                        <div class="col s4">
                                            <a href="category.php?action=delete&id=<?php echo $values["item_id"]; ?>&pgid=<?php echo $restid; ?>"><span class="text-danger" style="color: darkred;">Remove</span></a>
                                        </div>
                                    </div>
                                </li>

                                <?php
                                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                            ?>


                            <li class="collection-item" style="width: 100%;">
                                <div class="row">
                                    <div class="col s8">
                                        <p class="collections-title"> Sub-total</p>
                                    </div>
                                    <div class="col s4"><br>
                                        <span><strong>$<?php echo number_format($total); ?> JMD</strong></span>
                                    </div>
                                </div>
                            </li>

                            <li class="collection-item" style="width: 100%;">
                                <div class="row">
                                    <div class="col s7">
                                    </div>
                                    <div class="col s3 left">
                                        <div class="card-action">
                                            <form action="place-order.php?pgid=<?php echo $restid ?>" method="post">
                                                <button value="<?php echo number_format($total); ?>" class="btn cyan waves-effect waves-light center" type="submit" name="action" style="border-radius:8px;">Order
                                                    <i class="mdi-content-send right"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="divider"></div>

            <section id="menu-list" class="responsive">
                <div class="container">
                    <div class="row">

                        <?php
                        $result4 = mysqli_query($con, "SELECT * FROM users where id= $restid AND not deleted;");
                        while($row = mysqli_fetch_array($result4))
                        {
                            ?>
                            <div id="menu-wrapper">
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='0' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="casuals Starttheday bigdeal bkburgers gizmosalads pizzahutamazin motherspatties dominosspecialtypizza thavillechicken pablos2020breakfast glsteakhouseappetizers flaminlunchboxmeals naufragadaomlets menu-restaurant" style="border: .5px solid #ddd;border-radius: 2px;width: 100%;">
        <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>
           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='1' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }
                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="entrees LunchBeyond mealdeal otherfavourites gizmoplatters pizzahutwings motherschicken dominoschicken thavillefish pablos2020lunch glsteakhousesoupofday flaminfat2fitsalads naufragadasalads menu-restaurant" style="border: .5px solid #ddd;border-radius: 2px; width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='2' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }
                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="sides Subs zingers bksalads gizmoburgers pizzahutsides mothersburgers dominosides thavillesides pablos2020dinner glsteakhouseentrees flaminlunchboxspecials naufragadaspecialtyburger menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='3' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="beverages Wraps bigsix bkbeverages gizmowrapsquesadilla pizzahutbeverages mothersbreakfastsandwiches dominosdrinks thavilleservedwith pablos2020dessert glsteakhousesteak flaminsoups&appetizers naufragadapancakeswaffles menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='4' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }

                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="ChineseFare buckets bksides gizmopasta pizzahutdesserts motherbreakfastsmeals dominosdesserts thavillemeat pablos2020sides glsteakhouseseafood flaminchickendishes naufragadaparfaits menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='5' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="JamaicanFare bigboxes bkdesserts gizmovegetarian pizzahutpasta motherssandwiches thavillebeverages pablos2020soupoftheday glsteakhousechicken flaminchopsuey naufragadawraps menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='6' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }

                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Roti wings kingdeal menu-restaurant pizzahutcombos mothersbeverages thavilledonetoorder gizmoluncspecial glsteakhousesideorder flamintofudishes naufragadataconacho" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='7' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }

                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Soups krispers bkkingjr menu-restaurant motherssoups gizmodesert thavillepastries glsteakhousesauces flaminporkdishes naufragadagyros" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='8' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }

                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Appetizers value menu-restaurant mothersicecream gizmomain glsteakhousedessert flaminnoodledishes" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='9' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }

                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Salads kfsides menu-restaurant motherspastry gizmomixdrink glsteakhousebeverages flaminseafooddishes" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='10' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Seafood popcornchicken menu-restaurant gizmosideorder flaminfriedrice" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>
           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='11' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }

                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Poultry kfsalads menu-restaurant gizmostarter flamindrinks" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='12' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="FromtheGrill desserts menu-restaurant gizmospecial" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='13' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Vegetarian drinks menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>


                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='14' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="PastaFusion catering menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='15' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="EatMeetSipTalk menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='16' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Sides menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='17' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Mothersdayspecial menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND category='18' AND not deleted ORDER BY id ASC;");
                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $detail = "";
                                        $size = "";
                                        if ($row['size'] == 0){
                                            $size = "Mini";
                                        }
                                        else if ($row['size'] == 1){
                                            $size = "Small";
                                        }
                                        else if ($row['size'] == 2){
                                            $size = "Medium";
                                        }
                                        else if ($row['size'] == 3){
                                            $size = "Large";
                                        }


                                        if ($row['description'] == ""){
                                            $detail = "No detail available";
                                        }

                                        else {
                                            $detail = $row['description'];
                                        }
                                        ?>
                                        <div class="Fathersdayspecial menu-restaurant" style="border: .5px solid #ddd;border-radius: 4px;width: 100%;">
            <span class="clearfix">
          <form method="post" action="category.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>">

               <table border="1" style="border-radius: 16px;background-color: white;">
                <tr>

                    <img class="mySlides product_drag" src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "")
                    {
                        echo $row['img_addr'];
                    }
                    else
                        echo "images/itemdefault.png"; ?>"

                         style="<?php if ($row['img_addr'] != "0"){
                             echo "border: 1px solid #ddd;border-radius: 32px;padding: 5px;width: 100%;object-fit: fit;";
                         }
                         else
                             echo "border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 100%;height: 250px;";?>"
                         data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>">
                </tr>

                <tr class="left">
                    <td style="width: 200px;text-align:center;background-color: white;color: teal;font-size:20px;font-weight: 400;">
                        <span class="left" style="background-color: white;border-radius: 4px;color: black;width: inherit;font-size: 12px;"> $<?php echo $row["price"]; ?> </span><br>
                        <span style="color: black;font-size: 26px;"><?php echo $row["name"]; ?></span><br>
                        <select name="variation">
                        <option value="<?php echo $row["type1"]; ?>"><?php echo $row["type1"]; ?></option>
                            <option value="<?php echo $row["type2"]; ?>"><?php echo $row["type2"]; ?></option>
                            <option value="<?php echo $row["type3"]; ?>"><?php echo $row["type3"]; ?></option>
                            <option value="<?php echo $row["type4"]; ?>"><?php echo $row["type4"]; ?></option>
                            </select>
                         <span style="font-size: 12px;color: black;"><?php echo $detail; ?></span>
                    </td>
                </tr>

                <tr class="right">

                    <td style="text-align:center;font-size:15px;background-color: antiquewhite;border-top-left-radius: 20px;">
                        <h6>Meal Rating</h6>
                        <span style="width: 100%;">
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        <span class="mdi-toggle-star-outline" style="width: 15%;"></span>
                        </span>
                    <br>
                        <span><input style="color: darkred;width: 100%;" type="number" max="10" min="1" name="quantity" value="1"/></span>
                        <span><button type="submit" name="add_to_cart" style="margin-top:5px;border-radius: 8px;font-family: Open Sans, ;font-family: Akronim;font-size:16px;width: 100px;" class="btn-floating" value="" style="border-radius:6px;"><i class="mdi-action-shopping-basket"></i></button></span><br>
                    </td>
                 </tr>

                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

             </table>

           </form>
        </span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>

                            <?php
                        }
                        ?>

                    </div>
                </div>
            </section>


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

        $('.fixed-action-btn').floatingActionButton({
            toolbarEnabled: true
        });
    </script>

    <script type="text/javascript">
        (function($) {
            $("#menu-filters li a").click(function() {
                $("#menu-filters li a").removeClass('active');
                $(this).addClass('active');
                var selectedFilter = $(this).data("filter");
                $(".menu-restaurant").fadeOut();
                setTimeout(function() {
                    $(selectedFilter).slideDown();
                }, 100);
            });

        })(jQuery);</script>

    <script type="text/javascript">
        (function($) {
            $("#viewcart").click(function() {
                $("#cartview").toggle();
            });

        })(jQuery);</script>

    </body>
    </html>


    <?php

}


else
{
    if($_SESSION['restaurant_sid']==session_id())
    {
        header("location:admin.php");
    }
    else{
        header("location:login.php");
    }
}
?>