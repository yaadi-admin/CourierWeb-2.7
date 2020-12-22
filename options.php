<?php
include 'includes/connect.php';
include 'includes/wallet.php';
if($_SESSION['customer_sid']==session_id())
{
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
    }
    if ($category == 6){
        $category_name = $_POST['category_name'];
    }
    if ($category == 7){
        $category_name = $_POST['category_name'];
    }
    if ($category == 8){
        $category_name = $_POST['category_name'];
    }
    if ($category == 9){
        $category_name = $_POST['category_name'];
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

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title><?php echo $category_name;?></title>
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
        </style>
    </head>
    <body>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <header id="header" class="page-topbar">
        <div class="navbar-fixed z-depth-0">
            <nav class="navbar-color z-depth-0">
                <div class="nav-wrapper">
                    <ul style="background-color: white;">
                        <label class="center" style="font-size: 10px;color: #a21318;font-weight: 600;"><b>DELIVERING TO <span style="font-size: 6px;"></span> <span id="nearby"></span></b></label>
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
                <ul id="slide-out" class="side-nav menu fixed leftnavset">
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
                        <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-action-account-box"></i>Account</a>
                        </li>
                        <li class="bold"><a href="#." class="waves-effect waves-cyan"><i class="mdi-action-settings"></i>Settings</a>
                        </li>
                    </nav>
                </ul>
            </aside>

            <div id="modal1" class="modal modal-fixed-footer">
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
                                            <p class="collections-title"><strong><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;width: 20px;">(<?php echo $values["item_quantity"];?>)</span></strong> <?php echo $values["item_name"]; ?></p>
                                            <span style="font-size: 12px;"><?php echo $values["item_variation"]; ?></span>
                                        </div>

                                        <div class="col s4"><br>
                                            <span>$<?php echo $values["item_price"]; ?> <span style="font-size: 10px;">JMD</span></span>
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
                                    <div class="col s6">
                                        <p class="collections-title"> Sub-total</p>
                                        <div class="card-action">
                                        </div>
                                    </div>
                                    <div class="col s6"><br>
                                        <span><strong>$<?php echo number_format($total); ?> <span style="font-size: 10px;">JMD</span></strong></span>
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
                            <i class="mdi-content-send right"></i></button>
                    </form>';
                        }
                        else {
                            echo '<p class="center">Ordering will open shortly<span class="red-text right" style="border-radius: 16px;">Closed</span></p>';
                        }
                    }
                    else{
                        echo '<a href="#!" class="modal-close waves-effect waves-green btn-flat">Close <i class="mdi-navigation-close right"></a></i>';
                    }

                    ?>
                </div>
            </div>


            <section id="content">
                <div class="container">
                    <div id="editableTable" class="section">
                        <div class="row">
                            <ul class="collection with-header collapsible z-depth-0" style="border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                <img src="images/footerban.jpg" height="60px;" width="100%" style="object-fit: cover;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                <li class="collection-header" style="border-top-left-radius: 8px;border-top-right-radius: 8px;"><h5><?php echo $category_name;?></h5></li>
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM items WHERE (restaurantid= '$resid' OR restaurantid='$res_id') AND not deleted ORDER BY id ASC;");
                                while($row = mysqli_fetch_array($result))
                                {
                                    $detail = "";
                                    if ($row['description'] == ""){
                                        $detail = "No detail available";
                                    }

                                    else {
                                        $detail = $row['description'];
                                    }

                                    $key = $row['id'];
                                    $sql = mysqli_query($con,"SELECT * from wallet WHERE customer_id = $key;");
                                    if($row1 = mysqli_fetch_array($sql)){
                                        $wallet_id = $row1['id'];
                                        $sql1 = mysqli_query($con,"SELECT * from wallet_details WHERE wallet_id = $wallet_id;");
                                        if($row2 = mysqli_fetch_array($sql1)){
                                            $balance = $row2['balance'];
                                        }
                                    }

                                    ?>

                                    <li class="collection-header" style="border: 0px solid transparent;border-top-left-radius: 8px;border-top-right-radius: 8px;"><h5><?php echo $row["name"]; ?><span class="right teal-text">$<?php echo number_format($row["price"]); ?></span> </h5></li>
                                    <li class="collection-item avatar" style="border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;">
                                        <form method="post">
                                            <img src="<?php if ($row['img_addr'] != 0 || $row['img_addr'] != "") {echo $row['img_addr'];} else {echo "images/itemdefault.png";} ?>" style="object-fit: cover;" class="circle">
                                            <p class="title"><label for="quantity">Quantity:</label>
                                                <input style="color: darkred;width: 80%;" type="tel" max="10" min="1" id="quantity" name="quantity" value="1"/></p>
                                            <?php
                                            if ($row["typeone"] === "" && $row["type2"] === "" && $row["type3"] === "" && $row["type4"] === "") {
                                                echo '';
                                            }
                                            else{
                                                echo '
                                                       <p>
                                                    <label for="variation">Choose Flavor</label>
                                                    <select id="variation" name="variation">';
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
                                                    <select id="variation_typee" name="variation_typee">';

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
                                                        <select id="variation_side" name="variation_side">';

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
                                                        <select id="variation_drink" name="variation_drink">';
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
                                            <button id="add_to_cart" type="submit" name="add_to_cart" style="margin-top:0px;border-radius: 8px;font-size:20px;width: 50px;border: 0px solid transparent;" class="btn-floating secondary-content z-depth-0" value="<?php echo $row["id"]; ?>"><i class="mdi-action-shopping-basket"></i></button>
                                            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                            <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
                                        </form>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
            </section>
            <span id="message"></span>
        </div>
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
    <script>
        $(document).ready(function(){
            addtocart();
        });

        function addtocart() {
            $(document).on('click', "#add_to_cart", function (e) {
                e.preventDefault();
                var itemid = $('#hidden_id').val();
                var itemname = $('#hidden_name').val();
                var itemprice = $('#hidden_price').val();
                var itemquantity = $('#quantity').val();
                var itemvariation = $('#variation').val();
                var itemvartype = $('#variation_typee').val();
                var itemvarside = $('#variation_side').val();
                var itemvardrink = $('#variation_drink').val();
                var add_to_cart = $('#add_to_cart').val();

                if (itemname == "" || itemprice == ""){
                    Materialize.toast('Error adding item to cart', 4000);
                }
                else {
                    $.ajax({
                        url: '../routers/add-meal.php?action=add&id=' + itemid,
                        method: 'post',
                        data:{hidden_name:itemname,hidden_price:itemprice,quantity:itemquantity,variation:itemvariation,variation_typee:itemvartype,variation_side:itemvarside,variation_drink:itemvardrink,add_to_cart:add_to_cart},
                        success: function (data) {
                            $('#message').html(data);

                        }
                    })
                }
            })
        }
    </script>
    <script type='text/javascript' data-cfasync='false'>
        window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript';
            script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '2c63b2b2-cf28-43d2-9604-89dd5cb4ac9d', f: true }); done = true; } }; })();
    </script>
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