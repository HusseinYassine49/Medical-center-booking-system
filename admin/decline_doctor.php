<?php
require "../include/connection.php";

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$doctorId = $input['doctorId'];

$response = array();

if ($doctorId) {
    $sql = "UPDATE doctors SET verified = 'declined' WHERE DoctorID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $doctorId);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = "Error updating record: " . $con->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Invalid doctor ID";
}

$con->close();
echo json_encode($response);
?>
