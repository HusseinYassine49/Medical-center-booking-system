<?php
session_start();
require_once "../include/connection.php";

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
    exit;
}

$stmt->close();

// Prepare and execute query to fetch doctor availability
$sql = "SELECT day, start_time, end_time 
        FROM doctor_availability 
        WHERE doctor_id = ? 
        ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), start_time";

$stmt = $con->prepare($sql);

if ($stmt === false) {
    die('Error preparing the statement: ' . $con->error);
}

$stmt->bind_param("i", $dr);
$stmt->execute();
$result = $stmt->get_result();

$availability = [];

while ($row = $result->fetch_assoc()) {
    $availability[] = $row;
}

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode($availability);
?>
