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
                    <ul class="left">
                        <li><h1 class="logo-wrapper" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;"><a href="index.php" class="brand-logo darken-1" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;">Yaadi</a><span class="logo-text">Logo</span></h1></li>
                    </ul>
                    <ul class="right">
                        <li class="right"><h1><a href="#addanitem"><span style="font-size: 32px;">+</span></a></h1></li>
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
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
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

                    <li class="bold"><a href="#." class="waves-effect waves-cyan"><i class="mdi-social-person"></i>Reports <span class="badge" data-badge-caption="Beta 1!"><h6 style="font-size:10px;">Coming Soon</h6></span></a>
                    </li>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>
            <section id="content">
                <div id="breadcrumbs-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m12 l12" style="background: url(images/user-bg.jpg) repeat fixed;border-radius: 16px;border-top-left-radius: 0px;border-top-right-radius: 0px;">
                                <h5 class="breadcrumbs-title" style="font-weight: 800;mso-bidi-font-style: oblique;color: #fff;width: 150px;background-color: #FFB03B;border-radius: 8px;text-align: center;"><?php echo $name; ?></h5>
                            </div>
                        </div>
                    </div>

                    <ul class="right navbar-fixed" style="border-radius:16px;">
                        <li class="no-padding" style="border-radius:16px;">
                            <ul class="collapsible collapsible-accordion" style="border-radius:16px;">
                                <li class="bold" style="border-radius:16px;"><a class="collapsible-header waves-effect waves-cyan" style="border-radius:16px;"><i class="mdi-action-shopping-cart" style="font-size:20px;"></i>New Orders ( <?php echo $counter;?> )</a>
                                    <div class="collapsible-body" style="border-radius:16px;">
                                        <ul id="issues-collection" class="collection" style="border-radius:16px;">
                                            <?php
                                            $result = mysqli_query($con, "SELECT * FROM users where id= $user_id AND not deleted;");
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                $res_name = $row['name'];
                                                $phone = $row["contact"];

                                                echo '<li class="collection-item avatar">
                        <i class="mdi-content-content-paste red circle"></i>
                        <p><strong>Business: </strong>'.$name.'</p>
                        <p>You have <strong> ( '.$counter.' ) </strong>new orders.</p>
                        <a class="btn" id="gotoorders" href="all-r-orders.php?status=Yet%20to%20be%20delivered" style="border-radius: 8px;" disabled="tue">View New Orders</a>
                        <a href="#." class="secondary-content"><i class="mdi-action-grade"></i></a>';
                                            }
                                            ?>
                                            <?php
                                            echo '<p> </p>
                                        
