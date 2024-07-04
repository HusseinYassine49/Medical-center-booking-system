<?php
session_start();
$dr=$_SESSION['user_info']['id'];
require "../include/connection.php";

$query = "SELECT u.Fname, u.Lname, a.date_, a.time_, a.status, a.id,u.id as userID
FROM appointment AS a
INNER JOIN users AS u ON a.userID = u.id
WHERE a.delete_ = 1  and a.doctorID= $dr
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
?>