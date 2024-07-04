<?php
session_start();
require_once "../include/connection.php"; 
$userId = $_SESSION['user_info']['id'];
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
$stmt->close();
$dr = $_SESSION['user_info']['id'];


$query = "SELECT u.Fname, u.Lname, a.date_, a.time_, a.status, a.id,u.id as userID
FROM appointment AS a
INNER JOIN users AS u ON a.userID = u.id
WHERE a.delete_ = 1  and a.doctorID= $doctorID
ORDER BY a.date_ ASC;
";

$result = mysqli_query($con, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($con));
}

$appointments = array();

while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}
header('Content-Type: application/json');
echo json_encode($appointments);
mysqli_close($con);
