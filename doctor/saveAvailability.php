<?php
session_start();
$dr=$_SESSION['user_info']['id'];
require "../include/connection.php";

// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

$availability = $data['availability'];

$stmt = $con->prepare("INSERT INTO doctor_availability (doctor_id, day, start_time, end_time) VALUES (?, ?, ?, ?)");
foreach ($availability as $slot) {
    $day = $slot['day'];
    $start_time = $slot['start_time'];
    $end_time = $slot['end_time'];
    $stmt->bind_param("isss", $dr, $day, $start_time, $end_time);
    $stmt->execute();
}
$stmt->close();

$con->close();

echo json_encode(["status" => "success"]);
?>
