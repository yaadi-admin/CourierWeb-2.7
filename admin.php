<?php
include 'includes/connect.php';
	if($_SESSION['admin_sid']==session_id())
	{
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
                      <li><h1 class="logo-wrapper" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;"><a href="index.php" class="brand-logo darken-1" style="font-family: 'Open Sans', ;font-family: 'Akronim';font-size:42px;">Yaadi</a><span class="logo-text">Logo</span></h1></li>
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
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>All Orders</a>
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
            <li class="bold"><a href="log-book-admin.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i>Logs</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <section id="content">
          <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Dashboard</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <p class="caption">Welcome to your dashboard, verify modifications before updating or submitting.</p>
          <div class="divider"></div>
		  <form class="formValidate" id="formValidate" method="post" action="routers/menu-router.php" novalidate="novalidate">
            <div class="row">
              
              <div>
    <div class="row">
        <div class="col s12 m3" style="border-radius:16px;">
      <div class="card" style="border-radius:16px;">
        <div class="card-image">
          <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
          <span class="card-title text-white"><blockquote style="border-radius:8px;">
     Delivery
    </blockquote></span>
        </div>
        <div class="card-content">
          <p class="text-black">View/modify rider information...</p>
        </div>
        <div class="card-action">
          <a href="am_rd.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
        </div>
      </div>
    </div>
  
                  
    <div class="col s12 m3" style="border-radius:16px;">
      <div class="card" style="border-radius:16px;">
        <div class="card-image">
            <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
          <span class="card-title text-white"><blockquote style="border-radius:8px;">
     Customers
    </blockquote></span>
        </div>
        <div class="card-content">
          <p class="text-black">View/modify customer information...</p>
        </div>
        <div class="card-action">
          <a href="am_cust.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
        </div>
      </div>
    </div>
                  
                  
    <div class="col s12 m3" style="border-radius:16px;">
      <div class="card" style="border-radius:16px;">
        <div class="card-image">
            <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
          <span class="card-title text-white"><blockquote style="border-radius:8px;">
     Restaurants
    </blockquote></span>
        </div>
        <div class="card-content">
          <p class="text-black">View/modify restaurant information...</p>
        </div>
        <div class="card-action">
          <a href="am_rest.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
        </div>
      </div>
    </div>
    <div class="col s12 m3" style="border-radius:16px;">
      <div class="card" style="border-radius:16px;">
        <div class="card-image">
            <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
          <span class="card-title text-white"><blockquote style="border-radius:8px;">
     Account Recovery
    </blockquote></span>
        </div>
        <div class="card-content">
          <p class="text-black">Password reset and recovery...</p>
        </div>
        <div class="card-action">
          <a href="am_pa.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
        </div>
      </div>
    </div>
        
        
</div>
                  <div class="row">
    <div class="col s12 m3" style="border-radius:16px;">
      <div class="card" style="border-radius:16px;">
        <div class="card-image" style="border-radius:16px;">
            <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
          <span class="card-title text-white"><blockquote style="border-radius:8px;">
     Tickets
    </blockquote></span>
        </div>
        <div class="card-content">
          <p class="text-black">Respond to questions and concerns...</p>
        </div>
        <div class="card-action">
          <a href="tickets.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
        </div>
      </div>
    </div>

    <div class="col s12 m3" style="border-radius:16px;">
      <div class="card" style="border-radius:16px;">
        <div class="card-image" style="border-radius:16px;">
            <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
          <span class="card-title text-white"><blockquote style="border-radius:8px;">
     Reports
    </blockquote></span>
        </div>
        <div class="card-content">
          <p class="text-black">Reports or overview...</p>
        </div>
        <div class="card-action">
          <a href="am_rep.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
        </div>
      </div>
    </div>

                      <div class="col s12 m3" style="border-radius:16px;">
                          <div class="card" style="border-radius:16px;">
                              <div class="card-image" style="border-radius:8px;">
                                  <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
                                  <span class="card-title text-white"><blockquote style="border-radius:8px;">
                                          Push Notifications
                                </blockquote></span>
                              </div>
                              <div class="card-content">
                                  <p class="text-black">Send custom messages...</p>
                              </div>
                              <div class="card-action">
                                  <a href="am_adv.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
                              </div>
                          </div>
                      </div>

                      <div class="col s12 m3" style="border-radius:16px;">
                          <div class="card" style="border-radius:16px;">
                              <div class="card-image" style="border-radius:8px;">
                                  <img src="images/user-bg.jpg" width="100%;" height="100px;"  style="border-radius:8px; border: 1.5px solid antiquewhite;">
                                  <span class="card-title text-white"><blockquote style="border-radius:8px;">
                                          Advertisements
                                </blockquote></span>
                              </div>
                              <div class="card-content">
                                  <p class="text-black">Post Adverts to yaadi.co...</p>
                              </div>
                              <div class="card-action">
                                  <a href="adverts.php" class="waves-effect waves-light btn text-white" style="border-radius:8px;">Manage</a>
                              </div>
                          </div>
                      </div>

</div>

                  <div class="row">
              </div>
            </div>
			</form>
            <div class="divider"></div>
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
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
	    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items");
			while($row = mysqli_fetch_array($result))
			{
				echo $row["id"].'_name:{
				required: true,
				minlength: 5,
				maxlength: 20 
				},';
				echo $row["id"].'_price:{
				required: true,	
				min: 0
				},';				
			}
		echo '},';
		?>
        messages: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items");
			while($row = mysqli_fetch_array($result))
			{  
				echo $row["id"].'_name:{
				required: "Ener item name",
				minlength: "Minimum length is 5 characters",
				maxlength: "Maximum length is 20 characters"
				},';
				echo $row["id"].'_price:{
				required: "Ener price of item",
				min: "Minimum item price is Rs. 0"
				},';				
			}
		echo '},';
		?>
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
    <script type="text/javascript">
    $("#formValidate1").validate({
        rules: {
		name: {
				required: true,
				minlength: 5
			},
		price: {
				required: true,
				min: 0
			},
	},
        messages: {
		name: {
				required: "Enter item name",
				minlength: "Minimum length is 5 characters"
			},
		 price: {
				required: "Enter item price",
				minlength: "Minimum item price is Rs.0"
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