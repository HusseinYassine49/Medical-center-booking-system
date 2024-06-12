<?php
require "../include/connection.php";

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$userId = $input['id'];

$response = array();

if ($userId) {
<<<<<<< HEAD
  $sql = "DELETE FROM users WHERE id = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i", $userId);

  if ($stmt->execute()) {
    $response['success'] = true;
  } else {
    $response['success'] = false;
    $response['error'] = "Error deleting record: " . $con->error;
  }

  $stmt->close();
} else {
  $response['success'] = false;
  $response['error'] = "Invalid ID";
=======
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = "Error deleting record: " . $con->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Invalid ID";
>>>>>>> ali
}

$con->close();
echo json_encode($response);
?>
