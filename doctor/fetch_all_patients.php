
<?php
session_start();
$dr=$_SESSION['user_info']['id'];
require "../include/connection.php";


$sql = "SELECT * FROM users WHERE id IN (SELECT DISTINCT userID FROM appointment where doctorID= $dr) ";
$result = $con->query($sql);
$patient = array();
if (!$result) {
    die('Query failed: ' . mysqli_error($con));
}


while ($row = $result->fetch_assoc()) {
    $patient[] = $row;
}

header('Content-Type: application/json');
echo json_encode($patient);
mysqli_close($con);
?>
