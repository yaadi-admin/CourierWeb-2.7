<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$continue=0;
$total = 0;
if($_SESSION['customer_sid']==session_id())
{
    $selec_rest = $_GET['id'];
    $restid = $_GET['id'];
    $res_name = '';
    $fee = 0;
    if($_POST['pay_type'] == 'Wallet'){
        $_POST['cc_number'] = str_replace('-', '', $_POST['cc_number']);
        $_POST['cc_number'] = str_replace(' ', '', $_POST['cc_number']);
        $_POST['cvv_number'] = (int)str_replace('-', '', $_POST['cvv_number']);
        $sql1 = mysqli_query($con, "SELECT * FROM wallet_details where wallet_id = $wallet_id");
        while($row1 = mysqli_fetch_array($sql1)){
            $card = $row1['number'];
            $cvv = $row1['cvv'];
            if($card == $_POST['cc_number'] && $cvv==$_POST['cvv_number'])
                $continue=1;
            else
                header("location:orders.php");
        }
    }
    else
        $continue=1;
}

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
    $name = $row['name'];
    $contact = $row['contact'];
}
if($_POST['distance'] <= 0.5 && $_POST['distance'] > 0.0){
    $fee = 349;
}
if($_POST['distance'] <= 1.0 && $_POST['distance'] > 0.5){
    $fee = 399;
}
else if($_POST['distance'] <= 1.5 && $_POST['distance'] > 1.0){
    $fee = 449;
}
else if($_POST['distance'] <= 2.0 && $_POST['distance'] >= 1.5){
    $fee = 499;
}
else if($_POST['distance'] <= 2.5 && $_POST['distance'] >= 2.0){
    $fee = 549;
}
else if($_POST['distance'] <= 3.0 && $_POST['distance'] >= 2.5){
    $fee = 599;
}
else if($_POST['distance'] <= 3.5 && $_POST['distance'] >= 3.0){
    $fee = 649;
}
else if($_POST['distance'] <= 4.0 && $_POST['distance'] >= 3.5){
    $fee = 699;
}
else if($_POST['distance'] <= 4.5 && $_POST['distance'] >= 4.0){
    $fee = 749;
}
else if($_POST['distance'] <= 5.0 && $_POST['distance'] >= 4.5){
    $fee = 799;
}
else if($_POST['distance'] <= 5.5 && $_POST['distance'] >= 5.0){
    $fee = 849;
}
else if($_POST['distance'] <= 6.0 && $_POST['distance'] >= 5.5){
    $fee = 899;
}
else if($_POST['distance'] <= 6.5 && $_POST['distance'] >= 6.0){
    $fee = 949;
}
else if($_POST['distance'] <= 7.0 && $_POST['distance'] >= 6.5){
    $fee = 999;
}
else if($_POST['distance'] <= 7.5 && $_POST['distance'] >= 7.0){
    $fee = 1049;
}
else if($_POST['distance'] <= 8.0 && $_POST['distance'] >= 7.5){
    $fee = 1099;
}
else if($_POST['distance'] <= 8.5 && $_POST['distance'] >= 8.0){
    $fee = 1149;
}
else if($_POST['distance'] <= 9.0 && $_POST['distance'] >= 8.5){
    $fee = 1199;
}
else if($_POST['distance'] <= 9.5 && $_POST['distance'] >= 9.0){
    $fee = 1249;
}
else if($_POST['distance'] <= 10.0 && $_POST['distance'] >= 9.5){
    $fee = 1299;
}
else if($_POST['distance'] <= 11.5 && $_POST['distance'] > 11.0){
    $fee = 1349;
}
else if($_POST['distance'] <= 12.0 && $_POST['distance'] >= 11.5){
    $fee = 1399;
}
else if($_POST['distance'] <= 12.5 && $_POST['distance'] >= 12.0){
    $fee = 1449;
}
else if($_POST['distance'] <= 13.0 && $_POST['distance'] >= 12.5){
    $fee = 1499;
}
else if($_POST['distance'] <= 13.5 && $_POST['distance'] >= 13.0){
    $fee = 1549;
}
else if($_POST['distance'] <= 14.0 && $_POST['distance'] >= 13.5){
    $fee = 1599;
}
else if($_POST['distance'] <= 14.5 && $_POST['distance'] >= 14.0){
    $fee = 1649;
}
else if($_POST['distance'] <= 15.0 && $_POST['distance'] >= 14.5){
    $fee = 1699;
}
else if($_POST['distance'] <= 15.5 && $_POST['distance'] >= 15.0){
    $fee = 1749;
}
else if($_POST['distance'] <= 16.0 && $_POST['distance'] >= 15.5){
    $fee = 1799;
}
else if($_POST['distance'] <= 16.5 && $_POST['distance'] >= 16.0){
    $fee = 1849;
}
else if($_POST['distance'] <= 17.0 && $_POST['distance'] >= 16.5){
    $fee = 1899;
}
else if($_POST['distance'] <= 17.5 && $_POST['distance'] >= 17.0){
    $fee = 1949;
}
else if($_POST['distance'] <= 18.0 && $_POST['distance'] >= 17.5){
    $fee = 1999;
}
else if($_POST['distance'] <= 18.5 && $_POST['distance'] >= 18.0){
    $fee = 2049;
}
else if($_POST['distance'] <= 19.0 && $_POST['distance'] >= 18.5){
    $fee = 2099;
}
else if($_POST['distance'] <= 19.5 && $_POST['distance'] >= 19.0){
    $fee = 2149;
}
else if($_POST['distance'] <= 20.0 && $_POST['distance'] >= 19.5){
    $fee = 2199;
}
else if($_POST['distance'] <= 20.5 && $_POST['distance'] >= 20.0){
    $fee = 2249;
}
else if($_POST['distance'] <= 21.0 && $_POST['distance'] >= 20.5){
    $fee = 2299;
}
else if($_POST['distance'] <= 21.5 && $_POST['distance'] >= 21.0){
    $fee = 2349;
}
else if($_POST['distance'] <= 22.0 && $_POST['distance'] >= 21.5){
    $fee = 2399;
}
else if($_POST['distance'] <= 23.5 && $_POST['distance'] >= 22.0){
    $fee = 2449;
}
else if($_POST['distance'] <= 23.0 && $_POST['distance'] >= 22.5){
    $fee = 2499;
}
else if($_POST['distance'] <= 23.5 && $_POST['distance'] >= 23.0){
    $fee = 2549;
}
else if($_POST['distance'] <= 24.0 && $_POST['distance'] >= 23.5){
    $fee = 2599;
}
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
                    <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Order Food</a>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="orders.php">All Orders</a>
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
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i> Tickets</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="tickets.php">All Tickets</a>
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
                    <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Account</a>
                    </li>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu" style="color: mediumaquamarine;"></i></a>
            </aside>
            <section id="content">
                <div id="breadcrumbs-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m12 l12" style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;border-radius: 16px;">
                                <h5 class="breadcrumbs-title" style="font-weight: 800;mso-bidi-font-style: oblique;color: #fff;width: 150px;background-color: #FFB03B;border-radius: 8px;text-align: center;">Confirm Order</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <p class="caption">Confirm order details</p>
                    <div class="divider"></div>
                    <div id="work-collections" class="section">
                        <div class="row">
                            <div>
                                <ul id="issues-collection" class="collection">
                                    <?php
                                    $result = mysqli_query($con, "SELECT * FROM users WHERE id=$selec_rest AND not deleted;");
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $restid = $selec_rest;
                                        $res_name = $row['name'];
                                    }
                                    echo '<li class="collection-item avatar">
        <i class="mdi-content-content-paste red circle"></i>
        <p><strong>Name:</strong>'.$name.'</p>
		<p><strong>Contact Number:</strong> '.$contact.'</p>
		<p><strong>Address:</strong> '.htmlspecialchars($_POST['address']).'</p>
        <p><strong>Restaurant:</strong> '.$res_name.'</p>
		<p><strong>Payment Type:</strong> '.htmlspecialchars($_POST['pay_type']).'</p>
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';

                                    if(!empty($_SESSION["shopping_cart"]))
                                    {
                                        $total = 0;
                                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                                        {
                                            echo '<li class="collection-item">
        <div class="row">
            <div class="col s8">
                <p class="collections-title"><strong><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;width: 20px;">('.$values["item_quantity"].')</span> </strong>'.$values["item_name"].', '.$values["item_variation"].'</p>
            </div>
            <div class="col s4">
                <span>$'.$values["item_price"].' JMD</span>
            </div>
        </div>
    </li>';

                                            $total = ($total + ($values["item_quantity"] * $values["item_price"]));

                                        }
                                        $total = $total + $fee;

                                    }

                                    echo '<li class = "collection-item">
    <div class="row">
            <div class="col s6">
                <p class="collections-title"><strong>™ </strong>Fee</p>
            </div>
            <div class="col s2">
                <span>Est.</span>
            </div>
            <div class="col s4">
                <span>$'.$fee.' JMD</span>
            </div>
        </div>
                </li>
                <li class="collection-item">
        <div class="row">
            <div class="col s8">
                <p class="collections-title"> Total</p>
            </div>
            <div class="col s4">
            
            
                <span><strong>$'.$total.' JMD</strong></span>
            </div>
        </div>
    </li>';
                                    if(!empty($_POST['note']))
                                        echo '<li class="collection-item avatar"><p><strong>Note: </strong>'.htmlspecialchars($_POST['note']).'</p></li>';
                                    if($_POST['pay_type'] == 'Cash' || $_POST['pay_type'] == 'Card')
                                        echo '<div id="basic-collections" class="section">
		<div class="row">
			<div class="collection">
				<a href="#" class="collection-item">
					<div class="row"><div class="col s7">Wallet Balance</div><div class="col s3">'.$balance.'</div></div>
				</a>
				<a href="#" class="collection-item active">
					<div class="row"><div class="col s7">Balance after purchase</div><div class="col s3">'.($balance-$total).'</div></div>
				</a>
			</div>
		</div>
	</div>';
                                    ?>
                                    <form action="routers/order-router.php?id=<?php echo $restid; ?>" method="post">
                                        <?php
                                        foreach ($_POST as $key => $value)
                                        {
                                            if(is_numeric($key)){
                                                echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
                                            }
                                        }
                                        ?>
                                        <input type="hidden" name="pay_type" value="<?php echo $_POST['payment_type'];?>">
                                        <input type="hidden" name="del_fee" value="<?php echo $fee;?>">
                                        <input type="hidden" name="pay_type" value="<?php echo $_POST['pay_type'];?>">
                                        <input type="hidden" name="address" value="<?php echo htmlspecialchars($_POST['address']);?>">
                                        <?php if (isset($_POST['note'])) { echo'<input type="hidden" name="note" value="'.htmlspecialchars($_POST['note']).'">';}?>
                                        <?php if($_POST['pay_type'] == 'Wallet') echo '<input type="hidden" name="balance" value="<?php echo ($balance-$total);?>">'; ?>
                                        <input type="hidden" name="total" value="<?php echo $total;?>">
                                        <div class="input-field col s12">
                                            <button id="confirm" class="btn cyan waves-effect waves-light right" type="submit" name="action" <?php if($_POST['pay_type'] == 'Wallet') {if ($balance-$total < 0) {echo 'disabled'; }}?> style="border-radius:16px;">Confirm Order</button>
                                        </div>
                                    </form>
                                </ul>
                            </div>
                        </div>
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
