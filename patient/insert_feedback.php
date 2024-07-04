<?php

// Include your database connection file
require_once "../include/connection.php";

// Assuming $_POST is used in your AJAX request

$doctor = $_POST['doctor'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];
$userID = $_POST['userID']; // Adjust this line if userID is passed

// Perform SQL insertion (Example query, adjust as per your database structure)
$insertQuery = "INSERT INTO `feedback`( `UserID`, `rating`, `comment`, `status`, `DoctorID`) VALUES ('$userID','$rating','$comment','0','$doctor')";

$response = array(); // Initialize response array

if ($con->query($insertQuery) === TRUE) {
    // Return success message
    $response['success'] = true;
    $response['message'] = 'Feedback submitted successfully';
} else {
    // Return error message
    $response['success'] = false;
    $response['message'] = 'Error: ' . $con->error;
}

// Set content type to JSON and output the response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$con->close();
