<?php
include '../includes/connect.php';
if($_SESSION['restaurant_sid']==session_id()) {
    if (isset($_POST['item'])) {
        $itemid = $_POST['item'];
        $rname = $_POST['restname'];
        $rid = "";

        $result = mysqli_query($con, "SELECT * FROM items where name= '$rname' AND not deleted;");
        while ($row = mysqli_fetch_array($result)) {
            $rid = $row['id'];
        }

        $target_dir = "../images/rests/rest_items/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                $sql = "UPDATE items SET img_addr = '../$target_file' WHERE id = $itemid ;";
                $con->query($sql);
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 100000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo '<script>alert("File has been uploaded.");</script>';
                echo '<script>window.location=" ../restaurant-menu.php#' . $itemid . '"</script>';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}