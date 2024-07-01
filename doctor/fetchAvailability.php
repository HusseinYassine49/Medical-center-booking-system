<?php
session_start();
$dr=$_SESSION['user_info']['id'];
require "../include/connection.php";

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
