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
                    'item_variation'        =>    $_POST["variation"],
                    'item_variation_type'        =>    $_POST["variation_typee"],
                    'item_variation_side'        =>    $_POST["variation_side"],
                    'item_variation_drink'        =>    $_POST["variation_drink"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                $Itemnm = $_POST["hidden_name"];
                echo '<script>Materialize.toast("'.$Itemnm.' was added to your cart", 4000);</script>';
                echo '<script>alert("'.$Itemnm.' was added to your cart");</script>';
            }
            else
            {
                echo '<script>alert("Item Already Added To Cart")</script>';
                echo '<script>window.location="place-new-order.php"</script>';
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
//                    echo '<script>window.location="category.php?pgid='.$restid.'"</script>';
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
        <script>
            var searchInput = 'address';

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
            <aside id="left-sidebar-nav">
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
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders
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
                    <li class="bold"><a href="account-page.php" class="waves-effect waves-cyan"><i class="mdi-action-shop-two"></i>Account</a>
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

                                        <li class="collection-item"><p><a class="btn-flat waves-effect waves-light black-text left" style="border-radius: 6px;background-color: white;border: 1px solid maroon;font-size: 10px;color: black;width: 100%;" href="request-order.php" value="Change" name="submithide">Place Order
                                                        <i class="mdi-action-shopping-basket right" style="color: maroon;"></i>
                                                    </a></p><br><br></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="collection with-header"><li class="collection-header"><h6>Select Meal(s)</h6></li></ul>
                <ul class="collection with-header">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $user_id AND not deleted ORDER BY id ASC;");
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

                            <li class="collection-header" style="border: 0px solid transparent;border-top-left-radius: 8px;border-top-right-radius: 8px;"><h5><?php echo $row["name"]; ?><span class="right teal-text">$<?php echo number_format($row["price"]); ?></span> </h5></li>
                            <li class="collection-item avatar" style="border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;">
                                <form method="post" action="place-new-order.php?action=add&id=<?php echo $row["id"]; ?>">
                                    <img src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "") {echo $row['img_addr'];} else {echo "images/itemdefault.png";} ?>" style="object-fit: cover;" class="circle">
                                    <p class="title"><label for="quantity">Quantity:</label>
                                        <input style="color: darkred;width: 80%;" type="tel" max="10" min="1" name="quantity" value="1"/>
                                        <input type="hidden"/></p>
                                    <?php
                                    if ($row["typeone"] === "" && $row["type2"] === "" && $row["type3"] === "" && $row["type4"] === "") {
                                        echo '';
                                    }
                                    else{
                                        echo '
                                                       <p>
                                                    <label for="variation">Choose Flavor</label>
                                                    <select class="browser-default" id="variation" name="variation">';
                                        if ($row["typeone"] !== ""){
                                            echo '<option value="'.$row["typeone"].'">'.$row["typeone"].'</option>';
                                        }
                                        if ($row["type2"] !== ""){
                                            echo '<option value="'.$row["type2"].'">'.$row["type2"].'</option>';
                                        }
                                        if ($row["type3"] !== ""){
                                            echo '<option value="'.$row["type3"].'">'.$row["type3"].'</option>';
                                        }
                                        if ($row["type4"] !== ""){
                                            echo '<option value="'.$row["type4"].'">'.$row["type4"].'</option>';
                                        }

                                        echo'
                                                    </select>
                                                </p>';
                                    }
                                    ?>
                                    <?php
                                    if ( $row["type5"] === "" && $row["type6"] === "" && $row["type7"] === "" && $row["type8"] === ""){
                                    }
                                    else{
                                        echo '<p>
                                                    <label for="variation_typee">Choose type</label>
                                                    <select class="browser-default" id="variation_typee" name="variation_typee">';

                                        if ($row["type5"] !== ""){
                                            echo '<option value="'.$row["type5"].'">'.$row["type5"].'</option>';
                                        }
                                        if ($row["type6"] !== ""){
                                            echo '<option value="'.$row["type6"].'">'.$row["type6"].'</option>';
                                        }
                                        if ($row["type7"] !== ""){
                                            echo '<option value="'.$row["type7"].'">'.$row["type7"].'</option>';
                                        }
                                        if ($row["type8"] !== ""){
                                            echo '<option value="'.$row["type8"].'">'.$row["type8"].'</option>';
                                        }

                                        echo '
                                                    </select>

                                                </p>';
                                    }
                                    ?>

                                    <?php
                                    if ($row["type9"] === "" && $row["type10"] === "" && $row["typeeleven"] === "" && $row["typetwelve"] === "") {
                                    }
                                    else{
                                        echo '
                                                    <p>
                                                        <label for="variation_side">Choose Side</label>
                                                        <select class="browser-default" id="variation_side" name="variation_side">';

                                        if ($row["type9"] !== ""){
                                            echo '<option value="'.$row["type9"].'">'.$row["type9"].'</option>';
                                        }
                                        if ($row["type10"] !== ""){
                                            echo '<option value="'.$row["type10"].'">'.$row["type10"].'</option>';
                                        }
                                        if ($row["typeeleven"] !== ""){
                                            echo '<option value="'.$row["typeeleven"].'">'.$row["typeeleven"].'</option>';
                                        }
                                        if ($row["typetwelve"] !== ""){
                                            echo '<option value="'.$row["typetwelve"].'">'.$row["typetwelve"].'</option>';
                                        }
                                        echo '
                                                        </select>
                                                    </p>';
                                    }

                                    ?>

                                    <?php
                                    if ($row["typethirteen"] === "" && $row["typefourteen"] === "" && $row["typefifteen"] === "" && $row["typesixteen"] === "") {
                                    }
                                    else{
                                        echo '
                                                    <p>
                                                        <label for="variation_drink">Choose Drink</label>
                                                        <select class="browser-default" id="variation_drink" name="variation_drink">';
                                        if ($row["typethirteen"] !== ""){
                                            echo '<option value="'.$row["typethirteen"].'">'.$row["typethirteen"].'</option>';
                                        }
                                        if ($row["typefourteen"] !== ""){
                                            echo '<option value="'.$row["typefourteen"].'">'.$row["typefourteen"].'</option>';
                                        }
                                        if ($row["typefifteen"] !== ""){
                                            echo '<option value="'.$row["typefifteen"].'">'.$row["typefifteen"].'</option>';
                                        }
                                        if ($row["typesixteen"] !== ""){
                                            echo '<option value="'.$row["typesixteen"].'">'.$row["typesixteen"].'</option>';
                                        }
                                        echo '
                                                        </select>
                                                    </p>';
                                    }
                                    ?>
                                    <?php echo $detail; ?>
                                    <button id="add_to_cart" type="submit" name="add_to_cart" style="margin-top:0px;border-radius: 8px;font-size:20px;width: 50px;border: 0px solid transparent;" class="btn-floating secondary-content z-depth-0"><i class="mdi-action-shopping-basket"></i></button>
                                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                </form>
                            </li>

                            <?php
                        }
                    }
                    ?>
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