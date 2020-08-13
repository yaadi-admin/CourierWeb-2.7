<?php
include '../includes/connect.php';

$editid = $_GET['editid'];

	foreach ($_POST as $key => $value)
	{
		if(preg_match("/[0-9]+_name/",$key)){
			if($value != ''){
			$key = strtok($key, '_');
			$value = htmlspecialchars($value);
			$sql = "UPDATE items SET name = '$value' WHERE id = $key;";
			$con->query($sql);
			}
		}
		if(preg_match("/[0-9]+_price/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET price = $value WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_description/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET description = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type1/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type1 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_first/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET first = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type2/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type2 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_second/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET second = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type3/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type3 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_third/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET third = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type4/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type4 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_fourth/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET fourth = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type5/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type5 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_fifth/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET fifth = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type6/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type6 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_sixth/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET sixth = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type7/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type7 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_seven/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET seven = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type8/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type8 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_eight/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET eight = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type9/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type9 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_nine/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET nine = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type10/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type10 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_ten/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET ten = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type11/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type11 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_eleven/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET eleven = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type12/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type12 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_twelve/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET twelve = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type13/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type13 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_thirteen/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET thirteen = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type14/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type14 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_fourteen/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET fourteen = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_type15/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET type15 = '$value' WHERE id = $key;";
			$con->query($sql);
		}
        if(preg_match("/[0-9]+_fifteen/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET fifteen = '$value' WHERE id = $key;";
			$con->query($sql);
		}
	}

header("location: ../restaurant.php?#$editid");
?>