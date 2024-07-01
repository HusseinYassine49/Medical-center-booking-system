<?php
// fetch_availability.php

session_start();
require_once "../include/connection.php";


$sql = "SELECT * FROM doctor_availability";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = [
            'id' => $row['id'],
            'title' => 'Available', // Customize as needed
            'start' => $row['day'] . 'T' . $row['start_time'], // Example: '2024-06-27T09:00:00'
            'end' => $row['day'] . 'T' . $row['end_time'],     // Example: '2024-06-27T17:00:00'
            'backgroundColor' => '#28a745', // Customize color if needed
            'borderColor' => '#28a745'      // Customize border color if needed
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($events);
$conn->close();
?>
