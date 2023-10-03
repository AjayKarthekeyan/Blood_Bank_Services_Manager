

<?php
include "connection.php";

session_start();
if (!isset($_SESSION['hid']) && !isset($_SESSION['did'])) {
    header('location:../login.php');
    exit(); // Ensure script execution stops after redirection
}

$bid = $_GET['bid'];

// Define your SQL DELETE query here
if (isset($_SESSION['hid'])) {
    // If it's a hospital user, use 'hid' as the ID field
    $idField = 'hid';
    $tableName = 'bloodinfo';
} elseif (isset($_SESSION['did'])) {
    // If it's a donor user, use 'did' as the ID field
    $idField = 'did';
    $tableName = 'donor_table';
} else {
    // Handle the case where neither hid nor did is set in the session
    // You might want to add appropriate error handling or redirection here
    exit();
}

$sql = "DELETE FROM $tableName WHERE bid = '$bid' AND $idField = '$_SESSION[$idField]'";

if (mysqli_query($conn, $sql)) {
    $msg = "You have deleted one blood sample.";
    header("location:../bloodinfo.php?msg=" . $msg);
} else {
    $error = "Error deleting record: " . mysqli_error($conn);
    header("location:../bloodinfo.php?error=" . $error);
}

mysqli_close($conn);
?>
