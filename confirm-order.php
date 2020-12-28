<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$continue=0;
$total = 0;
if($_SESSION['customer_sid']==session_id())
{
    $usr_address = "";
    $useraddress = mysqli_query($con, "SELECT * FROM users WHERE name= '$name'");
    while($row = mysqli_fetch_array($useraddress))
    {
        $usr_address = $row['address'];
    }
    $selec_rest = $_GET['id'];
    $restid = $_GET['id'];
    $res_name = '';
    $service_fee = 0;
    $fee = 0;
    $continue=1;

    $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
    while($row = mysqli_fetch_array($result)){
        $name = $row['name'];
        $contact = $row['contact'];
        $address = $row['address'];
    }
    if($_POST['distance'] <= 0.5 && $_POST['distance'] > 0.0){
        $fee = 350;
    }
    if($_POST['distance'] <= 1.0 && $_POST['distance'] > 0.5){
        $fee = 400;
    }
    else if($_POST['distance'] <= 1.5 && $_POST['distance'] > 1.0){
        $fee = 450;
    }
    else if($_POST['distance'] <= 2.0 && $_POST['distance'] >= 1.5){
        $fee = 500;
    }
    else if($_POST['distance'] >= 2.5 && $_POST['distance'] <= 7.0){
        $fee = 500;
    }
//    else if($_POST['distance'] <= 3.0 && $_POST['distance'] >= 2.5){
//        $fee = 600;
//    }
//    else if($_POST['distance'] <= 3.5 && $_POST['distance'] >= 3.0){
//        $fee = 650;
//    }
//    else if($_POST['distance'] <= 4.0 && $_POST['distance'] >= 3.5){
//        $fee = 700;
//    }
//    else if($_POST['distance'] <= 4.5 && $_POST['distance'] >= 4.0){
//        $fee = 750;
//    }
//    else if($_POST['distance'] <= 5.0 && $_POST['distance'] >= 4.5){
//        $fee = 800;
//    }
//    else if($_POST['distance'] <= 5.5 && $_POST['distance'] >= 5.0){
//        $fee = 850;
//    }
//    else if($_POST['distance'] <= 6.0 && $_POST['distance'] >= 5.5){
//        $fee = 900;
//    }
//    else if($_POST['distance'] <= 6.5 && $_POST['distance'] >= 6.0){
//        $fee = 950;
//    }
//    else if($_POST['distance'] <= 7.0 && $_POST['distance'] >= 6.5){
//        $fee = 1000;
//    }
//    else if($_POST['distance'] <= 7.5 && $_POST['distance'] >= 7.0){
//        $fee = 1050;
//    }
    else if($_POST['distance'] <= 8.0 && $_POST['distance'] >= 7.5){
        $fee = 1100;
    }
    else if($_POST['distance'] <= 8.5 && $_POST['distance'] >= 8.0){
        $fee = 1150;
    }
    else if($_POST['distance'] <= 9.0 && $_POST['distance'] >= 8.5){
        $fee = 1200;
    }
    else if($_POST['distance'] <= 9.5 && $_POST['distance'] >= 9.0){
        $fee = 1250;
    }
    else if($_POST['distance'] <= 10.0 && $_POST['distance'] >= 9.5){
        $fee = 1300;
    }
    else if($_POST['distance'] <= 11.5 && $_POST['distance'] > 11.0){
        $fee = 1350;
    }
    else if($_POST['distance'] <= 12.0 && $_POST['distance'] >= 11.5){
        $fee = 1400;
    }
    else if($_POST['distance'] <= 12.5 && $_POST['distance'] >= 12.0){
        $fee = 1450;
    }
    else if($_POST['distance'] <= 13.0 && $_POST['distance'] >= 12.5){
        $fee = 1500;
    }
    else if($_POST['distance'] <= 13.5 && $_POST['distance'] >= 13.0){
        $fee = 1550;
    }
    else if($_POST['distance'] <= 14.0 && $_POST['distance'] >= 13.5){
        $fee = 1600;
    }
    else if($_POST['distance'] <= 14.5 && $_POST['distance'] >= 14.0){
        $fee = 1650;
    }
    else if($_POST['distance'] <= 15.0 && $_POST['distance'] >= 14.5){
        $fee = 1700;
    }
    else if($_POST['distance'] <= 15.5 && $_POST['distance'] >= 15.0){
        $fee = 1750;
    }
    else if($_POST['distance'] <= 16.0 && $_POST['distance'] >= 15.5){
        $fee = 1800;
    }
    else if($_POST['distance'] <= 16.5 && $_POST['distance'] >= 16.0){
        $fee = 1850;
    }
    else if($_POST['distance'] <= 17.0 && $_POST['distance'] >= 16.5){
        $fee = 1900;
    }
    else if($_POST['distance'] <= 17.5 && $_POST['distance'] >= 17.0){
        $fee = 1950;
    }
    else if($_POST['distance'] <= 18.0 && $_POST['distance'] >= 17.5){
        $fee = 2000;
    }
    else if($_POST['distance'] <= 18.5 && $_POST['distance'] >= 18.0){
        $fee = 2050;
    }
    else if($_POST['distance'] <= 19.0 && $_POST['distance'] >= 18.5){
        $fee = 2100;
    }
    else if($_POST['distance'] <= 19.5 && $_POST['distance'] >= 19.0){
        $fee = 2150;
    }
    else if($_POST['distance'] <= 20.0 && $_POST['distance'] >= 19.5){
        $fee = 2200;
    }
    else if($_POST['distance'] <= 20.5 && $_POST['distance'] >= 20.0){
        $fee = 2250;
    }
//    else if($_POST['distance'] <= 21.0 && $_POST['distance'] >= 20.5){
//        $fee = 2300;
//    }
//    else if($_POST['distance'] <= 21.5 && $_POST['distance'] >= 21.0){
//        $fee = 2350;
//    }
//    else if($_POST['distance'] <= 22.0 && $_POST['distance'] >= 21.5){
//        $fee = 2400;
//    }
//    else if($_POST['distance'] <= 23.5 && $_POST['distance'] >= 22.0){
//        $fee = 2450;
//    }
//    else if($_POST['distance'] <= 23.0 && $_POST['distance'] >= 22.5){
//        $fee = 2500;
//    }
//    else if($_POST['distance'] <= 23.5 && $_POST['distance'] >= 23.0){
//        $fee = 2550;
//    }
//    else if($_POST['distance'] <= 24.0 && $_POST['distance'] >= 23.5){
//        $fee = 2600;
//    }
    else
        $continue=1;

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

    if($continue){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="msapplication-tap-highlight" content="no">
            <title>Confirm Order</title>
            <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
            <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
            <meta name="msapplication-TileColor" content="#00bcd4">
            <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
            <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
            <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
            <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
            <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
            <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
            <style>
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
                        <li class="collection-header"><h5>Place Order</h5></li>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM users WHERE id=$selec_rest AND not deleted;");
                        while($row = mysqli_fetch_array($result))
                        {
                            $restid = $selec_rest;
                            $res_name = $row['name'];
                        }

                        echo '<li class="collection-item avatar">
        <i class="mdi-content-content-paste red circle"></i>
        <p><strong>Name: </strong>'.$name.'</p>
		<p><strong>Contact Number: </strong>'.$contact.'</p>
		<p><strong>Address: </strong>'.$address.'</p>
        <p><strong>Restaurant: </strong>'.$res_name.'</p>
		<p><strong>Payment Type: </strong>'.htmlspecialchars($_POST['pay_type']).'</p>
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';

                        ?>

                        </li>

                        <li class="collection-item">

                            <?php
                            if(!empty($_SESSION["shopping_cart"]))
                            {
                                $total = 0;
                                foreach($_SESSION["shopping_cart"] as $keys => $values)
                                {
                                    echo '<li class="collection-item">
        <div class="row">
            <div class="col s8">
            <h6><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;font-size: 12px;">('.$values["item_quantity"].')</span> </h6>
                <p class="collections-title">'.$values["item_name"].'<br>';

                                    if (isset($values["item_variation"])) {
                                        echo ' 
                                                                <label>Flavor: </label><label>' . $values["item_variation"] . '</label><br>';
                                    }

                                    if (isset($values["item_variation_type"])) {
                                        echo '   
                                                                <label>Type: </label><label>' . $values["item_variation_type"] . '</label><br>';
                                    }

                                    if (isset($values["item_variation_side"])) {
                                        echo '  
                                                                <label>Side: </label><label>' . $values["item_variation_side"] . '</label><br>';
                                    }

                                    if (isset($values["item_variation_drink"])) {
                                        echo '  
                                                                <label>Drink: </label><label>' . $values["item_variation_drink"] . '</label><br>';
                                    }

                                    echo '</p>
            </div>
            <div class="col s4">
                <span>$'.number_format($values["item_price"]).' JMD</span>
            </div>
        </div>
    </li>';

                                    $total = ($total + ($values["item_quantity"] * $values["item_price"]));
                                    $service_fee = ($total/100) * 8;

                                }
                                $total = ($total + $fee) + $service_fee;

                            }

                            echo '<li class = "collection-item">
    <div class="row">
            <div class="col s6">
                <p class="collections-title">Service</p>
            </div>
            <div class="col s2">
                <label>8%</label>
            </div>
            <div class="col s4">
                <span>$'.number_format($service_fee).' JMD</span>
            </div>
        </div>
                </li>
                <li class = "collection-item">
    <div class="row">
            <div class="col s8">
                <p class="collections-title">Delivery</p>
            </div>
            <div class="col s4">
                <span>$'.number_format($fee).' JMD</span>
            </div>
        </div>
                </li>
                <li class="collection-item">
        <div class="row">
            <div class="col s8">
                <p class="collections-title"> Total</p>
            </div>
            <div class="col s4">
            
                <span><strong>$'.number_format($total).' JMD</strong></span>
            </div>
        </div>
    </li>';
                            ?>
                        </li>
                    </ul>
                </section>

                <section>
                    <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                        <li class="collection-item">
                            <?php
                            if(!empty($_POST['note']))
                                echo '<p><strong>Note: </strong>'.htmlspecialchars($_POST['note']).'</p>';
                            ?>
                        </li>
                    </ul>
                </section>

                <section>
                    <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                        <li class="collection-item">
                            <form action="routers/order-router.php" method="post">
                                <?php
                                foreach ($_POST as $key => $value)
                                {
                                    if(is_numeric($key)){
                                        echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
                                    }
                                }
                                ?>
                                <input type="hidden" name="pay_type" value="<?php echo $_POST['payment_type'];?>">
                                <input type="hidden" name="rest" value="<?php echo $restid;?>">
                                <input type="hidden" name="del_fee" value="<?php echo $fee;?>">
                                <input type="hidden" name="pay_type" value="<?php echo $_POST['pay_type'];?>">
                                <input type="hidden" name="address" value="<?php echo htmlspecialchars($_POST['address']);?>">
                                <?php if (isset($_POST['note'])) { echo'<input type="hidden" name="note" value="'.htmlspecialchars($_POST['note']).'">';}?>
                                <?php if($_POST['pay_type'] == 'Wallet') echo '<input type="hidden" name="balance" value="<?php echo ($balance-$total);?>">'; ?>
                                <input type="hidden" name="total" value="<?php echo $total;?>">
                                <input type="hidden" name="servicefee" value="<?php echo $service_fee;?>">
                                <div class="input-field col s12">
                                    <button id="confirm" class="btn cyan waves-effect waves-light" type="submit" name="action" <?php if($_POST['pay_type'] == 'Wallet') {if ($balance-$total < 0) {echo 'disabled'; }}?> style="width:100%;background-color: white;border: 1px solid antiquewhite;border-radius: 6px;font-size: 12px;"">Place Order<i class="mdi-action-shopping-cart right"></i></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </section>
                <section>
                    <ul class="collection with-header z-depth-0" style="border-top-right-radius: 8px;border-top-left-radius: 8px;">
                        <li class="collection-item">
                            <?php
                            echo '<div id="basic-collections" class="section">
		<div class="row">
			<div class="collection">
				<a href="#" class="collection-item">
					<div class="row"><div class="col s7">Wallet Balance</div><div class="col s3">$'.number_format($balance).'</div></div>
				</a>
				<a href="#" class="collection-item active">
					<div class="row"><div class="col s7">Balance after purchase</div><div class="col s3">$'.number_format($balance-$total).'</div></div>
				</a>
			</div>
		</div>
	</div>';
                            ?>
                        </li>
                    </ul>
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
        <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/plugins/angular.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins.min.js"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-153638148-1');
        </script>
        <script type="text/javascript" src="js/custom-script.js"></script>
        </body>
        </html>

        <?php
    }
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
