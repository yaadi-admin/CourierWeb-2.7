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
  <title>Restaurants</title>
  <link rel="icon" href="images/yaadi-icon.png" sizes="32x32">
  <link rel="apple-touch-icon-precomposed" href="images/yaadi-icon.png">
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/yaadi-icon.png">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
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
    .upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
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
            <li class="bold"><a href="admin.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Dashboard</a>
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
                <h5 class="breadcrumbs-title">Restaurants</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <p class="caption">Enable, Disable or Modify Restaurant Accounts.</p>
          <div class="divider"></div>
          <div id="editableTable" class="section">
		  <form class="formValidate" id="formValidate1" method="post" action="routers/arest-router.php" enctype="multipart/form-data" novalidate="novalidate">
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Accounts</h4>
              </div>
              <div>
<table class="responsive centered highlight striped">
                    <thead class="teal lighten-2">
                      <tr>
                        <th data-field="name" style="width:25%;">Name</th>
                        <th data-field="price" style="width:25%;">Info</th>
                        <th data-field="price" style="width:25%;">More Info</th>
                        <th data-field="price" style="width:25%;">Availability</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM users WHERE role='Restaurant';");
				while($row = mysqli_fetch_array($result))
				{
                    $name =  $row["name"];
                    $username = $row["username"];
                    $email = $row["email"];
                    $contact = $row["contact"];
                    $address = $row["address"];
                    $paw = $row['password'];
                    $hours = $row['opentime'];
                    $type = $row['ocassion'];
                    $mon = $row['mon'];
                    $tue = $row['tue'];
                    $wed = $row['wed'];
                    $thurs = $row['thurs'];
                    $fri = $row['fri'];
                    $sat = $row['sat'];
                    $sun = $row['sun'];

                    $monc = $row['monc'];
                    $tuec = $row['tuec'];
                    $wedc = $row['wedc'];
                    $thursc = $row['thurc'];
                    $fric = $row['fric'];
                    $satc = $row['satc'];
                    $sunc = $row['sunc'];

                    $ulong = $row['ulong'];
                    $ulat = $row['ulat'];

                    echo '<tr>
<td>
<img class="col s12" src="'.$row["image_dir"].'" width="100%" alt="Item Image" height="200px" style="object-fit: scale-down;" style="border-radius:8px;">
                    <form action="routers/upload.php?id='.$row["id"].'&resname='.$name.'" method="post" enctype="multipart/form-data">
                              <input type="file" name="fileToUpload" id="fileToUpload" style="content: \'Select some files\';display: inline-block;background: antiquewhite;
  border: 1px solid #999;border-radius: 3px;padding: 5px 8px;outline: none;white-space: nowrap;-webkit-user-select: none;cursor: pointer;text-shadow: 1px 1px #fff;font-weight: 700;font-size: 10pt;"><br /><br />
                              <button class="btn-flat waves-effect waves-light teal-text" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;" type="submit" value="Upload Image" name="submit">Upload <i class="mdi-content-send right"></i></button>
                            </form><br><br>
<span style="width: 100%;font-weight: 600;color: darkred;">'.$name.'</span><br>


<label for="monday">Monday</label><input id="monday" name="'.$row['id'].'_monday" value="'.$mon.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="mondayclose">Monday Close</label><input id="mondayclose" name="'.$row['id'].'_mondayclose" value="'.$monc.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>

</td>';

                    echo '<td>
<label for="email">Email</label><input id="email" name="'.$row['id'].'_email" value="'.$email.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="contact">Contact</label><input id="contact" name="'.$row['id'].'_contact" value="'.$contact.'" type="tel" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="tuesday">Tuesday</label><input id="tuesday" name="'.$row['id'].'_tuesday" value="'.$tue.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="tuesdayclose">Tuesday Close</label><input id="tuesdayclose" name="'.$row['id'].'_tuesdayclose" value="'.$tuec.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="wednesday">Wednesday</label><input id="wednesday" name="'.$row['id'].'_wednesday" value="'.$wed.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="wednesdayclose">Wednesday Close</label><input id="wednesdayclose" name="'.$row['id'].'_wednesdayclose" value="'.$wedc.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
</td>';


                    echo '<td>
<label for="address">Address</label><input id="address" name="'.$row['id'].'_address" value="'.$address.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="ocassion">Type</label><input id="ocassion" name="'.$row['id'].'_ocassion" value="'.$type.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>


<label for="thursday">Thursday</label><input id="thursday" name="'.$row['id'].'_thursday" value="'.$thurs.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="thursdayclose">Thursday Close</label><input id="thursdayclose" name="'.$row['id'].'_thursdayclose" value="'.$thursc.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="friday">Friday</label><input id="friday" name="'.$row['id'].'_friday" value="'.$fri.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="fridayclose">Friday Close</label><input id="fridayclose" name="'.$row['id'].'_fridayclose" value="'.$fric.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
</td>';

					echo '<td>
                    <select name="'.$row['id'].'_deleted" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;">
                      <option value="1"'.($row['deleted'] ? 'selected' : '').'>Disable</option>
                      <option value="0"'.(!$row['deleted'] ? 'selected' : '').'>Enable</option>
                    </select>
                    
                    
<label for="saturday">Saturday</label><input id="saturday" name="'.$row['id'].'_saturday" value="'.$sat.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="saturdayclose">Saturday Close</label><input id="saturdayclose" name="'.$row['id'].'_saturdayclose" value="'.$satc.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="sunday">Sunday</label><input id="sunday" name="'.$row['id'].'_sunday" value="'.$sun.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="sundayclose">Sunday Close</label><input id="sundayclose" name="'.$row['id'].'_sundayclose" value="'.$sunc.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>

<label for="lon">Longitude</label><input id="longitude" name="'.$row['id'].'_longitude" value="'.$ulong.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
<label for="lat">Latitude</label><input id="Latitude" name="'.$row['id'].'_latitude" value="'.$ulat.'" type="text" data-error=".errorTxt01" style="border-radius: 8px;border-bottom: 3px solid antiquewhite;"><div class="errorTxt01"></div>
                    
                    </td>';

				}
				?>
                    </tbody>
