<?php
session_start();
require "../include/connection.php";

$userId = $_SESSION['user_info']['id'];

// Fetch the doctor ID
$sql = "SELECT DoctorID FROM doctors WHERE UserID = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die('Error preparing the statement: ' . $con->error);
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($doctorID);

if ($stmt->fetch()) {
    $dr = $doctorID;
} else {
    $dr = null;
    echo "No doctor found for user ID: " . $userId;
    exit; // Exit script if no doctor found
}

$stmt->close();
$sql = "SELECT feedback.rating, feedback.comment, users.Fname , users.Lname
        FROM feedback 
        INNER JOIN users ON feedback.UserID = users.id where feedback.doctorID=$doctorID and status=1" ;

$result = $con->query($sql);

$feedbackData = array();

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($feedbackData);

// Close the connection
$con->close();
?>