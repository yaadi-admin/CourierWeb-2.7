<?php
include '../includes/connect.php';

$selec_rest = $_GET['pgid'];
        $restid = $_GET['pgid'];

header("location: ../place-order.php?pgid='$restid'");
?>