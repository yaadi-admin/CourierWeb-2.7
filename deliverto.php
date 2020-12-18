<?php
include 'includes/connect.php';
include 'includes/wallet.php';
//include 'includes/location.php';
if($_SESSION['customer_sid']==session_id())
{
    $usr_address = '';
    $useraddress = mysqli_query($con, "SELECT * FROM users WHERE name= '$name'");
    while($row = mysqli_fetch_array($useraddress))
    {
        $usr_address = $row['address'];
    }
    $counter = 0;
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Delivering To</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo"></script>

        <script>
            var searchInput = 'addaddress';

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
            }
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
                        <label class="center" style="font-size: 10px;color: #a21318;font-weight: 600;"><b>DELIVERING TO </b></label>
                        <li class="left"><a href="deliverto.php" class="brand-logo darken-1" style="font-size: 12px;color: black;"><?php echo $usr_address; ?></a></li>
                    </ul>
                </div>

            </nav>

        </div>
    </header>

    <div id="main">
        <div class="wrapper">
            <section class="section">
                <div class="row">
                    <form class="formValidate col s12 m12 l6" id="formValidate" novalidate="novalidate">
                    <div class="input-field col s12">
                        <i class="mdi-communication-location-on prefix" style="color: #a21318;font-size: 48px;"></i>
                        <textarea spellcheck="true" name="addaddress" placeholder="Street Name, Road or Address" id="addaddress" class="materialize-textarea validate" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;"></textarea>
                        <label for="address" class="">Deliver to</label>
                        <div class="errorTxt1"></div>
                    </div>
                        <button id="set_address" class="btn modal-close waves-effect waves-green btn-flat col s12" type="submit" style="background-color: white;border-radius: 8px;font-size: 12px">Set New Address
                        <i class="mdi-communication-location-on right" style="font-size: 20px;color: #a21318;"></i>
                        </button>
                    </form>
                </div>
                <?php
                if($usr_address !== '' && isset($usr_address)){
                ?>
                <div class="row">
                <h5 class="center">OR</h5>
                    <a class="btn modal-close waves-effect waves-green btn-flat col s12" href="index.php" style="background-color: white;border-radius: 8px;font-size: 12px">Continue with current address
                        <i class="mdi-navigation-arrow-forward right" style="font-size: 20px;color: #a21318;"></i>
                    </a>
</div>
<?php
                }
 ?>
                <span id="message"></span>
            </section>
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
            $(document).ready(function () {
                setlocate();
            })
            function setlocate() {
                $(document).on('click', "#set_address", function (e) {
                    e.preventDefault();
                    var address = $('#addaddress').val();

                    if (address === ''){
                    Materialize.toast('You need to enter an address', 4000);
                    }
                    else {
                        $.ajax({
                            url: '../routers/add-missing.php',
                            method: 'post',
                            data:{addaddress:address},
                            success: function (data) {
                                $('#message').html(data);

                            }
                        })
                    }
                })
            }
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
    if($_SESSION['restaurant_sid']==session_id())
    {
        header("location:restaurant.php");
    }
    if($_SESSION['delivery_sid']==session_id())
    {
        header("location:delivery-dashboard.php");
    }
    else{
        header("location:login.php");
    }
}
?>