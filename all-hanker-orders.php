<?php
include 'includes/connect.php';
if($_SESSION['admin_sid']==session_id())
{
    $id = "";
    $cus = "";
    $result = mysqli_query($con, "SELECT * FROM users WHERE name='$name';");
    while($row = mysqli_fetch_array($result))
    {
        $id = $row['id'];
    }
    $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
    $date->setTimezone(new DateTimeZone('America/Jamaica'));
    $timestamp = $date->format('Y-m-d H:i:sP');
    $url = $_SERVER['REQUEST_URI'];
    $action = "Viewed Hanker Orders";
    $sql = "INSERT INTO timeline (user_id, action, url, date) VALUES ('$id', '$action', '$url', '$timestamp')";
    $con->query($sql);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title><?php

            if (isset($_GET['status'])){
                echo $_GET["status"];
            }
            else{
               echo "Hanker Orders";
            }?></title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <ul class="left">
                        <li><h1 class="logo-wrapper" style="font-family: 'Open Sans';font-family: 'Akronim';font-size:42px;"><a href="admin.php" class="brand-logo darken-1" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;">Yaadi<span style="font-size: 12px;color: mediumspringgreen;"> Admissions</span></a></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div id="main">
        <div class="wrapper">
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftnavset" style="border-top-right-radius: 8px;">
                    <li class="user-details teal lighten-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="admin-account-page.php"><i class="mdi-social-person"></i>Account</a></li>
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
                    <li class="bold"><a href="admin.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Dashboard</a>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan active"><i class="mdi-editor-insert-invitation"></i> All Orders</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li class="<?php
                                        if(!isset($_GET['status'])){
                                            echo 'active';
                                        }?>
									"><a href="all-orders.php">All Orders</a>
                                        </li>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
                                        while($row = mysqli_fetch_array($sql)){
                                            if(isset($_GET['status'])){
                                                $status = $row['status'];
                                            }
                                            echo '<li class='.(isset($_GET['status'])?($status == $_GET['status'] ? 'active' : ''): '').'><a href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>
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
                                        <li><a href="all-tickets.php">All Tickets</a>
                                        </li>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets;");
                                        while($row = mysqli_fetch_array($sql)){
                                            echo '<li><a href="all-tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="bold"><a href="am_active.php" class="waves-effect waves-cyan"><i class="mdi-action-book"></i>My Activity</a>
                    </li>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>

            <section id="content">
                <div class="row">
                </div>
                <div class="container">
                    <p class="caption"><?php
                        $orderstat = mysqli_query($con, "SELECT DISTINCT admission FROM incumbency WHERE id=2;");
                        while($row = mysqli_fetch_array($orderstat)) {

                            if ($row['admission'] == 0) {
                                echo '<p class="caption">Ordering <a href="all-orders.php"><span class="badge green new" style="font-size: 1px;"><span style="font-size: 12px;"><i class="mdi-action-check-circle" style="color: white;"></i> ENABLED</span></span></a></p>';
                            } else if ($row['admission'] != 0) {
                                echo '<p class="caption">Ordering <a href="all-orders.php"><span class="badge red new" style="font-size: 1px;"><span style="font-size: 12px;"><i class="mdi-action-exit-to-app" style="color: white;"></i> DISABLED</span></span></a></p>';
                            }
                        }
                        ?></p>
                    <div id="work-collections" class="section">
                        <?php
                        if(isset($_GET['status'])){
                            $status = $_GET['status'];
                        }
                        else{
                            $status = '%';
                        }
                        $sql = mysqli_query($con, "SELECT * FROM hanker_orders WHERE status LIKE '$status';");
                        echo '<div class="row">
                <div>
                    <ul id="issues-collection" class="collection">';
                        while($row = mysqli_fetch_array($sql))
                        {
                            $filler = $row['assignedto'];
                            $fillername = "Not yet filled";

                            $getname = mysqli_query($con, "SELECT * FROM users WHERE id = $filler;");
                            while($row5 = mysqli_fetch_array($getname))
                            {
                                $fillername = $row5['name'];
                            }

                            $status = $row['status'];
                            $deleted = $row['deleted'];
                            echo '<li class="collection-item avatar" id="'.$row['id'].'">
                              <i class="mdi-content-content-paste red circle"></i>';

                            if ($status === 'Cancelled by Customer'){
                                echo '<span class="collection-header">Order No. <span style="font-size: 20px;">'.$row['id'].'</span></span>
                            <span class="right"><form method="post" action="routers/reopen-order.php">
                            <input type="hidden" value="0" name="reopen">
                            <input type="hidden" value="'.$row['id'].'" name="itemid">
                            <button class="btn-flat waves-effect waves-light" type="submit" name="submit" style="color: #a21318;">Reopen</button>    
                            </form></span>
                            </span>';
                            }
                            else{
                                echo '<span class="collection-header">Order No. <span style="font-size: 20px;">'.$row['id'].'</span></span>';
                            }

                            $cus = $row['contact'];
                            echo'
                              <p><strong>Date:</strong> '.$row['date'].'</p>
                              <p><strong>Filled By:</strong> '.$fillername.'</p>
                              <p><strong>Payment Type:</strong> '.$row['payment_type'].'</p>							  
							  <p><strong>Status:</strong> '.($deleted ? $status : '
							  <form method="post" action="routers/update-hanker.php">
							  <input type="hidden" id="cos" value="'.$row['contact'].'" name="cos">
							    <input type="hidden" id="itemid" value="'.$row['id'].'" name="id">
								<select name="status">
								<option value="Yet to be delivered" '.($status=='Yet to be delivered' ? 'selected' : '').'>Yet to be delivered</option>
								<option value="Cancelled by Admin" '.($status=='Cancelled by Admin' ? 'selected' : '').'>Cancelled by Admin</option>
								<option value="Paused" '.($status=='Paused' ? 'selected' : '').'>Paused</option>
								<option value="Preparing" '.($status=='Preparing' ? 'selected' : '').'>Preparing</option>
								<option value="Out For Delivery" '.($status=='Out For Delivery' ? 'selected' : '').'>Out For Delivery</option>
                                <option value="Arrived" '.($status=='Arrived' ? 'selected' : '').'>Arrived</option>
                                <option value="Completed" '.($status=='Completed' ? 'selected' : '').'>Completed</option>
								</select>
							  ').'</p>
                              <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>';
                            $order_id = $row['id'];
                            $phone = "";
                            $sql1 = mysqli_query($con, "SELECT * FROM hanker_details WHERE order_id = $order_id;");

                                $phone = $row['contact'];
                                echo '<li class="collection-item">
                            <div class="row">
							<p><strong>Name: </strong>'.$row['customer'].'</p>
							<p><strong>Address: </strong>'.$row['address'].'</p>
							'.($row['contact'] == '' ? '' : '<p><strong>Contact: </strong>'.$row['contact'].'</p>').'	
							'.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'								
                            </li>';

                            while($row1 = mysqli_fetch_array($sql1))
                            {
                                $item_id = $row1['item_id'];
                                $sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
                                while($row2 = mysqli_fetch_array($sql2))

                                    $item_name = $row2['name'];
                                echo '<li class="collection-item">
                            <div class="row">
                            <div class="col s1">
                            <span style="background-color: mediumaquamarine;border-radius: 8px;color: black;">('.$row1['quantity'].')</span>
                            </div>
                            <div class="col s5">
                            <p class="collections-title">'.$item_name.'</p>';
                                if (isset($row1["variation"]) && $row1["variation"] !== '') {
                                    echo ' 
                                                                <label>Flavor: </label><label>'.$row1["variation"].'</label><br>';
                                }

                                if (isset($row1["variation_type"]) && $row1["variation_type"] !== ''){
                                    echo '   
                                                                <label>Type: </label><label>'.$row1["variation_type"].'</label><br>';
                                }

                                if (isset($row1["variation_side"]) && $row1["variation_side"] !== ''){
                                    echo '  
                                                                <label>Side: </label><label>'.$row1["variation_side"].'</label><br>';
                                }

                                if (isset($row1["variation_drink"]) && $row1["variation_drink"] !== '') {
                                    echo '  
                                                                <label>Drink: </label><label>'.$row1["variation_drink"].'</label><br>';
                                }

                                echo'
                                </div>
                                <div class="col s3">
                            <label>'.$row1['restaurant'].'</label>
                            </div>
                            <div class="col s3">
                            <span>$'.number_format($row1['price']).' <span style="font-size: 6px;">JMD</span></span>
                            </div>
                            </div>
                            </li>';
                            }
                            echo'<li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title">Service Fee</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span>$'.number_format($row['service_fee']).' <span style="font-size: 6px;">JMD</span></span>
                                            </div></li>
                                            
                                            <li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title">Delivery Fee</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span>$'.number_format($row['fee']).' <span style="font-size: 6px;">JMD</span></span>
                                            </div></li>
                                            
                                            <li class="collection-item">
                                        <div class="row">
                                            <div class="col s9">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col s3">
                                                <span><strong style="font-size: 16px;">$'.number_format($row['total']).' <span style="font-size: 6px;">JMD</span></strong></span>
                                            </div>';
                            if(!$deleted){

                                echo '<br><br><button class="waves-effect waves-green btn z-depth-1" type="submit" name="action" style="border-radius:10px;width: 100%;background-color: #a21318;color: white;">Update Order #'.$order_id.'
                                              <i class="mdi-action-thumbs-up-down right"></i> 
										</button>
										</form>
										
										<div class="row col s12"><form class="formValidate" id="formValidate1" method="post" novalidate="novalidate">
                              <textarea class="materialize-textarea" type="text" id="custommsg" name="custommsg" placeholder="Enter custom message..." style="color: black; border-bottom: 1.5px solid antiquewhite;border-radius: 0px;height: 40px;"></textarea>
                              <input type="hidden" id="phoneto" name="phoneto" value="'.$phone.'">
                              <input type="hidden" id="orderid" name="orderid" value="'.$order_id.'">
                    <button class="waves-effect waves-green btn z-depth-1" type="submit" id="sendmessage" name="action" style="border-radius: 8px;width: 100%;background-color: mediumaquamarine;color: white;">Send Message
                    <i class="mdi-communication-message right"></i>
                              </button></form></div>';
                            }
                            echo'</div></li>';
                        }

                        echo '</ul>
                </div>';
                        ?>

                    </div>
                </div>
                <span id="message"></span>
            </section>
        </div>
    </div>


    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2019 <a class="grey-text text-lighten-4" href="#" target="_blank">Yaadi® Ltd</a> All rights reserved.</span>
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#">The Ambassadors</a></span>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script>
        $(document).ready(function () {
            messge();
        })
        function messge() {
            $(document).on('click', "#sendmessage", function (e) {
                e.preventDefault();
                var cus = $('#phoneto').val();
                var order = $('#orderid').val();
                var msg = $('#custommsg').val();

                if (msg === '' || order === '' || cus === ''){
                    Materialize.toast('You need to enter a message', 8000);
                }
                else {
                    $.ajax({
                        url: '../routers/disc_03.php',
                        method: 'post',
                        data:{phoneto:cus,orderid:order,custommsg:msg},
                        success: function (data) {
                            $('#message').html(data);

                        }
                    })
                }
            })
        }
    </script>
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
    if($_SESSION['customer_id']==session_id())
    {
        header("location:orders.php");
    }
    else{
        header("location:login.php");
    }
}
?>