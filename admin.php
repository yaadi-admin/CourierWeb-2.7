<?php
include 'includes/connect.php';
	if($_SESSION['admin_sid']==session_id())
	{
        $id = "";
        $result = mysqli_query($con, "SELECT * FROM users WHERE name='$name';");
        while($row = mysqli_fetch_array($result))
        {
            $id = $row['id'];
        }
        $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));
        $date->setTimezone(new DateTimeZone('America/Jamaica'));
        $timestamp = $date->format('Y-m-d H:i:sP');
        $url = $_SERVER['REQUEST_URI'];
        $action = "Viewed Admin Homepage";
        $sql = "INSERT INTO timeline (user_id, action, url, date) VALUES ('$id', '$action', '$url', '$timestamp')";
        $con->query($sql);

	    $admission = "";
	    $admission2 = "";
		?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Dashboard</title>
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
  
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

.row {margin: 0 -5px;}

.row:after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
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
                    <ul class="left">
                      <li><h1 class="logo-wrapper" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;"><a href="index.php" class="brand-logo darken-1" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;">Yaadi<span style="font-size: 12px;color: mediumspringgreen;"> Admissions</span></a></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
  </header>
  <div id="main">
    <div class="wrapper">
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftnavset">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="Ambassador Avatar" class="circle responsive-img valign profile-image" width="50px" height="50px">
                </div>
				 <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="admin-account-page.php"><i class="mdi-social-person"></i>Account</a></li>
                        <li><a href="routers/ad-logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $role;?></p>
                </div>
            </div>
            </li>
            <li class="bold active"><a href="admin.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i>Dashboard</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>All Orders
                                <?php

                                $getamount = mysqli_query($con, "SELECT * FROM orders WHERE (status LIKE 'Yet to be delivered' OR status LIKE 'Preparing') AND assignedto LIKE '0';");
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
								<li><a href="all-orders.php">All Orders</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>
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
								<li><a href="all-tickets.php">All Tickets</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="all-tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            <li class="bold"><a href="am_active.php" class="waves-effect waves-cyan"><i class="mdi-action-book"></i>My Activity</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>

        <div id="closelog" class="modal bottom-sheet">

            <div class="modal-content">
                <h5>Disable login?</h5>
                <h6>Enter password</h6>
                <input name="validatore" id="validatore" type="text" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-bottom: 2px solid antiquewhite;">
                <form action="routers/openclose.php" method="post">
                    <input type="hidden" name="admission" value="<?php $admission = 1; echo $admission; ?>">
                    <button class="btn waves-effect waves-light teal" type="submit" href=""><i class="mdi-hardware-security"></i></button>
                </form>
            </div>
        </div>

        <div id="openlog" class="modal bottom-sheet">

            <div class="modal-content">
                <h5>Enable login?</h5>
                <h6>Enter password</h6>
                <input name="validator" id="validator" type="text" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-bottom: 2px solid antiquewhite;">
                <form action="routers/closeopen.php" method="post">
                    <input type="hidden" name="admission" value="<?php $admission = 0; echo $admission; ?>">
                    <button class="btn waves-effect waves-light teal" type="submit" href=""><i class="mdi-hardware-security"></i></button>
                </form>
            </div>
        </div>


        <div id="closeorder" class="modal bottom-sheet">

            <div class="modal-content">
                <h5>Close ordering?</h5>
                <h6>Enter password</h6>
                <input name="validatore" id="validatore" type="text" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-bottom: 2px solid antiquewhite;">
                <form action="routers/act-orders.php" method="post">
                    <input type="hidden" placeholder="Enter your password..." name="admission" value="<?php $admission = 1; echo $admission; ?>">
                    <button class="btn waves-effect waves-light teal" type="submit" href=""><i class="mdi-hardware-security"></i></button>
                </form>
            </div>
        </div>

        <div id="enableorder" class="modal bottom-sheet">

            <div class="modal-content">
                <h5>Enable ordering?</h5>
                <h6>Enter password</h6>
                <input name="validator" id="validator" type="text" data-error=".errorTxt1" style="border-bottom-right-radius: 8px;border-bottom: 2px solid antiquewhite;">
                <form action="routers/deac-orders.php" method="post">
                    <input type="hidden" placeholder="Enter your password..." name="admission" value="<?php $admission = 0; echo $admission; ?>">
                    <button class="btn waves-effect waves-light teal" type="submit" href=""><i class="mdi-hardware-security"></i></button>
                </form>
            </div>
        </div>

                <section id="content">
          <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
              </div>
            </div>
          </div>
        </div>

          <div class="container">
              <ul class="collection with-header">
                  <?php
                  $date = date('l jS \of F Y');
                  echo '<li class="collection-header"><h4>'.$name.' <span class="right" style="font-size: 8px;">'.$date.'</span></h4><p class="caption">Welcome to your dashboard</p></li>';

                  $orderstat = mysqli_query($con, "SELECT DISTINCT admission FROM incumbency WHERE id=2;");
                  while($row = mysqli_fetch_array($orderstat)) {
                      if ($row['admission'] == 0) {
                          echo '<li class="collection-item"><i class="mdi-action-shop-two"></i> Ordering <a class="modal-trigger" href="#closeorder"><span class="badge green new" style="font-size: 1px;"><span style="font-size: 12px;"><i class="mdi-action-check-circle" style="color: white;"></i> ENABLED</span></span></a></li>';
                      } else if ($row['admission'] != 0) {
                          echo '<li class="collection-item"><i class="mdi-action-shop-two"></i> Ordering <a class="modal-trigger" href="#enableorder"><span class="badge red new" style="font-size: 1px;"><span style="font-size: 12px;"><i class="mdi-action-exit-to-app" style="color: white;"></i> DISABLED</span></span></a></li>';
                      }
                  }

                  $openclose = mysqli_query($con, "SELECT DISTINCT admission FROM incumbency WHERE id=1;");
                  while($row = mysqli_fetch_array($openclose)) {

                      if ($row['admission'] == 0) {
                          echo '<li class="collection-item"><i class="mdi-hardware-security"></i> Login <a class="modal-trigger" href="#closelog"><span class="badge green new" style="font-size: 1px;"><span style="font-size: 12px;"><i class="mdi-action-check-circle" style="color: white;"></i> ENABLED</span></span></a></li>';
                      } else if ($row['admission'] != 0) {
                          echo '<li class="collection-item"><i class="mdi-hardware-security"></i> Login <a class="modal-trigger" href="#openlog"><span class="badge red new" style="font-size: 1px;"><span style="font-size: 12px;"><i class="mdi-action-exit-to-app" style="color: white;"></i> DISABLED</span></span></a></li>';
                      }
                  }

                  ?>
                  <li class="collection-item"><a href="am_rd.php"><h4 class="black-text"><i class="mdi-maps-directions-bike"></i> Couriers</h4></a></li>
                  <li class="collection-item"><a href="am_cust.php"><h4 class="black-text"><i class="mdi-action-shop"></i> Customers</h4></a></li>
                  <li class="collection-item"><a href="am_rest.php"><h4 class="black-text"><i class="mdi-action-shop-two"></i> Restaurants</h4></a></li>
                  <li class="collection-item"><a href="am_pa.php"><h4 class="black-text"><i class="mdi-hardware-security"></i> Account Recovery</h4></a></li>
                  <li class="collection-item"><a href="tickets.php"><h4 class="black-text"><i class="mdi-communication-message"></i> Tickets</h4></a></li>
                  <li class="collection-item"><a href="am_rep.php"><h4 class="black-text"><i class="mdi-action-report-problem"></i> Reports</h4></a></li>
                  <li class="collection-item"><a href="am_wal.php"><h4 class="black-text"><i class="mdi-action-wallet-membership"></i> Wallets</h4></a></li>
                  <li class="collection-item"><a href="am_adv.php"><h4 class="black-text"><i class="mdi-action-settings-remote"></i> Promotions</h4></a></li>
              </ul>
          </section>
        </div>


  </div>
      </div>

    <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2020 <a class="grey-text text-lighten-4" href="yaadiltd.php" target="_blank">Yaadi.Co</a> All rights reserved.</span>
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