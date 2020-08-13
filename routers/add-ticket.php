<?php
include '../includes/connect.php';
$subject = htmlspecialchars($_POST['subject']);
$description = htmlspecialchars($_POST['description']);
$type = $_POST['type'];
$user_id = $_POST['id'];
$usrname = "";
if($type != ''){
	$sql = "INSERT INTO tickets (poster_id, subject, description, type) VALUES ($user_id, '$subject', '$description', '$type')";
	if ($con->query($sql) === TRUE){
		$ticket_id =  $con->insert_id;
		$sql = "INSERT INTO ticket_details (ticket_id, user_id, description) VALUES ($ticket_id, $user_id, '$description')";
		$con->query($sql);
	}
}
$result = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
        $usrname = $row["name"];
	}
$to = 'tickets@yaadi.co';
$subject = 'New Ticket Message from: '.$usrname.'';
$message = '<html>
<head>
  <title>A customer has sent a new ticket message</title>
</head>
<body>
  <p>Customer: '.$usrname.'</p>
  <table cellspacing="0" style="border: 1px solid #bbb; width: 100%;"> 
            <tr> 
                <th>Subject: '.$subject.'</th> 
            </tr> 
            <tr style="background-color: #bbb"> 
                <th>'.$description.'</td> 
            </tr> 
            <tr> 
                <th>GOTO:</th><td><a href="https://www.yaadi.co">Yaadi</a></td> 
            </tr> 
    </table> 
</body>
</html>
';
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = 'From: <support@yaadi.co>';
mail($to, $subject, $message, implode("\r\n", $headers));
echo '<script>alert("Ticket Sent! \nPlease await a Yaadi.co agent");</script>'; 
echo '<script>window.location=" ../tickets.php"</script>';  
?>