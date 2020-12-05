<?php
include 'includes/connect.php';
if($_SESSION['admin_sid']==session_id())
{
    $id = "";
    $result = mysqli_query($con, "SELECT * FROM users WHERE name='$name';");
    while($row = mysqli_fetch_array($result))
    {
        $id = $row['id'];
    }
    $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
    $date->setTimezone(new DateTimeZone('America/Jamaica'));
    $timestamp = $date->format('Y-m-d H:i:sP');
    $url = $_SERVER['REQUEST_URI'];
    $action = "Viewed reports page";
    $sql = "INSERT INTO timeline (user_id, action, url, date) VALUES ('$id', '$action', '$url', '$timestamp')";
    $con->query($sql);

    $totalservice = 0;
    $totaldelivery = 0;
    $totalorders = 0;
    $cancelledbyadmin = 0;
    $cancelledbyadmintotal = 0;
    $cancelledbyadminservice = 0;
    $cancelled = 0;
    $cancelledtotal = 0;
    $cancelledservice = 0;
    $cancelledbycustomer = 0;
    $cancelledbycustomertotal = 0;
    $cancelledbycustomerservice = 0;
    $completed = 0;
    $completedtotal = 0;
    $profit_loss = 0;
    $completedservice = 0;
    $moneyin = 0;

//    costs
    $totalcost = 0;
    $costdomain = 11.99;
    $costdomainday = 11.99/365;
    $costhost = 19.99;
    $costhostday = (19.99 * 12) / 365;
    $costcust = 6 * 0.0511;
    $costrider = 3 * 0.0511;
    $costadm = 2 * 0.0511;
    $costadvert = 1;
    $totalcostbefore = $costdomainday + $costhostday + $costadvert;
    $totalcost = $costdomainday + $costhostday + $costcust + $costrider + $costadm + $costadvert;
    $totalcosttoorder = $costcust + $costrider + $costadm;



    $getmoneyin = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE 'Completed';");
    while($row = mysqli_fetch_array($getmoneyin))
    {
        $count = $row['total'];
        $counts = $row['service_fee'];
        $moneyin = $moneyin + $count;
        $totalservice = $totalservice + $counts;
        $totaldelivery = $totaldelivery + $row['fee'];

    }
    $getcomplt = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE 'Completed';");
    while($row = mysqli_fetch_array($getcomplt))
    {
        $count = $row['fee'];
        $counts = $row['service_fee'];
        $completed = $completed + $count;
        $completedservice = $completedservice + $counts;
        $completedtotal++;

    }

    $getcancel = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE 'Cancelled';");
    while($row = mysqli_fetch_array($getcancel))
    {
        $count = $row['fee'];
        $counts = $row['service_fee'];
        $cancelled = $cancelled + $count;
        $cancelledservice = $cancelledservice + $counts;
        $cancelledtotal++;
    }

    $getcanad = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE 'Cancelled by Admin';");
    while($row = mysqli_fetch_array($getcanad))
    {
        $count = $row['fee'];
        $counts = $row['service_fee'];
        $cancelledbyadmin = $cancelledbyadmin + $count;
        $cancelledbyadminservice = $cancelledbyadminservice + $counts;
        $cancelledbyadmintotal++;
    }

    $getcancus = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE 'Cancelled by Customer';");
    while($row = mysqli_fetch_array($getcancus))
    {
        $count = $row['fee'];
        $counts = $row['service_fee'];
        $cancelledbycustomer = $cancelledbycustomer + $count;
        $cancelledbycustomerservice = $cancelledbycustomerservice + $counts;
        $cancelledbycustomertotal++;
    }


    $profit_loss = $completed + $completedservice - ($cancelledbycustomer + $cancelledbycustomerservice + $cancelledbyadminservice + $cancelledservice + $cancelledbyadmin + $cancelled);
    $total = $profit_loss;
    $totalorders = ($cancelledbycustomertotal + $cancelledbyadmintotal + $cancelledtotal + $completedtotal);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Reports</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/search.bar.css" type="text/css" rel="stylesheet" media="screen,projection">
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
                    <ul>
                        <li><h1 class="logo-wrapper" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;"><a href="index.php" class="brand-logo darken-1" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;">Yaadi<span style="font-size: 12px;color: mediumspringgreen;"> Admissions</span></a></h1></li>
                    </ul>
                    <ul class="right">
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
                                <img src="images/avatar.jpg" alt="Ambassador Avatar" class="circle responsive-img valign profile-image" width="50px" height="50px">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="admin-account-page.php"><i class="mdi-social-person"></i>Account</a></li>
                                    <li><a href="routers/ad-logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
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
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>All Orders</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="all-orders.php">All Orders</a>
                                        </li>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
                                        while($row = mysqli_fetch_array($sql)){
                                            echo '<li><a href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>
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

            <div id="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </div>

            <section>
                <div class="container">

                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Order Report <span class="right"><?php echo number_format($totalorders); ?> <span style="font-size: 10px;">Orders</span></span></h4></li>
                        <li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title teal-text">Cost Structure</span>
                            <p>Domain(Yearly): $<?php echo number_format($costdomain, 2); ?> cents <span style="font-size:10px;">USD</span><br>
                                Hosting(Monthly): $<?php echo number_format($costhost, 2); ?> cents <span style="font-size:10px;">USD</span><br>
                                Text to Customer: $<?php echo number_format($costcust, 2); ?> cents <span style="font-size:10px;">USD</span><br>
                                Text to Rider(s): $<?php echo number_format($costrider, 2); ?> cents <span style="font-size:10px;">USD</span><br>
                                Text to Admin(s): $<?php echo number_format($costadm, 2); ?> cents <span style="font-size:10px;">USD</span><br>
                                Advertisements: $<?php echo number_format($costadvert, 2); ?> cents <span style="font-size:10px;">USD</span><br>
                                Per Order: $<?php echo number_format($totalcosttoorder, 2); ?> cents <span style="font-size:10px;">USD</span> | $<?php $totalcosttoorder = $totalcosttoorder * 144.17; echo number_format($totalcosttoorder, 2); ?> cents <span style="font-size:10px;">JMD</span><br>
                                Daily Cost: $<?php echo number_format($totalcostbefore, 2); ?> cents <span style="font-size:10px;">USD</span> | $<?php $totalcostbefore = $totalcostbefore * 145.17; echo number_format($totalcostbefore, 2); ?> cents <span style="font-size:10px;">JMD</span><br>
                                Total(daily): $<?php $totalcost = $totalcost * 145.17; echo number_format($totalcost, 2); ?> cents <span style="font-size:10px;">JMD</span><br>
                            </p>
                            <a href="#!" class="secondary-content black-text"><?php echo number_format(6); ?> <span style="font-size: 10px;">Items</span></a>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title teal-text">Revenue</span>
                            <p>Cash Flow: $<?php echo number_format($moneyin); ?><br>
                                Total Service Fee: $<?php echo number_format($totalservice); ?> <span style="font-size:10px;">JMD</span><br>
                                Total Delivery Fee: $<?php echo number_format($totaldelivery); ?> <span style="font-size:10px;">JMD</span><br>
                            </p>
                            <a href="#!" class="secondary-content black-text"><?php echo number_format($totalorders); ?> <span style="font-size: 10px;">Orders</span></a>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title teal-text">Completed Orders</span>
                            <p>Delivery: $<?php echo number_format($completed); ?> <span style="font-size:10px;">JMD</span><br>
                                Service: $<?php echo number_format($completedservice); ?> <span style="font-size:10px;">JMD</span>
                            </p>
                            <a href="#!" class="secondary-content black-text"><?php echo number_format($completedtotal); ?> <span style="font-size: 10px;">Orders</span></a>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title red-text">Cancelled by Customer</span>
                            <p>Delivery: $<?php echo number_format($cancelledbycustomer); ?> <span style="font-size:10px;">JMD</span><br>
                                Service: $<?php echo number_format($cancelledbycustomerservice); ?> <span style="font-size:10px;">JMD</span>
                            </p>
                            <a href="#!" class="secondary-content black-text"><?php echo number_format($cancelledbycustomertotal); ?> <span style="font-size: 10px;">Orders</span></a>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title red-text">Cancelled by Admin</span>
                            <p>Delivery: $<?php echo number_format($cancelledbyadmin); ?> <span style="font-size:10px;">JMD</span><br>
                                Service: $<?php echo number_format($cancelledbyadminservice); ?> <span style="font-size:10px;">JMD</span>
                            </p>
                            <a href="#!" class="secondary-content black-text"><?php echo number_format($cancelledbyadmintotal); ?> <span style="font-size: 10px;">Orders</span></a>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title red-text">Cancelled By Restaurant</span>
                            <p>Delivery: $<?php echo number_format($cancelled); ?> <span style="font-size:10px;">JMD</span><br>
                                Service: $<?php echo number_format($cancelledservice); ?> <span style="font-size:10px;">JMD</span>
                            </p>
                            <a href="#!" class="secondary-content black-text"><?php echo number_format($cancelledtotal); ?> <span style="font-size: 10px;">Orders</span></a>
                        </li>
                    </ul>

                </div>
            </section>
            <section>
                <div class="container">


                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Courier Report <span class="right"><?php echo number_format($totalorders); ?><span style="font-size: 10px;">Orders</span></span></h4></li>
                        <h6 class="center">Financial Distributions</h6>

                        <?php

                        $commission = 0;
                        $payout = 0;
                        $deliverytotal = 0;
                        $servicetotal = 0;
                        $totalcom = 0;

    $getords = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE 'Completed';");
    while($row = mysqli_fetch_array($getords))
    {
        $assignedto = $row['assignedto'];
        $counter = 0;
        $percentage_cut = .30;
        $percentage_cutr = .70;
        $count = $row['fee'];
        $counts = $row['service_fee'];
        $deliverytotal = $deliverytotal + $count;
        $servicetotal = $servicetotal + $counts;
        $commission = ($percentage_cut * $count) + $counts;
        $payout = ($percentage_cutr * $count);
        $totalcom = $commission + $totalcom;

        $getriders = mysqli_query($con, "SELECT * FROM users WHERE id LIKE $assignedto;");
        while($row1 = mysqli_fetch_array($getriders)) {
            echo '<li class="collection-item avatar">
                            <img src="images/yaadi-icon.png" alt="" class="circle">
                            <span class="title teal-text">'.$row1['name'].'</span>
                            <p>'.$row['date'].' <span class="right red-text">'.$row['pay_type'].'</span><br>
                            Delivery Collected: $'.number_format($row['fee']).' <span style="font-size:10px;">JMD</span><br>
                                Service Collected: $'.number_format($row['service_fee']).' <span style="font-size:10px;">JMD</span><br>
                               <span class="teal-text">Balance to ™Yaadi.co: $'.number_format($commission).' <span style="font-size:10px;">JMD</span></span><br>
                               <span class="red-text">Balance to Courier: $'.number_format($payout).' <span style="font-size:10px;">JMD</span></span>
                            </p>
                            <a href="#!" class="secondary-content black-text">Order #'.$row['id'].'</a>
                        </li>';


        }


    }
                        ?>


                    </ul>

                </div>
            </section>


        </div>
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
    <script>
        const body = document.querySelector('body');
        const searchBtn = document.querySelector('#search');
        const searchInput = document.querySelector('#search-input');
        let active = false;

        body.addEventListener('click', (e) => {
            if(e.target.id === 'search' || e.target.id === 'search-input' || e.target.id === 'search-icon') {
                if(!active) {
                    searchBtn.classList.add('active');
                    searchInput.classList.add('active');
                    active = true;
                }
            } else {
                searchBtn.classList.remove('active');
                searchInput.classList.remove('active');
                searchInput.value = '';
                active = false;
            }
        });</script>
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