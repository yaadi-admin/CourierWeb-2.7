<?php
include 'includes/connect.php';
if($_SESSION['delivery_sid']==session_id())
{
    $user_id = $_SESSION['user_id'];
    $id = "";
    $pro_pic = "";
    $result = mysqli_query($con, "SELECT * FROM users WHERE name='$name';");
    while($row = mysqli_fetch_array($result))
    {
        $id = $row['id'];
        $pro_pic = $row['image_dir'];
    }
    $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
    $date->setTimezone(new DateTimeZone('America/Jamaica'));
    $timestamp = $date->format('Y-m-d H:i:sP');
    $url = $_SERVER['REQUEST_URI'];
    $action = "Viewed Active Orders Page";
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
        <title>Active Orders</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
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
                        <li><h1 class="logo-wrapper" style="font-size:42px;"><a href="delivery-dashboard.php" class="brand-logo darken-1" style="font-size:40px;font-family: 'Open Sans', ;font-family: 'Akronim';">Yaadi<span style="font-size: 16px;color: mediumspringgreen;"> Delivery</span></a><span class="logo-text">Logo</span></h1></li>
                    </ul>

                    <ul class="right">
                        <li><a href="delivery-new.php">
                                <?php

                                $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND assignedto LIKE '0' ");
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
                            </a></li>
                        <li><a href="delivery-dashboard.php"><i class="mdi-navigation-refresh"></i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div id="main">
        <div class="wrapper">
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftnavset">
                    <li class="user-details cyan darken-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <img src="<?php echo $pro_pic; ?>" alt="Avatar" class="circle responsive-img valign profile-image" width="50px" height="50px">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="delivery-account.php"><i class="mdi-social-person"></i>Account</a></li>
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
                    <li class="active bold"><a href="delivery-dashboard.php" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert"></i> Active Orders</a>
                    </li>
                    <li class="bold"><a href="delivery-new.php" class="waves-effect waves-cyan"><i class="mdi-action-shopping-basket"></i> New Orders
                            <?php

                            $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND assignedto LIKE '0' ");
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
                    </li>
                    <li class="bold"><a href="delivery-history.php" class="waves-effect waves-cyan"><i class="mdi-action-book"></i>History</a>
                    </li>
                    <li class="bold"><a href="delivery-finance.php" class="waves-effect waves-cyan"><i class="mdi-editor-attach-money"></i>Finance</a>
                    </li>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>
            <section id="content">
                <div id="breadcrumbs-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <h5 class="breadcrumbs-title"><span style="background-color: mediumaquamarine;color: black;border-radius: 16px;">(<?php

                                        $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing' OR status LIKE 'Preparing' OR status LIKE 'Preparing') AND assignedto LIKE '$user_id'");
                                        $count = 0;
                                        $total = 0;
                                        while($row = mysqli_fetch_array($getamount)) {
                                            $count++;
                                            $total = 0;
                                            $total+=$count;
                                        }
                                        if ($total == 0){
                                            echo $total;
                                        }
                                        else{
                                            echo $total;
                                        }


                                        ?>)</span> <span style="font-size: 15px;">Active order(s) </span> <span class="right" style="font-size: 10px;"><?php echo date('l jS \of F Y'); ?></span></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <p class="caption">
                    <div id="work-collections" class="section">

                        <?php
                        if(isset($_GET['status'])){
                            $status = $_GET['status'];
                            $re_id = $_GET['restaurantid'];
                        }
                        else{
                            $status = '%';
                        }

                        $sql = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing' OR status LIKE 'Ready For Pick-Up' OR status LIKE 'Out For Delivery' OR status LIKE 'Arrived') AND assignedto LIKE '$user_id'");
                        echo '<div class="row">
                <div>
                    <ul id="issues-collection" class="collection">';

                        $count = 0;

                        while($row = mysqli_fetch_array($sql))
                        {
                            $count++;

                            if ($count > 0){
                                $fee = $row['fee'];

                                $status = $row['status'];
                                $deleted = $row['deleted'];
                                echo '<li class="collection-item avatar">
                              <i class="mdi-content-content-paste red circle"></i>
                              <span class="collection-header">Order No. <span style="font-size: 20px;color: #A82128;">'.$row['id'].'</span></span>
                              <p><strong>Date:</strong> '.$row['date'].'</p>
                              <p><strong>Paying with:</strong> '.$row['pay_type'].'</p>							  
							  <p><strong>Status:</strong> '.($deleted ? $status : '
                              
							  <form method="post" action="routers/edit-del-order.php">
							    <input type="hidden" value="'.$row['id'].'" name="id">
								<select class="browser-default" name="status">
								<option value="Preparing" '.($status=='Preparing' ? 'selected' : '').'>Preparing</option>
								<option value="Out For Delivery" '.($status=='Out For Delivery' ? 'selected' : '').'>Out For Delivery</option>
                                <option value="Arrived" '.($status=='Arrived' ? 'selected' : '').'>Arrived</option>
                                <option value="Completed" '.($status=='Completed' ? 'selected' : '').'>Completed</option>
                                <option value="Yet to be delivered" '.($status=='Yet to be delivered' ? 'selected' : '').' disabled>Yet to be delivered</option>
                                <option value="Cancelled by Admin" '.($status=='Cancelled by Admin' ? 'selected' : '').' disabled>Cancelled by Admin</option>
                                <option value="Ready For Pick-Up" '.($status=='Ready For Pick-Up' ? 'selected' : '').' disabled>Ready For Pick-Up</option>
                                <option value="Cancelled" '.($status=='Cancelled' ? 'selected' : '').' disabled>Cancelled</option>
								</select>
							  ').'</p>
                              <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>';
                                $order_id = $row['id'];
                                $customer_id = $row['customer_id'];
                                $sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
                                $sql3 = mysqli_query($con, "SELECT * FROM users WHERE id = $customer_id;");
                                while($row3 = mysqli_fetch_array($sql3))
                                {
                                    $cus = $customer_id;
                                    echo '<li class="collection-item">
                            <div class="row">
							<p><strong>Name: </strong>'.$row3['name'].'</p>
							<p><strong>Address: </strong>'.$row['address'].'</p>
							'.($row3['contact'] == '' ? '' : '<p><strong>Contact: </strong>'.$row3['contact'].'</p>').'			
							'.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'								
                            </li>';
                                }
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
                                    if (isset($row1["variation"])) {
                                        echo ' 
                                                                <label>Flavor: </label><label>'.$row1["variation"].'</label><br>';
                                    }

                                    if (isset($row1["variation_type"])){
                                        echo '   
                                                                <label>Type: </label><label>'.$row1["variation_type"].'</label><br>';
                                    }

                                    if (isset($row1["variation_side"])){
                                        echo '  
                                                                <label>Side: </label><label>'.$row1["variation_side"].'</label><br>';
                                    }

                                    if (isset($row1["variation_drink"])) {
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

                                    echo '<br><br>
                                    <button class="waves-effect waves-green btn-flat right" type="submit" name="action" style="border-radius:10px;border: 1px solid maroon;">Update Order #'.$order_id.'
                                              <i class="mdi-action-thumbs-up-down right"></i> 
										</button>
										</form>';
                                }
                                echo'</div></li>';
                            }
                            else if ($count < 1){
                                echo "<span>No active orders</span>";
                            }


                        }

                        if ($count == 0){
                            echo '<h5 class="center">No active orders</h5>';
                        }





                        echo '</ul>
                </div>';
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer id="footershow" class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="#." target="_blank">Yaadi.Co</a> All rights reserved.</span>
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#.">The Ambassadors</a></span>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js">
        $("#formValidate").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                },
                password: {
                    required: true,
                    minlength: 5,
                },
                name: {
                    required: true,
                    minlength: 5,
                },
                contact: {
                    required: true,
                    minlength: 4,
                },
                address: {
                    minlength: 10,
                },
                balance: {
                    required: true,
                },
            },
            messages: {
                username:{
                    required: "Enter a username",
                    minlength: "Enter at least 5 characters"
                },
                password:{
                    required: "Provide a prove",
                    minlength: "Password must be atleast 5 characters long",
                },
                name:{
                    required: "Please provide CVV number",
                    minlength: "Enter at least 5 characters",
                },
                contact:{
                    required: "Please provide card number",
                    minlength: "Enter at least 4 digits",
                },
                address:{
                    minlength: "Address must be atleast 10 characters long",
                },
                balance:{
                    required: "Please provide a balance.",
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