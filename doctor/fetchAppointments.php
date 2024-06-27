<?php
session_start();
$dr=$_SESSION['user_info']['id'];
// Include your database connection script
require "../include/connection.php";
$date = $_GET['date'];

$sql = "SELECT u.Fname AS patient_name, u.Lname, a.date_, a.time, a.status, a.id as appointment_id, u.id as user_id
            FROM appointment a
            INNER JOIN users u ON a.userID = u.id WHERE a.date_ = ? and a.delete_ = 0 AND a.date_ >= CURDATE() and a.status = 1 and a.doctorID= $dr";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = [
        'user_id' => $row['user_id'],
        'appointment_id' => $row['appointment_id'],
        'patient' => $row['patient_name'],
        'patientlastname' => $row['Lname'],
        'time' => $row['time']
    ];
}

$stmt->close();
$con->close();

echo json_encode($appointments);
?>
