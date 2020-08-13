<?php
include 'includes/connect.php';
include 'includes/wallet.php';

if($_SESSION['customer_sid']==session_id())
{
    $counter = 0;
    $image_di = "";
    $image_di2 = "";
    $image_di3 = "";

    $result = mysqli_query($con, "SELECT * FROM users where id= '540' AND not deleted;");
    while($row = mysqli_fetch_array($result))
    {
        $image = $row['image_dir'];

        if ($image != ''){
            $image_di = $image;
        }
        else if ($image == ''){
            $image_di = 'images/yaadi-food.jpg';
        }
    }
    $result2 = mysqli_query($con, "SELECT * FROM users where id= '486' AND not deleted;");
    while($row = mysqli_fetch_array($result2))
    {
        $image = $row['image_dir'];

        if ($image != ''){
            $image_di2 = $image;
        }
        else if ($image == ''){
            $image_di2 = 'images/yaadi-food.jpg';
        }
    }
    $result3 = mysqli_query($con, "SELECT * FROM users where id= '524' AND not deleted;");
    while($row = mysqli_fetch_array($result3))
    {
        $image = $row['image_dir'];

        if ($image != ''){
            $image_di3 = $image;
        }
        else if ($image == ''){
            $image_di3 = 'images/yaadi-food.jpg';
        }
    }

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
        <title>Order Food</title>
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
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.carousel');
                var instances = M.Carousel.init(elems, options);
            });

            // Or with jQuery

            $(document).ready(function(){
                $('.carousel').carousel();
            });

        </script>
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
                        <li class="bold active"><a href="index.php"><i class="mdi-editor-border-color"></i> Order Food</a>
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
                            <div class="col s12 m12 l12" style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;border-radius: 8px;border-top-left-radius: 0px;border-top-right-radius: 0px;">
                                <span style="background-color: mediumspringgreen;">
                                    <h5 class="breadcrumbs-title" style="font-weight: 800;mso-bidi-font-style: oblique;color: #fff;width: 150px;background-color: #FFB03B;border-radius: 8px;text-align: center;">Order Food</h5>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Notice Board-->
                <div class="container">
                    <p class="caption">
                    <blockquote style="border-radius:12px;">
                        <b style="font-size: 12px;">Welcome to Yaadi food delivery ♨</b>

                    <blockquote style="border-radius:8px;"><p class="caption" style="font-size: 16px;"><b style="font-family: Bangers, cursive;font-size: 18px;">Yaadi.co</b> | <b>Anywhere,</b> Anytime, <b>Online<b style="font-family: Bangers, cursive;font-size: 18px;">!</b></b></p></blockquote>
                    </p>

                </div>
