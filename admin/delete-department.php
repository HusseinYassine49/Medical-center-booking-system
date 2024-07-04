<?php
session_start();
require "../include/connection.php";

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

$response = array('success' => false, 'error' => '');

if (isset($data['id'])) {
    $id = $data['id'];

    $sql = "DELETE FROM department WHERE Id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = 'Error deleting department: ' . $stmt->error;
    }

    $stmt->close();
} else {
    $response['error'] = 'Department ID is required.';
}

$con->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
