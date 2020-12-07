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
else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>Register</title>
        <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
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

            @media screen and (max-width: 481px) {

                #menu, #subnav {
                    float: left;
                    padding: 0;
                    width: 94%;
                    margin: 3%;
                }

                #subnav dt{
                    padding: 0;
                    margin-top: 0;
                }

                #logo{
                    font-size: 45px;
                }

                #menu {
                    text-align: center;
                    padding: 0;
                }

                #menu li {
                    display: inline-block;
                    margin: 1.25% .5% 1.25% .5%;
                    border-left: 0;
                    padding: 1%;
                    border: 1px solid white;
                }

                #menu li a {
                    color: white;
                    text-decoration: none;
                }

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
            #logoimg{
                width: 150px;
                height: 10%x;
                object-position: center;
                object-fit: cover;
            }
        </style>
    </head>

    <body style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;">
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel" style="border: 2px solid #a0381b;border-radius: 8px;">
            <form class="formValidate" id="formValidate" method="post" novalidate="novalidate">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="teal-text" style="font-weight: 800;">Create Account</h4>
                        <img id="logoimg" src="images/yaadi-icon.png">
                        <br>
                        <h6 class="text-black bold" style="font-size: 12px;font-weight: 800;"><span class="teal-text">Create an account, </span>it's free & always will be</h6>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-account-box prefix" style="color: #a0381b;"></i>
                        <input name="name" id="name" type="text" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-top-left: 1px solid white;border-top-right: 1px solid white;border-bottom: 1px solid black;">
                        <label for="name" class="center-align">Full name</label>
                        <div class="errorTxt1"></div>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-perm-phone-msg prefix" style="color: #a0381b;"></i>
                        <input name="phone" id="phone" type="number" data-error=".errorTxt2" style="border-bottom-right-radius: 8px;border-top-left: 1px solid white;border-top-right: 1px solid white;border-bottom: 1px solid black;">
                        <label for="phone">Phone</label>
                        <div class="errorTxt2"></div>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-communication-email prefix" style="color: #a0381b;"></i>
                        <input name="email" id="email" type="email" data-error=".errorTxt3" style="border-bottom-right-radius: 8px;border-top-left: 1px solid white;border-top-right: 1px solid white;border-bottom: 1px solid black;">
                        <label for="email">Email</label>
                        <div class="errorTxt3"></div>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-hardware-security prefix" style="color: #a0381b;"></i>
                        <input name="password" id="password" type="password" data-error=".errorTxt4" style="border-bottom-right-radius: 8px;border-top-left: 1px solid white;border-top-right: 1px solid white;border-bottom: 1px solid black;">
                        <label for="password">Password</label>
                        <div class="errorTxt4"></div>
                    </div>
                </div>
                <div class="row">
                    <p class="margin center medium-small sign-up" style="font-size: 10px">Signing up, automatically agrees to our <a href="tercon.php" target="_blank">Terms & Conditions</a></p>
                    <div style="height:5px;"></div>
                    <p class="col s12">
                        <button value="submit" class="icon ion-md-lock btn waves-effect waves-light center col s12" id="registerbtn" onclick="document.getElementById('formValidate').check();" type="submit" style="color: white;font-family: Open Sans, ;font-family: Akronim;font-size:18px;border-radius: 8px;" name="action">Create Account</button>
                    </p>
                    <div class="row">
                        <div class="segment">
                            <div class="btn-group">
                                <p class="margin center medium-small sign-up" style="font-size:12px;color:black;"><label>Already have an account?</label><a class="left" href="login.php" style="font-size:15px;color:#a0381b;"><button class="unit" type="button" style="border: 3px solid #a0381b;color: #a0381b;"><i class="mdi-action-verified-user prefix"></i></button></a></p>
                                <div class="divider"></div>
                                <p class="center-align"><label id="message"></label></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            RegisterUser();
        })

        $("#formValidate").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 10,
                },
                email: {
                    required: true,
                    minlength: 5,
                    maxlength: 32,
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 11

                },

            },
            messages: {
                name: {
                    required: "Enter your name",
                    minlength: "Minimum of 5 characters."
                },
                password: {
                    required: "Enter a Password",
                    minlength: "Minimum 5 characters are required.",
                    maxlength: "Maximum 10 Characters allowed"
                },
                email: {
                    required: "Enter your email",
                    minlength: "Minimum 5 characters are required.",
                    maxlength: "Maximum 32 Characters allowed"
                },
                phone:{
                    required: "Specify contact number +1 876XXXXXXX.",
                    minlength: "Minimum 10 digits are required.",
                    maxlength: "Maximum 11 digits are allowed"
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

        function RegisterUser() {
            $(document).on('click', "#registerbtn", function (e) {
                e.preventDefault();
                var name = $('#name').val();
                var password = $('#password').val();
                var phone = $('#phone').val();
                var email = $('#email').val();

                if (password === '' || phone === '' || email === '' || name === ''){
                    Materialize.toast('Fields are empty', 8000);
                }
                else {
                    $.ajax({
                        url: '../routers/register-router.php',
                        method: 'post',
                        data:{phone:phone,name:name,email:email,password:password},
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
    </body>
    </html>
    <?php
}
?>