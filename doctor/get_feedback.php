<?php

require "../include/connection.php";
session_start();
$doctor_id = $_SESSION['user_info']['id'];
$sql = "SELECT feedback.rating, feedback.comment, users.Fname , users.Lname
        FROM feedback 
        INNER JOIN users ON feedback.UserID = users.id where feedback.drID=$doctor_id";

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
