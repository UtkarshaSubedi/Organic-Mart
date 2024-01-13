<?php
session_start();
include 'connection.php';

// Assuming $_GET['PRODUCT_ID'] is properly sanitized to prevent SQL injection.
$productID = $_GET['PRODUCT_ID'];

$query = "DELETE FROM P_PRODUCT WHERE PRODUCT_ID=?";
$stmt = mysqli_prepare($connection, $query);

mysqli_stmt_bind_param($stmt, "i", $productID);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    mysqli_commit($connection); //*** Commit Transaction ***//
    header('LOCATION: Trader.php');
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
