<?php

// Include your database connection file
require_once "../include/connection.php";

// Assuming $_POST is used in your AJAX request

$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Adjust this line if userID is passed
$ID = $_POST['ID'];
// Perform SQL insertion (Example query, adjust as per your database structure)
$insertQuery = "UPDATE feedback SET rating=?, comment=? WHERE id=?";
$stmt = $con->prepare($insertQuery);
$stmt->bind_param("isi", $rating, $comment, $ID);

// Execute the statement
if ($stmt->execute()) {
    // Return success message
    $response['success'] = true;
    $response['message'] = 'Feedback submitted successfully';
    $response['userid'] = $_SESSION['userid'];
} else {
    // Return error message
    $response['success'] = false;
    $response['message'] = 'Error: ' . $stmt->error;
}

// Close statement and database connection
$stmt->close();
$con->close();

