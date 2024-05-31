<?php
$data = json_decode(file_get_contents("php://input"));

// Check if username and password are correct (example)
$username = mysqli_real_escape_string($con, $data->username);
$password = mysqli_real_escape_string($con, $data->password);

require "connection.php";

$query = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
  // Login successful
  $response = array("success" => true, "redirect" => "../php/admin-dashboard.php");
} else {
  // Login failed
  $response = array("success" => false);
}

// Send the response as JSON
header("Content-Type: application/json");
echo json_encode($response);
?>