<?php
require "../include/connection.php";

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

$response = array('success' => false, 'message' => '');

if (isset($data['name']) && isset($data['description'])) {
    $name = $data['name'];
    $desc = $data['description'];

    $sql = "INSERT INTO department (Department_name, Description) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $name, $desc);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Data inserted successfully';
    } else {
        $response['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$con->close();

echo json_encode($response);
?>
