<?php
include 'includes/connect.php';
include 'includes/wallet.php';
if($_SESSION['customer_sid']==session_id())
{
    $selec_rest = '0';
    $restid = '0';
    $Rnme = '';
    $counter = 0;
    $image_dir = "";


    $category = $_POST['category'];
    if ($category == 0){
        $category_name = $_POST['category_name'];
        $resid = 53;
        $res_id = 55;
    }
    if ($category == 1){
        $category_name = $_POST['category_name'];
        $resid = 55;
        $res_id = 55;
    }
    if ($category == 2){
        $category_name = $_POST['category_name'];
        $resid = 80;
        $res_id = 79;
    }
    if ($category == 3){
        $category_name = $_POST['category_name'];
        $resid = 331;
        $res_id = 430;
    }
    if ($category == 4){
        $category_name = $_POST['category_name'];
        $resid = 294;
        $res_id = 294;
    }
    if ($category == 5){
        $category_name = $_POST['category_name'];
        $resid = 53;
        $res_id = 55;
    }
    if ($category == 6){
        $category_name = $_POST['category_name'];
        $resid = 53;
        $res_id = 55;
    }
    if ($category == 7){
        $category_name = $_POST['category_name'];
        $resid = 53;
        $res_id = 55;
    }
    if ($category == 8){
        $category_name = $_POST['category_name'];
        $resid = 53;
        $res_id = 55;
    }
    if ($category == 9){
        $category_name = $_POST['category_name'];
        $resid = 53;
        $res_id = 55;
    }
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
                    'item_variation'        =>    $_POST["variation"],
                    'item_variation_type'        =>    $_POST["variation_typee"],
                    'item_variation_side'        =>    $_POST["variation_side"],
                    'item_variation_drink'        =>    $_POST["variation_drink"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                $Itemnm = $_POST["hidden_name"];
                echo '<script>alert("Item Added To Cart")</script>';
                echo '<script>window.location="options.php"</script>';
            }
            else
            {
                echo '<script>alert("Item Already Added To Cart")</script>';
                echo '<script>window.location="options.php"</script>';
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
                    echo '<script>window.location="options.php"</script>';
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
        <title><?php echo $_POST['category_name']; ?></title>
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
            label{
                color: black;
            }.navbar-fixed nav {
                 padding: env(safe-area-inset-top) env(safe-area-inset-right) env(safe-area-inset-bottom) env(safe-area-inset-left);
             }.footer-fixed footer {
                  padding: env(safe-area-inset-top) env(safe-area-inset-right) env(safe-area-inset-bottom) env(safe-area-inset-left);
              }body {
                   display: -webkit-box;
                   display: flex;
                   min-height: 100vh;
                   -webkit-box-orient: vertical;
                   -webkit-box-direction: normal;
                   flex-direction: column;
               }main {
                    -webkit-box-flex: 1;
                    flex: 1 0 auto;
                }.footer-fixed {
                     position: fixed;
                     bottom: 0;
                     width: 100%;
                 }footer ul.justify {
                      text-align: center;
                      display: table;
                      overflow: hidden;
                      margin: 0 auto;
                  }footer ul.justify li {
                       margin-left: auto;
                       margin-right: auto;
                       width: 82px;
                   }
            .scrolling-wrapper {
                overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap;}.scrolling-wrapper .smallcard {
                                         display: inline-block;}.scrolling-wrapper-flexbox .smallcard {
                                                                    -webkit-box-flex: 0;
                                                                    flex: 0 0 auto;
                                                                    margin-right: 3px;}.smallcard {
                                                                                           width: 110px;
                                                                                           height: 60px;}.scrolling-wrapper,  {
                                                                                                             height: 70px;
                                                                                                             margin-bottom: 20px;
                                                                                                             width: 100%;
                                                                                                             -webkit-overflow-scrolling: touch;}.scrolling-wrapper::-webkit-scrollbar, :-webkit-scrollbar {
                                                                                                                                                    display: none;}.chip{
                                                                                                                                                                       background-color: white;
                                                                                                                                                                       width: 120px;
                                                                                                                                                                       height: inherit;}.chip img{
                                                                                                                                                                                            width: 48px;
                                                                                                                                                                                            height: 48px;}
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
            <nav class="navbar-color z-depth-0">
                <div class="nav-wrapper z-depth-0">
                    <ul style="background-color: white;">
                        <label class="center" style="font-size: 8px;color: #a21318;font-weight: 600;"><b>DELIVERING TO</b></label>
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
                        <li class="bold active"><a href="index.php"><i class="mdi-action-shop-two"></i>Order Food</a>
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
            </aside>

            <section id="content">
                <div id="breadcrumbs-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="col s4 m4 l4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div id="modal1" class="modal bottom-sheet" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                <?php
                $GetRest_id = "";
                ?>
                <div class="modal-content">
                    <h5>My Cart</h5>
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
                                $mealid = $values['item_id'];

                                $getresttoplace = mysqli_query($con, "SELECT * FROM items where id= $mealid AND not deleted;");
                                while($row = mysqli_fetch_array($getresttoplace))
                                {
                                    $GetRest_id = $row['restaurantid'];
                                }

                                ?>
                                <li class="collection-item" style="width: 100%;">
                                    <div class="row">
                                        <div class="col s8">
                                            <h6><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;font-size: 12px;">(<?php echo $values["item_quantity"];?>)</span></h6>
                                            <p class="collections-title"><?php echo $values["item_name"]; ?></p>
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
                                        </div>

                                        <div class="col s4"><br>
                                            <span>$<?php echo $values["item_price"]; ?> <span style="font-size: 6px;">JMD</span></span><br>
                                            <a href="category.php?action=delete&id=<?php echo $values["item_id"]; ?>&pgid=<?php echo $restid; ?>"><i class="mdi-navigation-close" style="font-size: 20px;color: maroon;"></i></a>
                                        </div>
                                    </div>
                                </li>

                                <?php
                                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                            ?>

                            <li class="collection-item" style="width: 100%;">
                                <div class="row">
                                    <div class="col s7">
                                        <p class="collections-title"> Subtotal</p>
                                        <div class="card-action">
                                        </div>
                                    </div>
                                    <div class="col s5"><br>
                                        <span><strong>$<?php echo number_format($total); ?> <span style="font-size: 6px;">JMD</span></strong></span>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <?php
                    if ($GetRest_id != ""){
                        $opencloser = "";
                        $openclose = mysqli_query($con, "SELECT * FROM incumbency WHERE id= 2");
                        while ($row = mysqli_fetch_array($openclose)) {
                            $opencloser = $row['admission'];
                        }

                        if ($opencloser == 0) {
                            echo '<form action="place-order.php?pgid=' . $GetRest_id . '" method="post">
                        <button class="waves-effect waves-green btn-flat" type="submit" name="action" style="border-radius:6px;">Checkout
                            <i class="mdi-action-shopping-cart right"></i></button>
                    </form>';
                        }
                        else {
                            echo '<p class="center">Ordering currently closed<span class="right" style="border-radius: 16px;"><i class="mdi-action-shopping-cart" style="color: maroon;"></i></span></p>';
                        }
                    }
                    else{
                        echo '<a href="#!" class="modal-close waves-effect waves-green btn-flat">Close <i class="mdi-navigation-close right"></a></i>';
                    }

                    ?>
                </div>
            </div>

            <section id="menu-list" class="responsive">
                <div class="container" style="border: 0px solid transparent;">
                    <div class="row" style="border: 0px solid transparent;">
                        <ul class="collection with-header" style="border: 0px solid transparent;">
                            <img src="images/promotions/promotwo.jpg" height="200px;" width="100%" style="object-fit: cover;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                            <li class="collection-header" style="border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;"><h5><?php echo ''.$_POST['category_name'].''; ?></h5></li>

                            <?php
                            $result4 = mysqli_query($con, "SELECT * FROM users where id= $resid AND not deleted;");
                            while($row = mysqli_fetch_array($result4))
                            {
                            ?>
                            <div id="menu-wrapper" style="border: 0px solid transparent;">

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items where restaurantid= '$resid' AND (category='0' || category='1' || category='2' || category='3' || category='4' || category='5' || category='6') AND not deleted ORDER BY id ASC;");
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
                                        <div class="casuals Starttheday bigdeal bkburgers gizmosalads pizzahutamazin motherspatties dominosspecialtypizza thavillechicken pablos2020breakfast glsteakhouseappetizers flaminlunchboxmeals naufragadaomlets menu-restaurant rosall islandgrillfeatured" style="border: 0px solid transparent;border-radius: 8px;width: 100%;">

                                            <li class="collection-header" style="border: 0px solid transparent;border-top-left-radius: 8px;border-top-right-radius: 8px;"><h5><?php echo $row["name"]; ?><span class="right teal-text">$<?php echo number_format($row["price"]); ?></span> </h5></li>
                                            <li class="collection-item avatar" style="border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;">
                                                <form method="post" action="options.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid; ?>">
                                                    <img src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "") {echo $row['img_addr'];} else {echo "images/itemdefault.png";} ?>" style="object-fit: cover;" class="circle">
                                                    <p class="title"><label for="quantity">Quantity:</label>
                                                        <input style="color: darkred;width: 80%;" type="tel" max="10" min="1" name="quantity" value="1"/></p>
                                                    <?php
                                                    if ($row["typeone"] === "" && $row["type2"] === "" && $row["type3"] === "" && $row["type4"] === "") {
                                                        echo '';
                                                    }
                                                    else{
                                                        echo '
                                                       <p>
                                                    <label for="variation">Choose Flavor</label>
                                                    <select class="browser-default" name="variation">';
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
                                                    <select class="browser-default" name="variation_typee">';

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
                                                        <select class="browser-default" name="variation_side">';

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
                                                        <select class="browser-default" name="variation_drink">';
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
                                                    <button id="add_to_cart" type="submit" name="add_to_cart" style="margin-top:0px;border-radius: 8px;font-size:20px;width: 50px;border: 0px solid transparent;" class="btn-floating secondary-content z-depth-0" value=""><i class="mdi-action-shopping-basket"></i></button>
                                                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                                                    <input type="hidden" name="category_name" value="<?php echo $category_name; ?>">
                                                </form>
                                            </li>

                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                        </ul>
                    </div>
                    <?php
                    }
                    ?>
                </div>
        </div>
        </section>
    </div>
    </div>
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="yaadiltd.php" target="_blank">Yaadi.Co</a>, all rights reserved.</span>
                <span class="right"><a class="grey-text text-lighten-4" href="tercon.php" target="_blank">Terms & Conditions</a></span>
            </div>
        </div>
    </footer>
    <div class="footer-fixed hide-on-med-and-up z-depth-1">
        <div class="row">
            <div class="col s12">
                <?php
                $result3 = mysqli_query($con, "SELECT * FROM users where id= $restid AND not deleted;");
                while($row = mysqli_fetch_array($result3))
                {
                    $restid = $selec_rest;
                    $Rnme = $row['name'];
                    if ($row['name'] === 331) {
                        echo '';
                    }
                }
                ?>
                <!--                <ul class="tabs">-->
                <!--                    <li class="tab col s10"><a class="filter active" data-filter=".Starttheday" style="background-color: white;color: black;font-weight: 800;">🌭 Start the day</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter " data-filter=".LunchBeyond" style="background-color: white;color: black;font-weight: 800;">🍔 Lunch & Beyond</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Subs" style="background-color: white;color: black;font-weight: 800;">🌯 Subs</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Wraps" style="background-color: white;color: black;font-weight: 800;">🌯 Wraps</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".ChineseFare" style="background-color: white;color: black;font-weight: 800;">🥡 Chinese Fare</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".JamaicanFare" style="background-color: white;color: black;font-weight: 800;">Jamaican Fare</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Roti" style="background-color: white;color: black;font-weight: 800;">🌯 Roti</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Soups" style="background-color: white;color: black;font-weight: 800;">🍲 Soups</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Appetizers" style="background-color: white;color: black;font-weight: 800;">🍗 Appetizers</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Salads" style="background-color: white;color: black;font-weight: 800;">🥗 Salads</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Seafood" style="background-color: white;color: black;font-weight: 800;">🍣 Seafood</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Poultry" style="background-color: white;color: black;font-weight: 800;">🍗 Poultry</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".FromtheGrill" style="background-color: white;color: black;font-weight: 800;">🥩 From the Grill</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Vegetarian" style="background-color: white;color: black;font-weight: 800;">🥦 Vegetarian</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".PastaFusion" style="background-color: white;color: black;font-weight: 800;">🍝 Pasta Fusion</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".EatMeetSipTalk" style="background-color: white;color: black;font-weight: 800;">🍹 Eat, Meet, Sip, Talk</a></li>-->
                <!--                    <li class="tab col s3"><a class="filter" data-filter=".Sides" style="background-color: white;color: black;font-weight: 800;">🍟 Sides</a></li>-->
                <!--                </ul>-->
            </div>
        </div>
        <footer style="background-color: white;">
            <nav class="z-depth-0" style="background-color: white;">
                <div class="nav-wrapper">
                    <ul class="justify">
                        <li class="active"><a class="waves-effect" name="home" href="index.php"><i class="mdi-action-shop-two" style="color: #a21318;"></i></a></label> </li>
                        <li><a class="waves-effect" href="orders.php"><i class="mdi-editor-insert-invitation" style="color: #a21318;"></i></a></li>
                        <li><a class="waves-effect" href="tickets.php"><i class="mdi-action-question-answer" style="color: #a21318;"></i></a></li>
                        <li><a class="waves-effect" href="details.php"><i class="mdi-action-settings" style="color: #a21318;"></i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>
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
            $("#menu-filters li a").click(function() {
                $("#menu-filters li a").removeClass('active');
                $(this).addClass('active');
                var selectedFilter = $(this).data("filter");
                $(".menu-restaurant").fadeOut();
                setTimeout(function() {
                    $(selectedFilter).slideDown();
                }, 100);
            });
        })(jQuery);
    </script>
    </body>
    </html>
    <?php
}
else
{
    if($_SESSION['restaurant_sid']==session_id())
    {
        header("location:restaurant.php");
    }
    else{
        header("location:login.php");
    }
}
?>