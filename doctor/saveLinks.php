<?php
require "../include/connection.php";
session_start();
$doctor_id = $_SESSION['user_info']['id'];
$data = json_decode(file_get_contents("php://input"), true);
$linkedin = $data['linkedin'];
$optional_link1 = isset($data['optional_link1']) ? $data['optional_link1'] : null;
$optional_link2 = isset($data['optional_link2']) ? $data['optional_link2'] : null;
$stmt = $con->prepare("UPDATE doctors SET linkedin = ?, optional_link1 = ?, optional_link2 = ? WHERE DoctorID = ?");
$stmt->bind_param("sssi", $linkedin, $optional_link1, $optional_link2, $doctor_id);
$stmt->execute();
$stmt->close();

$con->close();

echo json_encode(["status" => "success"]);
?>