</table>
              </div>
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action" style="border-radius:8px;">Update
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
			</form>
		  <form class="formValidate" id="formValidate" method="post" action="routers/add-rest.php" novalidate="novalidate">
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Enroll</h4>
              </div>
              <div>
<table class="responsive centered highlight striped">
                    <thead class="teal lighten-2">
                      <tr>
                        <th data-field="name">Identity</th>
                        <th data-field="name">Password & Location</th>
                        <th data-field="name">Role</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php
					echo '<tr><td>
<div><label for="username">Username</label><input id="username" name="username" type="text" data-error=".errorTxt02" style="border-radius: 8px;border-bottom: 2px solid mediumaquamarine;"><div class="errorTxt06"><div class="errorTxt02"></div></div>
<div><label for="name">Name</label><input id="name" name="name" type="text" data-error=".errorTxt04" style="border-radius: 8px;border-bottom: 2px solid mediumaquamarine;"><div class="errorTxt06"><div class="errorTxt04"></div></div>
<div><label for="contact">Phone Number</label><input id="contact" name="contact" type="number" data-error=".errorTxt05" style="border-radius: 8px;border-bottom: 2px solid mediumaquamarine;"><div class="errorTxt06"><div class="errorTxt05"></div></div>
</td>';


					echo '<td>
<div><label for="password">Password</label><input id="password" name="password" type="password" data-error=".errorTxt03" style="border-radius: 8px;border-bottom: 2px solid mediumaquamarine;"><div class="errorTxt06"><div class="errorTxt03"></div></div>
<div><label for="email">Email</label><input id="email" name="email" type="email" style="border-radius: 8px;border-bottom: 2px solid mediumaquamarine;"><div class="errorTxt06"></div>
<div><label for="address">Address</label><input id="address" name="address" type="text" data-error=".errorTxt06" style="border-radius: 8px;border-bottom: 2px solid mediumaquamarine;"><div class="errorTxt06"><div class="errorTxt06"></div></div>
</td>';

					echo '<td>
<div><select name="role">
                      <option value="Restaurant">Restaurant</option>
                    </select></div>
<div><select name="verified">
                      <option value="1">Verified</option>
                      <option value="0" selected>Not Verified</option>
                    </select></div>
<div><select name="deleted">
                      <option value="1">Disable</option>
                      <option value="0" selected>Enable</option>
                    </select></div>
</td></tr>';

				?>
                    </tbody>
</table>
              </div>
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action" style="border-radius:8px;">Enroll
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
			</form>			
            <div class="divider"></div>
            
          </div>
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
	<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js">
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
            },
            password: {
                required: true,
                minlength: 5,
            },
            name: {
                required: true,
                minlength: 5,
			},
            contact: {
                required: true,
                minlength: 4,
			},
            address: {
                minlength: 10,
			},		
            balance: {
                required: true,
			},				
		},
        messages: {
           username:{
                required: "Enter a username",
                minlength: "Enter at least 5 characters"
            },	
           password:{
                required: "Provide a prove",
                minlength: "Password must be atleast 5 characters long",
            },	
           name:{
                required: "Please provide CVV number",
                minlength: "Enter at least 5 characters",		
            },	
           contact:{
                required: "Please provide card number",
                minlength: "Enter at least 4 digits",
            },	
           address:{
                minlength: "Address must be atleast 10 characters long",		
            },		
           balance:{
                required: "Please provide a balance.",		
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