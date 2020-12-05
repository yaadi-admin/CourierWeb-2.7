<?php
include '../includes/connect.php';
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['rest'])) {
        $restaurant = $_POST['rest'];
        $rid = "";

        $result = mysqli_query($con, "SELECT * FROM users where id= '$restaurant' AND role='Restaurant';");
        while ($row = mysqli_fetch_array($result)) {
            $rid = $row['id'];
        }

        $target_dir = "../images/rests/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                $sql = "UPDATE users SET image_dir = '../$target_file' WHERE id = '$rid';";
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
                echo "Image Updated";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

?>