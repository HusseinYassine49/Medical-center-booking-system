<?php
require "../include/connection.php";

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

$response = array('success' => false, 'message' => '');

if (isset($data['name']) && isset($data['description']) && isset($data['icon'])) {
    $name = $data['name'];
    $desc = $data['description'];
    $icon = $data['icon']; // Get icon from data

    $sql = "INSERT INTO department (Department_name, Description, Icon) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $desc, $icon);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Data inserted successfully';
    } else {
        $response['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
} else {
    $response['message'] = 'Name, description, and icon are required fields.';
}

$con->close();

echo json_encode($response);
?>
