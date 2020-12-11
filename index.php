<?php
include 'includes/connect.php';
include 'includes/wallet.php';
if($_SESSION['customer_sid']==session_id())
{
    $usr_address = "";
    $useraddress = mysqli_query($con, "SELECT * FROM users WHERE name= '$name'");
    while($row = mysqli_fetch_array($useraddress))
    {
       $usr_address = $row['address'];
    }
    $counter = 0;
    if(!empty($_SESSION["shopping_cart"]))
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
            $counter += 1;
        }

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
                    'item_quantity'          =>     $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
            }
        }
        else
        {
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"]
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
                    echo '<script>window.location="index.php?action=delete&id='.$values["item_id"].'</script>';
                }
            }
        }
    }


    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Order Food Online | Have it delivered</title>
        <!--         TODO: Add meta description for this page -->
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/styleindex.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
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
            .side-nav.fixed.leftnavset .collapsible-body li.active>a{color:#A82128}ul.side-nav.leftnavset li.active>a{color: #a82128;}
            @media screen and (max-width: 600px) {
                .column {
                    width: 100%;
                    display: block;
                    margin-bottom: 20px;
                }
            }
            label{
                color: black;
            }

            .tabs .indicator {
                background-color: #a21318;
            }
            .scrolling-wrapper {
                overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap;
            }
            .scrolling-wrapper .smallcard {
                display: inline-block;
            }

            .scrolling-wrapper-flexbox {
                display: -webkit-box;
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
            }
            .scrolling-wrapper-flexbox .smallcard {
                -webkit-box-flex: 0;
                flex: 0 0 auto;
                margin-right: 3px;
            }

            .smallcard {
                width: 110px;
                height: 60px;
            }

            .scrolling-wrapper,  {
                height: 70px;
                margin-bottom: 20px;
                width: 100%;
                -webkit-overflow-scrolling: touch;
            }
            .scrolling-wrapper::-webkit-scrollbar, :-webkit-scrollbar {
                display: none;
            }

            .chip{
                background-color: white;
                width: 120px;
                height: inherit;
            }
            .chip img{
                width: 48px;
                height: 48px;
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
                    <ul style="background-color: white;">
                        <label class="center" style="font-size: 10px;color: #a21318;font-weight: 600;"><b>DELIVERING TO <span id="nearby"></span></b></label>
                        <li class="center"><a href="deliverto.php" class="brand-logo darken-1" style="font-size: 12px;color: black;"><?php echo $usr_address; ?></a></li>
                        <li class="right"><a id="viewcart" class="waves-effect waves-light modal-trigger" href="#modal1"><i class="mdi-action-shopping-basket" style="color: #a21318;"></i></a></li>
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
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan z-depth-0"><i class="mdi-navigation-menu" style="color: white;"></i></a>
            </aside>
            <div id="modal1" class="modal bottom-sheet" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                <div class="progress"><div class="indeterminate"></div></div>
            </div>
        </div>

        <section class="content"><br>
            <div class="scrolling-wrapper">
                        <div class="smallcard">
                                <div class="column">
                                    <div>
                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                                    <img src="images/fast-food.png">
                                                <input type="hidden" name="category" value="0">
                                                <input type="hidden" name="category_name" value="Fast Food">
                                                Fast Food</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/burger.png">
                                                    <input type="hidden" name="category" value="1">
                                                    <input type="hidden" name="category_name" value="Burgers">
                                            Burgers</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/pizza.png">
                                                    <input type="hidden" name="category" value="2">
                                                    <input type="hidden" name="category_name" value="Pizza">
                                            Pizza</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/meat.png">
                                                    <input type="hidden" name="category" value="3">
                                                    <input type="hidden" name="category_name" value="Meat">
                                            Lunch</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/dessert.png">
                                                    <input type="hidden" name="category" value="4">
                                                    <input type="hidden" name="category_name" value="Dessert">
                                            Dessert</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/seafood.png">
                                                    <input type="hidden" name="category" value="5">
                                                    <input type="hidden" name="category_name" value="Seafood">
                                            Seafood</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/breakfast.png">
                                                    <input type="hidden" name="category" value="6">
                                                    <input type="hidden" name="category_name" value="Breakfast">
                                            Breakfast</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/chicken.png">
                                                    <input type="hidden" name="category" value="7">
                                                    <input type="hidden" name="category_name" value="Chicken">
                                            Chicken</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/healthy.png">
                                                    <input type="hidden" name="category" value="8">
                                                    <input type="hidden" name="category_name" value="Healthy">
                                            Healthy</button>
                                            </form>
                                        </div>

                                        <div class="chip" style="color: black;width: 140px;background-color: ghostwhite;">
                                            <form class="validate" action="options.php" method="post">
                                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;">
                                            <img src="images/chinese.png">
                                                    <input type="hidden" name="category" value="9">
                                                    <input type="hidden" name="category_name" value="Chinese">
                                            Chinese</button>
                                            </form>
                                        </div>

                                    </div></div>
                        </div>
            </div>


            <div class="row">
                <div class="scrolling-wrapper" style="border-bottom: 4px solid ghostwhite;border-top: 4px solid ghostwhite;height: 250px;">
                    <img src="images/adban.jpg" width="100%" height="100%" style="object-fit: cover">
                    <img src="images/topban.jpg" width="100%" height="100%" style="object-fit: cover">
                    <img src="images/footerban.jpg" width="100%" height="100%" style="object-fit: cover">
                </div>
                <h6 class="center">
                    <span class="center"><i class="mdi-image-looks-one"></i></span>
                    <span class="center"><i class="mdi-image-looks-two"></i></span>
                    <span class="center"><i class="mdi-image-looks-3"></i></span>
                </h6>
            </div>


<div class="col s12">
    <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Favorites</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
    <div class="scrolling-wrapper" style="height: 250px;">
        <?php
                    $result = mysqli_query($con, "SELECT * FROM users where (role='Restaurant') AND not deleted AND ocassion='Fast Food' OR (id='331' OR id='430' OR id='80' OR id='294' OR id='8')  ORDER BY id='53' DESC, id='331' DESC, id='430' DESC, id='540' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $dis_fee = 0;
                            $address = $row['address'];
                            $image = $row['image_dir2'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
        <div class="smallcard" style="width: 260px;">
            <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                <div class="column">
                    <div class="row">
                        <div class="col s12 m6">
                            <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                            <input type="hidden" id="rest_address" value="<?php echo $address; ?>">
                            <input type="hidden" id="cust_address" value="<?php echo $usr_address; ?>">
                            <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                    <div class="card-image">
                                        <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                    </div></button>
                                <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                    <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                    <label style="font-size: 10px;">⏱️ <b>45 - 60 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
                            <?php
                        }
                    }
        ?>
    </div>

    </div>

            <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>

            <div class="col s12" id="breakfast" hidden>
                <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Breakfast</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
                <div class="scrolling-wrapper" style="height: 250px;">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE (role='Restaurant') AND id='331' OR ocassion='Dessert' AND not deleted");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $address = $row['address'];
                            $image = $row['image_dir3'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard" style="width: 300px;">
                                <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                                    <div class="column">
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                                <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                                    <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                                        <div class="card-image">
                                                            <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                                        </div></button>
                                                    <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                                        <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                                        <label style="font-size: 10px;">⏱️ <b>30 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>
            </div>

            <div class="col s12" id="steakseafoodwednesday" hidden>
                <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Steak & Seafood</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
                <div class="scrolling-wrapper" style="height: 250px;">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND (ocassion='Seafood' OR ocassion='Steak') AND not deleted ORDER BY id DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $address = $row['address'];
                            $image = $row['image_dir3'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard" style="width: 300px;">
                                <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                                    <div class="column">
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                                <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                                    <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                                        <div class="card-image">
                                                            <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                                        </div></button>
                                                    <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                                        <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                                        <label style="font-size: 10px;">⏱️ <b>40 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>
            </div>

            <div class="col s12" id="pizzatuesday" hidden>
                <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Pizza Tuesday</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
                <div class="scrolling-wrapper" style="height: 250px;">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND ocassion='Pizza' AND not deleted ORDER BY id DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $address = $row['address'];
                            $image = $row['image_dir3'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard" style="width: 300px;">
                                <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                                    <div class="column">
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                                <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                                    <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                                        <div class="card-image">
                                                            <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                                        </div></button>
                                                    <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                                        <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                                        <label style="font-size: 10px;">⏱️ <b>30 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>
            </div>

            <div class="col s12" id="latenightcravings" hidden>
    <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Late Night Cravings</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
    <div class="scrolling-wrapper" style="height: 250px;">
        <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND ocassion='Restaurant & Bar' AND not deleted ORDER BY id DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $address = $row['address'];
                            $image = $row['image_dir3'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
        <div class="smallcard" style="width: 300px;">
            <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                <div class="column">
                    <div class="row">
                        <div class="col s12 m6">
                            <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                            <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                    <div class="card-image">
                                        <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                    </div></button>
                                <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                    <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                    <label style="font-size: 10px;">⏱️ <b>40 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
                            <?php
                        }
                    }
        ?>
    </div>
                <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>
    </div>

 <div class="col s12">
     <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Special Offers</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>

     <div class="scrolling-wrapper" style="height: 250px;">
         <?php
         $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND (ocassion='Restaurant' OR ocassion='Dessert') AND not deleted ORDER BY id DESC;");
         while($row = mysqli_fetch_array($result))
         {
             if ($row['id'] != "297"){
                 $address = $row['address'];
                 $image = $row['image_dir3'];
                 $image_dir = '';
                 $restaurant_id = $row['id'];
                 $restaurant_name = $row['name'];
                 $mon = $row['mon'];
                 $monc = $row['monc'];

                 if ($image != ''){
                     $image_dir = $image;
                 }
                 else if ($image == ''){
                     $image_dir = 'images/yaadi-food.jpg';
                 }

                 ?>
                 <div class="smallcard" style="width: 260px;">
                     <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                         <div class="column">
                             <div class="row">
                                 <div class="col s12 m6">
                                     <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                     <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                         <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                             <div class="card-image">
                                                 <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                             </div></button>
                                         <div class="card-content" style="height: 65px;background-color: ghostwhite;border-radius: 8px;">
                                             <span style="font-size: 18px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-radio-button-on right"></i></span><br>
                                             <label style="font-size: 10px;">⏱️ <b>30 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </form>

                 </div>
                 <?php
             }
         }
         ?>
     </div>

</div>
            <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>

            <div class="col s12" id="lunch" hidden>
                <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Best of Lunch</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
                <div class="scrolling-wrapper" style="height: 250px;">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND ocassion='Fast Food' OR ocassion='Restaurant' AND not deleted ORDER BY id DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $address = $row['address'];
                            $image = $row['image_dir3'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard" style="width: 300px;">
                                <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                                    <div class="column">
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                                <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                                    <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                                        <div class="card-image">
                                                            <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                                        </div></button>
                                                    <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                                        <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                                        <label style="font-size: 10px;">⏱️ <b>40 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>
            </div>

 <div class="col s12">
     <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Fastest Near You</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>

     <div class="scrolling-wrapper" style="height: 250px;">
         <?php
         $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND ocassion='Pizza' AND not deleted ORDER BY id DESC;");
         while($row = mysqli_fetch_array($result))
         {
             if ($row['id'] != "297"){
                 $address = $row['address'];
                 $image = $row['image_dir2'];
                 $image_dir = '';
                 $restaurant_id = $row['id'];
                 $restaurant_name = $row['name'];
                 $mon = $row['mon'];
                 $monc = $row['monc'];

                 if ($image != ''){
                     $image_dir = $image;
                 }
                 else if ($image == ''){
                     $image_dir = 'images/yaadi-food.jpg';
                 }

                 ?>
                 <div class="smallcard" style="width: 300px;">
                     <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                         <div class="column">
                             <div class="row">
                                 <div class="col s12 m6">
                                         <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                     <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                         <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                         <div class="card-image">
                                             <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                         </div></button>
                                         <div class="card-content" style="height: 65px;background-color: ghostwhite;border-radius: 8px;">
                                             <span style="font-size: 18px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-check-box right"></i></span><br>
                                             <label style="font-size: 10px;">⏱️ <b>30 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </form>

                 </div>
                 <?php
             }
         }
         ?>
     </div>

</div>
            <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>

            <div class="col s12" id="dinner" hidden>
                <h5 style="padding-left: 20px;font-weight: 600;background-color: ghostwhite;"><b>Dinner</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><a href="#."><i class="mdi-navigation-arrow-forward black-text"></i></a></b></span></h5>
                <div class="scrolling-wrapper" style="height: 250px;">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND (ocassion='Restaurant' OR ocassion='Seafood' OR ocassion='Jamaican Chinese' OR ocassion='Chinese') AND not deleted ORDER BY id DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $address = $row['address'];
                            $image = $row['image_dir3'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];

                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard" style="width: 300px;">
                                <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                                    <div class="column">
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>
                                                <div class="card z-depth-0" style="border-radius: 8px;background-color: transparent;">
                                                    <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                                        <div class="card-image">
                                                            <img src="<?php echo $image_dir; ?>" height="140px" width="100%" style="object-fit: cover;border-radius: 8px">
                                                        </div></button>
                                                    <div class="card-content" style="height: 70px;background-color: ghostwhite;border-radius: 8px;">
                                                        <span style="font-size: 20px;"><b><?php echo $restaurant_name; ?></b> <i class="mdi-toggle-star right"></i></span><br>
                                                        <label style="font-size: 10px;">⏱️ <b>40 Minutes</b> <i class="mdi-hardware-keyboard-arrow-right"></i> $<span id="delivery"></span> Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row" style="height: 8px;background-color: white;border: 1px solid darkgray;border-right: 0px solid transparent;border-left: 0px solid transparent;"></div>
            </div>

 <div class="col s12">
     <a href="restaurants.php"><h5 style="padding-left: 20px;font-weight: 600;"><b>View all restaurants</b> <span class="right" style="padding-right: 20px;font-weight: 600;background-color: lightgray;border-radius: 16px;"><b><i class="mdi-navigation-arrow-forward black-text"></i></b></span></h5></a>
 </div>
            <span id="message"></span>
 </div>
</div>
</section>

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
    <script type='text/javascript' data-cfasync='false'>
        window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript';
            script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '2c63b2b2-cf28-43d2-9604-89dd5cb4ac9d', f: true }); done = true; } }; })();
    </script>
