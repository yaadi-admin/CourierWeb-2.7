<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$total = 0;
if($_SESSION['customer_sid']==session_id())
{
    $selec_rest = $_GET['pgid'];
    $restid = $_GET['pgid'];
    $res_name = '';
    $note_id = '';
    $long = "";
    $lat = "";
    $dist = "";

    $getlonglat = mysqli_query($con, "SELECT * FROM users where id = $restid");
    while($row = mysqli_fetch_array($getlonglat)){
        $long = $row['ulong'];
        $lat = $row['ulat'];
    }

    $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
    while($row = mysqli_fetch_array($result)){
        $name = $row['name'];
        $address = $row['address'];
        $contact = $row['contact'];
        $verified = $row['verified'];
    }

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
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Delivery Details</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo"></script>
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
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> My Orders</a>
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
                            <div class="col s12 m12 l12" style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;border-radius: 8px;border-top-left-radius: 0px;border-top-right-radius: 0px;">
                                <span style="background-color: mediumspringgreen;">
                                    <h5 class="breadcrumbs-title" style="font-weight: 800;mso-bidi-font-style: oblique;color: #fff;width: 200px;background-color: #FFB03B;border-radius: 8px;text-align: center;">Delivery Details</h5>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <ul class="right">
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion" style="border-radius:16px;">
                                <p style="font-size:12px; color:#b5796d;text-align:center;border-radius:16px;">Let us know exacly <br>what you want!</p>
                                <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="#note" style="border-radius:16px;"><i class="mdi-content-content-paste" style="font-size:20px;"></i>Add a note</a>

                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>

            </section>

            <section class="container">

                <div>
                    <p class="caption"><b>Select your choice of payment</b> & enter delivery address</p>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col s12 m4 l3">
                            <h4 class="header">Delivery Details</h4>
                        </div>
                        <div>

                            <div class="card-panel">
                                <div class="row">
                                    <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="confirm-order.php?id=<?php echo $restid ?>" novalidate="novalidate">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <label for="payment_type">Payment Type</label><br><br>
                                                <select id="pay_type" name="pay_type">
                                                    <option value="Select how you pay" <?php if(!$verified) echo 'disabled';?> selected>Select how you pay</option>
                                                    <option value="Cash" <?php if(!$verified) echo 'disabled';?>>Cash - You pay the rider in cash</option>
                                                    <option value="Card" <?php if(!$verified) echo 'disabled';?>>Card - You get a payment link via text</option>
                                                    <option value="Preorder" <?php if(!$verified) echo 'disabled';?> disabled>Pick-Up</option>
                                                    <option value="Dine-in" <?php if(!$verified) echo 'disabled';?> disabled>Dine-in</option>
                                                </select>
                                                <input name="distance" id="distance" for="distance" value="0.5" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="mdi-action-home prefix"></i>
                                                <textarea spellcheck="true" name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt1"><?php echo $address;?></textarea>
                                                <label for="address" class="">Address</label>
                                                <div class="errorTxt1"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" id="loc_lat" />
                                            <input type="hidden" id="loc_long" />
                                        </div>

                                        <!-- Display latitude and longitude -->
                                        <div class="latlong-view">
                                            <p><b>Latitude:</b> <span id="latitude_view"></span></p>
                                            <p><b>Longitude:</b> <span id="longitude_view"></span></p>
                                        </div>

                                        <div class="row">
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button id="confirm" class="btn cyan waves-effect waves-light right" type="submit" name="action" style="border-radius:8px;">Continue
                                                        <i class="mdi-content-send right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                        $result = mysqli_query($con, "SELECT * FROM items where restaurantid= $selec_rest AND not deleted;");
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $restid = $selec_rest;
                                        }

                                        foreach ($_POST as $key => $value)
                                        {
                                            if($key == 'action' || $value == ''){
                                                break;
                                            }
                                            echo '<input name="'.$key.'" type="hidden" value="'.$value.'">';
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>

                    </div>
                </div>

            </section>

            <section class="container">
                <div class="container">
                    <p class="caption">Estimated Receipt + Note</p>
                    <div class="divider"></div>
                    <div id="work-collections" class="section">
                        <div class="row">
                            <div>
                                <ul id="issues-collection" class="collection">
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
                                    $result = mysqli_query($con, "SELECT * FROM users where id= $user_id AND not deleted;");
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $phone = $row['contact'];
                                    }

                                    echo '<li class="collection-item avatar">
                                        <i class="mdi-content-content-paste red circle"></i>
                                        <p><strong>Name:</strong> '.$name.'</p>
                                        <p><strong>Contact Number:</strong> '.$phone.'</p>';
                                    ?>
                                    <?php
                                    echo'<a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';
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
                                                    <div class="col s8">
                                                        <p class="collections-title"><strong><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;width: 20px;">(<?php echo $values["item_quantity"];?>)</span></strong> <?php echo $values["item_name"]; ?>, <?php echo $values["item_variation"]; ?></p>
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
                                                <div class="col s7">
                                                    <p class="collections-title"> Sub-total</p>
                                                </div>
                                                <div class="col s4">
                                                    <span><strong>$<?php echo number_format($total); ?> JMD</strong></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="collection-item">
                                            <div class="row">
                                                <div class="col s7">
                                                </div>
                                                <form action="place-order.php?action=add&id=<?php echo $row["id"]; ?>&pgid=<?php echo $restid ?>" method="post">
                                                    <div class="input-field col s12">
                                                        <i class="mdi-editor-mode-edit prefix"></i>
                                                        <textarea spellcheck="true" id="note" name="note" class="materialize-textarea"></textarea>
                                                        <label for="note" class="">Note (optional)</label>
                                                    </div>
                                                    <div>
                                                        <div class="input-field col s12">
                                                            <button class="btn cyan waves-effect waves-light" type="submit" name="action" style="border-radius:8px;"> Add Note
                                                                <i class="mdi-content-send right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div></li>

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty($_POST['note']))
                                        echo '<li class="collection-item avatar"><p><strong>Note: </strong>'.htmlspecialchars($_POST['note']).'</p></li>';
                                    ?>
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
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                address: {
                    required: true,
                    minlength: 5
                },
                cc_number: {
                    required: false,
                    minlength: 16,
                    maxlength: 16,
                },
                cvv_number: {
                    required: false,
                    minlength: 3,
                },
            },
            messages: {
                address:{
                    required: "Enter a address",
                    minlength: "Enter at least 5 characters"
                },
                cc_number:{
                    required: "Please provide card number",
                    minlength: "Enter at least 16 digits",
                    maxlength: "Enter a maximum of 16 digits",
                },
                cvv_number:{
                    required: "Please provide CVV number",
                    minlength: "Enter at least 3 digits",
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
        $('#cc_number').formatter({
            'pattern': '{{9999}}-{{9999}}-{{9999}}-{{9999}}',
            'persistent': true
        });
        $('#cvv_number').formatter({
            'pattern': '{{9}}-{{9}}-{{9}}',
            'persistent': true
        });
        $("#cc_number").prop('disabled', true);
        $("#cvv_number").prop('disabled',true);
        $("#confirm").prop('disabled', true);
        $('#payment_type').change(function() {
            if ($(this).val() === 'Mandeville') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled',true);
            }
        });
        $('#pay_type').change(function() {
            if ($(this).val() === 'Select how you pay') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled',true);
                $("#confirm").prop('disabled', true);
            }
            if ($(this).val() === 'Cash') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }
            if ($(this).val() === 'Card') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);
                $("#confirm").prop('disabled', false);
            }

        });
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