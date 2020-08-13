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
    setcookie("YAADI-CHEKZ", "Is That A Cookie", time() + 3600, '/'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Live faster with fast delivery and superior service. Founded November 1st/19">
  <meta name="keywords" content="restaurants near me,food near me,places to eat near me,mexican restaurants,italian restaurants,steakhouse,diner,restaurants nearby,food places near me,seafood restaurants,vegan restaurants,breakfast restaurants,restaurant games,lunch near me,best restaurants near me,nearby restaurants,diners near me,restaurants near me now,places to eat,seafood restaurants near me,food around me,steakhouse near me,restaurant week,restaurants near my location,greek restaurant">
  <meta name="author" content="Copyright © 2019 Yaadi® Ltd. All Rights Reserved">
  <title>Delivery</title>
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
<body style="background: url(https://images.pexels.com/photos/441794/pexels-photo-441794.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) repeat fixed;">
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
    <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
         <form class="formValidate  login-form" id="formValidate" method="post" action="routers/del-router.php" novalidate="novalidate"> 
        <div class="row"><i class="mdi-action-lock-outline prefix" style="font-size:18px;color:#b5796d;"></i>
          <div class="input-field col s12 center"> 
              <span class="badge " data-badge-caption="custom caption" style="color: #61677C;
  font-weight: bold;box-shadow: -5px -5px 20px #FFF, 5px 5px 20px #BABECC;transition: all 0.2s ease-in-out;cursor: pointer;font-weight: 600;border-radius: 8px;line-height: 0;width: 60px;height: 40px;display: inline-flex;color: #b5796d;justify-content: center;align-items: center;margin: 0 8px;font-size: 15.2px;font-family: Open Sans, ;font-family: Akronim;">BETA</span>
              <img src="images/yaadi-icon.png" width="200px" height="150px" style="object-position: center;object-fit: scale-down;">
            <p class="center login-form-text" style="font-family: Raleway, sans-serif;font-size:18px;color:#b5796d;">DELIVERY | LOGIN</p><span class="badge" data-badge-caption="custom caption"><h6 style="font-size:06px;font-family: Open Sans, ;font-family: Akronim;">V.04</h6></span>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input name="username" id="username" type="number" data-error=".errorTxt1">
            <label for="username" class="center-align"  style="font-size:12px;">Phone Number</label>
              <div class="errorTxt1"></div>
            </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input name="password" id="password" type="password" data-error=".errorTxt2">
            <label for="password" style="font-size:12px;">Password</label>
              <div class="errorTxt2"></div>
          </div>
        </div>
        <div class="row col s12">
            <button value="submit" class="icon ion-md-lock btn colorr waves-effect waves-light center col s12" onclick="document.getElementById('formValidate').check();" type="submit" style="color: white;font-family: Open Sans, ;font-family: Akronim;font-size:20px;" name="action">Login</button><br><br>
		  		      <div class="row">
                    <div class="segment">
                     <div class="btn-group">
                         <p class="medium-small center" style="font-size:12px;color:#b5796d;">Can't access account? | <a href="for_pw.php" style="font-size:15px;color:#b5796d;"><button class="unit" type="button"><i class="mdi-action-lock prefix"></i></button></a></p><br>
                         <div class="divider"></div>
                         <p class="medium-small center" style="font-size:12px;">Company Home | <a href="yaadiltd.php" style="font-size:12px;color:#b5796d;font-family: Raleway, sans-serif;"><b><u>Go Yaadi®</u></b></a></p>
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
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153638148-1"></script>
  <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            username: {
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
            username: {
                required: "Specify contact number +1 876XXXXXXX.",
				minlength: "Minimum 10 digits are required.",
                maxlength: "Maximum 11 characters are allowed"
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