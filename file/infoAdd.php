<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['hid']) && !isset($_SESSION['did'])) {
    header('location:login.php');
} else {
    if (isset($_POST['add'])) {
        $id = isset($_SESSION['hid']) ? $_SESSION['hid'] : $_SESSION['did'];
        $bg = $_POST['bg'];

        // Define the table name and ID field based on the user's session
        $tableName = isset($_SESSION['hid']) ? 'bloodinfo' : 'donor_table';
        $idField = isset($_SESSION['hid']) ? 'hid' : 'did';

        // Check if the blood sample already exists in the selected table
        $check_data_query = "SELECT bid FROM $tableName WHERE $idField='$id' AND bg='$bg'";
        $check_data_result = mysqli_query($conn, $check_data_query);

        if (!$check_data_result) {
            // Query execution failed, handle the error
            $error = "Error: " . mysqli_error($conn);
            header("location:../bloodinfo.php?error=" . $error);
        } else {
            // Check if any rows were found
            $rows_found = mysqli_num_rows($check_data_result);

            if ($rows_found > 0) {
                $error = 'You have already added this blood sample.';
                header("location:../bloodinfo.php?error=" . $error);
            } else {
                // Insert the blood sample into the selected table
                $sql = "INSERT INTO $tableName (bg, $idField) VALUES ('$bg', '$id')";
                $insert_result = mysqli_query($conn, $sql);

                if ($insert_result) {
                    $msg = "You have added the record successfully.";
                    header("location:../bloodinfo.php?msg=" . $msg);
                } else {
                    // Insertion failed, handle the error
                    $error = "Error: " . mysqli_error($conn);
                    header("location:../bloodinfo.php?error=" . $error);
                }
            }
        }
        mysqli_free_result($check_data_result);
    }
}
?>
