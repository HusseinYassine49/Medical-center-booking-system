<?php

require "../include/connection.php";

header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];

        $query = "UPDATE doctors SET isdeleted = 1 WHERE DoctorID = ?";
        $stmt = $con->prepare($query);
        
        if ($stmt === false) {
            $response['error'] = 'Error preparing query: ' . $con->error;
        } else {
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['error'] = 'Error executing query: ' . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $response['error'] = 'Invalid request: ID not set';
    }
} else {
    $response['error'] = 'Invalid request method';
}

$con->close();
echo json_encode($response);
?>
