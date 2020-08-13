<?php
include 'includes/connect.php';
include 'includes/wallet.php';

	if($_SESSION['customer_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Tickets</title>
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
                        <li><h1 class="logo-wrapper" style="font-size:42px;"><a href="index.php" class="brand-logo darken-1" style="font-size:40px;font-family: 'Open Sans', ;font-family: 'Akronim';">Yaadi<span style="font-size: 16px;color: mediumspringgreen;"> Food Delivery</span></a><span class="logo-text">Logo</span></h1></li>
                    </ul>

                    <ul class="right" style="background-color: transparent;border: 0px;margin 0px;margin-bottom: 0px;">
                        <li style="background-color: transparent;">
                            <a class="waves-effect waves-cyan"><i class="mdi-action-shopping-basket"></i></a>
                            <div class="collapsible-body" style="background-color: white;border: 0px;margin 0px;color: black;border-radius:8px;">
                                <ul id="issues-collection" class="collection" style="border-radius:16px;">
                                    <?php
                                    $result = mysqli_query($con, "SELECT * FROM users where id= $user_id AND not deleted;");
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $res_name = $row['name'];
                                        $phone = $row["contact"];

                                        echo '<li class="collection-item avatar">
                        <i class="mdi-content-content-paste red circle"></i>
                        <p><strong>Name:</strong> '.$name.'</p>
                        <p><strong>Contact Number: '.$phone.'</strong></p>
                        <a href="#." class="secondary-content"><i class="mdi-action-grade"></i></a>';
                                    }
                                    ?>
                                    <?php
                                    if(!empty($_SESSION["shopping_cart"]))
                                    {
                                        $total = 0;
                                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                                        {
                                            ?>
                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s8">
                                                        <p class="collections-title"><strong><span>#<?php echo $values["item_quantity"];?> </span></strong> <?php echo $values["item_name"]; ?></p>
                                                    </div>

                                                    <div class="col s4"><br>
                                                        <span>$<?php echo $values["item_price"]; ?> JMD</span>
                                                    </div>
                                                    <div class="col s4">
                                                        <a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger" style="color: darkred;">Remove</span></a>
                                                    </div>
                                                </div>
                                            </li>

                                            <?php
                                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                        }
                                        ?>


                                        <li class="collection-item">
                                            <div class="row">
                                                <div class="col s8">
                                                    <p class="collections-title"> Total</p>
                                                    <p>Select a restaurant to place your order.</p>
                                                </div>
                                                <div class="col s4"><br>
                                                    <span><strong>$<?php echo number_format($total); ?> JMD</strong></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
   </header>
   
  <div id="main">
     <div class="wrapper">
 
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftnavset">
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
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Order Food</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> My Orders</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="orders.php">All Orders</a>
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
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan active"><i class="mdi-action-question-answer"></i> Tickets</a>
                            <div class="collapsible-body">
                                <ul>
								<li class="<?php
								if(!isset($_GET['status'])){
										echo 'active';
									}?>
									"><a href="tickets.php">All Tickets</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets WHERE poster_id = $user_id AND not deleted;");
									while($row = mysqli_fetch_array($sql)){
									if(isset($_GET['status'])){
										$status = $row['status'];
									}
                                    echo '<li class='.(isset($_GET['status'])?($status == $_GET['status'] ? 'active' : ''): '').'><a href="tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>			
            <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Account</a>
            </li>				
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu" style="color: mediumaquamarine;"></i></a>
        </aside>
       
      <section id="content">

         <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12" style="background: url(https://image.freepik.com/free-vector/food-pattern-design_1221-27.jpg) repeat fixed;border-radius: 16px;border-top-left-radius: 0px;border-top-right-radius: 0px;">
                <h5 class="breadcrumbs-title" style="font-weight: 800;mso-bidi-font-style: oblique;color: #fff;width: 120px;background-color: #FFB03B;border-radius: 8px;text-align: center;">Tickets</h5>
              </div>
            </div>
          </div>
        </div>
  
        <div class="container">
          <p class="caption">If you're experiencing any issues, contact us by opening a ticket.</p>
          <div class="divider"></div>
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Open a ticket</h4>
              </div>
<div>
                <div class="card-panel">
                  <div class="row">
                    <form class="formValidate" id="formValidate" method="post" action="routers/add-ticket.php" novalidate="novalidate" class="col s12">
                      <div class="row">
                        <div class="input-field col s12">
                          <input name="subject" id="subject" type="text" data-error=".errorTxt1">
                          <label for="subject" class="">Subject</label>
						  <div class="errorTxt1"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <textarea name="description" id="description" class="materialize-textarea validate" data-error=".errorTxt2"></textarea>
                          <label for="description" class="">Description</label>
						  <div class="errorTxt2"></div>
                        </div>
                      </div>					  
                      <div class="row">
                        <div class="input-field col s4">
							<select name="type">
								<option disabled selected>Choose a type</option>
								<option value="Support">Support</option>
								<option value="Payment">Payment</option>
								<option value="Complaint">Complaint</option>
								<option value="Others">Others</option>				
							</select>
							<label>Type</label>
                        </div>
                      </div>					  
                      <div class="row">
                        <div class="row">
                          <div class="input-field col s11">
						  <input type="hidden" value="<?php echo $user_id;?>" name="id">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action" style="border-radius:16px;">Submit
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <div class="divider"></div>
          </div>
    </div>
          <div class="container">
          <p class="caption">List of your tickets</p>
          <div class="divider"></div>
									<div id="work-collections">
									<ul id="projects-collection" class="collection">
								<?php
									if(isset($_GET['status'])){
										$status = $_GET['status'];
									}
									else{
										$status = '%';
									}			
									$sql = mysqli_query($con, "SELECT * FROM tickets WHERE poster_id = $user_id AND status LIKE '$status' AND not deleted;");
									while($row = mysqli_fetch_array($sql)){								                                
									echo'<a href="view-ticket.php?id='.$row['id'].'"class="collection-item">
                                        <div class="row">
                                            <div class="col s6">
                                                <p class="collections-title">'.$row['subject'].'</p>                                              
                                            </div>
                                            <div class="col s2">
                                            <span class="task-cat cyan">'.$row['status'].'</span></div>											
                                            <div class="col s2">
                                            <span class="task-cat grey darken-3">'.$row['type'].'</span></div>
                                            <div class="col s2">
                                            <span class="badge">'.$row['date'].'</span></div>
                                        </div>
                                    </a>';
									}
									?>
									</ul>
									</div>
            <div class="divider"></div>
            
          </div>
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
     <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
	
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            subject: {
                required: true,
                minlength: 5,
				maxlength: 100
            },
            description: {
                required: true,
                minlength: 20,
				maxlength: 300				
            },
            type: {
                required: true,			
            },			
        },
        messages: {
            subject: {
                required: "Provide a subject",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 100 characters are required."				
            },
            description: {
                required: "Provide description of your problem",
                minlength: "Minimum 20 characters are required.",
                maxlength: "Maximum 3000 characters are required."					
            },	
            type: {
                required: "Please specify type of your problem",
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
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:all-tickets.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>