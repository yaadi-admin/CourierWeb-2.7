<?php
include '../includes/connect.php';
$success=false;
$username = $_POST['contact'];
$password = $_POST['password'];
$date = date('Y-m-d');
$hash = password_hash($password, PASSWORD_BCRYPT);
$result = mysqli_query($con, "SELECT * FROM users WHERE contact='$username' AND role='Restaurant' AND not deleted;");
while($row = mysqli_fetch_array($result))
{
    if(password_verify($password, $row['password'])) {
    $success = true;
	$user_id = $row['id'];
	$name = $row['name'];
	$role= $row['role'];
        echo 'true';
} else {
    echo 'Something is not quiet right here....!';
} 
}
if($success == true)
{	
	session_start();
	$_SESSION['restaurant_sid']=session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['name'] = $name;

     echo '<script>window.location=" ../restaurant.php"</script>';
}
else
{
	$result = mysqli_query($con, "SELECT * FROM users WHERE contact='$username' AND role='Customer' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
	if (password_verify($password, $row['password'])) {
    $success = true;
	$user_id = $row['id'];
	$name = $row['name'];
	$role= $row['role'];
        echo 'true';
} else {
    echo 'Something is not quiet right here....!';
}
	}
	if($success == true)
	{
		session_start();
		$_SESSION['customer_sid']=session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;

		header("location: ../index.php");
	}
	else
	{
echo '<script>alert("Entered credentials do not match!");</script>';
echo '<script>window.location=" ../login.php"</script>';
	}
}
?>