<!--                                End of notice board-->
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
                                            <a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger" style="color: darkred;">Remove</span></a>
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
                                        <p>Select a restaurant to place your order.</p>
                                    </div>
                                    <div class="col s4"><br>
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

            <div class="divider" style="height: inherit;background-color: whitesmoke;">
                <span class="left" style="padding-left: 5px;"><button class="btn" style="border-radius: 4px;background-color: whitesmoke;border: 1px solid white;color: mediumaquamarine;"><i class="mdi-maps-pin-drop" style="font-size: 24px;"></i></button></span>



                <span class="left" style="padding-left: 5px;"><button class="btn" style="border-radius: 4px;background-color: whitesmoke;border: 1px solid white;color: mediumaquamarine;"><i class="mdi-av-play-shopping-bag" style="font-size: 24px;"></i></button></span>


                <span class="right" style="padding-right: 5px;"><button class="btn" style="border-radius: 4px;background-color: whitesmoke;border: 1px solid white;color: mediumaquamarine;"><i class="mdi-content-filter-list" style="font-size: 24px;"></i></button></span>
            </div>

            <!--                Start First Category-->

            <section class="content">
                <div class="responsive col-md-10 text-center" id="menu-filters">
                    <ul class="center-align"  style="font-weight: 300;width: 100%;text-align: center;color: teal;">
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;" disabled><span> Fast Food</span></a></li>
                        <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🍟️</span></a></li>
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 45 - 60 Min.</a></li>
                    </ul>
                </div>
                <div class="scrolling-wrapper">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Fast Food' ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $image = $row['image_dir'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];
                            $address = $row['address'];
                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                    <div class="column">
                                        <div class="col s6 responsive" style="height: auto;">
                                            <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                    <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                        <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                        <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                    </div>
                                                </div></div></button></div>
                                </form>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </section>

            <div class="divider"></div>

            <section class="content">

                <div class="responsive col-md-10 text-center" id="menu-filters">
                    <ul class="center-align"  style="font-weight: 800;width: 100%;text-align: center;color: teal;">
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;"><span>Jamaican Chinese</span></a></li>
                        <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🧆</span></a></li>
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 30 Min.</a></li>
                    </ul>
                </div>
                <div class="scrolling-wrapper">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Jamaican Chinese' OR ocassion='Chinese' ORDER BY id='53' DESC, id='540' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $image = $row['image_dir'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];
                            $address = $row['address'];
                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                    <div class="column">
                                        <div class="col s6 responsive " style="height: auto;">
                                            <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                    <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                        <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                        <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                    </div>
                                                </div></div></button></div>
                                </form>



                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>


            </section>

            <div class="divider" style="height: 220px;"><img class="center" src="images/topban.jpg" style="width: 100%;object-fit: scale-down;"></div>

            <section class="content">

                <div class="responsive col-md-10 text-center" id="menu-filters">
                    <ul class="center-align"  style="font-weight: 800;width: 100%;text-align: center;color: teal;">

                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;"><span>Pizza</span></a></li>
                        <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🍕️</span></a></li>
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 30 - 45 Min.</a></li>
                    </ul>
                </div>
                <div class="scrolling-wrapper">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Pizza' ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $image = $row['image_dir'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];
                            $address = $row['address'];
                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                    <div class="column">
                                        <div class="col s6 responsive " style="height: auto;">
                                            <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                    <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                        <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                        <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                    </div>
                                                </div></div></button></div>
                                </form>



                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </section>

            <section class="content">

                <div class="responsive col-md-10 text-center" id="menu-filters">
                    <ul class="center-align"  style="font-weight: 800;width: 100%;text-align: center;color: teal;">

                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;"><span>Deserts</span></a></li>
                        <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🍨</span></a></li>
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 30 Min.</a></li>
                    </ul>
                </div>
                <div class="scrolling-wrapper">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Desert' ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $image = $row['image_dir'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];
                            $address = $row['address'];
                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                    <div class="column">
                                        <div class="col s6 responsive " style="height: auto;">
                                            <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                    <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                        <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                        <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                    </div>
                                                </div></div></button></div>
                                </form>



                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </section>

            <div class="divider" style="height: 220px;"><img class="center" src="images/adban.jpg" style="width: 100%;object-fit: scale-down;"></div>

            <section class="content">
                <div class="responsive col-md-10 text-center" id="menu-filters">
                    <ul class="center-align"  style="font-weight: 800;width: 100%;text-align: center;color: teal;">

                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;"><span>Restaurant & Bar</span></a></li>
                        <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🍹️</span></a></li>
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 30 - 45 Min.</a></li>
                    </ul>
                </div>
                <div class="scrolling-wrapper">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Restaurant & Bar' ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $image = $row['image_dir'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];
                            $address = $row['address'];
                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                    <div class="column">
                                        <div class="col s6 responsive " style="height: auto;">
                                            <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                    <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                        <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                        <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                    </div>
                                                </div></div></button></div>
                                </form>



                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </section>

            <div class="divider"></div>

            <section class="content">
                <div class="responsive col-md-10 text-center" id="menu-filters">
                    <ul class="center-align" style="font-weight: 800;width: 100%;text-align: center;color: teal;">
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;"><span> Seafood</span></a></li>
                        <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🦞️</span></a></li>
                        <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 45 - 60 Min.</a></li>
                    </ul>
                </div>
                <div class="scrolling-wrapper">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Seafood' ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] != "297"){
                            $image = $row['image_dir'];
                            $image_dir = '';
                            $restaurant_id = $row['id'];
                            $restaurant_name = $row['name'];
                            $address = $row['address'];
                            $mon = $row['mon'];
                            $monc = $row['monc'];

                            if ($image != ''){
                                $image_dir = $image;
                            }
                            else if ($image == ''){
                                $image_dir = 'images/yaadi-food.jpg';
                            }

                            ?>
                            <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                    <div class="column">
                                        <div class="col s6 responsive " style="height: auto;">
                                            <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                    <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                        <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                        <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                    </div>
                                                </div></div></button></div>
                                </form>



                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="divider"></div>

                <section class="content">

                    <div class="responsive col-md-10 text-center" id="menu-filters">
                        <ul class="center-align"  style="font-weight: 800;width: 100%;text-align: center;color: teal;">
                            <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;"><span>Restaurant</span></a></li>
                            <li><a class="filter" style="border:1px solid #BBBBBB;"><span style="font-size:48px;">🧆</span></a></li>
                            <li><a style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;">⏱️ 30-45 Min.</a></li>
                        </ul>
                    </div>
                    <div class="scrolling-wrapper">
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM users where role='Restaurant' AND not deleted AND ocassion='Jerk' OR ocassion='Restaurant' ORDER BY id='53' DESC, id='540' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                        while($row = mysqli_fetch_array($result))
                        {
                            if ($row['id'] != "297"){
                                $image = $row['image_dir'];
                                $image_dir = '';
                                $restaurant_id = $row['id'];
                                $restaurant_name = $row['name'];
                                $address = $row['address'];
                                $mon = $row['mon'];
                                $monc = $row['monc'];

                                if ($image != ''){
                                    $image_dir = $image;
                                }
                                else if ($image == ''){
                                    $image_dir = 'images/yaadi-food.jpg';
                                }

                                ?>
                                <div class="smallcard"><form class="formValidate" id="formValidate" method="post" action="routers/c-router.php?pgid=<?php echo $restaurant_id; ?>" novalidate="novalidate">
                                        <div class="column">
                                            <div class="col s6 responsive " style="height: auto;">
                                                <button style="border-radius: 16px; background-color: transparent;margin: 0; border: 0px;"><div class="card responsive z-depth-0" style="border-radius:16px;width:100%">
                                                        <div class="card-image waves-effect waves-block waves-light" style="border-radius:16px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                                                            <img class="activator responsive" src="<?php echo $image_dir; ?>" style="width: 100%;height: 200px;object-fit: cover;a" alt="img">
                                                            <span><span class="left" style="font-size: 10px; color: mediumseagreen;padding-left: 5px;">Open: <?php echo $mon; ?>AM</span> <span class="center" style="font-size: 12px; color: mediumaquamarine;padding-top: 5px;">|</span> <span class="right" style="font-size: 10px; color: darkred;padding-right: 5px;">Close: <?php echo $monc; ?>PM</span></span><br>
                                                            <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;"><span id="open-status" class="left" style="font-size: 16px;padding-left: 5px;font-weight: 300;color: transparent;background-color: mediumaquamarine;border-radius: 2px;border-radius-bottom-left: 16px;width: 20px;height: 100%;"><b></b>.</span> <span class="center title center" style="padding-top: 2px;"><?php echo $restaurant_name; ?></span> <span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span><span class="right" style="color: darkgoldenrod;padding-top: 2px;padding-right: 5px;">☆</span></span>
                                                        </div>
                                                    </div></div></button></div>
                                    </form>



                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>


                </section>

            </section>
            <div class="divider" style="height: 220px;"><img class="center" src="images/footerban.jpg" style="width: 100%;object-fit: scale-down;"></div>

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
        (function($) {
            $("#viewcart").click(function() {
                $("#cartview").toggle();
            });

        })(jQuery);</script>
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
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin.php");
    }
    else{
        header("location:login.php");
    }
}
?>