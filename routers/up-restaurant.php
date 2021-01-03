<?php
include '../includes/connect.php';
if($_SESSION['admin_sid']==session_id()) {
    if (isset($_POST['item'])) {
        $rest = $_POST['rest'];
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
                $sql = "UPDATE users SET img_addr = '../$target_file' WHERE id = '$rest' ;";
                $con->query($sql);
                echo "<script>Materialize.toast('Image address location set', 8000);</script>";
            } else {
                echo "<script>Materialize.toast('File is not an image.', 8000);</script>";
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>Materialize.toast('Sorry, file already exists.', 8000);</script>";
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 100000000) {
            echo "<script>Materialize.toast('Sorry, your file is too large.', 8000);</script>";
            $uploadOk = 0;
        }

// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "<script>Materialize.toast('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 8000);</script>";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>Materialize.toast('Sorry, your file was not uploaded.', 8000);</script>";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<script>Materialize.toast('Photo uploaded successfully 😋', 8000);</script>";
            } else {
                echo "<script>Materialize.toast('Sorry, there was an error uploading your file.', 8000);</script>";
            }
        }
    }
}

?>