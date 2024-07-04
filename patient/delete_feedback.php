<?php
require_once '../include/connection.php';

if (isset($_POST['id'])) {
    $feedbackId = $_POST['id'];
    $deleteQuery = "DELETE FROM feedback WHERE id = ?";

    if ($stmt = $con->prepare($deleteQuery)) {
        $stmt->bind_param('i', $feedbackId);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete feedback']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
