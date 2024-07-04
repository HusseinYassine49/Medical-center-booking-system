<?php
session_start();
require "../include/connection.php";

$userId = $_SESSION['user_info']['id'];

// Fetch the doctor ID
$sql = "SELECT DoctorID FROM doctors WHERE UserID = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die('Error preparing the statement: ' . $con->error);
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($doctorID);

if ($stmt->fetch()) {
    $dr = $doctorID;
} else {
    $dr = null;
    echo "No doctor found for user ID: " . $userId;
}

$stmt->close(); // Close the first statement

if ($dr !== null) {
    // Fetch appointments
    $query = "SELECT u.Fname, u.Lname, a.date_, a.time_, a.status, a.id, u.id as userID
              FROM appointment AS a
              INNER JOIN users AS u ON a.userID = u.id
              WHERE a.delete_ = 0 AND a.date_ >= CURDATE() AND a.status = 0 AND a.doctorID = ?
              ORDER BY a.date_ ASC";

    $stmt = $con->prepare($query);

    if ($stmt === false) {
        die('Error preparing the statement: ' . $con->error);
    }

    $stmt->bind_param("i", $dr);
    $stmt->execute();
    $result = $stmt->get_result();

    $appointments = array();

    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($appointments);

    $stmt->close(); // Close the second statement
} else {
    echo json_encode([]);
}

$con->close();
?>