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

$stmt = $con->prepare("SELECT day, start_time, end_time FROM doctor_availability WHERE doctor_id = $dr ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), start_time");

$stmt->execute();
$result = $stmt->get_result();

$availability = [];

while ($row = $result->fetch_assoc()) {
    $availability[] = $row;
}

$stmt->close();
$con->close();

echo json_encode($availability);
?>