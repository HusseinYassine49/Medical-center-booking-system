<?php
session_start();
include "../include/connection.php"; // Make sure to include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_SESSION['user_id']; // Use the session user ID
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $bloodType = mysqli_real_escape_string($con, $_POST['bloodType']);
    $height = mysqli_real_escape_string($con, $_POST['height']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);

    

    // Split full name into first name and last name
    $nameParts = explode(" ", $fullName);
    $fname = $nameParts[0];
    $lname = isset($nameParts[1]) ? $nameParts[1] : '';

    $query = "UPDATE users SET Fname='$fname', Lname='$lname', Email='$email', DOB='$dob', BloodType='$bloodType', height='$height ', weight='$weight' WHERE id='$userID'";

    if (mysqli_query($con, $query)) {
        $response = array('status' => 'success', 'message' => 'Profile updated successfully.');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to update profile.');
    }

    echo json_encode($response);
}