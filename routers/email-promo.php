<?php
include '../includes/connect.php';
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=email-yaadi-promo.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Emails'));

// fetch the data
$rows = mysqli_query($con,"SELECT email FROM users WHERE role='Customer';");

// loop over the rows, outputting them
while ($row = mysqli_fetch_array($rows)) fputcsv($output, $row);
?>