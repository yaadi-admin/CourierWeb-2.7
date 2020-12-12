<?php
include 'includes/connect.php';
include 'includes/wallet.php';
	if($_SESSION['customer_sid']==session_id())
	{
        $usr_address = "";
        $useraddress = mysqli_query($con, "SELECT * FROM users WHERE name= '$name'");
        while($row = mysqli_fetch_array($useraddress))
        {
            $usr_address = $row['address'];
        }
        $fee = 0;
        $payment_type = '';
        
		?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Orders</title>
  <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
  <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="https://fonts.googleapis.com/css?family=Akronim|Open+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
  <style>
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
                        <label class="center" style="font-size: 10px;color: #a21318;font-weight: 600;"><b>DELIVERING TO <span id="nearby"></span></b></label>
                        <li class="center"><a href="deliverto.php" class="brand-logo darken-1" style="font-size: 12px;color: black;"><?php echo $usr_address; ?></a></li>
                    </ul>
                </div>
            </nav>
        </div>
  </header>
  <div id="main">
    <div class="wrapper">
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav menu fixed leftnavset" style="border-top-right-radius: 8px;">
                <nav class="nav-extended">
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
                    <li class="bold"><a href="index.php"><i class="mdi-action-shop-two"></i> Order Food</a>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold active"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>My Orders</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li class="bold active"><a href="orders.php">My Orders</a>
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
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i>Tickets</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="tickets.php">My Tickets</a>
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
                    <li class="bold"><a href="wallet.php" class="waves-effect waves-cyan"><i class="mdi-action-account-balance-wallet"></i>My Wallet</a>
                    </li>
                    <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-action-account-box"></i>Account</a>
                    </li>
                    <li class="bold"><a href="#." class="waves-effect waves-cyan"><i class="mdi-action-settings"></i>Settings</a>
                    </li>
                </nav>
            </ul>
            <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan z-depth-0"><i class="mdi-navigation-menu" style="color: white;"></i></a>
        </aside>
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
          <p class="caption">My past & current orders</p>
<div id="work-collections" class="seaction">
             
					<?php
					if(isset($_GET['status'])){
						$status = $_GET['status'];
					}
					else{
						$status = '%';
					}
					$sql = mysqli_query($con, "SELECT * FROM orders WHERE customer_id = $user_id AND status LIKE '$status';");
            ?>
					 <div class="row">
                <div>
                    <ul id="issues-collection" class="collection">
                         <?php
					while($row = mysqli_fetch_array($sql))
					{
					    $filler = $row['assignedto'];
					    $fillername = "Awaiting";
					    $filler_image = "";

                            $fee = $row['fee'];

                            $getname = mysqli_query($con, "SELECT * FROM users WHERE id = $filler;");
                            while($row5 = mysqli_fetch_array($getname))
                            {
                                $fillername = $row5['name'];
                                $filler_image = $row5['image_dir'];
                            }

						$status = $row['status'];
						echo '<li class="collection-item avatar">
                              <i class="mdi-content-content-paste red circle"></i>
                              <span class="collection-header">Order No. '.$row['id'].'</span>
                              <p><strong>Date:</strong> '.$row['date'].'</p>
							  <p><strong>Address:</strong> '.$row['address'].'</p>
                              <p><strong>Payment Type:</strong> '.$row['pay_type'].'</p>							  
                              <p><strong>Courier:</strong> <img class="profile-image-post circle" src="'.$filler_image.'" width="24px" height="24px"> '.$fillername.'</p>							  
                              <p><strong>Status:</strong> '.($status=='Paused' ? 'Paused <a  data-position="bottom" data-delay="50" data-tooltip="Please contact administrator for further details." class="btn-floating waves-effect waves-light tooltipped cyan">    ?</a>' : $status).'</p>							  
							  '.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'						                               
							  <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>';
						$order_id = $row['id'];
						$sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
						while($row1 = mysqli_fetch_array($sql1))
						{
							$item_id = $row1['item_id'];
							$sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
							while($row2 = mysqli_fetch_array($sql2)){
								$item_name = $row2['name'];
							}
							echo '<li class="collection-item">
                            <div class="row">
                            <div class="col s1">
                            <span style="background-color: mediumaquamarine;border-radius: 8px;color: black;">('.$row1['quantity'].')</span>
                            </div>
                            <div class="col s5">
                            <p class="collections-title">'.$item_name.'</p>';
                            if (isset($row1["variation"]) && $row1["variation"] != "") {
                                echo ' 
                                                                <label>Flavor: </label><label>'.$row1["variation"].'</label><br>';
                            }

                            if (isset($row1["variation_type"]) && $row1["variation_type"] != ''){
                                echo '   
                                                                <label>Type: </label><label>'.$row1["variation_type"].'</label><br>';
                            }

                            if (isset($row1["variation_side"]) && $row1["variation_side"] != ''){
                                echo '  
                                                                <label>Side: </label><label>'.$row1["variation_side"].'</label><br>';
                            }

                            if (isset($row1["variation_drink"]) && $row1["variation_drink"] != '') {
                                echo '  
                                                                <label>Drink: </label><label>'.$row1["variation_drink"].'</label><br>';
                            }

                        echo'
                                </div>
                            <div class="col s3">
                            <label>'.$row1['restaurant'].'</label>
                            </div>
                            <div class="col s3">
                            <span>$'.number_format($row1['price']).' <span style="font-size: 6px;">JMD</span></span>
                            </div>
                            </div>
                            </li>';
							$id = $row1['order_id'];
						}
								echo'<li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title">Service Fee</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span>$'.number_format($row['service_fee']).' <span style="font-size: 6px;">JMD</span></span>
                                            </div></li>
                                            
                                    <li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title">Delivery Fee</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span>$'.number_format($row['fee']).' <span style="font-size: 6px;">JMD</span></span>
                                            </div></li>
                                <li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span><strong>$'.number_format($row['total']).' <span style="font-size: 6px;">JMD</span></strong></span>
                                            </div>';
								if(!preg_match('/^Cancelled|Preparing|Completed|On Hold|Paused|Ready For Pick-Up|Cancelled by Admin/', $status)){
									if($status != 'Preparing' || $status != 'Completed' || $status != 'Cancelled' || $status != 'On Hold' || $status != 'Paused' || $status != 'Ready For Pick-Up' || $status != 'Ready For Pick-Up'){
								echo '<br><br><form action="routers/cancel-order.php" method="post">
										<input type="hidden" value="'.$id.'" name="id">
										<input type="hidden" value="Cancelled by Customer" name="status">	
										<input type="hidden" value="'.$row['payment_type'].'" name="payment_type">											
										<button class="btn waves-effect waves-light right" type="submit" name="action" style="border-radius:8px;background-color: #a0381b">Cancel
                                              <i class="mdi-content-clear right"></i> 
										</button>
										</form>';
								}
								}
								echo'</div></li>';

					}
					?>
                    </ul>
                </div>
              </div>
            
        </div>

    </div>
          </section>
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
    <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153638148-1');
</script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:all-orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>