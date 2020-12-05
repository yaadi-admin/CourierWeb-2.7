<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Yaadi is an online ordering & delivery company. Founded on November 1st 2019">
  <meta name="keywords" content="restaurants near me,food near me,places to eat near me,mexican restaurants,italian restaurants,steakhouse,diner,restaurants nearby,food places near me,seafood restaurants,vegan restaurants,breakfast restaurants,restaurant games,lunch near me,best restaurants near me,nearby restaurants,diners near me,restaurants near me now,places to eat,seafood restaurants near me,food around me,steakhouse near me,restaurant week,restaurants near my location,greek restaurant">
  <meta name="author" content="Copyright © 2019 Yaadi® Ltd. All Rights Reserved">
  <title>Forget Password</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo"></script>
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
  </style> 
</head>

<body style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;">
    
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
   <div id="login-page" class="row" style="border-radius: 8px;">
    <div class="col s12 z-depth-4 card-panel" style="border-radius: 8px;border: 1px solid maroon;">
      <form method="post" class="login-form" id="validate">
        <div id="highlighted" class="hl-basic hidden-xs">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">
        <h1>Forget password?</h1>
      </div>
    </div>
  </div>
</div>
<div id="content" class="interior-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-3 col-lg-2 sidebar equal-height interior-page-nav hidden-xs">
        <div class="dynamicDiv panel-group" id="dd.0.1.0">
        </div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-10 content equal-height">
        <div class="content-area-right">
          <div class="content-crumb-div">
            <a href="login.php">LOGIN</a> | Account Recovery
          </div>
          <div class="row">
            <div class="col-md-5 forgot-form">
              <p>Please enter the phone number connected to your account, then await your text message</p>
              <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input name="phone" id="phone" type="tel" data-error=".errorTxt4" style="border-bottom-right-radius: 8px;">
            <label for="phone">Phone</label>
			<div class="errorTxt4"></div>			
          </div>
        </div>
                <div class="row">
                    <button id="reset" class="btn waves-effect waves-light col s12" style="color: white;border-radius: 8px;">Request</button>
          </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </form>
        </div>
       <span id="message"></span>
    </div>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            phone: {
				required: true,
				minlength: 10,
                maxlength: 11
			},
        },
        messages: {
            phone:{
				required: "Specify contact number +1 876XXXXXXX.",
				minlength: "Minimum 10 digits are required.",
                maxlength: "Maximum 11 characters are allowed"                
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
      $(document).ready(function () {
          RRequest();
      })

      function RRequest() {
          $(document).on('click', "#reset", function (e) {
              e.preventDefault();
              var phone = $('#phone').val();

              if (phone === ''){
                  Materialize.toast('Please enter your phone number', 5000);
              }
              else {
                  $.ajax({
                      url: '../routers/forget-router.php',
                      method: 'post',
                      data:{phone:phone},
                      success: function (data) {
                          $('#message').html(data);
                      }
                  })
              }
          })
      }
  </script>
  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="js/plugins.min.js"></script>
  <script type="text/javascript" src="js/custom-script.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153638148-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-153638148-1');
</script>

</body>
</html>