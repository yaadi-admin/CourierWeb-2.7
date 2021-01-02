<?php
include 'includes/connect.php';

	if($_SESSION['restaurant_sid']==session_id())
	{
	    $user_id = $_SESSION['user_id'];
        $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
        while($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $address = $row['address'];
            $contact = $row['contact'];
            $email = $row['email'];
            $username = $row['username'];
            $phone_nt = $row['notphone'];
            $phone_nt2 = $row['notphone2'];
        }
		?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Business Account</title>
  <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
  <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo"></script>
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
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
                        <li><h1 class="logo-wrapper" style="font-size:42px;"><a href="restaurant.php" class="brand-logo darken-1" style="font-size:40px;font-family: 'Modak', 'cursive';">Yaad<span style="color: yellow;">i</span></a><span class="logo-text">Logo</span></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
  </header>
  <div id="main">
    <div class="wrapper">
        <aside id="left-sidebar-nav" style="border-radius: 8px;">
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
                <li class="bold"><a href="restaurant.php" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert"></i>Active Orders</a>
                </li>
                <li class="bold"><a href="restaurant-menu.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i>Menu</a>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-shopping-basket"></i> Orders
                                <?php

                                $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND restaurantid LIKE $user_id;");
                                $count = 0;
                                $total = 0;
                                while($row = mysqli_fetch_array($getamount)) {
                                    $count++;
                                    $total = 0;
                                    $total+=$count;
                                }
                                if ($total == 0){
                                    echo '<span class="new badge">'.$total.'</span>';
                                }
                                else{
                                    echo '<span class="new badge">'.$total.'</span>';
                                }


                                ?>
                            </a>
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
                <li class="bold"><a href="place-new-order.php" class="waves-effect waves-cyan"><i class="mdi-action-shop-two"></i>Hanker Order</a>
                </li>
                <li class="bold active"><a href="account-page.php" class="waves-effect waves-cyan"><i class="mdi-action-account-circle"></i>Account</a>
                </li>
                <li class="bold"><a href="restaurant-rep.php" class="waves-effect waves-cyan"><i class="mdi-action-view-list"></i>Order Report</a>
                </li>
                <li class="bold"><a href="#." class="waves-effect waves-cyan"><i class="mdi-action-settings"></i>Settings</a>
                </li>
            </ul>
            <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
        <section id="content">
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">My Account</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <p class="caption">Business information is required for deliveries, transactions and contact</p>
          <div class="divider"></div>
            <div class="row" style="border-radius: 8px;">
                <div>
                <div class="card-panel z-depth-0" style="border-radius: 8px;">
                  <div class="row">
                    <form class="formValidate" id="formValidate" method="post" novalidate="novalidate"class="col s12">
                      <div class="row">
                        <div class="input-field col s6">
                          <i class="mdi-action-account-box prefix"></i>
                          <input name="name" id="name" type="text" value="<?php echo $name;?>" data-error=".errorTxt2">
                          <label for="name" class="">Business name</label>
						   <div class="errorTxt2"></div>
                        </div>
                        <div class="input-field col s6">
                          <i class="mdi-communication-email prefix"></i>
                          <input name="email" id="email" type="email" value="<?php echo $email;?>" data-error=".errorTxt3">
                          <label for="email" class="">Email</label>
						  <div class="errorTxt3"></div>
                        </div>
                      </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="mdi-communication-phone prefix"></i>
                                <input name="phone" id="phone" type="number" value="<?php echo $contact;?>" data-error=".errorTxt5">
                                <label for="phone" class="">Business Number</label>
                                <div class="errorTxt5"></div>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-communication-phone prefix"></i>
                                <input name="phonent" id="phonent" type="number" value="<?php echo $phone_nt;?>" data-error=".errorTxt5">
                                <label for="phone" class="">First Notification Contact</label>
                                <div class="errorTxt5"></div>
                            </div>
                        </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
                          <textarea name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt6"><?php echo $address;?></textarea>
                          <label for="address" class="">Address</label>
						  <div class="errorTxt6"></div>
                        </div>
                          <div class="row">
                              <div class="input-field col s12">
                                  <i class="mdi-action-lock-outline prefix"></i>
                                  <input name="password" id="password" type="password" data-error=".errorTxt4">
                                  <label for="password" class="">Current Password</label>
                                  <div class="errorTxt4"></div>
                              </div>
                          </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light" id="updatedetails" type="submit" name="action" style="border-radius:8px;width: 100%;">Update
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
            <span id="message"></span>
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
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 4,
				maxlength: 15
            },
            name: {
                required: true,
                minlength: 4,
				maxlength: 32
            },
            email: {
				required: true,
				maxlength: 35,
			},
			password: {
				required: true,
				minlength: 5,
				maxlength: 16,
			},
            phone: {
				required: true,
				minlength: 10,
				maxlength: 11
			},
			address: {
				required: true,
				minlength: 10,
				maxlength: 300
			},
        },
        messages: {
            username: {
                required: "Enter username",
                minlength: "Minimum 4 characters are required.",
                maxlength: "Maximum 15 characters are required."
            },
            name: {
                required: "Enter name",
                minlength: "Minimum 4 characters are required.",
                maxlength: "Maximum 32 characters are required."
            },
            email: {
				required: "Enter email",
                maxlength: "Maximum 35 characters are required."				
			},
			password: {
				required: "Enter password",
				minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 16 characters are required."				
			},
            phone:{
				required: "Specify contact number.",
                maxlength: "Maximum 11 digits are accepted."				
			},	
            address:{
				required: "Specify address",
				minlength: "Minimum 10 characters are required.",
                maxlength: "Maximum 300 characters are accepted."				
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
          UpdateUser();
      })

      function UpdateUser() {
          $(document).on('click', "#updatedetails", function (e) {
              e.preventDefault();
              var name = $('#name').val();
              var phone = $('#phone').val();
              var phonent = $('#phonent').val();
              var email = $('#email').val();
              var address = $('#address').val();
              var passcode = $('#password').val();

              if (name == "" || passcode == "" || email == "" || address == "" || phone == "" || phonent == ""){
                  Materialize.toast('All fields are not filled', 8000);
              }
              else {
                  $.ajax({
                      url: '../routers/restaurant-details-router.php',
                      method: 'post',
                      data:{Pnn:phone,Pnnt:phonent,Pc:passcode,Nm:name,Em:email,Ad:address},
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