';
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul><br />

                </div>
        </div>
        <div class="container">
            <p class="caption">
            <blockquote>
                <b>Notice(s)</b>
                <blockquote style="border-radius:16px;">Welcome, </blockquote>
            </blockquote>
            </p>

            <blockquote><p class="caption"><b style="font-family: Bangers, cursive;font-size: 18px;">Yaadi.co</b> | <b>Anywhere,</b> Anytime, <b>Online<b style="font-family: Bangers, cursive;font-size: 18px;">!</b></b></p></blockquote>
            <div class="divider"></div>

            <div class="row">
                <div class="col s12 m4 l3">
                    <h4 class="header" style="font-weight: 800;">Menu</h4>
                </div>
                <div>
                    <table id="data-table-admin" class="display" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="10%">Name</th>
                            <th width="90%">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM items where restaurantid = $user_id");
                        while($row = mysqli_fetch_array($result))
                        {
                            if ($row['deleted'] == "0"){
                                $text1 = 'selected';
                                $text2 = '';
                            }
                            if ($row['deleted'] == "1"){
                                $text1 = '';
                                $text2 = 'selected';
                            }

                            if ($row['category'] == "0"){
                                $cat1 = "Selected";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";
                            }
                            else if ($row['category'] == "1"){
                                $cat1 = "";
                                $cat2 = "Selected";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "2"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "Selected";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "3"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "Selected";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "4"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "Selected";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "5"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "Selected";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "6"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "Selected";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "7"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "Selected";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "8"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "Selected";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "9"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "Selected";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "10"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "Selected";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "11"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "Selected";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "12"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "Selected";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "13"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "Selected";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "14"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "Selected";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "15"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "Selected";
                                $cat17 = "";
                                $cat18 = "";                    }
                            else if ($row['category'] == "16"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "Selected";
                                $cat18 = "";                    }
                            else if ($row['category'] == "17"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "Selected";
                            }
                            else if ($row['category'] == "18"){
                                $cat1 = "";
                                $cat2 = "";
                                $cat3 = "";
                                $cat4 = "";
                                $cat5 = "";
                                $cat6 = "";
                                $cat7 = "";
                                $cat8 = "";
                                $cat9 = "";
                                $cat10 = "";
                                $cat11 = "";
                                $cat12 = "";
                                $cat13 = "";
                                $cat14 = "";
                                $cat15 = "";
                                $cat16 = "";
                                $cat17 = "";
                                $cat18 = "";
                                $cat19 = "Selected";
                            }

                            echo '<tr id="'.$row['id'].'">
                    
                    <td>
                    <img class="col s12" src="'.$row["img_addr"].'" width="100%" alt="Item Image" height="200px" style="object-fit: scale-down;" style="border-radius:8px;">
                    <div>
                    <form action="routers/upload.php?id='.$row["id"].'&resname='.$name.'" method="post" enctype="multipart/form-data">
                              <input type="file" name="fileToUpload" id="fileToUpload" style="content: \'Select some files\';display: inline-block;background: antiquewhite;border: 1px solid #999;border-radius: 3px;padding: 5px 8px;outline: none;white-space: nowrap;-webkit-user-select: none;cursor: pointer;text-shadow: 1px 1px #fff;font-weight: 700;font-size: 10pt;">
                              <button class="btn-flat waves-effect waves-light teal-text right" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;" type="submit" value="Upload Image" name="submit">Set image<i class="mdi-content-send right"></i></button>
                            </form>
                            </div>

                    <div class="row">
                    <br >
                     <form class="formValidate" id="formValidate" method="post" action="routers/hide_show.php?item_id='.$row['id'].'" novalidate="novalidate">
                    <select class="col s12" name="hide_show" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <option value="0"'.(!$row['deleted'] ? 'selected' : '').'>Available</option>
                     <option value="1"'.($row['deleted'] ? 'selected' : '').'>Not Available</option>
                    </select>';

                            if ($user_id == "331"){
                                echo '<div class="row">
                    <select class="col s12" name = "category">
                      <option value = "0" '.$cat1.'>Start the day </option >
                      <option value = "1" '.$cat2.'>Lunch & Beyond </option >
                      <option value = "2" '.$cat3.'>Subs</option >
                      <option value = "3" '.$cat4.'>Wraps</option >
                      <option value = "4" '.$cat5.'>Chinese Fare </option >
                      <option value = "5" '.$cat6.'>Jamaican Fare </option >
                      <option value = "6" '.$cat7.'>Roti</option >
                      <option value = "7" '.$cat8.'>Soups</option >
                      <option value = "8" '.$cat9.'>Appetizers</option >
                      <option value = "9" '.$cat10.'>Salads</option >
                      <option value = "10" '.$cat11.'>Seafood</option >
                      <option value = "11" '.$cat12.'>Poultry</option >
                      <option value = "12" '.$cat13.'>From the Grill </option >
                      <option value = "13" '.$cat14.'>Vegetarian</option >
                      <option value = "14" '.$cat15.'>Pasta Fusion </option >
                      <option value = "15" '.$cat16.'>Eat, Meet, Sip, Talk </option >
                      <option value = "16" '.$cat17.'>Sides</option >
                      <option value = "17" '.$cat18.'>Mothers Day Special </option >
                      <option value = "18" '.$cat19.'>Fathers Day Special </option >
                    </select >
                     </div>';
                            }

                            else if ($user_id == "430") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Salads</option>
                      <option value="1" '.$cat2.'>Platters</option>
                      <option value="2" '.$cat3.'>Burgers</option>
                      <option value="3" '.$cat4.'>Wraps & Quesadillas</option>
                      <option value="4" '.$cat5.'>Pastas</option>
                      <option value="5" '.$cat6.'>Vegetarian</option>
                      <option value="6" '.$cat7.'>Lunch Specials</option>
                    <option value="7" '.$cat8.'>Deserts</option>
                    <option value="8" '.$cat9.'>Main Courses</option>
                    <option value="9" '.$cat10.'>Mix Drinks</option>
                    <option value="10" '.$cat11.'>Side Order</option>
                    <option value="11" '.$cat12.'>Starters</option>
                    <option value="12"'.$cat13.'>Specials</option>
                    </select>';
                            }

                            else if ($user_id == "80") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Amazin 4</option>
                      <option value="1" '.$cat2.'>Wings</option>
                      <option value="2" '.$cat3.'>Sides</option>
                      <option value="3" '.$cat4.'>Beverages</option>
                      <option value="4" '.$cat5.'>Desserts</option>
                      <option value="5" '.$cat6.'>Pasta</option>
                      <option value="6" '.$cat7.'>Hut Combos</option>
                    </select>';
                            }

                            else if ($user_id == "57") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Patties</option>
                      <option value="1" '.$cat2.'>Chicken</option>
                      <option value="2" '.$cat3.'>Burgers</option>
                      <option value="3" '.$cat4.'>Breakfast Sandwiches</option>
                      <option value="4" '.$cat5.'>Breakfast Meals</option>
                      <option value="5" '.$cat6.'>Sandwiches</option>
                      <option value="6" '.$cat7.'>Beverages</option>
                      <option value="7" '.$cat8.'>Soups</option>
                      <option value = "8" '.$cat9.'>Ice Cream</option>
                      <option value = "9" '.$cat10.'>Pastry</option>
                    </select>';
                            }

                            else if ($user_id == "79") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Specialty Pizza</option>
                      <option value="1" '.$cat2.'>Chicken</option>
                      <option value="2" '.$cat3.'>Sides</option>
                      <option value="3" '.$cat4.'>Drinks</option>
                      <option value="4" '.$cat5.'>Desserts</option>
                    </select>';
                            }

                            else if ($user_id == "486") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Breakfast</option>
                      <option value="1" '.$cat2.'>Lunch</option>
                      <option value="2" '.$cat3.'>Dinner</option>
                      <option value="3" '.$cat4.'>Dessert</option>
                      <option value="4" '.$cat5.'>Sides</option>
                      <option value="5" '.$cat6.'>Soup of the day</option>
                    </select>';
                            }
                            else if ($user_id == "8") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Chicken</option>
                      <option value="1" '.$cat2.'>Fish</option>
                      <option value="2" '.$cat3.'>Sides</option>
                      <option value="3" '.$cat4.'>Served With</option>
                      <option value="4" '.$cat5.'>Meat</option>
                      <option value="5" '.$cat6.'>Beverages</option>
                      <option value="6" '.$cat7.'>Done to Order</option>
                      <option value="7" '.$cat8.'>Pastries</option>
                    </select>';
                            }
                            else if ($user_id == "540") {
                                echo '<select class="col s12" name="category">
                      <option value="0" '.$cat1.'>Appetizers</option>
                      <option value="1" '.$cat2.'>Soup of day</option>
                      <option value="2" '.$cat3.'>Entrees</option>
                      <option value="3" '.$cat4.'>Steak</option>
                      <option value="4" '.$cat5.'>Seafood</option>
                      <option value="5" '.$cat6.'>Chicken</option>
                      <option value="6" '.$cat7.'>Side Order</option>
                      <option value="7" '.$cat8.'>Sauces</option>
                      <option value="8" '.$cat8.'>Desserts</option>
                      <option value="9" '.$cat8.'>Beverages</option>
                    </select>';
                            }
                            else if ($user_id == "259") {
                                echo '<select class="col s12" name="category">
                        <option value="0" '.$cat1.'>Lunch Box Meals</option>
                      <option value="1" '.$cat2.'>Fat 2 Fit Salads</option>
                      <option value="2" '.$cat3.'>Lunch Box Specials</option>
                      <option value="3" '.$cat4.'>Soups & Appetizers</option>
                      <option value="4" '.$cat5.'>Chicken Dishes</option>
                      <option value="5" '.$cat6.'>Chop Suey (Veg.)</option>
                      <option value="6" '.$cat7.'>Tofu Dishes</option>
                      <option value="7" '.$cat8.'>Pork Dishes</option>
                      <option value="8" '.$cat9.'>Noodle Dishes</option>
                      <option value="9" '.$cat10.'>Seafood Dishes</option>
                      <option value="10" '.$cat11.'>Fried Rice</option>
                      <option value="11" '.$cat12.'>Drinks</option>
                    </select>';
                            }
                            else if ($user_id == "591") {
                                echo '<select class="col s12" name="category">
                        <option value="0" '.$cat1.'>Omelets</option>
                      <option value="1" '.$cat2.'>Salads</option>
                      <option value="2" '.$cat3.'>Specialty Burgers</option>
                      <option value="3" '.$cat4.'>Pancakes & Waffles</option>
                      <option value="4" '.$cat5.'>Parfaits / Muesli</option>
                      <option value="5" '.$cat6.'>Wraps</option>
                      <option value="6" '.$cat7.'>Tacos / Nachos</option>
                      <option value="7" '.$cat8.'>Gyros</option>
                    </select>';
                            }

                            echo'<button class="btn-flat waves-effect waves-light teal-text right" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;" type="submit" value="Change" name="submithide">Change Status <i class="mdi-content-send right"></i></button>
                    </form>
                    </div>
                            <form class="formValidate" id="formValidate" method="post" action="routers/menu-router-restaurant.php?editid='.$row['id'].'" novalidate="novalidate">
                        <div class="input-field col s12">';

                            echo '</td>';

                            echo'<td>
                            
                    <input value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt'.$row["id"].'"></div><div class="input-field col s12"><label for="'.$row["id"].'_price">Price</label>
                    <input value="'.$row["price"].'" id="'.$row["id"].'_price" name="'.$row['id'].'_price" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt'.$row["id"].'"></div>

                    <div class="input-field col s12"><label for="'.$row["id"].'_description">Description</label>
                    <textarea value="'.$row["description"].'" placeholder="'.$row["description"].'" id="'.$row["id"].'_description" name="'.$row['id'].'_description" type="text" data-error=".errorTxt'.$row["id"]. '" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;border-left: 0px solid antiquewhite;border-right: 0px solid antiquewhite;border-top: 0px solid antiquewhite;width: 100%;height: 80px;">' .$row["description"].'</textarea><div class="errorTxt'.$row["id"].'"></div>
                    
                    </div>
                    
                    <div><table>
                    <thead>
                    <th width="60%">Type</th>
                    <th width="40%">Price</th>
                    </thead>
                    <tbody>
                    
                    <tr><td><input placeholder="Add a Variation" value="'.$row["type1"].'" id="'.$row["id"].'_type1" name="'.$row['id'].'_type1" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    <td><input placeholder="Variation Price" value="'.$row["first"].'" id="'.$row["id"].'_first" name="'.$row['id'].'_first" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    </tr>
                    
                    <tr><td><input placeholder="Add a Variation" value="'.$row["type2"].'" id="'.$row["id"].'_type2" name="'.$row['id'].'_type2" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    <td><input placeholder="Variation Price" value="'.$row["second"].'" id="'.$row["id"].'_second" name="'.$row['id'].'_second" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    </tr>
                    
                    <tr><td><input placeholder="Add a Variation" value="'.$row["type3"].'" id="'.$row["id"].'_type3" name="'.$row['id'].'_type3" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    <td><input placeholder="Variation Price" value="'.$row["third"].'" id="'.$row["id"].'_third" name="'.$row['id'].'_third" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    </tr>
                    
                    <tr><td><input placeholder="Add a Variation" value="'.$row["type4"].'" id="'.$row["id"].'_type4" name="'.$row['id'].'_type4" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    <td><input placeholder="Variation Price" value="'.$row["fourth"].'" id="'.$row["id"].'_fourth" name="'.$row['id'].'_fourth" type="text" data-error=".errorTxt'.$row["id"].'" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                    <div class="errorTxt'.$row["id"].'"></div></td>
                    </tr>
                    
                    </tbody>
                    </table>
                    </div>
                    
                    
                    
                    <div class="input-field col s12" id="updatediv">
                              <button class="btn-flat waves-effect waves-light teal-text right" type="submit" name="action" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">Update
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
                    </td>
                    
                    </form>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <form class="formValidate" id="formValidate1" method="post" action="routers/add-item.php" novalidate="novalidate">
                <div class="row" id="addanitem">
                    <div class="col s12 m4 l3">
                        <h4 class="header">Add</h4>
                    </div>
                    <div>
                        <table>
                            <thead>
                            <tr>
                                <th data-field="id">Name</th>
                                <th data-field="name">Details</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php

                            echo '<tr><td><div class="input-field col s12"><label for="name">Name</label>';
                            echo '<input id="name" name="name" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';
                            echo '<td><div class="input-field col s12 "><label for="price" class="">Price</label>';
                            echo '<input id="price" name="price" type="text" data-error=".errorTxt02"><div class="errorTxt02"></div></td>';
                            echo '<td></tr>';
                            echo '<td>';
                            if($user_id == "331"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Start the day</option>
                      <option value="1">Lunch & Beyond</option>
                      <option value="2">Subs</option>
                      <option value="3">Wraps</option>
                      <option value="4">Chinese Fare</option>
                      <option value="5">Jamaican Fare</option>
                      <option value="6">Roti</option>
                      <option value="7">Soups</option>
                      <option value="8">Appetizers</option>
                      <option value="9">Salads</option>
                      <option value="10">Seafood</option>
                      <option value="11">Poultry</option>
                      <option value="12">From the Grill</option>
                      <option value="13">Vegetarian</option>
                      <option value="14">Pasta Fusion</option>
                      <option value="15">Eat, Meet, Sip, Talk</option>
                      <option value="16">Sides</option>
                      <option value = "17"> Mothers Day Special </option >
                      <option value = "18"> Fathers Day Special </option >
                    </select></td>';

                            }
                            else if($user_id == "430"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Salads</option>
                      <option value="1">Platters</option>
                      <option value="2">Burgers</option>
                      <option value="3">Wraps & Quesadillas</option>
                      <option value="4">Pastas</option>
                      <option value="5">Vegetarian</option>
                      <option value="6">Lunch Specials</option>
                    <option value="7">Deserts</option>
                    <option value="8">Main Courses</option>
                    <option value="9">Mix Drinks</option>
                    <option value="10">Side Orders</option>
                    <option value="11">Starters</option>
                    <option value="12">Specials</option>
                    </select></td>';

                            }
                            else if($user_id == "80"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Amazin 4</option>
                      <option value="1">Wings</option>
                      <option value="2">Sides</option>
                      <option value="3">Beverages</option>
                      <option value="4">Desserts</option>
                      <option value="5">Pasta</option>
                      <option value="6">Hut Combos</option>
                    </select></td>';

                            }
                            else if($user_id == "57"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Patties</option>
                      <option value="1">Chicken</option>
                      <option value="2">Burgers</option>
                      <option value="3">Breakfast Sandwiches</option>
                      <option value="4">Breakfast Meals</option>
                      <option value="5">Sandwiches</option>
                      <option value="6">Beverages</option>
                      <option value="7">Soups</option>
                      <option value = "8">Ice Cream</option>
                      <option value = "9">Pastry</option>
                    </select></td>';

                            }
                            else if($user_id == "79"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Specialty Pizza</option>
                      <option value="1">Chicken</option>
                      <option value="2">Sides</option>
                      <option value="3">Drinks</option>
                      <option value="4">Desserts</option>
                    </select></td>';

                            }
                            else if($user_id == "486"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Breakfast</option>
                      <option value="1">Lunch</option>
                      <option value="2">Dinner</option>
                      <option value="3">Dessert</option>
                      <option value="4">Sides</option>
                      <option value="5">Soup of the day</option>
                    </select></td>';

                            }
                            else if($user_id == "8"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Chicken</option>
                      <option value="1">Fish</option>
                      <option value="2">Sides</option>
                      <option value="3">Served With</option>
                      <option value="4">Meat</option>
                      <option value="5">Beverages</option>
                      <option value="6">Done to Order</option>
                      <option value="7">Pastries</option>
                    </select></td>';

                            }
                            else if($user_id == "540"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Appetizers</option>
                      <option value="1">Soup of day</option>
                      <option value="2">Entrees</option>
                      <option value="3">Steak</option>
                      <option value="4">Seafood</option>
                      <option value="5">Chicken</option>
                      <option value="6">Side Order</option>
                      <option value="7">Sauces</option>
                      <option value="8">Desserts</option>
                      <option value="9">Beverages</option>
                    </select></td>';

                            }
                            else if($user_id == "259"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Lunch Box Meals</option>
                      <option value="1">Fat 2 Fit Salads</option>
                      <option value="2">Lunch Box Specials</option>
                      <option value="3">Soups & Appetizers</option>
                      <option value="4">Chicken Dishes</option>
                      <option value="5">Chop Suey (Veg.)</option>
                      <option value="6">Tofu Dishes</option>
                      <option value="7">Pork Dishes</option>
                      <option value="8">Noodle Dishes</option>
                      <option value="9">Seafood Dishes</option>
                      <option value="10">Fried Rice</option>
                      <option value="11">Drinks</option>
                    </select></td>';

                            }
                            else if($user_id == "591"){
                                echo '<select class="col s12" name="category">
                      <option value="0">Omelets</option>
                      <option value="1">Salads</option>
                      <option value="2">Specialty Burgers</option>
                      <option value="3">Pancakes & Waffles</option>
                      <option value="4">Parfaits / Muesli</option>
                      <option value="5">Wraps</option>
                      <option value="6">Tacos / Nachos</option>
                      <option value="7">Gyros</option>
                    </select></td>';

                            }

                            else {
                                echo '<td>';
                                echo '<select class="col s12" name="category">
                      <option value="0">Grains</option>
                      <option value="1">Entrees</option>
                      <option value="2">Sides</option>
                      <option value="3">Beverages</option>
                    </select></td>';
                                echo '<td>';
                            }
                            echo '<tr><td><div class="input-field col s12"><label for="description">Description</label>';
                            echo '<input id="description" name="description" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';
                            echo '<td></tr>';
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action" style="border-radius: 8px;">Add
                            <i class="mdi-content-send right"></i>
                        </button>
                    </div>
                </div>
                <div class="divider"></div>
        </div>
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