<!--    <script>-->
<!--        $(document).ready(function(){-->
<!--            window.setInterval(function(){-->
<!--            var restaurant = $('#rest_address').val();-->
<!--            var customer = $('#cust_address').val();-->
<!--               $.ajax({-->
<!--                   url: '../includes/location.php',-->
<!--                   method: 'post',-->
<!--                   data:{restaurant:restaurant,customer:customer},-->
<!--                   success: function (data) {-->
<!--                       // $('#delivery').html(data);-->
<!--                   }-->
<!--               })-->
<!--            }, 2000);-->
<!--        });-->
<!--    </script>-->
    <script>
        $(document).ready(function(){
            openTime();
        window.setInterval(function(){
            $('#modal1').html(
                $.ajax({
                    url: '../routers/getcart.php',
                    method: 'post',
                    data:{},
                    success: function (data) {
                        $('#modal1').html(data);

                    }
                }))
        }, 4000);

        })

        function openTime() {
            var d = new Date();
            var dy = d.getDay();
            var moment = String(Date()).slice(16,21);
            var moment = moment.replace(":","");
            var open = String(document.getElementById('open')).slice(16,21);
            var close = String(document.getElementById('closes')).slice(16,21);

            if (dy == 3){
                if (moment > 800 && moment < 1800){
                    $('#steakseafoodwednesday').show();
                }
            }
            if (dy == 2){
                if (moment > 800 && moment < 1800){
                    $('#pizzatuesday').show();
                }
            }
            if (dy == 0){
                Materialize.toast('Hey there, we are closed today 😴', 8000);

                if (moment > 800 && moment < 1130){
                    $('#breakfast').show();
                }

                if (moment > 1130 && moment < 1500){
                    $('#lunch').show();
                }

                if (moment > 1500 && moment < 2000){
                    $('#dinner').show();
                }

                if (moment > 1900 && moment < 2400){
                    $('#latenightcravings').show();
                }
            }
            else{

                if (moment > 800 && moment < 1800){
                    <?php
                    $openclosertime = "";
                    $openclose = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND not deleted ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row2 = mysqli_fetch_array($openclose))
                    {
                        $openclosee = mysqli_query($con, "SELECT * FROM incumbency WHERE id= 2");
                        while ($row = mysqli_fetch_array($openclosee)) {
                            $openclosertime = $row['admission'];
                        }
                    }

                    if ($openclosertime == 0) {
                        echo "Materialize.toast('Ordering is currently active 😋', 8000);";
                    }
                    if ($openclosertime == 1) {
                        echo "Materialize.toast('Ordering is currently closed 🥺 <button>Schedule Order</button>', 8000);";
                    }
                    ?>

                }

                if (moment > 630 && moment < 1130){
                    $('#breakfast').show();
                }

                if (moment > 1130 && moment < 1500){
                    $('#lunch').show();
                }

                if (moment > 1500 && moment < 2000){
                    $('#dinner').show();
                }

                if (moment > 1900 && moment < 2400){
                    $('#latenightcravings').show();
                }

                else if (moment > 1800 && moment < 2400){
                    <?php
                    echo "Materialize.toast('Ordering is currently closed 🥺 <button>Schedule Order</button>', 8000);";
                    ?>
                }
            }
        }

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
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin.php");
    }
    if($_SESSION['restaurant_sid']==session_id())
    {
        header("location:restaurant.php");
    }
    if($_SESSION['delivery_sid']==session_id())
    {
        header("location:delivery-dashboard.php");
    }
    else{
        header("location:login.php");
    }
}
?>