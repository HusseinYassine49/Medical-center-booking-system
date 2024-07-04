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
    exit;
}

$stmt->close();

// Query to fetch all patients associated with the doctor
$sql = "SELECT * FROM users WHERE id IN (SELECT DISTINCT userID FROM appointment WHERE doctorID = ?)";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die('Error preparing the statement: ' . $con->error);
}

$stmt->bind_param("i", $dr);
$stmt->execute();
$result = $stmt->get_result();

$patients = [];
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode($patients);
?>
