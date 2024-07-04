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

// Retrieve data from request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if $data is valid (not null and has 'availability' key)
if (!is_array($data) || !isset($data['availability'])) {
    die('Error: Invalid request data.');
}

$availability = $data['availability'];

$stmt = $con->prepare("INSERT INTO doctor_availability (doctor_id, day, start_time, end_time) VALUES (?, ?, ?, ?)");

if ($stmt === false) {
    die('Error preparing the statement: ' . $con->error);
}

foreach ($availability as $slot) {
    $day = $slot['day'];
    $start_time = $slot['start_time'];
    $end_time = $slot['end_time'];
    $stmt->bind_param("isss", $dr, $day, $start_time, $end_time);
    $stmt->execute();

    // Check for errors in execution
    if ($stmt->errno) {
        die('Error executing statement: ' . $stmt->error);
    }
}

$stmt->close();
$con->close();

echo json_encode(["status" => "success"]);
?>