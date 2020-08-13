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
    setcookie("YAADI-CHKZ", "Is That A Cookie", time() + 3600, '/');
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
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
}
button .icon {
  margin-right: 8px;
}
button.unit {
  border-radius: 8px;
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

</style>
<?php
$counter;
if(count($_COOKIE) > 0) {
setcookie("YAADI-CHEKZ", "Is That A Cookie", time() + 3600, '/');
} else {
    $counter = 0;
}
?>
</head>
<body style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;">
  <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
   <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel" style="border: 2px solid mediumaquamarine;border-radius: 8px;">
    <form class="formValidate  login-form" id="formValidate" method="post" action="routers/router.php" novalidate="novalidate">
        <div class="row"><i style="font-size:18px;">🇯🇲</i> <span class="" style="font-size: 4px;color:#b5796d;"></span>
          <div class="input-field col s12 center">
              <span class="badge" data-badge-caption="custom caption" style="color: antiquewhite;border: .5px solid white;
  font-weight: bold;box-shadow: -2px -2px 10px #FFF, 2.5px 2.5px 10px #BABECC;transition: all 0.2s ease-in-out;cursor: pointer;font-weight: 600;border-radius: 8px;line-height: 0;width: 80px;height: 40px;display: inline-flex;color: #b5796d;justify-content: center;align-items: center;margin: 0 8px;font-size: 15.2px;font-family: Open Sans, ;font-family: Akronim;border-bottom: 5px solid #b5796d;border-bottom-right-radius: 40px;border-top-right-radius: 40px;border-bottom-left-radius: 40px;border-top-left-radius: 40px;"><span>#</span>yaadi.co</span>
              <img id="logoimg" src="images/yaadi-icon.png" width="200px" height="150px" style="object-position: center;object-fit: scale-down;">
            <p class="center login-form-text" style="font-family: Raleway, sans-serif;font-size:18px;color:#b5796d;"></p><span class="badge" data-badge-caption="custom caption"><h6 style="font-size:12px;font-family: Open Sans, ;font-family: Akronim;color: mediumaquamarine;">Version 0.18</h6></span>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-perm-contact-cal prefix" style="color: antiquewhite;"></i>
            <input name="contact" id="contact" type="number" data-error=".errorTxt1" style="border-radius: 8px;border-bottom: 2px solid #b5796d;">
            <label for="contact" class="center-align"  style="font-size:12px;">Phone</label>
              <div class="errorTxt1"></div>
            </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
              <span<a onclick="myFunction()"><i class="mdi-hardware-security prefix" style="color: antiquewhite;"></i></a></span>
            <input name="password" id="password" type="password" data-error=".errorTxt2" style="border-radius: 8px;border-bottom: 2px solid #b5796d;">
            <label for="password" style="font-size:12px;">Password</label>
              <div class="errorTxt2"></div>
          </div>
        </div>
        <div class="row col s12">
            <button id="loginbtn" value="submit" class="icon ion-md-lock btn color waves-effect waves-light center col s12" type="submit" style="color: white;font-family: Open Sans, ;font-family: Akronim;font-size:20px;border: 1px solid antiquewhite;border-radius: 8px;" name="action">Login</button><br><br>
		  		      <div class="row">
                    <div class="segment">
                     <div class="btn-group">
                         <p class="margin center medium-small sign-up" style="font-size:12px;color:black;">Don't have an account <a href="register.php" style="font-size:15px;color:#b5796d;"><button class="unit" type="button" style="border: 3px solid antiquewhite;color: #b5796d;"><i class="mdi-social-person-add prefix"></i></button></a></p>
                         <div style="height:5px;"></div>
                         <p class="medium-small center" style="font-size:12px;color:black;">Forget your password <a href="for_pw.php" style="font-size:15px;color:#b5796d;"><button class="unit" type="button" style="border: 3px solid antiquewhite;color: #b5796d;"><i class="mdi-action-lock-open prefix"></i></button></a></p><br>
                         <div class="divider"></div>
                         <img src="images/we-accept-credit-cards.png" width="180px" height="30px;" style="object-fit: scale-down;">
                         <p class="medium-small center" style="font-size:10px;height: 2px;">See how we work <a href="yaadiltd.php" style="font-size:10px;color: #b5796d;font-family: Raleway, sans-serif;border-radius: 8px;background-color: antiquewhite;"> <b> Yaadi </b> </a></p>
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
  <script type="text/javascript" src="js/main.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153638148-1"></script>
  <script type="text/javascript">
           var scrollSpeed = 100;
           var current = 0;
           var direction = 'h';
           function bgscroll() {
               current -= 1;
               $('body').css("backgroundPosition", (direction == 'h') ? current + "px 0" : "0 " + current + "px");
           }
           setInterval("bgscroll()", scrollSpeed);
      </script>
    <script type="text/javascript">
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
    </script>
<!--  <script>-->
<!--      function myFunction() {-->
<!--          var x = document.getElementById("password");-->
<!--          if (x.type === "password") {-->
<!--              x.type = "text";-->
<!--          } else {-->
<!--              x.type = "password";-->
<!--          }-->
<!--      }-->
<!--  </script>-->
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