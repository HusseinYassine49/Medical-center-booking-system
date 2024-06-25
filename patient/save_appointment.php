<?php
require_once "../include/connection.php";
global $con;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctorID = $_POST['doctorID'];
    $userID = $_POST['userID'];
    $details = $_POST['details'];
    $delete_ = $_POST['delete_'];
    $date_ = $_POST['date_'];




    $sql = "INSERT INTO appointment (doctorID, userID, details, delete_, date_, verified_) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param($doctorID, $userID, $details, $delete_, $date_, "notaccept");

    if ($stmt->execute()) {
        echo "Appointment saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $con->close();
}
