<?php
// Ensure connection and other necessary includes
require_once "../include/connection.php";

// Response array to hold status and message
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    if (empty($_POST['date_']) || empty($_POST['start_time']) || empty($_POST['clinic']) || empty($_POST['doctor']) || empty($_POST['userID'])) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in all required fields.';
    } else {
        // Retrieve POST data
        $date = $_POST['date_'];
        $start_time = $_POST['start_time'];
        $description = $_POST['description'];
        $clinic = $_POST['clinic'];
        $doctor = $_POST['doctor'];
        $userID = $_POST['userID'];

        // Separate date and time for different columns
        $date_part = date('Y-m-d', strtotime($date));
        $time_part = date('H:i', strtotime($start_time));

        // Prepare SQL statement
        $sql = "INSERT INTO appointment (doctorID, userID, details, delete_, date_, time_)
                VALUES (?, ?, ?, ?, ?, ?)";

        $delete = 0; 

        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            $response['status'] = 'error';
            $response['message'] = 'prepare() failed: ' . htmlspecialchars($con->error);
        } else {
            $stmt->bind_param("iisiss", $doctor, $userID, $description, $delete, $date_part, $time_part);

            // Execute the statement
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Appointment saved successfully!';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error: ' . $stmt->error;
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $con->close();
} else {
    // Invalid request method
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
