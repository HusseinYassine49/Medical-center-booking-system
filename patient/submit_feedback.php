<?php
// Include your database connection file
require_once "../include/connection.php";

// Check if the data is sent via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointmentId'])) {
    // Extract data from $_POST
    $appointmentId = $_POST['appointmentId'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // Fetch appointment details from the main appointment table
    $stmt = $con->prepare("SELECT userID, doctorID, date_, time_, details FROM appointment WHERE id = ?");
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Assign fetched values to variables
        $userID = $row['userID'];
        $doctorID = $row['doctorID'];
        $date_ = $row['date_'];
        $time_ = $row['time_'];
        $details = $row['details'];

        // Insert feedback into the appointment_feedback table
        $feedbackQuery = "INSERT INTO appointment_feedback (User_ID, Doctor_ID, rating, date_, time_, details, comment, status)
                          VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $con->prepare($feedbackQuery);
        $stmt->bind_param("iiissss", $userID, $doctorID, $rating, $date_, $time_, $details, $comment);

        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Failed to submit feedback.";
        }
        $stmt->close();
    } else {
        echo "Appointment not found.";
    }
} else {
    echo "Invalid request.";
}

// Close database connection
$con->close();
?>
