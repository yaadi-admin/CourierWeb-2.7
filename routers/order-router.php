<?php
include '../includes/connect.php';
include '../includes/wallet.php';
require '../src/Twilio/autoload.php';
use Twilio\Rest\Client;
if($_SESSION['customer_sid']==session_id()) {
    if (isset($_POST['rest'])) {
        $account_sid = 'AC8f235f78aa51cec01909115165e27a90';
        $auth_token = '64b73f721643ba5f3b3630b75b792116';
        $twilio_number = "+12029145139";
        $client = new Client($account_sid, $auth_token);
        $total = 0;
        $service_fee = 0;
        $fee = htmlspecialchars($_POST['del_fee']);
        $selec_rest = $_POST['rest'];
        $restid = $_POST['rest'];
        $date = new DateTime(date('Y-m-d H:i:sP'), new DateTimeZone('America/Jamaica'));

        $date->setTimezone(new DateTimeZone('America/Jamaica'));
        $timestamp = $date->format('Y-m-d H:i:sP');
        $address = "";
        $restname = '';
        $restmail = '';
        $rider = '';
        $pay_type = htmlspecialchars($_POST['pay_type']);
        if (isset($_POST['note'])) {
            $description = htmlspecialchars($_POST['note']);
        }
        if (!isset($_POST['note'])){
            $description = "No note added";
        }
        $usrph = "";
        $admn = "18763622910";
        $admn2 = "18767004142";
        $usr = $_SESSION['customer_sid'];
        $payment_type = $_POST['pay_type'];

        $getcus = mysqli_query($con, "SELECT * FROM users WHERE id= $user_id AND not deleted;");
        while ($row = mysqli_fetch_array($getcus)) {
            $phone = $row["contact"];
            $usrph = $phone;
            $address = $row["address"];
        }

        $getrest = mysqli_query($con, "SELECT * FROM items WHERE restaurantid= $selec_rest AND not deleted;");
        while ($row = mysqli_fetch_array($getrest)) {
            $restid = $selec_rest;
        }

        $getrest2 = mysqli_query($con, "SELECT * FROM users WHERE id= $restid AND not deleted;");
        while ($row = mysqli_fetch_array($getrest2)) {
            $restname = $row['name'];
            $restmail = $row['email'];
        }

        $getriders = mysqli_query($con, "SELECT * FROM users WHERE (role='Rider' AND verified=1) AND not deleted;");
        while ($row = mysqli_fetch_array($getriders)) {
            $rider = $row['contact'];
        }

        if ($_POST['del_fee'] != '0') {

            $total = $_POST['total'];
            $service_fee = $_POST['servicefee'];

            $sql = "INSERT INTO orders (customer_id, payment_type, address, total, description, service_fee, fee, date, restaurantid, pay_type) VALUES ('$user_id', '$payment_type', '$address', '$total', '$description', '$service_fee', '$fee', '$timestamp', '$restid', '$pay_type')";

            if ($con->query($sql) === TRUE) {

                $order_id = $con->insert_id;

                foreach ($_SESSION["shopping_cart"] as $key => $value) {
                    $id = $value["item_id"];
                    $quantity = $value["item_quantity"];
                    $price = $value["item_price"];
                    $variation = $value["item_variation"];
                    $variation_type = $value["item_variation_type"];
                    $variation_side = $value["item_variation_side"];
                    $variation_drink = $value["item_variation_drink"];

                    $result = mysqli_query($con, "SELECT * FROM items WHERE id=$id");
                    while ($row = mysqli_fetch_array($result)) {
                        $price = $row['price'];
                    }
                    $sql = "INSERT INTO order_details (order_id, item_id, quantity, price, restaurant, variation, variation_type, variation_side, variation_drink) VALUES ('$order_id', '$id', '$quantity', '$price', '$restname', '$variation', '$variation_type', '$variation_side', '$variation_drink')";
                    $con->query($sql) === TRUE;
                }

                unset($_SESSION["shopping_cart"]);

//        Customer order confirmation...
                $client->messages->create(
                    $usrph,
                    array(
                        'from' => $twilio_number,
                        'body' => 'Order Placed!, Order: #'.$order_id.', Total: $'.$total.' => Yaadi.Co'));

//            Admin order notification...
                $getadm = mysqli_query($con, "SELECT * FROM users WHERE (role='Administrator' AND verified=1 AND id=1) AND not deleted;");
                while ($row = mysqli_fetch_array($getadm)) {
                    $client->messages->create(
                        $admn,
                        array(
                            'from' => $twilio_number,
                            'body' => '(NEW ODER) => #' . $order_id . ' => Total: $' . $total . ' => Restaurant: ' . $restname . ''));
                }

//            Rider order notification...
                    $client->messages->create(
                        $rider,
                        array(
                            'from' => $twilio_number,
                            'body' => '(NEW ORDER) => #'.$order_id.' => Total: $'.$total.' => Restaurant: '.$restname.''));

//            Restaurant notification....
                $to = ''.$restmail.'';
                $subject = 'Yaadi New Order Alert!!';
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:\'Open Sans\', sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title>New email 2</title> 
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,700&display=swap" rel="stylesheet"> 
  <!--<![endif]--> 
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]--> 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet"> 
  <!--<![endif]--> 
  <style type="text/css">
#outlook a {
	padding:0;
}
.ExternalClass {
	width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
	line-height:100%;
}
.es-button {
	mso-style-priority:100!important;
	text-decoration:none!important;
}
a[x-apple-data-detectors] {
	color:inherit!important;
	text-decoration:none!important;
	font-size:inherit!important;
	font-family:inherit!important;
	font-weight:inherit!important;
	line-height:inherit!important;
}
.es-desk-hidden {
	display:none;
	float:left;
	overflow:hidden;
	width:0;
	max-height:0;
	line-height:0;
	mso-hide:all;
}
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:14px!important; line-height:150%!important } h1 { font-size:28px!important; text-align:left; line-height:120% } h2 { font-size:20px!important; text-align:left; line-height:120% } h3 { font-size:14px!important; text-align:left; line-height:120% } h1 a { font-size:28px!important; text-align:left } h2 a { font-size:20px!important; text-align:left } h3 a { font-size:14px!important; text-align:left } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:14px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } a.es-button, button.es-button { font-size:14px!important; display:block!important; border-bottom-width:20px!important; border-right-width:0px!important; border-left-width:0px!important; border-top-width:20px!important } }
</style> 
 </head> 
 <body style="width:100%;font-family:\'Open Sans\', sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> 
  <div class="es-wrapper-color" style="background-color:#F5F5F5"> 
   <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f5f5f5"></v:fill>
			</v:background>
		<![endif]--> 
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> 
     <tr style="border-collapse:collapse"> 
      <td valign="top" style="padding:0;Margin:0"> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
         <tr style="border-collapse:collapse"> 
          <td align="center" style="padding:0;Margin:0"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#F5F5F5;width:600px"> 
             <tr style="border-collapse:collapse"> 
              <td align="left" style="Margin:0;padding-left:15px;padding-right:15px;padding-top:40px;padding-bottom:40px"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td align="center" valign="top" style="padding:0;Margin:0;width:570px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" class="es-m-txt-l" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:14px;font-style:normal;font-weight:bold;color:#888888;letter-spacing:0px">ORDER #'.$order_id.'</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><h1 style="Margin:0;line-height:34px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#262626">NEW ORDER</h1></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:14px;font-style:normal;font-weight:bold;color:#888888;letter-spacing:0px"><span style="color:#EF0D33">GO TO YAADI </span>TO VIEW&nbsp; &amp; MODIFY THE&nbsp;ORDER</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:40px;padding-bottom:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'Open Sans\', sans-serif;line-height:27px;color:#999999">You have received a new order!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'Open Sans\', sans-serif;line-height:27px;color:#999999">Click the button below to view order details.</p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0"> 
                       <!--[if mso]><a href="https://yaadi.co/restaurant.php" target="_blank">
	<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" stripoVmlButton href="https://viewstripo.email/" 
                style="height:84px;v-text-anchor:middle;width:213px;" arcsize="0%" stroke="f"  fillcolor="#1b2a2f">
		<w:anchorlock></w:anchorlock>
		<center style="color:#ffffff;font-family:Oswald, sans-serif;font-size:18px;font-weight:700;">GO TO YAADI</center>
	</v:roundrect></a>
