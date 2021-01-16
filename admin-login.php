<?php  
session_start(); 
if(isset($_SESSION['admin_sid']))
{
    header("location:admin.php");
}
else{
    setcookie("YAADI-CHEKZ", "Is That A Cookie", time() + 3600, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="">
  <meta name="keywords" content="Login,yaadi,user,restaurant,food ordering system,food,delivery,oders,pickup">
  <meta name="author" content="Yaadi® Ltd | Admin">
  <title>Administration</title>
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
    <style>
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
</head>
<body style="background: url(https://images.pexels.com/photos/451832/pexels-photo-451832.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) repeat fixed;">
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>

  <div id="login-page" class="row">
      <div class="col s12 z-depth-4 card-panel" style="border: 2px solid antiquewhite;border-radius: 8px;">
          <form class="formValidate  login-form" id="formValidate" method="post" action="<?php echo "routers/router-admin.php"; ?>" novalidate="novalidate">
              <div class="row"><span style="font-size:18px;">🍉</span>
                  <div class="input-field col s12 center">
                      <img id="logoimg" src="images/yaadi-icon.png" width="200px" height="150px" style="object-position: center;object-fit: scale-down;">
                      <p class="center login-form-text" style="font-family: Raleway, sans-serif;font-size:18px;color:#b5796d;"></p><span class="badge" data-badge-caption="custom caption"><h6 style="font-size:12px;font-family: Open Sans, ;font-family: Akronim;color: #a0381b;">V.04</h6></span>
                  </div>
              </div>
              <div class="row margin">
                  <div class="input-field col s12">
                      <i class="mdi-action-verified-user prefix" style="color: #a0381b;"></i>
                      <input name="username" id="username" type="text" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-bottom: 2px solid #a0381b;">
                      <label for="username" class="center-align" style="font-size:12px;">Admin Username</label>
                      <div class="errorTxt1"></div>
                  </div>
              </div>
              <div class="row margin">
                  <div class="input-field col s12">
                      <span<a><i class="mdi-hardware-security prefix" style="color: #a0381b;"></i></a></span>
                      <input name="password" id="password" type="password" data-error=".errorTxt2" style="border-bottom-right-radius: 8px;border-bottom: 2px solid #a0381b;">
                      <label for="password" style="font-size:12px;">Password</label>
                      <div class="errorTxt2"></div>
                  </div>
              </div>
              <div class="row col s12">
                  <button id="loginbtn" value="submit" class="icon ion-md-lock btn-flat color waves-effect waves-light center col s12" type="submit" style="background-color: #a0381b;color: white;font-size:12px;border: 1px solid antiquewhite;border-radius: 8px;" name="action">Login <i class="mdi-action-lock right"></i></button><br><br>
                  <div class="row">
                      <div class="segment">
                          <div class="btn-group">
                              <div style="height:10px;"></div>
                              <div class="divider"></div>
                              <p class="center"><i class="mdi-notification-event-available"></i> Welcome to Yaadi admissions</p>
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
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
			password: {
				required: true,
				minlength: 5,
                maxlength: 10
			},
            
        },
        messages: {
            username: {
                required: "Enter Username",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 15 characters allowed.",
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