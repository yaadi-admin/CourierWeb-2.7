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
                        <label class="center" style="font-size: 8px;color: #a21318;font-weight: 600;"><b>DELIVERING TO</b></label>
                        <li class="center"><a href="index.php" class="brand-logo darken-1" style="font-size: 12px;color: black;"><?php echo $usr_address; ?></a></li>
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

            <div class="scrolling-wrapper" style="height: 60px;" hidden>
                <div class="smallcard">
                    <div class="column">
                        <div>
                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;">
                                Pickup
                            </div>

                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;font-size: 12px;">
                                Over 4.5 <i class="mdi-toggle-star" style="width: 10%;font-size: 12px;"></i> <i class="mdi-navigation-arrow-drop-down" style="font-size: 18px;"></i>
                            </div>

                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;font-size: 12px;">
                                Under 30 Min
                            </div>

                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;font-size: 12px;">
                                Vegetarian
                            </div>

                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;font-size: 12px;">
                                $,$$$ |<i class="mdi-navigation-arrow-drop-down" style="font-size: 18px;"></i>
                            </div>

                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;font-size: 12px;">
                                Group Order
                            </div>

                            <div class="chip" style="width: auto; height: inherit;background-color: lightgray;color: black;font-size: 12px;">
                                <i class="mdi-action-wallet-membership"></i> Yaadi Pass
                            </div>

                        </div></div>



                </div>
            </div>




            <div class="col s12">
                <h5 style="padding-left: 20px;font-weight: 600;"><b>All restaurants</b></h5>

                <div id="restaurants" class="col s12">

                    <?php
                    $result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND not deleted ORDER BY name ASC;");
                    while($row = mysqli_fetch_array($result))
                    {
                    if ($row['id'] != "297"){
                    $image = $row['image_dir'];
                    $image_dir = '';
                    $image_dir2 = '';
                    $image_dir2 = '';
                    $restaurant_id = $row['id'];
                    $restaurant_name = $row['name'];
                    $address = $row['address'];
                    $type = $row['ocassion'];
                    $mon = $row['mon'];
                    $monc = $row['monc'];

                    if ($image != ''){
                        $image_dir = $image;
                        $image_dir2 = $row['image_dir2'];
                        $image_dir3 = $row['image_dir3'];
                    }
                    else if ($image == ''){
                        $image_dir = 'images/yaadi-food.jpg';
                    }

                    ?>

                    <div class="col s12 responsive" style="height: auto;">
                        <form class="formValidate" id="formValidate" method="post" action="routers/c-router.php" novalidate="novalidate">
                            <div id="<?php echo $restaurant_id; ?>" class="card responsive z-depth-0 timeset" style="border-radius:8px;width:100%;background-color: whitesmoke;border-bottom: 6px solid ;">
                                <button type="submit" style="border-radius: 8px; background-color: transparent;margin: 0; border: 0px;width: 100%;">
                                    <div id="restaurant-card" class="card-image waves-effect waves-block waves-light" style="border-radius:8px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;height: 160px;background-color: whitesmoke;">
                                        <input name="rest" value="<?php echo $restaurant_name; ?>" hidden>

                                        <img class="responsive left" src="<?php echo $image_dir; ?>" style="width: 33%;height: 100px;object-fit: cover;padding-right: 5px;border-radius: 10px;" alt="img">
                                        <div style="height: 5px;width: 5px;"></div>
                                        <img class="responsive left" src="<?php echo $image_dir2; ?>" style="width: 33%;height: 100px;object-fit: cover;border-radius: 10px;" alt="img">
                                        <div style="height: 5px;width: 5px;"></div>
                                        <img class="responsive right" src="<?php echo $image_dir3; ?>" style="width: 33%;height: 100px;object-fit: cover;border-radius: 10px;" alt="img">

                                        <span class="text-black title" style="width: 100%;font-weight: 300;font-size: 12px;">

                                                            <span class="title left" style="padding-top: 2px;padding-left: 10px; font-size: 16px;"><b class="left"><?php echo $restaurant_name; ?></b>
                                                                <br>

                                                                <span style="font-size: 12px;color: #6d6d6d;"><?php echo $address; ?></span>

                                                            </span>
                                                        </span>

                                    </div>


                                    <span class="right" style="font-size: 12px;font-weight: 300;color: black;border: 1px solid floralwhite;padding-right: 5px;border-radius: 8px;"> <span class="right">Closes: <span id="closes"><?php echo $monc; ?></span> PM</span></span>
                                    <label class="openclose" style="font-family: 'Modak', 'cursive';"></label>
                                    <span class="mdi-toggle-star-outline left" style="width: 5%;"></span><span class="mdi-toggle-star-outline left" style="width: 5%;"></span><span class="mdi-toggle-star-outline left" style="width: 5%;"></span><span class="mdi-toggle-star-outline left" style="width: 5%;"></span><span class="mdi-toggle-star-outline left" style="width: 5%;"></span>

                        </form>

                        <?php
                        }

                        }
                        ?>


                    </div></div>

            </div>
    </div>
    </section>



    </div>

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
    <script>
        var instance = M.Tabs.init(el, options);

        // Or with jQuery

        $(document).ready(function(){
            $('.tabs').tabs();
        });
    </script>
    <script type='text/javascript' data-cfasync='false'>
        window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript';
            script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '2c63b2b2-cf28-43d2-9604-89dd5cb4ac9d', f: true }); done = true; } }; })();
    </script>
    <script>
        $(document).ready(function(){
            openTime();
        });

        //javascript function to display open/closed in the open hours page
        function openTime() {
            var d = new Date(); //get the time/date
            var dy = d.getDay(); //what day is it
            var moment = String(Date()).slice(16,21); //time as a string
            var moment = moment.replace(":",""); //remove the colon
            var open = String(document.getElementById('open')).slice(16,21);
            var close = String(document.getElementById('closes')).slice(16,21);
            // open.replace(":","");
            // close.replace(":","");
            // $('.timeset').style.borderBottom = '6px solid maroon';
            // .style.borderBottom = "6px solid maroon";

            if (dy == 0){//sunday: closed
                <?php
                $resultttt = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND not deleted ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                while($row1 = mysqli_fetch_array($resultttt))
                {
                    echo 'document.getElementById("'.$row1['id'].'").style.borderBottom = "6px solid maroon";';
                    echo "$('.openclose').html('Not accepting orders').style.color = 'maroon';";
                }
                ?>
            }else{

                if(moment > 830 && moment < 1730){//is the current time between 830am and 5:30pm
                    <?php
                    $resultt = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND not deleted ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row2 = mysqli_fetch_array($resultt))
                    {
                        $openclosertime = "";
                        $openclosee = mysqli_query($con, "SELECT * FROM incumbency WHERE id= 2");
                        while ($row = mysqli_fetch_array($openclosee)) {
                            $openclosertime = $row['admission'];
                        }

                        if ($openclosertime == 0) {
                            echo 'document.getElementById("'.$row2['id'].'").style.borderBottom = "6px solid mediumseagreen";';
                            echo "$('.openclose').html('Accepting orders');";
                        }
                        else {
                            echo 'document.getElementById("'.$row2['id'].'").style.borderBottom = "6px solid maroon";';
                            echo "$('.openclose').html('Not accepting orders');";
//                            echo "$('.openclose').css('color', 'red');";
                        }


                    }
                    ?>

                }else{
                    <?php
                    $resulttt = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant' AND not deleted ORDER BY id='53' DESC, id='331' DESC, id='55' DESC, id='80' DESC, id='54' DESC, id='57' DESC, id='131' DESC;");
                    while($row3 = mysqli_fetch_array($resulttt))
                    {
                        echo 'document.getElementById("'.$row3['id'].'").style.borderBottom = "6px solid maroon";';
                        echo "$('.openclose').html('Not accepting orders');";
                    }
                    ?>
                }
            }
        }

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