<![endif]--> 
                       <span class="msohide es-button-border" style="border-style:solid;border-color:#1B2A2F;background:#1B2A2F;border-width:0px;display:inline-block;border-radius:0px;width:auto;mso-hide:all"><a href="https://www.yaadi.co/restaurant.php" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:20px;color:#FFFFFF;border-style:solid;border-color:#1B2A2F;border-width:30px 25px;display:inline-block;background:#1B2A2F;border-radius:0px;font-weight:bold;font-style:normal;line-height:24px;width:auto;text-align:center">GO TO YAADI</a></span> 
                       <!--<![endif]--></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
             <tr style="border-collapse:collapse"> 
              <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:40px;padding-bottom:40px"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td align="center" valign="top" style="padding:0;Margin:0;width:580px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" class="es-m-txt-l" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:14px;font-style:normal;font-weight:bold;color:#888888;letter-spacing:0px">YAADI</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><h2 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#262626"><font color="#ef0d33">"THE FOOD</font>&nbsp;YOU LOVE"</h2></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><h3 style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:14px;font-style:normal;font-weight:bold;color:#888888;letter-spacing:0px"><span style="color:#000000">THE PLACES</span>&nbsp;<font color="#ef0d33">YOU LOVE</font></h3></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>
';
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = 'From: <orders@yaadi.co>';
                mail($to, $subject, $message, implode("\r\n", $headers));



                echo '<script>alert("Your order #' . $order_id . ' has been placed!\n");</script>';
                echo '<script>window.location=" ../orders.php"</script>';

//        Ending bracket - if order connection successful
            }

        } else {
            $fee = 0;
            $total = 0;
            echo '<script>alert("There was an error with your order! Try changing your address or location");</script>';
            echo '<script>window.location=" ../deliverto.php"</script>';
        }
    }
}