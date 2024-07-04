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
$data = json_decode(file_get_contents("php://input"), true);
$linkedin = $data['linkedin'];
$optional_link1 = isset($data['optional_link1']) ? $data['optional_link1'] : null;
$optional_link2 = isset($data['optional_link2']) ? $data['optional_link2'] : null;
$stmt = $con->prepare("UPDATE doctors SET linkedin = ?, optional_link1 = ?, optional_link2 = ? WHERE DoctorID = ?");
$stmt->bind_param("sssi", $linkedin, $optional_link1, $optional_link2, $doctorID);
$stmt->execute();
$stmt->close();

$con->close();

echo json_encode(["status" => "success"]);
?>