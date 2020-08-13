<?php
include '../includes/connect.php';

$user_id = $_SESSION['user_id'];
$selec_rest = $_GET['pgid'];
        $restid = $_GET['pgid'];
echo $restid;

    $result = mysqli_query($con, "SELECT * FROM users WHERE id = $restid");
				while($row = mysqli_fetch_array($result))
				{
                    $id = $row["id"];
                    echo $id;
                   header("location: ../category.php?pgid='$id'"); 
                }


?>