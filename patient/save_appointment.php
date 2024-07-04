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

        // Check if the appointment is already taken
        $check_sql = "SELECT * FROM appointment WHERE doctorID = ? AND date_ = ? AND time_ = ?";
        $stmt_check = $con->prepare($check_sql);
        if ($stmt_check === false) {
            $response['status'] = 'error';
            $response['message'] = 'prepare() failed: ' . htmlspecialchars($con->error);
        } else {
            $stmt_check->bind_param("iss", $doctor, $date_part, $time_part);
            $stmt_check->execute();
            $result = $stmt_check->get_result();
            if ($result->num_rows > 0) {
                // Appointment is already taken, suggest the next available hour
                $next_time = date('H:i', strtotime($start_time) + 3600); // Add one hour
                while (true) {
                    $next_check_sql = "SELECT * FROM appointment WHERE doctorID = ? AND date_ = ? AND time_ = ?";
                    $stmt_next_check = $con->prepare($next_check_sql);
                    if ($stmt_next_check === false) {
                        $response['status'] = 'error';
                        $response['message'] = 'prepare() failed: ' . htmlspecialchars($con->error);
                        break;
                    } else {
                        $stmt_next_check->bind_param("iss", $doctor, $date_part, $next_time);
                        $stmt_next_check->execute();
                        $next_result = $stmt_next_check->get_result();
                        if ($next_result->num_rows == 0) {
                            $response['status'] = 'suggest';
                            $response['message'] = 'Appointment is already booked. The next available time is ' . $next_time;
                            $response['suggested_time'] = $next_time;
                            break;
                        } else {
                            $next_time = date('H:i', strtotime($next_time) + 3600); // Add another hour
                        }
                        $stmt_next_check->close();
                    }
                }
            } else {
                // Proceed to insert the appointment
                $insert_sql = "INSERT INTO appointment (doctorID, userID, details, delete_, date_, time_)
                               VALUES (?, ?, ?, ?, ?, ?)";
                $delete = 0; 
                $stmt_insert = $con->prepare($insert_sql);
                if ($stmt_insert === false) {
                    $response['status'] = 'error';
                    $response['message'] = 'prepare() failed: ' . htmlspecialchars($con->error);
                } else {
                    $stmt_insert->bind_param("iisiss", $doctor, $userID, $description, $delete, $date_part, $time_part);
                    if ($stmt_insert->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Appointment saved successfully!';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Error: ' . $stmt_insert->error;
                    }
                    $stmt_insert->close();
                }
            }
            $stmt_check->close();
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
