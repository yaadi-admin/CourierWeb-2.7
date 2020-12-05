<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['category'])) {
        $restname = '';
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $description = $_POST['description'];

        $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
        while ($row = mysqli_fetch_array($result)) {
            $restname = $row['name'];
        }
        $sql = "INSERT INTO items (name, price,restaurant,restaurantid,category,description,size) VALUES ('$name', $price,'$restname',$user_id,'$category','$description','0')";
        $con->query($sql);
        header("location: ../restaurant.php");
    }
}

?>