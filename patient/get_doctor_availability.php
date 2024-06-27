<?php
require_once "../include/connection.php";

if (isset($_POST['doctor_id']) && isset($_POST['selected_date'])) {
    $doctorId = $_POST['doctor_id'];
    $selectedDate = $_POST['selected_date'];

    $availabilityQuery = "
        SELECT day, start_time, end_time 
        FROM doctor_availability 
        WHERE doctor_id = ?";
    $stmt = $con->prepare($availabilityQuery);
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();

    $availability = [];
    while ($row = $result->fetch_assoc()) {
        $availability[] = $row;
    }

    echo json_encode($availability);
}
?>
