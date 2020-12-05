<?php
session_start();
if(isset($_SESSION['restaurant_sid']))
{
    header("location:restaurant.php");
}
else if(isset($_SESSION['customer_sid']))
{
    header("location:index.php");
}
else if(isset($_SESSION['admin_sid']))
{
    header("location:admin.php");
}
else if(isset($_SESSION['delivery_sid']))
{
    header("location:delivery-dashboard.php");
}
else{
    $usernameErr = $passwordErr = "";
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="Live faster with fast delivery and superior service.">
        <meta name="keywords" content="restaurants near me,food near me,places to eat near me,mexican restaurants,italian restaurants,steakhouse,diner,restaurants nearby,food places near me,seafood restaurants,vegan restaurants,breakfast restaurants,restaurant games,lunch near me,best restaurants near me,nearby restaurants,diners near me,restaurants near me now,places to eat,seafood restaurants near me,food around me,steakhouse near me,restaurant week,restaurants near my location,greek restaurant">
        <meta name="author" content="Copyright © 2019 Yaadi.co All Rights Reserved">
        <title>Welcome to Yaadi.co</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/log.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style type="text/css">
            .input-field div.error{
                position: relative;
                top: -1rem;
                left: 0rem;
                font-size: 0.8rem;
                color:#b5796d;
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
            .left-alert textarea.materialize-textarea + label:after{
                left:0px;
            }
            .right-alert input[type=text] + label:after,
            .right-alert input[type=password] + label:after,
            .right-alert textarea.materialize-textarea + label:after{
                right:70px;
            }
            .segment {
                text-align: center;
            }
            button, input {
                border: 0;
                outline: 0;
                font-size: 16px;
                border-radius: 320px;
                padding: 16px;
                background-color: #EBECF0;
                text-shadow: 1px 1px 0 #FFF;
            }
            button {
                color: #61677C;
                font-weight: bold;
                box-shadow: -5px -5px 20px #FFF, 5px 5px 20px #BABECC;
                transition: all 0.2s ease-in-out;
                cursor: pointer;
                font-weight: 600;
            }
            button:hover {
                box-shadow: -2px -2px 5px #FFF, 2px 2px 5px #BABECC;
            }
            button, a:active {
                box-shadow: inset 1px 1px 2px #BABECC, inset -1px -1px 2px #FFF;
                color: #b5796d;
                background-color: white;
            }
            button .icon {
                margin-right: 8px;
            }
            button.unit {
                border-radius: 32px;
                line-height: 0;
                width: 48px;
                height: 48px;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                margin: 0 8px;
                font-size: 19.2px;
            }
            button.unit .icon {
                margin-right: 0;
            }
            button.colorr {
                display: block;
                width: 100%;
                color: #b5796d;
            }

            .snowflake {
                color: #fff;
                font-size: 1em;
                font-family: Arial;
                text-shadow: 0 0 1px #000;
            }

            @-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%{-webkit-transform:translateX(0px);transform:translateX(0px)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}100%{-webkit-transform:translateX(0px);transform:translateX(0px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%{transform:translateX(0px)}50%{transform:translateX(80px)}100%{transform:translateX(0px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s}
            /* Demo Purpose Only*/
            .demo {
                font-family: 'Raleway', sans-serif;
                color:#fff;
                display: block;
                margin: 0 auto;
                padding: 15px 0;
                text-align: center;
            }
            .demo a{
                font-family: 'Raleway', sans-serif;
                color: #000;
            }

        </style>
    </head>
    <body style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;">
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
    </div>
    <div id="login-page" class="row z-depth-0"">

    <div class="col s12 z-depth-3 card-panel" style="border: 2px solid #a0381b;border-radius: 8px;">
        <form class="formValidate  login-form" id="formValidate" novalidate="novalidate">
            <div class="row"><i style="font-size:18px;">🇯🇲</i> <span class="" style="font-size: 4px;color:#b5796d;"></span>
                <div class="input-field col s12 center">
              <span class="badge" data-badge-caption="custom caption" style="color: antiquewhite;border: .5px solid white;
  font-weight: bold;box-shadow: -2px -2px 10px #FFF, 2.5px 2.5px 10px white;transition: all 0.2s ease-in-out;cursor: pointer;font-weight: 600;border-radius: 8px;line-height: 0;width: 80px;height: 40px;display: inline-flex;color: #b5796d;justify-content: center;align-items: center;margin: 0 8px;font-size: 15.2px;font-family: Open Sans, ;font-family: Akronim;border-bottom: 5px solid #b5796d;border-bottom-right-radius: 40px;border-top-right-radius: 120px;border-bottom-left-radius: 40px;border-top-left-radius: 120px;border-top-left: 2px solid #b5796d;border-top: 2px solid #b5796d;"><span>#</span>foodie</span>
                    <img id="logoimg" src="images/yaadi-icon.png" width="auto" height="100px" style="object-position: center;object-fit: scale-down;zoom: 180%;">
                    <p class="center login-form-text" style="font-family: Raleway, sans-serif;font-size:18px;color:#b5796d;"></p><span class="badge" data-badge-caption="custom caption"><h6 id="version" style="font-size:12px;font-family: Open Sans, ;font-family: Akronim;color: #a0381b;">Version .23</h6></span>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-perm-phone-msg prefix" style="color: #a0381b;"></i>
                    <input name="contact" id="contact" type="tel" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-top-left: 5px solid white;border-top-right: 5px solid white;border-bottom: 1px solid black;">
                    <label for="contact" class="center-align"  style="font-size:12px;">Phone number</label>
                    <div class="errorTxt1"></div>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <span<a><i class="mdi-hardware-security prefix" style="color: #a0381b;"></i></a></span>
                    <input name="password" id="password" type="password" data-error=".errorTxt2" style="border-bottom-right-radius: 8px;border-top-left: 5px solid white;border-top-right: 5px solid white;border-bottom: 1px solid black;">
                    <label for="password" style="font-size:12px;">Password</label>
                    <div class="errorTxt2"></div>
                </div>
            </div>
            <div class="row col s12">
                <button id="loginbtn" value="submit" class="icon ion-md-lock btn-flat color waves-effect waves-light center col s12" type="submit" style="color: white;font-family: Open Sans, ;font-family: Akronim;font-size:20px;border: 1px solid #a0381b;border-radius: 8px;background-color: #a0381b;" name="action">Login</button><br><br>
                <div class="btn-group">
                    <p class="margin center medium-small sign-up" style="font-size:12px;color:black;"><a class="left" href="register.php" style="font-size:15px;color:#a0381b;"><button class="unit" type="button" style="border: 3px solid #a0381b;color: #a0381b;"><i class="mdi-social-person-add prefix"></i></button></a> <a class="right" href="for_pw.php" style="font-size:15px;color:#a0381b;"><button class="unit" type="button" style="border: 3px solid #a0381b;color: #a0381b;"><i class="mdi-action-lock-open prefix"></i></button></a></p>
                    <div style="height:10px;"></div>
                    <p class="medium-small center-align" style="font-size:12px;color:black;background-color: white;"><span class="left">Sign up</span> <span class="right">Reset</span></p><br>
                    <div class="divider"></div>
                    <img src="images/we-accept-credit-cards.png" width="100%" height="30px;" style="object-fit: scale-down;">
                    <p class="center-align"><label id="message"></label></p>
                </div>
            </div>
        </form>
    </div>
    <p id="howwework" class="medium-small center" style="font-size:10px;height: 2px;">See how we work >> <span style="border-radius: 8px;"><a href="yaadiltd.php" style="font-size:10px;color: #a0381b;"> <b>GO YAADI</b></a></span></p>
    </div>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153638148-1"></script>
    <script type="text/javascript">
    $(document).ready(function () {
                LoginUser();
            })

        $("#formValidate").validate({
            rules: {
                contact: {
                    required: true,
                    minlength: 10,
                    maxlength: 11
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 10
                }
            },
            messages: {
                contact: {
                    required: "Enter your contact number",
                    minlength: "Minimum 10 digits are required.",
                    maxlength: "Maximum 11 digits are allowed"
                },
                password: {
                    required: "Enter Password",
                    minlength: "Minimum 5 characters are required.",
                    maxlength: "Maximum 10 characters allowed.",
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

         function LoginUser() {
                    $(document).on('click', "#loginbtn", function (e) {
                        e.preventDefault();
                        var phone = $('#contact').val();
                        var password = $('#password').val();

                        if (password == "" || phone == ""){
                            $('#modaltop').html('<h5>All fields are not filled</h5>');
                        }
                        else {
                            $.ajax({
                                url: '../routers/router.php',
                                method: 'post',
                                data:{contact:phone,password:password},
                                success: function (data) {
                                    $('#message').html(data);

                                }
                            })
                        }
                    })
                }

        var scrollSpeed = 100;
        var current = 0;
        var direction = 'h';
        function bgscroll() {
            current -= 1;
            $('body').css("backgroundPosition", (direction == 'h') ? current + "px 0" : "0 " + current + "px");
        }
        setInterval("bgscroll()", scrollSpeed);
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-153638148-1');
    </script>
    </body>
    </html>
    <?php
}
?>